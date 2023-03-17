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
$id = daddslashes($_GET['id']);
if($islogins==1){}else exit("<script language='javascript'>window.location.href='./login_index.php?go_url=".get_url_last()."';</script>");
$row = $DB->get_row("SELECT * FROM website_legal WHERE id='".$id."'");
$rows = $DB->get_row("SELECT * FROM website_app WHERE id='{$row['type']}'");
$row_user = $DB->get_row("SELECT * FROM website_user WHERE uid='{$row['user']}'");
if(!$id){
    showmsg("参数缺失");
}elseif($row['user'] != $udata['uid']){
    showmsg("无法查看他人授权");
}
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

<script type="text/javascript">
    var items = $("select[default]");
for (i = 0; i < items.length; i++) {
    $(items[i]).val($(items[i]).attr("default") || 0);
}

window.onload = function() {
    var id = GetUrlParam("id");
    var ii = layer.load(0, {
        shade: [0.1, '#fff']
    });
    $.ajax({
        type: "POST",
        url: "ajax_auth.php?act=check_auth",
        data: {
            id: id
        },
        dataType: 'json',
        success: function(data) {
            layer.close(ii);
            if (data.code != 1) {
                layer.msg(data.msg);
                setTimeout(function() {
                    location.href = "./auth_legal.php";
                },
                2000);
            }
        },
        error: function(data) {
            layer.close(ii);
            layer.msg('服务器错误');
            return false;
        }
    });
};

function GetUrlParam(paraName) {
    var url = document.location.toString();
    var arrObj = url.split("?");
    if (arrObj.length > 1) {
        var arrPara = arrObj[1].split("&");
        var arr;
        for (var i = 0; i < arrPara.length; i++) {
            arr = arrPara[i].split("=");
            if (arr != null && arr[0] == paraName) {
                return arr[1];
            }
        }
        return "";
    } else {
        return "";
    }
}
</script>

<script src="../assets/Layer/layer.js"></script>

</body>
</html>