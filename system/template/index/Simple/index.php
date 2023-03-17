<?php
// 数据库表统计并赋值
$user     = mysql_count('website_user');
$article  = mysql_count('website_article');
$program  = mysql_count('website_program');
$legal    = mysql_count('website_legal');
$log      = mysql_count('website_log');

// 文章伪静态检测
if($conf['rewrite_article'] == '1'){
    $url_article = '/article/index.html';
}else{
    $url_article = ' /page/article/index.php';
}

// 文档伪静态检测
if($conf['rewrite_book'] == '1'){
    $url_book = '/book/index.html';
}else{
    $url_book = ' /page/book/index.php';
}

// 程序伪静态检测
if($conf['rewrite_program'] == '1'){
    $url_program = '/program/index.html';
}else{
    $url_program = '/page/program/index.php';
}
?>
<!DOCTYPE html>
<html lang="zh">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
        <title><?php echo $conf['site_title']?> -  <?php echo $title ?></title>
        <link rel="icon" href="./assets/System/icon/favicon.ico" type="image/ico">
        <meta name="keywords" content="<?php echo $conf['site_keywords']; ?>">
        <meta name="description" content="<?php echo $conf['site_description']?>">
        <link href="<?php echo $arr['assets'];?>css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo $arr['assets'];?>css/materialdesignicons.min.css" rel="stylesheet">
        <link href="<?php echo $arr['assets'];?>css/style.min.css" rel="stylesheet">
        <link rel="stylesheet" href="./assets/FontAwesome/css/font-awesome.min.css">
        <style>
            body {
                background: url("./assets/System/img/bj.jpg") no-repeat center center;
                background-size: cover;
                background-attachment: fixed;
            }
            .transparent_class {
                filter:alpha(opacity=90);
                -moz-opacity:0.90;
                -khtml-opacity: 0.90;
                opacity: 0.90;
            }
        </style>
    </head>
