@extends('layouts.app')

@section('content')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>AOS.init();</script>

<style>
  body {
    background: linear-gradient(135deg, #f3f8ff 60%, #eef2ff 100%);
    font-family: 'Nunito', 'Segoe UI', Arial, sans-serif;
  }
  .dashboard-bg {
    min-height: 100vh;
    background: none;
    padding: 2.5rem 0 2rem 0;
  }
  .dashboard-title {
    font-size: 2.5rem;
    font-weight: 900;
    color: #29469a;
    margin-bottom: 2.5rem;
    text-align: center;
    letter-spacing: 1px;
    text-shadow: 0 2px 12px #7b6ef622;
  }
  .dashboard-cards {
    display: flex;
    flex-wrap: wrap;
    gap: 2.2rem;
    justify-content: center;
    max-width: 1200px;
    margin: 0 auto 2.5rem auto;
  }
  /* Hapus duplikat dashboard-card, gunakan chart-card saja untuk chart */
  .chart-card {
    background: rgba(255,255,255,0.65);
    border-radius: 1.5rem;
    box-shadow: 0 8px 32px 0 rgba(102,126,234,0.10), 0 1.5px 8px 0 rgba(123,110,246,0.08);
    padding: 2.2rem 2.2rem 1.5rem 2.2rem;
    width: 100%;
    display: flex;
    flex-direction: column;
    align-items: stretch;
    min-height: 340px;
    position: relative;
    overflow: visible;
    border: 1.5px solid #e3e7fa;
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
    transition: box-shadow 0.2s, transform 0.2s;
  }
  .chart-card:hover {
    box-shadow: 0 12px 40px #7b6ef655, 0 2px 8px #7b6ef611;
    transform: translateY(-4px) scale(1.04);
    border-color: #7b6ef6;
  }
  .chart-title {
    font-weight: 900;
    font-size: 1.35rem;
    color: #7b6ef6;
    margin-bottom: 1.1rem;
    letter-spacing: 0.2px;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    text-shadow: 0 2px 8px #7b6ef622;
  }
  @media (max-width: 991.98px) {
    .chart-card { padding: 1.2rem 0.7rem 1.2rem 0.7rem; min-height: 220px; }
    .chart-title { font-size: 1.1rem; }
  }

  .dashboard-card {
    background: rgba(255,255,255,0.65);
    border-radius: 1.5rem;
    box-shadow: 0 8px 32px 0 rgba(102,126,234,0.12), 0 1.5px 8px 0 rgba(123,110,246,0.08);
    padding: 2.2rem 2.2rem 1.5rem 2.2rem;
    min-width: 220px;
    max-width: 320px;
    width: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    transition: box-shadow 0.2s, transform 0.2s;
    cursor: pointer;
    position: relative;
    border: 1.5px solid #e3e7fa;
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
  }
  .dashboard-card:hover {
    box-shadow: 0 12px 40px #7b6ef655, 0 2px 8px #7b6ef611;
    transform: translateY(-4px) scale(1.04);
  }
  .dashboard-icon {
    font-size: 2.7rem;
    margin-bottom: 1rem;
    color: #7b6ef6;
    opacity: 0.85;
  }
  .dashboard-label {
    font-size: 1.1rem;
    color: #5a5a7a;
    font-weight: 600;
    margin-bottom: 0.3rem;
    text-align: center;
  }
  .dashboard-value {
    font-size: 2.1rem;
    font-weight: 800;
    color: #437ab5;
    margin-bottom: 0.2rem;
    text-align: center;
  }
  @media (max-width: 991.98px) {
    .dashboard-cards { gap: 1.2rem; }
    .dashboard-card { min-width: 180px; max-width: 100%; }
  }
  @media (max-width: 767.98px) {
    .dashboard-cards { flex-direction: column; align-items: center; }
    .dashboard-card { width: 100%; min-width: 0; }
  }
</style>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="dashboard-bg">
  <div class="dashboard-title" data-aos="fade-down" data-aos-duration="900">
    Selamat Datang di Dashboard
  </div>
  <!-- Grafik Section mirip admin -->
  <div class="container-fluid">
    <div class="row">
      <!-- Area Chart -->
      <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4 chart-card" data-aos="fade-up" data-aos-delay="100" style="border-radius:1.5rem;">
          <div class="card-header py-3" style="background:transparent;border-bottom:none;">
            <h6 class="m-0 font-weight-bold text-primary chart-title">Grafik Diagnosis per Hari</h6>
          </div>
          <div class="card-body">
            <div class="chart-area">
              <canvas id="diagnosisPerDayChart" height="120"></canvas>
            </div>
            <hr>
            <span style="font-size:0.95rem;color:#7b6ef6;">Menampilkan distribusi total mood pengguna.</span>
          </div>
        </div>
      </div>
      <!-- Donut Chart -->
      <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-4 chart-card" data-aos="fade-up" data-aos-delay="200" style="border-radius:1.5rem;">
          <div class="card-header py-3" style="background:transparent;border-bottom:none;">
            <h6 class="m-0 font-weight-bold text-primary chart-title">Distribusi Mood</h6>
          </div>
          <div class="card-body">
            <div class="chart-pie pt-4" style="display:flex;flex-direction:column;align-items:center;">
              <canvas id="moodDistributionChart" width="260" height="220" style="max-width:100%;"></canvas>
            </div>
            <hr>
            <span style="font-size:0.95rem;color:#7b6ef6;">Menampilkan jumlah diagnosis per hari berdasarkan data terbaru.</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
  .chart-card {
    background: rgba(255,255,255,0.65);
    border-radius: 1.5rem;
    box-shadow: 0 8px 32px 0 rgba(102,126,234,0.12), 0 1.5px 8px 0 rgba(123,110,246,0.08);
    padding: 2.2rem 2.2rem 1.5rem 2.2rem;
    width: 100%;
    display: flex;
    flex-direction: column;
    align-items: stretch;
    min-height: 340px;
    position: relative;
    overflow: visible;
    border: 1.5px solid #e3e7fa;
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
  }
  .chart-title {
    font-weight: 800;
    font-size: 1.3rem;
    color: #7b6ef6;
    margin-bottom: 1.1rem;
    letter-spacing: 0.2px;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    text-shadow: 0 2px 8px #7b6ef622;
  }
  @media (max-width: 991.98px) {
    .chart-card { padding: 1.2rem 0.7rem 1.2rem 0.7rem; min-height: 220px; }
    .chart-title { font-size: 1.1rem; }
  }
</style>

<script>
// Helper: draw value labels on bars
function drawBarValueLabels(chart) {
  const ctx = chart.ctx;
  ctx.save();
  chart.data.datasets.forEach((dataset, i) => {
    chart.getDatasetMeta(i).data.forEach((bar, j) => {
      const value = dataset.data[j];
      if (bar && value !== undefined) {
        ctx.font = 'bold 1.1rem Nunito, sans-serif';
        ctx.fillStyle = '#1e3a8a';
        ctx.textAlign = 'center';
        ctx.textBaseline = 'bottom';
        ctx.shadowColor = '#7b6ef6aa';
        ctx.shadowBlur = 6;
        ctx.fillText(value, bar.x, bar.y - 8);
        ctx.shadowBlur = 0;
      }
    });
  });
  ctx.restore();
}


// ...existing code...

// Diagnosis per Day Chart
fetch('/api/dashboard/diagnosis-per-day')
  .then(res => res.json())
  .then(data => {
    const labels = data.map(item => item.date);
    const values = data.map(item => item.total);
    const ctx = document.getElementById('diagnosisPerDayChart').getContext('2d');
    Chart.defaults.backgroundColor = 'rgba(123,110,246,0.04)';
    const chart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: labels,
        datasets: [{
          label: 'Diagnosis',
          data: values,
          backgroundColor: function(context) {
            const chart = context.chart;
            const {ctx, chartArea} = chart;
            if (!chartArea) return '#e3e7fa';
            const gradient = ctx.createLinearGradient(0, chartArea.bottom, 0, chartArea.top);
            gradient.addColorStop(0, '#e3e7fa');
            gradient.addColorStop(0.5, '#bfc8f8');
            gradient.addColorStop(1, '#7b6ef6');
            return gradient;
          },
          borderColor: '#bfc8f8',
          borderWidth: 2.5,
          borderRadius: 16,
          hoverBackgroundColor: '#1e3a8a',
          barPercentage: 0.68,
          categoryPercentage: 0.68,
        }]
      },
      options: {
        responsive: true,
        animation: { duration: 1400, easing: 'easeOutBack' },
        plugins: {
          legend: { display: false },
          tooltip: {
            enabled: true,
            backgroundColor: '#fff',
            titleColor: '#7b6ef6',
            bodyColor: '#1e3a8a',
            borderColor: '#bfc8f8',
            borderWidth: 1,
            padding: 12,
            caretSize: 7,
            cornerRadius: 8
          },
        },
        scales: {
          x: { grid: { display: false }, ticks: { color: '#7b6ef6', font: { weight: 'bold' } } },
          y: { beginAtZero: true, ticks: { precision:0, color: '#1e3a8a', font: { weight: 'bold' } }, grid: { color: '#e3e7fa' } }
        },
        layout: { padding: { top: 18, bottom: 18, left: 8, right: 8 } },
      },
      plugins: [{
        id: 'barValueLabels',
        afterDatasetsDraw: drawBarValueLabels
      }]
    });
  });

