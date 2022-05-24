/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : wh_now

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2022-03-28 00:54:42
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for category
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES ('1', 'visit  page');
INSERT INTO `category` VALUES ('2', 'search page');
INSERT INTO `category` VALUES ('3', 'add page');

-- ----------------------------
-- Table structure for task_details
-- ----------------------------
DROP TABLE IF EXISTS `task_details`;
CREATE TABLE `task_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT '',
  `category` varchar(255) DEFAULT '',
  `description` varchar(255) DEFAULT NULL,
  `attachment_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of task_details
-- ----------------------------
INSERT INTO `task_details` VALUES ('1', 'DS_123', 'test category', 'describe test 123', 'uploads/attachment/DS_123.');
INSERT INTO `task_details` VALUES ('2', 'DS_123', 'test category', 'describe test 123', '');
INSERT INTO `task_details` VALUES ('3', 'DS_123', 'test category', 'describe test 123', '');
INSERT INTO `task_details` VALUES ('4', 'DS_123', 'test category', 'describe test 123', '');
INSERT INTO `task_details` VALUES ('5', 'DS_123', 'test category', 'describe test 123', 'attachment/prep_actual_1234 (1).pdf');
INSERT INTO `task_details` VALUES ('6', 'DS_Pittie Consumer Private Limited123', 'test213', '38u3o4e', 'attachment/Invoice_Data (7).xls');
INSERT INTO `task_details` VALUES ('7', 'DS_123455', 'test12ou33o', '456789ipo', 'http://localhost:8082/wh_no_2//attachment/0.xls');
INSERT INTO `task_details` VALUES ('8', 'DS_123', '1', 'describe test 123', 'http://localhost:8082/wh_no_2//attachment/1.exe');
INSERT INTO `task_details` VALUES ('9', 'DS_Pittie Consumer Private Limited123', '3', 'describe test 123', 'http://localhost:8082/wh_no_2//attachment/1.php');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` bigint(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', '9533751479', 'prameela');
