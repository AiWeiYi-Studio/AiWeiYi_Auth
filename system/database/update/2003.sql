DROP TABLE IF EXISTS `website_plugin`;
CREATE TABLE `website_plugin` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `path` text NOT NULL COMMENT '目录',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='插件';