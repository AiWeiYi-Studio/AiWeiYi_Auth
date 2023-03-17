<?php
include("../system/core/core.php");
$act=isset($_GET['act'])?daddslashes($_GET['act']):null;
if($islogins==1){}else exit('{"code":-1,"msg":"你还没有登录"}');
@header('Content-Type: application/json; charset=UTF-8');
switch($act){
    
case 'get_auth_time_active':
    $app  = daddslashes($_POST['app']);
    $row  = $DB->get_row("SELECT * FROM website_app WHERE id = '{$app}' limit 1");
    if(!$app){
	    $result = array(
            "code"=>-1,
            "msg"=>"参数不全"
        );
	}elseif($row){
	    $result = array(
            "code"=>1,
            "msg"=>"获取成功",
            "day"=>$row['money_day'],
            "month"=>$row['money_month'],
            "year"=>$row['money_year'],
            "long"=>$row['money_long']
        );
	}else{
	    $result = array(
            "code"=>-1,
            "msg"=>"可能没有这个程序哦"
        );
	}
break;

case 'get_auth_text':
    $app  = daddslashes($_POST['app']);
    $row  = $DB->get_row("SELECT * FROM website_app WHERE id = '{$app}' limit 1");
    if(!$app){
	    $result = array(
            "code"=>-1,
            "msg"=>"参数不全"
        );
	}elseif($row){
	    $result = array(
            "code"=>1,
            "msg"=>"获取成功",
            "text"=>$row['text']
        );
	}else{
	    $result = array(
            "code"=>-1,
            "msg"=>"可能没有这个程序哦"
        );
	}
    
break;

case 'get_auth_money':
    $app  = daddslashes($_POST['app']);
    $time = daddslashes($_POST['time']);
    $row  = $DB->get_row("SELECT * FROM website_app WHERE id = '{$app}' limit 1");
    if($time == 'day'){
        $money = $row['money_day'];
    }elseif($time == 'month'){
        $money = $row['money_month'];
    }elseif($time == 'year'){
        $money = $row['money_year'];
    }elseif($time == 'long'){
        $money = $row['money_long'];
    }else{
        $money = 0;
    }
    if(!$app || !$time){
	    $result = array(
            "code"=>-1,
            "msg"=>"参数不全"
        );
	}elseif($row){
	    $result = array(
            "code"=>1,
            "msg"=>"获取成功",
            "money"=>$money
        );
	}else{
	    $result = array(
            "code"=>-1,
            "msg"=>"可能没有这个程序哦"
        );
	}
    
break;
    
case 'shop_auth':
    $app = daddslashes($_POST['app']);
    $uuid = daddslashes($_POST['uuid']);
    $contact = daddslashes($_POST['contact']);
    $type = daddslashes($_POST['type']); // 1为支付宝，2为QQ，3为微信，4为钱包
    $authcode = get_authcode($uuid);
    $token = get_token();
    $time = daddslashes($_POST['time']);
    $row_app = $DB->get_row("SELECT * FROM website_app WHERE id = '".$app."' limit 1");
    $row_legal = $DB->get_row("SELECT * FROM website_legal WHERE uuid = '".$uuid."' and type = '{$app}' limit 1");
    if($time == 'day'){
        $time = date("Y-m-d H:i:s",strtotime( "+1 day"));
        $money = $row_app['money_day'];
    }elseif($time == 'month'){
        $time = date("Y-m-d H:i:s",strtotime( "+1 month"));
        $money = $row_app['money_month'];
    }elseif($time == 'year'){
        $time = date("Y-m-d H:i:s",strtotime( "+1 year"));
        $money = $row_app['money_year'];
    }elseif($time == 'long'){
        $time='9999-1-1 00:00:00';
        $money = $row_app['money_long'];
    }else{
        $time = null;
        $money = 9999;
    }
    if(!$app || !$uuid || !$contact || !$type || !$time){
	    $result = array(
            "code"=>-1,
            "msg"=>"参数不全"
        );
	}elseif($row_legal){
	    $result = array(
            "code"=>-1,
            "msg"=>"当前授权已存在"
        );
	}elseif($type==1){
	    $type = 'alipay';
	    $trade_no = get_trade_no();
	    $row_legal = $DB->get_row("select * FROM website_legal order by id desc limit 1");
	    $row_legalid = $row_legal['id'] +1;
	    $domain = $siteurl.'shop_auth.php?mod=return&legal='.$row_legalid.'&trade_no='.$trade_no;
	    $sql_pay="insert into `website_pay` (`trade_no`,`type`,`addtime`,`name`,`money`,`ip`,`city`,`user`,`domain`,`status`,`buy`) values ('".$trade_no."','".$type."','".$date."','".$conf['site_title']." - ".$row_app['name']."程序授权','".$money."','".$clientip."','".$city."','".$udata['uid']."','".$domain."','0','".$row_legalid."')";
	    
	    $sql_legal="insert into `website_legal` (`date`,`time`,`uuid`,`ip`,`authcode`,`token`,`contact`,`user`,`active`,`type`,`why`) values ('".$date."','".$time."','".$uuid."','".$ip."','".$authcode."','".$token."','".$contact."','".$udata['uid']."','0','".$app."','购买订单未支付，可前往订单明细补单')";
	    
	    $sql_log = "insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','购买','购买".$row_app['name']."授权：".$uuid."','".$date."','user')";
	    if($DB->query($sql_pay) && $DB->query($sql_log) && $DB->query($sql_legal)){
	        if($conf['pay_alipay_api']=='1'){
	            $url = $siteurls.'system/plugin/AiWeiYi_Epay/submit.php?type='.$type.'&orderid='.$trade_no;
	        }elseif($conf['pay_alipay_api']=='2'){
	            $url = $siteurls.'system/plugin/Alipay_Qrcode/submit.php?orderid='.$trade_no;
	        }
	        $result = array(
	            "code"=>1,
	            "msg"=>"请耐心等待系统跳转...",
	            "url"=>$url
	        );
	    }else{
	        $result = array(
	            "code"=>-1,
	            "msg"=>$DB->error()
	        );
	    }
	}elseif($type==2){
	    $type = 'qqpay';
	    $trade_no = get_trade_no();
	    $row_legal = $DB->get_row("select * FROM website_legal order by id desc limit 1");
	    $row_legalid = $row_legal['id'] +1;
	    $domain = $siteurl.'shop_auth.php?mod=return&legal='.$row_legalid.'&trade_no='.$trade_no;
	    $sql_pay="insert into `website_pay` (`trade_no`,`type`,`addtime`,`name`,`money`,`ip`,`city`,`user`,`domain`,`status`,`buy`) values ('".$trade_no."','".$type."','".$date."','".$conf['site_title']." - ".$row_app['name']."程序授权','".$money."','".$clientip."','".$city."','".$udata['uid']."','".$domain."','0','".$row_legalid."')";
	    
	    $sql_legal="insert into `website_legal` (`date`,`time`,`uuid`,`ip`,`authcode`,`token`,`contact`,`user`,`active`,`type`,`why`) values ('".$date."','".$time."','".$uuid."','".$ip."','".$authcode."','".$token."','".$contact."','".$udata['uid']."','0','".$app."','购买订单未支付，可前往订单明细补单')";
	    
	    $sql_log = "insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','购买','购买".$row_app['name']."授权：".$uuid."','".$date."','user')";
	    if($DB->query($sql_pay) && $DB->query($sql_log) && $DB->query($sql_legal)){
	        if($conf['pay_qqpay_api']=='1'){
	            $url = $siteurls.'system/plugin/AiWeiYi_Epay/submit.php?type='.$type.'&orderid='.$trade_no;
	        }
	        $result = array(
	            "code"=>1,
	            "msg"=>"请耐心等待系统跳转...",
	            "url"=>$url
	        );
	    }else{
	        $result = array(
	            "code"=>-1,
	            "msg"=>$DB->error()
	        );
	    }
	}elseif($type==3){
	    $type = 'wxpay';
	    $trade_no = get_trade_no();
	    $row_legal = $DB->get_row("select * FROM website_legal order by id desc limit 1");
	    $row_legalid = $row_legal['id'] +1;
	    $domain = $siteurl.'shop_auth.php?mod=return&legal='.$row_legalid.'&trade_no='.$trade_no;
	    $sql_pay="insert into `website_pay` (`trade_no`,`type`,`addtime`,`name`,`money`,`ip`,`city`,`user`,`domain`,`status`,`buy`) values ('".$trade_no."','".$type."','".$date."','".$conf['site_title']." - ".$row_app['name']."程序授权','".$money."','".$clientip."','".$city."','".$udata['uid']."','".$domain."','0','".$row_legalid."')";
	    
	    $sql_legal="insert into `website_legal` (`date`,`time`,`uuid`,`ip`,`authcode`,`token`,`contact`,`user`,`active`,`type`,`why`) values ('".$date."','".$time."','".$uuid."','".$ip."','".$authcode."','".$token."','".$contact."','".$udata['uid']."','0','".$app."','购买订单未支付，可前往订单明细补单')";
	    
	    $sql_log = "insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','购买','购买".$row_app['name']."授权：".$uuid."','".$date."','user')";
	    if($DB->query($sql_pay) && $DB->query($sql_log) && $DB->query($sql_legal)){
	        if($conf['pay_qqpay_api']=='1'){
	            $url = $siteurls.'system/plugin/AiWeiYi_Epay/submit.php?type='.$type.'&orderid='.$trade_no;
	        }
	        $result = array(
	            "code"=>1,
	            "msg"=>"请耐心等待系统跳转...",
	            "url"=>$url
	        );
	    }else{
	        $result = array(
	            "code"=>-1,
	            "msg"=>$DB->error()
	        );
	    }
	}elseif($type==4){
	    $money_new = $udata['money']-$money;
	    $sql_legal="insert into `website_legal` (`date`,`time`,`uuid`,`ip`,`authcode`,`token`,`contact`,`user`,`active`,`type`) values ('".$date."','".$time."','".$uuid."','".$ip."','".$authcode."','".$token."','".$contact."','".$udata['uid']."','1','".$app."')";
	    
	    $sql_log = "insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','购买','购买".$row_app['name']."授权：".$uuid."','".$date."','user')";
	    
	    $sql_money_log = "insert into `website_money_log` (`date`,`type`,`money`,`money_old`,`money_new`,`user`,`trade_no`,`ip`,`city`) values ('".$date."','支出||购买".$row_app['name']."授权','".$money."','".$udata['money']."','".$money_new."','".$udata['uid']."','".$date."','".$clientip."','".$city."')";
	    
	    $sql_update ="update website_user set money='".$money_new."' where uid='{$udata['uid']}'";
	    if($money_new < 0){
	        $result = array(
	            "code"=>-1,
	            "msg"=>"账户余额不足"
	        );
	    }elseif($DB->query($sql_update) && $DB->query($sql_money_log) && $DB->query($sql_log) && $DB->query($sql_legal)){
	        $result = array(
	            "code"=>1,
	            "msg"=>"购买成功",
	            "url"=>"./auth_list.php"
	        );
	    }else{
	        $result = array(
	            "code"=>-1,
	            "msg"=>$DB->error()
	        );
	    }
	}
break;
    
case 'shop_mail_time':
    $money=$udata['money']-$conf['shop_mail_time_money'];
    $sql="update website_user set money='".$money."' where uid='{$udata['uid']}'";
    $money_old = $udata['money'];
    if($udata['money']-$conf['shop_mail_time_money']<=0){
        $result = array(
            "code"=>-1,
            "msg"=>"余额不足，请先充值"
        );
    }elseif($DB->query($sql)){
        $city=get_ip_city($clientip);
        $DB->query("update website_user set mail_time = mail_time+'10' where uid='{$udata['uid']}'");
        $DB->query("insert into `website_money_log` (`date`,`type`,`money`,`money_old`,`money_new`,`user`,`trade_no`,`ip`) values ('".$date."','支出||邮件余额','".$conf['shop_mail_time_money']."','".$money_old."','".$money."','".$udata['uid']."','".$date."','".$clientip."')");
        $DB->query("insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','购买','购买邮件余额10个，花费".$conf['shop_mail_time_money']."元','".$date."','user')");
        $result = array(
            "code"=>1,
            "msg"=>"购买成功"
        );
	}else{
	    $result = array(
            "code"=>-1,
            "msg"=>$DB->error()
        );
	}
break;

case 'shop_phone_time':
    $money=$udata['money']-$conf['shop_phone_time_money'];
    $money_old = $udata['money'];
    $sql="update website_user set money='".$money."' where uid='{$udata['uid']}'";
    if($udata['money']-$conf['shop_phone_time_money']<=0){
        $result = array(
            "code"=>-1,
            "msg"=>"余额不足，请先充值"
        );
    }elseif($DB->query($sql)){
        // 更新用户短信额度
        $DB->query("update website_user set phone_time = phone_time+'10' where uid='{$udata['uid']}'");
        // 记录用户资金明细
        $DB->query("insert into `website_money_log` (`date`,`type`,`money`,`money_old`,`money_new`,`user`,`trade_no`,`ip`) values ('".$date."','支出||短信余额','".$conf['shop_phone_time_money']."','".$money_old."','".$money."','".$udata['uid']."','".$date."','".$clientip."')");
        // 记录用户操作日志
        $DB->query("insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','购买','购买短信余额10个，花费".$conf['shop_mail_time_money']."元','".$date."','user')");
        $result = array(
            "code"=>1,
            "msg"=>"购买成功"
        );
	}else{
        $result = array(
            "code"=>-1,
            "msg"=>$DB->error()
        );
	}
break;

case 'shop_user_chat':
    $money=$udata['money']-$conf['shop_user_chat_money'];
    $money_old = $udata['money'];
    $sql="update website_user set money = '".$money."' where uid='{$udata['uid']}'";
    if($udata['money']-$conf['shop_user_chat_money']<=0){
        $result = array(
            "code"=>-1,
            "msg"=>"余额不足，请先充值"
        );
    }elseif($DB->query($sql)){
        $DB->query("update website_user set active_chat = '1' where uid='{$udata['uid']}'");
        
        $DB->query("insert into `website_money_log` (`date`,`type`,`money`,`money_old`,`money_new`,`user`,`trade_no`,`ip`) values ('".$date."','支出||解除禁言','".$conf['shop_user_chat_money']."','".$money_old."','".$money."','".$udata['uid']."','".$date."','".$clientip."')");
        
        $DB->query("insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','购买','购买发言功能，花费".$conf['shop_user_chat_money']."元','".$date."','user')");
        $result = array(
            "code"=>1,
            "msg"=>"购买成功"
        );
	}else{
        $result = array(
            "code"=>-1,
            "msg"=>$DB->error()
        );
	}
break;

default:
        $result = array(
            "code"=>-4,
            "msg"=>"No Act"
        );
break;
}
echo json_encode($result, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
?>