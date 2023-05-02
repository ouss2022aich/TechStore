-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2023 at 04:00 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tech_shop_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id_bra` int(11) NOT NULL,
  `des_bra` varchar(100) NOT NULL,
  `country` varchar(60) NOT NULL,
  `bra_img` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id_bra`, `des_bra`, `country`, `bra_img`) VALUES
(12, 'Nike', 'United States', '55b1df23ac62b268542e'),
(13, 'Tesla', 'Réunion', '5a8ef4a336fff6e5eba7'),
(14, 'Apple', 'United States', '0843ff4345f015dd40cc'),
(15, 'Samsung', 'South Korea', '6dca89b8c506f40e2352');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id_cat` int(11) NOT NULL,
  `des_cat` varchar(60) NOT NULL,
  `id_par_cat` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id_cat`, `des_cat`, `id_par_cat`) VALUES
(1, 'Accésoires', NULL),
(2, 'Télephones & Tablettes', NULL),
(3, 'Computer', NULL),
(4, 'Watch', 1),
(5, 'Bands', 1),
(6, 'Transportation', NULL),
(7, 'Manufactoring', NULL),
(8, 'Phone', 2),
(9, 'Tablet', 2);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id_prod` int(11) NOT NULL,
  `des_prod` varchar(100) NOT NULL,
  `price_prod` varchar(11) NOT NULL DEFAULT '0',
  `discount_prod` int(3) NOT NULL DEFAULT 0,
  `desc_prod` text NOT NULL,
  `qte_prod` int(11) NOT NULL DEFAULT 0,
  `cat_prod` int(11) NOT NULL,
  `bra_prod` int(11) NOT NULL,
  `added_prod` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id_prod`, `des_prod`, `price_prod`, `discount_prod`, `desc_prod`, `qte_prod`, `cat_prod`, `bra_prod`, `added_prod`) VALUES
(14, 'Apple Watch', '10,000.00', 0, 'this is apple watch\r\n...', 100, 4, 14, '2022-10-21 11:49:36'),
(15, 'IPhone 13 Pro Max', '12,000.00', 10, 'this is latest iphone 13 pro max\r\n    ', 50, 8, 14, '2022-10-20 11:49:36'),
(16, 'Samsung Tab A', '50,000.00', 55, 'this is the latest tab in samsung', 50, 9, 15, '2022-10-21 19:35:29');

-- --------------------------------------------------------

--
-- Table structure for table `prod_pics`
--

CREATE TABLE `prod_pics` (
  `id_prod_pic` int(11) NOT NULL,
  `prod_pic_fn` varchar(20) NOT NULL,
  `prod_pic_clr` varchar(20) NOT NULL,
  `id_prode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `prod_pics`
--

INSERT INTO `prod_pics` (`id_prod_pic`, `prod_pic_fn`, `prod_pic_clr`, `id_prode`) VALUES
(10, 'fcbafee8f8dd71c3371d', '#ffffff', 14),
(11, 'c3e7eab4fce60136b466', '#fcff2e', 14),
(12, 'a4906ef83762c7ffd11f', '#000000', 15),
(13, 'c2d82981e6773f1b8ecd', '#feffa8', 15),
(14, '35aa598b052afe89be4b', '#ff2424', 15),
(15, '274617392aec3495a0e8', '#666666', 16),
(16, 'a73540d2290fe023a5e3', '#ff9494', 16),
(17, '6bcab82bc2770c769476', '#94c8ff', 16);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id_bra`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id_cat`),
  ADD KEY `FK_cate` (`id_par_cat`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id_prod`),
  ADD KEY `FK_cat_prod` (`cat_prod`),
  ADD KEY `FK_bra_prod` (`bra_prod`);

--
-- Indexes for table `prod_pics`
--
ALTER TABLE `prod_pics`
  ADD PRIMARY KEY (`id_prod_pic`),
  ADD KEY `FK_prod_pics` (`id_prode`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id_bra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id_cat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id_prod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `prod_pics`
--
ALTER TABLE `prod_pics`
  MODIFY `id_prod_pic` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `FK_cate` FOREIGN KEY (`id_par_cat`) REFERENCES `category` (`id_cat`) ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `FK_bra_prod` FOREIGN KEY (`bra_prod`) REFERENCES `brand` (`id_bra`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_cat_prod` FOREIGN KEY (`cat_prod`) REFERENCES `category` (`id_cat`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `prod_pics`
--
ALTER TABLE `prod_pics`
  ADD CONSTRAINT `FK_prod_pics` FOREIGN KEY (`id_prode`) REFERENCES `product` (`id_prod`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
