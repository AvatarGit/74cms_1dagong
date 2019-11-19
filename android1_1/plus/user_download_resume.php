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
	$result['errormsg']=android_iconv_utf8("ֻ����ҵ��Ա�������ؼ�����");
	$jsonencode = json_encode($result);
	$jsonencode = urldecode(json_encode($result));
	exit($jsonencode);
}
$user=get_user_inid($_SESSION['uid']);
if ($user['status']=="2") 
{
		$result['result']=0;
		$result['errormsg']=android_iconv_utf8("�����˺Ŵ�����ͣ״̬��������Ϊ��������в�������");
		$jsonencode = json_encode($result);
		$jsonencode = urldecode(json_encode($result));
		exit($jsonencode);
}
$id=intval($aset['id']);
if(empty($id))
{
		$result['result']=0;
		$result['errormsg']=android_iconv_utf8("����id��ʧ��");
		$jsonencode = json_encode($result);
		$jsonencode = urldecode(json_encode($result));
		exit($jsonencode);
}
if (check_down_resumeid($id,$_SESSION['uid'])) 
{
		$result['result']=0;
		$result['errormsg']=android_iconv_utf8("���Ѿ����ع��˼����ˣ�");
		$jsonencode = json_encode($result);
		$jsonencode = urldecode(json_encode($result));
		exit($jsonencode);
}
elseif ($_CFG['down_resume_limit']=="1")
{
	$user_jobs=$db->getall( "select * from ".table('jobs')." WHERE uid='{$_SESSION['uid']}'");
	if (empty($user_jobs))
	{
		$result['result']=0;
		$result['errormsg']=android_iconv_utf8("��û�з���ְλ�����δͨ�������޷����ؼ�����");
		$jsonencode = json_encode($result);
		$jsonencode = urldecode(json_encode($result));
		exit($jsonencode);
	}
}
$resumeshow=get_resume_basic_id($id);
if ($resumeshow['display_name']=="2")
{
		$resumeshow['resume_name']="N".str_pad($resumeshow['id'],7,"0",STR_PAD_LEFT);	
}
elseif ($resumeshow['display_name']=="3")
{
$resumeshow['resume_name']=cut_str($resumeshow['fullname'],1,0,"**");
}
else
{
$resumeshow['resume_name']=$resumeshow['fullname'];
}
$setmeal=get_user_setmeal($_SESSION['uid']);
if ($_CFG['operation_mode']=="2")
{
			if ($_CFG['setmeal_to_points']=="1")
			{
				if (empty($setmeal) || ($setmeal['endtime']<time() && $setmeal['endtime']<>"0"))
				{
				$_CFG['operation_mode']="1";
				}
				elseif ($resumeshow['talent']=='2' && $setmeal['download_resume_senior']<=0)
				{
				$_CFG['operation_mode']="1";
				}
				elseif ($resumeshow['talent']=='1' && $setmeal['download_resume_ordinary']<=0)
				{
				$_CFG['operation_mode']="1";
				}
			}
			if ($_CFG['operation_mode']=="2")
			{
					if (empty($setmeal) || ($setmeal['endtime']<time() && $setmeal['endtime']<>"0"))
					{
						$result['result']=0;
						$result['errormsg']=android_iconv_utf8("���ķ����ѵ��ڣ�");
						$jsonencode = json_encode($result);
						$jsonencode = urldecode(json_encode($result));
						exit($jsonencode);
					}
					elseif ($resumeshow['talent']=='2' && $setmeal['download_resume_senior']<=0)
					{
						$result['result']=0;
						$result['errormsg']=android_iconv_utf8("�����ظ߼��˲ż��������Ѿ����������ƣ�");
						$jsonencode = json_encode($result);
						$jsonencode = urldecode(json_encode($result));
						exit($jsonencode);
					}
					elseif ($resumeshow['talent']=='1' && $setmeal['download_resume_ordinary']<=0)
					{
						$result['result']=0;
						$result['errormsg']=android_iconv_utf8("�����ؼ��������Ѿ����������ƣ�");
						$jsonencode = json_encode($result);
						$jsonencode = urldecode(json_encode($result));
						exit($jsonencode);
					}
			}		
}
if ($_GET['act']=="download")
{
	$ruser=get_user_inid($resumeshow['uid']);
	if($_CFG['operation_mode']=="1")
	{
				$points_rule=get_cache('points_rule');
				$points=$resumeshow['talent']=='2'?$points_rule['resume_download_advanced']['value']:$points_rule['resume_download']['value'];
				$mypoints=get_user_points($_SESSION['uid']);
				if  ($mypoints<$points)
				{
					if (!empty($setmeal) && $_CFG['setmeal_to_points']=="1")
					{
						$result['result']=0;
						$result['errormsg']=android_iconv_utf8("��ķ����ѵ��ڻ򳬳�����������");
						$jsonencode = json_encode($result);
						$jsonencode = urldecode(json_encode($result));
						exit($jsonencode);
					}
					else
					{
						$result['result']=0;
						$result['errormsg']=android_iconv_utf8("���".$_CFG['points_byname']."���㣬���ֵ������");
						$jsonencode = json_encode($result);
						$jsonencode = urldecode(json_encode($result));
						exit($jsonencode);
					}
				
				}
	}
	if ($_CFG['operation_mode']=="2")
	{	
			if ($resumeshow['talent']=='2')
			{
					if ($setmeal['download_resume_senior']>0 && add_down_resume($id,$_SESSION['uid'],$resumeshow['uid'],$resumeshow['resume_name']))
					{
						action_user_setmeal($_SESSION['uid'],"download_resume_senior");
						$setmeal=get_user_setmeal($_SESSION['uid']);
						write_memberslog($_SESSION['uid'],1,9002,$_SESSION['username'],"ͨ���ֻ��ͻ��������� {$ruser['username']} �����ĸ߼�����,���������� {$setmeal['download_resume_senior']} �ݸ߼�����");
						write_memberslog($_SESSION['uid'],1,4001,$_SESSION['username'],"ͨ���ֻ��ͻ��������� {$ruser['username']} �����ļ���");
						$result['result']=1;
						$result['errormsg']='';
						$result['txt']=android_iconv_utf8("���سɹ���");
						$jsonencode = json_encode($result);
						$jsonencode = urldecode(json_encode($result));
						exit($jsonencode);
					}
					else
					{
						$result['result']=0;
						$result['errormsg']=android_iconv_utf8("����ʧ�ܣ�");
						$jsonencode = json_encode($result);
						$jsonencode = urldecode(json_encode($result));
						exit($jsonencode);
					}
			}
			else
			{
					if ($setmeal['download_resume_ordinary']>0 && add_down_resume($id,$_SESSION['uid'],$resumeshow['uid'],$resumeshow['resume_name']))
					{		
					action_user_setmeal($_SESSION['uid'],"download_resume_ordinary");
					$setmeal=get_user_setmeal($_SESSION['uid']);
					write_memberslog($_SESSION['uid'],1,9002,$_SESSION['username'],"ͨ���ֻ��ͻ��������� {$ruser['username']} ��������ͨ����,���������� {$setmeal['download_resume_ordinary']} ����ͨ����");
					write_memberslog($_SESSION['uid'],1,4001,$_SESSION['username'],"ͨ���ֻ��ͻ��������� {$ruser['username']} �����ļ���");
						$result['result']=1;
						$result['errormsg']='';
						$result['txt']=android_iconv_utf8("���سɹ���");
						$jsonencode = json_encode($result);
						$jsonencode = urldecode(json_encode($result));
						exit($jsonencode);
					}
					else
					{
						$result['result']=0;
						$result['errormsg']=android_iconv_utf8("����ʧ�ܣ�");
						$jsonencode = json_encode($result);
						$jsonencode = urldecode(json_encode($result));
						exit($jsonencode);
					}
			}

	}
	elseif($_CFG['operation_mode']=="1")
	{
				$points_rule=get_cache('points_rule');
				$points=$resumeshow['talent']=='2'?$points_rule['resume_download_advanced']['value']:$points_rule['resume_download']['value'];
				$ptype=$resumeshow['talent']=='2'?$points_rule['resume_download_advanced']['type']:$points_rule['resume_download']['type'];
				$mypoints=get_user_points($_SESSION['uid']);
				if  ($mypoints<$points)
				{
						$result['result']=0;
						$result['errormsg']=android_iconv_utf8("���".$_CFG['points_byname']."���㣬���ֵ������");
						$jsonencode = json_encode($result);
						$jsonencode = urldecode(json_encode($result));
						exit($jsonencode);
				}
				if (add_down_resume($id,$_SESSION['uid'],$resumeshow['uid'],$resumeshow['resume_name']))
				{
					if ($points>0)
					{
					report_deal($_SESSION['uid'],$ptype,$points);
					$user_points=get_user_points($_SESSION['uid']);
					$operator=$ptype=="1"?"+":"-";
					write_memberslog($_SESSION['uid'],1,9001,$_SESSION['username'],"������ {$ruser['username']} �����ļ���({$operator}{$points}),(ʣ��:{$user_points})");
					write_memberslog($_SESSION['uid'],1,4001,$_SESSION['username'],"������ {$ruser['username']} �����ļ���");
					}
						$result['result']=1;
						$result['errormsg']='';
						$result['txt']=android_iconv_utf8("�����˼���{$_CFG['points_byname']}({$operator}{$points}),({$_CFG['points_byname']}ʣ��:{$user_points})");
						$jsonencode = json_encode($result);
						$jsonencode = urldecode(json_encode($result));
						exit($jsonencode);
				}
				else
				{
						$result['result']=0;
						$result['errormsg']=android_iconv_utf8("����ʧ�ܣ�");
						$jsonencode = json_encode($result);
						$jsonencode = urldecode(json_encode($result));
						exit($jsonencode);
				}
	}
}
?>