<?php
// Session dijalankan lebih dulu agar data session bisa dihapus.
session_start();

// session_unset digunakan untuk menghapus seluruh data session.
session_unset();

// session_destroy digunakan untuk benar-benar menutup session login.
session_destroy();

// Setelah logout, user diarahkan ke halaman login dengan status logout berhasil.
header('Location: login.php?success=logout');
exit;
?>
