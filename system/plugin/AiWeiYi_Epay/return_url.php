<?php
/* * 
 * 功能：彩虹易支付页面跳转同步通知页面
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
 * 该代码仅供学习和研究支付宝接口使用，只是提供一个参考。

 *************************页面功能说明*************************
 * 该页面可在本机电脑测试
 * 可放入HTML等美化页面的代码、商户业务逻辑程序代码
 * 该页面可以使用PHP开发工具调试，也可以使用写文本函数logResult，该函数已被默认关闭，见epay_notify_class.php中的函数verifyReturn
 */
require_once("../../core/core.php");
require_once("epay.config.php");
require_once("lib/epay_notify.class.php");

//计算得出通知验证结果
$alipayNotify = new AlipayNotify($alipay_config);
$verify_result = $alipayNotify->verifyReturn();
if($verify_result) {//验证成功
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//请在这里加上商户的业务逻辑程序代码
	
	//——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
    //获取支付宝的通知返回参数，可参考技术文档中页面跳转同步通知参数列表

	//商户订单号

	$out_trade_no = $_GET['out_trade_no'];

	//支付宝交易号

	$trade_no = $_GET['trade_no'];

	//交易状态
	$trade_status = $_GET['trade_status'];

	//支付方式
	$type = $_GET['type'];
    if($type=='qqpay'){
        $types = 'QQ';
    }elseif($type=='wxpay'){
        $types = '微信';
    }elseif($type=='alipay'){
        $types = '支付宝';
    }
    $row = $DB->get_row("SELECT * FROM website_pay WHERE trade_no='$out_trade_no' limit 1");
    $rows = $DB->get_row("SELECT * FROM website_user WHERE uid='".$row['user']."' limit 1");
    $money_old = $rows['money'];
    $money_new = $rows['money']+$row['money'];
    if($_GET['trade_status'] == 'TRADE_SUCCESS' && $row['buy'] == 0) {
		$sql="update website_user set money = money+'".$row['money']."' where uid='".$row['user']."'";
        $sqls="update website_pay set status = '1', endtime='$date' where trade_no='$out_trade_no'";
		if($DB->query($sql) && $DB->query($sqls)){
		    $DB->query("insert into `website_money_log` (`date`,`type`,`money`,`money_old`,`money_new`,`user`,`trade_no`,`ip`,`city`) values ('".$date."','收入||".$types."','".$row['money']."','".$money_old."','".$money_new."','".$rows['uid']."','".$out_trade_no."','".$clientip."','".$city."')");
            echo '<meta charset="utf-8"/><script>alert("用户金额充值成功");window.location.href="'.$row['domain'].'";</script>';
        }else{
            echo '<meta charset="utf-8"/><script>alert("用户金额充值失败'.$DB->error().'");window.location.href="'.$row['domain'].'";</script>';
        }
    }elseif($_GET['trade_status'] == 'TRADE_SUCCESS' && $row['buy'] != 0) {
        $sql="update website_pay set status = '1', endtime='$date' where trade_no='$out_trade_no'";
        if($DB->query($sql)){
            echo '<meta charset="utf-8"/><script>alert("支付成功");window.location.href="'.$row['domain'].'";</script>';
        }else{
            echo '<meta charset="utf-8"/><script>alert("'.$DB->error().'");window.location.href="/user/my_money_log.php";</script>';
        }
    }else {
      echo "trade_status=".$_GET['trade_status'];
    }

	//——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}else {
    //验证失败
    //如要调试，请看alipay_notify.php页面的verifyReturn函数
    echo "验证失败";
}
?>