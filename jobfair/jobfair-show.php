<?php
 /*
 * 74cms ��Ѷ��ϸҳ��
 * ============================================================================
 * ��Ȩ����: ��ʿ���磬����������Ȩ����
 * ��վ��ַ: http://www.74cms.com��
 * ----------------------------------------------------------------------------
 * �ⲻ��һ�������������ֻ���ڲ�������ҵĿ�ĵ�ǰ���¶Գ����������޸ĺ�
 * ʹ�ã�������Գ���������κ���ʽ�κ�Ŀ�ĵ��ٷ�����
 * ============================================================================
*/
define('IN_QISHI', true);
$alias="QS_jobfairshow";
require_once(dirname(dirname(__FILE__)).'/include/common.inc.php');
if($mypage['caching']>0){
        $smarty->cache =true;
		$smarty->cache_lifetime=$mypage['caching'];
	}else{
		$smarty->cache = false;
	}
$cached_id=$_CFG['subsite_id']."|".$alias.(isset($_GET['id'])?"|".(intval($_GET['id'])%100).'|'.intval($_GET['id']):'').(isset($_GET['page'])?"|p".intval($_GET['page'])%100:'');
if(!empty($_GET['dqid'])){
	$dqid=$_GET['dqid'];
}else{
	$dqid=intval($_CFG['subsite_id']);
}

if(!$smarty->is_cached($mypage['tpl'],$cached_id))
{
	//------------------------���ݿ�ִ���ļ�--------------ע���ҵ�ִ����ʾ��php�ļ�include/template_lite/plugins/function.qishi_jobfair_show.php
require_once(QISHI_ROOT_PATH.'include/mysql.class.php');
$db = new mysql($dbhost,$dbuser,$dbpass,$dbname);

/*-�ֵ�����ʾģ��-------------------------*/
switch ($dqid){
	case 1:			//�Ϸ�
		
		$smarty->display("jobfair-show_hefei.htm",$cached_id);
		//echo $cached_id;exit;
		break;
	case 5:			//�Ϻ�
		$smarty->display("jobfair-show_shanghai.htm",$cached_id);
		break;
	case 8:			//����
		$smarty->display("jobfair-show_suzhou.htm",$cached_id);
		break;
	case 9:			//�Ϸʽ�կ
		$smarty->display("jobfair-show_jinzhai.htm",$cached_id);
		break;
	default:		//�Ҳ�������ʾ��վ
		$smarty->display("jobfair-show.htm",$cached_id);
		break;
}			
/*-------------------------------*/
//$smarty->display($mypage['tpl'],$cached_id);
$db->close();
}
else
{
/*-�ֵ�����ʾģ��-------------------------*/
switch ($dqid){
	case 1:			//�Ϸ�
		$smarty->display("jobfair-show_hefei.htm",$cached_id);
		break;
	case 5:			//�Ϻ�
		$smarty->display("jobfair-show_shanghai.htm",$cached_id);
		break;
	case 8:			//����
		$smarty->display("jobfair-show_suzhou.htm",$cached_id);
		break;
	case 9:			//�Ϸʽ�կ
		$smarty->display("jobfair-show_jinzhai.htm",$cached_id);
		break;
	default:		//�Ҳ�������ʾ��վ
		$smarty->display("jobfair-show.htm",$cached_id);
		break;
}			
/*-------------------------------*/
//$smarty->display($mypage['tpl'],$cached_id);
}
unset($smarty);
?>