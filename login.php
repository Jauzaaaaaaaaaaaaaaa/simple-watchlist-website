<?php
require_once __DIR__ . '/security.php';

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
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Playfair+Display:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
<link rel="stylesheet" href="atelier/atelier.css">
<link rel="stylesheet" href="atelier/theme.css">
<script src="atelier/theme.js"></script>
<script src="atelier/atelier.js"></script>
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
            <?php echo csrf_field(); ?>
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
    </div>
</body>
</html>
