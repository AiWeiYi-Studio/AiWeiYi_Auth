DROP TABLE IF EXISTS `website_log`;
CREATE TABLE `website_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '唯一ID',
  `uid` varchar(150) NOT NULL COMMENT '用户UID',
  `ip` varchar(20) NOT NULL COMMENT '操作IP',
  `city` varchar(150) NOT NULL COMMENT '操作城市',
  `type` varchar(150) NOT NULL COMMENT '操作类型',
  `content` varchar(150) NOT NULL COMMENT '操作内容',
  `date` datetime DEFAULT NULL COMMENT '操作时间',
  `user` varchar(150) NOT NULL COMMENT '账号类型',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='操作日志';