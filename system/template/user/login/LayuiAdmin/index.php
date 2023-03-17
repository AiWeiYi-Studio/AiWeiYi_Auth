<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title><?php echo $title;?> - <?php echo $conf['site_title'];?></title>
        <link rel="icon" href="../assets/System/icon/favicon.ico" type="image/ico">
        <meta name="keywords" content="<?php echo $conf['site_keywords'];?>">
        <meta name="description" content="<?php echo $conf['site_description'];?>">
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
        <link rel="stylesheet" href="../assets/Layui/css/layui.css" media="all">
        <link rel="stylesheet" href="<?php echo $arr['assets'];?>admin.css" media="all">
        <link rel="stylesheet" href="<?php echo $arr['assets'];?>login.css" media="all">
    </head>
    <body>
        <div class="layadmin-user-login layadmin-user-display-show" id="LAY-user-login" style="display: none;">
            <div class="layadmin-user-login-main">
                <div class="layadmin-user-login-box layadmin-user-login-header">
                    <h2><?php echo $conf['site_title'];?></h2>
                    <h4><?php echo $title;?></h4>
                </div>
                <div class="layadmin-user-login-box layadmin-user-login-body layui-form">
                    <div class="layui-form-item">
                        <label class="layadmin-user-login-icon layui-icon layui-icon-username" for="LAY-user-login-username"></label>
                        <input type="text" name="user" id="user" lay-verify="required" placeholder="账号" value="<?php echo $_GET['username'];?>" class="layui-input">
                    </div>
                    <div class="layui-form-item">
                        <label class="layadmin-user-login-icon layui-icon layui-icon-password" for="LAY-user-login-password"></label>
                        <input type="password" name="pass" id="pass" lay-verify="required" placeholder="密码" value="<?php echo $_GET['password'];?>" class="layui-input">
                    </div>
                    <div class="layui-form-item">
                        <button type="submit" id="submit" value="登陆" class="layui-btn layui-btn-fluid"><span class="fa fa-mail-forward"></span> 登录</button>
                    </div>
                    <div class="layui-trans layui-form-item layadmin-user-login-other">
                        <a href="./login_qq.php"><i class="layui-icon layui-icon-login-qq"></i></a>
                        <a href="./login_weixin.php"><i class="layui-icon layui-icon-login-wechat"></i></a>
                        <a href="./login_weibo.php"><i class="layui-icon layui-icon-login-weibo"></i></a>
                        <a href="./login_alipay.php"><img src="../assets/System/icon/alipay.ico" width="25"></a>
                        <a href="./login_mail.php?go_url=<?php echo $go_url;?>"><i class="layui-icon layui-icon-email"></i></a>
                        <a href="./login_phone.php?go_url=<?php echo $go_url;?>"><i class="layui-icon layui-icon-dialogue"></i></a>
                        <a href="./login_find.php?go_url=<?php echo $go_url;?>" class="layadmin-user-jump-change layadmin-link">找回</a>
                        <a href="./login_reg.php?go_url=<?php echo $go_url;?>" class="layadmin-user-jump-change layadmin-link">注册</a>
                    </div>
                </div>
            </div>
            <div class="layui-trans layadmin-user-login-footer">
                <p class="m-b-0">Copyright © <a href="/"><?php echo $conf['site_copyright'];?></a>. All right reserved</p>
            </div>
        </div>
        <script type="text/javascript" src="../assets/LightYear/js/jquery.min.js"></script>  
        <script src="../assets/Layui/layui.js"></script>
        <script src="../assets/Layer/layer.js"></script>
        <script>
        $("#submit").click(function(){
            var user=$("#user").val();
            var pass=$("#pass").val();
            var ii = layer.load(0, {shade:[0.1,'#fff']});
            $.ajax({
		        type : "POST",
			    url : "ajax_login.php?act=login",
			    data : {user:user,pass:pass},
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
		});
		</script>
</body>
</html>
