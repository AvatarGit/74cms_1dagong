<?php
 /*
 * 74cms ��վ��ҳ
 * ============================================================================
 * ��Ȩ����: ��ʿ���磬����������Ȩ����
 * ��վ��ַ: http://www.74cms.com��
 * ----------------------------------------------------------------------------
 * �ⲻ��һ�������������ֻ���ڲ�������ҵĿ�ĵ�ǰ���¶Գ����������޸ĺ�
 * ʹ�ã�������Գ���������κ���ʽ�κ�Ŀ�ĵ��ٷ�����
 * ============================================================================
*/
if(!file_exists(dirname(__FILE__).'/data/install.lock')) header("Location:install/index.php");
define('IN_QISHI', true);
$alias="QS_index";
require_once(dirname(__FILE__).'/include/common.inc.php');
//if(browser()=="mobile" && $_GET['iswap']==""){
//	header("location:".$_CFG['wap_domain']);
//}
if($mypage['caching']>0){
        $smarty->cache =true;
		$smarty->cache_lifetime=$mypage['caching'];
	}else{
		$smarty->cache = false;
	}
$cached_id=$_CFG['subsite_id']."|".$alias.(isset($_GET['id'])?"|".(intval($_GET['id'])%100).'|'.intval($_GET['id']):'').(isset($_GET['page'])?"|p".intval($_GET['page'])%100:'');
if(!$smarty->is_cached($mypage['tpl'],$cached_id))
{
require_once(QISHI_ROOT_PATH.'include/mysql.class.php');
$db = new mysql($dbhost,$dbuser,$dbpass,$dbname);
//��ҳ�ϡ���������ְλ�� ��ʼ By Z
$time_h=date("H",time());
$time_m=date("i",time());
$time_s=date("s",time());
$time_w=date("w",time());
$time_currentday=$time_h*3600+$time_m*60+$time_s;
$time_oneday=3600*24;

if($time_w==0){
	$timestamp_start=time()-$time_oneday*6-$time_currentday;
	// $timestamp_end=time();
}else{
	$timestamp_start=time()-$time_oneday*($time_w-1)-$time_currentday;
	// $timestamp_end=time();
}
$time_sql="select id from qs_jobs where addtime > $timestamp_start";
// echo $time_sql;exit;
$time_result=mysql_num_rows($db->query($time_sql));
// echo $time_result;exit;
$t=strlen($time_result);///---���㼸λ

$smarty->assign('time_display',$time_result);
//��ҳ�ϡ���������ְλ�� ���� By Z
unset($dbhost,$dbuser,$dbpass,$dbname);
$smarty->display($mypage['tpl'],$cached_id);
}
else
{
$smarty->display($mypage['tpl'],$cached_id);
}
unset($smarty);
?>