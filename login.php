<?php
// Bagian ini digunakan untuk memulai session jika session belum aktif.
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Jika user sudah login, maka user langsung diarahkan ke halaman utama.
if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

// Variabel ini digunakan untuk mengambil parameter error dan success dari URL.
$error = $_GET['error'] ?? '';
$success = $_GET['success'] ?? '';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Watchlist UJK</title>
    <!-- File CSS ini digunakan untuk mengatur tampilan halaman agar lebih rapi. -->
    <link rel="stylesheet" href="assets/style.css">
</head>
<body class="auth-body">
    <!-- auth-card digunakan untuk membungkus form login agar tampil seperti kartu di tengah halaman. -->
    <div class="auth-card">
        <h1>Login Watchlist Film &amp; Series</h1>
        <p class="subtitle">Masuk untuk mengelola daftar tontonan kamu.</p>

        <!-- Pesan ini ditampilkan jika email atau password salah. -->
        <?php if ($error === 'invalid'): ?>
            <div class="alert error">Email atau password salah.</div>
        <?php endif; ?>

        <!-- Pesan ini ditampilkan jika user berhasil logout. -->
        <?php if ($success === 'logout'): ?>
            <div class="alert success">Kamu berhasil logout.</div>
        <?php endif; ?>

        <!-- Form ini digunakan untuk mengirim email dan password ke proses_login.php. -->
        <form action="proses_login.php" method="POST" class="form-grid">
            <div>
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Masukkan email" required>
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Masukkan password" required>
            </div>
            <button type="submit" class="btn primary full">Login</button>
        </form>

        <!-- Bagian ini digunakan untuk menampilkan akun login default agar memudahkan pengujian project. -->
        <div class="auth-hint">
            <strong>Akun default:</strong><br>
            Email: admin@gmail.com<br>
            Password: admin123
        </div>
    </div>
</body>
</html>
