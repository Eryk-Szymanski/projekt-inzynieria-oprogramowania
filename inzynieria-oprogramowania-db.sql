-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2023 at 02:23 PM
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
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` int(10) UNSIGNED NOT NULL,
  `zipcode` varchar(10) COLLATE utf8mb4_polish_ci NOT NULL,
  `city` varchar(100) COLLATE utf8mb4_polish_ci NOT NULL,
  `street` varchar(100) COLLATE utf8mb4_polish_ci NOT NULL,
  `apartment` varchar(10) COLLATE utf8mb4_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`id`, `zipcode`, `city`, `street`, `apartment`) VALUES
(5, 'a', 'a', 'a', 'a'),
(6, 'e', 'e', 'e', 'e'),
(7, 'a', 'a', 'a', 'a'),
(8, 'a', 'a', 'a', 'a'),
(9, 'a', 'a', 'a', 'a'),
(10, 'a', 'a', 'a', 'a'),
(11, 'b', 'b', 'b', 'b'),
(12, 'h', 'h', 'h', 'h'),
(13, 'a', 'a', 'a', 'a'),
(14, 'j', 'j', 'j', 'j'),
(15, 'i', 'i', 'i', 'i'),
(16, 'y', 'y', 'y', 'y'),
(17, 'e', 'e', 'e', 'e'),
(18, '123', 'o', 'o', 'o'),
(19, '12-345', 'Test', 'Test', '5/3'),
(20, '12-345', 'Test', 'Test', '5/3'),
(21, '12-345', 'Test', 'Test', '5/3'),
(22, '12-345', 'Test', 'Test', '5/3'),
(23, '12-345', 'Test', 'Test', '6/7'),
(24, '1', 'u', 'u', 'u'),
(25, '1', 'u', 'u', 'u'),
(26, '2', 'f', 'f', 'f');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_methods`
--

