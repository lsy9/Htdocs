/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50711
Source Host           : localhost:3306
Source Database       : bbs

Target Server Type    : MYSQL
Target Server Version : 50711
File Encoding         : 65001

Date: 2016-12-08 18:05:09
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for config
-- ----------------------------
DROP TABLE IF EXISTS `config`;
CREATE TABLE `config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `webname` varchar(255) NOT NULL,
  `keywords` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `copy` varchar(255) NOT NULL DEFAULT 'default.jpg',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of config
-- ----------------------------
INSERT INTO `config` VALUES ('1', '兄弟连', 'PHP HTML h5', '201606211446374042.jpg', '2008 - 2017 LAMP兄弟', '0');

-- ----------------------------
-- Table structure for friendlink
-- ----------------------------
DROP TABLE IF EXISTS `friendlink`;
CREATE TABLE `friendlink` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `linkname` varchar(255) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `content` text,
  `logo` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `linkname` (`linkname`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of friendlink
-- ----------------------------
INSERT INTO `friendlink` VALUES ('6', '百度', 'www.baidu.com', null, '201606211447089081.png');
INSERT INTO `friendlink` VALUES ('5', 'QQ', 'www.qq.com', null, '201606210015133622.png');

-- ----------------------------
-- Table structure for post
-- ----------------------------
DROP TABLE IF EXISTS `post`;
CREATE TABLE `post` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `tid` int(11) NOT NULL,
  `title` char(255) NOT NULL,
  `content` text NOT NULL,
  `ctime` int(11) NOT NULL,
  `count` int(11) DEFAULT '0',
  `elite` enum('0','1') DEFAULT '0',
  `top` enum('0','1') DEFAULT '0',
  `recycle` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of post
-- ----------------------------
INSERT INTO `post` VALUES ('1', '1', '2', '老司机带带我', '滴  学生卡', '1466473191', '0', '0', '0', '1');
INSERT INTO `post` VALUES ('2', '1', '21', '23', '232', '1466474404', '0', '0', '0', '1');
INSERT INTO `post` VALUES ('3', '4', '2', '其实我是拒绝的', 'QAQ', '1466475744', '0', '0', '0', '0');
INSERT INTO `post` VALUES ('4', '4', '2', 'orz', 'zzzzz~', '1466475926', '0', '0', '0', '0');
INSERT INTO `post` VALUES ('5', '4', '2', '43', '43', '1466476246', '0', '0', '0', '0');
INSERT INTO `post` VALUES ('6', '5', '2', '32', '32', '1466480163', '0', '0', '0', '0');
INSERT INTO `post` VALUES ('7', '6', '2', 'qaq', 'zzzzzzzzzzzz', '1466480512', '0', '0', '0', '0');
INSERT INTO `post` VALUES ('8', '7', '2', 'dff', 'dffdfd', '1466485672', '0', '0', '0', '0');
INSERT INTO `post` VALUES ('9', '11', '29', '111', '111', '1466491303', '0', '0', '0', '0');
INSERT INTO `post` VALUES ('10', '11', '29', '22', '222', '1466491309', '0', '0', '0', '0');
INSERT INTO `post` VALUES ('14', '11', '30', '33', '33', '1466491391', '0', '1', '1', '0');
INSERT INTO `post` VALUES ('15', '1', '2', '哈哈哈哈', '1212\r\newwew', '1476431860', '0', '0', '0', '0');

-- ----------------------------
-- Table structure for reply
-- ----------------------------
DROP TABLE IF EXISTS `reply`;
CREATE TABLE `reply` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `content` text NOT NULL,
  `ctime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of reply
-- ----------------------------
INSERT INTO `reply` VALUES ('1', '4', '1', '121', '1466475696');
INSERT INTO `reply` VALUES ('2', '4', '1', 'QAQ', '1466475874');
INSERT INTO `reply` VALUES ('3', '5', '3', ' = = 666', '1466485440');
INSERT INTO `reply` VALUES ('4', '7', '1', 'ffdf', '1466485637');
INSERT INTO `reply` VALUES ('5', '11', '14', 'zzz', '1466491473');

