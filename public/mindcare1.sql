-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 28, 2025 at 12:37 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mindcare1`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`id`, `user_id`, `action`, `details`, `created_at`) VALUES
(1, 2, 'Pasien Ani Wijaya melakukan pendaftaran sesi baru', NULL, '2025-11-20 02:31:32'),
(2, 1, 'Konselor Budi membuat rekam medis baru untuk Ani', NULL, '2025-11-20 02:31:32');

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `action` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` bigint UNSIGNED NOT NULL,
  `patient_id` bigint UNSIGNED NOT NULL,
  `counselor_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `status` enum('pending','scheduled','ongoing','completed','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'scheduled',
  `type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT 'Konseling',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `patient_id`, `counselor_id`, `title`, `start_time`, `end_time`, `status`, `type`, `created_at`) VALUES
(1, 2, 1, 'Sesi Awal Konseling', '2025-11-20 11:00:00', '2025-11-20 12:00:00', 'ongoing', 'Konseling', '2025-11-20 02:31:32'),
(2, 2, 1, 'Tindak Lanjut', '2025-11-21 14:00:00', '2025-11-21 15:00:00', 'scheduled', 'Konseling', '2025-11-20 02:31:32');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `counseling_sessions`
--

CREATE TABLE `counseling_sessions` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `counselor_id` bigint UNSIGNED DEFAULT NULL,
  `date` datetime DEFAULT CURRENT_TIMESTAMP,
  `duration` int DEFAULT NULL,
  `topic` varchar(255) DEFAULT NULL,
  `status` enum('scheduled','completed','cancelled') DEFAULT 'completed',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `counseling_sessions`
--

