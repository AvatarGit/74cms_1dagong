<?php
 /*
 * 74cms ajax �������
 * ============================================================================
 * ��Ȩ����: ��ʿ���磬����������Ȩ����
 * ��վ��ַ: http://www.74cms.com��
 * ----------------------------------------------------------------------------
 * �ⲻ��һ�������������ֻ���ڲ�������ҵĿ�ĵ�ǰ���¶Գ����������޸ĺ�
 * ʹ�ã�������Գ���������κ���ʽ�κ�Ŀ�ĵ��ٷ�����
 * ============================================================================
*/
define('IN_QISHI', true);
require_once(dirname(dirname(__FILE__)).'/include/plus.common.inc.php');
$act = !empty($_GET['act']) ? trim($_GET['act']) : '';
if($act == 'view_jobs')
{
	if ($_SESSION['uid'] && $_SESSION['username'] && $_SESSION['utype']=='2')
	{
		$jobsid=intval($_GET['jobsid']);
		$uid=$_SESSION['uid'];
		//$time=intval($_GET['t']);
		$time=time();
		if ($jobsid>0)
		{
			$res=$db->getone("select * from ".table('view_jobs')." WHERE jobsid='{$jobsid}'  LIMIT 1");
			if($res)
			{
				$db->query("update ".table('view_jobs')." set jobsid=".$jobsid.",uid=".$uid.",addtime=".$time." WHERE jobsid='{$jobsid}'  LIMIT 1");	
			}else{
				$db->query("insert into ".table('view_jobs')." set jobsid=".$jobsid.",uid=".$uid.",addtime=".$time);
			}
			//exit($val['click']);
		}
	}
	
}
elseif($act == 'view_resume')
{
	if ($_SESSION['uid'] && $_SESSION['username'] && $_SESSION['utype']=='1')
	{
		$resumeid=intval($_GET['resumeid']);
		$uid=$_SESSION['uid'];
		//$time=intval($_GET['t']);
		$time=time();
		if ($resumeid>0)
		{
			$res=$db->getone("select * from ".table('view_resume')." WHERE resumeid='{$resumeid}'  LIMIT 1");
			if($res)
			{
				$db->query("update ".table('view_resume')." set resumeid=".$resumeid.",uid=".$uid.",addtime=".$time." WHERE resumeid='{$resumeid}'  LIMIT 1");	
			}else{
				$db->query("insert into ".table('view_resume')." set resumeid=".$resumeid.",uid=".$uid.",addtime=".$time);
			}
			//exit($val['click']);
		}
	}
}

?>