DROP TABLE IF EXISTS `website_chat`;
CREATE TABLE `website_chat` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '唯一ID',
  `colour` varchar(150) NOT NULL COMMENT '字体颜色',
  `message` text NOT NULL COMMENT '信息内容',
  `addtime` datetime DEFAULT NULL COMMENT '创建时间',
  `ip` varchar(150) NOT NULL COMMENT '创建IP',
  `city` varchar(150) NOT NULL COMMENT '创建城市',
  `user` varchar(150) NOT NULL COMMENT '隶属用户',
  `type` varchar(150) NOT NULL COMMENT '账号类型',
  `active` int(1) NOT NULL DEFAULT 1 COMMENT '信息状况',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COMMENT='聊天室';

ALTER TABLE `website_user`
ADD COLUMN `active_chat` int(1) NOT NULL DEFAULT 1 COMMENT '发言权';