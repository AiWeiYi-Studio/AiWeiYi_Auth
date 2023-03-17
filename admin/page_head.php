<?php
/*
* @Time    : 2022/05/22 20:57
* @Author  : 爱唯逸网络科技
* @Mail    : support@857xx.cn
* @Site    : https://web.857xx.cn
* @File    : page_head.php
* @Action  : 站长后台页面全局头部
*/

if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login_index.php';</script>");
?>
<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
        <title><?php echo $title;?> - <?php echo $conf['site_title'];?></title>
        <link rel="icon" href="../assets/System/icon/favicon.ico" type="image/ico">
        <meta name="keywords" content="<?php echo $conf['site_keywords'];?>">
        <meta name="description" content="<?php echo $conf['site_description'];?>">
        <meta name="author" content="yinqi">
        <link href="../assets/LightYear/css/bootstrap.min.css" rel="stylesheet">
        <link href="../assets/LightYear/css/materialdesignicons.min.css" rel="stylesheet">
        <link href="../assets/LightYear/css/style.min.css" rel="stylesheet">
        <!--时间选择插件-->
        <link rel="stylesheet" href="../assets/LightYear/js/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css">
        </head>
        <body>
            <div class="lyear-layout-web">
                <div class="lyear-layout-container">
                    <!--左侧导航-->
                    <aside class="lyear-layout-sidebar">
                        <!-- logo -->
                        <div id="logo" class="sidebar-header">
                            <a href="index.php">
                                <img src="../assets/System/img/logo.png" title="<?php echo $conf['site_title']?>" alt="LightYear" />
                            </a>
                        </div>
                        <div class="lyear-layout-sidebar-scroll"> 
                            <nav class="sidebar-main">
                                <ul class="nav nav-drawer">
                                    <li class="nav-item <?php echo checkIfActive("index") ?>">
                                        <a href="index.php"><i class="mdi mdi-spin mdi-home"></i> 后台首页</a> 
                                    </li>
                                    <li class="nav-item nav-item-has-subnav">
                                        <?php if(checkIfActive('set_site,set_notice,set_mail,set_message,set_cron,set_pay,add,list,indexs,login,reg,set_oauth,system_clean,system_plugin,system_info,system_php,view_file,system_visit')){?>
                                            <li class="nav-item nav-item-has-subnav active open">
                                        <?php }?>
                                        <a href="javascript:void(0)"><i class="mdi mdi-spin mdi-settings"></i>系统配置</a>
                                        <ul class="nav nav-subnav">
                                            <li class="nav-item nav-item-has-subnav">
                                                <?php if(checkIfActive('set_site,set_notice,set_mail,set_message,set_cron,set_pay,set_oauth')){?>
                                                    <li class="nav-item nav-item-has-subnav active open">
                                                <?php }?>
                                                <a href="javascript:void(0)">信息配置</a>
                                                <ul class="nav nav-subnav">
                                                    <li class="<?php echo checkIfActive("set_site") ?>">
                                                        <a href="./set_site.php">网站配置</a>
                                                    </li>
                                                    <li class="<?php echo checkIfActive("set_notice") ?>">
                                                        <a href="./set_notice.php">公告配置</a>
                                                    </li>
                                                    <li class="<?php echo checkIfActive("set_mail") ?>">
                                                        <a href="./set_mail.php">邮件配置</a>
                                                    </li>
                                                    <li class="<?php echo checkIfActive("set_message") ?>">
                                                        <a href="./set_message.php">短信配置</a>
                                                    </li>
                                                    <li class="<?php echo checkIfActive("set_cron") ?>">
                                                        <a href="./set_cron.php">监控配置</a>
                                                    </li>
                                                    <li class="<?php echo checkIfActive("set_pay") ?>">
                                                        <a href="./set_pay.php">支付配置</a>
                                                    </li>
                                                    <li class="<?php echo checkIfActive("set_oauth") ?>">
                                                        <a href="./set_oauth.php">快捷登录</a>
                                                    <li>
                                                </ul>
                                            </li>
                                            <li class="nav-item nav-item-has-subnav">
                                                <?php if(checkIfActive('add,list,indexs,login,reg')){?>
                                                    <li class="nav-item nav-item-has-subnav active open">
                                                <?php }?>
                                                <a href="javascript:void(0)">模板配置</a>
                                                <ul class="nav nav-subnav">
                                                    <li class="<?php echo checkIfActive("add") ?>">
                                                        <a href="./set_template.php?mod=add">添加模板</a>
                                                    </li>
                                                    <li class="<?php echo checkIfActive("list") ?>">
                                                        <a href="./set_template.php?mod=list">模板列表</a>
                                                    </li>
                                                    <li class="<?php echo checkIfActive("indexs") ?>">
                                                        <a href="./set_template.php?mod=indexs">首页模板</a>
                                                    </li>
                                                    <li class="<?php echo checkIfActive("login") ?>">
                                                        <a href="./set_template.php?mod=login">登录模板</a>
                                                    </li>
                                                    <li class="<?php echo checkIfActive("reg") ?>">
                                                        <a href="./set_template.php?mod=reg">注册模板</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="nav-item nav-item-has-subnav">
                                                <?php if(checkIfActive('system_clean,system_plugin,system_info,system_php,view_file,system_visit')){?>
                                                    <li class="nav-item nav-item-has-subnav active open">
                                                <?php }?>
                                                <a href="javascript:void(0)">系统核心</a>
                                                <ul class="nav nav-subnav">
                                                    <li class="<?php echo checkIfActive("system_clean") ?>">
                                                        <a href="./system_clean.php">系统清理</a>
                                                    </li>
                                                    <li class="<?php echo checkIfActive("system_plugin") ?>">
                                                        <a href="./system_plugin.php">系统插件</a>
                                                    </li>
                                                    <li class="<?php echo checkIfActive("system_info") ?>">
                                                        <a href="./system_info.php">系统信息</a>
                                                    </li>
                                                    <li class="<?php echo checkIfActive("system_php") ?>">
                                                        <a href="./system_php.php">PHP信息</a>
                                                    </li>
                                                    <li class="<?php echo checkIfActive("view_file") ?>">
                                                        <a href="./view_file.php">文件管理</a>
                                                    </li>
                                                    <li class="<?php echo checkIfActive("system_visit") ?>">
                                                        <a href="./system_visit.php">访问日志</a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="nav-item nav-item-has-subnav">
                                        <?php if(checkIfActive('book_class_add,book_edit,book_class,book_add,book_list,book_set,article_add,article_list,article_edit,article_set,program_add,program_list,program_edit,program_set,privacy_add,privacy_list,workorder_add,workorder_list,workorder_reply,workorder_class,workorder_edit')){?>
                                            <li class="nav-item nav-item-has-subnav active open">
                                        <?php }?>
                                        <a href="javascript:void(0)"><i class="mdi mdi-spin mdi-webhook"></i>站务管理</a>
                                        <ul class="nav nav-subnav">
                                            <li class="nav-item nav-item-has-subnav">
                                                <?php if(checkIfActive('book_class_add,book_edit,book_class,book_add,book_list,book_set')){?>
                                                    <li class="nav-item nav-item-has-subnav active open">
                                                <?php }?>
                                                <a href="javascript:void(0)">知识文档</a>
                                                <ul class="nav nav-subnav">
                                                    <li class="<?php echo checkIfActive("book_class") ?>">
                                                        <a href="./book_class.php">分类列表</a>
                                                    </li>
                                                    <li class="<?php echo checkIfActive("book_class_add") ?>">
                                                        <a href="./book_class_add.php">分类添加</a>
                                                    </li>
                                                    <li class="<?php echo checkIfActive("book_add") ?>">
                                                        <a href="./book_add.php">文档添加</a>
                                                    </li>
                                                    <li class="<?php echo checkIfActive("book_edit") ?>">
                                                        <a href="./book_edit.php">文档修改</a>
                                                    </li>
                                                    <li class="<?php echo checkIfActive("book_list") ?>">
                                                        <a href="./book_list.php">文档列表</a>
                                                    </li>
                                                    <li class="<?php echo checkIfActive("book_set") ?>">
                                                        <a href="./book_set.php">相关设置</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="nav-item nav-item-has-subnav">
                                                <?php if(checkIfActive('workorder_add,workorder_edit,workorder_list,workorder_reply,workorder_class')){?>
                                                    <li class="nav-item nav-item-has-subnav active open">
                                                <?php }?>
                                                <a href="javascript:void(0)">工单管理</a>
                                                <ul class="nav nav-subnav">
                                                    <li class="<?php echo checkIfActive("workorder_add") ?>">
                                                        <a href="workorder_add.php">分类添加</a>
                                                    </li>
                                                    <li class="<?php echo checkIfActive("workorder_edit") ?>">
                                                        <a href="./workorder_edit.php">分类修改</a>
                                                    </li>
                                                    <li class="<?php echo checkIfActive("workorder_list") ?>">
                                                        <a href="./workorder_list.php">工单列表</a>
                                                    </li>
                                                    <li class="<?php echo checkIfActive("workorder_reply") ?>">
                                                        <a href="./workorder_reply.php">工单详情</a>
                                                    </li>
                                                    <li class="<?php echo checkIfActive("workorder_class") ?>">
                                                        <a href="./workorder_class.php">分类列表</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="nav-item nav-item-has-subnav">
                                                <?php if(checkIfActive('article_add,article_list,article_edit,article_set')){?>
                                                    <li class="nav-item nav-item-has-subnav active open">
                                                <?php }?>
                                                <a href="javascript:void(0)">资讯文章</a>
                                                <ul class="nav nav-subnav">
                                                    <li class="<?php echo checkIfActive("article_add") ?>">
                                                        <a href="./article_add.php">资讯文章添加</a>
                                                    </li>
                                                    <li class="<?php echo checkIfActive("article_list") ?>">
                                                        <a href="./article_list.php">资讯文章列表</a>
                                                    </li>
                                                    <li class="<?php echo checkIfActive("article_edit") ?>">
                                                        <a href="./article_edit.php">资讯文章修改</a>
                                                    </li>
                                                    <li class="<?php echo checkIfActive("article_set") ?>">
                                                        <a href="./article_set.php">资讯文章配置</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="nav-item nav-item-has-subnav">
                                                <?php if(checkIfActive('program_add,program_list,program_edit,program_set')){?>
                                                    <li class="nav-item nav-item-has-subnav active open">
                                                <?php }?>
                                                <a href="javascript:void(0)">程序文章</a>
                                                <ul class="nav nav-subnav">
                                                    <li class="<?php echo checkIfActive("program_add") ?>">
                                                        <a href="./program_add.php">程序文章添加</a>
                                                    </li>
                                                    <li class="<?php echo checkIfActive("program_list") ?>">
                                                        <a href="./program_list.php">程序文章列表</a>
                                                    </li>
                                                    <li class="<?php echo checkIfActive("program_edit") ?>">
                                                        <a href="./program_edit.php">程序文章修改</a>
                                                    </li>
                                                    <li class="<?php echo checkIfActive("program_set") ?>">
                                                        <a href="./program_set.php">程序文章配置</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="nav-item nav-item-has-subnav">
                                                <?php if(checkIfActive('privacy_add,privacy_list')){?>
                                                    <li class="nav-item nav-item-has-subnav active open">
                                                <?php }?>
                                                <a href="javascript:void(0)">悄悄话</a>
                                                <ul class="nav nav-subnav">
                                                    <li class="<?php echo checkIfActive("privacy_add") ?>">
                                                        <a href="./privacy_add.php">发布悄悄话</a>
                                                    </li>
                                                    <li class="<?php echo checkIfActive("privacy_list") ?>">
                                                        <a href="./privacy_list.php">悄悄话列表</a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="nav-item nav-item-has-subnav">
                                        <?php if(checkIfActive('auth_update,add_update,add_app,auth_app,auth_set,auth_info,add_auth,auth_legal,auth_pirate,auth_pirate_info')){?>
                                            <li class="nav-item nav-item-has-subnav active open">
                                        <?php }?>
                                        <a href="javascript:void(0)"><i class="mdi mdi-spin mdi-hexagon-multiple"></i>授权管理</a>
                                        <ul class="nav nav-subnav">
                                            <li class="nav-item nav-item-has-subnav">
                                                <?php if(checkIfActive('add_update,auth_update')){?>
                                                    <li class="nav-item nav-item-has-subnav active open">
                                                <?php }?>
                                                <a href="javascript:void(0)">更新配置</a>
                                                <ul class="nav nav-subnav">
                                                    <li class="<?php echo checkIfActive("add_update")?>">
                                                        <a href="./auth_add.php?mod=add_update">发布更新</a>
                                                    </li>
                                                    <li class="<?php echo checkIfActive("auth_update")?>">
                                                        <a href="./auth_update.php">更新列表</a>
                                                    </li>
                                                    <li>
                                                        <a href="./view_file.php?path=/file/auth/update/">文件管理</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="nav-item nav-item-has-subnav">
                                                <?php if(checkIfActive('add_app,auth_app,auth_set')){?>
                                                    <li class="nav-item nav-item-has-subnav active open">
                                                <?php }?>
                                                <a href="javascript:void(0)">程序配置</a>
                                                <ul class="nav nav-subnav">
                                                    <li class="<?php echo checkIfActive("add_app")?>">
                                                        <a href="./auth_add.php?mod=add_app">添加程序</a>
                                                    </li>
                                                    <li class="<?php echo checkIfActive("auth_app")?>">
                                                        <a href="./auth_app.php">程序列表</a>
                                                    </li>
                                                    <li class="<?php echo checkIfActive("auth_set")?>">
                                                        <a href="./auth_set.php">程序信息</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="nav-item nav-item-has-subnav">
                                                <?php if(checkIfActive('add_auth,auth_legal,auth_pirate,auth_info,auth_pirate_info')){?>
                                                    <li class="nav-item nav-item-has-subnav active open">
                                                <?php }?>
                                                <a href="javascript:void(0)">授权配置</a>
                                                <ul class="nav nav-subnav">
                                                    <li class="<?php echo checkIfActive("add_auth")?>">
                                                        <a href="./auth_add.php?mod=add_auth">添加授权</a>
                                                    </li>
                                                    <li class="<?php echo checkIfActive("auth_legal")?>">
                                                        <a href="./auth_legal.php">授权列表</a>
                                                    </li>
                                                    <li class="<?php echo checkIfActive("auth_pirate")?>">
                                                        <a href="./auth_pirate.php">盗版列表</a>
                                                    </li>
                                                    <li class="<?php echo checkIfActive("auth_info")?>">
                                                        <a href="./auth_info.php">授权详情</a>
                                                    </li>
                                                    <li class="<?php echo checkIfActive("auth_pirate_info")?>">
                                                        <a href="./auth_pirate_info.php">盗版详情</a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="nav-item nav-item-has-subnav">
                                        <?php if(checkIfActive('kami_money,bing,qrcode,mail,photo,chat_set,set_shop,user_log,chat_list,user_money_log,user_add,user_list,user_pay')){?>
                                            <li class="nav-item nav-item-has-subnav active open">
                                        <?php }?>
                                        <a href="javascript:void(0)"><i class="mdi mdi-spin mdi-account-settings-variant"></i>用户配置</a>
                                        <ul class="nav nav-subnav">
                                            <li class="nav-item nav-item-has-subnav">
                                                <?php if(checkIfActive('kami_money')){?>
                                                    <li class="nav-item nav-item-has-subnav active open">
                                                <?php }?>
                                                <a href="javascript:void(0)">卡密管理</a>
                                                <ul class="nav nav-subnav">
                                                    <li class="<?php echo checkIfActive("kami_money") ?>"><a href="./kami_money.php">充值卡密</a></li>
                                                </ul>
                                            </li>
                                            <li class="nav-item nav-item-has-subnav">
                                                <?php if(checkIfActive('bing,qrcode,mail,photo')){?>
                                                    <li class="nav-item nav-item-has-subnav active open">
                                                <?php }?>
                                                <a href="javascript:void(0)">API配置</a>
                                                <ul class="nav nav-subnav">
                                                    <li class="<?php echo checkIfActive("bing")?>"><a href="./set_api.php?mod=bing">必应每日一图</a></li>
                                                    <li class="<?php echo checkIfActive("qrcode")?>"><a href="./set_api.php?mod=qrcode">二维码生成</a></li>
                                                    <li class="<?php echo checkIfActive("mail")?>"><a href="./set_api.php?mod=mail">邮件发件接口</a></li>
                                                    <li class="<?php echo checkIfActive("photo")?>"><a href="./set_api.php?mod=photo">随机图片接口</a></li>
                                                </ul>
                                            </li>
                                            <li class="nav-item nav-item-has-subnav">
                                                <?php if(checkIfActive('chat_set,set_shop')){?>
                                                    <li class="nav-item nav-item-has-subnav active open">
                                                <?php }?>
                                                <a href="javascript:void(0)">相关配置</a>
                                                <ul class="nav nav-subnav">
                                                    <li class="<?php echo checkIfActive("chat_set")?>"><a href="./set_chat.php?mod=chat_set">聊天配置</a></li>
                                                    <li class="<?php echo checkIfActive("set_shop")?>"><a href="./set_shop.php">商城配置</a></li>
                                                </ul>
                                            </li>
                                            <li class="nav-item nav-item-has-subnav">
                                                <?php if(checkIfActive('user_log,chat_list,user_money_log,user_pay')){?>
                                                    <li class="nav-item nav-item-has-subnav active open">
                                                <?php }?>
                                                <a href="javascript:void(0)">日志记录</a>
                                                <ul class="nav nav-subnav">
                                                    <li class="<?php echo checkIfActive("user_log")?>">
                                                        <a href="./user_log.php">操作日志</a>
                                                    </li>
                                                    <li class="<?php echo checkIfActive("chat_list")?>">
                                                        <a href="./set_chat.php?mod=chat_list">聊天记录</a>
                                                    </li>
                                                    <li class="<?php echo checkIfActive("user_money_log")?>">
                                                        <a href="./user_money_log.php">资金明细</a>
                                                    </li>
                                                    <li class="<?php echo checkIfActive("user_pay")?>">
                                                        <a href="./user_pay.php">订单明细</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="nav-item nav-item-has-subnav">
                                                <?php if(checkIfActive('user_add,user_list')){?>
                                                    <li class="nav-item nav-item-has-subnav active open">
                                                <?php }?>
                                                <a href="javascript:void(0)">用户管理</a>
                                                <ul class="nav nav-subnav">
                                                    <li class="<?php echo checkIfActive("user_add")?>"><a href="./user_add.php">账户添加</a></li>
                                                    <li class="<?php echo checkIfActive("user_list")?>"><a href="./user_list.php">账户列表</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="nav-item nav-item-has-subnav">
                                        <?php if(checkIfActive('my_info,my_oauth,my_avatar')){?>
                                            <li class="nav-item nav-item-has-subnav active open">
                                        <?php }?>
                                        <a href="javascript:void(0)"><i class="mdi mdi-spin mdi-face-profile"></i>个人配置</a>
                                        <ul class="nav nav-subnav">
                                            <li class="<?php echo checkIfActive("my_info")?>"><a href="./my_info.php">我的个人信息</a></li>
                                            <li class="<?php echo checkIfActive("my_oauth")?>"><a href="./my_oauth.php">快捷登录信息</a><li>
                                            <li class="<?php echo checkIfActive("my_avatar")?>"><a href="./my_avatar.php">个人头像配置</a><li>
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
                                    <span class="navbar-page-title"> 后台首页 </span>
                                </div>
                                <ul class="topbar-right">
                                    <li class="dropdown dropdown-profile">
                                        <a href="javascript:void(0)" data-toggle="dropdown">
                                            <span><?php echo $udata['name']; ?> <span class="caret"></span></span>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li> <a href="my_info.php"><i class="mdi mdi-lock-outline"></i>个人资料</a> </li>
                                            <li> <a href="javascript:huancun()"><i class="mdi mdi-delete"></i> 清空缓存</a></li>
                                            <li class="divider"></li>
                                            <li><a href="javascript:logout()"><i class="mdi mdi-logout-variant"></i> 退出登录</a> </li>
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
                                                if(data.code==1){
                                                    setTimeout(function () {
                                                        location.href="./login_index.php";
                                                        }, 1000);
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