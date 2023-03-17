DROP TABLE IF EXISTS `website_class_workorder`;
CREATE TABLE `website_class_workorder` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(150) NOT NULL COMMENT '名称',
  `text` varchar(150) NOT NULL COMMENT '描述',
  `date` datetime DEFAULT NULL COMMENT '时间',
  `status` int(1) NOT NULL DEFAULT 1 COMMENT '状态',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='工单分类';

DROP TABLE IF EXISTS `website_workorder`;
CREATE TABLE `website_workorder` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `type` varchar(150) NOT NULL COMMENT '类型',
  `user` varchar(150) NOT NULL COMMENT '用户',
  `title` varchar(150) NOT NULL COMMENT '标题',
  `text` varchar(150) NOT NULL COMMENT '内容',
  `date_add` datetime DEFAULT NULL COMMENT '发起时间',
  `date_end` datetime DEFAULT NULL COMMENT '关闭时间',
  `status` int(1) NOT NULL DEFAULT 1 COMMENT '工单状态',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='工单分类';