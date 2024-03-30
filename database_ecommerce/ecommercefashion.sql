-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 08, 2024 at 09:56 AM
-- Server version: 8.2.0
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommercefashion`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `id` int NOT NULL AUTO_INCREMENT,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `phoneNumber` varchar(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `profile_url` varchar(255) NOT NULL,
  `username` varchar(20) NOT NULL,
  `passwords` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin_approves`
--

DROP TABLE IF EXISTS `admin_approves`;
CREATE TABLE IF NOT EXISTS `admin_approves` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `order_id` int NOT NULL,
  `discount_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `product_id` (`product_id`),
  KEY `order_id` (`order_id`),
  KEY `discount_id` (`discount_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_addvertisement`
--

DROP TABLE IF EXISTS `app_addvertisement`;
CREATE TABLE IF NOT EXISTS `app_addvertisement` (
  `id` int NOT NULL AUTO_INCREMENT,
  `add_name` varchar(100) NOT NULL,
  `product_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categorys`
--

DROP TABLE IF EXISTS `categorys`;
CREATE TABLE IF NOT EXISTS `categorys` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_name` varchar(40) NOT NULL,
  `descriptions` varchar(100) NOT NULL,
  `stock_id` int NOT NULL,
  `product_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  KEY `stock_id` (`stock_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `deliverys`
--

DROP TABLE IF EXISTS `deliverys`;
CREATE TABLE IF NOT EXISTS `deliverys` (
  `id` int NOT NULL AUTO_INCREMENT,
  `delivery_guy_name` varchar(20) NOT NULL,
  `delivery_guy_phone` varchar(15) NOT NULL,
  `product_id` int NOT NULL,
  `order_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  KEY `order_id` (`order_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `discount`
--

DROP TABLE IF EXISTS `discount`;
CREATE TABLE IF NOT EXISTS `discount` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `stock_id` int NOT NULL,
  `category_id` int NOT NULL,
  `discount_price` int NOT NULL,
  `start_discount` datetime NOT NULL,
  `out_date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  KEY `stock_id` (`stock_id`),
  KEY `category_id` (`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

DROP TABLE IF EXISTS `invoices`;
CREATE TABLE IF NOT EXISTS `invoices` (
  `id` int NOT NULL AUTO_INCREMENT,
  `dates` datetime NOT NULL,
  `product_id` int NOT NULL,
  `delivery_id` int NOT NULL,
  `order_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  KEY `delivery_id` (`delivery_id`),
  KEY `order_id` (`order_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `category_id` int NOT NULL,
  `stock_id` int NOT NULL,
  `payment_invoice` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `discount_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  KEY `stock_id` (`stock_id`),
  KEY `category_id` (`category_id`),
  KEY `user_id` (`user_id`),
  KEY `discount_id` (`discount_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_name` varchar(30) NOT NULL,
  `descriptions` varchar(100) NOT NULL,
  `price` int NOT NULL,
  `category_id` int NOT NULL,
  `stock_id` int NOT NULL,
  `discount_id` int NOT NULL,
  `product_url` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `stock_id` (`stock_id`),
  KEY `category_id` (`category_id`),
  KEY `discount_id` (`discount_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

DROP TABLE IF EXISTS `stocks`;
CREATE TABLE IF NOT EXISTS `stocks` (
  `id` int NOT NULL AUTO_INCREMENT,
  `stock_name` varchar(50) NOT NULL,
  `amount` int NOT NULL,
  `price` int NOT NULL,
  `stock_in` datetime DEFAULT NULL,
  `stock_out` datetime DEFAULT NULL,
  `product_id` int NOT NULL,
  `category_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  KEY `category_id` (`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `phoneNumber` varchar(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `profile_url` varchar(255) NOT NULL,
  `username` varchar(20) NOT NULL,
  `passwords` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
