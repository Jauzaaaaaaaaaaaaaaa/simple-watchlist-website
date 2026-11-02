<?php
require 'auth.php';
require 'koneksi.php';

$result = mysqli_query($conn, '
    SELECT platforms.*, COUNT(movies.id) AS total_watchlist
    FROM platforms
    LEFT JOIN movies ON movies.platform_id = platforms.id
    GROUP BY platforms.id
    ORDER BY platforms.id DESC
');
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Platform Streaming</title>
    <link rel="stylesheet" href="assets/style.css">
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Playfair+Display:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
<link rel="stylesheet" href="atelier/atelier.css">
<link rel="stylesheet" href="atelier/theme.css">
<script src="atelier/theme.js"></script>
<script src="atelier/atelier.js"></script>
</head>
<body>
    <div class="page-wrap">
        <div class="topbar">
            <div>
                <h1>Data Platform Streaming</h1>
                <p class="subtitle">Kelola data platform sebagai tabel tambahan yang terhubung dengan watchlist.</p>
            </div>
            <div class="topbar-actions">
                <a href="platform_tambah.php" class="btn primary">+ Tambah Platform</a>
                <a href="index.php" class="btn secondary">Kembali ke Watchlist</a>
            </div>
        </div>

        <div class="table-card">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Platform</th>
                        <th>Website</th>
                        <th>Biaya Bulanan</th>
                        <th>Keterangan</th>
                        <th>Total Watchlist</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (mysqli_num_rows($result) > 0): ?>
                        <?php $no = 1; ?>
                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo htmlspecialchars($row['nama_platform']); ?></td>
                                <td>
                                    <?php if ($row['website']): ?>
                                        <a href="<?php echo htmlspecialchars($row['website']); ?>" target="_blank" rel="noopener" class="table-link">
                                            <?php echo htmlspecialchars($row['website']); ?>
                                        </a>
                                    <?php else: ?>
                                        <span class="text-muted">-</span>
                                    <?php endif; ?>
                                </td>
                                <td>Rp <?php echo number_format((float)$row['biaya_bulanan'], 0, ',', '.'); ?></td>
                                <td><?php echo $row['keterangan'] ? htmlspecialchars($row['keterangan']) : '<span class="text-muted">-</span>'; ?></td>
                                <td><span class="badge"><?php echo (int)$row['total_watchlist']; ?> data</span></td>
                                <td class="actions">
                                    <a class="btn small warning" href="platform_edit.php?id=<?php echo $row['id']; ?>">Edit</a>
                                    <form action="platform_hapus.php" method="POST" class="del-form" onsubmit="return confirm('Yakin ingin menghapus platform ini? Watchlist yang memakai platform ini akan menjadi Belum dipilih.')"><?php echo csrf_field(); ?><input type="hidden" name="id" value="<?php echo (int) $row['id']; ?>"><button type="submit" class="btn small danger">Hapus</button></form>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="empty">Belum ada data platform.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
