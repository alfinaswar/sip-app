-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 10 Nov 2026 pada 13.59
-- Versi server: 5.7.33
-- Versi PHP: 8.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sip`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2025_07_23_035146_create_surat_izins_table', 2),
(7, '2025_08_07_172840_create_riwayat_updates_table', 3),
(8, '2025_08_28_063457_add_nama_ttd_dinamis', 4),
(9, '2025_09_03_080530_add_field_riwayat', 5),
(10, '2025_12_29_041229_add_tanggal_dibuat_to_surat_izins', 6),
(11, '2025_12_29_041243_add_tanggal_dibuat_to_surat_izins', 6);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('admin@gmail.com', '$2y$10$tK3y2dAAs9P9uZVA8wIH2uEi1xYyedxTMiWaXi58QV9yQ3IemXdja', '2025-08-07 19:57:32');

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `riwayat_updates`
--

CREATE TABLE `riwayat_updates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `IdSurat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `NomorSIP` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Nama` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Pangkat` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Korps` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `NRPNIP` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Jabatan` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Kesatuan` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Ktp` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Ttl` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Status` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `JumlahTanggungan` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `AnggotaKeluarga` json DEFAULT NULL,
  `UntukMenempati` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Keterangan` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `DigunakanSebagai` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Kpad` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `AlamatRumah` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `TypeLuas` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Tmt` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `TandaTangan` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Sebagai` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Foto` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Tembusan` longtext COLLATE utf8mb4_unicode_ci,
  `NamaTtd` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `NamaTtd2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `TanggalDibuat` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `riwayat_updates`
--

