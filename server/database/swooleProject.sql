/*
Navicat MySQL Data Transfer

Source Server         : local-utf8
Source Server Version : 80000
Source Host           : 172.17.0.2:3306
Source Database       : swooleProject

Target Server Type    : MYSQL
Target Server Version : 80000
File Encoding         : 65001

Date: 2017-02-06 16:09:00
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `userId` int(10) NOT NULL AUTO_INCREMENT,
  `userName` varchar(50) NOT NULL,
  `account` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `email` varchar(50) NOT NULL,
  `loginTime` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `createTime` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
SET FOREIGN_KEY_CHECKS=1;
