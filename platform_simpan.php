<?php
require 'auth.php';
require 'koneksi.php';

$nama_platform = trim($_POST['nama_platform'] ?? '');
$website = trim($_POST['website'] ?? '');
$biaya_bulanan = (float)($_POST['biaya_bulanan'] ?? 0);
$keterangan = trim($_POST['keterangan'] ?? '');

if ($nama_platform === '') {
    header('Location: platform_tambah.php');
    exit;
}

$stmt = mysqli_prepare($conn, 'INSERT INTO platforms (nama_platform, website, biaya_bulanan, keterangan) VALUES (?, NULLIF(?, ""), ?, NULLIF(?, ""))');
mysqli_stmt_bind_param($stmt, 'ssds', $nama_platform, $website, $biaya_bulanan, $keterangan);
mysqli_stmt_execute($stmt);

header('Location: platforms.php');
exit;
?>
