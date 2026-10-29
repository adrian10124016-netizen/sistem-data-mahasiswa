<?php
session_start();
include 'koneksi.php';

if (isset($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}

$error = "";

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = $_POST['password'];

    $result = mysqli_query($koneksi, "SELECT * FROM users WHERE username = '$username'");

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            $_SESSION['login'] = true;
            $_SESSION['username'] = $row['username'];
            header("Location: index.php");
            exit;
        }
    }
    $error = "Username atau password salah!";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Sistem Data Mahasiswa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="card-container login-card">
    <h2 style="text-align: center;">Portal Akademik</h2>
    <p style="text-align: center; color: #666; font-size: 13px; margin-bottom: 20px;">Silakan login untuk mengelola data</p>

    <?php if ($error): ?>
        <p class="error"><?= $error; ?></p>
    <?php endif; ?>

    <form action="" method="POST">
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" placeholder="Masukkan username" required autocomplete="off">
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" placeholder="Masukkan password" required>
        </div>
        <button type="submit" name="login" class="btn btn-primary">Masuk Sistem</button>
    </form>
</div>

</body>
</html>