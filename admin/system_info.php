<?php
/*
* @Time    : 2022/05/22 20:57
* @Author  : 爱唯逸网络科技
* @Mail    : support@857xx.cn
* @Site    : https://web.857xx.cn
* @File    : auth_name.php
* @Action  : 程序昵称配置
*/

include("../system/core/core.php");
$title='系统信息';
$mysql_version = $DB->get_row("select VERSION() as version");
include './page_head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login_index.php';</script>");
?>

<!--页面主要内容-->
<main class="lyear-layout-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>系统信息</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <b>系统版本：</b>
                                <?php echo VER ?>
                            </li>
                            <li class="list-group-item">
                                <b>数据库版本：</b>
                                <?php echo DB_VER ?>
                            </li>
                            <li class="list-group-item">
                                <b>系统版本号：</b>
                                <?php echo VERSION ?>
                            </li>
                            <li class="list-group-item">
                                <b>数据库版本号：</b>
                                <?php echo DB_VERSION ?>
                            </li>
                            <li class="list-group-item">
                                <b>网站端口号信息：</b>
                                <?php echo $_SERVER['SERVER_PORT'];?>
                            </li>
                            <li class="list-group-item">
                                <b>网站域名：</b>
                                <?php echo $_SERVER['HTTP_HOST'];?>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>服务器信息</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <b>服务器IP：</b>
                                <?php echo getServerIp();?>
                            </li>
                            <li class="list-group-item">
                                <b>系统信息：</b>
                                <?php echo php_uname(); ?>
                            </li>
                            <li class="list-group-item">
                                <b>MySQL：</b>
                                <?php echo $mysql_version['version'];?>
                            </li>
                            <li class="list-group-item">
                                <b>PHP版本：</b>
                                <?php echo phpversion() ?>
                                <?php if(ini_get('safe_mode')) { echo '线程安全'; } else { echo '非线程安全'; } ?>
                            </li>
                            <li class="list-group-item">
                                <b>服务器软件：</b>
                                <?php echo $_SERVER['SERVER_SOFTWARE'] ?>
                            </li>
                            <li class="list-group-item">
                                <b>程序最大运行时间：</b>
                                <?php echo ini_get('max_execution_time') ?>s
                            </li>
                            <li class="list-group-item">
                                <b>POST许可：</b><?php echo ini_get('post_max_size'); ?>
                            </li>
                            <li class="list-group-item">
                                <b>文件上传许可：</b>
                                <?PHP echo get_cfg_var ("upload_max_filesize")?get_cfg_var ("upload_max_filesize"):"不允许上传"; ?>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script type="text/javascript" src="../assets/LightYear/js/jquery.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/perfect-scrollbar.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/main.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/jquery.cookie.min.js"></script>

<script src="../assets/Layer/layer.js"></script>

</body>
</html>