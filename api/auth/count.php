<?php
/*
* @Time    : 2022/11/14 00:15
* @Author  : 爱唯逸网络科技
* @Mail    : support@857xx.cn
* @Action  : 服务端统计使用数据
*/

include("../../system/core/core.php");
@header('Content-Type: application/json; charset=UTF-8');

// 先Get获取数据，Get不到就获取POST数据
$act   = daddslashes($_GET['act'])?daddslashes($_GET['act']):daddslashes($_POST['act']);
$app   = daddslashes($_GET['app'])?daddslashes($_GET['app']):daddslashes($_POST['app']);
$uuid  = daddslashes($_GET['uuid'])?daddslashes($_GET['uuid']):daddslashes($_POST['uuid']);

switch($act){
    // 程序使用统计
    case 'app_use':
        // 检索MySQL数据库正版授权表
        $row   = $DB->get_row("SELECT * FROM website_legal WHERE uuid = '".$uuid."' and type = '".$app."' limit 1");
        // 检索MySQL数据库使用统计表
        $rows  = $DB->get_row("SELECT * FROM website_usecount order by id desc limit 10");
        // 如果正版授权表满足检索条件的话则给变量赋值检索到的数据，反之则默认赋值0
        $user  = $row['user']?$row['user']:'0';
        // MySQL数据库插入数据命令
        $sql   = "insert into `website_usecount` (`app`,`uuid`,`date`,`user`,`ip`) values ('".$app."','".$uuid."','".TIME."','".$user."','".$clientip."')";
        // 如果获取不到数值则返回
        if(!$app || !$uuid){
            $result = array(
            "code"=>-1,
            "msg"=>"必要参数为空"
        );
        // 防止恶意记录，十分钟内IP一样的数据不给予记录
        }elseif($rows['date'] > TIME - 600 && $rows['ip'] == $clientip){
            $result = array(
            "code"=>-1,
                "msg"=>"不可频繁记录"
            );
        // 执行插入命令
        }elseif($DB->query($sql)){
            $result = array(
                "code"=>1,
                "msg"=>"记录成功"
            );
        // 以上条件全不满足时输出MySQL插入错误信息
        }else{
            $result = array(
                "code"=>-1,
                "msg"=>$DB->error()
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