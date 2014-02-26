-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 26, 2014 at 06:43 AM
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `blog_comment`
--

INSERT INTO `blog_comment` (`id`, `name`, `message`, `obj_id`) VALUES
(3, 'กแหกแกห', 'หแแกหแหแฟ\r\nแหฟ\r\nแ\r\nฟห\r\n', 1),
(4, 'ฟหอฟหอ', 'อฟอหกอ', 1);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `name`, `content`) VALUES
(1, 'ทัวร์ในประเทศ', ''),
(2, 'ทัวร์ต่างประเทศ', ''),
(3, 'Destination', '');

-- --------------------------------------------------------

--
-- Table structure for table `menu_lv2`
--

CREATE TABLE IF NOT EXISTS `menu_lv2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `menu_lv2`
--

INSERT INTO `menu_lv2` (`id`, `menu_id`, `name`, `content`) VALUES
(1, 1, 'เชียงใหม่', '<p>ดกฟหดกฟหด</p>'),
(2, 1, 'เชียงราย', ''),
(3, 1, 'แม่ฮ่องสอน', ''),
(4, 2, 'ออสเตรีเลีย', '<p>test</p>'),
(5, 2, 'เกาหลี', ''),
(6, 2, 'ญี่ปุ่น', ''),
(7, 2, 'จีน', ''),
(8, 2, 'ฮ่องกง', ''),
(9, 3, 'Chiang Mai', ''),
(10, 3, 'Chiang Rai', ''),
(11, 3, 'Mae Hong Sorn', ''),
(12, 3, 'Bangkok & Central Thailand', ''),
(13, 3, 'Mae Hong Sorn', ''),
(14, 3, 'Bangkok & Central Thailand', '');

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `promotion`
--

INSERT INTO `promotion` (`id`, `title`, `description`, `content`, `picture`, `color`, `tags`, `created_at`, `updated_at`) VALUES
(6, 'test', 'dfsfsv', '<p>sdvsdvds</p>', '', '#FF4500', 'เชียงใหม่,ร้านอาหาร', '2014-02-19 04:26:27', '2014-02-20 05:12:15'),
(7, 'กกกกก', 'dvsadvsavads', '<p>vdsavads</p>', '', '#FF4500', '', '2014-02-20 04:49:21', '2014-02-20 05:36:33'),
(8, 'sdavsavdv', 'ดหฟฟดกดห', '<p>asdvasdsa</p>', '', '#008B8B', 'ร้านอาหาร', '2014-02-20 04:49:41', '2014-02-20 05:12:54'),
(10, 'dss', 'dcvvds', '<p>avs</p>', '', '#CD5C5C', '', '2014-02-20 05:10:54', '2014-02-20 05:10:54'),
(11, 'tessfd', 'vsdvdv', '<p>taswsdfsdafadvs</p>', '', '#CD5C5C', '', '2014-02-20 05:20:05', '2014-02-20 05:20:05'),
(12, 'test 6', 'dvsvsd', '<p>vsdvdv</p>', '', '#008B8B', 'เชียงใหม่', '2014-02-20 05:29:17', '2014-02-20 05:29:17');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

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
