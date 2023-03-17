<?php
include("../system/core/core.php");
$title='账号密码';
include './page_head.php';
if($islogins==1){}else exit("<script language='javascript'>window.location.href='./login_index.php?go_url=".get_url_last()."';</script>");
if($conf['site_active']=='1'){
    sysmsg('<h2>网站维护已开启</h2><ul><li><font size="4">'.$conf['site_active_notice'].'</font></li>',true);
}
?>
<!--页面主要内容-->
    <main class="lyear-layout-content">
      
      <div class="container-fluid">
        
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h4>账号密码</h4>
</div>
<div class="card-body">

<div class="form-group">
<label>账号</label>
<input type="user" id="user"class="form-control" value="<?php echo $udata['user'];?>">
</div>

<div class="form-group">
<label>新密码</label>
<input type="pass" id="pass" class="form-control"  placeholder="留空则不修改">
</div>

<div class="form-group">
<label>验证码</label>
<input type="code" id="code" class="form-control">
</div>

<div class="form-group">
<label for="text">验证方式：</label>
<div class="input-group">
<select id="type" class="form-control" default="1">
<option value="phone">绑定手机</option>
<option value="mail">绑定邮箱</option>
</select>
<div class="input-group-btn"><a href="javascript:send_code()" class="btn btn-default">获取验证码</a></div>
</div>
</div>

<div class="form-group">
<a href="javascript:my_account()" class="btn-block btn-round btn btn-success">确定</a>
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
function my_account(){
	var user=$("#user").val();
	var pass=$("#pass").val();
	var code=$("#code").val();
	var type=$("#type").val();
	var ii = layer.load(0, {shade:[0.1,'#fff']});
		$.ajax({
		    type : "POST",
			url : "ajax_my.php?act=my_account",
			data : {user:user,pass:pass,code:code,type:type},
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
				layer.msg(data.msg)
			if(data.code==1){
						setTimeout(function () {
							location.href="./my_account.php";
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

function send_code(){
	var type=$("#type").val();
	var ii = layer.load(0, {shade:[0.1,'#fff']});
		$.ajax({
		    type : "POST",
			url : "ajax_my.php?act=my_account_code",
			data : {type:type},
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