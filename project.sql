-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2020 at 07:40 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_profile`
--

CREATE TABLE `admin_profile` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `userid` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_profile`
--

INSERT INTO `admin_profile` (`id`, `name`, `userid`, `password`) VALUES
(1, 'Deepak Singla', 'deepak', '123');

-- --------------------------------------------------------

--
-- Table structure for table `allowed_medicines`
--

CREATE TABLE `allowed_medicines` (
  `id` int(11) NOT NULL,
  `cid` int(255) NOT NULL,
  `mid` int(255) NOT NULL,
  `status` enum('0','1') NOT NULL,
  `prescription_required` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `allowed_medicines`
--

INSERT INTO `allowed_medicines` (`id`, `cid`, `mid`, `status`, `prescription_required`) VALUES
(7, 1, 7, '1', '1'),
(9, 1, 4, '1', '1'),
(10, 1, 6, '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `applypromo`
--

CREATE TABLE `applypromo` (
  `id` int(11) NOT NULL,
  `cid` int(255) NOT NULL,
  `pcid` int(255) NOT NULL,
  `status` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `applypromo`
--

INSERT INTO `applypromo` (`id`, `cid`, `pcid`, `status`) VALUES
(22, 1, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `cid` int(255) NOT NULL,
  `mid` int(255) NOT NULL,
  `date` date NOT NULL,
  `quantity` int(255) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `cid`, `mid`, `date`, `quantity`) VALUES
(6, 2, 4, '2020-05-05', 4),
(26, 1, 1, '2020-05-08', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer_profile`
--

CREATE TABLE `customer_profile` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(20) NOT NULL,
  `prescription` longblob NOT NULL,
  `address` varchar(500) NOT NULL,
  `pin` varchar(10) NOT NULL,
  `contact` varchar(10) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0-block,1-active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_profile`
--

INSERT INTO `customer_profile` (`id`, `name`, `email`, `password`, `prescription`, `address`, `pin`, `contact`, `status`) VALUES
(1, 'Deepak Singla', 'deepak@gmil.com', '1234', '', 'gemini tyres near old bus stand barnala', '111', '7410852963', '1'),
(2, 'Kunal', 'kunal@gmail.com', '101', '', 'aaa', '101', '7000000000', '1');

-- --------------------------------------------------------

--
-- Table structure for table `medicinelist`
--

CREATE TABLE `medicinelist` (
  `lid` int(11) NOT NULL,
  `name` varchar(1000) NOT NULL,
  `brand` varchar(1000) NOT NULL,
  `mg` varchar(10000) NOT NULL,
  `type` varchar(10000) NOT NULL,
  `price` varchar(10000) NOT NULL,
  `prescription_required` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0-not required,1-required',
  `max_purchase_quantity` varchar(10) NOT NULL,
  `photo` varchar(999) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `medicinelist`
--

INSERT INTO `medicinelist` (`lid`, `name`, `brand`, `mg`, `type`, `price`, `prescription_required`, `max_purchase_quantity`, `photo`) VALUES
(1, 'vicks vaporub', 'vicks', 'na', 'gel', '28', '0', '5', 'vicks.jpg'),
(2, 'crocin', 'panadol', '650', 'tablet', '10', '0', '8', 'crocin.jpg'),
(3, 'Cetirizine', 'Zyrtec', '10', 'tablet', '20', '0', '10', 'cetrizine.jpg'),
(4, 'antibiotic', 'Torrent Pharmaceuticals Ltd', '200', 'capsule', '60', '1', '9', 'antibiotic.jpg'),
(5, 'vitamin e', 'zeplabs', '100', 'capsule', '80', '1', '2', 'vitamine.jpg'),
(6, 'vitamin c', 'Abbott', '100', 'drops', '50', '1', '2', 'vitaminc.jpg'),
(7, 'insulin', 'sun pharmaceutical', '10', 'injection', '450', '1', '5', 'insulin.jpg'),
(8, 'lipsy electrolytes', 'comed chemicals ltd', '50', 'tablet', '20', '0', '10', 'lipsy.jpg'),
(9, 'moov', 'reckitt benckiser ltd', '50', 'gel', '200', '0', '5', 'moov.jpg'),
(10, 'Benadryl cough Syrup', 'Johnson & Johnson Private Limited', '100', 'syrup', '100', '0', '2', 'cough.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `mystock`
--

CREATE TABLE `mystock` (
  `id` int(11) NOT NULL,
  `name` varchar(1000) NOT NULL,
  `company` varchar(1000) NOT NULL,
  `type` varchar(100) NOT NULL,
  `mg` varchar(10000) NOT NULL,
  `price` varchar(10000) NOT NULL,
  `stock` varchar(10000) NOT NULL,
  `sid` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mystock`
--

INSERT INTO `mystock` (`id`, `name`, `company`, `type`, `mg`, `price`, `stock`, `sid`) VALUES
(18, 'vicks vaporub', 'vicks', 'gel', 'na', '27', '4', 1),
(19, 'vitamin e', 'zeplabs', 'capsule', '100', '8', '99', 1),
(21, 'insulin', 'sun pharmaceutical', 'injection', '10', '450', '94', 1),
(22, 'lipsy electrolytes', 'comed chemicals ltd', 'tablet', '50', '20', '99', 1),
(23, 'vitamin c', 'Abbott', 'drops', '100', '50', '99', 1),
(25, 'antibiotic', 'Torrent Pharmaceuticals Ltd', 'tablet', '200', '60', '50', 2),
(27, 'crocin', 'panadol', 'tablet', '650', '9', '99', 2),
(31, 'Cetirizine', 'Zyrtec', 'tablet', '10', '20', '8', 3),
(32, 'vicks vaporub', 'vicks', 'gel', 'na', '28', '6', 3),
(33, 'vitamin e', 'zeplabs', 'capsule', '100', '80', '8', 3),
(34, 'antibiotic', 'Torrent Pharmaceuticals Ltd', 'tablet', '200', '6', '8', 3),
(35, 'Benadryl cough Syrup', 'Johnson & Johnson Private Limited', 'syrup', '100', '100', '8', 3),
(36, 'Cetirizine', 'Zyrtec', 'tablet', '10', '20', '', 2);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `medicine_name` varchar(100) NOT NULL,
  `customer_id` int(255) NOT NULL,
  `seller_id` int(255) NOT NULL,
  `order_status` enum('0','1','2','3','4') NOT NULL DEFAULT '1',
  `customer_name` varchar(100) NOT NULL,
  `shipping_address` varchar(500) NOT NULL,
  `customer_contact` varchar(10) NOT NULL COMMENT '0-cancelled,1-order,2-processed,3-shipped,4-delivered',
  `quantity` varchar(10) NOT NULL,
  `order_date` date NOT NULL,
  `orderid` int(255) NOT NULL,
  `promoid` int(255) NOT NULL,
  `total` int(255) NOT NULL,
  `gtotal` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `medicine_name`, `customer_id`, `seller_id`, `order_status`, `customer_name`, `shipping_address`, `customer_contact`, `quantity`, `order_date`, `orderid`, `promoid`, `total`, `gtotal`) VALUES
(83, 'vicks vaporub', 1, 3, '0', 'Deepak Singla', 'gemini tyres near old bus stand barnala 111', '7410852963', '1', '2020-05-08', 2005081683, 3, 28, 2350),
(84, 'insulin', 1, 1, '0', 'Deepak Singla', 'gemini tyres near old bus stand barnala 111', '7410852963', '5', '2020-05-08', 2005081683, 3, 2250, 2350),
(85, 'crocin', 1, 2, '0', 'Deepak Singla', 'gemini tyres near old bus stand barnala 111', '7410852963', '8', '2020-05-08', 2005081683, 3, 72, 2350),
(86, 'vicks vaporub', 1, 3, '0', 'Deepak Singla', 'gemini tyres near old bus stand barnala 111', '7410852963', '1', '2020-05-08', 2005081267, 3, 28, 2350),
(87, 'insulin', 1, 1, '0', 'Deepak Singla', 'gemini tyres near old bus stand barnala 111', '7410852963', '5', '2020-05-08', 2005081267, 3, 2250, 2350),
(88, 'crocin', 1, 2, '0', 'Deepak Singla', 'gemini tyres near old bus stand barnala 111', '7410852963', '8', '2020-05-08', 2005081267, 3, 72, 2350),
(92, 'vicks vaporub', 1, 3, '0', 'kunal', 'lapta ganj 100', '4561237890', '1', '2020-05-08', 2005081340, 3, 28, 78),
(101, 'insulin', 1, 1, '0', 'kunal', 'lapta ganj 100', '4561237890', '1', '2020-05-08', 2005081168, 0, 450, 528),
(102, 'vicks vaporub', 1, 3, '0', 'kunal', 'lapta ganj 100', '4561237890', '1', '2020-05-08', 2005081168, 0, 28, 528),
(103, 'insulin', 1, 1, '0', 'Deepak Singla', 'gemini tyres near old bus stand barnala 111', '7410852963', '1', '2020-05-08', 200508164, 0, 450, 528),
(104, 'vicks vaporub', 1, 3, '0', 'Deepak Singla', 'gemini tyres near old bus stand barnala 111', '7410852963', '1', '2020-05-08', 200508164, 0, 28, 528);

-- --------------------------------------------------------

--
-- Table structure for table `prescription`
--

CREATE TABLE `prescription` (
  `id` int(11) NOT NULL,
  `prescription` varchar(1000) NOT NULL,
  `cid` int(255) NOT NULL,
  `upload_status` enum('0','1','2') NOT NULL DEFAULT '1' COMMENT '0-blocked,1-pending,2-approved',
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prescription`
--

INSERT INTO `prescription` (`id`, `prescription`, `cid`, `upload_status`, `date`) VALUES
(48, '27488958-dc-wallpapers.jpg', 1, '0', '2020-05-04'),
(49, '40002944-dc-wallpapers.jpg', 1, '2', '2020-05-04'),
(50, 'justice-league-movie-header.jpg', 1, '2', '2020-05-04'),
(51, '0.jpg', 1, '1', '2020-05-08'),
(52, '3.jpeg', 1, '1', '2020-05-08');

-- --------------------------------------------------------

--
-- Table structure for table `promo`
--

CREATE TABLE `promo` (
  `id` int(11) NOT NULL,
  `promocode` varchar(100) NOT NULL,
  `offer` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `promo`
--

INSERT INTO `promo` (`id`, `promocode`, `offer`) VALUES
(1, 'myntra250', 'Myntra Vouchers Worth Rs.200'),
(2, 'eat5', 'Rs.100 off on EAT.fit'),
(3, 'payt20', 'Flat 20% Paytm Cashback '),
(4, 'gr200', 'Rs.200 Grofers Gift Voucher');

-- --------------------------------------------------------

--
-- Table structure for table `seller_profile`
--

CREATE TABLE `seller_profile` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `contact` varchar(10) NOT NULL,
  `address` varchar(200) NOT NULL,
  `pin` varchar(10) NOT NULL,
  `degree` varchar(500) NOT NULL,
  `license` varchar(50) NOT NULL,
  `aadhaar` varchar(50) NOT NULL,
  `status` enum('0','1','2','3') NOT NULL DEFAULT '1' COMMENT '0-unactive,1-pending,2-active,3-blocked',
  `licenseproof` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `seller_profile`
--

INSERT INTO `seller_profile` (`id`, `name`, `email`, `password`, `contact`, `address`, `pin`, `degree`, `license`, `aadhaar`, `status`, `licenseproof`) VALUES
(2, 'ashok', 'ashok@gmail.com', '101', '9872125111', 'abc', '148101', 'phd', '1234567', '1234567', '2', ''),
(3, 'deepak', 'deepak@gmail.com', '123', '7696312581', 'abc', '148101', 'phd', '123456', '123456', '2', ''),
(4, 'kunal', 'kunal@gmail.com', '100', '7410852963', 'plk', '987', 'llb', '777', '951', '0', ''),
(5, 'naveen', 'naveen@gmail.com', '258', '3256897410', 'bnm', '332', 'web', '753', '951', '3', ''),
(6, 'abcd', 'singla12@gmail.com', '111', '1111', 'aaa', '111', 'spsp', '1212', '555', '1', '5.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `status` enum('0','1') NOT NULL,
  `cid` int(255) NOT NULL,
  `mid` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `status`, `cid`, `mid`) VALUES
(11, '1', 2, 5),
(30, '1', 1, 1),
(31, '1', 1, 7),
(36, '1', 1, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_profile`
--
ALTER TABLE `admin_profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `allowed_medicines`
--
ALTER TABLE `allowed_medicines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `applypromo`
--
ALTER TABLE `applypromo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_profile`
--
ALTER TABLE `customer_profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medicinelist`
--
ALTER TABLE `medicinelist`
  ADD PRIMARY KEY (`lid`);

--
-- Indexes for table `mystock`
--
ALTER TABLE `mystock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prescription`
--
ALTER TABLE `prescription`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promo`
--
ALTER TABLE `promo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seller_profile`
--
ALTER TABLE `seller_profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_profile`
--
ALTER TABLE `admin_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `allowed_medicines`
--
ALTER TABLE `allowed_medicines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `applypromo`
--
ALTER TABLE `applypromo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `customer_profile`
--
ALTER TABLE `customer_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `medicinelist`
--
ALTER TABLE `medicinelist`
  MODIFY `lid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `mystock`
--
ALTER TABLE `mystock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `prescription`
--
ALTER TABLE `prescription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `promo`
--
ALTER TABLE `promo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `seller_profile`
--
ALTER TABLE `seller_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
