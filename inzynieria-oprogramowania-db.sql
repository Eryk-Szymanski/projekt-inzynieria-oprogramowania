-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2023 at 08:30 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inzynieria-oprogramowania-db`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `number` varchar(30) NOT NULL,
  `status` int(2) NOT NULL DEFAULT 0,
  `user_id` int(10) UNSIGNED NOT NULL,
  `products` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`products`)),
  `payment_method_id` int(10) UNSIGNED NOT NULL,
  `delivery_method_id` int(10) UNSIGNED NOT NULL,
  `delivery_address_id` int(10) UNSIGNED NOT NULL,
  `total_price` float UNSIGNED NOT NULL,
  `comments` varchar(300) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `number`, `status`, `user_id`, `products`, `payment_method_id`, `delivery_method_id`, `delivery_address_id`, `total_price`, `comments`, `created_at`) VALUES
(8, '123', 0, 26, '{}', 1, 2, 11, 123, 'aaa', '2023-05-30 19:49:43'),
(9, '1', 0, 26, '{}', 1, 2, 11, 123, 'aaa', '2023-05-30 19:59:11'),
(10, '20230530200503', 1, 26, '[{\"product_id\":3,\"quantity\":\"1\"}]', 3, 4, 11, 2, 'vx', '2023-05-30 20:06:03'),
(11, '20230530200543', 2, 26, '[{\"product_id\":3,\"quantity\":\"5\"}]', 1, 1, 11, 10, 'inpost karta prosze hehe', '2023-05-30 20:06:43'),
(12, '20230530200501', 0, 26, '[{\"product_id\":3,\"quantity\":\"1\"}]', 3, 2, 11, 2, 'abcv', '2023-05-30 20:16:01'),
(13, '20230531200558', 0, 26, '[{\"product_id\":3,\"quantity\":\"1\"},{\"product_id\":11,\"quantity\":\"1\"}]', 1, 1, 11, 12, 'ee', '2023-05-31 20:20:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `payment_method_id` (`payment_method_id`,`delivery_method_id`,`delivery_address_id`),
  ADD KEY `orders_ibfk_2` (`delivery_address_id`),
  ADD KEY `orders_ibfk_3` (`delivery_method_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`delivery_address_id`) REFERENCES `addresses` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`delivery_method_id`) REFERENCES `delivery_methods` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `orders_ibfk_4` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_methods` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
