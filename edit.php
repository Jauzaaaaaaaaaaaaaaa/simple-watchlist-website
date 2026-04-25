<?php
require 'auth.php';
require 'koneksi.php';

$id = (int)($_GET['id'] ?? 0);
$result = mysqli_query($conn, "SELECT * FROM movies WHERE id = $id");
$data = mysqli_fetch_assoc($result);
$platforms = mysqli_query($conn, 'SELECT id, nama_platform FROM platforms ORDER BY nama_platform ASC');

if (!$data) {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Watchlist</title>
    <link rel="stylesheet" href="assets/style.css?v=3">
</head>
<body class="platform-form-page">
    <main class="platform-form-wrapper">
        <section class="platform-form-card">
            <div class="platform-form-header">
                <span class="platform-form-badge">Kelola Watchlist</span>
                <h1>Edit Data Watchlist</h1>
                <p>Perbarui informasi tontonan, mulai dari judul, genre, status tonton, rating, sampai platform streaming.</p>
            </div>

            <div class="platform-form-body">
                <form action="update.php" method="POST" class="platform-form-grid">
                    <input type="hidden" name="id" value="<?php echo (int)$data['id']; ?>">

                    <div class="platform-field full">
                        <label for="judul">🎬 Judul</label>
                        <input
                            type="text"
                            id="judul"
                            name="judul"
                            value="<?php echo htmlspecialchars($data['judul']); ?>"
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
                            value="<?php echo htmlspecialchars($data['genre']); ?>"
                            placeholder="Contoh: Sci-Fi, Action, Drama"
                            required
                        >
                    </div>

                    <div class="platform-field">
                        <label for="tipe">📺 Tipe</label>
                        <select id="tipe" name="tipe" required>
                            <option value="Film" <?php echo $data['tipe'] === 'Film' ? 'selected' : ''; ?>>Film</option>
                            <option value="Series" <?php echo $data['tipe'] === 'Series' ? 'selected' : ''; ?>>Series</option>
                        </select>
                    </div>

                    <div class="platform-field">
                        <label for="status_tonton">✅ Status Tonton</label>
                        <select id="status_tonton" name="status_tonton" required>
                            <option value="Belum Ditonton" <?php echo $data['status_tonton'] === 'Belum Ditonton' ? 'selected' : ''; ?>>Belum Ditonton</option>
                            <option value="Sedang Ditonton" <?php echo $data['status_tonton'] === 'Sedang Ditonton' ? 'selected' : ''; ?>>Sedang Ditonton</option>
                            <option value="Selesai" <?php echo $data['status_tonton'] === 'Selesai' ? 'selected' : ''; ?>>Selesai</option>
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
                            value="<?php echo (int)$data['rating']; ?>"
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
                                <option value="<?php echo (int)$platform['id']; ?>" <?php echo (int)$data['platform_id'] === (int)$platform['id'] ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($platform['nama_platform']); ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                        <small>Tambah atau ubah daftar platform melalui menu Kelola Platform.</small>
                    </div>

                    <div class="platform-form-actions full">
                        <a href="index.php" class="platform-btn-muted">← Kembali</a>
                        <button type="submit" class="platform-btn-main">Update Watchlist →</button>
                    </div>
                </form>
            </div>
        </section>
    </main>
</body>
</html>
