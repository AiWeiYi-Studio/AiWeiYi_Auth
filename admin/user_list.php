<?php
/*
* @Time    : 2022/05/22 20:57
* @Author  : 爱唯逸网络科技
* @Mail    : support@857xx.cn
* @Site    : https://web.857xx.cn
* @File    : auth_name.php
* @Action  : 程序昵称配置
*/

include("../system/core/core.php");
$title='用户列表列表';
include './page_head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login_index.php';</script>");
if(isset($_GET['uid'])){
    $sql = "uid = {$_GET['uid']}";
}else{
    $sql = '1';
}
$numrows=$DB->count("SELECT count(*) from website_user where {$sql}");
?>
<!--页面主要内容-->
<main class="lyear-layout-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>用户列表</h4>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>系统目前有</strong> <?php echo $numrows;?> <strong>个用户</strong>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>账号</th>
                                        <th>昵称</th>
                                        <th>余额</th>
                                        <th>积分</th>
                                        <th>类型</th>
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
                                        $rs=$DB->query("SELECT * FROM website_user where {$sql} order by uid desc limit $offset,$pagesize");
                                        while($res = $DB->fetch($rs)){
                                            if($res['active']=='1'){
                                                $active='<a href="javascript:active('.$res['uid'].')">正常</a>';
                                            }else{
                                                $active='<a href="javascript:active('.$res['uid'].')">封禁</a>';
                                            }
                                            if($res['type']=='admin'){
                                                $type = '<a href="javascript:type('.$res['uid'].')">站长</a>';
                                            }else{
                                                $type = '<a href="javascript:type('.$res['uid'].')">用户</a>';
                                            }
                                            echo '
                                                <tr>
                                                    <td><b>'.$res['uid'].'</b></td>
                                                    <td>'.$res['user'].'</td>
                                                    <td>'.$res['name'].'</td>
                                                    <td>
                                                        <a href="javascript:money('.$res['uid'].')">'.$res['money'].'</a>
                                                    </td>
                                                    <td>'.$res['integral'].'</td>
                                                    <td>'.$type.'</td>
                                                    <td>'.$active.'</td>
                                                    <td>
                                                        <a href="javascript:del('.$res['uid'].')" class="btn btn-round btn-xs btn-danger">删除</a>
                                                        <a href="./user_edit.php?uid='.$res['uid'].'" class="btn btn-round btn-xs btn-warning">编辑</a>
                                                        <a href="./user_info.php?uid='.$res['uid'].'" class="btn btn-round btn-xs btn-cyan">详细</a>
                                                        <a href="./auth_legal.php?type=uid&kw='.$res['uid'].'" class="btn btn-round btn-xs btn-pink">授权</a>
                                                        <a href="./user_money_log.php?type=uid&kw='.$res['uid'].'" class="btn btn-round btn-xs btn-info">资金</a>
                                                        <a href="./user_pay.php?type=uid&kw='.$res['uid'].'" class="btn btn-round btn-xs btn-brown">订单</a>
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

<script type="text/javascript" src="../assets/System/admin/js/user_list.js?ver=<?php echo VER ?>"></script>

<script src="../assets/Layer/layer.js"></script>

</body>
</html>
