<?php
/**
* @Time    : 2022/05/22 20:57
* @Author  : 爱唯逸网络科技
* @Mail    : support@857xx.cn
* @Site    : https://web.857xx.cn
* @File    : ajax.php
* @Action  : 网站首页Ajax
*/

include("./system/core/core.php");
@header('Content-Type: application/json; charset=UTF-8');

$act=isset($_GET['act'])?daddslashes($_GET['act']):null;

switch($act){
    case 'aaa':
        $result=array(
            "code"=>date("Y-m-d H:i:s",strtotime( "+1 year"))
        );
    break;
    case 'notice':
        if($conf['site_notice']){
            $result=array(
                "code"=>1,
                "msg"=>$conf['site_notice']
            );
        }else{
            $result=array(
                "code"=>-1
            );
        }
    break;
    case 'check_auth':
        $app=daddslashes($_POST['app']);
        $uuid=daddslashes($_POST['uuid']);
        $row=$DB->get_row("SELECT * FROM website_legal WHERE uuid='".$uuid."' and type='".$app."' limit 1");
        if(!$app || !$uuid){
            $result=array(
                "code"=>-1,
                "msg"=>"程序类型和识别码不能为空"
            );
        }elseif($row['active']=='0'){
            $result=array(
                "code"=>-1,
                "msg"=>"授权封禁：".$row['why']
            );
        }elseif($row && strtotime($row['time'])<=TIME){
            $result=array(
                "code"=>-1,
                "msg"=>"授权到期：".$row['time']
            );
        }elseif($row){
            $result=array(
                "code"=>1,
                "msg"=>"正版授权"
            );
        }else{
            $result=array(
                "code"=>-1,
                "msg"=>"查无授权"
            );
        }
    break;
    
    default:
        $result = array(
            "code"=>-4,
            "msg"=>"Not Act"
        );
    break;
}
echo json_encode($result, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
?>