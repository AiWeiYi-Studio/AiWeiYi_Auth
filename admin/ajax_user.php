<?php
/*
* @Time    : 2022/05/22 20:57
* @Author  : 爱唯逸网络科技
* @Mail    : support@857xx.cn
* @Site    : https://web.857xx.cn
* @File    : ajax_user.php
* @Action  : 用户管理相关ajax
*/

include("../system/core/core.php");
$act=isset($_GET['act'])?daddslashes($_GET['act']):null;
if($islogin==1){}else exit('{"code":-1,"msg":"你还没有登录"}');
@header('Content-Type: application/json; charset=UTF-8');
switch($act){
    
case 'get_log_text':
    $id=daddslashes($_POST['id']);
    $row = $DB->get_row("SELECT * FROM website_log WHERE id = '".$id."' limit 1");
    if($row){
        exit('{"code":1,"msg":"'.$row['content'].'"}');
    }else{
        exit('{"code":-1,"msg":"查无记录"}');
    }
break;
    
case 'get_city_user_pay':
    $id = daddslashes($_GET['id']);
    $row = $DB->get_row("SELECT * FROM website_pay WHERE id = '{$id}' limit 1");
    if($row){
        exit('{"code":1,"msg":"'.$row['city'].'"}');
    }else{
        exit('{"code":-1,"msg":"记录不存在"}');
	}
break;
    
case 'money_log_del':
    $id = daddslashes($_GET['id']);
    $row = $DB->get_row("SELECT * FROM website_money_log WHERE id='$id' limit 1");
	$sql = "DELETE FROM website_money_log WHERE id='$id'";
	if(!$row){
	    exit('{"code":-1,"msg":"记录不存在"}');
	}elseif($DB->query($sql)){
	    $city=get_ip_city($clientip);
	    $DB->query("insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','删除','删除用户资金记录','".$date."','admin')");
	    exit('{"code":1,"msg":"删除成功"}');
	}else{
	    exit('{"code":-1,"msg":"删除失败：'.$DB->error().'"}');
	}
break;

case 'user_money':
    $uid = daddslashes($_GET['uid']);
    $type = daddslashes($_POST['type']);
    $number = daddslashes($_POST['number']);
    $text = daddslashes($_POST['text']);
    $row = $DB->get_row("SELECT * FROM website_user WHERE uid='$uid' limit 1");
    $money_old = $row['money'];
    if($type=='1'){
        $money = $row['money'] + $number;
        $types = '加款';
        $typess = '收入';
    }elseif($type=='2'){
        $money = $row['money'] - $number;
        $types = '扣款';
        $typess ='支出';
    }
    $sql="update website_user set money='$money' where uid='{$uid}'";
	if(!$row){
	    exit('{"code":-1,"msg":"用户不存在"}');
	}elseif(!$type){
	    exit('{"code":-1,"msg":"请选择方式"}');
	}elseif(!$number){
	    exit('{"code":-1,"msg":"请输入金额"}');
	}elseif($DB->query($sql)){
	$DB->query("insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','修改','管理用户“".$uid."”资金：".$types."，".$number."','".$date."','admin')");
	
	$DB->query("insert into `website_money_log` (`date`,`type`,`money`,`money_old`,`money_new`,`user`,`trade_no`,`ip`,`city`) values ('".$date."','".$typess."||管理员后台".$types."','".$number."','".$money_old."','".$money."','".$uid."','".$text."','".$clientip."','".$city."')");
	
	exit('{"code":1,"msg":"操作成功"}');
	}else{
	exit('{"code":-1,"msg":"未知错误"}');
	}
break;

case 'user_info':
    $uid = daddslashes($_GET['uid']);
    $row = $DB->get_row("SELECT * FROM website_user WHERE uid='$uid' limit 1");
	if($row){
	    $DB->query("insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','查询','获取用户“".$uid."”信息','".$date."','admin')");
	    exit('{"code":1,"msg":"成功","name":"'.$row['name'].'","user":"'.$row['user'].'","qq":"'.$row['qq'].'","phone":"'.$row['phone'].'","mail":"'.$row['mail'].'","money":"'.$row['money'].'","regtime":"'.$row['reg_time'].'","logintime":"'.$row['login_time'].'","integral":"'.$row['integral'].'"}');
	}else{
	    exit('{"code":-1,"msg":"用户不存在"}');
	}
break;

case 'user_add':
    $user  = daddslashes($_POST['user']);
    $pass  = daddslashes($_POST['pass']);
    $name  = daddslashes($_POST['name']);
    $qq    = daddslashes($_POST['qq']);
    $mail  = daddslashes($_POST['mail']);
    $phone = daddslashes($_POST['phone']);
    $row_user = $DB->get_row("SELECT * FROM website_user WHERE user='{$user}' limit 1");
    $sql="insert into `website_user` (`user`,`pass`,`name`,`qq`,`reg_time`,`reg_ip`,`reg_city`,`client_ip`,`money`,`integral`,`mail_time`,`phone_time`,`active`,`active_ip`,`avatar`,`type`) values ('".$user."','".$pass."','".$name."','".$qq."','".$date."','".$clientip."', '".$city."','".$clientip."','0','0','0','0','1','0','".$avatar."','user')";
	if(!$user){
	    exit('{"code":-1,"msg":"账号不能为空"}');
	}elseif($row_user){
	    exit('{"code":-1,"msg":"账号已存在"}');
	}elseif(!$pass){
	    exit('{"code":-1,"msg":"密码不能为空"}');
	}elseif($DB->query($sql)){
	    $DB->query("insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','添加','添加用户','".$date."','admin')");
	    exit('{"code":1,"msg":"成功"}');
	}else{
	    exit('{"code":-1,"msg":"失败：'.$DB->error().'"}');
	}
break;

case 'user_active':
    $uid=daddslashes($_GET['uid']);
    $row = $DB->get_row("SELECT * FROM website_user WHERE uid='$uid' limit 1");
	if($row['active']==1){
	    $type = '封禁';
	    $sql="update website_user set active='0' where uid='{$uid}'";
	}elseif($row['active']==0){
	    $sql="update website_user set active='1' where uid='{$uid}'";
	    $type = '解禁';
	}
	if(!$row){
	    exit('{"code":-1,"msg":"用户不存在"}');   
	}elseif($row['uid']==1){
	    exit('{"code":-1,"msg":"这位兄台请不要花样作死！"}');
	}elseif($DB->query($sql)){
	    $DB->query("insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','修改','修改用户：".$uid." 状态为".$type."','".$date."','admin')");
	    exit('{"code":1,"msg":"修改成功"}');
	}else{
	    exit('{"code":-1,"msg":"修改失败'.$DB->error().'"}');
	}
break;

case 'user_type':
    $uid=daddslashes($_GET['uid']);
    $row = $DB->get_row("SELECT * FROM website_user WHERE uid='$uid' limit 1");
	if($row['type']=='user')
	{
	    $type = '站长';
	    $sql="update website_user set type='admin' where uid='{$uid}'";
	}
	elseif($row['type']=='admin')
	{
	    $sql="update website_user set type='user' where uid='{$uid}'";
	    $type = '用户';
	}
	if(!$row){
	    exit('{"code":-1,"msg":"用户不存在"}');   
	}elseif($row['uid']==1){
	    exit('{"code":-1,"msg":"这位兄台请不要花样作死！"}');
	}elseif($DB->query($sql)){
	    $DB->query("insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','修改','修改用户：".$uid." 为".$type."','".$date."','admin')");
	    exit('{"code":1,"msg":"修改成功","id":"'.$id.'"}');
	}else{
	    exit('{"code":-1,"msg":"修改失败'.$DB->error().'"}');
	}
break;
    
case 'user_del':
    $uid = daddslashes($_GET['uid']);
    $row = $DB->get_row("SELECT * FROM website_user WHERE uid='$uid' limit 1");
	$sql = "DELETE FROM website_user WHERE uid='$uid'";
	if(!$row){
	    exit('{"code":-1,"msg":"用户不存在"}');
	}elseif($row['uid']==1){
	    exit('{"code":-1,"msg":"这位兄台请不要花样作死！"}');
	}elseif($DB->query($sql)){
	    $DB->query("insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','删除','删除用户：".$uid."','".$date."','admin')");
	    exit('{"code":1,"msg":"删除成功"}');
	}else{
	    exit('{"code":-1,"msg":"删除失败：'.$DB->error().'"}');
	}
break;

case 'user_edit':
    $uid   = daddslashes($_GET['uid']);
    $user  = daddslashes($_POST['user']);
    $pass  = daddslashes($_POST['pass']);
    $name  = daddslashes($_POST['name']);
    $qq    = daddslashes($_POST['qq']);
    $mail  = daddslashes($_POST['mail']);
    $phone = daddslashes($_POST['phone']);
    $pass  = md5($pass);
    $row   = $DB->get_row("SELECT * FROM website_user WHERE uid='$uid' limit 1");
    $sql   = "update website_user set user='$user',pass='$pass',name='$name',qq='$qq',mail='$mail',phone='$phone' where uid='{$uid}'";
	if(!$row){
	    exit('{"code":-1,"msg":"用户不存在"}');
	}elseif($DB->query($sql)){
	    $DB->query("insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','修改','修改用户：".$uid."信息','".$date."','admin')");
	    exit('{"code":1,"msg":"成功"}');
	}else{
	    exit('{"code":-1,"msg":"失败：'.$DB->error().'"}');
	}
break;

default:
	exit('{"code":-4,"msg":"No Act"}');
break;
}