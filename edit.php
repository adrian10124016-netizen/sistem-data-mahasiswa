<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

// Ambil ID dari URL
$id = $_GET['id'];
$result = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE id = '$id'");
$data = mysqli_fetch_assoc($result);

// Jika ID tidak ditemukan di database, kembalikan ke index
if (!$data) {
    header("Location: index.php");
    exit;
}

$pesan = "";

if (isset($_POST['update'])) {
    $nim     = mysqli_real_escape_string($koneksi, $_POST['nim']);
    $nama    = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $jurusan = mysqli_real_escape_string($koneksi, $_POST['jurusan']);
    $email   = mysqli_real_escape_string($koneksi, $_POST['email']);

    if (!empty($nim) && !empty($nama) && !empty($jurusan) && !empty($email)) {
        $query = "UPDATE mahasiswa SET nim='$nim', nama='$nama', jurusan='$jurusan', email='$email' WHERE id='$id'";
        
        if (mysqli_query($koneksi, $query)) {
            header("Location: index.php");
            exit;
        } else {
            $pesan = "Gagal memperbarui data: " . mysqli_error($koneksi);
        }
    } else {
        $pesan = "Semua kolom wajib diisi!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Data Mahasiswa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="card-container form-card">
    <h2>Edit Data Mahasiswa</h2>
    <p style="color: #666; font-size: 13px; margin-bottom: 20px;">Ubah informasi data mahasiswa</p>

    <?php if ($pesan): ?>
        <p class="error"><?= $pesan; ?></p>
    <?php endif; ?>

    <form action="" method="POST">
        <div class="form-group">
            <label>NIM</label>
            <input type="text" name="nim" value="<?= $data['nim']; ?>" required>
        </div>
        <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" name="nama" value="<?= $data['nama']; ?>" required>
        </div>
        <div class="form-group">
            <label>Jurusan</label>
            <input type="text" name="jurusan" value="<?= $data['jurusan']; ?>" required>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" value="<?= $data['email']; ?>" required>
        </div>
        <div style="display: flex; gap: 10px; margin-top: 20px;">
            <button type="submit" name="update" class="btn btn-primary" style="flex: 1;">Simpan Perubahan</button>
            <a href="index.php" class="btn btn-back" style="text-align: center;">Batal</a>
        </div>
    </form>
</div>

</body>
</html>