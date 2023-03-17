<?php
/*
* @Time    : 2022/08/05 19:22:02
* @Author  : 爱唯逸网络科技
* @Mail    : support@857xx.cn
* @Site    : https://web.857xx.cn
* @File    : update.php
* @Action  : 获取程序更新包
*/

include("../../system/core/core.php");

@header('Content-Type: application/json; charset=UTF-8');

$app     = daddslashes($_GET['app'])?daddslashes($_GET['app']):daddslashes($_POST['app']);
$uuid    = daddslashes($_GET['uuid'])?daddslashes($_GET['uuid']):daddslashes($_POST['uuid']);
$code    = daddslashes($_GET['code'])?daddslashes($_GET['code']):daddslashes($_POST['code']);
$version = daddslashes($_GET['version'])?daddslashes($_GET['version']):daddslashes($_POST['version']);
$edition = daddslashes($_GET['edition'])?daddslashes($_GET['edition']):daddslashes($_POST['edition']);

//查询正版授权表的数据
$row     = $DB->get_row("SELECT * FROM website_legal WHERE uuid = '".$uuid."' and type = '".$app."' limit 1");
//查询程序表的数据
$row_app = $DB->get_row("SELECT * FROM website_app WHERE id = '".$app."' limit 1");
// 获取最新更新包
$row_update1= $DB->get_row("SELECT * FROM website_update WHERE app = '".$app."' and status ='1' and beta = '{$row['beta']}' order by version desc limit 1");
// 根据递交的参数version获取下一个更新包
$row_update2= $DB->get_row("SELECT * FROM website_update WHERE status = '1' and app = '".$app."' and beta = '{$row['beta']}' and version = (select min(version) from website_update where status ='1' and app = '".$app."' and beta = '{$row['beta']}' and version > '".$version."')");

if(!$app || !$uuid || $uuid == '127.0.0.1' || $uuid == 'localhost' || !$code || !$version){
    $result = array(
        "code"=>-1,
        "msg"=>"参数不全或错误，请检查",
        "edition"=>$row_update1['edition']?$row_update1['edition']:$edition,
        "version"=>(int)$row_update1['version']?$row_update1['version']:$version
    );
}elseif($row_app['status'] == '0'){
    $result = array(
        "code"=>-1,
        "msg"=>$row_app['notice_status'],
        "edition"=>$row_update1['edition']?$row_update1['edition']:$edition,
        "version"=>(int)$row_update1['version']?$row_update1['version']:$version
    );
}elseif($row['authcode'] != $code){
    $result = array(
        "code"=>-1,
        "msg"=>$row_app['notice_pirate'],
        "edition"=>$row_update1['edition']?$row_update1['edition']:$edition,
        "version"=>(int)$row_update1['version']?$row_update1['version']:$version
    );
}elseif(!$row){
    $result = array(
        "code"=>-1,
        "msg"=>$row_app['notice_not'],
        "edition"=>$row_update1['edition']?$row_update1['edition']:$edition,
        "version"=>(int)$row_update1['version']?$row_update1['version']:$version
    );
}elseif($row['active'] == '0'){
    $result = array(
        "code"=>-1,
        "msg"=>"授权封禁：".$row['why'],
        "edition"=>$row_update1['edition']?$row_update1['edition']:$edition,
        "version"=>(int)$row_update1['version']?$row_update1['version']:$version
    );
}elseif(strtotime($row['time']) < TIME){
    $result = array(
        "code"=>-1,
        "msg"=>$row_app['notice_date'],
        "edition"=>$row_update1['edition']?$row_update1['edition']:$edition,
        "version"=>(int)$row_update1['version']?$row_update1['version']:$version
    );
}elseif($version >= $row_update1['version']){
    $result = array(
        "code"=>1,
        "msg" =>"您使用的已是最新版本",
        "edition"=>$row_update1['edition']?$row_update1['edition']:$edition,
        "version"=>(int)$row_update1['version']?$row_update1['version']:$version
    );
}else{
    $result = array(
        "code"=>2,
        "msg" =>"检测到系统更新",
        "app"=>$row_app['name'],
        "edition"=>$row_update2['edition'],
        "version"=>(int)$row_update2['version'],
        "download"=>$row_update2['download'],
        "log"=>$row_update2['log'],
        "text"=>$row_update2['text'],
        "beta"=>(int)$row_update2['beta'],
        "type"=>(int)$row_update2['type']
    );
}
echo json_encode($result, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);