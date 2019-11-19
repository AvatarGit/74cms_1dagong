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
	$result['result']=1;
	$result['errormsg']='';
	$count_resume[0]=$db->get_total("SELECT COUNT(*) AS num FROM ".table('resume')." WHERE uid='{$_SESSION['uid']}'");
	$count_resume[1]=$db->get_total("SELECT COUNT(*) AS num FROM ".table('resume_tmp')." WHERE uid='{$_SESSION['uid']}'");
	$count_resume=$count_resume[0]+$count_resume[1];
	$count_resume="��{$count_resume}��";
	$count_down_resume=$db->get_total("SELECT COUNT(*) AS num FROM ".table('company_down_resume')." as d WHERE d.resume_uid='{$_SESSION['uid']}' ");
	$count_down_resume="��{$count_down_resume}��";
	$count_interview=$db->get_total("SELECT COUNT(*) AS num FROM ".table('company_interview')." AS i WHERE  i.resume_uid='{$_SESSION['uid']}' ");
	$count_interview="��{$count_interview}��";
	$count_jobs_apply=$db->get_total("SELECT COUNT(*) AS num FROM ".table('personal_jobs_apply')." AS a  WHERE a.personal_uid='{$_SESSION['uid']}'");
	$count_jobs_apply="��{$count_jobs_apply}��";
	$count_favorites=$db->get_total("SELECT COUNT(*) AS num FROM ".table('personal_favorites')." AS f WHERE f.personal_uid='{$_SESSION['uid']}' ");
	$count_favorites="��{$count_favorites}��";
	$list=array('username'=>$_SESSION['username'],'count_resume'=>$count_resume,'count_down_resume'=>$count_down_resume,'count_interview'=>$count_interview,'count_jobs_apply'=>$count_jobs_apply,'count_favorites'=>$count_favorites);
	$list=array_map('export_mystrip_tags',$list);
	$result['list']=android_iconv_utf8_array($list);
	$jsonencode = urldecode(json_encode($result));
	exit($jsonencode);	
}
?>