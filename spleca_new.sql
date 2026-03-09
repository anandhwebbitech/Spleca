-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 21, 2026 at 01:13 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spleca_new`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `original_price` varchar(255) NOT NULL,
  `offer_price` varchar(255) NOT NULL,
  `discount` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `type_name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `type_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Chemical products', 1, '2026-02-21 09:19:56', '2026-02-21 09:19:56'),
(2, 'WEICON TOOLS', 1, '2026-02-21 09:20:17', '2026-02-21 09:20:17'),
(3, 'EPOXY SOLUTIONS', 1, '2026-02-21 09:21:44', '2026-02-21 09:21:44'),
(4, 'Application Areas', 1, '2026-02-21 09:22:02', '2026-02-21 09:22:02'),
(5, 'Product solutions', 1, '2026-02-21 09:22:22', '2026-02-21 09:22:22'),
(6, 'New Products', 1, '2026-02-21 09:22:31', '2026-02-21 09:22:31');

-- --------------------------------------------------------

--
-- Table structure for table `customer_addresses`
--

CREATE TABLE `customer_addresses` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `postal_code` int(11) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `is_default` int(11) DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_addresses`
--

INSERT INTO `customer_addresses` (`id`, `user_id`, `name`, `country`, `state`, `city`, `address`, `postal_code`, `phone`, `is_default`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 'Prabu', 'India', 'Tamil Nadu', 'Coimbatore', '13/1b, Brooke Bond Layout, Krishnasamy Mudaliar Road', 700001, '7502311968', 1, 1, '2025-12-31 06:10:13', '2025-12-31 07:19:48'),
(2, 2, 'Anandh', 'India', 'Tamil Nadu', 'Erode', '13/1b, Brooke Bond Layout, Krishnasamy Mudaliar Road', 700002, '9994394717', 0, 1, '2025-12-31 07:07:08', '2025-12-31 07:19:48');

-- --------------------------------------------------------

--
-- Table structure for table `enquiries`
--

CREATE TABLE `enquiries` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `subject` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
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
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
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
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `address_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `tax` varchar(255) NOT NULL,
  `original_price` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `payment_type` varchar(255) DEFAULT NULL,
  `payment_status` varchar(255) DEFAULT NULL,
  `order_status` int(11) NOT NULL DEFAULT 1,
  `shipping_status` int(11) NOT NULL DEFAULT 1,
  `order_date` datetime NOT NULL,
  `delivery_date` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `product_id`, `address_id`, `quantity`, `price`, `discount`, `tax`, `original_price`, `status`, `payment_type`, `payment_status`, `order_status`, `shipping_status`, `order_date`, `delivery_date`, `created_at`, `updated_at`) VALUES
(1, 2, NULL, 1, 1, 53, 0, '9.5742', 63, 2, 'cod', '1', 1, 1, '2026-01-30 11:14:01', '2026-02-06 11:14:01', '2026-01-30 11:14:01', '2026-01-30 11:14:07');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `original_price` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `order_status` int(11) DEFAULT 1,
  `delivery_status` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`, `discount`, `original_price`, `status`, `order_status`, `delivery_status`, `created_at`, `updated_at`) VALUES
