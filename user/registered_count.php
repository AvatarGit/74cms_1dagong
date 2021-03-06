<?php
/**
 *2015-06-13   By   Zwl
 * 个人注册量/企业注册量统计页
 *
 */
define('IN_QISHI', true);
require_once(dirname(__FILE__).'/../include/common.inc.php');
require_once(QISHI_ROOT_PATH.'include/mysql.class.php');
$db = new mysql($dbhost,$dbuser,$dbpass,$dbname);
$stamp=strtotime('2015-01-01 00:00:00');
//按地区显示个人注册量
$per_address=array('%安徽%','%上海%','%重庆%','%江苏%','%湖北%','%河南%');
foreach($per_address as $v){
	$total_sql="SELECT COUNT(*) AS num FROM qs_members a left join qs_members_info b on a.uid=b.uid where b.residence_cn like '".$v."' and a.utype=2 and a.reg_time > ".$stamp;
	// echo $total_sql;
	$person_count[]=$db->get_total($total_sql);
}

//按地区显示企业注册量
$com_address=array('13','2','4','11','18','17');
foreach($com_address as $v){
	$total_sql="SELECT COUNT(*) AS num FROM qs_members a left join qs_company_profile b on a.uid=b.uid where a.utype=1 and a.reg_time > ".$stamp." and b.district =".$v;
  // echo $query;exit;
	$company_count[]=$db->get_total($total_sql);
}

//按地区显示个人创建的简历数量
$resume_address=array('13','2','4','11','18','17');
foreach($resume_address as $v){
  // $query="select a.aid from `#@__addjianli82` as a where a.nativeplace in (".$v2.") ;";
  // echo $query;exit;
  	$total_sql="SELECT COUNT(*) AS num FROM qs_resume where district =".$v." and addtime > ".$stamp;
	$resume_count[]=$db->get_total($total_sql);
}

//按地区显示发布的职位数量
$position_address=array('13','2','4','11','18','17');
foreach($position_address as $v){
  // $query="select a.aid from `#@__addgongzuo81` as a where a.nativeplace in (".$v3.") ;";
  // echo $query;exit;
  $total_sql="SELECT COUNT(*) AS num FROM qs_jobs where district =".$v." and addtime > ".$stamp;
  $position_count[]=$db->get_total($total_sql);
}

//按Member表的form字段来区分 已入职员工注册/通过1+2平台注册/通过微信注册
  /*$query=array();
  $query[0]="select a.mid from `#@__member` as a where a.form = 1 and a.mtype = '个人' and a.jointime > '".$stamp."';";
  $query[1]="select a.mid from `#@__member` as a where a.form = 2 and a.mtype = '个人' and a.jointime > '".$stamp."';";
  $query[2]="select a.mid from `#@__member` as a where a.form = 3 and a.mtype = '个人' and a.jointime > '".$stamp."';";
  // echo $query;exit;
  foreach($query as $v4){
    $query=$v4;
    $dsql->SetQuery($query);
    $dsql->Execute();
    $dsql->Query($query);
    $position_count_source[]= $dsql->GetTotalRow();
  }*/
echo '
<table border="6" width="800" align="center">
<caption>个人会员注册量（2015-01-01至今）</caption>
<tr align="center">
  <td>安徽</td>
  <td>上海</td>
  <td>重庆</td>
  <td>江苏</td>
  <td>湖北</td>
  <td>河南</td>
</tr>
<tr align="center" bgcolor="D3E1CE">
  <td>'.$person_count[0].'</td>
  <td>'.$person_count[1].'</td>
  <td>'.$person_count[2].'</td>
  <td>'.$person_count[3].'</td>
  <td>'.$person_count[4].'</td>
  <td>'.$person_count[5].'</td>
</tr>
</table><br/><br/><br/>
<table border="6" width="800" align="center">
<caption>企业会员注册量（2015-01-01至今）</caption>
<tr align="center">
  <td>安徽</td>
  <td>上海</td>
  <td>重庆</td>
  <td>江苏</td>
  <td>湖北</td>
  <td>河南</td>
</tr>
<tr align="center" bgcolor="D3E1CE">
  <td>'.$company_count[0].'</td>
  <td>'.$company_count[1].'</td>
  <td>'.$company_count[2].'</td>
  <td>'.$company_count[3].'</td>
  <td>'.$company_count[4].'</td>
  <td>'.$company_count[5].'</td>
</tr>
</table><br/><br/><br/>
<table border="6" width="800" align="center">
<caption>各地区个人简历发布量</caption>
<tr align="center">
  <td>安徽</td>
  <td>上海</td>
  <td>重庆</td>
  <td>江苏</td>
  <td>湖北</td>
  <td>河南</td>
</tr>
<tr align="center" bgcolor="D3E1CE">
  <td>'.$resume_count[0].'</td>
  <td>'.$resume_count[1].'</td>
  <td>'.$resume_count[2].'</td>
  <td>'.$resume_count[3].'</td>
  <td>'.$resume_count[4].'</td>
  <td>'.$resume_count[5].'</td>
</tr>
</table><br/><br/><br/>
<table border="6" width="800" align="center">
<caption>各地区公司职位发布量</caption>
<tr align="center">
  <td>安徽</td>
  <td>上海</td>
  <td>重庆</td>
  <td>江苏</td>
  <td>湖北</td>
  <td>河南</td>
</tr>
<tr align="center" bgcolor="D3E1CE">
  <td>'.$position_count[0].'</td>
  <td>'.$position_count[1].'</td>
  <td>'.$position_count[2].'</td>
  <td>'.$position_count[3].'</td>
  <td>'.$position_count[4].'</td>
  <td>'.$position_count[5].'</td>
</tr>
</table><br/><br/><br/>
<!--<table border="6" width="800" align="center">
<caption>个人会员注册量（2015-01-01至今）细分</caption>
<tr align="center">
  <td>已入职员工注册量</td>
  <td>通过1+2平台注册量</td>
  <td>通过微信注册量</td>
</tr>
<tr align="center" bgcolor="D3E1CE">
  <td>'.$position_count_source[0].'</td>
  <td>'.$position_count_source[1].'</td>
  <td>'.$position_count_source[2].'</td>
</tr>
</table>-->
<br/>
<form action="#" method="post">
	<input type="submit" value="刷新" style="display:block;margin:0 auto;" />
</form>
';
?>