@extends('layouts.app')

@section('content')
<style>
  .slide { display: none; }
  .slide.active { display: block; animation: fadeIn 0.5s ease-in-out; }
  @keyframes fadeIn { from {opacity: 0;} to {opacity: 1;} }
</style>

<div class="container py-5 text-center">
  <!-- Step 1: Nama -->
  <div class="slide active" id="slide-1">
    <h3>Masukkan Namamu</h3>
    <input type="text" id="nama" class="form-control" placeholder="Nama kamu..." />
    <button class="btn btn-primary mt-3" onclick="nextSlide(2)">Lanjut</button>
  </div>

  <!-- Step 2: Data Sensor -->
  <div class="slide" id="slide-2">
    <h3>Data Sensor</h3>
    <p>Suhu: <span id="suhu"></span> °C</p>
    <p>Detak Jantung: <span id="detak"></span> bpm</p>
    <button class="btn btn-primary mt-3" onclick="nextSlide(3)">Proses Mood</button>
  </div>

  <!-- Step 3: Mood -->
  <div class="slide" id="slide-3">
    <h3>Mood Kamu Hari Ini</h3>
    <p id="hasilMood">...</p>
    <button class="btn btn-primary mt-3" onclick="nextSlide(4)">Lihat Snack</button>
  </div>

  <!-- Step 4: Snack -->
  <div class="slide" id="slide-4">
    <h3>Snack Rekomendasi 🍿</h3>
    <div id="snackList"></div>
  </div>
</div>

<script>
  let userId = null;
  let suhu = null;
  let detak = null;
  let hasilMood = null;

  function nextSlide(n) {
    document.querySelectorAll('.slide').forEach(s => s.classList.remove('active'));
    document.getElementById(`slide-${n}`).classList.add('active');

    if (n === 2) {
      const nama = document.getElementById("nama").value;
      axios.post('/api/users', { nama }).then(res => {
        userId = res.data.id;
        getSensor();
      });
    }

    if (n === 3) {
      axios.post('/api/mood-detection', {
        user_id: userId,
        suhu: suhu,
        detak_jantung: detak
      }).then(res => {
        hasilMood = res.data.mood;
        document.getElementById("hasilMood").innerText = hasilMood;
      });
    }

    if (n === 4) {
      axios.get(`/api/snack-recommendation/${hasilMood}`).then(res => {
        const div = document.getElementById("snackList");
        div.innerHTML = '';
        res.data.snacks.forEach(s => {
          div.innerHTML += `<div class="card m-2 p-3">
              <h5>${s.snack_name}</h5>
              <img src="/images/${s.snack_image}" width="100" />
              <p>${s.description}</p>
          </div>`;
        });
      });
    }
  }

  function getSensor() {
    axios.get(`/api/sensor-readings/last/${userId}`).then(res => {
      suhu = res.data.suhu;
      detak = res.data.detak_jantung;
      document.getElementById("suhu").innerText = suhu;
      document.getElementById("detak").innerText = detak;
    });
  }
</script>
@endsection
