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
    <p>Detak Jantung: <span id="detak_jantung"></span> bpm</p>
    <button class="btn btn-primary mt-3" onclick="processMood()">Proses Mood</button>
  </div>

  <!-- Step 3: Mood -->
  <div class="slide" id="slide-3">
    <h3>Mood Kamu Hari Ini</h3>
    <p id="hasilMood">...</p>
    <button class="btn btn-primary mt-3" onclick="getSnackRecommendation()">Lihat Snack</button>
  </div>

  <!-- Step 4: Snack -->
  <div class="slide" id="slide-4">
    <h3>Snack Rekomendasi 🍿</h3>
    <div id="snackList"></div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

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

  if (!nama.trim()) {
    alert("Nama tidak boleh kosong!");
    return;
  }

  console.log("Nama yang dikirim:", nama);

  // Step 1: simpan nama guest
  axios.post('/guests', { nama: nama })
    .then(res => {
      const userId = res.data.id;
      localStorage.setItem("userId", userId);
      console.log("Guest berhasil disimpan. ID:", userId);

      // Step 2: setelah berhasil simpan nama, ambil data sensor
      return axios.get('/api/sensor-readings');
    })
    .then(res => {
      const latest = res.data.data[0];
      console.log("Data sensor berhasil diambil:", latest);

      // simpan ke localStorage
      localStorage.setItem("suhu", latest.suhu);
      localStorage.setItem("detak_jantung", latest.detak_jantung);

      // tampilkan di halaman slide-2
      document.getElementById("suhu").innerText = latest.suhu;
      document.getElementById("detak_jantung").innerText = latest.detak_jantung;
    })
    .catch(err => {
      console.error("Error saat menyimpan nama atau mengambil data sensor:", err);
      alert("Terjadi kesalahan saat proses data. Coba lagi.");
    });
}


if (n === 3) {
  // Tidak usah ambil data sensor lagi, cukup tampilkan hasil yang sudah diproses
  console.log("Step 3: Hasil mood sudah ditampilkan.");
}


  }

function processMood() {
  const suhu = localStorage.getItem("suhu");
  const detak = localStorage.getItem("detak_jantung");

  console.log("STEP 1: Ambil data dari localStorage");
  console.log("  → suhu:", suhu);
  console.log("  → detak:", detak);

  if (!suhu || !detak) {
    alert("Data suhu atau detak jantung kosong!");
    return;
  }

  console.log("STEP 2: Kirim POST request ke /proses-mood");

  axios.post("/proses-mood", {
    suhu: suhu,
    detak: detak
  })
    .then(res => {
      console.log("STEP 3: Terima response dari backend");
      console.log("  → res.data:", res.data);

      const data = res.data;

      if (
        data &&
        data.nilai &&
        Array.isArray(data.nilai.detail) &&
        data.nilai.detail.length > 0
      ) {
        const hasilMood = data.nilai.detail[0].mood;
        const nilaiAngka = data.nilai.nilai.toFixed(2);

        // Simpan ke localStorage
        localStorage.setItem("mood", hasilMood);
        localStorage.setItem("nilaiMood", nilaiAngka);

        console.log("STEP 4: Ambil hasil mood & nilai dari response");
        console.log("  → Mood:", hasilMood);
        console.log("  → Nilai angka:", nilaiAngka);

        console.log(localStorage.getItem("mood"))


        document.getElementById("hasilMood").innerHTML =
          `Mood kamu: <strong>${hasilMood}</strong><br>Nilai: <strong>${nilaiAngka}</strong>`;

        console.log("STEP 5: Tampilkan hasil & lanjut ke slide 3");
        nextSlide(3);
      } else {
        console.warn("⚠️ Data response tidak sesuai format atau kosong:", data);
        alert("Mood tidak bisa diproses. Coba lagi.");
      }
    })
    .catch(err => {
      console.error("❌ Gagal proses mood:", err);
      alert("Gagal proses mood");
    });
}

function getSnackRecommendation() {
  const mood = localStorage.getItem("mood");

  console.log("mood", mood);

  if (!mood) {
    alert("Data Mood kosong!");
    return;
  }

  console.log("step 3: kirim POST ke /get-snack");

  axios.get(`/get-snack/${encodeURIComponent(mood)}`)
    .then(res => {
      console.log("respon dari backend", res.data);

      const data = res.data.snack; // ambil array snack

      // Tampilkan snack ke view di slide 4
      const div = document.getElementById("snackList");
      div.innerHTML = '';
      if (Array.isArray(data) && data.length > 0) {
        data.forEach(snack => {
          div.innerHTML += `
            <div class="card m-2 p-3" style="cursor: pointer;" onclick="handleSnackClick(${snack.id})">
              <h5>${snack.nama_snack}</h5>
              ${snack.foto_snack ? `<img src="/images/${snack.foto_snack}" width="100" />` : ''}
              <p>${snack.kandungan_gizi}</p>
            </div>
          `;
        });
      } else {
        div.innerHTML = '<p>Tidak ada rekomendasi snack ditemukan.</p>';
      }

      // Pindah ke slide 4
      nextSlide(4);
    })
    .catch(error => {
      console.error("Gagal ambil snack:", error);
      alert("Gagal mengambil rekomendasi snack.");
    });
}

function handleSnackClick(id_snack) {
    console.log("Snack diklik, ID:", id_snack);

    // Simpan id snack ke localStorage
    localStorage.setItem("snack_id", id_snack);

    // Ambil semua data dari localStorage
    const user_id = localStorage.getItem("userId");
    const suhu = localStorage.getItem("suhu");
    const detak_jantung = localStorage.getItem("detak_jantung");
    const hasil_fuzzy = localStorage.getItem("nilaiMood");
    const mood = localStorage.getItem("mood");
    const snack_id = localStorage.getItem("snack_id");

    // Validasi
    if (!user_id || !suhu || !detak_jantung || !hasil_fuzzy || !mood || !snack_id) {
      alert("Data diagnosis belum lengkap!");
      return;
    }

    console.log("Data yang akan dikirim:");
    console.log("user_id:", user_id);
    console.log("suhu:", suhu);
    console.log("detak_jantung:", detak_jantung);
    console.log("hasil_fuzzy:", hasil_fuzzy);
    console.log("mood:", mood);
    console.log("snack_id:", snack_id);

    axios.get(`http://10.23.146.87/led?id=${snack_id}`) // Ganti IP sesuai IP dari Serial Monitor
    .then(res => {
      console.log("LED berhasil dinyalakan:", res.data);
    })
    .catch(err => {
      console.error("Gagal:", err);
    });



    // Kirim POST ke backend
    axios.post('/diagnoses', {
      user_id: parseInt(user_id),
      suhu: parseFloat(suhu),
      detak_jantung: parseFloat(detak_jantung),
      hasil_fuzzy: parseFloat(hasil_fuzzy),
      mood: mood,
      snack_id: parseInt(snack_id)
    }).then(res => {
      console.log("Berhasil dikirim:", res.data);
      alert("Diagnosis berhasil disimpan!");
      // Bisa redirect atau bersihkan localStorage kalau mau
    }).catch(err => {
      console.error("Gagal kirim diagnosis:", err.response?.data || err.message);
      alert("Gagal kirim diagnosis");
    });
  }
 
 </script>
@endsection
 