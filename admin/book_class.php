<?php
/*
* @Time    : 2022/05/22 20:57
* @Author  : 爱唯逸网络科技
* @Mail    : support@857xx.cn
* @Site    : https://web.857xx.cn
* @File    : article_list.php
* @Action  : 文章列表
*/

include("../system/core/core.php");
$title='知识文档分类';
include './page_head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login_index.php';</script>");
$mod=isset($_GET['mod'])?$_GET["mod"]:'list';
$numrows=$DB->count("SELECT count(*) from website_class_book");
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
                            <strong>系统目前有</strong> <?php echo $numrows;?> <strong>个分类</strong>
                        </div>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>名称</th>
                                        <th>时间</th>
                                        <th>浏览量</th>
                                        <th>状态</th>
                                        <th>操作</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $rs=$DB->query("SELECT * FROM website_class_book order by id asc");
                                        while($res = $DB->fetch($rs)){
                                            if($res['status']=='1'){
                                                $status=['info','显示'];
                                            }else{
                                                $status=['danger','隐藏'];
                                            }
                                            if($conf['rewrite_book']=='1'){
                                                $jump_url = '/book/'.$res['id'].'.html';
                                            }else{
                                                $jump_url = '/page/book/page.php?class='.$res['id'];
                                            }
                                            echo '
                                                <tr>
                                                    <td><b>'.$res['id'].'</b></td>
                                                    <td>'.$res['name'].'</td>
                                                    <td>'.$res['date'].'</td>
                                                    <td>'.$res['number'].'</td>
                                                    <td>
                                                        <a href="javascript:void(0);" onclick="status('.$res['id'].')" class="btn btn-'.$status[0].' btn-xs">'.$status[1].'</a>
                                                    </td>
                                                    <td>
                                                        <a href="javascript:void(0);" onclick="del('.$res['id'].')" class="btn btn-danger btn-xs">删除</a>
                                                        <a href="javascript:void(0);" onclick="edit('.$res['id'].')" class="btn btn-info btn-xs">修改</a>
                                                        <a href="'.$jump_url.'" target="_blank" class="btn btn-info btn-xs">查看</a>
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
    </div>
</main>
<!--End 页面主要内容-->

<script type="text/javascript" src="../assets/LightYear/js/jquery.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/perfect-scrollbar.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/main.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/jquery.cookie.min.js"></script>

<script src="//unpkg.com/layui@2.7.6/dist/layui.js"></script>

<script>
function edit(id) {
    var ii = layer.load(0, {
        shade: [0.1, '#fff']
    });
    $.ajax({
        type: "POST",
        url: "ajax_book.php?act=class_info",
        data : {id:id},
        dataType: 'json',
        success: function(data) {
            layer.close(ii);
            if (data.code == 1) {
                var item = '<div class="form-group">';
                item += '<input type="text" id="name" class="form-control" value="'+data.name+'" placeholder="分类名称"/>';
                item += '</div>';
                item += '<div class="form-group">';
                item += '<input type="number" id="number" class="form-control" value="'+data.number+'" placeholder="查看次数"/>';
                item += '</div>';
                item += '<div class="form-group">';
                item += '<input type="text" id="img" class="form-control" value="'+data.img+'" placeholder="大头图"/>';
                item += '</div>';
                item += '<div class="form-group">';
                item += '<select id="status" class="form-control">';
                if(data.status==1){
                    item += '<option value="1">显示</option>';
                    item += '<option value="0">隐藏</option>';
                }else{
                    item += '<option value="0">隐藏</option>';
                    item += '<option value="1">显示</option>';
                }
                item += '</select>';
                item += '</div>';
                item += '<div class="form-group">';
                item += '<textarea id="title" class="form-control" style="width:100%;" placeholder="描述">'+data.title+'</textarea>';
                item += '</div>';
                layer.open({
                    title: '文档分类修改',
                    area: ['20%', 'auto'],
                    btn: ['保存', '关闭'],
                    content: item,
                    btn1: function () {
                        var name = $("#name").val();
                        var number = $("#number").val();
                        var img = $("#img").val();
                        var status = $("#status").val();
                        var title = $("#title").val();
                        var load = layer.load(2, {tiem: 99999});
                        $.ajax({
                            type: "POST",
                            url: 'ajax_book.php?act=class_edit',
                            data: {
                                id:id,
                                name:name,
                                number:number,
                                img:img,
                                status:status,
                                title:title
                            },
                            dataType: "json",
                            success: function (data) {
                                layer.close(load);
                                layer.msg(data.msg);
                                if(data.code == 1){
                                    setTimeout(function () {
                                        location.href="./book_class.php";
                                    }, 1000); 
                                }
                            },
                            error: function () {
                                layer.close(load);
                                layer.msg('加载失败！');
                            }
                        });
                    }
                });
            } else {
                layer.msg(data.msg);
            }
        },
        error: function(data) {
            layer.close(ii);
            layer.msg('服务器错误！');
            return false;
        }
    });
}


function status(id){
    layer.confirm('确定吗？',{
        btn:['确定','取消'],
        closeBtn:0,
        icon:3
    },
    function(){
        var ii = layer.load(0, {shade:[0.1,'#fff']});
	    $.ajax({
	    	type : "POST",
	    	url : "ajax_book.php?act=class_status",
	    	data : {
	    	    id:id
	    	},
	    	dataType : 'json',
	    	success : function(data) {
	    		layer.close(ii);
	    		layer.msg(data.msg);
	    		if(data.code==1){
	    		    setTimeout(function () {
	    		        location.href='./book_class.php';
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
function del(id){
    layer.confirm('分类下的文档也会全部删除哦！',{
        btn:['确定','取消'],
        closeBtn:0,
        icon:3
    },
    function(){
        var ii = layer.load(0, {shade:[0.1,'#fff']});
	    $.ajax({
	    	type : "POST",
	    	url : "ajax_book.php?act=class_del",
	    	data : {
	    	    id:id
	    	},
	    	dataType : 'json',
	    	success : function(data) {
	    		layer.close(ii);
	    		layer.msg(data.msg);
	    		if(data.code==1){
	    		    setTimeout(function () {
	    		        location.href='./book_class.php';
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
var items = $("select[default]");
for (i = 0; i < items.length; i++) {
    $(items[i]).val($(items[i]).attr("default")||0);
}
</script>

</body>
</html>