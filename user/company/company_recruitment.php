<?php
/*
 * 74cms ��ҵ��Ա����
 * ============================================================================
 * ��Ȩ����: ��ʿ���磬����������Ȩ����
 * ��վ��ַ: http://www.74cms.com��
 * ----------------------------------------------------------------------------
 * �ⲻ��һ��������������ֻ���ڲ�������ҵĿ�ĵ�ǰ���¶Գ����������޸ĺ�
 * ʹ�ã��������Գ���������κ���ʽ�κ�Ŀ�ĵ��ٷ�����
 * ============================================================================
*/
define('IN_QISHI', true);
require_once(dirname(__FILE__).'/company_common.php');
$smarty->assign('leftmenu',"recruitment");
if ($act=='apply_jobs')
{
	require_once(QISHI_ROOT_PATH.'include/page.class.php');
	$joinsql=" LEFT JOIN  ".table('resume')." AS r  ON  a.resume_id=r.id ";
	$wheresql=" WHERE a.company_uid='{$_SESSION['uid']}' ";
	$look=intval($_GET['look']);
	if($look>0)$wheresql.=" AND a.personal_look='{$look}'";
	$jobsid=intval($_GET['jobsid']);
	if($jobsid>0)$wheresql.=" AND a.jobs_id='{$jobsid}' ";
	$perpage=10;
	$total_sql="SELECT COUNT(*) AS num FROM ".table('personal_jobs_apply')." AS a  {$wheresql} ";
	$page = new page(array('total'=>$db->get_total($total_sql), 'perpage'=>$perpage));
	$offset=($page->nowindex-1)*$perpage;
	$smarty->assign('act',$act);
	$smarty->assign('title','�յ���ְλ���� - ��ҵ��Ա���� - '.$_CFG['site_name']);
	$smarty->assign('jobs_apply',get_apply_jobs($offset,$perpage,$joinsql.$wheresql));
	$smarty->assign('page',$page->show(3));
	$smarty->assign('count',count_jobs_apply($_SESSION['uid']));
	$smarty->assign('count1',count_jobs_apply($_SESSION['uid'],1));
	$smarty->assign('count2',count_jobs_apply($_SESSION['uid'],2));
	$smarty->assign('jobs',get_auditjobs($_SESSION['uid']));	
	$smarty->display('member_company/company_apply_jobs.htm');
}
elseif ($act=='set_apply_jobs')
{
	$yid =!empty($_REQUEST['y_id'])?$_REQUEST['y_id']:showmsg("��û��ѡ���κ���Ŀ��",1);
	set_apply($yid,$_SESSION['uid'],2)?showmsg("���óɹ���",2):showmsg("����ʧ�ܣ�",0);
}
elseif ($act=='apply_jobs_del')
{
	$yid =!empty($_REQUEST['y_id'])?$_REQUEST['y_id']:showmsg("��û��ѡ����Ŀ��",1);
	if ($n=del_apply_jobs($yid,$_SESSION['uid']))
	{
	showmsg("ɾ���ɹ�����ɾ�� {$n} ��",2);
	}
	else
	{
	showmsg("ʧ�ܣ�",0);
	}
}
elseif ($act=='down_resume_list')
{
	require_once(QISHI_ROOT_PATH.'include/page.class.php');
	$perpage=10;
	$joinsql=" LEFT JOIN  ".table('resume')." as r ON d.resume_id=r.id ";
	$wheresql=" WHERE  d.company_uid='{$_SESSION['uid']}' ";
	$settr=intval($_GET['settr']);
	$talent=intval($_GET['talent']);
	if($settr>0)
	{
	$settr_val=strtotime("-{$settr} day");
	$wheresql.=" AND d.down_addtime>{$settr_val} ";
	}
	if($talent){
		$wheresql.=" AND r.talent=1 ";
	}
	$total_sql="SELECT COUNT(*) AS num FROM ".table('company_down_resume')." as d".$wheresql;
	$total_val=$db->get_total($total_sql);
	$page = new page(array('total'=>$total_val, 'perpage'=>$perpage));
	$currenpage=$page->nowindex;
	$offset=($currenpage-1)*$perpage;
	$smarty->assign('title','�����صļ��� - ��ҵ��Ա���� - '.$_CFG['site_name']);
	$smarty->assign('act',$act);
	$smarty->assign('list',get_down_resume($offset,$perpage,$joinsql.$wheresql));
	$smarty->assign('page',$page->show(3));
	$smarty->display('member_company/company_down_resume.htm');
}
elseif ($act=='down_resume_del')
{
	$yid =!empty($_REQUEST['y_id'])?$_REQUEST['y_id']:showmsg("��û��ѡ�������",1);
	if ($n=del_down_resume($yid,$_SESSION['uid']))
	{
	showmsg("ɾ���ɹ�����ɾ�� {$n} ��",2);
	}
	else
	{
	showmsg("ʧ�ܣ�",0);
	}
}
elseif ($act=='perform')
{
	$id =!empty($_REQUEST['y_id'])?$_REQUEST['y_id']:showmsg("��û��ѡ�������",1);
	if(!empty($_REQUEST['shift'])){
		$num=down_to_favorites($id,$_SESSION['uid']);
		if ($num==='full')
		{
		showmsg("�˲ſ�����!",1);
		}
		elseif($num>0)
		{
		showmsg("���ӳɹ��������� {$num} ��",2);
		}
		else
		{
		showmsg("����ʧ��,�Ѿ����ڣ�",1);
		}
	}elseif(!empty($_REQUEST['attention_shift'])){
		$num=attention_to_favorites($id,$_SESSION['uid']);
		if ($num==='full')
		{
		showmsg("�˲ſ�����!",1);
		}
		elseif($num>0)
		{
		showmsg("���ӳɹ��������� {$num} ��",2);
		}
		else
		{
		showmsg("����ʧ��,�Ѿ����ڣ�",1);
		}
	}
	
}
elseif ($act=='favorites_list')
{
	require_once(QISHI_ROOT_PATH.'include/page.class.php');
	$perpage=10;
	$joinsql=" LEFT JOIN  ".table('resume')." AS r ON  f.resume_id=r.id ";
	$wheresql= " WHERE f.company_uid='{$_SESSION['uid']}' ";
	$settr=intval($_GET['settr']);
	if($settr>0)
	{
	$settr_val=strtotime("-".$settr." day");
	$wheresql.=" AND f.favoritesa_ddtime>".$settr_val;
	}
	$total_sql="SELECT COUNT(*) AS num FROM ".table('company_favorites')." AS f ".$wheresql;
	$total_val=$db->get_total($total_sql);
	$page = new page(array('total'=>$total_val, 'perpage'=>$perpage));
	$offset=($page->nowindex-1)*$perpage;
	$smarty->assign('title','��ҵ�˲ſ� - ��ҵ��Ա���� - '.$_CFG['site_name']);
	$smarty->assign('act',$act);
	$smarty->assign('favorites',get_favorites($offset, $perpage,$joinsql.$wheresql));
	$smarty->assign('page',$page->show(3));
	$smarty->display('member_company/company_favorites.htm');
}
elseif ($act=='favorites_del')
{
	$yid =!empty($_REQUEST['y_id'])?$_REQUEST['y_id']:showmsg("��û��ѡ�������",1);
	if ($n=del_favorites($yid,$_SESSION['uid']))
	{
	showmsg("ɾ���ɹ�����ɾ�� {$n} ��",2);
	}
	else
	{
	showmsg("ʧ�ܣ�",0);
	}
}
//�����������б�
elseif ($act=='interview_list')
{
	require_once(QISHI_ROOT_PATH.'include/page.class.php');
	$perpage=10;
	$joinsql=" LEFT JOIN ".table('resume')." as r ON i.resume_id=r.id ";
	$wheresql=" WHERE i.company_uid='{$_SESSION['uid']}' ";
	$jobsid=intval($_GET['jobsid']);
	if($jobsid>0)$wheresql.=" AND i.jobs_id='{$jobsid}' ";
	$look=intval($_GET['look']);
	if($look>0)$wheresql.=" AND  i.personal_look='{$look}' ";
	$total_sql="SELECT COUNT(*) AS num FROM ".table('company_interview')." as i ".$wheresql;
	$total_val=$db->get_total($total_sql);
	$page = new page(array('total'=>$total_val, 'perpage'=>$perpage));
	$currenpage=$page->nowindex;
	$offset=($currenpage-1)*$perpage;
	$smarty->assign('act',$act);
	$smarty->assign('title','�ҷ������������ - ��ҵ��Ա���� - '.$_CFG['site_name']);
	$smarty->assign('resume',get_interview($offset, $perpage,$joinsql.$wheresql));
	$smarty->assign('jobs',get_auditjobs($_SESSION['uid']));
	$smarty->assign('page',$page->show(3));
	$smarty->display('member_company/company_interview.htm');
}
//ɾ������������Ϣ
elseif ($act=='interview_del')
{
	$yid =!empty($_REQUEST['y_id'])?$_REQUEST['y_id']:showmsg("��û��ѡ����Ŀ��",1);
	$delete =$_POST['delete'];
	$delete?(!del_interview($yid,$_SESSION['uid'])?showmsg("ɾ��ʧ�ܣ�",0):showmsg("ɾ���ɹ���",2)):'';
}
//--ff
//�����������б�
elseif ($act=='apply_ck_list')
{
	require_once(QISHI_ROOT_PATH.'include/page.class.php');
	$perpage=10;
	$joinsql=" LEFT JOIN ".table('resume')." as r ON i.resume_id=r.id ";
	$wheresql=" WHERE i.company_uid='{$_SESSION['uid']}' ";
	$jobsid=intval($_GET['jobsid']);
	if($jobsid>0)$wheresql.=" AND i.jobs_id='{$jobsid}' ";
	$look=intval($_GET['look']);
	if($look>0)$wheresql.=" AND  i.personal_look='{$look}' ";
	$total_sql="SELECT COUNT(*) AS num FROM ".table('company_apply_ck')." as i ".$wheresql;
	$total_val=$db->get_total($total_sql);
	$page = new page(array('total'=>$total_val, 'perpage'=>$perpage));
	$currenpage=$page->nowindex;
	$offset=($currenpage-1)*$perpage;
	$smarty->assign('act',$act);
	$smarty->assign('title','���������ϵ��ʽ - ��ҵ��Ա���� - '.$_CFG['site_name']);
	$smarty->assign('resume',get_apply_ck($offset, $perpage,$joinsql.$wheresql));
	$smarty->assign('jobs',get_auditjobs($_SESSION['uid']));
	$smarty->assign('page',$page->show(3));
	//echo "<pre>";print_r(get_apply_ck($offset, $perpage,$joinsql.$wheresql));exit;
	$smarty->display('member_company/company_apply_ck.htm');
}
//ɾ��������ϵ��Ϣ
elseif ($act=='apply_ck_del')
{
	$yid =!empty($_REQUEST['y_id'])?$_REQUEST['y_id']:showmsg("��û��ѡ����Ŀ��",1);
	$delete =$_POST['delete'];
	$delete?(!del_apply_ck($yid,$_SESSION['uid'])?showmsg("ɾ��ʧ�ܣ�",0):showmsg("ɾ���ɹ���",2)):'';
}
//--ff
elseif ($act=='my_attention')
{
	require_once(QISHI_ROOT_PATH.'include/page.class.php');
	$joinsql=" LEFT JOIN  ".table('resume')." AS r  ON  a.resumeid=r.id ";
	$wheresql=" WHERE a.uid='{$_SESSION['uid']}' ";
	$perpage=10;
	$total_sql="SELECT COUNT(*) AS num FROM ".table('view_resume')." AS a  {$wheresql} ";
	$page = new page(array('total'=>$db->get_total($total_sql), 'perpage'=>$perpage));
	$offset=($page->nowindex-1)*$perpage;
	$smarty->assign('title','�����¼ - ��ҵ��Ա���� - '.$_CFG['site_name']);
	$smarty->assign('resume_list',get_my_attention($offset,$perpage,$joinsql.$wheresql));
	$smarty->assign('page',$page->show(3));	
	$smarty->display('member_company/company_my_attention.htm');
}
elseif($act == 'del_my_attention'){
	$yid =!empty($_REQUEST['y_id'])?$_REQUEST['y_id']:showmsg("��û��ѡ����Ŀ��",1);
	$delete =$_REQUEST['del'];
	$delete?(!del_my_attention($yid,$_SESSION['uid'])?showmsg("ɾ��ʧ�ܣ�",0):showmsg("ɾ���ɹ���",2)):'';
}
unset($smarty);
?>