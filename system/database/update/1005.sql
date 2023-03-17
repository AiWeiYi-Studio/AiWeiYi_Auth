DROP TABLE IF EXISTS `website_pay`;
CREATE TABLE `website_pay` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '唯一ID',
  `trade_no` varchar(150) NOT NULL COMMENT '订单号',
  `type` varchar(150) NOT NULL COMMENT '支付类型',
  `addtime` datetime DEFAULT NULL COMMENT '创建时间',
  `endtime` datetime DEFAULT NULL COMMENT '结束时间',
  `name` varchar(150) NOT NULL COMMENT '订单昵称',
  `money` decimal(24, 2) DEFAULT NULL COMMENT '订单金额',
  `ip` varchar(150) NOT NULL COMMENT '创建IP',
  `city` varchar(150) NOT NULL COMMENT '创建城市',
  `domain` varchar(150) NOT NULL COMMENT '来源域名',
  `user` varchar(150) NOT NULL COMMENT '隶属用户',
  `status` int(1) NOT NULL DEFAULT 0 COMMENT '订单状况',
  `buy` int(1) NOT NULL DEFAULT 0 COMMENT '充值余额时为0',
  PRIMARY KEY (`id`,`trade_no`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COMMENT='支付订单';