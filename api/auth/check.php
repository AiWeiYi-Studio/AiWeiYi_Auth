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

$app         = daddslashes($_GET['app'])?daddslashes($_GET['app']):daddslashes($_POST['app']);
$uuid        = daddslashes($_GET['uuid'])?daddslashes($_GET['uuid']):daddslashes($_POST['uuid']);
$code        = daddslashes($_GET['code'])?daddslashes($_GET['code']):daddslashes($_POST['code']);
$row_app     = $DB->get_row("SELECT * FROM website_app WHERE id = '".$app."' limit 1");
$row_legal   = $DB->get_row("SELECT * FROM website_legal WHERE uuid = '".$uuid."' and authcode = '".$code."' and type = '".$app."' limit 1");
$row_legal_1 = $DB->get_row("SELECT * FROM website_legal WHERE uuid = '".$uuid."' and type = '".$app."' limit 1");

// 判断递交的参数是否完整
if(!$app || !$uuid || !$code){
    $result = array(
        "code"=>-1,
        "msg"=>"参数不全或错误"
    );
// 判断数据库是否存在该应用
}elseif(!$row_app){
    $result = array(
        "code"=>-1,
        "msg"=>"应用不存在"
    );
}elseif(!$row_legal_1){
    $result = array(
        "code"=>-1,
        "msg"=>$row_app['notice_not']
    );
}elseif(!$row_legal){
    $result = array(
        "code"=>-1,
        "msg"=>$row_app['notice_pirate']
    );
}elseif($row_legal['active'] == 0){
    $result = array(
        "code"=>-1,
        "msg"=>"授权封禁：".$row_legal['why']
    );
}elseif($row_app['status']==0){
    $result = array(
        "code"=>-1,
        "msg"=>$row_app['notice_status']
    );
}elseif(strtotime($row_legal['time']) < TIME){
    $result = array(
        "code"=>-1,
        "msg"=>$row_app['notice_date']
    );
}else{
    $result = array(
        "code"=>1,
        "msg"=>"授权验证成功",
        "app"=>$app,
        "app_name"=>$row_app['name'],
        "app_text"=>$row_app['text'],
        "uuid"=>$uuid,
        "ip"=>$row_legal['ip'],
        "authcode"=>$code,
        "memo"=>$row_legal['memo'],
        "contact"=>$row_legal['contact'],
        "date_now"=>$date,
        "date_add"=>$row_legal['date'],
        "date_end"=>$row_legal['time']
    );
}

echo json_encode($result, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);