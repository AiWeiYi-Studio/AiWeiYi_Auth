<?php
/*
* @Time    : 2022/05/22 20:57
* @Author  : 爱唯逸网络科技
* @Mail    : support@857xx.cn
* @Site    : https://web.857xx.cn
* @File    : cache.class.php
* @Action  : 查询数据库配置表
*/

if(!defined('IN_CRONLITE'))exit();
class CACHE {
	public function read() {
		global $DB;
		$row=$DB->get_row("SELECT v FROM website_config WHERE k='cache' limit 1");
		return $row['v'];
	}
	public function save($value) {
		if (is_array($value)) $value = serialize($value);
		if(CACHE_FILE==1) return file_put_contents($this->file_name,'<?php exit;//'.$value);
		global $DB;
		$value = addslashes($value);
		return $DB->query("update website_config set v='$value' where k='cache'");
	}
	public function pre_fetch(){
		global $_CACHE;
		$_CACHE=array();
		$cache = $this->read();
		$_CACHE = array_merge(@unserialize($cache),$_COOKIE);
		if(empty($_CACHE['version']) || $_GET['clearcache'])$_CACHE = $this->update();
		return $_CACHE;
	}
	public function update() {
		global $DB;
		$cache = array();
		$query = $DB->query('SELECT * FROM website_config where 1');
		while($result = $DB->fetch($query)){
			if($result['k']=='cache') continue;
			$cache[ $result['k'] ] = $result['v'];
		}
		$this->save($cache);
		return $cache;
	}
	public function clear() {
		global $DB;
		return $DB->query("update website_config set v='' where k='cache'");
	}
}
