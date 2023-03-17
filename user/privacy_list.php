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
$title='悄悄话列表';
include './page_head.php';
if($islogins==1){}else exit("<script language='javascript'>window.location.href='./login_index.php?go_url=".get_url_last()."';</script>");
if($conf['site_active']=='1'){
    sysmsg('<h2>网站维护已开启</h2><ul><li><font size="4">'.$conf['site_active_notice'].'</font></li>',true);
}
$numrows=$DB->count("SELECT count(*) from website_privacy where user = '".$udata['uid']."'");
?>

<link rel="stylesheet" href="../assets/Layui/css/layui.css">
<script src="../assets/Layui/layui.all.js"></script>

<!--页面主要内容-->
    <main class="lyear-layout-content">
      <div class="container-fluid">
         
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h4>悄悄话列表</h4>
</div>
<div class="card-body">

<div class="alert alert-success alert-dismissible" role="alert">
<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<strong>系统目前有<?php echo $numrows;?>条记录，点击ID可查看内容</strong>
</div>

<div class="table-responsive">
<table class="table table-striped">
<thead><tr><th>ID</th><th>发布时间</th><th>到期时间</th><th>密钥</th><th>IP</th><th>次数</th><th>操作</th></tr></thead>
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

$rs=$DB->query("SELECT * FROM website_privacy  where user = '".$udata['uid']."' order by id desc limit $offset,$pagesize");
while($res = $DB->fetch($rs))
{
    $row = $DB->get_row("SELECT * FROM website_user WHERE uid='{$res['user']}' limit 1");
    if($row){
        $user_name = $row['name'];
    }else{
        $user_name = '无记录';
    }
echo '
<tr>
<td>
    <a href="javascript:text('.$res['id'].')">'.$res['id'].'</a>
</td>
<td>'.$res['date'].'</td>
<td>'.date('Y-m-d h:i:s',$res['time']).'</td>
<td>'.$res['token'].'</td>
<td><a href="javascript:city('.$res['id'].')">'.$res['ip'].'</a></td>
<td>'.$res['number'].'</td>
<td>
    <a class="btn btn-round btn-info btn-xs url" data-clipboard-text="'.$siteurls.'privacy/'.$res['token'].'.html">复制</a>
    <a href="/privacy/'.$res['token'].'.html" target="_blank" class="btn btn-round btn-info btn-xs">查看</a>
    <a href="javascript:qrcode('.$res['id'].')" class="btn btn-round btn-info btn-xs">二维码</a>
</td>
</tr>';
}
?>
</tbody>
</table>
</div>

<?php
echo '<center>';
echo'<ul class="pagination">';
$first=1;
$prev=$page-1;
$next=$page+1;
$last=$pages;
if ($page>1)
{
echo '<li><a href="?page='.$first.$link.$url.'">首页</a></li>';
echo '<li><a href="?page='.$prev.$link.$url.'">&laquo;</a></li>';
} else {
echo '<li class="disabled"><a>首页</a></li>';
echo '<li class="disabled"><a>&laquo;</a></li>';
}
for ($i=1;$i<$page;$i++)
echo '<li><a href="?page='.$i.$link.$url.'">'.$i .'</a></li>';
echo '<li class="disabled"><a>'.$page.'</a></li>';
for ($i=$page+1;$i<=$pages;$i++)
echo '<li><a href="?page='.$i.$link.$url.'">'.$i .'</a></li>';
echo '';
if ($page<$pages)
{
echo '<li><a href="?page='.$next.$link.$url.'">&raquo;</a></li>';
echo '<li><a href="?page='.$last.$link.$url.'">尾页</a></li>';
} else {
echo '<li class="disabled"><a>&raquo;</a></li>';
echo '<li class="disabled"><a>尾页</a></li>';
}
echo '</center>';
echo'</ul>';
#分页
?>


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

<script src="../../assets/Api/js/clipboard.min.js"></script>

<script src="../assets/Layer/layer.js"></script>

<script>
    layui.use('code', function () { //加载code模块
		layui.code(); //引用code方法
	});
	var clipboard = new ClipboardJS('.url');
	clipboard.on('success', function (e) {
		layer.msg('复制成功');
	});
	clipboard.on('error', function (e) {
		layer.msg('复制成功');
	});
	function city(id){
	    var ii = layer.load(0, {shade:[0.1,'#fff']});
	    $.ajax({
	        type : "POST",
	        data : {id:id},
	        url : "ajax_privacy.php?act=get_city",
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
	function text(id){
	    var ii = layer.load(0, {shade:[0.1,'#fff']});
	    $.ajax({
	        type : "POST",
	        data : {id:id},
	        url : "ajax_privacy.php?act=get_text",
	        dataType : 'json',
	        success : function(data) {
	            layer.close(ii);
	            layer.open({
	                title: '悄悄话内容',
	                maxWidth: '200',
	                btn: '关闭',
	                content: data.msg
	            });
	        },
	        error:function(data){
	            layer.close(ii);
	            layer.msg('服务器错误！');
	            return false;
	        }
	    });
	};
function qrcode(id){
    var ii = layer.load(0, {shade:[0.1,'#fff']});
    $.ajax({
        type : "POST",
        data : {id:id},
		url : "ajax_privacy.php?act=qrcode",
		dataType : 'json',
		success : function(data) {
			layer.close(ii);
			if(data.code == 1){
			    var img = data.qrcode;
			    function getBase64Image(img) {
			            var canvas = document.createElement("canvas");
			            canvas.width = img.width;
			            canvas.height = img.height;
			            var ctx = canvas.getContext("2d");
			            ctx.drawImage(img, 0, 0, img.width, img.height);
			            var ext = img.src.substring(img.src.lastIndexOf(".")+1).toLowerCase();
			            var dataURL = canvas.toDataURL("image/"+ext);
			            return dataURL;
			        }
			        var image = new Image();
			        image.src = img;
			        image.onload = function(){
			            var base64 = getBase64Image(image);
			            var item = '<center>';
			            item += '<img src="'+base64+'" width="70%">';
			            item += '</center>';
			            layer.open({
			                type:1,
			                btn: ['关闭'],
			                title: '二维码',
			                content: item
			            });
			        }
			    }else{
			        layer.msg(data.msg);
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