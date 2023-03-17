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
$title='用户信息';
$uid = $_GET['uid'];
include './page_head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login_index.php';</script>");
$row = $DB->get_row("SELECT * FROM website_user WHERE uid='$uid' limit 1");
?>
<!--页面主要内容-->
    <main class="lyear-layout-content">
      
      <div class="container-fluid">
        
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h4>用户详细信息</h4>
</div>
<div class="card-body">

<div class="row">
<div class="col-sm-6 col-lg-6">
<div class="form-group">
<label for="uid">UID</label>
<input type="text" class="form-control" value="<?php echo $row['uid'];?>" disabled="disabled" />
</div>
</div>

<div class="col-sm-6 col-lg-6">
<div class="form-group">
<label for="user">用户账号</label>
<input type="text" class="form-control" value="<?php echo $row['user'];?>" disabled="disabled">
</div>
</div>

<div class="col-sm-6 col-lg-6">
<div class="form-group">
<label for="user">用户密码</label>
<input type="text" class="form-control" value="<?php echo $row['pass'];?>" disabled="disabled">
</div>
</div>

<div class="col-sm-6 col-lg-6">
<div class="form-group">
<label for="user">用户密钥</label>
<input type="text" class="form-control" value="<?php echo $row['token'];?>" disabled="disabled">
</div>
</div>

<div class="col-sm-6 col-lg-6">
<div class="form-group">
<label for="name">用户昵称</label>
<input type="text" class="form-control" value="<?php echo $row['name'];?>" disabled="disabled" >
</div>
</div>

<div class="col-sm-6 col-lg-6">
<div class="form-group">
<label for="qq">用户QQ</label>
<input type="text" class="form-control" value="<?php echo $row['qq'];?>" disabled="disabled" >
</div>
</div>

<div class="col-sm-6 col-lg-6">
<div class="form-group">
<label for="mail">用户邮箱</label>
<input type="text" class="form-control" value="<?php echo $row['mail'];?>" disabled="disabled" >
</div>
</div>

<div class="col-sm-6 col-lg-6">
<div class="form-group">
<label for="phone">用户电话</label>
<input type="text" class="form-control" value="<?php echo $row['phone'];?>" disabled="disabled" >
</div>
</div>

<div class="col-sm-6 col-lg-6">
<div class="form-group">
<label for="time">添加时间</label>
<input type="text" class="form-control" value="<?php echo $row['reg_time'];?>" disabled="disabled" >
</div>
</div>

<div class="col-sm-6 col-lg-6">
<div class="form-group">
<label for="time">登录时间</label>
<input type="text" class="form-control" value="<?php echo $row['login_time'];?>" disabled="disabled" >
</div>
</div>

<div class="col-sm-6 col-lg-6">
<div class="form-group">
<label for="ip">登录IP</label>
<input type="text" class="form-control" value="<?php echo $row['login_ip'];?>" disabled="disabled" >
</div>
</div>

<div class="col-sm-6 col-lg-6">
<div class="form-group">
<label for="ip">绑定IP</label>
<input type="text" class="form-control" value="<?php echo $row['client_ip'];?>" disabled="disabled" >
</div>
</div>

<div class="col-sm-6 col-lg-6">
<div class="form-group">
<label for="oauth_qq">QQ登录</label>
<input type="text" class="form-control" value="<?php echo $row['oauth_qq'];?>" disabled="disabled" >
</div>
</div>

<div class="col-sm-6 col-lg-6">
<div class="form-group">
<label for="oauth_weixin">微信登录</label>
<input type="text" class="form-control" value="<?php echo $row['oauth_weixin'];?>" disabled="disabled" >
</div>
</div>

<div class="col-sm-6 col-lg-6">
<div class="form-group">
<label for="oauth_alipay">支付宝登录</label>
<input type="text" class="form-control" value="<?php echo $row['oauth_alipay'];?>" disabled="disabled" >
</div>
</div>

<div class="col-sm-6 col-lg-6">
<div class="form-group">
<label for="oauth_weibo">微博登录</label>
<input type="text" class="form-control" value="<?php echo $row['oauth_weibo'];?>" disabled="disabled" >
</div>
</div>

</div>

</div>
</div>
</div>
      
    </main>
    <!--End 页面主要内容-->
  </div>
</div>

<script type="text/javascript" src="../assets/LightYear/js/jquery.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/perfect-scrollbar.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/main.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/jquery.cookie.min.js"></script>

<script src="../assets/Layer/layer.js"></script>

</body>
</html>