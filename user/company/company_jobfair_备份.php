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
$smarty->assign('leftmenu',"jobfair");
if ($act=='jobfair')
{
	require_once(QISHI_ROOT_PATH.'include/page.class.php');
	$wheresql=" WHERE display=1 ";
	if(intval($_CFG['subsite_id'])==0){
		$wheresql.="and holddates > ".strtotime(date('Y-m-d',strtotime('-1 days'))) ." and subsite_id=0 OR subsite_id=1 and holddates > ".strtotime(date('Y-m-d',strtotime('-1 days')))." ORDER BY holddates asc";	//��� ORDER BY ��ʱ������
	}else{
		$wheresql.="and holddates > ".strtotime(date('Y-m-d',strtotime('-1 days')))." and subsite_id=0 or subsite_id=".intval($_CFG['subsite_id'])." and holddates > ".strtotime(date('Y-m-d',strtotime('-1 days')))."  ORDER BY holddates asc";	//��� ORDER BY ��ʱ������
	}
	$total_sql="SELECT COUNT(*) AS num FROM ".table('jobfair').$wheresql;
	$perpage=5;
	$total_val=$db->get_total($total_sql);
	$page = new page(array('total'=>$total_val, 'perpage'=>$perpage));
	$currenpage=$page->nowindex;
	$offset=($currenpage-1)*$perpage;
	$smarty->assign('title','��Ƹ�� - ��Ա���� - '.$_CFG['site_name']);
	$jobfair=get_jobfair($offset,$perpage,$wheresql);
	foreach ($jobfair as $i => $v) {
	//----------------------------------------------------------
		/*��Ԥ��*/
		$yyd="select count(*) as yiyuding from vip_zhanhui where zid='".$v['id']."'";
		$yyd=$db->getone($yyd);		//��Ԥ������չλ
		$jobfair[$i]['yiyuding']=$yyd['yiyuding'];
		/*δԤ��*/
		$wyd="select count(*) as weiyuding from vip_zw where number not in(select number from vip_zhanhui where zid=".$v['id'].") and subsite_id='".intval($_CFG['subsite_id'])."'";
		$wyd=$db->getone($wyd);		//û��Ԥ����չλ
		$jobfair[$i]['weiyuding']=$wyd['weiyuding'];
	//----------------------------------------------------------
	}	
	$smarty->assign('jobfair',$jobfair);
	if ($total_val>$perpage)$smarty->assign('page',$page->show(3));
	$smarty->display('member_company/company_jobfair_list.htm');
}
elseif ($act=='booth')
{	
	if(!empty($_POST['id'])){$id=intval($_POST['id']);}		//�״�Ԥ��ʹ��post
	if(!empty($_GET['id'])){$id=intval($_GET['id']);}		//�ٴ�Ԥ��ʹ��get
	
	if(empty($id)){	exit("ERR"); }		//������id ֱ����ֹ�������´���
		$time=time();
		$sql = "select * from ".table('jobfair')." where id='{$id}' limit 1";
		$jobfair=$db->getone($sql);		// 	$jobfair['holddates']>$time
		if ($jobfair['predetermined_status']=="1" && date("Y-m-d",$jobfair['holddates'])>=date("Y-m-d",$time) && $time>$jobfair['predetermined_start'] && ($jobfair['predetermined_end']=="0" || $jobfair['predetermined_end']>$time || $jobfair['hour']>=date("H")) && $jobfair['predetermined_web']=="1"){
			/*�ж����ײ��û������ǻ����û�-----------------------------------------------*/
			$sql="select * from vip_user join vip_zt on vip_user.qid = vip_zt.qid where vip_user.qid='".$_SESSION['uid']."'";
			$zt=$db->getall($sql);
			/*�ײʹ����û�-----------------------չλ��Ϣ-----------------------------------------*/
			if(!empty($zt)){
					/*������������û�*/
					if($zt[0]['huiyuan']==2){
						$day=date("Y-m-d",$jobfair['holddates']);
						$zhou=date('w',strtotime($day));
						echo $zhou;
						if($zhou==6){
							$link[0]['text'] = "��Ա������ҳ";
							$link[0]['href'] = 'company_index.php';
							showmsg("����,������������Ա�û�,������Ԥ����������չ�ᣡ",2,$link);
						}
					}
					/*�鿴�û��Ƿ񼤻*/
					$sql="select * from vip_zt where qid='".$_SESSION['uid']."' and activation='0'";
					$data=$db->getone($sql);
					if(!empty($data)){
						$link[0]['text'] = "��Ա������ҳ";
						$link[0]['href'] = 'company_index.php';
						showmsg("����,����ײͻ�û�м���,����ϵ�ͷ���",2,$link);
					}
					/*����ʱ���ײ��û�*/
					$sql="select * from vip_zt where qid='".$_SESSION['uid']."' and type='1' and activation='1'";
					$data=$db->getone($sql);
					if(!empty($data)){
						$link[0]['text'] = "��Ԥ����չλ";
						$link[0]['href'] = '?act=mybooth';
						showmsg("����,����ʱ���ײ��û�����Ҫ�Լ�Ԥ��չλ.ϵͳ�������Ԥ��",3,$link);
					}
					/*�����û��Ƿ�Ԥ����չλ*/
					if(empty($_GET['id'])){
						$sql="select * from vip_zhanhui where zid='".$jobfair['id']."' and qid={$_SESSION['uid']} limit 1";
						$data=$db->getall($sql);
						if(!empty($data)){
							$link[0]['text'] = "��Ԥ����չλ";
							$link[0]['href'] = '?act=mybooth';
							$link[1]['text'] = "��ҪԤ��";
							$link[1]['href'] = '?act=booth&id='.$id;
							showmsg("���Ѿ�Ԥ����������Ƹ���չλ�ˣ�����ҪԤ����?",3,$link,true,10);
						}
					}
				//------------------------------------------------------------------------------
				$smarty->assign("zid",$jobfair['id']);
				$smarty->assign("qid",$_SESSION['uid']);
				/*----------------------------չλ��Ϣ-----------------------------------------*/
				$smarty->assign("type","1");					//�ײ��û�
				
			/*�����û�------------------------չλ��Ϣ-----------------------------------------*/	
			}else{
					/*���˻����Ƿ��㣬��ʾ�û���ֵ*/
					$user_points=get_user_points($_SESSION['uid']);
					if ($jobfair['predetermined_point']>$user_points)
					{
						$link[0]['text'] = "������ֵ";
						$link[0]['href'] = 'company_service.php?act=order_add';
						$link[1]['text'] = "������һҳ";
						$link[1]['href'] = 'javascript:history.go(-1)';
						$link[2]['text'] = "��Ա������ҳ";
						$link[2]['href'] = 'company_index.php?act=';
						showmsg("���".$_CFG['points_byname']."���㣬���ֵ����Ԥ��! ",0,$link);
					}
				//-------------------------
				$smarty->assign("zid",$jobfair['id']);
				$smarty->assign("qid",$_SESSION['uid']);
				/*----------------------------չλ��Ϣ-----------------------------------------*/
				$smarty->assign("type","2");									//�����û�
				$smarty->assign("zhjf",$jobfair['predetermined_point']);		//չ��Ļ���
			}
			
			/*��Ԥ����չλ��*/
			$sql="select * from vip_zhanhui where zid='".$jobfair['id']."'";
			$ok=$db->getall($sql);			//��Ԥ������չλ
			$smarty->assign("ok",$ok);		//չλ��Ԥ�����ݵ�ģ��
			$smarty->assign("jobfair",$jobfair);		//չ����Ϣ���ݵ�ģ��
			/*-��������ʾ��ͬģ��----------------------------------------------------------------------------------------*/
			switch (intval($_CFG['subsite_id'])){
			case 1:
				//echo "�Ϸ�";
				/*δԤ��*/
				$sql="select number from vip_zw where subsite_id=".intval($_CFG['subsite_id'])." and number not in(select number from vip_zhanhui where zid=".$jobfair['id'].")";
				$all=$db->getall($sql);		//û��Ԥ����չλ
				$smarty->assign("all",$all);
				$smarty->display('member_company/company_jobfair_yuding.htm');		//����ģ��
				break;
			case 2:
				//echo "����";
				/*δԤ��*/
				$sql="select number from vip_zw where subsite_id=".intval($_CFG['subsite_id'])." and number not in(select number from vip_zhanhui where zid=".$jobfair['id'].")";
				$all=$db->getall($sql);		//û��Ԥ����չλ
				$smarty->assign("all",$all);
				$smarty->display('member_company/company_jobfair_yuding.htm');		//����ģ��
				break;
			case 3:
				//echo "�ߺ�";
				/*δԤ��*/
				$sql="select number from vip_zw where subsite_id=".intval($_CFG['subsite_id'])." and number not in(select number from vip_zhanhui where zid=".$jobfair['id'].")";
				$all=$db->getall($sql);		//û��Ԥ����չλ
				$smarty->assign("all",$all);
				$smarty->display('member_company/company_jobfair_yuding.htm');		//����ģ��
				break;
			case 4:
				//echo "����";
				/*δԤ��*/
				$sql="select number from vip_zw where subsite_id=".intval($_CFG['subsite_id'])." and number not in(select number from vip_zhanhui where zid=".$jobfair['id'].")";
				$all=$db->getall($sql);		//û��Ԥ����չλ
				$smarty->assign("all",$all);
				$smarty->display('member_company/company_jobfair_yuding.htm');		//����ģ��
				break;
			default:
				//ȫվ
				/*δԤ��*/
				$sql="select number from vip_zw where subsite_id=".intval($_CFG['subsite_id'])." and number not in(select number from vip_zhanhui where zid=".$jobfair['id'].")";
				$all=$db->getall($sql);		//û��Ԥ����չλ
				$smarty->assign("all",$all);
				$smarty->display('member_company/company_jobfair_yuding.htm');		//����ģ��
			}
		}else{
			$link[0]['text'] = "��Ա������ҳ";
			$link[0]['href'] = 'company_index.php';
			showmsg("������Ԥ���ˣ�",3,$link);
		}	
}
elseif ($act=='mybooth')
{
	require_once(QISHI_ROOT_PATH.'include/page.class.php');			//������ҳ��
	/*-------------*/
	$smarty->assign('title','��Ԥ����չλ - ��Ƹ�� - ��Ա���� - '.$_CFG['site_name']);
	if(empty($_GET['settr'])){
		$sql="select zid from vip_zhanhui where qid='".$_SESSION['uid']."'";
		$jobfair=$db->getall($sql);
		$zid = array();							//����$zid����
		for($i=0; $i<sizeof($jobfair); $i++){
			$zid[$i]=$jobfair[$i]['zid'];		//��ȡչ��id,���浽$zid������
		}
		array_multisort($zid, SORT_NUMERIC, SORT_ASC);  
		$num = array();		//����$num����
		foreach ($zid as $i=>$v){
			$sql="select id,title,holddates from qs_jobfair where id in(".$v.") and holddates > ".strtotime(date('Y-m-d',strtotime('-1 days')));
			$fair=$db->getone($sql);
			if(!empty($fair)){
				$num[$i]['id']=$fair['id'];
				$num[$i]['title']=$fair['title'];
				$num[$i]['holddates']=$fair['holddates'];		//����Ҫ�����ݱ��浽$num����
			}
		}
		$data=$db->getall("select * from vip_zhanhui where qid='".$_SESSION['uid']."' ORDER BY zid ASC");
		foreach ($data as $k=>$s){
			if($num[$k]['id']==$s['zid']){
				$num[$k]['numid']=$s['id'];
				$num[$k]['number']=$s['number'];
				$num[$k]['online_aoto']=$s['online_aoto'];
				$num[$k]['add_time']=$s['add_time'];
			}	
		}
		
	}elseif($_GET['settr']=="s"){
	/*���мӹ��ڵ��ѽ�Ԥ����չλ---------------------------------------------------*/
		$sql="select zid from vip_zhanhui where qid='".$_SESSION['uid']."'";
		$jobfair=$db->getall($sql);
		$zid = array();							//����$zid����
		for($i=0; $i<sizeof($jobfair); $i++){
			$zid[$i]=$jobfair[$i]['zid'];		//��ȡչ��id,���浽$zid������
		}
		array_multisort($zid, SORT_NUMERIC, SORT_ASC);  
		$num = array();		//����$num����
		foreach ($zid as $i=>$v){
			$sql="select id,title,holddates from qs_jobfair where id in(".$v.")";
			$fair=$db->getone($sql);
			if(!empty($fair)){
				$num[$i]['id']=$fair['id'];
				$num[$i]['title']=$fair['title'];
				$num[$i]['holddates']=$fair['holddates'];		//����Ҫ�����ݱ��浽$num����
			}
		}
		$data=$db->getall("select * from vip_zhanhui where qid='".$_SESSION['uid']."' ORDER BY zid ASC");
		foreach ($data as $k=>$s){
			if($num[$k]['id']==$s['zid']){
				$num[$k]['numid']=$s['id'];
				$num[$k]['number']=$s['number'];
				$num[$k]['online_aoto']=$s['online_aoto'];
				$num[$k]['add_time']=$s['add_time'];
			}	
		}
	}else{
		/*-------------------------------------------------------------------*/
		$sql="select zid from vip_zhanhui where qid='".$_SESSION['uid']."'";
		$jobfair=$db->getall($sql);
		$zid = array();							//����$zid����
		for($i=0; $i<sizeof($jobfair); $i++){
			$zid[$i]=$jobfair[$i]['zid'];		//��ȡչ��id,���浽$zid������
		}
		array_multisort($zid, SORT_NUMERIC, SORT_ASC);  
		$num = array();		//����$num����
		foreach ($zid as $i=>$v){
			//����3�����ʾ
			$sql="select id,title,holddates from qs_jobfair where id in(".$v.") and holddates < ".strtotime(date('Y-m-d',strtotime($_GET['settr']. 'days')))." and holddates > ".strtotime(date('Y-m-d',strtotime('-1 days')));
			$fair=$db->getone($sql);
			if(!empty($fair)){
				$num[$i]['id']=$fair['id'];
				$num[$i]['title']=$fair['title'];
				$num[$i]['holddates']=$fair['holddates'];		//����Ҫ�����ݱ��浽$num����
			}
		}
		$data=$db->getall("select * from vip_zhanhui where qid='".$_SESSION['uid']."' ORDER BY zid ASC");
		foreach ($data as $k=>$s){
			if($num[$k]['id']==$s['zid']){
				$num[$k]['numid']=$s['id'];
				$num[$k]['number']=$s['number'];
				$num[$k]['online_aoto']=$s['online_aoto'];
				$num[$k]['add_time']=$s['add_time'];
			}	
		}

	}
	//��ҳ--------------------------------------------------------------------------
		$perpage=15;		//ÿҳ��
		$total_val=count($num);		//��Ԥ������
		$page = new page(array('total'=>$total_val, 'perpage'=>$perpage));		//���÷�ҳ��
		$currenpage=$page->nowindex;
		$offset=($currenpage-1)*$perpage;
		$num=array_slice($num,$offset,$perpage);		//�����ҳ����
		//����----------------------------------------------------------------------
		//print_r($num);
		//����----------------------------------------------------------------------
		$smarty->assign('page',$page->show(3));
		$smarty->assign('list',$num);
		/*-------------------------------------------------------------------*/
	/*-----------------------------------------------------------------------------*/
	$smarty->display('member_company/company_jobfair_exhibitors.htm');
}
/*-----------------------------------------------------------------------------------------------------------------------------------------------------------------*/
elseif ($act=='yvding'){	
	//�ײ��û�---
	if($_POST['yhtype']==1){
		$sql="select * from vip_zt where qid='".$_POST['qid']."' and type='0' and activation='1'";
		$data=$db->getall($sql);		//�������ҵ�Ĵ�����Ա��Ϣ�����
		if(!empty($data)){
			$sql="select * from vip_zt where qid='".$_POST['qid']."' and type='0' and activation='1'";
			$data=$db->getone($sql);
			/*-----�жϴ����ײ��Ƿ�����Ч---------------*/
			if($data['cs_ks_time']>=time()){
				$link[0]['text'] = "��Ա������ҳ";
				$link[0]['href'] = 'company_index.php';
				showmsg("�����Ĵ����ײͻ�û��Ч! ��ȴ��ײ���Ч��",3,$link);
			}
			/*-----�жϴ����ײ��Ƿ����-------------------*/
			if($data['cs_end_time']<=time()){
				$link[0]['text'] = "��Ա������ҳ";
				$link[0]['href'] = 'company_index.php';
				showmsg("��! �������ˣ� ����ϵ�ͷ���",3,$link);
			}
			/*------------------------------------------*/
			if($data['bout']>0){
				$sql="select * from vip_zhanhui where zid='".$_POST['zid']."' and qid='".$_POST['qid']."'";
				$data=$db->getone($sql);
				//if(empty($data)){
					$sql="UPDATE vip_zt SET bout=bout-1 WHERE qid='".$_POST['qid']."'";
					$id=$db->getone($sql);
					$sql="select * from vip_user where qid='".$_POST['qid']."'";
					$data=$db->getall($sql);	//��ѯ��ҵ��Ϣ
					$sql="INSERT INTO vip_zhanhui(subsite_id,zid,qid,username,title,xs_user,huiyuan,phone,email,number,yhtype,online_aoto,add_time) values('".intval($_CFG['subsite_id'])."','".$_POST['zid']."','".$_POST['qid']."','".$data[0]['username']."','".$data[0]['title']."','".$data[0]['xs_user']."','".$data[0]['huiyuan']."','".$data[0]['phone']."','".$data[0]['email']."','".$_POST['number']."','1','2',".time().")";
					$id=$db->query($sql);		//���浽����չ����
					
					if(!empty($id)){
						/*-------------------------------------------------------*/
						$sql="select * from vip_jf where uid='".$_SESSION['uid']."'";
						$data=$db->getone($sql);
						if(!empty($data)){
							$sqljf="UPDATE vip_jf set jifen=jifen+10 where uid='".$_SESSION['uid']."'";
						}else{
							$sqljf="INSERT INTO vip_jf(uid,jifen) values ('".$_SESSION['uid']."','10')";
						}
						$id=$db->query($sqljf);
						/*--------------------------------------------------------*/
					
						$link[0]['text'] = "��Ԥ����չλ";
						$link[0]['href'] = '?act=mybooth';
						$link[1]['text'] = "��Ա������ҳ";
						$link[1]['href'] = 'company_index.php?act=';
						showmsg("Ԥ���ɹ�!",2,$link);
					}
				/*}else{
					$link[0]['text'] = "��Ԥ����չλ";
					$link[0]['href'] = '?act=mybooth';
					showmsg("���Ѿ�Ԥ��������Ƹ���չλ�ˣ������ظ�Ԥ��",1,$link);
				}*/
			}else{
				$link[0]['text'] = "��Ա������ҳ";
				$link[0]['href'] = 'company_index.php';
				showmsg("��Ĳμ�չ������Ѿ�������! ����ϵ�ͷ�",3,$link);
			}
		}else{
			$link[0]['text'] = "��Ա������ҳ";
			$link[0]['href'] = 'company_index.php';
			showmsg("�������ײͻ�û����! ����ϵ�ͷ�",3,$link);
		}
	}
	//�����û�---
	if($_POST['yhtype']==2){
		$sql="select * from vip_zhanhui where zid='".$_POST['zid']."' and qid='".$_POST['qid']."'";
		$data=$db->getone($sql);
		if(empty($data)){
			$sql='select * from qs_company_profile join qs_members on qs_company_profile.uid = qs_members.uid where qs_members.uid = "'.$_POST['qid'].'"';
			$data=$db->getall($sql);	//��ѯ��ҵ��Ϣ
			$sql="INSERT INTO vip_zhanhui(subsite_id,zid,qid,username,title,xs_user,huiyuan,phone,email,number,yhtype,online_aoto,add_time) values('".intval($_CFG['subsite_id'])."','".$_POST['zid']."','".$_POST['qid']."','".$data[0]['username']."','".$data[0]['companyname']."','".$data[0]['xs_user']."','".null."','".$data[0]['telephone']."','".$data[0]['email']."','".$_POST['number']."','2','2',".time().")";
			$id=$db->query($sql);
			
			if(!empty($id)){
				$sql="UPDATE qs_members_points SET points=points-".$_POST['zhjf']." WHERE uid='".$_POST['qid']."'";
				$id=$db->getall($sql);
				/*-------------------------------------------------------*/
				$sql="select * from vip_jf where uid='".$_SESSION['uid']."'";
				$data=$db->getone($sql);
				if(!empty($data)){
					$sqljf="UPDATE vip_jf set jifen=jifen+10 where uid='".$_SESSION['uid']."'";
				}else{
					$sqljf="INSERT INTO vip_jf(uid,jifen) values ('".$_SESSION['uid']."','10')";
				}
				$id=$db->query($sqljf);
				/*--------------------------------------------------------*/
				$link[0]['text'] = "��Ԥ����չλ";
				$link[0]['href'] = '?act=mybooth';
				$link[1]['text'] = "��Ա������ҳ";
				$link[1]['href'] = 'company_index.php?act=';
				showmsg("Ԥ���ɹ�!",2,$link);
			}
		}else{
			$link[0]['text'] = "��Ԥ����չλ";
			$link[0]['href'] = '?act=mybooth';
			$link[1]['text'] = "������һҳ";
			$link[1]['href'] = 'javascript:history.go(-1)';
			showmsg("���Ѿ�Ԥ��������Ƹ���չλ�ˣ������ظ�Ԥ��",1,$link);
		}
	}
/*------------------------------------------------------------------------------------------------------*/	
}
elseif ($act=='tuiding'){
	if(!empty($_GET['id'])){
		$id=$_GET['id'];
		$sql="select predetermined_point,predetermined_end from qs_jobfair where id=".$_GET['zid'];
		$data=$db->getone($sql);
		if(!empty($data)){
			
			if($data['predetermined_end'] > time()){
				$sql="DELETE  FROM  vip_zhanhui WHERE  id='".$id."' and qid='".$_SESSION['uid']."'";
				$res=mysql_query($sql);
				if(mysql_affected_rows()){
					$sql="select * from vip_zt where type='0' and qid='".$_SESSION['uid']."'";
					$dat=$db->getone($sql);
					//�Ǵ�����Ա
					if(!empty($dat)){
						$sql="UPDATE vip_zt SET bout = bout+1 WHERE qid='".$_SESSION['uid']."'";
						$res=mysql_query($sql);
						if(mysql_affected_rows()){
							$link[0]['text'] = "��Ԥ����չλ";
							$link[0]['href'] = '?act=mybooth';
							$link[1]['text'] = "��Ա������ҳ";
							$link[1]['href'] = 'company_index.php?act=';
							showmsg("�˶��ɹ�!",2,$link);
						}
					}else{
					//�ǻ��ֻ�Ա
						$sql="UPDATE qs_members_points SET points = points+".$data['predetermined_point']." WHERE uid='".$_SESSION['uid']."'";
						$res=mysql_query($sql);
						if(mysql_affected_rows()){
							$link[0]['text'] = "��Ԥ����չλ";
							$link[0]['href'] = '?act=mybooth';
							$link[1]['text'] = "��Ա������ҳ";
							$link[1]['href'] = 'company_index.php?act=';
							showmsg("�˶��ɹ�!",2,$link);
						}
					}
				}else{
					$link[0]['text'] = "��Ԥ����չλ";
					$link[0]['href'] = '?act=mybooth';
					$link[1]['text'] = "��Ա������ҳ";
					$link[1]['href'] = 'company_index.php?act=';
					showmsg("�˶�ʧ��!",2,$link);
				}
				echo "�����˶�";
			}else{
				//echo "�������˶���";
				$link[0]['text'] = "��Ԥ����չλ";
				$link[0]['href'] = '?act=mybooth';
				$link[1]['text'] = "��Ա������ҳ";
				$link[1]['href'] = 'company_index.php?act=';
				showmsg("�Ѿ��������˶���!",2,$link);
			}
		}
	}
}
/*����չλ--------------------------------------*/
elseif ($act=='gaizw'){
	if(!empty($_GET['zid'])){
		$id=$_GET['zid'];
		/*��Ԥ��*/
		$sql="select * from vip_zhanhui where zid='".$id."'";
		$ok=$db->getall($sql);		//��Ԥ������չλ
		$smarty->assign("ok",$ok);
		/*δԤ��*/
		$sql="select number from vip_zw where number not in(select number from vip_zhanhui where zid=".$id.")";
		$all=$db->getall($sql);		//û��Ԥ����չλ
		$smarty->assign("all",$all);
		/*-----------------------------------------------*/
		$smarty->assign("zid",$id);
		$smarty->assign("qid",$_SESSION['uid']);
		$smarty->assign("zwh",$_GET['zwh']);
		$smarty->assign("id",$_GET['id']);
	}
	$smarty->display('member_company/ydzw.htm');
}
elseif ($act=='gaizwdm'){
	if(!empty($_POST)){
		$sq="SELECT id,holddates,hour FROM  qs_jobfair where id=".$_POST['zid'];
		$data=$db->getone($sq);
		if($data['holddates']>time()){
			$sql="UPDATE vip_zhanhui SET number='".$_POST['number']."' WHERE  qid='".$_POST['qid']."' and zid='".$_POST['zid']."' and id='".$_POST['id']."' LIMIT 1;";
			$res=mysql_query($sql);
			if(mysql_affected_rows()){
				$link[0]['text'] = "��Ԥ����չλ";
				$link[0]['href'] = '?act=mybooth';
				$link[1]['text'] = "��Ա������ҳ";
				$link[1]['href'] = 'company_index.php?act=';
				showmsg("����չλ�ɹ�!",2,$link);
			}else{
				$link[0]['text'] = "��Ԥ����չλ";
				$link[0]['href'] = '?act=mybooth';
				$link[1]['text'] = "��Ա������ҳ";
				$link[1]['href'] = 'company_index.php?act=';
				showmsg("����չλʧ��!",2,$link);
			}
		}else{
				$link[0]['text'] = "��Ԥ����չλ";
				$link[0]['href'] = '?act=mybooth';
				$link[1]['text'] = "��Ա������ҳ";
				$link[1]['href'] = 'company_index.php?act=';
				showmsg("�,�Ѿ������Ը���չλ����,����չ���Ѿ���ʼ������ˣ�",1,$link);
		}
	}
}
unset($smarty);
?>