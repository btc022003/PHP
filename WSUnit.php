<?php
use com\JsonDal;
require "com/JsonDal.php";
header ( "content-type:text/html; charset=utf-8" );
/**
 * ******
 * ��������sae�е�MySql���ݿ�
 */
define ( 'SAE_MYSQL_HOST_M', 'w.rdc.sae.sina.com.cn' ); // �����ַ
define ( 'SAE_MYSQL_HOST_S', 'r.rdc.sae.sina.com.cn' ); // �ӿ��ַ
define ( 'SAE_MYSQL_PORT', 3307 ); // ���ݿ�˿�
define ( 'SAE_MYSQL_USER', SAE_ACCESSKEY ); // ���ݿ��û���
define ( 'SAE_MYSQL_PASS', SAE_SECRETKEY ); // ���ݿ�����
define ( 'SAE_MYSQL_DB', 'app_' . $_SERVER ['HTTP_APPNAME'] ); // ���ݿ�����mysqlģ��Ϊ��:
$link = mysql_connect ( SAE_MYSQL_HOST_M . ':' . SAE_MYSQL_PORT, SAE_MYSQL_USER, SAE_MYSQL_PASS );
mysql_query ( "use " . SAE_MYSQL_DB );
mysql_query ( "set character set 'utf8'" ); // ����
mysql_query ( "set names 'utf8'" ); // д��

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