<?php
include_once 'service.class.php';
include_once 'query.class.php';
include_once 'config.php';
$domain = RealUrl();

if($_REQUEST['action'] == "serve"){
    if($_POST['trade_no']){
        $trade_no = $_POST['trade_no'];
        $json = Query($pay_config['appid'],$pay_config['private_key'],$trade_no);
        echo json_encode($json,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
    }elseif($_GET['trade_no']){
        $trade_no = $_GET['trade_no'];
        $json = Query($pay_config['appid'],$pay_config['private_key'],$trade_no);
        echo json_encode($json,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
    }else{
        $text = array(
            'code'=>'202',
            'msg' =>'订单号为空'
            );
        echo json_encode($text);
    }
}

//发起订单
function Service($appid,$private,$payAmount,$orderDes,$OrderID,$notify=''){
	$aliPay = new AlipayService();
	$aliPay->setAppid($appid);
	$aliPay->setNotifyUrl($notify);
	$aliPay->setRsaPrivateKey($private);
	$aliPay->setTotalFee($payAmount);
	$aliPay->setOutTradeNo($OrderID);
	$aliPay->setOrderName($orderDes);
	$result = $aliPay->doPay();
	$value = $result['alipay_trade_precreate_response'];
	return $value;
}
//查询订单状态
function Query($appid,$private,$outTradeNo){
	$aliPay = new AlipayQuery();
	$aliPay->setAppid($appid);
	$aliPay->setRsaPrivateKey($private);
	$aliPay->setOutTradeNo($outTradeNo);
	$result = $aliPay->doQuery();
	$data = $result['alipay_trade_query_response'];
	if($data['trade_status'] == 'TRADE_SUCCESS'){
		$value = array('code'=>200,'msg'=>'支付成功');
	}else{
		$value = array('code'=>202,'msg'=>'未知状态');
	}
	return $value;
}
//获取当前域名
function RealUrl(){
	static $real_url = NULL;   
	if ($real_url !== NULL){return $real_url;}
	$real_url  = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
	$real_url .= $_SERVER["SERVER_NAME"];
	$real_url .= in_array($_SERVER['SERVER_PORT'], array(80, 443)) ? '/' : ':' . $_SERVER['SERVER_PORT'];
	return $real_url;
}
