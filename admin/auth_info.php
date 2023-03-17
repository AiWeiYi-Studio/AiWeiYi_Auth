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
$title = '授权信息';
include './page_head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login_index.php';</script>");
$row = $DB->get_row("SELECT * FROM website_legal WHERE id='{$_GET['id']}'");
$rows = $DB->get_row("SELECT * FROM website_app WHERE id='{$row['type']}'");
$row_user = $DB->get_row("SELECT * FROM website_user WHERE uid='{$row['user']}'");
?>
<!--页面主要内容-->
<main class="lyear-layout-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>授权信息</h4>
                    </div>
                    <div class="card-body">
                        <div class="example-box text-center">
                            <a href="<?php echo $rows['download'];?>" class="btn btn-w-md btn-round btn-danger">下载文件</a>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="text">序号</label>
                                    <input type="text" class="form-control" value="<?php echo $row['id'];?>" disabled="disabled">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="text">隶属程序</label>
                                    <input type="text" class="form-control" value="<?php echo $rows['name'];?>" disabled="disabled">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="text">添加时间</label>
                                    <input type="text" class="form-control" value="<?php echo $row['date'];?>" disabled="disabled">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="text">到期时间</label>
                                    <input type="text" class="form-control" value="<?php echo $row['time'];?>" disabled="disabled">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="text">识别码</label>
                                    <input type="text" class="form-control" value="<?php echo $row['uuid'];?>" disabled="disabled">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="text">授权IP</label>
                                    <input type="text" class="form-control" value="<?php echo $row['ip'];?>" disabled="disabled">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="text">授权码</label>
                                    <input type="text" class="form-control" value="<?php echo $row['authcode'];?>" disabled="disabled">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="text">授权密钥</label>
                                    <input type="text" class="form-control" value="<?php echo $row['token'];?>" disabled="disabled">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="text">联系方式</label>
                                    <input type="text" class="form-control" value="<?php echo $row['contact'];?>" disabled="disabled">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="text">隶属用户</label>
                                    <input type="text" class="form-control" value="<?php echo $row_user['name'];?>" disabled="disabled">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="text">授权状态</label>
                                    <select id="active" class="form-control" default="<?php echo $row['active'];?>" disabled="disabled">
                                        <option value="0">封禁</option>
                                        <option value="1">正常</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="text">封禁原因</label>
                                    <input type="text" class="form-control" value="<?php echo $row['why'];?>" disabled="disabled">
                                </div>
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

<script type="text/javascript" src="../assets/System/admin/js/auth_info.js?ver=<?php echo VER ?>"></script>

<script src="../assets/Layer/layer.js"></script>

</body>
</html>