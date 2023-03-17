<?php
/*
* @Time    : 2022/05/22 20:57
* @Author  : 爱唯逸网络科技
* @Mail    : support@857xx.cn
* @Site    : https://web.857xx.cn
* @File    : ajax_login.php
* @Action  : 用户登录相关ajax
*/

include("../system/core/core.php");
$act=isset($_GET['act'])?daddslashes($_GET['act']):null;
@header('Content-Type: application/json; charset=UTF-8');
switch($act){
    
case 'login':
	$user=daddslashes($_POST['user']);
	$pass=daddslashes($_POST['pass']);
	$pass = md5($pass);
	$row = $DB->get_row("SELECT * FROM website_user WHERE user='$user' and type='admin' limit 1");
	$sql_update ="update website_user set login_time='{$date}',login_ip='{$clientip}' where user='{$user}' and type='admin'";
	$sql_log = "insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$row['uid']."','".$clientip."','".$city."','登录','登录站长后台','".$date."','admin')";
	if(!$user){
	    exit('{"code":-1,"msg":"账号为空"}');
	}elseif(!$pass){
	    exit('{"code":-1,"msg":"密码为空"}');
	}elseif($row['active_ip']=='1' && $ip!=$row['client_ip']){
	    exit('{"code":-1,"msg":"IP'.$ip.'不在白名单"}');
	}elseif($row && $row['active'] == 0){
	    exit('{"code":-1,"msg":"账号被封禁"}');
    }elseif($islogin==1){
	    exit('{"code":1,"msg":"你已登录过系统"}');
    }elseif($row['pass']==$pass){
        if($DB->query($sql_log) && $DB->query($sql_update)){
            if($row['mail']!='' && $row['active_mail']=='1'){
                send_admin_login_mail($row['mail']);
            }
            $session=md5($row['user'].$pass.$password_hash);
            $token=authcode("{$row['user']}\t{$session}", 'ENCODE', SYS_KEY);
            setcookie("token_admin", $token, time() + 604800);
            exit('{"code":1,"msg":"尊敬的系统管理员'.$row['name'].'，欢迎您！"}');
        }else{
            exit('{"code":-1,"msg":"'.$DB->error().'"}');
        }
	}else{
	    exit('{"code":-1,"msg":"账户或密码不正确"}');
	}
break;

case 'logout':
    if($islogin!==1){
        exit('{"code":-1,"msg":"您还未登录"}');
    }elseif($islogin==1){
        $DB->query("insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','注销','主动注销登录','".$date."','admin')");
        setcookie("token_admin", "", time() - 604800);
        exit('{"code":1,"msg":"注销成功"}');
    }else{
        exit('{"code":-1,"msg":"注销失败"}');
    }
break;

case 'oauth_jiebang':
    $type = daddslashes($_GET['type']);//1为QQ，2为微博，3为微信，4为支付宝
    if($type==1){
        $token = 'oauth_qq';
        $types = 'QQ';
    }elseif($type==2){
        $token = 'oauth_weibo';
        $types = '微博';
    }elseif($type==3){
        $token = 'oauth_weixin';
        $types = '微信';
    }elseif($type==4){
        $token = 'oauth_alipay';
        $types = '支付宝';
    }
	$sql="update website_user set ".$token." = '' where user='{$udata['user']}'";
	if($islogin!==1){
	exit('{"code":-1,"msg":"您还未登录"}');
    }elseif(!$token){
	exit('{"code":-1,"msg":"未绑定"}');
	}elseif($DB->query($sql)){
	    $DB->query("insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','解绑','解绑'.$types.'快捷登录','".$date."','user')");
	    exit('{"code":1,"msg":"解绑成功"}');
	}else{
	    exit('{"code":-1,"msg":"解绑失败'.$DB->error().'"}');
	}
break;

default:
	exit('{"code":-4,"msg":"No Act"}');
break;
}