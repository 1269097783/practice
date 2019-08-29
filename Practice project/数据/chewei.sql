/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50719
Source Host           : localhost:3306
Source Database       : chewei

Target Server Type    : MYSQL
Target Server Version : 50719
File Encoding         : 65001

Date: 2019-08-17 08:53:33
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tp_chewei
-- ----------------------------
DROP TABLE IF EXISTS `tp_chewei`;
CREATE TABLE `tp_chewei` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_id` int(11) NOT NULL COMMENT '关联车位具体位置',
  `status` int(1) NOT NULL DEFAULT '0' COMMENT '销售状态 0=》未售出 1=》已售出',
  `vip_id` int(11) DEFAULT NULL COMMENT '车位用户id',
  `kong` int(1) NOT NULL DEFAULT '0' COMMENT '停车状态 0=》空车位 1=》已停车',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8 COMMENT='车位管理';

-- ----------------------------
-- Records of tp_chewei
-- ----------------------------
INSERT INTO `tp_chewei` VALUES ('31', '117', '1', '14', '1');
INSERT INTO `tp_chewei` VALUES ('32', '118', '0', null, '1');
INSERT INTO `tp_chewei` VALUES ('33', '119', '0', null, '1');
INSERT INTO `tp_chewei` VALUES ('34', '120', '0', null, '1');
INSERT INTO `tp_chewei` VALUES ('35', '121', '0', null, '1');
INSERT INTO `tp_chewei` VALUES ('36', '122', '0', null, '1');
INSERT INTO `tp_chewei` VALUES ('37', '123', '0', null, '1');
INSERT INTO `tp_chewei` VALUES ('38', '124', '0', null, '1');
INSERT INTO `tp_chewei` VALUES ('39', '125', '0', null, '1');
INSERT INTO `tp_chewei` VALUES ('40', '128', '0', null, '1');
INSERT INTO `tp_chewei` VALUES ('41', '129', '0', null, '1');
INSERT INTO `tp_chewei` VALUES ('42', '130', '0', null, '1');
INSERT INTO `tp_chewei` VALUES ('43', '131', '0', null, '1');
INSERT INTO `tp_chewei` VALUES ('44', '132', '0', null, '0');
INSERT INTO `tp_chewei` VALUES ('45', '136', '0', null, '0');
INSERT INTO `tp_chewei` VALUES ('46', '137', '0', null, '0');
INSERT INTO `tp_chewei` VALUES ('47', '138', '0', null, '0');
INSERT INTO `tp_chewei` VALUES ('48', '139', '0', null, '1');
INSERT INTO `tp_chewei` VALUES ('49', '140', '0', null, '0');
INSERT INTO `tp_chewei` VALUES ('50', '141', '0', null, '0');
INSERT INTO `tp_chewei` VALUES ('51', '142', '0', null, '0');
INSERT INTO `tp_chewei` VALUES ('52', '143', '0', null, '0');
INSERT INTO `tp_chewei` VALUES ('53', '144', '0', null, '0');
INSERT INTO `tp_chewei` VALUES ('54', '145', '0', null, '0');
INSERT INTO `tp_chewei` VALUES ('55', '146', '0', null, '0');
INSERT INTO `tp_chewei` VALUES ('56', '147', '0', null, '0');
INSERT INTO `tp_chewei` VALUES ('57', '148', '0', null, '0');

-- ----------------------------
-- Table structure for tp_hydropower
-- ----------------------------
DROP TABLE IF EXISTS `tp_hydropower`;
CREATE TABLE `tp_hydropower` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `record1` varchar(7) NOT NULL COMMENT '记录1,上一次缴费时水电表数',
  `record2` varchar(7) NOT NULL COMMENT '记录2,本次缴费时水电表数',
  `vip_id` int(11) NOT NULL COMMENT '住户id',
  `xiangmu_id` int(11) NOT NULL COMMENT '缴费项目：2=》水，4=》电',
  `date` varchar(7) NOT NULL COMMENT '本次缴费时间：年—月',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='书费记录表';

-- ----------------------------
-- Records of tp_hydropower
-- ----------------------------
INSERT INTO `tp_hydropower` VALUES ('1', '0', '15', '14', '2', '2010-07');
INSERT INTO `tp_hydropower` VALUES ('2', '0', '2', '15', '4', '2010-07');
INSERT INTO `tp_hydropower` VALUES ('3', '0', '2', '15', '2', '2019-08');
INSERT INTO `tp_hydropower` VALUES ('4', '0', '2', '16', '2', '2019-08');
INSERT INTO `tp_hydropower` VALUES ('5', '0', '2', '16', '4', '2019-08');
INSERT INTO `tp_hydropower` VALUES ('6', '15', '17', '14', '2', '2019-08');
INSERT INTO `tp_hydropower` VALUES ('7', '0', '23', '14', '4', '2019-08');

-- ----------------------------
-- Table structure for tp_money
-- ----------------------------
DROP TABLE IF EXISTS `tp_money`;
CREATE TABLE `tp_money` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vip_id` int(11) NOT NULL COMMENT '用户id',
  `xiangmu_id` int(11) NOT NULL COMMENT '缴费项目',
  `money` varchar(10) NOT NULL COMMENT '费用',
  `date` char(7) NOT NULL COMMENT '月份',
  `status` int(1) NOT NULL DEFAULT '0' COMMENT '收费状态 0=》未收费 1=》已收费',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COMMENT='项目收费状态';

