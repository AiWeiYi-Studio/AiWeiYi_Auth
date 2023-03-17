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
$mod=daddslashes($_GET['mod'])?daddslashes($_GET["mod"]):NULL;
$app=daddslashes($_GET['app']);
$row_update = $DB->get_row("select max(version) from website_update where app ='".$app."'");
if($mod=='add_app'){
    $title = '程序添加';
}elseif($mod=='add_auth'){
    $title = '授权添加';
}elseif($mod=='add_update'){
    $title = '发布更新';
}
include './page_head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login_index.php';</script>");
?>
<!--页面主要内容-->
<main class="lyear-layout-content">
    <div class="container-fluid">
        <?php if($mod=='add_app'){?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>程序添加</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="text">程序名称</label>
                                <input type="text" id="name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="text">程序状态</label>
                                <select id="status" class="form-control" default="1">
                                    <option value="0">关闭</option>
                                    <option value="1">正常</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <a href="javascript:add_app()" class="btn-block btn-round btn btn-success">添加</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php }elseif($mod=='add_auth'){?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>授权添加</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="text">程序列表</label>
                                <select id="type" class="form-control" default="<?php echo $_GET['app'];?>">
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
                                <label for="text">唯一识别码</label>
                                <input type="text" id="uuid" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="text">联系方式</label>
                                <input type="text" id="contact" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="text">授权密钥</label>
                                <input type="text" id="token" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="text">授权IP</label>
                                <input type="text" id="ip" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="text">授权状态</label>
                                <select id="active" class="form-control" default="1">
                                    <option value="0">封禁</option>
                                    <option value="1">正常</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="text">授权时间</label>
                                <select id="time" class="form-control" default="day" onChange="select_time();">
                                    <option value="day">一天</option>
                                    <option value="month">一月</option>
                                    <option value="year">一年</option>
                                    <option value="long">永久</option>
                                    <option value="change">自定义</option>
                                </select>
                            </div>
                            <div id="dates" style="display:none;">
                                <div class="form-group" style="position: relative;">
                                    <label for="text">到期时间</label>
                                    <input class="form-control js-datetimepicker" type="text" id="date" placeholder="请输入添加时间" value="<?php echo date("Y-m-d H:i:s",strtotime( "+1 day"));?>" data-side-by-side="true" data-locale="zh-cn" data-format="YYYY-MM-DD HH:mm:ss"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <a href="javascript:add_auth()" class="btn-block btn-round btn btn-success">添加</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php }elseif($mod=='add_update'){?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>发布更新</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3 col-lg-3">
                                    <div class="form-group">
                                        <label for="text">程序</label>
                                        <select id="app" class="form-control" onchange="location.href='?mod=add_update&app='+this.options[this.selectedIndex].value;" default="<?php echo $app;?>">
                                            <option value="0">请选择程序</option>
                                            <?php
                                                $rs=$DB->query("SELECT * FROM website_app order by id asc");
                                                while($res = $DB->fetch($rs)){
                                                    echo '<option value="'.$res['id'].'">'.$res['name'].'</option>';
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-3 col-lg-3">
                                    <div class="form-group">
                                        <label for="text">状态</label>
                                        <select id="status" class="form-control" default="1">
                                            <option value="0">封禁</option>
                                            <option value="1">正常</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-3 col-lg-3">
                                    <div class="form-group">
                                        <label for="text">更新方式</label>
                                        <select id="type" class="form-control" default="0">
                                            <option value="0">直接更新</option>
                                            <option value="1">手动更新</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-3 col-lg-3">
                                    <div class="form-group">
                                        <label for="text">内测</label>
                                        <select id="beta" class="form-control" default="0">
                                            <option value="0">否</option>
                                            <option value="1">是</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-lg-4">
                                    <div class="form-group">
                                        <label for="text">版本</label>
                                        <input type="text" id="edition" class="form-control" placeholder="如：V1.0.0">
                                    </div>
                                </div>
                                <div class="col-sm-4 col-lg-4">
                                    <div class="form-group">
                                        <label for="file">更新包</label>
                                        <input type="file" name="file" id="file" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-4 col-lg-4">
                                    <div class="form-group">
                                        <label for="text">版本号</label>
                                        <input type="text" id="version" class="form-control" placeholder="需大于<?php echo $row_update['max(version)']?$row_update['max(version)']:0;?>才能检测到更新">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="text">更新日志</label>
                                        <textarea id="log" class="form-control" rows="10" placeholder="更新日志，可写可不写"></textarea>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="text">备注</label>
                                        <textarea id="text" class="form-control" rows="10" placeholder="更新备注，可写可不写"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <a href="javascript:add_update()" class="btn-block btn-round btn btn-success">添加</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php }?>
    </div>
</main>
<!--End 页面主要内容-->

<script type="text/javascript" src="../assets/LightYear/js/jquery.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/perfect-scrollbar.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/main.min.js"></script>
<script type="text/javascript" src="../assets/LightYear/js/jquery.cookie.min.js"></script>

<!--时间选择插件-->
<script src="../assets/LightYear/js/bootstrap-datetimepicker/moment.min.js"></script>
<script src="../assets/LightYear/js/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js"></script>
<script src="../assets/LightYear/js/bootstrap-datetimepicker/locale/zh-cn.js"></script>

<script type="text/javascript" src="../assets/System/admin/js/auth_add.js?ver=22<?php echo VER ?>"></script>

<script src="../assets/Layer/layer.js"></script>

</body>
</html>