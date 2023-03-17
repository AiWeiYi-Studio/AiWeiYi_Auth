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
    
// 用户余额充值Api接口
case 'chongzhi':
    $token = daddslashes($_GET['token']);//获取系统密钥
    $user  = daddslashes($_GET['user']);
    $money = daddslashes($_GET['money']);
    $type  = daddslashes($_GET['type']);//获取对接系统类型好返回参数
    $row   = $DB->get_row("SELECT * FROM website_user WHERE user='".$user."' limit 1");
    $rows  = $DB->get_row("SELECT * FROM website_user WHERE token='".$token."' limit 1");
    $money_new = $row['money'] + $money;
    $sql="update website_user set money='$money_new' where user='{$user}'";
    $sql_money_log = "insert into `website_money_log` (`date`,`type`,`money`,`money_old`,`money_new`,`user`,`trade_no`,`ip`,`city`) values ('".$date."','充值||API充值接口','".$money."','".$row['money']."','".$money_new."','".$row['uid']."','".$date."','".$clientip."','".$city."')";
    $sql_log="insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$rows['uid']."','".$clientip."','".$city."','API调用','调用用户充值API给账户：".$user."充值 ".$money." 元','".$date."','admin')";
    if(!$token || !$user || !$money || !$type){
        $result = array(
            "code"=>-1,
            "msg"=>"参数不全"
        );
    }elseif(!$rows){
        $result = array(
            "code"=>-1,
            "msg"=>"充值失败：密钥不存在"
        );
    }elseif(!$user){
        $result = array(
            "code"=>-1,
            "msg"=>"充值失败：用户账户不能为空"
        );
    }elseif(!$row){
        $result = array(
            "code"=>-1,
            "msg"=>"充值失败：用户账户不存在"
        );
    }elseif(!$money){
        $result = array(
            "code"-1,
            "msg"=>"充值失败：金额错误"
        );
    }elseif($DB->query($sql) && $DB->query($sql_log) && $DB->query($sql_money_log)){
        //开始判断对接的系统并选择对应的返回参数
        if($type=='1'){ // 彩虹自助下单系统
            $result = array(
                "code"=>0,
                "msg"=>"用户：".$user."充值".$money."元成功"
            );
        }elseif($type='2'){ // 小储云商城
            $result = array(
                "code"=>1,
                "msg"=>"用户：".$user."充值".$money."元成功"
            );
        }else{
            $result = array(
                "code"=>1,
                "msg"=>"用户：".$user."充值".$money."元成功"
            );
        }
    }else{
        $result = array(
            "code"=>-1,
            "msg"=>"充值失败：".$DB->error()
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
?>