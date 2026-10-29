<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 1. Set default bahasa ke Indonesia jika belum ada
if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = 'id';
}

// 2. Ubah bahasa jika user mengklik tombol pengubah bahasa
if (isset($_GET['lang'])) {
    if ($_GET['lang'] == 'en') {
        $_SESSION['lang'] = 'en';
    } else {
        $_SESSION['lang'] = 'id';
    }
}

// 3. Kamus kata Bahasa Indonesia dan Bahasa Inggris
$lang = [
    'id' => [
        'title_login'      => 'Login Sistem Data Mahasiswa',
        'title_dashboard'  => 'Dashboard Data Mahasiswa',
        'title_tambah'     => 'Tambah Data Mahasiswa',
        'title_edit'       => 'Edit Data Mahasiswa',
        'welcome'          => 'Selamat Datang',
        'logout'           => 'Keluar',
        'login'            => 'Masuk',
        'username'         => 'Nama Pengguna',
        'password'         => 'Kata Sandi',
        'nim'              => 'NIM',
        'nama'             => 'Nama Lengkap',
        'jurusan'          => 'Jurusan',
        'email'            => 'Email',
        'aksi'             => 'Aksi',
        'tambah_data'      => 'Tambah Mahasiswa',
        'edit'             => 'Ubah',
        'hapus'            => 'Hapus',
        'simpan'           => 'Simpan',
        'kembali'          => 'Kembali',
        'konfirmasi_hapus' => 'Apakah Anda yakin ingin menghapus data ini?'
    ],
    'en' => [
        'title_login'      => 'Student Data System Login',
        'title_dashboard'  => 'Student Data Dashboard',
        'title_tambah'     => 'Add Student Data',
        'title_edit'       => 'Edit Student Data',
        'welcome'          => 'Welcome',
        'logout'           => 'Logout',
        'login'            => 'Login',
        'username'         => 'Username',
        'password'         => 'Password',
        'nim'              => 'Student ID (NIM)',
        'nama'             => 'Full Name',
        'jurusan'          => 'Major',
        'email'            => 'Email',
        'aksi'             => 'Action',
        'tambah_data'      => 'Add Student',
        'edit'             => 'Edit',
        'hapus'            => 'Delete',
        'simpan'           => 'Save',
        'kembali'          => 'Back',
        'konfirmasi_hapus' => 'Are you sure you want to delete this data?'
    ]
];

// Helper variabel untuk mengambil teks bahasa aktif
$txt = $lang[$_SESSION['lang']];
?>