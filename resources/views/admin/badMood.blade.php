@extends('layouts.app')

@section('content')
<div class="py-8">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">📊 Monitoring Bad Mood Per Hari</h1>

        {{-- Alert jika ada bad mood hari ini --}}
        @php
            $today = \Carbon\Carbon::now()->format('Y-m-d');
            $todayBadMood = collect($badMoodData)->firstWhere('tanggal', $today);
        @endphp

        @if($todayBadMood && $todayBadMood->jumlah > 0)
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
                <strong class="font-bold">⚠️ Perhatian!</strong>
                <span class="block sm:inline">Hari ini ada <b>{{ $todayBadMood->jumlah }}</b> laporan bad mood.</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <button onclick="this.parentElement.parentElement.remove()" class="text-red-500 hover:text-red-700">&times;</button>
                </span>
            </div>
        @endif

        {{-- Chart --}}
        <div class="bg-white p-6 rounded-lg shadow">
            <canvas id="badMoodChart"></canvas>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const badMoodData = @json($badMoodData);

    const labels = badMoodData.map(item => item.tanggal);
    const data = badMoodData.map(item => item.jumlah);

    const ctx = document.getElementById('badMoodChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Jumlah Bad Mood per Hari',
                data: data,
                fill: true,
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgb(255, 99, 132)',
                tension: 0.3
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    labels: {
                        color: 'rgb(55, 65, 81)' // Tailwind gray-700
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                },
                x: {
                    ticks: {
                        color: 'rgb(55, 65, 81)' // Tailwind gray-700
                    }
                }
            }
        }
    });
</script>
@endsection
