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
$title = '悄悄话';
$key = $_GET['key'];
$row = $DB->get_row("SELECT * FROM website_privacy WHERE token = '$key' limit 1");
$rows = $DB->get_row("SELECT * FROM website_user WHERE uid = '{$row['user']}' limit 1");
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
        .text{
            word-break:break-all;
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
                            <?php if($row && $row['time'] > TIME && $row['number'] > 0){
                                echo '剩余：'.($row['number'] - 1).' 次';
                            }elseif($row && $row['number'] == 0){
                                echo $date;
                            }elseif($row && $row['time'] < TIME){
                                echo '已过期：'.round((TIME - $row['time'])/3600/24).' 天';
                            }elseif($row && ($row['number'] - 1) == 0){
                                echo '退出则销毁';
                            }elseif(!$row){
                                echo $date;
                            }?>
                        </li>
                        <?php if($row){?>
                        <li class="dropdown">
                            <button type="button" data-toggle="dropdown">更多<span class="caret"></span></button>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li> <a><span class="badge pull-right"></span> 发布时间：<?php echo $row['date'];?></a> </li>
                                <li> <a><span class="badge pull-right"></span> 到期时间：<?php echo date('Y-m-d h:i:s',$row['time']);?></a> </li>
                            </ul>
                       </li>
                       <?php }?>
                    </ul>
                </div>
                <div class="card-body">
                    <?php if(!$row){?>
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>提示：</strong>密钥错误或悄悄话不存在
                    </div>
                    <?php }else{if($row['time'] <= TIME){?>
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>提示：</strong>悄悄话已过期无法查看
                    </div>
                    <?php }if($row['number'] <= 0){?>
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>提示：</strong>当前悄悄话已被销毁
                    </div>
                    <?php }if($row && $row['time'] > TIME && $row['number'] > 0){
                        $DB->query("update website_privacy set number = number - 1 where token = '{$key}'");
                        if($row['mail'] == '1' && $rows['mail_time'] > 0){
                            $DB->query("update website_user set mail_time = mail_time-1 where uid='{$row['user']}'");
                            $text='
                                内容：悄悄话被查看通知
                                <br/>
                                次数：还可查看'.($row['number']-1).'次
                                <br/>
                                时间：'.$date.'
                                <br/>
                                IP：'.$clientip.'
                                <br/>
                                地址：'.get_ip_city($clientip); // 邮件内容
                            send_mail($rows['mail'],'悄悄话通知',$text,null);                                                     // 发送邮件
                        }
                    ?>
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong><?php echo $rows['name'];?>说：</strong><b class="text"><?php echo $row['text'];?></b>
                    </div>
                    <?php }}?>
                    <br/>
                    <div class="example-box text-center">
                        <a class="btn btn-sm btn-round btn-purple" href="/privacy/index.html">列表</a>
                        <a class="btn btn-sm btn-round btn-brown" href="/privacy/search.html">搜索</a>
                        <a class="btn btn-sm btn-round btn-cyan" href="/user/privacy_add.php">发布</a>
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
</body>
</html>