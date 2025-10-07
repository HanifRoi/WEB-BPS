<?php
// Sertakan file koneksi database
include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Data LKE EPSS Lengkap</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Formulir Input Data LKE EPSS</h1>

        <?php if(isset($_GET['status'])): ?>
            <?php if($_GET['status'] == 'sukses'): ?>
                <p class="pesan-sukses">Data dan file berhasil diunggah!</p>
            <?php else: ?>
                <p class="pesan-error">Terjadi kesalahan: <?= htmlspecialchars($_GET['error']) ?></p>
            <?php endif; ?>
        <?php endif; ?>

        <form action="proses.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="indikator">Domain/Aspek/Indikator</label>
                <input type="text" id="indikator" name="indikator" required>
            </div>
            <div class="form-group">
                <label for="bobot">Bobot</label>
                <input type="text" id="bobot" name="bobot">
            </div>
            <div class="form-group">
                <label for="penjelasan_indikator">Penjelasan Indikator</label>
                <textarea id="penjelasan_indikator" name="penjelasan_indikator" rows="4"></textarea>
            </div>
            <div class="form-group">
                <label for="pilihan_kematangan">Pilihan Tingkat Kematangan</label>
                <textarea id="pilihan_kematangan" name="pilihan_kematangan" rows="5" ></textarea>
            </div>
            <div class="form-group">
                <label for="jawaban_operator">Jawaban Operator (Pilih 1-5)</label>
                <input type="number" id="jawaban_operator" name="jawaban_operator" min="1" max="5">
            </div>
            <div class="form-group">
                <label for="penjelasan_jawaban">Penjelasan Tingkat Kematangan</label>
                <textarea id="penjelasan_jawaban" name="penjelasan_jawaban" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="link_evidence">Link Evidence/Bukti (Opsional)</label>
                <input type="url" id="link_evidence" name="link_evidence">
            </div>
            <div class="form-group">
                <label for="file_evidence">Unggah File Evidence (PDF, JPG, PNG, DOCX)</label>
                <input type="file" id="file_evidence" name="file_evidence">
            </div>
            <div class="form-group">
                <label for="jawaban_supervisor">Jawaban Supervisor (Pilih 1-5)</label>
                <input type="number" id="jawaban_supervisor" name="jawaban_supervisor" min="1" max="5">
            </div>
            <div class="form-group">
                <label for="catatan_supervisor">Catatan Supervisor</label>
                <textarea id="catatan_supervisor" name="catatan_supervisor" rows="3"></textarea>
            </div>
            <button type="submit">Simpan & Unggah</button>
        </form>

        <hr>

        <h2>Data Tersimpan</h2>
        <hr>

<h2>Data Tersimpan (Tampilan Lengkap)</h2>
<div class="table-wrapper">
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Indikator</th>
                <th>Bobot</th>
                <th>Penjelasan indikator</th>
                <th>Jawaban Op.</th>
                <th>penjelasan Jawaban</th>
                <th>Jawaban Spv.</th>
                <th>Bukti Link</th>
                <th>Bukti File</th>
                <th>Catatan Supervisor</th>
                </tr>
        </thead>
        <tbody>
            <?php
            // Ganti query SQL untuk mengambil SEMUA kolom dengan tanda bintang (*)
            $sql = "SELECT * FROM rekap_lke ORDER BY id DESC";
            $result = mysqli_query($koneksi, $sql);
            $nomor = 1;

            if (mysqli_num_rows($result) > 0) {
                // Looping untuk menampilkan setiap baris data
                while($data = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $nomor++ . "</td>";
                    echo "<td>" . htmlspecialchars($data['indikator']) . "</td>";
                    
                    echo "<td>" . htmlspecialchars($data['bobot']) . "</td>";
                    echo "<td>" . htmlspecialchars($data['penjelasan_indikator']) . "</td>";
                    echo "<td>" . htmlspecialchars($data['jawaban_operator']) . "</td>";
                    echo "<td>" . htmlspecialchars($data['penjelasan_jawaban']) . "</td>";
                    echo "<td>" . htmlspecialchars($data['jawaban_supervisor']) . "</td>";
                    
                    // Tampilkan link jika ada
                    if (!empty($data['link_evidence'])) {
                        echo "<td><a href='" . htmlspecialchars($data['link_evidence']) . "' target='_blank'>Lihat Link</a></td>";
                    } else {
                        echo "<td>-</td>";
                    }

                    // Tampilkan link ke file yang diunggah jika ada
                    if (!empty($data['file_evidence'])) {
                        echo "<td><a href='uploads/" . htmlspecialchars($data['file_evidence']) . "' target='_blank'>Lihat File</a></td>";
                    } else {
                        echo "<td>-</td>";
                    }
                    
                    echo "<td>" . htmlspecialchars($data['catatan_supervisor']) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='8'>Belum ada data yang tersimpan.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>
    </div>
</body>
</html>