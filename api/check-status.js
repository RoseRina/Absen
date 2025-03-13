import fs from 'fs';
import path from 'path';

export default function handler(req, res) {
  try {
    if (req.method !== 'POST') {
      return res.status(405).json({ success: false, message: 'Metode tidak diizinkan' });
    }

    const { whatsapp } = req.body;
    
    // Validasi nomor WhatsApp
    if (!whatsapp || whatsapp.length < 10) {
      return res.status(400).json({
        success: false,
        message: 'Nomor WhatsApp tidak valid'
      });
    }
    
    // Membaca data absensi dari file
    const filePath = path.join(process.cwd(), 'absensi.txt');
    let absensiData = [];
    
    try {
      // Periksa apakah file ada
      if (fs.existsSync(filePath)) {
        // Baca file dan parsing data
        const fileContent = fs.readFileSync(filePath, 'utf8');
        absensiData = fileContent.split('\n').filter(line => line.trim() !== '');
      }
    } catch (error) {
      console.error('Error reading file:', error);
    }
    
    // Periksa apakah nomor WhatsApp ada dalam data absensi
    const isPresent = absensiData.some(entry => entry.includes(whatsapp));
    
    if (isPresent) {
      return res.status(200).json({
        success: true,
        message: `Status absensi untuk nomor ${whatsapp} ditemukan: HADIR`
      });
    } else {
      return res.status(200).json({
        success: false,
        message: `Nomor ${whatsapp} belum melakukan absensi`
      });
    }
  } catch (error) {
    console.error('Error:', error);
    return res.status(500).json({
      success: false,
      message: 'Terjadi kesalahan pada server. Silakan coba lagi.'
    });
  }
}
