<?php
/*
* @Time    : 2022/05/22 20:57
* @Author  : 爱唯逸网络科技
* @Mail    : support@857xx.cn
* @Site    : https://web.857xx.cn
* @File    : login_weibo.php
* @Action  : 微博快捷登录
*/

// 引入系统核心文件
include("../system/core/core.php");

// 定义网页副标题
$title='微博快捷登录';

// 检测网站开启状态
if($conf['site_active']=='1'){
    sysmsg('<h2>网站维护已开启</h2><ul><li><font size="4">'.$conf['site_active_notice'].'</font></li>',true);

//检测QQ快捷登录开启状态
}elseif($conf['oauth_api_weibo']=='0'){
    sysmsg('<h2>系统未开启微博快捷登录功能</h2><ul><li><font size="4">'.$date.'</font></li>',true);
}

// 解析快捷登录返回数据
$text    = daddslashes($_GET['text']);
$query   = base64_decode($text, true);
$content = json_decode($query, true);
$token   = $content['social_uid'];
$url     = $siteurl.'login_weibo.php';

// 官方快捷登录接口
if($conf['oauth_api_weibo']=='1'){
    $url = '';

// 彩虹免签登录接口
}elseif($conf['oauth_api_weibo']=='2'){
    $url = '../system/plugin/Oauth_Clogin/connect.php?callback='.$url.'&type=sina';
}

// 如果Token不存在则跳转登录接口
if(!$token){
    header('location: '.$url.'');

// 反之则执行登录
}else{
    $row = $DB->get_row("SELECT * FROM website_user WHERE oauth_weibo = ".$token." limit 1");
    $user = $row['user'];
    $pass = $row['pass'];
    if($row && $row['active']==0){
        exit("<script language='javascript'>alert('当前账号已被禁止登陆');window.location.href='./';</script>");
    }elseif($row['oauth_qq']){
        $session=md5($user.$pass.$password_hash);
        $token=authcode("{$user}\t{$session}", 'ENCODE', SYS_KEY);
        setcookie("token_admin", $token, time() + 604800);
        exit("<script language='javascript'>alert('微博快捷登录成功');window.location.href='./';</script>");
	}else{
	    exit("<script language='javascript'>alert('当前微博未绑定账户');window.location.href='./';</script>");
	}
}
?>
