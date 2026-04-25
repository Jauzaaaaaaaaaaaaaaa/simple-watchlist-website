<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

$error = $_GET['error'] ?? '';
$success = $_GET['success'] ?? '';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Watchlist UJK</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body class="auth-body">
    <div class="auth-card">
        <h1>Login Watchlist Film &amp; Series</h1>
        <p class="subtitle">Masuk untuk mengelola daftar tontonan kamu.</p>

        <?php if ($error === 'invalid'): ?>
            <div class="alert error">Email atau password salah.</div>
        <?php endif; ?>

        <?php if ($success === 'logout'): ?>
            <div class="alert success">Kamu berhasil logout.</div>
        <?php endif; ?>

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

        <div class="auth-hint">
            <strong>Akun default:</strong><br>
            Email: admin@gmail.com<br>
            Password: admin123
        </div>
    </div>
</body>
</html>
