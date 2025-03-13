export default function handler(req, res) {
  try {
    if (req.method !== 'POST') {
      return res.status(405).json({ success: false, message: 'Metode tidak diizinkan' });
    }

    const { whatsapp } = req.body;
    
    // Log untuk debugging
    console.log('Request body:', req.body);
    
    // Validasi nomor WhatsApp
    if (!whatsapp || whatsapp.length < 10) {
      return res.status(400).json({
        success: false,
        message: 'Nomor WhatsApp tidak valid atau tidak ditemukan'
      });
    }
    
    // Simulasi pengecekan berhasil
    return res.status(200).json({
      success: true,
      message: `Status absensi untuk nomor ${whatsapp} ditemukan: HADIR`
    });
  } catch (error) {
    console.error('Error:', error);
    return res.status(500).json({
      success: false,
      message: 'Terjadi kesalahan pada server. Silakan coba lagi.'
    });
  }
}
