<?php
 /*
 * �鿴����
*/
define('IN_QISHI', true);
require_once(dirname(__FILE__).'/../include/common.inc.php');
$act = isset($_REQUEST['act']) ? trim($_REQUEST['act']) : 'app';
require_once(dirname(__FILE__).'/../include/mysql.class.php');
$db = new mysql($dbhost,$dbuser,$dbpass,$dbname);
$page=isset($_GET['page'])?intval($_GET['page']):"";

$key=isset($_GET['key'])?trim($_GET['key']):"";

$keysql=isset($_GET['key'])?" where name like '%".$key."%' or phone1 like '%".$key."%' or identity_id like '%".$key."%'":"";
$total_sql="select COUNT(*) as num  from ".table('baoming').$keysql." order by addtime,id desc";
//echo $total_sql;exit;
$total=mysql_query($total_sql);
$rows=array();
while($row = mysql_fetch_array($total)){
    		$rows[] = $row;
}
if (!empty($rows) && is_array($rows))
		{			
			foreach($rows as $n)
			{
			$v=$v+$n['num'];
			}			
		}
$total_val=$v;
//echo $total_val;exit;
if(!$page) $page = 1;
if(!$pagesize) $pagesize = 30;
$maxpage = ceil($total_val / $pagesize);
if($maxpage>0)
{
	if($page > $maxpage) $page = $maxpage;
}
$offset = ($page - 1) * $pagesize;
?>
<script>
function shenhe(id,status){
	if(status == 1){var a="ͨ��";}else if(status == 2){var a="��ͨ��";}
	  if(window.confirm('��ȷ���������'+a+'?')) location.href="?id="+id+"&act=shenhe&status="+status;
  }
</script>
<div align="center">
<table width="80%" border="1" cellspacing="1" style="border-collapse: collapse" bordercolorlight="#000000" bordercolordark="#000000">
  <tr>
    <td colspan="20" align="center" valign="middle">������ϸ</td>
    </tr>
  <tr>
 <td align="center" valign="middle">���</td>
    <td align="center" valign="middle">����</td>
    <td align="center" valign="middle">���֤��</td>
    <td align="center" valign="middle">��ϵ�绰1</td>
   <!-- <td align="center" valign="middle">������ò</td>
    <td align="center" valign="middle">�뵳(��)ʱ��</td>
    <td align="center" valign="middle">�������ڵ�</td>
    <td align="center" valign="middle">�������ڵ�</td>  
    <td align="center" valign="middle">ѧ��</td>  
    <td align="center" valign="middle">ѧ������</td>
    <td align="center" valign="middle">��ҵԺУ</td>
    <td align="center" valign="middle">��ѧרҵ</td>
    <td align="center" valign="middle">��ҵʱ��</td>
    <td align="center" valign="middle">����רҵ</td> -->
    <td align="center" valign="middle">����ְλ</td>
    <td align="center" valign="middle">֤����</td>
    <td align="center" valign="middle">����ʱ��</td>
    <td align="center" valign="middle">����</td>
  </tr><?php
$limit=" limit ".$offset.",".$pagesize;
$exec="select * from qs_baoming ".$keysql." order by id desc".$limit;
$result=mysql_query($exec);
while($rs=mysql_fetch_object($result))
{
echo"<tr>";
 echo" <td align=\"center\" valign=\"middle\">".$rs->id."</td>";//exam_num
   echo" <td align=\"center\" valign=\"middle\"><a href=\"display.php?id={$rs->id}\" target=\"_blank\">".$rs->name."</a></td>";
    echo" <td align=\"center\" valign=\"middle\">".$rs->identity_id."</td>";
  echo"  <td align=\"center\" valign=\"middle\">".$rs->phone1."</td>";
   //echo" <td align=\"center\" valign=\"middle\">".$rs->politics."</td>";
  // echo" <td align=\"center\" valign=\"middle\">".$rs->join_time."</td>";
   // echo" <td align=\"center\" valign=\"middle\">".$rs->address."</td>";
 // echo"  <td align=\"center\" valign=\"middle\">".$rs->profile_add."</td>";
  // echo" <td align=\"center\" valign=\"middle\">".$rs->education."</td>";
     //echo" <td align=\"center\" valign=\"middle\">".$rs->edu_sta."</td>";
   //echo" <td align=\"center\" valign=\"middle\">".$rs->graduate_school."</td>";
   // echo" <td align=\"center\" valign=\"middle\">".$rs->specialty."</td>";
  //echo"  <td align=\"center\" valign=\"middle\">".$rs->graduate_time."</td>";
  //echo"  <td align=\"center\" valign=\"middle\">".$rs->baokao_specialty."</td>";
   echo"  <td align=\"center\" valign=\"middle\">".$rs->baokao_job."</td>";
 echo"  <td align=\"center\" valign=\"middle\"><a href=\"/kaoshi/".$rs->identity_up."\" target=_blank>�鿴</a>
 </td>";
  echo"  <td align=\"center\" valign=\"middle\">".$rs->addtime."</td>";
  if($rs->status == 1){echo"  <td align=\"center\" valign=\"middle\"><font style=\"color:green\">��ͨ��</font></td>";}elseif($rs->status == 0){echo"  <td align=\"center\" valign=\"middle\"><a href=\"javascript:shenhe({$rs->id},1);\">���ͨ��</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"javascript:shenhe({$rs->id},2);\">��˲�ͨ��</a></td>";}elseif($rs->status == 2){echo"  <td align=\"center\" valign=\"middle\"><font style=\"color:red\">δͨ��</font></td>";}
 echo" </tr>";
 }
 ?>
 <tr>
    <td colspan="19" align="center" valign="middle"><form method="get" action="?" name="form1" style="float:right"><input type="text" name="key" id="key" value=""/><input type="submit"  value="����"></form><a href="?page=1&key=<?php echo $key;?>">��ҳ</a>  <a href="?page=<?php  if(($page-1) >0){echo $page-1; }else{echo 1;}?>&key=<?php echo $key;?>">��һҳ</a>  <a href="?page=<?php  if(($page+1)>$maxpage){echo $maxpage;}else{echo $page+1;}?>&key=<?php echo $key;?>">��һҳ</a>  <a href="?page=<?php echo $maxpage?>&key=<?php echo $key;?>">βҳ</a> <a href="?">���������¼</a></td>
    </tr>
</table>

</div>
<?php
if($act == 'shenhe'){
	$id=trim($_REQUEST['id']);
	$status=intval(trim($_REQUEST['status']));
	$qsl_id=" update qs_baoming set status = ".$status." where id =".$id;
	if($db->query($qsl_id))
	{
		echo "<script language=\"JavaScript\">\r\n";   echo " alert(\"��˳ɹ�\");\r\n";   echo " history.back();\r\n";   echo "</script>";
	}else{
		echo "<script language=\"JavaScript\">\r\n";   echo " alert(\"���ʧ��\");\r\n";   echo " history.back();\r\n";   echo "</script>";
		}
	
	}
?>