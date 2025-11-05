-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 17, 2023 at 12:02 AM
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
-- Database: `mmc`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int(25) NOT NULL,
  `name` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `source` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` int(25) NOT NULL,
  `paymenttype` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `movement` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `accountdate` date NOT NULL,
  `whodidthis` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `whenwasit` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `name`, `source`, `amount`, `paymenttype`, `note`, `movement`, `accountdate`, `whodidthis`, `whenwasit`) VALUES
(2, 'doc cash', 'Expenses', 250, 'cash', 'test cash', 'withdrawal', '2023-01-16', 'admin', '2023-01-16'),
(3, 'cash', 'Income', 25, 'cash', 'cashcash', 'deposit', '2022-12-15', 'admin', '2023-01-16');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` bigint(15) NOT NULL,
  `itemname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `itemcode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `whenwasit` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `whodidit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `itemname`, `itemcode`, `whenwasit`, `whodidit`) VALUES
(6, 'blood', NULL, '2022-10-21 12:08:24', 'admin'),
(7, 'hell love', NULL, '2023-01-07 01:46:29', 'admin'),
(8, 'good', 'good2', '2023-01-13 17:46:33', 'admin'),
(9, 'eater', 'eater', '2023-01-16 12:15:53', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `itemsells`
--

CREATE TABLE `itemsells` (
  `id` int(25) NOT NULL,
  `itemid` int(25) NOT NULL,
  `priceid` int(25) NOT NULL,
  `quntity` int(25) NOT NULL,
  `orderno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `itemsells`
--

INSERT INTO `itemsells` (`id`, `itemid`, `priceid`, `quntity`, `orderno`) VALUES
(1, 8, 5, 2, 2),
(2, 6, 3, 1, 2),
(3, 8, 5, 1, 3),
(4, 8, 5, 1, 4),
(5, 8, 5, 1, 5),
(6, 9, 6, 10, 6),
(7, 9, 6, 10, 7),
(8, 9, 6, 10, 8),
(9, 7, 4, 1, 9);

-- --------------------------------------------------------

--
-- Table structure for table `itemsellstemp`
--

