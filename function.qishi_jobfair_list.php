<?php
function tpl_function_qishi_jobfair_list($params, &$smarty)
{
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
	case "���ⳤ��":
		$aset['titlelen'] = $a[1];
		break;	
	case "��ʼλ��":
		$aset['start'] = $a[1];
		break;
	case "��ַ�":
		$aset['dot'] = $a[1];
		break;
	case "���ڷ�Χ":
		$aset['settr'] = $a[1];
		break;
	case "��ҳ��ʾ":
		$aset['paged'] = $a[1];
		break;
	case "ҳ��":
		$aset['showname'] = $a[1];
		break;
	case "�б�ҳ":
		$aset['listpage'] = $a[1];
		break;
	case "�λ���ҵҳ":
		$aset['exhibitorspage'] = $a[1];
		break;
	}
}
if (is_array($aset)) $aset=array_map("get_smarty_request",$aset);
$aset['listname']=isset($aset['listname'])?$aset['listname']:"list";
$aset['row']=isset($aset['row'])?intval($aset['row']):10;
$aset['start']=isset($aset['start'])?intval($aset['start']):0;
$aset['titlelen']=isset($aset['titlelen'])?intval($aset['titlelen']):15;
$aset['showname']=isset($aset['showname'])?$aset['showname']:'QS_jobfairshow';
$aset['listpage']=isset($aset['listpage'])?$aset['listpage']:'QS_jobfairlist';
$aset['exhibitorspage']=isset($aset['exhibitorspage'])?$aset['exhibitorspage']:'QS_jobfairexhibitors';

$orderbysql=" order BY `holddates` ASC ";
$wheresql=" WHERE display=1 AND holddates > ".strtotime(date('Y-m-d',strtotime('-1 days')));

if(intval($_CFG['subsite_id']!=0)){
	$wheresql.=" AND subsite_id=".intval($_CFG['subsite_id']);
}else{
	if(!empty($_GET['dqid'])){
		$wheresql.=" AND subsite_id='".$_GET['dqid']."'";
		$smarty->assign('dqid',$_GET['dqid']);
	}else{
		$wheresql.=" AND subsite_id='1' ";
		$smarty->assign('dqid',"1");
	}
}
if (isset($aset['paged'])){

	require_once(QISHI_ROOT_PATH.'include/page.class.php');
	$total_sql="SELECT COUNT(*) AS num FROM ".table('jobfair').$wheresql;
	$total_count=$db->get_total($total_sql);
	$pagelist = new page(array('total'=>$total_count, 'perpage'=>$aset['row'],'alias'=>$aset['listpage']));
	$currenpage=$pagelist->nowindex;
	
	$aset['start']=($currenpage-1)*$aset['row'];
		if ($total_count>$aset['row']){
			$smarty->assign('page',$pagelist->show(3));
		}else{
			$smarty->assign('page','');
		}
			$smarty->assign('total',$total_count);
}

$limit=" LIMIT ".abs($aset['start']).','.$aset['row'];
$result = $db->query("SELECT * FROM ".table('jobfair')." ".$wheresql.$orderbysql.$limit);
$list= array();
$week=array('������','����һ','���ڶ�','������','������','������','������');
$time=time();
$y=0;
while($row = $db->fetch_array($result))
{		
	/*---------------*/
	/*��Ԥ��*/
	$yyd=$db->getone("select count(*) as yiyuding from vip_zhanhui where zid='".$row['id']."'");		//��Ԥ������չλ
	$row['yiyuding']=$yyd['yiyuding'];
	/*δԤ��*/
	$wyd="select count(*) as weiyuding from vip_zw where subsite_id='".intval($row['subsite_id'])."'";
	$wyd=$db->getone($wyd);		//û��Ԥ����չλ
	$row['weiyuding']=$wyd['weiyuding']-$yyd['yiyuding'];
	/*---------------*/
	///------------������չ��ҵ---
	//echo "select * from vip_zhanhui where zid='".$row['id']."' limit 0,5";exit;
	$ydqy=$db->getall("select z.*,c.id as cid from vip_zhanhui as z left join ".table('company_profile')." as c  on z.qid=c.uid  where z.zid='".$row['id']."'and z.qid <>0 and c.companyname<>'' and c.contents <> '' order by z.add_time desc limit 0,18");		//��Ԥ��������ҵ
	$row['ydqy']=$ydqy;
	///-----------ֻ�з���ְλ����ҵ��ʾ---ffffff
	/*
	foreach($ydqy as $v){
	$jobsid=$db->getone('select id from '.table('jobs').' where company_id = '.$v['cid']);
	if($jobsid){$yd[]=$v;}
	}
	$row['ydqy']=$yd;*/
	///--------
		
	$row['title_']=$row['title'];
	$color=$row['color']?"color:".$row['color'].";":'';
	$weight=$row['weight']=="1"?"font-weight:bold;":'';
	$row['title']=cut_str($row['title'],$aset['titlelen'],0,$aset['dot']);
	if ($color || $weight)$row['title']="<span style=".$color.$weight.">".$row['title']."</span>";
	$row['holddates_week']=$week[date("w",$row['holddates'])];
	$row['url'] = url_rewrite($aset['showname'],array('id'=>$row['id']));
	$row['exhibitorsurl'] = url_rewrite($aset['exhibitorspage'],array('id'=>$row['id']));
	if ($row['predetermined_status']=="1" && ($row['predetermined_web']=="1" || $row['predetermined_tel']=="1") && date("Y-m-d",$row['holddates'])>=date("Y-m-d",$time) && $time>$row['predetermined_start'])
	{
		if($row['predetermined_end']=="0" || date("Y-m-d",$row['predetermined_end'])>date("Y-m-d",$time)){
			$row['predetermined_ok']=1;
		}elseif(date("Y-m-d",$row['predetermined_end'])==date("Y-m-d",$time)){
			if($row['hour']>date("H")){$row['predetermined_ok']=1;}
		}
	}
	else
	{
		$row['predetermined_ok']=0;
	}
	$y=$y+1;
	$row['y']=$y;
	$list[] = $row;
}
$smarty->assign($aset['listname'],$list);
}
?>