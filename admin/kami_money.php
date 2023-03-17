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
$title='用户充值卡密';
include './page_head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login_index.php';</script>");
$mod=isset($_GET['mod'])?$_GET["mod"]:index;
?>
    <!--页面主要内容-->
    <main class="lyear-layout-content">
      <div class="container-fluid">
    

         
<?php if($mod=='add'){?>
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h4>卡密生成</h4>
</div>
<div class="card-body">
    
<div class="form-group">
<label>单价</label>
<input type="text" id="money" name="money" class="form-control">
</div>

<div class="form-group">
<label>数量</label>
<input type="text" id="number" name="number" class="form-control">
</div>

<div class="form-group">
<a href="javascript:kami_money_add()" class="btn-block btn-round btn btn-success">确定</a>
</div>

</div>
</div>
</div>
</div>

<?php }elseif($mod=='index'){?>
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h4>卡密列表</h4>
</div>
<div class="card-body">
    
<div class="modal fade" align="left" id="search" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">搜索卡密</h4>
      </div>
      <div class="modal-body">
      <form action="kami_money.php" method="GET">
<input type="text" class="form-control" name="kw" placeholder="请输入卡密内容"><br/>
<input type="submit" class="btn btn-primary btn-block" value="搜索"></form>
</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" align="left" id="search1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">搜索卡密</h4>
      </div>
      <div class="modal-body">
      <form action="kami_money.php" method="GET">
<input type="text" class="form-control" name="id" placeholder="请输入卡密ID"><br/>
<input type="submit" class="btn btn-primary btn-block" value="搜索"></form>
</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<?php
$numrows=$DB->count("SELECT count(*) from website_kami WHERE type='money'");
if(isset($_GET['id'])){
	$sql = " id={$_GET['id']}";
}elseif(isset($_GET['kw'])){
	$sql = " kami='{$_GET['kw']}'";
}else{
	$sql = " 1";
}
$con='系统共有 <b>'.$numrows.'</b> 张充值卡密<br/>
<a href="?mod=add" class="btn btn-primary">添加卡密</a>&nbsp;
<a href="?mod=export" class="btn btn-primary">导出卡密</a>&nbsp;
<a href="javascript:kami_money_delall()" class="btn btn-primary">清空卡密</a>&nbsp;
<a href="#" data-toggle="modal" data-target="#search" id="search" class="btn btn-success">搜索卡密</a>
<a href="#" data-toggle="modal" data-target="#search1" id="search1" class="btn btn-success">搜索ID</a>';

echo '<div class="alert alert-info">';
echo $con;
echo '</div>';

?>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead><tr><th>ID</th><th>卡密</th><th>金额</th><th>添加时间</th><th>使用时间</th><th>使用者</th><th>状态</th><th>操作</th></tr></thead>
          <tbody>
<?php
$pagesize=30;
$pages=intval($numrows/$pagesize);
if ($numrows%$pagesize)
{
 $pages++;
 }
if (isset($_GET['page'])){
$page=intval($_GET['page']);
}
else{
$page=1;
}
$offset=$pagesize*($page - 1);

$rs=$DB->query("SELECT * FROM website_kami WHERE type='money' and {$sql} order by id desc limit $offset,$pagesize");
while($res = $DB->fetch($rs))
{
if($res['active']==0){$active="未使用";}elseif($res['active']==1){$active="已使用";}
echo '
<tr>
<td><b>'.$res['id'].'</b></td>
<td><b>'.$res['kami'].'</b></td>
<td><b>'.$res['money'].'</b></td>
<td><b>'.$res['add_time'].'</b></td>
<td><b>'.$res['use_time'].'</b></td>
<td><b>'.$res['use_user'].'</b></td>
<td>'.$active.'</td><td><a href="javascript:kami_money_del('.$res['id'].')" class="btn btn-xs btn-danger">删除</a></td>
</tr>
';
}
?>
          </tbody>
        </table>
      </div>
<?php
echo'<ul class="pagination">';
$first=1;
$prev=$page-1;
$next=$page+1;
$last=$pages;
if ($page>1)
{
echo '<li><a href="kami_money.php?page='.$first.$link.'">首页</a></li>';
echo '<li><a href="kami_money.php?page='.$prev.$link.'">&laquo;</a></li>';
} else {
echo '<li class="disabled"><a>首页</a></li>';
echo '<li class="disabled"><a>&laquo;</a></li>';
}
for ($i=1;$i<$page;$i++)
echo '<li><a href="kami_money.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '<li class="disabled"><a>'.$page.'</a></li>';
for ($i=$page+1;$i<=$pages;$i++)
echo '<li><a href="kami_money.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '';
if ($page<$pages)
{
echo '<li><a href="kami_money.php?page='.$next.$link.'">&raquo;</a></li>';
echo '<li><a href="kami_money.php?page='.$last.$link.'">尾页</a></li>';
} else {
echo '<li class="disabled"><a>&raquo;</a></li>';
echo '<li class="disabled"><a>尾页</a></li>';
}
echo'</ul>';
#分页
?>


</div>
</div>
</div>
</div>
<?php }elseif($mod=='export'){?>
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h4>卡密列表</h4>
</div>
<div class="card-body">
    
<div class="row">
<div class="col-md-3">
<br/>
<a href="?mod=export_1" class="btn btn-pink btn-block example-p-1">输出全部卡密</a>
</div>

<div class="col-md-3">
<br/>
<a href="?mod=export_2" class="btn btn-pink btn-block example-p-1">输出已使用卡密</a>
</div>

<div class="col-md-3">
<br/>
<a href="?mod=export_3" class="btn btn-pink btn-block example-p-1">输出未使用卡密</a>
</div>

<div class="col-md-3">
<br/>
<a href="?mod=export_4" class="btn btn-pink btn-block example-p-1">输出自定条件卡密</a>
</div>

</div>

<?php }elseif($mod=='export_1'){?>
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h4>卡密列表（全部卡密）</h4>
</div>
<div class="card-body">
<?php 
$rs=$DB->query("SELECT * FROM website_kami WHERE type='money' order by id asc"); 
while($res = $DB->fetch($rs)){ 
echo $res['kami'];
echo '<br/>'; 
}?>

<?php }elseif($mod=='export_2'){?>
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h4>卡密列表（已使用卡密）</h4>
</div>
<div class="card-body">
<?php 
$rs=$DB->query("SELECT * FROM website_kami WHERE active='1' and type='money' order by id asc"); 
while($res = $DB->fetch($rs)){ 
echo $res['kami'];
echo '<br/>'; 
}?>

<?php }elseif($mod=='export_3'){?>
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h4>卡密列表（未使用卡密）</h4>
</div>
<div class="card-body">
<?php 
$rs=$DB->query("SELECT * FROM website_kami WHERE active='0' and type='money' order by id asc"); 
while($res = $DB->fetch($rs)){ 
echo $res['kami'];
echo '<br/>'; 
}?>

<?php }elseif($mod=='export_4'){?>
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h4>卡密列表</h4>
</div>
<div class="card-body">
    
<div class="form-group">
<label for="text">金额</label>
<input type="text" id="money" class="form-control">
</div>

<div class="form-group">
<label for="text">状态：</label>
<select id="active" class="form-control" default="0">
    <option value="0">未使用</option>
    <option value="1">已使用</option>
</select>
</div>

<div class="form-group">
<a href="javascript:export_jump()" class="btn-block btn-round btn btn-success">确定</a>
</div>

<?php }elseif($mod=='export_4_n'){
    $money = $_GET['money'];
    $active = $_GET['active'];
?>
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h4>卡密列表</h4>
</div>
<div class="card-body">
<?php 
$rs=$DB->query("SELECT * FROM website_kami WHERE active='{$active}' and type='money' and money='{$money}' order by id asc"); 
while($res = $DB->fetch($rs)){ 
echo $res['kami'];
echo '<br/>'; 
}
?>

<?php }?>
      </div>
    </main>
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