(1, 1, 8, 1, 53, 0, 53, 2, 1, 1, '2026-01-30 11:14:01', '2026-01-30 11:14:07');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `razorpay_payment_id` varchar(255) DEFAULT NULL,
  `razorpay_order_id` varchar(255) DEFAULT NULL,
  `razorpay_signature` varchar(255) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `sub` text DEFAULT NULL,
  `is_feature` int(11) NOT NULL DEFAULT 0,
  `is_best_seller` int(11) NOT NULL DEFAULT 0,
  `variants` text DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `sku` varchar(100) DEFAULT NULL,
  `short_description` text DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `original_price` decimal(10,2) DEFAULT NULL,
  `discount_percent` decimal(5,2) DEFAULT 0.00,
  `stock_status` enum('in_stock','out_of_stock') DEFAULT 'in_stock',
  `quantity` int(11) DEFAULT 0,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sub_category_id` int(11) NOT NULL,
  `brand_id` bigint(20) UNSIGNED DEFAULT NULL,
  `tags` text DEFAULT NULL,
  `rating` decimal(2,1) DEFAULT 0.0,
  `total_reviews` int(11) DEFAULT 0,
  `status` tinyint(4) DEFAULT 1 COMMENT '1=Active,0=Inactive',
  `product_number` varchar(255) DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `sub`, `is_feature`, `is_best_seller`, `variants`, `slug`, `sku`, `short_description`, `description`, `price`, `original_price`, `discount_percent`, `stock_status`, `quantity`, `category_id`, `sub_category_id`, `brand_id`, `tags`, `rating`, `total_reviews`, `status`, `product_number`, `meta_title`, `meta_description`, `created_at`, `updated_at`) VALUES
(1, 'WEICON A', 'steel-filled epoxy resin system for repairs and gap-filling DNV-certified', 0, 1, '[\"0,5 kg , dark grey\",\"200 g, dark grey\",\"2 kg , dark grey\"]', 'weicon-a', '00000001', 'pasty | steel-filled | certified by DNV', 'WEICON A has a DNV certificate and is particularly suitable for repair and maintenance work in the maritime industry. The epoxy resin system is highly filled with steel pigments, magnetic and its pasty texture allows application even on vertical surfaces. It can be used to remove corrosion damage and pitting or to repair holes and blowholes. For example, it can be used to reproduce heavy steel components showing severe damage by corrosion and pitting. In this case, WEICON A provides a real alternative to welding, as the application of the epoxy resin does not cause thermal distortion as in welding. The 2-component system can be used for repairs on tanks and pipes as well as for repairing cracks in engine or pump housings and machine parts. It is ideal for use in sewer systems where pipes and pipelines are exposed to strong media influences. Other applications include the manufacture of models, moulds, tools and clamping devices. WEICON A can be used in mechanical engineering, in toolmaking, in the cement industry, in power plants, in model and mould making, and in many other industrial sectors.', 93.68, NULL, 0.00, 'in_stock', 100, 1, 1, NULL, NULL, 0.0, 0, 1, '0000001', NULL, NULL, '2026-02-21 06:12:12', '2026-02-21 06:12:12');

-- --------------------------------------------------------

--
-- Table structure for table `product_features`
--

CREATE TABLE `product_features` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `feature` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_files`
--

