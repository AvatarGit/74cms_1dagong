<?php
 /*
 * 74cms ajax ���ع�˾ְλ����
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
$act = !empty($_POST['act']) ? trim($_POST['act']) :trim($_GET['act']);
if ($act=='get_companyjobslist')
{
	$comjobshtml="";
	$rows=2;
	$companyid=intval($_GET['company_id']); 
	$comjobsarray=$db->getall("select * from ".table('jobs')." where company_id = '{$companyid}' ORDER BY stick DESC , refreshtime DESC LIMIT {$rows}");
	if (!empty($comjobsarray))
	{
		foreach($comjobsarray as $li)
		{
			$jobs_url=url_rewrite("QS_jobsshow",array('id'=>$li['id']),true,$li['subsite_id']);
			$jobs_name=cut_str($li['jobs_name'],"10",0,"..");
			$comjobshtml.="<li><div class=\"j_name\"><a href=\"{$jobs_url}\" target=\"_blank\">{$jobs_name}</a><span class=\"ji\"></span><span class=\"j_time\">".date('Y-m-d',$li['addtime'])."����</span></div><p><span>ѧ��Ҫ��{$li['education_cn']}</span>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<span>�������飺{$li['experience_cn']}</span>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<span>�����ص㣺{$li['district_cn']}</span>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<span>н�ʴ�����<em>{$li['wage_cn']}</em></span></p></li>";
		}
		$jobslist_url = url_rewrite("QS_companyjobs",array("id"=>$companyid));
		$comjobshtml.="<p class=\"more\"><a target=\"_blank\" href=\"".$jobslist_url."\">�鿴����>></a></p>";
		exit($comjobshtml);
	}
	else
	{
		exit('empty!');
	}
}
elseif ($act=='get_companycommentlist')
{
	$comcommenthtml="";
	$rows=2;
	$companyid=intval($_GET['company_id']); 
	$comcommentarray=$db->getall("select  c.*,m.username from ".table('comment')." as c LEFT JOIN  ".table('members')." AS m ON c.uid=m.uid where company_id = '{$companyid}' and audit=1 ORDER BY c.id DESC LIMIT {$rows}");
	if (!empty($comcommentarray))
	{
		foreach($comcommentarray as $li)
		{
			$comcommenthtml.="<li><div class=\"avatar\"><img src=\"{$_CFG['main_domain']}data/images/avatar.gif\" width=\"65\" height=\"65\" /></div><div class=\"comm_content\"><div class=\"comm_top\"><p class=\"name\">{$li['username']}</p><p class=\"date\">".date('Y-m-d H:i',$li['addtime'])."</p><div class=\"clear\"></div></div><div class=\"comm_txt\">";
			$comcommenthtml.="<p>{$li['content']}</p>";
			$comcommenthtml.="</div></div><div class=\"clear\"></div></li>";
		}
		$commentlist_url = url_rewrite("QS_companycomment",array("id"=>$companyid));
		$comcommenthtml.="<p class=\"more\"><a target=\"_blank\" href=\"".$commentlist_url."\">�鿴����>></a></p>";
		exit($comcommenthtml);
	}
	else
	{
		exit('empty!');
	}
}
?>