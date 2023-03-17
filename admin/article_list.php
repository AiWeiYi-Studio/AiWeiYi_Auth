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
$title='文章列表';
include './page_head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login_index.php';</script>");
$mod=isset($_GET['mod'])?$_GET["mod"]:'list';
$numrows=$DB->count("SELECT count(*) from website_article");
?>
<!--页面主要内容-->
<main class="lyear-layout-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>文章列表</h4>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>系统目前有</strong> <?php echo $numrows;?> <strong>篇文章</strong>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>名称</th>
                                        <th>时间</th>
                                        <th>浏览量</th>
                                        <th>状态</th>
                                        <th>排序</th>
                                        <th>操作</th>
                                    </tr>
                                </thead>
                            <tbody>
                            <?php
                            $rs=$DB->query("SELECT * FROM website_article order by uid asc");
                            while($res = $DB->fetch($rs)){
                                if($res['active']=='1'){
                                    $active='显示';
                                }else{
                                    $active='隐藏';
                                }
                                if($conf['rewrite_program']=='1'){
                                    $jump_url = '/program/';
                                    $s = '.html';
                                }else{
                                    $jump_url = '/page/program/page.php?id=';
                                }
                                echo '
                                <tr>
                                    <td><b>'.$res['id'].'</b></td>
                                    <td>'.$res['title'].'</td>
                                    <td>'.$res['time'].'</td>
                                    <td>'.$res['number'].'</td>
                                    <td>'.$active.'</td>
                                    <td>
                                        <a href="javascript:uid('.$res['id'].',0)" class="mdi mdi-arrow-up" title="移到顶部"></a>
                                        <a href="javascript:uid('.$res['id'].',1)" class="mdi mdi-arrow-up-box" title="移到上一行"></a>
                                        <a href="javascript:uid('.$res['id'].',2)" class="mdi mdi-arrow-down-box" title="移到下一行"></a>
                                        <a href="javascript:uid('.$res['id'].',3)" class="mdi mdi-arrow-down" title="移到底部"></a>
                                    </td>
                                    <td>
                                        <a href="javascript:del('.$res['id'].')" class="btn btn-danger btn-xs">删除</a>
                                        <a href="./article_edit.php?id='.$res['id'].'" class="btn btn-info btn-xs">编辑</a>
                                        <a href="'.$jump_url.$res['id'].$s.'" target="_blank" class="btn btn-info btn-xs">查看</a>
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
<script type="text/javascript" src="../assets/System/admin/js/article_list.js?ver=<?php echo VER ?>"></script>

</body>
</html>