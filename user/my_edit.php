<?php
include("../system/core/core.php");
$title='资料修改';
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
<h4>个人信息修改</h4>
</div>
<div class="card-body">

<div class="form-group">
<label>用户昵称</label>
<input type="name" id="name" name="name" class="form-control" value="<?php echo $udata['name'];?>">
</div>

<div class="form-group">
<label>用户QQ</label>
<input type="qq" id="qq" name="qq" class="form-control" value="<?php echo $udata['qq'];?>">
</div>

<div class="form-group">
<label>登录IP</label>
<input type="ip" id="ip" name="ip" class="form-control" value="<?php echo $udata['client_ip'];?>">
</div>

<div class="form-group">
<a href="javascript:my_edit()" class="btn-block btn-round btn btn-success">确定</a>
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
function my_edit(){
	var name=$("#name").val();
	var qq=$("#qq").val();
	var ip=$("#ip").val();
	var ii = layer.load(0, {shade:[0.1,'#fff']});
		$.ajax({
		    type : "POST",
			url : "ajax_my.php?act=my_edit",
			data : {name:name,qq:qq,ip:ip},
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
				layer.msg(data.msg)
			if(data.code==1){
						setTimeout(function () {
							location.href="./my_edit.php";
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