<?php

define('IN_QISHI', true);
require_once(dirname(__FILE__).'/../data/config.php');
require_once(dirname(__FILE__).'/include/admin_common.inc.php');
require_once(dirname(__FILE__).'/include/page.class.php');
$act = !empty($_GET['act']) ? trim($_GET['act']) : 'kgq';

$pnum=10;		//ÿҳ��ʾ����

if($act == 'kgq'){
	//����ڵ�ְλ��Ϣ
	$dqid=intval($_CFG['subsite_id']);		//��ȡ����id
	//------------------------------------------------------
	if(!empty($_GET['id'])){
		$id=$_GET['id'];
		$t=strtotime(date("Y-m-d H:i:s",strtotime($id. "day")));		//ʱ��
	}
	//------------------------------------------------------
	if($dqid==0){
		//��ʾȫվ�����û���Ϣ
		$sql='select count(*) as num from qs_company_profile join qs_jobs on qs_jobs.uid=qs_company_profile.uid where qs_jobs.uid in(select uid from qs_jobs where deadline >= "'.time().'" and deadline <= "'.$t.'") and deadline >= "'.time().'" and deadline <= "'.$t.'"';
		$count=$db->getone($sql);
		$url="gqqe.php?act=kgq&id=".$id."&";				//��ҳ��ַ
		$page=new Page($count['num'], $pnum , $url);
		$sql='select qs_jobs.id,qs_jobs.subsite_id,qs_jobs.uid,jobs_name,qs_jobs.companyname,qs_jobs.addtime,qs_jobs.deadline,contact,telephone,email from qs_company_profile join
				qs_jobs on qs_jobs.uid=qs_company_profile.uid where qs_jobs.uid in(
					select uid from qs_jobs where deadline >= "'.time().'" and deadline <= "'.$t.'"
					) and deadline >= "'.time().'" and deadline <= "'.$t.'"
					ORDER BY deadline desc limit '.$page->limit;
		
		$data=$db->getall($sql);
		$smarty->assign("fpage", $page->fpage());
	//------------------------------------------------------	
	}else{
		//�ڸ�������ʾ��ͬ��������Ϣ
		$sql='select count(*) as num from qs_company_profile join qs_jobs on qs_jobs.uid=qs_company_profile.uid where qs_jobs.uid in(select uid from qs_jobs where deadline >= "'.time().'" and deadline <= "'.$t.'") and deadline >= "'.time().'" and deadline <= "'.$t.'" and subsite_id='.$dqid;
		$count=$db->getone($sql);
		$url="gqqe.php?act=kgq&id=".$id."&";				//��ҳ��ַ
		$page=new Page($count['num'], $pnum , $url);
		//��ʾȫվ�����û���Ϣ
		$sql='select qs_jobs.id,qs_jobs.subsite_id,qs_jobs.uid,jobs_name,qs_jobs.companyname,qs_jobs.addtime,qs_jobs.deadline,contact,telephone,email from qs_company_profile join
				qs_jobs on qs_jobs.uid=qs_company_profile.uid where qs_jobs.uid in(
					select uid from qs_jobs where deadline >= "'.time().'" and deadline <= "'.$t.'"
					) and deadline >= "'.time().'" and deadline <= "'.$t.'" and subsite_id='.$dqid.'
					ORDER BY deadline desc limit '.$page->limit;
		
		$data=$db->getall($sql);
		$smarty->assign("fpage", $page->fpage());
	}
	//------------------------------------------------------
	$sql="select s_id,s_districtname from qs_subsite";
	$site=$db->getall($sql);
	foreach ($data as $i=>$v){
		$data[$i]['dq']="ȫվ";
		foreach ($site as $k=>$s){
			if($s['s_id']==$data[$i]['subsite_id']){
				$data[$i]['dq']=$s['s_districtname'];
			}
		}
		$data[$i]['ts']=round(($data[$i]['deadline']-time())/3600/24);
	}
	
	$smarty->assign("dtime","��������");
//-------------------------------------------------------------------------

}elseif($act == 'ygq'){
	//�Թ��ڵ�ְλ��Ϣ
	$dqid=intval($_CFG['subsite_id']);		//��ȡ����id
	//------------------------------------------------------
	if(!empty($_GET['id'])){
		$id=$_GET['id'];
		$s=strtotime(date("Y-m-d H:i:s",strtotime("-".$id. "day")));
	}
	//------------------------------------------------------
	if($dqid==0){
		$sql='select count(*) as num from qs_company_profile join qs_jobs on qs_jobs.uid=qs_company_profile.uid where qs_jobs.uid in(select uid from qs_jobs where deadline >= "'.$s.'" and deadline <= "'.time().'") and deadline >= "'.$s.'" and deadline <= "'.time().'"';	
		$count=$db->getone($sql);
		$url="gqqe.php?act=ygq&id=".$id."&";				//��ҳ��ַ
		$page=new Page($count['num'], $pnum , $url);
		$sql='select qs_jobs.id,qs_jobs.subsite_id,qs_jobs.uid,jobs_name,qs_jobs.companyname,qs_jobs.addtime,qs_jobs.deadline,contact,telephone,email from qs_company_profile join
				qs_jobs on qs_jobs.uid=qs_company_profile.uid where qs_jobs.uid in(
					select uid from qs_jobs where deadline >= "'.$s.'" and deadline <= "'.time().'"
				) and deadline >= "'.$s.'" and deadline <= "'.time().'" 
				ORDER BY deadline desc limit '.$page->limit;
		$data=$db->getall($sql);
		$smarty->assign("fpage", $page->fpage());
	//------------------------------------------------------	
	}else{
		$sql='select count(*) as num from qs_company_profile join qs_jobs on qs_jobs.uid=qs_company_profile.uid where qs_jobs.uid in(select uid from qs_jobs where deadline >= "'.$s.'" and deadline <= "'.time().'") and deadline >= "'.$s.'" and deadline <= "'.time().'" and subsite_id='.$dqid;
		$count=$db->getone($sql);
		$url="gqqe.php?act=ygq&id=".$id."&";				//��ҳ��ַ
		$page=new Page($count['num'], $pnum , $url);
		$sql='select qs_jobs.id,qs_jobs.subsite_id,qs_jobs.uid,jobs_name,qs_jobs.companyname,qs_jobs.addtime,qs_jobs.deadline,contact,telephone,email from qs_company_profile join
				qs_jobs on qs_jobs.uid=qs_company_profile.uid where qs_jobs.uid in(
					select uid from qs_jobs where deadline >= "'.$s.'" and deadline <= "'.time().'"
				) and deadline >= "'.$s.'" and deadline <= "'.time().'" and subsite_id='.$dqid.'
				ORDER BY deadline desc limit '.$page->limit;
		$data=$db->getall($sql);
		$smarty->assign("fpage", $page->fpage());
	}
	//------------------------------------------------------
	$sql="select s_id,s_districtname from qs_subsite";
	$site=$db->getall($sql);
	foreach ($data as $i=>$v){
		$data[$i]['dq']="ȫվ";
		foreach ($site as $k=>$s){
			if($s['s_id']==$data[$i]['subsite_id']){
				$data[$i]['dq']=$s['s_districtname'];
			}
		}
		$data[$i]['ts']=round((time()-$data[$i]['deadline'])/3600/24);
	}
	//------------------------------------------------------
	$smarty->assign("gtime","��������");
}
	//------------------------------------------------------------
	$smarty->assign("data",$data);
	//------------------------------------------------------------
	/*--------------------------------------------*/
	$dqid=intval($_CFG['subsite_id']);
	if($dqid==0){
		//s1
		$t=strtotime(date("Y-m-d H:i:s",strtotime("1 day")));
		$sql='select count(*) as count from qs_company_profile join qs_jobs on qs_jobs.uid=qs_company_profile.uid where qs_jobs.uid in(select uid from qs_jobs where deadline >= "'.time().'" and deadline <= "'.$t.'") and deadline >= "'.time().'" and deadline <= "'.$t.'"';
		$aa=$db->getall($sql);
		$smarty->assign('s1',$aa[0]['count']);
		//s3
		$t=strtotime(date("Y-m-d H:i:s",strtotime("3 day")));
		$sql='select count(*) as count from qs_company_profile join qs_jobs on qs_jobs.uid=qs_company_profile.uid where qs_jobs.uid in(select uid from qs_jobs where deadline >= "'.time().'" and deadline <= "'.$t.'") and deadline >= "'.time().'" and deadline <= "'.$t.'"';
		$aa=$db->getall($sql);
		$smarty->assign('s3',$aa[0]['count']);
		//s7
		$t=strtotime(date("Y-m-d H:i:s",strtotime("7 day")));
		$sql='select count(*) as count from qs_company_profile join qs_jobs on qs_jobs.uid=qs_company_profile.uid where qs_jobs.uid in(select uid from qs_jobs where deadline >= "'.time().'" and deadline <= "'.$t.'") and deadline >= "'.time().'" and deadline <= "'.$t.'"';
		$aa=$db->getall($sql);
		$smarty->assign('s7',$aa[0]['count']);
	}else{
		//s1
		$t=strtotime(date("Y-m-d H:i:s",strtotime("1 day")));
		$sql='select count(*) as count from qs_company_profile join qs_jobs on qs_jobs.uid=qs_company_profile.uid where qs_jobs.uid in(select uid from qs_jobs where deadline >= "'.time().'" and deadline <= "'.$t.'") and deadline >= "'.time().'" and deadline <= "'.$t.'" and subsite_id='.$dqid;
		$aa=$db->getall($sql);
		$smarty->assign('s1',$aa[0]['count']);
		//s3
		$t=strtotime(date("Y-m-d H:i:s",strtotime("3 day")));
		$sql='select count(*) as count from qs_company_profile join qs_jobs on qs_jobs.uid=qs_company_profile.uid where qs_jobs.uid in(select uid from qs_jobs where deadline >= "'.time().'" and deadline <= "'.$t.'") and deadline >= "'.time().'" and deadline <= "'.$t.'" and subsite_id='.$dqid;
		$aa=$db->getall($sql);
		$smarty->assign('s3',$aa[0]['count']);
		//s7
		$t=strtotime(date("Y-m-d H:i:s",strtotime("7 day")));
		$sql='select count(*) as count from qs_company_profile join qs_jobs on qs_jobs.uid=qs_company_profile.uid where qs_jobs.uid in(select uid from qs_jobs where deadline >= "'.time().'" and deadline <= "'.$t.'") and deadline >= "'.time().'" and deadline <= "'.$t.'" and subsite_id='.$dqid;
		$aa=$db->getall($sql);
		$smarty->assign('s7',$aa[0]['count']);
	}
	//------------------------------------------------------------------//
	if($dqid==0){
		//g1
		$s=strtotime(date("Y-m-d H:i:s",strtotime("-1 day")));
		$sql='select count(*) as count from qs_company_profile join qs_jobs on qs_jobs.uid=qs_company_profile.uid where qs_jobs.uid in(select uid from qs_jobs where deadline >= "'.$s.'" and deadline <= "'.time().'") and deadline >= "'.$s.'" and deadline <= "'.time().'"';	
		$aa=$db->getall($sql);
		$smarty->assign('g1',$aa[0]['count']);
		//g3
		$s=strtotime(date("Y-m-d H:i:s",strtotime("-3 day")));
		$sql='select count(*) as count from qs_company_profile join qs_jobs on qs_jobs.uid=qs_company_profile.uid where qs_jobs.uid in(select uid from qs_jobs where deadline >= "'.$s.'" and deadline <= "'.time().'") and deadline >= "'.$s.'" and deadline <= "'.time().'"';	
		$aa=$db->getall($sql);
		$smarty->assign('g3',$aa[0]['count']);
		//g7
		$s=strtotime(date("Y-m-d H:i:s",strtotime("-7 day")));
		$sql='select count(*) as count from qs_company_profile join qs_jobs on qs_jobs.uid=qs_company_profile.uid where qs_jobs.uid in(select uid from qs_jobs where deadline >= "'.$s.'" and deadline <= "'.time().'") and deadline >= "'.$s.'" and deadline <= "'.time().'"';	
		$aa=$db->getall($sql);
		$smarty->assign('g7',$aa[0]['count']);
	}else{
		//g1
		$s=strtotime(date("Y-m-d H:i:s",strtotime("-1 day")));
		$sql='select count(*) as count from qs_company_profile join qs_jobs on qs_jobs.uid=qs_company_profile.uid where qs_jobs.uid in(select uid from qs_jobs where deadline >= "'.$s.'" and deadline <= "'.time().'") and deadline >= "'.$s.'" and deadline <= "'.time().'" and subsite_id='.$dqid;
		$aa=$db->getall($sql);
		$smarty->assign('g1',$aa[0]['count']);
		//g3
		$s=strtotime(date("Y-m-d H:i:s",strtotime("-3 day")));
		$sql='select count(*) as count from qs_company_profile join qs_jobs on qs_jobs.uid=qs_company_profile.uid where qs_jobs.uid in(select uid from qs_jobs where deadline >= "'.$s.'" and deadline <= "'.time().'") and deadline >= "'.$s.'" and deadline <= "'.time().'" and subsite_id='.$dqid;
		$aa=$db->getall($sql);
		$smarty->assign('g3',$aa[0]['count']);
		//g7
		$s=strtotime(date("Y-m-d H:i:s",strtotime("-7 day")));
		$sql='select count(*) as count from qs_company_profile join qs_jobs on qs_jobs.uid=qs_company_profile.uid where qs_jobs.uid in(select uid from qs_jobs where deadline >= "'.$s.'" and deadline <= "'.time().'") and deadline >= "'.$s.'" and deadline <= "'.time().'" and subsite_id='.$dqid;
		$aa=$db->getall($sql);
		$smarty->assign('g7',$aa[0]['count']);
	}
	/*--------------------------------------------*/
	//------------------------------------------------------------
	$smarty->display('vip/gqqe.htm');
?>