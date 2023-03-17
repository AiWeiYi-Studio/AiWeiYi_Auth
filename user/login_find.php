<?php
$title='密码找回';
include("../system/core/core.php");
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
    <link rel="icon" href="../../assets/System/icon/favicon.ico" type="image/ico">
    <meta name="keywords" content="<?php echo $conf['site_keywords'];?>">
    <meta name="description" content="<?php echo $conf['site_description'];?>">
    <meta name="author" content="AiWeiYi_Studio">
    <link href="../../assets/LightYear/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../assets/LightYear/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="../../assets/LightYear/css/style.min.css" rel="stylesheet">
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
            background-color: rgba(255,255,255,.075);
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
            background-color: rgba(255,255,255,.075);
            border-color: rgba(255,255,255,.075)
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
        .login-center .form-control::-webkit-input-placeholder{ 
            color: rgba(255, 255, 255, .8);
        } 
        .login-center .form-control:-moz-placeholder{ 
            color: rgba(255, 255, 255, .8);
        } 
        .login-center .form-control::-moz-placeholder{ 
            color: rgba(255, 255, 255, .8);
        } 
        .login-center .form-control:-ms-input-placeholder{ 
            color: rgba(255, 255, 255, .8);
        }
        .login-center .custom-control-label::before {
            background: rgba(0, 0, 0, 0.3);
            border-color: rgba(0, 0, 0, 0.1);
        }
        .login-center .lyear-checkbox span::before {
            border-color: rgba(255,255,255,.075)
        }
    </style>
</head>
  
<body>
<div class="row lyear-wrapper" style="background-image: url(../assets/System/img/bj.jpg); background-size: cover;">
  <div class="lyear-login">
    <div class="login-center">
      <div class="login-header text-center">
        <img alt="light year admin" src="../assets/System/img/logo.png" width="300px">
      </div>
        <div class="form-group has-feedback feedback-left">
          <input type="text" placeholder="请输入您的用户名" class="form-control" id="username" />
          <span class="mdi mdi-account form-control-feedback" aria-hidden="true"></span>
        </div>
        <div class="form-group has-feedback feedback-left row">
            <div class="col-xs-8">
                <input type="text" class="form-control" placeholder="请输入验证码" id="code"/>
                <span class="mdi mdi-check-all form-control-feedback" aria-hidden="true"></span>
            </div>
            <div class="col-xs-4">
                <img id="codeimg" src="../system/plugin/AiWeiYi_Code/code.php?r=<?php echo time();?>" height="38px" onclick="this.src='../system/plugin/AiWeiYi_Code/code.php?r=<?php echo time();?>'" title="点击更换验证码">
            </div>
        </div>
        <div class="form-group text-center">
            <a href="javascript:send()" class="btn-xs-block btn-round btn btn-danger">发送代码</a>
            <a href="./login_password.php" class="btn-xs-block btn-round btn btn-info">我已有代码</a>
        </div>
      <footer class="col-sm-12 text-center text-white">
        <p class="m-b-0">Copyright ©  <?php echo $conf['site_copyright'];?></p>
      </footer>
    </div>
  </div>
</div>


<script type="text/javascript" src="../../assets/LightYear/js/jquery.min.js"></script>
<script type="text/javascript" src="../../assets/LightYear/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../../assets/LightYear/js/main.min.js"></script>
<script src="../assets/Layer/layer.js"></script>

<script type="text/javascript">
function send(){
	var username = $("#username").val();
	var code     = $("#code").val();
	var ii = layer.load(0, {shade:[0.1,'#fff']});
		$.ajax({
		    type : "POST",
			url : "ajax_login.php?act=find_send",
			data : {username:username,code:code},
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
</script>
</body>
</html>