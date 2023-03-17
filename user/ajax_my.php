<?php
include("../system/core/core.php");
$act=isset($_GET['act'])?daddslashes($_GET['act']):null;
if($islogins==1){}else exit('{"code":-1,"msg":"你还没有登录"}');
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

case 'pay_budan':
    $id = daddslashes($_GET['id']);
    $row = $DB->get_row("SELECT * FROM website_pay WHERE id = '{$id}' limit 1");
    if(!$row){
        exit('{"code":-1,"msg":"记录不存在"}');
    }elseif($row['status']==1){
        exit('{"code":-1,"msg":"当前订单已支付"}');
    }else{
        if($row['type']=='alipay'){
            if($conf['pay_alipay_api']=='1'){
                $url = $siteurls.'system/plugin/AiWeiYi_Epay/submit.php?type='.$row['type'].'&orderid='.$row['trade_no'];
                $result = array(
                    "code"=>1,
                    "msg"=>"请耐心等待系统跳转",
                    "url"=>$url
                );
            }elseif($conf['pay_alipay_api']=='2'){
                $url = $siteurls.'system/plugin/Alipay_Qrcode/submit.php?orderid='.$row['trade_no'];
                $result = array(
                    "code"=>1,
                    "msg"=>"请耐心等待系统跳转",
                    "url"=>$url
                );
            }else{
                $result = array(
                    "code"=>-1,
                    "msg"=>"系统未开启支付宝充值接口"
                );
            }
        }elseif($row['type']=='qqpay'){
            if($conf['pay_qqpay_api']=='1'){
                $url = $siteurls.'system/plugin/AiWeiYi_Epay/submit.php?orderid='.$row['trade_no'];
                $result = array(
                    "code"=>1,
                    "msg"=>"请耐心等待系统跳转",
                    "url"=>$url
                );
            }else{
                $result = array(
                    "code"=>-1,
                    "msg"=>"系统未开启QQ充值接口"
                );
            }
        }elseif($row['type']=='wxpay'){
            if($conf['pay_wxpay_api']=='1'){
                $url = $siteurls.'system/plugin/AiWeiYi_Epay/submit.php?orderid='.$row['trade_no'];
                $result = array(
                    "code"=>1,
                    "msg"=>"请耐心等待系统跳转",
                    "url"=>$url
                );
            }else{
                $result = array(
                    "code"=>-1,
                    "msg"=>"系统未开启微信充值接口"
                );
            }
        }else{
            $result = array(
                "code"=>-1,
                "msg"=>"没有支付类型"
            );
        }
    }
break;
    
case 'get_city_my_pay':
    $id = daddslashes($_GET['id']);
    $row = $DB->get_row("SELECT * FROM website_pay WHERE id = '{$id}' limit 1");
    if($row){
        $result = array(
            "code"=>1,
            "msg"=>$row['city']
        );
    }else{
        $result = array(
            "code"=>-1,
            "msg"=>"查无记录"
        );
	}
break;  

