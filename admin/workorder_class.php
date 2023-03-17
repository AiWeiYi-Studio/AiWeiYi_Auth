<?php
/*
* @Time    : 2022/05/22 20:57
* @Author  : 爱唯逸网络科技
* @Mail    : support@857xx.cn
* @Site    : https://web.857xx.cn
* @File    : workorder_class.php
* @Action  : 工单分类列表
*/

include("../system/core/core.php");
$title='工单分类列表';
include './page_head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login_index.php';</script>");
$mod=isset($_GET['mod'])?$_GET["mod"]:'list';
$numrows=$DB->count("SELECT count(*) from website_class_workorder");
?>
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
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>系统目前有</strong> <?php echo $numrows;?> <strong>个工单分类</strong>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>名称</th>
                                        <th>添加时间</th>
                                        <th>描述</th>
                                        <th>状态</th>
                                        <th>操作</th>
                                    </tr>
                                </thead>
                            <tbody>
                            <?php
                            $rs=$DB->query("SELECT * FROM website_class_workorder order by id asc");
                            while($res = $DB->fetch($rs)){
                                if($res['status']=='1'){
                                    $status = '显示';
                                }else{
                                    $status = '隐藏';
                                }
                                echo '
                                <tr>
                                    <td><b>'.$res['id'].'</b></td>
                                    <td>'.$res['name'].'</td>
                                    <td>'.$res['date'].'</td>
                                    <td>'.$res['text'].'</td>
                                    <td>'.$status.'</td>
                                    <td>
                                        <a href="javascript:del('.$res['id'].')" class="btn btn-danger btn-xs">删除</a>
                                        <a href="./workorder_edit.php?id='.$res['id'].'" class="btn btn-info btn-xs">编辑</a>
                                    </td>
                                </tr>
                                ';
                            }
                            ?>
                            </tbody>
                        </table>
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

<script>
    function del(id){
        layer.confirm('确定？',{btn:['确定','取消'],closeBtn:0,icon:3},function(){
    var load = layer.load(2, {tiem: 99999});
    $.ajax({
        type: "POST",
        url: 'ajax_workorder.php?act=del_class',
        data: {id:id},
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
    }); });
};
</script>

</body>
</html>