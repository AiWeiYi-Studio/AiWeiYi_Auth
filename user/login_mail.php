<?php
$title='邮箱登录';
include("../system/core/core.php");
$go_url = daddslashes($_GET['go_url']);
if(!$go_url){
    $go_url = 'index.php';
}
if($conf['site_active']=='1'){
    sysmsg('<h2>网站维护已开启</h2><ul><li><font size="4">'.$conf['site_active_notice'].'</font></li>',true);
    }
?>

<!DOCTYPE html>
<html lang="zh">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
<title><?php echo $title;?> - <?php echo $conf['site_title'];?></title>
<link rel="icon" href="../assets/System/icon/favicon.ico" type="image/ico">
<meta name="keywords" content="<?php echo $conf['site_keywords'];?>">
<meta name="description" content="<?php echo $conf['site_description'];?>">
<link href="../assets/LightYear/css/bootstrap.min.css" rel="stylesheet">
<link href="../assets/LightYear/css/materialdesignicons.min.css" rel="stylesheet">
<link href="../assets/LightYear/css/style.min.css" rel="stylesheet">
<style>
.lyear-wrapper {
    position: relative;
}
.lyear-login {
    display: flex !important;
    min-height: 100vh;
    align-items: center !important;
    justify-content: center !important;
}
.lyear-login:after{
    content: '';
    min-height: inherit;
    font-size: 0;
}
.login-center {
    background: #fff;
    min-width: 29.25rem;
    padding: 2.14286em 3.57143em;
    border-radius: 3px;
    margin: 2.85714em;
}
.login-header {
    margin-bottom: 1.5rem !important;
}
.login-center .has-feedback.feedback-left .form-control {
    padding-left: 38px;
    padding-right: 12px;
}
.login-center .has-feedback.feedback-left .form-control-feedback {
    left: 0;
    right: auto;
    width: 38px;
    height: 38px;
    line-height: 38px;
    z-index: 4;
    color: #dcdcdc;
}
.login-center .has-feedback.feedback-left.row .form-control-feedback {
    left: 15px;
}
</style>
</head>
  
<body>
<div class="row lyear-wrapper" style="background-image: url(../assets/System/img/bj.jpg); background-size: cover;">
  <div class="lyear-login">
    <div class="login-center">
      <div class="login-header text-center">
        <img alt="light year admin" src="../assets/System/img/logo.png" width="250px"/>
      </div>

<div class="form-group has-feedback feedback-left">
<input type="text" placeholder="请输入您的邮箱" class="form-control" id="mail" />
<span class="mdi mdi-email form-control-feedback" aria-hidden="true"></span>
</div>

<div class="form-group has-feedback feedback-left row">
<div class="col-xs-7">
<input type="text" id="codes" class="form-control" placeholder="请输入网页验证码">
<span class="mdi mdi-check-all form-control-feedback" aria-hidden="true"></span>
</div>
<div class="col-xs-5">
    <img src="../system/plugin/AiWeiYi_Code/code.php?r=<?php echo time();?>" class="pull-right" style="height:40px;" onclick="this.src='../system/plugin/AiWeiYi_Code/code.php?r='+Math.random();" title="点击刷新" alt="captcha">
</div>
</div>

<div class="form-group has-feedback feedback-left row">
<div class="col-xs-7">
<input type="text" class="form-control" placeholder="请输入邮箱验证码" id="code"/>
<span class="mdi mdi-check-all form-control-feedback" aria-hidden="true"></span>
</div>
<div class="col-xs-5">
<a href="javascript:send_code()" class="btn btn-info pull-right">获取验证码</a>
</div>
</div> 

<div class="form-group">
<a href="javascript:login()" class="btn-block btn-round btn btn-info">登录</a>
</div>

      <footer class="col-sm-12 text-center text-white">
        <p class="m-b-0">Copyright ©  <?php echo $conf['site_copyright'];?></p>
      </footer>
    </div>
  </div>
</div>

<script type="text/javascript" src="../assets/LightYear/js/jquery.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/perfect-scrollbar.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/main.min.js"></script>

<script src="../assets/Layer/layer.js"></script>

<script type="text/javascript">
function send_code(){
	var mail=$("#mail").val();
	var codes=$("#codes").val();
	var ii = layer.load(0, {shade:[0.1,'#fff']});
		$.ajax({
		    type : "POST",
			url : "ajax_login.php?act=login_mail_code",
			data : {mail:mail,codes:codes},
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
			    layer.msg(data.msg)
			},
			error:function(data){
				layer.close(ii);
				layer.msg('服务器错误！');
				return false;
		}
	});
};
function login(){
    var mail=$("#mail").val();
    var code=$("#code").val();
	var codes=$("#codes").val();
	var ii = layer.load(0, {shade:[0.1,'#fff']});
		$.ajax({
		    type : "POST",
			url : "ajax_login.php?act=login_mail",
			data : {mail:mail,code:code,codes:codes},
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
				layer.msg(data.msg)
			if(data.code==1){
						setTimeout(function () {
							location.href="<?php echo $go_url;?>";
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
</script>
</body>
</html>