function export_jump(){
	var money = $("#money").val();
	var active = $("#active").val();
	var ii = layer.load(0, {shade:[0.1,'#fff']});
		if(!money){
				layer.close(ii);
				layer.msg("请先输入金额");
			}else{
			    layer.close(ii);
			    layer.msg("正在跳转");
			    setTimeout(function () {
				location.href="./kami_money.php?mod=export_4_n&money="+money+"&active="+active+"";
				}, 1000);
			}
	};

function kami_money_add(){
	var number=$("#number").val();
	var money=$("#money").val();
	var ii = layer.load(0, {shade:[0.1,'#fff']});
		$.ajax({
		    type : "POST",
			url : "ajax_system.php?act=kami_money_add",
			data : {number:number,money:money},
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
				layer.msg(data.msg)
				if(data.code==1){
						setTimeout(function () {
							location.href="./kami_money.php";
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
		
function kami_money_del(id){
layer.confirm('确定？',{btn:['确定','取消'],closeBtn:0,icon:3},function(){
var ii = layer.load(0, {shade:[0.1,'#fff']});
		$.ajax({
		    type : "POST",
			url : "ajax_system.php?act=kami_money_del&id="+id+"",
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
				layer.msg(data.msg)
			if(data.code==1){
						setTimeout(function () {
							location.href="./kami_money.php";
						}, 1000); 
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

function kami_money_delall(){
layer.confirm('确定清空？',{btn:['确定','取消'],closeBtn:0,icon:3},function(){
var ii = layer.load(0, {shade:[0.1,'#fff']});
		$.ajax({
		    type : "POST",
			url : "ajax_system.php?act=kami_money_delall",
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
				layer.msg(data.msg)
			if(data.code==1){
						setTimeout(function () {
							location.href="./kami_money.php";
						}, 1000); 
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