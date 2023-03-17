<?php
include("../system/core/core.php");
$title='商城';
$url='shop_other.php';
include './page_head.php';
if($islogins==1){}else exit("<script language='javascript'>window.location.href='./login_index.php?go_url=".get_url_last()."';</script>");
if($conf['site_active']=='1'){
    sysmsg('<h2>网站维护已开启</h2><ul><li><font size="4">'.$conf['site_active_notice'].'</font></li>',true);
}
?>
<!--页面主要内容-->
<main class="lyear-layout-content">
    <div class="container-fluid">
        
<?php
if($conf['shop_active']=='0'){
    showmsg('<h2>商城功能未开启，请等待！</h2>',true);
    }
?>
<div class="row">
<div class="col-sm-6">       
<div class="card">
<div class="card-header">
<h4>邮件余额充值</h4>
</div>
<div class="card-body">
<li>商品金额：<b><?php if($conf['shop_mail_time_money']!==''){echo $conf['shop_mail_time_money'];}else{echo '0';}?></b> 元/10个</li>
<li>账户余额：<?php echo $udata['money'];?> 元</li>
<li>商品详情：用于充值账号邮件发件数量余额</li>
<li>账户额度：<?php echo $udata['mail_time'];?> 次</li>
<br/>
<?php if($conf['shop_mail_time_money']=='0'  or $conf['shop_mail_time_money']==NULL){?>
<img src="../assets/System/img/kill.gif">
<div class="text-right">
<a href="javascript:shop_mail_time()" class="btn btn-w-md btn-round btn-danger">马上秒杀</a>
</div>
<?php }else{?>
<div class="text-right">
<a href="javascript:shop_mail_time()" class="btn btn-w-md btn-round btn-danger">确定购买</a>
</div>
<?php }?>
                
</div>
</div>
</div>

<div class="col-sm-6">       
<div class="card">
<div class="card-header">
<h4>发言权限</h4>
</div>
<div class="card-body">
<li>商品金额：<b><?php if($conf['shop_user_chat_money']!==''){echo $conf['shop_user_chat_money'];}else{echo '0';}?></b> 元</li>
<li>账户余额：<?php echo $udata['money'];?> 元</li>
<li>商品详情：用户违规发言被封禁后可通过此恢复！</li>
<li>账号状态：<?php if($udata['active_chat']=='1'){echo '允许发言';}else{echo '禁止发言';}?></li>
<br/>
<?php if($conf['shop_user_chat_money']=='0'  or $conf['shop_user_chat_money']==NULL){?>
<img src="../assets/System/img/kill.gif">
<div class="text-right">
<a href="javascript:shop_user_chat()" class="btn btn-w-md btn-round btn-danger">马上秒杀</a>
</div>
<?php }else{?>
<div class="text-right">
<a href="javascript:shop_user_chat()" class="btn btn-w-md btn-round btn-danger">确定购买</a>
</div>
<?php }?>
                
</div>
</div>
</div>

<div class="col-sm-6">       
<div class="card">
<div class="card-header">
<h4>短信余额充值</h4>
</div>
<div class="card-body">
<li>商品金额：<b><?php if($conf['shop_phone_time_money']!==''){echo $conf['shop_phone_time_money'];}else{echo '0';}?></b> 元/10个</li>
<li>账户余额：<?php echo $udata['money'];?> 元</li>
<li>商品详情：用于充值账号邮件发件数量余额</li>
<li>账户额度：<?php echo $udata['phone_time'];?> 次</li>
<br/>
<?php if($conf['shop_phone_time_money']=='0'  or $conf['shop_phone_time_money']==NULL){?>
<img src="../assets/System/img/kill.gif">
<div class="text-right">
<a href="javascript:shop_phone_time()" class="btn btn-w-md btn-round btn-danger">马上秒杀</a>
</div>
<?php }else{?>
<div class="text-right">
<a href="javascript:shop_phone_time()" class="btn btn-w-md btn-round btn-danger">确定购买</a>
</div>
<?php }?>
                
</div>
</div>
</div>

</div>
        
    </div>
</main>



<script type="text/javascript" src="../assets/LightYear/js/jquery.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/perfect-scrollbar.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/main.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/jquery.cookie.min.js"></script>


<script src="../assets/Layer/layer.js"></script>

<script>
function shop_mail_time(){
	var ii = layer.load(0, {shade:[0.1,'#fff']});
		$.ajax({
		    type : "POST",
			url : "ajax_shop.php?act=shop_mail_time",
			data : {},
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
				layer.msg(data.msg)
				if(data.code==1){
						setTimeout(function () {
							location.href="./shop_other.php";
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

function shop_phone_time(){
	var ii = layer.load(0, {shade:[0.1,'#fff']});
		$.ajax({
		    type : "POST",
			url : "ajax_shop.php?act=shop_phone_time",
			data : {},
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
				layer.msg(data.msg)
				if(data.code==1){
						setTimeout(function () {
							location.href="./shop_other.php";
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

function shop_user_chat(){
	var ii = layer.load(0, {shade:[0.1,'#fff']});
		$.ajax({
		    type : "POST",
			url : "ajax_shop.php?act=shop_user_chat",
			data : {},
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
				layer.msg(data.msg)
				if(data.code==1){
						setTimeout(function () {
							location.href="./shop_other.php";
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