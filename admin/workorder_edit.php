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
$title='工单分类修改';
include './page_head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login_index.php';</script>");
$id = $_GET['id'];
$row = $DB->get_row("select * from website_class_workorder where id = '{$id}'");
if(!$id){
    showmsg("必要参数为空");
}elseif(!$row){
    showmsg("数据不存在");
}
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
                            <input type="text" id="name" class="form-control" placeholder="分类名称" value="<?php echo $row['name'];?>"/>
                        </div>
                        <div class="form-group">
                            <label for="text">状态</label>
                            <select id="status" class="form-control" default="<?php echo $row['status'];?>">
                                <option value="1">显示</option>
                                <option value="0">隐藏</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="text">描述</label>
                            <textarea id="text" class="form-control" rows="10" placeholder="描述"><?php echo $row['text'];?></textarea>
                        </div>
                        <div class="form-group">
                            <a href="javascript:void(0);" onclick="edit(<?php echo$id;?>)" class="btn btn-primary form-control">确定</a>
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
var items = $("select[default]");
for (i = 0; i < items.length; i++) {
$(items[i]).val($(items[i]).attr("default")||0);
}
function edit(id){
    layer.confirm('确定？',{btn:['确定','取消'],closeBtn:0,icon:3},function(){
    var name = $("#name").val();
    var text = $("#text").val();
    var status = $("#status").val();
    var load = layer.load(2, {tiem: 99999});
    $.ajax({
        type: "POST",
        url: 'ajax_workorder.php?act=edit_class',
        data: {
            id:id,
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
                    location.href="./workorder_edit.php?id="+id;
                }, 1000); 
            }
        },
        error: function () {
            layer.close(load);
            layer.alert('加载失败！');
        }
    });});
};
</script>
</body>
</html>
