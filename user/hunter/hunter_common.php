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
if(!defined('IN_QISHI')) die('Access Denied!');
$page_select="user";
require_once(dirname(dirname(dirname(__FILE__))).'/include/common.inc.php');
if ($_PLUG['hunter']['p_install']==1)
{
showmsg('����Ա�ѹرո�ģ�飡',1);
}
require_once(QISHI_ROOT_PATH.'include/mysql.class.php');
require_once(QISHI_ROOT_PATH.'include/fun_hunter.php');
	$db = new mysql($dbhost,$dbuser,$dbpass,$dbname);
	if ($_SESSION['uid']=='' || $_SESSION['username']=='' || intval($_SESSION['uid'])===0)
	{
		header("Location: ".url_rewrite('QS_login')."?act=logout");
		exit();
	}
	elseif ($_SESSION['utype']!='3') 
	{
	$link[0]['text'] = "��Ա����";
	$link[0]['href'] = url_rewrite('QS_login');
	showmsg('�����ʵ�ҳ����Ҫ ��ͷ��Ա ��¼��',1,$link);
	}
	$act = !empty($_GET['act']) ? trim($_GET['act']) : 'index';
	$smarty->cache = false;
	$user=get_user_info($_SESSION['uid']);
	if ($user['status']=="2" && $act!='index' && $act!='user_status'  && $act!='user_status_save') 
	{
		$link[0]['text'] = "���ػ�Ա������ҳ";
		$link[0]['href'] = 'hunter_index.php?act=';
	exit(showmsg('�����˺Ŵ�����ͣ״̬������ϵ����Ա��Ϊ��������в�����',1,$link));	
	}
	elseif (empty($user))
	{
	unset($_SESSION['utype'],$_SESSION['uid'],$_SESSION['username']);
	header("Location:".url_rewrite('QS_login')."?url=".$_SERVER["REQUEST_URI"]);
	exit();
	}
	if ($_CFG['login_hunter_audit_email'] && $user['email_audit']=="0" && $act!='authenticate' && $act!='user_email' && $act!='user_mobile')
	{
		$link[0]['text'] = "��֤����";
		$link[0]['href'] = 'hunter_user.php?act=authenticate';
		$link[1]['text'] = "��վ��ҳ";
		$link[1]['href'] = $_CFG['main_domain'];
		showmsg('��������δ��֤����֤����ܽ�������������',1,$link,true,6);
		exit();
	}
	$sms=get_cache('sms_config');
	if ($_CFG['login_hunter_audit_mobile'] && $user['mobile_audit']=="0" && $act!='authenticate' && $act!='user_mobile' && $act!='user_email' && $sms['open']=="1")
	{
		$link[0]['text'] = "��֤�ֻ�";
		$link[0]['href'] = 'hunter_user.php?act=authenticate';
		$link[1]['text'] = "��վ��ҳ";
		$link[1]['href'] = $_CFG['main_domain'];
		showmsg('�����ֻ�δ��֤����֤����ܽ�������������',1,$link,true,6);
		exit();
	}
	$smarty->assign('sms',$sms);
	$hunter_profile=get_hunter($_SESSION['uid']);
	if (!empty($hunter_profile))
	{
		$hunter_profile = array_map("addslashes",$hunter_profile);
		$smarty->assign('hunter_url',url_rewrite('QS_huntershow',array('id'=>$hunter_profile['id'])));
	}	
	$smarty->assign('userindexurl','hunter_index.php');
	if ($_SESSION['handsel_userlogin'])
	{
	//��һ�ε�¼��ʾ
	$smarty->assign('handsel_userlogin',$_SESSION['handsel_userlogin']);
	unset($_SESSION['handsel_userlogin']);
	}
?>