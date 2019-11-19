<?php
 /*
 * 74cms ��Ƹ��
 * ============================================================================
 * ��Ȩ����: ��ʿ���磬����������Ȩ����
 * ��վ��ַ: http://www.74cms.com��
 * ----------------------------------------------------------------------------
 * �ⲻ��һ��������������ֻ���ڲ�������ҵĿ�ĵ�ǰ���¶Գ����������޸ĺ�
 * ʹ�ã��������Գ���������κ���ʽ�κ�Ŀ�ĵ��ٷ�����
 * ============================================================================
*/
define('IN_QISHI', true);
require_once(dirname(__FILE__).'/../data/config.php');
require_once(dirname(__FILE__).'/include/admin_common.inc.php');
require_once(ADMIN_ROOT_PATH.'include/admin_jobfair_fun.php');
$act = !empty($_REQUEST['act']) ? trim($_REQUEST['act']) : 'jobfair';
$smarty->assign('act',$act);
if($act == 'jobfair')
{
	check_permissions($_SESSION['admin_purview'],"jobfair");
	require_once(QISHI_ROOT_PATH.'include/page.class.php');
	$key=isset($_GET['key'])?trim($_GET['key']):"";
	$key_type=isset($_GET['key_type'])?intval($_GET['key_type']):"";
	$dq=$db->getall("SELECT s_id,s_districtname FROM `qs_subsite` ");
	$smarty->assign('dqname',$dq);
	
	$oederbysql=" order BY `order` DESC,id DESC";
	
	if ($key && $key_type>0)
	{
		if($key_type==1)$wheresql=" WHERE title like '%{$key}%'";
	}
	else
	{
		if(!empty($_GET['predetermined_status'])){
			if($_GET['predetermined_status']==1){
				$wheresql.=empty($wheresql)?" WHERE ":" AND ";
				$wheresql.=" holddates > ".strtotime(date('Y-m-d',strtotime('-1 days')));
				$oederbysql=" order BY `holddates` ASC";
			}elseif($_GET['predetermined_status']==2){
				$wheresql.=empty($wheresql)?" WHERE ":" AND ";
				$wheresql.=" holddates <= ".strtotime(date('Y-m-d',strtotime('-1 days')));
				$oederbysql=" order BY `holddates` desc";
			}else{
				
			}
		}else{
			$wheresql.=empty($wheresql)?" WHERE ":" AND ";
			$wheresql.=" holddates > ".strtotime(date('Y-m-d',strtotime('-1 days')));
			$oederbysql=" order BY `holddates` ASC";
		}
		if(!empty($_GET['settr']))
		{
			$settr=strtotime("-".intval($_GET['settr'])." day");
			$wheresql=empty($wheresql)?" WHERE addtime>= ".$settr:$wheresql." AND addtime>= ".$settr;
		}
		if(!empty($_GET['s_id']))
		{	
			$wheresql.=empty($wheresql)?" WHERE ":" AND ";
			$wheresql.=" subsite_id=".$_GET['s_id'];
		}
	}
	
	//echo $wheresql;
	
	if(intval($_CFG['subsite_id'])!="0")
	{
		$wheresql.=empty($wheresql)?" WHERE ":" AND ";
		$wheresql.=" subsite_id=".intval($_CFG['subsite_id']);
	}
	
	$smarty->assign('subsite_id',intval($_CFG['subsite_id']));
	
	$total_sql="SELECT COUNT(*) AS num FROM ".table('jobfair')." ".$wheresql;
	$page = new page(array('total'=>$db->get_total($total_sql), 'perpage'=>$perpage));
	$currenpage=$page->nowindex;
	$offset=($currenpage-1)*$perpage;
	$smarty->assign('list',get_jobfair($offset, $perpage,$wheresql.$oederbysql));
	$smarty->assign('page',$page->show(3));
	$smarty->assign('time',time());
	$smarty->assign('pageheader',"��Ƹ��");
	get_token();
	$smarty->display('jobfair_zp/admin_jobfair.htm');
}
elseif($act =='jobfair_del')
{
	check_permissions($_SESSION['admin_purview'],"jobfair");
	$id=$_REQUEST['id'];
	if (empty($id)) adminmsg("��ѡ����Ŀ��",1);
	check_token();
	if ($n=del_jobfair($id))
	{
	adminmsg("ɾ���ɹ���Ӱ������ {$n}",2);
	}
}
elseif($act =='jobfair_add')
{
	check_permissions($_SESSION['admin_purview'],"jobfair");
	$smarty->assign('pageheader',"������Ƹ��");
	$smarty->assign('subsite',get_subsite_list());
	get_token();
	$smarty->display('jobfair_zp/admin_jobfair_add.htm');
 
}
elseif($act == 'addsave')
{
	check_permissions($_SESSION['admin_purview'],"jobfair");
	check_token();
	$setsqlarr['title']=!empty($_POST['title'])?trim($_POST['title']):adminmsg('��û����д���⣡',1);
	$setsqlarr['color']=trim($_POST['color']);
	$setsqlarr['weight']=intval($_POST['weight']);
	$setsqlarr['industry']=trim($_POST['industry']);
	$setsqlarr['number']=trim($_POST['number']);
	$setsqlarr['holddates']=intval(convert_datefm($_POST['holddates'],2));
	$setsqlarr['hour']=$_POST['hour'];
	if ($setsqlarr['hour']=='0')
	{
	adminmsg('����дԤ������ʱ�䣡',1);
	}
	if (empty($setsqlarr['holddates']))
	{
	adminmsg('����д�ٰ����ڣ�',1);
	}
	$setsqlarr['address']=trim($_POST['address']);
	$setsqlarr['bus']=trim($_POST['bus']);
	$setsqlarr['contact']=trim($_POST['contact']);
	$setsqlarr['phone']=trim($_POST['phone']);
	$setsqlarr['display']=intval($_POST['display']);
	$setsqlarr['order']=intval($_POST['order']);
	$setsqlarr['subsite_id']=intval($_POST['subsite_id']);
	$setsqlarr['introduction']=$_POST['introduction'];
	$setsqlarr['predetermined_status']=intval($_POST['predetermined_status']);
	$setsqlarr['predetermined_web']=intval($_POST['predetermined_web']);
	$setsqlarr['predetermined_tel']=intval($_POST['predetermined_tel']);
	$setsqlarr['predetermined_point']=intval($_POST['predetermined_point']);
	$setsqlarr['hour']=intval($_POST['hour']);							//��Сʱ����
	$setsqlarr['display_time']=intval(convert_datefm($_POST['display_time'],2));			//��ʱ������ʾ
	if ($_POST['predetermined_start']=="")
	{
		$setsqlarr['predetermined_start']=0;
	}
	else
	{
		$setsqlarr['predetermined_start']=intval(convert_datefm($_POST['predetermined_start'],2));
	}
	if ($_POST['predetermined_end']=="")
	{
		$setsqlarr['predetermined_end']=0;
	}
	else
	{
		$setsqlarr['predetermined_end']=intval(convert_datefm($_POST['predetermined_end'],2));
	}
	$setsqlarr['addtime']=time();
	
	if ($id=inserttablejobfair(table('jobfair'),$setsqlarr)){
	/*-----------------------------------------------------------------*/
		$url = "./../vipgn/index.php/index/addzw/id/".$id."";
		echo "<script language='javascript' type='text/javascript'>";
		echo "window.open('$url', '����Ԥ���ײͻ�Ա' ,'height=650,width=860, toolbar=no, menubar=no, scrollbars=no, status=no, location=yes, resizable=yes')";
		echo "</script>";
	/*-----------------------------------------------------------------*/
	$link[0]['text'] = "��������";
	$link[0]['href'] = '?act=jobfair_add';
	$link[1]['text'] = "�����б�";
	$link[1]['href'] = '?act=';
	adminmsg("���ӳɹ���",2,$link);	
	}
	else
	{
	adminmsg("����ʧ�ܣ�",0);
	}	
}
elseif($act == 'jobfair_edit')
{
	check_permissions($_SESSION['admin_purview'],"jobfair");
	$id=intval($_GET['id']);
	$sql = "select * from ".table('jobfair')." where id=".intval($id)." LIMIT 1";
	$info=$db->getone($sql);
	$info['holddates']=convert_datefm($info['holddates'],1);
	if ($info['predetermined_start']=="0")
	{
		$info['predetermined_start']="";
	}
	else
	{
		$info['predetermined_start']=convert_datefm($info['predetermined_start'],1);
	}
	if ($info['predetermined_end']=="0")
	{
		$info['predetermined_end']="";
	}
	else
	{
		$info['predetermined_end']=convert_datefm($info['predetermined_end'],1);
	}
	$smarty->assign('info',$info); 
	$smarty->assign('subsite',get_subsite_list());
	$smarty->assign('pageheader',"��Ƹ��");
	get_token();
	$smarty->display('jobfair_zp/admin_jobfair_edit.htm');
}
elseif($act == 'editsave')
{
	check_permissions($_SESSION['admin_purview'],"jobfair");
	check_token();
	$id=intval($_POST['id']);
	$setsqlarr['title']=!empty($_POST['title'])?trim($_POST['title']):adminmsg('��û����д���⣡',1);
	$setsqlarr['color']=trim($_POST['color']);
	$setsqlarr['weight']=intval($_POST['weight']);
	$setsqlarr['industry']=trim($_POST['industry']);
	$setsqlarr['number']=trim($_POST['number']);
	$setsqlarr['holddates']=intval(convert_datefm($_POST['holddates'],2));
	//������Ƹ�������޸� By Z 
	$setsqlarr['hour']=$_POST['hour'];
	if ($setsqlarr['hour']=='0')
	{
	adminmsg('����дԤ������ʱ�䣡',1);
	}
	if (empty($setsqlarr['holddates']))
	{
	adminmsg('����д�ٰ����ڣ�',1);
	}
	$setsqlarr['address']=trim($_POST['address']);
	$setsqlarr['bus']=trim($_POST['bus']);
	$setsqlarr['contact']=trim($_POST['contact']);
	$setsqlarr['phone']=trim($_POST['phone']);
	$setsqlarr['display']=intval($_POST['display']);
	$setsqlarr['order']=intval($_POST['order']);
	$setsqlarr['subsite_id']=intval($_POST['subsite_id']);	
	$setsqlarr['introduction']=$_POST['introduction'];
	$setsqlarr['predetermined_status']=intval($_POST['predetermined_status']);
	$setsqlarr['predetermined_web']=intval($_POST['predetermined_web']);
	$setsqlarr['predetermined_tel']=intval($_POST['predetermined_tel']);
	$setsqlarr['predetermined_point']=intval($_POST['predetermined_point']);
	$setsqlarr['hour']=intval($_POST['hour']);		//��Сʱ����
	$setsqlarr['display_time']=intval(convert_datefm($_POST['display_time'],2));			//��ʱ������ʾ
	if ($_POST['predetermined_start']=="")
	{
		$setsqlarr['predetermined_start']=0;
	}
	else
	{
		$setsqlarr['predetermined_start']=intval(convert_datefm($_POST['predetermined_start'],2));
	}
	if ($_POST['predetermined_end']=="")
	{
		$setsqlarr['predetermined_end']=0;
	}
	else
	{
		$setsqlarr['predetermined_end']=intval(convert_datefm($_POST['predetermined_end'],2));
	}
	$setsqlarr['addtime']=time();
	$link[0]['text'] = "�����б�";
	$link[0]['href'] = '?act=';
	$link[1]['text'] = "�鿴�޸Ľ��";
	$link[1]['href'] = "?act=jobfair_edit&id=".$id;
	updatetable(table('jobfair_exhibitors'),array('jobfair_title'=>$setsqlarr['title'])," jobfairid=".$id."");
	!updatetable(table('jobfair'),$setsqlarr," id=".$id."")?adminmsg("�޸�ʧ�ܣ�",0):adminmsg("�޸ĳɹ���",2,$link);
}
elseif($act == 'exhibitors')
{	
	//echo "�λ���ҵ";exit;
	//----��Ƹ���б�
	$dq=$db->getall("SELECT s_id,s_districtname FROM `qs_subsite` ");
	$smarty->assign('dqname',$dq);
	$oederbysql=" order BY `order` DESC,id DESC";
	
		if(!empty($_GET['predetermined_status'])){
			if($_GET['predetermined_status']==1){
				$wheresql_jobfair.=empty($wheresql_jobfair)?" WHERE ":" AND ";
				$wheresql_jobfair.=" holddates > ".strtotime(date('Y-m-d',strtotime('-1 days')));
				$oederbysql_jobfair=" order BY `holddates` ASC";
			}elseif($_GET['predetermined_status']==2){
				$wheresql_jobfair.=empty($wheresql_jobfair)?" WHERE ":" AND ";
				$wheresql_jobfair.=" holddates <= ".strtotime(date('Y-m-d',strtotime('-1 days')));
				$oederbysql_jobfair=" order BY `holddates` desc";
			}else{
				
			}
		}else{
				$wheresql_jobfair.=empty($wheresql_jobfair)?" WHERE ":" AND ";
				$wheresql_jobfair.=" holddates > ".strtotime(date('Y-m-d',strtotime('-1 days')));
				$oederbysql_jobfair=" order BY `holddates` ASC";
			
		}
		if(!empty($_GET['settr']))
		{
			$settr=strtotime("-".intval($_GET['settr'])." day");
			$wheresql_jobfair=empty($wheresql_jobfair)?" WHERE addtime>= ".$settr:$wheresql_jobfair." AND addtime>= ".$settr;
		}
		if(!empty($_GET['s_id']))
		{	
			$wheresql_jobfair.=empty($wheresql_jobfair)?" WHERE ":" AND ";
			$wheresql_jobfair.=" subsite_id=".$_GET['s_id'];
		}
	
	//echo $wheresql_jobfair;exit;
	
	if(intval($_CFG['subsite_id'])!="0")
	{
		$wheresql_jobfair.=empty($wheresql_jobfair)?" WHERE ":" AND ";
		$wheresql_jobfair.=" subsite_id=".intval($_CFG['subsite_id']);
	}
	
	$smarty->assign('subsite_id',intval($_CFG['subsite_id']));
	//echo $wheresql_jobfair.$oederbysql_jobfair;exit;
	$smarty->assign('jobfair_list',get_jobfair('','',$wheresql_jobfair.$oederbysql_jobfair));
	
	//----��Ƹ���б�����--------------------------------------------
	check_permissions($_SESSION['admin_purview'],"jobfair_exhibitors");
	require_once(QISHI_ROOT_PATH.'include/page.class.php');
	$key=isset($_GET['key'])?trim($_GET['key']):"";
	$key_type=isset($_GET['key_type'])?intval($_GET['key_type']):"";
	$jobfair_id=isset($_POST['jobfair_id'])?intval($_POST['jobfair_id']):'';//echo $jobfair_id;exit;
	$oederbysql=" order BY j.id DESC";
	///---������
	if(!empty($_GET['s_id']))
		{	
			$wheresql=" WHERE j.subsite_id = '".intval($_GET['s_id'])."'";
		}
	if(intval($_CFG['subsite_id'])!="0")
	{
		$wheresql.=" WHERE j.subsite_id=".intval($_CFG['subsite_id']);
	}
	if(!empty($_GET['jobfair_id']))
		{	
			$wheresql=" WHERE j.jobfairid = '".intval($_GET['jobfair_id'])."'";
		}
	if(!empty($_GET['jobfair_id']) && !empty($_GET['s_id']))
		{	
			$wheresql=" WHERE j.jobfairid = '".intval($_GET['jobfair_id'])."' and j.subsite_id =".intval($_GET['s_id']);
		}	
	//----
	if ($key && $key_type>0)
	{
		
		if     ($key_type==1)$wheresql=" WHERE j.companyname like '%{$key}%'";
		if     ($key_type==2)$wheresql=" WHERE j.jobfair_title like '%{$key}%'";
	}
	else
	{
		if ($_GET['predetermined_status']<>'')
		{
		$wheresql=" WHERE j.audit=".intval($_GET['audit']);
		}
		if (!empty($_GET['etypr']))
		{
			$wheresql=empty($wheresql)?" WHERE j.etypr=".intval($_GET['etypr']):$wheresql." AND j.etypr> ".intval($_GET['etypr']);
		}
		if (!empty($_GET['settr']))
		{
			$settr=strtotime("-".intval($_GET['settr'])." day");
			$wheresql=empty($wheresql)?" WHERE j.eaddtime> ".$settr:$wheresql." AND j.eaddtime> ".$settr;
		}
	}
	//echo $;echo $wheresql;exit;
	$total_sql="SELECT COUNT(*) AS num FROM ".table('jobfair_exhibitors')." as j left join ".table('company_profile')." as c on c.uid=j.uid  ".$wheresql;
	$page = new page(array('total'=>$db->get_total($total_sql), 'perpage'=>$perpage));
	$currenpage=$page->nowindex;
	$offset=($currenpage-1)*$perpage;
	//echo '<pre>';print_r(get_jobfair_exhibitors($offset, $perpage,$wheresql.$oederbysql));exit;
	$smarty->assign('list',get_jobfair_exhibitors($offset, $perpage,$wheresql.$oederbysql));
	$smarty->assign('page',$page->show(3));
	$smarty->assign('time',time());
	$smarty->assign('pageheader',"�λ���ҵ");
	get_token();
	$smarty->display('jobfair_zp/admin_jobfair_exhibitors.htm');
}
elseif($act =='exhibitors_del')
{
	check_permissions($_SESSION['admin_purview'],"jobfair_exhibitors");
	$id=$_REQUEST['id'];
	if (empty($id)) adminmsg("��ѡ����Ŀ��",1);
	check_token();
	if ($n=del_exhibitors($id))
	{
	adminmsg("ɾ���ɹ���Ӱ������ {$n}",2);
	}
}
elseif($act =='exhibitors_audit')
{
	check_permissions($_SESSION['admin_purview'],"jobfair_exhibitors");
	$id=$_REQUEST['id'];
	if (empty($id)) adminmsg("��ѡ����Ŀ��",1);
	if ($n=edit_exhibitors_audit($id,$_POST['audit']))
	{
	adminmsg("���óɹ���Ӱ������ {$n}",2);
	}
}
elseif($act =='exhibitors_add')
{
	check_permissions($_SESSION['admin_purview'],"jobfair_exhibitors");
	get_token();
	$smarty->assign('pageheader',"�λ���ҵ");	
	$smarty->assign('jobfair',get_jobfair_audit());
	$smarty->display('jobfair_zp/admin_jobfair_exhibitors_add.htm'); 
}
elseif($act == 'exhibitors_add_save')
{
	check_permissions($_SESSION['admin_purview'],"jobfair_exhibitors");
	check_token();	
	$t=$_POST['t'];
	if ($t=="2")
	{
		$setsqlarr['companyname']=!empty($_POST['companyname'])?trim($_POST['companyname']):adminmsg('��û����ҵ���ƣ�',1);
	}
	elseif ($t=="1")
	{
		$comid=intval($_POST['comid']);
		if ($comid==0)
		{
			adminmsg('��ѡ����ҵ��',1);
		}
		else
		{
			$sql = "select * from ".table('company_profile')." where id={$comid} LIMIT 1";
			$info=$db->getone($sql);
			if (empty($info))
			{
			adminmsg('��ҵ�����ڣ�',1);
			}
			$setsqlarr['uid']=$info['uid'];
			$setsqlarr['companyname']=$info['companyname'];
			$setsqlarr['company_id']=$info['id'];
			$setsqlarr['company_addtime']=$info['addtime'];
		}
	}
	$setsqlarr['audit']=intval($_POST['audit']);
	$setsqlarr['etypr']=intval($_POST['etypr']);	
	$setsqlarr['eaddtime']=time();
	$setsqlarr['note']=trim($_POST['note']);
	$setsqlarr['jobfairid']=intval($_POST['jobfairid']);
			$sql = "select * from ".table('jobfair')." where id={$setsqlarr['jobfairid']} LIMIT 1";
			$jobfair=$db->getone($sql);
			if (empty($jobfair))
			{
			adminmsg('��Ƹ�᲻����',1);
			}
	$setsqlarr['jobfair_title']=$jobfair['title'];
	$setsqlarr['jobfair_addtime']=$jobfair['addtime'];
	if (inserttable(table('jobfair_exhibitors'),$setsqlarr))
	{
	$link[0]['text'] = "��������";
	$link[0]['href'] = '?act=exhibitors_add';
	$link[1]['text'] = "�����б�";
	$link[1]['href'] = '?act=exhibitors';
	adminmsg("���ӳɹ���",2,$link);	
	}
	else
	{
	adminmsg("����ʧ�ܣ�",0);
	}	
}
elseif($act == 'exhibitors_edit')
{
	check_permissions($_SESSION['admin_purview'],"jobfair_exhibitors");
	get_token();
	$id=intval($_GET['id']);
	$sql = "select * from ".table('jobfair_exhibitors')." where id='{$id}' LIMIT 1";
	$info=$db->getone($sql);
	if ($info['uid']>0)
	{
	$info['company_url']=url_rewrite('QS_companyshow',array('id'=>$info['company_id']));
	}
	$smarty->assign('info',$info);
	$smarty->assign('jobfair',get_jobfair_audit());
	$smarty->assign('pageheader',"��Ƹ��");	
	$smarty->display('jobfair_zp/admin_jobfair_exhibitors_edit.htm');
}
elseif($act == 'exhibitors_edit_save')
{
	check_permissions($_SESSION['admin_purview'],"jobfair_exhibitors");
	check_token();
	$id=intval($_POST['id']);
	$setsqlarr['companyname']=!empty($_POST['companyname'])?trim($_POST['companyname']):adminmsg('��û����ҵ���ƣ�',1);	 
	$setsqlarr['audit']=intval($_POST['audit']);
	$setsqlarr['etypr']=intval($_POST['etypr']);	
	$setsqlarr['note']=trim($_POST['note']);
	$link[0]['text'] = "�����б�";
	$link[0]['href'] = '?act=exhibitors';
	!updatetable(table('jobfair_exhibitors'),$setsqlarr," id=".$id."")?adminmsg("�޸�ʧ�ܣ�",0):adminmsg("�޸ĳɹ���",2,$link);
}
?>