<?php

use com\JsonDal;
require "com/JsonDal.php";
header("content-type:text/html; charset=utf-8");

/********
 * 链接新浪sae中的MySql数据库
 */
define ( 'SAE_MYSQL_HOST_M', 'w.rdc.sae.sina.com.cn' ); //主库地址
define ( 'SAE_MYSQL_HOST_S', 'r.rdc.sae.sina.com.cn' ); //从库地址
define ( 'SAE_MYSQL_PORT', 3307 ); //数据库端口
define ( 'SAE_MYSQL_USER', SAE_ACCESSKEY ); //数据库用户名
define ( 'SAE_MYSQL_PASS', SAE_SECRETKEY ); //数据库密码
define ( 'SAE_MYSQL_DB', 'app_' . $_SERVER ['HTTP_APPNAME'] ); //数据库名以mysql模块为例:

$link = mysql_connect ( SAE_MYSQL_HOST_M . ':' . SAE_MYSQL_PORT, SAE_MYSQL_USER, SAE_MYSQL_PASS );
mysql_query("use ".SAE_MYSQL_DB);


//$link = mysql_connect('localhost','root','123456');
//mysql_query("use mysqldemo");
mysql_query("set character set 'utf8'");//读库 
mysql_query("set names 'utf8'");//写库 
$result = mysql_query("select * from t_info ",$link);



while($rs = mysql_fetch_assoc($result))
{
	//echo("<P>" . $rs["Name"] . "</P>");
	$info[]=$rs;
	//$json=json_encode($rs);  
    //echo $json;  
}

$dal = new JsonDal();

$sss = $dal->JSON($info);
print_r($sss);



?>