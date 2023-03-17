<?php
/*
* @Time    : 2022/05/22 20:57
* @Author  : 爱唯逸网络科技
* @Mail    : support@857xx.cn
* @Site    : https://web.857xx.cn
* @File    : workorder_list.php
* @Action  : 工单列表
*/

include("../system/core/core.php");
$title='工单详情';
include './page_head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login_index.php';</script>");
$id = $_GET['id'];
$row_1 =$DB->get_row("select * from website_workorder where id = '{$id}' limit 1");
$row_2 = $DB->get_row("select * from website_user where uid = '{$row_1['user']}' limit 1");
$row_3 = $DB->get_row("select * from website_class_workorder where id = '{$row_1['type']}' limit 1");
$text_1 = explode('*',$row_1['text']);
if(!$id){
    showmsg("参数不全");
}elseif(!$row_1){
    showmsg("工单不存在");
}
function status($status){
    if($status == 1){
        return "已结单";
    }elseif($status == 0){
        return "待处理";
    }else{
        return "未知";
    }
}
$avatar = $siteurls.'/assets/System/icon/favicon.ico';
?>
<style>
    .status{
        float: right;
        color: red;
    }
    .end_msg{
        width:100%;
        height:3em;
        line-height:3em;
        text-align:center;
        color:#129DDE
    }
    .box{
        width:auto;
        margin-left:4em;
        margin-top:-3em
    }
    .big_box{
        width:96%;
        height:auto;
        padding-top:1em;
        margin-left:2%;
        padding-left:.5em;
        padding-right:1em;
        margin-bottom:1em;
        border-top:dashed 1px #a9a9a9
    }
    .box_1{
        width:100%;
        height:1em;
        color:#a9a9a9;
        margin-bottom:1em
    }
    .huifu{
        width:100%;
        height:auto;
        margin-top:1em;
        border-top:solid #ccc 2px
    }
    .box_1>span{
        position:absolute;
        right:4em;
    }
</style>
<!--页面主要内容-->
<main class="lyear-layout-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>沟通记录 - <?php echo count($text_1)?> <span class="status"><?php echo status($row_1['status'])?></span></h4>
                    </div>
                    <div class="card-body">
                        <div class="big_box" style="border: none;">
                            <img src="<?php echo $row_2['avatar']?>" width="40"/>
                            <div class="box">
                                <div class="box_1">问题描述<span><?php echo $row_1['date_add']?></span></div>
                                <p style="color: red;"><?php echo $text_1[0]?></p>
                                <b style="color: blue;">问题类型：<?php echo $row_3['name'];?></b>
                            </div>
                        </div>
                        <?php
                            for($i=1;$i<count($text_1);$i++){
                                $text_2 = explode('^',$text_1[$i]);
                                if(count($text_2)==3){
                                    echo '
                                        <div class="big_box">
                                            <img src="'.($text_2[0]==1?$avatar:$row_2['avatar']).'" width="40"/>
                                            <div class="box">
                                                <div class="box_1">
                                                    '.($text_2[0]==1?'官方客服':$row_2['name']).'<span>'.$text_2[1].'</span>
                                                </div>
                                                '.$text_2[2].'
                                            </div>
                                        </div>
                                    ';
                                }
                            }
                        ?>
                        <?php if($row_1['status'] == 1){?>
                            <div class="end_msg">此工单已经结单</div>
                        <?php }else{?>
                            <div class="huifu">
                                <br/>
                                <div class="form-group">
                                    <textarea id="text"class="form-control" rows="8" placeholder="回复后工单状态自动变为已处理 ,分站站点将会收到通知哦！"></textarea>
                                </div>
                                <div class="form-group">
                                    <div class="example-box text-center">
                                        <a href="javascript:void(0);" onclick="reply(<?php echo $id;?>);" class="btn btn-primary">提交回复</a>
                                        <a href="javascript:void(0);" onclick="end(<?php echo $id;?>);" class="btn btn-primary">完结工单</a>
                                </div>
                            </div>
                        <?php }?>
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

<script>
    function reply(id){
        var text = $("#text").val();
        var ii = layer.load(0, {shade:[0.1,'#fff']});
		$.ajax({
		    type : "POST",
			url : "ajax_workorder.php?act=reply",
			data : {id:id,text:text},
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
				layer.msg(data.msg)
				if(data.code == 1){
				    window.location.href="./workorder_reply.php?id=" + id;
				}
			},
			error:function(data){
				layer.close(ii);
				layer.msg('服务器错误！');
				return false;
			}
		});
	};
	function end(id){
        var ii = layer.load(0, {shade:[0.1,'#fff']});
		$.ajax({
		    type : "POST",
			url : "ajax_workorder.php?act=end",
			data : {id:id},
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
				layer.msg(data.msg)
				if(data.code == 1){
				    window.location.href="./workorder_reply.php?id=" + id;
				}
			},
			error:function(data){
				layer.close(ii);
				layer.msg('服务器错误！');
				return false;
			}
		});
	};
</script>

</body>
</html>