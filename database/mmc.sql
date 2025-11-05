-- -------------------------------------------------------------
-- TablePlus 6.7.2(638)
--
-- https://tableplus.com/
--
-- Database: mmc
-- Generation Time: 2025-11-05 13:49:26.0740
-- -------------------------------------------------------------


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


DROP TABLE IF EXISTS `account`;
CREATE TABLE `account` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `source` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` int NOT NULL,
  `paymenttype` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `movement` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `accountdate` date NOT NULL,
  `whodidthis` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `whenwasit` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `item_barcode`;
CREATE TABLE `item_barcode` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `item_id` int NOT NULL,
  `barcode` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `whenwasit` date NOT NULL,
  `whodidthis` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `item_limmit`;
CREATE TABLE `item_limmit` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `item_id` int NOT NULL,
  `amount` int NOT NULL,
  `whenwasit` date NOT NULL,
  `whodidthis` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `item_package`;
CREATE TABLE `item_package` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `item_id` int NOT NULL,
  `amount` int NOT NULL,
  `whenwasit` date NOT NULL,
  `whodidthis` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `item_price`;
CREATE TABLE `item_price` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `item_id` int NOT NULL,
  `bought` int NOT NULL,
  `sold` int NOT NULL,
  `active` int NOT NULL,
  `whenwasit` date NOT NULL,
  `whodidit` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `item_quantity`;
CREATE TABLE `item_quantity` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `item_id` int NOT NULL,
  `amount` int NOT NULL,
  `expiredate` date NOT NULL,
  `active` int NOT NULL,
  `whenwasit` date NOT NULL,
  `whodidit` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `items`;
CREATE TABLE `items` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `itemname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `itemcode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `whenwasit` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `whodidit` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `itemsells`;
CREATE TABLE `itemsells` (
  `id` int NOT NULL AUTO_INCREMENT,
  `itemid` int NOT NULL,
  `priceid` int NOT NULL,
  `quntity` int NOT NULL,
  `orderno` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `itemsellstemp`;
CREATE TABLE `itemsellstemp` (
  `id` int NOT NULL AUTO_INCREMENT,
  `itemid` int NOT NULL,
  `priceid` int NOT NULL,
  `quntity` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `ordercount`;
CREATE TABLE `ordercount` (
  `id` int NOT NULL AUTO_INCREMENT,
  `orderno` bigint NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `orderdetails`;
CREATE TABLE `orderdetails` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `orderno` int NOT NULL,
  `orderdate` date NOT NULL,
  `discount` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `perorvalue` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ordertotal` int DEFAULT NULL,
  `whenwasit` datetime NOT NULL,
  `whodidit` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `suppliers`;
CREATE TABLE `suppliers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `whenwasit` date NOT NULL,
  `whodidit` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `suppliers_items`;
CREATE TABLE `suppliers_items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `supplier_id` int NOT NULL,
  `item_id` int NOT NULL,
  `quantitygain` int NOT NULL,
  `expiredate` date NOT NULL,
  `dataofdelivery` date NOT NULL,
  `whenwasit` date NOT NULL,
  `whodidthis` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `usertype` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `whenwasit` date NOT NULL,
  `whodidit` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `account` (`id`, `name`, `source`, `amount`, `paymenttype`, `note`, `movement`, `accountdate`, `whodidthis`, `whenwasit`) VALUES
(1, 'samir', 'safe', 2050, 'cash', 'this is an exmaple note', 'deposit', '2022-10-27', 'admin', '2022-10-21');

INSERT INTO `item_barcode` (`id`, `item_id`, `barcode`, `whenwasit`, `whodidthis`) VALUES
(3, 11, '900', '2025-11-05', 'admin');

INSERT INTO `item_package` (`id`, `item_id`, `amount`, `whenwasit`, `whodidthis`) VALUES
(2, 9, 2, '2023-01-09', 'admin'),
(4, 9, 9, '2023-01-10', 'admin'),
(5, 10, 9, '2023-01-10', 'admin');

INSERT INTO `item_price` (`id`, `item_id`, `bought`, `sold`, `active`, `whenwasit`, `whodidit`) VALUES
(2, 6, 10, 20, 0, '2022-10-21', 'admin'),
(3, 6, 250, 1000, 1, '2022-10-21', 'admin'),
(4, 7, 545, 1000, 1, '2022-12-24', 'admin'),
(5, 8, 90, 100, 1, '2023-01-06', 'admin'),
(6, 9, 9, 10, 1, '2023-01-07', 'admin'),
(7, 10, 10, 100, 1, '2023-01-10', 'admin'),
(8, 11, 900, 1200, 1, '2024-01-28', 'admin');

INSERT INTO `item_quantity` (`id`, `item_id`, `amount`, `expiredate`, `active`, `whenwasit`, `whodidit`) VALUES
(2, 6, 100, '2022-10-21', 0, '2022-10-21', 'admin'),
(3, 6, 200, '2022-10-22', 1, '2022-10-21', 'admin'),
(4, 7, 1, '2023-01-12', 0, '2022-12-24', 'admin'),
(5, 8, 19, '2023-12-05', 1, '2023-01-06', 'admin'),
(6, 7, 9, '2023-01-20', 1, '2023-01-07', 'admin'),
(7, 9, 900, '2022-12-06', 1, '2023-01-07', 'admin'),
(8, 10, 100, '2022-12-09', 1, '2023-01-10', 'admin'),
(9, 11, 9, '2022-12-27', 1, '2024-01-28', 'admin');

INSERT INTO `items` (`id`, `itemname`, `itemcode`, `whenwasit`, `whodidit`) VALUES
(6, 'blood', NULL, '2022-12-17 14:06:40', 'admin'),
(7, 'Amixim 400mg', NULL, '2022-12-24 22:46:30', 'admin'),
(8, 'hell drug', NULL, '2023-01-06 05:05:46', 'admin'),
(9, 'assim med', NULL, '2023-01-08 00:26:43', 'admin'),
(10, 'amno', NULL, '2023-01-10 15:59:47', 'admin'),
(11, 'blood', '900', '2024-01-28 16:23:48', 'admin');

INSERT INTO `itemsells` (`id`, `itemid`, `priceid`, `quntity`, `orderno`) VALUES
(1, 8, 5, 1, 3);

INSERT INTO `ordercount` (`id`, `orderno`) VALUES
(1, 2),
(2, 2);

INSERT INTO `orderdetails` (`id`, `orderno`, `orderdate`, `discount`, `perorvalue`, `ordertotal`, `whenwasit`, `whodidit`) VALUES
(1, 3, '2025-11-05', '0', '0', 100, '2025-11-05 13:40:21', 'admin');

INSERT INTO `suppliers` (`id`, `name`, `phone`, `whenwasit`, `whodidit`) VALUES
(2, 'supplie name', '09123123', '2023-01-06', 'admin');

INSERT INTO `users` (`id`, `name`, `address`, `phone`, `username`, `password`, `usertype`, `whenwasit`, `whodidit`) VALUES
(1, 'assim', 'home', '0123123', 'A@SS', 'assass', 'Pharmacy', '2022-10-20', 'admin');



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;