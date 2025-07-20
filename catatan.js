if (n === 3) {
  axios.get('/api/sensor-readings')
    .then(res => {
      const latest = res.data.data[0]; // Ambil paling terbaru

      // Simpan ke local storage
      localStorage.setItem('suhu', latest.suhu);
      localStorage.setItem('detak', latest.detak_jantung);

      // Tampilkan di halaman
      document.getElementById("suhu").innerText = latest.suhu;
      document.getElementById("detak").innerText = latest.detak_jantung;
    });
}
