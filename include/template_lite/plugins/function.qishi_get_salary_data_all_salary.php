<?php
/*********************************************
*������Ŀ
* *******************************************/
function tpl_function_qishi_get_salary_data_all_salary($params, &$smarty)
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
		case "����":
			$aset['district'] = $a[1];
			break;
		case "ְλ":
			$aset['category'] = $a[1];
			break;
		}
	}
	$result = dfopen("http://www.74cms.com/salary/get_salary_data_all_salary.php?district=".$aset['district']."&category=".$aset['category']);
	// var_dump($result);die;
	if($result!="-1"){
		$result = json_decode($result,true);
	}else{
		$result="error";
	}
	
	$smarty->assign($aset['listname'],$result);
}

?>