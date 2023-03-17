<?php
$title = '知识文档';
include("../../system/core/core.php");
if($conf['site_active']=='1'){
    sysmsg('<h2>网站维护已开启</h2><ul><li><font size="4">'.$conf['site_active_notice'].'</font></li>',true);
}
if($conf['rewrite_book']=='1'){
    $head = '/book/index.html';
}else{
    $head = '/page/book/index.php';
}
?>
<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
    <title><?php echo $title;?> - <?php echo $conf['site_title'];?></title>
    <link rel="icon" href="../../assets/System/icon/favicon.ico" type="image/ico">
    <meta name="keywords" content="<?php echo $conf['site_keywords'];?>">
    <meta name="description" content="<?php echo $conf['site_description'];?>">
    <link rel="stylesheet" type="text/css" href="../../assets/Layui/css/layui.css"/>
    <style>
    .imgc {
        background-image: url(../../assets/System/img/bj.jpg);
        background-size: 100% 100%;
        background-repeat: repeat;
        top: 0;
        position: fixed;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: -33
    }
    .project-list-item {
        background-color: #fff;
        border: 1px solid #e8e8e8;
        border-radius: 6px;
        cursor: pointer;
        transition: all .2s;
    }
    .project-list-item:hover {
        box-shadow: 0 2px 10px rgba(0, 0, 0, .15);
    }
    .project-list-item .project-list-item-cover {
        width: 100%;
        height: 150px;
        display: block;
        border-top-left-radius: 4px;
        border-top-right-radius: 4px;
    }
    .project-list-item-body {
        padding: 20px;
    }
    .project-list-item .project-list-item-body > h2 {
        font-size: 18px;
        color: #333;
        margin-bottom: 12px;
    }
    .project-list-item .project-list-item-text {
        height: 40px;
        overflow: hidden;
        margin-bottom: 10px;
    }
    .project-list-item .project-list-item-desc {
        position: relative;
    }
    .project-list-item .project-list-item-desc .time {
        color: #999;
        font-size: 12px;
    }
    .project-list-item .project-list-item-desc .ew-head-list {
        position: absolute;
        right: 0;
        top: 0;
    }
    .project-list-item-desc{
        min-height:21px;
    }
    .ew-head-list .ew-head-list-item {
        width: 22px;
        height: 22px;
        border-radius: 50%;
        border: 1px solid #fff;
        margin-left: -10px;
    }
    .ew-head-list .ew-head-list-item:first-child {
        margin-left: 0;
    }
    .form-item-title {
        text-align: center;
        position: relative;
    }
    .form-item-title:before {
        content: "";
        position: absolute;
        border-top: 1px dashed #ccc;
        left: 40px;
        right: 40px;
        top: 8px;
        z-index: -1;
    }
    .form-item-title > span {
        background-color: white;
        padding: 0 10px;
        font-size: 13px;
        color: #666;
    }
    </style>
</head>
<body layadmin-themealias="dark-blue" style="margin-top:2em;">
    <div class="imgc"></div>
    <div class="layui-fluid">
        <div class="layui-col-sm10 layui-col-sm-offset1">
            <div class="layui-card">
                <div class="layui-tab layui-tab-brief">
                    <div class="layui-card-header" style="height: 3em; line-height: 3em;">
                        <h3>
                            <i class="layui-icon layui-icon-app"></i>
                            <a href="/">网站首页</a> \ <a href="<?php echo $head;?>">知识文档</a>
                        </h3>
                    </div>
                    <div class="layui-tab-item layui-show">
                        <div class="layui-row layui-col-space">
                            <?php
                                $numrows=$DB->count("SELECT count(*) from website_class_book WHERE status ='1'");
                                $pagesize=6;
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
                                $rs=$DB->query("SELECT * FROM website_class_book WHERE status ='1' order by id asc limit $offset,$pagesize");
                                while($res = $DB->fetch($rs)){
                                    $book_number = $DB->count("SELECT count(*) from website_book where class = '{$res['id']}'");
                                    if($conf['rewrite_book']=='1'){
                                        $jump_url = '/book/'.$res['id'].'.html';
                                    }else{
                                        $jump_url = '/page/book/page.php?class='.$res['id'];
                                    }
                                    echo '
                                        <div class="layui-col-md4">
                                            <div class="project-list-item" style="margin:20px">
                                                <img class="project-list-item-cover" src="'.$res['img'].'"/>
                                                <div class="project-list-item-body">
                                                    <h2><b>'.$res['name'].'</b></h2>
                                                    <div class="project-list-item-desc">
                                                        发布时间：<span style="color:red;">'.date('Y-m-d',strtotime($res['date'])).'</span>
                                                        文档数：<span style="color:pink;">'.$book_number.'</span>
                                                        浏览量：<span style="color:green;">'.$res['number'].'</span>
                                                    </div>
                                                    <br/>
                                                    <div class="project-list-item-text">
                                                        '.$res['title'].'
                                                    </div>
                                                    <div style="text-align:center;">
                                                        <a href="'.$jump_url.'" class="layui-btn layui-btn-normal">进入阅读</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    ';
                                }
                            ?>
                        </div>
                         <div style="text-align:center;" class="layui-btn-container">
                            <?php
                                $first=1;
                                $prev=$page-1;
                                $next=$page+1;
                                $last=$pages;
                                if ($page>1){
                                    echo '<a href="?page='.$first.$link.$url.'" class="layui-btn layui-btn-sm layui-btn-normal">首页</a>';
                                    echo '<a href="?page='.$prev.$link.$url.'" class="layui-btn layui-btn-sm layui-btn-normal">&laquo;</a>';
                                } else {
                                    echo '<a class="layui-btn layui-btn-sm layui-btn-disabled">首页</a>';
                                    echo '<a class="layui-btn layui-btn-sm layui-btn-disabled">&laquo;</a>';
                                }
                                for ($i=1;$i<$page;$i++)
                                echo '<a href="?page='.$i.$link.$url.'" class="layui-btn layui-btn-sm layui-btn-normal">'.$i .'</a>';
                                echo '<a href="" class="layui-btn layui-btn-sm layui-btn-disabled">'.$page.'</a>';
                                for ($i=$page+1;$i<=$pages;$i++)
                                echo '<a href="?page='.$i.$link.$url.'" class="layui-btn layui-btn-sm layui-btn-normal">'.$i .'</a>';
                                if ($page<$pages){
                                    echo '<a href="?page='.$next.$link.$url.'" class="layui-btn layui-btn-sm layui-btn-normal">&raquo;</a>';
                                    echo '<a href="?page='.$last.$link.$url.'" class="layui-btn layui-btn-sm layui-btn-normal">尾页</a>';
                                } else {
                                    echo '<a class="layui-btn layui-btn-sm layui-btn-disabled">&raquo;</a>';
                                    echo '<a class="layui-btn layui-btn-sm layui-btn-disabled">尾页</a>';
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="../../assets/Layui/layui.js"></script>
</body>
</html>