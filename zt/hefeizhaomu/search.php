<?php
 /*
 * �鿴����
*/
define('IN_QISHI', true);
require_once(dirname(__FILE__).'/../../include/common.inc.php');
$act = isset($_REQUEST['act']) ? trim($_REQUEST['act']) : '';
require_once(dirname(__FILE__).'/../../include/mysql.class.php');
$db = new mysql($dbhost,$dbuser,$dbpass,$dbname);
if($act == 'zhuangtai'){
$name=trim($_POST['name']);
$phone1=trim($_POST['phone1']);
$identity_id=trim($_POST['identity_id']);
	if($name && $phone1 && $identity_id)
	{
		$sql="select * from qs_baoming where name='{$name}' and phone1 = '{$phone1}' and identity_id = '{$identity_id}'";
		//echo $sql;exit;
		$res=$db->getone($sql);
		//print_r($res);exit;
		if($res)///-----����
		{
			
			if($res['status'] == 1){
				//echo "���ı����Ѿ����ͨ����";
				include("tongguo.html");exit;
			}elseif($res['status'] == 0){
				//echo "��������д����Ϣ��û����ˣ������ĵȴ���";
				//include("tongguo.html");exit;
				include("weitongguo.html");exit;
			}
			elseif($res['status'] == 2){
				include("weitongguo.html");exit;
				//echo "��������д����Ϣ���û��ͨ�������˴��޸�����";
			}
			
			
		}else{///---
			echo "<script language=\"JavaScript\">\r\n";echo "alert(\"��д��Ϣ��������û������ڣ�\");\r\n";echo " history.back();\r\n"; echo "</script>";	
		}
		//print_r($res);exit;
	}else
	{
		echo "<script language=\"JavaScript\">\r\n";echo "alert(\"�����Ϣ��д�������ٲ�ѯ\");\r\n";echo " history.back();\r\n";   echo "</script>";
	}
	
}
if($act == 'gaixinxi')
{
	$id=$_REQUEST['id'];
	if($id)
	{
		$sql="select * from qs_baoming where id='{$id}'";
		//echo $sql;exit;
		$res=$db->getone($sql);
		include("gaixinxi.html");
	}
}
if($act == 'xinxigai'){
$name=trim($_POST['name']);
$phone1=trim($_POST['phone1']);
$identity_id=trim($_POST['identity_id']);
	if($name && $phone1 && $identity_id)
	{
		$sql="select * from qs_baoming where name='{$name}' and phone1 = '{$phone1}' and identity_id = '{$identity_id}'";
		//echo $sql;exit;
		$res=$db->getone($sql);
		//print_r($res);exit;
		if($res)///-----����
		{
			
			if($res['status'] == 1){
				//echo "���ı����Ѿ����ͨ����";
				echo "<script language=\"JavaScript\">\r\n";echo "alert(\"���Ѿ�ͨ����ˣ�����Ҫ�޸������ˣ�\");\r\n";echo " history.back();\r\n";   echo "</script>";exit;
			}
			if($res['status'] == 0 || $res['status'] == 2)
			{
				
				$id=$res['id'];
				if($id)
				{
					$sql="select * from qs_baoming where id='{$id}'";
					//echo $sql;exit;
					$res=$db->getone($sql);
					include("gaixinxi.html");
				}
			}
			
		}else{///---
			echo "<script language=\"JavaScript\">\r\n";echo "alert(\"��д��Ϣ��������û������ڣ�\");\r\n";echo " history.back();\r\n"; echo "</script>";	
		}
		//print_r($res);exit;
	}else
	{
		echo "<script language=\"JavaScript\">\r\n";echo "alert(\"����д������Ϣ��\");\r\n";echo " history.back();\r\n";   echo "</script>";
	}
	
}
if($act == 'zhunkaozheng'){
$name=trim($_POST['name']);
$phone1=trim($_POST['phone1']);
$identity_id=trim($_POST['identity_id']);
	if($name && $phone1 && $identity_id)
	{
		$sql="select * from qs_baoming where name='{$name}' and phone1 = '{$phone1}' and identity_id = '{$identity_id}'";
		//echo $sql;exit;
		$res=$db->getone($sql);
		//print_r($res);exit;
		if($res)///-----����
		{
			
			if($res['status'] == 1){
				if($res['ksbh'] == ''){
					echo "<script language=\"JavaScript\">\r\n";echo "alert(\"����׼��֤��ʱ���������У����Ժ����ԣ�\");\r\n";echo " history.back();\r\n"; echo "</script>";	
				}else{
					// echo "<script language=\"JavaScript\">\r\n";echo "alert(\"��ӡ׼��֤��ʱ��δ���ţ�\");\r\n";echo " history.back();\r\n"; echo "</script>";					
					include("zhunkaozheng.html");exit;
				}
				//echo "���ı����Ѿ����ͨ����";
				// include("zhunkaozheng.html");exit;
			}
			if($res['status'] == 0 || $res['status'] == 2)
			{
				echo "<script language=\"JavaScript\">\r\n";echo "alert(\"���������ϻ�û����˻���˲�ͨ�������ܴ�ӡ׼��֤��\");\r\n";echo " history.back();\r\n"; echo "</script>";	
			}
			
		}else{///---
			echo "<script language=\"JavaScript\">\r\n";echo "alert(\"��д��Ϣ��������û������ڣ�\");\r\n";echo " history.back();\r\n"; echo "</script>";	
		}
		//print_r($res);exit;
	}else
	{
		echo "<script language=\"JavaScript\">\r\n";echo "alert(\"����д������Ϣ��\");\r\n";echo " history.back();\r\n";   echo "</script>";
	}
	
}

if($act == 'chengji')
{
	$name=trim($_POST['name']);
	$phone1=trim($_POST['phone1']);
	$identity_id=trim($_POST['identity_id']);
	if($name && $phone1 && $identity_id)
	{
		$sql="select * from qs_baoming where name='{$name}' and phone1 = '{$phone1}' and identity_id = '{$identity_id}'";
		//echo $sql;exit;
		$res=$db->getone($sql);
		//print_r($res);exit;
		if($res)///-----����
		{
			
			if($res['status'] == 1){
				if($res['km1'] == '' || $res['km2'] == ''){
					echo "<script language=\"JavaScript\">\r\n";echo "alert(\"���ĳɼ���û�г��������Ժ����ԣ�\");\r\n";echo " history.back();\r\n"; echo "</script>";	
				}else{
					//echo "<script language=\"JavaScript\">\r\n";echo "alert(\"�ɼ���ѯ��ʱ��δ���ţ�\");\r\n";echo " history.back();\r\n"; echo "</script>";					
					include("chegnji.html");exit;
				}
				//echo "���ı����Ѿ����ͨ����";
				// include("zhunkaozheng.html");exit;
			}
			if($res['status'] == 0 || $res['status'] == 2)
			{
				echo "<script language=\"JavaScript\">\r\n";echo "alert(\"���������ϻ�û����˻���˲�ͨ����û�гɼ���Ϣ��\");\r\n";echo " history.back();\r\n"; echo "</script>";	
			}
			
		}else{///---
			echo "<script language=\"JavaScript\">\r\n";echo "alert(\"��д��Ϣ��������û������ڣ�\");\r\n";echo " history.back();\r\n"; echo "</script>";	
		}
		//print_r($res);exit;
	}else
	{
		echo "<script language=\"JavaScript\">\r\n";echo "alert(\"����д������Ϣ�ٲ�ѯ��\");\r\n";echo " history.back();\r\n";   echo "</script>";
	}
}
?>
