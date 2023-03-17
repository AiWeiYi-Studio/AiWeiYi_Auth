<?php
/*
* @Time    : 2022/05/22 20:57
* @Author  : 爱唯逸网络科技
* @Mail    : support@857xx.cn
* @Site    : https://web.857xx.cn
* @File    : auth_name.php
* @Action  : 程序昵称配置
*/

include("../system/core/core.php");
$title='用户商城配置';
include './page_head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login_index.php';</script>");
$mod=isset($_GET['mod'])?$_GET["mod"]:NULL;
?>
<!--页面主要内容-->
    <main class="lyear-layout-content">
      
      <div class="container-fluid">
        
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h4>用户商城配置</h4>
</div>
<div class="card-body">

<div class="input-group">
<span class="input-group-addon">邮件额度</span>
<input type="text" id="a" class="form-control" placeholder="金额/10个" value="<?=$conf['shop_mail_time_money']?>">
</div><br/>

<div class="input-group">
<span class="input-group-addon">发言功能</span>
<input type="text" id="b" class="form-control" placeholder="金额" value="<?=$conf['shop_user_chat_money']?>">
</div><br/>

<div class="input-group">
<span class="input-group-addon">短信额度</span>
<input type="text" id="c" class="form-control" placeholder="金额/10个" value="<?=$conf['shop_phone_time_money']?>">
</div><br/>

<div class="input-group">
<span class="input-group-addon">商城开关</span>
<select id="active" class="form-control" default="<?=$conf['shop_active']?>">
<option value="0">关闭</option>
<option value="1">开启</option>
</select>
</div><br/>

<div class="form-group">
<a href="javascript:set_shop()" class="btn-block btn-round btn btn-success">确定修改</a>
</div>

</div>
</div>
</div>
      
    </main>
    <!--End 页面主要内容-->
  </div>
</div>

<script type="text/javascript" src="../assets/LightYear/js/jquery.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/perfect-scrollbar.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/main.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/jquery.cookie.min.js"></script>

<script src="../assets/Layer/layer.js"></script>

<script>
var items = $("select[default]");
for (i = 0; i < items.length; i++) {
$(items[i]).val($(items[i]).attr("default")||0);
}

function set_shop(){
	var a=$("#a").val();
	var b=$("#b").val();
	var c=$("#c").val();
	var active=$("#active").val();
	var ii = layer.load(0, {shade:[0.1,'#fff']});
		$.ajax({
		    type : "POST",
			url : "ajax_system.php?act=set_shop",
			data : {a:a,b:b,c:c,active:active},
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
				layer.msg(data.msg)
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