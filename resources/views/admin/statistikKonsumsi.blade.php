@extends('layouts.app')

@section('content')
<div class="py-8">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Statistik Konsumsi Snack</h1>

        <div class="bg-white p-6 rounded-lg shadow mb-8">
            <h2 class="text-lg font-semibold mb-4">Per Hari</h2>
            <canvas id="chartHarian"></canvas>
        </div>

        <div class="bg-white p-6 rounded-lg shadow mb-8">
            <h2 class="text-lg font-semibold mb-4">Per Minggu</h2>
            <canvas id="chartMingguan"></canvas>
        </div>

        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-lg font-semibold mb-4">Per Bulan</h2>
            <canvas id="chartBulanan"></canvas>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Data dari controller
    const harian = @json($harian);
    const mingguan = @json($mingguan);
    const bulanan = @json($bulanan);

    // Helper untuk transform data per kategori
    function prepareChartData(data, labelField) {
        const categories = [...new Set(data.map(item => item.kategori))];
        const labels = [...new Set(data.map(item => item[labelField]))].sort();
        const datasets = categories.map(cat => {
            return {
                label: cat,
                data: labels.map(l => {
                    const found = data.find(d => d[labelField] === l && d.kategori === cat);
                    return found ? found.jumlah : 0;
                }),
                fill: false,
                borderColor: randomColor(),
                tension: 0.1
            }
        });
        return { labels, datasets };
    }

    // Random color generator
    function randomColor() {
        return `hsl(${Math.random() * 360}, 70%, 50%)`;
    }

    // Render chart harian
    const ctxHarian = document.getElementById('chartHarian').getContext('2d');
    const dataHarian = prepareChartData(harian, 'tanggal');
    new Chart(ctxHarian, {
        type: 'line',
        data: dataHarian
    });

    // Render chart mingguan
    const ctxMingguan = document.getElementById('chartMingguan').getContext('2d');
    const dataMingguan = prepareChartData(mingguan, 'minggu');
    new Chart(ctxMingguan, {
        type: 'line',
        data: dataMingguan
    });

    // Render chart bulanan
    const ctxBulanan = document.getElementById('chartBulanan').getContext('2d');
    const dataBulanan = prepareChartData(bulanan, 'bulan');
    new Chart(ctxBulanan, {
        type: 'line',
        data: dataBulanan
    });
</script>
@endsection
