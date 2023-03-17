ALTER TABLE `website_user`
ADD COLUMN `avatar_number` varchar(150) NOT NULL COMMENT '用户总头像数',
ADD COLUMN `active_mail` int(1) DEFAULT 0 COMMENT '邮箱通知开关',
ADD COLUMN `active_phone` int(1) DEFAULT 0 COMMENT '短信通知开关';