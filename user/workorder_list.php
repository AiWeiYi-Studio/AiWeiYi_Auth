<?php
/*
* @Time    : 2022/05/22 20:57
* @Author  : 爱唯逸网络科技
* @Mail    : support@857xx.cn
* @Site    : https://web.857xx.cn
* @File    : workorder_list.php
* @Action  : 工单列表
*/

include("../system/core/core.php");
$title='工单列表';
include './page_head.php';
if($islogins==1){}else exit("<script language='javascript'>window.location.href='./login_index.php?go_url=".get_url_last()."';</script>");
$numrows=$DB->count("SELECT count(*) from website_workorder where user = '{$udata['uid']}'");
?>
<!--页面主要内容-->
<main class="lyear-layout-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>悄悄话列表</h4>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>系统目前有<?php echo $numrows;?>条记录</strong>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>问题类型</th>
                                        <th>工单标题</th>
                                        <th>发起时间</th>
                                        <th>关闭时间</th>
                                        <th>工单状态</th>
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
                                        $rs=$DB->query("SELECT * FROM website_workorder where user = '{$udata['uid']}' order by id desc limit $offset,$pagesize");
                                        while($res = $DB->fetch($rs)){
                                            $row = $DB->get_row("select * from website_class_workorder where id = '{$res['type']}'");
                                            $name = $row['name']?$row['name']:'未知';
                                            if($res['status'] == 0){
                                                $status = '待回复';
                                            }else{
                                                $status = '已关闭';
                                            }
                                            echo '
                                                <tr>
                                                    <td><b>'.$res['id'].'</b></td>
                                                    <td>'.$name.'</td>
                                                    <td>'.$res['title'].'</td>
                                                    <td>'.$res['date_add'].'</td>
                                                    <td>'.$res['date_end'].'</td>
                                                    <td>'.$status.'</td>
                                                    <td>
                                                        <a href="./workorder_reply.php?id='.$res['id'].'" class="btn btn-round btn-xs btn-warning">查看</a>
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
                            echo '';
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

<script src="../assets/Layer/layer.js"></script>

</body>
</html>