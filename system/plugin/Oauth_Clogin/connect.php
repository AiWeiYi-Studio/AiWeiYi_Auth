<?php
/** 
 * 插件名：彩虹聚合登录
 * 开发：爱唯逸网络科技工作室
 * 作者：2874992246
 **/
header("Content-type: text/html; charset=utf-8");
include("../../core/core.php");

$post_callback = $_GET['callback'];
$type = $_GET['type'];

$urlCookie = base64_encode($post_callback);
	
$callback = $siteurls.'system/plugin/Oauth_Clogin/callback.php';

$post = $conf['oauth_clogin_url'].'/connect.php?act=login&appid='.$conf['oauth_clogin_appid'].'&appkey='.$conf['oauth_clogin_appkey'].'&type='.$type.'&redirect_uri='.$callback.'&state='.$urlCookie;
$query = get_curl($post);
$info = json_decode($query,true);
if($info['code']=='0'){
    header("Location: ".$info['url']."");
}else{
    echo $info['msg'];
}
?>