-- ----------------------------
-- Records of tp_money
-- ----------------------------
INSERT INTO `tp_money` VALUES ('1', '14', '5', '12', '1996-06', '1');
INSERT INTO `tp_money` VALUES ('10', '14', '5', '50', '2019-08', '1');
INSERT INTO `tp_money` VALUES ('11', '14', '6', '100', '2019-08', '1');
INSERT INTO `tp_money` VALUES ('12', '15', '5', '50', '2019-08', '1');
INSERT INTO `tp_money` VALUES ('13', '15', '6', '100', '2019-08', '1');
INSERT INTO `tp_money` VALUES ('14', '16', '5', '50', '2019-08', '1');
INSERT INTO `tp_money` VALUES ('15', '16', '6', '100', '2019-08', '1');
INSERT INTO `tp_money` VALUES ('16', '17', '5', '50', '2019-08', '1');
INSERT INTO `tp_money` VALUES ('17', '17', '6', '100', '2019-08', '0');
INSERT INTO `tp_money` VALUES ('18', '17', '3', '450', '2019-08', '0');
INSERT INTO `tp_money` VALUES ('19', '15', '2', '450', '2019-08', '0');
INSERT INTO `tp_money` VALUES ('20', '14', '2', '30', '2019-08', '1');
INSERT INTO `tp_money` VALUES ('21', '14', '4', '40.25', '2019-08', '0');

