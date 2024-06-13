-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 13 Jun 2024 pada 14.45
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_akhir`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `klasifikasi_surat`
--

CREATE TABLE `klasifikasi_surat` (
  `id_klasifikasi` bigint(20) UNSIGNED NOT NULL,
  `nama_klasifikasi` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `klasifikasi_surat`
--

INSERT INTO `klasifikasi_surat` (`id_klasifikasi`, `nama_klasifikasi`, `created_at`, `updated_at`) VALUES
(1, 'Surat Undangan', '2024-06-11 07:40:34', '2024-06-11 07:40:34'),
(2, 'Surat Administrasi', '2024-06-11 08:05:32', '2024-06-11 08:05:32'),
(3, 'Surat Keterangan', '2024-06-11 08:05:37', '2024-06-11 08:05:37'),
(5, 'Surat Pengumuman', '2024-06-12 08:02:48', '2024-06-12 08:02:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000002_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_04_05_120450_status_surat', 1),
(6, '2024_04_05_120547_klasifikasi_surat', 1),
(7, '2024_04_05_125434_surat', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `status_surat`
--

CREATE TABLE `status_surat` (
  `id_status` bigint(20) UNSIGNED NOT NULL,
  `nama_status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `status_surat`
--

INSERT INTO `status_surat` (`id_status`, `nama_status`, `created_at`, `updated_at`) VALUES
(1, 'Penting', '2024-06-11 07:40:42', '2024-06-11 07:40:42'),
(2, 'Biasa', '2024-06-11 08:06:01', '2024-06-11 08:06:01'),
(3, 'Segera', '2024-06-11 08:06:07', '2024-06-11 08:06:07'),
(4, 'Rahasia', '2024-06-11 08:06:12', '2024-06-11 08:06:12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat`
--

CREATE TABLE `surat` (
  `id_surat` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED DEFAULT NULL,
  `tipe_surat` enum('Masuk','Keluar') NOT NULL,
  `nomor_surat` varchar(255) NOT NULL,
  `pengirim` varchar(255) NOT NULL,
  `tanggal_surat` date NOT NULL,
  `tanggal_terima` date NOT NULL,
  `id_klasifikasi` bigint(20) UNSIGNED DEFAULT NULL,
  `id_status` bigint(20) UNSIGNED DEFAULT NULL,
  `ringkasan` text NOT NULL,
  `notifikasi` enum('YA','TIDAK') NOT NULL DEFAULT 'TIDAK',
  `disposisi` bigint(20) UNSIGNED DEFAULT NULL,
  `lampiran_surat` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `surat`
--

INSERT INTO `surat` (`id_surat`, `id_user`, `tipe_surat`, `nomor_surat`, `pengirim`, `tanggal_surat`, `tanggal_terima`, `id_klasifikasi`, `id_status`, `ringkasan`, `notifikasi`, `disposisi`, `lampiran_surat`, `created_at`, `updated_at`) VALUES
(1, 1, 'Masuk', '001/001/001', 'Pemerintah Kota Banjarbaru', '2024-06-10', '2024-06-12', 1, 1, 'Undangan Pelatihan', 'TIDAK', 2, '6668701953ba0.pdf', '2024-06-11 15:41:13', '2024-06-12 11:59:24'),
(2, 1, 'Masuk', '001/001/002', 'Kelurahan Alalak Tengah', '2024-06-11', '2024-06-13', 2, 3, 'Undangan Pelantikan', 'TIDAK', 2, '66688011d1a3a.pdf', '2024-06-11 16:49:21', '2024-06-13 03:17:35'),
(3, 1, 'Masuk', '001/001/003', 'Muhamad Aditya', '2024-06-11', '2024-06-12', 3, 1, 'Undangan Pernikahan', 'YA', 2, '66688084472b7.pdf', '2024-06-11 16:51:16', '2024-06-13 03:35:00'),
(5, 1, 'Keluar', '001/001/001', 'Muhamad Aditya', '2024-06-11', '2024-06-12', 3, 2, 'Surat keterangan domisili', 'TIDAK', NULL, '6669b78e69c5e.pdf', '2024-06-12 14:58:22', '2024-06-12 14:58:22'),
(6, 1, 'Keluar', '001/001/002', 'Nor Nabila', '2024-06-11', '2024-06-12', 3, 2, 'Surat keterangan tidak mampu', 'TIDAK', NULL, '6669b7cecdbdd.pdf', '2024-06-12 14:59:26', '2024-06-12 14:59:26'),
(7, 1, 'Keluar', '001/001/003', 'Ketua RT Alalak Tengah', '2024-06-11', '2024-06-13', 1, 1, 'Surat himbauan bencana banjir', 'TIDAK', NULL, '6669b80b5b8d2.pdf', '2024-06-12 15:00:27', '2024-06-13 03:27:11'),
(8, 1, 'Masuk', '001/001/004', 'Walikota', '2024-06-11', '2024-06-13', 1, 1, 'Pelatihan aplikasi baru', 'TIDAK', 3, '6669bb22789ef.pdf', '2024-06-12 15:13:38', '2024-06-13 03:34:51'),
(10, 2, 'Masuk', '001/001/005', 'Dinas komunikasi dan informasi', '2024-06-12', '2024-06-13', 1, 1, 'Sosialisasi digitalisasi', 'TIDAK', 4, '666a65276ddbd.pdf', '2024-06-13 03:19:03', '2024-06-13 03:19:03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nip` varchar(255) DEFAULT NULL,
  `jenis_kelamin` enum('Laki-Laki','Perempuan') NOT NULL DEFAULT 'Laki-Laki',
  `telepon` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `level` enum('Admin','Lurah','Sekretaris','Kasi Pem - Kemasy','Kasi Ekobag','Kasi Trantibum','Petugas') NOT NULL,
  `status` enum('A','I') NOT NULL DEFAULT 'A',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `nip`, `jenis_kelamin`, `telepon`, `foto`, `password`, `level`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin@gmail.com', NULL, 'Laki-Laki', NULL, NULL, '$2y$10$0Yus1ZIzsYEhemyeMq3s1uwWXxyb57Yfd/Qy861GnAt6YKi7mrY.i', 'Admin', 'A', '2024-06-11 07:26:58', '2024-06-12 16:15:55'),
(2, 'Muhammad Noor Ariansyah, S.STP', 'lurah@gmail.com', NULL, 'Laki-Laki', NULL, NULL, '$2y$10$Mevo.OefXUzPf9qVieJQ4.ep6PNt7T3UaWQ2TqT5ifjE3Dc/mRQqO', 'Lurah', 'A', '2024-06-11 07:40:27', '2024-06-13 02:58:42'),
(3, 'Muhamad Aditya', 'petugas@gmail.com', NULL, 'Laki-Laki', NULL, NULL, '$2y$10$EE8uJ/YcMLjCVrQctIIai.K44JAgFB7hMIx86CWP0nwGS4OpoQK0K', 'Petugas', 'A', '2024-06-11 08:01:35', '2024-06-11 08:01:35'),
(4, 'Muhammad Thoriq Al-Furqon S.Pd', 'sekretaris@gmail.com', NULL, 'Laki-Laki', NULL, NULL, '$2y$10$5aWB8bpAPM0t.Np6N2iEaOd5tp2ACPbUp37KTbVcnJwBdsvoVmNG6', 'Sekretaris', 'A', '2024-06-11 21:47:59', '2024-06-11 21:47:59'),
(6, 'Siti Norjanah', 'kasiekobag@gmail.com', NULL, 'Perempuan', NULL, NULL, '$2y$10$XyMu3K2WHJGSCsnk6rJVm.Ybkm1IOjIHvK5ZRs99jZ2lsza9xVkCO', 'Kasi Ekobag', 'A', '2024-06-11 21:48:52', '2024-06-11 21:48:52'),
(7, 'Muhammad Rizqon', 'kasitrantibum@gmail.com', NULL, 'Laki-Laki', NULL, NULL, '$2y$10$ixAuntBwLBUwCeg0f41gV.vDx59wn3.U3oXehQQzAgwZMORTpWJYW', 'Kasi Trantibum', 'A', '2024-06-11 21:49:33', '2024-06-11 21:49:33'),
(8, 'Muhamad', 'kasipemkemasy@gmail.com', NULL, 'Laki-Laki', NULL, NULL, '$2y$10$WGDjz.GDwXf3eYSMeyVjAuxHc8RpgHCv1gc8Gj6sQC936utvkY0cK', 'Kasi Pem - Kemasy', 'A', '2024-06-11 21:49:59', '2024-06-11 21:49:59');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `klasifikasi_surat`
--
ALTER TABLE `klasifikasi_surat`
  ADD PRIMARY KEY (`id_klasifikasi`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `status_surat`
--
ALTER TABLE `status_surat`
  ADD PRIMARY KEY (`id_status`);

--
-- Indeks untuk tabel `surat`
--
ALTER TABLE `surat`
  ADD PRIMARY KEY (`id_surat`),
  ADD KEY `surat_id_user_foreign` (`id_user`),
  ADD KEY `surat_id_klasifikasi_foreign` (`id_klasifikasi`),
  ADD KEY `surat_id_status_foreign` (`id_status`),
  ADD KEY `surat_disposisi_foreign` (`disposisi`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `klasifikasi_surat`
--
ALTER TABLE `klasifikasi_surat`
  MODIFY `id_klasifikasi` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `status_surat`
--
ALTER TABLE `status_surat`
  MODIFY `id_status` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `surat`
--
ALTER TABLE `surat`
  MODIFY `id_surat` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `surat`
--
ALTER TABLE `surat`
  ADD CONSTRAINT `surat_disposisi_foreign` FOREIGN KEY (`disposisi`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `surat_id_klasifikasi_foreign` FOREIGN KEY (`id_klasifikasi`) REFERENCES `klasifikasi_surat` (`id_klasifikasi`) ON DELETE SET NULL,
  ADD CONSTRAINT `surat_id_status_foreign` FOREIGN KEY (`id_status`) REFERENCES `status_surat` (`id_status`) ON DELETE SET NULL,
  ADD CONSTRAINT `surat_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
