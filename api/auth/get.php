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
// 先Get获取数据，Get不到就获取POST数据
$act   = daddslashes($_GET['act'])?daddslashes($_GET['act']):daddslashes($_POST['act']);
$app   = daddslashes($_GET['app'])?daddslashes($_GET['app']):daddslashes($_POST['app']);
$uuid  = daddslashes($_GET['uuid'])?daddslashes($_GET['uuid']):daddslashes($_POST['uuid']);
$code  = daddslashes($_GET['code'])?daddslashes($_GET['code']):daddslashes($_POST['code']);

switch($act){
    case 'info':
        $row = $DB->get_row("SELECT * FROM website_app WHERE id = '".$app."' limit 1");
        if(!$app){
            $result = array(
                "code"=>-1,
                "msg"=>"没有递交程序类型"
            );
        }elseif(!$uuid){
            $result = array(
                "code"=>-1,
                "msg"=>"没有递交机器码"
            );
        }elseif(!$code){
            $result = array(
                "code"=>-1,
                "msg"=>"没有递交授权码"
            );
        }elseif($row){
            $result = array(
                "code"=>1,
                "date"=>$row['date'],
                "name"=>$row['name'],
                "notice"=>$row['notice'],
                "text"=>$row['text'],
                "status"=>(int)$row['status'],
                "msg"=>"获取云端信息成功",
                "expand"=>json_decode($row['expand'])
            );
        }else{
            $result = array(
                "code"=>-1,
                "msg"=>"程序类型不存在"
            );
        }
    break;
    
    case 'auth':
        $row = $DB->get_row("SELECT * FROM website_legal WHERE uuid='".$uuid."'  and type = '".$app."' limit 1");
        if(!$app){
            $result = array(
                "code"=>-1,
                "msg"=>"没有递交程序类型"
            );
        }elseif(!$uuid){
            $result = array(
                "code"=>-1,
                "msg"=>"没有递交机器码"
            );
        }elseif(!$row){
            $result = array(
                "code"=>-1,
                "msg"=>"当前机器查询不到授权码"
            );
        }elseif($row){
            $result = array(
                "code"=>1,
                "msg"=>"机器码获取成功",
                "authcode"=>$row['authcode']
            );
        }else{
            $result = array(
                "code"=>-1,
                "msg"=>"未知错误"
            );
        }
    break;
    
    default:
        $result = array(
            "code"=>-1,
            "msg"=>"No Act"
        );
    break;
}
echo json_encode($result, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);