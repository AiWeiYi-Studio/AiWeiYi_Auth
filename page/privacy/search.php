<?php
/*
* @Time    : 2022/05/22 20:57
* @Author  : 爱唯逸网络科技
* @Mail    : support@857xx.cn
* @Site    : https://web.857xx.cn
* @File    : auth_name.php
* @Action  : 程序昵称配置
*/

include("../../system/core/core.php");
$title = '悄悄话搜索';
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
                    <h4>悄悄话</h4>
                    <ul class="card-actions">
                        <li>
                            <?php echo $date;?>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>提示：</strong>请输入悄悄话密钥进行查看
                    </div>
                        <input type="text" class="form-control" id="token" placeholder="输入查看密钥或输入123456查看测试悄悄话">
                    <br/>
                    <div class="example-box text-center">
                        <a class="btn btn-sm btn-round btn-purple" href="/privacy/index.html">列表</a>
                        <a class="btn btn-sm btn-round btn-cyan" href="/user/privacy_add.php">发布</a>
                        <a class="btn btn-sm btn-round btn-brown" href="javascript:check()" align="right">验证</a>
                        <a class="btn btn-sm btn-round btn-pink" href="javascript:history.back(-1)" align="right">返回</a>
                    </div>
                </div>
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
                url : "/page/privacy/ajax.php?act=check_token",
                data : {token:token},
                dataType : 'json',
                success : function(data) {
                    layer.close(ii);
                    layer.msg(data.msg)
                    if(data.code==1){
                        setTimeout(function () {
                            location.href = data.url;
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