-- ----------------------------
-- Table structure for type
-- ----------------------------
DROP TABLE IF EXISTS `type`;
CREATE TABLE `type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(20) NOT NULL,
  `status` enum('0','1') DEFAULT '1',
  `pid` int(11) NOT NULL DEFAULT '0',
  `path` varchar(255) NOT NULL DEFAULT '0',
  `blogo` varchar(255) NOT NULL DEFAULT 'default.jpg',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of type
-- ----------------------------
INSERT INTO `type` VALUES ('1', '技术交流', '1', '0', '0', 'default.jpg');
INSERT INTO `type` VALUES ('2', 'PHP技术交流', '1', '1', '0-1', '201606180009578001.png');
INSERT INTO `type` VALUES ('7', 'Java/Android技术交流', '1', '1', '0-1', '201606180018441691.png');
INSERT INTO `type` VALUES ('11', '前端(HTML5)技术', '1', '1', '0-1', '201606191918586864.png');
INSERT INTO `type` VALUES ('12', '服务器与Linux技术', '1', '1', '0-1', '201606191919324510.png');
INSERT INTO `type` VALUES ('13', 'SQL与数据库', '1', '1', '0-1', '201606191920089336.png');
INSERT INTO `type` VALUES ('14', '资源分享', '1', '1', '0-1', '201606191920354080.png');
INSERT INTO `type` VALUES ('15', '兄弟连', '1', '0', '0', 'default.jpg');
INSERT INTO `type` VALUES ('16', '视频教程/在线课', '1', '15', '0-15', '201606191921336562.png');
INSERT INTO `type` VALUES ('17', '培训课程', '1', '15', '0-15', '201606191921558252.png');
INSERT INTO `type` VALUES ('18', '兄弟会', '1', '15', '0-15', '201606191922097818.png');
INSERT INTO `type` VALUES ('19', '战地日记', '1', '15', '0-15', '201606191922343718.png');
INSERT INTO `type` VALUES ('20', '兄弟连小电影', '1', '15', '0-15', '201606191922525572.png');
INSERT INTO `type` VALUES ('21', '《细说PHP》', '1', '15', '0-15', '201606191923346669.png');
INSERT INTO `type` VALUES ('22', '连队趣事', '1', '0', '0', 'default.jpg');
INSERT INTO `type` VALUES ('23', '招聘求职', '1', '22', '0-22', '201606191924192320.png');
INSERT INTO `type` VALUES ('24', '吹水圣地', '1', '22', '0-22', '201606191924545502.png');
INSERT INTO `type` VALUES ('28', '测试', '1', '0', '0', 'default.jpg');
INSERT INTO `type` VALUES ('30', '测试1', '1', '28', '0-28', '201606211442525119.png');
INSERT INTO `type` VALUES ('32', 'asdf', '1', '28', '0-{$fid}', '../../public/uploads/201612081149079242.jpg');
INSERT INTO `type` VALUES ('33', 'xc', '1', '28', '0-{$fid}', '201612081150422034.jpg');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userName` char(20) NOT NULL,
  `password` char(33) NOT NULL,
  `auth` enum('0','1') NOT NULL DEFAULT '0',
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `lastlogin` int(11) DEFAULT NULL,
  `points` int(10) unsigned NOT NULL DEFAULT '50',
  PRIMARY KEY (`id`),
  UNIQUE KEY `userName` (`userName`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'liuben', 'c4ca4238a0b923820dcc509a6f75849b', '0', '1', '1481161985', '185');
