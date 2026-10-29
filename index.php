<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

require_once 'koneksi.php';

$query = "SELECT * FROM mahasiswa ORDER BY id DESC";
$result = mysqli_query($koneksi, $query);
?>
<!DOCTYPE html>
<html lang="<?= $_SESSION['lang']; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $txt['title_dashboard']; ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <!-- Pengubah Bahasa & Header -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h2><?= $txt['title_dashboard']; ?></h2>
            <div style="background: rgba(255,255,255,0.2); padding: 6px 12px; border-radius: 20px;">
                <span>🌐 </span>
                <a href="?lang=id" style="font-weight: <?= $_SESSION['lang'] == 'id' ? 'bold' : 'normal' ?>; text-decoration: none; color: inherit;">🇮🇩 ID</a> | 
                <a href="?lang=en" style="font-weight: <?= $_SESSION['lang'] == 'en' ? 'bold' : 'normal' ?>; text-decoration: none; color: inherit;">🇬🇧 EN</a>
            </div>
        </div>

        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <p><?= $txt['welcome']; ?>, <strong><?= htmlspecialchars($_SESSION['username']); ?></strong>!</p>
            <div>
                <a href="tambah.php" class="btn btn-primary" style="margin-right: 10px;">+ <?= $txt['tambah_data']; ?></a>
                <a href="logout.php" class="btn btn-danger"><?= $txt['logout']; ?></a>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th><?= $txt['nim']; ?></th>
                    <th><?= $txt['nama']; ?></th>
                    <th><?= $txt['jurusan']; ?></th>
                    <th><?= $txt['email']; ?></th>
                    <th><?= $txt['aksi']; ?></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $no = 1;
                if ($result && mysqli_num_rows($result) > 0):
                    while ($row = mysqli_fetch_assoc($result)): 
                ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= htmlspecialchars($row['nim']); ?></td>
                    <td><?= htmlspecialchars($row['nama']); ?></td>
                    <td><?= htmlspecialchars($row['jurusan']); ?></td>
                    <td><?= htmlspecialchars($row['email']); ?></td>
                    <td>
                        <a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-edit"><?= $txt['edit']; ?></a>
                        <a href="hapus.php?id=<?= $row['id']; ?>" class="btn btn-delete" onclick="return confirm('<?= $txt['konfirmasi_hapus']; ?>')"><?= $txt['hapus']; ?></a>
                    </td>
                </tr>
                <?php 
                    endwhile; 
                else:
                ?>
                <tr>
                    <td colspan="6" style="text-align: center;">Data tidak ditemukan / Kosong.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>