-- ----------------------------
-- Table structure for tp_node
-- ----------------------------
DROP TABLE IF EXISTS `tp_node`;
CREATE TABLE `tp_node` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ename` varchar(20) NOT NULL COMMENT '英文名称',
  `cname` varchar(20) NOT NULL COMMENT '中文名称',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 禁用  1启用',
  `pid` int(11) NOT NULL COMMENT '父级',
  `zhushi` varchar(200) DEFAULT NULL COMMENT '注释',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=105 DEFAULT CHARSET=utf8 COMMENT='权限表(节点表)';

-- ----------------------------
-- Records of tp_node
-- ----------------------------
INSERT INTO `tp_node` VALUES ('1', 'Index', '首页', '1', '0', '');
INSERT INTO `tp_node` VALUES ('2', 'Chewei', '入库', '1', '0', '');
INSERT INTO `tp_node` VALUES ('3', 'getindex', '车辆入库', '1', '2', '输入车牌号入库');
INSERT INTO `tp_node` VALUES ('11', 'index', '查看首页', '1', '1', '查看首页');
INSERT INTO `tp_node` VALUES ('12', 'Chuku', '出库', '1', '0', '');
INSERT INTO `tp_node` VALUES ('13', 'getindex', '车辆出库', '1', '12', '跳转车辆出库页面');
INSERT INTO `tp_node` VALUES ('14', 'Vip', '住户管理', '1', '0', '');
INSERT INTO `tp_node` VALUES ('15', 'getindex', '住户查看', '1', '14', '查看所有住户');
INSERT INTO `tp_node` VALUES ('16', 'getxzyh', '添加住户', '1', '14', '住户入住信息添加');
INSERT INTO `tp_node` VALUES ('17', 'getxg', '住户信息修改', '1', '14', '跳转修改住户登记信息页面');
INSERT INTO `tp_node` VALUES ('18', 'Type', '车位管理', '1', '0', '小区车位管理');
INSERT INTO `tp_node` VALUES ('19', 'top', '首页顶部', '1', '1', '加载首页top页面');
INSERT INTO `tp_node` VALUES ('20', 'left1', '首页管理页面', '1', '1', '加载首页管理页面');
INSERT INTO `tp_node` VALUES ('21', 'left2', '首页缴费页面', '1', '1', '加载首页缴费页面');
INSERT INTO `tp_node` VALUES ('22', 'left3', '首页权限管理页面', '1', '1', '加载首页权限管理页面');
INSERT INTO `tp_node` VALUES ('23', 'middle', '首页middle页面', '1', '1', '加载首页middle页面');
INSERT INTO `tp_node` VALUES ('24', 'zhuye', '首页左边栏页面', '1', '1', '加载首页左边栏页面');
INSERT INTO `tp_node` VALUES ('25', 'postcha', '车辆信息', '1', '2', '判断是否为小区住户跳转不同页面');
INSERT INTO `tp_node` VALUES ('26', 'postsvip', '临时车辆添加信息', '1', '2', '新增临时停车信息');
INSERT INTO `tp_node` VALUES ('27', 'xingxi', '添加车辆入场信息方法', '1', '2', '添加车辆入场信息方法');
INSERT INTO `tp_node` VALUES ('28', 'postchewei', '添加车牌停车位', '1', '2', '执行添加车牌停车位');
INSERT INTO `tp_node` VALUES ('29', 'postcha', '是否缴费', '1', '12', '查询是否需要缴费');
INSERT INTO `tp_node` VALUES ('30', 'postfei', '缴费', '1', '12', '临时停车缴费');
INSERT INTO `tp_node` VALUES ('31', 'Jilu', '缴费', '1', '0', '');
INSERT INTO `tp_node` VALUES ('32', 'getindex', '收费记录', '1', '31', '遍历收费记录');
INSERT INTO `tp_node` VALUES ('33', 'getjiaofei', '创建水电费', '1', '31', '跳转水电费页面');
INSERT INTO `tp_node` VALUES ('34', 'postdanyuan', '遍历单元', '1', '31', 'ajax遍历单元');
INSERT INTO `tp_node` VALUES ('35', 'postchashuidian', '生成水电表', '1', '31', '查询生成水电表');
INSERT INTO `tp_node` VALUES ('36', 'getmoneybiao', '收费查询', '1', '31', '跳转收费查询页面');
INSERT INTO `tp_node` VALUES ('37', 'getmoney', '生成物业费', '1', '31', '一键创建当月物业.车位.垃圾费表');
INSERT INTO `tp_node` VALUES ('38', 'getjiaoqian', '缴费', '1', '31', '缴费');
INSERT INTO `tp_node` VALUES ('39', 'postshujucharu', '提交当月水电记录', '1', '31', '提交当月水电记录，记录信息');
INSERT INTO `tp_node` VALUES ('40', 'Login', '登录', '1', '0', '');
INSERT INTO `tp_node` VALUES ('41', 'index', '登录页', '1', '40', '跳转登录页');
INSERT INTO `tp_node` VALUES ('42', 'verify', '验证码', '1', '40', '加载验证码');
INSERT INTO `tp_node` VALUES ('43', 'yzm', '判断验证码', '1', '40', '判断验证码是否正确');
INSERT INTO `tp_node` VALUES ('44', 'denlu', '登录', '1', '40', '提交信息登录');
INSERT INTO `tp_node` VALUES ('45', 'tuichu', '退出登录', '1', '40', '退出登录，清除信息');
INSERT INTO `tp_node` VALUES ('46', 'Quanxian', '权限', '1', '0', '');
INSERT INTO `tp_node` VALUES ('47', 'getjdbl', '权限查看', '1', '46', '查看所有权限');
INSERT INTO `tp_node` VALUES ('48', 'gettjjd', '增加方法页面', '1', '46', '跳转增加方法页面');
INSERT INTO `tp_node` VALUES ('49', 'posttianjia', '添加方法', '1', '46', '添加方法或控制器');
INSERT INTO `tp_node` VALUES ('50', 'postpdnode', '判断方法', '1', '46', 'ajax判断方法是否存在');
INSERT INTO `tp_node` VALUES ('51', 'getqiyong', '启用禁用', '1', '46', '控制器或方法的启用和禁用');
INSERT INTO `tp_node` VALUES ('52', 'getxiougai', '修改页面', '1', '46', '跳转方法或控制器修改页面');
INSERT INTO `tp_node` VALUES ('53', 'postupda', '修改', '1', '46', '控制器或方法修改');
INSERT INTO `tp_node` VALUES ('54', 'Role', '职位管理', '1', '0', '');
INSERT INTO `tp_node` VALUES ('55', 'getindex', '职位查看', '1', '54', '查看所有职位');
INSERT INTO `tp_node` VALUES ('56', 'gettjjs', '职位添加页面', '1', '54', '跳转职位添加页面');
INSERT INTO `tp_node` VALUES ('57', 'postpdname', '判断职位', '1', '54', 'ajax判断职位是否存在');
INSERT INTO `tp_node` VALUES ('58', 'posttianjia', '职位添加', '1', '54', '添加职位');
INSERT INTO `tp_node` VALUES ('59', 'getxiougai', '修改职位页面', '1', '54', '跳转修改职位页面');
INSERT INTO `tp_node` VALUES ('60', 'postxioug', '修改职位', '1', '54', '修改职位信息');
INSERT INTO `tp_node` VALUES ('61', 'gettype', '区查看', '1', '18', '查看所有区域页面');
INSERT INTO `tp_node` VALUES ('62', 'getertype', '单元查看', '1', '18', '查看单元页面');
INSERT INTO `tp_node` VALUES ('63', 'getxztype', '增加分区', '1', '18', '跳转增加分区页面');
INSERT INTO `tp_node` VALUES ('64', 'postchaxun', '分区是否存在', '1', '18', 'ajax判断该分区是否存在');
INSERT INTO `tp_node` VALUES ('65', 'posttianjiatype', '添加分区', '1', '18', '提交信息，添加分区');
INSERT INTO `tp_node` VALUES ('66', 'getzhifenqu', '增加二级分区', '1', '18', '跳转添加二级分区页面');
INSERT INTO `tp_node` VALUES ('67', 'tjcw', '添加车位方法', '1', '18', '批量添加车位方法');
INSERT INTO `tp_node` VALUES ('68', 'postcheshu', '添加车位', '1', '18', '执行添加车位');
INSERT INTO `tp_node` VALUES ('69', 'getchewei', '车位添加', '1', '18', '跳转车位添加页面');
INSERT INTO `tp_node` VALUES ('70', 'postshan', '删除车位', '1', '18', '批量删除车位');
INSERT INTO `tp_node` VALUES ('71', 'shanquf', '删区方法', '1', '18', '删区方法');
INSERT INTO `tp_node` VALUES ('72', 'getshanqu', '二级分类删除', '1', '18', '执行二级分类删除');
INSERT INTO `tp_node` VALUES ('73', 'getshanding', '顶级分类删除', '1', '18', '执行顶级分类删除');
INSERT INTO `tp_node` VALUES ('74', 'getxiougaier', '二级分类修改', '1', '18', '跳转二级分类修改页面');
INSERT INTO `tp_node` VALUES ('75', 'xiougais', '修改方法', '1', '18', '修改方法');
INSERT INTO `tp_node` VALUES ('76', 'postxiougai', '修改', '1', '18', '执行修改');
INSERT INTO `tp_node` VALUES ('77', 'User', '管理员', '1', '0', '');
INSERT INTO `tp_node` VALUES ('78', 'Index', '管理员查看', '1', '77', '查看所有管理员页面');
INSERT INTO `tp_node` VALUES ('79', 'tianjia', '添加页面', '1', '77', '管理员添加页面');
INSERT INTO `tp_node` VALUES ('80', 'pduser', '判断是否存在', '1', '77', 'ajax判断该用户名是否已经注册');
INSERT INTO `tp_node` VALUES ('81', 'tjiao', '添加', '1', '77', '执行添加');
INSERT INTO `tp_node` VALUES ('82', 'shanchu', '多条信息删除', '1', '77', '多条管理员帐号删除');
INSERT INTO `tp_node` VALUES ('83', 'shan', '单条删除', '1', '77', '单条管理员帐号删除');
INSERT INTO `tp_node` VALUES ('84', 'xiugai', '修改页面', '1', '77', '跳转修改页面');
INSERT INTO `tp_node` VALUES ('85', 'gai', '修改', '1', '77', '执行修改');
INSERT INTO `tp_node` VALUES ('86', 'quanxian', '修改权限', '1', '77', '修改权限');
INSERT INTO `tp_node` VALUES ('87', 'chaxun', '搜索', '1', '77', '条件查询');
INSERT INTO `tp_node` VALUES ('88', 'getdanyuan', '遍历单元', '1', '14', 'ajax联动遍历单元');
INSERT INTO `tp_node` VALUES ('89', 'getchewei', '遍历车位', '1', '14', 'ajax联动遍历未出售的车位');
INSERT INTO `tp_node` VALUES ('90', 'posttianjia', '住户添加', '1', '14', '执行添加');
INSERT INTO `tp_node` VALUES ('91', 'postxiougai', '修改', '1', '14', '执行修改');
INSERT INTO `tp_node` VALUES ('92', 'Xiangmu', '项目', '1', '0', '');
INSERT INTO `tp_node` VALUES ('93', 'getindex', '所有项目', '1', '92', '跳转查看所有项目');
INSERT INTO `tp_node` VALUES ('94', 'gettianjia', '增加项目', '1', '92', '跳转增加项目');
INSERT INTO `tp_node` VALUES ('95', 'postchaname', '判断项目', '1', '92', 'AJAX查看收费项目是否已经存在');
INSERT INTO `tp_node` VALUES ('96', 'postupdat', '添加', '1', '92', '执行添加项目');
INSERT INTO `tp_node` VALUES ('97', 'getxiou', '修改项目', '1', '92', '跳转修改项目页面');
INSERT INTO `tp_node` VALUES ('98', 'postxiouname', '判断是否存在', '1', '92', 'AJAX修改查看收费项目是否已经存在');
INSERT INTO `tp_node` VALUES ('99', 'postxiougai', '修改', '1', '92', '执行修改');
INSERT INTO `tp_node` VALUES ('100', 'Nuoche', '挪车', '1', '0', '');
INSERT INTO `tp_node` VALUES ('101', 'getindex', '查询车牌', '1', '100', '跳转查询车牌页面');
INSERT INTO `tp_node` VALUES ('102', 'postnuo', '发送挪车信息', '1', '100', '发送挪车短信');
INSERT INTO `tp_node` VALUES ('103', 'postcha', '查询车牌', '1', '100', 'ajax查询车牌号码');
INSERT INTO `tp_node` VALUES ('104', 'postxianxing', '判断限行', '1', '12', 'ajax判断是否限行');

-- ----------------------------
-- Table structure for tp_role
-- ----------------------------
DROP TABLE IF EXISTS `tp_role`;
CREATE TABLE `tp_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL COMMENT '角色名',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COMMENT='角色表';

