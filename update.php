<?php
require 'auth.php';
require 'koneksi.php';

$id = (int)($_POST['id'] ?? 0);
$judul = trim($_POST['judul'] ?? '');
$genre = trim($_POST['genre'] ?? '');
$tipe = trim($_POST['tipe'] ?? '');
$status_tonton = trim($_POST['status_tonton'] ?? '');
$rating = (int)($_POST['rating'] ?? 0);
$platform_id = (int)($_POST['platform_id'] ?? 0);

$stmt = mysqli_prepare($conn, 'UPDATE movies SET judul = ?, genre = ?, tipe = ?, status_tonton = ?, rating = ?, platform_id = NULLIF(?, 0) WHERE id = ?');
mysqli_stmt_bind_param($stmt, 'ssssiii', $judul, $genre, $tipe, $status_tonton, $rating, $platform_id, $id);
mysqli_stmt_execute($stmt);

header('Location: index.php');
exit;
?>
