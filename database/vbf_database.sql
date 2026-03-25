-- ============================================
-- VBF (Vipra Business Forum) Database Schema
-- Database: mlaravi
-- Created: 2025-12-04
-- ============================================

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- ============================================
-- Laravel Default Tables
-- ============================================

-- Users Table
CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Password Resets Table
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Failed Jobs Table
CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Personal Access Tokens Table
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Migrations Table
CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- Admin & Authentication Tables
-- ============================================

-- Admin Table
CREATE TABLE `pwa_admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` enum('0','1') DEFAULT '1',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`admin_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Admin Logs Table
CREATE TABLE `pwa_admin_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adminid` int(11) DEFAULT NULL,
  `login` datetime DEFAULT NULL,
  `logout` datetime DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Customers Table
CREATE TABLE `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reg_id` varchar(50) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `pincode` varchar(10) DEFAULT NULL,
  `chapter` int(11) DEFAULT NULL,
  `category` int(11) DEFAULT NULL,
  `subcategory` int(11) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `martial_date` date DEFAULT NULL,
  `doc` varchar(255) DEFAULT NULL,
  `signature` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` enum('0','1') DEFAULT '1',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `phone` (`phone`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Customer OTP Table
CREATE TABLE `customerotp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phone` varchar(20) DEFAULT NULL,
  `otp` varchar(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- Content Management Tables
-- ============================================

-- Banner Table
CREATE TABLE `pwa_banner` (
  `banner_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `descp` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` enum('0','1') DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`banner_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- News Table
CREATE TABLE `pwa_news` (
  `news_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `about` varchar(500) DEFAULT NULL,
  `descp` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` enum('0','1') DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`news_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Events Table
CREATE TABLE `pwa_events` (
  `event_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `descp` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `status` enum('0','1') DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`event_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Gallery Table
CREATE TABLE `pwa_gallery` (
  `gallery_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` enum('0','1') DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`gallery_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- About Table
CREATE TABLE `pwa_about` (
  `about_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `descp` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` enum('0','1') DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`about_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Terms Table
CREATE TABLE `pwa_terms` (
  `terms_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `descp` text DEFAULT NULL,
  `status` enum('0','1') DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`terms_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Scheme Table
CREATE TABLE `pwa_scheme` (
  `scheme_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `count` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` enum('0','1') DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`scheme_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- Organization Structure Tables
-- ============================================

-- Department Table
CREATE TABLE `pwa_department` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `status` enum('0','1') DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Department Members Table
CREATE TABLE `pwa_department_mem` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `depid` int(11) DEFAULT NULL,
  `memid` text DEFAULT NULL,
  `status` enum('0','1') DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Designation Table
CREATE TABLE `pwa_designation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `status` enum('0','1') DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Chapter Table
CREATE TABLE `pwa_chapter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `status` enum('0','1') DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Category Table
CREATE TABLE `pwa_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` enum('0','1') DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Subcategory Table
CREATE TABLE `pwa_subcategory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `status` enum('0','1') DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- Meetings & Calendar Tables
-- ============================================

-- Meetings Table
CREATE TABLE `pwa_meetings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `eid` varchar(100) DEFAULT NULL,
  `mominv` varchar(100) DEFAULT NULL,
  `modeid` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `mode` varchar(100) DEFAULT NULL,
  `details` text DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `descp` text DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `prime_member` varchar(255) DEFAULT NULL,
  `prime_member_desig` varchar(255) DEFAULT NULL,
  `prime_member_image` varchar(255) DEFAULT NULL,
  `secondary_member_image` text DEFAULT NULL,
  `status` enum('0','1') DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Meetings MOM (Minutes of Meeting) Table
CREATE TABLE `pwa_meetings_mom` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mid` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `descp` text DEFAULT NULL,
  `status` enum('0','1') DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Meetings Attendance Table
CREATE TABLE `pwa_meetings_attendance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mid` int(11) DEFAULT NULL,
  `custid` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Calendar Table
CREATE TABLE `calender` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `eid` varchar(100) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  `start_time` datetime DEFAULT NULL,
  `status` enum('0','1') DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- Document Management Tables
-- ============================================

-- Document Table
CREATE TABLE `pwa_document` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `status` enum('0','1') DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- Opportunity Management Tables
-- ============================================

-- Opportunity Table
CREATE TABLE `opportunity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cust_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `descp` text DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `referencetype` int(11) DEFAULT NULL,
  `opportunitytype` int(11) DEFAULT NULL,
  `referalstatus` int(11) DEFAULT NULL,
  `opportunityconnect` int(11) DEFAULT NULL,
  `status` enum('0','1') DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Reference Type Table
CREATE TABLE `pwa_referencetype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `status` enum('0','1') DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Opportunity Type Table
CREATE TABLE `pwa_opportunitytype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `status` enum('0','1') DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Referral Status Table
CREATE TABLE `pwa_referalstatus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `status` enum('0','1') DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Opportunity Connect Table
CREATE TABLE `pwa_opportunityconnect` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `status` enum('0','1') DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- User Roles & Permissions Tables
-- ============================================

-- Roles Table
CREATE TABLE `pwa_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `status` enum('0','1') DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Permissions Table
CREATE TABLE `pwa_permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `status` enum('0','1') DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- User Roles Table
CREATE TABLE `pwa_user_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) DEFAULT NULL,
  `roles_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- User Capabilities Table
CREATE TABLE `pwa_user_capabilities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) DEFAULT NULL,
  `name` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Modules Table
CREATE TABLE `pwa_modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `status` enum('0','1') DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Submodules Table
CREATE TABLE `pwa_submodules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `route` varchar(255) DEFAULT NULL,
  `status` enum('0','1') DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- Location & Support Tables
-- ============================================

-- Country Table
CREATE TABLE `pwa_country` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `status` enum('0','1') DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- State Table
CREATE TABLE `pwa_state` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `status` enum('0','1') DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Support Table
CREATE TABLE `pwa_support` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cust_id` int(11) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `status` enum('0','1') DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- Additional Tables
-- ============================================

-- Activities Table
CREATE TABLE `pwa_activities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `descp` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` enum('0','1') DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Media Table
CREATE TABLE `pwa_media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `link` varchar(500) DEFAULT NULL,
  `status` enum('0','1') DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Services Table
CREATE TABLE `pwa_services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `status` enum('0','1') DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Nature Table
CREATE TABLE `pwa_nature` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `status` enum('0','1') DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- App Versions Table
CREATE TABLE `pwa_appversions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `version` varchar(50) DEFAULT NULL,
  `platform` varchar(50) DEFAULT NULL,
  `status` enum('0','1') DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Versions Table
CREATE TABLE `pwa_versions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `version` varchar(50) DEFAULT NULL,
  `descp` text DEFAULT NULL,
  `status` enum('0','1') DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Content Table
CREATE TABLE `pwa_content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `descp` text DEFAULT NULL,
  `status` enum('0','1') DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Order Table
CREATE TABLE `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reg_id` int(11) DEFAULT NULL,
  `order_priority` varchar(50) DEFAULT NULL,
  `ordered_date` date DEFAULT NULL,
  `accepted_date` date DEFAULT NULL,
  `packed_date` date DEFAULT NULL,
  `shipped_date` date DEFAULT NULL,
  `tracking_date` date DEFAULT NULL,
  `delivered_date` date DEFAULT NULL,
  `labeled_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Registration Table
CREATE TABLE `registrations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `time_stamp` varchar(100) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `doj` date DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `emp_id` varchar(100) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `address2` text DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `pincode` varchar(10) DEFAULT NULL,
  `landmark` varchar(255) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `alt_mobile` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- Location Management Tables (Karnataka Bangalore)
-- ============================================

-- Cities/Divisions (Vibhag)
CREATE TABLE `jm_blr_rs_vibhag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `name_kn` varchar(255) DEFAULT NULL,
  `status` enum('0','1') DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Districts (Bhag)
CREATE TABLE `jm_blr_rs_bhag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vibhag_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `name_kn` varchar(255) DEFAULT NULL,
  `status` enum('0','1') DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `vibhag_id` (`vibhag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Taluks (Nagar)
CREATE TABLE `jm_blr_rs_nagar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bhag_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `name_kn` varchar(255) DEFAULT NULL,
  `status` enum('0','1') DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `bhag_id` (`bhag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Areas (Vasathi)
CREATE TABLE `jm_blr_rs_vasathi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nagar_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `name_kn` varchar(255) DEFAULT NULL,
  `status` enum('0','1') DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `nagar_id` (`nagar_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- Sample Data Inserts
-- ============================================

-- Insert default admin user (password: admin123 - stored as plain text)
-- NOTE: This system stores passwords in plain text, not hashed
INSERT INTO `pwa_admin` (`admin_id`, `name`, `email`, `password`, `phone`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@vbf.com', 'admin123', '9876543210', '1', NOW(), NOW());

-- Insert default roles
INSERT INTO `pwa_roles` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', '1', NOW(), NOW()),
(2, 'Admin', '1', NOW(), NOW()),
(3, 'Manager', '1', NOW(), NOW()),
(4, 'User', '1', NOW(), NOW());

-- Insert default modules
INSERT INTO `pwa_modules` (`id`, `name`, `icon`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Dashboard', 'home', '1', NOW(), NOW()),
(2, 'Users', 'users', '1', NOW(), NOW()),
(3, 'Customers', 'user', '1', NOW(), NOW()),
(4, 'Meetings', 'calendar', '1', NOW(), NOW()),
(5, 'Documents', 'file', '1', NOW(), NOW()),
(6, 'Opportunities', 'briefcase', '1', NOW(), NOW()),
(7, 'Content', 'edit', '1', NOW(), NOW()),
(8, 'Settings', 'settings', '1', NOW(), NOW());

-- Insert default opportunity types
INSERT INTO `pwa_opportunitytype` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Business', '1', NOW(), NOW()),
(2, 'Partnership', '1', NOW(), NOW()),
(3, 'Investment', '1', NOW(), NOW()),
(4, 'Collaboration', '1', NOW(), NOW());

-- Insert default reference types
INSERT INTO `pwa_referencetype` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Direct', '1', NOW(), NOW()),
(2, 'Referral', '1', NOW(), NOW()),
(3, 'Website', '1', NOW(), NOW()),
(4, 'Social Media', '1', NOW(), NOW());

-- Insert default referral status
INSERT INTO `pwa_referalstatus` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'New', '1', NOW(), NOW()),
(2, 'In Progress', '1', NOW(), NOW()),
(3, 'Completed', '1', NOW(), NOW()),
(4, 'Closed', '1', NOW(), NOW());

-- Insert default opportunity connect
INSERT INTO `pwa_opportunityconnect` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Email', '1', NOW(), NOW()),
(2, 'Phone', '1', NOW(), NOW()),
(3, 'Meeting', '1', NOW(), NOW()),
(4, 'Event', '1', NOW(), NOW());

-- ============================================
-- Auto Increment Reset
-- ============================================

ALTER TABLE `users` AUTO_INCREMENT = 1;
ALTER TABLE `pwa_admin` AUTO_INCREMENT = 2;
ALTER TABLE `customers` AUTO_INCREMENT = 1;
ALTER TABLE `pwa_banner` AUTO_INCREMENT = 1;
ALTER TABLE `pwa_news` AUTO_INCREMENT = 1;
ALTER TABLE `pwa_events` AUTO_INCREMENT = 1;
ALTER TABLE `pwa_meetings` AUTO_INCREMENT = 1;
ALTER TABLE `opportunity` AUTO_INCREMENT = 1;

COMMIT;

-- ============================================
-- End of VBF Database Schema
-- ============================================


