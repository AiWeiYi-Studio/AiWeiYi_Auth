DROP TABLE IF EXISTS `website_class_book`;
CREATE TABLE `website_class_book` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(150) NOT NULL COMMENT '名称',
  `title` varchar(150) NOT NULL COMMENT '描述',
  `img` varchar(150) NOT NULL COMMENT '大头图',
  `date` datetime DEFAULT NULL COMMENT '时间',
  `number` varchar(150) NOT NULL COMMENT '查看次数',
  `status` int(1) NOT NULL DEFAULT 1 COMMENT '状态',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='知识文档分类';

DROP TABLE IF EXISTS `website_book`;
CREATE TABLE `website_book` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `class` varchar(150) NOT NULL COMMENT '分类ID',
  `name` varchar(150) NOT NULL COMMENT '名称',
  `text` text NOT NULL COMMENT '内容',
  `date` datetime DEFAULT NULL COMMENT '时间',
  `number` varchar(150) NOT NULL COMMENT '查看次数',
  `status` int(1) NOT NULL DEFAULT 1 COMMENT '状态',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='知识文档';