-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2026 at 03:44 AM
-- Server version: 8.4.3
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tumbaso`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `variant_id` int DEFAULT NULL,
  `jumlah` int DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `variant_id`, `jumlah`, `created_at`) VALUES
(13, 3, 1, 18, 3, '2026-05-25 05:49:04');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `total_harga` decimal(12,2) NOT NULL,
  `alamat_kirim` text NOT NULL,
  `status` enum('pending','diproses','dikirim','selesai','dibatalkan') DEFAULT 'pending',
  `catatan` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total_harga`, `alamat_kirim`, `status`, `catatan`, `created_at`) VALUES
(1, 3, 0.00, 'sidoarjo', 'dibatalkan', 'cepet', '2026-05-12 00:39:26'),
(2, 3, 850000.00, 'buduran', 'selesai', 'gc', '2026-05-16 00:49:34'),
(3, 1, 1500000.00, 'buduran', 'dibatalkan', 'secepatnya', '2026-05-17 23:28:52'),
(4, 3, 850000.00, 'buduran', 'selesai', '', '2026-05-18 04:58:14'),
(5, 3, 1500000.00, 'sekardangan', 'dibatalkan', '', '2026-05-19 13:37:03'),
(6, 3, 850000.00, 'buduran', 'dikirim', '', '2026-05-20 12:43:19'),
(7, 5, 9350000.00, 'drjo', 'diproses', 'web e lek iso alamate digae otomatis dong', '2026-05-20 12:51:36'),
(8, 3, 3250000.00, 'buduran', 'selesai', '', '2026-05-21 01:42:32'),
(9, 1, 850000.00, 'darjo', 'selesai', '', '2026-05-24 12:28:04');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int NOT NULL,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `variant_id` int DEFAULT NULL,
  `jumlah` int NOT NULL,
  `harga_saat_beli` decimal(12,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `variant_id`, `jumlah`, `harga_saat_beli`) VALUES
(1, 1, 2, NULL, 1, 650000.00),
(2, 1, 1, NULL, 1, 850000.00),
(3, 2, 1, 17, 1, 850000.00),
(4, 3, 3, 16, 1, 1500000.00),
(5, 4, 1, 18, 1, 850000.00),
(6, 5, 3, 16, 1, 1500000.00),
(7, 6, 1, 17, 1, 850000.00),
(8, 7, 1, 18, 11, 850000.00),
(9, 8, 2, 20, 5, 650000.00),
(10, 9, 1, 18, 1, 850000.00);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `nama` varchar(150) NOT NULL,
  `deskripsi` text,
  `harga` decimal(12,2) NOT NULL,
  `foto_utama` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `nama`, `deskripsi`, `harga`, `foto_utama`, `is_active`, `created_at`) VALUES
(1, 'Kemeja Linen Premium', 'Kemeja linen berkualitas tinggi, nyaman dan elegan untuk berbagai kesempatan.', 850000.00, 'kemeja-linen.jpg', 1, '2026-04-14 03:46:40'),
(2, 'Celana Chino Classic', 'Celana chino potongan slim fit, bahan premium anti-kusut.', 650000.00, 'celana-chino.jpg', 1, '2026-04-14 03:46:40'),
(3, 'Blazer Formal Luxury', 'Blazer formal dengan jahitan tangan, cocok untuk acara resmi.', 1500000.00, 'blazer-formal.jpg', 1, '2026-04-14 03:46:40'),
(4, 'baju polo', 'baju polo dengan premium', 500000.00, '1779688029_blazer-formal.jpg', 1, '2026-05-25 05:47:09');

-- --------------------------------------------------------

--
-- Table structure for table `product_photos`
--

CREATE TABLE `product_photos` (
  `id` int NOT NULL,
  `product_id` int NOT NULL,
  `foto` varchar(255) NOT NULL,
  `urutan` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product_photos`
--

INSERT INTO `product_photos` (`id`, `product_id`, `foto`, `urutan`) VALUES
(1, 1, 'kemeja-linen-2.jpg', 1),
(2, 1, 'kemeja-linen-3.jpg', 2);

-- --------------------------------------------------------

--
-- Table structure for table `product_variants`
--

CREATE TABLE `product_variants` (
  `id` int NOT NULL,
  `product_id` int NOT NULL,
  `size` varchar(50) NOT NULL,
  `stok` int DEFAULT '0',
  `warna` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product_variants`
--

INSERT INTO `product_variants` (`id`, `product_id`, `size`, `stok`, `warna`) VALUES
(16, 3, 'S', 120, 'Merah'),
(17, 1, 'S', 120, 'Merah'),
(18, 1, 'M', 110, 'Merah'),
(19, 2, 's', 10, 'Cream'),
(20, 2, 'M', 10, 'Cream'),
(21, 2, 'L', 0, 'Cream'),
(22, 4, '', 199, '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `alamat` text,
  `role` enum('user','admin') DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `password`, `no_hp`, `alamat`, `role`, `created_at`) VALUES
(1, 'Admin Toko', 'admin@tumbaso.com', '$2a$12$74N0TkzzOJ0KwFy3SQvakOUqluOKjXQNsv9959IBHEAEWUHwQU33K', NULL, NULL, 'admin', '2026-04-14 03:46:39'),
(3, 'Zafran Nur', 'zafrannur55@gmail.com', '$2y$10$kliob3I785fUzuSdxBXHUOlQa2hMfFPef/f3n6f1ZEEavbmjoczny', NULL, NULL, 'user', '2026-04-15 10:28:27'),
(4, 'Menhan', 'Menhan@m.m', '$2y$10$ql9w3OqohhfIWGEu3PcOJOaw0mkZacxo7kj0xjwdU8t6Vuelh24Im', NULL, NULL, 'user', '2026-05-20 03:24:59'),
(5, 'tes', 'jaerja@gmail.com', '$2y$10$W.uYc5Edc9WdmB7B6Co1hOvPyNrg3TZ0IuqGQeo/Lg9CISfmSk/RO', NULL, NULL, 'user', '2026-05-20 12:32:40'),
(8, 'Tester2', 'tester2@gmail.com', '$2y$10$XXsSJvM7WNLIMXevwZXOeOftsYMKjvFVox6I5JiNU9TJX9aE4oqaS', '0855556666777', NULL, 'user', '2026-05-25 02:38:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `variant_id` (`variant_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `variant_id` (`variant_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_photos`
--
ALTER TABLE `product_photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product_variants`
--
ALTER TABLE `product_variants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

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
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product_photos`
--
ALTER TABLE `product_photos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_variants`
--
ALTER TABLE `product_variants`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_ibfk_3` FOREIGN KEY (`variant_id`) REFERENCES `product_variants` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_3` FOREIGN KEY (`variant_id`) REFERENCES `product_variants` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `product_photos`
--
ALTER TABLE `product_photos`
  ADD CONSTRAINT `product_photos_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_variants`
--
ALTER TABLE `product_variants`
  ADD CONSTRAINT `product_variants_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
