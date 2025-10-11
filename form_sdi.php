<?php
include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Input Data SDI - BPS</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header class="header">
        <div class="header-container">
            <div class="logo-container">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/e3/Logo_Badan_Pusat_Statistik_%28BPS%29_Indonesia.svg/2048px-Logo_Badan_Pusat_Statistik_%28BPS%29_Indonesia.svg.png" alt="Logo BPS">
            </div>
            <div class="brand-text">
                <h1>Badan Pusat Statistik</h1>
                <h2>Republik Indonesia</h2>
            </div>
        </div>
    </header>

    <div class="container">
        <div id="form-input-section" class="form-section">
            <h3>Formulir Input Data LKE - Prinsip SDI</h3>
             <?php if(isset($_GET['status']) && $_GET['status'] == 'gagal'): ?>
                <p class="pesan-error">Terjadi kesalahan: <?= htmlspecialchars($_GET['error']) ?></p>
            <?php endif; ?>

            <form action="proses.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="domain" value="Prinsip SDI">
                <div class="form-group">
                    <label for="instansi">Pilih Instansi</label>
                    <select id="instansi" name="instansi" required>
                        <option value="" disabled selected>-- Silakan Pilih Instansi --</option>
                        <option value="Badan Perencanaan Pembangunan, Riset, dan Inovasi Daerah">Badan Perencanaan Pembangunan, Riset, dan Inovasi Daerah</option>
                        <option value="Dinas Komunikasi dan Informatika">Dinas Komunikasi dan Informatika</option>
                        <option value="Badan Kepegawaian Dan Pengembangan Sumber Daya Manusia">Badan Kepegawaian Dan Pengembangan Sumber Daya Manusia</option>
            <option value="Badan Kesatuan Bangsa Dan Politik">Badan Kesatuan Bangsa Dan Politik</option>
            <option value="Badan Penanggulangan Bencana Daerah">Badan Penanggulangan Bencana Daerah</option>
            <option value="Badan Pengelolaan Keuangan Dan Pendapatan Daerah">Badan Pengelolaan Keuangan Dan Pendapatan Daerah</option>
            <option value="Dinas Kependudukan dan Catatan Sipil">Dinas Kependudukan dan Catatan Sipil</option>
            <option value="Dinas Kesehatan Pengendalian Penduduk dan Keluarga Berencana">Dinas Kesehatan Pengendalian Penduduk dan Keluarga Berencana</option>
            <option value="Dinas Lingkungan Hidup Kelautan Dan Perikanan">Dinas Lingkungan Hidup Kelautan Dan Perikanan</option>
            <option value="Dinas Pariwisata dan Kebudayaan">Dinas Pariwisata dan Kebudayaan</option>
            <option value="Dinas Pekerjaan Umum dan Penataan Ruang">Dinas Pekerjaan Umum dan Penataan Ruang</option>
            <option value="Dinas Pemberdayaan Masyarakat dan Desa">Dinas Pemberdayaan Masyarakat dan Desa</option>
            <option value="Dinas Penanaman Modal Dan Pelayanan Terpadu Satu Pintu">Dinas Penanaman Modal Dan Pelayanan Terpadu Satu Pintu</option>
            <option value="Dinas Pendidikan, Kepemudaan dan Olahraga">Dinas Pendidikan, Kepemudaan dan Olahraga</option>
            <option value="Dinas Perindustrian, Perdagangan, Koperasi, Usaha Kecil Dan Menengah">Dinas Perindustrian, Perdagangan, Koperasi, Usaha Kecil Dan Menengah</option>
            <option value="Dinas Pertanian Dan Pangan">Dinas Pertanian Dan Pangan</option>
            <option value="Dinas Perumahan, Kawasan Permukiman Dan Perhubungan">Dinas Perumahan, Kawasan Permukiman Dan Perhubungan</option>
            <option value="Dinas Sosial, Pemberdayaan Perempuan Dan Perlindungan Anak">Dinas Sosial, Pemberdayaan Perempuan Dan Perlindungan Anak</option>
            <option value="Dinas Tenaga Kerja">Dinas Tenaga Kerja</option>
            <option value="Satuan Polisi Pamong Praja">Satuan Polisi Pamong Praja</option>
            <option value="Sekretariat Daerah">Sekretariat Daerah</option>
            <option value="RSUD Prembun">RSUD Prembun</option>
            <option value="RSUD Dokter Sudirman">RSUD Dokter Sudirman</option>
            <option value="Inspektorat Daerah">Inspektorat Daerah</option>
            <option value="Dinas Kearsipan Dan Perpustakaan">Dinas Kearsipan Dan Perpustakaan</option>
                        </select>
                </div>
                <div class="form-group">
                    <label for="indikator">Domain/Aspek/Indikator</label>
                    <input type="text" id="indikator" name="indikator" required>
                </div>
                <div class="form-group">
    <label for="bobot">Bobot</label>
    <input type="text" id="bobot" name="bobot" placeholder="Contoh: 0.25">
</div>
                <div class="form-group">
                    <label for="penjelasan_indikator">Penjelasan Indikator</label>
                    <textarea id="penjelasan_indikator" name="penjelasan_indikator" rows="4"></textarea>
                </div>
                <div class="form-group">
                    <label for="pilihan_kematangan">Pilihan Tingkat Kematangan</label>
                    <textarea id="pilihan_kematangan" name="pilihan_kematangan" rows="5"></textarea>
                </div>
                <div class="form-group">
                    <label for="jawaban_operator">Jawaban Operator (Pilih 1-5)</label>
                    <input type="number" id="jawaban_operator" name="jawaban_operator" min="1" max="5">
                </div>
                <div class="form-group">
                    <label for="link_evidence">Link Evidence/Bukti (Opsional)</label>
                    <input type="url" id="link_evidence" name="link_evidence">
                </div>
                <div class="form-group">
                    <label for="file_evidence">Unggah File Evidence (PDF, JPG, PNG, DOCX)</label>
                    <input type="file" id="file_evidence" name="file_evidence">
                </div>
                <button type="submit">Simpan Data</button>
            </form>
        </div>
    </div>

    <footer class="footer">
        <p>&copy; 2024 Badan Pusat Statistik. Hak Cipta Dilindungi.</p>
    </footer>

</body>
</html>