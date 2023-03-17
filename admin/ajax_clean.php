<?php
/*
* @Time    : 2022/05/22 20:57
* @Author  : 爱唯逸网络科技
* @Mail    : support@857xx.cn
* @Site    : https://web.857xx.cn
* @File    : ajax_clean.php
* @Action  : 系统清理相关ajax
*/

include("../system/core/core.php");
$act=isset($_GET['act'])?daddslashes($_GET['act']):null;
if($islogin==1){}else{$result = array("code"=>-1,"msg"=>"你还没有登录");}
@header('Content-Type: application/json; charset=UTF-8');
switch($act){
    
// 删除用户邮件附件
case 'clean_file_mail':
    $path = '../file/mail';
    if(delpath($path,1)){
        $result = ["code"=>1,"msg"=>"成功"];
    }else{
        $result = ["code"=>0,"msg"=>"失败：目录为空"];
    }
break;

case 'clean_file_log':
    $type = $_GET['type'];
    // 1为百度推送定时日志
    if($type=='1'){
        $path = '../file/log/cron/baidu/';
    }
    if(delfiles($path,1)){
        $result = ["code"=>1,"msg"=>"成功"];
    }else{
        $result = ["code"=>0,"msg"=>"失败：目录为空"];
    }
break;
    
case 'clean_log':
    $type = daddslashes($_GET['type']);
    // 1为系统日志，2为站长日志，3为用户日志
    if($type=='1'){
        $type='system';
    }elseif($type=='2'){
        $type='admin';
    }elseif($type=='3'){
        $type='user';
    }
    $sql="DELETE FROM website_log where user = '$type'";
    if(!$type){
        $result = ["code"=>0,"msg"=>"失败：清理类型为空"];
    }elseif($DB->query($sql)){
        $result = ["code"=>1,"msg"=>"成功"];
    }else{
        $result = ["code"=>0,"msg"=>"失败：".$DB->error().""];
    }
break;

case 'clean_kami':
    $type = daddslashes($_GET['type']);
    // 1为充值卡密
    if($type=='1'){
        $type='money';
    }
    $sql="DELETE FROM website_kami where type = '{$type}'";
    if(!$type){
        $result = ["code"=>0,"msg"=>"失败：清理类型为空"];
    }elseif($DB->query($sql)){
        $result = ["code"=>1,"msg"=>"成功"];
    }else{
        $result = ["code"=>0,"msg"=>"失败：".$DB->error().""];
    }
break;

default:
    $result = ["code"=>-4,"msg"=>"No Act"];
break;
}

echo json_encode($result);