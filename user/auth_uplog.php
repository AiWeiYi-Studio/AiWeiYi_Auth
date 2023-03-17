<?php
/*
* @Time    : 2022/05/22 20:57
* @Author  : 爱唯逸网络科技
* @Mail    : support@857xx.cn
* @Site    : https://web.857xx.cn
* @File    : auth_uplog.php
* @Action  : 更新日志
*/

include("../system/core/core.php");
$title='更新日志';
$app = daddslashes($_GET['app']);
$row = $DB->get_row("select * from website_app where id = '".$app."' limit 1");
$a = array(PHP_EOL,' ');
$b = array('<br/>','&nbsp;');
if($islogins == 1){
    include './page_head.php';
    $number = $DB->count("SELECT count(*) from website_legal where user = '{$udata['uid']}' and active = '1'");
}else{
    include './page_head1.php';
    $number = '0';
}
?>
<link href="../assets/System/user/css/auth_uplog.css" rel="stylesheet">
<!--页面主要内容-->
<main class="lyear-layout-content">
    <div class="container-fluid">
        <?php if(!$app){?>
            <div class="row">
                <div class="col-xs-12 col-sm-10 col-md-8 col-lg-6 center-block" style="float: none;">
                    <div class="card">
                        <div class="card-header">
                            <h4>更新日志</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="text">请选择需要查看的程序</label>
                                <select id="app" class="form-control" onchange="location.href='./auth_uplog.php?app='+this.options[this.selectedIndex].value;"     default="<?php echo $app;?>">
                                    <option value="0">请选择程序</option>
                                    <?php
                                        $rs=$DB->query("SELECT * FROM website_app WHERE status = '1' order by id asc");
                                        while($res = $DB->fetch($rs)){
                                            echo '<option value="'.$res['id'].'">'.$res['name'].'</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php }else{?>
            <div class="row">
                <div class="col-xs-12 col-sm-10 col-md-8 col-lg-8 center-block" style="float: none;">
                    <div class="card">
                        <div class="card-header">
                            <h4>更新日志</h4>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <strong>通知：</strong><br/><?php echo str_replace($a,$b,$row['notice']?$row['notice']:'暂无');?>
                            </div>
                            <ul class="lyear-timeline m-b-0">
                                <?php
                                    $rs=$DB->query("SELECT * FROM website_update  where app = '".$app."' and status = '1' order by version desc");
                                    while($res = $DB->fetch($rs)){
                                        $row_app = $DB->get_row("select * from website_app where id = '".$res['app']."' limit 1");
                                        if($res['beta'] == 1){
                                            $beta = ['danger','内测','red'];
                                        }else{
                                            $beta = ['info','非内测','blue'];
                                        }
                                        if($islogins == 1 && $number >=1 && $res['download']){
                                            $html_1 = '<a class="btn btn-sm btn-round btn-brown" href="'.$res['download'].'" data-toggle="tooltip" data-placement="top" title="必须依次覆盖更新">更新包</a>';
                                        }else{
                                            $html_1 = null;
                                        }
                                        if($islogins == 1 && $number >=1){
                                            $html_2='<a class="btn btn-sm btn-round btn-purple" href="'.$row_app['download'].'" data-toggle="tooltip" data-placement="top" title="程序安装包">安装包</a>';
                                        }else{
                                            $html_2 = null;
                                        }
                                        $text = $res['text']?'<pre>'.$res['text'].'</pre>':null;
                                        echo '
                                            <li>
                                                <i class="mdi mdi-spin mdi-update bg-'.$beta[0].' text-white" ></i>
                                                <p class="mb-1" style="color:'.$beta[2].';font-weight: bold">
                                                    Edition：'.$res['edition'].' || Version：'.$res['version'].' || '.$beta[1].'
                                                </p>
                                                <p class="mb-0" style="color:gold;font-weight: bold">'.str_replace($a,$b,$res['log']).'</p>
                                                <p class="mb-3" style="color:blue;">'.$res['date'].'</p>
                                                '.$text.'
                                                <div class="example-box text-center">
                                                    '.$html_1.'
                                                    '.$html_2.'
                                                    <a class="btn btn-sm btn-round btn-cyan" href="./shop_auth.php?app='.$app.'">购买</a>
                                                </div>
                                            </li>
                                        ';
                                    }
                                ?>
                                <li>
                                    <i class="mdi mdi-spin mdi-update bg-yellow text-white" ></i>
                                    <p class="mb-1" style="color:red;font-weight: bold">未初始化版本</p>
                                    <p class="mb-0" style="color:gold;font-weight: bold">暂无新版本</p>
                                    <p class="mb-3" style="color:blue;"><?php echo $row['date'];?></p>
                                    <pre><?php echo $row['text'];?></pre>
                                    <div class="example-box text-center">
                                        <a class="btn btn-sm btn-round btn-purple" href="<?php echo $row['download'];?>" data-toggle="tooltip" data-placement="top" title="程序安装包">安装包</a>
                                        <a class="btn btn-sm btn-round btn-cyan" href="./shop_auth.php" data-toggle="tooltip" data-placement="top" title="购买">购买</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        <?php }?>
    </div>
</main>
<!--End 页面主要内容-->

<script type="text/javascript" src="../assets/LightYear/js/jquery.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/perfect-scrollbar.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/main.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/jquery.cookie.min.js"></script>

<script src="../assets/Layer/layer.js"></script>

</body>
</html>