<?php
include("../system/core/core.php");
$title='绑定邮箱';
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
<h4>绑定邮箱</h4>
</div>
<div class="card-body">

<div class="form-group">
<label>我的邮箱</label>
<input type="text" class="form-control" value="<?php echo $udata['mail'];?>" disabled="disabled">
<br/>
<pre>邮箱绑定及其重要，请重视</pre>
</div>

<div class="form-group">
<?php if(!$udata['mail']){?>
<button type="button" class="btn-block btn-round btn btn-info" data-toggle="modal" data-target="#do">绑定邮箱</button>
<?php }else{ ?>
<button type="button" class="btn-block btn-round btn btn-success" data-toggle="modal" data-target="#edit">修改邮箱</button>
<?php }?>
</div>

</div>
</div>
</div>
</div>
</div>

<div class="modal fade" id="do" tabindex="-1" role="dialog" aria-labelledby="do">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title" id="exampleModalLabel">邮箱绑定</h4>
</div>
<div class="modal-body">
                        
<div class="form-group">
<label for="text">邮箱</label>
<div class="input-group">
<input type="text" class="form-control"  id="do_mail">
<div class="input-group-btn"><a href="javascript:my_send_do()" class="btn btn-default">获取验证码</a></div>

</div>
</div>

<div class="form-group">
<label for="text">验证码</label>
<input type="text" class="form-control" id="do_code">
</div>
                        
<div class="form-group">
<a href="javascript:my_do()" class="btn-block btn-round btn btn-info">绑定</a>
</div>
</div>
</div>
</div>
</div>

<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title" id="exampleModalLabel">邮箱修改</h4>
</div>
<div class="modal-body">
    
<div class="form-group">
<label for="text">原邮箱</label>
<div class="input-group">
<input type="text" class="form-control"  id="edit_mail" value="<?php echo $udata['mail'];?>" disabled="disabled">
<div class="input-group-btn"><a href="javascript:my_send_edit()" class="btn btn-default">获取验证码</a></div>
</div>
</div>

<div class="form-group">
<label>新邮箱</label>
<input type="text" class="form-control" id="edit_mails">
</div>

<div class="form-group">
<label for="text">验证码</label>
<input type="text" class="form-control" id="edit_code">
</div>
                        
<div class="form-group">
<a href="javascript:edit_do()" class="btn-block btn-round btn btn-info">修改</a>
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
// 修改邮箱
function edit_do(){
    var edit_mail=$("#edit_mail").val();
    var edit_mails=$("#edit_mails").val();
    var edit_code=$("#edit_code").val();
	var ii = layer.load(0, {shade:[0.1,'#fff']});
		$.ajax({
		    type : "POST",
			url : "ajax_my.php?act=edit_mail",
			data : {edit_mail:edit_mail,edit_code:edit_code,edit_mails:edit_mails},
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
				layer.msg(data.msg)
			if(data.code==1){
				setTimeout(function () {
				location.href="./my_mail.php";
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
// 发送修改邮箱验证码验证码
function my_send_edit(){
	var edit_mail=$("#edit_mail").val();
	var edit_mails=$("#edit_mails").val();
	var ii = layer.load(0, {shade:[0.1,'#fff']});
		$.ajax({
		    type : "POST",
			url : "ajax_my.php?act=edit_mail_code",
			data : {edit_mail:edit_mail,edit_mails:edit_mails},
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
// 发送绑定邮箱验证码
function my_send_do(){
	var do_mail=$("#do_mail").val();
	var ii = layer.load(0, {shade:[0.1,'#fff']});
		$.ajax({
		    type : "POST",
			url : "ajax_my.php?act=bd_mail_code",
			data : {do_mail:do_mail},
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
// 绑定邮箱
function my_do(){
    var do_mail=$("#do_mail").val();
    var do_code=$("#do_code").val();
	var ii = layer.load(0, {shade:[0.1,'#fff']});
		$.ajax({
		    type : "POST",
			url : "ajax_my.php?act=bd_mail",
			data : {do_mail:do_mail,do_code:do_code},
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
				layer.msg(data.msg)
			if(data.code==1){
						setTimeout(function () {
							location.href="./my_mail.php";
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