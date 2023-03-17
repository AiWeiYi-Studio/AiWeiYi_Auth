ALTER TABLE `website_app`
CHANGE `money` `money_long` decimal(22,2) DEFAULT NULL COMMENT '永价',
ADD COLUMN `money_day` decimal(22,2) DEFAULT NULL COMMENT '日价' AFTER `money_long`,
ADD COLUMN `money_month` decimal(22,2) DEFAULT NULL COMMENT '月价' AFTER `money_day`,
ADD COLUMN `money_year` decimal(22,2) DEFAULT NULL COMMENT '年价' AFTER `money_month`;

ALTER TABLE `website_legal`
ADD COLUMN `beta` int(1) NOT NULL DEFAULT 0 COMMENT '内测';