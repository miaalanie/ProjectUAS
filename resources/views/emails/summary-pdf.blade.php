<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Summary Diagnosa</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 14px; }
        .title { font-size: 18px; font-weight: bold; margin-bottom: 10px; }
        .section { margin-bottom: 15px; }
    </style>
</head>
<body>
    <div class="title">Summary Diagnosa</div>
    <p><strong>Nama:</strong> {{ $guest->name }}</p>
    <p><strong>Suhu:</strong> {{ $diagnosis->suhu }} °C</p>
    <p><strong>Detak Jantung:</strong> {{ $diagnosis->detak_jantung }} bpm</p>
    <p><strong>Mood:</strong> {{ $diagnosis->mood }}</p>
    <p><strong>Snack Rekomendasi:</strong> {{ optional($diagnosis->snack)->name ?? '-' }}</p>
</body>
</html>
