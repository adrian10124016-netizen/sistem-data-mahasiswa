<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

$result = mysqli_query($koneksi, "SELECT * FROM mahasiswa ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Sistem Data Mahasiswa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="card-container">
    <div class="header">
        <div>
            <h2>Sistem Data Mahasiswa</h2>
            <p style="color: #666; font-size: 13px;">Kelola informasi mahasiswa secara online</p>
        </div>
        <div>
            <span style="margin-right: 10px; font-size: 14px;">Halo, <b><?= $_SESSION['username']; ?></b></span>
            <a href="logout.php" class="btn btn-logout" onclick="return confirm('Yakin ingin keluar?')">Logout</a>
        </div>
    </div>

    <a href="tambah.php" class="btn btn-add">+ Tambah Mahasiswa Baru</a>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>NIM</th>
                <th>Nama</th>
                <th>Jurusan</th>
                <th>Email</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            <?php if (mysqli_num_rows($result) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><b><?= $row['nim']; ?></b></td>
                        <td><?= $row['nama']; ?></td>
                        <td><?= $row['jurusan']; ?></td>
                        <td><?= $row['email']; ?></td>
                        <td>
                            <a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-edit">Edit</a>
                            <a href="hapus.php?id=<?= $row['id']; ?>" class="btn btn-delete" onclick="return confirm('Yakin hapus data ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" style="text-align: center; color: #888; padding: 30px;">Belum ada data mahasiswa terdaftar.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>