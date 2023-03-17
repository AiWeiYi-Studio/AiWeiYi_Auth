<?php
include("../system/core/core.php");
$act=isset($_GET['act'])?daddslashes($_GET['act']):null;
if($islogins==1){}else exit('{"code":-1,"msg":"你还没有登录"}');
@header('Content-Type: application/json; charset=UTF-8');
switch($act){

case 'send_message':
    $colour=daddslashes($_POST['colour']);
    $message=daddslashes($_POST['message']);
    $city=get_ip_city($clientip);
    $sql="insert into `website_chat` (`colour`,`addtime`,`message`,`ip`,`city`,`user`,`active`,`type`) values ('".$colour."','".$date."','".$message."','".$clientip."','".$city."','".$udata['uid']."','1','user')";
    if(in_array($message,explode(",",$conf['chat_user_word']))){
    $DB->query("update website_user set active_chat='0' where uid='{$udata['uid']}'");
    exit('{"code":1,"msg":"发言存在违规，已被拉黑"}');
    }elseif($conf['chat_user_active']=='0'){
    exit('{"code":-1,"msg":"聊天功能已关闭"}');
    }elseif($DB->query($sql)){
    $city=get_ip_city($clientip);
	$DB->query("insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','发言','聊天室发言：".$message."','".$date."','user')");
	exit('{"code":1,"msg":"发送成功"}');
	}else{
	exit('{"code":-1,"msg":"发送失败！'.$DB->error().'"}');
	}
break;

case 'get_user_avatar':
    $uid = daddslashes($_GET['uid']);
    $row = $DB->get_row("SELECT * FROM website_user WHERE uid='{$uid}' limit 1");
    if($row){
        exit('{"code":1,"msg":"获取头像链接成功","avatar":"'.$row['avatar'].'"}');
	}else{
	    exit('{"code":-1,"msg":"用户不存在"}');
	}
break;

default:
	exit('{"code":-4,"msg":"No Act"}');
break;
}
?>