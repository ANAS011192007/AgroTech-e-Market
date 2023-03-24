-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2022 at 05:11 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `emarket`
--
DROP DATABASE IF EXISTS emarket;
CREATE DATABASE IF NOT EXISTS emarket;
USE emarket;
-- --------------------------------------------------------

--
-- Table structure for table `all_bid`
--

CREATE TABLE `all_bid` (
  `bid_id` int(10) NOT NULL,
  `auction_id` int(10) NOT NULL,
  `b_username` varchar(25) NOT NULL,
  `b_bidQuantity` int(10) NOT NULL,
  `b_bidPrice_perUnit` int(10) NOT NULL,
  `farmer_profit` int(10) NOT NULL,
  `lastcheck` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `bid_room`
--

CREATE TABLE `bid_room` (
  `auction_id` int(10) NOT NULL,
  `totalQuantity` int(10) NOT NULL,
  `lowest_bidQuantity` int(10) NOT NULL,
  `lowestPrice_perUnit` int(10) NOT NULL,
  `bid_start` datetime NOT NULL,
  `bid_end` datetime NOT NULL,
  `p_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `buyer`
--

CREATE TABLE `buyer` (
  `b_username` varchar(25) NOT NULL,
  `password` varchar(100) NOT NULL,
  `Name` varchar(25) NOT NULL,
  `Address` varchar(50) NOT NULL,
  `Contact_no` int(10) NOT NULL,
  `District` varchar(25) NOT NULL,
  `City` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `buyer`
--

INSERT INTO `buyer` (`b_username`, `password`, `Name`, `Address`, `Contact_no`, `District`, `City`) VALUES
('buyer1', '828c88f34ecb4c1ca8d89e018c6fad1a', 'Buyer1', 'Mohammadi Housing Ltd.', 1532659875, 'Dhaka', 'Mohammadpur'),
('buyer2', '828c88f34ecb4c1ca8d89e018c6fad1a', 'Buyer2', 'Shekertek', 1956874512, 'Dhaka', 'Mohammadpur'),
('buyer3', '828c88f34ecb4c1ca8d89e018c6fad1a', 'Buyer3', 'Arambag', 1712365478, 'Dhaka', 'Mirpur');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `b_username` varchar(25) NOT NULL,
  `p_id` int(10) NOT NULL,
  `productName` varchar(25) NOT NULL,
  `totalQuantity` int(10) NOT NULL,
  `totalPrice` int(10) NOT NULL,
  `BidCheck` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `District` varchar(25) NOT NULL,
  `City` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`District`, `City`) VALUES
('Chittagong', 'Chawk Bazar'),
('Chittagong', 'Pahartali'),
('Chittagong', 'Patenga'),
('Dhaka', 'Badda'),
('Dhaka', 'Mirpur'),
('Dhaka', 'Mohammadpur'),
('Khulna', 'coming soon'),
('Rajshahi', 'Chhota Banagram'),
('Rajshahi', 'Shaheb Bazar'),
('Rajshahi', 'Shiroil'),
('Sylhet', 'coming soon');

-- --------------------------------------------------------

--
-- Table structure for table `farmer`
--

CREATE TABLE `farmer` (
  `f_username` varchar(25) NOT NULL,
  `password` varchar(100) NOT NULL,
  `Name` varchar(25) NOT NULL,
  `Address` varchar(50) NOT NULL,
  `Contact_no` int(10) NOT NULL,
  `bKash_no` int(10) DEFAULT NULL,
  `District` varchar(25) NOT NULL,
  `City` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `farmer`
--

INSERT INTO `farmer` (`f_username`, `password`, `Name`, `Address`, `Contact_no`, `bKash_no`, `District`, `City`) VALUES
('farmer1', '828c88f34ecb4c1ca8d89e018c6fad1a', 'Farmer1', 'Adabor', 1745698542, 1745698543, 'Dhaka', 'Mohammadpur'),
('farmer2', '828c88f34ecb4c1ca8d89e018c6fad1a', 'Farmer2', 'Adabor', 1754698542, 1756984526, 'Dhaka', 'Mohammadpur');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `notify_id` int(10) NOT NULL,
  `b_text` varchar(255) NOT NULL,
  `notify_datetime` datetime NOT NULL,
  `f_username` varchar(25) NOT NULL,
  `b_username` varchar(25) NOT NULL,
  `f_text` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`notify_id`, `b_text`, `notify_datetime`, `f_username`, `b_username`, `f_text`) VALUES
(20, 'Mango added to your cart. <br>Please check your cart and complete the payment.', '2022-01-02 00:27:35', 'farmer1', 'buyer1', 'Mango is sold. <br>Check your product list.'),
(21, 'Potatoes added to your cart. <br>Please check your cart and complete the payment.', '2022-01-02 00:31:23', 'farmer1', 'buyer1', 'Potatoes is sold. <br>Check your product list.'),
(22, 'Apple added to your cart. <br>Please check your cart and complete the payment.', '2022-01-02 00:37:01', 'farmer2', 'buyer1', 'Apple is sold. <br>Check your product list.'),
(23, 'Onion added to your cart. <br>Please check your cart and complete the payment.', '2022-01-02 00:37:37', 'farmer2', 'buyer1', 'Onion is sold. <br>Check your product list.'),
(24, 'Mango added to your cart. <br>Please check your cart and complete the payment.', '2022-01-02 00:47:36', 'farmer1', 'buyer1', 'Mango is sold. <br>Check your product list.'),
(25, 'Mango added to your cart. <br>Please check your cart and complete the payment.', '2022-01-19 20:33:39', 'farmer1', 'buyer1', 'Mango is sold. <br>Check your product list.'),
(26, 'Potatoes added to your cart. <br>Please check your cart and complete the payment.', '2022-01-19 20:39:17', 'farmer1', 'buyer1', 'Potatoes is sold. <br>Check your product list.'),
(27, 'Onion added to your cart. <br>Please check your cart and complete the payment.', '2022-01-19 20:39:35', 'farmer2', 'buyer1', 'Onion is sold. <br>Check your product list.'),
(28, 'Mango added to your cart. <br>Please check your cart and complete the payment.', '2022-01-19 20:52:01', 'farmer1', 'buyer1', 'Mango is sold. <br>Check your product list.'),
(29, 'Mango added to your cart. <br>Please check your cart and complete the payment.', '2022-01-19 21:05:31', 'farmer1', 'buyer1', 'Mango is sold. <br>Check your product list.'),
(30, 'Potatoes added to your cart. <br>Please check your cart and complete the payment.', '2022-01-19 22:34:27', 'farmer1', 'buyer1', 'Potatoes is sold. <br>Check your product list.'),
(31, 'Mango added to your cart. <br>Please check your cart and complete the payment.', '2022-01-19 22:44:19', 'farmer1', 'buyer1', 'Mango is sold. <br>Check your product list.'),
(32, 'Apple added to your cart. <br>Please check your cart and complete the payment.', '2022-01-19 22:45:14', 'farmer2', 'buyer1', 'Apple is sold. <br>Check your product list.'),
(33, 'Onion added to your cart. <br>Please check your cart and complete the payment.', '2022-01-19 22:50:09', 'farmer2', 'buyer1', 'Onion is sold. <br>Check your product list.'),
(34, 'Potatoes added to your cart. <br>Please check your cart and complete the payment.', '2022-01-20 10:14:45', 'farmer1', 'buyer1', 'Potatoes is sold. <br>Check your product list.'),
(35, 'Potatoes added to your cart. <br>Please check your cart and complete the payment.', '2022-01-20 10:15:53', 'farmer1', 'buyer1', 'Potatoes is sold. <br>Check your product list.'),
(36, 'Potatoes added to your cart. <br>Please check your cart and complete the payment.', '2022-01-20 10:21:30', 'farmer1', 'buyer1', 'Potatoes is sold. <br>Check your product list.'),
(37, 'Potatoes added to your cart. <br>Please check your cart and complete the payment.', '2022-01-20 10:22:27', 'farmer1', 'buyer1', 'Potatoes is sold. <br>Check your product list.'),
(38, 'Potatoes added to your cart. <br>Please check your cart and complete the payment.', '2022-01-20 10:22:38', 'farmer1', 'buyer1', 'Potatoes is sold. <br>Check your product list.'),
(39, 'Potatoes added to your cart. <br>Please check your cart and complete the payment.', '2022-01-20 10:23:20', 'farmer1', 'buyer1', 'Potatoes is sold. <br>Check your product list.'),
(40, 'Mango added to your cart. <br>Please check your cart and complete the payment.', '2022-01-20 10:26:21', 'farmer1', 'buyer1', 'Mango is sold. <br>Check your product list.'),
(41, 'Onion added to your cart. <br>Please check your cart and complete the payment.', '2022-01-20 10:26:47', 'farmer2', 'buyer1', 'Onion is sold. <br>Check your product list.'),
(42, 'Mango added to your cart. <br>Please check your cart and complete the payment.', '2022-01-20 10:27:03', 'farmer1', 'buyer1', 'Mango is sold. <br>Check your product list.'),
(43, 'Onion added to your cart. <br>Please check your cart and complete the payment.', '2022-01-20 10:29:56', 'farmer2', 'buyer1', 'Onion is sold. <br>Check your product list.'),
(44, 'Onion added to your cart. <br>Please check your cart and complete the payment.', '2022-01-20 10:30:09', 'farmer2', 'buyer1', 'Onion is sold. <br>Check your product list.'),
(45, 'Mango added to your cart. <br>Please check your cart and complete the payment.', '2022-01-20 10:59:58', 'farmer1', 'buyer1', 'Mango is sold. <br>Check your product list.'),
(46, 'Mango added to your cart. <br>Please check your cart and complete the payment.', '2022-01-20 11:10:05', 'farmer1', 'buyer1', 'Mango is sold. <br>Check your product list.'),
(47, 'Onion added to your cart. <br>Please check your cart and complete the payment.', '2022-01-20 11:11:33', 'farmer2', 'buyer1', 'Onion is sold. <br>Check your product list.'),
(48, 'Potatoes added to your cart. <br>Please check your cart and complete the payment.', '2022-01-20 11:15:21', 'farmer1', 'buyer1', 'Potatoes is sold. <br>Check your product list.'),
(49, 'Potatoes added to your cart. <br>Please check your cart and complete the payment.', '2022-01-20 11:25:31', 'farmer1', 'buyer1', 'Potatoes is sold. <br>Check your product list.'),
(50, 'Potatoes added to your cart. <br>Please check your cart and complete the payment.', '2022-01-20 11:30:44', 'farmer1', 'buyer1', 'Potatoes is sold. <br>Check your product list.'),
(51, 'Onion added to your cart. <br>Please check your cart and complete the payment.', '2022-01-20 11:31:07', 'farmer2', 'buyer1', 'Onion is sold. <br>Check your product list.'),
(52, 'Potatoes added to your cart. <br>Please check your cart and complete the payment.', '2022-01-20 11:31:13', 'farmer1', 'buyer1', 'Potatoes is sold. <br>Check your product list.'),
(53, 'Onion added to your cart. <br>Please check your cart and complete the payment.', '2022-01-20 11:31:22', 'farmer2', 'buyer1', 'Onion is sold. <br>Check your product list.'),
(54, 'Mango added to your cart. <br>Please check your cart and complete the payment.', '2022-01-20 11:32:50', 'farmer1', 'buyer1', 'Mango is sold. <br>Check your product list.'),
(55, 'Mango added to your cart. <br>Please check your cart and complete the payment.', '2022-01-20 11:32:54', 'farmer1', 'buyer1', 'Mango is sold. <br>Check your product list.'),
(56, 'Potatoes added to your cart. <br>Please check your cart and complete the payment.', '2022-01-20 11:39:54', 'farmer1', 'buyer1', 'Potatoes is sold. <br>Check your product list.'),
(57, 'Onion added to your cart. <br>Please check your cart and complete the payment.', '2022-01-20 11:57:37', 'farmer2', 'buyer1', 'Onion is sold. <br>Check your product list.'),
(58, 'Onion added to your cart. <br>Please check your cart and complete the payment.', '2022-01-20 11:58:25', 'farmer2', 'buyer1', 'Onion is sold. <br>Check your product list.'),
(59, 'Mango added to your cart. <br>Please check your cart and complete the payment.', '2022-01-20 12:03:27', 'farmer1', 'buyer1', 'Mango is sold. <br>Check your product list.'),
(60, 'Mango added to your cart. <br>Please check your cart and complete the payment.', '2022-01-20 12:03:41', 'farmer1', 'buyer1', 'Mango is sold. <br>Check your product list.');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orders_id` int(10) NOT NULL,
  `trans_id` varchar(20) NOT NULL,
  `amount` varchar(25) NOT NULL,
  `delivery_status` varchar(25) NOT NULL,
  `b_username` varchar(25) NOT NULL,
  `f_username` varchar(25) NOT NULL,
  `orders_time` datetime NOT NULL,
  `p_id` int(10) NOT NULL,
  `payMethod` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orders_id`, `trans_id`, `amount`, `delivery_status`, `b_username`, `f_username`, `orders_time`, `p_id`, `payMethod`) VALUES
(5, '1234', '10 kg.<br>1000 taka.', 'On the Way', 'buyer1', 'farmer1', '2022-01-02 00:05:09', 7, 'bkash'),
(6, '1234', '5 kg.<br>450 taka.', 'On the Way', 'buyer1', 'farmer2', '2022-01-02 00:05:09', 8, 'bkash'),
(7, '1234', '3 kg.<br>210 taka.', 'On the Way', 'buyer1', 'farmer2', '2022-01-02 00:05:09', 9, 'bkash'),
(8, '1234', '10 kg.<br>1100 taka.', 'On the Way', 'buyer1', 'farmer1', '2022-01-02 00:33:11', 7, 'bkash'),
(9, '1234', '3 kg.<br>300 taka.', 'On the Way', 'buyer1', 'farmer1', '2022-01-02 00:33:11', 10, 'bkash'),
(10, '1234', '10 kg.<br>1100 taka.', 'On the Way', 'buyer1', 'farmer1', '2022-01-02 00:48:36', 7, 'bkash'),
(11, '1234', '3 kg.<br>270 taka.', 'On the Way', 'buyer1', 'farmer2', '2022-01-02 00:48:36', 8, 'bkash'),
(12, '1234', '3 kg.<br>210 taka.', 'On the Way', 'buyer1', 'farmer2', '2022-01-02 00:48:36', 9, 'bkash');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `p_id` int(10) NOT NULL,
  `productName` varchar(25) NOT NULL,
  `productImage` varchar(255) NOT NULL,
  `Quantity` int(10) NOT NULL,
  `Price_perUnit` int(10) NOT NULL,
  `Unit` varchar(10) NOT NULL,
  `Added_date` datetime NOT NULL,
  `f_username` varchar(25) NOT NULL,
  `AvailableQuantity` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`p_id`, `productName`, `productImage`, `Quantity`, `Price_perUnit`, `Unit`, `Added_date`, `f_username`, `AvailableQuantity`) VALUES
(7, 'Mango', 'productimage/1555773058.jpg', 200, 110, 'Kg', '2021-12-31 01:41:17', 'farmer1', 200),
(8, 'Apple', 'productimage/apples-still-life-fruit-1296x728-header-1296x728.jpg', 12, 90, 'Kg', '2022-01-01 22:11:46', 'farmer2', 65),
(9, 'Onion', 'productimage/lio7npc2lha61.jpg', 143, 70, 'Kg', '2022-01-01 22:12:46', 'farmer2', 65),
(10, 'Potatoes', 'productimage/potato.jpg', 165, 100, 'Kg', '2022-01-02 00:26:46', 'farmer1', 165);

-- --------------------------------------------------------

--
-- Table structure for table `returnn`
--

CREATE TABLE `returnn` (
  `b_username` varchar(25) NOT NULL,
  `p_id` int(10) NOT NULL,
  `totalQuantity` int(10) NOT NULL,
  `totalPrice` int(10) NOT NULL,
  `comment` varchar(1000) NOT NULL,
  `contact_number` varchar(13) DEFAULT NULL,
  `action` varchar(10) DEFAULT NULL,
  `status` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `returnn`
--

INSERT INTO `returnn` (`b_username`, `p_id`, `totalQuantity`, `totalPrice`, `comment`, `contact_number`, `action`, `status`) VALUES
('buyer1', 6, 33, 450000, '        \r\n         Buyer was cheater ', '9139746', 'return', 'product is arriving late'),
('buyer1', 5, 33, 6700, '        \r\n         no.thanks', '4444', 'refund', 'Product Does Not Match Description on Website or in Catalog'),
('buyer1', 345, 78, 5963, '        \r\n         no. buyer did not give me correct product', '8888', 'return', 'None'),
('buyer1', 345, 78, 5963, '        \r\n         no. buyer did not give me correct product', '8888', 'return', 'None'),
('buyer1', 5, 33, 6700, '        \r\n         no.thanks', '4444', 'refund', 'Product Does Not Match Description on Website or in Catalog'),
('buyer1', 6, 33, 450000, '        \r\n         Buyer was cheater ', '9139746', 'return', 'product is arriving late'),
('buyer1', 5, 6700, 45790, '        \r\n         ', '4567', 'return', 'None'),
('buyer1', 5, 6700, 45790, '        \r\n         ', '4567', 'return', 'None');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `comments` varchar(1000) DEFAULT NULL,
  `productID` int(11) DEFAULT NULL,
  `u_name` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`comments`, `productID`, `u_name`) VALUES
('        \r\n         Sweeeeetttt as psychoooo.really enjoyed pooping afterwards', 7, 'buyer1'),
('        \r\n         Lovely.god, delicate, moving,mouth watering', 10, 'buyer1'),
('        \r\n         lovely', 9, 'buyer1'),
('        \r\n         not good', 9, 'buyer1'),
('        \r\n         nice', 7, 'buyer1');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `b_username` varchar(25) NOT NULL,
  `p_id` int(10) NOT NULL,
  `productName` varchar(25) NOT NULL,
  `totalQuantity` int(10) NOT NULL,
  `totalPrice` int(10) NOT NULL,
  `availableQuantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`b_username`, `p_id`, `productName`, `totalQuantity`, `totalPrice`, `availableQuantity`) VALUES
('buyer1', 10, 'Potatoes', 44, 4400, 165),
('buyer1', 9, 'Onion', 33, 2310, 143),
('buyer1', 7, 'Mango', 5, 550, 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `all_bid`
--
ALTER TABLE `all_bid`
  ADD PRIMARY KEY (`bid_id`),
  ADD KEY `FKBid_1` (`auction_id`),
  ADD KEY `FKBid_2` (`b_username`);

--
-- Indexes for table `bid_room`
--
ALTER TABLE `bid_room`
  ADD PRIMARY KEY (`auction_id`),
  ADD KEY `FKBid_room169742` (`p_id`);

--
-- Indexes for table `buyer`
--
ALTER TABLE `buyer`
  ADD PRIMARY KEY (`b_username`),
  ADD KEY `FKBuyer19772` (`District`,`City`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`b_username`,`p_id`),
  ADD KEY `FKBuyer_Prod253` (`p_id`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`District`,`City`);

--
-- Indexes for table `farmer`
--
ALTER TABLE `farmer`
  ADD PRIMARY KEY (`f_username`),
  ADD KEY `FKfarmer247222` (`District`,`City`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`notify_id`),
  ADD KEY `FKnotificati27373` (`f_username`),
  ADD KEY `FKnotificati754038` (`b_username`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orders_id`),
  ADD KEY `FKorders301829` (`b_username`),
  ADD KEY `FKorders943095` (`f_username`),
  ADD KEY `id` (`p_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`p_id`),
  ADD KEY `FKProduct80401` (`f_username`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD KEY `productID` (`productID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `all_bid`
--
ALTER TABLE `all_bid`
  MODIFY `bid_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bid_room`
--
ALTER TABLE `bid_room`
  MODIFY `auction_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `notify_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orders_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `p_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `all_bid`
--
ALTER TABLE `all_bid`
  ADD CONSTRAINT `FKBid_1` FOREIGN KEY (`auction_id`) REFERENCES `bid_room` (`auction_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FKBid_2` FOREIGN KEY (`b_username`) REFERENCES `buyer` (`b_username`) ON DELETE CASCADE;

--
-- Constraints for table `bid_room`
--
ALTER TABLE `bid_room`
  ADD CONSTRAINT `FKBid_room169742` FOREIGN KEY (`p_id`) REFERENCES `product` (`p_id`) ON DELETE CASCADE;

--
-- Constraints for table `buyer`
--
ALTER TABLE `buyer`
  ADD CONSTRAINT `FKBuyer19772` FOREIGN KEY (`District`,`City`) REFERENCES `city` (`District`, `City`) ON DELETE CASCADE;

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `FKBuyer_Prod253` FOREIGN KEY (`p_id`) REFERENCES `product` (`p_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FKBuyer_Prod310173` FOREIGN KEY (`b_username`) REFERENCES `buyer` (`b_username`) ON DELETE CASCADE,
  ADD CONSTRAINT `FKBuyer_Prod310174` FOREIGN KEY (`b_username`) REFERENCES `buyer` (`b_username`) ON DELETE CASCADE;

--
-- Constraints for table `farmer`
--
ALTER TABLE `farmer`
  ADD CONSTRAINT `FKfarmer247222` FOREIGN KEY (`District`,`City`) REFERENCES `city` (`District`, `City`) ON DELETE CASCADE;

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `FKnotificati27373` FOREIGN KEY (`f_username`) REFERENCES `farmer` (`f_username`) ON DELETE CASCADE,
  ADD CONSTRAINT `FKnotificati754038` FOREIGN KEY (`b_username`) REFERENCES `buyer` (`b_username`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `FKorders301829` FOREIGN KEY (`b_username`) REFERENCES `buyer` (`b_username`) ON DELETE CASCADE,
  ADD CONSTRAINT `FKorders943095` FOREIGN KEY (`f_username`) REFERENCES `farmer` (`f_username`) ON DELETE CASCADE,
  ADD CONSTRAINT `id` FOREIGN KEY (`p_id`) REFERENCES `product` (`p_id`) ON DELETE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `FKProduct80401` FOREIGN KEY (`f_username`) REFERENCES `farmer` (`f_username`) ON DELETE CASCADE;

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`productID`) REFERENCES `product` (`p_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
