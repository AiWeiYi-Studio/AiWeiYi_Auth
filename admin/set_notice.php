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
$title='网站公告配置';
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
<h4>网站公告配置</h4>
</div>
<div class="card-body">
    
<pre>留空则不显示</pre>

<div class="input-group">
<span class="input-group-addon">系统维护时公告</span>
<textarea class="form-control" id="site_active_notice" name="site_active_notice" placeholder="维护公告" rows="4"><?php echo htmlspecialchars($conf['site_active_notice']); ?></textarea>
</div><br/>

<div class="input-group">
<span class="input-group-addon">网站首页弹窗</span>
<textarea class="form-control" id="site_notice" name="site_notice" placeholder="网站首页弹窗" rows="4"><?php echo htmlspecialchars($conf['site_notice']); ?></textarea>
</div><br/>

<div class="input-group">
<span class="input-group-addon">用户充值处公告</span>
<textarea class="form-control" id="pay_notice" name="pay_notice" placeholder="用户充值公告" rows="4"><?php echo htmlspecialchars($conf['pay_notice']); ?></textarea>
</div><br/>

<div class="input-group">
<span class="input-group-addon">私下交易公告</span>
<textarea class="form-control" id="pay_personal_notice" name="pay_personal_notice" placeholder="私下交易公告" rows="4"><?php echo htmlspecialchars($conf['pay_personal_notice']); ?></textarea>
</div><br/>

<div class="input-group">
<span class="input-group-addon">用户聊天室公告</span>
<textarea class="form-control" id="chat_user_notice" name="chat_user_notice" placeholder="用户聊天室公告" rows="4"><?php echo htmlspecialchars($conf['chat_user_notice']); ?></textarea>
</div><br/>

<div class="input-group">
<span class="input-group-addon">用户聊天室公告</span>
<textarea class="form-control" id="chat_user_active_notice" name="chat_user_active_notice" placeholder="用户聊天室关闭后公告" rows="4"><?php echo htmlspecialchars($conf['chat_user_active_notice']); ?></textarea>
</div><br/>

<div class="form-group">
<a href="javascript:set_notice()" class="btn-block btn-round btn btn-success">确定修改</a>
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
function set_notice(){
    var site_notice=$("#site_notice").val();
	var site_active_notice=$("#site_active_notice").val();
	var pay_notice=$("#pay_notice").val();
	var chat_user_notice=$("#chat_user_notice").val();
	var chat_user_active_notice=$("#chat_user_active_notice").val();
	var pay_personal_notice = $('#pay_personal_notice').val();
	var ii = layer.load(0, {shade:[0.1,'#fff']});
		$.ajax({
		    type : "POST",
			url : "ajax_system.php?act=set_notice",
			data : {site_notice:site_notice,site_active_notice:site_active_notice,pay_notice:pay_notice,pay_personal_notice:pay_personal_notice,chat_user_notice:chat_user_notice,chat_user_active_notice:chat_user_active_notice},
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