<?php 
include("../../core/core.php");
session_start();
header("Content-type: text/html; charset=utf-8");
require_once("./lib/QC.conf.php");
require_once("./lib/QC.class.php");
$QC = new QC($QC_config);
if(!$_GET){
    echo '无有效返回参数';
}elseif($_GET['code']){
    $access_token=$QC->qq_callback();
    $openid = $QC->get_openid($access_token);
    $userinfo = $QC->get_userinfo($openid, $access_token);
    $nickname = $userinfo['nickname'];
    $faceimg = $userinfo['figureurl_qq_2']?$userinfo['figureurl_qq_2']:$userinfo['figureurl_qq_1'];
	$faceimg = str_replace('http://','https://',$faceimg);
	$gender = $userinfo['gender'];
    $callback = base64_decode($_COOKIE["Moleft_QQLogin_CallBack"]);
    $result = array(
        'code'=>1,
        'msg'=>'succ',
        'type'=>'qq',
        'access_token'=>$access_token,
        'social_uid'=>$openid,
        'nickname'=>$nickname,
        'faceimg'=>$faceimg,
        'gender'=>$gender,
        'callback'=>$callback
    );
    $text = base64_encode(json_encode($result));
    header("Location: ".$callback."?text=".$text);
}
function base_encode($str) {
    $src = array("/", "+", "=");
    $dist = array("_a", "_b", "_c");
    $old = base64_encode($str);
    $new = str_replace($src, $dist, $old);
    return $new;
}
function base_decode($str) {
    $src = array("_a", "_b", "_c");
    $dist = array("/", "+", "=");
    $old = str_replace($src, $dist, $str);
    $new = base64_decode($old);
    return $new;
}
?>
