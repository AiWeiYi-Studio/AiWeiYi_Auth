DROP TABLE IF EXISTS `website_template`;
CREATE TABLE `website_template` (
  `uid` int(11) NOT NULL AUTO_INCREMENT COMMENT '唯一UID',
  `name` varchar(150) NOT NULL COMMENT '模板名字',
  `path` varchar(150) NOT NULL COMMENT '模板目录',
  `type` varchar(150) NOT NULL COMMENT '模板类型',
  PRIMARY KEY  (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='模板';

INSERT INTO `website_template`(`uid` , `name` , `path`, `type`) VALUES ('1' , '蓝色简约' , 'Bluestar' , 'index');