-- ----------------------------
-- Records of tp_role
-- ----------------------------
INSERT INTO `tp_role` VALUES ('9', '超级管理员');
INSERT INTO `tp_role` VALUES ('10', '仅浏览');
INSERT INTO `tp_role` VALUES ('11', '萨达1');

-- ----------------------------
-- Table structure for tp_role_node
-- ----------------------------
DROP TABLE IF EXISTS `tp_role_node`;
CREATE TABLE `tp_role_node` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rid` int(11) NOT NULL COMMENT '角色id',
  `nid` varchar(300) DEFAULT NULL COMMENT '节点id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='角色权限表';

-- ----------------------------
-- Records of tp_role_node
-- ----------------------------
INSERT INTO `tp_role_node` VALUES ('1', '9', '11,19,20,21,22,23,24,3,25,26,27,28,13,29,30,104,15,16,17,88,89,90,91,61,62,63,64,65,66,67,68,69,70,71,72,73,74,75,76,32,33,34,35,36,37,38,39,41,42,43,44,45,47,48,49,50,51,52,53,55,56,57,58,59,60,78,79,80,81,82,83,84,85,86,87,93,94,95,96,97,98,99,101,102,103');
INSERT INTO `tp_role_node` VALUES ('2', '10', '11,19,20,21,22,23,24,15,61,62,32,36,41,42,43,44,45');
INSERT INTO `tp_role_node` VALUES ('3', '11', '11,3');

-- ----------------------------
-- Table structure for tp_shoufei
-- ----------------------------
DROP TABLE IF EXISTS `tp_shoufei`;
CREATE TABLE `tp_shoufei` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vip_id` int(11) NOT NULL COMMENT '临时用户停车为88888',
  `xiangmu_id` int(11) NOT NULL COMMENT '缴费项目',
  `money` varchar(10) NOT NULL COMMENT '费用',
  `date` varchar(20) NOT NULL COMMENT '时间',
  `user` varchar(20) NOT NULL COMMENT '管理员',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COMMENT='收费信息';

