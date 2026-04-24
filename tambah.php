<?php require 'auth.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Watchlist</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="page-wrap narrow">
        <div class="form-card">
            <h1>Tambah Data Watchlist</h1>
            <form action="simpan.php" method="POST" class="form-grid">
                <div>
                    <label for="judul">Judul</label>
                    <input type="text" id="judul" name="judul" required>
                </div>
                <div>
                    <label for="genre">Genre</label>
                    <input type="text" id="genre" name="genre" required>
                </div>
                <div>
                    <label for="tipe">Tipe</label>
                    <select id="tipe" name="tipe" required>
                        <option value="Film">Film</option>
                        <option value="Series">Series</option>
                    </select>
                </div>
                <div>
                    <label for="status_tonton">Status Tonton</label>
                    <select id="status_tonton" name="status_tonton" required>
                        <option value="Belum Ditonton">Belum Ditonton</option>
                        <option value="Sedang Ditonton">Sedang Ditonton</option>
                        <option value="Selesai">Selesai</option>
                    </select>
                </div>
                <div>
                    <label for="rating">Rating (0-10)</label>
                    <input type="number" id="rating" name="rating" min="0" max="10" required>
                </div>
                <div class="form-actions">
                    <a href="index.php" class="btn secondary">Kembali</a>
                    <button type="submit" class="btn primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
