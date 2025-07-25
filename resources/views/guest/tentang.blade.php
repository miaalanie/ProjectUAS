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
  .about-bg {
    min-height: 100vh;
    background: none;
    padding: 2.5rem 0 2rem 0;
  }
  .about-title {
    font-size: 2.3rem;
    font-weight: 900;
    color: #29469a;
    margin-bottom: 2.2rem;
    text-align: center;
    letter-spacing: 1px;
    text-shadow: 0 2px 12px #7b6ef622;
  }
  .about-section {
    background: rgba(255,255,255,0.65);
    border-radius: 1.5rem;
    box-shadow: 0 8px 32px 0 rgba(102,126,234,0.10), 0 1.5px 8px 0 rgba(123,110,246,0.08);
    padding: 2.2rem 2.2rem 1.5rem 2.2rem;
    max-width: 800px;
    margin: 0 auto 2.5rem auto;
    border: 1.5px solid #e3e7fa;
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
    transition: box-shadow 0.2s, transform 0.2s;
  }
  .about-section:hover {
    box-shadow: 0 12px 40px #7b6ef655, 0 2px 8px #7b6ef611;
    transform: translateY(-4px) scale(1.03);
    border-color: #7b6ef6;
  }
  .about-subtitle {
    font-weight: 800;
    font-size: 1.25rem;
    color: #7b6ef6;
    margin-bottom: 1.1rem;
    letter-spacing: 0.2px;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    text-shadow: 0 2px 8px #7b6ef622;
  }
  .about-list {
    margin-bottom: 1.2rem;
    padding-left: 1.2rem;
  }
  .about-list li {
    margin-bottom: 0.7rem;
    font-size: 1.05rem;
    color: #1e3a8a;
    font-weight: 500;
  }
  .about-icon {
    font-size: 1.3rem;
    margin-right: 0.5rem;
    color: #7b6ef6;
    vertical-align: middle;
  }
  .about-desc {
    font-size: 1.08rem;
    color: #5a5a7a;
    margin-bottom: 1.2rem;
    line-height: 1.7;
    text-align: justify;
  }
  @media (max-width: 991.98px) {
    .about-section { padding: 1.2rem 0.7rem 1.2rem 0.7rem; }
    .about-title { font-size: 1.5rem; }
  }
</style>

<div class="about-bg">
  <div class="about-title" data-aos="fade-down" data-aos-duration="900">
    🟣 Tentang Aplikasi
  </div>
  <div class="about-section" data-aos="zoom-in-up" data-aos-delay="150">
    <div class="about-desc" data-aos="fade-right" data-aos-delay="250">
      <b>SnackMood</b> adalah aplikasi berbasis web yang dirancang untuk memberikan rekomendasi snack sehat berdasarkan kondisi tubuh dan mood pengguna.<br><br>
      Aplikasi ini menggunakan:
    </div>
    <ul class="about-list">
      <li data-aos="fade-left" data-aos-delay="350"><span class="about-icon">&#128246;</span> Sensor suhu tubuh dan detak jantung (via ESP8266)</li>
      <li data-aos="fade-left" data-aos-delay="400"><span class="about-icon">&#129302;</span> Algoritma Fuzzy Logic untuk menganalisis mood</li>
      <li data-aos="fade-left" data-aos-delay="450"><span class="about-icon">&#127849;</span> Rekomendasi snack dari database yang telah dikategorikan berdasarkan jenis mood</li>
    </ul>
    <div class="about-subtitle" data-aos="fade-up" data-aos-delay="500">🔍 Cara Kerja Aplikasi:</div>
    <ul class="about-list">
      <li data-aos="fade-up" data-aos-delay="550"><b>Input Nama</b><br><span style="color:#5a5a7a;">Pengguna mengisi nama tanpa login, disimpan sebagai guest.</span></li>
      <li data-aos="fade-up" data-aos-delay="600"><b>Pembacaan Sensor Otomatis</b><br><span style="color:#5a5a7a;">Data suhu tubuh & detak jantung dikirimkan melalui sensor ke aplikasi.</span></li>
      <li data-aos="fade-up" data-aos-delay="650"><b>Analisis Mood (Fuzzy Logic)</b><br><span style="color:#5a5a7a;">Data diproses melalui metode fuzzy untuk menentukan mood pengguna, seperti Happy, Tired, Anxious, dll.</span></li>
      <li data-aos="fade-up" data-aos-delay="700"><b>Rekomendasi Snack</b><br><span style="color:#5a5a7a;">Aplikasi merekomendasikan snack yang cocok berdasarkan mood.</span></li>
      <li data-aos="fade-up" data-aos-delay="750"><b>Kontrol Output</b><br><span style="color:#5a5a7a;">Setelah memilih snack, LED akan menyala sesuai pilihan sebagai bentuk interaksi nyata.</span></li>
      <li data-aos="fade-up" data-aos-delay="800"><b>Summary & Notifikasi</b><br><span style="color:#5a5a7a;">Hasil diagnosa dikirim melalui email dan ditampilkan dalam halaman ringkasan.</span></li>
    </ul>
    <div class="about-subtitle" data-aos="fade-up" data-aos-delay="850">🎯 Tujuan Aplikasi:</div>
    <ul class="about-list">
      <li data-aos="zoom-in" data-aos-delay="900">Membantu pengguna mengenali kondisi emosional melalui indikator tubuh.</li>
      <li data-aos="zoom-in" data-aos-delay="950">Memberikan pilihan snack yang sesuai untuk meningkatkan suasana hati.</li>
      <li data-aos="zoom-in" data-aos-delay="1000">Menggabungkan teknologi IoT &amp; AI dalam pengalaman sehari-hari.</li>
    </ul>
  </div>
</div>
@endsection