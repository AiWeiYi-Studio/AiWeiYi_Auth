DROP TABLE IF EXISTS `website_visit`;
CREATE TABLE `website_visit` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `date` datetime DEFAULT NULL COMMENT '时间',
  `ip` varchar(150) NOT NULL COMMENT 'IP',
  `type` varchar(150) NOT NULL COMMENT '访问类型',
  `url_limit` varchar(150) NOT NULL COMMENT '访问路径',
  `url_all` varchar(150) NOT NULL COMMENT '访问域名路径',
  `text` text NOT NULL COMMENT '备注',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='网站访问记录';