<?php
/*
 * 74cms ��ҵ��Ա����
 * ============================================================================
 * ��Ȩ����: ��ʿ���磬����������Ȩ����
 * ��վ��ַ: http://www.74cms.com��
 * ----------------------------------------------------------------------------
 * �ⲻ��һ�������������ֻ���ڲ�������ҵĿ�ĵ�ǰ���¶Գ����������޸ĺ�
 * ʹ�ã�������Գ���������κ���ʽ�κ�Ŀ�ĵ��ٷ�����
 * ============================================================================
*/
define('IN_QISHI', true);
require_once(dirname(__FILE__).'/company_common.php');
$smarty->assign('leftmenu',"index");
if ($act=='index')
{
	$uid=intval($_SESSION['uid']);
	$smarty->assign('title','��ҵ��Ա���� - '.$_CFG['site_name']);

	require_once(QISHI_ROOT_PATH.'include/fun_user.php');
	$smarty->assign('loginlog',get_loginlog_one($uid,'1001'));
	
	$smarty->assign('user',$user);
	$smarty->assign('points',get_user_points($uid));
	$smarty->assign('concern_id',get_concern_id($uid));
	$smarty->assign('company',$company_profile);
	if ($_CFG['operation_mode']=='2' || $_CFG['operation_mode']=='3')
	{
		$setmeal=get_user_setmeal($uid);
		$smarty->assign('setmeal',$setmeal);
		if ($setmeal['endtime']>0)
		{
					$setmeal_endtime=sub_day($setmeal['endtime'],time());
					if (empty($setmeal_endtime))
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
	//------ffffffffff------�鿴������������-----
	$sql_ck="select ck_num,ck_end_time from ".table('company_profile')." where uid='{$uid}'";
	$data_ck=$db->getone($sql_ck);
	//echo "<pre>";print_r($data_ck);exit;
	if($data_ck['ck_num'] >0 && $data_ck['ck_end_time'] >= time())
	{
		$smarty->assign('data_ck',$data_ck);
	}
	//------ffffffffff----�鿴���������ѽ���------------
	/*��ӵĴ���*/
	/*-------------------*/
	$sql="select jifen from vip_jf where uid='{$uid}'";
	$data=$db->getone($sql);
	$smarty->assign('jf',$data);
	/*-------------------*/
	$sql="select * from vip_zt where qid='{$uid}'";
	// echo $sql;exit;
	$data=$db->getall($sql);
	if(!empty($data)){			//�ж��ǲ����ײ��û�
		$smarty->assign('data',$data[0]);		//���ײ��û����ݲ����������
	}else{
		// echo 'ok';
		$smarty->assign('data',"1");			//�����ײ��û�����1��ģ�����������1����ʾ�ײ�ģ�棬������ʾ�ײ�ģ��
	}
	//�ж��ײ��Ƿ����
	if(time()<=$data[0]['end_time']){
		$smarty->assign('gq',"1");	
	}else{
		$smarty->assign('gq',"0");
	}
	//----fffffffffff----------
	//�жϴ����ײͻ�Ա�Ƿ����
	if(time()<=$data[0]['cs_end_time']){
		$smarty->assign('gq_cs',"1");	
	}else{
		$smarty->assign('gq_cs',"0");
	}
	///---------ffffff��������--��ʼ
	if($data[0]['bout_6'] > 0){
		$smarty->assign('bout6',$data[0]['bout_6']);
	
	}else{
		$smarty->assign('bout6',"0");
	}
	///---------ffffff��������--����
	//----ffffffffff-----------
	/*��ӵĴ���*/		
	//$smarty->assign('msg_total1',$db->get_total("SELECT COUNT(*) AS num FROM ".table('pms')." WHERE (msgfromuid='{$uid}' OR msgtouid='{$uid}') AND `new`='2' AND `replyuid`<>'{$uid}'"));
	//$smarty->assign('msg_total2',$db->get_total("SELECT COUNT(*) AS num FROM ".table('pms')." WHERE (msgfromuid='{$uid}' OR msgtouid='{$uid}') AND `new`='1' AND `replyuid`<>'{$uid}'"));
	//---fff
	$smarty->assign('msg_total1',$db->get_total("SELECT COUNT(*) AS num FROM ".table('pms')." WHERE (msgfromuid='{$uid}' OR msgtouid='{$uid}')  AND `replyuid`<>'{$uid}' AND msgtype=1"));
	$smarty->assign('msg_total2',$db->get_total("SELECT COUNT(*) AS num FROM ".table('pms')." WHERE (msgfromuid='{$uid}' OR msgtouid='{$uid}')  AND `replyuid`<>'{$uid}' AND msgtype=2"));	
	//--fff
	$smarty->assign('total_noaudit_jobs',$db->get_total("SELECT COUNT(*) AS num FROM ".table('jobs_tmp')." WHERE uid=".$uid." AND audit=2"));
	$smarty->assign('total_audit_jobs',$db->get_total("SELECT COUNT(*) AS num FROM ".table('jobs')." WHERE uid=".$uid));
	$smarty->assign('total_nolook_resume',$db->get_total("SELECT COUNT(*) AS num FROM ".table('personal_jobs_apply')." WHERE company_uid=".$uid." AND personal_look=1"));
	$smarty->assign('total_down_resume',$db->get_total("SELECT COUNT(*) AS num FROM ".table('company_down_resume')." WHERE company_uid=".$uid));
	$smarty->assign('total_view_resume',$db->get_total("SELECT COUNT(*) AS num FROM ".table('view_resume')." WHERE uid=".$uid));
	$smarty->assign('total_favorites_resume',$db->get_total("SELECT COUNT(*) AS num FROM ".table('company_favorites')." WHERE company_uid=".$uid));
	$smarty->display('member_company/company_index.htm');
}
unset($smarty);
?>