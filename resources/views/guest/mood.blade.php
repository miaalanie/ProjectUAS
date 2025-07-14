
@extends('layouts.app')

@section('content')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>AOS.init();</script>

<style>
  .floating-emoji {
    position: absolute;
    opacity: 0.7;
    animation: float 6s ease-in-out infinite;
    z-index: 0;
  }
  @keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-20px); }
  }
  .diagnosa-card {
    background-color: white;
    border-radius: 1rem;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    cursor: default;
    padding: 2rem 2rem;
    box-shadow: 0 0 10px rgba(0,0,0,0.05);
    max-width: 1000px;
    width: 100%;
    margin: auto;
  }
  .diagnosa-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
  }
</style>

<div class="position-relative min-vh-100 d-flex align-items-center justify-content-center overflow-hidden" style="background: linear-gradient(135deg, #f3f8ff, #ffe4f2); padding: 2rem 1rem;">
  <!-- Floating Emojis -->
  <div class="floating-emoji" style="top: 10%; left: 5%; font-size: 2rem;">😊</div>
  <div class="floating-emoji" style="top: 20%; right: 10%; font-size: 2.2rem;">😐</div>
  <div class="floating-emoji" style="bottom: 15%; left: 10%; font-size: 2rem;">😢</div>
  <div class="floating-emoji" style="bottom: 10%; right: 15%; font-size: 2.4rem;">😡</div>
  <div class="floating-emoji" style="top: 50%; left: 45%; font-size: 1.8rem;">😋</div>

  <!-- Card Content -->
  <div class="diagnosa-card text-center" data-aos="zoom-in" data-aos-duration="1000">
    <h2 class="fw-bold text-primary mb-2">Mood</h2>
    <h5 class="mb-4">Visualisasi Himpunan Fuzzy Mood</h5>

    <!-- Grafik -->
    <div class="mb-5" style="height: 300px;">
      @if($fuzzyMood->count() > 0)
        <canvas id="fuzzyMoodChart"></canvas>
      @else
        <div class="alert alert-warning">Data mood fuzzy tidak tersedia.</div>
      @endif
    </div>

    <!-- Kartu Kategori -->
    <div class="row">
      @foreach($fuzzyMood as $row)
        <div class="col-md-3 mb-3">
          <div style="
            background: linear-gradient(135deg, #f3f0ff, #ffe4f2);
            border-radius: 16px;
            padding: 1rem;
            box-shadow: 0 8px 20px rgba(174, 201, 255, 0.15);
            border-left: 6px solid #b3caff;
            transition: transform 0.3s ease;
            text-align: center;
          " onmouseover="this.style.transform='scale(1.03)'" onmouseout="this.style.transform='scale(1)'">
            <div style="font-size: 1.8rem;">😋</div>
            <h5 style="color: #3366d6; font-weight: bold;">{{ $row->jenis_mood }}</h5>
            <div style="font-size: 0.95rem; color: #555;">
              <strong>Min:</strong> {{ $row->min !== null ? number_format($row->min, 2) : '-' }}
            </div>
            <div style="font-size: 0.95rem; color: #555;">
              <strong>Max:</strong> {{ $row->max !== null ? number_format($row->max, 2) : '-' }}
            </div>
            <div style="font-size: 0.85rem; color: #888;">Keterangan: {{ $row->keterangan ?? '-' }}</div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
@if($fuzzyMood->count() > 0)
<script id="fuzzy-mood-labels" type="application/json">
  {!! json_encode($fuzzyMood->pluck('jenis_mood')->toArray()) !!}
</script>
<script id="fuzzy-mood-min" type="application/json">
  {!! json_encode($fuzzyMood->pluck('min')->toArray()) !!}
</script>
<script id="fuzzy-mood-max" type="application/json">
  {!! json_encode($fuzzyMood->pluck('max')->toArray()) !!}
</script>
@endif

@if($fuzzyMood->count() > 0)
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const canvas = document.getElementById('fuzzyMoodChart');
    if (!canvas) return;
    const ctx = canvas.getContext('2d');
    const labels = JSON.parse(document.getElementById('fuzzy-mood-labels').textContent);
    const minData = JSON.parse(document.getElementById('fuzzy-mood-min').textContent);
    const maxData = JSON.parse(document.getElementById('fuzzy-mood-max').textContent);

    // Data: rentang mood (max-min) untuk setiap label
    const rentangData = labels.map((_, i) => {
      const min = minData[i] ?? 0;
      const max = maxData[i] ?? min + 1;
      return max - min;
    });

    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: labels,
        datasets: [{
          label: 'Rentang Mood',
          data: rentangData,
          backgroundColor: 'rgba(54, 102, 214, 0.4)',
          borderColor: 'rgba(54, 102, 214, 1)',
          borderWidth: 2,
          borderRadius: 8
        }]
      },
      options: {
        indexAxis: 'y',
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: { display: false },
          tooltip: {
            callbacks: {
              label: function (context) {
                const min = minData[context.dataIndex];
                const max = maxData[context.dataIndex];
                return `Rentang: ${min ?? '-'} - ${max ?? '-' }`;
              }
            }
          }
        },
        scales: {
          x: {
            title: { display: true, text: 'Nilai Mood' },
            grid: { color: '#eee' },
          },
          y: {
            ticks: { font: { size: 14 } },
            grid: { color: '#f8f8f8' }
          }
        }
      }
    });
  });
</script>
@endif

@endsection
