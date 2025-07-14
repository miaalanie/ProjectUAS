@extends('layouts.app')

@section('content')
<!-- AOS & Animate.css -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>AOS.init();</script>

<!-- Floating Emoji Animation -->
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

  .diagnosa-step {
    background-color: white;
    border-radius: 1rem;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    cursor: default;
    padding: 2rem 1rem;
    height: 100%;
    box-shadow: 0 0 10px rgba(0,0,0,0.05);
  }

  .diagnosa-step:hover {
    transform: translateY(-6px);
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
  }

  .diagnosa-icon {
    font-size: 3.5rem;
  }

  .diagnosa-text {
    font-weight: 500;
    margin-top: 1rem;
    font-size: 1.1rem;
  }
</style>

<!-- Hero Section -->
<div class="position-relative min-vh-100 d-flex align-items-center justify-content-center overflow-hidden" style="background: linear-gradient(135deg, #eef2ff, #f3f8ff);">
  
  <!-- Floating Emojis -->
  <div class="floating-emoji" style="top: 10%; left: 5%; font-size: 2rem;">🍫</div>
  <div class="floating-emoji" style="top: 20%; right: 10%; font-size: 2.2rem;">🍟</div>
  <div class="floating-emoji" style="bottom: 15%; left: 10%; font-size: 2rem;">❤️</div>
  <div class="floating-emoji" style="bottom: 10%; right: 15%; font-size: 2.4rem;">🧠</div>
  <div class="floating-emoji" style="top: 50%; left: 45%; font-size: 1.8rem;">😋</div>

  <!-- Card Content -->
  <div class="card border-0 shadow-lg px-5 py-5 text-center" style="max-width: 960px; width: 100%; background-color: rgba(255, 255, 255, 0.92);" data-aos="zoom-in" data-aos-duration="1000">
    <h1 class="display-5 fw-bold text-primary mb-3">🍿 Diagnosa Mood & Snack 🧠</h1>
    <p class="text-muted fs-5 mb-1">
      Temukan cemilan yang cocok berdasarkan <strong>mood</strong> kamu hari ini!<br>
      Deteksi dari ❤️ <span class="text-danger">detak jantung</span> dan 🌡️ <span class="text-warning">suhu tubuh</span> kamu secara <i>real-time</i>.
    </p>
    <p class="fst-italic text-muted mt-2">“Karena hidup terlalu singkat untuk snack yang salah!” 😄</p>

    <!-- Steps -->
    <div class="row justify-content-center mt-5 mb-4">
      @php
        $steps = [
          ['icon' => '🌡️', 'text' => 'Suhu Tubuh', 'route' => 'guest.suhu'],
          ['icon' => '❤️', 'text' => 'Detak Jantung', 'route' => 'guest.heartRate'],
          ['icon' => '🧠', 'text' => 'Deteksi Mood', 'route' => 'guest.mood'],
          ['icon' => '🍟', 'text' => 'Rekomendasi Snack', 'route' => 'guest.snack']
        ];
      @endphp

      @foreach ($steps as $index => $step)
        <div class="col-6 col-md-3 mb-4" data-aos="fade-up" data-aos-delay="{{ $index * 200 }}">
          <a href="{{ route($step['route']) }}" class="text-decoration-none">
            <div class="diagnosa-step">
              <div class="diagnosa-icon">{{ $step['icon'] }}</div>
              <div class="diagnosa-text text-dark">{{ $step['text'] }}</div>
            </div>
          </a>
        </div>
      @endforeach

    </div>

    <!-- Button -->
           <a href="{{ route('guest.diagnosa') }}" 
   class="btn btn-lg px-5 py-3 fw-bold text-white"
   style="background: linear-gradient(to right, #667eea, #764ba2); border-radius: 50px; box-shadow: 0 8px 20px rgba(0,0,0,0.15); transition: all 0.3s ease;"
   onmouseover="this.style.transform='scale(1.05)'"
   onmouseout="this.style.transform='scale(1)'">
   🚀 Mulai Diagnosa
</a>

  </div>
</div>


<!-- Bootstrap JS (for modal functionality) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
