-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Okt 2025 pada 04.08
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_epss`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekap_lke`
--

CREATE TABLE `rekap_lke` (
  `id` int(11) NOT NULL,
  `indikator` varchar(255) DEFAULT NULL,
  `bobot` varchar(50) DEFAULT NULL,
  `penjelasan_indikator` text DEFAULT NULL,
  `pilihan_kematangan` text DEFAULT NULL,
  `jawaban_operator` int(2) DEFAULT NULL,
  `penjelasan_jawaban` text DEFAULT NULL,
  `link_evidence` varchar(255) DEFAULT NULL,
  `jawaban_supervisor` int(2) DEFAULT NULL,
  `catatan_supervisor` text DEFAULT NULL,
  `file_evidence` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `rekap_lke`
--

INSERT INTO `rekap_lke` (`id`, `indikator`, `bobot`, `penjelasan_indikator`, `pilihan_kematangan`, `jawaban_operator`, `penjelasan_jawaban`, `link_evidence`, `jawaban_supervisor`, `catatan_supervisor`, `file_evidence`) VALUES
(1, '10101 Tingkat Kematangan Penerapan Standar Data Statistik (SDS)', '100%', 'Standar Data', '1. Penerapan SDS belum dilakukan oleh seluruh Produsen Data\r\n2. Penerapan SDS telah dilakukan oleh setiap Produsen Data sesuai standarnya masing-masing\r\n3. Penerapan SDS telah dilakukan berdasarkan kaidah yang ditetapkan dan berlaku untuk seluruh Produsen Data\r\n4. Penerapan SDS telah dilakukan reviu dan evaluasi secara berkala\r\n5. Penerapan SDS telah dilakukan pemutakhiran oleh Produsen Data bersama Walidata dalam rangka peningkatan kualitas', 2, 'Penyusunan data telah dilakukan sesuai kebutuhan Instansi dan memuat komponen konsep, definisi, klasifikasi, ukuran dan satuan', 'https://drive.google.com/drive/folders/1THAVPZWx3IANi8_PnnT2Smx8FYUS23p2?usp=share_link', 5, '-', '');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `rekap_lke`
--
ALTER TABLE `rekap_lke`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `rekap_lke`
--
ALTER TABLE `rekap_lke`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
