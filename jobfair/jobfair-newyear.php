<?php
 /*
 * 74cms ��Ƹ��
 * ============================================================================
 * ��Ȩ����: ��ʿ���磬����������Ȩ����
 * ��վ��ַ: http://www.74cms.com��
 * ----------------------------------------------------------------------------
 * �ⲻ��һ�������������ֻ���ڲ�������ҵĿ�ĵ�ǰ���¶Գ����������޸ĺ�
 * ʹ�ã�������Գ���������κ���ʽ�κ�Ŀ�ĵ��ٷ�����
 * ============================================================================
*/
define('IN_QISHI', true);

require_once(dirname(dirname(__FILE__)).'/include/common.inc.php');

require_once(QISHI_ROOT_PATH.'include/mysql.class.php');
$db = new mysql($dbhost,$dbuser,$dbpass,$dbname);


$t1=strtotime("2014-2-1");
$t2=strtotime("2014-2-28");

$sql="SELECT * FROM qs_jobfair WHERE holddates >= '".$t1."' AND holddates <= '".$t2."' and subsite_id='1' ORDER BY `holddates` asc";

$data=$db->getall($sql);

foreach ($data as $k => $v) {
		//----------------------------------------------------------
		/*��Ԥ��*/
		$yyd="select count(*) as yiyuding from vip_zhanhui where zid='".$v['id']."'";
		$yyd=$db->getone($yyd);		//��Ԥ������չλ
		$data[$k]['yiyuding']=$yyd['yiyuding'];
		/*δԤ��*/
		$wyd="select count(*) as weiyuding from vip_zw where number not in(select number from vip_zhanhui where zid=".$v['id'].") and subsite_id='".intval($_CFG['subsite_id'])."'";
		$wyd=$db->getone($wyd);		//û��Ԥ����չλ
		$data[$k]['weiyuding']=$wyd['weiyuding'];
		//----------------------------------------------------------
		if(date("Y-m-d",$data[$k]['holddates']) > date("Y-m-d",$time)){
			$data[$k]['predetermined_ok']=1;
		}else{
			$data[$k]['predetermined_ok']=0;
		}
}

//print_r($data);

$smarty->assign("jobfair",$data);

$smarty->display('./../templates/1jobscnthf/jobfair-newyear.htm');

unset($smarty);
?>