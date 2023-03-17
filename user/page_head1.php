<?php
/*
* @Time    : 2022/05/22 20:57
* @Author  : 爱唯逸网络科技
* @Mail    : support@857xx.cn
* @Site    : https://web.857xx.cn
* @File    : page_head.php
* @Action  : 用户后台页面全局头部
*/
if(!defined('IN_CRONLITE'))exit();
@header('Content-Type: text/html; charset=UTF-8');
?>
<!DOCTYPE html>
<html lang="zh">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
        <title><?php echo $title;?> - <?php echo $conf['site_title'];?></title>
        <link rel="icon" href="../assets/System/icon/favicon.ico" type="image/ico">
        <meta name="keywords" content="<?php echo $conf['site_keywords'];?>">
        <meta name="description" content="<?php echo $conf['site_description'];?>">
        <link href="../assets/LightYear/css/bootstrap.min.css" rel="stylesheet">
        <link href="../assets/LightYear/css/materialdesignicons.min.css" rel="stylesheet">
        <link href="../assets/LightYear/css/style.min.css" rel="stylesheet">
    </head>
    <body>
        <div class="lyear-layout-web">
            <div class="lyear-layout-container">
                <!--左侧导航-->
                <aside class="lyear-layout-sidebar">
                    <!-- logo -->
                    <div id="logo" class="sidebar-header">
                        <a href="index.php"><img src="../assets/System/img/logo.png" title="<?php echo $conf['site_title']?>" alt="LightYear" /></a>
                    </div>
                    <div class="lyear-layout-sidebar-scroll">
                        <nav class="sidebar-main">
                            <ul class="nav nav-drawer">
                                <li class="<?php echo checkIfActive("auth_uplog") ?>">
                                    <a href="auth_uplog.php"><i class="mdi mdi-spin mdi-linux"></i>更新日志</a>
                                </li>
                            </ul>
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
                                <span class="navbar-page-title">导航</span>
                            </div>
                            <ul class="topbar-right">
                                <li class="dropdown dropdown-profile">
                                    <a href="javascript:void(0)" data-toggle="dropdown">
                                        <span>
                                            <?php echo $conf['site_title']; ?>
                                            <span class="caret"></span>
                                        </span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li> <a href="./login_index.php"><i class="mdi mdi-lock-outline"></i>登录</a> </li>
                                        <li> <a href="./login_reg.php"><i class="mdi mdi-lock-outline"></i>注册</a> </li>
                                    </ul>
                                </li>
                                <!--切换主题配色-->
                                <li class="dropdown dropdown-skin">
                                    <span data-toggle="dropdown" class="icon-palette"><i class="mdi mdi-palette"></i></span>
                                    <ul class="dropdown-menu dropdown-menu-right" data-stopPropagation="true">
                                        <li class="drop-title"><p>主题</p></li>
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
                                        <li class="drop-title"><p>LOGO</p></li>
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
                                        <li class="drop-title"><p>头部</p></li>
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
                                        <li class="drop-title"><p>侧边栏</p></li>
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