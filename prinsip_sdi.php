<?php
include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Prinsip SDI - BPS</title>
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
        <div class="dashboard-header">
            <div class="dashboard-description">
                <h2>Prinsip Satu Data Indonesia (SDI)</h2>
                <p>Halaman ini berisi data terkait domain Prinsip SDI. Klik tombol "Input Data Baru" untuk menampilkan formulir.</p>
            </div>
            <div class="dashboard-actions">
                <a href="javascript:void(0);" id="tombol-input" onclick="toggleForm()" class="action-button">Input Data Baru</a>
            </div>
        </div>

        <hr>

        <div id="form-input-section" class="form-section" style="display: none;">
            <h3>Formulir Input Data LKE</h3>
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
                    <textarea id="pilihan_kematangan" name="pilihan_kematangan" rows="5" placeholder="Contoh: 1. A...&#10;2. B...&#10;3. C..."></textarea>
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
                <button type="submit">Simpan & Unggah</button>
            </form>
        </div>

        <div id="tabel-data" class="table-section">
            <div class="table-header">
                <h3>Data Tersimpan</h3>
                <div class="search-container">
                    <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Cari berdasarkan Indikator...">
                </div>
            </div>
             <div class="table-wrapper">
                <table id="dataTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Indikator</th>
                            <th>Penjelasan Indikator</th>
                            <th>Jawaban Op.</th>
                            <th>Bukti File</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM rekap_lke ORDER BY id DESC";
                        $result = mysqli_query($koneksi, $sql);
                        $nomor = 1;

                        if (mysqli_num_rows($result) > 0) {
                            while($data = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $nomor++ . "</td>";
                                echo "<td>" . htmlspecialchars($data['indikator']) . "</td>";
                                echo "<td>" . nl2br(htmlspecialchars($data['penjelasan_indikator'])) . "</td>";
                                echo "<td>" . htmlspecialchars($data['jawaban_operator']) . "</td>";
                                // echo "<td>" . htmlspecialchars($data['jawaban_supervisor']) . "</td>";
                                if (!empty($data['file_evidence'])) {
                                    echo "<td><a href='uploads/" . htmlspecialchars($data['file_evidence']) . "' target='_blank'>Lihat File</a></td>";
                                } else {
                                    echo "<td>-</td>";
                                }
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>Belum ada data yang tersimpan.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <footer class="footer">
        <p>&copy; 2024 Badan Pusat Statistik. Hak Cipta Dilindungi.</p>
    </footer>

    <script>
        function toggleForm() {
            var formSection = document.getElementById("form-input-section");
            var button = document.getElementById("tombol-input");

            if (formSection.style.display === "none") {
                formSection.style.display = "block";
                button.textContent = "Tutup Form";
                button.classList.add("secondary");
            } else {
                formSection.style.display = "none";
                button.textContent = "Input Data Baru";
                button.classList.remove("secondary");
            }
        }

        function searchTable() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("dataTable");
            tr = table.getElementsByTagName("tr");

            for (i = 1; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>

</body>
</html>