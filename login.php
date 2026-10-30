<?php
session_start();
require_once 'koneksi.php';

// Jika pengguna sudah login, langsung lempar ke dashboard
if (isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = htmlspecialchars(trim($_POST['username']));
    $password = trim($_POST['password']);

    if (!empty($username) && !empty($password)) {
        $query = "SELECT * FROM users WHERE username = '$username'";
        $result = mysqli_query($koneksi, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
            // Verifikasi password (hash atau plain text)
            if (password_verify($password, $user['password']) || $password === $user['password']) {
                $_SESSION['username'] = $user['username'];
                header("Location: index.php");
                exit();
            } else {
                $error = ($_SESSION['lang'] == 'en') ? 'Invalid username or password!' : 'Nama pengguna atau kata sandi salah!';
            }
        } else {
            $error = ($_SESSION['lang'] == 'en') ? 'Invalid username or password!' : 'Nama pengguna atau kata sandi salah!';
        }
    } else {
        $error = ($_SESSION['lang'] == 'en') ? 'Please fill in all fields!' : 'Semua kolom wajib diisi!';
    }
}
?>
<!DOCTYPE html>
<html lang="<?= $_SESSION['lang']; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $txt['title_login']; ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body style="display: flex; justify-content: center; align-items: center; min-height: 100vh;">
    <div class="container" style="max-width: 400px; width: 100%;">
        <!-- Tombol Switcher Bahasa -->
        <div style="text-align: right; margin-bottom: 15px;">
            <span>🌐 </span>
            <a href="?lang=id" style="font-weight: <?= $_SESSION['lang'] == 'id' ? 'bold' : 'normal' ?>; text-decoration: none; color: inherit;">🇮🇩 ID</a> | 
            <a href="?lang=en" style="font-weight: <?= $_SESSION['lang'] == 'en' ? 'bold' : 'normal' ?>; text-decoration: none; color: inherit;">🇬🇧 EN</a>
        </div>

        <h2 style="text-align: center; margin-bottom: 20px;"><?= $txt['title_login']; ?></h2>

        <?php if (!empty($error)): ?>
            <div style="background: rgba(255, 0, 0, 0.2); border: 1px solid red; padding: 10px; border-radius: 8px; margin-bottom: 15px; text-align: center; color: #fff;">
                <?= $error; ?>
            </div>
        <?php endif; ?>

        <form action="" method="POST">
            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px;"><?= $txt['username']; ?></label>
                <input type="text" name="username" style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #ccc; box-sizing: border-box;" required>
            </div>
            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 5px;"><?= $txt['password']; ?></label>
                <input type="password" name="password" style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #ccc; box-sizing: border-box;" required>
            </div>
            <button type="submit" class="btn btn-primary" style="width: 100%; padding: 10px; border: none; border-radius: 8px; cursor: pointer; font-weight: bold;">
                <?= $txt['login']; ?>
            </button>
        </form>
    </div>
</body>
</html>