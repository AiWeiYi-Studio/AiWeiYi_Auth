<?php
/*
* @Time    : 2022/05/22 20:57
* @Author  : 爱唯逸网络科技
* @Mail    : support@857xx.cn
* @Site    : https://web.857xx.cn
* @File    : auth_name.php
* @Action  : 程序昵称配置
*/

// 引入核心文件
include("../system/core/core.php");

// 副标题
$title='站长登录';

// 获取模板文件
if(!file_exists(CORE.'template/admin/login/'.$conf['template_admin_login'].'/index.php')){
	$result = file_get_contents(CORE."template/admin/login/LayuiAdmin/index.json");
	$arr = json_decode($result,true);
    include_once CORE.'template/admin/login/LayuiAdmin/index.php';
}else{
	// 获取模板配置信息
	$result = file_get_contents(CORE."template/admin/login/".$conf['template_user_login']."/index.json");
	$arr = json_decode($result,true);
    include_once CORE.'template/admin/login/'.$conf['template_admin_login'].'/index.php';
}
?>