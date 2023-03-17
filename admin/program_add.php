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
$title='程序添加';
include './page_head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login_index.php';</script>");
$mod=isset($_GET['mod'])?$_GET["mod"]:null;
?>
<!--页面主要内容-->
    <main class="lyear-layout-content">
      <div class="container-fluid">

<?php if($mod=='add_ok'){
	$name=daddslashes($_POST['name']);
	$title=daddslashes($_POST['title']);
    $img=daddslashes($_POST['img']);
    $number=daddslashes($_POST['number']);
	$time=daddslashes($_POST['time']);
	$author=daddslashes($_POST['author']);
	$active=daddslashes($_POST['active']);
	$status=daddslashes($_POST['status']);
	$text=daddslashes($_POST['text']);
	if(!$time){
	    $time = $date;
	}else{
	    $time = $time;
	}
	if(!$img){
	    $result = file_get_contents("https://api.btstu.cn/sjbz/api.php?format=json");
        $arr=json_decode($result,true);
        $img = $arr['imgurl'];
	}else{
	    $img = $img;
	}
	$row = $DB->get_row("SELECT * FROM website_program order by uid desc limit 1");
	$uid = $row['uid']+1;
	$sql="insert into `website_program` (`name`,`title`,`img`,`number`,`time`,`author`,`active`,`status`,`text`,`uid`) values ('".$name."','".$title."','".$img."','".$number."','".$time."','".$author."','".$active."','".$status."','".$text."','".$uid."')";
	if(!$name){
	exit("<script language='javascript'>alert('添加失败：标题为空');history.go(-1);</script>");
	}elseif(!$text){
	exit("<script language='javascript'>alert('添加失败：内容为空');history.go(-1);</script>");
	}elseif($DB->query($sql)){
	$city=get_ip_city($clientip);
    $DB->query("insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','添加','添加程序：".$name.",'".$date."','admin')");
	exit("<script language='javascript'>alert('添加成功');history.go(-1);</script>");
	}else{
	exit("<script language='javascript'>alert('添加失败');history.go(-1);</script>");
	}
?>

<?php }else{?>
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h4>程序添加</h4>
</div>
<div class="card-body">
    
<form action="?mod=add_ok" method="POST" role="form">

<div class="input-group">
<span class="input-group-addon">程序昵称</span>
<input type="text" id="name" name="name" class="form-control" placeholder="请输入名称" value="<?php echo $_POST['name'];?>">
</div><br/>

<div class="input-group">
<span class="input-group-addon">程序简介</span>
<input type="text" id="title" name="title" class="form-control" placeholder="请输入程序简介" value="<?=$_POST['title']?>" >
</div><br/>

<div class="input-group">
<span class="input-group-addon">程序头图</span>
<input type="text" id="img" name="img" class="form-control" placeholder="请输入程序头图" value="<?=$_POST['img']?>" >
</div><br/>

<div class="input-group">
<span class="input-group-addon">浏览量</span>
<input type="number" id="number" class="form-control" placeholder="请输入浏览数量" value="<?php echo $_POST['number'];?>">
</div><br/>

<div class="input-group">
<span class="input-group-addon">添加时间</span>
<input class="form-control js-datetimepicker" type="text" id="time" name="time" placeholder="请输入添加时间" value="<?php echo$_POST['time'];?>" data-side-by-side="true" data-locale="zh-cn" data-format="YYYY-MM-DD HH:mm:ss" />
</div><br/>

<div class="input-group">
<span class="input-group-addon">程序作者</span>
<input type="text" id="author" name="author" class="form-control" placeholder="请输入程序作者" value="<?=$_POST['author']?>" >
</div><br/>

<div class="input-group">
<span class="input-group-addon">服务状态</span>
<select id="active" name="active" class="form-control" default="<?php echo $_POST['active'];?>">
<option value="1">支持服务</option>
<option value="0">停止维护</option>
</select>
</div><br/>

<div class="input-group">
<span class="input-group-addon">显示状态</span>
<select id="status" name="status" class="form-control" default="<?php echo $_POST['status'];?>">
<option value="1">显示</option>
<option value="0">隐藏</option>
</select>
</div><br/>

<div class="form-group">
<label for="text">文章内容：</label>
<textarea id="Ueditor" name="text" style="width:100%;height:400px;"></textarea>
</script>
</div>

</from>

<div class="form-group">
<input type="submit" name="submit" value="确定" class="btn btn-primary form-control"/>
</div>

<?php }?>
</div> 
</div>
    </main>
<!--End 页面主要内容-->

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

<!-- 配置文件 -->
<script type="text/javascript" charset="gbk" src="../assets/Ueditor/ueditor.config.js"></script>
<!-- 编辑器源码文件 -->
<script type="text/javascript" charset="gbk" src="../assets/Ueditor/ueditor.all.js"></script>
<!-- 编辑器语言 -->
<script type="text/javascript" charset="gbk" src="../assets/Ueditor/lang/zh-cn/zh-cn.js"></script>

<script type="text/javascript">
var ue = UE.getEditor('Ueditor');
setTimeout(function () {
ue.execCommand('drafts');
}, 500);

function add(){
	var title=$("#title").val();
	var time=$("#time").val();
	var text=$("#text").val();
	var number=$("#number").val();
	var active=$("#active").val();
	var ii = layer.load(0, {shade:[0.1,'#fff']});
		$.ajax({
		    type : "POST",
			url : "ajax_system.php?act=article_add",
			data : {title:title,text:text,active:active,time:time,number:number},
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
				layer.msg(data.msg)
			if(data.code == 1){
				   window.location.href="./set_article.php"; 
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