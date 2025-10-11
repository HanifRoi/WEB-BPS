<?php
include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Kualitas Data - BPS</title>
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
    <div class="back-button-container">
        <a href="simulasi.php" class="back-button">&larr; Kembali ke Pilihan Domain</a>
    </div>
        <div class="dashboard-header">
            <div class="dashboard-description">
                <h2>Kualitas Data</h2>
                <p>Halaman ini berisi data terkait domain Prinsip SDI. Anda dapat menambahkan data baru atau mencari data yang sudah ada di dalam sistem.</p>
            </div>
            <div class="dashboard-actions">
                <a href="form_kualitas.php" class="action-button">Input Data Baru</a>
            </div>
        </div>

        <hr>
        
        <?php if(isset($_GET['status'])): ?>
            <?php if($_GET['status'] == 'sukses'): ?>
                <p class="pesan-sukses">Data baru berhasil disimpan!</p>
            <?php elseif($_GET['status'] == 'update_sukses'): ?>
                <p class="pesan-sukses">Data berhasil diupdate!</p>
            <?php endif; ?>
        <?php endif; ?>


        <div id="tabel-data" class="table-section">
            <div class="table-header">
                <h3>Data Tersimpan</h3>
                <div class="search-container">
                    <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Cari berdasarkan Instansi atau Indikator...">
                </div>
            </div>
             <div class="table-wrapper">
                <table id="dataTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Instansi</th>
                            <th>Indikator</th>
                            <th>Bobot</th>
                            <th>Tingkat Kematangan</th>
                            <th>Jawaban Operator</th>
                            <th>Link Bukti</th> <th>File Bukti</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Mengambil semua kolom dengan '*'
                       // Ganti query ini
$sql = "SELECT * FROM rekap_lke WHERE domain = 'Kualitas Data' ORDER BY id DESC";
                        $result = mysqli_query($koneksi, $sql);
                        $nomor = 1;

                        if (mysqli_num_rows($result) > 0) {
                            while($data = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $nomor++ . "</td>";
                                echo "<td>" . htmlspecialchars($data['instansi']) . "</td>";
                                echo "<td>" . htmlspecialchars($data['indikator']) . "</td>";
                                echo "<td>" . htmlspecialchars($data['bobot']) . "</td>";
                                echo "<td>" . nl2br(htmlspecialchars($data['pilihan_kematangan'])) . "</td>";
                                echo "<td>" . htmlspecialchars($data['jawaban_operator']) . "</td>";

                                // ====== MENAMPILKAN LINK EVIDENCE ======
                                if (!empty($data['link_evidence'])) {
                                    echo "<td><a href='" . htmlspecialchars($data['link_evidence']) . "' target='_blank'>Lihat Link</a></td>";
                                } else {
                                    echo "<td>-</td>";
                                }

                                // Menampilkan File Evidence
                                if (!empty($data['file_evidence'])) {
                                    echo "<td><a href='uploads/" . htmlspecialchars($data['file_evidence']) . "' target='_blank'>Lihat File</a></td>";
                                } else {
                                    echo "<td>-</td>";
                                }
                                
                                // Tombol Aksi
                                echo "<td>";
                                echo "<a href='edit_data.php?id=" . $data['id'] . "' class='action-button edit'>Edit</a>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            // Sesuaikan colspan dengan jumlah header (sekarang ada 9)
                            echo "<tr><td colspan='9'>Belum ada data yang tersimpan.</td></tr>";
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
        function searchTable() {
            var input, filter, table, tr, i;
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("dataTable");
            tr = table.getElementsByTagName("tr");

            for (i = 1; i < tr.length; i++) {
                let td_instansi = tr[i].getElementsByTagName("td")[1];
                let td_indikator = tr[i].getElementsByTagName("td")[2];
                if (td_instansi || td_indikator) {
                    let text_instansi = (td_instansi) ? td_instansi.textContent || td_instansi.innerText : '';
                    let text_indikator = (td_indikator) ? td_indikator.textContent || td_indikator.innerText : '';
                    
                    if (text_instansi.toUpperCase().indexOf(filter) > -1 || text_indikator.toUpperCase().indexOf(filter) > -1) {
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