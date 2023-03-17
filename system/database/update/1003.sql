DROP TABLE IF EXISTS `website_kami`;
CREATE TABLE `website_kami` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '唯一ID',
  `add_time` datetime DEFAULT NULL COMMENT '添加时间',
  `use_time` datetime DEFAULT NULL COMMENT '使用时间',
  `kami` varchar(150) NOT NULL COMMENT '卡密内容',
  `money` decimal(24, 2) DEFAULT NULL COMMENT '卡密金额',
  `use_user` varchar(150) NOT NULL COMMENT '使用者',
  `type` varchar(150) NOT NULL COMMENT '类型',
  `active` int(1) NOT NULL DEFAULT 0 COMMENT '使用情况',
  PRIMARY KEY  (`id`,`kami`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='卡密';