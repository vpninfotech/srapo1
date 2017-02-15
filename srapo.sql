-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 03, 2017 at 09:57 AM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `srapo`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE IF NOT EXISTS `address` (
  `address_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `company` varchar(255) NOT NULL,
  `address_1` varchar(255) NOT NULL,
  `address_2` text NOT NULL,
  `city` varchar(255) NOT NULL,
  `postcode` varchar(255) NOT NULL,
  `state_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '1=Enabled, 0=Disabled',
  `is_deleted` tinyint(1) NOT NULL COMMENT '1 = softdeleted, 0 = not softdeleted'
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`address_id`, `customer_id`, `firstname`, `lastname`, `company`, `address_1`, `address_2`, `city`, `postcode`, `state_id`, `country_id`, `date_added`, `added_by`, `date_modified`, `modified_by`, `status`, `is_deleted`) VALUES
(38, 45, 'Indrajit', 'Kaplatiya', 'VPN', 'Surat', 'Navsari', 'Surat', '395006', 1485, 99, '2017-01-24 11:06:49', 45, '2017-01-24 11:06:49', 45, 0, 0),
(44, 43, 'F_Address', 'L_Address', 'fg', 'Address 1', 'Address 1', 'surat', '395006', 1485, 99, '2016-12-31 04:35:58', 17, '2016-12-31 04:35:58', 17, 0, 0),
(45, 43, 'F_Address', 'L_Address', 'Company', 'Address2', 'Address2', 'surat', '395006', 1484, 99, '2016-12-31 04:35:58', 17, '2016-12-31 04:35:58', 17, 0, 0),
(46, 52, 'Mahesh', 'Vora', 'VPN', 'Adajan', '', 'Surat', '395009', 1485, 99, '2017-01-09 07:23:41', 1, '2017-01-09 07:23:41', 1, 0, 0),
(48, 51, 'Vinaykumar', 'Ghael', 'VPN Infotech', 'Proton Plus', '', 'Surat', '395001', 1485, 99, '2017-01-09 10:11:16', 51, '2017-01-09 10:11:16', 51, 0, 0),
(49, 49, 'Jay', 'patel', 'abc', 'asdda', 'asdal', 'surat', '395006', 1485, 99, '2017-01-09 09:18:14', 49, '2017-01-09 09:18:14', 49, 0, 0),
(50, 0, 'Vinaykumar', 'Ghael', 'sfdgtu', 'yiuoi', 'ioui', 'i[pi[', 'ipoio[pi', 35, 2, '2017-01-09 10:08:52', 0, '2017-01-09 10:08:52', 0, 0, 0),
(51, 45, 'Indrajit', 'Kaplatiya', '', 'Dholikui', '', 'Surat', '394250', 1485, 99, '2017-01-24 10:55:44', 45, '2017-01-24 10:55:44', 45, 0, 0),
(52, 49, 'czczx', 'zxzcc', '', 'zczxczxcz', '', 'czczczc', '395006', 1485, 99, '2017-01-31 12:41:38', 49, '2017-01-31 12:41:38', 49, 0, 0),
(53, 49, 'fdgg', 'dfgdgdg', '', 'dfgdgd', '', 'baroda', '395003', 1485, 99, '2017-01-31 12:42:35', 49, '2017-01-31 12:42:35', 49, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `admin_user`
--

CREATE TABLE IF NOT EXISTS `admin_user` (
  `admin_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `middlename` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `telephone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `activation_code` varchar(255) NOT NULL,
  `last_access` datetime NOT NULL,
  `date_added` datetime NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `status` int(1) NOT NULL COMMENT '1=Enabled, 0=Disabled',
  `is_deleted` int(1) NOT NULL COMMENT '1 = softdeleted, 0 = not softdeleted'
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_user`
--

INSERT INTO `admin_user` (`admin_id`, `role_id`, `firstname`, `middlename`, `lastname`, `telephone`, `email`, `password`, `image`, `ip`, `activation_code`, `last_access`, `date_added`, `added_by`, `date_modified`, `modified_by`, `status`, `is_deleted`) VALUES
(1, 1, 'Super', 'shop', 'srapo', '123456', 'super@srapo.com', 'e10adc3949ba59abbe56e057f20f883e', 'catalog/edgar-mueller-street-art-2-1.jpg', '175.100.133.67', '', '2017-02-03 09:54:48', '2016-10-24 11:12:00', 1, '2016-12-26 12:09:07', 1, 1, 0),
(17, 2, 'Admin', 'patel', 'patel', '1234567890', 'admin@srapo.com', 'e10adc3949ba59abbe56e057f20f883e', 'catalog/1024x735.jpg', '219.91.133.36', '', '2017-01-28 01:05:01', '2016-11-26 12:13:46', 1, '2016-12-19 09:18:14', 1, 1, 0),
(18, 5, 'data', 'aaaaaaaaaaaaaaaaaaa', 'sabhadiya', '123456', 'data@srapo.com', 'e10adc3949ba59abbe56e057f20f883e', 'catalog/indra/1024x735.jpg', '219.91.133.36', '', '2017-02-03 02:11:31', '2016-12-07 11:12:11', 1, '2016-12-19 03:34:23', 1, 1, 0),
(24, 7, 'support', 'Middle', 'srapo', '123456', 'support@srapo.com', 'e10adc3949ba59abbe56e057f20f883e', 'catalog/2mb.jpg', '219.91.133.36', '', '2016-12-31 09:48:56', '2016-12-16 11:42:44', 1, '2016-12-19 11:30:21', 24, 1, 0),
(29, 5, 'test', 'test', 'test', '123456', 'test@test.com', 'e10adc3949ba59abbe56e057f20f883e', '', '219.91.133.36', '', '0000-00-00 00:00:00', '2016-12-19 09:58:42', 1, '2016-12-19 09:58:42', 1, 1, 0),
(30, 3, 'Indrajit', 'Virendrasinh', 'Kaplatiya', '1234567890', 'finance@srapo.com', 'e10adc3949ba59abbe56e057f20f883e', '', '123.201.3.65', '', '2017-01-23 03:46:51', '2016-12-22 09:25:27', 17, '2016-12-24 05:18:54', 1, 1, 0),
(31, 3, 'finance', 'finance', 'srapo', '123456', 'ss@vpninfotech.com', 'e10adc3949ba59abbe56e057f20f883e', 'catalog/finance.jpg', '219.91.138.55', '986131', '2016-12-31 04:28:09', '2016-12-29 04:25:16', 1, '2016-12-29 04:30:30', 1, 1, 0),
(32, 4, 'Srapo', 'Logistic', 'Logistic', '1234567890', 'logistic@srapo.com', 'e10adc3949ba59abbe56e057f20f883e', 'catalog/Logistic.jpg', '175.100.146.140', '', '2017-01-10 09:38:59', '2016-12-31 09:31:30', 17, '2016-12-31 09:31:30', 17, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `attribute`
--

CREATE TABLE IF NOT EXISTS `attribute` (
  `attribute_id` int(11) NOT NULL,
  `attribute_group_id` int(11) NOT NULL,
  `attribute_name` varchar(255) NOT NULL,
  `sort_order` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  `is_deleted` int(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attribute`
--

INSERT INTO `attribute` (`attribute_id`, `attribute_group_id`, `attribute_name`, `sort_order`, `date_added`, `added_by`, `date_modified`, `modified_by`, `status`, `is_deleted`) VALUES
(8, 16, 'xyzw', 3, '2016-11-15 08:43:21', 1, '2016-12-15 10:12:05', 1, 0, 1),
(10, 13, 'camera', 21, '2016-11-15 08:50:35', 1, '2016-12-13 03:06:56', 16, 0, 0),
(12, 14, 'Product', 2, '2016-12-12 11:13:36', 1, '2016-12-12 11:13:36', 1, 0, 0),
(13, 12, 'Item', 3, '2016-12-12 11:13:47', 1, '2016-12-12 11:13:47', 1, 0, 0),
(14, 22, 'new', 0, '2016-12-13 11:28:07', 16, '2016-12-16 05:05:25', 1, 0, 0),
(15, 22, 'cloth', 5, '2016-12-13 03:06:12', 16, '2016-12-13 03:06:12', 16, 0, 0),
(16, 18, 'trouser', 6, '2016-12-13 03:06:30', 16, '2016-12-13 03:06:30', 16, 0, 0),
(17, 16, 'arribute1', 1, '2016-12-16 09:14:21', 23, '2016-12-16 09:14:21', 23, 0, 0),
(18, 16, 'attribute2', 1, '2016-12-30 10:51:04', 17, '2016-12-30 10:51:12', 17, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `attribute_group`
--

CREATE TABLE IF NOT EXISTS `attribute_group` (
  `attribute_group_id` int(11) NOT NULL,
  `attribute_group_name` varchar(255) NOT NULL,
  `sort_order` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `status` int(1) NOT NULL COMMENT '1=Enabled, 0=Disabled',
  `is_deleted` int(1) NOT NULL COMMENT '1 = softdeleted, 0 = not softdeleted'
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attribute_group`
--

INSERT INTO `attribute_group` (`attribute_group_id`, `attribute_group_name`, `sort_order`, `date_added`, `added_by`, `date_modified`, `modified_by`, `status`, `is_deleted`) VALUES
(12, 'Processor444444', 3, '2016-11-11 11:53:36', 1, '2016-11-21 11:59:15', 1, 1, 1),
(13, 'Technical', 4, '2016-11-11 11:56:26', 1, '2016-12-12 10:20:57', 1, 1, 0),
(14, 'Memory', 1, '2016-11-11 12:14:29', 1, '2016-12-01 10:26:50', 1, 1, 0),
(16, 'Motherboard', 2, '2016-11-12 04:59:04', 1, '2016-11-21 07:33:03', 1, 0, 0),
(18, 'Ritz', 3, '2016-11-21 11:57:52', 1, '2016-11-21 11:58:36', 1, 1, 1),
(20, 'ssssss', 0, '2016-11-26 07:38:01', 16, '2016-11-26 07:38:01', 16, 0, 1),
(22, 'test group', 0, '2016-12-13 11:27:53', 16, '2016-12-13 11:27:53', 16, 0, 0),
(23, 'new attribute group', 1, '2016-12-16 10:07:57', 23, '2016-12-16 10:07:57', 23, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `bank_list`
--

CREATE TABLE IF NOT EXISTS `bank_list` (
  `bank_id` int(11) NOT NULL,
  `bank_name` text NOT NULL,
  `date_added` datetime NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `status` int(1) NOT NULL COMMENT '1=Enabled, 0=Disabled',
  `is_deleted` int(1) NOT NULL COMMENT '1 = softdeleted, 0 = not softdeleted'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bank_list`
--

INSERT INTO `bank_list` (`bank_id`, `bank_name`, `date_added`, `added_by`, `date_modified`, `modified_by`, `status`, `is_deleted`) VALUES
(1, 'HDFC', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(2, 'State Bank of India', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(3, 'Bank of Baroda', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(4, 'ICICI Bank', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

CREATE TABLE IF NOT EXISTS `banner` (
  `banner_id` int(11) NOT NULL,
  `banner_name` varchar(255) NOT NULL,
  `select_page` varchar(255) NOT NULL,
  `layout` varchar(255) NOT NULL,
  `select_category` int(11) NOT NULL,
  `position` varchar(255) NOT NULL,
  `location_name` varchar(255) NOT NULL,
  `status` int(1) NOT NULL COMMENT '1=Enabled, 0=Disabled',
  `date_added` datetime NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `is_deleted` int(1) NOT NULL COMMENT '1 = softdeleted, 0 = not softdeleted'
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`banner_id`, `banner_name`, `select_page`, `layout`, `select_category`, `position`, `location_name`, `status`, `date_added`, `added_by`, `date_modified`, `modified_by`, `is_deleted`) VALUES
(32, 'Slider', 'home', 'main banner', 0, '', '', 0, '2017-01-07 12:51:35', 17, '2017-01-25 08:39:24', 17, 0),
(34, 'Product Term & Conditions', 'product', 'right column', 0, '', '', 1, '2017-01-12 11:50:35', 17, '2017-01-12 11:50:35', 17, 0),
(35, 'electronics', 'home', 'category', 116, 'left', '', 1, '2017-01-17 07:53:46', 1, '2017-01-17 07:53:46', 1, 0),
(36, 'electronics top left', 'home', 'category', 116, 'top left', '', 1, '2017-01-17 07:55:16', 1, '2017-01-17 07:55:16', 1, 0),
(37, 'electronics top right', 'home', 'category', 116, 'top right', '', 1, '2017-01-17 07:55:53', 1, '2017-01-17 07:55:53', 1, 0),
(38, 'appliance top left', 'home', 'category', 57, 'top left', '', 1, '2017-01-17 07:56:55', 1, '2017-01-17 07:56:55', 1, 0),
(39, 'appliance top right', 'home', 'category', 57, 'top right', '', 1, '2017-01-17 07:57:31', 1, '2017-01-17 07:57:31', 1, 0),
(40, 'appliance left', 'home', 'category', 57, 'left', '', 1, '2017-01-17 07:58:20', 1, '2017-01-17 07:58:20', 1, 0),
(41, 'men top left', 'home', 'category', 58, 'top left', '', 1, '2017-01-17 07:59:49', 1, '2017-01-17 07:59:49', 1, 0),
(42, 'men top right', 'home', 'category', 58, 'top right', '', 1, '2017-01-17 08:00:25', 1, '2017-01-17 08:00:25', 1, 0),
(43, 'men left', 'home', 'category', 58, 'left', '', 1, '2017-01-17 08:01:04', 1, '2017-01-17 08:01:04', 1, 0),
(44, 'women top left', 'home', 'category', 59, 'top left', '', 1, '2017-01-17 08:02:05', 1, '2017-01-17 08:02:05', 1, 0),
(45, 'women top right', 'home', 'category', 59, 'top right', '', 1, '2017-01-17 08:02:43', 1, '2017-01-17 08:02:43', 1, 0),
(46, 'women left', 'home', 'category', 59, 'left', '', 1, '2017-01-17 08:03:19', 1, '2017-01-17 08:03:19', 1, 0),
(47, 'home bottom left', 'home', 'bottom left', 0, '', '', 1, '2017-01-17 08:04:17', 1, '2017-01-17 08:06:11', 1, 0),
(48, 'home bottom right', 'home', 'bottom right', 0, '', '', 1, '2017-01-17 08:07:11', 1, '2017-01-17 08:07:11', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `banner_image`
--

CREATE TABLE IF NOT EXISTS `banner_image` (
  `banner_image_id` int(11) NOT NULL,
  `banner_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `sort_order` int(11) NOT NULL,
  `status` int(1) NOT NULL COMMENT '1=Enabled, 0=Disabled',
  `date_added` datetime NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `is_deleted` int(1) NOT NULL COMMENT '1 = softdeleted, 0 = not softdeleted'
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `banner_image`
--

INSERT INTO `banner_image` (`banner_image_id`, `banner_id`, `title`, `link`, `image`, `sort_order`, `status`, `date_added`, `added_by`, `date_modified`, `modified_by`, `is_deleted`) VALUES
(68, 34, 'Banner1', 'http://google.com', 'catalog/Christmas Time.jpg', 1, 0, '2017-01-12 11:50:35', 17, '2017-01-12 11:50:35', 17, 0),
(69, 35, 'electronics', '', 'catalog/banners/f3.jpg', 0, 0, '2017-01-17 07:53:46', 1, '2017-01-17 07:53:46', 1, 0),
(70, 36, 'electronics top left', '', 'catalog/banners/ads8.jpg', 0, 0, '2017-01-17 07:55:16', 1, '2017-01-17 07:55:16', 1, 0),
(71, 37, 'electronics top right', '', 'catalog/banners/ads10.jpg', 0, 0, '2017-01-17 07:55:53', 1, '2017-01-17 07:55:53', 1, 0),
(72, 38, 'appliance top left', '', 'catalog/banners/ads3.jpg', 0, 0, '2017-01-17 07:56:55', 1, '2017-01-17 07:56:55', 1, 0),
(73, 39, 'appliance top right', '', 'catalog/banners/ads6.jpg', 0, 0, '2017-01-17 07:57:31', 1, '2017-01-17 07:57:31', 1, 0),
(74, 40, 'appliance left', '', 'catalog/banners/f4.jpg', 0, 0, '2017-01-17 07:58:20', 1, '2017-01-17 07:58:20', 1, 0),
(75, 41, 'men top left', '', 'catalog/banners/ads14.jpg', 0, 0, '2017-01-17 07:59:49', 1, '2017-01-17 07:59:49', 1, 0),
(76, 42, 'men top right', '', 'catalog/banners/ads15.jpg', 0, 0, '2017-01-17 08:00:25', 1, '2017-01-17 08:00:25', 1, 0),
(77, 43, 'men left', '', 'catalog/banners/f1.jpg', 0, 0, '2017-01-17 08:01:04', 1, '2017-01-17 08:01:04', 1, 0),
(78, 44, 'women top left', '', 'catalog/banners/ads13.jpg', 0, 0, '2017-01-17 08:02:05', 1, '2017-01-17 08:02:05', 1, 0),
(79, 45, 'women top right', '', 'catalog/banners/ads3.jpg', 0, 0, '2017-01-17 08:02:43', 1, '2017-01-17 08:02:43', 1, 0),
(80, 46, 'women left', '', 'catalog/banners/f6.jpg', 0, 0, '2017-01-17 08:03:20', 1, '2017-01-17 08:03:20', 1, 0),
(82, 47, 'home bottom left', '', 'catalog/banners/ads17.jpg', 0, 0, '2017-01-17 08:06:11', 1, '2017-01-17 08:06:11', 1, 0),
(83, 48, 'home bottom right', '', 'catalog/banners/ads18.jpg', 0, 0, '2017-01-17 08:07:11', 1, '2017-01-17 08:07:11', 1, 0),
(84, 32, 'Slide 1', '', 'catalog/slider/slide-3.jpg', 1, 0, '2017-01-25 08:39:24', 17, '2017-01-25 08:39:24', 17, 0),
(85, 32, 'Slide 2', '', 'catalog/slider/slide-1.jpg', 2, 0, '2017-01-25 08:39:24', 17, '2017-01-25 08:39:24', 17, 0),
(86, 32, 'Slide 3', '', 'catalog/slider/slide-2.jpg', 3, 0, '2017-01-25 08:39:24', 17, '2017-01-25 08:39:24', 17, 0);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE IF NOT EXISTS `cart` (
  `cart_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `session_id` varchar(255) NOT NULL,
  `product_id` int(11) NOT NULL,
  `option` text NOT NULL,
  `quantity` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  `catalog_no` text NOT NULL,
  `is_single` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=238 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `customer_id`, `session_id`, `product_id`, `option`, `quantity`, `date_added`, `catalog_no`, `is_single`) VALUES
(235, 49, '2c53d710b6d961c0327ff697af08578963c6f427', 34, '[]', 4, '2017-01-31 17:08:15', '{"catalog_no":"100000","price":1120,"special":1041.6}', 1),
(236, 49, '2c53d710b6d961c0327ff697af08578963c6f427', 46, '[]', 2, '2017-01-31 17:08:56', '[]', 0);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `top` tinyint(1) NOT NULL,
  `description` text NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `meta_keyword` varchar(255) NOT NULL,
  `seo_keywords` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `columns` int(11) NOT NULL,
  `sort_order` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  `is_deleted` int(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=129 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `parent_id`, `top`, `description`, `meta_title`, `meta_description`, `meta_keyword`, `seo_keywords`, `image`, `columns`, `sort_order`, `date_added`, `added_by`, `date_modified`, `modified_by`, `status`, `is_deleted`) VALUES
(55, 'Mobile', 116, 1, '<p>Mobile<br></p>', 'Mobile', 'Mobile', 'Mobile', 'Mobile', '', 1, 1, '2017-01-07 06:40:57', 17, '2017-01-17 07:45:13', 1, 1, 0),
(57, 'Appliances', 0, 1, '<p>Appliances<br></p>', 'Appliances', 'Appliances', 'Appliances', 'Appliances', 'catalog/banners/cate-product6.png', 0, 2, '2017-01-07 06:43:42', 17, '2017-01-17 08:10:31', 1, 1, 0),
(58, 'Men', 0, 1, '<p>Men<br></p>', 'Men', 'Men', 'Men', 'Men', 'catalog/banners/cate-product4.png', 0, 3, '2017-01-07 06:44:07', 17, '2017-01-17 08:11:12', 1, 1, 0),
(59, 'Women', 0, 1, '<p>Women<br></p>', 'Women', 'Women', 'Women', 'Women', 'catalog/banners/cate-product3.png', 0, 4, '2017-01-07 06:44:26', 17, '2017-01-17 08:11:38', 1, 1, 0),
(60, 'Baby & Kids', 0, 1, '<p>Baby &amp; Kids<br></p>', 'Baby & Kids', 'Baby & Kids', 'Baby & Kids', 'Baby-Kids', 'catalog/banners/cate-product5.png', 0, 5, '2017-01-07 06:45:57', 17, '2017-01-17 08:12:30', 1, 1, 0),
(61, 'Home & Furniture', 0, 1, '<p>Home &amp; Furniture<br></p>', 'Home-Furniture', 'Home-Furniture', 'Home-Furniture', 'Home-Furniture', 'catalog/banners/cat-br1.png', 0, 6, '2017-01-07 06:48:47', 17, '2017-01-17 08:13:20', 1, 1, 0),
(62, 'Books & More', 0, 1, '<p>Books &amp; More<br></p>', 'Books-More', 'Books-More', 'Books-More', 'Books-More', 'catalog/cate-product8.png', 0, 7, '2017-01-07 06:49:19', 17, '2017-01-17 08:12:48', 1, 1, 0),
(63, 'Mobile Accessories', 56, 0, 'Mobile Accessories', 'Mobile Accessories', 'Mobile Accessories', 'Mobile Accessories', 'Mobile-Accessories', '', 2, 1, '2017-01-07 06:53:02', 17, '2017-01-07 06:53:24', 17, 1, 0),
(64, 'Samsung', 55, 0, '<p>Samsung<br></p>', 'Samsung', 'Samsung', 'Samsung', 'Samsung', '', 0, 0, '2017-01-07 06:54:26', 17, '2017-01-11 12:59:47', 17, 1, 0),
(65, 'Lenovo', 55, 0, '<p>Lenovo<br></p>', 'Lenovo', 'Lenovo', 'Lenovo', 'Lenovo', '', 0, 0, '2017-01-07 06:55:07', 17, '2017-01-07 06:55:07', 17, 1, 0),
(66, 'Mi', 55, 0, '<p>Mi<br></p>', 'Mi-mobile', 'Mi', 'Mi', 'Mi', '', 0, 0, '2017-01-07 06:55:49', 17, '2017-01-07 06:55:49', 17, 1, 0),
(67, 'Motorola', 55, 0, '<p>Motorola<br></p>', 'Motorola', 'Motorola', 'Motorola', 'Motorola', '', 0, 0, '2017-01-07 06:56:13', 17, '2017-01-07 06:56:13', 17, 1, 0),
(68, 'LeEco', 55, 0, '<p>LeEco<br></p>', 'LeEco', 'LeEco', 'LeEco', 'LeEco', '', 0, 0, '2017-01-07 06:56:41', 17, '2017-01-07 06:56:41', 17, 1, 0),
(69, 'Apple', 55, 0, '<p>Apple<br></p>', 'Apple', 'Apple', 'Apple', 'Apple', '', 0, 0, '2017-01-07 06:57:05', 17, '2017-01-07 06:57:05', 17, 1, 0),
(70, 'Asus', 55, 0, '<p>Asus<br></p>', 'Asus', 'Asus', 'Asus', 'Asus', '', 0, 0, '2017-01-07 06:57:29', 17, '2017-01-07 06:57:29', 17, 1, 0),
(71, 'Micromax', 55, 0, '<p>Micromax<br></p>', 'Micromax', 'Micromax', 'Micromax', 'Micromax', '', 0, 0, '2017-01-07 06:57:53', 17, '2017-01-07 06:57:53', 17, 1, 0),
(72, 'Mobile Cases', 63, 0, '<p>Mobile Cases<br></p>', 'Mobile Cases', 'Mobile Cases', 'Mobile Cases', 'Mobile-Cases', '', 0, 0, '2017-01-07 06:59:13', 17, '2017-01-07 06:59:13', 17, 1, 0),
(73, 'Headphones & Headsets', 63, 0, 'Headphones &amp; Headsets', 'Headphones-Headsets', 'Headphones-Headsets', 'Headphones-Headsets', 'Headphones-Headsets', '', 0, 0, '2017-01-07 06:59:52', 17, '2017-01-07 06:59:52', 17, 1, 0),
(74, 'Power Banks', 63, 0, '<p>Power Banks<br></p>', 'Power Banks', 'Power Banks', 'Power Banks', 'Power-Banks', '', 0, 0, '2017-01-07 07:00:21', 17, '2017-01-07 07:00:21', 17, 1, 0),
(75, 'Screenguards', 63, 0, '<p>Screenguards<br></p>', 'Screenguards', 'Screenguards', 'Screenguards', 'Screenguards', '', 0, 0, '2017-01-07 07:00:44', 17, '2017-01-07 07:00:44', 17, 1, 0),
(76, 'Memory Cards', 63, 0, '<p>Memory Cards<br></p>', 'Memory-Cards', 'Memory-Cards', 'Memory-Cards', 'Memory-Cards', '', 0, 0, '2017-01-07 07:01:11', 17, '2017-01-07 07:01:11', 17, 1, 0),
(77, 'On-the-go pendrives', 63, 0, '<p>On-the-go pendrives<br></p>', 'On-the-go-pendrives', 'On-the-go-pendrives', 'On-the-go-pendrives', 'On-the-go-pendrives', '', 0, 0, '2017-01-07 07:01:45', 17, '2017-01-07 07:01:45', 17, 1, 0),
(78, 'Cables', 63, 0, '<p>Cables<br></p>', 'Cables', 'Cables', 'Cables', 'Cables', '', 0, 0, '2017-01-07 07:02:09', 17, '2017-01-07 07:02:09', 17, 1, 0),
(79, 'Chargers', 63, 0, '<p>Chargers<br></p>', 'Chargers', 'Chargers', 'Chargers', 'Chargers', '', 0, 0, '2017-01-07 07:02:30', 17, '2017-01-07 07:02:30', 17, 1, 0),
(80, 'Selfie Sticks', 63, 0, '<p>Selfie Sticks<br></p>', 'Selfie-Sticks', 'Selfie-Sticks', 'Selfie-Sticks', 'Selfie-Sticks', '', 0, 0, '2017-01-07 07:02:56', 17, '2017-01-07 07:02:56', 17, 1, 0),
(81, 'Wearables', 56, 0, '<p>Wearables<br></p>', 'Wearables', 'Wearables', 'Wearables', 'Wearables', '', 0, 3, '2017-01-07 07:03:17', 17, '2017-01-07 07:07:12', 17, 1, 0),
(82, 'Smart Watches', 81, 0, '<p>Smart Watches<br></p>', 'Smart-Watches', 'Smart-Watches', 'Smart-Watches', 'Smart-Watches', '', 0, 0, '2017-01-07 07:03:42', 17, '2017-01-07 07:06:03', 17, 1, 0),
(83, 'Smart Glasses', 81, 0, '<p>Smart Glasses<br></p>', 'Smart-Glasses', 'Smart-Glasses', 'Smart-Glasses', 'Smart-Glasses', '', 0, 0, '2017-01-07 07:04:12', 17, '2017-01-07 07:06:18', 17, 1, 0),
(84, 'Smart Bands', 81, 0, '<p>Smart Bands<br></p>', 'Smart-Bands', 'Smart-Bands', 'Smart-Bands', 'Smart-Bands', '', 0, 0, '2017-01-07 07:04:41', 17, '2017-01-07 07:06:30', 17, 1, 0),
(85, 'New and Popular Models', 56, 0, '<p>New and Popular Models<br></p>', 'New-and-Popular-Models', 'New-and-Popular-Models', 'New-and-Popular-Models', 'New-and-Popular-Models', '', 0, 4, '2017-01-07 07:08:37', 17, '2017-01-07 07:08:37', 17, 1, 0),
(86, 'Lenovo K6 Power', 85, 0, '<p>Lenovo K6 Power<br></p>', 'Lenovo-K6-Power', 'Lenovo-K6-Power', 'Lenovo-K6-Power', 'lenovo-power', '', 0, 0, '2017-01-07 07:10:10', 17, '2017-01-07 07:10:10', 17, 1, 0),
(87, 'Moto M', 85, 0, '<p>Moto M<br></p>', 'Moto-M', 'Moto-M', 'Moto-M', 'Moto-M', '', 0, 0, '2017-01-07 07:10:36', 17, '2017-01-07 07:10:36', 17, 1, 0),
(88, 'Panasonic P77', 85, 0, '<p>Panasonic P77<br></p>', 'Panasonic-P77', 'Panasonic-P77', 'Panasonic-P77', 'Panasonic-P', '', 0, 0, '2017-01-07 07:11:11', 17, '2017-01-07 07:11:11', 17, 1, 0),
(89, 'Computer Accessories', 56, 0, '<p>Computer Accessories<br></p>', 'Computer-Accessories', 'Computer-Accessories', 'Computer-Accessories', 'Computer-Accessories', '', 0, 5, '2017-01-07 07:12:40', 17, '2017-01-07 07:12:40', 17, 1, 0),
(90, 'External Hard Disks', 89, 0, '<p>External Hard Disks<br></p>', 'External Hard Disks', 'External Hard Disks', 'External Hard Disks', 'External-Hard-Disks', '', 0, 0, '2017-01-07 07:13:23', 17, '2017-01-07 07:13:23', 17, 1, 0),
(91, 'Pendrives', 89, 0, '<p>Pendrives<br></p>', 'Pendrives', 'Pendrives', 'Pendrives', 'Pendrives', '', 0, 0, '2017-01-07 07:13:54', 17, '2017-01-07 07:13:54', 17, 1, 0),
(92, 'Laptop Bags', 89, 0, '<p>Laptop Bags<br></p>', 'Laptop-Bags', 'Laptop-Bags', 'Laptop-Bags', 'Laptop-Bags', '', 0, 0, '2017-01-07 07:14:20', 17, '2017-01-07 07:14:20', 17, 1, 0),
(93, 'Mouse', 89, 0, '<p>Mouse<br></p>', 'Mouse', 'Mouse', 'Mouse', 'Mouse', '', 0, 0, '2017-01-07 07:14:42', 17, '2017-01-07 07:14:42', 17, 1, 0),
(94, 'Keyboards', 89, 0, '<p>Keyboards<br></p>', 'Keyboards', 'Keyboards', 'Keyboards', 'Keyboards', '', 0, 0, '2017-01-07 07:15:03', 17, '2017-01-07 07:15:03', 17, 1, 0),
(95, 'Computer Peripherals', 56, 0, '<p>Computer Peripherals<br></p>', 'Computer Peripherals', 'Computer Peripherals', 'Computer Peripherals', 'Computer-Peripherals', '', 0, 6, '2017-01-07 07:15:44', 17, '2017-01-07 07:15:44', 17, 1, 0),
(96, 'Printers & Ink Cartridges', 95, 0, '<p>Printers &amp; Ink Cartridges<br></p>', 'Printers & Ink Cartridges', 'Printers & Ink Cartridges', 'Printers & Ink Cartridges', 'Printers-Ink-Cartridges', '', 0, 0, '2017-01-07 07:16:13', 17, '2017-01-07 07:16:13', 17, 1, 0),
(97, 'Monitors', 95, 0, '<p>Monitors<br></p>', 'Monitors', 'Monitors', 'Monitors', 'Monitors', '', 0, 0, '2017-01-07 07:16:39', 17, '2017-01-07 07:16:39', 17, 1, 0),
(98, 'Network Components', 56, 0, '<p>Network Components<br></p>', 'Network Components', 'Network Components', 'Network Components', 'Network-Components', '', 0, 7, '2017-01-07 07:17:13', 17, '2017-01-07 07:17:13', 17, 1, 0),
(99, 'Routers', 98, 0, '<p>Routers<br></p>', 'Routers', 'Routers', 'Routers', 'Routers', '', 0, 0, '2017-01-07 07:17:37', 17, '2017-01-07 07:17:37', 17, 1, 0),
(100, 'Data Cards', 98, 0, '<p>Data Cards<br></p>', 'Data Cards', 'Data Cards', 'Data Cards', 'Data-Cards', '', 0, 0, '2017-01-07 07:18:05', 17, '2017-01-07 07:18:05', 17, 1, 0),
(101, 'Home Entertainment', 56, 0, '<p>Home Entertainment<br></p>', 'Home Entertainment', 'Home Entertainment', 'Home Entertainment', 'Home-Entertainment', '', 0, 8, '2017-01-07 07:19:10', 17, '2017-01-07 07:19:10', 17, 1, 0),
(102, 'iPods & MP3 Players', 101, 0, '<p>iPods &amp; MP3 Players<br></p>', 'iPods & MP3 Players', 'iPods & MP3 Players', 'iPods & MP3 Players', 'iPods-MP-Players', '', 0, 0, '2017-01-07 07:19:46', 17, '2017-01-07 07:19:46', 17, 1, 0),
(103, 'Home Theatres', 101, 0, '<p>Home Theatres<br></p>', 'Home Theatres', 'Home Theatres', 'Home Theatres', 'Home-Theatres', '', 0, 0, '2017-01-07 07:20:11', 17, '2017-01-07 07:20:11', 17, 1, 0),
(104, 'Speakers', 101, 0, '<p>Speakers<br></p>', 'Speakers', 'Speakers', 'Speakers', 'Speakers', '', 0, 0, '2017-01-07 07:20:33', 17, '2017-01-07 07:20:33', 17, 1, 0),
(105, 'Camera', 56, 0, '<p>Camera<br></p>', 'Camera', 'Camera', 'Camera', 'Camera', '', 0, 9, '2017-01-07 07:20:59', 17, '2017-01-07 07:20:59', 17, 1, 0),
(106, 'DSLR', 105, 0, '<p>DSLR<br></p>', 'DSLR', 'DSLR', 'DSLR', 'DSLR', '', 0, 0, '2017-01-07 07:21:22', 17, '2017-01-07 07:21:22', 17, 1, 0),
(107, 'Point & Shoot', 105, 0, '<p>Point &amp; Shoot<br></p>', 'Point & Shoot', 'Point & Shoot', 'Point & Shoot', 'Point-Shoot', '', 0, 0, '2017-01-07 07:21:58', 17, '2017-01-07 07:21:58', 17, 1, 0),
(108, 'Sports and Lifestyle Cameras', 105, 0, '<p>Sports and Lifestyle Cameras<br></p>', 'Sports and Lifestyle Cameras', 'Sports and Lifestyle Cameras', 'Sports and Lifestyle Cameras', 'Sports-and-Lifestyle-Cameras', '', 0, 0, '2017-01-07 07:22:22', 17, '2017-01-07 07:22:22', 17, 1, 0),
(109, 'Camera Accessories', 56, 0, '<p>Camera Accessories<br></p>', 'Camera Accessories', 'Camera Accessories', 'Camera Accessories', 'Camera-Accessories', '', 0, 10, '2017-01-07 07:23:12', 17, '2017-01-07 07:23:12', 17, 1, 0),
(110, 'Cards', 109, 0, '<p>Memory Cards<br></p>', 'Memory Cards', 'Memory Cards', 'Memory Cards', 'Memory-Cardss', '', 0, 0, '2017-01-07 07:23:59', 17, '2017-01-07 07:23:59', 17, 1, 0),
(111, 'Tablets', 56, 0, '<p>Tablets<br></p>', 'Tablets', 'Tablets', 'Tablets', 'Tablets', '', 0, 11, '2017-01-07 07:24:37', 17, '2017-01-07 07:24:37', 17, 1, 0),
(112, 'TV', 56, 0, '<p>TV<br></p>', 'TVS', 'TV', 'TV', 'TV', '', 0, 12, '2017-01-07 09:31:41', 1, '2017-01-07 09:32:25', 1, 1, 0),
(113, 'LAPTOPS', 56, 0, '<p>LAPTOPS<br></p>', 'LAPTOPS', 'LAPTOPS', 'LAPTOPS', 'LAPTOPS', '', 0, 13, '2017-01-07 09:32:47', 1, '2017-01-07 09:32:47', 1, 1, 0),
(114, 'FK Exclusive Mobiles', 56, 0, '<p><span style="color: rgb(34, 34, 34); font-family: Consolas, &quot;Lucida Console&quot;, &quot;Courier New&quot;, monospace; white-space: pre-wrap;">FK Exclusive Mobiles</span><br></p>', 'FK Exclusive Mobiles', 'FK Exclusive Mobiles', 'FK Exclusive Mobiles', 'FK-Exclusive-Mobiles', '', 0, 14, '2017-01-07 09:34:05', 1, '2017-01-07 09:34:05', 1, 1, 0),
(115, 'Tvs', 57, 0, '<p>Tvs<br></p>', 'Tvs', 'Tvs', 'Tvs', 'aapliances-Tvs', '', 0, 0, '2017-01-10 11:14:35', 17, '2017-01-10 11:14:35', 17, 1, 0),
(116, 'Electronics', 0, 1, '<p>Electronics<br></p>', 'Electronics', 'Electronics', 'Electronics', 'Electronics', 'catalog/banners/cate-product1.png', 0, 1, '2017-01-17 07:43:12', 1, '2017-01-17 08:08:56', 1, 1, 0),
(117, 'n1Test123', 0, 0, '', '', '', '', '', '', 0, 0, '2017-01-24 12:28:59', 0, '2017-01-24 12:28:59', 0, 1, 0),
(118, 'n1Test4', 117, 0, '', '', '', '', '', '', 0, 0, '2017-01-24 12:28:59', 0, '2017-01-24 12:28:59', 0, 1, 0),
(119, 'n1Test5', 118, 0, '', '', '', '', '', '', 0, 0, '2017-01-24 12:28:59', 0, '2017-01-24 12:28:59', 0, 1, 0),
(120, 'm1123', 0, 0, '', '', '', '', '', '', 0, 0, '2017-01-24 12:28:59', 0, '2017-01-24 12:28:59', 0, 1, 0),
(121, 'm14', 120, 0, '', '', '', '', '', '', 0, 0, '2017-01-24 12:28:59', 0, '2017-01-24 12:28:59', 0, 1, 0),
(122, 'Sarees', 0, 0, '', '', '', '', '', '', 0, 0, '2017-01-24 12:29:13', 0, '2017-01-24 12:29:13', 0, 1, 0),
(123, 'Salwar Kameez', 0, 0, '', '', '', '', '', '', 0, 0, '2017-01-24 12:29:21', 0, '2017-01-24 12:29:21', 0, 1, 0),
(124, 'Lehenga Choli', 0, 0, '', '', '', '', '', '', 0, 0, '2017-01-24 12:29:30', 0, '2017-01-24 12:29:30', 0, 1, 0),
(126, 'Look Book', 0, 1, '<p>Look Book<br></p>', 'Look Book', '', '', 'Catalogs', '', 0, 8, '2017-01-31 05:52:03', 1, '2017-01-31 05:52:03', 1, 1, 0),
(127, 'Dress', 126, 0, '<p><br></p>', 'Dress', '', '', 'dress', '', 1, 1, '2017-01-31 06:04:35', 1, '2017-01-31 06:04:35', 1, 1, 0),
(128, 'Bollyhood', 127, 0, '<p><br></p>', 'Bollyhood', '', '', 'bollyhood', '', 2, 2, '2017-01-31 06:05:21', 1, '2017-01-31 06:05:21', 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `category_filter`
--

CREATE TABLE IF NOT EXISTS `category_filter` (
  `category_id` int(11) NOT NULL,
  `filter_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category_filter`
--

INSERT INTO `category_filter` (`category_id`, `filter_id`) VALUES
(55, 116),
(55, 121),
(55, 130),
(57, 113),
(57, 114),
(57, 115),
(57, 116),
(57, 117),
(57, 118),
(57, 119),
(57, 120),
(57, 121),
(57, 122),
(57, 123),
(57, 124),
(57, 125),
(57, 126),
(57, 127),
(57, 128),
(57, 129),
(57, 130),
(57, 131),
(57, 132),
(57, 133),
(57, 134),
(64, 115);

-- --------------------------------------------------------

--
-- Table structure for table `category_path`
--

CREATE TABLE IF NOT EXISTS `category_path` (
  `category_id` int(11) NOT NULL,
  `path_id` int(11) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category_path`
--

INSERT INTO `category_path` (`category_id`, `path_id`, `level`) VALUES
(78, 78, 2),
(59, 59, 0),
(74, 74, 2),
(60, 60, 0),
(75, 75, 2),
(63, 56, 0),
(84, 84, 2),
(78, 63, 1),
(57, 57, 0),
(61, 61, 0),
(77, 77, 2),
(58, 58, 0),
(55, 116, 0),
(82, 56, 0),
(64, 64, 2),
(69, 116, 0),
(67, 67, 2),
(74, 56, 0),
(82, 82, 2),
(83, 81, 1),
(73, 73, 2),
(68, 55, 1),
(71, 116, 0),
(79, 63, 1),
(69, 55, 1),
(79, 56, 0),
(79, 79, 2),
(82, 81, 1),
(69, 69, 2),
(76, 76, 2),
(78, 56, 0),
(86, 86, 2),
(70, 70, 2),
(77, 56, 0),
(73, 63, 1),
(65, 55, 1),
(87, 85, 1),
(77, 63, 1),
(70, 55, 1),
(67, 116, 0),
(65, 116, 0),
(72, 56, 0),
(73, 56, 0),
(67, 55, 1),
(65, 65, 2),
(75, 56, 0),
(74, 63, 1),
(66, 55, 1),
(72, 63, 1),
(87, 87, 2),
(64, 116, 0),
(72, 72, 2),
(88, 56, 0),
(55, 55, 1),
(86, 85, 1),
(85, 85, 1),
(84, 81, 1),
(84, 56, 0),
(62, 62, 0),
(86, 56, 0),
(71, 71, 2),
(80, 63, 1),
(81, 81, 1),
(66, 66, 2),
(63, 63, 1),
(75, 63, 1),
(70, 116, 0),
(68, 116, 0),
(76, 63, 1),
(68, 68, 2),
(64, 55, 1),
(116, 116, 0),
(71, 55, 1),
(85, 56, 0),
(88, 85, 1),
(80, 56, 0),
(81, 56, 0),
(80, 80, 2),
(87, 56, 0),
(83, 56, 0),
(83, 83, 2),
(66, 116, 0),
(76, 56, 0),
(88, 88, 2),
(89, 56, 0),
(89, 89, 1),
(90, 56, 0),
(90, 89, 1),
(90, 90, 2),
(91, 56, 0),
(91, 89, 1),
(91, 91, 2),
(92, 56, 0),
(92, 89, 1),
(92, 92, 2),
(93, 56, 0),
(93, 89, 1),
(93, 93, 2),
(94, 56, 0),
(94, 89, 1),
(94, 94, 2),
(95, 56, 0),
(95, 95, 1),
(96, 56, 0),
(96, 95, 1),
(96, 96, 2),
(97, 56, 0),
(97, 95, 1),
(97, 97, 2),
(98, 56, 0),
(98, 98, 1),
(99, 56, 0),
(99, 98, 1),
(99, 99, 2),
(100, 56, 0),
(100, 98, 1),
(100, 100, 2),
(101, 56, 0),
(101, 101, 1),
(102, 56, 0),
(102, 101, 1),
(102, 102, 2),
(103, 56, 0),
(103, 101, 1),
(103, 103, 2),
(104, 56, 0),
(104, 101, 1),
(104, 104, 2),
(105, 56, 0),
(105, 105, 1),
(106, 56, 0),
(106, 105, 1),
(106, 106, 2),
(107, 56, 0),
(107, 105, 1),
(107, 107, 2),
(108, 56, 0),
(108, 105, 1),
(108, 108, 2),
(109, 56, 0),
(109, 109, 1),
(110, 56, 0),
(110, 109, 1),
(110, 110, 2),
(111, 56, 0),
(111, 111, 1),
(112, 56, 0),
(112, 112, 1),
(113, 56, 0),
(113, 113, 1),
(114, 56, 0),
(114, 114, 1),
(115, 57, 0),
(115, 115, 1),
(117, 117, 0),
(118, 117, 0),
(118, 118, 1),
(119, 117, 0),
(119, 118, 1),
(119, 119, 2),
(120, 120, 0),
(121, 120, 0),
(121, 121, 1),
(122, 122, 0),
(123, 123, 0),
(124, 124, 0),
(127, 127, 1),
(127, 126, 0),
(126, 126, 0),
(128, 126, 0),
(128, 127, 1),
(128, 128, 2);

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE IF NOT EXISTS `country` (
  `country_id` int(11) NOT NULL,
  `country_name` varchar(255) NOT NULL,
  `iso_code_2` varchar(2) NOT NULL,
  `iso_code` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `status` int(1) NOT NULL COMMENT '1=Enabled, 0=Disabled',
  `is_deleted` int(1) NOT NULL COMMENT '1 = softdeleted, 0 = not softdeleted'
) ENGINE=MyISAM AUTO_INCREMENT=258 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`country_id`, `country_name`, `iso_code_2`, `iso_code`, `date_added`, `added_by`, `date_modified`, `modified_by`, `status`, `is_deleted`) VALUES
(1, 'Afghanistan', 'AF', 'AFG', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(2, 'Albania', 'AL', 'ALB', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(3, 'Algeria', 'DZ', 'DZA', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(4, 'American Samoa', 'AS', 'ASM', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(5, 'Andorra', 'AD', 'AND', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(6, 'Angola', 'AO', 'AGO', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(7, 'Anguilla', 'AI', 'AIA', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(8, 'Antarctica', 'AQ', 'ATA', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(9, 'Antigua and Barbuda', 'AG', 'ATG', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(10, 'Argentina', 'AR', 'ARG', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(11, 'Armenia', 'AM', 'ARM', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(12, 'Aruba', 'AW', 'ABW', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(13, 'Australia', 'AU', 'AUS', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(14, 'Austria', 'AT', 'AUT', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(15, 'Azerbaijan', 'AZ', 'AZE', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(16, 'Bahamas', 'BS', 'BHS', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(17, 'Bahrain', 'BH', 'BHR', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(18, 'Bangladesh', 'BD', 'BGD', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(19, 'Barbados', 'BB', 'BRB', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(20, 'Belarus', 'BY', 'BLR', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(21, 'Belgium', 'BE', 'BEL', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(22, 'Belize', 'BZ', 'BLZ', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(23, 'Benin', 'BJ', 'BEN', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(24, 'Bermuda', 'BM', 'BMU', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(25, 'Bhutan', 'BT', 'BTN', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(26, 'Bolivia', 'BO', 'BOL', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(27, 'Bosnia and Herzegovina', 'BA', 'BIH', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(28, 'Botswana', 'BW', 'BWA', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(29, 'Bouvet Island', 'BV', 'BVT', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(30, 'Brazil', 'BR', 'BRA', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(31, 'British Indian Ocean Territory', 'IO', 'IOT', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(32, 'Brunei Darussalam', 'BN', 'BRN', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(33, 'Bulgaria', 'BG', 'BGR', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(34, 'Burkina Faso', 'BF', 'BFA', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(35, 'Burundi', 'BI', 'BDI', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(36, 'Cambodia', 'KH', 'KHM', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(37, 'Cameroon', 'CM', 'CMR', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(38, 'Canada', 'CA', 'CAN', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(39, 'Cape Verde', 'CV', 'CPV', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(40, 'Cayman Islands', 'KY', 'CYM', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(41, 'Central African Republic', 'CF', 'CAF', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(42, 'Chad', 'TD', 'TCD', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(43, 'Chile', 'CL', 'CHL', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(44, 'China', 'CN', 'CHN', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(45, 'Christmas Island', 'CX', 'CXR', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(46, 'Cocos (Keeling) Islands', 'CC', 'CCK', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(47, 'Colombia', 'CO', 'COL', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(48, 'Comoros', 'KM', 'COM', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(49, 'Congo', 'CG', 'COG', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(50, 'Cook Islands', 'CK', 'COK', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(51, 'Costa Rica', 'CR', 'CRI', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(52, 'Cote D''Ivoire', 'CI', 'CIV', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(53, 'Croatia', 'HR', 'HRV', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(54, 'Cuba', 'CU', 'CUB', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(55, 'Cyprus', 'CY', 'CYP', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(56, 'Czech Republic', 'CZ', 'CZE', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(57, 'Denmark', 'DK', 'DNK', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(58, 'Djibouti', 'DJ', 'DJI', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(59, 'Dominica', 'DM', 'DMA', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(60, 'Dominican Republic', 'DO', 'DOM', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(61, 'East Timor', 'TL', 'TLS', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(62, 'Ecuador', 'EC', 'ECU', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(63, 'Egypt', 'EG', 'EGY', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(64, 'El Salvador', 'SV', 'SLV', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(65, 'Equatorial Guinea', 'GQ', 'GNQ', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(66, 'Eritrea', 'ER', 'ERI', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(67, 'Estonia', 'EE', 'EST', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(68, 'Ethiopia', 'ET', 'ETH', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(69, 'Falkland Islands (Malvinas)', 'FK', 'FLK', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(70, 'Faroe Islands', 'FO', 'FRO', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(71, 'Fiji', 'FJ', 'FJI', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(72, 'Finland', 'FI', 'FIN', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(74, 'France, Metropolitan', 'FR', 'FRA', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(75, 'French Guiana', 'GF', 'GUF', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(76, 'French Polynesia', 'PF', 'PYF', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(77, 'French Southern Territories', 'TF', 'ATF', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(78, 'Gabon', 'GA', 'GAB', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(79, 'Gambia', 'GM', 'GMB', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(80, 'Georgia', 'GE', 'GEO', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(81, 'Germany', 'DE', 'DEU', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(82, 'Ghana', 'GH', 'GHA', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(83, 'Gibraltar', 'GI', 'GIB', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(84, 'Greece', 'GR', 'GRC', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(85, 'Greenland', 'GL', 'GRL', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(86, 'Grenada', 'GD', 'GRD', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(87, 'Guadeloupe', 'GP', 'GLP', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(88, 'Guam', 'GU', 'GUM', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(89, 'Guatemala', 'GT', 'GTM', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(90, 'Guinea', 'GN', 'GIN', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(91, 'Guinea-Bissau', 'GW', 'GNB', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(92, 'Guyana', 'GY', 'GUY', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(93, 'Haiti', 'HT', 'HTI', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(94, 'Heard and Mc Donald Islands', 'HM', 'HMD', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(95, 'Honduras', 'HN', 'HND', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(96, 'Hong Kong', 'HK', 'HKG', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(97, 'Hungary', 'HU', 'HUN', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(98, 'Iceland', 'IS', 'ISL', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(99, 'India', 'IN', 'IND', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(100, 'Indonesia', 'ID', 'IDN', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(101, 'Iran (Islamic Republic of)', 'IR', 'IRN', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(102, 'Iraq', 'IQ', 'IRQ', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(103, 'Ireland', 'IE', 'IRL', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(104, 'Israel', 'IL', 'ISR', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(105, 'Italy', 'IT', 'ITA', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(106, 'Jamaica', 'JM', 'JAM', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(107, 'Japan', 'JP', 'JPN', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(108, 'Jordan', 'JO', 'JOR', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(109, 'Kazakhstan', 'KZ', 'KAZ', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(110, 'Kenya', 'KE', 'KEN', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(111, 'Kiribati', 'KI', 'KIR', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(112, 'North Korea', 'KP', 'PRK', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(113, 'South Korea', 'KR', 'KOR', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(114, 'Kuwait', 'KW', 'KWT', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(115, 'Kyrgyzstan', 'KG', 'KGZ', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(116, 'Lao People''s Democratic Republic', 'LA', 'LAO', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(117, 'Latvia', 'LV', 'LVA', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(118, 'Lebanon', 'LB', 'LBN', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(119, 'Lesotho', 'LS', 'LSO', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(120, 'Liberia', 'LR', 'LBR', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(121, 'Libyan Arab Jamahiriya', 'LY', 'LBY', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(122, 'Liechtenstein', 'LI', 'LIE', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(123, 'Lithuania', 'LT', 'LTU', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(124, 'Luxembourg', 'LU', 'LUX', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(125, 'Macau', 'MO', 'MAC', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(126, 'FYROM', 'MK', 'MKD', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(127, 'Madagascar', 'MG', 'MDG', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(128, 'Malawi', 'MW', 'MWI', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(129, 'Malaysia', 'MY', 'MYS', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(130, 'Maldives', 'MV', 'MDV', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(131, 'Mali', 'ML', 'MLI', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(132, 'Malta', 'MT', 'MLT', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(133, 'Marshall Islands', 'MH', 'MHL', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(134, 'Martinique', 'MQ', 'MTQ', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(135, 'Mauritania', 'MR', 'MRT', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(136, 'Mauritius', 'MU', 'MUS', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(137, 'Mayotte', 'YT', 'MYT', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(138, 'Mexico', 'MX', 'MEX', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(139, 'Micronesia, Federated States of', 'FM', 'FSM', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(140, 'Moldova, Republic of', 'MD', 'MDA', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(141, 'Monaco', 'MC', 'MCO', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(142, 'Mongolia', 'MN', 'MNG', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(143, 'Montserrat', 'MS', 'MSR', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(144, 'Morocco', 'MA', 'MAR', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(145, 'Mozambique', 'MZ', 'MOZ', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(146, 'Myanmar', 'MM', 'MMR', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(147, 'Namibia', 'NA', 'NAM', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(148, 'Nauru', 'NR', 'NRU', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(149, 'Nepal', 'NP', 'NPL', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(150, 'Netherlands', 'NL', 'NLD', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(151, 'Netherlands Antilles', 'AN', 'ANT', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(152, 'New Caledonia', 'NC', 'NCL', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(153, 'New Zealand', 'NZ', 'NZL', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(154, 'Nicaragua', 'NI', 'NIC', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(155, 'Niger', 'NE', 'NER', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(156, 'Nigeria', 'NG', 'NGA', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(157, 'Niue', 'NU', 'NIU', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(158, 'Norfolk Island', 'NF', 'NFK', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(159, 'Northern Mariana Islands', 'MP', 'MNP', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(160, 'Norway', 'NO', 'NOR', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(161, 'Oman', 'OM', 'OMN', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(162, 'Pakistan', 'PK', 'PAK', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(163, 'Palau', 'PW', 'PLW', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(164, 'Panama', 'PA', 'PAN', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(165, 'Papua New Guinea', 'PG', 'PNG', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(166, 'Paraguay', 'PY', 'PRY', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(167, 'Peru', 'PE', 'PER', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(168, 'Philippines', 'PH', 'PHL', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(169, 'Pitcairn', 'PN', 'PCN', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(170, 'Poland', 'PL', 'POL', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(171, 'Portugal', 'PT', 'PRT', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(172, 'Puerto Rico', 'PR', 'PRI', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(173, 'Qatar', 'QA', 'QAT', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(174, 'Reunion', 'RE', 'REU', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(175, 'Romania', 'RO', 'ROM', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(176, 'Russian Federation', 'RU', 'RUS', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(177, 'Rwanda', 'RW', 'RWA', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(178, 'Saint Kitts and Nevis', 'KN', 'KNA', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(179, 'Saint Lucia', 'LC', 'LCA', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(180, 'Saint Vincent and the Grenadines', 'VC', 'VCT', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(181, 'Samoa', 'WS', 'WSM', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(182, 'San Marino', 'SM', 'SMR', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(183, 'Sao Tome and Principe', 'ST', 'STP', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(184, 'Saudi Arabia', 'SA', 'SAU', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(185, 'Senegal', 'SN', 'SEN', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(186, 'Seychelles', 'SC', 'SYC', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(187, 'Sierra Leone', 'SL', 'SLE', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(188, 'Singapore', 'SG', 'SGP', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(189, 'Slovak Republic', 'SK', 'SVK', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(190, 'Slovenia', 'SI', 'SVN', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(191, 'Solomon Islands', 'SB', 'SLB', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(192, 'Somalia', 'SO', 'SOM', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(193, 'South Africa', 'ZA', 'ZAF', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(194, 'South Georgia &amp; South Sandwich Islands', 'GS', 'SGS', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(195, 'Spain', 'ES', 'ESP', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(196, 'Sri Lanka', 'LK', 'LKA', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(197, 'St. Helena', 'SH', 'SHN', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(198, 'St. Pierre and Miquelon', 'PM', 'SPM', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(199, 'Sudan', 'SD', 'SDN', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(200, 'Suriname', 'SR', 'SUR', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(201, 'Svalbard and Jan Mayen Islands', 'SJ', 'SJM', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(202, 'Swaziland', 'SZ', 'SWZ', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(203, 'Sweden', 'SE', 'SWE', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(204, 'Switzerland', 'CH', 'CHE', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(205, 'Syrian Arab Republic', 'SY', 'SYR', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(206, 'Taiwan', 'TW', 'TWN', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(207, 'Tajikistan', 'TJ', 'TJK', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(208, 'Tanzania, United Republic of', 'TZ', 'TZA', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(209, 'Thailand', 'TH', 'THA', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(210, 'Togo', 'TG', 'TGO', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(211, 'Tokelau', 'TK', 'TKL', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(212, 'Tonga', 'TO', 'TON', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(213, 'Trinidad and Tobago', 'TT', 'TTO', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(214, 'Tunisia', 'TN', 'TUN', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(215, 'Turkey', 'TR', 'TUR', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(216, 'Turkmenistan', 'TM', 'TKM', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(217, 'Turks and Caicos Islands', 'TC', 'TCA', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(218, 'Tuvalu', 'TV', 'TUV', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(219, 'Uganda', 'UG', 'UGA', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(220, 'Ukraine', 'UA', 'UKR', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(221, 'United Arab Emirates', 'AE', 'ARE', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(222, 'United Kingdom', 'GB', 'GBR', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(223, 'United States', 'US', 'USA', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(224, 'United States Minor Outlying Islands', 'UM', 'UMI', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(225, 'Uruguay', 'UY', 'URY', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(226, 'Uzbekistan', 'UZ', 'UZB', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(227, 'Vanuatu', 'VU', 'VUT', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(228, 'Vatican City State (Holy See)', 'VA', 'VAT', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(229, 'Venezuela', 'VE', 'VEN', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(230, 'Viet Nam', 'VN', 'VNM', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(231, 'Virgin Islands (British)', 'VG', 'VGB', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(232, 'Virgin Islands (U.S.)', 'VI', 'VIR', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(233, 'Wallis and Futuna Islands', 'WF', 'WLF', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(234, 'Western Sahara', 'EH', 'ESH', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(235, 'Yemen', 'YE', 'YEM', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(237, 'Democratic Republic of Congo', 'CD', 'COD', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(238, 'Zambia', 'ZM', 'ZMB', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(239, 'Zimbabwe', 'ZW', 'ZWE', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(242, 'Montenegro', 'ME', 'MNE', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(243, 'Serbia', 'RS', 'SRB', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(244, 'Aaland Islands', 'AX', 'ALA', '0000-00-00 00:00:00', 0, '2016-12-12 04:10:49', 1, 1, 1),
(245, 'Bonaire, Sint Eustatius and Saba', 'BQ', 'BES', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(246, 'Curacao', 'CW', 'CUW', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(247, 'Palestinian Territory, Occupied', 'PS', 'PSE', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(248, 'South Sudan', 'SS', 'SSD', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(249, 'St. Barthelemy', 'BL', 'BLM', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(250, 'St. Martin (French part)', 'MF', 'MAF', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(251, 'Canary Islands', 'IC', 'ICA', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(252, 'Ascension Island (British)', 'AC', 'ASC', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(253, 'Kosovo, Republic of', 'XK', 'UNK', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(254, 'Isle of Man', 'IM', 'IMN', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(255, 'Tristan da Cunha', 'TA', 'SHN', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(256, 'Guernsey', 'GG', 'GGY', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(257, 'Jersey', 'JE', 'JEY', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `coupon`
--

CREATE TABLE IF NOT EXISTS `coupon` (
  `coupon_id` int(11) NOT NULL,
  `coupon_name` varchar(255) NOT NULL,
  `coupon_code` varchar(255) NOT NULL,
  `coupon_type` varchar(255) NOT NULL,
  `discount` varchar(255) NOT NULL,
  `logged` int(1) NOT NULL,
  `shipping` int(1) NOT NULL,
  `total` varchar(255) NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `uses_total` int(11) NOT NULL,
  `uses_customer` varchar(255) NOT NULL,
  `status` int(1) NOT NULL COMMENT '1=Enabled, 0=Disabled',
  `date_added` datetime NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `is_deleted` int(1) NOT NULL COMMENT '1 = softdeleted, 0 = not softdeleted'
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coupon`
--

INSERT INTO `coupon` (`coupon_id`, `coupon_name`, `coupon_code`, `coupon_type`, `discount`, `logged`, `shipping`, `total`, `date_start`, `date_end`, `uses_total`, `uses_customer`, `status`, `date_added`, `added_by`, `date_modified`, `modified_by`, `is_deleted`) VALUES
(9, 'Free Shipping', 'XMAS123', 'percentage', '20', 0, 0, '200', '2016-12-12', '2016-12-12', 0, '', 1, '2016-12-12 10:01:47', 1, '2016-12-12 10:02:22', 1, 1),
(10, 'PRO', 'SRAPO', 'percentage', '10', 0, 0, '500', '2016-12-12', '2017-01-01', 1, '1', 1, '2016-12-12 10:03:14', 1, '2016-12-31 04:35:20', 17, 0),
(11, 'ryryryry', 'ryrey', 'percentage', '12', 0, 0, '123', '0000-00-00', '0000-00-00', 1, '1', 1, '2016-12-12 10:12:07', 1, '2016-12-19 11:42:21', 17, 0),
(12, 'ACCoupan', 'AUD', 'percentage', '', 0, 0, '', '0000-00-00', '0000-00-00', 1, '1', 0, '2016-12-12 11:39:12', 1, '2016-12-12 12:31:15', 1, 0),
(13, 'demo', 'demo', 'percentage', '2', 1, 1, '100', '2016-12-17', '2016-12-17', 1, '1', 1, '2016-12-17 04:28:51', 23, '2016-12-19 11:42:32', 17, 0),
(14, 'sandip', 'sandip', 'percentage', '10', 0, 0, '', '2016-12-30', '2017-01-01', 1, '1', 1, '2016-12-31 04:58:01', 17, '2016-12-31 05:10:04', 17, 0);

-- --------------------------------------------------------

--
-- Table structure for table `coupon_category`
--

CREATE TABLE IF NOT EXISTS `coupon_category` (
  `coupon_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `status` int(1) NOT NULL COMMENT '1=Enabled, 0=Disabled',
  `is_deleted` int(1) NOT NULL COMMENT '1 = softdeleted, 0 = not softdeleted'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `coupon_history`
--

CREATE TABLE IF NOT EXISTS `coupon_history` (
  `coupon_history_id` int(11) NOT NULL,
  `coupon_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `status` int(1) NOT NULL COMMENT '1=Enabled, 0=Disabled',
  `is_deleted` int(1) NOT NULL COMMENT '1 = softdeleted, 0 = not softdeleted'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `coupon_product`
--

CREATE TABLE IF NOT EXISTS `coupon_product` (
  `coupon_product_id` int(11) NOT NULL,
  `coupon_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `date_added` date NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `status` int(1) NOT NULL COMMENT '1=Enabled, 0=Disabled',
  `is_deleted` int(1) NOT NULL COMMENT '1 = softdeleted, 0 = not softdeleted'
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coupon_product`
--

INSERT INTO `coupon_product` (`coupon_product_id`, `coupon_id`, `product_id`, `date_added`, `added_by`, `date_modified`, `modified_by`, `status`, `is_deleted`) VALUES
(43, 9, 19, '2016-12-12', 1, '2016-12-12 10:02:22', 1, 1, 1),
(52, 10, 19, '2016-12-31', 17, '2016-12-31 04:35:20', 17, 1, 0),
(54, 14, 19, '2016-12-31', 17, '2016-12-31 05:10:04', 17, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `currency`
--

CREATE TABLE IF NOT EXISTS `currency` (
  `currency_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `symbol_left` varchar(255) NOT NULL,
  `symbol_right` varchar(255) NOT NULL,
  `decimal_place` char(1) NOT NULL,
  `value` float(15,8) NOT NULL,
  `date_added` datetime NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `status` int(1) NOT NULL COMMENT '1=Enabled, 0=Disabled',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1 = softdeleted, 0 = not softdeleted'
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `currency`
--

INSERT INTO `currency` (`currency_id`, `title`, `code`, `symbol_left`, `symbol_right`, `decimal_place`, `value`, `date_added`, `added_by`, `date_modified`, `modified_by`, `status`, `is_deleted`) VALUES
(7, 'Dollar', 'USD', '$', '', '2', 0.01470000, '2016-11-12 07:12:49', 1, '2017-01-26 13:03:06', 1, 1, 0),
(15, 'Yuan Renminbi', 'CNY', '¥', '', '0', 0.10050000, '2016-12-12 09:21:12', 1, '2017-01-26 13:03:06', 1, 0, 0),
(16, 'Rupee', 'INR', 'Rs. ', '', '0', 1.00000000, '2016-12-12 09:26:25', 1, '2017-01-26 13:03:06', 1, 0, 0),
(17, 'fghgfh', 'YYR', '', '', '0', 25.00000000, '2016-12-12 11:24:08', 1, '2016-12-12 11:25:00', 1, 0, 1),
(18, 'tyt', 'MJH', '', '', '0', 0.00000000, '2016-12-12 11:24:21', 1, '2016-12-12 11:24:21', 1, 0, 1),
(19, 'test', '123', '', '#', '2', 25.00000000, '2016-12-30 09:43:08', 17, '2016-12-31 04:17:40', 17, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `currency_country`
--

CREATE TABLE IF NOT EXISTS `currency_country` (
  `id` int(11) NOT NULL,
  `country_name` varchar(255) NOT NULL,
  `country_code` varchar(255) NOT NULL,
  `currency_name` varchar(255) NOT NULL,
  `currency_code` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=245 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `currency_country`
--

INSERT INTO `currency_country` (`id`, `country_name`, `country_code`, `currency_name`, `currency_code`) VALUES
(1, 'Afghanistan', 'AF', 'Afghanistan Afghani', 'AFN'),
(2, 'Albania', 'AL', 'Albanian Lek', 'ALL'),
(3, 'Algeria', 'DZ', 'Algerian Dinar', 'DZD'),
(4, 'American Samoa', 'AS', 'US Dollar', 'USD'),
(5, 'Andorra', 'AD', 'Euro', 'EUR'),
(6, 'Angola', 'AO', 'Angolan Kwanza', 'AOA'),
(7, 'Anguilla', 'AI', 'East Caribbean Dollar', 'XCD'),
(8, 'Antarctica', 'AQ', 'East Caribbean Dollar', 'XCD'),
(9, 'Antigua and Barbuda', 'AG', 'East Caribbean Dollar', 'XCD'),
(10, 'Argentina', 'AR', 'Argentine Peso', 'ARS'),
(11, 'Armenia', 'AM', 'Armenian Dram', 'AMD'),
(12, 'Aruba', 'AW', 'Aruban Guilder', 'AWG'),
(13, 'Australia', 'AU', 'Australian Dollar', 'AUD'),
(14, 'Austria', 'AT', 'Euro', 'EUR'),
(15, 'Azerbaijan', 'AZ', 'Azerbaijan New Manat', 'AZN'),
(16, 'Bahamas', 'BS', 'Bahamian Dollar', 'BSD'),
(17, 'Bahrain', 'BH', 'Bahraini Dinar', 'BHD'),
(18, 'Bangladesh', 'BD', 'Bangladeshi Taka', 'BDT'),
(19, 'Barbados', 'BB', 'Barbados Dollar', 'BBD'),
(20, 'Belarus', 'BY', 'Belarussian Ruble', 'BYR'),
(21, 'Belgium', 'BE', 'Euro', 'EUR'),
(22, 'Belize', 'BZ', 'Belize Dollar', 'BZD'),
(23, 'Benin', 'BJ', 'CFA Franc BCEAO', 'XOF'),
(24, 'Bermuda', 'BM', 'Bermudian Dollar', 'BMD'),
(25, 'Bhutan', 'BT', 'Bhutan Ngultrum', 'BTN'),
(26, 'Bolivia', 'BO', 'Boliviano', 'BOB'),
(27, 'Bosnia-Herzegovina', 'BA', 'Marka', 'BAM'),
(28, 'Botswana', 'BW', 'Botswana Pula', 'BWP'),
(29, 'Bouvet Island', 'BV', 'Norwegian Krone', 'NOK'),
(30, 'Brazil', 'BR', 'Brazilian Real', 'BRL'),
(31, 'British Indian Ocean Territory', 'IO', 'US Dollar', 'USD'),
(32, 'Brunei Darussalam', 'BN', 'Brunei Dollar', 'BND'),
(33, 'Bulgaria', 'BG', 'Bulgarian Lev', 'BGN'),
(34, 'Burkina Faso', 'BF', 'CFA Franc BCEAO', 'XOF'),
(35, 'Burundi', 'BI', 'Burundi Franc', 'BIF'),
(36, 'Cambodia', 'KH', 'Kampuchean Riel', 'KHR'),
(37, 'Cameroon', 'CM', 'CFA Franc BEAC', 'XAF'),
(38, 'Canada', 'CA', 'Canadian Dollar', 'CAD'),
(39, 'Cape Verde', 'CV', 'Cape Verde Escudo', 'CVE'),
(40, 'Cayman Islands', 'KY', 'Cayman Islands Dollar', 'KYD'),
(41, 'Central African Republic', 'CF', 'CFA Franc BEAC', 'XAF'),
(42, 'Chad', 'TD', 'CFA Franc BEAC', 'XAF'),
(43, 'Chile', 'CL', 'Chilean Peso', 'CLP'),
(44, 'China', 'CN', 'Yuan Renminbi', 'CNY'),
(45, 'Christmas Island', 'CX', 'Australian Dollar', 'AUD'),
(46, 'Cocos (Keeling) Islands', 'CC', 'Australian Dollar', 'AUD'),
(47, 'Colombia', 'CO', 'Colombian Peso', 'COP'),
(48, 'Comoros', 'KM', 'Comoros Franc', 'KMF'),
(49, 'Congo', 'CG', 'CFA Franc BEAC', 'XAF'),
(50, 'Congo, Dem. Republic', 'CD', 'Francs', 'CDF'),
(51, 'Cook Islands', 'CK', 'New Zealand Dollar', 'NZD'),
(52, 'Costa Rica', 'CR', 'Costa Rican Colon', 'CRC'),
(53, 'Croatia', 'HR', 'Croatian Kuna', 'HRK'),
(54, 'Cuba', 'CU', 'Cuban Peso', 'CUP'),
(55, 'Cyprus', 'CY', 'Euro', 'EUR'),
(56, 'Czech Rep.', 'CZ', 'Czech Koruna', 'CZK'),
(57, 'Denmark', 'DK', 'Danish Krone', 'DKK'),
(58, 'Djibouti', 'DJ', 'Djibouti Franc', 'DJF'),
(59, 'Dominica', 'DM', 'East Caribbean Dollar', 'XCD'),
(60, 'Dominican Republic', 'DO', 'Dominican Peso', 'DOP'),
(61, 'Ecuador', 'EC', 'Ecuador Sucre', 'ECS'),
(62, 'Egypt', 'EG', 'Egyptian Pound', 'EGP'),
(63, 'El Salvador', 'SV', 'El Salvador Colon', 'SVC'),
(64, 'Equatorial Guinea', 'GQ', 'CFA Franc BEAC', 'XAF'),
(65, 'Eritrea', 'ER', 'Eritrean Nakfa', 'ERN'),
(66, 'Estonia', 'EE', 'Euro', 'EUR'),
(67, 'Ethiopia', 'ET', 'Ethiopian Birr', 'ETB'),
(68, 'European Union', 'EU.INT', 'Euro', 'EUR'),
(69, 'Falkland Islands (Malvinas)', 'FK', 'Falkland Islands Pound', 'FKP'),
(70, 'Faroe Islands', 'FO', 'Danish Krone', 'DKK'),
(71, 'Fiji', 'FJ', 'Fiji Dollar', 'FJD'),
(72, 'Finland', 'FI', 'Euro', 'EUR'),
(73, 'France', 'FR', 'Euro', 'EUR'),
(74, 'French Guiana', 'GF', 'Euro', 'EUR'),
(75, 'French Southern Territories', 'TF', 'Euro', 'EUR'),
(76, 'Gabon', 'GA', 'CFA Franc BEAC', 'XAF'),
(77, 'Gambia', 'GM', 'Gambian Dalasi', 'GMD'),
(78, 'Georgia', 'GE', 'Georgian Lari', 'GEL'),
(79, 'Germany', 'DE', 'Euro', 'EUR'),
(80, 'Ghana', 'GH', 'Ghanaian Cedi', 'GHS'),
(81, 'Gibraltar', 'GI', 'Gibraltar Pound', 'GIP'),
(82, 'Great Britain', 'GB', 'Pound Sterling', 'GBP'),
(83, 'Greece', 'GR', 'Euro', 'EUR'),
(84, 'Greenland', 'GL', 'Danish Krone', 'DKK'),
(85, 'Grenada', 'GD', 'East Carribean Dollar', 'XCD'),
(86, 'Guadeloupe (French)', 'GP', 'Euro', 'EUR'),
(87, 'Guam (USA)', 'GU', 'US Dollar', 'USD'),
(88, 'Guatemala', 'GT', 'Guatemalan Quetzal', 'QTQ'),
(89, 'Guernsey', 'GG', 'Pound Sterling', 'GGP'),
(90, 'Guinea', 'GN', 'Guinea Franc', 'GNF'),
(91, 'Guinea Bissau', 'GW', 'Guinea-Bissau Peso', 'GWP'),
(92, 'Guyana', 'GY', 'Guyana Dollar', 'GYD'),
(93, 'Haiti', 'HT', 'Haitian Gourde', 'HTG'),
(94, 'Heard Island and McDonald Islands', 'HM', 'Australian Dollar', 'AUD'),
(95, 'Honduras', 'HN', 'Honduran Lempira', 'HNL'),
(96, 'Hong Kong', 'HK', 'Hong Kong Dollar', 'HKD'),
(97, 'Hungary', 'HU', 'Hungarian Forint', 'HUF'),
(98, 'Iceland', 'IS', 'Iceland Krona', 'ISK'),
(99, 'India', 'IN', 'Indian Rupee', 'INR'),
(100, 'Indonesia', 'ID', 'Indonesian Rupiah', 'IDR'),
(101, 'Iran', 'IR', 'Iranian Rial', 'IRR'),
(102, 'Iraq', 'IQ', 'Iraqi Dinar', 'IQD'),
(103, 'Ireland', 'IE', 'Euro', 'EUR'),
(104, 'Isle of Man', 'IM', 'Pound Sterling', 'GBP'),
(105, 'Israel', 'IL', 'Israeli New Shekel', 'ILS'),
(106, 'Italy', 'IT', 'Euro', 'EUR'),
(107, 'Ivory Coast', 'CI', 'CFA Franc BCEAO', 'XOF'),
(108, 'Jamaica', 'JM', 'Jamaican Dollar', 'JMD'),
(109, 'Japan', 'JP', 'Japanese Yen', 'JPY'),
(110, 'Jersey', 'JE', 'Pound Sterling', 'GBP'),
(111, 'Jordan', 'JO', 'Jordanian Dinar', 'JOD'),
(112, 'Kazakhstan', 'KZ', 'Kazakhstan Tenge', 'KZT'),
(113, 'Kenya', 'KE', 'Kenyan Shilling', 'KES'),
(114, 'Kiribati', 'KI', 'Australian Dollar', 'AUD'),
(115, 'Korea-North', 'KP', 'North Korean Won', 'KPW'),
(116, 'Korea-South', 'KR', 'Korean Won', 'KRW'),
(117, 'Kuwait', 'KW', 'Kuwaiti Dinar', 'KWD'),
(118, 'Kyrgyzstan', 'KG', 'Som', 'KGS'),
(119, 'Laos', 'LA', 'Lao Kip', 'LAK'),
(120, 'Latvia', 'LV', 'Latvian Lats', 'LVL'),
(121, 'Lebanon', 'LB', 'Lebanese Pound', 'LBP'),
(122, 'Lesotho', 'LS', 'Lesotho Loti', 'LSL'),
(123, 'Liberia', 'LR', 'Liberian Dollar', 'LRD'),
(124, 'Libya', 'LY', 'Libyan Dinar', 'LYD'),
(125, 'Liechtenstein', 'LI', 'Swiss Franc', 'CHF'),
(126, 'Lithuania', 'LT', 'Lithuanian Litas', 'LTL'),
(127, 'Luxembourg', 'LU', 'Euro', 'EUR'),
(128, 'Macau', 'MO', 'Macau Pataca', 'MOP'),
(129, 'Macedonia', 'MK', 'Denar', 'MKD'),
(130, 'Madagascar', 'MG', 'Malagasy Franc', 'MGF'),
(131, 'Malawi', 'MW', 'Malawi Kwacha', 'MWK'),
(132, 'Malaysia', 'MY', 'Malaysian Ringgit', 'MYR'),
(133, 'Maldives', 'MV', 'Maldive Rufiyaa', 'MVR'),
(134, 'Mali', 'ML', 'CFA Franc BCEAO', 'XOF'),
(135, 'Malta', 'MT', 'Euro', 'EUR'),
(136, 'Marshall Islands', 'MH', 'US Dollar', 'USD'),
(137, 'Martinique (French)', 'MQ', 'Euro', 'EUR'),
(138, 'Mauritania', 'MR', 'Mauritanian Ouguiya', 'MRO'),
(139, 'Mauritius', 'MU', 'Mauritius Rupee', 'MUR'),
(140, 'Mayotte', 'YT', 'Euro', 'EUR'),
(141, 'Mexico', 'MX', 'Mexican Nuevo Peso', 'MXN'),
(142, 'Micronesia', 'FM', 'US Dollar', 'USD'),
(143, 'Moldova', 'MD', 'Moldovan Leu', 'MDL'),
(144, 'Monaco', 'MC', 'Euro', 'EUR'),
(145, 'Mongolia', 'MN', 'Mongolian Tugrik', 'MNT'),
(146, 'Montenegro', 'ME', 'Euro', 'EUR'),
(147, 'Montserrat', 'MS', 'East Caribbean Dollar', 'XCD'),
(148, 'Morocco', 'MA', 'Moroccan Dirham', 'MAD'),
(149, 'Mozambique', 'MZ', 'Mozambique Metical', 'MZN'),
(150, 'Myanmar', 'MM', 'Myanmar Kyat', 'MMK'),
(151, 'Namibia', 'NA', 'Namibian Dollar', 'NAD'),
(152, 'Nauru', 'NR', 'Australian Dollar', 'AUD'),
(153, 'Nepal', 'NP', 'Nepalese Rupee', 'NPR'),
(154, 'Netherlands', 'NL', 'Euro', 'EUR'),
(155, 'Netherlands Antilles', 'AN', 'Netherlands Antillean Guilder', 'ANG'),
(156, 'New Caledonia (French)', 'NC', 'CFP Franc', 'XPF'),
(157, 'New Zealand', 'NZ', 'New Zealand Dollar', 'NZD'),
(158, 'Nicaragua', 'NI', 'Nicaraguan Cordoba Oro', 'NIO'),
(159, 'Niger', 'NE', 'CFA Franc BCEAO', 'XOF'),
(160, 'Nigeria', 'NG', 'Nigerian Naira', 'NGN'),
(161, 'Niue', 'NU', 'New Zealand Dollar', 'NZD'),
(162, 'Norfolk Island', 'NF', 'Australian Dollar', 'AUD'),
(163, 'Northern Mariana Islands', 'MP', 'US Dollar', 'USD'),
(164, 'Norway', 'NO', 'Norwegian Krone', 'NOK'),
(165, 'Oman', 'OM', 'Omani Rial', 'OMR'),
(166, 'Pakistan', 'PK', 'Pakistan Rupee', 'PKR'),
(167, 'Palau', 'PW', 'US Dollar', 'USD'),
(168, 'Panama', 'PA', 'Panamanian Balboa', 'PAB'),
(169, 'Papua New Guinea', 'PG', 'Papua New Guinea Kina', 'PGK'),
(170, 'Paraguay', 'PY', 'Paraguay Guarani', 'PYG'),
(171, 'Peru', 'PE', 'Peruvian Nuevo Sol', 'PEN'),
(172, 'Philippines', 'PH', 'Philippine Peso', 'PHP'),
(173, 'Pitcairn Island', 'PN', 'New Zealand Dollar', 'NZD'),
(174, 'Poland', 'PL', 'Polish Zloty', 'PLN'),
(175, 'Polynesia (French)', 'PF', 'CFP Franc', 'XPF'),
(176, 'Portugal', 'PT', 'Euro', 'EUR'),
(177, 'Puerto Rico', 'PR', 'US Dollar', 'USD'),
(178, 'Qatar', 'QA', 'Qatari Rial', 'QAR'),
(179, 'Reunion (French)', 'RE', 'Euro', 'EUR'),
(180, 'Romania', 'RO', 'Romanian New Leu', 'RON'),
(181, 'Russia', 'RU', 'Russian Ruble', 'RUB'),
(182, 'Rwanda', 'RW', 'Rwanda Franc', 'RWF'),
(183, 'Saint Helena', 'SH', 'St. Helena Pound', 'SHP'),
(184, 'Saint Kitts & Nevis Anguilla', 'KN', 'East Caribbean Dollar', 'XCD'),
(185, 'Saint Lucia', 'LC', 'East Caribbean Dollar', 'XCD'),
(186, 'Saint Pierre and Miquelon', 'PM', 'Euro', 'EUR'),
(187, 'Saint Vincent & Grenadines', 'VC', 'East Caribbean Dollar', 'XCD'),
(188, 'Samoa', 'WS', 'Samoan Tala', 'WST'),
(189, 'San Marino', 'SM', 'Euro', 'EUR'),
(190, 'Sao Tome and Principe', 'ST', 'Dobra', 'STD'),
(191, 'Saudi Arabia', 'SA', 'Saudi Riyal', 'SAR'),
(192, 'Senegal', 'SN', 'CFA Franc BCEAO', 'XOF'),
(193, 'Serbia', 'RS', 'Dinar', 'RSD'),
(194, 'Seychelles', 'SC', 'Seychelles Rupee', 'SCR'),
(195, 'Sierra Leone', 'SL', 'Sierra Leone Leone', 'SLL'),
(196, 'Singapore', 'SG', 'Singapore Dollar', 'SGD'),
(197, 'Slovakia', 'SK', 'Euro', 'EUR'),
(198, 'Slovenia', 'SI', 'Euro', 'EUR'),
(199, 'Solomon Islands', 'SB', 'Solomon Islands Dollar', 'SBD'),
(200, 'Somalia', 'SO', 'Somali Shilling', 'SOS'),
(201, 'South Africa', 'ZA', 'South African Rand', 'ZAR'),
(202, 'South Georgia & South Sandwich Islands', 'GS', 'Pound Sterling', 'GBP'),
(203, 'South Sudan', 'SS', 'South Sudan Pound', 'SSP'),
(204, 'Spain', 'ES', 'Euro', 'EUR'),
(205, 'Sri Lanka', 'LK', 'Sri Lanka Rupee', 'LKR'),
(206, 'Sudan', 'SD', 'Sudanese Pound', 'SDG'),
(207, 'Suriname', 'SR', 'Surinam Dollar', 'SRD'),
(208, 'Svalbard and Jan Mayen Islands', 'SJ', 'Norwegian Krone', 'NOK'),
(209, 'Swaziland', 'SZ', 'Swaziland Lilangeni', 'SZL'),
(210, 'Sweden', 'SE', 'Swedish Krona', 'SEK'),
(211, 'Switzerland', 'CH', 'Swiss Franc', 'CHF'),
(212, 'Syria', 'SY', 'Syrian Pound', 'SYP'),
(213, 'Taiwan', 'TW', 'Taiwan Dollar', 'TWD'),
(214, 'Tajikistan', 'TJ', 'Tajik Somoni', 'TJS'),
(215, 'Tanzania', 'TZ', 'Tanzanian Shilling', 'TZS'),
(216, 'Thailand', 'TH', 'Thai Baht', 'THB'),
(217, 'Togo', 'TG', 'CFA Franc BCEAO', 'XOF'),
(218, 'Tokelau', 'TK', 'New Zealand Dollar', 'NZD'),
(219, 'Tonga', 'TO', 'Tongan Pa''anga', 'TOP'),
(220, 'Trinidad and Tobago', 'TT', 'Trinidad and Tobago Dollar', 'TTD'),
(221, 'Tunisia', 'TN', 'Tunisian Dollar', 'TND'),
(222, 'Turkey', 'TR', 'Turkish Lira', 'TRY'),
(223, 'Turkmenistan', 'TM', 'Manat', 'TMT'),
(224, 'Turks and Caicos Islands', 'TC', 'US Dollar', 'USD'),
(225, 'Tuvalu', 'TV', 'Australian Dollar', 'AUD'),
(226, 'U.K.', 'UK', 'Pound Sterling', 'GBP'),
(227, 'USA', 'US', 'US Dollar', 'USD'),
(228, 'USA Minor Outlying Islands', 'UM', 'US Dollar', 'USD'),
(229, 'Uganda', 'UG', 'Uganda Shilling', 'UGX'),
(230, 'Ukraine', 'UA', 'Ukraine Hryvnia', 'UAH'),
(231, 'United Arab Emirates', 'AE', 'Arab Emirates Dirham', 'AED'),
(232, 'Uruguay', 'UY', 'Uruguayan Peso', 'UYU'),
(233, 'Uzbekistan', 'UZ', 'Uzbekistan Sum', 'UZS'),
(234, 'Vanuatu', 'VU', 'Vanuatu Vatu', 'VUV'),
(235, 'Vatican', 'VA', 'Euro', 'EUR'),
(236, 'Venezuela', 'VE', 'Venezuelan Bolivar', 'VEF'),
(237, 'Vietnam', 'VN', 'Vietnamese Dong', 'VND'),
(238, 'Virgin Islands (British)', 'VG', 'US Dollar', 'USD'),
(239, 'Virgin Islands (USA)', 'VI', 'US Dollar', 'USD'),
(240, 'Wallis and Futuna Islands', 'WF', 'CFP Franc', 'XPF'),
(241, 'Western Sahara', 'EH', 'Moroccan Dirham', 'MAD'),
(242, 'Yemen', 'YE', 'Yemeni Rial', 'YER'),
(243, 'Zambia', 'ZM', 'Zambian Kwacha', 'ZMW'),
(244, 'Zimbabwe', 'ZW', 'Zimbabwe Dollar', 'ZWD');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `customer_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `address_id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `middlename` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `telephone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `cart` text,
  `wishlist` text,
  `newsletter` int(11) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `activation_code` varchar(255) NOT NULL,
  `last_access` datetime NOT NULL,
  `date_added` datetime NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  `approve` tinyint(1) NOT NULL COMMENT '1 = approve, 0 = not approve',
  `is_deleted` int(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `group_id`, `address_id`, `firstname`, `middlename`, `lastname`, `telephone`, `email`, `password`, `gender`, `dob`, `cart`, `wishlist`, `newsletter`, `ip`, `token`, `activation_code`, `last_access`, `date_added`, `added_by`, `date_modified`, `modified_by`, `status`, `approve`, `is_deleted`) VALUES
(40, 18, 0, 'SANDIP', 'sabhadiya', 't', '123456789', 'ttt@dfdsgt.fdy', 'e10adc3949ba59abbe56e057f20f883e', '1', '2016-12-12', NULL, NULL, 0, '175.100.147.229', '', '', '2016-12-12 10:48:08', '2016-12-12 10:23:28', 1, '2016-12-12 10:48:08', 1, 0, 0, 1),
(41, 18, 0, 'c', 'sabhadiya', 'm', '123456789', 'fgt@dfdsgt.fdy', 'e10adc3949ba59abbe56e057f20f883e', '0', '2016-12-15', NULL, NULL, 0, '175.100.147.180', '', '', '2016-12-16 09:19:26', '2016-12-12 11:19:45', 1, '2016-12-16 09:19:26', 23, 0, 0, 0),
(42, 18, 0, 'raju', 'vaghsiya', 'rj', '123456789', 'rj@dfdsgt.fdy', 'e10adc3949ba59abbe56e057f20f883e', '1', '2016-12-12', NULL, NULL, 0, '175.100.147.229', '', '', '2016-12-12 11:21:03', '2016-12-12 11:21:03', 1, '2016-12-12 11:21:03', 1, 0, 0, 0),
(43, 19, 40, 'sandip', 'sabhadiya', 'ss', '123456', 'ss@vpninfotech.com', 'e10adc3949ba59abbe56e057f20f883e', '1', '2016-11-28', NULL, NULL, 1, '175.100.146.33', '', '', '2016-12-31 04:35:58', '2016-12-17 04:26:19', 23, '2016-12-31 04:35:58', 17, 1, 1, 0),
(44, 19, 0, 'sandip', 'sabhadiya', 'ss', '123456', 'nc@vpninfotech.com', 'e10adc3949ba59abbe56e057f20f883e', '1', '2016-12-17', NULL, NULL, 0, '219.91.138.36', '', '', '2017-01-07 04:22:38', '2016-12-17 11:13:46', 1, '2017-01-07 04:22:38', 1, 1, 0, 0),
(45, 18, 38, 'Indrajit', 'Virendrasinh', 'Kaplatiya', '9998591905', 'ik@vpninfotech.com', 'e10adc3949ba59abbe56e057f20f883e', '1', '2016-11-05', NULL, NULL, 0, '60.254.91.240', '', '', '2017-01-27 08:45:54', '2016-12-29 05:20:22', 17, '2016-12-29 05:20:22', 17, 1, 0, 0),
(46, 19, 0, 'chirag', 'ck', 'kalathiya', '123456', 'chirag@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '1', '2016-12-30', NULL, NULL, 1, '175.100.146.33', '', '', '2016-12-30 09:15:20', '2016-12-30 09:15:20', 1, '2016-12-30 09:15:20', 1, 1, 0, 0),
(49, 18, 49, 'jay1', 'b', 'patel', '1232456', 'pmvpnweb@gmail.com', 'fcea920f7412b5da7be0cf42b8c93759', '1', '0000-00-00', NULL, NULL, 1, '::1', '', '', '2017-02-01 08:35:04', '2017-01-07 05:39:29', 0, '2017-01-09 09:19:27', 49, 1, 1, 0),
(51, 0, 48, 'Vinaykumar', '', 'Ghael', '0123456789', 'vr@vpninfotech.com', 'e10adc3949ba59abbe56e057f20f883e', '', '0000-00-00', NULL, NULL, 0, '219.91.138.53', '', '', '2017-01-27 07:04:46', '2017-01-07 06:43:22', 0, '2017-01-25 11:42:37', 51, 1, 1, 0),
(52, 18, 46, 'Mahesh', 'L', 'Vora', '9871591595', 'mahesh@yahoo.com', '4297f44b13955235245b2497399d7a93', '1', '1991-01-01', NULL, NULL, 0, '219.91.133.49', '', '', '2017-01-09 07:23:41', '2017-01-09 07:23:41', 1, '2017-01-09 07:23:41', 1, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `customer_group`
--

CREATE TABLE IF NOT EXISTS `customer_group` (
  `customer_group_id` int(11) NOT NULL,
  `group_name` varchar(255) NOT NULL,
  `group_description` text NOT NULL,
  `approval` tinyint(1) NOT NULL COMMENT '1 = yes, 0 = no',
  `sort_order` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = active, 0 = inactive',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1 = softdeleted, 0 = not softdeleted'
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_group`
--

INSERT INTO `customer_group` (`customer_group_id`, `group_name`, `group_description`, `approval`, `sort_order`, `date_added`, `added_by`, `date_modified`, `modified_by`, `status`, `is_deleted`) VALUES
(18, 'default', '', 0, 0, '2016-12-12 05:07:39', 1, '2016-12-16 09:18:25', 1, 1, 0),
(19, 'Srapo_Group', 'Srapo_GroupSrapo_Group', 0, 1, '2016-12-16 09:17:44', 23, '2016-12-16 09:17:44', 23, 1, 0),
(20, 'Vpn_group', 'Vpn_group', 1, 2, '2016-12-16 09:18:51', 23, '2016-12-16 09:18:51', 23, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `customer_wishlist`
--

CREATE TABLE IF NOT EXISTS `customer_wishlist` (
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_wishlist`
--

INSERT INTO `customer_wishlist` (`customer_id`, `product_id`, `date_added`) VALUES
(51, 36, '2017-01-27 00:28:06'),
(51, 115, '2017-01-25 05:17:15'),
(51, 129, '2017-01-26 02:46:57'),
(51, 130, '2017-01-25 05:18:20');

-- --------------------------------------------------------

--
-- Table structure for table `download`
--

CREATE TABLE IF NOT EXISTS `download` (
  `download_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `mask` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=Enabled, 0=Disabled',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1 = softdeleted, 0 = not softdeleted'
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `download`
--

INSERT INTO `download` (`download_id`, `name`, `filename`, `mask`, `date_added`, `added_by`, `date_modified`, `modified_by`, `status`, `is_deleted`) VALUES
(10, 'Testing', 'Desert.jpg.ajXmPgBtZxROl21DOUjzJC2GQA5nfyCp', 'Desert.jpg', '2016-12-03 10:37:29', 1, '2016-12-03 10:37:29', 1, 1, 0),
(13, 'hiiii.', 'tshirt.jpg.vuuQ2mgno6yI3jGRSCfeIgpnS6SUYEDb', 'tshirt.jpg', '2016-12-16 04:44:35', 18, '2016-12-16 04:44:35', 18, 1, 0),
(15, 'newa', 'Tulips.jpg.vc3jODXe4fWmW9KGjEwiUpNuWPtHbuuT', 'Tulips.jpg', '2016-12-13 08:59:32', 1, '2016-12-13 08:59:32', 1, 1, 0),
(16, 'abc', 'Tulips.jpg.vc3jODXe4fWmW9KGjEwiUpNuWPtHbuuT', 'Tulips.jpg', '2016-12-13 09:01:35', 1, '2016-12-13 09:01:35', 1, 1, 1),
(17, 'abc', 'Tulips.jpg.vc3jODXe4fWmW9KGjEwiUpNuWPtHbuuT', 'Tulips.jpg', '2016-12-13 09:01:44', 1, '2016-12-13 09:01:44', 1, 1, 1),
(18, 'xyz', 'Tulips.jpg.vc3jODXe4fWmW9KGjEwiUpNuWPtHbuuT', 'Tulips.jpg', '2016-12-13 09:01:54', 1, '2016-12-13 09:01:54', 1, 1, 1),
(19, 'pqr', 'Tulips.jpg.vc3jODXe4fWmW9KGjEwiUpNuWPtHbuuT', 'Tulips.jpg', '2016-12-13 09:02:05', 1, '2016-12-13 09:02:05', 1, 1, 0),
(20, 'qwerty', 'Tulips.jpg.vc3jODXe4fWmW9KGjEwiUpNuWPtHbuuT', 'Tulips.jpg', '2016-12-13 09:02:15', 1, '2016-12-13 09:02:15', 1, 1, 0),
(21, 'werty', 'Tulips.jpg.vc3jODXe4fWmW9KGjEwiUpNuWPtHbuuT', 'Tulips.jpg', '2016-12-13 09:02:22', 1, '2016-12-13 09:02:22', 1, 1, 0),
(22, 'catalog', 'Tulips.jpg.vc3jODXe4fWmW9KGjEwiUpNuWPtHbuuT', 'Tulips.jpg', '2016-12-16 04:44:14', 18, '2016-12-16 04:44:14', 18, 1, 0),
(27, 'jug76', 'Tulips.jpg.vc3jODXe4fWmW9KGjEwiUpNuWPtHbuuT', 'Tulips.jpg', '2016-12-05 10:43:05', 1, '2016-12-05 10:43:05', 1, 1, 1),
(28, 'rtet', 'gift-voucher-birthday.jpg.y2BmQo9P6e9Z8TabX0xnUOiAqojou9X9', 'gift-voucher-birthday.jpg', '2016-12-16 10:42:48', 1, '2016-12-16 10:42:48', 1, 1, 0),
(29, 'rer', 'gift-voucher-birthday.jpg.pjgaDSpi6GaRFMMnuj2OO0uMHUQcIiAB', 'gift-voucher-birthday.jpg', '2016-12-16 04:18:01', 18, '2016-12-16 04:18:01', 18, 1, 0),
(30, 'rer', 'gift-voucher-birthday.jpg.LmmzFDCP0nHEF0zGLyvuaUbIhabN7pQW', 'gift-voucher-birthday.jpg', '2016-12-16 04:48:35', 18, '2016-12-16 04:48:35', 18, 1, 0),
(31, '3212', 'dataoperator.jpg.kWw56SP0p0FVQxVnXsHs8etr4aqvT8gd', 'dataoperator.jpg', '2016-12-19 06:00:11', 1, '2016-12-19 06:00:11', 1, 1, 0),
(32, 'fghgfyhgf', 'Christmas Time.jpg.kLGlu3MMrh3j4eFhpgThusoNofA7NCVy', 'gfhygfygf', '2016-12-17 01:12:07', 18, '2016-12-17 01:12:07', 18, 1, 0),
(34, 'bbbb', '1.txt.QjgRBvlqaF5ig3kHQWBC0rFungbiTcaC', '1.txt', '2016-12-20 07:19:03', 1, '2016-12-20 07:19:03', 1, 1, 0),
(35, 'green-printed-anarkali-knee-length-cotton-kurti-with-3-slash-4th-sleeves-product.jpg', 'download/files/download1/green-printed-anarkali-knee-length-cotton-kurti-with-3-slash-4th-sleeves-product.jpg.f843a80b48c66b34f09da3d40c3b5ffa', 'download/files/download1/green-printed-anarkali-knee-length-cotton-kurti-with-3-slash-4th-sleeves-product.jpg', '2017-01-24 12:28:59', 0, '0000-00-00 00:00:00', 0, 1, 0),
(36, 'stylish-georgette-patch-border-work-designer-saree-29822.jpg', 'download/files/download1/stylish-georgette-patch-border-work-designer-saree-29822.jpg.a53cd291887ee368fb387a370864f78f', 'download/files/download1/stylish-georgette-patch-border-work-designer-saree-29822.jpg', '2017-01-24 12:29:13', 0, '0000-00-00 00:00:00', 0, 1, 0),
(37, 'haute-georgette-blue-resham-work-designer-suit-29832.jpg', 'download/files/download1/haute-georgette-blue-resham-work-designer-suit-29832.jpg.6f232104f8defb98d4ac5745523d123a', 'download/files/download1/haute-georgette-blue-resham-work-designer-suit-29832.jpg', '2017-01-24 12:29:21', 0, '0000-00-00 00:00:00', 0, 1, 0),
(38, 'radiant-resham-work-beige-a-line-lehenga-choli-29843.jpg', 'download/files/download1/radiant-resham-work-beige-a-line-lehenga-choli-29843.jpg.4d98d1f4dafb5fae37f2b7b83392784c', 'download/files/download1/radiant-resham-work-beige-a-line-lehenga-choli-29843.jpg', '2017-01-24 12:29:30', 0, '0000-00-00 00:00:00', 0, 1, 0),
(39, 'dazzling-embroidered-work-anarkali-salwar-kameez-29463.jpg', 'download/files/download1/dazzling-embroidered-work-anarkali-salwar-kameez-29463.jpg.f65564a869297b41d1a2cdc820414988', 'download/files/download1/dazzling-embroidered-work-anarkali-salwar-kameez-29463.jpg', '2017-01-24 12:29:36', 0, '0000-00-00 00:00:00', 0, 1, 0),
(40, 'Ashika-Designer-Tussar-Silk-Saree-2769_1.jpg', 'download/files/download1/Ashika-Designer-Tussar-Silk-Saree-2769_1.jpg.a42055784fe6eabb6060ba32c014ac01', 'download/files/download1/Ashika-Designer-Tussar-Silk-Saree-2769_1.jpg', '2017-01-24 12:29:39', 0, '0000-00-00 00:00:00', 0, 1, 0),
(41, 'Ashika-Designer-Embroidered-Cotton-Dress-Material-TANVI-B_1.jpg', 'download/files/download1/Ashika-Designer-Embroidered-Cotton-Dress-Material-TANVI-B_1.jpg.610ba0554c974eda4eb0d024e31b00db', 'download/files/download1/Ashika-Designer-Embroidered-Cotton-Dress-Material-TANVI-B_1.jpg', '2017-01-24 12:29:44', 0, '0000-00-00 00:00:00', 0, 1, 0),
(42, 'Ashika-Designer-Oxford-Blue,-Pink-color-and-Velvet-409_1.jpg', 'download/files/download1/Ashika-Designer-Oxford-Blue,-Pink-color-and-Velvet-409_1.jpg.9700bef2aecf1293a4a220478a5c666d', 'download/files/download1/Ashika-Designer-Oxford-Blue,-Pink-color-and-Velvet-409_1.jpg', '2017-01-24 12:29:47', 0, '0000-00-00 00:00:00', 0, 1, 0),
(43, 'CV-MSARE38154087750--saree_sansar-Craftsvilla_1.jpg', 'download/files/download1/CV-MSARE38154087750--saree_sansar-Craftsvilla_1.jpg.6eae13278ad795cc4002ec81c570d55f', 'download/files/download1/CV-MSARE38154087750--saree_sansar-Craftsvilla_1.jpg', '2017-01-24 12:29:53', 0, '0000-00-00 00:00:00', 0, 1, 0),
(44, 'CV-MTHAN85824555570--Thankar-Craftsvilla_1.jpg', 'download/files/download1/CV-MTHAN85824555570--Thankar-Craftsvilla_1.jpg.e55f1a34a9e48e9290ceee689666b984', 'download/files/download1/CV-MTHAN85824555570--Thankar-Craftsvilla_1.jpg', '2017-01-24 12:30:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(45, 'hypnotizing-georgette-designer-saree-29764.jpg', 'download/files/download1/hypnotizing-georgette-designer-saree-29764.jpg.9d646cfec90c208ad967aec230990663', 'download/files/download1/hypnotizing-georgette-designer-saree-29764.jpg', '2017-01-24 12:30:07', 0, '0000-00-00 00:00:00', 0, 1, 0),
(46, 'aspiring-red-embroidered-work-jacquard-designer-saree-29602.jpg', 'download/files/download1/aspiring-red-embroidered-work-jacquard-designer-saree-29602.jpg.e84e53dbb8d1d6dc5f2ce47fcfe54e7a', 'download/files/download1/aspiring-red-embroidered-work-jacquard-designer-saree-29602.jpg', '2017-01-24 12:30:15', 0, '0000-00-00 00:00:00', 0, 1, 0),
(47, 'talismanic-net-beige-a-line-lehenga-choli-29320.jpg', 'download/files/download1/talismanic-net-beige-a-line-lehenga-choli-29320.jpg.34f039834bfd3ac3f4363fd5988e88c3', 'download/files/download1/talismanic-net-beige-a-line-lehenga-choli-29320.jpg', '2017-01-24 12:30:36', 0, '0000-00-00 00:00:00', 0, 1, 0),
(48, 'dazzling-multi-colour-lehenga-saree-29604.jpg', 'download/files/download1/dazzling-multi-colour-lehenga-saree-29604.jpg.39533554e33639e85fc0202c8284cee1', 'download/files/download1/dazzling-multi-colour-lehenga-saree-29604.jpg', '2017-01-24 12:30:41', 0, '0000-00-00 00:00:00', 0, 1, 0),
(49, 'green-printed-anarkali-knee-length-cotton-kurti-with-3-slash-4th-sleeves-product.jpg', 'download/files/testdownloadproduct1/green-printed-anarkali-knee-length-cotton-kurti-with-3-slash-4th-sleeves-product.jpg.801f0421f9545050188775e538587a68', 'download/files/testdownloadproduct1/green-printed-anarkali-knee-length-cotton-kurti-with-3-slash-4th-sleeves-product.jpg', '2017-01-24 12:35:24', 0, '0000-00-00 00:00:00', 0, 1, 0),
(50, 'stylish-georgette-patch-border-work-designer-saree-29822.jpg', 'download/files/testdownloadproduct1/stylish-georgette-patch-border-work-designer-saree-29822.jpg.5f426c17c475994fe796bb4801d6c027', 'download/files/testdownloadproduct1/stylish-georgette-patch-border-work-designer-saree-29822.jpg', '2017-01-24 12:35:26', 0, '0000-00-00 00:00:00', 0, 1, 0),
(51, 'haute-georgette-blue-resham-work-designer-suit-29832.jpg', 'download/files/testdownloadproduct1/haute-georgette-blue-resham-work-designer-suit-29832.jpg.48aa223f58e7b91c221f4c1495a7ce55', 'download/files/testdownloadproduct1/haute-georgette-blue-resham-work-designer-suit-29832.jpg', '2017-01-24 12:35:26', 0, '0000-00-00 00:00:00', 0, 1, 0),
(52, 'radiant-resham-work-beige-a-line-lehenga-choli-29843.jpg', 'download/files/testdownloadproduct1/radiant-resham-work-beige-a-line-lehenga-choli-29843.jpg.9fb40b5c3e23d4bdd763a39617e4a2da', 'download/files/testdownloadproduct1/radiant-resham-work-beige-a-line-lehenga-choli-29843.jpg', '2017-01-24 12:35:27', 0, '0000-00-00 00:00:00', 0, 1, 0),
(53, 'dazzling-embroidered-work-anarkali-salwar-kameez-29463.jpg', 'download/files/testdownloadproduct1/dazzling-embroidered-work-anarkali-salwar-kameez-29463.jpg.23c88ffb132abb2234120db665a842d5', 'download/files/testdownloadproduct1/dazzling-embroidered-work-anarkali-salwar-kameez-29463.jpg', '2017-01-24 12:35:28', 0, '0000-00-00 00:00:00', 0, 1, 0),
(54, 'Ashika-Designer-Tussar-Silk-Saree-2769_1.jpg', 'download/files/testdownloadproduct1/Ashika-Designer-Tussar-Silk-Saree-2769_1.jpg.165094502cbf32906db0b05457fc1313', 'download/files/testdownloadproduct1/Ashika-Designer-Tussar-Silk-Saree-2769_1.jpg', '2017-01-24 12:35:30', 0, '0000-00-00 00:00:00', 0, 1, 0),
(55, 'Ashika-Designer-Embroidered-Cotton-Dress-Material-TANVI-B_1.jpg', 'download/files/testdownloadproduct1/Ashika-Designer-Embroidered-Cotton-Dress-Material-TANVI-B_1.jpg.8cb185ba43e0a28e990fd8b6ba59e7cb', 'download/files/testdownloadproduct1/Ashika-Designer-Embroidered-Cotton-Dress-Material-TANVI-B_1.jpg', '2017-01-24 12:35:34', 0, '0000-00-00 00:00:00', 0, 1, 0),
(56, 'Ashika-Designer-Oxford-Blue,-Pink-color-and-Velvet-409_1.jpg', 'download/files/testdownloadproduct1/Ashika-Designer-Oxford-Blue,-Pink-color-and-Velvet-409_1.jpg.cc052aefc17165b871230778aad7f585', 'download/files/testdownloadproduct1/Ashika-Designer-Oxford-Blue,-Pink-color-and-Velvet-409_1.jpg', '2017-01-24 12:35:38', 0, '0000-00-00 00:00:00', 0, 1, 0),
(57, 'CV-MSARE38154087750--saree_sansar-Craftsvilla_1.jpg', 'download/files/testdownloadproduct1/CV-MSARE38154087750--saree_sansar-Craftsvilla_1.jpg.456593d7d40dd6426df1dc7cde45a937', 'download/files/testdownloadproduct1/CV-MSARE38154087750--saree_sansar-Craftsvilla_1.jpg', '2017-01-24 12:35:41', 0, '0000-00-00 00:00:00', 0, 1, 0),
(58, 'CV-MTHAN85824555570--Thankar-Craftsvilla_1.jpg', 'download/files/testdownloadproduct1/CV-MTHAN85824555570--Thankar-Craftsvilla_1.jpg.873494ad37ccc6d136a46cf985bd8532', 'download/files/testdownloadproduct1/CV-MTHAN85824555570--Thankar-Craftsvilla_1.jpg', '2017-01-24 12:35:42', 0, '0000-00-00 00:00:00', 0, 1, 0),
(59, 'hypnotizing-georgette-designer-saree-29764.jpg', 'download/files/testdownloadproduct1/hypnotizing-georgette-designer-saree-29764.jpg.c17e5e55d892b354a57326d1bc5aaf7e', 'download/files/testdownloadproduct1/hypnotizing-georgette-designer-saree-29764.jpg', '2017-01-24 12:35:42', 0, '0000-00-00 00:00:00', 0, 1, 0),
(60, 'aspiring-red-embroidered-work-jacquard-designer-saree-29602.jpg', 'download/files/testdownloadproduct1/aspiring-red-embroidered-work-jacquard-designer-saree-29602.jpg.395b7d70251d6c9bff3adcbfefc1539c', 'download/files/testdownloadproduct1/aspiring-red-embroidered-work-jacquard-designer-saree-29602.jpg', '2017-01-24 12:35:43', 0, '0000-00-00 00:00:00', 0, 1, 0),
(61, 'talismanic-net-beige-a-line-lehenga-choli-29320.jpg', 'download/files/testdownloadproduct1/talismanic-net-beige-a-line-lehenga-choli-29320.jpg.c01f1e2227623a81a3512e2d84479517', 'download/files/testdownloadproduct1/talismanic-net-beige-a-line-lehenga-choli-29320.jpg', '2017-01-24 12:35:43', 0, '0000-00-00 00:00:00', 0, 1, 0),
(62, 'dazzling-multi-colour-lehenga-saree-29604.jpg', 'download/files/testdownloadproduct1/dazzling-multi-colour-lehenga-saree-29604.jpg.e2d407e00989b14191435de3201d889e', 'download/files/testdownloadproduct1/dazzling-multi-colour-lehenga-saree-29604.jpg', '2017-01-24 12:35:44', 0, '0000-00-00 00:00:00', 0, 1, 0),
(63, 'green-printed-anarkali-knee-length-cotton-kurti-with-3-slash-4th-sleeves-product.jpg', 'download/files/green-printed-anarkali-knee-length-cotton-kurti-with-3-slash-4th-sleeves-product.jpg.37d00f106681154dbc2b333a323e343d', 'download/files/green-printed-anarkali-knee-length-cotton-kurti-with-3-slash-4th-sleeves-product.jpg', '2017-01-24 12:40:47', 0, '0000-00-00 00:00:00', 0, 1, 0),
(64, 'stylish-georgette-patch-border-work-designer-saree-29822.jpg', 'download/files/stylish-georgette-patch-border-work-designer-saree-29822.jpg.0fce7ef566eb7fb7013f183893b27882', 'download/files/stylish-georgette-patch-border-work-designer-saree-29822.jpg', '2017-01-24 12:40:49', 0, '0000-00-00 00:00:00', 0, 1, 0),
(65, 'haute-georgette-blue-resham-work-designer-suit-29832.jpg', 'download/files/haute-georgette-blue-resham-work-designer-suit-29832.jpg.bda25344164eac6fef56f3eea225a5ad', 'download/files/haute-georgette-blue-resham-work-designer-suit-29832.jpg', '2017-01-24 12:40:53', 0, '0000-00-00 00:00:00', 0, 1, 0),
(66, 'radiant-resham-work-beige-a-line-lehenga-choli-29843.jpg', 'download/files/radiant-resham-work-beige-a-line-lehenga-choli-29843.jpg.ba9678fdccd3321ea41438d16678997e', 'download/files/radiant-resham-work-beige-a-line-lehenga-choli-29843.jpg', '2017-01-24 12:40:55', 0, '0000-00-00 00:00:00', 0, 1, 0),
(67, 'dazzling-embroidered-work-anarkali-salwar-kameez-29463.jpg', 'download/files/dazzling-embroidered-work-anarkali-salwar-kameez-29463.jpg.7719a3530f7d80d6b39fd5694d691fa6', 'download/files/dazzling-embroidered-work-anarkali-salwar-kameez-29463.jpg', '2017-01-24 12:40:56', 0, '0000-00-00 00:00:00', 0, 1, 0),
(68, 'Ashika-Designer-Tussar-Silk-Saree-2769_1.jpg', 'download/files/Ashika-Designer-Tussar-Silk-Saree-2769_1.jpg.daeb67df335443b256ef908e1e47d8fa', 'download/files/Ashika-Designer-Tussar-Silk-Saree-2769_1.jpg', '2017-01-24 12:40:58', 0, '0000-00-00 00:00:00', 0, 1, 0),
(69, 'Ashika-Designer-Embroidered-Cotton-Dress-Material-TANVI-B_1.jpg', 'download/files/Ashika-Designer-Embroidered-Cotton-Dress-Material-TANVI-B_1.jpg.29b10015a2ac0890659c1ed445fefee3', 'download/files/Ashika-Designer-Embroidered-Cotton-Dress-Material-TANVI-B_1.jpg', '2017-01-24 12:41:04', 0, '0000-00-00 00:00:00', 0, 1, 0),
(70, 'Ashika-Designer-Oxford-Blue,-Pink-color-and-Velvet-409_1.jpg', 'download/files/Ashika-Designer-Oxford-Blue,-Pink-color-and-Velvet-409_1.jpg.4819a0ac8345de7f2d5cdabe0de7af2b', 'download/files/Ashika-Designer-Oxford-Blue,-Pink-color-and-Velvet-409_1.jpg', '2017-01-24 12:41:08', 0, '0000-00-00 00:00:00', 0, 1, 0),
(71, 'CV-MSARE38154087750--saree_sansar-Craftsvilla_1.jpg', 'download/files/CV-MSARE38154087750--saree_sansar-Craftsvilla_1.jpg.139f21a7bb34d7314ba835dbca97f3e5', 'download/files/CV-MSARE38154087750--saree_sansar-Craftsvilla_1.jpg', '2017-01-24 12:41:12', 0, '0000-00-00 00:00:00', 0, 1, 0),
(72, 'CV-MTHAN85824555570--Thankar-Craftsvilla_1.jpg', 'download/files/CV-MTHAN85824555570--Thankar-Craftsvilla_1.jpg.00fd17482bf942bf81009fa96db7fb74', 'download/files/CV-MTHAN85824555570--Thankar-Craftsvilla_1.jpg', '2017-01-24 12:41:13', 0, '0000-00-00 00:00:00', 0, 1, 0),
(73, 'hypnotizing-georgette-designer-saree-29764.jpg', 'download/files/hypnotizing-georgette-designer-saree-29764.jpg.e36e79b23d1c689693cafcac5e1521fe', 'download/files/hypnotizing-georgette-designer-saree-29764.jpg', '2017-01-24 12:41:13', 0, '0000-00-00 00:00:00', 0, 1, 0),
(74, 'aspiring-red-embroidered-work-jacquard-designer-saree-29602.jpg', 'download/files/aspiring-red-embroidered-work-jacquard-designer-saree-29602.jpg.8cd3192da048baa18ad1bfed166a6f07', 'download/files/aspiring-red-embroidered-work-jacquard-designer-saree-29602.jpg', '2017-01-24 12:41:13', 0, '0000-00-00 00:00:00', 0, 1, 0),
(75, 'talismanic-net-beige-a-line-lehenga-choli-29320.jpg', 'download/files/talismanic-net-beige-a-line-lehenga-choli-29320.jpg.d3bbf1d8373b95fae2b154fae549ba14', 'download/files/talismanic-net-beige-a-line-lehenga-choli-29320.jpg', '2017-01-24 12:41:17', 0, '0000-00-00 00:00:00', 0, 1, 0),
(76, 'dazzling-multi-colour-lehenga-saree-29604.jpg', 'download/files/dazzling-multi-colour-lehenga-saree-29604.jpg.bea1c3f90eb60e273183fb7daea1f02b', 'download/files/dazzling-multi-colour-lehenga-saree-29604.jpg', '2017-01-24 12:41:17', 0, '0000-00-00 00:00:00', 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `email_template`
--

CREATE TABLE IF NOT EXISTS `email_template` (
  `template_id` int(11) NOT NULL,
  `template_code` varchar(255) NOT NULL,
  `template_name` varchar(255) NOT NULL,
  `subject` text NOT NULL,
  `content` text NOT NULL,
  `default` text NOT NULL,
  `hint_value` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `email_template`
--

INSERT INTO `email_template` (`template_id`, `template_code`, `template_name`, `subject`, `content`, `default`, `hint_value`) VALUES
(1, 'user_signup', 'User Signup - Account Activation Link', 'Srapo.com, Account Activation Link', '<tr>    	<td style="font-family: Arial,Helvetica,sans-serif; font-size: 15px; text-align: center; font-weight: bold; color: #52555a; padding-left: 10px; padding-right: 10px" height="50" align="center">        Hello {{NAME}},        </td>    </tr>    <tr>    	<td style="font-family: Arial,Helvetica,sans-serif; color: #52555a; text-align: center; padding-left: 10px; padding-right: 10px; font-size: 15px">        In order to activate all benefits of your account on Srapo, verify your email now. Please click Below Button.        </td>    </tr>    <tr>    	<td style="line-height: 0px" height="25">        <br></td>    </tr>    <tr>    	<td align="center">        	<table style="font: normal 14px Arial, Roboto,Helvetica, sans-serif; color: #FFFFFF; text-align: center; margin: 5px; background: #ff2341; border-radius: 3px" width="140" align="center" border="0" cellpadding="0" cellspacing="0">               <tbody>            	<tr>                	<td align="center">                    	<a style="color: #FFFFFF; text-decoration: none; display: block; line-height: 35px; text-transform: uppercase; padding: 0 10px" href="{{ACTIVATION_LINK}}" onclick="return false" data-target="#login_model" data-toggle="modal" rel="noreferrer"><strong>Verify Email</strong></a>                    </td>                 </tr>           </tbody>           </table>       </td> 	</tr>', '<tr>\r\n    	<td align="center" height="50" style="font-family: Arial,Helvetica,sans-serif; font-size: 15px; text-align: center; font-weight: bold; color: #52555a; padding-left: 10px; padding-right: 10px">\r\n        Hello {{NAME}},\r\n        </td>\r\n    </tr>\r\n\r\n    <tr>\r\n    	<td style="font-family: Arial,Helvetica,sans-serif; color: #52555a; text-align: center; padding-left: 10px; padding-right: 10px; font-size: 15px">\r\n        In order to activate all benefits of your account on Srapo, verify your email now. Please click Below Button.\r\n        </td>\r\n    </tr>\r\n    <tr>\r\n    	<td height="25" style="line-height: 0px">\r\n        </td>\r\n    </tr>\r\n    <tr>\r\n    	<td align="center">\r\n        	<table width="140" border="0" cellspacing="0" cellpadding="0" style="font: normal 14px Arial, Roboto,Helvetica, sans-serif; color: #FFFFFF; text-align: center; margin: 5px; background: #ff2341; border-radius: 3px" align="center">   \r\n            <tbody>\r\n            	<tr>\r\n                	<td align="center">\r\n                    	<a style="color: #FFFFFF; text-decoration: none; display: block; line-height: 35px; text-transform: uppercase; padding: 0 10px" href="{{ACTIVATION_LINK}}" onclick="return false" rel="noreferrer"><strong>Verify Email</strong></a>\r\n                    </td>\r\n                 </tr>\r\n           </tbody>\r\n           </table>\r\n       </td> \r\n	</tr>', '{{NAME}}$Vinay Ghael$Recipient Name\r\n|\r\n{{ACTIVATION_LINK}}$#$Account Activation Link'),
(2, 'manufacturer_signup', 'Manufacturer Signup - Account Activation Link', 'Srapo.com, Account Activation Link', '<tr>\r\n    	<td style="font-family: Arial,Helvetica,sans-serif; font-size: 15px; text-align: center; font-weight: bold; color: #52555a; padding-left: 10px; padding-right: 10px" height="50" align="center">\r\n        Hello {{NAME}},\r\n        </td>\r\n    </tr>\r\n\r\n    <tr>\r\n    	<td style="font-family: Arial,Helvetica,sans-serif; color: #52555a; text-align: center; padding-left: 10px; padding-right: 10px; font-size: 15px">\r\n        In order to activate all benefits of your account on Srapo, verify your email now. Please click Below Button.\r\n        </td>\r\n    </tr>\r\n    <tr>\r\n    	<td style="line-height: 0px" height="25">\r\n        <br></td>\r\n    </tr>\r\n    <tr>\r\n    	<td align="center">\r\n        	<table style="font: normal 14px Arial, Roboto,Helvetica, sans-serif; color: #FFFFFF; text-align: center; margin: 5px; background: #ff2341; border-radius: 3px" width="140" cellspacing="0" cellpadding="0" border="0" align="center">   \r\n            <tbody>\r\n            	<tr>\r\n                	<td align="center">\r\n                    	<a style="color: #FFFFFF; text-decoration: none; display: block; line-height: 35px; text-transform: uppercase; padding: 0 10px" href="{{ACTIVATION_LINK}}" onclick="return false" rel="noreferrer"><strong>Verify Email</strong></a>\r\n                    </td>\r\n                 </tr>\r\n           </tbody>\r\n           </table>\r\n       </td> \r\n	</tr>', '<tr>\r\n    	<td align="center" height="50" style="font-family: Arial,Helvetica,sans-serif; font-size: 15px; text-align: center; font-weight: bold; color: #52555a; padding-left: 10px; padding-right: 10px">\r\n        Hello {{NAME}},\r\n        </td>\r\n    </tr>\r\n\r\n    <tr>\r\n    	<td style="font-family: Arial,Helvetica,sans-serif; color: #52555a; text-align: center; padding-left: 10px; padding-right: 10px; font-size: 15px">\r\n        In order to activate all benefits of your account on Srapo, verify your email now. Please click Below Button.\r\n        </td>\r\n    </tr>\r\n    <tr>\r\n    	<td height="25" style="line-height: 0px">\r\n        </td>\r\n    </tr>\r\n    <tr>\r\n    	<td align="center">\r\n        	<table width="140" border="0" cellspacing="0" cellpadding="0" style="font: normal 14px Arial, Roboto,Helvetica, sans-serif; color: #FFFFFF; text-align: center; margin: 5px; background: #ff2341; border-radius: 3px" align="center">   \r\n            <tbody>\r\n            	<tr>\r\n                	<td align="center">\r\n                    	<a style="color: #FFFFFF; text-decoration: none; display: block; line-height: 35px; text-transform: uppercase; padding: 0 10px" href="{{ACTIVATION_LINK}}" onclick="return false" rel="noreferrer"><strong>Verify Email</strong></a>\r\n                    </td>\r\n                 </tr>\r\n           </tbody>\r\n           </table>\r\n       </td> \r\n	</tr>', '{{NAME}}$Vinay Ghael$Recipient Name\r\n|\r\n{{ACTIVATION_LINK}}$#$Account Activation Link'),
(3, 'user_create_by_admin', 'User Account Create By Admin', 'Srapo.com, User Account Created', '<tr>\r\n    	<td style="font-family: Arial,Helvetica,sans-serif; font-size: 15px; text-align: center; font-weight: bold; color: #52555a; padding-left: 10px; padding-right: 10px" height="50" align="center">\r\n        Hello {{NAME}},\r\n        </td>\r\n    </tr>\r\n    <tr>\r\n    	<td style="font-family: Arial,Helvetica,sans-serif; color: #52555a; text-align: center; padding-left: 10px; padding-right: 10px; font-size: 15px">\r\n        We have created a User account for you, please be login  in to your account by using the below account details and fillup the profile details.\r\n        </td>\r\n    </tr>\r\n    <tr>\r\n    	<td style="line-height: 0px" height="25">\r\n        <br></td>\r\n    </tr>\r\n    <tr>\r\n    	<td align="center">\r\n        	<table>   \r\n            <tbody>\r\n            	<tr>\r\n                	<td align="center">\r\n                    	User ID :&nbsp;<span style="color: rgb(0, 0, 255);">{{USER_ID}}</span><br>\r\n						Password :&nbsp;<span style="color: rgb(0, 0, 255);">{{PASSWORD}}</span>\r\n                    </td>\r\n                 </tr>\r\n           </tbody>\r\n           </table>\r\n       </td> \r\n	</tr>\r\n    \r\n    <tr>\r\n         <td height="30"><br></td>\r\n    </tr>\r\n    <tr>\r\n         <td align="center"><br></td>\r\n    </tr>\r\n    <tr>\r\n         <td style="line-height: 0px" height="1">\r\n             \r\n         <br></td>\r\n    </tr>\r\n    <tr>\r\n         <td height="10"><br></td>\r\n    </tr>\r\n    \r\n    <tr>\r\n         <td height="20"><br></td>\r\n    </tr>\r\n    \r\n	', '<tr>\r\n    	<td align="center" height="50" style="font-family: Arial,Helvetica,sans-serif; font-size: 15px; text-align: center; font-weight: bold; color: #52555a; padding-left: 10px; padding-right: 10px">\r\n        Hello {{NAME}},\r\n        </td>\r\n    </tr>\r\n    <tr>\r\n    	<td style="font-family: Arial,Helvetica,sans-serif; color: #52555a; text-align: center; padding-left: 10px; padding-right: 10px; font-size: 15px">\r\n        We have created a User account for you, please be login  in to your account by using the below account details and fillup the profile details.\r\n        </td>\r\n    </tr>\r\n    <tr>\r\n    	<td height="25" style="line-height: 0px">\r\n        </td>\r\n    </tr>\r\n    <tr>\r\n    	<td align="center">\r\n        	<table>   \r\n            <tbody>\r\n            	<tr>\r\n                	<td align="center">\r\n                    	User ID :&nbsp;<span style="color: rgb(0, 0, 255);">{{USER_ID}}</span><br>\r\n						Password :&nbsp;<span style="color: rgb(0, 0, 255);">{{PASSWORD}}</span>\r\n                    </td>\r\n                 </tr>\r\n           </tbody>\r\n           </table>\r\n       </td> \r\n	</tr>\r\n    \r\n    <tr>\r\n         <td height="30"></td>\r\n    </tr>\r\n    <tr>\r\n         <td align="center"></td>\r\n    </tr>\r\n    <tr>\r\n         <td height="1" style="line-height: 0px">\r\n             \r\n         </td>\r\n    </tr>\r\n    <tr>\r\n         <td height="10"></td>\r\n    </tr>\r\n    \r\n    <tr>\r\n         <td height="20"></td>\r\n    </tr>\r\n    \r\n	', '{{NAME}}$Vinay Ghael$Recipient Name\r\n|\r\n{{USER_ID}}$user@example.com$User id for login\r\n|\r\n{{PASSWORD}}$123456$ Password for login'),
(4, 'customer_create_by_admin', 'Customer Account Create By Admin', 'Srapo.com, Customer Account Created.', '<tr>\r\n    	<td style="font-family: Arial,Helvetica,sans-serif; font-size: 15px; text-align: center; font-weight: bold; color: #52555a; padding-left: 10px; padding-right: 10px" height="50" align="center">\r\n        Hello {{NAME}},\r\n        </td>\r\n    </tr>\r\n    <tr>\r\n    	<td style="font-family: Arial,Helvetica,sans-serif; color: #52555a; text-align: center; padding-left: 10px; padding-right: 10px; font-size: 15px">\r\n        We have created a User account for you, please be login  in to your account by using the below account details and fill up the profile details.\r\n        </td>\r\n    </tr>\r\n    <tr>\r\n    	<td style="line-height: 0px" height="25">\r\n        <br></td>\r\n    </tr>\r\n    <tr>\r\n    	<td align="center">\r\n        	<table>   \r\n            <tbody>\r\n            	<tr>\r\n                	<td align="center">\r\n                    	User ID :&nbsp;<span style="color: rgb(0, 0, 255);">{{USER_ID}}</span><br>\r\n						Password :&nbsp;<span style="color: rgb(0, 0, 255);">{{PASSWORD}}</span>\r\n                    </td>\r\n                 </tr>\r\n           </tbody>\r\n           </table>\r\n       </td> \r\n	</tr>\r\n    \r\n    <tr>\r\n         <td height="30"><br></td>\r\n    </tr>\r\n    <tr>\r\n         <td align="center"><br></td>\r\n    </tr>\r\n    <tr>\r\n         <td style="line-height: 0px" height="1">\r\n             \r\n         <br></td>\r\n    </tr>\r\n    <tr>\r\n         <td height="10"><br></td>\r\n    </tr>\r\n    \r\n    <tr>\r\n         <td height="20"><br></td>\r\n    </tr>\r\n    ', '<tr>\r\n    	<td align="center" height="50" style="font-family: Arial,Helvetica,sans-serif; font-size: 15px; text-align: center; font-weight: bold; color: #52555a; padding-left: 10px; padding-right: 10px">\r\n        Hello {{NAME}},\r\n        </td>\r\n    </tr>\r\n    <tr>\r\n    	<td style="font-family: Arial,Helvetica,sans-serif; color: #52555a; text-align: center; padding-left: 10px; padding-right: 10px; font-size: 15px">\r\n        We have created a User account for you, please be login  in to your account by using the below account details and fillup the profile details.\r\n        </td>\r\n    </tr>\r\n    <tr>\r\n    	<td height="25" style="line-height: 0px">\r\n        </td>\r\n    </tr>\r\n    <tr>\r\n    	<td align="center">\r\n        	<table>   \r\n            <tbody>\r\n            	<tr>\r\n                	<td align="center">\r\n                    	User ID :&nbsp;<span style="color: rgb(0, 0, 255);">{{USER_ID}}</span><br>\r\n						Password :&nbsp;<span style="color: rgb(0, 0, 255);">{{PASSWORD}}</span>\r\n                    </td>\r\n                 </tr>\r\n           </tbody>\r\n           </table>\r\n       </td> \r\n	</tr>\r\n    \r\n    <tr>\r\n         <td height="30"></td>\r\n    </tr>\r\n    <tr>\r\n         <td align="center"></td>\r\n    </tr>\r\n    <tr>\r\n         <td height="1" style="line-height: 0px">\r\n             \r\n         </td>\r\n    </tr>\r\n    <tr>\r\n         <td height="10"></td>\r\n    </tr>\r\n    \r\n    <tr>\r\n         <td height="20"></td>\r\n    </tr>\r\n    ', '{{NAME}}$Vinay Ghael$Recipient Name\r\n|\r\n{{USER_ID}}$user@example.com$User id for login\r\n|\r\n{{PASSWORD}}$123456$ Password for login'),
(5, 'manufacturer_create_by_admin', 'Manufacturer Account Create By Admin', 'Srapo.com, Manufacturer Account Created', '<tr>\r\n    	<td align="center" height="50" style="font-family: Arial,Helvetica,sans-serif; font-size: 15px; text-align: center; font-weight: bold; color: #52555a; padding-left: 10px; padding-right: 10px">\r\n        Hello {{NAME}},\r\n        </td>\r\n    </tr>\r\n    <tr>\r\n    	<td style="font-family: Arial,Helvetica,sans-serif; color: #52555a; text-align: center; padding-left: 10px; padding-right: 10px; font-size: 15px">\r\n        We have created a User account for you, please be login  in to your account by using the below account details and fillup the profile details.\r\n        </td>\r\n    </tr>\r\n    <tr>\r\n    	<td height="25" style="line-height: 0px">\r\n        </td>\r\n    </tr>\r\n    <tr>\r\n    	<td align="center">\r\n        	<table>   \r\n            <tbody>\r\n            	<tr>\r\n                	<td align="center">\r\n                    	User ID :&nbsp;<span style="color: rgb(0, 0, 255);">{{USER_ID}}</span><br>\r\n						Password :&nbsp;<span style="color: rgb(0, 0, 255);">{{PASSWORD}}</span>\r\n                    </td>\r\n                 </tr>\r\n           </tbody>\r\n           </table>\r\n       </td> \r\n	</tr>\r\n    \r\n    <tr>\r\n         <td height="30"></td>\r\n    </tr>\r\n    <tr>\r\n         <td align="center"></td>\r\n    </tr>\r\n    <tr>\r\n         <td height="1" style="line-height: 0px">\r\n             \r\n         </td>\r\n    </tr>\r\n    <tr>\r\n         <td height="10"></td>\r\n    </tr>\r\n    \r\n    <tr>\r\n         <td height="20"></td>\r\n    </tr>\r\n    \r\n	', '<tr>\r\n    	<td align="center" height="50" style="font-family: Arial,Helvetica,sans-serif; font-size: 15px; text-align: center; font-weight: bold; color: #52555a; padding-left: 10px; padding-right: 10px">\r\n        Hello {{NAME}},\r\n        </td>\r\n    </tr>\r\n    <tr>\r\n    	<td style="font-family: Arial,Helvetica,sans-serif; color: #52555a; text-align: center; padding-left: 10px; padding-right: 10px; font-size: 15px">\r\n        We have created a User account for you, please be login  in to your account by using the below account details and fillup the profile details.\r\n        </td>\r\n    </tr>\r\n    <tr>\r\n    	<td height="25" style="line-height: 0px">\r\n        </td>\r\n    </tr>\r\n    <tr>\r\n    	<td align="center">\r\n        	<table>   \r\n            <tbody>\r\n            	<tr>\r\n                	<td align="center">\r\n                    	User ID :&nbsp;<span style="color: rgb(0, 0, 255);">{{USER_ID}}</span><br>\r\n						Password :&nbsp;<span style="color: rgb(0, 0, 255);">{{PASSWORD}}</span>\r\n                    </td>\r\n                 </tr>\r\n           </tbody>\r\n           </table>\r\n       </td> \r\n	</tr>\r\n    \r\n    <tr>\r\n         <td height="30"></td>\r\n    </tr>\r\n    <tr>\r\n         <td align="center"></td>\r\n    </tr>\r\n    <tr>\r\n         <td height="1" style="line-height: 0px">\r\n             \r\n         </td>\r\n    </tr>\r\n    <tr>\r\n         <td height="10"></td>\r\n    </tr>\r\n    \r\n    <tr>\r\n         <td height="20"></td>\r\n    </tr>\r\n    \r\n	', '{{NAME}}$Vinay Ghael$Recipient Name\r\n|\r\n{{USER_ID}}$user@example.com$User id for login\r\n|\r\n{{PASSWORD}}$123456$ Password for login'),
(6, 'forgot_password', 'Forgot Password', 'Srapo.com, Forgot password Request', '<tr>\r\n    	<td style="font-family: Arial,Helvetica,sans-serif; font-size: 15px; text-align: center; font-weight: bold; color: #52555a; padding-left: 10px; padding-right: 10px" height="50" align="center">\r\n        Hello {{NAME}},\r\n        </td>\r\n    </tr>\r\n\r\n    <tr>\r\n    	<td style="font-family: Arial,Helvetica,sans-serif; color: #52555a; text-align: center; padding-left: 10px; padding-right: 10px; font-size: 15px">\r\n        We have received your forgot password request. if you didn''t place any request for password reset, please ignore this email. and if you really wants to reset a new password, click on password reset link.\r\n        </td>\r\n    </tr>\r\n    <tr>\r\n    	<td style="line-height: 0px" height="25">\r\n        <br></td>\r\n    </tr>\r\n	<tr>\r\n		<td align="center">\r\n			Password Reset Link :&nbsp;<span><a style="text-decoration: none; line-height: 35px; text-transform: uppercase; padding: 0 10px" href="{{RESET_LINK}}" onclick="return false" rel="noreferrer"><strong>{{RESET_LINK}}</strong></a></span>\r\n		</td>\r\n    </tr>\r\n	<tr>\r\n		<td align="center"><br></td>\r\n    </tr>\r\n	<tr>\r\n		<td align="center"><br></td>\r\n    </tr>', '<tr>\r\n    	<td align="center" height="50" style="font-family: Arial,Helvetica,sans-serif; font-size: 15px; text-align: center; font-weight: bold; color: #52555a; padding-left: 10px; padding-right: 10px">\r\n        Hello {{NAME}},\r\n        </td>\r\n    </tr>\r\n\r\n    <tr>\r\n    	<td style="font-family: Arial,Helvetica,sans-serif; color: #52555a; text-align: center; padding-left: 10px; padding-right: 10px; font-size: 15px">\r\n        We have received your forgot password request. if you didn''t place any request for password reset, please ignore this email. and if you realy wants to reset a new password, click on password reset link.\r\n        </td>\r\n    </tr>\r\n    <tr>\r\n    	<td height="25" style="line-height: 0px">\r\n        </td>\r\n    </tr>\r\n	<tr>\r\n		<td align="center">\r\n			Password Reset Link :&nbsp;<span><a style="text-decoration: none; line-height: 35px; text-transform: uppercase; padding: 0 10px" href="{{RESET_LINK}}" onclick="return false" rel="noreferrer"><strong>{{RESET_LINK}}</strong></a></span>\r\n		</td>\r\n    </tr>\r\n	<tr>\r\n		<td align="center">\r\n			<strong>- OR -</strong>\r\n		</td>\r\n    </tr>\r\n	<tr>\r\n		<td align="center">\r\n			Password Reset Code :&nbsp;<span><a style="text-decoration: none; line-height: 35px; text-transform: uppercase; padding: 0 10px" href="{{RESET_LINK}}" onclick="return false" rel="noreferrer"><strong>{{RESET_CODE}}</strong></a></span>\r\n		</td>\r\n    </tr>', '{{NAME}}$Mehul Patel$Recipient Name\r\n|\r\n{{RESET_CODE}}$32145$Password Reset Code\r\n|\r\n{{RESET_LINK}}$#$Password Reset Link'),
(7, 'password_changed', 'Password Changed', 'Srapo.com, Password Changed Successfully', '<tr>\r\n    	<td style="font-family: Arial,Helvetica,sans-serif; font-size: 15px; text-align: center; font-weight: bold; color: #52555a; padding-left: 10px; padding-right: 10px" height="50" align="center">\r\n        Hello {{NAME}},\r\n        </td>\r\n    </tr>\r\n\r\n    <tr>\r\n    	<td style="font-family: Arial,Helvetica,sans-serif; color: #52555a; text-align: center; padding-left: 10px; padding-right: 10px; font-size: 15px">\r\n       Your Password changed successfully, you may now login with your New password.\r\n        </td>\r\n    </tr>\r\n    <tr>\r\n    	<td style="line-height: 0px" height="25">\r\n        <br></td>\r\n    </tr>', '<tr>\r\n    	<td align="center" height="50" style="font-family: Arial,Helvetica,sans-serif; font-size: 15px; text-align: center; font-weight: bold; color: #52555a; padding-left: 10px; padding-right: 10px">\r\n        Hello {{NAME}},\r\n        </td>\r\n    </tr>\r\n\r\n    <tr>\r\n    	<td style="font-family: Arial,Helvetica,sans-serif; color: #52555a; text-align: center; padding-left: 10px; padding-right: 10px; font-size: 15px">\r\n       Your Password changed successfully, you may now login with your New password.\r\n        </td>\r\n    </tr>\r\n    <tr>\r\n    	<td height="25" style="line-height: 0px">\r\n        </td>\r\n    </tr>', '{{NAME}}$Mehul Patel$Recipient Name'),
(8, 'general_message_format', 'General Message Format', 'Srapo.com, << SUBJECT >>', '<tr>\r\n    	<td style="font-family: Arial,Helvetica,sans-serif; font-size: 15px; font-weight: bold; color: #52555a; padding-left: 10px; padding-right: 10px" height="50">\r\n        Hello {{NAME}},\r\n        </td>\r\n    </tr>\r\n    <tr>\r\n    	<td style="font-family: Arial,Helvetica,sans-serif; color: #52555a; padding-left: 10px; padding-right: 10px; font-size: 15px">\r\n        {{MESSAGE}}</td>\r\n    </tr>\r\n    <tr>\r\n    	<td style="line-height: 0px" height="25">\r\n        <br></td>\r\n    </tr>', '<tr>\r\n    	<td height="50" style="font-family: Arial,Helvetica,sans-serif; font-size: 15px; font-weight: bold; color: #52555a; padding-left: 10px; padding-right: 10px">\r\n        Hello {{NAME}},\r\n        </td>\r\n    </tr>\r\n    <tr>\r\n    	<td style="font-family: Arial,Helvetica,sans-serif; color: #52555a; padding-left: 10px; padding-right: 10px; font-size: 15px">\r\n        {{MESSAGE}}\r\n        </td>\r\n    </tr>\r\n    <tr>\r\n    	<td height="25" style="line-height: 0px">\r\n        </td>\r\n    </tr>', '{{NAME}}$Vinay Ghael$Recipient Name\r\n|\r\n{{MESSAGE}}$this is test email message from admin$Message Written by sender comes here.'),
(9, 'gift_voucher_receive', 'Gift Voucher Receive', 'Srapo.com, You have just receive gift voucher', '<tr>\r\n    	<td style="font-family: Arial,Helvetica,sans-serif; font-size: 15px; text-align: center; font-weight: bold; color: #52555a; padding-left: 10px; padding-right: 10px" height="50" align="center">\r\n        Hello {{RECEIVER-NAME}},\r\n        </td>\r\n    </tr>\r\n    <tr>\r\n    	<td style="font-family: Arial,Helvetica,sans-serif; color: #52555a; text-align: center; padding-left: 10px; padding-right: 10px; font-size: 15px" height="50">\r\n        You have just received gift voucher.\r\n        </td>\r\n    </tr>\r\n	<tr>\r\n    	<td style="font-family: Arial,Helvetica,sans-serif; color: #52555a; padding-left: 10px; padding-right: 10px; font-size: 15px" height="30">\r\n        <strong>From:</strong> {{SENDER-NAME}} [{{SENDER-EMAIL}}]\r\n        </td>\r\n    </tr>\r\n	<tr>\r\n		<td style="font-family: Arial,Helvetica,sans-serif; color: #52555a; padding-left: 10px; padding-right: 10px; font-size: 15px" height="30">\r\n        <strong>Amount:</strong> {{AMOUNT-WITH-CURRENCY}}\r\n        </td>\r\n	</tr>\r\n	<tr>\r\n		<td style="font-family: Arial,Helvetica,sans-serif; color: #52555a; padding-left: 10px; padding-right: 10px; font-size: 15px" height="30">\r\n        <strong>Voucher No:</strong> {{COUPAN-CODE}}\r\n        </td>\r\n	</tr>\r\n	<tr>\r\n		<td style="font-family: Arial,Helvetica,sans-serif; color: #52555a; padding-left: 10px; padding-right: 10px; font-size: 15px" height="30">\r\n        <strong>Message:</strong> {{MSG}}\r\n        </td>\r\n	</tr>\r\n    <tr>\r\n    	<td style="line-height: 0px" height="25">\r\n        <br></td>\r\n    </tr>\r\n    <tr>\r\n    	<td align="center">\r\n		Now you can buy any product from srapo.com.\r\n        	<table style="font: normal 14px Arial, Roboto,Helvetica, sans-serif; color: #FFFFFF; text-align: center; margin: 5px; background: #ff2341; border-radius: 3px" width="275" cellspacing="0" cellpadding="0" border="0" align="center">   \r\n            <tbody>\r\n            	<!--<tr>\r\n                	<td align="center">\r\n                    	<a style="color: #FFFFFF; text-decoration: none; display: block; line-height: 35px; text-transform: uppercase; padding: 0 10px" href="" onclick="return false" rel="noreferrer"><strong>Sign Up</strong></a>\r\n                    </td>\r\n					<td align="center">\r\n                    	<a style="color: #FFFFFF; text-decoration: none; display: block; line-height: 35px; text-transform: uppercase; padding: 0 10px" href="" onclick="return false" rel="noreferrer"><strong>Login</strong></a>\r\n                    </td>\r\n                 </tr>-->\r\n           </tbody>\r\n           </table>\r\n       </td> \r\n	</tr>', '<tr>\r\n    	<td align="center" height="50" style="font-family: Arial,Helvetica,sans-serif; font-size: 15px; text-align: center; font-weight: bold; color: #52555a; padding-left: 10px; padding-right: 10px">\r\n        Hello {{RECEIVER-NAME}},\r\n        </td>\r\n    </tr>\r\n    <tr>\r\n    	<td height="50" style="font-family: Arial,Helvetica,sans-serif; color: #52555a; text-align: center; padding-left: 10px; padding-right: 10px; font-size: 15px">\r\n        You have just received gift voucher.\r\n        </td>\r\n    </tr>\r\n	<tr>\r\n    	<td height="30" style="font-family: Arial,Helvetica,sans-serif; color: #52555a; padding-left: 10px; padding-right: 10px; font-size: 15px">\r\n        <strong>From:</strong> {{SENDER-NAME}} [{{SENDER-EMAIL}}]\r\n        </td>\r\n    </tr>\r\n	<tr>\r\n		<td height="30" style="font-family: Arial,Helvetica,sans-serif; color: #52555a; padding-left: 10px; padding-right: 10px; font-size: 15px">\r\n        <strong>Amount:</strong> {{AMOUNT-WITH-CURRENCY}}\r\n        </td>\r\n	</tr>\r\n	<tr>\r\n		<td height="30" style="font-family: Arial,Helvetica,sans-serif; color: #52555a; padding-left: 10px; padding-right: 10px; font-size: 15px">\r\n        <strong>Voucher No:</strong> {{COUPAN-CODE}}\r\n        </td>\r\n	</tr>\r\n	<tr>\r\n		<td height="30" style="font-family: Arial,Helvetica,sans-serif; color: #52555a; padding-left: 10px; padding-right: 10px; font-size: 15px">\r\n        <strong>Message:</strong> {{MSG}}\r\n        </td>\r\n	</tr>\r\n    <tr>\r\n    	<td height="25" style="line-height: 0px">\r\n        </td>\r\n    </tr>\r\n    <tr>\r\n    	<td align="center">\r\n		Now you can buy any product from srapo.com.\r\n        	<table width="275" border="0" cellspacing="0" cellpadding="0" style="font: normal 14px Arial, Roboto,Helvetica, sans-serif; color: #FFFFFF; text-align: center; margin: 5px; background: #ff2341; border-radius: 3px" align="center">   \r\n            <tbody>\r\n            	<!--<tr>\r\n                	<td align="center">\r\n                    	<a style="color: #FFFFFF; text-decoration: none; display: block; line-height: 35px; text-transform: uppercase; padding: 0 10px" href="" onclick="return false" rel="noreferrer"><strong>Sign Up</strong></a>\r\n                    </td>\r\n					<td align="center">\r\n                    	<a style="color: #FFFFFF; text-decoration: none; display: block; line-height: 35px; text-transform: uppercase; padding: 0 10px" href="" onclick="return false" rel="noreferrer"><strong>Login</strong></a>\r\n                    </td>\r\n                 </tr>-->\r\n           </tbody>\r\n           </table>\r\n       </td> \r\n	</tr>', '{{SENDER-NAME}}$Vinay Ghael$Sender Name\n|\n{{SENDER-EMAIL}}$vr@vpninfotech.com$Sender Email\n|\n{{RECEIVER-NAME}}$Manish Narola$Receiver Name\n|\n{{RECEIVER-EMAIL}}$mv@vpninfotech.com$Receiver Email\n|\n{{AMOUNT-WITH-CURRENCY}}$500USD$Amount With Currency\n|\n{{MSG}}$Happy Birthday$Greeting Message'),
(10, 'gift_voucher_order_placed', 'Gift Voucher Order Placed', 'Srapo.com, Your Gift Voucher Order Placed is Being Processed ', '<tr>\r\n    	<td align="center" height="50" style="font-family: Arial,Helvetica,sans-serif; font-size: 15px; text-align: center; font-weight: bold; color: #52555a; padding-left: 10px; padding-right: 10px">\r\n        Hello {{NAME}},\r\n        </td>\r\n    </tr>\r\n    <tr>\r\n    	<td height="50" style="font-family: Arial,Helvetica,sans-serif; color: #52555a; text-align: center; padding-left: 10px; padding-right: 10px; font-size: 15px">\r\n        Thank you for your order!\r\n        </td>\r\n    </tr>\r\n	<tr>\r\n    	<td height="50" style="font-family: Arial,Helvetica,sans-serif; color: #52555a; text-align: center; padding-left: 10px; padding-right: 10px; font-size: 15px">\r\n        Please see attachment for your order receipt.\r\n        </td>\r\n    </tr>\r\n	<tr>\r\n    	<td height="50" style="font-family: Arial,Helvetica,sans-serif; color: #52555a; text-align: center; padding-left: 10px; padding-right: 10px; font-size: 15px">\r\n        Thank You.\r\n        </td>\r\n    </tr>\r\n	\r\n    <tr>\r\n    	<td height="25" style="line-height: 0px">\r\n        </td>\r\n    </tr>\r\n    <tr>\r\n    	<td align="center">\r\n		\r\n        	<table width="275" border="0" cellspacing="0" cellpadding="0" style="font: normal 14px Arial, Roboto,Helvetica, sans-serif; color: #FFFFFF; text-align: center; margin: 5px; background: #ff2341; border-radius: 3px" align="center">   \r\n            <tbody>\r\n            	<!--<tr>\r\n                	<td align="center">\r\n                    	<a style="color: #FFFFFF; text-decoration: none; display: block; line-height: 35px; text-transform: uppercase; padding: 0 10px" href="" onclick="return false" rel="noreferrer"><strong>Sign Up</strong></a>\r\n                    </td>\r\n					<td align="center">\r\n                    	<a style="color: #FFFFFF; text-decoration: none; display: block; line-height: 35px; text-transform: uppercase; padding: 0 10px" href="" onclick="return false" rel="noreferrer"><strong>Login</strong></a>\r\n                    </td>\r\n                 </tr>-->\r\n           </tbody>\r\n           </table>\r\n       </td> \r\n	</tr>', '<tr>\r\n    	<td align="center" height="50" style="font-family: Arial,Helvetica,sans-serif; font-size: 15px; text-align: center; font-weight: bold; color: #52555a; padding-left: 10px; padding-right: 10px">\r\n        Hello {{NAME}},\r\n        </td>\r\n    </tr>\r\n    <tr>\r\n    	<td height="50" style="font-family: Arial,Helvetica,sans-serif; color: #52555a; text-align: center; padding-left: 10px; padding-right: 10px; font-size: 15px">\r\n        Thank you for your order!\r\n        </td>\r\n    </tr>\r\n	<tr>\r\n    	<td height="50" style="font-family: Arial,Helvetica,sans-serif; color: #52555a; text-align: center; padding-left: 10px; padding-right: 10px; font-size: 15px">\r\n        Please see attachment for your order receipt.\r\n        </td>\r\n    </tr>\r\n	<tr>\r\n    	<td height="50" style="font-family: Arial,Helvetica,sans-serif; color: #52555a; text-align: center; padding-left: 10px; padding-right: 10px; font-size: 15px">\r\n        Thank You.\r\n        </td>\r\n    </tr>\r\n	\r\n    <tr>\r\n    	<td height="25" style="line-height: 0px">\r\n        </td>\r\n    </tr>\r\n    <tr>\r\n    	<td align="center">\r\n		\r\n        	<table width="275" border="0" cellspacing="0" cellpadding="0" style="font: normal 14px Arial, Roboto,Helvetica, sans-serif; color: #FFFFFF; text-align: center; margin: 5px; background: #ff2341; border-radius: 3px" align="center">   \r\n            <tbody>\r\n            	<!--<tr>\r\n                	<td align="center">\r\n                    	<a style="color: #FFFFFF; text-decoration: none; display: block; line-height: 35px; text-transform: uppercase; padding: 0 10px" href="" onclick="return false" rel="noreferrer"><strong>Sign Up</strong></a>\r\n                    </td>\r\n					<td align="center">\r\n                    	<a style="color: #FFFFFF; text-decoration: none; display: block; line-height: 35px; text-transform: uppercase; padding: 0 10px" href="" onclick="return false" rel="noreferrer"><strong>Login</strong></a>\r\n                    </td>\r\n                 </tr>-->\r\n           </tbody>\r\n           </table>\r\n       </td> \r\n	</tr>', '{{NAME}}$Vinay Ghael$Recipient Name'),
(11, 'order_placed', 'Order Placed', 'Srapo.com, Your Order Placed is Being Processed', '<tr>\r\n    	<td style="font-family: Arial,Helvetica,sans-serif; font-size: 15px; text-align: center; font-weight: bold; color: #52555a; padding-left: 10px; padding-right: 10px" height="50" align="center">\r\n        Hello {{NAME}},\r\n        </td>\r\n    </tr>\r\n    <tr>\r\n    	<td style="font-family: Arial,Helvetica,sans-serif; color: #52555a; text-align: center; padding-left: 10px; padding-right: 10px; font-size: 15px" height="50">\r\n        Thank you for your order!\r\n        </td>\r\n    </tr>\r\n	<tr>\r\n    	<td style="font-family: Arial,Helvetica,sans-serif; color: #52555a; text-align: center; padding-left: 10px; padding-right: 10px; font-size: 15px" height="50">\r\n        Please see attachment for your order receipt.\r\n        </td>\r\n    </tr>\r\n	<tr>\r\n    	<td style="font-family: Arial,Helvetica,sans-serif; color: #52555a; text-align: center; padding-left: 10px; padding-right: 10px; font-size: 15px" height="50">\r\n        Thank You.\r\n        </td>\r\n    </tr>\r\n	\r\n    <tr>\r\n    	<td style="line-height: 0px" height="25">\r\n        <br></td>\r\n    </tr>\r\n    <tr>\r\n    	<td align="center">\r\n		\r\n        	<table style="font: normal 14px Arial, Roboto,Helvetica, sans-serif; color: #FFFFFF; text-align: center; margin: 5px; background: #ff2341; border-radius: 3px" width="275" cellspacing="0" cellpadding="0" border="0" align="center">   \r\n            <tbody>\r\n            	<!--<tr>\r\n                	<td align="center">\r\n                    	<a style="color: #FFFFFF; text-decoration: none; display: block; line-height: 35px; text-transform: uppercase; padding: 0 10px" href="" onclick="return false" rel="noreferrer"><strong>Sign Up</strong></a>\r\n                    </td>\r\n					<td align="center">\r\n                    	<a style="color: #FFFFFF; text-decoration: none; display: block; line-height: 35px; text-transform: uppercase; padding: 0 10px" href="" onclick="return false" rel="noreferrer"><strong>Login</strong></a>\r\n                    </td>\r\n                 </tr>-->\r\n           </tbody>\r\n           </table>\r\n       </td> \r\n	</tr>', '<tr>\r\n    	<td align="center" height="50" style="font-family: Arial,Helvetica,sans-serif; font-size: 15px; text-align: center; font-weight: bold; color: #52555a; padding-left: 10px; padding-right: 10px">\r\n        Hello {{NAME}},\r\n        </td>\r\n    </tr>\r\n    <tr>\r\n    	<td height="50" style="font-family: Arial,Helvetica,sans-serif; color: #52555a; text-align: center; padding-left: 10px; padding-right: 10px; font-size: 15px">\r\n        Thank you for your order!\r\n        </td>\r\n    </tr>\r\n	<tr>\r\n    	<td height="50" style="font-family: Arial,Helvetica,sans-serif; color: #52555a; text-align: center; padding-left: 10px; padding-right: 10px; font-size: 15px">\r\n        Please see attachment for your order receipt.\r\n        </td>\r\n    </tr>\r\n	<tr>\r\n    	<td height="50" style="font-family: Arial,Helvetica,sans-serif; color: #52555a; text-align: center; padding-left: 10px; padding-right: 10px; font-size: 15px">\r\n        Thank You.\r\n        </td>\r\n    </tr>\r\n	\r\n    <tr>\r\n    	<td height="25" style="line-height: 0px">\r\n        </td>\r\n    </tr>\r\n    <tr>\r\n    	<td align="center">\r\n		\r\n        	<table width="275" border="0" cellspacing="0" cellpadding="0" style="font: normal 14px Arial, Roboto,Helvetica, sans-serif; color: #FFFFFF; text-align: center; margin: 5px; background: #ff2341; border-radius: 3px" align="center">   \r\n            <tbody>\r\n            	<!--<tr>\r\n                	<td align="center">\r\n                    	<a style="color: #FFFFFF; text-decoration: none; display: block; line-height: 35px; text-transform: uppercase; padding: 0 10px" href="" onclick="return false" rel="noreferrer"><strong>Sign Up</strong></a>\r\n                    </td>\r\n					<td align="center">\r\n                    	<a style="color: #FFFFFF; text-decoration: none; display: block; line-height: 35px; text-transform: uppercase; padding: 0 10px" href="" onclick="return false" rel="noreferrer"><strong>Login</strong></a>\r\n                    </td>\r\n                 </tr>-->\r\n           </tbody>\r\n           </table>\r\n       </td> \r\n	</tr>', '{{NAME}}$Vinay Ghael$Recipient Name'),
(12, 'product_purchesed', 'Product Purchesed', 'Srapo.com, Your Product Purchesed', '<tr>\r\n    	<td style="font-family: Arial,Helvetica,sans-serif; font-size: 15px; text-align: center; font-weight: bold; color: #52555a; padding-left: 10px; padding-right: 10px" height="50" align="center">\r\n        Hello {{NAME}},\r\n        </td>\r\n    </tr>\r\n    <tr>\r\n    	<td style="font-family: Arial,Helvetica,sans-serif; color: #52555a; text-align: center; padding-left: 10px; padding-right: 10px; font-size: 15px" height="50">\r\n        Your Product has been purchased by srapo.com user.\r\n        </td>\r\n    </tr>\r\n	<tr>\r\n    	<td style="font-family: Arial,Helvetica,sans-serif; color: #52555a; padding-left: 10px; padding-right: 10px; font-size: 15px" height="30">\r\n        <strong>Product Name:</strong> {{PRODUCT_NAME}}\r\n        </td>\r\n    </tr>\r\n	<tr>\r\n    	<td style="font-family: Arial,Helvetica,sans-serif; color: #52555a; text-align: center; padding-left: 10px; padding-right: 10px; font-size: 15px" height="50">\r\n        Thank You.\r\n        </td>\r\n    </tr>\r\n    <tr>\r\n    	<td style="line-height: 0px" height="25">\r\n        <br></td>\r\n    </tr>\r\n    <tr>\r\n    	<td align="center">\r\n		\r\n        	<table style="font: normal 14px Arial, Roboto,Helvetica, sans-serif; color: #FFFFFF; text-align: center; margin: 5px; background: #ff2341; border-radius: 3px" width="275" cellspacing="0" cellpadding="0" border="0" align="center">   \r\n            <tbody>\r\n            	<!--<tr>\r\n                	<td align="center">\r\n                    	<a style="color: #FFFFFF; text-decoration: none; display: block; line-height: 35px; text-transform: uppercase; padding: 0 10px" href="" onclick="return false" rel="noreferrer"><strong>Sign Up</strong></a>\r\n                    </td>\r\n					<td align="center">\r\n                    	<a style="color: #FFFFFF; text-decoration: none; display: block; line-height: 35px; text-transform: uppercase; padding: 0 10px" href="" onclick="return false" rel="noreferrer"><strong>Login</strong></a>\r\n                    </td>\r\n                 </tr>-->\r\n           </tbody>\r\n           </table>\r\n       </td> \r\n	</tr>', '<tr>\r\n    	<td align="center" height="50" style="font-family: Arial,Helvetica,sans-serif; font-size: 15px; text-align: center; font-weight: bold; color: #52555a; padding-left: 10px; padding-right: 10px">\r\n        Hello {{NAME}},\r\n        </td>\r\n    </tr>\r\n    <tr>\r\n    	<td height="50" style="font-family: Arial,Helvetica,sans-serif; color: #52555a; text-align: center; padding-left: 10px; padding-right: 10px; font-size: 15px">\r\n        Your Product has been purchased by srapo.com user.\r\n        </td>\r\n    </tr>\r\n	<tr>\r\n    	<td height="30" style="font-family: Arial,Helvetica,sans-serif; color: #52555a; padding-left: 10px; padding-right: 10px; font-size: 15px">\r\n        <strong>Product Name:</strong> {{PRODUCT_NAME}}\r\n        </td>\r\n    </tr>\r\n	<tr>\r\n    	<td height="50" style="font-family: Arial,Helvetica,sans-serif; color: #52555a; text-align: center; padding-left: 10px; padding-right: 10px; font-size: 15px">\r\n        Thank You.\r\n        </td>\r\n    </tr>\r\n    <tr>\r\n    	<td height="25" style="line-height: 0px">\r\n        </td>\r\n    </tr>\r\n    <tr>\r\n    	<td align="center">\r\n		\r\n        	<table width="275" border="0" cellspacing="0" cellpadding="0" style="font: normal 14px Arial, Roboto,Helvetica, sans-serif; color: #FFFFFF; text-align: center; margin: 5px; background: #ff2341; border-radius: 3px" align="center">   \r\n            <tbody>\r\n            	<!--<tr>\r\n                	<td align="center">\r\n                    	<a style="color: #FFFFFF; text-decoration: none; display: block; line-height: 35px; text-transform: uppercase; padding: 0 10px" href="" onclick="return false" rel="noreferrer"><strong>Sign Up</strong></a>\r\n                    </td>\r\n					<td align="center">\r\n                    	<a style="color: #FFFFFF; text-decoration: none; display: block; line-height: 35px; text-transform: uppercase; padding: 0 10px" href="" onclick="return false" rel="noreferrer"><strong>Login</strong></a>\r\n                    </td>\r\n                 </tr>-->\r\n           </tbody>\r\n           </table>\r\n       </td> \r\n	</tr>', '{{NAME}}$Vinay Ghael$Recipient Name\r\n|\r\n{{PRODUCT_NAME}}$Big Art$Product Name'),
(13, 'org_inquiry_reply_message', 'Organization Enquiry Reply Message', '<< SUBJECT>>', '<tr>\r\n    	<td style="font-family: Arial,Helvetica,sans-serif; font-size: 15px; font-weight: bold; color: #52555a; padding-left: 10px; padding-right: 10px" height="50">\r\n        Hello {{NAME}},\r\n        </td>\r\n    </tr>\r\n    <tr>\r\n    	<td style="font-family: Arial,Helvetica,sans-serif; color: #52555a; padding-left: 10px; padding-right: 10px; font-size: 15px">\r\n        {{MESSAGE}}\r\n        </td>\r\n    </tr>\r\n	<tr>\r\n    	<td style="font-family: Arial,Helvetica,sans-serif; color: #52555a; padding-left: 10px; padding-right: 10px; font-size: 15px" height="50">\r\n        For future help and support, please contact us by using our official email address : {{ORG_EMAIL}}\r\n        </td>\r\n    </tr>\r\n    <tr>\r\n    	<td style="line-height: 0px" height="25">\r\n        <br></td>\r\n    </tr>\r\n    <tr>\r\n    	<td align="center">\r\n        	<table style="font: normal 14px Arial, Roboto,Helvetica, sans-serif; color: #FFFFFF; text-align: center; margin: 5px; background: #ff2341; border-radius: 3px" width="275" cellspacing="0" cellpadding="0" border="0" align="center">   \r\n            <tbody>\r\n            	<tr>\r\n                	<!--<td align="center">\r\n                    	<a style="color: #FFFFFF; text-decoration: none; display: block; line-height: 35px; text-transform: uppercase; padding: 0 10px" href="" onclick="return false" rel="noreferrer"><strong>Click Here To Change Password</strong></a>\r\n                    </td>-->\r\n                 </tr>\r\n           </tbody>\r\n           </table>\r\n       </td> \r\n	</tr>', '<tr>\r\n    	<td height="50" style="font-family: Arial,Helvetica,sans-serif; font-size: 15px; font-weight: bold; color: #52555a; padding-left: 10px; padding-right: 10px">\r\n        Hello {{NAME}},\r\n        </td>\r\n    </tr>\r\n    <tr>\r\n    	<td style="font-family: Arial,Helvetica,sans-serif; color: #52555a; padding-left: 10px; padding-right: 10px; font-size: 15px">\r\n        {{MESSAGE}}\r\n        </td>\r\n    </tr>\r\n	<tr>\r\n    	<td height="50" style="font-family: Arial,Helvetica,sans-serif; color: #52555a; padding-left: 10px; padding-right: 10px; font-size: 15px">\r\n        For future help and support, please contact us by using our official email address : {{ORG_EMAIL}}\r\n        </td>\r\n    </tr>\r\n    <tr>\r\n    	<td height="25" style="line-height: 0px">\r\n        </td>\r\n    </tr>\r\n    <tr>\r\n    	<td align="center">\r\n        	<table width="275" border="0" cellspacing="0" cellpadding="0" style="font: normal 14px Arial, Roboto,Helvetica, sans-serif; color: #FFFFFF; text-align: center; margin: 5px; background: #ff2341; border-radius: 3px" align="center">   \r\n            <tbody>\r\n            	<tr>\r\n                	<!--<td align="center">\r\n                    	<a style="color: #FFFFFF; text-decoration: none; display: block; line-height: 35px; text-transform: uppercase; padding: 0 10px" href="" onclick="return false" rel="noreferrer"><strong>Click Here To Change Password</strong></a>\r\n                    </td>-->\r\n                 </tr>\r\n           </tbody>\r\n           </table>\r\n       </td> \r\n	</tr>', '{{NAME}}$Vinay Ghael$Recipient Name\r\n|\r\n{{MESSAGE}}$this is test email message from organization$Enruiry Reply Message Written by organization comes here.\r\n|\r\n{{ORG_EMAIL}}$inquiery@vpninfotech.com$Email address of organization'),
(14, 'account_activated', 'Account Activated', 'Srapo.com, Account Activated Successfully', '<tr>\r\n    	<td style="font-family: Arial,Helvetica,sans-serif; font-size: 15px; text-align: center; font-weight: bold; color: #52555a; padding-left: 10px; padding-right: 10px" height="50" align="center">\r\n        Hello {{NAME}},\r\n        </td>\r\n    </tr>\r\n\r\n    <tr>\r\n    	<td style="font-family: Arial,Helvetica,sans-serif; color: #52555a; text-align: center; padding-left: 10px; padding-right: 10px; font-size: 15px">\r\n       Congratulations...! Your account successfully activated, you may now login with your user id and password.\r\n        </td>\r\n    </tr>\r\n    <tr>\r\n    	<td style="line-height: 0px" height="25">\r\n        <br></td>\r\n    </tr>', '<tr>\r\n    	<td style="font-family: Arial,Helvetica,sans-serif; font-size: 15px; text-align: center; font-weight: bold; color: #52555a; padding-left: 10px; padding-right: 10px" height="50" align="center">\r\n        Hello {{NAME}},\r\n        </td>\r\n    </tr>\r\n\r\n    <tr>\r\n    	<td style="font-family: Arial,Helvetica,sans-serif; color: #52555a; text-align: center; padding-left: 10px; padding-right: 10px; font-size: 15px">\r\n       Congratulations...! Your account successfully activated, you may now login with your user id and password.\r\n        </td>\r\n    </tr>\r\n    <tr>\r\n    	<td style="line-height: 0px" height="25">\r\n        <br></td>\r\n    </tr>', '{{NAME}}$Mehul Patel$Recipient Name'),
(15, 'newsletter_subscribe', 'Newsletter Subscribe', 'Srapo.com, Newsletter Subscribe Successfully', '<tr>\r\n    	<td style="font-family: Arial,Helvetica,sans-serif; font-size: 15px; text-align: center; font-weight: bold; color: #52555a; padding-left: 10px; padding-right: 10px" height="50" align="center">\r\n        Hello {{NAME}},\r\n        </td>\r\n    </tr>\r\n\r\n    <tr>\r\n    	<td style="font-family: Arial,Helvetica,sans-serif; color: #52555a; text-align: center; padding-left: 10px; padding-right: 10px; font-size: 15px">\r\n       Thank you for subscribing on our newsletter.\r\n        </td>\r\n    </tr>\r\n    <tr>\r\n    	<td style="line-height: 0px" height="25">\r\n        <br></td>\r\n    </tr>', '<tr>\r\n    	<td style="font-family: Arial,Helvetica,sans-serif; font-size: 15px; text-align: center; font-weight: bold; color: #52555a; padding-left: 10px; padding-right: 10px" height="50" align="center">\r\n        Hello {{NAME}},\r\n        </td>\r\n    </tr>\r\n\r\n    <tr>\r\n    	<td style="font-family: Arial,Helvetica,sans-serif; color: #52555a; text-align: center; padding-left: 10px; padding-right: 10px; font-size: 15px">\r\n       Thank you for subscribing on our newsletter.\r\n        </td>\r\n    </tr>\r\n    <tr>\r\n    	<td style="line-height: 0px" height="25">\r\n        <br></td>\r\n    </tr>', '{{NAME}}$mehul@gmail.com$Recipient Email');

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE IF NOT EXISTS `expense` (
  `expense_id` int(11) NOT NULL,
  `expense_name` varchar(100) NOT NULL,
  `note` text NOT NULL,
  `expense_category_id` int(11) NOT NULL,
  `expense_date` date NOT NULL,
  `expense_amount` varchar(100) NOT NULL,
  `user_type_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `currency_id` int(11) NOT NULL,
  `currency_code` varchar(100) NOT NULL,
  `currency_value` varchar(100) NOT NULL,
  `attachment` varchar(200) NOT NULL,
  `reference` varchar(100) NOT NULL,
  `payment_method` varchar(100) NOT NULL,
  `tax_id` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '1=Enabled, 0=Disabled',
  `is_deleted` int(11) NOT NULL COMMENT '1 = softdeleted, 0 = not softdeleted'
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expense`
--

INSERT INTO `expense` (`expense_id`, `expense_name`, `note`, `expense_category_id`, `expense_date`, `expense_amount`, `user_type_id`, `user_id`, `currency_id`, `currency_code`, `currency_value`, `attachment`, `reference`, `payment_method`, `tax_id`, `date_added`, `added_by`, `date_modified`, `modified_by`, `status`, `is_deleted`) VALUES
(2, 'admin abc', 'Test admin Expenes', 2, '2016-12-22', '150', 2, 17, 7, 'USD', '1.00000000', 'c61ab13cc1e231a83a1200ca632bef4d.jpg', 'admin1', '1', 1, '2016-12-29 06:56:03', 17, '2016-12-29 06:56:03', 17, 1, 0),
(3, 'en1', 'manufacturer note 1', 1, '2016-12-22', '55', 6, 18, 7, 'USD', '1.00000000', '1779511d3346d9962341b35232d14752.png', 'manufeturer r1', '1', 1, '2016-12-22 09:22:10', 30, '2016-12-22 09:22:10', 30, 1, 0),
(6, 'enc1', 'customer note 1', 1, '2016-12-22', '55', 8, 44, 7, 'USD', '1.00000000', '6fe0b9b4b650d0036237aa49f5c924ca.png', 'c1', '1', 2, '2016-12-22 11:55:31', 30, '2016-12-22 11:55:31', 30, 1, 0),
(7, 'enc2', 'Customer Note2', 2, '2016-12-22', '55', 8, 41, 7, 'USD', '1.00000000', '731544ff4863c44e0e2c383160df6d22.png', 'cr2', '3', 2, '2016-12-22 12:52:35', 1, '2016-12-22 12:52:35', 1, 1, 0),
(8, 'en1', 'ertwere', 1, '2016-12-22', '55', 6, 21, 7, 'USD', '1.00000000', 'a68df0661f890ff7c382c6286f5b1288.png', '555', '2', 2, '2016-12-22 02:23:23', 30, '2016-12-22 02:23:23', 30, 1, 0),
(9, 'en1', 'finance note1', 1, '2016-12-22', '55', 3, 30, 7, 'USD', '1.00000000', 'd8e77295557aa40d3c55eeea77ff26b8.png', 'finance r1', '3', 1, '2016-12-22 02:24:19', 30, '2016-12-22 02:24:19', 30, 1, 0),
(10, 'en2', 'dataoprater note1', 2, '2016-12-22', '55', 5, 18, 7, 'USD', '1.00000000', 'de3d20256d2ff996cb3665dbbe380e7b.png', 'dataoprater r1', '1', 2, '2016-12-22 02:25:17', 30, '2016-12-22 02:25:17', 30, 1, 0),
(11, 'en2', 'support note1', 2, '2016-12-22', '555', 7, 24, 7, 'USD', '1.00000000', '836946bd7e81ebcaba105ebfd735becc.png', 'support srapo r1', '3', 2, '2016-12-22 02:26:20', 30, '2016-12-22 02:26:20', 30, 1, 0),
(12, 'en c2', 'customer note2', 1, '2016-12-22', '55', 8, 41, 7, 'USD', '1.00000000', '465b6713344e43285d8e7e23d0e3bff2.png', 'customer 555', '1', 1, '2016-12-22 02:28:04', 30, '2016-12-22 02:28:04', 30, 1, 0),
(13, 'en2', 'c2', 2, '2016-12-22', '55', 8, 41, 7, 'USD', '1.00000000', '', 'cr2', '2', 2, '2016-12-22 02:28:55', 30, '2016-12-22 02:28:55', 30, 1, 0),
(14, 'enm5', 'manufacturer note2', 1, '2016-12-22', '55', 6, 21, 7, 'USD', '1.00000000', 'cd86183afa78fb8cea30398b84550a2d.png', 'manufaturer5', '2', 2, '2016-12-22 02:29:55', 30, '2016-12-22 02:29:55', 30, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `expense_category`
--

CREATE TABLE IF NOT EXISTS `expense_category` (
  `expense_category_id` int(11) NOT NULL,
  `expense_category_name` varchar(100) NOT NULL,
  `transaction` varchar(100) NOT NULL,
  `date_added` datetime NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '1=Enabled, 0=Disabled',
  `is_deleted` int(11) NOT NULL COMMENT '1 = softdeleted, 0 = not softdeleted'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expense_category`
--

INSERT INTO `expense_category` (`expense_category_id`, `expense_category_name`, `transaction`, `date_added`, `added_by`, `date_modified`, `modified_by`, `status`, `is_deleted`) VALUES
(1, 'ecn1', 'credit', '2016-12-20 05:54:45', 1, '2016-12-29 05:57:34', 17, 1, 0),
(2, 'ecn2', 'debit', '2016-12-20 05:59:58', 1, '2016-12-29 05:57:47', 17, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `filter`
--

CREATE TABLE IF NOT EXISTS `filter` (
  `filter_id` int(11) NOT NULL,
  `filter_group_id` int(11) NOT NULL,
  `filter_name` varchar(255) NOT NULL,
  `sort_order` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `status` int(1) NOT NULL COMMENT '1=Enabled, 0=Disabled',
  `is_deleted` int(1) NOT NULL COMMENT '1 = softdeleted, 0 = not softdeleted'
) ENGINE=InnoDB AUTO_INCREMENT=161 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `filter`
--

INSERT INTO `filter` (`filter_id`, `filter_group_id`, `filter_name`, `sort_order`, `date_added`, `added_by`, `date_modified`, `modified_by`, `status`, `is_deleted`) VALUES
(113, 14, 'Red', 1, '2017-01-10 05:06:43', 1, '2017-01-10 05:06:43', 1, 0, 0),
(114, 14, 'Green', 2, '2017-01-10 05:06:43', 1, '2017-01-10 05:06:43', 1, 0, 0),
(115, 14, 'Blue', 3, '2017-01-10 05:06:43', 1, '2017-01-10 05:06:43', 1, 0, 0),
(116, 14, 'Black', 4, '2017-01-10 05:06:43', 1, '2017-01-10 05:06:43', 1, 0, 0),
(117, 14, 'Yellow', 5, '2017-01-10 05:06:43', 1, '2017-01-10 05:06:43', 1, 0, 0),
(118, 14, 'Pink', 6, '2017-01-10 05:06:43', 1, '2017-01-10 05:06:43', 1, 0, 0),
(119, 14, 'Purple', 7, '2017-01-10 05:06:43', 1, '2017-01-10 05:06:43', 1, 0, 0),
(120, 14, 'Orange', 8, '2017-01-10 05:06:43', 1, '2017-01-10 05:06:43', 1, 0, 0),
(121, 15, '12', 1, '2017-01-10 05:07:32', 1, '2017-01-10 05:07:32', 1, 0, 0),
(122, 15, '13', 2, '2017-01-10 05:07:32', 1, '2017-01-10 05:07:32', 1, 0, 0),
(123, 15, '14', 3, '2017-01-10 05:07:32', 1, '2017-01-10 05:07:32', 1, 0, 0),
(124, 15, '15', 4, '2017-01-10 05:07:32', 1, '2017-01-10 05:07:32', 1, 0, 0),
(125, 15, '16', 5, '2017-01-10 05:07:32', 1, '2017-01-10 05:07:32', 1, 0, 0),
(126, 15, '17', 6, '2017-01-10 05:07:32', 1, '2017-01-10 05:07:32', 1, 0, 0),
(127, 15, '18', 7, '2017-01-10 05:07:32', 1, '2017-01-10 05:07:32', 1, 0, 0),
(128, 15, '19', 8, '2017-01-10 05:07:32', 1, '2017-01-10 05:07:32', 1, 0, 0),
(129, 15, '20', 9, '2017-01-10 05:07:32', 1, '2017-01-10 05:07:32', 1, 0, 0),
(130, 16, '1kg', 1, '2017-01-10 05:08:15', 1, '2017-01-10 05:08:15', 1, 0, 0),
(131, 16, '2kg', 2, '2017-01-10 05:08:15', 1, '2017-01-10 05:08:15', 1, 0, 0),
(132, 16, '3kg', 3, '2017-01-10 05:08:15', 1, '2017-01-10 05:08:15', 1, 0, 0),
(133, 16, '4kg', 4, '2017-01-10 05:08:15', 1, '2017-01-10 05:08:15', 1, 0, 0),
(134, 16, '5kg', 5, '2017-01-10 05:08:15', 1, '2017-01-10 05:08:15', 1, 0, 0),
(135, 13, '10', 1, '2017-01-12 06:49:15', 17, '2017-01-12 06:49:15', 17, 0, 0),
(136, 13, '20', 2, '2017-01-12 06:49:15', 17, '2017-01-12 06:49:15', 17, 0, 0),
(137, 13, '30', 3, '2017-01-12 06:49:15', 17, '2017-01-12 06:49:15', 17, 0, 0),
(138, 13, '50', 4, '2017-01-12 06:49:15', 17, '2017-01-12 06:49:15', 17, 0, 0),
(139, 13, '10000', 5, '2017-01-12 06:49:15', 17, '2017-01-12 06:49:15', 17, 0, 0),
(140, 14, 'Beige', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(141, 14, 'Off White', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(142, 14, 'Grey', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(143, 14, 'Gold', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(144, 14, 'Cream', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(145, 14, 'Brown', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(146, 14, 'Multicolor', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(147, 13, '1000', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(148, 13, '1500', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(149, 13, '2200', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(150, 13, '1200', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(151, 13, '1700', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(152, 13, '2400', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(153, 13, '2300', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(154, 13, '2100', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(155, 13, '2350', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(156, 13, '1299', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(157, 13, '1499', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(158, 13, '3300', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(159, 13, '2500', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(160, 13, '3200', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `filter_group`
--

CREATE TABLE IF NOT EXISTS `filter_group` (
  `filter_group_id` int(11) NOT NULL,
  `filter_group_name` varchar(255) NOT NULL,
  `sort_order` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `status` int(1) NOT NULL COMMENT '1=Enabled, 0=Disabled',
  `is_deleted` int(1) NOT NULL COMMENT '1 = softdeleted, 0 = not softdeleted'
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `filter_group`
--

INSERT INTO `filter_group` (`filter_group_id`, `filter_group_name`, `sort_order`, `date_added`, `added_by`, `date_modified`, `modified_by`, `status`, `is_deleted`) VALUES
(13, 'Price', 1, '2017-01-10 05:05:31', 1, '2017-01-12 06:49:15', 17, 0, 0),
(14, 'Color', 2, '2017-01-10 05:06:43', 1, '2017-01-10 05:06:43', 1, 0, 0),
(15, 'Size', 3, '2017-01-10 05:07:32', 1, '2017-01-10 05:07:32', 1, 0, 0),
(16, 'Weight', 4, '2017-01-10 05:08:15', 1, '2017-01-10 05:08:15', 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `information`
--

CREATE TABLE IF NOT EXISTS `information` (
  `information_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_description` text NOT NULL,
  `meta_keyword` text NOT NULL,
  `date_added` datetime NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  `bottom` int(1) NOT NULL,
  `column` int(11) NOT NULL DEFAULT '1',
  `sort_order` int(11) NOT NULL,
  `is_deleted` int(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `information`
--

INSERT INTO `information` (`information_id`, `title`, `description`, `meta_title`, `meta_description`, `meta_keyword`, `date_added`, `added_by`, `date_modified`, `modified_by`, `status`, `bottom`, `column`, `sort_order`, `is_deleted`) VALUES
(16, 'Shipping', '<p>Shipping<br></p>', 'shipping', '', '', '2017-01-19 12:56:42', 1, '2017-01-19 12:56:42', 1, 1, 1, 1, 1, 0),
(17, 'Return', '<p>Return<br></p>', 'return', '', '', '2017-01-19 12:57:09', 1, '2017-01-19 12:57:09', 1, 1, 1, 1, 2, 0),
(18, 'Privacy Policy', '<p>Privacy Policy<br></p>', 'privacy-policy', '', '', '2017-01-19 12:57:40', 1, '2017-01-19 12:57:40', 1, 1, 1, 1, 3, 0),
(19, 'Delivery Information', '<p>Delivery Information<br></p>', 'delivery-information', '', '', '2017-01-19 12:58:11', 1, '2017-01-19 12:58:11', 1, 1, 1, 1, 4, 0),
(20, 'About Us', '<p>About Us<img src="http://vpnteam.com/srapo_CI//image/catalog/banners/ads18.jpg"><br></p>', 'about-us', '', '', '2017-01-19 12:58:48', 1, '2017-01-28 01:05:57', 17, 1, 1, 2, 1, 0),
(21, 'Payment', '<p>Payment<br></p>', 'payment', '', '', '2017-01-19 12:59:13', 1, '2017-01-19 12:59:13', 1, 1, 1, 2, 2, 0),
(22, 'FAQ', '<p>FAQ<br></p>', 'faq', '', '', '2017-01-19 12:59:41', 1, '2017-01-19 12:59:41', 1, 1, 1, 2, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `length`
--

CREATE TABLE IF NOT EXISTS `length` (
  `length_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `value` decimal(15,8) NOT NULL,
  `date_added` datetime NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1' COMMENT '1=Enabled, 0=Disabled',
  `is_deleted` int(1) NOT NULL DEFAULT '0' COMMENT '1 = softdeleted, 0 = not softdeleted'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `length`
--

INSERT INTO `length` (`length_id`, `title`, `unit`, `value`, `date_added`, `added_by`, `date_modified`, `modified_by`, `status`, `is_deleted`) VALUES
(1, 'Centimeter', 'cm', '1.00000000', '2017-01-13 07:24:23', 1, '2017-01-13 07:24:29', 1, 1, 0),
(2, 'Inch', 'in', '0.39370000', '2017-01-13 07:25:02', 1, '2017-01-13 07:25:02', 1, 1, 0),
(3, 'Millimeter', 'mm', '10.00000000', '2017-01-13 07:25:26', 1, '2017-01-13 07:25:26', 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `manufacturer`
--

CREATE TABLE IF NOT EXISTS `manufacturer` (
  `manufacturer_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `middlename` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `telephone` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `image` varchar(255) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `bank_address` varchar(255) NOT NULL,
  `bank_ifsc_code` varchar(255) NOT NULL,
  `account_no` varchar(255) NOT NULL,
  `account_name` varchar(255) NOT NULL,
  `bank_document` text NOT NULL,
  `membership_fee` varchar(255) NOT NULL,
  `wallet_balance` varchar(255) NOT NULL,
  `upload_pancard` varchar(255) NOT NULL,
  `upload_bank_doc` varchar(255) NOT NULL,
  `upload_register_no` varchar(255) NOT NULL,
  `activation_code` varchar(255) NOT NULL,
  `newsletter` int(11) NOT NULL DEFAULT '1',
  `ip` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `company_address` text NOT NULL,
  `company_logo` text NOT NULL,
  `gst` text NOT NULL,
  `cst` text NOT NULL,
  `select_plan` varchar(100) NOT NULL,
  `last_access` datetime NOT NULL,
  `date_added` datetime NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  `is_deleted` int(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `manufacturer`
--

INSERT INTO `manufacturer` (`manufacturer_id`, `role_id`, `firstname`, `middlename`, `lastname`, `email`, `password`, `telephone`, `mobile`, `gender`, `dob`, `image`, `bank_name`, `bank_address`, `bank_ifsc_code`, `account_no`, `account_name`, `bank_document`, `membership_fee`, `wallet_balance`, `upload_pancard`, `upload_bank_doc`, `upload_register_no`, `activation_code`, `newsletter`, `ip`, `company_name`, `company_address`, `company_logo`, `gst`, `cst`, `select_plan`, `last_access`, `date_added`, `added_by`, `date_modified`, `modified_by`, `status`, `is_deleted`) VALUES
(11, 6, 'www', 'patel', 'patel', 'ck@vpninfotech.com', 'e10adc3949ba59abbe56e057f20f883e', '2345467688', '25689987', 'male', '2016-11-22', '', 'State Bank of India', 'hhhhhhhhh', '123445678', '233666666', 'gggfggggg', '', '2345', '43545', '', '', '4545787878', '066411', 1, '', 'hnhnhjjjjjjjjjjjjj', '', '', '', '', '', '2016-11-26 07:41:37', '2016-11-26 07:41:37', 16, '2016-12-06 06:58:24', 1, 0, 1),
(14, 6, 'aaaaaaa', 'mhuh', 'aaaaaaaaaaaaaa', 'rurur@04w2.rty', 'e10adc3949ba59abbe56e057f20f883e', '988548974', '5489749845', 'male', '2030-11-01', '', '', '', '', '', '', '', '335', '225', '', '', '', '', 1, '', '', '', '', '', '', '', '2016-12-06 09:45:27', '2016-12-06 09:45:27', 1, '2017-01-03 05:39:33', 1, 0, 0),
(17, 6, 'nhytf', 'asdsadad', 'addada', 'pmvpnweb@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '12355656', '36894564', 'male', '1970-01-01', '', '', '', '', '', '', '', '45', '35', '', '', '', '', 1, '', '', '', '', '', '', '', '2016-12-08 05:10:29', '2016-12-08 05:10:29', 1, '2016-12-20 04:39:52', 1, 0, 1),
(18, 6, 'Indrajit1', 'Virendrasinh', 'Kaplatiya', 'iks@vpninfotech.com', 'e10adc3949ba59abbe56e057f20f883e', '789556489', '8456465598', 'male', '1970-01-01', '', '', '', '', '', '', '', '220', '525', '', '', '', '', 1, '175.100.147.106', '', '', '', '', '', '', '2016-12-30 11:39:32', '2016-12-12 04:26:30', 16, '2017-01-09 07:14:58', 1, 1, 0),
(21, 6, 'Manufacturer', 'Manufacturer', 'Manufacturer', 'ss@vpninfotech.com', 'e10adc3949ba59abbe56e057f20f883e', '1234567890', '123456', 'male', '2016-12-17', 'catalog/Penguins.jpg', 'HDFC', '', '', '', '', '', '', '', '', '', '', '247321', 1, '175.100.147.87', '', '', '', '', '', '', '2017-01-09 11:50:23', '2016-12-17 04:50:04', 23, '2017-01-03 05:22:21', 1, 1, 0),
(25, 6, 'Indrajit', 'Virendrasinh', 'Kaplatiya', 'ik@vpninfotech.com', 'e35cf7b66449df565f93c607d5a81d09', '1234567890', '1234567890', 'male', '2016-11-05', '', '', 'Surat,Adajan', '123456', '567890', 'Saving', '', '', '', 'cbc813d6c53bad44a256fbfcdca32471.docx', '0ee9f733c6f0226b17f84bc9e453c900.docx', '', '', 1, '219.91.133.49', 'vpn Infotech', 'Surat,Adajan', '6229ae27f3a3804cb03b758b0be701b8.png', 'cbc813d6c53bad44a256fbfcdca32471.docx', '|0ee9f733c6f0226b17f84bc9e453c900.docx', 'pay_later', '2017-01-10 09:56:02', '2016-12-31 11:56:12', 0, '2017-01-03 01:41:12', 17, 1, 0),
(26, 6, 'chirag', '', 'patel', 'cks@vpninfotech.com', 'e10adc3949ba59abbe56e057f20f883e', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '970656', 1, '', '', '', '', '', '', '', '0000-00-00 00:00:00', '2017-01-11 11:34:42', 0, '0000-00-00 00:00:00', 0, 0, 0),
(27, 6, 'jay', '', 'shah', 'nc@vpninfotechcom', 'e10adc3949ba59abbe56e057f20f883e', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '403757', 1, '', '', '', '', '', '', '', '0000-00-00 00:00:00', '2017-01-23 13:29:52', 0, '0000-00-00 00:00:00', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `manufacturer_address`
--

CREATE TABLE IF NOT EXISTS `manufacturer_address` (
  `manufacturer_address_id` int(11) NOT NULL,
  `manufacturer_id` int(11) NOT NULL,
  `address_1` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `postcode` varchar(255) NOT NULL,
  `country_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `manufacturer_address`
--

INSERT INTO `manufacturer_address` (`manufacturer_address_id`, `manufacturer_id`, `address_1`, `city`, `postcode`, `country_id`, `state_id`) VALUES
(5, 2, 'Rajkot', 'Rajkot GIDC', '889898', 99, 1485),
(6, 21, 'Surat', 'Surat', '395009', 99, 1485),
(7, 14, 'lknalsdl', 'lklsdanfl', '12635464698', 99, 1485),
(12, 25, 'Surat', 'Surat', '395009', 99, 1485),
(13, 18, 'Navsari', 'Surat', '395009', 99, 1485);

-- --------------------------------------------------------

--
-- Table structure for table `newsletter`
--

CREATE TABLE IF NOT EXISTS `newsletter` (
  `newsletter_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `newsletter_status` int(1) NOT NULL,
  `newsletter_subscribe_date` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `newsletter`
--

INSERT INTO `newsletter` (`newsletter_id`, `email`, `newsletter_status`, `newsletter_subscribe_date`) VALUES
(1, 'vr@vpninfotech.com', 1, '2017-01-18 06:00:29'),
(2, 'pmvpnweb@gmail.com', 1, '2017-01-21 10:34:28');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE IF NOT EXISTS `notification` (
  `notification_id` int(11) NOT NULL,
  `notify_to` varchar(255) NOT NULL,
  `notify_by` varchar(255) NOT NULL,
  `module` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `action_type` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `is_read` int(1) NOT NULL,
  `read_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `option`
--

CREATE TABLE IF NOT EXISTS `option` (
  `option_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `sort_order` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `status` int(1) NOT NULL COMMENT '1=Enabled, 0=Disabled',
  `is_deleted` int(1) NOT NULL COMMENT '1 = softdeleted, 0 = not softdeleted'
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `option`
--

INSERT INTO `option` (`option_id`, `type`, `name`, `sort_order`, `date_added`, `added_by`, `date_modified`, `modified_by`, `status`, `is_deleted`) VALUES
(15, 'checkbox', 'Checkbox', 2, '2016-12-30 10:07:09', 17, '2016-12-30 10:07:09', 17, 0, 0),
(16, 'select', 'select', 4, '2016-11-28 04:35:55', 1, '2016-11-28 04:35:55', 1, 0, 0),
(17, 'date', 'Date', 7, '2016-11-28 05:02:22', 1, '2016-11-28 05:02:22', 1, 0, 0),
(18, 'datetime', 'Date & time', 9, '2016-11-28 04:37:20', 1, '2016-11-28 04:37:20', 1, 0, 0),
(19, 'date', 'Delivery Date', 11, '2016-11-28 04:38:32', 1, '2016-11-28 04:38:32', 1, 0, 0),
(20, 'file', 'fIle', 6, '2016-12-16 10:24:24', 23, '2016-12-16 10:24:24', 23, 0, 0),
(22, 'text', 'Text', 3, '2016-11-28 04:43:17', 1, '2016-11-28 04:43:17', 1, 0, 0),
(23, 'textarea', 'Textarea', 5, '2016-11-28 04:43:31', 1, '2016-11-28 04:43:31', 1, 0, 0),
(24, 'select', 'Size', 10, '2016-12-30 10:42:13', 17, '2016-12-30 10:42:13', 17, 0, 0),
(25, 'time', 'Time', 0, '2016-11-29 10:05:48', 1, '2016-11-29 10:05:48', 1, 0, 0),
(27, 'radio', 'Radio', 1, '2016-12-30 10:40:01', 17, '2016-12-30 10:40:01', 17, 0, 0),
(29, 'textarea', 'AAAAAAA', 0, '2016-12-22 04:08:01', 1, '2016-12-22 04:08:01', 1, 0, 1),
(32, 'datetime', 'ghgh', 0, '2016-12-15 03:30:01', 20, '2016-12-15 03:30:01', 20, 0, 1),
(33, 'textarea', 'ghgh', 0, '2016-12-15 03:29:51', 20, '2016-12-15 03:29:51', 20, 0, 1),
(34, 'file', 'news', 1, '2016-12-16 09:12:20', 23, '2016-12-16 09:12:20', 23, 0, 0),
(35, 'textarea', 'dsgdg', 0, '2016-12-16 04:06:38', 18, '2016-12-16 04:06:38', 18, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `option_value`
--

CREATE TABLE IF NOT EXISTS `option_value` (
  `option_value_id` int(11) NOT NULL,
  `option_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `sort_order` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `status` int(1) NOT NULL COMMENT '1=Enabled, 0=Disabled',
  `is_deleted` int(1) NOT NULL COMMENT '1 = softdeleted, 0 = not softdeleted'
) ENGINE=InnoDB AUTO_INCREMENT=150 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `option_value`
--

INSERT INTO `option_value` (`option_value_id`, `option_id`, `image`, `name`, `sort_order`, `date_added`, `added_by`, `date_modified`, `modified_by`, `status`, `is_deleted`) VALUES
(38, 16, '', 'Red', 1, '2016-11-28 04:35:55', 1, '2016-11-28 04:35:55', 1, 0, 0),
(39, 16, '', 'Green', 2, '2016-11-28 04:35:55', 1, '2016-11-28 04:35:55', 1, 0, 0),
(40, 16, '', 'Blue', 3, '2016-11-28 04:35:55', 1, '2016-11-28 04:35:55', 1, 0, 0),
(41, 16, '', 'Yellow', 4, '2016-11-28 04:35:55', 1, '2016-11-28 04:35:55', 1, 0, 0),
(119, 34, 'catalog/1024x735.jpg', 'www', 1, '2016-12-16 09:12:20', 23, '2016-12-16 09:12:20', 23, 0, 0),
(120, 34, '', 'qqq', 2, '2016-12-16 09:12:20', 23, '2016-12-16 09:12:20', 23, 0, 0),
(121, 35, '', 'fghfghgfhgh', 0, '2016-12-16 04:06:38', 18, '2016-12-16 04:06:38', 18, 0, 1),
(126, 15, 'catalog/1024x735.jpg', 'Sky', 1, '2016-12-30 10:07:09', 17, '2016-12-30 10:07:09', 17, 0, 0),
(127, 15, 'catalog/Jellyfish.jpg', 'Blue', 4, '2016-12-30 10:07:09', 17, '2016-12-30 10:07:09', 17, 0, 0),
(128, 15, 'catalog/Desert (2).jpg', 'Marun', 6, '2016-12-30 10:07:09', 17, '2016-12-30 10:07:09', 17, 0, 0),
(129, 15, 'catalog/Tulips.jpg', 'Yellow', 7, '2016-12-30 10:07:09', 17, '2016-12-30 10:07:09', 17, 0, 0),
(130, 27, '', 'Large', 1, '2016-12-30 10:40:01', 17, '2016-12-30 10:40:01', 17, 0, 0),
(131, 27, '', 'Medium', 2, '2016-12-30 10:40:01', 17, '2016-12-30 10:40:01', 17, 0, 0),
(132, 27, '', 'Small', 3, '2016-12-30 10:40:01', 17, '2016-12-30 10:40:01', 17, 0, 0),
(136, 24, '', 'Small', 1, '2016-12-30 10:42:13', 17, '2016-12-30 10:42:13', 17, 0, 0),
(137, 24, '', 'Medium', 2, '2016-12-30 10:42:13', 17, '2016-12-30 10:42:13', 17, 0, 0),
(138, 24, '', 'Large', 3, '2016-12-30 10:42:13', 17, '2016-12-30 10:42:13', 17, 0, 0),
(139, 16, '', 'Pink', 0, '2017-01-24 12:29:05', 0, '0000-00-00 00:00:00', 0, 0, 0),
(140, 16, '', 'Beige', 0, '2017-01-24 12:29:14', 0, '0000-00-00 00:00:00', 0, 0, 0),
(141, 16, '', 'Off White', 0, '2017-01-24 12:29:31', 0, '0000-00-00 00:00:00', 0, 0, 0),
(142, 16, '', 'Black', 0, '2017-01-24 12:29:31', 0, '0000-00-00 00:00:00', 0, 0, 0),
(143, 16, '', 'Grey', 0, '2017-01-24 12:29:37', 0, '0000-00-00 00:00:00', 0, 0, 0),
(144, 16, '', 'Gold', 0, '2017-01-24 12:29:37', 0, '0000-00-00 00:00:00', 0, 0, 0),
(145, 16, '', 'Purple', 0, '2017-01-24 12:29:37', 0, '0000-00-00 00:00:00', 0, 0, 0),
(146, 16, '', 'Orange', 0, '2017-01-24 12:29:42', 0, '0000-00-00 00:00:00', 0, 0, 0),
(147, 16, '', 'Cream', 0, '2017-01-24 12:29:49', 0, '0000-00-00 00:00:00', 0, 0, 0),
(148, 16, '', 'Brown', 0, '2017-01-24 12:29:49', 0, '0000-00-00 00:00:00', 0, 0, 0),
(149, 16, '', 'Multicolor', 0, '2017-01-24 12:30:01', 0, '0000-00-00 00:00:00', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE IF NOT EXISTS `order` (
  `order_id` int(11) NOT NULL,
  `invoice_no` int(255) NOT NULL,
  `invoice_prefix` varchar(255) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `customer_group_id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telephone` varchar(255) NOT NULL,
  `payment_firstname` varchar(255) NOT NULL,
  `payment_lastname` varchar(255) NOT NULL,
  `payment_company` varchar(255) NOT NULL,
  `payment_address_1` text NOT NULL,
  `payment_address_2` text NOT NULL,
  `payment_city` varchar(255) NOT NULL,
  `payment_postcode` varchar(255) NOT NULL,
  `payment_country` varchar(255) NOT NULL,
  `payment_country_id` int(11) NOT NULL,
  `payment_zone` varchar(255) NOT NULL,
  `payment_state_id` int(11) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `payment_code` varchar(255) NOT NULL,
  `shipping_firstname` varchar(255) NOT NULL,
  `shipping_lastname` varchar(255) NOT NULL,
  `shipping_company` varchar(255) NOT NULL,
  `shipping_address_1` text NOT NULL,
  `shipping_address_2` text NOT NULL,
  `shipping_city` varchar(255) NOT NULL,
  `shipping_postcode` varchar(255) NOT NULL,
  `shipping_country` varchar(255) NOT NULL,
  `shipping_country_id` int(11) NOT NULL,
  `shipping_zone` varchar(255) NOT NULL,
  `shipping_state_id` int(11) NOT NULL,
  `shipping_method` varchar(255) NOT NULL,
  `shipping_code` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `total` varchar(255) NOT NULL,
  `order_status_id` int(11) NOT NULL,
  `tracking` varchar(255) NOT NULL,
  `currency_id` int(11) NOT NULL,
  `currency_code` varchar(255) NOT NULL,
  `currency_value` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `is_deleted` int(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`order_id`, `invoice_no`, `invoice_prefix`, `customer_id`, `customer_group_id`, `firstname`, `lastname`, `email`, `telephone`, `payment_firstname`, `payment_lastname`, `payment_company`, `payment_address_1`, `payment_address_2`, `payment_city`, `payment_postcode`, `payment_country`, `payment_country_id`, `payment_zone`, `payment_state_id`, `payment_method`, `payment_code`, `shipping_firstname`, `shipping_lastname`, `shipping_company`, `shipping_address_1`, `shipping_address_2`, `shipping_city`, `shipping_postcode`, `shipping_country`, `shipping_country_id`, `shipping_zone`, `shipping_state_id`, `shipping_method`, `shipping_code`, `comment`, `total`, `order_status_id`, `tracking`, `currency_id`, `currency_code`, `currency_value`, `date_added`, `added_by`, `date_modified`, `modified_by`, `is_deleted`) VALUES
(14, 0, 'INV-2013-', 43, 18, 'sandip', 'ss', 'ss@vpninfotech.com', '123456', 'F_Address', 'L_Address', 'Company', 'Address2', 'Address2', 'surat', '395006', 'India', 99, 'Goa', 1484, 'Free Checkout', 'free_checkout', 'F_Address', 'L_Address', 'fg', 'Address 1', 'Address 1', 'surat', '395006', 'India', 99, 'Gujarat', 1485, 'Flat Shipping Rate', 'flat.flat', '', '145.1', 14, '', 16, 'INR', '67.83999634', '2016-12-31 00:11:22', 0, '2016-12-31 00:12:34', 0, 0),
(16, 4, 'INV-2013-', 45, 18, 'Indrajit', 'Kaplatiya', 'ik@vpninfotech.com', '9998591905', 'Indrajit', 'Kaplatiya', 'VPN', 'Surat', 'Navsari', 'Surat', '395009', 'India', 99, 'Gujarat', 1485, 'Free Checkout', 'free_checkout', 'Indrajit', 'Kaplatiya', 'VPN', 'Surat', 'Navsari', 'Surat', '395009', 'India', 99, 'Gujarat', 1485, 'Flat Shipping Rate', 'flat.flat', '', '405.1', 10, '', 7, 'USD', '1', '2016-12-31 02:12:22', 0, '2016-12-31 02:20:16', 0, 0),
(18, 0, 'INV-2013-', 43, 19, 'sandip', 'ss', 'ss@vpninfotech.com', '123456', 'F_Address', 'L_Address', 'fg', 'Address 1', 'Address 1', 'surat', '395006', 'India', 99, 'Lakshadweep Islands', 1491, 'Free Checkout', 'free_checkout', 'F_Address', 'L_Address', 'fg', 'Address 1', 'Address 1', 'surat', '395006', 'India', 99, 'Gujarat', 1485, 'Flat Shipping Rate', 'flat.flat', '', '120.1', 14, '', 7, 'USD', '1', '2016-12-31 02:29:54', 0, '2016-12-31 02:29:54', 0, 0),
(19, 0, 'INV-2013-', 43, 19, 'sandip', 'ss', 'ss@vpninfotech.com', '123456', 'F_Address', 'L_Address', 'fg', 'Address 1', 'Address 1', 'surat', '395006', 'India', 99, 'Gujarat', 1485, 'Free Checkout', 'free_checkout', 'F_Address', 'L_Address', 'fg', 'Address 1', 'Address 1', 'surat', '395006', 'India', 99, 'Gujarat', 1485, 'Flat Shipping Rate', 'flat.flat', '', '105.1', 14, '', 7, 'USD', '1', '2016-12-31 02:55:07', 0, '2016-12-31 02:55:07', 0, 0),
(20, 0, 'INV-2013-', 43, 19, 'sandip', 'ss', 'ss@vpninfotech.com', '123456', 'F_Address', 'L_Address', 'fg', 'Address 1', 'Address 1', 'surat', '395006', 'India', 99, 'Gujarat', 1485, 'Free Checkout', 'free_checkout', 'F_Address', 'L_Address', 'fg', 'Address 1', 'Address 1', 'surat', '395006', 'India', 99, 'Gujarat', 1485, 'Flat Shipping Rate', 'flat.flat', '', '105.1', 14, '', 7, 'USD', '1', '2016-12-31 03:07:32', 0, '2016-12-31 03:07:32', 0, 0),
(21, 5, 'INV-2013-', 43, 19, 'sandip', 'ss', 'ss@vpninfotech.com', '123456', 'F_Address', 'L_Address', 'fg', 'Address 1', 'Address 1', 'surat', '395006', 'India', 99, 'Gujarat', 1485, 'Free Checkout', 'free_checkout', '', '', '', '', '', '', '', '', 0, '', 0, '', '', '', '122', 14, '', 7, 'USD', '1', '2016-12-31 03:27:33', 0, '2016-12-31 03:27:33', 0, 0),
(22, 6, 'INV-2013-', 45, 18, 'Indrajit', 'Kaplatiya', 'ik@vpninfotech.com', '9998591905', 'Indrajit', 'Kaplatiya', 'VPN', 'Surat', 'Navsari', 'Surat', '395009', 'India', 99, 'Gujarat', 1485, 'Free Checkout', 'free_checkout', 'Indrajit', 'Kaplatiya', 'VPN', 'Surat', 'Navsari', 'Surat', '395009', 'India', 99, 'Gujarat', 1485, 'Flat Shipping Rate', 'flat.flat', '', '359.6', 15, '', 7, 'USD', '1', '2016-12-31 23:02:10', 0, '2016-12-31 23:02:50', 0, 0),
(23, 0, 'INV-2013-', 46, 19, 'chirag', 'kalathiya', 'chirag@gmail.com', '123456', 'abc', 'xyz', '', 'surat', '', 'surat', '395009', 'India', 99, 'Gujarat', 1485, 'Free Checkout', 'free_checkout', '', '', '', '', '', '', '', '', 0, '', 0, '', '', '', '220', 14, '', 7, 'USD', '1', '2017-01-02 21:52:29', 0, '2017-01-02 21:52:29', 0, 0),
(24, 0, 'INV-2013-', 46, 19, 'chirag', 'kalathiya', 'chirag@gmail.com', '123456', 'abc', 'xyz', '', 'Adajan', '', 'Surat', '395009', 'India', 99, 'Gujarat', 1485, 'Free Checkout', 'free_checkout', 'Mahesh', 'Vora', '', 'Katargam', '', 'Surat', '39511', 'India', 99, 'Gujarat', 1485, 'Flat Shipping Rate', 'flat.flat', '', '305.1', 14, '', 7, 'USD', '1', '2017-01-09 00:12:37', 0, '2017-01-09 00:12:37', 0, 0),
(25, 0, 'INV-2013-', 46, 19, 'chirag', 'kalathiya', 'chirag@gmail.com', '123456', 'abc', 'xyz', '', 'Adajan', '', 'Surat', '395009', 'India', 99, 'Gujarat', 1485, 'Free Checkout', 'free_checkout', 'Mahesh', 'Vora', '', 'Katargam', '', 'Surat', '39511', 'India', 99, 'Gujarat', 1485, 'Flat Shipping Rate', 'flat.flat', '', '305.1', 14, '', 7, 'USD', '1', '2017-01-09 00:12:49', 0, '2017-01-09 00:12:49', 0, 0),
(26, 0, 'INV-2013-', 52, 18, 'Mahesh', 'Vora', 'mahesh@yahoo.com', '9871591595', 'Mahesh', 'Vora', 'VPN', 'Adajan', '', 'Surat', '395009', 'India', 99, 'Gujarat', 1485, 'Free Checkout', 'free_checkout', 'Mahesh', 'Vora', 'VPN', 'Adajan', '', 'Surat', '395009', 'India', 99, 'Gujarat', 1485, 'Flat Shipping Rate', 'flat.flat', '', '805.1', 14, '', 7, 'USD', '1', '2017-01-09 00:24:45', 0, '2017-01-09 00:24:45', 0, 0),
(27, 0, 'INV-2013-', 52, 18, 'Mahesh', 'Vora', 'mahesh@yahoo.com', '9871591595', 'Mahesh', 'Vora', 'VPN', 'Adajan', '', 'Surat', '395009', 'India', 99, 'Gujarat', 1485, 'Free Checkout', 'free_checkout', 'Mahesh', 'Vora', 'VPN', 'Adajan', '', 'Surat', '395009', 'India', 99, 'Gujarat', 1485, 'Flat Shipping Rate', 'flat.flat', '', '805.1', 14, '', 7, 'USD', '1', '2017-01-09 00:25:06', 0, '2017-01-09 00:25:06', 0, 0),
(28, 0, 'INV-2013-', 52, 18, 'Mahesh', 'Vora', 'mahesh@yahoo.com', '9871591595', 'Mahesh', 'Vora', 'VPN', 'Adajan', '', 'Surat', '395009', 'India', 99, 'Gujarat', 1485, 'Free Checkout', 'free_checkout', 'Mahesh', 'Vora', 'VPN', 'Adajan', '', 'Surat', '395009', 'India', 99, 'Gujarat', 1485, 'Flat Shipping Rate', 'flat.flat', '', '915.1', 14, '', 7, 'USD', '1', '2017-01-09 00:28:28', 0, '2017-01-09 00:28:28', 0, 0),
(29, 0, 'INV-2013-', 52, 18, 'Mahesh', 'Vora', 'mahesh@yahoo.com', '9871591595', 'Mahesh', 'Vora', 'VPN', 'Adajan', '', 'Surat', '395009', 'India', 99, 'Gujarat', 1485, 'Free Checkout', 'free_checkout', 'Mahesh', 'Vora', 'VPN', 'Adajan', '', 'Surat', '395009', 'India', 99, 'Gujarat', 1485, 'Flat Shipping Rate', 'flat.flat', '', '915.1', 14, '', 7, 'USD', '1', '2017-01-09 00:28:37', 0, '2017-01-09 00:28:37', 0, 0),
(30, 0, 'INV-2013-', 52, 18, 'Mahesh', 'Vora', 'mahesh@yahoo.com', '9871591595', 'Mahesh', 'Vora', 'VPN', 'Adajan', '', 'Surat', '395009', 'India', 99, 'Gujarat', 1485, 'Free Checkout', 'free_checkout', 'Mahesh', 'Vora', 'VPN', 'Adajan', '', 'Surat', '395009', 'India', 99, 'Gujarat', 1485, 'Flat Shipping Rate', 'flat.flat', '', '915.1', 14, '', 7, 'USD', '1', '2017-01-09 00:41:32', 0, '2017-01-09 00:41:32', 0, 0),
(31, 0, 'INV-2013-', 51, 18, 'Vinaykumar', 'Ghael', 'vr@vpninfotech.com', '0123456789', 'Vinaykumar', 'Ghael', 'VPN Infotech', 'Proton Plus', '', 'Surat', '395001', 'India', 99, 'Gujarat', 1485, 'Free Checkout', 'free_checkout', 'Vinaykumar', 'Ghael', 'VPN Infotech', 'Proton Plus', '', 'Surat', '395001', 'India', 99, 'Gujarat', 1485, 'Flat Shipping Rate', 'flat.flat', '', '285.1', 14, '', 7, 'USD', '1', '2017-01-11 22:32:23', 0, '2017-01-11 22:32:23', 0, 0),
(32, 0, 'INV-2013-', 45, 18, 'Indrajit', 'Kaplatiya', 'ik@vpninfotech.com', '9998591905', 'Indrajit', 'Kaplatiya', 'VPN', 'Surat', 'Navsari', 'Surat', '395009', 'India', 99, 'Gujarat', 1485, 'CCavenue', 'ccavenue', 'Indrajit', 'Kaplatiya', 'VPN', 'Surat', 'Navsari', 'Surat', '395009', 'India', 99, 'Gujarat', 1485, 'India  (Weight: 0.00gm)', 'weight.weight_99', '', '426', 0, '', 16, 'INR', '68.01200104', '2017-01-24 03:49:17', 0, '2017-01-24 03:49:17', 0, 0),
(33, 0, 'INV-2013-', 45, 18, 'Indrajit', 'Kaplatiya', 'ik@vpninfotech.com', '9998591905', 'Indrajit', 'Kaplatiya', 'VPN', 'Surat', 'Navsari', 'Surat', '395009', 'India', 99, 'Gujarat', 1485, 'CCavenue', 'ccavenue', 'Indrajit', 'Kaplatiya', 'VPN', 'Surat', 'Navsari', 'Surat', '395009', 'India', 99, 'Gujarat', 1485, 'India  (Weight: 0.00gm)', 'weight.weight_99', '', '426', 0, '', 16, 'INR', '68.01200104', '2017-01-24 03:54:40', 0, '2017-01-24 03:54:40', 0, 0),
(34, 0, 'INV-2013-', 45, 18, 'Indrajit', 'Kaplatiya', 'ik@vpninfotech.com', '9998591905', 'Indrajit', 'Kaplatiya', '', 'Dholikui', '', 'Surat', '394250', '', 99, 'Gujarat', 1485, 'PayPal', 'pp_standard', 'Indrajit', 'Kaplatiya', '', 'Dholikui', '', 'Surat', '394250', '', 99, 'Gujarat', 1485, 'India  (Weight: 0.00gm)', 'weight.weight_99', '', '426', 0, '', 16, 'INR', '68.01200104', '2017-01-24 03:57:12', 0, '2017-01-24 03:57:12', 0, 0),
(35, 0, 'INV-2013-', 45, 18, 'Indrajit', 'Kaplatiya', 'ik@vpninfotech.com', '9998591905', 'Indrajit', 'Kaplatiya', '', 'Dholikui', '', 'Surat', '394250', '', 99, 'Gujarat', 1485, 'Pickup From Store', 'free_checkout', 'Indrajit', 'Kaplatiya', '', 'Dholikui', '', 'Surat', '394250', '', 99, 'Gujarat', 1485, 'India  (Weight: 0.00gm)', 'weight.weight_99', '', '426', 8, '', 16, 'INR', '68.01200104', '2017-01-24 03:57:46', 0, '2017-01-24 03:57:46', 0, 0),
(36, 0, 'INV-2013-', 45, 18, 'Indrajit', 'Kaplatiya', 'ik@vpninfotech.com', '9998591905', 'Indrajit', 'Kaplatiya', '', 'Dholikui', '', 'Surat', '394250', '', 99, 'Gujarat', 1485, 'Pickup From Store', 'free_checkout', 'Indrajit', 'Kaplatiya', '', 'Dholikui', '', 'Surat', '394250', '', 99, 'Gujarat', 1485, 'India  (Weight: 0.00gm)', 'weight.weight_99', '', '426', 8, '', 16, 'INR', '68.01200104', '2017-01-24 03:58:41', 0, '2017-01-24 03:58:41', 0, 0),
(37, 0, 'INV-2013-', 49, 18, 'jay1', 'patel', 'pmvpnweb@gmail.com', '1232456', 'Jay', 'patel', 'abc', 'asdda', 'asdal', 'surat', '395006', 'India', 99, 'Gujarat', 1485, 'CCavenue', 'ccavenue', 'Jay', 'patel', 'abc', 'asdda', 'asdal', 'surat', '395006', 'India', 99, 'Gujarat', 1485, 'India  (Weight: 0.00gm)', 'weight.weight_99', '', '426', 0, '', 16, 'INR', '68.01200104', '2017-01-24 04:55:40', 0, '2017-01-24 04:55:40', 0, 0),
(38, 0, 'INV-2013-', 49, 18, 'jay1', 'patel', 'pmvpnweb@gmail.com', '1232456', 'Jay', 'patel', 'abc', 'asdda', 'asdal', 'surat', '395006', 'India', 99, 'Gujarat', 1485, 'CCavenue', 'ccavenue', 'Jay', 'patel', 'abc', 'asdda', 'asdal', 'surat', '395006', 'India', 99, 'Gujarat', 1485, 'India  (Weight: 0.00gm)', 'weight.weight_99', '', '426', 0, '', 16, 'INR', '68.01200104', '2017-01-24 04:57:46', 0, '2017-01-24 04:57:46', 0, 0),
(39, 0, 'INV-2013-', 45, 18, 'Indrajit', 'Kaplatiya', 'ik@vpninfotech.com', '9998591905', 'Indrajit', 'Kaplatiya', 'VPN', 'Surat', 'Navsari', 'Surat', '395006', 'India', 99, 'Gujarat', 1485, 'Pickup From Store', 'free_checkout', 'Indrajit', 'Kaplatiya', 'VPN', 'Surat', 'Navsari', 'Surat', '395006', 'India', 99, 'Gujarat', 1485, 'India  (Weight: 0.00gm)', 'weight.weight_99', '', '426', 7, '', 16, 'INR', '68.01200104', '2017-01-24 05:00:43', 0, '2017-01-24 05:00:43', 0, 0),
(40, 0, 'INV-2013-', 51, 18, 'Vinaykumar', 'Ghael', 'vr@vpninfotech.com', '0123456789', 'Vinaykumar', 'Ghael', 'VPN Infotech', 'Proton Plus', '', 'Surat', '395001', 'India', 99, 'Gujarat', 1485, 'Pickup From Store', 'free_checkout', 'Vinaykumar', 'Ghael', 'VPN Infotech', 'Proton Plus', '', 'Surat', '395001', 'India', 99, 'Gujarat', 1485, 'India  (Weight: 0.00gm)', 'weight.weight_99', '', '486', 14, '', 7, 'USD', '1', '2017-01-24 22:40:46', 0, '2017-01-24 22:40:46', 0, 0),
(41, 0, 'INV-2013-', 51, 0, 'Vinaykumar', 'Ghael', 'vr@vpninfotech.com', '0123456789', 'Vinaykumar', 'Ghael', 'VPN Infotech', 'Proton Plus', '', 'Surat', '395001', 'India', 99, 'Gujarat', 1485, 'CCavenue', 'ccavenue', 'Vinaykumar', 'Ghael', 'VPN Infotech', 'Proton Plus', '', 'Surat', '395001', 'India', 99, 'Gujarat', 1485, 'India  (Weight: 0.00gm)', 'weight.weight_99', '', '546', 0, '', 16, 'INR', '68.01200104', '2017-01-25 04:34:49', 0, '2017-01-25 04:34:49', 0, 0),
(42, 0, 'INV-2013-', 51, 0, 'Vinaykumar', 'Ghael', 'vr@vpninfotech.com', '0123456789', 'Vinaykumar', 'Ghael', 'VPN Infotech', 'Proton Plus', '', 'Surat', '395001', 'India', 99, 'Gujarat', 1485, 'Pickup From Store', 'free_checkout', 'Vinaykumar', 'Ghael', 'VPN Infotech', 'Proton Plus', '', 'Surat', '395001', 'India', 99, 'Gujarat', 1485, 'India  (Weight: 0.00gm)', 'weight.weight_99', '', '486', 14, '', 16, 'INR', '68.01200104', '2017-01-25 05:57:42', 0, '2017-01-25 05:57:42', 0, 0),
(43, 0, 'INV-2013-', 45, 18, 'Indrajit', 'Kaplatiya', 'ik@vpninfotech.com', '9998591905', 'Indrajit', 'Kaplatiya', '', 'Dholikui', '', 'Surat', '394250', 'India', 99, 'Gujarat', 1485, 'CCavenue', 'ccavenue', 'Indrajit', 'Kaplatiya', '', 'Dholikui', '', 'Surat', '394250', 'India', 99, 'Gujarat', 1485, 'India  (Weight: 0.00gm)', 'weight.weight_99', '', '6426', 0, '', 16, 'INR', '1', '2017-01-27 01:58:46', 0, '2017-01-27 01:58:46', 0, 0),
(44, 0, 'INV-2013-', 45, 18, 'Indrajit', 'Kaplatiya', 'ik@vpninfotech.com', '9998591905', 'Indrajit', 'Kaplatiya', '', 'Dholikui', '', 'Surat', '394250', 'India', 99, 'Gujarat', 1485, 'CCavenue', 'ccavenue', 'Indrajit', 'Kaplatiya', '', 'Dholikui', '', 'Surat', '394250', 'India', 99, 'Gujarat', 1485, 'India  (Weight: 0.00gm)', 'weight.weight_99', '', '6426', 0, '', 16, 'INR', '1', '2017-01-27 01:58:58', 0, '2017-01-27 01:58:58', 0, 0),
(45, 0, 'INV-2013-', 45, 18, 'Indrajit', 'Kaplatiya', 'ik@vpninfotech.com', '9998591905', 'Indrajit', 'Kaplatiya', '', 'Dholikui', '', 'Surat', '394250', 'India', 99, 'Gujarat', 1485, 'CCavenue', 'ccavenue', 'Indrajit', 'Kaplatiya', '', 'Dholikui', '', 'Surat', '394250', 'India', 99, 'Gujarat', 1485, 'India  (Weight: 0.00gm)', 'weight.weight_99', '', '6426', 0, '', 16, 'INR', '1', '2017-01-27 01:59:34', 0, '2017-01-27 01:59:34', 0, 0),
(46, 0, 'INV-2013-', 45, 18, 'Indrajit', 'Kaplatiya', 'ik@vpninfotech.com', '9998591905', 'Indrajit', 'Kaplatiya', '', 'Dholikui', '', 'Surat', '394250', 'India', 99, 'Gujarat', 1485, 'CCavenue', 'ccavenue', 'Indrajit', 'Kaplatiya', '', 'Dholikui', '', 'Surat', '394250', 'India', 99, 'Gujarat', 1485, 'India  (Weight: 0.00gm)', 'weight.weight_99', '', '6426', 0, '', 16, 'INR', '1', '2017-01-27 01:59:46', 0, '2017-01-27 01:59:46', 0, 0),
(47, 0, 'INV-2013-', 49, 18, 'jay1', 'patel', 'pmvpnweb@gmail.com', '1232456', 'czczx', 'zxzcc', '', 'zczxczxcz', '', 'czczczc', '395006', '', 99, 'Gujarat', 1485, 'CCavenue', 'ccavenue', 'czczx', 'zxzcc', '', 'zczxczxcz', '', 'czczczc', '395006', 'India', 99, 'Gujarat', 1485, 'India  (Weight: 0.00gm)', 'weight.weight_99', '', '4592.4', 0, '', 16, 'INR', '1', '2017-01-31 17:16:33', 0, '2017-01-31 17:16:33', 0, 0),
(48, 0, 'INV-2013-', 49, 18, 'jay1', 'patel', 'pmvpnweb@gmail.com', '1232456', 'czczx', 'zxzcc', '', 'zczxczxcz', '', 'czczczc', '395006', '', 99, 'Gujarat', 1485, 'CCavenue', 'ccavenue', 'czczx', 'zxzcc', '', 'zczxczxcz', '', 'czczczc', '395006', 'India', 99, 'Gujarat', 1485, 'India  (Weight: 0.00gm)', 'weight.weight_99', '', '4592.4', 0, '', 16, 'INR', '1', '2017-01-31 17:16:41', 0, '2017-01-31 17:16:41', 0, 0),
(49, 0, 'INV-2013-', 49, 18, 'jay1', 'patel', 'pmvpnweb@gmail.com', '1232456', 'czczx', 'zxzcc', '', 'zczxczxcz', '', 'czczczc', '395006', '', 99, 'Gujarat', 1485, 'CCavenue', 'ccavenue', 'czczx', 'zxzcc', '', 'zczxczxcz', '', 'czczczc', '395006', 'India', 99, 'Gujarat', 1485, 'India  (Weight: 0.00gm)', 'weight.weight_99', '', '4592.4', 0, '', 16, 'INR', '1', '2017-01-31 17:16:51', 0, '2017-01-31 17:16:51', 0, 0),
(50, 0, 'INV-2013-', 49, 18, 'jay1', 'patel', 'pmvpnweb@gmail.com', '1232456', 'fdgg', 'dfgdgdg', '', 'dfgdgd', '', 'baroda', '395003', 'India', 99, 'Gujarat', 1485, 'CCavenue', 'ccavenue', 'czczx', 'zxzcc', '', 'zczxczxcz', '', 'czczczc', '395006', 'India', 99, 'Gujarat', 1485, 'India  (Weight: 0.00gm)', 'weight.weight_99', '', '4592.4', 0, '', 16, 'INR', '1', '2017-01-31 17:24:18', 0, '2017-01-31 17:24:18', 0, 0),
(51, 0, 'INV-2013-', 49, 18, 'jay1', 'patel', 'pmvpnweb@gmail.com', '1232456', 'fdgg', 'dfgdgdg', '', 'dfgdgd', '', 'baroda', '395003', 'India', 99, 'Gujarat', 1485, 'CCavenue', 'ccavenue', 'czczx', 'zxzcc', '', 'zczxczxcz', '', 'czczczc', '395006', 'India', 99, 'Gujarat', 1485, 'India  (Weight: 0.00gm)', 'weight.weight_99', '', '4592.4', 0, '', 16, 'INR', '1', '2017-01-31 17:24:32', 0, '2017-01-31 17:24:32', 0, 0),
(52, 0, 'INV-2013-', 49, 18, 'jay1', 'patel', 'pmvpnweb@gmail.com', '1232456', 'fdgg', 'dfgdgdg', '', 'dfgdgd', '', 'baroda', '395003', 'India', 99, 'Gujarat', 1485, 'CCavenue', 'ccavenue', 'czczx', 'zxzcc', '', 'zczxczxcz', '', 'czczczc', '395006', 'India', 99, 'Gujarat', 1485, 'India  (Weight: 0.00gm)', 'weight.weight_99', '', '4592.4', 0, '', 16, 'INR', '1', '2017-01-31 17:26:30', 0, '2017-01-31 17:26:30', 0, 0),
(53, 0, 'INV-2013-', 49, 18, 'jay1', 'patel', 'pmvpnweb@gmail.com', '1232456', 'fdgg', 'dfgdgdg', '', 'dfgdgd', '', 'baroda', '395003', 'India', 99, 'Gujarat', 1485, 'CCavenue', 'ccavenue', 'czczx', 'zxzcc', '', 'zczxczxcz', '', 'czczczc', '395006', 'India', 99, 'Gujarat', 1485, 'India  (Weight: 0.00gm)', 'weight.weight_99', '', '4592.4', 0, '', 16, 'INR', '1', '2017-01-31 17:30:09', 0, '2017-01-31 17:30:09', 0, 0),
(54, 0, 'INV-2013-', 49, 18, 'jay1', 'patel', 'pmvpnweb@gmail.com', '1232456', 'fdgg', 'dfgdgdg', '', 'dfgdgd', '', 'baroda', '395003', 'India', 99, 'Gujarat', 1485, 'CCavenue', 'ccavenue', 'czczx', 'zxzcc', '', 'zczxczxcz', '', 'czczczc', '395006', 'India', 99, 'Gujarat', 1485, 'India  (Weight: 0.00gm)', 'weight.weight_99', '', '4592.4', 0, '', 16, 'INR', '1', '2017-01-31 17:35:00', 0, '2017-01-31 17:35:00', 0, 0),
(55, 0, 'INV-2013-', 49, 18, 'jay1', 'patel', 'pmvpnweb@gmail.com', '1232456', 'fdgg', 'dfgdgdg', '', 'dfgdgd', '', 'baroda', '395003', 'India', 99, 'Gujarat', 1485, 'CCavenue', 'ccavenue', 'czczx', 'zxzcc', '', 'zczxczxcz', '', 'czczczc', '395006', 'India', 99, 'Gujarat', 1485, 'India  (Weight: 0.00gm)', 'weight.weight_99', '', '4592.4', 0, '', 16, 'INR', '1', '2017-01-31 17:35:35', 0, '2017-01-31 17:35:35', 0, 0),
(56, 0, 'INV-2013-', 49, 18, 'jay1', 'patel', 'pmvpnweb@gmail.com', '1232456', 'fdgg', 'dfgdgdg', '', 'dfgdgd', '', 'baroda', '395003', 'India', 99, 'Gujarat', 1485, 'CCavenue', 'ccavenue', 'czczx', 'zxzcc', '', 'zczxczxcz', '', 'czczczc', '395006', 'India', 99, 'Gujarat', 1485, 'India  (Weight: 0.00gm)', 'weight.weight_99', '', '4592.4', 0, '', 16, 'INR', '1', '2017-01-31 17:35:41', 0, '2017-01-31 17:35:41', 0, 0),
(57, 0, 'INV-2013-', 49, 18, 'jay1', 'patel', 'pmvpnweb@gmail.com', '1232456', 'czczx', 'zxzcc', '', 'zczxczxcz', '', 'czczczc', '395006', 'India', 99, 'Gujarat', 1485, 'CCavenue', 'ccavenue', 'czczx', 'zxzcc', '', 'zczxczxcz', '', 'czczczc', '395006', 'India', 99, 'Gujarat', 1485, 'India  (Weight: 0.00gm)', 'weight.weight_99', '', '4592.4', 0, '', 16, 'INR', '1', '2017-01-31 17:35:58', 0, '2017-01-31 17:35:58', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_history`
--

CREATE TABLE IF NOT EXISTS `order_history` (
  `order_history_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `order_status_id` int(11) NOT NULL,
  `notify` int(1) NOT NULL,
  `comment` text NOT NULL,
  `date_added` datetime NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=Enabled, 0=Disabled',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1 = softdeleted, 0 = not softdeleted'
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_history`
--

INSERT INTO `order_history` (`order_history_id`, `order_id`, `order_status_id`, `notify`, `comment`, `date_added`, `added_by`, `date_modified`, `modified_by`, `status`, `is_deleted`) VALUES
(63, 14, 14, 0, '', '2016-12-31 00:11:22', 0, '0000-00-00 00:00:00', 0, 1, 0),
(64, 14, 0, 0, '', '2016-12-31 00:12:34', 0, '0000-00-00 00:00:00', 0, 1, 0),
(65, 14, 14, 0, '', '2016-12-31 00:12:34', 0, '0000-00-00 00:00:00', 0, 1, 0),
(67, 16, 14, 0, '', '2016-12-31 02:12:22', 0, '0000-00-00 00:00:00', 0, 1, 0),
(70, 16, 11, 0, '', '2016-12-31 02:19:57', 0, '0000-00-00 00:00:00', 0, 1, 0),
(71, 16, 10, 0, '', '2016-12-31 02:20:16', 0, '0000-00-00 00:00:00', 0, 1, 0),
(72, 18, 14, 0, '', '2016-12-31 02:29:54', 0, '0000-00-00 00:00:00', 0, 1, 0),
(73, 19, 14, 0, '', '2016-12-31 02:55:07', 0, '0000-00-00 00:00:00', 0, 1, 0),
(74, 20, 14, 0, '', '2016-12-31 03:07:32', 0, '0000-00-00 00:00:00', 0, 1, 0),
(75, 21, 14, 0, '', '2016-12-31 03:27:33', 0, '0000-00-00 00:00:00', 0, 1, 0),
(80, 22, 14, 0, '', '2016-12-31 23:02:10', 0, '0000-00-00 00:00:00', 0, 1, 0),
(81, 22, 15, 1, 'jhjj', '2016-12-31 23:02:50', 0, '0000-00-00 00:00:00', 0, 1, 0),
(82, 23, 14, 0, '', '2017-01-02 21:52:29', 0, '0000-00-00 00:00:00', 0, 1, 0),
(83, 24, 14, 0, '', '2017-01-09 00:12:37', 0, '0000-00-00 00:00:00', 0, 1, 0),
(84, 25, 14, 0, '', '2017-01-09 00:12:49', 0, '0000-00-00 00:00:00', 0, 1, 0),
(85, 26, 14, 0, '', '2017-01-09 00:24:45', 0, '0000-00-00 00:00:00', 0, 1, 0),
(86, 27, 14, 0, '', '2017-01-09 00:25:06', 0, '0000-00-00 00:00:00', 0, 1, 0),
(87, 28, 14, 0, '', '2017-01-09 00:28:28', 0, '0000-00-00 00:00:00', 0, 1, 0),
(88, 29, 14, 0, '', '2017-01-09 00:28:37', 0, '0000-00-00 00:00:00', 0, 1, 0),
(89, 30, 14, 0, '', '2017-01-09 00:41:32', 0, '0000-00-00 00:00:00', 0, 1, 0),
(90, 31, 14, 0, '', '2017-01-11 22:32:23', 0, '0000-00-00 00:00:00', 0, 1, 0),
(91, 35, 8, 0, '', '2017-01-24 03:57:46', 0, '0000-00-00 00:00:00', 0, 1, 0),
(92, 36, 8, 0, '', '2017-01-24 03:58:41', 0, '0000-00-00 00:00:00', 0, 1, 0),
(93, 39, 14, 0, '', '2017-01-24 05:00:43', 0, '0000-00-00 00:00:00', 0, 1, 0),
(94, 40, 14, 0, '', '2017-01-24 22:40:46', 0, '0000-00-00 00:00:00', 0, 1, 0),
(101, 42, 14, 0, '', '2017-01-25 05:57:42', 0, '0000-00-00 00:00:00', 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_option`
--

CREATE TABLE IF NOT EXISTS `order_option` (
  `order_option_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `order_product_id` int(11) NOT NULL,
  `product_option_id` int(11) NOT NULL,
  `product_option_value_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  `is_deleted` int(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=158 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_option`
--

INSERT INTO `order_option` (`order_option_id`, `order_id`, `order_product_id`, `product_option_id`, `product_option_value_id`, `name`, `value`, `type`, `date_added`, `added_by`, `date_modified`, `modified_by`, `status`, `is_deleted`) VALUES
(101, 14, 33, 886, 844, 'Checkbox', 'Yellow', 'checkbox', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(102, 14, 33, 887, 0, 'Date', '2017-01-07', 'date', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(103, 14, 33, 888, 0, 'Date & time', '2016-12-31, 10:36:17', 'datetime', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(104, 14, 33, 889, 0, 'Delivery Date', '2017-01-06', 'date', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(105, 14, 33, 890, 846, 'Radio', 'Medium', 'radio', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(106, 14, 33, 891, 849, 'Size', 'Medium', 'select', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(119, 18, 37, 898, 861, 'Checkbox', 'Blue', 'checkbox', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(120, 18, 37, 899, 0, 'Date', '2017-01-07', 'date', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(121, 18, 37, 900, 0, 'Date & time', '2016-12-31, 10:36:17', 'datetime', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(122, 18, 37, 901, 0, 'Delivery Date', '2017-01-06', 'date', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(123, 18, 37, 902, 865, 'Radio', 'Large', 'radio', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(124, 18, 37, 903, 868, 'Size', 'Large', 'select', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(125, 19, 38, 911, 0, 'Date', '2017-01-07', 'date', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(126, 19, 38, 912, 0, 'Date & time', '2016-12-31, 10:36:17', 'datetime', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(127, 19, 38, 913, 0, 'Delivery Date', '2017-01-06', 'date', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(128, 20, 39, 923, 0, 'Date', '2017-01-07', 'date', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(129, 20, 39, 924, 0, 'Date & time', '2016-12-31, 10:36:17', 'datetime', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(130, 20, 39, 925, 0, 'Delivery Date', '2017-01-06', 'date', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(132, 22, 43, 812, 756, 'Checkbox', '', 'checkbox', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(133, 22, 44, 952, 951, 'Checkbox', 'Blue', 'checkbox', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(134, 22, 44, 953, 0, 'Date', '2017-01-07', 'date', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(135, 22, 44, 954, 0, 'Date & time', '2016-12-31, 10:36:17', 'datetime', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(136, 22, 44, 955, 0, 'Delivery Date', '2017-01-06', 'date', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(137, 22, 44, 956, 956, 'Radio', 'Medium', 'radio', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(138, 22, 44, 957, 959, 'Size', 'Medium', 'select', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(139, 23, 46, 964, 971, 'Checkbox', 'Blue', 'checkbox', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(140, 23, 46, 965, 0, 'Date', '2017-01-07', 'date', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(141, 23, 46, 966, 0, 'Date & time', '2016-12-31, 10:36:17', 'datetime', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(142, 23, 46, 967, 0, 'Delivery Date', '2017-01-06', 'date', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(143, 23, 46, 968, 975, 'Radio', 'Large', 'radio', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(144, 23, 46, 969, 979, 'Size', 'Medium', 'select', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(145, 24, 47, 973, 984, 'select', 'Blue', 'select', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(146, 25, 48, 973, 984, 'select', 'Blue', 'select', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(147, 26, 49, 975, 987, 'select', 'Blue', 'select', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(148, 26, 50, 976, 989, 'Size', 'Medium', 'select', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(149, 27, 51, 975, 987, 'select', 'Blue', 'select', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(150, 27, 52, 976, 989, 'Size', 'Medium', 'select', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(151, 28, 53, 975, 987, 'select', 'Blue', 'select', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(152, 29, 55, 975, 987, 'select', 'Blue', 'select', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(153, 30, 57, 975, 987, 'select', 'Blue', 'select', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(154, 43, 74, 1017, 1147, 'select', 'Orange', 'select', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(155, 44, 76, 1017, 1147, 'select', 'Orange', 'select', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(156, 45, 78, 1017, 1147, 'select', 'Orange', 'select', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(157, 46, 80, 1017, 1147, 'select', 'Orange', 'select', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_product`
--

CREATE TABLE IF NOT EXISTS `order_product` (
  `order_product_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `manufacturer_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` varchar(255) NOT NULL,
  `total` varchar(255) NOT NULL,
  `tax` varchar(255) NOT NULL,
  `reward` int(11) NOT NULL,
  `is_paid` int(1) NOT NULL,
  `paid` int(1) NOT NULL,
  `remaining` int(1) NOT NULL,
  `date_added` datetime NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  `is_deleted` int(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_product`
--

INSERT INTO `order_product` (`order_product_id`, `order_id`, `product_id`, `manufacturer_id`, `name`, `model`, `quantity`, `price`, `total`, `tax`, `reward`, `is_paid`, `paid`, `remaining`, `date_added`, `added_by`, `date_modified`, `modified_by`, `status`, `is_deleted`) VALUES
(33, 14, 19, 0, 'T-shirt', 't', 1, '140', '140', '0', 0, 0, 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(35, 16, 20, 0, 'bag', 'b1', 1, '400', '400', '0', 0, 0, 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(37, 18, 19, 0, 'T-shirt', 't', 1, '115', '115', '0', 0, 0, 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(38, 19, 19, 0, 'T-shirt', 't', 1, '100', '100', '0', 0, 0, 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(39, 20, 19, 0, 'T-shirt', 't', 1, '100', '100', '0', 0, 0, 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(40, 21, 19, 0, 'T-shirt', 't', 1, '100', '100', '22', 0, 0, 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(43, 22, 26, 0, 'admin product', 'A1', 1, '202', '202', '0', 0, 0, 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(44, 22, 19, 0, 'T-shirt', 't', 1, '125', '125', '27.5', 0, 0, 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(45, 23, 19, 0, 'T-shirt', 't', 1, '100', '100', '0', 0, 0, 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(46, 23, 19, 0, 'T-shirt', 't', 1, '120', '120', '0', 0, 0, 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(47, 24, 28, 0, 'Product1', 'Model Product1', 1, '300', '300', '0', 0, 0, 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(48, 25, 28, 0, 'Product1', 'Model Product1', 1, '300', '300', '0', 0, 0, 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(49, 26, 28, 0, 'Product1', 'Model Product1', 1, '300', '300', '0', 0, 0, 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(50, 26, 29, 0, 'Product2', 'Model Product2', 1, '500', '500', '0', 0, 0, 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(51, 27, 28, 0, 'Product1', 'Model Product1', 1, '300', '300', '0', 0, 0, 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(52, 27, 29, 0, 'Product2', 'Model Product2', 1, '500', '500', '0', 0, 0, 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(53, 28, 28, 0, 'Product1', 'Model Product1', 1, '300', '300', '0', 0, 0, 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(54, 28, 29, 0, 'Product2', 'Model Product2', 1, '500', '500', '110', 0, 0, 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(55, 29, 28, 0, 'Product1', 'Model Product1', 1, '300', '300', '0', 0, 0, 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(56, 29, 29, 0, 'Product2', 'Model Product2', 1, '500', '500', '110', 0, 0, 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(57, 30, 28, 0, 'Product1', 'Model Product1', 1, '300', '300', '0', 0, 0, 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(58, 30, 29, 0, 'Product2', 'Model Product2', 1, '500', '500', '110', 0, 0, 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(59, 31, 30, 0, 'SAMSUNG Galaxy J5 - 6 (New 2016 Edition) (Black, 16 GB)', 'p001', 2, '60', '120', '0', 0, 0, 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(60, 31, 31, 0, 'SAMSUNG Galaxy On Nxt (Gold, 32 GB)', 'p002', 1, '60', '60', '0', 0, 0, 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(61, 32, 47, 0, 'BLUE CHIFFON EMBROIDERY DESIGNER SAREE12', 'p005', 1, '60', '60', '0', 0, 0, 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(62, 33, 47, 0, 'BLUE CHIFFON EMBROIDERY DESIGNER SAREE12', 'p005', 1, '60', '60', '0', 0, 0, 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(63, 34, 47, 0, 'BLUE CHIFFON EMBROIDERY DESIGNER SAREE12', 'p005', 1, '60', '60', '0', 0, 0, 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(64, 35, 47, 0, 'BLUE CHIFFON EMBROIDERY DESIGNER SAREE12', 'p005', 1, '60', '60', '0', 0, 0, 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(65, 36, 47, 0, 'BLUE CHIFFON EMBROIDERY DESIGNER SAREE12', 'p005', 1, '60', '60', '0', 0, 0, 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(66, 37, 47, 0, 'BLUE CHIFFON EMBROIDERY DESIGNER SAREE12', 'p005', 1, '60', '60', '0', 0, 0, 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(67, 38, 47, 0, 'BLUE CHIFFON EMBROIDERY DESIGNER SAREE12', 'p005', 1, '60', '60', '0', 0, 0, 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(68, 39, 47, 0, 'BLUE CHIFFON EMBROIDERY DESIGNER SAREE12', 'p005', 1, '60', '60', '0', 0, 0, 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(69, 40, 34, 0, 'BLUE CHIFFON EMBROIDERY DESIGNER SAREE', 'p005', 2, '60', '120', '0', 0, 0, 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(70, 41, 34, 0, 'BLUE CHIFFON EMBROIDERY DESIGNER SAREE', 'p005', 3, '60', '180', '0', 0, 0, 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(71, 42, 36, 0, 'BLUE CHIFFON EMBROIDERY DESIGNER SAREE1', 'p005', 1, '60', '60', '0', 0, 0, 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(72, 42, 34, 0, 'BLUE CHIFFON EMBROIDERY DESIGNER SAREE', 'p005', 1, '60', '60', '0', 0, 0, 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(73, 43, 47, 0, 'BLUE CHIFFON EMBROIDERY DESIGNER SAREE12', 'p005', 1, '60', '60', '0', 0, 0, 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(74, 43, 115, 0, 'Aspiring Red Embroidered Work Jacquard Designer Saree', 'M112', 2, '3000', '6000', '0', 0, 0, 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(75, 44, 47, 0, 'BLUE CHIFFON EMBROIDERY DESIGNER SAREE12', 'p005', 1, '60', '60', '0', 0, 0, 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(76, 44, 115, 0, 'Aspiring Red Embroidered Work Jacquard Designer Saree', 'M112', 2, '3000', '6000', '0', 0, 0, 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(77, 45, 47, 0, 'BLUE CHIFFON EMBROIDERY DESIGNER SAREE12', 'p005', 1, '60', '60', '0', 0, 0, 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(78, 45, 115, 0, 'Aspiring Red Embroidered Work Jacquard Designer Saree', 'M112', 2, '3000', '6000', '0', 0, 0, 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(79, 46, 47, 0, 'BLUE CHIFFON EMBROIDERY DESIGNER SAREE12', 'p005', 1, '60', '60', '0', 0, 0, 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(80, 46, 115, 0, 'Aspiring Red Embroidered Work Jacquard Designer Saree', 'M112', 2, '3000', '6000', '0', 0, 0, 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(81, 47, 34, 0, 'Full Catalog : 100000', '100000-M002', 4, '1041.6', '4166.4', '0', 0, 0, 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(82, 47, 46, 0, 'BLUE CHIFFON EMBROIDERY DESIGNER SAREE11', 'p005', 1, '60', '60', '0', 0, 0, 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(83, 48, 34, 0, 'Full Catalog : 100000', '100000-M002', 4, '1041.6', '4166.4', '0', 0, 0, 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(84, 48, 46, 0, 'BLUE CHIFFON EMBROIDERY DESIGNER SAREE11', 'p005', 1, '60', '60', '0', 0, 0, 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(85, 49, 34, 0, 'Full Catalog : 100000', '100000-M002', 4, '1041.6', '4166.4', '0', 0, 0, 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(86, 49, 46, 0, 'BLUE CHIFFON EMBROIDERY DESIGNER SAREE11', 'p005', 1, '60', '60', '0', 0, 0, 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(87, 50, 34, 0, 'Full Catalog : 100000', '100000-M002', 4, '1041.6', '4166.4', '0', 0, 0, 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(88, 50, 46, 0, 'BLUE CHIFFON EMBROIDERY DESIGNER SAREE11', 'p005', 1, '60', '60', '0', 0, 0, 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(89, 51, 34, 0, 'Full Catalog : 100000', '100000-M002', 4, '1041.6', '4166.4', '0', 0, 0, 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(90, 51, 46, 0, 'BLUE CHIFFON EMBROIDERY DESIGNER SAREE11', 'p005', 1, '60', '60', '0', 0, 0, 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(91, 52, 34, 0, 'Full Catalog : 100000', '100000-M002', 4, '1041.6', '4166.4', '0', 0, 0, 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(92, 52, 46, 0, 'BLUE CHIFFON EMBROIDERY DESIGNER SAREE11', 'p005', 1, '60', '60', '0', 0, 0, 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(93, 53, 34, 0, 'Full Catalog : 100000', '100000-M002', 4, '1041.6', '4166.4', '0', 0, 0, 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(94, 53, 46, 0, 'BLUE CHIFFON EMBROIDERY DESIGNER SAREE11', 'p005', 1, '60', '60', '0', 0, 0, 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(95, 54, 34, 0, 'Full Catalog : 100000', '100000-M002', 4, '1041.6', '4166.4', '0', 0, 0, 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(96, 54, 46, 0, 'BLUE CHIFFON EMBROIDERY DESIGNER SAREE11', 'p005', 1, '60', '60', '0', 0, 0, 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(97, 55, 34, 0, 'Full Catalog : 100000', '100000-M002', 4, '1041.6', '4166.4', '0', 0, 0, 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(98, 55, 46, 0, 'BLUE CHIFFON EMBROIDERY DESIGNER SAREE11', 'p005', 1, '60', '60', '0', 0, 0, 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(99, 56, 34, 0, 'Full Catalog : 100000', '100000-M002', 4, '1041.6', '4166.4', '0', 0, 0, 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(100, 56, 46, 0, 'BLUE CHIFFON EMBROIDERY DESIGNER SAREE11', 'p005', 1, '60', '60', '0', 0, 0, 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(101, 57, 34, 0, 'Full Catalog : 100000', '100000-M002', 4, '1041.6', '4166.4', '0', 0, 0, 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(102, 57, 46, 0, 'BLUE CHIFFON EMBROIDERY DESIGNER SAREE11', 'p005', 1, '60', '60', '0', 0, 0, 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE IF NOT EXISTS `order_status` (
  `order_status_id` int(11) NOT NULL,
  `order_status_name` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `status` int(1) NOT NULL COMMENT '1=Enabled, 0=Disabled',
  `is_deleted` int(1) NOT NULL COMMENT '1 = softdeleted, 0 = not softdeleted'
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`order_status_id`, `order_status_name`, `date_added`, `added_by`, `date_modified`, `modified_by`, `status`, `is_deleted`) VALUES
(7, 'Canceled', '2016-11-30 12:05:13', 1, '2016-12-10 06:24:44', 1, 0, 1),
(8, 'Canceled Reversal', '2016-11-30 12:05:26', 1, '2016-11-30 12:05:26', 1, 0, 0),
(9, 'Chargeback', '2016-11-30 12:05:35', 1, '2016-11-30 12:05:35', 1, 0, 0),
(10, 'Complete', '2016-11-30 12:05:45', 1, '2016-11-30 12:05:45', 1, 0, 0),
(11, 'Denied', '2016-11-30 12:05:55', 1, '2016-12-17 05:58:24', 17, 0, 0),
(12, 'Expired', '2016-11-30 12:06:04', 1, '2016-11-30 12:06:04', 1, 0, 0),
(13, 'Failed', '2016-11-30 12:06:13', 1, '2016-12-17 05:55:40', 1, 0, 0),
(14, 'Pending', '2016-11-30 12:06:29', 1, '2016-11-30 12:06:29', 1, 0, 0),
(15, 'Processed', '2016-11-30 12:06:38', 1, '2016-11-30 12:06:38', 1, 0, 0),
(16, 'Processing', '2016-11-30 12:06:46', 1, '2016-11-30 12:06:46', 1, 0, 0),
(17, 'Refunded', '2016-11-30 12:06:56', 1, '2016-11-30 12:06:56', 1, 0, 0),
(18, 'Reversed', '2016-11-30 12:07:04', 1, '2016-11-30 12:07:04', 1, 0, 0),
(19, 'Shipped', '2016-11-30 12:07:18', 1, '2016-11-30 12:07:18', 1, 0, 0),
(20, 'Voided', '2016-11-30 12:07:27', 1, '2016-11-30 12:07:27', 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_total`
--

CREATE TABLE IF NOT EXISTS `order_total` (
  `order_total_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  `is_deleted` int(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=256 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_total`
--

INSERT INTO `order_total` (`order_total_id`, `order_id`, `code`, `title`, `value`, `date_added`, `added_by`, `date_modified`, `modified_by`, `status`, `is_deleted`) VALUES
(61, 16, 'sub_total', 'Sub-Total', '400', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(62, 16, 'shipping', 'Flat Shipping Rate', '5', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(63, 16, 'tax', 'Eco Tax (-2.00)', '0.1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(64, 16, 'total', 'Order Totals', '405.1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(68, 18, 'sub_total', 'Sub-Total', '115', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(69, 18, 'shipping', 'Flat Shipping Rate', '5', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(70, 18, 'tax', 'Eco Tax (-2.00)', '0.1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(71, 18, 'total', 'Order Totals', '120.1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(72, 19, 'sub_total', 'Sub-Total', '100', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(73, 19, 'shipping', 'Flat Shipping Rate', '5', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(74, 19, 'tax', 'Eco Tax (-2.00)', '0.1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(75, 19, 'total', 'Order Totals', '105.1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(76, 20, 'sub_total', 'Sub-Total', '100', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(77, 20, 'shipping', 'Flat Shipping Rate', '5', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(78, 20, 'tax', 'Eco Tax (-2.00)', '0.1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(79, 20, 'total', 'Order Totals', '105.1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(80, 21, 'sub_total', 'Sub-Total', '100', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(81, 21, 'tax', 'Eco Tax (-2.00)', '2', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(82, 21, 'tax', 'VAT (20%)', '20', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(83, 21, 'total', 'Order Totals', '122', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(84, 22, 'sub_total', 'Sub-Total', '327', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(85, 22, 'shipping', 'Flat Shipping Rate', '5', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(86, 22, 'tax', 'Eco Tax (-2.00)', '2.6', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(87, 22, 'tax', 'VAT (20%)', '25', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(88, 22, 'total', 'Order Totals', '359.6', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(89, 23, 'sub_total', 'Sub-Total', '220', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(90, 23, 'total', 'Order Totals', '220', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(91, 24, 'sub_total', 'Sub-Total', '300', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(92, 24, 'shipping', 'Flat Shipping Rate', '5', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(93, 24, 'tax', 'Eco Tax (-2.00)', '0.1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(94, 24, 'total', 'Order Totals', '305.1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(95, 25, 'sub_total', 'Sub-Total', '300', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(96, 25, 'shipping', 'Flat Shipping Rate', '5', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(97, 25, 'tax', 'Eco Tax (-2.00)', '0.1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(98, 25, 'total', 'Order Totals', '305.1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(99, 26, 'sub_total', 'Sub-Total', '800', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(100, 26, 'shipping', 'Flat Shipping Rate', '5', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(101, 26, 'tax', 'Eco Tax (-2.00)', '0.1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(102, 26, 'total', 'Order Totals', '805.1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(103, 27, 'sub_total', 'Sub-Total', '800', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(104, 27, 'shipping', 'Flat Shipping Rate', '5', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(105, 27, 'tax', 'Eco Tax (-2.00)', '0.1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(106, 27, 'total', 'Order Totals', '805.1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(107, 28, 'sub_total', 'Sub-Total', '800', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(108, 28, 'shipping', 'Flat Shipping Rate', '5', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(109, 28, 'tax', 'Eco Tax (-2.00)', '10.1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(110, 28, 'tax', 'VAT (20%)', '100', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(111, 28, 'total', 'Order Totals', '915.1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(112, 29, 'sub_total', 'Sub-Total', '800', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(113, 29, 'shipping', 'Flat Shipping Rate', '5', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(114, 29, 'tax', 'Eco Tax (-2.00)', '10.1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(115, 29, 'tax', 'VAT (20%)', '100', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(116, 29, 'total', 'Order Totals', '915.1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(117, 30, 'sub_total', 'Sub-Total', '800', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(118, 30, 'shipping', 'Flat Shipping Rate', '5', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(119, 30, 'tax', 'Eco Tax (-2.00)', '10.1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(120, 30, 'tax', 'VAT (20%)', '100', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(121, 30, 'total', 'Order Totals', '915.1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(122, 31, 'sub_total', 'Sub-Total', '280', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(123, 31, 'shipping', 'Flat Shipping Rate', '5', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(124, 31, 'tax', 'Eco Tax (-2.00)', '0.1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(125, 31, 'total', 'Order Totals', '285.1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(126, 32, 'sub_total', 'Sub-Total', '60', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(127, 32, 'shipping', 'India  (Weight: 0.00gm)', '300', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(128, 32, 'tax', 'Eco Tax (-2.00)', '6', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(129, 32, 'tax', 'VAT (20%)', '60', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(130, 32, 'total', 'Order Totals', '426', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(131, 33, 'sub_total', 'Sub-Total', '60', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(132, 33, 'shipping', 'India  (Weight: 0.00gm)', '300', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(133, 33, 'tax', 'Eco Tax (-2.00)', '6', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(134, 33, 'tax', 'VAT (20%)', '60', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(135, 33, 'total', 'Order Totals', '426', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(136, 34, 'sub_total', 'Sub-Total', '60', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(137, 34, 'shipping', 'India  (Weight: 0.00gm)', '300', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(138, 34, 'tax', 'Eco Tax (-2.00)', '6', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(139, 34, 'tax', 'VAT (20%)', '60', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(140, 34, 'total', 'Order Totals', '426', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(141, 35, 'sub_total', 'Sub-Total', '60', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(142, 35, 'shipping', 'India  (Weight: 0.00gm)', '300', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(143, 35, 'tax', 'Eco Tax (-2.00)', '6', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(144, 35, 'tax', 'VAT (20%)', '60', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(145, 35, 'total', 'Order Totals', '426', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(146, 36, 'sub_total', 'Sub-Total', '60', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(147, 36, 'shipping', 'India  (Weight: 0.00gm)', '300', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(148, 36, 'tax', 'Eco Tax (-2.00)', '6', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(149, 36, 'tax', 'VAT (20%)', '60', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(150, 36, 'total', 'Order Totals', '426', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(151, 37, 'sub_total', 'Sub-Total', '60', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(152, 37, 'shipping', 'India  (Weight: 0.00gm)', '300', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(153, 37, 'tax', 'Eco Tax (-2.00)', '6', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(154, 37, 'tax', 'VAT (20%)', '60', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(155, 37, 'total', 'Order Totals', '426', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(156, 38, 'sub_total', 'Sub-Total', '60', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(157, 38, 'shipping', 'India  (Weight: 0.00gm)', '300', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(158, 38, 'tax', 'Eco Tax (-2.00)', '6', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(159, 38, 'tax', 'VAT (20%)', '60', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(160, 38, 'total', 'Order Totals', '426', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(161, 39, 'sub_total', 'Sub-Total', '60', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(162, 39, 'shipping', 'India  (Weight: 0.00gm)', '300', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(163, 39, 'tax', 'Eco Tax (-2.00)', '6', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(164, 39, 'tax', 'VAT (20%)', '60', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(165, 39, 'total', 'Order Totals', '426', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(166, 40, 'sub_total', 'Sub-Total', '120', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(167, 40, 'shipping', 'India  (Weight: 0.00gm)', '300', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(168, 40, 'tax', 'Eco Tax (-2.00)', '6', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(169, 40, 'tax', 'VAT (20%)', '60', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(170, 40, 'total', 'Order Totals', '486', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(171, 41, 'sub_total', 'Sub-Total', '180', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(172, 41, 'shipping', 'India  (Weight: 0.00gm)', '300', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(173, 41, 'tax', 'Eco Tax (-2.00)', '6', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(174, 41, 'tax', 'VAT (20%)', '60', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(175, 41, 'total', 'Order Totals', '546', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(176, 42, 'sub_total', 'Sub-Total', '120', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(177, 42, 'shipping', 'India  (Weight: 0.00gm)', '300', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(178, 42, 'tax', 'Eco Tax (-2.00)', '6', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(179, 42, 'tax', 'VAT (20%)', '60', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(180, 42, 'total', 'Order Totals', '486', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(181, 43, 'sub_total', 'Sub-Total', '6060', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(182, 43, 'shipping', 'India  (Weight: 0.00gm)', '300', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(183, 43, 'tax', 'Eco Tax (-2.00)', '6', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(184, 43, 'tax', 'VAT (20%)', '60', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(185, 43, 'total', 'Order Totals', '6426', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(186, 44, 'sub_total', 'Sub-Total', '6060', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(187, 44, 'shipping', 'India  (Weight: 0.00gm)', '300', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(188, 44, 'tax', 'Eco Tax (-2.00)', '6', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(189, 44, 'tax', 'VAT (20%)', '60', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(190, 44, 'total', 'Order Totals', '6426', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(191, 45, 'sub_total', 'Sub-Total', '6060', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(192, 45, 'shipping', 'India  (Weight: 0.00gm)', '300', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(193, 45, 'tax', 'Eco Tax (-2.00)', '6', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(194, 45, 'tax', 'VAT (20%)', '60', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(195, 45, 'total', 'Order Totals', '6426', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(196, 46, 'sub_total', 'Sub-Total', '6060', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(197, 46, 'shipping', 'India  (Weight: 0.00gm)', '300', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(198, 46, 'tax', 'Eco Tax (-2.00)', '6', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(199, 46, 'tax', 'VAT (20%)', '60', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(200, 46, 'total', 'Order Totals', '6426', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(201, 47, 'sub_total', 'Sub-Total', '4226.4', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(202, 47, 'shipping', 'India  (Weight: 0.00gm)', '300', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(203, 47, 'tax', 'Eco Tax (-2.00)', '6', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(204, 47, 'tax', 'VAT (20%)', '60', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(205, 47, 'total', 'Order Totals', '4592.4', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(206, 48, 'sub_total', 'Sub-Total', '4226.4', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(207, 48, 'shipping', 'India  (Weight: 0.00gm)', '300', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(208, 48, 'tax', 'Eco Tax (-2.00)', '6', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(209, 48, 'tax', 'VAT (20%)', '60', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(210, 48, 'total', 'Order Totals', '4592.4', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(211, 49, 'sub_total', 'Sub-Total', '4226.4', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(212, 49, 'shipping', 'India  (Weight: 0.00gm)', '300', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(213, 49, 'tax', 'Eco Tax (-2.00)', '6', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(214, 49, 'tax', 'VAT (20%)', '60', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(215, 49, 'total', 'Order Totals', '4592.4', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(216, 50, 'sub_total', 'Sub-Total', '4226.4', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(217, 50, 'shipping', 'India  (Weight: 0.00gm)', '300', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(218, 50, 'tax', 'Eco Tax (-2.00)', '6', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(219, 50, 'tax', 'VAT (20%)', '60', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(220, 50, 'total', 'Order Totals', '4592.4', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(221, 51, 'sub_total', 'Sub-Total', '4226.4', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(222, 51, 'shipping', 'India  (Weight: 0.00gm)', '300', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(223, 51, 'tax', 'Eco Tax (-2.00)', '6', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(224, 51, 'tax', 'VAT (20%)', '60', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(225, 51, 'total', 'Order Totals', '4592.4', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(226, 52, 'sub_total', 'Sub-Total', '4226.4', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(227, 52, 'shipping', 'India  (Weight: 0.00gm)', '300', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(228, 52, 'tax', 'Eco Tax (-2.00)', '6', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(229, 52, 'tax', 'VAT (20%)', '60', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(230, 52, 'total', 'Order Totals', '4592.4', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(231, 53, 'sub_total', 'Sub-Total', '4226.4', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(232, 53, 'shipping', 'India  (Weight: 0.00gm)', '300', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(233, 53, 'tax', 'Eco Tax (-2.00)', '6', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(234, 53, 'tax', 'VAT (20%)', '60', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(235, 53, 'total', 'Order Totals', '4592.4', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(236, 54, 'sub_total', 'Sub-Total', '4226.4', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(237, 54, 'shipping', 'India  (Weight: 0.00gm)', '300', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(238, 54, 'tax', 'Eco Tax (-2.00)', '6', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(239, 54, 'tax', 'VAT (20%)', '60', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(240, 54, 'total', 'Order Totals', '4592.4', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(241, 55, 'sub_total', 'Sub-Total', '4226.4', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(242, 55, 'shipping', 'India  (Weight: 0.00gm)', '300', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(243, 55, 'tax', 'Eco Tax (-2.00)', '6', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(244, 55, 'tax', 'VAT (20%)', '60', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(245, 55, 'total', 'Order Totals', '4592.4', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(246, 56, 'sub_total', 'Sub-Total', '4226.4', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(247, 56, 'shipping', 'India  (Weight: 0.00gm)', '300', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(248, 56, 'tax', 'Eco Tax (-2.00)', '6', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(249, 56, 'tax', 'VAT (20%)', '60', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(250, 56, 'total', 'Order Totals', '4592.4', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(251, 57, 'sub_total', 'Sub-Total', '4226.4', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(252, 57, 'shipping', 'India  (Weight: 0.00gm)', '300', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(253, 57, 'tax', 'Eco Tax (-2.00)', '6', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(254, 57, 'tax', 'VAT (20%)', '60', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(255, 57, 'total', 'Order Totals', '4592.4', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_voucher`
--

CREATE TABLE IF NOT EXISTS `order_voucher` (
  `order_voucher_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `voucher_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `code` varchar(255) NOT NULL,
  `from_name` varchar(255) NOT NULL,
  `from_email` varchar(255) NOT NULL,
  `to_name` varchar(255) NOT NULL,
  `to_email` varchar(255) NOT NULL,
  `voucher_theme_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `amount` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  `is_deleted` int(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_voucher`
--

INSERT INTO `order_voucher` (`order_voucher_id`, `order_id`, `voucher_id`, `description`, `code`, `from_name`, `from_email`, `to_name`, `to_email`, `voucher_theme_id`, `message`, `amount`, `date_added`, `added_by`, `date_modified`, `modified_by`, `status`, `is_deleted`) VALUES
(4, 31, 17, '$100.00 Gift Certificate for Umesh Makwana', 'EWuGaxLTdz', 'Vinay Ghael', 'vr@vpninfotech.com', 'Umesh Makwana', 'umesh@gmail.com', 12, 'Happy Makarsankranti', '100', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `payment_method`
--

CREATE TABLE IF NOT EXISTS `payment_method` (
  `payment_method_id` int(11) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `payment_method_name` varchar(255) NOT NULL,
  `payment_code` varchar(255) NOT NULL,
  `rate` decimal(15,5) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_method`
--

INSERT INTO `payment_method` (`payment_method_id`, `icon`, `payment_method_name`, `payment_code`, `rate`, `status`) VALUES
(1, '', 'free_checkout', 'free_checkout', '1.00000', 1),
(2, 'payment/paypal.png', 'Paypal', 'pp_standard', '0.00000', 1),
(3, 'payment/ccavenue.png\r\n', 'CCavenue', 'ccavenue', '1.00000', 1),
(4, '', 'Pick & Pay', 'pick_pay', '0.00000', 1);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=Active, 0=Inactive'
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `created`, `modified`, `status`) VALUES
(1, 'Adding Google Map on Your Website within 5 Minutes', '', '2016-05-20 13:34:35', '2016-05-20 13:34:35', 1),
(2, 'Top Features of AngularJS that Sets it Apart from other Frameworks', '', '2016-05-20 13:34:35', '2016-05-20 13:34:35', 1),
(3, 'Get visitor location using HTML5 Geolocation API and PHP', '', '2016-05-20 13:34:35', '2016-05-20 13:34:35', 1),
(4, 'WordPress – How to Display Most Popular Posts by Views', '', '2016-05-20 13:34:35', '2016-05-20 13:34:35', 1),
(5, 'PayPal Payment Gateway Integration in CodeIgniter', '', '2016-05-20 13:34:35', '2016-05-20 13:34:35', 1),
(6, 'Drupal 8 Installation and Configuration Tutorial', '', '2016-05-20 13:34:35', '2016-05-20 13:34:35', 1),
(7, 'How to Create a MySQL Database in cPanel', '', '2016-05-20 13:34:35', '2016-05-20 13:34:35', 1),
(8, 'CakePHP Tutorial Part 3: Working with Elements and Layout', '', '2016-05-20 13:34:35', '2016-05-20 13:34:35', 1),
(9, 'Build an event calendar using jQuery, Ajax and PHP', '', '2016-05-20 13:34:35', '2016-05-20 13:34:35', 1),
(10, 'Disable mouse right click, cut, copy and paste using jQuery', '', '2016-05-20 13:34:35', '2016-05-20 13:34:35', 1),
(11, 'Dynamic Dependent Select Box using jQuery, Ajax and PHP', '', '2016-05-20 13:34:35', '2016-05-20 13:34:35', 1),
(12, 'Drupal Custom Module &mdash; Create database table during installation', '', '2016-05-20 13:34:35', '2016-05-20 13:34:35', 1),
(13, 'Redirect non-www to www & HTTP to HTTPS using .htaccess file', '', '2016-05-20 13:34:35', '2016-05-20 13:34:35', 1),
(14, 'PayPal Pro payment gateway integration in PHP', '', '2016-05-20 13:34:35', '2016-05-20 13:34:35', 1),
(15, 'Creating PayPal Sandbox Test Account and Website Payments Pro Account', '', '2016-05-20 13:34:35', '2016-05-20 13:34:35', 1),
(16, 'Add featured image or thumbnail to WordPress post', '', '2016-05-20 13:34:35', '2016-05-20 13:34:35', 1),
(17, 'Drupal custom module development tutorial', '', '2016-05-20 13:34:35', '2016-05-20 13:34:35', 1),
(18, 'Multi-Language implementation in CodeIgniter', '', '2016-05-20 13:34:35', '2016-05-20 13:34:35', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `product_id` int(11) NOT NULL,
  `manufacturer_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_description` text NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_description` text NOT NULL,
  `meta_keyword` varchar(255) NOT NULL,
  `product_tag` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `catalog_no` varchar(255) NOT NULL,
  `manufacture_catalog_no` varchar(255) NOT NULL,
  `manufacture_product_code` varchar(255) NOT NULL,
  `manufacture_catalog_name` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `sku` varchar(255) NOT NULL,
  `upc` varchar(255) NOT NULL,
  `ean` varchar(255) NOT NULL,
  `jan` varchar(255) NOT NULL,
  `isbn` varchar(255) NOT NULL,
  `mpn` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `price` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `manufacturer_price` varchar(255) NOT NULL,
  `tax_class_id` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `min_quantity` int(11) NOT NULL DEFAULT '1',
  `subtract_stock` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=Yes, 2=No',
  `stock_status_id` int(1) NOT NULL,
  `shipping` tinyint(1) NOT NULL DEFAULT '1',
  `seo_url` varchar(255) NOT NULL,
  `date_available` date NOT NULL DEFAULT '0000-00-00',
  `length` decimal(15,8) NOT NULL DEFAULT '0.00000000',
  `width` decimal(15,8) NOT NULL DEFAULT '0.00000000',
  `height` decimal(15,8) NOT NULL DEFAULT '0.00000000',
  `length_class` varchar(255) NOT NULL,
  `weight` decimal(15,8) NOT NULL DEFAULT '0.00000000',
  `weight_class` varchar(255) NOT NULL,
  `viewed` int(11) NOT NULL DEFAULT '0' COMMENT '0= no_view',
  `status` int(1) NOT NULL COMMENT '1=Enabled, 0=Disabled',
  `catalog_product` int(11) NOT NULL COMMENT '1 = display, 0 = not display',
  `sort_order` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `is_deleted` int(1) NOT NULL COMMENT '1 = softdeleted, 0 = not softdeleted'
) ENGINE=InnoDB AUTO_INCREMENT=131 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `manufacturer_id`, `product_name`, `product_description`, `meta_title`, `meta_description`, `meta_keyword`, `product_tag`, `image`, `catalog_no`, `manufacture_catalog_no`, `manufacture_product_code`, `manufacture_catalog_name`, `model`, `sku`, `upc`, `ean`, `jan`, `isbn`, `mpn`, `location`, `price`, `manufacturer_price`, `tax_class_id`, `quantity`, `min_quantity`, `subtract_stock`, `stock_status_id`, `shipping`, `seo_url`, `date_available`, `length`, `width`, `height`, `length_class`, `weight`, `weight_class`, `viewed`, `status`, `catalog_product`, `sort_order`, `date_added`, `added_by`, `date_modified`, `modified_by`, `is_deleted`) VALUES
(31, 0, 'SAMSUNG Galaxy On Nxt (Gold, 32 GB)', '<p><span style="color: rgb(33, 33, 33); font-family: Roboto, Arial, sans-serif; font-size: 18px;">SAMSUNG Galaxy On Nxt (Gold, 32 GB)</span><br></p>', 'SAMSUNG Galaxy On Nxt (Gold, 32 GB)', 'SAMSUNG Galaxy On Nxt (Gold, 32 GB)', 'SAMSUNG Galaxy On Nxt (Gold, 32 GB)', 'SAMSUNG Galaxy On Nxt (Gold, 32 GB)', 'catalog/products/saree2.jpg', 'p002', '', '', '', 'p002', '', '', '', '', '', '', '', '60.0000', '50', '0', 11, 1, 1, 21, 1, '', '2017-01-09', '0.00000000', '0.00000000', '0.00000000', '1', '0.00000000', '1', 0, 1, 0, 1, '2017-01-09 10:28:48', 17, '2017-01-17 11:06:01', 1, 0),
(32, 0, 'SAMSUNG Galaxy On8 (Gold, 16 GB)', '<p><span style="color: rgb(33, 33, 33); font-family: Roboto, Arial, sans-serif; font-size: 18px;">SAMSUNG Galaxy On8 (Gold, 16 GB)</span><br></p>', 'SAMSUNG Galaxy On8 (Gold, 16 GB)', 'SAMSUNG Galaxy On8 (Gold, 16 GB)', 'SAMSUNG Galaxy On8 (Gold, 16 GB)', 'SAMSUNG Galaxy On8 (Gold, 16 GB)', 'catalog/products/saree3.jpg', 'p003', '', '', '', 'p003', '', '', '', '', '', '', '', '60.0000', '50', '0', 10, 1, 1, 21, 1, '', '2017-01-09', '0.00000000', '0.00000000', '0.00000000', '1', '0.00000000', '1', 1, 1, 0, 1, '2017-01-09 10:31:51', 17, '2017-01-17 11:05:44', 1, 0),
(33, 0, 'SAMSUNG Z2 (Gold, 8 GB)', '<p><span style="color: rgb(33, 33, 33); font-family: Roboto, Arial, sans-serif; font-size: 18px;">SAMSUNG Z2 (Gold, 8 GB)</span><br></p>', 'SAMSUNG Z2 (Gold, 8 GB)', 'SAMSUNG Z2 (Gold, 8 GB)', 'SAMSUNG Z2 (Gold, 8 GB)', 'SAMSUNG Z2 (Gold, 8 GB)', 'catalog/products/saree4.jpg', 'p004', '', '', '', 'p004', '', '', '', '', '', '', '', '60.0000', '50', '0', 10, 1, 1, 21, 1, '', '2017-01-09', '0.00000000', '0.00000000', '0.00000000', '1', '0.00000000', '1', 9, 1, 0, 1, '2017-01-09 10:33:20', 17, '2017-01-17 11:21:15', 1, 0),
(34, 0, 'BLUE CHIFFON EMBROIDERY DESIGNER SAREE', '<h5 style="line-height: 1.5;"><span style="color: rgb(51, 55, 69); font-family: Ubuntu; font-size: 13px; background-color: rgb(244, 244, 244);">Casual Chiffon Designer Saree with Embroidery Design. Accompanied with Blouse which can be customised up to 44".</span></h5>', 'SAMSUNG Galaxy J7 Prime (Gold, 16 GB)', 'SAMSUNG Galaxy J7 Prime (Gold, 16 GB)', 'SAMSUNG Galaxy J7 Prime (Gold, 16 GB)', 'SAMSUNG Galaxy J7 Prime (Gold, 16 GB)', 'catalog/products/saree1.jpeg', '100000', '', 'm003', '', '100000-M002', '', '', '', '', '', '', '', '60.0000', '50', '0', 13, 1, 1, 21, 1, 'SAMSUNG-Galaxy-JSEVEN', '2017-01-09', '0.00000000', '0.00000000', '0.00000000', '1', '0.00000000', '1', 29, 1, 1, 1, '2017-01-09 10:35:57', 17, '2017-01-31 06:39:10', 1, 0),
(35, 0, 'BLUE CHIFFON EMBROIDERY DESIGNER SAREE2', '<h5 style="line-height: 1.5;"><span style="color: rgb(51, 55, 69); font-family: Ubuntu; font-size: 13px; background-color: rgb(244, 244, 244);">Casual Chiffon Designer Saree with Embroidery Design. Accompanied with Blouse which can be customised up to 44".</span></h5>', 'SAMSUNG Galaxy J7 Prime (Gold, 16 GB)', 'SAMSUNG Galaxy J7 Prime (Gold, 16 GB)', 'SAMSUNG Galaxy J7 Prime (Gold, 16 GB)', 'SAMSUNG Galaxy J7 Prime (Gold, 16 GB)', 'catalog/products/saree9.jpg', 'p005', '', '', '', 'p005', '', '', '', '', '', '', '', '60.0000', '50', '0', 10, 1, 1, 21, 1, '', '2017-01-09', '0.00000000', '0.00000000', '0.00000000', '1', '0.00000000', '1', 15, 1, 0, 1, '2017-01-09 10:35:57', 17, '2017-01-17 07:26:31', 1, 0),
(36, 0, 'BLUE CHIFFON EMBROIDERY DESIGNER SAREE1', '<h5 style="line-height: 1.5;"><span style="color: rgb(51, 55, 69); font-family: Ubuntu; font-size: 13px; background-color: rgb(244, 244, 244);">Casual Chiffon Designer Saree with Embroidery Design. Accompanied with Blouse which can be customised up to 44".</span></h5>', 'SAMSUNG Galaxy J7 Prime (Gold, 16 GB)', 'SAMSUNG Galaxy J7 Prime (Gold, 16 GB)', 'SAMSUNG Galaxy J7 Prime (Gold, 16 GB)', 'SAMSUNG Galaxy J7 Prime (Gold, 16 GB)', 'catalog/products/saree5.jpg', '100000', '', 'm004', '', '100000-M003', '', '', '', '', '', '', '', '60.0000', '50', '0', 11, 1, 1, 21, 1, 'BLUE-CHIFFON-EMBROIDERY-DESIGNER-SAREES', '2017-01-09', '0.00000000', '0.00000000', '0.00000000', '1', '0.00000000', '1', 31, 1, 1, 1, '2017-01-09 10:35:57', 17, '2017-01-31 06:39:24', 1, 0),
(37, 0, 'BLUE CHIFFON EMBROIDERY DESIGNER SAREE2', '<h5 style="line-height: 1.5;"><span style="color: rgb(51, 55, 69); font-family: Ubuntu; font-size: 13px; background-color: rgb(244, 244, 244);">Casual Chiffon Designer Saree with Embroidery Design. Accompanied with Blouse which can be customised up to 44".</span></h5>', 'SAMSUNG Galaxy J7 Prime (Gold, 16 GB)', 'SAMSUNG Galaxy J7 Prime (Gold, 16 GB)', 'SAMSUNG Galaxy J7 Prime (Gold, 16 GB)', 'SAMSUNG Galaxy J7 Prime (Gold, 16 GB)', 'catalog/products/saree10.jpg', 'p005', '', '', '', 'p005', '', '', '', '', '', '', '', '60.0000', '50', '0', 10, 1, 1, 21, 1, '', '2017-01-09', '0.00000000', '0.00000000', '0.00000000', '1', '0.00000000', '1', 17, 1, 0, 1, '2017-01-09 10:35:57', 17, '2017-01-17 07:26:23', 1, 0),
(38, 0, 'BLUE CHIFFON EMBROIDERY DESIGNER SAREE3', '<h5 style="line-height: 1.5;"><span style="color: rgb(51, 55, 69); font-family: Ubuntu; font-size: 13px; background-color: rgb(244, 244, 244);">Casual Chiffon Designer Saree with Embroidery Design. Accompanied with Blouse which can be customised up to 44".</span></h5>', 'SAMSUNG Galaxy J7 Prime (Gold, 16 GB)', 'SAMSUNG Galaxy J7 Prime (Gold, 16 GB)', 'SAMSUNG Galaxy J7 Prime (Gold, 16 GB)', 'SAMSUNG Galaxy J7 Prime (Gold, 16 GB)', 'catalog/products/saree11.jpg', 'p005', '', '', '', 'p005', '', '', '', '', '', '', '', '60.0000', '50', '0', 10, 1, 1, 21, 1, '', '2017-01-09', '0.00000000', '0.00000000', '0.00000000', '1', '0.00000000', '1', 22, 1, 0, 1, '2017-01-09 10:35:57', 17, '2017-01-17 07:49:35', 1, 0),
(39, 0, 'BLUE CHIFFON EMBROIDERY DESIGNER SAREE4', '<h5 style="line-height: 1.5;"><span style="color: rgb(51, 55, 69); font-family: Ubuntu; font-size: 13px; background-color: rgb(244, 244, 244);">Casual Chiffon Designer Saree with Embroidery Design. Accompanied with Blouse which can be customised up to 44".</span></h5>', 'SAMSUNG Galaxy J7 Prime (Gold, 16 GB)', 'SAMSUNG Galaxy J7 Prime (Gold, 16 GB)', 'SAMSUNG Galaxy J7 Prime (Gold, 16 GB)', 'SAMSUNG Galaxy J7 Prime (Gold, 16 GB)', 'catalog/products/saree12.jpg', 'p005', '', '', '', 'p005', '', '', '', '', '', '', '', '60.0000', '50', '0', 10, 1, 1, 21, 1, '', '2017-01-09', '0.00000000', '0.00000000', '0.00000000', '1', '0.00000000', '1', 15, 1, 0, 1, '2017-01-09 10:35:57', 17, '2017-01-17 07:26:07', 1, 0),
(40, 0, 'BLUE CHIFFON EMBROIDERY DESIGNER SAREE5', '<h5 style="line-height: 1.5;"><span style="color: rgb(51, 55, 69); font-family: Ubuntu; font-size: 13px; background-color: rgb(244, 244, 244);">Casual Chiffon Designer Saree with Embroidery Design. Accompanied with Blouse which can be customised up to 44".</span></h5>', 'SAMSUNG Galaxy J7 Prime (Gold, 16 GB)', 'SAMSUNG Galaxy J7 Prime (Gold, 16 GB)', 'SAMSUNG Galaxy J7 Prime (Gold, 16 GB)', 'SAMSUNG Galaxy J7 Prime (Gold, 16 GB)', 'catalog/products/saree13.jpeg', 'p005', '', '', '', 'p005', '', '', '', '', '', '', '', '60.0000', '50', '0', 10, 1, 1, 21, 1, '', '2017-01-09', '0.00000000', '0.00000000', '0.00000000', '1', '0.00000000', '1', 16, 1, 0, 1, '2017-01-09 10:35:57', 17, '2017-01-17 07:26:00', 1, 0),
(41, 0, 'BLUE CHIFFON EMBROIDERY DESIGNER SAREE6', '<h5 style="line-height: 1.5;"><span style="color: rgb(51, 55, 69); font-family: Ubuntu; font-size: 13px; background-color: rgb(244, 244, 244);">Casual Chiffon Designer Saree with Embroidery Design. Accompanied with Blouse which can be customised up to 44".</span></h5>', 'SAMSUNG Galaxy J7 Prime (Gold, 16 GB)', 'SAMSUNG Galaxy J7 Prime (Gold, 16 GB)', 'SAMSUNG Galaxy J7 Prime (Gold, 16 GB)', 'SAMSUNG Galaxy J7 Prime (Gold, 16 GB)', 'catalog/products/saree14.jpeg', 'p005', '', '', '', 'p005', '', '', '', '', '', '', '', '60.0000', '50', '0', 10, 1, 1, 21, 1, '', '2017-01-09', '0.00000000', '0.00000000', '0.00000000', '1', '0.00000000', '1', 20, 1, 0, 1, '2017-01-09 10:35:57', 17, '2017-01-17 11:07:28', 1, 0),
(42, 0, 'BLUE CHIFFON EMBROIDERY DESIGNER SAREE7', '<h5 style="line-height: 1.5;"><span style="color: rgb(51, 55, 69); font-family: Ubuntu; font-size: 13px; background-color: rgb(244, 244, 244);">Casual Chiffon Designer Saree with Embroidery Design. Accompanied with Blouse which can be customised up to 44".</span></h5>', 'SAMSUNG Galaxy J7 Prime (Gold, 16 GB)', 'SAMSUNG Galaxy J7 Prime (Gold, 16 GB)', 'SAMSUNG Galaxy J7 Prime (Gold, 16 GB)', 'SAMSUNG Galaxy J7 Prime (Gold, 16 GB)', 'catalog/products/saree15.jpg', 'p005', '', '', '', 'p005', '', '', '', '', '', '', '', '60.0000', '50', '0', 10, 1, 1, 21, 1, '', '2017-01-09', '0.00000000', '0.00000000', '0.00000000', '1', '0.00000000', '1', 15, 1, 0, 1, '2017-01-09 10:35:57', 17, '2017-01-17 11:06:57', 1, 0),
(43, 0, 'BLUE CHIFFON EMBROIDERY DESIGNER SAREE8', '<h5 style="line-height: 1.5;"><span style="color: rgb(51, 55, 69); font-family: Ubuntu; font-size: 13px; background-color: rgb(244, 244, 244);">Casual Chiffon Designer Saree with Embroidery Design. Accompanied with Blouse which can be customised up to 44".</span></h5>', 'SAMSUNG Galaxy J7 Prime (Gold, 16 GB)', 'SAMSUNG Galaxy J7 Prime (Gold, 16 GB)', 'SAMSUNG Galaxy J7 Prime (Gold, 16 GB)', 'SAMSUNG Galaxy J7 Prime (Gold, 16 GB)', 'catalog/products/saree16.jpg', 'p005', '', '', '', 'p005', '', '', '', '', '', '', '', '60.0000', '50', '0', 10, 1, 1, 21, 1, '', '2017-01-09', '0.00000000', '0.00000000', '0.00000000', '1', '0.00000000', '1', 15, 1, 0, 1, '2017-01-09 10:35:57', 17, '2017-01-17 11:06:39', 1, 0),
(44, 0, 'BLUE CHIFFON EMBROIDERY DESIGNER SAREE9', '<h5 style="line-height: 1.5;"><span style="color: rgb(51, 55, 69); font-family: Ubuntu; font-size: 13px; background-color: rgb(244, 244, 244);">Casual Chiffon Designer Saree with Embroidery Design. Accompanied with Blouse which can be customised up to 44".</span></h5>', 'SAMSUNG Galaxy J7 Prime (Gold, 16 GB)', 'SAMSUNG Galaxy J7 Prime (Gold, 16 GB)', 'SAMSUNG Galaxy J7 Prime (Gold, 16 GB)', 'SAMSUNG Galaxy J7 Prime (Gold, 16 GB)', 'catalog/products/saree1.jpeg', 'p005', '', '', '', 'p005', '', '', '', '', '', '', '', '60.0000', '50', '0', 10, 1, 1, 21, 1, '', '2017-01-09', '0.00000000', '0.00000000', '0.00000000', '1', '0.00000000', '1', 16, 1, 0, 1, '2017-01-09 10:35:57', 17, '2017-01-17 11:06:13', 1, 0),
(45, 0, 'BLUE CHIFFON EMBROIDERY DESIGNER SAREE10', '<h5 style="line-height: 1.5;"><span style="color: rgb(51, 55, 69); font-family: Ubuntu; font-size: 13px; background-color: rgb(244, 244, 244);">Casual Chiffon Designer Saree with Embroidery Design. Accompanied with Blouse which can be customised up to 44".</span></h5>', 'SAMSUNG Galaxy J7 Prime (Gold, 16 GB)', 'SAMSUNG Galaxy J7 Prime (Gold, 16 GB)', 'SAMSUNG Galaxy J7 Prime (Gold, 16 GB)', 'SAMSUNG Galaxy J7 Prime (Gold, 16 GB)', 'catalog/products/saree6.jpg', 'p005', '', '', '', 'p005', '', '', '', '', '', '', '', '60.0000', '50', '0', 10, 1, 1, 21, 1, '', '2017-01-09', '0.00000000', '0.00000000', '0.00000000', '1', '0.00000000', '1', 16, 1, 0, 1, '2017-01-09 10:35:57', 17, '2017-01-25 08:38:32', 17, 0),
(46, 0, 'BLUE CHIFFON EMBROIDERY DESIGNER SAREE11', '<h5 style="line-height: 1.5;"><span style="color: rgb(51, 55, 69); font-family: Ubuntu; font-size: 13px; background-color: rgb(244, 244, 244);">Casual Chiffon Designer Saree with Embroidery Design. Accompanied with Blouse which can be customised up to 44".</span></h5>', 'SAMSUNG Galaxy J7 Prime (Gold, 16 GB)', 'SAMSUNG Galaxy J7 Prime (Gold, 16 GB)', 'SAMSUNG Galaxy J7 Prime (Gold, 16 GB)', 'SAMSUNG Galaxy J7 Prime (Gold, 16 GB)', 'catalog/products/saree7.jpg', 'p005', '', '', '', 'p005', '', '', '', '', '', '', '', '60.0000', '50', '0', 10, 1, 1, 21, 1, '', '2017-01-09', '0.00000000', '0.00000000', '0.00000000', '1', '0.00000000', '1', 19, 1, 0, 1, '2017-01-09 10:35:57', 17, '2017-01-17 07:49:59', 1, 0),
(47, 0, 'BLUE CHIFFON EMBROIDERY DESIGNER SAREE12', '<h5 style="line-height: 1.5;"><span style="color: rgb(51, 55, 69); font-family: Ubuntu; font-size: 13px; background-color: rgb(244, 244, 244);">Casual Chiffon Designer Saree with Embroidery Design. Accompanied with Blouse which can be customised up to 44".</span></h5>', 'SAMSUNG Galaxy J7 Prime (Gold, 16 GB)', 'SAMSUNG Galaxy J7 Prime (Gold, 16 GB)', 'SAMSUNG Galaxy J7 Prime (Gold, 16 GB)', 'SAMSUNG Galaxy J7 Prime (Gold, 16 GB)', 'catalog/products/saree8.jpg', 'p005', '', '', '', 'p005', '', '', '', '', '', '', '', '60.0000', '50', '0', 13, 1, 1, 21, 1, '', '2017-01-09', '0.00000000', '0.00000000', '0.00000000', '1', '0.00000000', '1', 16, 1, 0, 1, '2017-01-09 10:35:57', 17, '2017-01-17 07:26:37', 1, 0),
(48, 0, 'Green Dress', '<p><br></p>', 'Green Dress', '', '', '', 'catalog/product1/green-printed-anarkali-knee-length-cotton-kurti-with-3-slash-4th-sleeves-product.jpg', 'green-dress-101', '', '', '', 'green-dress', 'S101', '', '', '', '', '', '', '1000.0000', '500', '0', 100, 1, 1, 21, 1, '', '0000-00-00', '0.00000000', '0.00000000', '0.00000000', '1', '0.00000000', '1', 0, 1, 0, 0, '2017-01-24 12:28:59', 1, '2017-01-25 04:07:56', 17, 0),
(115, 25, 'Aspiring Red Embroidered Work Jacquard Designer Saree', '<p><br></p>', 'Aspiring Red Embroidered Work Jacquard Designer Saree', '', '', '', 'catalog//aspiring-red-embroidered-work-jacquard-designer-saree-29602.jpg', '100000', '12', '112', 'MCN12', '100000-M001', 'S112', '', '', '', '', '', '', '1000.0000', '50', '0', 36, 1, 1, 21, 1, 'sadadddadd', '0000-00-00', '0.00000000', '0.00000000', '0.00000000', '1', '0.00000000', '1', 17, 1, 1, 0, '2017-01-25 04:59:56', 1, '2017-01-31 07:12:43', 1, 0),
(118, 11, 'Off White Color Pure Cotton Fabric Saware Kameez. ', '', '', '', '', '', 'catalog//green-printed-anarkali-knee-length-cotton-kurti-with-3-slash-4th-sleeves-product.jpg', '', '1', '101', 'MCN1', 'M101', 'S101', '', '', '', '', '', '', '1000.0000', '', '', 100, 1, 1, 0, 1, '', '0000-00-00', '0.00000000', '0.00000000', '0.00000000', '', '0.00000000', '', 0, 1, 0, 0, '2017-01-25 09:13:51', 1, '2017-01-25 09:17:16', 1, 0),
(119, 14, 'Stylish Georgette Patch Border Work Designer Saree', '', '', '', '', '', 'catalog//stylish-georgette-patch-border-work-designer-saree-29822.jpg', '', '2', '102', 'MCN2', 'M102', 'S102', '', '', '', '', '', '', '1500.0000', '', '', 50, 1, 1, 0, 1, '', '0000-00-00', '0.00000000', '0.00000000', '0.00000000', '', '0.00000000', '', 0, 1, 0, 0, '2017-01-25 09:13:53', 1, '2017-01-25 09:17:17', 1, 0),
(120, 17, 'Haute Georgette Blue Resham Work Designer Suit', '', '', '', '', '', 'catalog//haute-georgette-blue-resham-work-designer-suit-29832.jpg', '', '3', '103', 'MCN3', 'M103', 'S103', '', '', '', '', '', '', '2200.0000', '', '', 75, 1, 1, 0, 1, '', '0000-00-00', '0.00000000', '0.00000000', '0.00000000', '', '0.00000000', '', 0, 1, 0, 0, '2017-01-25 09:13:54', 1, '2017-01-25 09:17:17', 1, 0),
(121, 18, 'Radiant Resham Work Beige A Line Lehenga Choli', '', '', '', '', '', 'catalog//radiant-resham-work-beige-a-line-lehenga-choli-29843.jpg', '', '4', '104', 'MCN4', 'M104', 'S104', '', '', '', '', '', '', '1200.0000', '', '', 80, 1, 1, 0, 1, '', '0000-00-00', '0.00000000', '0.00000000', '0.00000000', '', '0.00000000', '', 0, 1, 0, 0, '2017-01-25 09:13:54', 1, '2017-01-25 09:17:18', 1, 0),
(122, 21, 'Dazzling Embroidered Work Anarkali Salwar Kameez', '', '', '', '', '', 'catalog//dazzling-embroidered-work-anarkali-salwar-kameez-29463.jpg', '', '5', '105', 'MCN5', 'M105', 'S105', '', '', '', '', '', '', '1700.0000', '', '', 68, 1, 1, 0, 1, '', '0000-00-00', '0.00000000', '0.00000000', '0.00000000', '', '0.00000000', '', 0, 1, 0, 0, '2017-01-25 09:13:54', 1, '2017-01-25 09:17:18', 1, 0),
(123, 25, 'Intricate Weight Less Patch Border Work Designer Saree', '', '', '', '', '', 'catalog//Ashika-Designer-Tussar-Silk-Saree-2769_1.jpg', '', '6', '106', 'MCN6', 'M106', 'S106', '', '', '', '', '', '', '2400.0000', '', '', 55, 1, 1, 0, 1, '', '0000-00-00', '0.00000000', '0.00000000', '0.00000000', '', '0.00000000', '', 0, 1, 0, 0, '2017-01-25 09:13:55', 1, '2017-01-25 09:17:19', 1, 0),
(124, 11, 'Intrinsic Patch Border Work Art Silk Designer Suit', '', '', '', '', '', 'catalog//Ashika-Designer-Embroidered-Cotton-Dress-Material-TANVI-B_1.jpg', '', '7', '107', 'MCN7', 'M107', 'S107', '', '', '', '', '', '', '2300.0000', '', '', 45, 1, 1, 0, 1, '', '0000-00-00', '0.00000000', '0.00000000', '0.00000000', '', '0.00000000', '', 0, 1, 0, 0, '2017-01-25 09:13:57', 1, '2017-01-25 09:17:21', 1, 0),
(125, 14, 'Imperial Net Patch Border Work A Line Lehenga Choli', '', '', '', '', '', 'catalog//Ashika-Designer-Oxford-Blue,-Pink-color-and-Velvet-409_1.jpg', '', '8', '108', 'MCN8', 'M108', 'S108', '', '', '', '', '', '', '2100.0000', '', '', 65, 1, 1, 0, 1, '', '0000-00-00', '0.00000000', '0.00000000', '0.00000000', '', '0.00000000', '', 0, 1, 0, 0, '2017-01-25 09:13:58', 1, '2017-01-25 09:17:22', 1, 0),
(126, 17, 'Congenial Hot Pink Jacquard Designer Saree', '', '', '', '', '', 'catalog//CV-MSARE38154087750--saree_sansar-Craftsvilla_1.jpg', '', '9', '109', 'MCN9', 'M109', 'S109', '', '', '', '', '', '', '2350.0000', '', '', 35, 1, 1, 0, 1, '', '0000-00-00', '0.00000000', '0.00000000', '0.00000000', '', '0.00000000', '', 0, 1, 0, 0, '2017-01-25 09:14:00', 1, '2017-01-25 09:17:24', 1, 0),
(127, 18, 'Grandiose Embroidered Work Designer A Line Lehenga Choli', '', '', '', '', '', 'catalog//CV-MTHAN85824555570--Thankar-Craftsvilla_1.jpg', '', '10', '110', 'MCN10', 'M110', 'S110', '', '', '', '', '', '', '1299.0000', '', '', 85, 1, 1, 0, 1, '', '0000-00-00', '0.00000000', '0.00000000', '0.00000000', '', '0.00000000', '', 0, 1, 0, 0, '2017-01-25 09:14:00', 1, '2017-01-25 09:17:24', 1, 0),
(128, 21, 'Hypnotizing Georgette Designer Saree', '', '', '', '', '', 'catalog//hypnotizing-georgette-designer-saree-29764.jpg', '', '11', '111', 'MCN11', 'M111', 'S111', '', '', '', '', '', '', '1499.0000', '', '', 35, 1, 1, 0, 1, '', '0000-00-00', '0.00000000', '0.00000000', '0.00000000', '', '0.00000000', '', 0, 1, 0, 0, '2017-01-25 09:14:01', 1, '2017-01-25 09:17:25', 1, 0),
(129, 11, 'Talismanic Net Beige A Line Lehenga Choli', '', '', '', '', '', 'catalog//talismanic-net-beige-a-line-lehenga-choli-29320.jpg', '', '13', '113', 'MCN13', 'M113', 'S113', '', '', '', '', '', '', '2500.0000', '', '', 55, 1, 1, 0, 1, '', '0000-00-00', '0.00000000', '0.00000000', '0.00000000', '', '0.00000000', '', 0, 1, 0, 0, '2017-01-25 09:14:01', 1, '2017-01-25 09:17:25', 1, 0),
(130, 14, 'Hypnotic Jacquard Embroidered Work Designer Saree', '', '', '', '', '', 'catalog//dazzling-multi-colour-lehenga-saree-29604.jpg', '', '14', '114', 'MCN14', 'M114', 'S114', '', '', '', '', '', '', '3200.0000', '', '', 90, 1, 1, 0, 1, '', '0000-00-00', '0.00000000', '0.00000000', '0.00000000', '', '0.00000000', '', 0, 1, 0, 0, '2017-01-25 09:14:01', 1, '2017-01-25 09:17:25', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_attribute`
--

CREATE TABLE IF NOT EXISTS `product_attribute` (
  `product_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_attribute`
--

INSERT INTO `product_attribute` (`product_id`, `attribute_id`, `text`) VALUES
(33, 13, 'dfggdg'),
(33, 10, 'sdfsdfsf'),
(0, 12, 'Dry Clean Only'),
(0, 12, 'Machine wash cold'),
(0, 12, 'Do not bleach'),
(0, 12, 'Tumble dry low'),
(0, 12, 'Dry Clean Only'),
(0, 12, 'Machine wash cold'),
(0, 12, 'Tumble dry low'),
(0, 12, 'Mild Iron'),
(0, 12, 'Tumble dry low'),
(0, 12, 'Do not bleach'),
(0, 12, 'Machine wash cold'),
(118, 12, 'Dry Clean Only'),
(119, 12, 'Machine wash cold'),
(120, 12, 'Do not bleach'),
(121, 12, 'Tumble dry low'),
(122, 12, 'Dry Clean Only'),
(123, 12, 'Machine wash cold'),
(124, 12, 'Tumble dry low'),
(125, 12, 'Mild Iron'),
(126, 12, 'Tumble dry low'),
(127, 12, 'Do not bleach'),
(128, 12, 'Machine wash cold'),
(129, 12, 'Tumble dry low'),
(130, 12, 'Do not bleach'),
(115, 17, 'Tumble dry low'),
(115, 12, 'Tumble dry low'),
(115, 12, 'Tumble dry low'),
(115, 12, 'Tumble dry low'),
(115, 12, 'Do not bleach'),
(115, 12, 'Tumble dry low');

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE IF NOT EXISTS `product_category` (
  `product_id` varchar(255) NOT NULL,
  `category_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`product_id`, `category_id`) VALUES
('37', '59'),
('38', '59'),
('38', '116'),
('38', '57'),
('38', '58'),
('46', '59'),
('46', '58'),
('46', '116'),
('32', '58'),
('32', '59'),
('32', '57'),
('32', '116'),
('31', '58'),
('31', '59'),
('31', '57'),
('31', '116'),
('44', '58'),
('44', '59'),
('44', '57'),
('44', '116'),
('43', '58'),
('43', '59'),
('43', '57'),
('43', '116'),
('42', '58'),
('42', '59'),
('42', '57'),
('42', '116'),
('41', '59'),
('41', '58'),
('41', '57'),
('41', '116'),
('33', '59'),
('33', '58'),
('33', '57'),
('33', '116'),
('48', '119'),
('48', '121'),
('45', '59'),
('45', '58'),
('45', '57'),
('118', '119'),
('118', '121'),
('119', '122'),
('120', '123'),
('121', '124'),
('122', '123'),
('123', '122'),
('124', '123'),
('125', '124'),
('126', '122'),
('127', '124'),
('128', '123'),
('129', '124'),
('130', '122'),
('34', '59'),
('34', '58'),
('34', '57'),
('34', '116'),
('34', '55'),
('34', '126'),
('34', '127'),
('34', '128'),
('36', '59'),
('36', '58'),
('36', '57'),
('36', '116'),
('36', '126'),
('36', '127'),
('36', '128'),
('115', '122'),
('115', '116'),
('115', '126'),
('115', '127'),
('115', '128');

-- --------------------------------------------------------

--
-- Table structure for table `product_discount`
--

CREATE TABLE IF NOT EXISTS `product_discount` (
  `product_discount_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `customer_group_id` int(11) NOT NULL,
  `quantity` int(4) NOT NULL DEFAULT '0',
  `priority` int(5) NOT NULL DEFAULT '1',
  `price` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `date_start` date NOT NULL DEFAULT '0000-00-00',
  `date_end` date NOT NULL DEFAULT '0000-00-00',
  `date_added` datetime NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1' COMMENT '1=Enabled, 0=Disabled',
  `is_deleted` int(1) NOT NULL DEFAULT '0' COMMENT '1 = softdeleted, 0 = not softdeleted'
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_discount`
--

INSERT INTO `product_discount` (`product_discount_id`, `product_id`, `customer_group_id`, `quantity`, `priority`, `price`, `date_start`, `date_end`, `date_added`, `added_by`, `date_modified`, `modified_by`, `status`, `is_deleted`) VALUES
(1, 0, 18, 1, 11, '10.0000', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(21, 118, 18, 1, 1, '5.0000', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(22, 119, 18, 1, 2, '10.0000', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(23, 120, 18, 1, 3, '15.0000', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(24, 121, 18, 1, 4, '10.0000', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(25, 122, 18, 1, 5, '10.0000', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(26, 123, 18, 1, 6, '10.0000', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(27, 124, 18, 1, 7, '10.0000', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(28, 125, 18, 1, 8, '10.0000', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(29, 126, 18, 1, 9, '20.0000', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(30, 127, 18, 1, 10, '10.0000', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(31, 128, 18, 1, 11, '10.0000', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(32, 129, 18, 1, 13, '10.0000', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(33, 130, 18, 1, 14, '100.0000', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_download`
--

CREATE TABLE IF NOT EXISTS `product_download` (
  `product_id` int(11) NOT NULL,
  `download_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_download`
--

INSERT INTO `product_download` (`product_id`, `download_id`) VALUES
(0, 48),
(118, 63),
(119, 64),
(120, 65),
(121, 66),
(122, 67),
(123, 68),
(124, 69),
(125, 70),
(126, 71),
(127, 72),
(128, 73),
(129, 75),
(130, 76),
(115, 74);

-- --------------------------------------------------------

--
-- Table structure for table `product_filter`
--

CREATE TABLE IF NOT EXISTS `product_filter` (
  `product_id` int(11) NOT NULL,
  `filter_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_filter`
--

INSERT INTO `product_filter` (`product_id`, `filter_id`) VALUES
(0, 118),
(0, 113),
(0, 117),
(0, 147),
(0, 115),
(0, 113),
(0, 140),
(0, 148),
(0, 113),
(0, 114),
(0, 149),
(0, 140),
(0, 141),
(0, 116),
(0, 150),
(0, 113),
(0, 142),
(0, 143),
(0, 119),
(0, 151),
(0, 120),
(0, 118),
(0, 142),
(0, 143),
(0, 152),
(0, 114),
(0, 113),
(0, 115),
(0, 153),
(0, 144),
(0, 142),
(0, 145),
(0, 117),
(0, 154),
(0, 118),
(0, 117),
(0, 114),
(0, 113),
(0, 155),
(0, 146),
(0, 113),
(0, 117),
(0, 118),
(0, 156),
(0, 115),
(0, 113),
(0, 140),
(0, 157),
(118, 118),
(118, 113),
(118, 117),
(118, 147),
(119, 115),
(119, 113),
(119, 140),
(119, 148),
(120, 113),
(120, 114),
(120, 149),
(121, 140),
(121, 141),
(121, 116),
(121, 150),
(122, 113),
(122, 142),
(122, 143),
(122, 119),
(122, 151),
(123, 120),
(123, 118),
(123, 142),
(123, 143),
(123, 152),
(124, 114),
(124, 113),
(124, 115),
(124, 153),
(125, 144),
(125, 142),
(125, 145),
(125, 117),
(125, 154),
(126, 118),
(126, 117),
(126, 114),
(126, 113),
(126, 155),
(127, 146),
(127, 113),
(127, 117),
(127, 118),
(127, 156),
(128, 115),
(128, 113),
(128, 140),
(128, 157),
(129, 120),
(129, 118),
(129, 142),
(129, 143),
(129, 159),
(130, 114),
(130, 113),
(130, 115),
(130, 160),
(34, 114),
(34, 135),
(34, 139),
(34, 123),
(34, 130),
(115, 113),
(115, 114),
(115, 158),
(115, 113),
(115, 114),
(115, 158),
(115, 120),
(115, 118),
(115, 142),
(115, 143),
(115, 159),
(115, 114),
(115, 113),
(115, 115),
(115, 160),
(115, 113),
(115, 114),
(115, 158);

-- --------------------------------------------------------

--
-- Table structure for table `product_image`
--

CREATE TABLE IF NOT EXISTS `product_image` (
  `product_image_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `sort_order` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=451 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_image`
--

INSERT INTO `product_image` (`product_image_id`, `product_id`, `image`, `sort_order`) VALUES
(43, 32, 'catalog/products/saree8.jpg', 0),
(44, 32, 'catalog/products/saree5.jpg', 0),
(45, 31, 'catalog/products/saree12.jpg', 0),
(46, 31, 'catalog/products/saree3.jpg', 0),
(47, 33, 'catalog/products/saree14.jpeg', 0),
(48, 33, 'catalog/products/saree1.jpeg', 0),
(157, 0, 'image/large/catchy-embroidered-work-net-lehenga-saree-29607.jpg', 5),
(158, 0, '70925/green-printed-anarkali-knee-length-cotton-kurti-with-3-slash-4th-sleeves-product.jpg1390744492.jpeg', 5),
(159, 0, 'image/cache/data/khadi-cotton-casual-wear-kurti-in-orange-colour-kr0630024-A-1200x1799.jpg', 10),
(160, 0, 'imagesq_tbn:ANd9GcQZS-CAnDv7CjIWYom2vCgqfUyBR8O00QI_KfCogxSepoaIg2jl7g.jpeg', 15),
(161, 0, 'p/Shakumbhari-White-Printed-Kurtis-2475-422613-1-pdp_slider_m_lr.jpg', 20),
(162, 0, 'images/thumimg/fashionplanetkurtis4_1_6x_885.JPG', 25),
(163, 0, 'image/cache/data/stylish-georgette-patch-border-work-designer-saree-29822-0-110x148.jpg', 5),
(164, 0, 'image/large/stylish-georgette-patch-border-work-designer-saree-29822.jpg', 10),
(165, 0, 'image/large/haute-georgette-blue-resham-work-designer-suit-29832.jpg', 5),
(166, 0, 'image/cache/data/haute-georgette-blue-resham-work-designer-suit-29832-0-110x148.jpg', 10),
(167, 0, 'image/large/radiant-resham-work-beige-a-line-lehenga-choli-29843.jpg', 5),
(168, 0, 'image/cache/data/radiant-resham-work-beige-a-line-lehenga-choli-29843-0-110x148.jpg', 10),
(169, 0, 'image/large/dazzling-embroidered-work-anarkali-salwar-kameez-29463.jpg', 5),
(170, 0, 'image/cache/data/dazzling-embroidered-work-anarkali-salwar-kameez-29463-0-110x148.jpg', 10),
(171, 0, 'images/Products/Large1/Ashika-Designer-Partywear-Saree-3021_1.jpg', 5),
(172, 0, 'images/Products/Large1/Maya-Viscose-half-and-half-party-wear-saree-7117_1.jpg', 10),
(173, 0, 'images/Products/Large1/Ashika-Designer-Saree-Red-color-and-Chiffon-Materi-1155_1.jpg', 15),
(174, 0, 'images/Products/Large1/Ashika-Designer-Tussar-Silk-Saree-2769_1.jpg', 20),
(175, 0, 'images/Products/Large1/Ashika-Designer-Embroidered-Cotton-Dress-Material-TANVI-B_1.jpg', 5),
(176, 0, 'images/Products/Large1/Ashika-Designer-Embroidered-Cotton-Dress-Material-SAKSHI-A_1.jpg', 10),
(177, 0, 'images/Products/Large1/Ashika-Designer-Embroidered-Cotton-Dress-Material-JEENAL-B_1.jpg', 15),
(178, 0, 'orig/C/V/CV-MSARE38154087750--saree_sansar-Craftsvilla_1.jpg', 5),
(179, 0, 'thumb/166x166/C/V/CV-MSARE38154087750--saree_sansar-Craftsvilla_1.jpg', 10),
(180, 0, 'thumb/166x166/C/V/CV-MSARE38154087750--saree_sansar-Craftsvilla_2.jpg', 15),
(181, 0, 'thumb/166x166/C/V/CV-MSARE38154087750--saree_sansar-Craftsvilla_3.jpg', 20),
(182, 0, 'orig/C/V/CV-MTHAN85824555570--Thankar-Craftsvilla_1.jpg', 5),
(183, 0, 'thumb/166x166/t/d/tdl108-jd04_2_1.jpg', 10),
(184, 0, 'thumb/166x166/t/d/tdl108-jd04-1_1.jpg', 15),
(185, 0, 'image/cache/data/intricate-weight-less-patch-border-work-designer-saree-26532-133x177.jpg', 5),
(186, 0, 'image/cache/data/imperial-net-patch-border-work-a-line-lehenga-choli-29844-133x177.jpg', 10),
(187, 0, 'image/large/aspiring-red-embroidered-work-jacquard-designer-saree-29602.jpg', 5),
(188, 0, 'image/large/hypnotic-jacquard-embroidered-work-designer-saree-29603.jpg', 10),
(189, 0, 'image/large/talismanic-net-beige-a-line-lehenga-choli-29320.jpg', 5),
(190, 0, 'image/cache/data/grandiose-embroidered-work-designer-a-line-lehenga-choli-28380-133x177.jpg', 10),
(273, 0, 'catalog/70925/green-printed-anarkali-knee-length-cotton-kurti-with-3-slash-4th-sleeves-product.jpg1390744492.jpeg', 5),
(274, 0, 'catalog/image/cache/data/khadi-cotton-casual-wear-kurti-in-orange-colour-kr0630024-A-1200x1799.jpg', 10),
(275, 0, 'catalog/imagesq_tbn:ANd9GcQZS-CAnDv7CjIWYom2vCgqfUyBR8O00QI_KfCogxSepoaIg2jl7g.jpeg', 15),
(276, 0, 'catalog/p/Shakumbhari-White-Printed-Kurtis-2475-422613-1-pdp_slider_m_lr.jpg', 20),
(277, 0, 'catalog/images/thumimg/fashionplanetkurtis4_1_6x_885.JPG', 25),
(278, 0, 'catalog/image/cache/data/stylish-georgette-patch-border-work-designer-saree-29822-0-110x148.jpg', 5),
(279, 0, 'catalog/image/large/stylish-georgette-patch-border-work-designer-saree-29822.jpg', 10),
(280, 0, 'catalog/image/large/haute-georgette-blue-resham-work-designer-suit-29832.jpg', 5),
(281, 0, 'catalog/image/cache/data/haute-georgette-blue-resham-work-designer-suit-29832-0-110x148.jpg', 10),
(282, 0, 'catalog/image/large/radiant-resham-work-beige-a-line-lehenga-choli-29843.jpg', 5),
(283, 0, 'catalog/image/cache/data/radiant-resham-work-beige-a-line-lehenga-choli-29843-0-110x148.jpg', 10),
(284, 0, 'catalog/image/large/dazzling-embroidered-work-anarkali-salwar-kameez-29463.jpg', 5),
(285, 0, 'catalog/image/cache/data/dazzling-embroidered-work-anarkali-salwar-kameez-29463-0-110x148.jpg', 10),
(286, 0, 'catalog/images/Products/Large1/Ashika-Designer-Partywear-Saree-3021_1.jpg', 5),
(287, 0, 'catalog/images/Products/Large1/Maya-Viscose-half-and-half-party-wear-saree-7117_1.jpg', 10),
(288, 0, 'catalog/images/Products/Large1/Ashika-Designer-Saree-Red-color-and-Chiffon-Materi-1155_1.jpg', 15),
(289, 0, 'catalog/images/Products/Large1/Ashika-Designer-Tussar-Silk-Saree-2769_1.jpg', 20),
(290, 0, 'catalog/images/Products/Large1/Ashika-Designer-Embroidered-Cotton-Dress-Material-TANVI-B_1.jpg', 5),
(291, 0, 'catalog/images/Products/Large1/Ashika-Designer-Embroidered-Cotton-Dress-Material-SAKSHI-A_1.jpg', 10),
(292, 0, 'catalog/images/Products/Large1/Ashika-Designer-Embroidered-Cotton-Dress-Material-JEENAL-B_1.jpg', 15),
(293, 0, 'catalog/orig/C/V/CV-MSARE38154087750--saree_sansar-Craftsvilla_1.jpg', 5),
(294, 0, 'catalog/thumb/166x166/C/V/CV-MSARE38154087750--saree_sansar-Craftsvilla_1.jpg', 10),
(295, 0, 'catalog/thumb/166x166/C/V/CV-MSARE38154087750--saree_sansar-Craftsvilla_2.jpg', 15),
(296, 0, 'catalog/thumb/166x166/C/V/CV-MSARE38154087750--saree_sansar-Craftsvilla_3.jpg', 20),
(297, 0, 'catalog/orig/C/V/CV-MTHAN85824555570--Thankar-Craftsvilla_1.jpg', 5),
(298, 0, 'catalog/thumb/166x166/t/d/tdl108-jd04_2_1.jpg', 10),
(299, 0, 'catalog/thumb/166x166/t/d/tdl108-jd04-1_1.jpg', 15),
(300, 0, 'catalog/image/cache/data/intricate-weight-less-patch-border-work-designer-saree-26532-133x177.jpg', 5),
(301, 0, 'catalog/image/cache/data/imperial-net-patch-border-work-a-line-lehenga-choli-29844-133x177.jpg', 10),
(308, 118, 'catalog/70925/green-printed-anarkali-knee-length-cotton-kurti-with-3-slash-4th-sleeves-product.jpg1390744492.jpeg', 5),
(309, 118, 'catalog/image/cache/data/khadi-cotton-casual-wear-kurti-in-orange-colour-kr0630024-A-1200x1799.jpg', 10),
(310, 118, 'catalog/imagesq_tbn:ANd9GcQZS-CAnDv7CjIWYom2vCgqfUyBR8O00QI_KfCogxSepoaIg2jl7g.jpeg', 15),
(311, 118, 'catalog/p/Shakumbhari-White-Printed-Kurtis-2475-422613-1-pdp_slider_m_lr.jpg', 20),
(312, 118, 'catalog/images/thumimg/fashionplanetkurtis4_1_6x_885.JPG', 25),
(313, 119, 'catalog/image/cache/data/stylish-georgette-patch-border-work-designer-saree-29822-0-110x148.jpg', 5),
(314, 119, 'catalog/image/large/stylish-georgette-patch-border-work-designer-saree-29822.jpg', 10),
(315, 120, 'catalog/image/large/haute-georgette-blue-resham-work-designer-suit-29832.jpg', 5),
(316, 120, 'catalog/image/cache/data/haute-georgette-blue-resham-work-designer-suit-29832-0-110x148.jpg', 10),
(317, 121, 'catalog/image/large/radiant-resham-work-beige-a-line-lehenga-choli-29843.jpg', 5),
(318, 121, 'catalog/image/cache/data/radiant-resham-work-beige-a-line-lehenga-choli-29843-0-110x148.jpg', 10),
(319, 122, 'catalog/image/large/dazzling-embroidered-work-anarkali-salwar-kameez-29463.jpg', 5),
(320, 122, 'catalog/image/cache/data/dazzling-embroidered-work-anarkali-salwar-kameez-29463-0-110x148.jpg', 10),
(321, 123, 'catalog/images/Products/Large1/Ashika-Designer-Partywear-Saree-3021_1.jpg', 5),
(322, 123, 'catalog/images/Products/Large1/Maya-Viscose-half-and-half-party-wear-saree-7117_1.jpg', 10),
(323, 123, 'catalog/images/Products/Large1/Ashika-Designer-Saree-Red-color-and-Chiffon-Materi-1155_1.jpg', 15),
(324, 123, 'catalog/images/Products/Large1/Ashika-Designer-Tussar-Silk-Saree-2769_1.jpg', 20),
(325, 124, 'catalog/images/Products/Large1/Ashika-Designer-Embroidered-Cotton-Dress-Material-TANVI-B_1.jpg', 5),
(326, 124, 'catalog/images/Products/Large1/Ashika-Designer-Embroidered-Cotton-Dress-Material-SAKSHI-A_1.jpg', 10),
(327, 124, 'catalog/images/Products/Large1/Ashika-Designer-Embroidered-Cotton-Dress-Material-JEENAL-B_1.jpg', 15),
(328, 126, 'catalog/orig/C/V/CV-MSARE38154087750--saree_sansar-Craftsvilla_1.jpg', 5),
(329, 126, 'catalog/thumb/166x166/C/V/CV-MSARE38154087750--saree_sansar-Craftsvilla_1.jpg', 10),
(330, 126, 'catalog/thumb/166x166/C/V/CV-MSARE38154087750--saree_sansar-Craftsvilla_2.jpg', 15),
(331, 126, 'catalog/thumb/166x166/C/V/CV-MSARE38154087750--saree_sansar-Craftsvilla_3.jpg', 20),
(332, 127, 'catalog/orig/C/V/CV-MTHAN85824555570--Thankar-Craftsvilla_1.jpg', 5),
(333, 127, 'catalog/thumb/166x166/t/d/tdl108-jd04_2_1.jpg', 10),
(334, 127, 'catalog/thumb/166x166/t/d/tdl108-jd04-1_1.jpg', 15),
(335, 128, 'catalog/image/cache/data/intricate-weight-less-patch-border-work-designer-saree-26532-133x177.jpg', 5),
(336, 128, 'catalog/image/cache/data/imperial-net-patch-border-work-a-line-lehenga-choli-29844-133x177.jpg', 10),
(337, 129, 'catalog/image/large/talismanic-net-beige-a-line-lehenga-choli-29320.jpg', 5),
(338, 129, 'catalog/image/cache/data/imperial-net-patch-border-work-a-line-lehenga-choli-29844-133x177.jpg', 10),
(339, 129, 'catalog/image/cache/data/grandiose-embroidered-work-designer-a-line-lehenga-choli-28380-133x177.jpg', 15),
(340, 130, 'catalog/image/large/catchy-embroidered-work-net-lehenga-saree-29607.jpg', 5),
(433, 34, 'catalog/products/saree11.jpg', 0),
(434, 34, 'catalog/products/saree4.jpg', 0),
(443, 115, '', 5),
(444, 115, 'catalog/image/large/aspiring-red-embroidered-work-jacquard-designer-saree-29602.jpg', 5),
(445, 115, 'catalog/image/large/talismanic-net-beige-a-line-lehenga-choli-29320.jpg', 5),
(446, 115, 'catalog/image/large/catchy-embroidered-work-net-lehenga-saree-29607.jpg', 5),
(447, 115, '', 10),
(448, 115, 'catalog/image/large/hypnotic-jacquard-embroidered-work-designer-saree-29603.jpg', 10),
(449, 115, 'catalog/image/cache/data/imperial-net-patch-border-work-a-line-lehenga-choli-29844-133x177.jpg', 10),
(450, 115, 'catalog/image/cache/data/grandiose-embroidered-work-designer-a-line-lehenga-choli-28380-133x177.jpg', 15);

-- --------------------------------------------------------

--
-- Table structure for table `product_option`
--

CREATE TABLE IF NOT EXISTS `product_option` (
  `product_option_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `option_id` int(11) NOT NULL,
  `value` text NOT NULL,
  `required` tinyint(1) NOT NULL,
  `date_added` datetime NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1' COMMENT '1=Enabled, 0=Disabled',
  `is_deleted` int(1) NOT NULL DEFAULT '0' COMMENT '1 = softdeleted, 0 = not softdeleted'
) ENGINE=InnoDB AUTO_INCREMENT=1026 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_option`
--

INSERT INTO `product_option` (`product_option_id`, `product_id`, `option_id`, `value`, `required`, `date_added`, `added_by`, `date_modified`, `modified_by`, `status`, `is_deleted`) VALUES
(37, 0, 18, '2016-11-30, 15:45:00', 1, '2016-11-29 10:14:51', 1, '2016-11-29 10:14:51', 1, 1, 0),
(39, 0, 17, '2016-11-30', 1, '2016-11-29 10:15:13', 1, '2016-11-29 10:15:13', 1, 1, 0),
(41, 0, 17, '', 1, '2016-11-29 10:34:49', 1, '2016-11-29 10:34:49', 1, 1, 0),
(42, 0, 18, '2016-11-29, 16:03:01', 1, '2016-11-29 10:34:49', 1, '2016-11-29 10:34:49', 1, 1, 0),
(43, 0, 19, '', 1, '2016-11-29 10:34:49', 1, '2016-11-29 10:34:49', 1, 1, 0),
(46, 0, 17, '', 1, '2016-11-29 10:35:53', 1, '2016-11-29 10:35:53', 1, 1, 0),
(47, 0, 19, '', 1, '2016-11-29 10:35:53', 1, '2016-11-29 10:35:53', 1, 1, 0),
(48, 0, 17, '', 1, '2016-11-29 10:35:53', 1, '2016-11-29 10:35:53', 1, 1, 0),
(49, 0, 17, '', 1, '2016-11-29 10:35:53', 1, '2016-11-29 10:35:53', 1, 1, 0),
(50, 0, 18, '', 1, '2016-11-29 10:35:53', 1, '2016-11-29 10:35:53', 1, 1, 0),
(980, 0, 16, 'Beige', 1, '2017-01-24 12:29:05', 0, '0000-00-00 00:00:00', 0, 1, 0),
(1000, 118, 16, 'Yellow', 1, '2017-01-25 09:17:16', 0, '0000-00-00 00:00:00', 0, 1, 0),
(1001, 119, 16, 'Beige', 1, '2017-01-25 09:17:17', 0, '0000-00-00 00:00:00', 0, 1, 0),
(1002, 120, 16, 'Green', 1, '2017-01-25 09:17:18', 0, '0000-00-00 00:00:00', 0, 1, 0),
(1003, 121, 16, 'Black', 1, '2017-01-25 09:17:18', 0, '0000-00-00 00:00:00', 0, 1, 0),
(1004, 122, 16, 'Purple', 1, '2017-01-25 09:17:18', 0, '0000-00-00 00:00:00', 0, 1, 0),
(1005, 123, 16, 'Gold', 1, '2017-01-25 09:17:21', 0, '0000-00-00 00:00:00', 0, 1, 0),
(1006, 124, 16, 'Blue', 1, '2017-01-25 09:17:22', 0, '0000-00-00 00:00:00', 0, 1, 0),
(1007, 125, 16, 'Yellow', 1, '2017-01-25 09:17:24', 0, '0000-00-00 00:00:00', 0, 1, 0),
(1008, 126, 16, 'Red', 1, '2017-01-25 09:17:24', 0, '0000-00-00 00:00:00', 0, 1, 0),
(1009, 127, 16, 'Pink', 1, '2017-01-25 09:17:25', 0, '0000-00-00 00:00:00', 0, 1, 0),
(1010, 128, 16, 'Beige', 1, '2017-01-25 09:17:25', 0, '0000-00-00 00:00:00', 0, 1, 0),
(1011, 129, 16, 'Gold', 1, '2017-01-25 09:17:25', 0, '0000-00-00 00:00:00', 0, 1, 0),
(1012, 130, 16, 'Blue', 1, '2017-01-25 09:17:26', 0, '0000-00-00 00:00:00', 0, 1, 0),
(1025, 115, 16, '', 1, '2017-01-31 07:12:44', 1, '2017-01-31 07:12:44', 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_option_value`
--

CREATE TABLE IF NOT EXISTS `product_option_value` (
  `product_option_value_id` int(11) NOT NULL,
  `product_option_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `option_id` int(11) NOT NULL,
  `option_value_id` int(11) NOT NULL,
  `quantity` int(5) NOT NULL,
  `subtract` tinyint(1) NOT NULL,
  `price` decimal(15,4) NOT NULL,
  `price_prefix` varchar(1) NOT NULL,
  `points` int(8) NOT NULL,
  `points_prefix` varchar(1) NOT NULL,
  `weight` decimal(15,8) NOT NULL,
  `weight_prefix` varchar(1) NOT NULL,
  `date_added` datetime NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1' COMMENT '1=Enabled, 0=Disabled',
  `is_deleted` int(1) NOT NULL DEFAULT '0' COMMENT '1 = softdeleted, 0 = not softdeleted'
) ENGINE=InnoDB AUTO_INCREMENT=1208 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_option_value`
--

INSERT INTO `product_option_value` (`product_option_value_id`, `product_option_id`, `product_id`, `option_id`, `option_value_id`, `quantity`, `subtract`, `price`, `price_prefix`, `points`, `points_prefix`, `weight`, `weight_prefix`, `date_added`, `added_by`, `date_modified`, `modified_by`, `status`, `is_deleted`) VALUES
(995, 980, 0, 16, 139, 0, 0, '0.0000', '', 0, '', '0.00000000', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(996, 980, 0, 16, 38, 0, 0, '0.0000', '', 0, '', '0.00000000', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(997, 980, 0, 16, 41, 0, 0, '0.0000', '', 0, '', '0.00000000', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(998, 980, 0, 16, 40, 0, 0, '0.0000', '', 0, '', '0.00000000', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(999, 980, 0, 16, 140, 0, 0, '0.0000', '', 0, '', '0.00000000', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(1000, 980, 0, 16, 39, 0, 0, '0.0000', '', 0, '', '0.00000000', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(1001, 980, 0, 16, 141, 0, 0, '0.0000', '', 0, '', '0.00000000', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(1002, 980, 0, 16, 142, 0, 0, '0.0000', '', 0, '', '0.00000000', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(1003, 980, 0, 16, 143, 0, 0, '0.0000', '', 0, '', '0.00000000', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(1004, 980, 0, 16, 144, 0, 0, '0.0000', '', 0, '', '0.00000000', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(1005, 980, 0, 16, 145, 0, 0, '0.0000', '', 0, '', '0.00000000', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(1006, 980, 0, 16, 146, 0, 0, '0.0000', '', 0, '', '0.00000000', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(1007, 980, 0, 16, 147, 0, 0, '0.0000', '', 0, '', '0.00000000', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(1008, 980, 0, 16, 148, 0, 0, '0.0000', '', 0, '', '0.00000000', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(1009, 980, 0, 16, 149, 0, 0, '0.0000', '', 0, '', '0.00000000', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(1073, 1000, 118, 16, 139, 0, 0, '0.0000', '', 0, '', '0.00000000', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(1074, 1000, 118, 16, 38, 0, 0, '0.0000', '', 0, '', '0.00000000', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(1075, 1000, 118, 16, 41, 0, 0, '0.0000', '', 0, '', '0.00000000', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(1076, 1001, 119, 16, 40, 0, 0, '0.0000', '', 0, '', '0.00000000', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(1077, 1001, 119, 16, 38, 0, 0, '0.0000', '', 0, '', '0.00000000', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(1078, 1001, 119, 16, 140, 0, 0, '0.0000', '', 0, '', '0.00000000', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(1079, 1002, 120, 16, 38, 0, 0, '0.0000', '', 0, '', '0.00000000', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(1080, 1002, 120, 16, 39, 0, 0, '0.0000', '', 0, '', '0.00000000', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(1081, 1003, 121, 16, 140, 0, 0, '0.0000', '', 0, '', '0.00000000', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(1082, 1003, 121, 16, 141, 0, 0, '0.0000', '', 0, '', '0.00000000', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(1083, 1003, 121, 16, 142, 0, 0, '0.0000', '', 0, '', '0.00000000', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(1084, 1004, 122, 16, 38, 0, 0, '0.0000', '', 0, '', '0.00000000', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(1085, 1004, 122, 16, 143, 0, 0, '0.0000', '', 0, '', '0.00000000', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(1086, 1004, 122, 16, 144, 0, 0, '0.0000', '', 0, '', '0.00000000', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(1087, 1004, 122, 16, 145, 0, 0, '0.0000', '', 0, '', '0.00000000', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(1088, 1005, 123, 16, 146, 0, 0, '0.0000', '', 0, '', '0.00000000', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(1089, 1005, 123, 16, 139, 0, 0, '0.0000', '', 0, '', '0.00000000', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(1090, 1005, 123, 16, 143, 0, 0, '0.0000', '', 0, '', '0.00000000', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(1091, 1005, 123, 16, 144, 0, 0, '0.0000', '', 0, '', '0.00000000', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(1092, 1006, 124, 16, 39, 0, 0, '0.0000', '', 0, '', '0.00000000', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(1093, 1006, 124, 16, 38, 0, 0, '0.0000', '', 0, '', '0.00000000', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(1094, 1006, 124, 16, 40, 0, 0, '0.0000', '', 0, '', '0.00000000', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(1095, 1007, 125, 16, 147, 0, 0, '0.0000', '', 0, '', '0.00000000', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(1096, 1007, 125, 16, 143, 0, 0, '0.0000', '', 0, '', '0.00000000', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(1097, 1007, 125, 16, 148, 0, 0, '0.0000', '', 0, '', '0.00000000', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(1098, 1007, 125, 16, 41, 0, 0, '0.0000', '', 0, '', '0.00000000', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(1099, 1008, 126, 16, 139, 0, 0, '0.0000', '', 0, '', '0.00000000', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(1100, 1008, 126, 16, 41, 0, 0, '0.0000', '', 0, '', '0.00000000', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(1101, 1008, 126, 16, 39, 0, 0, '0.0000', '', 0, '', '0.00000000', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(1102, 1008, 126, 16, 38, 0, 0, '0.0000', '', 0, '', '0.00000000', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(1103, 1009, 127, 16, 149, 0, 0, '0.0000', '', 0, '', '0.00000000', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(1104, 1009, 127, 16, 38, 0, 0, '0.0000', '', 0, '', '0.00000000', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(1105, 1009, 127, 16, 41, 0, 0, '0.0000', '', 0, '', '0.00000000', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(1106, 1009, 127, 16, 139, 0, 0, '0.0000', '', 0, '', '0.00000000', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(1107, 1010, 128, 16, 40, 0, 0, '0.0000', '', 0, '', '0.00000000', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(1108, 1010, 128, 16, 38, 0, 0, '0.0000', '', 0, '', '0.00000000', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(1109, 1010, 128, 16, 140, 0, 0, '0.0000', '', 0, '', '0.00000000', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(1110, 1011, 129, 16, 146, 0, 0, '0.0000', '', 0, '', '0.00000000', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(1111, 1011, 129, 16, 139, 0, 0, '0.0000', '', 0, '', '0.00000000', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(1112, 1011, 129, 16, 143, 0, 0, '0.0000', '', 0, '', '0.00000000', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(1113, 1011, 129, 16, 144, 0, 0, '0.0000', '', 0, '', '0.00000000', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(1114, 1012, 130, 16, 39, 0, 0, '0.0000', '', 0, '', '0.00000000', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(1115, 1012, 130, 16, 38, 0, 0, '0.0000', '', 0, '', '0.00000000', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(1116, 1012, 130, 16, 40, 0, 0, '0.0000', '', 0, '', '0.00000000', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(1201, 1025, 115, 16, 38, 0, 0, '0.0000', '+', 0, '+', '0.00000000', '+', '2017-01-31 07:12:44', 1, '2017-01-31 07:12:44', 1, 1, 0),
(1202, 1025, 115, 16, 39, 0, 0, '0.0000', '+', 0, '+', '0.00000000', '+', '2017-01-31 07:12:44', 1, '2017-01-31 07:12:44', 1, 1, 0),
(1203, 1025, 115, 16, 146, 0, 0, '0.0000', '+', 0, '+', '0.00000000', '+', '2017-01-31 07:12:44', 1, '2017-01-31 07:12:44', 1, 1, 0),
(1204, 1025, 115, 16, 139, 0, 0, '0.0000', '+', 0, '+', '0.00000000', '+', '2017-01-31 07:12:44', 1, '2017-01-31 07:12:44', 1, 1, 0),
(1205, 1025, 115, 16, 143, 0, 0, '0.0000', '+', 0, '+', '0.00000000', '+', '2017-01-31 07:12:44', 1, '2017-01-31 07:12:44', 1, 1, 0),
(1206, 1025, 115, 16, 144, 0, 0, '0.0000', '+', 0, '+', '0.00000000', '+', '2017-01-31 07:12:44', 1, '2017-01-31 07:12:44', 1, 1, 0),
(1207, 1025, 115, 16, 40, 0, 0, '0.0000', '+', 0, '+', '0.00000000', '+', '2017-01-31 07:12:45', 1, '2017-01-31 07:12:45', 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_related`
--

CREATE TABLE IF NOT EXISTS `product_related` (
  `product_id` int(11) NOT NULL,
  `related_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_special`
--

CREATE TABLE IF NOT EXISTS `product_special` (
  `product_special_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `customer_group_id` int(11) NOT NULL,
  `priority` int(5) NOT NULL DEFAULT '1',
  `price` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `date_start` date NOT NULL DEFAULT '0000-00-00',
  `date_end` date NOT NULL DEFAULT '0000-00-00',
  `date_added` datetime NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1' COMMENT '1=Enabled, 0=Disabled',
  `is_deleted` int(1) NOT NULL DEFAULT '0' COMMENT '1 = softdeleted, 0 = not softdeleted'
) ENGINE=InnoDB AUTO_INCREMENT=456 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_special`
--

INSERT INTO `product_special` (`product_special_id`, `product_id`, `customer_group_id`, `priority`, `price`, `date_start`, `date_end`, `date_added`, `added_by`, `date_modified`, `modified_by`, `status`, `is_deleted`) VALUES
(423, 0, 18, 11, '1499.0000', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(443, 118, 18, 1, '1000.0000', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(444, 119, 18, 2, '1500.0000', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(445, 120, 18, 3, '2200.0000', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(446, 121, 18, 4, '1200.0000', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(447, 122, 18, 5, '1700.0000', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(448, 123, 18, 6, '2400.0000', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(449, 124, 18, 7, '2300.0000', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(450, 125, 18, 8, '2100.0000', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(451, 126, 18, 9, '2350.0000', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(452, 127, 18, 10, '1299.0000', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(453, 128, 18, 11, '1499.0000', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(454, 129, 18, 13, '2500.0000', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0),
(455, 130, 18, 14, '3200.0000', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE IF NOT EXISTS `purchase` (
  `purchase_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `invoice_no` int(11) NOT NULL,
  `invoice_prefix` varchar(100) NOT NULL,
  `manufacturer_id` int(11) NOT NULL,
  `total` varchar(100) NOT NULL,
  `currency_id` int(11) NOT NULL,
  `currency_code` varchar(50) NOT NULL,
  `currency_value` varchar(100) NOT NULL,
  `order_status_id` int(11) NOT NULL COMMENT '1=received,0=not received',
  `payment_firstname` varchar(100) NOT NULL,
  `payment_lastname` varchar(100) NOT NULL,
  `payment_address_1` text NOT NULL,
  `payment_address_2` text NOT NULL,
  `payment_city` varchar(100) NOT NULL,
  `payment_postcode` varchar(100) NOT NULL,
  `payment_country` varchar(100) NOT NULL,
  `payment_country_id` int(11) NOT NULL,
  `payment_zone` varchar(100) NOT NULL,
  `state_id` int(11) NOT NULL,
  `payment_method` varchar(100) NOT NULL,
  `payment_code` varchar(100) NOT NULL,
  `payment_status` int(11) NOT NULL COMMENT '0=pending,1=done',
  `attachment` varchar(200) NOT NULL,
  `note` varchar(300) NOT NULL,
  `date_added` datetime NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '1=Enabled, 0=Disabled',
  `is_deleted` int(11) NOT NULL COMMENT '1 = softdeleted, 0 = not softdeleted'
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`purchase_id`, `order_id`, `invoice_no`, `invoice_prefix`, `manufacturer_id`, `total`, `currency_id`, `currency_code`, `currency_value`, `order_status_id`, `payment_firstname`, `payment_lastname`, `payment_address_1`, `payment_address_2`, `payment_city`, `payment_postcode`, `payment_country`, `payment_country_id`, `payment_zone`, `state_id`, `payment_method`, `payment_code`, `payment_status`, `attachment`, `note`, `date_added`, `added_by`, `date_modified`, `modified_by`, `status`, `is_deleted`) VALUES
(7, 11, 2, 'INV-2013-', 18, '600', 7, 'USD', '1.00000000', 1, 'Indrajit', 'Kaplatiya', 'Navsari', '', 'Surat', '395009', 'India', 99, 'Gujarat', 1485, 'free_checkout', 'free_checkout', 0, '', '', '2017-01-05 12:54:00', 1, '2017-01-05 12:54:00', 1, 0, 0),
(9, 25, 3, 'INV-2013-', 25, '200', 7, 'USD', '1.00000000', 1, 'Indrajit', 'Kaplatiya', 'Surat', '', 'Surat', '395009', 'India', 99, 'Gujarat', 1485, 'free_checkout', 'free_checkout', 1, '', '', '2017-01-09 07:57:17', 1, '2017-01-09 07:57:17', 1, 0, 0),
(10, 26, 4, 'INV-2013-', 25, '200', 7, 'USD', '1.00000000', 1, 'Indrajit', 'Kaplatiya', 'Surat', '', 'Surat', '395009', 'India', 99, 'Gujarat', 1485, 'free_checkout', 'free_checkout', 1, '', '', '2017-01-09 08:32:27', 1, '2017-01-09 08:32:27', 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_cart`
--

CREATE TABLE IF NOT EXISTS `purchase_cart` (
  `purchase_cart_id` int(11) NOT NULL,
  `manufacturer_id` int(11) NOT NULL,
  `session_id` varchar(255) NOT NULL,
  `product_id` int(11) NOT NULL,
  `option` text NOT NULL,
  `quantity` int(11) NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_history`
--

CREATE TABLE IF NOT EXISTS `purchase_history` (
  `purchase_history_id` int(11) NOT NULL,
  `purchase_id` int(11) NOT NULL,
  `order_status_id` int(11) NOT NULL,
  `notify` int(11) NOT NULL COMMENT '1=send mail,0=not send mail',
  `comment` text NOT NULL,
  `date_added` datetime NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '1=Enabled, 0=Disabled',
  `is_deleted` int(11) NOT NULL COMMENT '1 = softdeleted, 0 = not softdeleted'
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_history`
--

INSERT INTO `purchase_history` (`purchase_history_id`, `purchase_id`, `order_status_id`, `notify`, `comment`, `date_added`, `added_by`, `date_modified`, `modified_by`, `status`, `is_deleted`) VALUES
(17, 7, 1, 0, '''', '2017-01-05 12:53:33', 1, '2017-01-05 12:53:33', 1, 0, 0),
(18, 7, 1, 0, '''', '2017-01-05 12:54:00', 1, '2017-01-05 12:54:00', 1, 0, 0),
(21, 9, 1, 0, '''', '2017-01-09 07:57:17', 1, '2017-01-09 07:57:17', 1, 0, 0),
(22, 10, 1, 0, '''', '2017-01-09 08:32:27', 1, '2017-01-09 08:32:27', 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_option`
--

CREATE TABLE IF NOT EXISTS `purchase_option` (
  `purchase_option_id` int(11) NOT NULL,
  `purchase_id` int(11) NOT NULL,
  `purchase_product_id` int(11) NOT NULL,
  `product_option_id` int(11) NOT NULL,
  `product_option_value_id` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `value` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_option`
--

INSERT INTO `purchase_option` (`purchase_option_id`, `purchase_id`, `purchase_product_id`, `product_option_id`, `product_option_value_id`, `name`, `value`, `type`) VALUES
(61, 7, 13, 964, '971', 'Checkbox', 'Blue', 'checkbox'),
(62, 7, 13, 965, '0', 'Date', '2017-01-07', 'date'),
(63, 7, 13, 966, '0', 'Date & time', '2016-12-31, 10:36:17', 'datetime'),
(64, 7, 13, 967, '0', 'Delivery Date', '2017-01-06', 'date'),
(65, 7, 13, 968, '976', 'Radio', 'Medium', 'radio'),
(66, 7, 13, 969, '979', 'Size', 'Medium', 'select'),
(67, 7, 14, 964, '972', 'Checkbox', 'Marun', 'checkbox'),
(68, 7, 14, 965, '0', 'Date', '2017-01-07', 'date'),
(69, 7, 14, 966, '0', 'Date & time', '2016-12-31, 10:36:17', 'datetime'),
(70, 7, 14, 967, '0', 'Delivery Date', '2017-01-06', 'date'),
(71, 7, 14, 968, '975', 'Radio', 'Large', 'radio'),
(72, 7, 14, 969, '980', 'Size', 'Small', 'select'),
(79, 9, 16, 975, '987', 'select', 'Blue', 'select'),
(80, 10, 17, 975, '987', 'select', 'Blue', 'select');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_product`
--

CREATE TABLE IF NOT EXISTS `purchase_product` (
  `purchase_product_id` int(11) NOT NULL,
  `purchase_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `model` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` varchar(50) NOT NULL,
  `total` varchar(50) NOT NULL,
  `tax` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_product`
--

INSERT INTO `purchase_product` (`purchase_product_id`, `purchase_id`, `product_id`, `name`, `model`, `quantity`, `price`, `total`, `tax`) VALUES
(13, 7, 19, 'T-shirt', 't', 1, '300', '300', ''),
(14, 7, 19, 'T-shirt', 't', 1, '300', '300', ''),
(16, 9, 28, 'Product1', 'Model Product1', 1, '200', '200', ''),
(17, 10, 28, 'Product1', 'Model Product1', 1, '200', '200', '');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_return`
--

CREATE TABLE IF NOT EXISTS `purchase_return` (
  `purchase_return_id` int(11) NOT NULL,
  `purchase_id` int(11) NOT NULL,
  `purchase_order_id` int(11) NOT NULL,
  `purchase_product_id` int(11) NOT NULL,
  `manufacturer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `model` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` varchar(255) NOT NULL,
  `currency_id` int(11) NOT NULL,
  `currency_code` varchar(50) NOT NULL,
  `currency_value` varchar(100) NOT NULL,
  `opened` int(11) NOT NULL COMMENT '1=Yes,0=No',
  `return_reason_id` int(11) NOT NULL,
  `return_action_id` int(11) NOT NULL,
  `return_status_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `date_ordered` datetime NOT NULL,
  `date_added` datetime NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '1=Enabled, 0=Disabled',
  `is_deleted` int(11) NOT NULL COMMENT '1 = softdeleted, 0 = not softdeleted'
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_return`
--

INSERT INTO `purchase_return` (`purchase_return_id`, `purchase_id`, `purchase_order_id`, `purchase_product_id`, `manufacturer_id`, `product_id`, `product_name`, `model`, `quantity`, `total`, `currency_id`, `currency_code`, `currency_value`, `opened`, `return_reason_id`, `return_action_id`, `return_status_id`, `comment`, `date_ordered`, `date_added`, `added_by`, `date_modified`, `modified_by`, `status`, `is_deleted`) VALUES
(5, 7, 0, 13, 18, 19, 'T-shirt', 't', 1, '300', 7, 'USD', '1.00000000', 1, 3, 3, 5, '', '2017-01-05 12:54:46', '2017-01-05 12:54:46', 1, '2017-01-05 12:54:46', 1, 1, 0),
(7, 9, 25, 16, 25, 28, 'Product1', 'Model Product1', 1, '200', 7, 'USD', '1.00000000', 1, 5, 4, 6, '', '2017-01-09 07:57:42', '2017-01-09 07:57:42', 1, '2017-01-09 07:57:42', 1, 1, 0),
(8, 10, 26, 17, 25, 28, 'Product1', 'Model Product1', 1, '200', 7, 'USD', '1.00000000', 1, 5, 4, 6, '', '2017-01-09 08:32:57', '2017-01-09 08:32:57', 1, '2017-01-09 08:32:57', 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_return_history`
--

CREATE TABLE IF NOT EXISTS `purchase_return_history` (
  `return_history_id` int(11) NOT NULL,
  `purchase_return_id` int(11) NOT NULL,
  `return_status_id` int(11) NOT NULL,
  `notify` int(11) NOT NULL COMMENT '1=send mail,0=not send mail',
  `comment` text NOT NULL,
  `date_added` datetime NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '1=Enabled, 0=Disabled',
  `is_deleted` int(11) NOT NULL COMMENT '1 = softdeleted, 0 = not softdeleted'
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_return_history`
--

INSERT INTO `purchase_return_history` (`return_history_id`, `purchase_return_id`, `return_status_id`, `notify`, `comment`, `date_added`, `added_by`, `date_modified`, `modified_by`, `status`, `is_deleted`) VALUES
(9, 5, 1, 0, '', '2017-01-05 12:54:27', 1, '2017-01-05 12:54:27', 1, 0, 0),
(10, 5, 1, 0, '', '2017-01-05 12:54:46', 1, '2017-01-05 12:54:46', 1, 0, 0),
(12, 7, 1, 0, '', '2017-01-09 07:57:42', 1, '2017-01-09 07:57:42', 1, 0, 0),
(13, 8, 1, 0, '', '2017-01-09 08:32:57', 1, '2017-01-09 08:32:57', 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `return`
--

CREATE TABLE IF NOT EXISTS `return` (
  `return_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telephone` varchar(255) NOT NULL,
  `product` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `opened` int(1) NOT NULL,
  `return_reason_id` int(11) NOT NULL,
  `return_action_id` int(11) NOT NULL,
  `return_status_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `date_ordered` datetime NOT NULL,
  `date_added` datetime NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `is_deleted` int(1) NOT NULL COMMENT '1 = softdeleted, 0 = not softdeleted'
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `return`
--

INSERT INTO `return` (`return_id`, `order_id`, `product_id`, `customer_id`, `firstname`, `lastname`, `email`, `telephone`, `product`, `model`, `quantity`, `opened`, `return_reason_id`, `return_action_id`, `return_status_id`, `comment`, `date_ordered`, `date_added`, `added_by`, `date_modified`, `modified_by`, `is_deleted`) VALUES
(5, 5, 20, 39, 'sczczxc', 'zczxcz', 'pmvpnweb@gmail.com', '1234567', 'bag', 'b1', 1, 0, 4, 4, 6, 'CommentComment', '2016-12-30 00:00:00', '2016-12-12 09:02:51', 1, '2016-12-12 11:29:43', 1, 0),
(6, 1, 19, 40, 'SANDIP', 't', 'ttt@dfdsgt.fdy', '123456789', 'T-shirt', 't1', 5, 0, 2, 3, 5, '', '2016-12-14 00:00:00', '2016-12-12 10:24:08', 1, '2016-12-12 10:24:08', 1, 0),
(7, 21, 19, 41, 'chirag', 'm', 'fgt@dfdsgt.fdy', '123456789', 'T-shirt', 't1', 5, 0, 2, 3, 5, '', '2016-12-13 00:00:00', '2016-12-12 11:30:21', 1, '2016-12-12 11:30:21', 1, 0),
(8, 3, 20, 42, 'raju', 'rj', 'rj@dfdsgt.fdy', '123456789', 'bag', 'b1', 5, 1, 4, 3, 5, '', '2016-12-12 00:00:00', '2016-12-12 11:31:02', 1, '2016-12-12 11:31:02', 1, 0),
(9, 2, 19, 40, 'SANDIP', 't', 'ttt@dfdsgt.fdy', '123456789', 'T-shirt', 't1', 2, 1, 3, 3, 5, '5', '2016-12-11 00:00:00', '2016-12-15 05:51:13', 1, '2016-12-15 05:51:13', 1, 0),
(10, 6, 20, 41, 'chirag', 'm', 'fgt@dfdsgt.fdy', '123456789', 'bag', 'b1', 10, 0, 2, 3, 5, '5', '2017-01-14 00:00:00', '2016-12-15 06:35:02', 1, '2016-12-15 06:35:02', 1, 0),
(11, 31, 0, 51, 'Vinaykumar', 'Ghael', 'vr@vpninfotech.com', '0123456789', 'SAMSUNG Galaxy On Nxt (Gold, 32 GB)', 'p002', 1, 1, 3, 0, 5, 'Faulty, please supply details ', '2017-01-11 00:00:00', '2017-01-12 05:36:12', 51, '2017-01-12 05:36:12', 51, 0);

-- --------------------------------------------------------

--
-- Table structure for table `return_action`
--

CREATE TABLE IF NOT EXISTS `return_action` (
  `return_action_id` int(11) NOT NULL,
  `return_action_name` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `status` int(1) NOT NULL COMMENT '1=Enabled, 0=Disabled',
  `is_deleted` int(1) NOT NULL COMMENT '1 = softdeleted, 0 = not softdeleted'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `return_action`
--

INSERT INTO `return_action` (`return_action_id`, `return_action_name`, `date_added`, `added_by`, `date_modified`, `modified_by`, `status`, `is_deleted`) VALUES
(3, 'Credit Issued', '2016-11-12 07:54:27', 1, '2016-12-12 08:52:31', 1, 0, 0),
(4, 'Refunded', '2016-11-12 07:55:32', 1, '2016-12-12 08:52:46', 1, 0, 0),
(6, 'Replacement Sent', '2016-12-12 09:04:33', 1, '2016-12-12 09:04:50', 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `return_history`
--

CREATE TABLE IF NOT EXISTS `return_history` (
  `return_history_id` int(11) NOT NULL,
  `return_id` int(11) NOT NULL,
  `return_status_id` int(11) NOT NULL,
  `notify` int(1) NOT NULL,
  `comment` text NOT NULL,
  `date_added` datetime NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_modified` int(11) NOT NULL,
  `modified_by` datetime NOT NULL,
  `is_deleted` int(1) NOT NULL COMMENT '1 = softdeleted, 0 = not softdeleted'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `return_reason`
--

CREATE TABLE IF NOT EXISTS `return_reason` (
  `return_reason_id` int(11) NOT NULL,
  `return_reason_name` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  `is_deleted` int(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `return_reason`
--

INSERT INTO `return_reason` (`return_reason_id`, `return_reason_name`, `date_added`, `added_by`, `date_modified`, `modified_by`, `status`, `is_deleted`) VALUES
(2, 'Dead On Arrival', '2016-11-12 07:59:31', 1, '2016-11-12 08:00:17', 1, 0, 0),
(3, 'Faulty, please supply details', '2016-12-12 08:53:39', 1, '2016-12-12 08:53:39', 1, 0, 0),
(4, 'Order Error', '2016-12-12 08:53:51', 1, '2016-12-12 08:53:57', 1, 0, 0),
(5, 'Other, please supply details', '2016-12-12 08:54:09', 1, '2016-12-17 06:00:52', 1, 0, 0),
(7, 'Received Wrong Item', '2016-12-12 09:05:35', 1, '2016-12-12 09:05:35', 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `return_status`
--

CREATE TABLE IF NOT EXISTS `return_status` (
  `return_status_id` int(11) NOT NULL,
  `return_status_name` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `status` int(1) NOT NULL COMMENT '1=Enabled, 0=Disabled',
  `is_deleted` int(1) NOT NULL COMMENT '1 = softdeleted, 0 = not softdeleted'
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `return_status`
--

INSERT INTO `return_status` (`return_status_id`, `return_status_name`, `date_added`, `added_by`, `date_modified`, `modified_by`, `status`, `is_deleted`) VALUES
(5, 'Awaiting Products', '2016-11-12 07:49:42', 1, '2016-11-12 07:49:55', 1, 0, 0),
(6, 'Complete', '2016-12-12 08:48:37', 1, '2016-12-12 08:48:37', 1, 0, 0),
(7, 'Pending', '2016-12-12 08:51:28', 1, '2016-12-12 09:03:23', 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE IF NOT EXISTS `review` (
  `review_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `author` varchar(64) NOT NULL,
  `text` text NOT NULL,
  `rating` int(1) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1=Enabled, 0=Disabled',
  `date_added` datetime NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `is_deleted` int(11) NOT NULL COMMENT '1 = softdeleted, 0 = not softdeleted'
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`review_id`, `product_id`, `customer_id`, `author`, `text`, `rating`, `status`, `date_added`, `added_by`, `date_modified`, `modified_by`, `is_deleted`) VALUES
(2, 34, 0, 'sandip', 'iPhone', 5, 1, '2016-11-17 10:32:12', 0, '2017-01-17 06:29:56', 1, 1),
(31, 35, 0, 'Nitin', 'good', 5, 1, '2017-01-17 06:30:43', 0, '0000-00-00 00:00:00', 0, 0),
(32, 36, 0, 'Nitin', 'Good Saree with good matirials', 1, 1, '2017-01-17 00:00:00', 0, '2017-01-17 06:32:23', 1, 0),
(33, 38, 0, 'Jay', 'BLUE CHIFFON EMBROIDERY DESIGNER SAREE2', 1, 1, '2017-01-17 00:00:00', 0, '2017-01-17 06:32:29', 1, 0),
(34, 40, 0, 'Om jay', 'BLUE CHIFFON EMBROIDERY DESIGNER SAREE5', 1, 1, '2017-01-17 00:00:00', 0, '2017-01-17 07:19:30', 1, 0),
(35, 41, 0, 'asdaasadsda', 'assdasddd sadadsadsadsadadadadadasdadadadadadadad', 1, 1, '2017-01-17 00:00:00', 0, '2017-01-17 07:24:08', 1, 0),
(38, 36, 0, 'Vinay', 'Good Saree with good matirials', 1, 0, '2017-01-17 00:00:00', 0, '0000-00-00 00:00:00', 0, 0),
(39, 46, 0, 'Vinay', 'Good Saree with good matirials', 3, 0, '2017-01-17 00:00:00', 0, '0000-00-00 00:00:00', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1' COMMENT '1=Enabled, 0=Disabled',
  `is_deleted` int(1) NOT NULL DEFAULT '0' COMMENT '1 = softdeleted, 0 = not softdeleted'
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `role_name`, `date_added`, `added_by`, `date_modified`, `modified_by`, `status`, `is_deleted`) VALUES
(1, 'Super_Admin', '2016-11-12 10:19:02', 1, '2016-11-12 10:19:02', 1, 1, 0),
(2, 'Admin', '2016-11-12 10:19:02', 1, '2016-12-02 07:00:39', 1, 1, 0),
(3, 'Finance', '2016-11-12 10:19:02', 1, '2016-11-12 10:19:02', 1, 1, 0),
(4, 'Logistic', '2016-11-12 10:19:02', 1, '2016-11-12 10:19:02', 1, 1, 0),
(5, 'Data_Operator', '2016-11-12 10:19:02', 1, '2016-11-12 10:19:02', 1, 1, 0),
(6, 'Manufacturer', '2016-11-12 10:19:02', 1, '2016-11-12 10:19:02', 1, 1, 0),
(7, 'Support', '2016-11-12 10:19:02', 1, '2016-11-12 10:19:02', 1, 1, 0),
(8, 'Customer', '2016-11-12 10:19:02', 1, '2016-12-02 07:00:44', 1, 1, 0),
(9, 'Marketor', '2016-11-12 10:19:02', 1, '2016-11-12 10:19:02', 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE IF NOT EXISTS `setting` (
  `config_id` int(12) NOT NULL,
  `key` varchar(255) NOT NULL,
  `val` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=171 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`config_id`, `key`, `val`) VALUES
(1, 'catalog_theme', 'default'),
(2, 'admin_theme', 'default'),
(3, 'config_meta_title', 'Srapo''s Shop'),
(4, 'config_meta_description', 'Meta Tag Description\r\n'),
(5, 'config_meta_keyword', 'Meta Tag Keywords'),
(6, 'config_template', 'default'),
(8, 'config_store_name', 'Srapo1'),
(9, 'config_store_owner', 'VPN Infotech1'),
(10, 'config_address', 'AGDSLJKGUKAE FUO GILGFEDJKSBFJKSVDF'),
(11, 'config_geocode', '12345'),
(12, 'config_email', 'ik@vpninfotech.com'),
(13, 'config_telephone', '1234567890'),
(14, 'config_fax', '12345'),
(15, 'config_image', 'catalog/srapo-logo.png'),
(16, 'config_opening_time', '9'),
(17, 'config_comment', 'Meta Tag Keywords '),
(18, 'config_country_id', '99'),
(19, 'config_zone_id', ''),
(20, 'config_language', 'english'),
(21, 'config_admin_language', 'english'),
(22, 'config_currency', 'INR'),
(23, 'config_currency_auto', '0'),
(24, 'config_length_class_id', '1'),
(25, 'config_weight_class_id', '1'),
(26, 'config_date_format', 'd/m/Y'),
(27, 'config_time_format', 'H:i:sa'),
(28, 'config_product_count', '1'),
(29, 'config_product_limit', '12'),
(30, 'config_product_description_length', '15'),
(31, 'config_limit_admin', '20'),
(32, 'config_review_status', '1'),
(33, 'config_review_guest', '1'),
(34, 'config_review_mail', '1'),
(35, 'config_voucher_min', '1'),
(36, 'config_voucher_max', '100'),
(37, 'config_login_attempts', '1'),
(38, 'config_account_id', '0'),
(39, 'config_account_mail', '0'),
(40, 'config_invoice_prefix', 'INV-2013-'),
(41, 'config_cart_weight', '0'),
(42, 'config_checkout_id', '0'),
(43, 'config_order_status_id', '14'),
(44, 'config_fraud_status_id', '2'),
(45, 'config_order_mail', '1'),
(46, 'config_stock_display', '1'),
(47, 'config_stock_warning', '1'),
(48, 'config_stock_checkout', '1'),
(49, 'config_return_id', '0'),
(50, 'config_return_status_id', '5'),
(51, 'config_logo', 'catalog/srapos.png'),
(52, 'config_icon', 'catalog/shopping-bag-xxl.png'),
(53, 'config_image_category_width', '300'),
(54, 'config_image_category_height', '366'),
(55, 'config_image_thumb_width', '850'),
(56, 'config_image_thumb_height', '1036'),
(57, 'config_image_popup_width', '420'),
(58, 'config_image_popup_height', '512'),
(59, 'config_image_product_width', '300'),
(60, 'config_image_product_height', '366'),
(61, 'config_image_additional_width', '100'),
(62, 'config_image_additional_height', '122'),
(63, 'config_image_related_width', '300'),
(64, 'config_image_related_height', '366'),
(65, 'config_image_compare_width', '90'),
(66, 'config_image_compare_height', '90'),
(67, 'config_image_wishlist_width', '100'),
(68, 'config_image_wishlist_height', '122'),
(69, 'config_image_cart_width', '100'),
(70, 'config_image_cart_height', '122'),
(71, 'config_image_location_width', '70'),
(72, 'config_image_location_height', '70'),
(73, 'config_mail_protocol', 'mail'),
(74, 'config_mail_parameter', 'sender, receiver, subject, attachment'),
(75, 'config_mail_smtp_hostname', 'ssl://smtp.gmail.com'),
(76, 'config_mail_smtp_username', 'pmvpnweb@gmail.com'),
(77, 'config_mail_smtp_password', '1234567'),
(78, 'config_mail_smtp_port', '587'),
(79, 'config_mail_smtp_timeout', '7'),
(80, 'config_mail_alert', 'vr@vpninfotech.com'),
(81, 'config_file_ext_allowed', 'zip\ntxt\npng\njpe\njpeg\njpg\ngif\nbmp\nico\ntiff\ntif\nsvg\nsvgz\nzip\nrar\nmsi\ncab\nmp3\nqt\nmov\npdf\npsd\nai\neps\nps\ndoc'),
(82, 'config_file_mime_allowed', 'text/plain\r\nimage/png\r\nimage/jpeg\r\nimage/gif\r\nimage/bmp\r\nimage/tiff\r\nimage/svg+xml\r\napplication/zip\r\n&quot;application/zip&quot;\r\napplication/x-zip\r\n&quot;application/x-zip&quot;\r\napplication/x-zip-compressed\r\n&quot;application/x-zip-compressed&quot;\r\napp'),
(83, 'config_facebook_link', 'https://www.facebook.com/722389824581106'),
(84, 'config_twitter_link', 'https://twitter.com/srapoindia'),
(85, 'config_googleplus_link', 'https://aboutme.google.com/u/0/?referer=gplus'),
(86, 'config_pinterest_link', 'https://in.pinterest.com/srapoindia/'),
(87, 'config_instagram_link', ''),
(88, 'config_complete_status', '["10"]'),
(89, 'config_customer_group_id', '18'),
(90, 'config_processing_status', '["10"]'),
(91, 'config_bestseller_limit', '10'),
(92, 'config_latest_limit', '10'),
(93, 'config_special_limit', '10'),
(94, 'config_featured_limit', '10'),
(95, 'config_tax', '0'),
(96, 'config_display_categories', '["116","57","58","59"]'),
(97, 'config_display_hot_categories', '8'),
(98, 'config_display_hot_sub_categories', '5'),
(99, 'config_customer_price', '0'),
(100, 'ccavenue_Merchant_Id', '121526'),
(101, 'ccavenue_total', '0.01'),
(102, 'ccavenue_workingkey', '8E473DE16166FB7E742B997F09635A2E'),
(103, 'ccavenue_access_code', 'AVFF68EA82BL50FFLB'),
(104, 'ccavenue_completed_status_id', '8'),
(105, 'ccavenue_failed_status_id', '8'),
(106, 'ccavenue_pending_status_id', '8'),
(107, 'ccavenue_payment_country_id', '["1","99"]'),
(108, 'ccavenue_checkout_method', 'redirect'),
(109, 'ccavenue_status', '1'),
(110, 'ccavenue_sort_order', '1'),
(111, 'ccavenue_action', 'https://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction'),
(112, 'pp_standard_processed_status_id', '8'),
(113, 'pp_standard_pending_status_id', '8'),
(114, 'pp_standard_reversed_status_id', '8'),
(115, 'pp_standard_voided_status_id', '8'),
(116, 'pp_standard_total', '0.01'),
(117, 'pp_standard_failed_status_id', '8'),
(118, 'pp_standard_expired_status_id', '8'),
(119, 'pp_standard_denied_status_id', '8'),
(120, 'pp_standard_completed_status_id', '8'),
(121, 'pp_standard_canceled_reversal_status_id', '8'),
(122, 'pp_standard_status', '1'),
(123, 'pp_standard_payment_country_id', '["99","13"]'),
(124, 'pp_standard_transaction', '0'),
(125, 'pp_standard_debug', '1'),
(126, 'pp_standard_test', '0'),
(127, 'pp_standard_email', 'nc@vpninfotech.com'),
(128, 'pp_standard_refunded_status_id', '8'),
(154, 'weight_tax_class_id', '5'),
(155, 'weight_status', '1'),
(156, 'weight_sort_order', '4'),
(157, 'weight_1_rate', '1:200'),
(158, 'weight_1_status', '1'),
(159, 'weight_99_rate', '3:300'),
(160, 'weight_99_status', '1'),
(161, 'weight_222_rate', '1:25'),
(162, 'weight_222_status', '1'),
(163, 'free_checkout_order_status', '14'),
(164, 'free_checkout_payment_country_id', '["99"]'),
(165, 'free_checkout_status', '1'),
(166, 'free_checkout_sort_order', '2'),
(167, 'pick_pay_order_status', '14'),
(168, 'pick_pay_payment_country_id', '["1","99"]'),
(169, 'pick_pay_status', '1'),
(170, 'pick_pay_sort_order', '1');

-- --------------------------------------------------------

--
-- Table structure for table `shipping_method`
--

CREATE TABLE IF NOT EXISTS `shipping_method` (
  `shipping_method_id` int(11) NOT NULL,
  `shipping_method_name` varchar(255) NOT NULL,
  `shipping_code` varchar(255) NOT NULL,
  `tax_class_id` int(11) NOT NULL,
  `rate` decimal(15,5) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shipping_method`
--

INSERT INTO `shipping_method` (`shipping_method_id`, `shipping_method_name`, `shipping_code`, `tax_class_id`, `rate`, `status`) VALUES
(1, 'flat', 'flat', 1, '5.00000', 0),
(2, 'Weight Based Shipping', 'weight', 1, '1.00000', 1);

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE IF NOT EXISTS `state` (
  `state_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `state_name` varchar(255) NOT NULL,
  `state_code` varchar(32) NOT NULL,
  `date_added` datetime NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  `is_deleted` int(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4232 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`state_id`, `country_id`, `state_name`, `state_code`, `date_added`, `added_by`, `date_modified`, `modified_by`, `status`, `is_deleted`) VALUES
(1, 1, 'Badakhshan', 'BDS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2, 1, 'Badghis', 'BDG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3, 1, 'Baghlan', 'BGL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4, 1, 'Balkh', 'BAL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(5, 1, 'Bamian', 'BAM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(6, 1, 'Farah', 'FRA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(7, 1, 'Faryab', 'FYB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(8, 1, 'Ghazni', 'GHA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(9, 1, 'Ghowr', 'GHO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(10, 1, 'Helmand', 'HEL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(11, 1, 'Herat', 'HER', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(12, 1, 'Jowzjan', 'JOW', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(13, 1, 'Kabul', 'KAB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(14, 1, 'Kandahar', 'KAN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(15, 1, 'Kapisa', 'KAP', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(16, 1, 'Khost', 'KHO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(17, 1, 'Konar', 'KNR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(18, 1, 'Kondoz', 'KDZ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(19, 1, 'Laghman', 'LAG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(20, 1, 'Lowgar', 'LOW', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(21, 1, 'Nangrahar', 'NAN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(22, 1, 'Nimruz', 'NIM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(23, 1, 'Nurestan', 'NUR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(24, 1, 'Oruzgan', 'ORU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(25, 1, 'Paktia', 'PIA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(26, 1, 'Paktika', 'PKA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(27, 1, 'Parwan', 'PAR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(28, 1, 'Samangan', 'SAM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(29, 1, 'Sar-e Pol', 'SAR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(30, 1, 'Takhar', 'TAK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(31, 1, 'Wardak', 'WAR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(32, 1, 'Zabol', 'ZAB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(33, 2, 'Berat', 'BR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(34, 2, 'Bulqize', 'BU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(35, 2, 'Delvine', 'DL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(36, 2, 'Devoll', 'DV', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(37, 2, 'Diber', 'DI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(38, 2, 'Durres', 'DR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(39, 2, 'Elbasan', 'EL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(40, 2, 'Kolonje', 'ER', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(41, 2, 'Fier', 'FR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(42, 2, 'Gjirokaster', 'GJ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(43, 2, 'Gramsh', 'GR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(44, 2, 'Has', 'HA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(45, 2, 'Kavaje', 'KA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(46, 2, 'Kurbin', 'KB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(47, 2, 'Kucove', 'KC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(48, 2, 'Korce', 'KO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(49, 2, 'Kruje', 'KR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(50, 2, 'Kukes', 'KU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(51, 2, 'Librazhd', 'LB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(52, 2, 'Lezhe', 'LE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(53, 2, 'Lushnje', 'LU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(54, 2, 'Malesi e Madhe', 'MM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(55, 2, 'Mallakaster', 'MK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(56, 2, 'Mat', 'MT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(57, 2, 'Mirdite', 'MR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(58, 2, 'Peqin', 'PQ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(59, 2, 'Permet', 'PR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(60, 2, 'Pogradec', 'PG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(61, 2, 'Puke', 'PU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(62, 2, 'Shkoder', 'SH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(63, 2, 'Skrapar', 'SK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(64, 2, 'Sarande', 'SR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(65, 2, 'Tepelene', 'TE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(66, 2, 'Tropoje', 'TP', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(67, 2, 'Tirane', 'TR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(68, 2, 'Vlore', 'VL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(69, 3, 'Adrar', 'ADR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(70, 3, 'Ain Defla', 'ADE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(71, 3, 'Ain Temouchent', 'ATE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(72, 3, 'Alger', 'ALG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(73, 3, 'Annaba', 'ANN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(74, 3, 'Batna', 'BAT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(75, 3, 'Bechar', 'BEC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(76, 3, 'Bejaia', 'BEJ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(77, 3, 'Biskra', 'BIS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(78, 3, 'Blida', 'BLI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(79, 3, 'Bordj Bou Arreridj', 'BBA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(80, 3, 'Bouira', 'BOA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(81, 3, 'Boumerdes', 'BMD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(82, 3, 'Chlef', 'CHL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(83, 3, 'Constantine', 'CON', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(84, 3, 'Djelfa', 'DJE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(85, 3, 'El Bayadh', 'EBA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(86, 3, 'El Oued', 'EOU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(87, 3, 'El Tarf', 'ETA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(88, 3, 'Ghardaia', 'GHA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(89, 3, 'Guelma', 'GUE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(90, 3, 'Illizi', 'ILL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(91, 3, 'Jijel', 'JIJ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(92, 3, 'Khenchela', 'KHE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(93, 3, 'Laghouat', 'LAG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(94, 3, 'Muaskar', 'MUA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(95, 3, 'Medea', 'MED', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(96, 3, 'Mila', 'MIL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(97, 3, 'Mostaganem', 'MOS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(98, 3, 'M''Sila', 'MSI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(99, 3, 'Naama', 'NAA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(100, 3, 'Oran', 'ORA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(101, 3, 'Ouargla', 'OUA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(102, 3, 'Oum el-Bouaghi', 'OEB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(103, 3, 'Relizane', 'REL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(104, 3, 'Saida', 'SAI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(105, 3, 'Setif', 'SET', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(106, 3, 'Sidi Bel Abbes', 'SBA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(107, 3, 'Skikda', 'SKI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(108, 3, 'Souk Ahras', 'SAH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(109, 3, 'Tamanghasset', 'TAM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(110, 3, 'Tebessa', 'TEB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(111, 3, 'Tiaret', 'TIA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(112, 3, 'Tindouf', 'TIN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(113, 3, 'Tipaza', 'TIP', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(114, 3, 'Tissemsilt', 'TIS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(115, 3, 'Tizi Ouzou', 'TOU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(116, 3, 'Tlemcen', 'TLE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(117, 4, 'Eastern', 'E', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(118, 4, 'Manu''a', 'M', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(119, 4, 'Rose Island', 'R', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(120, 4, 'Swains Island', 'S', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(121, 4, 'Western', 'W', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(122, 5, 'Andorra la Vella', 'ALV', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(123, 5, 'Canillo', 'CAN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(124, 5, 'Encamp', 'ENC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(125, 5, 'Escaldes-Engordany', 'ESE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(126, 5, 'La Massana', 'LMA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(127, 5, 'Ordino', 'ORD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(128, 5, 'Sant Julia de Loria', 'SJL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(129, 6, 'Bengo', 'BGO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(130, 6, 'Benguela', 'BGU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(131, 6, 'Bie', 'BIE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(132, 6, 'Cabinda', 'CAB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(133, 6, 'Cuando-Cubango', 'CCU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(134, 6, 'Cuanza Norte', 'CNO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(135, 6, 'Cuanza Sul', 'CUS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(136, 6, 'Cunene', 'CNN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(137, 6, 'Huambo', 'HUA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(138, 6, 'Huila', 'HUI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(139, 6, 'Luanda', 'LUA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(140, 6, 'Lunda Norte', 'LNO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(141, 6, 'Lunda Sul', 'LSU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(142, 6, 'Malange', 'MAL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(143, 6, 'Moxico', 'MOX', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(144, 6, 'Namibe', 'NAM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(145, 6, 'Uige', 'UIG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(146, 6, 'Zaire', 'ZAI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(147, 9, 'Saint George', 'ASG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(148, 9, 'Saint John', 'ASJ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(149, 9, 'Saint Mary', 'ASM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(150, 9, 'Saint Paul', 'ASL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(151, 9, 'Saint Peter', 'ASR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(152, 9, 'Saint Philip', 'ASH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(153, 9, 'Barbuda', 'BAR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(154, 9, 'Redonda', 'RED', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(155, 10, 'Antartida e Islas del Atlantico', 'AN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(156, 10, 'Buenos Aires', 'BA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(157, 10, 'Catamarca', 'CA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(158, 10, 'Chaco', 'CH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(159, 10, 'Chubut', 'CU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(160, 10, 'Cordoba', 'CO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(161, 10, 'Corrientes', 'CR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(162, 10, 'Distrito Federal', 'DF', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(163, 10, 'Entre Rios', 'ER', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(164, 10, 'Formosa', 'FO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(165, 10, 'Jujuy', 'JU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(166, 10, 'La Pampa', 'LP', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(167, 10, 'La Rioja', 'LR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(168, 10, 'Mendoza', 'ME', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(169, 10, 'Misiones', 'MI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(170, 10, 'Neuquen', 'NE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(171, 10, 'Rio Negro', 'RN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(172, 10, 'Salta', 'SA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(173, 10, 'San Juan', 'SJ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(174, 10, 'San Luis', 'SL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(175, 10, 'Santa Cruz', 'SC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(176, 10, 'Santa Fe', 'SF', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(177, 10, 'Santiago del Estero', 'SD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(178, 10, 'Tierra del Fuego', 'TF', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(179, 10, 'Tucuman', 'TU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(180, 11, 'Aragatsotn', 'AGT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(181, 11, 'Ararat', 'ARR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(182, 11, 'Armavir', 'ARM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(183, 11, 'Geghark''unik''', 'GEG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(184, 11, 'Kotayk''', 'KOT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(185, 11, 'Lorri', 'LOR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(186, 11, 'Shirak', 'SHI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(187, 11, 'Syunik''', 'SYU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(188, 11, 'Tavush', 'TAV', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(189, 11, 'Vayots'' Dzor', 'VAY', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(190, 11, 'Yerevan', 'YER', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(191, 13, 'Australian Capital Territory', 'ACT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(192, 13, 'New South Wales', 'NSW', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(193, 13, 'Northern Territory', 'NT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(194, 13, 'Queensland', 'QLD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(195, 13, 'South Australia', 'SA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(196, 13, 'Tasmania', 'TAS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(197, 13, 'Victoria', 'VIC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(198, 13, 'Western Australia', 'WA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(199, 14, 'Burgenland', 'BUR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(200, 14, 'Kärnten', 'KAR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(201, 14, 'Nieder&ouml;sterreich', 'NOS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(202, 14, 'Ober&ouml;sterreich', 'OOS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(203, 14, 'Salzburg', 'SAL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(204, 14, 'Steiermark', 'STE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(205, 14, 'Tirol', 'TIR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(206, 14, 'Vorarlberg', 'VOR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(207, 14, 'Wien', 'WIE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(208, 15, 'Ali Bayramli', 'AB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(209, 15, 'Abseron', 'ABS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(210, 15, 'AgcabAdi', 'AGC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(211, 15, 'Agdam', 'AGM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(212, 15, 'Agdas', 'AGS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(213, 15, 'Agstafa', 'AGA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(214, 15, 'Agsu', 'AGU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(215, 15, 'Astara', 'AST', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(216, 15, 'Baki', 'BA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(217, 15, 'BabAk', 'BAB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(218, 15, 'BalakAn', 'BAL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(219, 15, 'BArdA', 'BAR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(220, 15, 'Beylaqan', 'BEY', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(221, 15, 'Bilasuvar', 'BIL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(222, 15, 'Cabrayil', 'CAB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(223, 15, 'Calilabab', 'CAL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(224, 15, 'Culfa', 'CUL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(225, 15, 'Daskasan', 'DAS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(226, 15, 'Davaci', 'DAV', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(227, 15, 'Fuzuli', 'FUZ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(228, 15, 'Ganca', 'GA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(229, 15, 'Gadabay', 'GAD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(230, 15, 'Goranboy', 'GOR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(231, 15, 'Goycay', 'GOY', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(232, 15, 'Haciqabul', 'HAC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(233, 15, 'Imisli', 'IMI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(234, 15, 'Ismayilli', 'ISM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(235, 15, 'Kalbacar', 'KAL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(236, 15, 'Kurdamir', 'KUR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(237, 15, 'Lankaran', 'LA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(238, 15, 'Lacin', 'LAC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(239, 15, 'Lankaran', 'LAN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(240, 15, 'Lerik', 'LER', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(241, 15, 'Masalli', 'MAS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(242, 15, 'Mingacevir', 'MI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(243, 15, 'Naftalan', 'NA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(244, 15, 'Neftcala', 'NEF', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(245, 15, 'Oguz', 'OGU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(246, 15, 'Ordubad', 'ORD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(247, 15, 'Qabala', 'QAB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(248, 15, 'Qax', 'QAX', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(249, 15, 'Qazax', 'QAZ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(250, 15, 'Qobustan', 'QOB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(251, 15, 'Quba', 'QBA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(252, 15, 'Qubadli', 'QBI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(253, 15, 'Qusar', 'QUS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(254, 15, 'Saki', 'SA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(255, 15, 'Saatli', 'SAT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(256, 15, 'Sabirabad', 'SAB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(257, 15, 'Sadarak', 'SAD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(258, 15, 'Sahbuz', 'SAH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(259, 15, 'Saki', 'SAK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(260, 15, 'Salyan', 'SAL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(261, 15, 'Sumqayit', 'SM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(262, 15, 'Samaxi', 'SMI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(263, 15, 'Samkir', 'SKR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(264, 15, 'Samux', 'SMX', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(265, 15, 'Sarur', 'SAR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(266, 15, 'Siyazan', 'SIY', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(267, 15, 'Susa', 'SS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(268, 15, 'Susa', 'SUS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(269, 15, 'Tartar', 'TAR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(270, 15, 'Tovuz', 'TOV', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(271, 15, 'Ucar', 'UCA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(272, 15, 'Xankandi', 'XA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(273, 15, 'Xacmaz', 'XAC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(274, 15, 'Xanlar', 'XAN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(275, 15, 'Xizi', 'XIZ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(276, 15, 'Xocali', 'XCI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(277, 15, 'Xocavand', 'XVD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(278, 15, 'Yardimli', 'YAR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(279, 15, 'Yevlax', 'YEV', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(280, 15, 'Zangilan', 'ZAN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(281, 15, 'Zaqatala', 'ZAQ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(282, 15, 'Zardab', 'ZAR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(283, 15, 'Naxcivan', 'NX', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(284, 16, 'Acklins', 'ACK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(285, 16, 'Berry Islands', 'BER', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(286, 16, 'Bimini', 'BIM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(287, 16, 'Black Point', 'BLK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(288, 16, 'Cat Island', 'CAT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(289, 16, 'Central Abaco', 'CAB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(290, 16, 'Central Andros', 'CAN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(291, 16, 'Central Eleuthera', 'CEL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(292, 16, 'City of Freeport', 'FRE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(293, 16, 'Crooked Island', 'CRO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(294, 16, 'East Grand Bahama', 'EGB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(295, 16, 'Exuma', 'EXU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(296, 16, 'Grand Cay', 'GRD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(297, 16, 'Harbour Island', 'HAR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(298, 16, 'Hope Town', 'HOP', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(299, 16, 'Inagua', 'INA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(300, 16, 'Long Island', 'LNG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(301, 16, 'Mangrove Cay', 'MAN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(302, 16, 'Mayaguana', 'MAY', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(303, 16, 'Moore''s Island', 'MOO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(304, 16, 'North Abaco', 'NAB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(305, 16, 'North Andros', 'NAN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(306, 16, 'North Eleuthera', 'NEL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(307, 16, 'Ragged Island', 'RAG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(308, 16, 'Rum Cay', 'RUM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(309, 16, 'San Salvador', 'SAL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(310, 16, 'South Abaco', 'SAB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(311, 16, 'South Andros', 'SAN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(312, 16, 'South Eleuthera', 'SEL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(313, 16, 'Spanish Wells', 'SWE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(314, 16, 'West Grand Bahama', 'WGB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(315, 17, 'Capital', 'CAP', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(316, 17, 'Central', 'CEN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(317, 17, 'Muharraq', 'MUH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(318, 17, 'Northern', 'NOR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(319, 17, 'Southern', 'SOU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(320, 18, 'Barisal', 'BAR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(321, 18, 'Chittagong', 'CHI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(322, 18, 'Dhaka', 'DHA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(323, 18, 'Khulna', 'KHU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(324, 18, 'Rajshahi', 'RAJ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(325, 18, 'Sylhet', 'SYL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(326, 19, 'Christ Church', 'CC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(327, 19, 'Saint Andrew', 'AND', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(328, 19, 'Saint George', 'GEO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(329, 19, 'Saint James', 'JAM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(330, 19, 'Saint John', 'JOH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(331, 19, 'Saint Joseph', 'JOS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(332, 19, 'Saint Lucy', 'LUC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(333, 19, 'Saint Michael', 'MIC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(334, 19, 'Saint Peter', 'PET', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(335, 19, 'Saint Philip', 'PHI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(336, 19, 'Saint Thomas', 'THO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(337, 20, 'Brestskaya (Brest)', 'BR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(338, 20, 'Homyel''skaya (Homyel'')', 'HO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(339, 20, 'Horad Minsk', 'HM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(340, 20, 'Hrodzyenskaya (Hrodna)', 'HR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(341, 20, 'Mahilyowskaya (Mahilyow)', 'MA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(342, 20, 'Minskaya', 'MI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(343, 20, 'Vitsyebskaya (Vitsyebsk)', 'VI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(344, 21, 'Antwerpen', 'VAN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(345, 21, 'Brabant Wallon', 'WBR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(346, 21, 'Hainaut', 'WHT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(347, 21, 'Liège', 'WLG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(348, 21, 'Limburg', 'VLI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(349, 21, 'Luxembourg', 'WLX', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(350, 21, 'Namur', 'WNA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(351, 21, 'Oost-Vlaanderen', 'VOV', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(352, 21, 'Vlaams Brabant', 'VBR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(353, 21, 'West-Vlaanderen', 'VWV', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(354, 22, 'Belize', 'BZ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(355, 22, 'Cayo', 'CY', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(356, 22, 'Corozal', 'CR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(357, 22, 'Orange Walk', 'OW', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(358, 22, 'Stann Creek', 'SC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(359, 22, 'Toledo', 'TO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(360, 23, 'Alibori', 'AL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(361, 23, 'Atakora', 'AK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(362, 23, 'Atlantique', 'AQ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(363, 23, 'Borgou', 'BO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(364, 23, 'Collines', 'CO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(365, 23, 'Donga', 'DO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(366, 23, 'Kouffo', 'KO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(367, 23, 'Littoral', 'LI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(368, 23, 'Mono', 'MO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(369, 23, 'Oueme', 'OU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(370, 23, 'Plateau', 'PL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(371, 23, 'Zou', 'ZO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(372, 24, 'Devonshire', 'DS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(373, 24, 'Hamilton City', 'HC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(374, 24, 'Hamilton', 'HA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(375, 24, 'Paget', 'PG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(376, 24, 'Pembroke', 'PB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(377, 24, 'Saint George City', 'GC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(378, 24, 'Saint George''s', 'SG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(379, 24, 'Sandys', 'SA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(380, 24, 'Smith''s', 'SM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(381, 24, 'Southampton', 'SH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(382, 24, 'Warwick', 'WA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(383, 25, 'Bumthang', 'BUM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(384, 25, 'Chukha', 'CHU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(385, 25, 'Dagana', 'DAG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(386, 25, 'Gasa', 'GAS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(387, 25, 'Haa', 'HAA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(388, 25, 'Lhuntse', 'LHU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(389, 25, 'Mongar', 'MON', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(390, 25, 'Paro', 'PAR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(391, 25, 'Pemagatshel', 'PEM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(392, 25, 'Punakha', 'PUN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(393, 25, 'Samdrup Jongkhar', 'SJO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(394, 25, 'Samtse', 'SAT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(395, 25, 'Sarpang', 'SAR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(396, 25, 'Thimphu', 'THI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(397, 25, 'Trashigang', 'TRG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(398, 25, 'Trashiyangste', 'TRY', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(399, 25, 'Trongsa', 'TRO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(400, 25, 'Tsirang', 'TSI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(401, 25, 'Wangdue Phodrang', 'WPH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(402, 25, 'Zhemgang', 'ZHE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(403, 26, 'Beni', 'BEN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(404, 26, 'Chuquisaca', 'CHU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(405, 26, 'Cochabamba', 'COC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(406, 26, 'La Paz', 'LPZ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(407, 26, 'Oruro', 'ORU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(408, 26, 'Pando', 'PAN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(409, 26, 'Potosi', 'POT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(410, 26, 'Santa Cruz', 'SCZ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(411, 26, 'Tarija', 'TAR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(412, 27, 'Brcko district', 'BRO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(413, 27, 'Unsko-Sanski Kanton', 'FUS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(414, 27, 'Posavski Kanton', 'FPO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(415, 27, 'Tuzlanski Kanton', 'FTU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(416, 27, 'Zenicko-Dobojski Kanton', 'FZE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(417, 27, 'Bosanskopodrinjski Kanton', 'FBP', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(418, 27, 'Srednjebosanski Kanton', 'FSB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(419, 27, 'Hercegovacko-neretvanski Kanton', 'FHN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(420, 27, 'Zapadnohercegovacka Zupanija', 'FZH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(421, 27, 'Kanton Sarajevo', 'FSA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(422, 27, 'Zapadnobosanska', 'FZA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(423, 27, 'Banja Luka', 'SBL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(424, 27, 'Doboj', 'SDO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(425, 27, 'Bijeljina', 'SBI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(426, 27, 'Vlasenica', 'SVL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(427, 27, 'Sarajevo-Romanija or Sokolac', 'SSR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(428, 27, 'Foca', 'SFO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(429, 27, 'Trebinje', 'STR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(430, 28, 'Central', 'CE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(431, 28, 'Ghanzi', 'GH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(432, 28, 'Kgalagadi', 'KD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(433, 28, 'Kgatleng', 'KT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(434, 28, 'Kweneng', 'KW', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(435, 28, 'Ngamiland', 'NG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(436, 28, 'North East', 'NE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(437, 28, 'North West', 'NW', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(438, 28, 'South East', 'SE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(439, 28, 'Southern', 'SO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(440, 30, 'Acre', 'AC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(441, 30, 'Alagoas', 'AL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(442, 30, 'Amapá', 'AP', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(443, 30, 'Amazonas', 'AM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(444, 30, 'Bahia', 'BA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(445, 30, 'Ceará', 'CE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(446, 30, 'Distrito Federal', 'DF', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(447, 30, 'Espírito Santo', 'ES', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(448, 30, 'Goiás', 'GO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(449, 30, 'Maranhão', 'MA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(450, 30, 'Mato Grosso', 'MT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(451, 30, 'Mato Grosso do Sul', 'MS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(452, 30, 'Minas Gerais', 'MG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(453, 30, 'Pará', 'PA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(454, 30, 'Paraíba', 'PB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(455, 30, 'Paraná', 'PR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(456, 30, 'Pernambuco', 'PE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(457, 30, 'Piauí', 'PI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(458, 30, 'Rio de Janeiro', 'RJ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(459, 30, 'Rio Grande do Norte', 'RN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(460, 30, 'Rio Grande do Sul', 'RS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(461, 30, 'Rondônia', 'RO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(462, 30, 'Roraima', 'RR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(463, 30, 'Santa Catarina', 'SC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(464, 30, 'São Paulo', 'SP', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(465, 30, 'Sergipe', 'SE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(466, 30, 'Tocantins', 'TO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(467, 31, 'Peros Banhos', 'PB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(468, 31, 'Salomon Islands', 'SI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(469, 31, 'Nelsons Island', 'NI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(470, 31, 'Three Brothers', 'TB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(471, 31, 'Eagle Islands', 'EA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(472, 31, 'Danger Island', 'DI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(473, 31, 'Egmont Islands', 'EG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(474, 31, 'Diego Garcia', 'DG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(475, 32, 'Belait', 'BEL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(476, 32, 'Brunei and Muara', 'BRM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(477, 32, 'Temburong', 'TEM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(478, 32, 'Tutong', 'TUT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(479, 33, 'Blagoevgrad', '', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(480, 33, 'Burgas', '', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(481, 33, 'Dobrich', '', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(482, 33, 'Gabrovo', '', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(483, 33, 'Haskovo', '', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(484, 33, 'Kardjali', '', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(485, 33, 'Kyustendil', '', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(486, 33, 'Lovech', '', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(487, 33, 'Montana', '', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(488, 33, 'Pazardjik', '', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(489, 33, 'Pernik', '', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(490, 33, 'Pleven', '', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(491, 33, 'Plovdiv', '', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(492, 33, 'Razgrad', '', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(493, 33, 'Shumen', '', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(494, 33, 'Silistra', '', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(495, 33, 'Sliven', '', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(496, 33, 'Smolyan', '', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(497, 33, 'Sofia', '', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(498, 33, 'Sofia - town', '', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(499, 33, 'Stara Zagora', '', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(500, 33, 'Targovishte', '', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(501, 33, 'Varna', '', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(502, 33, 'Veliko Tarnovo', '', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(503, 33, 'Vidin', '', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(504, 33, 'Vratza', '', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(505, 33, 'Yambol', '', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(506, 34, 'Bale', 'BAL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(507, 34, 'Bam', 'BAM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(508, 34, 'Banwa', 'BAN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(509, 34, 'Bazega', 'BAZ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(510, 34, 'Bougouriba', 'BOR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(511, 34, 'Boulgou', 'BLG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(512, 34, 'Boulkiemde', 'BOK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(513, 34, 'Comoe', 'COM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(514, 34, 'Ganzourgou', 'GAN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(515, 34, 'Gnagna', 'GNA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(516, 34, 'Gourma', 'GOU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(517, 34, 'Houet', 'HOU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(518, 34, 'Ioba', 'IOA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(519, 34, 'Kadiogo', 'KAD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(520, 34, 'Kenedougou', 'KEN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(521, 34, 'Komondjari', 'KOD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(522, 34, 'Kompienga', 'KOP', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(523, 34, 'Kossi', 'KOS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(524, 34, 'Koulpelogo', 'KOL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(525, 34, 'Kouritenga', 'KOT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(526, 34, 'Kourweogo', 'KOW', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(527, 34, 'Leraba', 'LER', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(528, 34, 'Loroum', 'LOR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(529, 34, 'Mouhoun', 'MOU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(530, 34, 'Nahouri', 'NAH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(531, 34, 'Namentenga', 'NAM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(532, 34, 'Nayala', 'NAY', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(533, 34, 'Noumbiel', 'NOU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(534, 34, 'Oubritenga', 'OUB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(535, 34, 'Oudalan', 'OUD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(536, 34, 'Passore', 'PAS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(537, 34, 'Poni', 'PON', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(538, 34, 'Sanguie', 'SAG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(539, 34, 'Sanmatenga', 'SAM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(540, 34, 'Seno', 'SEN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(541, 34, 'Sissili', 'SIS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(542, 34, 'Soum', 'SOM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(543, 34, 'Sourou', 'SOR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(544, 34, 'Tapoa', 'TAP', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(545, 34, 'Tuy', 'TUY', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(546, 34, 'Yagha', 'YAG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(547, 34, 'Yatenga', 'YAT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(548, 34, 'Ziro', 'ZIR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(549, 34, 'Zondoma', 'ZOD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(550, 34, 'Zoundweogo', 'ZOW', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(551, 35, 'Bubanza', 'BB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(552, 35, 'Bujumbura', 'BJ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(553, 35, 'Bururi', 'BR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(554, 35, 'Cankuzo', 'CA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(555, 35, 'Cibitoke', 'CI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(556, 35, 'Gitega', 'GI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(557, 35, 'Karuzi', 'KR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(558, 35, 'Kayanza', 'KY', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(559, 35, 'Kirundo', 'KI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(560, 35, 'Makamba', 'MA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(561, 35, 'Muramvya', 'MU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(562, 35, 'Muyinga', 'MY', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(563, 35, 'Mwaro', 'MW', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(564, 35, 'Ngozi', 'NG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(565, 35, 'Rutana', 'RT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(566, 35, 'Ruyigi', 'RY', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(567, 36, 'Phnom Penh', 'PP', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(568, 36, 'Preah Seihanu (Kompong Som or Sihanoukville)', 'PS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(569, 36, 'Pailin', 'PA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(570, 36, 'Keb', 'KB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(571, 36, 'Banteay Meanchey', 'BM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(572, 36, 'Battambang', 'BA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(573, 36, 'Kampong Cham', 'KM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(574, 36, 'Kampong Chhnang', 'KN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(575, 36, 'Kampong Speu', 'KU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(576, 36, 'Kampong Som', 'KO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(577, 36, 'Kampong Thom', 'KT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(578, 36, 'Kampot', 'KP', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(579, 36, 'Kandal', 'KL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(580, 36, 'Kaoh Kong', 'KK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(581, 36, 'Kratie', 'KR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0);
INSERT INTO `state` (`state_id`, `country_id`, `state_name`, `state_code`, `date_added`, `added_by`, `date_modified`, `modified_by`, `status`, `is_deleted`) VALUES
(582, 36, 'Mondul Kiri', 'MK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(583, 36, 'Oddar Meancheay', 'OM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(584, 36, 'Pursat', 'PU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(585, 36, 'Preah Vihear', 'PR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(586, 36, 'Prey Veng', 'PG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(587, 36, 'Ratanak Kiri', 'RK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(588, 36, 'Siemreap', 'SI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(589, 36, 'Stung Treng', 'ST', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(590, 36, 'Svay Rieng', 'SR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(591, 36, 'Takeo', 'TK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(592, 37, 'Adamawa (Adamaoua)', 'ADA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(593, 37, 'Centre', 'CEN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(594, 37, 'East (Est)', 'EST', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(595, 37, 'Extreme North (Extreme-Nord)', 'EXN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(596, 37, 'Littoral', 'LIT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(597, 37, 'North (Nord)', 'NOR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(598, 37, 'Northwest (Nord-Ouest)', 'NOT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(599, 37, 'West (Ouest)', 'OUE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(600, 37, 'South (Sud)', 'SUD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(601, 37, 'Southwest (Sud-Ouest).', 'SOU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(602, 38, 'Alberta', 'AB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(603, 38, 'British Columbia', 'BC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(604, 38, 'Manitoba', 'MB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(605, 38, 'New Brunswick', 'NB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(606, 38, 'Newfoundland and Labrador', 'NL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(607, 38, 'Northwest Territories', 'NT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(608, 38, 'Nova Scotia', 'NS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(609, 38, 'Nunavut', 'NU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(610, 38, 'Ontario', 'ON', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(611, 38, 'Prince Edward Island', 'PE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(612, 38, 'Qu&eacute;bec', 'QC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(613, 38, 'Saskatchewan', 'SK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(614, 38, 'Yukon Territory', 'YT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(615, 39, 'Boa Vista', 'BV', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(616, 39, 'Brava', 'BR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(617, 39, 'Calheta de Sao Miguel', 'CS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(618, 39, 'Maio', 'MA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(619, 39, 'Mosteiros', 'MO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(620, 39, 'Paul', 'PA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(621, 39, 'Porto Novo', 'PN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(622, 39, 'Praia', 'PR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(623, 39, 'Ribeira Grande', 'RG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(624, 39, 'Sal', 'SL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(625, 39, 'Santa Catarina', 'CA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(626, 39, 'Santa Cruz', 'CR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(627, 39, 'Sao Domingos', 'SD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(628, 39, 'Sao Filipe', 'SF', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(629, 39, 'Sao Nicolau', 'SN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(630, 39, 'Sao Vicente', 'SV', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(631, 39, 'Tarrafal', 'TA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(632, 40, 'Creek', 'CR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(633, 40, 'Eastern', 'EA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(634, 40, 'Midland', 'ML', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(635, 40, 'South Town', 'ST', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(636, 40, 'Spot Bay', 'SP', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(637, 40, 'Stake Bay', 'SK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(638, 40, 'West End', 'WD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(639, 40, 'Western', 'WN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(640, 41, 'Bamingui-Bangoran', 'BBA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(641, 41, 'Basse-Kotto', 'BKO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(642, 41, 'Haute-Kotto', 'HKO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(643, 41, 'Haut-Mbomou', 'HMB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(644, 41, 'Kemo', 'KEM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(645, 41, 'Lobaye', 'LOB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(646, 41, 'Mambere-KadeÔ', 'MKD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(647, 41, 'Mbomou', 'MBO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(648, 41, 'Nana-Mambere', 'NMM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(649, 41, 'Ombella-M''Poko', 'OMP', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(650, 41, 'Ouaka', 'OUK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(651, 41, 'Ouham', 'OUH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(652, 41, 'Ouham-Pende', 'OPE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(653, 41, 'Vakaga', 'VAK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(654, 41, 'Nana-Grebizi', 'NGR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(655, 41, 'Sangha-Mbaere', 'SMB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(656, 41, 'Bangui', 'BAN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(657, 42, 'Batha', 'BA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(658, 42, 'Biltine', 'BI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(659, 42, 'Borkou-Ennedi-Tibesti', 'BE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(660, 42, 'Chari-Baguirmi', 'CB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(661, 42, 'Guera', 'GU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(662, 42, 'Kanem', 'KA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(663, 42, 'Lac', 'LA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(664, 42, 'Logone Occidental', 'LC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(665, 42, 'Logone Oriental', 'LR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(666, 42, 'Mayo-Kebbi', 'MK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(667, 42, 'Moyen-Chari', 'MC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(668, 42, 'Ouaddai', 'OU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(669, 42, 'Salamat', 'SA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(670, 42, 'Tandjile', 'TA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(671, 43, 'Aisen del General Carlos Ibanez', 'AI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(672, 43, 'Antofagasta', 'AN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(673, 43, 'Araucania', 'AR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(674, 43, 'Atacama', 'AT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(675, 43, 'Bio-Bio', 'BI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(676, 43, 'Coquimbo', 'CO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(677, 43, 'Libertador General Bernardo O''Higgins', 'LI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(678, 43, 'Los Lagos', 'LL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(679, 43, 'Magallanes y de la Antartica Chilena', 'MA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(680, 43, 'Maule', 'ML', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(681, 43, 'Region Metropolitana', 'RM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(682, 43, 'Tarapaca', 'TA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(683, 43, 'Valparaiso', 'VS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(684, 44, 'Anhui', 'AN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(685, 44, 'Beijing', 'BE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(686, 44, 'Chongqing', 'CH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(687, 44, 'Fujian', 'FU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(688, 44, 'Gansu', 'GA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(689, 44, 'Guangdong', 'GU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(690, 44, 'Guangxi', 'GX', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(691, 44, 'Guizhou', 'GZ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(692, 44, 'Hainan', 'HA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(693, 44, 'Hebei', 'HB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(694, 44, 'Heilongjiang', 'HL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(695, 44, 'Henan', 'HE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(696, 44, 'Hong Kong', 'HK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(697, 44, 'Hubei', 'HU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(698, 44, 'Hunan', 'HN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(699, 44, 'Inner Mongolia', 'IM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(700, 44, 'Jiangsu', 'JI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(701, 44, 'Jiangxi', 'JX', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(702, 44, 'Jilin', 'JL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(703, 44, 'Liaoning', 'LI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(704, 44, 'Macau', 'MA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(705, 44, 'Ningxia', 'NI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(706, 44, 'Shaanxi', 'SH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(707, 44, 'Shandong', 'SA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(708, 44, 'Shanghai', 'SG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(709, 44, 'Shanxi', 'SX', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(710, 44, 'Sichuan', 'SI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(711, 44, 'Tianjin', 'TI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(712, 44, 'Xinjiang', 'XI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(713, 44, 'Yunnan', 'YU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(714, 44, 'Zhejiang', 'ZH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(715, 46, 'Direction Island', 'D', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(716, 46, 'Home Island', 'H', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(717, 46, 'Horsburgh Island', 'O', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(718, 46, 'South Island', 'S', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(719, 46, 'West Island', 'W', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(720, 47, 'Amazonas', 'AMZ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(721, 47, 'Antioquia', 'ANT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(722, 47, 'Arauca', 'ARA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(723, 47, 'Atlantico', 'ATL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(724, 47, 'Bogota D.C.', 'BDC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(725, 47, 'Bolivar', 'BOL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(726, 47, 'Boyaca', 'BOY', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(727, 47, 'Caldas', 'CAL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(728, 47, 'Caqueta', 'CAQ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(729, 47, 'Casanare', 'CAS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(730, 47, 'Cauca', 'CAU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(731, 47, 'Cesar', 'CES', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(732, 47, 'Choco', 'CHO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(733, 47, 'Cordoba', 'COR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(734, 47, 'Cundinamarca', 'CAM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(735, 47, 'Guainia', 'GNA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(736, 47, 'Guajira', 'GJR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(737, 47, 'Guaviare', 'GVR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(738, 47, 'Huila', 'HUI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(739, 47, 'Magdalena', 'MAG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(740, 47, 'Meta', 'MET', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(741, 47, 'Narino', 'NAR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(742, 47, 'Norte de Santander', 'NDS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(743, 47, 'Putumayo', 'PUT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(744, 47, 'Quindio', 'QUI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(745, 47, 'Risaralda', 'RIS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(746, 47, 'San Andres y Providencia', 'SAP', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(747, 47, 'Santander', 'SAN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(748, 47, 'Sucre', 'SUC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(749, 47, 'Tolima', 'TOL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(750, 47, 'Valle del Cauca', 'VDC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(751, 47, 'Vaupes', 'VAU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(752, 47, 'Vichada', 'VIC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(753, 48, 'Grande Comore', 'G', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(754, 48, 'Anjouan', 'A', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(755, 48, 'Moheli', 'M', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(756, 49, 'Bouenza', 'BO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(757, 49, 'Brazzaville', 'BR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(758, 49, 'Cuvette', 'CU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(759, 49, 'Cuvette-Ouest', 'CO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(760, 49, 'Kouilou', 'KO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(761, 49, 'Lekoumou', 'LE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(762, 49, 'Likouala', 'LI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(763, 49, 'Niari', 'NI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(764, 49, 'Plateaux', 'PL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(765, 49, 'Pool', 'PO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(766, 49, 'Sangha', 'SA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(767, 50, 'Pukapuka', 'PU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(768, 50, 'Rakahanga', 'RK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(769, 50, 'Manihiki', 'MK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(770, 50, 'Penrhyn', 'PE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(771, 50, 'Nassau Island', 'NI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(772, 50, 'Surwarrow', 'SU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(773, 50, 'Palmerston', 'PA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(774, 50, 'Aitutaki', 'AI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(775, 50, 'Manuae', 'MA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(776, 50, 'Takutea', 'TA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(777, 50, 'Mitiaro', 'MT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(778, 50, 'Atiu', 'AT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(779, 50, 'Mauke', 'MU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(780, 50, 'Rarotonga', 'RR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(781, 50, 'Mangaia', 'MG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(782, 51, 'Alajuela', 'AL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(783, 51, 'Cartago', 'CA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(784, 51, 'Guanacaste', 'GU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(785, 51, 'Heredia', 'HE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(786, 51, 'Limon', 'LI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(787, 51, 'Puntarenas', 'PU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(788, 51, 'San Jose', 'SJ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(789, 52, 'Abengourou', 'ABE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(790, 52, 'Abidjan', 'ABI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(791, 52, 'Aboisso', 'ABO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(792, 52, 'Adiake', 'ADI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(793, 52, 'Adzope', 'ADZ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(794, 52, 'Agboville', 'AGB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(795, 52, 'Agnibilekrou', 'AGN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(796, 52, 'Alepe', 'ALE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(797, 52, 'Bocanda', 'BOC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(798, 52, 'Bangolo', 'BAN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(799, 52, 'Beoumi', 'BEO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(800, 52, 'Biankouma', 'BIA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(801, 52, 'Bondoukou', 'BDK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(802, 52, 'Bongouanou', 'BGN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(803, 52, 'Bouafle', 'BFL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(804, 52, 'Bouake', 'BKE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(805, 52, 'Bouna', 'BNA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(806, 52, 'Boundiali', 'BDL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(807, 52, 'Dabakala', 'DKL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(808, 52, 'Dabou', 'DBU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(809, 52, 'Daloa', 'DAL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(810, 52, 'Danane', 'DAN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(811, 52, 'Daoukro', 'DAO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(812, 52, 'Dimbokro', 'DIM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(813, 52, 'Divo', 'DIV', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(814, 52, 'Duekoue', 'DUE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(815, 52, 'Ferkessedougou', 'FER', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(816, 52, 'Gagnoa', 'GAG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(817, 52, 'Grand-Bassam', 'GBA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(818, 52, 'Grand-Lahou', 'GLA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(819, 52, 'Guiglo', 'GUI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(820, 52, 'Issia', 'ISS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(821, 52, 'Jacqueville', 'JAC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(822, 52, 'Katiola', 'KAT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(823, 52, 'Korhogo', 'KOR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(824, 52, 'Lakota', 'LAK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(825, 52, 'Man', 'MAN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(826, 52, 'Mankono', 'MKN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(827, 52, 'Mbahiakro', 'MBA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(828, 52, 'Odienne', 'ODI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(829, 52, 'Oume', 'OUM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(830, 52, 'Sakassou', 'SAK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(831, 52, 'San-Pedro', 'SPE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(832, 52, 'Sassandra', 'SAS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(833, 52, 'Seguela', 'SEG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(834, 52, 'Sinfra', 'SIN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(835, 52, 'Soubre', 'SOU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(836, 52, 'Tabou', 'TAB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(837, 52, 'Tanda', 'TAN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(838, 52, 'Tiebissou', 'TIE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(839, 52, 'Tingrela', 'TIN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(840, 52, 'Tiassale', 'TIA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(841, 52, 'Touba', 'TBA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(842, 52, 'Toulepleu', 'TLP', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(843, 52, 'Toumodi', 'TMD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(844, 52, 'Vavoua', 'VAV', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(845, 52, 'Yamoussoukro', 'YAM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(846, 52, 'Zuenoula', 'ZUE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(847, 53, 'Bjelovarsko-bilogorska', 'BB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(848, 53, 'Grad Zagreb', 'GZ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(849, 53, 'Dubrovačko-neretvanska', 'DN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(850, 53, 'Istarska', 'IS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(851, 53, 'Karlovačka', 'KA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(852, 53, 'Koprivničko-križevačka', 'KK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(853, 53, 'Krapinsko-zagorska', 'KZ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(854, 53, 'Ličko-senjska', 'LS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(855, 53, 'Međimurska', 'ME', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(856, 53, 'Osječko-baranjska', 'OB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(857, 53, 'Požeško-slavonska', 'PS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(858, 53, 'Primorsko-goranska', 'PG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(859, 53, 'Šibensko-kninska', 'SK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(860, 53, 'Sisačko-moslavačka', 'SM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(861, 53, 'Brodsko-posavska', 'BP', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(862, 53, 'Splitsko-dalmatinska', 'SD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(863, 53, 'Varaždinska', 'VA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(864, 53, 'Virovitičko-podravska', 'VP', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(865, 53, 'Vukovarsko-srijemska', 'VS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(866, 53, 'Zadarska', 'ZA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(867, 53, 'Zagrebačka', 'ZG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(868, 54, 'Camaguey', 'CA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(869, 54, 'Ciego de Avila', 'CD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(870, 54, 'Cienfuegos', 'CI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(871, 54, 'Ciudad de La Habana', 'CH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(872, 54, 'Granma', 'GR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(873, 54, 'Guantanamo', 'GU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(874, 54, 'Holguin', 'HO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(875, 54, 'Isla de la Juventud', 'IJ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(876, 54, 'La Habana', 'LH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(877, 54, 'Las Tunas', 'LT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(878, 54, 'Matanzas', 'MA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(879, 54, 'Pinar del Rio', 'PR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(880, 54, 'Sancti Spiritus', 'SS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(881, 54, 'Santiago de Cuba', 'SC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(882, 54, 'Villa Clara', 'VC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(883, 55, 'Famagusta', 'F', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(884, 55, 'Kyrenia', 'K', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(885, 55, 'Larnaca', 'A', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(886, 55, 'Limassol', 'I', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(887, 55, 'Nicosia', 'N', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(888, 55, 'Paphos', 'P', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(889, 56, 'Ústecký', 'U', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(890, 56, 'Jihočeský', 'C', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(891, 56, 'Jihomoravský', 'B', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(892, 56, 'Karlovarský', 'K', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(893, 56, 'Královehradecký', 'H', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(894, 56, 'Liberecký', 'L', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(895, 56, 'Moravskoslezský', 'T', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(896, 56, 'Olomoucký', 'M', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(897, 56, 'Pardubický', 'E', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(898, 56, 'Plzeňský', 'P', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(899, 56, 'Praha', 'A', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(900, 56, 'Středočeský', 'S', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(901, 56, 'Vysočina', 'J', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(902, 56, 'Zlínský', 'Z', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(903, 57, 'Arhus', 'AR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(904, 57, 'Bornholm', 'BH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(905, 57, 'Copenhagen', 'CO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(906, 57, 'Faroe Islands', 'FO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(907, 57, 'Frederiksborg', 'FR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(908, 57, 'Fyn', 'FY', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(909, 57, 'Kobenhavn', 'KO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(910, 57, 'Nordjylland', 'NO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(911, 57, 'Ribe', 'RI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(912, 57, 'Ringkobing', 'RK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(913, 57, 'Roskilde', 'RO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(914, 57, 'Sonderjylland', 'SO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(915, 57, 'Storstrom', 'ST', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(916, 57, 'Vejle', 'VK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(917, 57, 'Vestj&aelig;lland', 'VJ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(918, 57, 'Viborg', 'VB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(919, 58, '''Ali Sabih', 'S', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(920, 58, 'Dikhil', 'K', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(921, 58, 'Djibouti', 'J', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(922, 58, 'Obock', 'O', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(923, 58, 'Tadjoura', 'T', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(924, 59, 'Saint Andrew Parish', 'AND', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(925, 59, 'Saint David Parish', 'DAV', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(926, 59, 'Saint George Parish', 'GEO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(927, 59, 'Saint John Parish', 'JOH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(928, 59, 'Saint Joseph Parish', 'JOS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(929, 59, 'Saint Luke Parish', 'LUK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(930, 59, 'Saint Mark Parish', 'MAR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(931, 59, 'Saint Patrick Parish', 'PAT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(932, 59, 'Saint Paul Parish', 'PAU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(933, 59, 'Saint Peter Parish', 'PET', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(934, 60, 'Distrito Nacional', 'DN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(935, 60, 'Azua', 'AZ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(936, 60, 'Baoruco', 'BC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(937, 60, 'Barahona', 'BH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(938, 60, 'Dajabon', 'DJ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(939, 60, 'Duarte', 'DU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(940, 60, 'Elias Pina', 'EL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(941, 60, 'El Seybo', 'SY', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(942, 60, 'Espaillat', 'ET', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(943, 60, 'Hato Mayor', 'HM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(944, 60, 'Independencia', 'IN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(945, 60, 'La Altagracia', 'AL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(946, 60, 'La Romana', 'RO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(947, 60, 'La Vega', 'VE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(948, 60, 'Maria Trinidad Sanchez', 'MT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(949, 60, 'Monsenor Nouel', 'MN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(950, 60, 'Monte Cristi', 'MC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(951, 60, 'Monte Plata', 'MP', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(952, 60, 'Pedernales', 'PD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(953, 60, 'Peravia (Bani)', 'PR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(954, 60, 'Puerto Plata', 'PP', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(955, 60, 'Salcedo', 'SL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(956, 60, 'Samana', 'SM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(957, 60, 'Sanchez Ramirez', 'SH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(958, 60, 'San Cristobal', 'SC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(959, 60, 'San Jose de Ocoa', 'JO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(960, 60, 'San Juan', 'SJ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(961, 60, 'San Pedro de Macoris', 'PM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(962, 60, 'Santiago', 'SA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(963, 60, 'Santiago Rodriguez', 'ST', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(964, 60, 'Santo Domingo', 'SD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(965, 60, 'Valverde', 'VA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(966, 61, 'Aileu', 'AL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(967, 61, 'Ainaro', 'AN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(968, 61, 'Baucau', 'BA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(969, 61, 'Bobonaro', 'BO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(970, 61, 'Cova Lima', 'CO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(971, 61, 'Dili', 'DI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(972, 61, 'Ermera', 'ER', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(973, 61, 'Lautem', 'LA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(974, 61, 'Liquica', 'LI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(975, 61, 'Manatuto', 'MT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(976, 61, 'Manufahi', 'MF', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(977, 61, 'Oecussi', 'OE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(978, 61, 'Viqueque', 'VI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(979, 62, 'Azuay', 'AZU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(980, 62, 'Bolivar', 'BOL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(981, 62, 'Ca&ntilde;ar', 'CAN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(982, 62, 'Carchi', 'CAR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(983, 62, 'Chimborazo', 'CHI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(984, 62, 'Cotopaxi', 'COT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(985, 62, 'El Oro', 'EOR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(986, 62, 'Esmeraldas', 'ESM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(987, 62, 'Gal&aacute;pagos', 'GPS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(988, 62, 'Guayas', 'GUA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(989, 62, 'Imbabura', 'IMB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(990, 62, 'Loja', 'LOJ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(991, 62, 'Los Rios', 'LRO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(992, 62, 'Manab&iacute;', 'MAN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(993, 62, 'Morona Santiago', 'MSA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(994, 62, 'Napo', 'NAP', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(995, 62, 'Orellana', 'ORE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(996, 62, 'Pastaza', 'PAS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(997, 62, 'Pichincha', 'PIC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(998, 62, 'Sucumb&iacute;os', 'SUC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(999, 62, 'Tungurahua', 'TUN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1000, 62, 'Zamora Chinchipe', 'ZCH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1001, 63, 'Ad Daqahliyah', 'DHY', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1002, 63, 'Al Bahr al Ahmar', 'BAM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1003, 63, 'Al Buhayrah', 'BHY', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1004, 63, 'Al Fayyum', 'FYM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1005, 63, 'Al Gharbiyah', 'GBY', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1006, 63, 'Al Iskandariyah', 'IDR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1007, 63, 'Al Isma''iliyah', 'IML', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1008, 63, 'Al Jizah', 'JZH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1009, 63, 'Al Minufiyah', 'MFY', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1010, 63, 'Al Minya', 'MNY', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1011, 63, 'Al Qahirah', 'QHR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1012, 63, 'Al Qalyubiyah', 'QLY', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1013, 63, 'Al Wadi al Jadid', 'WJD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1014, 63, 'Ash Sharqiyah', 'SHQ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1015, 63, 'As Suways', 'SWY', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1016, 63, 'Aswan', 'ASW', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1017, 63, 'Asyut', 'ASY', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1018, 63, 'Bani Suwayf', 'BSW', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1019, 63, 'Bur Sa''id', 'BSD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1020, 63, 'Dumyat', 'DMY', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1021, 63, 'Janub Sina''', 'JNS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1022, 63, 'Kafr ash Shaykh', 'KSH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1023, 63, 'Matruh', 'MAT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1024, 63, 'Qina', 'QIN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1025, 63, 'Shamal Sina''', 'SHS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1026, 63, 'Suhaj', 'SUH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1027, 64, 'Ahuachapan', 'AH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1028, 64, 'Cabanas', 'CA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1029, 64, 'Chalatenango', 'CH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1030, 64, 'Cuscatlan', 'CU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1031, 64, 'La Libertad', 'LB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1032, 64, 'La Paz', 'PZ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1033, 64, 'La Union', 'UN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1034, 64, 'Morazan', 'MO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1035, 64, 'San Miguel', 'SM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1036, 64, 'San Salvador', 'SS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1037, 64, 'San Vicente', 'SV', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1038, 64, 'Santa Ana', 'SA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1039, 64, 'Sonsonate', 'SO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1040, 64, 'Usulutan', 'US', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1041, 65, 'Provincia Annobon', 'AN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1042, 65, 'Provincia Bioko Norte', 'BN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1043, 65, 'Provincia Bioko Sur', 'BS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1044, 65, 'Provincia Centro Sur', 'CS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1045, 65, 'Provincia Kie-Ntem', 'KN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1046, 65, 'Provincia Litoral', 'LI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1047, 65, 'Provincia Wele-Nzas', 'WN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1048, 66, 'Central (Maekel)', 'MA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1049, 66, 'Anseba (Keren)', 'KE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1050, 66, 'Southern Red Sea (Debub-Keih-Bahri)', 'DK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1051, 66, 'Northern Red Sea (Semien-Keih-Bahri)', 'SK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1052, 66, 'Southern (Debub)', 'DE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1053, 66, 'Gash-Barka (Barentu)', 'BR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1054, 67, 'Harjumaa (Tallinn)', 'HA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1055, 67, 'Hiiumaa (Kardla)', 'HI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1056, 67, 'Ida-Virumaa (Johvi)', 'IV', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1057, 67, 'Jarvamaa (Paide)', 'JA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1058, 67, 'Jogevamaa (Jogeva)', 'JO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1059, 67, 'Laane-Virumaa (Rakvere)', 'LV', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1060, 67, 'Laanemaa (Haapsalu)', 'LA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1061, 67, 'Parnumaa (Parnu)', 'PA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1062, 67, 'Polvamaa (Polva)', 'PO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1063, 67, 'Raplamaa (Rapla)', 'RA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1064, 67, 'Saaremaa (Kuessaare)', 'SA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1065, 67, 'Tartumaa (Tartu)', 'TA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1066, 67, 'Valgamaa (Valga)', 'VA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1067, 67, 'Viljandimaa (Viljandi)', 'VI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1068, 67, 'Vorumaa (Voru)', 'VO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1069, 68, 'Afar', 'AF', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1070, 68, 'Amhara', 'AH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1071, 68, 'Benishangul-Gumaz', 'BG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1072, 68, 'Gambela', 'GB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1073, 68, 'Hariai', 'HR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1074, 68, 'Oromia', 'OR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1075, 68, 'Somali', 'SM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1076, 68, 'Southern Nations - Nationalities and Peoples Region', 'SN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1077, 68, 'Tigray', 'TG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1078, 68, 'Addis Ababa', 'AA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1079, 68, 'Dire Dawa', 'DD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1080, 71, 'Central Division', 'C', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1081, 71, 'Northern Division', 'N', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1082, 71, 'Eastern Division', 'E', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1083, 71, 'Western Division', 'W', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1084, 71, 'Rotuma', 'R', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1085, 72, 'Ahvenanmaan lääni', 'AL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1086, 72, 'Etelä-Suomen lääni', 'ES', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1087, 72, 'Itä-Suomen lääni', 'IS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1088, 72, 'Länsi-Suomen lääni', 'LS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1089, 72, 'Lapin lääni', 'LA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1090, 72, 'Oulun lääni', 'OU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1114, 74, 'Ain', '01', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1115, 74, 'Aisne', '02', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1116, 74, 'Allier', '03', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1117, 74, 'Alpes de Haute Provence', '04', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1118, 74, 'Hautes-Alpes', '05', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1119, 74, 'Alpes Maritimes', '06', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1120, 74, 'Ard&egrave;che', '07', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1121, 74, 'Ardennes', '08', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1122, 74, 'Ari&egrave;ge', '09', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1123, 74, 'Aube', '10', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1124, 74, 'Aude', '11', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1125, 74, 'Aveyron', '12', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1126, 74, 'Bouches du Rh&ocirc;ne', '13', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1127, 74, 'Calvados', '14', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1128, 74, 'Cantal', '15', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1129, 74, 'Charente', '16', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1130, 74, 'Charente Maritime', '17', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1131, 74, 'Cher', '18', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1132, 74, 'Corr&egrave;ze', '19', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1133, 74, 'Corse du Sud', '2A', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1134, 74, 'Haute Corse', '2B', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1135, 74, 'C&ocirc;te d&#039;or', '21', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1136, 74, 'C&ocirc;tes d&#039;Armor', '22', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1137, 74, 'Creuse', '23', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1138, 74, 'Dordogne', '24', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1139, 74, 'Doubs', '25', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1140, 74, 'Dr&ocirc;me', '26', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1141, 74, 'Eure', '27', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1142, 74, 'Eure et Loir', '28', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1143, 74, 'Finist&egrave;re', '29', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1144, 74, 'Gard', '30', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1145, 74, 'Haute Garonne', '31', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1146, 74, 'Gers', '32', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1147, 74, 'Gironde', '33', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1148, 74, 'H&eacute;rault', '34', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1149, 74, 'Ille et Vilaine', '35', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1150, 74, 'Indre', '36', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1151, 74, 'Indre et Loire', '37', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1152, 74, 'Is&eacute;re', '38', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1153, 74, 'Jura', '39', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1154, 74, 'Landes', '40', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1155, 74, 'Loir et Cher', '41', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1156, 74, 'Loire', '42', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1157, 74, 'Haute Loire', '43', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1158, 74, 'Loire Atlantique', '44', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1159, 74, 'Loiret', '45', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1160, 74, 'Lot', '46', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1161, 74, 'Lot et Garonne', '47', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1162, 74, 'Loz&egrave;re', '48', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1163, 74, 'Maine et Loire', '49', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1164, 74, 'Manche', '50', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1165, 74, 'Marne', '51', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1166, 74, 'Haute Marne', '52', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1167, 74, 'Mayenne', '53', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1168, 74, 'Meurthe et Moselle', '54', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1169, 74, 'Meuse', '55', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1170, 74, 'Morbihan', '56', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0);
INSERT INTO `state` (`state_id`, `country_id`, `state_name`, `state_code`, `date_added`, `added_by`, `date_modified`, `modified_by`, `status`, `is_deleted`) VALUES
(1171, 74, 'Moselle', '57', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1172, 74, 'Ni&egrave;vre', '58', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1173, 74, 'Nord', '59', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1174, 74, 'Oise', '60', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1175, 74, 'Orne', '61', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1176, 74, 'Pas de Calais', '62', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1177, 74, 'Puy de D&ocirc;me', '63', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1178, 74, 'Pyr&eacute;n&eacute;es Atlantiques', '64', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1179, 74, 'Hautes Pyr&eacute;n&eacute;es', '65', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1180, 74, 'Pyr&eacute;n&eacute;es Orientales', '66', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1181, 74, 'Bas Rhin', '67', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1182, 74, 'Haut Rhin', '68', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1183, 74, 'Rh&ocirc;ne', '69', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1184, 74, 'Haute Sa&ocirc;ne', '70', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1185, 74, 'Sa&ocirc;ne et Loire', '71', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1186, 74, 'Sarthe', '72', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1187, 74, 'Savoie', '73', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1188, 74, 'Haute Savoie', '74', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1189, 74, 'Paris', '75', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1190, 74, 'Seine Maritime', '76', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1191, 74, 'Seine et Marne', '77', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1192, 74, 'Yvelines', '78', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1193, 74, 'Deux S&egrave;vres', '79', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1194, 74, 'Somme', '80', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1195, 74, 'Tarn', '81', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1196, 74, 'Tarn et Garonne', '82', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1197, 74, 'Var', '83', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1198, 74, 'Vaucluse', '84', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1199, 74, 'Vend&eacute;e', '85', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1200, 74, 'Vienne', '86', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1201, 74, 'Haute Vienne', '87', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1202, 74, 'Vosges', '88', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1203, 74, 'Yonne', '89', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1204, 74, 'Territoire de Belfort', '90', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1205, 74, 'Essonne', '91', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1206, 74, 'Hauts de Seine', '92', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1207, 74, 'Seine St-Denis', '93', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1208, 74, 'Val de Marne', '94', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1209, 74, 'Val d''Oise', '95', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1210, 76, 'Archipel des Marquises', 'M', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1211, 76, 'Archipel des Tuamotu', 'T', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1212, 76, 'Archipel des Tubuai', 'I', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1213, 76, 'Iles du Vent', 'V', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1214, 76, 'Iles Sous-le-Vent', 'S', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1215, 77, 'Iles Crozet', 'C', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1216, 77, 'Iles Kerguelen', 'K', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1217, 77, 'Ile Amsterdam', 'A', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1218, 77, 'Ile Saint-Paul', 'P', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1219, 77, 'Adelie Land', 'D', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1220, 78, 'Estuaire', 'ES', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1221, 78, 'Haut-Ogooue', 'HO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1222, 78, 'Moyen-Ogooue', 'MO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1223, 78, 'Ngounie', 'NG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1224, 78, 'Nyanga', 'NY', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1225, 78, 'Ogooue-Ivindo', 'OI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1226, 78, 'Ogooue-Lolo', 'OL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1227, 78, 'Ogooue-Maritime', 'OM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1228, 78, 'Woleu-Ntem', 'WN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1229, 79, 'Banjul', 'BJ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1230, 79, 'Basse', 'BS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1231, 79, 'Brikama', 'BR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1232, 79, 'Janjangbure', 'JA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1233, 79, 'Kanifeng', 'KA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1234, 79, 'Kerewan', 'KE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1235, 79, 'Kuntaur', 'KU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1236, 79, 'Mansakonko', 'MA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1237, 79, 'Lower River', 'LR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1238, 79, 'Central River', 'CR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1239, 79, 'North Bank', 'NB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1240, 79, 'Upper River', 'UR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1241, 79, 'Western', 'WE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1242, 80, 'Abkhazia', 'AB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1243, 80, 'Ajaria', 'AJ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1244, 80, 'Tbilisi', 'TB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1245, 80, 'Guria', 'GU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1246, 80, 'Imereti', 'IM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1247, 80, 'Kakheti', 'KA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1248, 80, 'Kvemo Kartli', 'KK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1249, 80, 'Mtskheta-Mtianeti', 'MM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1250, 80, 'Racha Lechkhumi and Kvemo Svanet', 'RL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1251, 80, 'Samegrelo-Zemo Svaneti', 'SZ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1252, 80, 'Samtskhe-Javakheti', 'SJ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1253, 80, 'Shida Kartli', 'SK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1254, 81, 'Baden-W&uuml;rttemberg', 'BAW', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1255, 81, 'Bayern', 'BAY', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1256, 81, 'Berlin', 'BER', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1257, 81, 'Brandenburg', 'BRG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1258, 81, 'Bremen', 'BRE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1259, 81, 'Hamburg', 'HAM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1260, 81, 'Hessen', 'HES', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1261, 81, 'Mecklenburg-Vorpommern', 'MEC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1262, 81, 'Niedersachsen', 'NDS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1263, 81, 'Nordrhein-Westfalen', 'NRW', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1264, 81, 'Rheinland-Pfalz', 'RHE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1265, 81, 'Saarland', 'SAR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1266, 81, 'Sachsen', 'SAS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1267, 81, 'Sachsen-Anhalt', 'SAC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1268, 81, 'Schleswig-Holstein', 'SCN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1269, 81, 'Th&uuml;ringen', 'THE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1270, 82, 'Ashanti Region', 'AS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1271, 82, 'Brong-Ahafo Region', 'BA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1272, 82, 'Central Region', 'CE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1273, 82, 'Eastern Region', 'EA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1274, 82, 'Greater Accra Region', 'GA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1275, 82, 'Northern Region', 'NO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1276, 82, 'Upper East Region', 'UE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1277, 82, 'Upper West Region', 'UW', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1278, 82, 'Volta Region', 'VO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1279, 82, 'Western Region', 'WE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1280, 84, 'Attica', 'AT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1281, 84, 'Central Greece', 'CN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1282, 84, 'Central Macedonia', 'CM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1283, 84, 'Crete', 'CR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1284, 84, 'East Macedonia and Thrace', 'EM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1285, 84, 'Epirus', 'EP', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1286, 84, 'Ionian Islands', 'II', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1287, 84, 'North Aegean', 'NA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1288, 84, 'Peloponnesos', 'PP', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1289, 84, 'South Aegean', 'SA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1290, 84, 'Thessaly', 'TH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1291, 84, 'West Greece', 'WG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1292, 84, 'West Macedonia', 'WM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1293, 85, 'Avannaa', 'A', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1294, 85, 'Tunu', 'T', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1295, 85, 'Kitaa', 'K', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1296, 86, 'Saint Andrew', 'A', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1297, 86, 'Saint David', 'D', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1298, 86, 'Saint George', 'G', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1299, 86, 'Saint John', 'J', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1300, 86, 'Saint Mark', 'M', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1301, 86, 'Saint Patrick', 'P', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1302, 86, 'Carriacou', 'C', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1303, 86, 'Petit Martinique', 'Q', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1304, 89, 'Alta Verapaz', 'AV', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1305, 89, 'Baja Verapaz', 'BV', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1306, 89, 'Chimaltenango', 'CM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1307, 89, 'Chiquimula', 'CQ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1308, 89, 'El Peten', 'PE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1309, 89, 'El Progreso', 'PR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1310, 89, 'El Quiche', 'QC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1311, 89, 'Escuintla', 'ES', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1312, 89, 'Guatemala', 'GU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1313, 89, 'Huehuetenango', 'HU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1314, 89, 'Izabal', 'IZ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1315, 89, 'Jalapa', 'JA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1316, 89, 'Jutiapa', 'JU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1317, 89, 'Quetzaltenango', 'QZ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1318, 89, 'Retalhuleu', 'RE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1319, 89, 'Sacatepequez', 'ST', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1320, 89, 'San Marcos', 'SM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1321, 89, 'Santa Rosa', 'SR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1322, 89, 'Solola', 'SO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1323, 89, 'Suchitepequez', 'SU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1324, 89, 'Totonicapan', 'TO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1325, 89, 'Zacapa', 'ZA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1326, 90, 'Conakry', 'CNK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1327, 90, 'Beyla', 'BYL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1328, 90, 'Boffa', 'BFA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1329, 90, 'Boke', 'BOK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1330, 90, 'Coyah', 'COY', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1331, 90, 'Dabola', 'DBL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1332, 90, 'Dalaba', 'DLB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1333, 90, 'Dinguiraye', 'DGR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1334, 90, 'Dubreka', 'DBR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1335, 90, 'Faranah', 'FRN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1336, 90, 'Forecariah', 'FRC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1337, 90, 'Fria', 'FRI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1338, 90, 'Gaoual', 'GAO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1339, 90, 'Gueckedou', 'GCD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1340, 90, 'Kankan', 'KNK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1341, 90, 'Kerouane', 'KRN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1342, 90, 'Kindia', 'KND', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1343, 90, 'Kissidougou', 'KSD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1344, 90, 'Koubia', 'KBA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1345, 90, 'Koundara', 'KDA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1346, 90, 'Kouroussa', 'KRA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1347, 90, 'Labe', 'LAB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1348, 90, 'Lelouma', 'LLM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1349, 90, 'Lola', 'LOL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1350, 90, 'Macenta', 'MCT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1351, 90, 'Mali', 'MAL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1352, 90, 'Mamou', 'MAM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1353, 90, 'Mandiana', 'MAN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1354, 90, 'Nzerekore', 'NZR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1355, 90, 'Pita', 'PIT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1356, 90, 'Siguiri', 'SIG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1357, 90, 'Telimele', 'TLM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1358, 90, 'Tougue', 'TOG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1359, 90, 'Yomou', 'YOM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1360, 91, 'Bafata Region', 'BF', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1361, 91, 'Biombo Region', 'BB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1362, 91, 'Bissau Region', 'BS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1363, 91, 'Bolama Region', 'BL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1364, 91, 'Cacheu Region', 'CA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1365, 91, 'Gabu Region', 'GA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1366, 91, 'Oio Region', 'OI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1367, 91, 'Quinara Region', 'QU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1368, 91, 'Tombali Region', 'TO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1369, 92, 'Barima-Waini', 'BW', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1370, 92, 'Cuyuni-Mazaruni', 'CM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1371, 92, 'Demerara-Mahaica', 'DM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1372, 92, 'East Berbice-Corentyne', 'EC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1373, 92, 'Essequibo Islands-West Demerara', 'EW', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1374, 92, 'Mahaica-Berbice', 'MB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1375, 92, 'Pomeroon-Supenaam', 'PM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1376, 92, 'Potaro-Siparuni', 'PI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1377, 92, 'Upper Demerara-Berbice', 'UD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1378, 92, 'Upper Takutu-Upper Essequibo', 'UT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1379, 93, 'Artibonite', 'AR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1380, 93, 'Centre', 'CE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1381, 93, 'Grand''Anse', 'GA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1382, 93, 'Nord', 'ND', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1383, 93, 'Nord-Est', 'NE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1384, 93, 'Nord-Ouest', 'NO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1385, 93, 'Ouest', 'OU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1386, 93, 'Sud', 'SD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1387, 93, 'Sud-Est', 'SE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1388, 94, 'Flat Island', 'F', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1389, 94, 'McDonald Island', 'M', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1390, 94, 'Shag Island', 'S', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1391, 94, 'Heard Island', 'H', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1392, 95, 'Atlantida', 'AT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1393, 95, 'Choluteca', 'CH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1394, 95, 'Colon', 'CL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1395, 95, 'Comayagua', 'CM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1396, 95, 'Copan', 'CP', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1397, 95, 'Cortes', 'CR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1398, 95, 'El Paraiso', 'PA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1399, 95, 'Francisco Morazan', 'FM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1400, 95, 'Gracias a Dios', 'GD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1401, 95, 'Intibuca', 'IN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1402, 95, 'Islas de la Bahia (Bay Islands)', 'IB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1403, 95, 'La Paz', 'PZ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1404, 95, 'Lempira', 'LE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1405, 95, 'Ocotepeque', 'OC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1406, 95, 'Olancho', 'OL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1407, 95, 'Santa Barbara', 'SB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1408, 95, 'Valle', 'VA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1409, 95, 'Yoro', 'YO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1410, 96, 'Central and Western Hong Kong Island', 'HCW', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1411, 96, 'Eastern Hong Kong Island', 'HEA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1412, 96, 'Southern Hong Kong Island', 'HSO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1413, 96, 'Wan Chai Hong Kong Island', 'HWC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1414, 96, 'Kowloon City Kowloon', 'KKC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1415, 96, 'Kwun Tong Kowloon', 'KKT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1416, 96, 'Sham Shui Po Kowloon', 'KSS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1417, 96, 'Wong Tai Sin Kowloon', 'KWT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1418, 96, 'Yau Tsim Mong Kowloon', 'KYT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1419, 96, 'Islands New Territories', 'NIS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1420, 96, 'Kwai Tsing New Territories', 'NKT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1421, 96, 'North New Territories', 'NNO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1422, 96, 'Sai Kung New Territories', 'NSK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1423, 96, 'Sha Tin New Territories', 'NST', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1424, 96, 'Tai Po New Territories', 'NTP', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1425, 96, 'Tsuen Wan New Territories', 'NTW', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1426, 96, 'Tuen Mun New Territories', 'NTM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1427, 96, 'Yuen Long New Territories', 'NYL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1467, 98, 'Austurland', 'AL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1468, 98, 'Hofuoborgarsvaeoi', 'HF', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1469, 98, 'Norourland eystra', 'NE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1470, 98, 'Norourland vestra', 'NV', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1471, 98, 'Suourland', 'SL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1472, 98, 'Suournes', 'SN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1473, 98, 'Vestfiroir', 'VF', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1474, 98, 'Vesturland', 'VL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1475, 99, 'Andaman and Nicobar Islands', 'AN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1476, 99, 'Andhra Pradesh', 'AP', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1477, 99, 'Arunachal Pradesh', 'AR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1478, 99, 'Assam', 'AS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1479, 99, 'Bihar', 'BI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1480, 99, 'Chandigarh', 'CH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1481, 99, 'Dadra and Nagar Haveli', 'DA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1482, 99, 'Daman and Diu', 'DM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1483, 99, 'Delhi', 'DE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1484, 99, 'Goa', 'GO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1485, 99, 'Gujarat', 'GU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1486, 99, 'Haryana', 'HA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1487, 99, 'Himachal Pradesh', 'HP', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1488, 99, 'Jammu and Kashmir', 'JA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1489, 99, 'Karnataka', 'KA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1490, 99, 'Kerala', 'KE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1491, 99, 'Lakshadweep Islands', 'LI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1492, 99, 'Madhya Pradesh', 'MP', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1493, 99, 'Maharashtra', 'MA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1494, 99, 'Manipur', 'MN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1495, 99, 'Meghalaya', 'ME', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1496, 99, 'Mizoram', 'MI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1497, 99, 'Nagaland', 'NA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1498, 99, 'Orissa', 'OR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1499, 99, 'Puducherry', 'PO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1500, 99, 'Punjab', 'PU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1501, 99, 'Rajasthan', 'RA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1502, 99, 'Sikkim', 'SI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1503, 99, 'Tamil Nadu', 'TN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1504, 99, 'Tripura', 'TR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1505, 99, 'Uttar Pradesh', 'UP', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1506, 99, 'West Bengal', 'WB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1507, 100, 'Aceh', 'AC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1508, 100, 'Bali', 'BA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1509, 100, 'Banten', 'BT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1510, 100, 'Bengkulu', 'BE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1511, 100, 'BoDeTaBek', 'BD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1512, 100, 'Gorontalo', 'GO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1513, 100, 'Jakarta Raya', 'JK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1514, 100, 'Jambi', 'JA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1515, 100, 'Jawa Barat', 'JB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1516, 100, 'Jawa Tengah', 'JT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1517, 100, 'Jawa Timur', 'JI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1518, 100, 'Kalimantan Barat', 'KB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1519, 100, 'Kalimantan Selatan', 'KS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1520, 100, 'Kalimantan Tengah', 'KT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1521, 100, 'Kalimantan Timur', 'KI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1522, 100, 'Kepulauan Bangka Belitung', 'BB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1523, 100, 'Lampung', 'LA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1524, 100, 'Maluku', 'MA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1525, 100, 'Maluku Utara', 'MU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1526, 100, 'Nusa Tenggara Barat', 'NB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1527, 100, 'Nusa Tenggara Timur', 'NT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1528, 100, 'Papua', 'PA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1529, 100, 'Riau', 'RI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1530, 100, 'Sulawesi Selatan', 'SN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1531, 100, 'Sulawesi Tengah', 'ST', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1532, 100, 'Sulawesi Tenggara', 'SG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1533, 100, 'Sulawesi Utara', 'SA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1534, 100, 'Sumatera Barat', 'SB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1535, 100, 'Sumatera Selatan', 'SS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1536, 100, 'Sumatera Utara', 'SU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1537, 100, 'Yogyakarta', 'YO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1538, 101, 'Tehran', 'TEH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1539, 101, 'Qom', 'QOM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1540, 101, 'Markazi', 'MKZ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1541, 101, 'Qazvin', 'QAZ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1542, 101, 'Gilan', 'GIL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1543, 101, 'Ardabil', 'ARD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1544, 101, 'Zanjan', 'ZAN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1545, 101, 'East Azarbaijan', 'EAZ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1546, 101, 'West Azarbaijan', 'WEZ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1547, 101, 'Kurdistan', 'KRD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1548, 101, 'Hamadan', 'HMD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1549, 101, 'Kermanshah', 'KRM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1550, 101, 'Ilam', 'ILM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1551, 101, 'Lorestan', 'LRS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1552, 101, 'Khuzestan', 'KZT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1553, 101, 'Chahar Mahaal and Bakhtiari', 'CMB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1554, 101, 'Kohkiluyeh and Buyer Ahmad', 'KBA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1555, 101, 'Bushehr', 'BSH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1556, 101, 'Fars', 'FAR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1557, 101, 'Hormozgan', 'HRM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1558, 101, 'Sistan and Baluchistan', 'SBL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1559, 101, 'Kerman', 'KRB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1560, 101, 'Yazd', 'YZD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1561, 101, 'Esfahan', 'EFH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1562, 101, 'Semnan', 'SMN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1563, 101, 'Mazandaran', 'MZD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1564, 101, 'Golestan', 'GLS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1565, 101, 'North Khorasan', 'NKH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1566, 101, 'Razavi Khorasan', 'RKH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1567, 101, 'South Khorasan', 'SKH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1568, 102, 'Baghdad', 'BD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1569, 102, 'Salah ad Din', 'SD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1570, 102, 'Diyala', 'DY', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1571, 102, 'Wasit', 'WS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1572, 102, 'Maysan', 'MY', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1573, 102, 'Al Basrah', 'BA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1574, 102, 'Dhi Qar', 'DQ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1575, 102, 'Al Muthanna', 'MU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1576, 102, 'Al Qadisyah', 'QA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1577, 102, 'Babil', 'BB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1578, 102, 'Al Karbala', 'KB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1579, 102, 'An Najaf', 'NJ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1580, 102, 'Al Anbar', 'AB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1581, 102, 'Ninawa', 'NN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1582, 102, 'Dahuk', 'DH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1583, 102, 'Arbil', 'AL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1584, 102, 'At Ta''mim', 'TM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1585, 102, 'As Sulaymaniyah', 'SL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1586, 103, 'Carlow', 'CA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1587, 103, 'Cavan', 'CV', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1588, 103, 'Clare', 'CL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1589, 103, 'Cork', 'CO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1590, 103, 'Donegal', 'DO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1591, 103, 'Dublin', 'DU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1592, 103, 'Galway', 'GA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1593, 103, 'Kerry', 'KE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1594, 103, 'Kildare', 'KI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1595, 103, 'Kilkenny', 'KL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1596, 103, 'Laois', 'LA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1597, 103, 'Leitrim', 'LE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1598, 103, 'Limerick', 'LI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1599, 103, 'Longford', 'LO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1600, 103, 'Louth', 'LU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1601, 103, 'Mayo', 'MA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1602, 103, 'Meath', 'ME', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1603, 103, 'Monaghan', 'MO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1604, 103, 'Offaly', 'OF', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1605, 103, 'Roscommon', 'RO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1606, 103, 'Sligo', 'SL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1607, 103, 'Tipperary', 'TI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1608, 103, 'Waterford', 'WA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1609, 103, 'Westmeath', 'WE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1610, 103, 'Wexford', 'WX', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1611, 103, 'Wicklow', 'WI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1612, 104, 'Be''er Sheva', 'BS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1613, 104, 'Bika''at Hayarden', 'BH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1614, 104, 'Eilat and Arava', 'EA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1615, 104, 'Galil', 'GA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1616, 104, 'Haifa', 'HA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1617, 104, 'Jehuda Mountains', 'JM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1618, 104, 'Jerusalem', 'JE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1619, 104, 'Negev', 'NE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1620, 104, 'Semaria', 'SE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1621, 104, 'Sharon', 'SH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1622, 104, 'Tel Aviv (Gosh Dan)', 'TA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1643, 106, 'Clarendon Parish', 'CLA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1644, 106, 'Hanover Parish', 'HAN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1645, 106, 'Kingston Parish', 'KIN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1646, 106, 'Manchester Parish', 'MAN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1647, 106, 'Portland Parish', 'POR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1648, 106, 'Saint Andrew Parish', 'AND', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1649, 106, 'Saint Ann Parish', 'ANN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1650, 106, 'Saint Catherine Parish', 'CAT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1651, 106, 'Saint Elizabeth Parish', 'ELI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1652, 106, 'Saint James Parish', 'JAM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1653, 106, 'Saint Mary Parish', 'MAR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1654, 106, 'Saint Thomas Parish', 'THO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1655, 106, 'Trelawny Parish', 'TRL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1656, 106, 'Westmoreland Parish', 'WML', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1657, 107, 'Aichi', 'AI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1658, 107, 'Akita', 'AK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1659, 107, 'Aomori', 'AO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1660, 107, 'Chiba', 'CH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1661, 107, 'Ehime', 'EH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1662, 107, 'Fukui', 'FK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1663, 107, 'Fukuoka', 'FU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1664, 107, 'Fukushima', 'FS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1665, 107, 'Gifu', 'GI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1666, 107, 'Gumma', 'GU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1667, 107, 'Hiroshima', 'HI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1668, 107, 'Hokkaido', 'HO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1669, 107, 'Hyogo', 'HY', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1670, 107, 'Ibaraki', 'IB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1671, 107, 'Ishikawa', 'IS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1672, 107, 'Iwate', 'IW', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1673, 107, 'Kagawa', 'KA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1674, 107, 'Kagoshima', 'KG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1675, 107, 'Kanagawa', 'KN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1676, 107, 'Kochi', 'KO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1677, 107, 'Kumamoto', 'KU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1678, 107, 'Kyoto', 'KY', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1679, 107, 'Mie', 'MI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1680, 107, 'Miyagi', 'MY', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1681, 107, 'Miyazaki', 'MZ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1682, 107, 'Nagano', 'NA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1683, 107, 'Nagasaki', 'NG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1684, 107, 'Nara', 'NR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1685, 107, 'Niigata', 'NI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1686, 107, 'Oita', 'OI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1687, 107, 'Okayama', 'OK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1688, 107, 'Okinawa', 'ON', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1689, 107, 'Osaka', 'OS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1690, 107, 'Saga', 'SA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1691, 107, 'Saitama', 'SI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1692, 107, 'Shiga', 'SH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1693, 107, 'Shimane', 'SM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1694, 107, 'Shizuoka', 'SZ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1695, 107, 'Tochigi', 'TO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1696, 107, 'Tokushima', 'TS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1697, 107, 'Tokyo', 'TK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1698, 107, 'Tottori', 'TT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1699, 107, 'Toyama', 'TY', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1700, 107, 'Wakayama', 'WA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1701, 107, 'Yamagata', 'YA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1702, 107, 'Yamaguchi', 'YM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1703, 107, 'Yamanashi', 'YN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1704, 108, '''Amman', 'AM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1705, 108, 'Ajlun', 'AJ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1706, 108, 'Al ''Aqabah', 'AA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1707, 108, 'Al Balqa''', 'AB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1708, 108, 'Al Karak', 'AK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1709, 108, 'Al Mafraq', 'AL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1710, 108, 'At Tafilah', 'AT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1711, 108, 'Az Zarqa''', 'AZ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1712, 108, 'Irbid', 'IR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1713, 108, 'Jarash', 'JA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1714, 108, 'Ma''an', 'MA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1715, 108, 'Madaba', 'MD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1716, 109, 'Almaty', 'AL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1717, 109, 'Almaty City', 'AC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1718, 109, 'Aqmola', 'AM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1719, 109, 'Aqtobe', 'AQ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1720, 109, 'Astana City', 'AS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1721, 109, 'Atyrau', 'AT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1722, 109, 'Batys Qazaqstan', 'BA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1723, 109, 'Bayqongyr City', 'BY', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1724, 109, 'Mangghystau', 'MA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1725, 109, 'Ongtustik Qazaqstan', 'ON', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1726, 109, 'Pavlodar', 'PA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1727, 109, 'Qaraghandy', 'QA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1728, 109, 'Qostanay', 'QO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1729, 109, 'Qyzylorda', 'QY', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1730, 109, 'Shyghys Qazaqstan', 'SH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1731, 109, 'Soltustik Qazaqstan', 'SO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1732, 109, 'Zhambyl', 'ZH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1733, 110, 'Central', 'CE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1734, 110, 'Coast', 'CO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1735, 110, 'Eastern', 'EA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1736, 110, 'Nairobi Area', 'NA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1737, 110, 'North Eastern', 'NE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1738, 110, 'Nyanza', 'NY', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1739, 110, 'Rift Valley', 'RV', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1740, 110, 'Western', 'WE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1741, 111, 'Abaiang', 'AG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1742, 111, 'Abemama', 'AM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1743, 111, 'Aranuka', 'AK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1744, 111, 'Arorae', 'AO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1745, 111, 'Banaba', 'BA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1746, 111, 'Beru', 'BE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1747, 111, 'Butaritari', 'bT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1748, 111, 'Kanton', 'KA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1749, 111, 'Kiritimati', 'KR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1750, 111, 'Kuria', 'KU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1751, 111, 'Maiana', 'MI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1752, 111, 'Makin', 'MN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1753, 111, 'Marakei', 'ME', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1754, 111, 'Nikunau', 'NI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1755, 111, 'Nonouti', 'NO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1756, 111, 'Onotoa', 'ON', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1757, 111, 'Tabiteuea', 'TT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1758, 111, 'Tabuaeran', 'TR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1759, 111, 'Tamana', 'TM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1760, 111, 'Tarawa', 'TW', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1761, 111, 'Teraina', 'TE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1762, 112, 'Chagang-do', 'CHA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1763, 112, 'Hamgyong-bukto', 'HAB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1764, 112, 'Hamgyong-namdo', 'HAN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1765, 112, 'Hwanghae-bukto', 'HWB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1766, 112, 'Hwanghae-namdo', 'HWN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1767, 112, 'Kangwon-do', 'KAN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1768, 112, 'P''yongan-bukto', 'PYB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1769, 112, 'P''yongan-namdo', 'PYN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1770, 112, 'Ryanggang-do (Yanggang-do)', 'YAN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1771, 112, 'Rason Directly Governed City', 'NAJ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1772, 112, 'P''yongyang Special City', 'PYO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1773, 113, 'Ch''ungch''ong-bukto', 'CO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1774, 113, 'Ch''ungch''ong-namdo', 'CH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1775, 113, 'Cheju-do', 'CD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1776, 113, 'Cholla-bukto', 'CB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1777, 113, 'Cholla-namdo', 'CN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1778, 113, 'Inch''on-gwangyoksi', 'IG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1779, 113, 'Kangwon-do', 'KA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1780, 113, 'Kwangju-gwangyoksi', 'KG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1781, 113, 'Kyonggi-do', 'KD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1782, 113, 'Kyongsang-bukto', 'KB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1783, 113, 'Kyongsang-namdo', 'KN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1784, 113, 'Pusan-gwangyoksi', 'PG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1785, 113, 'Soul-t''ukpyolsi', 'SO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1786, 113, 'Taegu-gwangyoksi', 'TA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0);
INSERT INTO `state` (`state_id`, `country_id`, `state_name`, `state_code`, `date_added`, `added_by`, `date_modified`, `modified_by`, `status`, `is_deleted`) VALUES
(1787, 113, 'Taejon-gwangyoksi', 'TG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1788, 114, 'Al ''Asimah', 'AL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1789, 114, 'Al Ahmadi', 'AA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1790, 114, 'Al Farwaniyah', 'AF', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1791, 114, 'Al Jahra''', 'AJ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1792, 114, 'Hawalli', 'HA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1793, 115, 'Bishkek', 'GB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1794, 115, 'Batken', 'B', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1795, 115, 'Chu', 'C', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1796, 115, 'Jalal-Abad', 'J', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1797, 115, 'Naryn', 'N', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1798, 115, 'Osh', 'O', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1799, 115, 'Talas', 'T', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1800, 115, 'Ysyk-Kol', 'Y', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1801, 116, 'Vientiane', 'VT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1802, 116, 'Attapu', 'AT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1803, 116, 'Bokeo', 'BK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1804, 116, 'Bolikhamxai', 'BL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1805, 116, 'Champasak', 'CH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1806, 116, 'Houaphan', 'HO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1807, 116, 'Khammouan', 'KH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1808, 116, 'Louang Namtha', 'LM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1809, 116, 'Louangphabang', 'LP', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1810, 116, 'Oudomxai', 'OU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1811, 116, 'Phongsali', 'PH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1812, 116, 'Salavan', 'SL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1813, 116, 'Savannakhet', 'SV', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1814, 116, 'Vientiane', 'VI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1815, 116, 'Xaignabouli', 'XA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1816, 116, 'Xekong', 'XE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1817, 116, 'Xiangkhoang', 'XI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1818, 116, 'Xaisomboun', 'XN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1852, 119, 'Berea', 'BE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1853, 119, 'Butha-Buthe', 'BB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1854, 119, 'Leribe', 'LE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1855, 119, 'Mafeteng', 'MF', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1856, 119, 'Maseru', 'MS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1857, 119, 'Mohale''s Hoek', 'MH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1858, 119, 'Mokhotlong', 'MK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1859, 119, 'Qacha''s Nek', 'QN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1860, 119, 'Quthing', 'QT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1861, 119, 'Thaba-Tseka', 'TT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1862, 120, 'Bomi', 'BI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1863, 120, 'Bong', 'BG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1864, 120, 'Grand Bassa', 'GB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1865, 120, 'Grand Cape Mount', 'CM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1866, 120, 'Grand Gedeh', 'GG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1867, 120, 'Grand Kru', 'GK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1868, 120, 'Lofa', 'LO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1869, 120, 'Margibi', 'MG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1870, 120, 'Maryland', 'ML', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1871, 120, 'Montserrado', 'MS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1872, 120, 'Nimba', 'NB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1873, 120, 'River Cess', 'RC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1874, 120, 'Sinoe', 'SN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1875, 121, 'Ajdabiya', 'AJ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1876, 121, 'Al ''Aziziyah', 'AZ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1877, 121, 'Al Fatih', 'FA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1878, 121, 'Al Jabal al Akhdar', 'JA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1879, 121, 'Al Jufrah', 'JU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1880, 121, 'Al Khums', 'KH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1881, 121, 'Al Kufrah', 'KU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1882, 121, 'An Nuqat al Khams', 'NK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1883, 121, 'Ash Shati''', 'AS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1884, 121, 'Awbari', 'AW', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1885, 121, 'Az Zawiyah', 'ZA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1886, 121, 'Banghazi', 'BA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1887, 121, 'Darnah', 'DA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1888, 121, 'Ghadamis', 'GD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1889, 121, 'Gharyan', 'GY', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1890, 121, 'Misratah', 'MI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1891, 121, 'Murzuq', 'MZ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1892, 121, 'Sabha', 'SB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1893, 121, 'Sawfajjin', 'SW', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1894, 121, 'Surt', 'SU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1895, 121, 'Tarabulus (Tripoli)', 'TL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1896, 121, 'Tarhunah', 'TH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1897, 121, 'Tubruq', 'TU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1898, 121, 'Yafran', 'YA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1899, 121, 'Zlitan', 'ZL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1900, 122, 'Vaduz', 'V', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1901, 122, 'Schaan', 'A', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1902, 122, 'Balzers', 'B', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1903, 122, 'Triesen', 'N', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1904, 122, 'Eschen', 'E', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1905, 122, 'Mauren', 'M', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1906, 122, 'Triesenberg', 'T', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1907, 122, 'Ruggell', 'R', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1908, 122, 'Gamprin', 'G', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1909, 122, 'Schellenberg', 'L', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1910, 122, 'Planken', 'P', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1911, 123, 'Alytus', 'AL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1912, 123, 'Kaunas', 'KA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1913, 123, 'Klaipeda', 'KL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1914, 123, 'Marijampole', 'MA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1915, 123, 'Panevezys', 'PA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1916, 123, 'Siauliai', 'SI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1917, 123, 'Taurage', 'TA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1918, 123, 'Telsiai', 'TE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1919, 123, 'Utena', 'UT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1920, 123, 'Vilnius', 'VI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1921, 124, 'Diekirch', 'DD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1922, 124, 'Clervaux', 'DC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1923, 124, 'Redange', 'DR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1924, 124, 'Vianden', 'DV', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1925, 124, 'Wiltz', 'DW', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1926, 124, 'Grevenmacher', 'GG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1927, 124, 'Echternach', 'GE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1928, 124, 'Remich', 'GR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1929, 124, 'Luxembourg', 'LL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1930, 124, 'Capellen', 'LC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1931, 124, 'Esch-sur-Alzette', 'LE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1932, 124, 'Mersch', 'LM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1933, 125, 'Our Lady Fatima Parish', 'OLF', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1934, 125, 'St. Anthony Parish', 'ANT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1935, 125, 'St. Lazarus Parish', 'LAZ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1936, 125, 'Cathedral Parish', 'CAT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1937, 125, 'St. Lawrence Parish', 'LAW', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1938, 127, 'Antananarivo', 'AN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1939, 127, 'Antsiranana', 'AS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1940, 127, 'Fianarantsoa', 'FN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1941, 127, 'Mahajanga', 'MJ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1942, 127, 'Toamasina', 'TM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1943, 127, 'Toliara', 'TL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1944, 128, 'Balaka', 'BLK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1945, 128, 'Blantyre', 'BLT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1946, 128, 'Chikwawa', 'CKW', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1947, 128, 'Chiradzulu', 'CRD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1948, 128, 'Chitipa', 'CTP', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1949, 128, 'Dedza', 'DDZ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1950, 128, 'Dowa', 'DWA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1951, 128, 'Karonga', 'KRG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1952, 128, 'Kasungu', 'KSG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1953, 128, 'Likoma', 'LKM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1954, 128, 'Lilongwe', 'LLG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1955, 128, 'Machinga', 'MCG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1956, 128, 'Mangochi', 'MGC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1957, 128, 'Mchinji', 'MCH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1958, 128, 'Mulanje', 'MLJ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1959, 128, 'Mwanza', 'MWZ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1960, 128, 'Mzimba', 'MZM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1961, 128, 'Ntcheu', 'NTU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1962, 128, 'Nkhata Bay', 'NKB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1963, 128, 'Nkhotakota', 'NKH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1964, 128, 'Nsanje', 'NSJ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1965, 128, 'Ntchisi', 'NTI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1966, 128, 'Phalombe', 'PHL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1967, 128, 'Rumphi', 'RMP', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1968, 128, 'Salima', 'SLM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1969, 128, 'Thyolo', 'THY', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1970, 128, 'Zomba', 'ZBA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1971, 129, 'Johor', 'MY-01', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1972, 129, 'Kedah', 'MY-02', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1973, 129, 'Kelantan', 'MY-03', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1974, 129, 'Labuan', 'MY-15', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1975, 129, 'Melaka', 'MY-04', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1976, 129, 'Negeri Sembilan', 'MY-05', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1977, 129, 'Pahang', 'MY-06', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1978, 129, 'Perak', 'MY-08', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1979, 129, 'Perlis', 'MY-09', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1980, 129, 'Pulau Pinang', 'MY-07', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1981, 129, 'Sabah', 'MY-12', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1982, 129, 'Sarawak', 'MY-13', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1983, 129, 'Selangor', 'MY-10', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1984, 129, 'Terengganu', 'MY-11', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1985, 129, 'Kuala Lumpur', 'MY-14', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1986, 130, 'Thiladhunmathi Uthuru', 'THU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1987, 130, 'Thiladhunmathi Dhekunu', 'THD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1988, 130, 'Miladhunmadulu Uthuru', 'MLU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1989, 130, 'Miladhunmadulu Dhekunu', 'MLD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1990, 130, 'Maalhosmadulu Uthuru', 'MAU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1991, 130, 'Maalhosmadulu Dhekunu', 'MAD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1992, 130, 'Faadhippolhu', 'FAA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1993, 130, 'Male Atoll', 'MAA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1994, 130, 'Ari Atoll Uthuru', 'AAU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1995, 130, 'Ari Atoll Dheknu', 'AAD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1996, 130, 'Felidhe Atoll', 'FEA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1997, 130, 'Mulaku Atoll', 'MUA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1998, 130, 'Nilandhe Atoll Uthuru', 'NAU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(1999, 130, 'Nilandhe Atoll Dhekunu', 'NAD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2000, 130, 'Kolhumadulu', 'KLH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2001, 130, 'Hadhdhunmathi', 'HDH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2002, 130, 'Huvadhu Atoll Uthuru', 'HAU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2003, 130, 'Huvadhu Atoll Dhekunu', 'HAD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2004, 130, 'Fua Mulaku', 'FMU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2005, 130, 'Addu', 'ADD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2006, 131, 'Gao', 'GA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2007, 131, 'Kayes', 'KY', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2008, 131, 'Kidal', 'KD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2009, 131, 'Koulikoro', 'KL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2010, 131, 'Mopti', 'MP', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2011, 131, 'Segou', 'SG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2012, 131, 'Sikasso', 'SK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2013, 131, 'Tombouctou', 'TB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2014, 131, 'Bamako Capital District', 'CD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2015, 132, 'Attard', 'ATT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2016, 132, 'Balzan', 'BAL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2017, 132, 'Birgu', 'BGU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2018, 132, 'Birkirkara', 'BKK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2019, 132, 'Birzebbuga', 'BRZ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2020, 132, 'Bormla', 'BOR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2021, 132, 'Dingli', 'DIN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2022, 132, 'Fgura', 'FGU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2023, 132, 'Floriana', 'FLO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2024, 132, 'Gudja', 'GDJ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2025, 132, 'Gzira', 'GZR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2026, 132, 'Gargur', 'GRG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2027, 132, 'Gaxaq', 'GXQ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2028, 132, 'Hamrun', 'HMR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2029, 132, 'Iklin', 'IKL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2030, 132, 'Isla', 'ISL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2031, 132, 'Kalkara', 'KLK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2032, 132, 'Kirkop', 'KRK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2033, 132, 'Lija', 'LIJ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2034, 132, 'Luqa', 'LUQ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2035, 132, 'Marsa', 'MRS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2036, 132, 'Marsaskala', 'MKL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2037, 132, 'Marsaxlokk', 'MXL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2038, 132, 'Mdina', 'MDN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2039, 132, 'Melliea', 'MEL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2040, 132, 'Mgarr', 'MGR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2041, 132, 'Mosta', 'MST', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2042, 132, 'Mqabba', 'MQA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2043, 132, 'Msida', 'MSI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2044, 132, 'Mtarfa', 'MTF', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2045, 132, 'Naxxar', 'NAX', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2046, 132, 'Paola', 'PAO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2047, 132, 'Pembroke', 'PEM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2048, 132, 'Pieta', 'PIE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2049, 132, 'Qormi', 'QOR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2050, 132, 'Qrendi', 'QRE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2051, 132, 'Rabat', 'RAB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2052, 132, 'Safi', 'SAF', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2053, 132, 'San Giljan', 'SGI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2054, 132, 'Santa Lucija', 'SLU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2055, 132, 'San Pawl il-Bahar', 'SPB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2056, 132, 'San Gwann', 'SGW', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2057, 132, 'Santa Venera', 'SVE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2058, 132, 'Siggiewi', 'SIG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2059, 132, 'Sliema', 'SLM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2060, 132, 'Swieqi', 'SWQ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2061, 132, 'Ta Xbiex', 'TXB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2062, 132, 'Tarxien', 'TRX', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2063, 132, 'Valletta', 'VLT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2064, 132, 'Xgajra', 'XGJ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2065, 132, 'Zabbar', 'ZBR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2066, 132, 'Zebbug', 'ZBG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2067, 132, 'Zejtun', 'ZJT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2068, 132, 'Zurrieq', 'ZRQ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2069, 132, 'Fontana', 'FNT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2070, 132, 'Ghajnsielem', 'GHJ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2071, 132, 'Gharb', 'GHR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2072, 132, 'Ghasri', 'GHS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2073, 132, 'Kercem', 'KRC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2074, 132, 'Munxar', 'MUN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2075, 132, 'Nadur', 'NAD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2076, 132, 'Qala', 'QAL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2077, 132, 'Victoria', 'VIC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2078, 132, 'San Lawrenz', 'SLA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2079, 132, 'Sannat', 'SNT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2080, 132, 'Xagra', 'ZAG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2081, 132, 'Xewkija', 'XEW', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2082, 132, 'Zebbug', 'ZEB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2083, 133, 'Ailinginae', 'ALG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2084, 133, 'Ailinglaplap', 'ALL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2085, 133, 'Ailuk', 'ALK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2086, 133, 'Arno', 'ARN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2087, 133, 'Aur', 'AUR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2088, 133, 'Bikar', 'BKR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2089, 133, 'Bikini', 'BKN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2090, 133, 'Bokak', 'BKK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2091, 133, 'Ebon', 'EBN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2092, 133, 'Enewetak', 'ENT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2093, 133, 'Erikub', 'EKB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2094, 133, 'Jabat', 'JBT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2095, 133, 'Jaluit', 'JLT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2096, 133, 'Jemo', 'JEM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2097, 133, 'Kili', 'KIL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2098, 133, 'Kwajalein', 'KWJ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2099, 133, 'Lae', 'LAE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2100, 133, 'Lib', 'LIB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2101, 133, 'Likiep', 'LKP', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2102, 133, 'Majuro', 'MJR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2103, 133, 'Maloelap', 'MLP', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2104, 133, 'Mejit', 'MJT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2105, 133, 'Mili', 'MIL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2106, 133, 'Namorik', 'NMK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2107, 133, 'Namu', 'NAM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2108, 133, 'Rongelap', 'RGL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2109, 133, 'Rongrik', 'RGK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2110, 133, 'Toke', 'TOK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2111, 133, 'Ujae', 'UJA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2112, 133, 'Ujelang', 'UJL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2113, 133, 'Utirik', 'UTK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2114, 133, 'Wotho', 'WTH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2115, 133, 'Wotje', 'WTJ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2116, 135, 'Adrar', 'AD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2117, 135, 'Assaba', 'AS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2118, 135, 'Brakna', 'BR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2119, 135, 'Dakhlet Nouadhibou', 'DN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2120, 135, 'Gorgol', 'GO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2121, 135, 'Guidimaka', 'GM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2122, 135, 'Hodh Ech Chargui', 'HC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2123, 135, 'Hodh El Gharbi', 'HG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2124, 135, 'Inchiri', 'IN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2125, 135, 'Tagant', 'TA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2126, 135, 'Tiris Zemmour', 'TZ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2127, 135, 'Trarza', 'TR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2128, 135, 'Nouakchott', 'NO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2129, 136, 'Beau Bassin-Rose Hill', 'BR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2130, 136, 'Curepipe', 'CU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2131, 136, 'Port Louis', 'PU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2132, 136, 'Quatre Bornes', 'QB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2133, 136, 'Vacoas-Phoenix', 'VP', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2134, 136, 'Agalega Islands', 'AG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2135, 136, 'Cargados Carajos Shoals (Saint Brandon Islands)', 'CC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2136, 136, 'Rodrigues', 'RO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2137, 136, 'Black River', 'BL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2138, 136, 'Flacq', 'FL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2139, 136, 'Grand Port', 'GP', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2140, 136, 'Moka', 'MO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2141, 136, 'Pamplemousses', 'PA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2142, 136, 'Plaines Wilhems', 'PW', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2143, 136, 'Port Louis', 'PL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2144, 136, 'Riviere du Rempart', 'RR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2145, 136, 'Savanne', 'SA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2146, 138, 'Baja California Norte', 'BN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2147, 138, 'Baja California Sur', 'BS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2148, 138, 'Campeche', 'CA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2149, 138, 'Chiapas', 'CI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2150, 138, 'Chihuahua', 'CH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2151, 138, 'Coahuila de Zaragoza', 'CZ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2152, 138, 'Colima', 'CL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2153, 138, 'Distrito Federal', 'DF', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2154, 138, 'Durango', 'DU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2155, 138, 'Guanajuato', 'GA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2156, 138, 'Guerrero', 'GE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2157, 138, 'Hidalgo', 'HI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2158, 138, 'Jalisco', 'JA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2159, 138, 'Mexico', 'ME', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2160, 138, 'Michoacan de Ocampo', 'MI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2161, 138, 'Morelos', 'MO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2162, 138, 'Nayarit', 'NA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2163, 138, 'Nuevo Leon', 'NL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2164, 138, 'Oaxaca', 'OA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2165, 138, 'Puebla', 'PU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2166, 138, 'Queretaro de Arteaga', 'QA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2167, 138, 'Quintana Roo', 'QR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2168, 138, 'San Luis Potosi', 'SA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2169, 138, 'Sinaloa', 'SI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2170, 138, 'Sonora', 'SO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2171, 138, 'Tabasco', 'TB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2172, 138, 'Tamaulipas', 'TM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2173, 138, 'Tlaxcala', 'TL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2174, 138, 'Veracruz-Llave', 'VE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2175, 138, 'Yucatan', 'YU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2176, 138, 'Zacatecas', 'ZA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2177, 139, 'Chuuk', 'C', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2178, 139, 'Kosrae', 'K', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2179, 139, 'Pohnpei', 'P', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2180, 139, 'Yap', 'Y', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2181, 140, 'Gagauzia', 'GA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2182, 140, 'Chisinau', 'CU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2183, 140, 'Balti', 'BA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2184, 140, 'Cahul', 'CA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2185, 140, 'Edinet', 'ED', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2186, 140, 'Lapusna', 'LA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2187, 140, 'Orhei', 'OR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2188, 140, 'Soroca', 'SO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2189, 140, 'Tighina', 'TI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2190, 140, 'Ungheni', 'UN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2191, 140, 'St‚nga Nistrului', 'SN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2192, 141, 'Fontvieille', 'FV', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2193, 141, 'La Condamine', 'LC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2194, 141, 'Monaco-Ville', 'MV', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2195, 141, 'Monte-Carlo', 'MC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2196, 142, 'Ulanbaatar', '1', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2197, 142, 'Orhon', '035', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2198, 142, 'Darhan uul', '037', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2199, 142, 'Hentiy', '039', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2200, 142, 'Hovsgol', '041', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2201, 142, 'Hovd', '043', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2202, 142, 'Uvs', '046', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2203, 142, 'Tov', '047', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2204, 142, 'Selenge', '049', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2205, 142, 'Suhbaatar', '051', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2206, 142, 'Omnogovi', '053', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2207, 142, 'Ovorhangay', '055', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2208, 142, 'Dzavhan', '057', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2209, 142, 'DundgovL', '059', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2210, 142, 'Dornod', '061', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2211, 142, 'Dornogov', '063', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2212, 142, 'Govi-Sumber', '064', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2213, 142, 'Govi-Altay', '065', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2214, 142, 'Bulgan', '067', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2215, 142, 'Bayanhongor', '069', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2216, 142, 'Bayan-Olgiy', '071', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2217, 142, 'Arhangay', '073', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2218, 143, 'Saint Anthony', 'A', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2219, 143, 'Saint Georges', 'G', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2220, 143, 'Saint Peter', 'P', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2221, 144, 'Agadir', 'AGD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2222, 144, 'Al Hoceima', 'HOC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2223, 144, 'Azilal', 'AZI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2224, 144, 'Beni Mellal', 'BME', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2225, 144, 'Ben Slimane', 'BSL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2226, 144, 'Boulemane', 'BLM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2227, 144, 'Casablanca', 'CBL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2228, 144, 'Chaouen', 'CHA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2229, 144, 'El Jadida', 'EJA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2230, 144, 'El Kelaa des Sraghna', 'EKS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2231, 144, 'Er Rachidia', 'ERA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2232, 144, 'Essaouira', 'ESS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2233, 144, 'Fes', 'FES', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2234, 144, 'Figuig', 'FIG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2235, 144, 'Guelmim', 'GLM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2236, 144, 'Ifrane', 'IFR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2237, 144, 'Kenitra', 'KEN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2238, 144, 'Khemisset', 'KHM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2239, 144, 'Khenifra', 'KHN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2240, 144, 'Khouribga', 'KHO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2241, 144, 'Laayoune', 'LYN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2242, 144, 'Larache', 'LAR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2243, 144, 'Marrakech', 'MRK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2244, 144, 'Meknes', 'MKN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2245, 144, 'Nador', 'NAD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2246, 144, 'Ouarzazate', 'ORZ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2247, 144, 'Oujda', 'OUJ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2248, 144, 'Rabat-Sale', 'RSA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2249, 144, 'Safi', 'SAF', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2250, 144, 'Settat', 'SET', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2251, 144, 'Sidi Kacem', 'SKA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2252, 144, 'Tangier', 'TGR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2253, 144, 'Tan-Tan', 'TAN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2254, 144, 'Taounate', 'TAO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2255, 144, 'Taroudannt', 'TRD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2256, 144, 'Tata', 'TAT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2257, 144, 'Taza', 'TAZ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2258, 144, 'Tetouan', 'TET', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2259, 144, 'Tiznit', 'TIZ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2260, 144, 'Ad Dakhla', 'ADK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2261, 144, 'Boujdour', 'BJD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2262, 144, 'Es Smara', 'ESM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2263, 145, 'Cabo Delgado', 'CD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2264, 145, 'Gaza', 'GZ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2265, 145, 'Inhambane', 'IN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2266, 145, 'Manica', 'MN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2267, 145, 'Maputo (city)', 'MC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2268, 145, 'Maputo', 'MP', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2269, 145, 'Nampula', 'NA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2270, 145, 'Niassa', 'NI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2271, 145, 'Sofala', 'SO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2272, 145, 'Tete', 'TE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2273, 145, 'Zambezia', 'ZA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2274, 146, 'Ayeyarwady', 'AY', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2275, 146, 'Bago', 'BG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2276, 146, 'Magway', 'MG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2277, 146, 'Mandalay', 'MD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2278, 146, 'Sagaing', 'SG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2279, 146, 'Tanintharyi', 'TN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2280, 146, 'Yangon', 'YG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2281, 146, 'Chin State', 'CH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2282, 146, 'Kachin State', 'KC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2283, 146, 'Kayah State', 'KH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2284, 146, 'Kayin State', 'KN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2285, 146, 'Mon State', 'MN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2286, 146, 'Rakhine State', 'RK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2287, 146, 'Shan State', 'SH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2288, 147, 'Caprivi', 'CA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2289, 147, 'Erongo', 'ER', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2290, 147, 'Hardap', 'HA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2291, 147, 'Karas', 'KR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2292, 147, 'Kavango', 'KV', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2293, 147, 'Khomas', 'KH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2294, 147, 'Kunene', 'KU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2295, 147, 'Ohangwena', 'OW', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2296, 147, 'Omaheke', 'OK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2297, 147, 'Omusati', 'OT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2298, 147, 'Oshana', 'ON', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2299, 147, 'Oshikoto', 'OO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2300, 147, 'Otjozondjupa', 'OJ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2301, 148, 'Aiwo', 'AO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2302, 148, 'Anabar', 'AA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2303, 148, 'Anetan', 'AT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2304, 148, 'Anibare', 'AI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2305, 148, 'Baiti', 'BA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2306, 148, 'Boe', 'BO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2307, 148, 'Buada', 'BU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2308, 148, 'Denigomodu', 'DE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2309, 148, 'Ewa', 'EW', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2310, 148, 'Ijuw', 'IJ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2311, 148, 'Meneng', 'ME', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2312, 148, 'Nibok', 'NI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2313, 148, 'Uaboe', 'UA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2314, 148, 'Yaren', 'YA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2315, 149, 'Bagmati', 'BA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2316, 149, 'Bheri', 'BH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2317, 149, 'Dhawalagiri', 'DH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2318, 149, 'Gandaki', 'GA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2319, 149, 'Janakpur', 'JA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2320, 149, 'Karnali', 'KA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2321, 149, 'Kosi', 'KO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2322, 149, 'Lumbini', 'LU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2323, 149, 'Mahakali', 'MA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2324, 149, 'Mechi', 'ME', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2325, 149, 'Narayani', 'NA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2326, 149, 'Rapti', 'RA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2327, 149, 'Sagarmatha', 'SA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2328, 149, 'Seti', 'SE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2329, 150, 'Drenthe', 'DR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2330, 150, 'Flevoland', 'FL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2331, 150, 'Friesland', 'FR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2332, 150, 'Gelderland', 'GE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2333, 150, 'Groningen', 'GR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2334, 150, 'Limburg', 'LI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2335, 150, 'Noord Brabant', 'NB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2336, 150, 'Noord Holland', 'NH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2337, 150, 'Overijssel', 'OV', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2338, 150, 'Utrecht', 'UT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2339, 150, 'Zeeland', 'ZE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2340, 150, 'Zuid Holland', 'ZH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2341, 152, 'Iles Loyaute', 'L', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2342, 152, 'Nord', 'N', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2343, 152, 'Sud', 'S', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2344, 153, 'Auckland', 'AUK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2345, 153, 'Bay of Plenty', 'BOP', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2346, 153, 'Canterbury', 'CAN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2347, 153, 'Coromandel', 'COR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2348, 153, 'Gisborne', 'GIS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2349, 153, 'Fiordland', 'FIO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2350, 153, 'Hawke''s Bay', 'HKB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2351, 153, 'Marlborough', 'MBH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2352, 153, 'Manawatu-Wanganui', 'MWT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2353, 153, 'Mt Cook-Mackenzie', 'MCM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2354, 153, 'Nelson', 'NSN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2355, 153, 'Northland', 'NTL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2356, 153, 'Otago', 'OTA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2357, 153, 'Southland', 'STL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2358, 153, 'Taranaki', 'TKI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2359, 153, 'Wellington', 'WGN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2360, 153, 'Waikato', 'WKO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2361, 153, 'Wairarapa', 'WAI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2362, 153, 'West Coast', 'WTC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2363, 154, 'Atlantico Norte', 'AN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2364, 154, 'Atlantico Sur', 'AS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2365, 154, 'Boaco', 'BO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2366, 154, 'Carazo', 'CA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2367, 154, 'Chinandega', 'CI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2368, 154, 'Chontales', 'CO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2369, 154, 'Esteli', 'ES', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2370, 154, 'Granada', 'GR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2371, 154, 'Jinotega', 'JI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2372, 154, 'Leon', 'LE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2373, 154, 'Madriz', 'MD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2374, 154, 'Managua', 'MN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2375, 154, 'Masaya', 'MS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2376, 154, 'Matagalpa', 'MT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2377, 154, 'Nuevo Segovia', 'NS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2378, 154, 'Rio San Juan', 'RS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2379, 154, 'Rivas', 'RI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2380, 155, 'Agadez', 'AG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2381, 155, 'Diffa', 'DF', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2382, 155, 'Dosso', 'DS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2383, 155, 'Maradi', 'MA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2384, 155, 'Niamey', 'NM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2385, 155, 'Tahoua', 'TH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2386, 155, 'Tillaberi', 'TL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0);
INSERT INTO `state` (`state_id`, `country_id`, `state_name`, `state_code`, `date_added`, `added_by`, `date_modified`, `modified_by`, `status`, `is_deleted`) VALUES
(2387, 155, 'Zinder', 'ZD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2388, 156, 'Abia', 'AB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2389, 156, 'Abuja Federal Capital Territory', 'CT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2390, 156, 'Adamawa', 'AD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2391, 156, 'Akwa Ibom', 'AK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2392, 156, 'Anambra', 'AN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2393, 156, 'Bauchi', 'BC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2394, 156, 'Bayelsa', 'BY', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2395, 156, 'Benue', 'BN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2396, 156, 'Borno', 'BO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2397, 156, 'Cross River', 'CR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2398, 156, 'Delta', 'DE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2399, 156, 'Ebonyi', 'EB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2400, 156, 'Edo', 'ED', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2401, 156, 'Ekiti', 'EK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2402, 156, 'Enugu', 'EN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2403, 156, 'Gombe', 'GO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2404, 156, 'Imo', 'IM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2405, 156, 'Jigawa', 'JI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2406, 156, 'Kaduna', 'KD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2407, 156, 'Kano', 'KN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2408, 156, 'Katsina', 'KT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2409, 156, 'Kebbi', 'KE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2410, 156, 'Kogi', 'KO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2411, 156, 'Kwara', 'KW', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2412, 156, 'Lagos', 'LA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2413, 156, 'Nassarawa', 'NA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2414, 156, 'Niger', 'NI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2415, 156, 'Ogun', 'OG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2416, 156, 'Ondo', 'ONG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2417, 156, 'Osun', 'OS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2418, 156, 'Oyo', 'OY', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2419, 156, 'Plateau', 'PL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2420, 156, 'Rivers', 'RI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2421, 156, 'Sokoto', 'SO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2422, 156, 'Taraba', 'TA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2423, 156, 'Yobe', 'YO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2424, 156, 'Zamfara', 'ZA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2425, 159, 'Northern Islands', 'N', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2426, 159, 'Rota', 'R', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2427, 159, 'Saipan', 'S', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2428, 159, 'Tinian', 'T', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2429, 160, 'Akershus', 'AK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2430, 160, 'Aust-Agder', 'AA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2431, 160, 'Buskerud', 'BU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2432, 160, 'Finnmark', 'FM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2433, 160, 'Hedmark', 'HM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2434, 160, 'Hordaland', 'HL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2435, 160, 'More og Romdal', 'MR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2436, 160, 'Nord-Trondelag', 'NT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2437, 160, 'Nordland', 'NL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2438, 160, 'Ostfold', 'OF', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2439, 160, 'Oppland', 'OP', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2440, 160, 'Oslo', 'OL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2441, 160, 'Rogaland', 'RL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2442, 160, 'Sor-Trondelag', 'ST', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2443, 160, 'Sogn og Fjordane', 'SJ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2444, 160, 'Svalbard', 'SV', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2445, 160, 'Telemark', 'TM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2446, 160, 'Troms', 'TR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2447, 160, 'Vest-Agder', 'VA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2448, 160, 'Vestfold', 'VF', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2449, 161, 'Ad Dakhiliyah', 'DA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2450, 161, 'Al Batinah', 'BA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2451, 161, 'Al Wusta', 'WU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2452, 161, 'Ash Sharqiyah', 'SH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2453, 161, 'Az Zahirah', 'ZA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2454, 161, 'Masqat', 'MA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2455, 161, 'Musandam', 'MU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2456, 161, 'Zufar', 'ZU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2457, 162, 'Balochistan', 'B', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2458, 162, 'Federally Administered Tribal Areas', 'T', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2459, 162, 'Islamabad Capital Territory', 'I', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2460, 162, 'North-West Frontier', 'N', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2461, 162, 'Punjab', 'P', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2462, 162, 'Sindh', 'S', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2463, 163, 'Aimeliik', 'AM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2464, 163, 'Airai', 'AR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2465, 163, 'Angaur', 'AN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2466, 163, 'Hatohobei', 'HA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2467, 163, 'Kayangel', 'KA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2468, 163, 'Koror', 'KO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2469, 163, 'Melekeok', 'ME', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2470, 163, 'Ngaraard', 'NA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2471, 163, 'Ngarchelong', 'NG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2472, 163, 'Ngardmau', 'ND', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2473, 163, 'Ngatpang', 'NT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2474, 163, 'Ngchesar', 'NC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2475, 163, 'Ngeremlengui', 'NR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2476, 163, 'Ngiwal', 'NW', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2477, 163, 'Peleliu', 'PE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2478, 163, 'Sonsorol', 'SO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2479, 164, 'Bocas del Toro', 'BT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2480, 164, 'Chiriqui', 'CH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2481, 164, 'Cocle', 'CC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2482, 164, 'Colon', 'CL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2483, 164, 'Darien', 'DA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2484, 164, 'Herrera', 'HE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2485, 164, 'Los Santos', 'LS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2486, 164, 'Panama', 'PA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2487, 164, 'San Blas', 'SB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2488, 164, 'Veraguas', 'VG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2489, 165, 'Bougainville', 'BV', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2490, 165, 'Central', 'CE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2491, 165, 'Chimbu', 'CH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2492, 165, 'Eastern Highlands', 'EH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2493, 165, 'East New Britain', 'EB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2494, 165, 'East Sepik', 'ES', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2495, 165, 'Enga', 'EN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2496, 165, 'Gulf', 'GU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2497, 165, 'Madang', 'MD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2498, 165, 'Manus', 'MN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2499, 165, 'Milne Bay', 'MB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2500, 165, 'Morobe', 'MR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2501, 165, 'National Capital', 'NC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2502, 165, 'New Ireland', 'NI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2503, 165, 'Northern', 'NO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2504, 165, 'Sandaun', 'SA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2505, 165, 'Southern Highlands', 'SH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2506, 165, 'Western', 'WE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2507, 165, 'Western Highlands', 'WH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2508, 165, 'West New Britain', 'WB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2509, 166, 'Alto Paraguay', 'AG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2510, 166, 'Alto Parana', 'AN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2511, 166, 'Amambay', 'AM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2512, 166, 'Asuncion', 'AS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2513, 166, 'Boqueron', 'BO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2514, 166, 'Caaguazu', 'CG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2515, 166, 'Caazapa', 'CZ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2516, 166, 'Canindeyu', 'CN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2517, 166, 'Central', 'CE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2518, 166, 'Concepcion', 'CC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2519, 166, 'Cordillera', 'CD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2520, 166, 'Guaira', 'GU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2521, 166, 'Itapua', 'IT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2522, 166, 'Misiones', 'MI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2523, 166, 'Neembucu', 'NE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2524, 166, 'Paraguari', 'PA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2525, 166, 'Presidente Hayes', 'PH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2526, 166, 'San Pedro', 'SP', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2527, 167, 'Amazonas', 'AM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2528, 167, 'Ancash', 'AN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2529, 167, 'Apurimac', 'AP', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2530, 167, 'Arequipa', 'AR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2531, 167, 'Ayacucho', 'AY', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2532, 167, 'Cajamarca', 'CJ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2533, 167, 'Callao', 'CL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2534, 167, 'Cusco', 'CU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2535, 167, 'Huancavelica', 'HV', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2536, 167, 'Huanuco', 'HO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2537, 167, 'Ica', 'IC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2538, 167, 'Junin', 'JU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2539, 167, 'La Libertad', 'LD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2540, 167, 'Lambayeque', 'LY', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2541, 167, 'Lima', 'LI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2542, 167, 'Loreto', 'LO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2543, 167, 'Madre de Dios', 'MD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2544, 167, 'Moquegua', 'MO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2545, 167, 'Pasco', 'PA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2546, 167, 'Piura', 'PI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2547, 167, 'Puno', 'PU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2548, 167, 'San Martin', 'SM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2549, 167, 'Tacna', 'TA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2550, 167, 'Tumbes', 'TU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2551, 167, 'Ucayali', 'UC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2552, 168, 'Abra', 'ABR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2553, 168, 'Agusan del Norte', 'ANO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2554, 168, 'Agusan del Sur', 'ASU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2555, 168, 'Aklan', 'AKL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2556, 168, 'Albay', 'ALB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2557, 168, 'Antique', 'ANT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2558, 168, 'Apayao', 'APY', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2559, 168, 'Aurora', 'AUR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2560, 168, 'Basilan', 'BAS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2561, 168, 'Bataan', 'BTA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2562, 168, 'Batanes', 'BTE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2563, 168, 'Batangas', 'BTG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2564, 168, 'Biliran', 'BLR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2565, 168, 'Benguet', 'BEN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2566, 168, 'Bohol', 'BOL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2567, 168, 'Bukidnon', 'BUK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2568, 168, 'Bulacan', 'BUL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2569, 168, 'Cagayan', 'CAG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2570, 168, 'Camarines Norte', 'CNO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2571, 168, 'Camarines Sur', 'CSU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2572, 168, 'Camiguin', 'CAM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2573, 168, 'Capiz', 'CAP', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2574, 168, 'Catanduanes', 'CAT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2575, 168, 'Cavite', 'CAV', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2576, 168, 'Cebu', 'CEB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2577, 168, 'Compostela', 'CMP', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2578, 168, 'Davao del Norte', 'DNO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2579, 168, 'Davao del Sur', 'DSU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2580, 168, 'Davao Oriental', 'DOR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2581, 168, 'Eastern Samar', 'ESA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2582, 168, 'Guimaras', 'GUI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2583, 168, 'Ifugao', 'IFU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2584, 168, 'Ilocos Norte', 'INO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2585, 168, 'Ilocos Sur', 'ISU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2586, 168, 'Iloilo', 'ILO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2587, 168, 'Isabela', 'ISA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2588, 168, 'Kalinga', 'KAL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2589, 168, 'Laguna', 'LAG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2590, 168, 'Lanao del Norte', 'LNO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2591, 168, 'Lanao del Sur', 'LSU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2592, 168, 'La Union', 'UNI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2593, 168, 'Leyte', 'LEY', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2594, 168, 'Maguindanao', 'MAG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2595, 168, 'Marinduque', 'MRN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2596, 168, 'Masbate', 'MSB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2597, 168, 'Mindoro Occidental', 'MIC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2598, 168, 'Mindoro Oriental', 'MIR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2599, 168, 'Misamis Occidental', 'MSC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2600, 168, 'Misamis Oriental', 'MOR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2601, 168, 'Mountain', 'MOP', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2602, 168, 'Negros Occidental', 'NOC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2603, 168, 'Negros Oriental', 'NOR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2604, 168, 'North Cotabato', 'NCT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2605, 168, 'Northern Samar', 'NSM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2606, 168, 'Nueva Ecija', 'NEC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2607, 168, 'Nueva Vizcaya', 'NVZ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2608, 168, 'Palawan', 'PLW', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2609, 168, 'Pampanga', 'PMP', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2610, 168, 'Pangasinan', 'PNG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2611, 168, 'Quezon', 'QZN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2612, 168, 'Quirino', 'QRN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2613, 168, 'Rizal', 'RIZ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2614, 168, 'Romblon', 'ROM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2615, 168, 'Samar', 'SMR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2616, 168, 'Sarangani', 'SRG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2617, 168, 'Siquijor', 'SQJ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2618, 168, 'Sorsogon', 'SRS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2619, 168, 'South Cotabato', 'SCO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2620, 168, 'Southern Leyte', 'SLE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2621, 168, 'Sultan Kudarat', 'SKU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2622, 168, 'Sulu', 'SLU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2623, 168, 'Surigao del Norte', 'SNO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2624, 168, 'Surigao del Sur', 'SSU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2625, 168, 'Tarlac', 'TAR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2626, 168, 'Tawi-Tawi', 'TAW', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2627, 168, 'Zambales', 'ZBL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2628, 168, 'Zamboanga del Norte', 'ZNO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2629, 168, 'Zamboanga del Sur', 'ZSU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2630, 168, 'Zamboanga Sibugay', 'ZSI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2631, 170, 'Dolnoslaskie', 'DO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2632, 170, 'Kujawsko-Pomorskie', 'KP', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2633, 170, 'Lodzkie', 'LO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2634, 170, 'Lubelskie', 'LL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2635, 170, 'Lubuskie', 'LU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2636, 170, 'Malopolskie', 'ML', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2637, 170, 'Mazowieckie', 'MZ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2638, 170, 'Opolskie', 'OP', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2639, 170, 'Podkarpackie', 'PP', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2640, 170, 'Podlaskie', 'PL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2641, 170, 'Pomorskie', 'PM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2642, 170, 'Slaskie', 'SL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2643, 170, 'Swietokrzyskie', 'SW', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2644, 170, 'Warminsko-Mazurskie', 'WM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2645, 170, 'Wielkopolskie', 'WP', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2646, 170, 'Zachodniopomorskie', 'ZA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2647, 198, 'Saint Pierre', 'P', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2648, 198, 'Miquelon', 'M', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2649, 171, 'A&ccedil;ores', 'AC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2650, 171, 'Aveiro', 'AV', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2651, 171, 'Beja', 'BE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2652, 171, 'Braga', 'BR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2653, 171, 'Bragan&ccedil;a', 'BA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2654, 171, 'Castelo Branco', 'CB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2655, 171, 'Coimbra', 'CO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2656, 171, 'Évora', 'EV', '0000-00-00 00:00:00', 1, '2016-12-12 04:11:16', 1, 1, 0),
(2657, 171, 'Faro', 'FA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2658, 171, 'Guarda', 'GU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2659, 171, 'Leiria', 'LE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2660, 171, 'Lisboa', 'LI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2661, 171, 'Madeira', 'ME', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2662, 171, 'Portalegre', 'PO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2663, 171, 'Porto', 'PR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2664, 171, 'Santar&eacute;m', 'SA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2665, 171, 'Set&uacute;bal', 'SE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2666, 171, 'Viana do Castelo', 'VC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2667, 171, 'Vila Real', 'VR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2668, 171, 'Viseu', 'VI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2669, 173, 'Ad Dawhah', 'DW', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2670, 173, 'Al Ghuwayriyah', 'GW', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2671, 173, 'Al Jumayliyah', 'JM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2672, 173, 'Al Khawr', 'KR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2673, 173, 'Al Wakrah', 'WK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2674, 173, 'Ar Rayyan', 'RN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2675, 173, 'Jarayan al Batinah', 'JB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2676, 173, 'Madinat ash Shamal', 'MS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2677, 173, 'Umm Sa''id', 'UD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2678, 173, 'Umm Salal', 'UL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2679, 175, 'Alba', 'AB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2680, 175, 'Arad', 'AR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2681, 175, 'Arges', 'AG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2682, 175, 'Bacau', 'BC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2683, 175, 'Bihor', 'BH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2684, 175, 'Bistrita-Nasaud', 'BN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2685, 175, 'Botosani', 'BT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2686, 175, 'Brasov', 'BV', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2687, 175, 'Braila', 'BR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2688, 175, 'Bucuresti', 'B', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2689, 175, 'Buzau', 'BZ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2690, 175, 'Caras-Severin', 'CS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2691, 175, 'Calarasi', 'CL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2692, 175, 'Cluj', 'CJ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2693, 175, 'Constanta', 'CT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2694, 175, 'Covasna', 'CV', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2695, 175, 'Dimbovita', 'DB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2696, 175, 'Dolj', 'DJ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2697, 175, 'Galati', 'GL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2698, 175, 'Giurgiu', 'GR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2699, 175, 'Gorj', 'GJ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2700, 175, 'Harghita', 'HR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2701, 175, 'Hunedoara', 'HD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2702, 175, 'Ialomita', 'IL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2703, 175, 'Iasi', 'IS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2704, 175, 'Ilfov', 'IF', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2705, 175, 'Maramures', 'MM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2706, 175, 'Mehedinti', 'MH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2707, 175, 'Mures', 'MS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2708, 175, 'Neamt', 'NT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2709, 175, 'Olt', 'OT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2710, 175, 'Prahova', 'PH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2711, 175, 'Satu-Mare', 'SM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2712, 175, 'Salaj', 'SJ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2713, 175, 'Sibiu', 'SB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2714, 175, 'Suceava', 'SV', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2715, 175, 'Teleorman', 'TR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2716, 175, 'Timis', 'TM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2717, 175, 'Tulcea', 'TL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2718, 175, 'Vaslui', 'VS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2719, 175, 'Valcea', 'VL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2720, 175, 'Vrancea', 'VN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2721, 176, 'Abakan', 'AB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2722, 176, 'Aginskoye', 'AG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2723, 176, 'Anadyr', 'AN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2724, 176, 'Arkahangelsk', 'AR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2725, 176, 'Astrakhan', 'AS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2726, 176, 'Barnaul', 'BA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2727, 176, 'Belgorod', 'BE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2728, 176, 'Birobidzhan', 'BI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2729, 176, 'Blagoveshchensk', 'BL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2730, 176, 'Bryansk', 'BR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2731, 176, 'Cheboksary', 'CH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2732, 176, 'Chelyabinsk', 'CL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2733, 176, 'Cherkessk', 'CR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2734, 176, 'Chita', 'CI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2735, 176, 'Dudinka', 'DU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2736, 176, 'Elista', 'EL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2737, 176, 'Gomo-Altaysk', 'GO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2738, 176, 'Gorno-Altaysk', 'GA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2739, 176, 'Groznyy', 'GR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2740, 176, 'Irkutsk', 'IR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2741, 176, 'Ivanovo', 'IV', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2742, 176, 'Izhevsk', 'IZ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2743, 176, 'Kalinigrad', 'KA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2744, 176, 'Kaluga', 'KL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2745, 176, 'Kasnodar', 'KS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2746, 176, 'Kazan', 'KZ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2747, 176, 'Kemerovo', 'KE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2748, 176, 'Khabarovsk', 'KH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2749, 176, 'Khanty-Mansiysk', 'KM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2750, 176, 'Kostroma', 'KO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2751, 176, 'Krasnodar', 'KR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2752, 176, 'Krasnoyarsk', 'KN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2753, 176, 'Kudymkar', 'KU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2754, 176, 'Kurgan', 'KG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2755, 176, 'Kursk', 'KK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2756, 176, 'Kyzyl', 'KY', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2757, 176, 'Lipetsk', 'LI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2758, 176, 'Magadan', 'MA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2759, 176, 'Makhachkala', 'MK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2760, 176, 'Maykop', 'MY', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2761, 176, 'Moscow', 'MO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2762, 176, 'Murmansk', 'MU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2763, 176, 'Nalchik', 'NA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2764, 176, 'Naryan Mar', 'NR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2765, 176, 'Nazran', 'NZ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2766, 176, 'Nizhniy Novgorod', 'NI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2767, 176, 'Novgorod', 'NO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2768, 176, 'Novosibirsk', 'NV', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2769, 176, 'Omsk', 'OM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2770, 176, 'Orel', 'OR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2771, 176, 'Orenburg', 'OE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2772, 176, 'Palana', 'PA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2773, 176, 'Penza', 'PE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2774, 176, 'Perm', 'PR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2775, 176, 'Petropavlovsk-Kamchatskiy', 'PK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2776, 176, 'Petrozavodsk', 'PT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2777, 176, 'Pskov', 'PS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2778, 176, 'Rostov-na-Donu', 'RO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2779, 176, 'Ryazan', 'RY', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2780, 176, 'Salekhard', 'SL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2781, 176, 'Samara', 'SA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2782, 176, 'Saransk', 'SR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2783, 176, 'Saratov', 'SV', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2784, 176, 'Smolensk', 'SM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2785, 176, 'St. Petersburg', 'SP', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2786, 176, 'Stavropol', 'ST', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2787, 176, 'Syktyvkar', 'SY', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2788, 176, 'Tambov', 'TA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2789, 176, 'Tomsk', 'TO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2790, 176, 'Tula', 'TU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2791, 176, 'Tura', 'TR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2792, 176, 'Tver', 'TV', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2793, 176, 'Tyumen', 'TY', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2794, 176, 'Ufa', 'UF', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2795, 176, 'Ul''yanovsk', 'UL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2796, 176, 'Ulan-Ude', 'UU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2797, 176, 'Ust''-Ordynskiy', 'US', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2798, 176, 'Vladikavkaz', 'VL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2799, 176, 'Vladimir', 'VA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2800, 176, 'Vladivostok', 'VV', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2801, 176, 'Volgograd', 'VG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2802, 176, 'Vologda', 'VD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2803, 176, 'Voronezh', 'VO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2804, 176, 'Vyatka', 'VY', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2805, 176, 'Yakutsk', 'YA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2806, 176, 'Yaroslavl', 'YR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2807, 176, 'Yekaterinburg', 'YE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2808, 176, 'Yoshkar-Ola', 'YO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2809, 177, 'Butare', 'BU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2810, 177, 'Byumba', 'BY', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2811, 177, 'Cyangugu', 'CY', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2812, 177, 'Gikongoro', 'GK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2813, 177, 'Gisenyi', 'GS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2814, 177, 'Gitarama', 'GT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2815, 177, 'Kibungo', 'KG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2816, 177, 'Kibuye', 'KY', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2817, 177, 'Kigali Rurale', 'KR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2818, 177, 'Kigali-ville', 'KV', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2819, 177, 'Ruhengeri', 'RU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2820, 177, 'Umutara', 'UM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2821, 178, 'Christ Church Nichola Town', 'CCN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2822, 178, 'Saint Anne Sandy Point', 'SAS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2823, 178, 'Saint George Basseterre', 'SGB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2824, 178, 'Saint George Gingerland', 'SGG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2825, 178, 'Saint James Windward', 'SJW', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2826, 178, 'Saint John Capesterre', 'SJC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2827, 178, 'Saint John Figtree', 'SJF', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2828, 178, 'Saint Mary Cayon', 'SMC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2829, 178, 'Saint Paul Capesterre', 'CAP', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2830, 178, 'Saint Paul Charlestown', 'CHA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2831, 178, 'Saint Peter Basseterre', 'SPB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2832, 178, 'Saint Thomas Lowland', 'STL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2833, 178, 'Saint Thomas Middle Island', 'STM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2834, 178, 'Trinity Palmetto Point', 'TPP', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2835, 179, 'Anse-la-Raye', 'AR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2836, 179, 'Castries', 'CA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2837, 179, 'Choiseul', 'CH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2838, 179, 'Dauphin', 'DA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2839, 179, 'Dennery', 'DE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2840, 179, 'Gros-Islet', 'GI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2841, 179, 'Laborie', 'LA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2842, 179, 'Micoud', 'MI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2843, 179, 'Praslin', 'PR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2844, 179, 'Soufriere', 'SO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2845, 179, 'Vieux-Fort', 'VF', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2846, 180, 'Charlotte', 'C', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2847, 180, 'Grenadines', 'R', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2848, 180, 'Saint Andrew', 'A', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2849, 180, 'Saint David', 'D', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2850, 180, 'Saint George', 'G', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2851, 180, 'Saint Patrick', 'P', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2852, 181, 'A''ana', 'AN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2853, 181, 'Aiga-i-le-Tai', 'AI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2854, 181, 'Atua', 'AT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2855, 181, 'Fa''asaleleaga', 'FA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2856, 181, 'Gaga''emauga', 'GE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2857, 181, 'Gagaifomauga', 'GF', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2858, 181, 'Palauli', 'PA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2859, 181, 'Satupa''itea', 'SA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2860, 181, 'Tuamasaga', 'TU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2861, 181, 'Va''a-o-Fonoti', 'VF', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2862, 181, 'Vaisigano', 'VS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2863, 182, 'Acquaviva', 'AC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2864, 182, 'Borgo Maggiore', 'BM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2865, 182, 'Chiesanuova', 'CH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2866, 182, 'Domagnano', 'DO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2867, 182, 'Faetano', 'FA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2868, 182, 'Fiorentino', 'FI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2869, 182, 'Montegiardino', 'MO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2870, 182, 'Citta di San Marino', 'SM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2871, 182, 'Serravalle', 'SE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2872, 183, 'Sao Tome', 'S', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2873, 183, 'Principe', 'P', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2874, 184, 'Al Bahah', 'BH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2875, 184, 'Al Hudud ash Shamaliyah', 'HS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2876, 184, 'Al Jawf', 'JF', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2877, 184, 'Al Madinah', 'MD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2878, 184, 'Al Qasim', 'QS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2879, 184, 'Ar Riyad', 'RD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2880, 184, 'Ash Sharqiyah (Eastern)', 'AQ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2881, 184, '''Asir', 'AS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2882, 184, 'Ha''il', 'HL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2883, 184, 'Jizan', 'JZ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2884, 184, 'Makkah', 'ML', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2885, 184, 'Najran', 'NR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2886, 184, 'Tabuk', 'TB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2887, 185, 'Dakar', 'DA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2888, 185, 'Diourbel', 'DI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2889, 185, 'Fatick', 'FA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2890, 185, 'Kaolack', 'KA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2891, 185, 'Kolda', 'KO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2892, 185, 'Louga', 'LO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2893, 185, 'Matam', 'MA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2894, 185, 'Saint-Louis', 'SL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2895, 185, 'Tambacounda', 'TA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2896, 185, 'Thies', 'TH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2897, 185, 'Ziguinchor', 'ZI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2898, 186, 'Anse aux Pins', 'AP', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2899, 186, 'Anse Boileau', 'AB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2900, 186, 'Anse Etoile', 'AE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2901, 186, 'Anse Louis', 'AL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2902, 186, 'Anse Royale', 'AR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2903, 186, 'Baie Lazare', 'BL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2904, 186, 'Baie Sainte Anne', 'BS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2905, 186, 'Beau Vallon', 'BV', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2906, 186, 'Bel Air', 'BA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2907, 186, 'Bel Ombre', 'BO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2908, 186, 'Cascade', 'CA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2909, 186, 'Glacis', 'GL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2910, 186, 'Grand'' Anse (on Mahe)', 'GM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2911, 186, 'Grand'' Anse (on Praslin)', 'GP', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2912, 186, 'La Digue', 'DG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2913, 186, 'La Riviere Anglaise', 'RA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2914, 186, 'Mont Buxton', 'MB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2915, 186, 'Mont Fleuri', 'MF', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2916, 186, 'Plaisance', 'PL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2917, 186, 'Pointe La Rue', 'PR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2918, 186, 'Port Glaud', 'PG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2919, 186, 'Saint Louis', 'SL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2920, 186, 'Takamaka', 'TA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2921, 187, 'Eastern', 'E', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2922, 187, 'Northern', 'N', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2923, 187, 'Southern', 'S', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2924, 187, 'Western', 'W', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2925, 189, 'Banskobystrický', 'BA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2926, 189, 'Bratislavský', 'BR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2927, 189, 'Košický', 'KO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2928, 189, 'Nitriansky', 'NI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2929, 189, 'Prešovský', 'PR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2930, 189, 'Trenčiansky', 'TC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2931, 189, 'Trnavský', 'TV', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2932, 189, 'Žilinský', 'ZI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2933, 191, 'Central', 'CE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2934, 191, 'Choiseul', 'CH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2935, 191, 'Guadalcanal', 'GC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2936, 191, 'Honiara', 'HO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2937, 191, 'Isabel', 'IS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2938, 191, 'Makira', 'MK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2939, 191, 'Malaita', 'ML', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2940, 191, 'Rennell and Bellona', 'RB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2941, 191, 'Temotu', 'TM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2942, 191, 'Western', 'WE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2943, 192, 'Awdal', 'AW', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2944, 192, 'Bakool', 'BK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2945, 192, 'Banaadir', 'BN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2946, 192, 'Bari', 'BR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2947, 192, 'Bay', 'BY', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2948, 192, 'Galguduud', 'GA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2949, 192, 'Gedo', 'GE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2950, 192, 'Hiiraan', 'HI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0);
INSERT INTO `state` (`state_id`, `country_id`, `state_name`, `state_code`, `date_added`, `added_by`, `date_modified`, `modified_by`, `status`, `is_deleted`) VALUES
(2951, 192, 'Jubbada Dhexe', 'JD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2952, 192, 'Jubbada Hoose', 'JH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2953, 192, 'Mudug', 'MU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2954, 192, 'Nugaal', 'NU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2955, 192, 'Sanaag', 'SA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2956, 192, 'Shabeellaha Dhexe', 'SD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2957, 192, 'Shabeellaha Hoose', 'SH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2958, 192, 'Sool', 'SL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2959, 192, 'Togdheer', 'TO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2960, 192, 'Woqooyi Galbeed', 'WG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2961, 193, 'Eastern Cape', 'EC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2962, 193, 'Free State', 'FS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2963, 193, 'Gauteng', 'GT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2964, 193, 'KwaZulu-Natal', 'KN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2965, 193, 'Limpopo', 'LP', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2966, 193, 'Mpumalanga', 'MP', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2967, 193, 'North West', 'NW', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2968, 193, 'Northern Cape', 'NC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2969, 193, 'Western Cape', 'WC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2970, 195, 'La Coru&ntilde;a', 'CA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2971, 195, 'Álava', 'AL', '0000-00-00 00:00:00', 1, '2016-12-06 10:30:20', 1, 1, 0),
(2972, 195, 'Albacete', 'AB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2973, 195, 'Alicante', 'AC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2974, 195, 'Almeria', 'AM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2975, 195, 'Asturias', 'AS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2976, 195, 'Ávila', 'AV', '0000-00-00 00:00:00', 1, '2016-12-10 12:01:20', 1, 1, 0),
(2977, 195, 'Badajoz', 'BJ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2978, 195, 'Baleares', 'IB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2979, 195, 'Barcelona', 'BA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2980, 195, 'Burgos', 'BU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2981, 195, 'C&aacute;ceres', 'CC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2982, 195, 'C&aacute;diz', 'CZ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2983, 195, 'Cantabria', 'CT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2984, 195, 'Castell&oacute;n', 'CL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2985, 195, 'Ceuta', 'CE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2986, 195, 'Ciudad Real', 'CR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2987, 195, 'C&oacute;rdoba', 'CD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2988, 195, 'Cuenca', 'CU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2989, 195, 'Girona', 'GI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2990, 195, 'Granada', 'GD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2991, 195, 'Guadalajara', 'GJ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2992, 195, 'Guip&uacute;zcoa', 'GP', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2993, 195, 'Huelva', 'HL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2994, 195, 'Huesca', 'HS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2995, 195, 'Ja&eacute;n', 'JN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2996, 195, 'La Rioja', 'RJ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2997, 195, 'Las Palmas', 'PM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2998, 195, 'Leon', 'LE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(2999, 195, 'Lleida', 'LL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3000, 195, 'Lugo', 'LG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3001, 195, 'Madrid', 'MD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3002, 195, 'Malaga', 'MA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3003, 195, 'Melilla', 'ML', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3004, 195, 'Murcia', 'MU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3005, 195, 'Navarra', 'NV', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3006, 195, 'Ourense', 'OU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3007, 195, 'Palencia', 'PL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3008, 195, 'Pontevedra', 'PO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3009, 195, 'Salamanca', 'SL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3010, 195, 'Santa Cruz de Tenerife', 'SC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3011, 195, 'Segovia', 'SG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3012, 195, 'Sevilla', 'SV', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3013, 195, 'Soria', 'SO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3014, 195, 'Tarragona', 'TA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3015, 195, 'Teruel', 'TE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3016, 195, 'Toledo', 'TO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3017, 195, 'Valencia', 'VC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3018, 195, 'Valladolid', 'VD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3019, 195, 'Vizcaya', 'VZ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3020, 195, 'Zamora', 'ZM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3021, 195, 'Zaragoza', 'ZR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3022, 196, 'Central', 'CE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3023, 196, 'Eastern', 'EA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3024, 196, 'North Central', 'NC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3025, 196, 'Northern', 'NO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3026, 196, 'North Western', 'NW', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3027, 196, 'Sabaragamuwa', 'SA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3028, 196, 'Southern', 'SO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3029, 196, 'Uva', 'UV', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3030, 196, 'Western', 'WE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3032, 197, 'Saint Helena', 'S', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3034, 199, 'A''ali an Nil', 'ANL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3035, 199, 'Al Bahr al Ahmar', 'BAM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3036, 199, 'Al Buhayrat', 'BRT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3037, 199, 'Al Jazirah', 'JZR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3038, 199, 'Al Khartum', 'KRT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3039, 199, 'Al Qadarif', 'QDR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3040, 199, 'Al Wahdah', 'WDH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3041, 199, 'An Nil al Abyad', 'ANB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3042, 199, 'An Nil al Azraq', 'ANZ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3043, 199, 'Ash Shamaliyah', 'ASH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3044, 199, 'Bahr al Jabal', 'BJA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3045, 199, 'Gharb al Istiwa''iyah', 'GIS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3046, 199, 'Gharb Bahr al Ghazal', 'GBG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3047, 199, 'Gharb Darfur', 'GDA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3048, 199, 'Gharb Kurdufan', 'GKU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3049, 199, 'Janub Darfur', 'JDA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3050, 199, 'Janub Kurdufan', 'JKU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3051, 199, 'Junqali', 'JQL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3052, 199, 'Kassala', 'KSL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3053, 199, 'Nahr an Nil', 'NNL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3054, 199, 'Shamal Bahr al Ghazal', 'SBG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3055, 199, 'Shamal Darfur', 'SDA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3056, 199, 'Shamal Kurdufan', 'SKU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3057, 199, 'Sharq al Istiwa''iyah', 'SIS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3058, 199, 'Sinnar', 'SNR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3059, 199, 'Warab', 'WRB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3060, 200, 'Brokopondo', 'BR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3061, 200, 'Commewijne', 'CM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3062, 200, 'Coronie', 'CR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3063, 200, 'Marowijne', 'MA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3064, 200, 'Nickerie', 'NI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3065, 200, 'Para', 'PA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3066, 200, 'Paramaribo', 'PM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3067, 200, 'Saramacca', 'SA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3068, 200, 'Sipaliwini', 'SI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3069, 200, 'Wanica', 'WA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3070, 202, 'Hhohho', 'H', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3071, 202, 'Lubombo', 'L', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3072, 202, 'Manzini', 'M', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3073, 202, 'Shishelweni', 'S', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3074, 203, 'Blekinge', 'K', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3075, 203, 'Dalarna', 'W', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3076, 203, 'G&auml;vleborg', 'X', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3077, 203, 'Gotland', 'I', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3078, 203, 'Halland', 'N', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3079, 203, 'J&auml;mtland', 'Z', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3080, 203, 'J&ouml;nk&ouml;ping', 'F', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3081, 203, 'Kalmar', 'H', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3082, 203, 'Kronoberg', 'G', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3083, 203, 'Norrbotten', 'BD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3084, 203, '&Ouml;rebro', 'T', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3085, 203, '&Ouml;sterg&ouml;tland', 'E', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3086, 203, 'Sk&aring;ne', 'M', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3087, 203, 'S&ouml;dermanland', 'D', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3088, 203, 'Stockholm', 'AB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3089, 203, 'Uppsala', 'C', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3090, 203, 'V&auml;rmland', 'S', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3091, 203, 'V&auml;sterbotten', 'AC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3092, 203, 'V&auml;sternorrland', 'Y', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3093, 203, 'V&auml;stmanland', 'U', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3094, 203, 'V&auml;stra G&ouml;taland', 'O', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3095, 204, 'Aargau', 'AG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3096, 204, 'Appenzell Ausserrhoden', 'AR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3097, 204, 'Appenzell Innerrhoden', 'AI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3098, 204, 'Basel-Stadt', 'BS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3099, 204, 'Basel-Landschaft', 'BL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3100, 204, 'Bern', 'BE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3101, 204, 'Fribourg', 'FR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3102, 204, 'Gen&egrave;ve', 'GE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3103, 204, 'Glarus', 'GL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3104, 204, 'Graub&uuml;nden', 'GR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3105, 204, 'Jura', 'JU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3106, 204, 'Luzern', 'LU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3107, 204, 'Neuch&acirc;tel', 'NE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3108, 204, 'Nidwald', 'NW', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3109, 204, 'Obwald', 'OW', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3110, 204, 'St. Gallen', 'SG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3111, 204, 'Schaffhausen', 'SH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3112, 204, 'Schwyz', 'SZ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3113, 204, 'Solothurn', 'SO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3114, 204, 'Thurgau', 'TG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3115, 204, 'Ticino', 'TI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3116, 204, 'Uri', 'UR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3117, 204, 'Valais', 'VS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3118, 204, 'Vaud', 'VD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3119, 204, 'Zug', 'ZG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3120, 204, 'Z&uuml;rich', 'ZH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3121, 205, 'Al Hasakah', 'HA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3122, 205, 'Al Ladhiqiyah', 'LA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3123, 205, 'Al Qunaytirah', 'QU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3124, 205, 'Ar Raqqah', 'RQ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3125, 205, 'As Suwayda', 'SU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3126, 205, 'Dara', 'DA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3127, 205, 'Dayr az Zawr', 'DZ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3128, 205, 'Dimashq', 'DI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3129, 205, 'Halab', 'HL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3130, 205, 'Hamah', 'HM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3131, 205, 'Hims', 'HI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3132, 205, 'Idlib', 'ID', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3133, 205, 'Rif Dimashq', 'RD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3134, 205, 'Tartus', 'TA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3135, 206, 'Chang-hua', 'CH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3136, 206, 'Chia-i', 'CI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3137, 206, 'Hsin-chu', 'HS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3138, 206, 'Hua-lien', 'HL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3139, 206, 'I-lan', 'IL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3140, 206, 'Kao-hsiung county', 'KH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3141, 206, 'Kin-men', 'KM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3142, 206, 'Lien-chiang', 'LC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3143, 206, 'Miao-li', 'ML', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3144, 206, 'Nan-t''ou', 'NT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3145, 206, 'P''eng-hu', 'PH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3146, 206, 'P''ing-tung', 'PT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3147, 206, 'T''ai-chung', 'TG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3148, 206, 'T''ai-nan', 'TA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3149, 206, 'T''ai-pei county', 'TP', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3150, 206, 'T''ai-tung', 'TT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3151, 206, 'T''ao-yuan', 'TY', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3152, 206, 'Yun-lin', 'YL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3153, 206, 'Chia-i city', 'CC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3154, 206, 'Chi-lung', 'CL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3155, 206, 'Hsin-chu', 'HC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3156, 206, 'T''ai-chung', 'TH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3157, 206, 'T''ai-nan', 'TN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3158, 206, 'Kao-hsiung city', 'KC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3159, 206, 'T''ai-pei city', 'TC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3160, 207, 'Gorno-Badakhstan', 'GB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3161, 207, 'Khatlon', 'KT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3162, 207, 'Sughd', 'SU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3163, 208, 'Arusha', 'AR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3164, 208, 'Dar es Salaam', 'DS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3165, 208, 'Dodoma', 'DO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3166, 208, 'Iringa', 'IR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3167, 208, 'Kagera', 'KA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3168, 208, 'Kigoma', 'KI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3169, 208, 'Kilimanjaro', 'KJ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3170, 208, 'Lindi', 'LN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3171, 208, 'Manyara', 'MY', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3172, 208, 'Mara', 'MR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3173, 208, 'Mbeya', 'MB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3174, 208, 'Morogoro', 'MO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3175, 208, 'Mtwara', 'MT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3176, 208, 'Mwanza', 'MW', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3177, 208, 'Pemba North', 'PN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3178, 208, 'Pemba South', 'PS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3179, 208, 'Pwani', 'PW', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3180, 208, 'Rukwa', 'RK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3181, 208, 'Ruvuma', 'RV', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3182, 208, 'Shinyanga', 'SH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3183, 208, 'Singida', 'SI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3184, 208, 'Tabora', 'TB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3185, 208, 'Tanga', 'TN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3186, 208, 'Zanzibar Central/South', 'ZC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3187, 208, 'Zanzibar North', 'ZN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3188, 208, 'Zanzibar Urban/West', 'ZU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3189, 209, 'Amnat Charoen', 'Amnat Charoen', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3190, 209, 'Ang Thong', 'Ang Thong', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3191, 209, 'Ayutthaya', 'Ayutthaya', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3192, 209, 'Bangkok', 'Bangkok', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3193, 209, 'Buriram', 'Buriram', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3194, 209, 'Chachoengsao', 'Chachoengsao', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3195, 209, 'Chai Nat', 'Chai Nat', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3196, 209, 'Chaiyaphum', 'Chaiyaphum', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3197, 209, 'Chanthaburi', 'Chanthaburi', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3198, 209, 'Chiang Mai', 'Chiang Mai', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3199, 209, 'Chiang Rai', 'Chiang Rai', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3200, 209, 'Chon Buri', 'Chon Buri', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3201, 209, 'Chumphon', 'Chumphon', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3202, 209, 'Kalasin', 'Kalasin', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3203, 209, 'Kamphaeng Phet', 'Kamphaeng Phet', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3204, 209, 'Kanchanaburi', 'Kanchanaburi', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3205, 209, 'Khon Kaen', 'Khon Kaen', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3206, 209, 'Krabi', 'Krabi', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3207, 209, 'Lampang', 'Lampang', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3208, 209, 'Lamphun', 'Lamphun', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3209, 209, 'Loei', 'Loei', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3210, 209, 'Lop Buri', 'Lop Buri', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3211, 209, 'Mae Hong Son', 'Mae Hong Son', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3212, 209, 'Maha Sarakham', 'Maha Sarakham', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3213, 209, 'Mukdahan', 'Mukdahan', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3214, 209, 'Nakhon Nayok', 'Nakhon Nayok', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3215, 209, 'Nakhon Pathom', 'Nakhon Pathom', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3216, 209, 'Nakhon Phanom', 'Nakhon Phanom', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3217, 209, 'Nakhon Ratchasima', 'Nakhon Ratchasima', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3218, 209, 'Nakhon Sawan', 'Nakhon Sawan', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3219, 209, 'Nakhon Si Thammarat', 'Nakhon Si Thammarat', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3220, 209, 'Nan', 'Nan', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3221, 209, 'Narathiwat', 'Narathiwat', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3222, 209, 'Nong Bua Lamphu', 'Nong Bua Lamphu', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3223, 209, 'Nong Khai', 'Nong Khai', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3224, 209, 'Nonthaburi', 'Nonthaburi', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3225, 209, 'Pathum Thani', 'Pathum Thani', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3226, 209, 'Pattani', 'Pattani', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3227, 209, 'Phangnga', 'Phangnga', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3228, 209, 'Phatthalung', 'Phatthalung', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3229, 209, 'Phayao', 'Phayao', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3230, 209, 'Phetchabun', 'Phetchabun', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3231, 209, 'Phetchaburi', 'Phetchaburi', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3232, 209, 'Phichit', 'Phichit', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3233, 209, 'Phitsanulok', 'Phitsanulok', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3234, 209, 'Phrae', 'Phrae', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3235, 209, 'Phuket', 'Phuket', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3236, 209, 'Prachin Buri', 'Prachin Buri', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3237, 209, 'Prachuap Khiri Khan', 'Prachuap Khiri Khan', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3238, 209, 'Ranong', 'Ranong', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3239, 209, 'Ratchaburi', 'Ratchaburi', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3240, 209, 'Rayong', 'Rayong', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3241, 209, 'Roi Et', 'Roi Et', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3242, 209, 'Sa Kaeo', 'Sa Kaeo', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3243, 209, 'Sakon Nakhon', 'Sakon Nakhon', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3244, 209, 'Samut Prakan', 'Samut Prakan', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3245, 209, 'Samut Sakhon', 'Samut Sakhon', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3246, 209, 'Samut Songkhram', 'Samut Songkhram', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3247, 209, 'Sara Buri', 'Sara Buri', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3248, 209, 'Satun', 'Satun', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3249, 209, 'Sing Buri', 'Sing Buri', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3250, 209, 'Sisaket', 'Sisaket', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3251, 209, 'Songkhla', 'Songkhla', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3252, 209, 'Sukhothai', 'Sukhothai', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3253, 209, 'Suphan Buri', 'Suphan Buri', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3254, 209, 'Surat Thani', 'Surat Thani', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3255, 209, 'Surin', 'Surin', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3256, 209, 'Tak', 'Tak', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3257, 209, 'Trang', 'Trang', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3258, 209, 'Trat', 'Trat', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3259, 209, 'Ubon Ratchathani', 'Ubon Ratchathani', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3260, 209, 'Udon Thani', 'Udon Thani', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3261, 209, 'Uthai Thani', 'Uthai Thani', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3262, 209, 'Uttaradit', 'Uttaradit', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3263, 209, 'Yala', 'Yala', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3264, 209, 'Yasothon', 'Yasothon', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3265, 210, 'Kara', 'K', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3266, 210, 'Plateaux', 'P', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3267, 210, 'Savanes', 'S', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3268, 210, 'Centrale', 'C', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3269, 210, 'Maritime', 'M', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3270, 211, 'Atafu', 'A', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3271, 211, 'Fakaofo', 'F', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3272, 211, 'Nukunonu', 'N', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3273, 212, 'Ha''apai', 'H', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3274, 212, 'Tongatapu', 'T', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3275, 212, 'Vava''u', 'V', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3276, 213, 'Couva/Tabaquite/Talparo', 'CT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3277, 213, 'Diego Martin', 'DM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3278, 213, 'Mayaro/Rio Claro', 'MR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3279, 213, 'Penal/Debe', 'PD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3280, 213, 'Princes Town', 'PT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3281, 213, 'Sangre Grande', 'SG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3282, 213, 'San Juan/Laventille', 'SL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3283, 213, 'Siparia', 'SI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3284, 213, 'Tunapuna/Piarco', 'TP', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3285, 213, 'Port of Spain', 'PS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3286, 213, 'San Fernando', 'SF', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3287, 213, 'Arima', 'AR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3288, 213, 'Point Fortin', 'PF', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3289, 213, 'Chaguanas', 'CH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3290, 213, 'Tobago', 'TO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3291, 214, 'Ariana', 'AR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3292, 214, 'Beja', 'BJ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3293, 214, 'Ben Arous', 'BA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3294, 214, 'Bizerte', 'BI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3295, 214, 'Gabes', 'GB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3296, 214, 'Gafsa', 'GF', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3297, 214, 'Jendouba', 'JE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3298, 214, 'Kairouan', 'KR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3299, 214, 'Kasserine', 'KS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3300, 214, 'Kebili', 'KB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3301, 214, 'Kef', 'KF', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3302, 214, 'Mahdia', 'MH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3303, 214, 'Manouba', 'MN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3304, 214, 'Medenine', 'ME', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3305, 214, 'Monastir', 'MO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3306, 214, 'Nabeul', 'NA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3307, 214, 'Sfax', 'SF', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3308, 214, 'Sidi', 'SD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3309, 214, 'Siliana', 'SL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3310, 214, 'Sousse', 'SO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3311, 214, 'Tataouine', 'TA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3312, 214, 'Tozeur', 'TO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3313, 214, 'Tunis', 'TU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3314, 214, 'Zaghouan', 'ZA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3315, 215, 'Adana', 'ADA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3316, 215, 'Adıyaman', 'ADI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3317, 215, 'Afyonkarahisar', 'AFY', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3318, 215, 'Ağrı', 'AGR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3319, 215, 'Aksaray', 'AKS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3320, 215, 'Amasya', 'AMA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3321, 215, 'Ankara', 'ANK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3322, 215, 'Antalya', 'ANT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3323, 215, 'Ardahan', 'ARD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3324, 215, 'Artvin', 'ART', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3325, 215, 'Aydın', 'AYI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3326, 215, 'Balıkesir', 'BAL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3327, 215, 'Bartın', 'BAR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3328, 215, 'Batman', 'BAT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3329, 215, 'Bayburt', 'BAY', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3330, 215, 'Bilecik', 'BIL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3331, 215, 'Bingöl', 'BIN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3332, 215, 'Bitlis', 'BIT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3333, 215, 'Bolu', 'BOL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3334, 215, 'Burdur', 'BRD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3335, 215, 'Bursa', 'BRS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3336, 215, 'Çanakkale', 'CKL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3337, 215, 'Çankırı', 'CKR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3338, 215, 'Çorum', 'COR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3339, 215, 'Denizli', 'DEN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3340, 215, 'Diyarbakır', 'DIY', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3341, 215, 'Düzce', 'DUZ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3342, 215, 'Edirne', 'EDI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3343, 215, 'Elazığ', 'ELA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3344, 215, 'Erzincan', 'EZC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3345, 215, 'Erzurum', 'EZR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3346, 215, 'Eskişehir', 'ESK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3347, 215, 'Gaziantep', 'GAZ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3348, 215, 'Giresun', 'GIR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3349, 215, 'Gümüşhane', 'GMS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3350, 215, 'Hakkari', 'HKR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3351, 215, 'Hatay', 'HTY', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3352, 215, 'Iğdır', 'IGD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3353, 215, 'Isparta', 'ISP', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3354, 215, 'İstanbul', 'IST', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3355, 215, 'İzmir', 'IZM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3356, 215, 'Kahramanmaraş', 'KAH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3357, 215, 'Karabük', 'KRB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3358, 215, 'Karaman', 'KRM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3359, 215, 'Kars', 'KRS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3360, 215, 'Kastamonu', 'KAS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3361, 215, 'Kayseri', 'KAY', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3362, 215, 'Kilis', 'KLS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3363, 215, 'Kırıkkale', 'KRK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3364, 215, 'Kırklareli', 'KLR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3365, 215, 'Kırşehir', 'KRH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3366, 215, 'Kocaeli', 'KOC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3367, 215, 'Konya', 'KON', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3368, 215, 'Kütahya', 'KUT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3369, 215, 'Malatya', 'MAL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3370, 215, 'Manisa', 'MAN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3371, 215, 'Mardin', 'MAR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3372, 215, 'Mersin', 'MER', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3373, 215, 'Muğla', 'MUG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3374, 215, 'Muş', 'MUS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3375, 215, 'Nevşehir', 'NEV', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3376, 215, 'Niğde', 'NIG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3377, 215, 'Ordu', 'ORD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3378, 215, 'Osmaniye', 'OSM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3379, 215, 'Rize', 'RIZ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3380, 215, 'Sakarya', 'SAK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3381, 215, 'Samsun', 'SAM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3382, 215, 'Şanlıurfa', 'SAN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3383, 215, 'Siirt', 'SII', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3384, 215, 'Sinop', 'SIN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3385, 215, 'Şırnak', 'SIR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3386, 215, 'Sivas', 'SIV', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3387, 215, 'Tekirdağ', 'TEL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3388, 215, 'Tokat', 'TOK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3389, 215, 'Trabzon', 'TRA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3390, 215, 'Tunceli', 'TUN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3391, 215, 'Uşak', 'USK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3392, 215, 'Van', 'VAN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3393, 215, 'Yalova', 'YAL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3394, 215, 'Yozgat', 'YOZ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3395, 215, 'Zonguldak', 'ZON', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3396, 216, 'Ahal Welayaty', 'A', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3397, 216, 'Balkan Welayaty', 'B', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3398, 216, 'Dashhowuz Welayaty', 'D', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3399, 216, 'Lebap Welayaty', 'L', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3400, 216, 'Mary Welayaty', 'M', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3401, 217, 'Ambergris Cays', 'AC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3402, 217, 'Dellis Cay', 'DC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3403, 217, 'French Cay', 'FC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3404, 217, 'Little Water Cay', 'LW', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3405, 217, 'Parrot Cay', 'RC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3406, 217, 'Pine Cay', 'PN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3407, 217, 'Salt Cay', 'SL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3408, 217, 'Grand Turk', 'GT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3409, 217, 'South Caicos', 'SC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3410, 217, 'East Caicos', 'EC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3411, 217, 'Middle Caicos', 'MC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3412, 217, 'North Caicos', 'NC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3413, 217, 'Providenciales', 'PR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3414, 217, 'West Caicos', 'WC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3415, 218, 'Nanumanga', 'NMG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3416, 218, 'Niulakita', 'NLK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3417, 218, 'Niutao', 'NTO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3418, 218, 'Funafuti', 'FUN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3419, 218, 'Nanumea', 'NME', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3420, 218, 'Nui', 'NUI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3421, 218, 'Nukufetau', 'NFT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3422, 218, 'Nukulaelae', 'NLL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3423, 218, 'Vaitupu', 'VAI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3424, 219, 'Kalangala', 'KAL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3425, 219, 'Kampala', 'KMP', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3426, 219, 'Kayunga', 'KAY', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3427, 219, 'Kiboga', 'KIB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3428, 219, 'Luwero', 'LUW', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3429, 219, 'Masaka', 'MAS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3430, 219, 'Mpigi', 'MPI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3431, 219, 'Mubende', 'MUB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3432, 219, 'Mukono', 'MUK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3433, 219, 'Nakasongola', 'NKS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3434, 219, 'Rakai', 'RAK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3435, 219, 'Sembabule', 'SEM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3436, 219, 'Wakiso', 'WAK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3437, 219, 'Bugiri', 'BUG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3438, 219, 'Busia', 'BUS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3439, 219, 'Iganga', 'IGA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3440, 219, 'Jinja', 'JIN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3441, 219, 'Kaberamaido', 'KAB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3442, 219, 'Kamuli', 'KML', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3443, 219, 'Kapchorwa', 'KPC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3444, 219, 'Katakwi', 'KTK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3445, 219, 'Kumi', 'KUM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3446, 219, 'Mayuge', 'MAY', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3447, 219, 'Mbale', 'MBA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3448, 219, 'Pallisa', 'PAL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3449, 219, 'Sironko', 'SIR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3450, 219, 'Soroti', 'SOR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3451, 219, 'Tororo', 'TOR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3452, 219, 'Adjumani', 'ADJ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3453, 219, 'Apac', 'APC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3454, 219, 'Arua', 'ARU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3455, 219, 'Gulu', 'GUL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3456, 219, 'Kitgum', 'KIT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3457, 219, 'Kotido', 'KOT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3458, 219, 'Lira', 'LIR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3459, 219, 'Moroto', 'MRT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3460, 219, 'Moyo', 'MOY', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3461, 219, 'Nakapiripirit', 'NAK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3462, 219, 'Nebbi', 'NEB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3463, 219, 'Pader', 'PAD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3464, 219, 'Yumbe', 'YUM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3465, 219, 'Bundibugyo', 'BUN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3466, 219, 'Bushenyi', 'BSH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3467, 219, 'Hoima', 'HOI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3468, 219, 'Kabale', 'KBL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3469, 219, 'Kabarole', 'KAR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3470, 219, 'Kamwenge', 'KAM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3471, 219, 'Kanungu', 'KAN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3472, 219, 'Kasese', 'KAS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3473, 219, 'Kibaale', 'KBA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3474, 219, 'Kisoro', 'KIS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3475, 219, 'Kyenjojo', 'KYE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3476, 219, 'Masindi', 'MSN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3477, 219, 'Mbarara', 'MBR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3478, 219, 'Ntungamo', 'NTU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3479, 219, 'Rukungiri', 'RUK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3480, 220, 'Cherkas''ka Oblast''', '71', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3481, 220, 'Chernihivs''ka Oblast''', '74', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3482, 220, 'Chernivets''ka Oblast''', '77', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3483, 220, 'Crimea', '43', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3484, 220, 'Dnipropetrovs''ka Oblast''', '12', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3485, 220, 'Donets''ka Oblast''', '14', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3486, 220, 'Ivano-Frankivs''ka Oblast''', '26', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3487, 220, 'Khersons''ka Oblast''', '65', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3488, 220, 'Khmel''nyts''ka Oblast''', '68', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3489, 220, 'Kirovohrads''ka Oblast''', '35', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3490, 220, 'Kyiv', '30', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3491, 220, 'Kyivs''ka Oblast''', '32', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3492, 220, 'Luhans''ka Oblast''', '09', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3493, 220, 'L''vivs''ka Oblast''', '46', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3494, 220, 'Mykolayivs''ka Oblast''', '48', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3495, 220, 'Odes''ka Oblast''', '51', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3496, 220, 'Poltavs''ka Oblast''', '53', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3497, 220, 'Rivnens''ka Oblast''', '56', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3498, 220, 'Sevastopol''', '40', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3499, 220, 'Sums''ka Oblast''', '59', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3500, 220, 'Ternopil''s''ka Oblast''', '61', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3501, 220, 'Vinnyts''ka Oblast''', '05', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3502, 220, 'Volyns''ka Oblast''', '07', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3503, 220, 'Zakarpats''ka Oblast''', '21', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3504, 220, 'Zaporiz''ka Oblast''', '23', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3505, 220, 'Zhytomyrs''ka oblast''', '18', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3506, 221, 'Abu Dhabi', 'ADH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3507, 221, '''Ajman', 'AJ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3508, 221, 'Al Fujayrah', 'FU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0);
INSERT INTO `state` (`state_id`, `country_id`, `state_name`, `state_code`, `date_added`, `added_by`, `date_modified`, `modified_by`, `status`, `is_deleted`) VALUES
(3509, 221, 'Ash Shariqah', 'SH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3510, 221, 'Dubai', 'DU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3511, 221, 'R''as al Khaymah', 'RK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3512, 221, 'Umm al Qaywayn', 'UQ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3513, 222, 'Aberdeen', 'ABN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3514, 222, 'Aberdeenshire', 'ABNS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3515, 222, 'Anglesey', 'ANG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3516, 222, 'Angus', 'AGS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3517, 222, 'Argyll and Bute', 'ARY', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3518, 222, 'Bedfordshire', 'BEDS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3519, 222, 'Berkshire', 'BERKS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3520, 222, 'Blaenau Gwent', 'BLA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3521, 222, 'Bridgend', 'BRI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3522, 222, 'Bristol', 'BSTL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3523, 222, 'Buckinghamshire', 'BUCKS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3524, 222, 'Caerphilly', 'CAE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3525, 222, 'Cambridgeshire', 'CAMBS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3526, 222, 'Cardiff', 'CDF', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3527, 222, 'Carmarthenshire', 'CARM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3528, 222, 'Ceredigion', 'CDGN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3529, 222, 'Cheshire', 'CHES', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3530, 222, 'Clackmannanshire', 'CLACK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3531, 222, 'Conwy', 'CON', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3532, 222, 'Cornwall', 'CORN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3533, 222, 'Denbighshire', 'DNBG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3534, 222, 'Derbyshire', 'DERBY', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3535, 222, 'Devon', 'DVN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3536, 222, 'Dorset', 'DOR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3537, 222, 'Dumfries and Galloway', 'DGL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3538, 222, 'Dundee', 'DUND', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3539, 222, 'Durham', 'DHM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3540, 222, 'East Ayrshire', 'ARYE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3541, 222, 'East Dunbartonshire', 'DUNBE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3542, 222, 'East Lothian', 'LOTE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3543, 222, 'East Renfrewshire', 'RENE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3544, 222, 'East Riding of Yorkshire', 'ERYS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3545, 222, 'East Sussex', 'SXE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3546, 222, 'Edinburgh', 'EDIN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3547, 222, 'Essex', 'ESX', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3548, 222, 'Falkirk', 'FALK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3549, 222, 'Fife', 'FFE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3550, 222, 'Flintshire', 'FLINT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3551, 222, 'Glasgow', 'GLAS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3552, 222, 'Gloucestershire', 'GLOS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3553, 222, 'Greater London', 'LDN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3554, 222, 'Greater Manchester', 'MCH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3555, 222, 'Gwynedd', 'GDD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3556, 222, 'Hampshire', 'HANTS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3557, 222, 'Herefordshire', 'HWR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3558, 222, 'Hertfordshire', 'HERTS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3559, 222, 'Highlands', 'HLD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3560, 222, 'Inverclyde', 'IVER', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3561, 222, 'Isle of Wight', 'IOW', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3562, 222, 'Kent', 'KNT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3563, 222, 'Lancashire', 'LANCS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3564, 222, 'Leicestershire', 'LEICS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3565, 222, 'Lincolnshire', 'LINCS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3566, 222, 'Merseyside', 'MSY', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3567, 222, 'Merthyr Tydfil', 'MERT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3568, 222, 'Midlothian', 'MLOT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3569, 222, 'Monmouthshire', 'MMOUTH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3570, 222, 'Moray', 'MORAY', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3571, 222, 'Neath Port Talbot', 'NPRTAL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3572, 222, 'Newport', 'NEWPT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3573, 222, 'Norfolk', 'NOR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3574, 222, 'North Ayrshire', 'ARYN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3575, 222, 'North Lanarkshire', 'LANN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3576, 222, 'North Yorkshire', 'YSN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3577, 222, 'Northamptonshire', 'NHM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3578, 222, 'Northumberland', 'NLD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3579, 222, 'Nottinghamshire', 'NOT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3580, 222, 'Orkney Islands', 'ORK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3581, 222, 'Oxfordshire', 'OFE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3582, 222, 'Pembrokeshire', 'PEM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3583, 222, 'Perth and Kinross', 'PERTH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3584, 222, 'Powys', 'PWS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3585, 222, 'Renfrewshire', 'REN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3586, 222, 'Rhondda Cynon Taff', 'RHON', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3587, 222, 'Rutland', 'RUT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3588, 222, 'Scottish Borders', 'BOR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3589, 222, 'Shetland Islands', 'SHET', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3590, 222, 'Shropshire', 'SPE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3591, 222, 'Somerset', 'SOM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3592, 222, 'South Ayrshire', 'ARYS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3593, 222, 'South Lanarkshire', 'LANS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3594, 222, 'South Yorkshire', 'YSS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3595, 222, 'Staffordshire', 'SFD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3596, 222, 'Stirling', 'STIR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3597, 222, 'Suffolk', 'SFK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3598, 222, 'Surrey', 'SRY', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3599, 222, 'Swansea', 'SWAN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3600, 222, 'Torfaen', 'TORF', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3601, 222, 'Tyne and Wear', 'TWR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3602, 222, 'Vale of Glamorgan', 'VGLAM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3603, 222, 'Warwickshire', 'WARKS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3604, 222, 'West Dunbartonshire', 'WDUN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3605, 222, 'West Lothian', 'WLOT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3606, 222, 'West Midlands', 'WMD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3607, 222, 'West Sussex', 'SXW', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3608, 222, 'West Yorkshire', 'YSW', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3609, 222, 'Western Isles', 'WIL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3610, 222, 'Wiltshire', 'WLT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3611, 222, 'Worcestershire', 'WORCS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3612, 222, 'Wrexham', 'WRX', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3613, 223, 'Alabama', 'AL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3614, 223, 'Alaska', 'AK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3615, 223, 'American Samoa', 'AS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3616, 223, 'Arizona', 'AZ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3617, 223, 'Arkansas', 'AR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3618, 223, 'Armed Forces Africa', 'AF', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3619, 223, 'Armed Forces Americas', 'AA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3620, 223, 'Armed Forces Canada', 'AC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3621, 223, 'Armed Forces Europe', 'AE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3622, 223, 'Armed Forces Middle East', 'AM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3623, 223, 'Armed Forces Pacific', 'AP', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3624, 223, 'California', 'CA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3625, 223, 'Colorado', 'CO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3626, 223, 'Connecticut', 'CT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3627, 223, 'Delaware', 'DE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3628, 223, 'District of Columbia', 'DC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3629, 223, 'Federated States Of Micronesia', 'FM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3630, 223, 'Florida', 'FL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3631, 223, 'Georgia', 'GA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3632, 223, 'Guam', 'GU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3633, 223, 'Hawaii', 'HI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3634, 223, 'Idaho', 'ID', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3635, 223, 'Illinois', 'IL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3636, 223, 'Indiana', 'IN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3637, 223, 'Iowa', 'IA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3638, 223, 'Kansas', 'KS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3639, 223, 'Kentucky', 'KY', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3640, 223, 'Louisiana', 'LA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3641, 223, 'Maine', 'ME', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3642, 223, 'Marshall Islands', 'MH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3643, 223, 'Maryland', 'MD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3644, 223, 'Massachusetts', 'MA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3645, 223, 'Michigan', 'MI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3646, 223, 'Minnesota', 'MN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3647, 223, 'Mississippi', 'MS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3648, 223, 'Missouri', 'MO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3649, 223, 'Montana', 'MT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3650, 223, 'Nebraska', 'NE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3651, 223, 'Nevada', 'NV', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3652, 223, 'New Hampshire', 'NH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3653, 223, 'New Jersey', 'NJ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3654, 223, 'New Mexico', 'NM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3655, 223, 'New York', 'NY', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3656, 223, 'North Carolina', 'NC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3657, 223, 'North Dakota', 'ND', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3658, 223, 'Northern Mariana Islands', 'MP', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3659, 223, 'Ohio', 'OH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3660, 223, 'Oklahoma', 'OK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3661, 223, 'Oregon', 'OR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3662, 223, 'Palau', 'PW', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3663, 223, 'Pennsylvania', 'PA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3664, 223, 'Puerto Rico', 'PR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3665, 223, 'Rhode Island', 'RI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3666, 223, 'South Carolina', 'SC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3667, 223, 'South Dakota', 'SD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3668, 223, 'Tennessee', 'TN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3669, 223, 'Texas', 'TX', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3670, 223, 'Utah', 'UT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3671, 223, 'Vermont', 'VT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3672, 223, 'Virgin Islands', 'VI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3673, 223, 'Virginia', 'VA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3674, 223, 'Washington', 'WA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3675, 223, 'West Virginia', 'WV', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3676, 223, 'Wisconsin', 'WI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3677, 223, 'Wyoming', 'WY', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3678, 224, 'Baker Island', 'BI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3679, 224, 'Howland Island', 'HI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3680, 224, 'Jarvis Island', 'JI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3681, 224, 'Johnston Atoll', 'JA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3682, 224, 'Kingman Reef', 'KR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3683, 224, 'Midway Atoll', 'MA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3684, 224, 'Navassa Island', 'NI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3685, 224, 'Palmyra Atoll', 'PA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3686, 224, 'Wake Island', 'WI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3687, 225, 'Artigas', 'AR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3688, 225, 'Canelones', 'CA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3689, 225, 'Cerro Largo', 'CL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3690, 225, 'Colonia', 'CO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3691, 225, 'Durazno', 'DU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3692, 225, 'Flores', 'FS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3693, 225, 'Florida', 'FA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3694, 225, 'Lavalleja', 'LA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3695, 225, 'Maldonado', 'MA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3696, 225, 'Montevideo', 'MO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3697, 225, 'Paysandu', 'PA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3698, 225, 'Rio Negro', 'RN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3699, 225, 'Rivera', 'RV', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3700, 225, 'Rocha', 'RO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3701, 225, 'Salto', 'SL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3702, 225, 'San Jose', 'SJ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3703, 225, 'Soriano', 'SO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3704, 225, 'Tacuarembo', 'TA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3705, 225, 'Treinta y Tres', 'TT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3706, 226, 'Andijon', 'AN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3707, 226, 'Buxoro', 'BU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3708, 226, 'Farg''ona', 'FA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3709, 226, 'Jizzax', 'JI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3710, 226, 'Namangan', 'NG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3711, 226, 'Navoiy', 'NW', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3712, 226, 'Qashqadaryo', 'QA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3713, 226, 'Qoraqalpog''iston Republikasi', 'QR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3714, 226, 'Samarqand', 'SA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3715, 226, 'Sirdaryo', 'SI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3716, 226, 'Surxondaryo', 'SU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3717, 226, 'Toshkent City', 'TK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3718, 226, 'Toshkent Region', 'TO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3719, 226, 'Xorazm', 'XO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3720, 227, 'Malampa', 'MA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3721, 227, 'Penama', 'PE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3722, 227, 'Sanma', 'SA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3723, 227, 'Shefa', 'SH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3724, 227, 'Tafea', 'TA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3725, 227, 'Torba', 'TO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3726, 229, 'Amazonas', 'AM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3727, 229, 'Anzoategui', 'AN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3728, 229, 'Apure', 'AP', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3729, 229, 'Aragua', 'AR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3730, 229, 'Barinas', 'BA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3731, 229, 'Bolivar', 'BO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3732, 229, 'Carabobo', 'CA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3733, 229, 'Cojedes', 'CO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3734, 229, 'Delta Amacuro', 'DA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3735, 229, 'Dependencias Federales', 'DF', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3736, 229, 'Distrito Federal', 'DI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3737, 229, 'Falcon', 'FA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3738, 229, 'Guarico', 'GU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3739, 229, 'Lara', 'LA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3740, 229, 'Merida', 'ME', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3741, 229, 'Miranda', 'MI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3742, 229, 'Monagas', 'MO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3743, 229, 'Nueva Esparta', 'NE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3744, 229, 'Portuguesa', 'PO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3745, 229, 'Sucre', 'SU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3746, 229, 'Tachira', 'TA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3747, 229, 'Trujillo', 'TR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3748, 229, 'Vargas', 'VA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3749, 229, 'Yaracuy', 'YA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3750, 229, 'Zulia', 'ZU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3751, 230, 'An Giang', 'AG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3752, 230, 'Bac Giang', 'BG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3753, 230, 'Bac Kan', 'BK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3754, 230, 'Bac Lieu', 'BL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3755, 230, 'Bac Ninh', 'BC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3756, 230, 'Ba Ria-Vung Tau', 'BR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3757, 230, 'Ben Tre', 'BN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3758, 230, 'Binh Dinh', 'BH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3759, 230, 'Binh Duong', 'BU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3760, 230, 'Binh Phuoc', 'BP', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3761, 230, 'Binh Thuan', 'BT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3762, 230, 'Ca Mau', 'CM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3763, 230, 'Can Tho', 'CT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3764, 230, 'Cao Bang', 'CB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3765, 230, 'Dak Lak', 'DL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3766, 230, 'Dak Nong', 'DG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3767, 230, 'Da Nang', 'DN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3768, 230, 'Dien Bien', 'DB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3769, 230, 'Dong Nai', 'DI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3770, 230, 'Dong Thap', 'DT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3771, 230, 'Gia Lai', 'GL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3772, 230, 'Ha Giang', 'HG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3773, 230, 'Hai Duong', 'HD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3774, 230, 'Hai Phong', 'HP', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3775, 230, 'Ha Nam', 'HM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3776, 230, 'Ha Noi', 'HI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3777, 230, 'Ha Tay', 'HT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3778, 230, 'Ha Tinh', 'HH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3779, 230, 'Hoa Binh', 'HB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3780, 230, 'Ho Chi Minh City', 'HC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3781, 230, 'Hau Giang', 'HU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3782, 230, 'Hung Yen', 'HY', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3783, 232, 'Saint Croix', 'C', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3784, 232, 'Saint John', 'J', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3785, 232, 'Saint Thomas', 'T', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3786, 233, 'Alo', 'A', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3787, 233, 'Sigave', 'S', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3788, 233, 'Wallis', 'W', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3789, 235, 'Abyan', 'AB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3790, 235, 'Adan', 'AD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3791, 235, 'Amran', 'AM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3792, 235, 'Al Bayda', 'BA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3793, 235, 'Ad Dali', 'DA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3794, 235, 'Dhamar', 'DH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3795, 235, 'Hadramawt', 'HD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3796, 235, 'Hajjah', 'HJ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3797, 235, 'Al Hudaydah', 'HU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3798, 235, 'Ibb', 'IB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3799, 235, 'Al Jawf', 'JA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3800, 235, 'Lahij', 'LA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3801, 235, 'Ma''rib', 'MA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3802, 235, 'Al Mahrah', 'MR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3803, 235, 'Al Mahwit', 'MW', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3804, 235, 'Sa''dah', 'SD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3805, 235, 'San''a', 'SN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3806, 235, 'Shabwah', 'SH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3807, 235, 'Ta''izz', 'TA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3812, 237, 'Bas-Congo', 'BC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3813, 237, 'Bandundu', 'BN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3814, 237, 'Equateur', 'EQ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3815, 237, 'Katanga', 'KA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3816, 237, 'Kasai-Oriental', 'KE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3817, 237, 'Kinshasa', 'KN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3818, 237, 'Kasai-Occidental', 'KW', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3819, 237, 'Maniema', 'MA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3820, 237, 'Nord-Kivu', 'NK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3821, 237, 'Orientale', 'OR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3822, 237, 'Sud-Kivu', 'SK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3823, 238, 'Central', 'CE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3824, 238, 'Copperbelt', 'CB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3825, 238, 'Eastern', 'EA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3826, 238, 'Luapula', 'LP', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3827, 238, 'Lusaka', 'LK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3828, 238, 'Northern', 'NO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3829, 238, 'North-Western', 'NW', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3830, 238, 'Southern', 'SO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3831, 238, 'Western', 'WE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3832, 239, 'Bulawayo', 'BU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3833, 239, 'Harare', 'HA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3834, 239, 'Manicaland', 'ML', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3835, 239, 'Mashonaland Central', 'MC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3836, 239, 'Mashonaland East', 'ME', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3837, 239, 'Mashonaland West', 'MW', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3838, 239, 'Masvingo', 'MV', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3839, 239, 'Matabeleland North', 'MN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3840, 239, 'Matabeleland South', 'MS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3841, 239, 'Midlands', 'MD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3842, 105, 'Agrigento', 'AG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3843, 105, 'Alessandria', 'AL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3844, 105, 'Ancona', 'AN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3845, 105, 'Aosta', 'AO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3846, 105, 'Arezzo', 'AR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3847, 105, 'Ascoli Piceno', 'AP', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3848, 105, 'Asti', 'AT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3849, 105, 'Avellino', 'AV', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3850, 105, 'Bari', 'BA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3851, 105, 'Belluno', 'BL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3852, 105, 'Benevento', 'BN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3853, 105, 'Bergamo', 'BG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3854, 105, 'Biella', 'BI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3855, 105, 'Bologna', 'BO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3856, 105, 'Bolzano', 'BZ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3857, 105, 'Brescia', 'BS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3858, 105, 'Brindisi', 'BR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3859, 105, 'Cagliari', 'CA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3860, 105, 'Caltanissetta', 'CL', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3861, 105, 'Campobasso', 'CB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3862, 105, 'Carbonia-Iglesias', 'CI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3863, 105, 'Caserta', 'CE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3864, 105, 'Catania', 'CT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3865, 105, 'Catanzaro', 'CZ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3866, 105, 'Chieti', 'CH', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3867, 105, 'Como', 'CO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3868, 105, 'Cosenza', 'CS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3869, 105, 'Cremona', 'CR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3870, 105, 'Crotone', 'KR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3871, 105, 'Cuneo', 'CN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3872, 105, 'Enna', 'EN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3873, 105, 'Ferrara', 'FE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3874, 105, 'Firenze', 'FI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3875, 105, 'Foggia', 'FG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3876, 105, 'Forli-Cesena', 'FC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3877, 105, 'Frosinone', 'FR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3878, 105, 'Genova', 'GE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3879, 105, 'Gorizia', 'GO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3880, 105, 'Grosseto', 'GR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3881, 105, 'Imperia', 'IM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3882, 105, 'Isernia', 'IS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3883, 105, 'L&#39;Aquila', 'AQ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3884, 105, 'La Spezia', 'SP', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3885, 105, 'Latina', 'LT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3886, 105, 'Lecce', 'LE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3887, 105, 'Lecco', 'LC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3888, 105, 'Livorno', 'LI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3889, 105, 'Lodi', 'LO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3890, 105, 'Lucca', 'LU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3891, 105, 'Macerata', 'MC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3892, 105, 'Mantova', 'MN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3893, 105, 'Massa-Carrara', 'MS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3894, 105, 'Matera', 'MT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3895, 105, 'Medio Campidano', 'VS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3896, 105, 'Messina', 'ME', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3897, 105, 'Milano', 'MI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3898, 105, 'Modena', 'MO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3899, 105, 'Napoli', 'NA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3900, 105, 'Novara', 'NO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3901, 105, 'Nuoro', 'NU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3902, 105, 'Ogliastra', 'OG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3903, 105, 'Olbia-Tempio', 'OT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3904, 105, 'Oristano', 'OR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3905, 105, 'Padova', 'PD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3906, 105, 'Palermo', 'PA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3907, 105, 'Parma', 'PR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3908, 105, 'Pavia', 'PV', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3909, 105, 'Perugia', 'PG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3910, 105, 'Pesaro e Urbino', 'PU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3911, 105, 'Pescara', 'PE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3912, 105, 'Piacenza', 'PC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3913, 105, 'Pisa', 'PI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3914, 105, 'Pistoia', 'PT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3915, 105, 'Pordenone', 'PN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3916, 105, 'Potenza', 'PZ', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3917, 105, 'Prato', 'PO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3918, 105, 'Ragusa', 'RG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3919, 105, 'Ravenna', 'RA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3920, 105, 'Reggio Calabria', 'RC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3921, 105, 'Reggio Emilia', 'RE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3922, 105, 'Rieti', 'RI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3923, 105, 'Rimini', 'RN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3924, 105, 'Roma', 'RM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3925, 105, 'Rovigo', 'RO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3926, 105, 'Salerno', 'SA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3927, 105, 'Sassari', 'SS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3928, 105, 'Savona', 'SV', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3929, 105, 'Siena', 'SI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3930, 105, 'Siracusa', 'SR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3931, 105, 'Sondrio', 'SO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3932, 105, 'Taranto', 'TA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3933, 105, 'Teramo', 'TE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3934, 105, 'Terni', 'TR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3935, 105, 'Torino', 'TO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3936, 105, 'Trapani', 'TP', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3937, 105, 'Trento', 'TN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3938, 105, 'Treviso', 'TV', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3939, 105, 'Trieste', 'TS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3940, 105, 'Udine', 'UD', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3941, 105, 'Varese', 'VA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3942, 105, 'Venezia', 'VE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3943, 105, 'Verbano-Cusio-Ossola', 'VB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3944, 105, 'Vercelli', 'VC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3945, 105, 'Verona', 'VR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3946, 105, 'Vibo Valentia', 'VV', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3947, 105, 'Vicenza', 'VI', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3948, 105, 'Viterbo', 'VT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3949, 222, 'County Antrim', 'ANT', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3950, 222, 'County Armagh', 'ARM', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3951, 222, 'County Down', 'DOW', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3952, 222, 'County Fermanagh', 'FER', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3953, 222, 'County Londonderry', 'LDY', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3954, 222, 'County Tyrone', 'TYR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3955, 222, 'Cumbria', 'CMA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3956, 190, 'Pomurska', '1', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3957, 190, 'Podravska', '2', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3958, 190, 'Koroška', '3', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3959, 190, 'Savinjska', '4', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3960, 190, 'Zasavska', '5', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3961, 190, 'Spodnjeposavska', '6', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3962, 190, 'Jugovzhodna Slovenija', '7', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3963, 190, 'Osrednjeslovenska', '8', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3964, 190, 'Gorenjska', '9', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3965, 190, 'Notranjsko-kraška', '10', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3966, 190, 'Goriška', '11', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3967, 190, 'Obalno-kraška', '12', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3968, 33, 'Ruse', '', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3969, 101, 'Alborz', 'ALB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3970, 21, 'Brussels-Capital Region', 'BRU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3971, 138, 'Aguascalientes', 'AG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3973, 242, 'Andrijevica', '01', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3974, 242, 'Bar', '02', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3975, 242, 'Berane', '03', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3976, 242, 'Bijelo Polje', '04', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3977, 242, 'Budva', '05', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3978, 242, 'Cetinje', '06', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3979, 242, 'Danilovgrad', '07', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3980, 242, 'Herceg-Novi', '08', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3981, 242, 'Kolašin', '09', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3982, 242, 'Kotor', '10', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3983, 242, 'Mojkovac', '11', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3984, 242, 'Nikšić', '12', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3985, 242, 'Plav', '13', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3986, 242, 'Pljevlja', '14', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3987, 242, 'Plužine', '15', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3988, 242, 'Podgorica', '16', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3989, 242, 'Rožaje', '17', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3990, 242, 'Šavnik', '18', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3991, 242, 'Tivat', '19', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3992, 242, 'Ulcinj', '20', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3993, 242, 'Žabljak', '21', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3994, 243, 'Belgrade', '00', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3995, 243, 'North Bačka', '01', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3996, 243, 'Central Banat', '02', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3997, 243, 'North Banat', '03', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3998, 243, 'South Banat', '04', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(3999, 243, 'West Bačka', '05', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4000, 243, 'South Bačka', '06', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4001, 243, 'Srem', '07', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4002, 243, 'Mačva', '08', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4003, 243, 'Kolubara', '09', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4004, 243, 'Podunavlje', '10', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4005, 243, 'Braničevo', '11', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4006, 243, 'Šumadija', '12', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4007, 243, 'Pomoravlje', '13', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4008, 243, 'Bor', '14', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4009, 243, 'Zaječar', '15', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4010, 243, 'Zlatibor', '16', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4011, 243, 'Moravica', '17', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4012, 243, 'Raška', '18', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4013, 243, 'Rasina', '19', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4014, 243, 'Nišava', '20', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4015, 243, 'Toplica', '21', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4016, 243, 'Pirot', '22', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4017, 243, 'Jablanica', '23', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4018, 243, 'Pčinja', '24', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4020, 245, 'Bonaire', 'BO', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4021, 245, 'Saba', 'SA', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4022, 245, 'Sint Eustatius', 'SE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4023, 248, 'Central Equatoria', 'EC', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4024, 248, 'Eastern Equatoria', 'EE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4025, 248, 'Jonglei', 'JG', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4026, 248, 'Lakes', 'LK', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4027, 248, 'Northern Bahr el-Ghazal', 'BN', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4028, 248, 'Unity', 'UY', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4029, 248, 'Upper Nile', 'NU', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4030, 248, 'Warrap', 'WR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4031, 248, 'Western Bahr el-Ghazal', 'BW', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4032, 248, 'Western Equatoria', 'EW', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4035, 129, 'Putrajaya', 'MY-16', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4036, 117, 'Ainaži, Salacgrīvas novads', '0661405', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4037, 117, 'Aizkraukle, Aizkraukles novads', '0320201', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4038, 117, 'Aizkraukles novads', '0320200', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4039, 117, 'Aizpute, Aizputes novads', '0640605', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4040, 117, 'Aizputes novads', '0640600', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4041, 117, 'Aknīste, Aknīstes novads', '0560805', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4042, 117, 'Aknīstes novads', '0560800', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4043, 117, 'Aloja, Alojas novads', '0661007', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4044, 117, 'Alojas novads', '0661000', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4045, 117, 'Alsungas novads', '0624200', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4046, 117, 'Alūksne, Alūksnes novads', '0360201', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4047, 117, 'Alūksnes novads', '0360200', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4048, 117, 'Amatas novads', '0424701', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4049, 117, 'Ape, Apes novads', '0360805', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4050, 117, 'Apes novads', '0360800', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4051, 117, 'Auce, Auces novads', '0460805', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4052, 117, 'Auces novads', '0460800', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4053, 117, 'Ādažu novads', '0804400', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4054, 117, 'Babītes novads', '0804900', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4055, 117, 'Baldone, Baldones novads', '0800605', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4056, 117, 'Baldones novads', '0800600', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4057, 117, 'Baloži, Ķekavas novads', '0800807', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4058, 117, 'Baltinavas novads', '0384400', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4059, 117, 'Balvi, Balvu novads', '0380201', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4060, 117, 'Balvu novads', '0380200', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4061, 117, 'Bauska, Bauskas novads', '0400201', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4062, 117, 'Bauskas novads', '0400200', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4063, 117, 'Beverīnas novads', '0964700', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4064, 117, 'Brocēni, Brocēnu novads', '0840605', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4065, 117, 'Brocēnu novads', '0840601', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4066, 117, 'Burtnieku novads', '0967101', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4067, 117, 'Carnikavas novads', '0805200', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4068, 117, 'Cesvaine, Cesvaines novads', '0700807', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4069, 117, 'Cesvaines novads', '0700800', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4070, 117, 'Cēsis, Cēsu novads', '0420201', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4071, 117, 'Cēsu novads', '0420200', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4072, 117, 'Ciblas novads', '0684901', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0);
INSERT INTO `state` (`state_id`, `country_id`, `state_name`, `state_code`, `date_added`, `added_by`, `date_modified`, `modified_by`, `status`, `is_deleted`) VALUES
(4073, 117, 'Dagda, Dagdas novads', '0601009', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4074, 117, 'Dagdas novads', '0601000', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4075, 117, 'Daugavpils', '0050000', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4076, 117, 'Daugavpils novads', '0440200', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4077, 117, 'Dobele, Dobeles novads', '0460201', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4078, 117, 'Dobeles novads', '0460200', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4079, 117, 'Dundagas novads', '0885100', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4080, 117, 'Durbe, Durbes novads', '0640807', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4081, 117, 'Durbes novads', '0640801', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4082, 117, 'Engures novads', '0905100', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4083, 117, 'Ērgļu novads', '0705500', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4084, 117, 'Garkalnes novads', '0806000', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4085, 117, 'Grobiņa, Grobiņas novads', '0641009', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4086, 117, 'Grobiņas novads', '0641000', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4087, 117, 'Gulbene, Gulbenes novads', '0500201', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4088, 117, 'Gulbenes novads', '0500200', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4089, 117, 'Iecavas novads', '0406400', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4090, 117, 'Ikšķile, Ikšķiles novads', '0740605', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4091, 117, 'Ikšķiles novads', '0740600', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4092, 117, 'Ilūkste, Ilūkstes novads', '0440807', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4093, 117, 'Ilūkstes novads', '0440801', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4094, 117, 'Inčukalna novads', '0801800', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4095, 117, 'Jaunjelgava, Jaunjelgavas novads', '0321007', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4096, 117, 'Jaunjelgavas novads', '0321000', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4097, 117, 'Jaunpiebalgas novads', '0425700', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4098, 117, 'Jaunpils novads', '0905700', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4099, 117, 'Jelgava', '0090000', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4100, 117, 'Jelgavas novads', '0540200', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4101, 117, 'Jēkabpils', '0110000', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4102, 117, 'Jēkabpils novads', '0560200', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4103, 117, 'Jūrmala', '0130000', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4104, 117, 'Kalnciems, Jelgavas novads', '0540211', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4105, 117, 'Kandava, Kandavas novads', '0901211', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4106, 117, 'Kandavas novads', '0901201', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4107, 117, 'Kārsava, Kārsavas novads', '0681009', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4108, 117, 'Kārsavas novads', '0681000', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4109, 117, 'Kocēnu novads ,bij. Valmieras)', '0960200', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4110, 117, 'Kokneses novads', '0326100', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4111, 117, 'Krāslava, Krāslavas novads', '0600201', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4112, 117, 'Krāslavas novads', '0600202', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4113, 117, 'Krimuldas novads', '0806900', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4114, 117, 'Krustpils novads', '0566900', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4115, 117, 'Kuldīga, Kuldīgas novads', '0620201', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4116, 117, 'Kuldīgas novads', '0620200', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4117, 117, 'Ķeguma novads', '0741001', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4118, 117, 'Ķegums, Ķeguma novads', '0741009', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4119, 117, 'Ķekavas novads', '0800800', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4120, 117, 'Lielvārde, Lielvārdes novads', '0741413', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4121, 117, 'Lielvārdes novads', '0741401', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4122, 117, 'Liepāja', '0170000', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4123, 117, 'Limbaži, Limbažu novads', '0660201', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4124, 117, 'Limbažu novads', '0660200', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4125, 117, 'Līgatne, Līgatnes novads', '0421211', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4126, 117, 'Līgatnes novads', '0421200', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4127, 117, 'Līvāni, Līvānu novads', '0761211', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4128, 117, 'Līvānu novads', '0761201', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4129, 117, 'Lubāna, Lubānas novads', '0701413', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4130, 117, 'Lubānas novads', '0701400', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4131, 117, 'Ludza, Ludzas novads', '0680201', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4132, 117, 'Ludzas novads', '0680200', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4133, 117, 'Madona, Madonas novads', '0700201', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4134, 117, 'Madonas novads', '0700200', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4135, 117, 'Mazsalaca, Mazsalacas novads', '0961011', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4136, 117, 'Mazsalacas novads', '0961000', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4137, 117, 'Mālpils novads', '0807400', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4138, 117, 'Mārupes novads', '0807600', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4139, 117, 'Mērsraga novads', '0887600', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4140, 117, 'Naukšēnu novads', '0967300', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4141, 117, 'Neretas novads', '0327100', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4142, 117, 'Nīcas novads', '0647900', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4143, 117, 'Ogre, Ogres novads', '0740201', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4144, 117, 'Ogres novads', '0740202', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4145, 117, 'Olaine, Olaines novads', '0801009', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4146, 117, 'Olaines novads', '0801000', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4147, 117, 'Ozolnieku novads', '0546701', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4148, 117, 'Pārgaujas novads', '0427500', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4149, 117, 'Pāvilosta, Pāvilostas novads', '0641413', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4150, 117, 'Pāvilostas novads', '0641401', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4151, 117, 'Piltene, Ventspils novads', '0980213', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4152, 117, 'Pļaviņas, Pļaviņu novads', '0321413', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4153, 117, 'Pļaviņu novads', '0321400', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4154, 117, 'Preiļi, Preiļu novads', '0760201', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4155, 117, 'Preiļu novads', '0760202', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4156, 117, 'Priekule, Priekules novads', '0641615', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4157, 117, 'Priekules novads', '0641600', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4158, 117, 'Priekuļu novads', '0427300', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4159, 117, 'Raunas novads', '0427700', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4160, 117, 'Rēzekne', '0210000', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4161, 117, 'Rēzeknes novads', '0780200', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4162, 117, 'Riebiņu novads', '0766300', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4163, 117, 'Rīga', '0010000', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4164, 117, 'Rojas novads', '0888300', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4165, 117, 'Ropažu novads', '0808400', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4166, 117, 'Rucavas novads', '0648500', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4167, 117, 'Rugāju novads', '0387500', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4168, 117, 'Rundāles novads', '0407700', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4169, 117, 'Rūjiena, Rūjienas novads', '0961615', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4170, 117, 'Rūjienas novads', '0961600', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4171, 117, 'Sabile, Talsu novads', '0880213', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4172, 117, 'Salacgrīva, Salacgrīvas novads', '0661415', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4173, 117, 'Salacgrīvas novads', '0661400', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4174, 117, 'Salas novads', '0568700', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4175, 117, 'Salaspils novads', '0801200', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4176, 117, 'Salaspils, Salaspils novads', '0801211', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4177, 117, 'Saldus novads', '0840200', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4178, 117, 'Saldus, Saldus novads', '0840201', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4179, 117, 'Saulkrasti, Saulkrastu novads', '0801413', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4180, 117, 'Saulkrastu novads', '0801400', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4181, 117, 'Seda, Strenču novads', '0941813', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4182, 117, 'Sējas novads', '0809200', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4183, 117, 'Sigulda, Siguldas novads', '0801615', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4184, 117, 'Siguldas novads', '0801601', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4185, 117, 'Skrīveru novads', '0328200', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4186, 117, 'Skrunda, Skrundas novads', '0621209', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4187, 117, 'Skrundas novads', '0621200', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4188, 117, 'Smiltene, Smiltenes novads', '0941615', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4189, 117, 'Smiltenes novads', '0941600', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4190, 117, 'Staicele, Alojas novads', '0661017', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4191, 117, 'Stende, Talsu novads', '0880215', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4192, 117, 'Stopiņu novads', '0809600', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4193, 117, 'Strenči, Strenču novads', '0941817', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4194, 117, 'Strenču novads', '0941800', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4195, 117, 'Subate, Ilūkstes novads', '0440815', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4196, 117, 'Talsi, Talsu novads', '0880201', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4197, 117, 'Talsu novads', '0880200', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4198, 117, 'Tērvetes novads', '0468900', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4199, 117, 'Tukuma novads', '0900200', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4200, 117, 'Tukums, Tukuma novads', '0900201', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4201, 117, 'Vaiņodes novads', '0649300', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4202, 117, 'Valdemārpils, Talsu novads', '0880217', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4203, 117, 'Valka, Valkas novads', '0940201', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4204, 117, 'Valkas novads', '0940200', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4205, 117, 'Valmiera', '0250000', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4206, 117, 'Vangaži, Inčukalna novads', '0801817', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4207, 117, 'Varakļāni, Varakļānu novads', '0701817', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4208, 117, 'Varakļānu novads', '0701800', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4209, 117, 'Vārkavas novads', '0769101', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4210, 117, 'Vecpiebalgas novads', '0429300', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4211, 117, 'Vecumnieku novads', '0409500', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4212, 117, 'Ventspils', '0270000', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4213, 117, 'Ventspils novads', '0980200', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4214, 117, 'Viesīte, Viesītes novads', '0561815', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4215, 117, 'Viesītes novads', '0561800', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4216, 117, 'Viļaka, Viļakas novads', '0381615', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4217, 117, 'Viļakas novads', '0381600', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4218, 117, 'Viļāni, Viļānu novads', '0781817', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4219, 117, 'Viļānu novads', '0781800', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4220, 117, 'Zilupe, Zilupes novads', '0681817', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4221, 117, 'Zilupes novads', '0681801', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4222, 43, 'Arica y Parinacota', 'AP', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4223, 43, 'Los Rios', 'LR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4224, 220, 'Kharkivs''ka Oblast''', '63', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4225, 118, 'Beirut', 'LB-BR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4226, 118, 'Bekaa', 'LB-BE', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4227, 118, 'Mount Lebanon', 'LB-ML', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4228, 118, 'Nabatieh', 'LB-NB', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4229, 118, 'North', 'LB-NR', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4230, 118, 'South', 'LB-ST', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0),
(4231, 99, 'Telangana', 'TS', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `stock_status`
--

CREATE TABLE IF NOT EXISTS `stock_status` (
  `stock_status_id` int(11) NOT NULL,
  `stock_status_name` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `status` int(1) NOT NULL COMMENT '1=Enabled, 0=Disabled',
  `is_deleted` int(1) NOT NULL COMMENT '1 = softdeleted, 0 = not softdeleted'
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock_status`
--

INSERT INTO `stock_status` (`stock_status_id`, `stock_status_name`, `date_added`, `added_by`, `date_modified`, `modified_by`, `status`, `is_deleted`) VALUES
(21, '2-3 Days', '2016-12-12 08:42:46', 1, '2016-12-12 08:42:46', 1, 0, 0),
(22, 'In Stock', '2016-12-12 08:42:56', 1, '2016-12-12 08:42:56', 1, 0, 0),
(23, 'Out Of Stock', '2016-12-12 08:43:04', 1, '2016-12-12 08:43:04', 1, 0, 0),
(25, 'Pre-Order', '2016-12-12 09:13:25', 1, '2016-12-17 05:54:22', 17, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tax_class`
--

CREATE TABLE IF NOT EXISTS `tax_class` (
  `tax_class_id` int(11) NOT NULL,
  `title` varchar(32) NOT NULL,
  `description` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '1=Enabled, 0=Disabled',
  `is_deleted` int(11) NOT NULL COMMENT '1 = softdeleted, 0 = not softdeleted'
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tax_class`
--

INSERT INTO `tax_class` (`tax_class_id`, `title`, `description`, `date_added`, `added_by`, `date_modified`, `modified_by`, `status`, `is_deleted`) VALUES
(1, 'nct1', 'tcd1', '2016-12-19 11:27:09', 1, '2016-12-26 11:42:41', 1, 0, 0),
(5, 'kct2', 'tcd2', '2016-12-19 12:37:20', 1, '2016-12-26 11:42:31', 1, 0, 0),
(9, 'Testing', 'eco tax', '2016-12-19 01:22:32', 17, '2016-12-31 10:25:54', 17, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tax_rate`
--

CREATE TABLE IF NOT EXISTS `tax_rate` (
  `tax_rate_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(32) NOT NULL,
  `rate` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `type` char(1) NOT NULL,
  `date_added` datetime NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '1=Enabled, 0=Disabled',
  `is_deleted` int(11) NOT NULL COMMENT '1 = softdeleted, 0 = not softdeleted'
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tax_rate`
--

INSERT INTO `tax_rate` (`tax_rate_id`, `country_id`, `name`, `rate`, `type`, `date_added`, `added_by`, `date_modified`, `modified_by`, `status`, `is_deleted`) VALUES
(1, 99, 'Eco Tax (-2.00)', '2.0000', 'P', '2016-12-26 10:20:06', 1, '2016-12-26 10:20:06', 1, 0, 0),
(2, 99, 'VAT (20%)', '20.0000', 'P', '2016-12-19 12:42:50', 1, '2016-12-19 12:42:50', 1, 0, 0),
(11, 1, 'Testing', '5.4000', 'F', '2016-12-19 01:23:15', 17, '2016-12-19 01:23:15', 17, 0, 1),
(12, 7, 'news', '3.0000', 'P', '2016-12-26 10:22:35', 1, '2016-12-26 10:22:35', 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tax_rule`
--

CREATE TABLE IF NOT EXISTS `tax_rule` (
  `tax_rule_id` int(11) NOT NULL,
  `tax_class_id` int(11) NOT NULL,
  `tax_rate_id` int(11) NOT NULL,
  `based` varchar(10) NOT NULL,
  `priority` int(5) NOT NULL DEFAULT '1',
  `date_added` datetime NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '1=Enabled, 0=Disabled',
  `is_deleted` int(11) NOT NULL COMMENT '1 = softdeleted, 0 = not softdeleted'
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tax_rule`
--

INSERT INTO `tax_rule` (`tax_rule_id`, `tax_class_id`, `tax_rate_id`, `based`, `priority`, `date_added`, `added_by`, `date_modified`, `modified_by`, `status`, `is_deleted`) VALUES
(7, 2, 1, 'shipping', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(8, 2, 2, 'payment', 2, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(11, 3, 1, 'payment', 11, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(12, 3, 2, 'shipping', 55, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(17, 4, 2, 'payment', 2, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(18, 4, 1, 'shipping', 5, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(62, 5, 1, 'shipping', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(63, 5, 2, 'payment', 2, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(64, 1, 1, 'shipping', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(65, 9, 1, 'shipping', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0),
(66, 9, 2, 'shipping', 2, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE IF NOT EXISTS `ticket` (
  `ticket_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `ticket_code` varchar(255) NOT NULL,
  `priority` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `attachments` text NOT NULL,
  `is_read` int(1) NOT NULL,
  `status` int(1) NOT NULL COMMENT '1=Open, 2=Pending,3=Close',
  `date_added` datetime NOT NULL,
  `added_by` int(11) NOT NULL,
  `added_by_role_id` int(11) NOT NULL,
  `date_modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_by_role_id` int(11) NOT NULL,
  `is_deleted` int(1) NOT NULL COMMENT '1 = softdeleted, 0 = not softdeleted'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`ticket_id`, `department_id`, `customer_id`, `title`, `ticket_code`, `priority`, `description`, `attachments`, `is_read`, `status`, `date_added`, `added_by`, `added_by_role_id`, `date_modified`, `modified_by`, `modified_by_role_id`, `is_deleted`) VALUES
(1, 6, 25, 'manufacturer ticket1', '20171', 'High', 'Testing manufacturer ticket1', 'd2b0b28504104d1e8d0ea20154b37798.png', 0, 2, '2017-01-10 09:57:55', 25, 6, '0000-00-00 00:00:00', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ticket_reply`
--

CREATE TABLE IF NOT EXISTS `ticket_reply` (
  `ticket_reply_id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `attachments` text NOT NULL,
  `is_read` int(1) NOT NULL,
  `date_added` datetime NOT NULL,
  `added_by` int(11) NOT NULL,
  `added_by_role_id` int(11) NOT NULL,
  `date_modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `status` int(1) NOT NULL COMMENT '1=Enabled, 0=Disabled',
  `is_deleted` int(1) NOT NULL COMMENT '1 = softdeleted, 0 = not softdeleted'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `url_alias`
--

CREATE TABLE IF NOT EXISTS `url_alias` (
  `url_alias_id` int(11) NOT NULL,
  `query` varchar(255) NOT NULL,
  `keyword` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=263 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `url_alias`
--

INSERT INTO `url_alias` (`url_alias_id`, `query`, `keyword`) VALUES
(32, 'category_id=63', 'Mobile-Accessories'),
(34, 'category_id=65', 'Lenovo'),
(35, 'category_id=66', 'Mi'),
(36, 'category_id=67', 'Motorola'),
(37, 'category_id=68', 'LeEco'),
(38, 'category_id=69', 'Apple'),
(39, 'category_id=70', 'Asus'),
(40, 'category_id=71', 'Micromax'),
(41, 'category_id=72', 'Mobile-Cases'),
(42, 'category_id=73', 'Headphones-Headsets'),
(43, 'category_id=74', 'Power-Banks'),
(44, 'category_id=75', 'Screenguards'),
(45, 'category_id=76', 'Memory-Cards'),
(46, 'category_id=77', 'On-the-go-pendrives'),
(47, 'category_id=78', 'Cables'),
(48, 'category_id=79', 'Chargers'),
(49, 'category_id=80', 'Selfie-Sticks'),
(55, 'category_id=82', 'Smart-Watches'),
(56, 'category_id=83', 'Smart-Glasses'),
(57, 'category_id=84', 'Smart-Bands'),
(58, 'category_id=81', 'Wearables'),
(59, 'category_id=85', 'New-and-Popular-Models'),
(60, 'category_id=86', 'lenovo-power'),
(61, 'category_id=87', 'Moto-M'),
(62, 'category_id=88', 'Panasonic-P'),
(63, 'category_id=89', 'Computer-Accessories'),
(64, 'category_id=90', 'External-Hard-Disks'),
(65, 'category_id=91', 'Pendrives'),
(66, 'category_id=92', 'Laptop-Bags'),
(67, 'category_id=93', 'Mouse'),
(68, 'category_id=94', 'Keyboards'),
(69, 'category_id=95', 'Computer-Peripherals'),
(70, 'category_id=96', 'Printers-Ink-Cartridges'),
(71, 'category_id=97', 'Monitors'),
(72, 'category_id=98', 'Network-Components'),
(73, 'category_id=99', 'Routers'),
(74, 'category_id=100', 'Data-Cards'),
(75, 'category_id=101', 'Home-Entertainment'),
(76, 'category_id=102', 'iPods-MP-Players'),
(77, 'category_id=103', 'Home-Theatres'),
(78, 'category_id=104', 'Speakers'),
(79, 'category_id=105', 'Camera'),
(80, 'category_id=106', 'DSLR'),
(81, 'category_id=107', 'Point-Shoot'),
(82, 'category_id=108', 'Sports-and-Lifestyle-Cameras'),
(83, 'category_id=109', 'Camera-Accessories'),
(84, 'category_id=110', 'Memory-Cardss'),
(85, 'category_id=111', 'Tablets'),
(87, 'category_id=112', 'TV'),
(88, 'category_id=113', 'LAPTOPS'),
(89, 'category_id=114', 'FK-Exclusive-Mobiles'),
(106, 'category_id=115', 'aapliances-Tvs'),
(115, 'category_id=64', 'Samsung'),
(174, 'product_id=40', 'BLUE-CHIFFON-EMBROIDERY-DESIGNER-SAREESSSSSSSSS'),
(175, 'product_id=39', 'BLUE-CHIFFON-EMBROIDERY-DESIGNER-SAREESSSSSSSS'),
(177, 'product_id=37', 'BLUE-CHIFFON-EMBROIDERY-DESIGNER-SAREESSSSSS'),
(178, 'product_id=35', 'BLUE-CHIFFON-EMBROIDERY-DESIGNER-SAREESSSSS'),
(179, 'product_id=47', 'BLUE-CHIFFON-EMBROIDERY-DESIGNER-SAREESSSS'),
(197, 'category_id=55', 'Mobile'),
(199, 'product_id=38', 'BLUE-CHIFFON-EMBROIDERY-DESIGNER-SAREESSSSSSS'),
(200, 'product_id=46', 'BLUE-CHIFFON-EMBROIDERY-DESIGNER-SAREESSS'),
(201, 'category_id=116', 'Electronics'),
(202, 'category_id=57', 'Appliances'),
(203, 'category_id=58', 'Men'),
(204, 'category_id=59', 'Women'),
(205, 'category_id=60', 'Baby-Kids'),
(206, 'category_id=62', 'Books-More'),
(207, 'category_id=61', 'Home-Furniture'),
(210, 'product_id=32', 'aaaaa-bbbbb'),
(211, 'product_id=31', 'aaa--bbbb'),
(212, 'product_id=44', 'saree'),
(213, 'product_id=43', 'BLUE-CHIFFON-EMBROIDERY-DESIGNER-SAREESSSSSSSSSSSSSSS'),
(214, 'product_id=42', 'BLUE-CHIFFON-EMBROIDERY-DESIGNER-SAREESSSSSSSSSSSSS'),
(215, 'product_id=41', 'BLUE-CHIFFON-EMBROIDERY-DESIGNER-SAREESSSSSSSSSS'),
(216, 'product_id=33', 'aa-bb'),
(219, 'information_id=16', 'shipping'),
(220, 'information_id=17', 'return'),
(221, 'information_id=18', 'privacy-policy'),
(222, 'information_id=19', 'delivery-information'),
(224, 'information_id=21', 'payment'),
(225, 'information_id=22', 'faq'),
(229, 'product_id=48', 'Green-dress'),
(235, 'product_id=45', 'BLUE-CHIFFON-EMBROIDERY-DESIGNER-SAREESS'),
(244, 'information_id=20', 'about-us'),
(248, 'category_id=126', 'Catalogs'),
(250, 'category_id=127', 'dress'),
(251, 'category_id=128', 'bollyhood'),
(259, 'product_id=34', 'SAMSUNG-Galaxy-JSEVEN'),
(260, 'product_id=36', 'BLUE-CHIFFON-EMBROIDERY-DESIGNER-SAREES'),
(262, 'product_id=115', 'sadadddadd');

-- --------------------------------------------------------

--
-- Table structure for table `voucher`
--

CREATE TABLE IF NOT EXISTS `voucher` (
  `voucher_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `from_name` varchar(255) NOT NULL,
  `from_email` varchar(255) NOT NULL,
  `to_name` varchar(255) NOT NULL,
  `to_email` varchar(255) NOT NULL,
  `voucher_theme_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `amount` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `status` int(1) NOT NULL COMMENT '1=Enabled, 0=Disabled',
  `is_deleted` int(1) NOT NULL COMMENT '1 = softdeleted, 0 = not softdeleted'
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `voucher`
--

INSERT INTO `voucher` (`voucher_id`, `order_id`, `code`, `from_name`, `from_email`, `to_name`, `to_email`, `voucher_theme_id`, `message`, `amount`, `date_added`, `added_by`, `date_modified`, `modified_by`, `status`, `is_deleted`) VALUES
(7, 0, 'SRAPO', 'chirag', 'ck@vpninfotech.com', 'Sandip', 'ss@vpninfotech.com', 10, 'for your bday gift', '500', '2016-12-12 09:47:34', 1, '0000-00-00 00:00:00', 0, 1, 0),
(8, 0, 'AUD', 'chirag', 'ck@vpninfotech.com', 'Sandip', 'ss@vpninfotech.com', 10, 'helo', '10', '2016-12-12 11:16:38', 1, '2016-12-20 10:49:47', 1, 1, 0),
(9, 0, 'INR', 'karan', 'karan@karan.com', 'arjun', 'arjun@vpninfotech.com', 10, 'arjun', '20', '2016-12-12 11:17:29', 1, '0000-00-00 00:00:00', 0, 1, 0),
(10, 0, 'CNY', 'nax', 'ss@vpninfotech.com', 'nax', 'ss@vpninfotech.com', 10, 'nax', '50', '2016-12-12 11:18:06', 1, '2016-12-20 10:49:28', 1, 0, 0),
(12, 0, 'new test', 'new test', 'ss@vpninfotech.com', 'new test', 'ss@vpninfotech.com', 13, 'Christmas', '200', '2016-12-17 04:08:09', 23, '0000-00-00 00:00:00', 0, 1, 0),
(13, 5, 'tDYNwvlCOo', 'Indrajit', 'ik@vpninfotech.com', 'Indrajit', 'ik@vpninfotech.com', 10, 'HBD', '100', '2016-12-28 23:43:42', 0, '0000-00-00 00:00:00', 0, 0, 0),
(14, 5, 'Pl5LIo7lrS', 'Indrajit', 'ik@vpninfotech.com', 'Indrajit', 'ik@vpninfotech.com', 10, 'HBD', '100', '2016-12-29 03:15:38', 0, '0000-00-00 00:00:00', 0, 0, 0),
(15, 0, '123', 'sandip', 'ss@vpninfotech.com', 'chirag', 'ss@vpninfotech.com', 10, 'hello this is gift vochar', '1500', '2016-12-31 04:37:59', 17, '0000-00-00 00:00:00', 0, 1, 0),
(16, 11, 'QraFFiB1FD', 'sandip', 'ss@vpninfotech.com', 'chirag', 'ss@vpninfotech.com', 10, 'yfuyuyu', '4', '2016-12-30 21:48:11', 0, '0000-00-00 00:00:00', 0, 0, 0),
(17, 31, 'EWuGaxLTdz', 'Vinay Ghael', 'vr@vpninfotech.com', 'Umesh Makwana', 'umesh@gmail.com', 12, 'Happy Makarsankranti', '100', '2017-01-11 22:32:23', 0, '0000-00-00 00:00:00', 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `voucher_history`
--

CREATE TABLE IF NOT EXISTS `voucher_history` (
  `voucher_history_id` int(11) NOT NULL,
  `voucher_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `voucher_history_date_added` datetime NOT NULL,
  `voucher_history_added_by` int(11) NOT NULL,
  `voucher_history_date_modified` datetime NOT NULL,
  `voucher_history_modified_by` int(11) NOT NULL,
  `voucher_history_status` int(1) NOT NULL,
  `is_deleted` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `voucher_theme`
--

CREATE TABLE IF NOT EXISTS `voucher_theme` (
  `voucher_theme_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `status` int(1) NOT NULL COMMENT '1=Enabled, 0=Disabled',
  `is_deleted` int(1) NOT NULL COMMENT '1 = softdeleted, 0 = not softdeleted'
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `voucher_theme`
--

INSERT INTO `voucher_theme` (`voucher_theme_id`, `name`, `image`, `date_added`, `added_by`, `date_modified`, `modified_by`, `status`, `is_deleted`) VALUES
(10, 'Birthday', 'catalog/gift-voucher-birthday.jpg', '2016-12-12 09:42:40', 1, '0000-00-00 00:00:00', 0, 0, 0),
(12, 'General', 'catalog/fine-art-finger-paintings-by-iris-scott-2.jpg', '2016-12-12 09:44:33', 1, '0000-00-00 00:00:00', 0, 0, 0),
(13, 'Christmas', 'catalog/1024x735.jpg', '2016-12-17 04:03:24', 1, '0000-00-00 00:00:00', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `weight`
--

CREATE TABLE IF NOT EXISTS `weight` (
  `weight_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `value` decimal(15,8) NOT NULL,
  `date_added` datetime NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1' COMMENT '1=Enabled, 0=Disabled',
  `is_deleted` int(1) NOT NULL DEFAULT '0' COMMENT '1 = softdeleted, 0 = not softdeleted'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `weight`
--

INSERT INTO `weight` (`weight_id`, `title`, `unit`, `value`, `date_added`, `added_by`, `date_modified`, `modified_by`, `status`, `is_deleted`) VALUES
(1, 'Gram', 'gm', '1000.00000000', '2017-01-13 07:26:10', 1, '2017-01-13 07:26:10', 1, 1, 0),
(2, 'Kilogram', 'kg', '1.00000000', '2017-01-13 07:26:33', 1, '2017-01-13 07:26:33', 1, 1, 0),
(3, 'Ounce', 'oz', '35.27400000', '2017-01-13 07:26:58', 1, '2017-01-13 07:26:58', 1, 1, 0),
(4, 'Pound', 'lb', '2.20460000', '2017-01-13 07:27:18', 1, '2017-01-13 07:27:18', 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE IF NOT EXISTS `wishlist` (
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `wishlist_date_added` datetime NOT NULL,
  `wishlist_added_by` int(11) NOT NULL,
  `is_deleted` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`address_id`);

--
-- Indexes for table `admin_user`
--
ALTER TABLE `admin_user`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `attribute`
--
ALTER TABLE `attribute`
  ADD PRIMARY KEY (`attribute_id`);

--
-- Indexes for table `attribute_group`
--
ALTER TABLE `attribute_group`
  ADD PRIMARY KEY (`attribute_group_id`);

--
-- Indexes for table `bank_list`
--
ALTER TABLE `bank_list`
  ADD PRIMARY KEY (`bank_id`);

--
-- Indexes for table `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`banner_id`);

--
-- Indexes for table `banner_image`
--
ALTER TABLE `banner_image`
  ADD PRIMARY KEY (`banner_image_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `category_filter`
--
ALTER TABLE `category_filter`
  ADD PRIMARY KEY (`category_id`,`filter_id`);

--
-- Indexes for table `category_path`
--
ALTER TABLE `category_path`
  ADD PRIMARY KEY (`category_id`,`path_id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `coupon`
--
ALTER TABLE `coupon`
  ADD PRIMARY KEY (`coupon_id`);

--
-- Indexes for table `coupon_history`
--
ALTER TABLE `coupon_history`
  ADD PRIMARY KEY (`coupon_history_id`);

--
-- Indexes for table `coupon_product`
--
ALTER TABLE `coupon_product`
  ADD PRIMARY KEY (`coupon_product_id`);

--
-- Indexes for table `currency`
--
ALTER TABLE `currency`
  ADD PRIMARY KEY (`currency_id`);

--
-- Indexes for table `currency_country`
--
ALTER TABLE `currency_country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `customer_group`
--
ALTER TABLE `customer_group`
  ADD PRIMARY KEY (`customer_group_id`);

--
-- Indexes for table `customer_wishlist`
--
ALTER TABLE `customer_wishlist`
  ADD PRIMARY KEY (`customer_id`,`product_id`);

--
-- Indexes for table `download`
--
ALTER TABLE `download`
  ADD PRIMARY KEY (`download_id`);

--
-- Indexes for table `email_template`
--
ALTER TABLE `email_template`
  ADD PRIMARY KEY (`template_id`);

--
-- Indexes for table `expense`
--
ALTER TABLE `expense`
  ADD PRIMARY KEY (`expense_id`);

--
-- Indexes for table `expense_category`
--
ALTER TABLE `expense_category`
  ADD PRIMARY KEY (`expense_category_id`);

--
-- Indexes for table `filter`
--
ALTER TABLE `filter`
  ADD PRIMARY KEY (`filter_id`);

--
-- Indexes for table `filter_group`
--
ALTER TABLE `filter_group`
  ADD PRIMARY KEY (`filter_group_id`);

--
-- Indexes for table `information`
--
ALTER TABLE `information`
  ADD PRIMARY KEY (`information_id`);

--
-- Indexes for table `length`
--
ALTER TABLE `length`
  ADD PRIMARY KEY (`length_id`);

--
-- Indexes for table `manufacturer`
--
ALTER TABLE `manufacturer`
  ADD PRIMARY KEY (`manufacturer_id`);

--
-- Indexes for table `manufacturer_address`
--
ALTER TABLE `manufacturer_address`
  ADD PRIMARY KEY (`manufacturer_address_id`);

--
-- Indexes for table `newsletter`
--
ALTER TABLE `newsletter`
  ADD PRIMARY KEY (`newsletter_id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`notification_id`);

--
-- Indexes for table `option`
--
ALTER TABLE `option`
  ADD PRIMARY KEY (`option_id`);

--
-- Indexes for table `option_value`
--
ALTER TABLE `option_value`
  ADD PRIMARY KEY (`option_value_id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_history`
--
ALTER TABLE `order_history`
  ADD PRIMARY KEY (`order_history_id`);

--
-- Indexes for table `order_option`
--
ALTER TABLE `order_option`
  ADD PRIMARY KEY (`order_option_id`);

--
-- Indexes for table `order_product`
--
ALTER TABLE `order_product`
  ADD PRIMARY KEY (`order_product_id`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`order_status_id`);

--
-- Indexes for table `order_total`
--
ALTER TABLE `order_total`
  ADD PRIMARY KEY (`order_total_id`);

--
-- Indexes for table `order_voucher`
--
ALTER TABLE `order_voucher`
  ADD PRIMARY KEY (`order_voucher_id`);

--
-- Indexes for table `payment_method`
--
ALTER TABLE `payment_method`
  ADD PRIMARY KEY (`payment_method_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_discount`
--
ALTER TABLE `product_discount`
  ADD PRIMARY KEY (`product_discount_id`);

--
-- Indexes for table `product_image`
--
ALTER TABLE `product_image`
  ADD PRIMARY KEY (`product_image_id`);

--
-- Indexes for table `product_option`
--
ALTER TABLE `product_option`
  ADD PRIMARY KEY (`product_option_id`);

--
-- Indexes for table `product_option_value`
--
ALTER TABLE `product_option_value`
  ADD PRIMARY KEY (`product_option_value_id`);

--
-- Indexes for table `product_special`
--
ALTER TABLE `product_special`
  ADD PRIMARY KEY (`product_special_id`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`purchase_id`);

--
-- Indexes for table `purchase_cart`
--
ALTER TABLE `purchase_cart`
  ADD PRIMARY KEY (`purchase_cart_id`);

--
-- Indexes for table `purchase_history`
--
ALTER TABLE `purchase_history`
  ADD PRIMARY KEY (`purchase_history_id`);

--
-- Indexes for table `purchase_option`
--
ALTER TABLE `purchase_option`
  ADD PRIMARY KEY (`purchase_option_id`);

--
-- Indexes for table `purchase_product`
--
ALTER TABLE `purchase_product`
  ADD PRIMARY KEY (`purchase_product_id`);

--
-- Indexes for table `purchase_return`
--
ALTER TABLE `purchase_return`
  ADD PRIMARY KEY (`purchase_return_id`);

--
-- Indexes for table `purchase_return_history`
--
ALTER TABLE `purchase_return_history`
  ADD PRIMARY KEY (`return_history_id`);

--
-- Indexes for table `return`
--
ALTER TABLE `return`
  ADD PRIMARY KEY (`return_id`);

--
-- Indexes for table `return_action`
--
ALTER TABLE `return_action`
  ADD PRIMARY KEY (`return_action_id`);

--
-- Indexes for table `return_history`
--
ALTER TABLE `return_history`
  ADD PRIMARY KEY (`return_history_id`);

--
-- Indexes for table `return_reason`
--
ALTER TABLE `return_reason`
  ADD PRIMARY KEY (`return_reason_id`);

--
-- Indexes for table `return_status`
--
ALTER TABLE `return_status`
  ADD PRIMARY KEY (`return_status_id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`review_id`), ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`config_id`);

--
-- Indexes for table `shipping_method`
--
ALTER TABLE `shipping_method`
  ADD PRIMARY KEY (`shipping_method_id`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`state_id`);

--
-- Indexes for table `stock_status`
--
ALTER TABLE `stock_status`
  ADD PRIMARY KEY (`stock_status_id`);

--
-- Indexes for table `tax_class`
--
ALTER TABLE `tax_class`
  ADD PRIMARY KEY (`tax_class_id`);

--
-- Indexes for table `tax_rate`
--
ALTER TABLE `tax_rate`
  ADD PRIMARY KEY (`tax_rate_id`);

--
-- Indexes for table `tax_rule`
--
ALTER TABLE `tax_rule`
  ADD PRIMARY KEY (`tax_rule_id`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`ticket_id`);

--
-- Indexes for table `ticket_reply`
--
ALTER TABLE `ticket_reply`
  ADD PRIMARY KEY (`ticket_reply_id`);

--
-- Indexes for table `url_alias`
--
ALTER TABLE `url_alias`
  ADD PRIMARY KEY (`url_alias_id`), ADD KEY `query` (`query`), ADD KEY `keyword` (`keyword`);

--
-- Indexes for table `voucher`
--
ALTER TABLE `voucher`
  ADD PRIMARY KEY (`voucher_id`);

--
-- Indexes for table `voucher_history`
--
ALTER TABLE `voucher_history`
  ADD PRIMARY KEY (`voucher_history_id`);

--
-- Indexes for table `voucher_theme`
--
ALTER TABLE `voucher_theme`
  ADD PRIMARY KEY (`voucher_theme_id`);

--
-- Indexes for table `weight`
--
ALTER TABLE `weight`
  ADD PRIMARY KEY (`weight_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT for table `admin_user`
--
ALTER TABLE `admin_user`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `attribute`
--
ALTER TABLE `attribute`
  MODIFY `attribute_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `attribute_group`
--
ALTER TABLE `attribute_group`
  MODIFY `attribute_group_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `bank_list`
--
ALTER TABLE `bank_list`
  MODIFY `bank_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `banner`
--
ALTER TABLE `banner`
  MODIFY `banner_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT for table `banner_image`
--
ALTER TABLE `banner_image`
  MODIFY `banner_image_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=87;
--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=238;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=129;
--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=258;
--
-- AUTO_INCREMENT for table `coupon`
--
ALTER TABLE `coupon`
  MODIFY `coupon_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `coupon_history`
--
ALTER TABLE `coupon_history`
  MODIFY `coupon_history_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `coupon_product`
--
ALTER TABLE `coupon_product`
  MODIFY `coupon_product_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT for table `currency`
--
ALTER TABLE `currency`
  MODIFY `currency_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `currency_country`
--
ALTER TABLE `currency_country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=245;
--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=53;
--
-- AUTO_INCREMENT for table `customer_group`
--
ALTER TABLE `customer_group`
  MODIFY `customer_group_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `download`
--
ALTER TABLE `download`
  MODIFY `download_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=77;
--
-- AUTO_INCREMENT for table `email_template`
--
ALTER TABLE `email_template`
  MODIFY `template_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `expense`
--
ALTER TABLE `expense`
  MODIFY `expense_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `expense_category`
--
ALTER TABLE `expense_category`
  MODIFY `expense_category_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `filter`
--
ALTER TABLE `filter`
  MODIFY `filter_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=161;
--
-- AUTO_INCREMENT for table `filter_group`
--
ALTER TABLE `filter_group`
  MODIFY `filter_group_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `information`
--
ALTER TABLE `information`
  MODIFY `information_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `length`
--
ALTER TABLE `length`
  MODIFY `length_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `manufacturer`
--
ALTER TABLE `manufacturer`
  MODIFY `manufacturer_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `manufacturer_address`
--
ALTER TABLE `manufacturer_address`
  MODIFY `manufacturer_address_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `newsletter`
--
ALTER TABLE `newsletter`
  MODIFY `newsletter_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `option`
--
ALTER TABLE `option`
  MODIFY `option_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `option_value`
--
ALTER TABLE `option_value`
  MODIFY `option_value_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=150;
--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=58;
--
-- AUTO_INCREMENT for table `order_history`
--
ALTER TABLE `order_history`
  MODIFY `order_history_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=102;
--
-- AUTO_INCREMENT for table `order_option`
--
ALTER TABLE `order_option`
  MODIFY `order_option_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=158;
--
-- AUTO_INCREMENT for table `order_product`
--
ALTER TABLE `order_product`
  MODIFY `order_product_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=103;
--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `order_status_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `order_total`
--
ALTER TABLE `order_total`
  MODIFY `order_total_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=256;
--
-- AUTO_INCREMENT for table `order_voucher`
--
ALTER TABLE `order_voucher`
  MODIFY `order_voucher_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `payment_method`
--
ALTER TABLE `payment_method`
  MODIFY `payment_method_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=131;
--
-- AUTO_INCREMENT for table `product_discount`
--
ALTER TABLE `product_discount`
  MODIFY `product_discount_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `product_image`
--
ALTER TABLE `product_image`
  MODIFY `product_image_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=451;
--
-- AUTO_INCREMENT for table `product_option`
--
ALTER TABLE `product_option`
  MODIFY `product_option_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1026;
--
-- AUTO_INCREMENT for table `product_option_value`
--
ALTER TABLE `product_option_value`
  MODIFY `product_option_value_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1208;
--
-- AUTO_INCREMENT for table `product_special`
--
ALTER TABLE `product_special`
  MODIFY `product_special_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=456;
--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `purchase_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `purchase_cart`
--
ALTER TABLE `purchase_cart`
  MODIFY `purchase_cart_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `purchase_history`
--
ALTER TABLE `purchase_history`
  MODIFY `purchase_history_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `purchase_option`
--
ALTER TABLE `purchase_option`
  MODIFY `purchase_option_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=81;
--
-- AUTO_INCREMENT for table `purchase_product`
--
ALTER TABLE `purchase_product`
  MODIFY `purchase_product_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `purchase_return`
--
ALTER TABLE `purchase_return`
  MODIFY `purchase_return_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `purchase_return_history`
--
ALTER TABLE `purchase_return_history`
  MODIFY `return_history_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `return`
--
ALTER TABLE `return`
  MODIFY `return_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `return_action`
--
ALTER TABLE `return_action`
  MODIFY `return_action_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `return_history`
--
ALTER TABLE `return_history`
  MODIFY `return_history_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `return_reason`
--
ALTER TABLE `return_reason`
  MODIFY `return_reason_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `return_status`
--
ALTER TABLE `return_status`
  MODIFY `return_status_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `config_id` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=171;
--
-- AUTO_INCREMENT for table `shipping_method`
--
ALTER TABLE `shipping_method`
  MODIFY `shipping_method_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `state_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4232;
--
-- AUTO_INCREMENT for table `stock_status`
--
ALTER TABLE `stock_status`
  MODIFY `stock_status_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `tax_class`
--
ALTER TABLE `tax_class`
  MODIFY `tax_class_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tax_rate`
--
ALTER TABLE `tax_rate`
  MODIFY `tax_rate_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `tax_rule`
--
ALTER TABLE `tax_rule`
  MODIFY `tax_rule_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=67;
--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ticket_reply`
--
ALTER TABLE `ticket_reply`
  MODIFY `ticket_reply_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `url_alias`
--
ALTER TABLE `url_alias`
  MODIFY `url_alias_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=263;
--
-- AUTO_INCREMENT for table `voucher`
--
ALTER TABLE `voucher`
  MODIFY `voucher_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `voucher_history`
--
ALTER TABLE `voucher_history`
  MODIFY `voucher_history_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `voucher_theme`
--
ALTER TABLE `voucher_theme`
  MODIFY `voucher_theme_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `weight`
--
ALTER TABLE `weight`
  MODIFY `weight_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
