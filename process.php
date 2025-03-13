<?php
session_start();
$filename = 'absensi.txt';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['name'], $_POST['whatsapp'], $_POST['group'], $_POST['feedback'])) {
    if (!isset($_SESSION['allowed_to_absen']) || $_SESSION['allowed_to_absen'] !== true) {
        echo "<div style='font-family:Roboto, sans-serif; background-color:#1e3c72; color:white; display:flex; justify-content:center; align-items:center; height:100vh;'>
                <div style='text-align:center; background-color:#2a5298; padding:20px; border-radius:10px; box-shadow:0px 4px 6px rgba(0,0,0,0.3);'>
                    <h2 style='color:#ffc107;'>Akses Tidak Valid</h2>
                    <p>Silakan periksa status terlebih dahulu.</p>
                    <a href='index.html' style='text-decoration:none; background-color:#ffc107; color:#333; padding:10px 20px; border-radius:5px; font-weight:bold;'>Kembali</a>
                </div>
              </div>";
        exit;
    }

    $name = htmlspecialchars($_POST['name']);
    $whatsapp = htmlspecialchars($_POST['whatsapp']);
    $group = htmlspecialchars($_POST['group']);
    $feedback = htmlspecialchars($_POST['feedback']);

    // Simpan data ke file teks
    $file = fopen($filename, 'a');
    fwrite($file, "============================\n");
    fwrite($file, "Nama            : $name\n");
    fwrite($file, "Nomor WhatsApp  : $whatsapp\n");
    fwrite($file, "Nama Grup       : $group\n");
    fwrite($file, "Kritik & Saran  : $feedback\n");
    fwrite($file, "============================\n\n");
    fclose($file);

    session_destroy(); // Hapus sesi setelah absen berhasil

    echo "<div style='font-family:Inter, sans-serif; background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%); color:white; min-height:100vh; padding:15px; position:relative;'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no'>
            <div style='background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(5px); padding:1.5rem; border-radius:15px; margin:15px;'>
                <h2 style='font-size:1.5rem; margin-bottom:1rem; text-align:center;'>
                    ".($name ? '🎉 Berhasil' : '❌ Gagal')."
                </h2>
                <p style='font-size:0.9rem; margin-bottom:1.5rem;'>".($name ? "Terima kasih $name!" : "Isi formulir dengan benar")."</p>
                <a href='index.html' style='display:block; padding:12px; background:#ffc107; color:#1e3c72; border-radius:8px; text-decoration:none; font-weight:500;'>Kembali</a>
            </div>
          </div>";
} else {
    echo "<div style='font-family:Roboto, sans-serif; background-color:#1e3c72; color:white; display:flex; justify-content:center; align-items:center; height:100vh;'>
            <div style='text-align:center; background-color:#2a5298; padding:20px; border-radius:10px; box-shadow:0px 4px 6px rgba(0,0,0,0.3);'>
                <h2 style='color:#ffc107;'>Data Tidak Valid</h2>
                <p>Formulir belum diisi dengan benar. Silakan coba lagi.</p>
                <a href='index.html' style='text-decoration:none; background-color:#ffc107; color:#333; padding:10px 20px; border-radius:5px; font-weight:bold;'>Kembali</a>
            </div>
          </div>";
}
?>