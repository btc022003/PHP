<?php
use com\JsonDal;
require "com/JsonDal.php";
header ( "content-type:text/html; charset=utf-8" );
/**
 * ******
 * 链接新浪sae中的MySql数据库
 */
define ( 'SAE_MYSQL_HOST_M', 'w.rdc.sae.sina.com.cn' ); // 主库地址
define ( 'SAE_MYSQL_HOST_S', 'r.rdc.sae.sina.com.cn' ); // 从库地址
define ( 'SAE_MYSQL_PORT', 3307 ); // 数据库端口
define ( 'SAE_MYSQL_USER', SAE_ACCESSKEY ); // 数据库用户名
define ( 'SAE_MYSQL_PASS', SAE_SECRETKEY ); // 数据库密码
define ( 'SAE_MYSQL_DB', 'app_' . $_SERVER ['HTTP_APPNAME'] ); // 数据库名以mysql模块为例:
$link = mysql_connect ( SAE_MYSQL_HOST_M . ':' . SAE_MYSQL_PORT, SAE_MYSQL_USER, SAE_MYSQL_PASS );
mysql_query ( "use " . SAE_MYSQL_DB );
mysql_query ( "set character set 'utf8'" ); // 读库
mysql_query ( "set names 'utf8'" ); // 写库

$action = $_POST ['action'];
if ('save' == $action) {
	$body = $_POST ['message'];
	$time = $_POST ['time'];
	$color = $_POST ['color'];
	$sql = "INSERT INTO message (body,time,color) VALUES ('$body','$time','$color' ) ";
	$result = mysql_query ( $sql, $link );
	if ($result) {
		echo 'true';
	} else {
		echo 'false';
	}
	exit ();
} else if ('load' == $action) {
	$sql = 'SELECT * FROM message';
	$result = mysql_query ( $sql );
	while ( $rs = mysql_fetch_assoc ( $result ) ) {
		$info [] = $rs;
	}
	
	$dal = new JsonDal ();
	$sss = $dal->JSON ( $info );
	echo json_encode ( $sss );
	exit ();
} else {
	print_r ( "err" );
}
?>