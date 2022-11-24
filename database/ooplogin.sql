-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2022 at 01:24 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ooplogin`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `prod_qty` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `size` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `prod_id`, `prod_qty`, `created_at`, `size`) VALUES
(20, 3, 6, 5, '2022-11-24 11:37:18', 'S');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `tracking_id` varchar(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` mediumtext NOT NULL,
  `pincode` int(255) NOT NULL,
  `total_price` int(255) NOT NULL,
  `payment_mode` varchar(255) NOT NULL,
  `payment_id` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `comments` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `tracking_id`, `user_id`, `name`, `email`, `phone`, `address`, `pincode`, `total_price`, `payment_mode`, `payment_id`, `status`, `comments`, `created_at`) VALUES
(1, 'GraphShirt837dasds', 3, 'asd', 'asd@gmail.com', 'asdasds', 'test', 4027, 750, 'COD', NULL, 1, NULL, '2022-11-17 08:51:33'),
(2, 'GraphShirt555995602388', 3, ' Marc', 'users1@mail.com', '09995602388', 'angdasd', 4027, 450, 'COD', NULL, 1, NULL, '2022-11-21 08:12:45'),
(3, 'GraphShirt318332222222', 3, ' AAAAA', 'users1@mail.com', '09332222222', 'sdadsa dsadasdsadsadsa', 2323, 300, 'COD', NULL, 1, NULL, '2022-11-23 13:44:40');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(255) NOT NULL,
  `prod_id` int(255) NOT NULL,
  `qty` int(255) NOT NULL,
  `price` int(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `size` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `prod_id`, `qty`, `price`, `created_at`, `size`) VALUES
(1, 1, 1, 3, 250, '2022-11-17 08:51:33', 'S'),
(2, 2, 3, 1, 450, '2022-11-21 08:12:45', 'M'),
(3, 3, 2, 1, 300, '2022-11-23 13:44:40', 'M');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `slug`, `image`, `description`, `price`, `quantity`) VALUES
(1, 'klaus design shirt', 'klaus design shirt', '1668314395.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', 250, 17),
(2, 'swak bronx shirt', 'swak bronx shirt', '1668314529.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', 300, 19),
(3, 'Soap for the best design', 'Soap for the best design', '1668314630.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', 450, 19),
(4, 'Graffiti not a crime shirt', 'Graffiti not a crime shirt', '1668314701.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', 550, 20),
(5, 'Black graffiti not a crime', 'Black graffiti not a crime shirt', '1668314804.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', 560, 20),
(6, 'test', 'test shirt', '1668585031.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,', 500, 20),
(7, 'custom', 'custom', '1669292101.', 'custom', 300, 1),
(8, 'custom', 'custom', '1669292285.', 'custom', 300, 1),
(9, 'custom', 'custom', '1669292414.jpg', 'custom', 300, 1);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_orders`
--

CREATE TABLE `purchase_orders` (
  `id` int(11) NOT NULL,
  `code` varchar(100) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `supplier_product_id` int(11) NOT NULL,
  `unit` varchar(100) NOT NULL,
  `cost` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `discount` decimal(10,0) DEFAULT 0,
  `tax` decimal(10,0) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchase_orders`
--

INSERT INTO `purchase_orders` (`id`, `code`, `supplier_id`, `supplier_product_id`, `unit`, `cost`, `quantity`, `discount`, `tax`, `created_at`, `updated_at`) VALUES
(16, 'PO-2022-11-24-8bTYn', 1, 3, 'aaa', 1000, 24, '0', '0', '2022-11-24 10:51:47', '2022-11-24 10:51:47'),
(17, 'PO-2022-11-24-nE7uu', 2, 1, 'pcs', 200, 10, '0', '0', '2022-11-24 10:51:59', '2022-11-24 10:51:59'),
(18, 'PO-2022-11-24-nE7uu', 2, 2, 'pcs', 300, 20, '0', '0', '2022-11-24 10:51:59', '2022-11-24 10:51:59');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `rating` varchar(200) NOT NULL,
  `message` varchar(200) NOT NULL,
  `datetime` varchar(200) NOT NULL,
  `prod_id` int(255) NOT NULL,
  `prod_slug` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `name`, `rating`, `message`, `datetime`, `prod_id`, `prod_slug`) VALUES
