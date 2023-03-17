<?php
// 引入核心文件
include("../../system/core/core.php");

$class = $_GET['class'];

$row_max = $DB->get_row("select * from website_book where class = '{$class}' order by id asc limit 1");

$page = $_GET['page']?$_GET['page']:$row_max['id'];

$row = $DB->get_row("select * from website_class_book where id = '{$class}'");
$rows = $DB->get_row("select * from website_book where id = '{$page}'");

$title = $row['name'];
if($conf['site_active']=='1'){
    sysmsg('<h2>网站维护已开启</h2><ul><li><font size="4">'.$conf['site_active_notice'].'</font></li>',true);
}elseif(!$class || !$row){
    sysmsg('<h2>系统错误</h2><ul><li><font size="4">文档不存在</font></li>',true);
}elseif($class && $page && $rows['class'] != $class){
    sysmsg('<h2>系统错误</h2><ul><li><font size="4">当前页面不属于'.$row['name'].'文档</font></li>',true);
}
if(!$_COOKIE['token_class']){
    setcookie("token_class", "防止多次记录");
    $DB->query("update website_class_book set number = number + 1 where id = '{$class}'");
}
$DB->query("update website_book set number = number + 1 where id = '{$page}'");
if($conf['rewrite_book']=='1'){
    $title_url = '/book/index.html';
}else{
    $title_url = '/page/book/index.php';
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
    <title><?php echo $title;?> - <?php echo $conf['site_title'];?></title>
    <link rel="icon" href="../../assets/System/icon/favicon.ico" type="image/ico">
    <meta name="keywords" content="<?php echo $conf['site_keywords'];?>">
    <meta name="description" content="<?php echo $conf['site_description'];?>">
    <link href="../../assets/LightYear/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../assets/LightYear/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="../../assets/LightYear/css/style.min.css" rel="stylesheet">
    <style>
        #logo a {
            font-size: 22px;
            line-height: 68px;
            white-space: nowrap;
            color: red;
        }
        [data-logobg*='color_'] #logo a {
            color: #fff;
            
        }
        @media (min-width: 1024px) {
            .lyear-layout-sidebar.lyear-aside-open #logo a {
                display: block;
                width: 45px;
                height: 68px;
                letter-spacing: 3px;
                margin: 0 auto;
                overflow: hidden;
                text-align: center;
            }
            .lyear-layout-sidebar-close .lyear-layout-sidebar:hover #logo a {
                width: 100%;
                margin: 0;
                letter-spacing: 0px;
            }
        }
    </style>
