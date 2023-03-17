<?php
/*
* @Time    : 2022/05/22 20:57
* @Author  : 爱唯逸网络科技
* @Mail    : support@857xx.cn
* @Site    : https://web.857xx.cn
* @File    : ajax_clean.php
* @Action  : 系统清理相关ajax
*/

include("../system/core/core.php");
$act=isset($_GET['act'])?daddslashes($_GET['act']):null;
if($islogin==1){}else{$result = array("code"=>-1,"msg"=>"你还没有登录");}
@header('Content-Type: application/json; charset=UTF-8');
switch($act){
    
    case 'upload_img_1':
        $filename = $_FILES['file']['name'];
        $ext = substr($filename, strripos($filename, '.') + 1);
        $arr = array('png', 'jpg', 'gif', 'jpeg', 'webp', 'bmp');
        $path= 'file/images/'.date('Y-m-d').'/';
        $filepath = ROOT.$path.$filename;
        $fileurl = $siteurls.$path.$filename;
        if(!is_dir(ROOT.$path)){
            mkdir(ROOT.$path,0755,true);
        }
        if (!in_array($ext , $arr)) {
            $result = array(
                "code"=>-1,
                "msg"=>"只支持上传图片文件"
            );
        }elseif(copy($_FILES['file']['tmp_name'], $filepath)){
            $result = array(
                "code"=>1,
                "msg"=>"上传成功",
                "imgurl"=>$fileurl
            );
        }else{
            $result = array(
                "code"=>-1,
                "msg"=>"请确保有本地写入权限"
            );
        }
    break;
    
    case 'class_info':
        $id   = daddslashes($_POST['id']);
        $row = $DB->get_row("select * from website_class_book where id = '{$id}'");
        if($row){
            $result = array(
                "code"=>1,
                "msg"=>"数据获取成功",
                "name"=>$row['name'],
                "title"=>$row['title'],
                "number"=>$row['number'],
                "status"=>(int)$row['status'],
                "img"=>$row['img']
            );
        }else{
            $result = array(
                "code"=>-1,
                "msg"=>"数据不存在"
            );
        }
    break;
    
    case 'class_edit':
        $id     = daddslashes($_POST['id']);
        $name   = daddslashes($_POST['name']);
        $title  = daddslashes($_POST['title']);
        $img    = daddslashes($_POST['img']);
        $number = daddslashes($_POST['number']);
        $status = daddslashes($_POST['status']);
        $sql    = "update website_class_book set name = '{$name}',title = '{$title}',img = '{$img}',number = '{$number}',status = '{$status}' where id='{$id}'";
        if(!$name || !$title || !$img){
            $result = array(
                "code"=>-1,
                "msg"=>"名称、描述、大头图不能为空"
            );
        }elseif($DB->query($sql)){
            $result = array(
                "code"=>1,
                "msg"=>"修改成功"
            );
        }else{
            $result = array(
                "code"=>-1,
                "msg"=>$DB->error()
            );
        }
    break;
    
    case 'class_add':
        $name   = daddslashes($_POST['name']);
        $title  = daddslashes($_POST['title']);
        $img    = daddslashes($_POST['img']);
        $number = daddslashes($_POST['number']);
        $status = daddslashes($_POST['status']);
        $sql    = "insert into `website_class_book` (`name`,`title`,`img`,`date`,`number`,`status`) values ('".$name."','".$title."','".$img."','".$date."','".$number."','".$status."')";
        if(!$name || !$title || !$img){
            $result = array(
                "code"=>-1,
                "msg"=>"名称、描述、大头图不能为空"
            );
        }elseif($DB->query($sql)){
            $result = array(
                "code"=>1,
                "msg"=>"添加成功"
            );
        }else{
            $result = array(
                "code"=>-1,
                "msg"=>$DB->error()
            );
        }
    break;
    
    case 'edit':
        $id    = daddslashes($_POST['id']);
        $class = daddslashes($_POST['uid']);
        $name  = daddslashes($_POST['name']);
        $text  = daddslashes($_POST['text']);
        $date  = daddslashes($_POST['date']);
        $number= daddslashes($_POST['number']);
        $status= daddslashes($_POST['status']);
        $sql    = "update website_book set class = '{$class}',name = '{$name}',text = '{$text}',date = '{$date}',number = '{$number}',status = '{$status}' where id='{$id}'";
        if(!$id || !$name || !$class || !$text){
            $result = array(
                "code"=>-1,
                "msg"=>"必要参数为空"
            );
        }elseif($DB->query($sql)){
            $result = array(
                "code"=>1,
                "msg"=>"修改成功"
            );
        }else{
            $result = array(
                "code"=>-1,
                "msg"=>$DB->error()
            );
        }
    break;
    
    case 'add':
        $class = daddslashes($_POST['uid']);
        $name  = daddslashes($_POST['name']);
        $text  = daddslashes($_POST['text']);
        $date  = daddslashes($_POST['date']);
        $number= daddslashes($_POST['number']);
        $status= daddslashes($_POST['status']);
        $sql   = "insert into `website_book` (`class`,`name`,`text`,`date`,`number`,`status`) values ('".$class."','".$name."','".$text."','".$date."','".$number."','".$status."')";
        if(!$name || !$class || !$text){
            $result = array(
                "code"=>-1,
                "msg"=>"分类、标题、内容不能为空"
            );
        }elseif($DB->query($sql)){
            $result = array(
                "code"=>1,
                "msg"=>"添加成功"
            );
        }else{
            $result = array(
                "code"=>-1,
                "msg"=>$DB->error()
            );
        }
    break;
    
    case 'del':
        $id = daddslashes($_POST['id']);
        $sql= "DELETE FROM website_book where id = '{$id}'";
        if(!$id){
            $result = array(
                "code"=>-1,
                "msg"=>"递交参数缺失"
            );
        }elseif($DB->query($sql)){
            $result = array(
                "code"=>1,
                "msg"=>"删除成功"
            );
        }else{
            $result = array(
                "code"=>-1,
                "msg"=>$DB->error()
            );
        }
    break;
    
    case 'class_del':
        $id = daddslashes($_POST['id']);
        $sql= "DELETE FROM website_class_book where id = '{$id}'";
        $sql_class= "DELETE FROM website_book where class = '{$id}'";
        if(!$id){
            $result = array(
                "code"=>-1,
                "msg"=>"递交参数缺失"
            );
        }elseif($DB->query($sql) && $DB->query($sql_class)){
            $result = array(
                "code"=>1,
                "msg"=>"删除成功"
            );
        }else{
            $result = array(
                "code"=>-1,
                "msg"=>$DB->error()
            );
        }
    break;
    
    case 'status':
        $id = daddslashes($_POST['id']);
        $row = $DB->get_row("select * from website_book where id = '{$id}'");
        if($row['status'] == 1){
            $status = 0;
        }else{
            $status = 1;
        }
        $sql_update ="update website_book set status = '{$status}' where id = '{$id}'";
        if(!$id){
            $result = array(
                "code"=>-1,
                "msg"=>"递交参数缺失"
            );
        }elseif(!$row){
            $result = array(
                "code"=>-1,
                "msg"=>"不存在该记录"
            );
        }elseif($DB->query($sql_update)){
            $result = array(
                "code"=>1,
                "msg"=>"修改成功"
            );
        }else{
            $result = array(
                "code"=>-1,
                "msg"=>$DB->error()
            );
        }
    break;
    
    case 'class_status':
        $id = daddslashes($_POST['id']);
        $row = $DB->get_row("select * from website_class_book where id = '{$id}'");
        if($row['status'] == 1){
            $status = 0;
        }else{
            $status = 1;
        }
        $sql_update ="update website_class_book set status = '{$status}' where id = '{$id}'";
        if(!$id){
            $result = array(
                "code"=>-1,
                "msg"=>"递交参数缺失"
            );
        }elseif(!$row){
            $result = array(
                "code"=>-1,
                "msg"=>"不存在该记录"
            );
        }elseif($DB->query($sql_update)){
            $result = array(
                "code"=>1,
                "msg"=>"修改成功"
            );
        }else{
            $result = array(
                "code"=>-1,
                "msg"=>$DB->error()
            );
        }
    break;
    
    default:
        $result = array(
            "code"=>-4,
            "msg"=>"No Act"
        );
    break;
}

echo json_encode($result);