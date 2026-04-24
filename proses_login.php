<?php
// Session dijalankan agar data login bisa disimpan dan dipakai di halaman lain.
session_start();

// Memanggil file koneksi database.
require 'koneksi.php';

// Mengambil data email dan password dari form login.
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

// Jika email atau password kosong, user diarahkan kembali ke login dengan pesan error.
if ($email === '' || $password === '') {
    header('Location: login.php?error=invalid');
    exit;
}

// Query ini digunakan untuk mencari user berdasarkan email.
$stmt = mysqli_prepare($conn, 'SELECT id, name, email, password FROM users WHERE email = ? LIMIT 1');
mysqli_stmt_bind_param($stmt, 's', $email);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);

// password_verify digunakan untuk mencocokkan password input dengan password hash di database.
if ($user && password_verify($password, $user['password'])) {
    // Data berikut disimpan ke session agar user dianggap sudah login.
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_name'] = $user['name'];
    $_SESSION['user_email'] = $user['email'];

    // Jika login berhasil, user diarahkan ke halaman utama.
    header('Location: index.php');
    exit;
}

// Jika login gagal, user dikembalikan ke halaman login.
header('Location: login.php?error=invalid');
exit;
?>
