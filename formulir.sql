-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Jul 2025 pada 03.03
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

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
  `SKP` longblob NOT NULL,
  `Link` varchar(300) NOT NULL,
  `Periode` enum('Awal','TW1','TW2','TW3','Tahunan') NOT NULL,
  `status` enum('pending','disetujui','revisi') DEFAULT NULL,
  `komentar` text NOT NULL,
  `tanggal` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `data`
--

INSERT INTO `data` (`Nomor`, `Nama`, `NIP`, `Jabatan`, `Bidang`, `Kabid`, `SKP`, `Link`, `Periode`, `status`, `komentar`, `tanggal`) VALUES
(1, 'Yelvi Oktavia', 198210072006042006, 'Pustakawan Madya', 'Deposit, Pengembangan, dan Pelestarian Bahan Perpustakaan', 'Dian Dewi Kartika, S.Sos, M.Si', 0x363835396637366338373963375f52656b61702050757374616b6177616e204441502e706466, 'https://drive.google.com/file/d/1X5WBt_xmTwZo0wNOyYzlsbB5PKD-m-1r/view?usp=drive_link', 'Awal', 'revisi', 'Link salah', '2025-06-24 02:54:00'),
(2, 'Romi Zulfi Yandra', 197501261999031001, 'Arsiparis Madya', 'Kearsipan', 'Sosy Findra, S.Kom', 0x363836316664353861323631305f446174612050656d62616769616e204a757a204d656e67616a692042657273616d61202041534e204441502e706466, 'https://drive.google.com/drive/my-drive', 'TW1', 'disetujui', '', '2025-06-30 04:57:00'),
(3, 'Armelia Syafei', 197309131994032001, 'Arsiparis Madya', 'Pembinaan dan Pengawasan', 'Kiswati SS,MPA', 0x363836346630356431336366665f737572617420706572696e676174616e20546168756e20426172752049736c616d203134343720482032303235204d202e706466, 'https://chatgpt.com/c/6864985b-386c-8007-bb1f-62de7528aac5', 'TW2', 'pending', '', '2025-07-02 10:38:00'),
(4, 'Romi Zulfi Yandra', 197501261999031001, 'Arsiparis Madya', 'Kearsipan', 'Sosy Findra, S.Kom', 0x363836373238653036363831325f534b20414e4a41422041424b2044415020323032312e706466, 'https://chatgpt.com/', 'TW3', 'revisi', 'Berkas tidak lengkap', '2025-07-04 03:05:00'),
(5, 'Romi Zulfi Yandra', 197501261999031001, 'Arsiparis Madya', 'Kearsipan', 'Sosy Findra, S.Kom', 0x363836373238666237613036635f534b20414e4a41422041424b2044415020323032312e706466, 'https://drive.google.com/file/d/1X5WBt_xmTwZo0wNOyYzlsbB5PKD-m-1r/view?usp=drive_link', 'TW2', 'pending', '', '2025-07-04 03:05:00');

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
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
