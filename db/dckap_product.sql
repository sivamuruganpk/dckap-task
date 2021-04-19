-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2021 at 08:54 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dckap_product`
--

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_sku` varchar(10) NOT NULL,
  `product_short_description` varchar(255) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `product_description` varchar(255) NOT NULL,
  `product_image` text NOT NULL,
  `product_price` int(11) NOT NULL,
  `product_status` int(11) NOT NULL COMMENT '1-Active , 2-Inactive',
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_sku`, `product_short_description`, `product_quantity`, `product_description`, `product_image`, `product_price`, `product_status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(2, 'product1', 'p1', 'product1 update', 12, 'product1', 'product_images/template (5).jpg', 150, 1, '2021-04-19 12:16:35', 1, '0000-00-00 00:00:00', 1),
(3, 'product2', 'p2', 'product1', 1, 'product1', 'product_images/aa.jfif', 120, 1, '2021-04-19 12:17:41', 1, '0000-00-00 00:00:00', 0),
(4, 'product3', 'p3', 'product1', 1, 'product1', 'product_images/aa.jfif', 100, 1, '2021-04-19 12:18:04', 1, '0000-00-00 00:00:00', 0),
(5, 'product4', 'p4', 'product1', 1, 'product1', 'product_images/aa.jfif', 120, 1, '2021-04-19 12:18:24', 1, '0000-00-00 00:00:00', 0),
(6, 'product5', 'p5', 'product1', 1, 'product1', 'product_images/aa.jfif', 150, 1, '2021-04-19 12:18:43', 1, '0000-00-00 00:00:00', 0),
(7, 'product6', 'p6', 'product1', 1, 'product1', 'product_images/aa.jfif', 150, 1, '2021-04-19 12:19:01', 1, '0000-00-00 00:00:00', 0),
(8, 'product7', 'p7', 'product1', 1, 'product1', 'product_images/aa.jfif', 180, 1, '2021-04-19 12:19:22', 1, '0000-00-00 00:00:00', 0),
(9, 'product8', 'p8', 'product8', 1, 'product1', 'product_images/aa.jfif', 110, 1, '2021-04-19 12:19:46', 1, '0000-00-00 00:00:00', 0),
(10, 'product9', 'p9', 'product1', 1, 'product1', 'product_images/aa.jfif', 150, 1, '2021-04-19 12:20:05', 1, '0000-00-00 00:00:00', 0),
(11, 'product10', 'p10', 'product10', 1, 'product10', 'product_images/aa.jfif', 150, 2, '2021-04-19 12:20:26', 1, '0000-00-00 00:00:00', 1),
(13, 'product11', 'p11', 'product11', 1, 'product11', 'product_images/aa.jfif', 140, 1, '2021-04-19 12:22:07', 1, '0000-00-00 00:00:00', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD UNIQUE KEY `product_sku` (`product_sku`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
