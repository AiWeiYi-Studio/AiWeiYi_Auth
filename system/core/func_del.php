<?php
/*
* @Time    : 2022/05/22 20:57
* @Author  : 爱唯逸网络科技
* @Mail    : support@857xx.cn
* @Site    : https://web.857xx.cn
* @File    : func_del.php
* @Action  : 删除目录、删除文件
*/
function delpath($pathdir){
    if(is_file($pathdir)){
        return unlink($pathdir);
    }if(is_empty_dir($pathdir)){
        return rmdir($pathdir);
    }else{
        $d=dir($pathdir);
        while($a=$d->read()){
            if(is_file($pathdir.'/'.$a) && ($a!='.') && ($a!='..')){
                return unlink($pathdir.'/'.$a);
            }
            if(is_dir($pathdir.'/'.$a) && ($a!='.') && ($a!='..')){
                if(!is_empty_dir($pathdir.'/'.$a)){
                    delpath($pathdir.'/'.$a);
                }
                if(is_empty_dir($pathdir.'/'.$a)){
                    return rmdir($pathdir.'/'.$a);
                }
            }
        }
        $d->close();
    }
}

function is_empty_dir($pathdir){
    //判断目录是否为空，我的方法不是很好吧？只是看除了.和..之外有其他东西不是为空
    $d=opendir($pathdir);
    $i=0;
    while($a=readdir($d)){
        $i++;
    }
    closedir($d);
    if($i>2){
        return false;
    }else{
        return true;
    }

}
?>