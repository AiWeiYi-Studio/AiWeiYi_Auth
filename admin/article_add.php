<?php
/*
* @Time    : 2022/05/22 20:57
* @Author  : 爱唯逸网络科技
* @Mail    : support@857xx.cn
* @Site    : https://web.857xx.cn
* @File    : article_add.php
* @Action  : 文章添加
*/

include("../system/core/core.php");
$title='文章添加';
include './page_head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login_index.php';</script>");
$mod=isset($_GET['mod'])?$_GET["mod"]:'list';
?>
<!--页面主要内容-->
<main class="lyear-layout-content">
    <div class="container-fluid">
        <?php if($mod=='add_ok'){
            $title=daddslashes($_POST['title']);
            $titles=daddslashes($_POST['titles']);
            $img=daddslashes($_POST['img']);
            $text=daddslashes($_POST['text']);
            $time=daddslashes($_POST['time']);
            $number=daddslashes($_POST['number']);
            $active=daddslashes($_POST['active']);
            if(!$time){
                $time = $date;
            }else{
                $time = $time;
            }
            if(!$img){
                $result = file_get_contents("https://api.btstu.cn/sjbz/api.php?format=json");
                $arr=json_decode($result,true);
                $img = $arr['imgurl'];
            }else{
                $img = $img;
            }
            $row = $DB->get_row("SELECT * FROM website_article order by uid desc limit 1");
            $uid = $row['uid']+1;
            $sql="insert into `website_article` (`time`,`title`,`titles`,`img`,`author`,`text`,`number`,`active`,`uid`) values ('".$time."','".$title."','".$titles."','".$img."','".$udata['uid']."','".$text."','".$number."','".$active."','".$uid."')";
            if(!$title){
                exit("<script language='javascript'>alert('添加失败：标题为空');history.go(-1);</script>");
            }elseif(!$text){
                exit("<script language='javascript'>alert('添加失败：内容为空');history.go(-1);</script>");
            }elseif($DB->query($sql)){
                $city=get_ip_city($clientip);
                $DB->query("insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','添加','添加文章：".$title.",'".$date."','admin')");
                exit("<script language='javascript'>alert('添加成功');history.go(-1);</script>");
            }else{
                exit("<script language='javascript'>alert('添加失败：'.$DB->error().'');history.go(-1);</script>");
            }
        ?>
        <?php }else{?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>文章添加</h4>
                        </div>
                        <div class="card-body">
                            <form action="?mod=add_ok" method="POST" role="form">
                                <div class="input-group">
                                    <span class="input-group-addon">文章标题</span>
                                    <input type="text" id="title" name="title" class="form-control" placeholder="请输入名称" value="<?php echo $_POST['title'];?>">
                                </div>
                                <br/>
                                <div class="input-group">
                                    <span class="input-group-addon">文章简介</span>
                                    <input type="text" id="titles" name="titles" class="form-control" placeholder="请输入文章简介" value="<?=$row['titles']?>" >
                                </div>
                                <br/>
                                <div class="input-group">
                                    <span class="input-group-addon">文章头图</span>
                                    <input type="text" id="img" name="img" class="form-control" placeholder="请输入文章头图" value="<?=$row['img']?>" >
                                </div>
                                <br/>
                                <div class="input-group">
                                    <span class="input-group-addon">浏览量</span>
                                    <input type="text" id="number" class="form-control" placeholder="请输入浏览数量" value="<?php echo $_POST['number'];?>">
                                </div>
                                <br/>
                                <div class="input-group">
                                    <span class="input-group-addon">添加时间</span>
                                    <input class="form-control js-datetimepicker" type="text" id="time" name="time" placeholder="请输入添加时间" value="<?php echo$_POST['time'];?>" data-side-by-side="true" data-locale="zh-cn" data-format="YYYY-MM-DD HH:mm:ss" />
                                </div>
                                <br/>
                                <div class="input-group">
                                    <span class="input-group-addon">状态</span>
                                    <select id="active" name="active" class="form-control" default="<?php echo $_POST['active'];?>">
                                        <option value="1">显示</option>
                                        <option value="0">隐藏</option>
                                    </select>
                                </div>
                                <br/>
                                <div class="form-group">
                                    <label for="text">文章内容：</label>
                                    <script id="Ueditor" name="Ueditor" type="text/plain" style="width:100%;height:400px;"></script>
                                </div>
                            </from>
                            <div class="form-group">
                                <input type="submit" name="submit" value="确定" class="btn btn-primary form-control"/>
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

<script src="../assets/Layer/layer.js"></script>

<!-- 配置文件 -->
<script type="text/javascript" charset="gbk" src="../assets/Ueditor/ueditor.config.js"></script>
<!-- 编辑器源码文件 -->
<script type="text/javascript" charset="gbk" src="../assets/Ueditor/ueditor.all.js"></script>
<!-- 编辑器语言 -->
<script type="text/javascript" charset="gbk" src="../assets/Ueditor/lang/zh-cn/zh-cn.js"></script>

<script type="text/javascript" src="../assets/System/admin/js/article_add.js"></script>
</body>
</html>
