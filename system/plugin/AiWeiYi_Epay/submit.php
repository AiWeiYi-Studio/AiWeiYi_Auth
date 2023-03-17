<?php
require_once("../../core/core.php");
require_once("epay.config.php");
require_once("lib/epay_submit.class.php");

$trade_no =$_GET['orderid'];
$row = $DB->get_row("SELECT * FROM website_pay WHERE trade_no='$trade_no' limit 1");
$type = $row['type'];

if(!$type){
    exit('没有选择支付类型');
}if(!$trade_no){
    exit('没有提交订单号');
}elseif(!is_numeric($trade_no)){
    exit('订单号不符合要求!');
}elseif(!$row){
    exit('该订单号不存在，请返回来源地重新发起请求！');
}elseif($row['money']=='0'){
    exit('订单金额不合法');
}elseif($row['status']==1){
    exit('该订单已支付完成，请返回重新生成订单<a href="'.$row['domain'].'">返回</a>');
}else{
    $notify_url    =   $siteurl.'notify_url.php';
    $return_url    =   $siteurl.'return_url.php';
    $out_trade_no  =   $trade_no;
    $type          =   $type;
    $name          =   $row['name'];
    $money         =   $row['money'];
    $sitename      =   $conf['site_title'];
    $parameter     =   [
        "pid"           =>   trim($alipay_config['partner']),
        "type"          =>   $type,
        "notify_url"	=>   $notify_url,
        "return_url"	=>   $return_url,
        "out_trade_no"	=>   $out_trade_no,
        "name"      	=>   $name,
        "money"	        =>   $money,
        "sitename"	    =>   $sitename
    ];

    //建立请求
    $alipaySubmit = new AlipaySubmit($alipay_config);
    $html_text    = $alipaySubmit->buildRequestForm($parameter);
    echo $html_text;
}
?>