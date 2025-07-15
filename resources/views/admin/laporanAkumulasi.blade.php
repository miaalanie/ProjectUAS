@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">📊 Laporan Akumulasi</h1>

    {{-- Ringkasan Data --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-blue-500 text-black p-4 rounded-lg shadow">
            <div class="text-lg">👥 Total Pengguna</div>
            <div class="text-2xl font-bold">{{ $totalUsers }}</div>
        </div>
        <div class="bg-green-500 text-black p-4 rounded-lg shadow">
            <div class="text-lg">🍫 Total Snack</div>
            <div class="text-2xl font-bold">{{ $totalSnacks }}</div>
        </div>
        <div class="bg-yellow-500 text-black p-4 rounded-lg shadow">
            <div class="text-lg">📅 Periode Data</div>
            <div class="text-xl font-semibold">{{ $periode }}</div>
        </div>
    </div>

    {{-- Grafik Konsumsi Snack --}}
    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <h2 class="text-xl font-bold mb-4 text-gray-700">📈 Grafik Konsumsi Snack per Bulan</h2>
        <canvas id="snackChart" height="120"></canvas>
    </div>

    {{-- Grafik Mood --}}
    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <h2 class="text-xl font-bold mb-4 text-gray-700">😞 Persentase Mood Pengguna</h2>
        <canvas id="moodChart" height="120"></canvas>
    </div>

    {{-- Tabel Akumulasi Snack --}}
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-bold mb-4 text-gray-700">📃 Tabel Akumulasi Snack</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-200 rounded">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border">No</th>
                        <th class="px-4 py-2 border">Nama Snack</th>
                        <th class="px-4 py-2 border">Total Konsumsi</th>
                        <th class="px-4 py-2 border">Pengguna Terbanyak</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($akumulasiSnack as $index => $snack)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border text-center">{{ $index + 1 }}</td>
                        <td class="px-4 py-2 border">{{ $snack['nama'] }}</td>
                        <td class="px-4 py-2 border text-center">{{ $snack['total_konsumsi'] }}</td>
                        <td class="px-4 py-2 border">{{ $snack['pengguna_terbanyak'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Tombol Export --}}
    <div class="flex justify-end gap-2 mt-6">
        <a href="{{ route('admin.pengguna.export.excel') }}" class="bg-green-500 hover:bg-green-600 text-black px-4 py-2 rounded shadow">
            <i class="fas fa-file-excel mr-1"></i> Export Excel
        </a>
        <a href="{{ route('admin.pengguna.export.pdf') }}" class="bg-red-500 hover:bg-red-600 text-black px-4 py-2 rounded shadow">
            <i class="fas fa-file-pdf mr-1"></i> Export PDF
        </a>
    </div>
</div>

{{-- Chart.js CDN --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Grafik Konsumsi Snack
    const ctxSnack = document.getElementById('snackChart').getContext('2d');
    new Chart(ctxSnack, {
        type: 'bar',
        data: {
            labels: {!! json_encode($snackChart['labels']) !!},
            datasets: [{
                label: 'Total Konsumsi',
                data: {!! json_encode($snackChart['data']) !!},
                backgroundColor: 'rgba(59, 130, 246, 0.7)',
                borderColor: 'rgba(59, 130, 246, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: { y: { beginAtZero: true } }
        }
    });

    // Grafik Mood
    const ctxMood = document.getElementById('moodChart').getContext('2d');
    new Chart(ctxMood, {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($moodChart['labels']) !!},
            datasets: [{
                label: 'Persentase',
                data: {!! json_encode($moodChart['data']) !!},
                backgroundColor: [
                    'rgba(34, 197, 94, 0.7)',
                    'rgba(239, 68, 68, 0.7)',
                    'rgba(251, 191, 36, 0.7)'
                ],
                borderColor: [
                    'rgba(34, 197, 94, 1)',
                    'rgba(239, 68, 68, 1)',
                    'rgba(251, 191, 36, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'bottom' }
            }
        }
    });
</script>
@endsection
