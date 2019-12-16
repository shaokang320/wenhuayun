/*
 Navicat Premium Data Transfer

 Source Server         : 线上数据
 Source Server Type    : MySQL
 Source Server Version : 50726
 Source Host           : 39.106.7.85:3306
 Source Schema         : wing

 Target Server Type    : MySQL
 Target Server Version : 50726
 File Encoding         : 65001

 Date: 16/12/2019 09:42:23
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for wing_admin
-- ----------------------------
DROP TABLE IF EXISTS `wing_admin`;
CREATE TABLE `wing_admin`  (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_username` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '用户名',
  `admin_password` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '密码',
  `admin_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '管理员姓名',
  `createTime` datetime(0) NULL DEFAULT NULL,
  `updateTime` datetime(0) NULL DEFAULT NULL,
  `delFlg` tinyint(1) NULL DEFAULT 0 COMMENT '删除标志位 0:未删除 1:已删除',
  PRIMARY KEY (`admin_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of wing_admin
-- ----------------------------
INSERT INTO `wing_admin` VALUES (1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', '超级管理员', '2019-06-14 14:27:20', '2019-06-14 14:27:25', 0);

-- ----------------------------
-- Table structure for wing_culture
-- ----------------------------
DROP TABLE IF EXISTS `wing_culture`;
CREATE TABLE `wing_culture`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '标题',
  `enterprise_id` int(11) NULL DEFAULT NULL COMMENT '企业id',
  `image` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '缩略图',
  `rotation` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '轮播',
  `video_path` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '视频地址',
  `body` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '文字介绍',
  `qrCode` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '二维码连接',
  `status` tinyint(1) NULL DEFAULT 0 COMMENT '状态 0 正常 1 禁用',
  `createTime` datetime(0) NULL DEFAULT NULL,
  `updateTime` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of wing_culture
-- ----------------------------
INSERT INTO `wing_culture` VALUES (1, '青岛新高度信息科技', 1, 'uploads/enterprise/wenhua/2019/12/20191206/wenhua_1575598301_RCgQEQoUnd.png', NULL, '/aetherupload/file/201912/fe2e31c7210bd82298e455641a9a7372.mp4', '青岛新高度信息科技有限公司以“整合升级”为服务核心\r\n以“力挺新鲜”为实践信仰\r\n专注软件开发，提供精准全面的平台解决方案,独家定制，只为你\r\n案不在多有“鲜”则名，意不在深有“心”则灵，我们只用效果说话，精益求精\r\n期待您加入和我们深入交流', '/uploads/enterprise/wenhua/qrcode/2019/12/20191206/20191206021141qrcode.jpg', 0, '2019-12-06 02:11:41', '2019-12-06 02:11:41');
INSERT INTO `wing_culture` VALUES (2, '植秀堂企业文化', 1, 'uploads/enterprise/wenhua/2019/12/20191206/wenhua_1575598612_MmoGaVRlcK.png', NULL, '/aetherupload/file/201912/ca5c45a4ae9e341e3a5c9919bdcd9eee.mp4', '植物秀（面）——古代宫廷御医使用名贵中草药独特配方，为后宫佳丽改善肤质及白肤的一种方式，其敷面物质为“植物秀八白散”，缘自明代《必用全书》著名的宫女敷面粉“金国宫女八百散”。据古书记载：此方通血脉、益色泽、白人肌体，卅日光彩照人，夫妻不相识。\r\n原理\r\n植物秀面是将不健康的肌肤，通过通血活络手法及“植物秀八白散”敷面，利用膏药温敷原理，即循序渐进的提取与分解体内毒素的过程，使女性气血调和、活血化瘀使肌肤真正达至标本兼治、肤如凝脂的健康状态。\r\n效果\r\n植物秀面一周期15次25天，遵循女性生理的新陈代谢规律，使皮肤在短短时间内，达至白皙、红润、有光泽、有弹性的健康状态。\r\n秀面1-2次皮肤光滑、细腻；3-5次排汗通畅、色斑减轻，皮肤变白；6-10次内分泌调和，血色正常，部分色斑减退；仅15次的时间就可以使皮肤变白，变细，各种斑点明显减退。达到自然白皙。肤如凝脂的健康状态。\r\n与普通护肤的不同\r\n护肤——在通常意义上讲是对健康肌肤的一种维护。（通过产品及护理程序给肌肤补充水分与养分，是对皮肤现状的一种维护）\r\n植物秀面——则是将不健康的肌肤通过通血活络排毒手法及使用名贵中草药配方，内调外敷，使其气血调和，血液循环正常，从而彻底改善，使肌肤达至健康状态。', '/uploads/enterprise/wenhua/qrcode/2019/12/20191206/20191206021652qrcode.jpg', 0, '2019-12-06 02:16:52', '2019-12-06 09:00:29');
INSERT INTO `wing_culture` VALUES (3, '1211', 1, 'uploads/enterprise/wenhua/2019/12/20191206/wenhua_1575621934_wxG3XPYB5p.jpg', NULL, '/aetherupload/file/201912/a2573ccb8a7f78839748b20feed50f68.mp4', '打发打发', '/uploads/enterprise/wenhua/qrcode/2019/12/20191206/20191206084534qrcode.jpg', 0, '2019-12-06 08:45:34', '2019-12-06 08:45:34');

-- ----------------------------
-- Table structure for wing_enterprise
-- ----------------------------
DROP TABLE IF EXISTS `wing_enterprise`;
CREATE TABLE `wing_enterprise`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '企业名称',
  `accounts` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '登录帐号',
  `password` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '登录密码',
  `end_time` datetime(0) NULL DEFAULT NULL COMMENT '帐号使用期限 截至日期',
  `status` tinyint(1) NULL DEFAULT 0 COMMENT '帐号使用状态 默认0正常 1 禁用',
  `mobile` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '企业电话',
  `longitude` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '经度',
  `latitude` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '纬度',
  `qrCode` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '二维码',
  `address` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `createTime` datetime(0) NULL DEFAULT NULL,
  `updateTime` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of wing_enterprise
-- ----------------------------
INSERT INTO `wing_enterprise` VALUES (1, '植秀堂', '13021666711', 'e10adc3949ba59abbe56e057f20f883e', '2019-12-31 00:00:00', 0, '13021666711', '120.412690', '36.069730', '/uploads/enterprise/qrcode/2019/11/20191129/20191129092329.png', '山东省青岛市市南区龙岩路1甲', '2019-11-29 09:23:29', '2019-11-30 02:45:37');

SET FOREIGN_KEY_CHECKS = 1;
