<?php
include("../system/core/core.php");
$title='资金明细';
include './page_head.php';
if($islogins==1){}else exit("<script language='javascript'>window.location.href='./login_index.php?go_url=".get_url_last()."';</script>");
if($conf['site_active']=='1'){
    sysmsg('<h2>网站维护已开启</h2><ul><li><font size="4">'.$conf['site_active_notice'].'</font></li>',true);
}
if($_GET['type'] == 'type'){
    $sql = "type = '{$_GET['kw']}'";
}elseif($_GET['type'] == 'id'){
    $sql = "id = {$_GET['kw']}";
}elseif($_GET['type'] == 'status'){
    $sql = "status = {$_GET['kw']}";
}elseif($_GET['type'] == 'trade_no'){
    $sql = "trade_no = {$_GET['kw']}";
}elseif($_GET['type'] == 'ip'){
    $sql = "ip = '{$_GET['kw']}'";
}else{
    $sql = '1';
}
$numrows=$DB->count("SELECT count(*) from website_pay where {$sql} and user='".$udata['uid']."'");
?>
<!--页面主要内容-->
<main class="lyear-layout-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>资金明细</h4>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>系统目前有</strong> <?php echo $numrows;?> <strong>条记录</strong>
                        </div>
                        <form action="?" method="GET">
                            <div class="row">
                                <div class="col-xs-4 col-sm-4">
                                    <select name="type" class="form-control" default="<?php echo $_GET['type']?$_GET['type']:'null';?>">
                                        <option value="null">请选择查找方式</option>
                                        <option value="trade_no">订单号</option>
                                        <option value="type">支付方式</option>
                                        <option value="id">订单ID</option>
                                        <option value="status">订单状态</option>
                                        <option value="ip">IP地址</option>
                                    </select>
                                </div>
                                <div class="col-xs-4 col-sm-4">
                                    <input type="text" class="form-control" name="kw" placeholder="输入匹配内容" value="<?php echo $_GET['kw'];?>">
                                </div>
                                <div class="col-xs-4 col-sm-4">
                                    <button type="submit" class="btn-block btn-round btn btn-success">搜索</button>
                                </div>
                            </div>
                        </form>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>订单号</th>
                                        <th>类型</th>
                                        <th>发起时间</th>
                                        <th>支付时间</th>
                                        <th>金额</th>
                                        <th>商品</th>
                                        <th>IP</th>
                                        <th>状态</th>
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
                                    $rs=$DB->query("SELECT * FROM website_pay WHERE {$sql} and user='".$udata['uid']."' order by id desc limit $offset,$pagesize");
                                    while($res = $DB->fetch($rs)){
                                        if($res['status']==0){
                                            $status = '<a href="javascript:budan('.$res['id'].')" class="btn btn-round btn-danger btn-xs">未支付</a>';
                                        }else{
                                            $status = '<span class="btn btn-round btn-info btn-xs">已支付</span>';
                                        }
                                        echo '
                                            <tr>
                                                <td><b>'.$res['id'].'</b></td>
                                                <td>'.$res['trade_no'].'</td>
                                                <td>'.$res['type'].'</td>
                                                <td>'.$res['addtime'].'</td>
                                                <td>'.$res['endtime'].'</td>
                                                <td>'.$res['money'].'</td>
                                                <td>'.$res['name'].'</td>
                                                <td>
                                                    <a href="javascript:city('.$res['id'].')">'.$res['ip'].'</a>
                                                </td>
                                                <td>'.$status.'</td>
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
                        if(isset($_GET['type'])){
                            echo '<li><a href="type='.$_GET['type'].'&kw='.$_GET['kw'].'&page='.$i.$link.$url.'">'.$i .'</a></li>';
                        }else{
                            echo '<li><a href="?page='.$i.$link.$url.'">'.$i .'</a></li>';
                        }
                        echo '<li class="disabled"><a>'.$page.'</a></li>';
                        for ($i=$page+1;$i<=$pages;$i++)
                        if(isset($_GET['type'])){
                            echo '<li><a href="?type='.$_GET['type'].'&kw='.$_GET['kw'].'&page='.$i.$link.$url.'">'.$i .'</a></li>';
                        }else{
                            echo '<li><a href="?page='.$i.$link.$url.'">'.$i .'</a></li>';
                        }
                        if ($page<$pages){
                            if(isset($_GET['type'])){
                                echo '<li><a href="?type='.$_GET['type'].'&kw='.$_GET['kw'].'&page='.$next.$link.$url.'">&raquo;</a></li>';
                                echo '<li><a href="?type='.$_GET['type'].'&kw='.$_GET['kw'].'&page='.$last.$link.$url.'">尾页</a></li>';
                            }else{
                                echo '<li><a href="?page='.$next.$link.$url.'">&raquo;</a></li>';
                                echo '<li><a href="?page='.$last.$link.$url.'">尾页</a></li>';
                            }
                        } else {
                            echo '<li class="disabled"><a>&raquo;</a></li>';
                            echo '<li class="disabled"><a>尾页</a></li>';
                        }
                        echo '</center>';
                        echo'</ul>';
                    ?>
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
    var items = $("select[default]");
    for (i = 0; i < items.length; i++) {
        $(items[i]).val($(items[i]).attr("default")||0);
    }
    function city(id){
        var ii = layer.load(0, {shade:[0.1,'#fff']});
        $.ajax({
		    type : "POST",
			url : "ajax_my.php?act=get_city_my_pay&id="+id,
			data : {},
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
			    layer.msg(data.msg)
			},
			error:function(data){
				layer.close(ii);
				layer.msg('服务器错误！');
				return false;
			}
        });
    };
    function budan(id){
        var ii = layer.load(0, {shade:[0.1,'#fff']});
        $.ajax({
		    type : "POST",
			url : "ajax_my.php?act=pay_budan&id="+id,
			data : {},
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
			    layer.msg(data.msg)
			    if(data.code==1){
			        setTimeout(function () {
			            location.href=data.url;
			            }, 2000);
			    }
			},
			error:function(data){
				layer.close(ii);
				layer.msg('服务器错误！');
				return false;
			}
        });
    };
</script>
</script>

</body>
</html>