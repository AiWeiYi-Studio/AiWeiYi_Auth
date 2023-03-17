<?php
/*
* @Time    : 2022/05/22 20:57
* @Author  : 爱唯逸网络科技
* @Mail    : support@857xx.cn
* @Site    : https://web.857xx.cn
* @File    : func_auth.php
* @Action  : 检测授权状态
*/

// 程序检测授权
function checkauth($url,$authcode,$type) {
	global $DB,$date,$conf;
	$ip = isset($_SERVER['ACE_VER'])?$_SERVER['HTTP_X_REAL_IP']:$_SERVER['REMOTE_ADDR'];
	$row=$DB->get_row("SELECT * FROM website_legal WHERE authcode = '$authcode' and type = '$type' limit 1");
	// 如果URL或authcode为空或type则返回false
	if(!$url || !$authcode || !$type){
	    return false;
	// 如果检索数据库查询不到相关信息则返回false
	}elseif(!$row){
	    return false;
	// 如果查询数据库成功且数据库域名等于递交的域名且
	}elseif($row && $row['url'] == $url){
	    return true;
	}
}
?>