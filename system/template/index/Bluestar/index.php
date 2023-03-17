<?php
$users=$DB->count("SELECT count(*) from website_user");
$user=$DB->count("SELECT count(*) from website_user");
$config=$DB->count("SELECT count(*) from website_config");
$log=$DB->count("SELECT count(*) from website_log");
$qq_url='http://wpa.qq.com/msgrd?v=3&uin='.$conf['site_qq'].'&site=qq&menu=yes';
$mail_url='';
$phone_url='';
$site_url=$_SERVER['HTTP_HOST'];
$beian_url='http://beian.miit.gov.cn/';
$xxx1='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$xxx2='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$result = file_get_contents("./template/index/Bluestar/index.json");
$arr = json_decode($result,true);
?>
<!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $conf['site_title'];?></title>
    <link rel="icon" href="./assets/System/icon/favicon.ico" type="image/ico">
    <meta name="keywords" content="<?php echo $conf['site_keywords'];?>">
    <meta name="description" content="<?php echo $conf['site_description'];?>">
    <link rel="stylesheet" href="./template/index/Bluestar/assets/css/all.min.css">
    <link rel="stylesheet" href="./template/index/Bluestar/assets/css/theme.min.css">
    <link rel="stylesheet" href="./assets/FontAwesome/css/font-awesome.min.css">
</head>

