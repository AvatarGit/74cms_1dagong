<?php
/**
 *2015-06-13   By   Zwl
 * ����ע����/��ҵע����ͳ��ҳ
 *
 */
// header("content-type:text/html;charset=utf-8");
define('IN_QISHI', true);
require_once(dirname(__FILE__).'/../include/common.inc.php');
require_once(QISHI_ROOT_PATH.'include/mysql.class.php');
$db = new mysql($dbhost,$dbuser,$dbpass,$dbname);
$stamp=strtotime('2015-01-01 00:00:00');
//��������ʾ����ע����
$per_address=array('%�Ϸ���%','%�ߺ���%','%������%','%������%','%��ɽ��%','%������%','%ͭ����%','%������%','%��ɽ��%'
,'%������%','%������%','%������%','%������%','%������%','%������%','%������%','%������%');
foreach($per_address as $v){
	$total_sql="SELECT COUNT(*) AS num FROM qs_members a left join qs_members_info b on a.uid=b.uid where b.residence_cn like '".$v."' and a.utype=2 and a.reg_time > ".$stamp;
	$person_count[]=$db->get_total($total_sql);
}

//��������ʾ��ҵע����
$com_address=array(224,225,226,227,228,229,230,231,232,233,234,235,236,237,238,240,239);
foreach($com_address as $v){
	$total_sql="SELECT COUNT(*) AS num FROM qs_members a left join qs_company_profile b on a.uid=b.uid where a.utype=1 and a.reg_time > ".$stamp." and b.sdistrict =".$v;
  // echo $query;exit;
	$company_count[]=$db->get_total($total_sql);
}

//��������ʾ���˴����ļ�������
$resume_address=array(224,225,226,227,228,229,230,231,232,233,234,235,236,237,238,240,239);
foreach($resume_address as $v){
  	$total_sql="SELECT COUNT(*) AS num FROM qs_resume where sdistrict =".$v." and addtime > ".$stamp;
	$resume_count[]=$db->get_total($total_sql);
}

//��������ʾ������ְλ����
$position_address=array(224,225,226,227,228,229,230,231,232,233,234,235,236,237,238,240,239);
foreach($position_address as $v3){
  $total_sql="SELECT COUNT(*) AS num FROM qs_jobs where sdistrict =".$v3." and addtime > ".$stamp;
  // echo '���ڵ��Գ���������������ϵ�����ܲ�������'.$total_sql;exit;
  $position_count[]=$db->get_total($total_sql);
}

//��Member���form�ֶ������� ����ְԱ��ע��/ͨ��1+2ƽ̨ע��/ͨ��΢��ע��
  // $query=array();
  // $query[0]="select a.mid from `#@__member` as a where a.form = 1 and a.mtype = '����' and a.jointime > '".$stamp."';";
  // $query[1]="select a.mid from `#@__member` as a where a.form = 2 and a.mtype = '����' and a.jointime > '".$stamp."';";
  // $query[2]="select a.mid from `#@__member` as a where a.form = 3 and a.mtype = '����' and a.jointime > '".$stamp."';";
  // echo $query;exit;
  // foreach($query as $v4){
    // $query=$v4;
    // $dsql->SetQuery($query);
    // $dsql->Execute();
    // $dsql->Query($query);
    // $position_count_source[]= $dsql->GetTotalRow();
  // }
echo '
<table border="6" width="1800" align="center">
<caption>���˻�Աע������2015-01-01����</caption>
<tr align="center">
  <td>�Ϸ���</td><td>�ߺ���</td><td>������</td><td>������</td><td>��ɽ��</td><td>������</td><td>ͭ����</td><td>������</td><td>��ɽ��</td>
<td>������</td><td>������</td><td>������</td><td>������</td><td>������</td><td>������</td><td>������</td><td>������</td>
</tr>
<tr align="center" bgcolor="D3E1CE">
  <td>'.$person_count[0].'</td>
  <td>'.$person_count[1].'</td>
  <td>'.$person_count[2].'</td>
  <td>'.$person_count[3].'</td>
  <td>'.$person_count[4].'</td>
  <td>'.$person_count[5].'</td>
  <td>'.$person_count[6].'</td>
  <td>'.$person_count[7].'</td>
  <td>'.$person_count[8].'</td>
  <td>'.$person_count[9].'</td>
  <td>'.$person_count[10].'</td>
  <td>'.$person_count[11].'</td>
  <td>'.$person_count[12].'</td>
  <td>'.$person_count[13].'</td>
  <td>'.$person_count[14].'</td>
  <td>'.$person_count[15].'</td>
  <td>'.$person_count[16].'</td>
