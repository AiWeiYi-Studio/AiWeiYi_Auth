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
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login_index.php';</script>");
if($_GET['type'] == 'uid'){
    $sql = "user = {$_GET['kw']}";
}elseif($_GET['type'] == 'id'){
    $sql = "id = {$_GET['kw']}";
}elseif($_GET['type'] == 'uuid'){
    $sql = "uuid = '{$_GET['kw']}'";
}elseif($_GET['type'] == 'contact'){
    $sql = "contact = '{$_GET['kw']}'";
}else{
    $sql = '1';
}
$numrows=$DB->count("SELECT count(*) from website_legal where {$sql}");
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
                        <form action="?" method="GET">
                            <div class="row">
                                <div class="col-xs-4 col-sm-4">
                                    <select name="type" class="form-control" default="<?php echo $_GET['type']?$_GET['type']:'null';?>">
                                        <option value="null">请选择查找方式</option>
                                        <option value="contact">联系方式</option>
                                        <option value="uuid">识别码</option>
                                        <option value="uid">用户UID</option>
                                        <option value="id">ID</option>
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
                                        <th>添加时间</th>
                                        <th>到期时间</th>
                                        <th>隶属程序</th>
                                        <th>识别码</th>
                                        <th>隶属用户</th>
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
                                $rs=$DB->query("SELECT * FROM website_legal where {$sql} order by id asc limit $offset,$pagesize");
                                while($res = $DB->fetch($rs)){
                                    $row = $DB->get_row("SELECT * FROM website_user WHERE uid={$res['user']} limit 1");
                                    $row_app = $DB->get_row("SELECT * FROM website_app WHERE id={$res['type']} limit 1");
                                    if($res['active']==0){
                                        $active = ['danger','封禁'];
                                    }else{
                                        $active = ['info','正常'];
                                    }
                                    echo '
                                        <tr>
                                            <td><b>'.$res['id'].'</b></td>
                                            <td>'.$res['date'].'</td>
                                            <td>'.$res['time'].'</td>
                                            <td>'.$row_app['name'].'</td>
                                            <td>'.$res['uuid'].'</td>
                                            <td>
                                                <a href="javascript:user_info('.$row['uid'].')">'.$row['name'].'</a>
                                            </td>
                                            <td>
                                                <a href="javascript:active('.$res['id'].','.$res['active'].')" class="btn btn-round btn-xs btn-'.$active[0].'">'.$active[1].'</a>
                                            </td>
                                            <td>'.$res['contact'].'</td>
                                            <td>
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

<script type="text/javascript" src="../assets/System/admin/js/auth_legal.js?ver=<?php echo VER ?>"></script>

<script src="../assets/Layer/layer.js"></script>

</body>
</html>