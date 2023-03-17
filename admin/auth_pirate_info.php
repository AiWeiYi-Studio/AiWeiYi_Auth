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
$title='盗版信息';
include './page_head.php';
$id= daddslashes($_GET['id']);
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login_index.php';</script>");
$row = $DB->get_row("select * from website_pirate where id = '".$id."'");
$row_app = $DB->get_row("select * from website_app where id = '".$row['app']."'");
?>
<!--页面主要内容-->
<main class="lyear-layout-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>盗版信息</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-2 col-lg-2">
                                    <div class="form-group">
                                        <label for="uid">盗版程序</label>
                                        <input type="text" class="form-control" value="<?php echo $row_app['name'];?>" disabled="disabled" />
                                    </div>
                                </div>
                                <div class="col-sm-2 col-lg-2">
                                    <div class="form-group">
                                        <label for="uid">识别码</label>
                                        <input type="text" class="form-control" value="<?php echo $row['uuid'];?>" disabled="disabled" />
                                    </div>
                                </div>
                                <div class="col-sm-4 col-lg-4">
                                    <div class="form-group">
                                        <label for="uid">盗版码</label>
                                        <input type="text" class="form-control" value="<?php echo $row['authcode'];?>" disabled="disabled" />
                                    </div>
                                </div>
                                <div class="col-sm-2 col-lg-2">
                                    <div class="form-group">
                                        <label for="user">联系方式</label>
                                        <input type="text" class="form-control" value="<?php echo $row['contact'];?>" disabled="disabled">
                                    </div>
                                </div>
                                <div class="col-sm-2 col-lg-2">
                                <div class="form-group">
                                    <label for="qq">盗版IP</label>
                                    <input type="text" class="form-control" value="<?php echo $row['ip'];?>" disabled="disabled" >
                                </div>
                                </div>
                                <div class="col-sm-1 col-lg-1">
                                    <div class="form-group">
                                        <label for="name">当前版本</label>
                                        <input type="text" class="form-control" value="<?php echo $row['edition'];?>" disabled="disabled" >
                                    </div>
                                </div>
                                <div class="col-sm-1 col-lg-1">
                                    <div class="form-group">
                                        <label for="name">当前版本号</label>
                                        <input type="text" class="form-control" value="<?php echo $row['version'];?>" disabled="disabled" >
                                    </div>
                                </div>
                                <div class="col-sm-2 col-lg-2">
                                    <div class="form-group">
                                        <label for="mail">添加时间</label>
                                        <input type="text" class="form-control" value="<?php echo $row['date'];?>" disabled="disabled" >
                                    </div>
                                </div>
                                <div class="col-sm-2 col-lg-2">
                                    <div class="form-group">
                                        <label for="phone">更新时间</label>
                                        <input type="text" class="form-control" value="<?php echo $row['time'];?>" disabled="disabled" >
                                    </div>
                                </div>
                                <?php if($row['expand_1']){?>
                                    <div class="col-sm-3 col-lg-3">
                                        <div class="form-group">
                                            <label for="text"><?php echo explode('||',$row['expand_1'])[0];?></label>
                                            <input type="text" class="form-control" value="<?php echo explode('||',$row['expand_1'])[1];?>" disabled="disabled" >
                                        </div>
                                    </div>
                                <?php }if($row['expand_2']){?>
                                    <div class="col-sm-3 col-lg-3">
                                        <div class="form-group">
                                            <label for="text"><?php echo explode('||',$row['expand_2'])[0];?></label>
                                            <input type="text" class="form-control" value="<?php echo explode('||',$row['expand_2'])[1];?>" disabled="disabled" >
                                        </div>
                                    </div>
                                <?php }if($row['expand_3']){?>
                                    <div class="col-sm-3 col-lg-3">
                                        <div class="form-group">
                                            <label for="text"><?php echo explode('||',$row['expand_3'])[0];?></label>
                                            <input type="text" class="form-control" value="<?php echo explode('||',$row['expand_3'])[1];?>" disabled="disabled" >
                                        </div>
                                    </div>
                                <?php }if($row['expand_4']){?>
                                    <div class="col-sm-3 col-lg-3">
                                        <div class="form-group">
                                            <label for="text"><?php echo explode('||',$row['expand_4'])[0];?></label>
                                            <input type="text" class="form-control" value="<?php echo explode('||',$row['expand_4'])[1];?>" disabled="disabled" >
                                        </div>
                                    </div>
                                <?php }if($row['expand_5']){?>
                                    <div class="col-sm-3 col-lg-3">
                                        <div class="form-group">
                                            <label for="text"><?php echo explode('||',$row['expand_5'])[0];?></label>
                                            <input type="text" class="form-control" value="<?php echo explode('||',$row['expand_5'])[1];?>" disabled="disabled" >
                                        </div>
                                    </div>
                                <?php }?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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