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

$act=isset($_GET['act'])?daddslashes($_GET['act']):null;

switch($act){
    // 获取用户Token
    case 'token':
        $username = daddslashes($_GET['username']);
        $password = daddslashes($_GET['password']);
        $row      = $DB->get_row("SELECT * FROM website_user WHERE user='".$username."' limit 1");
        if(!$row){
             $result = array(
                 "code"=>-1,
                 "msg"=>"用户不存在"
            );
        }elseif($row['pass'] != $password){
            $result = array(
                "code"=>-1,
                "msg"=>"密码错误"
            );
        }elseif($row && $row['pass'] == $password){
            $result = array(
                "code"=>1,
                "msg"=>$row['token']
            );
        }
    break;
    // 错误返回
    default:
        $result = array(
            "code"=>-1,
            "msg"=>"Not Act"
        );
    break;
}

echo json_encode($result, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);