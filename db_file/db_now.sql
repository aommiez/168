-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 23, 2014 at 06:36 AM
-- Server version: 5.5.31
-- PHP Version: 5.3.28

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `papangping_168`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `user`, `password`) VALUES
(1, 'admin', 'ccf4f842a1724a44eb42900471478b95');

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE IF NOT EXISTS `blog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='blog' AUTO_INCREMENT=2 ;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`id`, `author`, `title`, `content`, `created_at`, `updated_at`) VALUES
(1, 'xx', 'aa', '<p>ccccc</p>', '2014-02-15 05:21:11', '2014-02-15 05:21:17');

-- --------------------------------------------------------

--
-- Table structure for table `blog_comment`
--

CREATE TABLE IF NOT EXISTS `blog_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `obj_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `display` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `name`, `content`, `display`) VALUES
(1, 'ทัวร์ในประเทศ', '', 1),
(2, 'ทัวร์ต่างประเทศ', '', 1),
(3, 'Destination', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `menu_lv2`
--

CREATE TABLE IF NOT EXISTS `menu_lv2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `display` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `menu_lv2`
--

INSERT INTO `menu_lv2` (`id`, `menu_id`, `name`, `content`, `display`) VALUES
(1, 1, 'เชียงใหม่', '<p>ดกฟหดกฟหด</p>', 1),
(2, 1, 'เชียงราย', '', 1),
(3, 1, 'แม่ฮ่องสอน', '', 1),
(4, 2, 'ออสเตรีเลีย', '<p>test</p>', 1),
(5, 2, 'เกาหลี', '', 1),
(6, 2, 'ญี่ปุ่น', '', 1),
(7, 2, 'จีน', '', 1),
(8, 2, 'ฮ่องกง', '', 1),
(9, 3, 'Chiang Mai', '', 1),
(10, 3, 'Chiang Rai', '', 1),
(11, 3, 'Mae Hong Sorn', '', 1),
(12, 3, 'Bangkok & Central Thailand', '', 1),
(13, 3, 'Mae Hong Sorn', '', 1),
(14, 3, 'Bangkok & Central Thailand', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `promotion`
--

CREATE TABLE IF NOT EXISTS `promotion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `picture` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `tags` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `is_main` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `promotion`
--

INSERT INTO `promotion` (`id`, `title`, `description`, `content`, `picture`, `color`, `tags`, `created_at`, `updated_at`, `is_main`) VALUES
(6, 'test', 'dfsfsv', '<p>sdvsdvds</p>', '', '#FF4500', 'เชียงใหม่,ร้านอาหาร', '2014-02-19 04:26:27', '2014-02-20 05:12:15', 0),
(7, 'กกกกก', 'dvsadvsavads', '<p>vdsavads</p>', '', '#FF4500', '', '2014-02-20 04:49:21', '2014-02-20 05:36:33', 0),
(8, 'sdavsavdv', 'ดหฟฟดกดห', '<p>asdvasdsa</p>', '', '#008B8B', 'ร้านอาหาร', '2014-02-20 04:49:41', '2014-02-20 05:12:54', 0),
(10, 'dss', 'dcvvds', '<p>avs</p>', '', '#CD5C5C', '', '2014-02-20 05:10:54', '2014-02-20 05:10:54', 0),
(11, 'tessfd', 'vsdvdv', '<p>taswsdfsdafadvs</p>', '', '#CD5C5C', '', '2014-02-20 05:20:05', '2014-02-20 05:20:05', 0),
(12, 'test 6', 'dvsvsd', '<p>vsdvdv</p>', '', '#008B8B', 'เชียงใหม่', '2014-02-20 05:29:17', '2014-02-20 05:29:17', 0),
(13, 'test', 'svasvdsa', '<p>vasvdsvsvdv</p>', '', '#CD5C5C', '', '2014-03-23 07:21:25', '2014-03-23 07:21:25', 1),
(14, 'vsdv', 'asdsas', '<p>vdv</p>', '', '#CD5C5C', '', '2014-03-23 07:21:42', '2014-03-23 07:21:42', 1),
(15, 'dvsdsv', 'dsvdsv', '<p>adsvdasvadsv</p>', 'pic_532e7d805181c.', '#CD5C5C', '', '2014-03-23 07:21:52', '2014-03-23 07:22:01', 1);

-- --------------------------------------------------------

--
-- Table structure for table `promotion_comment`
--

CREATE TABLE IF NOT EXISTS `promotion_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `obj_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `promotion_comment`
--

INSERT INTO `promotion_comment` (`id`, `name`, `message`, `obj_id`) VALUES
(3, 'admin', 'ทดสอบครับ\r\n\r\nนะๆๆ', 12);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `pro_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`, `pro_id`) VALUES
(17, 'เชียงใหม่', 6),
(18, 'ร้านอาหาร', 6),
(20, 'ร้านอาหาร', 8),
(24, 'เชียงใหม่', 6),
(25, 'ร้านอาหาร', 6),
(26, 'ร้านอาหาร', 8),
(27, 'ร้านอาหาร', 8),
(30, 'เชียงใหม่', 12);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
