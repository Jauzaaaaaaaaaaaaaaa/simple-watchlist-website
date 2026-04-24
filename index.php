<?php
require 'auth.php';
require 'koneksi.php';

$result = mysqli_query($conn, 'SELECT * FROM movies ORDER BY id DESC');
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Watchlist</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="page-wrap">
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
                    <?php if (mysqli_num_rows($result) > 0): ?>
                        <?php $no = 1; ?>
                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo htmlspecialchars($row['judul']); ?></td>
                                <td><?php echo htmlspecialchars($row['genre']); ?></td>
                                <td><span class="badge"><?php echo htmlspecialchars($row['tipe']); ?></span></td>
                                <td><?php echo htmlspecialchars($row['status_tonton']); ?></td>
                                <td><?php echo (int)$row['rating']; ?>/10</td>
                                <td class="actions">
                                    <a class="btn small warning" href="edit.php?id=<?php echo $row['id']; ?>">Edit</a>
                                    <a class="btn small danger" href="hapus.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Yakin ingin menghapus data ini?');">Hapus</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
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
