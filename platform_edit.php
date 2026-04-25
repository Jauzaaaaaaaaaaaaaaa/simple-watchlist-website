<?php
require 'auth.php';
require 'koneksi.php';

$id = (int)($_GET['id'] ?? 0);

$stmt = mysqli_prepare($conn, 'SELECT * FROM platforms WHERE id = ? LIMIT 1');
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    header('Location: platforms.php');
    exit;
}

$namaPlatform = htmlspecialchars($data['nama_platform'] ?? '', ENT_QUOTES, 'UTF-8');
$website = htmlspecialchars($data['website'] ?? '', ENT_QUOTES, 'UTF-8');
$biayaBulanan = htmlspecialchars($data['biaya_bulanan'] ?? '0', ENT_QUOTES, 'UTF-8');
$keterangan = htmlspecialchars($data['keterangan'] ?? '', ENT_QUOTES, 'UTF-8');
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Platform</title>
    <link rel="stylesheet" href="assets/style.css?v=3">
</head>
<body class="platform-form-page">
    <main class="platform-form-wrapper">
        <section class="platform-form-card">
            <div class="platform-form-header">
                <span class="platform-form-badge">Kelola Platform</span>
                <h1>Edit Platform Streaming</h1>
                <p>Perbarui informasi platform streaming agar data watchlist tetap rapi dan mudah dipilih.</p>
            </div>

            <div class="platform-form-body">
                <form action="platform_update.php" method="POST" class="platform-form-grid">
                    <input type="hidden" name="id" value="<?php echo (int)$data['id']; ?>">

                    <div class="platform-field">
                        <label for="nama_platform">Nama Platform</label>
                        <input
                            type="text"
                            id="nama_platform"
                            name="nama_platform"
                            value="<?php echo $namaPlatform; ?>"
                            placeholder="Contoh: Netflix"
                            required
                        >
                    </div>

                    <div class="platform-field">
                        <label for="biaya_bulanan">Biaya Bulanan</label>
                        <input
                            type="number"
                            id="biaya_bulanan"
                            name="biaya_bulanan"
                            min="0"
                            step="500"
                            value="<?php echo $biayaBulanan; ?>"
                            placeholder="Contoh: 59000"
                        >
                        <small>Masukkan angka saja, tanpa Rp atau titik.</small>
                    </div>

                    <div class="platform-field full">
                        <label for="website">Website</label>
                        <input
                            type="url"
                            id="website"
                            name="website"
                            value="<?php echo $website; ?>"
                            placeholder="https://www.example.com"
                        >
                    </div>

                    <div class="platform-field full">
                        <label for="keterangan">Keterangan</label>
                        <textarea
                            id="keterangan"
                            name="keterangan"
                            placeholder="Tulis keterangan singkat tentang platform ini..."
                        ><?php echo $keterangan; ?></textarea>
                    </div>

                    <div class="platform-form-actions full">
                        <a href="platforms.php" class="btn platform-btn-muted">Kembali</a>
                        <button type="submit" class="btn platform-btn-main">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </section>
    </main>
</body>
</html>
