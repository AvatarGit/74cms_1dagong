<?php
/**
 *
 * �ĵ�ͳ��
 *
 * �������ʾ�������,������view����,��������ʣӵ��÷ŵ��ĵ�ģ���ʵ�λ��
 * <script src="{dede:field name='phpurl'/}/count.php?view=yes&companyid={dede:field name='id'/}&mid={dede:field name='mid'/}" language="javascript"></script>
 * ��ͨ������Ϊ
 * <script src="{dede:field name='phpurl'/}/count.php?companyid={dede:field name='id'/}&mid={dede:field name='mid'/}" language="javascript"></script>
 *
 * @version        $Id: count.php 1 20:43 2010��7��8��Z tianya $
 * @package        DedeCMS.Site
 * @copyright      Copyright (c) 2007 - 2010, DesDev, Inc.
 * @license        http://help.dedecms.com/usersguide/license.html
 * @link           http://www.dedecms.com
 */
require_once(dirname(__FILE__)."/../include/common.inc.php");

if(isset($companyid)) $arcID = $companyid;

$cid = empty($cid)? 1 : intval(preg_replace("/[^-\d]+[^\d]/",'', $cid));
$arcID = $companyid = empty($arcID)? 0 : intval(preg_replace("/[^\d]/",'', $arcID));

$maintable = '#@__archives';$idtype='id';

if($companyid==0) exit();



$conn = mysql_connect("192.168.3.249","hr.1jobs.com","hr.1jobs.com") or die("���ݿ����Ӵ���".mysql_error());
mysql_select_db("hr.1jobs.com",$conn)or die("���ݿ���ʴ���".mysql_error());

$sql=mysql_query("SELECT job_yibao FROM myhome_jobs WHERE id ='{$companyid}' LIMIT 1",$conn);

$rs=mysql_fetch_array($sql);



if(is_array($rs)){
		echo "document.write('".$rs['job_yibao']."');\r\n";
}


/*
//���Ƶ��ģ��ID
if($cid < 0)
{
    $row = $dsql->GetOne("SELECT addtable FROM `#@__channeltype` WHERE id='$cid' AND issystem='-1';");
    $maintable = empty($row['addtable'])? '' : $row['addtable'];
    $idtype='companyid';
}
$mid = (isset($mid) && is_numeric($mid)) ? $mid : 0;

//UpdateStat();
if(!empty($maintable))
{
    $dsql->ExecuteNoneQuery(" UPDATE `{$maintable}` SET click=click+1 WHERE {$idtype}='$companyid' ");
}
if(!empty($mid))
{
    $dsql->ExecuteNoneQuery(" UPDATE `#@__member_tj` SET pagecount=pagecount+1 WHERE mid='$mid' ");
}
if(!empty($view))
{
    $row = $dsql->GetOne(" SELECT click FROM `{$maintable}` WHERE {$idtype}='$companyid' ");
    if(is_array($row))
    {
        echo "document.write('".$row['click']."');\r\n";
    }
}
*/
exit();