CREATE TABLE `delivery_methods` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` enum('DHL','UPS','FedEx','InPost','Odbiór osobisty') COLLATE utf8mb4_polish_ci NOT NULL DEFAULT 'InPost',
  `price` float NOT NULL,
  `delivery_time` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `delivery_methods`
--

INSERT INTO `delivery_methods` (`id`, `name`, `price`, `delivery_time`) VALUES
(1, 'InPost', 8.99, 2),
(2, 'FedEx', 10.99, 2),
(3, 'UPS', 9.9, 3),
(4, 'DHL', 12, 3),
(5, 'Odbiór osobisty', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `number` varchar(30) NOT NULL,
  `status_id` int(2) NOT NULL DEFAULT 0,
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

INSERT INTO `orders` (`id`, `number`, `status_id`, `user_id`, `products`, `payment_method_id`, `delivery_method_id`, `delivery_address_id`, `total_price`, `comments`, `created_at`) VALUES
(8, '123', 2, 26, '{}', 1, 2, 11, 123, 'aaa', '2023-05-30 19:49:43'),
(9, '1', 2, 26, '{}', 1, 2, 11, 123, 'aaa', '2023-05-30 19:59:11'),
(10, '20230530200503', 3, 26, '[{\"product_id\":3,\"quantity\":\"1\"}]', 3, 4, 11, 2, 'vx', '2023-05-30 20:06:03'),
(11, '20230530200543', 2, 26, '[{\"product_id\":3,\"quantity\":\"5\"}]', 1, 1, 11, 10, 'inpost karta prosze hehe', '2023-05-30 20:06:43'),
(12, '20230530200501', 1, 26, '[{\"product_id\":3,\"quantity\":\"1\"}]', 3, 2, 11, 2, 'abcv', '2023-05-30 20:16:01'),
(13, '20230531200558', 1, 26, '[{\"product_id\":3,\"quantity\":\"1\"},{\"product_id\":11,\"quantity\":\"1\"}]', 1, 1, 11, 12, 'ee', '2023-05-31 20:20:58'),
(14, '20230604160648', 2, 26, '[{\"product_id\":3,\"quantity\":\"1\"},{\"product_id\":11,\"quantity\":\"1\"}]', 1, 1, 11, 12, 'ererer', '2023-06-04 16:08:48'),
(15, '20230604160635', 1, 26, '[{\"product_id\":3,\"quantity\":\"1\"}]', 1, 4, 11, 2, 'yyyuuu', '2023-06-04 16:10:35'),
(16, '20230605210620', 3, 26, '[{\"product_id\":3,\"quantity\":\"1\"},{\"product_id\":12,\"quantity\":\"1\"}]', 1, 1, 11, 10, 'test', '2023-06-05 21:00:20'),
(17, '20230605210603', 2, 36, '[{\"product_id\":3,\"quantity\":\"1\"},{\"product_id\":11,\"quantity\":\"1\"}]', 1, 2, 21, 12, 'test', '2023-06-05 21:27:03'),
(18, '20230607160619', 1, 26, '[{\"product_id\":3,\"quantity\":\"1\"},{\"product_id\":11,\"quantity\":\"1\"},{\"product_id\":18,\"quantity\":\"1\"}]', 1, 1, 11, 34, 'a', '2023-06-07 16:21:19'),
(19, '20230607160639', 2, 26, '[{\"product_id\":12,\"quantity\":\"1\"},{\"product_id\":13,\"quantity\":\"1\"}]', 3, 5, 11, 131, 'hyhy', '2023-06-07 16:22:39'),
(20, '20230607190648', 3, 26, '[{\"product_id\":3,\"quantity\":\"1\"},{\"product_id\":22,\"quantity\":\"1\"},{\"product_id\":12,\"quantity\":\"1\"}]', 3, 1, 11, 11, 'ttt', '2023-06-07 19:41:48'),
(21, '20230608130641', 3, 29, '[{\"product_id\":3,\"quantity\":\"1\"},{\"product_id\":22,\"quantity\":\"1\"}]', 1, 2, 14, 3, 'eee', '2023-06-08 13:47:41'),
(26, '20230608140620', 1, 26, '[{\"product_id\":3,\"quantity\":\"1\"},{\"product_id\":11,\"quantity\":\"1\"}]', 1, 1, 11, 10, 'eee', '2023-06-08 14:12:20'),
(27, '20230608140602', 2, 29, '[{\"product_id\":11,\"quantity\":\"1\"},{\"product_id\":14,\"quantity\":\"1\"}]', 3, 2, 14, 63, 'qqq', '2023-06-08 14:13:02');

-- --------------------------------------------------------

--
-- Table structure for table `order_statuses`
--

CREATE TABLE `order_statuses` (
  `id` int(10) NOT NULL,
  `name` enum('Otrzymany','Zaakceptowany','Odrzucony') COLLATE utf8mb4_polish_ci NOT NULL DEFAULT 'Otrzymany'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `order_statuses`
--

INSERT INTO `order_statuses` (`id`, `name`) VALUES
(1, 'Otrzymany'),
(2, 'Zaakceptowany'),
(3, 'Odrzucony');

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` enum('Karta','Za pobraniem','Online') COLLATE utf8mb4_polish_ci NOT NULL DEFAULT 'Karta'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `name`) VALUES
(1, 'Karta'),
(2, 'Za pobraniem'),
(3, 'Online');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `weight` int(10) DEFAULT NULL,
  `is_available` tinyint(1) DEFAULT NULL,
  `description` varchar(300) NOT NULL,
  `calories` int(10) DEFAULT NULL,
  `price` float UNSIGNED NOT NULL,
  `image_path` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `weight`, `is_available`, `description`, `calories`, `price`, `image_path`) VALUES
