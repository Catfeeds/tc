/*
 Navicat MySQL Data Transfer

 Source Server         : 47.104.5.229_3306
 Source Server Type    : MySQL
 Source Server Version : 50721
 Source Host           : 47.104.5.229:3306
 Source Schema         : app

 Target Server Type    : MySQL
 Target Server Version : 50721
 File Encoding         : 65001

 Date: 03/04/2018 16:27:32
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for aboutus
-- ----------------------------
DROP TABLE IF EXISTS `aboutus`;
CREATE TABLE `aboutus`  (
  `aboutus_id` int(11) NOT NULL AUTO_INCREMENT,
  `img` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '图片',
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '版本',
  `introduce` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '产品介绍',
  `time` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`aboutus_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of aboutus
-- ----------------------------
INSERT INTO `aboutus` VALUES (5, NULL, '网约课直播', '网约课直播APP为沈阳天成浩联科技有限公司旗下的一款直播类教育应用产品，是公司倾力打造的在线实用技能学习平台。   沈阳天成浩联科技有限公司依托具有实力雄厚的技术团队和多年的开发经验，并且随着更多新鲜血液的注入，更快掌握最新的互联网动态，具有快速应对突发事件的发生并解决的能力。 无论是web端还是APP端，我们的产品都具有实用性、成熟性、稳定性、安全性、保密性，采用灵活设置、坚持创新的设计原则，并且支持服务器读写分离、负载均衡，保证服务能及时处理突发情况 随着互联网科技发展，越来越多的人开始选择网上授课和进行网课学习，网约课直播APP特别针对广大学员对网课质量的要求，为此配备了强大的师资力量，确保丰富经验的教师授课来满足大家的学习，除此之外，APP的课程报名模块将会整合移动支付、三方登陆等功能，倾力打造个性化、人性化、服务化、全方位的辅导方案。', '1512449050');
INSERT INTO `aboutus` VALUES (6, NULL, '产品介绍', '								该平台于2018年（）月正式上线，主要为学习者提供海量的、优质的一对一课程教学。课程结构严谨，用户可以根据自身的学习进度，随时随地自主安排学习时间，宗旨是为每一位想真正学到些实用知识、技能的学习者和有师资能力的教师提供一个专业的学习和授课平台。立足于专业性的需求，平台与多家权威机构建立合作，按照正规的审核流程，拒绝三无教师，确保课程的优质性，并精选海量课程，课程数量1000+，课时总数超过100000，涵盖从启蒙教育到各类学术学科各阶段的专业性知识技能，视频分类全面，规划细致，用户覆盖面广泛，高效一对一互动教学。其中不乏数量可观，制作精良的独家课程人性化推荐。课程具有较强的实用性，从生活、办公、职业、科考等多维度，为用户打造实用、便捷的学习平台。网约课直播APP为了满足用户的使用要求，目前有PC端和移动端（Andriod ios）两个端口，更多应用请广大用户持续关注。', '1512449050');

-- ----------------------------
-- Table structure for address
-- ----------------------------
DROP TABLE IF EXISTS `address`;
CREATE TABLE `address`  (
  `address_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '地址id',
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '地址详细信息',
  `phone` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '电话',
  `uid` int(11) NOT NULL COMMENT '用户id',
  `uname` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '收货人姓名',
  PRIMARY KEY (`address_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 43 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of address
-- ----------------------------
INSERT INTO `address` VALUES (12, 'liaoning ', '13324098759', 30, 'wangle');
INSERT INTO `address` VALUES (13, '辽宁沈阳', '13325896568', 6, '张三');
INSERT INTO `address` VALUES (16, '辽宁沈阳', '15702431515', 48, '张三');
INSERT INTO `address` VALUES (17, '辽宁沈阳', '15702431419', 65, '试试');
INSERT INTO `address` VALUES (30, '沈阳十三纬路', '15734031396', 81, '付月');
INSERT INTO `address` VALUES (28, '13纬路', '13020033664', 53, '你公');
INSERT INTO `address` VALUES (29, '上课上课上课上课仔细看走走看看说l', '13000000000', 70, '贾森基德经典款');
INSERT INTO `address` VALUES (42, '防守打法', '13200000000', 117, '肥嘟嘟');
INSERT INTO `address` VALUES (41, '辽宁沈阳', '13324098758', 99, '王丽');
INSERT INTO `address` VALUES (36, '     辽宁省沈阳市铁西区中共接', '55555555', 111, '急急急急急急急急急急急急急急急急急\n');
INSERT INTO `address` VALUES (37, '沈阳市', '13600000000', 101, '嘉嘉');
INSERT INTO `address` VALUES (40, '继续继续坚持进进出出交界处', '13998000000', 119, '可分开分开分开');

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin`  (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '用户名',
  `pass` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '密码',
  `status` char(1) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '0' COMMENT '状态    0：启用   1：禁用',
  `role` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '角色',
  `time` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '添加时间',
  `num` int(11) DEFAULT 0 COMMENT '密码错误次数',
  `permission` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '管理员权限，指管理员能访问的页面',
  `issuper` char(1) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '0' COMMENT '是否是超级管理员  默认为0是   1否',
  `loginnum` int(11) DEFAULT NULL COMMENT '登录次数',
  PRIMARY KEY (`admin_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 127 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES (20, 'admin', '888', '0', '超级管理员', '1519884583', 0, '', '0', 68);
INSERT INTO `admin` VALUES (126, 'admin2', '123456789', '0', '直播管理', '1519884733', 0, '', '1', 7);

-- ----------------------------
-- Table structure for adminlog
-- ----------------------------
DROP TABLE IF EXISTS `adminlog`;
CREATE TABLE `adminlog`  (
  `adminlog_id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL COMMENT '用户id',
  `time` datetime(0) DEFAULT NULL COMMENT '登录时间',
  `ip` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '登录ip',
  `type` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '操作类型',
  `toID` int(11) DEFAULT NULL COMMENT '被操作ID（用户或其他）',
  `data` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '被操作信息（JSON字符串）',
  `res` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '结果（成功、失败）',
  `note` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '备注',
  `actionName` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '操作方法名',
  `controllerName` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '操作控制器名',
  `controllerActionName` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '操作方法名和控制器名',
  PRIMARY KEY (`adminlog_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1178 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of adminlog
-- ----------------------------
INSERT INTO `adminlog` VALUES (1, NULL, '2017-10-31 11:22:34', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (2, NULL, '2017-10-31 11:29:55', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (3, NULL, '2017-10-31 11:30:22', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (4, NULL, '2017-10-31 11:31:29', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (5, NULL, '2017-10-31 11:39:07', '::1', '登录', 0, NULL, '失败', '密码错误（第1次）', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (6, NULL, '2017-10-31 11:39:10', '::1', '登录', 0, NULL, '失败', '密码错误（第1次）', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (7, NULL, '2017-10-31 11:39:17', '::1', '登录', 0, NULL, '失败', '密码错误（第1次）', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (8, NULL, '2017-10-31 11:41:03', '::1', '登录', 0, NULL, '失败', '密码错误（第1次）', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (9, NULL, '2017-10-31 11:41:06', '::1', '登录', 0, NULL, '失败', '密码错误（第2次）', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (10, NULL, '2017-10-31 11:41:11', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (11, NULL, '2017-10-31 11:41:59', '::1', '登录', 0, NULL, '失败', '密码错误（第1次）', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (12, NULL, '2017-10-31 11:42:03', '::1', '登录', 0, NULL, '失败', '密码错误（第2次）', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (13, 1, '2017-10-31 11:42:07', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (14, 1, '2017-10-31 11:43:32', '::1', '登录', 0, NULL, '失败', '密码错误（第1次）', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (15, 1, '2017-10-31 11:43:36', '::1', '登录', 0, NULL, '账户不存在', '登录账户为：dsdsd', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (16, 1, '2017-10-31 11:43:39', '::1', '登录', 0, NULL, '账户不存在', '登录账户为：adsfsdf', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (17, 1, '2017-10-31 11:44:26', '::1', '登录', 0, NULL, '失败', '账户不存在，登录账户为：adsfsdf', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (18, 1, '2017-10-31 11:51:50', '::1', '登录', 0, NULL, '失败', '密码错误（第2次）', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (19, 1, '2017-10-31 11:51:55', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (20, NULL, '2017-10-31 13:20:18', '::1', '登录', 0, NULL, '失败', '账户不存在，登录账户为：admingffgd', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (21, NULL, '2017-10-31 13:21:21', '::1', '登录', 0, NULL, '失败', '密码错误（第1次）', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (22, 1, '2017-10-31 13:21:25', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (23, 1, '2017-10-31 13:22:53', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (24, NULL, '2017-10-31 13:22:59', '::1', '登录', 0, NULL, '失败', '密码错误（第1次）', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (25, NULL, '2017-10-31 13:25:25', '::1', '登录', 0, NULL, '失败', '密码错误（第2次）', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (26, 1, '2017-10-31 13:25:30', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (27, NULL, '2017-10-31 13:37:12', '::1', '登录', 0, NULL, '失败', '密码错误（第1次）', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (28, 1, '2017-10-31 13:37:17', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (29, NULL, '2017-10-31 13:38:45', '::1', '登录', 0, NULL, '失败', '密码错误（第1次）', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (30, 1, '2017-10-31 13:38:53', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (31, 1, '2017-10-31 13:55:15', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (32, 1, '2017-10-31 13:55:26', '::1', '登录', 0, NULL, '失败', '账户不存在，登录账户为：admin2', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (33, 1, '2017-10-31 13:55:29', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (34, 1, '2017-10-31 13:55:48', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (35, 1, '2017-10-31 13:56:52', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (36, 1, '2017-10-31 15:54:57', '192.168.0.121', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (37, 1, '2017-10-31 16:13:38', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (38, 1, '2017-10-31 16:57:29', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (39, NULL, '2017-10-31 16:57:36', '::1', '退出登录', 0, NULL, '成功', '', 'login_Out', 'Index', 'Indexlogin_Out');
INSERT INTO `adminlog` VALUES (40, 1, '2017-10-31 16:57:42', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (41, 1, '2017-10-31 17:02:02', '::1', '退出登录', 0, NULL, '成功', '', 'login_Out', 'Index', 'Indexlogin_Out');
INSERT INTO `adminlog` VALUES (42, NULL, '2017-10-31 17:06:13', '::1', '登录', 0, NULL, '失败', '密码错误（第1次）', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (43, NULL, '2017-10-31 17:06:15', '::1', '登录', 0, NULL, '失败', '密码错误（第2次）', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (44, NULL, '2017-10-31 17:06:20', '::1', '登录', 0, NULL, '失败', '密码错误（第3次）', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (45, NULL, '2017-10-31 17:06:23', '::1', '登录', 0, NULL, '失败', '密码错误（账户锁定）', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (46, NULL, '2017-10-31 17:06:26', '::1', '登录', 0, NULL, '失败', '密码错误（账户锁定）', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (47, NULL, '2017-10-31 17:06:28', '::1', '登录', 0, NULL, '失败', '密码错误（账户锁定）', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (48, NULL, '2017-10-31 17:06:31', '::1', '登录', 0, NULL, '失败', '密码错误（账户锁定）', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (49, NULL, '2017-10-31 17:06:34', '::1', '登录', 0, NULL, '失败', '密码错误（账户锁定）', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (50, NULL, '2017-10-31 17:06:38', '::1', '登录', 0, NULL, '失败', '密码错误（账户锁定）', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (51, NULL, '2017-10-31 17:06:42', '::1', '登录', 0, NULL, '失败', '密码错误（账户锁定）', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (52, 1, '2017-10-31 17:07:31', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (53, 1, '2017-10-31 17:09:24', '::1', '退出登录', 0, NULL, '成功', '', 'login_Out', 'Index', 'Indexlogin_Out');
INSERT INTO `adminlog` VALUES (54, NULL, '2017-10-31 17:09:25', '::1', '登录', 0, NULL, '失败', '密码错误（第1次）', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (55, NULL, '2017-10-31 17:09:27', '::1', '登录', 0, NULL, '失败', '密码错误（第2次）', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (56, NULL, '2017-10-31 17:09:33', '::1', '登录', 0, NULL, '失败', '密码错误（第3次）', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (57, 1, '2017-10-31 17:11:15', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (58, 1, '2017-10-31 17:11:18', '::1', '退出登录', 0, NULL, '成功', '', 'login_Out', 'Index', 'Indexlogin_Out');
INSERT INTO `adminlog` VALUES (59, NULL, '2017-10-31 17:11:19', '::1', '登录', 0, NULL, '失败', '密码错误（第1次）', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (60, NULL, '2017-10-31 17:11:21', '::1', '登录', 0, NULL, '失败', '密码错误（第2次）', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (61, NULL, '2017-10-31 17:11:22', '::1', '登录', 0, NULL, '失败', '密码错误（账户锁定）', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (62, 1, '2017-10-31 17:11:28', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (63, 1, '2017-10-31 17:11:55', '::1', '退出登录', 0, NULL, '成功', '', 'login_Out', 'Index', 'Indexlogin_Out');
INSERT INTO `adminlog` VALUES (64, NULL, '2017-10-31 17:11:57', '::1', '登录', 0, NULL, '失败', '密码错误（第1次）', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (65, NULL, '2017-10-31 17:11:59', '::1', '登录', 0, NULL, '失败', '密码错误（第2次）', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (66, NULL, '2017-10-31 17:12:00', '::1', '登录', 0, NULL, '失败', '密码错误（账户锁定）', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (67, NULL, '2017-10-31 17:12:01', '::1', '登录', 0, NULL, '失败', '密码错误（账户锁定）', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (68, NULL, '2017-10-31 17:12:02', '::1', '登录', 0, NULL, '失败', '密码错误（账户锁定）', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (69, NULL, '2017-10-31 17:12:05', '::1', '登录', 0, NULL, '失败', '账户已被锁定', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (70, NULL, '2017-10-31 17:13:04', '::1', '登录', 0, NULL, '失败', '账户已被锁定', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (71, NULL, '2017-10-31 17:13:06', '::1', '登录', 0, NULL, '失败', '账户已被锁定', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (72, NULL, '2017-10-31 17:13:08', '::1', '登录', 0, NULL, '失败', '账户已被锁定', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (73, NULL, '2017-10-31 17:13:32', '::1', '登录', 0, NULL, '失败', '账户已被锁定', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (74, NULL, '2017-10-31 17:13:34', '::1', '登录', 0, NULL, '失败', '账户已被锁定', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (75, NULL, '2017-10-31 17:13:35', '::1', '登录', 0, NULL, '失败', '账户已被锁定', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (76, 1, '2017-10-31 18:20:48', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (77, 1, '2017-10-31 18:26:37', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (78, NULL, '2017-10-31 18:27:03', '::1', '登录', 0, NULL, '失败', '账户不存在，登录账户为：str', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (79, NULL, '2017-10-31 18:27:08', '::1', '登录', 0, NULL, '失败', '密码错误（第1次）', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (80, NULL, '2017-10-31 18:27:09', '::1', '登录', 0, NULL, '失败', '密码错误（第2次）', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (81, NULL, '2017-10-31 18:27:10', '::1', '登录', 0, NULL, '失败', '密码错误（第3次）', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (82, NULL, '2017-10-31 18:27:13', '::1', '登录', 0, NULL, '失败', '密码错误（账户锁定）', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (83, NULL, '2017-10-31 18:27:14', '::1', '登录', 0, NULL, '失败', '密码错误（账户锁定）', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (84, 1, '2017-10-31 18:27:18', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (85, NULL, '2017-10-31 18:27:34', '::1', '登录', 0, NULL, '失败', '密码错误（第1次）', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (86, NULL, '2017-10-31 18:27:36', '::1', '登录', 0, NULL, '失败', '密码错误（第2次）', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (87, NULL, '2017-10-31 18:27:38', '::1', '登录', 0, NULL, '失败', '密码错误（第3次）', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (88, NULL, '2017-10-31 18:27:43', '::1', '登录', 0, NULL, '失败', '密码错误（账户锁定）', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (89, NULL, '2017-10-31 18:27:47', '::1', '登录', 0, NULL, '失败', '密码错误（账户锁定）', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (90, NULL, '2017-10-31 18:27:48', '::1', '登录', 0, NULL, '失败', '密码错误（账户锁定）', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (91, NULL, '2017-10-31 18:27:49', '::1', '登录', 0, NULL, '失败', '密码错误（账户锁定）', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (92, NULL, '2017-10-31 18:27:50', '::1', '登录', 0, NULL, '失败', '密码错误（账户锁定）', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (93, 1, '2017-10-31 18:27:54', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (94, 1, '2017-10-31 18:28:44', '::1', '退出登录', 0, NULL, '成功', '', 'login_Out', 'Index', 'Indexlogin_Out');
INSERT INTO `adminlog` VALUES (95, NULL, '2017-10-31 18:28:48', '::1', '登录', 0, NULL, '失败', '账户不存在，登录账户为：str', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (96, NULL, '2017-10-31 18:28:53', '::1', '登录', 0, NULL, '失败', '账户已被锁定', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (97, NULL, '2017-10-31 18:28:55', '::1', '登录', 0, NULL, '失败', '账户已被锁定', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (98, NULL, '2017-10-31 18:28:59', '::1', '登录', 0, NULL, '失败', '账户已被锁定', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (99, NULL, '2017-10-31 18:29:01', '::1', '登录', 0, NULL, '失败', '账户已被锁定', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (100, 1, '2017-10-31 18:29:43', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (101, 1, '2017-11-01 10:24:27', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (102, 1, '2017-11-01 10:35:30', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (103, 1, '2017-11-01 13:45:05', '::1', '添加商品', 2, NULL, '成功', '', 'dataAdd_Sub', 'Shop', 'ShopdataAdd_Sub');
INSERT INTO `adminlog` VALUES (104, 1, '2017-11-01 13:46:51', '::1', '添加商品', 3, NULL, '成功', '', 'dataAdd_Sub', 'Shop', 'ShopdataAdd_Sub');
INSERT INTO `adminlog` VALUES (105, 1, '2017-11-01 13:50:29', '::1', '添加商品', 4, NULL, '成功', '', 'dataAdd_Sub', 'Shop', 'ShopdataAdd_Sub');
INSERT INTO `adminlog` VALUES (106, 1, '2017-11-01 13:52:16', '::1', '添加商品', 5, NULL, '成功', '', 'dataAdd_Sub', 'Shop', 'ShopdataAdd_Sub');
INSERT INTO `adminlog` VALUES (107, 1, '2017-11-01 13:53:06', '::1', '添加商品', 6, NULL, '成功', '', 'dataAdd_Sub', 'Shop', 'ShopdataAdd_Sub');
INSERT INTO `adminlog` VALUES (108, 1, '2017-11-01 13:54:35', '::1', '添加商品', 7, NULL, '成功', '', 'dataAdd_Sub', 'Shop', 'ShopdataAdd_Sub');
INSERT INTO `adminlog` VALUES (109, 1, '2017-11-01 13:55:39', '::1', '添加商品', 8, NULL, '成功', '', 'dataAdd_Sub', 'Shop', 'ShopdataAdd_Sub');
INSERT INTO `adminlog` VALUES (110, 1, '2017-11-01 15:28:43', '::1', '添加商品', 9, NULL, '成功', '', 'dataAdd_Sub', 'Shop', 'ShopdataAdd_Sub');
INSERT INTO `adminlog` VALUES (111, 1, '2017-11-01 15:32:40', '::1', '添加商品', 10, NULL, '成功', '', 'dataAdd_Sub', 'Shop', 'ShopdataAdd_Sub');
INSERT INTO `adminlog` VALUES (112, 1, '2017-11-01 15:32:48', '::1', '添加商品', 11, NULL, '成功', '', 'dataAdd_Sub', 'Shop', 'ShopdataAdd_Sub');
INSERT INTO `adminlog` VALUES (113, 1, '2017-11-01 15:33:14', '::1', '添加商品', 12, NULL, '成功', '', 'dataAdd_Sub', 'Shop', 'ShopdataAdd_Sub');
INSERT INTO `adminlog` VALUES (114, 1, '2017-11-01 15:36:31', '::1', '添加商品', 13, NULL, '成功', '', 'dataAdd_Sub', 'Shop', 'ShopdataAdd_Sub');
INSERT INTO `adminlog` VALUES (115, 1, '2017-11-01 15:36:34', '::1', '添加商品', 14, NULL, '成功', '', 'dataAdd_Sub', 'Shop', 'ShopdataAdd_Sub');
INSERT INTO `adminlog` VALUES (116, 1, '2017-11-01 15:37:20', '::1', '添加商品', 15, NULL, '成功', '', 'dataAdd_Sub', 'Shop', 'ShopdataAdd_Sub');
INSERT INTO `adminlog` VALUES (117, 1, '2017-11-01 15:47:03', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (118, 1, '2017-11-01 16:22:11', '::1', '添加商品', 16, NULL, '成功', '', 'dataAdd_Sub', 'Shop', 'ShopdataAdd_Sub');
INSERT INTO `adminlog` VALUES (119, 1, '2017-11-01 16:27:57', '::1', '添加商品', 18, NULL, '成功', '', 'dataAdd_Sub', 'Shop', 'ShopdataAdd_Sub');
INSERT INTO `adminlog` VALUES (120, 1, '2017-11-01 16:39:28', '::1', '添加商品', 19, NULL, '成功', '', 'dataAdd_Sub', 'Shop', 'ShopdataAdd_Sub');
INSERT INTO `adminlog` VALUES (121, 1, '2017-11-01 16:48:10', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (122, 1, '2017-11-01 16:49:21', '::1', '添加商品', 20, NULL, '成功', '', 'dataAdd_Sub', 'Shop', 'ShopdataAdd_Sub');
INSERT INTO `adminlog` VALUES (123, 1, '2017-11-01 16:49:30', '::1', '添加商品', 21, NULL, '成功', '', 'dataAdd_Sub', 'Shop', 'ShopdataAdd_Sub');
INSERT INTO `adminlog` VALUES (124, 1, '2017-11-01 17:03:48', '::1', '添加商品', 22, NULL, '成功', '', 'dataAdd_Sub', 'Shop', 'ShopdataAdd_Sub');
INSERT INTO `adminlog` VALUES (125, 1, '2017-11-01 17:22:00', '::1', '添加商品', 23, NULL, '成功', '', 'dataAdd_Sub', 'Shop', 'ShopdataAdd_Sub');
INSERT INTO `adminlog` VALUES (126, 1, '2017-11-01 17:23:15', '::1', '添加商品', 24, NULL, '成功', '', 'dataAdd_Sub', 'Shop', 'ShopdataAdd_Sub');
INSERT INTO `adminlog` VALUES (127, 1, '2017-11-01 17:46:29', '::1', '添加商品', 25, NULL, '成功', '', 'dataAdd_Sub', 'Shop', 'ShopdataAdd_Sub');
INSERT INTO `adminlog` VALUES (128, 1, '2017-11-01 17:47:46', '::1', '添加商品', 26, NULL, '成功', '', 'dataAdd_Sub', 'Shop', 'ShopdataAdd_Sub');
INSERT INTO `adminlog` VALUES (129, 1, '2017-11-01 17:58:26', '::1', '添加商品', 27, NULL, '成功', '', 'dataAdd_Sub', 'Shop', 'ShopdataAdd_Sub');
INSERT INTO `adminlog` VALUES (130, 1, '2017-11-01 18:00:34', '::1', '添加商品', 28, NULL, '成功', '', 'dataAdd_Sub', 'Shop', 'ShopdataAdd_Sub');
INSERT INTO `adminlog` VALUES (131, 1, '2017-11-01 18:01:15', '::1', '添加商品', 29, NULL, '成功', '', 'dataAdd_Sub', 'Shop', 'ShopdataAdd_Sub');
INSERT INTO `adminlog` VALUES (132, 1, '2017-11-01 18:02:51', '::1', '添加商品', 30, NULL, '成功', '', 'dataAdd_Sub', 'Shop', 'ShopdataAdd_Sub');
INSERT INTO `adminlog` VALUES (133, 1, '2017-11-01 18:05:29', '::1', '添加商品', 31, NULL, '成功', '', 'dataAdd_Sub', 'Shop', 'ShopdataAdd_Sub');
INSERT INTO `adminlog` VALUES (134, 1, '2017-11-01 18:05:58', '::1', '添加商品', 32, NULL, '成功', '', 'dataAdd_Sub', 'Shop', 'ShopdataAdd_Sub');
INSERT INTO `adminlog` VALUES (135, 1, '2017-11-01 18:07:32', '::1', '添加商品', 33, NULL, '成功', '', 'dataAdd_Sub', 'Shop', 'ShopdataAdd_Sub');
INSERT INTO `adminlog` VALUES (136, 1, '2017-11-02 08:58:45', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (137, 1, '2017-11-02 09:24:09', '::1', '添加商品', 34, NULL, '成功', '', 'dataAdd_Sub', 'Shop', 'ShopdataAdd_Sub');
INSERT INTO `adminlog` VALUES (138, 1, '2017-11-02 09:24:30', '::1', '添加商品', 35, NULL, '成功', '', 'dataAdd_Sub', 'Shop', 'ShopdataAdd_Sub');
INSERT INTO `adminlog` VALUES (139, NULL, '2017-11-02 13:53:24', '::1', '登录', 0, NULL, '失败', '密码错误（第1次）', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (140, 1, '2017-11-02 13:54:25', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (141, 1, '2017-11-02 13:55:29', '::1', '添加商品', 36, NULL, '成功', '', 'dataAdd_Sub', 'Shop', 'ShopdataAdd_Sub');
INSERT INTO `adminlog` VALUES (142, 1, '2017-11-02 14:00:22', '::1', '添加商品', 37, NULL, '成功', '', 'dataAdd_Sub', 'Shop', 'ShopdataAdd_Sub');
INSERT INTO `adminlog` VALUES (143, 1, '2017-11-02 15:36:34', '::1', '退出登录', 0, NULL, '成功', '', 'login_Out', 'Index', 'Indexlogin_Out');
INSERT INTO `adminlog` VALUES (144, NULL, '2017-11-02 15:36:53', '::1', '退出登录', 0, NULL, '成功', '', 'login_Out', 'Index', 'Indexlogin_Out');
INSERT INTO `adminlog` VALUES (145, NULL, '2017-11-02 15:36:55', '::1', '退出登录', 0, NULL, '成功', '', 'login_Out', 'Index', 'Indexlogin_Out');
INSERT INTO `adminlog` VALUES (146, NULL, '2017-11-02 15:37:03', '::1', '退出登录', 0, NULL, '成功', '', 'login_Out', 'Index', 'Indexlogin_Out');
INSERT INTO `adminlog` VALUES (147, NULL, '2017-11-02 15:37:22', '::1', '退出登录', 0, NULL, '成功', '', 'login_Out', 'Index', 'Indexlogin_Out');
INSERT INTO `adminlog` VALUES (148, NULL, '2017-11-02 15:51:00', '::1', '退出登录', 0, NULL, '成功', '', 'login_Out', 'Index', 'Indexlogin_Out');
INSERT INTO `adminlog` VALUES (149, 1, '2017-11-02 15:51:05', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (150, 1, '2017-11-02 16:12:12', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (151, 1, '2017-11-02 16:12:27', '::1', '上架商品', 0, NULL, '成功', '', 'shangjia', 'Shop', 'Shopshangjia');
INSERT INTO `adminlog` VALUES (152, 1, '2017-11-02 16:12:33', '::1', '上架商品', 0, NULL, '成功', '', 'shangjia', 'Shop', 'Shopshangjia');
INSERT INTO `adminlog` VALUES (153, 1, '2017-11-02 16:12:36', '::1', '上架商品', 0, NULL, '成功', '', 'shangjia', 'Shop', 'Shopshangjia');
INSERT INTO `adminlog` VALUES (154, 1, '2017-11-02 16:12:41', '::1', '上架商品', 0, NULL, '成功', '', 'shangjia', 'Shop', 'Shopshangjia');
INSERT INTO `adminlog` VALUES (155, 1, '2017-11-02 16:12:51', '::1', '上架商品', 0, NULL, '成功', '', 'shangjia', 'Shop', 'Shopshangjia');
INSERT INTO `adminlog` VALUES (156, 1, '2017-11-02 16:12:54', '::1', '下架商品', 0, NULL, '成功', '', 'xiajia', 'Shop', 'Shopxiajia');
INSERT INTO `adminlog` VALUES (157, 1, '2017-11-02 16:12:57', '::1', '下架商品', 0, NULL, '成功', '', 'xiajia', 'Shop', 'Shopxiajia');
INSERT INTO `adminlog` VALUES (158, 1, '2017-11-02 16:13:46', '::1', '上架商品', 0, NULL, '成功', '', 'shangjia', 'Shop', 'Shopshangjia');
INSERT INTO `adminlog` VALUES (159, 1, '2017-11-02 16:14:00', '::1', '上架商品', 0, NULL, '成功', '', 'shangjia', 'Shop', 'Shopshangjia');
INSERT INTO `adminlog` VALUES (160, 1, '2017-11-02 16:14:03', '::1', '下架商品', 0, NULL, '成功', '', 'xiajia', 'Shop', 'Shopxiajia');
INSERT INTO `adminlog` VALUES (161, 1, '2017-11-02 16:14:24', '::1', '上架商品', 0, NULL, '成功', '', 'shangjia', 'Shop', 'Shopshangjia');
INSERT INTO `adminlog` VALUES (162, 1, '2017-11-02 16:14:31', '::1', '上架商品', 0, NULL, '成功', '', 'shangjia', 'Shop', 'Shopshangjia');
INSERT INTO `adminlog` VALUES (163, 1, '2017-11-02 16:15:25', '::1', '上架商品', 27, NULL, '成功', '', 'shangjia', 'Shop', 'Shopshangjia');
INSERT INTO `adminlog` VALUES (164, 1, '2017-11-02 16:15:33', '::1', '下架商品', 32, NULL, '成功', '', 'xiajia', 'Shop', 'Shopxiajia');
INSERT INTO `adminlog` VALUES (165, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `adminlog` VALUES (166, 1, '2017-11-02 16:34:02', '192.168.1.121', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (167, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `adminlog` VALUES (168, 3, '2017-11-02 16:53:20', '192.168.1.66', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (169, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `adminlog` VALUES (170, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `adminlog` VALUES (171, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `adminlog` VALUES (172, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `adminlog` VALUES (173, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `adminlog` VALUES (174, 1, '2017-11-02 17:13:36', '::1', '上架商品', 27, NULL, '成功', '', 'shangjia', 'Shop', 'Shopshangjia');
INSERT INTO `adminlog` VALUES (175, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `adminlog` VALUES (176, 1, '2017-11-02 17:15:18', '::1', '上架商品', 27, NULL, '成功', '', 'shangjia', 'Shop', 'Shopshangjia');
INSERT INTO `adminlog` VALUES (177, 1, '2017-11-02 17:15:46', '::1', '上架商品', 27, NULL, '成功', '', 'shangjia', 'Shop', 'Shopshangjia');
INSERT INTO `adminlog` VALUES (178, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `adminlog` VALUES (179, 1, '2017-11-02 17:26:01', '192.168.1.121', '上架商品', 27, NULL, '成功', '', 'shangjia', 'Shop', 'Shopshangjia');
INSERT INTO `adminlog` VALUES (180, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `adminlog` VALUES (181, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `adminlog` VALUES (182, 3, '2017-11-02 17:32:08', '192.168.1.121', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (183, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `adminlog` VALUES (184, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `adminlog` VALUES (185, 1, '2017-11-02 17:35:07', '::1', '下架商品', 28, NULL, '成功', '', 'xiajia', 'Shop', 'Shopxiajia');
INSERT INTO `adminlog` VALUES (186, 1, '2017-11-02 17:36:26', '::1', '下架商品', 39, NULL, '成功', '', 'xiajia', 'Shop', 'Shopxiajia');
INSERT INTO `adminlog` VALUES (187, 1, '2017-11-02 17:36:31', '::1', '下架商品', 39, NULL, '成功', '', 'xiajia', 'Shop', 'Shopxiajia');
INSERT INTO `adminlog` VALUES (188, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `adminlog` VALUES (189, 1, '2017-11-02 17:37:59', '::1', '下架商品', 39, NULL, '成功', '', 'xiajia', 'Shop', 'Shopxiajia');
INSERT INTO `adminlog` VALUES (190, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `adminlog` VALUES (191, 1, '2017-11-02 17:53:53', '::1', '下架商品', 28, NULL, '成功', '', 'xiajia', 'Shop', 'Shopxiajia');
INSERT INTO `adminlog` VALUES (192, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `adminlog` VALUES (193, 1, '2017-11-02 17:54:57', '::1', '下架商品', 28, NULL, '成功', '', 'xiajia', 'Shop', 'Shopxiajia');
INSERT INTO `adminlog` VALUES (194, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `adminlog` VALUES (195, 1, '2017-11-02 17:57:32', '::1', '下架商品', 28, NULL, '成功', '', 'xiajia', 'Shop', 'Shopxiajia');
INSERT INTO `adminlog` VALUES (196, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `adminlog` VALUES (197, 1, '2017-11-02 17:57:47', '::1', '下架商品', 28, NULL, '成功', '', 'xiajia', 'Shop', 'Shopxiajia');
INSERT INTO `adminlog` VALUES (198, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `adminlog` VALUES (199, 1, '2017-11-02 17:58:05', '::1', '下架商品', 28, NULL, '成功', '', 'xiajia', 'Shop', 'Shopxiajia');
INSERT INTO `adminlog` VALUES (200, 1, '2017-11-02 18:02:18', '::1', '删除商品', 0, NULL, '成功', '', 'dataDel', 'Shop', 'ShopdataDel');
INSERT INTO `adminlog` VALUES (201, 1, '2017-11-02 18:02:27', '::1', '删除商品', 0, NULL, '成功', '', 'dataDel', 'Shop', 'ShopdataDel');
INSERT INTO `adminlog` VALUES (202, 1, '2017-11-02 18:02:33', '::1', '下架商品', 32, NULL, '成功', '', 'xiajia', 'Shop', 'Shopxiajia');
INSERT INTO `adminlog` VALUES (203, 1, '2017-11-02 18:04:11', '::1', '下架商品', 35, NULL, '成功', '', 'xiajia', 'Shop', 'Shopxiajia');
INSERT INTO `adminlog` VALUES (204, 1, '2017-11-02 18:04:15', '::1', '下架商品', 33, NULL, '成功', '', 'xiajia', 'Shop', 'Shopxiajia');
INSERT INTO `adminlog` VALUES (205, 1, '2017-11-02 18:04:18', '::1', '下架商品', 32, NULL, '成功', '', 'xiajia', 'Shop', 'Shopxiajia');
INSERT INTO `adminlog` VALUES (206, 1, '2017-11-02 18:07:21', '::1', '上架商品', 27, NULL, '成功', '', 'shangjia', 'Shop', 'Shopshangjia');
INSERT INTO `adminlog` VALUES (207, 1, '2017-11-02 18:10:36', '::1', '上架商品', 27, NULL, '成功', '', 'shangjia', 'Shop', 'Shopshangjia');
INSERT INTO `adminlog` VALUES (208, 1, '2017-11-02 18:10:38', '::1', '下架商品', 32, NULL, '成功', '', 'xiajia', 'Shop', 'Shopxiajia');
INSERT INTO `adminlog` VALUES (209, 1, '2017-11-02 18:10:42', '::1', '上架商品', 32, NULL, '成功', '', 'shangjia', 'Shop', 'Shopshangjia');
INSERT INTO `adminlog` VALUES (210, 1, '2017-11-02 18:21:38', '::1', '下架商品', 27, NULL, '成功', '', 'xiajia', 'Shop', 'Shopxiajia');
INSERT INTO `adminlog` VALUES (211, 1, '2017-11-02 18:21:41', '::1', '下架商品', 35, NULL, '成功', '', 'xiajia', 'Shop', 'Shopxiajia');
INSERT INTO `adminlog` VALUES (212, 1, '2017-11-02 18:21:44', '::1', '下架商品', 33, NULL, '成功', '', 'xiajia', 'Shop', 'Shopxiajia');
INSERT INTO `adminlog` VALUES (213, 1, '2017-11-02 18:21:46', '::1', '下架商品', 32, NULL, '成功', '', 'xiajia', 'Shop', 'Shopxiajia');
INSERT INTO `adminlog` VALUES (214, 1, '2017-11-02 18:22:05', '::1', '退出登录', 0, NULL, '成功', '', 'login_Out', 'Index', 'Indexlogin_Out');
INSERT INTO `adminlog` VALUES (215, 3, '2017-11-02 18:22:09', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (216, 3, '2017-11-02 18:22:43', '::1', '上架商品', 33, NULL, '成功', '', 'shangjia', 'Shop', 'Shopshangjia');
INSERT INTO `adminlog` VALUES (217, 3, '2017-11-02 18:22:46', '::1', '上架商品', 32, NULL, '成功', '', 'shangjia', 'Shop', 'Shopshangjia');
INSERT INTO `adminlog` VALUES (218, 3, '2017-11-02 18:23:08', '::1', '下架商品', 39, NULL, '成功', '', 'xiajia', 'Shop', 'Shopxiajia');
INSERT INTO `adminlog` VALUES (219, 3, '2017-11-02 18:23:11', '::1', '上架商品', 39, NULL, '成功', '', 'shangjia', 'Shop', 'Shopshangjia');
INSERT INTO `adminlog` VALUES (220, 3, '2017-11-02 18:23:15', '::1', '下架商品', 39, NULL, '成功', '', 'xiajia', 'Shop', 'Shopxiajia');
INSERT INTO `adminlog` VALUES (221, 3, '2017-11-02 18:23:34', '::1', '退出登录', 0, NULL, '成功', '', 'login_Out', 'Index', 'Indexlogin_Out');
INSERT INTO `adminlog` VALUES (222, NULL, '2017-11-02 18:23:38', '::1', '登录', 0, NULL, '失败', '密码错误（第1次）', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (223, NULL, '2017-11-02 18:23:40', '::1', '登录', 0, NULL, '失败', '密码错误（第2次）', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (224, NULL, '2017-11-02 18:23:42', '::1', '登录', 0, NULL, '失败', '密码错误（账户锁定）', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (225, NULL, '2017-11-02 18:23:46', '::1', '登录', 0, NULL, '失败', '账户已被锁定', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (226, NULL, '2017-11-02 18:23:50', '::1', '登录', 0, NULL, '失败', '账户已被锁定', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (227, NULL, '2017-11-02 18:23:54', '::1', '登录', 0, NULL, '失败', '账户已被锁定', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (228, NULL, '2017-11-02 18:23:56', '::1', '登录', 0, NULL, '失败', '账户不存在，登录账户为：admin2', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (229, NULL, '2017-11-02 18:24:30', '::1', '登录', 0, NULL, '失败', '账户不存在，登录账户为：admin2', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (230, NULL, '2017-11-02 18:24:33', '::1', '登录', 0, NULL, '失败', '密码错误（账户锁定）', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (231, NULL, '2017-11-02 18:24:37', '::1', '登录', 0, NULL, '失败', '账户已被锁定', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (232, NULL, '2017-11-02 18:24:45', '::1', '登录', 0, NULL, '失败', '账户已被锁定', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (233, NULL, '2017-11-02 18:24:49', '::1', '登录', 0, NULL, '失败', '账户已被锁定', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (234, 3, '2017-11-02 18:24:58', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (235, 3, '2017-11-02 18:25:42', '::1', '上架商品', 39, NULL, '成功', '', 'shangjia', 'Shop', 'Shopshangjia');
INSERT INTO `adminlog` VALUES (236, 3, '2017-11-02 18:25:44', '::1', '下架商品', 39, NULL, '成功', '', 'xiajia', 'Shop', 'Shopxiajia');
INSERT INTO `adminlog` VALUES (237, 3, '2017-11-02 18:26:38', '::1', '上架商品', 35, NULL, '成功', '', 'shangjia', 'Shop', 'Shopshangjia');
INSERT INTO `adminlog` VALUES (238, 3, '2017-11-02 18:26:41', '::1', '下架商品', 32, NULL, '成功', '', 'xiajia', 'Shop', 'Shopxiajia');
INSERT INTO `adminlog` VALUES (239, 3, '2017-11-02 18:26:43', '::1', '下架商品', 33, NULL, '成功', '', 'xiajia', 'Shop', 'Shopxiajia');
INSERT INTO `adminlog` VALUES (240, 3, '2017-11-02 18:34:51', '::1', '下架商品', 35, NULL, '成功', '', 'xiajia', 'Shop', 'Shopxiajia');
INSERT INTO `adminlog` VALUES (241, 3, '2017-11-02 18:34:53', '::1', '上架商品', 33, NULL, '成功', '', 'shangjia', 'Shop', 'Shopshangjia');
INSERT INTO `adminlog` VALUES (242, 3, '2017-11-02 18:34:57', '::1', '上架商品', 27, NULL, '成功', '', 'shangjia', 'Shop', 'Shopshangjia');
INSERT INTO `adminlog` VALUES (243, 3, '2017-11-02 18:35:08', '::1', '上架商品', 39, NULL, '成功', '', 'shangjia', 'Shop', 'Shopshangjia');
INSERT INTO `adminlog` VALUES (244, 3, '2017-11-02 18:35:10', '::1', '下架商品', 39, NULL, '成功', '', 'xiajia', 'Shop', 'Shopxiajia');
INSERT INTO `adminlog` VALUES (245, 3, '2017-11-02 18:35:12', '::1', '上架商品', 39, NULL, '成功', '', 'shangjia', 'Shop', 'Shopshangjia');
INSERT INTO `adminlog` VALUES (246, 3, '2017-11-03 09:09:57', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (247, 3, '2017-11-03 09:28:25', '::1', '下架商品', 39, NULL, '成功', '', 'xiajia', 'Shop', 'Shopxiajia');
INSERT INTO `adminlog` VALUES (248, 3, '2017-11-03 09:28:27', '::1', '上架商品', 39, NULL, '成功', '', 'shangjia', 'Shop', 'Shopshangjia');
INSERT INTO `adminlog` VALUES (249, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `adminlog` VALUES (250, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `adminlog` VALUES (251, 3, '2017-11-03 12:48:00', '::1', '下架商品', 41, NULL, '成功', '', 'xiajia', 'Shop', 'Shopxiajia');
INSERT INTO `adminlog` VALUES (252, 3, '2017-11-03 12:48:03', '::1', '上架商品', 41, NULL, '成功', '', 'shangjia', 'Shop', 'Shopshangjia');
INSERT INTO `adminlog` VALUES (253, 3, '2017-11-03 12:48:47', '::1', '下架商品', 41, NULL, '成功', '', 'xiajia', 'Shop', 'Shopxiajia');
INSERT INTO `adminlog` VALUES (254, 3, '2017-11-03 12:49:19', '::1', '上架商品', 41, NULL, '成功', '', 'shangjia', 'Shop', 'Shopshangjia');
INSERT INTO `adminlog` VALUES (255, 3, '2017-11-03 12:49:21', '::1', '下架商品', 41, NULL, '成功', '', 'xiajia', 'Shop', 'Shopxiajia');
INSERT INTO `adminlog` VALUES (256, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `adminlog` VALUES (257, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `adminlog` VALUES (258, 3, '2017-11-03 16:46:56', '::1', '下架商品', 43, NULL, '成功', '', 'xiajia', 'Shop', 'Shopxiajia');
INSERT INTO `adminlog` VALUES (259, 3, '2017-11-03 17:19:37', '::1', '上架商品', 43, NULL, '成功', '', 'shangjia', 'Shop', 'Shopshangjia');
INSERT INTO `adminlog` VALUES (260, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `adminlog` VALUES (261, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `adminlog` VALUES (262, NULL, '2017-11-06 10:36:11', '192.168.1.66', '登录', 0, NULL, '失败', '密码错误（第1次）', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (263, 3, '2017-11-06 10:36:16', '192.168.1.66', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (264, 3, '2017-11-06 10:50:49', '192.168.1.66', '隐藏banner', 1, NULL, '成功', '', 'yincang', 'Notice', 'Noticeyincang');
INSERT INTO `adminlog` VALUES (265, 3, '2017-11-06 10:54:33', '192.168.1.66', '显示banner', 1, NULL, '成功', '', 'xianshi', 'Notice', 'Noticexianshi');
INSERT INTO `adminlog` VALUES (266, 3, '2017-11-06 10:55:02', '192.168.1.66', '隐藏banner', 2, NULL, '成功', '', 'yincang', 'Notice', 'Noticeyincang');
INSERT INTO `adminlog` VALUES (267, 3, '2017-11-06 10:55:09', '192.168.1.66', '显示banner', 2, NULL, '成功', '', 'xianshi', 'Notice', 'Noticexianshi');
INSERT INTO `adminlog` VALUES (268, 3, '2017-11-06 10:55:13', '192.168.1.66', '隐藏banner', 2, NULL, '成功', '', 'yincang', 'Notice', 'Noticeyincang');
INSERT INTO `adminlog` VALUES (269, 3, '2017-11-06 11:56:51', '192.168.1.66', '添加banner', 4, NULL, '成功', '', 'dataAdd_Sub', 'Notice', 'NoticedataAdd_Sub');
INSERT INTO `adminlog` VALUES (270, 3, '2017-11-06 11:57:03', '192.168.1.66', '删除banenr', 0, NULL, '成功', '', 'dataDel', 'Notice', 'NoticedataDel');
INSERT INTO `adminlog` VALUES (271, 3, '2017-11-06 13:51:28', '192.168.1.66', '添加banner', 5, NULL, '成功', '', 'dataAdd_Sub', 'Notice', 'NoticedataAdd_Sub');
INSERT INTO `adminlog` VALUES (272, 3, '2017-11-06 13:52:24', '192.168.1.66', '添加banner', 6, NULL, '成功', '', 'dataAdd_Sub', 'Notice', 'NoticedataAdd_Sub');
INSERT INTO `adminlog` VALUES (273, 3, '2017-11-06 13:53:05', '192.168.1.66', '删除banenr', 0, NULL, '成功', '', 'dataDel', 'Notice', 'NoticedataDel');
INSERT INTO `adminlog` VALUES (274, 3, '2017-11-06 13:53:08', '192.168.1.66', '删除banenr', 0, NULL, '成功', '', 'dataDel', 'Notice', 'NoticedataDel');
INSERT INTO `adminlog` VALUES (275, 3, '2017-11-06 13:53:16', '192.168.1.66', '添加banner', 7, NULL, '成功', '', 'dataAdd_Sub', 'Notice', 'NoticedataAdd_Sub');
INSERT INTO `adminlog` VALUES (276, 3, '2017-11-06 13:53:53', '192.168.1.66', '添加banner', 8, NULL, '成功', '', 'dataAdd_Sub', 'Notice', 'NoticedataAdd_Sub');
INSERT INTO `adminlog` VALUES (277, 3, '2017-11-06 13:54:18', '192.168.1.66', '删除banenr', 0, NULL, '成功', '', 'dataDel', 'Notice', 'NoticedataDel');
INSERT INTO `adminlog` VALUES (278, 3, '2017-11-06 13:55:46', '192.168.1.66', '添加banner', 9, NULL, '成功', '', 'dataAdd_Sub', 'Notice', 'NoticedataAdd_Sub');
INSERT INTO `adminlog` VALUES (279, 3, '2017-11-06 13:56:04', '192.168.1.66', '添加banner', 10, NULL, '成功', '', 'dataAdd_Sub', 'Notice', 'NoticedataAdd_Sub');
INSERT INTO `adminlog` VALUES (280, 3, '2017-11-06 13:56:16', '192.168.1.66', '删除banenr', 0, NULL, '成功', '', 'dataDel', 'Notice', 'NoticedataDel');
INSERT INTO `adminlog` VALUES (281, 3, '2017-11-06 13:56:20', '192.168.1.66', '显示banner', 2, NULL, '成功', '', 'xianshi', 'Notice', 'Noticexianshi');
INSERT INTO `adminlog` VALUES (282, 3, '2017-11-06 13:58:27', '192.168.1.66', '隐藏banner', 9, NULL, '成功', '', 'yincang', 'Notice', 'Noticeyincang');
INSERT INTO `adminlog` VALUES (283, 3, '2017-11-06 13:58:31', '192.168.1.66', '显示banner', 10, NULL, '成功', '', 'xianshi', 'Notice', 'Noticexianshi');
INSERT INTO `adminlog` VALUES (284, 3, '2017-11-06 14:06:35', '192.168.1.66', '删除banenr', 0, NULL, '成功', '', 'dataDel', 'Notice', 'NoticedataDel');
INSERT INTO `adminlog` VALUES (285, 3, '2017-11-06 14:06:52', '192.168.1.66', '添加banner', 11, NULL, '成功', '', 'dataAdd_Sub', 'Notice', 'NoticedataAdd_Sub');
INSERT INTO `adminlog` VALUES (286, 3, '2017-11-06 14:06:57', '192.168.1.66', '删除banenr', 0, NULL, '成功', '', 'dataDel', 'Notice', 'NoticedataDel');
INSERT INTO `adminlog` VALUES (287, 3, '2017-11-06 18:21:00', '192.168.1.66', '隐藏banner', 10, NULL, '成功', '', 'yincang', 'Notice', 'Noticeyincang');
INSERT INTO `adminlog` VALUES (288, NULL, '2017-11-07 08:45:20', '192.168.1.66', '登录', 0, NULL, '失败', '账户不存在，登录账户为：admin	', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (289, NULL, '2017-11-07 08:45:24', '192.168.1.66', '登录', 0, NULL, '失败', '账户不存在，登录账户为：admin	', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (290, NULL, '2017-11-07 08:45:46', '192.168.1.66', '登录', 0, NULL, '失败', '账户不存在，登录账户为：admin	', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (291, NULL, '2017-11-07 08:45:53', '192.168.1.66', '登录', 0, NULL, '失败', '密码错误（第1次）', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (292, 3, '2017-11-07 08:45:58', '192.168.1.66', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (293, 3, '2017-11-07 08:55:26', '192.168.1.66', '编辑banner', 10, NULL, '成功', '', 'dataEdit_Sub', 'Notice', 'NoticedataEdit_Sub');
INSERT INTO `adminlog` VALUES (294, 3, '2017-11-07 08:55:37', '192.168.1.66', '编辑banner', 10, NULL, '成功', '', 'dataEdit_Sub', 'Notice', 'NoticedataEdit_Sub');
INSERT INTO `adminlog` VALUES (295, 3, '2017-11-07 08:55:52', '192.168.1.66', '编辑banner', 10, NULL, '成功', '', 'dataEdit_Sub', 'Notice', 'NoticedataEdit_Sub');
INSERT INTO `adminlog` VALUES (296, 3, '2017-11-07 08:55:58', '192.168.1.66', '编辑banner', 10, NULL, '成功', '', 'dataEdit_Sub', 'Notice', 'NoticedataEdit_Sub');
INSERT INTO `adminlog` VALUES (297, 3, '2017-11-07 08:56:07', '192.168.1.66', '编辑banner', 10, NULL, '成功', '', 'dataEdit_Sub', 'Notice', 'NoticedataEdit_Sub');
INSERT INTO `adminlog` VALUES (298, 3, '2017-11-07 08:56:29', '192.168.1.66', '编辑banner', 10, NULL, '成功', '', 'dataEdit_Sub', 'Notice', 'NoticedataEdit_Sub');
INSERT INTO `adminlog` VALUES (299, 3, '2017-11-07 08:56:36', '192.168.1.66', '编辑banner', 10, NULL, '成功', '', 'dataEdit_Sub', 'Notice', 'NoticedataEdit_Sub');
INSERT INTO `adminlog` VALUES (300, 3, '2017-11-07 10:32:37', '192.168.1.66', '隐藏腰图', 1, NULL, '成功', '', 'yincangYaotu', 'Notice', 'NoticeyincangYaotu');
INSERT INTO `adminlog` VALUES (301, 3, '2017-11-07 10:32:40', '192.168.1.66', '显示腰图', 1, NULL, '成功', '', 'xianshiYaotu', 'Notice', 'NoticexianshiYaotu');
INSERT INTO `adminlog` VALUES (302, 3, '2017-11-07 10:43:42', '192.168.1.66', '隐藏腰图', 1, NULL, '成功', '', 'yincangYaotu', 'Notice', 'NoticeyincangYaotu');
INSERT INTO `adminlog` VALUES (303, 3, '2017-11-07 10:43:45', '192.168.1.66', '显示腰图', 1, NULL, '成功', '', 'xianshiYaotu', 'Notice', 'NoticexianshiYaotu');
INSERT INTO `adminlog` VALUES (304, 3, '2017-11-07 10:50:15', '192.168.1.66', '编辑腰图', 1, NULL, '成功', '', 'dataEditYaotu_Sub', 'Notice', 'NoticedataEditYaotu_Sub');
INSERT INTO `adminlog` VALUES (305, 3, '2017-11-07 10:53:34', '192.168.1.66', '添加腰图', 2, NULL, '成功', '', 'dataAddYaotu_Sub', 'Notice', 'NoticedataAddYaotu_Sub');
INSERT INTO `adminlog` VALUES (306, 3, '2017-11-07 10:53:39', '192.168.1.66', '显示腰图', 2, NULL, '成功', '', 'xianshiYaotu', 'Notice', 'NoticexianshiYaotu');
INSERT INTO `adminlog` VALUES (307, 3, '2017-11-07 11:01:53', '192.168.1.66', '添加活动推送', 3, NULL, '成功', '', 'dataAddHuodong_Sub', 'Notice', 'NoticedataAddHuodong_Sub');
INSERT INTO `adminlog` VALUES (308, 3, '2017-11-07 11:02:41', '192.168.1.66', '删除banenr', 0, NULL, '成功', '', 'dataDel', 'Notice', 'NoticedataDel');
INSERT INTO `adminlog` VALUES (309, 3, '2017-11-07 11:05:40', '192.168.1.66', '删除banenr', 0, NULL, '成功', '', 'dataDelHuodong', 'Notice', 'NoticedataDelHuodong');
INSERT INTO `adminlog` VALUES (310, 3, '2017-11-07 15:57:20', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (311, NULL, '2017-11-07 17:21:27', '::1', '登录', 0, NULL, '失败', '账户已被锁定', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (312, NULL, '2017-11-07 17:21:33', '::1', '登录', 0, NULL, '失败', '账户已被锁定', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (313, 20, '2017-11-07 17:21:58', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (314, NULL, '2017-11-07 17:28:24', '::1', '退出登录', 0, NULL, '成功', '', 'login_Out', 'Index', 'Indexlogin_Out');
INSERT INTO `adminlog` VALUES (315, 20, '2017-11-07 17:28:57', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (316, 3, '2017-11-07 18:13:59', '192.168.1.66', '隐藏腰图', 1, NULL, '成功', '', 'yincangYaotu', 'Notice', 'NoticeyincangYaotu');
INSERT INTO `adminlog` VALUES (317, 3, '2017-11-07 18:20:18', '192.168.1.66', '显示腰图', 1, NULL, '成功', '', 'xianshiYaotu', 'Notice', 'NoticexianshiYaotu');
INSERT INTO `adminlog` VALUES (318, 3, '2017-11-07 18:20:22', '192.168.1.66', '隐藏腰图', 2, NULL, '成功', '', 'yincangYaotu', 'Notice', 'NoticeyincangYaotu');
INSERT INTO `adminlog` VALUES (319, 3, '2017-11-07 18:25:40', '192.168.1.66', '显示腰图', 2, NULL, '成功', '', 'xianshiYaotu', 'Notice', 'NoticexianshiYaotu');
INSERT INTO `adminlog` VALUES (320, 3, '2017-11-07 18:25:42', '192.168.1.66', '隐藏腰图', 2, NULL, '成功', '', 'yincangYaotu', 'Notice', 'NoticeyincangYaotu');
INSERT INTO `adminlog` VALUES (321, 20, '2017-11-08 09:17:40', '192.168.1.66', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (322, 20, '2017-11-08 15:48:00', '192.168.1.66', '显示banner', 10, NULL, '成功', '', 'xianshi', 'Notice', 'Noticexianshi');
INSERT INTO `adminlog` VALUES (323, 20, '2017-11-08 15:48:34', '192.168.1.66', '隐藏banner', 10, NULL, '成功', '', 'yincang', 'Notice', 'Noticeyincang');
INSERT INTO `adminlog` VALUES (324, 20, '2017-11-09 10:23:14', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (325, 20, '2017-11-09 13:03:41', '::1', '编辑banner', 10, NULL, '成功', '', 'dataEdit_Sub', 'Notice', 'NoticedataEdit_Sub');
INSERT INTO `adminlog` VALUES (326, 20, '2017-11-09 17:20:16', '::1', '显示腰图', 2, NULL, '成功', '', 'xianshiYaotu', 'Notice', 'NoticexianshiYaotu');
INSERT INTO `adminlog` VALUES (327, 20, '2017-11-09 17:20:18', '::1', '隐藏腰图', 2, NULL, '成功', '', 'yincangYaotu', 'Notice', 'NoticeyincangYaotu');
INSERT INTO `adminlog` VALUES (328, 20, '2017-11-09 17:25:51', '::1', '显示腰图', 2, NULL, '成功', '', 'xianshiYaotu', 'Notice', 'NoticexianshiYaotu');
INSERT INTO `adminlog` VALUES (329, 20, '2017-11-09 17:25:54', '::1', '隐藏腰图', 2, NULL, '成功', '', 'yincangYaotu', 'Notice', 'NoticeyincangYaotu');
INSERT INTO `adminlog` VALUES (330, 20, '2017-11-09 17:25:58', '::1', '显示腰图', 2, NULL, '成功', '', 'xianshiYaotu', 'Notice', 'NoticexianshiYaotu');
INSERT INTO `adminlog` VALUES (331, 20, '2017-11-09 17:26:01', '::1', '隐藏腰图', 2, NULL, '成功', '', 'yincangYaotu', 'Notice', 'NoticeyincangYaotu');
INSERT INTO `adminlog` VALUES (332, 20, '2017-11-09 17:26:03', '::1', '显示腰图', 2, NULL, '成功', '', 'xianshiYaotu', 'Notice', 'NoticexianshiYaotu');
INSERT INTO `adminlog` VALUES (333, 20, '2017-11-09 17:26:05', '::1', '隐藏腰图', 2, NULL, '成功', '', 'yincangYaotu', 'Notice', 'NoticeyincangYaotu');
INSERT INTO `adminlog` VALUES (334, 20, '2017-11-09 17:26:15', '::1', '隐藏腰图', 1, NULL, '成功', '', 'yincangYaotu', 'Notice', 'NoticeyincangYaotu');
INSERT INTO `adminlog` VALUES (335, 20, '2017-11-09 17:26:17', '::1', '显示腰图', 1, NULL, '成功', '', 'xianshiYaotu', 'Notice', 'NoticexianshiYaotu');
INSERT INTO `adminlog` VALUES (336, 20, '2017-11-13 09:56:52', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (337, 20, '2017-11-13 09:57:25', '::1', '编辑腰图', 2, NULL, '成功', '', 'dataEditYaotu_Sub', 'Notice', 'NoticedataEditYaotu_Sub');
INSERT INTO `adminlog` VALUES (338, 20, '2017-11-13 09:57:38', '::1', '显示banner', 10, NULL, '成功', '', 'xianshi', 'Notice', 'Noticexianshi');
INSERT INTO `adminlog` VALUES (339, 20, '2017-11-13 09:57:40', '::1', '隐藏banner', 10, NULL, '成功', '', 'yincang', 'Notice', 'Noticeyincang');
INSERT INTO `adminlog` VALUES (340, 20, '2017-11-13 09:58:21', '::1', '退出登录', 0, NULL, '成功', '', 'login_Out', 'Index', 'Indexlogin_Out');
INSERT INTO `adminlog` VALUES (341, 20, '2017-11-13 09:58:34', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (342, 20, '2017-11-13 10:00:14', '::1', '编辑banner', 10, NULL, '成功', '', 'dataEdit_Sub', 'Notice', 'NoticedataEdit_Sub');
INSERT INTO `adminlog` VALUES (343, 20, '2017-11-13 11:53:45', '::1', '教师上线', 6, NULL, '成功', '', 'xianshi', 'Teacher', 'Teacherxianshi');
INSERT INTO `adminlog` VALUES (344, 20, '2017-11-13 11:54:19', '::1', '教师下线', 6, NULL, '成功', '', 'yincang', 'Teacher', 'Teacheryincang');
INSERT INTO `adminlog` VALUES (345, 20, '2017-11-13 11:54:20', '::1', '教师上线', 6, NULL, '成功', '', 'xianshi', 'Teacher', 'Teacherxianshi');
INSERT INTO `adminlog` VALUES (346, 20, '2017-11-13 11:54:23', '::1', '教师下线', 6, NULL, '成功', '', 'yincang', 'Teacher', 'Teacheryincang');
INSERT INTO `adminlog` VALUES (347, 20, '2017-11-13 11:56:20', '::1', '教师上线', 6, NULL, '成功', '', 'xianshi', 'Teacher', 'Teacherxianshi');
INSERT INTO `adminlog` VALUES (348, 20, '2017-11-13 11:56:23', '::1', '教师下线', 6, NULL, '成功', '', 'yincang', 'Teacher', 'Teacheryincang');
INSERT INTO `adminlog` VALUES (349, 20, '2017-11-13 11:56:45', '::1', '教师上线', 6, NULL, '成功', '', 'xianshi', 'Teacher', 'Teacherxianshi');
INSERT INTO `adminlog` VALUES (350, 20, '2017-11-13 11:56:48', '::1', '教师下线', 6, NULL, '成功', '', 'yincang', 'Teacher', 'Teacheryincang');
INSERT INTO `adminlog` VALUES (351, 20, '2017-11-13 13:37:47', '::1', '教师上线', 6, NULL, '成功', '', 'xianshi', 'Teacher', 'Teacherxianshi');
INSERT INTO `adminlog` VALUES (352, 20, '2017-11-14 09:16:15', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (353, 20, '2017-11-14 09:16:33', '::1', '添加banner', 12, NULL, '成功', '', 'dataAdd_Sub', 'Notice', 'NoticedataAdd_Sub');
INSERT INTO `adminlog` VALUES (354, 20, '2017-11-14 09:16:39', '::1', '隐藏banner', 12, NULL, '成功', '', 'yincang', 'Notice', 'Noticeyincang');
INSERT INTO `adminlog` VALUES (355, 20, '2017-11-14 13:00:08', '::1', '显示banner', 12, NULL, '成功', '', 'xianshi', 'Notice', 'Noticexianshi');
INSERT INTO `adminlog` VALUES (356, 20, '2017-11-14 13:00:11', '::1', '隐藏banner', 12, NULL, '成功', '', 'yincang', 'Notice', 'Noticeyincang');
INSERT INTO `adminlog` VALUES (357, 20, '2017-11-15 08:51:15', '192.168.1.66', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (358, NULL, '2017-11-16 08:44:00', '::1', '登录', 0, NULL, '失败', '密码错误（第1次）', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (359, 20, '2017-11-16 08:44:04', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (360, 20, '2017-11-16 08:48:46', '::1', '教师下线', 1, NULL, '成功', '', 'yincang', 'Teacher', 'Teacheryincang');
INSERT INTO `adminlog` VALUES (361, 20, '2017-11-16 08:52:37', '::1', '取消推荐视频', 1, NULL, '成功', '', 'yincang', 'Video', 'Videoyincang');
INSERT INTO `adminlog` VALUES (362, 20, '2017-11-16 08:52:40', '::1', '取消推荐视频', 1, NULL, '成功', '', 'yincang', 'Video', 'Videoyincang');
INSERT INTO `adminlog` VALUES (363, 20, '2017-11-16 08:52:43', '::1', '推荐视频', 4, NULL, '成功', '', 'xianshi', 'Video', 'Videoxianshi');
INSERT INTO `adminlog` VALUES (364, 20, '2017-11-16 08:52:47', '::1', '推荐视频', 4, NULL, '成功', '', 'xianshi', 'Video', 'Videoxianshi');
INSERT INTO `adminlog` VALUES (365, 20, '2017-11-16 08:53:24', '::1', '取消推荐视频', 1, NULL, '成功', '', 'yincang', 'Video', 'Videoyincang');
INSERT INTO `adminlog` VALUES (366, 20, '2017-11-16 08:53:26', '::1', '推荐视频', 1, NULL, '成功', '', 'xianshi', 'Video', 'Videoxianshi');
INSERT INTO `adminlog` VALUES (367, 20, '2017-11-16 08:53:29', '::1', '推荐视频', 4, NULL, '成功', '', 'xianshi', 'Video', 'Videoxianshi');
INSERT INTO `adminlog` VALUES (368, 20, '2017-11-16 08:53:31', '::1', '取消推荐视频', 4, NULL, '成功', '', 'yincang', 'Video', 'Videoyincang');
INSERT INTO `adminlog` VALUES (369, 20, '2017-11-16 08:53:33', '::1', '取消推荐视频', 3, NULL, '成功', '', 'yincang', 'Video', 'Videoyincang');
INSERT INTO `adminlog` VALUES (370, 20, '2017-11-16 08:53:36', '::1', '取消推荐视频', 2, NULL, '成功', '', 'yincang', 'Video', 'Videoyincang');
INSERT INTO `adminlog` VALUES (371, 20, '2017-11-16 08:53:37', '::1', '取消推荐视频', 1, NULL, '成功', '', 'yincang', 'Video', 'Videoyincang');
INSERT INTO `adminlog` VALUES (372, 20, '2017-11-16 08:53:40', '::1', '推荐视频', 1, NULL, '成功', '', 'xianshi', 'Video', 'Videoxianshi');
INSERT INTO `adminlog` VALUES (373, 20, '2017-11-16 09:00:40', '::1', '推荐视频', 2, NULL, '成功', '', 'xianshi', 'Video', 'Videoxianshi');
INSERT INTO `adminlog` VALUES (374, 20, '2017-11-16 09:00:43', '::1', '推荐视频', 3, NULL, '成功', '', 'xianshi', 'Video', 'Videoxianshi');
INSERT INTO `adminlog` VALUES (375, 20, '2017-11-16 09:01:37', '::1', '取消推荐视频', 2, NULL, '成功', '', 'yincang', 'Video', 'Videoyincang');
INSERT INTO `adminlog` VALUES (376, 20, '2017-11-16 09:01:41', '::1', '推荐视频', 2, NULL, '成功', '', 'xianshi', 'Video', 'Videoxianshi');
INSERT INTO `adminlog` VALUES (377, 20, '2017-11-16 09:01:44', '::1', '推荐视频', 4, NULL, '成功', '', 'xianshi', 'Video', 'Videoxianshi');
INSERT INTO `adminlog` VALUES (378, 20, '2017-11-16 09:01:46', '::1', '取消推荐视频', 3, NULL, '成功', '', 'yincang', 'Video', 'Videoyincang');
INSERT INTO `adminlog` VALUES (379, 20, '2017-11-16 09:01:48', '::1', '取消推荐视频', 2, NULL, '成功', '', 'yincang', 'Video', 'Videoyincang');
INSERT INTO `adminlog` VALUES (380, 20, '2017-11-16 09:01:50', '::1', '取消推荐视频', 1, NULL, '成功', '', 'yincang', 'Video', 'Videoyincang');
INSERT INTO `adminlog` VALUES (381, 20, '2017-11-16 09:01:52', '::1', '推荐视频', 2, NULL, '成功', '', 'xianshi', 'Video', 'Videoxianshi');
INSERT INTO `adminlog` VALUES (382, 20, '2017-11-16 11:40:27', '::1', '推荐视频', 1, NULL, '成功', '', 'xianshi', 'Video', 'Videoxianshi');
INSERT INTO `adminlog` VALUES (383, 20, '2017-11-16 11:40:30', '::1', '取消推荐视频', 1, NULL, '成功', '', 'yincang', 'Video', 'Videoyincang');
INSERT INTO `adminlog` VALUES (384, 20, '2017-11-17 09:28:36', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (385, 20, '2017-11-17 09:28:44', '::1', '推荐视频', 1, NULL, '成功', '', 'xianshi', 'Video', 'Videoxianshi');
INSERT INTO `adminlog` VALUES (386, 20, '2017-11-17 09:58:20', '::1', '下线视频', 3, NULL, '成功', '', 'xiaxian', 'Video', 'Videoxiaxian');
INSERT INTO `adminlog` VALUES (387, 20, '2017-11-17 09:58:24', '::1', '上线视频', 2, NULL, '成功', '', 'shangxian', 'Video', 'Videoshangxian');
INSERT INTO `adminlog` VALUES (388, 20, '2017-11-17 09:59:06', '::1', '上线视频', 1, NULL, '成功', '', 'shangxian', 'Video', 'Videoshangxian');
INSERT INTO `adminlog` VALUES (389, 20, '2017-11-17 10:01:07', '::1', '上线视频', 1, NULL, '成功', '', 'shangxian', 'Video', 'Videoshangxian');
INSERT INTO `adminlog` VALUES (390, 20, '2017-11-17 10:01:10', '::1', '上线视频', 1, NULL, '成功', '', 'shangxian', 'Video', 'Videoshangxian');
INSERT INTO `adminlog` VALUES (391, 20, '2017-11-17 10:01:15', '::1', '下线视频', 3, NULL, '成功', '', 'xiaxian', 'Video', 'Videoxiaxian');
INSERT INTO `adminlog` VALUES (392, 20, '2017-11-17 10:04:07', '::1', '下线视频', 1, NULL, '成功', '', 'xiaxian', 'Video', 'Videoxiaxian');
INSERT INTO `adminlog` VALUES (393, 20, '2017-11-17 10:04:44', '::1', '上线视频', 1, NULL, '成功', '', 'shangxian', 'Video', 'Videoshangxian');
INSERT INTO `adminlog` VALUES (394, 20, '2017-11-17 10:07:25', '::1', '下线视频', 1, NULL, '成功', '', 'xiaxian', 'Video', 'Videoxiaxian');
INSERT INTO `adminlog` VALUES (395, 20, '2017-11-17 10:07:27', '::1', '上线视频', 1, NULL, '成功', '', 'shangxian', 'Video', 'Videoshangxian');
INSERT INTO `adminlog` VALUES (396, 20, '2017-11-17 10:07:33', '::1', '上线视频', 3, NULL, '成功', '', 'shangxian', 'Video', 'Videoshangxian');
INSERT INTO `adminlog` VALUES (397, 20, '2017-11-17 10:07:39', '::1', '取消推荐视频', 1, NULL, '成功', '', 'yincang', 'Video', 'Videoyincang');
INSERT INTO `adminlog` VALUES (398, 20, '2017-11-17 10:07:41', '::1', '下线视频', 1, NULL, '成功', '', 'xiaxian', 'Video', 'Videoxiaxian');
INSERT INTO `adminlog` VALUES (399, 20, '2017-11-17 10:07:46', '::1', '下线视频', 2, NULL, '成功', '', 'xiaxian', 'Video', 'Videoxiaxian');
INSERT INTO `adminlog` VALUES (400, 20, '2017-11-17 15:59:39', '::1', '显示banner', 12, NULL, '成功', '', 'xianshi', 'Notice', 'Noticexianshi');
INSERT INTO `adminlog` VALUES (401, 20, '2017-11-17 16:04:06', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (402, 20, '2017-11-20 13:36:54', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (403, 20, '2017-11-20 13:37:12', '::1', '上线视频', 1, NULL, '成功', '', 'shangxian', 'Video', 'Videoshangxian');
INSERT INTO `adminlog` VALUES (404, 20, '2017-11-20 13:37:14', '::1', '下线视频', 1, NULL, '成功', '', 'xiaxian', 'Video', 'Videoxiaxian');
INSERT INTO `adminlog` VALUES (405, NULL, '2017-11-20 14:33:18', '::1', '登录', 0, NULL, '失败', '账户不存在，登录账户为：str', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (406, 20, '2017-11-20 14:33:25', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (407, 20, '2017-11-20 14:34:43', '::1', '上线视频', 1, NULL, '成功', '', 'shangxian', 'Video', 'Videoshangxian');
INSERT INTO `adminlog` VALUES (408, 20, '2017-11-20 14:34:47', '::1', '推荐视频', 1, NULL, '成功', '', 'xianshi', 'Video', 'Videoxianshi');
INSERT INTO `adminlog` VALUES (409, 20, '2017-11-20 15:59:39', '::1', '退出登录', 0, NULL, '成功', '', 'login_Out', 'Index', 'Indexlogin_Out');
INSERT INTO `adminlog` VALUES (410, NULL, '2017-11-20 15:59:42', '::1', '登录', 0, NULL, '失败', '密码错误（第1次）', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (411, NULL, '2017-11-20 15:59:43', '::1', '登录', 0, NULL, '失败', '密码错误（第2次）', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (412, 20, '2017-11-20 15:59:48', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (413, 20, '2017-11-22 10:50:36', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (414, NULL, '2017-11-28 09:46:00', '::1', '登录', 0, NULL, '失败', '账户不存在，登录账户为：str', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (415, NULL, '2017-11-28 09:46:02', '::1', '登录', 0, NULL, '失败', '账户不存在，登录账户为：str', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (416, NULL, '2017-11-28 09:46:10', '::1', '登录', 0, NULL, '失败', '密码错误（第1次）', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (417, NULL, '2017-11-28 09:46:15', '::1', '登录', 0, NULL, '失败', '账户不存在，登录账户为：as', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (418, NULL, '2017-11-28 09:46:19', '::1', '登录', 0, NULL, '失败', '账户不存在，登录账户为：gh', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (419, 20, '2017-11-28 09:49:47', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (420, NULL, '2017-12-04 10:59:45', '::1', '登录', 0, NULL, '失败', '密码错误（第1次）', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (421, 20, '2017-12-04 11:00:03', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (422, 20, '2017-12-04 11:07:37', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (423, 20, '2017-12-04 11:08:18', '::1', '退出登录', 0, NULL, '成功', '', 'login_Out', 'Index', 'Indexlogin_Out');
INSERT INTO `adminlog` VALUES (424, 20, '2017-12-04 11:16:39', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (425, 20, '2017-12-04 11:33:00', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (426, 20, '2017-12-04 12:01:02', '::1', '编辑banner', 12, NULL, '成功', '', 'dataEdit_Sub', 'Notice', 'NoticedataEdit_Sub');
INSERT INTO `adminlog` VALUES (427, 20, '2017-12-04 12:34:31', '::1', '编辑banner', 3, NULL, '成功', '', 'dataEdit_Sub', 'Notice', 'NoticedataEdit_Sub');
INSERT INTO `adminlog` VALUES (428, 20, '2017-12-04 13:34:38', '::1', '隐藏banner', 12, NULL, '成功', '', 'yincang', 'Notice', 'Noticeyincang');
INSERT INTO `adminlog` VALUES (429, 20, '2017-12-04 13:34:42', '::1', '显示banner', 12, NULL, '成功', '', 'xianshi', 'Notice', 'Noticexianshi');
INSERT INTO `adminlog` VALUES (430, 20, '2017-12-04 13:48:20', '::1', '删除banenr', 0, NULL, '成功', '', 'dataDel', 'Notice', 'NoticedataDel');
INSERT INTO `adminlog` VALUES (431, 20, '2017-12-04 13:49:01', '::1', '显示banner', 10, NULL, '成功', '', 'xianshi', 'Notice', 'Noticexianshi');
INSERT INTO `adminlog` VALUES (432, 20, '2017-12-04 13:49:04', '::1', '隐藏banner', 10, NULL, '成功', '', 'yincang', 'Notice', 'Noticeyincang');
INSERT INTO `adminlog` VALUES (433, 20, '2017-12-04 14:41:36', '::1', '添加活动推送', 4, NULL, '成功', '', 'dataAddHuodong_Sub', 'Notice', 'NoticedataAddHuodong_Sub');
INSERT INTO `adminlog` VALUES (434, 20, '2017-12-04 14:42:29', '::1', '编辑腰图', 1, NULL, '成功', '', 'dataEditYaotu_Sub', 'Notice', 'NoticedataEditYaotu_Sub');
INSERT INTO `adminlog` VALUES (435, 20, '2017-12-05 10:03:46', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (436, 20, '2017-12-05 10:50:11', '::1', '下架商品', 45, NULL, '成功', '', 'xiajia', 'Shop', 'Shopxiajia');
INSERT INTO `adminlog` VALUES (437, 20, '2017-12-05 10:50:15', '::1', '上架商品', 45, NULL, '成功', '', 'shangjia', 'Shop', 'Shopshangjia');
INSERT INTO `adminlog` VALUES (438, 20, '2017-12-05 14:15:25', '::1', '添加banner', 15, NULL, '成功', '', 'dataAdd_Sub', 'Notice', 'NoticedataAdd_Sub');
INSERT INTO `adminlog` VALUES (439, 20, '2017-12-05 14:50:13', '::1', '退出登录', 0, NULL, '成功', '', 'login_Out', 'Index', 'Indexlogin_Out');
INSERT INTO `adminlog` VALUES (440, 21, '2017-12-05 14:50:21', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (441, NULL, '2017-12-06 08:31:59', '::1', '登录', 0, NULL, '失败', '密码错误（第1次）', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (442, 20, '2017-12-06 08:32:37', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (443, 20, '2017-12-06 11:26:15', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (444, 20, '2017-12-06 11:27:01', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (445, 20, '2017-12-07 08:42:25', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (446, 20, '2017-12-08 08:46:34', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (447, 20, '2017-12-08 09:00:11', '::1', '隐藏banner', 1, NULL, '成功', '', 'yincang', 'Notice', 'Noticeyincang');
INSERT INTO `adminlog` VALUES (448, 20, '2017-12-08 09:00:25', '::1', '编辑banner', 1, NULL, '成功', '', 'dataEdit_Sub', 'Notice', 'NoticedataEdit_Sub');
INSERT INTO `adminlog` VALUES (449, 20, '2017-12-08 09:00:34', '::1', '编辑banner', 10, NULL, '成功', '', 'dataEdit_Sub', 'Notice', 'NoticedataEdit_Sub');
INSERT INTO `adminlog` VALUES (450, 20, '2017-12-08 09:01:44', '::1', '添加banner', 16, NULL, '成功', '', 'dataAdd_Sub', 'Notice', 'NoticedataAdd_Sub');
INSERT INTO `adminlog` VALUES (451, 20, '2017-12-08 09:04:54', '::1', '删除消息推送', 0, NULL, '成功', '', 'dataDelXiaoxi', 'Notice', 'NoticedataDelXiaoxi');
INSERT INTO `adminlog` VALUES (452, 20, '2017-12-08 09:56:21', '::1', '隐藏腰图', 1, NULL, '成功', '', 'yincangYaotu', 'Notice', 'NoticeyincangYaotu');
INSERT INTO `adminlog` VALUES (453, 20, '2017-12-08 10:49:49', '::1', '删除消息推送', 0, NULL, '成功', '', 'dataDelXiaoxi', 'Notice', 'NoticedataDelXiaoxi');
INSERT INTO `adminlog` VALUES (454, 20, '2017-12-08 10:49:52', '::1', '删除消息推送', 0, NULL, '成功', '', 'dataDelXiaoxi', 'Notice', 'NoticedataDelXiaoxi');
INSERT INTO `adminlog` VALUES (455, 20, '2017-12-08 10:49:54', '::1', '删除消息推送', 0, NULL, '成功', '', 'dataDelXiaoxi', 'Notice', 'NoticedataDelXiaoxi');
INSERT INTO `adminlog` VALUES (456, 20, '2017-12-08 10:49:56', '::1', '删除消息推送', 0, NULL, '成功', '', 'dataDelXiaoxi', 'Notice', 'NoticedataDelXiaoxi');
INSERT INTO `adminlog` VALUES (457, 20, '2017-12-08 10:59:19', '::1', '消息推送', 5, NULL, '成功', '', 'dataTuiXiaoxi', 'Notice', 'NoticedataTuiXiaoxi');
INSERT INTO `adminlog` VALUES (458, 20, '2017-12-08 10:59:19', '::1', '消息推送', 5, NULL, '成功', '', 'dataTuiXiaoxi', 'Notice', 'NoticedataTuiXiaoxi');
INSERT INTO `adminlog` VALUES (459, 20, '2017-12-08 10:59:20', '::1', '消息推送', 5, NULL, '成功', '', 'dataTuiXiaoxi', 'Notice', 'NoticedataTuiXiaoxi');
INSERT INTO `adminlog` VALUES (460, 20, '2017-12-08 10:59:20', '::1', '消息推送', 5, NULL, '成功', '', 'dataTuiXiaoxi', 'Notice', 'NoticedataTuiXiaoxi');
INSERT INTO `adminlog` VALUES (461, 20, '2017-12-08 10:59:20', '::1', '消息推送', 5, NULL, '成功', '', 'dataTuiXiaoxi', 'Notice', 'NoticedataTuiXiaoxi');
INSERT INTO `adminlog` VALUES (462, 20, '2017-12-08 10:59:20', '::1', '消息推送', 5, NULL, '成功', '', 'dataTuiXiaoxi', 'Notice', 'NoticedataTuiXiaoxi');
INSERT INTO `adminlog` VALUES (463, 20, '2017-12-08 10:59:21', '::1', '消息推送', 5, NULL, '成功', '', 'dataTuiXiaoxi', 'Notice', 'NoticedataTuiXiaoxi');
INSERT INTO `adminlog` VALUES (464, 20, '2017-12-08 10:59:21', '::1', '消息推送', 5, NULL, '成功', '', 'dataTuiXiaoxi', 'Notice', 'NoticedataTuiXiaoxi');
INSERT INTO `adminlog` VALUES (465, 20, '2017-12-08 10:59:21', '::1', '消息推送', 5, NULL, '成功', '', 'dataTuiXiaoxi', 'Notice', 'NoticedataTuiXiaoxi');
INSERT INTO `adminlog` VALUES (466, 20, '2017-12-08 10:59:21', '::1', '消息推送', 5, NULL, '成功', '', 'dataTuiXiaoxi', 'Notice', 'NoticedataTuiXiaoxi');
INSERT INTO `adminlog` VALUES (467, 20, '2017-12-08 10:59:21', '::1', '消息推送', 5, NULL, '成功', '', 'dataTuiXiaoxi', 'Notice', 'NoticedataTuiXiaoxi');
INSERT INTO `adminlog` VALUES (468, 20, '2017-12-08 10:59:27', '::1', '消息推送', 5, NULL, '成功', '', 'dataTuiXiaoxi', 'Notice', 'NoticedataTuiXiaoxi');
INSERT INTO `adminlog` VALUES (469, 20, '2017-12-08 10:59:28', '::1', '消息推送', 5, NULL, '成功', '', 'dataTuiXiaoxi', 'Notice', 'NoticedataTuiXiaoxi');
INSERT INTO `adminlog` VALUES (470, 20, '2017-12-08 10:59:28', '::1', '消息推送', 5, NULL, '成功', '', 'dataTuiXiaoxi', 'Notice', 'NoticedataTuiXiaoxi');
INSERT INTO `adminlog` VALUES (471, 20, '2017-12-08 10:59:28', '::1', '消息推送', 5, NULL, '成功', '', 'dataTuiXiaoxi', 'Notice', 'NoticedataTuiXiaoxi');
INSERT INTO `adminlog` VALUES (472, 20, '2017-12-08 10:59:29', '::1', '消息推送', 5, NULL, '成功', '', 'dataTuiXiaoxi', 'Notice', 'NoticedataTuiXiaoxi');
INSERT INTO `adminlog` VALUES (473, 20, '2017-12-08 10:59:29', '::1', '消息推送', 5, NULL, '成功', '', 'dataTuiXiaoxi', 'Notice', 'NoticedataTuiXiaoxi');
INSERT INTO `adminlog` VALUES (474, 20, '2017-12-08 10:59:29', '::1', '消息推送', 5, NULL, '成功', '', 'dataTuiXiaoxi', 'Notice', 'NoticedataTuiXiaoxi');
INSERT INTO `adminlog` VALUES (475, 20, '2017-12-08 10:59:30', '::1', '消息推送', 5, NULL, '成功', '', 'dataTuiXiaoxi', 'Notice', 'NoticedataTuiXiaoxi');
INSERT INTO `adminlog` VALUES (476, 20, '2017-12-08 10:59:30', '::1', '消息推送', 5, NULL, '成功', '', 'dataTuiXiaoxi', 'Notice', 'NoticedataTuiXiaoxi');
INSERT INTO `adminlog` VALUES (477, 20, '2017-12-08 10:59:34', '::1', '消息推送', 5, NULL, '成功', '', 'dataTuiXiaoxi', 'Notice', 'NoticedataTuiXiaoxi');
INSERT INTO `adminlog` VALUES (478, 20, '2017-12-08 10:59:34', '::1', '消息推送', 5, NULL, '成功', '', 'dataTuiXiaoxi', 'Notice', 'NoticedataTuiXiaoxi');
INSERT INTO `adminlog` VALUES (479, 20, '2017-12-08 10:59:35', '::1', '消息推送', 5, NULL, '成功', '', 'dataTuiXiaoxi', 'Notice', 'NoticedataTuiXiaoxi');
INSERT INTO `adminlog` VALUES (480, 20, '2017-12-08 10:59:35', '::1', '消息推送', 5, NULL, '成功', '', 'dataTuiXiaoxi', 'Notice', 'NoticedataTuiXiaoxi');
INSERT INTO `adminlog` VALUES (481, 20, '2017-12-08 10:59:35', '::1', '消息推送', 5, NULL, '成功', '', 'dataTuiXiaoxi', 'Notice', 'NoticedataTuiXiaoxi');
INSERT INTO `adminlog` VALUES (482, 20, '2017-12-08 10:59:35', '::1', '消息推送', 5, NULL, '成功', '', 'dataTuiXiaoxi', 'Notice', 'NoticedataTuiXiaoxi');
INSERT INTO `adminlog` VALUES (483, 20, '2017-12-08 10:59:35', '::1', '消息推送', 5, NULL, '成功', '', 'dataTuiXiaoxi', 'Notice', 'NoticedataTuiXiaoxi');
INSERT INTO `adminlog` VALUES (484, 20, '2017-12-08 10:59:36', '::1', '消息推送', 5, NULL, '成功', '', 'dataTuiXiaoxi', 'Notice', 'NoticedataTuiXiaoxi');
INSERT INTO `adminlog` VALUES (485, 20, '2017-12-08 10:59:36', '::1', '消息推送', 5, NULL, '成功', '', 'dataTuiXiaoxi', 'Notice', 'NoticedataTuiXiaoxi');
INSERT INTO `adminlog` VALUES (486, 20, '2017-12-08 10:59:36', '::1', '消息推送', 5, NULL, '成功', '', 'dataTuiXiaoxi', 'Notice', 'NoticedataTuiXiaoxi');
INSERT INTO `adminlog` VALUES (487, 20, '2017-12-08 10:59:37', '::1', '消息推送', 5, NULL, '成功', '', 'dataTuiXiaoxi', 'Notice', 'NoticedataTuiXiaoxi');
INSERT INTO `adminlog` VALUES (488, 20, '2017-12-08 10:59:37', '::1', '消息推送', 5, NULL, '成功', '', 'dataTuiXiaoxi', 'Notice', 'NoticedataTuiXiaoxi');
INSERT INTO `adminlog` VALUES (489, 20, '2017-12-08 10:59:37', '::1', '消息推送', 5, NULL, '成功', '', 'dataTuiXiaoxi', 'Notice', 'NoticedataTuiXiaoxi');
INSERT INTO `adminlog` VALUES (490, 20, '2017-12-08 10:59:37', '::1', '消息推送', 5, NULL, '成功', '', 'dataTuiXiaoxi', 'Notice', 'NoticedataTuiXiaoxi');
INSERT INTO `adminlog` VALUES (491, 20, '2017-12-08 10:59:38', '::1', '消息推送', 5, NULL, '成功', '', 'dataTuiXiaoxi', 'Notice', 'NoticedataTuiXiaoxi');
INSERT INTO `adminlog` VALUES (492, 20, '2017-12-08 10:59:38', '::1', '消息推送', 5, NULL, '成功', '', 'dataTuiXiaoxi', 'Notice', 'NoticedataTuiXiaoxi');
INSERT INTO `adminlog` VALUES (493, 20, '2017-12-08 10:59:38', '::1', '消息推送', 5, NULL, '成功', '', 'dataTuiXiaoxi', 'Notice', 'NoticedataTuiXiaoxi');
INSERT INTO `adminlog` VALUES (494, 20, '2017-12-08 10:59:38', '::1', '消息推送', 5, NULL, '成功', '', 'dataTuiXiaoxi', 'Notice', 'NoticedataTuiXiaoxi');
INSERT INTO `adminlog` VALUES (495, 20, '2017-12-08 10:59:38', '::1', '消息推送', 5, NULL, '成功', '', 'dataTuiXiaoxi', 'Notice', 'NoticedataTuiXiaoxi');
INSERT INTO `adminlog` VALUES (496, 20, '2017-12-08 10:59:39', '::1', '消息推送', 5, NULL, '成功', '', 'dataTuiXiaoxi', 'Notice', 'NoticedataTuiXiaoxi');
INSERT INTO `adminlog` VALUES (497, 20, '2017-12-08 10:59:39', '::1', '消息推送', 5, NULL, '成功', '', 'dataTuiXiaoxi', 'Notice', 'NoticedataTuiXiaoxi');
INSERT INTO `adminlog` VALUES (498, 20, '2017-12-08 10:59:39', '::1', '消息推送', 5, NULL, '成功', '', 'dataTuiXiaoxi', 'Notice', 'NoticedataTuiXiaoxi');
INSERT INTO `adminlog` VALUES (499, 20, '2017-12-08 10:59:39', '::1', '消息推送', 5, NULL, '成功', '', 'dataTuiXiaoxi', 'Notice', 'NoticedataTuiXiaoxi');
INSERT INTO `adminlog` VALUES (500, 20, '2017-12-08 10:59:39', '::1', '消息推送', 5, NULL, '成功', '', 'dataTuiXiaoxi', 'Notice', 'NoticedataTuiXiaoxi');
INSERT INTO `adminlog` VALUES (501, 20, '2017-12-08 10:59:40', '::1', '消息推送', 5, NULL, '成功', '', 'dataTuiXiaoxi', 'Notice', 'NoticedataTuiXiaoxi');
INSERT INTO `adminlog` VALUES (502, 20, '2017-12-08 11:27:54', '::1', '删除消息推送', 0, NULL, '成功', '', 'dataDelXiaoxi', 'Notice', 'NoticedataDelXiaoxi');
INSERT INTO `adminlog` VALUES (503, 20, '2017-12-08 11:52:45', '::1', '删除banenr', 0, NULL, '成功', '', 'dataDelHuodong', 'Notice', 'NoticedataDelHuodong');
INSERT INTO `adminlog` VALUES (504, 20, '2017-12-08 11:53:16', '::1', '添加活动推送', 5, NULL, '成功', '', 'dataAddHuodong_Sub', 'Notice', 'NoticedataAddHuodong_Sub');
INSERT INTO `adminlog` VALUES (505, 20, '2017-12-08 13:46:14', '::1', '编辑活动', NULL, NULL, '成功', '', 'dataEditHuodong_Sub', 'Notice', 'NoticedataEditHuodong_Sub');
INSERT INTO `adminlog` VALUES (506, 20, '2017-12-08 13:47:31', '::1', '编辑活动', NULL, NULL, '成功', '', 'dataEditHuodong_Sub', 'Notice', 'NoticedataEditHuodong_Sub');
INSERT INTO `adminlog` VALUES (507, 20, '2017-12-08 13:50:13', '::1', '编辑活动', NULL, NULL, '成功', '', 'dataEditHuodong_Sub', 'Notice', 'NoticedataEditHuodong_Sub');
INSERT INTO `adminlog` VALUES (508, 20, '2017-12-08 13:54:05', '::1', '编辑活动', NULL, NULL, '成功', '', 'dataEditHuodong_Sub', 'Notice', 'NoticedataEditHuodong_Sub');
INSERT INTO `adminlog` VALUES (509, 20, '2017-12-08 13:55:56', '::1', '编辑活动', NULL, NULL, '成功', '', 'dataEditHuodong_Sub', 'Notice', 'NoticedataEditHuodong_Sub');
INSERT INTO `adminlog` VALUES (510, 20, '2017-12-08 14:01:55', '::1', '添加活动推送', 6, NULL, '成功', '', 'dataAddHuodong_Sub', 'Notice', 'NoticedataAddHuodong_Sub');
INSERT INTO `adminlog` VALUES (511, 20, '2017-12-08 14:55:23', '::1', '添加活动推送', 7, NULL, '成功', '', 'dataAddHuodong_Sub', 'Notice', 'NoticedataAddHuodong_Sub');
INSERT INTO `adminlog` VALUES (512, 20, '2017-12-08 15:01:38', '::1', '编辑腰图', 1, NULL, '成功', '', 'dataEditYaotu_Sub', 'Notice', 'NoticedataEditYaotu_Sub');
INSERT INTO `adminlog` VALUES (513, 20, '2017-12-08 15:08:05', '::1', '编辑腰图', 1, NULL, '成功', '', 'dataEditYaotu_Sub', 'Notice', 'NoticedataEditYaotu_Sub');
INSERT INTO `adminlog` VALUES (514, 20, '2017-12-11 08:32:38', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (515, 20, '2017-12-11 08:33:20', '::1', '编辑腰图', 1, NULL, '成功', '', 'dataEditYaotu_Sub', 'Notice', 'NoticedataEditYaotu_Sub');
INSERT INTO `adminlog` VALUES (516, 20, '2017-12-11 08:33:26', '::1', '隐藏腰图', 1, NULL, '成功', '', 'yincangYaotu', 'Notice', 'NoticeyincangYaotu');
INSERT INTO `adminlog` VALUES (517, 20, '2017-12-11 08:33:32', '::1', '删除banenr', 0, NULL, '成功', '', 'dataDel', 'Notice', 'NoticedataDel');
INSERT INTO `adminlog` VALUES (518, 20, '2017-12-11 08:33:43', '::1', '删除banenr', 0, NULL, '成功', '', 'dataDel', 'Notice', 'NoticedataDel');
INSERT INTO `adminlog` VALUES (519, 20, '2017-12-11 08:34:27', '::1', '删除banenr', 0, NULL, '成功', '', 'dataDel', 'Notice', 'NoticedataDel');
INSERT INTO `adminlog` VALUES (520, 20, '2017-12-11 08:37:27', '::1', '删除腰图', 0, NULL, '成功', '', 'dataDelYaotu', 'Notice', 'NoticedataDelYaotu');
INSERT INTO `adminlog` VALUES (521, 20, '2017-12-11 08:37:59', '::1', '添加腰图', 3, NULL, '成功', '', 'dataAddYaotu_Sub', 'Notice', 'NoticedataAddYaotu_Sub');
INSERT INTO `adminlog` VALUES (522, 20, '2017-12-11 08:39:28', '::1', '编辑腰图', 2, NULL, '成功', '', 'dataEditYaotu_Sub', 'Notice', 'NoticedataEditYaotu_Sub');
INSERT INTO `adminlog` VALUES (523, 20, '2017-12-11 08:40:07', '::1', '编辑腰图', 2, NULL, '成功', '', 'dataEditYaotu_Sub', 'Notice', 'NoticedataEditYaotu_Sub');
INSERT INTO `adminlog` VALUES (524, 20, '2017-12-11 08:40:12', '::1', '显示腰图', 2, NULL, '成功', '', 'xianshiYaotu', 'Notice', 'NoticexianshiYaotu');
INSERT INTO `adminlog` VALUES (525, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `adminlog` VALUES (526, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `adminlog` VALUES (527, 20, '2017-12-11 12:55:02', '::1', '教师上线', 6, NULL, '成功', '', 'xianshi', 'Teacher', 'Teacherxianshi');
INSERT INTO `adminlog` VALUES (528, 20, '2017-12-12 08:40:43', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (529, 20, '2017-12-12 16:56:04', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (530, 20, '2017-12-13 08:45:50', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (531, 20, '2017-12-13 08:47:14', '::1', '推荐视频', 3, NULL, '成功', '', 'xianshi', 'Video', 'Videoxianshi');
INSERT INTO `adminlog` VALUES (532, 20, '2017-12-13 08:48:01', '::1', '上线视频', 2, NULL, '成功', '', 'shangxian', 'Video', 'Videoshangxian');
INSERT INTO `adminlog` VALUES (533, 20, '2017-12-13 08:57:10', '::1', '取消推荐视频', 1, NULL, '成功', '', 'yincang', 'Video', 'Videoyincang');
INSERT INTO `adminlog` VALUES (534, 20, '2017-12-13 09:02:01', '::1', '删除视频', 0, NULL, '成功', '', 'dataDel', 'Video', 'VideodataDel');
INSERT INTO `adminlog` VALUES (535, 20, '2017-12-13 10:23:01', '::1', '推荐视频', 2, NULL, '成功', '', 'xianshi', 'Video', 'Videoxianshi');
INSERT INTO `adminlog` VALUES (536, 20, '2017-12-13 16:51:55', '::1', '添加banner', 17, NULL, '成功', '', 'dataAdd_Sub', 'Notice', 'NoticedataAdd_Sub');
INSERT INTO `adminlog` VALUES (537, 20, '2017-12-13 17:20:53', '::1', '编辑banner', NULL, NULL, '成功', '', 'dataEdit_Sub', 'Notice', 'NoticedataEdit_Sub');
INSERT INTO `adminlog` VALUES (538, 20, '2017-12-13 17:23:50', '::1', '编辑banner', 17, NULL, '成功', '', 'dataEdit_Sub', 'Notice', 'NoticedataEdit_Sub');
INSERT INTO `adminlog` VALUES (539, 20, '2017-12-13 17:27:26', '::1', '编辑banner', 17, NULL, '成功', '', 'dataEdit_Sub', 'Notice', 'NoticedataEdit_Sub');
INSERT INTO `adminlog` VALUES (540, 20, '2017-12-13 17:27:43', '::1', '编辑banner', 17, NULL, '成功', '', 'dataEdit_Sub', 'Notice', 'NoticedataEdit_Sub');
INSERT INTO `adminlog` VALUES (541, 20, '2017-12-14 08:38:48', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (542, 20, '2017-12-14 08:40:06', '::1', '添加banner', 18, NULL, '成功', '', 'dataAdd_Sub', 'Notice', 'NoticedataAdd_Sub');
INSERT INTO `adminlog` VALUES (543, 20, '2017-12-14 08:41:45', '::1', '编辑banner', 16, NULL, '成功', '', 'dataEdit_Sub', 'Notice', 'NoticedataEdit_Sub');
INSERT INTO `adminlog` VALUES (544, 20, '2017-12-14 08:42:23', '::1', '编辑banner', 12, NULL, '成功', '', 'dataEdit_Sub', 'Notice', 'NoticedataEdit_Sub');
INSERT INTO `adminlog` VALUES (545, 20, '2017-12-14 08:42:42', '::1', '编辑banner', 17, NULL, '成功', '', 'dataEdit_Sub', 'Notice', 'NoticedataEdit_Sub');
INSERT INTO `adminlog` VALUES (546, 20, '2017-12-14 08:43:01', '::1', '编辑banner', 12, NULL, '成功', '', 'dataEdit_Sub', 'Notice', 'NoticedataEdit_Sub');
INSERT INTO `adminlog` VALUES (547, 20, '2017-12-14 08:43:46', '::1', '编辑banner', 12, NULL, '成功', '', 'dataEdit_Sub', 'Notice', 'NoticedataEdit_Sub');
INSERT INTO `adminlog` VALUES (548, 20, '2017-12-14 08:44:33', '::1', '编辑banner', 16, NULL, '成功', '', 'dataEdit_Sub', 'Notice', 'NoticedataEdit_Sub');
INSERT INTO `adminlog` VALUES (549, 20, '2017-12-14 08:44:53', '::1', '编辑banner', 16, NULL, '成功', '', 'dataEdit_Sub', 'Notice', 'NoticedataEdit_Sub');
INSERT INTO `adminlog` VALUES (550, 20, '2017-12-14 08:49:58', '::1', '编辑banner', 16, NULL, '成功', '', 'dataEdit_Sub', 'Notice', 'NoticedataEdit_Sub');
INSERT INTO `adminlog` VALUES (551, 20, '2017-12-14 08:50:42', '::1', '编辑banner', 16, NULL, '成功', '', 'dataEdit_Sub', 'Notice', 'NoticedataEdit_Sub');
INSERT INTO `adminlog` VALUES (552, 20, '2017-12-14 08:53:26', '::1', '编辑banner', 16, NULL, '成功', '', 'dataEdit_Sub', 'Notice', 'NoticedataEdit_Sub');
INSERT INTO `adminlog` VALUES (553, 20, '2017-12-14 08:54:05', '::1', '编辑banner', 16, NULL, '成功', '', 'dataEdit_Sub', 'Notice', 'NoticedataEdit_Sub');
INSERT INTO `adminlog` VALUES (554, 20, '2017-12-14 08:54:18', '::1', '编辑banner', 16, NULL, '成功', '', 'dataEdit_Sub', 'Notice', 'NoticedataEdit_Sub');
INSERT INTO `adminlog` VALUES (555, 20, '2017-12-14 08:54:27', '::1', '编辑banner', 16, NULL, '成功', '', 'dataEdit_Sub', 'Notice', 'NoticedataEdit_Sub');
INSERT INTO `adminlog` VALUES (556, 20, '2017-12-14 08:59:12', '::1', '编辑banner', 16, NULL, '成功', '', 'dataEdit_Sub', 'Notice', 'NoticedataEdit_Sub');
INSERT INTO `adminlog` VALUES (557, 20, '2017-12-14 09:04:15', '::1', '编辑banner', 16, NULL, '成功', '', 'dataEdit_Sub', 'Notice', 'NoticedataEdit_Sub');
INSERT INTO `adminlog` VALUES (558, 20, '2017-12-14 09:04:26', '::1', '编辑banner', 16, NULL, '成功', '', 'dataEdit_Sub', 'Notice', 'NoticedataEdit_Sub');
INSERT INTO `adminlog` VALUES (559, 20, '2017-12-14 09:11:47', '::1', '编辑banner', 16, NULL, '成功', '', 'dataEdit_Sub', 'Notice', 'NoticedataEdit_Sub');
INSERT INTO `adminlog` VALUES (560, 20, '2017-12-14 09:12:18', '::1', '编辑banner', 16, NULL, '成功', '', 'dataEdit_Sub', 'Notice', 'NoticedataEdit_Sub');
INSERT INTO `adminlog` VALUES (561, 20, '2017-12-14 09:25:24', '::1', '编辑banner', 16, NULL, '成功', '', 'dataEdit_Sub', 'Notice', 'NoticedataEdit_Sub');
INSERT INTO `adminlog` VALUES (562, 20, '2017-12-14 09:29:08', '::1', '编辑banner', 16, NULL, '成功', '', 'dataEdit_Sub', 'Notice', 'NoticedataEdit_Sub');
INSERT INTO `adminlog` VALUES (563, 20, '2017-12-14 09:29:22', '::1', '编辑banner', 16, NULL, '成功', '', 'dataEdit_Sub', 'Notice', 'NoticedataEdit_Sub');
INSERT INTO `adminlog` VALUES (564, 20, '2017-12-14 09:30:09', '::1', '编辑banner', 16, NULL, '成功', '', 'dataEdit_Sub', 'Notice', 'NoticedataEdit_Sub');
INSERT INTO `adminlog` VALUES (565, 20, '2017-12-14 09:32:47', '::1', '编辑banner', 16, NULL, '成功', '', 'dataEdit_Sub', 'Notice', 'NoticedataEdit_Sub');
INSERT INTO `adminlog` VALUES (566, 20, '2017-12-14 09:33:00', '::1', '编辑banner', 18, NULL, '成功', '', 'dataEdit_Sub', 'Notice', 'NoticedataEdit_Sub');
INSERT INTO `adminlog` VALUES (567, 20, '2017-12-14 09:33:14', '::1', '编辑banner', 18, NULL, '成功', '', 'dataEdit_Sub', 'Notice', 'NoticedataEdit_Sub');
INSERT INTO `adminlog` VALUES (568, 20, '2017-12-14 09:34:03', '::1', '编辑banner', 16, NULL, '成功', '', 'dataEdit_Sub', 'Notice', 'NoticedataEdit_Sub');
INSERT INTO `adminlog` VALUES (569, 20, '2017-12-14 09:35:05', '::1', '添加腰图', 4, NULL, '成功', '', 'dataAddYaotu_Sub', 'Notice', 'NoticedataAddYaotu_Sub');
INSERT INTO `adminlog` VALUES (570, 20, '2017-12-14 09:36:59', '::1', '添加banner', 19, NULL, '成功', '', 'dataAdd_Sub', 'Notice', 'NoticedataAdd_Sub');
INSERT INTO `adminlog` VALUES (571, 20, '2017-12-14 09:50:08', '::1', '添加活动推送', 8, NULL, '成功', '', 'dataAddHuodong_Sub', 'Notice', 'NoticedataAddHuodong_Sub');
INSERT INTO `adminlog` VALUES (572, 20, '2017-12-14 09:59:00', '::1', '添加腰图', 5, NULL, '成功', '', 'dataAddYaotu_Sub', 'Notice', 'NoticedataAddYaotu_Sub');
INSERT INTO `adminlog` VALUES (573, 20, '2017-12-14 10:07:01', '::1', '编辑腰图', 5, NULL, '成功', '', 'dataEditYaotu_Sub', 'Notice', 'NoticedataEditYaotu_Sub');
INSERT INTO `adminlog` VALUES (574, 20, '2017-12-14 10:09:53', '::1', '编辑腰图', 5, NULL, '成功', '', 'dataEditYaotu_Sub', 'Notice', 'NoticedataEditYaotu_Sub');
INSERT INTO `adminlog` VALUES (575, 20, '2017-12-14 10:10:29', '::1', '编辑腰图', 5, NULL, '成功', '', 'dataEditYaotu_Sub', 'Notice', 'NoticedataEditYaotu_Sub');
INSERT INTO `adminlog` VALUES (576, 20, '2017-12-14 10:11:11', '::1', '编辑腰图', 5, NULL, '成功', '', 'dataEditYaotu_Sub', 'Notice', 'NoticedataEditYaotu_Sub');
INSERT INTO `adminlog` VALUES (577, 20, '2017-12-14 10:11:28', '::1', '编辑腰图', 5, NULL, '成功', '', 'dataEditYaotu_Sub', 'Notice', 'NoticedataEditYaotu_Sub');
INSERT INTO `adminlog` VALUES (578, 20, '2017-12-14 10:12:39', '::1', '编辑腰图', 5, NULL, '成功', '', 'dataEditYaotu_Sub', 'Notice', 'NoticedataEditYaotu_Sub');
INSERT INTO `adminlog` VALUES (579, 20, '2017-12-14 10:13:28', '::1', '编辑banner', 19, NULL, '成功', '', 'dataEdit_Sub', 'Notice', 'NoticedataEdit_Sub');
INSERT INTO `adminlog` VALUES (580, 20, '2017-12-14 10:13:45', '::1', '编辑banner', 16, NULL, '成功', '', 'dataEdit_Sub', 'Notice', 'NoticedataEdit_Sub');
INSERT INTO `adminlog` VALUES (581, 20, '2017-12-14 10:14:10', '::1', '编辑腰图', 5, NULL, '成功', '', 'dataEditYaotu_Sub', 'Notice', 'NoticedataEditYaotu_Sub');
INSERT INTO `adminlog` VALUES (582, 20, '2017-12-14 10:15:14', '::1', '编辑banner', 19, NULL, '成功', '', 'dataEdit_Sub', 'Notice', 'NoticedataEdit_Sub');
INSERT INTO `adminlog` VALUES (583, 20, '2017-12-14 10:15:24', '::1', '编辑banner', 19, NULL, '成功', '', 'dataEdit_Sub', 'Notice', 'NoticedataEdit_Sub');
INSERT INTO `adminlog` VALUES (584, 20, '2017-12-14 10:17:03', '::1', '编辑腰图', 5, NULL, '成功', '', 'dataEditYaotu_Sub', 'Notice', 'NoticedataEditYaotu_Sub');
INSERT INTO `adminlog` VALUES (585, 20, '2017-12-14 10:23:08', '::1', '编辑腰图', 5, NULL, '成功', '', 'dataEditYaotu_Sub', 'Notice', 'NoticedataEditYaotu_Sub');
INSERT INTO `adminlog` VALUES (586, 20, '2017-12-14 10:25:00', '::1', '编辑腰图', 5, NULL, '成功', '', 'dataEditYaotu_Sub', 'Notice', 'NoticedataEditYaotu_Sub');
INSERT INTO `adminlog` VALUES (587, 20, '2017-12-14 10:29:21', '::1', '编辑腰图', 5, NULL, '成功', '', 'dataEditYaotu_Sub', 'Notice', 'NoticedataEditYaotu_Sub');
INSERT INTO `adminlog` VALUES (588, 20, '2017-12-14 10:30:24', '::1', '编辑腰图', 5, NULL, '成功', '', 'dataEditYaotu_Sub', 'Notice', 'NoticedataEditYaotu_Sub');
INSERT INTO `adminlog` VALUES (589, 20, '2017-12-14 10:33:18', '::1', '编辑腰图', 5, NULL, '成功', '', 'dataEditYaotu_Sub', 'Notice', 'NoticedataEditYaotu_Sub');
INSERT INTO `adminlog` VALUES (590, 20, '2017-12-14 10:33:39', '::1', '编辑腰图', 5, NULL, '成功', '', 'dataEditYaotu_Sub', 'Notice', 'NoticedataEditYaotu_Sub');
INSERT INTO `adminlog` VALUES (591, 20, '2017-12-14 10:34:05', '::1', '编辑腰图', 5, NULL, '成功', '', 'dataEditYaotu_Sub', 'Notice', 'NoticedataEditYaotu_Sub');
INSERT INTO `adminlog` VALUES (592, 20, '2017-12-14 10:34:58', '::1', '编辑腰图', 5, NULL, '成功', '', 'dataEditYaotu_Sub', 'Notice', 'NoticedataEditYaotu_Sub');
INSERT INTO `adminlog` VALUES (593, 20, '2017-12-14 10:35:33', '::1', '编辑腰图', 5, NULL, '成功', '', 'dataEditYaotu_Sub', 'Notice', 'NoticedataEditYaotu_Sub');
INSERT INTO `adminlog` VALUES (594, 20, '2017-12-14 10:36:01', '::1', '编辑腰图', 5, NULL, '成功', '', 'dataEditYaotu_Sub', 'Notice', 'NoticedataEditYaotu_Sub');
INSERT INTO `adminlog` VALUES (595, 20, '2017-12-14 10:36:14', '::1', '编辑腰图', 5, NULL, '成功', '', 'dataEditYaotu_Sub', 'Notice', 'NoticedataEditYaotu_Sub');
INSERT INTO `adminlog` VALUES (596, 20, '2017-12-14 10:37:11', '::1', '编辑腰图', 5, NULL, '成功', '', 'dataEditYaotu_Sub', 'Notice', 'NoticedataEditYaotu_Sub');
INSERT INTO `adminlog` VALUES (597, 20, '2017-12-14 10:37:52', '::1', '编辑腰图', 5, NULL, '成功', '', 'dataEditYaotu_Sub', 'Notice', 'NoticedataEditYaotu_Sub');
INSERT INTO `adminlog` VALUES (598, 20, '2017-12-14 10:38:11', '::1', '编辑腰图', 5, NULL, '成功', '', 'dataEditYaotu_Sub', 'Notice', 'NoticedataEditYaotu_Sub');
INSERT INTO `adminlog` VALUES (599, 20, '2017-12-14 10:42:15', '::1', '编辑腰图', 3, NULL, '成功', '', 'dataEditYaotu_Sub', 'Notice', 'NoticedataEditYaotu_Sub');
INSERT INTO `adminlog` VALUES (600, 20, '2017-12-14 10:42:20', '::1', '编辑腰图', 2, NULL, '成功', '', 'dataEditYaotu_Sub', 'Notice', 'NoticedataEditYaotu_Sub');
INSERT INTO `adminlog` VALUES (601, 20, '2017-12-14 10:42:30', '::1', '编辑腰图', 4, NULL, '成功', '', 'dataEditYaotu_Sub', 'Notice', 'NoticedataEditYaotu_Sub');
INSERT INTO `adminlog` VALUES (602, 20, '2017-12-14 10:43:26', '::1', '编辑腰图', 2, NULL, '成功', '', 'dataEditYaotu_Sub', 'Notice', 'NoticedataEditYaotu_Sub');
INSERT INTO `adminlog` VALUES (603, 20, '2017-12-14 10:45:11', '::1', '编辑腰图', 2, NULL, '成功', '', 'dataEditYaotu_Sub', 'Notice', 'NoticedataEditYaotu_Sub');
INSERT INTO `adminlog` VALUES (604, 20, '2017-12-14 10:45:21', '::1', '编辑腰图', 3, NULL, '成功', '', 'dataEditYaotu_Sub', 'Notice', 'NoticedataEditYaotu_Sub');
INSERT INTO `adminlog` VALUES (605, 20, '2017-12-14 10:45:54', '::1', '编辑腰图', 3, NULL, '成功', '', 'dataEditYaotu_Sub', 'Notice', 'NoticedataEditYaotu_Sub');
INSERT INTO `adminlog` VALUES (606, 20, '2017-12-14 10:46:19', '::1', '编辑腰图', 3, NULL, '成功', '', 'dataEditYaotu_Sub', 'Notice', 'NoticedataEditYaotu_Sub');
INSERT INTO `adminlog` VALUES (607, 20, '2017-12-14 10:47:00', '::1', '编辑腰图', 3, NULL, '成功', '', 'dataEditYaotu_Sub', 'Notice', 'NoticedataEditYaotu_Sub');
INSERT INTO `adminlog` VALUES (608, 20, '2017-12-14 10:47:57', '::1', '编辑腰图', 3, NULL, '成功', '', 'dataEditYaotu_Sub', 'Notice', 'NoticedataEditYaotu_Sub');
INSERT INTO `adminlog` VALUES (609, 20, '2017-12-14 10:48:46', '::1', '编辑腰图', 2, NULL, '成功', '', 'dataEditYaotu_Sub', 'Notice', 'NoticedataEditYaotu_Sub');
INSERT INTO `adminlog` VALUES (610, 20, '2017-12-14 10:57:36', '::1', '编辑腰图', 2, NULL, '成功', '', 'dataEditYaotu_Sub', 'Notice', 'NoticedataEditYaotu_Sub');
INSERT INTO `adminlog` VALUES (611, 20, '2017-12-14 10:58:27', '::1', '编辑腰图', 2, NULL, '成功', '', 'dataEditYaotu_Sub', 'Notice', 'NoticedataEditYaotu_Sub');
INSERT INTO `adminlog` VALUES (612, 20, '2017-12-14 10:58:37', '::1', '编辑腰图', 2, NULL, '成功', '', 'dataEditYaotu_Sub', 'Notice', 'NoticedataEditYaotu_Sub');
INSERT INTO `adminlog` VALUES (613, 20, '2017-12-14 10:59:40', '::1', '编辑banner', 16, NULL, '成功', '', 'dataEdit_Sub', 'Notice', 'NoticedataEdit_Sub');
INSERT INTO `adminlog` VALUES (614, 20, '2017-12-14 11:06:50', '::1', '编辑活动', 8, NULL, '成功', '', 'dataEditHuodong_Sub', 'Notice', 'NoticedataEditHuodong_Sub');
INSERT INTO `adminlog` VALUES (615, 20, '2017-12-14 11:07:03', '::1', '编辑活动', 2, NULL, '成功', '', 'dataEditHuodong_Sub', 'Notice', 'NoticedataEditHuodong_Sub');
INSERT INTO `adminlog` VALUES (616, 20, '2017-12-14 11:07:42', '::1', '编辑活动', 5, NULL, '成功', '', 'dataEditHuodong_Sub', 'Notice', 'NoticedataEditHuodong_Sub');
INSERT INTO `adminlog` VALUES (617, 20, '2017-12-14 11:10:22', '::1', '编辑活动', 2, NULL, '成功', '', 'dataEditHuodong_Sub', 'Notice', 'NoticedataEditHuodong_Sub');
INSERT INTO `adminlog` VALUES (618, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `adminlog` VALUES (619, 20, '2017-12-14 13:51:50', '::1', '编辑banner', 17, NULL, '成功', '', 'dataEdit_Sub', 'Notice', 'NoticedataEdit_Sub');
INSERT INTO `adminlog` VALUES (620, 20, '2017-12-14 13:51:58', '::1', '编辑banner', 12, NULL, '成功', '', 'dataEdit_Sub', 'Notice', 'NoticedataEdit_Sub');
INSERT INTO `adminlog` VALUES (621, 20, '2017-12-14 13:52:07', '::1', '编辑banner', 15, NULL, '成功', '', 'dataEdit_Sub', 'Notice', 'NoticedataEdit_Sub');
INSERT INTO `adminlog` VALUES (622, 20, '2017-12-14 13:52:17', '::1', '编辑banner', 10, NULL, '成功', '', 'dataEdit_Sub', 'Notice', 'NoticedataEdit_Sub');
INSERT INTO `adminlog` VALUES (623, 20, '2017-12-14 14:53:17', '::1', '推荐视频', 11, NULL, '成功', '', 'xianshi', 'Play', 'Playxianshi');
INSERT INTO `adminlog` VALUES (624, 20, '2017-12-14 15:06:47', '::1', '下线视频', 2, NULL, '成功', '', 'xiaxian', 'Video', 'Videoxiaxian');
INSERT INTO `adminlog` VALUES (625, 20, '2017-12-14 15:08:02', '::1', '上线直播', 1, NULL, '成功', '', 'shangxianyue', 'Play', 'Playshangxianyue');
INSERT INTO `adminlog` VALUES (626, 20, '2017-12-14 15:08:37', '::1', '上线直播', 2, NULL, '成功', '', 'shangxianyue', 'Play', 'Playshangxianyue');
INSERT INTO `adminlog` VALUES (627, 20, '2017-12-14 15:08:40', '::1', '上线直播', 3, NULL, '成功', '', 'shangxianyue', 'Play', 'Playshangxianyue');
INSERT INTO `adminlog` VALUES (628, 20, '2017-12-14 15:08:42', '::1', '上线直播', 4, NULL, '成功', '', 'shangxianyue', 'Play', 'Playshangxianyue');
INSERT INTO `adminlog` VALUES (629, 20, '2017-12-15 09:12:40', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (630, 20, '2017-12-15 10:22:09', '::1', '上线直播', 1, NULL, '成功', '', 'shangxianyue', 'Play', 'Playshangxianyue');
INSERT INTO `adminlog` VALUES (631, 20, '2017-12-15 10:22:14', '::1', '上线直播', 1, NULL, '成功', '', 'shangxianyue', 'Play', 'Playshangxianyue');
INSERT INTO `adminlog` VALUES (632, 20, '2017-12-15 10:23:14', '::1', '上线直播', 1, NULL, '成功', '', 'shangxianyue', 'Play', 'Playshangxianyue');
INSERT INTO `adminlog` VALUES (633, 20, '2017-12-15 11:06:25', '::1', '编辑活动', 6, NULL, '成功', '', 'dataEditHuodong_Sub', 'Notice', 'NoticedataEditHuodong_Sub');
INSERT INTO `adminlog` VALUES (634, 20, '2017-12-15 11:06:37', '::1', '编辑活动', 1, NULL, '成功', '', 'dataEditHuodong_Sub', 'Notice', 'NoticedataEditHuodong_Sub');
INSERT INTO `adminlog` VALUES (635, 20, '2017-12-15 11:06:48', '::1', '编辑活动', 7, NULL, '成功', '', 'dataEditHuodong_Sub', 'Notice', 'NoticedataEditHuodong_Sub');
INSERT INTO `adminlog` VALUES (636, 20, '2017-12-15 13:07:31', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (637, 20, '2017-12-15 15:32:47', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (638, 20, '2017-12-18 08:30:51', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (639, 20, '2017-12-18 14:38:05', '::1', '取消推荐直播', 1, NULL, '成功', '', 'yincang', 'Play', 'Playyincang');
INSERT INTO `adminlog` VALUES (640, 20, '2017-12-18 14:38:18', '::1', '推荐直播', 1, NULL, '成功', '', 'xianshi', 'Play', 'Playxianshi');
INSERT INTO `adminlog` VALUES (641, 20, '2017-12-19 08:30:37', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (642, 20, '2017-12-04 09:42:45', '::1', '编辑直播', 1, NULL, '成功', '', 'dataEdit_Sub', 'Play', 'PlaydataEdit_Sub');
INSERT INTO `adminlog` VALUES (643, 20, '2017-12-04 09:45:45', '::1', '编辑直播', 1, NULL, '成功', '', 'dataEdit_Sub', 'Play', 'PlaydataEdit_Sub');
INSERT INTO `adminlog` VALUES (644, 20, '2017-12-04 09:47:23', '::1', '编辑直播', 1, NULL, '成功', '', 'dataEdit_Sub', 'Play', 'PlaydataEdit_Sub');
INSERT INTO `adminlog` VALUES (645, 20, '2017-12-04 09:48:47', '::1', '编辑直播', 1, NULL, '成功', '', 'dataEdit_Sub', 'Play', 'PlaydataEdit_Sub');
INSERT INTO `adminlog` VALUES (646, 20, '2017-12-04 09:49:59', '::1', '编辑直播', 1, NULL, '成功', '', 'dataEdit_Sub', 'Play', 'PlaydataEdit_Sub');
INSERT INTO `adminlog` VALUES (647, 20, '2017-12-04 09:50:09', '::1', '编辑直播', 1, NULL, '成功', '', 'dataEdit_Sub', 'Play', 'PlaydataEdit_Sub');
INSERT INTO `adminlog` VALUES (648, 20, '2017-12-04 10:01:58', '::1', '编辑直播', 1, NULL, '成功', '', 'dataEdit_Sub', 'Play', 'PlaydataEdit_Sub');
INSERT INTO `adminlog` VALUES (649, 20, '2017-12-04 10:09:33', '::1', '编辑直播', 1, NULL, '成功', '', 'dataEdit_Sub', 'Play', 'PlaydataEdit_Sub');
INSERT INTO `adminlog` VALUES (650, 20, '2017-12-04 10:10:55', '::1', '编辑直播', 1, NULL, '成功', '', 'dataEdit_Sub', 'Play', 'PlaydataEdit_Sub');
INSERT INTO `adminlog` VALUES (651, 20, '2017-12-04 10:11:04', '::1', '编辑直播', 1, NULL, '成功', '', 'dataEdit_Sub', 'Play', 'PlaydataEdit_Sub');
INSERT INTO `adminlog` VALUES (652, 20, '2017-12-04 10:14:29', '::1', '编辑直播', 1, NULL, '成功', '', 'dataEdit_Sub', 'Play', 'PlaydataEdit_Sub');
INSERT INTO `adminlog` VALUES (653, 20, '2017-12-04 10:14:40', '::1', '编辑直播', 1, NULL, '成功', '', 'dataEdit_Sub', 'Play', 'PlaydataEdit_Sub');
INSERT INTO `adminlog` VALUES (654, 20, '2017-12-04 10:18:37', '::1', '编辑直播', 1, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (655, 20, '2017-12-04 11:52:54', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (656, 20, '2017-12-04 16:21:00', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (657, 20, '2017-12-05 08:42:18', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (658, 20, '2017-12-06 08:50:15', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (659, 20, '2017-12-07 08:38:25', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (660, 20, '2017-12-10 08:30:25', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (661, 20, '2017-12-06 08:35:54', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (662, 20, '2017-12-27 08:41:09', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (663, 20, '2017-12-28 08:32:17', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (664, 20, '2017-12-28 11:52:49', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (665, 20, '2017-12-29 08:37:33', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (666, 20, '2018-01-02 08:27:03', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (667, 20, '2018-01-02 11:54:42', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (668, 20, '2018-01-03 08:30:51', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (669, 20, '2018-01-03 09:50:01', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (670, 20, '2018-01-03 10:59:29', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (671, 20, '2018-01-03 11:49:37', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (672, 20, '2018-01-03 14:17:55', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (673, 20, '2018-01-04 08:28:31', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (674, 20, '2017-12-01 09:51:13', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (675, 20, '2018-01-05 10:28:43', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (676, 20, '2018-01-08 16:02:36', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (677, 20, '2018-01-08 16:12:25', '::1', '编辑banner', 15, NULL, '成功', '', 'dataEdit_Sub', 'Notice', 'NoticedataEdit_Sub');
INSERT INTO `adminlog` VALUES (678, 20, '2018-01-08 16:12:53', '::1', '编辑banner', 18, NULL, '成功', '', 'dataEdit_Sub', 'Notice', 'NoticedataEdit_Sub');
INSERT INTO `adminlog` VALUES (679, 20, '2018-01-08 16:13:05', '::1', '编辑banner', 12, NULL, '成功', '', 'dataEdit_Sub', 'Notice', 'NoticedataEdit_Sub');
INSERT INTO `adminlog` VALUES (680, 20, '2018-01-08 16:14:52', '::1', '编辑banner', 17, NULL, '成功', '', 'dataEdit_Sub', 'Notice', 'NoticedataEdit_Sub');
INSERT INTO `adminlog` VALUES (681, 20, '2018-01-09 14:13:16', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (682, 20, '2018-01-10 15:30:53', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (683, 20, '2018-01-11 16:34:18', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (684, 20, '2018-01-11 16:34:37', '::1', '删除banenr', 0, NULL, '成功', '', 'dataDel', 'Notice', 'NoticedataDel');
INSERT INTO `adminlog` VALUES (685, 20, '2018-01-11 16:34:42', '::1', '删除banenr', 0, NULL, '成功', '', 'dataDel', 'Notice', 'NoticedataDel');
INSERT INTO `adminlog` VALUES (686, 20, '2018-01-18 11:18:24', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (687, 20, '2018-01-18 13:29:42', '::1', '添加消息推送', 11, NULL, '成功', '', 'dataAddXiaoxi_Sub', 'Notice', 'NoticedataAddXiaoxi_Sub');
INSERT INTO `adminlog` VALUES (688, 20, '2018-01-18 15:44:48', '::1', '添加消息推送', 19, NULL, '成功', '', 'dataAddXiaoxi_Sub', 'Notice', 'NoticedataAddXiaoxi_Sub');
INSERT INTO `adminlog` VALUES (689, 20, '2018-01-18 15:53:20', '::1', '删除消息推送', 0, NULL, '成功', '', 'dataDelXiaoxi', 'Notice', 'NoticedataDelXiaoxi');
INSERT INTO `adminlog` VALUES (690, 20, '2018-01-18 15:53:32', '::1', '添加消息推送', 20, NULL, '成功', '', 'dataAddXiaoxi_Sub', 'Notice', 'NoticedataAddXiaoxi_Sub');
INSERT INTO `adminlog` VALUES (691, 20, '2018-01-18 15:53:54', '::1', '删除消息推送', 0, NULL, '成功', '', 'dataDelXiaoxi', 'Notice', 'NoticedataDelXiaoxi');
INSERT INTO `adminlog` VALUES (692, 20, '2018-01-18 15:54:48', '::1', '删除消息推送', 0, NULL, '成功', '', 'dataDelXiaoxi', 'Notice', 'NoticedataDelXiaoxi');
INSERT INTO `adminlog` VALUES (693, 20, '2018-01-19 08:28:10', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (694, 20, '2018-01-19 13:27:03', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (695, 20, '2018-01-19 13:52:15', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (696, 20, '2018-01-22 11:28:15', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (697, 20, '2018-01-23 16:42:46', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (698, 20, '2018-01-23 17:51:08', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (699, 20, '2018-01-24 14:03:43', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (700, 20, '2018-01-24 14:11:09', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (701, 20, '2018-01-24 14:56:22', '::1', '推荐视频', 6, NULL, '成功', '', 'xianshi', 'Video', 'Videoxianshi');
INSERT INTO `adminlog` VALUES (702, 20, '2018-01-24 14:56:24', '::1', '取消推荐视频', 6, NULL, '成功', '', 'yincang', 'Video', 'Videoyincang');
INSERT INTO `adminlog` VALUES (703, 20, '2018-01-24 15:02:47', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (704, 20, '2018-01-24 16:36:57', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (705, 20, '2018-01-24 16:41:07', '::1', '添加消息推送', 77, NULL, '成功', '', 'dataAddXiaoxi_Sub', 'Notice', 'NoticedataAddXiaoxi_Sub');
INSERT INTO `adminlog` VALUES (706, 20, '2018-01-25 09:13:00', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (707, 20, '2018-01-30 13:24:34', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (708, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `adminlog` VALUES (709, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `adminlog` VALUES (710, 20, '2018-01-31 17:27:01', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (711, 20, '2018-01-31 19:01:40', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (712, 20, '2018-02-01 09:02:08', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (713, 20, '2018-02-02 10:13:53', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (714, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `adminlog` VALUES (715, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `adminlog` VALUES (716, 20, '2018-02-02 20:03:05', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (717, 20, '2018-02-07 13:40:46', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (718, 20, '2018-02-01 10:52:35', '::1', '编辑商品', 79, NULL, '成功', '', 'dataEdit_Sub', 'Shop', 'ShopdataEdit_Sub');
INSERT INTO `adminlog` VALUES (719, 20, '2018-02-01 10:52:44', '::1', '编辑商品', 78, NULL, '成功', '', 'dataEdit_Sub', 'Shop', 'ShopdataEdit_Sub');
INSERT INTO `adminlog` VALUES (720, 20, '2018-02-01 10:53:33', '::1', '编辑商品', 77, NULL, '成功', '', 'dataEdit_Sub', 'Shop', 'ShopdataEdit_Sub');
INSERT INTO `adminlog` VALUES (721, 20, '2018-02-01 10:53:45', '::1', '编辑商品', 76, NULL, '成功', '', 'dataEdit_Sub', 'Shop', 'ShopdataEdit_Sub');
INSERT INTO `adminlog` VALUES (722, 20, '2018-02-01 10:53:56', '::1', '编辑商品', 75, NULL, '成功', '', 'dataEdit_Sub', 'Shop', 'ShopdataEdit_Sub');
INSERT INTO `adminlog` VALUES (723, 20, '2018-02-01 10:54:13', '::1', '编辑商品', 74, NULL, '成功', '', 'dataEdit_Sub', 'Shop', 'ShopdataEdit_Sub');
INSERT INTO `adminlog` VALUES (724, 20, '2018-02-12 15:23:43', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (725, 20, '2018-02-12 15:55:23', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (726, 20, '2018-02-13 14:08:07', '::1', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (727, 20, '2018-02-26 09:17:29', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (728, 20, '2018-02-26 13:36:50', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (729, 20, '2018-02-26 15:40:54', '61.189.33.149', '退出登录', 0, NULL, '成功', '', 'login_Out', 'Index', 'Indexlogin_Out');
INSERT INTO `adminlog` VALUES (730, 20, '2018-02-26 15:41:02', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (731, 20, '2018-02-26 16:48:27', '61.189.33.149', '编辑商品', 79, NULL, '成功', '', 'dataEdit_Sub', 'Shop', 'ShopdataEdit_Sub');
INSERT INTO `adminlog` VALUES (732, 20, '2018-02-26 16:51:01', '61.189.33.149', '编辑商品', 78, NULL, '成功', '', 'dataEdit_Sub', 'Shop', 'ShopdataEdit_Sub');
INSERT INTO `adminlog` VALUES (733, 20, '2018-02-26 16:53:27', '61.189.33.149', '添加good', 80, NULL, '成功', '', 'dataAdd_Sub', 'Shop', 'ShopdataAdd_Sub');
INSERT INTO `adminlog` VALUES (734, 20, '2018-02-26 16:55:36', '61.189.33.149', '编辑商品', 80, NULL, '成功', '', 'dataEdit_Sub', 'Shop', 'ShopdataEdit_Sub');
INSERT INTO `adminlog` VALUES (735, 20, '2018-02-26 16:56:27', '61.189.33.149', '编辑商品', 80, NULL, '成功', '', 'dataEdit_Sub', 'Shop', 'ShopdataEdit_Sub');
INSERT INTO `adminlog` VALUES (736, 20, '2018-02-26 16:57:54', '61.189.33.149', '添加good', 81, NULL, '成功', '', 'dataAdd_Sub', 'Shop', 'ShopdataAdd_Sub');
INSERT INTO `adminlog` VALUES (737, 20, '2018-02-26 16:59:13', '61.189.33.149', '编辑商品', 81, NULL, '成功', '', 'dataEdit_Sub', 'Shop', 'ShopdataEdit_Sub');
INSERT INTO `adminlog` VALUES (738, 20, '2018-02-26 17:02:00', '61.189.33.149', '添加good', 82, NULL, '成功', '', 'dataAdd_Sub', 'Shop', 'ShopdataAdd_Sub');
INSERT INTO `adminlog` VALUES (739, 20, '2018-02-26 17:04:40', '61.189.33.149', '编辑商品', 82, NULL, '成功', '', 'dataEdit_Sub', 'Shop', 'ShopdataEdit_Sub');
INSERT INTO `adminlog` VALUES (740, 20, '2018-02-26 17:08:22', '61.189.33.149', '添加good', 83, NULL, '成功', '', 'dataAdd_Sub', 'Shop', 'ShopdataAdd_Sub');
INSERT INTO `adminlog` VALUES (741, 20, '2018-02-26 17:08:43', '61.189.33.149', '编辑商品', 83, NULL, '成功', '', 'dataEdit_Sub', 'Shop', 'ShopdataEdit_Sub');
INSERT INTO `adminlog` VALUES (742, 20, '2018-02-26 17:11:20', '61.189.33.149', '添加good', 84, NULL, '成功', '', 'dataAdd_Sub', 'Shop', 'ShopdataAdd_Sub');
INSERT INTO `adminlog` VALUES (743, 20, '2018-02-26 17:11:51', '61.189.33.149', '编辑商品', 84, NULL, '成功', '', 'dataEdit_Sub', 'Shop', 'ShopdataEdit_Sub');
INSERT INTO `adminlog` VALUES (744, 20, '2018-02-26 17:13:41', '61.189.33.149', '添加good', 85, NULL, '成功', '', 'dataAdd_Sub', 'Shop', 'ShopdataAdd_Sub');
INSERT INTO `adminlog` VALUES (745, 20, '2018-02-26 17:16:57', '61.189.33.149', '编辑商品', 85, NULL, '成功', '', 'dataEdit_Sub', 'Shop', 'ShopdataEdit_Sub');
INSERT INTO `adminlog` VALUES (746, 20, '2018-02-26 17:27:40', '61.189.33.149', '添加good', 86, NULL, '成功', '', 'dataAdd_Sub', 'Shop', 'ShopdataAdd_Sub');
INSERT INTO `adminlog` VALUES (747, 20, '2018-02-26 17:32:04', '61.189.33.149', '编辑商品', 86, NULL, '成功', '', 'dataEdit_Sub', 'Shop', 'ShopdataEdit_Sub');
INSERT INTO `adminlog` VALUES (748, 20, '2018-02-26 17:33:11', '61.189.33.149', '编辑商品', 86, NULL, '成功', '', 'dataEdit_Sub', 'Shop', 'ShopdataEdit_Sub');
INSERT INTO `adminlog` VALUES (749, 20, '2018-02-26 17:40:34', '61.189.33.149', '编辑商品', 85, NULL, '成功', '', 'dataEdit_Sub', 'Shop', 'ShopdataEdit_Sub');
INSERT INTO `adminlog` VALUES (750, 20, '2018-02-26 17:42:10', '61.189.33.149', '添加good', 87, NULL, '成功', '', 'dataAdd_Sub', 'Shop', 'ShopdataAdd_Sub');
INSERT INTO `adminlog` VALUES (751, 20, '2018-02-26 17:44:42', '61.189.33.149', '添加good', 88, NULL, '成功', '', 'dataAdd_Sub', 'Shop', 'ShopdataAdd_Sub');
INSERT INTO `adminlog` VALUES (752, 20, '2018-02-26 17:45:12', '61.189.33.149', '编辑商品', 88, NULL, '成功', '', 'dataEdit_Sub', 'Shop', 'ShopdataEdit_Sub');
INSERT INTO `adminlog` VALUES (753, 20, '2018-02-26 17:50:06', '61.189.33.149', '编辑商品', 88, NULL, '成功', '', 'dataEdit_Sub', 'Shop', 'ShopdataEdit_Sub');
INSERT INTO `adminlog` VALUES (754, 20, '2018-02-26 17:51:01', '61.189.33.149', '添加good', 89, NULL, '成功', '', 'dataAdd_Sub', 'Shop', 'ShopdataAdd_Sub');
INSERT INTO `adminlog` VALUES (755, 20, '2018-02-26 17:51:35', '61.189.33.149', '编辑商品', 89, NULL, '成功', '', 'dataEdit_Sub', 'Shop', 'ShopdataEdit_Sub');
INSERT INTO `adminlog` VALUES (756, 20, '2018-02-26 17:55:36', '61.189.33.149', '添加good', 90, NULL, '成功', '', 'dataAdd_Sub', 'Shop', 'ShopdataAdd_Sub');
INSERT INTO `adminlog` VALUES (757, 20, '2018-02-26 18:09:58', '61.189.33.149', '编辑商品', 90, NULL, '成功', '', 'dataEdit_Sub', 'Shop', 'ShopdataEdit_Sub');
INSERT INTO `adminlog` VALUES (758, 20, '2018-02-26 18:10:49', '61.189.33.149', '添加good', 91, NULL, '成功', '', 'dataAdd_Sub', 'Shop', 'ShopdataAdd_Sub');
INSERT INTO `adminlog` VALUES (759, 20, '2018-02-26 18:11:05', '61.189.33.149', '编辑商品', 91, NULL, '成功', '', 'dataEdit_Sub', 'Shop', 'ShopdataEdit_Sub');
INSERT INTO `adminlog` VALUES (760, 20, '2018-02-26 18:16:09', '61.189.33.149', '编辑商品', 91, NULL, '成功', '', 'dataEdit_Sub', 'Shop', 'ShopdataEdit_Sub');
INSERT INTO `adminlog` VALUES (761, 20, '2018-02-26 18:16:16', '61.189.33.149', '编辑商品', 90, NULL, '成功', '', 'dataEdit_Sub', 'Shop', 'ShopdataEdit_Sub');
INSERT INTO `adminlog` VALUES (762, 20, '2018-02-26 18:16:34', '61.189.33.149', '添加good', 92, NULL, '成功', '', 'dataAdd_Sub', 'Shop', 'ShopdataAdd_Sub');
INSERT INTO `adminlog` VALUES (763, 20, '2018-02-26 18:17:02', '61.189.33.149', '添加good', 93, NULL, '成功', '', 'dataAdd_Sub', 'Shop', 'ShopdataAdd_Sub');
INSERT INTO `adminlog` VALUES (764, 20, '2018-02-26 18:17:18', '61.189.33.149', '添加good', 94, NULL, '成功', '', 'dataAdd_Sub', 'Shop', 'ShopdataAdd_Sub');
INSERT INTO `adminlog` VALUES (765, 20, '2018-02-26 18:17:38', '61.189.33.149', '添加good', 95, NULL, '成功', '', 'dataAdd_Sub', 'Shop', 'ShopdataAdd_Sub');
INSERT INTO `adminlog` VALUES (766, 20, '2018-02-26 18:18:08', '61.189.33.149', '添加good', 96, NULL, '成功', '', 'dataAdd_Sub', 'Shop', 'ShopdataAdd_Sub');
INSERT INTO `adminlog` VALUES (767, 20, '2018-02-26 18:18:35', '61.189.33.149', '添加good', 97, NULL, '成功', '', 'dataAdd_Sub', 'Shop', 'ShopdataAdd_Sub');
INSERT INTO `adminlog` VALUES (768, 20, '2018-02-26 18:19:30', '61.189.33.149', '添加good', 98, NULL, '成功', '', 'dataAdd_Sub', 'Shop', 'ShopdataAdd_Sub');
INSERT INTO `adminlog` VALUES (769, 20, '2018-02-26 18:19:48', '61.189.33.149', '添加good', 99, NULL, '成功', '', 'dataAdd_Sub', 'Shop', 'ShopdataAdd_Sub');
INSERT INTO `adminlog` VALUES (770, 20, '2018-02-26 18:20:12', '61.189.33.149', '添加good', 100, NULL, '成功', '', 'dataAdd_Sub', 'Shop', 'ShopdataAdd_Sub');
INSERT INTO `adminlog` VALUES (771, 20, '2018-02-26 18:20:35', '61.189.33.149', '添加good', 101, NULL, '成功', '', 'dataAdd_Sub', 'Shop', 'ShopdataAdd_Sub');
INSERT INTO `adminlog` VALUES (772, 20, '2018-02-26 18:21:09', '61.189.33.149', '添加good', 102, NULL, '成功', '', 'dataAdd_Sub', 'Shop', 'ShopdataAdd_Sub');
INSERT INTO `adminlog` VALUES (773, 20, '2018-02-26 18:22:55', '61.189.33.149', '添加good', 103, NULL, '成功', '', 'dataAdd_Sub', 'Shop', 'ShopdataAdd_Sub');
INSERT INTO `adminlog` VALUES (774, 20, '2018-02-26 18:23:21', '61.189.33.149', '添加good', 104, NULL, '成功', '', 'dataAdd_Sub', 'Shop', 'ShopdataAdd_Sub');
INSERT INTO `adminlog` VALUES (775, 20, '2018-02-26 18:23:39', '61.189.33.149', '添加good', 105, NULL, '成功', '', 'dataAdd_Sub', 'Shop', 'ShopdataAdd_Sub');
INSERT INTO `adminlog` VALUES (776, 20, '2018-02-26 18:24:26', '61.189.33.149', '添加good', 106, NULL, '成功', '', 'dataAdd_Sub', 'Shop', 'ShopdataAdd_Sub');
INSERT INTO `adminlog` VALUES (777, 20, '2018-02-26 18:26:31', '61.189.33.149', '添加good', 107, NULL, '成功', '', 'dataAdd_Sub', 'Shop', 'ShopdataAdd_Sub');
INSERT INTO `adminlog` VALUES (778, 20, '2018-02-26 18:28:18', '61.189.33.149', '添加good', 108, NULL, '成功', '', 'dataAdd_Sub', 'Shop', 'ShopdataAdd_Sub');
INSERT INTO `adminlog` VALUES (779, 20, '2018-02-26 18:28:40', '61.189.33.149', '添加good', 109, NULL, '成功', '', 'dataAdd_Sub', 'Shop', 'ShopdataAdd_Sub');
INSERT INTO `adminlog` VALUES (780, 20, '2018-02-26 18:28:59', '61.189.33.149', '添加good', 110, NULL, '成功', '', 'dataAdd_Sub', 'Shop', 'ShopdataAdd_Sub');
INSERT INTO `adminlog` VALUES (781, 20, '2018-02-26 18:29:18', '61.189.33.149', '添加good', 111, NULL, '成功', '', 'dataAdd_Sub', 'Shop', 'ShopdataAdd_Sub');
INSERT INTO `adminlog` VALUES (782, 20, '2018-02-26 18:29:41', '61.189.33.149', '添加good', 112, NULL, '成功', '', 'dataAdd_Sub', 'Shop', 'ShopdataAdd_Sub');
INSERT INTO `adminlog` VALUES (783, 20, '2018-02-26 18:30:06', '61.189.33.149', '添加good', 113, NULL, '成功', '', 'dataAdd_Sub', 'Shop', 'ShopdataAdd_Sub');
INSERT INTO `adminlog` VALUES (784, 20, '2018-02-26 18:33:22', '61.189.33.149', '添加good', 114, NULL, '成功', '', 'dataAdd_Sub', 'Shop', 'ShopdataAdd_Sub');
INSERT INTO `adminlog` VALUES (785, 20, '2018-02-26 18:34:10', '61.189.33.149', '添加good', 115, NULL, '成功', '', 'dataAdd_Sub', 'Shop', 'ShopdataAdd_Sub');
INSERT INTO `adminlog` VALUES (786, 20, '2018-02-26 18:34:34', '61.189.33.149', '添加good', 116, NULL, '成功', '', 'dataAdd_Sub', 'Shop', 'ShopdataAdd_Sub');
INSERT INTO `adminlog` VALUES (787, 20, '2018-02-26 18:34:53', '61.189.33.149', '添加good', 117, NULL, '成功', '', 'dataAdd_Sub', 'Shop', 'ShopdataAdd_Sub');
INSERT INTO `adminlog` VALUES (788, 20, '2018-02-26 18:35:21', '61.189.33.149', '添加good', 118, NULL, '成功', '', 'dataAdd_Sub', 'Shop', 'ShopdataAdd_Sub');
INSERT INTO `adminlog` VALUES (789, 20, '2018-02-26 18:35:39', '61.189.33.149', '添加good', 119, NULL, '成功', '', 'dataAdd_Sub', 'Shop', 'ShopdataAdd_Sub');
INSERT INTO `adminlog` VALUES (790, 20, '2018-02-26 18:36:32', '61.189.33.149', '添加good', 120, NULL, '成功', '', 'dataAdd_Sub', 'Shop', 'ShopdataAdd_Sub');
INSERT INTO `adminlog` VALUES (791, 20, '2018-02-26 18:36:56', '61.189.33.149', '添加good', 121, NULL, '成功', '', 'dataAdd_Sub', 'Shop', 'ShopdataAdd_Sub');
INSERT INTO `adminlog` VALUES (792, 20, '2018-02-26 18:38:06', '61.189.33.149', '编辑商品', 118, NULL, '成功', '', 'dataEdit_Sub', 'Shop', 'ShopdataEdit_Sub');
INSERT INTO `adminlog` VALUES (793, 20, '2018-02-26 18:43:47', '61.189.33.149', '添加good', 122, NULL, '成功', '', 'dataAdd_Sub', 'Shop', 'ShopdataAdd_Sub');
INSERT INTO `adminlog` VALUES (794, 20, '2018-02-26 18:47:16', '61.189.33.149', '编辑商品', 93, NULL, '成功', '', 'dataEdit_Sub', 'Shop', 'ShopdataEdit_Sub');
INSERT INTO `adminlog` VALUES (795, 20, '2018-02-27 10:50:25', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (796, 20, '2018-02-27 10:51:44', '61.189.33.149', '编辑商品', 102, NULL, '成功', '', 'dataEdit_Sub', 'Shop', 'ShopdataEdit_Sub');
INSERT INTO `adminlog` VALUES (797, 20, '2018-02-27 11:01:28', '61.189.33.149', '编辑商品', 101, NULL, '成功', '', 'dataEdit_Sub', 'Shop', 'ShopdataEdit_Sub');
INSERT INTO `adminlog` VALUES (798, 20, '2018-02-27 11:02:08', '61.189.33.149', '编辑商品', 100, NULL, '成功', '', 'dataEdit_Sub', 'Shop', 'ShopdataEdit_Sub');
INSERT INTO `adminlog` VALUES (799, 20, '2018-02-27 11:02:22', '61.189.33.149', '编辑商品', 99, NULL, '成功', '', 'dataEdit_Sub', 'Shop', 'ShopdataEdit_Sub');
INSERT INTO `adminlog` VALUES (800, 20, '2018-02-27 11:02:37', '61.189.33.149', '编辑商品', 98, NULL, '成功', '', 'dataEdit_Sub', 'Shop', 'ShopdataEdit_Sub');
INSERT INTO `adminlog` VALUES (801, 20, '2018-02-27 11:03:25', '61.189.33.149', '编辑商品', 97, NULL, '成功', '', 'dataEdit_Sub', 'Shop', 'ShopdataEdit_Sub');
INSERT INTO `adminlog` VALUES (802, 20, '2018-02-27 11:04:00', '61.189.33.149', '编辑商品', 96, NULL, '成功', '', 'dataEdit_Sub', 'Shop', 'ShopdataEdit_Sub');
INSERT INTO `adminlog` VALUES (803, 20, '2018-02-27 11:04:16', '61.189.33.149', '编辑商品', 95, NULL, '成功', '', 'dataEdit_Sub', 'Shop', 'ShopdataEdit_Sub');
INSERT INTO `adminlog` VALUES (804, 20, '2018-02-27 11:04:37', '61.189.33.149', '编辑商品', 94, NULL, '成功', '', 'dataEdit_Sub', 'Shop', 'ShopdataEdit_Sub');
INSERT INTO `adminlog` VALUES (805, 20, '2018-02-27 11:04:59', '61.189.33.149', '编辑商品', 93, NULL, '成功', '', 'dataEdit_Sub', 'Shop', 'ShopdataEdit_Sub');
INSERT INTO `adminlog` VALUES (806, 20, '2018-02-27 11:05:51', '61.189.33.149', '编辑商品', 122, NULL, '成功', '', 'dataEdit_Sub', 'Shop', 'ShopdataEdit_Sub');
INSERT INTO `adminlog` VALUES (807, 20, '2018-02-27 11:06:12', '61.189.33.149', '编辑商品', 121, NULL, '成功', '', 'dataEdit_Sub', 'Shop', 'ShopdataEdit_Sub');
INSERT INTO `adminlog` VALUES (808, 20, '2018-02-27 11:06:29', '61.189.33.149', '编辑商品', 120, NULL, '成功', '', 'dataEdit_Sub', 'Shop', 'ShopdataEdit_Sub');
INSERT INTO `adminlog` VALUES (809, 20, '2018-02-27 11:06:45', '61.189.33.149', '编辑商品', 119, NULL, '成功', '', 'dataEdit_Sub', 'Shop', 'ShopdataEdit_Sub');
INSERT INTO `adminlog` VALUES (810, 20, '2018-02-27 11:07:12', '61.189.33.149', '编辑商品', 118, NULL, '成功', '', 'dataEdit_Sub', 'Shop', 'ShopdataEdit_Sub');
INSERT INTO `adminlog` VALUES (811, 20, '2018-02-27 11:07:48', '61.189.33.149', '编辑商品', 117, NULL, '成功', '', 'dataEdit_Sub', 'Shop', 'ShopdataEdit_Sub');
INSERT INTO `adminlog` VALUES (812, 20, '2018-02-27 11:08:21', '61.189.33.149', '编辑商品', 116, NULL, '成功', '', 'dataEdit_Sub', 'Shop', 'ShopdataEdit_Sub');
INSERT INTO `adminlog` VALUES (813, 20, '2018-02-27 11:08:47', '61.189.33.149', '编辑商品', 115, NULL, '成功', '', 'dataEdit_Sub', 'Shop', 'ShopdataEdit_Sub');
INSERT INTO `adminlog` VALUES (814, 20, '2018-02-27 11:09:09', '61.189.33.149', '编辑商品', 114, NULL, '成功', '', 'dataEdit_Sub', 'Shop', 'ShopdataEdit_Sub');
INSERT INTO `adminlog` VALUES (815, 20, '2018-02-27 11:09:29', '61.189.33.149', '编辑商品', 113, NULL, '成功', '', 'dataEdit_Sub', 'Shop', 'ShopdataEdit_Sub');
INSERT INTO `adminlog` VALUES (816, 20, '2018-02-27 11:10:54', '61.189.33.149', '编辑商品', 112, NULL, '成功', '', 'dataEdit_Sub', 'Shop', 'ShopdataEdit_Sub');
INSERT INTO `adminlog` VALUES (817, 20, '2018-02-27 11:11:11', '61.189.33.149', '编辑商品', 111, NULL, '成功', '', 'dataEdit_Sub', 'Shop', 'ShopdataEdit_Sub');
INSERT INTO `adminlog` VALUES (818, 20, '2018-02-27 11:11:26', '61.189.33.149', '编辑商品', 110, NULL, '成功', '', 'dataEdit_Sub', 'Shop', 'ShopdataEdit_Sub');
INSERT INTO `adminlog` VALUES (819, 20, '2018-02-27 11:11:46', '61.189.33.149', '编辑商品', 109, NULL, '成功', '', 'dataEdit_Sub', 'Shop', 'ShopdataEdit_Sub');
INSERT INTO `adminlog` VALUES (820, 20, '2018-02-27 11:12:07', '61.189.33.149', '编辑商品', 108, NULL, '成功', '', 'dataEdit_Sub', 'Shop', 'ShopdataEdit_Sub');
INSERT INTO `adminlog` VALUES (821, 20, '2018-02-27 11:12:27', '61.189.33.149', '编辑商品', 107, NULL, '成功', '', 'dataEdit_Sub', 'Shop', 'ShopdataEdit_Sub');
INSERT INTO `adminlog` VALUES (822, 20, '2018-02-27 11:12:48', '61.189.33.149', '编辑商品', 106, NULL, '成功', '', 'dataEdit_Sub', 'Shop', 'ShopdataEdit_Sub');
INSERT INTO `adminlog` VALUES (823, 20, '2018-02-27 11:13:33', '61.189.33.149', '编辑商品', 105, NULL, '成功', '', 'dataEdit_Sub', 'Shop', 'ShopdataEdit_Sub');
INSERT INTO `adminlog` VALUES (824, 20, '2018-02-27 11:13:51', '61.189.33.149', '编辑商品', 104, NULL, '成功', '', 'dataEdit_Sub', 'Shop', 'ShopdataEdit_Sub');
INSERT INTO `adminlog` VALUES (825, 20, '2018-02-27 11:14:08', '61.189.33.149', '编辑商品', 103, NULL, '成功', '', 'dataEdit_Sub', 'Shop', 'ShopdataEdit_Sub');
INSERT INTO `adminlog` VALUES (826, 20, '2018-02-27 11:14:31', '61.189.33.149', '编辑商品', 92, NULL, '成功', '', 'dataEdit_Sub', 'Shop', 'ShopdataEdit_Sub');
INSERT INTO `adminlog` VALUES (827, 20, '2018-02-27 11:14:55', '61.189.33.149', '编辑商品', 91, NULL, '成功', '', 'dataEdit_Sub', 'Shop', 'ShopdataEdit_Sub');
INSERT INTO `adminlog` VALUES (828, 20, '2018-02-27 11:15:59', '61.189.33.149', '编辑商品', 90, NULL, '成功', '', 'dataEdit_Sub', 'Shop', 'ShopdataEdit_Sub');
INSERT INTO `adminlog` VALUES (829, 20, '2018-02-27 11:16:03', '61.189.33.149', '删除商品', 0, NULL, '成功', '', 'dataDel', 'Shop', 'ShopdataDel');
INSERT INTO `adminlog` VALUES (830, 20, '2018-02-27 13:28:08', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (831, 20, '2018-02-27 13:28:37', '61.189.33.149', '添加消息推送', 89, NULL, '成功', '', 'dataAddXiaoxi_Sub', 'Notice', 'NoticedataAddXiaoxi_Sub');
INSERT INTO `adminlog` VALUES (832, 20, '2018-02-27 13:41:39', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (833, 20, '2018-02-27 14:53:12', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (834, 20, '2018-02-27 16:48:32', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (835, 20, '2018-02-27 17:06:57', '61.189.33.149', '编辑商品', 111, NULL, '成功', '', 'dataEdit_Sub', 'Shop', 'ShopdataEdit_Sub');
INSERT INTO `adminlog` VALUES (836, 20, '2018-02-27 17:07:34', '61.189.33.149', '编辑商品', 112, NULL, '成功', '', 'dataEdit_Sub', 'Shop', 'ShopdataEdit_Sub');
INSERT INTO `adminlog` VALUES (837, 20, '2018-02-27 17:07:54', '61.189.33.149', '编辑商品', 101, NULL, '成功', '', 'dataEdit_Sub', 'Shop', 'ShopdataEdit_Sub');
INSERT INTO `adminlog` VALUES (838, 20, '2018-02-28 09:03:49', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (839, 20, '2018-02-28 09:39:16', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (840, NULL, '2018-02-28 09:44:21', '61.189.33.149', '编辑商品', 101, NULL, '成功', '', 'dataEdit_Sub', 'Shop', 'ShopdataEdit_Sub');
INSERT INTO `adminlog` VALUES (841, NULL, '2018-02-28 09:44:22', '61.189.33.149', '编辑商品', 101, NULL, '成功', '', 'dataEdit_Sub', 'Shop', 'ShopdataEdit_Sub');
INSERT INTO `adminlog` VALUES (842, NULL, '2018-02-28 09:44:23', '61.189.33.149', '编辑商品', 101, NULL, '成功', '', 'dataEdit_Sub', 'Shop', 'ShopdataEdit_Sub');
INSERT INTO `adminlog` VALUES (843, 20, '2018-02-28 09:44:34', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (844, 20, '2018-02-28 15:55:35', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (845, 20, '2018-02-28 15:59:28', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (846, 20, '2018-02-28 15:59:56', '61.189.33.149', '推荐视频', 6, NULL, '成功', '', 'xianshi', 'Video', 'Videoxianshi');
INSERT INTO `adminlog` VALUES (847, 20, '2018-02-28 16:05:53', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (848, 20, '2018-02-28 16:41:26', '61.189.33.149', '取消推荐直播', 1, NULL, '成功', '', 'yincang', 'Play', 'Playyincang');
INSERT INTO `adminlog` VALUES (849, 20, '2018-02-28 16:41:41', '61.189.33.149', '编辑直播', 1, NULL, '成功', '', 'dataEdit_Sub', 'Play', 'PlaydataEdit_Sub');
INSERT INTO `adminlog` VALUES (850, 20, '2018-02-28 16:42:01', '61.189.33.149', '取消推荐视频', 6, NULL, '成功', '', 'yincang', 'Video', 'Videoyincang');
INSERT INTO `adminlog` VALUES (851, 20, '2018-02-28 16:42:06', '61.189.33.149', '下线视频', 6, NULL, '成功', '', 'xiaxian', 'Video', 'Videoxiaxian');
INSERT INTO `adminlog` VALUES (852, 20, '2018-02-28 16:45:22', '61.189.33.149', '上线直播', 42, NULL, '成功', '', 'shangxianyue', 'Play', 'Playshangxianyue');
INSERT INTO `adminlog` VALUES (853, 20, '2018-02-28 16:45:27', '61.189.33.149', '上线直播', 3, NULL, '成功', '', 'shangxianyue', 'Play', 'Playshangxianyue');
INSERT INTO `adminlog` VALUES (854, 20, '2018-02-28 16:45:30', '61.189.33.149', '上线直播', 117, NULL, '成功', '', 'shangxianyue', 'Play', 'Playshangxianyue');
INSERT INTO `adminlog` VALUES (855, 20, '2018-02-28 16:45:40', '61.189.33.149', '上线直播', 12, NULL, '成功', '', 'shangxianyue', 'Play', 'Playshangxianyue');
INSERT INTO `adminlog` VALUES (856, 20, '2018-02-28 16:45:47', '61.189.33.149', '上线直播', 13, NULL, '成功', '', 'shangxianyue', 'Play', 'Playshangxianyue');
INSERT INTO `adminlog` VALUES (857, 20, '2018-02-28 16:45:51', '61.189.33.149', '推荐直播', 1, NULL, '成功', '', 'xianshiyue', 'Play', 'Playxianshiyue');
INSERT INTO `adminlog` VALUES (858, 20, '2018-02-28 16:45:58', '61.189.33.149', '推荐直播', 13, NULL, '成功', '', 'xianshiyue', 'Play', 'Playxianshiyue');
INSERT INTO `adminlog` VALUES (859, 20, '2018-02-28 16:46:04', '61.189.33.149', '推荐直播', 117, NULL, '成功', '', 'xianshiyue', 'Play', 'Playxianshiyue');
INSERT INTO `adminlog` VALUES (860, 20, '2018-02-28 16:46:07', '61.189.33.149', '上线直播', 202, NULL, '成功', '', 'shangxianyue', 'Play', 'Playshangxianyue');
INSERT INTO `adminlog` VALUES (861, 20, '2018-02-28 16:46:22', '61.189.33.149', '推荐直播', 42, NULL, '成功', '', 'xianshiyue', 'Play', 'Playxianshiyue');
INSERT INTO `adminlog` VALUES (862, 20, '2018-02-28 17:27:11', '61.189.33.149', '编辑商品', 112, NULL, '成功', '', 'dataEdit_Sub', 'Shop', 'ShopdataEdit_Sub');
INSERT INTO `adminlog` VALUES (863, 20, '2018-02-28 17:27:21', '61.189.33.149', '编辑商品', 111, NULL, '成功', '', 'dataEdit_Sub', 'Shop', 'ShopdataEdit_Sub');
INSERT INTO `adminlog` VALUES (864, 20, '2018-02-28 17:42:25', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (865, 20, '2018-02-28 17:51:56', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (866, 20, '2018-02-28 19:03:19', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (867, 20, '2018-02-28 19:26:36', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (868, 20, '2018-03-01 09:14:33', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (869, 20, '2018-03-01 10:15:40', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (870, NULL, '2018-03-01 11:33:27', '61.189.33.149', '登录', 0, NULL, '失败', '账户不存在，登录账户为：13333333333', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (871, NULL, '2018-03-01 11:33:37', '61.189.33.149', '登录', 0, NULL, '失败', '密码错误（第1次）', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (872, 20, '2018-03-01 11:34:18', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (873, 20, '2018-03-01 13:14:01', '61.189.33.149', '退出登录', 0, NULL, '成功', '', 'login_Out', 'Index', 'Indexlogin_Out');
INSERT INTO `adminlog` VALUES (874, 20, '2018-03-01 13:14:11', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (875, 20, '2018-03-01 13:19:42', '61.189.33.149', '退出登录', 0, NULL, '成功', '', 'login_Out', 'Index', 'Indexlogin_Out');
INSERT INTO `adminlog` VALUES (876, 20, '2018-03-01 13:19:48', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (877, 20, '2018-03-01 13:23:56', '61.189.33.149', '退出登录', 0, NULL, '成功', '', 'login_Out', 'Index', 'Indexlogin_Out');
INSERT INTO `adminlog` VALUES (878, NULL, '2018-03-01 13:29:35', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (879, NULL, '2018-03-01 13:30:31', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (880, NULL, '2018-03-01 13:32:43', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (881, 20, '2018-03-01 13:34:07', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (882, 20, '2018-03-01 13:34:46', '61.189.33.149', '退出登录', 0, NULL, '成功', '', 'login_Out', 'Index', 'Indexlogin_Out');
INSERT INTO `adminlog` VALUES (883, 20, '2018-03-01 13:35:05', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (884, 20, '2018-03-01 13:39:46', '61.189.33.149', '退出登录', 0, NULL, '成功', '', 'login_Out', 'Index', 'Indexlogin_Out');
INSERT INTO `adminlog` VALUES (885, 20, '2018-03-01 13:39:52', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (886, 20, '2018-03-01 13:45:12', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (887, 20, '2018-03-01 13:47:52', '61.189.33.149', '退出登录', 0, NULL, '成功', '', 'login_Out', 'Index', 'Indexlogin_Out');
INSERT INTO `adminlog` VALUES (888, 20, '2018-03-01 13:47:57', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (889, 20, '2018-03-01 14:12:58', '61.189.33.149', '退出登录', 0, NULL, '成功', '', 'login_Out', 'Index', 'Indexlogin_Out');
INSERT INTO `adminlog` VALUES (890, 126, '2018-03-01 14:13:05', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (891, 126, '2018-03-01 15:14:09', '61.189.33.149', '退出登录', 0, NULL, '成功', '', 'login_Out', 'Index', 'Indexlogin_Out');
INSERT INTO `adminlog` VALUES (892, NULL, '2018-03-01 15:14:13', '61.189.33.149', '登录', 0, NULL, '失败', '密码错误（第1次）', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (893, 20, '2018-03-01 15:14:17', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (894, 20, '2018-03-01 15:14:26', '61.189.33.149', '退出登录', 0, NULL, '成功', '', 'login_Out', 'Index', 'Indexlogin_Out');
INSERT INTO `adminlog` VALUES (895, 126, '2018-03-01 15:14:46', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (896, 126, '2018-03-01 16:02:40', '61.189.33.149', '添加banner', 34, NULL, '成功', '', 'dataAdd_Sub', 'Notice', 'NoticedataAdd_Sub');
INSERT INTO `adminlog` VALUES (897, 126, '2018-03-01 17:05:26', '61.189.33.149', '退出登录', 0, NULL, '成功', '', 'login_Out', 'Index', 'Indexlogin_Out');
INSERT INTO `adminlog` VALUES (898, 126, '2018-03-01 17:06:03', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (899, 126, '2018-03-01 17:07:11', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (900, 126, '2018-03-01 17:09:23', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (901, 126, '2018-03-01 17:16:33', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (902, NULL, '2018-03-02 08:41:07', '61.189.33.149', '登录', 0, NULL, '失败', '密码错误（第1次）', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (903, 20, '2018-03-02 08:41:13', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (904, 20, '2018-03-02 11:03:38', '61.189.33.149', '退出登录', 0, NULL, '成功', '', 'login_Out', 'Index', 'Indexlogin_Out');
INSERT INTO `adminlog` VALUES (905, 126, '2018-03-02 11:03:46', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (906, 126, '2018-03-02 11:31:59', '61.189.33.149', '退出登录', 0, NULL, '成功', '', 'login_Out', 'Index', 'Indexlogin_Out');
INSERT INTO `adminlog` VALUES (907, 20, '2018-03-02 11:32:05', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (908, 20, '2018-03-02 11:32:18', '61.189.33.149', '退出登录', 0, NULL, '成功', '', 'login_Out', 'Index', 'Indexlogin_Out');
INSERT INTO `adminlog` VALUES (909, 126, '2018-03-02 11:32:27', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (910, 126, '2018-03-02 13:36:45', '61.189.33.149', '退出登录', 0, NULL, '成功', '', 'login_Out', 'Index', 'Indexlogin_Out');
INSERT INTO `adminlog` VALUES (911, 20, '2018-03-02 13:36:53', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (912, 20, '2018-03-02 13:37:03', '61.189.33.149', '退出登录', 0, NULL, '成功', '', 'login_Out', 'Index', 'Indexlogin_Out');
INSERT INTO `adminlog` VALUES (913, 20, '2018-03-02 13:37:09', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (914, 20, '2018-03-02 13:37:19', '61.189.33.149', '退出登录', 0, NULL, '成功', '', 'login_Out', 'Index', 'Indexlogin_Out');
INSERT INTO `adminlog` VALUES (915, 126, '2018-03-02 13:37:27', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (916, 126, '2018-03-02 15:58:37', '61.189.33.149', '退出登录', 0, NULL, '成功', '', 'login_Out', 'Index', 'Indexlogin_Out');
INSERT INTO `adminlog` VALUES (917, 20, '2018-03-02 15:58:43', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (918, 20, '2018-03-05 09:31:31', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (919, 126, '2018-03-05 09:32:16', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (920, 126, '2018-03-05 10:06:22', '61.189.33.149', '退出登录', 0, NULL, '成功', '', 'login_Out', 'Index', 'Indexlogin_Out');
INSERT INTO `adminlog` VALUES (921, 20, '2018-03-05 10:06:27', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (922, NULL, '2018-03-05 10:10:08', '61.189.33.149', '登录', 0, NULL, '失败', '密码错误（第1次）', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (923, NULL, '2018-03-05 10:10:15', '61.189.33.149', '登录', 0, NULL, '失败', '密码错误（第2次）', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (924, 126, '2018-03-05 10:10:29', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (925, 126, '2018-03-05 10:10:37', '61.189.33.149', '退出登录', 0, NULL, '成功', '', 'login_Out', 'Index', 'Indexlogin_Out');
INSERT INTO `adminlog` VALUES (926, NULL, '2018-03-05 10:11:00', '61.189.33.149', '登录', 0, NULL, '失败', '密码错误（账户锁定）', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (927, 126, '2018-03-05 10:11:08', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (928, 20, '2018-03-06 08:35:34', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (929, 126, '2018-03-06 08:35:34', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (930, NULL, '2018-03-06 16:11:35', '61.189.33.149', '登录', 0, NULL, '失败', '账户不存在，登录账户为：amdin2', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (931, NULL, '2018-03-06 16:11:55', '61.189.33.149', '登录', 0, NULL, '失败', '账户不存在，登录账户为：amdin2', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (932, NULL, '2018-03-06 16:12:07', '61.189.33.149', '登录', 0, NULL, '失败', '账户不存在，登录账户为：amdin', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (933, 126, '2018-03-06 16:12:54', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (934, 126, '2018-03-06 16:25:41', '61.189.33.149', '退出登录', 0, NULL, '成功', '', 'login_Out', 'Index', 'Indexlogin_Out');
INSERT INTO `adminlog` VALUES (935, 20, '2018-03-06 16:25:47', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (936, 20, '2018-03-07 09:17:41', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (937, 20, '2018-03-07 11:08:30', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (938, 20, '2018-03-07 11:42:42', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (939, 20, '2018-03-08 14:06:15', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (940, 20, '2018-03-09 09:04:56', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (941, 126, '2018-03-09 13:44:35', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (942, NULL, '2018-03-09 15:39:16', '61.189.33.149', '退出登录', 0, NULL, '成功', '', 'login_Out', 'Index', 'Indexlogin_Out');
INSERT INTO `adminlog` VALUES (943, 20, '2018-03-09 15:39:26', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (944, 20, '2018-03-12 17:03:13', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (945, 20, '2018-03-12 22:10:12', '42.53.207.113', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (946, 20, '2018-03-13 08:33:27', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (947, 20, '2018-03-13 09:16:58', '61.189.33.149', '编辑直播', 1, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (948, 20, '2018-03-13 09:17:06', '61.189.33.149', '编辑直播', 2, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (949, 20, '2018-03-13 09:17:14', '61.189.33.149', '编辑直播', 3, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (950, 20, '2018-03-13 09:17:21', '61.189.33.149', '编辑直播', 123, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (951, 20, '2018-03-13 09:17:28', '61.189.33.149', '编辑直播', 116, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (952, 20, '2018-03-13 09:17:34', '61.189.33.149', '编辑直播', 117, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (953, 20, '2018-03-13 09:17:42', '61.189.33.149', '编辑直播', 8, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (954, 20, '2018-03-13 09:17:50', '61.189.33.149', '编辑直播', 9, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (955, 20, '2018-03-13 09:17:58', '61.189.33.149', '编辑直播', 10, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (956, 20, '2018-03-13 09:18:05', '61.189.33.149', '编辑直播', 11, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (957, 20, '2018-03-13 09:18:16', '61.189.33.149', '编辑直播', 12, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (958, 20, '2018-03-13 09:18:23', '61.189.33.149', '编辑直播', 13, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (959, 20, '2018-03-13 09:18:30', '61.189.33.149', '编辑直播', 14, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (960, 20, '2018-03-13 09:18:36', '61.189.33.149', '编辑直播', 15, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (961, 20, '2018-03-13 09:18:46', '61.189.33.149', '编辑直播', 17, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (962, 20, '2018-03-13 09:18:55', '61.189.33.149', '编辑直播', 18, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (963, 20, '2018-03-13 09:19:01', '61.189.33.149', '编辑直播', 19, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (964, 20, '2018-03-13 09:19:07', '61.189.33.149', '编辑直播', 20, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (965, 20, '2018-03-13 09:19:13', '61.189.33.149', '编辑直播', 21, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (966, 20, '2018-03-13 09:19:20', '61.189.33.149', '编辑直播', 22, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (967, 20, '2018-03-13 09:19:31', '61.189.33.149', '编辑直播', 23, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (968, 20, '2018-03-13 09:19:42', '61.189.33.149', '编辑直播', 24, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (969, 20, '2018-03-13 09:19:49', '61.189.33.149', '编辑直播', 25, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (970, 20, '2018-03-13 09:19:56', '61.189.33.149', '编辑直播', 26, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (971, 20, '2018-03-13 09:20:03', '61.189.33.149', '编辑直播', 27, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (972, 20, '2018-03-13 09:20:11', '61.189.33.149', '编辑直播', 28, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (973, 20, '2018-03-13 09:20:18', '61.189.33.149', '编辑直播', 29, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (974, 20, '2018-03-13 09:20:26', '61.189.33.149', '编辑直播', 30, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (975, 20, '2018-03-13 09:20:34', '61.189.33.149', '编辑直播', 31, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (976, 20, '2018-03-13 09:20:43', '61.189.33.149', '编辑直播', 42, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (977, 20, '2018-03-13 09:20:56', '61.189.33.149', '编辑直播', 34, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (978, 20, '2018-03-13 09:21:06', '61.189.33.149', '编辑直播', 35, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (979, 20, '2018-03-13 09:21:14', '61.189.33.149', '编辑直播', 36, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (980, 20, '2018-03-13 09:21:21', '61.189.33.149', '编辑直播', 37, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (981, 20, '2018-03-13 09:21:29', '61.189.33.149', '编辑直播', 38, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (982, 20, '2018-03-13 09:21:36', '61.189.33.149', '编辑直播', 39, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (983, 20, '2018-03-13 09:21:44', '61.189.33.149', '编辑直播', 40, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (984, 20, '2018-03-13 09:21:54', '61.189.33.149', '编辑直播', 41, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (985, 20, '2018-03-13 09:22:00', '61.189.33.149', '编辑直播', 122, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (986, 20, '2018-03-13 09:22:08', '61.189.33.149', '编辑直播', 61, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (987, 20, '2018-03-13 09:22:32', '61.189.33.149', '编辑直播', 205, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (988, 20, '2018-03-13 09:22:41', '61.189.33.149', '编辑直播', 206, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (989, 20, '2018-03-13 09:22:54', '61.189.33.149', '编辑直播', 200, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (990, 20, '2018-03-13 09:23:02', '61.189.33.149', '编辑直播', 201, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (991, 20, '2018-03-13 10:04:00', '61.189.33.149', '编辑直播', 123, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (992, 20, '2018-03-13 10:08:03', '61.189.33.149', '编辑直播', 3, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (993, 20, '2018-03-13 10:11:30', '61.189.33.149', '编辑直播', 3, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (994, 20, '2018-03-13 10:12:38', '61.189.33.149', '编辑直播', 8, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (995, 20, '2018-03-13 10:13:28', '61.189.33.149', '编辑直播', 9, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (996, 20, '2018-03-13 10:14:20', '61.189.33.149', '编辑直播', 9, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (997, 20, '2018-03-13 10:15:28', '61.189.33.149', '编辑直播', 10, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (998, 20, '2018-03-13 10:16:37', '61.189.33.149', '编辑直播', 11, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (999, 20, '2018-03-13 10:17:21', '61.189.33.149', '编辑直播', 12, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (1000, 20, '2018-03-13 10:17:57', '61.189.33.149', '编辑直播', 13, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (1001, 20, '2018-03-13 10:18:25', '61.189.33.149', '编辑直播', 14, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (1002, 20, '2018-03-13 10:20:36', '61.189.33.149', '编辑直播', 206, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (1003, 20, '2018-03-13 10:21:57', '61.189.33.149', '编辑直播', 18, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (1004, 20, '2018-03-13 10:23:46', '61.189.33.149', '编辑直播', 116, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (1005, 20, '2018-03-13 10:24:16', '61.189.33.149', '编辑直播', 117, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (1006, 20, '2018-03-13 10:24:53', '61.189.33.149', '编辑直播', 1, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (1007, 20, '2018-03-13 10:25:29', '61.189.33.149', '编辑直播', 15, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (1008, 20, '2018-03-13 10:26:10', '61.189.33.149', '编辑直播', 15, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (1009, 20, '2018-03-13 10:26:56', '61.189.33.149', '编辑直播', 15, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (1010, 20, '2018-03-13 10:27:08', '61.189.33.149', '编辑直播', 17, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (1011, 20, '2018-03-13 10:27:37', '61.189.33.149', '编辑直播', 19, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (1012, 20, '2018-03-13 10:28:19', '61.189.33.149', '编辑直播', 20, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (1013, 20, '2018-03-13 10:28:44', '61.189.33.149', '编辑直播', 21, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (1014, 20, '2018-03-13 10:29:02', '61.189.33.149', '编辑直播', 22, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (1015, 20, '2018-03-13 10:29:33', '61.189.33.149', '编辑直播', 23, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (1016, 20, '2018-03-13 10:30:06', '61.189.33.149', '编辑直播', 24, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (1017, 20, '2018-03-13 10:30:29', '61.189.33.149', '编辑直播', 25, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (1018, 20, '2018-03-13 10:30:54', '61.189.33.149', '编辑直播', 26, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (1019, 20, '2018-03-13 10:31:13', '61.189.33.149', '编辑直播', 27, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (1020, 20, '2018-03-13 10:31:44', '61.189.33.149', '编辑直播', 28, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (1021, 20, '2018-03-13 10:32:06', '61.189.33.149', '编辑直播', 29, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (1022, 20, '2018-03-13 10:32:24', '61.189.33.149', '编辑直播', 30, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (1023, 20, '2018-03-13 10:32:48', '61.189.33.149', '编辑直播', 31, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (1024, 20, '2018-03-13 10:33:16', '61.189.33.149', '编辑直播', 42, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (1025, 20, '2018-03-13 10:33:44', '61.189.33.149', '编辑直播', 34, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (1026, 20, '2018-03-13 10:34:05', '61.189.33.149', '编辑直播', 35, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (1027, 20, '2018-03-13 10:34:29', '61.189.33.149', '编辑直播', 36, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (1028, 20, '2018-03-13 10:35:03', '61.189.33.149', '编辑直播', 37, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (1029, 20, '2018-03-13 10:35:22', '61.189.33.149', '编辑直播', 38, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (1030, 20, '2018-03-13 10:35:42', '61.189.33.149', '编辑直播', 39, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (1031, 20, '2018-03-13 10:36:03', '61.189.33.149', '编辑直播', 40, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (1032, 20, '2018-03-13 10:36:33', '61.189.33.149', '编辑直播', 41, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (1033, 20, '2018-03-13 10:36:53', '61.189.33.149', '编辑直播', 122, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (1034, 20, '2018-03-13 10:37:13', '61.189.33.149', '编辑直播', 61, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (1035, 20, '2018-03-13 10:37:40', '61.189.33.149', '编辑直播', 200, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (1036, 20, '2018-03-13 10:38:44', '61.189.33.149', '编辑直播', 201, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (1037, 20, '2018-03-13 10:39:07', '61.189.33.149', '编辑直播', 205, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (1038, 20, '2018-03-13 17:13:12', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (1039, 20, '2018-03-13 17:38:07', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (1040, 20, '2018-03-13 17:50:24', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (1041, 20, '2018-03-13 18:16:21', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (1042, 20, '2018-03-14 08:38:59', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (1043, 20, '2018-03-14 10:33:24', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (1044, 20, '2018-03-14 10:40:19', '61.189.33.149', '推荐视频', 67, NULL, '成功', '', 'xianshi', 'Video', 'Videoxianshi');
INSERT INTO `adminlog` VALUES (1045, 20, '2018-03-14 10:42:48', '61.189.33.149', '取消推荐视频', 67, NULL, '成功', '', 'yincang', 'Video', 'Videoyincang');
INSERT INTO `adminlog` VALUES (1046, 20, '2018-03-14 11:27:52', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (1047, 20, '2018-03-15 08:49:07', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (1048, 20, '2018-03-15 13:20:20', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (1049, 20, '2018-03-15 13:35:48', '61.189.33.149', '编辑直播', 1, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (1050, 20, '2018-03-15 13:37:00', '61.189.33.149', '编辑直播', 201, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (1051, 20, '2018-03-15 13:38:06', '61.189.33.149', '编辑直播', 2, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (1052, 20, '2018-03-15 13:38:47', '61.189.33.149', '编辑直播', 3, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (1053, 20, '2018-03-15 13:39:40', '61.189.33.149', '编辑直播', 117, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (1054, 20, '2018-03-15 13:41:00', '61.189.33.149', '编辑直播', 213, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (1055, 20, '2018-03-15 13:42:01', '61.189.33.149', '编辑直播', 219, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (1056, 20, '2018-03-15 13:42:48', '61.189.33.149', '编辑直播', 221, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (1057, 20, '2018-03-15 13:43:48', '61.189.33.149', '编辑直播', 35, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (1058, 20, '2018-03-15 13:45:20', '61.189.33.149', '编辑直播', 36, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (1059, 20, '2018-03-15 13:46:18', '61.189.33.149', '编辑直播', 116, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (1060, 20, '2018-03-15 13:47:46', '61.189.33.149', '编辑直播', 121, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (1061, 20, '2018-03-15 14:33:00', '61.189.33.149', '上线直播', 39, NULL, '成功', '', 'shangxianyue', 'Play', 'Playshangxianyue');
INSERT INTO `adminlog` VALUES (1062, 20, '2018-03-15 14:33:07', '61.189.33.149', '上线直播', 123, NULL, '成功', '', 'shangxianyue', 'Play', 'Playshangxianyue');
INSERT INTO `adminlog` VALUES (1063, 20, '2018-03-15 14:33:10', '61.189.33.149', '上线直播', 3, NULL, '成功', '', 'shangxianyue', 'Play', 'Playshangxianyue');
INSERT INTO `adminlog` VALUES (1064, 20, '2018-03-15 14:33:12', '61.189.33.149', '上线直播', 2, NULL, '成功', '', 'shangxianyue', 'Play', 'Playshangxianyue');
INSERT INTO `adminlog` VALUES (1065, 20, '2018-03-15 14:33:15', '61.189.33.149', '上线直播', 1, NULL, '成功', '', 'shangxianyue', 'Play', 'Playshangxianyue');
INSERT INTO `adminlog` VALUES (1066, 20, '2018-03-15 14:33:22', '61.189.33.149', '上线直播', 35, NULL, '成功', '', 'shangxianyue', 'Play', 'Playshangxianyue');
INSERT INTO `adminlog` VALUES (1067, 20, '2018-03-15 15:27:17', '61.189.33.149', '编辑直播', 123, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (1068, 20, '2018-03-15 15:27:54', '61.189.33.149', '编辑直播', 122, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (1069, 20, '2018-03-15 15:28:18', '61.189.33.149', '编辑直播', 200, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (1070, 20, '2018-03-15 15:28:55', '61.189.33.149', '编辑直播', 253, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (1071, 20, '2018-03-15 15:29:16', '61.189.33.149', '编辑直播', 257, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (1072, 20, '2018-03-15 15:30:00', '61.189.33.149', '编辑直播', 123, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (1073, 20, '2018-03-15 16:15:41', '61.189.33.149', '编辑直播', 223, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (1074, 20, '2018-03-15 16:16:11', '61.189.33.149', '编辑直播', 224, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (1075, 20, '2018-03-15 16:16:39', '61.189.33.149', '编辑直播', 225, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (1076, 20, '2018-03-15 16:17:24', '61.189.33.149', '编辑直播', 226, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (1077, 20, '2018-03-15 17:03:20', '61.189.33.149', '编辑直播', 119, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (1078, 20, '2018-03-15 17:03:59', '61.189.33.149', '编辑直播', 77, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (1079, 20, '2018-03-15 17:04:33', '61.189.33.149', '编辑直播', 112, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (1080, 20, '2018-03-15 17:05:50', '61.189.33.149', '编辑直播', 203, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (1081, 20, '2018-03-15 17:06:25', '61.189.33.149', '编辑直播', 208, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (1082, 20, '2018-03-15 17:07:20', '61.189.33.149', '编辑直播', 211, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (1083, 20, '2018-03-15 17:09:03', '61.189.33.149', '编辑直播', 202, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (1084, 20, '2018-03-15 17:10:07', '61.189.33.149', '编辑直播', 205, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (1085, 20, '2018-03-15 17:10:47', '61.189.33.149', '编辑直播', 201, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (1086, 20, '2018-03-15 17:11:16', '61.189.33.149', '编辑直播', 206, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (1087, 20, '2018-03-15 17:11:43', '61.189.33.149', '编辑直播', 210, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (1088, 20, '2018-03-15 17:12:43', '61.189.33.149', '编辑直播', 256, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (1089, 20, '2018-03-15 17:13:56', '61.189.33.149', '编辑直播', 204, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (1090, 20, '2018-03-15 17:14:20', '61.189.33.149', '编辑直播', 215, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (1091, 20, '2018-03-15 17:14:40', '61.189.33.149', '编辑直播', 233, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (1092, 20, '2018-03-15 17:28:52', '61.189.33.149', '编辑直播', 39, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (1093, 20, '2018-03-15 17:29:26', '61.189.33.149', '编辑直播', 35, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (1094, 20, '2018-03-15 17:29:53', '61.189.33.149', '编辑直播', 206, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (1095, 20, '2018-03-15 17:30:38', '61.189.33.149', '编辑直播', 206, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (1096, 20, '2018-03-15 17:31:02', '61.189.33.149', '编辑直播', 35, NULL, '成功', '', 'dataEdityue_Sub', 'Play', 'PlaydataEdityue_Sub');
INSERT INTO `adminlog` VALUES (1097, 20, '2018-03-16 13:23:10', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (1098, 20, '2018-03-19 10:06:24', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (1099, 20, '2018-03-19 10:12:26', '61.189.33.149', '编辑banner', 30, NULL, '成功', '', 'dataEdit_Sub', 'Notice', 'NoticedataEdit_Sub');
INSERT INTO `adminlog` VALUES (1100, 20, '2018-03-19 10:12:38', '61.189.33.149', '编辑banner', 31, NULL, '成功', '', 'dataEdit_Sub', 'Notice', 'NoticedataEdit_Sub');
INSERT INTO `adminlog` VALUES (1101, 20, '2018-03-19 10:12:54', '61.189.33.149', '编辑banner', 32, NULL, '成功', '', 'dataEdit_Sub', 'Notice', 'NoticedataEdit_Sub');
INSERT INTO `adminlog` VALUES (1102, 20, '2018-03-19 10:13:09', '61.189.33.149', '编辑banner', 33, NULL, '成功', '', 'dataEdit_Sub', 'Notice', 'NoticedataEdit_Sub');
INSERT INTO `adminlog` VALUES (1103, 20, '2018-03-19 10:36:20', '61.189.33.149', '编辑banner', 31, NULL, '成功', '', 'dataEdit_Sub', 'Notice', 'NoticedataEdit_Sub');
INSERT INTO `adminlog` VALUES (1104, 20, '2018-03-19 11:11:10', '61.189.33.149', '编辑banner', 20, NULL, '成功', '', 'dataEdit_Sub', 'Notice', 'NoticedataEdit_Sub');
INSERT INTO `adminlog` VALUES (1105, 20, '2018-03-19 11:11:26', '61.189.33.149', '编辑banner', 21, NULL, '成功', '', 'dataEdit_Sub', 'Notice', 'NoticedataEdit_Sub');
INSERT INTO `adminlog` VALUES (1106, 20, '2018-03-19 11:11:39', '61.189.33.149', '编辑banner', 22, NULL, '成功', '', 'dataEdit_Sub', 'Notice', 'NoticedataEdit_Sub');
INSERT INTO `adminlog` VALUES (1107, 20, '2018-03-19 11:11:51', '61.189.33.149', '编辑banner', 23, NULL, '成功', '', 'dataEdit_Sub', 'Notice', 'NoticedataEdit_Sub');
INSERT INTO `adminlog` VALUES (1108, 20, '2018-03-20 09:37:27', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (1109, 20, '2018-03-20 09:38:15', '61.189.33.149', '删除消息推送', 0, NULL, '成功', '', 'dataDelXiaoxi', 'Notice', 'NoticedataDelXiaoxi');
INSERT INTO `adminlog` VALUES (1110, 20, '2018-03-20 09:38:29', '61.189.33.149', '删除消息推送', 0, NULL, '成功', '', 'dataDelXiaoxi', 'Notice', 'NoticedataDelXiaoxi');
INSERT INTO `adminlog` VALUES (1111, 20, '2018-03-20 09:38:54', '61.189.33.149', '删除消息推送', 0, NULL, '成功', '', 'dataDelXiaoxi', 'Notice', 'NoticedataDelXiaoxi');
INSERT INTO `adminlog` VALUES (1112, 20, '2018-03-20 10:53:19', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (1113, 20, '2018-03-20 10:53:47', '61.189.33.149', '退出登录', 0, NULL, '成功', '', 'login_Out', 'Index', 'Indexlogin_Out');
INSERT INTO `adminlog` VALUES (1114, 20, '2018-03-20 10:54:49', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (1115, 20, '2018-03-20 10:56:47', '61.189.33.149', '退出登录', 0, NULL, '成功', '', 'login_Out', 'Index', 'Indexlogin_Out');
INSERT INTO `adminlog` VALUES (1116, 20, '2018-03-20 11:17:55', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (1117, 20, '2018-03-20 15:14:51', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (1118, 20, '2018-03-20 17:37:54', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (1119, 20, '2018-03-20 17:38:40', '61.189.33.149', '编辑腰图', 6, NULL, '成功', '', 'dataEditYaotu_Sub', 'Notice', 'NoticedataEditYaotu_Sub');
INSERT INTO `adminlog` VALUES (1120, 20, '2018-03-20 17:38:51', '61.189.33.149', '隐藏腰图', 4, NULL, '成功', '', 'yincangYaotu', 'Notice', 'NoticeyincangYaotu');
INSERT INTO `adminlog` VALUES (1121, 20, '2018-03-20 17:38:55', '61.189.33.149', '隐藏腰图', 2, NULL, '成功', '', 'yincangYaotu', 'Notice', 'NoticeyincangYaotu');
INSERT INTO `adminlog` VALUES (1122, 20, '2018-03-20 17:38:58', '61.189.33.149', '隐藏腰图', 3, NULL, '成功', '', 'yincangYaotu', 'Notice', 'NoticeyincangYaotu');
INSERT INTO `adminlog` VALUES (1123, 20, '2018-03-20 17:39:02', '61.189.33.149', '隐藏腰图', 5, NULL, '成功', '', 'yincangYaotu', 'Notice', 'NoticeyincangYaotu');
INSERT INTO `adminlog` VALUES (1124, 20, '2018-03-21 13:30:47', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (1125, 20, '2018-03-21 13:43:25', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (1126, 20, '2018-03-21 17:39:15', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (1127, 20, '2018-03-22 09:16:09', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (1128, 20, '2018-03-22 15:00:58', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (1129, 20, '2018-03-23 08:25:41', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (1130, 20, '2018-03-23 09:00:52', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (1131, 20, '2018-03-23 09:03:53', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (1132, 20, '2018-03-23 11:13:58', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (1133, 20, '2018-03-23 11:17:11', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (1134, 20, '2018-03-23 13:14:57', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (1135, 20, '2018-03-23 17:02:05', '61.189.33.149', '添加消息推送', 128, NULL, '成功', '', 'dataAddXiaoxi_Sub', 'Notice', 'NoticedataAddXiaoxi_Sub');
INSERT INTO `adminlog` VALUES (1136, 20, '2018-03-23 17:06:15', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (1137, 20, '2018-03-26 08:30:13', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (1138, 20, '2018-03-26 11:36:12', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (1139, 20, '2018-03-26 13:41:22', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (1140, 20, '2018-03-26 14:36:00', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (1141, 20, '2018-03-26 16:14:05', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (1142, 20, '2018-03-26 16:14:13', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (1143, 20, '2018-03-26 17:29:41', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (1144, 20, '2018-03-27 08:34:55', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (1145, 20, '2018-03-27 08:37:16', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (1146, 20, '2018-03-27 15:38:30', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (1147, 20, '2018-03-27 15:48:47', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (1148, 20, '2018-03-27 16:58:55', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (1149, 20, '2018-03-27 17:05:13', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (1150, 20, '2018-03-29 09:01:34', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (1151, 20, '2018-03-29 09:01:47', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (1152, 20, '2018-03-29 11:50:40', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (1153, 20, '2018-03-29 17:13:26', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (1154, 20, '2018-03-30 08:29:41', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (1155, 20, '2018-03-30 08:43:53', '61.189.33.149', '添加apk', 1, NULL, '成功', '', 'add', 'Apk', 'Apkadd');
INSERT INTO `adminlog` VALUES (1156, 20, '2018-03-30 08:46:53', '61.189.33.149', '添加apk', 2, NULL, '成功', '', 'add', 'Apk', 'Apkadd');
INSERT INTO `adminlog` VALUES (1157, 20, '2018-03-30 08:53:21', '61.189.33.149', '添加apk', 3, NULL, '成功', '', 'add', 'Apk', 'Apkadd');
INSERT INTO `adminlog` VALUES (1158, 20, '2018-03-30 10:21:24', '61.189.33.149', '添加apk', 4, NULL, '成功', '', 'add', 'Apk', 'Apkadd');
INSERT INTO `adminlog` VALUES (1159, 20, '2018-03-30 11:26:33', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (1160, 20, '2018-03-30 13:22:07', '61.189.33.149', '添加apk', 5, NULL, '成功', '', 'add', 'Apk', 'Apkadd');
INSERT INTO `adminlog` VALUES (1161, 20, '2018-03-30 15:54:46', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (1162, 20, '2018-03-30 15:58:42', '61.189.33.149', '添加apk', 6, NULL, '成功', '', 'add', 'Apk', 'Apkadd');
INSERT INTO `adminlog` VALUES (1163, 20, '2018-03-30 16:03:23', '61.189.33.149', '添加apk', 7, NULL, '成功', '', 'add', 'Apk', 'Apkadd');
INSERT INTO `adminlog` VALUES (1164, 20, '2018-03-30 16:10:00', '61.189.33.149', '添加apk', 8, NULL, '成功', '', 'add', 'Apk', 'Apkadd');
INSERT INTO `adminlog` VALUES (1165, 20, '2018-03-30 16:10:40', '61.189.33.149', '添加apk', 9, NULL, '成功', '', 'add', 'Apk', 'Apkadd');
INSERT INTO `adminlog` VALUES (1166, 20, '2018-03-30 16:10:58', '61.189.33.149', '添加apk', 10, NULL, '成功', '', 'add', 'Apk', 'Apkadd');
INSERT INTO `adminlog` VALUES (1167, 20, '2018-03-30 16:14:16', '61.189.33.149', '添加apk', 11, NULL, '成功', '', 'add', 'Apk', 'Apkadd');
INSERT INTO `adminlog` VALUES (1168, 20, '2018-03-30 16:15:08', '61.189.33.149', '添加apk', 12, NULL, '成功', '', 'add', 'Apk', 'Apkadd');
INSERT INTO `adminlog` VALUES (1169, 20, '2018-04-02 09:48:36', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (1170, 20, '2018-04-02 09:48:50', '61.189.33.149', '添加apk', 13, NULL, '成功', '', 'add', 'Apk', 'Apkadd');
INSERT INTO `adminlog` VALUES (1171, 20, '2018-04-02 09:55:17', '61.189.33.149', '添加apk', 14, NULL, '成功', '', 'add', 'Apk', 'Apkadd');
INSERT INTO `adminlog` VALUES (1172, 20, '2018-04-02 10:01:23', '61.189.33.149', '添加apk', 15, NULL, '成功', '', 'add', 'Apk', 'Apkadd');
INSERT INTO `adminlog` VALUES (1173, 20, '2018-04-02 11:45:49', '61.189.33.149', '添加apk', 16, NULL, '成功', '', 'add', 'Apk', 'Apkadd');
INSERT INTO `adminlog` VALUES (1174, NULL, '2018-04-02 13:23:58', '61.189.33.149', '添加apk', 17, NULL, '成功', '', 'add', 'Apk', 'Apkadd');
INSERT INTO `adminlog` VALUES (1175, 20, '2018-04-02 13:24:08', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');
INSERT INTO `adminlog` VALUES (1176, 20, '2018-04-02 13:50:09', '61.189.33.149', '添加apk', 18, NULL, '成功', '', 'add', 'Apk', 'Apkadd');
INSERT INTO `adminlog` VALUES (1177, 20, '2018-04-02 15:53:14', '61.189.33.149', '登录', 0, NULL, '成功', '', 'login_Sub', 'Login', 'Loginlogin_Sub');

-- ----------------------------
-- Table structure for adminrauth
-- ----------------------------
DROP TABLE IF EXISTS `adminrauth`;
CREATE TABLE `adminrauth`  (
  `ara_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '关联表主键',
  `admin_id` int(11) DEFAULT NULL COMMENT '管理员编号',
  `auth_id` int(11) DEFAULT NULL COMMENT '权限编号',
  PRIMARY KEY (`ara_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 202 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Fixed;

-- ----------------------------
-- Records of adminrauth
-- ----------------------------
INSERT INTO `adminrauth` VALUES (200, 20, 40);
INSERT INTO `adminrauth` VALUES (199, 20, 39);
INSERT INTO `adminrauth` VALUES (198, 20, 38);
INSERT INTO `adminrauth` VALUES (197, 20, 37);
INSERT INTO `adminrauth` VALUES (196, 20, 36);
INSERT INTO `adminrauth` VALUES (195, 20, 35);
INSERT INTO `adminrauth` VALUES (194, 20, 34);
INSERT INTO `adminrauth` VALUES (193, 20, 33);
INSERT INTO `adminrauth` VALUES (192, 20, 29);
INSERT INTO `adminrauth` VALUES (191, 20, 30);
INSERT INTO `adminrauth` VALUES (164, 126, 32);
INSERT INTO `adminrauth` VALUES (190, 20, 31);
INSERT INTO `adminrauth` VALUES (189, 20, 32);
INSERT INTO `adminrauth` VALUES (201, 20, 41);

-- ----------------------------
-- Table structure for advert
-- ----------------------------
DROP TABLE IF EXISTS `advert`;
CREATE TABLE `advert`  (
  `advert_id` int(11) NOT NULL AUTO_INCREMENT,
  `img` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '广告图',
  `url` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '跳转地址',
  `status` char(1) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '0' COMMENT '状态   0：显示   1：不显示',
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `num` int(11) DEFAULT NULL COMMENT '排序',
  PRIMARY KEY (`advert_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of advert
-- ----------------------------
INSERT INTO `advert` VALUES (4, '/Uploads/advert/2017-12-14/5a31e5164b3ec.png', 'http://www.baidu.com', '1', '2222', 1);
INSERT INTO `advert` VALUES (2, '/Uploads/advert/2017-12-14/5a31e8dd63a8c.png', 'http://www.baidu.com', '1', '23', 2);
INSERT INTO `advert` VALUES (3, '/Uploads/advert/2017-12-14/5a31e62451594.png', 'http://www.baidu.com', '1', '23121', 3);
INSERT INTO `advert` VALUES (6, '/Uploads/advert/2018-03-20/5ab0d6a0034bd.jpg', 'http://www.baidu.com', '0', '广告', 1);
INSERT INTO `advert` VALUES (5, '/Uploads/advert/2017-12-14/5a31e41339aac.png', 'http://www.baidu.com', '1', '156', 4);

-- ----------------------------
-- Table structure for alipay
-- ----------------------------
DROP TABLE IF EXISTS `alipay`;
CREATE TABLE `alipay`  (
  `alipay_id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '用户id',
  `order_num` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '订单号',
  `money` float(255, 0) NOT NULL,
  `status` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '状态  0：待支付  1：成功  2：失败',
  `body` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '商品介绍',
  `product_id` float(11, 0) NOT NULL COMMENT '商品id',
  `time` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '时间',
  PRIMARY KEY (`alipay_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 25 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of alipay
-- ----------------------------
INSERT INTO `alipay` VALUES (1, 6, 'C3PGglzcAt4', 1, '1', '平台充值', 1, '1522650774');
INSERT INTO `alipay` VALUES (8, 6, 'jfKrnAdnmC3', 1, '0', '平台充值', 1, '1522716555');
INSERT INTO `alipay` VALUES (9, 70, 'fb6IuJgFxDJ', 1, '0', '平台充值', 1, '1522724725');
INSERT INTO `alipay` VALUES (10, 6, 'glZx86A6jET', 0, '1', '平台充值', 0, '1522724752');
INSERT INTO `alipay` VALUES (11, 6, 'l4cwnJxYMHr', 1, '0', '平台充值', 1, '1522725360');
INSERT INTO `alipay` VALUES (12, 6, 'Mxn5BZHCLEN', 1, '1', '平台充值', 1, '1522725375');
INSERT INTO `alipay` VALUES (13, 70, '0xzk3FFVML7', 1, '0', '平台充值', 1, '1522741210');
INSERT INTO `alipay` VALUES (14, 53, 'QHW1ec8a0LK', 6, '0', '平台充值', 6, '1522741766');
INSERT INTO `alipay` VALUES (15, 70, 'vNeGaT1qSEN', 1, '0', '平台充值', 1, '1522741799');
INSERT INTO `alipay` VALUES (16, 53, 'hDKf5G7WKWp', 0, '0', '平台充值', 0, '1522742160');
INSERT INTO `alipay` VALUES (17, 115, 'pYPq0bg78P6', 1, '0', '平台充值', 1, '1522742365');
INSERT INTO `alipay` VALUES (18, 70, 'i5KlOCL8xRT', 1, '1', '平台充值', 1, '1522742386');
INSERT INTO `alipay` VALUES (19, 70, 'TodExDuJtTm', 1, '0', '平台充值', 1, '1522742451');
INSERT INTO `alipay` VALUES (20, 53, 'Z93cSPl6qKG', 0, '1', '平台充值', 0, '1522742545');
INSERT INTO `alipay` VALUES (21, 115, '5Zeuey46cam', 1, '0', '平台充值', 1, '1522742667');
INSERT INTO `alipay` VALUES (22, 115, 'LzfPkQfuR2o', 1, '1', '平台充值', 1, '1522742733');
INSERT INTO `alipay` VALUES (23, 53, 'ZrzXOdThOcE', 0, '1', '平台充值', 0, '1522742811');
INSERT INTO `alipay` VALUES (24, 53, 'QsbHGBFdZ4o', 0, '1', '平台充值', 0, '1522743347');

-- ----------------------------
-- Table structure for apk
-- ----------------------------
DROP TABLE IF EXISTS `apk`;
CREATE TABLE `apk`  (
  `apk_id` int(11) NOT NULL AUTO_INCREMENT,
  `version` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '版本号名称',
  `download` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0' COMMENT '是否强制更新  0：否   1：是',
  `time` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '更新时间',
  `versioncode` int(11) NOT NULL COMMENT '版本号',
  `versionsize` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'apk的大小',
  PRIMARY KEY (`apk_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 19 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for authorityname
-- ----------------------------
DROP TABLE IF EXISTS `authorityname`;
CREATE TABLE `authorityname`  (
  `auth_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增主键',
  `pid` int(11) DEFAULT NULL COMMENT '父ID',
  `num` int(11) DEFAULT NULL COMMENT '编号',
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '权限名称',
  `path` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '权限路径',
  `status` char(1) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0' COMMENT '权限状态  默认0启用  1禁用',
  PRIMARY KEY (`auth_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 42 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of authorityname
-- ----------------------------
INSERT INTO `authorityname` VALUES (32, 0, 4, '直播管理', '0,0,', '0');
INSERT INTO `authorityname` VALUES (31, 0, 3, '教师资质审核', '0,0,', '0');
INSERT INTO `authorityname` VALUES (30, 0, 2, '物流管理', '0,0,', '0');
INSERT INTO `authorityname` VALUES (29, 0, 1, '提现管理', '0,0,', '0');
INSERT INTO `authorityname` VALUES (33, 0, 5, '积分商城', '0,0,', '0');
INSERT INTO `authorityname` VALUES (34, 0, 6, '举报管理', '0,0,', '0');
INSERT INTO `authorityname` VALUES (35, 0, 7, '热门推荐', '0,0,', '0');
INSERT INTO `authorityname` VALUES (36, 0, 8, '管理员权限', '0,0,', '0');
INSERT INTO `authorityname` VALUES (37, 0, 9, '用户管理', '0,0,', '0');
INSERT INTO `authorityname` VALUES (38, 0, 10, '评论管理', '0,0,', '0');
INSERT INTO `authorityname` VALUES (39, 0, 11, '常见问题管理', '0,0,', '0');
INSERT INTO `authorityname` VALUES (40, 0, 12, '服务协议管理', '0,0,', '0');
INSERT INTO `authorityname` VALUES (41, 0, 13, 'apk管理', '0,0,', '0');

-- ----------------------------
-- Table structure for cad
-- ----------------------------
DROP TABLE IF EXISTS `cad`;
CREATE TABLE `cad`  (
  `cad_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '课程广告id',
  `img` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '课程广告图片',
  `url` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '' COMMENT '课程广告url',
  `play_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '' COMMENT '课程id',
  `type` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '' COMMENT '类型，0：直播  1：视频',
  `time` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '时间',
  PRIMARY KEY (`cad_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cad
-- ----------------------------
INSERT INTO `cad` VALUES (1, '/Uploads/liveb/2018-03-15/5aaa063464ec1.jpg', '', '1', '0', '1513145356');
INSERT INTO `cad` VALUES (2, '/Uploads/liveb/2018-03-15/5aaa06be0386a.jpg', '', '2', '0', '1513145357');
INSERT INTO `cad` VALUES (3, '/Uploads/liveb/2018-03-15/5aaa06e77eb43.jpg', '', '3', '0', '1513145358');
INSERT INTO `cad` VALUES (4, '/Uploads/liveb/2018-03-13/5aa73931b3f2c.jpg', '', '41', '0', '1513145359');

-- ----------------------------
-- Table structure for category
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category`  (
  `cate_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '分类名称',
  `pid` int(11) NOT NULL DEFAULT 0 COMMENT '父id   本身是一级分类为0',
  `img` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '分类图标',
  PRIMARY KEY (`cate_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 67 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES (2, '语言学习', 0, '');
INSERT INTO `category` VALUES (3, '办公效率', 0, '');
INSERT INTO `category` VALUES (4, '文化教育', 0, '');
INSERT INTO `category` VALUES (5, '职业发展', 0, '');
INSERT INTO `category` VALUES (6, '英语口语', 2, '/Uploads/category/1.png');
INSERT INTO `category` VALUES (7, '英语四级', 2, '/Uploads/category/1.png');
INSERT INTO `category` VALUES (8, '托福考试', 2, '/Uploads/category/2.png');
INSERT INTO `category` VALUES (9, '外语早教', 2, '/Uploads/category/1.png');
INSERT INTO `category` VALUES (10, '英语六级', 2, '/Uploads/category/1.png');
INSERT INTO `category` VALUES (11, '韩语学习', 2, '/Uploads/category/1.png');
INSERT INTO `category` VALUES (12, '雅思考试', 2, '/Uploads/category/1.png');
INSERT INTO `category` VALUES (13, '俄语学习', 2, '/Uploads/category/2.png');
INSERT INTO `category` VALUES (14, '产品开发', 0, NULL);
INSERT INTO `category` VALUES (15, '办公软件', 3, '/Uploads/category/2.png');
INSERT INTO `category` VALUES (16, '思维导图', 3, '/Uploads/category/2.png');
INSERT INTO `category` VALUES (17, '基础操作', 3, '/Uploads/category/2.png');
INSERT INTO `category` VALUES (18, '英语启蒙', 4, '/Uploads/category/2.png');
INSERT INTO `category` VALUES (19, '认知早教', 4, '/Uploads/category/2.png');
INSERT INTO `category` VALUES (20, '小学教育', 4, '/Uploads/category/2.png');
INSERT INTO `category` VALUES (26, '沟通技巧', 3, '/Uploads/category/2.png');
INSERT INTO `category` VALUES (27, '常用工具', 3, '/Uploads/category/2.png');
INSERT INTO `category` VALUES (28, '办公习惯', 3, '/Uploads/category/2.png');
INSERT INTO `category` VALUES (34, '高中数学', 2, NULL);
INSERT INTO `category` VALUES (35, '高中语文', 2, NULL);
INSERT INTO `category` VALUES (36, '时间管理', 3, NULL);
INSERT INTO `category` VALUES (37, '思维方法', 3, NULL);
INSERT INTO `category` VALUES (40, '初中教育', 4, NULL);
INSERT INTO `category` VALUES (41, '高中教育', 4, NULL);
INSERT INTO `category` VALUES (42, '大学教育', 4, NULL);
INSERT INTO `category` VALUES (43, '考研教育', 4, NULL);
INSERT INTO `category` VALUES (44, '家庭教育', 4, NULL);
INSERT INTO `category` VALUES (47, '求职应聘', 5, NULL);
INSERT INTO `category` VALUES (48, '人力资源', 5, NULL);
INSERT INTO `category` VALUES (49, '管理能力', 5, NULL);
INSERT INTO `category` VALUES (50, '财会金融', 5, NULL);
INSERT INTO `category` VALUES (51, '法律法务', 5, NULL);
INSERT INTO `category` VALUES (52, '公务员', 5, NULL);
INSERT INTO `category` VALUES (53, '知识管理', 5, NULL);
INSERT INTO `category` VALUES (54, '市场营销', 5, NULL);
INSERT INTO `category` VALUES (57, '产品设计', 14, NULL);
INSERT INTO `category` VALUES (58, '用户体验', 14, NULL);
INSERT INTO `category` VALUES (59, '设计软件', 14, NULL);
INSERT INTO `category` VALUES (60, '编程语言', 14, NULL);
INSERT INTO `category` VALUES (61, '移动开发', 14, NULL);
INSERT INTO `category` VALUES (62, '游戏开发', 14, NULL);
INSERT INTO `category` VALUES (63, '网络营销', 14, NULL);
INSERT INTO `category` VALUES (64, '产品运营', 14, NULL);
INSERT INTO `category` VALUES (1, '推荐', 0, NULL);

-- ----------------------------
-- Table structure for class
-- ----------------------------
DROP TABLE IF EXISTS `class`;
CREATE TABLE `class`  (
  `class_id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '用户id',
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '课堂名称',
  `img` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '' COMMENT '封面图片',
  `roomcard` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '' COMMENT '房间号',
  `push` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '' COMMENT '推流地址',
  `pull1` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '' COMMENT '拉流地址1',
  `pull2` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '' COMMENT '拉流地址2',
  `pull3` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '' COMMENT '拉流地址3',
  `cate_id` int(11) DEFAULT NULL COMMENT '课堂分类',
  `profit` float(11, 2) UNSIGNED DEFAULT 0.00 COMMENT '累计收益',
  `tiaofu` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '条幅',
  PRIMARY KEY (`class_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 48 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of class
-- ----------------------------
INSERT INTO `class` VALUES (5, 6, 'PHP专业讲堂', '/Uploads/class/2018-03-15/5aaa304740a97.jpg', '6OIKFrFjQ', 'rtmp://15240.livepush.myqcloud.com/live/15240_6OIKFrFjQ?bizid=15240&txSecret=7b81f6f11912dae3a9fce27a6d7c4935&txTime=5AB067B3', 'rtmp://15240.liveplay.myqcloud.com/live/15240_6OIKFrFjQ', 'http://15240.liveplay.myqcloud.com/live/15240_6OIKFrFjQ.flv', 'http://15240.liveplay.myqcloud.com/live/15240_6OIKFrFjQ.m3u8', 2, 1059.00, '/Uploads/class/2018-03-15/5aaa304740358.jpg');
INSERT INTO `class` VALUES (27, 30, '小丫的课堂', '/Uploads/class/2018-03-19/5aaf81c76c5dc.png', '', '', '', '', '', 3, 903.00, '/Uploads/class/2018-03-19/5aaf81c76c199.jpg');
INSERT INTO `class` VALUES (29, 49, '史秀泽', '', '', '', '', '', '', 5, 2999.00, NULL);
INSERT INTO `class` VALUES (30, 53, '陈大爷', '', '', '', '', '', '', 4, 1086.00, NULL);
INSERT INTO `class` VALUES (33, 70, '史秀泽', '/Uploads/prove/2018-02-28/5a967b87aeb91.png', '', '', '', '', '', 14, 1003.00, NULL);
INSERT INTO `class` VALUES (40, 99, '金老师课堂', '/Uploads/class/2018-03-16/5aab2754cb207.jpg', '', '', '', '', '', 6, 25.00, '/Uploads/class/2018-03-16/5aab2754cad5a.jpg');
INSERT INTO `class` VALUES (41, 59, '解放军附加费', '', '', '', '', '', '', 6, 0.00, NULL);
INSERT INTO `class` VALUES (42, 117, '阚亮', '', '', '', '', '', '', 54, 93.00, NULL);
INSERT INTO `class` VALUES (44, 115, '王美丽', '/Uploads/prove/2018-03-20/5ab087b94bdf5.jpeg', '', '', '', '', '', 2, 0.00, NULL);
INSERT INTO `class` VALUES (45, 119, 'ios测试', '', '', '', '', '', '', 7, 0.00, NULL);
INSERT INTO `class` VALUES (46, 95, '55', '/Uploads/prove/2018-03-08/5aa0f1f7ea6a0.jpg', '', '', '', '', '', 0, 0.00, NULL);
INSERT INTO `class` VALUES (47, 97, '金特高级老师', '/Uploads/prove/2018-03-29/5abc41c3cfd8b.jpg', '', '', '', '', '', 2, 0.00, NULL);

-- ----------------------------
-- Table structure for comment_liveb
-- ----------------------------
DROP TABLE IF EXISTS `comment_liveb`;
CREATE TABLE `comment_liveb`  (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '用户id',
  `star` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '星级   0~5',
  `tid` int(11) NOT NULL COMMENT '老师id',
  `liveb_id` int(11) NOT NULL COMMENT '直播id',
  `time` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '时间',
  `content` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '内容',
  PRIMARY KEY (`comment_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 82 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of comment_liveb
-- ----------------------------
INSERT INTO `comment_liveb` VALUES (5, 6, '5', 70, 210, '1520320685', '直播很好');
INSERT INTO `comment_liveb` VALUES (6, 70, '4', 30, 203, '1520387390', '直播很好');
INSERT INTO `comment_liveb` VALUES (11, 53, '5', 70, 233, '1520415931', '直播很好');
INSERT INTO `comment_liveb` VALUES (12, 6, '5', 6, 1, '1520415931', '直播很好');
INSERT INTO `comment_liveb` VALUES (13, 30, '3', 19, 18, '1520496285', '直播很好');
INSERT INTO `comment_liveb` VALUES (15, 30, '4', 19, 42, '1520497700', '直播很好');
INSERT INTO `comment_liveb` VALUES (18, 6, '5', 6, 2, '1520497861', '直播很好');
INSERT INTO `comment_liveb` VALUES (19, 57, '3', 30, 116, '1520585745', '直播很好');
INSERT INTO `comment_liveb` VALUES (20, 97, '1', 99, 237, '1520590403', '直播很好');
INSERT INTO `comment_liveb` VALUES (21, 97, '4', 99, 238, '1520590482', '直播很好');
INSERT INTO `comment_liveb` VALUES (22, 53, '4', 70, 234, '1520841044', '直播很好');
INSERT INTO `comment_liveb` VALUES (23, 101, '5', 99, 243, '1520845185', '直播很好');
INSERT INTO `comment_liveb` VALUES (24, 99, '3', 101, 250, '1520913346', '直播很好');
INSERT INTO `comment_liveb` VALUES (25, 99, '3', 101, 254, '1520921910', '直播很好');
INSERT INTO `comment_liveb` VALUES (26, 30, '5', 6, 122, '1520924991', '反反复复');
INSERT INTO `comment_liveb` VALUES (27, 30, '5', 18, 112, '1520924991', '加油');
INSERT INTO `comment_liveb` VALUES (28, 110, '3', 99, 259, '1520934882', '不错的');
INSERT INTO `comment_liveb` VALUES (29, 111, '1', 99, 261, '1521005706', '讲很好，很不错');
INSERT INTO `comment_liveb` VALUES (30, 111, '5', 99, 262, '1521005738', '好');
INSERT INTO `comment_liveb` VALUES (31, 6, '5', 30, 258, '1521006299', '123123');
INSERT INTO `comment_liveb` VALUES (32, 30, '3', 6, 257, '1521006323', '5555555');
INSERT INTO `comment_liveb` VALUES (33, 30, '4', 72, 218, '1521007094', '吃吃吃');
INSERT INTO `comment_liveb` VALUES (34, 6, '5', 2, 8, '1581374981', '直播很好');
INSERT INTO `comment_liveb` VALUES (35, 12, '4', 6, 257, '1521007094', '66666666');
INSERT INTO `comment_liveb` VALUES (36, 13, '4', 6, 257, '1521007094', '55555555');
INSERT INTO `comment_liveb` VALUES (37, 14, '3', 6, 257, '1521007094', '4444444');
INSERT INTO `comment_liveb` VALUES (38, 15, '4', 6, 257, '1521007094', '1');
INSERT INTO `comment_liveb` VALUES (39, 16, '3', 6, 257, '1521007094', '2');
INSERT INTO `comment_liveb` VALUES (40, 17, '5', 6, 257, '1521007094', '3');
INSERT INTO `comment_liveb` VALUES (42, 19, '4', 6, 257, '1521007094', '5');
INSERT INTO `comment_liveb` VALUES (43, 20, '3', 6, 257, '1521007094', '6');
INSERT INTO `comment_liveb` VALUES (45, 22, '5', 6, 257, '1521007094', '8');
INSERT INTO `comment_liveb` VALUES (46, 23, '5', 6, 257, '1521007094', '9');
INSERT INTO `comment_liveb` VALUES (47, 24, '5', 6, 257, '1521007094', '10');
INSERT INTO `comment_liveb` VALUES (51, 43, '5', 6, 257, '1521007094', '14');
INSERT INTO `comment_liveb` VALUES (52, 44, '5', 6, 257, '1521007094', '15');
INSERT INTO `comment_liveb` VALUES (54, 46, '5', 6, 257, '1521007094', '17');
INSERT INTO `comment_liveb` VALUES (57, 50, '5', 6, 257, '1521007094', '20');
INSERT INTO `comment_liveb` VALUES (58, 101, '3', 99, 345, '1521515106', '口语挺流利还行，但是语言有些听不懂，可能是发音的问题。希望更加完善');
INSERT INTO `comment_liveb` VALUES (61, 117, '4', 99, 356, '1521619851', '课程不错比较满意');
INSERT INTO `comment_liveb` VALUES (62, 99, '5', 117, 361, '1521768358', '讲的很好');
INSERT INTO `comment_liveb` VALUES (63, 53, '4', 70, 334, '1522024613', '666');
INSERT INTO `comment_liveb` VALUES (64, 99, '5', 115, 370, '1522024835', '好');
INSERT INTO `comment_liveb` VALUES (65, 115, '4', 99, 355, '1522052137', '课程很优秀');
INSERT INTO `comment_liveb` VALUES (66, 115, '5', 99, 365, '1522054601', '花花世界还是生活都很简单很舒服哈哈嘎嘎嘎嘎鬼斧神工的好多规范法官好多哈哈公司哥哥');
INSERT INTO `comment_liveb` VALUES (67, 115, '5', 117, 371, '1522054637', '滴滴答答滴滴答答的风疯疯癫癫随时随地风风光光哈哈哥哥发随时随地都的的方法');
INSERT INTO `comment_liveb` VALUES (68, 115, '5', 53, 369, '1522054649', '俄方翡翠尺寸');
INSERT INTO `comment_liveb` VALUES (70, 115, '5', 99, 347, '1522056909', 'Asdf');
INSERT INTO `comment_liveb` VALUES (71, 117, '5', 99, 357, '1522116786', '\n\n\n\n\n风格迥异于changren');
INSERT INTO `comment_liveb` VALUES (72, 117, '3', 99, 373, '1522116807', '还行');
INSERT INTO `comment_liveb` VALUES (73, 117, '5', 99, 374, '1522116835', '好好好');
INSERT INTO `comment_liveb` VALUES (74, 117, '1', 99, 375, '1522116855', '差');
INSERT INTO `comment_liveb` VALUES (75, 115, '4', 99, 351, '1522121804', '比较满意');
INSERT INTO `comment_liveb` VALUES (76, 115, '5', 117, 359, '1522134177', '非常好');
INSERT INTO `comment_liveb` VALUES (77, 115, '5', 99, 354, '1522136542', '讲什么玩意');
INSERT INTO `comment_liveb` VALUES (78, 117, '5', 99, 380, '1522219589', '非常好');
INSERT INTO `comment_liveb` VALUES (79, 97, '4', 99, 386, '1522377922', '比较满意，好评');
INSERT INTO `comment_liveb` VALUES (80, 115, '1', 117, 381, '1522654810', '差评');
INSERT INTO `comment_liveb` VALUES (81, 115, '5', 117, 384, '1522654852', '非常好');

-- ----------------------------
-- Table structure for comment_liveb_star
-- ----------------------------
DROP TABLE IF EXISTS `comment_liveb_star`;
CREATE TABLE `comment_liveb_star`  (
  `comment_liveb_star_id` int(11) NOT NULL AUTO_INCREMENT,
  `tid` int(11) NOT NULL COMMENT '老师id',
  `star` int(11) NOT NULL DEFAULT 0 COMMENT '总星数',
  `num` int(11) NOT NULL DEFAULT 0 COMMENT '评论总条数',
  PRIMARY KEY (`comment_liveb_star_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of comment_liveb_star
-- ----------------------------
INSERT INTO `comment_liveb_star` VALUES (1, 6, 122, 27);
INSERT INTO `comment_liveb_star` VALUES (2, 70, 18, 4);
INSERT INTO `comment_liveb_star` VALUES (3, 30, 12, 3);
INSERT INTO `comment_liveb_star` VALUES (4, 19, 7, 2);
INSERT INTO `comment_liveb_star` VALUES (5, 99, 72, 22);
INSERT INTO `comment_liveb_star` VALUES (6, 101, 6, 2);
INSERT INTO `comment_liveb_star` VALUES (7, 18, 5, 1);
INSERT INTO `comment_liveb_star` VALUES (8, 72, 4, 1);
INSERT INTO `comment_liveb_star` VALUES (9, 2, 5, 1);
INSERT INTO `comment_liveb_star` VALUES (10, 117, 21, 5);
INSERT INTO `comment_liveb_star` VALUES (11, 115, 5, 1);
INSERT INTO `comment_liveb_star` VALUES (12, 53, 5, 1);

-- ----------------------------
-- Table structure for comment_video
-- ----------------------------
DROP TABLE IF EXISTS `comment_video`;
CREATE TABLE `comment_video`  (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '用户id',
  `star` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '评论星级   0~5',
  `content` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '评论内容',
  `video_id` int(11) NOT NULL COMMENT '视频id',
  `time` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '时间',
  PRIMARY KEY (`comment_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 52 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of comment_video
-- ----------------------------
INSERT INTO `comment_video` VALUES (1, 23, '4', '加油', 3, '1581374981');
INSERT INTO `comment_video` VALUES (5, 69, '3', 'dffdfdf', 3, '1581374981');
INSERT INTO `comment_video` VALUES (6, 6, '4', 'dfdfddf', 2, '1581374981');
INSERT INTO `comment_video` VALUES (7, 6, '4', 'klkkk', 4, '1581374981');
INSERT INTO `comment_video` VALUES (8, 6, '5', 'sdsd', 3, '1581374981');
INSERT INTO `comment_video` VALUES (9, 6, '3', 'dsas', 3, '1581374981');
INSERT INTO `comment_video` VALUES (10, 6, '4', '这是个好视频', 3, '1581374981');
INSERT INTO `comment_video` VALUES (13, 53, '3', '花花似符号位啊胡覅会福哈苏丹红 我安徽的首付合伙人共同几百块技术报告最好的幸福参与感 hido一过户时额度个体户委员会干别的办法VB啥待遇不规范 ID黑寡妇会死U盾会给一hi贷款价格分别开奖号丢发过火 我华盛顿估计很快就收到货给客户', 6, '1520401468');
INSERT INTO `comment_video` VALUES (14, 53, '3', 'KTV啦獭兔不他涂卡偷偷头疼', 22, '1520401795');
INSERT INTO `comment_video` VALUES (15, 30, '4', 'fgfhgfjdgjfgfddddddddddddddddddddddddjh', 6, '1520486160');
INSERT INTO `comment_video` VALUES (16, 30, '3', 'haikeyi\n', 27, '1520489831');
INSERT INTO `comment_video` VALUES (17, 95, '1', '讲的很好', 20, '1520494783');
INSERT INTO `comment_video` VALUES (18, 95, '5', '好', 11, '1520494958');
INSERT INTO `comment_video` VALUES (19, 101, '5', '哈哈爱大啊擦擦擦擦擦吃菜咯故事力量力量力量力量力量力量力量力量力量力量力量力量力量力量力量力量来咯啦啦啦啦啦啦噜突突突突突突突突突突突突突突的突突突天突突突突突突突突突兔兔突突突突突突突突突突突突突突突突突', 28, '1520846347');
INSERT INTO `comment_video` VALUES (20, 101, '5', '\n哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈韩国手工活哈哈哈哈哈哈哈哈好好地韩国代购回电话给哥哥哥哥哥哥哥哥的孤独感给哥哥哥哥姐姐如何的好与坏好好地韩国高端 v 恶搞个月的黑汇聚一堂团日活动哈哈', 50, '1520904951');
INSERT INTO `comment_video` VALUES (21, 101, '2', 'ygghgvg', 6, '1520905076');
INSERT INTO `comment_video` VALUES (22, 99, '3', '换个广告广告', 5, '1520905132');
INSERT INTO `comment_video` VALUES (23, 99, '3', '你天天人人人人人去旅行指南，哥哥哥哥和弟弟', 72, '1520922077');
INSERT INTO `comment_video` VALUES (24, 99, '3', '放水电费水电费付付付付多所多付辅导费放水电费水电费付付付付多所多付辅导费放水电费水电费付付付付多所多', 20, '1520923122');
INSERT INTO `comment_video` VALUES (25, 111, '4', '攻击力垃圾垃圾TUT普及all了魔攻摸摸弄摸摸弄哦尼酱路上看记录哦你居然家里罢了寂寞扔垃圾呢hell怕bill', 67, '1521007101');
INSERT INTO `comment_video` VALUES (26, 111, '4', '攻击力垃圾垃圾TUT普及all了魔攻摸摸弄摸摸弄哦尼酱路上看记录哦你居然家里罢了寂寞扔垃圾呢hell怕bill', 67, '1521007101');
INSERT INTO `comment_video` VALUES (27, 111, '1', '哈哈哈还才把哈哈', 59, '1521007330');
INSERT INTO `comment_video` VALUES (28, 111, '4', '好好好', 68, '1521084508');
INSERT INTO `comment_video` VALUES (29, 99, '4', '讲的非常棒', 80, '1521105288');
INSERT INTO `comment_video` VALUES (30, 99, '4', '66666', 77, '1521107503');
INSERT INTO `comment_video` VALUES (31, 99, '4', '好', 79, '1521107631');
INSERT INTO `comment_video` VALUES (32, 111, '5', '讲的非常好，赞一个惊世骇俗呵呵呵呵呵呵呵呵呵呵呵呵呵呵呵呵呵呵呵呵呵呵呵呵的是义务呵呵呵呵克杰呵呵呵呵的哈哈哈给哈哈哈哈好吧吧吧吧吧吧吧吧吧吧吧吧都会变得不到吧呵呵好的呵呵的哈哈哈哈呵呵呵呵呵呵据说好多好多好多话呵呵呵呵的好多黄赌毒馥郁芬芳以后哈呵呵呵呵呵呵哈哈哈哈哈哈', 106, '1521422404');
INSERT INTO `comment_video` VALUES (33, 115, '5', '讲的很好', 98, '1521528147');
INSERT INTO `comment_video` VALUES (34, 115, '5', '课程非常*，讲的非常好', 97, '1521528799');
INSERT INTO `comment_video` VALUES (35, 115, '5', '好', 102, '1521602997');
INSERT INTO `comment_video` VALUES (36, 117, '5', '好', 109, '1521616651');
INSERT INTO `comment_video` VALUES (37, 120, '4', '还行，比较满意', 106, '1521776827');
INSERT INTO `comment_video` VALUES (38, 120, '3', '一般', 98, '1521776870');
INSERT INTO `comment_video` VALUES (39, 117, '5', '讲的很好哈哈哈哈', 111, '1521795992');
INSERT INTO `comment_video` VALUES (40, 53, '5', '好', 106, '1522024501');
INSERT INTO `comment_video` VALUES (41, 99, '3', 'YY呀', 102, '1522118548');
INSERT INTO `comment_video` VALUES (42, 115, '5', '好', 106, '1522121875');
INSERT INTO `comment_video` VALUES (43, 117, '5', '非常好，认真，讲的细致', 130, '1522216578');
INSERT INTO `comment_video` VALUES (44, 99, '5', '讲的非常好', 90, '1522382207');
INSERT INTO `comment_video` VALUES (45, 99, '1', '还行', 113, '1522392057');
INSERT INTO `comment_video` VALUES (46, 115, '4', '好评', 119, '1522398139');
INSERT INTO `comment_video` VALUES (47, 115, '5', '很好verygood', 131, '1522398398');
INSERT INTO `comment_video` VALUES (48, 99, '5', '尽快离开家尽快老快了考老客了极乐空间立刻离开了看见了科技六路就两节课了空间来看了健康健健康康路口监控', 141, '1522634460');
INSERT INTO `comment_video` VALUES (49, 99, '5', '课程非常棒，五星好评', 128, '1522638373');
INSERT INTO `comment_video` VALUES (50, 115, '5', '**', 129, '1522653394');
INSERT INTO `comment_video` VALUES (51, 115, '5', '讲课幽默风趣', 96, '1522738857');

-- ----------------------------
-- Table structure for comment_video_star
-- ----------------------------
DROP TABLE IF EXISTS `comment_video_star`;
CREATE TABLE `comment_video_star`  (
  `comment_video_star_id` int(11) NOT NULL AUTO_INCREMENT,
  `video_id` int(11) NOT NULL COMMENT '视频id',
  `star` int(11) NOT NULL DEFAULT 0 COMMENT '总星数',
  `num` int(11) NOT NULL DEFAULT 0 COMMENT '评论总条数',
  PRIMARY KEY (`comment_video_star_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 34 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of comment_video_star
-- ----------------------------
INSERT INTO `comment_video_star` VALUES (1, 3, 19, 5);
INSERT INTO `comment_video_star` VALUES (2, 2, 4, 1);
INSERT INTO `comment_video_star` VALUES (3, 4, 4, 1);
INSERT INTO `comment_video_star` VALUES (4, 6, 9, 3);
INSERT INTO `comment_video_star` VALUES (5, 22, 3, 1);
INSERT INTO `comment_video_star` VALUES (6, 27, 3, 1);
INSERT INTO `comment_video_star` VALUES (7, 20, 4, 2);
INSERT INTO `comment_video_star` VALUES (8, 11, 5, 1);
INSERT INTO `comment_video_star` VALUES (9, 28, 5, 1);
INSERT INTO `comment_video_star` VALUES (10, 50, 5, 1);
INSERT INTO `comment_video_star` VALUES (11, 5, 3, 1);
INSERT INTO `comment_video_star` VALUES (12, 72, 3, 1);
INSERT INTO `comment_video_star` VALUES (13, 67, 8, 2);
INSERT INTO `comment_video_star` VALUES (14, 59, 1, 1);
INSERT INTO `comment_video_star` VALUES (15, 68, 4, 1);
INSERT INTO `comment_video_star` VALUES (16, 80, 4, 1);
INSERT INTO `comment_video_star` VALUES (17, 77, 4, 1);
INSERT INTO `comment_video_star` VALUES (18, 79, 4, 1);
INSERT INTO `comment_video_star` VALUES (19, 106, 19, 4);
INSERT INTO `comment_video_star` VALUES (20, 98, 8, 2);
INSERT INTO `comment_video_star` VALUES (21, 97, 5, 1);
INSERT INTO `comment_video_star` VALUES (22, 102, 8, 2);
INSERT INTO `comment_video_star` VALUES (23, 109, 5, 1);
INSERT INTO `comment_video_star` VALUES (24, 111, 5, 1);
INSERT INTO `comment_video_star` VALUES (25, 130, 5, 1);
INSERT INTO `comment_video_star` VALUES (26, 90, 5, 1);
INSERT INTO `comment_video_star` VALUES (27, 113, 1, 1);
INSERT INTO `comment_video_star` VALUES (28, 119, 4, 1);
INSERT INTO `comment_video_star` VALUES (29, 131, 5, 1);
INSERT INTO `comment_video_star` VALUES (30, 141, 5, 1);
INSERT INTO `comment_video_star` VALUES (31, 128, 5, 1);
INSERT INTO `comment_video_star` VALUES (32, 129, 5, 1);
INSERT INTO `comment_video_star` VALUES (33, 96, 5, 1);

-- ----------------------------
-- Table structure for feedback
-- ----------------------------
DROP TABLE IF EXISTS `feedback`;
CREATE TABLE `feedback`  (
  `feedback_id` int(11) NOT NULL AUTO_INCREMENT,
  `text` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '内容',
  `time` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '时间',
  `contact` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '' COMMENT '联系方式',
  PRIMARY KEY (`feedback_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 80 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of feedback
-- ----------------------------
INSERT INTO `feedback` VALUES (4, '舵手 舶用的', '3455435', '678');
INSERT INTO `feedback` VALUES (5, '哈哈哈', '1510295862', '18888888888');
INSERT INTO `feedback` VALUES (6, '哈哈哈', '1510295893', '18888888888');
INSERT INTO `feedback` VALUES (7, '哈哈哈', '1510298181', '18888888888');
INSERT INTO `feedback` VALUES (14, '空间看看', '1512723140', '13020336666');
INSERT INTO `feedback` VALUES (9, '哈哈哈', '1510636666', '18888888888');
INSERT INTO `feedback` VALUES (10, '哈哈哈', '1510636666', '18888888888');
INSERT INTO `feedback` VALUES (11, 'Asdfasdfasedf', '1510651116', '123123123123');
INSERT INTO `feedback` VALUES (12, '123123123', '1510651304', '18841765036');
INSERT INTO `feedback` VALUES (13, '我', '1511319490', '18841765036');
INSERT INTO `feedback` VALUES (15, '空间看看', '1512723141', '13020336666');
INSERT INTO `feedback` VALUES (16, '空间看看', '1512723142', '13020336666');
INSERT INTO `feedback` VALUES (17, '空间看看', '1512723144', '13020336666');
INSERT INTO `feedback` VALUES (18, '空间看看', '1512723145', '13020336666');
INSERT INTO `feedback` VALUES (19, '空间看看', '1512723146', '13020336666');
INSERT INTO `feedback` VALUES (20, '空间看看', '1512723147', '13020336666');
INSERT INTO `feedback` VALUES (21, '空间看看', '1512723147', '13020336666');
INSERT INTO `feedback` VALUES (22, '空间看看', '1512723147', '13020336666');
INSERT INTO `feedback` VALUES (23, '空间看看', '1512723147', '13020336666');
INSERT INTO `feedback` VALUES (24, '空间看看', '1512723148', '13020336666');
INSERT INTO `feedback` VALUES (25, '空间看看', '1512723148', '13020336666');
INSERT INTO `feedback` VALUES (26, '空间看看', '1512723148', '13020336666');
INSERT INTO `feedback` VALUES (27, '空间看看', '1512723149', '13020336666');
INSERT INTO `feedback` VALUES (28, '空间看看', '1512723149', '13020336666');
INSERT INTO `feedback` VALUES (29, '空间看看', '1512723149', '13020336666');
INSERT INTO `feedback` VALUES (30, '空间看看', '1512723149', '13020336666');
INSERT INTO `feedback` VALUES (31, '空间看看', '1512723149', '13020336666');
INSERT INTO `feedback` VALUES (32, '空间看看', '1512723150', '13020336666');
INSERT INTO `feedback` VALUES (33, '空间看看', '1512723150', '13020336666');
INSERT INTO `feedback` VALUES (34, '空间看看', '1512723150', '13020336666');
INSERT INTO `feedback` VALUES (35, '空间看看', '1512723150', '13020336666');
INSERT INTO `feedback` VALUES (36, '空间看看', '1512723151', '13020336666');
INSERT INTO `feedback` VALUES (37, '空间看看', '1512723151', '13020336666');
INSERT INTO `feedback` VALUES (38, '空间看看', '1512723151', '13020336666');
INSERT INTO `feedback` VALUES (39, '空间看看', '1512723151', '13020336666');
INSERT INTO `feedback` VALUES (40, '空间看看', '1512723152', '13020336666');
INSERT INTO `feedback` VALUES (41, '空间看看', '1512723152', '13020336666');
INSERT INTO `feedback` VALUES (42, '空间看看', '1512723152', '13020336666');
INSERT INTO `feedback` VALUES (43, '空间看看', '1512723154', '13020336666');
INSERT INTO `feedback` VALUES (44, '空间看看', '1512723155', '13020336666');
INSERT INTO `feedback` VALUES (45, '您的意见', '1512974664', '18842456666');
INSERT INTO `feedback` VALUES (46, '您的意见', '1512974851', '18842456666');
INSERT INTO `feedback` VALUES (47, '哈哈哈哈', '1513049046', '13020336666');
INSERT INTO `feedback` VALUES (48, '哈哈哈哈', '1513049051', '13020336666');
INSERT INTO `feedback` VALUES (49, '哈哈哈哈', '1513049131', '13020336666');
INSERT INTO `feedback` VALUES (50, '哈哈哈哈', '1513049136', '13020336666');
INSERT INTO `feedback` VALUES (51, '哈哈哈哈', '1513049233', '13020336666');
INSERT INTO `feedback` VALUES (52, 'r t t', '1513057355', '');
INSERT INTO `feedback` VALUES (53, '精疲力尽你红酒', '1513063799', '13020336666');
INSERT INTO `feedback` VALUES (54, '精疲力尽你红酒', '1513063800', '13020336666');
INSERT INTO `feedback` VALUES (55, '精疲力尽你红酒', '1513063800', '13020336666');
INSERT INTO `feedback` VALUES (56, '哈哈哈', '1515051744', '18888888888');
INSERT INTO `feedback` VALUES (57, '15784155454545454545', '1516327296', '15702431419');
INSERT INTO `feedback` VALUES (58, '656455555212336666622', '1516604258', '15702431419');
INSERT INTO `feedback` VALUES (59, '是不是在做梦、', '1516780609', '15026843402');
INSERT INTO `feedback` VALUES (60, '盖被被套牢里没有人知道', '1519781417', '17640199694');
INSERT INTO `feedback` VALUES (61, '哈哈哈', '1519817566', '13020330000');
INSERT INTO `feedback` VALUES (62, '哈哈哈', '1519817568', '13020330000');
INSERT INTO `feedback` VALUES (63, '就几个功能', '1519817651', '13020336649');
INSERT INTO `feedback` VALUES (64, '就几个功能', '1519817656', '13020336649');
INSERT INTO `feedback` VALUES (65, '哈哈哈', '1519881009', '18888888888');
INSERT INTO `feedback` VALUES (66, '你吼吼吼QQ哦QQ哦QQ哦', '1519887509', '13050000000');
INSERT INTO `feedback` VALUES (67, '左三圈右三圈左三圈右三圈万事如意', '1519887975', '13055000000');
INSERT INTO `feedback` VALUES (68, '这特么啥', '1519888489', '13666655888');
INSERT INTO `feedback` VALUES (69, '你公司破轻松7艘9组所以现在', '1519888536', '13977979979');
INSERT INTO `feedback` VALUES (70, 'OPPO泼泼洒洒轻轻松松', '1519888560', '15977776766');
INSERT INTO `feedback` VALUES (71, '哦QQ哦QQ哦QQ哦QQ哦', '1519888723', '18677777979');
INSERT INTO `feedback` VALUES (72, '测试', '1520227339', '12000000000');
INSERT INTO `feedback` VALUES (73, '反倒是电风扇的冯绍峰的放水电费水电费发送到发送到反倒是电风扇的冯绍峰的放水电费水电费发送到发送到反倒是电风扇的冯绍峰的放水电费水电费发送到发送到反倒是电风扇的冯绍峰的放水电费水电费发送到发送到反倒是电', '1520480768', '13610252598');
INSERT INTO `feedback` VALUES (74, '3.9意见反馈内容3.9意见反馈内容3.9意见反馈内容3.9意见反馈内容3.9意见反馈内容3.9意见反馈内容3.9意见反馈内容3.9意见反馈内容3.9意见反馈内容3.9意见反馈内容3.9意见反馈内容3', '1520576379', '133');
INSERT INTO `feedback` VALUES (75, '凑凑凑凑凑凑凑凑', '1520820307', '155555');
INSERT INTO `feedback` VALUES (76, 'ffff', '1520820529', '15702431419');
INSERT INTO `feedback` VALUES (77, '呵呵哒呵呵哒好多话好多好多好多好多话也与好多好多哈哈好的互动哈哈哈哈134', '1520924393', '13580088825');
INSERT INTO `feedback` VALUES (78, '很好', '1521014478', '13600000000');
INSERT INTO `feedback` VALUES (79, '基地科技大发牢骚看电视来看空积分几点开始劳动竞赛分类点击放得开就说了都放假了东方时空都放假了基地科技大发牢骚看电视来看空积分几点开始劳动竞赛分类点击放得开就说了都放假了东方时空都放假了基地科技大发牢', '1521510284', '13600000000');

-- ----------------------------
-- Table structure for good
-- ----------------------------
DROP TABLE IF EXISTS `good`;
CREATE TABLE `good`  (
  `good_id` int(11) NOT NULL AUTO_INCREMENT,
  `price` int(11) DEFAULT NULL COMMENT '价格',
  `stock` int(11) DEFAULT NULL COMMENT '库存',
  `img` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '封面',
  `time` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '上架时间',
  `timeend` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '截止时间',
  `status` char(1) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '1' COMMENT '状态    1：上架   2：下架',
  `details` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '商品详情',
  `rule` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '兑换规则',
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '商品名称',
  `type` char(1) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '1' COMMENT '类别   1：热门专区   2：兑奖专区',
  `type_id` int(11) NOT NULL COMMENT '类别ID',
  PRIMARY KEY (`good_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 123 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of good
-- ----------------------------
INSERT INTO `good` VALUES (122, 60000, 25, '/Uploads/good/2018-02-27/5a94cb0fce5b0.jpg', '2018-03-05 18:43:20', '2018-03-08 18:43:27', '1', '高品质，价格低', '每一积分兑换一积分', '远航书靠书立书档摆件', '', 4);
INSERT INTO `good` VALUES (96, 60000, 25, '/Uploads/good/2018-02-27/5a94caa04736d.jpg', '2018-02-17 18:17:35', '2018-02-26 18:17:38', '1', '高品质，价格低', '每一积分兑换一积分', '黄小米食品粮食', '', 1);
INSERT INTO `good` VALUES (97, 2, 21, '/Uploads/good/2018-02-27/5a94ca7ddd347.jpg', '2018-02-20 18:18:04', '2018-02-28 18:18:07', '1', '高品质，价格低', '每一积分兑换一积分', '红豆食品', '', 1);
INSERT INTO `good` VALUES (98, 2, 15, '/Uploads/good/2018-02-27/5a94ca4d6f58a.jpg', '2018-02-23 18:18:55', '2018-02-28 18:18:59', '1', '高品质，价格低', '每一积分兑换一积分', '木质盘子', '', 2);
INSERT INTO `good` VALUES (99, 60000, 24, '/Uploads/good/2018-02-27/5a94ca3e7f081.jpg', '2018-02-24 18:19:23', '2018-02-28 18:19:27', '1', '高品质，价格低', '每一积分兑换一积分', '毛巾', '', 2);
INSERT INTO `good` VALUES (100, 60000, 25, '/Uploads/good/2018-02-27/5a94ca30049aa.jpg', '2018-02-16 18:19:47', '2018-02-28 18:19:51', '1', '高品质，价格低', '每一积分兑换一积分', '棉拖鞋', '', 2);
INSERT INTO `good` VALUES (101, 60000, 21, '/Uploads/good/2018-02-28/5a960977e434e.jpg', '2018-02-24 12:00:00', '2018-02-28 18:20:10', '1', '高品质，价格低', '每一积分兑换一积分', '家居四件套', '1', 2);
INSERT INTO `good` VALUES (102, 60000, 25, '/Uploads/good/2018-02-27/5a94c7c008489.jpg', '2018-02-17 18:20:31', '2018-02-28 18:20:36', '1', '高品质，价格低', '每一积分兑换一积分', '保温杯', '', 2);
INSERT INTO `good` VALUES (103, 60000, 24, '/Uploads/good/2018-02-27/5a94ca4d6f58a.jpg', '2018-02-13 18:22:19', '2018-02-28 18:22:22', '1', '高品质，价格低', '每一积分兑换一积分', '菜板子', '2', 2);
INSERT INTO `good` VALUES (104, 60000, 23, '/Uploads/good/2018-02-27/5a94ccef42bed.jpg', '2018-02-08 18:22:56', '2018-02-28 18:22:59', '1', '高品质，价格低', '每一积分兑换一积分', '带边纸巾盒', '2', 2);
INSERT INTO `good` VALUES (105, 60000, 25, '/Uploads/good/2018-02-27/5a94ccdd2e9fe.jpg', '2018-02-15 18:23:16', '2018-02-28 18:23:18', '1', '高品质，价格低', '每一积分兑换一积分', 'SOAP洗发水', '2', 2);
INSERT INTO `good` VALUES (106, 60000, 25, '/Uploads/good/2018-02-27/5a94ccb0da019.jpg', '2018-02-26 18:24:03', '2018-02-28 18:24:05', '1', '高品质，价格低', '每一积分兑换一积分', 'Midea美的多功能电饭煲', '2', 3);
INSERT INTO `good` VALUES (107, 60000, 25, '/Uploads/good/2018-02-27/5a94cc9b929e1.jpg', '2018-02-07 18:26:09', '2018-02-28 18:26:11', '1', '高品质，价格低', '每一积分兑换一积分', 'Midea美的烤箱', '', 3);
INSERT INTO `good` VALUES (108, 60000, 25, '/Uploads/good/2018-02-27/5a94cc8742b9d.jpg', '2018-02-06 18:27:55', '2018-02-27 18:27:58', '1', '高品质，价格低', '每一积分兑换一积分', 'Midea美的电饭煲', '', 3);
INSERT INTO `good` VALUES (109, 60000, 25, '/Uploads/good/2018-02-27/5a94cc72c3d93.jpg', '2018-02-27 18:28:15', '2018-03-02 18:27:00', '1', '高品质，价格低', '每一积分兑换一积分', '尼康单反照相机', '', 3);
INSERT INTO `good` VALUES (112, 60000, 25, '/Uploads/good/2018-02-28/5a9675ef7ae7a.jpg', '2018-02-15 18:28:37', '2018-02-22 18:28:39', '1', '高品质，价格低', '每一积分兑换一积分', '名爵士机械手表', '1', 3);
INSERT INTO `good` VALUES (111, 60000, 25, '/Uploads/good/2018-02-28/5a9675f9177f2.jpg', '2018-02-15 18:28:54', '2018-03-01 18:28:57', '1', '高品质，价格低', '每一积分兑换一积分', '天梭腕表黑色男士表手表男表', '1', 3);
INSERT INTO `good` VALUES (110, 60000, 25, '/Uploads/good/2018-02-27/5a94cc3e9fe39.jpg', '2018-02-19 18:29:18', '2018-02-28 18:29:21', '1', '高品质，价格低', '每一积分兑换一积分', 'Midea豆浆机', '1', 3);
INSERT INTO `good` VALUES (113, 60000, 25, '/Uploads/good/2018-02-27/5a94cbe9d2099.jpg', '2018-02-20 18:29:39', '2018-02-28 18:29:43', '1', '高品质，价格低', '每一积分兑换一积分', '吹风筒', '', 3);
INSERT INTO `good` VALUES (114, 60000, 25, '/Uploads/good/2018-02-27/5a94cbd541371.jpg', '2018-02-27 18:32:57', '2018-02-28 18:33:01', '1', '高品质，价格低', '每一积分兑换一积分', '家居饰品马摆件客厅酒柜招财摆设', '', 4);
INSERT INTO `good` VALUES (115, 60000, 25, '/Uploads/good/2018-02-27/5a94cbbf48689.jpg', '2018-02-13 18:33:48', '2018-02-28 18:33:50', '1', '高品质，价格低', '每一积分兑换一积分', '古玩石狮子', '', 4);
INSERT INTO `good` VALUES (116, 60000, 25, '/Uploads/good/2018-02-27/5a94cba577562.jpg', '2018-03-01 18:34:11', '2018-03-02 18:34:13', '1', '高品质，价格低', '每一积分兑换一积分', '摆件家居饰品客厅酒柜小象摆设新', '', 4);
INSERT INTO `good` VALUES (117, 60000, 25, '/Uploads/good/2018-02-27/5a94cb84a9105.jpg', '2018-02-26 18:34:30', '2018-03-01 18:34:31', '1', '高品质，价格低', '每一积分兑换一积分', '复古瓷器陶瓷饰品', '', 4);
INSERT INTO `good` VALUES (118, 60000, 25, '/Uploads/good/2018-02-27/5a94cb60378ba.jpg', '2018-02-21 18:34:48', '2018-02-28 18:34:54', '1', '高品质，价格低', '每一积分兑换一积分', '绿色食品大米', '', 1);
INSERT INTO `good` VALUES (119, 60000, 25, '/Uploads/good/2018-02-27/5a94cb45e7fbc.jpg', '2018-02-14 18:35:17', '2018-02-08 18:35:19', '1', '高品质，价格低', '每一积分兑换一积分', '银手镯', '', 4);
INSERT INTO `good` VALUES (120, 60000, 25, '/Uploads/good/2018-02-27/5a94cb35b4c0c.jpg', '2018-02-23 18:36:08', '2018-02-28 18:36:10', '1', '高品质，价格低', '每一积分兑换一积分', '鹅蛋石饰品', '', 4);
INSERT INTO `good` VALUES (121, 60000, 25, '/Uploads/good/2018-02-27/5a94cb24443cb.jpg', '2018-02-13 18:36:33', '2018-02-27 18:36:35', '1', '高品质，价格低', '每一积分兑换一积分', '现代简约家居饰品摆件铝合金烤漆', '', 4);
INSERT INTO `good` VALUES (95, 60000, 25, '/Uploads/good/2018-02-27/5a94cab01ac2a.jpg', '2018-02-23 18:17:14', '2018-02-28 18:17:18', '1', '高品质，价格低', '每一积分兑换一积分', '坚果', '', 1);
INSERT INTO `good` VALUES (94, 60000, 25, '/Uploads/good/2018-02-27/5a94cac5c41f5.jpg', '2018-02-26 18:16:55', '2018-02-28 18:16:57', '1', '高品质，价格低', '每一积分兑换一积分', '进口零食礼包', '', 1);
INSERT INTO `good` VALUES (93, 60000, 25, '/Uploads/good/2018-02-27/5a94cadb2b745.jpg', '2018-02-22 18:16:28', '2018-03-08 18:16:31', '1', '高品质，价格低', '每一积分兑换一积分', '酒红色红糖食品', '', 1);
INSERT INTO `good` VALUES (90, 60000, 25, '/Uploads/good/2018-02-27/5a94cd6f64f16.jpg', '2018-02-13 17:55:09', '2018-02-23 17:55:14', '1', '高品质，价格低', '每一积分兑换一积分', '阳澄湖大闸蟹', '', 1);
INSERT INTO `good` VALUES (92, 60000, 25, '/Uploads/good/2018-02-27/5a94cd172858a.jpg', '2018-02-27 18:16:11', '2018-02-28 18:16:14', '1', '高品质，价格低', '每一积分兑换一积分', '山药', '', 1);

-- ----------------------------
-- Table structure for good_img
-- ----------------------------
DROP TABLE IF EXISTS `good_img`;
CREATE TABLE `good_img`  (
  `good_img_id` int(11) NOT NULL AUTO_INCREMENT,
  `good_id` int(11) DEFAULT NULL,
  `good_img_url` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`good_img_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 157 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of good_img
-- ----------------------------
INSERT INTO `good_img` VALUES (153, 45, '5a0d3e5b19db7.jpg');
INSERT INTO `good_img` VALUES (154, 46, '5a0d3e5b19db7.jpg');
INSERT INTO `good_img` VALUES (144, 47, 'sel_subscribe@3x.png');
INSERT INTO `good_img` VALUES (145, 48, 'sel_kaibo@3x.png');
INSERT INTO `good_img` VALUES (146, 49, '912706554757659664.png');
INSERT INTO `good_img` VALUES (147, 50, 'fenlei.png');
INSERT INTO `good_img` VALUES (148, 64, 'tuijian.png');
INSERT INTO `good_img` VALUES (149, 63, 'course-top.png');
INSERT INTO `good_img` VALUES (150, 62, 'fenlei-s.png');
INSERT INTO `good_img` VALUES (151, 61, '5a0d3e5b19db7.jpg');
INSERT INTO `good_img` VALUES (155, 77, '5a0d3e5b19db7.jpg');
INSERT INTO `good_img` VALUES (156, 78, '5a0d3e5b19db7.jpg');

-- ----------------------------
-- Table structure for history
-- ----------------------------
DROP TABLE IF EXISTS `history`;
CREATE TABLE `history`  (
  `history_id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '用户id',
  `type` char(1) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '类型    0：直播   1：视频',
  `cid` int(11) NOT NULL COMMENT '视频或直播的id',
  `time` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '时间',
  PRIMARY KEY (`history_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 188 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of history
-- ----------------------------
INSERT INTO `history` VALUES (153, 37, '1', 125, '1522141089');
INSERT INTO `history` VALUES (154, 37, '1', 102, '1522141115');
INSERT INTO `history` VALUES (155, 37, '0', 378, '1522158192');
INSERT INTO `history` VALUES (102, 101, '1', 98, '1521599796');
INSERT INTO `history` VALUES (101, 115, '1', 102, '1521599559');
INSERT INTO `history` VALUES (100, 115, '1', 106, '1521598763');
INSERT INTO `history` VALUES (157, 117, '1', 130, '1522216513');
INSERT INTO `history` VALUES (98, 115, '1', 108, '1521531444');
INSERT INTO `history` VALUES (97, 99, '1', 108, '1521531067');
INSERT INTO `history` VALUES (96, 100, '1', 108, '1521531011');
INSERT INTO `history` VALUES (179, 115, '1', 109, '1522654933');
INSERT INTO `history` VALUES (93, 99, '1', 107, '1521527100');
INSERT INTO `history` VALUES (92, 101, '1', 102, '1521512570');
INSERT INTO `history` VALUES (91, 101, '0', 345, '1521512201');
INSERT INTO `history` VALUES (90, 30, '1', 85, '1521451292');
INSERT INTO `history` VALUES (89, 111, '1', 106, '1521193030');
INSERT INTO `history` VALUES (88, 53, '1', 106, '1521192979');
INSERT INTO `history` VALUES (87, 70, '1', 106, '1521192763');
INSERT INTO `history` VALUES (86, 30, '1', 106, '1521192622');
INSERT INTO `history` VALUES (79, 111, '1', 97, '1521167810');
INSERT INTO `history` VALUES (80, 49, '1', 99, '1521169855');
INSERT INTO `history` VALUES (81, 30, '1', 98, '1521181810');
INSERT INTO `history` VALUES (82, 111, '1', 97, '1521185296');
INSERT INTO `history` VALUES (83, 70, '1', 97, '1521186090');
INSERT INTO `history` VALUES (84, 30, '1', 105, '1521187518');
INSERT INTO `history` VALUES (85, 99, '1', 106, '1521192584');
INSERT INTO `history` VALUES (78, 99, '1', 97, '1521166596');
INSERT INTO `history` VALUES (77, 30, '1', 82, '1521163022');
INSERT INTO `history` VALUES (76, 30, '1', 81, '1521162823');
INSERT INTO `history` VALUES (106, 117, '1', 109, '1521616506');
INSERT INTO `history` VALUES (107, 117, '0', 356, '1521618621');
INSERT INTO `history` VALUES (149, 118, '1', 106, '1522138648');
INSERT INTO `history` VALUES (109, 117, '1', 111, '1521686632');
INSERT INTO `history` VALUES (110, 53, '1', 111, '1521686850');
INSERT INTO `history` VALUES (111, 53, '1', 112, '1521690763');
INSERT INTO `history` VALUES (150, 118, '1', 98, '1522138664');
INSERT INTO `history` VALUES (151, 118, '1', 108, '1522139002');
INSERT INTO `history` VALUES (115, 53, '1', 109, '1521705743');
INSERT INTO `history` VALUES (116, 70, '0', 366, '1521766445');
INSERT INTO `history` VALUES (117, 109, '1', 108, '1521776187');
INSERT INTO `history` VALUES (118, 120, '1', 106, '1521776631');
INSERT INTO `history` VALUES (119, 120, '1', 98, '1521776850');
INSERT INTO `history` VALUES (152, 37, '1', 109, '1522141086');
INSERT INTO `history` VALUES (121, 99, '0', 370, '1521791694');
INSERT INTO `history` VALUES (122, 117, '1', 97, '1521796516');
INSERT INTO `history` VALUES (123, 99, '1', 116, '1521797776');
INSERT INTO `history` VALUES (124, 37, '1', 106, '1522028466');
INSERT INTO `history` VALUES (125, 37, '1', 111, '1522028474');
INSERT INTO `history` VALUES (126, 37, '1', 108, '1522029813');
INSERT INTO `history` VALUES (127, 37, '1', 98, '1522029828');
INSERT INTO `history` VALUES (128, 37, '1', 97, '1522029836');
INSERT INTO `history` VALUES (129, 117, '1', 126, '1522045031');
INSERT INTO `history` VALUES (130, 117, '1', 112, '1522045050');
INSERT INTO `history` VALUES (131, 122, '1', 98, '1522048953');
INSERT INTO `history` VALUES (158, 115, '0', 381, '1522223548');
INSERT INTO `history` VALUES (156, 99, '1', 122, '1522209551');
INSERT INTO `history` VALUES (134, 115, '0', 371, '1522054619');
INSERT INTO `history` VALUES (135, 99, '0', 208, '1522055051');
INSERT INTO `history` VALUES (145, 117, '0', 374, '1522114419');
INSERT INTO `history` VALUES (146, 117, '0', 375, '1522114892');
INSERT INTO `history` VALUES (147, 99, '1', 102, '1522118503');
INSERT INTO `history` VALUES (180, 99, '1', 131, '1522660555');
INSERT INTO `history` VALUES (159, 115, '0', 384, '1522224767');
INSERT INTO `history` VALUES (160, 37, '0', 383, '1522225879');
INSERT INTO `history` VALUES (161, 99, '1', 127, '1522300654');
INSERT INTO `history` VALUES (162, 99, '1', 140, '1522313231');
INSERT INTO `history` VALUES (163, 117, '1', 140, '1522313233');
INSERT INTO `history` VALUES (164, 30, '1', 124, '1522313907');
INSERT INTO `history` VALUES (165, 115, '1', 131, '1522376961');
INSERT INTO `history` VALUES (181, 30, '1', 118, '1522725082');
INSERT INTO `history` VALUES (167, 115, '0', 388, '1522382065');
INSERT INTO `history` VALUES (168, 99, '1', 90, '1522382158');
INSERT INTO `history` VALUES (169, 129, '1', 98, '1522391798');
INSERT INTO `history` VALUES (170, 99, '1', 113, '1522392008');
INSERT INTO `history` VALUES (182, 30, '1', 119, '1522725102');
INSERT INTO `history` VALUES (172, 130, '1', 98, '1522630131');
INSERT INTO `history` VALUES (173, 99, '1', 141, '1522634291');
INSERT INTO `history` VALUES (174, 99, '1', 142, '1522635231');
INSERT INTO `history` VALUES (175, 99, '1', 144, '1522637941');
INSERT INTO `history` VALUES (176, 99, '1', 128, '1522638350');
INSERT INTO `history` VALUES (177, 99, '1', 143, '1522640242');
INSERT INTO `history` VALUES (183, 30, '1', 102, '1522733731');
INSERT INTO `history` VALUES (184, 30, '1', 126, '1522734330');
INSERT INTO `history` VALUES (185, 83, '1', 98, '1522734639');
INSERT INTO `history` VALUES (186, 131, '1', 113, '1522736113');
INSERT INTO `history` VALUES (187, 115, '1', 96, '1522738825');

-- ----------------------------
-- Table structure for ierecord
-- ----------------------------
DROP TABLE IF EXISTS `ierecord`;
CREATE TABLE `ierecord`  (
  `idrecord_id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '用户id',
  `gid` int(11) NOT NULL COMMENT '商品id',
  `time` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '兑换时间',
  `num` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '订单号',
  `money` int(10) NOT NULL COMMENT '金额',
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '地址',
  `status` int(11) NOT NULL DEFAULT 1 COMMENT ' 1：待发货 2：待收货 3：已完成',
  `order_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '快递单号',
  `kuaidi` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '快递名称',
  PRIMARY KEY (`idrecord_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 87 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ierecord
-- ----------------------------
INSERT INTO `ierecord` VALUES (1, 30, 101, '1512449050', '1222233222', 556666, '11111111', 3, '25252', '圆通');
INSERT INTO `ierecord` VALUES (2, 6, 46, '1512449800', '2222222222', 222, '11111111', 3, '2525255', '邮政');
INSERT INTO `ierecord` VALUES (14, 6, 12, '1518400031', 'qdw1IDSU9b', 12, '辽宁沈阳', 1, NULL, NULL);
INSERT INTO `ierecord` VALUES (15, 48, 12, '1518400039', 'oOfzkSnWAS', 12, '辽宁沈阳', 1, NULL, NULL);
INSERT INTO `ierecord` VALUES (16, 48, 12, '1518401054', 'fAI45YSe3E', 12, '辽宁沈阳', 1, NULL, NULL);
INSERT INTO `ierecord` VALUES (27, 30, 102, '1518433796', 'k5IFwZ2bz9', 556666, '辽宁营口', 3, '54545454', 'haha ');
INSERT INTO `ierecord` VALUES (26, 6, 12, '1518432094', 'H8zPb3k36w', 12, '辽宁沈阳', 1, NULL, NULL);
INSERT INTO `ierecord` VALUES (20, 48, 46, '1518402334', 'wOg8tCYy0B', 222, '机场返回给是你', 2, NULL, NULL);
INSERT INTO `ierecord` VALUES (21, 30, 103, '1518429446', 'B4MoZfxPRf', 556666, '辽宁营口', 3, '42444', '天天');
INSERT INTO `ierecord` VALUES (25, 48, 45, '1518431897', 'wAobnYJgy2', 11, '辽宁沈阳', 1, NULL, NULL);
INSERT INTO `ierecord` VALUES (54, 53, 98, '1520818110', '4XQ8jEMJ2q', 2, '辽宁沈阳', 1, NULL, NULL);
INSERT INTO `ierecord` VALUES (37, 30, 98, '1519813427', 'X7w9L2j5yt', 2, '辽宁沈阳', 3, NULL, NULL);
INSERT INTO `ierecord` VALUES (36, 65, 98, '1519714365', 'lyiKWle3kv', 2, '辽宁沈阳', 3, '564465465465465465465465', '天天');
INSERT INTO `ierecord` VALUES (35, 30, 98, '1519704080', 'irtKhRXXNy', 2, '辽宁营口', 3, '544545545455445', '天天');
INSERT INTO `ierecord` VALUES (40, 70, 112, '1520401842', 'hRLsXiuaJh', 532543, '上课上课上课上课仔细看走走看看说l', 2, '55555555', '天天');
INSERT INTO `ierecord` VALUES (53, 53, 98, '1520818048', 'YNy8S97qQh', 2, '辽宁沈阳', 1, NULL, NULL);
INSERT INTO `ierecord` VALUES (52, 53, 98, '1520574561', 'yxxa1Hyivk', 2, '辽宁沈阳', 2, NULL, NULL);
INSERT INTO `ierecord` VALUES (50, 53, 98, '1520573567', 'lSuKQ0AjGn', 2, '辽宁沈阳', 3, NULL, NULL);
INSERT INTO `ierecord` VALUES (51, 53, 98, '1520573572', 'EAbkPBTMm4', 2, '辽宁沈阳', 3, NULL, NULL);
INSERT INTO `ierecord` VALUES (55, 53, 98, '1520818125', 'SPihMELyrs', 2, '辽宁沈阳', 3, NULL, NULL);
INSERT INTO `ierecord` VALUES (56, 53, 98, '1520818126', 'uX12JQNftH', 2, '辽宁沈阳', 3, NULL, NULL);
INSERT INTO `ierecord` VALUES (57, 6, 12, '1520818377', 'I1gvZqZ8aj', 12, '辽宁沈阳', 1, NULL, NULL);
INSERT INTO `ierecord` VALUES (58, 53, 104, '1520818405', 'Ayj7PaVnxA', 12, '辽宁沈阳', 1, NULL, NULL);
INSERT INTO `ierecord` VALUES (59, 53, 98, '1520821771', '806sjgB9qn', 2, '辽宁沈阳', 1, NULL, NULL);
INSERT INTO `ierecord` VALUES (60, 53, 98, '1520821885', 'qApD53q1vB', 2, '辽宁沈阳', 1, NULL, NULL);
INSERT INTO `ierecord` VALUES (61, 70, 112, '1520827109', 'RM7CxmGbmm', 532543, '上课上课上课上课仔细看走走看看说l', 2, '65465465465465', '天天');
INSERT INTO `ierecord` VALUES (62, 70, 112, '1520827133', 'UuOEQuwEJw', 532543, '上课上课上课上课仔细看走走看看说l', 3, '55545454', '天天');
INSERT INTO `ierecord` VALUES (63, 53, 104, '1520827527', 'EpOn6nlkpH', 7787, '13纬路', 1, NULL, NULL);
INSERT INTO `ierecord` VALUES (64, 53, 112, '1520829026', 'LAZU39po9x', 532543, '13纬路', 1, NULL, NULL);
INSERT INTO `ierecord` VALUES (65, 99, 94, '1520926263', 'jJYwbVC8VS', 55555, '给哥哥哥哥菜市场草草收场哈哈嘎嘎嘎嘎嘎嘎嘎嘎', 1, NULL, NULL);
INSERT INTO `ierecord` VALUES (66, 99, 104, '1520927115', 'fYUcmyh1Yc', 7787, '给哥哥哥哥菜市场草草收场哈哈嘎嘎嘎嘎嘎嘎嘎嘎', 3, '', '');
INSERT INTO `ierecord` VALUES (67, 99, 98, '1520928353', 'co02Es2kkM', 2, '给哥哥哥哥菜市场草草收场哈哈嘎嘎嘎嘎嘎嘎嘎嘎', 1, NULL, NULL);
INSERT INTO `ierecord` VALUES (68, 53, 98, '1520990243', 'FWop8AXlPI', 2, '辽宁沈阳', 1, NULL, NULL);
INSERT INTO `ierecord` VALUES (69, 53, 98, '1520990404', 'z6O0GOCk6B', 2, '辽宁沈阳', 1, NULL, NULL);
INSERT INTO `ierecord` VALUES (70, 111, 104, '1521014932', 'XQLWV5CDmJ', 7787, '     辽宁省沈阳市铁西区中共接', 1, NULL, NULL);
INSERT INTO `ierecord` VALUES (71, 101, 99, '1521015109', 'YrqM8yAuM5', 5, '沈阳市', 1, NULL, NULL);
INSERT INTO `ierecord` VALUES (72, 111, 103, '1521015184', 'co1lww84xt', 556666, '     辽宁省沈阳市铁西区中共接', 1, NULL, NULL);
INSERT INTO `ierecord` VALUES (73, 53, 101, '1521095433', 'j3FQqWFvHO', 556666, '13纬路', 1, NULL, NULL);
INSERT INTO `ierecord` VALUES (74, 53, 101, '1521095834', 'lvwkbtHsIt', 556666, '13纬路', 1, NULL, NULL);
INSERT INTO `ierecord` VALUES (75, 53, 101, '1521095959', 'VUS7QKshfw', 556666, '13纬路', 1, NULL, NULL);
INSERT INTO `ierecord` VALUES (76, 53, 101, '1521096482', 'JFSy1E6s5X', 556666, '13纬路', 1, NULL, NULL);
INSERT INTO `ierecord` VALUES (77, 99, 104, '1521177372', 'bzY0SNt2Zb', 7787, '给哥哥哥哥菜市场草草收场哈哈嘎嘎嘎嘎嘎嘎嘎嘎', 1, NULL, NULL);
INSERT INTO `ierecord` VALUES (78, 99, 98, '1521598915', 'l7S41kWlL3', 2, '铁西区重工街', 3, '222553322112', '防守打法');
INSERT INTO `ierecord` VALUES (79, 99, 98, '1521615698', '7IwGC3HGbT', 2, '隐隐约约', 1, NULL, NULL);
INSERT INTO `ierecord` VALUES (80, 30, 98, '1521616601', 'Zp0mk0yY2h', 2, 'liaoning ', 1, NULL, NULL);
INSERT INTO `ierecord` VALUES (81, 115, 98, '1521704411', 'ZnqMZcfngE', 2, '辽宁省身哦是啦42', 1, NULL, NULL);
INSERT INTO `ierecord` VALUES (82, 115, 97, '1522135676', '1ecnW0im5G', 2, '皇姑区辽宁大厦生鲜部', 3, '让人同仁堂', '天热特特');
INSERT INTO `ierecord` VALUES (83, 37, 97, '1522141459', 'CMkNW4SGvh', 2, '咯可口可乐了看看', 3, '66666', 'lk');
INSERT INTO `ierecord` VALUES (84, 117, 97, '1522220406', 'za6G0VM6AL', 2, '防守打法', 1, NULL, NULL);
INSERT INTO `ierecord` VALUES (85, 99, 98, '1522650626', 'e0JxKcoryg', 2, '辽宁沈阳', 1, NULL, NULL);
INSERT INTO `ierecord` VALUES (86, 99, 97, '1522650705', 'XJiyDewJCn', 2, '辽宁沈阳', 1, NULL, NULL);

-- ----------------------------
-- Table structure for integral
-- ----------------------------
DROP TABLE IF EXISTS `integral`;
CREATE TABLE `integral`  (
  `integral_id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '用户id',
  `type` char(1) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '类型   1：收入   2：支出',
  `source` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '来源',
  `num` int(11) NOT NULL COMMENT '数额',
  `time` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '时间',
  PRIMARY KEY (`integral_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 273 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of integral
-- ----------------------------
INSERT INTO `integral` VALUES (1, 6, '1', '签到', 10, '1515979447');
INSERT INTO `integral` VALUES (2, 6, '1', '开课', 50, '1515979447');
INSERT INTO `integral` VALUES (3, 6, '2', '购买流量卡', 10, '1515979447');
INSERT INTO `integral` VALUES (4, 6, '1', '签到', 5, '1516090163');
INSERT INTO `integral` VALUES (5, 6, '1', '签到', 5, '1516090322');
INSERT INTO `integral` VALUES (6, 6, '1', '签到', 10, '1516175992');
INSERT INTO `integral` VALUES (7, 6, '1', '签到', 10, '1516241996');
INSERT INTO `integral` VALUES (8, 6, '1', '签到', 10, '1516324181');
INSERT INTO `integral` VALUES (9, 6, '1', '签到', 5, '1516610161');
INSERT INTO `integral` VALUES (10, 30, '1', '签到', 5, '1516670660');
INSERT INTO `integral` VALUES (11, 30, '1', '签到', 10, '1516756301');
INSERT INTO `integral` VALUES (13, 6, '1', '签到', 5, '1516772093');
INSERT INTO `integral` VALUES (14, 40, '1', '签到', 5, '1516777529');
INSERT INTO `integral` VALUES (15, 43, '1', '签到', 5, '1516780098');
INSERT INTO `integral` VALUES (16, 44, '1', '签到', 5, '1516781496');
INSERT INTO `integral` VALUES (17, 43, '1', '签到', 10, '1516842218');
INSERT INTO `integral` VALUES (18, 6, '1', '签到', 10, '1516844487');
INSERT INTO `integral` VALUES (19, 40, '1', '签到', 10, '1516852568');
INSERT INTO `integral` VALUES (20, 30, '1', '签到', 10, '1516870205');
INSERT INTO `integral` VALUES (21, 37, '1', '签到', 5, '1516872685');
INSERT INTO `integral` VALUES (22, 40, '1', '签到', 10, '1516927709');
INSERT INTO `integral` VALUES (23, 37, '1', '签到', 10, '1516931025');
INSERT INTO `integral` VALUES (24, 30, '1', '签到', 10, '1516949731');
INSERT INTO `integral` VALUES (25, 30, '1', '签到', 5, '1517203945');
INSERT INTO `integral` VALUES (26, 30, '1', '签到', 10, '1517273281');
INSERT INTO `integral` VALUES (27, 30, '1', '签到', 10, '1517384661');
INSERT INTO `integral` VALUES (28, 30, '1', '签到', 10, '1517463812');
INSERT INTO `integral` VALUES (29, 30, '1', '签到', 10, '1517552313');
INSERT INTO `integral` VALUES (30, 30, '1', '签到', 10, '1517621449');
INSERT INTO `integral` VALUES (31, 30, '1', '签到', 5, '1517810349');
INSERT INTO `integral` VALUES (32, 6, '1', '签到', 5, '1517818629');
INSERT INTO `integral` VALUES (33, 30, '1', '签到', 10, '1517881668');
INSERT INTO `integral` VALUES (34, 48, '1', '签到', 5, '1517882431');
INSERT INTO `integral` VALUES (35, 6, '1', '签到', 10, '1517888109');
INSERT INTO `integral` VALUES (36, 49, '1', '签到', 5, '1517987133');
INSERT INTO `integral` VALUES (37, 6, '1', '签到', 10, '1518001792');
INSERT INTO `integral` VALUES (38, 48, '1', '签到', 10, '1518004574');
INSERT INTO `integral` VALUES (39, 48, '1', '签到', 10, '1518056106');
INSERT INTO `integral` VALUES (40, 30, '1', '签到', 5, '1518057744');
INSERT INTO `integral` VALUES (41, 6, '1', '签到', 10, '1518060566');
INSERT INTO `integral` VALUES (42, 48, '1', '签到', 10, '1518136233');
INSERT INTO `integral` VALUES (43, 6, '1', '签到', 10, '1518141525');
INSERT INTO `integral` VALUES (44, 40, '1', '签到', 5, '1518319888');
INSERT INTO `integral` VALUES (45, 30, '1', '签到', 5, '1518412606');
INSERT INTO `integral` VALUES (46, 48, '1', '签到', 5, '1518425682');
INSERT INTO `integral` VALUES (47, 30, '1', '签到', 10, '1518485039');
INSERT INTO `integral` VALUES (48, 30, '2', '兑换商品', 11, '1518487405');
INSERT INTO `integral` VALUES (49, 48, '1', '签到', 10, '1518509315');
INSERT INTO `integral` VALUES (50, 30, '1', '签到', 5, '1519624769');
INSERT INTO `integral` VALUES (51, 30, '2', '兑换商品', 11, '1519630335');
INSERT INTO `integral` VALUES (52, 30, '1', '签到', 10, '1519693136');
INSERT INTO `integral` VALUES (53, 30, '2', '兑换商品', 2, '1519703465');
INSERT INTO `integral` VALUES (54, 30, '2', '兑换商品', 2, '1519703492');
INSERT INTO `integral` VALUES (55, 30, '2', '兑换商品', 2, '1519703591');
INSERT INTO `integral` VALUES (56, 30, '2', '兑换商品', 2, '1519703740');
INSERT INTO `integral` VALUES (57, 30, '2', '兑换商品', 2, '1519704012');
INSERT INTO `integral` VALUES (58, 30, '2', '兑换商品', 2, '1519704080');
INSERT INTO `integral` VALUES (59, 69, '1', '签到', 5, '1519709595');
INSERT INTO `integral` VALUES (60, 70, '1', '签到', 5, '1519709799');
INSERT INTO `integral` VALUES (61, 65, '1', '签到', 5, '1519710696');
INSERT INTO `integral` VALUES (62, 65, '2', '兑换商品', 2, '1519714365');
INSERT INTO `integral` VALUES (63, 61, '1', '签到', 5, '1519714566');
INSERT INTO `integral` VALUES (64, 58, '1', '签到', 5, '1519722624');
INSERT INTO `integral` VALUES (65, 30, '2', '兑换约课币', 1000, '1519723784');
INSERT INTO `integral` VALUES (66, 73, '1', '签到', 5, '1519778607');
INSERT INTO `integral` VALUES (67, 74, '1', '签到', 5, '1519780464');
INSERT INTO `integral` VALUES (68, 70, '1', '签到', 10, '1519782117');
INSERT INTO `integral` VALUES (69, 58, '1', '签到', 10, '1519789336');
INSERT INTO `integral` VALUES (70, 65, '1', '签到', 10, '1519789815');
INSERT INTO `integral` VALUES (71, 30, '1', '签到', 10, '1519797755');
INSERT INTO `integral` VALUES (72, 53, '1', '签到', 5, '1519797895');
INSERT INTO `integral` VALUES (73, 30, '2', '兑换商品', 2, '1519813427');
INSERT INTO `integral` VALUES (74, 72, '1', '签到', 5, '1519815368');
INSERT INTO `integral` VALUES (75, 6, '1', '签到', 5, '1519870113');
INSERT INTO `integral` VALUES (76, 30, '1', '签到', 10, '1519872578');
INSERT INTO `integral` VALUES (77, 30, '1', '签到', 10, '1519974586');
INSERT INTO `integral` VALUES (78, 6, '1', '签到', 10, '1519974910');
INSERT INTO `integral` VALUES (79, 6, '1', '签到', 5, '1520210680');
INSERT INTO `integral` VALUES (80, 81, '1', '签到', 5, '1520213129');
INSERT INTO `integral` VALUES (81, 30, '1', '签到', 5, '1520214675');
INSERT INTO `integral` VALUES (82, 83, '1', '签到', 5, '1520222443');
INSERT INTO `integral` VALUES (83, 82, '1', '签到', 5, '1520222529');
INSERT INTO `integral` VALUES (84, 84, '1', '签到', 5, '1520232404');
INSERT INTO `integral` VALUES (85, 30, '1', '签到', 10, '1520305773');
INSERT INTO `integral` VALUES (86, 74, '1', '签到', 5, '1520315599');
INSERT INTO `integral` VALUES (87, 6, '1', '签到', 10, '1520321107');
INSERT INTO `integral` VALUES (88, 82, '1', '签到', 10, '1520322577');
INSERT INTO `integral` VALUES (89, 30, '1', '签到', 10, '1520388112');
INSERT INTO `integral` VALUES (90, 96, '1', '签到', 5, '1520472266');
INSERT INTO `integral` VALUES (91, 30, '1', '签到', 10, '1520474388');
INSERT INTO `integral` VALUES (92, 6, '1', '签到', 5, '1520480925');
INSERT INTO `integral` VALUES (93, 30, '2', '兑换约课币', 1000, '1520499716');
INSERT INTO `integral` VALUES (94, 70, '2', '兑换约课币', 9467, '1520503747');
INSERT INTO `integral` VALUES (95, 70, '2', '兑换约课币', 1000, '1520503988');
INSERT INTO `integral` VALUES (96, 70, '2', '兑换约课币', 1000, '1520504303');
INSERT INTO `integral` VALUES (97, 30, '2', '兑换约课币', 1000, '1520504427');
INSERT INTO `integral` VALUES (98, 30, '2', '兑换约课币', 1000, '1520558427');
INSERT INTO `integral` VALUES (99, 83, '1', '签到', 5, '1520558657');
INSERT INTO `integral` VALUES (100, 30, '2', '兑换约课币', 1000, '1520558783');
INSERT INTO `integral` VALUES (101, 53, '2', '兑换约课币', 1000, '1520559073');
INSERT INTO `integral` VALUES (102, 53, '2', '兑换约课币', 1000, '1520559090');
INSERT INTO `integral` VALUES (103, 30, '2', '兑换约课币', 1000, '1520559149');
INSERT INTO `integral` VALUES (104, 30, '2', '兑换约课币', 1000, '1520559158');
INSERT INTO `integral` VALUES (105, 30, '2', '兑换约课币', 1000, '1520559317');
INSERT INTO `integral` VALUES (106, 53, '2', '兑换约课币', 1000, '1520559513');
INSERT INTO `integral` VALUES (107, 53, '2', '兑换约课币', 1000, '1520562922');
INSERT INTO `integral` VALUES (108, 53, '2', '兑换约课币', 1000, '1520563086');
INSERT INTO `integral` VALUES (109, 53, '2', '兑换约课币', 5000, '1520563118');
INSERT INTO `integral` VALUES (110, 30, '1', '签到', 10, '1520576778');
INSERT INTO `integral` VALUES (111, 99, '1', '签到', 5, '1520579254');
INSERT INTO `integral` VALUES (112, 70, '1', '签到', 5, '1520579696');
INSERT INTO `integral` VALUES (113, 6, '1', '签到', 10, '1520582459');
INSERT INTO `integral` VALUES (114, 57, '1', '签到', 5, '1520584644');
INSERT INTO `integral` VALUES (115, 99, '1', '签到', 10, '1520685827');
INSERT INTO `integral` VALUES (116, 97, '1', '签到', 5, '1520686838');
INSERT INTO `integral` VALUES (117, 70, '1', '签到', 5, '1520698828');
INSERT INTO `integral` VALUES (118, 6, '1', '签到', 5, '1520821273');
INSERT INTO `integral` VALUES (119, 30, '1', '签到', 5, '1520821347');
INSERT INTO `integral` VALUES (120, 99, '1', '签到', 5, '1520822471');
INSERT INTO `integral` VALUES (121, 53, '1', '签到', 5, '1520826602');
INSERT INTO `integral` VALUES (122, 53, '2', '兑换约课币', 39000, '1520831297');
INSERT INTO `integral` VALUES (123, 53, '2', '兑换约课币', 5000, '1520831317');
INSERT INTO `integral` VALUES (124, 53, '2', '兑换约课币', 10000, '1520831348');
INSERT INTO `integral` VALUES (125, 101, '1', '签到', 5, '1520833727');
INSERT INTO `integral` VALUES (126, 6, '1', '签到', 10, '1520901404');
INSERT INTO `integral` VALUES (127, 101, '1', '签到', 10, '1520916088');
INSERT INTO `integral` VALUES (128, 99, '1', '签到', 10, '1520917054');
INSERT INTO `integral` VALUES (129, 70, '1', '签到', 5, '1520918568');
INSERT INTO `integral` VALUES (130, 95, '1', '签到', 5, '1520920539');
INSERT INTO `integral` VALUES (131, 30, '1', '签到', 10, '1520924107');
INSERT INTO `integral` VALUES (132, 110, '1', '签到', 5, '1520932880');
INSERT INTO `integral` VALUES (133, 53, '2', '兑换商品', 2, '1520990243');
INSERT INTO `integral` VALUES (134, 53, '2', '兑换商品', 2, '1520990404');
INSERT INTO `integral` VALUES (135, 111, '1', '签到', 5, '1520990944');
INSERT INTO `integral` VALUES (136, 30, '1', '签到', 10, '1520996720');
INSERT INTO `integral` VALUES (137, 99, '1', '签到', 10, '1521008825');
INSERT INTO `integral` VALUES (138, 101, '1', '签到', 10, '1521012121');
INSERT INTO `integral` VALUES (139, 111, '2', '兑换商品', 7787, '1521014932');
INSERT INTO `integral` VALUES (140, 101, '2', '兑换商品', 5, '1521015109');
INSERT INTO `integral` VALUES (141, 111, '2', '兑换商品', 556666, '1521015184');
INSERT INTO `integral` VALUES (142, 99, '2', '兑换约课币', 1000, '1521015448');
INSERT INTO `integral` VALUES (143, 99, '2', '兑换约课币', 200000, '1521015763');
INSERT INTO `integral` VALUES (144, 99, '2', '兑换约课币', 1000, '1521016236');
INSERT INTO `integral` VALUES (145, 99, '2', '兑换约课币', 1000, '1521016415');
INSERT INTO `integral` VALUES (146, 6, '1', '签到', 10, '1521016617');
INSERT INTO `integral` VALUES (147, 37, '1', '签到', 5, '1521020646');
INSERT INTO `integral` VALUES (148, 30, '1', '签到', 10, '1521074735');
INSERT INTO `integral` VALUES (149, 111, '1', '签到', 10, '1521083830');
INSERT INTO `integral` VALUES (150, 100, '1', '签到', 5, '1521085084');
INSERT INTO `integral` VALUES (151, 53, '2', '兑换商品', 556666, '1521095433');
INSERT INTO `integral` VALUES (152, 53, '2', '兑换商品', 556666, '1521095834');
INSERT INTO `integral` VALUES (153, 53, '2', '兑换商品', 556666, '1521095959');
INSERT INTO `integral` VALUES (154, 53, '2', '兑换商品', 556666, '1521096482');
INSERT INTO `integral` VALUES (155, 53, '2', '兑换约课币', 12000, '1521096530');
INSERT INTO `integral` VALUES (156, 111, '2', '兑换约课币', 10000, '1521096713');
INSERT INTO `integral` VALUES (157, 111, '2', '兑换约课币', 1000, '1521096796');
INSERT INTO `integral` VALUES (158, 53, '2', '兑换约课币', 1005000, '1521097378');
INSERT INTO `integral` VALUES (159, 83, '1', '签到', 5, '1521097983');
INSERT INTO `integral` VALUES (160, 53, '1', '签到', 5, '1521101986');
INSERT INTO `integral` VALUES (161, 6, '1', '签到', 10, '1521102150');
INSERT INTO `integral` VALUES (162, 99, '1', '签到', 10, '1521107838');
INSERT INTO `integral` VALUES (163, 111, '1', '签到', 10, '1521167472');
INSERT INTO `integral` VALUES (164, 30, '1', '签到', 10, '1521169286');
INSERT INTO `integral` VALUES (165, 53, '1', '签到', 10, '1521176832');
INSERT INTO `integral` VALUES (166, 99, '2', '兑换约课币', 3000, '1521177335');
INSERT INTO `integral` VALUES (167, 99, '2', '兑换商品', 7787, '1521177372');
INSERT INTO `integral` VALUES (168, 99, '1', '签到', 10, '1521185255');
INSERT INTO `integral` VALUES (169, 99, '2', '兑换约课币', 1000, '1521421075');
INSERT INTO `integral` VALUES (170, 30, '1', '签到', 5, '1521421153');
INSERT INTO `integral` VALUES (171, 99, '1', '签到', 5, '1521421337');
INSERT INTO `integral` VALUES (172, 99, '2', '兑换约课币', 2000, '1521421605');
INSERT INTO `integral` VALUES (173, 99, '2', '兑换约课币', 719000, '1521422109');
INSERT INTO `integral` VALUES (174, 37, '1', '签到', 5, '1521429041');
INSERT INTO `integral` VALUES (175, 111, '1', '签到', 5, '1521429618');
INSERT INTO `integral` VALUES (176, 6, '1', '签到', 5, '1521439439');
INSERT INTO `integral` VALUES (177, 115, '1', '签到', 5, '1521511919');
INSERT INTO `integral` VALUES (178, 30, '1', '签到', 10, '1521512439');
INSERT INTO `integral` VALUES (179, 99, '1', '签到', 10, '1521512535');
INSERT INTO `integral` VALUES (180, 6, '1', '签到', 10, '1521517989');
INSERT INTO `integral` VALUES (181, 100, '1', '签到', 5, '1521532444');
INSERT INTO `integral` VALUES (182, 99, '1', '签到', 10, '1521593476');
INSERT INTO `integral` VALUES (183, 117, '1', '签到', 5, '1521595519');
INSERT INTO `integral` VALUES (184, 30, '1', '签到', 10, '1521595885');
INSERT INTO `integral` VALUES (185, 99, '2', '兑换商品', 2, '1521598915');
INSERT INTO `integral` VALUES (186, 115, '1', '签到', 10, '1521614775');
INSERT INTO `integral` VALUES (187, 99, '2', '兑换商品', 2, '1521615698');
INSERT INTO `integral` VALUES (188, 30, '2', '兑换商品', 2, '1521616601');
INSERT INTO `integral` VALUES (189, 99, '1', '签到', 10, '1521681315');
INSERT INTO `integral` VALUES (190, 30, '1', '签到', 10, '1521682992');
INSERT INTO `integral` VALUES (191, 117, '1', '签到', 10, '1521683052');
INSERT INTO `integral` VALUES (192, 115, '1', '签到', 10, '1521683514');
INSERT INTO `integral` VALUES (193, 53, '1', '签到', 5, '1521689237');
INSERT INTO `integral` VALUES (194, 118, '1', '签到', 5, '1521691301');
INSERT INTO `integral` VALUES (195, 99, '2', '兑换约课币', 455000, '1521698760');
INSERT INTO `integral` VALUES (196, 115, '2', '兑换商品', 2, '1521704411');
INSERT INTO `integral` VALUES (197, 83, '1', '签到', 5, '1521766154');
INSERT INTO `integral` VALUES (198, 99, '1', '签到', 10, '1521769022');
INSERT INTO `integral` VALUES (199, 115, '1', '签到', 10, '1521769344');
INSERT INTO `integral` VALUES (200, 101, '1', '签到', 5, '1521769414');
INSERT INTO `integral` VALUES (201, 117, '1', '签到', 10, '1521769487');
INSERT INTO `integral` VALUES (202, 6, '1', '签到', 5, '1521773055');
INSERT INTO `integral` VALUES (203, 37, '1', '签到', 5, '1521775484');
INSERT INTO `integral` VALUES (204, 70, '1', '签到', 5, '1521783273');
INSERT INTO `integral` VALUES (205, 120, '1', '签到', 5, '1521783510');
INSERT INTO `integral` VALUES (206, 30, '1', '签到', 10, '1521783601');
INSERT INTO `integral` VALUES (207, 6, '1', '签到', 5, '1521783660');
INSERT INTO `integral` VALUES (208, 53, '1', '签到', 10, '1521784201');
INSERT INTO `integral` VALUES (209, 111, '1', '签到', 5, '1521795001');
INSERT INTO `integral` VALUES (210, 99, '1', '签到', 5, '1522025319');
INSERT INTO `integral` VALUES (211, 117, '1', '签到', 5, '1522025498');
INSERT INTO `integral` VALUES (212, 30, '1', '签到', 5, '1522025688');
INSERT INTO `integral` VALUES (213, 115, '1', '签到', 5, '1522025710');
INSERT INTO `integral` VALUES (214, 53, '1', '签到', 5, '1522027513');
INSERT INTO `integral` VALUES (215, 37, '1', '签到', 5, '1522027851');
INSERT INTO `integral` VALUES (216, 99, '2', '兑换约课币', 1000, '1522041425');
INSERT INTO `integral` VALUES (217, 109, '1', '签到', 5, '1522046207');
INSERT INTO `integral` VALUES (218, 118, '1', '签到', 5, '1522049137');
INSERT INTO `integral` VALUES (219, 117, '1', '签到', 10, '1522112107');
INSERT INTO `integral` VALUES (220, 70, '1', '签到', 5, '1522112152');
INSERT INTO `integral` VALUES (221, 99, '1', '签到', 10, '1522112286');
INSERT INTO `integral` VALUES (222, 117, '1', '签到', 10, '1522112508');
INSERT INTO `integral` VALUES (223, 117, '1', '签到', 10, '1522112598');
INSERT INTO `integral` VALUES (224, 115, '1', '签到', 10, '1522112656');
INSERT INTO `integral` VALUES (225, 30, '1', '签到', 10, '1522113219');
INSERT INTO `integral` VALUES (226, 53, '1', '签到', 10, '1522135649');
INSERT INTO `integral` VALUES (227, 115, '2', '兑换商品', 2, '1522135676');
INSERT INTO `integral` VALUES (228, 118, '1', '签到', 10, '1522138280');
INSERT INTO `integral` VALUES (229, 53, '1', '签到', 10, '1522138568');
INSERT INTO `integral` VALUES (230, 6, '1', '签到', 5, '1522139302');
INSERT INTO `integral` VALUES (231, 37, '2', '兑换商品', 2, '1522141459');
INSERT INTO `integral` VALUES (232, 99, '1', '签到', 10, '1522204581');
INSERT INTO `integral` VALUES (233, 117, '1', '签到', 10, '1522204786');
INSERT INTO `integral` VALUES (234, 115, '1', '签到', 10, '1522204981');
INSERT INTO `integral` VALUES (235, 101, '1', '签到', 5, '1522205229');
INSERT INTO `integral` VALUES (236, 110, '1', '签到', 5, '1522205560');
INSERT INTO `integral` VALUES (237, 119, '1', '签到', 5, '1522214453');
INSERT INTO `integral` VALUES (238, 30, '1', '签到', 10, '1522219457');
INSERT INTO `integral` VALUES (239, 117, '2', '兑换商品', 2, '1522220406');
INSERT INTO `integral` VALUES (240, 37, '1', '签到', 5, '1522226489');
INSERT INTO `integral` VALUES (241, 118, '1', '签到', 5, '1522284297');
INSERT INTO `integral` VALUES (242, 99, '1', '签到', 10, '1522284881');
INSERT INTO `integral` VALUES (243, 97, '1', '签到', 5, '1522288349');
INSERT INTO `integral` VALUES (244, 110, '1', '签到', 10, '1522292640');
INSERT INTO `integral` VALUES (245, 99, '2', '兑换约课币', 300000, '1522295560');
INSERT INTO `integral` VALUES (246, 99, '2', '兑换约课币', 100000, '1522298799');
INSERT INTO `integral` VALUES (247, 99, '2', '兑换约课币', 100000, '1522298801');
INSERT INTO `integral` VALUES (248, 99, '2', '兑换约课币', 20000, '1522298846');
INSERT INTO `integral` VALUES (249, 99, '2', '兑换约课币', 20000, '1522298847');
INSERT INTO `integral` VALUES (250, 99, '2', '兑换约课币', 2000, '1522300418');
INSERT INTO `integral` VALUES (251, 115, '1', '签到', 10, '1522304336');
INSERT INTO `integral` VALUES (252, 30, '1', '签到', 10, '1522306549');
INSERT INTO `integral` VALUES (253, 115, '1', '签到', 10, '1522376524');
INSERT INTO `integral` VALUES (254, 128, '1', '签到', 5, '1522377620');
INSERT INTO `integral` VALUES (255, 97, '1', '签到', 10, '1522377927');
INSERT INTO `integral` VALUES (256, 117, '1', '签到', 5, '1522379766');
INSERT INTO `integral` VALUES (257, 99, '1', '签到', 10, '1522382355');
INSERT INTO `integral` VALUES (258, 30, '1', '签到', 10, '1522387629');
INSERT INTO `integral` VALUES (259, 6, '1', '签到', 5, '1522398359');
INSERT INTO `integral` VALUES (260, 30, '1', '签到', 5, '1522629662');
INSERT INTO `integral` VALUES (261, 130, '1', '签到', 5, '1522630208');
INSERT INTO `integral` VALUES (262, 6, '1', '签到', 5, '1522630626');
INSERT INTO `integral` VALUES (263, 99, '1', '签到', 5, '1522634367');
INSERT INTO `integral` VALUES (264, 99, '2', '兑换商品', 2, '1522650626');
INSERT INTO `integral` VALUES (265, 99, '2', '兑换商品', 2, '1522650705');
INSERT INTO `integral` VALUES (266, 115, '1', '签到', 5, '1522654467');
INSERT INTO `integral` VALUES (267, 129, '1', '签到', 5, '1522716766');
INSERT INTO `integral` VALUES (268, 30, '1', '签到', 10, '1522716871');
INSERT INTO `integral` VALUES (269, 99, '2', '兑换约课币', 1000, '1522724166');
INSERT INTO `integral` VALUES (270, 99, '1', '签到', 10, '1522724202');
INSERT INTO `integral` VALUES (271, 83, '1', '签到', 5, '1522734670');
INSERT INTO `integral` VALUES (272, 130, '1', '签到', 10, '1522735251');

-- ----------------------------
-- Table structure for lianxi
-- ----------------------------
DROP TABLE IF EXISTS `lianxi`;
CREATE TABLE `lianxi`  (
  `lianxi_id` int(11) NOT NULL AUTO_INCREMENT,
  `bumen` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '部门',
  `fangshi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '联系方式',
  PRIMARY KEY (`lianxi_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of lianxi
-- ----------------------------
INSERT INTO `lianxi` VALUES (2, '主播及机构合作', '邮箱：tccm@tc024.cn');
INSERT INTO `lianxi` VALUES (3, '广告销售', '电话：4000063088');

-- ----------------------------
-- Table structure for liveb
-- ----------------------------
DROP TABLE IF EXISTS `liveb`;
CREATE TABLE `liveb`  (
  `liveb_id` int(11) NOT NULL AUTO_INCREMENT,
  `class_id` int(11) NOT NULL COMMENT '课堂id',
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '直播名称',
  `img` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '直播封面',
  `time` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '开播时间',
  `reg_status` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0' COMMENT '报名状态    0：未报名  1：已报名',
  `status` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0' COMMENT '直播状态   0：未直播     1：在直播',
  `number` int(11) DEFAULT 0 COMMENT '在线人数',
  `money` float(8, 2) UNSIGNED NOT NULL DEFAULT 0.00 COMMENT '费用',
  `cate_id` int(11) NOT NULL COMMENT '分类id',
  `subscribe` int(255) NOT NULL DEFAULT 0 COMMENT '订阅人数',
  `recommend` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0' COMMENT '是否推荐   0：不推荐   1：推荐',
  `uid` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '报名的用户id',
  `introduce` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '直播介绍',
  `endtime` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0' COMMENT '结束时间',
  `heartbeat` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '' COMMENT '心跳次数',
  PRIMARY KEY (`liveb_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 396 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of liveb
-- ----------------------------
INSERT INTO `liveb` VALUES (1, 5, '零基础一起学俄语', '/Uploads/liveb/2018-03-15/5aaa063464ec1.jpg', '1581372161', '0', '0', 5, 10.00, 13, 0, '1', '', '零基础一起学俄语', '1581379320', '');
INSERT INTO `liveb` VALUES (2, 5, '新概念英语第二册', '/Uploads/liveb/2018-03-15/5aaa06be0386a.jpg', '1581372161', '1', '0', 0, 20.00, 2, 0, '1', '30', '新概念英语第二册', '1581379320', '');
INSERT INTO `liveb` VALUES (3, 5, '零基础学英语', '/Uploads/liveb/2018-03-15/5aaa06e77eb43.jpg', '1581372161', '1', '0', 0, 3.00, 2, 0, '1', '30', '零基础学英语', '1581379320', '');
INSERT INTO `liveb` VALUES (123, 5, '必修课，流利口语，名师直播互动   迷你小班', '/Uploads/liveb/2018-03-15/5aaa20f87887e.jpg', '1581372161', '1', '0', 0, 0.00, 2, 0, '0', '30', '必修课，流利口语，名师直播互动   迷你小班', '1581379320', '');
INSERT INTO `liveb` VALUES (204, 27, '常用办公软件从入门到精通', '/Uploads/liveb/2018-03-15/5aaa08aacb9a1.jpg', '1581372161', '1', '0', 0, 0.00, 3, 0, '1', '123', '常用办公软件从入门到精通', '1581379320', '');
INSERT INTO `liveb` VALUES (117, 30, '高中化学选修三', '/Uploads/liveb/2018-03-15/5aaa071c3a100.jpg', '1581372161', '1', '0', 0, 0.00, 4, 0, '1', '30', '高中化学选修三', '1581379320', '');
INSERT INTO `liveb` VALUES (357, 40, '3.21英语直播', '/Uploads/liveb/2018-03-21/5ab2127810660.jpg', '1521619860', '0', '0', 0, 2.00, 6, 0, '0', '', '哦耶啊健健康康*不吧啦嘉嘉兰OK啦', '1521620520', '');
INSERT INTO `liveb` VALUES (359, 42, '3.22直播常用工具', '/Uploads/liveb/2018-03-22/5ab31fa571c77.jpeg', '1521688680', '0', '0', 0, 0.00, 27, 0, '0', '', '甲亢灵颗粒季姬击*记看看季姬击*记看看看看**季姬击*记', '1521689400', '');
INSERT INTO `liveb` VALUES (362, 40, '3.21直播高中数学', '/Uploads/liveb/2018-03-22/5ab34c5274b26.jpeg', '1521700440', '0', '0', 0, 5.00, 34, 0, '0', '', '特高级教师亲临指导，奥数金牌教练多年经验，值得信赖', '1521701400', '');
INSERT INTO `liveb` VALUES (381, 42, '328直播人力', '/Uploads/liveb/2018-03-28/5abb3ecac5cd3.jpg', '1522221120', '1', '0', 0, 3.00, 48, 0, '0', '115', '丰盛的水电费是放水电费水电费放水电费是否的防守打法是非得失', '1522223999', '');
INSERT INTO `liveb` VALUES (375, 40, '327语言', '/Uploads/liveb/2018-03-27/5ab9a03ae531a.jpg', '1522114920', '0', '0', 0, 39.00, 9, 0, '0', '', '阿里季节来了力量力量力量力量力量力量力量了比较快', '1522115280', '');
INSERT INTO `liveb` VALUES (376, 33, 'Vue', '/Uploads/liveb/2018-03-27/5ab9a91923735.jpg', '1522116960', '0', '0', 0, 0.00, 59, 0, '0', '', 'Vue', '1522124040', '');
INSERT INTO `liveb` VALUES (377, 27, '测试001', '/Uploads/liveb/2018-03-27/5aba037a63912.jpg', '1522140120', '0', '0', 0, 0.00, 15, 0, '0', '', '反弹高度是否就会放空间的萨芬反弹高度是否就会放空间的萨芬反弹高度是否就会放空间的萨芬反弹高度是否就会放空间的萨芬反弹高度是否就会放空间的萨芬', '1522143440', '');
INSERT INTO `liveb` VALUES (35, 29, '职业新干线', '/Uploads/liveb/2018-03-15/5aaa3d56d5b05.jpg', '1581372161', '0', '0', 0, 0.00, 5, 0, '0', '', '职业新干线', '1581379320', '');
INSERT INTO `liveb` VALUES (36, 29, '零基础学报账和做税', '/Uploads/liveb/2018-03-15/5aaa087050159.jpg', '1581372161', '0', '0', 0, 0.00, 5, 0, '0', '', '零基础学报账和做税', '1581379320', '');
INSERT INTO `liveb` VALUES (38, 33, 'java互联网阶段（阶段四）', '/Uploads/liveb/2018-03-13/5aa738ea6bff9.jpg', '1581372161', '1', '0', 0, 0.00, 14, 0, '0', '129', 'java互联网阶段（阶段四）', '1581379320', '');
INSERT INTO `liveb` VALUES (39, 33, '从零开始学HTML5', '/Uploads/liveb/2018-03-15/5aaa3cd406bb5.jpg', '1581372161', '0', '0', 0, 0.00, 14, 0, '0', '', '从零开始学HTML5', '1581379320', '');
INSERT INTO `liveb` VALUES (41, 33, 'HTTP接口', '/Uploads/liveb/2018-03-13/5aa73931b3f2c.jpg', '1581372161', '0', '0', 0, 0.00, 14, 0, '0', '', 'HTTP接口测试', '1581379320', '');
INSERT INTO `liveb` VALUES (122, 5, '标准日本语，达人之路', '/Uploads/liveb/2018-03-15/5aaa207a94765.jpg', '1581372161', '1', '0', 0, 0.00, 2, 0, '0', '129', '标准日本语，达人之路', '1581379320', '');
INSERT INTO `liveb` VALUES (361, 42, '3.22直播早教', '/Uploads/liveb/2018-03-22/5ab325f478927.jpeg', '1521690360', '0', '0', 0, 0.00, 19, 0, '0', '', '早教很重要，需要早期介入教育要趁早', '1521691140', '');
INSERT INTO `liveb` VALUES (121, 27, '绘图神器', '/Uploads/liveb/2018-03-15/5aaa09024dfca.jpg', '1581372161', '0', '0', 0, 0.00, 3, 0, '0', '', '绘图神器', '1581379320', '');
INSERT INTO `liveb` VALUES (119, 27, '基础篇Excel', '/Uploads/liveb/2018-03-15/5aaa36d80dedf.jpg', '1581372161', '0', '0', 0, 0.00, 3, 0, '0', '', '基础篇Excel', '1581379320', '');
INSERT INTO `liveb` VALUES (386, 40, '329直播', '/Uploads/liveb/2018-03-29/5abc4e23687dd.jpg', '1522290480', '1', '0', 0, 5.00, 10, 0, '0', '97', '大锅饭似懂非懂是大幅度发是多少5555', '1522292399', '');
INSERT INTO `liveb` VALUES (77, 27, '国家计算机二级', '/Uploads/liveb/2018-03-15/5aaa36ff2841c.jpg', '1581372161', '0', '0', 0, 5.00, 3, 0, '0', '', '国家计算机二级', '1581379320', '');
INSERT INTO `liveb` VALUES (352, 41, '镜头下的*', '/Uploads/liveb/2018-03-20/5ab0b5a9b449e.jpeg', '1521530400', '0', '0', 0, 0.00, 6, 0, '0', '', '解放军附加费解放军附加费可滴滴滴滴飞机*的解放军附加费经济法', '1521530700', '');
INSERT INTO `liveb` VALUES (112, 27, '思维导图少年班', '/Uploads/liveb/2018-03-15/5aaa3721cfba8.jpg', '1581372161', '0', '0', 0, 0.00, 3, 0, '0', '', '思维导图少年班', '1581379320', '');
INSERT INTO `liveb` VALUES (200, 5, '基础，常用英语表达，备考大提速', '/Uploads/liveb/2018-03-15/5aaa20928b4a9.jpg', '1581372161', '1', '0', 0, 0.00, 2, 0, '0', '30', '基础，常用英语表达，备考大提速', '1581379320', '');
INSERT INTO `liveb` VALUES (201, 29, '轻松读书谈话的力量', '/Uploads/liveb/2018-03-15/5aaa38977b7f3.jpg', '1581372161', '0', '0', 0, 0.00, 5, 0, '0', '', '轻松读书谈话的力量', '1581379320', '');
INSERT INTO `liveb` VALUES (202, 29, '90天考上公务员', '/Uploads/liveb/2018-03-15/5aaa382f636cd.jpg', '1581372161', '0', '0', 0, 0.00, 5, 0, '0', '', '90天考上公务员', '1581379320', '');
INSERT INTO `liveb` VALUES (203, 27, 'SharePoint2013管理', '/Uploads/liveb/2018-03-15/5aaa376eb69a4.jpg', '1581372161', '0', '0', 0, 0.00, 3, 0, '0', '', 'SharePoint2013管理', '1581379320', '');
INSERT INTO `liveb` VALUES (116, 33, '从零开始学习html5', '/Uploads/liveb/2018-03-13/5aa738fe9e7ac.jpg', '1581372161', '0', '0', 0, 0.00, 14, 0, '0', '', '从零开始学习html5', '1581379320', '');
INSERT INTO `liveb` VALUES (262, 29, '职场小白升职记', '/Uploads/liveb/2018-03-15/5aaa3d3e0df79.jpg', '1581372161', '0', '0', 0, 0.00, 5, 0, '0', '', '职场小白升职记', '1581379320', '');
INSERT INTO `liveb` VALUES (259, 33, '微信小程序开发与数据分析', '/Uploads/liveb/2018-03-13/5aa73913cd33b.jpg', '1581372161', '0', '0', 0, 0.00, 14, 0, '0', '', '微信小程序开发与数据分析', '1581379320', '');
INSERT INTO `liveb` VALUES (210, 29, '公务员面试,必会知识点', '/Uploads/liveb/2018-03-15/5aaa390b7e05b.jpg', '1581372161', '0', '0', 0, 0.00, 5, 0, '0', '', '公务员面试,必会知识点', '1581379320', '');
INSERT INTO `liveb` VALUES (208, 27, '10个Execel技巧', '/Uploads/liveb/2018-03-15/5aaa379180ec8.jpg', '1581372161', '1', '0', 0, 0.00, 3, 0, '0', '130', '10个Execel技巧', '1581379320', '');
INSERT INTO `liveb` VALUES (211, 27, '二级建造师公开课', '/Uploads/liveb/2018-03-15/5aaa37c8d5ded.jpg', '1581372161', '0', '0', 0, 0.00, 3, 0, '0', '', '二级建造师公开课', '1581379320', '');
INSERT INTO `liveb` VALUES (367, 44, '323小学教育', '/Uploads/liveb/2018-03-23/5ab46859c7a0f.jpeg', '1521772800', '0', '0', 0, 3.00, 20, 0, '0', '', 'all默默地all啦know屠夫夫妻旅途', '1521773940', '');
INSERT INTO `liveb` VALUES (213, 30, '高一物理直线运动提分题', '/Uploads/liveb/2018-03-15/5aaa076c2ceb4.jpg', '1581372161', '0', '0', 0, 0.00, 4, 0, '0', '', '高一物理直线运动提分题', '1581379320', '');
INSERT INTO `liveb` VALUES (384, 42, '328直播大学', '/Uploads/liveb/2018-03-28/5abb4dcb2c544.jpg', '1522224840', '1', '0', 0, 0.00, 42, 0, '0', '115', '阿里季节来了啊啦啦咯的嗯啦啦啦啊啦哩啦啦啊啦咯哦哦哦大家了', '1522227000', '');
INSERT INTO `liveb` VALUES (215, 33, '接口测试，60day成为资深测试师', '/Uploads/liveb/2018-03-15/5aaa396cadf4f.jpg', '1581372161', '0', '0', 0, 0.00, 14, 0, '0', '', '接口测试，60day成为资深测试师', '1581379320', '');
INSERT INTO `liveb` VALUES (258, 33, 'Linux云计算入门到精通视频', '/Uploads/liveb/2018-03-13/5aa738d7a350a.jpg', '1581372161', '0', '0', 0, 0.00, 14, 0, '0', '', 'Linux云计算入门到精通视频教程', '1581379320', '');
INSERT INTO `liveb` VALUES (219, 30, '高三数学决战高考', '/Uploads/liveb/2018-03-15/5aaa07a964e31.jpg', '1581372161', '0', '0', 0, 0.00, 4, 0, '0', '', '高三数学决战高考', '1581379320', '');
INSERT INTO `liveb` VALUES (334, 33, 'asdfadsfs', '/Uploads/liveb/2018-03-19/5aaf0a3e5cfe1.jpg', '1521420960', '0', '0', 0, 0.00, 50, 0, '0', '', 'asdfasdfa', '1521428040', '');
INSERT INTO `liveb` VALUES (221, 30, '高三英语三十三天冲刺', '/Uploads/liveb/2018-03-15/5aaa07d8956bd.jpg', '1581372161', '0', '0', 0, 0.00, 4, 0, '0', '', '高三英语三十三天冲刺', '1581379320', '');
INSERT INTO `liveb` VALUES (365, 40, '3.22韩语', '/Uploads/liveb/2018-03-22/5ab3723dbbfc7.jpeg', '1521710040', '0', '0', 0, 3.00, 11, 0, '0', '', '老K咯么*ll陌陌Jack莫得OK了了all哦哦fellall魔法咯*ll几克拉噜啦啦', '1521712740', '');
INSERT INTO `liveb` VALUES (356, 40, '3.21俄语学习', '/Uploads/liveb/2018-03-21/5ab20de59d1b1.jpg', '1521618420', '0', '0', 0, 1.00, 6, 0, '0', '', '进货价格环境规划激光焊接高合金钢环境规划激光焊接价格价格环境规划', '1521619199', '');
INSERT INTO `liveb` VALUES (335, 40, '3.19英语直播', '/Uploads/liveb/2018-03-19/5aaf13979b969.jpg', '1527130800', '0', '0', 0, 50.00, 6, 0, '0', '', '全国知名教授，口语发音纯正，地道，值得学习', '1527131939', '');
INSERT INTO `liveb` VALUES (223, 30, '2018高考语文，诗歌阅读满分攻略', '/Uploads/liveb/2018-03-15/5aaa2badbd3f0.jpg', '1581372161', '0', '0', 0, 0.00, 4, 0, '0', '', '2018高考语文，诗歌阅读满分攻略', '1581379320', '');
INSERT INTO `liveb` VALUES (224, 30, '高考数学，部分考点精讲', '/Uploads/liveb/2018-03-15/5aaa2bcb78b50.jpg', '1581372161', '0', '0', 0, 0.00, 4, 0, '0', '', '高考数学，部分考点精讲', '1581379320', '');
INSERT INTO `liveb` VALUES (225, 30, '高考作文，考场救命大法', '/Uploads/liveb/2018-03-15/5aaa2be73c421.jpg', '1581372161', '0', '0', 0, 0.00, 4, 0, '0', '', '高考作文，考场救命大法', '1581379320', '');
INSERT INTO `liveb` VALUES (226, 30, '高一物理直线运动基础篇', '/Uploads/liveb/2018-03-15/5aaa2c142fc8d.jpg', '1581372161', '0', '0', 0, 0.00, 4, 0, '0', '', '高一物理直线运动基础篇', '1581379320', '');
INSERT INTO `liveb` VALUES (363, 40, '3.21直播高中数学', '/Uploads/liveb/2018-03-22/5ab352d415e9b.jpeg', '1521701760', '0', '1', 0, 0.00, 6, 0, '0', '', 'LOL我自己在家误会一意孤行行吗咯哦摸', '1521705360', '');
INSERT INTO `liveb` VALUES (364, 40, '3.22韩语', '/Uploads/liveb/2018-03-22/5ab36ba1b670e.jpeg', '1521708120', '0', '0', 0, 3.00, 11, 0, '0', '', '咯可口可乐了lack金卡嗯啦啊咯可口可乐了暴龙兽', '1521709140', '');
INSERT INTO `liveb` VALUES (233, 33, '全新JAVA互联网（阶段四）', '/Uploads/liveb/2018-03-15/5aaa39801771b.jpg', '1581372161', '0', '0', 0, 0.00, 14, 0, '0', '', '全新JAVA互联网（阶段四）', '1581379320', '');
INSERT INTO `liveb` VALUES (345, 40, '3.20外语早教', '/Uploads/liveb/2018-03-20/5ab06bd5bef58.jpg', '1521511800', '0', '0', 0, 2.00, 9, 0, '0', '', '课堂生动活泼，交流活跃，全程英语无汉语', '1521513839', '');
INSERT INTO `liveb` VALUES (347, 40, '3.20英语六级直播', '/Uploads/liveb/2018-03-20/5ab081871c29d.jpg', '1521517200', '0', '0', 0, 80.00, 10, 0, '0', '', '教师经验丰富，培训出来的学生英语六级包过。', '1521518399', '');
INSERT INTO `liveb` VALUES (351, 40, '3.20*高中数学', '/Uploads/liveb/2018-03-20/5ab0a24539010.jpg', '1521525540', '0', '0', 0, 9.00, 34, 0, '0', '', '个电饭锅电饭锅电饭锅风格的风格大范甘迪的反倒是第三方发给第三方飞电风扇地方的大锅饭神神道道发鬼地方帝国时代方给打', '1521525959', '');
INSERT INTO `liveb` VALUES (358, 42, '3.22直播人力资源', '/Uploads/liveb/2018-03-22/5ab314ac233da.jpeg', '1521685800', '0', '0', 0, 55.00, 48, 0, '0', '', '人力资源专家给您上课，您身边的资源高手', '1521687180', '');
INSERT INTO `liveb` VALUES (355, 40, '遗憾你啊啦里啦啦哦根据啦里啦啦啦啦毕竟咯儿啊姐姐哦啦', '/Uploads/liveb/2018-03-21/5ab1f4d2b1f1f.jpg', '1521612600', '0', '0', 0, 22.00, 59, 0, '0', '', '的啊俱乐部啦', '1521612900', '');
INSERT INTO `liveb` VALUES (383, 30, '退出', '/Uploads/liveb/2018-03-28/5abb4a03b059d.jpeg', '1522223700', '1', '0', 0, 0.00, 6, 0, '0', '37', '8句不不不不复读不差速度符额叶他他他', '1522230900', '');
INSERT INTO `liveb` VALUES (374, 40, '327直播管理能力', '/Uploads/liveb/2018-03-27/5ab99e06c580d.jpg', '1522114440', '0', '0', 0, 2.00, 49, 0, '0', '', '季节来了哦凝聚力量极具特色健健康康力量极魔法拉利力量里突了进来了', '1522114800', '');
INSERT INTO `liveb` VALUES (261, 29, '如何掌控自己的时间', '/Uploads/liveb/2018-03-15/5aaa386fe317d.jpg', '1581372161', '0', '0', 0, 0.00, 5, 0, '0', '', '如何掌控自己的时间', '1581379320', '');
INSERT INTO `liveb` VALUES (354, 40, '3.21公务员课程直播', '/Uploads/liveb/2018-03-21/5ab1bd7a4b21a.jpg', '1521598140', '0', '0', 0, 0.00, 52, 0, '0', '', '教师严谨，认真教学', '1521599400', '');
INSERT INTO `liveb` VALUES (253, 5, '零基础变身--流利口语剑桥国际', '/Uploads/liveb/2018-03-15/5aaa20b7d0115.jpg', '1581372161', '1', '0', 0, 0.00, 2, 0, '0', '30', '零基础变身--流利口语剑桥国际', '1581379320', '');
INSERT INTO `liveb` VALUES (380, 40, '328直播', '/Uploads/liveb/2018-03-28/5abb339c7d8cd.jpg', '1522217940', '1', '0', 0, 5.00, 8, 0, '0', '117', '发个可控硅挂号费和规范化*活发过火发过火谷歌和给发个', '1522219259', '');
INSERT INTO `liveb` VALUES (353, 40, '3.20直', '/Uploads/liveb/2018-03-20/5ab0cea350041.jpeg', '1521536940', '0', '1', 0, 3.00, 58, 0, '0', '', '叫家里几个来理解啦咯啦咯了啦咯啦咯啦咯啦咯啦咯啦咯啦咯啦咯啦咯啦咯啦咯啦咯啦咯啦咯啦咯啦咯啦咯啦咯啦咯啦咯刘经理', '1521537660', '');
INSERT INTO `liveb` VALUES (257, 5, '彭僮亚雅思，阅读全能技巧课', '/Uploads/liveb/2018-03-15/5aaa20cc3374c.jpg', '1581372161', '0', '0', 0, 0.00, 2, 0, '0', '', '彭僮亚雅思，阅读全能技巧课', '1581379320', '');
INSERT INTO `liveb` VALUES (373, 40, '326直播高中语文', '/Uploads/liveb/2018-03-26/5ab8847783925.png', '1522042200', '0', '0', 0, 2.00, 35, 0, '0', '', '会更好晶晶好好经济环境会更好 交好看科技科技', '1522043999', '');
INSERT INTO `liveb` VALUES (372, 42, '36高中数学直播', '/Uploads/liveb/2018-03-26/5ab86be4ddeec.jpeg', '1522035900', '0', '0', 0, 3.00, 61, 0, '0', '', '高中数学考虑图看看嗯啦啦啦啊几克拉', '1522036680', '');
INSERT INTO `liveb` VALUES (371, 42, '32高中数学直', '/Uploads/liveb/2018-03-23/5ab4b726d5659.jpeg', '1521793620', '0', '0', 0, 9.00, 34, 0, '0', '', '5斤模具是因为我铝土矿鹏举这种情况录音弄孩子下雨了', '1521795000', '');
INSERT INTO `liveb` VALUES (385, 30, '动画', '/Uploads/liveb/2018-03-28/5abba30a1e24e.jpeg', '1522246440', '0', '0', 0, 0.00, 6, 0, '0', NULL, '觉得肌肤卡夫卡高考高考公共课解放军附加费句句可控硅', '1522246500', '');
INSERT INTO `liveb` VALUES (370, 44, '哦婆婆6艘哦', '/Uploads/liveb/2018-03-23/5ab4ae9d7f425.jpeg', '1521790980', '0', '0', 0, 0.00, 6, 0, '0', '', '你OK哦LOL莫咯6艘木木木欧诺破功哦娱乐无极限加油咯咯', '1521794160', '');
INSERT INTO `liveb` VALUES (256, 29, '项目管理十大模板', '/Uploads/liveb/2018-03-15/5aaa38cf6ce06.jpg', '1581372161', '0', '0', 0, 0.00, 5, 0, '0', '', '项目管理十大模板', '1581379320', '');
INSERT INTO `liveb` VALUES (387, 44, '330直播语文', '/Uploads/liveb/2018-03-30/5abdaaf077814.jpeg', '1522379760', '0', '0', 0, 3.00, 35, 0, '0', NULL, '高中语文课程讲解家里了理解考虑考虑', '1522380720', '');
INSERT INTO `liveb` VALUES (388, 42, '330直播早教', '/Uploads/liveb/2018-03-30/5abdb45720d59.jpeg', '1522381980', '1', '0', 0, 0.00, 9, 0, '0', '115', '来咯哦打咯女子与老K嗯OK了了了考虑图咯啦咯了', '1522382340', '');
INSERT INTO `liveb` VALUES (389, 44, '330直播基', '/Uploads/liveb/2018-03-30/5abdf883c7905.jpeg', '1522399560', '1', '0', 0, 0.00, 17, 0, '0', '99', 'kill图SUV*图URL路吐了咯啦咯了all里咯考虑图家里阿狸弄', '1522400340', '');
INSERT INTO `liveb` VALUES (390, 27, 'Java从入门到放弃', '/Uploads/liveb/2018-04-02/5ac183403803a.png', '1522631520', '0', '0', 0, 0.00, 27, 0, '0', NULL, '如题,Java从入门到放弃~~~~~~~~~~~!', '1522631987', '');
INSERT INTO `liveb` VALUES (391, 40, '42直播1', '/Uploads/liveb/2018-04-02/5ac1d9ca5a97e.jpeg', '1522653900', '1', '0', 0, 0.00, 34, 0, '0', '115', '利拉德墨迹考虑all里咯考虑图阿里啦咯啦咯', '1522655040', '');
INSERT INTO `liveb` VALUES (392, 40, '43测试直播数学', '/Uploads/liveb/2018-04-03/5ac2e845782df.jpg', '1522723200', '0', '0', 0, 5.00, 34, 0, '0', NULL, '很反感个电饭锅电饭锅电饭锅个电饭锅电饭锅给对方黑胡椒好几个好看接口接口', '1522724399', '');
INSERT INTO `liveb` VALUES (393, 40, '43高级教师直播', '/Uploads/liveb/2018-04-03/5ac3224792d51.jpg', '1522738200', '0', '0', 0, 0.00, 6, 0, '0', NULL, '的防守打法是光伏发电反倒是发送到是', '1522738799', '');
INSERT INTO `liveb` VALUES (394, 40, '43高级教师直播', '/Uploads/liveb/2018-04-03/5ac3224bdcce0.jpg', '1522738200', '0', '0', 0, 0.00, 6, 0, '0', NULL, '的防守打法是光伏发电反倒是发送到是', '1522738799', '');
INSERT INTO `liveb` VALUES (395, 30, '十年戎马心孤单', '/Uploads/liveb/2018-04-03/5ac325f4a4f48.jpeg', '1522738740', '0', '0', 0, 0.00, 6, 0, '0', NULL, '公共课LOL咯恐龙哦LOL咯来咯来咯可得诺诺诺摩托', '1522742340', '');

-- ----------------------------
-- Table structure for lunbo
-- ----------------------------
DROP TABLE IF EXISTS `lunbo`;
CREATE TABLE `lunbo`  (
  `lunbo_id` int(11) NOT NULL AUTO_INCREMENT,
  `img` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '图片地址',
  `url` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '跳转地址',
  `status` char(1) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '0' COMMENT '状态   0：显示  1：不显示',
  `num` int(11) DEFAULT NULL COMMENT '顺序',
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `cate_id` int(11) DEFAULT NULL COMMENT '分类id',
  `pc` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '是否是pc轮播   1：是  2：否',
  `type` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '类型   0：直播  1：视频',
  `play_id` int(11) DEFAULT NULL COMMENT '直播或者视频id',
  PRIMARY KEY (`lunbo_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 35 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of lunbo
-- ----------------------------
INSERT INTO `lunbo` VALUES (15, '/Uploads/lunbo/2018-01-08/5a5327e9a0349.jpg', 'http://www.baidu.com', '0', 2, '交换机', NULL, '', '0', 1);
INSERT INTO `lunbo` VALUES (17, '/Uploads/lunbo/2018-01-08/5a53287c1fc99.jpg', 'http://www.baidu.com', '0', 223, '2222', NULL, '', '0', 2);
INSERT INTO `lunbo` VALUES (10, '/Uploads/lunbo/2017-12-14/5a3211913b920.png', 'http://www.baidu.com', '1', 1, '123', NULL, '', '0', 3);
INSERT INTO `lunbo` VALUES (16, '/Uploads/lunbo/2.jpg', 'http://www.taobao.com', '0', 12333333, '122121', NULL, '', '0', 4);
INSERT INTO `lunbo` VALUES (19, '/Uploads/lunbo/3.jpg', 'http://www.baidu.com', '0', 2222323, '1258963', NULL, '', '0', 1);
INSERT INTO `lunbo` VALUES (21, '/Uploads/lunbo/2018-03-19/5aaf2a5eaba55.jpg', '', '0', 2, '网约课', 1, '', '0', 1);
INSERT INTO `lunbo` VALUES (20, '/Uploads/lunbo/2018-03-19/5aaf2a4e78b09.jpg', '', '0', 1, '网约课', 1, '', '0', 2);
INSERT INTO `lunbo` VALUES (22, '/Uploads/lunbo/2018-03-19/5aaf2a6b37e50.jpg', '', '0', 3, '网约课', 1, '', '0', 1);
INSERT INTO `lunbo` VALUES (23, '/Uploads/lunbo/2018-03-19/5aaf2a779b15e.jpg', '', '0', 4, '网约课', 1, '', '0', 1);
INSERT INTO `lunbo` VALUES (24, '/Uploads/lunbo/3.jpg', 'http://www.baidu.com', '0', NULL, NULL, 3, '', '0', 1);
INSERT INTO `lunbo` VALUES (25, '/Uploads/lunbo/3.jpg', 'http://www.baidu.com', '0', NULL, NULL, 3, '', '0', 1);
INSERT INTO `lunbo` VALUES (26, '/Uploads/lunbo/3.jpg', 'http://www.baidu.com', '0', NULL, NULL, 4, '', '0', 1);
INSERT INTO `lunbo` VALUES (27, '/Uploads/lunbo/3.jpg', 'http://www.baidu.com', '0', NULL, NULL, 4, '', '0', 1);
INSERT INTO `lunbo` VALUES (28, '/Uploads/lunbo/3.jpg', 'http://www.baidu.com', '0', NULL, NULL, 5, '', '0', 1);
INSERT INTO `lunbo` VALUES (29, '/Uploads/lunbo/3.jpg', 'http://www.baidu.com', '0', NULL, NULL, 5, '', '0', 1);
INSERT INTO `lunbo` VALUES (30, '/Uploads/lunbo/2018-03-19/5aaf1c8ad642f.jpg', '', '0', 2, '网约课', NULL, '1', '0', 1);
INSERT INTO `lunbo` VALUES (31, '/Uploads/lunbo/2018-03-19/5aaf2224977a1.jpg', '', '0', 1, '网约课', NULL, '1', '0', 1);
INSERT INTO `lunbo` VALUES (32, '/Uploads/lunbo/2018-03-19/5aaf1ca6dcd8a.jpg', '', '0', 1, '网约课', NULL, '1', '0', 1);
INSERT INTO `lunbo` VALUES (33, '/Uploads/lunbo/2018-03-19/5aaf1cb51985c.jpg', '', '0', 1, '网约课', NULL, '1', '0', 1);
INSERT INTO `lunbo` VALUES (34, '/Uploads/lunbo/2018-03-01/5a97b3a07d778.jpg', 'http://www.baidu.com', '1', 5, '55555', NULL, '', NULL, NULL);

-- ----------------------------
-- Table structure for news
-- ----------------------------
DROP TABLE IF EXISTS `news`;
CREATE TABLE `news`  (
  `news_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '标题',
  `content` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '内容',
  `time` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '时间',
  `uid` int(11) DEFAULT NULL COMMENT '用户id',
  `status` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0' COMMENT '阅读状态  0：未读   1：已读',
  `tuisong` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0' COMMENT '推送状态 0：未推送 1：已推送',
  PRIMARY KEY (`news_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 137 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of news
-- ----------------------------
INSERT INTO `news` VALUES (6, '测试消息标题6', '测试消息内容666666666666', '1509515077', 13, '1', '1');
INSERT INTO `news` VALUES (7, '测试消息标题7', '测试消息内容7777777777777', '1509515077', 13, '1', '0');
INSERT INTO `news` VALUES (8, '测试消息标题8', '测试消息内容88888888888', '1509515077', 6, '1', '0');
INSERT INTO `news` VALUES (13, '3', '3', '1509515077', NULL, '1', '1');
INSERT INTO `news` VALUES (14, '测试消息标题6', '测试消息内容666666666666', '1509515077', 12, '1', '1');
INSERT INTO `news` VALUES (15, '测试消息标题7', '测试消息内容7777777777777', '1509515077', 13, '1', '1');
INSERT INTO `news` VALUES (16, '测试消息标题8', '测试消息内容88888888888', '1509515077', 13, '1', '0');
INSERT INTO `news` VALUES (122, '您的资质审核通过', '您的资质审核通过', '1521530113', 59, '1', '1');
INSERT INTO `news` VALUES (102, '您的资质审核通过', '您的资质审核通过', '1520581213', 99, '1', '1');
INSERT INTO `news` VALUES (61, '您的资质被拒绝', '21515151', '1516322121', 20, '1', '1');
INSERT INTO `news` VALUES (62, '您的资质被拒绝', '8585858', '1516322220', 21, '1', '1');
INSERT INTO `news` VALUES (63, '您的资质审核通过', '您的资质审核通过', '1516322244', 22, '1', '1');
INSERT INTO `news` VALUES (66, '您的资质审核通过', '您的资质审核通过', '1516351881', 23, '1', '1');
INSERT INTO `news` VALUES (76, '您的资质审核通过', '您的资质审核通过', '1516782382', 44, '1', '1');
INSERT INTO `news` VALUES (73, '您的资质审核通过', '您的资质审核通过', '1516776000', 40, '1', '1');
INSERT INTO `news` VALUES (74, '您的资质审核通过', '您的资质审核通过', '1516776291', 40, '1', '1');
INSERT INTO `news` VALUES (75, '您的资质审核通过', '您的资质审核通过', '1516778847', 43, '1', '1');
INSERT INTO `news` VALUES (78, '您的资质审核通过', '您的资质审核通过', '1516842792', 30, '1', '1');
INSERT INTO `news` VALUES (80, '提现状态', '您已经提现成功，注意银行卡信息', '1517451091', 30, '1', '1');
INSERT INTO `news` VALUES (81, '您的资质审核通过', '您的资质审核通过', '1517982089', 6, '1', '1');
INSERT INTO `news` VALUES (82, '提现状态', '您已经提现成功，注意银行卡信息', '1517458616', 30, '1', '1');
INSERT INTO `news` VALUES (103, '您的资质被拒绝', '审核不通过', '1520863868', 101, '1', '1');
INSERT INTO `news` VALUES (84, '提现状态', '您已经提现成功，注意银行卡信息', '1519626300', 6, '1', '1');
INSERT INTO `news` VALUES (85, '提现状态', '您已经提现成功，注意银行卡信息', '1519626320', 6, '1', '1');
INSERT INTO `news` VALUES (86, '提现状态', '您已经提现成功，注意银行卡信息', '1519626430', 6, '1', '1');
INSERT INTO `news` VALUES (87, '提现状态', '您已经提现成功，注意银行卡信息', '1519626972', 30, '1', '1');
INSERT INTO `news` VALUES (88, '提现状态', '您已经提现成功，交易单号58978456123558544', '1519627073', 30, '1', '1');
INSERT INTO `news` VALUES (90, '您的资质审核通过', '您的资质审核通过', '1519710108', 65, '1', '1');
INSERT INTO `news` VALUES (91, '您的资质审核通过', '您的资质审核通过', '1519715144', 61, '1', '1');
INSERT INTO `news` VALUES (92, '您的资质审核通过', '您的资质审核通过', '1519721861', 70, '1', '1');
INSERT INTO `news` VALUES (93, '您的资质被拒绝', '55555555', '1519796299', 74, '1', '1');
INSERT INTO `news` VALUES (94, '您的资质审核通过', '您的资质审核通过', '1519811531', 76, '1', '1');
INSERT INTO `news` VALUES (95, '提现状态', '您已经提现成功，交易单号555555555', '1519813279', 30, '1', '1');
INSERT INTO `news` VALUES (96, '您的资质审核通过', '您的资质审核通过', '1519814414', 72, '1', '1');
INSERT INTO `news` VALUES (97, '提现状态', '您已经提现成功，交易单号56666666665656', '1519815829', 72, '1', '1');
INSERT INTO `news` VALUES (98, '您的资质审核通过', '您的资质审核通过', '1519817520', 78, '1', '1');
INSERT INTO `news` VALUES (99, '提现状态', '您已经提现成功，交易单号4545646564', '1519957830', 61, '1', '1');
INSERT INTO `news` VALUES (100, '您的资质审核通过', '您的资质审核通过', '1520215595', 82, '1', '1');
INSERT INTO `news` VALUES (101, '您的资质审核通过', '您的资质审核通过', '1520489183', 96, '1', '1');
INSERT INTO `news` VALUES (104, '您的资质审核通过', '您的资质审核通过', '1520864024', 101, '1', '1');
INSERT INTO `news` VALUES (105, '您的资质被拒绝', 'dddddddddd', '1520901259', 100, '1', '1');
INSERT INTO `news` VALUES (106, '您的资质被拒绝', 'hhhhhhhhhhhhhh', '1520901376', 100, '1', '1');
INSERT INTO `news` VALUES (107, '您的资质被拒绝', '拒绝原因：gggg', '1520905317', 100, '1', '1');
INSERT INTO `news` VALUES (108, '您的资质被拒绝', '拒绝原因：fffff', '1520906085', 100, '1', '1');
INSERT INTO `news` VALUES (109, '您的资质被拒绝', '拒绝原因：ljlljl', '1520917778', 100, '1', '1');
INSERT INTO `news` VALUES (110, '您的资质被拒绝', '拒绝原因：1111', '1520932433', 110, '1', '1');
INSERT INTO `news` VALUES (111, '您的资质被拒绝', '拒绝原因：fffff ', '1520933916', 37, '1', '1');
INSERT INTO `news` VALUES (112, '您的资质被拒绝', '拒绝原因：hghggg', '1520934861', 37, '1', '1');
INSERT INTO `news` VALUES (113, '您的资质被拒绝', '拒绝原因：gggggg', '1520935972', 37, '1', '1');
INSERT INTO `news` VALUES (114, '您的资质被拒绝', '拒绝原因：jkdfjldkf尽快发货快递费加咖啡几十块劳动法解放军开始来得及发牢骚水电费吉林省肯德基富士康的家里省电看见了速度快放假斯柯达积分', '1520936202', 110, '1', '1');
INSERT INTO `news` VALUES (115, '您的资质被拒绝', '拒绝原因：个地方官的分电饭锅电饭锅的故事大富大贵个电饭锅电饭锅的个地方官的收费个地方官的分格式的风格的风格大富大贵', '1520936382', 110, '1', '1');
INSERT INTO `news` VALUES (116, '您的资质被拒绝', '拒绝原因：dddd ', '1520987970', 100, '1', '1');
INSERT INTO `news` VALUES (117, '您的资质被拒绝', '拒绝原因：edddddd', '1520988204', 100, '1', '1');
INSERT INTO `news` VALUES (118, '您的资质被拒绝', '拒绝原因：gfgfg', '1520988277', 100, '1', '1');
INSERT INTO `news` VALUES (119, '您的资质被拒绝', '拒绝原因：rffff', '1520988352', 100, '1', '1');
INSERT INTO `news` VALUES (120, '您的资质被拒绝', '拒绝原因：手机ID老实交代卡死了都分开的九分裤劳动法姜考虑副驾驶的', '1520994843', 111, '1', '1');
INSERT INTO `news` VALUES (121, '您的资质审核通过', '您的资质审核通过', '1520998096', 111, '1', '1');
INSERT INTO `news` VALUES (123, '您的资质审核通过', '您的资质审核通过', '1521617299', 117, '1', '1');
INSERT INTO `news` VALUES (124, '您的资质审核通过', '您的资质审核通过', '1521625175', 100, '1', '1');
INSERT INTO `news` VALUES (125, '您的资质审核通过', '您的资质审核通过', '1521702100', 115, '1', '1');
INSERT INTO `news` VALUES (126, '您的资质审核通过', '您的资质审核通过', '1521766864', 119, '1', '1');
INSERT INTO `news` VALUES (127, '您的资质被拒绝', '拒绝原因：55555', '1521775049', 37, '1', '1');
INSERT INTO `news` VALUES (128, '消息', '嘿嘿', '1521795725', NULL, '1', '1');
INSERT INTO `news` VALUES (129, '您的资质被拒绝', '拒绝原因：555555555555555', '1522046192', 109, '1', '1');
INSERT INTO `news` VALUES (130, '您的资质被拒绝', '拒绝原因：就是不通过', '1522046492', 109, '0', '1');
INSERT INTO `news` VALUES (131, '提现状态', '您已经提现成功，交易单号ewqewqewqew', '1522141275', 99, '1', '1');
INSERT INTO `news` VALUES (132, '提现状态', '您已经提现成功，交易单号11111111111111111', '1522141628', 99, '1', '1');
INSERT INTO `news` VALUES (133, '提现状态', '您已经提现成功，交易单号22222222222222', '1522141918', 99, '1', '1');
INSERT INTO `news` VALUES (134, '您的资质审核通过', '您的资质审核通过', '1522285392', 95, '1', '1');
INSERT INTO `news` VALUES (135, '您的资质被拒绝', '拒绝原因：33333', '1522285432', 97, '1', '1');
INSERT INTO `news` VALUES (136, '您的资质审核通过', '您的资质审核通过', '1522288412', 97, '1', '1');

-- ----------------------------
-- Table structure for newsread
-- ----------------------------
DROP TABLE IF EXISTS `newsread`;
CREATE TABLE `newsread`  (
  `newsread_id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '用户id',
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0' COMMENT '状态 0：未读  1：已读',
  PRIMARY KEY (`newsread_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 36 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of newsread
-- ----------------------------
INSERT INTO `newsread` VALUES (1, 115, '1');
INSERT INTO `newsread` VALUES (2, 6, '1');
INSERT INTO `newsread` VALUES (3, 101, '0');
INSERT INTO `newsread` VALUES (4, 37, '1');
INSERT INTO `newsread` VALUES (5, 121, '0');
INSERT INTO `newsread` VALUES (6, 111, '0');
INSERT INTO `newsread` VALUES (7, 30, '1');
INSERT INTO `newsread` VALUES (8, 117, '1');
INSERT INTO `newsread` VALUES (9, 99, '1');
INSERT INTO `newsread` VALUES (10, 118, '1');
INSERT INTO `newsread` VALUES (11, 119, '0');
INSERT INTO `newsread` VALUES (12, 53, '1');
INSERT INTO `newsread` VALUES (13, 58, '1');
INSERT INTO `newsread` VALUES (14, 70, '0');
INSERT INTO `newsread` VALUES (15, 109, '0');
INSERT INTO `newsread` VALUES (16, 122, '1');
INSERT INTO `newsread` VALUES (17, 81, '0');
INSERT INTO `newsread` VALUES (18, 83, '1');
INSERT INTO `newsread` VALUES (19, 59, '0');
INSERT INTO `newsread` VALUES (20, 110, '1');
INSERT INTO `newsread` VALUES (21, 97, '1');
INSERT INTO `newsread` VALUES (22, 123, '0');
INSERT INTO `newsread` VALUES (23, 64, '0');
INSERT INTO `newsread` VALUES (24, 66, '1');
INSERT INTO `newsread` VALUES (25, 124, '0');
INSERT INTO `newsread` VALUES (26, 125, '0');
INSERT INTO `newsread` VALUES (27, 126, '1');
INSERT INTO `newsread` VALUES (28, 63, '0');
INSERT INTO `newsread` VALUES (29, 60, '0');
INSERT INTO `newsread` VALUES (30, 57, '1');
INSERT INTO `newsread` VALUES (31, 129, '1');
INSERT INTO `newsread` VALUES (32, 130, '1');
INSERT INTO `newsread` VALUES (33, 95, '0');
INSERT INTO `newsread` VALUES (34, 131, '0');
INSERT INTO `newsread` VALUES (35, 132, '0');

-- ----------------------------
-- Table structure for notice
-- ----------------------------
DROP TABLE IF EXISTS `notice`;
CREATE TABLE `notice`  (
  `notice_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '标题',
  `text` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '内容',
  `time` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '时间',
  `img` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '封面图片',
  `url` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '链接',
  `status` int(1) DEFAULT 1 COMMENT '1是未推送，2是推送',
  PRIMARY KEY (`notice_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 9 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of notice
-- ----------------------------
INSERT INTO `notice` VALUES (1, '充值优', '假期临近，充值特别优惠，冲100送1万，仅此一天', '2017-12-22 11:06:34', '/Uploads/notice/2017-12-15/5a333c3d55bf3.png', 'http://www.baidu.com', 1);
INSERT INTO `notice` VALUES (2, '入驻优惠', '腮帮子教育直播app上线啦~，欢迎各位老师入驻', '2017-12-22 13:46:10', '/Uploads/notice/2017-12-14/5a31eb9e9111c.png', 'http://www.baidu.com', 2);
INSERT INTO `notice` VALUES (5, 'dfdg', 'gdf', '2017-12-16 11:07:34', '/Uploads/notice/2017-12-14/5a31eafeac69c.png', 'http://www.baidu.com', 1);
INSERT INTO `notice` VALUES (6, '231654', '4565', '2017-12-15 11:06:22', '/Uploads/notice/2017-12-15/5a333c3174ff3.png', 'http://www.baidu.com', 1);
INSERT INTO `notice` VALUES (8, '321321', '6514+6', '2017-12-14 11:06:47', '/Uploads/notice/2017-12-14/5a31eaca22b7c.png', 'http://www.baidu.com', 1);
INSERT INTO `notice` VALUES (7, '161', '121', '2017-12-22 13:46:10', '/Uploads/notice/2017-12-15/5a333c4885993.png', 'http://www.baidu.com', 1);

-- ----------------------------
-- Table structure for order
-- ----------------------------
DROP TABLE IF EXISTS `order`;
CREATE TABLE `order`  (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '用户id',
  `play_id` int(11) NOT NULL COMMENT '课程id',
  `num` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '订单号',
  `time` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '订单生成时间',
  `money` decimal(8, 2) NOT NULL COMMENT '订单金额',
  `status` char(1) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0' COMMENT '状态  0 ：待支付    1：支付成功    2：已取消  3:已失效',
  `type` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0' COMMENT '类型   0：直播  1：视频',
  PRIMARY KEY (`order_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 534 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of order
-- ----------------------------
INSERT INTO `order` VALUES (484, 118, 109, '1522138699Ipm9V', '1522138699', 5.00, '3', '1');
INSERT INTO `order` VALUES (482, 37, 111, '1522134580K52DB', '1522134580', 3.00, '3', '1');
INSERT INTO `order` VALUES (479, 115, 125, '1522131700zHvgc', '1522131700', 7.00, '1', '1');
INSERT INTO `order` VALUES (481, 115, 117, '1522134317wUkET', '1522134317', 6.00, '2', '1');
INSERT INTO `order` VALUES (494, 115, 131, '1522215720AouZ4', '1522215720', 9.00, '1', '1');
INSERT INTO `order` VALUES (495, 117, 130, '15222165135y7ER', '1522216513', 6.00, '1', '1');
INSERT INTO `order` VALUES (533, 115, 118, '1522742294WFyVk', '1522742294', 1.00, '0', '1');
INSERT INTO `order` VALUES (461, 37, 96, '15220408309LQBW', '1522040830', 998.00, '2', '1');
INSERT INTO `order` VALUES (422, 118, 98, '1521694440xGV5R', '1521694440', 0.00, '1', '1');
INSERT INTO `order` VALUES (421, 118, 108, '1521694416tlluS', '1521694416', 0.00, '1', '1');
INSERT INTO `order` VALUES (420, 118, 97, '15216943799HwdG', '1521694379', 0.00, '1', '1');
INSERT INTO `order` VALUES (419, 53, 110, '1521690640cIXVb', '1521690640', 8.00, '3', '1');
INSERT INTO `order` VALUES (496, 117, 380, '1522217947IcX5P', '1522217947', 5.00, '1', '0');
INSERT INTO `order` VALUES (446, 37, 108, '1522029812k4XUw', '1522029812', 0.00, '2', '1');
INSERT INTO `order` VALUES (414, 53, 109, '1521687003itjRI', '1521687003', 5.00, '1', '1');
INSERT INTO `order` VALUES (415, 53, 112, '1521687244eeVeP', '1521687244', 5.00, '1', '1');
INSERT INTO `order` VALUES (409, 53, 111, '1521686487gXSb1', '1521686487', 3.00, '1', '1');
INSERT INTO `order` VALUES (455, 70, 111, '1522035225CaMsa', '1522035225', 3.00, '3', '1');
INSERT INTO `order` VALUES (497, 115, 381, '1522220852Dvhe9', '1522220852', 3.00, '1', '0');
INSERT INTO `order` VALUES (498, 37, 383, '1522223634ecAfo', '1522223634', 0.00, '1', '0');
INSERT INTO `order` VALUES (364, 101, 102, '15214298657r9w1', '1521429865', 8.00, '1', '1');
INSERT INTO `order` VALUES (442, 117, 97, '1521796515pQTkc', '1521796515', 0.00, '1', '1');
INSERT INTO `order` VALUES (500, 37, 118, '15222843197ucnn', '1522284319', 1.00, '0', '1');
INSERT INTO `order` VALUES (342, 70, 97, '1521186084DSLNf', '1521186084', 0.00, '1', '1');
INSERT INTO `order` VALUES (454, 70, 119, '1522035106WALOm', '1522035106', 2.00, '2', '1');
INSERT INTO `order` VALUES (531, 131, 113, '1522736113AxzwU', '1522736113', 0.00, '1', '1');
INSERT INTO `order` VALUES (501, 99, 121, '1522284550Li8Ck', '1522284550', 3.00, '3', '1');
INSERT INTO `order` VALUES (406, 118, 106, '1521681163JCEw2', '1521681163', 0.00, '1', '1');
INSERT INTO `order` VALUES (502, 97, 386, '1522291721j6WCR', '1522291721', 5.00, '1', '0');
INSERT INTO `order` VALUES (517, 99, 389, '1522399450O9UAY', '1522399450', 0.00, '1', '0');
INSERT INTO `order` VALUES (532, 99, 125, '1522740488hLFEr', '1522740488', 7.00, '1', '1');
INSERT INTO `order` VALUES (399, 117, 109, '1521603818WdOK8', '1521603818', 5.00, '1', '1');
INSERT INTO `order` VALUES (516, 115, 119, '1522396388Rp6dM', '1522396388', 2.00, '1', '1');
INSERT INTO `order` VALUES (389, 100, 102, '1521531782gWG77', '1521531782', 8.00, '3', '1');
INSERT INTO `order` VALUES (466, 99, 102, '1522055587ZzZtw', '1522055587', 8.00, '1', '1');
INSERT INTO `order` VALUES (464, 99, 117, '1522048053HnRAq', '1522048053', 6.00, '3', '1');
INSERT INTO `order` VALUES (438, 101, 117, '1521794599RUOWK', '1521794599', 6.00, '0', '1');
INSERT INTO `order` VALUES (439, 121, 117, '15217947055gwU6', '1521794705', 6.00, '0', '1');
INSERT INTO `order` VALUES (445, 37, 111, '1522029803RMJAJ', '1522029803', 3.00, '1', '1');
INSERT INTO `order` VALUES (499, 115, 384, '15222247432HuvR', '1522224743', 0.00, '1', '0');
INSERT INTO `order` VALUES (343, 70, 106, '15211927589Y2Hr', '1521192758', 0.00, '1', '1');
INSERT INTO `order` VALUES (428, 109, 108, '1521776187nT1Se', '1521776187', 0.00, '1', '1');
INSERT INTO `order` VALUES (429, 120, 106, '1521776630tCnyZ', '1521776630', 0.00, '1', '1');
INSERT INTO `order` VALUES (434, 115, 96, '1521787556IDjtn', '1521787556', 998.00, '1', '1');
INSERT INTO `order` VALUES (485, 37, 102, '1522140189GXcw3', '1522140189', 8.00, '1', '1');
INSERT INTO `order` VALUES (486, 37, 109, '1522140251X4GIR', '1522140251', 5.00, '1', '1');
INSERT INTO `order` VALUES (487, 37, 125, '1522140290Zw0hY', '1522140290', 7.00, '1', '1');
INSERT INTO `order` VALUES (488, 99, 122, '15221406890nroM', '1522140689', 4.00, '1', '1');
INSERT INTO `order` VALUES (489, 37, 122, '1522141096yhFyV', '1522141096', 4.00, '1', '1');
INSERT INTO `order` VALUES (493, 99, 90, '15222083076DyCs', '1522208307', 998.00, '1', '1');
INSERT INTO `order` VALUES (507, 117, 140, '152231319255aQe', '1522313192', 0.00, '1', '1');
INSERT INTO `order` VALUES (508, 99, 140, '1522313192GmoAT', '1522313192', 0.00, '1', '1');
INSERT INTO `order` VALUES (515, 99, 113, '1522392008dPdmh', '1522392008', 0.00, '1', '1');
INSERT INTO `order` VALUES (511, 115, 388, '1522381992uCqYm', '1522381992', 0.00, '1', '0');
INSERT INTO `order` VALUES (512, 99, 388, '1522381994uFddS', '1522381994', 0.00, '3', '0');
INSERT INTO `order` VALUES (527, 129, 392, '1522724164JX1s3', '1522724164', 5.00, '0', '0');
INSERT INTO `order` VALUES (518, 99, 117, '1522630703kdYjo', '1522630703', 6.00, '3', '1');
INSERT INTO `order` VALUES (519, 99, 141, '1522634291lfWHj', '1522634291', 0.00, '1', '1');
INSERT INTO `order` VALUES (520, 99, 118, '1522648879uPjx4', '1522648879', 1.00, '3', '1');
INSERT INTO `order` VALUES (521, 115, 129, '1522653369FcTIY', '1522653369', 0.00, '1', '1');
INSERT INTO `order` VALUES (522, 115, 391, '1522654038m9Wya', '1522654038', 0.00, '3', '0');
INSERT INTO `order` VALUES (523, 115, 391, '1522654038O37b6', '1522654038', 0.00, '1', '0');
INSERT INTO `order` VALUES (528, 99, 117, '15227333694kmxs', '1522733369', 6.00, '1', '1');
INSERT INTO `order` VALUES (530, 30, 1, '1522733655MwN9A', '1522733655', 10.00, '0', '0');

-- ----------------------------
-- Table structure for pay
-- ----------------------------
DROP TABLE IF EXISTS `pay`;
CREATE TABLE `pay`  (
  `pay_id` int(11) NOT NULL AUTO_INCREMENT,
  `idcard` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `bankcard` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `type` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '1' COMMENT '1:储蓄卡 2：信用卡',
  `bank` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `city` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `uid` int(11) NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`pay_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 41 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pay
-- ----------------------------
INSERT INTO `pay` VALUES (20, '210211199408102917', '6216610500006748161', '1', '中国银行', NULL, 72, '17640199694', '史秀泽');
INSERT INTO `pay` VALUES (15, '210211199408102917', '6216610500006748161', '1', '中国银行', NULL, 48, '17640199694', 'sxz');
INSERT INTO `pay` VALUES (33, '621081215898485912', '6210810730015585561', '1', '建设银行', '北京市东城区', 30, '15702431419', '王磊');
INSERT INTO `pay` VALUES (17, '210211199408102917', '6216610500006748161', '1', '中国银行', NULL, 61, '17640199694', '史秀泽');
INSERT INTO `pay` VALUES (26, '210711198510106666', '6225881243946508', '1', '招商银行', NULL, 101, '13610813125', '隐隐约约隐隐约约听到的最好声音第二排出');
INSERT INTO `pay` VALUES (36, '210911198709084435', '622588', '1', '招商银行', NULL, 99, '13610813125', '沉默');
INSERT INTO `pay` VALUES (29, '210811198704094437', '6225881243658709', '1', '招商银行', NULL, 111, '13610813125', '金磊');
INSERT INTO `pay` VALUES (39, '210711198510114428', '6225881243', '1', '招商银行', NULL, 117, '13610813125', '佳佳');
INSERT INTO `pay` VALUES (40, '210711198510147258', '62258812', '1', '招商银行', NULL, 115, '13610813125', '佳佳');

-- ----------------------------
-- Table structure for payrecord
-- ----------------------------
DROP TABLE IF EXISTS `payrecord`;
CREATE TABLE `payrecord`  (
  `payrecord_id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '用户id',
  `type` char(1) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '类型   1：收入    2：支出',
  `time` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '时间',
  `income` decimal(8, 2) DEFAULT 0.00 COMMENT '收入金额就是充值',
  `cid` int(11) DEFAULT NULL COMMENT '课程id',
  `pay` decimal(8, 2) DEFAULT 0.00 COMMENT '支出就是扣款',
  `source` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '' COMMENT '来源',
  PRIMARY KEY (`payrecord_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 441 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of payrecord
-- ----------------------------
INSERT INTO `payrecord` VALUES (9, 6, '2', '1511400860', 0.00, NULL, 100.00, '购买课程');
INSERT INTO `payrecord` VALUES (34, 40, '2', '1516958391', 0.00, NULL, 0.00, '罢了');
INSERT INTO `payrecord` VALUES (13, 23, '1', '1512439870', 0.00, 1, 10.00, '卖出课程');
INSERT INTO `payrecord` VALUES (10, 22, '2', '1511403503', 0.00, NULL, 2.00, '测试视频3');
INSERT INTO `payrecord` VALUES (12, 23, '1', '1512439870', 666666.00, NULL, 0.00, '测试课程');
INSERT INTO `payrecord` VALUES (14, 23, '1', '1512439870', 1.00, 1, 20.00, '卖出课程');
INSERT INTO `payrecord` VALUES (15, 23, '1', '1512439870', 1.00, 1, 5.00, '卖出课程');
INSERT INTO `payrecord` VALUES (35, 40, '1', '1516958391', 0.00, NULL, 0.00, '罢了');
INSERT INTO `payrecord` VALUES (17, 19, '1', '1514340658', 0.00, NULL, 0.00, 'dfdsf');
INSERT INTO `payrecord` VALUES (18, 28, '2', '1514343674', 0.00, NULL, 0.00, 'dfdsf');
INSERT INTO `payrecord` VALUES (19, 19, '1', '1514343674', 0.00, NULL, 0.00, 'dfdsf');
INSERT INTO `payrecord` VALUES (20, 28, '2', '1514343718', 0.00, NULL, 0.00, '测试分页3');
INSERT INTO `payrecord` VALUES (21, 19, '1', '1514343718', 0.00, NULL, 0.00, '测试分页3');
INSERT INTO `payrecord` VALUES (22, 28, '2', '1514343726', 0.00, NULL, 0.00, '测试分页2');
INSERT INTO `payrecord` VALUES (23, 19, '1', '1514343726', 0.00, NULL, 0.00, '测试分页2');
INSERT INTO `payrecord` VALUES (24, 28, '2', '1514344564', 0.00, NULL, 0.00, '测试分页2');
INSERT INTO `payrecord` VALUES (25, 19, '1', '1514344564', 0.00, NULL, 0.00, '测试分页2');
INSERT INTO `payrecord` VALUES (26, 28, '2', '1514345335', 0.00, NULL, 0.00, '测试分页2');
INSERT INTO `payrecord` VALUES (27, 19, '1', '1514345335', 0.00, NULL, 0.00, '测试分页2');
INSERT INTO `payrecord` VALUES (28, 28, '2', '1514345349', 0.00, NULL, 0.00, '测试分页专用');
INSERT INTO `payrecord` VALUES (29, 19, '1', '1514345349', 0.00, NULL, 0.00, '测试分页专用');
INSERT INTO `payrecord` VALUES (30, 28, '2', '1514345699', 0.00, NULL, 0.00, '测试分页3');
INSERT INTO `payrecord` VALUES (31, 19, '1', '1514345699', 0.00, NULL, 0.00, '测试分页3');
INSERT INTO `payrecord` VALUES (32, 28, '2', '1514347030', 0.00, NULL, 0.00, 'dfdsf');
INSERT INTO `payrecord` VALUES (33, 19, '1', '1514347030', 0.00, NULL, 0.00, 'dfdsf');
INSERT INTO `payrecord` VALUES (36, 30, '2', '1517202591', 0.00, NULL, 30.00, '农');
INSERT INTO `payrecord` VALUES (37, 19, '1', '1517202591', 30.00, NULL, 0.00, '农');
INSERT INTO `payrecord` VALUES (38, 30, '2', '1517211366', 0.00, NULL, 3.00, '测试视频4');
INSERT INTO `payrecord` VALUES (39, 6, '1', '1517211366', 3.00, NULL, 0.00, '测试视频4');
INSERT INTO `payrecord` VALUES (40, 40, '2', '1517214325', 0.00, NULL, 0.00, 'hhkk');
INSERT INTO `payrecord` VALUES (41, 40, '1', '1517214325', 0.00, NULL, 0.00, 'hhkk');
INSERT INTO `payrecord` VALUES (42, 40, '2', '1517214354', 0.00, NULL, 0.00, '你够如图一起魔女磨破哦婆婆你莫破哦婆婆哦送头揉揉头spout脱脱脱');
INSERT INTO `payrecord` VALUES (43, 40, '1', '1517214354', 0.00, NULL, 0.00, '你够如图一起魔女磨破哦婆婆你莫破哦婆婆哦送头揉揉头spout脱脱脱');
INSERT INTO `payrecord` VALUES (44, 40, '2', '1517214369', 0.00, NULL, 0.00, '罢了');
INSERT INTO `payrecord` VALUES (45, 40, '1', '1517214369', 0.00, NULL, 0.00, '罢了');
INSERT INTO `payrecord` VALUES (46, 40, '2', '1517217929', 0.00, NULL, 0.00, '你吼吼吼');
INSERT INTO `payrecord` VALUES (47, 40, '1', '1517217929', 0.00, NULL, 0.00, '你吼吼吼');
INSERT INTO `payrecord` VALUES (48, 43, '2', '1517225398', 0.00, NULL, 0.00, 'abc');
INSERT INTO `payrecord` VALUES (49, 19, '1', '1517225398', 0.00, NULL, 0.00, 'abc');
INSERT INTO `payrecord` VALUES (50, 43, '2', '1517225498', 0.00, NULL, 0.00, 'abc');
INSERT INTO `payrecord` VALUES (51, 19, '1', '1517225498', 0.00, NULL, 0.00, 'abc');
INSERT INTO `payrecord` VALUES (52, 43, '2', '1517225562', 0.00, NULL, 0.00, '安卓测试视频2');
INSERT INTO `payrecord` VALUES (53, 23, '1', '1517225562', 0.00, NULL, 0.00, '安卓测试视频2');
INSERT INTO `payrecord` VALUES (54, 30, '2', '1517279217', 0.00, NULL, 2.00, '测试');
INSERT INTO `payrecord` VALUES (55, 43, '1', '1517279217', 2.00, NULL, 0.00, '测试');
INSERT INTO `payrecord` VALUES (56, 40, '2', '1517284519', 0.00, NULL, 0.00, 'abc');
INSERT INTO `payrecord` VALUES (57, 19, '1', '1517284519', 0.00, NULL, 0.00, 'abc');
INSERT INTO `payrecord` VALUES (58, 40, '2', '1517284827', 0.00, NULL, 0.00, '第一章');
INSERT INTO `payrecord` VALUES (59, 19, '1', '1517284827', 0.00, NULL, 0.00, '第一章');
INSERT INTO `payrecord` VALUES (60, 40, '2', '1517284907', 0.00, NULL, 0.00, '第一章');
INSERT INTO `payrecord` VALUES (61, 19, '1', '1517284907', 0.00, NULL, 0.00, '第一章');
INSERT INTO `payrecord` VALUES (62, 40, '2', '1517284916', 0.00, NULL, 0.00, 'dfdsf');
INSERT INTO `payrecord` VALUES (63, 19, '1', '1517284916', 0.00, NULL, 0.00, 'dfdsf');
INSERT INTO `payrecord` VALUES (64, 40, '2', '1517318637', 0.00, NULL, 0.00, 'hhkk');
INSERT INTO `payrecord` VALUES (65, 40, '1', '1517318637', 0.00, NULL, 0.00, 'hhkk');
INSERT INTO `payrecord` VALUES (66, 40, '2', '1517318648', 0.00, NULL, 0.00, '你够如图一起魔女磨破哦婆婆你莫破哦婆婆哦送头揉揉头spout脱脱脱');
INSERT INTO `payrecord` VALUES (67, 40, '1', '1517318648', 0.00, NULL, 0.00, '你够如图一起魔女磨破哦婆婆你莫破哦婆婆哦送头揉揉头spout脱脱脱');
INSERT INTO `payrecord` VALUES (68, 40, '2', '1517318658', 0.00, NULL, 0.00, '您是颇多父母');
INSERT INTO `payrecord` VALUES (69, 40, '1', '1517318658', 0.00, NULL, 0.00, '您是颇多父母');
INSERT INTO `payrecord` VALUES (70, 30, '2', '1517563057', 0.00, NULL, 25.00, '54545454');
INSERT INTO `payrecord` VALUES (71, 30, '1', '1517563057', 25.00, NULL, 0.00, '54545454');
INSERT INTO `payrecord` VALUES (72, 48, '2', '1518175735', 0.00, NULL, 0.00, 'the fact is I ');
INSERT INTO `payrecord` VALUES (73, 48, '1', '1518175735', 0.00, NULL, 0.00, 'the fact is I ');
INSERT INTO `payrecord` VALUES (74, 48, '2', '1518175864', 0.00, NULL, 1.00, '测试视频');
INSERT INTO `payrecord` VALUES (75, 6, '1', '1518175864', 1.00, NULL, 0.00, '测试视频');
INSERT INTO `payrecord` VALUES (76, 2, '2', '1518312766', 0.00, NULL, 0.00, '这个才是直播');
INSERT INTO `payrecord` VALUES (77, 6, '1', '1518312766', 0.00, NULL, 0.00, '这个才是直播');
INSERT INTO `payrecord` VALUES (78, 2, '2', '1518312929', 0.00, NULL, 0.00, '这个才是直播');
INSERT INTO `payrecord` VALUES (79, 6, '1', '1518312929', 0.00, NULL, 0.00, '这个才是直播');
INSERT INTO `payrecord` VALUES (80, 48, '2', '1518418808', 0.00, NULL, 0.00, 'ywuwywy');
INSERT INTO `payrecord` VALUES (81, 48, '1', '1518418808', 0.00, NULL, 0.00, 'ywuwywy');
INSERT INTO `payrecord` VALUES (82, 48, '2', '1518419246', 0.00, NULL, 0.00, '666');
INSERT INTO `payrecord` VALUES (83, 48, '1', '1518419246', 0.00, NULL, 0.00, '666');
INSERT INTO `payrecord` VALUES (84, 49, '2', '1518422893', 0.00, NULL, 0.00, 'the fact is I ');
INSERT INTO `payrecord` VALUES (85, 48, '1', '1518422893', 0.00, NULL, 0.00, 'the fact is I ');
INSERT INTO `payrecord` VALUES (86, 49, '2', '1518488855', 0.00, NULL, 0.00, '地给个');
INSERT INTO `payrecord` VALUES (87, 40, '1', '1518488855', 0.00, NULL, 0.00, '地给个');
INSERT INTO `payrecord` VALUES (88, 49, '2', '1518493105', 0.00, NULL, 0.00, '地给个');
INSERT INTO `payrecord` VALUES (89, 40, '1', '1518493105', 0.00, NULL, 0.00, '地给个');
INSERT INTO `payrecord` VALUES (90, 48, '2', '1518502047', 0.00, NULL, 0.00, '132413');
INSERT INTO `payrecord` VALUES (91, 48, '1', '1518502047', 0.00, NULL, 0.00, '132413');
INSERT INTO `payrecord` VALUES (92, 45, '2', '1519645011', 0.00, NULL, 0.00, '陈大爷');
INSERT INTO `payrecord` VALUES (93, 53, '1', '1519645011', 0.00, NULL, 0.00, '陈大爷');
INSERT INTO `payrecord` VALUES (94, 61, '2', '1519712403', 0.00, NULL, 0.00, '哈哈哈');
INSERT INTO `payrecord` VALUES (95, 19, '1', '1519712403', 0.00, NULL, 0.00, '哈哈哈');
INSERT INTO `payrecord` VALUES (96, 70, '2', '1519781697', 0.00, NULL, 0.00, '这是一个非常好的视频');
INSERT INTO `payrecord` VALUES (97, 70, '1', '1519781697', 0.00, NULL, 0.00, '这是一个非常好的视频');
INSERT INTO `payrecord` VALUES (98, 74, '2', '1519786583', 0.00, NULL, 0.00, '233333333');
INSERT INTO `payrecord` VALUES (99, 65, '1', '1519786583', 0.00, NULL, 0.00, '233333333');
INSERT INTO `payrecord` VALUES (100, 70, '2', '1519787970', 0.00, NULL, 0.00, '你们都会觉得自己的');
INSERT INTO `payrecord` VALUES (101, 70, '1', '1519787970', 0.00, NULL, 0.00, '你们都会觉得自己的');
INSERT INTO `payrecord` VALUES (102, 6, '2', '1519788951', 0.00, NULL, 0.00, '好好了就行了');
INSERT INTO `payrecord` VALUES (103, 70, '1', '1519788951', 0.00, NULL, 0.00, '好好了就行了');
INSERT INTO `payrecord` VALUES (104, 6, '2', '1519789234', 0.00, NULL, 0.00, '呵呵呵');
INSERT INTO `payrecord` VALUES (105, 70, '1', '1519789234', 0.00, NULL, 0.00, '呵呵呵');
INSERT INTO `payrecord` VALUES (106, 6, '2', '1519789351', 0.00, NULL, 0.00, '哈哈大笑');
INSERT INTO `payrecord` VALUES (107, 70, '1', '1519789351', 0.00, NULL, 0.00, '哈哈大笑');
INSERT INTO `payrecord` VALUES (108, 53, '2', '1519794761', 0.00, NULL, 0.00, '安卓测试视频2');
INSERT INTO `payrecord` VALUES (109, 23, '1', '1519794761', 0.00, NULL, 0.00, '安卓测试视频2');
INSERT INTO `payrecord` VALUES (110, 70, '2', '1519803933', 0.00, NULL, 0.00, '八哥啊八哥');
INSERT INTO `payrecord` VALUES (111, 65, '1', '1519803933', 0.00, NULL, 0.00, '八哥啊八哥');
INSERT INTO `payrecord` VALUES (112, 65, '2', '1519805439', 0.00, NULL, 0.00, '你吼吼吼轻松');
INSERT INTO `payrecord` VALUES (113, 53, '1', '1519805439', 0.00, NULL, 0.00, '你吼吼吼轻松');
INSERT INTO `payrecord` VALUES (114, 72, '2', '1519815071', 0.00, NULL, 0.00, '我们都');
INSERT INTO `payrecord` VALUES (115, 72, '1', '1519815071', 0.00, NULL, 0.00, '我们都');
INSERT INTO `payrecord` VALUES (116, 72, '2', '1519816252', 0.00, NULL, 0.00, '测试安卓');
INSERT INTO `payrecord` VALUES (117, 53, '1', '1519816252', 0.00, NULL, 0.00, '测试安卓');
INSERT INTO `payrecord` VALUES (118, 53, '2', '1519816584', 0.00, NULL, 0.00, '第一章');
INSERT INTO `payrecord` VALUES (119, 19, '1', '1519816584', 0.00, NULL, 0.00, '第一章');
INSERT INTO `payrecord` VALUES (120, 30, '2', '1520227876', 0.00, NULL, 1.00, '测试视频');
INSERT INTO `payrecord` VALUES (121, 6, '1', '1520227876', 1.00, NULL, 0.00, '测试视频');
INSERT INTO `payrecord` VALUES (122, 70, '2', '1520307325', 0.00, NULL, 0.00, '不过这');
INSERT INTO `payrecord` VALUES (123, 65, '1', '1520307325', 0.00, NULL, 0.00, '不过这');
INSERT INTO `payrecord` VALUES (124, 70, '2', '1520325644', 0.00, NULL, 0.00, '哈哈哈啦啊分开');
INSERT INTO `payrecord` VALUES (125, 65, '1', '1520325644', 0.00, NULL, 0.00, '哈哈哈啦啊分开');
INSERT INTO `payrecord` VALUES (126, 53, '2', '1520401773', 0.00, NULL, 0.00, '方法');
INSERT INTO `payrecord` VALUES (127, 65, '1', '1520401773', 0.00, NULL, 0.00, '方法');
INSERT INTO `payrecord` VALUES (128, 53, '2', '1520413976', 0.00, NULL, 0.00, 'hrhigfuiju');
INSERT INTO `payrecord` VALUES (129, 70, '1', '1520413976', 0.00, NULL, 0.00, 'hrhigfuiju');
INSERT INTO `payrecord` VALUES (130, 53, '2', '1520471486', 0.00, NULL, 0.00, '我们一起来看看');
INSERT INTO `payrecord` VALUES (131, 70, '1', '1520471486', 0.00, NULL, 0.00, '我们一起来看看');
INSERT INTO `payrecord` VALUES (132, 96, '2', '1520492688', 0.00, NULL, 1.00, '测试视频');
INSERT INTO `payrecord` VALUES (133, 6, '1', '1520492688', 1.00, NULL, 0.00, '测试视频');
INSERT INTO `payrecord` VALUES (134, 97, '2', '1520587883', 0.00, NULL, 33.00, '胡哥胡哥讲解和国际化光辉国际化过后');
INSERT INTO `payrecord` VALUES (135, 99, '1', '1520587883', 33.00, NULL, 0.00, '胡哥胡哥讲解和国际化光辉国际化过后');
INSERT INTO `payrecord` VALUES (136, 30, '2', '1520588333', 0.00, NULL, 22.00, '3.9职业发展003');
INSERT INTO `payrecord` VALUES (137, 99, '1', '1520588333', 22.00, NULL, 0.00, '3.9职业发展003');
INSERT INTO `payrecord` VALUES (138, 97, '2', '1520590015', 0.00, NULL, 50.00, '直播标题11');
INSERT INTO `payrecord` VALUES (139, 99, '1', '1520590015', 50.00, NULL, 0.00, '直播标题11');
INSERT INTO `payrecord` VALUES (140, 97, '2', '1520590936', 0.00, NULL, 22.00, '3.9职业发展003');
INSERT INTO `payrecord` VALUES (141, 99, '1', '1520590936', 22.00, NULL, 0.00, '3.9职业发展003');
INSERT INTO `payrecord` VALUES (142, 97, '2', '1520685708', 0.00, NULL, 10.22, '3.10');
INSERT INTO `payrecord` VALUES (143, 99, '1', '1520685708', 10.22, NULL, 0.00, '3.10');
INSERT INTO `payrecord` VALUES (144, 97, '2', '1520686590', 0.00, NULL, 2.00, '3.10视频');
INSERT INTO `payrecord` VALUES (145, 99, '1', '1520686590', 2.00, NULL, 0.00, '3.10视频');
INSERT INTO `payrecord` VALUES (146, 6, '2', '1520821266', 0.00, NULL, 25.00, '安卓测试视频2');
INSERT INTO `payrecord` VALUES (147, 23, '1', '1520821266', 25.00, NULL, 0.00, '安卓测试视频2');
INSERT INTO `payrecord` VALUES (148, 101, '2', '1520842627', 0.00, NULL, 20.00, '3.12测试直播2');
INSERT INTO `payrecord` VALUES (149, 99, '1', '1520842627', 20.00, NULL, 0.00, '3.12测试直播2');
INSERT INTO `payrecord` VALUES (150, 101, '2', '1520845007', 0.00, NULL, 25.00, '安卓测试视频2');
INSERT INTO `payrecord` VALUES (151, 23, '1', '1520845007', 25.00, NULL, 0.00, '安卓测试视频2');
INSERT INTO `payrecord` VALUES (152, 101, '2', '1520845372', 0.00, NULL, 2.00, '测试视频3');
INSERT INTO `payrecord` VALUES (153, 6, '1', '1520845372', 2.00, NULL, 0.00, '测试视频3');
INSERT INTO `payrecord` VALUES (154, 101, '2', '1520845537', 0.00, NULL, 2.22, '3.12职业发展9');
INSERT INTO `payrecord` VALUES (155, 99, '1', '1520845537', 2.22, NULL, 0.00, '3.12职业发展9');
INSERT INTO `payrecord` VALUES (156, 101, '2', '1520845655', 0.00, NULL, 0.00, '还吃啊');
INSERT INTO `payrecord` VALUES (157, 53, '1', '1520845655', 0.00, NULL, 0.00, '还吃啊');
INSERT INTO `payrecord` VALUES (158, 99, '2', '1520903532', 0.00, NULL, 10.00, '测试视频办公');
INSERT INTO `payrecord` VALUES (159, 101, '1', '1520903532', 10.00, NULL, 0.00, '测试视频办公');
INSERT INTO `payrecord` VALUES (160, 99, '2', '1520909116', 0.00, NULL, 0.00, '月亮好');
INSERT INTO `payrecord` VALUES (161, 53, '1', '1520909116', 0.00, NULL, 0.00, '月亮好');
INSERT INTO `payrecord` VALUES (162, 70, '2', '1520910940', 0.00, NULL, 0.00, '3.12测试直播');
INSERT INTO `payrecord` VALUES (163, 99, '1', '1520910940', 0.00, NULL, 0.00, '3.12测试直播');
INSERT INTO `payrecord` VALUES (164, 101, '2', '1520912040', 0.00, NULL, 2.00, '3.13');
INSERT INTO `payrecord` VALUES (165, 99, '1', '1520912040', 2.00, NULL, 0.00, '3.13');
INSERT INTO `payrecord` VALUES (166, 99, '2', '1520912886', 0.00, NULL, 1.00, '测试亲子教育');
INSERT INTO `payrecord` VALUES (167, 101, '1', '1520912886', 1.00, NULL, 0.00, '测试亲子教育');
INSERT INTO `payrecord` VALUES (168, 6, '2', '1520913702', 0.00, NULL, 0.00, '11111111111');
INSERT INTO `payrecord` VALUES (169, 6, '1', '1520913702', 0.00, NULL, 0.00, '11111111111');
INSERT INTO `payrecord` VALUES (170, 99, '2', '1520919023', 0.00, NULL, 5.00, '测试再次预约');
INSERT INTO `payrecord` VALUES (171, 101, '1', '1520919023', 5.00, NULL, 0.00, '测试再次预约');
INSERT INTO `payrecord` VALUES (172, 99, '2', '1520919484', 0.00, NULL, 0.00, '3.13把家里来了');
INSERT INTO `payrecord` VALUES (173, 101, '1', '1520919484', 0.00, NULL, 0.00, '3.13把家里来了');
INSERT INTO `payrecord` VALUES (174, 53, '2', '1520925709', 0.00, NULL, 2.22, '3.12职业发展9');
INSERT INTO `payrecord` VALUES (175, 99, '1', '1520925709', 2.22, NULL, 0.00, '3.12职业发展9');
INSERT INTO `payrecord` VALUES (176, 30, '2', '1520925913', 0.00, NULL, 2.22, '3.12职业发展9');
INSERT INTO `payrecord` VALUES (177, 99, '1', '1520925913', 2.22, NULL, 0.00, '3.12职业发展9');
INSERT INTO `payrecord` VALUES (178, 99, '2', '1520931035', 0.00, NULL, 0.00, 'aaaaaaaaaa');
INSERT INTO `payrecord` VALUES (179, 70, '1', '1520931035', 0.00, NULL, 0.00, 'aaaaaaaaaa');
INSERT INTO `payrecord` VALUES (180, 6, '2', '1520931832', 0.00, NULL, 0.00, 'yy');
INSERT INTO `payrecord` VALUES (181, 30, '1', '1520931832', 0.00, NULL, 0.00, 'yy');
INSERT INTO `payrecord` VALUES (182, 110, '2', '1520934218', 0.00, NULL, 0.00, '测试直播产品');
INSERT INTO `payrecord` VALUES (183, 99, '1', '1520934218', 0.00, NULL, 0.00, '测试直播产品');
INSERT INTO `payrecord` VALUES (184, 111, '2', '1520995404', 0.00, NULL, 0.00, 'mp4哦里可口可乐旅途突天了几句突突突突天');
INSERT INTO `payrecord` VALUES (185, 99, '1', '1520995404', 0.00, NULL, 0.00, 'mp4哦里可口可乐旅途突天了几句突突突突天');
INSERT INTO `payrecord` VALUES (186, 111, '2', '1521000636', 0.00, NULL, 8.00, '3.14测试职业发展');
INSERT INTO `payrecord` VALUES (187, 99, '1', '1521000636', 8.00, NULL, 0.00, '3.14测试职业发展');
INSERT INTO `payrecord` VALUES (188, 111, '2', '1521001114', 0.00, NULL, 5.00, '314啊啊啊啊啊');
INSERT INTO `payrecord` VALUES (189, 99, '1', '1521001114', 5.00, NULL, 0.00, '314啊啊啊啊啊');
INSERT INTO `payrecord` VALUES (190, 111, '2', '1521006579', 0.00, NULL, 0.00, '还吃啊');
INSERT INTO `payrecord` VALUES (191, 53, '1', '1521006579', 0.00, NULL, 0.00, '还吃啊');
INSERT INTO `payrecord` VALUES (192, 111, '2', '1521006695', 0.00, NULL, 10.00, '测试视频办公');
INSERT INTO `payrecord` VALUES (193, 101, '1', '1521006695', 10.00, NULL, 0.00, '测试视频办公');
INSERT INTO `payrecord` VALUES (194, 99, '2', '1521008710', 0.00, NULL, 30.00, '314测试语言学习');
INSERT INTO `payrecord` VALUES (195, 111, '1', '1521008710', 30.00, NULL, 0.00, '314测试语言学习');
INSERT INTO `payrecord` VALUES (196, 111, '2', '1521017479', 0.00, NULL, 200.00, '314办公效率');
INSERT INTO `payrecord` VALUES (197, 111, '1', '1521017479', 200.00, NULL, 0.00, '314办公效率');
INSERT INTO `payrecord` VALUES (198, 99, '2', '1521018854', 0.00, NULL, 90.00, '高中英语');
INSERT INTO `payrecord` VALUES (199, 111, '1', '1521018854', 90.00, NULL, 0.00, '高中英语');
INSERT INTO `payrecord` VALUES (200, 53, '2', '1521075599', 0.00, NULL, 0.00, '安卓测试视频');
INSERT INTO `payrecord` VALUES (201, 6, '1', '1521075599', 0.00, NULL, 0.00, '安卓测试视频');
INSERT INTO `payrecord` VALUES (202, 53, '2', '1521075936', 0.00, NULL, 0.00, '阿里啦咯啦咯阿卡丽阿狸阿卡丽314');
INSERT INTO `payrecord` VALUES (203, 111, '1', '1521075936', 0.00, NULL, 0.00, '阿里啦咯啦咯阿卡丽阿狸阿卡丽314');
INSERT INTO `payrecord` VALUES (204, 53, '2', '1521082397', 0.00, NULL, 1.00, '测试视频');
INSERT INTO `payrecord` VALUES (205, 6, '1', '1521082397', 1.00, NULL, 0.00, '测试视频');
INSERT INTO `payrecord` VALUES (206, 111, '2', '1521084270', 0.00, NULL, 0.00, 'jjj');
INSERT INTO `payrecord` VALUES (207, 30, '1', '1521084270', 0.00, NULL, 0.00, 'jjj');
INSERT INTO `payrecord` VALUES (208, 53, '2', '1521084492', 0.00, NULL, 2.00, '测试视频3');
INSERT INTO `payrecord` VALUES (209, 6, '1', '1521084492', 2.00, NULL, 0.00, '测试视频3');
INSERT INTO `payrecord` VALUES (210, 111, '2', '1521084526', 0.00, NULL, 0.00, 'cheshui ');
INSERT INTO `payrecord` VALUES (211, 30, '1', '1521084526', 0.00, NULL, 0.00, 'cheshui ');
INSERT INTO `payrecord` VALUES (212, 53, '2', '1521084856', 0.00, NULL, 3.00, '测试视频4');
INSERT INTO `payrecord` VALUES (213, 6, '1', '1521084856', 3.00, NULL, 0.00, '测试视频4');
INSERT INTO `payrecord` VALUES (214, 53, '2', '1521084904', 0.00, NULL, 0.00, '我是视频');
INSERT INTO `payrecord` VALUES (215, 6, '1', '1521084904', 0.00, NULL, 0.00, '我是视频');
INSERT INTO `payrecord` VALUES (216, 53, '2', '1521085133', 0.00, NULL, 0.00, '高一物理：直线运动（基础篇）');
INSERT INTO `payrecord` VALUES (217, 30, '1', '1521085133', 0.00, NULL, 0.00, '高一物理：直线运动（基础篇）');
INSERT INTO `payrecord` VALUES (218, 111, '2', '1521103593', 0.00, NULL, 1.00, '测试视频进度');
INSERT INTO `payrecord` VALUES (219, 53, '1', '1521103593', 1.00, NULL, 0.00, '测试视频进度');
INSERT INTO `payrecord` VALUES (220, 101, '2', '1521103835', 0.00, NULL, 0.00, '测试');
INSERT INTO `payrecord` VALUES (221, 53, '1', '1521103835', 0.00, NULL, 0.00, '测试');
INSERT INTO `payrecord` VALUES (222, 70, '2', '1521104406', 0.00, NULL, 0.00, '测试');
INSERT INTO `payrecord` VALUES (223, 53, '1', '1521104406', 0.00, NULL, 0.00, '测试');
INSERT INTO `payrecord` VALUES (224, 99, '2', '1521105229', 0.00, NULL, 0.00, '测试');
INSERT INTO `payrecord` VALUES (225, 53, '1', '1521105229', 0.00, NULL, 0.00, '测试');
INSERT INTO `payrecord` VALUES (226, 99, '2', '1521106918', 0.00, NULL, 0.00, '好好学习');
INSERT INTO `payrecord` VALUES (227, 53, '1', '1521106918', 0.00, NULL, 0.00, '好好学习');
INSERT INTO `payrecord` VALUES (228, 99, '2', '1521107177', 0.00, NULL, 1.00, '测试视频进度');
INSERT INTO `payrecord` VALUES (229, 53, '1', '1521107177', 1.00, NULL, 0.00, '测试视频进度');
INSERT INTO `payrecord` VALUES (230, 53, '2', '1521176817', 0.00, NULL, 3.00, '零基础学英语');
INSERT INTO `payrecord` VALUES (231, 6, '1', '1521176817', 3.00, NULL, 0.00, '零基础学英语');
INSERT INTO `payrecord` VALUES (232, 70, '2', '1521186086', 0.00, NULL, 0.00, '测试雅思英语');
INSERT INTO `payrecord` VALUES (233, 99, '1', '1521186086', 0.00, NULL, 0.00, '测试雅思英语');
INSERT INTO `payrecord` VALUES (234, 70, '2', '1521192759', 0.00, NULL, 0.00, '测试托福考试');
INSERT INTO `payrecord` VALUES (235, 99, '1', '1521192759', 0.00, NULL, 0.00, '测试托福考试');
INSERT INTO `payrecord` VALUES (236, 111, '2', '1521192830', 0.00, NULL, 0.00, '测试托福考试');
INSERT INTO `payrecord` VALUES (237, 99, '1', '1521192830', 0.00, NULL, 0.00, '测试托福考试');
INSERT INTO `payrecord` VALUES (238, 53, '2', '1521192979', 0.00, NULL, 0.00, '测试托福考试');
INSERT INTO `payrecord` VALUES (239, 99, '1', '1521192979', 0.00, NULL, 0.00, '测试托福考试');
INSERT INTO `payrecord` VALUES (240, 53, '2', '1521421077', 0.00, NULL, 0.00, 'asdfadsfs');
INSERT INTO `payrecord` VALUES (241, 70, '1', '1521421077', 0.00, NULL, 0.00, 'asdfadsfs');
INSERT INTO `payrecord` VALUES (242, 37, '2', '1521424506', 0.00, NULL, 0.00, '镜头下的艺术一');
INSERT INTO `payrecord` VALUES (243, 53, '1', '1521424506', 0.00, NULL, 0.00, '镜头下的艺术一');
INSERT INTO `payrecord` VALUES (244, 37, '2', '1521424744', 0.00, NULL, 0.00, '镜头下的艺术二');
INSERT INTO `payrecord` VALUES (245, 53, '1', '1521424744', 0.00, NULL, 0.00, '镜头下的艺术二');
INSERT INTO `payrecord` VALUES (246, 37, '2', '1521425643', 0.00, NULL, 0.00, '镜头下的艺术三');
INSERT INTO `payrecord` VALUES (247, 53, '1', '1521425643', 0.00, NULL, 0.00, '镜头下的艺术三');
INSERT INTO `payrecord` VALUES (248, 37, '2', '1521426672', 0.00, NULL, 0.00, '镜头下的艺术四');
INSERT INTO `payrecord` VALUES (249, 53, '1', '1521426672', 0.00, NULL, 0.00, '镜头下的艺术四');
INSERT INTO `payrecord` VALUES (250, 37, '2', '1521427224', 0.00, NULL, 0.00, '镜头下的艺术五');
INSERT INTO `payrecord` VALUES (251, 53, '1', '1521427224', 0.00, NULL, 0.00, '镜头下的艺术五');
INSERT INTO `payrecord` VALUES (252, 37, '2', '1521427804', 0.00, NULL, 0.00, '镜头下的艺术6');
INSERT INTO `payrecord` VALUES (253, 53, '1', '1521427804', 0.00, NULL, 0.00, '镜头下的艺术6');
INSERT INTO `payrecord` VALUES (254, 111, '2', '1521427810', 0.00, NULL, 50.00, '3.19测试英语直播');
INSERT INTO `payrecord` VALUES (255, 99, '1', '1521427810', 50.00, NULL, 0.00, '3.19测试英语直播');
INSERT INTO `payrecord` VALUES (256, 37, '2', '1521428008', 0.00, NULL, 0.00, '镜头下的艺术7');
INSERT INTO `payrecord` VALUES (257, 53, '1', '1521428008', 0.00, NULL, 0.00, '镜头下的艺术7');
INSERT INTO `payrecord` VALUES (258, 111, '2', '1521429322', 0.00, NULL, 8.00, '测试上传');
INSERT INTO `payrecord` VALUES (259, 53, '1', '1521429322', 8.00, NULL, 0.00, '测试上传');
INSERT INTO `payrecord` VALUES (260, 111, '2', '1521429415', 0.00, NULL, 8.00, '镜头下的艺术8');
INSERT INTO `payrecord` VALUES (261, 53, '1', '1521429415', 8.00, NULL, 0.00, '镜头下的艺术8');
INSERT INTO `payrecord` VALUES (262, 111, '2', '1521429773', 0.00, NULL, 6.00, '镜头下的艺术9');
INSERT INTO `payrecord` VALUES (263, 53, '1', '1521429773', 6.00, NULL, 0.00, '镜头下的艺术9');
INSERT INTO `payrecord` VALUES (264, 101, '2', '1521429887', 0.00, NULL, 8.00, '测试上传');
INSERT INTO `payrecord` VALUES (265, 53, '1', '1521429887', 8.00, NULL, 0.00, '测试上传');
INSERT INTO `payrecord` VALUES (266, 30, '2', '1521452829', 0.00, NULL, 20.00, '新概念英语第二册');
INSERT INTO `payrecord` VALUES (267, 6, '1', '1521452829', 20.00, NULL, 0.00, '新概念英语第二册');
INSERT INTO `payrecord` VALUES (268, 101, '2', '1521512035', 0.00, NULL, 2.00, '3.20测试外语早教');
INSERT INTO `payrecord` VALUES (269, 99, '1', '1521512035', 2.00, NULL, 0.00, '3.20测试外语早教');
INSERT INTO `payrecord` VALUES (270, 37, '2', '1521517213', 0.00, NULL, 0.00, '镜头下的*10');
INSERT INTO `payrecord` VALUES (271, 53, '1', '1521517213', 0.00, NULL, 0.00, '镜头下的*10');
INSERT INTO `payrecord` VALUES (272, 37, '2', '1521520194', 0.00, NULL, 0.00, '镜头下的*一');
INSERT INTO `payrecord` VALUES (273, 53, '1', '1521520194', 0.00, NULL, 0.00, '镜头下的*一');
INSERT INTO `payrecord` VALUES (274, 37, '2', '1521524595', 0.00, NULL, 0.00, '镜头下的*一');
INSERT INTO `payrecord` VALUES (275, 53, '1', '1521524595', 0.00, NULL, 0.00, '镜头下的*一');
INSERT INTO `payrecord` VALUES (276, 115, '2', '1521598011', 0.00, NULL, 0.00, '3.21测试公务员课程直播');
INSERT INTO `payrecord` VALUES (277, 99, '1', '1521598011', 0.00, NULL, 0.00, '3.21测试公务员课程直播');
INSERT INTO `payrecord` VALUES (278, 115, '2', '1521601390', 0.00, NULL, 5.00, '3.21测试视频');
INSERT INTO `payrecord` VALUES (279, 99, '1', '1521601390', 5.00, NULL, 0.00, '3.21测试视频');
INSERT INTO `payrecord` VALUES (280, 117, '2', '1521603895', 0.00, NULL, 5.00, '3.21测试视频');
INSERT INTO `payrecord` VALUES (281, 99, '1', '1521603895', 5.00, NULL, 0.00, '3.21测试视频');
INSERT INTO `payrecord` VALUES (282, 117, '2', '1521618607', 0.00, NULL, 1.00, '3.21测试俄语学习');
INSERT INTO `payrecord` VALUES (283, 99, '1', '1521618607', 1.00, NULL, 0.00, '3.21测试俄语学习');
INSERT INTO `payrecord` VALUES (284, 117, '2', '1521619697', 0.00, NULL, 2.00, '3.21测试英语直播');
INSERT INTO `payrecord` VALUES (285, 99, '1', '1521619697', 2.00, NULL, 0.00, '3.21测试英语直播');
INSERT INTO `payrecord` VALUES (286, 117, '1', '1521620821', 1.00, NULL, 0.00, '');
INSERT INTO `payrecord` VALUES (287, 118, '2', '1521681163', 0.00, NULL, 0.00, '测试托福考试');
INSERT INTO `payrecord` VALUES (288, 99, '1', '1521681163', 0.00, NULL, 0.00, '测试托福考试');
INSERT INTO `payrecord` VALUES (289, 99, '2', '1521686346', 0.00, NULL, 10.00, '零基础一起学俄语');
INSERT INTO `payrecord` VALUES (290, 6, '1', '1521686346', 10.00, NULL, 0.00, '零基础一起学俄语');
INSERT INTO `payrecord` VALUES (291, 53, '2', '1521686503', 0.00, NULL, 3.00, '3.22测试视频');
INSERT INTO `payrecord` VALUES (292, 99, '1', '1521686503', 3.00, NULL, 0.00, '3.22测试视频');
INSERT INTO `payrecord` VALUES (293, 117, '2', '1521686632', 0.00, NULL, 3.00, '3.22测试视频');
INSERT INTO `payrecord` VALUES (294, 99, '1', '1521686632', 3.00, NULL, 0.00, '3.22测试视频');
INSERT INTO `payrecord` VALUES (295, 37, '2', '1521689678', 0.00, NULL, 3.00, '3.22测试视频');
INSERT INTO `payrecord` VALUES (296, 99, '1', '1521689678', 3.00, NULL, 0.00, '3.22测试视频');
INSERT INTO `payrecord` VALUES (297, 99, '2', '1521690174', 0.00, NULL, 0.00, '3.22测试直播早教');
INSERT INTO `payrecord` VALUES (298, 117, '1', '1521690174', 0.00, NULL, 0.00, '3.22测试直播早教');
INSERT INTO `payrecord` VALUES (299, 53, '2', '1521690550', 0.00, NULL, 5.00, '3.21测试视频');
INSERT INTO `payrecord` VALUES (300, 99, '1', '1521690550', 5.00, NULL, 0.00, '3.21测试视频');
INSERT INTO `payrecord` VALUES (301, 53, '2', '1521690714', 0.00, NULL, 5.00, '3.22 测试视频英语口语');
INSERT INTO `payrecord` VALUES (302, 117, '1', '1521690714', 5.00, NULL, 0.00, '3.22 测试视频英语口语');
INSERT INTO `payrecord` VALUES (303, 118, '2', '1521694379', 0.00, NULL, 0.00, '测试雅思英语');
INSERT INTO `payrecord` VALUES (304, 99, '1', '1521694379', 0.00, NULL, 0.00, '测试雅思英语');
INSERT INTO `payrecord` VALUES (305, 118, '2', '1521694416', 0.00, NULL, 0.00, '3.20*高中数学');
INSERT INTO `payrecord` VALUES (306, 99, '1', '1521694416', 0.00, NULL, 0.00, '3.20*高中数学');
INSERT INTO `payrecord` VALUES (307, 118, '2', '1521694440', 0.00, NULL, 0.00, '测试英语四级');
INSERT INTO `payrecord` VALUES (308, 99, '1', '1521694440', 0.00, NULL, 0.00, '测试英语四级');
INSERT INTO `payrecord` VALUES (309, 115, '2', '1521709370', 0.00, NULL, 22.00, '测试遗憾你啊啦里啦啦哦根据啦里啦啦啦啦毕竟咯儿啊姐姐哦啦');
INSERT INTO `payrecord` VALUES (310, 99, '1', '1521709370', 22.00, NULL, 0.00, '测试遗憾你啊啦里啦啦哦根据啦里啦啦啦啦毕竟咯儿啊姐姐哦啦');
INSERT INTO `payrecord` VALUES (311, 115, '2', '1521709669', 0.00, NULL, 3.00, '3.22测试韩语');
INSERT INTO `payrecord` VALUES (312, 99, '1', '1521709669', 3.00, NULL, 0.00, '3.22测试韩语');
INSERT INTO `payrecord` VALUES (313, 70, '2', '1521766364', 0.00, NULL, 8.00, '测试退出房间');
INSERT INTO `payrecord` VALUES (314, 53, '1', '1521766364', 8.00, NULL, 0.00, '测试退出房间');
INSERT INTO `payrecord` VALUES (315, 70, '2', '1521773848', 0.00, NULL, 0.00, '测试退出房间');
INSERT INTO `payrecord` VALUES (316, 53, '1', '1521773848', 0.00, NULL, 0.00, '测试退出房间');
INSERT INTO `payrecord` VALUES (317, 109, '2', '1521776187', 0.00, NULL, 0.00, '3.20*高中数学');
INSERT INTO `payrecord` VALUES (318, 99, '1', '1521776187', 0.00, NULL, 0.00, '3.20*高中数学');
INSERT INTO `payrecord` VALUES (319, 120, '2', '1521776631', 0.00, NULL, 0.00, '测试托福考试');
INSERT INTO `payrecord` VALUES (320, 99, '1', '1521776631', 0.00, NULL, 0.00, '测试托福考试');
INSERT INTO `payrecord` VALUES (321, 120, '2', '1521776850', 0.00, NULL, 0.00, '测试英语四级');
INSERT INTO `payrecord` VALUES (322, 99, '1', '1521776850', 0.00, NULL, 0.00, '测试英语四级');
INSERT INTO `payrecord` VALUES (323, 115, '2', '1521785852', 0.00, NULL, 5.00, '323测试移动*直播');
INSERT INTO `payrecord` VALUES (324, 53, '1', '1521785852', 5.00, NULL, 0.00, '323测试移动*直播');
INSERT INTO `payrecord` VALUES (325, 115, '2', '1521787556', 0.00, NULL, 998.00, '树立正确的文案观');
INSERT INTO `payrecord` VALUES (326, 49, '1', '1521787556', 998.00, NULL, 0.00, '树立正确的文案观');
INSERT INTO `payrecord` VALUES (327, 99, '2', '1521791472', 0.00, NULL, 0.00, '哦婆婆6艘哦');
INSERT INTO `payrecord` VALUES (328, 115, '1', '1521791472', 0.00, NULL, 0.00, '哦婆婆6艘哦');
INSERT INTO `payrecord` VALUES (329, 115, '2', '1521792992', 0.00, NULL, 9.00, '32测试高中数学直播');
INSERT INTO `payrecord` VALUES (330, 117, '1', '1521792992', 9.00, NULL, 0.00, '32测试高中数学直播');
INSERT INTO `payrecord` VALUES (331, 117, '2', '1521796516', 0.00, NULL, 0.00, '测试雅思英语');
INSERT INTO `payrecord` VALUES (332, 99, '1', '1521796516', 0.00, NULL, 0.00, '测试雅思英语');
INSERT INTO `payrecord` VALUES (333, 37, '2', '1522028465', 0.00, NULL, 0.00, '测试托福考试');
INSERT INTO `payrecord` VALUES (334, 99, '1', '1522028465', 0.00, NULL, 0.00, '测试托福考试');
INSERT INTO `payrecord` VALUES (335, 37, '2', '1522029812', 0.00, NULL, 0.00, '3.20*高中数学');
INSERT INTO `payrecord` VALUES (336, 99, '1', '1522029812', 0.00, NULL, 0.00, '3.20*高中数学');
INSERT INTO `payrecord` VALUES (337, 37, '2', '1522029821', 0.00, NULL, 0.00, '测试托福考试');
INSERT INTO `payrecord` VALUES (338, 99, '1', '1522029821', 0.00, NULL, 0.00, '测试托福考试');
INSERT INTO `payrecord` VALUES (339, 37, '2', '1522029827', 0.00, NULL, 0.00, '测试英语四级');
INSERT INTO `payrecord` VALUES (340, 99, '1', '1522029827', 0.00, NULL, 0.00, '测试英语四级');
INSERT INTO `payrecord` VALUES (341, 37, '2', '1522029835', 0.00, NULL, 0.00, '测试雅思英语');
INSERT INTO `payrecord` VALUES (342, 99, '1', '1522029835', 0.00, NULL, 0.00, '测试雅思英语');
INSERT INTO `payrecord` VALUES (343, 70, '2', '1522035056', 0.00, NULL, 0.00, '3.21测试直播高中数学');
INSERT INTO `payrecord` VALUES (344, 99, '1', '1522035056', 0.00, NULL, 0.00, '3.21测试直播高中数学');
INSERT INTO `payrecord` VALUES (345, 117, '2', '1522043581', 0.00, NULL, 2.00, '326测试直播高中语文');
INSERT INTO `payrecord` VALUES (346, 99, '1', '1522043581', 2.00, NULL, 0.00, '326测试直播高中语文');
INSERT INTO `payrecord` VALUES (347, 99, '2', '1522055603', 0.00, NULL, 8.00, '测试上传');
INSERT INTO `payrecord` VALUES (348, 53, '1', '1522055603', 8.00, NULL, 0.00, '测试上传');
INSERT INTO `payrecord` VALUES (349, 30, '2', '1522113117', 0.00, NULL, 1.00, '326flv');
INSERT INTO `payrecord` VALUES (350, 117, '1', '1522113117', 1.00, NULL, 0.00, '326flv');
INSERT INTO `payrecord` VALUES (351, 30, '2', '1522113164', 0.00, NULL, 3.00, '326mkv');
INSERT INTO `payrecord` VALUES (352, 117, '1', '1522113164', 3.00, NULL, 0.00, '326mkv');
INSERT INTO `payrecord` VALUES (353, 30, '2', '1522113204', 0.00, NULL, 4.00, '326avi');
INSERT INTO `payrecord` VALUES (354, 117, '1', '1522113204', 4.00, NULL, 0.00, '326avi');
INSERT INTO `payrecord` VALUES (355, 30, '2', '1522113243', 0.00, NULL, 3.00, '326mov');
INSERT INTO `payrecord` VALUES (356, 117, '1', '1522113243', 3.00, NULL, 0.00, '326mov');
INSERT INTO `payrecord` VALUES (357, 30, '2', '1522113277', 0.00, NULL, 7.00, '326wmv');
INSERT INTO `payrecord` VALUES (358, 117, '1', '1522113277', 7.00, NULL, 0.00, '326wmv');
INSERT INTO `payrecord` VALUES (359, 30, '2', '1522113315', 0.00, NULL, 8.00, '326vob');
INSERT INTO `payrecord` VALUES (360, 117, '1', '1522113315', 8.00, NULL, 0.00, '326vob');
INSERT INTO `payrecord` VALUES (361, 30, '2', '1522113351', 0.00, NULL, 2.00, '326测试视频格式');
INSERT INTO `payrecord` VALUES (362, 117, '1', '1522113351', 2.00, NULL, 0.00, '326测试视频格式');
INSERT INTO `payrecord` VALUES (363, 30, '2', '1522113450', 0.00, NULL, 5.00, '3263gp');
INSERT INTO `payrecord` VALUES (364, 117, '1', '1522113450', 5.00, NULL, 0.00, '3263gp');
INSERT INTO `payrecord` VALUES (365, 30, '2', '1522113566', 0.00, NULL, 6.00, '326flv');
INSERT INTO `payrecord` VALUES (366, 117, '1', '1522113566', 6.00, NULL, 0.00, '326flv');
INSERT INTO `payrecord` VALUES (367, 117, '2', '1522114390', 0.00, NULL, 2.00, '327测试直播管理能力');
INSERT INTO `payrecord` VALUES (368, 99, '1', '1522114390', 2.00, NULL, 0.00, '327测试直播管理能力');
INSERT INTO `payrecord` VALUES (369, 117, '2', '1522114686', 0.00, NULL, 39.00, '327测试语言');
INSERT INTO `payrecord` VALUES (370, 99, '1', '1522114686', 39.00, NULL, 0.00, '327测试语言');
INSERT INTO `payrecord` VALUES (371, 115, '2', '1522131700', 0.00, NULL, 7.00, '326wmv');
INSERT INTO `payrecord` VALUES (372, 117, '1', '1522131700', 7.00, NULL, 0.00, '326wmv');
INSERT INTO `payrecord` VALUES (373, 115, '2', '1522131956', 0.00, NULL, 0.00, '3.22测试直播常用工具');
INSERT INTO `payrecord` VALUES (374, 117, '1', '1522131956', 0.00, NULL, 0.00, '3.22测试直播常用工具');
INSERT INTO `payrecord` VALUES (375, 37, '2', '1522134597', 0.00, NULL, 3.00, '3.22测试视频');
INSERT INTO `payrecord` VALUES (376, 99, '1', '1522134597', 3.00, NULL, 0.00, '3.22测试视频');
INSERT INTO `payrecord` VALUES (377, 37, '2', '1522140226', 0.00, NULL, 8.00, '测试上传');
INSERT INTO `payrecord` VALUES (378, 53, '1', '1522140226', 8.00, NULL, 0.00, '测试上传');
INSERT INTO `payrecord` VALUES (379, 37, '2', '1522140265', 0.00, NULL, 5.00, '3.21测试视频');
INSERT INTO `payrecord` VALUES (380, 99, '1', '1522140265', 5.00, NULL, 0.00, '3.21测试视频');
INSERT INTO `payrecord` VALUES (381, 37, '2', '1522140301', 0.00, NULL, 7.00, '326wmv');
INSERT INTO `payrecord` VALUES (382, 117, '1', '1522140301', 7.00, NULL, 0.00, '326wmv');
INSERT INTO `payrecord` VALUES (383, 37, '2', '1522141160', 0.00, NULL, 4.00, '326avi');
INSERT INTO `payrecord` VALUES (384, 117, '1', '1522141160', 4.00, NULL, 0.00, '326avi');
INSERT INTO `payrecord` VALUES (385, 37, '2', '1522158085', 0.00, NULL, 6.00, '开个播来');
INSERT INTO `payrecord` VALUES (386, 53, '1', '1522158085', 6.00, NULL, 0.00, '开个播来');
INSERT INTO `payrecord` VALUES (387, 37, '2', '1522199386', 0.00, NULL, 0.00, '测试退出');
INSERT INTO `payrecord` VALUES (388, 53, '1', '1522199386', 0.00, NULL, 0.00, '测试退出');
INSERT INTO `payrecord` VALUES (389, 99, '2', '1522208452', 0.00, NULL, 998.00, '人性价值训练1');
INSERT INTO `payrecord` VALUES (390, 49, '1', '1522208452', 998.00, NULL, 0.00, '人性价值训练1');
INSERT INTO `payrecord` VALUES (391, 115, '2', '1522215756', 0.00, NULL, 9.00, '嘻嘻我是谓');
INSERT INTO `payrecord` VALUES (392, 99, '1', '1522215756', 9.00, NULL, 0.00, '嘻嘻我是谓');
INSERT INTO `payrecord` VALUES (393, 117, '2', '1522216513', 0.00, NULL, 6.00, '测试3.25');
INSERT INTO `payrecord` VALUES (394, 99, '1', '1522216513', 6.00, NULL, 0.00, '测试3.25');
INSERT INTO `payrecord` VALUES (395, 117, '2', '1522217947', 0.00, NULL, 5.00, '328测试直播');
INSERT INTO `payrecord` VALUES (396, 99, '1', '1522217947', 5.00, NULL, 0.00, '328测试直播');
INSERT INTO `payrecord` VALUES (397, 115, '2', '1522220873', 0.00, NULL, 3.00, '328测试直播人力');
INSERT INTO `payrecord` VALUES (398, 117, '1', '1522220873', 3.00, NULL, 0.00, '328测试直播人力');
INSERT INTO `payrecord` VALUES (399, 37, '2', '1522223634', 0.00, NULL, 0.00, '测试退出');
INSERT INTO `payrecord` VALUES (400, 53, '1', '1522223634', 0.00, NULL, 0.00, '测试退出');
INSERT INTO `payrecord` VALUES (401, 115, '2', '1522224744', 0.00, NULL, 0.00, '328测试直播大学');
INSERT INTO `payrecord` VALUES (402, 117, '1', '1522224744', 0.00, NULL, 0.00, '328测试直播大学');
INSERT INTO `payrecord` VALUES (403, 97, '2', '1522291729', 0.00, NULL, 5.00, '329测试直播');
INSERT INTO `payrecord` VALUES (404, 99, '1', '1522291729', 5.00, NULL, 0.00, '329测试直播');
INSERT INTO `payrecord` VALUES (405, 99, '1', '1522300418', 2.00, NULL, 0.00, '兑换约课币');
INSERT INTO `payrecord` VALUES (406, 30, '2', '1522309211', 0.00, NULL, 8.00, '测试上传');
INSERT INTO `payrecord` VALUES (407, 53, '1', '1522309211', 8.00, NULL, 0.00, '测试上传');
INSERT INTO `payrecord` VALUES (408, 30, '2', '1522309236', 0.00, NULL, 3.00, '零基础学英语');
INSERT INTO `payrecord` VALUES (409, 6, '1', '1522309236', 3.00, NULL, 0.00, '零基础学英语');
INSERT INTO `payrecord` VALUES (410, 30, '2', '1522309510', 0.00, NULL, 20.00, '新概念英语第二册');
INSERT INTO `payrecord` VALUES (411, 6, '1', '1522309510', 20.00, NULL, 0.00, '新概念英语第二册');
INSERT INTO `payrecord` VALUES (412, 99, '2', '1522313194', 0.00, NULL, 0.00, '329测试高中语文');
INSERT INTO `payrecord` VALUES (413, 115, '1', '1522313194', 0.00, NULL, 0.00, '329测试高中语文');
INSERT INTO `payrecord` VALUES (414, 117, '2', '1522313194', 0.00, NULL, 0.00, '329测试高中语文');
INSERT INTO `payrecord` VALUES (415, 115, '1', '1522313194', 0.00, NULL, 0.00, '329测试高中语文');
INSERT INTO `payrecord` VALUES (416, 115, '2', '1522381994', 0.00, NULL, 0.00, '330测试直播早教');
INSERT INTO `payrecord` VALUES (417, 117, '1', '1522381994', 0.00, NULL, 0.00, '330测试直播早教');
INSERT INTO `payrecord` VALUES (418, 99, '2', '1522392008', 0.00, NULL, 0.00, 'Assad’s');
INSERT INTO `payrecord` VALUES (419, 70, '1', '1522392008', 0.00, NULL, 0.00, 'Assad’s');
INSERT INTO `payrecord` VALUES (420, 99, '2', '1522399451', 0.00, NULL, 0.00, '330测试直播基础');
INSERT INTO `payrecord` VALUES (421, 115, '1', '1522399451', 0.00, NULL, 0.00, '330测试直播基础');
INSERT INTO `payrecord` VALUES (422, 99, '2', '1522634291', 0.00, NULL, 0.00, '42测试视频求职');
INSERT INTO `payrecord` VALUES (423, 115, '1', '1522634291', 0.00, NULL, 0.00, '42测试视频求职');
INSERT INTO `payrecord` VALUES (424, 6, '1', '1522650796', 1.00, NULL, 0.00, '平台充值');
INSERT INTO `payrecord` VALUES (425, 115, '2', '1522653369', 0.00, NULL, 0.00, '测试3.26');
INSERT INTO `payrecord` VALUES (426, 99, '1', '1522653369', 0.00, NULL, 0.00, '测试3.26');
INSERT INTO `payrecord` VALUES (427, 115, '2', '1522654038', 0.00, NULL, 0.00, '42测试直播1');
INSERT INTO `payrecord` VALUES (428, 99, '1', '1522654038', 0.00, NULL, 0.00, '42测试直播1');
INSERT INTO `payrecord` VALUES (429, 99, '1', '1522724166', 1.00, NULL, 0.00, '兑换约课币');
INSERT INTO `payrecord` VALUES (430, 99, '2', '1522733463', 0.00, NULL, 6.00, '323视频文化');
INSERT INTO `payrecord` VALUES (431, 117, '1', '1522733463', 6.00, NULL, 0.00, '323视频文化');
INSERT INTO `payrecord` VALUES (432, 131, '2', '1522736113', 0.00, NULL, 0.00, 'Assad’s');
INSERT INTO `payrecord` VALUES (433, 70, '1', '1522736113', 0.00, NULL, 0.00, 'Assad’s');
INSERT INTO `payrecord` VALUES (434, 6, '1', '1522741350', 1.00, NULL, 0.00, '平台充值');
INSERT INTO `payrecord` VALUES (435, 6, '1', '1522741353', 1.00, NULL, 0.00, '平台充值');
INSERT INTO `payrecord` VALUES (436, 53, '1', '1522743356', 0.01, NULL, 0.00, '平台充值');
INSERT INTO `payrecord` VALUES (437, 53, '1', '1522743370', 0.01, NULL, 0.00, '平台充值');
INSERT INTO `payrecord` VALUES (438, 115, '1', '1522743554', 1.00, NULL, 0.00, '平台充值');
INSERT INTO `payrecord` VALUES (439, 53, '1', '1522743628', 0.01, NULL, 0.00, '平台充值');
INSERT INTO `payrecord` VALUES (440, 70, '1', '1522743822', 1.00, NULL, 0.00, '平台充值');

-- ----------------------------
-- Table structure for payvideo
-- ----------------------------
DROP TABLE IF EXISTS `payvideo`;
CREATE TABLE `payvideo`  (
  `payvideo_id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '购买的用户id',
  `video_id` int(11) NOT NULL COMMENT '视频id',
  `time` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '购买时间',
  `status` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '0' COMMENT '是否学习  0：未学习 ，1：已学习',
  PRIMARY KEY (`payvideo_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 171 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of payvideo
-- ----------------------------
INSERT INTO `payvideo` VALUES (152, 115, 131, '1522215756', '1');
INSERT INTO `payvideo` VALUES (151, 99, 90, '1522208452', '1');
INSERT INTO `payvideo` VALUES (150, 37, 122, '1522141160', '0');
INSERT INTO `payvideo` VALUES (149, 99, 122, '1522140761', '1');
INSERT INTO `payvideo` VALUES (148, 37, 125, '1522140301', '1');
INSERT INTO `payvideo` VALUES (147, 37, 109, '1522140265', '1');
INSERT INTO `payvideo` VALUES (146, 37, 102, '1522140226', '1');
INSERT INTO `payvideo` VALUES (145, 37, 111, '1522134597', '1');
INSERT INTO `payvideo` VALUES (144, 115, 125, '1522131700', '1');
INSERT INTO `payvideo` VALUES (143, 30, 124, '1522113566', '1');
INSERT INTO `payvideo` VALUES (142, 30, 123, '1522113450', '1');
INSERT INTO `payvideo` VALUES (141, 30, 119, '1522113351', '1');
INSERT INTO `payvideo` VALUES (140, 30, 126, '1522113315', '0');
INSERT INTO `payvideo` VALUES (139, 30, 125, '1522113277', '0');
INSERT INTO `payvideo` VALUES (138, 30, 120, '1522113243', '0');
INSERT INTO `payvideo` VALUES (137, 30, 122, '1522113204', '0');
INSERT INTO `payvideo` VALUES (136, 30, 121, '1522113164', '0');
INSERT INTO `payvideo` VALUES (135, 30, 118, '1522113117', '1');
INSERT INTO `payvideo` VALUES (134, 99, 102, '1522055603', '1');
INSERT INTO `payvideo` VALUES (133, 122, 98, '1522048943', '0');
INSERT INTO `payvideo` VALUES (132, 37, 97, '1522029835', '1');
INSERT INTO `payvideo` VALUES (131, 37, 98, '1522029827', '1');
INSERT INTO `payvideo` VALUES (130, 37, 106, '1522029821', '1');
INSERT INTO `payvideo` VALUES (127, 117, 97, '1521796516', '1');
INSERT INTO `payvideo` VALUES (126, 115, 96, '1521787556', '1');
INSERT INTO `payvideo` VALUES (125, 120, 98, '1521776850', '1');
INSERT INTO `payvideo` VALUES (124, 120, 106, '1521776631', '1');
INSERT INTO `payvideo` VALUES (123, 109, 108, '1521776187', '1');
INSERT INTO `payvideo` VALUES (122, 118, 98, '1521694440', '1');
INSERT INTO `payvideo` VALUES (121, 118, 108, '1521694416', '1');
INSERT INTO `payvideo` VALUES (120, 118, 97, '1521694379', '1');
INSERT INTO `payvideo` VALUES (119, 53, 112, '1521690714', '1');
INSERT INTO `payvideo` VALUES (118, 53, 109, '1521690550', '1');
INSERT INTO `payvideo` VALUES (129, 37, 108, '1522029812', '1');
INSERT INTO `payvideo` VALUES (116, 117, 111, '1521686632', '1');
INSERT INTO `payvideo` VALUES (115, 53, 111, '1521686503', '1');
INSERT INTO `payvideo` VALUES (114, 118, 106, '1521681163', '1');
INSERT INTO `payvideo` VALUES (113, 117, 109, '1521603894', '1');
INSERT INTO `payvideo` VALUES (112, 115, 109, '1521601390', '1');
INSERT INTO `payvideo` VALUES (111, 115, 108, '1521531433', '1');
INSERT INTO `payvideo` VALUES (110, 100, 108, '1521531005', '0');
INSERT INTO `payvideo` VALUES (109, 115, 98, '1521524602', '1');
INSERT INTO `payvideo` VALUES (96, 30, 98, '1521168410', '1');
INSERT INTO `payvideo` VALUES (91, 100, 98, '1521167899', '0');
INSERT INTO `payvideo` VALUES (90, 111, 97, '1521167788', '1');
INSERT INTO `payvideo` VALUES (89, 100, 97, '1521167688', '0');
INSERT INTO `payvideo` VALUES (88, 49, 97, '1521167215', '0');
INSERT INTO `payvideo` VALUES (105, 101, 98, '1521429945', '1');
INSERT INTO `payvideo` VALUES (104, 101, 102, '1521429887', '1');
INSERT INTO `payvideo` VALUES (103, 111, 98, '1521429559', '0');
INSERT INTO `payvideo` VALUES (102, 111, 102, '1521429322', '0');
INSERT INTO `payvideo` VALUES (101, 53, 106, '1521192979', '1');
INSERT INTO `payvideo` VALUES (100, 111, 106, '1521192830', '1');
INSERT INTO `payvideo` VALUES (99, 70, 106, '1521192759', '1');
INSERT INTO `payvideo` VALUES (108, 115, 97, '1521524552', '1');
INSERT INTO `payvideo` VALUES (98, 30, 106, '1521192616', '0');
INSERT INTO `payvideo` VALUES (97, 70, 97, '1521186086', '1');
INSERT INTO `payvideo` VALUES (107, 115, 106, '1521516670', '1');
INSERT INTO `payvideo` VALUES (106, 115, 102, '1521516017', '1');
INSERT INTO `payvideo` VALUES (153, 117, 130, '1522216513', '1');
INSERT INTO `payvideo` VALUES (154, 99, 127, '1522289852', '1');
INSERT INTO `payvideo` VALUES (155, 30, 102, '1522309211', '0');
INSERT INTO `payvideo` VALUES (156, 99, 140, '1522313194', '1');
INSERT INTO `payvideo` VALUES (157, 117, 140, '1522313194', '1');
INSERT INTO `payvideo` VALUES (158, 129, 98, '1522391788', '0');
INSERT INTO `payvideo` VALUES (159, 99, 113, '1522392008', '1');
INSERT INTO `payvideo` VALUES (160, 115, 119, '1522397885', '1');
INSERT INTO `payvideo` VALUES (161, 130, 98, '1522630087', '0');
INSERT INTO `payvideo` VALUES (162, 99, 128, '1522633595', '1');
INSERT INTO `payvideo` VALUES (163, 99, 141, '1522634291', '1');
INSERT INTO `payvideo` VALUES (164, 99, 142, '1522635223', '1');
INSERT INTO `payvideo` VALUES (165, 99, 144, '1522637913', '1');
INSERT INTO `payvideo` VALUES (166, 115, 129, '1522653369', '1');
INSERT INTO `payvideo` VALUES (167, 99, 117, '1522733462', '0');
INSERT INTO `payvideo` VALUES (168, 83, 98, '1522734622', '0');
INSERT INTO `payvideo` VALUES (169, 131, 113, '1522736113', '1');
INSERT INTO `payvideo` VALUES (170, 99, 125, '1522740556', '0');

-- ----------------------------
-- Table structure for prove
-- ----------------------------
DROP TABLE IF EXISTS `prove`;
CREATE TABLE `prove`  (
  `prove_id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '用户id',
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '姓名',
  `cardnum` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '省份证号',
  `photofront` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '身份证正面照片 ',
  `photoback` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '身份证反面照片',
  `photohold` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '手持身份证照片',
  `photocertify` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '资质证明照片',
  `status` char(1) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0' COMMENT '状态    0：待处理   1：通过   2：不通过 ',
  `opinion` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `classimg` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `time` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `reportnum` int(11) DEFAULT NULL COMMENT '被举报次数',
  `cate_id` int(11) NOT NULL COMMENT '分类id',
  PRIMARY KEY (`prove_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 94 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of prove
-- ----------------------------
INSERT INTO `prove` VALUES (46, 48, '史秀泽', '210211199408102917', '/Uploads/prove/2018-02-06/5a7926607b33c.jpg', '/Uploads/prove/2018-02-06/5a7926607b529.jpg', '/Uploads/prove/2018-02-06/5a7926607b6b6.jpg', '/Uploads/prove/2018-02-06/5a7926607b8a7.jpg', '1', NULL, '', '1517889120', NULL, NULL, 66);
INSERT INTO `prove` VALUES (47, 49, '史秀泽', '210211199408102917', '/Uploads/prove/2018-02-07/5a7a90fdae2f4.jpg', '/Uploads/prove/2018-02-07/5a7a90fdae55c.jpg', '/Uploads/prove/2018-02-07/5a7a90fdae710.jpg', '/Uploads/prove/2018-02-07/5a7a90fdae893.jpg', '1', NULL, '', '1517981949', NULL, NULL, 62);
INSERT INTO `prove` VALUES (2, 21, 'test', '5435345345', '/Uploads/prove/2017-11-01/59f92ca6d6a5e.jpg', '/Uploads/prove/2017-11-01/59f92ca6d81ce.jpg', '/Uploads/prove/2017-11-01/59f92ca6d9d27.jpg', '/Uploads/prove/2017-11-01/59f92ca6db87f.jpg', '2', '8585858', '/Uploads/prove/2017-11-01/59f92ca6dcff0.jpg', '1509502118', '18804136644', NULL, 0);
INSERT INTO `prove` VALUES (4, 22, 'tytyt', '12', '/Uploads/prove/', '/Uploads/prove/2017-11-01/59f94510d4145.jpg', '/Uploads/prove/2017-11-01/59f94510d58b5.jpg', '/Uploads/prove/2017-11-01/59f94510d7026.jpg', '1', '', '/Uploads/prove/2017-11-01/59f94510d8796.jpg', '1509508368', '12123123', NULL, 0);
INSERT INTO `prove` VALUES (28, 23, '2', '211303888888888888', '/Uploads/prove/2018-01-09/5a542a278ab24.jpeg', '/Uploads/prove/2018-01-09/5a542a278b6dc.jpeg', '/Uploads/prove/2018-01-09/5a542a278beac.jpeg', '/Uploads/prove/2018-01-09/5a542a278c67c.jpeg', '1', '', '', '1515465255', NULL, NULL, 6);
INSERT INTO `prove` VALUES (22, 21, '13', '210881199006101235', '/Uploads/prove/2017-11-21/5a13d7173185b.jpg', '/Uploads/prove/2017-11-21/5a13d71732413.jpg', '/Uploads/prove/2017-11-21/5a13d71732be3.jpg', '/Uploads/prove/2017-11-21/5a13d71733b83.jpg', '0', '', '', '1511249687', NULL, NULL, 7);
INSERT INTO `prove` VALUES (32, 35, '哈哈', '211303199302120066', '/Uploads/prove/2018-01-17/5a5edb73a4f10.jpeg', '/Uploads/prove/2018-01-17/5a5edb73a7a08.jpeg', '/Uploads/prove/2018-01-17/5a5edb73a81d8.jpeg', '/Uploads/prove/2018-01-17/5a5edb73a89a8.jpeg', '0', '', '', '1516166003', NULL, NULL, 6);
INSERT INTO `prove` VALUES (24, 28, '测试', '210323199309172275', '/Uploads/prove/2017-12-22/5a3cab746570e.jpg', '/Uploads/prove/2017-12-22/5a3cab7468dbe.jpg', '/Uploads/prove/2017-12-22/5a3cab7469976.jpg', '/Uploads/prove/2017-12-22/5a3cab746a52e.jpg', '0', '', '', '1513925492', NULL, NULL, 6);
INSERT INTO `prove` VALUES (42, 43, '抱紧', '210323199309172275', '/Uploads/prove/2018-01-24/5a6836179b0dc.jpg', '/Uploads/prove/2018-01-24/5a6836179b8ac.jpg', '/Uploads/prove/2018-01-24/5a6836179bc94.jpg', '/Uploads/prove/2018-01-24/5a6836179c464.jpg', '1', NULL, '', '1516779031', NULL, NULL, 8);
INSERT INTO `prove` VALUES (84, 115, '王美丽', '210711198410122252', '/Uploads/prove/2018-03-20/5ab087b94942c.jpeg', '/Uploads/prove/2018-03-20/5ab087b949c7b.jpg', '/Uploads/prove/2018-03-20/5ab087b94a9f7.jpeg', '/Uploads/prove/2018-03-20/5ab087b94b6a2.jpg', '1', NULL, '/Uploads/prove/2018-03-20/5ab087b94bdf5.jpeg', '1521518521', '13600000000', NULL, 2);
INSERT INTO `prove` VALUES (43, 44, 'aaaa', '211322199607163515', '/Uploads/prove/2018-01-24/5a6843228497c.png', '/Uploads/prove/2018-01-24/5a68432284d64.png', '/Uploads/prove/2018-01-24/5a68432285d04.png', '/Uploads/prove/2018-01-24/5a684322860ec.png', '1', NULL, '/Uploads/prove/2018-01-24/5a684322868bc.png', '1516782370', '13513131212', NULL, 2);
INSERT INTO `prove` VALUES (44, 30, '王磊', '212132132132132', '/Uploads/prove/2018-01-24/5a684a4e5c490.png', '/Uploads/prove/2018-01-24/5a684a4e639c0.png', '/Uploads/prove/2018-01-24/5a684a4e64960.png', '/Uploads/prove/2018-01-24/5a684a4e65518.png', '1', NULL, '/Uploads/prove/2018-01-24/5a684a4e664b8.png', '1516784206', '15702431419', NULL, 2);
INSERT INTO `prove` VALUES (41, 40, 'ggjjhgf', '210333199321212212', '/Uploads/prove/2018-01-24/5a682ac63dcac.jpeg', '/Uploads/prove/2018-01-24/5a682ac63e47c.jpeg', '/Uploads/prove/2018-01-24/5a682ac63ec4c.jpeg', '/Uploads/prove/2018-01-24/5a682ac63f804.jpeg', '1', NULL, '', '1516776134', NULL, NULL, 6);
INSERT INTO `prove` VALUES (48, 53, '陈大爷', '211303199302120013', '/Uploads/prove/2018-02-26/5a939ca45e330.jpeg', '/Uploads/prove/2018-02-26/5a939ca45f6d8.jpeg', '/Uploads/prove/2018-02-26/5a939ca45f8ae.jpeg', '/Uploads/prove/2018-02-26/5a939ca45fa61.jpeg', '1', NULL, '', '1519623332', NULL, NULL, 6);
INSERT INTO `prove` VALUES (49, 65, '测试', '245889566895456892', '/Uploads/prove/2018-02-27/5a94ef818a5fd.jpg', '/Uploads/prove/2018-02-27/5a94ef818aaaa.jpg', '/Uploads/prove/2018-02-27/5a94ef818ac94.jpg', '/Uploads/prove/2018-02-27/5a94ef818ae45.jpg', '1', NULL, '/Uploads/prove/2018-02-27/5a94ef818aff4.jpg', '1519710081', '15702431419', NULL, 3);
INSERT INTO `prove` VALUES (50, 61, '史秀泽', '210211199408102917', '/Uploads/prove/2018-02-27/5a9501858352a.jpg', '/Uploads/prove/2018-02-27/5a950185836bc.jpg', '/Uploads/prove/2018-02-27/5a95018583801.jpg', '/Uploads/prove/2018-02-27/5a9501858395e.jpg', '1', NULL, '', '1519714693', NULL, NULL, 42);
INSERT INTO `prove` VALUES (51, 70, '史秀泽', '210211199408102917', '/Uploads/prove/2018-02-27/5a951d33c9143.jpg', '/Uploads/prove/2018-02-27/5a951d33c92dd.jpg', '/Uploads/prove/2018-02-27/5a951d33c941b.jpg', '/Uploads/prove/2018-02-27/5a951d33c956c.jpg', '1', NULL, '', '1519721779', NULL, NULL, 50);
INSERT INTO `prove` VALUES (53, 74, '我问问ww', '210888888888888888', '/Uploads/prove/2018-02-28/5a9640d4812c2.jpeg', '/Uploads/prove/2018-02-28/5a9640d48158e.jpeg', '/Uploads/prove/2018-02-28/5a9640d48192a.jpeg', '/Uploads/prove/2018-02-28/5a9640d481b28.jpeg', '0', NULL, '', '1519796436', NULL, NULL, 6);
INSERT INTO `prove` VALUES (54, 73, '有八哥啊', '210555555555555555', '/Uploads/prove/2018-02-28/5a9641ac500f3.jpeg', '/Uploads/prove/2018-02-28/5a9641ac50394.jpeg', '/Uploads/prove/2018-02-28/5a9641ac505a2.jpeg', '/Uploads/prove/2018-02-28/5a9641ac5073f.jpeg', '0', NULL, '', '1519796652', NULL, NULL, 6);
INSERT INTO `prove` VALUES (55, 76, 'wanglei', '589456859568945821', '/Uploads/prove/2018-02-28/5a967b87adf0e.jpg', '/Uploads/prove/2018-02-28/5a967b87ae254.png', '/Uploads/prove/2018-02-28/5a967b87ae5f9.png', '/Uploads/prove/2018-02-28/5a967b87ae86f.jpg', '1', NULL, '/Uploads/prove/2018-02-28/5a967b87aeb91.png', '1519811463', '15702431419', NULL, 2);
INSERT INTO `prove` VALUES (56, 72, '史秀泽', '210211199408102917', '/Uploads/prove/2018-02-28/5a9686ff363f0.jpg', '/Uploads/prove/2018-02-28/5a9686ff36562.jpg', '/Uploads/prove/2018-02-28/5a9686ff36684.jpg', '/Uploads/prove/2018-02-28/5a9686ff367ae.jpg', '1', NULL, '', '1519814399', NULL, NULL, 51);
INSERT INTO `prove` VALUES (57, 78, '哈哈', '211303199302120033', '/Uploads/prove/2018-02-28/5a9693239656d.jpeg', '/Uploads/prove/2018-02-28/5a9693239679f.jpeg', '/Uploads/prove/2018-02-28/5a96932396916.jpeg', '/Uploads/prove/2018-02-28/5a96932396aa6.jpeg', '1', NULL, '', '1519817507', NULL, NULL, 6);
INSERT INTO `prove` VALUES (58, 82, '果果001', '210711199802035582', '/Uploads/prove/2018-03-05/5a9ca5ec1d991.jpg', '/Uploads/prove/2018-03-05/5a9ca5ec1df87.jpg', '/Uploads/prove/2018-03-05/5a9ca5ec1e385.jpg', '/Uploads/prove/2018-03-05/5a9ca5ec1e5b3.jpg', '1', NULL, '/Uploads/prove/2018-03-05/5a9ca5ec1ea6d.jpg', '1520215532', '13600000000', NULL, 2);
INSERT INTO `prove` VALUES (59, 96, '果果001', '210711199802035582', '/Uploads/prove/2018-03-08/5aa0b516100d0.jpg', '/Uploads/prove/2018-03-08/5aa0b51610536.jpg', '/Uploads/prove/2018-03-08/5aa0b51610c34.jpg', '/Uploads/prove/2018-03-08/5aa0b51612525.jpg', '1', NULL, '/Uploads/prove/2018-03-08/5aa0b516126bf.jpg', '1520481558', '13000000000', NULL, 2);
INSERT INTO `prove` VALUES (60, 95, '55', '210711198610104425', '/Uploads/prove/2018-03-08/5aa0f1f7ea365.jpg', '/Uploads/prove/', '/Uploads/prove/', '/Uploads/prove/', '1', NULL, '/Uploads/prove/2018-03-08/5aa0f1f7ea6a0.jpg', '1520497143', '13600000000', NULL, 0);
INSERT INTO `prove` VALUES (62, 99, 'ceshi果果001', '210711199802035582', '/Uploads/prove/2018-03-09/5aa238ed5c0f7.jpg', '/Uploads/prove/2018-03-09/5aa238ed5d23e.gif', '/Uploads/prove/2018-03-09/5aa238ed5d902.jpg', '/Uploads/prove/2018-03-09/5aa238ed5dbf3.jpg', '1', NULL, '/Uploads/prove/2018-03-09/5aa238ed5e266.jpg', '1520580845', '13600000000', NULL, 5);
INSERT INTO `prove` VALUES (65, 101, '拉拉', '210711198510104428', '/Uploads/prove/2018-03-12/5aa68b0e5fb0a.jpg', '/Uploads/prove/2018-03-12/5aa68b0e5fc7f.jpg', '/Uploads/prove/2018-03-12/5aa68b0e5fdac.jpg', '/Uploads/prove/2018-03-12/5aa68b0e5feea.jpg', '1', NULL, '', '1520864014', NULL, NULL, 15);
INSERT INTO `prove` VALUES (76, 110, '嘉嘉', '210711198510104428', '/Uploads/prove/2018-03-13/5aa7a5ad502c8.jpg', '/Uploads/prove/2018-03-13/5aa7a5ad50442.jpg', '/Uploads/prove/2018-03-13/5aa7a5ad50571.jpg', '/Uploads', '2', '个地方官的分电饭锅电饭锅的故事大富大贵个电饭锅电饭锅的个地方官的收费个地方官的分格式的风格的风格大富大贵', '', '1520936365', '', NULL, 63);
INSERT INTO `prove` VALUES (90, 37, 'shixiuze', '210211199408102917', '/Uploads/prove/2018-03-23/5ab471a6760fd.jpg', '/Uploads/prove/2018-03-23/5ab471a676465.jpg', '/Uploads/prove/2018-03-23/5ab471a676752.jpg', '/Uploads/prove/2018-03-23/5ab471a676a35.jpg', '2', '55555', '', '1521775014', '17640199694', NULL, 16);
INSERT INTO `prove` VALUES (83, 6, '彭亚通', '211322199607163515', '/ddd', '/ddd', '/ddd', '/ddd', '1', NULL, '', '1520998050', '13804976190', NULL, 6);
INSERT INTO `prove` VALUES (82, 111, '果果', '210711198611124438', '/Uploads/prove/2018-03-14/5aa896a203a21.jpeg', '/Uploads/prove/2018-03-14/5aa896a203c2f.jpeg', '/Uploads/prove/2018-03-14/5aa896a203dc3.jpeg', '/Uploads', '1', NULL, '', '1520998050', '13610813125', NULL, 35);
INSERT INTO `prove` VALUES (85, 59, '解放军附加费', '211303199302120099', '/Uploads/prove/2018-03-20/5ab0b4bd21d35.jpeg', '/Uploads/prove/2018-03-20/5ab0b4bd22027.jpeg', '/Uploads/prove/2018-03-20/5ab0b4bd2228b.jpeg', '/Uploads', '1', NULL, '', '1521530045', NULL, NULL, 6);
INSERT INTO `prove` VALUES (86, 117, '阚亮', '210711198510104428', '/Uploads/prove/2018-03-21/5ab20979e8ffb.jpg', '/Uploads/prove/2018-03-21/5ab20979e931e.jpg', '/Uploads/prove/2018-03-21/5ab20979e9581.jpg', '/Uploads/prove/2018-03-21/5ab20979e9794.jpg', '1', NULL, '', '1521617273', NULL, NULL, 54);
INSERT INTO `prove` VALUES (87, 100, 'iujyhgfcbvnmjhkliuygjfh', '210211199408102917', '/Uploads/prove/2018-03-21/5ab22834b981d.jpg', '/Uploads/prove/2018-03-21/5ab22834b9ac4.jpg', '/Uploads/prove/2018-03-21/5ab22834b9ce7.jpg', '/Uploads/prove/2018-03-21/5ab22834b9f1e.jpg', '1', NULL, '', '1521625140', NULL, NULL, 58);
INSERT INTO `prove` VALUES (92, 97, '金特高级老师', '210811199602051210', '/Uploads/prove/2018-03-29/5abc41c3cec17.jpg', '/Uploads/prove/2018-03-29/5abc41c3cf15f.jpg', '/Uploads/prove/2018-03-29/5abc41c3cf98e.jpg', '/Uploads/prove/', '1', NULL, '/Uploads/prove/2018-03-29/5abc41c3cfd8b.jpg', '1522287043', '13212562365', NULL, 2);
INSERT INTO `prove` VALUES (89, 119, 'ios测试', '211322282833888888', '/Uploads/prove/2018-03-23/5ab451b223094.jpg', '/Uploads/prove/2018-03-23/5ab451b2233bd.jpg', '/Uploads/prove/2018-03-23/5ab451b223625.jpg', '/Uploads/prove/2018-03-23/5ab451b223860.jpg', '1', NULL, '', '1521766834', NULL, NULL, 7);
INSERT INTO `prove` VALUES (91, 109, '陈晓', '210711198510104428', '/Uploads/prove/2018-03-26/5ab895f57edbd.jpg', '/Uploads/prove/2018-03-26/5ab895f57f120.jpg', '/Uploads/prove/2018-03-26/5ab895f57f3fa.jpg', '/Uploads', '2', '就是不通过', '', '1522046453', '125', NULL, 60);
INSERT INTO `prove` VALUES (93, 129, '张三', '123456789012345678', '/Uploads/prove/2018-04-03/5ac2ee6507bf3.jpg', '/Uploads/prove/2018-04-03/5ac2ee6508083.jpg', '/Uploads/prove/2018-04-03/5ac2ee650843a.jpg', '/Uploads/prove/2018-04-03/5ac2ee650879e.jpg', '0', NULL, '/Uploads/prove/2018-04-03/5ac2ee6508b0f.jpg', '1522724453', '13345666666', NULL, 2);

-- ----------------------------
-- Table structure for report
-- ----------------------------
DROP TABLE IF EXISTS `report`;
CREATE TABLE `report`  (
  `report_id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '用户id',
  `cate` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '类别',
  `text` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '内容',
  `img` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '截图',
  `contact` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '' COMMENT '联系方式',
  `time` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '时间',
  `status` char(1) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '0' COMMENT '状态    0：未处理  1：已处理  ',
  `remark` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '' COMMENT '备注',
  `processtype` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '' COMMENT '处理类型  ',
  `teacher_id` int(11) NOT NULL COMMENT 'l老师id',
  PRIMARY KEY (`report_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 58 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of report
-- ----------------------------
INSERT INTO `report` VALUES (1, 2, '反动内容', '反动内容反动内容反动内容反动内容反动内容反动内容反动内容反动内容', '/Uploads/good/2018-02-27/5a94cb0fce5b0.jpg', '12312313', '12313212', '1', 'ffffff', '封号', 1);
INSERT INTO `report` VALUES (2, 2, '色情内容', '色情内容', NULL, '456456', '45456456', '1', 'nbk', '警告', 1);
INSERT INTO `report` VALUES (3, 3, '测试数据', '试数据试数据试数据试数据试数据试数据', NULL, '789789', '789789', '1', NULL, NULL, 1);
INSERT INTO `report` VALUES (4, 2, 'h', 'h', NULL, '1221221', '4554155', '1', '222', '封号', 1);
INSERT INTO `report` VALUES (34, 30, '低俗色情,未授权盗播,非法行为,', '5555555555555555555555555555555', '/Uploads/teacher_report/2018-03-05/5a9d0c34b9e86.jpg', '15702431419', '1520241716', '0', '', '', 1);
INSERT INTO `report` VALUES (37, 30, NULL, '', '/Uploads/teacher_report/2018-03-05/5a9d0dd8b5544.jpg', '', '1520242136', '0', '', '', 2);
INSERT INTO `report` VALUES (32, 53, '非法行为 ', '这是什么', '', '', '1519955901', '0', '', '', 6);
INSERT INTO `report` VALUES (33, 30, '低俗色情,非法行为,', '56656565444444444444444444', '/Uploads/teacher_report/2018-03-05/5a9d0bf9c1633.jpg', '15702431419', '1520241657', '0', '', '', 1);
INSERT INTO `report` VALUES (38, 96, NULL, '的防守打法收费的', '/Uploads/teacher_report/2018-03-08/5aa0d48b0b137.jpg', '13000000000', '1520489611', '0', '', '', 2);
INSERT INTO `report` VALUES (39, 6, '非法行为', '时代峻峰郭经理肯定发港囧热狗机', '', '135456132165', '1520495119', '0', '', '', 6);
INSERT INTO `report` VALUES (40, 110, '透露联系方式', '以后恍恍惚惚恍恍惚惚哈哈', '/Uploads', '13612345678', '1520930746', '0', '', '', 19);
INSERT INTO `report` VALUES (41, 111, '其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 ', '爸爸财路起来来', '', '', '1521005905', '0', '', '', 111);
INSERT INTO `report` VALUES (42, 111, '其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 ', '爸爸财路起来来', '', '', '1521005905', '0', '', '', 111);
INSERT INTO `report` VALUES (43, 111, '其他 其他 其他 ', '爸爸财路起来来', '', '', '1521005905', '0', '', '', 111);
INSERT INTO `report` VALUES (44, 111, '其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 ', '爸爸财路起来来', '', '', '1521005905', '0', '', '', 111);
INSERT INTO `report` VALUES (45, 111, '其他 其他 其他 其他 其他 其他 ', '爸爸财路起来来', '', '', '1521005905', '0', '', '', 111);
INSERT INTO `report` VALUES (46, 111, '其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 ', '爸爸财路起来来', '', '', '1521005905', '0', '', '', 111);
INSERT INTO `report` VALUES (47, 111, '其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 ', '爸爸财路起来来', '', '', '1521005905', '0', '', '', 111);
INSERT INTO `report` VALUES (48, 111, '其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 ', '爸爸财路起来来', '', '', '1521005905', '0', '', '', 111);
INSERT INTO `report` VALUES (49, 111, '其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 ', '爸爸财路起来来', '', '', '1521005905', '0', '', '', 111);
INSERT INTO `report` VALUES (50, 111, '其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 其他 ', '爸爸财路起来来', '', '', '1521005905', '0', '', '', 111);
INSERT INTO `report` VALUES (51, 111, '黑屏(卡顿) 其他 黑屏(卡顿) 其他 黑屏(卡顿) 其他 ', '阿拉巴', '', '', '1521005920', '0', '', '', 111);
INSERT INTO `report` VALUES (52, 99, '透漏联系方式,', 'fsdfsdfdf', '/Uploads/teacher_report/2018-03-21/5ab1ad1812546.jpg', '13610856523', '1521593624', '0', '', '', 0);
INSERT INTO `report` VALUES (53, 115, '黑屏(卡顿)', '哈哈哈哈哈哈h', '/Uploads', '13456780000', '1521604862', '0', '', '', 99);
INSERT INTO `report` VALUES (54, 117, '透漏联系方式 透漏联系方式 透漏联系方式 透漏联系方式 透漏联系方式 ', '咯可口可乐了看看', '', '', '1521686018', '0', '', '', 117);
INSERT INTO `report` VALUES (55, 117, '非法行为 ', '5级路如图你考虑时间进的家里冷路', '', '', '1521687490', '0', '', '', 117);
INSERT INTO `report` VALUES (56, 115, '其他 ', '内容不合法', '/Uploads/teacher_report/2018-03-27/5ab9f55e6d679.jpeg', '', '1522136414', '0', '', '', 115);
INSERT INTO `report` VALUES (57, 99, '透漏联系方式,', '透露联系方式', '/Uploads/teacher_report/2018-04-03/5ac31c4073523.jpg', '13225696523', '1522736192', '0', '', '', 0);

-- ----------------------------
-- Table structure for rnotice
-- ----------------------------
DROP TABLE IF EXISTS `rnotice`;
CREATE TABLE `rnotice`  (
  `rnotice_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '内容',
  `url` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '跳转地址',
  `time` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '添加时间',
  `img` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '图片',
  PRIMARY KEY (`rnotice_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of rnotice
-- ----------------------------
INSERT INTO `rnotice` VALUES (1, '双11大折扣快来抢购啊', 'http://www.baidu.com', '1508125656', '/Uploads/rnotice/1.png');
INSERT INTO `rnotice` VALUES (2, '用户王**购买了小学英语第一节课程', 'http://www.baidu.com', '1508125712', NULL);

-- ----------------------------
-- Table structure for search
-- ----------------------------
DROP TABLE IF EXISTS `search`;
CREATE TABLE `search`  (
  `search_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '搜索内容',
  `number` int(11) DEFAULT 0 COMMENT '搜索次数',
  PRIMARY KEY (`search_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 116 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of search
-- ----------------------------
INSERT INTO `search` VALUES (1, '小葵花', 25);
INSERT INTO `search` VALUES (2, '测试', 460);
INSERT INTO `search` VALUES (3, '哈哈', 50);
INSERT INTO `search` VALUES (4, '英语', 20);
INSERT INTO `search` VALUES (5, '数学', 5);
INSERT INTO `search` VALUES (6, '小葵', 19);
INSERT INTO `search` VALUES (7, 'JavaScript', 4);
INSERT INTO `search` VALUES (8, '啦啦啦', 2);
INSERT INTO `search` VALUES (9, '哈哈哈', 6);
INSERT INTO `search` VALUES (10, '直播', 2);
INSERT INTO `search` VALUES (11, '一年级', 1);
INSERT INTO `search` VALUES (12, '老师', 1);
INSERT INTO `search` VALUES (13, '在一起', 1);
INSERT INTO `search` VALUES (14, '是不是', 1);
INSERT INTO `search` VALUES (15, 'Loop ', 1);
INSERT INTO `search` VALUES (16, 'Cheshire', 1);
INSERT INTO `search` VALUES (17, '哦', 4);
INSERT INTO `search` VALUES (18, '农村', 4);
INSERT INTO `search` VALUES (19, '在这', 1);
INSERT INTO `search` VALUES (20, '是不是因为他', 1);
INSERT INTO `search` VALUES (21, '是不是因为他有一个小', 1);
INSERT INTO `search` VALUES (22, '农', 1);
INSERT INTO `search` VALUES (23, '小', 1);
INSERT INTO `search` VALUES (24, '你够', 1);
INSERT INTO `search` VALUES (25, '啦啦', 1);
INSERT INTO `search` VALUES (26, 'jk', 1);
INSERT INTO `search` VALUES (27, 'ywu', 1);
INSERT INTO `search` VALUES (28, 'the', 4);
INSERT INTO `search` VALUES (29, 'You', 1);
INSERT INTO `search` VALUES (30, 'wu', 1);
INSERT INTO `search` VALUES (31, '666', 7);
INSERT INTO `search` VALUES (32, '地', 2);
INSERT INTO `search` VALUES (33, '132', 6);
INSERT INTO `search` VALUES (34, '陈大爷', 3);
INSERT INTO `search` VALUES (35, '安卓', 1);
INSERT INTO `search` VALUES (36, '这是', 4);
INSERT INTO `search` VALUES (37, '2018', 3);
INSERT INTO `search` VALUES (38, '233333', 1);
INSERT INTO `search` VALUES (39, '好好', 3);
INSERT INTO `search` VALUES (40, '八', 3);
INSERT INTO `search` VALUES (41, '你', 3);
INSERT INTO `search` VALUES (42, '我们', 4);
INSERT INTO `search` VALUES (43, '测试安卓', 1);
INSERT INTO `search` VALUES (44, '陈', 1);
INSERT INTO `search` VALUES (45, '测试adfafsdfsadf', 1);
INSERT INTO `search` VALUES (46, '呵呵', 1);
INSERT INTO `search` VALUES (47, '好', 1);
INSERT INTO `search` VALUES (48, '不过', 1);
INSERT INTO `search` VALUES (49, '分开', 1);
INSERT INTO `search` VALUES (50, '第一', 2);
INSERT INTO `search` VALUES (51, 'hrh', 1);
INSERT INTO `search` VALUES (52, '3.9', 3);
INSERT INTO `search` VALUES (53, '3.12', 32);
INSERT INTO `search` VALUES (54, '3.13', 9);
INSERT INTO `search` VALUES (55, 'mp4', 6);
INSERT INTO `search` VALUES (56, '安', 1);
INSERT INTO `search` VALUES (57, '我', 1);
INSERT INTO `search` VALUES (58, '噢噢噢噢噢噢噢噢噢噢', 1);
INSERT INTO `search` VALUES (59, '红红火火hhh', 2);
INSERT INTO `search` VALUES (60, '123', 1);
INSERT INTO `search` VALUES (61, 'aaaaa', 1);
INSERT INTO `search` VALUES (62, '小学英语', 8);
INSERT INTO `search` VALUES (63, '3.14', 4);
INSERT INTO `search` VALUES (64, '314', 14);
INSERT INTO `search` VALUES (65, '314办公', 2);
INSERT INTO `search` VALUES (66, '高中英语', 1);
INSERT INTO `search` VALUES (67, '早睡早起', 3);
INSERT INTO `search` VALUES (68, '视频', 2);
INSERT INTO `search` VALUES (69, '我是视频', 1);
INSERT INTO `search` VALUES (70, '好好学习', 2);
INSERT INTO `search` VALUES (71, 'a', 1);
INSERT INTO `search` VALUES (72, '镜头', 30);
INSERT INTO `search` VALUES (73, '镜头下的艺术6', 2);
INSERT INTO `search` VALUES (74, '镜头下的艺术7', 2);
INSERT INTO `search` VALUES (75, '镜头下的艺术8', 5);
INSERT INTO `search` VALUES (76, '镜头9', 1);
INSERT INTO `search` VALUES (77, '9', 1);
INSERT INTO `search` VALUES (78, '镜头下的艺术10', 1);
INSERT INTO `search` VALUES (79, '10', 1);
INSERT INTO `search` VALUES (80, '镜头下的艺术一', 1);
INSERT INTO `search` VALUES (81, '一', 1);
INSERT INTO `search` VALUES (82, '镜头下的', 1);
INSERT INTO `search` VALUES (83, '镜头下的*', 2);
INSERT INTO `search` VALUES (84, '3.20', 2);
INSERT INTO `search` VALUES (85, '3.20-', 1);
INSERT INTO `search` VALUES (86, '3.21', 11);
INSERT INTO `search` VALUES (87, '3.22', 13);
INSERT INTO `search` VALUES (88, '吃了自己', 1);
INSERT INTO `search` VALUES (89, '退出', 1);
INSERT INTO `search` VALUES (90, '测试退出', 4);
INSERT INTO `search` VALUES (91, '测试退出房间', 1);
INSERT INTO `search` VALUES (92, '323', 2);
INSERT INTO `search` VALUES (93, '32', 8);
INSERT INTO `search` VALUES (94, 'flv', 2);
INSERT INTO `search` VALUES (95, 'vob', 6);
INSERT INTO `search` VALUES (96, 'wemb', 1);
INSERT INTO `search` VALUES (97, '326测试', 5);
INSERT INTO `search` VALUES (98, '326', 3);
INSERT INTO `search` VALUES (99, 'Doctor', 6);
INSERT INTO `search` VALUES (100, '327', 6);
INSERT INTO `search` VALUES (101, '开个播', 1);
INSERT INTO `search` VALUES (102, '嘻嘻', 1);
INSERT INTO `search` VALUES (103, '3.25', 1);
INSERT INTO `search` VALUES (104, '328', 3);
INSERT INTO `search` VALUES (105, '329', 2);
INSERT INTO `search` VALUES (106, '330', 9);
INSERT INTO `search` VALUES (107, '42', 5);
INSERT INTO `search` VALUES (108, 'iPhone', 1);
INSERT INTO `search` VALUES (109, '历史', 1);
INSERT INTO `search` VALUES (110, '网约课', 1);
INSERT INTO `search` VALUES (111, 'Java开发', 1);
INSERT INTO `search` VALUES (112, '??????', 1);
INSERT INTO `search` VALUES (113, '小学', 1);
INSERT INTO `search` VALUES (114, '小学积极好了', 1);
INSERT INTO `search` VALUES (115, '啦啦啦啦啦', 1);

-- ----------------------------
-- Table structure for shoporder
-- ----------------------------
DROP TABLE IF EXISTS `shoporder`;
CREATE TABLE `shoporder`  (
  `order_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '订单id',
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '商品名',
  `good_id` int(11) NOT NULL COMMENT '商品id',
  `price` decimal(10, 2) NOT NULL COMMENT '价格',
  `num` int(11) NOT NULL COMMENT '数量',
  `status` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '1:待付款 2：待收货3：已收货',
  `uid` int(11) NOT NULL COMMENT '用户id',
  `card` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '订单号',
  PRIMARY KEY (`order_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for sign
-- ----------------------------
DROP TABLE IF EXISTS `sign`;
CREATE TABLE `sign`  (
  `sign_id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '用户id',
  `time` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '签到时间',
  `signday` int(255) UNSIGNED NOT NULL DEFAULT 0 COMMENT '连续签到天数',
  PRIMARY KEY (`sign_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 44 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sign
-- ----------------------------
INSERT INTO `sign` VALUES (1, 6, '1522630626', 1);
INSERT INTO `sign` VALUES (2, 28, '1515725105', 1);
INSERT INTO `sign` VALUES (3, 23, '1515042381', 2);
INSERT INTO `sign` VALUES (4, 76, '1514964365', 1);
INSERT INTO `sign` VALUES (7, 40, '1518319888', 1);
INSERT INTO `sign` VALUES (6, 30, '1522716871', 2);
INSERT INTO `sign` VALUES (8, 43, '1516842218', 2);
INSERT INTO `sign` VALUES (9, 44, '1516781496', 1);
INSERT INTO `sign` VALUES (10, 37, '1522226489', 1);
INSERT INTO `sign` VALUES (11, 48, '1518509315', 2);
INSERT INTO `sign` VALUES (12, 49, '1517987133', 1);
INSERT INTO `sign` VALUES (13, 69, '1519709595', 1);
INSERT INTO `sign` VALUES (14, 70, '1522112152', 1);
INSERT INTO `sign` VALUES (15, 65, '1519789815', 2);
INSERT INTO `sign` VALUES (16, 61, '1519714565', 1);
INSERT INTO `sign` VALUES (17, 58, '1519789336', 2);
INSERT INTO `sign` VALUES (18, 73, '1519778607', 1);
INSERT INTO `sign` VALUES (19, 74, '1520315599', 1);
INSERT INTO `sign` VALUES (20, 53, '1522138568', 3);
INSERT INTO `sign` VALUES (21, 72, '1519815368', 1);
INSERT INTO `sign` VALUES (22, 81, '1520213128', 1);
INSERT INTO `sign` VALUES (23, 83, '1522734670', 1);
INSERT INTO `sign` VALUES (24, 82, '1520322577', 2);
INSERT INTO `sign` VALUES (25, 84, '1520232404', 1);
INSERT INTO `sign` VALUES (26, 96, '1520472266', 1);
INSERT INTO `sign` VALUES (27, 99, '1522724202', 2);
INSERT INTO `sign` VALUES (28, 57, '1520584644', 1);
INSERT INTO `sign` VALUES (29, 97, '1522377927', 2);
INSERT INTO `sign` VALUES (30, 101, '1522205229', 1);
INSERT INTO `sign` VALUES (31, 95, '1520920539', 1);
INSERT INTO `sign` VALUES (32, 110, '1522292640', 2);
INSERT INTO `sign` VALUES (33, 111, '1521795001', 1);
INSERT INTO `sign` VALUES (34, 100, '1521532444', 1);
INSERT INTO `sign` VALUES (35, 115, '1522654467', 1);
INSERT INTO `sign` VALUES (36, 117, '1522379766', 1);
INSERT INTO `sign` VALUES (37, 118, '1522284297', 1);
INSERT INTO `sign` VALUES (38, 120, '1521783510', 1);
INSERT INTO `sign` VALUES (39, 109, '1522046207', 1);
INSERT INTO `sign` VALUES (40, 119, '1522214453', 1);
INSERT INTO `sign` VALUES (41, 128, '1522377620', 1);
INSERT INTO `sign` VALUES (42, 130, '1522735251', 2);
INSERT INTO `sign` VALUES (43, 129, '1522716766', 1);

-- ----------------------------
-- Table structure for standard
-- ----------------------------
DROP TABLE IF EXISTS `standard`;
CREATE TABLE `standard`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0' COMMENT '状态   0：免费  1：收费',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of standard
-- ----------------------------
INSERT INTO `standard` VALUES (1, '0');

-- ----------------------------
-- Table structure for subscribe
-- ----------------------------
DROP TABLE IF EXISTS `subscribe`;
CREATE TABLE `subscribe`  (
  `subscribe_id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '用户id',
  `cid` int(11) NOT NULL COMMENT '课程id',
  `time` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '订阅时间',
  `type` int(255) NOT NULL DEFAULT 0 COMMENT '0:直播 1：视频',
  PRIMARY KEY (`subscribe_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 310 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of subscribe
-- ----------------------------
INSERT INTO `subscribe` VALUES (154, 44, 81, '1516782932', 0);
INSERT INTO `subscribe` VALUES (169, 40, 6, '1517300281', 0);
INSERT INTO `subscribe` VALUES (163, 40, 7, '1517226564', 0);
INSERT INTO `subscribe` VALUES (164, 40, 8, '1517226567', 0);
INSERT INTO `subscribe` VALUES (165, 40, 2, '1517226576', 1);
INSERT INTO `subscribe` VALUES (166, 40, 3, '1517226579', 1);
INSERT INTO `subscribe` VALUES (167, 40, 4, '1517226582', 1);
INSERT INTO `subscribe` VALUES (168, 40, 6, '1517226597', 1);
INSERT INTO `subscribe` VALUES (152, 43, 1, '1516780200', 0);
INSERT INTO `subscribe` VALUES (161, 40, 3, '1517226550', 0);
INSERT INTO `subscribe` VALUES (245, 115, 102, '1521529396', 1);
INSERT INTO `subscribe` VALUES (159, 37, 2, '1516872760', 0);
INSERT INTO `subscribe` VALUES (158, 40, 2, '1516857790', 0);
INSERT INTO `subscribe` VALUES (155, 40, 1, '1516786007', 0);
INSERT INTO `subscribe` VALUES (156, 40, 4, '1516786013', 0);
INSERT INTO `subscribe` VALUES (126, 6, 3, '1516599425', 0);
INSERT INTO `subscribe` VALUES (171, 6, 1, '1518350292', 0);
INSERT INTO `subscribe` VALUES (172, 48, 2, '1518351048', 0);
INSERT INTO `subscribe` VALUES (197, 96, 3, '1520495450', 1);
INSERT INTO `subscribe` VALUES (174, 6, 4, '1518486123', 1);
INSERT INTO `subscribe` VALUES (175, 48, 1, '1518504792', 0);
INSERT INTO `subscribe` VALUES (268, 109, 353, '1522046782', 0);
INSERT INTO `subscribe` VALUES (178, 65, 2, '1519710918', 0);
INSERT INTO `subscribe` VALUES (179, 65, 3, '1519711402', 0);
INSERT INTO `subscribe` VALUES (180, 65, 13, '1519711504', 0);
INSERT INTO `subscribe` VALUES (181, 65, 18, '1519711607', 0);
INSERT INTO `subscribe` VALUES (182, 65, 14, '1519711649', 0);
INSERT INTO `subscribe` VALUES (184, 61, 13, '1519712695', 0);
INSERT INTO `subscribe` VALUES (185, 74, 20, '1519780024', 0);
INSERT INTO `subscribe` VALUES (188, 76, 216, '1519811757', 0);
INSERT INTO `subscribe` VALUES (239, 111, 97, '1521167025', 1);
INSERT INTO `subscribe` VALUES (191, 84, 13, '1520232421', 0);
INSERT INTO `subscribe` VALUES (196, 95, 30, '1520383418', 1);
INSERT INTO `subscribe` VALUES (193, 58, 1, '1520237456', 0);
INSERT INTO `subscribe` VALUES (202, 101, 42, '1520839136', 0);
INSERT INTO `subscribe` VALUES (201, 101, 240, '1520838035', 0);
INSERT INTO `subscribe` VALUES (203, 101, 243, '1520841236', 0);
INSERT INTO `subscribe` VALUES (204, 101, 1, '1520845061', 0);
INSERT INTO `subscribe` VALUES (205, 101, 59, '1520864898', 1);
INSERT INTO `subscribe` VALUES (206, 101, 237, '1520907594', 0);
INSERT INTO `subscribe` VALUES (207, 101, 252, '1520912078', 0);
INSERT INTO `subscribe` VALUES (208, 101, 72, '1520918840', 1);
INSERT INTO `subscribe` VALUES (269, 115, 106, '1522055962', 1);
INSERT INTO `subscribe` VALUES (243, 115, 98, '1521528269', 1);
INSERT INTO `subscribe` VALUES (242, 99, 98, '1521528080', 1);
INSERT INTO `subscribe` VALUES (212, 99, 2, '1520924227', 0);
INSERT INTO `subscribe` VALUES (213, 99, 3, '1520924240', 0);
INSERT INTO `subscribe` VALUES (267, 117, 106, '1522045429', 1);
INSERT INTO `subscribe` VALUES (282, 99, 127, '1522289851', 1);
INSERT INTO `subscribe` VALUES (216, 110, 18, '1520930378', 0);
INSERT INTO `subscribe` VALUES (217, 110, 20, '1520932678', 1);
INSERT INTO `subscribe` VALUES (218, 110, 26, '1520932688', 1);
INSERT INTO `subscribe` VALUES (219, 110, 50, '1520932749', 1);
INSERT INTO `subscribe` VALUES (220, 110, 2, '1520933835', 0);
INSERT INTO `subscribe` VALUES (221, 110, 259, '1520934172', 0);
INSERT INTO `subscribe` VALUES (222, 58, 3, '1520989317', 1);
INSERT INTO `subscribe` VALUES (223, 111, 1, '1520992318', 0);
INSERT INTO `subscribe` VALUES (224, 111, 2, '1520992356', 0);
INSERT INTO `subscribe` VALUES (225, 111, 3, '1520992745', 0);
INSERT INTO `subscribe` VALUES (236, 111, 68, '1521084447', 1);
INSERT INTO `subscribe` VALUES (227, 111, 6, '1520992786', 1);
INSERT INTO `subscribe` VALUES (228, 111, 67, '1520995388', 1);
INSERT INTO `subscribe` VALUES (237, 57, 77, '1521099534', 1);
INSERT INTO `subscribe` VALUES (232, 111, 261, '1520999985', 0);
INSERT INTO `subscribe` VALUES (233, 111, 74, '1521005050', 1);
INSERT INTO `subscribe` VALUES (234, 111, 60, '1521006219', 1);
INSERT INTO `subscribe` VALUES (235, 101, 75, '1521011538', 1);
INSERT INTO `subscribe` VALUES (246, 99, 353, '1521536752', 0);
INSERT INTO `subscribe` VALUES (247, 115, 97, '1521600571', 1);
INSERT INTO `subscribe` VALUES (248, 117, 110, '1521617683', 1);
INSERT INTO `subscribe` VALUES (249, 117, 358, '1521685745', 0);
INSERT INTO `subscribe` VALUES (250, 117, 112, '1521687499', 1);
INSERT INTO `subscribe` VALUES (251, 117, 361, '1521690118', 0);
INSERT INTO `subscribe` VALUES (252, 99, 41, '1521769149', 0);
INSERT INTO `subscribe` VALUES (253, 99, 102, '1521769157', 1);
INSERT INTO `subscribe` VALUES (254, 109, 99, '1521776141', 1);
INSERT INTO `subscribe` VALUES (255, 117, 104, '1521793149', 1);
INSERT INTO `subscribe` VALUES (256, 117, 41, '1521793433', 0);
INSERT INTO `subscribe` VALUES (257, 111, 204, '1521794883', 0);
INSERT INTO `subscribe` VALUES (258, 111, 117, '1521794886', 0);
INSERT INTO `subscribe` VALUES (259, 111, 357, '1521794895', 0);
INSERT INTO `subscribe` VALUES (260, 111, 359, '1521794898', 0);
INSERT INTO `subscribe` VALUES (261, 111, 362, '1521794903', 0);
INSERT INTO `subscribe` VALUES (262, 111, 41, '1521794907', 0);
INSERT INTO `subscribe` VALUES (263, 111, 215, '1521794912', 0);
INSERT INTO `subscribe` VALUES (264, 117, 117, '1521795858', 1);
INSERT INTO `subscribe` VALUES (270, 115, 108, '1522056004', 1);
INSERT INTO `subscribe` VALUES (271, 70, 1, '1522111885', 0);
INSERT INTO `subscribe` VALUES (272, 117, 374, '1522114283', 0);
INSERT INTO `subscribe` VALUES (273, 117, 375, '1522114654', 0);
INSERT INTO `subscribe` VALUES (274, 70, 2, '1522132804', 0);
INSERT INTO `subscribe` VALUES (278, 115, 114, '1522136198', 1);
INSERT INTO `subscribe` VALUES (276, 117, 108, '1522133857', 1);
INSERT INTO `subscribe` VALUES (277, 117, 125, '1522134076', 1);
INSERT INTO `subscribe` VALUES (279, 118, 1, '1522138044', 0);
INSERT INTO `subscribe` VALUES (280, 37, 1, '1522142420', 0);
INSERT INTO `subscribe` VALUES (281, 117, 130, '1522216502', 1);
INSERT INTO `subscribe` VALUES (283, 115, 140, '1522304446', 1);
INSERT INTO `subscribe` VALUES (284, 115, 363, '1522377192', 0);
INSERT INTO `subscribe` VALUES (285, 115, 118, '1522377196', 1);
INSERT INTO `subscribe` VALUES (286, 115, 104, '1522377252', 1);
INSERT INTO `subscribe` VALUES (287, 115, 117, '1522377257', 1);
INSERT INTO `subscribe` VALUES (288, 117, 118, '1522377350', 1);
INSERT INTO `subscribe` VALUES (289, 117, 119, '1522377356', 1);
INSERT INTO `subscribe` VALUES (290, 117, 113, '1522377366', 1);
INSERT INTO `subscribe` VALUES (291, 99, 90, '1522382340', 1);
INSERT INTO `subscribe` VALUES (292, 99, 113, '1522392041', 1);
INSERT INTO `subscribe` VALUES (293, 117, 362, '1522392932', 0);
INSERT INTO `subscribe` VALUES (294, 117, 114, '1522393265', 1);
INSERT INTO `subscribe` VALUES (295, 99, 121, '1522395820', 1);
INSERT INTO `subscribe` VALUES (296, 99, 109, '1522400716', 1);
INSERT INTO `subscribe` VALUES (297, 99, 106, '1522400720', 1);
INSERT INTO `subscribe` VALUES (298, 99, 110, '1522400724', 1);
INSERT INTO `subscribe` VALUES (299, 53, 119, '1522400896', 1);
INSERT INTO `subscribe` VALUES (300, 53, 118, '1522400899', 1);
INSERT INTO `subscribe` VALUES (301, 53, 117, '1522400904', 1);
INSERT INTO `subscribe` VALUES (302, 99, 141, '1522634572', 1);
INSERT INTO `subscribe` VALUES (303, 99, 143, '1522636996', 1);
INSERT INTO `subscribe` VALUES (304, 99, 128, '1522638490', 1);
INSERT INTO `subscribe` VALUES (305, 99, 210, '1522722483', 0);
INSERT INTO `subscribe` VALUES (306, 115, 141, '1522723310', 1);
INSERT INTO `subscribe` VALUES (307, 95, 353, '1522735016', 0);
INSERT INTO `subscribe` VALUES (308, 99, 111, '1522738119', 1);
INSERT INTO `subscribe` VALUES (309, 115, 96, '1522738892', 1);

-- ----------------------------
-- Table structure for teacher
-- ----------------------------
DROP TABLE IF EXISTS `teacher`;
CREATE TABLE `teacher`  (
  `teacher_id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL COMMENT '用户id',
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '姓名',
  `abstract` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '简介',
  `follow` int(11) DEFAULT 0 COMMENT '关注人数',
  `integral` int(11) DEFAULT NULL COMMENT '积分',
  PRIMARY KEY (`teacher_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 40 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of teacher
-- ----------------------------
INSERT INTO `teacher` VALUES (1, 6, '彭亚通', '国内知名教师', 0, 0);
INSERT INTO `teacher` VALUES (18, 30, '王磊', '国内知名教师', 0, NULL);
INSERT INTO `teacher` VALUES (19, 48, '史秀泽', '国内知名教师', 0, NULL);
INSERT INTO `teacher` VALUES (20, 49, '史秀泽', '国内知名教师', 0, NULL);
INSERT INTO `teacher` VALUES (21, 53, '陈大爷', '国内知名教师', 0, NULL);
INSERT INTO `teacher` VALUES (39, 97, '金特高级老师', NULL, 0, NULL);
INSERT INTO `teacher` VALUES (38, 95, '55', NULL, 0, NULL);
INSERT INTO `teacher` VALUES (37, 119, 'ios测试', NULL, 0, NULL);
INSERT INTO `teacher` VALUES (36, 115, '王美丽', NULL, 0, NULL);
INSERT INTO `teacher` VALUES (35, 100, 'iujyhgfcbvnmjhkliuygjfh', NULL, 0, NULL);
INSERT INTO `teacher` VALUES (34, 117, '阚亮', NULL, 0, NULL);
INSERT INTO `teacher` VALUES (33, 59, '解放军附加费', NULL, 0, NULL);

-- ----------------------------
-- Table structure for tixian
-- ----------------------------
DROP TABLE IF EXISTS `tixian`;
CREATE TABLE `tixian`  (
  `tixian_id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `money` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `time` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `pay_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '1:未打款2：已打款',
  PRIMARY KEY (`tixian_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tixian
-- ----------------------------
INSERT INTO `tixian` VALUES (3, 30, '200', '1517620707', 1, 1);
INSERT INTO `tixian` VALUES (4, 30, '200', '1518408433', 10, 1);

-- ----------------------------
-- Table structure for tuisong
-- ----------------------------
DROP TABLE IF EXISTS `tuisong`;
CREATE TABLE `tuisong`  (
  `tuisong_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `num` int(11) DEFAULT NULL COMMENT '推送次数',
  `text` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '内容',
  `time` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '创建时间',
  `status` int(1) DEFAULT 1 COMMENT '1为未推送，2 为已推送',
  PRIMARY KEY (`tuisong_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 12 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tuisong
-- ----------------------------
INSERT INTO `tuisong` VALUES (5, '1321', 121, '21321', '1512701433', 2);
INSERT INTO `tuisong` VALUES (7, '公司都会', 6, 'v55555', '1512705084', 2);
INSERT INTO `tuisong` VALUES (8, '124545454', 0, '内容', '1516252738', 1);
INSERT INTO `tuisong` VALUES (9, '564654654', 0, '54554', '1516253195', 1);
INSERT INTO `tuisong` VALUES (10, '54545454', 0, '刚好风格和大概花费会激发', '1516253327', 1);
INSERT INTO `tuisong` VALUES (11, '545454', 0, '26454', '1516253382', 1);

-- ----------------------------
-- Table structure for type
-- ----------------------------
DROP TABLE IF EXISTS `type`;
CREATE TABLE `type`  (
  `type_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '类别id',
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '类别名',
  PRIMARY KEY (`type_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of type
-- ----------------------------
INSERT INTO `type` VALUES (1, '食品类');
INSERT INTO `type` VALUES (2, '日用品类');
INSERT INTO `type` VALUES (3, '电器类');
INSERT INTO `type` VALUES (4, '饰品类');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `phone` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '' COMMENT '手机号',
  `pass` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '' COMMENT '密码',
  `time` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '注册时间',
  `status` char(1) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0' COMMENT '状态',
  `salt` char(6) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '盐',
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '昵称',
  `token` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'token',
  `login_time` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '' COMMENT '最近一次登录时间',
  `login_num` int(11) DEFAULT 0 COMMENT '累计登录次数',
  `login_type` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '' COMMENT '登录方式',
  `open_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '' COMMENT '用户三方登录的id',
  `cishu` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0' COMMENT '推荐次数',
  PRIMARY KEY (`user_id`) USING BTREE,
  INDEX `token`(`token`) USING BTREE,
  INDEX `user_id`(`user_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 133 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (2, '13084567089', '14e1b600b1fd579f47433b88e8d85291', '1508833108', '1', NULL, 'krcvKjRL', 'b8f1a4596c40d19b19b25b20fdbe48a4', '1514217666', 0, NULL, NULL, '0');
INSERT INTO `user` VALUES (3, '13084567088', '14e1b600b1fd579f47433b88e8d85291', '1514186597', '1', NULL, 'rWTJ0EcR', 'd193d3b5a9e770080516a3d9c028d255', '1514251000', 0, NULL, NULL, '0');
INSERT INTO `user` VALUES (6, '13804976190', '14e1b600b1fd579f47433b88e8d85291', '1446228641', '0', '1', '路鸣泽', '18c602aa0c597bad961c0a5e51b8a55d', '1522724745', 117, NULL, NULL, '0');
INSERT INTO `user` VALUES (12, '13084567011', '14e1b600b1fd579f47433b88e8d85291', '1514250113', '1', NULL, 'U7ALsAMv', 'e659be23e94f1873ac33a77ce8bf00ef', '1514251000', 0, NULL, NULL, '0');
INSERT INTO `user` VALUES (13, '18888888888', '14e1b600b1fd579f47433b88e8d85291', '1514251000', '1', NULL, '美好', 'ac67a54355d9251722f900fae8e82817', '1514251000', 0, NULL, NULL, '0');
INSERT INTO `user` VALUES (14, '18888880000', '14e1b600b1fd579f47433b88e8d85291', '1514044800', '0', NULL, 'ClW7o6Tp', '840a2d97a818581e278d17a02a03cec8', '1514251000', 0, NULL, NULL, '0');
INSERT INTO `user` VALUES (15, '18888881111', '14e1b600b1fd579f47433b88e8d85291', '1514250113', '1', NULL, 'NPoG1DPX', '7557fffd1f232e5aa2d2469beb56d06a', '1514251000', 0, NULL, NULL, '0');
INSERT INTO `user` VALUES (16, '18888882222', '14e1b600b1fd579f47433b88e8d85291', '1514250113', '1', NULL, '3Wm2dOYB', '8474f2b8e5554587d2036765674da972', '1514251000', 0, NULL, NULL, '0');
INSERT INTO `user` VALUES (17, '18812341234', '14e1b600b1fd579f47433b88e8d85291', '1514251000', '1', NULL, 'mvzGM2fo', '96eb4e0f6f1f2feb8a6b472345235033', '1514217666', 0, NULL, NULL, '0');
INSERT INTO `user` VALUES (19, '13664186427', 'e10adc3949ba59abbe56e057f20f883e', '1514186597', '0', NULL, '小西瓜', '57b7fd71d19f4099576c81e0a7c42d5f', '1516331334', 1, NULL, NULL, '0');
INSERT INTO `user` VALUES (20, '18609870487', '14e1b600b1fd579f47433b88e8d85291', '1514186597', '0', NULL, '61Zdc6Sf', '6461fb9e6956e436e6a55caa08a7ac52', '1514186497', 0, NULL, NULL, '0');
INSERT INTO `user` VALUES (22, '13610881305', '14e1b600b1fd579f47433b88e8d85291', '1514380000', '0', NULL, 'w7fVVOQr', 'c072b2c544868a01741d858742677b09', '1514186597', 0, NULL, NULL, '0');
INSERT INTO `user` VALUES (23, '12345678900', '14e1b600b1fd579f47433b88e8d85291', '1520562990', '0', NULL, 'eeeee', 'ertrftretsd23446fgerw643tgfe', '1520819952', 0, '', '', '0');
INSERT INTO `user` VALUES (24, '13664186427', '078967e8e56e5f19b86cc960dce31b9d', '1514217666', '0', '', '小西瓜', '57b7fd71d19f4099576c81e0a7c42d5f', '1514191581', 0, NULL, NULL, '0');
INSERT INTO `user` VALUES (25, '18609870487', '14e1b600b1fd579f47433b88e8d85291', '1514228000', '0', '', '61Zdc6Sf', '6461fb9e6956e436e6a55caa08a7ac52', '1514191481', 0, NULL, NULL, '0');
INSERT INTO `user` VALUES (28, '13610881305', '14e1b600b1fd579f47433b88e8d85291', '1514218569', '0', '', 'w7fVVOQr', 'c072b2c544868a01741d858742677b09', '1514191281', 0, NULL, NULL, '0');
INSERT INTO `user` VALUES (30, '15702431419', 'd477887b0636e5d87f79cc25c99d7dc9', '1520305214', '0', NULL, '网约课', 'd792932a2befd63d832f58966aa7dd3a', '1522740930', 324, NULL, NULL, '4');
INSERT INTO `user` VALUES (37, '18310230890', '9db06bcff9248837f86d1a6bcf41c9e7', '1516329236', '0', NULL, 'lalal', '4a002d3273f4e92e45bddcd77c7acfe2', '1522720159', 75, NULL, NULL, '0');
INSERT INTO `user` VALUES (43, '15026843402', '224cf2b695a5e8ecaecfb9015161fa4b', '1516778752', '0', NULL, '是不是', '46f9603144baf7d17628dd2654e53cab', '1517464008', 7, NULL, NULL, '0');
INSERT INTO `user` VALUES (44, '15734031396', 'e1fdb83bc91abca6368c4afd36a8ce53', '1516781416', '0', NULL, 'haha', 'f1916469add6ab216ea4e25b83a09155', '1516781488', 2, NULL, NULL, '0');
INSERT INTO `user` VALUES (46, '13804976191', '14e1b600b1fd579f47433b88e8d85291', '1516841004', '0', NULL, 'fdfdfdfd', '12312454532432424324342342fdsfdsf', '1516841019', 0, 'vx', '1', '0');
INSERT INTO `user` VALUES (49, '13333333333', 'd477887b0636e5d87f79cc25c99d7dc9', '1517921722', '0', NULL, '美丽的老师', 'd94bfc4513a24778c22e79e74b108f57', '1521169326', 17, NULL, NULL, '0');
INSERT INTO `user` VALUES (50, '', '', '1518079988', '0', NULL, 'xbH0WZbg', 'c8999cbf61c28c26e88e011c0f7208c3', '1518079988', 1, 'qq', '3', '0');
INSERT INTO `user` VALUES (51, '', '', '1518080421', '0', NULL, 'JRYTQbHt', 'a3204d69198e7a9f063c2f227ecc79d7', '1518140172', 3, 'wx', '0', '0');
INSERT INTO `user` VALUES (52, '', '', '1518140408', '0', NULL, 'io56IVue', '695ebd627b1b0530439aeab65a8f397d', '1518144329', 2, 'WEIXIN', '0', '0');
INSERT INTO `user` VALUES (53, '13020336649', 'd496d688fe9bfbe1c550b7c7dad28c17', '1519611893', '0', NULL, '李隆基    还 有', 'c432cb57e83e67a022383ace18938d1b', '1522738546', 189, '', '', '0');
INSERT INTO `user` VALUES (56, '', '', '1519624242', '0', NULL, 'yHoSv3FJ', '12fc6da0ee04ed96adf1c97b09d5103f', '1519624242', 1, 'wx', 'o2T9H1I-clfDr1MVv8RksDODRHi8', '0');
INSERT INTO `user` VALUES (57, '15002436100', '9db06bcff9248837f86d1a6bcf41c9e7', '1519632806', '0', NULL, 'u1FsM79z', 'b2a2ae19594ca833125a9b715092c9a0', '1522299726', 38, '', '', '0');
INSERT INTO `user` VALUES (58, '17640229698', '31f4fa286eb17084f91d7775a79f7f47', '1519691333', '0', NULL, 'HbOLFpNc', 'd25d442242d5fa585b11a9f517d97826', '1522398428', 41, '', '', '0');
INSERT INTO `user` VALUES (59, '', '', '1519695067', '0', NULL, 'oPuCEi8s', '7a0b95c177c03c07094769335d59bb61', '1522125300', 6, 'WEIXIN', 'o1APv1D_T09r6x9o8RZgHl1Ic4N0', '0');
INSERT INTO `user` VALUES (60, '', '', '1519695136', '0', NULL, 'xIgVvbN1', '57d982f33689467835bea471736f3b4a', '1522295139', 2, 'QQ', 'D94F645F4A03D858DC3961599F854F08', '0');
INSERT INTO `user` VALUES (61, '13322222222', '', '1519697733', '0', NULL, 'ixlASwtG', 'c47f8e4878b4f437b7cf7f4d99ae6bc4', '1519724311', 11, 'qq', '56DB627D323142D13C6E3958E85C3F7A', '0');
INSERT INTO `user` VALUES (62, '', '', '1519699345', '0', NULL, 'Xi9ZJrNy', '02e95304e1b3defff8b296fb3df6399c', '1519699345', 1, 'wx', 'o_UX-1N_ry0BmsN7_Kuzec34rulU', '0');
INSERT INTO `user` VALUES (63, '', '', '1519702897', '0', NULL, 'Dx2tgdnz', 'da2c78f088bbccee509d9fe38e0a57bc', '1519702897', 1, 'qq', '3769F9D43E48CC24FA0DA7C79E8A758F', '0');
INSERT INTO `user` VALUES (64, '', '', '1519703184', '0', NULL, 'PJXrjnnB', '192c0b08f01cb1fc3e84ab971d22ea88', '1519703184', 1, 'wx', 'o1APv1PmVZ5mUA3uIZznsqzBwnVY', '0');
INSERT INTO `user` VALUES (65, '15840218130', 'b2fc96bbd588415647343889f9735f47', '1519708965', '0', NULL, '158402老师', '37519cd4d688f077e01664972eff90b2', '1521420828', 32, '', '', '0');
INSERT INTO `user` VALUES (66, '', '', '1519709096', '0', NULL, 'ka6tdnFy', '5bebbcd86f0b858c037d21b3d4c5bf90', '1519709096', 1, 'wx', 'o1APv1JNNGj8G812EpdtRTyBOEbw', '0');
INSERT INTO `user` VALUES (67, '', '', '1519709129', '0', NULL, 'wswpEcnf', '5c29a937acd6b792878e44a80f24cba5', '1519709129', 1, 'qq', 'FB8C8BFAB6697D5913457DBB7819A667', '0');
INSERT INTO `user` VALUES (68, '', '', '1519709585', '0', NULL, 'nWQLuEB5', '6922990650ab84e66cf4fd9e02f68a3e', '1519709585', 1, 'wx', NULL, '0');
INSERT INTO `user` VALUES (69, '', '', '1519709586', '0', NULL, 'zCTNd58B', '933ab03fe688ffde894f42221d455959', '1519709586', 1, 'wx', NULL, '0');
INSERT INTO `user` VALUES (70, '17640199694', '9db06bcff9248837f86d1a6bcf41c9e7', '1519709795', '0', NULL, '爱好研究的老师', '54d128c584ad4c7c50c5854a741b5a1b', '1522734283', 114, '', '', '0');
INSERT INTO `user` VALUES (71, '13311111111', '', '1519710292', '0', NULL, 'owBBwPkS', 'e2bfca874603feda6a13f1ed4e968540', '1519710880', 9, 'wx', 'o_UX-1H16zouHcPb67QRT1pAzi2c', '0');
INSERT INTO `user` VALUES (72, '', '', '1519711815', '0', NULL, 'EioEyugZ', 'ff8795bd8ac4b7bb6046ac5a0a01e986', '1519811113', 2, 'qq', '3F531F71944603987DF8E61193F8F1E4', '0');
INSERT INTO `user` VALUES (73, '', '', '1519730527', '0', NULL, 'jfkzpqwD', '46ba7b3d4f28eb576cfba02101b47f51', '1520414241', 6, 'QQ', 'C7BD4789842F6634926017C979437CC1', '0');
INSERT INTO `user` VALUES (74, '15888888888', '14e1b600b1fd579f47433b88e8d85291', '1519778670', '0', NULL, '158888二号', '1cb634c3eb2a0fb02ede113523f42200', '1520315584', 29, '', '', '0');
INSERT INTO `user` VALUES (75, '', '', '1519779187', '0', NULL, 'Jon81ry7', '4b98cc96a5d77da8da8920959e1a262d', '1519779187', 1, 'WEIXIN', 'o1APv1MEEg9rbJbfEf3V07dhNa5I', '0');
INSERT INTO `user` VALUES (77, '', '', '1519813168', '0', NULL, 'nzxM8mny', '5cee8c41e65f3cc6da73acdc4e1fc450', '1519813168', 1, 'qq', '715C32307E41438BA9BBD8C8FF6BC7B3', '0');
INSERT INTO `user` VALUES (78, '13022449833', '9db06bcff9248837f86d1a6bcf41c9e7', '1519817397', '0', NULL, 'o9FGC1Xi', '105bb176cd3926f4ce217694aa674ec1', '1519817417', 1, '', '', '0');
INSERT INTO `user` VALUES (79, '', '', '1519962569', '0', NULL, '6wj4DSun', 'e0532be2fc08dbc1cf2b05c6b97728bb', '1519962569', 1, 'wx', 'o1APv1BMiV8rZGjqk6DgTXC063Yo', '0');
INSERT INTO `user` VALUES (80, '', '', '1520210175', '0', NULL, 'TW41zQdM', '5317394f17f525204b240157c9de4e63', '1520210175', 1, 'qq', '51BD14B2EABF005BD7E5C619E46B1DBA', '0');
INSERT INTO `user` VALUES (81, '', '', '1520211944', '0', NULL, '8yvVpsdR', 'd8f532fceaec1169765469458aaa5bd3', '1520211944', 1, 'wx', 'o1APv1Hm6IkhUih0NAoRG1V-VViw', '0');
INSERT INTO `user` VALUES (83, '18698670360', 'f00ada1ecf31cc1aa24e6aecb7dbb204', '1520222337', '0', NULL, '客服部-韩毅', 'f4197b6988defb6a0054217c115d2860', '1522734588', 19, '', '', '0');
INSERT INTO `user` VALUES (95, '', '', '1520383161', '0', NULL, 'qp6VxwCU', 'e20aa3122f07152f7263b3af71426528', '1522734970', 2, 'wx', 'o1APv1Izn6M0rymEWG4DwTNb-t1Y', '0');
INSERT INTO `user` VALUES (97, '', '', '1520394791', '0', NULL, '飞翔的马', 'bbdfcf29b576a4c21b04b6a151775b11', '1520394791', 1, 'qq', '7A02A97270A9E98C925A00AE396D3D65', '0');
INSERT INTO `user` VALUES (98, '', '', '1520409818', '0', NULL, 'Gyi0Ubba', '8472e512e9674ad35fc07db85a89751c', '1520409818', 1, 'qq', '7A5A3A072E32F2988543DA86EFEC7A1F', '0');
INSERT INTO `user` VALUES (99, '13610813125', 'd477887b0636e5d87f79cc25c99d7dc9', '1520562990', '0', NULL, '高级教师', '96aa94a979796a87aedb9ac6915bfedb', '1522740295', 258, '', '', '0');
INSERT INTO `user` VALUES (100, '13324098759', 'd477887b0636e5d87f79cc25c99d7dc9', '1520823043', '0', NULL, '我们', '397aa0b057f573ed28dfbf0723a1fb75', '1521683230', 23, '', '', '0');
INSERT INTO `user` VALUES (101, '13610813120', '9db06bcff9248837f86d1a6bcf41c9e7', '1520833503', '0', NULL, '哈哈啊哈哈哈吧哈比吧', 'b4dffcce93e8f65c03b15654c757d42b', '1522205424', 29, '', '', '0');
INSERT INTO `user` VALUES (108, '15555555555', 'd477887b0636e5d87f79cc25c99d7dc9', '1520916799', '0', NULL, '6RibQCH2', '80943800659e518c4743c6b495ca1435', '', 0, '', '', '0');
INSERT INTO `user` VALUES (109, '13610813127', '', '1520929612', '0', NULL, 'ixiFmcvN', '4f02f67cdc4b5dad33ce4db179059b15', '1522380213', 13, 'qq', '4525F6A583B2C4A5F42A6AA1FA871B7A', '0');
INSERT INTO `user` VALUES (110, '13610813121', '68d8210d7c3e5949e0d192aff93afe56', '1520929794', '0', NULL, '哥哥哥哥哥哥哥哥哥哥', 'cdf412d22c897bbd7932332b680441d5', '1522292560', 6, 'wx', 'o_UX-1LXTgPKZ3XDpLT4gSUe8SHQ', '0');
INSERT INTO `user` VALUES (111, '13610813122', '9db06bcff9248837f86d1a6bcf41c9e7', '1520989225', '0', NULL, '红酒', '5bedd8fc6c8b0cf7907208763f42c9a7', '1521795702', 124, '', '', '0');
INSERT INTO `user` VALUES (112, '', '', '1521091304', '0', NULL, 'Z4tKt9mV', '2c2a773bb5fff5826c6b6a7386b056da', '1521091304', 1, 'wx', 'o1APv1Jf5gxSZMkaBOsjBDrhuGq4', '0');
INSERT INTO `user` VALUES (113, '', '', '1521094578', '0', NULL, 'jYLKcEh2', 'b4cace5aed1c1186091e94c216b025aa', '1521094578', 1, 'wx', 'o1APv1BHtdKKC8JCpzhMF6flMjX4', '0');
INSERT INTO `user` VALUES (114, '', '', '1521420361', '0', NULL, 'dmU4DoY0', '5fd8e2cc651c7ffee70d367377ba25da', '1521420361', 1, 'qq', '6D0D1566EAA189C3BA64E2652FADBAA9', '0');
INSERT INTO `user` VALUES (115, '13610813123', 'bc72989abe887d09cf5ed88c1a0795dd', '1521507782', '0', NULL, '金老师', '54712053033460ead20cd470ce6bfc62', '1522742271', 113, '', '', '0');
INSERT INTO `user` VALUES (116, '', '', '1521528456', '0', NULL, 'tDjKQFcf', '488b7444fdfadd49881fa8da0c5b51a2', '1521528456', 1, 'qq', '8483FDF4805A3E0647F9EA4FB8761681', '0');
INSERT INTO `user` VALUES (117, '13610813124', '9db06bcff9248837f86d1a6bcf41c9e7', '1521594814', '0', NULL, '吃了自己腿的跳蚤', '48ea60b5496ca3a7d573e9f4e454fc79', '1522401852', 99, '', '', '0');
INSERT INTO `user` VALUES (118, '18524472216', '44bbd2d47203d5bd6a6875fc3abfc2f9', '1521681147', '0', NULL, '7aatW8zG', 'aa8af13e156e931b4a5a0a9c6c1f20ae', '1522401048', 9, '', '', '0');
INSERT INTO `user` VALUES (119, '13898999999', '24d1b6f6d8adf4ec23838c6a1bc030a7', '1521766232', '0', NULL, 'CUv882sz', '710e47fa402a8e85996e3e2e7872f58c', '1522203290', 7, '', '', '0');
INSERT INTO `user` VALUES (120, '', '', '1521776601', '0', NULL, 'DcgiKWqv', 'ee62e3bbb976e52297a6b69e8c2eae65', '1521776601', 1, 'WEIXIN', 'o1APv1Izn6M0rymEWG4DwTNb-t1Y', '0');
INSERT INTO `user` VALUES (121, '13610813126', '68d8210d7c3e5949e0d192aff93afe56', '1521788535', '0', NULL, 'gJ8AmBf5', '296c924a5d74077be11428ecd7f8b8ec', '1521794685', 2, '', '', '0');
INSERT INTO `user` VALUES (122, '', '', '1522047476', '0', NULL, 'Mpd8BQ0z', '1a436150f6eec395d0ea740018183f69', '1522047476', 1, 'qq', '9A6C4BDDB4C52A9C2B08B0B7F6AF0182', '0');
INSERT INTO `user` VALUES (123, '', '', '1522287722', '0', NULL, 'jJ0Sj9bB', '266211a564e0ef8b241c0f0707401f3e', '1522287722', 1, 'wx', 'o1APv1N1ShviL44YePN3nEoAENxw', '0');
INSERT INTO `user` VALUES (124, '', '', '1522292546', '0', NULL, 'w7lcE6Dq', '9cb44abb34ab1ce91fabf0c3c0340b25', '1522292546', 1, 'wx', NULL, '0');
INSERT INTO `user` VALUES (125, '', '', '1522292549', '0', NULL, '3GSXOHxv', '2ae309f9c76d166103903492301af330', '1522292549', 1, 'wx', NULL, '0');
INSERT INTO `user` VALUES (126, '', '', '1522292550', '0', NULL, 'BrkNuLkH', '48561600157a9c23d6b33f3de4ac67ee', '1522292550', 1, 'wx', NULL, '0');
INSERT INTO `user` VALUES (127, '', '', '1522293122', '0', NULL, 'VyscpfYi', '7df41cad9cf6e74bc27749fb3f6d5460', '1522293122', 1, 'qq', NULL, '0');
INSERT INTO `user` VALUES (128, '13600000000', '', '1522377604', '0', NULL, '哈哈', '53f6c96d902b0769c1c93a7f6eafd5e0', '1522378028', 3, 'qq', 'UID_AF8EE96A6DF2AA015E01C55F2C680113', '0');
INSERT INTO `user` VALUES (129, '18304098490', '18110040c3176a34c0e207cf35ca576d', '1522377692', '0', NULL, 'PgNogdGn', '16b19b4a4029a44f528ef6dbb83f501d', '1522723937', 5, '', '', '0');
INSERT INTO `user` VALUES (130, '15140010718', '485fafd369ec2f21e2cd52f30a032d30', '1522629840', '0', NULL, 'n5IViUtg', 'da6a68a81856164fba5d53758a8258cd', '1522735201', 2, '', '', '0');
INSERT INTO `user` VALUES (131, '', '', '1522735215', '0', NULL, 'GXaFiqmz', 'efc2eb973772c53f80b80bfcfbe7eb94', '1522735215', 1, 'WEIXIN', 'o1APv1MVHRJ1RVHFMPJNdZOXSP-c', '0');
INSERT INTO `user` VALUES (132, '', '', '1522740001', '0', NULL, 'YCuP7I7O', 'f038fc600736ced0942087aa32f8f924', '1522740001', 1, 'qq', '522BA960726C47AE287A472B3C4D1AF2', '0');

-- ----------------------------
-- Table structure for userdata
-- ----------------------------
DROP TABLE IF EXISTS `userdata`;
CREATE TABLE `userdata`  (
  `userdata_id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '用户id',
  `image` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '' COMMENT '头像',
  `sex` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '' COMMENT '性别',
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '' COMMENT '地区',
  `profile` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '' COMMENT '个人简介',
  `money` decimal(8, 2) DEFAULT 0.00 COMMENT '账号余额',
  `paypass` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '支付密码',
  `integral` int(8) NOT NULL DEFAULT 0 COMMENT '积分余额',
  `amount` decimal(8, 2) DEFAULT 0.00 COMMENT '消费金额',
  PRIMARY KEY (`userdata_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 129 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of userdata
-- ----------------------------
INSERT INTO `userdata` VALUES (1, 6, '/Uploads/touxiang/2018-03-05/5a9c9310a58c5.jpg', '男', '北京市-东城区', ' 今天读的是书，明天数的是钱', 902371.00, '63ee451939ed580ef3c4b6f0109d1fd0', 205054, 0.00);
INSERT INTO `userdata` VALUES (2, 7, '/Uploads/touxiang/2017-10-26/59f14bb4122d1.png', '', '', '全国知名全国资深专家，特级教师，全国优秀教师，中国教师报特聘课改专家,以实践注解理念，以案例表达观点，语言风趣幽默，彰显生命体验，触动心灵共鸣，', 1000.00, NULL, 0, 0.00);
INSERT INTO `userdata` VALUES (3, 8, '/Uploads/touxiang/2017-10-26/59f14bb4122d1.png', '', '', '全国知名全国资深专家，特级教师，全国优秀教师，中国教师报特聘课改专家,以实践注解理念，以案例表达观点，语言风趣幽默，彰显生命体验，触动心灵共鸣，', 0.00, NULL, 0, 0.00);
INSERT INTO `userdata` VALUES (4, 9, '/Uploads/touxiang/2017-10-26/59f14bb4122d1.png', '', '', '全国知名全国资深专家，特级教师，全国优秀教师，中国教师报特聘课改专家,以实践注解理念，以案例表达观点，语言风趣幽默，彰显生命体验，触动心灵共鸣，', 0.00, NULL, 0, 0.00);
INSERT INTO `userdata` VALUES (5, 10, '/Uploads/touxiang/2017-10-26/59f14bb4122d1.png', '', '', '全国知名全国资深专家，特级教师，全国优秀教师，中国教师报特聘课改专家,以实践注解理念，以案例表达观点，语言风趣幽默，彰显生命体验，触动心灵共鸣，', 0.00, NULL, 0, 0.00);
INSERT INTO `userdata` VALUES (6, 11, '/Uploads/touxiang/2017-10-26/59f14bb4122d1.png', '', '', '全国知名全国资深专家，特级教师，全国优秀教师，中国教师报特聘课改专家,以实践注解理念，以案例表达观点，语言风趣幽默，彰显生命体验，触动心灵共鸣，', 1000.00, NULL, 0, 0.00);
INSERT INTO `userdata` VALUES (7, 12, '/Uploads/touxiang/2017-10-26/59f14bb4122d1.png', '', '', '全国知名全国资深专家，特级教师，全国优秀教师，中国教师报特聘课改专家,以实践注解理念，以案例表达观点，语言风趣幽默，彰显生命体验，触动心灵共鸣，', 0.00, NULL, 0, 0.00);
INSERT INTO `userdata` VALUES (8, 13, '/Uploads/touxiang/2017-10-30/59f69edc96d49.jpeg', '女', '山西省-晋城市', '全国知名全国资深专家，特级教师，全国优秀教师，中国教师报特聘课改专家,以实践注解理念，以案例表达观点，语言风趣幽默，彰显生命体验，触动心灵共鸣，', 1000.00, NULL, 0, 0.00);
INSERT INTO `userdata` VALUES (9, 14, '/Uploads/touxiang/2017-10-26/59f14bb4122d1.png', '', '', '全国知名全国资深专家，特级教师，全国优秀教师，中国教师报特聘课改专家,以实践注解理念，以案例表达观点，语言风趣幽默，彰显生命体验，触动心灵共鸣，', 0.00, NULL, 0, 0.00);
INSERT INTO `userdata` VALUES (10, 15, '/Uploads/touxiang/2017-10-26/59f14bb4122d1.png', '', '', '全国知名全国资深专家，特级教师，全国优秀教师，中国教师报特聘课改专家,以实践注解理念，以案例表达观点，语言风趣幽默，彰显生命体验，触动心灵共鸣，', 0.00, NULL, 0, 0.00);
INSERT INTO `userdata` VALUES (11, 16, '/Uploads/touxiang/2017-10-26/59f14bb4122d1.png', '', '', '全国知名全国资深专家，特级教师，全国优秀教师，中国教师报特聘课改专家,以实践注解理念，以案例表达观点，语言风趣幽默，彰显生命体验，触动心灵共鸣，', 0.00, NULL, 0, 0.00);
INSERT INTO `userdata` VALUES (12, 17, '/Uploads/touxiang/2017-10-26/59f14bb4122d1.png', '', '', '全国知名全国资深专家，特级教师，全国优秀教师，中国教师报特聘课改专家,以实践注解理念，以案例表达观点，语言风趣幽默，彰显生命体验，触动心灵共鸣，', 0.00, NULL, 0, 0.00);
INSERT INTO `userdata` VALUES (13, 18, '/Uploads/touxiang/2017-10-26/59f14bb4122d1.png', '', '', '全国知名全国资深专家，特级教师，全国优秀教师，中国教师报特聘课改专家,以实践注解理念，以案例表达观点，语言风趣幽默，彰显生命体验，触动心灵共鸣，', 1000.00, NULL, 0, 0.00);
INSERT INTO `userdata` VALUES (14, 19, '/Uploads/touxiang/2017-11-09/5a03ef28d4804.jpeg', '女', '北京市-北京市', '全国知名全国资深专家，特级教师，全国优秀教师，中国教师报特聘课改专家,以实践注解理念，以案例表达观点，语言风趣幽默，彰显生命体验，触动心灵共鸣，', 0.00, NULL, 0, 0.00);
INSERT INTO `userdata` VALUES (15, 20, '/Uploads/touxiang/2017-10-26/59f14bb4122d1.png', '', '', '全国知名全国资深专家，特级教师，全国优秀教师，中国教师报特聘课改专家,以实践注解理念，以案例表达观点，语言风趣幽默，彰显生命体验，触动心灵共鸣，', 0.00, NULL, 0, 0.00);
INSERT INTO `userdata` VALUES (16, 21, '/Uploads/touxiang/2017-12-04/5a24e58edfbb8.jpg', '男', '北京北京', '全国知名全国资深专家，特级教师，全国优秀教师，中国教师报特聘课改专家,以实践注解理念，以案例表达观点，语言风趣幽默，彰显生命体验，触动心灵共鸣，', 0.00, NULL, 0, 0.00);
INSERT INTO `userdata` VALUES (17, 22, '', '', '', '全国知名全国资深专家，特级教师，全国优秀教师，中国教师报特聘课改专家,以实践注解理念，以案例表达观点，语言风趣幽默，彰显生命体验，触动心灵共鸣，', 976.00, '14e1b600b1fd579f47433b88e8d85291', 0, 0.00);
INSERT INTO `userdata` VALUES (18, 23, '/Uploads/touxiang/2017-12-12/5a2f97b216a8a.jpeg', '男', '北京市-北京市', '全国知名全国资深专家，特级教师，全国优秀教师，中国教师报特聘课改专家,以实践注解理念，以案例表达观点，语言风趣幽默，彰显生命体验，触动心灵共鸣，', 75.00, NULL, 15, 0.00);
INSERT INTO `userdata` VALUES (19, 24, '/Uploads/touxiang/2017-11-09/5a03ef28d4804.jpeg', '女', '北京市-北京市', '全国知名全国资深专家，特级教师，全国优秀教师，中国教师报特聘课改专家,以实践注解理念，以案例表达观点，语言风趣幽默，彰显生命体验，触动心灵共鸣，', 0.00, '', 0, 0.00);
INSERT INTO `userdata` VALUES (20, 25, '/Uploads/touxiang/2017-10-26/59f14bb4122d1.png', '', '', '全国知名全国资深专家，特级教师，全国优秀教师，中国教师报特聘课改专家,以实践注解理念，以案例表达观点，语言风趣幽默，彰显生命体验，触动心灵共鸣，', 0.00, '', 0, 0.00);
INSERT INTO `userdata` VALUES (21, 26, '/Uploads/touxiang/2017-12-04/5a24e58edfbb8.jpg', '男', '北京北京', '全国知名全国资深专家，特级教师，全国优秀教师，中国教师报特聘课改专家,以实践注解理念，以案例表达观点，语言风趣幽默，彰显生命体验，触动心灵共鸣，', 0.00, '', 0, 0.00);
INSERT INTO `userdata` VALUES (23, 28, '/Uploads/touxiang/2018-01-18/5a5ffb4d7f83c.jpg', '男', '四川成都', '全国知名全国资深专家，特级教师，全国优秀教师，中国教师报特聘课改专家,以实践注解理念，以案例表达观点，语言风趣幽默，彰显生命体验，触动心灵共鸣，', 0.00, '1c35d113b5a26135a42b680f29e9f401', 25, 0.00);
INSERT INTO `userdata` VALUES (24, 52, '', '', '', '全国知名全国资深专家，特级教师，全国优秀教师，中国教师报特聘课改专家,以实践注解理念，以案例表达观点，语言风趣幽默，彰显生命体验，触动心灵共鸣，', 0.00, NULL, 0, 0.00);
INSERT INTO `userdata` VALUES (26, 76, '', '', '', '全国知名全国资深专家，特级教师，全国优秀教师，中国教师报特聘课改专家,以实践注解理念，以案例表达观点，语言风趣幽默，彰显生命体验，触动心灵共鸣，', 0.00, NULL, 5, 0.00);
INSERT INTO `userdata` VALUES (27, 85, '', '', '', '全国知名全国资深专家，特级教师，全国优秀教师，中国教师报特聘课改专家,以实践注解理念，以案例表达观点，语言风趣幽默，彰显生命体验，触动心灵共鸣，', 0.00, NULL, 0, 0.00);
INSERT INTO `userdata` VALUES (28, 30, '/Uploads/touxiang/2018-03-06/5a9e40f487610.jpg', '女', '辽宁省-沈阳市', '全国知名全国资深专家，特级教师，全国优秀教师，教师报特聘课改专家,以实践注解理念，', 29980.00, '14e1b600b1fd579f47433b88e8d85291', 80025, 0.00);
INSERT INTO `userdata` VALUES (30, 32, '', '', '', '全国知名全国资深专家，特级教师，全国优秀教师，中国教师报特聘课改专家,以实践注解理念，以案例表达观点，语言风趣幽默，彰显生命体验，触动心灵共鸣，', 0.00, NULL, 0, 0.00);
INSERT INTO `userdata` VALUES (31, 33, '/Uploads/touxiang/2018-01-10/5a5566a80add4.jpg', '', '', '全国知名全国资深专家，特级教师，全国优秀教师，中国教师报特聘课改专家,以实践注解理念，以案例表达观点，语言风趣幽默，彰显生命体验，触动心灵共鸣，', 0.00, NULL, 0, 0.00);
INSERT INTO `userdata` VALUES (32, 34, '', '', '', '全国知名全国资深专家，特级教师，全国优秀教师，中国教师报特聘课改专家,以实践注解理念，以案例表达观点，语言风趣幽默，彰显生命体验，触动心灵共鸣，', 0.00, NULL, 0, 0.00);
INSERT INTO `userdata` VALUES (33, 35, '/Uploads/touxiang/1.png', '', '', '全国知名全国资深专家，特级教师，全国优秀教师，中国教师报特聘课改专家,以实践注解理念，以案例表达观点，语言风趣幽默，彰显生命体验，触动心灵共鸣，', 0.00, NULL, 0, 0.00);
INSERT INTO `userdata` VALUES (35, 37, '/Uploads/touxiang/2018-03-23/5ab457c0ca180.jpg', '女', '北京市-北京市', '全国知名全国资深专家，特级教师，全国优秀教师，中国教师报特聘课改专家,以实践注解理念，以案例表达观点，语言风趣幽默，彰显生命体验，触动心灵共鸣，', 9964.00, '9db06bcff9248837f86d1a6bcf41c9e7', 38, 0.00);
INSERT INTO `userdata` VALUES (39, 41, '', '', '', '全国知名全国资深专家，特级教师，全国优秀教师，中国教师报特聘课改专家,以实践注解理念，以案例表达观点，语言风趣幽默，彰显生命体验，触动心灵共鸣，', 0.00, NULL, 0, 0.00);
INSERT INTO `userdata` VALUES (40, 42, '', '', '', '全国知名全国资深专家，特级教师，全国优秀教师，中国教师报特聘课改专家,以实践注解理念，以案例表达观点，语言风趣幽默，彰显生命体验，触动心灵共鸣，', 0.00, NULL, 0, 0.00);
INSERT INTO `userdata` VALUES (41, 43, '/Uploads/touxiang/2018-01-24/5a683e6d710fc.jpg', '男', '福建福州', '全国知名全国资深专家，特级教师，全国优秀教师，中国教师报特聘课改专家,以实践注解理念，以案例表达观点，语言风趣幽默，彰显生命体验，触动心灵共鸣，', 0.00, '14e1b600b1fd579f47433b88e8d85291', 15, 0.00);
INSERT INTO `userdata` VALUES (42, 44, '/Uploads/touxiang/2018-01-24/5a683fad13114.png', '男', '福建省-厦门市', '全国知名全国资深专家，特级教师，全国优秀教师，中国教师报特聘课改专家,以实践注解理念，以案例表达观点，语言风趣幽默，彰显生命体验，触动心灵共鸣，', 0.00, NULL, 5, 0.00);
INSERT INTO `userdata` VALUES (43, 45, '/Uploads/touxiang/1.png', '男', '', '全国知名全国资深专家，特级教师，全国优秀教师，中国教师报特聘课改专家,以实践注解理念，以案例表达观点，语言风趣幽默，彰显生命体验，触动心灵共鸣，', 0.00, '9db06bcff9248837f86d1a6bcf41c9e7', 0, 0.00);
INSERT INTO `userdata` VALUES (44, 47, '/Uploads/touxiang/1.png', '', '', '全国知名全国资深专家，特级教师，全国优秀教师，中国教师报特聘课改专家,以实践注解理念，以案例表达观点，语言风趣幽默，彰显生命体验，触动心灵共鸣，', 0.00, NULL, 0, 0.00);
INSERT INTO `userdata` VALUES (45, 46, '/Uploads/touxiang/1.png', '', '', '全国知名全国资深专家，特级教师，全国优秀教师，中国教师报特聘课改专家,以实践注解理念，以案例表达观点，语言风趣幽默，彰显生命体验，触动心灵共鸣，', 0.00, NULL, 0, 0.00);
INSERT INTO `userdata` VALUES (47, 48, '/Uploads/touxiang/1.png', '', '', '全国知名全国资深专家，特级教师，全国优秀教师，中国教师报特聘课改专家,以实践注解理念，以案例表达观点，语言风趣幽默，彰显生命体验，触动心灵共鸣，', 5.12, '9db06bcff9248837f86d1a6bcf41c9e7', 94, 0.00);
INSERT INTO `userdata` VALUES (48, 49, '/Uploads/touxiang/1.png', '', '', '全国知名全国资深专家，特级教师，全国优秀教师，中国教师报特聘课改专家,以实践注解理念，以案例表达观点，语言风趣幽默，彰显生命体验，触动心灵共鸣，', 1996.00, '9db06bcff9248837f86d1a6bcf41c9e7', 5, 0.00);
INSERT INTO `userdata` VALUES (49, 50, '/Uploads/touxiang/1.png', '', '', '全国知名全国资深专家，特级教师，全国优秀教师，中国教师报特聘课改专家,以实践注解理念，以案例表达观点，语言风趣幽默，彰显生命体验，触动心灵共鸣，', 0.00, NULL, 0, 0.00);
INSERT INTO `userdata` VALUES (50, 51, '/Uploads/touxiang/1.png', '', '', '全国知名全国资深专家，特级教师，全国优秀教师，中国教师报特聘课改专家,以实践注解理念，以案例表达观点，语言风趣幽默，彰显生命体验，触动心灵共鸣，', 0.00, NULL, 0, 0.00);
INSERT INTO `userdata` VALUES (51, 52, '/Uploads/touxiang/1.png', '', '', '全国知名全国资深专家，特级教师，全国优秀教师，中国教师报特聘课改专家,以实践注解理念，以案例表达观点，语言风趣幽默，彰显生命体验，触动心灵共鸣，', 0.00, NULL, 0, 0.00);
INSERT INTO `userdata` VALUES (52, 2, '1111', '', '', '全国知名全国资深专家，特级教师，全国优秀教师，中国教师报特聘课改专家,以实践注解理念，以案例表达观点，语言风趣幽默，彰显生命体验，触动心灵共鸣，', 0.00, '14e1b600b1fd579f47433b88e8d85291', 0, 0.00);
INSERT INTO `userdata` VALUES (53, 53, '/Uploads/touxiang/2018-03-19/5aaf74d7afff2.jpeg', '女', '河北省-石家庄市', '全国知名全国资深专家，特级教师，全国优秀教师，中国教师报特聘课改专家,以实践注解理念，以案例表达观点，语言风趣幽默，彰显生命体验，触动心灵共鸣，', 2106.81, '14e1b600b1fd579f47433b88e8d85291', 676901, 0.00);
INSERT INTO `userdata` VALUES (54, 55, '/Uploads/touxiang/1.png', '', '', '全国知名全国资深专家，特级教师，全国优秀教师，中国教师报特聘课改专家,以实践注解理念，以案例表达观点，语言风趣幽默，彰显生命体验，触动心灵共鸣，', 0.00, NULL, 0, 0.00);
INSERT INTO `userdata` VALUES (55, 56, '/Uploads/touxiang/1.png', '', '', '全国知名全国资深专家，特级教师，全国优秀教师，中国教师报特聘课改专家,以实践注解理念，以案例表达观点，语言风趣幽默，彰显生命体验，触动心灵共鸣，', 0.00, NULL, 0, 0.00);
INSERT INTO `userdata` VALUES (56, 57, '/Uploads/touxiang/2018-03-15/5aaa253fbe1bd.jpg', '男', '北京市-东城区', '全国知名全国资深专家，特级教师，全国优秀教师，中国教师报特聘课改专家,以实践注解理念，以案例表达观点，语言风趣幽默，彰显生命体验，触动心灵共鸣，', 0.00, NULL, 5, 0.00);
INSERT INTO `userdata` VALUES (57, 58, '/Uploads/touxiang/2018-03-26/5ab890e9120e4.png', '', '北京市-东城区', '全国知名全国资深专家，特级教师，全国优秀教师，中国教师报特聘课改专家,以实践注解理念，以案例表达观点，语言风趣幽默，彰显生命体验，触动心灵共鸣，', 0.00, '216a7d506c7ba400586661406d343eda', 15, 0.00);
INSERT INTO `userdata` VALUES (58, 59, '/Uploads/touxiang/1.png', '', '', '全国知名全国资深专家，特级教师，全国优秀教师，中国教师报特聘课改专家,以实践注解理念，以案例表达观点，语言风趣幽默，彰显生命体验，触动心灵共鸣，', 0.00, NULL, 0, 0.00);
INSERT INTO `userdata` VALUES (59, 60, '/Uploads/touxiang/1.png', '', '', '全国知名全国资深专家，特级教师，全国优秀教师，中国教师报特聘课改专家,以实践注解理念，以案例表达观点，语言风趣幽默，彰显生命体验，触动心灵共鸣，', 0.00, NULL, 0, 0.00);
INSERT INTO `userdata` VALUES (60, 61, '/Uploads/touxiang/1.png', '男', '福建福州', '全国知名全国资深专家，特级教师，全国优秀教师，中国教师报特聘课改专家,以实践注解理念，以案例表达观点，语言风趣幽默，彰显生命体验，触动心灵共鸣，', 99999.00, 'a02cc9a3fc5def5275b5ca22f0d8f414', 5, 0.00);
INSERT INTO `userdata` VALUES (61, 62, '/Uploads/touxiang/1.png', '', '', '全国知名全国资深专家，特级教师，全国优秀教师，中国教师报特聘课改专家,以实践注解理念，以案例表达观点，语言风趣幽默，彰显生命体验，触动心灵共鸣，', 0.00, NULL, 0, 0.00);
INSERT INTO `userdata` VALUES (62, 63, '/Uploads/touxiang/1.png', '', '', '全国知名全国资深专家，特级教师，全国优秀教师，中国教师报特聘课改专家,以实践注解理念，以案例表达观点，语言风趣幽默，彰显生命体验，触动心灵共鸣，', 0.00, NULL, 0, 0.00);
INSERT INTO `userdata` VALUES (63, 64, '/Uploads/touxiang/1.png', '', '', '全国知名全国资深专家，特级教师，全国优秀教师，中国教师报特聘课改专家,以实践注解理念，以案例表达观点，语言风趣幽默，彰显生命体验，触动心灵共鸣，', 0.00, NULL, 0, 0.00);
INSERT INTO `userdata` VALUES (64, 65, '/Uploads/touxiang/2018-02-28/5a966dbe9599a.jpeg', '男', '河北省-石家庄市', '全国知名全国资深专家，特级教师，全国优秀教师，中国教师报特聘课改专家,以实践注解理念，以案例表达观点，语言风趣幽默，彰显生命体验，触动心灵共鸣，', 0.00, '14e1b600b1fd579f47433b88e8d85291', 13, 0.00);
INSERT INTO `userdata` VALUES (65, 66, '/Uploads/touxiang/1.png', '', '', '全国知名全国资深专家，特级教师，全国优秀教师，中国教师报特聘课改专家,以实践注解理念，以案例表达观点，语言风趣幽默，彰显生命体验，触动心灵共鸣，', 0.00, NULL, 0, 0.00);
INSERT INTO `userdata` VALUES (66, 67, '/Uploads/touxiang/1.png', '', '', '全国知名全国资深专家，特级教师，全国优秀教师，中国教师报特聘课改专家,以实践注解理念，以案例表达观点，语言风趣幽默，彰显生命体验，触动心灵共鸣，', 0.00, NULL, 0, 0.00);
INSERT INTO `userdata` VALUES (67, 68, '/Uploads/touxiang/1.png', '', '', '全国知名全国资深专家，特级教师，全国优秀教师，中国教师报特聘课改专家,以实践注解理念，以案例表达观点，语言风趣幽默，彰显生命体验，触动心灵共鸣，', 0.00, NULL, 0, 0.00);
INSERT INTO `userdata` VALUES (68, 69, '/Uploads/touxiang/1.png', '', '', '全国知名全国资深专家，特级教师，全国优秀教师，中国教师报特聘课改专家,以实践注解理念，以案例表达观点，语言风趣幽默，彰显生命体验，触动心灵共鸣，', 0.00, NULL, 5, 0.00);
INSERT INTO `userdata` VALUES (69, 70, '/Uploads/touxiang/2018-02-28/5a960241b9d9b.jpg', '男', '福建福州', '全国知名全国资深专家，特级教师，全国优秀教师，中国教师报特聘课改专家,以实践注解理念，以案例表达观点，语言风趣幽默，彰显生命体验，触动心灵共鸣，', 4.47, '9db06bcff9248837f86d1a6bcf41c9e7', 8390928, 0.00);
INSERT INTO `userdata` VALUES (70, 71, '/Uploads/touxiang/1.png', '', '', '全国知名全国资深专家，特级教师，全国优秀教师，中国教师报特聘课改专家,以实践注解理念，以案例表达观点，语言风趣幽默，彰显生命体验，触动心灵共鸣，', 0.00, NULL, 0, 0.00);
INSERT INTO `userdata` VALUES (71, 72, '/Uploads/touxiang/1.png', '', '', '全国知名全国资深专家，特级教师，全国优秀教师，中国教师报特聘课改专家,以实践注解理念，以案例表达观点，语言风趣幽默，彰显生命体验，触动心灵共鸣，', 6.00, '9db06bcff9248837f86d1a6bcf41c9e7', 5, 0.00);
INSERT INTO `userdata` VALUES (72, 73, '/Uploads/touxiang/1.png', '', '', '全国知名全国资深专家，特级教师，全国优秀教师，中国教师报特聘课改专家,以实践注解理念，以案例表达观点，语言风趣幽默，彰显生命体验，触动心灵共鸣，', 0.00, NULL, 5, 0.00);
INSERT INTO `userdata` VALUES (73, 74, '/Uploads/touxiang/2018-02-28/5a966e24c122e.jpeg', '男', '河北省-石家庄市', '全国知名全国资深专家，特级教师，全国优秀教师，中国教师报特聘课改专家,以实践注解理念，以案例表达观点，语言风趣幽默，彰显生命体验，触动心灵共鸣，', 6.00, '14e1b600b1fd579f47433b88e8d85291', 10, 0.00);
INSERT INTO `userdata` VALUES (74, 75, '/Uploads/touxiang/1.png', '', '', '全国知名全国资深专家，特级教师，全国优秀教师，中国教师报特聘课改专家,以实践注解理念，以案例表达观点，语言风趣幽默，彰显生命体验，触动心灵共鸣，', 0.00, NULL, 0, 0.00);
INSERT INTO `userdata` VALUES (76, 77, '/Uploads/touxiang/1.png', '', '', '全国知名全国资深专家，特级教师，全国优秀教师，中国教师报特聘课改专家,以实践注解理念，以案例表达观点，语言风趣幽默，彰显生命体验，触动心灵共鸣，', 0.00, NULL, 0, 0.00);
INSERT INTO `userdata` VALUES (77, 78, '/Uploads/touxiang/1.png', '', '', '全国知名全国资深专家，特级教师，全国优秀教师，中国教师报特聘课改专家,以实践注解理念，以案例表达观点，语言风趣幽默，彰显生命体验，触动心灵共鸣，', 0.00, NULL, 0, 0.00);
INSERT INTO `userdata` VALUES (78, 79, '/Uploads/touxiang/1.png', '', '', '全国知名全国资深专家，特级教师，全国优秀教师，中国教师报特聘课改专家,以实践注解理念，以案例表达观点，语言风趣幽默，彰显生命体验，触动心灵共鸣，', 0.00, NULL, 0, 0.00);
INSERT INTO `userdata` VALUES (79, 80, '/Uploads/touxiang/1.png', '', '', '全国知名全国资深专家，特级教师，全国优秀教师，中国教师报特聘课改专家,以实践注解理念，以案例表达观点，语言风趣幽默，彰显生命体验，触动心灵共鸣，', 0.00, '63ee451939ed580ef3c4b6f0109d1fd0', 0, 0.00);
INSERT INTO `userdata` VALUES (80, 81, '/Uploads/touxiang/1.png', '女', '北京市-东城区', '全国知名全国资深专家，特级教师，全国优秀教师，中国教师报特聘课改专家,以实践注解理念，以案例表达观点，语言风趣幽默，彰显生命体验，触动心灵共鸣，', 0.00, NULL, 5, 0.00);
INSERT INTO `userdata` VALUES (81, 82, '/Uploads/touxiang/1.png', '', '', '全国知名全国资深专家，特级教师，全国优秀教师，中国教师报特聘课改专家,以实践注解理念，以案例表达观点，语言风趣幽默，彰显生命体验，触动心灵共鸣，', 0.00, NULL, 15, 0.00);
INSERT INTO `userdata` VALUES (82, 83, '/Uploads/touxiang/1.png', '男', '北京市-东城区', '全国知名全国资深专家，特级教师，全国优秀教师，中国教师报特聘课改专家,以实践注解理念，以案例表达观点，语言风趣幽默，彰显生命体验，触动心灵共鸣，', 0.00, 'd275afdd5396e6af626b14bfe8abef19', 25, 0.00);
INSERT INTO `userdata` VALUES (83, 84, '/Uploads/touxiang/1.png', '', '', '全国知名全国资深专家，特级教师，全国优秀教师，中国教师报特聘课改专家,以实践注解理念，以案例表达观点，语言风趣幽默，彰显生命体验，触动心灵共鸣，', 0.00, NULL, 5, 0.00);
INSERT INTO `userdata` VALUES (91, 95, '/Uploads/touxiang/1.png', '', '', '全国知名全国资深专家，特级教师，全国优秀教师，中国教师报特聘课改专家,以实践注解理念，以案例表达观点，语言风趣幽默，彰显生命体验，触动心灵共鸣，', 1.00, '9db06bcff9248837f86d1a6bcf41c9e7', 5, 0.00);
INSERT INTO `userdata` VALUES (93, 97, '/Uploads/touxiang/2018-03-29/5abc47cdc55f4.jpeg', '女', '湖北省-襄樊市', '全国知名全国资深专家，特级教师，全国优秀教师，中国教师报特聘课改专家,以实践注解理念，以案例表达观点，语言风趣幽默，彰显生命体验，触动心灵共鸣，', 877.78, '9db06bcff9248837f86d1a6bcf41c9e7', 20, 0.00);
INSERT INTO `userdata` VALUES (94, 98, '/Uploads/touxiang/1.png', '', '', '全国知名全国资深专家，特级教师，全国优秀教师，中国教师报特聘课改专家,以实践注解理念，以案例表达观点，语言风趣幽默，彰显生命体验，触动心灵共鸣，', 0.00, NULL, 0, 0.00);
INSERT INTO `userdata` VALUES (95, 99, '/Uploads/touxiang/2018-03-09/5aa23196d3dce.jpg', '女', '山西省-阳泉市', '国家特级教师，有多年教学经验与实践经验', 858.66, 'a02cc9a3fc5def5275b5ca22f0d8f414', 1066, 0.00);
INSERT INTO `userdata` VALUES (96, 100, '/Uploads/touxiang/2018-03-12/5aa634c2bd3c6.jpg', '女', '福建南平', '全国知名全国资深专家，特级教师，全国优秀教师，中国教师报特聘课改专家,以实践注解理念，以案例表达观点，语言风趣幽默，彰显生命体验，触动心灵共鸣，', 0.00, '14e1b600b1fd579f47433b88e8d85291', 10, 0.00);
INSERT INTO `userdata` VALUES (97, 101, '/Uploads/touxiang/2018-03-12/5aa616e1699de.jpg', '女', '西藏日喀则', '全国知名全国资深专家，特级教师，全国优秀教师，中国教师报特聘课改专家,以实践注解理念，以案例表达观点，语言风趣幽默，彰显生命体验，触动心灵共鸣，', 9958.78, 'a02cc9a3fc5def5275b5ca22f0d8f414', 30, 0.00);
INSERT INTO `userdata` VALUES (104, 108, '/Uploads/touxiang/1.png', '', '', '全国知名全国资深专家，特级教师，全国优秀教师，中国教师报特聘课改专家,以实践注解理念，以案例表达观点，语言风趣幽默，彰显生命体验，触动心灵共鸣，', 0.00, NULL, 0, 0.00);
INSERT INTO `userdata` VALUES (105, 109, '/Uploads/touxiang/2018-03-26/5ab897e9d8fb3.jpg', '', '', '全国知名全国资深专家，特级教师，全国优秀教师，中国教师报特聘课改专家,以实践注解理念，以案例表达观点，语言风趣幽默，彰显生命体验，触动心灵共鸣，', 0.00, '9db06bcff9248837f86d1a6bcf41c9e7', 5, 0.00);
INSERT INTO `userdata` VALUES (106, 110, '/Uploads/touxiang/2018-03-13/5aa79beb2d195.jpg', '男', '河北沧州', '全国知名全国资深专家，特级教师，全国优秀教师，中国教师报特聘课改专家,以实践注解理念，以案例表达观点，语言风趣幽默，彰显生命体验，触动心灵共鸣，', 0.00, 'a02cc9a3fc5def5275b5ca22f0d8f414', 20, 0.00);
INSERT INTO `userdata` VALUES (107, 111, '/Uploads/touxiang/2018-03-15/5aa9e5aecf865.jpeg', '女', '山西省-太原市', '全国知名全国资深专家，特级教师，全国优秀教师，中国教师报特聘课改专家,以实践注解理念，以案例表达观点，语言风趣幽默，彰显生命体验，触动心灵共鸣，', 999714.00, 'a02cc9a3fc5def5275b5ca22f0d8f414', 424576, 0.00);
INSERT INTO `userdata` VALUES (108, 112, '/Uploads/touxiang/1.png', '', '', '全国知名全国资深专家，特级教师，全国优秀教师，中国教师报特聘课改专家,以实践注解理念，以案例表达观点，语言风趣幽默，彰显生命体验，触动心灵共鸣，', 0.00, '63ee451939ed580ef3c4b6f0109d1fd0', 0, 0.00);
INSERT INTO `userdata` VALUES (109, 113, '/Uploads/touxiang/1.png', '', '', '全国知名全国资深专家，特级教师，全国优秀教师，中国教师报特聘课改专家,以实践注解理念，以案例表达观点，语言风趣幽默，彰显生命体验，触动心灵共鸣，', 0.00, NULL, 0, 0.00);
INSERT INTO `userdata` VALUES (110, 114, '/Uploads/touxiang/1.png', '', '', '', 0.00, '4fa2516f66f439cc66540788c1fe226b', 0, 0.00);
INSERT INTO `userdata` VALUES (111, 115, '/Uploads/touxiang/2018-03-21/5ab1f52a889e0.jpg', '女', '内蒙古-呼和浩特市', '全国特级教师，奥林匹克数学竞赛辅导金牌讲师。', 8842.00, '14e1b600b1fd579f47433b88e8d85291', 81, 0.00);
INSERT INTO `userdata` VALUES (112, 116, '/Uploads/touxiang/1.png', '', '', '', 0.00, NULL, 0, 0.00);
INSERT INTO `userdata` VALUES (113, 117, '/Uploads/touxiang/2018-03-26/5ab8862574b05.jpeg', '女', '山西省-朔州市', '', 10017.00, '9db06bcff9248837f86d1a6bcf41c9e7', 73, 0.00);
INSERT INTO `userdata` VALUES (114, 118, '/Uploads/touxiang/2018-03-26/5ab8ac113ba8c.jpeg', '', '', '', 0.00, 'a02cc9a3fc5def5275b5ca22f0d8f414', 25, 0.00);
INSERT INTO `userdata` VALUES (115, 119, '/Uploads/touxiang/2018-03-23/5ab454fd55d0f.jpg', '', '', '', 1000.00, NULL, 10005, 0.00);
INSERT INTO `userdata` VALUES (116, 120, '/Uploads/touxiang/1.png', '', '', '', 10000.00, NULL, 5, 0.00);
INSERT INTO `userdata` VALUES (117, 121, '/Uploads/touxiang/1.png', '', '', '', 0.00, NULL, 0, 0.00);
INSERT INTO `userdata` VALUES (118, 122, '/Uploads/touxiang/1.png', '', '', '', 0.00, NULL, 0, 0.00);
INSERT INTO `userdata` VALUES (119, 123, '/Uploads/touxiang/1.png', '', '', '', 0.00, NULL, 0, 0.00);
INSERT INTO `userdata` VALUES (120, 124, '/Uploads/touxiang/1.png', '', '', '', 0.00, NULL, 0, 0.00);
INSERT INTO `userdata` VALUES (121, 125, '/Uploads/touxiang/1.png', '', '', '', 0.00, NULL, 0, 0.00);
INSERT INTO `userdata` VALUES (122, 126, '/Uploads/touxiang/1.png', '', '', '', 0.00, NULL, 0, 0.00);
INSERT INTO `userdata` VALUES (123, 127, '/Uploads/touxiang/1.png', '', '', '', 0.00, NULL, 0, 0.00);
INSERT INTO `userdata` VALUES (124, 128, '/Uploads/touxiang/2018-03-30/5abda68ff1117.jpg', '男', '福建福州', '美丽动人', 0.00, NULL, 5, 0.00);
INSERT INTO `userdata` VALUES (125, 129, '/Uploads/touxiang/1.png', '男', '北京市-东城区', '1231321313', 0.00, 'd57feb2e831ae386bae7a4bbcb44c8bf', 5, 0.00);
INSERT INTO `userdata` VALUES (126, 130, '/Uploads/touxiang/1.png', '', '', '', 0.00, NULL, 15, 0.00);
INSERT INTO `userdata` VALUES (127, 131, '/Uploads/touxiang/1.png', '', '', '', 0.00, NULL, 0, 0.00);
INSERT INTO `userdata` VALUES (128, 132, '/Uploads/touxiang/1.png', '', '', '', 0.00, NULL, 0, 0.00);

-- ----------------------------
-- Table structure for verify
-- ----------------------------
DROP TABLE IF EXISTS `verify`;
CREATE TABLE `verify`  (
  `verify_id` int(11) NOT NULL AUTO_INCREMENT,
  `phone` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '手机号',
  `verify` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '验证码',
  `time` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '时间',
  PRIMARY KEY (`verify_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 341 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of verify
-- ----------------------------
INSERT INTO `verify` VALUES (330, '13610813125', '111599', '1522045892');
INSERT INTO `verify` VALUES (327, '13610813126', '193226', '1521788744');
INSERT INTO `verify` VALUES (325, '13610813125', '761433', '1521774077');
INSERT INTO `verify` VALUES (324, '13804976190', '499629', '1521768961');
INSERT INTO `verify` VALUES (322, '18888888888', '184348', '1521766094');
INSERT INTO `verify` VALUES (320, '13610813125', '236450', '1521696765');
INSERT INTO `verify` VALUES (319, '13610813125', '841390', '1521695899');
INSERT INTO `verify` VALUES (317, '13610813126', '597496', '1521682170');
INSERT INTO `verify` VALUES (313, '13610813125', '141443', '1521624330');
INSERT INTO `verify` VALUES (311, '13610813123', '132334', '1521616233');
INSERT INTO `verify` VALUES (310, '13610813125', '348557', '1521614508');
INSERT INTO `verify` VALUES (305, '13610813124', '864477', '1521594953');
INSERT INTO `verify` VALUES (302, '13610813125', '130513', '1521594511');
INSERT INTO `verify` VALUES (300, '13610813125', '788977', '1521525439');
INSERT INTO `verify` VALUES (298, '13610813123', '202379', '1521508530');
INSERT INTO `verify` VALUES (294, '13610813121', '173484', '1521507523');
INSERT INTO `verify` VALUES (291, '17640276360', '232929', '1521085762');
INSERT INTO `verify` VALUES (287, '13610813128', '136338', '1521009391');
INSERT INTO `verify` VALUES (286, '13610813126', '427567', '1520993061');
INSERT INTO `verify` VALUES (284, '13610813125', '262326', '1520989945');
INSERT INTO `verify` VALUES (283, '13610813125', '390468', '1520989407');
INSERT INTO `verify` VALUES (281, '13610813121', '238282', '1520989043');
INSERT INTO `verify` VALUES (336, '13610813125', '328726', '1522378071');
INSERT INTO `verify` VALUES (337, '13610813120', '982594', '1522378152');

-- ----------------------------
-- Table structure for video
-- ----------------------------
DROP TABLE IF EXISTS `video`;
CREATE TABLE `video`  (
  `video_id` int(11) NOT NULL AUTO_INCREMENT,
  `img` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '视频封面',
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '视频名称',
  `class_id` int(11) NOT NULL COMMENT '课堂id',
  `cate_id` int(11) NOT NULL COMMENT '分类id',
  `money` float(8, 2) NOT NULL DEFAULT 0.00 COMMENT '费用',
  `introduce` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '视频介绍',
  `recommend` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0' COMMENT '是否推荐    0：不推荐    1：推荐',
  `number` int(11) DEFAULT 0 COMMENT '购买人数',
  `url` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '视频地址',
  `time` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '视频上传时间',
  `status` char(1) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0' COMMENT '状态（0正常1下线）',
  `astatus` char(1) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0' COMMENT '审核状态  0：待审核  1：通过  2：拒绝',
  `file_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`video_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 146 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of video
-- ----------------------------
INSERT INTO `video` VALUES (120, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/155e38287447398155204423267/7447398155204423269.jpg', '326mov', 42, 6, 3.00, 'mov', '0', 1, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/155e38287447398155204423267/CCjftCQAfoIA.mov', '1522113243', '0', '0', '7447398155204423267');
INSERT INTO `video` VALUES (119, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/7982528d7447398155202385645/7447398155202385647.jpg', '326视频格式', 42, 6, 2.00, '测试视频格式', '1', 2, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/7982528d7447398155202385645/1sYJglvLFvUA.mpg', '1522113351', '0', '0', '7447398155202385645');
INSERT INTO `video` VALUES (118, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/f7b549c67447398155207234406/7447398155207234407.jpg', '326flv', 42, 6, 1.00, '上传视频格式测试', '1', 1, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/f7b549c67447398155207234406/asTtMsOTxhAA.mov', '1522113117', '0', '0', '7447398155207234406');
INSERT INTO `video` VALUES (117, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/0a7e98e77447398155167140523/7447398155167140524.jpg', '323视频文化', 42, 19, 6.00, '李call摸摸摸摸你抹灰工玫红色5句题图土体特仑苏退股就图片看看*李寂寞咖啡李可厉害了', '1', 1, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/0a7e98e77447398155167140523/LeuGpkGEGIoA.mp4', '1521794224', '0', '0', '7447398155167140523');
INSERT INTO `video` VALUES (114, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/365f02957447398155164963662/7447398155164963663.jpg', '323视频管理', 44, 49, 6.00, '有一个哥哥哥哥哥我岸上踏上这件宝贝这两年多时间在流逝了吗', '1', 0, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/365f02957447398155164963662/rHsj3fu7Wv8A.mp4', '1521774668', '0', '0', '7447398155164963662');
INSERT INTO `video` VALUES (111, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/4e31268c7447398155151065745/7447398155151065746.jpg', '3.22视频', 40, 61, 3.00, '季节交替使用寿命是低啊健健康康经历了', '1', 4, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/4e31268c7447398155151065745/YKNhMR9baCoA.mp4', '1521681073', '0', '0', '7447398155151065745');
INSERT INTO `video` VALUES (112, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/3ffc8c737447398155147745094/7447398155147745095.jpg', '3.22 视频英语口语', 42, 6, 5.00, '咯可口可乐了看看咯可口可乐了看看了侬侬你空间里', '1', 1, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/3ffc8c737447398155147745094/hRpKQq49bHsA.mp4', '1521687215', '0', '0', '7447398155147745094');
INSERT INTO `video` VALUES (113, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/363abbca7447398155164943122/7447398155164943123.jpg', 'Assad’s', 33, 60, 0.00, 'Assad’s', '1', 2, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/363abbca7447398155164943122/takCQT0PigsA.mp4', '1521774449', '0', '0', '7447398155164943122');
INSERT INTO `video` VALUES (110, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/60d968a87447398155134204808/7447398155134204809.jpg', '3.21视频法务', 40, 51, 8.00, '0', '1', 0, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/60d968a87447398155134204808/obpR9Mp4iyQA.mp4', '1521602576', '0', '0', '7447398155134204808');
INSERT INTO `video` VALUES (106, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/00822d427447398155065311026/7447398155065311027.jpg', '托福考试', 40, 8, 0.00, '一对一教学，老师有多年经验，教学严谨认真', '1', 9, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/00822d427447398155065311026/Da3I3QCLtAYA.mov', '1521192576', '0', '0', '7447398155065311026');
INSERT INTO `video` VALUES (109, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/582db2287447398155137913303/7447398155137913304.jpg', '3.21视频', 40, 53, 5.00, '0', '1', 4, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/582db2287447398155137913303/MR9XBeiCETcA.mp4', '1521597496', '0', '0', '7447398155137913303');
INSERT INTO `video` VALUES (108, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/2ed5c82c7447398155123539470/7447398155123539471.jpeg', '3.20*高中数学', 40, 34, 0.00, '的*发多少度水电费防守打法山东山东发送到发送到', '1', 5, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/2ed5c82c7447398155123539470/rnGiJiAee6AA.mp4', '1521530773', '0', '0', '7447398155123539470');
INSERT INTO `video` VALUES (104, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/febf6eb27447398155065294095/7447398155065294096.jpg', '写作第二课', 30, 20, 998.00, '让自己更加优秀，更加自信，更加精彩，！!！', '1', 0, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/febf6eb27447398155065294095/fj6vfXRLI10A.mp4', '1521172089', '0', '0', '7447398155065294095');
INSERT INTO `video` VALUES (99, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/c815e4c17447398155061136330/7447398155061136331.jpg', '精品简历制作', 29, 47, 998.00, '让自己更加优秀，更加自信，更加精彩，求职成功！!！', '1', 0, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/c815e4c17447398155061136330/wd8wPPoBCj0A.mp4', '1521168907', '0', '0', '7447398155061136330');
INSERT INTO `video` VALUES (101, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/cd1a1f8c7447398155061385209/7447398155061385210.jpg', '面试实战', 29, 47, 998.00, '让自己更加优秀，更加自信，更加精彩，求职成功！!！', '1', 0, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/cd1a1f8c7447398155061385209/UNSluBdwt3QA.mp4', '1521171145', '0', '0', '7447398155061385209');
INSERT INTO `video` VALUES (102, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/feb018117447398155065289171/7447398155065289172.jpg', '上传', 30, 6, 8.00, '啦咯啦咯啦咯啦咯啦咯啦咯啦咯啦咯啦咯啦咯啦咯啦咯啦咯啦咯啦咯啦咯啦咯啦咯啦咯啦咯啦咯啦咯啦咯啦咯啦咯啦咯啦咯啦咯啦咯啦咯', '1', 6, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/feb018117447398155065289171/8LyJfpgK18wA.mp4', '1521429887', '0', '0', '7447398155065289171');
INSERT INTO `video` VALUES (103, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/88f5d6a87447398155060715191/7447398155060715192.jpg', '写作第一课', 30, 20, 998.00, '让自己更加优秀，更加自信，更加精彩，！!！', '1', 0, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/88f5d6a87447398155060715191/BFEWXdOIhKUA.mp4', '1521171963', '0', '0', '7447398155060715191');
INSERT INTO `video` VALUES (98, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/ca68ed6f7447398155061232779/7447398155061232780.jpg', '英语四级', 40, 7, 0.00, '一对一教学，36节课，每节课手把手认真教学', '1', 12, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/ca68ed6f7447398155061232779/jBda3JQVonQA.mp4', '1521167758', '0', '0', '7447398155061232779');
INSERT INTO `video` VALUES (97, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/78b4efa47447398155060027281/7447398155060027282.jpg', '雅思英语', 40, 12, 0.00, '0基础雅思教学，包过。一对一授课，手把手教学', '1', 6, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/78b4efa47447398155060027281/AiljyuuwhscA.mp4', '1521166590', '0', '0', '7447398155060027281');
INSERT INTO `video` VALUES (96, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/c59ad97a7447398155061013050/7447398155061013051.jpg', '树立正确的文案观', 29, 49, 998.00, '让自己更加优秀，更加自信，更加精彩！!！', '1', 1, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/c59ad97a7447398155061013050/T4eJVB4I6AMA.mp4', '1521165447', '0', '0', '7447398155061013050');
INSERT INTO `video` VALUES (91, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/b8340def7447398155064514980/7447398155064514981.jpg', '人性价值训练2', 29, 47, 998.00, '让自己更加优秀，更加自信，更加精彩！!！', '1', 0, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/b8340def7447398155064514980/PCZIejiafFQA.mp4', '1521164818', '0', '0', '7447398155064514980');
INSERT INTO `video` VALUES (92, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/8df9958d7447398155060963425/7447398155060963426.jpg', '文案结构训练1', 29, 53, 998.00, '让自己更加优秀，更加自信，更加精彩！!！', '1', 0, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/8df9958d7447398155060963425/iEtmQA20Ai4A.mp4', '1521164910', '0', '0', '7447398155060963425');
INSERT INTO `video` VALUES (93, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/8de9bb317447398155060957714/7447398155060957715.jpg', '文案结构训练2', 29, 53, 998.00, '让自己更加优秀，更加自信，更加精彩！!！', '1', 0, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/8de9bb317447398155060957714/ifJro5fEzr4A.mp4', '1521164990', '0', '0', '7447398155060957714');
INSERT INTO `video` VALUES (94, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/565e8d927447398155059941174/7447398155059941175.jpg', '注意力训练1', 29, 48, 998.00, '让自己更加优秀，更加自信，更加精彩！!！', '1', 0, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/565e8d927447398155059941174/3OrgLMyyU5kA.mp4', '1521165117', '0', '0', '7447398155059941174');
INSERT INTO `video` VALUES (95, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/565f15927447398155059942065/7447398155059942066.jpg', '注意力训练2', 29, 47, 998.00, '让自己更加优秀，更加自信，更加精彩！!！', '1', 0, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/565f15927447398155059942065/JZs8lLPOzjcA.mp4', '1521165222', '0', '0', '7447398155059942065');
INSERT INTO `video` VALUES (90, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/b8335b6f7447398155064513099/7447398155064513100.jpg', '人性价值训练1', 29, 47, 998.00, '让自己更加优秀，更加自信，更加精彩！!！', '1', 1, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/b8335b6f7447398155064513099/uCvHcbRIhwgA.mp4', '1521164716', '0', '0', '7447398155064513099');
INSERT INTO `video` VALUES (89, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/53e4bcf27447398155059820682/7447398155059820683.jpg', '价值塑造训练2', 29, 49, 998.00, '让自己更有价值，更自信，更有能力', '1', 0, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/53e4bcf27447398155059820682/gZyYTHABLxoA.mp4', '1521164221', '0', '0', '7447398155059820682');
INSERT INTO `video` VALUES (88, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/8bc921e97447398155060884230/7447398155060884231.jpg', '价值塑造训练', 29, 49, 998.00, '让自己更有价值，更热爱自己的事业', '1', 0, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/8bc921e97447398155060884230/c4le1xcHjn8A.mp4', '1521164107', '0', '0', '7447398155060884230');
INSERT INTO `video` VALUES (87, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/b5efbdc37447398155064422007/7447398155064422008.jpg', '引导客户训练2', 29, 54, 998.00, '让你工作无压力，更好的完成任务，', '0', 0, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/b5efbdc37447398155064422007/oiFGaEk106sA.mp4', '1521163988', '0', '0', '7447398155064422007');
INSERT INTO `video` VALUES (86, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/8ba592737447398155060865727/7447398155060865728.jpg', '引导客户训练', 29, 54, 998.00, '让你把握客户的心里，工作更加顺利，', '0', 0, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/8ba592737447398155060865727/44OKFa3rA4oA.mp4', '1521163884', '0', '0', '7447398155060865727');
INSERT INTO `video` VALUES (82, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/b1b44b977447398155064286685/7447398155064286686.jpg', '思维导图训练', 27, 15, 998.00, '思维导图训练让你更加灵敏快捷灵活', '0', 0, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/b1b44b977447398155064286685/SWopIIhKdKYA.mp4', '1521163014', '0', '0', '7447398155064286685');
INSERT INTO `video` VALUES (83, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/b3f414cc7447398155064370716/7447398155064370717.jpg', '思维联想训练2', 27, 37, 998.00, '强大的思维让你更加自信，工作更加顺利', '0', 0, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/b3f414cc7447398155064370716/V1g6RQrjfuoA.mp4', '1521163291', '0', '0', '7447398155064370716');
INSERT INTO `video` VALUES (84, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/8b4ba0737447398155060816659/7447398155060816660.jpg', '思维联想训练3', 27, 37, 998.00, '强大的思维训练让你更加自信满满！！', '0', 0, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/8b4ba0737447398155060816659/rf1QQIt428sA.mp4', '1521163444', '0', '0', '7447398155060816659');
INSERT INTO `video` VALUES (85, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/b3f6db4f7447398155064375921/7447398155064375922.jpg', '思维联想训练4', 27, 37, 998.00, '强大的思维让你工作更加自信，更加快乐', '0', 0, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/b3f6db4f7447398155064375921/aMZRZOUyZ6sA.mp4', '1521163613', '0', '0', '7447398155064375921');
INSERT INTO `video` VALUES (121, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/7971ca937447398155202378199/7447398155202378200.jpg', '326mkv', 42, 6, 3.00, 'mkv', '0', 1, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/7971ca937447398155202378199/9TR55f8N7kIA.mkv', '1522113164', '0', '0', '7447398155202378199');
INSERT INTO `video` VALUES (122, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/f7c656e87447398155207242751/7447398155207242752.jpg', '326avi', 42, 6, 4.00, 'avi', '0', 3, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/f7c656e87447398155207242751/IRls58y3DlcA.avi', '1522113204', '0', '0', '7447398155207242751');
INSERT INTO `video` VALUES (123, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/799193637447398155202390027/7447398155202390028.jpg', '3263gp', 42, 6, 5.00, '3gp', '0', 1, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/799193637447398155202390027/RsWrHXOCZicA.3gp', '1522113450', '0', '0', '7447398155202390027');
INSERT INTO `video` VALUES (124, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/fa2f34ad7447398155207355553/7447398155207355554.jpg', '326flv', 42, 6, 6.00, 'flv', '0', 1, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/fa2f34ad7447398155207355553/hDm7LdZWrVUA.flv', '1522113566', '0', '0', '7447398155207355553');
INSERT INTO `video` VALUES (125, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/158416ea7447398155204446471/7447398155204446472.jpg', '326wmv', 42, 6, 7.00, 'wmv', '0', 4, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/158416ea7447398155204446471/Gjr4whrRjA4A.wmv', '1522113277', '0', '0', '7447398155204446471');
INSERT INTO `video` VALUES (126, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/17c8e1797447398155204539978/7447398155204539979.jpg', '326vob', 42, 6, 8.00, 'vob', '0', 1, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/17c8e1797447398155204539978/PHhYA53nvJgA.vob', '1522113315', '0', '0', '7447398155204539978');
INSERT INTO `video` VALUES (127, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/0c300cec7447398155204047728/7447398155204047729.jpg', '你你哦LOL母驴噜噜噜', 30, 6, 0.00, '倪敏JOJO', '0', 1, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/0c300cec7447398155204047728/b2PCUHpt78oA.mp4', '1522041107', '0', '0', '7447398155204047728');
INSERT INTO `video` VALUES (128, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/6e4c653f7447398155205966988/7447398155205966989.jpg', '张求赞求赞求赞', 30, 6, 0.00, '你你OK倪敏', '0', 1, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/6e4c653f7447398155205966988/aavNqhQV1zQA.mp4', '1522041552', '0', '0', '7447398155205966988');
INSERT INTO `video` VALUES (129, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/f35367aa7447398155207074732/7447398155207074733.jpg', '3.26', 40, 6, 0.00, '你女诺可以可以自由自在婆婆肉木木木木木木哦咯', '0', 1, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/f35367aa7447398155207074732/Utaxg08iUxcA.mp4', '1522048232', '0', '0', '7447398155207074732');
INSERT INTO `video` VALUES (130, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/98a7908e7447398155209531286/7447398155209531287.jpg', '3.25', 40, 6, 6.00, '您揉你英语名字我婆婆木木木诺肉母女嘟嘟嘟', '0', 1, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/98a7908e7447398155209531286/L3b6CfQixSgA.mp4', '1522048311', '0', '0', '7447398155209531286');
INSERT INTO `video` VALUES (131, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/98a939507447398155209534339/7447398155209534341.jpg', '嘻嘻我是谓', 40, 6, 9.00, '洗衣机一口一口母*魔头欧诺LOL哦咯孔子猪蹄汤', '0', 1, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/98a939507447398155209534339/EGFJpqiHLQcA.mp4', '1522048480', '0', '0', '7447398155209534339');
INSERT INTO `video` VALUES (132, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/b9e6ef407447398155220413811/7447398155220413812.jpg', '好的角度', 30, 42, 6.00, '娇滴滴对嘀嘀咕咕辜负可分开分开分开分开分开几分', '0', 0, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/b9e6ef407447398155220413811/aO3Q4kLhJaIA.mp4', '1522113375', '0', '0', '7447398155220413811');
INSERT INTO `video` VALUES (138, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/116870d67447398155245379527/7447398155245379528.jpg', '329视频口语', 40, 6, 50.00, '老K就睡咯地了啦咯啦咯啦咯啦咯啦咯啦咯啦咯啦咯啦咯啦咯得把擦擦', '0', 0, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/116870d67447398155245379527/PCAXn5Aza3AA.mkv', '1522303154', '0', '0', '7447398155245379527');
INSERT INTO `video` VALUES (135, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/bc9795c27447398155220565301/7447398155220565302.jpg', '327', 44, 6, 999999.00, '幕布噜噜噜木木木木木木欧诺头目**诺头路路路', '0', 0, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/bc9795c27447398155220565301/h0F9HQzWR5cA.mpg', '1522114956', '0', '0', '7447398155220565301');
INSERT INTO `video` VALUES (136, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/00505d457447398155221177223/7447398155221177224.jpg', '327视频办公', 44, 17, 3.00, '阿里啦咯啦咯alone哦哦陌陌摸摸测试视频格式，', '0', 0, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/00505d457447398155221177223/i2zEJmAJW5cA.mov', '1522121347', '0', '0', '7447398155221177223');
INSERT INTO `video` VALUES (137, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/024972e27447398155221224515/7447398155221224516.jpg', '327俄语', 44, 13, 999999.00, '老K记录去你看懂哦哦敏敏呵呵哈哈哈很好', '0', 0, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/024972e27447398155221224515/EmrwBM6iFaYA.mkv', '1522121446', '0', '0', '7447398155221224515');
INSERT INTO `video` VALUES (139, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/67b6445b7447398155246777844/7447398155246777845.jpg', '329口语', 40, 6, 3.00, '阿狸了考虑兔兔阿里啦咯啦咯啊嘞嘞搭理我了我婆婆来了我自己家', '0', 0, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/67b6445b7447398155246777844/ADFDuqnX7RwA.mkv', '1522303932', '0', '0', '7447398155246777844');
INSERT INTO `video` VALUES (140, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/f5b98fee7447398155248239242/7447398155248239243.jpg', '329高中语文', 44, 35, 0.00, '来咯feel卡佛咯可口可乐了看看季姬击*记', '0', 1, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/f5b98fee7447398155248239242/XUjjtHjmfesA.mp4', '1522304422', '0', '0', '7447398155248239242');
INSERT INTO `video` VALUES (141, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/aa5b52db7447398155301789489/7447398155301789490.jpg', '42视频求职', 44, 47, 0.00, '哈哈哈哈哈回家看看坎坎坷坷坎坎坷坷人生路会有很多好吃么', '0', 1, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/aa5b52db7447398155301789489/ELuHzT0YAqEA.mp4', '1522634238', '0', '0', '7447398155301789489');
INSERT INTO `video` VALUES (142, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/a38af19f7447398155298965392/7447398155298965393.jpg', '42视频考研', 44, 43, 0.00, '哈哈哈哈嘎嘎嘎嘎广告看看己饥己溺你不后悔', '0', 1, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/a38af19f7447398155298965392/KD5KAHqcu78A.mp4', '1522634898', '0', '0', '7447398155298965392');
INSERT INTO `video` VALUES (143, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/4d1ce0a97447398155300095482/7447398155300095483.jpg', '42视频1', 40, 52, 0.00, '几乎都混混沌沌哈哈哈哈的哈哈给哥哥哥哥', '0', 0, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/4d1ce0a97447398155300095482/9AMzN95A3D8A.mp4', '1522636575', '0', '0', '7447398155300095482');
INSERT INTO `video` VALUES (144, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/e01e70977447398155299254437/7447398155299254438.jpg', '42视频2', 44, 50, 0.00, '哈哈哈嘎嘎嘎嘎锋菲复合哈哈哈哈哈哈哈姐姐机会', '0', 1, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/e01e70977447398155299254437/c65w8aRJIcoA.mp4', '1522637893', '0', '0', '7447398155299254437');
INSERT INTO `video` VALUES (145, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/5ac9e20c7447398155317336803/7447398155317336804.jpg', '测试春风十里', 30, 6, 0.00, 'OPPO*头哦哦女的特服头痛一样一样一物克一物语音', '0', 0, 'http://1255995999.vod2.myqcloud.com/d3ffb89evodgzp1255995999/5ac9e20c7447398155317336803/lj6mDoQPvAsA.mp4', '1522740448', '0', '0', '7447398155317336803');

-- ----------------------------
-- Table structure for wenti
-- ----------------------------
DROP TABLE IF EXISTS `wenti`;
CREATE TABLE `wenti`  (
  `wenti_id` int(11) NOT NULL AUTO_INCREMENT,
  `wenti` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '问题',
  `answer` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '答案',
  PRIMARY KEY (`wenti_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 45 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of wenti
-- ----------------------------
INSERT INTO `wenti` VALUES (5, '1.如何注册账户？', '您可以通过手机或微信，QQ，微博的方式注册账号。');
INSERT INTO `wenti` VALUES (6, '2.如何登陆账户？', '您可使用密码，手机验证码，或微信，微博，QQ扫码的方式登陆');
INSERT INTO `wenti` VALUES (7, '3.如何修改密码？', '点击屏幕右上方头像，选择个人资料，点击左侧个人账户，在个人密码处进行修改。');
INSERT INTO `wenti` VALUES (8, '4.忘记登陆密码怎么办？', '您可使用手机验证码的形式进行登陆，或在登陆页面选择忘记密码，通过短信验证码的形式进行密码修改。');
INSERT INTO `wenti` VALUES (9, '5.填写注册信息时的注意事项？', '（1）您须使用正确的手机号完成账号注册 （2）密码不能少于6位，多于18位');
INSERT INTO `wenti` VALUES (10, '6.为什么要完成手机验证？', '使用验证的方式注册，可以有效的帮您在忘记密码时及时找回。');
INSERT INTO `wenti` VALUES (11, '7.注册时使用的手机号不能正常使用，如何更改？', '已提交个人身份认证的用户可以通过联系在线客服，提交个人身份证照片的形式，进行修改。 未进行身份认证的用户，可联系客服，提交过往充值凭证，经客服审核后，进行修改。 注：审核周期一般为3-5个工作日');
INSERT INTO `wenti` VALUES (12, '8.是否可以修改认证的身份证？', '已进行身份认证的用户，无法修改身份证信息');
INSERT INTO `wenti` VALUES (13, '9.可以使用同一身份证认证多个账户么？', '为了提高每个账户的信誉度，为用户创造一个更加安全，可靠的学习平台，每张身份证只能认证一个账户');
INSERT INTO `wenti` VALUES (14, '10.身份证图片格式不对或太大，无法上传怎么办？', '提交的照片须小于300kb，支持JPG/PNG/BMP格式，请将图片压缩后进行上传');
INSERT INTO `wenti` VALUES (15, '11.如何查看和修改个人信息？', '您可以点击屏幕右上方头像，进入个人资料页面，对个人资料、我的课程、我的订阅、我的账户、订单管理、积分商城等信息进行修改和查看 注： （1）	昵称：10个字符以内，不能有特殊符号和敏感词语 （2）	个人简介：不能超过50个字；老师编辑个人简介后，app展示在老师详情页面；web展示在老师店铺页面');
INSERT INTO `wenti` VALUES (16, '12.如何退出账号？', '您可以点击屏幕右上方头像，选择退出选项');
INSERT INTO `wenti` VALUES (17, '13.如何下载APP？', '您可以登录网约课官网（www.wyuek.com），点击屏幕上方“下载APP”进行扫码下载。 苹果手机可以在App Store搜索“网约课”进行下载 安卓手机可以在应用商店搜索“网约课”进行下载');
INSERT INTO `wenti` VALUES (18, '14.如何成为老师？', '账户注册完毕后，进入个人后台，填写真实姓名、身份证号，上传三张身份证照片（正面、反面、手持照片）、一张资质证明照片，等待平台审核即可。 注：审核周期一般在1个工作日内。');
INSERT INTO `wenti` VALUES (19, '15.如何预约直播授课及编写课程介绍？', '经平台资质审核通过后，填写房间名称、上传直播封面图片、设置分类、填写课程介绍、选择开始时间和结束时间、默认价格、选择预约直播后即可。 注：须所有信息全部填写完成后，才可进行预约直播。');
INSERT INTO `wenti` VALUES (20, '16.如何直播？', '经审核成为老师之后，并已经预约直播，在直播时间开始直播');
INSERT INTO `wenti` VALUES (21, '17.如何上传授课视频', '您可以在我的课堂中点击上传视频 注意事项： 1.	请于直播后24小时内进行视频下载，24小时后官方会删除录播视频。 2.	上传的视频大小不得高于3个G');
INSERT INTO `wenti` VALUES (22, '18.上传的图片和视频有哪些限制', '上传的图片支持JPG、PNG格式，大小在500k以内，上传的视频大小不得高于3个G');
INSERT INTO `wenti` VALUES (23, '19.可以直播的内容有哪些？', '英语口语、英语四级、英语六级、雅思考试、日语学习、韩语学习托福考试、外语早教、音乐乐器、投资理财、体育运动、居家生活、个人修养、益智休闲、摄影视频、书法绘画等');
INSERT INTO `wenti` VALUES (24, '20.如何报名参与课程', '点击您想了解的课程，进入课程详情页面。选择立即报名，进入支付页面完成支付。等待老师开始直播之后，系统会提示进入直播间（目前仅支持1对1直播教学）');
INSERT INTO `wenti` VALUES (25, '21.为什么电脑访问的视频无法播放？', '当您使用电脑访问时： -支持浏览器chrome10.0+,firefox4.0+.ie7.0+版本 -必须安装flash10+版本 -直播功能必须使用IE浏览器并安装iliveSDK插件');
INSERT INTO `wenti` VALUES (26, '22.什么是网约课？', '网约课是公司倾力打造的实用技能学习平台，主要为学习者提供海量，优质的课程，课程结构严谨，用户可以根据自己的学习程度，自主安排学习进度，为技能学习者提供贴心的一站式学习服务 网约课精选各类课程，与多家权威教育，培训机构建立合作，涵盖语言学习、文化教育、生活兴趣、职业发展、产品开发等门类，从用户生活，职业，娱乐等多个维度，为用户打造实用的学习平台 网约课目前有web端，移动端（android，ios）');
INSERT INTO `wenti` VALUES (27, '23.如何观看直播课程？', '点击您想了解的课程，进入课程详情页面。选择立即报名，进入支付页面完成支付。等待老师开始直播之后，即可观看直播。');
INSERT INTO `wenti` VALUES (28, '24约课时间选错了，能取消么?', '您可以通过拨打客服电话，通过人工客服的方式获取帮助。');
INSERT INTO `wenti` VALUES (29, '25.如何充值及购买课程？', '您可以点击屏幕右上方头像，选择个人资料进入后台。点击左侧“我的账户”进行充值即可。充值完成后即可选择对应课程进行购买。');
INSERT INTO `wenti` VALUES (30, '26.如何查看可用余额及交易明细？', '您可以点击屏幕右上方头像，选择个人资料进入后台。点击左侧“我的账户”，即可查看可用余额及交易明细。');
INSERT INTO `wenti` VALUES (31, '27.如何设置，修改支付密码？', '您可以点击屏幕右上方头像，选择个人资料进入后台。点击左侧“我的账户”，即可设置及修改支付密码');
INSERT INTO `wenti` VALUES (32, '28.积分的作用？', '您可以通过积分兑换约课币或在积分商城兑换您心仪的产品。');
INSERT INTO `wenti` VALUES (33, '29.如何获取积分？', '您可以通过签到，活动，充值等方式获取积分。');
INSERT INTO `wenti` VALUES (34, '30.如何使用积分兑换礼品？', '您可以通过点击个人头像，选择积分商城，兑换您心仪的礼品。');
INSERT INTO `wenti` VALUES (35, '31.已充值费用能否退还（错过直播怎么办）？', '已充值的费用无法退还，建议您使用余下约课币购买其他课程。 如因老师无法按时授课导致错过直播，您可以通过拨打客服电话，申请仲裁。');
INSERT INTO `wenti` VALUES (36, '32.约课币可以兑换现金么？', '约课币无法兑换现金，建议您使用余下约课币购买其他课程 。');
INSERT INTO `wenti` VALUES (37, '33.如何查看收益明细？', '完成老师身份认证后，进入我的课堂，选择我的收益即可查看收益明细。');
INSERT INTO `wenti` VALUES (38, '34.如何提现？', '完成老师身份认证后,即可在个人后台进行提现。');
INSERT INTO `wenti` VALUES (39, '35.提现未到账？', '一般情况下，费用会在24小时内到账，如24小时未到账，您可以通过联系在线客服的方式获得帮助。');
INSERT INTO `wenti` VALUES (40, '36.提现是否要收取手续费？', '为了提高广大教师的收益,目前在网站提现免收手续费。');
INSERT INTO `wenti` VALUES (41, '37.约课币的充值比例是多少？', ' 约课币的充值比例为1比1。');
INSERT INTO `wenti` VALUES (42, '什么是保证金?', '保证金是根据《网约课网保证金协议》约定的条款和条件及网约课网其他公示规则的规定自愿交存的资金。在您尚未获取教师资格认证且严重违反网约课网协议时，用于对与您在网约课网中达成授课意向或产生交易事实的网约课网会员进行赔付的资金    缴纳保证金的好处： 未取得教师资格证的用户，可通过缴纳保证金的形式进行授课');
INSERT INTO `wenti` VALUES (43, '必须缴纳保证金么?', '未取得教师身份证或未获得教师担保且希望在网约课网进行授课的用户需要缴纳保证金 保证金如何缴纳： 可以在资格认证页面，通过联系客服的方式缴纳保证金。 保证金价格：1000元');
INSERT INTO `wenti` VALUES (44, '保证金能退么？ ', '在未严重违反网约课网协议的情况下，保证金可全额取回。');

-- ----------------------------
-- Table structure for withdraw
-- ----------------------------
DROP TABLE IF EXISTS `withdraw`;
CREATE TABLE `withdraw`  (
  `withdraw_id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '用户id',
  `bankcard` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '银行卡号',
  `time` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '提现时间',
  `status` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0' COMMENT '提现状态  0：提现中  1：成功  2：失败',
  `money` float(255, 2) NOT NULL COMMENT '金额',
  `order` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '交易单号',
  PRIMARY KEY (`withdraw_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 50 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of withdraw
-- ----------------------------
INSERT INTO `withdraw` VALUES (1, 6, '6228482218474382476', '1518331376', '1', 0.00, '天天');
INSERT INTO `withdraw` VALUES (2, 6, '6228482218474382476', '1518331410', '0', 0.00, NULL);
INSERT INTO `withdraw` VALUES (3, 6, '6228482218474382476', '1518331485', '0', 0.00, NULL);
INSERT INTO `withdraw` VALUES (4, 6, '6228482218474382476', '1518331499', '0', 0.00, NULL);
INSERT INTO `withdraw` VALUES (5, 6, '6228482218474382476', '1518331717', '1', 100.00, '官方给狗狗');
INSERT INTO `withdraw` VALUES (6, 6, '6228482218474382476', '1518333398', '1', 100.00, '566666666');
INSERT INTO `withdraw` VALUES (7, 6, '6228482218474382476', '1518342109', '0', 100.00, NULL);
INSERT INTO `withdraw` VALUES (8, 6, '6228482218474382476', '1518342630', '0', 100.00, NULL);
INSERT INTO `withdraw` VALUES (10, 30, '6210810730013146064', '1518414423', '1', 100.00, NULL);
INSERT INTO `withdraw` VALUES (11, 48, '6216610500006748161', '1518487638', '0', 100.00, NULL);
INSERT INTO `withdraw` VALUES (12, 48, '6216610500006748161', '1518488115', '0', 111.00, NULL);
INSERT INTO `withdraw` VALUES (13, 48, '6216610500006748161', '1518488129', '0', 100.00, NULL);
INSERT INTO `withdraw` VALUES (14, 48, '6216610500006748161', '1518488213', '0', 100.00, NULL);
INSERT INTO `withdraw` VALUES (15, 48, '6216610500006748161', '1518488435', '0', 100.00, NULL);
INSERT INTO `withdraw` VALUES (16, 48, '6216610500006748161', '1518488442', '0', 100.00, NULL);
INSERT INTO `withdraw` VALUES (17, 48, '6216610500006748161', '1518488453', '0', 100.00, NULL);
INSERT INTO `withdraw` VALUES (18, 48, '6216610500006748161', '1518488644', '0', 100.00, NULL);
INSERT INTO `withdraw` VALUES (19, 48, '6216610500006748161', '1518488658', '0', 100.00, NULL);
INSERT INTO `withdraw` VALUES (20, 48, '6216610500006748161', '1518488687', '0', 200.00, NULL);
INSERT INTO `withdraw` VALUES (21, 48, '6216610500006748161', '1518488749', '0', 300.00, NULL);
INSERT INTO `withdraw` VALUES (22, 6, 'qwewqeqwewqewq', '1518488834', '0', 100.00, NULL);
INSERT INTO `withdraw` VALUES (23, 6, 'qwewqeqwewqewq', '1518488852', '0', 100.00, NULL);
INSERT INTO `withdraw` VALUES (24, 48, '6216610500006748161', '1518488883', '0', 300.00, NULL);
INSERT INTO `withdraw` VALUES (25, 6, 'qwewqeqwewqewq', '1518488909', '0', 100.00, NULL);
INSERT INTO `withdraw` VALUES (26, 6, 'qwewqeqwewqewq', '1518488921', '0', 200.00, NULL);
INSERT INTO `withdraw` VALUES (27, 6, 'qwewqeqwewqewq', '1518488933', '0', 200.00, NULL);
INSERT INTO `withdraw` VALUES (28, 6, 'qwewqeqwewqewq', '1518488948', '0', 200.00, NULL);
INSERT INTO `withdraw` VALUES (29, 6, 'qwewqeqwewqewq', '1518488963', '0', 200.00, NULL);
INSERT INTO `withdraw` VALUES (30, 6, 'qwewqeqwewqewq', '1518488979', '0', 200.00, NULL);
INSERT INTO `withdraw` VALUES (31, 6, 'qwewqeqwewqewq', '1518488999', '0', 200.00, NULL);
INSERT INTO `withdraw` VALUES (32, 48, '6216610500006748161', '1518489107', '0', 100.00, NULL);
INSERT INTO `withdraw` VALUES (33, 48, '6216610500006748161', '1518489140', '0', 100.00, NULL);
INSERT INTO `withdraw` VALUES (34, 30, '6210810730013146064', '1519626566', '1', 100.00, NULL);
INSERT INTO `withdraw` VALUES (35, 30, '6210810730013146064', '1519626749', '1', 1000.00, NULL);
INSERT INTO `withdraw` VALUES (36, 30, '6210810730013146064', '1519626776', '1', 515.00, NULL);
INSERT INTO `withdraw` VALUES (37, 30, '6210810730013146064', '1519626954', '1', 1111.00, '555555555');
INSERT INTO `withdraw` VALUES (38, 30, '6210810730013146064', '1519627053', '1', 889.00, '58978456123558544');
INSERT INTO `withdraw` VALUES (39, 61, '6216610500006748161', '1519716919', '1', 111.00, '4545646564');
INSERT INTO `withdraw` VALUES (40, 30, '6210810730013146064', '1519813246', '1', 100.00, '555555555');
INSERT INTO `withdraw` VALUES (41, 72, '6216610500006748161', '1519815771', '1', 1000.00, '56666666665656');
INSERT INTO `withdraw` VALUES (42, 30, '6210810766658954561', '1520321498', '0', 3000.00, NULL);
INSERT INTO `withdraw` VALUES (43, 30, '6210810766658954561', '1520321516', '0', 1000.00, NULL);
INSERT INTO `withdraw` VALUES (44, 99, '6225881243946501', '1520916958', '0', 100.00, NULL);
INSERT INTO `withdraw` VALUES (45, 99, '1212', '1521532303', '0', 100.00, NULL);
INSERT INTO `withdraw` VALUES (46, 30, '6210810766658954561', '1521537073', '0', 100.00, NULL);
INSERT INTO `withdraw` VALUES (47, 99, '622588', '1522141258', '1', 100.00, 'ewqewqewqew');
INSERT INTO `withdraw` VALUES (48, 99, '622588', '1522141619', '1', 100.00, '11111111111111111');
INSERT INTO `withdraw` VALUES (49, 99, '622588', '1522141903', '1', 100.00, '22222222222222');

-- ----------------------------
-- Table structure for wxpay
-- ----------------------------
DROP TABLE IF EXISTS `wxpay`;
CREATE TABLE `wxpay`  (
  `wxpay_id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '用户id',
  `order_num` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '微信订单号',
  `money` float(255, 0) NOT NULL COMMENT '订单金额',
  `status` varchar(1) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '订单状态  0：待支付   1：成功  2：失败',
  `body` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '商品介绍',
  `product_id` int(11) NOT NULL COMMENT '产品id',
  `time` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '时间',
  PRIMARY KEY (`wxpay_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 354 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of wxpay
-- ----------------------------
INSERT INTO `wxpay` VALUES (226, 6, '1518153540', 600, '0', '平台充值', 600, '1518153540');
INSERT INTO `wxpay` VALUES (227, 48, 'GtzX97yZ0fh', 6, '0', '平台充值', 6, '1518156264');
INSERT INTO `wxpay` VALUES (228, 48, 'hhntd8bzUJH', 6, '1', '平台充值', 6, '1518160103');
INSERT INTO `wxpay` VALUES (229, 48, 'Dz78zGIAzgU', 6, '1', '平台充值', 6, '1518160501');
INSERT INTO `wxpay` VALUES (230, 48, 'qwGLq63jEMl', 600, '0', '平台充值', 6, '1518161257');
INSERT INTO `wxpay` VALUES (231, 48, 'sNwNT4V4oNO', 600, '0', '平台充值', 6, '1518161305');
INSERT INTO `wxpay` VALUES (232, 6, '3mlFOUpGNeL', 600, '1', '平台充值', 600, '1518161477');
INSERT INTO `wxpay` VALUES (233, 48, '4firGtrYkq4', 600, '1', '平台充值', 6, '1518161479');
INSERT INTO `wxpay` VALUES (234, 6, 'dRTJ9wpUcve', 600, '1', '平台充值', 600, '1518161520');
INSERT INTO `wxpay` VALUES (235, 40, 'KunZlxpHDYo', 600, '1', '平台充值', 6, '1518162032');
INSERT INTO `wxpay` VALUES (236, 40, '5kxJf9bhj0W', 600, '1', '平台充值', 6, '1518162791');
INSERT INTO `wxpay` VALUES (237, 40, 'XseSxCHhZFO', 600, '0', '平台充值', 6, '1518163016');
INSERT INTO `wxpay` VALUES (238, 6, 'AYXcexEotl9', 100, '0', '平台充值', 1, '1518165164');
INSERT INTO `wxpay` VALUES (239, 40, 'oLZw9Br6hWH', 600, '0', '平台充值', 6, '1518165494');
INSERT INTO `wxpay` VALUES (240, 40, 'rRUffzCXjQq', 600, '0', '平台充值', 6, '1518165500');
INSERT INTO `wxpay` VALUES (241, 40, 'QfTICesSDsc', 600, '0', '平台充值', 6, '1518165517');
INSERT INTO `wxpay` VALUES (242, 40, 'VeqaZFkHlxz', 600, '0', '平台充值', 6, '1518165838');
INSERT INTO `wxpay` VALUES (243, 40, 'voTkPBWz056', 600, '1', '平台充值', 6, '1518167568');
INSERT INTO `wxpay` VALUES (244, 40, 'FhU9TgwQTcV', 600, '1', '平台充值', 6, '1518168213');
INSERT INTO `wxpay` VALUES (245, 6, 'Q3xkSgGLev1', 600, '0', '平台充值', 600, '1518174849');
INSERT INTO `wxpay` VALUES (246, 6, 'QxFyDgKCXZY', 44800, '0', '平台充值', 44800, '1518174881');
INSERT INTO `wxpay` VALUES (247, 30, 'bcQCtlHWgEh', 600, '0', '平台充值', 600, '1518499779');
INSERT INTO `wxpay` VALUES (248, 30, 'd38QatrtnTt', 600, '1', '平台充值', 600, '1519709516');
INSERT INTO `wxpay` VALUES (249, 30, '5vw1O9dHLUj', 600, '0', '平台充值', 600, '1519709587');
INSERT INTO `wxpay` VALUES (250, 30, 'sKsI7a7soFB', 600, '1', '平台充值', 600, '1519714227');
INSERT INTO `wxpay` VALUES (251, 61, 'n5eBwFqB7JO', 600, '0', '平台充值', 6, '1519714581');
INSERT INTO `wxpay` VALUES (252, 58, 'ZkHxtcDt1Jb', 25800, '0', '平台充值', 25800, '1519715510');
INSERT INTO `wxpay` VALUES (253, 74, 'TNwGk8F1KdU', 600, '1', '平台充值', 6, '1519780683');
INSERT INTO `wxpay` VALUES (254, 30, 'DVpM1bMHkJk', 600, '0', '平台充值', 600, '1519813097');
INSERT INTO `wxpay` VALUES (255, 72, '6mz8bqGaXsk', 600, '1', '平台充值', 6, '1519815870');
INSERT INTO `wxpay` VALUES (256, 53, 'DgXf8Ig3zOe', 600, '0', '平台充值', 6, '1519816735');
INSERT INTO `wxpay` VALUES (257, 81, 'XcqylARvnE2', 600, '0', '平台充值', 600, '1520213235');
INSERT INTO `wxpay` VALUES (258, 82, 'iEFbbXpJjLT', 25800, '0', '平台充值', 25800, '1520235846');
INSERT INTO `wxpay` VALUES (259, 82, 'DF4EZZ39TsG', 1200, '0', '平台充值', 1200, '1520235946');
INSERT INTO `wxpay` VALUES (260, 58, 'NSgmomM69we', 33800, '0', '平台充值', 33800, '1520240492');
INSERT INTO `wxpay` VALUES (261, 96, 'ruQIyPFlrtX', 600, '0', '平台充值', 600, '1520472559');
INSERT INTO `wxpay` VALUES (262, 83, 'TIe0twCvB9x', 33800, '0', '平台充值', 33800, '1520562114');
INSERT INTO `wxpay` VALUES (263, 83, 'kIsxrnF54lh', 600, '0', '平台充值', 600, '1520562127');
INSERT INTO `wxpay` VALUES (264, 99, '71G5v8lN6i8', 600, '0', '平台充值', 600, '1520591264');
INSERT INTO `wxpay` VALUES (265, 99, 'npVstK85iAA', 0, '0', '平台充值', 0, '1520592000');
INSERT INTO `wxpay` VALUES (266, 99, 'hPCCm4BrCXZ', 0, '0', '平台充值', 0, '1520592001');
INSERT INTO `wxpay` VALUES (267, 30, 'm39aM1w2TMM', 600, '0', '平台充值', 600, '1520836221');
INSERT INTO `wxpay` VALUES (268, 101, 'hCQCwUWhnxR', 600, '0', '平台充值', 6, '1520920253');
INSERT INTO `wxpay` VALUES (269, 95, '7bZcJ7d8CO1', 100, '1', '平台充值', 100, '1520920494');
INSERT INTO `wxpay` VALUES (270, 99, 'pbrzZRSYSQU', 600, '0', '平台充值', 6, '1520924306');
INSERT INTO `wxpay` VALUES (271, 99, 'Dp8RQtMAgWW', 100, '0', '平台充值', 1, '1520928910');
INSERT INTO `wxpay` VALUES (272, 99, 'yMe0OYEUjMC', 100, '1', '平台充值', 1, '1520928990');
INSERT INTO `wxpay` VALUES (273, 99, 'f5Bsa2kStGy', 100, '0', '平台充值', 1, '1520929051');
INSERT INTO `wxpay` VALUES (274, 99, 'l03nczJnTYl', 100, '0', '平台充值', 1, '1520929069');
INSERT INTO `wxpay` VALUES (275, 99, 'qxSXKD8b2J9', 100, '1', '平台充值', 1, '1520929315');
INSERT INTO `wxpay` VALUES (276, 30, 'NWIr20wSqP4', 100, '0', '平台充值', 100, '1521015761');
INSERT INTO `wxpay` VALUES (277, 83, '0vsegfb1rFg', 12800, '0', '平台充值', 12800, '1521097965');
INSERT INTO `wxpay` VALUES (278, 111, 'Jm4fb4tKc79', 100, '0', '平台充值', 100, '1521427283');
INSERT INTO `wxpay` VALUES (279, 115, '0sv49NkrDCj', 100, '0', '平台充值', 100, '1521526745');
INSERT INTO `wxpay` VALUES (280, 99, 'fPyyfir6fP5', 100, '0', '平台充值', 100, '1521533410');
INSERT INTO `wxpay` VALUES (281, 99, 'wJ74bxUouoq', 1200, '0', '平台充值', 1200, '1521533417');
INSERT INTO `wxpay` VALUES (282, 99, '04wGJw2Dl8E', 100, '0', '平台充值', 100, '1521533422');
INSERT INTO `wxpay` VALUES (283, 99, 'zMCVGO7Yr4a', 44800, '0', '平台充值', 44800, '1521533757');
INSERT INTO `wxpay` VALUES (284, 99, 'ClsPbTY5hlG', 44800, '0', '平台充值', 44800, '1521533844');
INSERT INTO `wxpay` VALUES (285, 99, 'hWBjNWHqDdc', 100, '0', '平台充值', 100, '1521534185');
INSERT INTO `wxpay` VALUES (286, 99, '6ORX2jlqzLQ', 1200, '0', '平台充值', 1200, '1521534252');
INSERT INTO `wxpay` VALUES (287, 99, 'AQELZ3GzFfF', 3000, '0', '平台充值', 3000, '1521534265');
INSERT INTO `wxpay` VALUES (288, 99, '1QidcicVP1g', 5000, '0', '平台充值', 5000, '1521534281');
INSERT INTO `wxpay` VALUES (289, 99, 'Pi7M1fyxL4t', 12800, '0', '平台充值', 12800, '1521534293');
INSERT INTO `wxpay` VALUES (290, 99, 'qrpxwItV08A', 25800, '0', '平台充值', 25800, '1521534304');
INSERT INTO `wxpay` VALUES (291, 99, 'mVY7v2DOtVh', 33800, '0', '平台充值', 33800, '1521534317');
INSERT INTO `wxpay` VALUES (292, 115, 'I2ycFDa28X4', 100, '0', '平台充值', 1, '1521600701');
INSERT INTO `wxpay` VALUES (293, 115, 'AufL37Z1LUt', 100, '1', '平台充值', 1, '1521600758');
INSERT INTO `wxpay` VALUES (294, 115, 'Z6kujUDfB3b', 100, '0', '平台充值', 1, '1521600868');
INSERT INTO `wxpay` VALUES (295, 117, 'wHUDHvYvEPG', 100, '0', '平台充值', 1, '1521620796');
INSERT INTO `wxpay` VALUES (296, 117, '9Xmwelqqn9n', 100, '1', '平台充值', 1, '1521620813');
INSERT INTO `wxpay` VALUES (297, 99, 'FSPXPmPT3FS', 600, '0', '平台充值', 6, '1521698799');
INSERT INTO `wxpay` VALUES (298, 99, '3WVW6z2LuRa', 600, '0', '平台充值', 6, '1521698801');
INSERT INTO `wxpay` VALUES (299, 99, 'dGSh3SDWs4y', 1200, '0', '平台充值', 12, '1521698831');
INSERT INTO `wxpay` VALUES (300, 99, '39qyPGrGfiK', 3000, '0', '平台充值', 30, '1521698841');
INSERT INTO `wxpay` VALUES (301, 99, 'KZ45A4WE750', 5000, '0', '平台充值', 50, '1521698847');
INSERT INTO `wxpay` VALUES (302, 99, '7HBFzfDXAgG', 12800, '0', '平台充值', 128, '1521698851');
INSERT INTO `wxpay` VALUES (303, 99, 'kuGZPA7kpoq', 25800, '0', '平台充值', 258, '1521698856');
INSERT INTO `wxpay` VALUES (304, 99, 'kgV2e7HZF65', 33800, '0', '平台充值', 338, '1521698861');
INSERT INTO `wxpay` VALUES (305, 99, 'DJPZsH3ZzM0', 44800, '0', '平台充值', 448, '1521698874');
INSERT INTO `wxpay` VALUES (306, 99, 'EPceviIl9Za', 100, '0', '平台充值', 100, '1522037147');
INSERT INTO `wxpay` VALUES (307, 99, 'RRtmTGeIEcA', 1200, '0', '平台充值', 1200, '1522040956');
INSERT INTO `wxpay` VALUES (308, 99, 'uu3ZK39GmRN', 100, '0', '平台充值', 100, '1522284568');
INSERT INTO `wxpay` VALUES (309, 99, 'RuGNKvIxmj2', 1200, '0', '平台充值', 1200, '1522284630');
INSERT INTO `wxpay` VALUES (310, 99, 'kvhds96l0pa', 100, '0', '平台充值', 100, '1522284633');
INSERT INTO `wxpay` VALUES (311, 99, 'raLt0uLe35F', 600, '0', '平台充值', 6, '1522390978');
INSERT INTO `wxpay` VALUES (312, 99, 'vsCRlzpi2cP', 600, '0', '平台充值', 6, '1522394829');
INSERT INTO `wxpay` VALUES (313, 6, 'Ir8aAVZuK1K', 100, '0', '平台充值', 100, '1522397365');
INSERT INTO `wxpay` VALUES (314, 6, 'xqd6W31eUCC', 1200, '0', '平台充值', 1200, '1522397368');
INSERT INTO `wxpay` VALUES (315, 6, 'jPotv75y7qW', 1200, '0', '平台充值', 1200, '1522398352');
INSERT INTO `wxpay` VALUES (316, 6, 'RWG3WO3QE8e', 0, '0', '平台充值', 0, '1522631835');
INSERT INTO `wxpay` VALUES (317, 6, '4JAFCsFwmus', 0, '0', '平台充值', 0, '1522631840');
INSERT INTO `wxpay` VALUES (318, 6, 'dHSDqKRGRwy', 0, '0', '平台充值', 0, '1522632678');
INSERT INTO `wxpay` VALUES (319, 6, '4Jw2tfwLgNz', 0, '0', '平台充值', 0, '1522632680');
INSERT INTO `wxpay` VALUES (320, 6, 'Uxcmf3mZws4', 0, '0', '平台充值', 0, '1522632680');
INSERT INTO `wxpay` VALUES (321, 6, 'p7VaT99K9aE', 0, '0', '平台充值', 0, '1522632680');
INSERT INTO `wxpay` VALUES (322, 6, 'CkS48zQjFAX', 0, '0', '平台充值', 0, '1522632681');
INSERT INTO `wxpay` VALUES (323, 6, 'WSlre9YbzuC', 0, '0', '平台充值', 0, '1522632681');
INSERT INTO `wxpay` VALUES (324, 6, 'vwkwZOjEwlu', 1200, '0', '平台充值', 1200, '1522632684');
INSERT INTO `wxpay` VALUES (325, 6, '8QEuL4Uu7RA', 3000, '0', '平台充值', 3000, '1522632689');
INSERT INTO `wxpay` VALUES (326, 6, '2afCqH1lSMr', 0, '0', '平台充值', 0, '1522632693');
INSERT INTO `wxpay` VALUES (327, 6, 'NJSbxqfco0d', 0, '0', '平台充值', 0, '1522632693');
INSERT INTO `wxpay` VALUES (328, 6, 'iq2oeJiTfD8', 0, '0', '平台充值', 0, '1522632694');
INSERT INTO `wxpay` VALUES (329, 6, 'aAexg5srbcd', 5000, '0', '平台充值', 5000, '1522632696');
INSERT INTO `wxpay` VALUES (330, 30, 'y8V42HX4eB3', 0, '0', '平台充值', 0, '1522634846');
INSERT INTO `wxpay` VALUES (331, 30, 'VcnQNVrwuWK', 0, '0', '平台充值', 0, '1522634849');
INSERT INTO `wxpay` VALUES (332, 30, 'UbONrP7SH4e', 0, '0', '平台充值', 0, '1522634849');
INSERT INTO `wxpay` VALUES (333, 30, 'PNAibyKxoSD', 0, '0', '平台充值', 0, '1522634850');
INSERT INTO `wxpay` VALUES (334, 30, 'VaL5RnsyccT', 0, '0', '平台充值', 0, '1522634850');
INSERT INTO `wxpay` VALUES (335, 30, '18MtYWN9BLI', 0, '0', '平台充值', 0, '1522634850');
INSERT INTO `wxpay` VALUES (336, 30, '6zw6DzLmu7L', 0, '0', '平台充值', 0, '1522634851');
INSERT INTO `wxpay` VALUES (337, 30, 'pZA7dBT6dV9', 0, '0', '平台充值', 0, '1522634851');
INSERT INTO `wxpay` VALUES (338, 30, 'eb2Aix9f5Vd', 0, '0', '平台充值', 0, '1522634851');
INSERT INTO `wxpay` VALUES (339, 30, 'Sdh4eSyOLMM', 0, '0', '平台充值', 0, '1522634852');
INSERT INTO `wxpay` VALUES (340, 30, 'S9d6qpRID0K', 1200, '0', '平台充值', 1200, '1522634853');
INSERT INTO `wxpay` VALUES (341, 30, '60r5u6IitNV', 1200, '0', '平台充值', 1200, '1522634853');
INSERT INTO `wxpay` VALUES (342, 30, 'sQz6e8ExCca', 0, '0', '平台充值', 0, '1522634862');
INSERT INTO `wxpay` VALUES (343, 30, 'tkMNjOrifIW', 0, '0', '平台充值', 0, '1522634865');
INSERT INTO `wxpay` VALUES (344, 30, 'aIRQFjNKPFG', 1200, '0', '平台充值', 1200, '1522634870');
INSERT INTO `wxpay` VALUES (345, 30, 'rRkGyHHf0Q6', 3000, '0', '平台充值', 3000, '1522634876');
INSERT INTO `wxpay` VALUES (346, 30, 'lehfGRFoXQO', 0, '0', '平台充值', 0, '1522634880');
INSERT INTO `wxpay` VALUES (347, 99, 'oLjrI8mavsI', 100, '0', '平台充值', 100, '1522650817');
INSERT INTO `wxpay` VALUES (348, 99, '9iQD6sexbBz', 600, '0', '平台充值', 6, '1522652962');
INSERT INTO `wxpay` VALUES (349, 99, 'VSAt8OkklCM', 600, '0', '平台充值', 6, '1522652963');
INSERT INTO `wxpay` VALUES (350, 53, 'oMMXHdThisy', 600, '0', '平台充值', 6, '1522725220');
INSERT INTO `wxpay` VALUES (351, 6, 'BXtpLZsDHwK', 100, '0', '平台充值', 1, '1522725366');
INSERT INTO `wxpay` VALUES (352, 6, 'axEoNHD8RLq', 100, '0', '平台充值', 1, '1522726517');
INSERT INTO `wxpay` VALUES (353, 70, 'EMI1OhJO8N1', 100, '0', '平台充值', 1, '1522740626');

-- ----------------------------
-- Table structure for xieyi
-- ----------------------------
DROP TABLE IF EXISTS `xieyi`;
CREATE TABLE `xieyi`  (
  `xieyi_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '标题',
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '内容',
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0' COMMENT '类型',
  PRIMARY KEY (`xieyi_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 19 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of xieyi
-- ----------------------------
INSERT INTO `xieyi` VALUES (5, '版权声明	', '<h1 label=\"标题居中\" style=\"font-size: 32px; font-weight: bold; border-bottom: 2px solid rgb(204, 204, 204); padding: 0px 4px 0px 0px; text-align: center; margin: 0px 0px 20px;\"><span style=\"font-family: 宋体; font-size: 36px;\">版权声明</span>&nbsp;&nbsp;</h1><p style=\"text-indent:28px\"><span style=\"font-size:19px\">1.</span><span style=\"font-size:19px;font-family:宋体\">网约课仅为用户提供一个交流、分享的平台，<strong>网约课用户在网约课中分享、发布、展示的所有内容均由用户自行上传，故网约课没有能力审查这些内容是否存在侵权等情节，</strong>但为切实维护权利人的合法权益，网约课将依据《中华人民共和国侵权责任法》、《中国人民共和国著作权法》、《信息网络传播权保护条例》等法律法规及相关规章制度的规定，采取相关知识产权保护措施。</span></p><p style=\"text-indent:28px\"><span style=\"font-size:19px\">2.</span><span style=\"font-size:19px;font-family:宋体\">网约课对于有理由确信存在明显侵权、违法、违反公共利益等情形的作品，网约课有权不事先通知并有权删除该等作品。</span></p><p style=\"text-indent:28px\"><span style=\"font-size:19px\">3.</span><span style=\"font-size:19px;font-family:宋体\">网约课用户在网约课平台所发布展示的原创作品、原创文章，版权归作者所有。用户在网约课平台上发布的原创内容，视作授权其作品使用在网约课平台上（网约课平台包括网约课，以及</span><span style=\"font-size:19px;font-family:&#39;Arial&#39;,&#39;sans-serif&#39;;color:#444444\">www.wyuek.com</span><span style=\"font-size:19px;font-family:宋体;color:#444444\">及客户端各系统版本</span><span style=\"font-size:19px;font-family:宋体\">）。在未得到著作权人的授权时，请不要将他人的作品全部或部分复制发表到网约课平台，如转载站外信息到网约课平台请署著作权人名并注明出处。</span></p><p style=\"text-indent:28px\"><span style=\"font-size:19px\">4. </span><span style=\"font-size:19px;font-family:宋体\">网约课平台支持权利人（包括版权人、肖像权人等）将侵权情况告知网约课平台，网约课平台也愿意与权利人合作净化网络空间，减少侵权行为的发生。如个人或单位发现网约课平台上存在侵犯其自身合法权益的内容，请及时与网约课取得联系，并提供具有法律效力的证明材料，以便网约课作出处理。网约课有权根据实际情况删除相关的内容，并追究相关用户的法律责任。给网约课或任何第三方造成损失的，侵权用户应负全部责任并赔偿损失。</span></p><p style=\"text-indent:28px\"><span style=\"font-size:19px\">5.</span><span style=\"font-size:19px;font-family:宋体\">网约课用户提供下载连接的个人作品（包括素材、软件、工具、书籍等），版权均归原作者所有。本站仅供大家学习与参考，请勿使用于商业用途。如需作商业用途，请与原作者联系。</span></p><p style=\"text-indent:28px\"><span style=\"font-size:19px\">6.</span><span style=\"font-size:19px;font-family:宋体\">当网约课用户的言论和行为侵犯了第三方的著作权或其他权利，责任在于用户本人，网约课不承担任何法律责任。</span></p><p style=\"text-indent:28px\"><span style=\"font-size:19px\">7.</span><strong><span style=\"font-size:19px;font-family:宋体\">本站用户所发言论仅代表网友个人，不代表本站观点。</span></strong><span style=\"font-size:19px;font-family:宋体\">在网约课发表言论的网友，我们认为用户已经知道并理解这一声明。</span></p><p style=\"text-indent:28px\"><span style=\"font-size:19px\">8.</span><span style=\"font-size:19px;font-family:宋体\">以上版权声明并不包含由本网站链接到的属于其他方的网站之内容。本网站不对该等其他链接网站的内容负责，任何对其他网站的链接仅为本网站用户的方便而设。</span></p><p><span style=\"font-size:19px;font-family:宋体\">著作权声明：</span></p><p style=\"text-indent:28px\"><span style=\"font-size:19px\">1.</span><span style=\"font-size:19px;font-family:宋体\">除特别指明外，本网站的结构、网页设计、文字、图像和其它信息等所有内容，其著作权均属网约课或其提供者所有。任何他人不得复制、修改或在非本公司网站所属的服务器上做镜像或者以其它方式进行非法使用。</span></p><p style=\"text-indent:28px\"><span style=\"font-size:19px\">2.</span><span style=\"font-size:19px;font-family:宋体\">本网站自主设计、编写、制作的内容和图像等的著作权权益均属于本公司所有，他人如需转载或以其它方式使用，必须取得本公司的书面许可，并在使用时注明来源和版权系本公司所有。</span></p><p style=\"text-indent:28px\"><span style=\"font-size:19px\">3.</span><span style=\"font-size:19px;font-family:宋体\">对于任何违反国家法律法规或有关法律规范，不尊重本网站声明，不经本公司同意，擅自使用本网站内容并不注明出处的行为，本公司将保留采取法律措施追究其法律责任的权利。</span></p><p><br/></p>', '0');
INSERT INTO `xieyi` VALUES (7, '法律声明', '<h1 label=\"标题居中\" style=\"font-size: 32px; font-weight: bold; border-bottom: 2px solid rgb(204, 204, 204); padding: 0px 4px 0px 0px; text-align: center; margin: 0px 0px 20px;\"><span style=\"line-height: 240%; font-family: 宋体; font-size: 36px;\">法律声明</span></h1><p><br/></p><p><span style=\"font-size:24px;font-family:宋体\"></span></p><p><span style=\"font-size:24px;font-family:宋体\">提示条款</span></p><p><span style=\"font-size:24px;font-family:宋体\">网约课提醒您：在使用网约课平台各项服务前，请您务必仔细阅读并全面理解本声明。如对本声明内容有任何疑问，您可向网约课平台客服咨询。阅读本声明的过程中，如果您不同意本声明或其中任何内容，您应立即停止使用网约课平台服务。<strong>如果您使用网约课平台服务，您的使用行为将被视为对本声明全部内容的认可。</strong></span></p><p><span style=\"font-size:24px;font-family:宋体\">定义</span></p><p><span style=\"font-size:24px;font-family:宋体\">网约课平台：指包括网约课（域名为</span><span style=\"font-size:24px\">www.wyuek.com</span><span style=\"font-size:24px;font-family:宋体\">）等网站及相应客户端。</span></p><p><span style=\"font-size:24px;font-family:宋体\">网约课：网约课平台经营者的单称或合称，包括网约课经营者天津天成众投科技有限公司等。</span></p><p><span style=\"font-size:24px;font-family:宋体\">知识产权声明</span></p><p><span style=\"font-size:24px;font-family:宋体\">一、知识产权归属</span></p><p><span style=\"font-size:24px;font-family:宋体\">除非网约课另行声明，网约课平台内的所有产品、技术、软件、程序、数据及其他信息（包括但不限于文字、图像、图片、照片、音频、视频、图表、色彩、版面设计、电子文档）的所有知识产权（包括但不限于版权、商标权、专利权、商业秘密等）及相关权利，均归网约课或其关联公司所有。未经网约课许可，任何人不得擅自使用（包括但不限于复制、传播、展示、镜像、上载、下载）。</span></p><p><span style=\"font-size:24px;font-family:宋体\">网约课平台的</span><span style=\"font-size:24px\">Logo</span><span style=\"font-size:24px;font-family:宋体\">、“网约课”、<strong>“</strong></span><strong><span style=\"font-size:24px\">wyuek</span></strong><strong><span style=\"font-size:24px;font-family:宋体\">”</span></strong><span style=\"font-size:24px;font-family:宋体\">等文字、图形及其组合，以及网约课平台的其他标识、徵记、产品和服务名称均为网约课及其关联公司在中国和其它国家的商标，未经网约课书面授权，任何人不得以任何方式展示、使用或作其他处理，也不得向他人表明您有权展示、使用或作其他处理。</span></p><p><span style=\"font-size:24px;font-family:宋体\">二、责任限制</span></p><p><span style=\"font-size:24px;font-family:宋体\">鉴于网约课平台提供的服务性质，网约课平台上的用户、商品信息（包括但不限于用户名称、公司名称、联系人及联络信息、产品的描述和说明、相关图片、视频等）均由用户自行提供并上传，由用户对其提供并上传的所有信息承担相应法律责任。</span></p><p><span style=\"font-size:24px;font-family:宋体\">网约课平台转载作品（包括评论内容）出于传递更多信息之目的，并不意味网约课赞同其观点或已经证实其内容的真实性。</span></p><p><span style=\"font-size:24px;font-family:宋体\">三、知识产权保护</span></p><p><span style=\"font-size:24px;font-family:宋体\">网约课尊重知识产权，反对侵权盗版行为。知识产权权利人认为网约课平台内容（包括但不限于网约课平台用户发布的信息）可能涉嫌侵犯其合法权益，可以通过网约课知识产权保护邮箱（</span><span style=\"font-size:24px\">tccm@tc024.cn</span><span style=\"font-size:24px;font-family:宋体\">）提出书面通知，或与网约课客服进行联系，网约课收到相应书面报文后将及时处理。</span></p><p><span style=\"font-size:24px;font-family:宋体\">隐私权政策</span></p><p><span style=\"font-size:24px;font-family:宋体\">网约课（下称“我们”）尊重用户个人信息的保护，在您使用网约课平台提供的服务时，我们将按照本隐私权政策收集、使用及共享您的个人信息。本隐私权政策包含了我们收集、存储、使用、共享和保护您的个人信息的条款，我们希望通过本隐私权政策向您清晰地介绍我们对您个人信息的处理方式，因此我们建议您完整地阅读本隐私权政策，以帮助您了解维护自己隐私权的方式。如您对本隐私权政策有任何疑问，您可以通过网约课平台公布的联系方式与我们联系。如果您不同意本隐私权政策任何内容，您应立即停止使用网约课平台服务。<strong>当您使用网约课平台提供的任一服务时，即表示您已同意我们按照本隐私权政策来合法使用和保护您的个人信息。</strong></span></p><p><span style=\"font-size:24px;font-family:宋体\">一、适用范围</span></p><p><span style=\"font-size:24px;font-family:宋体\">为用户提供更好、更优、更个性化的服务是网约课坚持不懈的追求，也希望通过我们提供的服务可以更方便您的生活。本隐私权政策适用于网约课平台提供的所有服务，您访问网约课平台网站或登陆相关客户端使用网约课平台提供的服务，均适用本隐私权政策。</span></p><p><span style=\"font-size:24px;font-family:宋体\">需要特别说明的是，本隐私权政策不适用于其他第三方向您提供的服务，例如网约课上的用户依托网约课平台向您提供服务时，您向用户提供的个人信息不适用于本隐私权政策。</span></p><p><span style=\"font-size:24px;font-family:宋体\">二、我们如何收集信息</span></p><p><span style=\"font-size:24px;font-family:宋体\">我们收集信息是为了向您提供更好、更优、更个性化的服务，我们收集信息的方式如下：</span></p><p><span style=\"font-size:24px\">1.</span><span style=\"font-size:24px;font-family:宋体\">您向我们提供的信息。当您注册网约课账户及您在使用网约课平台提供的相关服务时填写或提交的信息，包括您的姓名、性别、出生年月日、身份证号码、电话号码、电子邮箱、地址、支付宝账号及相关附加信息（如您所在的省份和城市、邮政编码等）。</span></p><p><span style=\"font-size:24px\">2.</span><span style=\"font-size:24px;font-family:宋体\">在您使用服务过程中收集的信息。为了提供并优化您需要的服务，我们会收集您使用服务的相关信息，这类信息包括：</span></p><p><span style=\"font-size:24px;font-family:宋体\">在您使用网约课平台服务，或访问网约课平台网页时，网约课自动接收并记录的您的浏览器和计算机上的信息，包括但不限于您的</span><span style=\"font-size:24px\">IP</span><span style=\"font-size:24px;font-family:宋体\">地址、浏览器的类型、使用的语言、访问日期和时间、软硬件特征信息及您需求的网页记录等数据；如您下载或使用网约课或其关联公司客户端软件，或访问移动网页使用网约课平台服务时，网约课可能会读取与您位置和移动设备相关的信息，包括但不限于设备型号、设备识别码、操作系统、分辨率、电信运营商等。</span></p><p><span style=\"font-size:24px;font-family:宋体\">除上述信息外，我们还可能为了提供服务及改进服务质量的合理需要而收集您的其他信息，包括您与我们的客户服务团队联系时您提供的相关信息，您参与问卷调查时向我们发送的问卷答复信息，以及您与网约课的关联方、网约课合作伙伴之间互动时我们收集的相关信息。与此同时，为提高您使用网约课平台所提供服务的安全性，更准确地预防钓鱼网站欺诈和木马病毒，我们可能会通过了解一些您的网络使用习惯、您常用的软件信息等手段来判断您账户的风险，并可能会记录一些我们认为有风险的</span><span style=\"font-size:24px\">URL</span><span style=\"font-size:24px;font-family:宋体\">。</span></p><p><span style=\"font-size:24px\">3.</span><span style=\"font-size:24px;font-family:宋体\">来自第三方的信息</span></p><p><span style=\"font-size:24px;font-family:宋体\">为了给您提供更好、更优、更加个性化的服务，或共同为您提供服务，或为了预防互联网欺诈的目的，网约课的关联方、合作伙伴会依据法律的规定或与您的约定或在征得您同意的前提下，向网约课分享您的个人信息。</span></p><p><span style=\"font-size:24px;font-family:宋体\">您了解并同意，以下信息不适用本隐私权政策：</span></p><p><span style=\"font-size:24px\">a</span><span style=\"font-size:24px;font-family:宋体\">）您在使用网约课平台提供的搜索服务时输入的关键字信息；</span></p><p><span style=\"font-size:24px\">b</span><span style=\"font-size:24px;font-family:宋体\">）在您未选择“匿名”或“匿名评价”功能时，网约课收集到的您在网约课平台进行交易的有关数据，包括但不限于出价、成交信息及评价详情；</span></p><p><span style=\"font-size:24px\">c</span><span style=\"font-size:24px;font-family:宋体\">）信用评价、违反法律规定或违反网约课规则行为及网约课已对您采取的措施；</span></p><p><span style=\"font-size:24px\">d)</span><span style=\"font-size:24px;font-family:宋体\">应法律法规要求需公示的企业名称等相关工商注册信息以及自然人经营者的信息。</span></p><p><span style=\"font-size:24px;font-family:宋体\">三、我们如何使用信息</span></p><p><span style=\"font-size:24px;font-family:宋体\">因收集您的信息是为了向您提供服务及提升服务质量的目的，为了实现这一目的，我们会把您的信息用于下列用途：</span></p><p><span style=\"font-size:24px\">1.</span><span style=\"font-size:24px;font-family:宋体\">向您提供您使用的各项服务，并维护、改进这些服务。</span></p><p><span style=\"font-size:24px\">2.</span><span style=\"font-size:24px;font-family:宋体\">向您推荐您可能感兴趣的内容，包括但不限于向您发出产品和服务信息，或通过系统向您展示个性化的第三方推广信息，或者在征得您同意的情况下与网约课的合作伙伴共享信息以便他们向您发送有关其产品和服务的信息。</span></p><p><span style=\"font-size:24px\">3.</span><span style=\"font-size:24px;font-family:宋体\">我们可能使用您的个人信息以预防、发现、调查欺诈、危害安全、非法或违反与我们或其关联方协议、政策或规则的行为，以保护您及其他用户，或我们及其关联方的合法权益。</span></p><p><span style=\"font-size:24px\">4.</span><span style=\"font-size:24px;font-family:宋体\">我们可能会将来自某项服务的个人信息与来自其他服务的信息结合起来，用于给您提供更加个性化的服务使用，例如让您拥有更广泛的社交圈之需要而使用、共享或披露。</span></p><p><span style=\"font-size:24px\">5.</span><span style=\"font-size:24px;font-family:宋体\">经您许可的其他用途。</span></p><p><span style=\"font-size:24px;font-family:宋体\">四、我们如何共享信息</span></p><p><span style=\"font-size:24px;font-family:宋体\">我们对您的信息承担保密义务，不会为满足第三方的营销目的而向其出售或出租您的任何信息，我们会在下列情况下才将您的信息与第三方共享：</span></p><p><span style=\"font-size:24px\">1.</span><span style=\"font-size:24px;font-family:宋体\">事先获得您的同意或授权。</span></p><p><span style=\"font-size:24px\">2.</span><span style=\"font-size:24px;font-family:宋体\">根据法律法规的规定或行政或司法机构的要求。</span></p><p><span style=\"font-size:24px\">3.</span><span style=\"font-size:24px;font-family:宋体\">向网约课的关联方分享您的个人信息。</span></p><p><span style=\"font-size:24px\">4.</span><span style=\"font-size:24px;font-family:宋体\">向可信赖的合作伙伴提供您的个人信息，让他们根据我们的指示并遵循我们的隐私权政策以及其他任何相应的保密和安全措施来为我们处理这些信息。</span></p><p><span style=\"font-size:24px\">5.</span><span style=\"font-size:24px;font-family:宋体\">如您是适格的知识产权投诉人并已提起投诉，应被投诉人要求，向被投诉人披露，以便双方处理可能的权利纠纷。</span></p><p><span style=\"font-size:24px\">6.</span><span style=\"font-size:24px;font-family:宋体\">只有共享您的信息，才能提供您需要的服务，或处理您与他人的纠纷或争议。例如您在网约课上创建的某一交易中，如交易任何一方履行或部分履行了交易义务并提出信息披露请求的，网约课会视情况向该用户提供其交易对方的联络方式等必要信息，以促成交易的完成或纠纷的解决。</span></p><p><span style=\"font-size:24px\">7.</span><span style=\"font-size:24px;font-family:宋体\">如您出现违反中国有关法律法规、其他法律规范或者网约课相关协议或相关规则的情况，需要向第三方披露。</span></p><p><span style=\"font-size:24px\">8.</span><span style=\"font-size:24px;font-family:宋体\">为维护网约课及其关联方或用户的合法权益。</span></p><p><span style=\"font-size:24px;font-family:宋体\">五、</span><span style=\"font-size:24px\">Cookie</span><span style=\"font-size:24px;font-family:宋体\">和网络</span><span style=\"font-size:24px\">Beacon</span><span style=\"font-size:24px;font-family:宋体\">的使用</span></p><p><span style=\"font-size:24px;font-family:宋体\">为使您获得更轻松的访问体验，您访问网约课平台相关网站或使用网约课平台提供的服务时，我们可能会通过小型数据文件识别您的身份，这么做是帮您省去重复输入注册信息的步骤，或者帮助判断您的账户安全。这些数据文件可能是</span><span style=\"font-size:24px\">Cookie</span><span style=\"font-size:24px;font-family:宋体\">，</span><span style=\"font-size:24px\">FlashCookie</span><span style=\"font-size:24px;font-family:宋体\">，或您的浏览器或关联应用程序提供的其他本地存储（统称“</span><span style=\"font-size:24px\">Cookie</span><span style=\"font-size:24px;font-family:宋体\">”）。</span></p><p><span style=\"font-size:24px;font-family:宋体\">请您理解，我们的某些服务只能通过使用“</span><span style=\"font-size:24px\">Cookie</span><span style=\"font-size:24px;font-family:宋体\">”才可得到实现。如果您的浏览器或浏览器附加服务允许，您可以修改对</span><span style=\"font-size:24px\">Cookie</span><span style=\"font-size:24px;font-family:宋体\">的接受程度或者拒绝网约课的</span><span style=\"font-size:24px\">Cookie</span><span style=\"font-size:24px;font-family:宋体\">，但这一举动在某些情况下可能会影响您安全访问网约课平台相关网站和使用网约课平台提供的服务。</span></p><p><span style=\"font-size:24px;font-family:宋体\">网页上常会包含一些电子图象（称为</span><span style=\"font-size:24px\">&quot;</span><span style=\"font-size:24px;font-family:宋体\">单像素</span><span style=\"font-size:24px\">&quot;GIF</span><span style=\"font-size:24px;font-family:宋体\">文件或</span><span style=\"font-size:24px\">&quot;</span><span style=\"font-size:24px;font-family:宋体\">网络</span><span style=\"font-size:24px\">beacon&quot;</span><span style=\"font-size:24px;font-family:宋体\">），使用网络</span><span style=\"font-size:24px\">beacon</span><span style=\"font-size:24px;font-family:宋体\">可以帮助网站计算浏览网页的用户或访问某些</span><span style=\"font-size:24px\">cookie</span><span style=\"font-size:24px;font-family:宋体\">，我们会通过网络</span><span style=\"font-size:24px\">beacon</span><span style=\"font-size:24px;font-family:宋体\">收集您浏览网页活动的信息，例如您访问的页面地址、您先前访问的援引页面的位址、您停留在页面的时间、您的浏览环境以及显示设定等。</span></p><p><span style=\"font-size:24px;font-family:宋体\">六、信息存储</span></p><p><span style=\"font-size:24px;font-family:宋体\">网约课收集的有关您的信息和资料将保存在网约课及（或）其关联公司的服务器上，这些信息和资料可能传送至您所在国家、地区或网约课收集信息和资料所在地并在该地被访问、存储和展示。</span></p><p><span style=\"font-size:24px;font-family:宋体\">七、您的个人信息保护</span></p><p><span style=\"font-size:24px;font-family:宋体\">为保障您的信息安全，我们努力采取各种合理的物理、电子和管理方面的安全措施来保护您的信息，使您的信息不会被泄漏、毁损或者丢失，包括但不限于</span><span style=\"font-size:24px\">SSL</span><span style=\"font-size:24px;font-family:宋体\">、信息加密存储、数据中心的访问控制。我们对可能接触到您的信息的员工或外包人员也采取了严格管理，包括但不限于根据岗位的不同采取不同的权限控制，与他们签署保密协议，监控他们的操作情况等措施。网约课会按现有技术提供相应的安全措施来保护您的信息，提供合理的安全保障，网约课将尽力做到使您的信息不被泄漏、毁损或丢失。</span></p><p><span style=\"font-size:24px;font-family:宋体\">您的账户均有安全保护功能，请妥善保管您的账户及密码信息。网约课将通过向其它服务器备份、对用户密码进行加密等安全措施确保您的信息不丢失，不被滥用和变造。尽管有前述安全措施，但同时也请您理解在信息网络上不存在“完善的安全措施”。</span></p><p><span style=\"font-size:24px;font-family:宋体\">在使用网约课平台服务进行网上交易时，您不可避免地要向交易对方或潜在的交易对方披露自己的个人信息，如联络方式或者邮政地址。请您妥善保护自己的个人信息，仅在必要的情形下向他人提供。如您发现自己的个人信息泄密，尤其是你的账户及密码发生泄露，请您立即联络网约课客服，以便网约课采取相应措施。</span></p><p><span style=\"font-size:24px;font-family:宋体\">八、未成年人保护</span></p><p><span style=\"font-size:24px;font-family:宋体\">我们不会在知情的情况下收集未成年人的个人信息，未成年必须在监护人陪同下使用网约课的各项服务（尤其支付交易服务），如果我们不小心收集到了未成年人的信息，我们在知情后会尽快删除。如果您认为我们可能不当地持有来自于或关于未成年人的信息，请联系我们。</span></p><p><span style=\"font-size:24px\">&nbsp;</span></p><p><span style=\"font-size:24px\"></span><br/></p><hr size=\"1\" width=\"33%\"/><p><a name=\"_msocom_1\"></a> </p><p><br/></p><p><br/></p>', '0');
INSERT INTO `xieyi` VALUES (8, '花边栏目发布须知', '<h1 label=\"标题居中\" style=\"font-size: 32px; font-weight: bold; border-bottom: 2px solid rgb(204, 204, 204); padding: 0px 4px 0px 0px; text-align: center; margin: 0px 0px 20px;\"><span style=\"font-family: 宋体; font-size: 36px;\">课程发布须知</span></h1><p><span style=\"font-size:24px;font-family:宋体\">课程发布须知</span></p><p><span style=\"font-size:24px\">1.</span><span style=\"font-size:24px;font-family:宋体\">本栏目仅适用于<strong>课程<a></a>的发布</strong>。如您的信息并不属于以上类型，请移步到其它栏目进行信息发布。</span></p><p><span style=\"font-size:24px\">2.</span><span style=\"font-size:24px;font-family:宋体\">为保证您的信息发挥更大价值，发布信息前请按照本栏目发布格式认真填写相关信息。</span></p><p><span style=\"font-size:24px;font-family:宋体\">注意</span><span style=\"font-size:24px\">:</span><span style=\"font-size:24px;font-family:宋体\">（</span><span style=\"font-size:24px\">1</span><span style=\"font-size:24px;font-family:宋体\">）项目地址为所发布信息中事件的发生地，并非用户</span><a></a><a></a><a id=\"_anchor_1\" href=\"file:///C:/Users/Administrator/Documents/WeChat%20Files/wlxiangxinni/Files/%E8%8A%B1%E8%BE%B9%E6%A0%8F%E7%9B%AE%E5%8F%91%E5%B8%83%E9%A1%BB%E7%9F%A5-%E5%AE%A1%E6%A0%B8%E7%89%88.doc#_msocom_1\" language=\"JavaScript\" name=\"_msoanchor_1\">[A1]</a>&nbsp;<span style=\"font-size:24px;font-family:宋体\">信息中所填写的个人或公司地址。</span></p><p><span style=\"font-size:24px;font-family:宋体\">（</span><span style=\"font-size:24px\">2</span><span style=\"font-size:24px;font-family:宋体\">）所发布的信息都有相对应的有效期限，如您填写的时间超过时效期限，则超出部分时间将不予展示。</span></p><p><span style=\"font-size:24px\">3.</span><span style=\"font-size:24px;font-family:宋体\">请使用文明用语，并确保您的发布及回复内容</span><span style=\"font-size:24px\">,</span><span style=\"font-size:24px;font-family:宋体\">符合相关法律法规、其他法律规范和网约课相关规则、协议。</span></p><p><span style=\"font-size:24px\">4.</span><span style=\"font-size:24px;font-family:宋体\">违反上述内容的信息，管理员有权予以删除，并酌情对发布者进行处罚。</span></p><p><span style=\"font-size:24px;font-family:宋体\">课程发布须知</span></p><p><span style=\"font-size:24px\">1.</span><span style=\"font-size:24px;font-family:宋体\">请按照提示准确填写发布信息，确保发布的信息标题、介绍，图片及视频与所发布的课程相符。</span></p><p><span style=\"font-size:24px\">2.</span><span style=\"font-size:24px;font-family:宋体\">请使用适当的方式宣传您的课程。为了达到更好的展示、宣传效果，所发布的课程必须有相应的配图或视频。</span></p><p><span style=\"font-size:24px\">3.</span><span style=\"font-size:24px;font-family:宋体\">请使用适当的方式宣传您的商品。请勿盗用他人图片或内容发布信息。请勿使用过于暴露的图片宣传商品。为了达到更好的展示、宣传效果，所发布的产品必须有相应的配图或视频。</span></p><p><span style=\"font-size:24px\">4.</span><span style=\"font-size:24px;font-family:宋体\">请确保您的发布及回复内容</span><span style=\"font-size:24px\">,</span><span style=\"font-size:24px;font-family:宋体\">符合相关法律法规、其他法律规范及网约课相关协议和规则。</span></p><p><span style=\"font-size:24px\">5.</span><span style=\"font-size:24px;font-family:宋体\">违反上述内容的信息，管理员有权予以删除，并酌情处罚发布者。</span></p><p><span style=\"font-size:24px;font-family:宋体\">作品展示栏目发布须知</span></p><p><span style=\"font-size:24px\">1.</span><span style=\"font-size:24px;font-family:宋体\">本栏目仅适用于直播行业相关作品的展示、交流与出售。</span></p><p><span style=\"font-size:24px\">2.</span><span style=\"font-size:24px;font-family:宋体\">请确保您发布的标题、内容以及图片、视频相符合，并发布在相对应的分类中。</span></p><p><span style=\"font-size:24px\">3.</span><span style=\"font-size:24px;font-family:宋体\">网约课仅为网站服务平台，不对网约课用户在网站上的所有操作、行为负责，网约课的所有作品均由网约课用户自行上传、下载，用户间的分享、交流、交易行为均与网约课无关。</span></p><p><span style=\"font-size:24px\">4.</span><span style=\"font-size:24px;font-family:宋体\">网约课用户将其原创作品上传至网约课进行沟通交流，应保证享有该作品的完整版权，若因版权瑕疵给网约课下载用户、网约课造成任何法律责任，应由作品上传用户承担所有法律责任。</span></p><p><span style=\"font-size:24px\">5.</span><span style=\"font-size:24px;font-family:宋体\">请确保您的发布及回复内容，符合相关法律法规、其他法律规范及网约课服务协议。</span></p><p><span style=\"font-size:24px\">6.</span><span style=\"font-size:24px;font-family:宋体\">违反上述内容的信息，管理员有权予以删除，并酌情处罚发布者。</span></p><p><span style=\"font-size:24px;font-family:宋体\">网约课网前沿栏目发布须知</span></p><p><span style=\"font-size:24px\">1.</span><span style=\"font-size:24px;font-family:宋体\">本栏目仅适用于直播行业前沿技术相关内容的发布。与直播行业使用的先进前沿技术无关的内容，请转移至其它栏目发布。</span></p><p><span style=\"font-size:24px\">2.</span><span style=\"font-size:24px;font-family:宋体\">为确保本栏目的质量，提供更好的资讯，与直播行业的前沿技术无关的内容将无法通过发布审核。</span></p><p><span style=\"font-size:24px\">3.</span><span style=\"font-size:24px;font-family:宋体\">如您所发布的内容并非原创</span><span style=\"font-size:24px\">,</span><span style=\"font-size:24px;font-family:宋体\">请注明创作者及出处。</span></p><p><span style=\"font-size:24px\">4.</span><span style=\"font-size:24px;font-family:宋体\">请确保您的发布及回复内容符合，相关法律法规、其他法律规范及网约课相关协议和规则。</span></p><p><span style=\"font-size:24px\">5.</span><span style=\"font-size:24px;font-family:宋体\">违反上述内容的信息，管理员有权予以删除，并酌情处罚发布者。</span></p><p><span style=\"font-size:24px;font-family:宋体\">网约课互助栏目发布须知</span></p><p><span style=\"font-size:24px\">1.</span><span style=\"font-size:24px;font-family:宋体\">本栏目仅适用于直播行业相关问题的发布与解答。</span></p><p><span style=\"font-size:24px\">2.</span><span style=\"font-size:24px;font-family:宋体\">请将您的提问发布到相对应的分类中</span><span style=\"font-size:24px\">,</span><span style=\"font-size:24px;font-family:宋体\">并正确填写题目。</span></p><p><span style=\"font-size:24px\">3.</span><span style=\"font-size:24px;font-family:宋体\">在提问时请对问题进行详细具体的说明，提问或答复的内容要具体详细，回答内容不得少于</span><span style=\"font-size:24px\">12</span><span style=\"font-size:24px;font-family:宋体\">个字节</span><span style=\"font-size:24px;font-family:宋体\">，不要写无意义或模糊的内容，以便于问答双方更好地沟通。</span></p><p><span style=\"font-size:24px\">4.</span><span style=\"font-size:24px;font-family:宋体\">请尽量减少重复提问，提问前，请先对问题进行搜索，在确认没有令您满意的答案后再进行提问。</span></p><p><span style=\"font-size:24px\">5.</span><span style=\"font-size:24px;font-family:宋体\">请尊重回答者的劳动成果，及时对回答做出反馈。</span></p><p><span style=\"font-size:24px\">6.</span><span style=\"font-size:24px;font-family:宋体\">请确保您的发布及回复内容</span><span style=\"font-size:24px\">,</span><span style=\"font-size:24px;font-family:宋体\">符合相关法律法规、其他法律规范及网约课相关协议和规则。</span></p><p><span style=\"font-size:24px\">7.</span><span style=\"font-size:24px;font-family:宋体\">违反上述内容的信息，管理员有权予以删除，并酌情处罚发布者。</span></p><p><span style=\"font-size:24px;font-family:宋体\">网约课共享栏目发布须知</span></p><p><span style=\"font-size:24px\">1.</span><span style=\"font-size:24px;font-family:宋体\">本栏目仅适用于链接形式共享的发布。</span></p><p><span style=\"font-size:24px\">2.</span><span style=\"font-size:24px;font-family:宋体\">共享内容仅限于与直播行业相关内容。</span></p><p><span style=\"font-size:24px\">3.</span><span style=\"font-size:24px;font-family:宋体\">共享内容不得侵犯包括他人的著作权在内的知识产权以及其他合法权利。</span></p><p><span style=\"font-size:24px\">4.</span><strong><span style=\"font-size:24px;font-family:宋体\">请勿下载未经审核认证的资源，未经审核的资源存在一定安全风险，您自行下载此类资源所造成的损失，网约课将不承担任何责任。</span></strong></p><p><span style=\"font-size:24px\">5.</span><span style=\"font-size:24px;font-family:宋体\">请确保您的发布及回复内容，符合相关法律法规、其他法律规范及网约课相关协议和规则。</span></p><p><span style=\"font-size:24px\">6.</span><span style=\"font-size:24px;font-family:宋体\">违反上述内容的信息，管理员有权予以删除，并酌情处罚发布者。</span></p><p><span style=\"font-size:24px;font-family:宋体\">网约课花絮栏目发布须知</span></p><p><span style=\"font-size:24px\">1.</span><span style=\"font-size:24px;font-family:宋体\">在网约课花絮栏目，您可以交流分享各种幕后的花絮、心情和感悟等其它栏目未包括的直播行业相关内容。</span></p><p><span style=\"font-size:24px\">2.</span><span style=\"font-size:24px;font-family:宋体\">发帖前请确保您发布的内容，符合相关法规、其他法律规范及网约课相关协议和规则。</span></p><p><span style=\"font-size:24px\">3.</span><span style=\"font-size:24px;font-family:宋体\">违反上述内容的信息，管理员有权予以删除，并酌情处罚发布者。</span></p><p><span style=\"font-size:24px;font-family:宋体\">网约课群栏目发布须知</span></p><p><span style=\"font-size:24px\">1.</span><span style=\"font-size:24px;font-family:宋体\">本栏目仅适用于直播行业相关微信群的加入与展示。</span></p><p><span style=\"font-size:24px\">2.</span><span style=\"font-size:24px;font-family:宋体\">请按照您所在的城市加入相应的网约课城市互助群，如您所在的城市并未创建微信群，请联系客服为您创建。</span></p><p><span style=\"font-size:24px\">3.</span><span style=\"font-size:24px;font-family:宋体\">如您想在本栏目展示您与直播行业相关的微信群，扩展人脉、与更多志同道合的人进行交流合作，请联系我们的客服，通过审核后您的群将在此栏目进行展示。</span></p><p><span style=\"font-size:24px\">4.</span><span style=\"font-size:24px;font-family:宋体\">除网约课城市互助群外</span><span style=\"font-size:24px\">,</span><span style=\"font-size:24px;font-family:宋体\">您也可根据情况加入相应的技术群及其它群。</span></p><p><span style=\"font-size:24px\">5.</span><span style=\"font-size:24px;font-family:宋体\">在网约课群栏目加入群或申请展示群之前，请阅读并同意遵守《网约课申请展示、加入微信群须知》内容及其它相关规则，您的使用表明您已了解并认同相关规定。</span></p><p><span style=\"font-size:24px\">&nbsp;</span></p><hr size=\"1\" width=\"33%\"/><p><br/></p><p><br/></p>', '0');
INSERT INTO `xieyi` VALUES (9, '免责声明', '<h1 label=\"标题居中\" style=\"font-size: 32px; font-weight: bold; border-bottom: 2px solid rgb(204, 204, 204); padding: 0px 4px 0px 0px; text-align: center; margin: 0px 0px 20px;\"><span style=\"font-family: 宋体; font-size: 36px;\">免责声明</span></h1><p><span style=\"font-size:24px\">1.</span><span style=\"font-size:24px;font-family:宋体\">由于用户将账号密码告知他人或与他人共享注册账户，而导致的任何个人信息的泄漏，或其他非网约课原因导致的个人信息泄漏，网约课不承担任何法律责任。</span></p><p><span style=\"font-size:24px\">2.</span><span style=\"font-size:24px;font-family:宋体\">任何第三方根据网约课规则列明的情况，使用用户的个人信息，由此所产生的纠纷，网约课不承担任何法律责任。</span></p><p><span style=\"font-size:24px\">3.</span><span style=\"font-size:24px;font-family:宋体\">任何由于黑客攻击、电脑病毒侵入或政府管制而造成的暂时性网站关闭，网约课不承担任何法律责任。</span></p><p><span style=\"font-size:24px\">4.</span><span style=\"font-size:24px;font-family:宋体\">我们鼓励用户充分利用网约课平台发布信息，发布者拥有这些内容的使用权。同时，用户不应在网约课中张贴其他受版权保护的内容。如用户在网约课发布、展示任何侵犯他人权利的内容，则该用户应承担全部侵权、赔偿责任。</span></p><p><span style=\"font-size:24px\">5.</span><span style=\"font-size:24px;font-family:宋体\">用户在网约课发表的内容（包含但不限于网约课目前各产品功能里的内容）仅表明其个人的立场和观点，并不代表网约课的立场或观点。</span></p><p><span style=\"font-size:24px\">6.</span><span style=\"font-size:24px;font-family:宋体\">用户在网约课发布侵犯他人知识产权或其他合法权益的内容，网约课有权予以删除，并保留移交司法机关处理的权利。</span></p><p><span style=\"font-size:24px\">7.</span><span style=\"font-size:24px;font-family:宋体\">互联网是一个开放平台，用户将图片等资料上传到互联网上，有可能会被其他组织或个人复制、转载、擅改或做其它非法用途，用户必须充分意识并表示理解此类风险的存在。用户明确同意，其使用网约课平台所存在的一切风险及后果，将完全由其个人承担，网约课对用户不承担任何责任。</span></p><p><span style=\"font-size:24px\">8.</span><span style=\"font-size:24px;font-family:宋体\">如果版权拥有者发现自己作品被侵权，请及时向网约课提出权利通知，并将身份证明、权属证明、具体链接（</span><span style=\"font-size:24px\">URL</span><span style=\"font-size:24px;font-family:宋体\">）及详细侵权情况证明发往</span><span style=\"font-size:24px\">(tccm@tc024.cn)</span><span style=\"font-size:24px;font-family:宋体\">。网约课在收到上述法律文件后，将在</span><span style=\"font-size:24px\">7</span><span style=\"font-size:24px;font-family:宋体\">个工作日内移除相关涉嫌侵权的内容。</span></p><p><span style=\"font-size:24px\">9.</span><span style=\"font-size:24px;font-family:宋体\">对免责声明的解释、修改及更新权均属于网约课所有。</span></p><p>&nbsp;</p><p><br/></p>', '0');
INSERT INTO `xieyi` VALUES (10, '网约课VIP服务协议', '<h1 label=\"标题居中\" style=\"font-size: 32px; font-weight: bold; border-bottom: 2px solid rgb(204, 204, 204); padding: 0px 4px 0px 0px; text-align: center; margin: 0px 0px 20px;\"><span style=\"font-size: 36px;\"><span style=\"font-family: 宋体;\">网约课</span>VIP<span style=\"font-family: 宋体;\">服务协议</span>&nbsp;</span></h1><p><span style=\"font-size:24px;font-family:宋体\">特别提示：</span></p><p><span style=\"font-size:24px;font-family:宋体\">在使用网约课</span><span style=\"font-size:24px\">VIP</span><span style=\"font-size:24px;font-family:宋体\">、</span><span style=\"font-size:24px\">SVIP</span><span style=\"font-size:24px;font-family:宋体\">增值服务（以下简称“</span><span style=\"font-size:24px\">VIP</span><span style=\"font-size:24px;font-family:宋体\">服务”）前，请您阅读并遵守《网约课</span><span style=\"font-size:24px\">VIP</span><span style=\"font-size:24px;font-family:宋体\">服务协议》（以下简称“</span><span style=\"font-size:24px\">VIP</span><span style=\"font-size:24px;font-family:宋体\">协议”），务必审慎阅读、充分理解各条款内容，特别是免除或限制责任条款。免除或限制责任条款可能以加粗形式提示您注意。</span></p><p><span style=\"font-size:24px;font-family:宋体\">除非您已阅读并接受本协议所有条款，否则您无权使用</span><span style=\"font-size:24px\">VIP</span><span style=\"font-size:24px;font-family:宋体\">服务。<strong>您对</strong></span><strong><span style=\"font-size:24px\">VIP</span></strong><strong><span style=\"font-size:24px;font-family:宋体\">服务的任何购买、登录、使用、或接受赠与等行为即视为您已阅读并同意本协议，并接受本协议的约束。</span></strong></p><p><span style=\"font-size:24px;font-family:宋体\">一、协议的范围</span></p><p><span style=\"font-size:24px\">1.1</span><span style=\"font-size:24px;font-family:宋体\">协议的主体</span></p><p><span style=\"font-size:24px;font-family:宋体\">本协议是</span><span style=\"font-size:24px\">VIP</span><span style=\"font-size:24px;font-family:宋体\">、</span><span style=\"font-size:24px\">SVIP</span><span style=\"font-size:24px;font-family:宋体\">用户与网约课之间关于使用</span><span style=\"font-size:24px\">VIP</span><span style=\"font-size:24px;font-family:宋体\">服务所订立的协议。</span></p><p><span style=\"font-size:24px\">1.2</span><span style=\"font-size:24px;font-family:宋体\">协议的组成</span></p><p><span style=\"font-size:24px;font-family:宋体\">本协议为《网约课服务协议》、《网约课规则》及《网约课币使用须知》等相关规则、协议的补充，是其不可分割的组成部分，与其构成统一整体。本协议与上述内容存在冲突的，以本协议为准。</span></p><p><span style=\"font-size:24px;font-family:宋体\">本协议同时包括网约课不断发布的关于</span><span style=\"font-size:24px\">VIP</span><span style=\"font-size:24px;font-family:宋体\">服务的相关协议、业务规则等内容。上述内容一经正式发布，即为本协议不可分割的组成部分，</span><span style=\"font-size:24px\">VIP</span><span style=\"font-size:24px;font-family:宋体\">、</span><span style=\"font-size:24px\">SVIP</span><span style=\"font-size:24px;font-family:宋体\">用户同样应当遵守。</span></p><p><span style=\"font-size:24px;font-family:宋体\">如果</span><span style=\"font-size:24px\">VIP</span><span style=\"font-size:24px;font-family:宋体\">、</span><span style=\"font-size:24px\">SVIP</span><span style=\"font-size:24px;font-family:宋体\">用户不同意本协议的修改，可以向网约课提出终止</span><span style=\"font-size:24px\">VIP</span><span style=\"font-size:24px;font-family:宋体\">服务；<strong>如果</strong></span><strong><span style=\"font-size:24px\">VIP</span></strong><strong><span style=\"font-size:24px;font-family:宋体\">、</span></strong><strong><span style=\"font-size:24px\">SVIP</span></strong><strong><span style=\"font-size:24px;font-family:宋体\">用户继续使用网约课提供的服务，则视为</span></strong><strong><span style=\"font-size:24px\">VIP</span></strong><strong><span style=\"font-size:24px;font-family:宋体\">、</span></strong><strong><span style=\"font-size:24px\">SVIP</span></strong><strong><span style=\"font-size:24px;font-family:宋体\">用户接受修改的条款内容。</span></strong></p><p><span style=\"font-size:24px;font-family:宋体\">网约课对</span><span style=\"font-size:24px\">VIP</span><span style=\"font-size:24px;font-family:宋体\">协议一旦进行修改，将在页面上公示修改的内容。一经公布即视为通知</span><span style=\"font-size:24px\">VIP</span><span style=\"font-size:24px;font-family:宋体\">、</span><span style=\"font-size:24px\">SVIP</span><span style=\"font-size:24px;font-family:宋体\">用户。</span></p><p><span style=\"font-size:24px;font-family:宋体\">二、关于</span><span style=\"font-size:24px\">VIP</span><span style=\"font-size:24px;font-family:宋体\">服务</span></p><p><span style=\"font-size:24px\">2.1VIP</span><span style=\"font-size:24px;font-family:宋体\">、</span><span style=\"font-size:24px\">SVIP</span><span style=\"font-size:24px;font-family:宋体\">增值服务，指按照网约课的指定方式支付</span><span style=\"font-size:24px\">VIP</span><span style=\"font-size:24px;font-family:宋体\">或</span><span style=\"font-size:24px\">SVIP</span><span style=\"font-size:24px;font-family:宋体\">服务费用后，用户可以享有由网约课提供的一系列网约课增值服务，简称</span><span style=\"font-size:24px\">VIP</span><span style=\"font-size:24px;font-family:宋体\">服务。</span></p><p><span style=\"font-size:24px\">2.2VIP</span><span style=\"font-size:24px;font-family:宋体\">服务的内容受开通期限、用户身份类别等因素的影响，具体以相关服务页面公布的内容为准。</span></p><p><span style=\"font-size:24px\">2.3</span><span style=\"font-size:24px;font-family:宋体\">网约课仅提供相关的网络服务，除此之外与相关网络服务有关的设备（如个人电脑、手机、及其他与接入互联网或移动网有关的装置）及所需的费用（如为接入互联网而支付的电话费及上网费、为使用移动网而支付的手机费）均由</span><span style=\"font-size:24px\">VIP</span><span style=\"font-size:24px;font-family:宋体\">、</span><span style=\"font-size:24px\">SVIP</span><span style=\"font-size:24px;font-family:宋体\">用户自行承担。</span></p><p><span style=\"font-size:24px\">2.4VIP</span><span style=\"font-size:24px;font-family:宋体\">服务是网约课提供的收费服务，须按照</span><span style=\"font-size:24px\">VIP</span><span style=\"font-size:24px;font-family:宋体\">服务的收费标准支付相应费用后，方可享受</span><span style=\"font-size:24px\">VIP</span><span style=\"font-size:24px;font-family:宋体\">服务。此外，也可以通过网站赠送等网约课认可的方式获取</span><span style=\"font-size:24px\">VIP</span><span style=\"font-size:24px;font-family:宋体\">服务。</span></p><p><span style=\"font-size:24px\">2.5</span><strong><span style=\"font-size:24px;font-family:宋体\">一旦注册成为网约课</span></strong><strong><span style=\"font-size:24px\">VIP</span></strong><strong><span style=\"font-size:24px;font-family:宋体\">、</span></strong><strong><span style=\"font-size:24px\">SVIP</span></strong><strong><span style=\"font-size:24px;font-family:宋体\">用户，即视为您认可该项服务标明之价格；</span></strong><span style=\"font-size:24px;font-family:宋体\">成为网约课</span><span style=\"font-size:24px\">VIP</span><span style=\"font-size:24px;font-family:宋体\">、</span><span style=\"font-size:24px\">SVIP</span><span style=\"font-size:24px;font-family:宋体\">用户后，该项服务即时生效。</span></p><p><span style=\"font-size:24px;font-family:宋体\">三、权利和义务</span></p><p><span style=\"font-size:24px\">3.1</span><span style=\"font-size:24px;font-family:宋体\">网约课有权根据</span><span style=\"font-size:24px\">VIP</span><span style=\"font-size:24px;font-family:宋体\">服务的整体规划，对</span><span style=\"font-size:24px\">VIP</span><span style=\"font-size:24px;font-family:宋体\">服务的收费标准、收费方式等进行修改和变更，修改及变更内容将在相应服务页面进行展示。</span></p><p><span style=\"font-size:24px\">3.2</span><span style=\"font-size:24px;font-family:宋体\">在成为</span><span style=\"font-size:24px\">VIP</span><span style=\"font-size:24px;font-family:宋体\">、</span><span style=\"font-size:24px\">SVIP</span><span style=\"font-size:24px;font-family:宋体\">用户时，须阅读并确认接受相关的服务条款、使用方法及收费标准等内容。</span></p><p><span style=\"font-size:24px\">3.3</span><span style=\"font-size:24px;font-family:宋体\">用户可通过现有和未来新增的渠道开通网约课</span><span style=\"font-size:24px\">VIP</span><span style=\"font-size:24px;font-family:宋体\">服务，包括但不限于：通过支付宝方式开通</span><span style=\"font-size:24px\">VIP</span><span style=\"font-size:24px;font-family:宋体\">服务。</span><span style=\"font-size:24px\">VIP</span><span style=\"font-size:24px;font-family:宋体\">服务开通之后，不可进行转让。</span></p><p><span style=\"font-size:24px\">3.4</span><span style=\"font-size:24px;font-family:宋体\">网约课</span><span style=\"font-size:24px\">VIP</span><span style=\"font-size:24px;font-family:宋体\">、</span><span style=\"font-size:24px\">SVIP</span><span style=\"font-size:24px;font-family:宋体\">用户所填写的内容与个人资料必须真实有效，否则网约课有权拒绝其申请，或取消已申请成功的</span><span style=\"font-size:24px\">VIP</span><span style=\"font-size:24px;font-family:宋体\">、</span><span style=\"font-size:24px\">SVIP</span><span style=\"font-size:24px;font-family:宋体\">用户资格，并不予退还</span><span style=\"font-size:24px\">VIP</span><span style=\"font-size:24px;font-family:宋体\">、</span><span style=\"font-size:24px\">SVIP</span><span style=\"font-size:24px;font-family:宋体\">用户费且不承担其他任何形式的赔偿。</span></p><p><span style=\"font-size:24px\">3.5VIP</span><span style=\"font-size:24px;font-family:宋体\">、</span><span style=\"font-size:24px\">SVIP</span><span style=\"font-size:24px;font-family:宋体\">用户的个人资料发生变化时，应及时修改注册的个人资料，否则由此造成的</span><span style=\"font-size:24px\">VIP</span><span style=\"font-size:24px;font-family:宋体\">、</span><span style=\"font-size:24px\">SVIP</span><span style=\"font-size:24px;font-family:宋体\">用户权利不能全面有效的行使，其责任由</span><span style=\"font-size:24px\">VIP</span><span style=\"font-size:24px;font-family:宋体\">、</span><span style=\"font-size:24px\">SVIP</span><span style=\"font-size:24px;font-family:宋体\">用户自己承担。</span></p><p><span style=\"font-size:24px\">3.6VIP</span><span style=\"font-size:24px;font-family:宋体\">、</span><span style=\"font-size:24px\">SVIP</span><span style=\"font-size:24px;font-family:宋体\">用户服务都有固定期限，一旦成为</span><span style=\"font-size:24px\">VIP</span><span style=\"font-size:24px;font-family:宋体\">、</span><span style=\"font-size:24px\">SVIP</span><span style=\"font-size:24px;font-family:宋体\">用户即视为认可其服务期限。</span></p><p><span style=\"font-size:24px\">3.7VIP</span><span style=\"font-size:24px;font-family:宋体\">服务的付费方式为第三方平台代收费，通过此种付费方式付费可能存在一定的风险，包括但不限于不法分子利用您账户或银行卡等有价卡进行违法活动，该等风险均会给您造成相应的经济损失，由此造成的损失您应自行承担。</span></p><p><span style=\"font-size:24px\">3.8</span><span style=\"font-size:24px;font-family:宋体\">如出现以下行为网约课将取消其</span><span style=\"font-size:24px\">VIP</span><span style=\"font-size:24px;font-family:宋体\">、</span><span style=\"font-size:24px\">SVIP</span><span style=\"font-size:24px;font-family:宋体\">资格并保留对相关责任人追究法律责任的权利：</span></p><p><span style=\"font-size:24px;font-family:宋体\">（</span><span style=\"font-size:24px\">1</span><span style=\"font-size:24px;font-family:宋体\">）通过任何机器人软件、蜘蛛软件、爬虫软件、刷屏软件等任何程序、软件方式为自己或他人非法开通</span><span style=\"font-size:24px\">VIP</span><span style=\"font-size:24px;font-family:宋体\">服务；</span></p><p><span style=\"font-size:24px;font-family:宋体\">（</span><span style=\"font-size:24px\">2</span><span style=\"font-size:24px;font-family:宋体\">）通过任何不正当手段或以违反诚实信用原则的方式为自己或他人开通</span><span style=\"font-size:24px\">VIP</span><span style=\"font-size:24px;font-family:宋体\">服务；</span></p><p><span style=\"font-size:24px;font-family:宋体\">（</span><span style=\"font-size:24px\">3</span><span style=\"font-size:24px;font-family:宋体\">）通过非网约课指定的方式为自己或他人开通</span><span style=\"font-size:24px\">VIP</span><span style=\"font-size:24px;font-family:宋体\">服务；</span></p><p><span style=\"font-size:24px;font-family:宋体\">（</span><span style=\"font-size:24px\">4</span><span style=\"font-size:24px;font-family:宋体\">）通过侵犯网约课或他人合法权益的方式为自己或他人开通</span><span style=\"font-size:24px\">VIP</span><span style=\"font-size:24px;font-family:宋体\">服务；</span></p><p><span style=\"font-size:24px;font-family:宋体\">（</span><span style=\"font-size:24px\">5</span><span style=\"font-size:24px;font-family:宋体\">）通过其他违反相关法律、行政法规、国家政策等方式为自己或他人开通</span><span style=\"font-size:24px\">VIP</span><span style=\"font-size:24px;font-family:宋体\">服务的。</span></p><p><span style=\"font-size:24px\">3.9</span><span style=\"font-size:24px;font-family:宋体\">网约课从未授权任何第三方单位或个人销售、转让网约课</span><span style=\"font-size:24px\">VIP</span><span style=\"font-size:24px;font-family:宋体\">、</span><span style=\"font-size:24px\">SVIP</span><span style=\"font-size:24px;font-family:宋体\">用户资格，任何未经授权销售网约课</span><span style=\"font-size:24px\">VIP</span><span style=\"font-size:24px;font-family:宋体\">、</span><span style=\"font-size:24px\">SVIP</span><span style=\"font-size:24px;font-family:宋体\">用户的行为均属非法行为，网约课有权追究其法律责任。</span></p><p><span style=\"font-size:24px;font-family:宋体\">四、</span><span style=\"font-size:24px\">VIP</span><span style=\"font-size:24px;font-family:宋体\">用户行为规范</span></p><p><span style=\"font-size:24px\">4.1</span><span style=\"font-size:24px;font-family:宋体\">五不准</span></p><p><span style=\"font-size:24px;font-family:宋体\">在使用</span><span style=\"font-size:24px\">VIP</span><span style=\"font-size:24px;font-family:宋体\">服务时不得利用</span><span style=\"font-size:24px\">VIP</span><span style=\"font-size:24px;font-family:宋体\">服务从事以下行为，包括但不限于：</span></p><p><span style=\"font-size:24px;font-family:宋体\">（</span><span style=\"font-size:24px\">1</span><span style=\"font-size:24px;font-family:宋体\">）发布、传送、传播、储存违反国家法律，危害国家安全统一、社会稳定、公序良俗、社会公德以及侮辱、诽谤、淫秽、暴力等内容；</span></p><p><span style=\"font-size:24px;font-family:宋体\">（</span><span style=\"font-size:24px\">2</span><span style=\"font-size:24px;font-family:宋体\">）发布、传送、传播、储存侵害他人名誉权、肖像权、知识产权、商业秘密等合法权利的内容；</span></p><p><span style=\"font-size:24px;font-family:宋体\">（</span><span style=\"font-size:24px\">3</span><span style=\"font-size:24px;font-family:宋体\">）虚构事实、隐瞒真相以误导、欺骗他人；</span></p><p><span style=\"font-size:24px;font-family:宋体\">（</span><span style=\"font-size:24px\">4</span><span style=\"font-size:24px;font-family:宋体\">）发表、传送、传播未经网约课同意的广告信息或垃圾信息；</span></p><p><span style=\"font-size:24px;font-family:宋体\">（</span><span style=\"font-size:24px\">5</span><span style=\"font-size:24px;font-family:宋体\">）从事其他违反法律法规、法律规范及公序良俗、社会公德等的行为。</span></p><p><span style=\"font-size:24px\">4.2</span><span style=\"font-size:24px;font-family:宋体\">禁止行为</span></p><p><span style=\"font-size:24px\">VIP</span><span style=\"font-size:24px;font-family:宋体\">服务仅供本人使用，未经网约课书面许可，不得进行以下行为：</span></p><p><span style=\"font-size:24px;font-family:宋体\">（</span><span style=\"font-size:24px\">1</span><span style=\"font-size:24px;font-family:宋体\">）通过任何方式搜集</span><span style=\"font-size:24px\">VIP</span><span style=\"font-size:24px;font-family:宋体\">服务中其他用户的用户名、电子邮件等相关信息，并以发送垃圾邮件、连锁邮件、垃圾短信、即时消息等方式干扰、骚扰其他用户；</span></p><p><span style=\"font-size:24px;font-family:宋体\">（</span><span style=\"font-size:24px\">2</span><span style=\"font-size:24px;font-family:宋体\">）将您获得的</span><span style=\"font-size:24px\">VIP</span><span style=\"font-size:24px;font-family:宋体\">服务许可他人使用；</span></p><p><span style=\"font-size:24px;font-family:宋体\">（</span><span style=\"font-size:24px\">3</span><span style=\"font-size:24px;font-family:宋体\">）通过非法手段对用户账户的服务期限、消费金额、交易状态进行修改；用非法方式或为非法目的使用已购买的</span><span style=\"font-size:24px\">VIP</span><span style=\"font-size:24px;font-family:宋体\">服务；</span></p><p><span style=\"font-size:24px;font-family:宋体\">（</span><span style=\"font-size:24px\">4</span><span style=\"font-size:24px;font-family:宋体\">）其他未经网约课书面许可的行为。</span></p><p><span style=\"font-size:24px\">4.3</span><span style=\"font-size:24px;font-family:宋体\">对自己行为负责</span></p><p><span style=\"font-size:24px;font-family:宋体\">（</span><span style=\"font-size:24px\">1</span><span style=\"font-size:24px;font-family:宋体\">）必须为注册帐号下的一切行为负责，包括但不限于您所发表的任何内容，及由此产生的任何后果；</span></p><p><span style=\"font-size:24px;font-family:宋体\">（</span><span style=\"font-size:24px\">2</span><span style=\"font-size:24px;font-family:宋体\">）对</span><span style=\"font-size:24px\">VIP</span><span style=\"font-size:24px;font-family:宋体\">服务中的内容自行加以判断，并承担因使用内容而引起的所有风险，包括但不限于因对内容的正确性、完整性或实用性的依赖而产生的风险；</span></p><p><span style=\"font-size:24px;font-family:宋体\">（</span><span style=\"font-size:24px\">3</span><span style=\"font-size:24px;font-family:宋体\">）妥善且正确地保管、使用、维护您在网约课取得的账户、账户信息及账户密码，并对账户信息和账户密码采取必要和有效的保密措施。非网约课原因致使您账户密码泄漏或因您保管、使用、维护不当造成损失的，网约课不承担与此有关的任何责任。</span></p><p><span style=\"font-size:24px;font-family:宋体\">五、变更、中止或终止</span></p><p><span style=\"font-size:24px\">5.1</span><span style=\"font-size:24px;font-family:宋体\">由于互联网服务的特殊性，网约课可能会按照相关法规、双方约定或在其他必要时，中止或终止提供</span><span style=\"font-size:24px\">VIP</span><span style=\"font-size:24px;font-family:宋体\">服务，届时，网约课会依法保护用户的合法权益。</span></p><p><span style=\"font-size:24px\">5.2VIP</span><span style=\"font-size:24px;font-family:宋体\">、</span><span style=\"font-size:24px\">SVIP</span><span style=\"font-size:24px;font-family:宋体\">用户服务提供的使用期限中包含网约课解决故障、服务器维修、调整、升级等所需的合理时间，对上述情况所需的时间网约课不予补偿并保留解释权。</span></p><p><span style=\"font-size:24px\">5.3</span><span style=\"font-size:24px;font-family:宋体\">网约课发现或收到他人举报您有违反本协议内容的，网约课有权依法进行独立判断并采取技术手段予以删除、屏蔽或断开相关信息。同时，网约课有权视您行为的性质，采取包括但不限于暂停、终止部分或全部</span><span style=\"font-size:24px\">VIP</span><span style=\"font-size:24px;font-family:宋体\">服务，中止或终止您网约课账户的使用、追究法律责任等措施。</span></p><p><span style=\"font-size:24px;font-family:宋体\">由上述原因网约课停止或终止您的</span><span style=\"font-size:24px\">VIP</span><span style=\"font-size:24px;font-family:宋体\">服务或网约课的其它服务，网约课无须向您退还任何费用，而由此产生的所有损失（包括但不限于通信中断、相关数据清空、未使用的服务费用作为违约金而归网约课所有等）由您自行承担，由于您违反本协议造成网约课损失的，您也应予以赔偿。</span></p><p><span style=\"font-size:24px;font-family:宋体\">六、对第三方损害的处理</span></p><p><span style=\"font-size:24px\">6.1</span><span style=\"font-size:24px;font-family:宋体\">因违反本协议而导致任何第三方损害的，您应当独自完全承担责任。</span></p><p><span style=\"font-size:24px\">6.2</span><span style=\"font-size:24px;font-family:宋体\">网约课未行使或延迟行使本协议权利的，并不代表对该权利的放弃；而单一或部分行使本协议权利的，并不排斥其任何其它权利的行使，网约课随时有权要求您继续履行义务并承担相应的责任。</span></p><p><span style=\"font-size:24px;font-family:宋体\">七、其他</span></p><p><span style=\"font-size:24px\">7.1VIP</span><span style=\"font-size:24px;font-family:宋体\">服务期限</span></p><p><span style=\"font-size:24px;font-family:宋体\">以支付相应服务费用的期限为准，可登录</span><span style=\"font-size:24px\">VIP</span><span style=\"font-size:24px;font-family:宋体\">服务的相应页面查询。</span></p><p><span style=\"font-size:24px\">7.2</span><span style=\"font-size:24px;font-family:宋体\">协议的生效</span></p><p><strong><span style=\"font-size:24px;font-family:宋体\">使用</span></strong><strong><span style=\"font-size:24px\">VIP</span></strong><strong><span style=\"font-size:24px;font-family:宋体\">服务即视为您已阅读并接受本协议的约束。</span></strong></p><p><span style=\"font-size:24px\">7.3</span><span style=\"font-size:24px;font-family:宋体\">协议签订地</span></p><p><span style=\"font-size:24px;font-family:宋体\">本协议签订地为天津天成众投科技有限公司所在地。</span></p><p><span style=\"font-size:24px\">7.4</span><span style=\"font-size:24px;font-family:宋体\">适用法律</span></p><p><span style=\"font-size:24px;font-family:宋体\">本协议的成立、生效、履行、解释及纠纷解决，适用中华人民共和国大陆地区法律。</span></p><p><span style=\"font-size:24px\">7.5</span><span style=\"font-size:24px;font-family:宋体\">争议解决</span></p><p><span style=\"font-size:24px;font-family:宋体\">对本协议发生任何纠纷或争议，首先应友好协商解决；协商不成的，由本协议签订地有管辖权的人民法院管辖。</span></p><p><span style=\"font-size:24px\">7.6</span><span style=\"font-size:24px;font-family:宋体\">条款标题</span></p><p><span style=\"font-size:24px;font-family:宋体\">本协议所有条款的标题仅为阅读方便，本身并无实际涵义，不能作为本协议涵义解释的依据。</span></p><p><span style=\"font-size:24px\">7.7</span><span style=\"font-size:24px;font-family:宋体\">条款效力</span></p><p><span style=\"font-size:24px;font-family:宋体\">本协议一经公布立即生效。</span></p><p><span style=\"font-size:24px;font-family:宋体\">本协议条款无论因何种原因部分无效或不可执行，其余条款仍有效，对双方具有约束力。</span></p><p><br/></p>', '0');
INSERT INTO `xieyi` VALUES (11, '网约课保证金协议', '<h1 label=\"标题居中\" style=\"font-size: 32px; font-weight: bold; border-bottom: 2px solid rgb(204, 204, 204); padding: 0px 4px 0px 0px; text-align: center; margin: 0px 0px 20px;\"><span style=\"font-family: 宋体; font-size: 24px;\">网约课保证金协议</span></h1><p><span style=\"font-family: 宋体; font-size: 14px;\">本协议由您与网约课平台的经营者共同缔结，本协议具有合同效力。</span></p><p><span style=\"font-size: 14px;\"><span style=\"font-family: 宋体;\">网约课平台的经营者是指法律认可的经营网约课平台网站的责任主体，网约课平台网站包括但不限于网约课（域名为</span>www.wyuek.com<span style=\"font-family: 宋体;\">），本协议项下各网约课平台的经营者可单称或合称为“网约课”。</span></span><span style=\"font-family: 宋体; font-size: 14px;\">有关网约课平台经营者的信息请查看网约课首页底部公布的公司信息和证照信息。</span></p><p><span style=\"font-family: 宋体; font-size: 14px;\">一、协议内容及生效</span></p><p><span style=\"font-size: 14px;\">1.<span style=\"font-family: 宋体;\">本协议内容包括协议正文及所有网约课已经发布或后续发布的与“保证金”或“消费者服务”有关的规则。后续发布的相关规则将采取合理途径提前七个自然日通知您。以上规则为本协议不可分割的组成部分，与协议具有同等法律效力。</span></span></p><p><span style=\"font-size: 14px;\">2.<span style=\"font-family: 宋体;\">您在向其他网约课用户（以下简称“其他用户”）提供消费者保障服务之前须认真阅读全部协议内容，对于协议中以粗体标注的内容，您应重点阅读。如您对本协议有任何疑问，应向网约课咨询。无论您事实上是否阅读了本协议内容，只要您在线点击签署了本协议，则本协议即对您产生约束。</span></span></p><p><span style=\"font-size: 14px;\">3.<span style=\"font-family: 宋体;\">您须接受并遵守本协议的约定。如果您不同意本协议的约定，您应立即停止使用网约课保证金服务。</span></span></p><p><span style=\"font-size: 14px;\">4.<span style=\"font-family: 宋体;\">网约课可根据需要不定时制订、修改本协议及</span>/<span style=\"font-family: 宋体;\">或与“保证金”、“消费者保证服务”相关的规则，以网站公示的方式进行公告通知。变更后的协议和规则在网约课网站公布之日起七个自然日后，即自动生效。如您不同意相关变更，应当立即停止使用网约课保证金服务。您继续进行任何与网约课保证金相关的活动，包括但不限于维持所发布的商品信息、合作信息，或继续发布商品信息、合作信息，即表示您接受经修订的协议。</span></span></p><p><span style=\"font-family: 宋体; font-size: 14px;\">二、定义</span></p><p><span style=\"font-size: 14px;\">1.<span style=\"font-family: 宋体;\">保证金：根据《网约课保证金协议》约定的条款和条件及网约课其他公示规则的规定自愿交存，在您未履行消费者保障服务承诺时，用于对与您在网约课中达成交易意向并交易的网约课用户进行赔付的资金。</span></span></p><p><span style=\"font-size: 14px;\">2.<span style=\"font-family: 宋体;\">违约赔付：指您与其他用户在网约课达成交易后，如因您未履行消费者保障服务承诺而导致该用户权益受损，且在其直接要求您处理未果的情况下，网约课可以根据相关证据材料和规则，判定您是否应履行赔付义务。如是，则网约课可将您的保证金全额交付给该用户。</span></span></p><p><span style=\"font-family: 宋体; font-size: 14px;\">三、消费者保障服务内容</span></p><p><span style=\"font-family: 宋体; font-size: 14px;\">在您向其他用户提供消费者保障服务过程中，您承诺遵守以下约定：</span></p><p><span style=\"font-size: 14px;\">1.<span style=\"font-family: 宋体;\">您同意遵守本协议、《网约课服务协议》以及所有公示于网约课与“消费者保障服务”、“保证金”相关的规则。</span></span></p><p><span style=\"font-size: 14px;\">2.<span style=\"font-family: 宋体;\">您拥有合法的权利和资格向网约课上传有关商品销售、租赁信息及合作信息，且前述行为未对任何第三方合法权益（包括但不限于第三方知识产权、财产权等）构成侵害。如因您的行为导致网约课或其关联公司遭受任何第三方提起的索赔、诉讼或行政责任，您应承担相应责任并使网约课免责。</span></span></p><p><span style=\"font-size: 14px;\">3.<span style=\"font-family: 宋体;\">您应在网约课及网约课提供的渠道中，对上传的商品信息、服务信息、合作信息进行如实描述，包括但不限于对商品的基本属性、成色、瑕疵等必须说明的信息进行真实、准确、完整的描述，并对描述的商品信息、合作信息负有举证责任。您应保证所出售或出租的商品在合理期限内可正常使用，不存在危及人身财产安全的不合理危险，具备商品应当具备的使用性能，符合商品或其包装上注明采用的标准等。</span></span></p><p><span style=\"font-size: 14px;\">4.<span style=\"font-family: 宋体;\">您应当使用实物拍摄图片，即您针对该件商品本身实际拍摄的图片，不包括杂志图片、官方网站图片及宣传图片。如您违反本条款之约定，则视为您违反了商品如实描述的义务。</span></span></p><p><span style=\"font-size: 14px;\">5.<span style=\"font-family: 宋体;\">如您与其他用户在网约课中达成交易意向后，该用户因合理的理由向您提出退款时，您应积极配合，与该用户主动协商，自愿友好达成退货退款协议，并在约定的时间内向该用户返还其支付的商品价款。</span></span></p><p><span style=\"font-size: 14px;\">6.<span style=\"font-family: 宋体;\">如您与其他用户在网约课中达成交易意向并对该用户做出了特别的交易承诺，您应严格依照您所承诺的服务内容向该用户履行义务。</span></span></p><p><span style=\"font-size: 14px;\">7.<span style=\"font-family: 宋体;\">您明确了解并同意您是消费者保障服务的责任主体，网约课及其关联公司仅向您提供相关技术支持及服务，除法律有明文规定外，不对您向其他用户提供的消费者保障服务内容承担任何保证责任。当发生其他用户主张退款、课程内容与网上描述不符、课程内容存在质量问题、您违反特别交易承诺等情形时，您应积极与该用户沟通协商并保证该用户的权益。对于该用户因前述问题提出的退换货要求，您应积极处理。</span></span></p><p><span style=\"font-size: 14px;\">8.<span style=\"font-family: 宋体;\">当网约课受理其他用户提出的消费者保障服务维权和赔付申请时，您应积极配合，在网约课要求的时间期限内提供相关证据材料，以证明与该用户交易不存在该用户提出的问题或符合双方的约定，并保证所提交的证据材料真实、合法。如网约课以普通或非专业人员的知识水平标准，对您和或其他用户提供的证据材料进行表面审核后，以其独立判断您未全面履行消费者保障服务内容的，则网约课可根据本协议及其它公示规则的规定，将您在本协议项下交纳的保证金全额交付给该用户作为违约惩罚。</span></span></p><p><span style=\"font-family: 宋体; font-size: 14px;\">四、保证金</span></p><p><span style=\"font-family: 宋体; font-size: 14px;\">您应根据以下条款之约定交存，并授权网约课及其关联公司可根据以下条款及网约课其他公示规则的规定使用、处置保证金，除您按照网约课的规定正式停止使用保证金服务的情况外，上述授权不可撤销。</span></p><p><span style=\"font-size: 14px;\">1.<span style=\"font-family: 宋体;\">保证金的交存</span></span></p><p><span style=\"font-size: 14px;\">1.1<span style=\"font-family: 宋体;\">保证金为网约课企业用户自愿交纳。网约课用户可根据自己的需要通过交纳保证金的方式提升自己在交易中的信用度。</span></span></p><p><span style=\"font-size: 14px;\">1.2<span style=\"font-family: 宋体;\">网约课的保证金按照金额的不同分为五个等级，由低到高分别为：</span>2000<span style=\"font-family: 宋体;\">元、</span>5000<span style=\"font-family: 宋体;\">元、</span>10000<span style=\"font-family: 宋体;\">元、</span>20000<span style=\"font-family: 宋体;\">元、</span>50000<span style=\"font-family: 宋体;\">元，您可以按照自己的需求选择交纳哪一种额度的保证金。</span></span></p><p><span style=\"font-size: 14px;\">1.3<span style=\"font-family: 宋体;\">无论您选择了哪一种额度的保证金，只要您事实上交纳了保证金，您的昵称旁将出现“已交保证金”的标识，在您进行发布信息及回复、评论等操作时将伴随您的昵称出现，但根据所交纳保证金金额的不同，会出现不同样式的保证金标识。</span></span></p><p><span style=\"font-size: 14px;\">1.4<span style=\"font-family: 宋体;\">如发生保证金赔付事件导致您的保证金归零，网约课客服会根据情况向你发出补交保证金的通知，如您未在通知的时限内补交保证金，则视为您自动放弃保证金补交资格。</span></span></p><p><span style=\"font-size: 14px;\">2.<span style=\"font-family: 宋体;\">保证金的停止使用</span></span></p><p><span style=\"font-size: 14px;\">2.1<span style=\"font-family: 宋体;\">若您已经交纳保证金成为网约课保证金服务的使用者，您申请解除保证金，您须同时满足以下条件：</span></span></p><p><span style=\"font-size: 14px;\"><span style=\"font-family: 宋体;\">（</span>1<span style=\"font-family: 宋体;\">）没有正在处理的违约赔付投诉记录；</span></span></p><p><span style=\"font-size: 14px;\"><span style=\"font-family: 宋体;\">（</span>2<span style=\"font-family: 宋体;\">）没有正在处理的未完结的赔付记录；</span></span></p><p><span style=\"font-size: 14px;\"><span style=\"font-family: 宋体;\">（</span>3<span style=\"font-family: 宋体;\">）在网约课中没有任何未处理完的交易纠纷；</span></span></p><p><span style=\"font-size: 14px;\"><span style=\"font-family: 宋体;\">（</span>4<span style=\"font-family: 宋体;\">）与网约课之间没有未处理完的纠纷；</span></span></p><p><span style=\"font-size: 14px;\"><span style=\"font-family: 宋体;\">（</span>5<span style=\"font-family: 宋体;\">）没有其它未处理完的与保证金相关的纠纷。</span></span></p><p><span style=\"font-size: 14px;\">2.2<span style=\"font-family: 宋体;\">如您的账号被查封，且您在网约课中没有仍在生效的商贸信息或其他与保证金相关的未解决纠纷（包括但不限于在网约课中与其他用户达成的交易意向、与网约课相关的纠纷等），网约课将退还您保证金或赔付后剩余的保证金余额，并直接终止向您提网约课服务。</span></span></p><p><span style=\"font-size: 14px;\">2.3<span style=\"font-family: 宋体;\">如您已成功申请停止使用保证金服务，停止服务后您昵称后的“已交保证金”的标识将被取消，网约课可暂停或终止向您提供保证金相关服务。</span></span></p><p><span style=\"font-size: 14px;\">2.4<span style=\"font-family: 宋体;\">若您申请停止使用保证金，您的保证金将在您提交保证金退还申请后的</span>1<span style=\"font-family: 宋体;\">至</span>60<span style=\"font-family: 宋体;\">个工作日内，退还到您的银行账户中。若网约课主动停止您对保证金的使用或注销您的网约课账户，则网约课将在停止您的保证金使用后的</span>1<span style=\"font-family: 宋体;\">至</span>60<span style=\"font-family: 宋体;\">个工作日内，将您的保证金退还到您的银行账户中。网约课退还的保证金数额以您网约课账户内的保证金数额为准。</span></span></p><p><span style=\"font-size: 14px;\">3.<span style=\"font-family: 宋体;\">保证金的管理与使用</span></span></p><p><span style=\"font-size: 14px;\">3.1<span style=\"font-family: 宋体;\">您同意，网约课可在以下情况发生时，处置您的保证金：</span></span></p><p><span style=\"font-size: 14px;\">3.1.1<span style=\"font-family: 宋体;\">如您在网约课发布课程内容等相关信息或在网约课中与其他用户达成交易意向后，在履行交易相关义务过程中，违反国家法律、法规、政策、网约课已公示并生效的规则，或违反您对该用户的承诺，</span> <span style=\"font-family: 宋体;\">或被该用户申请维权、索赔等情况时，网约课可根据其独立的判断，先行将保证金交付给该用户。</span></span></p><p><span style=\"font-size: 14px;\">3.1.2<span style=\"font-family: 宋体;\">如您违反本协议和</span>/<span style=\"font-family: 宋体;\">或网约课任何规则和</span>/<span style=\"font-family: 宋体;\">或您与网约课签署的其他协议，给网约课或其关联公司造成任何损失（包括但不限于诉讼赔偿、诉讼费用、律师费用等）的，应补偿网约课或其关联公司所遭受的损失。</span></span></p><p><span style=\"font-size: 14px;\">3.1.3<span style=\"font-family: 宋体;\">其他网约课可处置您的保证金的情形。</span></span></p><p><span style=\"font-size: 14px;\"><span style=\"font-family: 宋体;\">在出现上述</span>3.1.1<span style=\"font-family: 宋体;\">和</span>3.1.2<span style=\"font-family: 宋体;\">情况时，网约课均可关闭用户在网约课的全部或部分功能。</span></span></p><p><span style=\"font-size: 14px;\">3.2<span style=\"font-family: 宋体;\">网约课如使用保证金进行任何赔付，将以书面方式（包括但不限于电子邮件、传真等）通知您。在向您出具的书面通知中，将说明赔付原因及赔付金额。</span></span></p><p><span style=\"font-size: 14px;\">3.3<span style=\"font-family: 宋体;\">如您的保证金不足以抵偿其他用户或网约课的损失时，您应自行支付额外的赔付金额。在您保证金不足时，除法律有明文规定外，网约课没有使用自有资金向与您产生纠纷的网约课其他用户或者任何第三方支付赔偿金、补偿金或其它任何款项的义务。您应对购买方、租赁方或者其他权利人承担赔付、补偿义务。</span></span></p><p><span style=\"font-size: 14px;\">3.4<span style=\"font-family: 宋体;\">您对其他用户、任何第三方以及网约课的赔付责任不以您已交纳的保证金数额为限。除法律有明文规定外，网约课不对与您进行交易的网约课用户或者任何第三方承担任何赔付、赔偿的义务，但可根据本协议的规定，将您的保证金用于保障对与您在网约课上达成交易意向的其他用户的利益。</span></span></p><p><span style=\"font-family: 宋体; font-size: 14px;\">五、有限责任</span></p><p><span style=\"font-size: 14px;\">1.<span style=\"font-family: 宋体;\">您了解并同意，网约课及其关联公司并非司法机构，仅能以普通或非专业人员的知识水平标准对您提交的证据材料进行鉴别，网约课及其关联公司对交易纠纷的处理完全是基于您的委托，网约课及其关联公司无法保证交易纠纷处理结果符合您的期望，也不对交易纠纷处理结果及保证金决定承担任何责任。您应保证您提交的证据材料的真实性、合法性，并承担您或与您发生纠纷的其他用户提供的信息、数据不实的风险和责任。如您因此遭受损失，您同意自行向受益人索赔。</span></span></p><p><span style=\"font-size: 14px;\">2.<span style=\"font-family: 宋体;\">您了解并同意，除法律有明文规定外，网约课及其关联公司对与本协议相关的以及由于本协议的签订、履行导致的所有的责任，不管是否与违约、侵权相关，不管出于故意还是过失，也不管您是否向网约课支付过任何费用，在任何情况下，都不应超过</span>1000<span style=\"font-family: 宋体;\">元人民币，这并不影响网约课根据本协议、网约课与您签署的其它协议、网约课规则享有的免责、责任限制的权利。</span></span></p><p><span style=\"font-family: 宋体; font-size: 14px;\">六、委托支付</span></p><p><span style=\"font-size: 14px;\">1.<span style=\"font-family: 宋体;\">本协议一旦生效，即表示您已充分理解并同意向网约课作出授权，您授权网约课对您的保证金进行相应操作，此授权在本协议有效期间以及本协议明确约定的期间均具有法律约束力。</span></span></p><p><span style=\"font-size: 14px;\">2.<span style=\"font-family: 宋体;\">根据本协议的约定，网约课可对保证金做出如下类型的操作：</span></span></p><p><span style=\"font-size: 14px;\">2.1<span style=\"font-family: 宋体;\">保证金的冻结和退还；</span></span></p><p><span style=\"font-size: 14px;\">2.2<span style=\"font-family: 宋体;\">划扣保证金用于执行违约赔付或划扣保证金用于赔偿网约课及其关联公司的损失。</span></span></p><p><span style=\"font-family: 宋体; font-size: 14px;\">七、协议终止</span></p><p><span style=\"font-size: 14px;\">1.<span style=\"font-family: 宋体;\">出现以下情况时，本协议终止。本协议终止后，您将无法继续进行与保证金有关的活动：</span></span></p><p><span style=\"font-size: 14px;\">1.1<span style=\"font-family: 宋体;\">自然终止：如您在线签署的《网约课服务协议》因任何原因终止，则本协议将同时终止。</span></span></p><p><span style=\"font-size: 14px;\">1.2<span style=\"font-family: 宋体;\">通知解除：网约课可提前十五天以书面通知的方式终止本协议。</span></span></p><p><span style=\"font-size: 14px;\">1.3<span style=\"font-family: 宋体;\">网约课单方解除权：如您违反本协议中的任何承诺、保证或网约课的任何规则，网约课可立即终止本协议，且按有关规则对您进行相应处罚。</span></span></p><p><span style=\"font-size: 14px;\">1.4<span style=\"font-family: 宋体;\">本协议（含规则）变更时，如您不愿接受新的保证金协议，须以正式的方式通知网约课，本协议自网约课收到您通知之日起自动终止。</span></span></p><p><span style=\"font-size: 14px;\">1.5<span style=\"font-family: 宋体;\">本协议规定的其他协议终止条件发生或实现，导致本协议终止。</span></span></p><p><span style=\"font-size: 14px;\">2.<span style=\"font-family: 宋体;\">无论本协议因何原因终止，在协议终止前的行为所导致的任何赔偿和责任，您必须完全且独立承担责任。即使本协议终止，网约课及其关联公司仍可根据本协议的规定处理，包括但不限于使用您的保证金来处理在本协议有效期内发生的，因您与其他用户在网约课达成交易意向的交易，所导致的该用户索赔。</span></span></p><p><span style=\"font-size: 14px;\">3.<span style=\"font-family: 宋体;\">本协议第四条、第七条的效力不因本协议的终止而终止。</span></span></p><p><span style=\"font-family: 宋体; font-size: 14px;\">八、争议解决</span></p><p><span style=\"font-family: 宋体; font-size: 14px;\">本协议之解释与适用，以及与本协议有关的争议，均应依照中华人民共和国大陆地区法律予以处理，并以网约课所在地人民法院为第一审管辖法院。</span></p><p><span style=\"font-family: 宋体; font-size: 14px;\">九、其他</span></p><p><span style=\"font-size: 14px;\">1.<span style=\"font-family: 宋体;\">如本协议的任何条款被视作无效或无法执行，则上述条款可被分离，其余部分则仍具有法律效力。</span></span></p><p><span style=\"font-size: 14px;\">2.<span style=\"font-family: 宋体;\">网约课于您过失或违约时放弃本协议约定的权利的，不得视为网约课对您的其他或以后同类之过失或违约行为弃权。</span></span></p><p><span style=\"font-size: 14px;\">3.<span style=\"font-family: 宋体;\">网约课基于本协议享有的权利以及获得的授权，均可以全部或部分转移、转让、许可、分授权、转授权给任何第三方。</span></span></p><p><br/></p>', '4');
INSERT INTO `xieyi` VALUES (12, '网约课服务规则', '<h1 label=\"标题居中\" style=\"font-size: 32px; font-weight: bold; border-bottom: 2px solid rgb(204, 204, 204); padding: 0px 4px 0px 0px; text-align: center; margin: 0px 0px 20px;\"><span style=\"line-height: 240%; font-family: 宋体; font-size: 36px;\">网约课规则</span></h1><p><span style=\"font-size:16px;font-family:宋体\">第一章概述</span></p><p><span style=\"font-size:16px;font-family:宋体\">第一条</span></p><p><span style=\"font-size:16px;font-family:宋体\">为建立开放、透明、分享、责任的网络环境，保障网约课用户合法权益，维护网约课正常使用秩序制定本规则。</span></p><p><span style=\"font-size:16px;font-family:宋体\">第二条</span></p><p><span style=\"font-size:16px;font-family:宋体\">网约课规则，是对网约课用户增加基本义务或限制基本权利的条款。</span></p><p><span style=\"font-size:16px;font-family:宋体\">第三条</span></p><p><span style=\"font-size:16px;font-family:宋体\">违规行为的认定与处理，应基于网约课认定的事实并严格依规执行。网约课用户在适用规则上一律平等。</span></p><p><span style=\"font-size:16px;font-family:宋体\">第四条</span></p><p><span style=\"font-size:16px;font-family:宋体\">用户应遵守国家法律、行政法规、部门规章等规范性文件。对任何涉嫌违反国家法律、行政法规、部门规章等规范性文件的行为，本规则已有规定的，适用本规则；本规则尚无规定的，网约课有权酌情处理。但网约课对用户的处理不免除其承担的法律责任。用户在网约课的任何行为，应同时遵守与网约课及其关联公司所签订的各项协议。网约课有权随时变更本规则并在网站上予以公告。若用户不同意相关变更，应立即停止使用网约课的相关服务或产品。网约课有权对用户行为及应适用的规则进行单方认定，并据此处理，用户对此表示理解且同意。</span></p><p><span style=\"font-size:16px;font-family:宋体\">第二章定义</span></p><p><span style=\"font-size:16px;font-family:宋体\">第五条</span></p><p><span style=\"font-size:16px;font-family:宋体\">网约课，包括网约课（域名为www.wyuek.com）、网约课手机客户端。</span></p><p><span style=\"font-size:16px;font-family:宋体\">第六条</span></p><p><span style=\"font-size:16px;font-family:宋体\">用户，指具有完全民事行为能力的网约课各项服务的使用者。</span></p><p><span style=\"font-size:16px;font-family:宋体\">第七条</span></p><p><span style=\"font-size:16px;font-family:宋体\">会员，指已注册网约课并通过网约课身份认证或通过网约课企业认证的网约课用户。</span></p><p><span style=\"font-size:16px;font-family:宋体\">第八条</span></p><p><span style=\"font-size:16px;font-family:宋体\">企业身份会员，指注册为网约课会员并通过企业身份认证的会员，包括：业内企业、租赁商、生产销售商。</span></p><p><span style=\"font-size:16px;font-family:宋体\">第九条</span></p><p><span style=\"font-size:16px;font-family:宋体\">个人身份会员，指成功注册成为网约课会员并通过个人身份认证的会员，包括：业内人士和技术人才。</span></p><p><span style=\"font-size:16px;font-family:宋体\">第十条</span></p><p><span style=\"font-size:16px;font-family:宋体\">节点处理，指当会员违规而被执行处理的过程。</span></p><p><span style=\"font-size:16px;font-family:宋体\">第三章商贸行为</span></p><p><span style=\"font-size:16px;font-family:宋体\">第一节注册</span></p><p><span style=\"font-size:16px;font-family:宋体\">第十一条</span></p><p><span style=\"font-size:16px;font-family:宋体\">会员应当严格遵循网约课系统设置的注册流程完成注册。会员在选择网约课昵称时应遵守国家法律法规，不得包含违法、涉嫌侵犯他人权利、违背社会公序良俗或干扰网约课运营秩序等相关信息。昵称注册后无法自行修改。</span></p><p><span style=\"font-size:16px;font-family:宋体\">第二节商贸信息的发布</span></p><p><span style=\"font-size:16px;font-family:宋体\">第十二条</span></p><p><span style=\"font-size:16px;font-family:宋体\">会员须符合以下条件，方可在网约课中发布课程的买卖、求购、团购活动、优惠促销、作品征集等商贸信息：</span></p><p><span style=\"font-size:16px;font-family:宋体\">（一）企业代理人通过网约课的个人认证；</span></p><p><span style=\"font-size:16px;font-family:宋体\">（二）通过网约课的企业认证；</span></p><p><span style=\"font-size:16px;font-family:宋体\">第十三条</span></p><p><span style=\"font-size:16px;font-family:宋体\">会员应当按照网约课系统设置的流程和要求发布课程的买卖、团购活动、优惠促销、作品征集等商贸信息。</span></p><p><span style=\"font-size:16px;font-family:宋体\">第十四条</span></p><p><span style=\"font-size:16px;font-family:宋体\">“课程如实描述”及对其所售、课程或提供服务的质量承担保证责任是会员的基本义务。“课程如实描述”是指会员在课程合作、课程出售、课程栏目等所有网约课提供的渠道中，应当对课程的基本属性、内容、方向、适用人群等必须说明的信息进行真实、完整的描述。会员应保证其出售的课程及服务，不存在危及人身财产安全的不合理危险、具备课程应当具备的性能。直播课程应准时，准点在与其它会员约定的时间进行（如有突发情况可与对应的会员进行协商）。本条与《栏目发布须知》不可分割。</span></p><p><span style=\"font-size:16px;font-family:宋体\">第四章市场管理</span></p><p><span style=\"font-size:16px;font-family:宋体\">第一节市场管理措施</span></p><p><span style=\"font-size:16px;font-family:宋体\">第十五条</span></p><p><span style=\"font-size:16px;font-family:宋体\">为了提升网约课会员间的交易质量，维护网约课正常运营秩序，网约课按照本规则规定的情形，对会员及其发布信息的行为采取以下临时性市场管控措施：</span></p><p><span style=\"font-size:16px;font-family:宋体\">(</span><span style=\"font-size:16px;font-family:宋体\">一)警告，是指网约课通过口头或书面的形式对会员的不当行为进行提醒或告诫；</span></p><p><span style=\"font-size:16px;font-family:宋体\">(</span><span style=\"font-size:16px;font-family:宋体\">二)删除发布信息并酌情予以相应的积分、禁言等权限处罚；</span></p><p><span style=\"font-size:16px;font-family:宋体\">(</span><span style=\"font-size:16px;font-family:宋体\">三)冻结或注销账号，是指根据协议约定或本规则规定对会员的账号进行冻结或注销。</span></p><p><span style=\"font-size:16px;font-family:宋体\">第二节市场管理情形</span></p><p><span style=\"font-size:16px;font-family:宋体\">第十六条</span></p><p><span style=\"font-size:16px;font-family:宋体\">会员所发布的课程、服务信息各要素应真实合理，且应与课程、服务本身相符。网约课对符合下列任一情形的信息不予在网站上展示：1.所发布课程、服务价格与实际购买价格严重不符的；</span></p><p><span style=\"font-size:16px;font-family:宋体\">2. </span><span style=\"font-size:16px;font-family:宋体\">课程、服务的标题、图片、价格、及售后服务等课程要素之间明显不匹配的；</span></p><p><span style=\"font-size:16px;font-family:宋体\">3.</span><span style=\"font-size:16px;font-family:宋体\">通过拆分数量、单位等规避搜索单一维度排序规则的。</span></p><p><span style=\"font-size:16px;font-family:宋体\">第五章通用违规行为及违规处理</span></p><p><span style=\"font-size:16px;font-family:宋体\">第一节违规处理措施</span></p><p><span style=\"font-size:16px;font-family:宋体\">第十七条</span></p><p><span style=\"font-size:16px;font-family:宋体\">为保障会员或网约课的正当权益，在会员违规处理期间，网约课按照本规则规定的情形，对会员采取以下违规处理措施：</span></p><p><span style=\"font-size:16px;font-family:宋体\">(</span><span style=\"font-size:16px;font-family:宋体\">一）会员屏蔽，指在搜索、导航等各项服务中对会员所发布的课程信息进行屏蔽；</span></p><p><span style=\"font-size:16px;font-family:宋体\">(</span><span style=\"font-size:16px;font-family:宋体\">二)限制发布信息，指禁止会员发布新的课程、服务信息；</span></p><p><span style=\"font-size:16px;font-family:宋体\">(</span><span style=\"font-size:16px;font-family:宋体\">三)公示警告，指在网约课主页等对其正在被执行的处理进行公示；</span></p><p><span style=\"font-size:16px;font-family:宋体\">(</span><span style=\"font-size:16px;font-family:宋体\">四)冻结或注销账户，指永久或暂时禁止会员账号登录网约课。</span></p><p><span style=\"font-size:16px;font-family:宋体\">第二节违规处理</span></p><p><span style=\"font-size:16px;font-family:宋体\">第十八条</span></p><p><span style=\"font-size:16px;font-family:宋体\">会员发生违规行为的，其违规行为应当纠正，并由网约课酌情予以相应的处罚。</span></p><p><span style=\"font-size:16px;font-family:宋体\">第十九条</span></p><p><span style=\"font-size:16px;font-family:宋体\">会员违规行为的纠正，是指：</span></p><p><span style=\"font-size:16px;font-family:宋体\">(</span><span style=\"font-size:16px;font-family:宋体\">一)发布违禁信息的，网约课对会员所发布的违禁课程或信息及因此产生的回复、评价进行删除；</span></p><p><span style=\"font-size:16px;font-family:宋体\">(</span><span style=\"font-size:16px;font-family:宋体\">二)出售假冒课程的，网约课对会员所发布的假冒课程或信息进行删除；</span></p><p><span style=\"font-size:16px;font-family:宋体\">(</span><span style=\"font-size:16px;font-family:宋体\">三)出售未上报课程的，网约课对会员所发布的未上报课程或信息进行删除；</span></p><p><span style=\"font-size:16px;font-family:宋体\">(</span><span style=\"font-size:16px;font-family:宋体\">四)盗用他人账户的，网约课核实后将收回被盗账户，并使原所有人可以通过账户申诉流程重新取回账户；</span></p><p><span style=\"font-size:16px;font-family:宋体\">(</span><span style=\"font-size:16px;font-family:宋体\">五)泄露他人信息的，网约课核实后将对会员所泄露的他人隐私资料的信息进行删除；</span></p><p><span style=\"font-size:16px;font-family:宋体\">(</span><span style=\"font-size:16px;font-family:宋体\">六)骗取他人财物的，网约课对用以骗取他人财物的课程或信息及因此产生的回复、评价进行删除；</span></p><p><span style=\"font-size:16px;font-family:宋体\">(</span><span style=\"font-size:16px;font-family:宋体\">七)描述不符的，会员对课程、内容、品质等信息的描述与其他会员观看的课程严重不符，或导致其他会员无法正常使用的，网约课核实后删除该描述不符的课程；会员未对课程瑕疵等信息进行披露或对课程的描述与其他会员收到的课程不相符，且影响其他会员正常使用的，网约课将删除该条课程信息。</span></p><p><span style=\"font-size:16px;font-family:宋体\">(</span><span style=\"font-size:16px;font-family:宋体\">八)违背承诺的，履行如实描述义务或消费者保障服务规定的赔付；</span></p><p><span style=\"font-size:16px;font-family:宋体\">(</span><span style=\"font-size:16px;font-family:宋体\">九)发布恶意诋毁其他会员或其课程的信息，网约课或信息发布方删除该条违规信息；</span></p><p><span style=\"font-size:16px;font-family:宋体\">(</span><span style=\"font-size:16px;font-family:宋体\">十)不当注册的，网约课查封使用软件、程序方式大批量注册而成的账户；</span></p><p><span style=\"font-size:16px;font-family:宋体\">(</span><span style=\"font-size:16px;font-family:宋体\">十一)不当使用他人权利的，网约课对会员所发布的不当使用他人权利的课程信息或其他信息在核实后将进行删除；</span></p><p><span style=\"font-size:16px;font-family:宋体\">(</span><span style=\"font-size:16px;font-family:宋体\">十二)假冒课程的，网约课对会员所发布的假冒课程信息进行删除。</span></p><p><span style=\"font-size:16px;font-family:宋体\">第二十条</span></p><p><span style=\"font-size:16px;font-family:宋体\">被执行节点处理的会员，当其全部违规行为被纠正、违规处理期间届满、违规处理措施执行完毕，方可恢复正常状态。</span></p><p><span style=\"font-size:16px;font-family:宋体\">第二十一条</span></p><p><span style=\"font-size:16px;font-family:宋体\">会员可在被违规处理之时起十五天内(网约课审核时间扣除)，通过网约课客服提交违规申诉申请。</span></p><p><span style=\"font-size:16px;font-family:宋体\">第三节严重违规行为</span></p><p><span style=\"font-size:16px;font-family:宋体\">第二十二条</span></p><p><span style=\"font-size:16px;font-family:宋体\">发布违禁信息，是指会员发布以下国家法律法规、其他法律规范禁止发布的商品或课程，包括以下情形：</span></p><p><span style=\"font-size:16px;font-family:宋体\">(</span><span style=\"font-size:16px;font-family:宋体\">一)发布课程包含以下信息的：</span></p><p><span style=\"font-size:16px;font-family:宋体\">1</span><span style=\"font-size:16px;font-family:宋体\">、枪支、弹药、军火或相关器材、配件及仿制品；</span></p><p><span style=\"font-size:16px;font-family:宋体\">2</span><span style=\"font-size:16px;font-family:宋体\">、易燃、易爆物品或制作易燃易爆品的相关化学物品；</span></p><p><span style=\"font-size:16px;font-family:宋体\">3</span><span style=\"font-size:16px;font-family:宋体\">、毒品、麻醉品、制毒原料、制毒化学品、致瘾性药物、吸食工具及配件；</span></p><p><span style=\"font-size:16px;font-family:宋体\">4</span><span style=\"font-size:16px;font-family:宋体\">、含有反动、破坏国家统一、破坏主权及领土完整、破坏社会稳定涉及国家机密、扰乱社会秩序，宣扬邪教迷信，宣扬宗教、种族歧视等内容或相关法律法规禁止出版发行的书籍、音像制品、视频、文件资料；</span></p><p><span style=\"font-size:16px;font-family:宋体\">5</span><span style=\"font-size:16px;font-family:宋体\">、人体器官、遗体；</span></p><p><span style=\"font-size:16px;font-family:宋体\">6</span><span style=\"font-size:16px;font-family:宋体\">、用于窃取他人隐私或机密的软件及设备；</span></p><p><span style=\"font-size:16px;font-family:宋体\">7</span><span style=\"font-size:16px;font-family:宋体\">、正在流通的人民币、伪造变造的货币以及印制设备；</span></p><p><span style=\"font-size:16px;font-family:宋体\">8</span><span style=\"font-size:16px;font-family:宋体\">、麻醉注射枪及其相关商品；</span></p><p><span style=\"font-size:16px;font-family:宋体\">9</span><span style=\"font-size:16px;font-family:宋体\">、走私、盗窃、抢劫等非法所得；</span></p><p><span style=\"font-size:16px;font-family:宋体\">10</span><span style=\"font-size:16px;font-family:宋体\">、可致使他人暂时失去反抗能力、意识模糊的口服或外用的化学品，以及含有黄色淫秽内容的商品、信息；</span></p><p><span style=\"font-size:16px;font-family:宋体\">11</span><span style=\"font-size:16px;font-family:宋体\">、涉嫌违反《中华人民共和国文物保护法》相关规定的文物。</span></p><p><span style=\"font-size:16px;font-family:宋体\">(</span><span style=\"font-size:16px;font-family:宋体\">二)发布以下课程信息的：</span></p><p><span style=\"font-size:16px;font-family:宋体\">1</span><span style=\"font-size:16px;font-family:宋体\">、管制类刀具及甩棍、弓、弩、飞镖等可能用于危害他人人身安全的管制器具；</span></p><p><span style=\"font-size:16px;font-family:宋体\">2</span><span style=\"font-size:16px;font-family:宋体\">、卫星信号的地面收发装置；</span></p><p><span style=\"font-size:16px;font-family:宋体\">3</span><span style=\"font-size:16px;font-family:宋体\">、伪造变造的政府机构颁发的文件、证书、公章或仅限国家机关或特定机构方可提供的服务；</span></p><p><span style=\"font-size:16px;font-family:宋体\">4</span><span style=\"font-size:16px;font-family:宋体\">、未经许可发布的奥林匹克运动会、世界博览会、亚洲运动会等特许商品；</span></p><p><span style=\"font-size:16px;font-family:宋体\">5</span><span style=\"font-size:16px;font-family:宋体\">、赌博用具及作弊工具；</span></p><p><span style=\"font-size:16px;font-family:宋体\">6</span><span style=\"font-size:16px;font-family:宋体\">、尚可使用的发票、其它可用于报销的票据以及此类票据的代开服务；</span></p><p><span style=\"font-size:16px;font-family:宋体\">7</span><span style=\"font-size:16px;font-family:宋体\">、精神类、麻醉类、有毒类、放射类药品；</span></p><p><span style=\"font-size:16px;font-family:宋体\">8</span><span style=\"font-size:16px;font-family:宋体\">、粉末、液态催情类商品；</span></p><p><span style=\"font-size:16px;font-family:宋体\">9</span><span style=\"font-size:16px;font-family:宋体\">、国家保护动物的活体、肢体、皮毛、标本、器官及制成品，已灭绝动物与现有国家二级以上保护动物的化石；</span></p><p><span style=\"font-size:16px;font-family:宋体\">10</span><span style=\"font-size:16px;font-family:宋体\">、身份证及身份证验证设备；</span></p><p><span style=\"font-size:16px;font-family:宋体\">11</span><span style=\"font-size:16px;font-family:宋体\">、可能用于侵害他人信息的黑客软件、教程、书籍。</span></p><p><span style=\"font-size:16px;font-family:宋体\">(</span><span style=\"font-size:16px;font-family:宋体\">三)发布以下课程信息的：</span></p><p><span style=\"font-size:16px;font-family:宋体\">1</span><span style=\"font-size:16px;font-family:宋体\">、尚可使用的证券、政府发放的消费劵及相应代购、推荐服务；</span></p><p><span style=\"font-size:16px;font-family:宋体\">2</span><span style=\"font-size:16px;font-family:宋体\">、军警制服、标志及军警专用制品；</span></p><p><span style=\"font-size:16px;font-family:宋体\">3</span><span style=\"font-size:16px;font-family:宋体\">、带有宗教、种族歧视的相关商品或信息；</span></p><p><span style=\"font-size:16px;font-family:宋体\">4</span><span style=\"font-size:16px;font-family:宋体\">、有毒化学物、农药及相关信息；</span></p><p><span style=\"font-size:16px;font-family:宋体\">5</span><span style=\"font-size:16px;font-family:宋体\">、烟草专卖品；</span></p><p><span style=\"font-size:16px;font-family:宋体\">6</span><span style=\"font-size:16px;font-family:宋体\">、含有情色暴力低俗内容的漫画、书籍、游戏、音像制品以及SM用具、成人网站的账号及邀请码、原味二手内衣物、陪聊陪逛服务等情色低俗商品或信息；</span></p><p><span style=\"font-size:16px;font-family:宋体\">7</span><span style=\"font-size:16px;font-family:宋体\">、用于预防、治疗人体疾病的药物、血液制品或医疗器械；</span></p><p><span style=\"font-size:16px;font-family:宋体\">8</span><span style=\"font-size:16px;font-family:宋体\">、个人隐私信息及企业内部数据；</span></p><p><span style=\"font-size:16px;font-family:宋体\">9</span><span style=\"font-size:16px;font-family:宋体\">、国家保护的植物及其制品；</span></p><p><span style=\"font-size:16px;font-family:宋体\">10</span><span style=\"font-size:16px;font-family:宋体\">、由不具备生产资质的生产商生产的或不符合国家、地方、行业、企业强制性标准的商品；</span></p><p><span style=\"font-size:16px;font-family:宋体\">11</span><span style=\"font-size:16px;font-family:宋体\">、各类短信群发设备及软件；</span></p><p><span style=\"font-size:16px;font-family:宋体\">12</span><span style=\"font-size:16px;font-family:宋体\">、撬锁工具、开锁服务及其相关教程、书籍；</span></p><p><span style=\"font-size:16px;font-family:宋体\">13</span><span style=\"font-size:16px;font-family:宋体\">、因产品本身质量危及消费者人身、财产安全危险的产品。</span></p><p><span style=\"font-size:16px;font-family:宋体\">(</span><span style=\"font-size:16px;font-family:宋体\">四)发布以下课程或信息的：</span></p><p><span style=\"font-size:16px;font-family:宋体\">1</span><span style=\"font-size:16px;font-family:宋体\">、可能用于逃避交通管理的商品；</span></p><p><span style=\"font-size:16px;font-family:宋体\">2</span><span style=\"font-size:16px;font-family:宋体\">、未经许可的募捐类商品；</span></p><p><span style=\"font-size:16px;font-family:宋体\">3</span><span style=\"font-size:16px;font-family:宋体\">、未公开发行的国家级正式考试答案等未被允许公开发行的书籍音像类制品；</span></p><p><span style=\"font-size:16px;font-family:宋体\">4</span><span style=\"font-size:16px;font-family:宋体\">、发行时带有银行账户信息的银行卡；</span></p><p><span style=\"font-size:16px;font-family:宋体\">5</span><span style=\"font-size:16px;font-family:宋体\">、非法软件或密码破解找回等非法网络服务；</span></p><p><span style=\"font-size:16px;font-family:宋体\">6</span><span style=\"font-size:16px;font-family:宋体\">、特供酒、军需酒、自制酒；</span></p><p><span style=\"font-size:16px;font-family:宋体\">7</span><span style=\"font-size:16px;font-family:宋体\">、用于全新销售的伪造变造的数码商品；</span></p><p><span style=\"font-size:16px;font-family:宋体\">8</span><span style=\"font-size:16px;font-family:宋体\">、经权威质检部门或生产商认定、公布或召回的商品，国家明令淘汰或停止销售的商品，商品本身或外包装上所注明的产品标准、认证标志、成份及含量不符合国家规定的商品，过期、失效、变质的商品，以及含有罂粟籽的食品、调味品、护肤品等制成品；</span></p><p><span style=\"font-size:16px;font-family:宋体\">9</span><span style=\"font-size:16px;font-family:宋体\">、非法传销类商品；</span></p><p><span style=\"font-size:16px;font-family:宋体\">10</span><span style=\"font-size:16px;font-family:宋体\">、制作毒品、易燃易爆品的方法、书籍；</span></p><p><span style=\"font-size:16px;font-family:宋体\">11</span><span style=\"font-size:16px;font-family:宋体\">、利用电话线路上的直流馈电发光的灯；</span></p><p><span style=\"font-size:16px;font-family:宋体\">12</span><span style=\"font-size:16px;font-family:宋体\">、国家禁止的集邮票品以及未经邮政行业管理部门批准制作的集邮品，以及一九四九年之后发行的包含“中华民国”字样的邮品；</span></p><p><span style=\"font-size:16px;font-family:宋体\">13</span><span style=\"font-size:16px;font-family:宋体\">、算命、超度、风水、做法事等封建迷信类服务；</span></p><p><span style=\"font-size:16px;font-family:宋体\">14</span><span style=\"font-size:16px;font-family:宋体\">、一卡多号以及带破解功能的手机卡贴；</span></p><p><span style=\"font-size:16px;font-family:宋体\">15</span><span style=\"font-size:16px;font-family:宋体\">、外挂、私服相关的网游类商品。</span></p><p><span style=\"font-size:16px;font-family:宋体\">16</span><span style=\"font-size:16px;font-family:宋体\">、官方已停止经营的游戏点卡或平台卡商品；</span></p><p><span style=\"font-size:16px;font-family:宋体\">17</span><span style=\"font-size:16px;font-family:宋体\">、虚拟抽奖类商品；</span></p><p><span style=\"font-size:16px;font-family:宋体\">18</span><span style=\"font-size:16px;font-family:宋体\">、所有境外（含台服）游戏点卡、货币等相关服务类商品。</span></p><p><span style=\"font-size:16px;font-family:宋体\">第二十三条</span></p><p><span style=\"font-size:16px;font-family:宋体\">盗用他人账户，是指盗用他人网约课账户，涉嫌侵犯他人财产权的行为。</span></p><p><span style=\"font-size:16px;font-family:宋体\">第二十四条</span></p><p><span style=\"font-size:16px;font-family:宋体\">泄露他人信息，是指未经允许发布、传递他人隐私信息，涉嫌侵犯他人隐私权的行为。</span></p><p><span style=\"font-size:16px;font-family:宋体\">第二十五条</span></p><p><span style=\"font-size:16px;font-family:宋体\">骗取他人财物，是指以非法获利为目的，非法获取他人财物，涉嫌侵犯他人财产权的行为。</span></p><p><span style=\"font-size:16px;font-family:宋体\">第二十六条</span></p><p><span style=\"font-size:16px;font-family:宋体\">扰乱网约课秩序，是指通过不正当方式，刻意规避、扰乱网约课规则或网络监管措施的行为。</span></p><p><span style=\"font-size:16px;font-family:宋体\">第四节一般违规行为</span></p><p><span style=\"font-size:16px;font-family:宋体\">第二十七条</span></p><p><span style=\"font-size:16px;font-family:宋体\">滥发信息，是指用户未按本规则要求发布课程或服务信息，妨害其他用户的行为，包括以下情形：</span></p><p><span style=\"font-size:16px;font-family:宋体\">(</span><span style=\"font-size:16px;font-family:宋体\">一)发布以下商品或信息的：</span></p><p><span style=\"font-size:16px;font-family:宋体\">1.</span><span style=\"font-size:16px;font-family:宋体\">网约课币、网约课SVIP/VIP会员、网约课提供的各项服务账号；</span></p><p><span style=\"font-size:16px;font-family:宋体\">2</span><span style=\"font-size:16px;font-family:宋体\">、未经许可发布专营类目所属商品；</span></p><p><span style=\"font-size:16px;font-family:宋体\">3</span><span style=\"font-size:16px;font-family:宋体\">、鱼翅、熊胆及其制品；</span></p><p><span style=\"font-size:16px;font-family:宋体\">4</span><span style=\"font-size:16px;font-family:宋体\">、不限时间与流量的、时间不可查询的以及被称为漏洞卡、集团卡、内部卡、测试卡的3G上网资费卡及SIM卡；</span></p><p><span style=\"font-size:16px;font-family:宋体\">5</span><span style=\"font-size:16px;font-family:宋体\">、时间不可查询的虚拟服务类商品；</span></p><p><span style=\"font-size:16px;font-family:宋体\">6</span><span style=\"font-size:16px;font-family:宋体\">、网络账户、死保账号以及腾讯QQ账号；</span></p><p><span style=\"font-size:16px;font-family:宋体\">7</span><span style=\"font-size:16px;font-family:宋体\">、平台卡商品其所属平台未经网约课备案的；</span></p><p><span style=\"font-size:16px;font-family:宋体\">8</span><span style=\"font-size:16px;font-family:宋体\">、自动发货形式的一卡通系列商品；</span></p><p><span style=\"font-size:16px;font-family:宋体\">9</span><span style=\"font-size:16px;font-family:宋体\">、未带有平台代充标识的QQ增值业务商品；</span></p><p><span style=\"font-size:16px;font-family:宋体\">10</span><span style=\"font-size:16px;font-family:宋体\">、盛付通商品及穿越火线道具类商品；</span></p><p><span style=\"font-size:16px;font-family:宋体\">11</span><span style=\"font-size:16px;font-family:宋体\">、秒杀器以及用于提高秒杀成功概率的相关软件设备；</span></p><p><span style=\"font-size:16px;font-family:宋体\">12</span><span style=\"font-size:16px;font-family:宋体\">、代写论文、代考试类相关服务；</span></p><p><span style=\"font-size:16px;font-family:宋体\">13</span><span style=\"font-size:16px;font-family:宋体\">、法律咨询、心理咨询、金融咨询、医生在线咨询的服务；</span></p><p><span style=\"font-size:16px;font-family:宋体\">14</span><span style=\"font-size:16px;font-family:宋体\">、不可查询的分期返还话费类商品；</span></p><p><span style=\"font-size:16px;font-family:宋体\">15</span><span style=\"font-size:16px;font-family:宋体\">、虚拟代刷服务类商品；</span></p><p><span style=\"font-size:16px;font-family:宋体\">16</span><span style=\"font-size:16px;font-family:宋体\">、慢充卡等实际无法在72小时内到账的虚拟商品；</span></p><p><span style=\"font-size:16px;font-family:宋体\">17</span><span style=\"font-size:16px;font-family:宋体\">、群发短信服务、SP业务自消费类商品；</span></p><p><span style=\"font-size:16px;font-family:宋体\">18</span><span style=\"font-size:16px;font-family:宋体\">、Itunes账号及用户充值类商品。</span></p><p><span style=\"font-size:16px;font-family:宋体\">(</span><span style=\"font-size:16px;font-family:宋体\">二)在网约课面发布以下信息：</span></p><p><span style=\"font-size:16px;font-family:宋体\">1.</span><span style=\"font-size:16px;font-family:宋体\">个人手机定位、电话清单查询、银行账户查询；</span></p><p><span style=\"font-size:16px;font-family:宋体\">2.</span><span style=\"font-size:16px;font-family:宋体\">代扣驾照分数服务；</span></p><p><span style=\"font-size:16px;font-family:宋体\">3.</span><span style=\"font-size:16px;font-family:宋体\">支付宝免签约即时到帐接口；</span></p><p><span style=\"font-size:16px;font-family:宋体\">4.</span><span style=\"font-size:16px;font-family:宋体\">尚可使用的外贸单证以及代理报关、清单、商检、单证手续的服务；</span></p><p><span style=\"font-size:16px;font-family:宋体\">5.</span><span style=\"font-size:16px;font-family:宋体\">明示、暗示具有治疗、保健功效或者某种营养素功能的食品，或者以个体经验进行宣传的食品；</span></p><p><span style=\"font-size:16px;font-family:宋体\">6.</span><span style=\"font-size:16px;font-family:宋体\">邮局包裹、EMS专递、快递等物流单据凭证及单号；</span></p><p><span style=\"font-size:16px;font-family:宋体\">7.</span><span style=\"font-size:16px;font-family:宋体\">大量流通中的外币；</span></p><p><span style=\"font-size:16px;font-family:宋体\">8.</span><span style=\"font-size:16px;font-family:宋体\">手机直拨卡与直拨业务，电话回拨卡与回拨业务；</span></p><p><span style=\"font-size:16px;font-family:宋体\">9.</span><span style=\"font-size:16px;font-family:宋体\">炒作博客人气、炒作网站人气、代投票类商品或信息；</span></p><p><span style=\"font-size:16px;font-family:宋体\">10.</span><span style=\"font-size:16px;font-family:宋体\">捕鸟器及猫狗肉、猫狗皮、猫狗皮制品；</span></p><p><span style=\"font-size:16px;font-family:宋体\">11.</span><span style=\"font-size:16px;font-family:宋体\">代他人申请具有专属性的权利；</span></p><p><span style=\"font-size:16px;font-family:宋体\">12.</span><span style=\"font-size:16px;font-family:宋体\">注射类美白针剂、溶脂针剂、填充针剂、瘦身针剂等用于人体注射的美容针剂类商品。</span></p><p><span style=\"font-size:16px;font-family:宋体\">(</span><span style=\"font-size:16px;font-family:宋体\">三)使用以下不当方式发布课程信息的：</span></p><p><span style=\"font-size:16px;font-family:宋体\">1.</span><span style=\"font-size:16px;font-family:宋体\">在非课程发布栏目内发布课程信息。</span></p><p><span style=\"font-size:16px;font-family:宋体\">2.</span><span style=\"font-size:16px;font-family:宋体\">禁止将课程信息发布在与其不符的栏目内。</span></p><p><span style=\"font-size:16px;font-family:宋体\">(</span><span style=\"font-size:16px;font-family:宋体\">四)在合作页面、出售栏内发布以下错误描述的商品或服务信息：</span></p><p><span style=\"font-size:16px;font-family:宋体\">1. </span><span style=\"font-size:16px;font-family:宋体\">课程信息中缺少标题、图片或视频，缺少课程本身的实物图片；</span></p><p><span style=\"font-size:16px;font-family:宋体\">2. </span><span style=\"font-size:16px;font-family:宋体\">课程标题、图片、价格、及服务等课程要素之间明显不匹配；</span></p><p><span style=\"font-size:16px;font-family:宋体\">3. </span><span style=\"font-size:16px;font-family:宋体\">课程标题等信息不实或者与本课程无关的；</span></p><p><span style=\"font-size:16px;font-family:宋体\">4.</span><span style=\"font-size:16px;font-family:宋体\">使用与课程信息不符的标识；</span></p><p><span style=\"font-size:16px;font-family:宋体\">5. </span><span style=\"font-size:16px;font-family:宋体\">课程与所发布的专业类别或属性不符的；</span></p><p><span style=\"font-size:16px;font-family:宋体\">6</span><span style=\"font-size:16px;font-family:宋体\">、课程与所发布的专业类别或属性不符且造成严重后果的。</span></p><p><span style=\"font-size:16px;font-family:宋体\">第二十八条</span></p><p><span style=\"font-size:16px;font-family:宋体\">描述不符，是指其他会员观看到的课程与达成交易时会员对课程的描述不相符，会员未对课程内容、方向、附带品等必须说明的信息进行披露，妨害其他会员权益的行为，包括以下情形：</span></p><p><span style=\"font-size:16px;font-family:宋体\">(</span><span style=\"font-size:16px;font-family:宋体\">一)会员对课程内容、方向、品质等信息的描述与其他会员收到的课程内容严重不符，或导致其他会员无法正常使用的；</span></p><p><span style=\"font-size:16px;font-family:宋体\">(</span><span style=\"font-size:16px;font-family:宋体\">二)会员未对课程内容等信息进行披露或对课程内容的描述与其他会员收到的课程内容不相符，且影响其他会员正常使用的；</span></p><p><span style=\"font-size:16px;font-family:宋体\">(</span><span style=\"font-size:16px;font-family:宋体\">三)会员未对课程内容等信息进行披露或对课程内容的描述与其他课程内容观看到的商品不相符，但未对其他会员正常使用造成实质性影响的。</span></p><p><span style=\"font-size:16px;font-family:宋体\">第二十九条</span></p><p><span style=\"font-size:16px;font-family:宋体\">违背承诺，是指会员未按照承诺向其他会员提供以下服务，妨害其他会员的行为，包括以下情形：</span></p><p><span style=\"font-size:16px;font-family:宋体\">(</span><span style=\"font-size:16px;font-family:宋体\">一)加入网约课官方活动的会员，未按照活动要求提供服务的；</span></p><p><span style=\"font-size:16px;font-family:宋体\">(</span><span style=\"font-size:16px;font-family:宋体\">二)会员未履行其它承诺的。</span></p><p><span style=\"font-size:16px;font-family:宋体\">第三十条</span></p><p><span style=\"font-size:16px;font-family:宋体\">恶意骚扰，是指会员采取恶劣手段骚扰其他会员，妨害其他会员的行为。</span></p><p><span style=\"font-size:16px;font-family:宋体\">第三十一条</span></p><p><span style=\"font-size:16px;font-family:宋体\">不当注册，是指用户通过软件、程序等方式，大批量注册网约课账户，妨害网约课运营秩序的行为。</span></p><p><span style=\"font-size:16px;font-family:宋体\">第三十二条</span></p><p><span style=\"font-size:16px;font-family:宋体\">不当使用他人权利，是指用户发生以下行为：</span></p><p><span style=\"font-size:16px;font-family:宋体\">(</span><span style=\"font-size:16px;font-family:宋体\">一)会员在所发布的课程内容信息或所使用的课程名、域名等中不当使用他人商标权、著作权等权利的；</span></p><p><span style=\"font-size:16px;font-family:宋体\">(</span><span style=\"font-size:16px;font-family:宋体\">二)会员出售课程涉嫌不当使用他人商标权、著作权、专利权等权利的；</span></p><p><span style=\"font-size:16px;font-family:宋体\">(</span><span style=\"font-size:16px;font-family:宋体\">三)会员所发布的课程信息或所使用的其他信息造成混淆、误认或造成不正当竞争的。</span></p><p><span style=\"font-size:16px;font-family:宋体\">第五节违规的执行</span></p><p><span style=\"font-size:16px;font-family:宋体\">第三十三条</span></p><p><span style=\"font-size:16px;font-family:宋体\">用户的违规行为，通过网约课会员、权利人的投诉或网约课排查发现。</span></p><p><span style=\"font-size:16px;font-family:宋体\">第三十四条</span></p><p><span style=\"font-size:16px;font-family:宋体\">对违规行为的投诉，除滥发信息、不当注册、发布违禁信息、出售假冒课程、不当使用他人权利、盗用他人账户、泄露他人信息可随时提交投诉外，其余须在以下规定时间内进行投诉；未在规定时间内投诉的，不予受理：</span></p><p><span style=\"font-size:16px;font-family:宋体\">（一）描述不符、骗取他人财物的投诉时间为交易成功后十五天内；</span></p><p><span style=\"font-size:16px;font-family:宋体\">（二）网约课保证金相关投诉时间为，交易成功或违反网约课消费者保障协议的行为发生后十五天内。</span></p><p><span style=\"font-size:16px;font-family:宋体\">第三十五条</span></p><p><span style=\"font-size:16px;font-family:宋体\">会员自行作出的承诺或说明与本规则相悖的，网约课不予采信。除有充分证据证明有误或判断错误的情形外，对违规行为的处理不中止、不撤销。</span></p><p><span style=\"font-size:16px;font-family:宋体\">第六章网约课言论规则</span></p><p><span style=\"font-size:16px;font-family:宋体\">第三十六条</span></p><p><span style=\"font-size:16px;font-family:宋体\">会员有依网站规则在网站内活动和发表言论的权利和义务。</span></p><p><span style=\"font-size:16px;font-family:宋体\">第三十七条</span></p><p><span style=\"font-size:16px;font-family:宋体\">会员在网约课内的言论(包括但不限于文字、图片、音频、视频，下同)不得违反国家的法律法规。根据《互联网新闻信息服务管理规定》，会员的言论不得含有下列内容：</span></p><p><span style=\"font-size:16px;font-family:宋体\">(</span><span style=\"font-size:16px;font-family:宋体\">一)违反宪法确定的基本原则的；</span></p><p><span style=\"font-size:16px;font-family:宋体\">(</span><span style=\"font-size:16px;font-family:宋体\">二)危害国家安全，泄露国家秘密，颠覆国家政权，破坏国家统一的；</span></p><p><span style=\"font-size:16px;font-family:宋体\">(</span><span style=\"font-size:16px;font-family:宋体\">三)损害国家荣誉和利益的；</span></p><p><span style=\"font-size:16px;font-family:宋体\">(</span><span style=\"font-size:16px;font-family:宋体\">四)煽动民族仇恨、民族歧视，破坏民族团结的；</span></p><p><span style=\"font-size:16px;font-family:宋体\">(</span><span style=\"font-size:16px;font-family:宋体\">五)破坏国家宗教政策，宣扬邪教和封建迷信的；</span></p><p><span style=\"font-size:16px;font-family:宋体\">(</span><span style=\"font-size:16px;font-family:宋体\">六)散布谣言，扰乱社会秩序，破坏社会稳定的；</span></p><p><span style=\"font-size:16px;font-family:宋体\">(</span><span style=\"font-size:16px;font-family:宋体\">七)散布淫秽、色情、赌博、暴力、恐怖或者教唆犯罪的；</span></p><p><span style=\"font-size:16px;font-family:宋体\">(</span><span style=\"font-size:16px;font-family:宋体\">八)侮辱或者诽谤他人，侵害他人合法权益的；</span></p><p><span style=\"font-size:16px;font-family:宋体\">(</span><span style=\"font-size:16px;font-family:宋体\">九)煽动非法集会、结社、游行、示威、聚众扰乱社会秩序的；</span></p><p><span style=\"font-size:16px;font-family:宋体\">(</span><span style=\"font-size:16px;font-family:宋体\">十)以非法民间组织名义活动的；</span></p><p><span style=\"font-size:16px;font-family:宋体\">(</span><span style=\"font-size:16px;font-family:宋体\">十一)含有法律、行政法规禁止的其他内容的。</span></p><p><span style=\"font-size:16px;font-family:宋体\">第三十八条</span></p><p><span style=\"font-size:16px;font-family:宋体\">会员的言论应符合网站规则以及所在分区和版的规则。</span></p><p><span style=\"font-size:16px;font-family:宋体\">会员发言前应了解所在版块的讨论主题和相关规定，不发表与版规不符的言论，不在他人发布的消息中发表与该信息内容无关的言论。</span></p><p><span style=\"font-size:16px;font-family:宋体\">对他人或者网约课公职人员的投诉应发表在指定的地点。</span></p><p><span style=\"font-size:16px;font-family:宋体\">会员应尊重他人的知识产权，不得剽窃他人作品，转载和引用他人作品时应符合版权许可的要求。</span></p><p><span style=\"font-size:16px;font-family:宋体\">第三十九条</span></p><p><span style=\"font-size:16px;font-family:宋体\">会员应遵守网络秩序和网络道德，不得污言秽语，不得进行刷屏、恶意顶贴、恶意灌水等影响他人阅读的行为。</span></p><p><span style=\"font-size:16px;font-family:宋体\">第四十条</span></p><p><span style=\"font-size:16px;font-family:宋体\">会员应尊重他人隐私，除非涉及公众利益或者经当事人同意，不得发表他人的姓名、住址、电话等个人资料以及其他隐私信息。</span></p><p><span style=\"font-size:16px;font-family:宋体\">第四十一条</span></p><p><span style=\"font-size:16px;font-family:宋体\">会员在网站内发表违规言论的，网约课有权删除其全部或部分言论，并视情节和危害结果，对其给予适当的处罚。</span></p><p><span style=\"font-size:16px;font-family:宋体\">第四十二条</span></p><p><span style=\"font-size:16px;font-family:宋体\">会员应对自己的言论承担责任。</span></p><p><br/></p>', '0');
INSERT INTO `xieyi` VALUES (13, '网约课学员协议', '<h1 label=\"标题居中\" style=\"font-size: 32px; font-weight: bold; border-bottom: 2px solid rgb(204, 204, 204); padding: 0px 4px 0px 0px; text-align: center; margin: 0px 0px 20px;\"><span style=\"font-size: 36px;\"><strong><span style=\"font-family: 宋体;\">网约课学员协议</span></strong></span></h1><p><strong><span style=\"font-size:21px;font-family:宋体\">特别提醒：</span></strong></p><p><span style=\"font-size:21px;font-family:宋体\">为保障学员在教育实践中的权益，建立良好的教育环境，保证教育质量，特与学员签订本协议，请学员在确认并签署前仔细阅读本协议，全面阅读并理解本协议全部内容后在协议下方点击同意，然后开始</span><span style=\"font-size:21px;font-family:宋体\">网约课</span><span style=\"font-size:21px;font-family:宋体\">的体验。</span></p><p><span style=\"font-size:21px;font-family:宋体\">感谢您对网约课的信任与支持，祝您在网约课学习愉快！</span></p><p><span style=\"font-size:21px;font-family:宋体\">网约课</span><span style=\"font-size:21px;font-family:宋体\">（以下简称“甲方”，官方网址www.wyuek.com）与学员（以下简称“乙方”）依照相关法律法规的规定，本着平等互利原则，经友好协商，甲方同意按照本协议的条款，为乙方提供乙方所购买的教学辅导培训服务。协议具体条款如下：</span></p><p><strong><span style=\"font-size:21px;font-family: 宋体\">一、定义条款</span></strong></p><p><span style=\"font-size:21px;font-family:宋体\">甲方平台所代售的教学辅导培训服务是指由甲方（www. wyuek.com）推出的向注册学员提供的教学辅导培训服务，服务内容及要求详见乙方在甲方平台所选择课程及项目的详细说明。</span></p><p><strong><span style=\"font-size:21px;font-family: 宋体\">二、辅导培训</span></strong></p><p><span style=\"font-size:21px;font-family:宋体\">1</span><span style=\"font-size:21px;font-family:宋体\">．乙方经慎重考虑并仔细阅读及理解本协议，同意根据本协议约定参加甲方举办的在线辅导培训课程，甲方亦同意根据本协议的约定为乙方提供对应课程科目的培训辅导。</span></p><p><span style=\"font-size:21px;font-family:宋体\">2</span><span style=\"font-size:21px;font-family:宋体\">．乙方确认并签署本协议，根据甲方要求完成注册、交费，即可成为甲方对应培训项目的学员，享受甲方提供的对应课程科目的辅导培训。</span></p><p><span style=\"font-size:21px;font-family:宋体\">3</span><span style=\"font-size:21px;font-family:宋体\">．甲乙双方共同认为，乙方及时、全面的完成甲方专门设置的学习课程，是乙方通过对应科目辅导考核的重要保障，为此，甲方将为乙方设计和提供优质的课程辅导及学习计划，乙方承诺按照甲方的课程辅导和学习计划要求参加该辅导课程。</span></p><p><span style=\"font-size:21px;font-family:宋体\">三、辅导科目、费用及费用支付</span></p><p><span style=\"font-size:21px;font-family:宋体\">甲方所提供的培训辅导科目名称，内容，费用标准及支付方式以乙方在甲方平台所选择的课程说明为准。</span></p><p><strong><span style=\"font-size:24px;font-family: 宋体\">四、甲方的权利与义务</span></strong></p><p><span style=\"font-size:21px;font-family:宋体\">1</span><span style=\"font-size: 21px;font-family:宋体\">．权利</span></p><p><span style=\"font-size:21px;font-family:宋体\">1.1 </span><span style=\"font-size:21px;font-family:宋体\">甲方有权根据本协议约定获得乙方交纳的培训辅导费及与之相关的其他费用。</span></p><p><span style=\"font-size:21px;font-family:宋体\">1.2 </span><span style=\"font-size:21px;font-family:宋体\">甲方有权根据本协议的约定要求乙方提供与乙方接受培训相关的个人真实信息、资料等。</span></p><p><span style=\"font-size:21px;font-family:宋体\">1.3 </span><span style=\"font-size:21px;font-family:宋体\">甲方有权根据市场及实际需要，开展有针对性的销售活动，拓展甲方市场，促进各方共赢。</span></p><p><span style=\"font-size:21px;font-family:宋体\">2</span><span style=\"font-size: 21px;font-family:宋体\">．义务</span></p><p><span style=\"font-size:21px;font-family:宋体\">2.1 </span><span style=\"font-size:21px;font-family:宋体\">甲方应按照约定提供对应的培训辅导服务。</span></p><p><span style=\"font-size:21px;font-family:宋体\">2.2 </span><span style=\"font-size:21px;font-family:宋体\">甲方保证所提供的各项服务均能够正常使用；如因不可抗力以及学员一方的原因（包括但不限于互联</span><span style=\"font-size: 24px;font-family:宋体\">网运营商提</span><span style=\"font-size:21px;font-family:宋体\">供的网络中断、乙方不具备正常上网条件等）造成不能正常使用甲方所提供的各项服务的，甲方免责。</span></p><p><span style=\"font-size:21px;font-family:宋体\">2.3 </span><span style=\"font-size:21px;font-family:宋体\">甲方需对乙方提供的个人信息资料承担保密义务。</span></p><p><strong><span style=\"font-size:24px;font-family: 宋体\">五、乙方的权利与义务</span></strong></p><p><span style=\"font-size:21px;font-family:宋体\">1</span><span style=\"font-size: 21px;font-family:宋体\">．乙方权利</span></p><p><span style=\"font-size:21px;font-family:宋体\">乙方在按照本协议的规定交纳全部学习费用后，有权利享受甲方所提供培训辅导服务。</span></p><p><span style=\"font-size:21px;font-family:宋体\">2</span><span style=\"font-size: 21px;font-family:宋体\">．乙方义务</span></p><p><span style=\"font-size:21px;font-family:宋体\">2.1 </span><span style=\"font-size:21px;font-family:宋体\">乙方应按时、全额交纳学习费用。</span></p><p><span style=\"font-size:21px;font-family:宋体\">2.2 </span><span style=\"font-size:21px;font-family:宋体\">乙方应提供真实、有效的身份信息，包括：</span></p><p><span style=\"font-size:21px;font-family:宋体\">（1）身份信息或者国家规定的其他合法身份证明文件；</span></p><p><span style=\"font-size:21px;font-family:宋体\">（2）通信地址，联系电话（包括手机及固定电话）；</span></p><p><span style=\"font-size:21px;font-family:宋体\">（3）</span><span style=\"font-size:21px;font-family:宋体\">网约课</span><span style=\"font-size:21px;font-family:宋体\">网站注册账号UID；</span></p><p><span style=\"font-size:21px;font-family:宋体\">（4）与履行本协议有关的其他合法有效的信息。</span></p><p><span style=\"font-size:21px;font-family:宋体\">2.3&nbsp;</span><span style=\"font-size:21px;font-family:宋体\">乙方应遵守甲方的培训辅导计划和课程安排，按照计划规定完成甲方提供的课程辅导，因乙方未能按照计划完成课程培训的或影响培训结果的，甲方对此不承担任何责任；</span></p><p><span style=\"font-size:21px;font-family:宋体\">2.4 </span><span style=\"font-size:21px;font-family:宋体\">乙方不得向其他任何第三方透漏或发布所学习课程内容或者将自己的注册账号提供给任何第三方使用</span><span style=\"font-size: 24px;font-family:宋体\">。</span></p><p><strong><span style=\"font-size:27px;font-family: 宋体\">六、退款条款</span></strong></p><p><span style=\"font-size:24px;font-family:宋体\">1.&nbsp;</span><span style=\"font-size:24px;font-family:宋体\">乙方确认本协议并按照协议要求付费后不得要求退款，在以下情况下，经双方协商一致，乙方可向甲方提出退款退学申请，甲方视情况给予乙方进行部分退费（书费及相关的资料费一概不退）：</span></p><p><span style=\"font-size:24px;font-family:宋体\">1.1 </span><span style=\"font-size:24px;font-family:宋体\">协议生效后3日内，乙方可申请全额退款退学；</span></p><p><span style=\"font-size:24px;font-family:宋体\">1.2 </span><span style=\"font-size:24px;font-family:宋体\">协议生效满3日不满一周的，确因特殊原因不能继续完成学业，经乙方申请且甲方同意的，甲方将根据乙方实际上课天数及所学习的课时数计算课时费并自乙方已经缴纳的费用中扣除，剩余费用退还乙方；</span></p><p><span style=\"font-size:24px;font-family:宋体\">退款计算公式</span></p><p><span style=\"font-size:24px;font-family:宋体\"><img width=\"440\" height=\"35\" src=\"http://www.wyuek.com/Public/Admin/lib/ueditor/1.4.3/themes/default/images/spacer.gif\" word_img=\"file:///C:/Users/ADMINI~1/AppData/Local/Temp/msohtmlclip1/01/clip_image002.gif\" style=\"background:url(http://www.wyuek.com/Public/Admin/lib/ueditor/1.4.3/themes/default/images/word.gif) no-repeat center center;border:1px solid #ddd\"/></span></p><p><span style=\"font-size:24px;font-family:宋体\">2</span><span style=\"font-size: 24px;font-family:宋体\">．乙方有如下情况之一的，无权要求甲方退还所缴纳的培训费用：</span></p><p><span style=\"font-size:24px;font-family:宋体\">2.1 </span><span style=\"font-size:24px;font-family:宋体\">乙方在签订或履行本协议过程中，参加甲方提供的课程培训过程中或要求乙方退款等过程中未提供真实的个人信息或提供其他虚假伪造信息的：</span></p><p><span style=\"font-size:24px;font-family:宋体\">2.2 </span><span style=\"font-size:24px;font-family:宋体\">乙方未在甲方规定的退款时间内向甲方提交书面退款要求及甲方要求的全部材料；</span></p><p><span style=\"font-size:24px;font-family:宋体\">2.3 </span><span style=\"font-size:24px;font-family:宋体\">未经甲方同意，乙方向其他任何第三方透露课程及辅导资料内容，或者由于乙方的失误，导致其他任何第三方获知课程或辅导资料内容的。</span></p><p><span style=\"font-size:24px;font-family:宋体\">3</span><span style=\"font-size: 24px;font-family:宋体\">．以下情况，甲方概不退费：</span></p><p><span style=\"font-size:24px;font-family:宋体\">3.1 </span><span style=\"font-size:24px;font-family:宋体\">学员以优惠价格或利用活动报名参加培训辅导的；</span></p><p><span style=\"font-size:24px;font-family:宋体\">3.2 </span><span style=\"font-size:24px;font-family:宋体\">因甲方课程调整，乙方接受甲方新课程调整方案并接受新课程辅导培训服务的；</span></p><p><span style=\"font-size:24px;font-family:宋体\">3.3 </span><span style=\"font-size:24px;font-family:宋体\">学员在接受甲方的培训辅导服务期间，向甲方申请并经甲方同意办理过转班、插班或课时保留的。</span></p><p><strong><span style=\"font-size:21px;font-family: 宋体\">七、不可抗力</span></strong></p><p><span style=\"font-size:21px;font-family:宋体\">不可抗力指无法预见、无法避免或无法克服，以致不能履行或不能如期履行本协议的情况及事件，这类事件包括但不限于意外事件（如战争等）、自然灾害（如地震、火灾、水灾等）、政府行为或其它任何无法预见或避免的事件。</span></p><p><span style=\"font-size:21px;font-family:宋体\">任何一方因不可抗力原因不履行或延迟履行本协议规定的义务，则相应的免除该方应当承担的违约责任；不可抗力事由发生后，受不可抗力影响的一方应在10个工作日内将有关情况及时通知对方（甲方可通过网站公告方式通知乙方）。</span></p><p><span style=\"font-size:21px;font-family:宋体\">在不可抗力因素消除后，受不可抗力影响而未能履约的一方应尽最大努力恢复履行其在本协议项下的义务或与协议相对人协商解除本协议。</span></p><p><strong><span style=\"font-size:27px;font-family: 宋体\">八、争议的解决</span></strong></p><p><span style=\"font-size:21px;font-family:宋体\">1</span><span style=\"font-size:21px;font-family:宋体\">．本协议的订立、执行、解释及争议的解决均应适用中国法律；</span></p><p><span style=\"font-size:21px;font-family:宋体\">2</span><span style=\"font-size:21px;font-family:宋体\">．履行本协议过程中，协议双方如有争议，应友好协商；如协商不成，与本协议有关的纠纷应提交</span><span style=\"font-size:21px;font-family:宋体\">网约课</span><span style=\"font-size:21px;font-family:宋体\">公司所在地法院诉讼解决。</span></p><p><span style=\"font-size:21px;font-family:宋体\">九、其它</span></p><p><span style=\"font-size:21px;font-family:宋体\">1</span><span style=\"font-size:21px;font-family:宋体\">．<strong>乙方需认真阅读并确认本协议，一经确认即视为乙方同意接受本协议的全部约定，</strong>本协议即时生效，双方均应按照本协议要求享有权</span><span style=\"font-size:19px;font-family:宋体\">利，履行义务。</span></p><p><span style=\"font-size:24px;font-family:宋体\">2</span><span style=\"font-size:24px;font-family:宋体\">．本协议解释权归甲方所有。</span></p><p><span style=\"font-size:19px;font-family:宋体\">&nbsp;</span></p><p><br/></p>', '3');
INSERT INTO `xieyi` VALUES (14, '网约课隐私政策', '<h1 label=\"标题居中\" style=\"font-size: 32px; font-weight: bold; border-bottom: 2px solid rgb(204, 204, 204); padding: 0px 4px 0px 0px; text-align: center; margin: 0px 0px 20px;\"><span style=\"font-size: 36px;\"><strong><span style=\"font-family: 宋体;\">网约课隐私政策</span></strong></span></h1><p><span style=\"font-size:27px;font-family:宋体\">一、引言</span></p><p><span style=\"font-size:27px;font-family:宋体\">网约课重视和维护用户的隐私。您在使用我们的服务时，我们可能会收集和使用您的相关信息。我们希望通过《网约课隐私政策》向您说明，在使用我们的服务时，我们如何收集、使用、储存和分享这些信息，以及我们为您提供的访问、更新、控制和保护这些信息的方式。《网约课隐私政策》与您所使用的网约课服务息息相关，希望您仔细阅读，在需要时，按照《网约课隐私政策》的指引，作出您认为适当的选择。本《网约课隐私政策》中涉及的相关技术词汇，我们尽量简明扼要的表述，以便您更好的理解。</span></p><p><strong><span style=\"font-size:27px;font-family:宋体\">您使用或继续使用我们的服务，即意味着同意我们按照《网约课隐私政策》收集、使用、储存和分享您的相关信息。</span></strong></p><p><span style=\"font-size:27px;font-family:宋体\">如对本《网约课隐私政策》或相关事宜有任何问题，请通过网约课在线客服与我们联系。</span></p><p><span style=\"font-size:27px;font-family:宋体\">二、我们可能收集的信息</span></p><p><span style=\"font-size:27px;font-family:宋体\">我们提供服务时，可能会收集、储存和使用下列与您有关的信息。如果您不提供相关信息，可能无法注册成为我们的用户或无法享受我们提供的某些服务，或者无法达到相关服务拟达到的效果。</span></p><p><span style=\"font-size:27px\">1.</span><span style=\"font-size:27px;font-family:宋体\">您提供的信息</span></p><p><span style=\"font-size:27px;font-family:宋体\">您在注册账户或使用我们的服务时，向我们提供的相关个人信息，例如身份证信息、电话号码、电子邮箱号码等；</span></p><p><span style=\"font-size:27px;font-family:宋体\">您通过我们的服务向其他方提供的共享信息，以及您使用我们的服务时所储存的信息。</span></p><p><span style=\"font-size:27px\">2.</span><span style=\"font-size:27px;font-family:宋体\">其他方分享的您的信息</span></p><p><span style=\"font-size:27px;font-family:宋体\">其他方使用我们的服务时所提供有关您的共享信息。</span></p><p><span style=\"font-size:27px\">3.</span><span style=\"font-size:27px;font-family:宋体\">我们获取的您的信息</span></p><p><span style=\"font-size:27px;font-family:宋体\">您使用服务时我们可能收集如下信息：</span></p><p><span style=\"font-size:27px;font-family:宋体\">日志信息，指您使用我们的服务时，系统可能通过</span><span style=\"font-size:27px\">cookies</span><span style=\"font-size:27px;font-family:宋体\">、</span><span style=\"font-size:27px\">webbeacon</span><span style=\"font-size:27px;font-family:宋体\">或其他方式自动采集的技术信息，包括：</span></p><p><span style=\"font-size:27px;font-family:宋体\">（</span><span style=\"font-size:27px\">1</span><span style=\"font-size:27px;font-family:宋体\">）设备或软件信息，例如您的移动设备、网页浏览器或用于接入我们服务的其他程序所提供的配置信息、您的</span><span style=\"font-size:27px\">IP</span><span style=\"font-size:27px;font-family:宋体\">地址和移动设备所用的版本和设备识别码；</span></p><p><span style=\"font-size:27px;font-family:宋体\">（</span><span style=\"font-size:27px\">2</span><span style=\"font-size:27px;font-family:宋体\">）在使用我们服务时搜索或浏览的信息，例如您使用的网页搜索词语、访问的社交媒体页面</span><span style=\"font-size:27px\">url</span><span style=\"font-size:27px;font-family:宋体\">地址，以及您在使用我们服务时浏览或要求提供的其他信息和内容详情；</span></p><p><span style=\"font-size:27px;font-family:宋体\">（</span><span style=\"font-size:27px\">3</span><span style=\"font-size:27px;font-family:宋体\">）有关您曾使用的移动应用（</span><span style=\"font-size:27px\">APP</span><span style=\"font-size:27px;font-family:宋体\">）和其他软件的信息，以及您曾经使用该等移动应用和软件的信息；</span></p><p><span style=\"font-size:27px;font-family:宋体\">（</span><span style=\"font-size:27px\">4</span><span style=\"font-size:27px;font-family:宋体\">）您通过我们的服务进行通讯的信息，例如曾通讯的账号，以及通讯时间、数据和时长；</span></p><p><span style=\"font-size:27px;font-family:宋体\">（</span><span style=\"font-size:27px\">5</span><span style=\"font-size:27px;font-family:宋体\">）您通过我们的服务分享的内容所包含的信息（元数据），例如拍摄或上传的共享照片或录像的日期、时间或地点等。</span></p><p><span style=\"font-size:27px;font-family:宋体\">位置信息，指您开启设备定位功能并使用我们基于位置提供的相关服务时，收集的有关您位置的信息，包括：</span></p><p><span style=\"font-size:27px;font-family:宋体\">（</span><span style=\"font-size:27px\">1</span><span style=\"font-size:27px;font-family:宋体\">）您通过具有定位功能的移动设备使用我们的服务时，通过</span><span style=\"font-size:27px\">GPS</span><span style=\"font-size:27px;font-family:宋体\">或</span><span style=\"font-size:27px\">WiFi</span><span style=\"font-size:27px;font-family:宋体\">等方式收集的您的地理位置信息；</span></p><p><span style=\"font-size:27px;font-family:宋体\">（</span><span style=\"font-size:27px\">2</span><span style=\"font-size:27px;font-family:宋体\">）您或其他用户提供的包含您所处地理位置的实时信息，例如您提供的账户信息中包含的您所在地区信息，您或其他人上传的显示您当前或曾经所处地理位置的共享信息，您或其他人共享的照片包含的地理标记信息；</span></p><p><span style=\"font-size:27px;font-family:宋体\">（</span><span style=\"font-size:27px\">3</span><span style=\"font-size:27px;font-family:宋体\">）您可以通过关闭定位功能，停止对您的地理位置信息的收集。</span></p><p><span style=\"font-size:27px;font-family:宋体\">三、我们可能如何使用信息</span></p><p><span style=\"font-size:27px;font-family:宋体\">我们可能将在向您提供服务的过程之中所收集的信息用作下列用途：</span></p><p><span style=\"font-size:27px\">1</span><span style=\"font-size:27px;font-family:宋体\">、向您提供服务；</span></p><p><span style=\"font-size:27px\">2</span><span style=\"font-size:27px;font-family:宋体\">、在我们提供服务时，用于身份验证、客户服务、安全防范、诈骗监测、存档和备份用途，提高我们向您提供的产品和服务的安全性；</span></p><p><span style=\"font-size:27px\">3</span><span style=\"font-size:27px;font-family:宋体\">、帮助我们设计新服务，改善我们现有服务；</span></p><p><span style=\"font-size:27px\">4</span><span style=\"font-size:27px;font-family:宋体\">、使我们更加了解您如何接入和使用我们的服务，从而针对性地回应您的个性化需求，例如语言设定、位置设定、个性化的帮助服务和指示，或对您和其他用户作出其他方面的回应；</span></p><p><span style=\"font-size:27px\">5</span><span style=\"font-size:27px;font-family:宋体\">、评估我们服务中的广告和其他促销及推广活动的效果，并加以改善；</span></p><p><span style=\"font-size:27px\">6</span><span style=\"font-size:27px;font-family:宋体\">、软件认证或管理软件升级；</span></p><p><span style=\"font-size:27px\">7</span><span style=\"font-size:27px;font-family:宋体\">、让您参与有关我们产品和服务的调查。</span></p><p><span style=\"font-size:27px;font-family:宋体\">为了让您有更好的体验、改善我们的服务或您同意的其他用途，在符合相关法律法规的前提下，我们可能将通过某一项服务所收集的信息，以汇集信息或者个性化的方式，用于我们的其他服务。例如，在您使用我们的一项服务时所收集的信息，可能在另一服务中用于向您提供特定内容，或向您展示与您相关的、非普遍推送的信息。如果我们在相关服务中提供了相应选项，您也可以授权我们将该服务所提供和储存的信息用于我们的其他服务。</span></p><p><span style=\"font-size:27px;font-family:宋体\">四、您如何访问和控制自己的个人信息</span></p><p><span style=\"font-size:27px;font-family:宋体\">我们将尽一切可能采取适当的技术手段，保证您可以访问、更新和更正自己的注册信息或使用我们的服务时提供的其他个人信息。在访问、更新、更正和删除前述信息时，我们可能会要求您进行身份验证，以保障账户安全。</span></p><p><span style=\"font-size:27px;font-family:宋体\">五、我们可能分享的信息</span></p><p><span style=\"font-size:27px;font-family:宋体\">除以下情形外，未经您同意，我们以及我们的关联公司不会与任何第三方分享您的个人信息：</span></p><p><span style=\"font-size:27px\">1</span><span style=\"font-size:27px;font-family:宋体\">、我们以及我们的关联公司，可能将您的个人信息与我们的关联公司、合作伙伴及第三方服务供应商、承包商及代理（例如代表我们发出电子邮件或推送通知的通讯服务提供商、为我们提供位置数据的地图服务供应商）分享（他们可能并非位于您所在的法域），用作下列用途：</span></p><p><span style=\"font-size:27px;font-family:宋体\">（</span><span style=\"font-size:27px\">1</span><span style=\"font-size:27px;font-family:宋体\">）向您提供我们的服务；</span></p><p><span style=\"font-size:27px;font-family:宋体\">（</span><span style=\"font-size:27px\">2</span><span style=\"font-size:27px;font-family:宋体\">）实现“我们可能如何使用信息”部分所述目的；</span></p><p><span style=\"font-size:27px;font-family:宋体\">（</span><span style=\"font-size:27px\">3</span><span style=\"font-size:27px;font-family:宋体\">）履行我们在《网约课服务协议》或《网约课隐私政策》中的义务和行使我们的权利；</span></p><p><span style=\"font-size:27px;font-family:宋体\">（</span><span style=\"font-size:27px\">4</span><span style=\"font-size:27px;font-family:宋体\">）理解、维护和改善我们的服务。</span></p><p><span style=\"font-size:27px\">2</span><span style=\"font-size:27px;font-family:宋体\">、如我们或我们的关联公司与任何上述第三方分享您的个人信息，我们将努力确保该等第三方在使用您的个人信息时，遵守《网约课隐私政策》及我们要求其遵守的其他适当的保密和安全措施。</span></p><p><span style=\"font-size:27px\">3</span><span style=\"font-size:27px;font-family:宋体\">、随着我们业务的持续发展，我们以及我们的关联公司有可能进行合并、收购、资产转让或类似的交易，您的个人信息有可能作为此类交易的一部分而被转移。我们将在转移前通知您。</span></p><p><span style=\"font-size:27px\">4</span><span style=\"font-size:27px;font-family:宋体\">、我们或我们的关联公司还可能为以下需要而保留、保存或披露您的个人信息：</span></p><p><span style=\"font-size:27px;font-family:宋体\">（</span><span style=\"font-size:27px\">1</span><span style=\"font-size:27px;font-family:宋体\">）遵守适用的法律法规；</span></p><p><span style=\"font-size:27px;font-family:宋体\">（</span><span style=\"font-size:27px\">2</span><span style=\"font-size:27px;font-family:宋体\">）遵守法院命令或其他法律程序的规定；</span></p><p><span style=\"font-size:27px;font-family:宋体\">（</span><span style=\"font-size:27px\">3</span><span style=\"font-size:27px;font-family:宋体\">）遵守相关政府机关的要求；</span></p><p><span style=\"font-size:27px;font-family:宋体\">（</span><span style=\"font-size:27px\">4</span><span style=\"font-size:27px;font-family:宋体\">）为遵守适用的法律法规，维护社会公共利益，保护我们的客户、我们</span><span style=\"font-size:27px\">/</span><span style=\"font-size:27px;font-family:宋体\">我们的集团公司、雇员及其他用户的人身和财产安全或合法权益所合理必需的用途。</span></p><p><span style=\"font-size:27px;font-family:宋体\">六、信息安全</span></p><p><span style=\"font-size:27px;font-family:宋体\">我们仅在《网约课隐私政策》所述目的、所必需的期间和法律法规要求的时限内保留您的个人信息。</span></p><p><span style=\"font-size:27px;font-family:宋体\">我们使用各种安全技术和程序，以防信息的丢失、不当使用、未经授权阅览或披露。例如，在某些服务中，我们将利用加密技术（例如</span><span style=\"font-size:27px\">SSL</span><span style=\"font-size:27px;font-family:宋体\">）来保护您提供的个人信息。但请您理解，由于技术的限制以及可能存在的各种恶意手段，在互联网行业，即便竭尽所能加强安全措施，也不可能始终保证信息百分之百的安全。您需要了解，您接入我们的服务所用的系统和通讯网络，有可能因我们可控范围外的因素而出现问题。</span></p><p><span style=\"font-size:27px;font-family:宋体\">七、您分享的信息</span></p><p><span style=\"font-size:27px;font-family:宋体\">我们的多项服务，可让您与使用该服务的所有用户公开分享您的相关信息，例如，您在我们的网站上传的信息（包括您公开的个人信息）、您对其他人上传或发布的信息作出的回应、以及与这些信息有关的位置数据和日志信息。使用我们服务的其他用户也有可能分享与您有关的信息（包括位置数据和日志信息）。只要您不删除发布的信息，有关信息会一直留存在公共领域；即使您删除发布信息，有关信息仍可能由其他用户或不受我们控制的非关联第三方独立地缓存、复制或储存，或由其他用户或该等第三方在公共领域保存。</span></p><p><span style=\"font-size:27px;font-family:宋体\">八、我们可能如何收集信息</span></p><p><span style=\"font-size:27px;font-family:宋体\">我们或我们的第三方合作伙伴，可能通过</span><span style=\"font-size:27px\">cookies</span><span style=\"font-size:27px;font-family:宋体\">和</span><span style=\"font-size:27px\">webbeacon</span><span style=\"font-size:27px;font-family:宋体\">收集和使用您的信息，并将该等信息储存为日志信息。</span></p><p><span style=\"font-size:27px;font-family:宋体\">我们使用自己的</span><span style=\"font-size:27px\">cookies</span><span style=\"font-size:27px;font-family:宋体\">和</span><span style=\"font-size:27px\">webbeacon</span><span style=\"font-size:27px;font-family:宋体\">，目的是为您提供更个性化的用户体验和服务，并用于以下用途：</span></p><p><span style=\"font-size:27px\">1</span><span style=\"font-size:27px;font-family:宋体\">、记住您的身份。例如：</span><span style=\"font-size:27px\">cookies</span><span style=\"font-size:27px;font-family:宋体\">和</span><span style=\"font-size:27px\">webbeacon</span><span style=\"font-size:27px;font-family:宋体\">有助于我们辨认您作为我们的注册用户的身份，或保存您向我们提供的有关您的喜好或其他信息；</span></p><p><span style=\"font-size:27px\">2</span><span style=\"font-size:27px;font-family:宋体\">、分析您使用我们服务的情况。例如，我们可利用</span><span style=\"font-size:27px\">cookies</span><span style=\"font-size:27px;font-family:宋体\">和</span><span style=\"font-size:27px\">webbeacon</span><span style=\"font-size:27px;font-family:宋体\">来了解您使用我们的服务进行什么活动，或哪些页面或服务最受您的欢迎；</span></p><p><span style=\"font-size:27px\">3</span><span style=\"font-size:27px;font-family:宋体\">、广告优化。</span><span style=\"font-size:27px\">Cookies</span><span style=\"font-size:27px;font-family:宋体\">和</span><span style=\"font-size:27px\">webbeacon</span><span style=\"font-size:27px;font-family:宋体\">有助于我们根据您的信息，向您提供与您相关的广告而非进行普遍的广告投放。</span></p><p><span style=\"font-size:27px;font-family:宋体\">我们为上述目的使用</span><span style=\"font-size:27px\">cookies</span><span style=\"font-size:27px;font-family:宋体\">和</span><span style=\"font-size:27px\">webbeacon</span><span style=\"font-size:27px;font-family:宋体\">的同时，可能将通过</span><span style=\"font-size:27px\">cookies</span><span style=\"font-size:27px;font-family:宋体\">和</span><span style=\"font-size:27px\">webbeacon</span><span style=\"font-size:27px;font-family:宋体\">收集的非个人身份信息，经统计加工后提供给广告商或其他合作伙伴，用于分析用户如何使用我们的服务，并用于广告服务。</span></p><p><span style=\"font-size:27px;font-family:宋体\">我们的产品和服务上可能会有广告商或其他合作方放置的</span><span style=\"font-size:27px\">cookies</span><span style=\"font-size:27px;font-family:宋体\">和</span><span style=\"font-size:27px\">webbeacon</span><span style=\"font-size:27px;font-family:宋体\">。这些</span><span style=\"font-size:27px\">cookies</span><span style=\"font-size:27px;font-family:宋体\">和</span><span style=\"font-size:27px\">webbeacon</span><span style=\"font-size:27px;font-family:宋体\">可能会收集与您相关的非个人身份信息，以用于分析用户如何使用该等服务、向您发送您可能感兴趣的广告，或用于评估广告服务的效果。这些第三方</span><span style=\"font-size:27px\">cookies</span><span style=\"font-size:27px;font-family:宋体\">和</span><span style=\"font-size:27px\">webbeacon</span><span style=\"font-size:27px;font-family:宋体\">收集和使用该等信息，不受《网约课隐私政策》约束，而是受相关使用者的隐私政策约束，我们不对第三方的</span><span style=\"font-size:27px\">cookies</span><span style=\"font-size:27px;font-family:宋体\">或</span><span style=\"font-size:27px\">webbeacon</span><span style=\"font-size:27px;font-family:宋体\">承担责任。</span></p><p><span style=\"font-size:27px;font-family:宋体\">您可以通过浏览器设置拒绝或管理</span><span style=\"font-size:27px\">cookies</span><span style=\"font-size:27px;font-family:宋体\">或</span><span style=\"font-size:27px\">webbeacon</span><span style=\"font-size:27px;font-family:宋体\">。但请注意，如果停用</span><span style=\"font-size:27px\">cookies</span><span style=\"font-size:27px;font-family:宋体\">或</span><span style=\"font-size:27px\">webbeacon</span><span style=\"font-size:27px;font-family:宋体\">，您有可能无法享受最佳的服务体验，某些服务也可能无法正常使用。同时，您还会收到同样数量的广告，但这些广告与您的相关性会降低。</span></p><p><span style=\"font-size:27px;font-family:宋体\">九、广告服务</span></p><p><span style=\"font-size:27px;font-family:宋体\">我们可能使用您的相关信息，向您提供与您更加相关的广告。</span></p><p><span style=\"font-size:27px;font-family:宋体\">我们也可能使用您的信息，通过我们的服务、电子邮件或其他方式向您发送课程营销信息，提供或推广我们或第三方的如下课程和服务：</span></p><p><span style=\"font-size:27px;font-family:宋体\">我们的课程或服务，我们的关联公司和合作伙伴的课程或服务，网上媒体服务、互动娱乐服务、社交网络服务、付款服务、互联网搜索服务、位置和地图服务、应用软件和服务、数据管理软件和服务、网上广告服务、互联网金融，以及其他社交媒体、娱乐、电子商务、资讯和通讯软件或服务（统称“互联网服务”）；</span></p><p><span style=\"font-size:27px;font-family:宋体\">如您不希望我们将您的个人信息用作前述广告用途，您可以通过我们在广告中提供的相关提示，或在特定服务中提供的指引，要求我们停止为上述用途使用您的个人信息。</span></p><p><span style=\"font-size:27px;font-family:宋体\">十、我们可能向您发送的邮件和信息</span></p><p><span style=\"font-size:27px;font-family:宋体\">邮件和信息推送</span></p><p><span style=\"font-size:27px;font-family:宋体\">您在使用我们的服务时，我们可能使用您的信息向您的设备发送电子邮件、课程或推送通知。如您不希望收到这些信息，可以按照我们的相关提示，在设备上选择取消订阅。</span></p><p><span style=\"font-size:27px;font-family:宋体\">与服务有关的公告</span></p><p><span style=\"font-size:27px;font-family:宋体\">我们可能在必要时（例如因系统维护而暂停某一项服务时）向您发出与服务有关的公告。您可能无法取消这些与服务有关、性质不属于推广的公告。</span></p><p><span style=\"font-size:27px;font-family:宋体\">十一、隐私政策的适用例外</span></p><p><span style=\"font-size:27px;font-family:宋体\">我们的服务可能包括或链接至第三方提供的社交媒体或其他服务（包括网站）。例如：您利用“分享”键将某些内容分享到我们的服务，或您利用第三方连线服务登录我们的服务。这些功能可能会收集您的相关信息（包括您的日志信息），并可能在您的电脑装置</span><span style=\"font-size:27px\">cookies</span><span style=\"font-size:27px;font-family:宋体\">，从而正常运行上述功能；</span></p><p><span style=\"font-size:27px;font-family:宋体\">我们通过广告或我们服务的其他方式向您提供链接，使您可以接入第三方的服务或网站。</span></p><p><span style=\"font-size:27px;font-family:宋体\">该等第三方社交媒体或其他服务可能由相关的第三方或我们运营。您使用该类第三方的社交媒体服务或其他服务（包括您向该类第三方提供的任何个人信息），须受该第三方的服务条款及隐私政策（而非《通用服务条款》或本《网约课隐私政策》）约束，您需要仔细阅读其条款。《网约课隐私政策》仅适用于我们所收集的信息，并不适用于任何第三方提供的服务或第三方的信息使用规则，我们对任何第三方使用由您提供的信息不承担任何责任。</span></p><p><span style=\"font-size:27px;font-family:宋体\">十二、隐私政策的适用范围</span></p><p><span style=\"font-size:27px;font-family:宋体\">除某些特定服务外，我们所有的服务均适用本《网约课隐私政策》。这些特定服务将适用特定的隐私政策。针对某些特定服务的特定隐私政策，将更具体地说明我们在该等服务中如何使用您的信息。该特定服务的隐私政策构成本《网约课隐私政策》的一部分。如相关特定服务的隐私政策与本《网约课隐私政策》有不一致之处，适用该特定服务的隐私政策。</span></p><p><span style=\"font-size:27px;font-family:宋体\">请您注意，本《网约课隐私政策》不适用于以下情况：</span></p><p><span style=\"font-size:27px;font-family:宋体\">通过我们的服务而接入的第三方服务（包括任何第三方网站）收集的信息；</span></p><p><span style=\"font-size:27px;font-family:宋体\">通过在我们服务中进行广告服务的其他公司或机构所收集的信息。</span></p><p><span style=\"font-size:27px;font-family:宋体\">十三、变更</span></p><p><span style=\"font-size:27px;font-family:宋体\">我们可能适时修订本《网约课隐私政策》的条款，该等修订构成本《网约课隐私政策》的一部分。如该等修订造成您在本《网约课隐私政策》下权利的实质减少，我们将在修订生效前通过在主页上显著位置提示或向您发送电子邮件或以其他方式通知您。<strong>在该种情况下，若您继续使用我们的服务，即表示同意受经修订的《网约课隐私政策》的约束。</strong></span></p><p><span style=\"font-size:27px\">&nbsp;</span></p><p><br/></p>', '0');
INSERT INTO `xieyi` VALUES (15, '用户注册协议', '<p><span style=\"font-family:宋体;color:windowtext\">欢迎您使用网约课并与网约课经营者签署本服务协议！</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">本协议为《网约课APP》修订版本，</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">各服务条款前所列索引关键词仅为帮助您理解该条款表达的主旨之用，不影响或限制本协议条款的含义或解释。为维护您自身权益，建议您仔细阅读各条款具体表述。</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">0.1</span><span style=\"font-family:宋体;color:windowtext\">【审慎阅读】登录流程中，点击同意本协议之前，您应当认真阅读（未成年人应当在监护人陪同下阅读）本协议。请您务必审慎阅读、充分理解各条款内容（如有歧义请及时联系网约课客服），特别是免除或者限制责任的条款、法律适用和争议解决条款。免除或者限制责任的条款将以粗体下划线标识，您应重点阅读。如您对协议有任何疑问，可向网约课平台客服咨询。</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">0.2</span><span style=\"font-family:宋体;color:windowtext\">【签约动作】<strong>当您按照登录、注册页面提示填写信息、阅读并同意本协议且完成全部注册程序后，即表示已充分阅读、理解并接受本协议的全部内容，并与网约课达成一致，</strong>成为网约课平台“用户”。阅读本协议的过程中，如果您不同意本协议或其中任何条款约定，您应立即停止注册、登录、网约课平台程序。</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">0.3</span><span style=\"font-family:宋体;color:windowtext\">【协议变更】在您签署本协议之后，此文本可能因国家政策、产品以及履行本协议的环境发生变化而进行相应性修改，修改后的协议将发布在网约课平台上，并以本协议第九条约定的方式通知您。若您对修改后的协议有异议的，请立即停止登录、使用网约课平台产品及服务，若<strong>您继续使用或登录网约课平台，以及使用网约课平台提供的相关服务，则视为对修改后的协议予以认可并且无歧义条款（</strong>如有歧义请联系客服）。</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">0.4</span><span style=\"font-family:宋体;color:windowtext\">【补充协议】由于互联网高速发展，您与网约课签署的本协议所能列明的条款并不能完整罗列并覆盖您与网约课平台的所有权利与义务，现有的约定也不能保证完全符合未来发展的需求。因此，网约课平台法律声明及隐私权政策、网约课平台规则均为本协议的补充协议，与本协议不可分割且具有同等法律效力。<strong>如您使用网约课平台服务，视为您同意上述补充协议。</strong>各补充协议的变更效力参照0.3款的约定。</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">一、 定义</span></p><p style=\"background:white;vertical-align:middle\">网约课<span style=\"font-family:&#39;Arial&#39;,&#39;sans-serif&#39;\">/</span>公司<span style=\"font-family:&#39;Arial&#39;,&#39;sans-serif&#39;\">/</span>平台：指天津天成众投科技有限公司所有和经营的数字内容聚合，包括网约课网（域名为<span style=\"font-family:&#39;Arial&#39;,&#39;sans-serif&#39;\">www.</span>wyuek.com）。管理和分发的平台产品，旨在为用户提供教学内容的生成、传播和消费服务。</p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">网约课经营者： 天津天成众投科技有限公司。</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">网约课平台规则： 包括所有在网约课平台上已经发布及后续发布的全部规则、解读、实施细则、产品流程说明、公告等内容。</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">用户： 下称“您”或“用户”，是指注册、登录、使用网约课平台的个人、自然人、</span><span style=\"font-family:宋体;color:windowtext\">法人、其他组织。</span><span style=\"font-family:宋体;color:windowtext\">包括但不限于网约课平台入驻机构、网约课平台讲师、嘉宾、学员。</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"text-decoration:underline;\"><span style=\"font-family:宋体;color:windowtext\">入驻机构： 指注册或使用网约课平台提供的相关服务，在中国境内依法成立的法人组织或中国法律承认的其他机构。</span></span></p><p><span style=\"text-decoration:underline;\"><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></span></p><p><span style=\"text-decoration:underline;\"><span style=\"font-family:宋体;color:windowtext\">讲师： 指注册使用网约课直播间等服务，具有完全民事行为能力，从属于入驻机构或独立的个人讲师。</span></span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">学员： 注册、登录、使用网约课平台，参加入驻机构、讲师提供的课程等一系列活动的自然人。</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">二、 协议范围</span></p><p><span style=\"font-family:宋体;color:windowtext\">2.1 </span><span style=\"font-family:宋体;color:windowtext\">签约主体</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">【签约主体】本协议由您与网约课平台经营者共同订立，本协议对您与网约课平台经营者均具有约束力。</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"text-decoration:underline;\"><span style=\"font-family:宋体;color:windowtext\">【经营者信息】网约课平台经营者是指经营网约课平台对应的法律主体，您可随时查看网约课网站首页底部公示的证照信息以确定与您履约的网约课平台经营者的信息。</span></span></p><p><span style=\"text-decoration:underline;\"><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></span></p><p><span style=\"text-decoration:underline;\"><span style=\"font-family:宋体;color:windowtext\">【经营者变更】本协议项下，网约课平台经营者可能根据网约课平台的业务调整而发生变更，变更后的网约课平台经营者与您共同履行本协议并向您提供服务，网约课平台经营者的变更不会影响您本协议项下的权益。</span></span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">三、 账号注册与使用</span></p><p><span style=\"font-family:宋体;color:windowtext\">3.1 </span><span style=\"font-family:宋体;color:windowtext\">用户资格</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">【用户资格】请您确认，在您开始注册程序使用网约课平台服务前，您应当具备中华人民共和国法律规定的与您相适应的民事行为能力。若您不具备前述与您相适应的民事行为能力，则您及您的监护人应依照法律规定承担因此而导致的一切后果。</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">此外，您还需确保您符合中国法律的各项规定，不是任何国家、国际组织或者地域法律、规则限制的自然人，否则您可能无法正常注册及使用网约课平台服务。</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">3.2 </span><span style=\"font-family:宋体;color:windowtext\">用户账号说明</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">【用户账号获得】 当您使用您的第三方平台账号，登录网约课平台，即在网约课平台创建等同于您与第三方平台账号的网约课账号。在您的网约课账号绑定您的手机号后，您的手机号也具有您的网约课账号的同等效力。</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"text-decoration:underline;\"><span style=\"font-family:宋体;color:windowtext\">【直播间ID获得】 当入驻机构、讲师、获得用户账号后，可申请创建直播间。在申请创建直播间页面提交真实名称或姓名、地址和有效联系方式及相应证件， 通过网约课平台审核，将分配获得直播间<em><span style=\"text-decoration:line-through;\">ID</span></em>。</span></span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">【用户账号使用】 您有权使用您设置或确认的网约课用户账号登录网约课平台，<em><span style=\"text-decoration:line-through;\">以及通过直播间ID登录网约课直播间。</span></em></span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">网约课平台只允许每位用户使用一个网约课平台账号。</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">由于您的网约平台课账号关联您的个人信息及网约课平台的商业信息，您的网约课平台账号仅限于您本人使用。<strong>未经网约课平台同意，您直接或间接授权第三方使用您网约课平台账号的行为无效。</strong>如经网约课平台判断，您的网约课平台账号的使用可能危及您的平台账号安全或网约课平台信息安全的，网约课平台可拒绝提供相应服务或终止本协议。</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">【用户账号转让】 您在网约课平台的账号不得以任何方式转让，否则网约课平台有权追究您的违约责任，且由此产生的一切责任均由您承担。</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">【实名认证】 为使您更好地使用网约课平台的各项服务，保障您的账号安全，网约课平台要求您按我国法律规定完成实名认证。</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">3.3 </span><span style=\"font-family:宋体;color:windowtext\">用户信息管理</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">3.3.1 </span><span style=\"font-family:宋体;color:windowtext\">真实合法</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">【信息真实】 入驻机构、讲师及嘉宾在使用网约课平台服务时，应当按网约课平台页面的提示准确完整地提供您的信息（包括您的姓名、联系地址、有效联系电话及证件信息等），以便网约课平台与您联系。您了解并同意，您有义务保证您提供信息的真实性及有效性。</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">【名称合法】 您在网约课平台设置的以下名称，包括但不限于用户名称、直播间名称、专栏名称及课程名称等，不得违反国家法律法规、法律规范、社会公序良俗以及网约课平台关于此类名称的管理规定，否则网约课平台可限制、禁止您使用网约课平台的相关服务，或按照本协议的违约处理措施进行处理。</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">3.3.2 </span><span style=\"font-family:宋体;color:windowtext\">更新维护</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">【信息更新】 您应当及时更新您提供的信息，在法律有明确规定要求网约课平台作为网络服务提供者必须对用户的信息进行核实的情况下，网约课平台将依法不时地对您的信息进行检查核实，您应当配合提供最新、真实、完整、有效的信息。</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">【信息维护】 存在以下任一条件时，网约课平台可向您发出询问或要求整改的通知，并要求您进行重新认证，直至中止、终止对您提供部分或全部网约课平台服务，网约课平台对此不承担任何责任，您将承担对您自身、对他人及对网约课平台造成的全部损失与不利后果。</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">（一）网约课平台按您最后一次提供的信息与您联系未果；</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">（二）您未按照网约课平台的要求及时提供信息；</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">（三）您提供的信息存在明显不实；</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">（四）司法行政机关核实您提供的信息无效。</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">3.4 </span><span style=\"font-family:宋体;color:windowtext\">账号安全规范</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">【账号安全保管义务】 您通过第三方平台账号或手机号登录网约课平台，网约课平台任何时候均不会主动要求您提供您的第三方平台账号的密码或手机短信验证码。因此，建议您务必保管好您的第三方平台账号和手机，并确保您在每个上网时段结束时退出登录并以正确步骤离开网约课平台。</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">【账号损失】 因您主动泄露账号或因您遭受他人攻击、诈骗等行为导致的损失及后果，网约课平台对此不承担责任，您应通过司法、行政等救济途径向侵权行为人追偿。</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">【账号行为责任自负】 除网约课平台存在过错外，您应对您账号项下的所有行为结果（包括但不限于在线发布信息、购买课程或其他服务及披露信息等）负责。</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"text-decoration:underline;\"><span style=\"font-family:宋体;color:windowtext\">【日常维护须知】 如发现任何未经授权使用您账号登录网约课平台或其他可能导致您账号遭窃、遗失的情况，建议您立即通知网约课</span></span><span style=\"font-family:宋体;color:windowtext\">平台<span style=\"text-decoration:underline;\">。您理解网约课</span>平台<span style=\"text-decoration:underline;\">对您的任何请求采取行动均需要合理时间，且网约课</span>平台<span style=\"text-decoration:underline;\">应您的请求而采取的行动可能无法避免或阻止侵害后果的形成或扩大，除网约课</span>平台<span style=\"text-decoration:underline;\">存在法定过错外，网约课</span>平台<span style=\"text-decoration:underline;\">不承担责任。</span></span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">四、 网约课平台服务及规范</span></p><p><span style=\"font-family:宋体;color:windowtext\">【服务概况】 您可以在网约课平台上享受创建直播间、课程、购买、评价、转播课程、推广、提交平台协助解决争议等服务(其中部分为收费服务)。网约课平台将根据经营的实际需求，不时修改或开发新的平台服务内容，用户能享受的服务范围，以网约课平台提供的实际功能为准。</span></p><p><span style=\"font-family:宋体;color:windowtext\">4.1 </span><span style=\"font-family:宋体;color:windowtext\">直播间管理</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">【直播间创建】 您可以在网约课平台创建属于您个人的直播间，并设定直播间是否收费及收费价格，开设多门类公开或付费课程，发布和申请推广课程信息，吸引学员参与或购买课程。</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">【直播间限制】 基于网约课平台管理需要，您理解并认可，同一用户在网约课平台仅能开设一个直播间，网约课平台可关闭您在网约课平台同时开设的其他直播间。</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">【直播间转让】 由于直播间与网约课平台账号的不可分性，直播间转让实质为网约课平台账号的转让，因此网约课平台不允许您转让直播间。</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"text-decoration:underline;\"><span style=\"font-family:宋体;color:windowtext\">【课程删除】 您不可以任何方式删除您直播间内所有课程内容。(尤其是以收费的课程)<em><span style=\"text-decoration:line-through;\">但您应当对您删除课程所造成的违约、侵权等法律后果承担相应责任，包括但不限于对此前已收取的相关费用的退还及赔偿承担相应责任。</span></em></span></span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">【课程管理】 直播间创建者对讲师在直播间内开设的课程承担管理责任，讲师在课程中对嘉宾及学员承担相应责任及相应义务。</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">4.2 </span><span style=\"font-family:宋体;color:windowtext\">直播间、课程的发布与推广</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">【发布与推广】 用户创建直播间，课程后，可以通过网约课平台提供的邀请卡等服务，发布课程信息，吸引学员参与或购买课程。 用户还可以与网约课平台签订推广协议，在网约课平台的推荐页面，以图形或文字的形式向客户推广相应课程。</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">4.3 </span><span style=\"font-family:宋体;color:windowtext\">依法纳税</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">【依法纳税】 依法纳税是每一位公民、企业应尽的义务。对于从网约课平台获得的应纳税所得，您应及时依法向税务主管机关申报纳税。根据国家法律法规政策，如税务机关要求网约课平台作为代缴代扣义务人的，网约课平台可在用户对课程收益提现前，扣除应纳税款，代为缴纳。</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">4.4 </span><span style=\"font-family:宋体;color:windowtext\">课程购买</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">【课程购买】 您可以通过您注册时填写的第三方账号、手机号或者其他联系方式订阅您感兴趣的课程信息。当您在网约课平台购买课程时，请您务必仔细确认所购课程的时间、价格及内容等重要事项，并在下单时仔细核实课程和价格信息。<strong>您购买课程的交易发生在您与网约课平台之间，网约课平台无正当理由不能进行退款。</strong>若您与入驻机构或个人讲师达成退款意向，请联系网约课客服进行协商。</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">【用户谨慎义务】 网约课仅向您提供网约课平台服务，您了解网约课平台上的信息系用户自行发布，且可能存在风险和瑕疵。鉴于网约课平台具备存在海量信息及信息远程和即时发布的特点，网约课平台无法逐一审查课程内容的质量、效果、准确性和真实性，对此您在参与或购买课程时应谨慎判断。</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"text-decoration:underline;\"><span style=\"font-family:宋体;color:windowtext\">4.5 </span></span><span style=\"text-decoration:underline;\"><span style=\"font-family:宋体;color:windowtext\">服务收费</span></span></p><p><span style=\"text-decoration:underline;\"><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></span></p><p><span style=\"text-decoration:underline;\"><span style=\"font-family:宋体;color:windowtext\">【服务收费】 <a>除网约课平台明示的收费业务外</a></span></span><a id=\"_anchor_1\" href=\"file:///C:/Users/Administrator/Documents/WeChat%20Files/wlxiangxinni/Files/%E7%94%A8%E6%88%B7%E6%B3%A8%E5%86%8C%E5%8D%8F%E8%AE%AE-%E5%AE%A1%E6%A0%B8%E7%89%88.docx#_msocom_1\" language=\"JavaScript\" name=\"_msoanchor_1\">[1]</a>&nbsp;<span style=\"text-decoration:underline;\"><span style=\"font-family:宋体;color:windowtext\">，网约课</span></span><span style=\"font-family:宋体;color:windowtext\">平台<span style=\"text-decoration:underline;\">向您提供的服务目前是免费的。如未来网约课需要向您收取合理费用，网约课</span>平台<span style=\"text-decoration:underline;\">会采取合理途径、以足够合理的期限提前通过法定程序，并以本协议第九条约定的方式通知您，确保您有充分选择的权利。</span></span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">4.6 </span><span style=\"font-family:宋体;color:windowtext\">禁止行为</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">【禁止行为】 您不得在网约课平台上从事以下行为：</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">（一）利用网约课平台发表、传送、传播、储存危害国家安全、国家统一、社会稳定的内容；</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">（二）利用网约课平台发表侮辱、诽谤、色情、暴力、引起他人不安及任何违反国家法律法规政策的内容；</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">（三）利用网约课平台发表、传送、传播、储存侵害他人知识产权、商业秘密、肖像权、隐私权等合法权利的内容；</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">（四）利用网约课平台发表欺诈、虚假、不准确、存在误导性的信息，或冒充、利用他人名义进行活动；</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">（五）利用网约课平台从事任何违法犯罪活动；</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">（六）发布破坏、篡改、删除、影响网约课平台任一系统正常运行或未经授权秘密获取网约课平台及其他用户数据、个人资料的病毒、木马、爬虫等恶意软件、程序代码；</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">（七）发布其他违背社会公共利益、公共道德或依据本协议或网约课平台规则不适合在网约课平台上发布的信息；</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">（八）在网约课平台上贬低、诋毁竞争对手，干扰网约课平台上进行的任何交易、活动，或以任何方式干扰或试图干扰网约课平台的正常运作；</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">（九）对课程实施恶意购买、恶意维权等扰乱网约课平台正常交易秩序的行为。</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">（十）其它违反中华人民共和国相关法律法规及国家政策的行为。</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">4.7 </span><span style=\"font-family:宋体;color:windowtext\">交易争议处理</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">【交易争议处理】 您在网约课平台交易过程中与其他用户发生争议的，您或其他用户中的任何一方均有权选择以下途径解决：</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">（一）与争议相对方自主协商；</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">（二）向网约课平台客服申请协助解决争议；</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">（三）请求消费者协会或者其他依法成立的调解组织进行调解；</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">（四）向有关行政部门进行投诉；</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">（五）根据与争议相对方达成的仲裁协议（如有）提请仲裁机构进行仲裁；</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">（六）向人民法院提起诉讼。</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">4.8 </span><span style=\"font-family:宋体;color:windowtext\">免责条款</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">【不可抗力及第三方原因】 网约课依照法律规定履行基础保障义务，但对于下述原因导致的合同履行障碍、履行瑕疵、履行延后或履行内容变更等情形，网约课不承担相应的违约责任：</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">（一）因自然灾害、罢工、暴乱、战争、政府行为、司法行政命令等不可抗力因素；</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">（二）因电力供应故障、通讯网络故障等公共服务因素或网络流量拥堵、黑客攻击等第三方因素；</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">（三）在网约课平台已尽善意管理的情况下，因常规或紧急的设备与系统维护、设备与系统故障、网络信息与数据安全等因素。</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">五、 用户信息的保护及例外</span></p><p><span style=\"font-family:宋体;color:windowtext\">5.1 </span><span style=\"font-family:宋体;color:windowtext\">用户信息保护</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">【信息保护注意事项】 网约课平台非常重视用户个人信息的保护，在您使用网约课平台提供的服务时，您同意网约课按照在网约课平台上公布的隐私权政策收集、存储、保护、使用和披露您的个人信息。网约课希望通过隐私权政策向您清楚地介绍网约课平台对您个人信息的处理方式，因此网约课建议您完整地阅读隐私权政策（点击 此处 或点击网约课网站首页底部链接），以帮助您更好地保护您的隐私权。除此以外，您需要特别注意以下几点：</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">（一）请您勿在使用网约课平台服务过程中透露您的各类财产帐户、银行卡、信用卡、第三方支付账号及对应密码等重要资料，否则由此带来的任何损失由您自行承担；</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">（二）您的注册信息是网约课平台的重要保护内容，网约课平台将采取必要的技术保护措施。但由于互联网的开放性以及技术的迅猛发展，可能因第三方因素导致您的信息泄漏，网约课平台对此不承担责任；</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">（三）网约课平台的服务具有公开性，若您将个人隐私信息上传、发表至网约课平台，或通过网约课平台传播给其他人，由此引起隐私的泄漏，网约课对此不承担责任；</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">（四）由于您将账号信息告知他人或与他人共享账号，由此导致的任何个人隐私的泄漏，网约课对此不承担责任；</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">（五）若您是未成年人，您在网约课平台上发表或上传信息前，应咨询您的监护人并取得监护人的同意。</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">5.2 </span><span style=\"font-family:宋体;color:windowtext\">第三方合作信息互通</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">【第三方合作信息互通】 为提升网约课平台的质量，网约课平台可能会与第三方合作共同向您提供相关的网约课平台服务，此类合作可能需要包括但不限于网约课平台用户数据与第三方用户数据的互通。在此情况下<strong>，您知晓并同意如该第三方同意承担与网约课平台同等的保护用户隐私的责任，则网约课平台有权将您的注册资料等提供给该第三方，并与第三方约定您的数据仅为双方合作的网约课平台之目的使用</strong>；并且，网约课平台将对该等第三方使用您的数据的行为进行监督和管理，尽一切合理努力保护您的个人信息的安全性。</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">5.3 </span><span style=\"font-family:宋体;color:windowtext\">用户信息保护的例外</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">【信息保护例外】 保护用户隐私和其他个人信息是网约课的一项基本政策，网约课平台保证不会将您的注册资料及您在使用网约课平台时存储在网约课平台的非公开内容用于任何用途，但下列情况除外：</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">（一）您自行在网络上公开的信息或其他已合法公开的个人信息；</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">（二）以合法渠道获取的个人信息；</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">（三）事先获得您的明确授权；</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">（四）为维护社会公共利益；</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">（五）网约课或学校、科研机构等基于公共利益为学术研究或统计的目的，且公开方式不足以识别特定自然人；</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">（六）您侵害网约课合法权益，为维护前述合法权益且在必要范围内；</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">（七）根据相关政府主管部门或根据相关法律法规和政策的要求；</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">（八）其他必要情况。</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">六、知识产权及相关权利</span></p><p><span style=\"font-family:宋体;color:windowtext\">6.1 </span><span style=\"font-family:宋体;color:windowtext\">用户权利通知</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">【用户权利通知】 网约课平台尊重他人的知识产权和合法权益，呼吁用户也要同样尊重他人的知识产权和他人的合法权益。若您认为您的知识产权或其他合法权益被侵犯，请按照以下规范向网约课平台提供资料。</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">【权利通知格式规范】 为了网约课平台有效处理您发出的权利通知，请您使用以下格式（包括各条款的序号）：</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">（一）权利人对涉嫌侵权内容拥有知识产权或其他合法权益，依法可以行使知识产权或其他合法权益的权属证明；</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">（二）请充分、明确地描述被侵犯了知识产权或其他合法权益的情况并请提供涉嫌侵权的课程名称或第三方网址（如有）；</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">（三）请指明涉嫌侵权课程或其他信息的哪些内容侵犯了第（二）项中列明的权利；</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">（四）请提供权利人具体的联络信息，包括姓名、身份证或护照复印件（对自然人）、机构登记证明复印件（对机构）、通信地址、电话号码、传真和电子邮件；</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">（五）请提供涉嫌侵权内容在信息网络上的位置（如指明您举报的含有侵权内容的出处，即：具体某个课程或具体的网页地址）以便网约课平台与您举报的含有侵权内容的课程所有权人/管理人联系；</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">（六）请您在权利通知中加入如下关于通知内容真实性的声明：“我本人保证，本通知中所述信息是充分、真实、准确的，如果本权利通知内容不完全属实，本人将承担由此产生的一切法律责任”；</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">（七）请您签署该权利通知，如果您是依法成立的机构或组织，请您加盖公章。</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">【通知地址】 请您把以上资料和联络方式书面发往以下地址：</span></p><p><a><span style=\"font-family:宋体;color:red\">&nbsp;</span></a></p><p><span style=\"font-family:宋体;color:red\">公司名称：沈阳天成浩联科技有限公司</span></p><p><span style=\"font-family:宋体;color:red\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:red\">公司地址：沈阳市和平区十三纬路19号冶金大厦后身，天成传媒</span></p><p><span style=\"font-family:宋体;color:red\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:red\">联系人：韩先生</span></p><p><span style=\"font-family:宋体;color:red\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:red\">联系方式：024-66909301</span></p><p><span style=\"font-family:宋体;color:red\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:red\">邮政编码：</span><span style=\"font-size:13px;font-family:&#39;Arial&#39;,&#39;sans-serif&#39;;color:black;background:#F9F9F9\">110055</span></p><p><a id=\"_anchor_2\" href=\"file:///C:/Users/Administrator/Documents/WeChat%20Files/wlxiangxinni/Files/%E7%94%A8%E6%88%B7%E6%B3%A8%E5%86%8C%E5%8D%8F%E8%AE%AE-%E5%AE%A1%E6%A0%B8%E7%89%88.docx#_msocom_2\" language=\"JavaScript\" name=\"_msoanchor_2\">[2]</a>&nbsp;</p><p><span style=\"font-family:宋体;color:windowtext\">【权利通知失实】 如果您的权利通知的陈述失实，权利通知提交者将承担由此造成的全部法律责任（包括但不限于赔偿各种费用及律师费）。如果您不确定网络上可获取的资料是否侵犯了其知识产权和其他合法权益，网约课平台建议您首先咨询相关专业人士。</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">6.2 </span><span style=\"font-family:宋体;color:windowtext\">用户授权</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">【用户授权】 <strong>对于用户通过网约课平台上传至可公开（免费或付费）获取区域的任何内容，用户同意网约课平台在全世界范围内具有免费的、永久性的、不可撤销的、非独家的和完全再许可的权利和许可，以使用、复制、修改、改编、出版、翻译、据以创作衍生作品、传播、表演和展示此等内容（整体或部分），或将此等内容编入当前已知的或以后开发的其他任何形式的作品、媒体或技术中。</strong></span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">6.3 </span><span style=\"font-family:宋体;color:windowtext\">权利声明</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">【权利声明】 网约课平台所有的产品、技术与所有程序均属于网约课平台的知识产权，“网约课”， “wyuek”及相关图形等为网约课平台的注册商标。未经网约课许可，任何人不得擅自（包括但不限于：以非<a name=\"_GoBack\"></a>法的方式复制、传播、展示、镜像、上载、下载）使用，否则网约课平台将依法追究法律责任。</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">七、第三方产品和服务</span></p><p><span style=\"font-family:宋体;color:windowtext\">7.1 </span><span style=\"font-family:宋体;color:windowtext\">第三方产品和服务</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">【第三方产品和服务】 本服务可能包含第三方提供的产品或服务。当您使用第三方提供的产品或服务时，可能会另有相关的协议或规则，您同样应当认真阅读并遵守。如您在使用第三方产品或服务时发生任何纠纷的，请您与第三方直接联系，网约课不承担任何责任，但根据需要会依法提供必要的协助。</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">7.2 </span><span style=\"font-family:宋体;color:windowtext\">第三方支付服务</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">【第三方支付服务】 用户在网约课平台上通过购买课程方式支付的资金，视为对特定商品的消费支出（购买课程）。用户在网约课平台上进行的包括但不限于上述各种支付活动均直接通过微信支付和财付通等第三方支付服务实现（现在没有），用户应遵守第三方支付服务协议。因第三方支付服务收取的手续费和导致的资金损失由用户自行承担或根据第三方支付服务的协议处理，网约课平台不承担相应责任。</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">7.3 </span><span style=\"font-family:宋体;color:windowtext\">代收服务</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">【代收服务】 除网约课平台直接收取的推广费用、入驻费用外，用户在网约课平台上通过打赏、购买课程、发红包等方式支付的资金，用户均同意由网约课平台代收后，支付给用户的相应支付活动所指向的特定对象。用户支付的资金均存入第三方支付平台或网约课平台的账号。用户使用网约课平台代收服务期间，网约课平台无须对为您保管、代收或代付款项的货币贬值、汇率损失和利息损失及其他风险担责，并且网约课平台无须向您支付此等款项的任何孳息。</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">7.4 </span><span style=\"font-family:宋体;color:windowtext\">提现服务</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p style=\"text-align:left\"><span style=\"font-family: 宋体;color:windowtext\">【提现服务】 根据不同的支付方式，接受资金的用户可在网约课平台上申请提现。根据相关法律法规及第三方支付平台的限制，每位用户每周只能提现一次，单笔提现可能存在一定的提现限额和账期要求。网约课平台无法提供资金即时到账服务，您认可资金于途中流转需要合理时间。提现指令一旦发出即立即生效、不可撤销，网约课平台有权根据您发出的提现指令进行支付操作。您应妥善保管您的手机等电子设备以及第三方平台账号及密码、支付密码、短信校验码等信息和资料，因您泄露、遗失、复制、转交前述信息和资料而导致的损失，由您自行承担。</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">八、 用户的违约及处理</span></p><p><span style=\"font-family:宋体;color:windowtext\">8.1 </span><span style=\"font-family:宋体;color:windowtext\">违约认定</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">【违约情形】 发生如下情形之一的，视为您违约：</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">（一）使用网约课平台服务时违反有关法律法规规定；</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">（二）违反本协议、本协议补充协议约定或网约课平台规则。</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">【违约认定】 网约课可在网约课平台规则中约定违约认定的程序和标准，例如可依据您的用户数据和课程信息与网约课平台大数据的关系来认定您是否构成违约；您有义务对您的数据或信息的异常现象进行充分举证和合理解释，否则将被认定为违约。</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">8.2 </span><span style=\"font-family:宋体;color:windowtext\">违约处理措施</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">【信息处理】 您在网约课平台上发布的信息构成违约的，网约课平台可根据相应规则立即对相应信息进行删除、屏蔽处理或对您的课程进行下架、监管。</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">【行为限制】 您在网约课平台上实施的行为，或虽未在网约课平台上实施但对网约课平台及其用户产生影响的行为构成违约的，网约课平台可依据相应规则对您执行限制参加推广活动、中止向您提供部分或全部服务、划扣违约金等处理措施。如您的行为构成根本违约的，网约课平台可查封您的账号，终止向您提供服务。</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">【信息移交】 为遵守国家法律、法规，维护社会安全，对于在网约课平台实施违法犯罪活动的用户，网约课将平台可能您的冻结账号，并向公安机关移交与违法犯罪活动有关的线索及用户信息。</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">【账号严重风险】 当您违约的同时存在欺诈、售假、盗用他人账号等特定情形或您存在危及他人交易安全或账号安全风险时，或严重影响网约课平台正常运转的，网约课平台会依照您行为的风险程度对您的账号采取取消收款、关停课程、终止服务等强制措施。</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">8.3 </span><span style=\"font-family:宋体;color:windowtext\">赔偿责任（是否存在协议终止）</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">【赔偿范围】 如您的行为使网约课平台遭受损失（包括自身的直接经济损失、商誉损失及对外支付的赔偿金、和解款、律师费、诉讼费等间接经济损失），您应赔偿网约课平台的上述全部损失。</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">【损失追偿】 如您的行为使网约课平台遭受第三方主张权利，网约课平台可在对第三方承担金钱支付等义务后就全部损失向您追偿。</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">【资金划扣】 <strong>如因您的行为构成严重违法、犯罪或违反相关政策的强制性规定，使得第三人遭受损失的，网约课出于社会公共利益保护或消费者权益保护目的，可从您由网约课代收的资金中划扣相应款项进行支付。如您由网约课代收的资金不足以支付上述赔偿款项的，网约课可直接扣减您在网约课其它协议项下的权益。</strong></span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">8.4 </span><span style=\"font-family:宋体;color:windowtext\">特别约定（是否存在）</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">【关联处理】 如您因严重违约导致网约课终止本协议的，出于维护平台秩序及保护用户权益的目的，网约课可对网约课平台与您在其他协议项下的合作采取中止甚或终止协议的措施，并以本协议第九条约定的方式通知您。</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">九、 通知</span></p><p><span style=\"font-family:宋体;color:windowtext\">9.1 </span><span style=\"font-family:宋体;color:windowtext\">用户有效的联系方式</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">【联系方式真实有效】 您在注册成为网约课平台用户，并接受网约课平台服务时，您应保证使用真实有效的第三方平台账号。如果您绑定您的手机号，您应保证使用本人的手机号。如果您创建直播间，开设收费课程的，网约课将要求您提供真实的联系方式，对于联系方式发生变更的，您有义务及时更新有关信息，并保持可被联系的状态。</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">您提供的微信号、手机号或其他联系方式，作为您在网约课平台的有效联系方式。网约课将向您的上述其中之一或若干联系方式向您送达各类通知，而此类通知的内容可能对您的权利义务产生重大的有利或不利影响，请您务必及时关注。</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">9.2 </span><span style=\"font-family:宋体;color:windowtext\">网约课联系方式</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">您对于网约课的通知应当通过网约课平台对外正式公布的通信地址、传真号码、电子邮件地址等联系信息进行送达。</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">9.3 </span><span style=\"font-family:宋体;color:windowtext\">通知的送达</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">【通知送达的方式】 网约课通过站内通知向您发出通知，其中以电子方式发出的书面通知，包括但不限于在网约课平台公告。</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">十、 协议的终止（是否存在协议终止）</span></p><p><span style=\"font-family:宋体;color:windowtext\">10.1 </span><span style=\"font-family:宋体;color:windowtext\">终止的情形</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">【用户发起的终止】 您有权通过以下任一方式终止本协议：</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">（一）变更事项生效前，您停止使用并书面明示不愿接受变更事项的；</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">（二）您明示不愿继续使用网约课平台服务，且符合网约课平台终止条件的。</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">【网约课发起的终止】 出现以下情况时，网约课可以本协议第九条约定的方式通知您终止本协议：</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">（一）您违反本协议约定，网约课依据违约条款终止本协议的；</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">（二）您盗用他人账号、发布违禁信息、骗取他人财物、侵犯他人知识产权、扰乱市场秩序、采取不正当手段谋利等行为，网约课依据本协议和网约课平台规则对您的账号予以查封的；</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">（三）除上述情形外，因您多次违反网约课平台规则相关规定且情节严重，网约课依据本协议及网约课平台规则对您的账号予以查封的；</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">（四）根据法律、法规、政策规定，出于维护公共利益的目的，其它应当终止服务的情况。</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">10.2 </span><span style=\"font-family:宋体;color:windowtext\">协议终止后的处理（是否存在协议终止）</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">【用户信息披露】 本协议终止后，除法律有明确规定外，网约课无义务向您或您指定的第三方披露您账号中的任何信息。</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">【网约课权利】 本协议终止后，网约课仍享有下列权利：</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">（一）继续保存您留存于网约课平台的本协议的各类信息；</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">（二）对于您过往的违约行为，网约课仍可依据本协议向您追究违约责任和相应的法律责任。</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">【交易处理】 本协议终止后，对于您在本协议存续期间产生的未结清的支付的款项和收取的款项（指存入第三方支付平台或网约课账号，未提现的款项），网约课可通知交易相对方并根据交易相对方的意愿决定是否取消该笔支付。</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">入驻机构或讲师自行终止协议或因上述条款被终止协议，仍有未完成的收费服务的，应积极与付费用户协商解决；拒绝协商或协商未果的，网约课将依据《中华人民共和国消费者权益保护法》等法律法规的规定，为用户向入驻机构或讲师追究违约责任提供必要信息或协助。</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">十一、 法律适用、管辖与其他</span></p><p><span style=\"font-family:宋体;color:windowtext\">11.1 </span><span style=\"font-family:宋体;color:windowtext\">法律适用</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">【法律适用】 本协议之订立、生效、解释、修订、补充、终止、执行与争议解决均适用中华人民共和国大陆地区法律；如法律无相关规定的，参照商业惯例及/或行业惯例。</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">11.2 </span><span style=\"font-family:宋体;color:windowtext\">管辖</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">【管辖】 您因使用网约课<em><span style=\"text-decoration:line-through;\">平台</span></em>服务所产生及与网约课平台服务有关的争议，由网约课与您协商解决。协商不成时，任何一方均可向网约课经营者注册地的人民法院提起诉讼。</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">11.3 </span><span style=\"font-family:宋体;color:windowtext\">协议可分性</span></p><p><span style=\"font-family:宋体;color:windowtext\">&nbsp;</span></p><p><span style=\"font-family:宋体;color:windowtext\">【协议可分性】 本协议任一条款被视为废止、无效或不可执行，该条应视为可分的且并不影响本协议其余条款的有效性及可执行性。</span></p><hr size=\"1\" width=\"33%\"/><p><br/></p><p><br/></p>', '1');
INSERT INTO `xieyi` VALUES (16, '约课币使用须知', '<h1 label=\"标题居中\" style=\"font-size: 32px; font-weight: bold; border-bottom: 2px solid rgb(204, 204, 204); padding: 0px 4px 0px 0px; text-align: center; margin: 0px 0px 20px;\"><strong><span style=\"font-family: 宋体; font-size: 36px;\">约课币使用须知</span></strong></h1><p><span style=\"font-size:24px;font-family:宋体\">您应当在购买约课币之前认真阅读全部须知内容，但无论您事实上是否在购买约课币之前认真阅读了本须知内容，<strong>只要您使用约课币相关服务，则需遵守本须知的规定。</strong></span></p><p><span style=\"font-size:24px;font-family:宋体\">您承诺接受并遵守本须知的内容。如果您不同意本须知的规定，您应立即停止购买及使用约课币的行为。</span></p><p><span style=\"font-size:24px;font-family:宋体\">约课网可根据需要不定时制订、修改本须知及</span><span style=\"font-size:24px\">/</span><span style=\"font-size:24px;font-family:宋体\">或与“约课币”相关的规则，以网站公示的方式进行通知您。变更后的须知和规则在约课网网站公布之日起七个自然日后，即自动生效。如您不同意相关变更，应当立即停止约课币服务的使用。<strong>您继续进行任何与约课币相关的活动，包括但不限于继续使用约课币购买发布位置、维持约课币所购买的展位等服务的使用、购买刷新服务、购买共享资源的下载链接查看权、兑换查看或发布资格、充值约课币，即表示您接受经修订的须知。</strong></span></p><p><span style=\"font-size:24px;font-family:宋体\">一、定义</span></p><p><span style=\"font-size:24px\">1.</span><span style=\"font-size:24px;font-family:宋体\">约课币</span></p><p><span style=\"font-size:24px;font-family:宋体\">约课币用于在约课网中兑换发布展位、刷新次数、购买</span><span style=\"font-size:24px\">VIP/SVIP</span><span style=\"font-size:24px;font-family:宋体\">会员、兑换相应页面的查看或发布资格等增值服务。</span></p><p><span style=\"font-size:24px\">2.</span><span style=\"font-size:24px;font-family:宋体\">会员</span></p><p><span style=\"font-size:24px;font-family:宋体\">会员，指已注册约课网并通过约课网身份认证或企业认证的约课网用户。</span></p><p><span style=\"font-size:24px;font-family:宋体\">二、获取方式</span></p><p><span style=\"font-size:24px\">1.</span><span style=\"font-size:24px;font-family:宋体\">充值：约课网会员可通过约课网充值获得约课币。</span></p><p><span style=\"font-size:24px\">2.</span><span style=\"font-size:24px;font-family:宋体\">约课网赠送：约课网不定期通过活动等行为向会员赠送约课币。</span></p><p><span style=\"font-size:24px\">3.</span><span style=\"font-size:24px;font-family:宋体\">赚取：约课网会员可以通过资源共享栏目，以约课币出售资源的方式赚取约课币。</span></p><p><span style=\"font-size:24px;font-family:宋体\">三、约课币使用规则</span></p><p><span style=\"font-size:24px\">1.</span><span style=\"font-size:24px;font-family:宋体\">约课币仅限于约课网及约课网的手机客户端及其他约课平台中使用，不得用以支付、购买实物产品或兑换其它企业的任何产品和服务。</span></p><p><span style=\"font-size:24px\">2.</span><span style=\"font-size:24px;font-family:宋体\">约课币的充值渠道仅限于约课网充值，不得对约课币进行私下交易，如发现私下交易情况，约课网保留对其追究法律责任的权利。</span></p><p><span style=\"font-size:24px\">3.</span><span style=\"font-size:24px;font-family:宋体\">约课币不可用于兑换现金。</span></p><p><span style=\"font-size:24px\">4.</span><span style=\"font-size:24px;font-family:宋体\">为避免使用约课币从事违法行为，约课币一经充值不予退还。</span></p><p><span style=\"font-size:24px;font-family:宋体\">四、按现状提供服务</span></p><p><span style=\"font-size:24px;font-family:宋体\">您理解并同意，约课网的服务是按照现有技术和条件所能达到的现状提供的。约课网会尽最大努力向您提供服务，确保服务的连贯性和安全性。但约课网不能随时预见和防范法律法规、技术以及其他风险（包括但不限于不可抗力、病毒、木马、黑客攻击、系统不稳定、第三方服务瑕疵、政府行为等原因）可能导致的服务中断、数据丢失以及其他的损失和风险。</span></p><p><span style=\"font-size:24px;font-family:宋体\">五、不可抗力及其他免责事由</span></p><p><span style=\"font-size:24px\">1.</span><span style=\"font-size:24px;font-family:宋体\">您理解并同意，在使用本服务的过程中，可能会遇到不可抗力等风险因素，使本服务发生中断。不可抗力是指不能预见、不能克服并不能避免且对一方或双方造成重大影响的客观事件，包括但不限于自然灾害（如洪水、地震、和风暴等）、瘟疫流行以及社会事件（如战争、动乱等）、政府行为等。出现上述情况时，约课网将努力在第一时间与相关单位配合，及时进行修复，但是由此给您造成的损失，约课网在法律允许的范围内免责。</span></p><p><span style=\"font-size:24px\">2.</span><span style=\"font-size:24px;font-family:宋体\">在法律允许的范围内，约课网对以下情形导致的服务中断或受阻不承担责任：</span></p><p><span style=\"font-size:24px;font-family:宋体\">（</span><span style=\"font-size:24px\">1</span><span style=\"font-size:24px;font-family:宋体\">）受到计算机病毒、木马或其他恶意程序、黑客攻击的破坏；</span></p><p><span style=\"font-size:24px;font-family:宋体\">（</span><span style=\"font-size:24px\">2</span><span style=\"font-size:24px;font-family:宋体\">）用户或约课网的电脑软件、系统、硬件和通信线路出现故障；</span></p><p><span style=\"font-size:24px;font-family:宋体\">（</span><span style=\"font-size:24px\">3</span><span style=\"font-size:24px;font-family:宋体\">）用户操作不当；</span></p><p><span style=\"font-size:24px;font-family:宋体\">（</span><span style=\"font-size:24px\">4</span><span style=\"font-size:24px;font-family:宋体\">）用户通过非约课网授权的方式使用本服务；</span></p><p><span style=\"font-size:24px;font-family:宋体\">（</span><span style=\"font-size:24px\">5</span><span style=\"font-size:24px;font-family:宋体\">）其他约课网无法控制或合理预见的情形。</span></p><p><span style=\"font-size:24px\">3.</span><span style=\"font-size:24px;font-family:宋体\">约课网可能根据实际需要对收费服务的收费标准、方式进行修改和变更，约课网也可能会对部分免费服务开始收费。前述修改、变更或开始收费前，约课网将在相应服务页面进行通知或公告。如果您不同意上述修改、变更或付费内容，则应停止使用约课币及其相关服务。</span></p><p><span style=\"font-size:24px;font-family:宋体\">六、服务的变更、中断、终止</span></p><p><span style=\"font-size:24px\">1.</span><span style=\"font-size:24px;font-family:宋体\">约课网可能会对服务内容进行变更，也可能会中断、中止或终止服务。</span></p><p><span style=\"font-size:24px\">2.</span><span style=\"font-size:24px;font-family:宋体\">您理解并同意，约课网有权自主决定经营策略。在约课网发生合并、分立、收购、资产转让时，约课网可向第三方转让本服务下相关资产；约课网也可在单方通知您后，将本须知下部分或全部服务转交由第三方运营或履行。具体受让主体以约课网通知为准。</span></p><p><span style=\"font-size:24px\">3.</span><span style=\"font-size:24px;font-family:宋体\">如发生下列任何一种情形，约课网有权不经通知而中断或终止向您提供的服务：</span></p><p><span style=\"font-size:24px;font-family:宋体\">（</span><span style=\"font-size:24px\">1</span><span style=\"font-size:24px;font-family:宋体\">）根据法律规定您应提交真实信息，而您提供的个人资料不真实、或与注册时信息不一致又未能提供合理证明；</span></p><p><span style=\"font-size:24px;font-family:宋体\">（</span><span style=\"font-size:24px\">2</span><span style=\"font-size:24px;font-family:宋体\">）您违反相关法律法规或本须知的约定；</span></p><p><span style=\"font-size:24px;font-family:宋体\">（</span><span style=\"font-size:24px\">3</span><span style=\"font-size:24px;font-family:宋体\">）按照法律规定或主管部门的要求；</span></p><p><span style=\"font-size:24px;font-family:宋体\">（</span><span style=\"font-size:24px\">4</span><span style=\"font-size:24px;font-family:宋体\">）出于安全的原因或其他必要的情形。</span></p><p><br/></p>', '0');
INSERT INTO `xieyi` VALUES (17, '网约课平台课程制作使用协议', '<h1 label=\"标题居中\" style=\"font-size: 32px; font-weight: bold; border-bottom: 2px solid rgb(204, 204, 204); padding: 0px 4px 0px 0px; text-align: center; margin: 0px 0px 20px;\"><strong><span style=\"font-family:&#39;Arial&#39;,&#39;sans-serif&#39;;color:#444444\">&nbsp;</span></strong><span style=\"font-size: 36px;\"><strong><span style=\"color: rgb(68, 68, 68);\">网约</span></strong><strong><span style=\"color: rgb(68, 68, 68);\">课平台</span></strong><strong><span style=\"color: rgb(68, 68, 68);\">课程制作使用协议</span></strong>&nbsp;</span></h1><p style=\"background:white;vertical-align:middle\"><span style=\";color:#444444\">重要提示</span></p><p style=\"background:white;vertical-align:middle\"><span style=\";color:#444444\">欢迎使用</span><span style=\";color:#444444\">网约</span><span style=\";color:#444444\">课</span><span style=\";color:#444444\">课程制作</span><span style=\";color:#444444\">平台</span><span style=\";color:#444444\">服务</span><span style=\";color:#444444\">协议</span><span style=\";color:#444444\">，请您仔细阅读以下全部内容<strong><span style=\"text-decoration:underline;\">（特别是粗体标注的内容）</span></strong>。</span></p><p style=\"background:white;vertical-align:middle\"><span style=\"font-family:&#39;Arial&#39;,&#39;sans-serif&#39;;color:#444444\">&nbsp;</span></p><p style=\"background:white;vertical-align:middle\"><span style=\";color:#444444\">一、服务条款的确认和接纳</span></p><p style=\"background:white;vertical-align:middle\"><span style=\";color:#444444\">本协议是您与</span><span style=\";color:#444444\">网约</span><span style=\";color:#444444\">课</span><span style=\";color:#444444\">平台</span><span style=\";color:#444444\">之间关于使用</span><span style=\";color:#444444\">网约</span><span style=\";color:#444444\">课</span><span style=\";color:#444444\">课程制作</span><span style=\";color:#444444\">平台</span><span style=\";color:#444444\">服务</span><span style=\";color:#444444\">协议</span><span style=\";color:#444444\">的条款，内容包括本协议正文、</span><span style=\";color:#444444\">网约</span><span style=\";color:#444444\">课</span><span style=\";color:#444444\">或</span><span style=\";color:#444444\">网约</span><span style=\";color:#444444\">课</span><span style=\";color:#444444\">平台</span><span style=\";color:#444444\">已经发布的或将来可能发布的各类协议和规则。所有协议为本协议不可分割的组成部分，与本协议正文具有同等法律效力。除另行明确声明外，您使用</span><span style=\";color:#444444\">网约</span><span style=\";color:#444444\">课</span><span style=\";color:#444444\">平台</span><span style=\";color:#444444\">课程制作服务的行为将受本条款约束。</span></p><p style=\"background:white;vertical-align:middle\"><strong><span style=\";color:#444444\">如您（未成年人应在监护人陪同下）选择使用并点击</span></strong><strong><span style=\"font-family:&#39;Arial&#39;,&#39;sans-serif&#39;;color:#444444\">“</span></strong><strong><span style=\";color:#444444\">同意</span></strong><strong><span style=\"font-family:&#39;Arial&#39;,&#39;sans-serif&#39;;color:#444444\">”</span></strong><strong><span style=\";color:#444444\">的，即表示已经与</span></strong><strong><span style=\";color:#444444\">网约</span></strong><strong><span style=\";color:#444444\">课</span></strong><strong><span style=\";color:#444444\">课程制作平台达成协议，并自愿接受本协议的所有内容。</span></strong><span style=\";color:#444444\">本协议是《</span><span style=\";color:#444444\">用户注册协议</span><span style=\";color:#444444\">》不可分割的组成部分，本协议未明确约定的，均依照《</span><span style=\";color:#444444\">网约</span><span style=\";color:#444444\">课</span><span style=\";color:#444444\">帐号服务条款》执行。</span></p><p style=\"background:white;vertical-align:middle\"><span style=\";color:#444444\">网约</span><span style=\";color:#444444\">课</span><span style=\";color:#444444\">课程制作平台的所有权、经营管理权归</span><span style=\";color:#444444\">网约</span><span style=\";color:#444444\">课</span><span style=\";color:#444444\">公司所有。</span><span style=\";color:#444444\">网约</span><span style=\";color:#444444\">课</span><span style=\";color:#444444\">公司有权根据法律规范及运营的合理需要，不断修改和完善本协议，并在</span><span style=\";color:#444444\">网约</span><span style=\";color:#444444\">课</span><span style=\";color:#444444\">平台（</span><span style=\"font-family:&#39;Arial&#39;,&#39;sans-serif&#39;;color:#444444\">www.wyuek.com</span><span style=\";color:#444444\">）公告。如您继续使用本服务，即意味着同意并自愿遵守修改后的服务协议，亦或您有权终止使用该服务。</span></p><p style=\"background:white;vertical-align:middle\"><strong><span style=\"font-family:&#39;Arial&#39;,&#39;sans-serif&#39;;color:#444444\">&nbsp;</span></strong></p><p style=\"background:white;vertical-align:middle\"><span style=\";color:#444444\">二、定义</span></p><p style=\"background:white;vertical-align:middle\"><span style=\"font-family:&#39;Arial&#39;,&#39;sans-serif&#39;;color:#444444\">1.1 </span><span style=\";color:#444444\">您：指有效申请并经</span><span style=\";color:#444444\">网约</span><span style=\";color:#444444\">课</span><span style=\";color:#444444\">、</span><span style=\";color:#444444\">网约</span><span style=\";color:#444444\">课</span><span style=\";color:#444444\">平台</span><span style=\";color:#444444\">审核同意后，在</span><span style=\";color:#444444\">网约</span><span style=\";color:#444444\">课</span><span style=\";color:#444444\">课程制作平台制作及发布作品的自然人、法人、其他组织。</span></p><p style=\"background:white;vertical-align:middle\"><span style=\"font-family:&#39;Arial&#39;,&#39;sans-serif&#39;;color:#444444\">1.2 </span><span style=\";color:#444444\">网约</span><span style=\";color:#444444\">课</span><span style=\"font-family:&#39;Arial&#39;,&#39;sans-serif&#39;;color:#444444\">/</span><span style=\";color:#444444\">公司</span><span style=\"font-family:&#39;Arial&#39;,&#39;sans-serif&#39;;color:#444444\">/</span><span style=\";color:#444444\">平台</span><span style=\";color:#444444\">：指</span><span style=\";color:#444444\">天津天成众投科技有限公司</span><span style=\";color:#444444\">所有和经营的数字内容聚合、管理和分发的平台产品，旨在为用户提供教学内容的生成、传播和消费服务。</span></p><p style=\"background:white;vertical-align:middle\"><span style=\"font-family:&#39;Arial&#39;,&#39;sans-serif&#39;;color:#444444\">1.3</span><span style=\";color:#444444\">网约</span><span style=\";color:#444444\">课</span><span style=\";color:#444444\">课程制作平台：作为</span><span style=\";color:#444444\">网约</span><span style=\";color:#444444\">课</span><span style=\";color:#444444\">平台的组成部分，以平台支持模式与您进行合作，供著作权人或其合法授权人发布、查询所发布课程作品的聚合平台。</span></p><p style=\"background:white;vertical-align:middle\"><span style=\"font-family:&#39;Arial&#39;,&#39;sans-serif&#39;;color:#444444\">1.4 </span><span style=\";color:#444444\">课程作品：指您在</span><span style=\";color:#444444\">网约</span><span style=\";color:#444444\">课</span><span style=\";color:#444444\">课程制作平台所发布的视频、文字、图片、链接等内容以及与前述内容相关的摄影作品、姓名、肖像、标识等，包括但不限于课程介绍、课程发布方名称、</span><span style=\"font-family:&#39;Arial&#39;,&#39;sans-serif&#39;;color:#444444\">Logo</span><span style=\";color:#444444\">、讲师介绍及肖像等。本定义下的课程作品包括免费课程与收费课程。</span></p><p style=\"background:white;vertical-align:middle\"><span style=\"font-family:&#39;Arial&#39;,&#39;sans-serif&#39;;color:#444444\">1.5 </span><span style=\";color:#444444\">免费课程：指您在收费课程制作平台所发布的，无偿提供给</span><span style=\";color:#444444\">网约</span><span style=\";color:#444444\">课</span><span style=\";color:#444444\">用户的视频、文字、图片等内容。</span></p><p style=\"background:white;vertical-align:middle\"><span style=\"font-family:&#39;Arial&#39;,&#39;sans-serif&#39;;color:#444444\">1.6 </span><span style=\";color:#444444\">收费课程：指您在收费课程制作平台所发布的，有偿提供给</span><span style=\";color:#444444\">网约</span><span style=\";color:#444444\">课</span><span style=\";color:#444444\">用户的视频、文字、图片等内容。</span></p><p style=\"background:white;vertical-align:middle\"><span style=\"font-family:&#39;Arial&#39;,&#39;sans-serif&#39;;color:#444444\">1.7 </span><span style=\";color:#444444\">平台服务费：</span><span style=\";color:#444444\">网约</span><span style=\";color:#444444\">课</span><span style=\";color:#444444\">采用平台支持模式与您进行合作，</span><span style=\";color:#444444\">网约</span><span style=\";color:#444444\">课</span><span style=\";color:#444444\">为您提供课程发布、查询及相关技术服务，如您提供的课程作品为收费课程，则</span><span style=\";color:#444444\">网约</span><span style=\";color:#444444\">课</span><span style=\";color:#444444\">通过提供上述技术服务向您收取平台服务费。如您提供的课程作品为免费课程，则就免费课程涉及的服务</span><span style=\";color:#444444\">网约</span><span style=\";color:#444444\">课</span><span style=\";color:#444444\">将免于收取平台服务费。</span></p><p style=\"background:white;vertical-align:middle\"><span style=\";color:#444444\">二、您的权利和义务</span></p><p style=\"background:white;vertical-align:middle\"><span style=\"font-family:&#39;Arial&#39;,&#39;sans-serif&#39;;color:#444444\">2.1</span><span style=\";color:#444444\">您同意：按照</span><span style=\";color:#444444\">网约</span><span style=\";color:#444444\">课</span><span style=\";color:#444444\">课程制作平台公布和提示的规则、流程进行注册操作。注册完成后，请您妥善保存有关帐号和密码，并对该帐号进行的所有活动和行为负责。如因您自身过错（包括但不限于转让帐号、与他人共用、自己泄露等）或您所用计算机或其他终端产品感染病毒或木马，而导致帐号密码泄漏、遗失或其他损失后果将由您独自承担。</span></p><p style=\"background:white;vertical-align:middle\"><span style=\"font-family:&#39;Arial&#39;,&#39;sans-serif&#39;;color:#444444\">2.2 </span><strong><span style=\";color:#444444\">您保证：对在</span></strong><strong><span style=\";color:#444444\">网约</span></strong><strong><span style=\";color:#444444\">课课程制作平台发布的作品享有合法权益，是该作品的权利人或已获得权利人的合法授权，可以对该作品行使相关权利；若因您发布的作品发生权利纠纷或侵犯了任何第三方的合法权益，责任由您本人承担，因此给</span></strong><strong><span style=\";color:#444444\">网约</span></strong><strong><span style=\";color:#444444\">课或其关联公司等第三方造成损失的，您应负责全额赔偿。</span></strong></p><p style=\"background:white;vertical-align:middle\"><span style=\"font-family:&#39;Arial&#39;,&#39;sans-serif&#39;;color:#444444\">2.3 </span><span style=\";color:#444444\">您保证：提供给</span><span style=\";color:#444444\">网约</span><span style=\";color:#444444\">课</span><span style=\";color:#444444\">平台</span><span style=\";color:#444444\">的所有信息、数据，包括但不限于其姓名（名称）、地址、链接、电子邮箱等相关资料真实、合法、准确。如</span><span style=\";color:#444444\">网约</span><span style=\";color:#444444\">课</span><span style=\";color:#444444\">公司发现不真实、不合法或不准确的，则有权暂停或终止向您提供本协议下服务</span><span style=\"font-family:&#39;Arial&#39;,&#39;sans-serif&#39;;color:#444444\">,</span><span style=\";color:#444444\">由此产生的一切法律责任由您自行承担。</span></p><p style=\"background:white;vertical-align:middle\"><span style=\"font-family:&#39;Arial&#39;,&#39;sans-serif&#39;;color:#444444\">2.4 </span><span style=\";color:#444444\">您完全理解并同意，</span><span style=\";color:#444444\">网约</span><span style=\";color:#444444\">课</span><span style=\";color:#444444\">平台</span><span style=\";color:#444444\">和</span><span style=\";color:#444444\">网约</span><span style=\";color:#444444\">课</span><span style=\";color:#444444\">课程制作平台无须就您上传、发布或发表的任何作品支付费用，您和</span><span style=\";color:#444444\">网约</span><span style=\";color:#444444\">课</span><span style=\";color:#444444\">平台</span><span style=\";color:#444444\">另行签订协议的除外。</span></p><p style=\"background:white;vertical-align:middle\"><span style=\"font-family:&#39;Arial&#39;,&#39;sans-serif&#39;;color:#444444\">2.5 </span><span style=\";color:#444444\">您应保管好自己的账户和密码（包括但不限于您的</span><span style=\";color:#444444\">网约</span><span style=\";color:#444444\">课</span><span style=\";color:#444444\">平台</span><span style=\";color:#444444\">账户、</span><span style=\";color:#444444\">网约</span><span style=\";color:#444444\">课</span><span style=\";color:#444444\">平台</span><span style=\";color:#444444\">账户），如因您未保管好自己的账户和密码而对自己、</span><span style=\";color:#444444\">网约</span><span style=\";color:#444444\">课</span><span style=\";color:#444444\">平台</span><span style=\";color:#444444\">、课程制作平台或第三方造成损害的，您将负全部责任。另外，您应对您账户中的所有活动和事件负全责。您可随时改变账户的密码。</span></p><p style=\"background:white;vertical-align:middle\"><span style=\"font-family:&#39;Arial&#39;,&#39;sans-serif&#39;;color:#444444\">&nbsp;</span></p><p style=\"background:white;vertical-align:middle\"><span style=\";color:#444444\">三、</span><span style=\";color:#444444\">网约</span><span style=\";color:#444444\">课</span><span style=\";color:#444444\">平台</span><span style=\";color:#444444\">的权利和义务</span> </p><p style=\"background:white;vertical-align:middle\"><strong><span style=\"font-family:&#39;Arial&#39;,&#39;sans-serif&#39;;color:#444444\">3.1 </span></strong><strong><span style=\";color:#444444\">网约</span></strong><strong><span style=\";color:#444444\">课</span></strong><strong><span style=\";color:#444444\">平台</span></strong><strong><span style=\";color:#444444\">尊重知识产权并注重保护您享有的各项权利。您在</span></strong><strong><span style=\";color:#444444\">网约</span></strong><strong><span style=\";color:#444444\">课</span></strong><strong><span style=\";color:#444444\">平台</span></strong><strong><span style=\";color:#444444\">发布（上传）作品和授权</span></strong><strong><span style=\";color:#444444\">网约</span></strong><strong><span style=\";color:#444444\">课</span></strong><strong><span style=\";color:#444444\">平台</span></strong><strong><span style=\";color:#444444\">的行为不会对您就这些作品所享有的知识产权产生任何不良影响，上传（发布）作品的著作权一律归作品的创作者所有。为了更好地对您、您发布（上传）的作品以及</span></strong><strong><span style=\";color:#444444\">网约</span></strong><strong><span style=\";color:#444444\">课</span></strong><strong><span style=\";color:#444444\">平台</span></strong><strong><span style=\";color:#444444\">进行宣传推广，您同意</span></strong><strong><span style=\";color:#444444\">网约</span></strong><strong><span style=\";color:#444444\">课</span></strong><strong><span style=\";color:#444444\">平台</span></strong><strong><span style=\";color:#444444\">可在</span></strong><strong><span style=\";color:#444444\">网约</span></strong><strong><span style=\";color:#444444\">课</span></strong><strong><span style=\";color:#444444\">平台</span></strong><strong><span style=\";color:#444444\">网站及</span></strong><strong><span style=\";color:#444444\">网约</span></strong><strong><span style=\";color:#444444\">课旗下其他产品中使用和传播这些作品，以及为宣传推广的目的将上述作品许可给第三方使用和传播（包括但不限于网络、电子杂志、软件、出版等）。为了更好地维护您的各项知识产权，您同意</span></strong><strong><span style=\";color:#444444\">网约</span></strong><strong><span style=\";color:#444444\">课</span></strong><strong><span style=\";color:#444444\">平台</span></strong><strong><span style=\";color:#444444\">有权针对侵犯您发布（上传）作品相关权利的行为进行维权。若此类维权行为产生任何收益，</span></strong><strong><span style=\";color:#444444\">网约</span></strong><strong><span style=\";color:#444444\">课</span></strong><strong><span style=\";color:#444444\">平台</span></strong><strong><span style=\";color:#444444\">将在扣除维权成本后将维权收益支付给您。</span></strong></p><p style=\"background:white;vertical-align:middle\"><span style=\"font-family:&#39;Arial&#39;,&#39;sans-serif&#39;;color:#444444\">3.2 </span><span style=\";color:#444444\">网约</span><span style=\";color:#444444\">课</span><span style=\";color:#444444\">平台</span><span style=\";color:#444444\">有权对您上传的作品进行事先审核，经审核通过的作品方可在</span><span style=\";color:#444444\">网约</span><span style=\";color:#444444\">课</span><span style=\";color:#444444\">平台</span><span style=\";color:#444444\">发布。<strong>但该审核仅以合理程度为限，</strong></span><strong><span style=\";color:#444444\">网约</span></strong><strong><span style=\";color:#444444\">课</span></strong><strong><span style=\";color:#444444\">平台</span></strong><strong><span style=\";color:#444444\">并不实际控制您或其作品，不对其审核结果承担任何法律责任，亦不对您作品的合法性、不侵权、完整性做出任何明示或暗示的担保、保证责任。</span></strong></p><p style=\"background:white;vertical-align:middle\"><span style=\"font-family:&#39;Arial&#39;,&#39;sans-serif&#39;;color:#444444\">3.3 </span><span style=\";color:#444444\">网约</span><span style=\";color:#444444\">课</span><span style=\";color:#444444\">平台</span><span style=\";color:#444444\">有权知悉您的身份信息、注册数据，如发现该等信息、数据中存在任何问题或怀疑，可要求您改正，或者直接做出删除、屏蔽等处理。</span></p><p style=\"background:white;vertical-align:middle\"><strong><span style=\"font-family:&#39;Arial&#39;,&#39;sans-serif&#39;;color:#444444\">3.4 </span></strong><strong><span style=\";color:#444444\">网约</span></strong><strong><span style=\";color:#444444\">课</span></strong><strong><span style=\";color:#444444\">平台</span></strong><strong><span style=\";color:#444444\">为</span></strong><strong><span style=\";color:#444444\">网约</span></strong><strong><span style=\";color:#444444\">课课程制作平台的开发、运营提供技术支持和信息存储的空间，并对该平台的开发和运营等过程中产生的所有信息等享有完整、全部权利，包括但不限于著作权、专利权、商标权、商业秘密及其他知识财产和其他权利。</span></strong></p><p style=\"background:white;vertical-align:middle\"><span style=\"font-family:&#39;Arial&#39;,&#39;sans-serif&#39;;color:#444444\">3.5 </span><strong><span style=\";color:#444444\">网约</span></strong><strong><span style=\";color:#444444\">课</span></strong><strong><span style=\";color:#444444\">平台</span></strong><strong><span style=\";color:#444444\">保留随时变更或终止</span></strong><strong><span style=\";color:#444444\">网约</span></strong><strong><span style=\";color:#444444\">课课程制作平台服务的权利，并无需对行使该权利向您承担责任。</span></strong><span style=\";color:#444444\">网约</span><span style=\";color:#444444\">课</span><span style=\";color:#444444\">平台</span><span style=\";color:#444444\">可通过网页公告、电子邮件、电话或信件传送等方式向您发出通知，该等通知在发送时即视为已送达收件人。</span></p><p style=\"background:white;vertical-align:middle\"><span style=\"font-family:&#39;Arial&#39;,&#39;sans-serif&#39;;color:#444444\">3.6 </span><span style=\";color:#444444\">为了更好地对您发布的课程作品以及</span><span style=\";color:#444444\">网约</span><span style=\";color:#444444\">课</span><span style=\";color:#444444\">平台</span><span style=\";color:#444444\">进行宣传推广，您同意</span><span style=\";color:#444444\">网约</span><span style=\";color:#444444\">课</span><span style=\";color:#444444\">在</span><span style=\";color:#444444\">网约</span><span style=\";color:#444444\">课</span><span style=\";color:#444444\">平台</span><span style=\";color:#444444\">以及</span><span style=\";color:#444444\">网约</span><span style=\";color:#444444\">课</span><span style=\";color:#444444\">旗下其他产品中及其他第三方渠道为宣传推广之目的使用您的姓名、名称、肖像、商标、标识、课程内容等信息。</span></p><p style=\"background:white;vertical-align:middle\"><span style=\"font-family:&#39;Arial&#39;,&#39;sans-serif&#39;;color:#444444\">3.7 </span><span style=\";color:#444444\">网约</span><span style=\";color:#444444\">课</span><span style=\";color:#444444\">平台</span><span style=\";color:#444444\">对不可抗力导致的损失不承担责任。本协议所指不可抗力包括：天灾、法律法规或政府指令的变更，因网络服务特性而特有的原因，例如境内外基础电信运营商的故障、计算机或互联网相关技术缺陷、互联网覆盖范围限制、计算机病毒、黑客攻击等因素，及其他合法范围内的不能预见、不能避免并不能克服的客观情况。</span> </p><p style=\"background:white;vertical-align:middle\"><span style=\"font-family:&#39;Arial&#39;,&#39;sans-serif&#39;;color:#444444\">&nbsp;</span></p><p style=\"background:white;vertical-align:middle\">四、网约课课程制作平台的使用规则</p><p style=\"background:white;vertical-align:middle\"><span style=\"font-family:&#39;Arial&#39;,&#39;sans-serif&#39;;color:#444444\">4.1 </span><span style=\";color:#444444\">网约</span><span style=\";color:#444444\">课</span><span style=\";color:#444444\">平台</span><span style=\";color:#444444\">谢绝任何形式的转载，严禁剽窃、抄袭，否则因此产生的一切后果、责任由行为人承担。</span><span style=\";color:#444444\">网约</span><span style=\";color:#444444\">课</span><span style=\";color:#444444\">平台</span><span style=\";color:#444444\">保留追究行为人责任的权利。</span></p><p style=\"background:white;vertical-align:middle\"><span style=\"font-family:&#39;Arial&#39;,&#39;sans-serif&#39;;color:#444444\">4.2 </span><strong><span style=\";color:#444444\">如您或您上传、发布或发表的作品违反下述规则，</span></strong><strong><span style=\";color:#444444\">网约</span></strong><strong><span style=\";color:#444444\">课</span></strong><strong><span style=\";color:#444444\">平台</span></strong><strong><span style=\";color:#444444\">有完全的权利在不通知您的情况下，删除您帐号及</span></strong><strong><span style=\"font-family:&#39;Arial&#39;,&#39;sans-serif&#39;;color:#444444\">\\</span></strong><strong><span style=\";color:#444444\">或您帐号下发布的全部或部分内容，由此产生的损失由您承担。</span></strong></p><p style=\"background:white;vertical-align:middle\"><strong><span style=\"font-family:&#39;Arial&#39;,&#39;sans-serif&#39;;color:#444444\">1)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></strong><strong><span style=\";color:#444444\">您的行为干扰了</span></strong><strong><span style=\";color:#444444\">网约</span></strong><strong><span style=\";color:#444444\">课课程制作平台任何部分或功能的正常运行；</span></strong></p><p style=\"background:white;vertical-align:middle\"><strong><span style=\"font-family:&#39;Arial&#39;,&#39;sans-serif&#39;;color:#444444\">2)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></strong><strong><span style=\";color:#444444\">您未经</span></strong><strong><span style=\";color:#444444\">网约</span></strong><strong><span style=\";color:#444444\">课</span></strong><strong><span style=\";color:#444444\">平台</span></strong><strong><span style=\";color:#444444\">允许，利用</span></strong><strong><span style=\";color:#444444\">网约</span></strong><strong><span style=\";color:#444444\">课课程制作平台开展未经</span></strong><strong><span style=\";color:#444444\">网约</span></strong><strong><span style=\";color:#444444\">课公司同意的行为，包括但不限于对通过</span></strong><strong><span style=\";color:#444444\">网约</span></strong><strong><span style=\";color:#444444\">课课程制作平台获得的信息进行商业化活动，如附加广告、商业内容或链接等；</span></strong></p><p style=\"background:white;vertical-align:middle\"><strong><span style=\"font-family:&#39;Arial&#39;,&#39;sans-serif&#39;;color:#444444\">3)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></strong><strong><span style=\";color:#444444\">您的个人信息、作品内容等违反国家法律法规规定，有悖社会道德伦理、公序良俗、政治色彩强烈，引起任何争议，或违反本协议、</span></strong><strong><span style=\";color:#444444\">网约</span></strong><strong><span style=\";color:#444444\">课课程制作平台公示的要求的；</span></strong></p><p style=\"background:white;vertical-align:middle\"><strong><span style=\"font-family:&#39;Arial&#39;,&#39;sans-serif&#39;;color:#444444\">4)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></strong><strong><span style=\";color:#444444\">您利用</span></strong><strong><span style=\";color:#444444\">网约</span></strong><strong><span style=\";color:#444444\">课课程制作平台进行任何违法行为的。</span></strong></p><p style=\"background:white;vertical-align:middle\"><span style=\"font-family:&#39;Arial&#39;,&#39;sans-serif&#39;;color:#444444\">4.3<strong> </strong></span><strong><span style=\";color:#444444\">您同意：您自行负责对发布到</span></strong><strong><span style=\";color:#444444\">网约</span></strong><strong><span style=\";color:#444444\">课课程制作平台的作品进行校对和审核。您使用</span></strong><strong><span style=\";color:#444444\">网约</span></strong><strong><span style=\";color:#444444\">课课程制作平台服务过程的所有行为，均以该平台服务器记录的数据为准。</span></strong><strong> </strong></p><p style=\"background:white;vertical-align:middle\"><strong><span style=\"font-family:&#39;Arial&#39;,&#39;sans-serif&#39;;color:#444444\">&nbsp;</span></strong></p><p style=\"background:white;vertical-align:middle\"><span style=\";color:#444444\">五、收费课程相关规则</span></p><p style=\"background:white;vertical-align:middle\"><span style=\"font-family:&#39;Arial&#39;,&#39;sans-serif&#39;;color:#444444\">5.1 </span><span style=\";color:#444444\">您确认，</span><span style=\";color:#444444\">网约</span><span style=\";color:#444444\">课</span><span style=\";color:#444444\">支付账户将成为您在课程制作平台的唯一结算交易款账户。您应在使用课程制作平台前开通您的</span><span style=\";color:#444444\">网约</span><span style=\";color:#444444\">课</span><span style=\";color:#444444\">平台</span><span style=\";color:#444444\">支付账户并同意《</span><span style=\"font-family: &#39;Arial&#39;,&#39;sans-serif&#39;;color:#444444\">“</span><span style=\";color:#444444\">网约</span><span style=\";color:#444444\">课</span><span style=\"font-family:&#39;Arial&#39;,&#39;sans-serif&#39;;color:#444444\">”</span><span style=\";color:#444444\">服务协议》，并承担交易所产生的法律后果。</span></p><p style=\"background:white;vertical-align:middle\"><span style=\"font-family:&#39;Arial&#39;,&#39;sans-serif&#39;;color:#444444\">5.2 </span><span style=\";color:#444444\">您享有对您制作、发布的收费课程的定价权，但如果发布渠道对定价有特殊规定的（如苹果公司），您同意授权</span><span style=\";color:#444444\">网约</span><span style=\";color:#444444\">课</span><span style=\";color:#444444\">平台</span><span style=\";color:#444444\">根据各渠道发布的规则对您发布的收费课程的价格进行调整。<strong>若您对</strong></span><strong><span style=\";color:#444444\">网约</span></strong><strong><span style=\";color:#444444\">课</span></strong><strong><span style=\";color:#444444\">平台</span></strong><strong><span style=\";color:#444444\">调整后的价格持有异议的，您应在</span></strong><strong><span style=\";color:#444444\">网约</span></strong><strong><span style=\";color:#444444\">课</span></strong><strong><span style=\";color:#444444\">平台</span></strong><strong><span style=\";color:#444444\">调整后</span></strong><strong><span style=\"font-family:&#39;Arial&#39;,&#39;sans-serif&#39;;color:#444444\">2</span></strong><strong><span style=\";color:#444444\">日内通知</span></strong><strong><span style=\";color:#444444\">网约</span></strong><strong><span style=\";color:#444444\">课</span></strong><strong><span style=\";color:#444444\">平台</span></strong><strong><span style=\";color:#444444\">修改，若上述期限内您未对</span></strong><strong><span style=\";color:#444444\">网约</span></strong><strong><span style=\";color:#444444\">课</span></strong><strong><span style=\";color:#444444\">平台</span></strong><strong><span style=\";color:#444444\">上述操作提出异议的，视为您同意</span></strong><strong><span style=\";color:#444444\">网约</span></strong><strong><span style=\";color:#444444\">课</span></strong><strong><span style=\";color:#444444\">平台</span></strong><strong><span style=\";color:#444444\">的上述操作。</span></strong></p><p style=\"background:white;vertical-align:middle\"><span style=\"font-family:&#39;Arial&#39;,&#39;sans-serif&#39;;color:#444444\">5.3 </span><span style=\";color:#444444\">您有权对您通过</span><span style=\";color:#444444\">网约</span><span style=\";color:#444444\">课</span><span style=\";color:#444444\">平台</span><span style=\";color:#444444\">发布的收费课程进行更新，但您同意并保证您通过</span><span style=\";color:#444444\">网约</span><span style=\";color:#444444\">课</span><span style=\";color:#444444\">平台</span><span style=\";color:#444444\">已发布的收费课程不得进行任何删减。若您违反本款约定，</span><span style=\";color:#444444\">网约</span><span style=\";color:#444444\">课</span><span style=\";color:#444444\">平台</span><span style=\";color:#444444\">有权指示第三方支付机构</span><span style=\";color:#444444\">网约</span><span style=\";color:#444444\">课</span><span style=\";color:#444444\">平台</span><span style=\";color:#444444\">支付暂停对您实际收益的结算，您还应退还已经结算的全部实际收益，如仍未能弥补用户、</span><span style=\";color:#444444\">网约</span><span style=\";color:#444444\">课</span><span style=\";color:#444444\">平台</span><span style=\";color:#444444\">遭受的损失的，</span><span style=\";color:#444444\">网约</span><span style=\";color:#444444\">课</span><span style=\";color:#444444\">平台</span><span style=\";color:#444444\">有权向您追偿，同时</span><span style=\";color:#444444\">网约</span><span style=\";color:#444444\">课</span><span style=\";color:#444444\">平台</span><span style=\";color:#444444\">有权删除您帐号及</span><span style=\"font-family: &#39;Arial&#39;,&#39;sans-serif&#39;;color:#444444\">\\</span><span style=\";color:#444444\">或您帐号下发布的全部或部分内容，由此产生的损失由您承担。</span></p><p style=\"background:white;vertical-align:middle\"><span style=\"font-family:&#39;Arial&#39;,&#39;sans-serif&#39;;color:#444444\">5.4 </span><span style=\";color:#444444\">您确认</span><span style=\"font-family:&#39;Arial&#39;,&#39;sans-serif&#39;;color:#444444\">,</span><span style=\";color:#444444\">如本协议终止，</span><span style=\";color:#444444\">网约</span><span style=\";color:#444444\">课</span><span style=\";color:#444444\">平台</span><span style=\";color:#444444\">已经展示收费课程的页面（包括</span><span style=\"font-family:&#39;Arial&#39;,&#39;sans-serif&#39;;color:#444444\">www.wyuek.com</span><span style=\";color:#444444\">及客户端各系统版本）可以继续保留而不删除</span><span style=\"font-family:&#39;Arial&#39;,&#39;sans-serif&#39;;color:#444444\">,</span><span style=\";color:#444444\">针对</span><span style=\";color:#444444\">网约</span><span style=\";color:#444444\">课</span><span style=\";color:#444444\">平台</span><span style=\";color:#444444\">用户已经付费购买的收费课程，</span><span style=\";color:#444444\">网约</span><span style=\";color:#444444\">课</span><span style=\";color:#444444\">平台</span><span style=\";color:#444444\">用户可以持续使用而不受本协议终止、课程下线等因素的影响。</span></p><p style=\"background:white;vertical-align:middle\"><span style=\"font-family:&#39;Arial&#39;,&#39;sans-serif&#39;;color:#444444\">5.5 </span><span style=\";color:#444444\">基于</span><span style=\";color:#444444\">网约</span><span style=\";color:#444444\">课</span><span style=\";color:#444444\">采用平台支持模式与您进行合作，您同意您在</span><span style=\";color:#444444\">网约</span><span style=\";color:#444444\">课</span><span style=\";color:#444444\">平台</span><span style=\";color:#444444\">发布收费课程获得的实际收益（以下简称</span><span style=\"font-family:&#39;Arial&#39;,&#39;sans-serif&#39;;color:#444444\">“</span><span style=\";color:#444444\">实际收益</span><span style=\"font-family:&#39;Arial&#39;,&#39;sans-serif&#39;;color:#444444\">”</span><span style=\";color:#444444\">）由第三方支付机构</span><span style=\";color:#444444\">网约</span><span style=\";color:#444444\">课</span><span style=\";color:#444444\">平台</span><span style=\";color:#444444\">支付代为收取并结算。</span><span style=\"font-family: &#39;Arial&#39;,&#39;sans-serif&#39;;color:#444444\">“</span><span style=\";color:#444444\">实际收益</span><span style=\"font-family:&#39;Arial&#39;,&#39;sans-serif&#39;;color:#444444\">”</span><span style=\";color:#444444\">是指用户通过</span><span style=\";color:#444444\">网约</span><span style=\";color:#444444\">课</span><span style=\";color:#444444\">平台</span><span style=\";color:#444444\">购买您发布的收费课程而实际支付的费用扣除各项成本后的收益，成本包括渠道成本和其他成本。其中渠道成本指用户使用特定渠道付费产生的成本或费用，包括但不限于苹果公司</span><span style=\"font-family:&#39;Arial&#39;,&#39;sans-serif&#39;;color:#444444\">App Store</span><span style=\";color:#444444\">扣除的渠道费用等。</span></p><p style=\"background:white;vertical-align:middle\"><span style=\"font-family:&#39;Arial&#39;,&#39;sans-serif&#39;;color:#444444\">5.6</span><span style=\";color:#444444\">您同意，</span><span style=\";color:#444444\">网约</span><span style=\";color:#444444\">课</span><span style=\";color:#444444\">平台</span><span style=\";color:#444444\">将按照与您每次结算时确定的您应取得的实际收益的</span><span style=\"font-family:&#39;Arial&#39;,&#39;sans-serif&#39;;color:#FFC000\">10%</span><span style=\";color:#444444\">向您收取平台服务费。平台服务费在</span><span style=\";color:#444444\">网约</span><span style=\";color:#444444\">课</span><span style=\";color:#444444\">平台</span><span style=\";color:#444444\">与您每次结算时由</span><span style=\";color:#444444\">网约</span><span style=\";color:#444444\">课</span><span style=\";color:#444444\">平台</span><span style=\";color:#444444\">自动扣除，扣除平台服务费后的实际收益</span><span style=\";color:#444444\">网约</span><span style=\";color:#444444\">课</span><span style=\";color:#444444\">平台</span><span style=\";color:#444444\">将通过第三方支付机构</span><span style=\";color:#444444\">网约</span><span style=\";color:#444444\">课</span><span style=\";color:#444444\">平台</span><span style=\";color:#444444\">支付支付至您指定的</span><span style=\";color:#444444\">网约</span><span style=\";color:#444444\">课</span><span style=\";color:#444444\">平台</span><span style=\";color:#444444\">支付账户。</span></p><p style=\"background:white;vertical-align:middle\"><span style=\"font-family:&#39;Arial&#39;,&#39;sans-serif&#39;;color:#444444\">5.7</span><span style=\";color:#444444\">您同意，您通过</span><span style=\";color:#444444\">网约</span><span style=\";color:#444444\">课</span><span style=\";color:#444444\">平台所获得的实际收益均为税前收益，您应按照中国税法的相关规定自行申报缴纳税款。</span></p><p style=\"background:white;vertical-align:middle\"><span style=\"font-family:&#39;Arial&#39;,&#39;sans-serif&#39;;color:#444444\">5.8</span><span style=\";color:#444444\">您同意，</span><span style=\";color:#444444\">网约</span><span style=\";color:#444444\">课</span><span style=\";color:#444444\">平台</span><span style=\";color:#444444\">与您的结算周期及结算依据如下：</span></p><p style=\"background:white;vertical-align:middle\"><span style=\"font-family:&#39;Arial&#39;,&#39;sans-serif&#39;;color:#444444\">5.8.1</span><span style=\";color:#444444\">如用户通过</span><span style=\";color:#444444\">网约</span><span style=\";color:#444444\">课</span><span style=\";color:#444444\">平台</span><span style=\"font-family:&#39;Arial&#39;,&#39;sans-serif&#39;;color:#444444\">IOS</span><span style=\";color:#444444\">客户端（包括</span><span style=\"font-family:&#39;Arial&#39;,&#39;sans-serif&#39;;color:#444444\">iphone</span><span style=\";color:#444444\">端、</span><span style=\"font-family:&#39;Arial&#39;,&#39;sans-serif&#39;;color:#444444\">ipad</span><span style=\";color:#444444\">端，以下简称</span><span style=\"font-family:&#39;Arial&#39;,&#39;sans-serif&#39;;color:#444444\">“IOS</span><span style=\";color:#444444\">客户端</span><span style=\"font-family:&#39;Arial&#39;,&#39;sans-serif&#39;;color:#444444\">”</span><span style=\";color:#444444\">）购买您发布的收费课程且完成实际费用支付的，</span><span style=\";color:#444444\">网约</span><span style=\";color:#444444\">课</span><span style=\";color:#444444\">平台</span><span style=\";color:#444444\">与您的结算周期为用户在</span><span style=\"font-family: &#39;Arial&#39;,&#39;sans-serif&#39;;color:#444444\">IOS</span><span style=\";color:#444444\">客户端完成交易（即用户通过</span><span style=\"font-family:&#39;Arial&#39;,&#39;sans-serif&#39;;color:#444444\">IOS</span><span style=\";color:#444444\">客户端成功支付购买收费课程）后的第</span><span style=\"font-family:&#39;Arial&#39;,&#39;sans-serif&#39;;color:#444444\">90</span><span style=\";color:#444444\">天。</span><span style=\";color:#444444\">网约</span><span style=\";color:#444444\">课</span><span style=\";color:#444444\">平台</span><span style=\";color:#444444\">与您结算应以苹果提供的账单为结算依据，如您对苹果账单中的数据持有异议，您应自行联系苹果公司对有异议的内容进行确认。</span></p><p style=\"background:white;vertical-align:middle\"><span style=\"font-family:&#39;Arial&#39;,&#39;sans-serif&#39;;color:#444444\">5.8.2</span><span style=\";color:#444444\">如用户通过</span><span style=\";color:#444444\">网约</span><span style=\";color:#444444\">课</span><span style=\";color:#444444\">平台</span><span style=\";color:#444444\">其他渠道（包括但不限于网页端、</span><span style=\"font-family:&#39;Arial&#39;,&#39;sans-serif&#39;;color:#444444\">Android</span><span style=\";color:#444444\">端，以下简称</span><span style=\"font-family:&#39;Arial&#39;,&#39;sans-serif&#39;;color:#444444\">“</span><span style=\";color:#444444\">网约</span><span style=\";color:#444444\">课</span><span style=\";color:#444444\">其他渠道</span><span style=\"font-family:&#39;Arial&#39;,&#39;sans-serif&#39;;color:#444444\">”</span><span style=\";color:#444444\">）购买您发布的收费课程且完成实际费用支付的，</span><span style=\";color:#444444\">网约</span><span style=\";color:#444444\">课</span><span style=\";color:#444444\">平台</span><span style=\";color:#444444\">与您的结算周期为用户在</span><span style=\";color:#444444\">网约</span><span style=\";color:#444444\">课</span><span style=\";color:#444444\">平台</span><span style=\";color:#444444\">其他渠道完成交易（即用户通过其他渠道成功支付购买收费课程）</span><span style=\";color:#444444\">网约</span><span style=\";color:#444444\">课</span><span style=\";color:#444444\">平台</span><span style=\";color:#444444\">支付后的第</span><span style=\"font-family:&#39;Arial&#39;,&#39;sans-serif&#39;;color:#444444\">21</span><span style=\";color:#444444\">天。如在该期间并未发生用户申请退款的，则双方结算时，</span><span style=\";color:#444444\">网约</span><span style=\";color:#444444\">课</span><span style=\";color:#444444\">平台</span><span style=\";color:#444444\">将会在直接扣减该笔交易对应的平台服务费后，将剩余的实际收益支付至您指定的</span><span style=\";color:#444444\">网约</span><span style=\";color:#444444\">课</span><span style=\";color:#444444\">平台</span><span style=\";color:#444444\">帐户内。您同意并理解，若用户在上述期间内要求退款的，</span><span style=\";color:#444444\">网约</span><span style=\";color:#444444\">课</span><span style=\";color:#444444\">平台</span><span style=\";color:#444444\">有权将用户实际支付的金额退还用户而无需取得您的同意。若用户超过上述期间要求退款的，您同意</span><span style=\";color:#444444\">网约</span><span style=\";color:#444444\">课</span><span style=\";color:#444444\">平台</span><span style=\";color:#444444\">将会把您的联系方式等信息披露给用户，由您与用户自行沟通协商解决。您同意，</span><span style=\";color:#444444\">网约</span><span style=\";color:#444444\">课</span><span style=\";color:#444444\">平台</span><span style=\";color:#444444\">与您的结算应以收费课程制作平台及</span><span style=\";color:#444444\">网约</span><span style=\";color:#444444\">课</span><span style=\";color:#444444\">平台</span><span style=\";color:#444444\">支付系统的相关交易记录为准。</span></p><p style=\"background:white;vertical-align:middle\"><strong><span style=\"font-family:&#39;Arial&#39;,&#39;sans-serif&#39;;color:#444444\">5.9 </span></strong><strong><span style=\";color:#444444\">您确认，如用户通过</span></strong><strong><span style=\";color:#444444\">网约</span></strong><strong><span style=\";color:#444444\">课</span></strong><strong><span style=\";color:#444444\">平台</span></strong><strong><span style=\";color:#444444\">购买您发布的收费课程后要求开具发票的，您应负责按照法律法规要求按照用户通过</span></strong><strong><span style=\";color:#444444\">网约</span></strong><strong><span style=\";color:#444444\">课</span></strong><strong><span style=\";color:#444444\">平台</span></strong><strong><span style=\";color:#444444\">购买您发布的收费课程而实际支付的费用金额向用户提供合法发票。如在用户向您提出开具发票需求后</span></strong><strong><span style=\"font-family:&#39;Arial&#39;,&#39;sans-serif&#39;;color:#444444\">7</span></strong><strong><span style=\";color:#444444\">日内您仍未向用户提供发票的，如用户据此向</span></strong><strong><span style=\";color:#444444\">网约</span></strong><strong><span style=\";color:#444444\">课</span></strong><strong><span style=\";color:#444444\">平台</span></strong><strong><span style=\";color:#444444\">要求退款的，</span></strong><strong><span style=\";color:#444444\">网约</span></strong><strong><span style=\";color:#444444\">课</span></strong><strong><span style=\";color:#444444\">平台</span></strong><strong><span style=\";color:#444444\">有权单方决定给用户办理退款事宜而无需取得您的同意。</span></strong></p><p style=\"background:white;vertical-align:middle\"><span style=\"font-family:&#39;Arial&#39;,&#39;sans-serif&#39;;color:#444444\">5.10</span><span style=\";color:#444444\">您应保证您所提供的</span><span style=\";color:#444444\">网约</span><span style=\";color:#444444\">课</span><span style=\";color:#444444\">平台</span><span style=\";color:#444444\">支付帐号信息准确无误，如发生变更或者其他不可用的情况，或发现有非法使用您的帐号或出现安全漏洞的情况，您应及时通知</span><span style=\";color:#444444\">网约</span><span style=\";color:#444444\">课</span><span style=\";color:#444444\">平台</span><span style=\";color:#444444\">。否则，因此造成的损失由您自行承担。</span></p><p style=\"background:white;vertical-align:middle\"><span style=\"font-family:&#39;Arial&#39;,&#39;sans-serif&#39;;color:#444444\">&nbsp;</span></p><p style=\"background:white;vertical-align:middle\"><span style=\";color:#444444\">六、通知</span></p><p style=\"background:white;vertical-align:middle\"><strong><span style=\";color:#444444\">所有发给您的通知都可通过电子邮件、常规的信件或在</span></strong><strong><span style=\";color:#444444\">网约</span></strong><strong><span style=\";color:#444444\">课</span></strong><strong><span style=\";color:#444444\">平台</span></strong><strong><span style=\";color:#444444\">课程制作平台或</span></strong><strong><span style=\";color:#444444\">网约</span></strong><strong><span style=\";color:#444444\">课网站内显著位置公告的方式进行传送。</span></strong><strong><span style=\";color:#444444\">网约</span></strong><strong><span style=\";color:#444444\">课公司将通过上述方法之一将消息传递给用户，告知他们使用协议的修改、服务变更、或其它重要事情。</span></strong></p><p style=\"background:white;vertical-align:middle\"><span style=\"font-family:&#39;Arial&#39;,&#39;sans-serif&#39;;color:#444444\">&nbsp;</span></p><p style=\"background:white;vertical-align:middle\"><span style=\";color:#444444\">七、其他</span></p><p style=\"background:white;vertical-align:middle\"><span style=\"font-family:&#39;Arial&#39;,&#39;sans-serif&#39;;color:#444444\">1</span><span style=\";color:#444444\">、<strong>除非另有证明，</strong></span><strong><span style=\";color:#444444\">网约</span></strong><strong><span style=\";color:#444444\">课公司储存在其服务器上的数据是您使用</span></strong><strong><span style=\";color:#444444\">网约</span></strong><strong><span style=\";color:#444444\">课</span></strong><strong><span style=\";color:#444444\">平台</span></strong><strong><span style=\";color:#444444\">课堂制作平台的唯一有效证据。</span></strong></p><p style=\"background:white;vertical-align:middle\"><span style=\"font-family:&#39;Arial&#39;,&#39;sans-serif&#39;;color:#444444\">2</span><span style=\";color:#444444\">、<strong>本条款自发布之日起实施，并构成您和</strong></span><strong><span style=\";color:#444444\">网约</span></strong><strong><span style=\";color:#444444\">课公司之间的共识。</span></strong><strong><span style=\";color:#444444\">网约</span></strong><strong><span style=\";color:#444444\">课公司不行使、未能及时行使或者未充分行使本条款或者按照法律规定所享有的权利，不应被视为放弃该权利，也不影响</span></strong><strong><span style=\";color:#444444\">网约</span></strong><strong><span style=\";color:#444444\">课公司在将来行使该权利。</span></strong></p><p><strong><span style=\"font-family:&#39;Arial&#39;,&#39;sans-serif&#39;;color:#444444\">3</span></strong><strong><span style=\"font-family:宋体;color:#444444\">、</span></strong><span style=\"font-size:16px;font-family:宋体;color:#444444\">对本协议发生任何纠纷或争议，首先应友好协商解决；协商不成的，由网约课公司所在地有管辖权的人民法院管辖。</span></p><p style=\"background:white;vertical-align:middle\"><span style=\"font-family:&#39;Arial&#39;,&#39;sans-serif&#39;;color:#444444\">4</span><span style=\";color:#444444\">、如您对本协议内容有任何疑问，</span><span style=\";color:#444444\">可及时联系客服</span><span style=\";color:#444444\">。</span></p><p>&nbsp;</p><p>&nbsp;</p><p><br/></p>', '2');
INSERT INTO `xieyi` VALUES (18, '网约课积分说明', '<h1 label=\"标题居中\" style=\"font-size: 32px; font-weight: bold; border-bottom: 2px solid rgb(204, 204, 204); padding: 0px 4px 0px 0px; text-align: center; margin: 0px 0px 20px;\">&nbsp; <span style=\"font-family: 宋体; font-size: 24px;\">网约课积分说明</span></h1><p><span style=\"font-size:24px;font-family:宋体\">您应当在使用约课积分之前认真阅读全部须知内容。</span></p><p><span style=\"font-size:24px;font-family:宋体\">一、定义</span></p><p><span style=\"font-size:24px\">1.</span><span style=\"font-size:24px;font-family:宋体\">网约课平台积分。</span></p><p><span style=\"font-size:24px;font-family:宋体\">二、获取方式：</span></p><p><span style=\"font-size:24px\">1.</span><span style=\"font-size:24px;font-family:宋体\">签到获取。</span></p><p><span style=\"font-size:24px\">2.</span><span style=\"font-size:24px;font-family:宋体\">购买商品获得。</span></p><p><span style=\"font-size:24px\">3.</span><span style=\"font-size:24px;font-family:宋体\">参与网约课活动。</span></p><p><span style=\"font-size:24px;font-family:宋体\">三、约课币使用规则</span></p><p><span style=\"font-size:24px\">1.</span><span style=\"font-size:24px;font-family:宋体\">网约课积分仅限于约课网及约课网的手机客户端及其他约课平台中使用。</span></p><p><span style=\"font-size:24px\">2.</span><span style=\"font-size:24px;font-family:宋体\">网约课积分仅限于兑换约课币，比例以兑换页面为准。</span></p><p><span style=\"font-size:24px;font-family:宋体\">四、按现状提供服务</span></p><p><span style=\"font-size:24px;font-family:宋体\">您理解并同意，约课网的服务是按照现有技术和条件所能达到的现状提供的。约课网会尽最大努力向您提供服务，确保服务的连贯性和安全性。但约课网不能随时预见和防范法律法规、技术以及其他风险（包括但不限于不可抗力、病毒、木马、黑客攻击、系统不稳定、第三方服务瑕疵、政府行为等原因）可能导致的服务中断、数据丢失以及其他的损失和风险。</span></p><p><span style=\"font-size:24px;font-family:宋体\">五、不可抗力及其他免责事由</span></p><p><span style=\"font-size:24px\">1.</span><span style=\"font-size:24px;font-family:宋体\">您理解并同意，在使用本服务的过程中，可能会遇到不可抗力等风险因素，使本服务发生中断。不可抗力是指不能预见、不能克服并不能避免且对一方或双方造成重大影响的客观事件，包括但不限于自然灾害（如洪水、地震、和风暴等）、瘟疫流行以及社会事件（如战争、动乱等）、政府行为等。出现上述情况时，约课网将努力在第一时间与相关单位配合，及时进行修复，但是由此给您造成的损失，约课网在法律允许的范围内免责。</span></p><p><span style=\"font-size:24px\">2.</span><span style=\"font-size:24px;font-family:宋体\">在法律允许的范围内，约课网对以下情形导致的服务中断或受阻不承担责任：</span></p><p><span style=\"font-size:24px;font-family:宋体\">（</span><span style=\"font-size:24px\">1</span><span style=\"font-size:24px;font-family:宋体\">）受到计算机病毒、木马或其他恶意程序、黑客攻击的破坏；</span></p><p><span style=\"font-size:24px;font-family:宋体\">（</span><span style=\"font-size:24px\">2</span><span style=\"font-size:24px;font-family:宋体\">）用户或约课网的电脑软件、系统、硬件和通信线路出现故障；</span></p><p><span style=\"font-size:24px;font-family:宋体\">（</span><span style=\"font-size:24px\">3</span><span style=\"font-size:24px;font-family:宋体\">）用户操作不当；</span></p><p><span style=\"font-size:24px;font-family:宋体\">（</span><span style=\"font-size:24px\">4</span><span style=\"font-size:24px;font-family:宋体\">）用户通过非约课网授权的方式使用本服务；</span></p><p><span style=\"font-size:24px;font-family:宋体\">（</span><span style=\"font-size:24px\">5</span><span style=\"font-size:24px;font-family:宋体\">）其他约课网无法控制或合理预见的情形。</span></p><p><span style=\"font-size:24px\">3.</span><span style=\"font-size:24px;font-family:宋体\">约课网可能根据实际需要对收费服务的收费标准、方式进行修改和变更，约课网也可能会对部分免费服务开始收费。前述修改、变更或开始收费前，约课网将在相应服务页面进行通知或公告。如果您不同意上述修改、变更或付费内容，则应停止使用约课币及其相关服务。</span></p><p><span style=\"font-size:24px;font-family:宋体\">六、服务的变更、中断、终止</span></p><p><span style=\"font-size:24px\">1.</span><span style=\"font-size:24px;font-family:宋体\">约课网可能会对服务内容进行变更，也可能会中断、中止或终止服务。</span></p><p><span style=\"font-size:24px\">2.</span><span style=\"font-size:24px;font-family:宋体\">您理解并同意，约课网有权自主决定经营策略。在约课网发生合并、分立、收购、资产转让时，约课网可向第三方转让本服务下相关资产；约课网也可在单方通知您后，将本须知下部分或全部服务转交由第三方运营或履行。具体受让主体以约课网通知为准。</span></p><p><span style=\"font-size:24px\">3.</span><span style=\"font-size:24px;font-family:宋体\">如发生下列任何一种情形，约课网有权不经通知而中断或终止向您提供的服务：</span></p><p><span style=\"font-size:24px;font-family:宋体\">（</span><span style=\"font-size:24px\">1</span><span style=\"font-size:24px;font-family:宋体\">）根据法律规定您应提交真实信息，而您提供的个人资料不真实、或与注册时信息不一致又未能提供合理证明；</span></p><p><span style=\"font-size:24px;font-family:宋体\">（</span><span style=\"font-size:24px\">2</span><span style=\"font-size:24px;font-family:宋体\">）您违反相关法律法规或本须知的约定；</span></p><p><span style=\"font-size:24px;font-family:宋体\">（</span><span style=\"font-size:24px\">3</span><span style=\"font-size:24px;font-family:宋体\">）按照法律规定或主管部门的要求；</span></p><p><span style=\"font-size:24px;font-family:宋体\">（</span><span style=\"font-size:24px\">4</span><span style=\"font-size:24px;font-family:宋体\">）出于安全的原因或其他必要的情形。</span></p><p><span style=\"font-size:19px\">&nbsp;</span></p><p><br/></p>', '0');

SET FOREIGN_KEY_CHECKS = 1;
