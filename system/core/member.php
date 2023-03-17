<?php
/*
* @Time    : 2022/05/22 20:57
* @Author  : 爱唯逸网络科技
* @Mail    : support@857xx.cn
* @Site    : https://web.857xx.cn
* @File    : member.php
* @Action  : 用户登录
*/

if(!defined('IN_CRONLITE'))exit();

$clientip=real_ip($conf['site_ip']?$conf['site_ip']:0);
//站长
if(isset($_COOKIE["token_admin"])){
    $token=authcode(daddslashes($_COOKIE['token_admin']), 'DECODE', SYS_KEY);
    list($user, $sid) = explode("\t", $token);
    $udata = $DB->get_row("SELECT * FROM website_user WHERE user='$user' and type='admin' limit 1");
    $session=md5($udata['user'].$udata['pass'].$password_hash);
	if($session==$sid){
		$islogin=1;
	}
}
//用户
if(isset($_COOKIE["token_user"])){
    $token=authcode(daddslashes($_COOKIE['token_user']), 'DECODE', SYS_KEY);
    list($user, $sid) = explode("\t", $token);
    $udata = $DB->get_row("SELECT * FROM website_user WHERE user='$user' limit 1");
    $session=md5($udata['user'].$udata['pass'].$password_hash);
	if($session==$sid){
		$islogins=1;
	}
}
?>