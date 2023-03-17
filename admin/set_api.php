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
$title='API配置';
include './page_head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login_index.php';</script>");
$mod=isset($_GET['mod'])?$_GET["mod"]:null;
?>

<!--页面主要内容-->
    <main class="lyear-layout-content">
      <div class="container-fluid">
   
<?php if($mod=='mail'){?>

<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h4>邮件发件接口配置</h4>
</div>
<div class="card-body">
    
<div class="form-group">
<label for="text">SMTP服务器：</label>
<input type="text" id="smtp" name="smtp" class="form-control" value="<?=$conf['api_mail_smtp']?>">
</div>

<div class="form-group">
<label for="text">SMTP端口：</label>
<input type="text" id="port" name="port" class="form-control" value="<?=$conf['api_mail_port']?>">
</div>

<div class="form-group">
<label for="text">邮箱账号：</label>
<input type="text" id="name" name="name" class="form-control" value="<?=$conf['api_mail_name']?>">
</div>

<div class="form-group">
<label for="text">发信邮箱：</label>
<input type="text" id="user" name="user" class="form-control" value="<?=$conf['api_mail_user']?>">
</div>

<div class="form-group">
<label for="text">加密类型：</label>
<select id="encrypt" name="encrypt" class="form-control" default="<?=$conf['api_mail_encrypt']?>">
    <option value="ssl">SSL</option>
    <option value="tls">TLS</option>
</select>
</div>

<div class="form-group">
<label for="text">邮箱密码(授权码)：</label>
<input type="text" id="pwd" name="pwd" class="form-control" value="<?php echo $conf['api_mail_pwd']; ?>">
</div>

<div class="form-group">
<label>单价</label>
<input type="text" id="money" name="money" class="form-control" value="<?php echo $conf['api_mail_money'];?>">
</div>

<div class="form-group">
<label>状态</label>
<select id="active" name="active" class="form-control" default="<?=$conf['api_mail_active']?>">
<option value="0">关闭</option>
<option value="1">开启</option>
</select>
</div>

<div class="form-group">
<a href="javascript:set_api_mail()" class="btn-block btn-round btn btn-success">确定</a>
</div>


<?php }elseif($mod=='bing'){?>

<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h4>必应每日一图配置</h4>
</div>
<div class="card-body">

<div class="form-group">
<label>单价</label>
<input type="text" id="money" name="money" class="form-control" value="<?php echo $conf['api_bing_money'];?>">
</div>

<div class="form-group">
<label>状态</label>
<select id="active" name="active" class="form-control" default="<?=$conf['api_bing_active']?>">
<option value="0">关闭</option>
<option value="1">开启</option>
</select>
</div>

<div class="form-group">
<a href="javascript:set_api_bing()" class="btn-block btn-round btn btn-success">确定</a>
</div>


<?php }elseif($mod=='qrcode'){?>

<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h4>二维码生成配置</h4>
</div>
<div class="card-body">

<div class="form-group">
<label>单价</label>
<input type="text" id="money" name="money" class="form-control" value="<?php echo $conf['api_qrcode_money'];?>">
</div>

<div class="form-group">
<label>状态</label>
<select id="active" name="active" class="form-control" default="<?=$conf['api_qrcode_active']?>">
<option value="0">关闭</option>
<option value="1">开启</option>
</select>
</div>

<div class="form-group">
<a href="javascript:set_api_qrcode()" class="btn-block btn-round btn btn-success">确定</a>
</div>

<?php }elseif($mod=='photo'){?>

<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h4>随机图片配置</h4>
</div>
<div class="card-body">

<div class="form-group">
<label>单价</label>
<input type="text" id="money" name="money" class="form-control" value="<?php echo $conf['api_photo_money'];?>">
</div>

<div class="form-group">
<label>状态</label>
<select id="active" name="active" class="form-control" default="<?=$conf['api_photo_active']?>">
<option value="0">关闭</option>
<option value="1">开启</option>
</select>
</div>

<div class="form-group">
<a href="javascript:set_api_photo()" class="btn-block btn-round btn btn-success">确定</a>
</div>

<?php }?>
</div>
</div>
</div>
</div> 
</div> 

    </main>
    <!--End 页面主要内容-->


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

function set_api_bing(){
	var money=$("#money").val();
	var active=$("#active").val();
	var ii = layer.load(0, {shade:[0.1,'#fff']});
		$.ajax({
		    type : "POST",
			url : "ajax_system.php?act=set_api_bing",
			data : {money:money,active:active},
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
	
function set_api_qrcode(){
	var money=$("#money").val();
	var active=$("#active").val();
	var ii = layer.load(0, {shade:[0.1,'#fff']});
		$.ajax({
		    type : "POST",
			url : "ajax_system.php?act=set_api_qrcode",
			data : {money:money,active:active},
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

function set_api_photo(){
	var money=$("#money").val();
	var active=$("#active").val();
	var ii = layer.load(0, {shade:[0.1,'#fff']});
		$.ajax({
		    type : "POST",
			url : "ajax_system.php?act=set_api_photo",
			data : {money:money,active:active},
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

function set_api_mail(){
    var smtp=$("#smtp").val();
	var port=$("#port").val();
	var name=$("#name").val();
	var pwd=$("#pwd").val();
	var money=$("#money").val();
	var active=$("#active").val();
	var user=$("#user").val();
	var encrypt=$("#encrypt").val();
	var ii = layer.load(0, {shade:[0.1,'#fff']});
		$.ajax({
		    type : "POST",
			url : "ajax_system.php?act=set_api_mail",
			data : {smtp:smtp,port:port,name:name,pwd:pwd,money:money,user:user,encrypt:encrypt,active:active},
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