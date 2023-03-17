<?php
include("../system/core/core.php");
$title='用户钱包';
include './page_head.php';
if($islogins==1){}else exit("<script language='javascript'>window.location.href='./login_index.php?go_url=".get_url_last()."';</script>");
if($conf['site_active']=='1'){
    sysmsg('<h2>网站维护已开启</h2><ul><li><font size="4">'.$conf['site_active_notice'].'</font></li>',true);
}
$mod=isset($_GET['mod'])?$_GET["mod"]:index;
?>
<!--页面主要内容-->
    <main class="lyear-layout-content">
      
      <div class="container-fluid">
<?php if($mod=='personal'){?>
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h4>私下交易</h4>
</div>
<div class="card-body">
    
<?php if($conf['pay_personal_notice']!=NULL || $conf['pay_personal_notice']!=''){?>
<div class="alert alert-success alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <strong><?php echo $conf['pay_personal_notice'];?></strong>
</div>
<?php }?>

<div class="row">

<div class="col-sm-6 col-lg-4">
    <center>
        <img src="<?php echo $conf['pay_personal_qq'];?>" width="50%">
    </center>
</div>

<div class="col-sm-6 col-lg-4">
    <center>
        <img src="<?php echo $conf['pay_personal_weixin'];?>"  width="50%">
    </center>
</div>

<div class="col-sm-6 col-lg-4">
    <center>
        <img src="<?php echo $conf['pay_personal_alipay'];?>"  width="50%">
    </center>
</div>
<br/>
<div class="form-group">
<center>
<a href="./my_money_log.php" class="btn-round btn btn-success">资金明细</a>
<a href="?mod=chongzhi" class="btn-round btn btn-success">余额充值</a>
<a href="?mod=jifen" class="btn-round btn btn-success">积分兑换</a>
</center>
</div>

<?php }elseif($mod=='index'){
    $pay = $DB->count("select count(*) from website_pay where user = '".$udata['uid']."'");
    $pay_status = $DB->count("select count(*) from website_pay where user = '".$udata['uid']."' and status ='1'");
    $money = $DB->count("select sum(money) from website_pay where user = '".$udata['uid']."' and status = '1'");
?>
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h4>我的个人钱包</h4>
</div>
<div class="card-body">

<div class="row">

<div class="col-sm-3 col-lg-3">
    <div class="card bg-primary">
        <div class="card-body clearfix">
            <div class="pull-right"align="right">
                <p class="h5 text-white m-t-0"> 账号余额</p>
                <p class="h4 text-white m-b-0"><?php echo $udata['money'];?> 元</p>
            </div>
            <div class="pull-left"> <span class="img-avatar img-avatar-48 bg-translucent"><i class="mdi mdi-currency-cny fa-1-5x"></i></span> </div>
        </div>
    </div>
</div>

<div class="col-sm-3 col-lg-3">
    <div class="card bg-primary">
        <div class="card-body clearfix">
            <div class="pull-right"align="right">
                <p class="h5 text-white m-t-0"> 积分余额</p>
                <p class="h4 text-white m-b-0"><?php echo $udata['integral'];?> 分</p>
            </div>
            <div class="pull-left">
                <span class="img-avatar img-avatar-48 bg-translucent">
                    <i class="mdi mdi-currency-cny fa-1-5x"></i>
                </span>
            </div>
        </div>
    </div>
</div>

<div class="col-sm-3 col-lg-3">
    <div class="card bg-primary">
        <div class="card-body clearfix">
            <div class="pull-right"align="right">
                <p class="h5 text-white m-t-0">总订单/已完成订单</p>
                <p class="h4 text-white m-b-0"><?php echo $pay;?>条/<?php echo $pay_status;?>条</p>
            </div>
            <div class="pull-left">
                <span class="img-avatar img-avatar-48 bg-translucent">
                    <i class="mdi mdi-currency-cny fa-1-5x"></i>
                </span>
            </div>
        </div>
    </div>
</div>

<div class="col-sm-3 col-lg-3">
    <div class="card bg-primary">
        <div class="card-body clearfix">
            <div class="pull-right"align="right">
                <p class="h5 text-white m-t-0">总订单消费</p>
                <p class="h4 text-white m-b-0"><?php echo $money;?> 元</p>
            </div>
            <div class="pull-left"> <span class="img-avatar img-avatar-48 bg-translucent"><i class="mdi mdi-currency-cny fa-1-5x"></i></span> </div>
        </div>
    </div>
</div>

<div class="form-group">
<center>
<a href="./my_money_log.php" class="btn-round btn btn-success">资金明细</a>
<a href="?mod=chongzhi" class="btn-round btn btn-success">余额充值</a>
<a href="?mod=jifen" class="btn-round btn btn-success">积分兑换</a>
</center>
</div>

<?php }elseif($mod=='chongzhi'){?>
<div class="row">
    
<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h4>余额充值</h4>
</div>
<div class="card-body">
    
<?php if($conf['pay_notice']!=NULL || $conf['pay_notice']!=''){?>
<div class="alert alert-success alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <strong><?php echo $conf['pay_notice'];?></strong>
</div>
<?php }?>

<pre>当前余额：<b><?php echo $udata['money'];?></b> 元，最低充值：<?php echo $conf['pay_money_little'];?> 元，最高充值：<?php echo $conf['pay_money_big'];?> 元</pre>

<div class="form-group">
<label for="text">在线充值</label>
<input class="form-control" type="number"  id="money" name="money" value="<?php echo $conf['pay_money_number'];?>" placeholder="输入你要充值的余额">
</div>

<?php if($conf['pay_alipay_api']!='0' || $conf['pay_qqpay_api']!='0' || $conf['pay_wxpay_api']!='0' || $conf['pay_personal_api']!='0'){?>

<div class="form-group">
<center>
<?php if($conf['pay_alipay_api']!='0'){?>
<a href="javascript:money(1)" class="btn btn-default"><img src="../assets/System/icon/alipay.ico" width="15" height="17">支付宝</a>&nbsp;
<?php }if($conf['pay_qqpay_api']!='0'){?>
<a href="javascript:money(2)" class="btn btn-default"><img src="../assets/System/icon/qqpay.ico">QQ钱包</a>&nbsp;
<?php }if($conf['pay_wxpay_api']!='0'){?>
<a href="javascript:money(3)" class="btn btn-default"><img src="../assets/System/icon/wechat.ico">微信支付</a>&nbsp;
<?php }if($conf['pay_personal_api']!='0'){?>
<a href="?mod=personal" class="btn btn-default"><img src="../assets/System/icon/favicon.ico" width="20px">私下交易</a>&nbsp;
<?php }?>
</center>
</div>

<?php }else{?>
<div class="form-group text-center">
    <pre>系统未开启任何支付接口</pre>
</div>
<?php }?>

</div>
</div>
</div>
</div>

<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h4>卡密充值</h4>
</div>
<div class="card-body">
<div class="form-group">
<label for="web_site_title">输入卡密</label>
<input class="form-control" type="text"  id="kami"name="kami" value="" placeholder="输入你购买的卡密">
</div>

<div class="form-group">
<a href="javascript:kamichongzhi()" class="btn-block btn-round btn btn-success">确定</a>
</div>

</div>
</div>
</div>
</div>
<?php }?>
      
    </main>
    <!--End 页面主要内容-->

