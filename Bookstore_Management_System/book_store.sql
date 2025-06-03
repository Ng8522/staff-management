-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Sep 22, 2024 at 04:15 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `book_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `authors` varchar(255) NOT NULL,
  `publisher` varchar(255) NOT NULL,
  `category` enum('Drama','Epic','Poetry') NOT NULL,
  `cover` varchar(255) NOT NULL,
  `year` int(11) NOT NULL DEFAULT 0,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `stock_quantity` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `authors`, `publisher`, `category`, `cover`, `year`, `price`, `stock_quantity`, `created_at`, `updated_at`) VALUES
(1, 'Ali, Ah Kau dan Muthu', 'Ali, Ah Kau, Muthu', '1Malaysia Sdn Berhad', 'Epic', 'covers/yBjgSivTL3qWKkw9cOroEI7AszBGYfxbNdasJm7L.png', 2024, 20.00, 1010, '2024-09-22 13:57:41', '2024-09-22 14:01:28');

-- --------------------------------------------------------

--
-- Table structure for table `book_logs`
--

CREATE TABLE `book_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `book_title` varchar(255) NOT NULL,
  `staff_id` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `book_logs`
--

INSERT INTO `book_logs` (`id`, `book_title`, `staff_id`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Ali, Ah Kau dan Muthu', 'S0003', 'Created a new book', '2024-09-22 13:57:41', '2024-09-22 13:57:41'),
(2, 'Ali, Ah Kau dan Muthu', 'S0003', 'Added stock for the book', '2024-09-22 13:59:50', '2024-09-22 13:59:50'),
(3, 'Ali, Ah Kau dan Muthu', 'S0003', 'Added stock for the book', '2024-09-22 13:59:50', '2024-09-22 13:59:50'),
(4, 'Ali, Ah Kau dan Muthu', 'S0003', 'Added stock for the book', '2024-09-22 13:59:50', '2024-09-22 13:59:50'),
(5, 'Ali, Ah Kau dan Muthu', 'S0003', 'Added stock for the book', '2024-09-22 13:59:51', '2024-09-22 13:59:51'),
(6, 'Ali, Ah Kau dan Muthu', 'S0003', 'Added stock for the book', '2024-09-22 13:59:51', '2024-09-22 13:59:51'),
(7, 'Ali, Ah Kau dan Muthu', 'S0003', 'Added stock for the book', '2024-09-22 13:59:51', '2024-09-22 13:59:51'),
(8, 'Ali, Ah Kau dan Muthu', 'S0003', 'Added stock for the book', '2024-09-22 13:59:51', '2024-09-22 13:59:51'),
(9, 'Ali, Ah Kau dan Muthu', 'S0003', 'Added stock for the book', '2024-09-22 13:59:52', '2024-09-22 13:59:52'),
(10, 'Ali, Ah Kau dan Muthu', 'S0003', 'Added stock for the book', '2024-09-22 13:59:54', '2024-09-22 13:59:54'),
(11, 'Ali, Ah Kau dan Muthu', 'S0003', 'Added stock for the book', '2024-09-22 13:59:55', '2024-09-22 13:59:55'),
(12, 'Ali, Ah Kau dan Muthu', 'S0003', 'Edited the book', '2024-09-22 14:01:28', '2024-09-22 14:01:28');

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
(8, '2014_10_12_100000_create_password_resets_table', 2),
(16, '2019_12_14_000001_create_personal_access_tokens_table', 3),
(17, '2024_09_05_064242_create_staff_table', 3),
(18, '2024_09_05_065821_create_positions_table', 3),
(24, '2024_09_20_191941_create_leave_types_table', 4),
(31, '2024_09_20_192435_create_leave_requests_table', 5),
(33, '2024_09_20_103552_create_password_resets_table', 6),
(34, '2024_09_20_122231_create_books_table', 6),
(35, '2024_09_21_182813_create_book_logs_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
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
-- Table structure for table `position`
--

CREATE TABLE `position` (
  `position_id` varchar(255) NOT NULL,
  `position_name` varchar(255) NOT NULL,
  `basic_salary` double NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`position_id`, `position_name`, `basic_salary`) VALUES
('ADMIN', 'Admin', 0),
('P0001', 'HR Manager', 4500),
('P0002', 'Inventory Manager', 4500),
('P0003', 'Store Manager', 4000),
('P0004', 'Stock Associate', 3000),
('P0005', 'Cashier', 2500);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `ICNo` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL DEFAULT 'Not Specified',
  `dateOfBirth` varchar(255) NOT NULL DEFAULT 'Not Specified',
  `race` varchar(255) NOT NULL DEFAULT 'Not Specified',
  `email` varchar(255) NOT NULL,
  `position_id` varchar(255) NOT NULL,
  `bank_account` varchar(255) NOT NULL DEFAULT 'Not Specified',
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `name`, `ICNo`, `gender`, `dateOfBirth`, `race`, `email`, `position_id`, `bank_account`, `password`, `created_at`, `updated_at`) VALUES
('ADM', 'Admin', 'Not Specified', 'Not Specified', 'Not Specified', 'Not Specified', 'V1hqUmtGVFlBWVJGNmkrZGtiYVBJak09', 'ADMIN', 'ZG5QSTJXbm9BWjlONFRhVWtBPT0=', 'ZVhqUnlBaXI=', '2024-09-20 02:40:30', '2024-09-20 02:40:30'),
('S0001', 'Ng Jun Yu', 'Q0MrTXpncXNWTTBVczJuRw==', 'Male', '2003-07-04', 'Chinese', 'VW1uU2dFK2dVYzRXeHppY2xmR0FZejNidGc9PQ==', 'P0001', 'RFN5T3pRaWdWYzBVdmc9PQ==', 'ZG51THpneXFYTVFL', '2024-09-20 03:49:38', '2024-09-20 20:16:59'),
('S0002', 'Najib', 'RFMrTXpnaXJWczRWdFd6Rg==', 'Male', '1953-07-23', 'Malay', 'Vm4zV2tGaXBWczlrNERLUW5mVENMakha', 'P0005', 'Q1M2UHpRK3VVOFFk', 'Vm4zV2tGaXBWczlrNERLUW5mVENMakha', '2024-09-20 10:29:26', '2024-09-20 10:29:26'),
('S0003', 'Ng Yao Zong', 'Q0NtTnlBcXBWTTBVdG12RQ==', 'Male', '2005-11-01', 'Chinese', 'UVgzVGcxWDJBOG9WdG0yeGsvV05KREthdUFObg==', 'P0002', 'Q1M2UHpRK3VVOFFk', 'UVgzVGcxWDJBOG9WdG0yeGsvV05KREthdUFObg==', '2024-09-20 10:30:37', '2024-09-22 13:54:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `book_logs`
--
ALTER TABLE `book_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`position_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`),
  ADD UNIQUE KEY `staff_name_unique` (`name`),
  ADD UNIQUE KEY `staff_icno_unique` (`ICNo`),
  ADD UNIQUE KEY `staff_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `book_logs`
--
ALTER TABLE `book_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
