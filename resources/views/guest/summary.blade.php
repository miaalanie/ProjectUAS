@extends('layouts.app') {{-- Sesuaikan layout utama proyek --}}

@section('title', 'Summary Diagnosa')

@section('content')

<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>AOS.init();</script>

<style>
  .summary-card {
    background: #fff;
    border-radius: 1.2rem;
    box-shadow: 0 2px 12px rgba(102,126,234,0.08);
    padding: 2rem 1.5rem;
    margin: 2rem auto;
    max-width: 480px;
    text-align: left;
    position: relative;
  }
  .summary-title {
    font-size: 2rem;
    font-weight: 700;
    color: #7b6ef6;
    margin-bottom: 1.2rem;
    text-align: center;
  }
  .summary-label {
    font-weight: 600;
    color: #764ba2;
    margin-bottom: 0.2rem;
    font-size: 1.05rem;
  }
  .summary-value {
    color: #333;
    margin-bottom: 1rem;
    font-size: 1.08rem;
  }
  .summary-badge {
    display: inline-block;
    background: linear-gradient(90deg,#667eea,#764ba2);
    color: #fff;
    border-radius: 1rem;
    padding: 0.4rem 1.2rem;
    font-size: 1rem;
    font-weight: 600;
    margin-bottom: 1rem;
  }
  .summary-btn {
    background: linear-gradient(to right, #667eea, #764ba2);
    color: #fff;
    border: none;
    border-radius: 50px;
    padding: 0.8rem 2.2rem;
    font-size: 1.15rem;
    font-weight: 600;
    box-shadow: 0 8px 20px rgba(0,0,0,0.12);
    transition: all 0.3s ease;
    margin-top: 1.2rem;
    display: block;
    width: 100%;
  }
  .summary-btn:hover {
    transform: scale(1.05);
    box-shadow: 0 12px 24px rgba(102,126,234,0.18);
  }
</style>

<div class="summary-card" data-aos="fade-up" data-aos-duration="900">
    <div class="summary-title">Summary Diagnosa</div>
    <div class="summary-label">Guest ID</div>
    <div class="summary-value">{{ $guest->id ?? '-' }}</div>
    <div class="summary-label">Nama</div>
    <div class="summary-value">{{ $guest->name ?? '-' }}</div>

    @if(!$diagnosis)
        <div class="alert alert-warning mt-3 mb-0">Belum ada hasil diagnosa untuk guest ini.</div>
    @else
        <div class="summary-label">Tanggal/Waktu</div>
        <div class="summary-value">{{ $diagnosis->created_at?->format('d M Y H:i:s') ?? '-' }}</div>
        <div class="summary-label">Suhu Tubuh</div>
        <div class="summary-value">{{ number_format($diagnosis->suhu, 2) }} °C</div>
        <div class="summary-label">Detak Jantung</div>
        <div class="summary-value">{{ number_format($diagnosis->detak_jantung, 0) }} bpm</div>
        <div class="summary-label">Nilai Fuzzy</div>
        <div class="summary-value">{{ number_format($diagnosis->hasil_fuzzy, 2) }}</div>
        <div class="summary-label">Mood</div>
        <div class="summary-badge">{{ $diagnosis->mood }}</div>
        <div class="summary-label">Snack Rekomendasi</div>
        <div class="summary-value">{{ optional($diagnosis->snack)->name ?? '-' }}</div>
    @endif

    <button class="summary-btn" data-bs-toggle="modal" data-bs-target="#emailModal">Kirim ke Email</button>
</div>

<!-- Modal Email -->
<div class="modal fade" id="emailModal" tabindex="-1" aria-labelledby="emailModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="emailModalLabel">Kirim Summary ke Email</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="formEmail" data-guest-id="{{ $guest->id ?? '' }}">
          <div class="mb-3">
            <label for="emailInput" class="form-label">Alamat Email</label>
            <input type="email" class="form-control" id="emailInput" placeholder="nama@email.com" required>
          </div>
          <button type="submit" class="btn btn-primary w-100">Kirim</button>
        </form>

        <div id="emailStatus" class="mt-2"></div>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap JS (for modal functionality) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
document.getElementById('formEmail').addEventListener('submit', function(e) {
    e.preventDefault();

    const email = document.getElementById('emailInput').value;
    const guestId = this.dataset.guestId;  // Ambil dari data-guest-id
    console.log('Kirim:', { email, guest_id: guestId });

    axios.post('{{ route("summary.sendEmail") }}', {
        email: email,
        user_id: guestId
    })
    .then(res => {
        document.getElementById('emailStatus').innerHTML = '<span class="text-success">Berhasil dikirim ke ' + email + '</span>';
    })
    .catch(err => {
        console.error(err.response?.data || err);
        document.getElementById('emailStatus').innerHTML = '<span class="text-danger">Gagal mengirim email</span>';
    });
});
</script>
@endsection

@push('scripts')
<script>
document.getElementById('formEmail').addEventListener('submit', function(e) {
    e.preventDefault();
    const email = document.getElementById('emailInput').value;
    const userId = "{{ $guest->id }}";
    const statusDiv = document.getElementById('emailStatus');
    const submitBtn = document.querySelector('#formEmail button');

    // Disable tombol sementara
    submitBtn.disabled = true;
    submitBtn.innerText = 'Mengirim...';

    fetch("{{ route('summary.sendEmail') }}", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ email: email, user_id: userId })
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            statusDiv.innerHTML = '<div class="alert alert-success">'+data.message+'</div>';
        } else {
            statusDiv.innerHTML = '<div class="alert alert-danger">'+data.message+'</div>';
        }
    })
    .catch(error => {
        statusDiv.innerHTML = '<div class="alert alert-danger">Terjadi kesalahan.</div>';
        console.error(error);
    })
    .finally(() => {
        submitBtn.disabled = false;
        submitBtn.innerText = 'Kirim';
    });
});
</script>
@endpush