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
// echo "2222";exit;
require_once(dirname(__FILE__).'/company_common.php');
$smarty->assign('leftmenu',"info");
if ($act=='company_profile')
{
	$smarty->assign('title','��ҵ���Ϲ��� - ��ҵ��Ա���� - '.$_CFG['site_name']);
	$smarty->assign('company_profile',$company_profile);
	$smarty->display('member_company/company_profile.htm');
}
elseif ($act=='company_profile_save')
{
	
	$uid=intval($_SESSION['uid']);
	$setsqlarr['uid']=intval($_SESSION['uid']);
	$setsqlarr['companyname']=trim($_POST['companyname'])?utf8_to_gbk(trim($_POST['companyname'])):exit('��û��������ҵ���ƣ�');
	check_word($_CFG['filter'],$setsqlarr['companyname'])?exit($_CFG['filter_tips']):'';
	$setsqlarr['nature']=trim($_POST['nature'])?intval($_POST['nature']):exit('��ѡ����ҵ���ʣ�');
	$setsqlarr['nature_cn']=utf8_to_gbk(trim($_POST['nature_cn']));
	$setsqlarr['trade']=trim($_POST['trade'])?intval($_POST['trade']):exit('��ѡ��������ҵ��');
	$setsqlarr['trade_cn']=utf8_to_gbk(trim($_POST['trade_cn']));
	$setsqlarr['district']=intval($_POST['district'])>0?intval($_POST['district']):exit('��ѡ������������');
	$setsqlarr['sdistrict']=intval($_POST['sdistrict']);
	$setsqlarr['district_cn']=utf8_to_gbk(trim($_POST['district_cn']));
	if (intval($_POST['street'])>0)
	{
	$setsqlarr['street']=intval($_POST['street']);
	$setsqlarr['street_cn']=utf8_to_gbk(trim($_POST['street_cn']));
	}
	$setsqlarr['scale']=trim($_POST['scale'])?utf8_to_gbk(trim($_POST['scale'])):exit('��ѡ��˾��ģ��');
	$setsqlarr['scale_cn']=utf8_to_gbk(trim($_POST['scale_cn']));
	$setsqlarr['registered']=utf8_to_gbk(trim($_POST['registered']));
	$setsqlarr['currency']=utf8_to_gbk(trim($_POST['currency']));
	$setsqlarr['address']=trim($_POST['address'])?utf8_to_gbk(trim($_POST['address'])):exit('����дͨѶ��ַ��');
	check_word($_CFG['filter'],$setsqlarr['address'])?exit($_CFG['filter_tips']):'';
	$setsqlarr['contact']=trim($_POST['contact'])?utf8_to_gbk(trim($_POST['contact'])):exit('����д��ϵ�ˣ�');
	check_word($_CFG['filter'],$setsqlarr['contact'])?exit($_CFG['filter_tips']):'';
	$setsqlarr['telephone']=trim($_POST['telephone'])?utf8_to_gbk(trim($_POST['telephone'])):exit('����д��ϵ�绰��');
	check_word($_CFG['filter'],$setsqlarr['telephone'])?exit($_CFG['filter_tips']):'';
	$setsqlarr['email']=trim($_POST['email'])?utf8_to_gbk(trim($_POST['email'])):exit('����д��ϵ���䣡');
	check_word($_CFG['filter'],$setsqlarr['email'])?exit($_CFG['filter_tips']):'';
	$setsqlarr['website']=utf8_to_gbk(trim($_POST['website']));
	check_word($_CFG['filter'],$setsqlarr['website'])?exit($_CFG['filter_tips']):'';
	$setsqlarr['contents']=trim($_POST['contents'])?utf8_to_gbk(trim($_POST['contents'])):exit('����д��˾��飡');
	check_word($_CFG['filter'],$setsqlarr['contents'])?exit($_CFG['filter_tips']):'';
	$setsqlarr['yellowpages']=intval($_POST['yellowpages']);
	
	
	$setsqlarr['contact_show']=intval($_POST['contact_show']);
	$setsqlarr['email_show']=intval($_POST['email_show']);
	$setsqlarr['telephone_show']=intval($_POST['telephone_show']);
	$setsqlarr['address_show']=intval($_POST['address_show']);
		
	if ($_CFG['company_repeat']=="0")
	{
		$info=$db->getone("SELECT uid FROM ".table('company_profile')." WHERE companyname ='{$setsqlarr['companyname']}' AND uid<>'{$_SESSION['uid']}' LIMIT 1");
		if(!empty($info))
		{
			exit("{$setsqlarr['companyname']}�Ѿ����ڣ�ͬ��˾��Ϣ�����ظ�ע��");
		}
	}
	if ($company_profile)
	{
			$_CFG['audit_edit_com']<>"-1"?$setsqlarr['audit']=intval($_CFG['audit_edit_com']):'';
			if (updatetable(table('company_profile'), $setsqlarr," uid='{$uid}'"))
			{
				$jobarr['companyname']=$setsqlarr['companyname'];
				$jobarr['trade']=$setsqlarr['trade'];
				$jobarr['trade_cn']=$setsqlarr['trade_cn'];
				$jobarr['scale']=$setsqlarr['scale'];
				$jobarr['scale_cn']=$setsqlarr['scale_cn'];
				$jobarr['street']=$setsqlarr['street'];
				$jobarr['street_cn']=$setsqlarr['street_cn'];			
				if (!updatetable(table('jobs'),$jobarr," uid=".$setsqlarr['uid']."")) exit('�޸Ĺ�˾���Ƴ���');
				if (!updatetable(table('jobs_tmp'),$jobarr," uid=".$setsqlarr['uid']."")) exit('�޸Ĺ�˾���Ƴ���');
				if (!updatetable(table('jobfair_exhibitors'),array('companyname'=>$setsqlarr['companyname'])," uid=".$setsqlarr['uid']."")) exit('�޸Ĺ�˾���Ƴ���');
				$soarray['trade']=$jobarr['trade'];
				$soarray['scale']=$jobarr['scale'];
				$soarray['street']=$setsqlarr['street'];
				updatetable(table('jobs_search_scale'),$soarray," uid=".$setsqlarr['uid']."");
				updatetable(table('jobs_search_wage'),$soarray," uid=".$setsqlarr['uid']."");
				updatetable(table('jobs_search_rtime'),$soarray," uid=".$setsqlarr['uid']."");
				updatetable(table('jobs_search_stickrtime'),$soarray," uid=".$setsqlarr['uid']."");
				updatetable(table('jobs_search_hot'),$soarray," uid=".$setsqlarr['uid']."");
				updatetable(table('jobs_search_key'),$soarray," uid=".$setsqlarr['uid']."");
				unset($setsqlarr);
				write_memberslog($_SESSION['uid'],$_SESSION['utype'],8001,$_SESSION['username'],"�޸���ҵ����");
				exit("1");
			}
			else
			{
				exit("����ʧ�ܣ�");
			}
	}
	else
	{
			$setsqlarr['audit']=intval($_CFG['audit_add_com']);
			$setsqlarr['addtime']=$timestamp;
			$setsqlarr['refreshtime']=$timestamp;
			if (inserttable(table('company_profile'),$setsqlarr))
			{
				write_memberslog($_SESSION['uid'],$_SESSION['utype'],8001,$_SESSION['username'],"������ҵ����");
				exit("1");
			}
			else
			{
				exit("����ʧ�ܣ�");
			}
	}
}
elseif ($act=='company_auth')
{
	$link[0]['text'] = "������ҵ����";
	$link[0]['href'] = '?act=company_profile';
	$link[1]['text'] = "������ҳ";
	$link[1]['href'] = 'company_index.php';
	if (empty($company_profile['companyname'])) showmsg("������������ҵ�������ϴ�Ӫҵִ�գ�",1,$link);
	$reason = get_user_audit_reason(intval($_SESSION['uid']));
	$smarty->assign('title','Ӫҵִ�� - ��ҵ��Ա���� - '.$_CFG['site_name']);
	$smarty->assign('points',get_cache('points_rule'));
	$smarty->assign('reason',$reason['reason']);
	$smarty->assign('company_profile',$company_profile);
	$smarty->display('member_company/company_auth.htm');
}
elseif ($act=='company_auth_save')
{
	require_once(QISHI_ROOT_PATH.'include/upload.php');
	$setsqlarr['license']=trim($_POST['license'])?trim($_POST['license']):showmsg('��û������Ӫҵִ��ע��ţ�',1);
	$setsqlarr['audit']=2;//���Ĭ�������..
	!$_FILES['certificate_img']['name']?showmsg('���ϴ�ͼƬ��',1):"";
	$certificate_dir="../../data/".$_CFG['updir_certificate']."/".date("Y/m/d/");
	make_dir($certificate_dir);
	$setsqlarr['certificate_img']=_asUpFiles($certificate_dir, "certificate_img",$_CFG['certificate_max_size'],'gif/jpg/bmp/png',true);
	if ($setsqlarr['certificate_img'])
	{
	/*
	3.5������ˮӡstart
	 */
	if(extension_loaded('gd')){
		include_once(QISHI_ROOT_PATH.'include/watermark.php');
		$font_dir=QISHI_ROOT_PATH."data/contactimgfont/cn.ttc";
		if(file_exists($font_dir)){
			$tpl=new watermark;
			$tpl->img($certificate_dir.$setsqlarr['certificate_img'],gbk_to_utf8($_CFG['site_name']),$font_dir,15,0);
		}
	}
	/*
	3.5����end
	 */
	$setsqlarr['certificate_img']=date("Y/m/d/").$setsqlarr['certificate_img'];
	$auth=$company_profile;
	@unlink("../../data/".$_CFG['updir_certificate']."/".$auth['certificate_img']);
	$wheresql="uid='".$_SESSION['uid']."'";
	write_memberslog($_SESSION['uid'],1,8002,$_SESSION['username'],"�ϴ���Ӫҵִ��");
	updatetable(table('jobs'),array('company_audit'=>2),$wheresql);
	updatetable(table('jobs_tmp'),array('company_audit'=>2),$wheresql);
	!updatetable(table('company_profile'),$setsqlarr,$wheresql)?showmsg('����ʧ�ܣ�',1):showmsg('����ɹ��������ĵȴ�����Ա��ˣ�',2);
	}
	else
	{
	showmsg('����ʧ�ܣ�',1);
	}
}
elseif ($act=='company_logo')
{
	$link[0]['text'] = "������ҵ����";
	$link[0]['href'] = '?act=company_profile';
	$link[1]['text'] = "��Ա������ҳ";
	$link[1]['href'] = 'company_index.php';
	if (empty($company_profile['companyname'])) showmsg("������������ҵ�������ϴ���ҵLOGO��",1,$link);
	$smarty->assign('title','��ҵLOGO - ��ҵ��Ա���� - '.$_CFG['site_name']);
	$smarty->assign('company_profile',$company_profile);
	$smarty->assign('rand',rand(1,100));
	$smarty->display('member_company/company_logo.htm');
}
elseif ($act=='company_logo_save')
{
	require_once(QISHI_ROOT_PATH.'include/upload.php');
	!$_FILES['logo']['name']?showmsg('���ϴ�ͼƬ��',1):"";
	$uplogo_dir="../../data/logo/".date("Y/m/d/");
	make_dir($uplogo_dir);
	$setsqlarr['logo']=_asUpFiles($uplogo_dir, "logo",$_CFG['logo_max_size'],'gif/jpg/bmp/png',$_SESSION['uid']);
	
	if ($setsqlarr['logo'])
	{
	$setsqlarr['logo']=date("Y/m/d/").$setsqlarr['logo'];
	$logo_src="../../data/logo/".$setsqlarr['logo'];
	$thumb_dir=$uplogo_dir;
	makethumb($logo_src,$thumb_dir,300,110);//��������ͼ
	$wheresql="uid='".$_SESSION['uid']."'";
			if (updatetable(table('company_profile'),$setsqlarr,$wheresql))
			{
			$link[0]['text'] = "�鿴LOGO";
			$link[0]['href'] = '?act=company_logo';
			write_memberslog($_SESSION['uid'],1,8003,$_SESSION['username'],"�ϴ�����ҵLOGO");
			showmsg('�ϴ��ɹ���',2,$link);
			}
			else
			{
			showmsg('����ʧ�ܣ�',1);
			}
	}
	else
	{
	showmsg('����ʧ�ܣ�',1);
	}
}
elseif ($act=='company_logo_del')
{
	$uplogo_dir="../../data/logo/";
	$auth=$company_profile;//��ȡԭʼͼƬ
	@unlink($uplogo_dir.$auth['logo']);//��ɾ��ԭʼͼƬ
	$setsqlarr['logo']="";
	$wheresql="uid='".$_SESSION['uid']."'";
		if (updatetable(table('company_profile'),$setsqlarr,$wheresql))
		{
		write_memberslog($_SESSION['uid'],1,8004,$_SESSION['username'],"ɾ������ҵLOGO");
		showmsg('ɾ���ɹ���',2);
		}
		else
		{
		showmsg('ɾ��ʧ�ܣ�',1);
		}
}
 elseif ($act=='company_map')
{
	$link[0]['text'] = "��д��ҵ����";
	$link[0]['href'] = '?act=company_profile';
	if (empty($company_profile['companyname'])) showmsg("������������ҵ���������õ��ӵ�ͼ��",1,$link);
	if ($company_profile['map_open']=="1")//�����Ѿ���ͨ
	{
	header("Location: ?act=company_map_set");
	}
	else
	{
		if($_CFG['operation_mode']=='1'){
			$smarty->assign('operation_mode',1);
			$points=get_cache('points_rule');//��ȡ�������ѹ���
			$smarty->assign('points',$points['company_map']['value']);
		}elseif($_CFG['operation_mode']=='2'){
			$smarty->assign('operation_mode',2);
			$setmeal=get_user_setmeal($_SESSION['uid']);
			$smarty->assign('map_open',$setmeal['map_open']);
		}elseif($_CFG['operation_mode']=='3'){
			$setmeal=get_user_setmeal($_SESSION['uid']);
			if ($setmeal['endtime']<time() && $setmeal['endtime']<>'0'){
				if($_CFG['setmeal_to_points']==1){
					$smarty->assign('operation_mode',1);
					$points=get_cache('points_rule');//��ȡ�������ѹ���
					$smarty->assign('points',$points['company_map']['value']);
				}else{
					$smarty->assign('operation_mode',2);
					$setmeal=get_user_setmeal($_SESSION['uid']);
					$smarty->assign('map_open',$setmeal['map_open']);
				}
			}else{
				$smarty->assign('operation_mode',2);
				$setmeal=get_user_setmeal($_SESSION['uid']);
				$smarty->assign('map_open',$setmeal['map_open']);
			}
		}
		$smarty->assign('title','��ͨ���ӵ�ͼ - ��ҵ��Ա���� - '.$_CFG['site_name']);
		$smarty->display('member_company/company_map_open.htm');
	}
}
elseif ($act=='company_map_open')
{
	$link[0]['text'] = "��д��ҵ����";
	$link[0]['href'] = '?act=company_profile';
	if (empty($company_profile['companyname'])) showmsg("������������ҵ���������õ��ӵ�ͼ��",1);
	if ($company_profile['map_open']=="1")//�����Ѿ���ͨ
	{
	header("Location: ?act=company_map_set");
	}else{
		if($_CFG['operation_mode']=='1'){
			$operation_mode = 1;
		}elseif($_CFG['operation_mode']=='2'){
			$operation_mode = 2;
		}elseif($_CFG['operation_mode']=='3'){
			$setmeal=get_user_setmeal($_SESSION['uid']);
			if ($setmeal['endtime']<time() && $setmeal['endtime']<>'0'){
				if($_CFG['setmeal_to_points']==1){
					$operation_mode = 1;
				}else{
					$operation_mode = 2;
				}
			}else{
				$operation_mode = 2;
			}
		}
	 	if($operation_mode=='1'){
			$points=get_cache('points_rule');
			$user_points=get_user_points($_SESSION['uid']);
			if ($points['company_map']['type']=="2" && $points['company_map']['value']>$user_points)
			{
			showmsg("���".$_CFG['points_byname']."���㣬���ֵ���ٽ�����ز�����",0);
			}
		}elseif($operation_mode=='2'){
			$setmeal=get_user_setmeal($_SESSION['uid']);
			if ($setmeal['endtime']<time() &&  $setmeal['endtime']<>'0'){
				showmsg("��ķ����ײ��ѵ��ڣ������¿�ͨ����",0);
			}elseif($setmeal['map_open']=='0'){
				showmsg("������ײͣ�{$setmeal['setmeal_name']} û�п�ͨ���ӵ�ͼ��Ȩ�ޣ������������ײͣ�",0);
			}
		}
		
		$wheresql="uid='".$_SESSION['uid']."'";
		$setsqlarr['map_open']=1;
		if (updatetable(table('company_profile'),$setsqlarr,$wheresql))
		{
			//�����ʼ�
			$mailconfig=get_cache('mailconfig');
			if ($mailconfig['set_addmap']=="1" && $user['email_audit']=="1")
			{
			dfopen($_CFG['site_domain'].$_CFG['site_dir']."plus/asyn_mail.php?uid=".$_SESSION['uid']."&key=".asyn_userkey($_SESSION['uid'])."&act=set_addmap");
			}
			//sms
			$sms=get_cache('sms_config');
			if ($sms['open']=="1" && $sms['set_addmap']=="1"  && $user['mobile_audit']=="1")
			{
			dfopen($_CFG['site_domain'].$_CFG['site_dir']."plus/asyn_sms.php?uid=".$_SESSION['uid']."&key=".asyn_userkey($_SESSION['uid'])."&act=set_addmap");
			}			
			write_memberslog($_SESSION['uid'],1,8005,$_SESSION['username'],"��ͨ�˵��ӵ�ͼ");
			if($operation_mode=='1'){
				if ($points['company_map']['value']>0)
				{
				report_deal($_SESSION['uid'],$points['company_map']['type'],$points['company_map']['value']);
				$user_points=get_user_points($_SESSION['uid']);
				$operator=$points['company_map']['type']=="1"?"+":"-";
				write_memberslog($_SESSION['uid'],1,9001,$_SESSION['username'],"��ͨ�˵��ӵ�ͼ({$operator}{$points['company_map']['value']})��(ʣ��:{$user_points})",1,1008,"��ͨ���ӵ�ͼ","{$operator}{$points['company_map']['value']}","{$user_points}");
				}
			}elseif($operation_mode=='2'){
				write_memberslog($_SESSION['uid'],1,9002,$_SESSION['username'],"ʹ�÷����ײͿ�ͨ�˵��ӵ�ͼ",2,1008,"��ͨ���ӵ�ͼ","0","");
			}
			header("Location: ?act=company_map_set");
		}
		else
		{
		showmsg('��ͨʧ�ܣ�',1);
		}
	}
	
}
 
