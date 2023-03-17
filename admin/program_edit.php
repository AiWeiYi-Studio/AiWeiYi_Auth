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
$title='文章修改';
include './page_head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login_index.php';</script>");
$mod=isset($_GET['mod'])?$_GET["mod"]:'list';
$id = $_GET['id'];
?>
<!--页面主要内容-->
    <main class="lyear-layout-content">
      <div class="container-fluid">

<?php if($mod=='edit_ok'){
    
    $name=daddslashes($_POST['name']);
	$title=daddslashes($_POST['title']);
    $img=daddslashes($_POST['img']);
    $number=daddslashes($_POST['number']);
	$time=daddslashes($_POST['time']);
	$author=daddslashes($_POST['author']);
	$active=daddslashes($_POST['active']);
	$status=daddslashes($_POST['status']);
	$text=daddslashes($_POST['text']);
    $sql="update website_program set name='$name',title='$title',img='$img',number='$number',time='$time',author='$author',active='$active',status='$status',text='$text' where id='{$id}'";
if(!$id){
exit("<script language='javascript'>alert('修改失败：ID为空');history.go(-1);</script>");
}elseif($DB->query($sql)){
$city=get_ip_city($clientip);
$DB->query("insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','修改','修改文章：".$title."','".$date."','admin')");
exit("<script language='javascript'>alert('修改成功');history.go(-1);</script>");
}else{
exit("<script language='javascript'>alert('修改失败');history.go(-1);</script>");
}
?>
  
<?php }else{
$row = $DB->get_row("SELECT * FROM website_program WHERE id='$id' limit 1");
if(!$row){
    showmsg('系统不存在该记录',$head=false);
}
?>
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h4>程序修改</h4>
</div>
<div class="card-body">

<form action="?mod=edit_ok&id=<?php echo $row['id'];?>" method="POST" role="form">
    
<div class="input-group">
<span class="input-group-addon">程序昵称</span>
<input type="text" id="name" name="name" class="form-control" placeholder="请输入名称" value="<?php echo $row['name'];?>">
</div><br/>

<div class="input-group">
<span class="input-group-addon">程序简介</span>
<input type="text" id="title" name="title" class="form-control" placeholder="请输入程序简介" value="<?php echo $row['title'];?>" >
</div><br/>

<div class="input-group">
<span class="input-group-addon">程序头图</span>
<input type="text" id="img" name="img" class="form-control" placeholder="请输入程序头图" value="<?php echo $row['img'];?>" >
</div><br/>

<div class="input-group">
<span class="input-group-addon">浏览量</span>
<input type="number" id="number" name="number" class="form-control" placeholder="请输入浏览数量" value="<?php echo $row['number'];?>">
</div><br/>

<div class="input-group">
<span class="input-group-addon">添加时间</span>
<input class="form-control js-datetimepicker" type="text" id="time" name="time" placeholder="请输入添加时间" value="<?php echo $row['time'];?>" data-side-by-side="true" data-locale="zh-cn" data-format="YYYY-MM-DD HH:mm:ss" />
</div><br/>

<div class="input-group">
<span class="input-group-addon">程序作者</span>
<input type="text" id="author" name="author" class="form-control" placeholder="请输入程序作者" value="<?php echo $row['author'];?>" >
</div><br/>

<div class="input-group">
<span class="input-group-addon">服务状态</span>
<select id="active" name="active" class="form-control" default="<?php echo $row['active'];?>">
<option value="1">支持服务</option>
<option value="0">停止维护</option>
</select>
</div><br/>

<div class="input-group">
<span class="input-group-addon">显示状态</span>
<select id="status" name="status" class="form-control" default="<?php echo $row['status'];?>">
<option value="1">显示</option>
<option value="0">隐藏</option>
</select>
</div><br/>

<div class="form-group">
<label for="text">文章内容：</label>
<textarea id="Ueditor" name="text" style="width:100%;height:400px;">
    <?php echo $row['text'];?>
</textarea>
</script>
</div>

</from>

<div class="form-group">
<input type="submit" name="submit" value="确定" class="btn btn-primary form-control"/>
</div>

</div>
</div>
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

var items = $("select[default]");
for (i = 0; i < items.length; i++) {
$(items[i]).val($(items[i]).attr("default")||0);
}
</script>
</body>
</html>