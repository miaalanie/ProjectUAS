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

  .info-card {
    background-color: rgba(255, 255, 255, 0.95);
    border-radius: 1rem;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    cursor: default;
    padding: 1.5rem;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
    text-align: center;
  }

  .info-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
  }

  .team-photo {
    width: 110px;
    height: 110px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid #7e57c2;
    margin-bottom: 1rem;
  }

  .team-name {
    font-size: 1.2rem;
    font-weight: 600;
    color: #4a148c;
  }

  .team-role {
    color: #7b1fa2;
    font-weight: 500;
  }

  .team-bio {
    font-size: 0.9rem;
    color: #616161;
    margin-top: 0.5rem;
  }
</style>

<!-- Hero Section -->
<div class="position-relative min-vh-100 d-flex align-items-center justify-content-center overflow-hidden" style="background: linear-gradient(135deg, #f3e5f5, #e1f5fe);">
  
  <!-- Floating Emojis -->
  <div class="floating-emoji" style="top: 10%; left: 5%; font-size: 2rem;">💡</div>
  <div class="floating-emoji" style="top: 20%; right: 10%; font-size: 2.2rem;">📚</div>
  <div class="floating-emoji" style="bottom: 15%; left: 10%; font-size: 2rem;">🤝</div>
  <div class="floating-emoji" style="bottom: 10%; right: 15%; font-size: 2.4rem;">🎯</div>
  <div class="floating-emoji" style="top: 50%; left: 45%; font-size: 1.8rem;">🚀</div>

  <!-- Card Content -->
  <div class="card border-0 shadow-lg px-5 py-5 text-center" style="max-width: 900px; width: 100%; background-color: rgba(255, 255, 255, 0.92);" data-aos="zoom-in" data-aos-duration="1000">
    <h1 class="display-5 fw-bold text-primary mb-3">🎯 Tentang Proyek SnackMood</h1>
    <p class="text-muted fs-5 mb-3">
      SnackMood adalah aplikasi inovatif untuk <strong>mendeteksi mood</strong> dari data suhu tubuh & detak jantung, lalu memberikan rekomendasi snack yang sesuai 🍫🍟.  
      Dibuat sebagai bagian dari tugas akhir untuk membantu pengguna lebih sadar terhadap kondisi emosinya.
    </p>
    <p class="fst-italic text-muted">“Karena mood yang baik dimulai dari snack yang tepat!” 😄</p>
  </div>
</div>

<!-- Meet The Team Section -->
<div class="py-12" style="background: linear-gradient(135deg, #f3f8ff, #e1f5fe);">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-center text-purple-700 mb-10" data-aos="fade-up">👥 Meet The Team</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
            @php
              $team = [
                ['name' => 'Alya Putri', 'role' => 'Leader & Backend Dev', 'photo' => 'https://via.placeholder.com/110', 'bio' => 'Mengatur alur kerja tim & backend API.'],
                ['name' => 'Rizky Fadillah', 'role' => 'Frontend Developer', 'photo' => 'https://via.placeholder.com/110', 'bio' => 'Fokus pada UI/UX agar aplikasi menarik.'],
                ['name' => 'Siti Aulia', 'role' => 'UI/UX Designer', 'photo' => 'https://via.placeholder.com/110', 'bio' => 'Mendesain tampilan aplikasi agar user friendly.'],
                ['name' => 'Bayu Saputra', 'role' => 'Data Analyst', 'photo' => 'https://via.placeholder.com/110', 'bio' => 'Mengolah data sensor & membuat statistik.'],
                ['name' => 'Intan Permata', 'role' => 'Quality Assurance', 'photo' => 'https://via.placeholder.com/110', 'bio' => 'Memastikan semua fitur berjalan lancar.'],
              ];
            @endphp

            @foreach ($team as $member)
            <div class="info-card" data-aos="fade-up" data-aos-delay="{{ $loop->index * 150 }}">
                <img src="{{ $member['photo'] }}" alt="Foto {{ $member['name'] }}" class="team-photo">
                <div class="team-name">{{ $member['name'] }}</div>
                <div class="team-role">{{ $member['role'] }}</div>
                <p class="team-bio">{{ $member['bio'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Call to Action -->
<div class="text-center mt-10 mb-10" data-aos="zoom-in">
    <a href="{{ route('guest.diagnosa') }}" 
       class="inline-block px-6 py-3 bg-gradient-to-r from-purple-500 to-pink-500 text-white text-lg font-semibold rounded-full shadow-lg hover:scale-105 transition">
      🚀 Mulai Diagnosa Mood
    </a>
</div>
@endsection