CREATE TABLE `itemsellstemp` (
  `id` int(25) NOT NULL,
  `itemid` int(25) NOT NULL,
  `priceid` int(25) NOT NULL,
  `quntity` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `item_barcode`
--

CREATE TABLE `item_barcode` (
  `id` bigint(25) NOT NULL,
  `item_id` int(25) NOT NULL,
  `barcode` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `whenwasit` date NOT NULL,
  `whodidthis` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `item_limmit`
--

CREATE TABLE `item_limmit` (
  `id` bigint(25) NOT NULL,
  `item_id` int(25) NOT NULL,
  `amount` int(25) NOT NULL,
  `whenwasit` date NOT NULL,
  `whodidthis` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `item_package`
--

CREATE TABLE `item_package` (
  `id` bigint(25) NOT NULL,
  `item_id` int(25) NOT NULL,
  `amount` int(25) NOT NULL,
  `whenwasit` date NOT NULL,
  `whodidthis` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `item_package`
--

INSERT INTO `item_package` (`id`, `item_id`, `amount`, `whenwasit`, `whodidthis`) VALUES
(2, 6, 12, '2023-01-07', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `item_price`
--

CREATE TABLE `item_price` (
  `id` bigint(255) NOT NULL,
  `item_id` int(11) NOT NULL,
  `bought` int(11) NOT NULL,
  `sold` int(15) NOT NULL,
  `active` int(1) NOT NULL,
  `whenwasit` date NOT NULL,
  `whodidit` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `item_price`
--

INSERT INTO `item_price` (`id`, `item_id`, `bought`, `sold`, `active`, `whenwasit`, `whodidit`) VALUES
(2, 6, 10, 20, 0, '2022-10-21', 'admin'),
(3, 6, 20, 30, 1, '2022-10-21', 'admin'),
(4, 7, 25, 50, 1, '2023-01-07', 'admin'),
(5, 8, 200, 250, 1, '2023-01-13', 'admin'),
(6, 9, 250, 300, 1, '2023-01-16', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `item_quantity`
--

CREATE TABLE `item_quantity` (
  `id` bigint(255) NOT NULL,
  `item_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `expiredate` date NOT NULL,
  `active` int(1) NOT NULL,
  `whenwasit` date NOT NULL,
  `whodidit` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `item_quantity`
--

INSERT INTO `item_quantity` (`id`, `item_id`, `amount`, `expiredate`, `active`, `whenwasit`, `whodidit`) VALUES
(2, 6, 3, '2022-10-21', 0, '2022-10-21', 'admin'),
(3, 6, 3, '2022-10-22', 0, '2022-10-21', 'admin'),
(4, 7, 2, '0000-00-00', 1, '2023-01-07', 'admin'),
(5, 6, 3, '2021-10-19', 0, '2023-01-07', 'admin'),
(6, 6, 3, '2023-01-26', 0, '2023-01-07', 'admin'),
(7, 6, 3, '0000-00-00', 0, '2023-01-07', 'admin'),
(8, 6, 3, '0000-00-00', 1, '2023-01-07', 'admin'),
(9, 8, 3, '2022-12-12', 1, '2023-01-13', 'admin'),
(10, 9, 0, '1991-12-14', 0, '2023-01-16', 'admin'),
(11, 9, 0, '2000-02-02', 0, '2023-01-16', 'admin'),
(12, 9, 3, '2002-02-16', 0, '2023-01-16', 'admin'),
(13, 9, 7, '3033-02-02', 1, '2023-01-16', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `ordercount`
--

CREATE TABLE `ordercount` (
  `id` int(25) NOT NULL,
  `orderno` bigint(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ordercount`
--

INSERT INTO `ordercount` (`id`, `orderno`) VALUES
(1, 9);

-- --------------------------------------------------------

--
-- Table structure for table `orderdetails`
--

CREATE TABLE `orderdetails` (
  `id` bigint(25) NOT NULL,
  `orderno` int(25) NOT NULL,
  `orderdate` date NOT NULL,
  `discount` int(25) NOT NULL,
  `perorvalue` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ordertotal` int(255) DEFAULT NULL,
  `whenwasit` datetime NOT NULL,
  `whodidit` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orderdetails`
--

INSERT INTO `orderdetails` (`id`, `orderno`, `orderdate`, `discount`, `perorvalue`, `ordertotal`, `whenwasit`, `whodidit`) VALUES
(1, 2, '2023-01-15', 0, 'non', 530, '2023-01-16 00:36:01', 'admin'),
(2, 3, '2023-01-15', 0, 'non', 250, '2023-01-16 00:46:33', 'admin'),
(3, 4, '2023-01-15', 0, 'non', 250, '2023-01-16 01:10:25', 'admin'),
(4, 5, '2023-01-15', 0, 'non', 250, '2023-01-16 01:46:26', 'admin'),
(5, 6, '2023-01-16', 0, 'non', 3000, '2023-01-16 14:17:55', 'admin'),
(6, 7, '2023-01-16', 0, 'non', 3000, '2023-01-16 14:20:04', 'admin'),
(7, 8, '2023-01-16', 0, 'non', 3000, '2023-01-16 14:22:38', 'admin'),
(8, 9, '2023-01-16', 0, 'non', 50, '2023-01-16 14:24:03', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL,
  `name` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `whenwasit` date NOT NULL,
  `whodidit` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers_items`
--

CREATE TABLE `suppliers_items` (
  `id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantitygain` int(11) NOT NULL,
  `expiredate` date NOT NULL,
  `dataofdelivery` date NOT NULL,
  `whenwasit` date NOT NULL,
  `whodidthis` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `usertype` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `whenwasit` date NOT NULL,
  `whodidit` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `address`, `phone`, `username`, `password`, `usertype`, `whenwasit`, `whodidit`) VALUES
(1, 'assim', 'home', '0123123', 'A@SS', 'assass', 'Pharmacy', '2022-10-20', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `itemsells`
--
ALTER TABLE `itemsells`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `itemsellstemp`
--
ALTER TABLE `itemsellstemp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_barcode`
--
ALTER TABLE `item_barcode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_limmit`
--
ALTER TABLE `item_limmit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_package`
--
ALTER TABLE `item_package`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_price`
--
ALTER TABLE `item_price`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_quantity`
--
ALTER TABLE `item_quantity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ordercount`
--
ALTER TABLE `ordercount`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers_items`
--
ALTER TABLE `suppliers_items`
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
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `itemsells`
--
ALTER TABLE `itemsells`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `itemsellstemp`
--
ALTER TABLE `itemsellstemp`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `item_barcode`
--
ALTER TABLE `item_barcode`
  MODIFY `id` bigint(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `item_limmit`
--
ALTER TABLE `item_limmit`
  MODIFY `id` bigint(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `item_package`
--
ALTER TABLE `item_package`
  MODIFY `id` bigint(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `item_price`
--
ALTER TABLE `item_price`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `item_quantity`
--
ALTER TABLE `item_quantity`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `ordercount`
--
ALTER TABLE `ordercount`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orderdetails`
--
ALTER TABLE `orderdetails`
  MODIFY `id` bigint(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `suppliers_items`
--
ALTER TABLE `suppliers_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
