<?php
 /*
 * 74cms ְλ��ϸҳ
 * ============================================================================
 * ��Ȩ����: ��ʿ���磬����������Ȩ����
 * ��վ��ַ: http://www.74cms.com��
 * ----------------------------------------------------------------------------
 * �ⲻ��һ�������������ֻ���ڲ�������ҵĿ�ĵ�ǰ���¶Գ����������޸ĺ�
 * ʹ�ã�������Գ���������κ���ʽ�κ�Ŀ�ĵ��ٷ�����
 * ============================================================================
*/
define('IN_QISHI', true);
$alias="QS_hymq_jobsshow";
require_once(dirname(__FILE__).'/../include/common.inc.php');
if ($_PLUG['shenhe']['p_install']==1)
{
	$link[0]['text'] = "������ҳ";
	$link[0]['href'] = $_CFG['main_domain'];
	showmsg("����Ա�ѹرմ�ģ��!",1,$link);
}
if($mypage['caching']>0){
        $smarty->cache =true;
		$smarty->cache_lifetime=$mypage['caching'];
	}else{
		$smarty->cache = false;
	}
$cached_id=$_CFG['subsite_id']."|".$alias.(isset($_GET['id'])?"|".(intval($_GET['id'])%100).'|'.intval($_GET['id']):'').(isset($_GET['page'])?"|p".intval($_GET['page'])%100:'');
require_once(QISHI_ROOT_PATH.'include/mysql.class.php');
$db = new mysql($dbhost,$dbuser,$dbpass,$dbname);
unset($dbhost,$dbuser,$dbpass,$dbname);
// echo $mypage['tpl'];
$mypage['tpl']='../tpl_hymq/'.$mypage['tpl'];
$smarty->assign('user_tpl','../tpl_hymq/');
// echo $mypage['tpl'];exit;
$smarty->display($mypage['tpl'],$cached_id);
$db->close();
unset($smarty);
?>