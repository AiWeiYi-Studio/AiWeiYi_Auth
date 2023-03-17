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
$title = '文章列表';

if($conf['site_active']=='1'){
sysmsg('<h2>网站维护已开启</h2><ul><li><font size="4">'.$conf['site_active_notice'].'</font></li>',true);
}

if($conf['rewrite_article']=='1'){
$head = '
<a href="/">网站首页</a> \ 
		<a href="/article/index.html">文章列表</a>
';
$baidu_post_url = $siteurls.'article/index.html';
}else{
$head = '
<a href="/">网站首页</a> \ 
		<a href="/page/article/index.php">文章列表</a>
';
$baidu_post_url = $siteurls.'page/article/index.php';
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
$result = curl_exec($ch);
curl_exec($ch);
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
<link rel="stylesheet" type="text/css" href="../../assets/Layui/css/layui.css"/>
<script src="https://cdn.bootcdn.net/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<style>
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
	 
.project-list-item {
background-color: #fff;
border: 1px solid #e8e8e8;
border-radius: 4px;
cursor: pointer;
transition: all .2s;
}

.project-list-item:hover {
box-shadow: 0 2px 10px rgba(0, 0, 0, .15);
}

.project-list-item .project-list-item-cover {
width: 100%;
height: 150px;
display: block;
border-top-left-radius: 4px;
border-top-right-radius: 4px;
}

.project-list-item-body {
padding: 20px;
}

.project-list-item .project-list-item-body > h2 {
font-size: 18px;
color: #333;
margin-bottom: 12px;
}

.project-list-item .project-list-item-text {
height: 25px;
overflow: hidden;
margin-bottom: 10px;
}

.project-list-item .project-list-item-desc {
position: relative;
}

.project-list-item .project-list-item-desc .time {
color: #999;
font-size: 12px;
}

.project-list-item .project-list-item-desc .ew-head-list {
position: absolute;
right: 0;
top: 0;
}

.project-list-item-desc{
min-height:21px;
}

.ew-head-list .ew-head-list-item {
width: 22px;
height: 22px;
border-radius: 50%;
border: 1px solid #fff;
margin-left: -10px;
}

.ew-head-list .ew-head-list-item:first-child {
margin-left: 0;
}

.form-item-title {
text-align: center;
position: relative;
}

.form-item-title:before {
content: "";
position: absolute;
border-top: 1px dashed #ccc;
left: 40px;
right: 40px;
top: 8px;
z-index: -1;
}

.transparent_class {
	   filter:alpha(opacity=90);
	   -moz-opacity:0.90;
	   -khtml-opacity: 0.90;
	   opacity: 0.90;
}

.form-item-title > span {
background-color: white;
padding: 0 10px;
font-size: 13px;
color: #666;
}

</style>
</head>
<body layadmin-themealias="dark-blue" style="margin-top: 1em;">

<div class="imgc"></div>
<div class="layui-fluid">
<div class="layui-col-sm10 layui-col-sm-offset1">
<div class="layui-card">
<div class="layui-tab layui-tab-brief">
<div class="layui-card-header" style="height: 3em; line-height: 3em;">
<h3><i class="layui-icon layui-icon-app"><?php echo $head;?></i></h3>
</div>
<div class="layui-tab-content">
<div class="layui-tab-content">
<div class="layui-tab-item layui-show" style="padding-top: 0px;">
<div class="layui-row layui-col-space60" id="Blog">


</div>
</div>
</div>
</div>
</div>
</div>
</div>
<!-- 文章页面 -->
<script type="text/html" id="Article">
    <div class="layui-col-md3">
        <div class="project-list-item" style="margin:10px">
            <a href="down.php?id={{d.id}}"><img class="project-list-item-cover" src="{{d.img}}"/></a>
            <div class="project-list-item-body">
            <h2><a href="down.php?id={{d.id}}">{{d.title}}</a></h2>
                <div class="project-list-item-text layui-text">{{d.title_site}}</div>
                <div class="project-list-item-desc">
                    <span lay-tips="文章访问状态！">{{d.active}}</span>
                    <div class="ew-head-list">
                        <img class="ew-head-list-item" lay-tips="{{d.QQName}}" lay-offset="0,-5px" src="//q4.qlogo.cn/headimg_dl?dst_uin={{d.email}}&amp;spec=100"/>
                    </div>
                    <span class="article-list-item-tool-item" lay-tips="文章Top状态！">
                        <i class="layui-icon layui-icon-top"></i>&nbsp;
                    <span>{{d.top}}</span>
                  </span>
                    <span class="article-list-item-tool-item" lay-tips="文章发布时间！">
                        <i class="layui-icon layui-icon-date"></i>&nbsp;
                    <span>{{d.date}}</span>
                  </span>
                </div>
            </div>
        </div>
    </div>
</div>
</script>
<script type="text/javascript" src="../../assets/Layui/layui.js"></script>
<script type="text/javascript" src="https://auth.phpth.cn/assets/frame/js/common.js?v=318"></script>
<script>
layui.use(['layer', 'form', 'laydate', 'element', 'dataGrid', 'fileChoose'],function() {
	var $ = layui.jquery;
	var layer = layui.layer;
	var form = layui.form;
	var laydate = layui.laydate;
	var element = layui.element;
	var dataGrid = layui.dataGrid;
	var fileChoose = layui.fileChoose;
	dataGrid.render({
		elem: '#Blog',
		templet: '#Article',
		url: './ajax.php?act=list',
		loadMore: { limit: 8 }
	});
});
</script>
</body>
</html>