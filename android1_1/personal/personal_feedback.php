<?php 
define('IN_QISHI', true);
require_once(dirname(__FILE__).'/../include/common.inc.php');
require_once(QISHI_ROOT_PATH.'include/mysql.class.php');
$db = new mysql($dbhost,$dbuser,$dbpass,$dbname);
unset($dbhost,$dbuser,$dbpass,$dbname);
$aset=$_REQ;
$aset=array_map('addslashes',$aset);
require_once(ANDROID_ROOT_PATH.'include/common.user.inc.php');
	$uid = $_SESSION['uid'];
	$setsqlarr['uid']=intval($uid);
	$setsqlarr['username'] = $aset['username'];
	$setsqlarr['usertype'] = $_SESSION['utype'];
	$setsqlarr['infotype'] = intval($aset['infotype']);
	$setsqlarr['feedback'] = trim($aset['feedback']);
	$setsqlarr['addtime'] = time();
	
	$insert_id=inserttable(table('feedback'),$setsqlarr,1);
	if (empty($insert_id)){
		$result['result']=0;
		$result['list']=null;
		$result['errormsg']=android_iconv_utf8('��ӷ�����Ϣʧ��!');
		$jsonencode = urldecode(json_encode($result));
		exit($jsonencode);
	}else{
		write_memberslog($uid,2,7001,$aset['username'],"ͨ���ֻ��ͻ�����ӷ�����Ϣ");
		$result['result']=1;
		$result['list']=null;
		$result['errormsg']=android_iconv_utf8('�ɹ���ӷ�����Ϣ');
		$jsonencode = urldecode(json_encode($result));
		exit($jsonencode);
	}
?>