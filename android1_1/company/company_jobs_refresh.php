<?php 
define('IN_QISHI', true);
require_once(dirname(__FILE__).'/../include/common.inc.php');
require_once(QISHI_ROOT_PATH.'include/mysql.class.php');
$db = new mysql($dbhost,$dbuser,$dbpass,$dbname);
unset($dbhost,$dbuser,$dbpass,$dbname);
$aset=$_REQ;
require_once(ANDROID_ROOT_PATH.'include/common.user.inc.php');
if ($_SESSION['utype']<>'1')
{
	$result['result']=0;
	$result['errormsg']=android_iconv_utf8("���¼��ҵ��Ա���ģ�");
	$jsonencode = json_encode($result);
	$jsonencode = urldecode(json_encode($result));
	exit($jsonencode);
}
else
{
	$yid =intval($aset['id']);
	if (empty($yid))
	{
	$result['result']=0;
	$result['errormsg']=android_iconv_utf8("ְλid����");
	$jsonencode = json_encode($result);
	$jsonencode = urldecode(json_encode($result));
	exit($jsonencode);
	}
		$points_rule=get_cache('points_rule');
		if($points_rule['jobs_refresh']['value']>0)
		{
			$user_points=get_user_points($_SESSION['uid']);
			if ($points_rule['jobs_refresh']['value']>$user_points && $points_rule['jobs_refresh']['type']=="2")
			{
			$result['result']=0;
			$result['errormsg']=android_iconv_utf8("���".$_CFG['points_byname']."���㣬���ȳ�ֵ��");
			$jsonencode = json_encode($result);
			$jsonencode = urldecode(json_encode($result));
			exit($jsonencode);
			}
		report_deal($_SESSION['uid'],$points_rule['jobs_refresh']['type'],$points_rule['jobs_refresh']['value']);
		$user_points=get_user_points($_SESSION['uid']);
		$operator=$points_rule['jobs_refresh']['type']=="1"?"+":"-";
		write_memberslog($_SESSION['uid'],1,9001,$_SESSION['username'],"ͨ���ֻ��ͻ���ˢ��ְλ({$operator}{$points_rule['jobs_refresh']['value']})��(ʣ��:{$user_points})");
		}
		refresh_jobs($yid,$_SESSION['uid']);
		write_memberslog($_SESSION['uid'],1,2004,$_SESSION['username'],"ͨ���ֻ��ͻ���ˢ��ְλ");
			$result['result']=1;
			$result['errormsg']='';
			if($points_rule['jobs_refresh']['value']>0)
			{
			$result['txt']=android_iconv_utf8("ˢ�³ɹ���{$_CFG['points_byname']}{$operator}{$points_rule['jobs_refresh']['value']}");
			}
			else
			{
			$result['txt']=android_iconv_utf8("ˢ�³ɹ���");
			}
			$jsonencode = json_encode($result);
			$jsonencode = urldecode(json_encode($result));
			exit($jsonencode);
}
?>