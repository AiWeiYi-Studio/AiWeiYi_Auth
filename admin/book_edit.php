<?php
/*
* @Time    : 2022/05/22 20:57
* @Author  : 爱唯逸网络科技
* @Mail    : support@857xx.cn
* @Site    : https://web.857xx.cn
* @File    : article_edit.php
* @Action  : 文章修改
*/

include("../system/core/core.php");
$title='文章修改';
include './page_head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login_index.php';</script>");
$id = $_GET['id'];
$row = $DB->get_row("select * from website_book where id = '{$id}'");
?>
<!--页面主要内容-->
<main class="lyear-layout-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>文章修改</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="text">文档分类</label>
                            <select id="class" class="form-control" default="<?php echo $row['class'];?>">
                                <option value="0">请选择文档分类</option>
                                <?php
                                    $rs=$DB->query("SELECT * FROM website_class_book WHERE status = '1' order by id asc");
                                    while($res = $DB->fetch($rs)){
                                        echo '<option value="'.$res['id'].'">'.$res['name'].'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="text">文档标题</label>
                            <input type="text" id="name" class="form-control" value="<?=$row['name']?>" >
                        </div>
                        <div class="form-group">
                            <label for="text">浏览量</label>
                            <input type="number" id="number" class="form-control" value="<?php echo $row['number'];?>">
                        </div>
                        <div class="form-group">
                            <label for="text">文档状态</label>
                            <select id="status" class="form-control" default="<?php echo $row['status'];?>">
                                <option value="0">隐藏</option>
                                <option value="1">显示</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="date">添加时间</label>
                            <input class="form-control js-datetimepicker" type="text" id="date" value="<?php echo $row['date'];?>" data-side-by-side="true" data-locale="zh-cn" data-format="YYYY-MM-DD HH:mm:ss" />
                        </div>
                        <div class="form-group">
                            <label for="text">文章内容：</label>
                            <textarea id="Ueditor" style="width:100%;height:400px;"><?php echo $row['text'];?></textarea>
                        </div>
                        <div class="form-group">
                            <a href="javascript:void(0);" onclick="edit(<?php echo $id;?>)" class="btn btn-primary form-control">确定</a>
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

<!--时间选择插件-->
<script src="../assets/LightYear/js/bootstrap-datetimepicker/moment.min.js"></script>
<script src="../assets/LightYear/js/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js"></script>
<script src="../assets/LightYear/js/bootstrap-datetimepicker/locale/zh-cn.js"></script>

<script src="../assets/Layer/layer.js"></script>

<!-- 配置文件 -->
<script type="text/javascript" charset="gbk" src="../assets/Ueditor/ueditor.config.js"></script>
<!-- 编辑器源码文件 -->
<script type="text/javascript" charset="gbk" src="../assets/Ueditor/ueditor.all.js"></script>
<!-- 编辑器语言 -->
<script type="text/javascript" charset="gbk" src="../assets/Ueditor/lang/zh-cn/zh-cn.js"></script>

<script>
var ue = UE.getEditor('Ueditor');
    var items = $("select[default]");
for (i = 0; i < items.length; i++) {
    $(items[i]).val($(items[i]).attr("default")||0);
}
function edit(id){
    layer.confirm('确定吗？',{
        btn:['确定','取消'],
        closeBtn:0,
        icon:3
    },
    function(){
        var ii = layer.load(0, {shade:[0.1,'#fff']});
        var uid=$("#class").val();
	    var name=$("#name").val();
	    var date=$("#date").val();
	    var number=$("#number").val();
	    var status=$("#status").val();
	    var text = ue.getContent();
	    $.ajax({
	    	type : "POST",
	    	url : "ajax_book.php?act=edit",
	    	data : {
	    	    id:id,
	    	    uid:uid,
	    	    name:name,
	    	    date:date,
	    	    number:number,
	    	    status:status,
	    	    text:text
	    	},
	    	dataType : 'json',
	    	success : function(data) {
	    		layer.close(ii);
	    		layer.msg(data.msg);
	    		if(data.code==1){
	    		    setTimeout(function () {
	    		        location.href='./book_edit.php?id=' + id;
	    		    }, 1000); 
	    		}
	    	},
	    	error:function(data){
	    		layer.close(ii);
	    		layer.msg('服务器错误！');
	    		return false;
	    	}
	    });
    });
};
</script>
</body>
</html>