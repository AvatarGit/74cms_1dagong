<?php
 /*
 * 74cms ��Աע��
 * ============================================================================
 * ��Ȩ����: ��ʿ���磬����������Ȩ����
 * ��վ��ַ: http://www.74cms.com��
 * ----------------------------------------------------------------------------
 * �ⲻ��һ�������������ֻ���ڲ�������ҵĿ�ĵ�ǰ���¶Գ����������޸ĺ�
 * ʹ�ã�������Գ���������κ���ʽ�κ�Ŀ�ĵ��ٷ�����
 * ============================================================================
*/
define('IN_QISHI', true);
$alias="QS_login";
require_once(dirname(__FILE__).'/../include/common.inc.php');
require_once(QISHI_ROOT_PATH.'include/mysql.class.php');
require_once(QISHI_ROOT_PATH.'include/fun_user.php');
$db = new mysql($dbhost,$dbuser,$dbpass,$dbname);
unset($dbhost,$dbuser,$dbpass,$dbname);
$smarty->cache = false;
$act = !empty($_REQUEST['act']) ? trim($_REQUEST['act']) : 'reg';
if ($act=='reg')
{
	
	if ($_CFG['closereg']=='1')showmsg("��վ��ͣ��Աע�ᣬ���Ժ��ٴγ��ԣ�",1);
	if(intval($_GET['type'])==3 && $_PLUG['hunter']['p_install']==1){
		showmsg("����Ա�ѹر���ͷģ��,��ֹע�ᣡ",1);
	}
	if(intval($_GET['type'])==4 && $_PLUG['train']['p_install']==1){
		showmsg("����Ա�ѹر���ѵģ��,��ֹע�ᣡ",1);
	}
	//----fff----2015-7-28---��ѵ��Աע��
	if(intval($_GET['member_type'])==4){
		$smarty->assign('title','��Աע�� - '.$_CFG['site_name']);
		$captcha=get_cache('captcha');
		$smarty->assign('verify_userreg',$captcha['verify_userreg']);
		$smarty->display('user/reg_train.htm');
		exit;
	}
	//------ffff
	//-------���Ա��ͨע��ģʽ
	if(intval($_GET['type'])==5 && $_PLUG['shenhe']['p_install']==1){
		showmsg("����Ա�ѹر����Աģ��,��ֹע�ᣡ",1);
	}
	$smarty->assign('title','��Աע�� - '.$_CFG['site_name']);
	$captcha=get_cache('captcha');
	$smarty->assign('verify_userreg',$captcha['verify_userreg']);
	$smarty->display('user/reg.htm');
}
unset($smarty);
?>