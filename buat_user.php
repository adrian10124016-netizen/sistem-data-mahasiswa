<?php
include 'koneksi.php';

$username = 'admin';
$password = password_hash('admin123', PASSWORD_DEFAULT);

// Hapus user admin lama jika ada biar tidak bentrok
mysqli_query($koneksi, "DELETE FROM users WHERE username='$username'");

// Insert user admin baru dengan hash dari server lokal
$query = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

if (mysqli_query($koneksi, $query)) {
    echo "<h2>User admin berhasil dibuat/diperbarui!</h2>";
    echo "<p>Silakan klik link ini untuk login: <a href='login.php'>Ke Halaman Login</a></p>";
} else {
    echo "Gagal membuat user: " . mysqli_error($koneksi);
}
?>