<body class="bg-primary">
    <header class="header-transparent" id="header-main">
        <nav class="navbar navbar-main navbar-expand-lg navbar-sticky navbar-transparent navbar-dark bg-dark" id="navbar-main">
            <div class="container">
                <a class="navbar-brand mr-lg-5"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-main-collapse" aria-controls="navbar-main-collapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbar-main-collapse">
                    <ul class="navbar-nav align-items-lg-center">
                        <li class="nav-item ">
                            <a class="nav-link" href="">网站主页</a>
                        </li>
                        <li class="nav-item dropdown dropdown-animate" data-toggle="hover">
                        <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">友情链接</a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-arrow py-0">
                                <div class="list-group">
                                    <a href="javascript:bing()" class="list-group-item list-group-item-action">
                                        <div class="media d-flex align-items-center">
                                            <div class="media-body ml-3">
                                                <h6 class="mb-1">必应搜索</h6>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item dropdown dropdown-animate" data-toggle="hover">
                        <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">旗下网站</a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-arrow py-0">
                                <div class="list-group">
                                    <a href="https://www.ltyv.cn" class="list-group-item list-group-item-action">
                                        <div class="media d-flex align-items-center">
                                            <div class="media-body ml-3">
                                                <h6 class="mb-1">爱唯逸云</h6>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="https://pan.ukyun.cn" class="list-group-item list-group-item-action">
                                        <div class="media d-flex align-items-center">
                                            <div class="media-body ml-3">
                                                <h6 class="mb-1">爱唯逸云盘</h6>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="https://ukyun.cn" class="list-group-item list-group-item-action">
                                        <div class="media d-flex align-items-center">
                                            <div class="media-body ml-3">
                                                <h6 class="mb-1">爱唯逸商城</h6>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="https://pic.ukyun.cn" class="list-group-item list-group-item-action">
                                        <div class="media d-flex align-items-center">
                                            <div class="media-body ml-3">
                                                <h6 class="mb-1">爱唯逸图床</h6>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="https://mall.ukyun.cn" class="list-group-item list-group-item-action">
                                        <div class="media d-flex align-items-center">
                                            <div class="media-body ml-3">
                                                <h6 class="mb-1">爱唯逸商城</h6>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="https://disk.ukyun.cn" class="list-group-item list-group-item-action">
                                        <div class="media d-flex align-items-center">
                                            <div class="media-body ml-3">
                                                <h6 class="mb-1">爱唯逸共享云盘</h6>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="https://phpjm.ukyun.cn" class="list-group-item list-group-item-action">
                                        <div class="media d-flex align-items-center">
                                            <div class="media-body ml-3">
                                                <h6 class="mb-1">爱唯逸云加密</h6>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item dropdown dropdown-animate" data-toggle="hover">
                        <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">其他菜单</a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-arrow py-0">
                                <div class="list-group">
                                    <a href="/page" class="list-group-item list-group-item-action">
                                        <div class="media d-flex align-items-center">
                                            <div class="media-body ml-3">
                                                <h6 class="mb-1">网站地图</h6>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="/page/program" class="list-group-item list-group-item-action">
                                        <div class="media d-flex align-items-center">
                                            <div class="media-body ml-3">
                                                <h6 class="mb-1">程序列表</h6>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item dropdown dropdown-animate" data-toggle="hover">
                            <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">用户中心</a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-arrow py-0">
                                <div class="list-group">
                                    <a href="user/login_index.php" class="list-group-item list-group-item-action">
                                        <div class="media d-flex align-items-center">
                                            <div class="media-body ml-3">
                                                <h6 class="mb-1">用户登录</h6>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="user/login_qq.php" class="list-group-item list-group-item-action">
                                    <div class="media d-flex align-items-center">
                                            <div class="media-body ml-3">
                                                <h6 class="mb-1">QQ 登录</h6>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="user/login_reg.php" class="list-group-item list-group-item-action">
                                        <div class="media d-flex align-items-center">
                                            <div class="media-body ml-3">
                                                <h6 class="mb-1">用户注册</h6>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main>
        <section class="slice  bg-primary" data-separator="rounded-continuous" data-separator-bg="secondary">
            <div class="bg-absolute-cover bg-size--contain d-flex align-items-center">
                <figure class="w-100">
                    <svg preserveaspectratio="none" x="0px" y="0px" viewbox="0 0 1506.3 578.7" xmlns="http://www.w3.org/2000/svg">
                        <path class="shape-fill-purple" d="M 147.269 295.566 C 147.914 293.9 149.399 292.705 151.164 292.431 L 167.694 289.863 C 169.459 289.588 171.236 290.277 172.356 291.668 L 182.845 304.699 C 183.965 306.091 184.258 307.974 183.613 309.64 L 177.572 325.239 C 176.927 326.905 175.442 328.1 173.677 328.375 L 157.147 330.943 C 155.382 331.217 153.605 330.529 152.485 329.137 L 141.996 316.106 C 140.876 314.714 140.583 312.831 141.228 311.165 L 147.269 295.566 Z"></path>
                        <path class="shape-fill-green" d="M 92.927 474.881 C 93.309 473.896 94.187 473.19 95.23 473.028 L 105.002 471.51 C 106.045 471.347 107.096 471.754 107.758 472.577 L 113.959 480.28 C 114.621 481.103 114.794 482.216 114.413 483.201 L 110.841 492.423 C 110.46 493.408 109.582 494.114 108.539 494.277 L 98.767 495.795 C 97.723 495.957 96.673 495.55 96.011 494.727 L 89.81 487.024 C 89.148 486.201 88.975 485.088 89.356 484.103 L 92.927 474.881 Z"></path>
                        <path class="shape-fill-teal" d="M 34.176 36.897 C 34.821 35.231 36.306 34.036 38.071 33.762 L 54.601 31.194 C 56.366 30.919 58.143 31.608 59.263 32.999 L 69.752 46.03 C 70.872 47.422 71.165 49.305 70.52 50.971 L 64.479 66.57 C 63.834 68.236 62.349 69.431 60.584 69.706 L 44.054 72.274 C 42.289 72.548 40.512 71.86 39.392 70.468 L 28.903 57.437 C 27.783 56.045 27.49 54.162 28.135 52.496 L 34.176 36.897 Z"></path>
                        <path class="shape-fill-yellow" d="M 330.588 185.515 C 331.035 184.361 332.064 183.533 333.286 183.344 L 344.736 181.565 C 345.958 181.374 347.189 181.852 347.965 182.815 L 355.23 191.841 C 356.006 192.805 356.209 194.11 355.762 195.264 L 351.578 206.068 C 351.131 207.222 350.102 208.05 348.88 208.24 L 337.43 210.019 C 336.208 210.209 334.977 209.732 334.201 208.768 L 326.936 199.742 C 326.16 198.778 325.957 197.474 326.404 196.32 L 330.588 185.515 Z"></path>
                        <path class="shape-fill-gray-dark" d="M 1417.759 409.863 C 1418.404 408.197 1419.889 407.002 1421.654 406.728 L 1438.184 404.16 C 1439.949 403.885 1441.726 404.574 1442.846 405.965 L 1453.335 418.996 C 1454.455 420.388 1454.748 422.271 1454.103 423.937 L 1448.062 439.536 C 1447.417 441.202 1445.932 442.397 1444.167 442.672 L 1427.637 445.24 C 1425.872 445.514 1424.095 444.826 1422.975 443.434 L 1412.486 430.403 C 1411.366 429.011 1411.073 427.128 1411.718 425.462 L 1417.759 409.863 Z"></path>
                        <path class="shape-fill-orange" d="M 1313.903 202.809 C 1314.266 201.873 1315.1 201.201 1316.092 201.047 L 1325.381 199.604 C 1326.373 199.449 1327.372 199.837 1328.001 200.618 L 1333.895 207.941 C 1334.525 208.723 1334.689 209.782 1334.327 210.718 L 1330.932 219.484 C 1330.57 220.42 1329.735 221.092 1328.743 221.246 L 1319.454 222.689 C 1318.462 222.843 1317.464 222.457 1316.834 221.674 L 1310.94 214.351 C 1310.31 213.569 1310.146 212.511 1310.508 211.575 L 1313.903 202.809 Z"></path>
                        <path class="shape-fill-red" d="M 1084.395 506.137 C 1084.908 504.812 1086.09 503.861 1087.494 503.643 L 1100.645 501.6 C 1102.049 501.381 1103.463 501.929 1104.354 503.036 L 1112.699 513.403 C 1113.59 514.51 1113.823 516.009 1113.31 517.334 L 1108.504 529.744 C 1107.99 531.07 1106.809 532.02 1105.405 532.239 L 1092.254 534.282 C 1090.85 534.5 1089.436 533.953 1088.545 532.845 L 1080.2 522.478 C 1079.309 521.371 1079.076 519.873 1079.589 518.547 L 1084.395 506.137 Z"></path>
                    </svg>
                </figure>
            </div>
            <div class="container position-relative zindex-100">
                <div class="row row-grid justify-content-around align-items-center">
                    <div class="col-lg-6">
                        <div class="pt-lg text-center">
                            <h2 class="h1 text-white mb-3"><span class="text-white typed" id="type-example" data-type-this="爱唯逸,网络科技,智能,安全,稳定,简约,新UI"></span></h2>
                            <h2 class="h1 text-white mb-3"><?php echo $conf['site_title'];?></h2>
                            <h4 class="h4 text-white mb-3">我们的宗旨</h4>
                            <p class="lead text-white lh-180">坚持诚信、注重业绩、沟通从心开始</p>
                            <div class="mt-5">
                                <a href="./user/login_reg.php" class="btn btn-warning btn-circle btn-translate--hover mr-4">立即注册</a>
                                <a href="./user/login_index.php" class="btn btn-outline-white btn-circle btn-translate--hover">立即使用</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="slice slice-lg" style="background-color: white;">
            <div class="container">
                <div class="mb-md text-center">
                    <h3 class="h3 mt-4">我们的系统优势</h3>
                    <div class="fluid-paragraph text-center mt-4">
                        <p class="lead lh-180">安全 稳定 简约 新UI</p>
                    </div>
                </div>
                <div class="row row-grid">
                    <div class="col-lg-4">
                        <div class="card shadow shadow-lg--hover">
                            <div class="py-5 text-center">
                                <div class="icon icon-xl icon-shape rounded-circle icon-teal">
                                    <i class="fa fa-comments-o"></i>
                                </div>
                            </div>
                            <div class="px-4 pb-5 text-center">
                                <h5 class="font-weight-bold">客服支持</h5>
                                <p class="mt-2">支持售前咨询与售后服务</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card shadow shadow-lg--hover">
                            <div class="py-5 text-center">
                                <div class="icon icon-xl icon-shape rounded-circle icon-pink">
                                    <i class="fa fa-cloud"></i>
                                </div>
                            </div>
                            <div class="px-4 pb-5 text-center">
                                <h5 class="font-weight-bold">智能云端</h5>
                                <p class="mt-2">智能验证授权，智能分配更新</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card shadow shadow-lg--hover">
                            <div class="py-5 text-center">
                                <div class="icon icon-xl icon-shape rounded-circle icon-yellow">
                                    <i class="fa fa-lock"></i>
                                </div>
                            </div>
                            <div class="px-4 pb-5 text-center">
                                <h5 class="font-weight-bold">安全可靠</h5>
                                <p class="mt-2">高效优化方式，告别隐私泄露</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card shadow shadow-lg--hover">
                            <div class="py-5 text-center">
                                <div class="icon icon-xl icon-shape rounded-circle icon-red">
                                    <i class="fa fa-cloud-download" aria-hidden="true"></i>
                                </div>
                            </div>
                            <div class="px-4 pb-5 text-center">
                                <h5 class="font-weight-bold">在线下载</h5>
                                <p class="mt-2">快速在线下载程序源码文件</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card shadow shadow-lg--hover">
                            <div class="py-5 text-center">
                                <div class="icon icon-xl icon-shape rounded-circle icon-blue">
                                    <i class="fa fa-code"></i>
                                </div>
                            </div>
                            <div class="px-4 pb-5 text-center">
                                <h5 class="font-weight-bold">专业维护</h5>
                                <p class="mt-2">专业团队用心维护程序</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card shadow shadow-lg--hover">
                            <div class="py-5 text-center">
                                <div class="icon icon-xl icon-shape rounded-circle icon-purple">
                                    <i class="fa fa-shopping-cart"></i>
                                </div>
                            </div>
                            <div class="px-4 pb-5 text-center">
                                <h5 class="font-weight-bold">在线购买</h5>
                                <p class="mt-2">用户中心支持在线购买功能</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="slice slice-lg" style="background-color: #afb4db;">
            <div class="container">
                <div class="row row-grid align-items-center">
                    <div class="col-md-6 ml-lg-auto">
                        <img src="../template/index/Bluestar/assets/images/zs.png" style="width: 100%">
                    </div>
                    <div class="col-md-6 col-lg-5  ml-lg-auto ">
                        <div class="pr-md-4">
                            <h3 class="heading h3">全客户端支持</h3>
                            <p class="lead text-gray my-4">告别繁琐操作</p>
                            <p class="lead text-gray my-4">注册购买一步搞定</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
         <section class="slice slice-lg" style="background-color: #afb4db;">
            <div class="container">
                <div class="row row-grid align-items-center">
                    <div class="col-md-6  order-lg-2 ml-lg-auto ">
                        <img src="../template/index/Bluestar/assets/images/zs2.png" style="width: 100%">
                    </div>
                    <div class="col-md-6 col-lg-5  order-lg-1 ">
                        <div class="pr-md-4">
                            <h3 class="heading h3">强大的云服务支持</h3>
                            <p class="lead text-gray my-4">精选优质服务供应商</p>
                            <p class="lead text-gray my-4">无须担心高峰拥堵</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="slice slice-lg" style="background-color:white;">
            <div class="container pt-lg">
                <div class="mb-md text-center">
                    <h3><span class="font-weight-bolder">服务流程</span></h3>
                    <div class="fluid-paragraph text-center mt-4">
                        <p class="lead lh-180">建站顾问一对一服务，专业规范，用心服务</p>
                    </div>
                </div>
                <div class="row row-grid justify-content-center">
                    <div class="col-md-6 col-lg-4">
                        <div class="card  shadow--hover">
                            <div class="px-5 py-5">
                                <div class="icon text-info">
                                    <i class="fa fa-pencil-square-o"></i>
                                </div>
                            </div>
                            <div class="px-5 pb-5">
                                <h5 class="">需求调研</h5>
                                <p class=" mt-2">客户市场目标需求、产品业务需求、设计风格、品牌需求以及内容资料的选用</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="card bg-primary shadow-primary  shadow--hover">
                            <div class="px-5 py-5">
                                <div class="icon text-white">
                                    <i class="fa fa-connectdevelop"></i>
                                </div>
                            </div>
                            <div class="px-5 pb-5">
                                <h5 class="text-white">程序开发</h5>
                                <p class="text-white mt-2">为了最大限度的满足客户、管理系统具备高安全性、高扩展性、高稳定性</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="card  shadow--hover">
                            <div class="px-5 py-5">
                                <div class="icon text-info">
                                <i class="fa fa-support"></i>
                                </div>
                            </div>
                            <div class="px-5 pb-5">
                                <h5 class="">售后服务</h5>
                                <p class="mt-2">我们的售后专员实时与 客户沟通，能够及时解 决客户所反馈的问题， 保证售后无忧。</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="slice slice-lg" style="background-color: white;">
            <div class="container">
                <div class="row justify-content-center align-items-center">
                    <div class="col-lg-8 text-center">
                        <h3 class="font-weight-400">立刻注册<span class="font-weight-700"> 领取优惠大礼包</span></h3>
                        <div class="mt-5">
                        <a href="user/login_reg.php" class="btn btn-primary btn-circle btn-translate--hover px-4">免费注册</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
        <footer class="footer footer-dark bg-gradient-primary" style="background-color: #2b4490;">
        <div class="container">
            <div class="row align-items-center justify-content-md-between py-4 mt-4 delimiter-top">
                        CopyRight &copy; <?php echo $conf['site_copyright'];?> <a href="https://beian.miit.gov.cn/">桂ICP备20004954号-1</a>
                    </div>
                </div>
        </footer>
    <script src="./template/index/Bluestar/assets/js/jquery-2.1.1.js"></script>
    <script src="./template/index/Bluestar/assets/js/typed.min.js"></script>
    <script src="./template/index/Bluestar/assets/js/bootstrap.bundle.min.js"></script>
    <script src="./template/index/Bluestar/assets/js/jquery.fancybox.min.js"></script>
    <script src="./template/index/Bluestar/assets/js/theme.min.js"></script>
    <script src="./template/index/Bluestar/assets/js/swiper.min.js"></script>
    <script src="./assets/LightYear/js/jquery.min.js"></script>
    <script src="./assets/Layer/layer.js"></script>
    <script>
    <?php if($conf['site_notice']!=NULL){?>
    //默认弹窗提醒
    layer.msg('<?php echo $conf['site_notice'];?>', {
      time: 5000, //2s后自动关闭
    });
    <?php }?>
    //必应搜索
    function bing(){
        layer.open({
          type: 2,
          title: 'Bing',
          shadeClose: true,
          shade: false,
          maxmin: true, //开启最大化最小化按钮
          area: ['380px', '600px'],
          content: 'https://www.bing.com/'
        });
    };
    </script>
</body>
</html>