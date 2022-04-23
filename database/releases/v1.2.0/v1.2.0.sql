
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Table structure for table `charge_categories`
--

DROP TABLE IF EXISTS `charge_categories`;
CREATE TABLE IF NOT EXISTS `charge_categories` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `charge_type` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `charge_categories`
--

INSERT INTO `charge_categories` (`id`, `name`, `description`, `charge_type`, `created_at`, `updated_at`) VALUES
(1, 'Blood pressure check', 'BP', 1, '2020-05-16 00:59:46', '2020-05-16 00:59:46'),
(2, 'Valvular surgery', 'Valvular surgery', 2, '2020-05-16 00:59:46', '2020-05-16 00:59:46');
COMMIT;


--
-- Table structure for table `pathology_categories`
--

DROP TABLE IF EXISTS `pathology_categories`;
CREATE TABLE IF NOT EXISTS `pathology_categories` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pathology_categories_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pathology_categories`
--

INSERT INTO `pathology_categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Clinical Microbiology', '2020-05-16 00:16:34', '2020-05-16 00:16:34'),
(2, 'Clinical Chemistry', '2020-05-16 00:16:34', '2020-05-16 00:16:34'),
(3, 'Hematology', '2020-05-16 00:16:34', '2020-05-16 00:16:34'),
(4, 'Molecular Diagnostics', '2020-05-16 00:16:34', '2020-05-16 00:16:34'),
(5, 'Reproductive Biology', '2020-05-16 00:16:34', '2020-05-16 00:16:34');
COMMIT;

--
-- Table structure for table `radiology_categories`
--

DROP TABLE IF EXISTS `radiology_categories`;
CREATE TABLE IF NOT EXISTS `radiology_categories` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `radiology_categories_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `radiology_categories`
--

INSERT INTO `radiology_categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'X-Ray', '2020-05-16 00:16:34', '2020-05-16 00:16:34'),
(2, 'Sonography', '2020-05-16 00:16:34', '2020-05-16 00:16:34'),
(3, 'CT Scan', '2020-05-16 00:16:34', '2020-05-16 00:16:34'),
(4, 'MRI', '2020-05-16 00:16:34', '2020-05-16 00:16:34'),
(5, 'ECG', '2020-05-16 00:16:34', '2020-05-16 00:16:34');
COMMIT;


--
-- Table structure for table `charges`
--

DROP TABLE IF EXISTS `charges`;
CREATE TABLE IF NOT EXISTS `charges` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `charge_type` int(11) NOT NULL,
  `charge_category_id` int(10) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `standard_charge` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `charges_charge_category_id_foreign` (`charge_category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `charges`
--

INSERT INTO `charges` (`id`, `charge_type`, `charge_category_id`, `code`, `standard_charge`, `description`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'Ang1', '40', NULL, '2020-05-16 00:59:46', '2020-05-16 00:59:46'),
(2, 3, 2, 'oxg1', '20', NULL, '2020-05-16 00:59:46', '2020-05-16 00:59:46');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `charges`
--
ALTER TABLE `charges`
  ADD CONSTRAINT `charges_charge_category_id_foreign` FOREIGN KEY (`charge_category_id`) REFERENCES `charge_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;


--
-- Table structure for table `pathology_tests`
--

DROP TABLE IF EXISTS `pathology_tests`;
CREATE TABLE IF NOT EXISTS `pathology_tests` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `test_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `test_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `unit` int(11) DEFAULT NULL,
  `subcategory` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `report_days` int(11) DEFAULT NULL,
  `charge_category_id` int(10) UNSIGNED NOT NULL,
  `standard_charge` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pathology_tests_category_id_foreign` (`category_id`),
  KEY `pathology_tests_charge_category_id_foreign` (`charge_category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pathology_tests`
--

INSERT INTO `pathology_tests` (`id`, `test_name`, `short_name`, `test_type`, `category_id`, `unit`, `subcategory`, `method`, `report_days`, `charge_category_id`, `standard_charge`, `created_at`, `updated_at`) VALUES
(1, 'Exercise EKG (stress test)', 'EEST', 'EEST', 1, 3, NULL, NULL, 1, 1, 40, '2020-05-16 00:16:34', '2020-05-16 00:16:34'),
(2, 'Lungs X-rays', 'L', 'L', 2, 9, NULL, NULL, 2, 2, 20, '2020-05-16 00:16:34', '2020-05-16 00:16:34');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pathology_tests`
--
ALTER TABLE `pathology_tests`
  ADD CONSTRAINT `pathology_tests_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `pathology_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pathology_tests_charge_category_id_foreign` FOREIGN KEY (`charge_category_id`) REFERENCES `charge_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

-- --------------------------------------------------------

--
-- Table structure for table `radiology_tests`
--

DROP TABLE IF EXISTS `radiology_tests`;
CREATE TABLE IF NOT EXISTS `radiology_tests` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `test_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `test_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `subcategory` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `report_days` int(11) DEFAULT NULL,
  `charge_category_id` int(10) UNSIGNED NOT NULL,
  `standard_charge` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `radiology_tests_category_id_foreign` (`category_id`),
  KEY `radiology_tests_charge_category_id_foreign` (`charge_category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `radiology_tests`
--

INSERT INTO `radiology_tests` (`id`, `test_name`, `short_name`, `test_type`, `category_id`, `subcategory`, `report_days`, `charge_category_id`, `standard_charge`, `created_at`, `updated_at`) VALUES
(1, 'Magnetic Resonance Angiography', 'MRA', 'MRA', 1, NULL, 1, 1, 40, '2020-05-16 00:16:34', '2020-05-16 00:16:34'),
(2, 'Exercise EKG (stress test)', 'EEST', 'EEST', 2, NULL, 2, 2, 20, '2020-05-16 00:16:34', '2020-05-16 00:16:34');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `radiology_tests`
--
ALTER TABLE `radiology_tests`
  ADD CONSTRAINT `radiology_tests_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `radiology_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `radiology_tests_charge_category_id_foreign` FOREIGN KEY (`charge_category_id`) REFERENCES `charge_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;


--
-- Table structure for table `doctor_opd_charges`
--

DROP TABLE IF EXISTS `doctor_opd_charges`;
CREATE TABLE IF NOT EXISTS `doctor_opd_charges` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `doctor_id` bigint(20) UNSIGNED NOT NULL,
  `standard_charge` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `doctor_opd_charges_doctor_id_foreign` (`doctor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `doctor_opd_charges`
--
ALTER TABLE `doctor_opd_charges`
  ADD CONSTRAINT `doctor_opd_charges_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;


--
-- Table structure for table `expenses`
--

DROP TABLE IF EXISTS `expenses`;
CREATE TABLE IF NOT EXISTS `expenses` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `expense_head` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `invoice_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` datetime NOT NULL,
  `amount` double NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
COMMIT;

--
-- Table structure for table `incomes`
--

DROP TABLE IF EXISTS `incomes`;
CREATE TABLE IF NOT EXISTS `incomes` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `income_head` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `invoice_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` datetime NOT NULL,
  `amount` double NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
COMMIT;

ALTER TABLE documents ADD notes text default null ;
