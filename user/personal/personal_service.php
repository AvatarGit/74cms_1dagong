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
require_once(dirname(__FILE__).'/gifts_common.php');
$smarty->assign('leftmenu',"service");
if ($act=='gifts')
{	
	$smarty->assign('title','ְҵ���� - ���˻�Ա���� - '.$_CFG['site_name']);
	$smarty->assign('gifts',get_gifts($_SESSION['uid']));
	$captcha=get_cache('captcha');
	$smarty->assign('verify_gifts',$captcha['verify_gifts']);
	$smarty->display('member_personal/personal_gifts.htm');
}
//-----ffffff------��ʼ-------
elseif($act == 'get_gifts'){
	//echo "��ȡ�˺�";exit;
	$wheresql=" WHERE uid='".$_SESSION['uid']."' ";
	$sql="SELECT * FROM ".table('resume').$wheresql;
	$resume=get_resume_list($sql,12,true,true,true);
	if($resume){//---�м���
		foreach($resume as $key=>$val){
			//echo $val['complete_percent'];exit;
			if(intval($val['complete_percent']) < 40){///---�ﵽ40%����
				
				showmsg("����д�ļ������������ƣ�����ӹ�������������Ϣ",1,$link);
			}else{
				//echo "���������������ȡһ����¼";exit;
				if(intval($_CFG['subsite_id'])!="0")
				{
					$tid=$_CFG['subsite_id']?intval($_CFG['subsite_id']):1;
				}else{
					$tid=1;
				}
				//--------�ж��Ƿ��ȡ----ÿ��ֻ��һ��
				$gifts_sql="select id from ".table("members_gifts")." where  uid=".$_SESSION['uid'];
				$gifts=$db->getone($gifts_sql);
				if(!$gifts){
					//echo "û�л�ȡ";exit;
					//$gifts_g="";
					//echo "select * from ".table("gifts")." where be=0 and t_id=".$tid." order by rand() limit 1";exit;
					$getgifts=$db->getone("select * from ".table("gifts")." where be=0 and t_id=".$tid." order by rand() limit 1");
					//echo "<pre>";print_r($getgifts);exit;
					if($getgifts){
						$setsqlarr['uid']=$_SESSION['uid'];
						$setsqlarr['account']=$getgifts['account'];
						$setsqlarr['giftsname']='ְҵ����';
						$setsqlarr['giftstid']=$getgifts['t_id'];
						//--ʣ�������
						//$total_sql="select COUNT(*) from ".table("gifts")." where be=0 and t_id=".$tid." order by rand() limit 1";
						//$total_val=$db->get_total($total_sql);
						//$setsqlarr['giftsamount']=$total_val;
						//--
						$res=inserttable(table('members_gifts'),$setsqlarr,true);
						//--�Ƿ���ȡ
						//echo $res;exit;
						$upsql['be']=1;
						$upsql['useuid']=$_SESSION['uid'];
						$res_be=updatetable(table('gifts'),$upsql,$getgifts);
						//print_r($res_be);exit;
						//--
						if($res){
							showmsg("��ȡ�ɹ�",3,$link);
						}else{
						showmsg("��ȡʧ��",0,$link);	
						}
					}else{
						showmsg("�����ʺ��Ѿ�����ȡ���ˣ�",0,$link);
					}
				}else{///-------�Ѿ���ȡ
					showmsg("���Ѿ���ȡ���˺ţ������ٴλ�ȡ��",1,$link);	
				}
				echo $_CFG['subsite_id'];exit;
				
			}
		}
		
	}else{//----û�м���
		$link[0]['text'] = "��д����������Ϣ";
		$link[0]['href'] = 'personal_resume.php?act=make1';
		showmsg("�㻹û����д�����������ܻ�ȡ�˺ţ�",1,$link);
	}
	//echo $resume[0]['complete_percent'];echo "<pre>";print_r($resume);exit;
}
elseif($act =='ceping'){
	//echo "����";exit;
	if ($_SESSION['uid']=='' || $_SESSION['username']=='')//-----�ж��Ƿ��¼
	{
		$captcha=get_cache('captcha');
		$smarty->assign('verify_userlogin',$captcha['verify_userlogin']);
		$smarty->display('plus/ajax_login.htm');
		exit();
	}
	///-0--�ɹ�֮���޸�ʹ��ʱ��----gifts��
	$get_gifts=" useuid=".$_SESSION['uid'];
	$up['usettime']=time();
	$res_uptime=updatetable(table('gifts'),$up,$get_gifts);
	//-----����members_gifts��
	$members_gifts=" uid=".$_SESSION['uid'];
	$up_members['usetime']=time();
	$res_members=updatetable(table('members_gifts'),$up_members,$members_gifts);
	echo $res_members."<br>";echo $res_uptime;exit;
	//$smarty->display('member_personal/peixun.htm');
	
	
}
elseif($act =='ck_cep'){
	$smarty->display('member_personal/jobs_guide.htm');
}
//----------fffff---------����
elseif ($act=='gifts_apy')
{
	$account=trim($_POST['account'])?trim($_POST['account']):showmsg("����д���ţ�",1);
	$pwd=trim($_POST['pwd'])?trim($_POST['pwd']):showmsg("����д���룡",1);
	$captcha=get_cache('captcha');
	$postcaptcha = trim($_POST['postcaptcha']);
	if($captcha['verify_gifts']=='1' && empty($postcaptcha))
	{
		showmsg("����д��֤��",1);
 	}
	if ($captcha['verify_gifts']=='1' &&  strcasecmp($_SESSION['imageCaptcha_content'],$postcaptcha)!=0)
	{
		showmsg("��֤�����",1);
	}
	$info=$db->getone("select * from ".table('gifts')." where account='{$account}'  AND password='{$pwd}' LIMIT 1 ");
	if (empty($info))
	{
		showmsg("���Ż��������",0);
	}
	else
	{
		if ($info['usettime']>0)
		{
		showmsg("���ſ��ѱ�ʹ�ã������ظ�ʹ��",1);
		}
		else
		{
			$gifts_type=$db->getone("select * from ".table('gifts_type')." where t_id='{$info['t_id']}' LIMIT 1 ");
			if($gifts_type['t_endtime']!=0&&$gifts_type['t_endtime']<strtotime(date("Y-m-d"))){
				showmsg("���ſ��ѳ�����Ч�ڣ�����ʹ��",1);
			}
			if($gifts_type['t_effective']==0){
				showmsg("���ſ��ѱ�����Ա����Ϊ�����ã�����ϵ��վ����Ա",1);
			}
			if ($gifts_type['t_repeat']>0)
			{
				$total=$db->get_total("SELECT COUNT(*) AS num FROM ".table('members_gifts')." where uid='{$_SESSION['uid']}'");
				if ($total>=$gifts_type['t_repeat'])
				{
				showmsg("{$gifts_type['t_name']} ÿ����Ա������ʹ�� {$gifts_type['t_repeat']} �Ρ�",1);
				}
			}
			$db->query( "UPDATE ".table('gifts')." SET usettime = '".time()."',useuid= '{$_SESSION['uid']}'  where account='{$account}'");
			$setsqlarr['uid']=$_SESSION['uid'];
			$setsqlarr['usetime']=time();
			$setsqlarr['account']=$account;
			$setsqlarr['giftsname']=$gifts_type['t_name'];
			$setsqlarr['giftsamount']=$gifts_type['t_amount'];
			$setsqlarr['giftstid']=$gifts_type['t_id'];
			inserttable(table('members_gifts'),$setsqlarr);
			report_deal($_SESSION['uid'],1,$setsqlarr['giftsamount']);
			$user_points=get_user_points($_SESSION['uid']);
			$operator="+";
			write_memberslog($_SESSION['uid'],1,9001,$_SESSION['username'],"ʹ����Ʒ��({$account})��ֵ({$operator}{$setsqlarr['giftsamount']})��(ʣ��:{$user_points})",1,1021,"��Ʒ����ֵ","{$operator}{$setsqlarr['giftsamount']}","{$user_points}");
			showmsg("��ֵ�ɹ���",2);	
					
		}
	}
}
elseif ($act=='feedback_save')
{
	$get_feedback=get_feedback($_SESSION['uid']);
	if (count($get_feedback)>=5) 
	{
	showmsg('������Ϣ���ܳ���5����',1);
	exit();
	}
	$setsqlarr['infotype']=intval($_POST['infotype']);
	$setsqlarr['feedback']=trim($_POST['feedback'])?trim($_POST['feedback']):showmsg("����д���ݣ�",1);
	$setsqlarr['uid']=$_SESSION['uid'];
	$setsqlarr['usertype']=$_SESSION['utype'];
	$setsqlarr['username']=$_SESSION['username'];
	$setsqlarr['addtime']=$timestamp;
	write_memberslog($_SESSION['uid'],1,7001,$_SESSION['username'],"����˷�����Ϣ");
	!inserttable(table('feedback'),$setsqlarr)?showmsg("���ʧ�ܣ�",0):showmsg("��ӳɹ�����ȴ�����Ա�ظ���",2);
}
elseif ($act=='del_feedback')
{
	$id=intval($_GET['id']);
	del_feedback($id,$_SESSION['uid'])?showmsg('ɾ���ɹ���',2):showmsg('ɾ��ʧ�ܣ�',1);
}

unset($smarty);
?>