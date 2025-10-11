<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Ambil semua data dari form, TERMASUK DOMAIN
    $id = (int)$_POST['id'];
    $domain = mysqli_real_escape_string($koneksi, $_POST['domain']);
    $instansi = mysqli_real_escape_string($koneksi, $_POST['instansi']);
    $indikator = mysqli_real_escape_string($koneksi, $_POST['indikator']);
    $bobot = mysqli_real_escape_string($koneksi, $_POST['bobot']);
    $penjelasan_indikator = mysqli_real_escape_string($koneksi, $_POST['penjelasan_indikator']);
    $pilihan_kematangan = mysqli_real_escape_string($koneksi, $_POST['pilihan_kematangan']);
    $jawaban_operator = (int)$_POST['jawaban_operator'];
    $link_evidence = mysqli_real_escape_string($koneksi, $_POST['link_evidence']);
    $file_lama = mysqli_real_escape_string($koneksi, $_POST['file_lama']);

    // Siapkan query SQL UPDATE dasar
    $sql = "UPDATE rekap_lke SET 
                instansi = '$instansi',
                indikator = '$indikator',
                bobot = '$bobot',
                penjelasan_indikator = '$penjelasan_indikator',
                pilihan_kematangan = '$pilihan_kematangan',
                jawaban_operator = '$jawaban_operator',
                link_evidence = '$link_evidence'";

    // Logika cerdas untuk update file (tidak berubah)
    if (isset($_FILES['file_evidence']) && $_FILES['file_evidence']['error'] == 0) {
        $target_dir = "uploads/";
        $nama_file_asli = basename($_FILES["file_evidence"]["name"]);
        $file_type = strtolower(pathinfo($nama_file_asli, PATHINFO_EXTENSION));
        $nama_file_baru = uniqid() . '-' . time() . '.' . $file_type;
        $target_file = $target_dir . $nama_file_baru;
        
        if (move_uploaded_file($_FILES["file_evidence"]["tmp_name"], $target_file)) {
            $sql .= ", file_evidence = '$nama_file_baru'";
            if (!empty($file_lama) && file_exists($target_dir . $file_lama)) {
                unlink($target_dir . $file_lama);
            }
        }
    }

    $sql .= " WHERE id = $id";

    // ====== LOGIKA REDIRECT CERDAS ======
    if (mysqli_query($koneksi, $sql)) {
        // Jika berhasil, kembali ke halaman dashboard yang sesuai
        if ($domain == 'Prinsip SDI') {
            header('Location: prinsip_sdi.php?status=update_sukses');
        } else if ($domain == 'Kualitas Data') {
            header('Location: kualitas_data.php?status=update_sukses');
        } else {
            // Fallback jika ada domain lain
            header('Location: index.php');
        }
    } else {
        // Jika gagal, kembali ke halaman edit dengan pesan error
        header('Location: edit_data.php?id=' . $id . '&status=gagal');
    }
    // ===================================

    mysqli_close($koneksi);

} else {
    header('Location: index.php');
}
?>