(3, 'Cukierek', 1, 1, '<br>\r\nCukierek\r\n<br>\r\nSkład: cukier, cukier trzcinowy, karmel, cynamon\r\n<br>\r\nTermin ważności: 180 dni od dnia produkcji podanego na etykiecie', 10, 2, ''),
(11, 'Czekolada', 12, 1, 'Czekolada mleczna', 130, 8, '../uploads/'),
(12, 'Pączek', 10, 1, 'Pączek', 120, 8, ''),
(14, 'tester', 55, 1, 'tester', 55, 55, ''),
(17, 'Krówka', 1, 1, 'Krówka karmelowa', 10, 2, ''),
(18, 'cupcake', 123, 1, 'tyest', 45, 22, ''),
(19, 't', 1, 1, 't', 12, 34, ''),
(20, 'y', 1, 1, 'y', 1, 1, ''),
(21, 'q', 1, 1, 'q', 1, 1, ''),
(22, 'a', 1, 1, 'a', 1, 1, '../uploads/cukierki-candy-nut-soft-carmel-kg-roshen.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `role` enum('admin','employee','user') CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`) VALUES
(1, 'admin'),
(2, 'employee'),
(3, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(40) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `email` varchar(60) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `pass` varchar(100) NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL DEFAULT 3,
  `address_id` int(10) UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `email`, `phone`, `pass`, `role_id`, `address_id`, `created_at`) VALUES
(26, 'bbbbbbbbbbbbbbbbbb', 'b', 'b@b.pl', 'b', '$argon2id$v=19$m=65536,t=4,p=1$WFBZZWlabDVhUzBjMVhMeA$kgPwcgJRzXD9GyJt83OTyL9ckSyyUvZ374SPv6lw+sE', 2, 11, '2023-05-28 19:35:29'),
(27, 'h', 'h', 'h@h.com', 'h', '$argon2id$v=19$m=65536,t=4,p=1$TGVKYS9OV25pWkhpdWpPbg$xbIZxfS43A6rV3O0svXD5r5wRlkaSAXj/1AwxdwqOOM', 3, 12, '2023-05-31 18:49:46'),
(28, 'a', 'a', 'a@a.pl', 'a', '$argon2id$v=19$m=65536,t=4,p=1$M1AydUtUUlkud25zazgvUA$xVw0U+82M8q+HSyCB6kB4VM14AZNvmW8aCfvrrhFJfs', 1, 13, '2023-05-31 19:45:00'),
(29, 'j', 'j', 'j@j.com', 'j', '$argon2id$v=19$m=65536,t=4,p=1$bHlVQUlUS056QnVhZUhRWQ$tVlpw4USJryLsGhd9FR2VUPhYmyXcVqWPviyQvPqzjk', 3, 14, '2023-06-01 18:40:57'),
(30, 'i', 'i', 'i@i.com', 'i', '$argon2id$v=19$m=65536,t=4,p=1$T0hDNmRkQzdrUnNCb3FjQQ$395MW5AO8dFdXoLgSjdJHIdbtj0al7vTfDeJ5s2bQks', 3, 15, '2023-06-01 18:42:24'),
(31, 'y', 'y', 'y@y.com', 'y', '$argon2id$v=19$m=65536,t=4,p=1$c1cuWDluMXcvaFBxL3RINQ$cMPQWuEI7d8JxTO+aSSBTDAvgMC+S/QzHNj6JMG3NDo', 3, 16, '2023-06-04 14:57:08'),
(32, 'e', 'e', 'ers@ers.pl', 'ee', '$argon2id$v=19$m=65536,t=4,p=1$dEhibGNmaDZ4dS5EeHpLeA$7zm3UzEFaJ2NxoMpNWUL/IrhGu2f++yF9gvujil75+s', 3, 17, '2023-06-04 14:57:31'),
(33, 'o', 'o', 'o@o.com', '123', '$argon2id$v=19$m=65536,t=4,p=1$Rm9JQzRUNk8ySmxqUTNEMA$OYo1Ci+ct2uyDX0F3d/t3uOrDwP5PG0yOR3YTw0nMD0', 3, 18, '2023-06-05 20:49:57'),
(36, 'Test', 'Tester', 'test@test.com', '123456789', '$argon2id$v=19$m=65536,t=4,p=1$ZlF6YnZkaVJxcW5VbGd3VQ$IT/Rfe+VC5Q4KeyGy29LD5qyj1hfaLAhHkei6SLIRzY', 3, 21, '2023-06-05 20:53:10'),
(38, 'Pracownik', 'Pracowniczy', 'pracownik@candyshop.com', '123456789', '$argon2id$v=19$m=65536,t=4,p=1$eURoTWtKYnpJakd2Vkd6cw$binm+eIwcX/mEUtJKweVvrLcACEYX5fBUE41iYQ4Yao', 2, 23, '2023-06-05 20:57:20'),
(39, 'u', 'u', 'u@u.com', '1', '$argon2id$v=19$m=65536,t=4,p=1$cVlCMnpqYkkvcUszR1FJbQ$kl7FLmYRkZIxV4XzYxorEJOrJLL5wqeyknM8DZIGjlk', 3, 24, '2023-06-07 15:59:48'),
(41, 'f', 'f', 'f@f.com', '2', '$argon2id$v=19$m=65536,t=4,p=1$ekZRV0lueS9laE4wTlcyeA$rq0T2zo1uZT+1VpUupjTk4fyCvPyjoP5uvNivW8fdc0', 3, 26, '2023-06-07 16:04:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_methods`
--
ALTER TABLE `delivery_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `payment_method_id` (`payment_method_id`,`delivery_method_id`,`delivery_address_id`),
  ADD KEY `orders_ibfk_2` (`delivery_address_id`),
  ADD KEY `orders_ibfk_3` (`delivery_method_id`),
  ADD KEY `status_id` (`status_id`);

--
-- Indexes for table `order_statuses`
--
ALTER TABLE `order_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `role` (`role_id`),
  ADD KEY `address_id` (`address_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `delivery_methods`
--
ALTER TABLE `delivery_methods`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `order_statuses`
--
ALTER TABLE `order_statuses`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

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
  ADD CONSTRAINT `orders_ibfk_4` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_methods` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `orders_ibfk_5` FOREIGN KEY (`status_id`) REFERENCES `order_statuses` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`address_id`) REFERENCES `addresses` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