CREATE TABLE `product_files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `file_type` enum('datasheet','brochure','video') DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `file_size` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `is_primary` tinyint(4) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image`, `is_primary`, `created_at`, `updated_at`) VALUES
(1, 1, '1771674132_69999a14637c3.jpg', 0, NULL, NULL),
(2, 1, '1771674132_69999a146403a.jpg', 0, NULL, NULL),
(3, 1, '1771674132_69999a1464517.jpg', 0, NULL, NULL),
(4, 1, '1771674132_69999a1464b84.jpg', 0, NULL, NULL),
(5, 1, '1771674132_69999a14651ce.jpg', 0, NULL, NULL),
(6, 1, '1771674132_69999a146577d.jpg', 0, NULL, NULL),
(7, 1, '1771674132_69999a1465c23.jpg', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_resources`
--

CREATE TABLE `product_resources` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('datasheet','brochure','video') NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `video_url` varchar(500) DEFAULT NULL,
  `file_size` int(11) DEFAULT NULL COMMENT 'Size in KB',
  `status` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_resources`
--

INSERT INTO `product_resources` (`id`, `product_id`, `type`, `title`, `file`, `video_url`, `file_size`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'datasheet', '1', '1771674198_0_datasheet.pdf', NULL, NULL, 1, '2026-02-21 06:13:18', '2026-02-21 06:13:18'),
(2, 1, 'datasheet', '2', '1771674198_1_datasheet.pdf', NULL, NULL, 1, '2026-02-21 06:13:18', '2026-02-21 06:13:18'),
(3, 1, 'video', NULL, NULL, 'https://media.weicon.de/fmds/295231/dld:inline', NULL, 1, '2026-02-21 06:36:22', '2026-02-21 06:36:22'),
(4, 1, 'brochure', NULL, '1771675728_0_brochure.pdf', NULL, NULL, 1, '2026-02-21 06:38:48', '2026-02-21 06:38:48'),
(5, 1, 'brochure', NULL, '1771675728_1_brochure.pdf', NULL, NULL, 1, '2026-02-21 06:38:48', '2026-02-21 06:38:48'),
(6, 1, 'brochure', NULL, '1771675728_2_brochure.pdf', NULL, NULL, 1, '2026-02-21 06:38:48', '2026-02-21 06:38:48'),
(7, 1, 'brochure', NULL, '1771675835_0_brochure.pdf', NULL, NULL, 1, '2026-02-21 06:40:35', '2026-02-21 06:40:35'),
(8, 1, 'brochure', NULL, '1771675835_1_brochure.pdf', NULL, NULL, 1, '2026-02-21 06:40:35', '2026-02-21 06:40:35'),
(9, 1, 'brochure', NULL, '1771675835_2_brochure.pdf', NULL, NULL, 1, '2026-02-21 06:40:35', '2026-02-21 06:40:35'),
(10, 1, 'brochure', NULL, '1771675884_0_brochure.pdf', NULL, NULL, 1, '2026-02-21 06:41:24', '2026-02-21 06:41:24'),
(11, 1, 'brochure', NULL, '1771675884_1_brochure.pdf', NULL, NULL, 1, '2026-02-21 06:41:24', '2026-02-21 06:41:24'),
(12, 1, 'brochure', NULL, '1771675897_0_brochure.pdf', NULL, NULL, 1, '2026-02-21 06:41:37', '2026-02-21 06:41:37'),
(13, 1, 'datasheet', NULL, '1771675906_0_datasheet.pdf', NULL, NULL, 1, '2026-02-21 06:41:46', '2026-02-21 06:41:46'),
(14, 1, 'brochure', NULL, '1771675914_0_brochure.pdf', NULL, NULL, 1, '2026-02-21 06:41:54', '2026-02-21 06:41:54'),
(15, 1, 'brochure', NULL, '1771675923_0_brochure.pdf', NULL, NULL, 1, '2026-02-21 06:42:03', '2026-02-21 06:42:03'),
(16, 1, 'brochure', NULL, '1771675932_0_brochure.pdf', NULL, NULL, 1, '2026-02-21 06:42:12', '2026-02-21 06:42:12'),
(17, 1, 'brochure', NULL, '1771675948_0_brochure.pdf', NULL, NULL, 1, '2026-02-21 06:42:28', '2026-02-21 06:42:28'),
(18, 1, 'brochure', NULL, '1771675948_1_brochure.pdf', NULL, NULL, 1, '2026-02-21 06:42:28', '2026-02-21 06:42:28'),
(19, 1, 'brochure', NULL, '1771675948_2_brochure.pdf', NULL, NULL, 1, '2026-02-21 06:42:28', '2026-02-21 06:42:28');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('zXOYbXnXsjNuNxZ2PLkui8GEdpObV4WIARW0a4jC', 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRkpNYUt5cWtqTEhmcUhCT0ozd0dBTk5GZGQwUFRjeFEzMUZFTXBYcCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly9sb2NhbGhvc3Qvc3BsZWNhX3VwZGF0ZWQvcHJvZHVjdCI7czo1OiJyb3V0ZSI7czoxMToicHJvZHVjdHBhZ2UiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1771675948);

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` int(11) NOT NULL,
  `categories` int(11) NOT NULL,
  `sub_category_name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `categories`, `sub_category_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Adhesives and Sealants', 1, '2026-02-21 09:23:05', '2026-02-21 09:23:05'),
(2, 1, 'Technical Sprays', 1, '2026-02-21 09:23:15', '2026-02-21 09:23:15'),
(3, 1, 'Technical Liquids', 1, '2026-02-21 09:23:23', '2026-02-21 09:23:23'),
(4, 1, 'Assembly Pastes', 1, '2026-02-21 09:23:31', '2026-02-21 09:23:31'),
(5, 1, 'High-Performance Greases', 1, '2026-02-21 09:23:41', '2026-02-21 09:23:41'),
(6, 1, 'Green Tube', 1, '2026-02-21 09:23:51', '2026-02-21 09:23:51'),
(7, 1, 'Accessories and Processing', 1, '2026-02-21 09:24:01', '2026-02-21 09:24:15'),
(8, 1, 'Aids', 1, '2026-02-21 09:24:21', '2026-02-21 09:24:21'),
(9, 1, 'Sets', 1, '2026-02-21 09:24:31', '2026-02-21 09:24:31'),
(10, 2, 'Cable Strippers', 1, '2026-02-21 09:24:42', '2026-02-21 09:24:42'),
(11, 2, 'Wire Strippers', 1, '2026-02-21 09:24:54', '2026-02-21 09:24:54'),
(12, 2, 'Stripping Tools', 1, '2026-02-21 09:25:04', '2026-02-21 09:25:04'),
(13, 2, 'Multi Purpose Strippers', 1, '2026-02-21 09:25:12', '2026-02-21 09:25:12'),
(14, 2, 'Tools for the Solar Industry', 1, '2026-02-21 09:25:20', '2026-02-21 09:25:20'),
(15, 2, 'Crimping tools', 1, '2026-02-21 09:25:29', '2026-02-21 09:25:29'),
(16, 2, 'Green Line', 1, '2026-02-21 09:25:48', '2026-02-21 09:25:48'),
(17, 2, 'Special Tools', 1, '2026-02-21 09:25:56', '2026-02-21 09:25:56'),
(18, 2, 'Sets', 1, '2026-02-21 09:26:18', '2026-02-21 09:26:18'),
(19, 2, 'Related products', 1, '2026-02-21 09:26:31', '2026-02-21 09:26:31'),
(20, 3, 'Epoxy Solutions', 1, '2026-02-21 09:26:41', '2026-02-21 09:26:41'),
(21, 3, 'Customised Solutions', 1, '2026-02-21 09:26:51', '2026-02-21 09:26:51'),
(22, 3, 'WEICON Production', 1, '2026-02-21 09:27:00', '2026-02-21 09:27:00'),
(23, 3, 'What are epoxy resin systems?', 1, '2026-02-21 09:27:17', '2026-02-21 09:27:17'),
(24, 3, 'Coating and repair systems', 1, '2026-02-21 09:27:28', '2026-02-21 09:27:28'),
(25, 3, 'Epoxy resin adhesives', 1, '2026-02-21 09:27:37', '2026-02-21 09:27:37'),
(26, 3, 'Urethane', 1, '2026-02-21 09:27:45', '2026-02-21 09:27:45'),
(27, 3, 'Repair-Sticks', 1, '2026-02-21 09:27:54', '2026-02-21 09:27:54'),
(28, 4, 'Agricultural Technology', 1, '2026-02-21 09:28:05', '2026-02-21 09:28:05'),
(29, 4, 'Automotive and Transport', 1, '2026-02-21 09:28:14', '2026-02-21 09:28:14'),
(30, 4, 'Stainless Steel', 1, '2026-02-21 09:28:22', '2026-02-21 09:28:22'),
(31, 4, 'Energy', 1, '2026-02-21 09:28:30', '2026-02-21 09:28:30'),
(32, 4, 'Rubber and plastic industry', 1, '2026-02-21 09:28:39', '2026-02-21 09:28:39'),
(33, 4, 'Hydraulic and pneumatic', 1, '2026-02-21 09:28:48', '2026-02-21 09:28:48'),
(34, 4, 'Food, Pharma and Cosmetics', 1, '2026-02-21 09:28:59', '2026-02-21 09:28:59'),
(35, 4, 'Mechanical Engineering', 1, '2026-02-21 09:29:10', '2026-02-21 09:29:10'),
(36, 4, 'Maintenance', 1, '2026-02-21 09:29:19', '2026-02-21 09:29:19'),
(37, 4, 'Oil and Gas', 1, '2026-02-21 09:29:27', '2026-02-21 09:29:27'),
(38, 4, 'Maritime industry', 1, '2026-02-21 09:29:38', '2026-02-21 09:29:38'),
(39, 4, 'Mould-making', 1, '2026-02-21 09:29:46', '2026-02-21 09:29:46'),
(40, 4, 'Building Trades', 1, '2026-02-21 09:29:56', '2026-02-21 09:29:56'),
(41, 4, 'Mining', 1, '2026-02-21 09:30:03', '2026-02-21 09:30:03'),
(42, 4, 'Electrical Installation', 1, '2026-02-21 09:30:12', '2026-02-21 09:30:12'),
(43, 5, 'Adhesives for special requirements', 1, '2026-02-21 09:30:24', '2026-02-21 09:30:24'),
(44, 5, 'Adhesives in everyday life', 1, '2026-02-21 09:30:32', '2026-02-21 09:30:32'),
(45, 5, 'Cable stripping in everyday life', 1, '2026-02-21 09:30:39', '2026-02-21 09:30:39'),
(46, 5, 'Why is it better to repair instead of buying something new?', 1, '2026-02-21 09:30:48', '2026-02-21 09:30:48'),
(47, 5, 'How do I bond plastics?', 1, '2026-02-21 09:30:55', '2026-02-21 09:30:55'),
(48, 5, 'What are lubricants?', 1, '2026-02-21 09:31:03', '2026-02-21 09:31:03'),
(49, 5, 'What can contact adhesives do?', 1, '2026-02-21 09:31:27', '2026-02-21 09:31:27'),
(50, 5, 'Adhesive dispensing system', 1, '2026-02-21 09:31:36', '2026-02-21 09:31:36'),
(51, 5, 'Multifunctional Sprays', 1, '2026-02-21 09:31:44', '2026-02-21 09:31:44');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` int(11) NOT NULL DEFAULT 1,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Anand K', 'anandh@gmail.com', 1, NULL, '$2y$12$9e2Vq8oAsNXR4wNluQeW5u4EH3qDX3io0IiCEM72hn.Hidwofzvbq', NULL, '2025-12-25 23:17:08', '2025-12-25 23:17:08'),
(2, 'Prabu K', 'prabu@gmail.com', 2, NULL, '$2y$12$vk3sKc2l9ZUMBMBpfZCYtOSVIpcDx8.eaVZrMvsp9LZR0J6sSniBG', NULL, '2025-12-25 23:17:08', '2025-12-31 03:35:59');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_addresses`
--
ALTER TABLE `customer_addresses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enquiries`
--
ALTER TABLE `enquiries`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD UNIQUE KEY `sku` (`sku`);

--
-- Indexes for table `product_features`
--
ALTER TABLE `product_features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_files`
--
ALTER TABLE `product_files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_resources`
--
ALTER TABLE `product_resources`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_resources_product_id_index` (`product_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customer_addresses`
--
ALTER TABLE `customer_addresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `enquiries`
--
ALTER TABLE `enquiries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product_features`
--
ALTER TABLE `product_features`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_files`
--
ALTER TABLE `product_files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `product_resources`
--
ALTER TABLE `product_resources`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product_resources`
--
ALTER TABLE `product_resources`
  ADD CONSTRAINT `product_resources_product_id_fk` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
