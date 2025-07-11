@extends('layouts.app')

@section('content')
<div class="py-8">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Riwayat Snack</h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Harian -->
            <div class="bg-white p-4 rounded shadow">
                <h2 class="text-lg font-semibold text-gray-700 mb-2">Harian</h2>
                <canvas id="chartHarian"></canvas>
            </div>

            <!-- Mingguan -->
            <div class="bg-white p-4 rounded shadow">
                <h2 class="text-lg font-semibold text-gray-700 mb-2">Mingguan</h2>
                <canvas id="chartMingguan"></canvas>
            </div>

            <!-- Bulanan -->
            <div class="bg-white p-4 rounded shadow">
                <h2 class="text-lg font-semibold text-gray-700 mb-2">Bulanan</h2>
                <canvas id="chartBulanan"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Chart Harian
    const ctxHarian = document.getElementById('chartHarian');
    new Chart(ctxHarian, {
        type: 'bar',
        data: {
            labels: {!! json_encode($harian->pluck('tanggal')) !!},
            datasets: [{
                label: 'Snack diambil',
                data: {!! json_encode($harian->pluck('jumlah')) !!},
                backgroundColor: 'rgba(75, 192, 192, 0.6)'
            }]
        }
    });

    // Chart Mingguan
    const ctxMingguan = document.getElementById('chartMingguan');
    new Chart(ctxMingguan, {
        type: 'line',
        data: {
            labels: {!! json_encode($mingguan->pluck('minggu')) !!},
            datasets: [{
                label: 'Snack diambil',
                data: {!! json_encode($mingguan->pluck('jumlah')) !!},
                backgroundColor: 'rgba(153, 102, 255, 0.6)',
                borderColor: 'rgba(153, 102, 255, 1)',
                fill: true
            }]
        }
    });

    // Chart Bulanan
    const ctxBulanan = document.getElementById('chartBulanan');
    new Chart(ctxBulanan, {
        type: 'pie',
        data: {
            labels: {!! json_encode($bulanan->pluck('bulan')) !!},
            datasets: [{
                label: 'Snack diambil',
                data: {!! json_encode($bulanan->pluck('jumlah')) !!},
                backgroundColor: [
                    'rgba(255, 99, 132, 0.6)',
                    'rgba(54, 162, 235, 0.6)',
                    'rgba(255, 206, 86, 0.6)',
                    'rgba(75, 192, 192, 0.6)',
                    'rgba(153, 102, 255, 0.6)',
                    'rgba(255, 159, 64, 0.6)'
                ]
            }]
        }
    });
</script>
@endpush