(1, 'user', '1', ':(((', '1668505840', 1, ''),
(2, 'user', '2', 'test', '1668506291', 1, ''),
(3, 'user', '5', 'test', '1668506694', 1, ''),
(4, 'user', '4', 'test', '1668506731', 2, ''),
(5, 'user', '5', '123', '1668508991', 1, ''),
(6, 'user', '2', 'Hayst', '1668519227', 1, ''),
(7, 'user', '2', 'aw', '1668519586', 1, 'klaus design shirt'),
(8, 'user', '1', 'a', '1668519908', 1, 'klaus design shirt'),
(9, 'user', '1', 'Ang pangit ng damit', '1668570095', 1, 'klaus design shirt'),
(10, 'user', '5', 'Nice shirt!', '1668878885', 4, 'Graffiti not a crime shirt');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `address` text NOT NULL,
  `contact_person` varchar(250) NOT NULL,
  `contact_number` varchar(20) DEFAULT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `address`, `contact_person`, `contact_number`, `status`) VALUES
(1, 'Zooyork', 'Supplier A address', 'Supplier A contact person', '10000001', '1'),
(2, 'Vans', 'Supplier B address', 'Jema', '09454223555', '1');

-- --------------------------------------------------------

--
-- Table structure for table `supplier_products`
--

CREATE TABLE `supplier_products` (
  `id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `slug` varchar(250) DEFAULT NULL,
  `description` text NOT NULL,
  `cost` decimal(10,0) NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier_products`
--

INSERT INTO `supplier_products` (`id`, `supplier_id`, `name`, `slug`, `description`, `cost`, `status`, `date_created`, `date_updated`) VALUES
(1, 2, 'New Item 1', 'New Item 1', 'New Item 1', '200', '1', '2022-11-23 23:18:21', '2022-11-23 23:18:21'),
(2, 2, 'Vans', 'Vanz', 'Vansz', '300', '1', '2022-11-24 01:05:58', '2022-11-24 01:05:58'),
(3, 1, 'Zooyork plain tee', 'Zooyork plain tee', 'Zooyork plain tee', '1000', '1', '2022-11-24 03:33:16', '2022-11-24 03:33:16');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` tinyint(4) NOT NULL DEFAULT 0,
  `verification_code` varchar(255) NOT NULL,
  `verified_at` datetime DEFAULT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `verification_code`, `verified_at`, `firstname`, `lastname`) VALUES
(2, 'admin', 'users@mail.com', 'password', 1, '172448', '2022-09-18 10:34:46', '', ''),
(3, 'user', 'users1@mail.com', 'password', 0, '317238', '2022-09-21 09:20:04', '', ''),
(4, 'user1', 'user1@mail.com', 'password', 0, '172786', '2022-09-21 14:22:45', '', ''),
(5, 'test', '323455@gmail.com', 'test', 0, '205333', '2022-11-12 10:06:35', '', ''),
(6, 'users', '323455@gmail.com', 'password', 0, '412783', NULL, '', ''),
(7, 'robert', 'jayargh10@gmail.com', '12345678', 0, '958420', '2022-11-07 16:25:36', '', ''),
(8, 'piwi', 'jiepi0724@gmail.com', 'Qwertyui1!', 0, '314164', '2022-11-16 04:02:22', '', ''),
(9, 'nath', 'mnbvc@gmail.com', 'Qwertyui1!', 0, '364788', '2022-11-16 04:01:26', 'Nathaniel', 'Rabacal'),
(10, 'nathh', 'ppskasd@gmail.com', 'Qwertyui1!', 0, '916776', '2022-11-16 04:16:03', 'nathaniel', 'rabacal');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
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
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier_products`
--
ALTER TABLE `supplier_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `supplier_products`
--
ALTER TABLE `supplier_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
