<?php
/*
* @Time    : 2022/05/22 20:57
* @Author  : 爱唯逸网络科技
* @Mail    : support@857xx.cn
* @Site    : https://web.857xx.cn
* @File    : article_set.php
* @Action  : 文章系统配置
*/

include("../system/core/core.php");
$title='文章配置';
include './page_head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login_index.php';</script>");
?>
<!--页面主要内容-->
<main class="lyear-layout-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>知识文档配置</h4>
                    </div>
                    <div class="card-body">
                        <div class="input-group">
                            <span class="input-group-addon">伪静态</span>
                            <select id="rewrite"  class="form-control" default="<?php echo $conf['rewrite_book'];?>">
                                <option value="1">打开</option>
                                <option value="0">关闭</option>
                            </select>
                        </div>
                        <br/>
                        <div class="form-group">
                            <a href="javascript:set()" class="btn-block btn-round btn btn-success">确定</a>
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

<script type="text/javascript">
var items = $("select[default]");
for (i = 0; i < items.length; i++) {
    $(items[i]).val($(items[i]).attr("default") || 0);
}
    function set() {
    var rewrite = $("#rewrite").val();
    var ii = layer.load(0, {
        shade: [0.1, '#fff']
    });
    $.ajax({
        type: "POST",
        url: "ajax_system.php?act=book_set",
        data: {
            rewrite: rewrite
        },
        dataType: 'json',
        success: function(data) {
            layer.close(ii);
            layer.msg(data.msg);
            if (data.code == 1) {
                window.location.href = './book_set.php';
            }
        },
        error: function(data) {
            layer.close(ii);
            layer.msg('服务器错误！');
            return false;
        }
    });
}
</script>

</body>
</html>