</head>
<body>
    <div class="lyear-layout-web">
        <div class="lyear-layout-container">
            <!--左侧导航-->
            <aside class="lyear-layout-sidebar">
                <!-- logo -->
                <div id="logo" class="sidebar-header">
                    <a href="<?php echo $title_url;?>"><?php echo $row['name'];?></a>
                </div>
                <div class="lyear-layout-sidebar-scroll"> 
                    <nav class="sidebar-main">
                        <?php
                            $rs=$DB->query("SELECT * FROM website_book where class = '{$class}' and status = 1 order by id asc");
                            while($res = $DB->fetch($rs)){
                                if($conf['rewrite_book']=='1'){
                                    $url = '/book/'.$class.'/'.$res['id'].'.html';
                                }else{
                                    $url = '/page/book/page.php?class='.$class.'&page='.$res['id'];
                                }
                                echo '
                                    <ul class="nav nav-drawer">
                                        <li class="nav-item">
                                            <a href="'.$url.'"><i class="mdi mdi-book-open-page-variant"></i>'.$res['name'].'</a> 
                                        </li>
                                    </ul>
                                ';
                            }
                        ?>
                    </nav>
                    <div class="sidebar-footer">
                        <p class="copyright">Copyright &copy; <a target="_blank" href=""> <?php echo $conf["site_copyright"] ?></a></p>
                    </div>
                </div>
            </aside>
            <!--End 左侧导航-->
            <!--头部信息-->
            <header class="lyear-layout-header">
                <nav class="navbar navbar-default">
                    <div class="topbar">
                        <div class="topbar-left">
                            <div class="lyear-aside-toggler">
                                <span class="lyear-toggler-bar"></span>
                                <span class="lyear-toggler-bar"></span>
                                <span class="lyear-toggler-bar"></span>
                            </div>
                            <!--
                            <span class="navbar-page-title">
                                后台首页 
                            </span>
                            -->
                        </div>
                        <ul class="topbar-right">
                            <li class="dropdown dropdown-profile">
                                <span>知识文档库</span>
                            </li>
                            <!--切换主题配色-->
                            <li class="dropdown dropdown-skin">
                                <span data-toggle="dropdown" class="icon-palette">
                                    <i class="mdi mdi-palette"></i>
                                </span>
                                <ul class="dropdown-menu dropdown-menu-right" data-stopPropagation="true">
                                    <li class="drop-title">
                                        <p>主题</p>
                                    </li>
                                    <li class="drop-skin-li clearfix">
                                        <span class="inverse">
                                            <input type="radio" name="site_theme" value="default" id="site_theme_1" checked>
                                            <label for="site_theme_1"></label>
                                        </span>
                                        <span>
                                            <input type="radio" name="site_theme" value="dark" id="site_theme_2">
                                            <label for="site_theme_2"></label>
                                        </span>
                                        <span>
                                            <input type="radio" name="site_theme" value="translucent" id="site_theme_3">
                                            <label for="site_theme_3"></label>
                                        </span>
                                    </li>
                                    <li class="drop-title">
                                        <p>LOGO</p>
                                    </li>
                                    <li class="drop-skin-li clearfix">
                                        <span class="inverse">
                                            <input type="radio" name="logo_bg" value="default" id="logo_bg_1" checked>
                                            <label for="logo_bg_1"></label>
                                        </span>
                                        <span>
                                            <input type="radio" name="logo_bg" value="color_2" id="logo_bg_2">
                                            <label for="logo_bg_2"></label>
                                        </span>
                                        <span>
                                            <input type="radio" name="logo_bg" value="color_3" id="logo_bg_3">
                                            <label for="logo_bg_3"></label>
                                        </span>
                                        <span>
                                            <input type="radio" name="logo_bg" value="color_4" id="logo_bg_4">
                                            <label for="logo_bg_4"></label>
                                        </span>
                                        <span>
                                            <input type="radio" name="logo_bg" value="color_5" id="logo_bg_5">
                                            <label for="logo_bg_5"></label>
                                        </span>
                                        <span>
                                            <input type="radio" name="logo_bg" value="color_6" id="logo_bg_6">
                                            <label for="logo_bg_6"></label>
                                        </span>
                                        <span>
                                            <input type="radio" name="logo_bg" value="color_7" id="logo_bg_7">
                                            <label for="logo_bg_7"></label>
                                        </span>
                                        <span>
                                            <input type="radio" name="logo_bg" value="color_8" id="logo_bg_8">
                                            <label for="logo_bg_8"></label>
                                        </span>
                                    </li>
                                    <li class="drop-title">
                                        <p>头部</p>
                                    </li>
                                    <li class="drop-skin-li clearfix">
                                        <span class="inverse">
                                            <input type="radio" name="header_bg" value="default" id="header_bg_1" checked>
                                            <label for="header_bg_1"></label>
                                        </span>
                                        <span>
                                            <input type="radio" name="header_bg" value="color_2" id="header_bg_2">
                                            <label for="header_bg_2"></label>
                                        </span>
                                        <span>
                                            <input type="radio" name="header_bg" value="color_3" id="header_bg_3">
                                            <label for="header_bg_3"></label>
                                        </span>
                                        <span>
                                            <input type="radio" name="header_bg" value="color_4" id="header_bg_4">
                                            <label for="header_bg_4"></label>
                                        </span>
                                        <span>
                                            <input type="radio" name="header_bg" value="color_5" id="header_bg_5">
                                            <label for="header_bg_5"></label>
                                        </span>
                                        <span>
                                            <input type="radio" name="header_bg" value="color_6" id="header_bg_6">
                                            <label for="header_bg_6"></label>
                                        </span>
                                        <span>
                                            <input type="radio" name="header_bg" value="color_7" id="header_bg_7">
                                            <label for="header_bg_7"></label>
                                        </span>
                                        <span>
                                            <input type="radio" name="header_bg" value="color_8" id="header_bg_8">
                                            <label for="header_bg_8"></label>
                                        </span>
                                    </li>
                                    <li class="drop-title">
                                        <p>侧边栏</p>
                                    </li>
                                    <li class="drop-skin-li clearfix">
                                        <span class="inverse">
                                            <input type="radio" name="sidebar_bg" value="default" id="sidebar_bg_1" checked>
                                            <label for="sidebar_bg_1"></label>
                                        </span>
                                        <span>
                                            <input type="radio" name="sidebar_bg" value="color_2" id="sidebar_bg_2">
                                            <label for="sidebar_bg_2"></label>
                                        </span>
                                        <span>
                                            <input type="radio" name="sidebar_bg" value="color_3" id="sidebar_bg_3">
                                            <label for="sidebar_bg_3"></label>
                                        </span>
                                        <span>
                                            <input type="radio" name="sidebar_bg" value="color_4" id="sidebar_bg_4">
                                            <label for="sidebar_bg_4"></label>
                                        </span>
                                        <span>
                                            <input type="radio" name="sidebar_bg" value="color_5" id="sidebar_bg_5">
                                            <label for="sidebar_bg_5"></label>
                                        </span>
                                        <span>
                                            <input type="radio" name="sidebar_bg" value="color_6" id="sidebar_bg_6">
                                            <label for="sidebar_bg_6"></label>
                                        </span>
                                        <span>
                                            <input type="radio" name="sidebar_bg" value="color_7" id="sidebar_bg_7">
                                            <label for="sidebar_bg_7"></label>
                                        </span>
                                        <span>
                                            <input type="radio" name="sidebar_bg" value="color_8" id="sidebar_bg_8">
                                            <label for="sidebar_bg_8"></label>
                                        </span>
                                    </li>
                                </ul>
                            </li>
                            <!--切换主题配色-->
                        </ul>
                    </div>
                </nav>
            </header>
            <!--End 头部信息-->
            <!--页面主要内容-->
            <main class="lyear-layout-content">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-body">
                            <div id="Text" style="word-break:break-all;"></div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</div>
