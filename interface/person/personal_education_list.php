<?php 
define('IN_QISHI', true);
require_once(dirname(__FILE__).'/../include/common.inc.php');
//require_once(ANDROID_ROOT_PATH.'include/fun_user.php');
require_once(QISHI_ROOT_PATH.'include/mysql.class.php');
//��ȡ���������б�
function get_resume_education($uid,$pid,$limit)
{
	global $db;
	if (intval($uid)!=$uid) return false;
	$sql = "SELECT * FROM ".table('resume_education')." WHERE  pid='".intval($pid)."' AND uid='".intval($uid)."' ".$limit;
	return $db->getall($sql);
}
$db = new mysql($dbhost,$dbuser,$dbpass,$dbname);
	unset($dbhost,$dbuser,$dbpass,$dbname);
	$aset=$_REQ;
	$userid=isset($aset['userid'])?trim($aset['userid']):"";
	$userid=addslashes($userid);
	$userid=iconv("utf-8",QISHI_DBCHARSET,$userid);
	//echo $aset['userid'];exit;
	//$resume_id =intval($aset['resumeId']);
	$resume_id=isset($aset['resume_id'])?trim($aset['resume_id']):"";
	$resume_id=addslashes($resume_id);
	$resume_id=iconv("utf-8",QISHI_DBCHARSET,$resume_id);
	
	$page=isset($aset['page'])?trim($aset['page']):"";
	$page=addslashes($page);
	$page=iconv("utf-8",QISHI_DBCHARSET,$page);
	//echo $aset['page'];exit;
	$pagesize=isset($aset['pagesize'])?trim($aset['pagesize']):"";
	$pagesize=addslashes($pagesize);
	$pagesize=iconv("utf-8",QISHI_DBCHARSET,$pagesize);
	//echo $aset['pagesize'];exit;
	
	if (empty($userid))
	{
	$result['code']=0;
	$result['errormsg']=android_iconv_utf8('û���ҵ����û�');
	$jsonencode = urldecode(json_encode($result));
	exit($jsonencode);
	}
	if (empty($resume_id))
	{
	$result['code']=0;
	$result['errormsg']=android_iconv_utf8('û���ҵ����û��ļ�����Ϣ');
	$jsonencode = urldecode(json_encode($result));
	exit($jsonencode);
	}
	$wheresql=" WHERE  uid='{$userid}' ";
	
	//----��ȡ����
	$total_sql="SELECT COUNT(*) AS num from ".table('resume_education')." {$wheresql} ";
	$total_val=$db->get_total($total_sql);
	//----��ȡ���������
	//----fff---��ҳ
	//$page ��ǰҳ��
	//$total_val ������
	//$pagesize ÿҳ��ʾ����
	if(!$page) $page = 1;
	if(!$pagesize) $pagesize = 10;
	$maxpage = ceil($total_val / $pagesize);
	/*if($maxpage>0)
	{
		if($page > $maxpage) $page = $maxpage;
	}*/
	$offset = ($page - 1) * $pagesize;

	//echo $wheresql;exit;
	$limit=' limit '.$offset.','.$pagesize;
	$list=get_resume_education($userid,$resume_id,$limit);
	//echo "<pre>";print_r($list);exit;
	if (empty($list))
	{
	$list=array();
	}
	$androidresult['code']=1;
	$androidresult['errormsg']='';
	$list=array_map('export_mystrip_tags',$list);
	$androidresult['data']=android_iconv_utf8_array($list);
	$jsonencode = json_encode($androidresult);
	echo urldecode($jsonencode);

?>