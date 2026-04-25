<?php
require 'auth.php';
require 'koneksi.php';

$platforms = mysqli_query($conn, 'SELECT id, nama_platform FROM platforms ORDER BY nama_platform ASC');
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Watchlist</title>
    <link rel="stylesheet" href="assets/style.css?v=3">
</head>
<body class="platform-form-page">
    <main class="platform-form-wrapper">
        <section class="platform-form-card">
            <div class="platform-form-header">
                <span class="platform-form-badge">Kelola Watchlist</span>
                <h1>Tambah Data Watchlist</h1>
                <p>Tambahkan film atau series baru ke daftar tontonan, lengkap dengan status, rating, dan platform streaming.</p>
            </div>

            <div class="platform-form-body">
                <form action="simpan.php" method="POST" class="platform-form-grid">
                    <div class="platform-field full">
                        <label for="judul">🎬 Judul</label>
                        <input
                            type="text"
                            id="judul"
                            name="judul"
                            placeholder="Contoh: Stranger Things"
                            required
                        >
                    </div>

                    <div class="platform-field">
                        <label for="genre">🎭 Genre</label>
                        <input
                            type="text"
                            id="genre"
                            name="genre"
                            placeholder="Contoh: Sci-Fi, Action, Drama"
                            required
                        >
                    </div>

                    <div class="platform-field">
                        <label for="tipe">📺 Tipe</label>
                        <select id="tipe" name="tipe" required>
                            <option value="Film">Film</option>
                            <option value="Series">Series</option>
                        </select>
                    </div>

                    <div class="platform-field">
                        <label for="status_tonton">✅ Status Tonton</label>
                        <select id="status_tonton" name="status_tonton" required>
                            <option value="Belum Ditonton">Belum Ditonton</option>
                            <option value="Sedang Ditonton">Sedang Ditonton</option>
                            <option value="Selesai">Selesai</option>
                        </select>
                    </div>

                    <div class="platform-field">
                        <label for="rating">⭐ Rating (0-10)</label>
                        <input
                            type="number"
                            id="rating"
                            name="rating"
                            min="0"
                            max="10"
                            placeholder="Contoh: 8"
                            required
                        >
                        <small>Gunakan angka dari 0 sampai 10.</small>
                    </div>

                    <div class="platform-field full">
                        <label for="platform_id">🌐 Platform</label>
                        <select id="platform_id" name="platform_id">
                            <option value="0">Belum dipilih</option>
                            <?php while ($platform = mysqli_fetch_assoc($platforms)): ?>
                                <option value="<?php echo (int)$platform['id']; ?>">
                                    <?php echo htmlspecialchars($platform['nama_platform']); ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                        <small>Tambah atau ubah daftar platform melalui menu Kelola Platform.</small>
                    </div>

                    <div class="platform-form-actions full">
                        <a href="index.php" class="platform-btn-muted">← Kembali</a>
                        <button type="submit" class="platform-btn-main">Simpan Watchlist →</button>
                    </div>
                </form>
            </div>
        </section>
    </main>
</body>
</html>
