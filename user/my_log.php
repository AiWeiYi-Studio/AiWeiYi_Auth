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
$title='用户日志';
include './page_head.php';
if($islogins==1){}else exit("<script language='javascript'>window.location.href='./login_index.php';</script>");
$mod=isset($_GET['mod'])?$_GET["mod"]:index;
?>
    <!--页面主要内容-->
    <main class="lyear-layout-content">
      <div class="container-fluid">
    
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h4>用户日志</h4>
</div>
<div class="card-body">
    
<div class="modal fade" align="left" id="search" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">搜索</h4>
      </div>
      <div class="modal-body">
      <form action="my_log.php" method="GET">
<input type="text" class="form-control" name="uid" placeholder="请输入站长UID"><br/>
<input type="submit" class="btn btn-primary btn-block" value="搜索"></form>
</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<?php
$numrows=$DB->count("SELECT count(*) from website_log where uid = '".$udata['uid']."'");
if(isset($_GET['uid'])){
	$sql = " uid={$_GET['uid']}";
}elseif(isset($_GET['type'])){
	$sql = " user={$_GET['type']}";
}else{
	$sql = " 1";
}
$con='系统共有 <b>'.$numrows.'</b> 个日志<br/>
<a href="#" data-toggle="modal" data-target="#search" id="search" class="btn btn-success">搜索</a>';

echo '<div class="alert alert-info">';
echo $con;
echo '</div>';

?>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead><tr><th>ID</th><th>UID</th><th>操作IP</th><th>操作城市</th><th>操作类型</th><th>操作内容</th><th>操作时间</th><th>操作</th></tr></thead>
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

$rs=$DB->query("SELECT * FROM website_log WHERE uid = '".$udata['uid']."' and {$sql} order by id desc limit $offset,$pagesize");
while($res = $DB->fetch($rs))
{
echo '
<tr>
<td><b>'.$res['id'].'</b></td>
<td>'.$res['uid'].'</td>
<td>'.$res['ip'].'</td>
<td>'.$res['city'].'</td>
<td>'.$res['type'].'</td>
<td><a href="javascript:text('.$res['id'].')">'.mb_substr($res['content'],0,25).'...</a></td>
<td>'.$res['date'].'</td>
<td>
<a href="?mod=del&id='.$res['id'].'" class="btn btn-round btn-xs btn-danger">删除</a>
</td>
</tr>';
}
?>
          </tbody>
        </table>
      </div>
<?php
$uid = $_GET['uid'];
if($uid){
$url = '&uid='.$uid.'';
}else{
$url = '';
}
echo'<ul class="pagination">';
$first=1;
$prev=$page-1;
$next=$page+1;
$last=$pages;
if ($page>1)
{
echo '<li><a href="my_log.php?page='.$first.$link.$url.'">首页</a></li>';
echo '<li><a href="my_log.php?page='.$prev.$link.$url.'">&laquo;</a></li>';
} else {
echo '<li class="disabled"><a>首页</a></li>';
echo '<li class="disabled"><a>&laquo;</a></li>';
}
for ($i=1;$i<$page;$i++)
echo '<li><a href="my_log.php?page='.$i.$link.$url.'">'.$i .'</a></li>';
echo '<li class="disabled"><a>'.$page.'</a></li>';
for ($i=$page+1;$i<=$pages;$i++)
echo '<li><a href="my_log.php?page='.$i.$link.$url.'">'.$i .'</a></li>';
echo '';
if ($page<$pages)
{
echo '<li><a href="my_log.php?page='.$next.$link.$url.'">&raquo;</a></li>';
echo '<li><a href="my_log.php?page='.$last.$link.$url.'">尾页</a></li>';
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

      </div>
    </main>
<script type="text/javascript" src="../assets/LightYear/js/jquery.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/perfect-scrollbar.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/main.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/jquery.cookie.min.js"></script>

<script src="../assets/Layer/layer.js"></script>
<script type="text/javascript">
function text(id){
	    var ii = layer.load(0, {shade:[0.1,'#fff']});
	    $.ajax({
	        type : "POST",
	        data : {id:id},
	        url : "ajax_my.php?act=get_log_text",
	        dataType : 'json',
	        success : function(data) {
	            layer.close(ii);
	            layer.msg(data.msg);
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