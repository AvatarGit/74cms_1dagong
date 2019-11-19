<?php

function tpl_function_qishi_jobfair_show($params, &$smarty)
{
global $db;
$arr=explode(',',$params['set']);
foreach($arr as $str)
{
$a=explode(':',$str);
	switch ($a[0])
	{
	case "��Ƹ��ID":
		$aset['id'] = $a[1];
		break;
	case "�б���":
		$aset['listname'] = $a[1];
		break;
	case "�λ���ҵҳ":
		$aset['exhibitorspage'] = $a[1];
		break;
	}
}

$aset=array_map("get_smarty_request",$aset);
$aset['id']=$aset['id']?intval($aset['id']):0;
$aset['listname']=$aset['listname']?$aset['listname']:"list";
$aset['exhibitorspage']=isset($aset['exhibitorspage'])?$aset['exhibitorspage']:'QS_jobfairexhibitors';
unset($arr,$str,$a,$params);
$sql = "select * from ".table('jobfair')." WHERE  id=".intval($aset['id'])." AND  display=1 LIMIT 1";
$val=$db->getone($sql);
if (empty($val))
{
	header("HTTP/1.1 404 Not Found"); 
	$smarty->display("404.htm");
	exit();
}
$val['exhibitorsurl'] = url_rewrite($aset['exhibitorspage'],array('id'=>$val['id']));
$time=time();

if($val['predetermined_status']=="1" && date("Y-m-d",$val['holddates'])>=date("Y-m-d",$time) && $time>$val['predetermined_start'] && ($val['predetermined_end']=="0" || $val['predetermined_end']>=$time || $val['hour']>date("H")) && ($val['predetermined_web']=="1" || $val['predetermined_tel']=="1")){
	$val['predetermined_ok']=1;
}else{
	$val['predetermined_ok']=0;
}

$val['keywords']=$val['title'];
$val['description']=str_replace('&nbsp;','',$val['introduction']);
$val['description']=cut_str(strip_tags($val['description']),60,0,"");
$smarty->assign($aset['listname'],$val);

/*--------------------------------------------------------------------------------------------------------------------------*/	
	if(intval($val['subsite_id']!='8')){
		//-------------------------------------------------------------
		/*��Ԥ��*/
		$yyd=$db->getone("select count(*) as yiyuding from vip_zhanhui where zid='".$val['id']."'");		//��Ԥ������չλ
		$smarty->assign("yiyuding",$yyd['yiyuding']);
		/*δԤ��*/
		$wyd="select count(*) as weiyuding from vip_zw where subsite_id='".intval($val['subsite_id'])."'";
		$wyd=$db->getone($wyd);		//û��Ԥ����չλ
		$smarty->assign("weiyuding",$wyd['weiyuding']-$yyd['yiyuding']);
		//---------------------------------------------------------------
		/*��Ԥ��*/
		$sql="select * from vip_zhanhui where zid='".$val['id']."' and subsite_id='".intval($val['subsite_id'])."'";
		$ok=$db->getall($sql);		//��Ԥ������չλ
		$smarty->assign("ok",$ok);
		
		//-----------------------��Ӧ��--------------------������------sql��׸
		//echo"<pre>";print_r($ok);exit;
		$html="";
		foreach( $ok  as $k =>$v){
			$html.=$v['number'].",";
			}
			//----------------�ж���û��number---�Ƿ��ǵ�һ�ζ�չ
			if($html !="")
			{
				$html=substr($html,0,strlen($html)-1);//ȥ������
				$term=" and number not in(".'"$html"'.") ";
			}
			else
			{
				$term="";	
			}
		/*δԤ��*/
		//$sql="select number from vip_zw where number not in(select number from vip_zhanhui where zid=".$val['id'].") and subsite_id='".intval($val['subsite_id'])."'";//sql��׸
		$sql="select number from vip_zw where subsite_id='".intval($val['subsite_id'])."'".$term;
		//----------------------------------------------------------------�������
		$all=$db->getall($sql);		//û��Ԥ����չλ
		$smarty->assign("all",$all);
		
	}else{
		/*--��ȡһ��չλ��--*/
		$num="select number from qs_jobfair where subsite_id='8' and id='".$val['id']."'";
		$gzw=$db->getone($num);
		/*��Ԥ��*/
		$yyd=$db->getone("select count(*) as yiyuding from vip_zhanhui where zid='".$val['id']."'");		//��Ԥ������չλ
		$smarty->assign("yiyuding",$yyd['yiyuding']);
		/*--��ȡһ��չλ��--*/
		/*--��ȡʣ��չλ��--*/
		$wyd=$gzw['number']-$yyd['yiyuding'];
		$smarty->assign("weiyuding",$wyd);
		
		/*----��ȡ�λ���ҵ�б�----*/
		$qy="select * from `vip_zhanhui` where zid='".$val['id']."'";
		$qydata=$db->getall($qy);
		$smarty->assign("qydata",$qydata);
	
	}
}
?>