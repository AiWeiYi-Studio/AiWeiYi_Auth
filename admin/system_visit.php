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
$title='聊天室配置';
include './page_head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login_index.php';</script>");
$numrows=$DB->count("SELECT count(*) from website_visit");
?>
<!--页面主要内容-->
<main class="lyear-layout-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>聊天记录</h4>
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
                                        <th>时间</th>
                                        <th>IP</th>
                                        <th>类型</th>
                                        <th>路径</th>
                                        <th>域名</th>
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
                                        $rs=$DB->query("SELECT * FROM website_visit order by id desc limit $offset,$pagesize");
                                        while($res = $DB->fetch($rs)){
                                            echo '
                                                <tr>
                                                    <td>
                                                        <b>'.$res['id'].'</b>
                                                    </td>
                                                    <td>
                                                        '.$res['date'].'
                                                    </td>
                                                    <td>
                                                        '.$res['ip'].'
                                                    </td>
                                                    <td>
                                                        '.$res['type'].'
                                                    </td>
                                                    <td>
                                                        '.$res['url_limit'].'
                                                    </td>
                                                    <td>
                                                        '.$res['url_all'].'
                                                    </td>
                                                </tr>
                                            ';
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <?php
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
                            echo'</ul>';
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