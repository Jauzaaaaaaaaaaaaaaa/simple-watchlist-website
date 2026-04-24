<?php
// File ini digunakan untuk menyimpan data baru hasil input form tambah.
require 'auth.php';
require 'koneksi.php';

// Mengambil data dari form tambah.
$judul = trim($_POST['judul'] ?? '');
$genre = trim($_POST['genre'] ?? '');
$tipe = trim($_POST['tipe'] ?? '');
$status_tonton = trim($_POST['status_tonton'] ?? '');
$rating = (int)($_POST['rating'] ?? 0);

// Query insert ini digunakan untuk memasukkan data baru ke tabel movies.
$stmt = mysqli_prepare($conn, 'INSERT INTO movies (judul, genre, tipe, status_tonton, rating) VALUES (?, ?, ?, ?, ?)');
mysqli_stmt_bind_param($stmt, 'ssssi', $judul, $genre, $tipe, $status_tonton, $rating);
mysqli_stmt_execute($stmt);

// Setelah data tersimpan, user diarahkan kembali ke halaman utama.
header('Location: index.php');
exit;
?>