elseif ($act=='company_map_set')
{
	$smarty->assign('title','���õ��ӵ�ͼ - ��ҵ��Ա���� - '.$_CFG['site_name']);
	$smarty->assign('company_profile',$company_profile);
	$smarty->display('member_company/company_map_set.htm');
}
elseif ($act=='company_map_set_save')
{
	$setsqlarr['map_x']=trim($_POST['x'])?trim($_POST['x']):showmsg('���ȵ�����ڵ�ͼ�ϱ���ҵ�λ�á���ť��Ȼ���ٵ�������ҵ�λ�ý��б��棡',1);
	$setsqlarr['map_y']=trim($_POST['y'])?trim($_POST['y']):showmsg('���ȵ�����ڵ�ͼ�ϱ���ҵ�λ�á���ť��Ȼ���ٵ�������ҵ�λ�ý��б��棡',1);
	$setsqlarr['map_zoom']=trim($_POST['zoom']);
	$wheresql=" uid='{$_SESSION['uid']}'";
	write_memberslog($_SESSION['uid'],1,8006,$_SESSION['username'],"�����˵��ӵ�ͼ����");
	if (updatetable(table('company_profile'),$setsqlarr,$wheresql))
	{
		$jobsql['map_x']=$setsqlarr['map_x'];
		$jobsql['map_y']=$setsqlarr['map_y'];
		updatetable(table('jobs'),$jobsql,$wheresql);
		updatetable(table('jobs_tmp'),$jobsql,$wheresql);
		unset($setsqlarr['map_zoom']);
		//
		updatetable(table('jobs_search_rtime'),$jobsql,$wheresql);
		updatetable(table('jobs_search_key'),$jobsql,$wheresql);
		showmsg('����ɹ�',2);
	}
	else
	{
	showmsg('����ʧ��',1);
	}
}
elseif ($act=='company_news')
{
	$smarty->assign('news',get_company_news(0,60,$_SESSION['uid']));
	$smarty->assign('title','��˾���� - ��ҵ��Ա���� - '.$_CFG['site_name']);
	$smarty->display('member_company/company_news_list.htm');
}
if ($act=='company_news_add')
{
	$link[0]['text'] = "������ҵ����";
	$link[0]['href'] = '?act=company_profile';
	$link[1]['text'] = "��Ա������ҳ";
	$link[1]['href'] = 'company_index.php';
	if (empty($company_profile['companyname'])) showmsg("������������ҵ���ϣ�",1,$link);
	$smarty->assign('title','��ӹ�˾���� - ��Ա���� - '.$_CFG['site_name']);
	$smarty->display('member_company/company_news_add.htm');
}
elseif ($act=='company_news_add_save')
{
	$n=$db->get_total("SELECT COUNT(*) AS num FROM ".table('company_news')." WHERE uid='".intval($_SESSION['uid'])."'");
	if($n>=60)
	{
	showmsg('��ҵ������෢��60����',1);
	}
 	if ($company_profile['audit']=="1")
	{
	$setsqlarr['audit']=intval($_CFG['audit_verifycom_addnews']);
	}
	else
	{
	$setsqlarr['audit']=intval($_CFG['audit_unexaminedcom_addnews']);
	}
 	$setsqlarr['title']=!empty($_POST['title'])?trim($_POST['title']):showmsg('����д���⣡',1);
	check_word($_CFG['filter'],$_POST['title'])?showmsg($_CFG['filter_tips'],0):'';
	$setsqlarr['order']=intval($_POST['order']);
	$setsqlarr['content']=!empty($_POST['content'])?trim($_POST['content']):showmsg('����д����',1);
	check_word($_CFG['filter'],$_POST['content'])?showmsg($_CFG['filter_tips'],0):'';
	$setsqlarr['addtime']=time();
	$setsqlarr['uid']=intval($_SESSION['uid']);
	$setsqlarr['company_id']=$company_profile['id'];
	$link[0]['text'] = "�����б�";
	$link[0]['href'] = '?act=company_news';
	$link[1]['text'] = "�������";
	$link[1]['href'] = '?act=company_news_add';
	!inserttable(table('company_news'),$setsqlarr)?showmsg("���ʧ�ܣ�",0):showmsg("��ӳɹ���",2,$link);
}
if ($act=='company_news_edit')
{
	$uid=intval($_SESSION['uid']);
	$id=intval($_GET['id']);
	$smarty->assign('news',$db->getone("select * from ".table('company_news')." where uid='{$uid}' AND id ='{$id}' LIMIT 1"));
	$smarty->assign('title','�޸Ĺ�˾���� - ��Ա���� - '.$_CFG['site_name']);
	$smarty->display('member_company/company_news_edit.htm');
}
elseif ($act=='company_news_edit_save')
{
 	if ($company_profile['audit']=="1")
	{
	$_CFG['audit_verifycom_editnews']<>"-1"?$setsqlarr['audit']=intval($_CFG['audit_verifycom_editnews']):'';
	}
	else
	{
	$_CFG['audit_unexaminedcom_editnews']<>"-1"?$setsqlarr['audit']=intval($_CFG['audit_unexaminedcom_editnews']):'';
	}
 	$setsqlarr['title']=!empty($_POST['title'])?trim($_POST['title']):showmsg('����д���⣡',1);
	check_word($_CFG['filter'],$_POST['title'])?showmsg($_CFG['filter_tips'],0):'';
	$setsqlarr['order']=intval($_POST['order']);
	$setsqlarr['content']=!empty($_POST['content'])?trim($_POST['content']):showmsg('����д����',1);
	check_word($_CFG['filter'],$_POST['content'])?showmsg($_CFG['filter_tips'],0):'';
	$link[0]['text'] = "�����б�";
	$link[0]['href'] = '?act=company_news';
	$uid=intval($_SESSION['uid']);
	$id=intval($_POST['id']);
	!updatetable(table('company_news'),$setsqlarr," uid='{$uid}' AND id='{$id}' ")?showmsg("�޸�ʧ�ܣ�",0):showmsg("�޸ĳɹ���",2,$link);
}
elseif ($act=='company_news_del')
{
	$id =!empty($_POST['id'])?$_POST['id']:$_GET['id'];
	if (empty($id))
	{
	showmsg("��û��ѡ�����ţ�",1);
	}
	if($n=del_company_news($id,$_SESSION['uid']))
	{
	showmsg("ɾ���ɹ�����ɾ�� {$n} ��",2);
	}
	else
	{
	showmsg("ɾ��ʧ�ܣ�",0);
	}
}
elseif ($act=='company_img')
{
	$link[0]['text'] = "������ҵ����";
	$link[0]['href'] = '?act=company_profile';
	$link[1]['text'] = "��Ա������ҳ";
	$link[1]['href'] = 'company_index.php';
	if (empty($company_profile['companyname'])) showmsg("������������ҵ�������ϴ���ҵͼƬ��",1,$link);
	$smarty->assign('title','��ҵͼƬ - ��ҵ��Ա���� - '.$_CFG['site_name']);
	$smarty->assign('img',get_company_img(0,8,$_SESSION['uid']));	
	$smarty->display('member_company/company_img.htm');
}
elseif ($act=='company_img_save')
{
	$n=$db->get_total("SELECT COUNT(*) AS num FROM ".table('company_img')." WHERE uid='".intval($_SESSION['uid'])."'");
	if($n>=8)
	{
	showmsg('��ҵͼƬ��෢��8�ţ�',1);
	}
	require_once(QISHI_ROOT_PATH.'include/upload.php');
	!$_FILES['img']['name']?showmsg('���ϴ�ͼƬ��',1):"";
	$datedir=date("Y/m/d/");
	$up_dir="../../data/companyimg/original/".$datedir;
	make_dir($up_dir);
	$setsqlarr['img']=_asUpFiles($up_dir,"img",800,'gif/jpg/bmp/png',true);
	if ($setsqlarr['img'])
	{
	$img_src=$up_dir.$setsqlarr['img'];
	$thumb_dir="../../data/companyimg/thumb/".$datedir;
	make_dir($thumb_dir);
	makethumb($img_src,$up_dir,600,600);
	makethumb($img_src,$thumb_dir,295,165);
	$setsqlarr['uid']=intval($_SESSION['uid']);
	$setsqlarr['company_id']=$company_profile['id'];
	$setsqlarr['addtime']=time();
	$setsqlarr['title']=trim($_POST['title']);
	$setsqlarr['img']=$datedir.$setsqlarr['img'];
 	if ($company_profile['audit']=="1")
	{
	$setsqlarr['audit']=intval($_CFG['audit_verifycom_addimg']);
	}
	else
	{
	$setsqlarr['audit']=intval($_CFG['audit_unexaminedcom_addimg']);
	}
 			if (inserttable(table('company_img'),$setsqlarr))
			{
			$link[0]['text'] = "������һҳ";
			$link[0]['href'] = '?act=company_img';
			showmsg('�ϴ��ɹ���',2,$link);
			}
			else
			{
			showmsg('����ʧ�ܣ�',1);
			}
	}
	else
	{
	showmsg('����ʧ�ܣ�',1);
	}
}
elseif ($act=='company_img_del')
{
	$uid=intval($_SESSION['uid']);
	$id=intval($_GET['id']);
	$img=$db->getone("select * from ".table('company_img')." WHERE uid='{$uid}' AND id='{$id}' LIMIT 1");
	if (empty($img))
	{
	showmsg('ɾ��ʧ�ܣ�',1);
	}
	@unlink("../../data/companyimg/original/".$img['img']);
	@unlink("../../data/companyimg/thumb/".$img['img']);
	$db->query("Delete from ".table('company_img')." WHERE  uid='{$uid}' AND id='{$id}'");
	showmsg('ɾ���ɹ���',2);
}
unset($smarty);
?>