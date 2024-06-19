-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 19 Jun 2024 pada 04.46
-- Versi server: 8.0.30
-- Versi PHP: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pakarjahe`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `hasil`
--

CREATE TABLE `hasil` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `solusi_id` int NOT NULL,
  `nilai_akhir` float NOT NULL,
  `timestamps` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `record` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `hasil`
--

INSERT INTO `hasil` (`id`, `user_id`, `solusi_id`, `nilai_akhir`, `timestamps`, `record`) VALUES
(25, 2, 2, 72.7269, '2024-06-18 14:32:14', '66719a6ecd43f'),
(26, 3, 2, 73.4315, '2024-06-18 14:37:11', '66719b9776c34'),
(27, 4, 2, 73.1206, '2024-06-18 14:38:18', '66719bdae72b0'),
(28, 5, 2, 71.4615, '2024-06-18 14:39:21', '66719c198fff1'),
(29, 6, 2, 76.9818, '2024-06-18 14:40:15', '66719c4f96d4e'),
(31, 2, 2, 72.7269, '2024-06-19 04:36:42', '6672605a1eae8');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria`
--

CREATE TABLE `kriteria` (
  `id` int NOT NULL,
  `kriteria` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tingkatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `MB` float NOT NULL,
  `MD` float NOT NULL,
  `CF` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kriteria`
--

INSERT INTO `kriteria` (`id`, `kriteria`, `tingkatan`, `MB`, `MD`, `CF`) VALUES
(1, 'Tekstur tanah di daerah ini gembur dan lempung berpasir', '1', 0.9, 0.1, 0.8),
(2, 'pH tanah di daerah ini berada dalam rentang 5,5 - 6,5', '1', 0.9, 0.05, 0.85),
(3, 'Drainase tanah di daerah ini sangat baik, tidak ada genangan air meskipun terjadi hujan lebat.\r\n', '1', 0.9, 0.05, 0.85),
(4, 'Suhu rata-rata tahunan di daerah ini antara 25 dan 30 derajat celcius', '2', 0.8, 0.15, 0.65),
(5, 'Curah hujan tahunan di daerah ini antara 1500 mm dan 3000 mm', '2', 0.8, 0.15, 0.65),
(6, 'Daerah ini tidak memiliki musim kering yang terlalu panjang', '2', 0.75, 0.2, 0.55),
(7, 'Tanah di daerah ini kaya akan bahan organik', '2', 0.85, 0.1, 0.75),
(8, 'Lahan di daerah ini datar atau memiliki kemiringan ringan', '2', 0.75, 0.2, 0.55),
(9, 'Daerah ini memiliki sistem pencegahan banjir yang baik.', '4', 0.7, 0.2, 0.5),
(10, 'Riwayat serangan hama dan penyakit di daerah ini sangat rendah', '3', 0.7, 0.2, 0.5),
(11, 'Terdapat sumber air yang cukup dekat untuk irigasi di daerah ini', '2', 0.8, 0.15, 0.65),
(12, 'Nutrisi tambahan atau pupuk tersedia di daerah ini', '2', 0.75, 0.2, 0.55),
(13, 'Tanah di daerah ini sangat subur', '1', 0.95, 0.05, 0.9),
(14, 'Terdapat fasilitas pendukung seperti akses jalan, pasar, dan tenaga kerja di sekitar daerah ini', '3', 0.65, 0.25, 0.4),
(15, 'Lahan di daerah ini bebas dari kontaminasi logam berat atau bahan kimia berbahaya', '4', 0.55, 0.35, 0.2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `responden`
--

CREATE TABLE `responden` (
  `id` int NOT NULL,
  `kriteria_id` int NOT NULL,
  `user_id` int NOT NULL,
  `r_cf` float NOT NULL,
  `H` float NOT NULL,
  `timestamps` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `record` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `responden`
--

INSERT INTO `responden` (`id`, `kriteria_id`, `user_id`, `r_cf`, `H`, `timestamps`, `record`) VALUES
(136, 1, 2, 0.8, 0.64, '2024-06-18 14:32:14', '66719a6ecd43f'),
(137, 2, 2, 0.8, 0.68, '2024-06-18 14:32:14', '66719a6ecd43f'),
(138, 3, 2, 0.6, 0.51, '2024-06-18 14:32:14', '66719a6ecd43f'),
(139, 13, 2, 0.8, 0.72, '2024-06-18 14:32:14', '66719a6ecd43f'),
(140, 4, 2, 0.8, 0.52, '2024-06-18 14:32:14', '66719a6ecd43f'),
(141, 5, 2, 0.8, 0.52, '2024-06-18 14:32:14', '66719a6ecd43f'),
(142, 6, 2, 0.6, 0.33, '2024-06-18 14:32:14', '66719a6ecd43f'),
(143, 7, 2, 0.8, 0.6, '2024-06-18 14:32:14', '66719a6ecd43f'),
(144, 8, 2, 0.8, 0.44, '2024-06-18 14:32:14', '66719a6ecd43f'),
(145, 11, 2, 0.8, 0.52, '2024-06-18 14:32:14', '66719a6ecd43f'),
(146, 12, 2, 0.6, 0.33, '2024-06-18 14:32:14', '66719a6ecd43f'),
(147, 10, 2, 0.6, 0.3, '2024-06-18 14:32:14', '66719a6ecd43f'),
(148, 14, 2, 0.8, 0.32, '2024-06-18 14:32:14', '66719a6ecd43f'),
(149, 9, 2, 0.6, 0.3, '2024-06-18 14:32:14', '66719a6ecd43f'),
(150, 15, 2, 0.8, 0.16, '2024-06-18 14:32:14', '66719a6ecd43f'),
(151, 1, 3, 1, 0.8, '2024-06-18 14:37:11', '66719b9776c34'),
(152, 2, 3, 0.8, 0.68, '2024-06-18 14:37:11', '66719b9776c34'),
(153, 3, 3, 0.6, 0.51, '2024-06-18 14:37:11', '66719b9776c34'),
(154, 13, 3, 0.8, 0.72, '2024-06-18 14:37:11', '66719b9776c34'),
(155, 4, 3, 0.8, 0.52, '2024-06-18 14:37:11', '66719b9776c34'),
(156, 5, 3, 0.6, 0.39, '2024-06-18 14:37:11', '66719b9776c34'),
(157, 6, 3, 0.6, 0.33, '2024-06-18 14:37:11', '66719b9776c34'),
(158, 7, 3, 0.8, 0.6, '2024-06-18 14:37:11', '66719b9776c34'),
(159, 8, 3, 0.8, 0.44, '2024-06-18 14:37:11', '66719b9776c34'),
(160, 11, 3, 0.6, 0.39, '2024-06-18 14:37:11', '66719b9776c34'),
(161, 12, 3, 0.6, 0.33, '2024-06-18 14:37:11', '66719b9776c34'),
(162, 10, 3, 0.6, 0.3, '2024-06-18 14:37:11', '66719b9776c34'),
(163, 14, 3, 0.6, 0.24, '2024-06-18 14:37:11', '66719b9776c34'),
(164, 9, 3, 0.8, 0.4, '2024-06-18 14:37:11', '66719b9776c34'),
(165, 15, 3, 0.8, 0.16, '2024-06-18 14:37:11', '66719b9776c34'),
(166, 1, 4, 0.8, 0.64, '2024-06-18 14:38:18', '66719bdae72b0'),
(167, 2, 4, 0.8, 0.68, '2024-06-18 14:38:18', '66719bdae72b0'),
(168, 3, 4, 0.8, 0.68, '2024-06-18 14:38:18', '66719bdae72b0'),
(169, 13, 4, 0.8, 0.72, '2024-06-18 14:38:18', '66719bdae72b0'),
(170, 4, 4, 0.8, 0.52, '2024-06-18 14:38:18', '66719bdae72b0'),
(171, 5, 4, 0.8, 0.52, '2024-06-18 14:38:18', '66719bdae72b0'),
(172, 6, 4, 0.8, 0.44, '2024-06-18 14:38:18', '66719bdae72b0'),
(173, 7, 4, 1, 0.75, '2024-06-18 14:38:18', '66719bdae72b0'),
(174, 8, 4, 0.8, 0.44, '2024-06-18 14:38:18', '66719bdae72b0'),
(175, 11, 4, 0.8, 0.52, '2024-06-18 14:38:18', '66719bdae72b0'),
(176, 12, 4, 0.8, 0.44, '2024-06-18 14:38:18', '66719bdae72b0'),
(177, 10, 4, 0.6, 0.3, '2024-06-18 14:38:18', '66719bdae72b0'),
(178, 14, 4, 0.6, 0.24, '2024-06-18 14:38:18', '66719bdae72b0'),
(179, 9, 4, 0.8, 0.4, '2024-06-18 14:38:18', '66719bdae72b0'),
(180, 15, 4, 0.6, 0.12, '2024-06-18 14:38:18', '66719bdae72b0'),
(181, 1, 5, 0.8, 0.64, '2024-06-18 14:39:21', '66719c198fff1'),
(182, 2, 5, 1, 0.85, '2024-06-18 14:39:21', '66719c198fff1'),
(183, 3, 5, 0.6, 0.51, '2024-06-18 14:39:21', '66719c198fff1'),
(184, 13, 5, 0.8, 0.72, '2024-06-18 14:39:21', '66719c198fff1'),
(185, 4, 5, 0.8, 0.52, '2024-06-18 14:39:21', '66719c198fff1'),
(186, 5, 5, 0.6, 0.39, '2024-06-18 14:39:21', '66719c198fff1'),
(187, 6, 5, 0.6, 0.33, '2024-06-18 14:39:21', '66719c198fff1'),
(188, 7, 5, 0.8, 0.6, '2024-06-18 14:39:21', '66719c198fff1'),
(189, 8, 5, 0.8, 0.44, '2024-06-18 14:39:21', '66719c198fff1'),
(190, 11, 5, 0.8, 0.52, '2024-06-18 14:39:21', '66719c198fff1'),
(191, 12, 5, 0.6, 0.33, '2024-06-18 14:39:21', '66719c198fff1'),
(192, 10, 5, 0.6, 0.3, '2024-06-18 14:39:21', '66719c198fff1'),
(193, 14, 5, 0.6, 0.24, '2024-06-18 14:39:21', '66719c198fff1'),
(194, 9, 5, 0.6, 0.3, '2024-06-18 14:39:21', '66719c198fff1'),
(195, 15, 5, 0.8, 0.16, '2024-06-18 14:39:21', '66719c198fff1'),
(196, 1, 6, 1, 0.8, '2024-06-18 14:40:15', '66719c4f96d4e'),
(197, 2, 6, 1, 0.85, '2024-06-18 14:40:15', '66719c4f96d4e'),
(198, 3, 6, 0.8, 0.68, '2024-06-18 14:40:15', '66719c4f96d4e'),
(199, 13, 6, 1, 0.9, '2024-06-18 14:40:15', '66719c4f96d4e'),
(200, 4, 6, 0.8, 0.52, '2024-06-18 14:40:15', '66719c4f96d4e'),
(201, 5, 6, 0.8, 0.52, '2024-06-18 14:40:15', '66719c4f96d4e'),
(202, 6, 6, 0.8, 0.44, '2024-06-18 14:40:15', '66719c4f96d4e'),
(203, 7, 6, 0.8, 0.6, '2024-06-18 14:40:15', '66719c4f96d4e'),
(204, 8, 6, 0.8, 0.44, '2024-06-18 14:40:15', '66719c4f96d4e'),
(205, 11, 6, 0.8, 0.52, '2024-06-18 14:40:15', '66719c4f96d4e'),
(206, 12, 6, 0.8, 0.44, '2024-06-18 14:40:15', '66719c4f96d4e'),
(207, 10, 6, 0.8, 0.4, '2024-06-18 14:40:15', '66719c4f96d4e'),
(208, 14, 6, 0.8, 0.32, '2024-06-18 14:40:15', '66719c4f96d4e'),
(209, 9, 6, 0.8, 0.4, '2024-06-18 14:40:15', '66719c4f96d4e'),
(210, 15, 6, 0.8, 0.16, '2024-06-18 14:40:15', '66719c4f96d4e'),
(226, 1, 2, 0.8, 0.64, '2024-06-19 04:36:42', '6672605a1eae8'),
(227, 2, 2, 0.8, 0.68, '2024-06-19 04:36:42', '6672605a1eae8'),
(228, 3, 2, 0.6, 0.51, '2024-06-19 04:36:42', '6672605a1eae8'),
(229, 13, 2, 0.8, 0.72, '2024-06-19 04:36:42', '6672605a1eae8'),
(230, 4, 2, 0.8, 0.52, '2024-06-19 04:36:42', '6672605a1eae8'),
(231, 5, 2, 0.8, 0.52, '2024-06-19 04:36:42', '6672605a1eae8'),
(232, 6, 2, 0.6, 0.33, '2024-06-19 04:36:42', '6672605a1eae8'),
(233, 7, 2, 0.8, 0.6, '2024-06-19 04:36:42', '6672605a1eae8'),
(234, 8, 2, 0.8, 0.44, '2024-06-19 04:36:42', '6672605a1eae8'),
(235, 11, 2, 0.8, 0.52, '2024-06-19 04:36:42', '6672605a1eae8'),
(236, 12, 2, 0.6, 0.33, '2024-06-19 04:36:42', '6672605a1eae8'),
(237, 10, 2, 0.6, 0.3, '2024-06-19 04:36:42', '6672605a1eae8'),
(238, 14, 2, 0.8, 0.32, '2024-06-19 04:36:42', '6672605a1eae8'),
(239, 9, 2, 0.6, 0.3, '2024-06-19 04:36:42', '6672605a1eae8'),
(240, 15, 2, 0.8, 0.16, '2024-06-19 04:36:42', '6672605a1eae8');

-- --------------------------------------------------------

--
-- Struktur dari tabel `solusi`
--

CREATE TABLE `solusi` (
  `id` int NOT NULL,
  `tingkat_kecocokan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `solusi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `saran` text COLLATE utf8mb4_unicode_ci,
  `min` double NOT NULL,
  `max` double NOT NULL,
  `warna` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `solusi`
--

INSERT INTO `solusi` (`id`, `tingkat_kecocokan`, `solusi`, `saran`, `min`, `max`, `warna`) VALUES
(1, 'Sangat Cocok', 'Kondisi tanah dan lingkungan di daerah ini sangat mendukung untuk budidaya jahe. Tanah gembur dan kaya akan bahan organik, pH tanah yang ideal, curah hujan yang cukup, serta suhu yang sesuai membuat daerah ini sangat optimal untuk penanaman jahe.', '<b>Optimalkan Pemanfaatan Lahan:</b> Gunakan lahan yang tersedia dengan baik, pastikan drainase yang baik untuk menghindari genangan air.\r\n<br/>\r\n<br/>\r\n<b>Pupuk dan Nutrisi:</b> Manfaatkan pupuk organik untuk menjaga kesuburan tanah dan meningkatkan hasil panen.\r\n<br>\r\n<br/>\r\n<b>Pengelolaan Air:</b> Pastikan sistem irigasi berfungsi dengan baik untuk mendukung pertumbuhan tanaman.', 80, 100, 'bg-success'),
(2, 'Cocok', 'Kondisi di daerah ini cukup baik untuk budidaya jahe, namun ada beberapa faktor yang perlu diperhatikan dan dioptimalkan. Misalnya, musim kering yang sedikit lebih panjang atau curah hujan yang kurang konsisten.', '<b>Pengelolaan Irigasi:</b> Pastikan ada sistem irigasi yang baik untuk mengatasi musim kering yang sedikit lebih panjang.\r\n<br>\r\n<br>\r\n<b>Pemantauan Kondisi Tanah:</b> Secara rutin periksa pH dan kandungan organik tanah, dan tambahkan pupuk atau bahan organik jika diperlukan.		\r\n<br>\r\n<br>\r\n<b>Penanganan Hama dan Penyakit:</b> Tetap waspada terhadap hama dan penyakit dengan melakukan pemeriksaan rutin dan pengendalian secara tepat waktu.		\r\n', 60, 79, 'bg-warning'),
(3, 'Netral', 'Daerah ini memiliki beberapa faktor yang netral atau kurang mendukung untuk budidaya jahe. Beberapa kondisi tanah atau iklim mungkin tidak ideal dan memerlukan perhatian ekstra.		\r\n', '<b>Perbaikan Tanah:</b> Lakukan perbaikan tanah dengan menambahkan bahan organik atau pupuk yang sesuai untuk meningkatkan kesuburan.		\r\n<br>\r\n<br/>\r\n<b>Pengelolaan Lingkungan:</b> Perbaiki sistem drainase dan pastikan tidak ada genangan air yang dapat merusak tanaman.		\r\n<br>\r\n<br/>\r\n<b>Diversifikasi Tanaman:</b> Pertimbangkan diversifikasi tanaman lain yang lebih sesuai jika kondisi tidak dapat diubah.		\r\n', 40, 59, 'bg-orange'),
(4, 'Tidak Cocok', 'Kondisi di daerah ini kurang mendukung untuk budidaya jahe. Masalah seperti tanah yang tidak subur, pH yang tidak ideal, curah hujan yang terlalu tinggi atau rendah, dan kondisi lingkungan lainnya perlu ditangani serius.		\r\n', '<b>Perbaikan Intensif:</b> Lakukan perbaikan tanah secara intensif dengan menggunakan pupuk organik dan anorganik serta perbaikan struktur tanah.		\r\n<br>\r\n<br/>\r\n<b>Pengelolaan Risiko:</b> Identifikasi risiko utama seperti genangan air atau kekeringan, dan buat rencana mitigasi untuk mengatasinya.		\r\n<br>\r\n<br/>\r\n<b>Konsultasi Ahli:</b> Pertimbangkan untuk berkonsultasi dengan ahli pertanian atau agronomis untuk mendapatkan saran khusus dan teknis tentang cara meningkatkan kondisi tanah dan lingkungan untuk budidaya jahe.		\r\n', 0, 39, 'bg-danger');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','guest') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'guest'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'geop', 'password', 'admin'),
(2, 'jack', 'password', 'guest'),
(3, 'lucas', 'password', 'guest'),
(4, 'adam', 'password', 'guest'),
(5, 'piktor', 'password', 'guest'),
(6, 'agung', 'password', 'guest');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `hasil`
--
ALTER TABLE `hasil`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `solusi_id` (`solusi_id`);

--
-- Indeks untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `responden`
--
ALTER TABLE `responden`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `kriteria_lahan_id` (`kriteria_id`);

--
-- Indeks untuk tabel `solusi`
--
ALTER TABLE `solusi`
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
-- AUTO_INCREMENT untuk tabel `hasil`
--
ALTER TABLE `hasil`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `responden`
--
ALTER TABLE `responden`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=256;

--
-- AUTO_INCREMENT untuk tabel `solusi`
--
ALTER TABLE `solusi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `hasil`
--
ALTER TABLE `hasil`
  ADD CONSTRAINT `hasil_solusi_id_foreign` FOREIGN KEY (`solusi_id`) REFERENCES `solusi` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `hasil_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Ketidakleluasaan untuk tabel `responden`
--
ALTER TABLE `responden`
  ADD CONSTRAINT `responden_kriteria_id_foreign` FOREIGN KEY (`kriteria_id`) REFERENCES `kriteria` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `responden_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
