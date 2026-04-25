<?php require 'auth.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Platform</title>
    <link rel="stylesheet" href="assets/style.css?v=3">
</head>
<body class="platform-form-page">
    <main class="platform-form-wrapper">
        <section class="platform-form-card">
            <div class="platform-form-header">
                <span class="platform-form-badge">Kelola Platform</span>
                <h1>Tambah Platform Streaming</h1>
                <p>Tambahkan platform streaming baru supaya bisa dipilih saat membuat data watchlist.</p>
            </div>

            <div class="platform-form-body">
                <form action="platform_simpan.php" method="POST" class="platform-form-grid">
                    <div class="platform-field">
                        <label for="nama_platform">Nama Platform</label>
                        <input
                            type="text"
                            id="nama_platform"
                            name="nama_platform"
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
                            placeholder="Contoh: 65000"
                        >
                        <small>Masukkan angka saja, tanpa Rp atau titik.</small>
                    </div>

                    <div class="platform-field full">
                        <label for="website">Website</label>
                        <input
                            type="url"
                            id="website"
                            name="website"
                            placeholder="https://www.example.com"
                        >
                    </div>

                    <div class="platform-field full">
                        <label for="keterangan">Keterangan</label>
                        <textarea
                            id="keterangan"
                            name="keterangan"
                            placeholder="Tulis keterangan singkat tentang platform ini..."
                        ></textarea>
                    </div>

                    <div class="platform-form-actions full">
                        <a href="platforms.php" class="btn platform-btn-muted">Kembali</a>
                        <button type="submit" class="btn platform-btn-main">Simpan Platform</button>
                    </div>
                </form>
            </div>
        </section>
    </main>
</body>
</html>
