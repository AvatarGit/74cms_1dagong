<?php
/*********************************************
*��ʿ�߼�ְλ�б�
* *******************************************/
function array_get_by_key(array $array, $string)
{
	//echo $string;exit;
	//echo serialize($array);exit;
	if (!trim($string)) return false;
	preg_match_all("/\"$string\";\w{1}:(?:\d+:|)(.*?);/", serialize($array), $res);
	//echo "<pre>";print_r($res[1]);exit;
	return $res[1];
}
function tpl_function_qishi_hymq_jobs_list($params, &$smarty)
{
// echo '222a';exit;
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
		$aset['row'] =$a[1];
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
	case "ѧ��":
		$aset['education'] = $a[1];
		break;
	case "��������":
		$aset['experience'] = $a[1];
		break;
	case "����":
		$aset['age'] = $a[1];
		break;
	case "����":
		$aset['wage'] = $a[1];
		break;
	case "��ҵ":
		$aset['trade'] = $a[1];
		break;
	case "��˾��ģ":
		$aset['scale'] = $a[1];
		break;
	case "�ؼ���":
		$aset['key'] = $a[1];
		break;
	case "�Ƽ�":
		$aset['recommend'] = $a[1];
		break;
	case "�ؼ�������":
		$aset['keytype'] = $a[1];
		break;
	case "���ڷ�Χ":
		$aset['refre'] = $a[1];
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
	$timenow=time();
$aset=array_map("get_smarty_request",$aset);
$aset['listname']=isset($aset['listname'])?$aset['listname']:"list";
$aset['listpage']=isset($aset['listpage'])?$aset['listpage']:"QS_hymq";
$aset['row']=intval($aset['row'])>0?intval($aset['row']):10;
if ($aset['row']>30)$aset['row']=30;
$aset['start']=isset($aset['start'])?intval($aset['start']):0;
$aset['jobslen']=isset($aset['jobslen'])?intval($aset['jobslen']):8;
$aset['companynamelen']=isset($aset['companynamelen'])?intval($aset['companynamelen']):15;
$aset['recommend']=isset($aset['recommend'])?intval($aset['recommend']):'';
$aset['brieflylen']=isset($aset['brieflylen'])?intval($aset['brieflylen']):0;
$aset['companyshow']=isset($aset['companyshow'])?$aset['companyshow']:'QS_companyshow';
$aset['jobsshow']=isset($aset['jobsshow'])?$aset['jobsshow']:'QS_hymq_jobsshow';//QS_hymq_jobsshow

if (isset($aset['displayorder']))
{
		$arr=explode('>',$aset['displayorder']);
		$arr[1]=preg_match('/asc|desc/',$arr[1])?$arr[1]:"desc";
		if ($arr[0]=="rtime")
		{
		$orderbysql=" ORDER BY refreshtime {$arr[1]}";
		}
		elseif ($arr[0]=="atime")
		{
		$orderbysql=" ORDER BY addtime {$arr[1]}";
		}
		elseif ($arr[0]=="hot")
		{
		$orderbysql=" ORDER BY click {$arr[1]}";
		}
		elseif ($arr[0]=="scale")
		{
		$orderbysql=" ORDER BY scale {$arr[1]},refreshtime {$arr[1]}";
		}
		elseif ($arr[0]=="wage")
		{
		$orderbysql=" ORDER BY wage {$arr[1]},refreshtime {$arr[1]}";
		}
		else
		{
		$orderbysql=" ORDER BY refreshtime {$arr[1]}";
		}
}

if ($_CFG['subsite']=="1" && empty($aset['citycategory']) && empty($aset['district']) && empty($aset['sdistrict']) && $_CFG['subsite_filter_jobs']=="1")
{
	$wheresql.=" AND (subsite_id=0 OR subsite_id=".intval($_CFG['subsite_id']).") ";
}
if (isset($aset['refre']) && $aset['refre']<>'')
{
	$settr=intval($aset['refre']);
	if ($settr>0)
	{
	$settr_val=intval(strtotime("-".$aset['refre']." day"));
	$wheresql.=" AND refreshtime>".$settr_val;
	}
}
//��ҵ����ְλ��ǩ������ʼ By Z
$jobtag=$_GET['jobtag'];
if(!empty($jobtag)){
	$wheresql.=" AND tag like '%".$jobtag."%'";
}
// echo $jobtag;exit;
//��ҵ����ְλ��ǩ�������� By Z
if (isset($aset['uid'])  && $aset['uid']<>'')
{
	$wheresql.=" AND uid=".intval($aset['uid']);
}
if (isset($aset['recommend'])  && $aset['recommend']<>'')
{
	$wheresql.=" AND recommend=".intval($aset['recommend']);
}
if (isset($aset['education']) && $aset['education']<>'')
{
	$wheresql.=" AND education=".intval($aset['education']);
}
if (isset($aset['scale']) && $aset['scale']<>'')
{
	$wheresql.=" AND scale=".intval($aset['scale']);
}
if (isset($aset['wage'])  && $aset['wage']<>'')
{
	$wheresql.=" AND wage=".intval($aset['wage']);
}
if (isset($aset['experience'])  && $aset['experience']<>'')
{
	$wheresql.=" AND experience=".intval($aset['experience']);
}
if (isset($aset['age'])  && $aset['age']<>'')
{
	$wheresql.=" AND age=".intval($aset['age']);
}
if (isset($aset['trade']) && $aset['trade']<>'')
{
	if (strpos($aset['trade'],"-"))
	{
		$or=$orsql="";
		$arr=explode("-",$aset['trade']);
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

if (!empty($aset['jobcategory']))
{
	$dsql=$xsql="";
	$arr=explode("-",$aset['jobcategory']);
	$arr=array_unique($arr);
	if (count($arr)>10) exit();
	foreach($arr as $sid)
	{
		$cat=explode(".",$sid);
		if (intval($cat[1])===0)
		{
		$dsql.= " OR category =".intval($cat[0]);
		}
		else
		{
		$xsql.= " OR subclass =".intval($cat[1]);
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
					$wheresql.=" AND category IN  ({$sqlin}) ";
					}
				}
				else
				{
					$wheresql.=" AND category = ".intval($aset['category']);
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
						$wheresql.=" AND subclass IN  ({$sqlin}) ";
					}
				}
				else
				{
					$wheresql.=" AND subclass = ".intval($aset['subclass']);
				}
			}
}

if (!empty($aset['citycategory']))
{
		$dsql=$xsql="";
		$arr=explode("-",$aset['citycategory']);
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
if (isset($aset['key']) && !empty($aset['key']))
{
	if ($_CFG['hunterjobsearch_purview']=='2')
	{
		if ($_SESSION['username']=='')
		{
		header("Location: ".url_rewrite('QS_login')."?url=".urlencode($_SERVER["REQUEST_URI"]));
		}
	}
	$key=trim($aset['key']);
	if ($_CFG['hunterjobsearch_type']=='1')
	{
			$akey=explode(' ',$key);
			if (count($akey)>1)
			{
			$akey=array_filter($akey);
			$akey=array_slice($akey,0,2);
			$akey=array_map("fulltextpad",$akey);
			$key='+'.implode(' +',$akey);
			$mode=' IN BOOLEAN MODE';
			}
			else
			{
			$key=fulltextpad($key);
			$mode=' ';
			}
			$wheresql.=" AND  MATCH (`key`) AGAINST ('{$key}'{$mode}) ";
	}
	else
	{
			$wheresql.=" AND likekey LIKE '%{$key}%' ";
	}
	if ($_CFG['hunterjobsearch_sort']=='1')
	{
	$orderbysql="";
	}
	else
	{
	$orderbysql=" ORDER BY refreshtime DESC ";
	}	
	$jobstable=table('jobs_search_key');
}
if($_CFG['operation_mode']=='1'){
	$wheresql.="  AND audit=1  AND display=1 AND deadline >".time();
}elseif($_CFG['operation_train_mode']=='2'){
	//$wheresql.="  AND audit=1 AND display=1 AND setmeal_id>0 AND (setmeal_deadline>{$timenow} OR setmeal_deadline=0)";
	$wheresql.="  AND audit=1 AND display=1 AND deadline >".time();
}
if (!empty($wheresql))
{
$wheresql=" WHERE ".ltrim(ltrim($wheresql),'AND');
}
	//echo "SELECT * FROM ".table('shenhe_jobs')." ".$wheresql.$orderbysql.$limit;
if (isset($aset['page']))
{
	require_once(QISHI_ROOT_PATH.'include/page.class.php');
	$total_sql="SELECT COUNT(*) AS num FROM ".table('shenhe_jobs')." {$wheresql}";
	//echo $total_sql;
	//echo "<br>";
	$total_count=$db->get_total($total_sql);
	if ($_CFG['hymq_list_max']>0)
	{
		$total_count>intval($_CFG['hymq_list_max']) && $total_count=intval($_CFG['hymq_list_max']);
	}
	//echo $total_count."<br>";echo $aset['row']."<br>";echo $aset['listpage']."<br>";print_r($_GET); ;exit;	
	$page = new page(array('total'=>$total_count, 'perpage'=>$aset['row'],'alias'=>$aset['listpage'],'getarray'=>$_GET));
	$currenpage=$page->nowindex;
	$aset['start']=abs($currenpage-1)*$aset['row'];
	if ($total_count>$aset['row'])
	{
	$smarty->assign('page',$page->show(3));
	$smarty->assign('pagemin',$page->show(4));
	}
	$smarty->assign('total',$total_count);
}
	
	$limit=" LIMIT {$aset['start']} , {$aset['row']}";
	$list = $id = array();
	//echo "SELECT * FROM ".table('shenhe_jobs').$wheresql.$orderbysql.$limit;exit;
	$result = $db->query("SELECT * FROM ".table('shenhe_jobs').$wheresql.$orderbysql.$limit);
	//---fff
	$i=0;
	//----fff
	while($row = $db->fetch_array($result))
	{
		//--ff
		$i++;
		//---fff
		$row['jobs_name_']=$row['jobs_name'];
		$row['jobs_name']=cut_str($row['jobs_name'],$aset['jobslen'],0,$aset['dot']);
		if ($aset['brieflylen']>0)
		{
			$row['briefly']=cut_str(strip_tags($row['contents']),$aset['brieflylen'],0,$aset['dot']);
			$row['jobs_qualified']=cut_str(strip_tags($row['jobs_qualified']),$aset['brieflylen'],0,$aset['dot']);
		}
		else
		{
			$row['briefly']=strip_tags($row['contents']);
			$row['jobs_qualified']=strip_tags($row['jobs_qualified']);
		}
		
		$row['amount']=$row['amount']=="0"?'����':$row['amount'];
		$row['briefly_']=strip_tags($row['contents']);
		$row['companyname_']=$row['companyname'];
		$row['companyname']=cut_str($row['companyname'],$aset['companynamelen'],0,$aset['dot']);
		$row['jobs_url']=url_rewrite($aset['jobsshow'],array('id'=>$row['id']));
		//echo $row['jobs_url'];exit;
		$row['company_url']=url_rewrite($aset['companyshow'],array('id'=>$row['company_id']));
		$row['refreshtime_cn']=daterange(time(),$row['refreshtime'],'Y-m-d',"#FF3300");

		//----
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
		$row['jiezhan']=$row['jiezhan']==""?'��':cut_str($row['jiezhan'],9,0,"...");
		$row['logo']=$row['logo']==""?'':$row['logo'];
		
		//---fff
		 $row['y']=$i;
		//---fff
		$list[] = $row;
		
	}
	//echo $aset['listname'];echo "<pre>";print_r($list);exit;
	//echo $page;exit;
	$arr_trade=array();
	//echo "SELECT trade FROM ".table('shenhe_jobs').$wheresql.$orderbysql;exit;
	$result_1 = $db->query("SELECT companyname,trade,shortitle,wage_cn FROM ".table('shenhe_jobs').$wheresql.$orderbysql);
	while($row_1 = $db->fetch_array($result_1))
	{
		$arr_trade[]=$row_1;
	}
	//echo "<pre>";print_r($arr_trade);exit;
	$arr_trade=array_get_by_key($arr_trade,'trade');///-----����������ĳ����ֵ���һ���µĺ���
	//echo "<pre>";print_r($arr_trade);exit;
	///-------fffff�����ȡ��ҵidֵ---��ʼ
	$arr_t=array_count_values($arr_trade);//---��ȡ��������ֵͬ����//-http://www.jb51.net/article/60137.htm
	//$a=array_reverse($arr_t,true);
	//echo "<pre>";print_r($a);exit;
	$arr_trade_1=array_keys($arr_t);///------��ȡ��ֵ
	//echo "<pre>";print_r($arr_trade_1);
	$x=array_rand($arr_trade_1);
	$y=$arr_trade_1[$x];//-----�������������ȡһ��Ԫ��keyֵ
	//echo $arr_trade_1[3];echo $x;echo $y;exit;
	$smarty->assign('trade',$y);
	//------fffff�����ȡ��ҵidֵ----����
	
	$smarty->assign($aset['listname'],$list);
}
?>