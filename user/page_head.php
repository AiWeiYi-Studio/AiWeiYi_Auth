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
        <link href="../assets/LightYear/css/animate.css" rel="stylesheet">
        <link href="../assets/LightYear/css/style.min.css" rel="stylesheet">
        <!--颜色选择插件-->
        <link rel="stylesheet" href="../assets/LightYear/js/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
        <!--时间选择插件-->
        <link rel="stylesheet" href="../assets/LightYear/js/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css">
        </head>
        <body>
            <?php if($islogins==1){?>
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
                                <li class="nav-item <?php echo checkIfActive("index") ?>">
                                    <a href="index.php"><i class="mdi mdi-spin mdi-home"></i> 后台首页</a> 
                                </li>
                                <li class="nav-item nav-item-has-subnav">
                                    <?php if(checkIfActive('api_bing,api_qrcode,api_mail,api_photo')){?>
                                        <li class="nav-item nav-item-has-subnav active open">
                                    <?php }?>
                                    <a href="javascript:void(0)"><i class="mdi mdi-spin mdi-cloud-braces"></i>API列表</a>
                                    <ul class="nav nav-subnav">
                                        <?php if($conf['api_bing_active']=='1'){?>
                                            <li class="<?php echo checkIfActive("api_bing") ?>">
                                                <a href="./api_bing.php">必应每日一图</a>
                                            </li>
                                        <?php }?>
                                        <?php if($conf['api_qrcode_active']=='1'){?>
                                            <li class="<?php echo checkIfActive("api_qrcode") ?>">
                                                <a href="./api_qrcode.php">二维码生成</a>
                                            </li>
                                        <?php }?>
                                        <?php if($conf['api_mail_active']=='1'){?>
                                            <li class="<?php echo checkIfActive("api_mail") ?>">
                                                <a href="./api_mail.php">邮件发件接口</a>
                                            </li>
                                        <?php }?>
                                        <?php if($conf['api_photo_active']=='1'){?>
                                        <li class="<?php echo checkIfActive("api_photo") ?>">
                                            <a href="./api_photo.php">随机图片接口</a>
                                        </li>
                                        <?php }?>
                                    </ul>
                                </li>
                                <li class="nav-item nav-item-has-subnav">
                                    <?php if(checkIfActive('shop_auth,auth_list,auth_info,auth_uplog')){?>
                                        <li class="nav-item nav-item-has-subnav active open">
                                    <?php }?>
                                    <a href="javascript:void(0)"><i class="mdi mdi-spin mdi-linux"></i>授权管理</a>
                                    <ul class="nav nav-subnav">
                                        <li class="<?php echo checkIfActive("shop_auth") ?>">
                                            <a href="./shop_auth.php">授权商城</a>
                                        </li>
                                        <li class="<?php echo checkIfActive("auth_list") ?>">
                                            <a href="auth_list.php">授权列表</a>
                                        </li>
                                        <li class="<?php echo checkIfActive("auth_info") ?>">
                                            <a href="auth_info.php">授权详情</a>
                                        </li>
                                        <li class="<?php echo checkIfActive("auth_uplog") ?>">
                                            <a href="auth_uplog.php">更新日志</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item nav-item-has-subnav">
                                    <?php if(checkIfActive('my_money_log,my_pay,my_money')){?>
                                        <li class="nav-item nav-item-has-subnav active open">
                                    <?php }?>
                                    <a href="javascript:void(0)"><i class="mdi mdi-spin mdi-wallet"></i>钱包功能</a>
                                    <ul class="nav nav-subnav">
                                        <li class="<?php echo checkIfActive("my_money_log") ?>">
                                            <a href="./my_money_log.php">资金明细</a>
                                        </li>
                                        <li class="<?php echo checkIfActive("my_pay") ?>">
                                            <a href="./my_pay.php">订单明细</a>
                                        </li>
                                        <li class="<?php echo checkIfActive("my_money") ?>">
                                            <a href="./my_money.php">钱包余额</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item nav-item-has-subnav">
                                    <?php if(checkIfActive('my_log,my_token,my_account,my_oauth,my_avatar,my_mail,my_phone,my_info,my_edit,my_notice')){?>
                                        <li class="nav-item nav-item-has-subnav active open">
                                    <?php }?>
                                    <a href="javascript:void(0)"><i class="mdi mdi-spin mdi-account-card-details"></i>个人信息</a>
                                    <ul class="nav nav-subnav">
                                        <li class="<?php echo checkIfActive("my_log") ?>">
                                            <a href="./my_log.php">操作日志</a>
                                        </li>
                                        <li class="<?php echo checkIfActive("my_notice") ?>">
                                            <a href="./my_notice.php">通知功能</a>
                                        </li>
                                        <li class="<?php echo checkIfActive("my_token") ?>">
                                            <a href="./my_token.php">专属密钥</a>
                                        </li>
                                        <li class="<?php echo checkIfActive("my_account") ?>">
                                            <a href="./my_account.php">账户安全</a>
                                        </li>
                                        <li class="<?php echo checkIfActive("my_oauth") ?>">
                                            <a href="./my_oauth.php">快捷登陆</a>
                                        </li>
                                        <li class="<?php echo checkIfActive("my_edit") ?>">
                                            <a href="./my_edit.php">资料编辑</a>
                                        </li>
                                        <li class="<?php echo checkIfActive("my_avatar") ?>">
                                            <a href="./my_avatar.php">头像信息</a>
                                        </li>
                                        <li class="<?php echo checkIfActive("my_mail") ?>">
                                            <a href="./my_mail.php">邮箱信息</a>
                                        </li>
                                        <li class="<?php echo checkIfActive("my_phone") ?>">
                                            <a href="./my_phone.php">电话信息</a>
                                        </li>
                                        <li class="<?php echo checkIfActive("my_info") ?>">
                                            <a href="./my_info.php">个人资料</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item nav-item-has-subnav">
                                    <?php if(checkIfActive('page_chat,shop_other')){?>
                                        <li class="nav-item nav-item-has-subnav active open">
                                    <?php }?>
                                    <a href="javascript:void(0)"><i class="mdi mdi-spin mdi-cube-send"></i>其他菜单</a>
                                    <ul class="nav nav-subnav">
                                        <li class="<?php echo checkIfActive("page_chat") ?>">
                                            <a href="./page_chat.php">聊天系统</a>
                                        </li>
                                        <li class="<?php echo checkIfActive("shop_other") ?>">
                                            <a href="./shop_other.php">杂物商城</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item nav-item-has-subnav">
                                    <?php if(checkIfActive('privacy_add,privacy_list')){?>
                                        <li class="nav-item nav-item-has-subnav active open">
                                    <?php }?>
                                    <a href="javascript:void(0)"><i class="mdi mdi-spin mdi-contact-mail"></i>悄悄话</a>
                                    <ul class="nav nav-subnav">
                                        <li class="<?php echo checkIfActive("privacy_add") ?>">
                                            <a href="./privacy_add.php">发布悄悄话</a>
                                        </li>
                                        <li class="<?php echo checkIfActive("privacy_list") ?>">
                                            <a href="./privacy_list.php">悄悄话列表</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item nav-item-has-subnav">
                                    <?php if(checkIfActive('workorder_add,workorder_list,workorder_reply')){?>
                                        <li class="nav-item nav-item-has-subnav active open">
                                    <?php }?>
                                    <a href="javascript:void(0)"><i class="mdi mdi-spin mdi-linux"></i>工单管理</a>
                                    <ul class="nav nav-subnav">
                                        <li class="<?php echo checkIfActive("workorder_add") ?>">
                                            <a href="workorder_add.php">发起工单</a>
                                        </li>
                                        <li class="<?php echo checkIfActive("workorder_list") ?>">
                                            <a href="./workorder_list.php">工单列表</a>
                                        </li>
                                        <li class="<?php echo checkIfActive("workorder_reply") ?>">
                                            <a href="./workorder_reply.php">工单详情</a>
                                        </li>
                                    </ul>
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
                                <span class="navbar-page-title">后台首页</span>
                            </div>
                            <ul class="topbar-right">
                                <li class="dropdown dropdown-profile">
                                    <a href="javascript:void(0)" data-toggle="dropdown">
                                        <span>
                                            <?php echo $udata['name']; ?>
                                            <span class="caret"></span>
                                        </span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li> <a href="my_info.php"><i class="mdi mdi-lock-outline"></i>个人资料</a> </li>
                                        <li> <a href="my_account.php"><i class="mdi mdi-lock-outline"></i>账号密码</a> </li>
                                        <li> <a href="javascript:huancun()"><i class="mdi mdi-delete"></i> 清空缓存</a></li>
                                        <li class="divider"></li>
                                        <li> <a href="javascript:logout()"><i class="mdi mdi-logout-variant"></i> 退出登录</a> </li>
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
                <script>
                    function logout(){
                        layer.confirm('确定退出？',{btn:['确定','取消'],closeBtn:0,icon:3},function(){
                            var ii = layer.load(0, {shade:[0.1,'#fff']});
                            $.ajax({
                                type : "POST",
                                url : "ajax_login.php?act=logout",
                                dataType : 'json',
                                success : function(data) {
                                    layer.close(ii);
                                    layer.msg(data.msg)
                                    if(data.code == 1){
                                        window.location.href="login_index.php"; 
                                    }
                                },
                                error:function(data){
                                    layer.close(ii);
                                    layer.msg('服务器错误！');
                                    return false;
                                }
                            });
                        });
                    };
                    function huancun(){
                        var ii = layer.load(0, {shade:[0.1,'#fff']});
                        $.ajax({
                            type : "POST",
                            url : "ajax_system.php?act=huancun",
                            dataType : 'json',
                            success : function(data) {
                                layer.close(ii);
                                layer.msg(data.msg)
                            },
                            error:function(data){
                                layer.close(ii);
                                layer.msg('服务器错误！');
                                return false;
                            }
                        });
                    };
                </script>
            <?php }?>