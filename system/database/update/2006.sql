DROP TABLE IF EXISTS `website_privacy`;
CREATE TABLE `website_privacy` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '唯一ID',
  `date` datetime DEFAULT NULL COMMENT '时间',
  `time` varchar(150) NOT NULL COMMENT '时间戳',
  `text` text NOT NULL COMMENT '内容',
  `token` varchar(150) NOT NULL UNIQUE COMMENT '密钥',
  `user` varchar(150) NOT NULL COMMENT '隶属',
  `ip` varchar(150) NOT NULL COMMENT 'IP',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='悄悄话';