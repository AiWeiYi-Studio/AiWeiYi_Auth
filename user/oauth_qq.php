<?php 
include("../system/core/core.php");
$text = $_GET['text'];
$query = base64_decode($text, true);
$content = json_decode($query, true);
$url = $siteurl.'oauth_qq.php';
$token = $content['social_uid'];
if($islogins==1){}else exit("<script language='javascript'>window.location.href='./login_index.php?go_url=".get_url_last()."';</script>");
if($conf['site_active']=='1'){
    sysmsg('<h2>网站维护已开启</h2><ul><li><font size="4">'.$conf['site_active_notice'].'</font></li>',true);
}
    
// 官方快捷登录接口
if($conf['oauth_api_qq']=='1'){
    $url = '../system/plugin/Oauth_QQ/connect.php?callback='.$url;

// 彩虹免签登录接口
}elseif($conf['oauth_api_qq']=='2'){
    $url = '../system/plugin/Oauth_Clogin/connect.php?callback='.$url.'&type=qq';
}

if(!$token){
    header('location: '.$url.'');
}else{
$row = $DB->get_row("SELECT * FROM website_user WHERE oauth_qq='$token' limit 1");
$sql="update website_user set oauth_qq='$token' where user='{$udata['user']}'";
if($row){
    exit("<script language='javascript'>alert('当前QQ已被绑定');window.location.href='./my_info.php';</script>");
}elseif($DB->query($sql)){
    exit("<script language='javascript'>alert('绑定QQ快捷登录成功');window.location.href='./my_oauth.php';</script>");
	}else{
	exit("<script language='javascript'>alert('绑定QQ快捷登录失败".$DB->error()."');window.location.href='./my_info.php';</script>");
	}
}