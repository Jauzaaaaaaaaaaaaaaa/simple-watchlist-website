<?php
require 'auth.php';
require_post_csrf();
require 'koneksi.php';

$id = (int)($_POST['id'] ?? 0);
mysqli_query($conn, "DELETE FROM movies WHERE id = $id");

header('Location: index.php');
exit;
?>
