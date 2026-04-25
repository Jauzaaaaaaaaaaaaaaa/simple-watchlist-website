<?php
require 'auth.php';
require 'koneksi.php';

$judul = trim($_POST['judul'] ?? '');
$genre = trim($_POST['genre'] ?? '');
$tipe = trim($_POST['tipe'] ?? '');
$status_tonton = trim($_POST['status_tonton'] ?? '');
$rating = (int)($_POST['rating'] ?? 0);
$platform_id = (int)($_POST['platform_id'] ?? 0);

$stmt = mysqli_prepare($conn, 'INSERT INTO movies (judul, genre, tipe, status_tonton, rating, platform_id) VALUES (?, ?, ?, ?, ?, NULLIF(?, 0))');
mysqli_stmt_bind_param($stmt, 'ssssii', $judul, $genre, $tipe, $status_tonton, $rating, $platform_id);
mysqli_stmt_execute($stmt);

header('Location: index.php');
exit;
?>
