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
if($islogins==1){}else exit('{"code":-1,"msg":"你还没有登录"}');
@header('Content-Type: application/json; charset=UTF-8');
switch($act){

case 'add':
    $type = daddslashes($_POST['type']);
    $title = daddslashes($_POST['title']);
    $text = daddslashes($_POST['text']);
    $row_workorder = $DB->get_row("select * from website_workorder where user = '{$udata['uid']}' and status = '0'");
    $sql = "insert into `website_workorder` (`type`,`user`,`title`,`text`,`date_add`,`status`) values ('".$type."','".$udata['uid']."','".$title."','".$text."','".$date."','0')";
    $log_sql = "insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','工单','发起工单','".$date."','user')";
    if(!$type || !$title || !$text){
        $result = array(
            "code"=>-1,
            "msg"=>"必要参数为空"
        );
    }elseif($row_workorder){
        $result = array(
            "code"=>-1,
            "msg"=>"您有未完结的工单"
        );
    }elseif($DB->query($sql) && $DB->query($log_sql)){
        $row_id = $DB->get_row("select * from website_workorder order by id desc limit 1");
        send_workorder_mail_2($row_id['id']);
        $result = array(
            "code"=>1,
            "msg"=>"发起成功",
            "id"=>$row_id['id']
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
    $row  = $DB->get_row("select * from website_workorder where id = '{$id}' and user = '{$udata['uid']}'");
    $text_1 = daddslashes($_POST['text']);
    $text = $row['text'].'*0^'.$date.'^'.$text_1;
    $sql  = "update website_workorder set text='{$text}' where id = '{$id}' and user = '{$udata['uid']}'";
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
        send_workorder_mail_3($id);
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
    $sql  = "update website_workorder set status = '1',date_end = '{$date}' where id = '{$id}' and user = '{$udata['uid']}'";
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