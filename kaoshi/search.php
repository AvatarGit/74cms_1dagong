<?php
 /*
 * �鿴����
*/
define('IN_QISHI', true);
require_once(dirname(__FILE__).'/../include/common.inc.php');
$act = isset($_REQUEST['act']) ? trim($_REQUEST['act']) : 'app';
require_once(dirname(__FILE__).'/../include/mysql.class.php');
$db = new mysql($dbhost,$dbuser,$dbpass,$dbname);
$name=trim($_POST['name']);
$phone1=trim($_POST['phone1']);
$identity_id=trim($_POST['identity_id']);
	if($name && $phone1 && $identity_id)
	{
		$sql="select * from qs_baoming where name='{$name}' and phone1 = '{$phone1}' and identity_id = '{$identity_id}'";
		//echo $sql;exit;
		$res=$db->getone($sql);
		//print_r($res);exit;
		if(empty($res))///-----����
		{
			echo "����������:".$res['name']; 
		}else{///---
			echo "<script language=\"JavaScript\">\r\n";echo "alert(\"û�ж�Ӧ��Ϣ\");\r\n";echo " history.back();\r\n"; 	
		}
		//print_r($res);exit;
	}else
	{
		echo "<script language=\"JavaScript\">\r\n";echo "alert(\"����д�������绰��������֤��\");\r\n";echo " history.back();\r\n";   echo "</script>";
	}

?>
