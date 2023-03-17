DROP TABLE IF EXISTS `website_find`;
CREATE TABLE `website_find` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `time` varchar(150) NOT NULL COMMENT '时间戳',
  `token` varchar(150) NOT NULL UNIQUE COMMENT '密钥',
  `uid` varchar(150) NOT NULL COMMENT '用户',
  `ip` varchar(150) NOT NULL COMMENT 'IP',
  `active` int(1) NOT NULL DEFAULT 1 COMMENT '状态',
  PRIMARY KEY  (`id`,`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='找回密码';