-- ----------------------------
-- Records of tp_shoufei
-- ----------------------------
INSERT INTO `tp_shoufei` VALUES ('1', '88888', '1', '93', '2019-07-30 19:34:32', 'admin');
INSERT INTO `tp_shoufei` VALUES ('2', '88888', '3', '93', '2019-07-30 19:35:43', 'admin');
INSERT INTO `tp_shoufei` VALUES ('3', '88888', '3', '93', '2019-07-30 19:37:14', 'admin');
INSERT INTO `tp_shoufei` VALUES ('4', '88888', '3', '93', '2019-07-30 19:39:22', 'admin');
INSERT INTO `tp_shoufei` VALUES ('5', '88888', '1', '93', '2019-07-30 19:41:24', 'admin');
INSERT INTO `tp_shoufei` VALUES ('6', '88888', '1', '93', '2019-07-30 19:41:56', 'admin');
INSERT INTO `tp_shoufei` VALUES ('7', '88888', '1', '93', '2019-07-30 19:46:26', 'admin');
INSERT INTO `tp_shoufei` VALUES ('8', '88888', '1', '93', '2019-07-30 19:48:57', 'admin');
INSERT INTO `tp_shoufei` VALUES ('9', '88888', '1', '93', '2019-07-30 19:49:19', 'admin');
INSERT INTO `tp_shoufei` VALUES ('10', '88888', '1', '93', '2019-07-30 19:49:27', 'admin');
INSERT INTO `tp_shoufei` VALUES ('11', '88888', '1', '93', '2019-07-30 20:05:51', 'admin');
INSERT INTO `tp_shoufei` VALUES ('12', '88888', '1', '27', '2019-07-30 20:06:58', 'admin');
INSERT INTO `tp_shoufei` VALUES ('13', '17', '1', '30', '2019-07-30 20:08:25', 'admin');
INSERT INTO `tp_shoufei` VALUES ('14', '16', '1', '30', '2019-07-30 20:10:45', 'admin');
INSERT INTO `tp_shoufei` VALUES ('15', '15', '1', '30', '2019-07-30 20:12:24', 'admin');
INSERT INTO `tp_shoufei` VALUES ('16', '14', '1', '30', '2019-07-30 20:13:39', 'admin');
INSERT INTO `tp_shoufei` VALUES ('17', '88888', '1', '30', '2019-07-30 21:02:29', 'admin');
INSERT INTO `tp_shoufei` VALUES ('18', '88888', '1', '12', '2019-07-31 14:20:00', 'admin');
INSERT INTO `tp_shoufei` VALUES ('19', '15', '5', '50', '2019-08-01 14:42:04', 'admin');
INSERT INTO `tp_shoufei` VALUES ('20', '15', '6', '100', '2019-08-01 14:43:56', 'admin');
INSERT INTO `tp_shoufei` VALUES ('21', '16', '5', '50', '2019-08-01 16:56:32', 'admin');
INSERT INTO `tp_shoufei` VALUES ('22', '14', '2', '30', '2019-08-04 11:10:45', 'admin');
INSERT INTO `tp_shoufei` VALUES ('23', '17', '5', '50', '2019-08-07 16:12:33', 'admin');
INSERT INTO `tp_shoufei` VALUES ('24', '16', '6', '100', '2019-08-08 16:46:20', 'admin');
INSERT INTO `tp_shoufei` VALUES ('25', '88888', '1', '576', '2019-08-15 15:24:06', 'admin');

-- ----------------------------
-- Table structure for tp_svip
-- ----------------------------
DROP TABLE IF EXISTS `tp_svip`;
CREATE TABLE `tp_svip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dizhi` varchar(20) NOT NULL COMMENT '门牌号',
  `phone` varchar(11) NOT NULL COMMENT '电话号码',
  `chepai` varchar(9) NOT NULL COMMENT '车牌号',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='临时停车信息';

