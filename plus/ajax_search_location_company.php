<?php
 /*
 * 74cms ajax ������ת
 * ============================================================================
 * ��Ȩ����: ��ʿ���磬����������Ȩ����
 * ��վ��ַ: http://www.74cms.com��
 * ----------------------------------------------------------------------------
 * �ⲻ��һ��������������ֻ���ڲ�������ҵĿ�ĵ�ǰ���¶Գ����������޸ĺ�
 * ʹ�ã��������Գ���������κ���ʽ�κ�Ŀ�ĵ��ٷ�����
 * ============================================================================
*/
 
define('IN_QISHI', true);
require_once(dirname(dirname(__FILE__)).'/include/plus.common.inc.php');
$act = !empty($_GET['act']) ? trim($_GET['act']) : 'qs_company_search';echo $act;exit;
if (strcasecmp(QISHI_DBCHARSET,"utf8")!=0)
{
$_GET['key']=utf8_to_gbk($_GET['key']);
}
unset($_GET['act']);
$_GET=array_map("rawurlencode",$_GET);
$url=url_rewrite($act,$_GET,true,intval($_CFG['subsite_id']));echo $url;exit;
unset($_GET);
exit($url);
?>