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
    <td colspan="19" align="center" valign="middle">��������Ա��ϸ</td>
    </tr>
  <tr>
 <td align="center" valign="middle">���</td>
    <td align="center" valign="middle">��������</td>
    <td align="center" valign="middle">����</td>
    <td align="center" valign="middle">����</td>
    <td align="center" valign="middle">�ֻ���</td>
    <td align="center" valign="middle">��������</td>
    <td align="center" valign="middle">����ʱ��</td>
  </tr><?php
$exec="select y.*,t.typename from zt_tiyanyuan as y left join zt_tiyan_type as t on y.typeid=t.id order by y.addtime desc ";
$result=mysql_query($exec);
while($rs=mysql_fetch_object($result))
{
echo"<tr>";
 echo" <td align=\"center\" valign=\"middle\">".$rs->id."</td>";
   echo" <td align=\"center\" valign=\"middle\">".$rs->typename."</td>";
   echo" <td align=\"center\" valign=\"middle\">".$rs->name."</td>";
    echo" <td align=\"center\" valign=\"middle\">".$rs->age."</td>";
  echo"  <td align=\"center\" valign=\"middle\">".$rs->phone."</td>";
  echo" <td align=\"center\" valign=\"middle\">".$rs->work."</td>";
     echo" <td align=\"center\" valign=\"middle\">".date('Y-m-d H:i:s',$rs->addtime)."</td>";
 /*echo"  <td align=\"center\" valign=\"middle\"><a href=\"http://www.1jobs.cn/ycnjl/".$rs->wdurl."\" target=_blank>���ؼ���</a></br> 
 <a href=\"http://www.1jobs.cn/ycnjl/".$rs->url."\" target=_blank>����ͼƬ</a>
 </td>";
  echo"  <td align=\"center\" valign=\"middle\">".$rs->time."</td>";*/
 echo" </tr>";
 }
 ?>
</table></div>