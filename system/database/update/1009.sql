DROP TABLE IF EXISTS `website_program`;
CREATE TABLE `website_program` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `time` datetime DEFAULT NULL COMMENT '时间',
  `name` varchar(150) NOT NULL COMMENT '名称',
  `title` varchar(150) NOT NULL COMMENT '简介',
  `text` text NOT NULL COMMENT '内容',
  `img` varchar(150) NOT NULL COMMENT '头图',
  `number` varchar(150) NOT NULL COMMENT '阅览',
  `author` varchar(150) NOT NULL COMMENT '作者',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='程序列表';