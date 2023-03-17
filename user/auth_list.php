<?php
/*
* @Time    : 2022/05/22 20:57
* @Author  : 爱唯逸网络科技
* @Mail    : support@857xx.cn
* @Site    : https://web.857xx.cn
* @File    : user_money_log.php
* @Action  : 用户资金明细
*/

include("../system/core/core.php");
$title='授权列表';
include './page_head.php';
if($islogins==1){}else exit("<script language='javascript'>window.location.href='./login_index.php?go_url=".get_url_last()."';</script>");
$numrows=$DB->count("SELECT count(*) from website_legal where user = '".$udata['uid']."'");
?>
<!--页面主要内容-->
<main class="lyear-layout-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>授权列表</h4>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>系统目前有</strong> <?php echo $numrows;?> <strong>条记录</strong>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>添加时间</th>
                                        <th>到期时间</th>
                                        <th>隶属程序</th>
                                        <th>识别码</th>
                                        <th>授权状态</th>
                                        <th>联系方式</th>
                                        <th>操作</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                $pagesize=30;
                                $pages=intval($numrows/$pagesize);
                                if ($numrows%$pagesize){
                                    $pages++;
                                }
                                if (isset($_GET['page'])){
                                    $page=intval($_GET['page']);
                                }else{
                                    $page=1;
                                }
                                $offset=$pagesize*($page - 1);
                                $rs=$DB->query("SELECT * FROM website_legal  where user = '".$udata['uid']."' order by id asc limit $offset,$pagesize");
                                while($res = $DB->fetch($rs)){
                                    $row = $DB->get_row("SELECT * FROM website_user WHERE uid='{$res['user']}' limit 1");
                                    $row_app = $DB->get_row("SELECT * FROM website_app WHERE id='{$res['type']}' limit 1");
                                    if($res['active'] == 0){
                                        $active = '<a href="javascript:active('.$res['id'].')" class="btn btn-round btn-xs btn-danger">封禁</a>';
                                    }else{
                                        $active = '<sapn class="btn btn-round btn-xs btn-info">正常</sapn>';
                                    }
                                    if($res['beta'] == 1){
                                        $beta = ['danger','内测'];
                                    }else{
                                        $beta = ['info','非内测'];
                                    }
                                    echo '
                                        <tr>
                                            <td><b>'.$res['id'].'</b></td>
                                            <td>'.$res['date'].'</td>
                                            <td>'.$res['time'].'</td>
                                            <td>'.$row_app['name'].'</td>
                                            <td>'.$res['uuid'].'</td>
                                            <td>'.$active.'</td>
                                            <td>'.$res['contact'].'</td>
                                            <td>
                                                <a href="javascript:beta('.$res['id'].','.$res['beta'].')" class="btn btn-round btn-xs btn-'.$beta[0].'">'.$beta[1].'</a>
                                                <a href="./auth_uplog.php?app='.$res['type'].'" class="btn btn-round btn-xs btn-yellow">更新日志</a>
                                                <a href="'.$row_app['download'].'" class="btn btn-round btn-xs btn-yellow">安装包</a>
                                                <a href="./auth_info.php?id='.$res['id'].'" class="btn btn-round btn-xs btn-cyan">详细</a>
                                                <a href="javascript:del('.$res['id'].')" class="btn btn-round btn-xs btn-brown">删除</a>
                                            </td>
                                        </tr>
                                    ';
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                        <?php
                        echo '<center>';
                        echo'<ul class="pagination">';
                        $first=1;
                        $prev=$page-1;
                        $next=$page+1;
                        $last=$pages;
                        if ($page>1){
                            echo '<li><a href="?page='.$first.$link.$url.'">首页</a></li>';
                            echo '<li><a href="?page='.$prev.$link.$url.'">&laquo;</a></li>';
                        } else {
                            echo '<li class="disabled"><a>首页</a></li>';
                            echo '<li class="disabled"><a>&laquo;</a></li>';
                        }
                        for ($i=1;$i<$page;$i++)
                        echo '<li><a href="?page='.$i.$link.$url.'">'.$i .'</a></li>';
                        echo '<li class="disabled"><a>'.$page.'</a></li>';
                        for ($i=$page+1;$i<=$pages;$i++)
                        echo '<li><a href="?page='.$i.$link.$url.'">'.$i .'</a></li>';
                        if ($page<$pages){
                            echo '<li><a href="?page='.$next.$link.$url.'">&raquo;</a></li>';
                            echo '<li><a href="?page='.$last.$link.$url.'">尾页</a></li>';
                        } else {
                            echo '<li class="disabled"><a>&raquo;</a></li>';
                            echo '<li class="disabled"><a>尾页</a></li>';
                        }
                        echo '</center>';
                        echo'</ul>';
                        #分页
                        ?>
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
    function beta(id,beta){
        if(beta == 1){
            var msg = "退出内测后将无法第一时间收到系统更新<br/>确定退出吗？";
        }else{
            var msg = "内测版本可以第一时间收到系统更新<br/>但是您可能会面临众多问题<br/>确定加入吗？";
        }
        layer.confirm(msg,{
            btn:['确定','取消'],
            closeBtn:0,
            icon:3
        },
        function(){
            var ii = layer.load(0, {shade:[0.1,'#fff']});
            $.ajax({
                type : "POST",
                url : "ajax_auth.php?act=beta",
                data : {id:id},
                dataType : 'json',
                success : function(data) {
                    layer.close(ii);
                    layer.msg(data.msg);
                },
                error:function(data){
                    layer.close(ii);
                    layer.msg('服务器错误！');
                    return false;
                }
            });
        });
	};
    function active(id){
        var ii = layer.load(0, {shade:[0.1,'#fff']});
	    $.ajax({
	        type : "POST",
	    	url : "ajax_auth.php?act=active_why",
	    	data : {id:id},
	    	dataType : 'json',
	    	success : function(data) {
	    		layer.close(ii);
	    		layer.msg(data.msg);
	    	},
	    	error:function(data){
	    		layer.close(ii);
	    		layer.msg('服务器错误！');
	    		return false;
	    	}
	    });
	};
	
	function del(id){
    layer.confirm('删除后不可恢复，确定删除吗？',{
        btn:['确定','取消'],
        closeBtn:0,
        icon:3
    },
    function(){
        var ii = layer.load(0, {shade:[0.1,'#fff']});
	    $.ajax({
	    	type : "POST",
	    	url : "ajax_auth.php?act=del_auth",
	    	data : {id:id},
	    	dataType : 'json',
	    	success : function(data) {
	    		layer.close(ii);
	    		layer.msg(data.msg)
	    		if(data.code==1){
	    		    setTimeout(function () {
			            location.href="./auth_list.php";
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

<script src="../assets/Layer/layer.js"></script>

</body>
</html>