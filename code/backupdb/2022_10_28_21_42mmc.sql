-- Generation time: Fri, 28 Oct 2022 21:42:26 +0000
-- Host: localhost
-- DB name: mmc
/*!40030 SET NAMES UTF8 */;

DROP TABLE IF EXISTS `account`;
CREATE TABLE `account` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `source` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` int(25) NOT NULL,
  `paymenttype` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `movement` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `accountdate` date NOT NULL,
  `whodidthis` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `whenwasit` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `account` VALUES ('1','samir','safe','2050','cash','this is an exmaple note','deposit','2022-10-27','admin','2022-10-21'); 


DROP TABLE IF EXISTS `item_barcode`;
CREATE TABLE `item_barcode` (
  `id` bigint(25) NOT NULL AUTO_INCREMENT,
  `item_id` int(25) NOT NULL,
  `barcode` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `whenwasit` date NOT NULL,
  `whodidthis` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



DROP TABLE IF EXISTS `item_limmit`;
CREATE TABLE `item_limmit` (
  `id` bigint(25) NOT NULL AUTO_INCREMENT,
  `item_id` int(25) NOT NULL,
  `amount` int(25) NOT NULL,
  `whenwasit` date NOT NULL,
  `whodidthis` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



DROP TABLE IF EXISTS `item_package`;
CREATE TABLE `item_package` (
  `id` bigint(25) NOT NULL AUTO_INCREMENT,
  `item_id` int(25) NOT NULL,
  `amount` int(25) NOT NULL,
  `whenwasit` date NOT NULL,
  `whodidthis` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



DROP TABLE IF EXISTS `item_price`;
CREATE TABLE `item_price` (
  `id` bigint(255) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `bought` int(11) NOT NULL,
  `sold` int(15) NOT NULL,
  `active` int(1) NOT NULL,
  `whenwasit` date NOT NULL,
  `whodidit` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `item_price` VALUES ('2','6','10','20','0','2022-10-21','admin'),
('3','6','20','30','1','2022-10-21','admin'); 


DROP TABLE IF EXISTS `item_quantity`;
CREATE TABLE `item_quantity` (
  `id` bigint(255) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `expiredate` date NOT NULL,
  `active` int(1) NOT NULL,
  `whenwasit` date NOT NULL,
  `whodidit` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `item_quantity` VALUES ('2','6','100','2022-10-21','0','2022-10-21','admin'),
('3','6','200','2022-10-22','1','2022-10-21','admin'); 


DROP TABLE IF EXISTS `items`;
CREATE TABLE `items` (
  `id` bigint(15) NOT NULL AUTO_INCREMENT,
  `itemname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `itemcode` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `whenwasit` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `whodidit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `items` VALUES ('6','blood','b1','2022-10-21 14:08:24','admin'); 


DROP TABLE IF EXISTS `itemsells`;
CREATE TABLE `itemsells` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `itemid` int(25) NOT NULL,
  `priceid` int(25) NOT NULL,
  `quntity` int(25) NOT NULL,
  `orderno` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



DROP TABLE IF EXISTS `itemsellstemp`;
CREATE TABLE `itemsellstemp` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `itemid` int(25) NOT NULL,
  `priceid` int(25) NOT NULL,
  `quntity` int(25) NOT NULL,
  `orderno` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



DROP TABLE IF EXISTS `ordercount`;
CREATE TABLE `ordercount` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `orderno` bigint(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



DROP TABLE IF EXISTS `orderdetails`;
CREATE TABLE `orderdetails` (
  `id` bigint(25) NOT NULL AUTO_INCREMENT,
  `orderno` int(25) NOT NULL,
  `orderdate` date NOT NULL,
  `discount` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `perorvalue` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `whenwasit` datetime NOT NULL,
  `whodidit` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



DROP TABLE IF EXISTS `suppliers`;
CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `whenwasit` date NOT NULL,
  `whodidit` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



DROP TABLE IF EXISTS `suppliers_items`;
CREATE TABLE `suppliers_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantitygain` int(11) NOT NULL,
  `expiredate` date NOT NULL,
  `dataofdelivery` date NOT NULL,
  `whenwasit` date NOT NULL,
  `whodidthis` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `usertype` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `whenwasit` date NOT NULL,
  `whodidit` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` VALUES ('1','assim','home','0123123','A@SS','assass','Pharmacy','2022-10-20','admin'); 


