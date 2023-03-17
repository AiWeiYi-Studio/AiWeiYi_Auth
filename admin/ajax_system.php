<?php
/*
* @Time    : 2022/05/22 20:57
* @Author  : 爱唯逸网络科技
* @Mail    : support@857xx.cn
* @Site    : https://web.857xx.cn
* @File    : ajax_system.php
* @Action  : 系统相关ajax
*/

include("../system/core/core.php");
$act=isset($_GET['act'])?daddslashes($_GET['act']):null;
if($islogin==1){}else exit('{"code":-1,"msg":"你还没有登录"}');
@header('Content-Type: application/json; charset=UTF-8');
switch($act){
  
case 'set_oauth_api':
    $qq     = daddslashes($_POST['qq']);
    $alipay = daddslashes($_POST['alipay']);
    $wechat = daddslashes($_POST['wechat']);
    $weibo  = daddslashes($_POST['weibo']);
    saveSetting('oauth_api_qq',$qq,'QQ登录接口，1为QQ官方，2为彩虹免签');
	saveSetting('oauth_api_alipay',$alipay,'支付宝登录接口，1为QQ官方，2为彩虹免签');
	saveSetting('oauth_api_wechat',$wechat,'微信登录接口，1为QQ官方，2为彩虹免签');
	saveSetting('oauth_api_weibo',$weibo,'微博登录接口，1为QQ官方，2为彩虹免签');
	$ad = $CACHE->clear();
    if($ad){
        exit('{"code":1,"msg":"修改成功"}');
    }else{
        exit('{"code":-1,"msg":"修改失败"}');
    }
break;

case 'set_oauth_clogin':
    $url      = daddslashes($_POST['url']);
    $appid    = daddslashes($_POST['appid']);
    $appkey   = daddslashes($_POST['appkey']);
    saveSetting('oauth_clogin_url',$url);
    saveSetting('oauth_clogin_appid',$appid);
    saveSetting('oauth_clogin_appkey',$appkey);
	$ad = $CACHE->clear();
    if(!$appid){
        exit('{"code":-1,"msg":"APPID不能为空"}');
    }elseif(!$appkey){
        exit('{"code":-1,"msg":"APPKEY不能为空"}');
    }elseif($ad){
        exit('{"code":1,"msg":"修改成功"}');
    }else{
        exit('{"code":-1,"msg":"修改失败"}');
    }
break;
  
case 'set_oauth_qq':
    $appid    = daddslashes($_POST['appid']);
    $appkey   = daddslashes($_POST['appkey']);
    $callback = daddslashes($_POST['callback']);
    saveSetting('oauth_qq_appid',$appid);
    saveSetting('oauth_qq_appkey',$appkey);
    saveSetting('oauth_qq_callback',$callback);
	$ad = $CACHE->clear();
    if(!$appid){
        exit('{"code":-1,"msg":"APPID不能为空"}');
    }elseif(!$appkey){
        exit('{"code":-1,"msg":"APPKEY不能为空"}');
    }elseif(!$callback){
        exit('{"code":-1,"msg":"CALLBACK不能为空"}');
    }elseif($ad){
        exit('{"code":1,"msg":"修改成功"}');
    }else{
        exit('{"code":-1,"msg":"修改失败"}');
    }
break;
    
case 'set_pay_personal':
    $qq     = daddslashes($_POST['qq']);
    $weixin = daddslashes($_POST['weixin']);
    $alipay = daddslashes($_POST['alipay']);
	saveSetting('pay_personal_qq',$qq);
	saveSetting('pay_personal_weixin',$weixin);
	saveSetting('pay_personal_alipay',$alipay);
	$ad = $CACHE->clear();
    if($ad){
        exit('{"code":1,"msg":"保存成功"}');
    }else{
        exit('{"code":-1,"msg":"保存失败"}');
    }
break;
    
case 'set_pay_info':
    $qqpay    = daddslashes($_POST['qqpay']);
    $wxpay    = daddslashes($_POST['wxpay']);
    $alipay   = daddslashes($_POST['alipay']);
    $personal = daddslashes($_POST['personal']);
    $little   = daddslashes($_POST['little']);
    $big      = daddslashes($_POST['big']);
	saveSetting('pay_qqpay_api',$qqpay);
	saveSetting('pay_wxpay_api',$wxpay);
	saveSetting('pay_alipay_api',$alipay);
	saveSetting('pay_personal_api',$personal);
	saveSetting('pay_money_little',$little);
	saveSetting('pay_money_big',$big);
	$ad = $CACHE->clear();
    if(!$little){
        exit('{"code":-1,"msg":"最低充值金额为空"}');
    }elseif(!$big){
        exit('{"code":-1,"msg":"最大充值金额为空"}');
    }elseif($ad){
        exit('{"code":1,"msg":"保存成功"}');
    }else{
        exit('{"code":-1,"msg":"保存失败"}');
    }
break;
    
case 'set_pay_epay':
    $api    = daddslashes($_POST['api']);
    $appid  = daddslashes($_POST['appid']);
    $appkey = daddslashes($_POST['appkey']);
    $text   = array('api' =>$api,'appid' => $appid,'appkey' =>$appkey);
    $text   = json_encode($text, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
    $file = file_put_contents(CORE.'plugin/AiWeiYi_Epay/config.json',$text);
    if(!$api){
        exit('{"code":-1,"msg":"易支付API不能为空"}');
    }elseif(!$appid){
        exit('{"code":-1,"msg":"易支付APPID不能为空"}');
    }elseif(!$appkey){
        exit('{"code":-1,"msg":"易支付APPKEY不能为空"}');
    }elseif($file){
        exit('{"code":1,"msg":"配置写入成功"}');
    }else{
        exit('{"code":-1,"msg":"权限不足，无法写入"}');
    }
break;

case 'set_pay_alipay_qrcode':
    $appid       = daddslashes($_POST['appid']);
    $private_key = daddslashes($_POST['private_key']);
    $public_key  = daddslashes($_POST['public_key']);
    $text = array(
        'appid'=>$appid,
        'private_key'=>$private_key,
        'public_key'=>$public_key
    );
    $text   = json_encode($text, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
    $file   = file_put_contents(CORE.'plugin/Alipay_Qrcode/config.json',$text);
    if(!$appid){
        exit('{"code":-1,"msg":"APPID不能为空"}');
    }elseif(!$private_key){
        exit('{"code":-1,"msg":"应用私钥不能为空"}');
    }elseif(!$public_key){
        exit('{"code":-1,"msg":"支付宝公钥不能为空"}');
    }elseif($file){
        exit('{"code":1,"msg":"配置写入成功"}');
    }else{
        exit('{"code":-1,"msg":"权限不足，无法写入"}');
    }
break;
    
case 'plugin_notice':
    $id = daddslashes($_GET['id']);
    $row = $DB->get_row("SELECT * FROM website_plugin WHERE id='$id' limit 1");
    $result = file_get_contents(ROOT."system/plugin/".$row['path']."/info.json");
    $arr = json_decode($result,true);
    exit('{"code":1,"msg":"'.$arr['notice'].'"}');
break;
   
case 'plugin_get':
    $path='../system/plugin';
    if(is_dir($path)){
        $dir = scandir($path);
        foreach ($dir as $value){
            $sub_path =$path .'/'.$value;
            if($value == '.' || $value == '..'){
                continue;
            }else{
                $row = $DB->get_row("SELECT * FROM website_plugin WHERE path = '$value'");
                if(!$row){
                    $result = file_get_contents($path."/".$value."/index.json");
                    $arr = json_decode($result,true);
                    $sql = "insert into `website_plugin` (`path`) values ('".$value."')";
                    if($DB->query($sql)){
                        exit('{"code":1,"msg":"载入成功"}');
                    }else{
                        exit('{"code":-1,"msg":"'.$DB->error().'"}');
                    }
                }
            }
        }
    }else{
        exit('{"code":-1,"msg":"检测不到任何插件"}');
    }
break;

/*
case 'plugin_del':
    $id   = daddslashes($_GET['id']);
    $row  = $DB->get_row("SELECT * FROM website_plugin WHERE id='$id' limit 1");
    $sql  = $DB->get_row("DELETE FROM website_plugin where path = ".$row['path']." limit 1");
    $path = '../system/plugin/'.$row['path'];
    if(!$row){
        $result = [
            "code"=>-1,
            "msg"=>"插件不存在"
        ];
    }elseif(delpath($path,0) && $DB->query($sql)){
        $result = [
            "code"=>1,
            "msg"=>"成功"
        ];
    }else{
        $result = [
            "code"=>-1,
            "msg"=>"失败：目录为空"
        ];
    }
break;
*/

case 'set_shop':
    $a = daddslashes($_POST['a']);
    $b = daddslashes($_POST['b']);
    $c = daddslashes($_POST['c']);
    $active = daddslashes($_POST['active']);
	saveSetting('shop_mail_time_money',$a);
	saveSetting('shop_user_chat_money',$b);
	saveSetting('shop_phone_time_money',$c);
	saveSetting('shop_active',$active);
	$ad=$CACHE->clear();
    if($ad){
    $DB->query("insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','修改API','修改用户商城价格信息','".$date."','admin')");
	exit('{"code":1,"msg":"修改成功"}');
	}else{
    exit('{"code":-1,"msg":"修改失败'.$DB->error().'}');
	}
break;

case 'book_set':
	$rewrite = daddslashes($_POST['rewrite']);
	saveSetting('rewrite_book',$rewrite,'知识文档伪静态开关');
    $ad=$CACHE->clear();
    if($rewrite == ''){
        exit('{"code":-1,"msg":"伪静态设置为空"}');
    }elseif($ad) {
        $DB->query("insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','修改','配置知识文档设置','".$date."','admin')");
        exit('{"code":1,"msg":"修改成功"}');
    }else{
        exit('{"code":-1,"msg":"修改失败'.$DB->error().'"}');
    }
break;

case 'article_set':
	$rewrite = daddslashes($_POST['rewrite']);
	saveSetting('rewrite_article',$rewrite);
    $ad=$CACHE->clear();
    if($rewrite == ''){
        exit('{"code":-1,"msg":"伪静态设置为空"}');
    }elseif($ad) {
        $DB->query("insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','修改','配置文章页面设置','".$date."','admin')");
        exit('{"code":1,"msg":"修改成功"}');
    }else{
        exit('{"code":-1,"msg":"修改失败'.$DB->error().'"}');
    }
break;

case 'article_del':
    $id=daddslashes($_GET['id']);
    $row = $DB->get_row("SELECT * FROM website_article WHERE id='$id' limit 1");
	$sql="DELETE FROM website_article WHERE id='$id'";
	if(!$row){
	    exit('{"code":-1,"msg":"ID不存在"}');
	}elseif($DB->query($sql)){
    $DB->query("insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','删除','删除文章：".$row['title']."','".$date."','admin')");
	exit('{"code":1,"msg":"删除成功"}');
	}else{
	exit('{"code":-1,"msg":"删除失败：'.$DB->error().'"}');
	}
break;

case 'article_uid': //排序操作
	$id=daddslashes($_GET['id']);
	$type=daddslashes($_GET['type']);
	if(Article($id,$type)){
		exit('{"code":1,"msg":"成功"}');
	}else{
		exit('{"code":-1,"msg":"失败"}');
	}
break;

case 'program_set':
	$rewrite = daddslashes($_POST['rewrite']);
	saveSetting('rewrite_program',$rewrite);
    $ad=$CACHE->clear();
    if(!$rewrite){
        exit('{"code":-1,"msg":"伪静态设置为空"}');
    }elseif($ad) {
        $DB->query("insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','修改','配置程序页面设置','".$date."','admin')");
        exit('{"code":1,"msg":"修改成功"}');
    }else{
        exit('{"code":-1,"msg":"修改失败'.$DB->error().'"}');
    }
break;
    
case 'program_add':
	$name=daddslashes($_POST['name']);
	$text=daddslashes($_POST['text']);
	$img1=daddslashes($_POST['img1']);
	$img2=daddslashes($_POST['img2']);
	$img3=daddslashes($_POST['img3']);
	$img4=daddslashes($_POST['img4']);
	$img5=daddslashes($_POST['img5']);
	$url=daddslashes($_POST['url']);
	$time=daddslashes($_POST['time']);
	$demo=daddslashes($_POST['demo']);
	$number=daddslashes($_POST['number']);
	$active=daddslashes($_POST['active']);
	$actives=daddslashes($_POST['actives']);
	$log=daddslashes($_POST['log']);
	if(!$time){
	    $time = $date;
	}else{
	    $time = $time;
	}
	$row = $DB->get_row("SELECT * FROM website_program order by uid desc limit 1");
	$uid = $row['uid']+1;
	$sql="insert into `website_program` (`time`,`name`,`text`,`img1`,`img2`,`img3`,`img4`,`img5`,`url`,`number`,`active`,`actives`,`log`,`demo`,`uid`) values ('".$time."','".$name."','".$text."','".$img1."','".$img2."','".$img3."','".$img4."','".$img5."','".$url."','".$number."','".$active."','".$actives."','".$log."','".$demo."','".$uid."')";
	if(!$name){
	exit('{"code":-1,"msg":"添加失败：昵称为空"}');
	}elseif($DB->query($sql)){
	$city=get_ip_city($clientip);
    $DB->query("insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','添加','添加程序列表：".$name.",'".$date."','admin')");
	exit('{"code":1,"msg":"添加成功"}');
	}else{
	exit('{"code":-1,"msg":"添加失败'.$DB->error().'"}');
	}
break;

case 'program_edit':
    $id=daddslashes($_GET['id']);
	$name=daddslashes($_POST['name']);
	$text=daddslashes($_POST['text']);
	$img1=daddslashes($_POST['img1']);
	$img2=daddslashes($_POST['img2']);
	$img3=daddslashes($_POST['img3']);
	$img4=daddslashes($_POST['img4']);
	$img5=daddslashes($_POST['img5']);
	$url=daddslashes($_POST['url']);
	$time=daddslashes($_POST['time']);
	$demo=daddslashes($_POST['demo']);
	$number=daddslashes($_POST['number']);
	$active=daddslashes($_POST['active']);
	$actives=daddslashes($_POST['actives']);
	$log=daddslashes($_POST['log']);
	$sql="update website_program set time='$time',name='$name',text='$text',img1='$img1',img2='$img2',img3='$img3',img4='$img4',img5='$img5',url='$url',number='$number',active='$active',actives='$actives',log='$log',demo='$demo' where id='{$id}'";
	if(!$id){
	exit('{"code":-1,"msg":"修改失败：ID为空"}');   
	}elseif($DB->query($sql)){
	$city=get_ip_city($clientip);
    $DB->query("insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','修改','修改程序列表：".$name.",'".$date."','admin')");
	exit('{"code":1,"msg":"修改成功","id":"'.$id.'"}');
	}else{
	exit('{"code":-1,"msg":"修改失败'.$DB->error().'"}');
	}
break;

case 'program_uid': //排序操作
	$id   = daddslashes($_GET['id']);
	$type = daddslashes($_GET['type']);
	if(Program($id,$type)){
		exit('{"code":1,"msg":"成功"}');
	}else{
		exit('{"code":-1,"msg":"失败"}');
	}
break;

case 'program_del':
    $id=daddslashes($_GET['id']);
    $row = $DB->get_row("SELECT * FROM website_program WHERE id='$id' limit 1");
	$sql="DELETE FROM website_program WHERE id='$id'";
	if(!$row){
	    exit('{"code":-1,"msg":"ID不存在"}');
	}elseif($DB->query($sql)){
	    $DB->query("insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','删除','删除旗下程序：".$row['name']."','".$date."','admin')");
	    exit('{"code":1,"msg":"删除成功"}');
	}else{
	    exit('{"code":-1,"msg":"删除失败：'.$DB->error().'"}');
	}
break;
    
case 'send_mail':
    $mail_user=($conf['mail_recv'] ? $conf['mail_recv'] : $conf['mail_name']);
    $mail_title = '邮件发送测试。';
    $mail_text = '这是一封测试邮件！<br/>来自：'.$siteurl;
    if (!empty($mail_user)) {
        $result=send_mail($mail_user,$mail_title,$mail_text,null);
        if ($result==1) {
            exit('{"code":1,"msg":"邮件发送成功"}');
            $DB->query("insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','发送','发送邮箱调试给：".$mail_user."','".$date."','admin')");
        }else{
            exit('{"code":-1,"msg":"'.$result.'"}');
        }
    }else{
        exit('{"code":-1,"msg":"您还未设置邮箱！"}');
    }
break;

case 'send_message':
    $phone = $udata['phone'];
    $code = '123456';
    $time = '60';
    if ($udata['phone']){
        $result=send_dxb($time,$code,$phone);
        exit('{"code":1,"msg":"'.$result.'"}');
        $DB->query("insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','发送','发送短信调试给：".$phone."，".$result."','".$date."','admin')");
    }else{
        exit('{"code":-1,"msg":"收信号码为空"}');
    }
break;

case 'dxb_post':
    $text='您的验证码为{code}，验证码在{time}秒内有效。打死都不能告诉告诉任何人哦！';
    $smsapi = "https://www.smsbao.com/"; //短信网关
    $user = $conf['message_user']; //短信平台帐号
    $pass = md5($conf['message_pass']); //短信平台密码
    $head = $conf['message_title'];
    $sendurl = $smsapi."api/orange/template.action?u=".$user."&p=".$pass."&s=".$head."&c=".urlencode($text);
    $result = file_get_contents($sendurl) ;
    if(!$conf['message_user'] or !$conf['message_pass']){
    exit('{"code":-1,"msg":"请先完善账号密码！"}');
    }elseif($result=='-1'){
    exit('{"code":-1,"msg":"提交失败"}');
    }else{
    exit('{"code":1,"msg":"提交成功"}');
    $city=get_ip_city($clientip);
    $DB->query("insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','API','使用API提交短信宝模板','".$date."','admin')");
    }
break;
    
case 'kami_money_del':
    $id=daddslashes($_GET['id']);
    $row = $DB->get_row("SELECT * FROM website_kami WHERE id='$id' and type='money' limit 1");
	$sql="DELETE FROM website_kami WHERE id='$id' and type='money'";
	if(!$row){
	    exit('{"code":-1,"msg":"不存在"}');
	}elseif($DB->query($sql)){
	    $DB->query("insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','删除','删除充值卡密：".$row['kami']."','".$date."','admin')");
	    exit('{"code":1,"msg":"删除成功"}');
	}else{
	    exit('{"code":-1,"msg":"删除失败：'.$DB->error().'"}');
	}
break;

case 'kami_money_delall':
	$sql="DELETE FROM website_kami  WHERE type='money'";
	if($DB->query($sql)){
	    $DB->query("insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','删除','清空充值卡密,'".$date."','admin')");
	    exit('{"code":1,"msg":"清空成功"}');
	}else{
	    exit('{"code":-1,"msg":"清空失败：'.$DB->error().'"}');
	}
break;
    
case 'kami_money_add':
	$number=daddslashes($_POST['number']);
	$money=daddslashes($_POST['money']);
	if (!$number) {
	    exit('{"code":-1,"msg":"数量不能为空"}');
	}elseif(!$money) {
	    exit('{"code":-1,"msg":"金额不能为空"}');
	}else{
	    for ($i=1;$i<=$number;$i++) {
	        $kami = get_km();
	        $DB->query("insert into `website_kami` (`add_time`,`kami`,`money`,`active`,`type`) values ('".$date."','".$kami."','".$money."','0','money')");
	    }
	    $DB->query("insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','生成','生成充值卡密：".$money."元，".$number."个','".$date."','admin')");
	    exit('{"code":1,"msg":"生成成功"}');
	}
break;

case 'template_del':
    $uid=daddslashes($_GET['uid']);
    $row = $DB->get_row("SELECT * FROM website_template WHERE uid='$uid' limit 1");
	$sql="DELETE FROM website_template WHERE uid='$uid'";
	if($DB->query($sql)){
	    $DB->query("insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','删除','删除模板：".$row['name']."，".$row['path']."，".$row['type']."','".$date."','admin')");
	    exit('{"code":1,"msg":"删除成功"}');
	}else{
	    exit('{"code":-1,"msg":"删除失败：'.$DB->error().'"}');
	}
break;
    
case 'template_edit':
    $uid=daddslashes($_POST['uid']);
	$path=daddslashes($_POST['path']);
	$name=daddslashes($_POST['name']);
	$type=daddslashes($_POST['type']);
	$sql="update website_template set path='$path',name='$name',type='$type' where uid='$uid'";
	$row = $DB->get_row("SELECT * FROM website_template WHERE uid='$uid' limit 1");
	if($DB->query($sql)){
	    $DB->query("insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','修改','修改模板：".$row['name']."，".$row['path']."，".$row['type']."','".$date."','admin')");
	    exit('{"code":1,"msg":"修改成功"}');
	}else{
	    exit('{"code":-1,"msg":"修改失败'.$DB->error().'"}');
	}
break;

case 'template_add':
	$path=daddslashes($_POST['path']);
	$name=daddslashes($_POST['name']);
	$type=daddslashes($_POST['type']);
	$row = $DB->get_row("SELECT * FROM website_template WHERE path='$path' and type='$type' limit 1");
	$sql="insert into `website_template` (`path`,`name`,`type`) values ('".$path."','".$name."','".$type."')";
	if($row){
	    exit('{"code":-1,"msg":"当前类型模板目录已存在"}');
	}elseif($DB->query($sql)){
	    $DB->query("insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','添加','添加模板：".$name."，".$path."，".$type."','".$date."','admin')");
	    exit('{"code":1,"msg":"添加成功"}');
	}else{
	    exit('{"code":-1,"msg":"添加失败'.$DB->error().'"}');
	}
break;

case 'template_automatic_index':
    $path=CORE.'template/index';
    if(is_dir($path)){
        $dir = scandir($path);
        foreach ($dir as $value){
            $sub_path =$path .'/'.$value;
            if($value == '.' || $value == '..'){
                continue;
            }else{
                $row = $DB->get_row("SELECT * FROM website_template WHERE path = '$value' and type = 'index'");
                if(!$row){
                    $result = file_get_contents($path."/".$value."/index.json");
                    $arr = json_decode($result,true);
                    $sql = "insert into `website_template` (`path`,`name`,`type`) values ('".$value."','".$arr['name']."','".$arr['type']."')";
                    if($DB->query($sql)){
                        exit('{"code":1,"msg":"载入新模板成功"}');
                    }else{
                        exit('{"code":-1,"msg":"'.$DB->error().'"}');
                    }
                }
            }
        }
    }else{
        exit('{"code":-1,"msg":"检测不到任何模板"}');
    }
break;

case 'template_automatic_admin_login':
    $path=CORE.'template/admin/login';
    if(is_dir($path)){
        $dir = scandir($path);
        foreach ($dir as $value){
            $sub_path =$path .'/'.$value;
            if($value == '.' || $value == '..'){
                continue;
            }else{
                $row = $DB->get_row("SELECT * FROM website_template WHERE path = '$value' and type = 'admin_login'");
                if(!$row){
                    $result = file_get_contents($path."/".$value."/index.json");
                    $arr = json_decode($result,true);
                    $sql = "insert into `website_template` (`path`,`name`,`type`) values ('".$value."','".$arr['name']."','".$arr['type']."')";
                    if($DB->query($sql)){
                        exit('{"code":1,"msg":"载入新模板成功"}');
                    }else{
                        exit('{"code":-1,"msg":"'.$DB->error().'"}');
                    }
                }
            }
        }
    }else{
        exit('{"code":-1,"msg":"检测不到任何模板"}');
    }
break;

case 'template_automatic_user_login':
    $path=CORE.'template/user/login';
    if(is_dir($path)){
        $dir = scandir($path);
        foreach ($dir as $value){
            $sub_path =$path .'/'.$value;
            if($value == '.' || $value == '..'){
                continue;
            }else{
                $row = $DB->get_row("SELECT * FROM website_template WHERE path = '$value' and type = 'user_login'");
                if(!$row){
                    $result = file_get_contents($path."/".$value."/index.json");
                    $arr = json_decode($result,true);
                    $sql = "insert into `website_template` (`path`,`name`,`type`) values ('".$value."','".$arr['name']."','".$arr['type']."')";
                    if($DB->query($sql)){
                        exit('{"code":1,"msg":"载入新模板成功"}');
                    }else{
                        exit('{"code":-1,"msg":"'.$DB->error().'"}');
                    }
                }
            }
        }
    }else{
        exit('{"code":-1,"msg":"检测不到任何模板"}');
    }
break;

case 'template_automatic_user_reg':
    $path=CORE.'template/user/reg';
    if(is_dir($path)){
        $dir = scandir($path);
        foreach ($dir as $value){
            $sub_path =$path .'/'.$value;
            if($value == '.' || $value == '..'){
                continue;
            }else{
                $row = $DB->get_row("SELECT * FROM website_template WHERE path = '$value' and type = 'user_reg'");
                if(!$row){
                    $result = file_get_contents($path."/".$value."/index.json");
                    $arr = json_decode($result,true);
                    $sql = "insert into `website_template` (`path`,`name`,`type`) values ('".$value."','".$arr['name']."','".$arr['type']."')";
                    if($DB->query($sql)){
                        exit('{"code":1,"msg":"载入新模板成功"}');
                    }else{
                        exit('{"code":-1,"msg":"'.$DB->error().'"}');
                    }
                }
            }
        }
    }else{
        exit('{"code":-1,"msg":"检测不到任何模板"}');
    }
break;
    
case 'set_template_index':
    $template_index = daddslashes($_POST['template_index']);
	saveSetting('template_index',$template_index);
	$row = $DB->get_row("SELECT * FROM website_template WHERE path='$template_index' limit 1");
	$ad=$CACHE->clear();
    if($ad){
        $DB->query("insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','修改','修改网站首页模板为：".$row['name']."，".$row['path']."，".$row['type']."','".$date."','admin')");
        exit('{"code":1,"msg":"修改成功"}');
	}else{
	    exit('{"code":-1,"msg":"修改失败'.$DB->error().'}');
	}
break;

case 'set_template_admin_login':
    $template_admin_login = daddslashes($_POST['template_admin_login']);
	saveSetting('template_admin_login',$template_admin_login);
	$row = $DB->get_row("SELECT * FROM website_template WHERE path='$template_admin_login' limit 1");
	$ad=$CACHE->clear();
    if($ad){
    $city=get_ip_city($clientip);
    $DB->query("insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','修改','修改站长登录模板为：".$row['name']."，".$row['path']."，".$row['type']."','".$date."','admin')");
	exit('{"code":1,"msg":"修改成功"}');
	}else{
    exit('{"code":-1,"msg":"修改失败'.$DB->error().'"}');
	}
break;

case 'set_template_user_login':
    $template_user_login = daddslashes($_POST['template_user_login']);
	saveSetting('template_user_login',$template_user_login);
	$row = $DB->get_row("SELECT * FROM website_template WHERE path='$template_user_login' limit 1");
	$ad=$CACHE->clear();
    if($ad){
        $DB->query("insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','修改','修改用户登录模板为：".$row['name']."，".$row['path']."，".$row['type']."','".$date."','admin')");
        exit('{"code":1,"msg":"修改成功"}');
	}else{
	    exit('{"code":-1,"msg":"修改失败'.$DB->error().'"}');
	}
break;

case 'set_template_user_reg':
    $template_user_reg = daddslashes($_POST['template_user_reg']);
	saveSetting('template_user_reg',$template_user_reg);
	$row = $DB->get_row("SELECT * FROM website_template WHERE path='$template_user_reg' limit 1");
	$ad=$CACHE->clear();
    if($ad){
        $DB->query("insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','修改','修改用户注册模板为：".$row['name']."，".$row['path']."，".$row['type']."','".$date."','admin')");
        exit('{"code":1,"msg":"修改成功"}');
	}else{
	    exit('{"code":-1,"msg":"修改失败'.$DB->error().'"}');
	}
break;

case 'set_mail':
    $mail_smtp = daddslashes($_POST['mail_smtp']);
    $mail_port = daddslashes($_POST['mail_port']); 
    $mail_name = daddslashes($_POST['mail_name']);
    $mail_pwd  = daddslashes($_POST['mail_pwd']);
    $mail_recv = daddslashes($_POST['mail_recv']);
    $mail_user = daddslashes($_POST['mail_user']);
    $mail_encrypt = daddslashes($_POST['mail_encrypt']);
    $mail_template = daddslashes($_POST['mail_template']);
    $mail_title = daddslashes($_POST['mail_title']);
	saveSetting('mail_smtp',$mail_smtp);
	saveSetting('mail_port',$mail_port);
	saveSetting('mail_name',$mail_name);
	saveSetting('mail_pwd',$mail_pwd);
	saveSetting('mail_recv',$mail_recv);
	saveSetting('mail_user',$mail_user);
	saveSetting('mail_encrypt',$mail_encrypt);
	saveSetting('mail_template',$mail_template);
	saveSetting('mail_title',$mail_title);
	$ad=$CACHE->clear();
    if($ad){
        $DB->query("insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','修改','修改邮箱发信配置','".$date."','admin')");
        exit('{"code":1,"msg":"修改成功"}');
	}else{
	    exit('{"code":-1,"msg":"修改失败'.$DB->error().'"}');
	}
break;

case 'set_message':
    $user  = daddslashes($_POST['user']);
    $pass  = daddslashes($_POST['pass']); 
    $title = daddslashes($_POST['title']);
	saveSetting('message_user',$user);
	saveSetting('message_pass',$pass);
	saveSetting('message_title',$title);
	$ad=$CACHE->clear();
    if($ad){
        $DB->query("insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','修改','修改短信发信配置','".$date."','admin')");
        exit('{"code":1,"msg":"修改成功"}');
	}else{
	    exit('{"code":-1,"msg":"修改失败'.$DB->error().'"}');
	}
break;

case 'set_chat_message':
    $id  = daddslashes($_POST['id']);
    $row = $DB->get_row("SELECT * FROM website_chat WHERE id = '".$id."' limit 1");
    if($row){
        exit('{"code":1,"msg":"'.$row['message'].'"}');
	}else{
	    exit('{"code":-1,"msg":"系统无记录"}');
	}
break;

case 'set_chat_active':
    $id = daddslashes($_GET['id']);
    $row = $DB->get_row("SELECT * FROM website_chat WHERE id='$id' limit 1");
    if($row['active']=='0'){
        $sql="update website_chat set active='1' where id='{$id}'";
    }elseif($row['active']=='1'){
        $sql="update website_chat set active='0' where id='{$id}'";
    }
	if(!$row){
	    exit('{"code":-1,"msg":"聊天记录不存在"}');    
	}elseif($DB->query($sql)){
	    $DB->query("insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','修改','修改聊天记录".$row['id']."状态','".$date."','admin')");
	    exit('{"code":1,"msg":"成功"}');
	}else{
	    exit('{"code":-1,"msg":"失败'.$DB->error().'"}');
	}
break;

case 'set_chat_del':
    $id = daddslashes($_GET['id']);
	$row = $DB->get_row("SELECT * FROM website_chat WHERE id='$id' limit 1");
	$sql="DELETE FROM website_chat WHERE id='$id'";
	$log_sql="insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','删除','删除用户聊天记录：".$row['message']."','".$date."','admin')";
	if($DB->query($sql) && $DB->query($log_sql)){
	    exit('{"code":1,"msg":"成功"}');
	}else{
	    exit('{"code":-1,"msg":"失败'.$DB->error().'"}');
	}
break;

case 'set_chat_user':
    $chat_user_word = daddslashes($_POST['chat_user_word']);
    $chat_user_active = daddslashes($_POST['chat_user_active']);
	saveSetting('chat_user_word',$chat_user_word);
	saveSetting('chat_user_active',$chat_user_active);
	$ad=$CACHE->clear();
	if($ad){
	    $DB->query("insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','修改','修改用户聊天室配置','".$date."','admin')");
	    exit('{"code":1,"msg":"修改成功"}');
	}else{
	    exit('{"code":-1,"msg":"修改失败'.$DB->error().'"}');
	}
break;

case 'set_notice':
    $site_notice = daddslashes($_POST['site_notice']);
    $site_active_notice = daddslashes($_POST['site_active_notice']);
    $pay_notice = daddslashes($_POST['pay_notice']);
    $pay_personal_notice = daddslashes($_POST['pay_personal_notice']);
    $chat_user_notice = daddslashes($_POST['chat_user_notice']);
    $chat_user_active_notice = daddslashes($_POST['chat_user_active_notice']);
    saveSetting('site_notice',$site_notice);
	saveSetting('site_active_notice',$site_active_notice);
	saveSetting('pay_notice',$pay_notice);
	saveSetting('pay_personal_notice',$pay_personal_notice);
	saveSetting('chat_user_notice',$chat_user_notice);
	saveSetting('chat_user_active_notice',$chat_user_active_notice);
	$ad=$CACHE->clear();
	if($ad){
	    $DB->query("insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','修改','修改网站公告','".$date."','admin')");
	    exit('{"code":1,"msg":"修改成功"}');
	}else{
	    exit('{"code":-1,"msg":"修改失败'.$DB->error().'"}');
	}
break;

case 'set_site':
    $site_title=daddslashes($_POST['site_title']);
    $site_keywords=daddslashes($_POST['site_keywords']);
    $site_description=daddslashes($_POST['site_description']);
    $site_jump=daddslashes($_POST['site_jump']);
    $site_active=daddslashes($_POST['site_active']);
    $site_qq=daddslashes($_POST['site_qq']);
    $site_mail=daddslashes($_POST['site_mail']);
    $site_phone=daddslashes($_POST['site_phone']);
    $site_beian=daddslashes($_POST['site_beian']);
    $site_copyright=daddslashes($_POST['site_copyright']);
    $site_date=daddslashes($_POST['site_date']);
    $site_baidu=daddslashes($_POST['site_baidu']);
    $site_ip=daddslashes($_POST['site_ip']);
    $system_visit=daddslashes($_POST['system_visit']);
	saveSetting('site_title',$site_title);
	saveSetting('site_keywords',$site_keywords);
	saveSetting('site_description',$site_description);
	saveSetting('site_jump',$site_jump);
	saveSetting('site_active',$site_active);
	saveSetting('site_qq',$site_qq);
	saveSetting('site_mail',$site_mail);
	saveSetting('site_phone',$site_phone);
	saveSetting('site_beian',$site_beian);
	saveSetting('site_copyright',$site_copyright);
	saveSetting('site_date',$site_date);
	saveSetting('site_baidu',$site_baidu);
	saveSetting('site_ip',$site_ip);
	saveSetting('system_visit',$system_visit,'全站访问记录开关，1为开');
	$ad=$CACHE->clear();
	if($ad){
	    $DB->query("insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','修改','修改网站信息','".$date."','admin')");
	    exit('{"code":1,"msg":"修改成功"}');
	}else{
	    exit('{"code":-1,"msg":"修改失败'.$DB->error().'"}');
	}
break;

case 'set_api_bing':
    $money = daddslashes($_POST['money']);
    $active = daddslashes($_POST['active']);
	saveSetting('api_bing_money',$money);
	saveSetting('api_bing_active',$active);
	$ad=$CACHE->clear();
	if($money==null){
	    exit('{"code":-1,"msg":"单价不能为空"}');
	}elseif(!$active){
	    exit('{"code":-1,"msg":"状态不能为空"}');
	}elseif($ad){
	    $DB->query("insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','修改API','修改必应每日一图为：单价：".$money."，状态：".$active."','".$date."','admin')");
	    exit('{"code":1,"msg":"修改成功"}');
	}else{
	    exit('{"code":-1,"msg":"修改失败'.$DB->error().'"}');
	}
break;

case 'set_api_photo':
    $money = daddslashes($_POST['money']);
    $active = daddslashes($_POST['active']);
	saveSetting('api_photo_money',$money);
	saveSetting('api_photo_active',$active);
	$ad=$CACHE->clear();
	if($money==null){
	    exit('{"code":-1,"msg":"单价不能为空"}');
	}elseif(!$active){
	    exit('{"code":-1,"msg":"状态不能为空"}');
	}elseif($ad){
	    $DB->query("insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','修改API','修改随机图片接口为：单价：".$money."，状态：".$active."','".$date."','admin')");
	    exit('{"code":1,"msg":"修改成功"}');
	}else{
	    exit('{"code":-1,"msg":"修改失败'.$DB->error().'"}');
	}
break;

case 'set_api_mail':
	$smtp    = daddslashes($_POST['smtp']);
	$port    = daddslashes($_POST['port']);
	$name    = daddslashes($_POST['name']);
	$pwd     = daddslashes($_POST['pwd']);
    $money   = daddslashes($_POST['money']);
    $active  = daddslashes($_POST['active']);
    $user    = daddslashes($_POST['user']);
    $encrypt = daddslashes($_POST['encrypt']);
    saveSetting('api_mail_smtp',$smtp);
    saveSetting('api_mail_port',$port);
    saveSetting('api_mail_name',$name);
    saveSetting('api_mail_pwd',$pwd);
	saveSetting('api_mail_money',$money);
	saveSetting('api_mail_active',$active);
	saveSetting('api_mail_user',$user);
	saveSetting('api_mail_encrypt',$encrypt);
	$ad=$CACHE->clear();
	if($smtp==null){
	    exit('{"code":-1,"msg":"SMTP服务器为空"}');
	}elseif($port==null){
	    exit('{"code":-1,"msg":"SMTP端口为空"}');
	}elseif($name==null){
	    exit('{"code":-1,"msg":"邮箱账户为空"}');
	}elseif($pwd==null){
	    exit('{"code":-1,"msg":"邮箱密码为空"}');
	}elseif($money==null){
	    exit('{"code":-1,"msg":"单价不能为空"}');
	}elseif($active==null){
	    exit('{"code":-1,"msg":"状态不能为空"}');
	}elseif($user==null){
	    exit('{"code":-1,"msg":"发信账号不能为空"}');
	}elseif($encrypt==null){
	    exit('{"code":-1,"msg":"加密方式不能为空"}');
	}elseif($ad){
	    $DB->query("insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','修改API','修改邮件发件接口：单价：".$money."，状态：".$active."','".$date."','admin')");
	    exit('{"code":1,"msg":"修改成功"}');
	}else{
	    exit('{"code":-1,"msg":"修改失败'.$DB->error().'"}');
	}
break;

case 'set_api_qrcode':
    $money  = daddslashes($_POST['money']);
    $active = daddslashes($_POST['active']);
	saveSetting('api_qrcode_money',$money);
	saveSetting('api_qrcode_active',$active);
	$ad=$CACHE->clear();
	if($money==null){
	    exit('{"code":-1,"msg":"单价不能为空"}');
	}elseif($active==null){
	    exit('{"code":-1,"msg":"状态不能为空"}');
	}elseif($ad){
	    $DB->query("insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','修改API','修改二维码生成接口为：单价：".$money."，状态：".$active."','".$date."','admin')");
	    exit('{"code":1,"msg":"修改成功"}');
	}else{
	    exit('{"code":-1,"msg":"修改失败'.$DB->error().'"}');
	}
break;

case 'set_cron':
    $key = daddslashes($_POST['key']);
	$ip  = daddslashes($_POST['ip']);
	$active = daddslashes($_POST['active']);
	saveSetting('system_cron_key',$key);
    saveSetting('system_cron_ip',$ip);
    saveSetting('system_cron_ip_active',$active);
    $ad=$CACHE->clear();
    if(!$key){
        exit('{"code":-1,"msg":"监控密钥不能为空"}');
    }elseif($ad) {
        $DB->query("insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','修改','修改系统监控信息','".$date."','admin')");
        exit('{"code":1,"msg":"修改成功"}');
    }else{
        exit('{"code":-1,"msg":"修改失败'.$DB->error().'"}');
    }
break;

case 'huancun':
    $DB->query("insert into `website_log` (`uid`,`ip`,`city`,`type`,`content`,`date`,`user`) values ('".$udata['uid']."','".$clientip."','".$city."','清除','清除系统缓存','".$date."','admin')");
	exit('{"code":1,"msg":"无意义操作"}');
break;

default:
	exit('{"code":-4,"msg":"No Act"}');
break;
}