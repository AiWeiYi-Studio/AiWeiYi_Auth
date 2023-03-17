<?php
include("../system/core/core.php");
$title='用户密钥';
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
<h4>专属密钥</h4>
</div>
<div class="card-body">

<div class="form-group">
<label>唯一密钥</label>
<input type="text" id="token" name="token" class="form-control" value="<?php echo $udata['token'];?>" disabled="disabled">
<br/>
<pre>以系统自动生成的为准</pre>
</div>

<div class="form-group">
<a href="javascript:my_edit_token()" class="btn-block btn-round btn btn-success">修改密钥</a>
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
function my_edit_token(){
    layer.confirm('确定退出？',{btn:['确定','取消'],closeBtn:0,icon:3},function(){
	    var ii = layer.load(0, {shade:[0.1,'#fff']});
		    $.ajax({
		        type : "POST",
		    	url : "ajax_my.php?act=my_edit_token",
		    	dataType : 'json',
		    	success : function(data) {
		    		layer.close(ii);
		    		layer.msg(data.msg)
		    	if(data.code == 1){
		    		   window.location.href="./my_token.php"; 
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