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
$contact = daddslashes($_GET['contact'])?daddslashes($_GET['contact']):daddslashes($_POST['contact']);
$expand_1 = daddslashes($_GET['expand_1'])?daddslashes($_GET['expand_1']):daddslashes($_POST['expand_1']);
$expand_2 = daddslashes($_GET['expand_2'])?daddslashes($_GET['expand_2']):daddslashes($_POST['expand_2']);
$expand_3 = daddslashes($_GET['expand_3'])?daddslashes($_GET['expand_3']):daddslashes($_POST['expand_3']);
$expand_4 = daddslashes($_GET['expand_4'])?daddslashes($_GET['expand_4']):daddslashes($_POST['expand_4']);
$expand_5 = daddslashes($_GET['expand_5'])?daddslashes($_GET['expand_5']):daddslashes($_POST['expand_5']);

$row_pirate = $DB->get_row("SELECT * FROM website_pirate where uuid = '{$uuid}' and app = '{$app}' limit 1");
$row_legal  = $DB->get_row("SELECT * FROM website_legal WHERE uuid = '".$uuid."' and type = '".$app."' limit 1");

$sql_into = "insert into `website_pirate` (`uuid`,`contact`,`version`,`edition`,`ip`,`date`,`time`,`app`,`authcode`,`expand_1`,`expand_2`,`expand_3`,`expand_4`,`expand_5`) values ('".$uuid."','".$contact."','".$version."','".$edition."','".$clientip."','".$date."','".$date."','".$app."','".$code."','".$expand_1."','".$expand_2."','".$expand_3."','".$expand_4."','".$expand_5."')";
$sql_update ="update website_pirate set contact='{$contact}',version='{$version}',edition='{$edition}',ip='{$clientip}',time='{$date}',app='{$app}',authcode='{$code}',expand_1='".$expand_1."',expand_2='".$expand_2."',expand_3='".$expand_3."',expand_4='".$expand_4."',expand_5='".$expand_5."' where id='{$row_pirate['id']}'";

if(!$app || !$uuid){
    $result = array(
        "code"=>-1,
        "msg"=>"必要参数为空"
    );
}elseif($row_legal && $row_legal['authcode'] == $code && $row_legal['active']!=0){
    $result = array(
	    "code"=>-1,
        "msg"=>"正版授权，无法入库"
    );
}elseif($row_pirate){
    if($row_pirate['contact'] != $contact || $row_pirate['version'] != $version || $row_pirate['edition'] != $edition || $row_pirate['ip'] != $clientip || $row_pirate['authcode'] != $code || $row_pirate['expand_1'] != $expand_1 || $row_pirate['expand_2'] != $expand_2 || $row_pirate['expand_3'] != $expand_3 || $row_pirate['expand_4'] != $expand_4  || $row_pirate['expand_5'] != $expand_5){
        if($DB->query($sql_update)){
            $result = array(
                "code"=>1,
                "msg"=>"更新数据成功"
            );
        }else{
            $result = array(
                "code"=>-1,
                "msg"=>$DB->error()
            );
        }
    }else{
        $result = array(
            "code"=>-1,
            "msg"=>"数据无需更新".$expand_3
        );
    }
}elseif($DB->query($sql_into)){
    $result = array(
        "code"=>1,
        "msg"=>"记录成功"
    );
}else{
    $result = array(
	   "code"=>-1,
        "msg"=>$DB->error()
    );
}
echo json_encode($result, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);