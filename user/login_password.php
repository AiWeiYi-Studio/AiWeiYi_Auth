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
$title = '密码找回';
$token = $_GET['token'];
$act   = $_GET['act'];
$row   = $DB->get_row("SELECT * FROM website_find WHERE token = '$token' limit 1");
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
        .article-content img {
            max-width: 100% !important;
        }
        body {
            background: url("../../assets/System/img/bj.jpg") no-repeat center center;
            background-size: cover;
            background-attachment: fixed;
        }
        .transparent_class {
	           filter:alpha(opacity=90);
        	   -moz-opacity:0.90;
        	   -khtml-opacity: 0.90;
        	   opacity: 0.90;
        }
    </style>
</head>
<body>
<div class="container" style="padding-top:60px;">
    <div class="col-xs-12 col-sm-8 col-lg-8 center-block" style="float: none;">
        <div class="transparent_class">
            <div class="card">
                <div class="card-header bg-purple">
                    <h4>密码找回</h4>
                    <ul class="card-actions">
                        <li><?php echo $date; ?></li>
                    </ul>
                </div>
                <?php if(!$token && !$act){?>
                <div class="card-body">
                    <ul class="nav-step step-dots">
                        <li class="nav-step-item complete">
                            <span>验证密钥</span>
                            <a class="active"></a>
                        </li>
                        <li class="nav-step-item active">
                            <span>修改密码</span>
                            <a></a>
                        </li>
                        <li class="nav-step-item">
                            <span>修改成功</span>
                            <a></a>
                        </li>
                    </ul>
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>提示：</strong>请输入获取到的密钥进行修改操作
                    </div>
                    <div class="form-group">
                        <input type="text" id="token" class="form-control" placeholder="密钥">
                    </div>
                    <div class="text-center">
                        <a href="javascript:check()" class="btn btn-w-md btn-round btn-danger">确定</a>
                    </div>
                </div>
                <?php }elseif($token){?>
                <div class="card-body">
                    <ul class="nav-step step-dots">
                        <li class="nav-step-item complete">
                            <span>验证密钥</span>
                            <a class="active"></a>
                        </li>
                        <li class="nav-step-item complete">
                            <span>修改密码</span>
                            <a class="active"></a>
                        </li>
                        <li class="nav-step-item active">
                            <span>修改成功</span>
                            <a></a>
                        </li>
                    </ul>
                    <?php if(!$row){?>
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>提示：</strong>密钥不存在，请重新获取
                    </div>
                    <?php }elseif($row['active'] == '0'){?>
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>提示：</strong>密钥已被使用，请重新获取
                    </div>
                    <?php }elseif($row['time'] < TIME-180){?>
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>提示：</strong>密钥已过期，请重新获取
                    </div>
                    <?php }elseif($row['active'] == '1' && $row['time'] > TIME-180){?>
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>提示：</strong>请输入需要更新的密码
                    </div>
                    <div class="form-group">
                        <input type="password" id="password_1" class="form-control" placeholder="请输入新密码">
                    </div>
                    <div class="form-group">
                        <input type="password" id="password_2" class="form-control" placeholder="二次确认密码">
                    </div>
                    <div class="text-center">
                        <a href="javascript:update()" class="btn btn-w-md btn-round btn-danger">确定</a>
                    </div>
                    <?php }?>
                </div>
                <?php }elseif($act){?>
                <div class="card-body">
                    <ul class="nav-step step-dots">
                        <li class="nav-step-item complete">
                            <span>验证密钥</span>
                            <a class="active"></a>
                        </li>
                        <li class="nav-step-item complete">
                        <span>修改密码</span>
                            <a class="active"></a>
                        </li>
                        <li class="nav-step-item complete">
                            <span>修改成功</span>
                            <a class="active"></a>
                        </li>
                    </ul>
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>提示：</strong>密码修改完成
                    </div>
                    <div class="form-group">
                        <a href="/user/" class="btn-block btn-round btn btn-info">登录</a>
                    </div>
                <?php }?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="../../assets/LightYear/js/jquery.min.js"></script>
<script type="text/javascript" src="../../assets/LightYear/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../../assets/LightYear/js/main.min.js"></script>

<script src="../../assets/Layer/layer.js"></script>

<script type="text/javascript">
function check(){
	var token = $("#token").val();
	var ii = layer.load(0, {shade:[0.1,'#fff']});
		$.ajax({
		    type : "POST",
			url : "ajax_login.php?act=find_check",
			data : {token:token},
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
				layer.msg(data.msg)
				if(data.code==1){
				    setTimeout(function () {
				        location.href="./login_password.php?token="+data.token;
				    }, 3000);
				}
			},
			error:function(data){
				layer.close(ii);
				layer.msg('服务器错误！');
				return false;
		}
	});
};

function update(){
    var password_1 = $("#password_1").val();
	var password_2 = $("#password_2").val();
	var ii = layer.load(0, {shade:[0.1,'#fff']});
		$.ajax({
		    type : "POST",
			url : "ajax_login.php?act=find_update&token=<?php echo $token;?>",
			data : {password_1:password_1,password_2:password_2},
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
				layer.msg(data.msg)
				if(data.code==1){
				    setTimeout(function () {
				        location.href="./login_password.php?act=ok";
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