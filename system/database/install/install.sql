DROP TABLE IF EXISTS `website_config`;
create table `website_config` (
`k` varchar(150) NOT NULL COMMENT '字段',
`v` text DEFAULT NULL COMMENT '内容',
PRIMARY KEY  (`k`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='系统配置';

INSERT INTO `website_config` VALUES ('site_title', '爱唯逸网络科技');
INSERT INTO `website_config` VALUES ('site_keywords', '爱唯逸网络科技');
INSERT INTO `website_config` VALUES ('site_description', '爱唯逸网络科技');
INSERT INTO `website_config` VALUES ('site_jump', '0');
INSERT INTO `website_config` VALUES ('site_active', '0');
INSERT INTO `website_config` VALUES ('site_copyright', '爱唯逸网络科技');
INSERT INTO `website_config` VALUES ('system_version', '1000');

DROP TABLE IF EXISTS `website_user`;
CREATE TABLE `website_user` (
  `uid` int(11) NOT NULL AUTO_INCREMENT COMMENT '随机UID',
  `user` varchar(150) NOT NULL COMMENT '用户账号',
  `pass` varchar(150) NOT NULL COMMENT '用户密码',
  `name` varchar(150) NOT NULL COMMENT '用户昵称',
  `token` varchar(150) NOT NULL COMMENT '用户密钥',
  `qq` varchar(20) DEFAULT NULL COMMENT '联系QQ',
  `phone` varchar(20) DEFAULT NULL COMMENT '联系手机',
  `mail` varchar(150) NOT NULL COMMENT '联系邮箱',
  `reg_ip` varchar(150) DEFAULT NULL COMMENT '注册IP',
  `reg_city` varchar(150) DEFAULT NULL COMMENT '注册地址',
  `reg_time` datetime DEFAULT NULL COMMENT '添加时间',
  `login_time` datetime DEFAULT NULL COMMENT '登录时间',
  `login_ip` varchar(150) DEFAULT NULL COMMENT '上次登录IP',
  `client_ip` varchar(150) DEFAULT NULL COMMENT '绑定登录IP',
  `oauth_qq` varchar(150) NOT NULL COMMENT 'QQ快捷登录',
  `oauth_weixin` varchar(150) NOT NULL COMMENT '微信快捷登录',
  `oauth_weibo` varchar(150) NOT NULL COMMENT '微博快捷登录',
  `oauth_alipay` varchar(150) NOT NULL COMMENT '支付宝快捷登录',
  `money` decimal(24, 2) NOT NULL COMMENT '钱包',
  `integral` varchar(150) NOT NULL COMMENT '积分',
  `mail_time` varchar(150) NOT NULL COMMENT '邮件余额',
  `phone_time` varchar(150) NOT NULL COMMENT '短信余额',
  `type` varchar(150) NOT NULL COMMENT '账号类型',
  `active` int(1) NOT NULL DEFAULT '1' COMMENT '账户状态',
  `active_ip` int(1) NOT NULL DEFAULT '0' COMMENT 'IP白名单登录开关',
  PRIMARY KEY  (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='用户列表';