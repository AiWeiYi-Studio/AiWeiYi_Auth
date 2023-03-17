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
    case 'get_text':
        $id = $_POST['id'];
        $page = $_POST['page'];
        if($page){
            $row = $DB->get_row("select * from website_book where id = '{$page}'");
        }else{
            $row = $DB->get_row("select * from website_book where class = '{$id}' order by id asc limit 1");
        }
        if(!$id){
            $result = array(
                "code"=>-1,
                "msg"=>"参数不全，数据获取失败"
            );
        }elseif($row){
            $result = array(
                "code"=>1,
                "msg"=>"数据获取成功",
                "text"=>$row['text']
            );
        }else{
            $result = array(
                "code"=>-1,
                "msg"=>"数据获取失败：".$DB->error()
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