<?php
// File ini digunakan untuk menampilkan form edit berdasarkan id data yang dipilih.
require 'auth.php';
require 'koneksi.php';

// Mengambil id dari URL lalu diubah menjadi integer untuk keamanan dasar.
$id = (int)($_GET['id'] ?? 0);

// Query ini digunakan untuk mengambil satu data movie sesuai id.
$result = mysqli_query($conn, "SELECT * FROM movies WHERE id = $id");
$data = mysqli_fetch_assoc($result);

// Jika data tidak ditemukan, user diarahkan kembali ke index.
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
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="page-wrap narrow">
        <div class="form-card">
            <h1>Edit Data Watchlist</h1>
            <!-- Form ini digunakan untuk mengirim data hasil edit ke update.php. -->
            <form action="update.php" method="POST" class="form-grid">
                <!-- Input hidden ini digunakan untuk membawa id data yang sedang diedit. -->
                <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
                <div>
                    <label for="judul">Judul</label>
                    <input type="text" id="judul" name="judul" value="<?php echo htmlspecialchars($data['judul']); ?>" required>
                </div>
                <div>
                    <label for="genre">Genre</label>
                    <input type="text" id="genre" name="genre" value="<?php echo htmlspecialchars($data['genre']); ?>" required>
                </div>
                <div>
                    <label for="tipe">Tipe</label>
                    <select id="tipe" name="tipe" required>
                        <option value="Film" <?php echo $data['tipe'] === 'Film' ? 'selected' : ''; ?>>Film</option>
                        <option value="Series" <?php echo $data['tipe'] === 'Series' ? 'selected' : ''; ?>>Series</option>
                    </select>
                </div>
                <div>
                    <label for="status_tonton">Status Tonton</label>
                    <select id="status_tonton" name="status_tonton" required>
                        <option value="Belum Ditonton" <?php echo $data['status_tonton'] === 'Belum Ditonton' ? 'selected' : ''; ?>>Belum Ditonton</option>
                        <option value="Sedang Ditonton" <?php echo $data['status_tonton'] === 'Sedang Ditonton' ? 'selected' : ''; ?>>Sedang Ditonton</option>
                        <option value="Selesai" <?php echo $data['status_tonton'] === 'Selesai' ? 'selected' : ''; ?>>Selesai</option>
                    </select>
                </div>
                <div>
                    <label for="rating">Rating (0-10)</label>
                    <input type="number" id="rating" name="rating" min="0" max="10" value="<?php echo (int)$data['rating']; ?>" required>
                </div>
                <div class="form-actions">
                    <a href="index.php" class="btn secondary">Kembali</a>
                    <button type="submit" class="btn primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
