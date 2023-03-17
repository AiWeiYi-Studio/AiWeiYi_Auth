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
$title='网站模板配置';
include './page_head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login_index.php';</script>");
$mod=isset($_GET['mod'])?$_GET["mod"]:'list';
?>
<!--页面主要内容-->
    <main class="lyear-layout-content">
      <div class="container-fluid">
    
<?php if($mod=='list'){
$numrows=$DB->count("SELECT count(*) from website_template");
?>

<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h4>模板列表</h4>
</div>
<div class="card-body">

<div class="alert alert-success alert-dismissible" role="alert">
<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<strong>系统目前有</strong> <?php echo $numrows;?> <strong>个模板</strong>
</div>

     <div class="table-responsive">
        <table class="table table-striped">
          <thead><tr><th>目录</th><th>名称</th><th>类型</th><th>操作</th></tr></thead>
          <tbody>
<?php
$rs=$DB->query("SELECT * FROM website_template order by type");
while($res = $DB->fetch($rs))
{
if($res['type']=='index'){
$type="网站首页页面";
}elseif($res['type']=='admin_login'){
$type="站长登录页面";
}elseif($res['type']=='user_login'){
$type="用户登录页面";
}elseif($res['type']=='user_reg'){
$type="用户注册页面";
}else{
$type="未识别：".$res['type']."";
}
echo '
<tr>
<td>'.$res['path'].'</td>
<td>'.$res['name'].'</td>
<td><b><font color="red">'.$type.'</font></b></td>
<td>
<a href="?mod=edit&uid='.$res['uid'].'" class="btn btn-info btn-xs">编辑</a>
<a href="javascript:template_del('.$res['uid'].')" class="btn btn-xs btn-danger">删除</a>
</td>
</tr>';
}
?>
          </tbody>
        </table>
      </div>
      
<div class="example-box text-center">
<a href="javascript:automatic_index()" class="btn btn-primary">首页模板</a>
<a href="javascript:automatic_admin_login()" class="btn btn-primary">站长登录模板</a>
<a href="javascript:automatic_user_login()" class="btn btn-primary">用户登录模板</a>
<a href="javascript:automatic_user_reg()" class="btn btn-primary">用户注册模板</a>
</div>

<?php }elseif($mod=='edit'){
$uid = $_GET['uid'];
$row = $DB->get_row("SELECT * FROM website_template WHERE uid='$uid' limit 1");
?>

<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h4>模板修改</h4>
</div>
<div class="card-body">
    
<div class="input-group">
<span class="input-group-addon">模板UID</span>
<input type="text" id="uid" name="uid" class="form-control" value="<?=$row['uid']?>" disabled="disabled" />
</div><br/>

<div class="input-group">
<span class="input-group-addon">模板目录</span>
<input type="text" id="path" name="path" class="form-control" placeholder="请输入模板目录" value="<?=$row['path']?>">
</div><br/>

<div class="input-group">
<span class="input-group-addon">模板昵称</span>
<input type="text" id="name" name="name" class="form-control" placeholder="请输入标识的模板名称" value="<?=$row['name']?>">
</div><br/>

<div class="input-group">
<span class="input-group-addon">模板类型</span>
<select id="type" name="type" class="form-control" default="<?=$row['type']?>">
<option value="index">网站首页页面</option>
<option value="user_login">用户登录页面</option>
<option value="user_reg">用户注册页面</option>
<option value="admin_login">站长登录页面</option>
</select>
</div><br/>

<div class="form-group">
<a href="javascript:template_edit()" class="btn-block btn-round btn btn-success">确定修改</a>
</div>

</div>
</div>
</div>

<?php }elseif($mod=='add'){?>
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h4>模板添加</h4>
</div>
<div class="card-body">

<div class="input-group">
<span class="input-group-addon">模板目录</span>
<input type="text" id="path" name="path" class="form-control" placeholder="请输入模板目录">
</div><br/>

<div class="input-group">
<span class="input-group-addon">模板昵称</span>
<input type="text" id="name" name="name" class="form-control" placeholder="请输入标识的模板名称">
</div><br/>

<div class="input-group">
<span class="input-group-addon">模板类型</span>
<select id="type" name="type" class="form-control">
<option value="index">网站首页页面</option>
<option value="user_login">用户登录页面</option>
<option value="user_reg">用户注册页面</option>
<option value="admin_login">站长登录页面</option>
</select>
</div><br/>

<div class="form-group">
<a href="javascript:template_add()" class="btn-block btn-round btn btn-success">确定添加</a>
</div>

</div>
</div>
</div>

<?php }elseif($mod=='indexs'){
$result = file_get_contents(CORE."template/index/".$conf['template_index']."/index.json");
$arrs=json_decode($result,true);
?>

<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h4>网站首页模板</h4>
</div>

<div class="row">
<div class="card-body">
<div class="col-sm-6 col-lg-6">
<img src="<?php echo $arrs['demo'];?>" width="100%">
</div>

<div class="col-sm-6 col-lg-6">
<pre>
<span style="color:black">模板版本：</span><span style="color:red"><?php echo $arrs['version'];?></span><br>
<span style="color:black">模板作者：</span><span style="color:red"><?php echo $arrs['author'];?></span><br>
<span style="color:black">作者网页：</span><span style="color:red"><a href="<?php echo $arrs['website'];?>" target="_blank"><?php echo $arrs['website'];?></a></span><br>
<span style="color:black">作者QQ：</span><span style="color:red"><?php echo $arrs['qq'];?></span><br>
<span style="color:black">更新时间：</span><span style="color:red"><?php echo $arrs['time'];?></span><br>
<span style="color:black">模板介绍：</span><span style="color:red"><?php echo $arrs['notice'];?></span><br>
</pre>

<div class="input-group">
<span class="input-group-addon">首页模板</span>
<select id="template_index" name="template_index" class="form-control" default="<?=$conf['template_index']?>">
<?php
$rs=$DB->query("SELECT * FROM website_template WHERE type='index' order by uid desc");
while($res = $DB->fetch($rs))
{
echo '<option value="'.$res['path'].'">'.$res['name'].'</option>';
}
?>
</select>
</div><br/>

<div class="form-group">
<a href="javascript:set_template_index()" class="btn-block btn-round btn btn-success">确定修改</a>
</div>
</div>

</div></div>

<?php }elseif($mod=='login'){
$result = file_get_contents(CORE."template/admin/login/".$conf['template_admin_login']."/index.json");
$arr=json_decode($result,true);

$results = file_get_contents(CORE."template/user/login/".$conf['template_user_login']."/index.json");
$arrs=json_decode($result,true);
?>

<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h4>站长后台登录</h4>
</div>

<div class="row">
<div class="card-body">
<div class="col-sm-6 col-lg-6">
<img src="<?php echo $arr['demo'];?>" width="100%">
</div>

<div class="col-sm-6 col-lg-6">
<pre>
<span style="color:black">模板版本：</span><span style="color:red"><?php echo $arr['version'];?></span><br>
<span style="color:black">模板作者：</span><span style="color:red"><?php echo $arr['author'];?></span><br>
<span style="color:black">作者网页：</span><span style="color:red"><a href="<?php echo $arr['website'];?>" target="_blank"><?php echo $arr['website'];?></a></span><br>
<span style="color:black">作者QQ：</span><span style="color:red"><?php echo $arr['qq'];?></span><br>
<span style="color:black">更新时间：</span><span style="color:red"><?php echo $arr['time'];?></span><br>
<span style="color:black">模板介绍：</span><span style="color:red"><?php echo $arr['notice'];?></span><br>
</pre>

<div class="input-group">
<span class="input-group-addon">站长登录模板</span>
<select id="template_admin_login" name="template_admin_login" class="form-control" default="<?=$conf['template_admin_login']?>">
<?php
$rs=$DB->query("SELECT * FROM website_template WHERE type='admin_login' order by uid desc");
while($res = $DB->fetch($rs))
{
echo '<option value="'.$res['path'].'">'.$res['name'].'</option>';
}
?>
</select>
</div><br/>

<div class="form-group">
<a href="javascript:set_template_admin_login()" class="btn-block btn-round btn btn-success">确定修改</a>
</div>
</div>

</div>
</div>
</div>
</div>

<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h4>用户后台登录</h4>
</div>

<div class="row">
<div class="card-body">
<div class="col-sm-6 col-lg-6">
<img src="<?php echo $arrs['demo'];?>" width="100%">
</div>

<div class="col-sm-6 col-lg-6">
<pre>
<span style="color:black">模板版本：</span><span style="color:red"><?php echo $arrs['version'];?></span><br>
<span style="color:black">模板作者：</span><span style="color:red"><?php echo $arrs['author'];?></span><br>
<span style="color:black">作者网页：</span><span style="color:red"><a href="<?php echo $arrs['website'];?>" target="_blank"><?php echo $arrs['website'];?></a></span><br>
<span style="color:black">作者QQ：</span><span style="color:red"><?php echo $arrs['qq'];?></span><br>
<span style="color:black">更新时间：</span><span style="color:red"><?php echo $arrs['time'];?></span><br>
<span style="color:black">模板介绍：</span><span style="color:red"><?php echo $arrs['notice'];?></span><br>
</pre>

<div class="input-group">
<span class="input-group-addon">用户登录模板</span>
<select id="template_user_login" name="template_user_login" class="form-control" default="<?=$conf['template_user_login']?>">
<?php
$rs=$DB->query("SELECT * FROM website_template WHERE type='user_login' order by uid desc");
while($res = $DB->fetch($rs))
{
echo '<option value="'.$res['path'].'">'.$res['name'].'</option>';
}
?>
</select>
</div><br/>

<div class="form-group">
<a href="javascript:set_template_user_login()" class="btn-block btn-round btn btn-success">确定修改</a>
</div>
</div>

</div></div>

<?php }elseif($mod=='reg'){
$result = file_get_contents(CORE."template/user/reg/".$conf['template_user_reg']."/index.json");
$arrs=json_decode($result,true);
?>

<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h4>用户注册</h4>
</div>

<div class="row">
<div class="card-body">
<div class="col-sm-6 col-lg-6">
<img src="<?php echo $arrs['demo'];?>" width="100%">
</div>

<div class="col-sm-6 col-lg-6">
<pre>
<span style="color:black">模板版本：</span><span style="color:red"><?php echo $arrs['version'];?></span><br>
<span style="color:black">模板作者：</span><span style="color:red"><?php echo $arrs['author'];?></span><br>
<span style="color:black">作者网页：</span><span style="color:red"><a href="<?php echo $arrs['website'];?>" target="_blank"><?php echo $arrs['website'];?></a></span><br>
<span style="color:black">作者QQ：</span><span style="color:red"><?php echo $arrs['qq'];?></span><br>
<span style="color:black">更新时间：</span><span style="color:red"><?php echo $arrs['time'];?></span><br>
<span style="color:black">模板介绍：</span><span style="color:red"><?php echo $arrs['notice'];?></span><br>
</pre>

<div class="input-group">
<span class="input-group-addon">用户注册模板</span>
<select id="template_user_reg" name="template_user_reg" class="form-control" default="<?=$conf['template_user_reg']?>">
<?php
$rs=$DB->query("SELECT * FROM website_template WHERE type='user_reg' order by uid desc");
while($res = $DB->fetch($rs))
{
echo '<option value="'.$res['path'].'">'.$res['name'].'</option>';
}
?>
</select>
</div><br/>

<div class="form-group">
<a href="javascript:set_template_user_reg()" class="btn-block btn-round btn btn-success">确定修改</a>
</div>
</div>

</div></div>
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

<script src="../assets/Layer/layer.js"></script>

<script type="text/javascript" src="../assets/System/admin/js/set_template.js?ver=<?php echo VER ?>"></script>
</body>
</html>