<?php
include("../system/core/core.php");
$text  = daddslashes($_GET['text']);
$type  = daddslashes($_GET['type']);
$title = '快捷登录注册';
$query = base64_decode($text, true);
$arr   = json_decode($query, true);
if($conf['site_active']=='1'){
    sysmsg('<h2>网站维护已开启</h2><ul><li><font size="4">'.$conf['site_active_notice'].'</font></li>',true);
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
        <title><?php echo $title;?> - <?php echo $conf['site_title'];?></title>
        <link rel="icon" href="../assets/System/icon/favicon.ico" type="image/ico">
        <meta name="keywords" content="<?php echo $conf['site_keywords'];?>">
        <meta name="description" content="<?php echo $conf['site_description'];?>">
        <meta name="author" content="AiWeiYi_Studio">
        <link href="../../assets/LightYear/css/bootstrap.min.css" rel="stylesheet">
        <link href="../../assets/LightYear/css/materialdesignicons.min.css" rel="stylesheet">
        <link href="../../assets/LightYear/css/style.min.css" rel="stylesheet">
        <style>
            body {
                background: url("../assets/System/img/bj.jpg") no-repeat center center;
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
            <div class="col-xs-12 col-sm-10 col-md-8 col-lg-8 center-block" style="float: none;">
                <div class="card">
                    <ul class="nav nav-tabs page-tabs">
                        <li style="width: 50%;" align="center"><a href="#reg" data-toggle="tab">快捷注册</a></li>
                        <li style="width: 50%;" align="center"><a href="#login" data-toggle="tab">快捷绑定</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="reg">
                            <div class="input-group">
                                <span class="input-group-addon">账号</span>
                                <input type="text" id="user_1" class="form-control" value="<?php echo get_username();?>">
                            </div>
                            <br/>
                            <div class="input-group">
                                <span class="input-group-addon">密码</span>
                                <input type="text" id="pass_1" class="form-control" value="<?php echo get_password();?>">
                            </div>
                            <br/>
                            <div class="input-group">
                                <span class="input-group-addon">昵称</span>
                                <input type="text" id="name" class="form-control" value="<?php echo $arr['nickname'];?>" disabled="disabled">
                            </div>
                            <br/>
                            <div class="input-group">
                                <span class="input-group-addon">密钥</span>
                                <input type="text" id="token" class="form-control" value="<?php echo $arr['social_uid'];?>" disabled="disabled">
                            </div>
                            <br/>
                            <div class="form-group">
                                <a href="javascript:reg()" class="btn-block btn-round btn btn-info">注册</a>
                            </div>
                        </div>
                        <div class="tab-pane" id="login">
                            <div class="input-group">
                                <span class="input-group-addon">账号</span>
                                <input type="text" id="user_2" class="form-control">
                            </div>
                            <br/>
                            <div class="input-group">
                                <span class="input-group-addon">密码</span>
                                <input type="text" id="pass_2" class="form-control">
                            </div>
                            <br/>
                            <div class="form-group">
                                <a href="javascript:login()" class="btn-block btn-round btn btn-info">绑定</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="../../assets/LightYear/js/jquery.min.js"></script>
        <script type="text/javascript" src="../../assets/LightYear/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../../assets/LightYear/js/main.min.js"></script>
        
        <script src="../assets/Layer/layer.js"></script>
        
        <script type="text/javascript" src="../assets/System/user/js/login_sign.js?ver=<?php echo VER ?>"></script>
    </body>
</html>