<?php 
define('IN_QISHI', true);
require_once(dirname(__FILE__).'/../include/common.inc.php');
require_once(QISHI_ROOT_PATH.'include/mysql.class.php');
$db = new mysql($dbhost,$dbuser,$dbpass,$dbname);
unset($dbhost,$dbuser,$dbpass,$dbname);
$aset=$_REQ;
require_once(ANDROID_ROOT_PATH.'include/common.user.inc.php');
if ($_SESSION['utype']<>'2')
{
	$result['result']=0;
	$result['errormsg']=android_iconv_utf8("���¼���˻�Ա���ģ�");
	$jsonencode = json_encode($result);
	$jsonencode = urldecode(json_encode($result));
	exit($jsonencode);
}
else
{
	$offset=intval($aset['start']);
	$aset['row']=intval($aset['row']);
	if ($aset['row']==0)
	{
	$aset['row']=5;
	}
	$wheresql=" WHERE a.personal_uid='{$_SESSION['uid']}' ";
	$joinsql=" LEFT JOIN ".table('jobs')." AS j ON a.jobs_id=j.id ";
	$list=get_per_apply_jobs($offset,$aset['row'],$joinsql.$wheresql);
	if (empty($list))
	{
	$list=array();
	}
	$androidresult['result']=1;
	$androidresult['errormsg']='';
	$list=array_map('export_mystrip_tags',$list);
	$androidresult['list']=android_iconv_utf8_array($list);
	$jsonencode = json_encode($androidresult);
	echo urldecode($jsonencode);
}
?>