<?php
/*********************************************
*������Ŀ
* *******************************************/
function tpl_function_qishi_get_salary_data_experience_pie($params, &$smarty)
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
	$result = dfopen("http://www.74cms.com/salary/get_salary_data_experience_pie.php?district=".$aset['district']."&category=".$aset['category']);
	$smarty->assign($aset['listname'],$result);
}

?>