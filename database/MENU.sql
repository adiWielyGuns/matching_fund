-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versi server:                 10.4.21-MariaDB - mariadb.org binary distribution
-- OS Server:                    Win64
-- HeidiSQL Versi:               11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- membuang struktur untuk table revver.s_group_menu
CREATE TABLE IF NOT EXISTS `s_group_menu` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_menu_id` int(11) NOT NULL,
  `sequence` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel revver.s_group_menu: ~11 rows (lebih kurang)
DELETE FROM `s_group_menu`;
/*!40000 ALTER TABLE `s_group_menu` DISABLE KEYS */;
INSERT INTO `s_group_menu` (`id`, `name`, `description`, `slug`, `icon`, `type`, `url`, `title_menu_id`, `sequence`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
	(1, 'Setting', '-', 'setting', 'fas fa-cogs', 'Dropdown', 'setting', 1, 1, 1, 1, 1, NULL, NULL),
	(2, 'Product', '-', 'product', 'fas fa-box', 'Single', 'product', 2, 1, 1, 1, 1, '2022-10-25 12:07:34', '2022-10-25 12:07:39'),
	(3, 'Banner', '-', 'banner', 'fas fa-image', 'Single', 'banner', 2, 2, 1, 1, 1, '2022-11-02 06:20:15', '2022-11-02 06:20:23'),
	(4, 'News', '-', 'news', 'fas fa-newspaper', 'Single', 'news', 2, 3, 1, 1, 1, '2022-11-02 09:57:56', '2022-11-02 09:58:00'),
	(5, 'Event', '-', 'event', 'fas fa-calendar', 'Single', 'event', 2, 4, 1, 1, 1, '2022-11-04 06:41:00', '2022-11-04 06:41:05'),
	(6, 'Member', '-', 'member', 'fas  fa-user', 'Single', 'member', 2, 5, 1, 1, 1, '2022-11-08 06:41:09', '2022-11-08 06:47:18'),
	(7, 'Vital Sign', '-', 'vital-sign', 'fas fa-heartbeat', 'Dropdown', 'vital-sign', 2, 6, 1, 1, 1, '2022-11-13 15:38:01', '2022-11-13 15:40:23'),
	(8, 'E Learning', '-', 'e-learning', 'fas fa-book', 'Single', 'e-learning', 2, 7, 1, 1, 1, '2022-11-15 13:48:32', '2022-11-15 13:51:04'),
	(9, 'Disease', '-', 'disease', 'fas fa-disease', 'Dropdown', 'disease', 2, 8, 1, 1, 1, '2022-11-17 13:44:06', '2022-11-17 13:54:26'),
	(10, 'Order', '-', 'order', 'fas fa-shopping-cart', 'Single', 'order', 2, 9, 1, 1, 1, '2022-11-18 10:51:26', '2022-11-18 13:36:28'),
	(11, 'Staff', '-', 'staff', 'fas fa-users', 'Single', 'staff', 2, 10, 1, 1, 1, '2022-11-20 00:21:20', '2022-11-20 00:22:50');
/*!40000 ALTER TABLE `s_group_menu` ENABLE KEYS */;

-- membuang struktur untuk table revver.s_menu
CREATE TABLE IF NOT EXISTS `s_menu` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `group_menu_id` int(11) NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('MENU','SUB MENU','SINGLE MENU','NON MENU','API') COLLATE utf8mb4_unicode_ci NOT NULL,
  `sequence` int(11) DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel revver.s_menu: ~15 rows (lebih kurang)
DELETE FROM `s_menu`;
/*!40000 ALTER TABLE `s_menu` DISABLE KEYS */;
INSERT INTO `s_menu` (`id`, `name`, `description`, `group_menu_id`, `url`, `type`, `sequence`, `icon`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
	(1, 'Title Menu', '-', 1, 'title-menu', 'MENU', 1, '-', 1, 1, 1, NULL, NULL),
	(2, 'Group Menu', '-', 1, 'group-menu', 'MENU', 2, '-', 1, 1, 1, NULL, NULL),
	(3, 'Menu', '-', 1, 'menu', 'MENU', 3, '-', 1, 1, 1, NULL, NULL),
	(4, 'Hak Akses', '-', 1, 'hak-akses', 'MENU', 4, '-', 1, 1, 1, NULL, NULL),
	(5, 'Product', '-', 2, 'product', 'NON MENU', 1, '-', 1, 1, 1, '2022-10-25 12:07:59', '2022-11-02 06:27:59'),
	(6, 'Role', '-', 1, 'role', 'MENU', NULL, '-', 1, 1, 1, '2022-10-25 12:17:32', '2022-10-25 12:17:32'),
	(7, 'Banner', '-', 3, 'banner', 'NON MENU', 2, 'fas fa-image', 1, 1, 1, '2022-11-02 06:19:44', '2022-11-02 06:27:59'),
	(8, 'News', '-', 4, 'news', 'NON MENU', NULL, '-', 1, 1, 1, '2022-11-02 09:58:14', '2022-11-02 09:58:14'),
	(9, 'Event', '-', 5, 'event', 'NON MENU', NULL, '-', 1, 1, 1, '2022-11-04 06:41:33', '2022-11-04 06:41:33'),
	(10, 'Member', '-', 6, 'member', 'SINGLE MENU', NULL, '-', 1, 1, 1, '2022-11-08 06:41:42', '2022-11-08 06:41:42'),
	(11, 'Stage', '-', 7, 'stage', 'MENU', NULL, '-', 1, 1, 1, '2022-11-13 15:38:26', '2022-11-13 15:38:26'),
	(12, 'Indicator', '-', 7, 'indicator', 'MENU', NULL, '-', 1, 1, 1, '2022-11-13 15:38:45', '2022-11-13 15:38:45'),
	(13, 'E Learning', '-', 8, 'e-learning', 'NON MENU', NULL, '-', 1, 1, 1, '2022-11-15 13:49:03', '2022-11-15 13:49:03'),
	(14, 'List', '-', 9, 'list', 'MENU', NULL, '-', 1, 1, 1, '2022-11-17 13:55:13', '2022-11-17 13:55:13'),
	(15, 'Category', '-', 9, 'category', 'MENU', NULL, '-', 1, 1, 1, '2022-11-17 13:55:37', '2022-11-17 13:55:37'),
	(16, 'Order', '-', 10, 'order', 'NON MENU', NULL, '-', 1, 1, 1, '2022-11-18 13:34:15', '2022-11-18 13:34:15'),
	(17, 'Stagastaff', '-', 11, 'staff', 'NON MENU', NULL, '-', 1, 1, 1, '2022-11-20 00:21:40', '2022-11-20 00:21:40');
/*!40000 ALTER TABLE `s_menu` ENABLE KEYS */;

-- membuang struktur untuk table revver.s_title_menu
CREATE TABLE IF NOT EXISTS `s_title_menu` (
  `id` int(11) NOT NULL,
  `sequence` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel revver.s_title_menu: ~2 rows (lebih kurang)
DELETE FROM `s_title_menu`;
/*!40000 ALTER TABLE `s_title_menu` DISABLE KEYS */;
INSERT INTO `s_title_menu` (`id`, `sequence`, `name`, `description`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
	(1, 5, 'Utility', '-', 1, 1, 1, NULL, '2022-10-25 11:38:55'),
	(2, 1, 'Revver', '-', 1, 1, 1, '2022-10-25 11:40:00', '2022-10-25 12:07:15');
/*!40000 ALTER TABLE `s_title_menu` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