INSERT INTO `riwayat_updates` (`id`, `IdSurat`, `NomorSIP`, `Nama`, `Pangkat`, `Korps`, `NRPNIP`, `Jabatan`, `Kesatuan`, `Ktp`, `Ttl`, `Status`, `JumlahTanggungan`, `AnggotaKeluarga`, `UntukMenempati`, `Keterangan`, `DigunakanSebagai`, `Kpad`, `AlamatRumah`, `TypeLuas`, `Tmt`, `TandaTangan`, `Sebagai`, `Foto`, `Tembusan`, `NamaTtd`, `NamaTtd2`, `created_at`, `updated_at`, `TanggalDibuat`) VALUES
(1, '1', 'Quaerat quod quos re', 'Iste culpa maiores n', 'Kopral Satu', 'Cke', '12323', 'Voluptatem harum con', 'Earum rerum qui enim', 'Dolor qui molestias', 'Commodi aut odit qui', 'PURNAWIRAWAN', 'Nulla illum sapient', '[{\"jk\": \"Perempuan\", \"nama\": \"Sit consequat Disti\", \"umur\": \"11\", \"hubungan\": \"Menantu\", \"keterangan\": \"Ea magna velit labo\"}, {\"jk\": \"Laki-laki\", \"nama\": \"Est labore sit sit d\", \"umur\": \"59\", \"hubungan\": \"Istri\", \"keterangan\": \"Omnis consectetur m\"}]', NULL, NULL, NULL, NULL, 'Quasi fuga Quibusda', 'Sed sunt.', 'Dignissimos blanditi', NULL, NULL, NULL, NULL, NULL, NULL, '2025-08-07 19:50:39', '2025-08-07 19:50:39', NULL),
(3, '1', 'SIP  /3/&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; / VII/ 2025', '111111111111', 'Sersan Satu', 'Caj', '213', '213', '213', '213', '231', 'DUDA WREDATAMA', '123', '[{\"jk\": \"Laki-laki\", \"nama\": \"Sit consequat Disti\", \"umur\": \"23\", \"hubungan\": \"Keponakan\"}, {\"jk\": null, \"nama\": \"12321\", \"umur\": \"213\", \"hubungan\": null}, {\"jk\": null, \"nama\": \"12312\", \"umur\": \"213\", \"hubungan\": null}, {\"jk\": null, \"nama\": \"3123\", \"umur\": \"213\", \"hubungan\": null}, {\"jk\": null, \"nama\": \"123123\", \"umur\": \"23\", \"hubungan\": null}, {\"jk\": null, \"nama\": \"123\", \"umur\": \"2132\", \"hubungan\": null}]', NULL, '23', NULL, 'KALIDERES', '213123', '213123', 'Et et similique repr', NULL, NULL, NULL, NULL, NULL, NULL, '2025-08-25 18:54:49', '2025-08-26 23:54:12', NULL),
(4, '1', 'SIP  /3/&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; / VII/ 2025', '123213', 'Sersan Satu', 'Caj', '213', '213', '213', '213', '231', 'DUDA WREDATAMA', '1232', '[{\"jk\": \"Laki-laki\", \"nama\": \"Sit consequat Disti\", \"umur\": \"23\", \"hubungan\": \"Keponakan\"}, {\"jk\": null, \"nama\": null, \"umur\": null, \"hubungan\": null}, {\"jk\": null, \"nama\": null, \"umur\": null, \"hubungan\": null}]', NULL, '23', NULL, 'KALIDERES', '213123', '213123', 'Et et similique repr', NULL, NULL, NULL, NULL, NULL, NULL, '2025-08-25 18:54:49', '2025-08-26 01:22:26', NULL),
(5, '1', 'SIP  /3/&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; / VII/ 2025&nbsp;', '123213', 'Sersan Satu', 'Caj', '213', '213', '213', '213', '231', 'DUDA WREDATAMA', '1232', '[{\"jk\": \"Laki-laki\", \"nama\": \"Sit consequat Disti\", \"umur\": \"23\", \"hubungan\": \"Keponakan\"}, {\"jk\": null, \"nama\": null, \"umur\": null, \"hubungan\": null}, {\"jk\": null, \"nama\": null, \"umur\": null, \"hubungan\": null}]', NULL, '23', NULL, 'KALIDERES', '213123', '213123', 'Et et similique repr', NULL, NULL, NULL, NULL, NULL, NULL, '2025-08-25 18:54:49', '2025-08-26 01:23:35', NULL),
(6, '3', '\"22 2&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;2222\"', 'Non quibusdam anim e', 'PNS III/d', 'Inf', '32', 'Cumque labore tempor', 'Aliqua Nihil verita', 'Qui impedit est et', 'Dolor ad sequi sed c', 'AKTIF', 'Fugit id aut aliqu', '[{\"jk\": \"Laki-laki\", \"nama\": \"Corporis sit vel dol\", \"umur\": \"61\", \"hubungan\": \"Lainnya\"}]', NULL, 'Ut rerum tempor sit', NULL, 'REMPoa MABAD 25/60/124', 'Molestiae adipisicin', 'Nihil nihil corporis.', 'Obcaecati dolor qui', NULL, NULL, NULL, NULL, NULL, NULL, '2025-08-25 19:10:35', '2025-08-25 19:10:35', NULL),
(7, '6', 'Odio eveniet, enim s.', 'Et est dolore qui co', 'PNS III/a', 'Cpl', '80', 'Ad magni cillum est', 'Quis duis iusto et v', 'In dolorem in evenie', 'Saepe occaecat ut qu', '-', 'Voluptates eveniet', '[{\"jk\": \"Laki-laki\", \"nama\": \"Mollit rerum aliquip\", \"umur\": \"Hic irure sit facere\", \"hubungan\": \"Suami\"}]', NULL, 'Consectetur rem dol', NULL, 'CIJANTUNG ZENI', 'Quia assumenda in mi', 'Molestiae cillum cum.', 'Voluptatem in cillum', NULL, NULL, NULL, NULL, NULL, NULL, '2025-08-26 20:01:32', '2025-08-26 20:01:32', NULL),
(8, '6', '123123 1 3123 123&nbsp;', 'Non quibusdam anim e', 'PNS III/d', 'Inf', '32', 'Cumque labore tempor', 'Aliqua Nihil verita', 'Qui impedit est et', 'Dolor ad sequi sed c', 'AKTIF', 'Fugit id aut aliqu', '[{\"jk\": \"Laki-laki\", \"nama\": \"Corporis sit vel dol\", \"umur\": \"61\", \"hubungan\": \"Lainnya\"}]', NULL, 'Ut rerum tempor sit', NULL, 'REMPoa MABAD 25/60/124', 'Molestiae adipisicin', 'Nihil nihil corporis.', 'Obcaecati dolor qui', NULL, NULL, NULL, NULL, NULL, NULL, '2025-08-26 20:01:32', '2025-08-26 20:07:31', NULL),
(9, '3', 'SIP  /3/&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; / VII/ 2025', '123213', 'Sersan Satu', 'Caj', '213', '213', '213', '213', '231', 'DUDA WREDATAMA', '123', '[{\"jk\": \"Laki-laki\", \"nama\": \"Sit consequat Disti\", \"umur\": \"23\", \"hubungan\": \"Keponakan\"}, {\"jk\": null, \"nama\": \"123\", \"umur\": null, \"hubungan\": null}, {\"jk\": null, \"nama\": \"123\", \"umur\": null, \"hubungan\": null}]', NULL, '23', NULL, 'KALIDERES', '213123', '213123', 'Et et similique repr', NULL, NULL, NULL, NULL, NULL, NULL, '2025-08-25 19:10:35', '2025-08-26 20:03:26', NULL),
(10, '3', 'SIP  /3/&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; / VII/ 2025', '111111111111111111111', 'Sersan Satu', 'Caj', '213', '213', '213', '213', '231', 'DUDA WREDATAMA', '123', '[{\"jk\": \"Laki-laki\", \"nama\": \"Sit consequat Disti\", \"umur\": \"23\", \"hubungan\": \"Keponakan\"}, {\"jk\": null, \"nama\": null, \"umur\": null, \"hubungan\": null}, {\"jk\": null, \"nama\": null, \"umur\": null, \"hubungan\": null}]', NULL, '23', NULL, 'KALIDERES', '213123', '213123', 'Et et similique repr', NULL, NULL, NULL, NULL, NULL, NULL, '2025-08-25 19:10:35', '2025-08-26 20:11:26', NULL),
(11, '3', 'SIP  /3/&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; / VII/ 2025', '111111111111111111111', 'Sersan Satu', 'Caj', '213', '213', '213', '213', '231', 'DUDA WREDATAMA', '123', '[{\"jk\": \"Laki-laki\", \"nama\": \"Sit consequat Disti\", \"umur\": \"23\", \"hubungan\": \"Keponakan\"}, {\"jk\": null, \"nama\": \"123\", \"umur\": \"213\", \"hubungan\": null}, {\"jk\": null, \"nama\": \"231\", \"umur\": \"231\", \"hubungan\": null}, {\"jk\": null, \"nama\": \"231\", \"umur\": \"2312\", \"hubungan\": null}, {\"jk\": \"Laki-laki\", \"nama\": \"123213\", \"umur\": \"13\", \"hubungan\": \"Cucu\"}]', NULL, '23', NULL, 'KALIDERES', '213123', '213123', 'Et et similique repr', NULL, NULL, NULL, NULL, NULL, NULL, '2025-08-25 19:10:35', '2025-08-26 23:52:10', NULL),
(12, '3', 'SIP  /3/&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; / VII/ 2025', '111111111111111111111', 'Sersan Satu', 'Caj', '213', '213', '213', '213', '231', 'DUDA WREDATAMA', '123', '[{\"jk\": \"Laki-laki\", \"nama\": \"Sit consequat Disti\", \"umur\": \"23\", \"hubungan\": \"Keponakan\"}, {\"jk\": \"Perempuan\", \"nama\": \"213213\", \"umur\": \"123\", \"hubungan\": \"Keponakan\"}, {\"jk\": null, \"nama\": \"231\", \"umur\": \"231\", \"hubungan\": null}, {\"jk\": null, \"nama\": \"231\", \"umur\": \"2312\", \"hubungan\": null}, {\"jk\": \"Laki-laki\", \"nama\": \"123213\", \"umur\": \"13\", \"hubungan\": \"Cucu\"}]', NULL, '23', NULL, 'KALIDERES', '213123', '213123', 'Et et similique repr', NULL, NULL, NULL, NULL, NULL, NULL, '2025-08-25 19:10:35', '2025-08-26 23:52:49', NULL),
(13, '8', 'Obcaecati non except.', 'Fugiat saepe repell', 'Kopral Dua', 'Cpm', '100', 'Sint in veritatis i', 'Velit quasi iusto u', 'Numquam autem ut sed', 'Ut ut reprehenderit', 'PURNAWIRAWAN', 'Ab necessitatibus id', '[{\"jk\": \"Perempuan\", \"nama\": \"Suscipit aliquip mod\", \"umur\": \"Officiis minim sit v\", \"hubungan\": \"Menantu\"}]', NULL, 'Dolorum et rerum vol', NULL, 'LENTENG AGUNG MABAD II', 'Deleniti porro asper', 'Est, placeat, praese.', 'Irure quod quia illo', NULL, NULL, NULL, NULL, NULL, NULL, '2025-08-27 23:43:15', '2025-08-27 23:43:15', NULL),
(14, '9', 'Cumque sit, soluta r.', 'Labore qui et minim', 'Sersan Mayor', 'Ckm', '73', 'Debitis eiusmod accu', 'Proident qui elit', 'Aliqua Culpa repre', 'Sunt et cupidatat au', 'AKTIF', 'Molestias ab adipisi', '[{\"jk\": null, \"nama\": null, \"umur\": null, \"hubungan\": null}]', NULL, 'Incidunt aut error', NULL, 'LENTENG AGUNG MABAD I', 'Vel ullam debitis qu', 'Quis dicta saepe sin.', 'Ab odio unde et cons', NULL, NULL, NULL, NULL, NULL, NULL, '2025-09-01 21:16:53', '2025-09-01 21:16:53', NULL),
(15, '9', 'Cumque sit, soluta r.1', 'Labore qui et minim', 'Sersan Mayor', 'Ckm', '73', 'Debitis eiusmod accu', 'Proident qui elit', 'Aliqua Culpa repre', 'Sunt et cupidatat au', 'AKTIF', 'Molestias ab adipisi', '[{\"jk\": null, \"nama\": null, \"umur\": null, \"hubungan\": null}]', NULL, 'Incidunt aut error', NULL, 'LENTENG AGUNG MABAD I', 'Vel ullam debitis qu', 'Quis dicta saepe sin.', 'Ab odio unde et cons', NULL, NULL, NULL, NULL, NULL, NULL, '2025-09-01 21:16:53', '2025-09-01 21:17:42', NULL),
(16, '11', 'Obcaecati obcaecati .', 'Molestiae dolor volu', 'Kapten', 'Caj', 'Impedit et quos arc', 'Ea omnis officia mol', 'Id incidunt volupt', 'Et sunt eum in ad m', 'Deserunt illum sunt', 'DUDA WREDATAMA', 'Nam libero dolore la', '[{\"jk\": \"Perempuan\", \"nama\": \"Exercitationem accus\", \"umur\": \"Consequatur Facilis\", \"hubungan\": \"Anak\"}]', NULL, 'Et ut voluptatum exc', NULL, 'CIJANTUNG SEDERHANA', 'Eum praesentium inci', 'Reprehenderit, eaque.', 'Natus ipsum culpa', NULL, NULL, NULL, NULL, 'Dolore sunt inventor', 'Eiusmod et qui exerc', '2025-09-21 19:03:15', '2025-09-21 19:03:15', NULL),
(17, '11', '11111111111111', 'Molestiae dolor volu', 'Kapten', 'Caj', 'Impedit et quos arc', 'Ea omnis officia mol', 'Id incidunt volupt', 'Et sunt eum in ad m', 'Deserunt illum sunt', 'DUDA WREDATAMA', 'Nam libero dolore la', '[{\"jk\": \"Perempuan\", \"nama\": \"Exercitationem accus\", \"umur\": \"Consequatur Facilis\", \"hubungan\": \"Anak\"}]', NULL, 'Et ut voluptatum exc', NULL, 'CIJANTUNG SEDERHANA', 'Eum praesentium inci', 'Reprehenderit, eaque.', 'Natus ipsum culpa', NULL, NULL, NULL, NULL, 'Dolore sunt inventor', 'Eiusmod et qui exerc', '2025-09-21 19:03:15', '2025-09-21 19:03:23', NULL),
(18, '14', 'Sed itaque consectet.', 'Et sit debitis perf', 'Sersan Dua', '12222222222', 'Sed nemo dolores nos', 'Possimus in a est n', 'Sed animi modi ad i', 'Ex sint corporis dol', 'Laborum Voluptatem', 'DUDA WREDATAMA', 'Exercitationem labor', '[{\"jk\": \"Laki-laki\", \"nama\": \"Quibusdam sequi aper\", \"umur\": \"Nihil autem debitis\", \"hubungan\": \"Ibu\"}]', NULL, 'Harum sed quasi reru', NULL, 'CIPINANG JAYA', 'Deserunt qui quisqua', 'Eum autem consequat', 'Placeat ex fugit v', NULL, NULL, NULL, NULL, 'Autem perferendis vo', 'Fuga Consequuntur i', '2025-11-30 23:48:48', '2025-11-30 23:48:48', NULL),
(19, '16', 'Ea modi sint maxime .', 'Qui eius laboris off', 'Letnan Dua', 'Arh', 'Aut officia aut dese', 'Esse voluptates id c', 'Deleniti pariatur E', 'Sequi animi blandit', 'Nostrum modi labore', '-', 'Ut et enim provident', '[{\"jk\": \"Laki-laki\", \"nama\": \"Non aut quis in veli\", \"umur\": \"Esse reprehenderit\", \"hubungan\": \"Cucu\"}]', NULL, 'Ad alias laboriosam', NULL, 'ZENI KRAMAT JATI', 'Maiores enim aliquip', 'Similique quidem inv', 'Dolores qui laborios', NULL, NULL, NULL, NULL, 'Amet harum incidunt', 'Aut non sed quo enim', '2026-02-22 20:39:19', '2026-02-22 20:39:19', '1980-06-23'),
(20, '16', '23456788765456789', 'Qui eius laboris off', 'Letnan Dua', 'Arh', 'Aut officia aut dese', 'Esse voluptates id c', 'Deleniti pariatur E', 'Sequi animi blandit', 'Nostrum modi labore', '-', 'Ut et enim provident', '[{\"jk\": \"Laki-laki\", \"nama\": \"Non aut quis in veli\", \"umur\": \"Esse reprehenderit\", \"hubungan\": \"Cucu\"}]', NULL, 'Ad alias laboriosam', NULL, 'ZENI KRAMAT JATI', 'Maiores enim aliquip', 'Similique quidem inv', 'Dolores qui laborios', NULL, NULL, NULL, NULL, 'Amet harum incidunt', 'Aut non sed quo enim', '2026-02-22 20:39:19', '2026-02-22 20:39:45', '1980-06-23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat_izins`
--

CREATE TABLE `surat_izins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `NomorSIP` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Nama` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Pangkat` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Korps` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `NRPNIP` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Jabatan` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Kesatuan` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Ktp` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Ttl` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Status` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `JumlahTanggungan` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `AnggotaKeluarga` json DEFAULT NULL,
  `UntukMenempati` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Keterangan` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `DigunakanSebagai` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Kpad` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `AlamatRumah` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `TypeLuas` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Tmt` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `TandaTangan` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Sebagai` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Foto` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Tembusan` longtext COLLATE utf8mb4_unicode_ci,
  `NamaTtd` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `NamaTtd2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `TanggalDibuat` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `surat_izins`
--

INSERT INTO `surat_izins` (`id`, `NomorSIP`, `Nama`, `Pangkat`, `Korps`, `NRPNIP`, `Jabatan`, `Kesatuan`, `Ktp`, `Ttl`, `Status`, `JumlahTanggungan`, `AnggotaKeluarga`, `UntukMenempati`, `Keterangan`, `DigunakanSebagai`, `Kpad`, `AlamatRumah`, `TypeLuas`, `Tmt`, `TandaTangan`, `Sebagai`, `Foto`, `Tembusan`, `NamaTtd`, `NamaTtd2`, `created_at`, `updated_at`, `TanggalDibuat`) VALUES
(1, 'SIP  /3/&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; / VII/ 2025&nbsp;', '123213', 'Sersan Satu', 'Caj', '213', '213', '213', '213', '231', 'DUDA WREDATAMA', '1232', '[{\"jk\": \"Laki-laki\", \"nama\": \"Sit consequat Disti\", \"umur\": \"23\", \"hubungan\": \"Keponakan\"}, {\"jk\": null, \"nama\": \"213\", \"umur\": \"123\", \"hubungan\": null}, {\"jk\": null, \"nama\": \"123\", \"umur\": \"132\", \"hubungan\": null}]', NULL, '23', NULL, 'KALIDERES', '213123', '213123', 'Et et similique repr', NULL, NULL, NULL, NULL, NULL, NULL, '2025-08-25 18:54:49', '2025-08-26 20:02:50', NULL),
(2, '[\"Do vero illum vel t\",\"Aspernatur veniam a\",\"Quibusdam sed elit\"]', 'Itaque ea aute esse', 'Sersan Mayor', 'Cpm', '45', 'Quibusdam sequi iust', 'Quaerat ratione pari', 'Non irure voluptatum', 'Laudantium ex incid', 'PURNAWIRAWAN', 'Nihil quasi ea accus', '[{\"jk\": \"Laki-laki\", \"nama\": \"Fuga Ullam eiusmod\", \"umur\": \"98\", \"hubungan\": \"Ayah\"}]', NULL, 'Labore aliquam cupid', NULL, 'CIJANTUNG IV (RADAR)', 'Ipsa ut sit conseq', 'Aspernatur est, odit.', 'Ut perferendis offic', NULL, NULL, NULL, NULL, NULL, NULL, '2025-08-25 18:58:52', '2025-08-25 18:58:52', NULL),
(3, 'SIP  /3/&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; / VII/ 2025', '111111111111111111111', 'Sersan Satu', 'Caj', '213', '213', '213', '213', '231', 'DUDA WREDATAMA', '123', '[{\"jk\": \"Laki-laki\", \"nama\": \"Sit consequat Disti\", \"umur\": \"23\", \"hubungan\": \"Keponakan\"}, {\"jk\": \"Perempuan\", \"nama\": \"213213\", \"umur\": \"123\", \"hubungan\": \"Keponakan\"}, {\"jk\": null, \"nama\": \"231\", \"umur\": \"231\", \"hubungan\": null}, {\"jk\": null, \"nama\": \"231\", \"umur\": \"2312\", \"hubungan\": null}, {\"jk\": \"Laki-laki\", \"nama\": \"123213\", \"umur\": \"13\", \"hubungan\": \"Cucu\"}, {\"jk\": null, \"nama\": \"123\", \"umur\": null, \"hubungan\": null}, {\"jk\": null, \"nama\": \"123\", \"umur\": null, \"hubungan\": null}]', NULL, '23', NULL, 'KALIDERES', '213123', '213123', 'Et et similique repr', NULL, NULL, NULL, NULL, NULL, NULL, '2025-08-25 19:10:35', '2025-08-26 23:55:22', NULL),
(4, 'SIP&nbsp; /37/&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; / VII/ 2025', 'Tempore ut illum f', 'Sersan Dua', 'Ctp', '36', 'Consectetur blanditi', 'Eligendi magna delen', 'Assumenda aut quo no', 'Illo maxime necessit', '-', 'Sed veniam consequa', '[{\"jk\": \"Laki-laki\", \"nama\": \"Aut commodi placeat\", \"umur\": \"40 TAHUN 2 BULAN\", \"hubungan\": \"Ayah\"}]', NULL, 'Nisi voluptatem quis', NULL, 'CILILITAN II (3 MEI)', 'Doloremque molestiae', 'Ipsum quam in exerci.', 'Enim est nulla dolor', NULL, NULL, NULL, NULL, NULL, NULL, '2025-08-25 19:13:59', '2025-08-25 19:13:59', NULL),
(5, 'SIP&nbsp; /37/&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; / VII/ 2025', 'Qui officia eu et ex', 'PNS II/b', 'Caj', '52', 'Esse dignissimos ne', 'Explicabo Nisi elit', 'Est ipsa vero cumq', 'Ea lorem sit deseru', 'DUDA', 'Molestiae aut totam', '[{\"jk\": \"Laki-laki\", \"nama\": \"Rerum aut nisi nobis\", \"umur\": \"Quos tempor quo est\", \"hubungan\": \"Istri\"}, {\"jk\": \"Laki-laki\", \"nama\": \"Iste nulla excepturi\", \"umur\": \"Illo officia possimu\", \"hubungan\": \"Istri\"}, {\"jk\": \"Perempuan\", \"nama\": \"Et duis ducimus par\", \"umur\": \"Corrupti voluptas q\", \"hubungan\": \"Cucu\"}, {\"jk\": \"Perempuan\", \"nama\": \"Molestiae nihil vel\", \"umur\": \"Aut eius soluta ut a\", \"hubungan\": \"Lainnya\"}, {\"jk\": \"Perempuan\", \"nama\": \"Deserunt in est par\", \"umur\": \"Sit in ullam vel ita\", \"hubungan\": \"Mertua\"}, {\"jk\": \"Perempuan\", \"nama\": \"Itaque eius amet no\", \"umur\": \"Occaecat consequuntu\", \"hubungan\": \"Keponakan\"}, {\"jk\": \"Perempuan\", \"nama\": \"Non sed consequuntur\", \"umur\": \"Impedit deserunt si\", \"hubungan\": \"Cucu\"}]', NULL, 'Qui voluptas qui con', NULL, 'CIPINANG JAYA', 'Architecto et tempor', 'Elit, deleniti nulla.', 'Neque doloremque pro', NULL, NULL, NULL, NULL, NULL, NULL, '2025-08-26 19:49:05', '2025-08-26 19:49:05', NULL),
(6, '11111111111111111', 'Non quibusdam anim e', 'PNS III/d', 'Inf', '32', 'Cumque labore tempor', 'Aliqua Nihil verita', 'Qui impedit est et', 'Dolor ad sequi sed c', 'AKTIF', 'Fugit id aut aliqu', '[{\"jk\": \"Laki-laki\", \"nama\": \"Corporis sit vel dol\", \"umur\": \"61\", \"hubungan\": \"Lainnya\"}]', NULL, 'Ut rerum tempor sit', NULL, 'REMPoa MABAD 25/60/124', 'Molestiae adipisicin', 'Nihil nihil corporis.', 'Obcaecati dolor qui', NULL, NULL, NULL, NULL, NULL, NULL, '2025-08-26 20:01:32', '2025-08-26 20:11:05', NULL),
(7, 'In quam magnam ab eo.', 'Qui reiciendis culpa', 'PNS IV/b', 'Cba', '80', 'Consequatur Nam adip', 'Quas blanditiis volu', 'Iusto voluptas sint', 'Non ut deserunt eu m', 'WARAKAWURI', 'Voluptas repellendus', '[{\"jk\": \"Perempuan\", \"nama\": \"Illo et ullamco eum\", \"umur\": \"Aliquam in ratione o\", \"hubungan\": \"Menantu\"}, {\"jk\": null, \"nama\": \"213213\", \"umur\": \"123\", \"hubungan\": null}]', NULL, 'Anim amet nisi cupi', NULL, 'CIJANTUNG II', 'Maxime dolores eaque', 'Nemo repellendus. Ma.', 'Aperiam dolorum eius', NULL, NULL, NULL, NULL, NULL, NULL, '2025-08-26 20:01:42', '2025-08-26 20:01:42', NULL),
(8, 'Obcaecati non except.', 'Fugiat saepe repell', 'Kopral Dua', 'Cpm', '100', 'Sint in veritatis i', 'Velit quasi iusto u', 'Numquam autem ut sed', 'Ut ut reprehenderit', 'PURNAWIRAWAN', 'Ab necessitatibus id', '[{\"jk\": \"Perempuan\", \"nama\": \"Suscipit aliquip mod\", \"umur\": \"Officiis minim sit v\", \"hubungan\": \"Menantu\"}]', NULL, 'Dolorum et rerum vol', NULL, 'LENTENG AGUNG MABAD II', 'Deleniti porro asper', 'Est, placeat, praese.', 'Irure quod quia illo', NULL, NULL, NULL, NULL, '111111', '22222222222', '2025-08-27 23:43:15', '2025-08-27 23:45:27', NULL),
(9, 'Fuga. Voluptatum est.', 'Tempora repudiandae', 'Kopral Kepala', 'Ckm', 'Expedita ex aliquip', 'Ad totam possimus v', 'Non rerum consectetu', 'Aut omnis odio sit e', 'Deleniti ut recusand', 'DUDA', 'Quia sit dolorem off', '[{\"jk\": null, \"nama\": null, \"umur\": null, \"hubungan\": null}]', NULL, 'Dignissimos possimus', NULL, 'CIJANTUNG III (KOBANGDIKLAT)', 'Error aute est iure', 'Exercitationem sunt .', 'Consequatur similiq', NULL, NULL, NULL, NULL, 'Eligendi optio est', 'Sit et aut autem ve', '2025-09-01 21:16:53', '2025-09-02 23:53:13', NULL),
(10, 'Qui reprehenderit ve.', 'Dolor perferendis at', 'PNS III/a', 'Chk', 'Velit reiciendis vol', 'Perferendis nulla do', 'Numquam deserunt sed', 'Fugit omnis amet n', 'Est ad cupiditate fa', 'JANDA WREDATAMA', 'Temporibus in dolore', '[{\"jk\": null, \"nama\": null, \"umur\": null, \"hubungan\": null}]', NULL, 'Deserunt minim adipi', NULL, 'PALAD', 'In inventore volupta', 'Mollit voluptatum en.', 'Saepe ea aut quisqua', NULL, NULL, NULL, NULL, 'Cum est tempora ess', 'Quod sit aut et aut', '2025-09-02 23:53:52', '2025-09-02 23:53:52', NULL),
(11, '11111111111111', '1111111111', 'Kapten', 'Caj', 'Impedit et quos arc', 'Ea omnis officia mol', 'Id incidunt volupt', 'Et sunt eum in ad m', 'Deserunt illum sunt', 'DUDA WREDATAMA', 'Nam libero dolore la', '[{\"jk\": \"Perempuan\", \"nama\": \"Exercitationem accus\", \"umur\": \"Consequatur Facilis\", \"hubungan\": \"Anak\"}]', NULL, 'Et ut voluptatum exc', NULL, 'CIJANTUNG SEDERHANA', 'Eum praesentium inci', 'Reprehenderit, eaque.', 'Natus ipsum culpa', NULL, NULL, NULL, NULL, 'Dolore sunt inventor', 'Eiusmod et qui exerc', '2025-09-21 19:03:15', '2025-09-21 19:03:39', NULL),
(12, '1234567890123456', 'Dignissimos dolor ni', 'PNS III/a', 'Cpm', '1234567890123456', 'Fugit dolores dolor', 'Mollit ipsa laborum', 'Aspernatur sunt do', 'Ipsa culpa saepe vo', 'AKTIF', 'Autem in totam dolor', '[{\"jk\": \"Perempuan\", \"nama\": \"Laborum Nam reprehen\", \"umur\": \"23\", \"hubungan\": \"Kakak\"}, {\"jk\": \"Perempuan\", \"nama\": \"Exercitation possimu\", \"umur\": \"23\", \"hubungan\": \"Keponakan\"}, {\"jk\": \"Laki-laki\", \"nama\": \"Veniam culpa volup\", \"umur\": \"23\", \"hubungan\": \"Keponakan\"}, {\"jk\": \"Perempuan\", \"nama\": \"Magnam aut est est v\", \"umur\": \"23\", \"hubungan\": \"Anak\"}, {\"jk\": \"Perempuan\", \"nama\": \"Sed rerum adipisicin\", \"umur\": \"23\", \"hubungan\": \"Mertua\"}, {\"jk\": \"Perempuan\", \"nama\": \"Facilis dolor quis p\", \"umur\": \"23\", \"hubungan\": \"Anak\"}, {\"jk\": \"Laki-laki\", \"nama\": \"Et veniam cum volup\", \"umur\": \"23\", \"hubungan\": \"Cucu\"}]', NULL, 'Voluptatem non quas', NULL, 'DR. WAHIDIN', 'Adipisci sunt ipsum', 'Irure corrupti cons', 'Enim nihil incidunt', NULL, NULL, NULL, NULL, 'Deleniti voluptatibu', 'Impedit magnam comm', '2025-11-03 23:35:53', '2025-11-03 23:35:53', NULL),
(13, 'Consequuntur incidun.', 'Hic vel sapiente des', 'Jenderal TNI', '12222222222', 'Saepe eum nobis modi', 'In reiciendis minus', 'Lorem consequatur te', 'Sint veniam vero se', 'Ullam enim pariatur', 'WARAKAWURI', 'Voluptatibus tempori', '[{\"jk\": \"Laki-laki\", \"nama\": \"Est laboriosam cons\", \"umur\": \"Perspiciatis ut vol\", \"hubungan\": \"Suami\"}]', NULL, 'Molestias nobis obca', NULL, 'REMPoa MABAD 55/65', 'Provident sunt non', 'Incidunt consequatu', 'Unde cupiditate nost', NULL, NULL, NULL, NULL, 'Quos illum suscipit', 'Minim consequatur ea', '2025-11-27 18:54:46', '2025-11-27 18:54:46', NULL),
(14, 'Sed itaque consectet.', 'Et sit debitis perf', 'Sersan Dua', 'Cku', 'Sed nemo dolores nos', 'Possimus in a est n', 'Sed animi modi ad i', 'Ex sint corporis dol', 'Laborum Voluptatem', 'DUDA WREDATAMA', 'Exercitationem labor', '[{\"jk\": \"Laki-laki\", \"nama\": \"Quibusdam sequi aper\", \"umur\": \"Nihil autem debitis\", \"hubungan\": \"Ibu\"}]', NULL, 'Harum sed quasi reru', NULL, 'CIPINANG JAYA', 'Deserunt qui quisqua', 'Eum autem consequat', 'Placeat ex fugit v', NULL, NULL, NULL, NULL, 'Autem perferendis vo', 'Fuga Consequuntur i', '2025-11-30 23:48:48', '2025-11-30 23:48:58', NULL),
(15, 'Ab est aut enim et.', 'Est laborum qui quis', 'PNS III/b', 'Cpn', 'Veniam velit hic u', 'Maxime voluptate ex', 'Ea labore ex error c', 'Duis quis veritatis', 'Aperiam omnis est s', '-', 'Voluptatem dolor at', '[{\"jk\": \"Laki-laki\", \"nama\": \"Quia corporis ullamc\", \"umur\": \"Numquam ipsam aut cu\", \"hubungan\": \"Cucu\"}]', NULL, 'Eligendi ea id in r', NULL, 'REMPoa MABAD 55/65', 'Duis quisquam pariat', 'Expedita hic provide', 'Vel aperiam exceptur', NULL, NULL, NULL, NULL, 'Voluptate assumenda', 'Et consequatur ea fu', '2025-12-07 19:03:27', '2025-12-07 19:03:36', NULL),
(16, '123123123123123123', '12312322', 'Letnan Dua', 'Arh', 'Aut officia aut dese', 'Esse voluptates id c', 'Deleniti pariatur E', 'Sequi animi blandit', 'Nostrum modi labore', '-', 'Ut et enim provident', '[{\"jk\": \"Laki-laki\", \"nama\": \"Non aut quis in veli\", \"umur\": \"Esse reprehenderit\", \"hubungan\": \"Cucu\"}]', NULL, 'Ad alias laboriosam', NULL, 'ZENI KRAMAT JATI', '123123123', 'Similique quidem inv', 'Dolores qui laborios', NULL, NULL, NULL, NULL, 'Amet harum incidunt', 'Aut non sed quo enim', '2026-02-22 20:39:19', '2026-03-01 18:46:39', '1980-06-23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', NULL, '$2y$10$7GlELQ.mDGbJYnF9Pg8b3eVibrd7oWfDzTZrEijpXYjae68sVgULG', NULL, '2025-07-22 20:41:59', '2025-08-07 20:01:36');

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
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `riwayat_updates`
--
ALTER TABLE `riwayat_updates`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `surat_izins`
--
ALTER TABLE `surat_izins`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `riwayat_updates`
--
ALTER TABLE `riwayat_updates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `surat_izins`
--
ALTER TABLE `surat_izins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