-- ----------------------------
-- Records of tp_svip
-- ----------------------------
INSERT INTO `tp_svip` VALUES ('1', 'A区-2单元-12楼-1201', '18108291969', '川A.12345');
INSERT INTO `tp_svip` VALUES ('2', 'A区--12楼-1202', '18108291969', '川A.19612');
INSERT INTO `tp_svip` VALUES ('3', 'A区-1单元-12楼-1201', '18108291969', '川A.18L18');
INSERT INTO `tp_svip` VALUES ('4', 'C区-1单元-12楼-1201', '18233127065', '川A.ASD12');

-- ----------------------------
-- Table structure for tp_type
-- ----------------------------
DROP TABLE IF EXISTS `tp_type`;
CREATE TABLE `tp_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL COMMENT '区域',
  `pid` int(5) NOT NULL DEFAULT '0' COMMENT '父级区域',
  `paty` varchar(15) NOT NULL DEFAULT '0,' COMMENT '路径',
  `listorder` int(5) NOT NULL DEFAULT '0' COMMENT '排序',
  `status` int(1) NOT NULL DEFAULT '0' COMMENT '状态 0=》使用 1=》停用',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=153 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_type
-- ----------------------------
INSERT INTO `tp_type` VALUES ('112', 'B区', '0', '0,', '0', '0');
INSERT INTO `tp_type` VALUES ('113', 'C区', '0', '0,', '0', '0');
INSERT INTO `tp_type` VALUES ('126', '1单元', '112', '0,112,', '0', '0');
INSERT INTO `tp_type` VALUES ('127', '2单元', '112', '0,112,', '0', '0');
INSERT INTO `tp_type` VALUES ('128', 'B区-1单元-1', '126', '0,112,126,', '0', '0');
INSERT INTO `tp_type` VALUES ('129', 'B区-1单元-2', '126', '0,112,126,', '0', '0');
INSERT INTO `tp_type` VALUES ('130', 'B区-1单元-3', '126', '0,112,126,', '0', '0');
INSERT INTO `tp_type` VALUES ('131', 'B区-2单元-1', '127', '0,112,127,', '0', '0');
INSERT INTO `tp_type` VALUES ('132', 'B区-2单元-2', '127', '0,112,127,', '0', '0');
INSERT INTO `tp_type` VALUES ('133', '1单元', '113', '0,113,', '0', '0');
INSERT INTO `tp_type` VALUES ('134', '2单元', '113', '0,113,', '0', '0');
INSERT INTO `tp_type` VALUES ('135', '3单元', '113', '0,113,', '0', '0');
INSERT INTO `tp_type` VALUES ('136', 'C区-1单元-1', '133', '0,113,133,', '0', '0');
INSERT INTO `tp_type` VALUES ('137', 'C区-1单元-2', '133', '0,113,133,', '0', '0');
INSERT INTO `tp_type` VALUES ('138', 'C区-1单元-3', '133', '0,113,133,', '0', '0');
INSERT INTO `tp_type` VALUES ('139', 'C区-1单元-4', '133', '0,113,133,', '0', '0');
INSERT INTO `tp_type` VALUES ('140', 'C区-1单元-5', '133', '0,113,133,', '0', '0');
INSERT INTO `tp_type` VALUES ('141', 'C区-1单元-6', '133', '0,113,133,', '0', '0');
INSERT INTO `tp_type` VALUES ('142', 'C区-2单元-1', '134', '0,113,134,', '0', '0');
INSERT INTO `tp_type` VALUES ('143', 'C区-2单元-2', '134', '0,113,134,', '0', '0');
INSERT INTO `tp_type` VALUES ('144', 'C区-2单元-3', '134', '0,113,134,', '0', '0');
INSERT INTO `tp_type` VALUES ('145', 'C区-2单元-4', '134', '0,113,134,', '0', '0');
INSERT INTO `tp_type` VALUES ('146', 'C区-2单元-5', '134', '0,113,134,', '0', '0');
INSERT INTO `tp_type` VALUES ('147', 'C区-3单元-1', '135', '0,113,135,', '0', '0');
INSERT INTO `tp_type` VALUES ('148', 'C区-3单元-2', '135', '0,113,135,', '0', '0');
INSERT INTO `tp_type` VALUES ('149', 'A区', '0', '0,', '0', '0');
INSERT INTO `tp_type` VALUES ('150', '1单元', '149', '0,149,', '0', '0');
INSERT INTO `tp_type` VALUES ('151', 'D区', '0', '0,', '0', '0');
INSERT INTO `tp_type` VALUES ('152', 'ADC区', '0', '0,', '0', '0');

-- ----------------------------
-- Table structure for tp_user
-- ----------------------------
DROP TABLE IF EXISTS `tp_user`;
CREATE TABLE `tp_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(20) NOT NULL COMMENT '用户名',
  `pwd` char(32) NOT NULL COMMENT '密码',
  `jinyong` int(2) NOT NULL DEFAULT '0' COMMENT '是否禁用 0=》使用 1=》禁用',
  `quanxian` int(2) NOT NULL DEFAULT '0' COMMENT '权限 0=》仅浏览 1=》普通管理员 2=》超级管理员',
  `zhuche` varchar(30) NOT NULL COMMENT '注册时间',
  `xingming` varchar(20) DEFAULT NULL COMMENT '姓名',
  `phone` varchar(15) DEFAULT NULL COMMENT '电话',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of tp_user