<script type="text/javascript" src="../assets/LightYear/js/jquery.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/perfect-scrollbar.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/main.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/jquery.cookie.min.js"></script>

<script src="../assets/Layer/layer.js"></script>

<script>
function money(type){
    var money=$("#money").val();
	var ii = layer.load(0, {shade:[0.1,'#fff']});
		$.ajax({
		    type : "POST",
			url : "ajax_my.php?act=my_chongzhi&type="+type+"",
			data : {money:money},
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
				layer.msg(data.msg)
				if(data.code==1){
						setTimeout(function () {
							location.href=data.url;
						}, 1000); 
					  }
			},
			error:function(data){
				layer.close(ii);
				layer.msg('服务器错误！');
				return false;
		}
	});
};
function kamichongzhi(){
	var kami=$("#kami").val();
	var ii = layer.load(0, {shade:[0.1,'#fff']});
		$.ajax({
		    type : "POST",
			url : "ajax_my.php?act=my_chongzhi_kami",
			data : {kami:kami},
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
				layer.msg(data.msg)
			if(data.code == 1){
			    setTimeout(function () {
				location.href="./my_money.php";
				}, 1000);
				}
			},
			error:function(data){
				layer.close(ii);
				layer.msg('服务器错误！');
				return false;
		}
	});
};
</script>

</body>
</html>