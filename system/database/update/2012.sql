DROP TABLE IF EXISTS `website_app`;
CREATE TABLE `website_app` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `date` datetime DEFAULT NULL COMMENT '时间',
  `name` varchar(150) NOT NULL COMMENT '名称',
  `notice` text NOT NULL COMMENT '通知',
  `text` text NOT NULL COMMENT '描述',
  `status` int(1) NOT NULL DEFAULT 1 COMMENT '状态',
  `expand` text NOT NULL COMMENT '扩展',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='授权程序列表';