<script type="text/javascript" src="../../assets/LightYear/js/jquery.min.js"></script>
<script type="text/javascript" src="../../assets/LightYear/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../../assets/LightYear/js/perfect-scrollbar.min.js"></script>
<script type="text/javascript" src="../../assets/LightYear/js/main.min.js"></script>
<script type="text/javascript" src="../../assets/LightYear/js/jquery.cookie.min.js"></script>
<script src="../../assets/Layer/layer.js"></script>
<script>
window.onload = function (){
    var ii = layer.load(0, {
        shade:[0.1,'#fff'],
        time : 500
    });
    var id = GetUrlParam("class");
    var page = GetUrlParam("page");
    $.ajax({
        type : "POST",
        data : {
            id:id,
            page:page
        },
        url : "/page/book/ajax.php?act=get_text",
        dataType : 'json',
        success : function(data) {
            document.getElementById("Text").innerHTML = data.text?data.text:data.msg;
        },
        error:function(data){
	       layer.msg('服务器错误！');
	       return false;
	   }
	});
};
function GetUrlParam(paraName) {
    var url = document.location.toString();
    var arr1_1 = url.split("?");
    if(arr1_1[1]){
        var arr1_2 = arr1_1[1].split("&");
        for(var i = 0; i < arr1_2.length; i++){
            arr1_3 = arr1_2[i].split("=");
            if (arr1_3 != null && arr1_3[0] == paraName) {
                return arr1_3[1];
            }
        }
    }else{
        var arr2_1 = url.split("/");
        if(arr2_1.length == 5){
            var arr2_2 = arr2_1[4].split(".");
            if(paraName == 'class'){
                return arr2_2[0];
            }
        }else{
            if(paraName == 'class'){
                return arr2_1[4];
            }else if(paraName == 'page'){
                var arr2_3 = arr2_1[5].split(".");
                return arr2_3[0];
            }
        }
    }
}
</script>

</body>
</html>