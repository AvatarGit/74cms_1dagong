<?php
/*
 * 74cms ��ͷ��Ա����
 * ============================================================================
 * ��Ȩ����: ��ʿ���磬����������Ȩ����
 * ��վ��ַ: http://www.74cms.com��
 * ----------------------------------------------------------------------------
 * �ⲻ��һ��������������ֻ���ڲ�������ҵĿ�ĵ�ǰ���¶Գ����������޸ĺ�
 * ʹ�ã��������Գ���������κ���ʽ�κ�Ŀ�ĵ��ٷ�����
 * ============================================================================
*/
define('IN_QISHI', true);
require_once(dirname(__FILE__).'/shenhe_common.php');
$smarty->assign('leftmenu',"index");

if ($act=='index')
{
	$uid=intval($_SESSION['uid']);
	$smarty->assign('title','���Ա���� - '.$_CFG['site_name']);
	require_once(QISHI_ROOT_PATH.'include/fun_user.php');
	$smarty->assign('loginlog',get_loginlog_one($uid,'1001'));
	$smarty->assign('user',$user);
	$smarty->assign('points',get_user_points($uid));
	$smarty->assign('concern_id',get_concern_id($uid));
	$smarty->assign('shenhe',$shenhe_profile);//--$hunter_profile
	if ($_CFG['operation_shenhe_mode']=='2')
	{
		$setmeal=get_user_setmeal($uid);
		$smarty->assign('setmeal',$setmeal);
		if ($setmeal['endtime']>0)
		{
					$setmeal_endtime=sub_day($setmeal['endtime'],time());
					if (empty($setmeal_endtime))
					{
						$setmeal_endtime_days="�ѵ���,������������";
					}
					 else
					 {
						 $setmeal_endtime_days="����".$setmeal_endtime."����";
					 }
					$smarty->assign('setmeal_endtime_days',$setmeal_endtime_days);
					if (time()>$setmeal['endtime'])
					{
						$smarty->assign('meal_min_remind',"�Ѿ�����");
					}
					else
					{
						$smarty->assign('meal_min_remind',$setmeal_endtime);
						
					}
		}else{
			$smarty->assign('meal_min_remind',"������");
		}
	}
	$smarty->assign('msg_total1',$db->get_total("SELECT COUNT(*) AS num FROM ".table('pms')." WHERE (msgfromuid='{$uid}' OR msgtouid='{$uid}') AND `new`='1' AND `replyuid`<>'{$uid}' AND msgtype=1"));
	$smarty->assign('msg_total2',$db->get_total("SELECT COUNT(*) AS num FROM ".table('pms')." WHERE (msgfromuid='{$uid}' OR msgtouid='{$uid}') AND `new`='1' AND `replyuid`<>'{$uid}' AND msgtype=2"));
	$smarty->assign('total_audit_jobs',$db->get_total("SELECT COUNT(*) AS num FROM ".table('shenhe_jobs')." WHERE uid=".$uid." AND audit=1"));
	$smarty->assign('total_down_resume',$db->get_total("SELECT COUNT(*) AS num FROM ".table('user_down_talent_resume')." WHERE user_uid=".$uid));
	$smarty->display('member_shenhe/shenhe_index.htm');
}
unset($smarty);
?>