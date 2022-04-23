-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Feb 12, 2022 at 05:33 AM
-- Server version: 5.7.32
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lara_builder`
--

-- --------------------------------------------------------

--
-- Table structure for table `accountants`
--

CREATE TABLE `accountants` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `tenant_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` tinyint(4) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `tenant_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `owner_id` int(11) DEFAULT NULL,
  `owner_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tenant_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin_testimonials`
--

CREATE TABLE `admin_testimonials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_testimonials`
--

INSERT INTO `admin_testimonials` (`id`, `name`, `position`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Jasse Lynn', 'Founder of Sassaht', 'Eeque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur,\n                                            adipisci velit, sed quia non numquam eius modi tempora incidunt contact\n                                            me.', '2022-02-11 23:58:15', '2022-02-11 23:58:15'),
(2, 'Thomas James', 'CEO of Sassaht', 'Reasonable porro quisquam est, qui dolorem ipsum quia dolor sit amet,\n                                            consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt\n                                            looks.', '2022-02-11 23:58:15', '2022-02-11 23:58:15'),
(3, 'Ceathy White', 'Founder of Sassaht', 'On the other hand, we denounce with righteous indignation and dislike men who\n                                            are so beguiled and demoralized by the charms of pleasure of the momen\n                                            words.', '2022-02-11 23:58:15', '2022-02-11 23:58:15');

-- --------------------------------------------------------

--
-- Table structure for table `advanced_payments`
--

CREATE TABLE `advanced_payments` (
  `id` int(10) UNSIGNED NOT NULL,
  `patient_id` bigint(20) UNSIGNED NOT NULL,
  `receipt_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double NOT NULL,
  `date` date NOT NULL,
  `tenant_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ambulances`
--

CREATE TABLE `ambulances` (
  `id` int(10) UNSIGNED NOT NULL,
  `vehicle_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vehicle_model` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year_made` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `driver_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `driver_license` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `driver_contact` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `is_available` tinyint(1) NOT NULL DEFAULT '1',
  `vehicle_type` int(11) NOT NULL DEFAULT '1',
  `tenant_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ambulance_calls`
--

CREATE TABLE `ambulance_calls` (
  `id` int(10) UNSIGNED NOT NULL,
  `patient_id` int(10) UNSIGNED NOT NULL,
  `ambulance_id` int(10) UNSIGNED NOT NULL,
  `driver_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `amount` double(8,2) NOT NULL,
  `tenant_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `patient_id` int(10) UNSIGNED NOT NULL,
  `doctor_id` bigint(20) UNSIGNED NOT NULL,
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `opd_date` datetime NOT NULL,
  `problem` text COLLATE utf8mb4_unicode_ci,
  `is_completed` tinyint(1) NOT NULL DEFAULT '0',
  `tenant_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `beds`
--

CREATE TABLE `beds` (
  `id` int(10) UNSIGNED NOT NULL,
  `bed_type` int(10) UNSIGNED NOT NULL,
  `bed_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `charge` int(11) NOT NULL,
  `is_available` tinyint(1) NOT NULL DEFAULT '1',
  `tenant_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bed_assigns`
--

CREATE TABLE `bed_assigns` (
  `id` int(10) UNSIGNED NOT NULL,
  `bed_id` int(10) UNSIGNED NOT NULL,
  `ipd_patient_department_id` int(10) UNSIGNED DEFAULT NULL,
  `patient_id` int(10) UNSIGNED NOT NULL,
  `case_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `assign_date` datetime NOT NULL,
  `discharge_date` datetime DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `tenant_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bed_types`
--

CREATE TABLE `bed_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `tenant_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE `bills` (
  `id` int(10) UNSIGNED NOT NULL,
  `bill_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `patient_id` int(10) UNSIGNED NOT NULL,
  `bill_date` datetime NOT NULL,
  `amount` decimal(16,2) DEFAULT NULL,
  `tenant_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `patient_admission_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bill_items`
--

CREATE TABLE `bill_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `item_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bill_id` int(10) UNSIGNED NOT NULL,
  `qty` int(10) UNSIGNED NOT NULL,
  `price` double(8,2) NOT NULL,
  `amount` decimal(16,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `birth_reports`
--

CREATE TABLE `birth_reports` (
  `id` int(10) UNSIGNED NOT NULL,
  `patient_id` int(10) UNSIGNED NOT NULL,
  `case_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `doctor_id` bigint(20) UNSIGNED NOT NULL,
  `date` datetime NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `tenant_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blood_banks`
--

CREATE TABLE `blood_banks` (
  `id` int(10) UNSIGNED NOT NULL,
  `blood_group` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remained_bags` bigint(20) NOT NULL,
  `tenant_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blood_donations`
--

CREATE TABLE `blood_donations` (
  `id` int(10) UNSIGNED NOT NULL,
  `blood_donor_id` int(10) UNSIGNED NOT NULL,
  `bags` int(11) NOT NULL DEFAULT '1',
  `tenant_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blood_donors`
--

CREATE TABLE `blood_donors` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `age` int(11) NOT NULL,
  `gender` int(11) NOT NULL,
  `blood_group` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_donate_date` datetime NOT NULL,
  `tenant_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blood_issues`
--

CREATE TABLE `blood_issues` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `issue_date` datetime NOT NULL,
  `doctor_id` bigint(20) UNSIGNED NOT NULL,
  `donor_id` int(10) UNSIGNED NOT NULL,
  `patient_id` int(10) UNSIGNED NOT NULL,
  `amount` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci,
  `tenant_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tenant_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `call_logs`
--

CREATE TABLE `call_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `follow_up_date` date DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `call_type` int(11) NOT NULL,
  `tenant_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `case_handlers`
--

CREATE TABLE `case_handlers` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `tenant_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `tenant_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `charges`
--

CREATE TABLE `charges` (
  `id` int(10) UNSIGNED NOT NULL,
  `charge_type` int(11) NOT NULL,
  `charge_category_id` int(10) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `standard_charge` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `tenant_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `charge_categories`
--

CREATE TABLE `charge_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `charge_type` int(11) NOT NULL,
  `tenant_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `death_reports`
--

CREATE TABLE `death_reports` (
  `id` int(10) UNSIGNED NOT NULL,
  `patient_id` int(10) UNSIGNED NOT NULL,
  `case_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `doctor_id` bigint(20) UNSIGNED NOT NULL,
  `date` datetime NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `tenant_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `is_active`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 1, 'web', '2022-02-11 23:58:13', '2022-02-11 23:58:13'),
(2, 'Doctor', 1, 'web', '2022-02-11 23:58:13', '2022-02-11 23:58:13'),
(3, 'Patient', 1, 'web', '2022-02-11 23:58:13', '2022-02-11 23:58:13'),
(4, 'Nurse', 1, 'web', '2022-02-11 23:58:13', '2022-02-11 23:58:13'),
(5, 'Receptionist', 1, 'web', '2022-02-11 23:58:13', '2022-02-11 23:58:13'),
(6, 'Pharmacist', 1, 'web', '2022-02-11 23:58:13', '2022-02-11 23:58:13'),
(7, 'Accountant', 1, 'web', '2022-02-11 23:58:13', '2022-02-11 23:58:13'),
(8, 'Case Manager', 1, 'web', '2022-02-11 23:58:13', '2022-02-11 23:58:13'),
(9, 'Lab Technician', 1, 'web', '2022-02-11 23:58:13', '2022-02-11 23:58:13'),
(10, 'Super Admin', 1, 'web', '2022-02-11 23:58:13', '2022-02-11 23:58:13');

-- --------------------------------------------------------

--
-- Table structure for table `diagnosis_categories`
--

CREATE TABLE `diagnosis_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `tenant_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `doctor_department_id` bigint(20) UNSIGNED NOT NULL,
  `specialist` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tenant_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doctor_departments`
--

CREATE TABLE `doctor_departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `tenant_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doctor_opd_charges`
--

CREATE TABLE `doctor_opd_charges` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `doctor_id` bigint(20) UNSIGNED NOT NULL,
  `standard_charge` double NOT NULL,
  `tenant_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `document_type_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `uploaded_by` bigint(20) UNSIGNED NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `tenant_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `document_types`
--

CREATE TABLE `document_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tenant_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `domains`
--

CREATE TABLE `domains` (
  `id` int(10) UNSIGNED NOT NULL,
  `domain` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tenant_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee_payrolls`
--

CREATE TABLE `employee_payrolls` (
  `id` int(10) UNSIGNED NOT NULL,
  `sr_no` bigint(20) NOT NULL,
  `payroll_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `owner_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `month` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` int(11) NOT NULL,
  `net_salary` double NOT NULL,
  `status` int(11) NOT NULL,
  `basic_salary` double NOT NULL,
  `allowance` double NOT NULL,
  `deductions` double NOT NULL,
  `tenant_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `enquiries`
--

CREATE TABLE `enquiries` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` tinyint(4) DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `viewed_by` bigint(20) UNSIGNED DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `tenant_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `expense_head` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `invoice_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` datetime NOT NULL,
  `amount` double NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `tenant_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `question`, `answer`, `created_at`, `updated_at`) VALUES
(1, 'Is My Electronic Health Record Kept Private?', 'Health records are kept totally private and we employ robust encryption methods to protect your personal information. You determine who can see the information in your record.', '2022-02-11 23:58:15', '2022-02-11 23:58:15'),
(2, 'Can Doctor 24x7 Handle My Emergency Situations?', 'Doctor 24×7 is designed to handle non-emergent medical problems. You should NOT use it if you are experiencing a medical emergency.', '2022-02-11 23:58:15', '2022-02-11 23:58:15'),
(3, 'Can I Call Doctor 24x7 Outside Of India?', 'Doctor 24×7 consults are unavailable outside of India. However, if you are travelling outside India, you can use our service from a mobile phone using a SIM card issued in India.', '2022-02-11 23:58:15', '2022-02-11 23:58:15'),
(4, 'Is my electronic health record kept private?', 'Health records are kept totally private and we employ robust encryption methods to protect your personal information. You determine who can see the information in your record.', '2022-02-11 23:58:15', '2022-02-11 23:58:15'),
(5, 'How much does a consult cost?', 'The cost of a Doctor consult varies, depending on your choice of consulting the 1st available Doctor OR requesting a call back from a specific Doctor.', '2022-02-11 23:58:15', '2022-02-11 23:58:15'),
(6, 'Do I Talk to \"real doctors\"?', 'Yes. Doctor 24×7 subscribers only talk to reputed Doctors/Experts attached with top hospitals/private practice who are Licensed practitioners. Each Doctor/Expert on our network is qualified.', '2022-02-11 23:58:15', '2022-02-11 23:58:15');

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `submenu` int(11) DEFAULT '0',
  `route` longtext COLLATE utf8mb4_unicode_ci,
  `has_parent` int(11) DEFAULT '0',
  `is_default` int(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `features`
--

INSERT INTO `features` (`id`, `name`, `submenu`, `route`, `has_parent`, `is_default`, `created_at`, `updated_at`) VALUES
(1, 'Appointments', 0, '{\"route_name\":[\"appointments.index\",\"appointments.create\",\"appointments.store\",\"doctors.list\",\"doctor-schedule-list\",\"get.booking.slot\",\"patient.appointment.update\",\"appointments.show\",\"appointments.destroy\",\"appointments.excel\",\"appointment.status\"]}', 0, 0, '2022-02-11 23:58:15', '2022-02-11 23:58:15'),
(2, 'Appointment Calendar', 0, '{\"route_name\":[\"appointment-calendars.index\",\"calendar-list\",\"appointment.details\"]}', 1, 0, '2022-02-11 23:58:15', '2022-02-11 23:58:15'),
(3, 'Blood Banks', 4, '{\"route_name\":[\"blood-banks.index\",\"blood-banks.create\",\"blood-banks.store\",\"blood-banks.edit\",\"blood-banks.update\",\"blood-banks.destroy\",\"blood.banks.excel\"]}', 0, 0, '2022-02-11 23:58:15', '2022-02-11 23:58:15'),
(4, 'Blood Donors', 0, '{\"route_name\":[\"blood-donors.index\",\"blood-donors.create\",\"blood-donors.store\",\"blood-donors.edit\",\"blood-donors.update\",\"blood-donors.destroy\",\"blood.donors.excel\"]}', 3, 0, '2022-02-11 23:58:15', '2022-02-11 23:58:15'),
(5, 'Blood Donations', 0, '{\"route_name\":[\"blood-donations.index\",\"blood-donations.create\",\"blood-donations.store\",\"blood-donations.edit\",\"blood-donations.update\",\"blood-donations.destroy\",\"blood.donations.excel\"]}', 3, 0, '2022-02-11 23:58:15', '2022-02-11 23:58:15'),
(6, 'Blood Issues', 0, '{\"route_name\":[\"blood-issues.index\",\"blood-issues.create\",\"blood-issues.store\",\"blood-issues.edit\",\"blood-issues.update\",\"blood-issues.destroy\",\"blood-issues.list\",\"blood.issues.excel\"]}', 3, 0, '2022-02-11 23:58:15', '2022-02-11 23:58:15'),
(7, 'Documents', 2, '{\"route_name\":[\"documents.index\",\"documents.create\",\"documents.store\",\"documents.edit\",\"documents.update\",\"documents.destroy\",\"document.download\"]}', 0, 0, '2022-02-11 23:58:15', '2022-02-11 23:58:15'),
(8, 'Document Types', 0, '{\"route_name\":[\"document-types.index\",\"document-types.create\",\"document-types.store\",\"document-types.edit\",\"document-types.show\",\"document-types.update\",\"document-types.destroy\"]}', 7, 0, '2022-02-11 23:58:15', '2022-02-11 23:58:15'),
(9, 'Live Consultations', 2, '{\"route_name\":[\"live.consultation.index\",\"live.consultation.create\",\"live.consultation.store\",\"live.consultation.edit\",\"live.consultation.show\",\"live.consultation.update\",\"live.consultation.destroy\",\"live.consultation.list\",\"live.consultation.change.status\",\"live.consultation.get.live.status\"]}', 0, 0, '2022-02-11 23:58:15', '2022-02-11 23:58:15'),
(10, 'Live Meetings', 0, '{\"route_name\":[\"live.meeting.index\",\"live.meeting.store\",\"live.meeting.change.status\",\"live.meeting.get.live.status\",\"live.meeting.show\",\"live.meeting.edit\",\"live.meeting.update\",\"live.meeting.destroy\"]}', 9, 0, '2022-02-11 23:58:15', '2022-02-11 23:58:15'),
(11, 'Inventory', 4, '{\"route_name\":[\"item-categories.index\",\"item-categories.store\",\"item-categories.edit\",\"item-categories.update\",\"item-categories.destroy\"]}', 0, 0, '2022-02-11 23:58:15', '2022-02-11 23:58:15'),
(12, 'Items', 0, '{\"route_name\":[\"items.index\",\"items.create\",\"items.store\",\"items.edit\",\"items.show\",\"items.update\",\"items.destroy\"]}', 11, 0, '2022-02-11 23:58:15', '2022-02-11 23:58:15'),
(13, 'Item Stocks', 0, '{\"route_name\":[\"item.stock.index\",\"item.stock.create\",\"item.stock.store\",\"item.stock.edit\",\"item.stock.show\",\"item.stock.update\",\"item.stock.destroy\",\"item.stock.download\",\"items.list\"]}', 11, 0, '2022-02-11 23:58:15', '2022-02-11 23:58:15'),
(14, 'Issued Items', 0, '{\"route_name\":[\"issued.item.index\",\"issued.item.create\",\"users.list\",\"item.available.qty\",\"return.issued.item\",\"issued.item.store\",\"issued.item.show\",\"issued.item.destroy\"]}', 11, 0, '2022-02-11 23:58:15', '2022-02-11 23:58:15'),
(15, 'Vaccinations', 2, '{\"route_name\":[\"vaccinated-patients.index\",\"vaccinated-patients.create\",\"vaccinated-patients.store\",\"vaccinated-patients.edit\",\"vaccinated-patients.show\",\"vaccinated-patients.update\",\"vaccinated-patients.destroy\",\"vaccinated-patients.excel\"]}', 0, 0, '2022-02-11 23:58:15', '2022-02-11 23:58:15'),
(16, 'Vaccination', 0, '{\"route_name\":[\"vaccinations.index\",\"vaccinations.create\",\"vaccinations.store\",\"vaccinations.edit\",\"vaccinations.show\",\"vaccinations.update\",\"vaccinations.destroy\",\"vaccinations.excel\"]}', 15, 0, '2022-02-11 23:58:15', '2022-02-11 23:58:15'),
(17, 'SMS / Mail', 2, '{\"route_name\":[\"sms.index\",\"sms.store\",\"sms.show\",\"sms.show.modal\",\"sms.destroy\",\"sms.users.lists\"]}', 0, 0, '2022-02-11 23:58:15', '2022-02-11 23:58:15'),
(18, 'Mail', 0, '{\"route_name\":[\"mail\",\"mail.send\"]}', 17, 0, '2022-02-11 23:58:15', '2022-02-11 23:58:15'),
(19, 'Radiology', 2, '{\"route_name\":[\"radiology.category.index\",\"radiology.category.create\",\"radiology.category.store\",\"radiology.category.edit\",\"radiology.category.update\",\"radiology.category.destroy\"]}', 0, 0, '2022-02-11 23:58:15', '2022-02-11 23:58:15'),
(20, 'Radiology Tests', 0, '{\"route_name\":[\"radiology.test.index\",\"radiology.test.create\",\"radiology.test.store\",\"radiology.test.edit\",\"radiology.test.show\",\"radiology.test.show.modal\",\"radiology.test.update\",\"radiology.test.destroy\",\"radiology.test.standard.charge\",\"radiology.tests.excel\"]}', 19, 0, '2022-02-11 23:58:15', '2022-02-11 23:58:15'),
(21, 'Reports', 4, '{\"route_name\":[\"birth-reports.index\",\"birth-reports.create\",\"birth-reports.store\",\"birth-reports.edit\",\"birth-reports.show\",\"birth-reports.update\",\"birth-reports.destroy\"]}', 0, 0, '2022-02-11 23:58:15', '2022-02-11 23:58:15'),
(22, 'Death Reports', 0, '{\"route_name\":[\"death-reports.index\",\"death-reports.create\",\"death-reports.store\",\"death-reports.edit\",\"death-reports.show\",\"death-reports.update\",\"death-reports.destroy\"]}', 21, 0, '2022-02-11 23:58:15', '2022-02-11 23:58:15'),
(23, 'Investigation Reports', 0, '{\"route_name\":[\"investigation-reports.index\",\"investigation-reports.create\",\"investigation-reports.store\",\"investigation-reports.edit\",\"investigation-reports.show\",\"investigation-reports.update\",\"investigation-reports.destroy\",\"investigation.reports.download\"]}', 21, 0, '2022-02-11 23:58:15', '2022-02-11 23:58:15'),
(24, 'Operation Reports', 0, '{\"route_name\":[\"operation-reports.index\",\"operation-reports.create\",\"operation-reports.store\",\"operation-reports.edit\",\"operation-reports.show\",\"operation-reports.update\",\"operation-reports.destroy\"]}', 21, 0, '2022-02-11 23:58:15', '2022-02-11 23:58:15'),
(25, 'Pathology', 2, '{\"route_name\":[\"pathology.category.index\",\"pathology.category.create\",\"pathology.category.store\",\"pathology.category.edit\",\"pathology.category.show\",\"pathology.category.update\",\"pathology.category.destroy\"]}', 0, 0, '2022-02-11 23:58:15', '2022-02-11 23:58:15'),
(26, 'Pathology Tests', 0, '{\"route_name\":[\"pathology.test.index\",\"pathology.test.create\",\"pathology.test.store\",\"pathology.test.edit\",\"pathology.test.show\",\"pathology.test.show.modal\",\"pathology.test.update\",\"pathology.test.destroy\",\"pathology.test.standard.charge\",\"pathology.tests.excel\"]}', 25, 0, '2022-02-11 23:58:15', '2022-02-11 23:58:15');

-- --------------------------------------------------------

--
-- Table structure for table `feature_subscriptionplan`
--

CREATE TABLE `feature_subscriptionplan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `feature_id` bigint(20) UNSIGNED NOT NULL,
  `subscription_plan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `feature_subscriptionplan`
--

INSERT INTO `feature_subscriptionplan` (`id`, `feature_id`, `subscription_plan_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2022-02-11 23:58:15', '2022-02-11 23:58:15'),
(2, 3, 1, '2022-02-11 23:58:15', '2022-02-11 23:58:15'),
(3, 7, 1, '2022-02-11 23:58:15', '2022-02-11 23:58:15'),
(4, 9, 1, '2022-02-11 23:58:15', '2022-02-11 23:58:15'),
(5, 11, 1, '2022-02-11 23:58:15', '2022-02-11 23:58:15'),
(6, 15, 1, '2022-02-11 23:58:15', '2022-02-11 23:58:15'),
(7, 17, 1, '2022-02-11 23:58:15', '2022-02-11 23:58:15'),
(8, 19, 1, '2022-02-11 23:58:15', '2022-02-11 23:58:15'),
(9, 21, 1, '2022-02-11 23:58:15', '2022-02-11 23:58:15'),
(10, 25, 1, '2022-02-11 23:58:15', '2022-02-11 23:58:15');

-- --------------------------------------------------------

--
-- Table structure for table `front_services`
--

CREATE TABLE `front_services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tenant_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `front_services`
--

INSERT INTO `front_services` (`id`, `name`, `short_description`, `tenant_id`, `created_at`, `updated_at`) VALUES
(1, 'Cardiology', 'image Cardiology Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor.', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(2, 'Orthopedics', 'image Cardiology Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor.', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(3, 'Pulmonology', 'image Cardiology Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor.', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(4, 'Dental Care', 'image Cardiology Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor.', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(5, 'Medicine', 'image Cardiology Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor.', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(6, 'Ambulance', 'image Cardiology Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor.', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(7, 'Ophthalmology', 'image Cardiology Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor.', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(8, 'Neurology', 'image Cardiology Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor.', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14');

-- --------------------------------------------------------

--
-- Table structure for table `front_settings`
--

CREATE TABLE `front_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tenant_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `front_settings`
--

INSERT INTO `front_settings` (`id`, `key`, `value`, `type`, `tenant_id`, `created_at`, `updated_at`) VALUES
(1, 'about_us_title', 'About For HMS', '1', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(2, 'about_us_description', 'HMS will teach physicians and nurses from around the world the principles of blood management, as well as how to manage their own blood conservation programs. The hospital was chosen based on the reputation its bloodless program has established in the medical community and because of its nationally recognized results.\n\nWe are a group of creative nerds making awesome stuff for Web and Mobile. We just love to contribute to open source technologies. We always try to build something which helps developers to save their time. so they can spend a bit more time with their friends And family.', '1', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(3, 'about_us_mission', 'We are providing advanced emergency services. We have well-equipped emergency and trauma center with facilities.', '1', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(4, 'about_us_image', 'http://127.0.0.1:8000/assets/img/default_image.jpg', '1', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(5, 'home_page_experience', '10', '2', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(6, 'home_page_title', 'Find Local Specialists Best Services', '2', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(7, 'home_page_description', 'Our medical clinic provides quality care for the entire family while maintaining a personable atmosphere best services.', '2', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(8, 'home_page_image', 'http://127.0.0.1:8000/web_front/images/main-banner/banner-one/woman-doctor.png', '2', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(9, 'home_page_certified_doctor_image', 'http://127.0.0.1:8000/web_front/images/main-banner/banner-one/woman-doctor.png', '2', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(10, 'terms_conditions', 'terms_conditions', '2', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(11, 'privacy_policy', 'privacy_policy', '2', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(12, 'home_page_certified_doctor_image', 'http://127.0.0.1:8000/web_front/images/healthcare-doctor/doctor-1.png', '2', NULL, '2022-02-11 23:58:15', '2022-02-11 23:58:15'),
(13, 'home_page_certified_doctor_text', 'Quality Healthcare', '2', NULL, '2022-02-11 23:58:15', '2022-02-11 23:58:15'),
(14, 'home_page_certified_doctor_title', 'Have Certified and High Quality Doctor For You', '2', NULL, '2022-02-11 23:58:15', '2022-02-11 23:58:15'),
(15, 'home_page_certified_doctor_description', 'Our medical clinic provides quality care for the entire family while maintaining a personable atmosphere best services. Our medical clinic provides quality. Our medical clinic provides quality care for the entire family while maintaining lizam a personable atmosphere best services. Our medical clinic provides.', '2', NULL, '2022-02-11 23:58:15', '2022-02-11 23:58:15'),
(16, 'home_page_box_title', 'Free Consulting', '2', NULL, '2022-02-11 23:58:15', '2022-02-11 23:58:15'),
(17, 'home_page_box_description', 'Proin gravida nibh vel velit auctor aliquet.', '2', NULL, '2022-02-11 23:58:15', '2022-02-11 23:58:15'),
(18, 'home_page_step_1_title', 'Check Doctor Profile', '2', NULL, '2022-02-11 23:58:15', '2022-02-11 23:58:15'),
(19, 'home_page_step_1_description', 'Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin lorem quis bibendum auctor nisi elit.', '2', NULL, '2022-02-11 23:58:15', '2022-02-11 23:58:15'),
(20, 'home_page_step_2_title', 'Request Consulting', '2', NULL, '2022-02-11 23:58:15', '2022-02-11 23:58:15'),
(21, 'home_page_step_2_description', 'Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin lorem quis bibendum auctor nisi elit.', '2', NULL, '2022-02-11 23:58:15', '2022-02-11 23:58:15'),
(22, 'home_page_step_3_title', 'Receive Consulting', '2', NULL, '2022-02-11 23:58:15', '2022-02-11 23:58:15'),
(23, 'home_page_step_3_description', 'Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin lorem quis bibendum auctor nisi elit.', '2', NULL, '2022-02-11 23:58:15', '2022-02-11 23:58:15'),
(24, 'home_page_step_4_title', 'Get Your Solution', '2', NULL, '2022-02-11 23:58:15', '2022-02-11 23:58:15'),
(25, 'home_page_step_4_description', 'Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin lorem quis bibendum auctor nisi elit.', '2', NULL, '2022-02-11 23:58:15', '2022-02-11 23:58:15'),
(26, 'home_page_certified_box_title', 'Certified Doctor', '2', NULL, '2022-02-11 23:58:15', '2022-02-11 23:58:15'),
(27, 'home_page_certified_box_description', 'Proin gravida nibh vel velit auctor aliquet.', '2', NULL, '2022-02-11 23:58:15', '2022-02-11 23:58:15'),
(28, 'appointment_title', 'Contact Now and Get the Best Doctor Service Today', '3', NULL, '2022-02-11 23:58:15', '2022-02-11 23:58:15'),
(29, 'appointment_description', 'Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin lorem quis bibendum auctor nisi elit consequat ipsum nec sagittis.', '3', NULL, '2022-02-11 23:58:15', '2022-02-11 23:58:15');

-- --------------------------------------------------------

--
-- Table structure for table `hospital_schedules`
--

CREATE TABLE `hospital_schedules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `day_of_week` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_time` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `end_time` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tenant_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `incomes`
--

CREATE TABLE `incomes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `income_head` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `invoice_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` datetime NOT NULL,
  `amount` double NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `tenant_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `insurances`
--

CREATE TABLE `insurances` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_tax` double NOT NULL,
  `discount` double DEFAULT NULL,
  `remark` text COLLATE utf8mb4_unicode_ci,
  `insurance_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `insurance_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hospital_rate` double NOT NULL,
  `total` double NOT NULL,
  `status` tinyint(1) NOT NULL,
  `tenant_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `insurance_diseases`
--

CREATE TABLE `insurance_diseases` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `insurance_id` int(10) UNSIGNED NOT NULL,
  `disease_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `disease_charge` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `investigation_reports`
--

CREATE TABLE `investigation_reports` (
  `id` int(10) UNSIGNED NOT NULL,
  `patient_id` int(10) UNSIGNED NOT NULL,
  `date` datetime NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `doctor_id` bigint(20) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL,
  `tenant_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int(10) UNSIGNED NOT NULL,
  `invoice_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `patient_id` int(10) UNSIGNED NOT NULL,
  `invoice_date` date NOT NULL,
  `amount` double(8,2) NOT NULL DEFAULT '0.00',
  `discount` double(8,2) NOT NULL DEFAULT '0.00',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `tenant_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_items`
--

CREATE TABLE `invoice_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `account_id` int(10) UNSIGNED NOT NULL,
  `invoice_id` int(10) UNSIGNED NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `quantity` int(11) NOT NULL,
  `price` double(8,2) NOT NULL,
  `total` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ipd_bills`
--

CREATE TABLE `ipd_bills` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ipd_patient_department_id` int(10) UNSIGNED NOT NULL,
  `total_charges` int(11) NOT NULL,
  `total_payments` int(11) NOT NULL,
  `gross_total` int(11) NOT NULL,
  `discount_in_percentage` int(11) NOT NULL,
  `tax_in_percentage` int(11) NOT NULL,
  `other_charges` int(11) NOT NULL,
  `net_payable_amount` int(11) NOT NULL,
  `tenant_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ipd_charges`
--

CREATE TABLE `ipd_charges` (
  `id` int(10) UNSIGNED NOT NULL,
  `ipd_patient_department_id` int(10) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `charge_type_id` int(11) NOT NULL,
  `charge_category_id` int(10) UNSIGNED NOT NULL,
  `charge_id` int(10) UNSIGNED NOT NULL,
  `standard_charge` int(11) DEFAULT NULL,
  `applied_charge` int(11) NOT NULL,
  `tenant_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ipd_consultant_registers`
--

CREATE TABLE `ipd_consultant_registers` (
  `id` int(10) UNSIGNED NOT NULL,
  `ipd_patient_department_id` int(10) UNSIGNED NOT NULL,
  `applied_date` datetime NOT NULL,
  `doctor_id` bigint(20) UNSIGNED NOT NULL,
  `instruction` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `instruction_date` date NOT NULL,
  `tenant_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ipd_diagnoses`
--

CREATE TABLE `ipd_diagnoses` (
  `id` int(10) UNSIGNED NOT NULL,
  `ipd_patient_department_id` int(10) UNSIGNED NOT NULL,
  `report_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `report_date` datetime NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `tenant_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ipd_patient_departments`
--

CREATE TABLE `ipd_patient_departments` (
  `id` int(10) UNSIGNED NOT NULL,
  `patient_id` int(10) UNSIGNED NOT NULL,
  `ipd_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `height` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `weight` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bp` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `symptoms` text COLLATE utf8mb4_unicode_ci,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `admission_date` datetime NOT NULL,
  `case_id` int(10) UNSIGNED NOT NULL,
  `is_old_patient` tinyint(1) DEFAULT '0',
  `doctor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `bed_type_id` int(10) UNSIGNED DEFAULT NULL,
  `bed_id` int(10) UNSIGNED NOT NULL,
  `tenant_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `bill_status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ipd_payments`
--

CREATE TABLE `ipd_payments` (
  `id` int(10) UNSIGNED NOT NULL,
  `ipd_patient_department_id` int(10) UNSIGNED NOT NULL,
  `amount` int(11) NOT NULL,
  `date` date NOT NULL,
  `payment_mode` tinyint(4) NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `transaction_id` int(11) DEFAULT NULL,
  `tenant_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ipd_prescriptions`
--

CREATE TABLE `ipd_prescriptions` (
  `id` int(10) UNSIGNED NOT NULL,
  `ipd_patient_department_id` int(10) UNSIGNED NOT NULL,
  `header_note` text COLLATE utf8mb4_unicode_ci,
  `footer_note` text COLLATE utf8mb4_unicode_ci,
  `tenant_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ipd_prescription_items`
--

CREATE TABLE `ipd_prescription_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `ipd_prescription_id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `medicine_id` int(10) UNSIGNED NOT NULL,
  `dosage` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `instruction` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tenant_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ipd_timelines`
--

CREATE TABLE `ipd_timelines` (
  `id` int(10) UNSIGNED NOT NULL,
  `ipd_patient_department_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `visible_to_person` tinyint(1) NOT NULL DEFAULT '1',
  `tenant_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `issued_items`
--

CREATE TABLE `issued_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `issued_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `issued_date` date NOT NULL,
  `return_date` date DEFAULT NULL,
  `item_category_id` int(10) UNSIGNED NOT NULL,
  `item_id` int(10) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) DEFAULT '0',
  `tenant_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_category_id` int(10) UNSIGNED NOT NULL,
  `unit` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `available_quantity` int(11) NOT NULL DEFAULT '0',
  `tenant_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `item_categories`
--

CREATE TABLE `item_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tenant_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `item_stocks`
--

CREATE TABLE `item_stocks` (
  `id` int(10) UNSIGNED NOT NULL,
  `item_category_id` int(10) UNSIGNED NOT NULL,
  `item_id` int(10) UNSIGNED NOT NULL,
  `supplier_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `store_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `purchase_price` double NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `tenant_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lab_technicians`
--

CREATE TABLE `lab_technicians` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `tenant_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `landing_about_us`
--

CREATE TABLE `landing_about_us` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `text_main` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `card_img_one` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `card_img_two` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `card_img_three` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `main_img_one` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `main_img_two` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `card_one_text` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `card_two_text` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `card_three_text` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `card_one_text_secondary` varchar(135) COLLATE utf8mb4_unicode_ci NOT NULL,
  `card_two_text_secondary` varchar(135) COLLATE utf8mb4_unicode_ci NOT NULL,
  `card_three_text_secondary` varchar(135) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `landing_about_us`
--

INSERT INTO `landing_about_us` (`id`, `text_main`, `card_img_one`, `card_img_two`, `card_img_three`, `main_img_one`, `main_img_two`, `card_one_text`, `card_two_text`, `card_three_text`, `card_one_text_secondary`, `card_two_text_secondary`, `card_three_text_secondary`, `created_at`, `updated_at`) VALUES
(1, 'How It Work', '/assets/landing-theme/images/banner/about_us.png', '/assets/landing-theme/images/banner/check-circle-regular.svg', '/assets/landing-theme/images/banner/credit-card-solid.svg', '/assets/landing-theme/images/about/12.svg', '/assets/landing-theme/images/about/14.svg', 'Research', 'HMS Customization', 'Cost Effective', 'HMS specialises in developing innovative, efficient and smart healthcare solutions.', 'We offer complete HMS customization solutions. We are staffed by eLearning experts and we know how to get the most from HMS.', 'HMS not only saves time in the hospital but also is cost-effective in decreasing the number of people working on the Paper work.', '2022-02-11 23:58:15', '2022-02-11 23:58:15');

-- --------------------------------------------------------

--
-- Table structure for table `live_consultations`
--

CREATE TABLE `live_consultations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `doctor_id` bigint(20) UNSIGNED NOT NULL,
  `patient_id` int(10) UNSIGNED NOT NULL,
  `consultation_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `consultation_date` datetime NOT NULL,
  `host_video` tinyint(1) NOT NULL,
  `participant_video` tinyint(1) NOT NULL,
  `consultation_duration_minutes` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `meeting_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta` text COLLATE utf8mb4_unicode_ci,
  `time_zone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tenant_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `live_meetings`
--

CREATE TABLE `live_meetings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `consultation_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `consultation_date` datetime NOT NULL,
  `consultation_duration_minutes` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `host_video` tinyint(1) NOT NULL,
  `participant_video` tinyint(1) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta` text COLLATE utf8mb4_unicode_ci,
  `meeting_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_zone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `tenant_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `live_meetings_candidates`
--

CREATE TABLE `live_meetings_candidates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `live_meeting_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mails`
--

CREATE TABLE `mails` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `to` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `attachments` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `tenant_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  `collection_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `disk` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` bigint(20) UNSIGNED NOT NULL,
  `manipulations` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `custom_properties` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `responsive_images` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_column` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `conversions_disk` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `generated_conversions` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `model_type`, `model_id`, `collection_name`, `name`, `file_name`, `mime_type`, `disk`, `size`, `manipulations`, `custom_properties`, `responsive_images`, `order_column`, `created_at`, `updated_at`, `conversions_disk`, `uuid`, `generated_conversions`) VALUES
(1, 'App\\Models\\FrontService', 1, 'front-services', 'cardiology', 'cardiology.png', 'image/png', 'public', 14945, '[]', '[]', '[]', 1, '2022-02-11 23:58:14', '2022-02-11 23:58:14', 'public', '9265b20c-b1ba-441c-9832-637eaa0fe76d', '[]'),
(2, 'App\\Models\\FrontService', 2, 'front-services', 'orthopedics', 'orthopedics.png', 'image/png', 'public', 11259, '[]', '[]', '[]', 2, '2022-02-11 23:58:14', '2022-02-11 23:58:14', 'public', '4fb53590-e5aa-4348-b165-9c12ffc54fda', '[]'),
(3, 'App\\Models\\FrontService', 3, 'front-services', 'pulmonology', 'pulmonology.png', 'image/png', 'public', 14513, '[]', '[]', '[]', 3, '2022-02-11 23:58:14', '2022-02-11 23:58:14', 'public', '6a37bd8f-d601-4e0d-870a-9d9598b49dcc', '[]'),
(4, 'App\\Models\\FrontService', 4, 'front-services', 'dental-care', 'dental-care.png', 'image/png', 'public', 11787, '[]', '[]', '[]', 4, '2022-02-11 23:58:14', '2022-02-11 23:58:14', 'public', '9251fa01-59e3-4213-aa0e-bc15f2648e44', '[]'),
(5, 'App\\Models\\FrontService', 5, 'front-services', 'medicine', 'medicine.png', 'image/png', 'public', 12927, '[]', '[]', '[]', 5, '2022-02-11 23:58:14', '2022-02-11 23:58:14', 'public', '6f4f88c8-882f-4e97-9155-6085510151d8', '[]'),
(6, 'App\\Models\\FrontService', 6, 'front-services', 'ambulance', 'ambulance.png', 'image/png', 'public', 10350, '[]', '[]', '[]', 6, '2022-02-11 23:58:14', '2022-02-11 23:58:14', 'public', '8e2b661e-36a8-4be9-b2d7-d9fc358f71da', '[]'),
(7, 'App\\Models\\FrontService', 7, 'front-services', 'ophthalmology', 'ophthalmology.png', 'image/png', 'public', 19751, '[]', '[]', '[]', 7, '2022-02-11 23:58:14', '2022-02-11 23:58:14', 'public', '2fd27345-5e33-4b5d-857b-c128963ce64a', '[]'),
(8, 'App\\Models\\FrontService', 8, 'front-services', 'neurology', 'neurology.png', 'image/png', 'public', 13907, '[]', '[]', '[]', 8, '2022-02-11 23:58:15', '2022-02-11 23:58:15', 'public', '575ae9a8-aacc-4139-92a0-7f644358f573', '[]'),
(9, 'App\\Models\\ServiceSlider', 1, 'service_slider', 'treatment', 'treatment.png', 'image/png', 'public', 1820, '[]', '[]', '[]', 9, '2022-02-11 23:58:15', '2022-02-11 23:58:15', 'public', '598dcb1e-8228-4b13-9373-fc56ff069c48', '[]'),
(10, 'App\\Models\\ServiceSlider', 2, 'service_slider', 'diagnostics', 'diagnostics.png', 'image/png', 'public', 2964, '[]', '[]', '[]', 10, '2022-02-11 23:58:15', '2022-02-11 23:58:15', 'public', '00905b5f-b179-465e-8f46-524cdc9c1e93', '[]'),
(11, 'App\\Models\\ServiceSlider', 3, 'service_slider', 'emergency', 'emergency.png', 'image/png', 'public', 1959, '[]', '[]', '[]', 11, '2022-02-11 23:58:15', '2022-02-11 23:58:15', 'public', '6005ef13-d0d0-4c77-b310-cfd33159e77d', '[]'),
(12, 'App\\Models\\ServiceSlider', 4, 'service_slider', 'qualified_doctors', 'qualified_doctors.png', 'image/png', 'public', 2039, '[]', '[]', '[]', 12, '2022-02-11 23:58:15', '2022-02-11 23:58:15', 'public', '8686d324-0f0f-4453-bec7-e5e009f37617', '[]'),
(13, 'App\\Models\\ServiceSlider', 5, 'service_slider', 'anasthesia', 'anasthesia.jpeg', 'image/jpeg', 'public', 14197, '[]', '[]', '[]', 13, '2022-02-11 23:58:15', '2022-02-11 23:58:15', 'public', 'baafdad7-d175-4e0c-b9f7-075289eaa0fe', '[]'),
(14, 'App\\Models\\ServiceSlider', 6, 'service_slider', 'injection', 'injection.png', 'image/png', 'public', 2230, '[]', '[]', '[]', 14, '2022-02-11 23:58:15', '2022-02-11 23:58:15', 'public', '8d15393f-ff41-4e03-9234-ef6060719582', '[]'),
(15, 'App\\Models\\ServiceSlider', 7, 'service_slider', 'slider_img_seven', 'slider_img_seven.png', 'image/png', 'public', 3154, '[]', '[]', '[]', 15, '2022-02-11 23:58:15', '2022-02-11 23:58:15', 'public', '39f2a22b-8725-4c24-af89-625093f2faf2', '[]');

-- --------------------------------------------------------

--
-- Table structure for table `medicines`
--

CREATE TABLE `medicines` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED DEFAULT NULL,
  `brand_id` int(10) UNSIGNED DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `selling_price` double NOT NULL,
  `buying_price` double NOT NULL,
  `salt_composition` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `side_effects` text COLLATE utf8mb4_unicode_ci,
  `tenant_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_09_15_000010_create_tenants_table', 1),
(2, '2014_09_15_000020_create_domains_table', 1),
(3, '2014_10_12_000000_create_users_table', 1),
(4, '2014_10_12_063910_create_users_tenant_table', 1),
(5, '2014_10_12_100000_create_password_resets_table', 1),
(6, '2019_08_19_000000_create_failed_jobs_table', 1),
(7, '2020_02_06_031618_create_categories_table', 1),
(8, '2020_02_12_053840_create_doctor_departments_table', 1),
(9, '2020_02_12_053932_create_departments_table', 1),
(10, '2020_02_13_042835_create_brands_table', 1),
(11, '2020_02_13_053840_create_doctors_table', 1),
(12, '2020_02_13_054103_create_patients_table', 1),
(13, '2020_02_13_094724_create_bills_table', 1),
(14, '2020_02_13_095024_create_medicines_table', 1),
(15, '2020_02_13_095125_create_bill_items_table', 1),
(16, '2020_02_13_111857_create_nurses_table', 1),
(17, '2020_02_13_125601_create_addresses_table', 1),
(18, '2020_02_13_141104_create_media_table', 1),
(19, '2020_02_14_051650_create_lab_technicians_table', 1),
(20, '2020_02_14_055353_create_appointments_table', 1),
(21, '2020_02_14_091441_create_receptionists_table', 1),
(22, '2020_02_14_093246_create_pharmacists_table', 1),
(23, '2020_02_17_053450_create_accountants_table', 1),
(24, '2020_02_17_080856_create_bed_types_table', 1),
(25, '2020_02_17_092326_create_blood_banks_table', 1),
(26, '2020_02_17_105627_create_beds_table', 1),
(27, '2020_02_17_110620_create_blood_donors_table', 1),
(28, '2020_02_17_135716_create_permission_tables', 1),
(29, '2020_02_18_042327_create_notice_boards_table', 1),
(30, '2020_02_18_042442_create_document_types_table', 1),
(31, '2020_02_18_060222_create_patient_cases_table', 1),
(32, '2020_02_18_060223_create_operation_reports_table', 1),
(33, '2020_02_18_064953_create_bed_assigns_table', 1),
(34, '2020_02_18_092202_create_documents_table', 1),
(35, '2020_02_18_094758_create_birth_reports_table', 1),
(36, '2020_02_18_111020_create_death_reports_table', 1),
(37, '2020_02_19_080336_create_employee_payrolls_table', 1),
(38, '2020_02_19_134502_create_settings_table', 1),
(39, '2020_02_21_090236_create_investigation_reports_table', 1),
(40, '2020_02_21_095439_create_accounts_table', 1),
(41, '2020_02_22_070658_create_payments_table', 1),
(42, '2020_02_22_090112_create_insurances_table', 1),
(43, '2020_02_22_091537_create_insurance_disease_table', 1),
(44, '2020_02_24_055136_create_invoices_table', 1),
(45, '2020_02_24_055518_create_schedules_table', 1),
(46, '2020_02_24_055702_create_invoice_items_table', 1),
(47, '2020_02_25_105042_create_services_table', 1),
(48, '2020_02_25_131030_create_packages_table', 1),
(49, '2020_02_25_131108_create_package_services_table', 1),
(50, '2020_02_27_120948_create_patient_admissions_table', 1),
(51, '2020_02_28_031410_create_case_handlers_table', 1),
(52, '2020_03_02_043813_create_advanced_payments_table', 1),
(53, '2020_03_02_065845_add_patient_admission_id_to_bills', 1),
(54, '2020_03_03_062243_add_patient_id_to_bills', 1),
(55, '2020_03_03_113334_create_schedule_day_table', 1),
(56, '2020_03_26_052336_create_ambulances_table', 1),
(57, '2020_03_26_081157_create_mails_table', 1),
(58, '2020_03_27_061641_create_enquiries_table', 1),
(59, '2020_03_27_063148_create_ambulance_calls_table', 1),
(60, '2020_03_31_122219_create_prescriptions_table', 1),
(61, '2020_04_11_052629_create_charge_categories_table', 1),
(62, '2020_04_11_053929_create_pathology_categories_table', 1),
(63, '2020_04_11_070859_create_radiology_categories_table', 1),
(64, '2020_04_11_090903_create_charges_table', 1),
(65, '2020_04_13_050643_create_radiology_tests_table', 1),
(66, '2020_04_14_093339_create_pathology_tests_table', 1),
(67, '2020_04_24_111205_create_doctor_opd_charge_table', 1),
(68, '2020_04_28_094118_create_expenses_table', 1),
(69, '2020_05_01_055137_create_incomes_table', 1),
(70, '2020_05_11_083050_add_notes_documents_table', 1),
(71, '2020_05_12_075825_create_sms_table', 1),
(72, '2020_06_22_071531_add_index_to_accounts_table', 1),
(73, '2020_06_22_071943_add_index_to_doctor_opd_charges_table', 1),
(74, '2020_06_22_072921_add_index_to_bed_assigns_table', 1),
(75, '2020_06_22_073042_add_index_to_medicines_table', 1),
(76, '2020_06_22_073457_add_index_to_employee_payrolls_table', 1),
(77, '2020_06_22_074937_add_index_to_notice_boards_table', 1),
(78, '2020_06_22_075222_add_index_to_blood_donors_table', 1),
(79, '2020_06_22_075359_add_index_to_packages_table', 1),
(80, '2020_06_22_075506_add_index_to_bed_types_table', 1),
(81, '2020_06_22_075725_add_index_to_services_table', 1),
(82, '2020_06_22_080944_add_index_to_invoices_table', 1),
(83, '2020_06_22_081601_add_index_to_payments_table', 1),
(84, '2020_06_22_081802_add_index_to_advanced_payments_table', 1),
(85, '2020_06_22_081909_add_index_to_bills_table', 1),
(86, '2020_06_22_082548_add_index_to_beds_table', 1),
(87, '2020_06_22_082942_add_index_to_blood_banks_table', 1),
(88, '2020_06_22_083511_add_index_to_users_table', 1),
(89, '2020_06_22_084750_add_index_to_patient_cases_table', 1),
(90, '2020_06_22_084912_add_index_to_patient_admissions_table', 1),
(91, '2020_06_22_085036_add_index_to_document_types_table', 1),
(92, '2020_06_22_085128_add_index_to_insurances_table', 1),
(93, '2020_06_22_085317_add_index_to_ambulances_table', 1),
(94, '2020_06_22_090509_add_index_to_ambulance_calls_table', 1),
(95, '2020_06_22_091253_add_index_to_doctor_departments_table', 1),
(96, '2020_06_22_091455_add_index_to_appointments_table', 1),
(97, '2020_06_22_091617_add_index_to_birth_reports_table', 1),
(98, '2020_06_22_091632_add_index_to_death_reports_table', 1),
(99, '2020_06_22_091651_add_index_to_investigation_reports_table', 1),
(100, '2020_06_22_091828_add_index_to_operation_reports_table', 1),
(101, '2020_06_22_092018_add_index_to_categories_table', 1),
(102, '2020_06_22_092149_add_index_to_brands_table', 1),
(103, '2020_06_22_092324_add_index_to_pathology_tests_table', 1),
(104, '2020_06_22_092338_add_index_to_pathology_categories_table', 1),
(105, '2020_06_22_092347_add_index_to_radiology_tests_table', 1),
(106, '2020_06_22_092357_add_index_to_radiology_categories_table', 1),
(107, '2020_06_22_092651_add_index_to_expenses_table', 1),
(108, '2020_06_22_092702_add_index_to_incomes_table', 1),
(109, '2020_06_22_092855_add_index_to_charges_table', 1),
(110, '2020_06_22_092905_add_index_to_charge_categories_table', 1),
(111, '2020_06_22_093234_add_index_to_enquiries_table', 1),
(112, '2020_06_24_044648_create_diagnosis_categories_table', 1),
(113, '2020_06_25_080242_create_patient_diagnosis_tests_table', 1),
(114, '2020_06_26_054352_create_patient_diagnosis_properties_table', 1),
(115, '2020_07_15_044653_remove_serial_visibility_from_schedules_table', 1),
(116, '2020_07_15_121336_change_ambulances_table_column', 1),
(117, '2020_07_22_052934_change_bed_assigns_table_column', 1),
(118, '2020_07_29_095430_change_invoice_items_table_column', 1),
(119, '2020_08_26_081235_create_item_categories_table', 1),
(120, '2020_08_26_101134_create_items_table', 1),
(121, '2020_08_26_125032_create_item_stocks_table', 1),
(122, '2020_08_27_141547_create_issued_items_table', 1),
(123, '2020_09_08_064222_create_ipd_patient_departments_table', 1),
(124, '2020_09_08_114627_create_ipd_diagnoses_table', 1),
(125, '2020_09_09_065624_create_ipd_consultant_registers_table', 1),
(126, '2020_09_09_135505_create_ipd_charges_table', 1),
(127, '2020_09_10_112306_create_ipd_prescriptions_table', 1),
(128, '2020_09_10_114203_create_ipd_prescription_items_table', 1),
(129, '2020_09_11_045308_create_modules_table', 1),
(130, '2020_09_12_050715_create_ipd_payments_table', 1),
(131, '2020_09_12_071821_create_ipd_timelines_table', 1),
(132, '2020_09_12_103003_create_ipd_bills_table', 1),
(133, '2020_09_14_083759_create_opd_patient_departments_table', 1),
(134, '2020_09_14_144731_add_ipd_patient_department_id_to_bed_assigns_table', 1),
(135, '2020_09_15_064044_create_transactions_table', 1),
(136, '2020_09_16_103204_create_opd_diagnoses_table', 1),
(137, '2020_09_16_114031_create_opd_timelines_table', 1),
(138, '2020_09_23_045100_change_patient_diagnosis_properties_table', 1),
(139, '2020_09_24_053229_add_ipd_bill_column_in_ipd_patient_departments_table', 1),
(140, '2020_10_09_085838_create_call_logs_table', 1),
(141, '2020_10_12_125133_create_visitors_table', 1),
(142, '2020_10_14_044134_create_postals_table', 1),
(143, '2020_10_30_043500_add_route_in_modules_table', 1),
(144, '2020_10_31_062448_add_complete_in_appointments_table', 1),
(145, '2020_11_02_050736_create_testimonials_table', 1),
(146, '2020_11_07_121633_add_region_code_in_sms_table', 1),
(147, '2020_11_19_093810_create_blood_donations_table', 1),
(148, '2020_11_20_113830_create_blood_issues_table', 1),
(149, '2020_11_24_131253_create_notifications_table', 1),
(150, '2020_12_28_131351_create_live_consultations_table', 1),
(151, '2020_12_31_062506_create_live_meetings_table', 1),
(152, '2020_12_31_091242_create_live_meetings_candidates_table', 1),
(153, '2021_01_05_100425_create_user_zoom_credential_table', 1),
(154, '2021_01_06_105407_add_metting_id_to_live_meetings_table', 1),
(155, '2021_02_23_065200_create_vaccinations_table', 1),
(156, '2021_02_23_065252_create_vaccinated_patients_table', 1),
(157, '2021_04_05_085646_create_front_settings_table', 1),
(158, '2021_05_10_000000_add_uuid_to_failed_jobs_table', 1),
(159, '2021_05_29_103036_add_conversions_disk_column_in_media_table', 1),
(160, '2021_06_07_104022_change_patient_foreign_key_type_in_appointments_table', 1),
(161, '2021_06_08_073918_change_department_foreign_key_in_appointments_table', 1),
(162, '2021_06_21_082754_update_amount_datatype_in_bills_table', 1),
(163, '2021_06_21_082845_update_amount_datatype_in_bill_items_table', 1),
(164, '2021_11_11_061443_create_front_services_table', 1),
(165, '2021_11_12_100750_create_hospital_schedules_table', 1),
(166, '2021_11_12_105805_add_social_details_in_users_table', 1),
(167, '2021_11_20_071507_create_subscription_plans_table', 1),
(168, '2021_11_23_090824_create_subscriptions_table', 1),
(169, '2021_11_24_102200_create_section_ones_table', 1),
(170, '2021_11_25_102200_create_section_twos_table', 1),
(171, '2021_11_26_085330_create_super_admin_settings_table', 1),
(172, '2021_11_26_102200_create_section_threes_table', 1),
(173, '2021_11_26_102202_create_section_fours_table', 1),
(174, '2021_11_26_102203_create_section_fives_table', 1),
(175, '2021_11_26_131611_create_subscribes_table', 1),
(176, '2021_11_26_131613_create_landing_about_us_table', 1),
(177, '2021_11_26_131615_create_super_admin_enquiries_table', 1),
(178, '2021_11_30_043411_create_service_sliders_table', 1),
(179, '2021_11_30_132704_create_admin_testimonials_table', 1),
(180, '2021_12_01_094113_create_faqs_table', 1),
(181, '2021_12_08_084047_create_features_table', 1),
(182, '2021_12_08_105802_create_feature_subscriptionplan_table', 1),
(183, '2022_01_24_065736_change_domain_field_in_domains_table', 1),
(184, '2022_01_24_065936_change_route_field_in_features_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(10, 'App\\Models\\User', 1);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `route` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tenant_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `name`, `is_active`, `route`, `tenant_id`, `created_at`, `updated_at`) VALUES
(1, 'Patients', 1, 'patients.index', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(2, 'Doctors', 1, 'doctors.index', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(3, 'Accountants', 1, 'accountants.index', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(4, 'Medicines', 1, 'medicines.index', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(5, 'Nurses', 1, 'nurses.index', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(6, 'Receptionists', 1, 'receptionists.index', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(7, 'Lab Technicians', 1, 'lab-technicians.index', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(8, 'Pharmacists', 1, 'pharmacists.index', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(9, 'Birth Reports', 1, 'birth-reports.index', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(10, 'Death Reports', 1, 'death-reports.index', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(11, 'Investigation Reports', 1, 'investigation-reports.index', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(12, 'Operation Reports', 1, 'operation-reports.index', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(13, 'Income', 1, 'incomes.index', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(14, 'Expense', 1, 'expenses.index', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(15, 'SMS', 1, 'sms.index', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(16, 'IPD Patients', 1, 'ipd.patient.index', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(17, 'OPD Patients', 1, 'opd.patient.index', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(18, 'Accounts', 1, 'accounts.index', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(19, 'Employee Payrolls', 1, 'employee-payrolls.index', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(20, 'Invoices', 1, 'invoices.index', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(21, 'Payments', 1, 'payments.index', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(22, 'Payment Reports', 1, 'payment.reports', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(23, 'Advance Payments', 1, 'advanced-payments.index', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(24, 'Bills', 1, 'bills.index', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(25, 'Bed Types', 1, 'bed-types.index', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(26, 'Beds', 1, 'beds.index', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(27, 'Bed Assigns', 1, 'bed-assigns.index', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(28, 'Blood Banks', 1, 'blood-banks.index', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(29, 'Blood Donors', 1, 'blood-donors.index', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(30, 'Documents', 1, 'documents.index', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(31, 'Document Types', 1, 'document-types.index', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(32, 'Services', 1, 'services.index', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(33, 'Insurances', 1, 'insurances.index', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(34, 'Packages', 1, 'packages.index', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(35, 'Ambulances', 1, 'ambulances.index', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(36, 'Ambulances Calls', 1, 'ambulance-calls.index', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(37, 'Appointments', 1, 'appointments.index', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(38, 'Call Logs', 1, 'call_logs.index', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(39, 'Visitors', 1, 'visitors.index', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(40, 'Postal Receive', 1, 'receives.index', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(41, 'Postal Dispatch', 1, 'dispatches.index', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(42, 'Notice Boards', 1, 'noticeboard', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(43, 'Mail', 1, 'mail', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(44, 'Enquires', 1, 'enquiries', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(45, 'Charge Categories', 1, 'charge-categories.index', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(46, 'Charges', 1, 'charges.index', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(47, 'Doctor OPD Charges', 1, 'doctor-opd-charges.index', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(48, 'Items Categories', 1, 'item-categories.index', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(49, 'Items', 1, 'items.index', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(50, 'Item Stocks', 1, 'item.stock.index', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(51, 'Issued Items', 1, 'issued.item.index', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(52, 'Diagnosis Categories', 1, 'diagnosis.category.index', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(53, 'Diagnosis Tests', 1, 'patient.diagnosis.test.index', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(54, 'Pathology Categories', 1, 'pathology.category.index', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(55, 'Pathology Tests', 1, 'pathology.test.index', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(56, 'Radiology Categories', 1, 'radiology.category.index', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(57, 'Radiology Tests', 1, 'radiology.test.index', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(58, 'Medicine Categories', 1, 'categories.index', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(59, 'Medicine Brands', 1, 'brands.index', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(60, 'Doctor Departments', 1, 'doctor-departments.index', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(61, 'Schedules', 1, 'schedules.index', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(62, 'Prescriptions', 1, 'prescriptions.index', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(63, 'Cases', 1, 'patient-cases.index', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(64, 'Case Handlers', 1, 'case-handlers.index', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(65, 'Patient Admissions', 1, 'patient-admissions.index', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(66, 'My Payrolls', 1, 'payroll', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(67, 'Patient Cases', 1, 'patients.cases', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(68, 'Testimonial', 1, 'testimonials.index', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(69, 'Blood Donations', 1, 'blood-donations.index', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(70, 'Blood Issues', 1, 'blood-issues.index', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(71, 'Live Consultations', 1, 'live.consultation.index', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(72, 'Live Meetings', 1, 'live.meeting.index', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(73, 'Vaccinated Patients', 1, 'vaccinated-patients.index', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(74, 'Vaccinations', 1, 'vaccinations.index', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(75, 'Vaccinations', 1, 'vaccinations.index', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(76, 'Vaccinated Patients', 1, 'vaccinated-patients.index', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14');

-- --------------------------------------------------------

--
-- Table structure for table `notice_boards`
--

CREATE TABLE `notice_boards` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `tenant_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` int(11) NOT NULL,
  `notification_for` int(11) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci,
  `meta` text COLLATE utf8mb4_unicode_ci,
  `read_at` timestamp NULL DEFAULT NULL,
  `tenant_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nurses`
--

CREATE TABLE `nurses` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `tenant_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `opd_diagnoses`
--

CREATE TABLE `opd_diagnoses` (
  `id` int(10) UNSIGNED NOT NULL,
  `opd_patient_department_id` int(10) UNSIGNED NOT NULL,
  `report_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `report_date` datetime NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `tenant_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `opd_patient_departments`
--

CREATE TABLE `opd_patient_departments` (
  `id` int(10) UNSIGNED NOT NULL,
  `patient_id` int(10) UNSIGNED NOT NULL,
  `opd_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `height` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `weight` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bp` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `symptoms` text COLLATE utf8mb4_unicode_ci,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `appointment_date` datetime NOT NULL,
  `case_id` int(10) UNSIGNED DEFAULT NULL,
  `is_old_patient` tinyint(1) DEFAULT '0',
  `doctor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `standard_charge` double NOT NULL,
  `payment_mode` tinyint(4) NOT NULL,
  `tenant_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `opd_timelines`
--

CREATE TABLE `opd_timelines` (
  `id` int(10) UNSIGNED NOT NULL,
  `opd_patient_department_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `visible_to_person` tinyint(1) NOT NULL DEFAULT '1',
  `tenant_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `operation_reports`
--

CREATE TABLE `operation_reports` (
  `id` int(10) UNSIGNED NOT NULL,
  `patient_id` int(10) UNSIGNED NOT NULL,
  `case_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `doctor_id` bigint(20) UNSIGNED NOT NULL,
  `date` datetime NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `tenant_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `discount` double NOT NULL,
  `total_amount` double NOT NULL,
  `tenant_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `package_services`
--

CREATE TABLE `package_services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `package_id` int(10) UNSIGNED NOT NULL,
  `service_id` int(10) UNSIGNED NOT NULL,
  `quantity` double NOT NULL,
  `rate` double NOT NULL,
  `amount` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pathology_categories`
--

CREATE TABLE `pathology_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tenant_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pathology_tests`
--

CREATE TABLE `pathology_tests` (
  `id` int(10) UNSIGNED NOT NULL,
  `test_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `test_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `unit` int(11) DEFAULT NULL,
  `subcategory` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `method` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `report_days` int(11) DEFAULT NULL,
  `charge_category_id` int(10) UNSIGNED NOT NULL,
  `standard_charge` int(11) NOT NULL,
  `tenant_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `tenant_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patient_admissions`
--

CREATE TABLE `patient_admissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `patient_admission_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `patient_id` int(10) UNSIGNED NOT NULL,
  `doctor_id` bigint(20) UNSIGNED NOT NULL,
  `admission_date` datetime NOT NULL,
  `discharge_date` datetime DEFAULT NULL,
  `package_id` int(10) UNSIGNED DEFAULT NULL,
  `insurance_id` int(10) UNSIGNED DEFAULT NULL,
  `bed_id` int(10) UNSIGNED DEFAULT NULL,
  `policy_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agent_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guardian_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guardian_relation` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guardian_contact` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guardian_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `tenant_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patient_cases`
--

CREATE TABLE `patient_cases` (
  `id` int(10) UNSIGNED NOT NULL,
  `case_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `patient_id` int(10) UNSIGNED NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `doctor_id` bigint(20) UNSIGNED NOT NULL,
  `date` datetime NOT NULL,
  `fee` double NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `description` text COLLATE utf8mb4_unicode_ci,
  `tenant_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patient_diagnosis_properties`
--

CREATE TABLE `patient_diagnosis_properties` (
  `id` int(10) UNSIGNED NOT NULL,
  `patient_diagnosis_id` bigint(20) UNSIGNED NOT NULL,
  `property_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `property_value` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patient_diagnosis_tests`
--

CREATE TABLE `patient_diagnosis_tests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `patient_id` int(10) UNSIGNED NOT NULL,
  `doctor_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `report_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tenant_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(10) UNSIGNED NOT NULL,
  `payment_date` date NOT NULL,
  `account_id` int(10) UNSIGNED NOT NULL,
  `pay_to` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `tenant_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'manage_users', 'web', '2022-02-11 23:58:13', '2022-02-11 23:58:13'),
(2, 'manage_beds', 'web', '2022-02-11 23:58:13', '2022-02-11 23:58:13'),
(3, 'manage_wards', 'web', '2022-02-11 23:58:13', '2022-02-11 23:58:13'),
(4, 'manage_appointments', 'web', '2022-02-11 23:58:13', '2022-02-11 23:58:13'),
(5, 'manage_prescriptions', 'web', '2022-02-11 23:58:13', '2022-02-11 23:58:13'),
(6, 'manage_patients', 'web', '2022-02-11 23:58:13', '2022-02-11 23:58:13'),
(7, 'manage_blood_bank', 'web', '2022-02-11 23:58:13', '2022-02-11 23:58:13'),
(8, 'manage_reports', 'web', '2022-02-11 23:58:13', '2022-02-11 23:58:13'),
(9, 'manage_payrolls', 'web', '2022-02-11 23:58:13', '2022-02-11 23:58:13'),
(10, 'manage_settings', 'web', '2022-02-11 23:58:13', '2022-02-11 23:58:13'),
(11, 'manage_notice_board', 'web', '2022-02-11 23:58:13', '2022-02-11 23:58:13'),
(12, 'manage_doctors', 'web', '2022-02-11 23:58:13', '2022-02-11 23:58:13'),
(13, 'manage_nurses', 'web', '2022-02-11 23:58:13', '2022-02-11 23:58:13'),
(14, 'manage_receptionists', 'web', '2022-02-11 23:58:13', '2022-02-11 23:58:13'),
(15, 'manage_pharmacists', 'web', '2022-02-11 23:58:13', '2022-02-11 23:58:13'),
(16, 'manage_accountants', 'web', '2022-02-11 23:58:13', '2022-02-11 23:58:13'),
(17, 'manage_invoices', 'web', '2022-02-11 23:58:13', '2022-02-11 23:58:13'),
(18, 'manage_operations_history', 'web', '2022-02-11 23:58:13', '2022-02-11 23:58:13'),
(19, 'manage_admit_history', 'web', '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(20, 'manage_blood_donor', 'web', '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(21, 'manage_medicines', 'web', '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(22, 'manage_department', 'web', '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(23, 'manage_doctor_departments', 'web', '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(24, 'manage_lab_technicians', 'web', '2022-02-11 23:58:14', '2022-02-11 23:58:14');

-- --------------------------------------------------------

--
-- Table structure for table `pharmacists`
--

CREATE TABLE `pharmacists` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `tenant_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `postals`
--

CREATE TABLE `postals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `from_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `to_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `type` int(11) DEFAULT NULL,
  `tenant_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prescriptions`
--

CREATE TABLE `prescriptions` (
  `id` int(10) UNSIGNED NOT NULL,
  `patient_id` int(10) UNSIGNED NOT NULL,
  `doctor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `food_allergies` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tendency_bleed` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `heart_disease` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `high_blood_pressure` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `diabetic` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `surgery` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `accident` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `others` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `medical_history` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_medication` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `female_pregnancy` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `breast_feeding` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `health_insurance` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `low_income` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `tenant_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `radiology_categories`
--

CREATE TABLE `radiology_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tenant_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `radiology_tests`
--

CREATE TABLE `radiology_tests` (
  `id` int(10) UNSIGNED NOT NULL,
  `test_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `test_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `subcategory` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `report_days` int(11) DEFAULT NULL,
  `charge_category_id` int(10) UNSIGNED NOT NULL,
  `standard_charge` int(11) NOT NULL,
  `tenant_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `receptionists`
--

CREATE TABLE `receptionists` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `tenant_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(4, 2),
(5, 2),
(6, 2),
(7, 2),
(8, 2),
(11, 2),
(12, 2),
(13, 2),
(14, 2),
(15, 2),
(18, 2),
(20, 2),
(21, 2),
(22, 2),
(4, 3),
(5, 3),
(7, 3),
(8, 3),
(11, 3),
(12, 3),
(13, 3),
(14, 3),
(15, 3),
(19, 3),
(21, 3),
(2, 4),
(3, 4),
(4, 4),
(5, 4),
(6, 4),
(7, 4),
(8, 4),
(11, 4),
(12, 4),
(13, 4),
(14, 4),
(15, 4),
(18, 4),
(20, 4),
(21, 4),
(22, 4),
(2, 5),
(3, 5),
(4, 5),
(6, 5),
(7, 5),
(8, 5),
(11, 5),
(12, 5),
(13, 5),
(14, 5),
(15, 5),
(18, 5),
(19, 5),
(20, 5),
(22, 5),
(24, 5),
(11, 6),
(15, 6),
(21, 6),
(11, 7),
(15, 7),
(21, 7),
(1, 10),
(2, 10),
(3, 10),
(4, 10),
(5, 10),
(6, 10),
(7, 10),
(8, 10),
(9, 10),
(10, 10),
(11, 10),
(12, 10),
(13, 10),
(14, 10),
(15, 10),
(16, 10),
(17, 10),
(18, 10),
(19, 10),
(20, 10),
(21, 10),
(22, 10),
(23, 10);

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` int(10) UNSIGNED NOT NULL,
  `doctor_id` bigint(20) UNSIGNED NOT NULL,
  `per_patient_time` time NOT NULL,
  `tenant_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `schedule_days`
--

CREATE TABLE `schedule_days` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `doctor_id` bigint(20) UNSIGNED NOT NULL,
  `schedule_id` int(10) UNSIGNED NOT NULL,
  `available_on` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `available_from` time NOT NULL,
  `available_to` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `section_fives`
--

CREATE TABLE `section_fives` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `main_img_url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `card_img_url_one` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `card_img_url_two` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `card_img_url_three` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `card_img_url_four` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `card_one_number` int(11) NOT NULL,
  `card_two_number` int(11) NOT NULL,
  `card_three_number` int(11) NOT NULL,
  `card_four_number` int(11) NOT NULL,
  `card_one_text` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `card_two_text` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `card_three_text` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `card_four_text` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `section_fives`
--

INSERT INTO `section_fives` (`id`, `main_img_url`, `card_img_url_one`, `card_img_url_two`, `card_img_url_three`, `card_img_url_four`, `card_one_number`, `card_two_number`, `card_three_number`, `card_four_number`, `card_one_text`, `card_two_text`, `card_three_text`, `card_four_text`, `created_at`, `updated_at`) VALUES
(1, '/assets/landing-theme/images/about/07.svg', '/assets/landing-theme/images/banner/card_img_url_one.svg', '/assets/landing-theme/images/banner/card_img_url_two.svg', '/assets/landing-theme/images/banner/card_img_url_three.svg', '/assets/landing-theme/images/banner/card_img_url_four.svg', 234, 455, 365, 528, 'Services', 'Team Members', 'Happy Patients', 'Tonic Research', '2022-02-11 23:58:15', '2022-02-11 23:58:15');

-- --------------------------------------------------------

--
-- Table structure for table `section_fours`
--

CREATE TABLE `section_fours` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `text_main` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text_secondary` varchar(160) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img_url_one` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img_url_two` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img_url_three` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img_url_four` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img_url_five` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img_url_six` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `card_text_one` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `card_text_two` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `card_text_three` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `card_text_four` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `card_text_five` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `card_text_six` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `card_text_one_secondary` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `card_text_two_secondary` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `card_text_three_secondary` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `card_text_four_secondary` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `card_text_five_secondary` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `card_text_six_secondary` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `section_fours`
--

INSERT INTO `section_fours` (`id`, `text_main`, `text_secondary`, `img_url_one`, `img_url_two`, `img_url_three`, `img_url_four`, `img_url_five`, `img_url_six`, `card_text_one`, `card_text_two`, `card_text_three`, `card_text_four`, `card_text_five`, `card_text_six`, `card_text_one_secondary`, `card_text_two_secondary`, `card_text_three_secondary`, `card_text_four_secondary`, `card_text_five_secondary`, `card_text_six_secondary`, `created_at`, `updated_at`) VALUES
(1, 'Grow Your Hospital', 'We Help To Grow Your Hospital Beyond Your Expectation', '/assets/landing-theme/images/banner/bulit_seo.png', '/assets/landing-theme/images/banner/hospital_profile.png', '/assets/landing-theme/images/banner/online_appointment.png', '/assets/landing-theme/images/banner/articles.png', '/assets/landing-theme/images/banner/easy_to_use.png', '/assets/landing-theme/images/banner/support.jpeg', 'Built SEO', 'Hospital Profile', 'Online Appointment', 'Articles', 'Easy to Use', '24*7 Support', 'SEO Brings Higher patient retention Rates which will Results into Higher Conversion Rate.', 'More than 80% of people searching for medical professionals make their selection from HMS.', 'Provide comfort to your patients in this pandemic situation to book online appointments.', 'Keep updated with latest techniques/knowledge/research to build a professional network.', 'Top quality Software with all Features easy to use and easily accessible.', 'Any time we are here to help you.', '2022-02-11 23:58:15', '2022-02-11 23:58:15');

-- --------------------------------------------------------

--
-- Table structure for table `section_ones`
--

CREATE TABLE `section_ones` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `text_main` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text_secondary` varchar(135) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img_url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `section_ones`
--

INSERT INTO `section_ones` (`id`, `text_main`, `text_secondary`, `img_url`, `created_at`, `updated_at`) VALUES
(1, 'Manage Hospital Never Before', 'A Next Level Evolution In Healthcare IT, Web Based EMR, Revenue Cycle Management Solution, Designed To Meet The Opportunities.', '/assets/landing-theme/images/banner/section_one.png', '2022-02-11 23:58:15', '2022-02-11 23:58:15');

-- --------------------------------------------------------

--
-- Table structure for table `section_threes`
--

CREATE TABLE `section_threes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `text_main` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text_secondary` varchar(160) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img_url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text_one` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text_two` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text_three` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text_four` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text_five` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `section_threes`
--

INSERT INTO `section_threes` (`id`, `text_main`, `text_secondary`, `img_url`, `text_one`, `text_two`, `text_three`, `text_four`, `text_five`, `created_at`, `updated_at`) VALUES
(1, 'Why Hospital SAAS?', 'We have implemented, Hospital SAAS for our patient\'s registration, appointment scheduling, inpatient management, ICU management, OT management, pharmacy.', '/assets/landing-theme/images/banner/section_three_sass.png', 'Fully Secure', 'Easy To Use', 'Regular Updates', '24*7 Support', NULL, '2022-02-11 23:58:15', '2022-02-11 23:58:15');

-- --------------------------------------------------------

--
-- Table structure for table `section_twos`
--

CREATE TABLE `section_twos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `text_main` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text_secondary` varchar(160) COLLATE utf8mb4_unicode_ci NOT NULL,
  `card_one_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `card_one_text` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `card_one_text_secondary` varchar(90) COLLATE utf8mb4_unicode_ci NOT NULL,
  `card_two_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `card_two_text` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `card_two_text_secondary` varchar(90) COLLATE utf8mb4_unicode_ci NOT NULL,
  `card_third_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `card_third_text` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `card_third_text_secondary` varchar(90) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `section_twos`
--

INSERT INTO `section_twos` (`id`, `text_main`, `text_secondary`, `card_one_image`, `card_one_text`, `card_one_text_secondary`, `card_two_image`, `card_two_text`, `card_two_text_secondary`, `card_third_image`, `card_third_text`, `card_third_text_secondary`, `created_at`, `updated_at`) VALUES
(1, 'Protect Your Health', 'Our medical clinic provides quality care for the entire family while maintaining a personable atmosphere best services.', '/assets/landing-theme/images/banner/appointment_schedule.png', 'Schedule Appointment', 'Makes it Easy for patients to Book Appointment online from anywhere &amp; anytime.', '/assets/landing-theme/images/banner/ipd_manage.png', 'OPD Management', 'Easily Manage Appointments with one click go to Medical Records of Patient to Save time.IP', '/assets/landing-theme/images/banner/opd_manage.png', 'IPD Management', 'This module of hospital management system is designed to manage all Inpatient department', '2022-02-11 23:58:15', '2022-02-11 23:58:15');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `quantity` int(11) NOT NULL,
  `rate` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `tenant_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `service_sliders`
--

CREATE TABLE `service_sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_sliders`
--

INSERT INTO `service_sliders` (`id`, `created_at`, `updated_at`) VALUES
(1, '2022-02-11 23:58:15', '2022-02-11 23:58:15'),
(2, '2022-02-11 23:58:15', '2022-02-11 23:58:15'),
(3, '2022-02-11 23:58:15', '2022-02-11 23:58:15'),
(4, '2022-02-11 23:58:15', '2022-02-11 23:58:15'),
(5, '2022-02-11 23:58:15', '2022-02-11 23:58:15'),
(6, '2022-02-11 23:58:15', '2022-02-11 23:58:15'),
(7, '2022-02-11 23:58:15', '2022-02-11 23:58:15');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tenant_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `tenant_id`, `created_at`, `updated_at`) VALUES
(1, 'app_name', 'HMS', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(2, 'app_logo', 'http://127.0.0.1:8000/web/img/hms-saas-logo.png', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(3, 'company_name', 'InfyOmLabs', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(4, 'current_currency', 'inr', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(5, 'hospital_address', '16/A saint Joseph Park', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(6, 'hospital_email', 'cityhospital@gmail.com', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(7, 'hospital_phone', '+919876543210', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(8, 'hospital_from_day', 'Mon to Fri', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(9, 'hospital_from_time', '9 AM to 9 PM', NULL, '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(10, 'favicon', 'http://127.0.0.1:8000/web/img/hms-saas-favicon.ico', NULL, '2022-02-11 23:58:15', '2022-02-11 23:58:15'),
(11, 'facebook_url', 'https://www.facebook.com/infyom/', NULL, '2022-02-11 23:58:15', '2022-02-11 23:58:15'),
(12, 'twitter_url', 'https://twitter.com/infyom?lang=en', NULL, '2022-02-11 23:58:15', '2022-02-11 23:58:15'),
(13, 'instagram_url', 'https://www.instagram.com/?hl=en', NULL, '2022-02-11 23:58:15', '2022-02-11 23:58:15'),
(14, 'linkedIn_url', 'https://www.linkedin.com/organization-guest/company/infyom-technologies?challengeId=AQFgQaMxwSxCdAAAAXOA_wosiB2vYdQEoITs6w676AzV8cu8OzhnWEBNUQ7LCG4vds5-A12UIQk1M4aWfKmn6iM58OFJbpoRiA&submissi', NULL, '2022-02-11 23:58:15', '2022-02-11 23:58:15'),
(15, 'about_us', 'Over past 10+ years of experience and skills in various technologies, we built great scalable products.\nWhatever technology we worked with, we just not build products for our clients but we a', NULL, '2022-02-11 23:58:15', '2022-02-11 23:58:15'),
(16, 'enable_google_recaptcha', '0', NULL, '2022-02-11 23:58:15', '2022-02-11 23:58:15');

-- --------------------------------------------------------

--
-- Table structure for table `sms`
--

CREATE TABLE `sms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `send_to` bigint(20) UNSIGNED DEFAULT NULL,
  `region_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `send_by` bigint(20) UNSIGNED NOT NULL,
  `tenant_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscribes`
--

CREATE TABLE `subscribes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subscribe` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `subscription_plan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `transaction_id` bigint(20) UNSIGNED DEFAULT NULL,
  `plan_amount` double(8,2) DEFAULT '0.00',
  `plan_frequency` int(11) NOT NULL DEFAULT '1' COMMENT '1 = Month, 2 = Year',
  `starts_at` datetime NOT NULL,
  `ends_at` datetime NOT NULL,
  `trial_ends_at` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscription_plans`
--

CREATE TABLE `subscription_plans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `currency` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'usd',
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(8,2) DEFAULT '0.00',
  `frequency` int(11) NOT NULL DEFAULT '1' COMMENT '1 = Month, 2 = Year',
  `is_default` int(11) NOT NULL DEFAULT '0',
  `trial_days` int(11) NOT NULL DEFAULT '0' COMMENT 'Default validity will be 7 trial days',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscription_plans`
--

INSERT INTO `subscription_plans` (`id`, `currency`, `name`, `price`, `frequency`, `is_default`, `trial_days`, `created_at`, `updated_at`) VALUES
(1, 'usd', 'Standard', 10.00, 1, 1, 7, '2022-02-11 23:58:15', '2022-02-11 23:58:15');

-- --------------------------------------------------------

--
-- Table structure for table `super_admin_enquiries`
--

CREATE TABLE `super_admin_enquiries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `super_admin_settings`
--

CREATE TABLE `super_admin_settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `super_admin_settings`
--

INSERT INTO `super_admin_settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'app_name', 'InfyHMS', '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(2, 'app_logo', 'http://127.0.0.1:8000/web/img/hms-saas-logo.png', '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(3, 'favicon', 'http://127.0.0.1:8000/web/img/hms-saas-favicon.ico', '2022-02-11 23:58:14', '2022-02-11 23:58:14'),
(4, 'footer_text', 'Over past 10+ years of experience and skills in various technologies, we built great scalable products. Whatever technology we worked with, we just not build products for our clients but we a', '2022-02-11 23:58:15', '2022-02-11 23:58:15'),
(5, 'address', '423B, Road Wordwide Country, USA', '2022-02-11 23:58:15', '2022-02-11 23:58:15'),
(6, 'email', 'admin@hms.com', '2022-02-11 23:58:15', '2022-02-11 23:58:15'),
(7, 'phone', '+91 2345678900', '2022-02-11 23:58:15', '2022-02-11 23:58:15'),
(8, 'facebook_url', 'https://www.facebook.com/infyom/', '2022-02-11 23:58:15', '2022-02-11 23:58:15'),
(9, 'twitter_url', 'https://twitter.com/infyom?lang=en', '2022-02-11 23:58:15', '2022-02-11 23:58:15'),
(10, 'instagram_url', 'https://www.instagram.com/?hl=en', '2022-02-11 23:58:15', '2022-02-11 23:58:15'),
(11, 'linkedin_url', 'https://www.linkedin.com/organization-guest/company/infyom-technologies?challengeId=AQFgQaMxwSxCdAAAAXOA_wosiB2vYdQEoITs6w676AzV8cu8OzhnWEBNUQ7LCG4vds5-A12UIQk1M4aWfKmn6iM58OFJbpoRiA&submissi', '2022-02-11 23:58:15', '2022-02-11 23:58:15'),
(12, 'plan_expire_notification', '6', '2022-02-11 23:58:15', '2022-02-11 23:58:15');

-- --------------------------------------------------------

--
-- Table structure for table `tenants`
--

CREATE TABLE `tenants` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tenant_username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hospital_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `data` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tenant_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transaction_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_type` int(11) NOT NULL COMMENT '1 = Stripe, 2 = Paypal',
  `amount` double(8,2) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta` text COLLATE utf8mb4_unicode_ci,
  `tenant_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` int(11) NOT NULL,
  `qualification` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blood_group` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `owner_id` int(11) DEFAULT NULL,
  `owner_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `language` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en',
  `username` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hospital_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tenant_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedIn_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `department_id`, `first_name`, `last_name`, `email`, `password`, `designation`, `phone`, `gender`, `qualification`, `blood_group`, `dob`, `email_verified_at`, `owner_id`, `owner_type`, `status`, `language`, `username`, `hospital_name`, `tenant_id`, `remember_token`, `facebook_url`, `twitter_url`, `instagram_url`, `linkedIn_url`, `created_at`, `updated_at`) VALUES
(1, 10, 'Super', 'Admin', 'admin@hms.com', '$2y$10$IC5s2ngxTVTrWUS6It17.O7gqlr/Eal8yFTsO2G7.RC5LNuXHTnUq', NULL, '7878454512', 1, NULL, 'B+', '1994-12-12', '2022-02-11 23:58:13', NULL, NULL, 1, 'en', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '2022-02-11 23:58:13', '2022-02-11 23:58:13');

-- --------------------------------------------------------

--
-- Table structure for table `user_tenants`
--

CREATE TABLE `user_tenants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `tenant_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_login_at` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_zoom_credential`
--

CREATE TABLE `user_zoom_credential` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `zoom_api_key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zoom_api_secret` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tenant_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vaccinated_patients`
--

CREATE TABLE `vaccinated_patients` (
  `id` int(10) UNSIGNED NOT NULL,
  `patient_id` int(10) UNSIGNED NOT NULL,
  `vaccination_id` int(10) UNSIGNED NOT NULL,
  `vaccination_serial_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dose_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dose_given_date` datetime NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `tenant_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vaccinations`
--

CREATE TABLE `vaccinations` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `manufactured_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tenant_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

CREATE TABLE `visitors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `purpose` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_card` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_of_person` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `in_time` time DEFAULT NULL,
  `out_time` time DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `tenant_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accountants`
--
ALTER TABLE `accountants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `accountants_tenant_id_foreign` (`tenant_id`),
  ADD KEY `accountants_user_id_foreign` (`user_id`);

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `accounts_tenant_id_foreign` (`tenant_id`),
  ADD KEY `accounts_name_index` (`name`);

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `addresses_tenant_id_foreign` (`tenant_id`);

--
-- Indexes for table `admin_testimonials`
--
ALTER TABLE `admin_testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `advanced_payments`
--
ALTER TABLE `advanced_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `advanced_payments_tenant_id_foreign` (`tenant_id`),
  ADD KEY `advanced_payments_patient_id_foreign` (`patient_id`),
  ADD KEY `advanced_payments_amount_index` (`amount`);

--
-- Indexes for table `ambulances`
--
ALTER TABLE `ambulances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ambulances_tenant_id_foreign` (`tenant_id`),
  ADD KEY `ambulances_vehicle_number_index` (`vehicle_number`);

--
-- Indexes for table `ambulance_calls`
--
ALTER TABLE `ambulance_calls`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ambulance_calls_tenant_id_foreign` (`tenant_id`),
  ADD KEY `ambulance_calls_patient_id_foreign` (`patient_id`),
  ADD KEY `ambulance_calls_ambulance_id_foreign` (`ambulance_id`),
  ADD KEY `ambulance_calls_date_index` (`date`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `appointments_tenant_id_foreign` (`tenant_id`),
  ADD KEY `appointments_doctor_id_foreign` (`doctor_id`),
  ADD KEY `appointments_opd_date_index` (`opd_date`),
  ADD KEY `appointments_patient_id_foreign` (`patient_id`),
  ADD KEY `appointments_department_id_foreign` (`department_id`);

--
-- Indexes for table `beds`
--
ALTER TABLE `beds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `beds_tenant_id_foreign` (`tenant_id`),
  ADD KEY `beds_bed_type_foreign` (`bed_type`),
  ADD KEY `beds_is_available_index` (`is_available`);

--
-- Indexes for table `bed_assigns`
--
ALTER TABLE `bed_assigns`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bed_assigns_tenant_id_foreign` (`tenant_id`),
  ADD KEY `bed_assigns_bed_id_foreign` (`bed_id`),
  ADD KEY `bed_assigns_patient_id_foreign` (`patient_id`),
  ADD KEY `bed_assigns_created_at_assign_date_index` (`created_at`,`assign_date`),
  ADD KEY `bed_assigns_ipd_patient_department_id_foreign` (`ipd_patient_department_id`);

--
-- Indexes for table `bed_types`
--
ALTER TABLE `bed_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bed_types_tenant_id_foreign` (`tenant_id`),
  ADD KEY `bed_types_title_index` (`title`);

--
-- Indexes for table `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bills_tenant_id_foreign` (`tenant_id`),
  ADD KEY `bills_patient_id_foreign` (`patient_id`),
  ADD KEY `bills_bill_date_index` (`bill_date`);

--
-- Indexes for table `bill_items`
--
ALTER TABLE `bill_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bill_items_bill_id_foreign` (`bill_id`);

--
-- Indexes for table `birth_reports`
--
ALTER TABLE `birth_reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `birth_reports_tenant_id_foreign` (`tenant_id`),
  ADD KEY `birth_reports_patient_id_foreign` (`patient_id`),
  ADD KEY `birth_reports_doctor_id_foreign` (`doctor_id`),
  ADD KEY `birth_reports_date_index` (`date`);

--
-- Indexes for table `blood_banks`
--
ALTER TABLE `blood_banks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blood_banks_tenant_id_foreign` (`tenant_id`),
  ADD KEY `blood_banks_remained_bags_index` (`remained_bags`);

--
-- Indexes for table `blood_donations`
--
ALTER TABLE `blood_donations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blood_donations_tenant_id_foreign` (`tenant_id`),
  ADD KEY `blood_donations_blood_donor_id_foreign` (`blood_donor_id`);

--
-- Indexes for table `blood_donors`
--
ALTER TABLE `blood_donors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blood_donors_tenant_id_foreign` (`tenant_id`),
  ADD KEY `blood_donors_created_at_last_donate_date_index` (`created_at`,`last_donate_date`);

--
-- Indexes for table `blood_issues`
--
ALTER TABLE `blood_issues`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blood_issues_tenant_id_foreign` (`tenant_id`),
  ADD KEY `blood_issues_doctor_id_foreign` (`doctor_id`),
  ADD KEY `blood_issues_donor_id_foreign` (`donor_id`),
  ADD KEY `blood_issues_patient_id_foreign` (`patient_id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD KEY `brands_tenant_id_foreign` (`tenant_id`),
  ADD KEY `brands_name_index` (`name`);

--
-- Indexes for table `call_logs`
--
ALTER TABLE `call_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `call_logs_tenant_id_foreign` (`tenant_id`);

--
-- Indexes for table `case_handlers`
--
ALTER TABLE `case_handlers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `case_handlers_tenant_id_foreign` (`tenant_id`),
  ADD KEY `case_handlers_user_id_foreign` (`user_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_tenant_id_foreign` (`tenant_id`),
  ADD KEY `categories_name_index` (`name`);

--
-- Indexes for table `charges`
--
ALTER TABLE `charges`
  ADD PRIMARY KEY (`id`),
  ADD KEY `charges_tenant_id_foreign` (`tenant_id`),
  ADD KEY `charges_charge_category_id_foreign` (`charge_category_id`),
  ADD KEY `charges_code_index` (`code`);

--
-- Indexes for table `charge_categories`
--
ALTER TABLE `charge_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `charge_categories_tenant_id_foreign` (`tenant_id`),
  ADD KEY `charge_categories_name_index` (`name`);

--
-- Indexes for table `death_reports`
--
ALTER TABLE `death_reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `death_reports_tenant_id_foreign` (`tenant_id`),
  ADD KEY `death_reports_patient_id_foreign` (`patient_id`),
  ADD KEY `death_reports_doctor_id_foreign` (`doctor_id`),
  ADD KEY `death_reports_date_index` (`date`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `diagnosis_categories`
--
ALTER TABLE `diagnosis_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `diagnosis_categories_name_index` (`name`),
  ADD KEY `diagnosis_categories_tenant_id_foreign` (`tenant_id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctors_user_id_foreign` (`user_id`),
  ADD KEY `doctors_tenant_id_foreign` (`tenant_id`),
  ADD KEY `doctors_doctor_department_id_foreign` (`doctor_department_id`);

--
-- Indexes for table `doctor_departments`
--
ALTER TABLE `doctor_departments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctor_departments_tenant_id_foreign` (`tenant_id`),
  ADD KEY `doctor_departments_title_index` (`title`);

--
-- Indexes for table `doctor_opd_charges`
--
ALTER TABLE `doctor_opd_charges`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctor_opd_charges_tenant_id_foreign` (`tenant_id`),
  ADD KEY `doctor_opd_charges_doctor_id_foreign` (`doctor_id`),
  ADD KEY `doctor_opd_charges_created_at_index` (`created_at`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `documents_tenant_id_foreign` (`tenant_id`),
  ADD KEY `documents_uploaded_by_foreign` (`uploaded_by`);

--
-- Indexes for table `document_types`
--
ALTER TABLE `document_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `document_types_tenant_id_foreign` (`tenant_id`),
  ADD KEY `document_types_name_index` (`name`);

--
-- Indexes for table `domains`
--
ALTER TABLE `domains`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `domains_domain_unique` (`domain`),
  ADD KEY `domains_tenant_id_foreign` (`tenant_id`);

--
-- Indexes for table `employee_payrolls`
--
ALTER TABLE `employee_payrolls`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_payrolls_tenant_id_foreign` (`tenant_id`),
  ADD KEY `employee_payrolls_id_sr_no_index` (`id`,`sr_no`);

--
-- Indexes for table `enquiries`
--
ALTER TABLE `enquiries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `enquiries_tenant_id_foreign` (`tenant_id`),
  ADD KEY `enquiries_viewed_by_foreign` (`viewed_by`),
  ADD KEY `enquiries_created_at_index` (`created_at`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `expenses_tenant_id_foreign` (`tenant_id`),
  ADD KEY `expenses_date_index` (`date`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `features_name_unique` (`name`),
  ADD KEY `features_name_submenu_has_parent_is_default_index` (`name`,`submenu`,`has_parent`,`is_default`);

--
-- Indexes for table `feature_subscriptionplan`
--
ALTER TABLE `feature_subscriptionplan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `feature_subscriptionplan_feature_id_subscription_plan_id_index` (`feature_id`,`subscription_plan_id`),
  ADD KEY `feature_subscriptionplan_subscription_plan_id_foreign` (`subscription_plan_id`);

--
-- Indexes for table `front_services`
--
ALTER TABLE `front_services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `front_services_tenant_id_foreign` (`tenant_id`);

--
-- Indexes for table `front_settings`
--
ALTER TABLE `front_settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `front_settings_tenant_id_foreign` (`tenant_id`);

--
-- Indexes for table `hospital_schedules`
--
ALTER TABLE `hospital_schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hospital_schedules_tenant_id_foreign` (`tenant_id`);

--
-- Indexes for table `incomes`
--
ALTER TABLE `incomes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `incomes_tenant_id_foreign` (`tenant_id`),
  ADD KEY `incomes_date_index` (`date`);

--
-- Indexes for table `insurances`
--
ALTER TABLE `insurances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `insurances_tenant_id_foreign` (`tenant_id`),
  ADD KEY `insurances_name_index` (`name`);

--
-- Indexes for table `insurance_diseases`
--
ALTER TABLE `insurance_diseases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `insurance_diseases_insurance_id_foreign` (`insurance_id`);

--
-- Indexes for table `investigation_reports`
--
ALTER TABLE `investigation_reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `investigation_reports_tenant_id_foreign` (`tenant_id`),
  ADD KEY `investigation_reports_patient_id_foreign` (`patient_id`),
  ADD KEY `investigation_reports_doctor_id_foreign` (`doctor_id`),
  ADD KEY `investigation_reports_date_index` (`date`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoices_tenant_id_foreign` (`tenant_id`),
  ADD KEY `invoices_patient_id_foreign` (`patient_id`),
  ADD KEY `invoices_invoice_date_index` (`invoice_date`);

--
-- Indexes for table `invoice_items`
--
ALTER TABLE `invoice_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_items_account_id_foreign` (`account_id`),
  ADD KEY `invoice_items_invoice_id_foreign` (`invoice_id`);

--
-- Indexes for table `ipd_bills`
--
ALTER TABLE `ipd_bills`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ipd_bills_tenant_id_foreign` (`tenant_id`),
  ADD KEY `ipd_bills_ipd_patient_department_id_foreign` (`ipd_patient_department_id`);

--
-- Indexes for table `ipd_charges`
--
ALTER TABLE `ipd_charges`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ipd_charges_tenant_id_foreign` (`tenant_id`),
  ADD KEY `ipd_charges_ipd_patient_department_id_foreign` (`ipd_patient_department_id`),
  ADD KEY `ipd_charges_charge_category_id_foreign` (`charge_category_id`),
  ADD KEY `ipd_charges_charge_id_foreign` (`charge_id`);

--
-- Indexes for table `ipd_consultant_registers`
--
ALTER TABLE `ipd_consultant_registers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ipd_consultant_registers_tenant_id_foreign` (`tenant_id`),
  ADD KEY `ipd_consultant_registers_ipd_patient_department_id_foreign` (`ipd_patient_department_id`),
  ADD KEY `ipd_consultant_registers_doctor_id_foreign` (`doctor_id`);

--
-- Indexes for table `ipd_diagnoses`
--
ALTER TABLE `ipd_diagnoses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ipd_diagnoses_tenant_id_foreign` (`tenant_id`),
  ADD KEY `ipd_diagnoses_ipd_patient_department_id_foreign` (`ipd_patient_department_id`);

--
-- Indexes for table `ipd_patient_departments`
--
ALTER TABLE `ipd_patient_departments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ipd_patient_departments_ipd_number_unique` (`ipd_number`),
  ADD KEY `ipd_patient_departments_tenant_id_foreign` (`tenant_id`),
  ADD KEY `ipd_patient_departments_patient_id_foreign` (`patient_id`),
  ADD KEY `ipd_patient_departments_case_id_foreign` (`case_id`),
  ADD KEY `ipd_patient_departments_doctor_id_foreign` (`doctor_id`),
  ADD KEY `ipd_patient_departments_bed_type_id_foreign` (`bed_type_id`),
  ADD KEY `ipd_patient_departments_bed_id_foreign` (`bed_id`);

--
-- Indexes for table `ipd_payments`
--
ALTER TABLE `ipd_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ipd_payments_tenant_id_foreign` (`tenant_id`),
  ADD KEY `ipd_payments_ipd_patient_department_id_foreign` (`ipd_patient_department_id`);

--
-- Indexes for table `ipd_prescriptions`
--
ALTER TABLE `ipd_prescriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ipd_prescriptions_tenant_id_foreign` (`tenant_id`),
  ADD KEY `ipd_prescriptions_ipd_patient_department_id_foreign` (`ipd_patient_department_id`);

--
-- Indexes for table `ipd_prescription_items`
--
ALTER TABLE `ipd_prescription_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ipd_prescription_items_tenant_id_foreign` (`tenant_id`),
  ADD KEY `ipd_prescription_items_ipd_prescription_id_foreign` (`ipd_prescription_id`),
  ADD KEY `ipd_prescription_items_category_id_foreign` (`category_id`),
  ADD KEY `ipd_prescription_items_medicine_id_foreign` (`medicine_id`);

--
-- Indexes for table `ipd_timelines`
--
ALTER TABLE `ipd_timelines`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ipd_timelines_tenant_id_foreign` (`tenant_id`),
  ADD KEY `ipd_timelines_ipd_patient_department_id_foreign` (`ipd_patient_department_id`);

--
-- Indexes for table `issued_items`
--
ALTER TABLE `issued_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `issued_items_tenant_id_foreign` (`tenant_id`),
  ADD KEY `issued_items_department_id_foreign` (`department_id`),
  ADD KEY `issued_items_user_id_foreign` (`user_id`),
  ADD KEY `issued_items_item_category_id_foreign` (`item_category_id`),
  ADD KEY `issued_items_item_id_foreign` (`item_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `items_tenant_id_foreign` (`tenant_id`),
  ADD KEY `items_item_category_id_foreign` (`item_category_id`);

--
-- Indexes for table `item_categories`
--
ALTER TABLE `item_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `item_categories_name_unique` (`name`),
  ADD KEY `item_categories_tenant_id_foreign` (`tenant_id`);

--
-- Indexes for table `item_stocks`
--
ALTER TABLE `item_stocks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_stocks_tenant_id_foreign` (`tenant_id`),
  ADD KEY `item_stocks_item_category_id_foreign` (`item_category_id`),
  ADD KEY `item_stocks_item_id_foreign` (`item_id`);

--
-- Indexes for table `lab_technicians`
--
ALTER TABLE `lab_technicians`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lab_technicians_tenant_id_foreign` (`tenant_id`),
  ADD KEY `lab_technicians_user_id_foreign` (`user_id`);

--
-- Indexes for table `landing_about_us`
--
ALTER TABLE `landing_about_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `live_consultations`
--
ALTER TABLE `live_consultations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `live_consultations_tenant_id_foreign` (`tenant_id`),
  ADD KEY `live_consultations_doctor_id_foreign` (`doctor_id`),
  ADD KEY `live_consultations_patient_id_foreign` (`patient_id`);

--
-- Indexes for table `live_meetings`
--
ALTER TABLE `live_meetings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `live_meetings_tenant_id_foreign` (`tenant_id`);

--
-- Indexes for table `live_meetings_candidates`
--
ALTER TABLE `live_meetings_candidates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mails`
--
ALTER TABLE `mails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mails_tenant_id_foreign` (`tenant_id`),
  ADD KEY `mails_user_id_foreign` (`user_id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `media_uuid_unique` (`uuid`),
  ADD KEY `media_model_type_model_id_index` (`model_type`,`model_id`);

--
-- Indexes for table `medicines`
--
ALTER TABLE `medicines`
  ADD PRIMARY KEY (`id`),
  ADD KEY `medicines_tenant_id_foreign` (`tenant_id`),
  ADD KEY `medicines_category_id_foreign` (`category_id`),
  ADD KEY `medicines_brand_id_foreign` (`brand_id`),
  ADD KEY `medicines_name_index` (`name`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modules_tenant_id_foreign` (`tenant_id`);

--
-- Indexes for table `notice_boards`
--
ALTER TABLE `notice_boards`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notice_boards_tenant_id_foreign` (`tenant_id`),
  ADD KEY `notice_boards_created_at_id_index` (`created_at`,`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_tenant_id_foreign` (`tenant_id`),
  ADD KEY `notifications_user_id_foreign` (`user_id`);

--
-- Indexes for table `nurses`
--
ALTER TABLE `nurses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nurses_tenant_id_foreign` (`tenant_id`),
  ADD KEY `nurses_user_id_foreign` (`user_id`);

--
-- Indexes for table `opd_diagnoses`
--
ALTER TABLE `opd_diagnoses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `opd_diagnoses_tenant_id_foreign` (`tenant_id`),
  ADD KEY `opd_diagnoses_opd_patient_department_id_foreign` (`opd_patient_department_id`);

--
-- Indexes for table `opd_patient_departments`
--
ALTER TABLE `opd_patient_departments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `opd_patient_departments_opd_number_unique` (`opd_number`),
  ADD KEY `opd_patient_departments_tenant_id_foreign` (`tenant_id`),
  ADD KEY `opd_patient_departments_patient_id_foreign` (`patient_id`),
  ADD KEY `opd_patient_departments_case_id_foreign` (`case_id`),
  ADD KEY `opd_patient_departments_doctor_id_foreign` (`doctor_id`);

--
-- Indexes for table `opd_timelines`
--
ALTER TABLE `opd_timelines`
  ADD PRIMARY KEY (`id`),
  ADD KEY `opd_timelines_tenant_id_foreign` (`tenant_id`),
  ADD KEY `opd_timelines_opd_patient_department_id_foreign` (`opd_patient_department_id`);

--
-- Indexes for table `operation_reports`
--
ALTER TABLE `operation_reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `operation_reports_tenant_id_foreign` (`tenant_id`),
  ADD KEY `operation_reports_doctor_id_foreign` (`doctor_id`),
  ADD KEY `operation_reports_patient_id_foreign` (`patient_id`),
  ADD KEY `operation_reports_date_index` (`date`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `packages_tenant_id_foreign` (`tenant_id`),
  ADD KEY `packages_created_at_name_index` (`created_at`,`name`);

--
-- Indexes for table `package_services`
--
ALTER TABLE `package_services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `package_services_package_id_foreign` (`package_id`),
  ADD KEY `package_services_service_id_foreign` (`service_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pathology_categories`
--
ALTER TABLE `pathology_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pathology_categories_tenant_id_foreign` (`tenant_id`),
  ADD KEY `pathology_categories_name_index` (`name`);

--
-- Indexes for table `pathology_tests`
--
ALTER TABLE `pathology_tests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pathology_tests_tenant_id_foreign` (`tenant_id`),
  ADD KEY `pathology_tests_category_id_foreign` (`category_id`),
  ADD KEY `pathology_tests_charge_category_id_foreign` (`charge_category_id`),
  ADD KEY `pathology_tests_test_name_index` (`test_name`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patients_tenant_id_foreign` (`tenant_id`),
  ADD KEY `patients_user_id_foreign` (`user_id`);

--
-- Indexes for table `patient_admissions`
--
ALTER TABLE `patient_admissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `patient_admissions_patient_admission_id_unique` (`patient_admission_id`),
  ADD KEY `patient_admissions_tenant_id_foreign` (`tenant_id`),
  ADD KEY `patient_admissions_patient_id_foreign` (`patient_id`),
  ADD KEY `patient_admissions_doctor_id_foreign` (`doctor_id`),
  ADD KEY `patient_admissions_package_id_foreign` (`package_id`),
  ADD KEY `patient_admissions_insurance_id_foreign` (`insurance_id`),
  ADD KEY `patient_admissions_bed_id_foreign` (`bed_id`),
  ADD KEY `patient_admissions_admission_date_index` (`admission_date`);

--
-- Indexes for table `patient_cases`
--
ALTER TABLE `patient_cases`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `patient_cases_case_id_unique` (`case_id`),
  ADD KEY `patient_cases_tenant_id_foreign` (`tenant_id`),
  ADD KEY `patient_cases_patient_id_foreign` (`patient_id`),
  ADD KEY `patient_cases_doctor_id_foreign` (`doctor_id`),
  ADD KEY `patient_cases_date_index` (`date`);

--
-- Indexes for table `patient_diagnosis_properties`
--
ALTER TABLE `patient_diagnosis_properties`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_diagnosis_properties_created_at_index` (`created_at`),
  ADD KEY `patient_diagnosis_properties_patient_diagnosis_id_foreign` (`patient_diagnosis_id`);

--
-- Indexes for table `patient_diagnosis_tests`
--
ALTER TABLE `patient_diagnosis_tests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_diagnosis_tests_created_at_index` (`created_at`),
  ADD KEY `patient_diagnosis_tests_tenant_id_foreign` (`tenant_id`),
  ADD KEY `patient_diagnosis_tests_patient_id_foreign` (`patient_id`),
  ADD KEY `patient_diagnosis_tests_doctor_id_foreign` (`doctor_id`),
  ADD KEY `patient_diagnosis_tests_category_id_foreign` (`category_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_tenant_id_foreign` (`tenant_id`),
  ADD KEY `payments_account_id_foreign` (`account_id`),
  ADD KEY `payments_payment_date_index` (`payment_date`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pharmacists`
--
ALTER TABLE `pharmacists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pharmacists_tenant_id_foreign` (`tenant_id`),
  ADD KEY `pharmacists_user_id_foreign` (`user_id`);

--
-- Indexes for table `postals`
--
ALTER TABLE `postals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `postals_tenant_id_foreign` (`tenant_id`);

--
-- Indexes for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prescriptions_tenant_id_foreign` (`tenant_id`),
  ADD KEY `prescriptions_patient_id_foreign` (`patient_id`),
  ADD KEY `prescriptions_doctor_id_foreign` (`doctor_id`);

--
-- Indexes for table `radiology_categories`
--
ALTER TABLE `radiology_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `radiology_categories_tenant_id_foreign` (`tenant_id`),
  ADD KEY `radiology_categories_name_index` (`name`);

--
-- Indexes for table `radiology_tests`
--
ALTER TABLE `radiology_tests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `radiology_tests_tenant_id_foreign` (`tenant_id`),
  ADD KEY `radiology_tests_category_id_foreign` (`category_id`),
  ADD KEY `radiology_tests_charge_category_id_foreign` (`charge_category_id`),
  ADD KEY `radiology_tests_test_name_index` (`test_name`);

--
-- Indexes for table `receptionists`
--
ALTER TABLE `receptionists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `receptionists_tenant_id_foreign` (`tenant_id`),
  ADD KEY `receptionists_user_id_foreign` (`user_id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `schedules_tenant_id_foreign` (`tenant_id`),
  ADD KEY `schedules_doctor_id_foreign` (`doctor_id`);

--
-- Indexes for table `schedule_days`
--
ALTER TABLE `schedule_days`
  ADD PRIMARY KEY (`id`),
  ADD KEY `schedule_days_doctor_id_foreign` (`doctor_id`),
  ADD KEY `schedule_days_schedule_id_foreign` (`schedule_id`);

--
-- Indexes for table `section_fives`
--
ALTER TABLE `section_fives`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `section_fours`
--
ALTER TABLE `section_fours`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `section_ones`
--
ALTER TABLE `section_ones`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `section_threes`
--
ALTER TABLE `section_threes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `section_twos`
--
ALTER TABLE `section_twos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `services_tenant_id_foreign` (`tenant_id`),
  ADD KEY `services_name_index` (`name`);

--
-- Indexes for table `service_sliders`
--
ALTER TABLE `service_sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `settings_tenant_id_foreign` (`tenant_id`);

--
-- Indexes for table `sms`
--
ALTER TABLE `sms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sms_tenant_id_foreign` (`tenant_id`),
  ADD KEY `sms_send_to_foreign` (`send_to`),
  ADD KEY `sms_send_by_foreign` (`send_by`);

--
-- Indexes for table `subscribes`
--
ALTER TABLE `subscribes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subscribes_email_unique` (`email`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subscriptions_user_id_index` (`user_id`),
  ADD KEY `subscriptions_subscription_plan_id_index` (`subscription_plan_id`),
  ADD KEY `subscriptions_transaction_id_index` (`transaction_id`),
  ADD KEY `subscriptions_plan_amount_index` (`plan_amount`),
  ADD KEY `subscriptions_plan_frequency_index` (`plan_frequency`),
  ADD KEY `subscriptions_starts_at_index` (`starts_at`),
  ADD KEY `subscriptions_ends_at_index` (`ends_at`),
  ADD KEY `subscriptions_trial_ends_at_index` (`trial_ends_at`),
  ADD KEY `subscriptions_status_index` (`status`);

--
-- Indexes for table `subscription_plans`
--
ALTER TABLE `subscription_plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `super_admin_enquiries`
--
ALTER TABLE `super_admin_enquiries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `super_admin_settings`
--
ALTER TABLE `super_admin_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tenants`
--
ALTER TABLE `tenants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tenants_tenant_username_unique` (`tenant_username`),
  ADD UNIQUE KEY `tenants_hospital_name_unique` (`hospital_name`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `testimonials_tenant_id_foreign` (`tenant_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transactions_transaction_id_index` (`transaction_id`),
  ADD KEY `transactions_payment_type_index` (`payment_type`),
  ADD KEY `transactions_amount_index` (`amount`),
  ADD KEY `transactions_user_id_index` (`user_id`),
  ADD KEY `transactions_status_index` (`status`),
  ADD KEY `transactions_tenant_id_foreign` (`tenant_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD KEY `users_tenant_id_foreign` (`tenant_id`),
  ADD KEY `users_first_name_index` (`first_name`);

--
-- Indexes for table `user_tenants`
--
ALTER TABLE `user_tenants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_tenants_tenant_id_foreign` (`tenant_id`),
  ADD KEY `user_tenants_user_id_foreign` (`user_id`);

--
-- Indexes for table `user_zoom_credential`
--
ALTER TABLE `user_zoom_credential`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_zoom_credential_tenant_id_foreign` (`tenant_id`),
  ADD KEY `user_zoom_credential_user_id_foreign` (`user_id`);

--
-- Indexes for table `vaccinated_patients`
--
ALTER TABLE `vaccinated_patients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vaccinated_patients_tenant_id_foreign` (`tenant_id`),
  ADD KEY `vaccinated_patients_id_index` (`id`),
  ADD KEY `vaccinated_patients_patient_id_index` (`patient_id`),
  ADD KEY `vaccinated_patients_vaccination_id_index` (`vaccination_id`);

--
-- Indexes for table `vaccinations`
--
ALTER TABLE `vaccinations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vaccinations_tenant_id_foreign` (`tenant_id`),
  ADD KEY `vaccinations_id_index` (`id`);

--
-- Indexes for table `visitors`
--
ALTER TABLE `visitors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `visitors_tenant_id_foreign` (`tenant_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accountants`
--
ALTER TABLE `accountants`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin_testimonials`
--
ALTER TABLE `admin_testimonials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `advanced_payments`
--
ALTER TABLE `advanced_payments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ambulances`
--
ALTER TABLE `ambulances`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ambulance_calls`
--
ALTER TABLE `ambulance_calls`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `beds`
--
ALTER TABLE `beds`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bed_assigns`
--
ALTER TABLE `bed_assigns`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bed_types`
--
ALTER TABLE `bed_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bill_items`
--
ALTER TABLE `bill_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `birth_reports`
--
ALTER TABLE `birth_reports`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blood_banks`
--
ALTER TABLE `blood_banks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blood_donations`
--
ALTER TABLE `blood_donations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blood_donors`
--
ALTER TABLE `blood_donors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blood_issues`
--
ALTER TABLE `blood_issues`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `call_logs`
--
ALTER TABLE `call_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `case_handlers`
--
ALTER TABLE `case_handlers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `charges`
--
ALTER TABLE `charges`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `charge_categories`
--
ALTER TABLE `charge_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `death_reports`
--
ALTER TABLE `death_reports`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `diagnosis_categories`
--
ALTER TABLE `diagnosis_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doctor_departments`
--
ALTER TABLE `doctor_departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doctor_opd_charges`
--
ALTER TABLE `doctor_opd_charges`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `document_types`
--
ALTER TABLE `document_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `domains`
--
ALTER TABLE `domains`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee_payrolls`
--
ALTER TABLE `employee_payrolls`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `enquiries`
--
ALTER TABLE `enquiries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `feature_subscriptionplan`
--
ALTER TABLE `feature_subscriptionplan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `front_services`
--
ALTER TABLE `front_services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `front_settings`
--
ALTER TABLE `front_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `hospital_schedules`
--
ALTER TABLE `hospital_schedules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `incomes`
--
ALTER TABLE `incomes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `insurances`
--
ALTER TABLE `insurances`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `insurance_diseases`
--
ALTER TABLE `insurance_diseases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `investigation_reports`
--
ALTER TABLE `investigation_reports`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoice_items`
--
ALTER TABLE `invoice_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ipd_bills`
--
ALTER TABLE `ipd_bills`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ipd_charges`
--
ALTER TABLE `ipd_charges`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ipd_consultant_registers`
--
ALTER TABLE `ipd_consultant_registers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ipd_diagnoses`
--
ALTER TABLE `ipd_diagnoses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ipd_patient_departments`
--
ALTER TABLE `ipd_patient_departments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ipd_payments`
--
ALTER TABLE `ipd_payments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ipd_prescriptions`
--
ALTER TABLE `ipd_prescriptions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ipd_prescription_items`
--
ALTER TABLE `ipd_prescription_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ipd_timelines`
--
ALTER TABLE `ipd_timelines`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `issued_items`
--
ALTER TABLE `issued_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `item_categories`
--
ALTER TABLE `item_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `item_stocks`
--
ALTER TABLE `item_stocks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lab_technicians`
--
ALTER TABLE `lab_technicians`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `landing_about_us`
--
ALTER TABLE `landing_about_us`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `live_consultations`
--
ALTER TABLE `live_consultations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `live_meetings`
--
ALTER TABLE `live_meetings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `live_meetings_candidates`
--
ALTER TABLE `live_meetings_candidates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mails`
--
ALTER TABLE `mails`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `medicines`
--
ALTER TABLE `medicines`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=185;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `notice_boards`
--
ALTER TABLE `notice_boards`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nurses`
--
ALTER TABLE `nurses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `opd_diagnoses`
--
ALTER TABLE `opd_diagnoses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `opd_patient_departments`
--
ALTER TABLE `opd_patient_departments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `opd_timelines`
--
ALTER TABLE `opd_timelines`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `operation_reports`
--
ALTER TABLE `operation_reports`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `package_services`
--
ALTER TABLE `package_services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pathology_categories`
--
ALTER TABLE `pathology_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pathology_tests`
--
ALTER TABLE `pathology_tests`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patient_admissions`
--
ALTER TABLE `patient_admissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patient_cases`
--
ALTER TABLE `patient_cases`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patient_diagnosis_properties`
--
ALTER TABLE `patient_diagnosis_properties`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patient_diagnosis_tests`
--
ALTER TABLE `patient_diagnosis_tests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `pharmacists`
--
ALTER TABLE `pharmacists`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `postals`
--
ALTER TABLE `postals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prescriptions`
--
ALTER TABLE `prescriptions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `radiology_categories`
--
ALTER TABLE `radiology_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `radiology_tests`
--
ALTER TABLE `radiology_tests`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `receptionists`
--
ALTER TABLE `receptionists`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `schedule_days`
--
ALTER TABLE `schedule_days`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `section_fives`
--
ALTER TABLE `section_fives`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `section_fours`
--
ALTER TABLE `section_fours`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `section_ones`
--
ALTER TABLE `section_ones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `section_threes`
--
ALTER TABLE `section_threes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `section_twos`
--
ALTER TABLE `section_twos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `service_sliders`
--
ALTER TABLE `service_sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `sms`
--
ALTER TABLE `sms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscribes`
--
ALTER TABLE `subscribes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscription_plans`
--
ALTER TABLE `subscription_plans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `super_admin_enquiries`
--
ALTER TABLE `super_admin_enquiries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `super_admin_settings`
--
ALTER TABLE `super_admin_settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_tenants`
--
ALTER TABLE `user_tenants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_zoom_credential`
--
ALTER TABLE `user_zoom_credential`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vaccinated_patients`
--
ALTER TABLE `vaccinated_patients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vaccinations`
--
ALTER TABLE `vaccinations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accountants`
--
ALTER TABLE `accountants`
  ADD CONSTRAINT `accountants_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `accountants_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `accounts`
--
ALTER TABLE `accounts`
  ADD CONSTRAINT `accounts_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `addresses_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `advanced_payments`
--
ALTER TABLE `advanced_payments`
  ADD CONSTRAINT `advanced_payments_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `advanced_payments_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ambulances`
--
ALTER TABLE `ambulances`
  ADD CONSTRAINT `ambulances_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ambulance_calls`
--
ALTER TABLE `ambulance_calls`
  ADD CONSTRAINT `ambulance_calls_ambulance_id_foreign` FOREIGN KEY (`ambulance_id`) REFERENCES `ambulances` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ambulance_calls_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ambulance_calls_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `doctor_departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `appointments_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `appointments_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `appointments_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `beds`
--
ALTER TABLE `beds`
  ADD CONSTRAINT `beds_bed_type_foreign` FOREIGN KEY (`bed_type`) REFERENCES `bed_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `beds_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bed_assigns`
--
ALTER TABLE `bed_assigns`
  ADD CONSTRAINT `bed_assigns_bed_id_foreign` FOREIGN KEY (`bed_id`) REFERENCES `beds` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bed_assigns_ipd_patient_department_id_foreign` FOREIGN KEY (`ipd_patient_department_id`) REFERENCES `ipd_patient_departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bed_assigns_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bed_assigns_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bed_types`
--
ALTER TABLE `bed_types`
  ADD CONSTRAINT `bed_types_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bills`
--
ALTER TABLE `bills`
  ADD CONSTRAINT `bills_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bills_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bill_items`
--
ALTER TABLE `bill_items`
  ADD CONSTRAINT `bill_items_bill_id_foreign` FOREIGN KEY (`bill_id`) REFERENCES `bills` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `birth_reports`
--
ALTER TABLE `birth_reports`
  ADD CONSTRAINT `birth_reports_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `birth_reports_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `birth_reports_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `blood_banks`
--
ALTER TABLE `blood_banks`
  ADD CONSTRAINT `blood_banks_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `blood_donations`
--
ALTER TABLE `blood_donations`
  ADD CONSTRAINT `blood_donations_blood_donor_id_foreign` FOREIGN KEY (`blood_donor_id`) REFERENCES `blood_donors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `blood_donations_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `blood_donors`
--
ALTER TABLE `blood_donors`
  ADD CONSTRAINT `blood_donors_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `blood_issues`
--
ALTER TABLE `blood_issues`
  ADD CONSTRAINT `blood_issues_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `blood_issues_donor_id_foreign` FOREIGN KEY (`donor_id`) REFERENCES `blood_donors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `blood_issues_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `blood_issues_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `brands`
--
ALTER TABLE `brands`
  ADD CONSTRAINT `brands_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `call_logs`
--
ALTER TABLE `call_logs`
  ADD CONSTRAINT `call_logs_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `case_handlers`
--
ALTER TABLE `case_handlers`
  ADD CONSTRAINT `case_handlers_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `case_handlers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `charges`
--
ALTER TABLE `charges`
  ADD CONSTRAINT `charges_charge_category_id_foreign` FOREIGN KEY (`charge_category_id`) REFERENCES `charge_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `charges_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `charge_categories`
--
ALTER TABLE `charge_categories`
  ADD CONSTRAINT `charge_categories_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `death_reports`
--
ALTER TABLE `death_reports`
  ADD CONSTRAINT `death_reports_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `death_reports_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `death_reports_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `diagnosis_categories`
--
ALTER TABLE `diagnosis_categories`
  ADD CONSTRAINT `diagnosis_categories_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `doctors`
--
ALTER TABLE `doctors`
  ADD CONSTRAINT `doctors_doctor_department_id_foreign` FOREIGN KEY (`doctor_department_id`) REFERENCES `doctor_departments` (`id`),
  ADD CONSTRAINT `doctors_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `doctors_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `doctor_departments`
--
ALTER TABLE `doctor_departments`
  ADD CONSTRAINT `doctor_departments_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `doctor_opd_charges`
--
ALTER TABLE `doctor_opd_charges`
  ADD CONSTRAINT `doctor_opd_charges_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `doctor_opd_charges_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `documents`
--
ALTER TABLE `documents`
  ADD CONSTRAINT `documents_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `documents_uploaded_by_foreign` FOREIGN KEY (`uploaded_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `document_types`
--
ALTER TABLE `document_types`
  ADD CONSTRAINT `document_types_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `domains`
--
ALTER TABLE `domains`
  ADD CONSTRAINT `domains_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employee_payrolls`
--
ALTER TABLE `employee_payrolls`
  ADD CONSTRAINT `employee_payrolls_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `enquiries`
--
ALTER TABLE `enquiries`
  ADD CONSTRAINT `enquiries_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `enquiries_viewed_by_foreign` FOREIGN KEY (`viewed_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `expenses`
--
ALTER TABLE `expenses`
  ADD CONSTRAINT `expenses_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `feature_subscriptionplan`
--
ALTER TABLE `feature_subscriptionplan`
  ADD CONSTRAINT `feature_subscriptionplan_feature_id_foreign` FOREIGN KEY (`feature_id`) REFERENCES `features` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `feature_subscriptionplan_subscription_plan_id_foreign` FOREIGN KEY (`subscription_plan_id`) REFERENCES `subscription_plans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `front_services`
--
ALTER TABLE `front_services`
  ADD CONSTRAINT `front_services_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `front_settings`
--
ALTER TABLE `front_settings`
  ADD CONSTRAINT `front_settings_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `hospital_schedules`
--
ALTER TABLE `hospital_schedules`
  ADD CONSTRAINT `hospital_schedules_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `incomes`
--
ALTER TABLE `incomes`
  ADD CONSTRAINT `incomes_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `insurances`
--
ALTER TABLE `insurances`
  ADD CONSTRAINT `insurances_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `insurance_diseases`
--
ALTER TABLE `insurance_diseases`
  ADD CONSTRAINT `insurance_diseases_insurance_id_foreign` FOREIGN KEY (`insurance_id`) REFERENCES `insurances` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `investigation_reports`
--
ALTER TABLE `investigation_reports`
  ADD CONSTRAINT `investigation_reports_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `investigation_reports_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `investigation_reports_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `invoices_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `invoice_items`
--
ALTER TABLE `invoice_items`
  ADD CONSTRAINT `invoice_items_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `invoice_items_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ipd_bills`
--
ALTER TABLE `ipd_bills`
  ADD CONSTRAINT `ipd_bills_ipd_patient_department_id_foreign` FOREIGN KEY (`ipd_patient_department_id`) REFERENCES `ipd_patient_departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ipd_bills_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ipd_charges`
--
ALTER TABLE `ipd_charges`
  ADD CONSTRAINT `ipd_charges_charge_category_id_foreign` FOREIGN KEY (`charge_category_id`) REFERENCES `charge_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ipd_charges_charge_id_foreign` FOREIGN KEY (`charge_id`) REFERENCES `charges` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ipd_charges_ipd_patient_department_id_foreign` FOREIGN KEY (`ipd_patient_department_id`) REFERENCES `ipd_patient_departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ipd_charges_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ipd_consultant_registers`
--
ALTER TABLE `ipd_consultant_registers`
  ADD CONSTRAINT `ipd_consultant_registers_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ipd_consultant_registers_ipd_patient_department_id_foreign` FOREIGN KEY (`ipd_patient_department_id`) REFERENCES `ipd_patient_departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ipd_consultant_registers_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ipd_diagnoses`
--
ALTER TABLE `ipd_diagnoses`
  ADD CONSTRAINT `ipd_diagnoses_ipd_patient_department_id_foreign` FOREIGN KEY (`ipd_patient_department_id`) REFERENCES `ipd_patient_departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ipd_diagnoses_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ipd_patient_departments`
--
ALTER TABLE `ipd_patient_departments`
  ADD CONSTRAINT `ipd_patient_departments_bed_id_foreign` FOREIGN KEY (`bed_id`) REFERENCES `beds` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ipd_patient_departments_bed_type_id_foreign` FOREIGN KEY (`bed_type_id`) REFERENCES `bed_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ipd_patient_departments_case_id_foreign` FOREIGN KEY (`case_id`) REFERENCES `patient_cases` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ipd_patient_departments_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ipd_patient_departments_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ipd_patient_departments_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ipd_payments`
--
ALTER TABLE `ipd_payments`
  ADD CONSTRAINT `ipd_payments_ipd_patient_department_id_foreign` FOREIGN KEY (`ipd_patient_department_id`) REFERENCES `ipd_patient_departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ipd_payments_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ipd_prescriptions`
--
ALTER TABLE `ipd_prescriptions`
  ADD CONSTRAINT `ipd_prescriptions_ipd_patient_department_id_foreign` FOREIGN KEY (`ipd_patient_department_id`) REFERENCES `ipd_patient_departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ipd_prescriptions_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ipd_prescription_items`
--
ALTER TABLE `ipd_prescription_items`
  ADD CONSTRAINT `ipd_prescription_items_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ipd_prescription_items_ipd_prescription_id_foreign` FOREIGN KEY (`ipd_prescription_id`) REFERENCES `ipd_prescriptions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ipd_prescription_items_medicine_id_foreign` FOREIGN KEY (`medicine_id`) REFERENCES `medicines` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ipd_prescription_items_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ipd_timelines`
--
ALTER TABLE `ipd_timelines`
  ADD CONSTRAINT `ipd_timelines_ipd_patient_department_id_foreign` FOREIGN KEY (`ipd_patient_department_id`) REFERENCES `ipd_patient_departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ipd_timelines_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `issued_items`
--
ALTER TABLE `issued_items`
  ADD CONSTRAINT `issued_items_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `issued_items_item_category_id_foreign` FOREIGN KEY (`item_category_id`) REFERENCES `item_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `issued_items_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `issued_items_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `issued_items_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_item_category_id_foreign` FOREIGN KEY (`item_category_id`) REFERENCES `item_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `items_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `item_categories`
--
ALTER TABLE `item_categories`
  ADD CONSTRAINT `item_categories_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `item_stocks`
--
ALTER TABLE `item_stocks`
  ADD CONSTRAINT `item_stocks_item_category_id_foreign` FOREIGN KEY (`item_category_id`) REFERENCES `item_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `item_stocks_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `item_stocks_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lab_technicians`
--
ALTER TABLE `lab_technicians`
  ADD CONSTRAINT `lab_technicians_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lab_technicians_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `live_consultations`
--
ALTER TABLE `live_consultations`
  ADD CONSTRAINT `live_consultations_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `live_consultations_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `live_consultations_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `live_meetings`
--
ALTER TABLE `live_meetings`
  ADD CONSTRAINT `live_meetings_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mails`
--
ALTER TABLE `mails`
  ADD CONSTRAINT `mails_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mails_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `medicines`
--
ALTER TABLE `medicines`
  ADD CONSTRAINT `medicines_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `medicines_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `medicines_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `modules`
--
ALTER TABLE `modules`
  ADD CONSTRAINT `modules_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notice_boards`
--
ALTER TABLE `notice_boards`
  ADD CONSTRAINT `notice_boards_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `nurses`
--
ALTER TABLE `nurses`
  ADD CONSTRAINT `nurses_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nurses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `opd_diagnoses`
--
ALTER TABLE `opd_diagnoses`
  ADD CONSTRAINT `opd_diagnoses_opd_patient_department_id_foreign` FOREIGN KEY (`opd_patient_department_id`) REFERENCES `opd_patient_departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `opd_diagnoses_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `opd_patient_departments`
--
ALTER TABLE `opd_patient_departments`
  ADD CONSTRAINT `opd_patient_departments_case_id_foreign` FOREIGN KEY (`case_id`) REFERENCES `patient_cases` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `opd_patient_departments_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `opd_patient_departments_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `opd_patient_departments_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `opd_timelines`
--
ALTER TABLE `opd_timelines`
  ADD CONSTRAINT `opd_timelines_opd_patient_department_id_foreign` FOREIGN KEY (`opd_patient_department_id`) REFERENCES `opd_patient_departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `opd_timelines_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `operation_reports`
--
ALTER TABLE `operation_reports`
  ADD CONSTRAINT `operation_reports_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `operation_reports_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `operation_reports_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `packages`
--
ALTER TABLE `packages`
  ADD CONSTRAINT `packages_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `package_services`
--
ALTER TABLE `package_services`
  ADD CONSTRAINT `package_services_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `package_services_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pathology_categories`
--
ALTER TABLE `pathology_categories`
  ADD CONSTRAINT `pathology_categories_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pathology_tests`
--
ALTER TABLE `pathology_tests`
  ADD CONSTRAINT `pathology_tests_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `pathology_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pathology_tests_charge_category_id_foreign` FOREIGN KEY (`charge_category_id`) REFERENCES `charge_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pathology_tests_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `patients`
--
ALTER TABLE `patients`
  ADD CONSTRAINT `patients_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `patients_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `patient_admissions`
--
ALTER TABLE `patient_admissions`
  ADD CONSTRAINT `patient_admissions_bed_id_foreign` FOREIGN KEY (`bed_id`) REFERENCES `beds` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `patient_admissions_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `patient_admissions_insurance_id_foreign` FOREIGN KEY (`insurance_id`) REFERENCES `insurances` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `patient_admissions_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `patient_admissions_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `patient_admissions_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `patient_cases`
--
ALTER TABLE `patient_cases`
  ADD CONSTRAINT `patient_cases_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `patient_cases_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `patient_cases_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `patient_diagnosis_properties`
--
ALTER TABLE `patient_diagnosis_properties`
  ADD CONSTRAINT `patient_diagnosis_properties_patient_diagnosis_id_foreign` FOREIGN KEY (`patient_diagnosis_id`) REFERENCES `patient_diagnosis_tests` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `patient_diagnosis_tests`
--
ALTER TABLE `patient_diagnosis_tests`
  ADD CONSTRAINT `patient_diagnosis_tests_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `diagnosis_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `patient_diagnosis_tests_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `patient_diagnosis_tests_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `patient_diagnosis_tests_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payments_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pharmacists`
--
ALTER TABLE `pharmacists`
  ADD CONSTRAINT `pharmacists_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pharmacists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `postals`
--
ALTER TABLE `postals`
  ADD CONSTRAINT `postals_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD CONSTRAINT `prescriptions_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `prescriptions_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `prescriptions_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `radiology_categories`
--
ALTER TABLE `radiology_categories`
  ADD CONSTRAINT `radiology_categories_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `radiology_tests`
--
ALTER TABLE `radiology_tests`
  ADD CONSTRAINT `radiology_tests_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `radiology_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `radiology_tests_charge_category_id_foreign` FOREIGN KEY (`charge_category_id`) REFERENCES `charge_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `radiology_tests_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `receptionists`
--
ALTER TABLE `receptionists`
  ADD CONSTRAINT `receptionists_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `receptionists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `schedules`
--
ALTER TABLE `schedules`
  ADD CONSTRAINT `schedules_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `schedules_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `schedule_days`
--
ALTER TABLE `schedule_days`
  ADD CONSTRAINT `schedule_days_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `schedule_days_schedule_id_foreign` FOREIGN KEY (`schedule_id`) REFERENCES `schedules` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `settings`
--
ALTER TABLE `settings`
  ADD CONSTRAINT `settings_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sms`
--
ALTER TABLE `sms`
  ADD CONSTRAINT `sms_send_by_foreign` FOREIGN KEY (`send_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sms_send_to_foreign` FOREIGN KEY (`send_to`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sms_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD CONSTRAINT `subscriptions_subscription_plan_id_foreign` FOREIGN KEY (`subscription_plan_id`) REFERENCES `subscription_plans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `subscriptions_transaction_id_foreign` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `subscriptions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD CONSTRAINT `testimonials_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_tenants`
--
ALTER TABLE `user_tenants`
  ADD CONSTRAINT `user_tenants_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_tenants_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_zoom_credential`
--
ALTER TABLE `user_zoom_credential`
  ADD CONSTRAINT `user_zoom_credential_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_zoom_credential_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vaccinated_patients`
--
ALTER TABLE `vaccinated_patients`
  ADD CONSTRAINT `vaccinated_patients_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vaccinated_patients_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vaccinated_patients_vaccination_id_foreign` FOREIGN KEY (`vaccination_id`) REFERENCES `vaccinations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vaccinations`
--
ALTER TABLE `vaccinations`
  ADD CONSTRAINT `vaccinations_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `visitors`
--
ALTER TABLE `visitors`
  ADD CONSTRAINT `visitors_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
