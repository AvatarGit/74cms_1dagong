<?php
 /*
 * �鿴����
*/
define('IN_QISHI', true);
require_once(dirname(__FILE__).'/../../include/common.inc.php');
$act = isset($_REQUEST['act']) ? trim($_REQUEST['act']) : 'app';
require_once(dirname(__FILE__).'/../../include/mysql.class.php');
$db = new mysql($dbhost,$dbuser,$dbpass,$dbname);
?>
<div align="center">
<table width="80%" border="1" cellspacing="1" style="border-collapse: collapse" bordercolorlight="#000000" bordercolordark="#000000">
  <tr>
    <td colspan="19" align="center" valign="middle">��ҵ����鿴��ϵ��ʽ��ϸ</td>
    </tr>
  <tr>
 <td align="center" valign="middle">���</td>
    <td align="center" valign="middle">��˾����</td>
    <td align="center" valign="middle">��������</td>
    <td align="center" valign="middle">�Ƿ�ͨ��</td>
    <td align="center" valign="middle">��������</td>
  </tr><?php
$exec="select a.*,c.companyname,r.fullname from ".table('company_apply_ck')." as a left join ".table('company_profile')." as c on a.company_uid=c.uid left join ".table('resume')." as r on a.resume_id=r.id  order by a.interview_addtime desc";
$result=mysql_query($exec);
while($rs=mysql_fetch_object($result))
{
echo"<tr>";
 echo" <td align=\"center\" valign=\"middle\">".$rs->did."</td>";
   echo" <td align=\"center\" valign=\"middle\">".$rs->companyname."</td>";
   if(empty($rs->fullname)){echo" <td align=\"center\" valign=\"middle\"><font style=\"color:#f00;\">�ü������ܱ�ɾ����</font></td>";}else{echo" <td align=\"center\" valign=\"middle\">".$rs->fullname."</td>";}
    if($rs->company_apply == 1){echo" <td align=\"center\" valign=\"middle\"><font style=\"color:green; font-weight:200px;\">ͨ��</font></td>";}else{echo" <td align=\"center\" valign=\"middle\"><font style=\"color:#f00;font-weight:200px;\">δͨ��</font></td>";}
     echo" <td align=\"center\" valign=\"middle\">".date('Y-m-d H:i:s',$rs->interview_addtime)."</td>";
 /*echo"  <td align=\"center\" valign=\"middle\"><a href=\"http://www.1jobs.cn/ycnjl/".$rs->wdurl."\" target=_blank>���ؼ���</a></br> 
 <a href=\"http://www.1jobs.cn/ycnjl/".$rs->url."\" target=_blank>����ͼƬ</a>
 </td>";
  echo"  <td align=\"center\" valign=\"middle\">".$rs->time."</td>";*/
 echo" </tr>";
 }
 ?>
</table></div>