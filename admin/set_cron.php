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
$title='网站信息配置';
include './page_head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login_index.php';</script>");
?>

<!--页面主要内容-->
    <main class="lyear-layout-content">
      
      <div class="container-fluid">
          
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h4>系统监控配置</h4>
</div>
<div class="card-body">
    
<div class="form-group">
<label for="text">监控密钥：</label>
<input type="text" id="key" class="form-control" value="<?=$conf['system_cron_key']?>">
</div>

<div class="form-group">
<label for="text">监控端IP：</label>
<input type="text" id="ip" class="form-control" placeholder="多个用英文逗号隔开" value="<?=$conf['system_cron_ip']?>">
</div>

<div class="form-group">
<label for="select">监控端IP检测</label>
<select class="form-control" id="active"default="<?php echo $conf['system_cron_ip_active'];?>">
<option value="0">关闭</option>
<option value="1">开启</option>
</select>
</div>

<div class="form-group">
<a href="javascript:set_cron()" class="btn-block btn-round btn btn-success">确定修改</a>
</div>

</div>
</div>
</div>
</div>

<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h4>监控地址</h4>
</div>
<div class="card-body">
    
<div class="form-group">
<label for="text">百度收录推送：</label>
<input type="text" class="form-control" value="<?php echo $siteurls.'system/cron/baidu.php?key='.$conf['system_cron_key'].''?>">
</div>
    
</div>
</div>
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
</script>

<script>
function set_cron(){
    var ip=$("#ip").val();
    var key=$("#key").val();
    var active=$("#active").val();
	var ii = layer.load(0, {shade:[0.1,'#fff']});
		$.ajax({
		    type : "POST",
			url : "ajax_system.php?act=set_cron",
			data : {key:key,ip:ip,active:active},
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
				layer.msg(data.msg)
			if(data.code == 1){
				   window.location.href="./set_cron.php"; 
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