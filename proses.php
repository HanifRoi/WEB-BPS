<?php
// Sertakan file koneksi database
include 'koneksi.php';

// Pastikan request adalah metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // --- BAGIAN PROSES UPLOAD FILE ---
    $nama_file_baru = ''; // Variabel untuk menyimpan nama file di database
    $upload_error = '';

    // Cek apakah ada file yang diunggah dan tidak ada error
    if (isset($_FILES['file_evidence']) && $_FILES['file_evidence']['error'] == 0) {
        $target_dir = "uploads/"; // Folder tujuan
        $nama_file_asli = basename($_FILES["file_evidence"]["name"]);
        $file_type = strtolower(pathinfo($nama_file_asli, PATHINFO_EXTENSION));

        // Buat nama file yang unik untuk mencegah penimpaan file
        $nama_file_baru = uniqid() . '-' . time() . '.' . $file_type;
        $target_file = $target_dir . $nama_file_baru;

        // Validasi tipe file yang diizinkan
        $allowed_types = ['pdf', 'jpg', 'jpeg', 'png', 'docx'];
        if (!in_array($file_type, $allowed_types)) {
            $upload_error = "Maaf, hanya file PDF, JPG, PNG, & DOCX yang diizinkan.";
        }

        // Validasi ukuran file (misal: maksimal 5MB)
        if ($_FILES["file_evidence"]["size"] > 5000000) {
            $upload_error = "Maaf, ukuran file terlalu besar (maksimal 5MB).";
        }

        // Jika validasi lolos, pindahkan file
        if (empty($upload_error)) {
            if (!move_uploaded_file($_FILES["file_evidence"]["tmp_name"], $target_file)) {
                $upload_error = "Maaf, terjadi kesalahan saat mengunggah file.";
            }
        }
    }

    // Jika terjadi error saat upload, hentikan skrip dan kembali ke form dengan pesan error
    if (!empty($upload_error)) {
        header('Location: index.php?status=gagal&error=' . urlencode($upload_error));
        exit();
    }
    // --- AKHIR BAGIAN PROSES UPLOAD FILE ---


    // --- BAGIAN SIMPAN DATA KE DATABASE ---
    // Ambil dan bersihkan semua data dari form
    $indikator = mysqli_real_escape_string($koneksi, $_POST['indikator']);
    $bobot = mysqli_real_escape_string($koneksi, $_POST['bobot']);
    $penjelasan_indikator = mysqli_real_escape_string($koneksi, $_POST['penjelasan_indikator']);
    $pilihan_kematangan = mysqli_real_escape_string($koneksi, $_POST['pilihan_kematangan']);
    $jawaban_operator = (int)$_POST['jawaban_operator'];
    $penjelasan_jawaban = mysqli_real_escape_string($koneksi, $_POST['penjelasan_jawaban']);
    $link_evidence = mysqli_real_escape_string($koneksi, $_POST['link_evidence']);
    $jawaban_supervisor = (int)$_POST['jawaban_supervisor'];
    $catatan_supervisor = mysqli_real_escape_string($koneksi, $_POST['catatan_supervisor']);
    
    // Siapkan query SQL INSERT dengan semua kolom yang benar
    $sql = "INSERT INTO rekap_lke (
                indikator, bobot, penjelasan_indikator, pilihan_kematangan, jawaban_operator, 
                penjelasan_jawaban, link_evidence, file_evidence, jawaban_supervisor, catatan_supervisor
            ) VALUES (
                '$indikator', '$bobot', '$penjelasan_indikator', '$pilihan_kematangan', '$jawaban_operator', 
                '$penjelasan_jawaban', '$link_evidence', '$nama_file_baru', '$jawaban_supervisor', '$catatan_supervisor'
            )";

    // Eksekusi query
    if (mysqli_query($koneksi, $sql)) {
        // Jika berhasil, kembali ke index dengan status sukses
        header('Location: index.php?status=sukses');
    } else {
        // Jika gagal, kembali ke index dengan pesan error dari database
        header('Location: index.php?status=gagal&error=' . urlencode(mysqli_error($koneksi)));
    }

    // Tutup koneksi database
    mysqli_close($koneksi);
    // --- AKHIR BAGIAN SIMPAN DATA ---

} else {
    // Jika file ini diakses langsung tanpa melalui form, redirect ke halaman utama
    header('Location: index.php');
    exit();
}
?>