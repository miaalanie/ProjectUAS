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
  .slide { display: none; }
  .slide.active { display: block; animation: fadeIn 0.5s ease-in-out; }
  @keyframes fadeIn { from {opacity: 0;} to {opacity: 1;} }
  .diagnosa-title {
    font-size: 2rem;
    font-weight: 700;
    color: #7b6ef6;
    margin-bottom: 1rem;
  }
  .diagnosa-emoji {
    font-size: 2.5rem;
    margin-bottom: 0.5rem;
  }
  .diagnosa-btn {
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
  }
  .diagnosa-btn:hover {
    transform: scale(1.05);
    box-shadow: 0 12px 24px rgba(102,126,234,0.18);
  }
  .snack-card {
    background: #fff;
    border-radius: 1.2rem;
    box-shadow: 0 2px 12px rgba(102,126,234,0.08);
    padding: 1.2rem 1rem;
    margin: 1rem auto;
    max-width: 320px;
    text-align: center;
    transition: box-shadow 0.3s;
    cursor: pointer;
  }
  .snack-card:hover {
    box-shadow: 0 8px 24px rgba(102,126,234,0.18);
    transform: translateY(-4px);
  }
  .snack-img {
    border-radius: 1rem;
    margin-bottom: 0.7rem;
    max-width: 120px;
    max-height: 120px;
    object-fit: cover;
    box-shadow: 0 2px 8px rgba(102,126,234,0.10);
  }
</style>

<div class="position-relative min-vh-100 d-flex align-items-center justify-content-center overflow-hidden" style="background: linear-gradient(135deg, #eef2ff, #f3f8ff);">
  <!-- Floating Emojis -->
  <div class="floating-emoji" style="top: 10%; left: 5%; font-size: 2rem;">🍫</div>
  <div class="floating-emoji" style="top: 20%; right: 10%; font-size: 2.2rem;">🍟</div>
  <div class="floating-emoji" style="bottom: 15%; left: 10%; font-size: 2rem;">❤️</div>
  <div class="floating-emoji" style="bottom: 10%; right: 15%; font-size: 2.4rem;">🧠</div>
  <div class="floating-emoji" style="top: 50%; left: 45%; font-size: 1.8rem;">😋</div>

  <!-- Card Content -->
  <div class="card border-0 shadow-lg px-5 py-5 text-center" style="max-width: 960px; width: 100%; background-color: rgba(255, 255, 255, 0.92);" data-aos="zoom-in" data-aos-duration="1000">
    <!-- Diagnosis Steps -->
    <div class="container py-5 text-center">
      <!-- Step 1: Nama -->
      <div class="slide active" id="slide-1">
        <div class="diagnosa-emoji">😋</div>
        <div class="diagnosa-title">Masukkan Namamu</div>
        <input type="text" id="nama" class="form-control" placeholder="Nama kamu..." style="max-width:320px; margin:0 auto 1.2rem auto;" />
        <button class="diagnosa-btn" onclick="nextSlide(2)">Lanjut</button>
      </div>

      <!-- Step 2: Data Sensor -->
      <div class="slide" id="slide-2">
        <div class="diagnosa-emoji">🌡️❤️</div>
        <div class="diagnosa-title">Data Sensor</div>
        <div style="display: flex; gap: 1.2rem; justify-content: center; margin-bottom: 1.2rem; flex-wrap: wrap;">
          <div style="background:#7b6ef6; border-radius:1.2rem; color:#fff; flex:1 1 140px; max-width:180px; min-width:120px; padding:1.2rem 0.7rem; text-align:center;">
            <div style="font-size:2.2rem; margin-bottom:0.3rem;">❤️</div>
            <div style="font-size:1.1rem;">Detak Jantung</div>
            <div style="font-size:2.5rem; font-weight:700;" id="detak_jantung">0</div>
            <div style="font-size:1rem; margin-bottom:0;">bpm</div>
          </div>
          <div style="background:#f44336; border-radius:1.2rem; color:#fff; flex:1 1 140px; max-width:180px; min-width:120px; padding:1.2rem 0.7rem; text-align:center;">
            <div style="font-size:2.2rem; margin-bottom:0.3rem;">🌡️</div>
            <div style="font-size:1.1rem;">Suhu Tubuh</div>
            <div style="font-size:2.5rem; font-weight:700;" id="suhu">0</div>
            <div style="font-size:1rem; margin-bottom:0;">°C</div>
          </div>
        </div>
        <button class="diagnosa-btn" onclick="processMood()">Proses Mood</button>
      </div>

      <!-- Step 3: Mood -->
      <div class="slide" id="slide-3">
        <div class="diagnosa-emoji">🧠</div>
        <div class="diagnosa-title">Mood Kamu Hari Ini</div>
        <div style="font-size:1.2rem; margin-bottom:1.2rem;" id="hasilMood">...</div>
        <div id="fuzzyDetail" style="margin-bottom:1.2rem;"></div>
        <button class="diagnosa-btn" onclick="getSnackRecommendation()">Lihat Snack</button>
      </div>

      <!-- Step 4: Snack -->
      <div class="slide" id="slide-4">
        <div class="diagnosa-emoji">🍿</div>
        <div class="diagnosa-title">Snack Rekomendasi</div>
        <div id="snackList" style="display:flex; flex-wrap:wrap; justify-content:center;"></div>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap JS (for modal functionality) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
    const STORAGE_URL = "{{ asset('storage') }}";
