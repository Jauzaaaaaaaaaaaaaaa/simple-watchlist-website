<?php
/* Sesi yang aman dan token CSRF untuk aksi yang mengubah data. */
if (session_status() === PHP_SESSION_NONE) {
    session_set_cookie_params(['httponly' => true, 'samesite' => 'Lax', 'secure' => !empty($_SERVER['HTTPS'])]);
    session_start();
}

function csrf_token(): string
{
    if (empty($_SESSION['csrf'])) {
        $_SESSION['csrf'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf'];
}

function csrf_field(): string
{
    return '<input type="hidden" name="csrf" value="' . htmlspecialchars(csrf_token()) . '">';
}

function require_post_csrf(): void
{
    $token = $_POST['csrf'] ?? '';
    if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !is_string($token) || !hash_equals(csrf_token(), $token)) {
        http_response_code(403);
        exit('Permintaan ditolak. Muat ulang halaman lalu coba lagi.');
    }
}
