<?php

use com\JsonDal;
require "com/JsonDal.php";
header("content-type:text/html; charset=utf-8");

/********
 * ��������sae�е�MySql���ݿ�
 */
define ( 'SAE_MYSQL_HOST_M', 'w.rdc.sae.sina.com.cn' ); //�����ַ
define ( 'SAE_MYSQL_HOST_S', 'r.rdc.sae.sina.com.cn' ); //�ӿ��ַ
define ( 'SAE_MYSQL_PORT', 3307 ); //���ݿ�˿�
define ( 'SAE_MYSQL_USER', SAE_ACCESSKEY ); //���ݿ��û���
define ( 'SAE_MYSQL_PASS', SAE_SECRETKEY ); //���ݿ�����
define ( 'SAE_MYSQL_DB', 'app_' . $_SERVER ['HTTP_APPNAME'] ); //���ݿ�����mysqlģ��Ϊ��:

$link = mysql_connect ( SAE_MYSQL_HOST_M . ':' . SAE_MYSQL_PORT, SAE_MYSQL_USER, SAE_MYSQL_PASS );
mysql_query("use ".SAE_MYSQL_DB);


//$link = mysql_connect('localhost','root','123456');
//mysql_query("use mysqldemo");
mysql_query("set character set 'utf8'");//���� 
mysql_query("set names 'utf8'");//д�� 
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