</script>


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


        // Emoji mapping for mood
        const moodEmojis = {
          relaxed: '😌',
          calm: '😊',
          anxious: '😬',
          tense: '😣'
        };
        const moodEmoji = moodEmojis[hasilMood] || '🧠';

        document.getElementById("hasilMood").innerHTML =
          `<div style='display:flex; align-items:center; justify-content:center; gap:1.2rem; margin-bottom:1.2rem;'>
            <div style="background:#7b6ef6; color:#fff; border-radius:1.2rem; padding:1.2rem 2rem; min-width:160px; text-align:center; box-shadow:0 2px 8px rgba(102,126,234,0.10);">
              <div style="font-size:2.5rem;">${moodEmoji}</div>
              <div style="font-size:1.3rem; font-weight:700;">${hasilMood}</div>
              <div style="font-size:1rem; margin-top:0.5rem;">Mood Kamu</div>
            </div>
            <div style="background:#f44336; color:#fff; border-radius:50%; width:90px; height:90px; display:flex; flex-direction:column; align-items:center; justify-content:center; font-size:1.5rem; font-weight:700; box-shadow:0 2px 8px rgba(244,67,54,0.10);">
              ${nilaiAngka}
              <div style="font-size:0.9rem; font-weight:400;">Nilai</div>
            </div>
          </div>`;

        // Tampilkan detail fuzzy
        let fuzzyHtml = `<div style='background:#f8f8ff; border-radius:1rem; padding:1rem; box-shadow:0 2px 8px rgba(102,126,234,0.08); max-width:600px; margin:1rem auto;'>
          <div style='font-weight:600; color:#764ba2; margin-bottom:0.7rem;'>Detail Perhitungan Fuzzy Tsukamoto</div>
          <table style='width:100%; font-size:0.98rem; border-collapse:collapse;'>
            <thead>
              <tr style='background:#eef2ff;'>
                <th style='padding:6px; border-radius:0.5rem 0 0 0.5rem;'>Rule</th>
                <th style='padding:6px;'>α</th>
                <th style='padding:6px;'>z</th>
                <th style='padding:6px; border-radius:0 0.5rem 0.5rem 0;'>Mood</th>
              </tr>
            </thead>
            <tbody>
        `;
        data.nilai.detail.forEach(d => {
          fuzzyHtml += `<tr style='background:#fff;'>
            <td style='padding:6px; text-align:center;'>${d.rule}</td>
            <td style='padding:6px; text-align:center;'>${d.α.toFixed(3)}</td>
            <td style='padding:6px; text-align:center;'>${d.z.toFixed(2)}</td>
            <td style='padding:6px; text-align:center;'>${d.mood}</td>
          </tr>`;
        });
        fuzzyHtml += `</tbody></table></div>`;
        document.getElementById("fuzzyDetail").innerHTML = fuzzyHtml;

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
        let gridHtml = `<div class='row w-100 justify-content-center'>`;
        data.forEach(snack => {
          gridHtml += `
            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
              <div class="snack-card w-100 mb-3" onclick="handleSnackClick(${snack.id})">
                <div class="snack-photo" style="margin-bottom:0.7rem; display:flex; justify-content:center; align-items:center;">
                 ${snack.foto_snack 
                  ? `<img src="${STORAGE_URL}/${snack.foto_snack}" alt="${snack.nama_snack}"
style="border-radius:1rem; max-width:280px; max-height:280px; width:100%; height:auto; object-fit:contain;" />`
                  : '<span style="font-size:4rem;">🍪</span>'}
                </div>
                <div class="snack-title" style="font-weight:700; color:#7b6ef6; font-size:1.08rem; margin-bottom:0.3rem; margin-top:0.5rem;">${snack.nama_snack}</div>
                <div class="snack-desc" style="font-size:0.95rem; color:#444;">${snack.kandungan_gizi || '-'}</div>
              </div>
            </div>
          `;
        });
        gridHtml += `</div>`;
        div.innerHTML = gridHtml;
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

    axios.get(`http://10.157.33.87/led?id=${snack_id}`) // Ganti IP sesuai IP dari Serial Monitor
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
      // alert("Diagnosis berhasil disimpan!");
        window.location.href = `/summary/${user_id}`;
      // Bisa redirect atau bersihkan localStorage kalau mau
    }).catch(err => {
      console.error("Gagal kirim diagnosis:", err.response?.data || err.message);
      alert("Gagal kirim diagnosis");
    });
  }
 
 </script>
@endsection
 