<?php
/*
* @Time    : 2022/05/22 20:57
* @Author  : 爱唯逸网络科技
* @Mail    : support@857xx.cn
* @Site    : https://web.857xx.cn
* @File    : ajax_privacy.php
* @Action  : 悄悄话相关ajax
*/

include("../system/core/core.php");
$act=isset($_GET['act'])?daddslashes($_GET['act']):null;
if($islogins==1){}else exit('{"code":-1,"msg":"你还没有登录"}');
@header('Content-Type: application/json; charset=UTF-8');
switch($act){
    
case 'add':
    $text = daddslashes($_POST['text']);
    $time = daddslashes($_POST['time']);
    $number = daddslashes($_POST['number']);
    $mail = daddslashes($_POST['mail']);
    $active = daddslashes($_POST['active']);
    $sql = "insert into `website_privacy` (`date`,`time`,`text`,`token`,`user`,`ip`,`number`,`mail`,`active`) values ('".$date."','".strtotime($time)."','".$text."','".substr(get_token(),1,6)."','".$udata['uid']."','".$clientip."','".$number."','".$mail."','".$active."')";
    $log_sql = "insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','发布','发布悄悄话：".$text."','".$date."','user')";
    if(!$text){
        $result = array(
            "code"=>-1,
            "msg"=>"内容为空"
        );
    }elseif(!$time){
        $result = array(
            "code"=>-1,
            "msg"=>"到期时间为空"
        );
    }elseif(!$number){
        $result = array(
            "code"=>-1,
            "msg"=>"可查看次数为空"
        );
    }elseif(!$mail){
        $result = array(
            "code"=>-1,
            "msg"=>"邮箱通知状态不能为空"
        );
    }elseif($mail=='1' && !$udata['mail']){
        $result = array(
            "code"=>-1,
            "msg"=>"如需开启邮箱通知需要先绑定邮箱"
        );
    }elseif($mail=='1' && $udata['mail_time']-$number<0){
        $result = array(
            "code"=>-1,
            "msg"=>"您的邮件额度不足，请先购买额度"
        );
    }elseif($DB->query($sql) && $DB->query($log_sql)){
        $result = array(
            "code"=>1,
            "msg"=>"发布成功"
        );
	}else{
	    $result = array(
            "code"=>-1,
            "msg"=>$DB->error()
        );
	}
break;

case 'get_city':
    $id=daddslashes($_POST['id']);
    $row = $DB->get_row("SELECT * FROM website_privacy WHERE id = {$id} limit 1");
    if($row){
        $result = array(
            "code"=>1,
            "msg"=>get_ip_city($row['ip'])
        );
    }else{
        $result = array(
	        "code"=>-1,
            "msg"=>"记录不存在"
        );
    }
break;

case 'get_text':
    $id=daddslashes($_POST['id']);
    $row = $DB->get_row("SELECT * FROM website_privacy WHERE id = {$id} limit 1");
    if($row){
        $result = array(
            "code"=>1,
            "msg"=>$row['text']
        );
    }else{
        $result = array(
	        "code"=>-1,
            "msg"=>"记录不存在"
        );
    }
break;

case 'qrcode':
    $id=daddslashes($_POST['id']);
    $row = $DB->get_row("SELECT * FROM website_privacy WHERE id = '$id' limit 1");
    if(!$row){
        $result = array(
            "code"=>-1,
            "msg"=>"悄悄话不存在"
        );
    }else{
        $img = $siteurls.'system/plugin/AiWeiYi_Qrcode/index.php?url='.$siteurls.'privacy/'.$row['token'].'.html';
        $result = array(
            "code"=>1,
            "msg"=>"成功",
            "qrcode"=>$img
        );
	}
break;

default:
	$result = array(
	   "code"=>-1,
        "msg"=>"Not Act"
    );
break;
}
echo json_encode($result, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
?>