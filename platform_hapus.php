<?php
require 'auth.php';
require_post_csrf();
require 'koneksi.php';

$id = (int)($_POST['id'] ?? 0);

if ($id > 0) {
    $stmt = mysqli_prepare($conn, 'DELETE FROM platforms WHERE id = ?');
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
}

header('Location: platforms.php');
exit;
?>
