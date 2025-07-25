<p>Halo {{ $guest->name }},</p>
<p>Berikut ini hasil diagnosa Anda:</p>
<ul>
    <li>Suhu: {{ $diagnosis->suhu }} °C</li>
    <li>Detak Jantung: {{ $diagnosis->detak_jantung }} bpm</li>
    <li>Mood: {{ $diagnosis->mood }}</li>
    <li>Snack Rekomendasi: {{ optional($diagnosis->snack)->name ?? '-' }}</li>
</ul>
<p>Detail lengkap ada pada file PDF terlampir.</p>
<p>Terima kasih,</p>
<p>{{ config('app.name') }}</p>
