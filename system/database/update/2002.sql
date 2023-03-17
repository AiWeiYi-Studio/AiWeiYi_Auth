DROP TABLE IF EXISTS `website_article`;
CREATE TABLE `website_article` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `time` datetime DEFAULT NULL COMMENT '时间',
  `title` varchar(150) NOT NULL COMMENT '名称',
  `titles` varchar(150) NOT NULL COMMENT '简介',
  `text` text NOT NULL COMMENT '内容',
  `img` varchar(150) NOT NULL COMMENT '头图',
  `number` varchar(150) NOT NULL DEFAULT 0 COMMENT '阅览',
  `author` varchar(150) NOT NULL COMMENT '作者',
  `active` int(1) NOT NULL DEFAULT 1 COMMENT '状态',
  `uid` varchar(150) NOT NULL COMMENT '排序',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='文章列表';