</tr>
</table><br/><br/><br/>
<table border="6" width="1800" align="center">
<caption>��ҵ��Աע������2015-01-01����</caption>
<tr align="center">
  <td>�Ϸ���</td><td>�ߺ���</td><td>������</td><td>������</td><td>��ɽ��</td><td>������</td><td>ͭ����</td><td>������</td><td>��ɽ��</td>
<td>������</td><td>������</td><td>������</td><td>������</td><td>������</td><td>������</td><td>������</td><td>������</td>
</tr>
<tr align="center" bgcolor="D3E1CE">
  <td>'.$company_count[0].'</td>
  <td>'.$company_count[1].'</td>
  <td>'.$company_count[2].'</td>
  <td>'.$company_count[3].'</td>
  <td>'.$company_count[4].'</td>
  <td>'.$company_count[5].'</td>
  <td>'.$company_count[6].'</td>
  <td>'.$company_count[7].'</td>
  <td>'.$company_count[8].'</td>
  <td>'.$company_count[9].'</td>
  <td>'.$company_count[10].'</td>
  <td>'.$company_count[11].'</td>
  <td>'.$company_count[12].'</td>
  <td>'.$company_count[13].'</td>
  <td>'.$company_count[14].'</td>
  <td>'.$company_count[15].'</td>
  <td>'.$company_count[16].'</td>
</tr>
</table><br/><br/><br/>
<table border="6" width="1800" align="center">
<caption>���������˼���������</caption>
<tr align="center">
  <td>�Ϸ���</td><td>�ߺ���</td><td>������</td><td>������</td><td>��ɽ��</td><td>������</td><td>ͭ����</td><td>������</td><td>��ɽ��</td>
<td>������</td><td>������</td><td>������</td><td>������</td><td>������</td><td>������</td><td>������</td><td>������</td>
</tr>
<tr align="center" bgcolor="D3E1CE">
  <td>'.$resume_count[0].'</td>
  <td>'.$resume_count[1].'</td>
  <td>'.$resume_count[2].'</td>
  <td>'.$resume_count[3].'</td>
  <td>'.$resume_count[4].'</td>
  <td>'.$resume_count[5].'</td>
  <td>'.$resume_count[6].'</td>
  <td>'.$resume_count[7].'</td>
  <td>'.$resume_count[8].'</td>
  <td>'.$resume_count[9].'</td>
  <td>'.$resume_count[10].'</td>
  <td>'.$resume_count[11].'</td>
  <td>'.$resume_count[12].'</td>
  <td>'.$resume_count[13].'</td>
  <td>'.$resume_count[14].'</td>
  <td>'.$resume_count[15].'</td>
  <td>'.$resume_count[16].'</td>
</tr>
</table><br/><br/><br/>
<table border="6" width="1800" align="center">
<caption>��������˾ְλ������</caption>
<tr align="center">
  <td>�Ϸ���</td><td>�ߺ���</td><td>������</td><td>������</td><td>��ɽ��</td><td>������</td><td>ͭ����</td><td>������</td><td>��ɽ��</td>
<td>������</td><td>������</td><td>������</td><td>������</td><td>������</td><td>������</td><td>������</td><td>������</td>
</tr>
<tr align="center" bgcolor="D3E1CE">
  <td>'.$position_count[0].'</td>
  <td>'.$position_count[1].'</td>
  <td>'.$position_count[2].'</td>
  <td>'.$position_count[3].'</td>
  <td>'.$position_count[4].'</td>
  <td>'.$position_count[5].'</td>
  <td>'.$position_count[6].'</td>
  <td>'.$position_count[7].'</td>
  <td>'.$position_count[8].'</td>
  <td>'.$position_count[9].'</td>
  <td>'.$position_count[10].'</td>
  <td>'.$position_count[11].'</td>
  <td>'.$position_count[12].'</td>
  <td>'.$position_count[13].'</td>
  <td>'.$position_count[14].'</td>
  <td>'.$position_count[15].'</td>
  <td>'.$position_count[16].'</td>
</tr>
</table><br/><br/><br/>
<form action="/home/registered_count.php" method="post">
	<input type="submit" value="ˢ��" style="display:block;margin:0 auto;" />
</form>
';
?>