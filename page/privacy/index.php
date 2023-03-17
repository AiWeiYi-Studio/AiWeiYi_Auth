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
$title = '悄悄话列表';
if($conf['rewrite_program']=='1'){
    $head = '
        <a href="/">网站首页</a> \ 
        <a href="/privacy/index.html">悄悄话列表</a>
    ';
    $baidu_post_url = $siteurls.'privacy/index.html';
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
    <link rel="stylesheet" type="text/css" href="../../assets/Layui/css/layui.css"/>
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
<body layadmin-themealias="dark-blue" style="margin-top:2em;">
    <div class="imgc"></div>
    <div class="layui-fluid">
        <div class="layui-col-sm10 layui-col-sm-offset1">
            <div class="layui-card">
                <div class="layui-tab layui-tab-brief">
                    <div class="layui-card-header" style="height: 3em; line-height: 3em;">
                        <h3><i class="layui-icon layui-icon-app"><?php echo $head;?></i>
                    </div>
                    <div class="layui-tab-content">
                        <center>
                            <div class="layui-input-inline">
                                <input type="text" id="token" class="layui-input" placeholder="输入密码查看私密悄悄话">
                            </div>
                            <a href="javascript:check()" class="layui-btn layui-btn-radius layui-btn-normal">查看</a>
                        </center>
                        <br/>
                        <div class="layui-btn-container" style="text-align: center;">
                        <a class="layui-btn layui-btn-radius layui-btn-primary layui-border-blue" href="/privacy/search.html">搜索</a>
                        <a class="layui-btn layui-btn-radius layui-btn-primary layui-border-orange" href="/user/privacy_add.php">发布</a>
                        </div>
                        <div class="layui-tab-item layui-show" style="padding-top: 0px;">
                            <div class="layui-row layui-col-space60">
                                <div class="layui-form-item">
                                <?php
                                    $numrows=$DB->count("SELECT count(*) from website_privacy WHERE active = '1'");
                                    $pagesize=6;
                                    $pages=intval($numrows/$pagesize);
                                    if ($numrows%$pagesize){
                                        $pages++;
                                    }
                                    if (isset($_GET['page'])){
                                        $page=intval($_GET['page']);
                                    }else{
                                        $page=1;
                                    }
                                    $offset=$pagesize*($page - 1);
                                    $rs=$DB->query("SELECT * FROM website_privacy where active = '1' order by id asc limit $offset,$pagesize");
                                    while($res = $DB->fetch($rs)){
                                        if(round((TIME - $res['time'])/3600/24) > 0){
                                            $time = '已过期：'.round((TIME - $res['time'])/3600/24).'天';
                                        }else{
                                            $time = '剩余：'.- round((TIME - $res['time'])/3600/24).'天';
                                        }
                                        if($res['number'] <= 0){
                                            $active = '已销毁';
                                        }else{
                                            $active = '可查看';
                                        }
                                        echo '
                                            <div class="layui-col-md6">
                                                <div class="project-list-item" style="margin:15px">
                                                    <a href="./'.$res['token'].'.html">
                                                        <div class="project-list-item-body">
                                                            <h2>'.mb_substr($res['text'],0,25).'...</h2>
                                                            <div class="project-list-item-text layui-text">'.$time.'</div>
                                                            <div class="project-list-item-desc">
                                                                <i class="layui-icon layui-icon-log"></i>&nbsp;<span>'.$res['number'].'</span>
                                                                <i class="layui-icon layui-icon-notice"></i><span>'.$active.'</span>
                                                                <i class="layui-icon layui-icon-date"></i><span>'.$res['date'].'</span>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        ';
                                    }
                                ?>
                            </div>
                        </div>
                        <?php
                            $first=1;
                            $prev=$page-1;
                            $next=$page+1;
                            $last=$pages;
                            echo'<center>';
                            echo'<div class="layui-btn-group">';
                            if ($page>1){
                                echo '<a href="?page='.$first.$link.$url.'" class="layui-btn layui-btn-sm layui-btn-normal">首页</a>';
                                echo '<a href="?page='.$prev.$link.$url.'" class="layui-btn layui-btn-sm layui-btn-normal">&laquo;</a>';
                            }else{
                                echo '<a class="layui-btn layui-btn-sm layui-btn-disabled">首页</a>';
                                echo '<a class="layui-btn layui-btn-sm layui-btn-disabled">&laquo;</a>';
                            }
                            for ($i=1;$i<$page;$i++)
                            echo '<a href="?page='.$i.$link.$url.'" class="layui-btn layui-btn-sm layui-btn-normal">'.$i .'</a>';
                            echo '<a href="" class="layui-btn layui-btn-sm layui-btn-disabled">'.$page.'</a>';
                            for ($i=$page+1;$i<=$pages;$i++)
                            echo '<a href="?page='.$i.$link.$url.'" class="layui-btn layui-btn-sm layui-btn-normal">'.$i .'</a>';
                            if ($page<$pages){
                                echo '<a href="?page='.$next.$link.$url.'" class="layui-btn layui-btn-sm layui-btn-normal">&raquo;</a>';
                                echo '<a href="?page='.$last.$link.$url.'" class="layui-btn layui-btn-sm layui-btn-normal">尾页</a>';
                            }else{
                                echo '<a class="layui-btn layui-btn-sm layui-btn-disabled">&raquo;</a>';
                                echo '<a class="layui-btn layui-btn-sm layui-btn-disabled">尾页</a>';
                            }
                            echo'</div>';
                            echo'</center>';
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="../../assets/Layui/layui.js"></script>
    <script type="text/javascript" src="../../assets/LightYear/js/jquery.min.js"></script>
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