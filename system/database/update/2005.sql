DROP TABLE IF EXISTS `website_money_log`;
CREATE TABLE `website_money_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '唯一ID',
  `date` datetime NOT NULL COMMENT '时间',
  `type` varchar(150) NOT NULL COMMENT '类型',
  `money` decimal(24, 2) DEFAULT NULL COMMENT '金额',
  `money_old` decimal(24, 2) DEFAULT NULL COMMENT '原金额',
  `money_new` decimal(24, 2) DEFAULT NULL COMMENT '现金额',
  `user` varchar(150) NOT NULL COMMENT '用户',
  `trade_no` varchar(150) NOT NULL COMMENT '订单号',
  `ip` varchar(150) NOT NULL COMMENT 'IP',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='资金详情';