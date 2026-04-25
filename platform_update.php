<?php
require 'auth.php';
require 'koneksi.php';

$id = (int)($_POST['id'] ?? 0);
$nama_platform = trim($_POST['nama_platform'] ?? '');
$website = trim($_POST['website'] ?? '');
$biaya_bulanan = (float)($_POST['biaya_bulanan'] ?? 0);
$keterangan = trim($_POST['keterangan'] ?? '');

if ($id <= 0 || $nama_platform === '') {
    header('Location: platforms.php');
    exit;
}

$stmt = mysqli_prepare($conn, 'UPDATE platforms SET nama_platform = ?, website = NULLIF(?, ""), biaya_bulanan = ?, keterangan = NULLIF(?, "") WHERE id = ?');
mysqli_stmt_bind_param($stmt, 'ssdsi', $nama_platform, $website, $biaya_bulanan, $keterangan, $id);
mysqli_stmt_execute($stmt);

header('Location: platforms.php');
exit;
?>
