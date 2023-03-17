<?php
/*
* @Time    : 2022/05/22 20:57
* @Author  : 爱唯逸网络科技
* @Mail    : support@857xx.cn
* @Site    : https://web.857xx.cn
* @File    : article_add.php
* @Action  : 文章添加
*/

include("../system/core/core.php");
$title='工单分类添加';
include './page_head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login_index.php';</script>");
?>

<link rel="stylesheet" type="text/css" href="../assets/Layui/css/layui.css"/>
<!--页面主要内容-->
<main class="lyear-layout-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4><?php echo $title;?></h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="text">名称</label>
                            <input type="text" id="name" class="form-control" placeholder="分类名称"/>
                        </div>
                        <div class="form-group">
                            <label for="text">状态</label>
                            <select id="status" class="form-control" default="1">
                                <option value="1">显示</option>
                                <option value="0">隐藏</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="text">描述</label>
                            <textarea id="text" class="form-control" rows="10" placeholder="描述"></textarea>
                        </div>
                        <div class="form-group">
                            <a href="javascript:void(0);" onclick="add()" class="btn btn-primary form-control">确定</a>
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

<script type="text/javascript" src="../assets/Layui/layui.js"></script>

<script>
function add(){
    var name = $("#name").val();
    var text = $("#text").val();
    var status = $("#status").val();
    var load = layer.load(2, {tiem: 99999});
    $.ajax({
        type: "POST",
        url: 'ajax_workorder.php?act=add_class',
        data: {
            name:name,
            text:text,
            status:status
        },
        dataType: "json",
        success: function (data) {
            layer.close(load);
            layer.msg(data.msg);
            if(data.code == 1){
                setTimeout(function () {
                    location.href="./workorder_class.php";
                }, 1000); 
            }
        },
        error: function () {
            layer.close(load);
            layer.alert('加载失败！');
        }
    });
};
</script>
</body>
</html>
