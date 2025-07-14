@extends('layouts.app')

@section('content')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>AOS.init();</script>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

<style>
  body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(135deg, #fffbe4, #e4f7ff);
  }

  .floating-emoji {
    position: absolute;
    opacity: 0.4;
    animation: float 6s ease-in-out infinite, rotate 15s linear infinite;
    z-index: 0;
  }

  @keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-15px); }
  }

  @keyframes rotate {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
  }

  .main-card {
    background-color: white;
    border-radius: 1.5rem;
    padding: 2.5rem 2rem;
    box-shadow: 0 12px 32px rgba(0,0,0,0.06);
    max-width: 1100px;
    width: 100%;
    margin: auto;
  }

  .section-title {
    font-size: 2.2rem;
    font-weight: 700;
    color: #ff8f00;
    margin-bottom: 0.4rem;
  }

  .section-subtitle {
    font-size: 1rem;
    color: #666;
    margin-bottom: 2rem;
  }

  /* ===== Accordion Button Styling ===== */
  .accordion-button {
    font-weight: 600;
    font-size: 1.05rem;
    padding: 1.2rem 1.5rem;
    color: #fff;
    border-radius: 12px !important;
    transition: all 0.3s ease;
    background: linear-gradient(135deg, #ff6e40, #ff8f00);
    box-shadow: 0 4px 12px rgba(255, 110, 64, 0.25);
    width: 100%;
    justify-content: center;
  }

  .accordion-button.collapsed {
    background: linear-gradient(135deg, #ffa726, #fb8c00);
    box-shadow: 0 2px 6px rgba(255, 152, 0, 0.15);
  }

  .accordion-button:not(.collapsed) {
    background: linear-gradient(135deg, #f57c00, #ef6c00);
    box-shadow: 0 6px 14px rgba(255, 87, 34, 0.25);
  }

  .accordion-button::after {
    transform: scale(1.2);
  }

  .accordion-item {
    border: none;
    margin-bottom: 1.5rem;
  }

  .accordion-body {
    padding-top: 2rem;
  }

  .snack-card {
    background: linear-gradient(135deg, #fff3e0, #e3f2fd);
    border-radius: 16px;
    padding: 1.5rem 1rem;
    box-shadow: 0 4px 14px rgba(0,0,0,0.04);
    text-align: center;
    transition: 0.25s ease;
    height: 100%;
    max-width: 240px;
    margin: auto;
    border: 1px solid #f0f0f0;
  }

  .snack-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 28px rgba(255,152,0,0.15);
  }

  .snack-img {
    width: 80px;
    height: 80px;
    object-fit: cover;
    border-radius: 50%;
    margin-bottom: 0.8rem;
    border: 2px solid #ffe0b2;
    background: #fff;
    box-shadow: 0 1px 4px rgba(0,0,0,0.05);
  }

  .snack-placeholder {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: #f2f2f2;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #aaa;
    font-size: 0.9rem;
    margin-bottom: 0.8rem;
    border: 2px dashed #ddd;
  }
</style>

<div class="position-relative min-vh-100 d-flex align-items-center justify-content-center overflow-hidden" style="padding: 2rem 1rem;">
  <!-- Floating Background Emojis -->
  <div class="floating-emoji" style="top: 10%; left: 5%; font-size: 2rem;">🍫</div>
  <div class="floating-emoji" style="top: 20%; right: 10%; font-size: 2.2rem;">🍪</div>
  <div class="floating-emoji" style="bottom: 15%; left: 10%; font-size: 2rem;">🍩</div>
  <div class="floating-emoji" style="bottom: 10%; right: 15%; font-size: 2.4rem;">🍰</div>
  <div class="floating-emoji" style="top: 50%; left: 45%; font-size: 1.8rem;">🍦</div>

  <!-- Main Card -->
  <div class="main-card text-center" data-aos="zoom-in" data-aos-duration="1000">
    <h2 class="section-title">Temukan Camilanmu Hari Ini</h2>
    <p class="section-subtitle">Pilih kategori dan temukan snack favoritmu 🍘</p>

    @if($moods->count() > 0)
      <div class="accordion" id="snackAccordion">
        @foreach($moods as $kategori)
          <div class="accordion-item">
            <h2 class="accordion-header" id="heading{{ $kategori->id }}">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $kategori->id }}" aria-expanded="false" aria-controls="collapse{{ $kategori->id }}">
                {{ $kategori->jenis_mood }}
              </button>
            </h2>
            <div id="collapse{{ $kategori->id }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $kategori->id }}" data-bs-parent="#snackAccordion">
              <div class="accordion-body">
                <div class="row justify-content-center">
                  @forelse($kategori->snacks as $snack)
                    <div class="col-md-4 col-lg-3 mb-4 d-flex justify-content-center">
                      <div class="snack-card">
                        @if($snack->foto_snack)
                          <img src="{{ asset('assets/img/snack/' . $snack->foto_snack) }}" alt="{{ $snack->nama_snack }}" class="snack-img">
                        @else
                          <div class="snack-placeholder">no image</div>
                        @endif
                        <h5 class="fw-bold text-warning mt-2 mb-1">{{ $snack->nama_snack ?? 'Tanpa Nama' }}</h5>
                        <p class="text-muted" style="font-size: 0.9rem;">{{ $snack->kandungan_gizi }}</p>
                      </div>
                    </div>
                  @empty
                    <div class="col-12">
                      <div class="alert alert-secondary">Belum ada camilan di kategori ini.</div>
                    </div>
                  @endforelse
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    @else
      <div class="alert alert-warning">Belum ada data kategori camilan.</div>
    @endif
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