<body>
    <!-- 主体布局 -->
    <div class="container" style="padding-top:50px;">
        <div class="col-xs-12 col-sm-10 col-md-8 col-lg-8 center-block" style="float: none;">
            <!--主菜单开始-->
            <div class="transparent_class">
                <div class="card">
                    <ul class="nav nav-tabs page-tabs">
                        <li style="width: 20%;" align="center"> <a href="<?php echo $url_book;?>">文档</a></li>
                        <li style="width: 20%;" align="center"> <a href="<?php echo $url_program;?>">程序</a></li>
                        <li style="width: 20%;" align="center"> <a href="<?php echo $url_article;?>">文章</a></li>
                        <li style="width: 20%;" align="center"> <a href="./user">后台</a> </li>
                        <li style="width: 20%;" align="center"> <a href="javascript:more()">更多</a> </li>
                    </ul>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="text">程序类型：</label>
                            <select id="app" class="form-control">
                                <option value="0">请选择程序</option>
                                <?php
                                    $rs=$DB->query("SELECT * FROM website_app order by id asc");
                                    while($res = $DB->fetch($rs)){
                                        echo '<option value="'.$res['id'].'">'.$res['name'].'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>识别码</label>
                            <input type="text" id="uuid" placeholder="需要查询的识别码或域名" class="form-control">
                        </div>
                        <div class="form-group">
                            <a href="javascript:chack_auth()" class="btn-block btn-round btn btn-success">查询</a>
                        </div>
                    </div>
                </div>
            </div>
            <!--主菜单结束-->
            <!--多功能菜单开始-->
            <div class="card">
                <ul class="nav nav-tabs page-tabs">
                    <li style="width: 20%;" align="center"><a href="#noticle" data-toggle="tab">公告</a></li>
                    <li style="width: 20%;" align="center"><a href="#urls" data-toggle="tab">友链</a></li>
                    <li style="width: 20%;" align="center"><a href="#tongji" data-toggle="tab">统计</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="noticle">
                        <font size="3" color="#FF00FF" style="text-indent: 1cm;">
                            <?php echo $conf['site_notice'];?>
                        </font>
                    </div>
                    <div class="tab-pane" id="urls">
                        <div class="btn-group btn-group-justified">
                            <a target="_blank" class="btn btn-info" href="/go.html?url=https://www.857xx.cn&back=<?php echo $siteurl;?>">爱唯逸博客</a>
                            <a target="_blank" class="btn btn-danger" href="./go.html?url=https://encrypt.857xx.cn&back=<?php echo $siteurl;?>">爱唯逸加密</a>
                            <a target="_blank" class="btn btn-info" href="/go.html?url=https://bbs.857xx.cn&back=<?php echo $siteurl;?>">爱唯逸论坛</a>
                        </div>
                    </div>
                    <div class="tab-pane" id="tongji">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td align="center">
                                        <font size="2"><?php echo floor((time()-strtotime($conf['site_date']))/86400);?> 天<br>
                                        <font color="#65b1c9"><i class="fa fa-shield fa-2x"></i></font><br>安全运营</font>
                                    </td>
                                    <td align="center">
                                        <font size="2"><?php echo $article;?> 篇<br>
                                        <font color="#65b1c9"><i class="fa fa-book fa-2x"></i></font><br>文章总数</font>
                                    </td>
                                    <td align="center">
                                        <font size="2"><?php echo $program;?> 个<br>
                                        <font color="#65b1c9"><i class="fa fa-cube fa-2x"></i></font><br>程序总数</font>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center">
                                        <font size="2"><?php echo $user;?> 个<br>
                                        <font color="#65b1c9"><i class="fa fa-sitemap fa-2x"></i></font><br>用户总数</font>
                                    </td>
                                    <td align="center">
                                        <font size="2"><?php echo $legal;?> 个<br>
                                        <font color="#65b1c9"><i class="fa fa-ravelry fa-2x"></i></font><br>授权总数</font>
                                    </td>
                                    <td align="center">
                                        <font size="2"><?php echo $log;?> 条<br>
                                        <font color="#65b1c9"><i class="fa fa-american-sign-language-interpreting fa-2x"></i></font><br>日志总数</font>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!--多功能菜单结束-->
        </div>
    </div>
    <div style="color: white;width: 100%;text-align: center;margin-bottom: 2rem;">
        <center>
            <?php if($conf['site_mail']){?>
                <span>
                    <a href="mailto:<?php echo $conf['site_mail'];?>" style="color: white;">邮箱：<?php echo $conf['site_mail'];?></a>
                </span>
            <?php }if($conf['site_qq']){?>
                ||
                <span>
                    <a href="" style="color: white;">QQ：<?php echo $conf['site_qq'];?></a>
                </span>
            <?php }if($conf['site_phone']){?>
                ||
                <span>
                    <a href="" style="color: white;">电话：<?php echo $conf['site_phone'];?></a>
                </span>
            <?php }?>
            <br/>
            <span>
                <img src="./assets/System/img/beian.jpg">
                <a href="http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=45012302000032" style="display:inline-block;text-decoration:none;height:20px;line-height:20px;color: white;" target="_blank">京公网安备 45012302000032号</a>
            </span>
            <a href="http://beian.miit.gov.cn/" style="display:inline-block;text-decoration:none;height:20px;line-height:20px;color: white;" target="_blank"><?php echo $conf['site_beian'];?></a>
            <br/>
            &copy; <?php echo date('Y');?> <?php echo $conf['site_copyright'];?>. 
        </center>
    </div>
    <div id="cc-myssl-id">
        <a href="https://myssl.com/<?php echo $_SERVER['HTTP_HOST'];?>?from=mysslid">
            <img src="https://static.myssl.com/res/images/myssl-id3.png" alt="" style="max-height:50px;display:block;margin:0 auto">
        </a>
    </div>
    
    <script type="text/javascript" src="<?php echo $arr['assets'];?>js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo $arr['assets'];?>js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo $arr['assets'];?>js/perfect-scrollbar.min.js"></script>
    <script type="text/javascript" src="<?php echo $arr['assets'];?>js/main.min.js"></script>
    <script type="text/javascript" src="<?php echo $arr['assets'];?>js/jquery.bootstrap.wizard.min.js"></script>
    <script type="text/javascript" src="./template/index/Simple/assets/js/index.js?ver=<?php echo VER;?>"></script>
    <script src="./assets/System/index/js/index.js?ver=<?php echo VER;?>"></script>
    <script src="./assets/Layer/layer.js"></script>
</body>
</html>