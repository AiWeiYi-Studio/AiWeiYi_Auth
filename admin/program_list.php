btn-round <?php
/*
* @Time    : 2022/05/22 20:57
* @Author  : 爱唯逸网络科技
* @Mail    : support@857xx.cn
* @Site    : https://web.857xx.cn
* @File    : auth_name.php
* @Action  : 程序昵称配置
*/

include("../system/core/core.php");
$title='程序列表';
include './page_head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login_index.php';</script>");
$mod=isset($_GET['mod'])?$_GET["mod"]:null;
$numrows=$DB->count("SELECT count(*) from website_program");
?>
<!--页面主要内容-->
    <main class="lyear-layout-content">
      <div class="container-fluid">
    
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h4>程序列表</h4>
</div>
<div class="card-body">

<div class="alert alert-success alert-dismissible" role="alert">
<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<strong>系统目前有</strong> <?php echo $numrows;?> <strong>个程序</strong>
</div>

<div class="table-responsive">
<table class="table table-striped">
<thead><tr><th>ID</th><th>名称</th><th>时间</th><th>下载</th><th>支持</th><th>状态</th><th>排序</th><th>操作</th></tr></thead>
<tbody>
    
<?php
$rs=$DB->query("SELECT * FROM website_program order by uid asc");
while($res = $DB->fetch($rs))
{
if($res['active']=='1'){
    $active='支持服务';
}else{
    $active='停止服务';
}
if($res['actives']=='1'){
    $actives='显示';
}else{
    $actives='隐藏';
}
if($conf['rewrite_program']=='1'){
        $jump_url = '/program/';
        $s = '.html';
    }else{
        $jump_url = '/page/program/page.php?id=';
    }
echo '
<tr>
<td><b>'.$res['id'].'</b></td>
<td>'.$res['name'].'</td>
<td>'.$res['time'].'</td>
<td>'.$res['number'].'</td>
<td>'.$active.'</td><td>'.$actives.'</td>
<td>
<a href="javascript:uid('.$res['id'].',0)" class="mdi mdi-arrow-up" title="移到顶部"></a>
<a href="javascript:uid('.$res['id'].',1)" class="mdi mdi-arrow-up-box" title="移到上一行"></a>
<a href="javascript:uid('.$res['id'].',2)" class="mdi mdi-arrow-down-box" title="移到下一行"></a>
<a href="javascript:uid('.$res['id'].',3)" class="mdi mdi-arrow-down" title="移到底部"></a>
</td>
<td>
<a href="javascript:del('.$res['id'].')" class="btn btn-round btn-danger btn-xs">删除</a>
<a href="./program_edit.php?id='.$res['id'].'" class="btn btn-round btn-info btn-xs">编辑</a>
<a href="'.$jump_url.$res['id'].$s.'" target="_blank" class="btn btn-round btn-info btn-xs">查看</a>
</td>
</tr>';
}
?>
</tbody>
</table>
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
function uid(id,type){
	var ii = layer.load(0, {shade:[0.1,'#fff']});
		$.ajax({
		    type : "POST",
			url : "ajax_system.php?act=program_uid&type="+type+"&id="+id+"",
			dataType : 'json',
			success : function(data){
				layer.close(ii);
				layer.msg(data.msg)
			if(data.code == 1){
				   window.location.href='./program_list.php'; 
				}
			},
			error:function(data){
				layer.close(ii);
				layer.msg('服务器错误！');
				return false;
			}
		});
	};
function del(id){
layer.confirm('确定？',{btn:['确定','取消'],closeBtn:0,icon:3},function(){
	var ii = layer.load(0, {shade:[0.1,'#fff']});
		$.ajax({
		    type : "POST",
			url : "ajax_system.php?act=program_del&id="+id+"",
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
				layer.msg(data.msg)
			if(data.code == 1){
				   window.location.href='./program_list.php'; 
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
