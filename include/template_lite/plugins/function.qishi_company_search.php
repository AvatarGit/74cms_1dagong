<?php
/*********************************************
*��ʿְλ�б�
* *******************************************/
function tpl_function_qishi_company_search($params, &$smarty)
{
 //echo '===';exit;
global $db,$_CFG;
$arrset=explode(',',$params['set']);
foreach($arrset as $str)
{
$a=explode(':',$str);
	switch ($a[0])
	{
	case "�б���":
		$aset['listname'] = $a[1];
		break;
	case "��ʾ��Ŀ":
		$aset['row'] = $a[1];
		break;
	case "��ʼλ��":
		$aset['start'] = $a[1];
		break;
	case "ְλ������":
		$aset['jobslen'] = $a[1];
		break;
	case "��ҵ������":
		$aset['companynamelen'] = $a[1];
		break;
	case "��������":
		$aset['brieflylen'] = $a[1];
		break;
	case "��ַ�":
		$aset['dot'] = $a[1];
		break;
	case "ְλ����":
		$aset['jobcategory'] = $a[1];
		break;
	case "ְλ����":
		$aset['category'] = $a[1];
		break;
	case "ְλС��":
		$aset['subclass'] = $a[1];
		break;
	case "��������":
		$aset['citycategory'] = $a[1];
		break;
	case "��������":
		$aset['district'] = $a[1];
		break;
	case "����С��":
		$aset['sdistrict'] = $a[1];
		break;
	case "��·":
		$aset['street'] = $a[1];
		break;
	case "д��¥":
		$aset['officebuilding'] = $a[1];
		break;
	case "��ǩ":
		$aset['tag'] = $a[1];
		break;
	case "��ҵ":
		$aset['trade'] = $a[1];
		break;
	case "��˾��ģ":
		$aset['scale'] = $a[1];
		break;
	case "������Ƹ":
		$aset['emergency'] = $a[1];
		break;
	case "�Ƽ�":
		$aset['recommend'] = $a[1];
		break;
	case "�ؼ���":
		$aset['key'] = $a[1];
		// echo $a[1] ;exit;
		break;
	case "�ؼ�������":
		$aset['keytype'] = $a[1];
		break;
	case "���ڷ�Χ":
		$aset['settr'] = $a[1];
		break;
	case "����":
		$aset['displayorder'] = $a[1];
		break;
	case "��ҳ��ʾ":
		$aset['page'] = $a[1];
		break;
	case "��ԱUID":
		$aset['uid'] = $a[1];
		break;
	case "��˾ҳ��":
		$aset['companyshow'] = $a[1];
		break;
	case "ְλҳ��":
		$aset['jobsshow'] = $a[1];
		break;
	case "�б�ҳ":
		$aset['listpage'] = $a[1];
		break;
	}
	
}
$aset=array_map("get_smarty_request",$aset);
$aset['listname']=isset($aset['listname'])?$aset['listname']:"list";
$aset['listpage']=isset($aset['listpage'])?$aset['listpage']:"qs_company_search";
$aset['row']=intval($aset['row'])>0?intval($aset['row']):10;
if ($aset['row']>30)$aset['row']=30;
$aset['start']=isset($aset['start'])?intval($aset['start']):0;
$aset['jobslen']=isset($aset['jobslen'])?intval($aset['jobslen']):8;
$aset['companynamelen']=isset($aset['companynamelen'])?intval($aset['companynamelen']):15;
$aset['brieflylen']=isset($aset['brieflylen'])?intval($aset['brieflylen']):0;
$aset['companyshow']=isset($aset['companyshow'])?$aset['companyshow']:'QS_companyshow';
$aset['jobsshow']=isset($aset['jobsshow'])?$aset['jobsshow']:'QS_jobsshow';
$openorderby=false;
if (isset($aset['displayorder']))
{
		$arr=explode('>',$aset['displayorder']);
		// ����ʽ
		if($arr[1]=='desc'){
			$arr[1]="desc";
		}
		elseif($arr[1]=="asc")
		{
			$arr[1]="asc";
		}
		else
		{
			$arr[1]="desc";
		}
		if ($arr[0]=="rtime")
		{
		$orderbysql=" ORDER BY refreshtime {$arr[1]}";
		$jobstable=table('company_profile');
		}
		elseif ($arr[0]=="stickrtime")
		{
		$orderbysql=" ORDER BY stick {$arr[1]} , refreshtime {$arr[1]}";
		$jobstable=table('company_profile');		
		}
		elseif ($arr[0]=="hot")
		{
		$orderbysql=" ORDER BY click {$arr[1]}";
		$jobstable=table('company_profile');		
		}
		
		elseif ($arr[0]=="key")
		{
		$orderbysql=" ORDER BY refreshtime {$arr[1]}";
		$jobstable=table('company_profile');
		}
		elseif ($arr[0]=="null")
		{
		$orderbysql="";
		$jobstable=table('company_profile');
		}
		else
		{
		$orderbysql=" ORDER BY  refreshtime {$arr[1]}";
		$jobstable=table('company_profile');	
		}
}
else
{
		$orderbysql=" ORDER BY  refreshtime DESC";
		$jobstable=table('company_profile');
}
$orderbysql.=",id desc ";
/*
if ($_CFG['subsite']=="1" && intval($_CFG['subsite_id'])>0)
{
	$wheresql.=" AND subsite_id=".intval($_CFG['subsite_id'])." ";
}
//######zzzzzz
if ($_CFG['subsite']=="1" && empty($aset['citycategory']) && empty($aset['district']) && empty($aset['sdistrict']) && $_CFG['subsite_filter_jobs']=="1")
{
	$wheresql.=" AND (subsite_id='0' or subsite_id=".intval($_CFG['subsite_id']).") ";
}
*/
if (isset($aset['settr']) && $aset['settr']<>'')
{
	$settr=intval($aset['settr']);
	if ($settr>0)
	{
	$settr_val=intval(strtotime("-".$aset['settr']." day"));
	$wheresql.=" AND refreshtime>".$settr_val;
	}
}
if (isset($aset['uid'])  && $aset['uid']<>'')
{
	$wheresql.=" AND uid=".intval($aset['uid']);
}
if (isset($aset['emergency'])  && $aset['emergency']<>'')
{
	$wheresql.=" AND emergency=".intval($aset['emergency']);
}
if (isset($aset['recommend']) && $aset['recommend']<>'')
{
	$wheresql.=" AND recommend=".intval($aset['recommend']);
}

if (isset($aset['scale']) && $aset['scale']<>'')
{
	$wheresql.=" AND scale=".intval($aset['scale']);
}

if (isset($aset['trade']) && $aset['trade']<>'')
{
	if (strpos($aset['trade'],","))
	{
		$or=$orsql="";
		$arr=explode(",",$aset['trade']);
		$arr=array_unique($arr);
		if (count($arr)>10) exit();
		$sqlin=implode(",",$arr);
		if (preg_match("/^(\d{1,10},)*(\d{1,10})$/",$sqlin))
		{
		$wheresql.=" AND trade IN  ({$sqlin}) ";
		}
	}
	else
	{
	$wheresql.=" AND trade=".intval($aset['trade'])." ";
	}
}
if (!empty($aset['citycategory']))
{
		$dsql=$xsql="";
		$arr=explode(",",$aset['citycategory']);
		$arr=array_unique($arr);
		if (count($arr)>10) exit();
		foreach($arr as $sid)
		{
				$cat=explode(".",$sid);
				if (intval($cat[1])===0)
				{
				$dsql.= " OR district =".intval($cat[0]);
				}
				else
				{
				$xsql.= " OR sdistrict =".intval($cat[1]);
				}
				
				
		}
		$wheresql.=" AND  (".ltrim(ltrim($dsql.$xsql),'OR').") ";
}
else
{
	if (isset($aset['district'])  && $aset['district']<>'')
	{
		if (strpos($aset['district'],"-"))
		{
			$or=$orsql="";
			$arr=explode("-",$aset['district']);
			$arr=array_unique($arr);
			if (count($arr)>20) exit();
			$sqlin=implode(",",$arr);
			if (preg_match("/^(\d{1,10},)*(\d{1,10})$/",$sqlin))
			{
				$wheresql.=" AND district IN  ({$sqlin}) ";
			}
		}
		else
		{
			$wheresql.=" AND district =".intval($aset['district']);
		}
	}
	if (isset($aset['sdistrict'])  && $aset['sdistrict']<>'')
	{
		if (strpos($aset['sdistrict'],"-"))
		{
			$or=$orsql="";
			$arr=explode("-",$aset['sdistrict']);
			$arr=array_unique($arr);
			if (count($arr)>10) exit();
			$sqlin=implode(",",$arr);
			if (preg_match("/^(\d{1,10},)*(\d{1,10})$/",$sqlin))
			{
				$wheresql.=" AND sdistrict IN  ({$sqlin}) ";
			}
		}
		else
		{
			$wheresql.=" AND sdistrict =".intval($aset['sdistrict']);
		}
	}	
}
if (isset($aset['street']) && $aset['street']<>'')
{
	$wheresql.=" AND street=".intval($aset['street']);
}
if (isset($aset['officebuilding']) && $aset['officebuilding']<>'')
{
	$wheresql.=" AND officebuilding=".intval($aset['officebuilding']);
}
if (!empty($aset['jobcategory']))
{
	$dsql=$xsql="";
	$arr=explode(",",$aset['jobcategory']);
	$arr=array_unique($arr);
	if (count($arr)>10) exit();
	foreach($arr as $sid)
	{
		$cat=explode(".",$sid);
		if (intval($cat[2])===0)
		{
		$dsql.= " OR category =".intval($cat[1]);
		}
		else
		{
		$xsql.= " OR subclass =".intval($cat[2]);
		}
	}
	$wheresql.=" AND  (".ltrim(ltrim($dsql.$xsql),'OR').") ";
}
else
{
			if (isset($aset['category'])  && $aset['category']<>'')
			{
				if (strpos($aset['category'],"-"))
				{
					$or=$orsql="";
					$arr=explode("-",$aset['category']);
					$arr=array_unique($arr);
					if (count($arr)>10) exit();
					$sqlin=implode(",",$arr);
					if (preg_match("/^(\d{1,10},)*(\d{1,10})$/",$sqlin))
					{
					$wheresql.=" AND topclass IN  ({$sqlin}) ";
					}
				}
				else
				{
					$wheresql.=" AND topclass = ".intval($aset['category']);
				}
			}
			if (isset($aset['subclass'])  && $aset['subclass']<>'')
			{
				if (strpos($aset['subclass'],"-"))
				{
					$or=$orsql="";
					$arr=explode("-",$aset['subclass']);
					$arr=array_unique($arr);
					if (count($arr)>10) exit();
					$sqlin=implode(",",$arr);
					if (preg_match("/^(\d{1,10},)*(\d{1,10})$/",$sqlin))
					{
						$wheresql.=" AND category IN  ({$sqlin}) ";
					}
				}
				else
				{
					$wheresql.=" AND category = ".intval($aset['subclass']);
				}
			}
}
if (isset($aset['key']) && !empty($aset['key']))
{
	if ($_CFG['jobsearch_purview']=='2')
	{
		if ($_SESSION['username']=='')
		{
		header("Location: ".url_rewrite('QS_login')."?url=".urlencode($_SERVER["REQUEST_URI"]));
		}
	}
	$key=trim($aset['key']);
	// echo $key;exit;
	$wheresql.=" AND companyname LIKE '%{$key}%' ";	
	$jobstable=table('company_profile');
}

if (!empty($wheresql))
{
$wheresql=" WHERE ".ltrim(ltrim($wheresql),'AND');
//SQL����һ������ ְλ������ҵ���������ͨ������ҵ ��ʼ By Z
$wheresql.=" AND audit=1";
//SQL����һ������ ְλ������ҵ���������ͨ������ҵ ���� By Z
//�˴��漰�ĸ��Ļ�������� ��SQL�����ġ�
}else{
$wheresql.="where audit=1";
}
// echo '1111';exit; 
if (isset($aset['page']))
{
	require_once(QISHI_ROOT_PATH.'include/page.class.php');
	$total_sql="SELECT COUNT(*) AS num FROM {$jobstable} {$wheresql}";
	//echo $total_sql;exit;
	$total_count=$db->get_total($total_sql);	
	/*if ($_CFG['jobs_list_max']>0)
	{
		$total_count>intval($_CFG['jobs_list_max']) && $total_count=intval($_CFG['jobs_list_max']);
	}*/
	$page = new page(array('total'=>$total_count, 'perpage'=>$aset['row'],'alias'=>$aset['listpage'],'getarray'=>$_GET));
	$currenpage=$page->nowindex;
	$aset['start']=abs($currenpage-1)*$aset['row'];
	if ($total_count>$aset['row'])
	{
	$smarty->assign('page',$page->show(3));
	$smarty->assign('pagemin',$page->show(4));
	$smarty->assign('pagenow',$page->show(6));
	}
	//echo $total_count;exit;
	$smarty->assign('total',$total_count);
	
}
	
	$limit=" LIMIT {$aset['start']} , {$aset['row']}";
	$list = $id = array();
	//echo "SELECT id FROM {$jobstable}  ".$wheresql.$orderbysql.$limit;exit;
	$idresult = $db->query("SELECT id FROM {$jobstable}  ".$wheresql.$orderbysql.$limit);
	// echo "SELECT id FROM {$jobstable} ".$wheresql.$orderbysql.$limit;
	// echo "SELECT a.id FROM {$jobstable} a LEFT JOIN qs_company_profile b on a.uid=b.uid ".$wheresql.$orderbysql.$limit;exit;
	while($row = $db->fetch_array($idresult))
	{
	$id[]=$row['id'];
	}
	if (!empty($id))
	{
	$wheresql=" WHERE id IN (".implode(',',$id).") ";
	//SQL������ By Z  ----fff���refreshtime
	//echo "SELECT * FROM qs_company_profile".$wheresql.$orderbysql;exit;
	$result = $db->query("SELECT * FROM ".table('company_profile').$wheresql.$orderbysql);	
	// echo "SELECT * FROM ".table('jobs')." ".$wheresql.$orderbysql;
	// echo "SELECT * FROM ".table('jobs')." a LEFT JOIN qs_company_profile b on a.uid=b.uid".$wheresql.$orderbysql;exit;
		$i=0;
		while($row = $db->fetch_array($result))
		{
			$i++;
			
		// echo $row['audit'];exit;
		//$row['jobs_name']=$row['jobs_name'];
		$row['i']=$i;
		
		//---ffff
		//$row['refreshtime_cn']=daterange(time(),$row['refreshtime'],'Y-m-d',"#FF3300");
		$row['refreshtime_cn']=daterange(time(),$row['refreshtime'],'m-d',"#FF3300");
		//---fff
		
		$row['jobs_name']=cut_str($row['jobs_name'],$aset['jobslen'],0,$aset['dot']);
			if (!empty($row['highlight']))
			{
			$row['jobs_name']="<span style=\"color:{$row['highlight']}\">{$row['jobs_name']}</span>";
			}
			if ($aset['brieflylen']>0)
			{
				$row['briefly']=cut_str(strip_tags($row['contents']),$aset['brieflylen'],0,$aset['dot']);
			}
			else
			{
				$row['briefly']=strip_tags($row['contents']);
			}
		//----ff
		$row['wage_cn']=$row['wage_cn']=="����"?'����':$row['wage_cn']."Ԫ/��";
		if ($row['logo'])
			{
			$row['logo']="/data/logo/".$row['logo'];
			}
			else
			{
			$row['logo']="/data/logo/no_logo.gif";
			}
		$row['contents']=empty($row['contents'])?'���޼��':cut_str(DeleteHtml($row['contents']),80,0,"...");
		$row['trade_cn']=empty($row['trade_cn'])?'����':$row['trade_cn'];
		$row['scale_cn']=empty($row['scale_cn'])?'50������':$row['scale_cn'];
		$row['nature_cn']=empty($row['nature_cn'])?'':"(".$row['nature_cn'].")";//��˾����
		$row['district_cn']=cut_str($row['district_cn'],5,0,"..");//---��˾��ַ
		
		//--ff
		$row['amount']=$row['amount']=="0"?'����':$row['amount'];
		$row['briefly_']=strip_tags($row['contents']);
		$row['companyname_']=$row['companyname'];
		$row['companyname']=cut_str($row['companyname'],$aset['companynamelen'],0,$aset['dot']);
		$row['company_url']=url_rewrite($aset['companyshow'],array('id'=>$row['id']));
		if ($row['tag'])
		{
			$tag=explode('|',$row['tag']);
			$taglist=array();
			if (!empty($tag) && is_array($tag))
			{
				foreach($tag as $t)
				{
				$tli=explode(',',$t);
				$taglist[]=array($tli[0],$tli[1]);
				}
			}
			$row['tag']=$taglist;
		}
		else
		{
		$row['tag']=array();
		}
		$list[] = $row;
		}
	}
	else
	{
	$list=array();
	}
	//echo $key;exit;
	$smarty->assign($aset['listname'],$list);
}
?>