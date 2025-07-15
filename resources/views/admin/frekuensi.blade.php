@extends('layouts.app')

@section('content')
<div class="py-8">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">🍿 Frekuensi Konsumsi Snack</h1>

        {{-- Ringkasan Top Snack --}}
        <div class="bg-white p-6 rounded-lg shadow mb-6">
            <h2 class="text-xl font-bold mb-4 text-gray-700">🥇 Snack Paling Sering Dikonsumsi</h2>
            <ul class="divide-y divide-gray-200">
                @forelse($topSnacks as $snack)
                    <li class="py-2 flex justify-between">
                        <span>{{ $snack->nama_snack }}</span>
                        <span class="font-semibold text-gray-800">{{ $snack->jumlah }}x</span>
                    </li>
                @empty
                    <li class="py-2 text-gray-500">Belum ada data konsumsi snack.</li>
                @endforelse
            </ul>
        </div>

        {{-- Chart Frekuensi --}}
        <div class="bg-white p-6 rounded-lg shadow mb-6">
            <h2 class="text-xl font-bold mb-4 text-gray-700">📊 Grafik Frekuensi Konsumsi Snack</h2>
            <canvas id="snackFrequencyChart"></canvas>
        </div>

        {{-- Tabel Detail Frekuensi --}}
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl font-bold mb-4 text-gray-700">📋 Detail Frekuensi</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200 rounded">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 border">#</th>
                            <th class="px-4 py-2 border">Nama Snack</th>
                            <th class="px-4 py-2 border">Total Konsumsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($topSnacks as $index => $snack)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border text-center">{{ $index + 1 }}</td>
                            <td class="px-4 py-2 border">{{ $snack->nama_snack }}</td>
                            <td class="px-4 py-2 border text-center">{{ $snack->jumlah }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center text-gray-500 py-4">Tidak ada data.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const snackData = @json($topSnacks);

    const labels = snackData.map(item => item.nama_snack);
    const data = snackData.map(item => item.jumlah);
    const colors = [
        '#f87171', '#60a5fa', '#34d399', '#fbbf24', '#a78bfa',
        '#f472b6', '#38bdf8', '#facc15', '#4ade80', '#c084fc'
    ];

    const ctx = document.getElementById('snackFrequencyChart').getContext('2d');
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: labels,
            datasets: [{
                label: 'Frekuensi Konsumsi',
                data: data,
                backgroundColor: colors,
                borderColor: 'white',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
</script>
@endsection
