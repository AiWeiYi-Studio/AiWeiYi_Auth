<?php
$title = '发布悄悄话';
include("../system/core/core.php");
include './page_head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login_index.php';</script>");
?>

<main class="lyear-layout-content">
<div class="container-fluid">
    
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h4>发布悄悄话</h4>
</div>
<div class="card-body">

<div class="input-group">
<span class="input-group-addon">内容</span>
<textarea id="text" name="text" style="width:100%;height:200px;"></textarea>
</div><br/>

<div class="input-group">
<span class="input-group-addon">到期时间</span>
<input class="form-control js-datetimepicker" type="text" id="time" placeholder="请选择具体时间" value="<?php echo date("Y-m-d H:i:s",strtotime("1 day"));?>" data-side-by-side="true" data-locale="zh-cn" data-format="YYYY-MM-DD HH:mm:ss" />
</div><br/>

<div class="input-group">
<span class="input-group-addon">可查看次数</span>
<input type="number" id="number" class="form-control" value="1"/>
</div><br/>

<div class="input-group">
<span class="input-group-addon">邮箱通知</span>
<select id="mail" name="mail" class="form-control" default="0">
<option value="0">关闭</option>
<option value="1">开启</option>
</select>
</div><br/>

<div class="input-group">
<span class="input-group-addon">公开状态</span>
<select id="active" name="active" class="form-control" default="0">
<option value="0">关闭</option>
<option value="1">开启</option>
</select>
</div><br/>

<div class="form-group">
<a href="javascript:add()" class="btn-block btn-round btn btn-success">添加</a>
</div>
            
          </div>  
        </div>
      </div>
    </div>
    
  </div>
</main>

<script type="text/javascript" src="../assets/LightYear/js/jquery.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/perfect-scrollbar.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/main.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/jquery.cookie.min.js"></script>

<!--时间选择插件-->
<script src="../assets/LightYear/js/bootstrap-datetimepicker/moment.min.js"></script>
<script src="../assets/LightYear/js/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js"></script>
<script src="../assets/LightYear/js/bootstrap-datetimepicker/locale/zh-cn.js"></script>

<script src="../assets/Layer/layer.js"></script>

<script>
var items = $("select[default]");
for (i = 0; i < items.length; i++) {
$(items[i]).val($(items[i]).attr("default")||0);
}

function add(){
	var text=$("#text").val();
	var time=$("#time").val();
	var mail=$("#mail").val();
	var number=$("#number").val();
	var active=$("#active").val();
	var ii = layer.load(0, {shade:[0.1,'#fff']});
		$.ajax({
		    type : "POST",
			url : "ajax_privacy.php?act=add",
			data : {text:text,time:time,number:number,mail:mail,active:active},
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
				layer.msg(data.msg)
			if(data.code==1){
						setTimeout(function () {
							location.href="./privacy_list.php";
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