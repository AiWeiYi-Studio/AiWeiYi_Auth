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
$token = daddslashes($_GET['token']);
$do    = daddslashes($_GET['do']);
$photo = daddslashes($_GET['photo']);
$row  = $DB->get_row("SELECT * FROM website_user WHERE token='$token' limit 1");

if($photo==1){
    $photo = 'meizi';
}elseif($photo==2){
    $photo = 'dongman';
}elseif($photo==3){
    $photo = 'fengjing';
}elseif($photo==4){
    $photo = 'suiji';
}

$str = file_get_contents('https://api.btstu.cn/sjbz/api.php?lx='.$photo.'&format=json');
$str = json_decode($str,true);
$imgurl = $str['imgurl'];

//扣除用户余额
$money = $row['money']-$conf['api_photo_money'];
$money_old = $row['money'];
$sql="update website_user set money='$money' where token='{$token}'";
$sql_log = "insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$row['uid']."','".$clientip."','".$city."','调用API','调用随机图片，图片：".$imgurl."','".$date."','user')";
$sql_money_log = "insert into `website_money_log` (`date`,`type`,`money`,`money_old`,`money_new`,`user`,`trade_no`,`ip`,`city`) values ('".$date."','支出||调用随机图片接口','".$conf['api_photo_money']."','".$money_old."','".$money."','".$row['uid']."','".$date."','".$clientip."','".$city."')";
//记录总调用数
$number = $conf['api_photo_number']+1;
saveSetting('api_photo_number',$number);
$ad=$CACHE->clear();

if($conf['api_photo_active']=='0'){
    $result = array(
        "code"=>-1,
        "msg"=>"当前API未开启"
    );
}elseif(!$token){
    $result = array(
        "code"=>-1,
        "msg"=>"TOKEN为空，请递交TOKEN"
    );
}elseif(!$row){
    $result = array(
        "code"=>-1,
        "msg"=>"TOKEN不存在"
    );
}elseif(!$photo){
    $result = array(
        "code"=>-1,
        "msg"=>"类型为空"
    );
}elseif($row['money']-$conf['api_photo_money']<0){
    $result = array(
        "code"=>-1,
        "msg"=>"用户余额不足，请先充值余额"
    );
}elseif(!$imgurl){
    $result = array(
        "code"=>-1,
        "msg"=>"图片地址获取失败"
    );
}elseif($ad && $DB->query($sql) && $DB->query($sql_money_log) && $DB->query($sql_log)){
    if($do=='1'){
        header('Content-Type: image/JPEG');
        @ob_end_clean();
        @readfile($imgurl);
        @flush(); @ob_flush();
        exit();
    }else{
        $result = array(
            "code"=>1,
            "msg"=>"调用成功，已扣除用户余额并计入调用总数",
            "imgurl"=>$imgurl,
            "user_money"=>$row['money'],
            "api_money"=>$conf['api_photo_money']
        );
    }
}else{
    $result = array(
        "code"=>-1,
        "msg"=>$DB->error()
    );
}
echo json_encode($result, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
?>