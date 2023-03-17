DROP TABLE IF EXISTS `website_update`;
CREATE TABLE `website_update` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `date` datetime DEFAULT NULL COMMENT '添加时间',
  `edition` varchar(150) NOT NULL COMMENT '版本',
  `version` varchar(150) NOT NULL  COMMENT '版本号',
  `download` varchar(150) NOT NULL COMMENT '下载链接',
  `log` text NOT NULL COMMENT '更新日志',
  `text` text NOT NULL COMMENT '备注',
  `app` varchar(150) NOT NULL COMMENT '隶属程序',
  `status` int(1) NOT NULL DEFAULT 1 COMMENT '状态',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='更新包';
    
ALTER TABLE `website_app`
ADD COLUMN `download` varchar(150) NOT NULL  COMMENT '安装包' AFTER `text`,
ADD COLUMN `money` decimal(22,2) DEFAULT NULL  COMMENT '售价' AFTER `download`,
ADD COLUMN `notice_pirate` varchar(150) NOT NULL COMMENT '盗版提示' AFTER `money`,
ADD COLUMN `notice_not` varchar(150) NOT NULL COMMENT '未授权提示' AFTER `notice_pirate`,
ADD COLUMN `notice_date` varchar(150) NOT NULL COMMENT '到期提示' AFTER `notice_not`,
ADD COLUMN `notice_status` varchar(150) NOT NULL COMMENT '封禁提示' AFTER `notice_date`;