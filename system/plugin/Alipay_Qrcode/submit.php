<?php
require_once("../../core/core.php");
include_once 'lib/data.php';

$title = '支付宝当面付';

$trade_no =$_GET['orderid'];
$row = $DB->get_row("SELECT * FROM website_pay WHERE trade_no='$trade_no' limit 1");
$data = Service($pay_config['appid'],$pay_config['private_key'],$row['money'],$row['name'],$trade_no);

if(!$trade_no){
    exit('没有提交订单号');
}elseif(!is_numeric($trade_no)){
    exit('订单号不符合要求!');
}elseif(!$row){
    exit('该订单号不存在，请返回重新生成订单<a href="javascript:window.history.back(-1);">返回</a>');
}elseif($row['money']=='0'){
    exit('订单金额不合法');
}elseif($row['status']==1){
    exit('该订单已支付完成，请返回重新生成订单<a href="'.$row['domain'].'">返回</a>');
}elseif(!$data['qr_code']){
    exit('当面付配置可能错误，请重新配置参数');
}
if(!empty($data['code'] && $data['code']=='10000'));
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
    <title><?php echo $conf['site_title']?> -  <?php echo $title ?></title>
    <link rel="icon" href="/assets/System/icon/favicon.ico" type="image/ico">
    <meta name="keywords" content="<?php echo $conf['site_keywords']; ?>"/>
    <meta name="description" content="<?php echo $conf['site_description']?>">
    <link rel="stylesheet" type="text/css" href="./assets/style.css" />
    <script src="./assets/jquery.min.js"></script>
</head>
<body>
    <div class="web">
        <div class="container">
            <!--支付-->
            <div class="Payment">
                <div class="Payment_default">
                    <p class="pay_logo"><img src="<?php echo $pay_config['alipay'];?>" alt="" style="height:30px;"></p>
                    <p>商品名称：<?php echo $row['name'];?></p>
                    <p class="pay_money">￥<?php echo $row['money'];?></p>
                       <p class="pay_qrcode"><img src="<?php echo $siteurls.'system/plugin/AiWeiYi_Qrcode/?url='.$data['qr_code'];?>" alt="二维码"></p>
                       <div class="pay_info">
                        <p>商户订单号：<?php echo $trade_no;?></p>
                        <p>请使用支付宝扫一扫</p>
                        <?php if(stristr($_SERVER['HTTP_USER_AGENT'],'Android')||stristr($_SERVER['HTTP_USER_AGENT'],'iPhone')||stristr($_SERVER['HTTP_USER_AGENT'],'iPad')){?>
                        <p class="wapds"><a href="alipayqr://platformapi/startapp?saId=10000007&clientVersion=3.7.0.0718&qrcode=<?php echo urlencode($data['qr_code']);?>">点击打开支付宝支付</a></p>
                        <?php }?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    var img = data.qrcode;
    function getBase64Image(img) {
        var canvas = document.createElement("canvas");
        canvas.width = img.width;
        canvas.height = img.height;
        var ctx = canvas.getContext("2d");
        ctx.drawImage(img, 0, 0, img.width, img.height);
        var ext = img.src.substring(img.src.lastIndexOf(".")+1).toLowerCase();
        var dataURL = canvas.toDataURL("image/"+ext);
        return dataURL;
    }
    setInterval(function() {
        var url = "lib/data.php?action=serve";
        $.ajax({
            type: "POST",
            url: url,
            data: {trade_no:"<?php echo $row['trade_no'];?>"},
            dataType: "JSON",
            success: function(result){
                if (result.code == 200){
                    window.location.href="./return.php?trade_no=<?php echo $trade_no;?>";
                }
            }
        });
    }, 5000);
    setInterval(function(){
        window.location.reload();
    }, 60000);
    </script>
</body>
</html>