<?php
// Selalu sertakan file koneksi di awal
include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lihat Data Tersimpan - BPS</title>
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
        <div id="tabel-data" class="table-section">
            <div class="table-header">
                <h3>Data LKE Tersimpan</h3>
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
                            <th>Jawaban Operator</th>
                            <th>Bukti File</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Query untuk mengambil data yang relevan
                        $sql = "SELECT id, instansi, indikator, jawaban_operator, file_evidence FROM rekap_lke ORDER BY id DESC";
                        $result = mysqli_query($koneksi, $sql);
                        $nomor = 1;

                        if (mysqli_num_rows($result) > 0) {
                            while($data = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $nomor++ . "</td>";
                                echo "<td>" . htmlspecialchars($data['instansi']) . "</td>";
                                echo "<td>" . htmlspecialchars($data['indikator']) . "</td>";
                                echo "<td>" . htmlspecialchars($data['jawaban_operator']) . "</td>";
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
        function searchTable() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("dataTable");
            tr = table.getElementsByTagName("tr");

            for (i = 1; i < tr.length; i++) { // Mulai dari 1 untuk skip header
                // Mencari di kolom Instansi (index 1) dan Indikator (index 2)
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