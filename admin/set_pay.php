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
$title='网站信息配置';
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
                            <li class="active"><a href="./set_pay.php">信息配置</a></li>
                            <li><a href="./set_pay.php?mod=epay">易支付</a></li>
                            <li><a href="./set_pay.php?mod=alipay_qrcode">当面付</a></li>
                            <li><a href="./set_pay.php?mod=personal">私下交易</a></li>
                        </ul>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="text">QQ</label>
                                        <select class="form-control" id="qqpay" default="<?php echo $conf['pay_qqpay_api'];?>">
                                            <option value="0">关闭</option>
                                            <option value="1">易支付</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="text">支付宝</label>
                                        <select class="form-control" id="alipay" default="<?php echo $conf['pay_alipay_api'];?>">
                                            <option value="0">关闭</option>
                                            <option value="1">易支付</option>
                                            <option value="2">当面付</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="text">微信</label>
                                        <select class="form-control" id="wxpay" default="<?php echo $conf['pay_wxpay_api'];?>">
                                            <option value="0">关闭</option>
                                            <option value="1">易支付</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="text">私下交易</label>
                                        <select class="form-control" id="personal" default="<?php echo $conf['pay_personal_api'];?>">
                                            <option value="0">关闭</option>
                                            <option value="1">打开</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="text">最低充值金额</label>
                                <input type="text" id="little" name="little" class="form-control" value="<?php echo $conf['pay_money_little'];?>">
                            </div>
                            <div class="form-group">
                                <label for="text">最大充值金额</label>
                                <input type="text" id="big" name="big" class="form-control" value="<?php echo $conf['pay_money_big'];?>">
                            </div>
                            <div class="form-group">
                                <a href="javascript:info()" class="btn-block btn-round btn btn-success">确定修改</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php }elseif($mod=='epay'){
            $result = file_get_contents(CORE."plugin/AiWeiYi_Epay/config.json");
            $arr    = json_decode($result,true);
        ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <ul class="nav nav-tabs">
                            <li><a href="./set_pay.php">信息配置</a></li>
                            <li class="active"><a href="./set_pay.php?mod=epay">易支付</a></li>
                            <li><a href="./set_pay.php?mod=alipay_qrcode">当面付</a></li>
                            <li><a href="./set_pay.php?mod=personal">私下交易</a></li>
                        </ul>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="text">API</label>
                                <input type="text" id="api" class="form-control" value="<?php echo $arr['api'];?>" placeholder="请输入易支付网址">
                            </div>
                            <div class="form-group">
                                <label for="text">APPID</label>
                                <input type="text" id="appid"class="form-control" value="<?php echo $arr['appid'];?>" placeholder="请输入易支付商户id">
                            </div>
                            <div class="form-group">
                                <label for="text">APPKEY</label></label>
                                <input type="text" id="appkey"class="form-control" value="<?php echo $arr['appkey'];?>" placeholder="请输入易支付商户密钥">
                            </div>
                            <div class="form-group">
                                <a href="javascript:epay()" class="btn-block btn-round btn btn-success">确定修改</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php }elseif($mod=='alipay_qrcode'){
            $result = file_get_contents(CORE."plugin/Alipay_Qrcode/config.json");
            $arr    = json_decode($result,true);
        ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <ul class="nav nav-tabs">
                            <li><a href="./set_pay.php">信息配置</a></li>
                            <li><a href="./set_pay.php?mod=epay">易支付</a></li>
                            <li class="active"><a href="./set_pay.php?mod=alipay_qrcode">当面付</a></li>
                            <li><a href="./set_pay.php?mod=personal">私下交易</a></li>
                        </ul>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="text">APPID</label>
                                <input type="text" id="appid" class="form-control" value="<?php echo $arr['appid'];?>" placeholder="应用APPID">
                            </div>
                            <div class="form-group">
                                <label for="text">支付宝公钥</label>
                                <textarea id="public_key" rows="5" class="form-control" placeholder="应用私钥(RSA2)"><?php echo $arr['public_key'];?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="text">应用密钥</label>
                                <textarea id="private_key" rows="20" class="form-control" placeholder="支付宝公钥(RSA2)"><?php echo $arr['private_key'];?></textarea>
                            </div>
                            <div class="form-group">
                                <a href="javascript:alipay_qrcode()" class="btn-block btn-round btn btn-success">确定修改</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php }elseif($mod=='personal'){?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <ul class="nav nav-tabs">
                            <li><a href="./set_pay.php">信息配置</a></li>
                            <li><a href="./set_pay.php?mod=epay">易支付</a></li>
                            <li><a href="./set_pay.php?mod=alipay_qrcode">当面付</a></li>
                            <li class="active"><a href="./set_pay.php?mod=personal">私下交易</a></li>
                        </ul>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="text">QQ</label>
                                <input type="text" id="qq" class="form-control" value="<?php echo $conf['pay_personal_qq'];?>" placeholder="QQ收款码外链">
                            </div>
                            <div class="form-group">
                                <label for="text">微信</label>
                                <input type="text" id="weixin" class="form-control" value="<?php echo $conf['pay_personal_weixin'];?>" placeholder="微信收款码外链">
                            </div>
                            <div class="form-group">
                                <label for="text">支付宝</label>
                                <input type="text" id="alipay" class="form-control" value="<?php echo $conf['pay_personal_alipay'];?>" placeholder="支付宝收款码外链">
                            </div>
                            <div class="form-group">
                                <a href="javascript:personal()" class="btn-block btn-round btn btn-success">确定修改</a>
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

<script type="text/javascript" src="../assets/System/admin/js/set_pay.js?ver=<?php echo VER ?>"></script>

</body>
</html>