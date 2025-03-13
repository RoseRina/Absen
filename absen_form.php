<?php
session_start();
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Isi Form Absensi</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #2563eb;
            --secondary: #60a5fa;
            --accent: #f59e0b;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: #fff;
            min-height: 100vh;
            padding: 10px;
            position: relative;
            overflow-x: hidden;
            font-size: 14px;
        }
        
        body::before {
            content: '';
            position: absolute;
            top: -50px;
            left: -50px;
            right: -50px;
            bottom: -50px;
            background: linear-gradient(45deg, 
                rgba(255,255,255,0.05) 0%,
                rgba(255,255,255,0.1) 100%);
            z-index: -1;
            animation: gradientShift 20s ease infinite;
        }

        .container {
            width: 100%;
            margin: 0;
            padding: 1rem;
            border-radius: 15px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.2);
            box-shadow: 0 8px 32px rgba(0,0,0,0.3);
        }

        h2 {
            text-align: center;
            margin-bottom: 1.5rem;
            background: linear-gradient(45deg, #ffc107, #f59e0b);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-size: 1.5rem;
            padding-bottom: 0.5rem;
            position: relative;
        }

        h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 3px;
            background: linear-gradient(90deg, transparent, #ffc107, transparent);
        }

        .alert-warning {
            background: rgba(255, 244, 204, 0.2);
            border: 1px solid #ffc107;
            border-radius: 10px;
            padding: 0.8rem;
            margin-bottom: 1rem;
            text-align: center;
            color: #ffc107;
            font-size: 0.9rem;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 0.3rem;
        }

        label {
            font-weight: 500;
            color: #ffc107;
            font-size: 0.9rem;
        }

        input, select, textarea {
            width: 100%;
            padding: 0.8rem;
            border: 2px solid rgba(255,255,255,0.2);
            border-radius: 8px;
            background: rgba(255,255,255,0.9);
            color: #1e3c72;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        textarea {
            min-height: 120px;
            resize: vertical;
        }

        select {
            -webkit-appearance: none;
            background-image: url("data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22292.4%22%20height%3D%22292.4%22%3E%3Cpath%20fill%3D%22%231e3c72%22%20d%3D%22M287%2069.4a17.6%2017.6%200%200%200-13-5.4H18.4c-5%200-9.3%201.8-12.9%205.4A17.6%2017.6%200%200%200%200%2082.2c0%205%201.8%209.3%205.4%2012.9l128%20127.9c3.6%203.6%207.8%205.4%2012.8%205.4s9.2-1.8%2012.8-5.4L287%2095c3.5-3.5%205.4-7.8%205.4-12.8%200-5-1.9-9.2-5.5-12.8z%22%2F%3E%3C%2Fsvg%3E");
            background-repeat: no-repeat;
            background-position: right 0.7rem top 50%;
            background-size: 0.65rem auto;
        }

        button {
            width: 100%;
            background: linear-gradient(45deg, #ffc107, #f59e0b);
            color: #1e3c72;
            border: none;
            padding: 1rem;
            font-size: 1rem;
            font-weight: 700;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            margin-top: 0.5rem;
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(245, 158, 11, 0.3);
        }

        /* Desktop override */
        @media (min-width: 600px) {
            body {
                padding: 20px;
                font-size: 16px;
            }
            
            .container {
                max-width: 500px;
                margin: 0 auto;
                padding: 2rem;
            }
            
            h2 {
                font-size: 1.8rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>📱 Absen Mobile</h2>
        
        <div class="alert-warning">
            <strong>⚠️ Pastikan nomor WhatsApp benar!</strong>
        </div>

        <form action="process.php" method="post">
            <div class="form-group">
                <label for="name">Nama Lengkap</label>
                <input type="text" id="name" name="name" placeholder="Masukkan nama lengkap Anda" required>
            </div>

            <div class="form-group">
                <label for="whatsapp">Nomor WhatsApp</label>
                <input type="text" id="whatsapp" name="whatsapp" value="<?php echo htmlspecialchars($_SESSION['check_whatsapp']); ?>" readonly>
            </div>

            <div class="form-group">
                <label for="group">Grup yang Diikuti</label>
                <select id="group" name="group" required>
                    <option value="">-- Pilih Grup --</option>
                    <option value="Grup 1">🇵 🇪 🇯 🇺 🇦 🇳 🇬 🇨 🇺 🇦 🇳 1</option>
                    <option value="Grup 2">🇵 🇪 🇯 🇺 🇦 🇳 🇬 🇨 🇺 🇦 🇳 2</option>
                    <option value="Grup 3">🇵 🇪 🇯 🇺 🇦 🇳 🇬 🇨 🇺 🇦 🇳 3</option>
                    <option value="Semuanya">Semuanya saya Join</option>
                </select>
            </div>

            <div class="form-group">
                <label for="feedback">Kritik & Saran</label>
                <textarea id="feedback" name="feedback" placeholder="Berikan masukan untuk pengembangan grup..." required></textarea>
            </div>

            <button type="submit">Kirim Absensi 🚀</button>
        </form>
    </div>
</body>
</html>