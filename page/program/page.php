<?php
/*
* @Time    : 2022/05/22 20:57
* @Author  : 爱唯逸网络科技
* @Mail    : support@857xx.cn
* @Site    : https://web.857xx.cn
* @File    : page.php
* @Action  : 程序文章页面
*/

include("../../system/core/core.php");
$id = $_GET['id'];
$row = $DB->get_row("SELECT * FROM website_program WHERE id='$id' limit 1");
$DB->query("update website_program set number='{$row['number']}'+1 where id='{$row['id']}'");
if($conf['site_active']=='1'){
sysmsg('<h2>网站维护已开启</h2><ul><li><font size="4">'.$conf['site_active_notice'].'</font></li>',true);
}
if($conf['rewrite_program']=='1'){
    $head = '
        <a href="/">网站首页</a>\ 
        <a href="/program/index.html">程序列表</a>\ 
        <a href="/program/'.$row['id'].'.html">'.$row['name'].'</a>
        ';
    $baidu_post_url = $siteurls.'program/'.$id.'.html';
}else{
    $head = '
        <a href="/">网站首页</a> \ 
        <a href="/page/program/index.php">程序列表</a> \ 
        <a href="/page/program/page.php?id='.$row['id'].'">'.$row['name'].'</a>
        ';
    $baidu_post_url = $siteurls.'page/program/page.php?id='.$id.'';
}
$urls = array(
    ''.$baidu_post_url.''
);
$api = 'http://data.zz.baidu.com/urls?site='.$siteurls.'&token='.$conf['site_baidu'];
$ch = curl_init();
$options =  array(
    CURLOPT_URL => $api,
    CURLOPT_POST => true,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POSTFIELDS => implode("\n", $baidu_post),
    CURLOPT_HTTPHEADER => array('Content-Type: text/plain'),
);
curl_setopt_array($ch, $options);
curl_exec($ch);
?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
    <title><?php echo $row['title'];?> - <?php echo $conf['site_title'];?></title>
    <link rel="icon" href="../../assets/System/icon/favicon.ico" type="image/ico">
    <meta name="keywords" content="<?php echo $conf['site_keywords'];?>">
    <meta name="description" content="<?php echo $conf['site_description'];?>">
    <link rel="stylesheet" type="text/css" href="../../assets/Layui/css/layui.css"/>
    <style>
        .article-content img {
            max-width: 100% !important;
        }
    </style>
    <style>
        body {
            background: linear-gradient(to right, #c9c, #ccf);
            font-family: 微软雅黑
        }
 
        @media only screen and (min-width:700px) {
            .content {
                left: 50%;
                margin-left: -25%
            }
        }
 
        .img {
            width: 7em;
            height: 7em;
            margin: auto;
            display: block;
            border-radius: 10em;
            box-shadow: 3px 3px 8px 1px silver;
            margin-bottom: 1em
        }
 
        .imgc {
            background-image: url(../../assets/System/img/bj.jpg);
            background-size: 100% 100%;
            background-repeat: repeat;
            top: 0;
            position: fixed;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -33
        }
 
        .layui-layer-title {
            background-color: #000 !important;
            color: white !important;
        }
 
        #qrimg
        #count{
    word-wrap: break-word;
    word-break: normal;
    color:rgb(53,73,94);
    }
    </style>
    <style>
        .transparent_class {
            filter: alpha(opacity=90);
            -moz-opacity: 0.90;
            -khtml-opacity: 0.90;
            opacity: 0.90;
        }
    </style>
</head>
<body layadmin-themealias="dark-blue" style="margin-top: 1em;">
    <div class="imgc"></div>
    <div id="divLoading">
        <div class="transparent_class">
            <div class="layui-fluid">
                <div class="a layui-anim layui-anim-fadein">
                    <div class="layui-row layui-col-space15">
                            <div class="layui-col-sm8 layui-col-sm-offset2">
                            <div class="layui-card">
                                <div class="layui-card-header" style="height: 3em; line-height: 3em;">
                                <?php echo $head;?>
                                </div>
                                <div class="layui-card-body">
                                    <fieldset class="layui-elem-field">
                                        <legend><?php echo $row['name'];?></legend>
                                        <div class="layui-field-box">
                                            <div class="article-content">
                                            <?php echo $row['text'];?>
                                            </div>
                                        </div>
							        </fieldset>
							        <blockquote class='layui-elem-quote'>阅览量： <?php echo $row['number']+1;?></blockquote>
							        <blockquote class='layui-elem-quote'>发布时间： <?php echo $row['time'];?></blockquote>
          							<fieldset class="layui-elem-field layui-field-title">
          							    <legend>如有侵权联系管理删除！</legend>
          							</fieldset>
          						</div>
          					</div>
          				</div>
          			</div>
				</div> 
        	</div>
   		</div>
	</div>
</div>
<script type="text/javascript" src="../../assets/Layui/layui.js"></script>
</boby>
</html>