-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2022 at 11:36 AM
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
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `gcash_qr` varchar(250) DEFAULT NULL,
  `account_name` varchar(250) DEFAULT NULL,
  `contact_number` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `gcash_qr`, `account_name`, `contact_number`) VALUES
(1, '1670062382.jpg', 'STI Group', '0988534343');

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
  `proof_of_payment` varchar(250) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `tracking_id`, `user_id`, `name`, `email`, `phone`, `address`, `pincode`, `total_price`, `payment_mode`, `payment_id`, `status`, `comments`, `proof_of_payment`, `created_at`) VALUES
(11, 'GraphShirt1843434343', 3, 'Person A', 'users1@mail.com', '093434343', 'calamba laguna barangay barandal', 2147483647, 400, 'GCASH', NULL, 1, NULL, '1670063282.jpg', '2022-12-03 10:26:57');

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
(15, 11, 63, 2, 200, '2022-12-03 10:26:57', 'L');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `code` varchar(50) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `size` varchar(10) NOT NULL DEFAULT 'S',
  `color` varchar(50) NOT NULL DEFAULT 'black',
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `max_quantity` int(11) NOT NULL DEFAULT 20
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `code`, `name`, `size`, `color`, `slug`, `image`, `description`, `price`, `quantity`, `max_quantity`) VALUES
(1, 'sd2d2d', 'klaus design shirt', 'S', 'black', 'klaus design shirt', '1668314395.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', 250, 17, 20),
(2, 'asaasd334343', 'swak bronx shirt', 'S', 'black', 'swak bronx shirt', '1668314529.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', 300, 16, 20),
(3, 'azv3asd', 'Soap for the best design', 'S', 'black', 'Soap for the best design', '1668314630.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', 450, 17, 20),
(4, 'sds2fg4', 'Graffiti not a crime shirt', 'S', 'black', 'Graffiti not a crime shirt', '1668314701.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', 550, 15, 20),
(55, '1', 'Black and White', 'S', 'black', 'Black and White', 'a.png', 'Black and White', 200, 332, 20),
(58, '3', 'Zooyork plain tee', 'S', 'black', 'Zooyork plain tee', 'null', 'Zooyork plain tee', 1000, 24, 20),
(59, '7', 'Zoo York Limited 2022 collection', 'S', 'black', 'Zoo York Limited 2022 collection', 'b.jpg', 'Zoo York Limited 2022 collection', 200, 0, 20),
(63, '7', 'Zoo York Limited 2022 collection', 'L', 'orange', 'Zoo York Limited 2022 collection', 'c.jpg', 'Zoo York Limited 2022 collection', 200, 3, 20),
(65, '11', 'Zooyork T', 'L', 'black', 'Zooyork T', '1669554035.png', 'Zooyork T', 1700, 7, 20);

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
(10, 'user', '5', 'Nice shirt!', '1668878885', 4, 'Graffiti not a crime shirt'),
(11, 'user', '4', 'erer', '1669359899', 3, 'Soap for the best design');

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
  `size` varchar(10) NOT NULL DEFAULT 'S',
  `image` varchar(250) NOT NULL,
  `color` varchar(20) NOT NULL DEFAULT 'black',
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

INSERT INTO `supplier_products` (`id`, `supplier_id`, `name`, `size`, `image`, `color`, `slug`, `description`, `cost`, `status`, `date_created`, `date_updated`) VALUES
(11, 1, 'Zooyork T', 'L', '1669554035.png', 'black', 'Zooyork T', 'Zooyork T', '1700', '1', '2022-11-27 13:00:35', '2022-11-27 13:00:35');

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
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `supplier_products`
--
ALTER TABLE `supplier_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
