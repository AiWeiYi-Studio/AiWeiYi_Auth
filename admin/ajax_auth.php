<?php
/*
* @Time    : 2022/05/22 20:57
* @Author  : 爱唯逸网络科技
* @Mail    : support@857xx.cn
* @Site    : https://web.857xx.cn
* @File    : ajax_auth.php
* @Action  : 域名授权相关ajax
*/

include("../system/core/core.php");
$act=isset($_GET['act'])?daddslashes($_GET['act']):null;
if($islogin==1){}else{$result = array("code"=>-1,"msg"=>"你还没有登录");}
@header('Content-Type: application/json; charset=UTF-8');
switch($act){
    
case 'set_app_money':
    $id=daddslashes($_POST['id']);
    $money_day=daddslashes($_POST['money_day']);
    $money_month=daddslashes($_POST['money_month']);
    $money_year=daddslashes($_POST['money_year']);
    $money_long=daddslashes($_POST['money_long']);
    $sql = "update website_app set money_day='{$money_day}',money_month='{$money_month}',money_year='{$money_year}',money_long='{$money_long}' where id = '".$id."'";
    if($DB->query($sql)){
        $result = array(
            "code"=>1,
            "msg"=>"设置成功"
        );
    }else{
        $result = array(
            "code"=>-1,
            "msg"=>$DB->error()
        );
    }
break;
    
case 'get_app_money':
    $id=daddslashes($_POST['id']);
    $row = $DB->get_row("select * from website_app where id = '".$id."' limit 1");
    if($row){
        $result = array(
            "code"=>1,
            "money_day"=>$row['money_day'],
            "money_month"=>$row['money_month'],
            "money_year"=>$row['money_year'],
            "money_long"=>$row['money_long'],
            "msg"=>"获取价格成功"
        );
    }else{
        $result = array(
            "code"=>-1,
            "msg"=>"程序不存在"
        );
    }
break;
    
case 'app_download_1':
    $id=daddslashes($_GET['id']);
    $download=daddslashes($_POST['download']);
    $sql="update website_app set download='{$download}'where id='{$id}'";
    $log_sql = "insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','修改','修改程序安装包','".$date."','admin')";
    if(!$id){
        $result = array(
            "code"=>-1,
            "msg"=>"程序ID为空"
        );
    }elseif(!$download){
        $result = array(
            "code"=>-1,
            "msg"=>"安装包地址为空"
        );
    }elseif($DB->query($sql) && $DB->query($log_sql)){
        $result = array(
            "code"=>1,
            "msg"=>"成功"
        );
    }else{
        $result = array(
	        "code"=>-1,
            "msg"=>$DB->error()
        );
    }
break;

case 'app_download_2':
    $id=daddslashes($_GET['id']);
    if($_POST['do']=='upload'){
        $filename = $_FILES['file']['name'];
        $ext = substr($filename, strripos($filename, '.') + 1);
        $arr = array('zip', 'rar', '7z', 'gz');
        $filename = 'installer_'.$id.'.'.$ext;
        $fileurl = ROOT.'file/auth/release/'.$filename;
        $download = $siteurls.'file/auth/release/'.$filename;
        $sql="update website_app set download = '{$download}' where id='{$id}'";
        $sql_log = "insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','修改','修改程序安装包','".$date."','admin')";
        if(!in_array($ext , $arr)) {
            $result = array(
                "code"=>-1,
                "msg"=>"文件格式不支持"
            );
        }elseif($DB->query($sql) && $DB->query($sql_log)){
            if(copy($_FILES['file']['tmp_name'], $fileurl)){
                $result = array(
                    "code"=>1,
                    "msg"=>"上传成功"
                );
            }else{
                $result = array(
                    "code"=>-1,
                    "msg"=>"请确保有本地写入权限"
                );
            }
        }else{
            $result = array(
                "code"=>-1,
                "msg"=>$DB->error()
            );
        }
    }
break;

case 'set_info':
    $id=daddslashes($_POST['id']);
    $name=daddslashes($_POST['name']);
    $money_day=daddslashes($_POST['money_day']);
    $money_month=daddslashes($_POST['money_month']);
    $money_year=daddslashes($_POST['money_year']);
    $money_long=daddslashes($_POST['money_long']);
    $download=daddslashes($_POST['download']);
    $notice=daddslashes($_POST['notice']);
    $text=daddslashes($_POST['text']);
    $status=daddslashes($_POST['status']);
    $expand=daddslashes($_POST['expand']);
    $notice_pirate=daddslashes($_POST['notice_pirate']);
    $notice_not=daddslashes($_POST['notice_not']);
    $notice_date=daddslashes($_POST['notice_date']);
    $notice_status=daddslashes($_POST['notice_status']);
    $sql="update website_app set name='{$name}',money_day='{$money_day}',money_month='{$money_month}',money_year='{$money_year}',money_long='{$money_long}',download='{$download}',notice='{$notice}',text='{$text}',status='{$status}',expand='{$expand}',notice_pirate='{$notice_pirate}',notice_date='{$notice_date}',notice_not='{$notice_not}',notice_status='{$notice_status}' where id='{$id}'";
    $log_sql = "insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','修改','修改授权程序信息','".$date."','admin')";
    if($DB->query($sql) && $DB->query($log_sql)){
        $result = array(
            "code"=>1,
            "msg"=>"成功",
            "ID"=>$id
        );
    }else{
        $result = array(
	        "code"=>-1,
            "msg"=>$DB->error()
        );
    }
break;

case 'update_status':
    $id=daddslashes($_POST['id']);
    $row = $DB->get_row("SELECT * FROM website_update where id = '{$id}'");
    if($row['status']==1){
        $status = 0;
    }else{
        $status = 1;
    }
    $sql="update website_update set status = '{$status}' where id = '{$id}' ";
    $log_sql = "insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','修改','修改更新包状态','".$date."','admin')";
    if($DB->query($sql) && $DB->query($log_sql)){
        $result = array(
            "code"=>1,
            "msg"=>"成功"
        );
    }else{
        $result = array(
	        "code"=>-1,
            "msg"=>$DB->error()
        );
    }
break;

case 'update_beta':
    $id=daddslashes($_POST['id']);
    $row = $DB->get_row("SELECT * FROM website_update where id = '{$id}'");
    if($row['beta']==1){
        $beta = 0;
    }else{
        $beta = 1;
    }
    $sql="update website_update set beta = '{$beta}' where id = '{$id}' ";
    $log_sql = "insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','修改','修改更新包内测状态','".$date."','admin')";
    if($DB->query($sql) && $DB->query($log_sql)){
        $result = array(
            "code"=>1,
            "msg"=>"成功"
        );
    }else{
        $result = array(
	        "code"=>-1,
            "msg"=>$DB->error()
        );
    }
break;

case 'update_type':
    $id=daddslashes($_POST['id']);
    $row = $DB->get_row("SELECT * FROM website_update where id = '{$id}' ");
    if($row['type']==1){
        $type = 0;
    }else{
        $type = 1;
    }
    $sql="update website_update set type = '{$type}' where id = '{$id}' ";
    $log_sql = "insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','修改','修改更新包更新方式','".$date."','admin')";
    if($DB->query($sql) && $DB->query($log_sql)){
        $result = array(
            "code"=>1,
            "msg"=>"成功"
        );
    }else{
        $result = array(
	        "code"=>-1,
            "msg"=>$DB->error()
        );
    }
break;

case 'app_status':
    $id=daddslashes($_GET['id']);
    $row = $DB->get_row("SELECT * FROM website_app where id = '{$id}'");
    if($row['status']==1){
        $status = '0';
    }else{
        $status = '1';
    }
    $sql="update website_app set status='{$status}'where id='{$id}'";
    $log_sql = "insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','修改','修改程序状态：".$row['name']."','".$date."','admin')";
    if($DB->query($sql) && $DB->query($log_sql)){
        $result = array(
            "code"=>1,
            "msg"=>"成功"
        );
    }else{
        $result = array(
	        "code"=>-1,
            "msg"=>$DB->error()
        );
    }
break;

case 'auth_active':
    $id=daddslashes($_POST['id']);
    $text=daddslashes($_POST['text']);
    $row = $DB->get_row("SELECT * FROM website_legal where id = '{$id}'");
    if($row['active']==1){
        $active = '0';
    }else{
        $active = '1';
    }
    $sql="update website_legal set active = '{$active}',why = '{$text}' where id='{$id}'";
    $log_sql = "insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','修改','修改授权状态：".$row['uuid']."','".$date."','admin')";
    if($DB->query($sql) && $DB->query($log_sql)){
        $result = array(
            "code"=>1,
            "msg"=>"成功"
        );
    }else{
        $result = array(
	        "code"=>-1,
            "msg"=>$DB->error()
        );
    }
break;

case 'del_app':
    $id = daddslashes($_GET['id']);
    $sql="DELETE FROM website_app where id = '{$id}'";
    $log_sql = "insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','删除','删除程序：".$row['name']."','".$date."','admin')";
    if($DB->query($sql) && $DB->query($log_sql)){
        $result = [
            "code"=>1,
            "msg"=>"成功"
        ];
    }else{
        $result = [
            "code"=>0,
            "msg"=>$DB->error()
        ];
    }
break;

case 'del_update':
    $id = daddslashes($_POST['id']);
    $sql="DELETE FROM website_update where id = '{$id}'";
    $log_sql = "insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','删除','删除更新包','".$date."','admin')";
    if($DB->query($sql) && $DB->query($log_sql)){
        $result = [
            "code"=>1,
            "msg"=>"成功"
        ];
    }else{
        $result = [
            "code"=>0,
            "msg"=>$DB->error()
        ];
    }
break;

case 'del_auth':
    $id = daddslashes($_GET['id']);
    $sql="DELETE FROM website_legal where id = '{$id}'";
    $log_sql = "insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','删除','删除授权：".$row['uuid']."','".$date."','admin')";
    if($DB->query($sql) && $DB->query($log_sql)){
        $result = [
            "code"=>1,
            "msg"=>"成功"
        ];
    }else{
        $result = [
            "code"=>0,
            "msg"=>$DB->error()
        ];
    }
break;

case 'add_auth':
    $type=daddslashes($_POST['type']);
    $uuid=daddslashes($_POST['uuid']);
    $contact=daddslashes($_POST['contact']);
    if(!$_POST['token']){
        $token = get_token();
    }else{
        $token = daddslashes($_POST['token']);
    }
    $ip=daddslashes($_POST['ip']);
    $active=daddslashes($_POST['active']);
    $time=daddslashes($_POST['date']);
    $authcode = get_authcode($uuid);
    $row_uuid = $DB->get_row("SELECT * FROM website_legal WHERE uuid = '{$uuid}' and type = '{$type}'");
    $sql="insert into `website_legal` (`date`,`time`,`uuid`,`ip`,`authcode`,`token`,`contact`,`user`,`active`,`type`) values ('".$date."','".$time."','".$uuid."','".$ip."','".$authcode."','".$token."','".$contact."','".$udata['uid']."','".$active."','".$type."')";
    $log_sql = "insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','添加','添加授权：".$uuid."','".$date."','admin')";
    if(!$type){
        $result = array(
	        "code"=>-1,
            "msg"=>"程序类型为空"
        );
    }elseif(!$uuid){
        $result = array(
	        "code"=>-1,
            "msg"=>"唯一识别码为空"
        );
    }elseif($row_uuid){
        $result = array(
	        "code"=>-1,
            "msg"=>"当前识别码已拥有此程序的授权"
        );
    }elseif(!$active){
        $result = array(
	        "code"=>-1,
            "msg"=>"授权状态为空"
        );
    }elseif(!$time){
        $result = array(
	        "code"=>-1,
            "msg"=>"到期时间为空"
        );
    }elseif($DB->query($sql) && $DB->query($log_sql)){
        $row_id = $DB->get_row("SELECT * FROM website_legal order by id desc limit 1");
        $result = array(
            "code"=>1,
            "msg"=>"成功",
            "ID"=>$row_id['id']
        );
    }else{
        $result = array(
	        "code"=>-1,
            "msg"=>$DB->error()
        );
    }
break;

case 'add_app':
    $name=daddslashes($_POST['name']);
    $status=daddslashes($_POST['status']);
    $notice_pirate="检测到您使用盗版程序，无法使用";
    $notice_status="检测到系统已停运，无法使用";
    $notice_not="检测到系统未授权，无法使用";
    $notice_date="检测到您的授权已到期，无法使用";
    $expand = array(
        "info_0"=> "扩展模板",
        "info_1"=> "json扩展1",
        "info_2"=> "json扩展2",
        [
            "info_0"=> "扩展模板",
            "info_1"=> "json扩展1",
            "info_2"=> "json扩展2"
        ]
    );
    $expand = json_encode($expand, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
    $sql="insert into `website_app` (`date`,`name`,`status`,`expand`,`notice_pirate`,`notice_not`,`notice_status`,`notice_date`) values ('".$date."','".$name."','".$status."','".$expand."','".$notice_pirate."','".$notice_not."','".$notice_status."','".$notice_date."')";
    $log_sql = "insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','添加','添加授权程序：".$name."','".$date."','admin')";
    if(!$name || !$status){
        $result = array(
            "code"=>-1,
            "msg"=>"名称或状态不能为空"
        );
    }elseif($DB->query($sql) && $DB->query($log_sql)){
        $row_id = $DB->get_row("SELECT * FROM website_app order by id desc limit 1");
        $result = array(
            "code"=>1,
            "msg"=>"添加成功",
            "ID"=>$row_id['id']
        );
    }else{
        $result = array(
	        "code"=>-1,
            "msg"=>$DB->error()
        );
    }
break;

case 'add_update':
    $app=daddslashes($_POST['app']);
    $edition=daddslashes($_POST['edition']);
    $version=daddslashes($_POST['version']);
    $log=daddslashes($_POST['log']);
    $text=daddslashes($_POST['text']);
    $beta=daddslashes($_POST['beta']);
    $type=daddslashes($_POST['type']);
    $status=daddslashes($_POST['status']);
    $filename = $_FILES['file']['name'];
    $ext = substr($filename, strripos($filename, '.') + 1);
    $arr = array('zip');
    $filename = 'updater_'.$edition.'.'.$ext;
    $fileurl = ROOT.'file/auth/update/'.$app.'/'.$filename;
    if(!is_dir($fileurl)){
        mkdir(dirname($fileurl),0777,true);
    }
    $download = $siteurls.'file/auth/update/'.$app.'/'.$filename;
    $sql_update = "insert into `website_update` (`date`,`edition`,`version`,`download`,`log`,`text`,`app`,`beta`,`type`,`status`) values ('".$date."','".$edition."','".$version."','".$download."','".$log."','".$text."','".$app."','".$beta."','".$type."','".$status."')";
    $sql_log = "insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','添加','发布程序更新包','".$date."','admin')";
    if(!$app || !$edition || !$version || $beta == '' || $type == ''){
        $result = array(
            "code"=>-1,
               "msg"=>"参数不全"
        );
    }elseif(!$_FILES) {
        $result = array(
            "code"=>-1,
            "msg"=>"请选择压缩包文件"
        );
    }elseif(!in_array($ext , $arr)) {
        $result = array(
            "code"=>-1,
            "msg"=>"文件格式不支持"
        );
    }elseif(copy($_FILES['file']['tmp_name'], $fileurl)){
        if($DB->query($sql_update) && $DB->query($sql_log)){
            $result = array(
                "code"=>1,
                "msg"=>"上传成功"
            );
        }else{
            $result = array(
                "code"=>-1,
                "msg"=>$DB->error()
            );
        }
    }else{
        $result = array(
            "code"=>-1,
            "msg"=>"请确保有本地写入权限"
        );
    }
break;

case 'check_app':
    $id=daddslashes($_POST['id']);
    $row = $DB->get_row("SELECT * FROM website_app WHERE id = {$id} limit 1");
    if($row){
        $result = array(
            "code"=>1
        );
    }else{
        $result = array(
	        "code"=>-1,
            "msg"=>"记录不存在"
        );
    }
break;

case 'check_auth':
    $id=daddslashes($_POST['id']);
    $row = $DB->get_row("SELECT * FROM website_legal WHERE id = {$id} limit 1");
    if($row){
        $result = array(
            "code"=>1
        );
    }else{
        $result = array(
	        "code"=>-1,
            "msg"=>"记录不存在"
        );
    }
break;

default:
	$result = array(
	    "code"=>-4,
        "msg"=>"Not Act"
    );
break;
}
echo json_encode($result, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);