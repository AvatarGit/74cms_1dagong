<?php
define('IN_QISHI', true);
require_once(dirname(__FILE__).'/include/common.inc.php');
require_once(ANDROID_ROOT_PATH.'include/fun_user.php');
require_once(QISHI_ROOT_PATH.'include/mysql.class.php');
	$db = new mysql($dbhost,$dbuser,$dbpass,$dbname);
	
	$userid=isset($_GET['userid'])?trim($_GET['userid']):"";
	$userid=addslashes($userid);
	$userid=iconv("utf-8",QISHI_DBCHARSET,$userid);
	if (empty($userid))
	{
	$result['code']=0;
	$result['errormsg']=android_iconv_utf8('����д�û���');
	$jsonencode = urldecode(json_encode($result));
	exit($jsonencode);
	}
	/*$row = $db->getone("SELECT * FROM ".table('members')." WHERE uid='{$userid}' LIMIT 1");
	//echo $row['password'];exit;
	if(empty($row)){
	$result['code']=-2;
	$result['errormsg']=android_iconv_utf8('û���ҵ����û�');
	$jsonencode = json_encode($result);
	$jsonencode = urldecode(json_encode($result));
	exit($jsonencode);
	}*/else{
		$rand=mt_rand(100000, 999999);
		$username=$userid;
		//--�ֻ���֤�뷢�Ͷ�Ϣ ��ʼ By Z
		require_once('./msg_send_captchacode.php');
	}
	
	/*if(md5($oldpass) != $row['password'])
	{
	$result['code']=-1;
	$result['errormsg']=android_iconv_utf8('�����������������������');
	$jsonencode = json_encode($result);
	$jsonencode = urldecode(json_encode($result));
	exit($jsonencode);
	}
	$newpass=md5($newpass);
	if ($db->query( "UPDATE ".table('members')." SET password = '$newpass'  WHERE uid='".$userid."'"))
	{
	$result['code']=1;
	$result['errormsg']='';
	$result['data']=array('userid'=>$userid,'username'=>$row['username'],'utype'=>$row['utype']);
	$jsonencode = android_iconv_utf8_array($result);
	$jsonencode = urldecode(json_encode($result));
	exit($jsonencode);
	
	}else{
	$result['code']=0;
	$result['errormsg']=android_iconv_utf8('�����޸Ĵ���');
	$jsonencode = json_encode($result);
	$jsonencode = urldecode(json_encode($result));
	exit($jsonencode);
	}*/
?>