<?php
include 'koneksi.php';

// Cek ID dari URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: prinsip_sdi.php');
    exit();
}

$id = (int)$_GET['id'];
// Ambil data dari database
$sql = "SELECT * FROM rekap_lke WHERE id = $id";
$result = mysqli_query($koneksi, $sql);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    header('Location: prinsip_sdi.php');
    exit();
}

// Daftar instansi lengkap
$instansi_list = [
    'Badan Perencanaan Pembangunan, Riset, dan Inovasi Daerah', 'Dinas Komunikasi dan Informatika',
    'Badan Kepegawaian Dan Pengembangan Sumber Daya Manusia', 'Badan Kesatuan Bangsa Dan Politik',
    'Badan Penanggulangan Bencana Daerah', 'Badan Pengelolaan Keuangan Dan Pendapatan Daerah',
    'Dinas Kependudukan dan Catatan Sipil', 'Dinas Kesehatan Pengendalian Penduduk dan Keluarga Berencana',
    'Dinas Lingkungan Hidup Kelautan Dan Perikanan', 'Dinas Pariwisata dan Kebudayaan',
    'Dinas Pekerjaan Umum dan Penataan Ruang', 'Dinas Pemberdayaan Masyarakat dan Desa',
    'Dinas Penanaman Modal Dan Pelayanan Terpadu Satu Pintu', 'Dinas Pendidikan, Kepemudaan dan Olahraga',
    'Dinas Perindustrian, Perdagangan, Koperasi, Usaha Kecil Dan Menengah', 'Dinas Pertanian Dan Pangan',
    'Dinas Perumahan, Kawasan Permukiman Dan Perhubungan', 'Dinas Sosial, Pemberdayaan Perempuan Dan Perlindungan Anak',
    'Dinas Tenaga Kerja', 'Satuan Polisi Pamong Praja', 'Sekretariat Daerah', 'RSUD Prembun',
    'RSUD Dokter Sudirman', 'Inspektorat Daerah', 'Dinas Kearsipan Dan Perpustakaan'
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data LKE - BPS</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="header"></header>

    <div class="container">
        <div class="form-section">
            <h3>Edit Data LKE - Domain: <?= htmlspecialchars($data['domain']); ?></h3>
            
            <form action="proses_edit.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= htmlspecialchars($data['id']); ?>">
                <input type="hidden" name="domain" value="<?= htmlspecialchars($data['domain']); ?>">

                <div class="form-group">
                    <label for="instansi">Pilih Instansi</label>
                    <select id="instansi" name="instansi" required>
                        <?php
                        foreach ($instansi_list as $instansi) {
                            $selected = ($data['instansi'] == $instansi) ? 'selected' : '';
                            echo "<option value=\"$instansi\" $selected>$instansi</option>";
                        }
                        ?>
                    </select>
                </div>
                 <div class="form-group">
                    <label for="indikator">Domain/Aspek/Indikator</label>
                    <input type="text" id="indikator" name="indikator" value="<?= htmlspecialchars($data['indikator']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="bobot">Bobot</label>
                    <input type="text" id="bobot" name="bobot" value="<?= htmlspecialchars($data['bobot']); ?>" placeholder="Contoh: 0.25">
                </div>
                <div class="form-group">
                    <label for="penjelasan_indikator">Penjelasan Indikator</label>
                    <textarea name="penjelasan_indikator" rows="4"><?= htmlspecialchars($data['penjelasan_indikator']); ?></textarea>
                </div>
                <div class="form-group">
                    <label for="pilihan_kematangan">Pilihan Tingkat Kematangan</label>
                    <textarea name="pilihan_kematangan" rows="5"><?= htmlspecialchars($data['pilihan_kematangan']); ?></textarea>
                </div>
                <div class="form-group">
                    <label for="jawaban_operator">Jawaban Operator (Pilih 1-5)</label>
                    <input type="number" id="jawaban_operator" name="jawaban_operator" value="<?= htmlspecialchars($data['jawaban_operator']); ?>" min="1" max="5">
                </div>
                <div class="form-group">
                    <label for="link_evidence">Link Evidence/Bukti (Opsional)</label>
                    <input type="url" id="link_evidence" name="link_evidence" value="<?= htmlspecialchars($data['link_evidence']); ?>">
                </div>
                <div class="form-group">
                    <label for="file_evidence">Unggah File Evidence Baru (Kosongkan jika tidak ingin ganti)</label>
                    <input type="file" id="file_evidence" name="file_evidence">
                    <input type="hidden" name="file_lama" value="<?= htmlspecialchars($data['file_evidence']); ?>">
                    <?php if (!empty($data['file_evidence'])): ?>
                        <small>File saat ini: <a href="uploads/<?= htmlspecialchars($data['file_evidence']); ?>" target="_blank"><?= htmlspecialchars($data['file_evidence']); ?></a></small>
                    <?php endif; ?>
                </div>
                
                <button type="submit">Update Data</button>
            </form>
        </div>
    </div>
    <footer class="footer"></footer>
</body>
</html>