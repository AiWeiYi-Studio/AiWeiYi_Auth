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
$title='用户信息修改';
include './page_head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login_index.php';</script>");
$uid = $_GET['uid'];
$row = $DB->get_row("SELECT * FROM website_user WHERE uid='$uid' limit 1");
?>

<!--页面主要内容-->
    <main class="lyear-layout-content">
      <div class="container-fluid">
          
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h4>用户信息修改</h4>
</div>
<div class="card-body">

<div class="form-group">
<label>账号</label>
<input type="user" id="user" class="form-control" value="<?php echo $row['user'];?>">
</div>

<div class="form-group">
<label>密码</label>
<input type="pass" id="pass" class="form-control" value="<?php echo $row['pass'];?>">
</div>

<div class="form-group">
<label>昵称</label>
<input type="name" id="name" class="form-control" value="<?php echo $row['name'];?>">
</div>

<div class="form-group">
<label>QQ</label>
<input type="qq" id="qq" class="form-control" value="<?php echo $row['qq'];?>">
</div>

<div class="form-group">
<label>邮箱</label>
<input type="mail" id="mail" class="form-control" value="<?php echo $row['mail'];?>">
</div>

<div class="form-group">
<label>手机</label>
<input type="phone" id="phone" class="form-control" value="<?php echo $row['phone'];?>">
</div>

<div class="form-group">
<a href="javascript:ok(<?php echo $row['uid'];?>)" class="btn-block btn-round btn btn-success">确定</a>
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
function ok(uid){
    var user=$("#user").val();
    var pass=$("#pass").val();
    var name=$("#name").val();
    var qq=$("#qq").val();
    var mail=$("#mail").val();
    var phone=$("#phone").val();
	var ii = layer.load(0, {shade:[0.1,'#fff']});
		$.ajax({
		    type : "POST",
			url : "ajax_user.php?act=user_edit&uid="+uid+"",
			data : {user:user,pass:pass,qq:qq,name:name,mail:mail,phone:phone},
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