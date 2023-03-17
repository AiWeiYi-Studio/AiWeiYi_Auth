<?php
$title = '发起工单';
include("../system/core/core.php");
include './page_head.php';
if($islogins==1){}else exit("<script language='javascript'>window.location.href='./login_index.php?go_url=".get_url_last()."';</script>");
if($conf['site_active']=='1'){
    sysmsg('<h2>网站维护已开启</h2><ul><li><font size="4">'.$conf['site_active_notice'].'</font></li>',true);
}
?>

<main class="lyear-layout-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4><?php echo $title;?></h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="text">问题分类</label>
                            <select id="type" class="form-control">
                                <?php
                                    $rs=$DB->query("SELECT * FROM website_class_workorder WHERE status = '1' order by id asc");
                                    while($res = $DB->fetch($rs)){
                                        echo '<option value="'.$res['id'].'">'.$res['name'].'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="text">工单标题</label>
                            <input type="text" id="title" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="text">工单内容</label>
                            <textarea id="text" name="text" class="form-control" style="width:100%;height:200px;"></textarea>
                        </div>
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

<script src="../assets/Layer/layer.js"></script>

<script>
function add(){
	var type=$("#type").val();
	var title=$("#title").val();
	var text=$("#text").val();
	var ii = layer.load(0, {shade:[0.1,'#fff']});
	$.ajax({
		type : "POST",
		url : "ajax_workorder.php?act=add",
		data : {type:type,title:title,text:text},
		dataType : 'json',
		success : function(data) {
				layer.close(ii);
				layer.msg(data.msg)
				if(data.code==1){
				    setTimeout(function () {
				        location.href="./workorder_reply.php?id=" + data.id;
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