// Mood Distribution Chart
fetch('/api/dashboard/mood-distribution')
  .then(res => res.json())
  .then(data => {
    const labels = data.map(item => item.mood.charAt(0).toUpperCase() + item.mood.slice(1));
    const values = data.map(item => item.total);
    // Biru pastel
    const colors = ['#bfc8f8','#e3e7fa','#7b6ef6','#1e3a8a','#4e73df','#e0e7ff','#f3f8ff'];
    const borderColors = ['#bfc8f8','#e3e7fa','#7b6ef6','#1e3a8a','#4e73df','#e0e7ff','#f3f8ff'];
    const ctx = document.getElementById('moodDistributionChart').getContext('2d');
    const total = values.reduce((a,b)=>a+b,0);
    const centerText = {
      id: 'centerText',
      afterDraw(chart) {
        const {ctx, chartArea: {left, right, top, bottom, width, height}} = chart;
        ctx.save();
        ctx.font = 'bold 2.7rem Nunito, sans-serif';
        ctx.fillStyle = '#4e73df';
        ctx.textAlign = 'center';
        ctx.textBaseline = 'middle';
        ctx.shadowColor = '#bfc8f8';
        ctx.shadowBlur = 10;
        ctx.fillText(total, left + width/2, top + height/2);
        ctx.font = 'bold 1.3rem Nunito, sans-serif';
        ctx.fillStyle = '#29469a';
        ctx.shadowBlur = 0;
        ctx.fillText('Total', left + width/2, top + height/2 + 32);
        ctx.restore();
      }
    };
    new Chart(ctx, {
      type: 'doughnut',
      data: {
        labels: labels,
        datasets: [{
          data: values,
          backgroundColor: colors,
          borderColor: borderColors,
          borderWidth: 4,
          hoverOffset: 22,
        }]
      },
      options: {
        responsive: true,
        animation: { animateRotate: true, duration: 1500, easing: 'easeOutBack' },
        plugins: {
          legend: { position: 'bottom', labels: { color: '#29469a', font: { weight: 'bold', size: 18 } } },
          tooltip: {
            enabled: true,
            backgroundColor: '#fff',
            titleColor: '#4e73df',
            bodyColor: '#29469a',
            borderColor: '#bfc8f8',
            borderWidth: 1,
            padding: 16,
            caretSize: 10,
            cornerRadius: 12
          },
        },
        cutout: '65%',
        layout: { padding: { top: 18, bottom: 18 } },
      },
      plugins: [centerText]
    });
  });
</script>

@endsection