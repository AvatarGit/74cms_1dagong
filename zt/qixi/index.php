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
require_once(dirname(__FILE__).'/../../include/common.inc.php');
require_once(QISHI_ROOT_PATH.'include/mysql.class.php');
require_once(QISHI_ROOT_PATH.'include/fun_user.php');
$db = new mysql($dbhost,$dbuser,$dbpass,$dbname);
unset($dbhost,$dbuser,$dbpass,$dbname);
$smarty->cache = false;
$act = !empty($_REQUEST['act']) ? trim($_REQUEST['act']) : 'qixi';
if ($act=='qixi')
{
	//echo "1212";exit;
	if(empty($_GET['id']))
	{
		$arr[0]='�����𴲵�һ����������㣬����˯ǰ��������Ҳ���㣬ϣ��ֻҪ���۾������ĵط������㡣';
		$arr[1]='��δ�����ٺ��£���Ϊ������ҵķ��򣻶����Ѳ��ٿ־壬��Ϊ���ܳ�Ϊ�ҵ�������';
		$arr[2]='������һ������������鶼��������õĻ��䣬����������һ����������һ��������˵Ҳ�������á�';
		$arr[3]='Ҫ������һ��Сβ�ͣ��������ʱ��һ�����̲�סҡ�ڣ������ҿ��������˵�ģ����';
		$arr[4]='������������㣬�����ε������㣬���������Ҫ���Ҹ���';
		$arr[5]='������ǣ�֣���������ͷ��һ��̫�̣������Һú�ӵ���㡣Ը�������Ӣ�ۣ��ǻ��㣬�þ���һ���ӵ����ᡣ';
		$arr[6]='��л���������㣬��ˮǧɽ��ϣ�������ܹ�һ���߹���';
		$arr[7]='�����ڵĵط����ͻ����ҵ��������������ҽ��������Ҹ���';
		$arr[8]='�������ʶ��������˹顣˼������ˮ����������ʱ��';
		$arr[9]='������Ժ�����������ҹ�����һ�����Ͳ�һ���¸ҵĸ�ס�';
		$randid=array_rand($arr);
		$smarty->assign('contents',$arr[$randid]);
		
		$bgid=rand(1,9);
		$bg='/files/qixi/images/'.$bgid.'.jpg';
		$smarty->assign('bg',$bg);
		
		///------
		$time=date('Y-m-d',time());
		$smarty->assign('time',$time);
	}
	else
	{
		$id=intval($_GET['id']);
		$sql = "select * from zt_qx where id = ".$id." LIMIT 1";
		$val=$db->getone($sql);
		$smarty->assign('time',date('Y-m-d',$val['addtime']));
		$smarty->assign('to',$val['to']);
		$smarty->assign('from',$val['from']);
		$smarty->assign('bg',$val['bg']);
		$smarty->assign('contents',$val['contents']);
	}
	$smarty->display('zt/qixi.htm');
}
elseif($act == 'chakan')
{
	$id=intval($_GET['id']);
	$sql = "select * from zt_qx where id = ".$id." LIMIT 1";
	$val=$db->getone($sql);
	$smarty->assign('time',date('Y-m-d',$val['addtime']));
	$smarty->assign('to',$val['to']);
	$smarty->assign('from',$val['from']);
	$smarty->assign('bg',$val['bg']);
	$smarty->assign('contents',$val['contents']);
	$smarty->display('zt/qixi.htm');
}
unset($smarty);
?>