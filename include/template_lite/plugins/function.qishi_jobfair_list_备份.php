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
//$orderbysql=" order BY `order` DESC,id DESC ";
$wheresql=" WHERE display=1 ";
if (isset($aset['settr']))
{
$settr_val=strtotime("-".intval($aset['settr'])." day");
$wheresql.=" AND addtime > ".$settr_val;
}
if ($_CFG['subsite']=="1" && $_CFG['subsite_filter_jobfair']=="1")
{
	$wheresql.=" AND (subsite_id=0 OR subsite_id=".intval($_CFG['subsite_id']).") ";
}

$wheresql.=" and holddates > ".strtotime(date('Y-m-d',strtotime('-3 days')));

if (isset($aset['paged']))
{
	require_once(QISHI_ROOT_PATH.'include/page.class.php');
	$total_sql="SELECT COUNT(*) AS num FROM ".table('jobfair').$wheresql;
	$total_count=$db->get_total($total_sql);
	$pagelist = new page(array('total'=>$total_count, 'perpage'=>$aset['row'],'alias'=>$aset['listpage']));
	$currenpage=$pagelist->nowindex;
	$aset['start']=($currenpage-1)*$aset['row'];
		if ($total_count>$aset['row'])
		{
		$smarty->assign('page',$pagelist->show(3));
		}
		else
		{
		$smarty->assign('page','');
		}
		$smarty->assign('total',$total_count);
}
//$limit=" LIMIT ".abs($aset['start']).','.$aset['row'];

$limit=" LIMIT 0 , 31";			//��ѯ��Ƹ�������

$result = $db->query("SELECT * FROM ".table('jobfair')." ".$wheresql.$orderbysql.$limit);
$list= array();
$week=array('������','����һ','���ڶ�','������','������','������','������');
$time=time();
while($row = $db->fetch_array($result))
{
	$row['title_']=$row['title'];
	$color=$row['color']?"color:".$row['color'].";":'';
	$weight=$row['weight']=="1"?"font-weight:bold;":'';
	$row['title']=cut_str($row['title'],$aset['titlelen'],0,$aset['dot']);
	if ($color || $weight)$row['title']="<span style=".$color.$weight.">".$row['title']."</span>";
	$row['holddates_week']=$week[date("w",$row['holddates'])];
	$row['url'] = url_rewrite($aset['showname'],array('id'=>$row['id']));
	$row['exhibitorsurl'] = url_rewrite($aset['exhibitorspage'],array('id'=>$row['id']));	
	if ($row['predetermined_status']=="1" && date("Y-m-d",$row['holddates'])>=date("Y-m-d",$time) && $time>$row['predetermined_start'] && ($row['predetermined_end']=="0" || $row['predetermined_end']>=$time || $row['hour']>=date("H")) && ($row['predetermined_web']=="1" || $row['predetermined_tel']=="1"))
	{
	$row['predetermined_ok']=1;
	}
	else
	{
	$row['predetermined_ok']=0;
	}
	$list[] = $row;
}

//print_r($list);
$arr=array();	//���ڵ�չ��
$data=array();	//������չ��
$i=0;	//��ʼ������ѭ������
$x=0;	//��ʼ������ѭ������

foreach ($list as $k => $v) {	
	//�����û�
	if($v['predetermined_ok']==0){
		$arr[$i]['id']=$v['id'];
		$arr[$i]['subsite_id']=$v['subsite_id'];
		$arr[$i]['display']=$v['display'];
		$arr[$i]['predetermined_status']=$v['predetermined_status'];
		$arr[$i]['predetermined_web']=$v['predetermined_web'];
		$arr[$i]['predetermined_tel']=$v['predetermined_tel'];
		$arr[$i]['predetermined_point']=$v['predetermined_point'];
		$arr[$i]['title']=$v['title'];
		$arr[$i]['color']=$v['color'];
		$arr[$i]['weight']=$v['weight'];
		$arr[$i]['industry']=$v['industry'];
		$arr[$i]['introduction']=$v['introduction'];
		$arr[$i]['address']=$v['address'];
		$arr[$i]['contact']=$v['contact'];
		$arr[$i]['phone']=$v['phone'];
		$arr[$i]['bus']=$v['bus'];
		$arr[$i]['holddates']=$v['holddates'];
		$arr[$i]['predetermined_start']=$v['predetermined_start'];
		$arr[$i]['predetermined_end']=$v['predetermined_end'];
		$arr[$i]['number']=$v['number'];
		$arr[$i]['addtime']=$v['addtime'];
		$arr[$i]['order']=$v['order'];
		$arr[$i]['click']=$v['click'];
		$arr[$i]['title_']=$v['title_'];
		$arr[$i]['holddates_week']=$v['holddates_week'];
		$arr[$i]['url']=$v['url'];
		$arr[$i]['exhibitorsurl']=$v['exhibitorsurl'];
		$arr[$i]['predetermined_ok']=$v['predetermined_ok'];
		//----------------------------------------------------------
		/*��Ԥ��*/
		$yyd="select count(*) as yiyuding from vip_zhanhui where zid='".$v['id']."'";
		$yyd=$db->getone($yyd);		//��Ԥ������չλ
		$arr[$i]['yiyuding']=$yyd['yiyuding'];
		/*δԤ��*/
		$wyd="select count(*) as weiyuding from vip_zw where number not in(select number from vip_zhanhui where zid=".$v['id'].") and subsite_id='".intval($_CFG['subsite_id'])."'";
		$wyd=$db->getone($wyd);		//û��Ԥ����չλ
		$arr[$i]['weiyuding']=$wyd['weiyuding'];
		//----------------------------------------------------------
		$i++;
	}
//----------------------------------------------------------
	
	if(date("m",$v['holddates'])!=date('m')){
	
	
	
		if($v['display_time']!='0'){
		  if( date("Y-m-d",$v['display_time']) <= date("Y-m-d",time())){
			//�Ǳ�������
			if($v['predetermined_ok']==1){
				$data[$x]['id']=$v['id'];
				$data[$x]['subsite_id']=$v['subsite_id'];
				$data[$x]['display']=$v['display'];
				$data[$x]['predetermined_status']=$v['predetermined_status'];
				$data[$x]['predetermined_web']=$v['predetermined_web'];
				$data[$x]['predetermined_tel']=$v['predetermined_tel'];
				$data[$x]['predetermined_point']=$v['predetermined_point'];
				$data[$x]['title']=$v['title'];
				$data[$x]['color']=$v['color'];
				$data[$x]['weight']=$v['weight'];
				$data[$x]['industry']=$v['industry'];
				$data[$x]['introduction']=$v['introduction'];
				$data[$x]['address']=$v['address'];
				$data[$x]['contact']=$v['contact'];
				$data[$x]['phone']=$v['phone'];
				$data[$x]['bus']=$v['bus'];
				$data[$x]['holddates']=$v['holddates'];
				$data[$x]['predetermined_start']=$v['predetermined_start'];
				$data[$x]['predetermined_end']=$v['predetermined_end'];
				$data[$x]['number']=$v['number'];
				$data[$x]['addtime']=$v['addtime'];
				$data[$x]['order']=$v['order'];
				$data[$x]['click']=$v['click'];
				$data[$x]['title_']=$v['title_'];
				$data[$x]['holddates_week']=$v['holddates_week'];
				$data[$x]['url']=$v['url'];
				$data[$x]['exhibitorsurl']=$v['exhibitorsurl'];
				$data[$x]['predetermined_ok']=$v['predetermined_ok'];
				//----------------------------------------------------------
				/*��Ԥ��*/
				$yyd="select count(*) as yiyuding from vip_zhanhui where zid='".$v['id']."'";
				$yyd=$db->getone($yyd);		//��Ԥ������չλ
				$data[$x]['yiyuding']=$yyd['yiyuding'];
				/*δԤ��*/
				$wyd="select count(*) as weiyuding from vip_zw where number not in(select number from vip_zhanhui where zid=".$v['id'].") and subsite_id='".intval($_CFG['subsite_id'])."'";
				$wyd=$db->getone($wyd);		//û��Ԥ����չλ
				$data[$x]['weiyuding']=$wyd['weiyuding'];
				//----------------------------------------------------------
				$x++;
			}
		  }
		}
	}else{
		//��ʾ���µ�-----------------
		if($v['predetermined_ok']==1){
			$data[$x]['id']=$v['id'];
			$data[$x]['subsite_id']=$v['subsite_id'];
			$data[$x]['display']=$v['display'];
			$data[$x]['predetermined_status']=$v['predetermined_status'];
			$data[$x]['predetermined_web']=$v['predetermined_web'];
			$data[$x]['predetermined_tel']=$v['predetermined_tel'];
			$data[$x]['predetermined_point']=$v['predetermined_point'];
			$data[$x]['title']=$v['title'];
			$data[$x]['color']=$v['color'];
			$data[$x]['weight']=$v['weight'];
			$data[$x]['industry']=$v['industry'];
			$data[$x]['introduction']=$v['introduction'];
			$data[$x]['address']=$v['address'];
			$data[$x]['contact']=$v['contact'];
			$data[$x]['phone']=$v['phone'];
			$data[$x]['bus']=$v['bus'];
			$data[$x]['holddates']=$v['holddates'];
			$data[$x]['predetermined_start']=$v['predetermined_start'];
			$data[$x]['predetermined_end']=$v['predetermined_end'];
			$data[$x]['number']=$v['number'];
			$data[$x]['addtime']=$v['addtime'];
			$data[$x]['order']=$v['order'];
			$data[$x]['click']=$v['click'];
			$data[$x]['title_']=$v['title_'];
			$data[$x]['holddates_week']=$v['holddates_week'];
			$data[$x]['url']=$v['url'];
			$data[$x]['exhibitorsurl']=$v['exhibitorsurl'];
			$data[$x]['predetermined_ok']=$v['predetermined_ok'];
			//----------------------------------------------------------
			/*��Ԥ��*/
			$yyd="select count(*) as yiyuding from vip_zhanhui where zid='".$v['id']."'";
			$yyd=$db->getone($yyd);		//��Ԥ������չλ
			$data[$x]['yiyuding']=$yyd['yiyuding'];
			/*δԤ��*/
			$wyd="select count(*) as weiyuding from vip_zw where number not in(select number from vip_zhanhui where zid=".$v['id'].") and subsite_id='".intval($_CFG['subsite_id'])."'";
			$wyd=$db->getone($wyd);		//û��Ԥ����չλ
			$data[$x]['weiyuding']=$wyd['weiyuding'];
			//----------------------------------------------------------
			$x++;
		}
	}
}


$list=array_merge($data,$arr);
$smarty->assign($aset['listname'],$list);

}
?>