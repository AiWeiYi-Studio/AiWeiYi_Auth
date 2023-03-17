ALTER TABLE `website_update`
ADD COLUMN `beta` int(1) NOT NULL DEFAULT 0 COMMENT '测试版' AFTER `app`,
ADD COLUMN `type` int(1) NOT NULL DEFAULT 0 COMMENT '更新方式' AFTER `beta`;