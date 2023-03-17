<?php
/*
* @Time    : 2022/05/22 20:57
* @Author  : 爱唯逸网络科技
* @Mail    : support@857xx.cn
* @Site    : https://web.857xx.cn
* @File    : ajax_my.php
* @Action  : 修改个人信息相关ajax
*/

include("../system/core/core.php");
$act=isset($_GET['act'])?daddslashes($_GET['act']):null;
if($islogin==1){}else exit('{"code":-1,"msg":"你还没有登录"}');
@header('Content-Type: application/json; charset=UTF-8');
switch($act){
    
case 'my_avatarss':
    $avatar='https://q4.qlogo.cn/g?b=qq&nk='.$udata['qq'].'&s=140';
    $sql="update website_user set avatar='".$avatar."' where uid='{$udata['uid']}'";
    if(!$udata['qq']){
        exit('{"code":-1,"msg":"请先绑定QQ"}');
    }elseif($DB->query($sql)){
	    $city=get_ip_city($clientip);
        $DB->query("insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','修改','同步QQ头像','".$date."','admin')");
		exit('{"code":1,"msg":"修改成功"}');
	}else{
        exit('{"code":-1,"msg":"修改失败'.$DB->error().'"}');
	}
break;

case 'my_avatars':
    $avatar=daddslashes($_POST['avatar']);
    $sql="update website_user set avatar='".$avatar."' where uid='{$udata['uid']}'";
    if($avatar==null){
        exit('{"code":-1,"msg":"自定义头像外链为空"}');
	}elseif($DB->query($sql)){
	$city=get_ip_city($clientip);
    $DB->query("insert into `website_user` (`uid`,`ip`,`city`,`type`,`content`,`date`) values ('".$udata['uid']."','".$clientip."','".$city."','修改','修改个人头像','".$date."')");
		exit('{"code":1,"msg":"修改成功"}');
	}else{
        exit('{"code":-1,"msg":"修改失败'.$DB->error().'"}');
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
        if (!in_array($ext , $arr)) {
        exit('{"code":-1,"msg":"只支持上传图片文件"}');
        }elseif(!$DB->query($sql)){
        exit('{"code":-1,"msg":"用户头像总数记录失败'.'"}');
        }elseif(!$DB->query($sqls)){
        exit('{"code":-1,"msg":"用户头像更新失败"}');
        }elseif(copy($_FILES['file']['tmp_name'], $fileurl)){
        $DB->query("insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','修改','修改头像','".$date."','admin')");
        exit('{"code":1,"msg":"头像上传成功，已更新数据"}');
        }else{
        exit('{"code":-1,"msg":"请确保有本地写入权限"}');
        }
    }
break;
    
case 'my_edit':
    $uid=daddslashes($udata['uid']);
    $user=daddslashes($_POST['user']);
    $ip=daddslashes($_POST['ip']);
    $name=daddslashes($_POST['name']);
    $qq=daddslashes($_POST['qq']);
    $mail=daddslashes($_POST['mail']);
    $phone=daddslashes($_POST['phone']);
    $sql="update website_user set user='$user',client_ip='$ip',name='$name',qq='$qq',mail='$mail',phone='$phone' where uid='{$uid}'";
    $sql_log="insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','修改','修改个人资料','".$date."','admin')";
    if(!$user){
        exit('{"code":-1,"msg":"用户名为空"}');
	}elseif(!$ip){
	    exit('{"code":-1,"msg":"IP为空"}');
	}elseif(!$name){
	    exit('{"code":-1,"msg":"昵称为空"}');
	}elseif(!$qq){
	    exit('{"code":-1,"msg":"QQ为空"}');
	}elseif(!$mail){
	    exit('{"code":-1,"msg":"邮箱为空"}');
	}elseif(!$phone){
	    exit('{"code":-1,"msg":"手机号为空"}');
	}elseif($DB->query($sql) && $DB->query($sql_log)){
		exit('{"code":1,"msg":"修改成功"}');
	}else{
        exit('{"code":-1,"msg":"修改失败'.$DB->error().'"}');
	}
break;

default:
	exit('{"code":-4,"msg":"No Act"}');
break;
}