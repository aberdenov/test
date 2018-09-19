/*
 Navicat Premium Data Transfer

 Source Server         : aida.trainspotting.kz
 Source Server Type    : MySQL
 Source Server Version : 50560
 Source Host           : srv-pleskdb17.ps.kz
 Source Database       : sidelkag_aida

 Target Server Type    : MySQL
 Target Server Version : 50560
 File Encoding         : utf-8

 Date: 09/19/2018 17:49:31 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `goods`
-- ----------------------------
DROP TABLE IF EXISTS `goods`;
CREATE TABLE `goods` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `goods`
-- ----------------------------
BEGIN;
INSERT INTO `goods` VALUES ('1', 'Мобильный телефон'), ('2', 'Планшет'), ('3', 'Наушники'), ('4', 'Ноутбук'), ('5', 'Зарядное устройство');
COMMIT;

-- ----------------------------
--  Table structure for `log`
-- ----------------------------
DROP TABLE IF EXISTS `log`;
CREATE TABLE `log` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `type` int(10) NOT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `log`
-- ----------------------------
BEGIN;
INSERT INTO `log` VALUES ('1', '1', '2', '3'), ('2', '1', '0', '1398'), ('3', '1', '0', '100'), ('4', '1', '0', '1000'), ('5', '1', '0', '1000'), ('6', '1', '0', '1000'), ('7', '1', '0', '1000'), ('8', '1', '0', '1000'), ('9', '1', '0', '1000'), ('10', '1', '0', '1000'), ('11', '1', '0', '1000'), ('12', '1', '0', '1000'), ('13', '1', '0', '1000'), ('14', '1', '0', '1000'), ('15', '1', '0', '1000'), ('16', '1', '0', '1000'), ('17', '1', '0', '1000'), ('18', '1', '0', '1000'), ('19', '1', '0', '1000'), ('20', '1', '0', '1000'), ('21', '1', '0', '1000'), ('22', '1', '0', '1000'), ('23', '1', '0', '1000'), ('24', '1', '0', '1000'), ('25', '1', '0', '1000'), ('26', '1', '0', '1000'), ('27', '1', '0', '1000'), ('28', '1', '0', '1000'), ('29', '1', '0', '1000'), ('30', '1', '0', '1000'), ('31', '1', '0', '1000'), ('32', '1', '0', '1000'), ('33', '1', '0', '1000'), ('34', '1', '0', '1000'), ('35', '1', '0', '1000'), ('36', '1', '0', '1000'), ('37', '1', '2', '4');
COMMIT;

-- ----------------------------
--  Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(20) NOT NULL DEFAULT '',
  `password` varchar(50) NOT NULL DEFAULT '',
  `ip` int(11) NOT NULL DEFAULT '0',
  `active` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
--  Records of `users`
-- ----------------------------
BEGIN;
INSERT INTO `users` VALUES ('1', 'admin', 'f279337511b3b4ada0e11db3099f253a', '0', '1');
COMMIT;

