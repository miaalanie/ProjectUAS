<?php

namespace App\Library;

class MoodFuzzyTsukamoto
{
    public static function hitung($suhu, $detak)
    {
        // 1. Fuzzifikasi
        $fuzzySuhu = self::fuzzifikasiSuhu($suhu);
        $fuzzyDetak = self::fuzzifikasiDetak($detak);

        // 2. Inferensi (apply rules)
        $rules = self::inferensi($fuzzySuhu, $fuzzyDetak);

        // 3. Defuzzifikasi (weighted average)
        return [
        'nilai' => self::defuzzifikasi($rules),
        'detail' => $rules
        ];
        
    }

    // Fungsi keanggotaan segitiga
    private static function segitiga($x, $a, $b, $c) {
        if ($x <= $a || $x >= $c) return 0;
        else if ($x == $b) return 1;
        else if ($x > $a && $x < $b) return ($x - $a) / ($b - $a);
        else return ($c - $x) / ($c - $b);
    }

// Fungsi keanggotaan trapezoid
    private static   function trapezoid($x, $a, $b, $c, $d) {
        if ($x <= $a || $x >= $d) return 0;
        else if ($x >= $b && $x <= $c) return 1;
        else if ($x > $a && $x < $b) return ($x - $a) / ($b - $a);
        else return ($d - $x) / ($d - $c);
    }


    // fungsi-fungsi bantu nanti kita isi
    private static function fuzzifikasiSuhu($suhu) {
    return [
        'sangat_dingin' => self::trapezoid($suhu, 20, 20, 30, 33),
        'dingin' => self::segitiga($suhu, 30, 33, 35),
        'normal' => self::segitiga($suhu, 34, 36, 37.5),
        'hangat' => self::trapezoid($suhu, 37, 38, 42, 45),
    ];
}

    private static function fuzzifikasiDetak($detak) {
    return [
        'lambat' => self::trapezoid($detak, 30, 30, 55, 65),
        'normal' => self::segitiga($detak, 60, 70, 80),
        'cepat' => self::segitiga($detak, 75, 90, 105),
        'sangat_cepat' => self::trapezoid($detak, 100, 110, 170, 180),
    ];
}



    private static function inferensi($fuzzySuhu, $fuzzyDetak)
{
    $rules = [
        ['detak' => 'lambat', 'suhu' => 'normal', 'mood' => 'relaxed'],
        ['detak' => 'lambat', 'suhu' => 'dingin', 'mood' => 'calm'],
        ['detak' => 'normal', 'suhu' => 'normal', 'mood' => 'calm'],
        ['detak' => 'normal', 'suhu' => 'dingin', 'mood' => 'anxious'],
        ['detak' => 'cepat', 'suhu' => 'normal', 'mood' => 'anxious'],
        ['detak' => 'cepat', 'suhu' => 'dingin', 'mood' => 'tense'],
        ['detak' => 'sangat_cepat', 'suhu' => 'dingin', 'mood' => 'tense'],
        ['detak' => 'sangat_cepat', 'suhu' => 'sangat_dingin', 'mood' => 'tense'],
        ['detak' => 'normal', 'suhu' => 'hangat', 'mood' => 'relaxed'],
        ['detak' => 'cepat', 'suhu' => 'hangat', 'mood' => 'anxious'],
        ['detak' => 'lambat', 'suhu' => 'hangat', 'mood' => 'calm'],
        ['detak' => 'sangat_cepat', 'suhu' => 'normal', 'mood' => 'tense'],
    ];

    $hasilInferensi = [];

    foreach ($rules as $index => $rule) {
        $α = min(
            $fuzzyDetak[$rule['detak']] ?? 0,
            $fuzzySuhu[$rule['suhu']] ?? 0
        );

        if ($α > 0) {
            $z = match ($rule['mood']) {
                'relaxed' => 25 - $α * (25 - 0),
                'calm' => 50 - $α * (50 - 25),
                'anxious' => 75 - $α * (75 - 50),
                'tense' => 100 - $α * (100 - 75),
            };

            $hasilInferensi[] = [
                'rule' => $index + 1,
                'α' => $α,
                'z' => $z,
                'mood' => $rule['mood'],
            ];
        }
    }

    return $hasilInferensi; // 12 data hasil inferensi, tiap rule bisa dipakai untuk defuzzifikasi nanti
}
    
private static function defuzzifikasi(array $hasilInferensi): float {
    $atas = 0;
    $bawah = 0;

    foreach ($hasilInferensi as $rule) {
        $mu = $rule['α']; // FIXED
        $z = $rule['z'];
        $atas += $mu * $z;
        $bawah += $mu;
    }

    return $bawah == 0 ? 0 : $atas / $bawah;
}


}





