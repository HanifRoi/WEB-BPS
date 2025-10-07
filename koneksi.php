<?php
// Pengaturan koneksi database
$db_host = 'localhost';     // Biasanya 'localhost'
$db_user = 'root';          // Default user XAMPP
$db_pass = '';              // Default password XAMPP kosong
$db_name = 'db_epss';       // Nama database yang Anda buat

// Membuat koneksi
$koneksi = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

// Cek koneksi
if (!$koneksi) {
    // Jika koneksi gagal, hentikan skrip dan tampilkan pesan error
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}
?>