<?php
include("../system/core/core.php");
$act=isset($_GET['act'])?daddslashes($_GET['act']):null;
@header('Content-Type: application/json; charset=UTF-8');
switch($act){
    
case 'sign':
    $type  = daddslashes($_POST['type']);
    $user  = daddslashes($_POST['user']);
    $pass  = daddslashes($_POST['pass']);
    $token = daddslashes($_POST['token']);
    $name  = daddslashes($_POST['name']);
    $pass = md5($pass);
    $sql_user = "insert into `website_user` (`user`,`pass`,`name`,`avatar`,`reg_time`,`reg_ip`,`reg_city`,`client_ip`,`money`,`integral`,`oauth_".$type."`,`active`,`type`) values ('".$user."','".$pass."','".$name."','../assets/System/icon/favicon.ico','".$date."','".$clientip."','".$city."','".$clientip."','0','0','".$token."','1','user')";
    $row = $DB->get_row("SELECT * FROM website_user order by uid desc limit 1");
    $sql_log="insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".($row['uid']+1)."','".$clientip."','".$city."','注册','注册账户','".$date."','user')";
    $sql_logs="insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".($row['uid']+1)."','".$clientip."','".$city."','登录','登录用户后台','".$date."','user')";
    $sql_update  = "update website_user set login_ip='$clientip' , login_time='$date' where user = '{$user}'";
    $row_user = $DB->get_row("SELECT * FROM website_user WHERE user='$user' limit 1");
    if($islogins==1){
        exit('{"code":1,"msg":"您已登陆"}');
	}elseif (!$name || !$user || !$pass) {
        exit('{"code":-1,"msg":"用户名、密码、昵称不能为空"}');
    }elseif ($row_user['user']) {
	    exit('{"code":-1,"msg":"用户名已存在"}');
    }elseif(!$type){
	    exit('{"code":-1,"msg":"快捷登录类型为空"}');
	}elseif (!preg_match('/^[a-zA-Z0-9\x7f-\xff]+$/',$user)) {
		exit('{"code":-1,"msg":"用户名只能为英文、数字与汉字"}');
	}elseif($DB->query($sql_user) && $DB->query($sql_log) && $DB->query($sql_logs)  && $DB->query($sql_update)){
	    $session=md5($user.$pass.$password_hash);
	    $token=authcode("{$user}\t{$session}", 'ENCODE', SYS_KEY);
	    setcookie("token_user", $token, time() + 604800);
	    exit('{"code":1,"msg":"成功"}');
	}else{
	    exit('{"code":-1,"msg":"'.$DB->error().'"}');
	}
break;

case 'reg':
	$user=daddslashes($_POST['user']);
    $pass=daddslashes($_POST['pass']);
    $name=daddslashes($_POST['name']);
    $qq = daddslashes($_POST['qq']);
    $pass = md5($pass);
    $avatar = '../assets/System/icon/favicon.ico';
    $sql = "insert into `website_user` (`user`,`pass`,`name`,`qq`,`reg_time`,`reg_ip`,`reg_city`,`client_ip`,`money`,`integral`,`mail_time`,`phone_time`,`active`,`active_ip`,`avatar`,`type`) values ('".$user."','".$pass."','".$name."','".$qq."','".$date."','".$clientip."', '".$city."','".$clientip."','0','0','0','0','1','0','".$avatar."','user')";
    $row = $DB->get_row("SELECT * FROM website_user order by uid desc limit 1");
    $sql_log="insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".($row['uid']+1)."','".$clientip."','".$city."','注册','注册账户','".$date."','user')";
    $sql_logs="insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".($row['uid']+1)."','".$clientip."','".$city."','登录','登录用户后台','".$date."','user')";
    $row_user = $DB->get_row("SELECT * FROM website_user WHERE user='$user' limit 1");
    $rows = $DB->get_row("SELECT * FROM website_user WHERE qq='$qq' limit 1");
    if($islogins==1){
        exit('{"code":1,"msg":"您已登陆"}');
	}elseif (!$name || !$user || !$pass) {
        exit('{"code":-1,"msg":"用户名、密码、昵称不能为空"}');
    }elseif (!preg_match('/^[a-zA-Z0-9\x7f-\xff]+$/',$user)) {
		exit('{"code":-1,"msg":"用户名只能为英文、数字与汉字"}');
	}elseif (strlen($qq) < 5 || !preg_match('/^[0-9]+$/',$qq)) {
		exit('{"code":-1,"msg":"QQ格式不正确！"}');
	}elseif ($row_user) {
	    exit('{"code":-1,"msg":"用户名已存在"}');
    }elseif ($rows) {
        exit('{"code":-1,"msg":"QQ已存在"}');
    }elseif($DB->query($sql) && $DB->query($sql_logs) && $DB->query($sql_log)){
        $session=md5($user.$pass.$password_hash);
        $token=authcode("{$user}\t{$session}", 'ENCODE', SYS_KEY);
        setcookie("token_user", $token, time() + 604800);
        exit('{"code":1,"msg":"注册用户成功"}');
	}else{
	    exit('{"code":-1,"msg":"注册用户失败！'.$DB->error().'"}');
	}
break;

default:
	exit('{"code":-4,"msg":"No Act"}');
break;
}
?>