<?php
include("../system/core/core.php");
$title='后台主页';
include './page_head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login_index.php';</script>");
?>
<!--页面主要内容-->
<main class="lyear-layout-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading font-bold text-center" style="background: linear-gradient(to right,#23b7e5,#04d2bf);">
                        <b>用户信息</b>
                    </div>
                    <div class="panel-body">
                        <li style="font-weight:bold" class="list-group-item">
                            当前用户：<font color="blue"><?php echo $udata['name'];?>&nbsp;（UID：<?php echo $udata['uid'];?>）</font>
                        </li>
                        <li style="font-weight:bold" class="list-group-item">
                            域名统计：<font color="orange">已授权：1</font>
                        </li>
                        <li style="font-weight:bold" class="list-group-item">
                            当前时间：<?php echo $date;?>
                        </li>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading font-bold text-center" style="background: linear-gradient(to right,#16aad8,#f6a5fb);">
                        <b>公告通知</b>
                    </div>
                    <div class="panel-body">
                        <div class="list-group-item">
                            <font color="red"><?php echo getServerIp();?></font>
                        </div>
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