-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2023 at 06:55 PM
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
(29, '12-345', 'Poznań', 'Testowa', '12/32'),
(30, '12-345', 'Poznań', 'Testowa', '456'),
(31, '12-345', 'Nowy Jork', 'Łoszingtona', '543/12'),
(32, '12-345', 'Test', 'Test', '5/3'),
(33, '12-345', 'Test', 'Test', '5/3'),
(34, '12-345', 'Test', 'Test', '5/3');

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
(35, '20230613180625', 2, 45, '[{\"product_id\":30,\"quantity\":\"4\"},{\"product_id\":33,\"quantity\":\"14\"}]', 1, 1, 30, 208, 'Szybko chce', '2023-06-13 18:45:25'),
(36, '20230613180655', 2, 45, '[{\"product_id\":32,\"quantity\":\"100\"}]', 3, 2, 30, 700, 'Na bogato', '2023-06-13 18:45:55'),
(37, '20230613180619', 3, 45, '[{\"product_id\":34,\"quantity\":\"10\"},{\"product_id\":33,\"quantity\":\"12\"}]', 2, 4, 30, 268, 'Bez komentarza', '2023-06-13 18:46:19'),
(38, '20230613180640', 2, 45, '[{\"product_id\":30,\"quantity\":\"150\"}]', 1, 5, 30, 450, 'Na impreze', '2023-06-13 18:46:40'),
(39, '20230613180600', 1, 45, '[{\"product_id\":30,\"quantity\":\"120\"},{\"product_id\":31,\"quantity\":\"15\"}]', 3, 1, 30, 435, 'Test', '2023-06-13 18:55:00');

-- --------------------------------------------------------

--
-- Table structure for table `order_statuses`
--

CREATE TABLE `order_statuses` (
  `id` int(10) NOT NULL,
  `name` enum('Otrzymane','Zaakceptowane','Odrzucone') COLLATE utf8mb4_polish_ci NOT NULL DEFAULT 'Otrzymane'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `order_statuses`
--

INSERT INTO `order_statuses` (`id`, `name`) VALUES
(1, 'Otrzymane'),
(2, 'Zaakceptowane'),
(3, 'Odrzucone');

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
(30, 'Krówka', 12, 1, 'Skład: mleko, karmel<br>Termin ważności: 30/07/2025', 123, 3, '../uploads/krowka-kremowka-mieszko-cukierki-toffi-karmelowe--601252_1.jpg'),
(31, 'Cukierek czekoladowy', 45, 1, 'Skład: mleko, karmel, czekolada<br>Termin ważności: 30/07/2025', 123, 5, '../uploads/cukierki-michalki-klasyczne-kg-wawel.jpg'),
(32, 'Cukierki owocowe', 45, 1, 'Skład: owoce<br>Termin ważności: 30/07/2025', 56, 7, '../uploads/odessa_market_roshen_cukierki_bim_bom.jpg'),
(33, 'Cukierki herbaciane', 76, 1, 'Skład: herbata, czekolada<br>Termin ważności: 30/07/2025', 123, 14, '../uploads/Cukierki-z-czarna-herbata-z-Yunnanu-czerwona-chinska-Dian-Hong.jpg'),
(34, 'Cukierki toffi', 124, 1, 'Skład: mleko, karmel, czekolada<br>Termin ważności: 30/07/2025', 123, 10, '../uploads/pol_pl_Cukierki-Toffino-luz-kg-4501_1.jpg');

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
(44, 'Pracownik', 'Testowy', 'e@e.com', '123456789', '$argon2id$v=19$m=65536,t=4,p=1$aTcyN3ZYN2pxNmZGMmUzMw$GFhn0+Itvx8K+2IwZbFMlkU1YconQn6bWGSRBn4TOWQ', 2, 29, '2023-06-13 18:29:39'),
(45, 'Użytkownik', 'Testowy', 'u@u.com', '123456789', '$argon2id$v=19$m=65536,t=4,p=1$WWgyZ3ZtcE1zQldBLkhHZg$s/6OUv0pzlDWV3BEkSgtcXjncZXD5V7OERZ8E/lUuKQ', 3, 30, '2023-06-13 18:30:15'),
(46, 'Admin', 'Testowy', 'a@a.com', '123456789', '$argon2id$v=19$m=65536,t=4,p=1$Ui4vMFRrV0RrSVVxcXZhbA$/KGzm0xe9+4R0Hxu689BdoX6jzquSZnDLLmKzrqZA+A', 1, 31, '2023-06-13 18:30:58'),
(47, 'Test', 'Tester', 'test@test.com', '123456789', '$argon2id$v=19$m=65536,t=4,p=1$b3I4a1FuTHBuZnUuRFZwZg$uX62GGyoHsyUTXpa4NgX+TRs9HoepcIEniYQS15pcpA', 3, 32, '2023-06-13 18:49:43');

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `delivery_methods`
--
ALTER TABLE `delivery_methods`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

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
