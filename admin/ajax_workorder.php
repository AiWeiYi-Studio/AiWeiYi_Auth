<?php
/*
* @Time    : 2022/05/22 20:57
* @Author  : 爱唯逸网络科技
* @Mail    : support@857xx.cn
* @Site    : https://web.857xx.cn
* @File    : ajax_view.php
* @Action  : 文件管理ajax
*/

include("../system/core/core.php");
$act=isset($_GET['act'])?daddslashes($_GET['act']):null;
if($islogin==1){}else exit('{"code":-1,"msg":"你还没有登录"}');
@header('Content-Type: application/json; charset=UTF-8');
switch($act){
    
case 'del_class':
    $id = daddslashes($_POST['id']);
    $sql="DELETE FROM website_class_workorder where id = '{$id}'";
    if(!$id){
        $result = array(
            "code"=>-1,
            "msg"=>"必要参数不能为空"
        );
    }elseif($DB->query($sql)){
        $result = array(
            "code"=>1,
            "msg"=>"成功"
        );
	}else{
	    $result = array(
            "code"=>-1,
            "msg"=>$DB->error()
        );
	}
break;

case 'edit_class':
    $id = daddslashes($_POST['id']);
    $text = daddslashes($_POST['text']);
    $name = daddslashes($_POST['name']);
    $status = daddslashes($_POST['status']);
    $sql = "update `website_class_workorder` set name = '{$name}',text = '{$text}',status = '{$status}' where id = '{$id}'";
    $log_sql = "insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','工单','修改工单分类','".$date."','admin')";
    if(!$name){
        $result = array(
            "code"=>-1,
            "msg"=>"必要参数不能为空"
        );
    }elseif($DB->query($sql) && $DB->query($log_sql)){
        $result = array(
            "code"=>1,
            "msg"=>"成功"
        );
	}else{
	    $result = array(
            "code"=>-1,
            "msg"=>$DB->error()
        );
	}
break;
    
case 'add_class':
    $text = daddslashes($_POST['text']);
    $name = daddslashes($_POST['name']);
    $status = daddslashes($_POST['status']);
    $sql = "insert into `website_class_workorder` (`name`,`text`,`date`,`status`) values ('".$name."','".$text."','".$date."','".$status."')";
    $log_sql = "insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','工单','添加工单分类','".$date."','admin')";
    if(!$name){
        $result = array(
            "code"=>-1,
            "msg"=>"必要参数不能为空"
        );
    }elseif($DB->query($sql) && $DB->query($log_sql)){
        $result = array(
            "code"=>1,
            "msg"=>"成功"
        );
	}else{
	    $result = array(
            "code"=>-1,
            "msg"=>$DB->error()
        );
	}
break;
    
case 'reply':
    $id   = daddslashes($_POST['id']);
    $row  = $DB->get_row("select * from website_workorder where id = '{$id}'");
    $text_1 = daddslashes($_POST['text']);
    $text = $row['text'].'*1^'.$date.'^'.$text_1;
    $sql  = "update website_workorder set text='{$text}' where id = '{$id}'";
    if(!$id || !$text_1){
        $result = array(
            "code"=>-1,
            "msg"=>"必要参数为空"
        );
    }elseif(!$row){
        $result = array(
            "code"=>-1,
            "msg"=>"工单记录不存在"
        );
    }elseif($DB->query($sql)){
        send_workorder_mail_1($id);
        $result = array(
            "code"=>1,
            "msg"=>"回复成功"
        );
    }else{
        $result = array(
            "code"=>-1,
            "msg"=>$DB->error()
        );
	}
break;

case 'end':
    $id   = daddslashes($_POST['id']);
    $sql  = "update website_workorder set status = '1',date_end = '{$date}' where id = '{$id}'";
    if(!$id){
        $result = array(
            "code"=>-1,
            "msg"=>"必要参数为空"
        );
    }elseif($DB->query($sql)){
        $result = array(
            "code"=>1,
            "msg"=>"完结成功"
        );
    }else{
        $result = array(
            "code"=>-1,
            "msg"=>$DB->error()
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