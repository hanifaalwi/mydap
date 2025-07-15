-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 15 Jul 2025 pada 05.05
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
-- Database: `formulir`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `data`
--

CREATE TABLE `data` (
  `Nomor` int(100) NOT NULL,
  `Nama` varchar(100) NOT NULL,
  `NIP` bigint(100) NOT NULL,
  `Jabatan` varchar(100) NOT NULL,
  `Bidang` varchar(100) NOT NULL,
  `Kabid` varchar(100) NOT NULL,
  `SKP` varchar(300) NOT NULL,
  `Link` varchar(300) NOT NULL,
  `Periode` enum('Awal','TW1','TW2','TW3','Tahunan') NOT NULL,
  `status` enum('pending','disetujui','revisi') DEFAULT NULL,
  `statuss` enum('pending','disetujui','revisi') NOT NULL,
  `komentar` text NOT NULL,
  `tanggal` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `data`
--

INSERT INTO `data` (`Nomor`, `Nama`, `NIP`, `Jabatan`, `Bidang`, `Kabid`, `SKP`, `Link`, `Periode`, `status`, `statuss`, `komentar`, `tanggal`) VALUES
(3, 'Yelvi Oktavia', 198210072006042006, 'Arsiparis Madya', 'Kearsipan', 'Sosy Findra, S.Kom', 'http://127.0.0.1:9000/uploads/6874bc65dbc01_Rekap%20Pustakawan%20DAP.pdf', 'https://drive.google.com/file/d/1X5WBt_xmTwZo0wNOyYzlsbB5PKD-m-1r/view?usp=drive_link', 'TW1', 'pending', 'disetujui', '', '2025-07-14 10:14:00'),
(4, 'Yelvi Oktavia', 198210072006042006, 'Pustakawan Ahli', 'Kearsipan', 'Sosy Findra, S.Kom', 'http://127.0.0.1:9000/uploads/1752482095_Rekap%20Pustakawan%20DAP.pdf', 'https://drive.google.com/drive/folders/1319w7RnNALu1LA2jbez6G_C_tD7zAeOr', 'TW3', 'pending', 'pending', '', '2025-07-14 10:34:00'),
(5, 'Tess', 197109041994032001, 'otomatiiss', 'Kearsipan', 'Sosy Findra, S.Kom', 'http://127.0.0.1:9000/uploads/1752548654_Permen%20PANRB%20No.%206%20Tahun%202022.pdf', 'https://drive.google.com/file/d/1X5WBt_xmTwZo0wNOyYzlsbB5PKD-m-1r/view?usp=drive_link', 'TW2', 'pending', 'pending', '', '2025-07-15 05:04:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `history_data`
--

CREATE TABLE `history_data` (
  `id` int(11) NOT NULL,
  `data_id` int(11) DEFAULT NULL,
  `user_input` varchar(100) DEFAULT NULL,
  `aksi` enum('update') DEFAULT 'update',
  `waktu` datetime DEFAULT current_timestamp(),
  `data_lama` text DEFAULT NULL,
  `data_baru` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `history_data`
--

INSERT INTO `history_data` (`id`, `data_id`, `user_input`, `aksi`, `waktu`, `data_lama`, `data_baru`) VALUES
(1, 4, '198210072006042006', 'update', '2025-07-14 15:25:25', '{\"Nomor\":\"4\",\"Nama\":\"Yelvi Oktavia\",\"NIP\":\"198210072006042006\",\"Jabatan\":\"Pustakawan Ahli\",\"Bidang\":\"Kearsipan\",\"Kabid\":\"Sosy Findra, S.Kom\",\"SKP\":\"http://127.0.0.1:9000/uploads/6874be852e88a_Permen%20PANRB%20No.%206%20Tahun%202022.pdf\",\"Link\":\"https://drive.google.com/drive/folders/1319w7RnNALu1LA2jbez6G_C_tD7zAeOr\",\"Periode\":\"Awal\",\"status\":\"revisi\",\"statuss\":\"pending\",\"komentar\":\"upload ulang skp\",\"tanggal\":\"2025-07-14 10:23:00\"}', '{\"Nama\":\"Yelvi Oktavia\",\"NIP\":\"198210072006042006\",\"Jabatan\":\"Pustakawan Ahli\",\"Bidang\":\"Kearsipan\",\"Kabid\":\"Sosy Findra, S.Kom\",\"SKP\":\"http://127.0.0.1:9000/uploads/1752481525_Rekap%20Pustakawan%20DAP.pdf\",\"Link\":\"https://drive.google.com/drive/folders/1319w7RnNALu1LA2jbez6G_C_tD7zAeOr\",\"Periode\":\"Awal\",\"status\":\"pending\",\"statuss\":\"pending\",\"komentar\":\"\",\"tanggal\":\"2025-07-14T10:25\"}'),
(2, 4, '198210072006042006', 'update', '2025-07-14 15:34:55', '{\"Nomor\":\"4\",\"Nama\":\"Yelvi Oktavia\",\"NIP\":\"198210072006042006\",\"Jabatan\":\"Pustakawan Ahli\",\"Bidang\":\"Kearsipan\",\"Kabid\":\"Sosy Findra, S.Kom\",\"SKP\":\"http://127.0.0.1:9000/uploads/1752481525_Rekap%20Pustakawan%20DAP.pdf\",\"Link\":\"https://drive.google.com/drive/folders/1319w7RnNALu1LA2jbez6G_C_tD7zAeOr\",\"Periode\":\"Awal\",\"status\":\"pending\",\"statuss\":\"revisi\",\"komentar\":\"\",\"tanggal\":\"2025-07-14 10:25:00\"}', '{\"Nama\":\"Yelvi Oktavia\",\"NIP\":\"198210072006042006\",\"Jabatan\":\"Pustakawan Ahli\",\"Bidang\":\"Kearsipan\",\"Kabid\":\"Sosy Findra, S.Kom\",\"SKP\":\"http://127.0.0.1:9000/uploads/1752482095_Rekap%20Pustakawan%20DAP.pdf\",\"Link\":\"https://drive.google.com/drive/folders/1319w7RnNALu1LA2jbez6G_C_tD7zAeOr\",\"Periode\":\"TW3\",\"status\":\"pending\",\"statuss\":\"pending\",\"komentar\":\"\",\"tanggal\":\"2025-07-14T10:34\"}'),
(4, 5, '197109041994032001', 'update', '2025-07-15 10:04:14', '{\"Nomor\":\"5\",\"Nama\":\"Tess\",\"NIP\":\"197109041994032001\",\"Jabatan\":\"otomatiiss\",\"Bidang\":\"Kearsipan\",\"Kabid\":\"Sosy Findra, S.Kom\",\"SKP\":\"http://127.0.0.1:9000/uploads/6875c4cb955f7_SE%20TND%202025.pdf\",\"Link\":\"https://drive.google.com/file/d/1X5WBt_xmTwZo0wNOyYzlsbB5PKD-m-1r/view?usp=drive_link\",\"Periode\":\"TW2\",\"status\":\"revisi\",\"statuss\":\"pending\",\"komentar\":\"link tidak dapat diakses\",\"tanggal\":\"2025-07-15 05:02:00\"}', '{\"Nama\":\"Tess\",\"NIP\":\"197109041994032001\",\"Jabatan\":\"otomatiiss\",\"Bidang\":\"Kearsipan\",\"Kabid\":\"Sosy Findra, S.Kom\",\"SKP\":\"http://127.0.0.1:9000/uploads/1752548654_Permen%20PANRB%20No.%206%20Tahun%202022.pdf\",\"Link\":\"https://drive.google.com/file/d/1X5WBt_xmTwZo0wNOyYzlsbB5PKD-m-1r/view?usp=drive_link\",\"Periode\":\"TW2\",\"status\":\"pending\",\"statuss\":\"pending\",\"komentar\":\"\",\"tanggal\":\"2025-07-15T05:04\"}');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` bigint(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` enum('admin','madya','kadis','kabid') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `status`) VALUES
(1, 196708172000031006, 'formulir0', 'kadis'),
(2, 20000527, 'admin0', 'admin'),
(3, 196707241999031006, 'formulir1', 'kabid'),
(4, 196808151999032001, 'formulir1', 'kabid'),
(5, 197209231992022001, 'formulir1', 'kabid'),
(6, 199203242014061003, 'formulir1', 'kabid'),
(7, 198210072006042006, 'formulir2', 'madya'),
(8, 196901291999031002, 'formulir2', 'madya'),
(9, 197109041994032001, 'formulir2', 'madya'),
(10, 197501261999031001, 'formulir2', 'madya'),
(11, 197307031999032003, 'formulir2', 'madya'),
(12, 197207192007012002, 'formulir2', 'madya'),
(13, 197309131994032001, 'formulir2', 'madya'),
(14, 197410211999032004, 'formulir2', 'madya'),
(15, 197504141999032002, 'formulir2', 'madya');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `data`
--
ALTER TABLE `data`
  ADD PRIMARY KEY (`Nomor`);

--
-- Indeks untuk tabel `history_data`
--
ALTER TABLE `history_data`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `data`
--
ALTER TABLE `data`
  MODIFY `Nomor` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `history_data`
--
ALTER TABLE `history_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
