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
$title='知识文档列表';
include './page_head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login_index.php';</script>");
$mod=isset($_GET['mod'])?$_GET["mod"]:'list';
$numrows=$DB->count("SELECT count(*) from website_book");
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
                            <strong>系统目前有</strong> <?php echo $numrows;?> <strong>篇文档</strong>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>分类</th>
                                        <th>名称</th>
                                        <th>时间</th>
                                        <th>浏览量</th>
                                        <th>状态</th>
                                        <th>操作</th>
                                    </tr>
                                </thead>
                            <tbody>
                            <?php
                            $rs=$DB->query("SELECT * FROM website_book order by id asc");
                            while($res = $DB->fetch($rs)){
                                $row = $DB->get_row("select * from website_class_book where id = '{$res['class']}'");
                                if($res['status']=='1'){
                                    $status=['info','显示'];
                                }else{
                                    $status=['danger','隐藏'];
                                }
                                if($conf['rewrite_book']=='1'){
                                    $jump_url = '/book/'.$res['class'].'/'.$res['id'].'.html';
                                }else{
                                    $jump_url = '/page/book/page.php?class='.$res['class'].'&page='.$res['id'];
                                }
                                echo '
                                <tr>
                                    <td><b>'.$res['id'].'</b></td>
                                    <td>'.$row['name'].'</td>
                                    <td>'.$res['name'].'</td>
                                    <td>'.$res['date'].'</td>
                                    <td>'.$res['number'].'</td>
                                    <td>
                                        <a href="javascript:void(0);" onclick="status('.$res['id'].')" class="btn btn-'.$status[0].' btn-xs">'.$status[1].'</a>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0);" onclick="del('.$res['id'].')" class="btn btn-danger btn-xs">删除</a>
                                        <a href="./book_edit.php?id='.$res['id'].'" class="btn btn-info btn-xs">编辑</a>
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
</main>
<!--End 页面主要内容-->

<script type="text/javascript" src="../assets/LightYear/js/jquery.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/perfect-scrollbar.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/main.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/jquery.cookie.min.js"></script>

<script src="../assets/Layer/layer.js"></script>

<script>
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
	    	url : "ajax_book.php?act=status",
	    	data : {
	    	    id:id
	    	},
	    	dataType : 'json',
	    	success : function(data) {
	    		layer.close(ii);
	    		layer.msg(data.msg);
	    		if(data.code==1){
	    		    setTimeout(function () {
	    		        location.href='./book_list.php';
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
    layer.confirm('确定吗？',{
        btn:['确定','取消'],
        closeBtn:0,
        icon:3
    },
    function(){
        var ii = layer.load(0, {shade:[0.1,'#fff']});
	    $.ajax({
	    	type : "POST",
	    	url : "ajax_book.php?act=del",
	    	data : {
	    	    id:id
	    	},
	    	dataType : 'json',
	    	success : function(data) {
	    		layer.close(ii);
	    		layer.msg(data.msg);
	    		if(data.code==1){
	    		    setTimeout(function () {
	    		        location.href='./book_list.php';
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