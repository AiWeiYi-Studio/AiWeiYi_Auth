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
$title = '程序信息';
include './page_head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login_index.php';</script>");
$row = $DB->get_row("SELECT * FROM website_app WHERE id = {$_GET['id']} limit 1");
?>
<!--页面主要内容-->
<main class="lyear-layout-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>程序信息</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4 col-lg-4">
                                <div class="form-group">
                                    <label for="text">程序名称</label>
                                    <input type="text" id="name" class="form-control" value="<?php echo $row['name'];?>">
                                </div>
                            </div>
                            <div class="col-sm-4 col-lg-4">
                        <div class="form-group">
                            <label for="text">安装包</label>
                            <input type="text" id="download" class="form-control" value="<?php echo $row['download'];?>">
                        </div>
                            </div>
                            <div class="col-sm-4 col-lg-4">
                        <div class="form-group">
                            <label for="text">程序状态</label>
                            <select id="status" class="form-control" default="<?php echo $row['status'];?>">
                                <option value="0">关闭</option>
                                <option value="1">正常</option>
                            </select>
                        </div>
                        </div>
                            <div class="col-sm-3 col-lg-3">
                        <div class="form-group">
                            <label for="text">日售价</label>
                            <input type="text" id="money_day" class="form-control" placeholder="输入-1或-1.00时商城隐藏此选项" value="<?php echo $row['money_day'];?>">
                        </div>
                        </div>
                        <div class="col-sm-3 col-lg-3">
                        <div class="form-group">
                            <label for="text">月售价</label>
                            <input type="text" id="money_month" class="form-control" placeholder="输入-1或-1.00时商城隐藏此选项" value="<?php echo $row['money_month'];?>">
                        </div>
                        </div>
                        <div class="col-sm-3 col-lg-3">
                        <div class="form-group">
                            <label for="text">年售价</label>
                            <input type="text" id="money_year" class="form-control" placeholder="输入-1或-1.00时商城隐藏此选项" value="<?php echo $row['money_year'];?>">
                        </div>
                        </div>
                        <div class="col-sm-3 col-lg-3">
                        <div class="form-group">
                            <label for="text">永久售价</label>
                            <input type="text" id="money_long" class="form-control" placeholder="输入-1或-1.00时商城隐藏此选项" value="<?php echo $row['money_long'];?>">
                        </div>
                        </div>
                            <div class="col-sm-6 col-lg-6">
                        <div class="form-group">
                            <label for="text">云端通知</label>
                            <textarea id="notice" class="form-control" rows="10"><?php echo $row['notice'];?></textarea>
                        </div>
                            </div>
                            <div class="col-sm-6 col-lg-6">
                        <div class="form-group">
                            <label for="text">程序描述</label>
                            <textarea id="text" class="form-control" rows="10"><?php echo $row['text'];?></textarea>
                        </div>
                            </div>
                            <div class="col-sm-6 col-lg-6">
                        <div class="form-group">
                            <label for="text">盗版提示</label>
                            <textarea id="notice_pirate" class="form-control" rows="10"><?php echo $row['notice_pirate'];?></textarea>
                        </div>
                            </div>
                            <div class="col-sm-6 col-lg-6">
                        <div class="form-group">
                            <label for="text">未授权提示</label>
                            <textarea id="notice_not" class="form-control" rows="10"><?php echo $row['notice_not'];?></textarea>
                        </div>
                            </div>
                            <div class="col-sm-6 col-lg-6">
                        <div class="form-group">
                            <label for="text">到期提示</label>
                            <textarea id="notice_date" class="form-control" rows="10"><?php echo $row['notice_date'];?></textarea>
                        </div>
                            </div><div class="col-sm-6 col-lg-6">
                        <div class="form-group">
                            <label for="text">程序关闭提示</label>
                            <textarea id="notice_status" class="form-control" rows="10"><?php echo $row['notice_status'];?></textarea>
                        </div>
                            </div>
                            <div class="col-sm-12 col-lg-12">
                        <div class="form-group">
                            <label for="text">数据库扩展</label>
                            <textarea id="expand" class="form-control" rows="10"><?php echo $row['expand'];?></textarea>
                        </div>
                            </div>
                            </div>
                            
                        <div class="form-group">
                            <a href="javascript:post()" class="btn-block btn-round btn btn-success">确定</a>
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

<script type="text/javascript" src="../assets/System/admin/js/auth_set.js?ver=<?php echo VER ?>"></script>

<script src="../assets/Layer/layer.js"></script>

</body>
</html>