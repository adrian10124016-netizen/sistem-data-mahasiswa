<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

$pesan = "";

if (isset($_POST['simpan'])) {
    $nim     = mysqli_real_escape_string($koneksi, $_POST['nim']);
    $nama    = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $jurusan = mysqli_real_escape_string($koneksi, $_POST['jurusan']);
    $email   = mysqli_real_escape_string($koneksi, $_POST['email']);

    if (!empty($nim) && !empty($nama) && !empty($jurusan) && !empty($email)) {
        $query = "INSERT INTO mahasiswa (nim, nama, jurusan, email) VALUES ('$nim', '$nama', '$jurusan', '$email')";
        
        if (mysqli_query($koneksi, $query)) {
            header("Location: index.php");
            exit;
        } else {
            $pesan = "Gagal menambah data: " . mysqli_error($koneksi);
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
    <title>Tambah Data Mahasiswa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="card-container form-card">
    <h2>Tambah Data Mahasiswa</h2>
    <p style="color: #666; font-size: 13px; margin-bottom: 20px;">Isi formulir di bawah untuk menambah mahasiswa</p>

    <?php if ($pesan): ?>
        <p class="error"><?= $pesan; ?></p>
    <?php endif; ?>

    <form action="" method="POST">
        <div class="form-group">
            <label>NIM</label>
            <input type="text" name="nim" placeholder="Contoh: 210101001" required autocomplete="off">
        </div>
        <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" name="nama" placeholder="Masukkan nama lengkap" required>
        </div>
        <div class="form-group">
            <label>Jurusan</label>
            <input type="text" name="jurusan" placeholder="Contoh: Teknik Informatika" required>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" placeholder="nama@email.com" required>
        </div>
        <div style="display: flex; gap: 10px; margin-top: 20px;">
            <button type="submit" name="simpan" class="btn btn-primary" style="flex: 1;">Simpan Data</button>
            <a href="index.php" class="btn btn-back" style="text-align: center;">Batal</a>
        </div>
    </form>
</div>

</body>
</html>