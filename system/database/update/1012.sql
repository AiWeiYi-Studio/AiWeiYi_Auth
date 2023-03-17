DROP TABLE IF EXISTS `website_code`;
CREATE TABLE `website_code` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '唯一ID',
  `code` varchar(32) NOT NULL COMMENT '验证码',
  `text` text NOT NULL COMMENT '内容',
  `date` datetime DEFAULT NULL COMMENT '时间',
  `ip` varchar(20) NOT NULL COMMENT 'IP',
  `type` varchar(150) NOT NULL COMMENT '类型',
  `send` varchar(150) NOT NULL COMMENT '联系',
  `user` varchar(150) NOT NULL COMMENT '用户',
  `types` varchar(150) NOT NULL COMMENT '账号类型',
  `active` int(1) NOT NULL DEFAULT 1 COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='验证码';