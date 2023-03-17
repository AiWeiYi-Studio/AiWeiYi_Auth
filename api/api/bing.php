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
$day   = daddslashes($_GET['day']);

if(!$day){
    $day = '0';
}
$str = file_get_contents('https://cn.bing.com/HPImageArchive.aspx?format=js&idx='.$day.'&n=1');
$str = json_decode($str,true);
$imgurl = 'https://cn.bing.com'.$str['images'][0]['url'];
$img_date = $str['images'][0]['startdate'];

$row = $DB->get_row("SELECT * FROM website_user WHERE token='$token' limit 1");
if($conf['api_bing_active']=='0'){
    $result = array(
        "code"=>-1,
        "msg"=>"当前API未开"
    );
}elseif(!$token){
    $result = array(
        "code"=>-1,
        "msg"=>"TOKEN不能为空"
    );
}elseif(!$row){
    $result = array(
        "code"=>-1,
        "msg"=>"TOKEN不存在"
    );
}elseif($row['money']-$conf['api_bing_money']<0){
    $result = array(
        "code"=>-1,
        "msg"=>"用户余额不足，请先充值余额"
    );
}else{
    //扣除用户余额
    $money = $row['money']-$conf['api_bing_money'];
    $money_old = $row['money'];
    $sql="update website_user set money='$money' where token='{$token}'";
    //记录总调用数
    $number = $conf['api_bing_number']+1;
    saveSetting('api_bing_number',$number);
    $ad=$CACHE->clear();
    if($ad && $DB->query($sql)){
        $DB->query("insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$row['uid']."','".$clientip."','".$city."','调用API','调用必应每日一图','".$date."','user')");
        $DB->query("insert into `website_money_log` (`date`,`type`,`money`,`money_old`,`money_new`,`user`,`trade_no`,`ip`) values ('".$date."','支出||调用必应每日一图','".$conf['api_bing_money']."','".$money_old."','".$money."','".$row['uid']."','".$date."','".$clientip."')");
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
                "img_date"=>$img_date,
                "user_money"=>$row['money'],
                "api_money"=>$conf['api_bing_money']
            );
        }
    }else{
        $result = array(
            "code"=>-1,
            "msg"=>"计入调用总数失败，请联系站长:".$conf['site_qq'].""
        );
    }
}

echo json_encode($result, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
?>