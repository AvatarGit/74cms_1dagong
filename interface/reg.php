<?php
define('IN_QISHI', true);
require_once(dirname(__FILE__).'/include/common.inc.php');
require_once(ANDROID_ROOT_PATH.'include/fun_user.php');
require_once(QISHI_ROOT_PATH.'include/mysql.class.php');
	$db = new mysql($dbhost,$dbuser,$dbpass,$dbname);
	$aset=$_REQ;
	$username = trim($aset['username']);
	$password = trim($aset['userpwd']) ? trim($aset['userpwd']):substr($username,-4);
	$member_type = intval($aset['member_type']);
	$email = trim($aset['email']);
	$username=addslashes($username);
	$password=addslashes($password);
	$email=addslashes($email);
	$username=iconv("utf-8",QISHI_DBCHARSET,$username);
	$password=iconv("utf-8",QISHI_DBCHARSET,$password);
	$email=iconv("utf-8",QISHI_DBCHARSET,$email);
	// if (empty($username) || empty($password) || empty($email))//edition:0
	if(empty($username))
	{
		$result['code']=0;
		// $result['errormsg']=android_iconv_utf8('�û�������������䲻��Ϊ�գ�');edition:0
		$result['errormsg']=android_iconv_utf8('�û�������Ϊ�գ�');
		$jsonencode = urldecode(json_encode($result));
		exit($jsonencode);
	}
	/*if (strlen($username)<3)
	{
		$result['code']=0;
		$result['errormsg']=android_iconv_utf8('�û�������Ϊ3λ���ϣ�');
		$jsonencode = urldecode(json_encode($result));
		exit($jsonencode);
	}
	if (preg_match("/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/",$username))
	{
		$result['code']=0;
		$result['errormsg']=android_iconv_utf8('�û������������䣡');
		$jsonencode = urldecode(json_encode($result));
		exit($jsonencode);
	}
	if (!preg_match("/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/",$email))
	{
		$result['code']=0;
		$result['errormsg']=android_iconv_utf8('�����ʽ����ȷ��');
		$jsonencode = urldecode(json_encode($result));
		exit($jsonencode);
	}*/	
	// $register=user_register($username,$password,$membber_type,$email);//edition:0
	$register=user_register($username,$password,$member_type);
	if ($register>0)
	{	
		user_login($username,$password);
		$mailconfig=get_cache('mailconfig');
		if ($mailconfig['set_reg']=="1")
		{
		dfopen($_CFG['site_domain'].$_CFG['site_dir']."plus/asyn_mail.php?uid=".$_SESSION['uid']."&key=".asyn_userkey($_SESSION['uid'])."&sendemail=".$email."&sendusername=".$username."&sendpassword=".$password."&act=reg");
		}
		$result['code']=1;
		$result['errormsg']='';
		$result['data']=array('uid'=>$_SESSION['uid'],'username'=>$_SESSION['username'],'utype'=>$_SESSION['utype']);
		$jsonencode = android_iconv_utf8_array($result);
		$jsonencode = urldecode(json_encode($result));
		exit($jsonencode);
		
	}
	elseif ($register===-1)
	{
	$result['code']=0;
	$result['errormsg']=android_iconv_utf8('��Ա���ʹ���');
	$jsonencode = urldecode(json_encode($result));
	exit($jsonencode);
	}
	elseif ($register===-2)
	{
	$result['code']=0;
	$result['errormsg']=android_iconv_utf8('�û����Ѿ����ڣ�');
	$jsonencode = urldecode(json_encode($result));
	exit($jsonencode);
	}
	elseif ($register===-3)
	{
	$result['code']=0;
	$result['errormsg']=android_iconv_utf8('�����Ѿ����ڣ�');
	$jsonencode = urldecode(json_encode($result));
	exit($jsonencode);
	}
?>