-- ----------------------------
INSERT INTO `tp_user` VALUES ('1', 'admin', 'e10adc3949ba59abbe56e057f20f883e', '0', '2', '2019-07-15 17:40:34', '萨达省', '18108291969');
INSERT INTO `tp_user` VALUES ('2', 'admin1', 'e10adc3949ba59abbe56e057f20f883e', '0', '2', '2019-07-15 17:40:34', '萨达省', '18108291969');
INSERT INTO `tp_user` VALUES ('3', 'admin2', 'e10adc3949ba59abbe56e057f20f883e', '0', '1', '2019-07-15 17:40:34', '', '');
INSERT INTO `tp_user` VALUES ('4', 'admin3', 'e10adc3949ba59abbe56e057f20f883e', '1', '0', '2019-07-15 17:40:34', null, null);
INSERT INTO `tp_user` VALUES ('17', '啊大叔大叔', '5d7512da60e0135c2edfaa9aaa405afc', '0', '1', '2019-07-16 19:28:26', 'xioux', '18108291966');
INSERT INTO `tp_user` VALUES ('18', '按时打算撒旦', 'e10adc3949ba59abbe56e057f20f883e', '0', '2', '2019-07-17 16:49:31', '商务大厦', '18108291969');
INSERT INTO `tp_user` VALUES ('19', 'sssdm', 'e10adc3949ba59abbe56e057f20f883e', '0', '2', '2019-08-06 10:18:36', '萨达', '18108291969');
INSERT INTO `tp_user` VALUES ('20', 'sssdm1', 'e10adc3949ba59abbe56e057f20f883e', '0', '0', '2019-08-08 14:13:27', '爱仕达', '18108291969');
INSERT INTO `tp_user` VALUES ('23', 'xiouer1', 'e10adc3949ba59abbe56e057f20f883e', '0', '0', '2019-08-08 16:33:19', 'sadas ', '18108291969');

-- ----------------------------
-- Table structure for tp_user_role
-- ----------------------------
DROP TABLE IF EXISTS `tp_user_role`;
CREATE TABLE `tp_user_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '管理员id',
  `rid` int(11) NOT NULL COMMENT '对应角色id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='用户权限表';

-- ----------------------------
-- Records of tp_user_role
-- ----------------------------
INSERT INTO `tp_user_role` VALUES ('1', '20', '9');
INSERT INTO `tp_user_role` VALUES ('2', '1', '9');
INSERT INTO `tp_user_role` VALUES ('3', '2', '10');
INSERT INTO `tp_user_role` VALUES ('4', '23', '10');

-- ----------------------------
-- Table structure for tp_vip
-- ----------------------------
DROP TABLE IF EXISTS `tp_vip`;
CREATE TABLE `tp_vip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(15) NOT NULL COMMENT '住户名',
  `phone` varchar(11) NOT NULL COMMENT '电话号码',
  `chepai` varchar(9) DEFAULT NULL COMMENT '车牌',
  `ruzhudate` varchar(20) NOT NULL COMMENT '入住时间',
  `dizhi` varchar(20) NOT NULL COMMENT '门牌号',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COMMENT='车位住户信息';

-- ----------------------------
-- Records of tp_vip
-- ----------------------------
INSERT INTO `tp_vip` VALUES ('14', '龙儿', '18108291966', '川A.19818', '2019-05-29 13:53:22', 'A区-1单元-11楼-1101');
INSERT INTO `tp_vip` VALUES ('15', 'xiouer', '18108291966', '川A.19817', '2019-03-29 13:53:22', 'B区-1单元-12楼-1202');
INSERT INTO `tp_vip` VALUES ('16', 'assad', '18108291966', '', '2018-07-29 13:53:22', 'C区-2单元-13楼-1301');
INSERT INTO `tp_vip` VALUES ('17', '秀儿', '18108291969', '', '2019-07-29 13:53:22', 'C区-1单元-13楼-1301');

