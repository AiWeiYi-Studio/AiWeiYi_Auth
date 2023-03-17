<?php
/*
* @Time    : 2022/05/22 20:57
* @Author  : 爱唯逸网络科技
* @Mail    : support@857xx.cn
* @Site    : https://web.857xx.cn
* @File    : auth_name.php
* @Action  : 程序昵称配置
*/

include("../../system/core/core.php");
@header('Content-Type: application/json; charset=UTF-8');
$token = daddslashes($_GET['token']);
$mail  = daddslashes($_GET['mail']);
$title = daddslashes($_GET['title']);
$text  = daddslashes($_GET['text']);
$file  = daddslashes($_GET['file']);
$row   = $DB->get_row("SELECT * FROM website_user WHERE token='$token' limit 1");
$money = $row['money']-$conf['api_mail_money'];
$money_old = $row['money'];
$sql   = "update website_user set money='$money' where token='{$token}'";
$number = $conf['api_mail_number']+1;
saveSetting('api_mail_number',$number);
$ad=$CACHE->clear();

if($conf['api_mail_active']=='0'){
    $result = array(
        "code"=>-1,
        "msg"=>"当前API未开启"
    );
}elseif(!$token){
    $result = array(
        "code"=>-1,
        "msg"=>"TOKEN为空，请递交TOKEN"
    );
}elseif(!$row){
    $result = array(
        "code"=>-1,
        "msg"=>"TOKEN不存在"
    );
}elseif(!$mail){
    $result = array(
        "code"=>-1,
        "msg"=>"收件地址为空，请递交收件邮箱"
    );
}elseif(!$title){
    $result = array(
        "code"=>-1,
        "msg"=>"邮件标题为空，请递交邮件标题"
    );
}elseif(!$text){
    $result = array(
        "code"=>-1,
        "msg"=>"邮件内容为空，请递交邮件内容"
    );
}elseif(!$row['mail']){
    $result = array(
        "code"=>-1,
        "msg"=>"该用户没有设置邮箱，请前往用户资料绑定邮箱"
    );
}elseif($row['money']-$conf['api_mail_money']<0){
    $result = array(
        "code"=>-1,
        "msg"=>"用户余额不足，请先充值余额"
    );
}elseif(!$DB->query($sql)){
    $result = array(
        "code"=>-1,
        "msg"=>"用户余额扣除失败，请联系站长:".$conf['site_qq']."，".$DB->error().""
    );
}elseif(!$ad){
    $result = array(
        "code"=>-1,
        "msg"=>"计入调用总数失败，请联系站长:".$conf['site_qq']."，".$DB->error().""
    );
}elseif($ad && $DB->query($sql)){
    $result = send_mail_api($mail,$title,$text,$file,$row['uid'],$row['mail']);
    if($result==1){

    $DB->query("insert into `website_money_log` (`date`,`type`,`money`,`money_old`,`money_new`,`user`,`trade_no`,`ip`) values ('".$date."','支出||邮件发件接口','".$conf['api_mail_money']."','".$money_old."','".$money."','".$row['uid']."','".$date."','".$clientip."')");

    $DB->query("insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$row['uid']."','".$clientip."','".$city."','调用API','邮件发送接口发送给：".$mail." 、 标题： ".$title." 、 内容： ".$text." 、  附件： ".$file."'','".$date."','user')");
    $result = array(
        "code"=>1,
        "msg"=>"发送成功，已扣除用户余额并计入调用总数",
        "user_money"=>$row['money'],
        "api_money"=>$conf['api_mail_money'],
        "mail_user"=>$mail,
        "mail_title"=>$title,
        "mail_text"=>$text,
        "mail_file"=>$file
    );
    }else{
        $result = array(
            "code"=>-1,
            "msg"=>"系统配置错误，".$result."，请联系站长:".$conf['site_qq'].""
        );
    }
}else{
    $result = array(
        "code"=>-1,
        "msg"=>"未知错误，请联系站长:".$conf['site_qq'].""
    );
}
echo json_encode($result, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
?>