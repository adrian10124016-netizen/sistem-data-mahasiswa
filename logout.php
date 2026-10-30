<?php
session_start();

// 1. Simpan pilihan bahasa yang sedang aktif sebelum session dibersihkan
$lang_terakhir = $_SESSION['lang'] ?? 'id';

// 2. Hapus semua data session login
session_unset();
session_destroy();

// 3. Buat session baru khusus untuk mempertahankan pilihan bahasa
session_start();
$_SESSION['lang'] = $lang_terakhir;

// 4. Alihkan kembali ke halaman login
header("Location: login.php");
exit();
?>