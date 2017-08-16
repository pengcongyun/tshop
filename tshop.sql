/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : tshop

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2017-08-16 17:56:10
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` char(20) NOT NULL,
  `password` varchar(64) NOT NULL,
  `last_login_time` int(11) DEFAULT NULL,
  `last_login_ip` varchar(30) DEFAULT NULL,
  `salt` char(5) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `thumb` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES ('1', 'admin', '53d6b398e9ee18c20df4cc799c9b458e', '1502863670', '127.0.0.1', 'YNyKH', null, null);

-- ----------------------------
-- Table structure for admin_role
-- ----------------------------
DROP TABLE IF EXISTS `admin_role`;
CREATE TABLE `admin_role` (
  `admin_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin_role
-- ----------------------------
INSERT INTO `admin_role` VALUES ('1', '1');

-- ----------------------------
-- Table structure for category
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `cid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `catename` char(20) NOT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES ('1', '手机');
INSERT INTO `category` VALUES ('2', '衣服');
INSERT INTO `category` VALUES ('3', '家电');

-- ----------------------------
-- Table structure for good
-- ----------------------------
DROP TABLE IF EXISTS `good`;
CREATE TABLE `good` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(20) NOT NULL,
  `category_id` int(11) NOT NULL,
  `sex` int(3) NOT NULL DEFAULT '1',
  `hobby` int(10) DEFAULT NULL,
  `pic` varchar(255) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of good
-- ----------------------------
INSERT INTO `good` VALUES ('5', '18945454545', '1', '1', null, null, '<p>想</p>');
INSERT INTO `good` VALUES ('2', 'xxx', '2', '1', null, null, 'ff');
INSERT INTO `good` VALUES ('3', 'x', '2', '2', null, null, 'fjdsal');

-- ----------------------------
-- Table structure for permission
-- ----------------------------
DROP TABLE IF EXISTS `permission`;
CREATE TABLE `permission` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `lft` int(255) DEFAULT NULL,
  `rgt` int(255) DEFAULT NULL,
  `level` varchar(255) DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of permission
-- ----------------------------
INSERT INTO `permission` VALUES ('1', '0', '后台首页', '1', '2', '1', 'Admin/Index/index');
INSERT INTO `permission` VALUES ('2', '0', '各种测试', '29', '38', '1', '');
INSERT INTO `permission` VALUES ('3', '2', '倒计时js', '30', '31', '2', 'Admin/Test/countdown');
INSERT INTO `permission` VALUES ('8', '5', '管理员列表', '20', '27', '2', 'Admin/Admin/index');
INSERT INTO `permission` VALUES ('5', '0', '权限管理', '3', '28', '1', '');
INSERT INTO `permission` VALUES ('6', '5', '权限列表', '4', '11', '2', 'Admin/Permission/index');
INSERT INTO `permission` VALUES ('7', '5', '角色列表', '12', '19', '2', 'Admin/Role/index');
INSERT INTO `permission` VALUES ('9', '8', '添加管理员', '21', '22', '3', 'Admin/Admin/add');
INSERT INTO `permission` VALUES ('10', '8', '修改管理员', '23', '24', '3', 'Admin/Admin/edit');
INSERT INTO `permission` VALUES ('11', '8', '删除管理员', '25', '26', '3', 'Admin/Admin/delete');
INSERT INTO `permission` VALUES ('12', '7', '添加角色', '13', '14', '3', 'Admin/Role/add');
INSERT INTO `permission` VALUES ('13', '7', '修改角色', '15', '16', '3', 'Admin/Role/edit');
INSERT INTO `permission` VALUES ('14', '7', '删除角色', '17', '18', '3', 'Admin/Role/delete');
INSERT INTO `permission` VALUES ('15', '6', '添加权限', '5', '6', '3', 'Admin/Permission/add');
INSERT INTO `permission` VALUES ('16', '6', '修改权限', '7', '8', '3', 'Admin/Permission/edit');
INSERT INTO `permission` VALUES ('17', '6', '删除权限', '9', '10', '3', 'Admin/Permission/delete');
INSERT INTO `permission` VALUES ('18', '2', '腾讯视频', '34', '35', '2', 'Admin/Test/video');
INSERT INTO `permission` VALUES ('19', '2', '多图片上传', '36', '37', '2', 'Admin/Test/morepic');
INSERT INTO `permission` VALUES ('20', '0', '商品管理', '39', '48', '1', '');
INSERT INTO `permission` VALUES ('21', '20', '商品列表', '40', '47', '2', 'Admin/Good/index');
INSERT INTO `permission` VALUES ('22', '21', '添加商品', '41', '42', '3', 'Admin/Good/add');
INSERT INTO `permission` VALUES ('23', '21', '修改商品', '43', '44', '3', 'Admin/Good/update');
INSERT INTO `permission` VALUES ('24', '21', '删除商品', '45', '46', '3', 'Admin/Good/delete');
INSERT INTO `permission` VALUES ('25', '0', '图片上传ajax', '49', '50', '1', 'Admin/Upload/upload');

-- ----------------------------
-- Table structure for role
-- ----------------------------
DROP TABLE IF EXISTS `role`;
CREATE TABLE `role` (
  `role_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `intro` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of role
-- ----------------------------
INSERT INTO `role` VALUES ('1', '超级管理员', '所有权限');
INSERT INTO `role` VALUES ('2', '普通管理员', '视情况而定');

-- ----------------------------
-- Table structure for role_permission
-- ----------------------------
DROP TABLE IF EXISTS `role_permission`;
CREATE TABLE `role_permission` (
  `role_id` int(10) DEFAULT NULL,
  `permission_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of role_permission
-- ----------------------------
INSERT INTO `role_permission` VALUES ('1', '24');
INSERT INTO `role_permission` VALUES ('1', '23');
INSERT INTO `role_permission` VALUES ('1', '22');
INSERT INTO `role_permission` VALUES ('1', '21');
INSERT INTO `role_permission` VALUES ('1', '20');
INSERT INTO `role_permission` VALUES ('1', '19');
INSERT INTO `role_permission` VALUES ('1', '18');
INSERT INTO `role_permission` VALUES ('1', '3');
INSERT INTO `role_permission` VALUES ('1', '2');
INSERT INTO `role_permission` VALUES ('1', '11');
INSERT INTO `role_permission` VALUES ('1', '10');
INSERT INTO `role_permission` VALUES ('1', '9');
INSERT INTO `role_permission` VALUES ('1', '8');
INSERT INTO `role_permission` VALUES ('1', '14');
INSERT INTO `role_permission` VALUES ('1', '13');
INSERT INTO `role_permission` VALUES ('1', '12');
INSERT INTO `role_permission` VALUES ('1', '7');
INSERT INTO `role_permission` VALUES ('1', '17');
INSERT INTO `role_permission` VALUES ('1', '16');
INSERT INTO `role_permission` VALUES ('1', '15');
INSERT INTO `role_permission` VALUES ('1', '6');
INSERT INTO `role_permission` VALUES ('1', '5');
INSERT INTO `role_permission` VALUES ('1', '1');
INSERT INTO `role_permission` VALUES ('1', '25');
