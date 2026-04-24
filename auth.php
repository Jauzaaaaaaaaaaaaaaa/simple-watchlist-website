<?php
// File ini digunakan untuk memeriksa apakah user sudah login atau belum.
// Jika session belum aktif, maka session akan dijalankan terlebih dahulu.
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Kondisi ini digunakan untuk mengecek apakah data user_id ada di dalam session.
// Jika tidak ada, berarti user belum login dan harus diarahkan ke halaman login.
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
?>
