<?php
/*
* @Time    : 2022/05/22 20:57
* @Author  : 爱唯逸网络科技
* @Mail    : support@857xx.cn
* @Site    : https://web.857xx.cn
* @File    : ajax.php
* @Action  : 悄悄话系统Ajax
*/

include("../../system/core/core.php");
@header('Content-Type: application/json; charset=UTF-8');

$act=isset($_GET['act'])?daddslashes($_GET['act']):null;

switch($act){
    case 'check_token':
        $token = $_POST['token'];
        $row   = $DB->get_row("SELECT * FROM website_privacy WHERE token = '$token' limit 1");
        if(!$token){
            $result=array(
                "code"=>-1,
                "msg"=>"请先输入密钥"
            );
        }elseif($row){
            $result=array(
                "code"=>1,
                "msg"=>"密钥正确",
                "url"=>$siteurls."privacy/".$row['token'].".html"
            );
        }else{
            $result=array(
                "code"=>-1,
                "msg"=>"密钥错误或悄悄话不存在"
            );
        }
    break;
    
    default:
        $result=array(
            "code"=>-1,
            "msg"=>"Not Act"
        );
    break;
}

echo json_encode($result, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);