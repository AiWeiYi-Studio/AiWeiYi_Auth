# 爱唯逸授权系统

#### 介绍
- 目前已着手开发基于ThinkPHP的授权系统
- 爱唯逸授权系统，多应用授权
- 如果遇到Bug可自行修复，如果实在无法修复可提交Issues


#### 安装教程

上传到您的网站根目录，访问网站即可

#### 开发环境

```
Nginx 1.20.2 + PHP-7.3 + MySQL 5.6.50
```

#### 配置伪静态规则（Nginx）：

```nginx
location / {
  if (!-e $request_filename) {
  rewrite ^/article/index.html$ /page/article/index.php last;
  rewrite ^/article/class.html$ /page/article/class.php last;
  rewrite ^/article/(.[0-9]*).html$ /page/article/page.php?id=$1 last;
  rewrite ^/program/index.html$ /page/program/index.php last;
  rewrite ^/program/(.[0-9]*).html$ /page/program/page.php?id=$1 last;
  rewrite ^/demo/index.html$ /page/demo/index.php last;
  rewrite ^/go.html$ /page/page/go.php last;
  rewrite ^/privacy/index.html$ /page/privacy/index.php last;
  rewrite ^/privacy/search.html$ /page/privacy/search.php last;
  rewrite ^/privacy/(.*).html$ /page/privacy/page.php?key=$1 last;
  error_page 404 = /page/page/404.php;
 }
}
```