/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50611
Source Host           : localhost:3306
Source Database       : somd5

Target Server Type    : MYSQL
Target Server Version : 50611
File Encoding         : 65001

Date: 2014-10-23 16:04:50
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for code
-- ----------------------------
DROP TABLE IF EXISTS `code`;
CREATE TABLE `code` (
  `code` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for scanlog
-- ----------------------------
DROP TABLE IF EXISTS `scanlog`;
CREATE TABLE `scanlog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `word` varchar(255) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `name` varchar(255) DEFAULT NULL,
  `pass` varchar(255) DEFAULT NULL,
  `mail` varchar(255) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
