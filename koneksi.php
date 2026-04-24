<?php
// Variabel berikut digunakan untuk menyimpan konfigurasi koneksi database.
$host = 'localhost';      // Nama host database, biasanya localhost jika memakai XAMPP.
$user = 'root';           // Username default MySQL di XAMPP.
$pass = '';               // Password default MySQL di XAMPP biasanya kosong.
$db   = 'watchlist_ujk';  // Nama database yang dipakai project.

// Baris ini digunakan untuk membuat koneksi antara PHP dan MySQL.
$conn = mysqli_connect($host, $user, $pass, $db);

// Kondisi ini digunakan untuk memastikan koneksi database berhasil.
// Jika gagal, maka program akan berhenti dan menampilkan pesan error.
if (!$conn) {
    die('Koneksi database gagal: ' . mysqli_connect_error());
}
?>
