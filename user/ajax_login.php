<?php
include("../system/core/core.php");
$act=isset($_GET['act'])?daddslashes($_GET['act']):null;
@header('Content-Type: application/json; charset=UTF-8');
switch($act){
   
case 'find_send':
    $user = daddslashes($_POST['username']);
    $code = daddslashes($_POST['code']);
    $token = get_token();
    $row = $DB->get_row("SELECT * FROM website_user WHERE user = '$user' limit 1");
    $rows = $DB->get_row("select * from website_find where uid ='".$row['uid']."' and active = '1' order by id desc limit 1");
    $sql_into="insert into `website_find` (`time`,`token`,`uid`,`ip`,`active`) values ('".TIME."','".$token."','".$row['uid']."','".$clientip."','1')";
    $sql_into2="insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$row['uid']."','".$clientip."','".$city."','找回','发送找回密码邮件','".$date."','user')";
    if(!$row['mail']){
        $result = array(
            "code"=>-1,
            "msg"=>"当前帐号未绑定邮箱"
        );
    }elseif(!$code || strtolower($code) != $_SESSION['vc_code']) {
        $result = array(
            "code"=>-1,
            "msg"=>"验证码错误"
        );
	}elseif($rows['time'] > TIME - 180){
	    $result = array(
            "code"=>-1,
            "msg"=>"频繁操作"
        );
    }elseif($DB->query($sql_into) && $DB->query($sql_into2)){
        $res = send_find_mail($row['mail'],$token);
        if($res == 1){
            unset($_SESSION['vc_code']);
            $result = array(
                "code"=>1,
                "msg"=>"发送成功"
            );
        }else{
            $result = array(
                "code"=>-1,
                "msg"=>"发送失败"
            );
        }
    }else{
        $result = array(
            "code"=>-1,
            "msg"=>$DB->error()
        );
    }
break;

case 'find_update':
        $token      = daddslashes($_GET['token']);
        $password_1 = md5($_POST['password_1']);
        $password_2 = md5($_POST['password_2']);
        $row   = $DB->get_row("SELECT * FROM website_find WHERE token = '$token' limit 1");
        $sql   = "update website_user set pass = '{$password_1}' where uid = '{$row['uid']}'";
        $sql_into="insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$row['uid']."','".$clientip."','".$city."','修改','修改密码','".$date."','user')";
        $sql_update="update website_find set active = '0' where token = '{$token}'";
        if(!$token){
            $result = array(
                "code"=>-1,
                "msg"=>"请先输入密钥"
            );
        }elseif(!$password_1){
            $result = array(
                "code"=>-1,
                "msg"=>"密码为空"
            );
        }elseif(!$password_2){
            $result = array(
                "code"=>-1,
                "msg"=>"二次确认密码为空"
            );
        }elseif($row['active'] == '0'){
            $result = array(
                "code"=>-1,
                "msg"=>"当前密钥已使用过"
            );
        }elseif($password_1 != $password_2){
            $result = array(
                "code"=>-1,
                "msg"=>"两次密码不一致"
            );
        }elseif($row['time'] < TIME-180){
            $result = array(
                "code"=>-1,
                "msg"=>"密钥已过期"
            );
        }elseif($row['ip']!=$clientip){
            $result = array(
                "code"=>-1,
                "msg"=>"IP地址异常:".$clientip
            );
        }elseif(!$row){
            $result = array(
                "code"=>-1,
                "msg"=>"密钥不存在"
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
    
    case 'find_check':
        $token = daddslashes($_POST['token']);
        $row   = $DB->get_row("SELECT * FROM website_find WHERE token = '$token' limit 1");
        if(!$token){
            $result = array(
                "code"=>-1,
                "msg"=>"请先输入密钥"
            );
        }elseif($row['active']=='0'){
            $result = array(
                "code"=>-1,
                "msg"=>"当前密钥已使用过"
            );
        }elseif($row['time'] < TIME-180){
            $result = array(
                "code"=>-1,
                "msg"=>"密钥已过期"
            );
        }elseif($row['ip']!=$clientip){
            $result = array(
                "code"=>-1,
                "msg"=>"IP地址异常:".$clientip
            );
        }elseif($row){
            $result = array(
                "code"=>1,
                "msg"=>"正在跳转...",
                "token"=>$token
            );
        }else{
            $result = array(
                "code"=>-1,
                "msg"=>"密钥错误，请核查"
            );
        }
    break;

case 'sign':
    $type  = daddslashes($_POST['type']);
    $user  = daddslashes($_POST['user']);
    $pass  = daddslashes($_POST['pass']);
    $token = daddslashes($_POST['token']);
    $pass = md5($pass);
    $row   = $DB->get_row("SELECT * FROM website_user WHERE user = '{$user}' limit 1");
    $rows  = $DB->get_row("SELECT * FROM website_user WHERE oauth_".$type." = '{$token}' limit 1");
    $sql_update  = "update website_user set oauth_".$type." = '".$token."' , login_ip='$clientip' , login_time='$date' where user = '{$user}'";
    $sql_log = "insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$row['uid']."','".$clientip."','".$city."','绑定','绑定快捷登录','".$date."','user')";
	$sql_logs="insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$row['uid']."','".$clientip."','".$city."','登录','登录用户后台','".$date."','user')";
    if($rows){
        $result = array(
            "code"=>-1,
            "msg"=>"当前登录方式已被绑定"
        );
	}elseif($islogins==1){
        $result = array(
            "code"=>1,
            "msg"=>"您已登陆"
        );
	}elseif(!$type){
        $result = array(
            "code"=>-1,
            "msg"=>"快捷登录类型为空"
        );
	}elseif(!$user){
        $result = array(
            "code"=>-1,
            "msg"=>"账号为空"
        );
	}elseif(!$pass){
        $result = array(
            "code"=>-1,
            "msg"=>"密码为空"
        );
	}elseif(!$token){
        $result = array(
            "code"=>-1,
            "msg"=>"密钥为空"
        );
	}elseif($row['pass'] == $pass){
	    if($DB->query($sql_update) && $DB->query($sql_log) && $DB->query($sql_logs)){
	        $user = $row['user'];
	        $pass = $row['pass'];
	        setcookie("token_user", "", time() - 604800);
	        $session=md5($user.$pass.$password_hash);
	        $token=authcode("{$user}\t{$session}", 'ENCODE', SYS_KEY);
	        setcookie("token_user", $token, time() + 604800);
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
    }else{
        $result = array(
            "code"=>-1,
            "msg"=>"账户或密码错误"
        );
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
	$sql_into="insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','解绑','解绑{$types}快捷登录','".$date."','user')";
	if($islogins!==1){
        $result = array(
            "code"=>-1,
            "msg"=>"您还未登录"
        );
    }elseif(!$token){
        $result = array(
            "code"=>-1,
            "msg"=>"未绑定"
        );
	}elseif($DB->query($sql) && $DB->query($sql_into)){
        $result = array(
            "code"=>1,
            "msg"=>"解绑成功"
        );
	}else{
        $result = array(
            "code"=>-1,
            "msg"=>$DB->error()
        );
	}
break;

case 'login':
	$user=daddslashes($_POST['user']);
	$pass=daddslashes($_POST['pass']);
	$pass = md5($pass);
	$row = $DB->get_row("SELECT * FROM website_user WHERE user='{$user}' limit 1");
	$sql_log = "insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$row['uid']."','".$clientip."','".$city."','登陆','登录用户后台','".$date."','user')";
	$sql_update = "update website_user set login_ip='".$clientip."' , login_time='".$date."' where uid='{$row['uid']}'";
	$sql_update2 = "update website_user set mail_time = mail_time-'1' where uid='{$row['uid']}'";
	if(!$user){
        $result = array(
            "code"=>-1,
            "msg"=>"账号为空"
        );
	}elseif(!$pass){
        $result = array(
            "code"=>-1,
            "msg"=>"密码为空"
        );
	}elseif($row && $row['active']==0){
        $result = array(
            "code"=>-1,
            "msg"=>"账号已封禁"
        );
    }elseif($islogins==1){
        $result = array(
            "code"=>1,
            "msg"=>"你已登录"
        );
    }elseif($row['pass'] == $pass){
	    if($DB->query($sql_log) && $DB->query($sql_update)){
	        if($row['mail']!='' && $row['active_mail']=='1' && $row['mail_time']>0 && $DB->query($sql_update2)){
	            send_user_login_mail($row['mail']);
	        }
	        $session = md5($user.$pass.$password_hash);
	        $token = authcode("{$user}\t{$session}", 'ENCODE', SYS_KEY);
	        setcookie("token_user", $token, time() + 604800);
	        $result = array(
	            "code"=>1,
	            "msg"=>"尊敬的".$row['name']."，欢迎您！"
	        );
	    }else{
	        $result = array(
	            "code"=>-1,
	            "msg"=>$DB->error()
	        );
	    }
	}else{
        $result = array(
            "code"=>-1,
            "msg"=>"账号或密码错误"
        );
	}
break;

case 'logout':
    $sql_into="insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','退出','注销用户后台登录','".$date."','user')";
    if($islogins!=1){
        $result = array(
            "code"=>-1,
            "msg"=>"您还没有登录"
        );
    }elseif(setcookie("token_user", "", time() - 604800) && $DB->query($sql_into)){
        $result = array(
            "code"=>1,
            "msg"=>"注销成功"
        );
    }else{
        $result = array(
            "code"=>-1,
            "msg"=>"注销失败"
        );
    }
break;

case 'login_phone_code':
    $phone = daddslashes($_POST['phone']);
    $codes= daddslashes($_POST['codes']);
    $code = get_code();
    $row = $DB->get_row("select * from website_user where phone='".$phone."' limit 1");
    $text = '无';
    $time ='60';
    $rows = $DB->get_row("select * from website_code where send='".$phone."' and types='user' and type='phone' order by id desc limit 1");
    $sql = "insert into `website_code` (`code`,`text`,`date`,`ip`,`type`,`send`,`user`,`time`,`types`) values ('".$code."','".$text."','".$date."','".$clientip."','phone','".$phone."','".$row['uid']."','".TIME."','user')";
    $sql_update="update website_user set phone_time=phone_time-'1' where uid='{$row['uid']}'";
    $sql_into="insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$row['uid']."','".$clientip."','".$city."','发送','发送手机登录验证码：".$code."','".$date."','user')";
    if(!$phone){
        $result = array(
            "code"=>-1,
            "msg"=>"手机号不能为空"
        );
    }elseif(!$codes){
        $result = array(
            "code"=>-1,
            "msg"=>"网页验证码不能为空"
        );
    }elseif(!$codes || strtolower($codes) != $_SESSION['vc_code']) {
        $result = array(
            "code"=>-1,
            "msg"=>"网页验证码错误"
        );
	}elseif(!$row){
        $result = array(
            "code"=>-1,
            "msg"=>"手机号未绑定用户账号"
        );
    }elseif($row['phone_time']<='0'){
        $result = array(
            "code"=>-1,
            "msg"=>"账户短信额度不足"
        );
    }elseif($rows['time']>TIME-60){
        $result = array(
            "code"=>-1,
            "msg"=>"频繁操作"
        );
    }elseif($DB->query($sql) && $DB->query($sql_update) && $DB->query($sql_into)){
        unset($_SESSION['vc_code']);
        $res=send_dxb($time,$code,$phone);
        $result = array(
            "code"=>1,
            "msg"=>$res
        );
	}else{
        $result = array(
            "code"=>-1,
            "msg"=>$DB->error()
        );
	}
break;

case 'login_phone':
    $phone = daddslashes($_POST['phone']);
    $code = daddslashes($_POST['code']);
    $codes= daddslashes($_POST['codes']);
    $row = $DB->get_row("select * from website_user where phone='".$phone."' limit 1");
    $rows = $DB->get_row("select * from website_code where send='".$phone."' and types='user' and type='phone' order by id desc limit 1");
    $rowss = $DB->get_row("select * from website_code where code='".$code."' and types='user' and type='phone' order by id desc limit 1");
    $sql_update="update website_user set mail_time = mail_time-'1' where uid='{$row['uid']}'";
	$sql_update2="update website_user set login_ip='$clientip' , login_time='$date' where uid='{$row['uid']}'";
	$sql_update3="update website_code set active='0' where id='{$rows['id']}' and types='user' and type='phone'";
    $sql_into="insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$row['uid']."','".$clientip."','".$city."','登陆','登录用户后台','".$date."','user')";
	if(!$row){
        $result = array(
            "code"=>-1,
            "msg"=>"账号不存在"
        );
    }elseif(!$codes){
        $result = array(
            "code"=>-1,
            "msg"=>"网页验证码不能为空"
        );
    }elseif(!$codes || strtolower($codes) != $_SESSION['vc_code']) {
        $result = array(
            "code"=>-1,
            "msg"=>"网页验证码错误"
        );
	}elseif($row['active']==0){
        $result = array(
            "code"=>-1,
            "msg"=>"账号已封禁"
        );
    }elseif($islogins==1){
        $result = array(
            "code"=>-1,
            "msg"=>"你已登录过系统"
        );
    }elseif(!$rowss){
        $result = array(
            "code"=>-1,
            "msg"=>"验证码不存在"
        );
    }elseif($rows['active']=='0'){
        $result = array(
            "code"=>-1,
            "msg"=>"验证码已使用"
        );
    }elseif($rows['send']!=$row['phone']){
        $result = array(
            "code"=>-1,
            "msg"=>"手机号不对应用户手机号"
        );
    }elseif($rows['time']+60<TIME){
        $result = array(
            "code"=>-1,
            "msg"=>"验证码过期"
        );
    }elseif($DB->query($sql_log) && $DB->query($sql_update2) && $DB->query($sql_update3)){
        if($row['mail']!='' && $row['active_mail']=='1' && $row['mail_time']>0 && $DB->query($sql_update)){
            send_user_login_mail($row['mail']);
        }
        $session=md5($user.$pass.$password_hash);
        $token=authcode("{$user}\t{$session}", 'ENCODE', SYS_KEY);
        setcookie("token_user", $token, time() + 604800);
        unset($_SESSION['vc_code']);
        $result = array(
            "code"=>1,
            "msg"=>"登录成功"
        );
	}else{
        $result = array(
            "code"=>-1,
            "msg"=>$DB->error()
        );
	}
break;

case 'login_mail_code':
    $mail = daddslashes($_POST['mail']);
    $codes= daddslashes($_POST['codes']);
    $code = get_code();
    $row = $DB->get_row("select * from website_user where mail='".$mail."' limit 1");
    $text = '尊敬的'.$row['name'].'，您本次使用邮箱登录的验证码是'.$code.'，该验证码有效期为60秒，如不是您操作请尽快前往 “ '.$siteurls.' ”，修改密码！！！';
    $rows = $DB->get_row("select * from website_code where send='".$mail."' and types='user' and type='mail' order by id desc limit 1");
    $sql = "insert into `website_code` (`code`,`text`,`date`,`ip`,`type`,`send`,`user`,`time`,`types`) values ('".$code."','".$text."','".$date."','".$clientip."','mail','".$mail."','".$row['uid']."','".TIME."','user')";
    $sql_update = "update website_user set mail_time=mail_time-'1' where uid='{$row['uid']}'";
    $sql_into = "insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$row['uid']."','".$clientip."','".$city."','发送','邮箱登录：".$code."','".$date."','user')";
    if(!$mail){
        $result = array(
            "code"=>-1,
            "msg"=>"邮箱不能为空"
        );
    }elseif(!$codes){
        $result = array(
            "code"=>-1,
            "msg"=>"网页验证码不能为空"
        );
    }elseif(!$codes || strtolower($codes) != $_SESSION['vc_code']) {
        $result = array(
            "code"=>-1,
            "msg"=>"网页验证码错误"
        );
	}elseif(!$row){
        $result = array(
            "code"=>-1,
            "msg"=>"邮箱未绑定用户账号"
        );
    }elseif($row['mail_time']<='0'){
        $result = array(
            "code"=>-1,
            "msg"=>"账户邮件额度不足"
        );
    }elseif($rows['time']>TIME-60){
        $result = array(
            "code"=>-1,
            "msg"=>"频繁操作"
        );
    }elseif($DB->query($sql) && $DB->query($sql_update) && $DB->query($sql_into)){
	    $res = send_mail($mail,$conf['site_title'],$text,null);
	    if($result==1){
	        $result = array(
	            "code"=>1,
	            "msg"=>"发送成功"
	        );
	    }else{
	        $result = array(
	            "code"=>-1,
	            "msg"=>$res
	        );
	    }
	}else{
        $result = array(
            "code"=>-1,
            "msg"=>$DB->error()
        );
	}
break;

case 'login_mail':
    $mail = daddslashes($_POST['mail']);
    $code = daddslashes($_POST['code']);
    $codes= daddslashes($_POST['codes']);
    $row = $DB->get_row("select * from website_user where mail='".$mail."' limit 1");
    $rows = $DB->get_row("select * from website_code where send='".$mail."' and types='user' and type='mail' order by id desc limit 1");
    $rowss = $DB->get_row("select * from website_code where code='".$code."' and types='user' and type='mail' order by id desc limit 1");
    $sql_update = "update website_user set mail_time = mail_time-'1' where uid='{$row['uid']}'";
    $sql_update2 = "update website_user set login_ip='$clientip' , login_time='$date' where uid='{$row['uid']}'";
    $sql_update3 = "update website_code set active='0' where id='{$rows['id']}' and types='user' and type='phone'";
    $sql_log = "insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$row['uid']."','".$clientip."','".$city."','登陆','登录用户后台','".$date."','user')";
	if(!$row){
        $result = array(
            "code"=>-1,
            "msg"=>"账号不存在"
        );
    }elseif(!$codes){
        $result = array(
            "code"=>-1,
            "msg"=>"网页验证码不能为空"
        );
    }elseif(!$codes || strtolower($codes) != $_SESSION['vc_code']) {
        $result = array(
            "code"=>-1,
            "msg"=>"网页验证码错误"
        );
	}elseif($row['active']==0){
        $result = array(
            "code"=>-1,
            "msg"=>"账号已封禁"
        );
    }elseif($islogins==1){
        $result = array(
            "code"=>-1,
            "msg"=>"你已登录"
        );
    }elseif(!$rowss){
        $result = array(
            "code"=>-1,
            "msg"=>"验证码不存在"
        );
    }elseif($rows['active']=='0'){
        $result = array(
            "code"=>-1,
            "msg"=>"验证码已使用"
        );
    }elseif($rows['send']!=$row['mail']){
        $result = array(
            "code"=>-1,
            "msg"=>"邮箱不对应用户邮箱"
        );
    }elseif($rows['time']+60<TIME){
        $result = array(
            "code"=>-1,
            "msg"=>"验证码过期"
        );
    }elseif($DB->query($sql_log) && $DB->query($sql_update2) && $DB->query($sql_update3)){
        // 如果用户开启了登录邮件通知则会执行发通知邮件命令
	    if($row['mail']!='' && $row['active_mail']=='1' && $row['mail_time']>0 && $DB->query($sql_update)){
            send_user_login_mail($row['mail']);
        }
	    $session=md5($row['user'].$row['pass'].$password_hash);
	    $token=authcode("{$row['user']}\t{$session}", 'ENCODE', SYS_KEY);
	    setcookie("token_user", $token, time() + 604800);
	    unset($_SESSION['vc_code']);
        $result = array(
            "code"=>1,
            "msg"=>"登录成功"
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
        "msg"=>"No Act"
    );
break;
}
echo json_encode($result, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
?>