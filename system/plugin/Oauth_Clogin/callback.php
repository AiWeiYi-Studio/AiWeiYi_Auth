<?php
/** 
 * 插件名：彩虹聚合登录
 * 开发：爱唯逸网络科技工作室
 * 作者：2874992246
 **/
header("Content-type: text/html; charset=utf-8"); 
include("../../core/core.php");
$type = $_GET['type'];
$code = $_GET['code'];
$state = $_GET['state'];
$post = $conf['oauth_clogin_url'].'/connect.php?act=callback&appid='.$conf['oauth_clogin_appid'].'&appkey='.$conf['oauth_clogin_appkey'].'&type='.$type.'&code='.$code;
$query = get_curl($post);
$info = json_decode($query,true);
$access_token = $info['access_token'];
$social_uid = $info['social_uid'];
$faceimg = $info['faceimg']; //头像
$nickname = $info['nickname']; //昵称
$location = $info['location']; //地址
$gender = $info['gender']; //性别
$ip = $info['ip']; //IP
$callback = base64_decode($state);
$result = array(
    'code'=>1,
    'msg'=>'成功',
    'type'=>$type,
    'access_token'=>$access_token,
    'social_uid'=>$social_uid,
    'nickname'=>$nickname,
    'faceimg'=>$faceimg,
    'gender'=>$gender,
    'location'=>$location,
    'callback'=>$callback
    );
$text = base64_encode(json_encode($result));
header("Location: ".$callback."?text=".$text);
?>