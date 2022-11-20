-- --------------------------------------------------------
-- Host:                         185.237.145.127
-- Versi server:                 10.5.17-MariaDB-cll-lve - MariaDB Server
-- OS Server:                    Linux
-- HeidiSQL Versi:               11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- membuang struktur untuk table u8810989_matching_fund.privileges
CREATE TABLE IF NOT EXISTS `privileges` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `view` tinyint(1) DEFAULT NULL,
  `create` tinyint(1) DEFAULT NULL,
  `edit` tinyint(1) DEFAULT NULL,
  `delete` tinyint(1) DEFAULT NULL,
  `print` tinyint(1) DEFAULT NULL,
  `validation` tinyint(1) DEFAULT NULL,
  `created_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_privileges_roles` (`role_id`),
  KEY `FK_privileges_menus` (`menu_id`),
  CONSTRAINT `FK_privileges_menus` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_privileges_roles` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel u8810989_matching_fund.privileges: ~21 rows (lebih kurang)
DELETE FROM `privileges`;
/*!40000 ALTER TABLE `privileges` DISABLE KEYS */;
INSERT INTO `privileges` (`id`, `role_id`, `menu_id`, `view`, `create`, `edit`, `delete`, `print`, `validation`, `created_by`, `updated_by`, `updated_at`, `created_at`) VALUES
	(1, 1, 4, 1, 1, 1, 1, 1, 1, NULL, 'superuser', '2022-07-14 10:14:13', '2022-07-14 10:05:10'),
	(2, 1, 5, 1, 1, 1, 1, 1, 1, NULL, 'superuser', '2022-07-14 10:14:16', '2022-07-14 10:14:11'),
	(3, 1, 6, 1, 1, 1, 1, 1, 1, NULL, 'superuser', '2022-07-14 10:14:16', '2022-07-14 10:14:11'),
	(4, 2, 5, 1, 1, 1, 1, 1, 1, NULL, 'superuser', '2022-11-20 11:43:44', '2022-07-14 10:15:37'),
	(5, 2, 6, 1, 1, 1, 1, 1, 1, NULL, 'superuser', '2022-11-20 11:43:45', '2022-07-14 10:15:37'),
	(6, 2, 4, 1, 1, 1, 1, 1, 1, NULL, 'superuser', '2022-07-14 10:15:53', '2022-07-14 10:15:49'),
	(7, 2, 9, 1, 1, 1, 1, 1, 1, NULL, 'superuser', '2022-11-20 11:43:07', '2022-11-20 11:43:02'),
	(8, 2, 10, 1, 1, 1, 1, 1, 1, NULL, 'superuser', '2022-11-20 11:43:07', '2022-11-20 11:43:02'),
	(9, 2, 11, 1, 1, 1, 1, 1, 1, NULL, 'superuser', '2022-11-20 11:43:07', '2022-11-20 11:43:02'),
	(10, 2, 12, 1, 1, 1, 1, 1, 1, NULL, 'superuser', '2022-11-20 11:43:07', '2022-11-20 11:43:02'),
	(11, 2, 13, 1, 1, 1, 1, 1, 1, NULL, 'superuser', '2022-11-20 11:43:07', '2022-11-20 11:43:02'),
	(12, 2, 18, 1, 1, 1, 1, 1, 1, NULL, 'superuser', '2022-11-20 11:43:15', '2022-11-20 11:43:11'),
	(13, 2, 19, 1, 1, 1, 1, 1, 1, NULL, 'superuser', '2022-11-20 11:43:23', '2022-11-20 11:43:18'),
	(14, 2, 20, 1, 1, 1, 1, 1, 1, NULL, 'superuser', '2022-11-20 11:43:29', '2022-11-20 11:43:25'),
	(15, 2, 7, 1, 1, 1, 1, 1, 1, NULL, 'superuser', '2022-11-20 11:43:41', '2022-11-20 11:43:34'),
	(16, 2, 8, 1, 1, 1, 1, 1, 1, NULL, 'superuser', '2022-11-20 11:43:41', '2022-11-20 11:43:34'),
	(17, 2, 15, 1, 1, 1, 1, 1, 1, NULL, 'superuser', '2022-11-20 11:43:41', '2022-11-20 11:43:34'),
	(18, 2, 16, 1, 1, 1, 1, 1, 1, NULL, 'superuser', '2022-11-20 11:43:41', '2022-11-20 11:43:34'),
	(19, 2, 17, 1, 1, 1, 1, 1, 1, NULL, 'superuser', '2022-11-20 11:43:51', '2022-11-20 11:43:47'),
	(20, 2, 14, 1, 1, 1, 1, 1, 1, NULL, 'superuser', '2022-11-20 11:43:56', '2022-11-20 11:43:53'),
	(21, 2, 21, 1, 1, 1, 1, 1, 1, NULL, 'superuser', '2022-11-20 11:44:05', '2022-11-20 11:44:00');
/*!40000 ALTER TABLE `privileges` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