case 'my_notice':
    $active_mail = daddslashes($_POST['active_mail']);
    $sql="update website_user set active_mail='{$active_mail}' where uid='{$udata['uid']}'";
    if($DB->query($sql)){
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
    
case 'edit_phone':
    $phone=daddslashes($_POST['edit_phone']);
    $phones=daddslashes($_POST['edit_phones']);
    $code=daddslashes($_POST['edit_code']);
    $row = $DB->get_row("SELECT * FROM website_code WHERE code='$code' and types='user' and type='phone' limit 1");
    $sql="update website_user set phone='".$phones."' where uid='{$udata['uid']}'";
    $sql_update = "update website_code set active='0' where id='{$row['id']}' and types='user' and type='phone'";
    $sql_log = "insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','修改','原手机号：".$phone."，新手机号：".$phones."','".$date."','user')";
    if(!$phone){
        $result = array(
            "code"=>-1,
            "msg"=>"原手机号为空"
        );
    }elseif(!$phones){
        $result = array(
            "code"=>-1,
            "msg"=>"新手机号为空"
        );
    }elseif($phone == $phones){
        $result = array(
            "code"=>-1,
            "msg"=>"新旧手机号一致"
        );
    }elseif(!$row){
        $result = array(
            "code"=>-1,
            "msg"=>"验证码错误"
        );
    }elseif($row['active']=='0'){
        $result = array(
            "code"=>-1,
            "msg"=>"验证码已被使用"
        );
    }elseif($row['send']!=$phone){
        $result = array(
            "code"=>-1,
            "msg"=>"手机号与验证码不符"
        );
    }elseif($row['time']+60<TIME){
        $result = array(
            "code"=>-1,
            "msg"=>"验证码过期"
        );
    }elseif($DB->query($sql) && $DB->query($sql_update) && $DB->query($sql_log)){
        $result = array(
            "code"=>1,
            "msg"=>"绑定成功"
        );
	}else{
	    $result = array(
            "code"=>-1,
            "msg"=>$DB->error()
        );
	}
break;    
    
case 'edit_phone_code':
    $phone=daddslashes($_POST['edit_phone']);
    $code= get_code();
    $time ='60';
    $rows=$DB->get_row("select * from website_code where send='".$phone."' and types='user' and type='phone' order by id desc limit 1");
    $sql="insert into `website_code` (`code`,`text`,`date`,`ip`,`type`,`send`,`user`,`time`,`types`) values ('".$code."','无','".$date."','".$clientip."','phone','".$phone."','".$udata['uid']."','".TIME."','user')";
    $sql_update = "update website_user set phone_time=phone_time-'1' where uid='{$udata['uid']}'";
    $sql_log = "insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','发送','发送修改绑定手机验证码：".$code."','".$date."','user')";
    if(!$phone){
        $result = array(
            "code"=>-1,
            "msg"=>"原手机号不能为空"
        );
    }elseif($udata['phone_time']<='0'){
        $result = array(
            "code"=>-1,
            "msg"=>"账户短信额度不足"
        );
    }elseif($rows['time']>TIME-60){
        $result = array(
            "code"=>-1,
            "msg"=>"频繁操作"
        );
    }elseif($DB->query($sql) && $DB->query($sql_update) && $DB->query($sql_log)){
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
    
case 'bd_phone':
    $phone=daddslashes($_POST['do_phone']);
    $code=daddslashes($_POST['do_code']);
    $row = $DB->get_row("SELECT * FROM website_code WHERE code='$code' and types='user' and type='phone' limit 1");
    $sql="update website_user set phone='".$phone."' where uid='{$udata['uid']}'";
    $sql_update="update website_code set active='0' where id='{$row['id']}' and types='user' and type='phone'";
    $aql_log="insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','绑定','绑定手机号：".$phone."','".$date."','user')";
    if(!$row){
        $result = array(
            "code"=>-1,
            "msg"=>"验证码错误"
        );
    }elseif($row['send']!=$phone){
        $result = array(
            "code"=>-1,
            "msg"=>"手机号与验证码不符"
        );
    }elseif($row['time']+60<TIME){
        $result = array(
            "code"=>-1,
            "msg"=>"验证码过期"
        );
    }elseif($DB->query($sql) && $DB->query($sql_update) && $DB->query($sql_log)){
        $result = array(
            "code"=>1,
            "msg"=>"绑定成功"
        );
	}else{
	    $result = array(
            "code"=>-1,
            "msg"=>$DB->error()
        );
	}
break;
    
case 'bd_phone_code':
    $phone = daddslashes($_POST['do_phone']);
    $code = get_code();
    $time = '60';
    $rows = $DB->get_row("select * from website_code where send='".$phone."' and types='user' and type='phone' order by id desc limit 1");
    $sql = "insert into `website_code` (`code`,`text`,`date`,`ip`,`type`,`send`,`user`,`time`,`types`) values ('".$code."','无','".$date."','".$clientip."','phone','".$phone."','".$udata['uid']."','".TIME."','user')";
    $sql_update="update website_user set phone_time=phone_time-'1' where uid='{$udata['uid']}'";
    $sql_log="insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','发送','发送绑定手机验证码：".$code."','".$date."','user')";
    if(!$phone){
        $result = array(
            "code"=>-1,
            "msg"=>"手机号不能为空"
        );
    }elseif($udata['phone_time']<='0'){
        $result = array(
            "code"=>-1,
            "msg"=>"账户短信额度不足"
        );
    }elseif($rows['time']>TIME-60){
        $result = array(
            "code"=>-1,
            "msg"=>"频繁操作"
        );
    }elseif($DB->query($sql) && $DB->query($sql_update) && $DB->query($sql_log)){
        $res=send_dxb($code,$time,$phone);
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
    
case 'edit_mail':
    $mail=daddslashes($_POST['edit_mail']);
    $mails=daddslashes($_POST['edit_mails']);
    $code=daddslashes($_POST['edit_code']);
    $row = $DB->get_row("SELECT * FROM website_code WHERE code='$code' and types='user' and type='mail' limit 1");
    $sql="update website_user set mail='".$mails."' where uid='{$udata['uid']}'";
	$sql_update="update website_code set active='0' where id='{$row['id']}' and types='user' and type='mail'";
    $sql_log="insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','修改','原邮箱：".$mail."，新邮箱：".$mails."','".$date."','user')";
    if(!$mail){
        $result = array(
            "code"=>-1,
            "msg"=>"原邮箱为空"
        );
    }elseif(!$mails){
        $result = array(
            "code"=>-1,
            "msg"=>"新邮箱为空"
        );
    }elseif($mail==$mails){
        $result = array(
            "code"=>-1,
            "msg"=>"新旧邮箱一致"
        );
    }elseif(!$row){
        $result = array(
            "code"=>-1,
            "msg"=>"验证码错误"
        );
    }elseif($row['active']=='0'){
        $result = array(
            "code"=>-1,
            "msg"=>"验证码已被使用"
        );
    }elseif($row['send']!=$mail){
        $result = array(
            "code"=>-1,
            "msg"=>"邮箱与验证码不符"
        );
    }elseif($row['time']+60<TIME){
        $result = array(
            "code"=>-1,
            "msg"=>"验证码过期"
        );
    }elseif($DB->query($sql) && $DB->query($sql_update) && $DB->query($sql_log)){
        $result = array(
            "code"=>1,
            "msg"=>"绑定成功"
        );
	}else{
	    $result = array(
            "code"=>-1,
            "msg"=>$DB->error()
        );
	}
break;    
    
case 'edit_mail_code':
    $mail=daddslashes($_POST['edit_mail']);
    $mails=daddslashes($_POST['edit_mails']);
    $code= get_code();
    $text = '尊敬的'.$udata['name'].'，您本次修改邮箱的验证码是'.$code.'，该验证码有效期为60秒，新邮箱地址为：'.$mails.'，如不是您操作请尽快前往 <a target="_blank" href="'.$siteurls.'">'.$conf['site_title'].'</a> ，修改密码！！！';
    $rows=$DB->get_row("select * from website_code where send='".$mail."' and types='user' and type='mail' order by id desc limit 1");
    $sql="insert into `website_code` (`code`,`text`,`date`,`ip`,`type`,`send`,`user`,`time`,`types`) values ('".$code."','".$text."','".$date."','".$clientip."','mail','".$mail."','".$udata['uid']."','".TIME."','user')";
    $sql_update="update website_user set mail_time=mail_time-'1' where uid='{$udata['uid']}'";
    $sql_log="insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','发送验证码','修改邮箱验证码：".$code."','".$date."','user')";
    if(!$mail){
        $result = array(
            "code"=>1,
            "msg"=>"原邮箱不能为空"
        );
    }elseif(!$mails){
        $result = array(
            "code"=>-1,
            "msg"=>"新邮箱不能为空"
        );
    }elseif($mail == $mails){
        $result = array(
            "code"=>-1,
            "msg"=>"新旧邮箱一致"
        );
    }elseif($udata['mail_time']<='0'){
        $result = array(
            "code"=>-1,
            "msg"=>"账户邮件额度不足"
        );
    }elseif($rows['time']>TIME-60){
        $result = array(
            "code"=>-1,
            "msg"=>"频繁操作"
        );
    }elseif($DB->query($sql) && $DB->query($sql_update) && $DB->query($sql_log)){
        $res = send_mail($mail,$conf['site_title'],$text,null);
        if($res==1){
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
    
case 'bd_mail':
    $mail=daddslashes($_POST['do_mail']);
    $code=daddslashes($_POST['do_code']);
    $row = $DB->get_row("SELECT * FROM website_code WHERE code='$code' and types='user' and type='mail' limit 1");
    $sql="update website_user set mail='".$mail."' where uid='{$udata['uid']}'";
    $sql_update="update website_code set active='0' where id='{$row['id']}' and types='user' and type='mail'";
    $sql_log="insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','绑定','绑定邮箱','".$date."','user')";
    if(!$row){
        $result = array(
            "code"=>-1,
            "msg"=>"验证码错误"
        );
    }elseif($row['send']!=$mail){
        $result = array(
            "code"=>-1,
            "msg"=>"邮箱与验证码不符"
        );
    }elseif($row['time']+60<TIME){
        $result = array(
            "code"=>-1,
            "msg"=>"验证码过期"
        );
    }elseif($DB->query($sql) && $DB->query($sql_update) && $DB->query($sql_log)){
        $result = array(
            "code"=>-1,
            "msg"=>"绑定成功"
        );
	}else{
        $result = array(
            "code"=>-1,
            "msg"=>$DB->error()
        );
	}
break;
    
case 'bd_mail_code':
    $mail = daddslashes($_POST['do_mail']);
    $code = get_code();
    $text = '尊敬的'.$udata['name'].'，您本次绑定邮箱的验证码是'.$code.'，该验证码有效期为60秒，如不是您操作请尽快前往 <a target="_blank" href="'.$siteurls.'">'.$conf['site_title'].'</a> 修改密码';
    $rows = $DB->get_row("select * from website_code where send='".$mail."' and types='user' and type='mail' order by id desc limit 1");
    $sql = "insert into `website_code` (`code`,`text`,`date`,`ip`,`type`,`send`,`user`,`time`,`types`) values ('".$code."','".$text."','".$date."','".$clientip."','mail','".$mail."','".$udata['uid']."','".TIME."','user')";
    $sql_update="update website_user set mail_time=mail_time-'1' where uid='{$udata['uid']}'";
    $sql_log="insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','发送验证码','绑定邮箱验证码：".$code."','".$date."','user')";
    if(!$mail){
        $result = array(
            "code"=>-1,
            "msg"=>"邮箱不能为空"
        );
    }elseif($udata['mail_time']<='0'){
        $result = array(
            "code"=>-1,
            "msg"=>"账户邮件额度不足"
        );
    }elseif($rows['time']>TIME-60){
        $result = array(
            "code"=>-1,
            "msg"=>"频繁操作"
        );
    }elseif($DB->query($sql) && $DB->query($sql_update) && $DB->query($sql_log)){
        $res = send_mail($mail,$conf['site_title'],$text,null);
        if($res==1){
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
    
case 'my_avatarss':
    $avatar = get_qqavatars($udata['qq']);
    $sql="update website_user set avatar='".$avatar."' where uid='{$udata['uid']}'";
    $sql_log="insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','修改','同步QQ头像','".$date."','user')";
    if(!$udata['qq']){
        $result = array(
            "code"=>-1,
            "msg"=>"请先绑定QQ"
        );
    }elseif($DB->query($sql) && $DB->query($sql_log)){
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

case 'my_avatars':
    $avatar=daddslashes($_POST['avatar']);
    $sql="update website_user set avatar='".$avatar."' where uid='{$udata['uid']}'";
    $sql_log="insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','修改','修改外链头像','".$date."','user')";
    if(!$avatar){
        $result = array(
            "code"=>-1,
            "msg"=>"自定义头像外链为空"
        );
	}elseif($DB->query($sql) && $DB->query($sql_log)){
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
    
case 'my_avatar':
    if($_POST['do']=='upload'){
        $filename = $_FILES['file']['name'];
        $ext = substr($filename, strripos($filename, '.') + 1);
        $arr = array('png', 'jpg', 'gif', 'jpeg', 'webp', 'bmp');
        $row = $DB->get_row("SELECT * FROM website_user WHERE uid='".$udata['uid']."' limit 1");//获取用户数据
        $sql="update website_user set avatar_number=avatar_number+'1' where uid='{$udata['uid']}'";//更新用户头像总数
        $s = $row['avatar_number']+1;
        $filename = $s.'.png';
        $fileurl = ROOT.'file/avatar/'.$udata['uid'].'/'.$filename;
        $fileurls = 'file/avatar/'.$udata['uid'].'/'.$filename;
        $sqls="update website_user set avatar='".$siteurls.$fileurls."' where uid='{$udata['uid']}'";//更新用户头像总数
        $sql_log = "insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','修改','修改头像','".$date."','user')";
        if (!in_array($ext , $arr)) {
            $result = array(
                "code"=>-1,
                "msg"=>"只支持上传图片文件"
            );
        }elseif($DB->query($sql) && $DB->query($sqls) && $DB->query($sql_log) && copy($_FILES['file']['tmp_name'], $fileurl)){
            $result = array(
                "code"=>1,
                "msg"=>"头像上传成功，已更新数据"
            );
        }else{
            if(!copy($_FILES['file']['tmp_name'], $fileurl)){
                $result = array(
                    "code"=>-1,
                    "msg"=>"权限不足"
                );
            }else{
                $result = array(
                    "code"=>-1,
                    "msg"=>$DB->error()
                );
            }
        }
    }
break;

case 'my_edit':
    $ip=daddslashes($_POST['ip']);
    $name=daddslashes($_POST['name']);
    $qq=daddslashes($_POST['qq']);
    $sql="update website_user set client_ip='$ip',name='$name',qq='$qq' where user='{$udata['user']}'";
    $sql_log="insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','修改','修改个人信息','".$date."','user')";
    if($DB->query($sql) && $DB->query($sql_log)){
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

case 'my_account':
    $user=daddslashes($_POST['user']);
    $pass=daddslashes($_POST['pass']);
    $code=daddslashes($_POST['code']);
    $type=daddslashes($_POST['type']);
    if(!$pass){
        $pass = $udata['pass'];
    }else{
        $pass = $pass;
    }
    $sql="update website_user set user='$user',pass='$pass' where uid='{$udata['uid']}'";
    $sql_update = "update website_code set active='0' where id='{$row['id']}' and types='user' and type='$type'";
	$sql_log = "insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','修改','修改账号密码','".$date."','user')";
    $row = $DB->get_row("SELECT * FROM website_code WHERE code='$code' and types='user' and type='$type' limit 1");
    if(!$user){
        $result = array(
            "code"=>-1,
            "msg"=>"账号为空"
        );
    }elseif(!$code){
        $result = array(
            "code"=>-1,
            "msg"=>"验证码为空"
        );
    }elseif(!$row){
        $result = array(
            "code"=>-1,
            "msg"=>"验证码错误"
        );
    }elseif($row['type']!=$type){
        $result = array(
            "code"=>-1,
            "msg"=>"验证码类型不符"
        );
    }elseif($row['time']+60<TIME){
        $result = array(
            "code"=>-1,
            "msg"=>"验证码过期"
        );
    }elseif($DB->query($sql) && $DB->query($sql_update) && $DB->query($sql_log)){
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

case 'my_account_code':
    $type=daddslashes($_POST['type']);
    if($type=='mail'){
        $mail = $udata['mail'];
        $code = get_code();
        $text = '尊敬的'.$udata['name'].'，您本次修改密码的验证码是'.$code.'，该验证码有效期为60秒，如不是您操作请尽快前往 <a target="_blank" href="'.$siteurls.'">'.$conf['site_title'].'</a> 修改密码';
        $rows = $DB->get_row("select * from website_code where send='".$mail."' and types='user' and type='mail' order by id desc limit 1");
        $sql = "insert into `website_code` (`code`,`text`,`date`,`ip`,`type`,`send`,`user`,`time`,`types`) values ('".$code."','".$text."','".$date."','".$clientip."','mail','".$mail."','".$udata['uid']."','".TIME."','user')";
        $sql_update="update website_user set mail_time=mail_time-'1' where uid='{$udata['uid']}'";
        $sql_log="insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','发送验证码','修改密码验证码邮件；".$code."','".$date."','user')";
        if(!$mail){
            $result = array(
                "code"=>-1,
                "msg"=>"用户未绑定邮箱"
            );
        }elseif($udata['mail_time']<='0'){
            $result = array(
                "code"=>-1,
                "msg"=>"账户邮件额度不足"
            );
        }elseif($rows['time']>TIME-60){
            $result = array(
                "code"=>-1,
                "msg"=>"频繁操作"
            );
        }elseif($DB->query($sql)){
            $res = send_mail($mail,$conf['site_title'],$text,null);
            if($res==1){
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
    }elseif($type=='phone'){
        $phone = $udata['phone'];
        $code = get_code();
        $time = '60';
        $rows = $DB->get_row("select * from website_code where send='".$phone."' and types='user' and type='phone' order by id desc limit 1");
        $sql = "insert into `website_code` (`code`,`text`,`date`,`ip`,`type`,`send`,`user`,`time`,`types`) values ('".$code."','无','".$date."','".$clientip."','phone','".$phone."','".$udata['uid']."','".TIME."','user')";
        $sql_update="update website_user set phone_time=phone_time-'1' where uid='{$udata['uid']}'";
        $sql_log="insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."'    ,'发送','发送修改密码验证码短信；".$code."','".$date."','user')";
        if(!$phone){
            $result = array(
                "code"=>-1,
                "msg"=>"账号未绑定手机号"
            );
        }elseif($udata['phone_time']<='0'){
            $result = array(
                "code"=>-1,
                "msg"=>"账户短信额度不足"
            );
        }elseif($rows['time']>TIME-60){
            $result = array(
                "code"=>-1,
                "msg"=>"频繁操作"
            );
        }elseif($DB->query($sql) && $DB->query($sql_update) && $DB->query($sql_log)){
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
    }else{
        $result = array(
            "code"=>-1,
            "msg"=>"验证码类型为空"
        );
    }
break;

case 'my_chongzhi':
    $money = daddslashes($_POST['money']);
    $type  = daddslashes($_GET['type']);
    $trade_no = get_trade_no();
    $domain = $siteurl.'my_money.php?mod=chongzhi';
    if($type=='1'){
        $type = 'alipay';
        if($conf['pay_alipay_api']=='1'){
            $url = $siteurls.'system/plugin/AiWeiYi_Epay/submit.php?type='.$type.'&orderid='.$trade_no;
        }elseif($conf['pay_alipay_api']=='2'){
            $url = $siteurls.'system/plugin/Alipay_Qrcode/submit.php?orderid='.$trade_no;
        }
    }elseif($type=='2'){
        $type = 'qqpay';
        if($conf['pay_qqpay_api']=='1'){
            $url = $siteurls.'system/plugin/AiWeiYi_Epay/submit.php?orderid='.$trade_no;
        }
    }elseif($type=='3'){
        $type = 'wxpay';
        if($conf['pay_wxpay_api']=='1'){
            $url = $siteurls.'system/plugin/AiWeiYi_Epay/submit.php?orderid='.$trade_no;
        }
    }
    $sql="insert into `website_pay` (`trade_no`,`type`,`addtime`,`name`,`money`,`ip`,`city`,`user`,`domain`,`status`,`buy`) values ('".$trade_no."','".$type."','".$date."','".$conf['site_title']."在线充值余额','".$money."','".$clientip."','".$city."','".$udata['uid']."','".$domain."','0','0')";
    
    $sql_log="insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','充值','创建充值订单：".$trade_no."','".$date."','user')";
    $row = $DB->get_row("select * from website_pay where user = ".$udata['uid']." and status = '0'");
    if(!$money){
        $result = array(
            "code"=>-1,
            "msg"=>"验证码类型为空"
        );
        exit('{"code":-1,"msg":"金额不能为空"}');
    }elseif($money<$conf['pay_money_little']){
        $result = array(
            "code"=>-1,
            "msg"=>"验证码类型为空"
        );
        exit('{"code":-1,"msg":"充值金额低于最低充值"}');
    }elseif($money>$conf['pay_money_big']){
        $result = array(
            "code"=>-1,
            "msg"=>"验证码类型为空"
        );
        exit('{"code":-1,"msg":"充值金额大于最高充值"}');
    }elseif(!$type){
        $result = array(
            "code"=>-1,
            "msg"=>"验证码类型为空"
        );
        exit('{"code":-1,"msg":"支付方式不能为空"}');
    }elseif($DB->query($sql) && $DB->query($sql_log)){
        $result = array(
            "code"=>1,
            "msg"=>"创建充值订单成功",
            "url"=>$url,
            "trade_no"=>$trade_no
        );
	}else{
	    $result = array(
            "code"=>-1,
            "msg"=>$DB->error()
        );
	}
break;

case 'my_chongzhi_kami':
    $kami=daddslashes($_POST['kami']);
    $row = $DB->get_row("SELECT * FROM website_kami WHERE kami='$kami' and type='money' limit 1");
    $money = $udata['money']+$row['money'];
    $uid = $udata['uid'];
    $money_old = $udata['money'];
    $sql="update website_user set money='$money' where user='{$udata['user']}'";
    $sql_insert="insert into `website_money_log` (`date`,`type`,`money`,`money_old`,`money_new`,`user`,`trade_no`,`ip`) values ('".$date."','收入||卡密','".$row['money']."','".$money_old."','".$money."','".$udata['uid']."','".$row['kami']."','".$clientip."')";
    $sql_log="insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','收入','使用卡密 ‘".$kami."’ 充值‘".$row['money']."’元','".$date."','user')";
    $sql_update="update website_kami set use_time='$date',use_user='$uid',active='1' where kami='{$kami}' and type='money' limit 1";
    if(!$row){
        $result = array(
            "code"=>-1,
            "msg"=>"卡密不存在"
        );
    }elseif($row['active']=='1'){
        $result = array(
            "code"=>-1,
            "msg"=>"卡密已被使用"
        );
    }elseif($DB->query($sql) && $DB->query($sql_insert) && $DB->query($sql_log) && $DB->query($sql_update)){
        $result = array(
            "code"=>1,
            "msg"=>"充值".$row['money']."元成功"
        );
	}else{
	    $result = array(
            "code"=>-1,
            "msg"=>$DB->error()
        );
	}
break;

case 'my_edit_token':
    $token = get_token();
    $sql="update website_user set token='$token' where user='{$udata['user']}'";
    $sql_log="insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','修改','修改个人专属TOKEN为 ‘".$token."’','".$date."','user')";
    if($DB->query($sql) && $DB->query($sql_log)){
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

default:
	exit('{"code":-4,"msg":"No Act"}');
break;
}
echo json_encode($result, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
?>