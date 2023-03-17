<?php
/*
* @Time    : 2022/05/22 20:57
* @Author  : 爱唯逸网络科技
* @Mail    : support@857xx.cn
* @Site    : https://web.857xx.cn
* @File    : ajax_auth.php
* @Action  : 域名授权相关ajax
*/

include("../system/core/core.php");
$act=isset($_GET['act'])?daddslashes($_GET['act']):null;
if($islogins==1){}else exit('{"code":-1,"msg":"你还没有登录"}');
@header('Content-Type: application/json; charset=UTF-8');
switch($act){
    
case 'beta':
    $id  = daddslashes($_POST['id']);
    $row = $DB->get_row("select * from website_legal where id = {$id}");
    if($row['beta'] == 1){
        $beta = 0;
    }else{
        $beta = 1;
    }
    $sql = "update website_legal set beta = '{$beta}' where id = '{$id}' and user = '{$udata['uid']}'";
    if($row['user'] != $udata['uid']){
        $result = array(
	        "code"=>-1,
            "msg"=>"当前授权不属于您的账户"
        );
    }elseif($DB->query($sql)){
        $result = array(
	        "code"=>1,
            "msg"=>"修改成功"
        );
    }else{
        $result = array(
	        "code"=>-1,
            "msg"=>$DB->error()
        );
    }
break;
    
case 'del_auth':
    $id=daddslashes($_POST['id']);
    $row = $DB->get_row("SELECT * FROM website_legal WHERE id = {$id} limit 1");
    $sql="DELETE FROM website_legal where id = '".$id."' and user = '".$udata['uid']."'";
    if(!$row){
        $result = array(
            "code"=>-1,
            "msg"=>"授权不存在"
        );
    }elseif($row['user'] != $udata['uid']){
        $result = array(
	        "code"=>-1,
            "msg"=>"当前授权不属于您的账户"
        );
    }elseif($DB->query($sql)){
        $result = array(
	        "code"=>1,
            "msg"=>"删除成功"
        );
    }else{
        $result = array(
	        "code"=>-1,
            "msg"=>$DB->error()
        );
    }
break;
    
case 'active_why':
    $id=daddslashes($_POST['id']);
    $row = $DB->get_row("SELECT * FROM website_legal WHERE id = {$id} limit 1");
    if($row['active'] != 0){
        $result = array(
            "code"=>-1,
            "msg"=>"当前授权未被封禁"
        );
    }elseif(!$row){
        $result = array(
            "code"=>-1,
            "msg"=>"记录不存在"
        );
    }elseif($row['user'] != $udata['uid']){
        $result = array(
	        "code"=>-1,
            "msg"=>"当前授权不属于您的账户"
        );
    }elseif(!$row['why']){
        $result = array(
            "code"=>-1,
            "msg"=>"无封禁原因"
        );
    }else{
        $result = array(
	        "code"=>1,
            "msg"=>$row['why']
        );
    }
break;

case 'check_auth':
    $id=daddslashes($_POST['id']);
    $row = $DB->get_row("SELECT * FROM website_legal WHERE id = {$id} limit 1");
    if($row['user'] != $udata['uid']){
        $result = array(
	        "code"=>-1,
            "msg"=>"当前授权不属于您的账户"
        );
    }elseif(!$row){
        $result = array(
	        "code"=>-1,
            "msg"=>"记录不存在"
        );
    }else{
        $result = array(
            "code"=>1
        );
    }
break;

default:
	$result = array(
	    "code"=>-4,
        "msg"=>"Not Act"
    );
break;
}
echo json_encode($result, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);