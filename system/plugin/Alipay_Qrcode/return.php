<?php

require_once("../../core/core.php");
include_once 'lib/data.php';

$trade_no = $_GET['trade_no'];
$row = $DB->get_row("SELECT * FROM website_pay WHERE trade_no = '$trade_no' limit 1");
if(!$trade_no){
    exit('该订单号不存在，请返回重新生成订单<a href="javascript:window.history.back(-1);">返回</a>');
}elseif($row['status']=='1'){
    echo '<meta charset="utf-8"/><script>alert("当前订单已完成");window.location.href="'.$row['domain'].'";</script>';
}else{
    $rows = $DB->get_row("SELECT * FROM website_user WHERE uid='".$row['user']."' limit 1");
    $money_old = $rows['money'];
    $money_new = $rows['money'] + $row['money'];
    $json = Query($pay_config['appid'],$pay_config['private_key'],$trade_no);
    if($json['code']=='200' && $row['status']=='0' && $row['buy'] == 0) {
        $sql="update website_user set money = money+'".$row['money']."' where uid='".$row['user']."'";
        $sqls="update website_pay set status = '1', endtime='$date' where trade_no='$trade_no'";
        if($DB->query($sql) && $DB->query($sqls)){
            $DB->query("insert into `website_money_log` (`date`,`type`,`money`,`money_old`,`money_new`,`user`,`trade_no`,`ip`,`city`) values ('".$date."','收入||支付宝当面付','".$row['money']."','".$money_old."','".$money_new."','".$rows['uid']."','".$trade_no."','".$clientip."','".$city."')");
            echo '<meta charset="utf-8"/><script>alert("用户金额充值成功");window.location.href="'.$row['domain'].'";</script>';
        }else{
            echo '<meta charset="utf-8"/><script>alert("用户金额充值失败'.$DB->error().'");window.location.href="'.$row['domain'].'";</script>';
        }
    }elseif($json['code']=='200' && $row['status']=='0' && $row['buy'] != 0){
        $sql="update website_pay set status = '1', endtime='$date' where trade_no='$trade_no'";
        if($DB->query($sql)){
            echo '<meta charset="utf-8"/><script>alert("支付成功");window.location.href="'.$row['domain'].'";</script>';
        }else{
            echo '<meta charset="utf-8"/><script>alert("'.$DB->error().'");window.location.href="/user/my_money_log.php";</script>';
        }
    }else{
        echo $json['msg'];
    }
}
?>