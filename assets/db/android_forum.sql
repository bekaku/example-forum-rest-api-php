/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50539
 Source Host           : 127.0.0.1:3306
 Source Schema         : android_forum

 Target Server Type    : MySQL
 Target Server Version : 50539
 File Encoding         : 65001

 Date: 18/12/2020 15:09:10
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for post
-- ----------------------------
DROP TABLE IF EXISTS `post`;
CREATE TABLE `post`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `created` datetime NULL DEFAULT NULL,
  `threads_id` int(11) NOT NULL,
  `user_account_id` int(11) NOT NULL,
  PRIMARY KEY (`id`, `threads_id`, `user_account_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of post
-- ----------------------------
INSERT INTO `post` VALUES (4, 'update post by id', '2018-10-03 14:34:30', 2, 1);
INSERT INTO `post` VALUES (5, 'test post to thread again and again', '2018-10-03 14:35:45', 2, 2);
INSERT INTO `post` VALUES (6, 'test post to thread again and again2222', '2018-10-03 14:36:16', 2, 1);
INSERT INTO `post` VALUES (7, 'kkk', '2018-10-06 16:53:52', 2, 3);
INSERT INTO `post` VALUES (8, 'ff', '2018-10-06 16:53:55', 2, 1);
INSERT INTO `post` VALUES (9, '55', '2018-10-06 16:53:58', 2, 2);
INSERT INTO `post` VALUES (10, 'ddd', '2018-10-06 16:53:59', 2, 1);
INSERT INTO `post` VALUES (11, 'ee', '2018-10-06 16:54:02', 2, 2);
INSERT INTO `post` VALUES (12, 'Test reply', '2020-12-18 13:34:00', 5, 13);
INSERT INTO `post` VALUES (13, 'another reply', '2020-12-18 13:35:07', 5, 13);
INSERT INTO `post` VALUES (14, 'The', '2020-12-18 14:01:44', 5, 13);

-- ----------------------------
-- Table structure for threads
-- ----------------------------
DROP TABLE IF EXISTS `threads`;
CREATE TABLE `threads`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `created` datetime NULL DEFAULT NULL,
  `user_account_id` int(11) NOT NULL,
  PRIMARY KEY (`id`, `user_account_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of threads
-- ----------------------------
INSERT INTO `threads` VALUES (2, 'กระทู้ที่สอง', 'body thread', '2018-10-03 11:50:44', 2);
INSERT INTO `threads` VALUES (3, 'Test update thread by postman', 'update context', '2018-10-03 13:43:03', 1);
INSERT INTO `threads` VALUES (4, 'Edit title 2', 'Edit description 2', '2020-12-18 10:53:20', 13);
INSERT INTO `threads` VALUES (5, 'This is new topic from code', 'this is the detail of this thred', '2020-12-18 10:55:04', 13);

-- ----------------------------
-- Table structure for user_account
-- ----------------------------
DROP TABLE IF EXISTS `user_account`;
CREATE TABLE `user_account`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `hashed_password` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `created` datetime NULL DEFAULT NULL,
  `picture` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of user_account
-- ----------------------------
INSERT INTO `user_account` VALUES (1, 'bekaku', 'd404559f602eab6fd602ac7680dacbfaadd13630335e951f097af3900e9de176b6db28512f2e000b9d04fba5133e8b1c6e8df59db3a8ab9d60be4b97cc9e81db', '2018-10-02 13:58:56', 'avatar/avatars-material-man-3.png', 'chanavee@grandats.com');
INSERT INTO `user_account` VALUES (2, 'test', 'd404559f602eab6fd602ac7680dacbfaadd13630335e951f097af3900e9de176b6db28512f2e000b9d04fba5133e8b1c6e8df59db3a8ab9d60be4b97cc9e81db', '2018-10-02 16:22:37', 'avatar/avatars-material-woman-3.png', 'test@gmail.com');
INSERT INTO `user_account` VALUES (4, 'test2', 'd404559f602eab6fd602ac7680dacbfaadd13630335e951f097af3900e9de176b6db28512f2e000b9d04fba5133e8b1c6e8df59db3a8ab9d60be4b97cc9e81db', '2018-10-02 18:13:49', 'avatar/avatars-material-man-1.png', 'ggggg@fff.com');
INSERT INTO `user_account` VALUES (5, 'test3', 'd404559f602eab6fd602ac7680dacbfaadd13630335e951f097af3900e9de176b6db28512f2e000b9d04fba5133e8b1c6e8df59db3a8ab9d60be4b97cc9e81db', '2018-10-03 10:26:09', 'avatar/avatars-material-man-2.png', 'ggggg555@fff.com');
INSERT INTO `user_account` VALUES (8, 'demo1', 'd404559f602eab6fd602ac7680dacbfaadd13630335e951f097af3900e9de176b6db28512f2e000b9d04fba5133e8b1c6e8df59db3a8ab9d60be4b97cc9e81db', '2018-10-03 16:04:05', 'avatar/avatars-material-man-1.png', 'demo1@gmail.com');
INSERT INTO `user_account` VALUES (9, 'test_user', 'd404559f602eab6fd602ac7680dacbfaadd13630335e951f097af3900e9de176b6db28512f2e000b9d04fba5133e8b1c6e8df59db3a8ab9d60be4b97cc9e81db', '2018-10-05 16:48:23', 'avatar/avatars-material-man-5.png', 'ggg@ggg.com');
INSERT INTO `user_account` VALUES (10, 'test_user2', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', '2018-10-05 16:55:57', 'avatar/avatars-material-man-4.png', 'dddd@ccc.com');
INSERT INTO `user_account` VALUES (11, 'nawakarn', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', '2018-10-05 17:35:56', 'avatar/avatars-material-man-1.png', 'karn@gmail.com');
INSERT INTO `user_account` VALUES (12, 'karn', 'd404559f602eab6fd602ac7680dacbfaadd13630335e951f097af3900e9de176b6db28512f2e000b9d04fba5133e8b1c6e8df59db3a8ab9d60be4b97cc9e81db', '2018-10-05 17:37:20', 'avatar/avatars-material-man-3.png', 'k@gmail-.com');
INSERT INTO `user_account` VALUES (13, 'vee', 'd404559f602eab6fd602ac7680dacbfaadd13630335e951f097af3900e9de176b6db28512f2e000b9d04fba5133e8b1c6e8df59db3a8ab9d60be4b97cc9e81db', '2020-06-17 15:45:31', 'avatar/avatars-material-man-5.png', 'vee@gmail.com');

-- ----------------------------
-- Table structure for votes
-- ----------------------------
DROP TABLE IF EXISTS `votes`;
CREATE TABLE `votes`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `up_count` int(11) NULL DEFAULT 0,
  `down_count` int(11) NULL DEFAULT 0,
  `threads_id` int(11) NULL DEFAULT NULL,
  `post_id` int(11) NULL DEFAULT NULL,
  `user_account_id` int(11) NOT NULL,
  PRIMARY KEY (`id`, `user_account_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of votes
-- ----------------------------
INSERT INTO `votes` VALUES (8, 1, 0, 2, NULL, 1);
INSERT INTO `votes` VALUES (9, 1, 0, 3, NULL, 1);
INSERT INTO `votes` VALUES (10, 1, 0, 5, NULL, 13);

SET FOREIGN_KEY_CHECKS = 1;
