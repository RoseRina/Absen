<?php
session_start();
$filename = 'absensi.txt';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['check_whatsapp'])) {
    $check_whatsapp = htmlspecialchars($_POST['check_whatsapp']);
    $status_found = false;

    if (file_exists($filename)) {
        $file_contents = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($file_contents as $line) {
            if (strpos($line, "Nomor WhatsApp  : $check_whatsapp") !== false) {
                $status_found = true;
                break;
            }
        }
    }

    if ($status_found) {
        echo "<div style='font-family:Inter, sans-serif; background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%); color:white; min-height:100vh; padding:15px; position:relative; overflow:hidden;'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no'>
                <div style='background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(5px); padding:1.5rem; border-radius:15px; border:1px solid rgba(255,255,255,0.2); margin:15px;'>
                    <h2 style='font-size:1.5rem; margin-bottom:1rem; text-align:center;'>
                        <span style='font-size:1.8rem;'>✅</span> Sudah Absen
                    </h2>
                    <p style='font-size:0.9rem; margin-bottom:1.5rem;'>Tidak perlu absen lagi. Terima kasih!</p>
                    <a href='index.html' style='display:block; padding:12px; background:#ffc107; color:#1e3c72; border-radius:8px; text-decoration:none; font-weight:500;'>Kembali</a>
                </div>
              </div>";
    } else {
        $_SESSION['allowed_to_absen'] = true;
        $_SESSION['check_whatsapp'] = $check_whatsapp;
        header("Location: absen_form.php");
        exit;
    }
} else {
    echo "<div style='font-family:Inter, sans-serif; background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%); color:white; min-height:100vh; padding:15px; position:relative; overflow:hidden;'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no'>
            <div style='background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(5px); padding:1.5rem; border-radius:15px; border:1px solid rgba(255,255,255,0.2); margin:15px;'>
                <h2 style='font-size:1.5rem; margin-bottom:1rem; text-align:center;'>
                    <span style='font-size:1.8rem;'>❌</span> Data Tidak Valid
                </h2>
                <p style='font-size:0.9rem; margin-bottom:1.5rem;'>Silakan masukkan nomor WhatsApp valid.</p>
                <a href='index.html' style='display:block; padding:12px; background:#ffc107; color:#1e3c72; border-radius:8px; text-decoration:none; font-weight:500;'>Kembali</a>
            </div>
          </div>";
}
?>