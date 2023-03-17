<?php
include("../system/core/core.php");
$title='通知功能';
include './page_head.php';
if($islogins==1){}else exit("<script language='javascript'>window.location.href='./login_index.php?go_url=".get_url_last()."';</script>");
if($conf['site_active']=='1'){
    sysmsg('<h2>网站维护已开启</h2><ul><li><font size="4">'.$conf['site_active_notice'].'</font></li>',true);
}
?>
<!--页面主要内容-->
    <main class="lyear-layout-content">
      
      <div class="container-fluid">
        
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h4>通知功能</h4>
</div>
<div class="card-body">

<div class="form-group">
<label>登录邮件通知</label>
<select id="active_mail" class="form-control" default="<?php echo $udata['active_mail'];?>">
<option value="0">关闭</option>
<option value="1">开启</option>
</select>
<small class="help-block">邮件余额大于0时有效，当前余额：<code><?php echo $udata['mail_time'];?></code></small>
</div>

<div class="form-group">
<a href="javascript:edit()" class="btn-block btn-round btn btn-success">确定</a>
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

<script type="text/javascript" src="../assets/System/user/js/my_notice.js?ver=<?php echo VER ?>"></script>

<script src="../assets/Layer/layer.js"></script>

</body>
</html>