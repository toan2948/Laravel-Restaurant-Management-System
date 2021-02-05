-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 04. Feb 2021 um 19:24
-- Server-Version: 10.4.14-MariaDB
-- PHP-Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `laravel1`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(3, 'category 1', '2020-11-26 14:41:40', '2020-12-31 10:35:16'),
(4, 'category 2', '2020-11-26 15:24:41', '2020-12-31 10:35:24'),
(6, 'category 3', '2020-11-26 17:08:03', '2020-12-31 10:35:32'),
(10, 'uiklklop13', '2021-01-13 07:26:08', '2021-02-04 12:38:10');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `menus`
--

INSERT INTO `menus` (`id`, `name`, `price`, `image`, `desc`, `category_id`, `created_at`, `updated_at`) VALUES
(5, 'burger', '12.00', '1609415818.jpeg', 'burger', 3, '2020-12-31 10:56:58', '2020-12-31 10:56:58'),
(6, 'sushi', '12.00', '1609424707.jpeg', 'sushi', 3, '2020-12-31 13:25:07', '2020-12-31 13:25:07'),
(7, 'beer', '2.00', '1609424729.jpeg', 'beer', 4, '2020-12-31 13:25:29', '2020-12-31 13:25:29'),
(8, 'noodle', '3.00', '1609424756.jpeg', 'noodle', 6, '2020-12-31 13:25:56', '2020-12-31 13:25:56'),
(9, 'chip', '8.00', '1609424782.jpeg', 'chip', 6, '2020-12-31 13:26:22', '2020-12-31 13:26:22');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_11_26_135515_create_categories_table', 2),
(5, '2020_11_29_111425_create_menus_table', 3),
(6, '2020_11_30_130739_create_tables_table', 4),
(7, '2020_12_01_190257_create_sales_table', 5),
(8, '2020_12_01_191010_create_sale_details_table', 6);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `sales`
--

CREATE TABLE `sales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `table_id` int(11) NOT NULL,
  `table_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_price` decimal(8,2) NOT NULL DEFAULT 0.00,
  `total_received` decimal(8,2) NOT NULL DEFAULT 0.00,
  `change` decimal(8,2) NOT NULL DEFAULT 0.00,
  `payment_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `sale_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unpaid',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `sales`
--

INSERT INTO `sales` (`id`, `table_id`, `table_name`, `user_id`, `user_name`, `total_price`, `total_received`, `change`, `payment_type`, `sale_status`, `created_at`, `updated_at`) VALUES
(10, 5, 'table 2', 4, 'toan', '27.00', '30.00', '-3.00', 'Cash', 'paid', '2020-12-31 14:34:39', '2020-12-31 14:34:55'),
(11, 4, 'table 1', 4, 'toan', '36.00', '67.00', '-31.00', 'Cash', 'paid', '2020-12-31 14:37:18', '2021-01-13 08:38:12'),
(12, 4, 'table 1', 4, 'toan', '48.00', '50.00', '-2.00', 'Cash', 'paid', '2021-01-13 08:38:20', '2021-01-13 11:16:42'),
(13, 4, 'table 1', 4, 'toan', '12.00', '0.00', '0.00', '', 'unpaid', '2021-01-13 11:16:57', '2021-01-13 11:16:57'),
(14, 5, 'table 2', 4, 'toan', '12.00', '0.00', '0.00', '', 'unpaid', '2021-01-13 11:19:00', '2021-01-13 11:19:00');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `sale_details`
--

CREATE TABLE `sale_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sale_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `menu_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `menu_price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'noConfirm',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `sale_details`
--

INSERT INTO `sale_details` (`id`, `sale_id`, `menu_id`, `menu_name`, `menu_price`, `quantity`, `status`, `created_at`, `updated_at`) VALUES
(7, 3, 2, 'mq', 9, 1, 'confirmed', '2020-12-02 14:38:59', '2020-12-03 17:33:12'),
(8, 3, 2, 'mq', 9, 1, 'confirmed', '2020-12-02 14:39:06', '2020-12-03 17:33:12'),
(22, 2, 2, 'mq', 9, 1, 'confirmed', '2020-12-02 14:45:10', '2020-12-05 15:47:33'),
(27, 2, 2, 'mq', 9, 1, 'confirmed', '2020-12-05 12:17:19', '2020-12-05 15:47:33'),
(41, 10, 8, 'noodle', 3, 1, 'confirmed', '2020-12-31 14:34:39', '2020-12-31 14:34:44'),
(42, 10, 5, 'burger', 12, 1, 'confirmed', '2020-12-31 14:34:41', '2020-12-31 14:34:44'),
(43, 10, 5, 'burger', 12, 1, 'confirmed', '2020-12-31 14:34:43', '2020-12-31 14:34:44'),
(44, 11, 5, 'burger', 12, 1, 'confirmed', '2020-12-31 14:37:18', '2020-12-31 14:37:23'),
(45, 11, 6, 'sushi', 12, 1, 'confirmed', '2020-12-31 14:37:20', '2020-12-31 14:37:23'),
(46, 11, 5, 'burger', 12, 1, 'confirmed', '2020-12-31 14:37:20', '2020-12-31 14:37:23'),
(47, 12, 5, 'burger', 12, 1, 'confirmed', '2021-01-13 08:38:21', '2021-01-13 11:15:26'),
(48, 12, 6, 'sushi', 12, 1, 'confirmed', '2021-01-13 08:38:22', '2021-01-13 11:15:26'),
(49, 12, 5, 'burger', 12, 1, 'confirmed', '2021-01-13 10:19:31', '2021-01-13 11:15:26'),
(52, 12, 5, 'burger', 12, 1, 'confirmed', '2021-01-13 11:15:11', '2021-01-13 11:15:26'),
(53, 13, 5, 'burger', 12, 1, 'confirmed', '2021-01-13 11:16:57', '2021-01-13 11:17:00'),
(54, 14, 5, 'burger', 12, 1, 'noConfirm', '2021-01-13 11:19:00', '2021-01-13 11:19:00');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tables`
--

CREATE TABLE `tables` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'available',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `tables`
--

INSERT INTO `tables` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(4, 'table 1', 'unavailable', '2020-11-30 16:34:44', '2021-01-13 11:16:57'),
(5, 'table 2', 'unavailable', '2020-11-30 16:35:49', '2021-01-13 11:19:00'),
(6, 'table 3', 'available', '2020-11-30 16:35:56', '2021-01-13 11:19:27');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
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
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(3, 'toan', 'toan@toan.com', NULL, '$2y$10$c0/BhjvfmzMKEajr7I.bcefycnWwCtk1mj7bnFExGzOK/5lwiE6wi', 'JQfBy2EuT8Tb6Bm16kpOt4ADKxD0KN3OQGGSIL0ezv4jlPi7qiOLZtsRsIip', '2020-11-10 12:50:33', '2020-11-10 13:12:41'),
(4, 'toan', 'toan@gmail.com', NULL, '$2y$10$C0.JCgT6ePbXunTZ/gysMOjRUTYMnbV7DCKRkK7G4d9SdqAW4ORCu', NULL, '2020-12-31 09:14:52', '2020-12-31 09:14:52');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indizes für die Tabelle `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `sale_details`
--
ALTER TABLE `sale_details`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `tables`
--
ALTER TABLE `tables`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT für Tabelle `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT für Tabelle `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT für Tabelle `sales`
--
ALTER TABLE `sales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT für Tabelle `sale_details`
--
ALTER TABLE `sale_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT für Tabelle `tables`
--
ALTER TABLE `tables`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
