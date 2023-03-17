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
$title='快捷登录配置';
include './page_head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login_index.php';</script>");
$mod=isset($_GET['mod'])?$_GET["mod"]:index;
?>

<!--页面主要内容-->
<main class="lyear-layout-content">
    <div class="container-fluid">
        <?php if($mod=='index'){?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="./set_oauth.php">信息配置</a></li>
                            <li><a href="?mod=qq">QQ官方</a></li>
                            <li><a href="?mod=clogin">彩虹免签</a></li>
                        </ul>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="text">QQ</label>
                                        <select class="form-control" id="qq" default="<?php echo $conf['oauth_api_qq'];?>">
                                            <option value="0">关闭</option>
                                            <option value="1">QQ官方</option>
                                            <option value="2">彩虹免签</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="text">支付宝</label>
                                        <select class="form-control" id="alipay" default="<?php echo $conf['oauth_api_alipay'];?>">
                                            <option value="0">关闭</option>
                                            <option value="2">彩虹免签</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="text">微信</label>
                                        <select class="form-control" id="wechat" default="<?php echo $conf['oauth_api_wechat'];?>">
                                            <option value="0">关闭</option>
                                            <option value="2">彩虹免签</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="text">微博</label>
                                        <select class="form-control" id="weibo" default="<?php echo $conf['oauth_api_weibo'];?>">
                                            <option value="0">关闭</option>
                                            <option value="2">彩虹免签</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <a href="javascript:api()" class="btn-block btn-round btn btn-success">确定修改</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php }elseif($mod=='qq'){?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <ul class="nav nav-tabs">
                            <li><a href="./set_oauth.php">信息配置</a></li>
                            <li class="active"><a href="?mod=qq">QQ官方</a></li>
                            <li><a href="?mod=clogin">彩虹免签</a></li>
                        </ul>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="text">APPID</label>
                                <input type="text" id="appid"class="form-control" value="<?php echo $conf['oauth_qq_appid'];?>">
                            </div>
                            <div class="form-group">
                                <label for="text">APPKEY</label></label>
                                <input type="text" id="appkey"class="form-control" value="<?php echo $conf['oauth_qq_appkey'];?>">
                            </div>
                            <div class="form-group">
                                <label for="text">CALLBACK</label></label>
                                <input type="text" id="callback"class="form-control" value="<?php echo $conf['oauth_qq_callback'];?>">
                            </div>
                            <div class="form-group">
                                <a href="javascript:qq()" class="btn-block btn-round btn btn-success">确定修改</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php }elseif($mod=='clogin'){?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <ul class="nav nav-tabs">
                            <li><a href="./set_oauth.php">信息配置</a></li>
                            <li><a href="?mod=qq">QQ官方</a></li>
                            <li class="active"><a href="?mod=clogin">彩虹免签</a></li>
                        </ul>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="text">API</label>
                                <input type="text" id="url" class="form-control" value="<?php echo $conf['oauth_clogin_url'];?>">
                            </div>
                            <div class="form-group">
                                <label for="text">APPID</label>
                                <input type="text" id="appid"class="form-control" value="<?php echo $conf['oauth_clogin_appid'];?>">
                            </div>
                            <div class="form-group">
                                <label for="text">APPKEY</label></label>
                                <input type="text" id="appkey"class="form-control" value="<?php echo $conf['oauth_clogin_appkey'];?>">
                            </div>
                            <div class="form-group">
                                <label for="text">CALLBACK</label></label>
                                <input type="text" id="appkey"class="form-control" value="<?php echo $_SERVER['HTTP_HOST'];?>" disabled="disabled">
                            </div>
                            <div class="form-group">
                                <a href="javascript:clogin()" class="btn-block btn-round btn btn-success">确定修改</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php }?>
    </div>
</main>

<script type="text/javascript" src="../assets/LightYear/js/jquery.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/perfect-scrollbar.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/main.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/jquery.cookie.min.js"></script>

<script type="text/javascript" src="../assets/Layer/layer.js"></script>

<script type="text/javascript" src="../assets/System/admin/js/set_oauth.js?ver=<?php echo VER ?>"></script>

</body>
</html>