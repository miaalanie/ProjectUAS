@extends('layouts.app')

@section('content')
<div class="py-8">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Log Mood</h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            {{-- Grafik Per Hari --}}
            <div class="bg-white p-4 rounded shadow">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">Mood Terbanyak Per Hari</h2>
                <canvas id="chartHari"></canvas>
            </div>

            {{-- Grafik Per Minggu --}}
            <div class="bg-white p-4 rounded shadow">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">Mood Terbanyak Per Minggu</h2>
                <canvas id="chartMinggu"></canvas>
            </div>

            {{-- Grafik Per Bulan --}}
            <div class="bg-white p-4 rounded shadow">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">Mood Terbanyak Per Bulan</h2>
                <canvas id="chartBulan"></canvas>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Data Per Hari
    const hariLabels = @json($moodPerHari->pluck('tanggal'));
    const hariData = @json($moodPerHari->pluck('jumlah'));

    const chartHari = new Chart(document.getElementById('chartHari'), {
        type: 'bar',
        data: {
            labels: hariLabels,
            datasets: [{
                label: 'Jumlah Mood',
                data: hariData,
                backgroundColor: 'rgba(75, 192, 192, 0.6)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1,
            }]
        },
        options: {
            scales: {
                y: { beginAtZero: true }
            }
        }
    });

    // Data Per Minggu
    const mingguLabels = @json($moodPerMinggu->pluck('minggu'));
    const mingguData = @json($moodPerMinggu->pluck('jumlah'));

    const chartMinggu = new Chart(document.getElementById('chartMinggu'), {
        type: 'line',
        data: {
            labels: mingguLabels,
            datasets: [{
                label: 'Jumlah Mood',
                data: mingguData,
                backgroundColor: 'rgba(153, 102, 255, 0.6)',
                borderColor: 'rgba(153, 102, 255, 1)',
                fill: true,
                tension: 0.4,
            }]
        },
        options: {
            scales: {
                y: { beginAtZero: true }
            }
        }
    });

    // Data Per Bulan
    const bulanLabels = @json($moodPerBulan->pluck('bulan'));
    const bulanData = @json($moodPerBulan->pluck('jumlah'));

    const chartBulan = new Chart(document.getElementById('chartBulan'), {
        type: 'pie',
        data: {
            labels: bulanLabels,
            datasets: [{
                label: 'Jumlah Mood',
                data: bulanData,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.6)',
                    'rgba(54, 162, 235, 0.6)',
                    'rgba(255, 206, 86, 0.6)',
                    'rgba(75, 192, 192, 0.6)',
                    'rgba(153, 102, 255, 0.6)'
                ]
            }]
        }
    });
</script>
@endsection
