/*
 Navicat MySQL Data Transfer

 Source Server         : Local
 Source Server Type    : MySQL
 Source Server Version : 50638
 Source Host           : localhost:3306
 Source Schema         : dealer-sites

 Target Server Type    : MySQL
 Target Server Version : 50638
 File Encoding         : 65001

 Date: 29/09/2020 00:11:45
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for user_access
-- ----------------------------
DROP TABLE IF EXISTS `user_access`;
CREATE TABLE `user_access` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `user_access_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_access
-- ----------------------------
BEGIN;
INSERT INTO `user_access` VALUES (3, 1, '2020-09-29 00:02:18');
INSERT INTO `user_access` VALUES (4, 1, '2020-09-29 00:03:55');
INSERT INTO `user_access` VALUES (5, 1, '2020-09-29 00:07:25');
INSERT INTO `user_access` VALUES (6, 1, '2020-09-29 00:07:38');
INSERT INTO `user_access` VALUES (7, 1, '2020-09-29 00:10:59');
COMMIT;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(300) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `numero_logins` int(11) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  `tokenLogado` varchar(250) DEFAULT NULL,
  `active` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users
-- ----------------------------
BEGIN;
INSERT INTO `users` VALUES (1, 'José', 'jose@josew.com.br', 3, 'e10adc3949ba59abbe56e057f20f883e', '', 1);
INSERT INTO `users` VALUES (2, 'Dealer Sites', 'contato@dealersites.com.br', NULL, 'e10adc3949ba59abbe56e057f20f883e', NULL, 1);
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
