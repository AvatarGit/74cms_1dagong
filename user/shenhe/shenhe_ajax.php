<?php
/*
 * 74cms ��ҵ��Ա����ajax������
 * ============================================================================
 * ��Ȩ����: ��ʿ���磬����������Ȩ����
 * ��վ��ַ: http://www.74cms.com��
 * ----------------------------------------------------------------------------
 * �ⲻ��һ�������������ֻ���ڲ�������ҵĿ�ĵ�ǰ���¶Գ����������޸ĺ�
 * ʹ�ã�������Գ���������κ���ʽ�κ�Ŀ�ĵ��ٷ�����
 * ============================================================================
*/
define('IN_QISHI', true);
require_once(dirname(__FILE__) . '/shenhe_common.php');
if($act=="user_email"){
	$tpl='../../templates/'.$_CFG['template_dir']."member_shenhe/ajax_authenticate_email_box.htm";
	$contents=file_get_contents($tpl);
	$_SESSION['send_email_key']=mt_rand(100000, 999999);
	$contents=str_replace('{#$email#}',$user["email"],$contents);
	$contents=str_replace('{#$send_email_key#}',$_SESSION['send_email_key'],$contents);
	exit($contents);
}	
elseif($act=="user_mobile"){
	$tpl='../../templates/'.$_CFG['template_dir']."member_shenhe/ajax_authenticate_mobile_box.htm";
	$contents=file_get_contents($tpl);
	$_SESSION['send_mobile_key']=mt_rand(100000, 999999);
	$contents=str_replace('{#$mobile#}',$user["mobile"],$contents);
	$contents=str_replace('{#$send_mobile_key#}',$_SESSION['send_mobile_key'],$contents);
	exit($contents);
}
elseif($act=="old_mobile"){
	$tpl='../../templates/'.$_CFG['template_dir']."member_shenhe/ajax_authenticate_old_mobile_box.htm";
	$contents=file_get_contents($tpl);
	$_SESSION['send_mobile_key']=mt_rand(100000, 999999);
	$user["hid_mobile"] = substr($user["mobile"],0,3)."*****".substr($user["mobile"],7,4);
	$contents=str_replace('{#$mobile#}',$user["mobile"],$contents);
	$contents=str_replace('{#$hid_mobile#}',$user["hid_mobile"],$contents);
	$contents=str_replace('{#$send_mobile_key#}',$_SESSION['send_mobile_key'],$contents);
	exit($contents);
}
elseif($act=="edit_mobile"){
	$tpl='../../templates/'.$_CFG['template_dir']."member_shenhe/ajax_authenticate_edit_mobile_box.htm";
	$contents=file_get_contents($tpl);
	$_SESSION['send_mobile_key']=mt_rand(100000, 999999);
	$contents=str_replace('{#$send_mobile_key#}',$_SESSION['send_mobile_key'],$contents);
	exit($contents);
}
if($act=="company_profile_save_succeed"){
	$tpl='../../templates/'.$_CFG['template_dir']."member_shenhe/ajax_companyprofile_save_succeed_box.htm";
	$contents=file_get_contents($tpl);
	if($company_profile['map_open'] == '1'){
		$save_msg = '���������Ϳ��Է���ְλ���� <br />';
		$opt_button = '<div class="but130cheng " onclick="javascript:location.href=\'shenhe_jobs.php?act=addjobs\'">����ְλ</div>';
	}else{ 
		$save_msg = '';
		$opt_button = '<div class="but130hui but_right" onclick="javascript:location.href=\'shenhe_jobs.php?act=addjobs\'">������ҵ����</div><div class="but130hui" style="margin-left:10px;" onclick="javascript:location.href=\'/user/shenhe/shenhe_company.php?act=shenhe_company_list&audit=\'">�����б�ҳ</div>';
	}
	$contents=str_replace('{#$save_msg#}',$save_msg,$contents);
	$contents=str_replace('{#$opt_button#}',$opt_button,$contents);
	exit($contents);
}
unset($smarty);
?>