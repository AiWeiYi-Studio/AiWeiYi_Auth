DROP TABLE IF EXISTS `website_legal`;
CREATE TABLE `website_legal` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '唯一ID',
  `date` datetime DEFAULT NULL COMMENT '添加时间',
  `time` datetime DEFAULT NULL COMMENT '到期时间',
  `uuid` varchar(150) NOT NULL COMMENT '唯一识别码',
  `ip` varchar(150) NOT NULL COMMENT '授权IP',
  `authcode` varchar(150) NOT NULL COMMENT '授权码',
  `token` varchar(150) NOT NULL COMMENT '程序密码',
  `contact` varchar(150) NOT NULL COMMENT '联系方式',
  `user` varchar(150) NOT NULL COMMENT '隶属用户',
  `memo` varchar(150) NOT NULL COMMENT '备注',
  `active` int(1) NOT NULL DEFAULT 1 COMMENT '授权状态',
  PRIMARY KEY  (`id`,`authcode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='正版授权列表';

DROP TABLE IF EXISTS `website_pirate`;
CREATE TABLE `website_pirate` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '唯一ID',
  `uuid` varchar(150) NOT NULL COMMENT '唯一识别码',
  `contact` varchar(255) NOT NULL COMMENT '联系方式',
  `version` varchar(150) NOT NULL COMMENT '版本号',
  `edition` varchar(150) NOT NULL COMMENT '版本',
  `ip` varchar(150) NOT NULL COMMENT '盗版IP',
  `date` datetime DEFAULT NULL COMMENT '添加时间',
  `time` datetime DEFAULT NULL COMMENT '更新时间',
  `app` int(11) DEFAULT NULL COMMENT '盗版程序',
  `authcode` varchar(150) NOT NULL COMMENT '盗版码',
  `expand_1` varchar(150) NOT NULL COMMENT '扩展1',
  `expand_2` varchar(150) NOT NULL COMMENT '扩展2',
  `expand_3` varchar(150) NOT NULL COMMENT '扩展3',
  `expand_4` varchar(150) NOT NULL COMMENT '扩展4',
  `expand_5` varchar(150) NOT NULL COMMENT '扩展5',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='盗版授权列表';