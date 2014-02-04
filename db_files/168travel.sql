/*
 Navicat MySQL Data Transfer

 Source Server         : localhost
 Source Server Version : 50614
 Source Host           : localhost
 Source Database       : 168travel

 Target Server Version : 50614
 File Encoding         : utf-8

 Date: 02/04/2014 16:05:41 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `admin`
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `admin`
-- ----------------------------
BEGIN;
INSERT INTO `admin` VALUES ('1', 'admin', 'ccf4f842a1724a44eb42900471478b95');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
