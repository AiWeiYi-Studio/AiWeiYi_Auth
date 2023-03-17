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
$title='程序列表';
include './page_head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login_index.php';</script>");
$numrows=$DB->count("SELECT count(*) from website_app");
?>
<!--页面主要内容-->
<main class="lyear-layout-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>程序列表</h4>
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
                                        <th>名称</th>
                                        <th>版本</th>
                                        <th>版本号</th>
                                        <th>添加时间</th>
                                        <th>状态</th>
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
                                $rs=$DB->query("SELECT * FROM website_app order by id asc limit $offset,$pagesize");
                                while($res = $DB->fetch($rs)){
                                    $row_update = $DB->get_row("SELECT * FROM website_update where id = (select max(id) from website_update where app = '".$res['id']."') limit 1");
                                    $edition = $row_update['edition']?$row_update['edition']:'暂无';
                                    $version = $row_update['version']?$row_update['version']:'暂无';
                                    if($res['status']==0){
                                        $status = '<a href="javascript:status('.$res['id'].')" class="btn btn-round btn-xs btn-danger">关闭</a>';
                                    }else{
                                        $status = '<a href="javascript:status('.$res['id'].')" class="btn btn-round btn-xs btn-info">正常</a>';
                                    }
                                    echo '
                                        <tr>
                                            <td><b>'.$res['id'].'</b></td>
                                            <td>'.$res['name'].'</td>
                                            <td>'.$edition.'</td>
                                            <td>'.$version.'</td>
                                            <td>'.$res['date'].'</td>
                                            <td>'.$status.'</td>
                                            <td>
                                                <a href="javascript:money('.$res['id'].')" class="btn btn-round btn-xs btn-info">价格</a>
                                                <a href="javascript:release('.$res['id'].')" class="btn btn-round btn-xs btn-yellow">安装包</a>
                                                <a href="./auth_add.php?mod=add_update&app='.$res['id'].'" class="btn btn-round btn-xs btn-success">更新</a>
                                                <a href="./auth_add.php?mod=add_auth&app='.$res['id'].'" class="btn btn-round btn-xs btn-brown">授权</a>
                                                <a href="./auth_set.php?id='.$res['id'].'" class="btn btn-round btn-xs btn-warning">编辑</a>
                                                <a href="javascript:del('.$res['id'].')" class="btn btn-round btn-xs btn-cyan">删除</a>
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

<script type="text/javascript" src="../assets/System/admin/js/auth_app.js?ver=<?php echo VER ?>"></script>

<script src="../assets/Layer/layer.js"></script>

</body>
</html>