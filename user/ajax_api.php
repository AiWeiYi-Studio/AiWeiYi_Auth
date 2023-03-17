<?php
include("../system/core/core.php");
$act=isset($_GET['act'])?daddslashes($_GET['act']):null;
if($islogins==1){}else exit('{"code":-1,"msg":"你还没有登录"}');
@header('Content-Type: application/json; charset=UTF-8');
switch($act){

case 'api_mail_send':
	$mail=daddslashes($_POST['mail']);
	$title=daddslashes($_POST['title']);
	$text=daddslashes($_POST['text']);
	$file=daddslashes($_POST['files']);
	if(!$mail){
	    exit('{"code":-1,"msg":"没有收件人"}');
	}elseif(!$title){
	    exit('{"code":-1,"msg":"没有标题"}');
	}elseif(!$text){
	    exit('{"code":-1,"msg":"没有内容"}');
	}else{
	    $result = get_curl($siteurls.'api/api/mail.php?token='.$udata['token'].'&mail='.$mail.'&title='.$title.'&text='.$text.'&file='.$file);
	    $arr=json_decode($result,true);
	    $city=get_ip_city($clientip);
	    $DB->query("insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','试用','试用邮件发送接口发送给：".$mail." 、 标题： ".$title." 、 内容： ".$text." 、  附件： ".$file."','".$date."','user')");
	    exit('{"code":"'.$arr['code'].'","msg":"'.$arr['msg'].'","user_money":"'.$arr['user_money'].'"}');
	}
break;

case 'api_mail_file':
    if($_POST['do']=='upload'){
        $filename = $_FILES['file']['name'];
        $ext = substr($filename, strripos($filename, '.') + 1);
        $arr = array('png', 'jpg', 'gif', 'jpeg', 'webp', 'bmp', 'zip');
        $fileurl = ROOT.'file/mail/'.$udata['uid'].'/'.$filename;
        if (!in_array($ext , $arr)) {
            exit('{"code":-1,"msg":"当前文件格式不允许上传"}');
        }elseif(copy($_FILES['file']['tmp_name'], $fileurl)){
            $DB->query("insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','上传','上传邮箱附件： ".$filename."','".$date."','user')");
            exit('{"code":1,"msg":"上传成功，已更新数据","file":"'.$filename.'"}');
        }else{
            exit('{"code":-1,"msg":"请先选择文件'.'"}');
        }
    }
break;

default:
	exit('{"code":-4,"msg":"No Act"}');
break;
}
?>