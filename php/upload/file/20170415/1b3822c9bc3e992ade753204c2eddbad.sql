/*
Navicat MySQL Data Transfer

Source Server         : ys
Source Server Version : 50540
Source Host           : localhost:3306
Source Database       : simu

Target Server Type    : MYSQL
Target Server Version : 50540
File Encoding         : 65001

Date: 2017-04-15 11:03:27
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for ys_applygroup
-- ----------------------------
DROP TABLE IF EXISTS `ys_applygroup`;
CREATE TABLE `ys_applygroup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `apply_uid` int(11) NOT NULL COMMENT '申请人用户id',
  `apply_uname` varchar(155) NOT NULL COMMENT '申请人用户名',
  `group_id` int(11) NOT NULL COMMENT '申请加入的群组',
  `owner_id` int(11) NOT NULL COMMENT '该群组的管理员id',
  `remark` varchar(255) NOT NULL COMMENT '加群附加信息',
  `addtime` int(10) NOT NULL COMMENT '申请时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ys_applygroup
-- ----------------------------

-- ----------------------------
-- Table structure for ys_article
-- ----------------------------
DROP TABLE IF EXISTS `ys_article`;
CREATE TABLE `ys_article` (
  `articleid` int(11) NOT NULL AUTO_INCREMENT COMMENT '文档ID',
  `uid` int(11) NOT NULL DEFAULT '0' COMMENT '对应作者ID',
  `createtime` int(11) DEFAULT '0' COMMENT '创建时间',
  `updatetime` int(11) DEFAULT '0' COMMENT '修改时间',
  `content` text COMMENT '正文',
  `title` varchar(255) DEFAULT '' COMMENT '标题',
  `description` text COMMENT '概述',
  `status` tinyint(1) DEFAULT '1' COMMENT '文章状态0删除 1发布 2审核中',
  `litpic` varchar(255) DEFAULT '' COMMENT '文章缩略图',
  `level` bigint(20) DEFAULT '0' COMMENT '排序',
  `type` tinyint(1) DEFAULT '1' COMMENT '文章类型（单页 0 post 普通 1page等）',
  `comment` int(11) DEFAULT '0' COMMENT '评论总数',
  `view` int(11) DEFAULT '0' COMMENT '文章浏览量',
  `isdel` tinyint(1) DEFAULT '0' COMMENT '逻辑删除字段，默认0不删除，1已删除',
  `navpid` int(11) DEFAULT '0' COMMENT '栏目父id',
  `navid` int(11) DEFAULT '0' COMMENT '栏目id',
  `thumbcount` int(11) DEFAULT '0' COMMENT '点赞次数',
  `isthumb` tinyint(1) DEFAULT '0' COMMENT '是否点赞1是0否',
  `free` varchar(255) DEFAULT NULL COMMENT '0所有人可见，1会员可见',
  `begintime` int(11) DEFAULT '1491819393' COMMENT '开始时间',
  `endtime` int(11) DEFAULT '1491819393' COMMENT '结束时间',
  `tel` varchar(11) DEFAULT '' COMMENT '手机号',
  PRIMARY KEY (`articleid`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=utf8 COMMENT='文章类';

-- ----------------------------
-- Records of ys_article
-- ----------------------------
INSERT INTO `ys_article` VALUES ('1', '1', '1491635366', '1491635366', '0', '毕业两年年入百万，他靠微信人脉做到了', '', '1', '/php/public/images/logo_03.png', '0', '1', '22', '11', '0', '1', '31', '22', '1', null, '0', '0', '');
INSERT INTO `ys_article` VALUES ('2', '2', '1491635366', '1491635366', '1', '理财|中国租房日本买3套房，我社怎么想的', '0', '1', '/php/public/images/logo_03.png', '0', '1', '22', '11', '0', '1', '31', '22', '1', null, '0', '0', '');
INSERT INTO `ys_article` VALUES ('3', '3', '1491635366', '1491635366', '2', 'loser才爱吃糖，亲爱的咱能别送甜食吗', '0', '1', '/php/public/images/logo_03.png', '0', '1', '22', '11', '0', '1', '31', '22', '1', null, '0', '0', '');
INSERT INTO `ys_article` VALUES ('4', '4', '1491635366', '1491635366', '3', '摆脱烂文笔，4个锦囊教你写出好文阿航', '0', '1', '/php/public/images/logo_06.png', '0', '1', '22', '11', '0', '1', '31', '22', '1', null, '0', '0', '');
INSERT INTO `ys_article` VALUES ('5', '5', '1491635366', '1491635366', '5', '工薪族抗通胀理财手册（外汇篇）', '的发生大法师大发', '1', '/php/public/images/logo_17.png', '0', '1', '1111', '11', '0', '1', '31', '22', '1', null, '0', '0', '');
INSERT INTO `ys_article` VALUES ('6', '1', '1491635366', '1491635366', 'asdfasdfasdfasdfadfgsdfgsdfgsdfgs', '奥颜值减肥实战手册该快收货钱钱钱', null, '1', '/php/public/images/logo_18.png', '0', '1', '1111', '11', '0', '1', '31', '22', '0', null, '0', '0', '');
INSERT INTO `ys_article` VALUES ('7', '1', '1491635366', '1491635366', 'asdfasdfasdfasdfadfgsdfgsdfgsdfgs', '奥颜值减肥实战手册该快收货钱钱钱', null, '1', '/php/public/images/logo_05.png', '0', '1', '1111', '11', '0', '1', '31', '22', '0', null, '0', '0', '');
INSERT INTO `ys_article` VALUES ('8', '1', '1491635366', '1491635366', 'asdfasdfasdfasdfadfgsdfgsdfgsdfgs', '工薪族抗通胀理财手册（外汇篇）', null, '1', '/php/public/images/logo_07.png', '0', '1', '44', '111', '0', '1', '31', '22', '0', null, '0', '0', '');
INSERT INTO `ys_article` VALUES ('9', '1', '1491635366', '1491635366', 'asdfasdfasdfasdfadfgsdfgsdfgsdfgs', '工薪族抗通胀理财手册（外汇篇）', null, '1', '/php/public/images/logo_15.png', '0', '1', '55', '11', '0', '1', '31', '22', '0', null, '0', '0', '');
INSERT INTO `ys_article` VALUES ('10', '1', '1491635366', '1491635366', '希望大家给20岁的年轻人建议', '有哪些建议可以送给20岁的年轻人', '', '1', '/php/public/images/logo_15.png', '0', '1', '55', '11', '0', '2', '38', '22', '0', null, '0', '0', '');
INSERT INTO `ys_article` VALUES ('11', '1', '1491635366', '1491635366', ' Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\n                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\n                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\n                        consequat.\r\n                         Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\n                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\n                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\n                        consequat.\r\n                         Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\n                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\n                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\n                        consequat.', '领客说第49期：如何快速提高企业业绩管理课程？', '', '1', '/php/public/images/aaaa_03.png', '0', '1', '55', '11', '0', '2', '39', '22', '0', null, '0', '0', '');
INSERT INTO `ys_article` VALUES ('12', '1', '1491635366', '1491635366', ' Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\n                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\n                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\n                        consequat.\r\n                         Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\n                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\n                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\n                        consequat.\r\n                         Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\n                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\n                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\n                        consequat.', '领客说第49期：如何快速提高企业业绩管理课程？', '', '1', '/php/public/images/aaaa_03.png', '0', '1', '55', '11', '0', '2', '39', '22', '0', null, '0', '0', '');
INSERT INTO `ys_article` VALUES ('13', '1', '1491635366', '1491635366', ' Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\n                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\n                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\n                        consequat.\r\n                         Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\n                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\n                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\n                        consequat.\r\n                         Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\n                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\n                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\n                        consequat.', '领客说第49期：如何快速提高企业业绩管理课程？', '', '1', '/php/public/images/aaaa_03.png', '0', '1', '55', '11', '0', '2', '39', '22', '0', null, '0', '0', '');
INSERT INTO `ys_article` VALUES ('14', '1', '1491635366', '1491635366', '德培利商务服务有限公司现诚挚的邀请各行业与我司商务合作。我司不仅提供办公室租凭服务，还提供空间配套服务，在广州共有六家网点.德培利商务服务有限公司现诚挚的邀请各行业与我司商务合作。我司不仅提供办公室租凭服务，还提供空间配套服务，在广州共有六家网点', '车载WIFI，包年298起，联通网络，全国通用，无限流量', '', '1', '/php/public/images/aaaa_03.png', '0', '1', '55', '11', '0', '2', '38', '22', '0', null, '0', '0', '');
INSERT INTO `ys_article` VALUES ('15', '1', '1491635366', '1491635366', '德培利商务服务有限公司现诚挚的邀请各行业与我司商务合作。我司不仅提供办公室租凭服务，还提供空间配套服务，在广州共有六家网点.德培利商务服务有限公司现诚挚的邀请各行业与我司商务合作。我司不仅提供办公室租凭服务，还提供空间配套服务，在广州共有六家网点', '啊是的发生大法师大冯阿斯顿发全文去', '', '1', '/php/public/images/aaaa_03.png', '0', '1', '55', '11', '0', '2', '38', '22', '0', null, '0', '0', '');
INSERT INTO `ys_article` VALUES ('16', '1', '1491635366', '1491635366', '德培利商务服务有限公司现诚挚的邀请各行业与我司商务合作。我司不仅提供办公室租凭服务，还提供空间配套服务，在广州共有六家网点.德培利商务服务有限公司现诚挚的邀请各行业与我司商务合作。我司不仅提供办公室租凭服务，还提供空间配套服务，在广州共有六家网点', '领客说第49期：如何快速提高企业业绩管理课程？', '', '1', '/php/public/images/aaaa_03.png', '0', '1', '55', '11', '0', '2', '38', '22', '0', null, '0', '0', '');
INSERT INTO `ys_article` VALUES ('17', '1', '1491635366', '1491635366', '0', '毕业两年年入百万，他靠微信人脉做到了', '', '1', '/php/public/images/logo_03.png', '0', '1', '22', '11', '0', '1', '32', '22', '1', null, '0', '0', '');
INSERT INTO `ys_article` VALUES ('18', '2', '1491635366', '1491635366', '1', '理财|中国租房日本买3套房，我社怎么想的', '0', '1', '/php/public/images/logo_03.png', '0', '1', '22', '11', '0', '1', '32', '22', '1', null, '0', '0', '');
INSERT INTO `ys_article` VALUES ('19', '3', '1491635366', '1491635366', '2', 'loser才爱吃糖，亲爱的咱能别送甜食吗', '0', '1', '/php/public/images/logo_03.png', '0', '1', '22', '11', '0', '1', '32', '22', '1', null, '0', '0', '');
INSERT INTO `ys_article` VALUES ('20', '4', '1491635366', '1491635366', '3', '摆脱烂文笔，4个锦囊教你写出好文阿航', '0', '1', '/php/public/images/logo_06.png', '0', '1', '22', '11', '0', '1', '32', '22', '1', null, '0', '0', '');
INSERT INTO `ys_article` VALUES ('21', '5', '1491635366', '1491635366', '5', '工薪族抗通胀理财手册（外汇篇）', '的发生大法师大发', '1', '/php/public/images/logo_17.png', '0', '1', '1111', '11', '0', '1', '32', '22', '1', null, '0', '0', '');
INSERT INTO `ys_article` VALUES ('22', '1', '1491635366', '1491635366', 'asdfasdfasdfasdfadfgsdfgsdfgsdfgs', '奥颜值减肥实战手册该快收货钱钱钱', '', '1', '/php/public/images/logo_18.png', '0', '1', '1111', '11', '0', '1', '32', '22', '0', null, '0', '0', '');
INSERT INTO `ys_article` VALUES ('23', '1', '1491635366', '1491635366', 'asdfasdfasdfasdfadfgsdfgsdfgsdfgs', '奥颜值减肥实战手册该快收货钱钱钱', '', '1', '/php/public/images/logo_05.png', '0', '1', '1111', '11', '0', '1', '32', '22', '0', null, '0', '0', '');
INSERT INTO `ys_article` VALUES ('24', '1', '1491635366', '1491635366', 'asdfasdfasdfasdfadfgsdfgsdfgsdfgs', '工薪族抗通胀理财手册（外汇篇）', '', '1', '/php/public/images/logo_07.png', '0', '1', '44', '111', '0', '1', '32', '22', '0', null, '0', '0', '');
INSERT INTO `ys_article` VALUES ('25', '1', '1491635366', '1491635366', 'asdfasdfasdfasdfadfgsdfgsdfgsdfgs', '工薪族抗通胀理财手册（外汇篇）', '', '1', '/php/public/images/logo_15.png', '0', '1', '55', '11', '0', '1', '32', '22', '0', null, '0', '0', '');
INSERT INTO `ys_article` VALUES ('26', '1', '1491635366', '1491635366', '0', '毕业两年年入百万，他靠微信人脉做到了', '', '1', '/php/public/images/logo_03.png', '0', '1', '22', '11', '0', '1', '32', '22', '1', null, '0', '0', '');
INSERT INTO `ys_article` VALUES ('27', '2', '1491635366', '1491635366', '1', '理财|中国租房日本买3套房，我社怎么想的', '0', '1', '/php/public/images/logo_03.png', '0', '1', '22', '11', '0', '1', '37', '22', '1', null, '0', '0', '');
INSERT INTO `ys_article` VALUES ('28', '3', '1491635366', '1491635366', '2', 'loser才爱吃糖，亲爱的咱能别送甜食吗', '0', '1', '/php/public/images/logo_03.png', '0', '1', '22', '11', '0', '1', '37', '22', '1', null, '0', '0', '');
INSERT INTO `ys_article` VALUES ('29', '4', '1491635366', '1491635366', '3', '摆脱烂文笔，4个锦囊教你写出好文阿航', '0', '1', '/php/public/images/logo_06.png', '0', '1', '22', '11', '0', '1', '37', '22', '1', null, '0', '0', '');
INSERT INTO `ys_article` VALUES ('30', '5', '1491635366', '1491635366', '5', '工薪族抗通胀理财手册（外汇篇）', '的发生大法师大发', '1', '/php/public/images/logo_17.png', '0', '1', '1111', '11', '0', '1', '37', '22', '1', null, '0', '0', '');
INSERT INTO `ys_article` VALUES ('31', '1', '1491635366', '1491635366', 'asdfasdfasdfasdfadfgsdfgsdfgsdfgs', '奥颜值减肥实战手册该快收货钱钱钱', '', '1', '/php/public/images/logo_18.png', '0', '1', '1111', '11', '0', '1', '37', '22', '0', null, '0', '0', '');
INSERT INTO `ys_article` VALUES ('32', '1', '1491635366', '1491635366', 'asdfasdfasdfasdfadfgsdfgsdfgsdfgs', '奥颜值减肥实战手册该快收货钱钱钱', '', '1', '/php/public/images/logo_05.png', '0', '1', '1111', '11', '0', '1', '37', '22', '0', null, '0', '0', '');
INSERT INTO `ys_article` VALUES ('33', '1', '1491635366', '1491635366', 'asdfasdfasdfasdfadfgsdfgsdfgsdfgs', '工薪族抗通胀理财手册（外汇篇）', '', '1', '/php/public/images/logo_07.png', '0', '1', '44', '111', '0', '1', '37', '22', '0', null, '0', '0', '');
INSERT INTO `ys_article` VALUES ('34', '1', '1491635366', '1491635366', 'asdfasdfasdfasdfadfgsdfgsdfgsdfgs', '工薪族抗通胀理财手册（外汇篇）', '', '1', '/php/public/images/logo_15.png', '0', '1', '55', '11', '0', '1', '37', '22', '0', null, '0', '0', '');
INSERT INTO `ys_article` VALUES ('35', '1', '1491907920', '0', '林大帅来了林大帅来了林大帅来了林大帅来了林大帅来了林大帅来了林大帅来了林大帅来了林大帅来了林大帅来了林大帅来了林大帅来了林大帅来了林大帅来了林大帅来了林大帅来了林大帅来了林大帅来了林大帅来了林大帅来了林大帅来了林大帅来了林大帅来了林大帅来了林大帅来了林大帅来了林大帅来了林大帅来了林大帅来了林大帅来了林大帅来了林大帅来了林大帅来了林大帅来了林大帅来了林大帅来了林大帅来了林大帅来了林大帅来了林大帅来了林大帅来了林大帅来了林大帅来了林大帅来了', '林大帅来了', null, '1', '', '0', '1', '0', '0', '0', '0', '31', '0', '0', null, '1491819393', '1491819393', '');
INSERT INTO `ys_article` VALUES ('36', '1', '1491907947', '0', '林大帅来了林大帅来了林大帅来了林大帅来了林大帅来了林大帅来了林大帅来了林大帅来了林大帅来了林大帅来了林大帅来了林大帅来了林大帅来了林大帅来了林大帅来了林大帅来了林大帅来了林大帅来了林大帅来了林大帅来了林大帅来了', '林大帅来了林大帅来了林大帅来了林大帅来了', null, '1', '', '0', '1', '0', '0', '0', '0', '32', '0', '0', null, '1491819393', '1491819393', '');
INSERT INTO `ys_article` VALUES ('37', '1', '1491908017', '0', '2222222222222222222222222222222222222222222222222222222222222222222222222222222', '111', null, '1', '', '0', '1', '0', '0', '0', '0', '32', '0', '0', null, '1491819393', '1491819393', '');
INSERT INTO `ys_article` VALUES ('38', '1', '1491908127', '0', '3333333333333333333333333333333333', '22222222222222', null, '1', '', '0', '1', '0', '0', '0', '0', '31', '0', '0', null, '1491819393', '1491819393', '');
INSERT INTO `ys_article` VALUES ('39', '1', '1491908202', '0', '综合需求综合需求综合需求综合需求综合需求综合需求综合需求综合需求综合需求综合需求', '综合需求', null, '1', '', '0', '1', '0', '0', '0', '0', '38', '0', '0', '0', '1491819393', '1491819393', '');
INSERT INTO `ys_article` VALUES ('40', '1', '1491908395', '0', '大神大神大神大神大神大神大神大神大神大神大神大神大神大神大神大神大神大神大神大神大神大神大神大神大神', '大神大神大神大神', null, '1', '', '0', '1', '0', '0', '0', '0', '38', '0', '0', '1', '1491819393', '1491819393', '');

-- ----------------------------
-- Table structure for ys_banner
-- ----------------------------
DROP TABLE IF EXISTS `ys_banner`;
CREATE TABLE `ys_banner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) NOT NULL DEFAULT '' COMMENT '广告名称',
  `description` varchar(255) NOT NULL DEFAULT '' COMMENT '广告位置描述',
  `position` tinyint(1) NOT NULL DEFAULT '0' COMMENT '广告位置',
  `imgurl` varchar(255) NOT NULL DEFAULT '' COMMENT '图片地址',
  `link` varchar(255) NOT NULL DEFAULT '' COMMENT '连接地址',
  `level` tinyint(1) NOT NULL DEFAULT '0' COMMENT '优先级',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态（0：禁用 1：正常）',
  `createtime` int(11) DEFAULT '0' COMMENT '创建时间',
  `updatetime` int(11) DEFAULT '0' COMMENT '修改时间',
  `isdel` tinyint(1) DEFAULT '0' COMMENT '逻辑删除字段，默认0不删除，1已经删除',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='轮播';

-- ----------------------------
-- Records of ys_banner
-- ----------------------------
INSERT INTO `ys_banner` VALUES ('1', 'banner图1', 'banner图1', '1', '/php/public/images/轮播图_02.png', '#', '1', '1', '1491634440', '1491634440', '0');
INSERT INTO `ys_banner` VALUES ('2', 'banner图2', 'banner图2', '2', '/php/public/images/轮播图_02.png', '#', '1', '1', '1491634440', '1491634440', '0');
INSERT INTO `ys_banner` VALUES ('3', 'banner图3', 'banner图3', '3', '/php/public/images/轮播图_02.png', '#', '1', '1', '1491634440', '1491634440', '0');
INSERT INTO `ys_banner` VALUES ('4', '推荐商品', '推荐商品', '4', '/php/public/images/轮播图_02.png', '#', '1', '1', '1491634440', '1491634440', '0');
INSERT INTO `ys_banner` VALUES ('5', '首页广告图', '首页广告图', '5', '/php/public/images/轮播图_02.png', '#', '1', '1', '1491634440', '1491634440', '0');
INSERT INTO `ys_banner` VALUES ('6', '单页广告', '单页广告', '6', '/php/public/images/轮播图_02.png', '#', '1', '1', '1491634440', '1491634440', '0');

-- ----------------------------
-- Table structure for ys_baseconf
-- ----------------------------
DROP TABLE IF EXISTS `ys_baseconf`;
CREATE TABLE `ys_baseconf` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '公司名',
  `key` varchar(255) DEFAULT '' COMMENT '配置项名称',
  `value` varchar(255) DEFAULT '' COMMENT '配置项值',
  `description` text COMMENT '配置描述',
  `isdel` tinyint(1) DEFAULT '0' COMMENT '逻辑删除字段，默认0不删除，1已删除',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='基本配置';

-- ----------------------------
-- Records of ys_baseconf
-- ----------------------------
INSERT INTO `ys_baseconf` VALUES ('2', 'coltd_price', '会员价格 ', '￥1998.00元', '0');
INSERT INTO `ys_baseconf` VALUES ('4', 'coltd_help', '帮助中心 ', '终端内部手机号撒旦法师打发手动阀', '0');
INSERT INTO `ys_baseconf` VALUES ('5', 'coltd_sevice', '服务协议 ', '易连云用户ID撒旦法师打发手动阀', '0');

-- ----------------------------
-- Table structure for ys_chat
-- ----------------------------
DROP TABLE IF EXISTS `ys_chat`;
CREATE TABLE `ys_chat` (
  `chatid` int(11) NOT NULL AUTO_INCREMENT COMMENT '聊天记录id',
  `content` text NOT NULL COMMENT '内容',
  `status` tinyint(1) DEFAULT '1' COMMENT '状态，1正常显示，0不显示',
  `createtime` int(11) DEFAULT '0' COMMENT '创建时间',
  `updatetime` int(11) DEFAULT '0' COMMENT '修改时间',
  `isdel` tinyint(1) DEFAULT '0' COMMENT '逻辑删除字段，0不删除，1已删除',
  PRIMARY KEY (`chatid`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COMMENT='聊天';

-- ----------------------------
-- Records of ys_chat
-- ----------------------------
INSERT INTO `ys_chat` VALUES ('1', '零食', '1', '0', '0', '0');
INSERT INTO `ys_chat` VALUES ('3', '水果', '1', '0', '0', '0');
INSERT INTO `ys_chat` VALUES ('5', '土特产品', '1', '0', '0', '0');
INSERT INTO `ys_chat` VALUES ('9', '大枣', '1', '0', '0', '5');
INSERT INTO `ys_chat` VALUES ('19', '干果', '1', '0', '0', '1');
INSERT INTO `ys_chat` VALUES ('20', '冬枣', '1', '0', '0', '3');
INSERT INTO `ys_chat` VALUES ('21', '鸡蛋', '1', '0', '0', '5');
INSERT INTO `ys_chat` VALUES ('22', '核桃仁', '1', '0', '0', '5');
INSERT INTO `ys_chat` VALUES ('23', '话梅', '1', '0', '0', '3');

-- ----------------------------
-- Table structure for ys_chatlog
-- ----------------------------
DROP TABLE IF EXISTS `ys_chatlog`;
CREATE TABLE `ys_chatlog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from_id` int(11) NOT NULL COMMENT '会话来源id',
  `from_name` varchar(155) NOT NULL DEFAULT '' COMMENT '消息来源用户名',
  `from_avatar` varchar(155) NOT NULL DEFAULT '' COMMENT '来源的用户头像',
  `to_id` int(11) NOT NULL COMMENT '会话发送的id',
  `content` text NOT NULL COMMENT '发送的内容',
  `timeline` int(10) NOT NULL COMMENT '记录时间',
  `type` varchar(55) NOT NULL COMMENT '聊天类型',
  `need_send` tinyint(1) DEFAULT '0' COMMENT '0 不需要推送 1 需要推送',
  PRIMARY KEY (`id`),
  KEY `fromid` (`from_id`) USING BTREE,
  KEY `toid` (`to_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=132 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ys_chatlog
-- ----------------------------
INSERT INTO `ys_chatlog` VALUES ('1', '2', '马云', 'http://tp4.sinaimg.cn/2145291155/180/5601307179/1', '1', '马云', '1489464327', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('2', '2', '马云', 'http://tp4.sinaimg.cn/2145291155/180/5601307179/1', '2', '我来了', '1489464327', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('3', '1', '纸飞机', 'http://tp1.sinaimg.cn/1241679004/180/5743814375/0', '2', '马云你好', '1489464327', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('4', '1', '纸飞机', '/uploads/20170113/7e3c0377e13f70055d646b881920f419.png', '1', '群组讨论', '1484812987', 'group', '1');
INSERT INTO `ys_chatlog` VALUES ('5', '1', '纸飞机', '/uploads/20170113/7e3c0377e13f70055d646b881920f419.png', '1', '你还能收到？', '1484812999', 'group', '1');
INSERT INTO `ys_chatlog` VALUES ('6', '2', '马云', 'http://tp4.sinaimg.cn/2145291155/180/5601307179/1', '1', '还是没退出', '1484813006', 'group', '1');
INSERT INTO `ys_chatlog` VALUES ('7', '1', '纸飞机', 'http://tp1.sinaimg.cn/1241679004/180/5743814375/0', '1', '这个样呢？', '1484813014', 'group', '1');
INSERT INTO `ys_chatlog` VALUES ('8', '1', '纸飞机', '/uploads/20170113/7e3c0377e13f70055d646b881920f419.png', '1', '马云你退出吧', '1484813366', 'group', '1');
INSERT INTO `ys_chatlog` VALUES ('9', '2', '马云', 'http://tp4.sinaimg.cn/2145291155/180/5601307179/1', '1', '为什么是我', '1484813372', 'group', '1');
INSERT INTO `ys_chatlog` VALUES ('10', '1', '纸飞机', '/uploads/20170113/7e3c0377e13f70055d646b881920f419.png', '1', '赶紧走', '1484813376', 'group', '1');
INSERT INTO `ys_chatlog` VALUES ('11', '1', '纸飞机', '/uploads/20170113/7e3c0377e13f70055d646b881920f419.png', '1', '孩子啊？', '1484813401', 'group', '1');
INSERT INTO `ys_chatlog` VALUES ('12', '2', '马云', 'http://tp4.sinaimg.cn/2145291155/180/5601307179/1', '1', '测试', '1484813457', 'group', '1');
INSERT INTO `ys_chatlog` VALUES ('13', '1', '纸飞机', '/uploads/20170113/7e3c0377e13f70055d646b881920f419.png', '1', '惹我', '1484813462', 'group', '1');
INSERT INTO `ys_chatlog` VALUES ('14', '1', '纸飞机', '/uploads/20170113/7e3c0377e13f70055d646b881920f419.png', '1', '发生的发生', '1484813471', 'group', '1');
INSERT INTO `ys_chatlog` VALUES ('15', '1', '纸飞机', '/uploads/20170113/7e3c0377e13f70055d646b881920f419.png', '1', '放水电费水电费', '1484813477', 'group', '1');
INSERT INTO `ys_chatlog` VALUES ('16', '2', '马云', 'http://tp4.sinaimg.cn/2145291155/180/5601307179/1', '1', '呵呵呵', '1484814415', 'group', '1');
INSERT INTO `ys_chatlog` VALUES ('17', '1', '纸飞机', '/uploads/20170113/7e3c0377e13f70055d646b881920f419.png', '1', '在拉', '1484814419', 'group', '1');
INSERT INTO `ys_chatlog` VALUES ('18', '2', '马云', 'http://tp4.sinaimg.cn/2145291155/180/5601307179/1', '1', '都在', '1484814451', 'group', '1');
INSERT INTO `ys_chatlog` VALUES ('19', '1', '纸飞机', '/uploads/20170113/7e3c0377e13f70055d646b881920f419.png', '1', '能收到？', '1484814458', 'group', '1');
INSERT INTO `ys_chatlog` VALUES ('20', '2', '马云', 'http://tp4.sinaimg.cn/2145291155/180/5601307179/1', '1', '怎么可能', '1484814467', 'group', '1');
INSERT INTO `ys_chatlog` VALUES ('21', '2', '马云', 'http://tp4.sinaimg.cn/2145291155/180/5601307179/1', '1', '在吗', '1484814928', 'group', '1');
INSERT INTO `ys_chatlog` VALUES ('22', '1', '纸飞机', '/uploads/20170113/7e3c0377e13f70055d646b881920f419.png', '1', '群里都阻碍讨论呢', '1484814936', 'group', '1');
INSERT INTO `ys_chatlog` VALUES ('23', '2', '马云', 'http://tp4.sinaimg.cn/2145291155/180/5601307179/1', '1', '打算的', '1484814993', 'group', '1');
INSERT INTO `ys_chatlog` VALUES ('24', '1', '纸飞机', '/uploads/20170113/7e3c0377e13f70055d646b881920f419.png', '1', '阿打算', '1484814996', 'group', '1');
INSERT INTO `ys_chatlog` VALUES ('25', '2', '马云', 'http://tp4.sinaimg.cn/2145291155/180/5601307179/1', '1', 'CAD是', '1484815040', 'group', '1');
INSERT INTO `ys_chatlog` VALUES ('26', '1', '纸飞机', '/uploads/20170113/7e3c0377e13f70055d646b881920f419.png', '1', '干什么呢', '1484815045', 'group', '1');
INSERT INTO `ys_chatlog` VALUES ('27', '1', '纸飞机', '/uploads/20170113/7e3c0377e13f70055d646b881920f419.png', '1', '能吗？', '1484815066', 'group', '1');
INSERT INTO `ys_chatlog` VALUES ('28', '1', '纸飞机', '/uploads/20170113/7e3c0377e13f70055d646b881920f419.png', '1', '擦出大的', '1484815096', 'group', '1');
INSERT INTO `ys_chatlog` VALUES ('29', '2', '马云', 'http://tp4.sinaimg.cn/2145291155/180/5601307179/1', '1', '发生的发生', '1484815103', 'group', '1');
INSERT INTO `ys_chatlog` VALUES ('30', '24', 'linxc', '/static/common/images/common.jpg', '23', '222', '1491560228', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('31', '24', 'linxc', '/static/common/images/common.jpg', '23', '222', '1491560303', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('32', '23', 'admin', '/static/common/images/common.jpg', '24', '223232312323123', '1491564529', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('33', '24', 'linxc', '/static/common/images/common.jpg', '23', '你好吗', '1491564544', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('34', '23', 'admin', '/static/common/images/common.jpg', '24', '啦啦啦', '1492075041', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('35', '23', 'admin', '/static/common/images/common.jpg', '24', '啦啦啦啦啦', '1492075054', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('36', '23', 'admin', '/static/common/images/common.jpg', '24', 'face[亲亲] ', '1492075677', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('37', '23', 'admin', '/static/common/images/common.jpg', '24', '22', '1492076126', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('38', '1', 'linxc', '/static/common/images/common.jpg', '2', '34', '1492076180', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('39', '0', '', '', '24', '2323', '1492141232', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('40', '0', '', '', '24', 'qweqeq', '1492141320', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('41', '0', '', '', '24', '000', '1492141518', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('42', '0', '', '', '24', '222', '1492141553', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('43', '0', '', '', '24', '2323', '1492141662', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('44', '0', '', '', '24', '222', '1492141773', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('45', '0', '', '', '24', '333', '1492141992', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('46', '0', '', '', '24', '22', '1492142144', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('47', '0', '', '', '23', '666', '1492142173', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('48', '0', '', '', '24', '222', '1492142321', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('49', '0', '', '', '24', '33', '1492142333', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('50', '0', '', '', '24', '23232323', '1492142590', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('51', '0', '', '', '24', '32554534', '1492142639', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('52', '0', '', '', '24', '3434', '1492142727', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('53', '0', '', '', '24', '33', '1492142795', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('54', '0', '', '', '23', '3', '1492142929', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('55', '0', '', '', '24', 'sss', '1492143047', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('56', '0', '', '', '23', '232', '1492143085', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('57', '0', '', '', '23', '11111', '1492151067', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('58', '0', '', '', '23', '444', '1492151287', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('59', '0', '', '', '24', '3323', '1492151412', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('60', '2', '船2', 'http://wx.qlogo.cn/mmopen/vDwntJFbiafvIMib1wrzzial5zHGeP3Xwy8nVFnLxkYUhdgVRgaH4J2JXnicWCZFQCO883nB7JiaGMp15kZ5qo9gchA/0', '1', '2', '1492161737', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('61', '1', '船2', 'http://wx.qlogo.cn/mmopen/vDwntJFbiafvIMib1wrzzial5zHGeP3Xwy8nVFnLxkYUhdgVRgaH4J2JXnicWCZFQCO883nB7JiaGMp15kZ5qo9gchA/0', '1', '222', '1492162497', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('62', '1', '船2', 'http://wx.qlogo.cn/mmopen/vDwntJFbiafvIMib1wrzzial5zHGeP3Xwy8nVFnLxkYUhdgVRgaH4J2JXnicWCZFQCO883nB7JiaGMp15kZ5qo9gchA/0', '1', '3', '1492162501', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('63', '1', '船2', 'http://wx.qlogo.cn/mmopen/vDwntJFbiafvIMib1wrzzial5zHGeP3Xwy8nVFnLxkYUhdgVRgaH4J2JXnicWCZFQCO883nB7JiaGMp15kZ5qo9gchA/0', '1', '你好', '1492162565', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('64', '2', '马云', 'http://wx.qlogo.cn/mmopen/vDwntJFbiafvIMib1wrzzial5zHGeP3Xwy8nVFnLxkYUhdgVRgaH4J2JXnicWCZFQCO883nB7JiaGMp15kZ5qo9gchA/0', '2', '4', '1492162932', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('65', '2', '马云', 'http://wx.qlogo.cn/mmopen/vDwntJFbiafvIMib1wrzzial5zHGeP3Xwy8nVFnLxkYUhdgVRgaH4J2JXnicWCZFQCO883nB7JiaGMp15kZ5qo9gchA/0', '2', '2', '1492163005', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('66', '0', '', '', '2', '4', '1492163207', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('67', '0', '', '', '2', '4', '1492163376', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('68', '0', '', '', '2', '4', '1492163450', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('69', '0', '', '', '2', '5', '1492163500', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('70', '2', '马云', 'http://wx.qlogo.cn/mmopen/vDwntJFbiafvIMib1wrzzial5zHGeP3Xwy8nVFnLxkYUhdgVRgaH4J2JXnicWCZFQCO883nB7JiaGMp15kZ5qo9gchA/0', '2', '22', '1492164147', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('71', '2', '马云', 'http://wx.qlogo.cn/mmopen/vDwntJFbiafvIMib1wrzzial5zHGeP3Xwy8nVFnLxkYUhdgVRgaH4J2JXnicWCZFQCO883nB7JiaGMp15kZ5qo9gchA/0', '2', '22321321', '1492164153', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('72', '2', '马云', 'http://wx.qlogo.cn/mmopen/vDwntJFbiafvIMib1wrzzial5zHGeP3Xwy8nVFnLxkYUhdgVRgaH4J2JXnicWCZFQCO883nB7JiaGMp15kZ5qo9gchA/0', '2', '23123123', '1492164236', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('73', '2', '马云', 'http://wx.qlogo.cn/mmopen/vDwntJFbiafvIMib1wrzzial5zHGeP3Xwy8nVFnLxkYUhdgVRgaH4J2JXnicWCZFQCO883nB7JiaGMp15kZ5qo9gchA/0', '2', '22222', '1492164413', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('74', '2', '马云', 'http://wx.qlogo.cn/mmopen/vDwntJFbiafvIMib1wrzzial5zHGeP3Xwy8nVFnLxkYUhdgVRgaH4J2JXnicWCZFQCO883nB7JiaGMp15kZ5qo9gchA/0', '2', '测试', '1492164541', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('75', '1', '纸飞机', 'http://wx.qlogo.cn/mmopen/vDwntJFbiafvIMib1wrzzial5zHGeP3Xwy8nVFnLxkYUhdgVRgaH4J2JXnicWCZFQCO883nB7JiaGMp15kZ5qo9gchA/0', '2', 'fey', '1492164637', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('76', '1', '纸飞机', 'http://wx.qlogo.cn/mmopen/vDwntJFbiafvIMib1wrzzial5zHGeP3Xwy8nVFnLxkYUhdgVRgaH4J2JXnicWCZFQCO883nB7JiaGMp15kZ5qo9gchA/0', '2', '马云你哈', '1492164779', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('77', '2', '马云', 'http://wx.qlogo.cn/mmopen/vDwntJFbiafvIMib1wrzzial5zHGeP3Xwy8nVFnLxkYUhdgVRgaH4J2JXnicWCZFQCO883nB7JiaGMp15kZ5qo9gchA/0', '1', '你好', '1492164787', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('78', '1', '纸飞机', 'http://wx.qlogo.cn/mmopen/vDwntJFbiafvIMib1wrzzial5zHGeP3Xwy8nVFnLxkYUhdgVRgaH4J2JXnicWCZFQCO883nB7JiaGMp15kZ5qo9gchA/0', '2', '2222', '1492165024', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('79', '1', '纸飞机', 'http://wx.qlogo.cn/mmopen/vDwntJFbiafvIMib1wrzzial5zHGeP3Xwy8nVFnLxkYUhdgVRgaH4J2JXnicWCZFQCO883nB7JiaGMp15kZ5qo9gchA/0', '2', '3333', '1492165043', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('80', '1', '纸飞机', 'http://wx.qlogo.cn/mmopen/vDwntJFbiafvIMib1wrzzial5zHGeP3Xwy8nVFnLxkYUhdgVRgaH4J2JXnicWCZFQCO883nB7JiaGMp15kZ5qo9gchA/0', '2', '444', '1492165114', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('81', '2', '马云', 'http://wx.qlogo.cn/mmopen/vDwntJFbiafvIMib1wrzzial5zHGeP3Xwy8nVFnLxkYUhdgVRgaH4J2JXnicWCZFQCO883nB7JiaGMp15kZ5qo9gchA/0', '1', '555', '1492165117', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('82', '1', '纸飞机', 'http://wx.qlogo.cn/mmopen/vDwntJFbiafvIMib1wrzzial5zHGeP3Xwy8nVFnLxkYUhdgVRgaH4J2JXnicWCZFQCO883nB7JiaGMp15kZ5qo9gchA/0', '2', 'nihaoadsdasds', '1492165147', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('83', '1', '纸飞机', 'http://wx.qlogo.cn/mmopen/vDwntJFbiafvIMib1wrzzial5zHGeP3Xwy8nVFnLxkYUhdgVRgaH4J2JXnicWCZFQCO883nB7JiaGMp15kZ5qo9gchA/0', '2', '你好 啊是滴是滴是', '1492165188', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('84', '2', '马云', 'http://wx.qlogo.cn/mmopen/vDwntJFbiafvIMib1wrzzial5zHGeP3Xwy8nVFnLxkYUhdgVRgaH4J2JXnicWCZFQCO883nB7JiaGMp15kZ5qo9gchA/0', '1', '是是是', '1492165194', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('85', '1', '纸飞机', 'http://wx.qlogo.cn/mmopen/vDwntJFbiafvIMib1wrzzial5zHGeP3Xwy8nVFnLxkYUhdgVRgaH4J2JXnicWCZFQCO883nB7JiaGMp15kZ5qo9gchA/0', '2', 'face[嘻嘻] ', '1492165211', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('86', '1', '纸飞机', 'http://wx.qlogo.cn/mmopen/vDwntJFbiafvIMib1wrzzial5zHGeP3Xwy8nVFnLxkYUhdgVRgaH4J2JXnicWCZFQCO883nB7JiaGMp15kZ5qo9gchA/0', '2', '22', '1492167119', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('87', '1', '纸飞机', 'http://wx.qlogo.cn/mmopen/vDwntJFbiafvIMib1wrzzial5zHGeP3Xwy8nVFnLxkYUhdgVRgaH4J2JXnicWCZFQCO883nB7JiaGMp15kZ5qo9gchA/0', '2', '44', '1492167155', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('88', '2', '安', 'http://wx.qlogo.cn/mmopen/vDwntJFbiafvIMib1wrzzial5zHGeP3Xwy8nVFnLxkYUhdgVRgaH4J2JXnicWCZFQCO883nB7JiaGMp15kZ5qo9gchA/0', '2', '你好', '1492167765', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('89', '1', '纸飞机', 'http://wx.qlogo.cn/mmopen/vDwntJFbiafvIMib1wrzzial5zHGeP3Xwy8nVFnLxkYUhdgVRgaH4J2JXnicWCZFQCO883nB7JiaGMp15kZ5qo9gchA/0', '2', '你好', '1492167822', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('90', '2', '安', 'http://wx.qlogo.cn/mmopen/PiajxSqBRaEKrI3kSvqkv2jyTc8xPCaTQPU05O2sf9GSImkcnWhwiaW3uwpUIiaJGvN1zoT42lIzJYBRG4Iw8vic7Q/0', '1', '我是安', '1492167870', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('91', '1', '纸飞机', 'http://wx.qlogo.cn/mmopen/vDwntJFbiafvIMib1wrzzial5zHGeP3Xwy8nVFnLxkYUhdgVRgaH4J2JXnicWCZFQCO883nB7JiaGMp15kZ5qo9gchA/0', '2', '今天周五了', '1492167918', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('92', '1', '纸飞机', 'http://wx.qlogo.cn/mmopen/vDwntJFbiafvIMib1wrzzial5zHGeP3Xwy8nVFnLxkYUhdgVRgaH4J2JXnicWCZFQCO883nB7JiaGMp15kZ5qo9gchA/0', '2', '明天周六', '1492168095', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('93', '2', '安', 'http://wx.qlogo.cn/mmopen/PiajxSqBRaEKrI3kSvqkv2jyTc8xPCaTQPU05O2sf9GSImkcnWhwiaW3uwpUIiaJGvN1zoT42lIzJYBRG4Iw8vic7Q/0', '1', '后天周日', '1492168107', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('94', '2', '安', 'http://wx.qlogo.cn/mmopen/PiajxSqBRaEKrI3kSvqkv2jyTc8xPCaTQPU05O2sf9GSImkcnWhwiaW3uwpUIiaJGvN1zoT42lIzJYBRG4Iw8vic7Q/0', '1', '222', '1492168226', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('95', '1', '纸飞机', 'http://wx.qlogo.cn/mmopen/vDwntJFbiafvIMib1wrzzial5zHGeP3Xwy8nVFnLxkYUhdgVRgaH4J2JXnicWCZFQCO883nB7JiaGMp15kZ5qo9gchA/0', '2', '222', '1492168263', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('96', '1', '纸飞机', 'http://wx.qlogo.cn/mmopen/vDwntJFbiafvIMib1wrzzial5zHGeP3Xwy8nVFnLxkYUhdgVRgaH4J2JXnicWCZFQCO883nB7JiaGMp15kZ5qo9gchA/0', '2', '22', '1492168282', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('97', '1', '纸飞机', 'http://wx.qlogo.cn/mmopen/vDwntJFbiafvIMib1wrzzial5zHGeP3Xwy8nVFnLxkYUhdgVRgaH4J2JXnicWCZFQCO883nB7JiaGMp15kZ5qo9gchA/0', '2', '444', '1492168296', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('98', '2', '安', 'http://wx.qlogo.cn/mmopen/PiajxSqBRaEKrI3kSvqkv2jyTc8xPCaTQPU05O2sf9GSImkcnWhwiaW3uwpUIiaJGvN1zoT42lIzJYBRG4Iw8vic7Q/0', '1', '444', '1492168303', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('99', '2', '纸飞机', 'http://tp4.sinaimg.cn/2145291155/180/5601307179/1', '1', '22', '1492168345', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('100', '1', '纸飞机', 'http://wx.qlogo.cn/mmopen/vDwntJFbiafvIMib1wrzzial5zHGeP3Xwy8nVFnLxkYUhdgVRgaH4J2JXnicWCZFQCO883nB7JiaGMp15kZ5qo9gchA/0', '2', '44', '1492168347', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('101', '1', '纸飞机', 'http://wx.qlogo.cn/mmopen/vDwntJFbiafvIMib1wrzzial5zHGeP3Xwy8nVFnLxkYUhdgVRgaH4J2JXnicWCZFQCO883nB7JiaGMp15kZ5qo9gchA/0', '2', '数据派', '1492168377', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('102', '2', '纸飞机', 'http://tp4.sinaimg.cn/2145291155/180/5601307179/1', '1', '什么是数据派', '1492168382', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('103', '1', '纸飞机', 'http://wx.qlogo.cn/mmopen/vDwntJFbiafvIMib1wrzzial5zHGeP3Xwy8nVFnLxkYUhdgVRgaH4J2JXnicWCZFQCO883nB7JiaGMp15kZ5qo9gchA/0', '2', '城市数据派', '1492168388', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('104', '1', '纸飞机', 'http://wx.qlogo.cn/mmopen/vDwntJFbiafvIMib1wrzzial5zHGeP3Xwy8nVFnLxkYUhdgVRgaH4J2JXnicWCZFQCO883nB7JiaGMp15kZ5qo9gchA/0', '2', '333', '1492168770', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('105', '2', '纸飞机', 'http://tp4.sinaimg.cn/2145291155/180/5601307179/1', '1', '222', '1492168948', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('106', '1', '纸飞机', 'http://wx.qlogo.cn/mmopen/vDwntJFbiafvIMib1wrzzial5zHGeP3Xwy8nVFnLxkYUhdgVRgaH4J2JXnicWCZFQCO883nB7JiaGMp15kZ5qo9gchA/0', '2', '是滴是滴', '1492169509', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('107', '2', '纸飞机', 'http://tp4.sinaimg.cn/2145291155/180/5601307179/1', '1', '45', '1492169693', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('108', '1', '纸飞机', 'http://wx.qlogo.cn/mmopen/vDwntJFbiafvIMib1wrzzial5zHGeP3Xwy8nVFnLxkYUhdgVRgaH4J2JXnicWCZFQCO883nB7JiaGMp15kZ5qo9gchA/0', '2', '55', '1492169731', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('109', '1', '纸飞机', 'http://wx.qlogo.cn/mmopen/vDwntJFbiafvIMib1wrzzial5zHGeP3Xwy8nVFnLxkYUhdgVRgaH4J2JXnicWCZFQCO883nB7JiaGMp15kZ5qo9gchA/0', '2', '恶魔', '1492169744', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('110', '2', '纸飞机', 'http://tp4.sinaimg.cn/2145291155/180/5601307179/1', '1', '吓死我了', '1492169823', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('111', '1', '纸飞机', 'http://wx.qlogo.cn/mmopen/vDwntJFbiafvIMib1wrzzial5zHGeP3Xwy8nVFnLxkYUhdgVRgaH4J2JXnicWCZFQCO883nB7JiaGMp15kZ5qo9gchA/0', '2', '你还好', '1492169915', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('112', '3', '纸飞机', 'http://wx.qlogo.cn/mmopen/vDwntJFbiafvIMib1wrzzial5zHGeP3Xwy8nVFnLxkYUhdgVRgaH4J2JXnicWCZFQCO883nB7JiaGMp15kZ5qo9gchA/0', '2', '22223333', '1492172332', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('113', '3', '纸飞机', 'http://wx.qlogo.cn/mmopen/vDwntJFbiafvIMib1wrzzial5zHGeP3Xwy8nVFnLxkYUhdgVRgaH4J2JXnicWCZFQCO883nB7JiaGMp15kZ5qo9gchA/0', '2', '你还好', '1492174050', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('114', '2', '纸飞机', 'http://tp4.sinaimg.cn/2145291155/180/5601307179/1', '3', '132321', '1492174069', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('115', '3', '纸飞机', 'http://wx.qlogo.cn/mmopen/vDwntJFbiafvIMib1wrzzial5zHGeP3Xwy8nVFnLxkYUhdgVRgaH4J2JXnicWCZFQCO883nB7JiaGMp15kZ5qo9gchA/0', '2', '特价咯', '1492174152', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('116', '3', '纸飞机', 'http://wx.qlogo.cn/mmopen/vDwntJFbiafvIMib1wrzzial5zHGeP3Xwy8nVFnLxkYUhdgVRgaH4J2JXnicWCZFQCO883nB7JiaGMp15kZ5qo9gchA/0', '2', 'face[嘻嘻] ', '1492174156', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('117', '2', '马云', 'http://wx.qlogo.cn/mmopen/vDwntJFbiafvIMib1wrzzial5zHGeP3Xwy8nVFnLxkYUhdgVRgaH4J2JXnicWCZFQCO883nB7JiaGMp15kZ5qo9gchA/0', '2', '222', '1492223864', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('118', '1', '纸飞机', 'http://wx.qlogo.cn/mmopen/vDwntJFbiafvIMib1wrzzial5zHGeP3Xwy8nVFnLxkYUhdgVRgaH4J2JXnicWCZFQCO883nB7JiaGMp15kZ5qo9gchA/0', '2', '333', '1492223978', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('119', '1', '纸飞机', 'http://wx.qlogo.cn/mmopen/vDwntJFbiafvIMib1wrzzial5zHGeP3Xwy8nVFnLxkYUhdgVRgaH4J2JXnicWCZFQCO883nB7JiaGMp15kZ5qo9gchA/0', '2', '23232322', '1492224300', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('120', '2', '马云', 'http://wx.qlogo.cn/mmopen/vDwntJFbiafvIMib1wrzzial5zHGeP3Xwy8nVFnLxkYUhdgVRgaH4J2JXnicWCZFQCO883nB7JiaGMp15kZ5qo9gchA/0', '1', 'and then', '1492224365', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('121', '1', '纸飞机', 'http://wx.qlogo.cn/mmopen/vDwntJFbiafvIMib1wrzzial5zHGeP3Xwy8nVFnLxkYUhdgVRgaH4J2JXnicWCZFQCO883nB7JiaGMp15kZ5qo9gchA/0', '2', '222', '1492224383', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('122', '2', '马云', 'http://wx.qlogo.cn/mmopen/vDwntJFbiafvIMib1wrzzial5zHGeP3Xwy8nVFnLxkYUhdgVRgaH4J2JXnicWCZFQCO883nB7JiaGMp15kZ5qo9gchA/0', '1', '444', '1492224400', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('123', '1', '纸飞机', 'http://wx.qlogo.cn/mmopen/vDwntJFbiafvIMib1wrzzial5zHGeP3Xwy8nVFnLxkYUhdgVRgaH4J2JXnicWCZFQCO883nB7JiaGMp15kZ5qo9gchA/0', '2', '333', '1492224470', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('124', '2', '马云', 'http://wx.qlogo.cn/mmopen/vDwntJFbiafvIMib1wrzzial5zHGeP3Xwy8nVFnLxkYUhdgVRgaH4J2JXnicWCZFQCO883nB7JiaGMp15kZ5qo9gchA/0', '1', '444', '1492224474', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('125', '2', '马云', 'http://wx.qlogo.cn/mmopen/vDwntJFbiafvIMib1wrzzial5zHGeP3Xwy8nVFnLxkYUhdgVRgaH4J2JXnicWCZFQCO883nB7JiaGMp15kZ5qo9gchA/0', '1', '23', '1492224614', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('126', '2', '马云', 'http://wx.qlogo.cn/mmopen/vDwntJFbiafvIMib1wrzzial5zHGeP3Xwy8nVFnLxkYUhdgVRgaH4J2JXnicWCZFQCO883nB7JiaGMp15kZ5qo9gchA/0', '1', '5', '1492224795', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('127', '2', '马云', 'http://wx.qlogo.cn/mmopen/vDwntJFbiafvIMib1wrzzial5zHGeP3Xwy8nVFnLxkYUhdgVRgaH4J2JXnicWCZFQCO883nB7JiaGMp15kZ5qo9gchA/0', '1', '3', '1492224872', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('128', '1', '纸飞机', 'http://wx.qlogo.cn/mmopen/vDwntJFbiafvIMib1wrzzial5zHGeP3Xwy8nVFnLxkYUhdgVRgaH4J2JXnicWCZFQCO883nB7JiaGMp15kZ5qo9gchA/0', '2', '3', '1492224950', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('129', '2', '马云', 'http://wx.qlogo.cn/mmopen/vDwntJFbiafvIMib1wrzzial5zHGeP3Xwy8nVFnLxkYUhdgVRgaH4J2JXnicWCZFQCO883nB7JiaGMp15kZ5qo9gchA/0', '1', '4', '1492224959', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('130', '2', '马云', 'http://wx.qlogo.cn/mmopen/vDwntJFbiafvIMib1wrzzial5zHGeP3Xwy8nVFnLxkYUhdgVRgaH4J2JXnicWCZFQCO883nB7JiaGMp15kZ5qo9gchA/0', '1', '222', '1492225167', 'friend', '0');
INSERT INTO `ys_chatlog` VALUES ('131', '1', '纸飞机', 'http://wx.qlogo.cn/mmopen/vDwntJFbiafvIMib1wrzzial5zHGeP3Xwy8nVFnLxkYUhdgVRgaH4J2JXnicWCZFQCO883nB7JiaGMp15kZ5qo9gchA/0', '2', '55', '1492225174', 'friend', '0');

-- ----------------------------
-- Table structure for ys_chatuser
-- ----------------------------
DROP TABLE IF EXISTS `ys_chatuser`;
CREATE TABLE `ys_chatuser` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nickname` varchar(155) DEFAULT NULL,
  `pwd` varchar(155) DEFAULT NULL COMMENT '密码',
  `sign` varchar(255) DEFAULT NULL,
  `headimg` varchar(255) DEFAULT NULL,
  `sex` tinyint(1) DEFAULT '1' COMMENT '性别 1男 -1女',
  `age` int(3) DEFAULT '18' COMMENT '年龄',
  `pid` int(10) DEFAULT '110000' COMMENT '所在省份id',
  `cid` int(10) DEFAULT '110000' COMMENT '所在城市id',
  `aid` int(10) DEFAULT '110101' COMMENT '所在区id',
  `area` varchar(255) DEFAULT '北京-北京市-东城区' COMMENT '所在区域描述',
  `status` tinyint(1) DEFAULT '0' COMMENT '0下线 1在线',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ys_chatuser
-- ----------------------------
INSERT INTO `ys_chatuser` VALUES ('1', '纸飞机', '21232f297a57a5a743894a0e4a801fc3', '我的新签名', 'http://tp4.sinaimg.cn/2145291155/180/5601307179/1', '1', '21', '320000', '320300', '320311', '江苏省-徐州市-泉山区', '1');
INSERT INTO `ys_chatuser` VALUES ('2', '马云', '21232f297a57a5a743894a0e4a801fc3', '让天下没有难写的代码', 'http://tp4.sinaimg.cn/2145291155/180/5601307179/1', '1', '18', '110000', '110100', '110101', '北京-北京市-东城区', '1');
INSERT INTO `ys_chatuser` VALUES ('3', '罗玉凤', '21232f297a57a5a743894a0e4a801fc3', '在自己实力不济的时候，不要去相信什么媒体和记者。他们不是善良的人，有时候候他们的采访对当事人而言就是陷阱', 'http://tp1.sinaimg.cn/1241679004/180/5743814375/0', '-1', '18', '110000', '110100', '110101', '北京-北京市-东城区', '0');
INSERT INTO `ys_chatuser` VALUES ('13', '前端大神', '4297f44b13955235245b2497399d7a93', '前端就是这么牛', 'http://tp1.sinaimg.cn/1241679004/180/5743814375/0', '1', '18', '110000', '110100', '110101', '北京-北京市-东城区', '0');
INSERT INTO `ys_chatuser` VALUES ('15', '马化腾', '21232f297a57a5a743894a0e4a801fc3', '没钱你玩个j8游戏', 'http://cdn.firstlinkapp.com/upload/2016_6/1465575923433_33812.jpg', '1', '18', '110000', '110100', '110101', '北京-北京市-东城区', '0');
INSERT INTO `ys_chatuser` VALUES ('16', '张飞', '21232f297a57a5a743894a0e4a801fc3', '来战个痛快', 'http://tva3.sinaimg.cn/crop.0.0.512.512.180/8693225ajw8f2rt20ptykj20e80e8weu.jpg', '1', '18', '320000', '320100', '320115', '江苏省-南京市-江宁区', '0');
INSERT INTO `ys_chatuser` VALUES ('17', '马超', '21232f297a57a5a743894a0e4a801fc3', '西凉第一猛将，我就是帅', 'http://tp2.sinaimg.cn/1783286485/180/5677568891/1', '1', '18', '110000', '110100', '110101', '北京-北京市-东城区', '0');
INSERT INTO `ys_chatuser` VALUES ('18', '李彦宏', '21232f297a57a5a743894a0e4a801fc3', '百度就是广告公司啊', 'http://tp2.sinaimg.cn/1833062053/180/5643591594/0', '-1', '18', '110000', '110100', '110101', '北京-北京市-东城区', '0');
INSERT INTO `ys_chatuser` VALUES ('19', '第一个注册', '4297f44b13955235245b2497399d7a93', '暂无', '/static/common/images/common.jpg', '1', '18', '110000', '110100', '110101', '北京-北京市-东城区', '0');
INSERT INTO `ys_chatuser` VALUES ('20', '这个user', '4297f44b13955235245b2497399d7a93', '暂无', '/static/common/images/common.jpg', '1', '18', '320000', '0', '0', '江苏省', '0');
INSERT INTO `ys_chatuser` VALUES ('21', '你好', '4297f44b13955235245b2497399d7a93', '暂无', '/static/common/images/common.jpg', '-1', '35', '320000', '320100', '0', '江苏省-南京市', '0');
INSERT INTO `ys_chatuser` VALUES ('22', '你们哈', '4297f44b13955235245b2497399d7a93', '暂无', '/static/common/images/common.jpg', '1', '25', '320000', '320300', '320303', '江苏省-徐州市-云龙区', '0');
INSERT INTO `ys_chatuser` VALUES ('23', 'admin', 'e10adc3949ba59abbe56e057f20f883e', '暂无', '/static/common/images/common.jpg', '1', '18', '110000', '110100', '110101', '北京-北京市-东城区', '1');
INSERT INTO `ys_chatuser` VALUES ('24', 'linxc', 'e10adc3949ba59abbe56e057f20f883e', '暂无', '/static/common/images/common.jpg', '-1', '18', '110000', '110100', '110101', '北京-北京市-东城区', '1');

-- ----------------------------
-- Table structure for ys_city
-- ----------------------------
DROP TABLE IF EXISTS `ys_city`;
CREATE TABLE `ys_city` (
  `cityid` int(11) NOT NULL AUTO_INCREMENT COMMENT '城市id',
  `pid` int(11) DEFAULT '0' COMMENT '城市所属省份id',
  `city` varchar(50) DEFAULT '' COMMENT '城市名',
  `ZipCode` int(6) DEFAULT '0' COMMENT '邮编',
  `isuse` tinyint(1) DEFAULT '0' COMMENT '是否启用默认0不启用1启用',
  `isdel` tinyint(1) DEFAULT '0' COMMENT '逻辑删除字段，默认0不删除，1已删除',
  PRIMARY KEY (`cityid`)
) ENGINE=MyISAM AUTO_INCREMENT=346 DEFAULT CHARSET=utf8 COMMENT='城市';

-- ----------------------------
-- Records of ys_city
-- ----------------------------
INSERT INTO `ys_city` VALUES ('1', '1', '北京市', null, '0', '0');
INSERT INTO `ys_city` VALUES ('2', '2', '天津市', '100000', '0', '0');
INSERT INTO `ys_city` VALUES ('3', '3', '石家庄市', '50000', '0', '0');
INSERT INTO `ys_city` VALUES ('4', '3', '唐山市', '63000', '0', '0');
INSERT INTO `ys_city` VALUES ('5', '3', '秦皇岛市', '66000', '0', '0');
INSERT INTO `ys_city` VALUES ('6', '3', '邯郸市', '56000', '0', '0');
INSERT INTO `ys_city` VALUES ('7', '3', '邢台市', '54000', '0', '0');
INSERT INTO `ys_city` VALUES ('8', '3', '保定市', '71000', '0', '0');
INSERT INTO `ys_city` VALUES ('9', '3', '张家口市', '75000', '0', '0');
INSERT INTO `ys_city` VALUES ('10', '3', '承德市', '67000', '0', '0');
INSERT INTO `ys_city` VALUES ('11', '3', '沧州市', '61000', '0', '0');
INSERT INTO `ys_city` VALUES ('12', '3', '廊坊市', '65000', '0', '0');
INSERT INTO `ys_city` VALUES ('13', '3', '衡水市', '53000', '0', '0');
INSERT INTO `ys_city` VALUES ('14', '4', '太原市', '30000', '0', '0');
INSERT INTO `ys_city` VALUES ('15', '4', '大同市', '37000', '0', '0');
INSERT INTO `ys_city` VALUES ('16', '4', '阳泉市', '45000', '0', '0');
INSERT INTO `ys_city` VALUES ('17', '4', '长治市', '46000', '0', '0');
INSERT INTO `ys_city` VALUES ('18', '4', '晋城市', '48000', '0', '0');
INSERT INTO `ys_city` VALUES ('19', '4', '朔州市', '36000', '0', '0');
INSERT INTO `ys_city` VALUES ('20', '4', '晋中市', '30600', '0', '0');
INSERT INTO `ys_city` VALUES ('21', '4', '运城市', '44000', '0', '0');
INSERT INTO `ys_city` VALUES ('22', '4', '忻州市', '34000', '0', '0');
INSERT INTO `ys_city` VALUES ('23', '4', '临汾市', '41000', '0', '0');
INSERT INTO `ys_city` VALUES ('24', '4', '吕梁市', '30500', '0', '0');
INSERT INTO `ys_city` VALUES ('25', '5', '呼和浩特市', '10000', '0', '0');
INSERT INTO `ys_city` VALUES ('26', '5', '包头市', '14000', '0', '0');
INSERT INTO `ys_city` VALUES ('27', '5', '乌海市', '16000', '0', '0');
INSERT INTO `ys_city` VALUES ('28', '5', '赤峰市', '24000', '0', '0');
INSERT INTO `ys_city` VALUES ('29', '5', '通辽市', '28000', '0', '0');
INSERT INTO `ys_city` VALUES ('30', '5', '鄂尔多斯市', '10300', '0', '0');
INSERT INTO `ys_city` VALUES ('31', '5', '呼伦贝尔市', '21000', '0', '0');
INSERT INTO `ys_city` VALUES ('32', '5', '巴彦淖尔市', '14400', '0', '0');
INSERT INTO `ys_city` VALUES ('33', '5', '乌兰察布市', '11800', '0', '0');
INSERT INTO `ys_city` VALUES ('34', '5', '兴安盟', '137500', '0', '0');
INSERT INTO `ys_city` VALUES ('35', '5', '锡林郭勒盟', '11100', '0', '0');
INSERT INTO `ys_city` VALUES ('36', '5', '阿拉善盟', '16000', '0', '0');
INSERT INTO `ys_city` VALUES ('37', '6', '沈阳市', '110000', '0', '0');
INSERT INTO `ys_city` VALUES ('38', '6', '大连市', '116000', '0', '0');
INSERT INTO `ys_city` VALUES ('39', '6', '鞍山市', '114000', '0', '0');
INSERT INTO `ys_city` VALUES ('40', '6', '抚顺市', '113000', '0', '0');
INSERT INTO `ys_city` VALUES ('41', '6', '本溪市', '117000', '0', '0');
INSERT INTO `ys_city` VALUES ('42', '6', '丹东市', '118000', '0', '0');
INSERT INTO `ys_city` VALUES ('43', '6', '锦州市', '121000', '0', '0');
INSERT INTO `ys_city` VALUES ('44', '6', '营口市', '115000', '0', '0');
INSERT INTO `ys_city` VALUES ('45', '6', '阜新市', '123000', '0', '0');
INSERT INTO `ys_city` VALUES ('46', '6', '辽阳市', '111000', '0', '0');
INSERT INTO `ys_city` VALUES ('47', '6', '盘锦市', '124000', '0', '0');
INSERT INTO `ys_city` VALUES ('48', '6', '铁岭市', '112000', '0', '0');
INSERT INTO `ys_city` VALUES ('49', '6', '朝阳市', '122000', '0', '0');
INSERT INTO `ys_city` VALUES ('50', '6', '葫芦岛市', '125000', '0', '0');
INSERT INTO `ys_city` VALUES ('51', '7', '长春市', '130000', '0', '0');
INSERT INTO `ys_city` VALUES ('52', '7', '吉林市', '132000', '0', '0');
INSERT INTO `ys_city` VALUES ('53', '7', '四平市', '136000', '0', '0');
INSERT INTO `ys_city` VALUES ('54', '7', '辽源市', '136200', '0', '0');
INSERT INTO `ys_city` VALUES ('55', '7', '通化市', '134000', '0', '0');
INSERT INTO `ys_city` VALUES ('56', '7', '白山市', '134300', '0', '0');
INSERT INTO `ys_city` VALUES ('57', '7', '松原市', '131100', '0', '0');
INSERT INTO `ys_city` VALUES ('58', '7', '白城市', '137000', '0', '0');
INSERT INTO `ys_city` VALUES ('59', '7', '延边朝鲜族自治州', '133000', '0', '0');
INSERT INTO `ys_city` VALUES ('60', '8', '哈尔滨市', '150000', '0', '0');
INSERT INTO `ys_city` VALUES ('61', '8', '齐齐哈尔市', '161000', '0', '0');
INSERT INTO `ys_city` VALUES ('62', '8', '鸡西市', '158100', '0', '0');
INSERT INTO `ys_city` VALUES ('63', '8', '鹤岗市', '154100', '0', '0');
INSERT INTO `ys_city` VALUES ('64', '8', '双鸭山市', '155100', '0', '0');
INSERT INTO `ys_city` VALUES ('65', '8', '大庆市', '163000', '0', '0');
INSERT INTO `ys_city` VALUES ('66', '8', '伊春市', '152300', '0', '0');
INSERT INTO `ys_city` VALUES ('67', '8', '佳木斯市', '154000', '0', '0');
INSERT INTO `ys_city` VALUES ('68', '8', '七台河市', '154600', '0', '0');
INSERT INTO `ys_city` VALUES ('69', '8', '牡丹江市', '157000', '0', '0');
INSERT INTO `ys_city` VALUES ('70', '8', '黑河市', '164300', '0', '0');
INSERT INTO `ys_city` VALUES ('71', '8', '绥化市', '152000', '0', '0');
INSERT INTO `ys_city` VALUES ('72', '8', '大兴安岭地区', '165000', '0', '0');
INSERT INTO `ys_city` VALUES ('73', '9', '上海市', '200000', '0', '0');
INSERT INTO `ys_city` VALUES ('74', '10', '南京市', '210000', '0', '0');
INSERT INTO `ys_city` VALUES ('75', '10', '无锡市', '214000', '0', '0');
INSERT INTO `ys_city` VALUES ('76', '10', '徐州市', '221000', '0', '0');
INSERT INTO `ys_city` VALUES ('77', '10', '常州市', '213000', '0', '0');
INSERT INTO `ys_city` VALUES ('78', '10', '苏州市', '215000', '0', '0');
INSERT INTO `ys_city` VALUES ('79', '10', '南通市', '226000', '0', '0');
INSERT INTO `ys_city` VALUES ('80', '10', '连云港市', '222000', '0', '0');
INSERT INTO `ys_city` VALUES ('81', '10', '淮安市', '223200', '0', '0');
INSERT INTO `ys_city` VALUES ('82', '10', '盐城市', '224000', '0', '0');
INSERT INTO `ys_city` VALUES ('83', '10', '扬州市', '225000', '0', '0');
INSERT INTO `ys_city` VALUES ('84', '10', '镇江市', '212000', '0', '0');
INSERT INTO `ys_city` VALUES ('85', '10', '泰州市', '225300', '0', '0');
INSERT INTO `ys_city` VALUES ('86', '10', '宿迁市', '223800', '0', '0');
INSERT INTO `ys_city` VALUES ('87', '11', '杭州市', '310000', '0', '0');
INSERT INTO `ys_city` VALUES ('88', '11', '宁波市', '315000', '0', '0');
INSERT INTO `ys_city` VALUES ('89', '11', '温州市', '325000', '0', '0');
INSERT INTO `ys_city` VALUES ('90', '11', '嘉兴市', '314000', '0', '0');
INSERT INTO `ys_city` VALUES ('91', '11', '湖州市', '313000', '0', '0');
INSERT INTO `ys_city` VALUES ('92', '11', '绍兴市', '312000', '0', '0');
INSERT INTO `ys_city` VALUES ('93', '11', '金华市', '321000', '0', '0');
INSERT INTO `ys_city` VALUES ('94', '11', '衢州市', '324000', '0', '0');
INSERT INTO `ys_city` VALUES ('95', '11', '舟山市', '316000', '0', '0');
INSERT INTO `ys_city` VALUES ('96', '11', '台州市', '318000', '0', '0');
INSERT INTO `ys_city` VALUES ('97', '11', '丽水市', '323000', '0', '0');
INSERT INTO `ys_city` VALUES ('98', '12', '合肥市', '230000', '0', '0');
INSERT INTO `ys_city` VALUES ('99', '12', '芜湖市', '241000', '0', '0');
INSERT INTO `ys_city` VALUES ('100', '12', '蚌埠市', '233000', '0', '0');
INSERT INTO `ys_city` VALUES ('101', '12', '淮南市', '232000', '0', '0');
INSERT INTO `ys_city` VALUES ('102', '12', '马鞍山市', '243000', '0', '0');
INSERT INTO `ys_city` VALUES ('103', '12', '淮北市', '235000', '0', '0');
INSERT INTO `ys_city` VALUES ('104', '12', '铜陵市', '244000', '0', '0');
INSERT INTO `ys_city` VALUES ('105', '12', '安庆市', '246000', '0', '0');
INSERT INTO `ys_city` VALUES ('106', '12', '黄山市', '242700', '0', '0');
INSERT INTO `ys_city` VALUES ('107', '12', '滁州市', '239000', '0', '0');
INSERT INTO `ys_city` VALUES ('108', '12', '阜阳市', '236100', '0', '0');
INSERT INTO `ys_city` VALUES ('109', '12', '宿州市', '234100', '0', '0');
INSERT INTO `ys_city` VALUES ('110', '12', '巢湖市', '238000', '0', '0');
INSERT INTO `ys_city` VALUES ('111', '12', '六安市', '237000', '0', '0');
INSERT INTO `ys_city` VALUES ('112', '12', '亳州市', '236800', '0', '0');
INSERT INTO `ys_city` VALUES ('113', '12', '池州市', '247100', '0', '0');
INSERT INTO `ys_city` VALUES ('114', '12', '宣城市', '366000', '0', '0');
INSERT INTO `ys_city` VALUES ('115', '13', '福州市', '350000', '0', '0');
INSERT INTO `ys_city` VALUES ('116', '13', '厦门市', '361000', '0', '0');
INSERT INTO `ys_city` VALUES ('117', '13', '莆田市', '351100', '0', '0');
INSERT INTO `ys_city` VALUES ('118', '13', '三明市', '365000', '0', '0');
INSERT INTO `ys_city` VALUES ('119', '13', '泉州市', '362000', '0', '0');
INSERT INTO `ys_city` VALUES ('120', '13', '漳州市', '363000', '0', '0');
INSERT INTO `ys_city` VALUES ('121', '13', '南平市', '353000', '0', '0');
INSERT INTO `ys_city` VALUES ('122', '13', '龙岩市', '364000', '0', '0');
INSERT INTO `ys_city` VALUES ('123', '13', '宁德市', '352100', '0', '0');
INSERT INTO `ys_city` VALUES ('124', '14', '南昌市', '330000', '0', '0');
INSERT INTO `ys_city` VALUES ('125', '14', '景德镇市', '333000', '0', '0');
INSERT INTO `ys_city` VALUES ('126', '14', '萍乡市', '337000', '0', '0');
INSERT INTO `ys_city` VALUES ('127', '14', '九江市', '332000', '0', '0');
INSERT INTO `ys_city` VALUES ('128', '14', '新余市', '338000', '0', '0');
INSERT INTO `ys_city` VALUES ('129', '14', '鹰潭市', '335000', '0', '0');
INSERT INTO `ys_city` VALUES ('130', '14', '赣州市', '341000', '0', '0');
INSERT INTO `ys_city` VALUES ('131', '14', '吉安市', '343000', '0', '0');
INSERT INTO `ys_city` VALUES ('132', '14', '宜春市', '336000', '0', '0');
INSERT INTO `ys_city` VALUES ('133', '14', '抚州市', '332900', '0', '0');
INSERT INTO `ys_city` VALUES ('134', '14', '上饶市', '334000', '0', '0');
INSERT INTO `ys_city` VALUES ('135', '15', '济南市', '250000', '0', '0');
INSERT INTO `ys_city` VALUES ('136', '15', '青岛市', '266000', '0', '0');
INSERT INTO `ys_city` VALUES ('137', '15', '淄博市', '255000', '0', '0');
INSERT INTO `ys_city` VALUES ('138', '15', '枣庄市', '277100', '0', '0');
INSERT INTO `ys_city` VALUES ('139', '15', '东营市', '257000', '0', '0');
INSERT INTO `ys_city` VALUES ('140', '15', '烟台市', '264000', '0', '0');
INSERT INTO `ys_city` VALUES ('141', '15', '潍坊市', '261000', '0', '0');
INSERT INTO `ys_city` VALUES ('142', '15', '济宁市', '272100', '0', '0');
INSERT INTO `ys_city` VALUES ('143', '15', '泰安市', '271000', '0', '0');
INSERT INTO `ys_city` VALUES ('144', '15', '威海市', '265700', '0', '0');
INSERT INTO `ys_city` VALUES ('145', '15', '日照市', '276800', '0', '0');
INSERT INTO `ys_city` VALUES ('146', '15', '莱芜市', '271100', '0', '0');
INSERT INTO `ys_city` VALUES ('147', '15', '临沂市', '276000', '0', '0');
INSERT INTO `ys_city` VALUES ('148', '15', '德州市', '253000', '0', '0');
INSERT INTO `ys_city` VALUES ('149', '15', '聊城市', '252000', '0', '0');
INSERT INTO `ys_city` VALUES ('150', '15', '滨州市', '256600', '0', '0');
INSERT INTO `ys_city` VALUES ('151', '15', '荷泽市', '255000', '0', '0');
INSERT INTO `ys_city` VALUES ('152', '16', '郑州市', '450000', '0', '0');
INSERT INTO `ys_city` VALUES ('153', '16', '开封市', '475000', '0', '0');
INSERT INTO `ys_city` VALUES ('154', '16', '洛阳市', '471000', '0', '0');
INSERT INTO `ys_city` VALUES ('155', '16', '平顶山市', '467000', '0', '0');
INSERT INTO `ys_city` VALUES ('156', '16', '安阳市', '454900', '0', '0');
INSERT INTO `ys_city` VALUES ('157', '16', '鹤壁市', '456600', '0', '0');
INSERT INTO `ys_city` VALUES ('158', '16', '新乡市', '453000', '0', '0');
INSERT INTO `ys_city` VALUES ('159', '16', '焦作市', '454100', '0', '0');
INSERT INTO `ys_city` VALUES ('160', '16', '濮阳市', '457000', '0', '0');
INSERT INTO `ys_city` VALUES ('161', '16', '许昌市', '461000', '0', '0');
INSERT INTO `ys_city` VALUES ('162', '16', '漯河市', '462000', '0', '0');
INSERT INTO `ys_city` VALUES ('163', '16', '三门峡市', '472000', '0', '0');
INSERT INTO `ys_city` VALUES ('164', '16', '南阳市', '473000', '0', '0');
INSERT INTO `ys_city` VALUES ('165', '16', '商丘市', '476000', '0', '0');
INSERT INTO `ys_city` VALUES ('166', '16', '信阳市', '464000', '0', '0');
INSERT INTO `ys_city` VALUES ('167', '16', '周口市', '466000', '0', '0');
INSERT INTO `ys_city` VALUES ('168', '16', '驻马店市', '463000', '0', '0');
INSERT INTO `ys_city` VALUES ('169', '17', '武汉市', '430000', '0', '0');
INSERT INTO `ys_city` VALUES ('170', '17', '黄石市', '435000', '0', '0');
INSERT INTO `ys_city` VALUES ('171', '17', '十堰市', '442000', '0', '0');
INSERT INTO `ys_city` VALUES ('172', '17', '宜昌市', '443000', '0', '0');
INSERT INTO `ys_city` VALUES ('173', '17', '襄樊市', '441000', '0', '0');
INSERT INTO `ys_city` VALUES ('174', '17', '鄂州市', '436000', '0', '0');
INSERT INTO `ys_city` VALUES ('175', '17', '荆门市', '448000', '0', '0');
INSERT INTO `ys_city` VALUES ('176', '17', '孝感市', '432100', '0', '0');
INSERT INTO `ys_city` VALUES ('177', '17', '荆州市', '434000', '0', '0');
INSERT INTO `ys_city` VALUES ('178', '17', '黄冈市', '438000', '0', '0');
INSERT INTO `ys_city` VALUES ('179', '17', '咸宁市', '437000', '0', '0');
INSERT INTO `ys_city` VALUES ('180', '17', '随州市', '441300', '0', '0');
INSERT INTO `ys_city` VALUES ('181', '17', '恩施土家族苗族自治州', '445000', '0', '0');
INSERT INTO `ys_city` VALUES ('182', '17', '神农架', '442400', '0', '0');
INSERT INTO `ys_city` VALUES ('183', '18', '长沙市', '410000', '0', '0');
INSERT INTO `ys_city` VALUES ('184', '18', '株洲市', '412000', '0', '0');
INSERT INTO `ys_city` VALUES ('185', '18', '湘潭市', '411100', '0', '0');
INSERT INTO `ys_city` VALUES ('186', '18', '衡阳市', '421000', '0', '0');
INSERT INTO `ys_city` VALUES ('187', '18', '邵阳市', '422000', '0', '0');
INSERT INTO `ys_city` VALUES ('188', '18', '岳阳市', '414000', '0', '0');
INSERT INTO `ys_city` VALUES ('189', '18', '常德市', '415000', '0', '0');
INSERT INTO `ys_city` VALUES ('190', '18', '张家界市', '427000', '0', '0');
INSERT INTO `ys_city` VALUES ('191', '18', '益阳市', '413000', '0', '0');
INSERT INTO `ys_city` VALUES ('192', '18', '郴州市', '423000', '0', '0');
INSERT INTO `ys_city` VALUES ('193', '18', '永州市', '425000', '0', '0');
INSERT INTO `ys_city` VALUES ('194', '18', '怀化市', '418000', '0', '0');
INSERT INTO `ys_city` VALUES ('195', '18', '娄底市', '417000', '0', '0');
INSERT INTO `ys_city` VALUES ('196', '18', '湘西土家族苗族自治州', '416000', '0', '0');
INSERT INTO `ys_city` VALUES ('197', '19', '广州市', '510000', '0', '0');
INSERT INTO `ys_city` VALUES ('198', '19', '韶关市', '521000', '0', '0');
INSERT INTO `ys_city` VALUES ('199', '19', '深圳市', '518000', '0', '0');
INSERT INTO `ys_city` VALUES ('200', '19', '珠海市', '519000', '0', '0');
INSERT INTO `ys_city` VALUES ('201', '19', '汕头市', '515000', '0', '0');
INSERT INTO `ys_city` VALUES ('202', '19', '佛山市', '528000', '0', '0');
INSERT INTO `ys_city` VALUES ('203', '19', '江门市', '529000', '0', '0');
INSERT INTO `ys_city` VALUES ('204', '19', '湛江市', '524000', '0', '0');
INSERT INTO `ys_city` VALUES ('205', '19', '茂名市', '525000', '0', '0');
INSERT INTO `ys_city` VALUES ('206', '19', '肇庆市', '526000', '0', '0');
INSERT INTO `ys_city` VALUES ('207', '19', '惠州市', '516000', '0', '0');
INSERT INTO `ys_city` VALUES ('208', '19', '梅州市', '514000', '0', '0');
INSERT INTO `ys_city` VALUES ('209', '19', '汕尾市', '516600', '0', '0');
INSERT INTO `ys_city` VALUES ('210', '19', '河源市', '517000', '0', '0');
INSERT INTO `ys_city` VALUES ('211', '19', '阳江市', '529500', '0', '0');
INSERT INTO `ys_city` VALUES ('212', '19', '清远市', '511500', '0', '0');
INSERT INTO `ys_city` VALUES ('213', '19', '东莞市', '511700', '0', '0');
INSERT INTO `ys_city` VALUES ('214', '19', '中山市', '528400', '0', '0');
INSERT INTO `ys_city` VALUES ('215', '19', '潮州市', '515600', '0', '0');
INSERT INTO `ys_city` VALUES ('216', '19', '揭阳市', '522000', '0', '0');
INSERT INTO `ys_city` VALUES ('217', '19', '云浮市', '527300', '0', '0');
INSERT INTO `ys_city` VALUES ('218', '20', '南宁市', '530000', '0', '0');
INSERT INTO `ys_city` VALUES ('219', '20', '柳州市', '545000', '0', '0');
INSERT INTO `ys_city` VALUES ('220', '20', '桂林市', '541000', '0', '0');
INSERT INTO `ys_city` VALUES ('221', '20', '梧州市', '543000', '0', '0');
INSERT INTO `ys_city` VALUES ('222', '20', '北海市', '536000', '0', '0');
INSERT INTO `ys_city` VALUES ('223', '20', '防城港市', '538000', '0', '0');
INSERT INTO `ys_city` VALUES ('224', '20', '钦州市', '535000', '0', '0');
INSERT INTO `ys_city` VALUES ('225', '20', '贵港市', '537100', '0', '0');
INSERT INTO `ys_city` VALUES ('226', '20', '玉林市', '537000', '0', '0');
INSERT INTO `ys_city` VALUES ('227', '20', '百色市', '533000', '0', '0');
INSERT INTO `ys_city` VALUES ('228', '20', '贺州市', '542800', '0', '0');
INSERT INTO `ys_city` VALUES ('229', '20', '河池市', '547000', '0', '0');
INSERT INTO `ys_city` VALUES ('230', '20', '来宾市', '546100', '0', '0');
INSERT INTO `ys_city` VALUES ('231', '20', '崇左市', '532200', '0', '0');
INSERT INTO `ys_city` VALUES ('232', '21', '海口市', '570000', '0', '0');
INSERT INTO `ys_city` VALUES ('233', '21', '三亚市', '572000', '0', '0');
INSERT INTO `ys_city` VALUES ('234', '22', '重庆市', '400000', '0', '0');
INSERT INTO `ys_city` VALUES ('235', '23', '成都市', '610000', '0', '0');
INSERT INTO `ys_city` VALUES ('236', '23', '自贡市', '643000', '0', '0');
INSERT INTO `ys_city` VALUES ('237', '23', '攀枝花市', '617000', '0', '0');
INSERT INTO `ys_city` VALUES ('238', '23', '泸州市', '646100', '0', '0');
INSERT INTO `ys_city` VALUES ('239', '23', '德阳市', '618000', '0', '0');
INSERT INTO `ys_city` VALUES ('240', '23', '绵阳市', '621000', '0', '0');
INSERT INTO `ys_city` VALUES ('241', '23', '广元市', '628000', '0', '0');
INSERT INTO `ys_city` VALUES ('242', '23', '遂宁市', '629000', '0', '0');
INSERT INTO `ys_city` VALUES ('243', '23', '内江市', '641000', '0', '0');
INSERT INTO `ys_city` VALUES ('244', '23', '乐山市', '614000', '0', '0');
INSERT INTO `ys_city` VALUES ('245', '23', '南充市', '637000', '0', '0');
INSERT INTO `ys_city` VALUES ('246', '23', '眉山市', '612100', '0', '0');
INSERT INTO `ys_city` VALUES ('247', '23', '宜宾市', '644000', '0', '0');
INSERT INTO `ys_city` VALUES ('248', '23', '广安市', '638000', '0', '0');
INSERT INTO `ys_city` VALUES ('249', '23', '达州市', '635000', '0', '0');
INSERT INTO `ys_city` VALUES ('250', '23', '雅安市', '625000', '0', '0');
INSERT INTO `ys_city` VALUES ('251', '23', '巴中市', '635500', '0', '0');
INSERT INTO `ys_city` VALUES ('252', '23', '资阳市', '641300', '0', '0');
INSERT INTO `ys_city` VALUES ('253', '23', '阿坝藏族羌族自治州', '624600', '0', '0');
INSERT INTO `ys_city` VALUES ('254', '23', '甘孜藏族自治州', '626000', '0', '0');
INSERT INTO `ys_city` VALUES ('255', '23', '凉山彝族自治州', '615000', '0', '0');
INSERT INTO `ys_city` VALUES ('256', '24', '贵阳市', '55000', '0', '0');
INSERT INTO `ys_city` VALUES ('257', '24', '六盘水市', '553000', '0', '0');
INSERT INTO `ys_city` VALUES ('258', '24', '遵义市', '563000', '0', '0');
INSERT INTO `ys_city` VALUES ('259', '24', '安顺市', '561000', '0', '0');
INSERT INTO `ys_city` VALUES ('260', '24', '铜仁地区', '554300', '0', '0');
INSERT INTO `ys_city` VALUES ('261', '24', '黔西南布依族苗族自治州', '551500', '0', '0');
INSERT INTO `ys_city` VALUES ('262', '24', '毕节地区', '551700', '0', '0');
INSERT INTO `ys_city` VALUES ('263', '24', '黔东南苗族侗族自治州', '551500', '0', '0');
INSERT INTO `ys_city` VALUES ('264', '24', '黔南布依族苗族自治州', '550100', '0', '0');
INSERT INTO `ys_city` VALUES ('265', '25', '昆明市', '650000', '0', '0');
INSERT INTO `ys_city` VALUES ('266', '25', '曲靖市', '655000', '0', '0');
INSERT INTO `ys_city` VALUES ('267', '25', '玉溪市', '653100', '0', '0');
INSERT INTO `ys_city` VALUES ('268', '25', '保山市', '678000', '0', '0');
INSERT INTO `ys_city` VALUES ('269', '25', '昭通市', '657000', '0', '0');
INSERT INTO `ys_city` VALUES ('270', '25', '丽江市', '674100', '0', '0');
INSERT INTO `ys_city` VALUES ('271', '25', '思茅市', '665000', '0', '0');
INSERT INTO `ys_city` VALUES ('272', '25', '临沧市', '677000', '0', '0');
INSERT INTO `ys_city` VALUES ('273', '25', '楚雄彝族自治州', '675000', '0', '0');
INSERT INTO `ys_city` VALUES ('274', '25', '红河哈尼族彝族自治州', '654400', '0', '0');
INSERT INTO `ys_city` VALUES ('275', '25', '文山壮族苗族自治州', '663000', '0', '0');
INSERT INTO `ys_city` VALUES ('276', '25', '西双版纳傣族自治州', '666200', '0', '0');
INSERT INTO `ys_city` VALUES ('277', '25', '大理白族自治州', '671000', '0', '0');
INSERT INTO `ys_city` VALUES ('278', '25', '德宏傣族景颇族自治州', '678400', '0', '0');
INSERT INTO `ys_city` VALUES ('279', '25', '怒江傈僳族自治州', '671400', '0', '0');
INSERT INTO `ys_city` VALUES ('280', '25', '迪庆藏族自治州', '674400', '0', '0');
INSERT INTO `ys_city` VALUES ('281', '26', '拉萨市', '850000', '0', '0');
INSERT INTO `ys_city` VALUES ('282', '26', '昌都地区', '854000', '0', '0');
INSERT INTO `ys_city` VALUES ('283', '26', '山南地区', '856000', '0', '0');
INSERT INTO `ys_city` VALUES ('284', '26', '日喀则地区', '857000', '0', '0');
INSERT INTO `ys_city` VALUES ('285', '26', '那曲地区', '852000', '0', '0');
INSERT INTO `ys_city` VALUES ('286', '26', '阿里地区', '859100', '0', '0');
INSERT INTO `ys_city` VALUES ('287', '26', '林芝地区', '860100', '0', '0');
INSERT INTO `ys_city` VALUES ('288', '27', '西安市', '710000', '0', '0');
INSERT INTO `ys_city` VALUES ('289', '27', '铜川市', '727000', '0', '0');
INSERT INTO `ys_city` VALUES ('290', '27', '宝鸡市', '721000', '0', '0');
INSERT INTO `ys_city` VALUES ('291', '27', '咸阳市', '712000', '0', '0');
INSERT INTO `ys_city` VALUES ('292', '27', '渭南市', '714000', '0', '0');
INSERT INTO `ys_city` VALUES ('293', '27', '延安市', '716000', '0', '0');
INSERT INTO `ys_city` VALUES ('294', '27', '汉中市', '723000', '0', '0');
INSERT INTO `ys_city` VALUES ('295', '27', '榆林市', '719000', '0', '0');
INSERT INTO `ys_city` VALUES ('296', '27', '安康市', '725000', '0', '0');
INSERT INTO `ys_city` VALUES ('297', '27', '商洛市', '711500', '0', '0');
INSERT INTO `ys_city` VALUES ('298', '28', '兰州市', '730000', '0', '0');
INSERT INTO `ys_city` VALUES ('299', '28', '嘉峪关市', '735100', '0', '0');
INSERT INTO `ys_city` VALUES ('300', '28', '金昌市', '737100', '0', '0');
INSERT INTO `ys_city` VALUES ('301', '28', '白银市', '730900', '0', '0');
INSERT INTO `ys_city` VALUES ('302', '28', '天水市', '741000', '0', '0');
INSERT INTO `ys_city` VALUES ('303', '28', '武威市', '733000', '0', '0');
INSERT INTO `ys_city` VALUES ('304', '28', '张掖市', '734000', '0', '0');
INSERT INTO `ys_city` VALUES ('305', '28', '平凉市', '744000', '0', '0');
INSERT INTO `ys_city` VALUES ('306', '28', '酒泉市', '735000', '0', '0');
INSERT INTO `ys_city` VALUES ('307', '28', '庆阳市', '744500', '0', '0');
INSERT INTO `ys_city` VALUES ('308', '28', '定西市', '743000', '0', '0');
INSERT INTO `ys_city` VALUES ('309', '28', '陇南市', '742100', '0', '0');
INSERT INTO `ys_city` VALUES ('310', '28', '临夏回族自治州', '731100', '0', '0');
INSERT INTO `ys_city` VALUES ('311', '28', '甘南藏族自治州', '747000', '0', '0');
INSERT INTO `ys_city` VALUES ('312', '29', '西宁市', '810000', '0', '0');
INSERT INTO `ys_city` VALUES ('313', '29', '海东地区', '810600', '0', '0');
INSERT INTO `ys_city` VALUES ('314', '29', '海北藏族自治州', '810300', '0', '0');
INSERT INTO `ys_city` VALUES ('315', '29', '黄南藏族自治州', '811300', '0', '0');
INSERT INTO `ys_city` VALUES ('316', '29', '海南藏族自治州', '813000', '0', '0');
INSERT INTO `ys_city` VALUES ('317', '29', '果洛藏族自治州', '814000', '0', '0');
INSERT INTO `ys_city` VALUES ('318', '29', '玉树藏族自治州', '815000', '0', '0');
INSERT INTO `ys_city` VALUES ('319', '29', '海西蒙古族藏族自治州', '817000', '0', '0');
INSERT INTO `ys_city` VALUES ('320', '30', '银川市', '750000', '0', '0');
INSERT INTO `ys_city` VALUES ('321', '30', '石嘴山市', '753000', '0', '0');
INSERT INTO `ys_city` VALUES ('322', '30', '吴忠市', '751100', '0', '0');
INSERT INTO `ys_city` VALUES ('323', '30', '固原市', '756000', '0', '0');
INSERT INTO `ys_city` VALUES ('324', '30', '中卫市', '751700', '0', '0');
INSERT INTO `ys_city` VALUES ('325', '31', '乌鲁木齐市', '830000', '0', '0');
INSERT INTO `ys_city` VALUES ('326', '31', '克拉玛依市', '834000', '0', '0');
INSERT INTO `ys_city` VALUES ('327', '31', '吐鲁番地区', '838000', '0', '0');
INSERT INTO `ys_city` VALUES ('328', '31', '哈密地区', '839000', '0', '0');
INSERT INTO `ys_city` VALUES ('329', '31', '昌吉回族自治州', '831100', '0', '0');
INSERT INTO `ys_city` VALUES ('330', '31', '博尔塔拉蒙古自治州', '833400', '0', '0');
INSERT INTO `ys_city` VALUES ('331', '31', '巴音郭楞蒙古自治州', '841000', '0', '0');
INSERT INTO `ys_city` VALUES ('332', '31', '阿克苏地区', '843000', '0', '0');
INSERT INTO `ys_city` VALUES ('333', '31', '克孜勒苏柯尔克孜自治州', '835600', '0', '0');
INSERT INTO `ys_city` VALUES ('334', '31', '喀什地区', '844000', '0', '0');
INSERT INTO `ys_city` VALUES ('335', '31', '和田地区', '848000', '0', '0');
INSERT INTO `ys_city` VALUES ('336', '31', '伊犁哈萨克自治州', '833200', '0', '0');
INSERT INTO `ys_city` VALUES ('337', '31', '塔城地区', '834700', '0', '0');
INSERT INTO `ys_city` VALUES ('338', '31', '阿勒泰地区', '836500', '0', '0');
INSERT INTO `ys_city` VALUES ('339', '31', '石河子市', '832000', '0', '0');
INSERT INTO `ys_city` VALUES ('340', '31', '阿拉尔市', '843300', '0', '0');
INSERT INTO `ys_city` VALUES ('341', '31', '图木舒克市', '843900', '0', '0');
INSERT INTO `ys_city` VALUES ('342', '31', '五家渠市', '831300', '0', '0');
INSERT INTO `ys_city` VALUES ('343', '32', '香港特别行政区', '0', '0', '0');
INSERT INTO `ys_city` VALUES ('344', '33', '澳门特别行政区', '0', '0', '0');
INSERT INTO `ys_city` VALUES ('345', '0', '台湾省', '0', '0', '0');

-- ----------------------------
-- Table structure for ys_comment
-- ----------------------------
DROP TABLE IF EXISTS `ys_comment`;
CREATE TABLE `ys_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增唯一ID',
  `uid` int(11) DEFAULT NULL,
  `createtime` int(11) NOT NULL DEFAULT '0' COMMENT '评论时间',
  `updatetime` int(11) DEFAULT '0' COMMENT '修改时间',
  `content` text NOT NULL COMMENT '评论正文',
  `approved` varchar(20) NOT NULL DEFAULT '0' COMMENT '审核 0-待审核  1-已审核',
  `articleid` int(11) DEFAULT '0' COMMENT '父评论ID',
  `score` int(2) DEFAULT '0' COMMENT '商品评分',
  `status` tinyint(3) NOT NULL DEFAULT '1' COMMENT '状态 0不显示 1-正常显示',
  `isdel` bit(1) DEFAULT b'0' COMMENT '逻辑删除字段，0不删除，1已删除',
  `thumbcount` varchar(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COMMENT='评论表';

-- ----------------------------
-- Records of ys_comment
-- ----------------------------
INSERT INTO `ys_comment` VALUES ('1', '1', '1491636432', '1491636432', '#勒令诈骗团伙退老人钱#【“好汉哥”持刀砸车窗 勒令诈骗团伙退还老人10万】昨日,广东茂名信宜市镇隆镇一男子手持刀具,勒令疑似保健品诈骗团伙当场退款。“彪悍男子”叫梁雄志,今年44岁,是当地知名沉香种植大户,也是资深义工。梁雄志说,这是第五次打击保健品诈骗行为,当天经过发现很多老人上当 ​​', '1', '10', '88', '1', '', '0');
INSERT INTO `ys_comment` VALUES ('2', '2', '1491636432', '1491636432', '#勒令诈骗团伙退老人钱#【“好汉哥”持刀砸车窗 勒令诈骗团伙退还老人10万】昨日,广东茂名信宜市镇隆镇一男子手持刀具,勒令疑似保健品诈骗团伙当场退款。“彪悍男子”叫梁雄志,今年44岁,是当地知名沉香种植大户,也是资深义工。梁雄志说,这是第五次打击保健品诈骗行为,当天经过发现很多老人上当 ​​', '1', '10', '88', '1', '\0', '0');
INSERT INTO `ys_comment` VALUES ('3', '2', '1491636432', '1491636432', '#勒令诈骗团伙退老人钱#【“好汉哥”持刀砸车窗 勒令诈骗团伙退还老人10万】昨日,广东茂名信宜市镇隆镇一男子手持刀具,勒令疑似保健品诈骗团伙当场退款。“彪悍男子”叫梁雄志,今年44岁,是当地知名沉香种植大户,也是资深义工。梁雄志说,这是第五次打击保健品诈骗行为,当天经过发现很多老人上当 ​​', '1', '10', '8', '1', '\0', '0');
INSERT INTO `ys_comment` VALUES ('4', '2', '1491636432', '1491636432', '#勒令诈骗团伙退老人钱#【“好汉哥”持刀砸车窗 勒令诈骗团伙退还老人10万】昨日,广东茂名信宜市镇隆镇一男子手持刀具,勒令疑似保健品诈骗团伙当场退款。“彪悍男子”叫梁雄志,今年44岁,是当地知名沉香种植大户,也是资深义工。梁雄志说,这是第五次打击保健品诈骗行为,当天经过发现很多老人上当 ​​', '1', '10', '888', '1', '\0', '0');
INSERT INTO `ys_comment` VALUES ('5', '2', '1491636432', '1491636432', '#勒令诈骗团伙退老人钱#【“好汉哥”持刀砸车窗 勒令诈骗团伙退还老人10万】昨日,广东茂名信宜市镇隆镇一男子手持刀具,勒令疑似保健品诈骗团伙当场退款。“彪悍男子”叫梁雄志,今年44岁,是当地知名沉香种植大户,也是资深义工。梁雄志说,这是第五次打击保健品诈骗行为,当天经过发现很多老人上当 ​​', '1', '10', '8', '1', '\0', '0');
INSERT INTO `ys_comment` VALUES ('6', '2', '1491636432', '1491636432', '#勒令诈骗团伙退老人钱#【“好汉哥”持刀砸车窗 勒令诈骗团伙退还老人10万】昨日,广东茂名信宜市镇隆镇一男子手持刀具,勒令疑似保健品诈骗团伙当场退款。“彪悍男子”叫梁雄志,今年44岁,是当地知名沉香种植大户,也是资深义工。梁雄志说,这是第五次打击保健品诈骗行为,当天经过发现很多老人上当 ​​', '1', '10', '8', '1', '\0', '0');
INSERT INTO `ys_comment` VALUES ('7', '2', '1491636432', '1491636432', '#勒令诈骗团伙退老人钱#【“好汉哥”持刀砸车窗 勒令诈骗团伙退还老人10万】昨日,广东茂名信宜市镇隆镇一男子手持刀具,勒令疑似保健品诈骗团伙当场退款。“彪悍男子”叫梁雄志,今年44岁,是当地知名沉香种植大户,也是资深义工。梁雄志说,这是第五次打击保健品诈骗行为,当天经过发现很多老人上当 ​​', '1', '10', '8', '1', '\0', '0');
INSERT INTO `ys_comment` VALUES ('8', '3', '1491636432', '1491636432', '#勒令诈骗团伙退老人钱#【“好汉哥”持刀砸车窗 勒令诈骗团伙退还老人10万】昨日,广东茂名信宜市镇隆镇一男子手持刀具,勒令疑似保健品诈骗团伙当场退款。“彪悍男子”叫梁雄志,今年44岁,是当地知名沉香种植大户,也是资深义工。梁雄志说,这是第五次打击保健品诈骗行为,当天经过发现很多老人上当 ​​', '1', '10', '8', '1', '\0', '0');
INSERT INTO `ys_comment` VALUES ('9', '1', '1491636432', '1491636432', '#勒令诈骗团伙退老人钱#【“好汉哥”持刀砸车窗 勒令诈骗团伙退还老人10万】昨日,广东茂名信宜市镇隆镇一男子手持刀具,勒令疑似保健品诈骗团伙当场退款。“彪悍男子”叫梁雄志,今年44岁,是当地知名沉香种植大户,也是资深义工。梁雄志说,这是第五次打击保健品诈骗行为,当天经过发现很多老人上当 ​​', '0', '10', '8', '1', '\0', '0');
INSERT INTO `ys_comment` VALUES ('10', '1', '1491636432', '1491636432', '#勒令诈骗团伙退老人钱#【“好汉哥”持刀砸车窗 勒令诈骗团伙退还老人10万】昨日,广东茂名信宜市镇隆镇一男子手持刀具,勒令疑似保健品诈骗团伙当场退款。“彪悍男子”叫梁雄志,今年44岁,是当地知名沉香种植大户,也是资深义工。梁雄志说,这是第五次打击保健品诈骗行为,当天经过发现很多老人上当 ​​', '0', '10', '8', '1', '\0', '0');
INSERT INTO `ys_comment` VALUES ('11', '1', '1491897391', '0', '讲的真好', '0', '1', '0', '1', '\0', '1');
INSERT INTO `ys_comment` VALUES ('12', '1', '1491898512', '0', '还可以', '0', '1', '0', '1', '\0', '0');
INSERT INTO `ys_comment` VALUES ('13', '1', '1491903190', '0', '   个人信息  view/personal/myinfo.html     index.php/personal/myinfo \n   我的人脉 列表   view/personal/mycontact.html     index.php/personal/mycontact\n   我的人脉 会员详情  view/personal/mymemberdetail.html     index.php/personal/mymemberdetail\n   我的需求 列表   view/personal/mydemand.html     index.php/personal/mydemand\n   我的需求 详情页  view/personal/mydemdetail.html     index.php/personal/mydemdetail\n   我的需求 新增   view/personal/mydemandadd.html     index.php/personal/mydemandadd\n   我的消息 列表   view/personal/mymsg.html     index.php/personal/mymsg\n   关于我们 列表页  view/personal/about.html     index.php/personal/about\n   我的 - 关于我们 - 私募介绍、帮助中心、服务协议 详情页  view/personal/aboutdetail.html     index.php/personal/aboutdetail\n    我的 - 关于我们 - 入会记录  view/personal/ruhuilist.html     index.php/personal/ruhuilist\n     我的 - 关于我们 - 意见反馈  view/personal/feed.html     index.php/personal/feed\n   机构机构 - 添加审核\\审核未通过  view/personal/review.html     index.php/personal/review', '0', '1', '0', '1', '\0', '0');
INSERT INTO `ys_comment` VALUES ('14', '1', '1491903212', '0', '   个人信息  view/personal/myinfo.html     index.php/personal/myinfo \n   我的人脉 列表   view/personal/mycontact.html     index.php/personal/mycontact\n   我的人脉 会员详情  view/personal/mymemberdetail.html     index.php/personal/mymemberdetail\n   我的需求 列表   view/personal/mydemand.html     index.php/personal/mydemand\n   我的需求 详情页  view/personal/mydemdetail.html     index.php/personal/mydemdetail\n   我的需求 新增   view/personal/mydemandadd.html     index.php/personal/mydemandadd\n   我的消息 列表   view/personal/mymsg.html     index.php/personal/mymsg\n   关于我们 列表页  view/personal/about.html     index.php/personal/about\n   我的 - 关于我们 - 私募介绍、帮助中心、服务协议 详情页  view/personal/aboutdetail.html     index.php/personal/aboutdetail\n    我的 - 关于我们 - 入会记录  view/personal/ruhuilist.html     index.php/personal/ruhuilist\n     我的 - 关于我们 - 意见反馈  view/personal/feed.html     index.php/personal/feed\n   机构机构 - 添加审核\\审核未通过  view/personal/review.html     index.php/personal/review', '0', '1', '0', '1', '\0', '0');

-- ----------------------------
-- Table structure for ys_feed
-- ----------------------------
DROP TABLE IF EXISTS `ys_feed`;
CREATE TABLE `ys_feed` (
  `feedid` int(11) NOT NULL AUTO_INCREMENT COMMENT '反馈id',
  `content` text NOT NULL COMMENT '内容',
  `status` tinyint(1) DEFAULT '0' COMMENT '状态1已审核0未审核',
  `createtime` int(11) DEFAULT '0' COMMENT '创建时间',
  `updatetime` int(11) DEFAULT '0' COMMENT '修改时间',
  `isdel` tinyint(1) DEFAULT '0' COMMENT '逻辑删除字段，0不删除，1已删除',
  PRIMARY KEY (`feedid`),
  KEY `slug` (`status`),
  KEY `name` (`content`(191))
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COMMENT='反馈内容';

-- ----------------------------
-- Records of ys_feed
-- ----------------------------
INSERT INTO `ys_feed` VALUES ('1', '新啊是的发送到发手动阀阿斯顿发阿桑啊啊 ', '1', '1491637955', '1491637955', '0');
INSERT INTO `ys_feed` VALUES ('2', '企业新闻阿斯顿发生的发是阿斯顿发啊  ', '1', '1491637955', '1491637955', '0');
INSERT INTO `ys_feed` VALUES ('3', '行业资讯是的发送到发安抚阿桑啊啊 ', '1', '1491637955', '1491637955', '0');

-- ----------------------------
-- Table structure for ys_friends
-- ----------------------------
DROP TABLE IF EXISTS `ys_friends`;
CREATE TABLE `ys_friends` (
  `user_id` int(11) NOT NULL COMMENT '用户id',
  `friend_id` int(11) NOT NULL COMMENT '朋友id',
  `group_id` int(11) NOT NULL COMMENT '朋友所属组别id',
  KEY `user_id` (`user_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ys_friends
-- ----------------------------
INSERT INTO `ys_friends` VALUES ('2', '1', '1');
INSERT INTO `ys_friends` VALUES ('1', '2', '1');
INSERT INTO `ys_friends` VALUES ('23', '24', '1');
INSERT INTO `ys_friends` VALUES ('24', '23', '1');

-- ----------------------------
-- Table structure for ys_friendship
-- ----------------------------
DROP TABLE IF EXISTS `ys_friendship`;
CREATE TABLE `ys_friendship` (
  `fid` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `user_id` int(11) DEFAULT '0' COMMENT '用户id',
  `friend_id` int(11) NOT NULL DEFAULT '0' COMMENT '好友ID',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `createtime` int(11) DEFAULT '0' COMMENT '创建时间',
  `updatetime` int(11) DEFAULT '0' COMMENT '修改时间',
  `isdel` tinyint(1) DEFAULT '0' COMMENT '逻辑删除字段，0不删除1已删除',
  PRIMARY KEY (`fid`,`friend_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='好友关系';

-- ----------------------------
-- Records of ys_friendship
-- ----------------------------
INSERT INTO `ys_friendship` VALUES ('1', '1', '2', '2', '1491637955', '1491637955', '1');
INSERT INTO `ys_friendship` VALUES ('2', '1', '3', '1', '1491637955', '1491637955', '0');
INSERT INTO `ys_friendship` VALUES ('3', '1', '4', '2', '1491637955', '1491637955', '0');
INSERT INTO `ys_friendship` VALUES ('4', '3', '2', '2', '1491637955', '1491637955', '0');

-- ----------------------------
-- Table structure for ys_groupconfig
-- ----------------------------
DROP TABLE IF EXISTS `ys_groupconfig`;
CREATE TABLE `ys_groupconfig` (
  `can_make` tinyint(1) NOT NULL COMMENT '创建群组 1开启 -1关闭',
  `need_audit` tinyint(1) NOT NULL COMMENT '是否审核 1是 -1否',
  `max_num` int(2) NOT NULL COMMENT '可创建的群组数量',
  `max_join` int(3) NOT NULL COMMENT '最大可加入群组数'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ys_groupconfig
-- ----------------------------

-- ----------------------------
-- Table structure for ys_groupdetail
-- ----------------------------
DROP TABLE IF EXISTS `ys_groupdetail`;
CREATE TABLE `ys_groupdetail` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(155) NOT NULL,
  `user_avatar` varchar(155) NOT NULL,
  `user_sign` varchar(155) NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ys_groupdetail
-- ----------------------------
INSERT INTO `ys_groupdetail` VALUES ('2', '马云', 'http://tp4.sinaimg.cn/2145291155/180/5601307179/1', '让天下没有难写的代码', '3');

-- ----------------------------
-- Table structure for ys_message
-- ----------------------------
DROP TABLE IF EXISTS `ys_message`;
CREATE TABLE `ys_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '信息的id',
  `content` varchar(255) NOT NULL COMMENT '消息内容',
  `uid` int(11) NOT NULL COMMENT '接收人用户id',
  `from` int(11) NOT NULL COMMENT '发送人用户id',
  `from_group` int(11) NOT NULL DEFAULT '0' COMMENT '默认消息来源群组id',
  `type` tinyint(1) NOT NULL COMMENT '消息类型 1用户消息 2系统消息',
  `remark` varchar(255) NOT NULL COMMENT '附加消息',
  `href` varchar(255) DEFAULT NULL COMMENT '消息跳转',
  `read` tinyint(1) DEFAULT '1' COMMENT '消息阅读状态 1未读 2已读',
  `time` int(11) NOT NULL COMMENT '消息发送时间',
  `agree` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否同意 0默认 1同意 2拒绝',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ys_message
-- ----------------------------
INSERT INTO `ys_message` VALUES ('1', '申请添加你为好友', '1', '2', '1', '1', '我是马云', null, '2', '1484619897', '2');
INSERT INTO `ys_message` VALUES ('2', '凤姐 已经同意你的好友申请', '1', '0', '1', '2', '0', null, '2', '1484621804', '0');
INSERT INTO `ys_message` VALUES ('5', '纸飞机 拒绝了你的好友申请', '2', '0', '0', '2', '', null, '2', '1484633574', '0');
INSERT INTO `ys_message` VALUES ('6', '申请添加你为好友', '22', '1', '1', '1', '我是纸飞机', null, '2', '1484636337', '1');
INSERT INTO `ys_message` VALUES ('7', '你们哈 已经同意你的好友申请', '1', '0', '1', '2', '', null, '2', '1484636440', '0');
INSERT INTO `ys_message` VALUES ('8', '申请添加你为好友', '1', '2', '1', '1', '我是马云', null, '2', '1484792006', '1');
INSERT INTO `ys_message` VALUES ('9', '纸飞机 已经同意你的好友申请', '2', '0', '1', '2', '', null, '2', '1484792165', '0');
INSERT INTO `ys_message` VALUES ('10', '申请添加你为好友', '2', '1', '1', '1', '我是纸飞机', null, '2', '1484800805', '1');
INSERT INTO `ys_message` VALUES ('11', '马云 已经同意你的好友申请', '1', '0', '1', '2', '', null, '2', '1484800910', '0');
INSERT INTO `ys_message` VALUES ('12', '申请添加你为好友', '22', '23', '1', '1', '', null, '1', '1491556830', '0');
INSERT INTO `ys_message` VALUES ('13', '申请添加你为好友', '23', '24', '1', '1', '', null, '2', '1491559686', '1');
INSERT INTO `ys_message` VALUES ('14', 'admin 已经同意你的好友申请', '24', '0', '1', '2', '', null, '2', '1491559849', '0');

-- ----------------------------
-- Table structure for ys_nav
-- ----------------------------
DROP TABLE IF EXISTS `ys_nav`;
CREATE TABLE `ys_nav` (
  `navid` int(11) NOT NULL AUTO_INCREMENT COMMENT '栏目id',
  `pid` int(11) DEFAULT '0' COMMENT '父级id',
  `title` varchar(255) DEFAULT '' COMMENT '标题',
  `level` int(11) DEFAULT '0' COMMENT '排序',
  `createtime` int(11) DEFAULT '0' COMMENT '创建时间',
  `updatetime` int(11) DEFAULT '0' COMMENT '修改时间',
  `isdel` tinyint(1) DEFAULT '0' COMMENT '逻辑删除字段，默认0不删除，1已删除',
  `type` tinyint(1) DEFAULT '0' COMMENT '类型',
  `content` text COMMENT '正文内容',
  PRIMARY KEY (`navid`)
) ENGINE=MyISAM AUTO_INCREMENT=75 DEFAULT CHARSET=utf8 COMMENT='栏目';

-- ----------------------------
-- Records of ys_nav
-- ----------------------------
INSERT INTO `ys_nav` VALUES ('1', '0', '知识', '1', '0', '0', '0', '0', null);
INSERT INTO `ys_nav` VALUES ('2', '0', '商务', '1', '3', '0', '0', '0', null);
INSERT INTO `ys_nav` VALUES ('3', '0', '关于我们', '1', '7', '0', '0', '0', '');
INSERT INTO `ys_nav` VALUES ('4', '3', '私募介绍', '2', '1', '0', '0', '4', 'aboutdetail');
INSERT INTO `ys_nav` VALUES ('6', '3', '帮助中心', '2', '1', '0', '0', '4', 'aboutdetail');
INSERT INTO `ys_nav` VALUES ('7', '3', '服务协议', '2', '7', '0', '0', '4', 'aboutdetail');
INSERT INTO `ys_nav` VALUES ('31', '1', '固定收益', '2', '1', '0', '0', '2', null);
INSERT INTO `ys_nav` VALUES ('32', '1', '阳光私募', '2', '0', '0', '0', '2', null);
INSERT INTO `ys_nav` VALUES ('37', '1', '股权投资', '2', '2', '0', '0', '2', null);
INSERT INTO `ys_nav` VALUES ('38', '2', '需求对接', '2', '0', '0', '0', '3', null);
INSERT INTO `ys_nav` VALUES ('39', '2', '活动发布', '2', '0', '0', '0', '0', null);
INSERT INTO `ys_nav` VALUES ('40', '38', '渠道合作', '3', '1', '0', '0', '0', null);
INSERT INTO `ys_nav` VALUES ('41', '38', '项目对接', '3', '0', '0', '0', '0', null);
INSERT INTO `ys_nav` VALUES ('42', '38', '资金需求', '3', '1', '0', '0', '0', null);
INSERT INTO `ys_nav` VALUES ('43', '38', '综合需求', '3', '0', '0', '0', '0', null);
INSERT INTO `ys_nav` VALUES ('44', '39', '进行中', '3', '1', '0', '0', '0', null);
INSERT INTO `ys_nav` VALUES ('48', '39', '已完成', '3', '7', '0', '0', '0', null);

-- ----------------------------
-- Table structure for ys_orders
-- ----------------------------
DROP TABLE IF EXISTS `ys_orders`;
CREATE TABLE `ys_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '用户id',
  `pay_type` varchar(10) NOT NULL DEFAULT '' COMMENT '支付方式',
  `amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '总金额',
  `createtime` int(11) DEFAULT '0' COMMENT '创建时间',
  `updatetime` int(11) DEFAULT '0' COMMENT '修改时间',
  `is_pay` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '支付状态1已支付0未支付',
  `memo` varchar(255) DEFAULT '0' COMMENT '订单备注',
  `isdel` tinyint(1) DEFAULT '0' COMMENT '逻辑删除字段，0不删除，1已删除',
  `mobile` varchar(255) DEFAULT '' COMMENT '电话号码',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='订单';

-- ----------------------------
-- Records of ys_orders
-- ----------------------------
INSERT INTO `ys_orders` VALUES ('1', '1', '微信', '22342.00', '1491637955', '1491637955', '0', '1', '奥好的', '0', '');
INSERT INTO `ys_orders` VALUES ('2', '1', '微信', '22342.00', '1491637955', '1491637955', '0', '1', '奥好的', '0', '');
INSERT INTO `ys_orders` VALUES ('3', '1', '微信', '22342.00', '1491637955', '1491637955', '0', '1', '奥好的', '0', '');
INSERT INTO `ys_orders` VALUES ('4', '1', '微信', '22342.00', '1491637955', '1491637955', '0', '1', '奥好的', '0', '');

-- ----------------------------
-- Table structure for ys_province
-- ----------------------------
DROP TABLE IF EXISTS `ys_province`;
CREATE TABLE `ys_province` (
  `pid` int(11) NOT NULL AUTO_INCREMENT COMMENT '省份id',
  `province` varchar(50) DEFAULT '' COMMENT '省份',
  `isdel` tinyint(1) DEFAULT '0' COMMENT '逻辑删除字段，默认0不删除，1已删除',
  PRIMARY KEY (`pid`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8 COMMENT='省份';

-- ----------------------------
-- Records of ys_province
-- ----------------------------
INSERT INTO `ys_province` VALUES ('1', '北京市', '0');
INSERT INTO `ys_province` VALUES ('2', '天津市', '0');
INSERT INTO `ys_province` VALUES ('3', '河北省', '0');
INSERT INTO `ys_province` VALUES ('4', '山西省', '0');
INSERT INTO `ys_province` VALUES ('5', '内蒙古自治区', '0');
INSERT INTO `ys_province` VALUES ('6', '辽宁省', '0');
INSERT INTO `ys_province` VALUES ('7', '吉林省', '0');
INSERT INTO `ys_province` VALUES ('8', '黑龙江省', '0');
INSERT INTO `ys_province` VALUES ('9', '上海市', '0');
INSERT INTO `ys_province` VALUES ('10', '江苏省', '0');
INSERT INTO `ys_province` VALUES ('11', '浙江省', '0');
INSERT INTO `ys_province` VALUES ('12', '安徽省', '0');
INSERT INTO `ys_province` VALUES ('13', '福建省', '0');
INSERT INTO `ys_province` VALUES ('14', '江西省', '0');
INSERT INTO `ys_province` VALUES ('15', '山东省', '0');
INSERT INTO `ys_province` VALUES ('16', '河南省', '0');
INSERT INTO `ys_province` VALUES ('17', '湖北省', '0');
INSERT INTO `ys_province` VALUES ('18', '湖南省', '0');
INSERT INTO `ys_province` VALUES ('19', '广东省', '0');
INSERT INTO `ys_province` VALUES ('20', '广西壮族自治区', '0');
INSERT INTO `ys_province` VALUES ('21', '海南省', '0');
INSERT INTO `ys_province` VALUES ('22', '重庆市', '0');
INSERT INTO `ys_province` VALUES ('23', '四川省', '0');
INSERT INTO `ys_province` VALUES ('24', '贵州省', '0');
INSERT INTO `ys_province` VALUES ('25', '云南省', '0');
INSERT INTO `ys_province` VALUES ('26', '西藏自治区', '0');
INSERT INTO `ys_province` VALUES ('27', '陕西省', '0');
INSERT INTO `ys_province` VALUES ('28', '甘肃省', '0');
INSERT INTO `ys_province` VALUES ('29', '青海省', '0');
INSERT INTO `ys_province` VALUES ('30', '宁夏回族自治区', '0');
INSERT INTO `ys_province` VALUES ('31', '新疆维吾尔自治区', '0');
INSERT INTO `ys_province` VALUES ('32', '香港特别行政区', '0');
INSERT INTO `ys_province` VALUES ('33', '澳门特别行政区', '0');
INSERT INTO `ys_province` VALUES ('34', '台湾省', '0');

-- ----------------------------
-- Table structure for ys_user
-- ----------------------------
DROP TABLE IF EXISTS `ys_user`;
CREATE TABLE `ys_user` (
  `uid` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '用户id',
  `uuid` varchar(255) NOT NULL DEFAULT '' COMMENT '用户唯一标识，即时通讯需要用',
  `username` varchar(255) NOT NULL DEFAULT '' COMMENT '用户名',
  `password` varchar(255) NOT NULL DEFAULT '' COMMENT '密码',
  `nickname` varchar(255) DEFAULT '' COMMENT '昵称',
  `headimg` varchar(255) DEFAULT '' COMMENT '头像',
  `show` tinyint(1) DEFAULT '1' COMMENT '是否公开1公开0不公开',
  `email` varchar(255) DEFAULT NULL COMMENT '邮箱',
  `createtime` int(11) DEFAULT '0' COMMENT '注册时间',
  `updatetime` int(11) DEFAULT '0' COMMENT '最后更新时间',
  `regip` varchar(255) DEFAULT '0' COMMENT '注册IP',
  `status` tinyint(1) DEFAULT '1' COMMENT '状态 0禁用，1启用，2删除',
  `vip` tinyint(1) DEFAULT '0' COMMENT '默认0普通，1vip',
  `type` tinyint(1) DEFAULT '0' COMMENT '默认0个人，1认证机构',
  `lastlogin` int(11) DEFAULT '0' COMMENT '最后登录时间',
  `wechatopenid` varchar(255) DEFAULT '' COMMENT '微博openid',
  `wechat` int(11) DEFAULT '0' COMMENT '微信号',
  `qq` int(11) DEFAULT '0' COMMENT 'qq号',
  `company` varchar(255) DEFAULT NULL COMMENT '公司名称',
  `score` int(11) DEFAULT '0' COMMENT '积分',
  `pid` int(11) DEFAULT '0' COMMENT '省份',
  `cityid` int(11) DEFAULT '0' COMMENT '城市',
  `workid` int(11) DEFAULT '0' COMMENT '职务id',
  `workname` varchar(255) DEFAULT NULL COMMENT '职务',
  `hangye` varchar(255) DEFAULT NULL COMMENT '行业',
  `sex` tinyint(1) DEFAULT '0' COMMENT '性别，1男，0女',
  `introduce` varchar(255) DEFAULT NULL COMMENT '简介',
  `isdel` tinyint(1) DEFAULT '0' COMMENT '逻辑删除字段，默认0不删除，1已经删除',
  `sign` varchar(255) DEFAULT '' COMMENT '个性签名',
  `tag` varchar(255) DEFAULT '' COMMENT '标签',
  `certify` tinyint(1) DEFAULT '0' COMMENT '机构认证0未申请 1通过 2审核中 3未通过',
  `city` varchar(255) DEFAULT '' COMMENT '城市',
  `province` varchar(255) DEFAULT '' COMMENT '省',
  `mobile` varchar(255) DEFAULT '' COMMENT '电话号码',
  `certifyimgurl` varchar(255) DEFAULT NULL COMMENT '认证机构营业执照',
  `systemadmin` varchar(255) DEFAULT '',
  `systemtype` varchar(255) DEFAULT NULL COMMENT '0,普通用户，1普通管理员，2超级管理员',
  `chatstatus` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COMMENT='用户表';

-- ----------------------------
-- Records of ys_user
-- ----------------------------
INSERT INTO `ys_user` VALUES ('1', '', '', '', '船长', 'http://wx.qlogo.cn/mmopen/vDwntJFbiafvIMib1wrzzial5zHGeP3Xwy8nVFnLxkYUhdgVRgaH4J2JXnicWCZFQCO883nB7JiaGMp15kZ5qo9gchA/0', '0', '333@qq.com', '1491633310', '0', '0', '1', '0', '0', '1491633865', 'oA0maw_jK4yEN8qw_dcXkk9TudJ8', '0', '0', '34234', '0', '0', '0', '0', '2342', '324234', '1', '', '0', '123', '', '2', '', '', '234234', '20170411/0d97deb8ba1e9a931eae0e952ef183e9.jpg', '', '', '0');
INSERT INTO `ys_user` VALUES ('2', '', '', '', '安', 'http://wx.qlogo.cn/mmopen/PiajxSqBRaEKrI3kSvqkv2jyTc8xPCaTQPU05O2sf9GSImkcnWhwiaW3uwpUIiaJGvN1zoT42lIzJYBRG4Iw8vic7Q/0', '1', null, '1491633317', '0', '0', '1', '0', '0', '1491633811', 'oA0mawxaPnbr7BeDx086lRbzH7Ro', '0', '0', null, '0', '0', '0', '0', null, null, '1', null, '0', '', '', '0', '', '', '', null, '', null, '0');
INSERT INTO `ys_user` VALUES ('3', '', '', '', '曉怡Tt.', 'http://wx.qlogo.cn/mmopen/JxCCGvfj8iaw1auk1rdo3pUCTBlVQUWPjHbw0lW8WicEnTt54HkUlpqIPbfKp0ZxOy8q6gXEvCGRJUHsm9picyqnOkdE19KYX6V/0', '1', null, '1491633329', '0', '0', '1', '0', '0', '1491633825', 'oA0maw5ctEZPGcz2ID6XIykIXdC4', '0', '0', null, '0', '0', '0', '0', null, null, '2', null, '0', '', '', '0', '', '', '', null, '', null, '0');
INSERT INTO `ys_user` VALUES ('4', '', '', '', '取什么名呢', 'http://wx.qlogo.cn/mmopen/IcGGEI76Saa8PR9miap1BycgEseENPPJdt1qXwOJrp79AmBGFIWYVqOGGicxXIiauus9dZWr1Qw3ocwSYZQ2xBVIpWkTQVla8rA/0', '1', null, '1491633348', '0', '0', '1', '0', '0', '1491633791', 'oA0maw-gvfw09XqZWwqLBYK2gu-Y', '0', '0', null, '0', '0', '0', '0', null, null, '1', null, '0', '', '', '0', '', '', '', null, '', null, '0');

-- ----------------------------
-- Table structure for ys_userlog
-- ----------------------------
DROP TABLE IF EXISTS `ys_userlog`;
CREATE TABLE `ys_userlog` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(255) DEFAULT '' COMMENT '系统唯一标识符',
  `ipaddress` varchar(255) DEFAULT '' COMMENT 'IP地址',
  `loginmode` tinyint(1) DEFAULT '0' COMMENT '登录方式',
  `equipment` varchar(255) DEFAULT '' COMMENT '设备信息',
  `logintime` int(11) DEFAULT '0' COMMENT '登录时间',
  `status` tinyint(1) DEFAULT '1' COMMENT '状态1正常0异常',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=173 DEFAULT CHARSET=utf8 COMMENT='用户登录日记';

-- ----------------------------
-- Records of ys_userlog
-- ----------------------------

-- ----------------------------
-- Table structure for ys_worktype
-- ----------------------------
DROP TABLE IF EXISTS `ys_worktype`;
CREATE TABLE `ys_worktype` (
  `workid` int(11) NOT NULL AUTO_INCREMENT COMMENT '职务id',
  `name` varchar(255) NOT NULL DEFAULT '0' COMMENT '职务名称',
  `level` int(11) DEFAULT '0' COMMENT '排序',
  `createtime` int(11) DEFAULT '0' COMMENT '创建时间',
  `updatetime` int(11) DEFAULT '0' COMMENT '修改时间',
  `isdel` tinyint(1) DEFAULT '0' COMMENT '逻辑删除字段，默认0不删除，1已删除',
  PRIMARY KEY (`workid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='职务';

-- ----------------------------
-- Records of ys_worktype
-- ----------------------------
INSERT INTO `ys_worktype` VALUES ('1', '私募新人', '1', '1491634440', '1491634440', '0');
INSERT INTO `ys_worktype` VALUES ('2', '公司白领', '2', '1491634440', '1491634440', '0');
INSERT INTO `ys_worktype` VALUES ('3', 'CEO', '3', '1491634440', '1491634440', '0');
