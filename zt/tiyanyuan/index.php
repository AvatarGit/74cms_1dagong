<?php
 /*
 * 74cms ��Աע��
 * ============================================================================
 * ��Ȩ����: ��ʿ���磬����������Ȩ����
 * ��վ��ַ: http://www.74cms.com��
 * ----------------------------------------------------------------------------
 * �ⲻ��һ�������������ֻ���ڲ�������ҵĿ�ĵ�ǰ���¶Գ����������޸ĺ�
 * ʹ�ã�������Գ���������κ���ʽ�κ�Ŀ�ĵ��ٷ�����
 * ============================================================================
*/
define('IN_QISHI', true);
$alias="QS_login";
require_once(dirname(__FILE__).'/../../include/common.inc.php');
require_once(QISHI_ROOT_PATH.'include/mysql.class.php');
require_once(QISHI_ROOT_PATH.'include/fun_zt.php');
//require_once(dirname(__FILE__) . '/zt_common.php');
$db = new mysql($dbhost,$dbuser,$dbpass,$dbname);
unset($dbhost,$dbuser,$dbpass,$dbname);
$smarty->cache = false;
$act = !empty($_REQUEST['act']) ? trim($_REQUEST['act']) : 'tiyanyuan';
if ($act=='tiyanyuan')
{
	//echo "����Աģ��";exit;
	$sql_company='';
	///------fffff
	$sql="select * from zt_tiyan_type order by id desc";
	$tiyan_type=get_tiyan_type($sql);
	//echo "<pre>";print_r($tiyan_type);exit;
	$smarty->assign('tiyan_type',$tiyan_type);
	$smarty->assign('tiyan_type1',$tiyan_type);
	//echo $sql;exit;
	$smarty->display('zt/tiyanyuan.htm');
}
elseif($act == 'shangchuan')
{
	//echo "�������ϴ��ļ�";exit;
	$uptypes1=array(
	'application/msword',
	'application/vnd.ms-powerpoint',
	'application/vnd.ms-excel',
	'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
	'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
	'application/vnd.openxmlformats-officedocument.presentationml.presentation'
	);
	
	$max_file_size=20000000;   //�ϴ��ļ���С����, ��λBYTE
	$path_parts=pathinfo($_SERVER['PHP_SELF']); //ȡ�õ�ǰ·��
	$time=time();
	$destination_folder=date("Y",$time).'/'; //�ϴ��ļ�·��
	$destination_folder .=date("m",$time).'/'; //�ϴ��ļ�·��
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		if (!is_uploaded_file($_FILES["upfile"][tmp_name][0]))
		//�Ƿ�����ļ�
		{
		echo "<script language=\"JavaScript\">\r\n";   echo " alert(\"��Ƶ�ļ�û���ϴ�\");\r\n";   echo " history.back();\r\n";   echo "</script>";
							exit;  
		}
		$file = $_FILES["upfile"];
		if($max_file_size < $file["size"][0])
		 //����ļ���С
		{
			echo "<script language=\"JavaScript\">\r\n";   echo " alert(\"��Ƶ�ļ�̫��\");\r\n";   echo " history.back();\r\n";   echo "</script>";
			exit;  
		}
		if(!in_array($file["type"][0], $uptypes1))  
		//����ļ�����  
		{  
			echo "<script language=\"JavaScript\">\r\n";   echo " alert(\"��Ƶ�ļ����Ͳ�����\");\r\n";   echo " history.back();\r\n";   echo "</script>";
						exit;  
		}
		if(!file_exists($destination_folder))
		if(!mkdir($destination_folder,0777,true)){
			echo "<font color='red'>������Ŀ¼ʧ��,���ֶ�������</a>";
		}
		$filename1=$file["tmp_name"][0];
		$pinfo1=pathinfo($file["name"][0]);
		$ftype1=$pinfo1[extension];
		$firstname='���鱨��';
		$destination1 = $destination_folder.$firstname."doc".date('Y-m-d',time()).".".$ftype1;
		if (file_exists($destination1) && $overwrite != true)
		{
			 echo "<font color='red'>��ͬ�ļ��Ѿ������ˣ�</a>";
			 exit;
		}
		if(!move_uploaded_file ($filename1, $destination1))
		{
			echo "<font color='red'>�ƶ��ļ�����</a>";
			exit;
		}
		echo "<script language=\"JavaScript\">\r\n";   echo " alert(\"�ϴ��ɹ����Ժ�����ǻ���ϵ����\");\r\n";   echo " history.back();\r\n";   echo "</script>";
		
	}
	//$smarty->assign('contents',$val['contents']);
}
elseif($act == 'chakan')
{
	$id=intval($_GET['id']);
	$sql = "select * from zt_qx where id = ".$id." LIMIT 1";
	$val=$db->getone($sql);
	$smarty->assign('time',date('Y-m-d',$val['addtime']));
	$smarty->assign('to',$val['to']);
	$smarty->assign('from',$val['from']);
	$smarty->assign('bg',$val['bg']);
	$smarty->assign('contents',$val['contents']);
	$smarty->display('zt/qixi.htm');
}
unset($smarty);
?>