INSERT INTO `counseling_sessions` (`id`, `user_id`, `counselor_id`, `date`, `duration`, `topic`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, '2025-11-20 10:00:00', 45, NULL, 'completed', '2025-11-25 19:49:41', NULL),
(2, 1, NULL, '2025-11-22 14:00:00', 30, NULL, 'completed', '2025-11-25 19:49:41', NULL),
(3, 5, NULL, '2025-11-25 19:54:37', 5, NULL, 'completed', '2025-11-25 11:54:37', NULL),
(4, 5, NULL, '2025-11-25 19:56:17', 5, NULL, 'completed', '2025-11-25 11:56:17', NULL),
(5, 5, NULL, '2025-11-25 20:02:56', 5, NULL, 'completed', '2025-11-25 12:02:56', NULL),
(6, 5, NULL, '2025-11-26 04:06:27', 5, NULL, 'completed', '2025-11-25 20:06:27', NULL),
(7, 5, NULL, '2025-11-26 04:49:52', 5, NULL, 'completed', '2025-11-25 20:49:52', NULL),
(8, 5, NULL, '2025-11-26 04:51:40', 5, NULL, 'completed', '2025-11-25 20:51:40', NULL),
(9, 5, NULL, '2025-11-26 12:10:00', 45, 'Skizofrenia', 'scheduled', '2025-11-26 04:08:17', NULL),
(10, 5, NULL, '2025-11-26 12:15:00', 45, 'Cemas', 'scheduled', '2025-11-26 04:15:56', NULL),
(11, 5, NULL, '2025-11-28 08:28:23', 5, NULL, 'completed', '2025-11-28 00:28:23', NULL),
(12, 5, NULL, '2025-11-28 08:29:43', 5, NULL, 'completed', '2025-11-28 00:29:43', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `medical_records`
--

CREATE TABLE `medical_records` (
  `id` bigint UNSIGNED NOT NULL,
  `session_id` bigint UNSIGNED NOT NULL,
  `diagnosis` varchar(255) DEFAULT NULL,
  `notes` text,
  `prescription` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `medical_records`
--

INSERT INTO `medical_records` (`id`, `session_id`, `diagnosis`, `notes`, `prescription`, `created_at`) VALUES
(1, 1, 'Kecemasan Ringan', 'Pasien merasa cemas karena pekerjaan. Disarankan latihan pernapasan.', 'Latihan mindfulness 10 menit/hari', '2025-11-25 19:49:41'),
(2, 2, 'Gangguan Tidur', 'Pasien sulit tidur malam hari. Pola tidur tidak teratur.', 'Hindari kafein setelah jam 6 sore', '2025-11-25 19:49:41'),
(3, 3, 'Konsultasi AI', 'User: saya merasa using', 'Tentu, saya mengerti Anda merasa pusing. Namun, penting untuk diingat bahwa saya adalah AI kesehatan mental dan bukan tenaga medis profesional.\n\nRasa pusing bisa disebabkan oleh banyak hal, dan yang terbaik adalah berkonsultasi dengan dokter untuk mengetahui penyebab pastinya dan mendapatkan penanganan yang tepat.\n\nJika rasa pusing Anda juga disertai dengan perasaan cemas atau stres, saya bisa bantu memberikan informasi atau teknik relaksasi untuk mengelola perasaan tersebut. Tapi untuk keluhan fisiknya, dokter adalah orang yang paling tepat untuk membantu.', '2025-11-25 11:54:37'),
(4, 4, 'Konsultasi AI', 'User: saya mengalami depresi', 'Terima kasih sudah membagikan perasaan Anda kepada saya. Saya memahami bahwa menghadapi depresi adalah perjuangan yang sangat berat, dan Anda tidak sendirian dalam hal ini.\n\nBerdasarkan data yang saya miliki, ada beberapa langkah awal yang bisa membantu dalam mengelola perasaan depresi. Mungkin beberapa di antaranya bisa Anda coba:\n\n*   **Mencari Bantuan Profesional:** Ini adalah langkah yang paling penting. Berbicara dengan psikolog atau psikiater dapat membantu Anda memahami apa yang Anda alami dan mendapatkan penanganan yang tepat, baik melalui terapi maupun pengobatan.\n*   **Membangun Sistem Pendukung:** Cobalah untuk tetap terhubung dengan orang-orang yang Anda percaya, seperti keluarga atau teman dekat. Berbagi perasaan dengan mereka bisa sedikit meringankan beban.\n*   **Aktivitas Fisik Ringan:** Coba lakukan aktivitas fisik ringan seperti berjalan kaki selama 15-30 menit setiap hari. Aktivitas fisik terbukti dapat melepaskan endorfin yang bisa memperbaiki suasana hati.\n*   **Perhatikan Kebutuhan Dasar:** Usahakan untuk menjaga pola makan yang teratur dan tidur yang cukup. Meskipun mungkin terasa sulit, kebutuhan dasar ini sangat berpengaruh pada kondisi mental Anda.\n*   **Lakukan Hal Kecil yang Anda Nikmati:** Meskipun minat Anda mungkin menurun, cobalah melakukan satu hal kecil yang dulu Anda sukai setiap hari, misalnya mendengarkan musik, membaca buku, atau menonton film.\n\nIngatlah, pemulihan adalah sebuah proses dan tidak apa-apa untuk tidak merasa baik-baik saja.\n\nApakah ada dari langkah-langkah ini yang ingin Anda diskusikan lebih lanjut? Atau mungkin Anda ingin menceritakan apa yang paling terasa berat bagi Anda saat ini? Saya di sini untuk mendengarkan.', '2025-11-25 11:56:17'),
(5, 5, 'Konsultasi AI', 'User: saya sedang mengalami putus cinta', 'Saya turut prihatin mendengarnya. Putus cinta adalah salah satu pengalaman yang paling sulit dan menyakitkan secara emosional. Sangat wajar jika Anda merasa sedih, kehilangan, marah, atau bahkan kosong saat ini.\n\nBerdasarkan data yang saya miliki, ada beberapa hal yang bisa membantu Anda melewati proses ini. Ingatlah, ini adalah proses dan butuh waktu.\n\n1.  **Izinkan Diri Anda untuk Merasakan Sakit:** Jangan menekan atau menyangkal perasaan Anda. Wajar untuk menangis, merasa marah, atau kecewa. Memberi diri Anda izin untuk berduka adalah langkah pertama menuju penyembuhan.\n2.  **Berikan Jarak:** Jika memungkinkan, cobalah untuk menerapkan aturan \"tanpa kontak\" (no contact) untuk sementara waktu. Ini termasuk tidak menelepon, mengirim pesan, atau memeriksa media sosialnya. Memberi jarak akan membantu Anda mendapatkan kejernihan dan ruang untuk fokus pada diri sendiri.\n3.  **Fokus pada Perawatan Diri (Self-Care):** Di saat seperti ini, sangat mudah untuk melupakan kebutuhan dasar. Cobalah untuk:\n    *   **Makan makanan yang bergizi.**\n    *   **Tidur yang cukup.**\n    *   **Lakukan aktivitas fisik ringan** seperti berjalan kaki, yang bisa membantu melepaskan endorfin dan memperbaiki suasana hati.\n4.  **Terhubung Kembali dengan Diri Sendiri dan Orang Lain:**\n    *   Habiskan waktu dengan teman atau keluarga yang suportif.\n    *   Lakukan kembali hobi yang mungkin sempat Anda tinggalkan, atau coba sesuatu yang baru. Ini membantu Anda membangun kembali identitas di luar hubungan yang telah berakhir.\n5.  **Tuliskan Perasaan Anda:** Menulis jurnal bisa menjadi cara yang sangat baik untuk menuangkan semua pikiran dan perasaan Anda tanpa perlu dihakimi.\n\nProses penyembuhan setiap orang berbeda dan tidak ada jangka waktu yang pasti. Bersabarlah dengan diri Anda sendiri.\n\nApakah ada sesuatu yang spesifik yang ingin Anda bicarakan tentang apa yang Anda rasakan saat ini? Saya di sini untuk mendengarkan.', '2025-11-25 12:02:56'),
(6, 6, 'Konsultasi AI', 'User: saya akhir akhir ini sering mengalami overthinking', 'Sebagai MindCare, AI kesehatan mental, saya memahami bahwa overthinking bisa sangat mengganggu.\n\nBerdasarkan data yang saya miliki, ada beberapa hal yang perlu diperhatikan mengenai pola berpikir berulang atau overthinking:\n\n*   **Penting untuk Mengenali Pola Berpikir:** Dalam dunia konseling, langkah pertama adalah memahami seperti apa pola berpikir berulang yang Anda alami.\n*   **Jenis-jenis Pikiran Berulang:**\n    *   **Pikiran Obsesif:** Contohnya adalah merasa harus menyalakan dan mematikan lampu beberapa kali setiap meninggalkan ruangan, atau mencuci tangan berulang kali karena takut kuman.\n    *   **Mengulang Skenario Terburuk:** Terkadang, overthinking berupa pikiran yang terus-menerus mengulang hal-hal buruk yang mungkin terjadi.\n    *   **Pikiran Kritis Terhadap Diri Sendiri:** Bisa juga berupa pikiran-pikiran kritis yang terus-menerus Anda miliki tentang diri sendiri, yang mungkin memengaruhi rasa percaya diri.\n*   **Bantuan Profesional:** Untuk jenis pikiran yang bersifat obsesif, salah satu bentuk pengobatan yang sangat baik adalah terapi pencegahan paparan dan respons (Exposure and Response Prevention).\n\nMemahami pola spesifik dari overthinking yang Anda alami adalah kunci untuk menemukan cara yang tepat untuk menanganinya.', '2025-11-25 20:06:27'),
(7, 7, 'Konsultasi AI', 'User: saya rindu dengan pasangan saya, saya sekarang lebih sering overthinking dibanding sebelumnya', 'Maaf, saya tidak tahu.', '2025-11-25 20:49:52'),
(8, 8, 'Konsultasi AI', 'User: bagaimana kalau mengatasi overthinking', 'Tentu, saya MindCare, AI kesehatan mental Anda. Berdasarkan data yang saya miliki, respons alami terhadap pikiran yang menakutkan seringkali adalah keinginan untuk berhenti atau menghindarinya, namun cara ini tidak selalu berhasil, terutama jika Anda terjebak dalam siklus kecemasan.\n\nStrategi jangka panjang yang lebih efektif, meskipun lebih sulit, adalah dengan sengaja menghadapi pemikiran yang tidak nyaman tersebut. Berikut beberapa caranya:\n\n1.  **Tuliskan Ketakutan Terburuk Anda:** Coba tulis secara rinci apa ketakutan terburuk yang ada di pikiran Anda, lalu baca tulisan itu berulang kali sampai terasa membosankan.\n2.  **Amati Pikiran Anda:** Luangkan waktu sejenak dalam sehari untuk hanya mengamati semua pikiran yang muncul. Sadari bahwa pikiran hanyalah pikiran, dan tidak sama dengan kenyataan.\n3.  **Hidup Berdampingan dengan Pikiran:** Ketika kita menyadari bahwa kita bisa hidup berdampingan dengan pikiran-pikiran yang tidak menyenangkan, mereka akan menjadi kurang menakutkan.\n\nIntinya adalah menyadari bahwa pikiran tidak selalu sama dengan kenyataan, dan Anda bisa belajar untuk hidup berdampingan dengannya tanpa harus dikuasai olehnya.', '2025-11-25 20:51:40'),
(9, 11, 'Konsultasi AI', 'User: hai', 'Halo! Perkenalkan, saya MindCare, AI kesehatan mental Anda. Saya di sini untuk memberikan informasi dan dukungan seputar kesehatan mental. Ada yang bisa saya bantu hari ini?', '2025-11-28 00:28:23'),
(10, 12, 'Konsultasi AI', 'User: saya sedang mengalami depresi sehingga saya sering menyendiri di kamar dan berikan beberapa solusi untuk mengurangi rasa depresi itu', 'Saya memahami bahwa apa yang Anda alami saat ini pasti sangat berat. Merasa ingin menyendiri saat depresi adalah reaksi yang sangat umum terjadi, namun penting untuk diingat bahwa Anda tidak sendirian dalam hal ini dan ada langkah-langkah yang bisa membantu.\n\nBerdasarkan data yang saya miliki, berikut adalah beberapa solusi yang bisa Anda coba untuk mulai mengurangi rasa depresi tersebut:\n\n1.  **Mencari Bantuan Profesional**: Ini adalah langkah yang paling penting. Berkonsultasi dengan psikolog atau psikiater dapat membantu Anda mendapatkan diagnosis yang tepat dan rencana perawatan yang sesuai, baik itu melalui terapi, obat-obatan, atau kombinasi keduanya. Mengingat depresi adalah kondisi medis, menanganinya dengan bantuan ahli adalah langkah yang paling efektif.\n\n2.  **Memulai dari Langkah Kecil (Baby Steps)**: Karena Anda sering menyendiri di kamar, jangan paksa diri untuk melakukan perubahan besar secara drastis. Mulailah dari hal-hal kecil seperti:\n    *   Membuka jendela kamar agar sinar matahari dan udara segar bisa masuk.\n    *   Duduk di dekat jendela selama beberapa menit setiap hari.\n    *   Keluar dari kamar hanya untuk mengambil minum atau berjalan-jalan sebentar di dalam rumah.\n\n3.  **Terhubung Kembali dengan Orang Lain secara Perlahan**: Isolasi dapat memperburuk depresi. Cobalah untuk terhubung kembali dengan orang yang Anda percaya, meskipun hanya melalui cara-cara sederhana:\n    *   Mengirim pesan singkat ke satu teman atau anggota keluarga untuk sekadar menyapa.\n    *   Menelepon seseorang yang Anda rasa nyaman untuk berbicara, tanpa harus membicarakan masalah Anda jika belum siap.\n\n4.  **Aktivitas Fisik Ringan**: Olahraga terbukti dapat melepaskan endorfin, yaitu zat kimia di otak yang berfungsi sebagai peningkat suasana hati alami. Anda tidak perlu melakukan olahraga berat. Cukup dengan berjalan kaki santai di sekitar rumah selama 10-15 menit setiap hari sudah bisa memberikan dampak positif.\n\n5.  **Perhatikan Asupan Nutrisi dan Tidur**:\n    *   **Makanan**: Usahakan untuk mengonsumsi makanan bergizi seimbang. Hindari makanan olahan berlebih dan perbanyak buah serta sayuran.\n    *   **Pola Tidur**: Cobalah untuk menjaga jadwal tidur yang teratur. Hindari begadang dan usahakan tidur dan bangun pada jam yang sama setiap harinya.\n\nPenting untuk diingat, proses ini membutuhkan waktu dan kesabaran. Tidak apa-apa jika ada hari-hari yang terasa lebih berat dari yang lain. Yang terpenting adalah Anda terus mencoba.\n\nJika Anda merasa pikiran untuk menyakiti diri sendiri muncul, segera hubungi profesional kesehatan mental atau hotline pencegahan bunuh diri yang tersedia di wilayah Anda. Anda sangat berharga, dan bantuan selalu tersedia.', '2025-11-28 00:29:43');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `user_id`, `date_of_birth`, `phone`, `address`, `created_at`, `updated_at`) VALUES
(1, 2, NULL, NULL, NULL, '2025-11-20 02:31:32', '2025-11-20 02:31:32'),
(2, 8, NULL, NULL, '-', '2025-11-25 20:59:05', '2025-11-25 20:59:05');

-- --------------------------------------------------------

--
-- Table structure for table `ratings_reviews`
--

CREATE TABLE `ratings_reviews` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `counselor_id` bigint UNSIGNED DEFAULT NULL,
  `rating` int NOT NULL DEFAULT '5',
  `review` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text,
  `payload` longtext NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('ltPQfi9hSlfwxH9Py34dG5pMhFHF6zQRIobsQrN9', 5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiYldKdzQ4dEFmQmc2Qm5WUW03aUJNQXAxMG1lblJZZnQxalBQRktkNSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9qYWR3YWwiO3M6NToicm91dGUiO3M6MTI6ImphZHdhbC5pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjU7czoxNToiY2hhdF9zZXNzaW9uX2lkIjtzOjI4OiJjaGF0XzY5MjhlY2E0MjdlN2U4LjkyMjc3NDc2Ijt9', 1764290027),
('Tg7puZoKNpwwuCLcg41EQGeAzlAxyarxDBhlfaIl', 11, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoidHJNUDh2cUpHYUFpaHhta24zRVpaN1JMS2NQRWtUUTBlVURXd2M2TSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9qYWR3YWwiO3M6NToicm91dGUiO3M6MTI6ImphZHdhbC5pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjExO3M6MTU6ImNoYXRfc2Vzc2lvbl9pZCI7czoyODoiY2hhdF82OTI2ODI3M2MyYWRjOS44NDUwMTExMSI7fQ==', 1764131472);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('patient','counselor','admin') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'patient',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `full_name`, `email`, `email_verified_at`, `password`, `role`, `is_active`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'konselor_a', 'Dr. Budi Santoso', 'budi@mindcare.com', NULL, '$2y$10$tJ9Y1hR1n2s4f5g6h7i8j.l0k1j2h3g4f5e6d7c8b9a0', 'counselor', 1, NULL, NULL, NULL),
(2, 'pasien_x', 'Ani Wijaya', 'ani@pasien.com', NULL, '$2y$10$tJ9Y1hR1n2s4f5g6h7i8j.l0k1j2h3g4f5e6d7c8b9a0', 'patient', 1, NULL, NULL, NULL),
(5, 'IrhamDF', 'Irham Delta Force', 'momokhitam123@gmail.com', NULL, '$2y$12$/XdQf5YGK4f10O6eqpcgZeWSEWCEVftpoqL0R4Lx6QymjKXO9W4OG', 'patient', 1, NULL, '2025-11-19 20:03:33', '2025-11-19 20:03:33'),
(6, 'admin', 'Super Admin', 'admin@mindcare.com', NULL, '$2y$12$TxfS5wKxiQcroM9.ci16F.fIkrX4Km5.grenXhuUU9/zonX5bRS0m', 'admin', 1, NULL, '2025-11-19 20:17:15', '2025-11-19 20:17:15'),
(7, 'Abu Idris', 'Abu Bakar Idris', 'abu123@gmail.com', NULL, '$2y$12$Eo9Gzhz4qhvG6vV1qJIkB.APHJJ8cL0Q2.KLV6jPoM3.bnBLWoDtK', 'patient', 1, NULL, '2025-11-25 11:02:41', '2025-11-25 11:02:41'),
(8, 'Asyraf', 'Asyraf Pramudya Azhar AB', 'asyraf123@gmail.com', NULL, '$2y$12$o9g6JawXpSYuzTpXo/7QfexKvskEbDgGk8wazjGrfWzfB0A/r4R8K', 'patient', 1, NULL, '2025-11-25 20:59:05', '2025-11-25 20:59:05'),
(10, 'Imperioes', 'Farhat', 'farhatwayne66@gmail.com', NULL, '$2y$12$jOcY8VOiwYqIyhjlLs7kE.kEc/d5Ney82eNpvJrlysVlgGdrtjN9.', 'patient', 1, NULL, '2025-11-26 04:25:07', '2025-11-26 04:30:02'),
(11, 'FatehCrazy', 'Fateh', 'fatehcrazy@gmail.com', NULL, '$2y$12$caaBcTPHOfjisipuffcz5uC5p2Ip0LZ1ba3AQZ913nPT7ddHE9bzK', 'patient', 1, NULL, '2025-11-26 04:30:24', '2025-11-26 04:30:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `counselor_id` (`counselor_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `counseling_sessions`
--
ALTER TABLE `counseling_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medical_records`
--
ALTER TABLE `medical_records`
  ADD PRIMARY KEY (`id`),
  ADD KEY `session_id` (`session_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `patients_user_id_unique` (`user_id`);

--
-- Indexes for table `ratings_reviews`
--
ALTER TABLE `ratings_reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `counseling_sessions`
--
ALTER TABLE `counseling_sessions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `medical_records`
--
ALTER TABLE `medical_records`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ratings_reviews`
--
ALTER TABLE `ratings_reviews`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activities`
--
ALTER TABLE `activities`
  ADD CONSTRAINT `activities_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`counselor_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `counseling_sessions`
--
ALTER TABLE `counseling_sessions`
  ADD CONSTRAINT `counseling_sessions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `medical_records`
--
ALTER TABLE `medical_records`
  ADD CONSTRAINT `medical_records_ibfk_1` FOREIGN KEY (`session_id`) REFERENCES `counseling_sessions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `patients`
--
ALTER TABLE `patients`
  ADD CONSTRAINT `patients_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
