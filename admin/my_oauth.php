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
include './page_head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login_index.php';</script>");
?>
<!--页面主要内容-->
    <main class="lyear-layout-content">
      
      <div class="container-fluid">
        
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h4>快捷登录信息</h4>
</div>
<div class="card-body">

<div class="row">

<div class="col-sm-6 col-lg-6">
<div class="form-group">
<label for="qq_token">QQ登录</label>
<input type="text" class="form-control" value="<?php echo $udata['oauth_qq'];?>" disabled="disabled" >
</div>
</div>

<div class="col-sm-6 col-lg-6">
<div class="form-group">
<label for="weixin_token">微信登录</label>
<input type="text" class="form-control" value="<?php echo $udata['oauth_weixin'];?>" disabled="disabled" >
</div>
</div>

<div class="col-sm-6 col-lg-6">
<div class="form-group">
<label for="alipay_token">支付宝登录</label>
<input type="text" class="form-control" value="<?php echo $udata['oauth_alipay'];?>" disabled="disabled" >
</div>
</div>

<div class="col-sm-6 col-lg-6">
<div class="form-group">
<label for="weibo_token">微博登录</label>
<input type="text" class="form-control" value="<?php echo $udata['oauth_weibo'];?>" disabled="disabled" >
</div>
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

<script src="../assets/Layer/layer.js"></script>

</body>
</html>