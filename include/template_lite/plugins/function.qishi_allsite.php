<?php
/*********************************************
*������Ŀ
* *******************************************/
function tpl_function_qishi_allsite($params, &$smarty)
{
	global $db,$_CFG;
	$arr=explode(',',$params['set']);
	foreach($arr as $str)
	{
	$a=explode(':',$str);
		switch ($a[0])
		{
		case "��������":
			$aset['alias'] = $a[1];
			break;
		case "�б���":
			$aset['listname'] = $a[1];
			break;
		}
	}
	$subsite = $db->getall("select * from ".table('subsite')." where s_effective=1 order by s_index asc");
	$i = 0;
	foreach ($subsite as $key => $value) {
		
		$str = strtoupper($value['s_index']);
	
		if((strlen($list[$i]['key'])%5) == 0 &&!preg_match("/^([".$list[$i]['key']."])/",$str)){
				$i++; 
		}
	
		if(!preg_match("/^([".$list[$i]['key']."])/",$str)){
				$list[$i]['key'] .= $str." - ";
		}
		
		$list[$i]['city'][$key]['name'] = $value['s_districtname'];
		if($value['s_domain']==""){
			$list[$i]['city'][$key]['url'] = $_CFG['main_domain'].$value['s_dir'];
		}else{
			$list[$i]['city'][$key]['url'] = "http://".$value['s_domain'];
		}
		
		
	}
	$aset['listname']=$aset['listname']?$aset['listname']:"list";

	$smarty->assign($aset['listname'],$list);
}
?>