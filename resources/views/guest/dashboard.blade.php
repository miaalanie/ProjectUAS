@extends('layouts.app')

@section('content')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>AOS.init();</script>

<style>
  .card-solid {
    background: white;
    border-radius: 1.5rem;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    padding: 1.5rem;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }
  .card-solid:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
  }
  .chart-container {
    height: 220px;
  }
  .mood-section {
    margin-top: 3rem;
  }
  .mood-item {
    background: #f3e5f5;
    border-radius: 1rem;
    padding: 1.2rem;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }
  .mood-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
  }
</style>

<div class="py-12" style="background: linear-gradient(135deg, #f3e5f5, #e1f5fe); min-height: 100vh;">
  <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
    <!-- Welcome -->
    <div class="text-center mb-10">
      <h1 class="text-4xl font-bold text-purple-700 mb-3">👋 Selamat Datang Guest!</h1>
      <p class="text-gray-700 text-lg">
        Yuk cek mood kamu hari ini dan temukan tips-tips menarik! 🌈
      </p>
    </div>

    <!-- Statistik + Mood Hari Ini -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
      <!-- Statistik -->
      <div class="col-span-2">
        <div class="card-solid" data-aos="fade-right">
          <h2 class="text-xl font-semibold text-blue-700 mb-3">📊 Statistik Mood Mingguan</h2>
          <div class="chart-container">
            <canvas id="moodChart"></canvas>
          </div>
        </div>
      </div>

      <!-- Mood Hari Ini -->
      <div>
        <div class="card-solid text-center" data-aos="fade-left">
          <h2 class="text-xl font-semibold text-pink-600 mb-2">⚡ Mood Hari Ini</h2>
          <p class="text-gray-700">
            Ayo cek mood mu hari ini! Jangan sampai salah melangkah atau kamu akan marahh! 😡
          </p>
          <p class="mt-3 text-blue-600 font-semibold">
            Info lebih lanjut ayo <a href="{{ route('login') }}" class="underline">login dulu</a>.
          </p>
        </div>
      </div>
    </div>

    <!-- Informasi Mood -->
    <div class="mood-section">
      <h2 class="text-2xl font-bold text-purple-700 mb-6 text-center" data-aos="fade-up">🧠 Tips & Fakta Seputar Mood</h2>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="mood-item" data-aos="fade-up" data-aos-delay="100">
          <h3 class="text-lg font-semibold text-indigo-700 mb-2">💤 Mood & Tidur</h3>
          <p>Kurang tidur bisa meningkatkan emosi negatif hingga 60%. Tidur cukup membantu mood lebih stabil dan positif.</p>
        </div>
        <div class="mood-item" data-aos="fade-up" data-aos-delay="200">
          <h3 class="text-lg font-semibold text-indigo-700 mb-2">🍫 Cokelat & Mood</h3>
          <p>Makan dark chocolate meningkatkan serotonin & endorfin, membuat kamu merasa lebih bahagia.</p>
        </div>
        <div class="mood-item" data-aos="fade-up" data-aos-delay="300">
          <h3 class="text-lg font-semibold text-indigo-700 mb-2">🚶‍♀️ Bergerak untuk Bahagia</h3>
          <p>Jalan kaki 10 menit saja sudah cukup untuk memperbaiki mood dan mengurangi stres.</p>
        </div>
        <div class="mood-item" data-aos="fade-up" data-aos-delay="400">
          <h3 class="text-lg font-semibold text-indigo-700 mb-2">🌞 Cahaya Matahari</h3>
          <p>Paparan sinar matahari pagi membantu tubuh memproduksi vitamin D yang penting untuk mood positif.</p>
        </div>
      </div>
    </div>

    <!-- Button Diagnosa -->
    <div class="text-center mt-10" data-aos="zoom-in">
      <a href="{{ route('guest.diagnosa') }}" 
         class="inline-block px-6 py-3 bg-gradient-to-r from-purple-500 to-pink-500 text-white text-lg font-semibold rounded-full shadow-lg hover:scale-105 transition">
        🚀 Mulai Diagnosa Mood
      </a>
    </div>
  </div>
</div>

<script>
  const ctx = document.getElementById('moodChart').getContext('2d');
  new Chart(ctx, {
    type: 'line',
    data: {
      labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
      datasets: [{
        label: 'Level Mood',
        data: [65, 80, 75, 60, 70, 50, 85],
        borderColor: '#7e57c2',
        backgroundColor: 'rgba(126, 87, 194, 0.2)',
        fill: true,
        tension: 0.4
      }]
    },
    options: {
      responsive: true,
      scales: {
        y: { beginAtZero: true, max: 100 }
      }
    }
  });
</script>
@endsection
