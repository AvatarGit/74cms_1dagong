<?php
 /*
 * 74cms ����������ҳ
 * ============================================================================
 * ��Ȩ����: ��ʿ���磬����������Ȩ����
 * ��վ��ַ: http://www.74cms.com��
 * ----------------------------------------------------------------------------
 * �ⲻ��һ�������������ֻ���ڲ�������ҵĿ�ĵ�ǰ���¶Գ����������޸ĺ�
 * ʹ�ã�������Գ���������κ���ʽ�κ�Ŀ�ĵ��ٷ�����
 * ============================================================================
*/
define('IN_QISHI', true);
require_once(dirname(__FILE__).'/../data/config.php');
require_once(dirname(__FILE__).'/include/admin_common.inc.php');
require_once(ADMIN_ROOT_PATH.'include/admin_flash_statement_fun.php');
$act=!empty($_REQUEST['act']) ? trim($_REQUEST['act']) : '';
$smarty->assign('admin_plug_hunter',$_PLUG["hunter"]['p_install']);
$smarty->assign('admin_plug_train',$_PLUG["train"]['p_install']);
$smarty->assign('admin_plug_simple',$_PLUG["simple"]['p_install']);
$smarty->assign('admin_plug_jobfair',$_PLUG["jobfair"]['p_install']);
if($act=='')
{
	$smarty->display('ch/admin_index.htm');
}
elseif($act=='top')
{
	$admininfo=get_admin_one($_SESSION['admin_name']);
	$smarty->assign('admin_rank', $admininfo['rank']);
	$smarty->assign('admin_name', $_SESSION['admin_name']);
	$smarty->display('ch/admin_top.htm');
}
elseif($act=='left')
{
	$smarty->display('ch/admin_left.htm');
}
elseif($act == 'main')
{
	
	$smarty->display('ch/admin_main.htm');
}
?>