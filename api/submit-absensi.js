import fs from 'fs';
import path from 'path';

export default function handler(req, res) {
  try {
    if (req.method !== 'POST') {
      return res.status(405).json({ success: false, message: 'Metode tidak diizinkan' });
    }

    const { name, whatsapp, group, feedback } = req.body;
    
    // Validasi data
    if (!name || !whatsapp || !group || !feedback) {
      return res.status(400).json({
        success: false,
        message: 'Semua field harus diisi'
      });
    }
    
    // Format data untuk disimpan
    const timestamp = new Date().toISOString();
    const dataToSave = `${whatsapp},${name},${group},${timestamp}\n`;
    
    // Menyimpan data absensi ke file
    const filePath = path.join(process.cwd(), 'absensi.txt');
    
    try {
      fs.appendFileSync(filePath, dataToSave, 'utf8');
      
      return res.status(200).json({
        success: true,
        message: `Absensi untuk ${name} (${whatsapp}) berhasil dicatat`
      });
    } catch (error) {
      console.error('Error saving to file:', error);
      return res.status(500).json({
        success: false,
        message: 'Gagal menyimpan data absensi'
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