-- ----------------------------
-- Table structure for tp_xiangmu
-- ----------------------------
DROP TABLE IF EXISTS `tp_xiangmu`;
CREATE TABLE `tp_xiangmu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL COMMENT '收费项目名',
  `danjia` varchar(5) NOT NULL COMMENT '收费价格',
  `danwei` varchar(20) NOT NULL COMMENT '单位',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='收费项目信息';

-- ----------------------------
-- Records of tp_xiangmu
-- ----------------------------
INSERT INTO `tp_xiangmu` VALUES ('1', '零时停车', '3', '小时');
INSERT INTO `tp_xiangmu` VALUES ('2', '水费', '15', '吨');
INSERT INTO `tp_xiangmu` VALUES ('3', '小区停车', '450', '月');
INSERT INTO `tp_xiangmu` VALUES ('4', '电费', '1.75', '度');
INSERT INTO `tp_xiangmu` VALUES ('5', '垃圾管理费', '50', '月');
INSERT INTO `tp_xiangmu` VALUES ('6', '物业管理费', '100', '月');
INSERT INTO `tp_xiangmu` VALUES ('7', '杂项-电灯维修', '0', '次');
INSERT INTO `tp_xiangmu` VALUES ('8', '杂项-水电维修', '0', '次');

-- ----------------------------
-- Table structure for tp_xingxi
-- ----------------------------
DROP TABLE IF EXISTS `tp_xingxi`;
CREATE TABLE `tp_xingxi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `chepai` varchar(9) NOT NULL COMMENT '车牌号',
  `chewei_id` int(11) DEFAULT NULL COMMENT '关联车位管理表ID',
  `rudata` varchar(20) NOT NULL COMMENT '入场时间',
  `chudata` varchar(20) DEFAULT NULL COMMENT '出场时间',
  `qian` int(1) NOT NULL DEFAULT '0' COMMENT '缴费状态 0=》未缴费 1=》已缴费',
  `jiaofei` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8 COMMENT='车辆出入信息';

-- ----------------------------
-- Records of tp_xingxi
-- ----------------------------
INSERT INTO `tp_xingxi` VALUES ('28', '川A.12345', '33', '2019-07-29 11:54:26', null, '1', '0');
INSERT INTO `tp_xingxi` VALUES ('29', '川A.12345', '33', '2019-07-29 11:56:23', null, '1', '0');
INSERT INTO `tp_xingxi` VALUES ('30', '川A.12345', '34', '2019-07-29 11:57:39', null, '1', '0');
INSERT INTO `tp_xingxi` VALUES ('31', '川A.12345', '34', '2019-07-29 13:52:57', null, '1', '0');
INSERT INTO `tp_xingxi` VALUES ('32', '川A.12345', '36', '2019-07-29 13:53:22', null, '1', '0');
INSERT INTO `tp_xingxi` VALUES ('33', '川A.12345', '37', '2019-07-29 13:58:53', null, '1', '0');
INSERT INTO `tp_xingxi` VALUES ('34', '川A.12345', '40', '2019-07-29 14:00:34', null, '1', '0');
INSERT INTO `tp_xingxi` VALUES ('35', '川A.12345', '40', '2019-07-29 14:01:53', null, '1', '0');
INSERT INTO `tp_xingxi` VALUES ('36', '川A.12345', '40', '2019-07-29 14:02:49', null, '1', '0');
INSERT INTO `tp_xingxi` VALUES ('37', '川A.12345', '41', '2019-07-29 12:19:57', '2019-07-29 15:55:21', '1', '0');
INSERT INTO `tp_xingxi` VALUES ('38', '川A.19818', '42', '2019-07-29 14:25:53', '2019-07-29 14:34:15', '1', '1');
INSERT INTO `tp_xingxi` VALUES ('39', '川A.12345', '42', '2019-07-29 12:58:58', '2019-07-30 20:05:50', '1', '0');
INSERT INTO `tp_xingxi` VALUES ('40', '川A.12345', '41', '2019-07-30 11:06:27', '2019-07-30 20:06:56', '1', '0');
INSERT INTO `tp_xingxi` VALUES ('41', '川A.12345', '41', '2019-07-30 10:07:44', '2019-07-30 20:08:24', '1', '0');
INSERT INTO `tp_xingxi` VALUES ('42', '川A.12345', '41', '2019-07-30 10:10:11', '2019-07-30 20:10:44', '1', '0');
INSERT INTO `tp_xingxi` VALUES ('43', '川A.12345', '47', '2019-07-30 10:11:49', '2019-07-30 20:12:23', '1', '0');
INSERT INTO `tp_xingxi` VALUES ('44', '川A.12345', '55', '2019-07-30 10:13:10', '2019-07-30 20:13:37', '1', '0');
INSERT INTO `tp_xingxi` VALUES ('45', '川A.12345', '41', '2019-07-30 11:01:50', '2019-07-30 21:02:10', '1', '0');
INSERT INTO `tp_xingxi` VALUES ('46', '川A.12345', '41', '2019-07-31 10:19:15', '2019-07-31 14:19:44', '1', '0');
INSERT INTO `tp_xingxi` VALUES ('47', '川A.19612', '41', '2019-08-07 15:53:19', '2019-08-15 15:23:51', '1', '0');
INSERT INTO `tp_xingxi` VALUES ('48', '川A.18L18', '48', '2019-08-08 16:43:37', '2019-08-08 16:44:16', '0', '0');
INSERT INTO `tp_xingxi` VALUES ('49', '川A.19818', '42', '2019-08-09 14:27:09', '2019-08-09 14:27:25', '1', '1');
INSERT INTO `tp_xingxi` VALUES ('50', '川A.19818', '42', '2019-08-14 15:39:29', null, '0', '1');
INSERT INTO `tp_xingxi` VALUES ('51', '川A.ASD12', '43', '2019-08-15 08:45:08', null, '0', '0');
INSERT INTO `tp_xingxi` VALUES ('52', '川A.19612', '41', '2019-08-15 15:24:21', '2019-08-15 16:15:55', '0', '0');
