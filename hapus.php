<?php
// File ini digunakan untuk menghapus data watchlist berdasarkan id yang dipilih.
require 'auth.php';
require 'koneksi.php';

// Mengambil id dari URL.
$id = (int)($_GET['id'] ?? 0);

// Query delete digunakan untuk menghapus data dari tabel movies.
mysqli_query($conn, "DELETE FROM movies WHERE id = $id");

// Setelah data dihapus, user diarahkan kembali ke halaman utama.
header('Location: index.php');
exit;
?>
