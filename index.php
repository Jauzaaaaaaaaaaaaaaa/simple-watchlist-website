<?php
// auth.php dipanggil agar halaman ini hanya bisa diakses setelah login.
require 'auth.php';

// Memanggil file koneksi database.
require 'koneksi.php';

// Query ini digunakan untuk mengambil semua data watchlist dari tabel movies.
// Data diurutkan dari id terbesar ke terkecil agar data terbaru tampil di atas.
$result = mysqli_query($conn, 'SELECT * FROM movies ORDER BY id DESC');
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Watchlist</title>
    <!-- Menghubungkan file CSS agar tampilan tabel dan tombol menjadi rapi. -->
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <!-- page-wrap digunakan untuk memberi lebar maksimal dan jarak atas halaman. -->
    <div class="page-wrap">
        <!-- topbar digunakan untuk menata judul di kiri dan tombol aksi di kanan. -->
        <div class="topbar">
            <div>
                <h1>Data Watchlist Film &amp; Series</h1>
                <p class="subtitle">Halo, <?php echo htmlspecialchars($_SESSION['user_name']); ?>. Kelola daftar tontonan kamu di sini.</p>
            </div>
            <div class="topbar-actions">
                <a href="tambah.php" class="btn primary">+ Tambah Data</a>
                <a href="logout.php" class="btn secondary">Logout</a>
            </div>
        </div>

        <!-- table-card digunakan untuk membungkus tabel agar terlihat seperti card. -->
        <div class="table-card">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Genre</th>
                        <th>Tipe</th>
                        <th>Status</th>
                        <th>Rating</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Kondisi ini digunakan untuk mengecek apakah tabel memiliki data. -->
                    <?php if (mysqli_num_rows($result) > 0): ?>
                        <?php $no = 1; ?>
                        <!-- while digunakan untuk menampilkan setiap baris data watchlist. -->
                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo htmlspecialchars($row['judul']); ?></td>
                                <td><?php echo htmlspecialchars($row['genre']); ?></td>
                                <td><span class="badge"><?php echo htmlspecialchars($row['tipe']); ?></span></td>
                                <td><?php echo htmlspecialchars($row['status_tonton']); ?></td>
                                <td><?php echo (int)$row['rating']; ?>/10</td>
                                <td class="actions">
                                    <!-- Tombol edit digunakan untuk membuka halaman edit berdasarkan id data. -->
                                    <a class="btn small warning" href="edit.php?id=<?php echo $row['id']; ?>">Edit</a>
                                    <!-- Tombol hapus digunakan untuk menghapus data dan disertai konfirmasi. -->
                                    <a class="btn small danger" href="hapus.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Yakin ingin menghapus data ini?');">Hapus</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <!-- Pesan ini muncul jika belum ada data watchlist sama sekali. -->
                        <tr>
                            <td colspan="7" class="empty">Belum ada data watchlist.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
