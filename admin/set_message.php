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
$title='短信接口配置';
include './page_head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login_index.php';</script>");
$mod=isset($_GET['mod'])?$_GET["mod"]:null;
$result = file_get_contents("https://www.smsbao.com/query?u=".$conf['message_user']."&p=".md5($conf['message_pass'])."");
$res = explode(',',$result);
?>

<!--页面主要内容-->
    <main class="lyear-layout-content">
      <div class="container-fluid">

<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h4>短信接口配置</h4>
</div>
<div class="card-body">

<div class="form-group">
<label>账号</label>
<input type="user" id="user" class="form-control" value="<?php echo $conf['message_user'];?>">
</div>

<div class="form-group">
<label>密码</label>
<input type="pass" id="pass" class="form-control" value="<?php echo $conf['message_pass'];?>">
</div>

<div class="form-group">
<label>签名</label>
<input type="title" id="title" class="form-control" value="<?php echo $conf['message_title'];?>">
</div>

<div class="form-group">
<label>余额</label>
<input type="number" id="number" class="form-control" value="<?php echo $res[1];?>" disabled="disabled">
</div>

<div class="form-group">
<a href="javascript:set_message()" class="btn-block btn-round btn btn-success">确定</a>
</div>

<div class="card-footer">
<span class="layui-icon layui-icon-tips"></span>
<a href="javascript:send_message()">给 <?php echo $udata['phone'];?> 发一封测试短信</a>
<hr>
模板：您的验证码为{code}，验证码在{time}秒内有效。打死都不能告诉告诉任何人哦！<a href="javascript:post()">申请接口</a>
</div>

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

function set_message(){
	var user=$("#user").val();
	var pass=$("#pass").val();
	var title=$("#title").val();
	var ii = layer.load(0, {shade:[0.1,'#fff']});
		$.ajax({
		    type : "POST",
			url : "ajax_system.php?act=set_message",
			data : {user:user,pass:pass,title:title},
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
	
function post(){
	var ii = layer.load(0, {shade:[0.1,'#fff']});
		$.ajax({
		    type : "POST",
			url : "ajax_system.php?act=dxb_post",
			data : {},
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
	
function send_message(){
layer.confirm('确定？',{btn:['确定','取消'],closeBtn:0,icon:3},function(){
	var ii = layer.load(0, {shade:[0.1,'#fff']});
		$.ajax({
		    type : "POST",
			url : "ajax_system.php?act=send_message",
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
				layer.msg(data.msg)
			if(data.code==1){
						setTimeout(function () {
							location.href="./set_message.php";
						}, 1000); 
					  }
			},
			error:function(data){
				layer.close(ii);
				layer.msg('服务器错误！');
				return false;
			}
		});
    });
};
</script>

</body>
</html>