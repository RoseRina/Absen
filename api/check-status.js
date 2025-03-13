export default function handler(req, res) {
  if (req.method !== 'POST') {
    return res.status(405).json({ success: false, message: 'Metode tidak diizinkan' });
  }

  const { whatsapp } = req.body;
  
  // Di sini Anda bisa menambahkan logika untuk memeriksa status absensi
  // Misalnya menghubungi database atau layanan eksternal
  
  // Contoh respons sederhana (ganti dengan logika sebenarnya):
  if (whatsapp && whatsapp.length >= 10) {
    // Simulasi pengecekan berhasil
    return res.status(200).json({
      success: true,
      message: `Status absensi untuk nomor ${whatsapp} ditemukan: HADIR`
    });
  } else {
    return res.status(400).json({
      success: false,
      message: 'Nomor WhatsApp tidak valid atau tidak ditemukan'
    });
  }
}