INSERT INTO `user` VALUES ('2', 'guxin', 'c4ca4238a0b923820dcc509a6f75849b', '1', '0', '1466485892', '36');
INSERT INTO `user` VALUES ('3', 'anxin', '202cb962ac59075b964b07152d234b70', '1', '1', '1466402762', '41');
INSERT INTO `user` VALUES ('4', 'laosiji', 'c4ca4238a0b923820dcc509a6f75849b', '0', '1', '1466402948', '36');
INSERT INTO `user` VALUES ('5', 'longge', 'c4ca4238a0b923820dcc509a6f75849b', '0', '1', '1466480109', '32');
INSERT INTO `user` VALUES ('6', 'xiaoxiao', 'c4ca4238a0b923820dcc509a6f75849b', '0', '1', '1466480477', '32');
INSERT INTO `user` VALUES ('7', 'yy', '099b3b060154898840f0ebdfb46ec78f', '0', '1', '1466485570', '31');
INSERT INTO `user` VALUES ('8', 'iop', '9fbfb220e03aa76d424088e43314b0d0', '0', '1', '1466489778', '70');
INSERT INTO `user` VALUES ('9', 'ceshi', 'c4ca4238a0b923820dcc509a6f75849b', '0', '1', '1466489856', '60');
INSERT INTO `user` VALUES ('10', 'ceshi1', 'c4ca4238a0b923820dcc509a6f75849b', '0', '1', '1466489947', '70');
INSERT INTO `user` VALUES ('11', 'ceshi10', 'c4ca4238a0b923820dcc509a6f75849b', '0', '1', '1466491082', '70');
INSERT INTO `user` VALUES ('12', 'gou', '202cb962ac59075b964b07152d234b70', '0', '1', '1476426709', '60');
INSERT INTO `user` VALUES ('14', 'wqe', '202cb962ac59075b964b07152d234b70', '0', '1', '1480909714', '50');
INSERT INTO `user` VALUES ('22', 'dcvew', '202cb962ac59075b964b07152d234b70', '0', '1', '1481163468', '50');
INSERT INTO `user` VALUES ('23', 'qwetew', '202cb962ac59075b964b07152d234b70', '0', '1', '1481163542', '50');

-- ----------------------------
-- Table structure for userdetail
-- ----------------------------
DROP TABLE IF EXISTS `userdetail`;
CREATE TABLE `userdetail` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL,
  `nickName` char(50) DEFAULT NULL,
  `email` char(50) DEFAULT NULL,
  `qq` char(15) DEFAULT NULL,
  `sex` enum('w','m') DEFAULT 'm',
  `photo` char(255) NOT NULL DEFAULT 'default.jpg',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of userdetail
-- ----------------------------
INSERT INTO `userdetail` VALUES ('1', '1', '奔跑', '123@qq.com', '11611633115', 'm', '201611080833522575.jpg');
INSERT INTO `userdetail` VALUES ('2', '2', null, '123@qq.com', null, 'm', 'default.jpg');
INSERT INTO `userdetail` VALUES ('3', '3', null, '123@qq.com', null, 'm', 'default.jpg');
INSERT INTO `userdetail` VALUES ('4', '4', null, '123@qq.com', null, 'm', 'default.jpg');
INSERT INTO `userdetail` VALUES ('5', '5', null, null, null, 'm', 'default.jpg');
INSERT INTO `userdetail` VALUES ('6', '6', null, null, null, 'm', 'default.jpg');
INSERT INTO `userdetail` VALUES ('7', '7', 'aa', '123@qq.com', 'qq@', 'm', '201606211308276522.jpg');
INSERT INTO `userdetail` VALUES ('8', '8', null, '123@qq.com', null, 'm', 'default.jpg');
INSERT INTO `userdetail` VALUES ('9', '9', null, '123@qq.com', null, 'm', 'default.jpg');
INSERT INTO `userdetail` VALUES ('10', '10', '121', '123@qq.com', '11611633115', 'm', 'default.jpg');
INSERT INTO `userdetail` VALUES ('11', '11', '刘奔', '123@qq.com', '11611633115', 'm', '201606211438527141.jpg');
INSERT INTO `userdetail` VALUES ('12', '12', '哈哈', '232@qq.com', '123111', 'm', 'default.jpg');
INSERT INTO `userdetail` VALUES ('13', '14', null, '232@qq.com', null, 'm', 'default.jpg');
INSERT INTO `userdetail` VALUES ('18', '22', null, null, null, 'm', 'default.jpg');
INSERT INTO `userdetail` VALUES ('19', '23', null, null, null, 'm', 'default.jpg');
