<?php
 /*
 * 74cms ��Ա��¼
 * ============================================================================
 * ��Ȩ����: ��ʿ���磬����������Ȩ����
 * ��վ��ַ: http://www.74cms.com��
 * ----------------------------------------------------------------------------
 * �ⲻ��һ��������������ֻ���ڲ�������ҵĿ�ĵ�ǰ���¶Գ����������޸ĺ�
 * ʹ�ã��������Գ���������κ���ʽ�κ�Ŀ�ĵ��ٷ�����
 * ============================================================================
*/
define('IN_QISHI', true);
$alias="QS_login";
require_once(dirname(__FILE__).'/../include/common.inc.php');
require_once(QISHI_ROOT_PATH.'include/mysql.class.php');
require_once(QISHI_ROOT_PATH.'include/fun_user.php');
$db = new mysql($dbhost,$dbuser,$dbpass,$dbname);
unset($dbhost,$dbuser,$dbpass,$dbname);
$smarty->caching = false;
$act = !empty($_REQUEST['act']) ? trim($_REQUEST['act']) : 'login';
if($act == 'logout')
{
	unset($_SESSION['uid']);
	unset($_SESSION['username']);
	unset($_SESSION['utype']);
	setcookie("QS[uid]","",time() - 3600,$QS_cookiepath, $QS_cookiedomain);
	setcookie("QS[username]","",time() - 3600,$QS_cookiepath, $QS_cookiedomain);
	setcookie("QS[password]","",time() - 3600,$QS_cookiepath, $QS_cookiedomain);
	setcookie("QS[utype]","",time() - 3600,$QS_cookiepath, $QS_cookiedomain);
	unset($_SESSION['activate_username']);
	unset($_SESSION['activate_email']);
	header("location:index.php"); 
}
elseif($act == 'weixin_login'){
	$openid = trim($_GET['openid']);
	$uid = intval($_GET['uid']);
	$event_key = intval($_GET['event_key']);
	weixin_login($openid,$uid,$event_key);

	
	$smarty->display('wap/scan/scan_success.html');
}
elseif(!$_SESSION['uid'] && !$_SESSION['username'] && !$_SESSION['utype'] &&  $_COOKIE['QS']['username'] && $_COOKIE['QS']['password'] )
{
	if(check_cookie($_COOKIE['QS']['username'],$_COOKIE['QS']['password']))
	{
	update_user_info($_COOKIE['QS']['username'],false,false);
			if($_SESSION['utype']==2)	header("location:personal/wap_user.php");
			if($_SESSION['utype']==1)	header("location:company/wap_user.php");
	}
	else
	{
	setcookie("QS[uid]","",time() - 3600,$QS_cookiepath, $QS_cookiedomain);
	setcookie('QS[username]',"", time() - 3600,$QS_cookiepath, $QS_cookiedomain);
	setcookie('QS[password]',"", time() - 3600,$QS_cookiepath, $QS_cookiedomain);
	setcookie("QS[utype]","",time() - 3600,$QS_cookiepath, $QS_cookiedomain);
	header("location:index.php"); 
	}
}
elseif ($_SESSION['username'] && $_SESSION['utype'] )
{
			if($_SESSION['utype']==2)	header("location:personal/wap_user.php");
			if($_SESSION['utype']==1)	header("location:company/wap_user.php");
}
elseif ($act=='login')
{
	$_SESSION['url'] = $_SERVER['HTTP_REFERER'];
	$smarty->display('wap/wap_login.html');
}
elseif ($act == 'do_login')
{
	require_once(QISHI_ROOT_PATH.'include/fun_wap.php');
	if($_POST['username']=="�û���/�ֻ���/����" || $_POST['password']==""|| $_POST['username']=="" ){
		$smarty->assign('err',"�������û�����");
		$smarty->display('wap/wap_login.html');
	}else{
		$username=isset($_POST['username'])?trim($_POST['username']):"";
		$password=isset($_POST['password'])?trim($_POST['password']):"";
		$expire=isset($_POST['expire'])?intval($_POST['expire']):"";
		if ($username && $password)
		{
			//echo $username."<br>"; echo $password;exit;
			if (wap_user_login($username,$password))
			{	
					//echo "<pre>";print_r(wap_user_login($username,$password));exit;
					//echo $_SESSION['url'];exit;
					/*if(!empty($_SESSION['url'])){
						header("location:".$_SESSION['url']);
						unset($_SESSION['url']);
						die;
					}*/
				if($_SESSION['utype']==2)	header("location:personal/wap_user.php");
				if($_SESSION['utype']==1)	header("location:company/wap_user.php");
			}
			else
			{
				$smarty->caching = false;
				$smarty->assign('err',"�û���¼ʧ�ܣ��û������������");
				$smarty->display('wap/wap_login.html');
			}		
		}
	}

}
elseif($act == 'waiting_weixin_login'){
	$event_key = $_SESSION['scene_id'];
	$content = "";
	if(file_exists(QISHI_ROOT_PATH."data/weixin/".$event_key.".txt")){
		$content = file_get_contents(QISHI_ROOT_PATH."data/weixin/".$event_key.".txt");
	}	
	$uid = intval($content);
	$check = check_uid($uid,$event_key,0);
	if($check){
		global $QS_cookiepath,$QS_cookiedomain;
		$u=get_user_by_uid($uid);
		if (!empty($u))
		{
			unset($_SESSION['uid']);
			unset($_SESSION['username']);
			unset($_SESSION['utype']);
			unset($_SESSION['uqqid']);
			setcookie("QS[uid]","",time() - 3600,$QS_cookiepath, $QS_cookiedomain);
			setcookie("QS[username]","",time() - 3600,$QS_cookiepath, $QS_cookiedomain);
			setcookie("QS[password]","",time() - 3600,$QS_cookiepath, $QS_cookiedomain);
			setcookie("QS[utype]","",time() - 3600,$QS_cookiepath, $QS_cookiedomain);
			unset($_SESSION['activate_username']);
			unset($_SESSION['activate_email']);
			
			$_SESSION['uid']=$u['uid'];
			$_SESSION['username']=$u['username'];
			$_SESSION['utype']=$u['utype'];
			$_SESSION['uqqid']="1";
			setcookie('QS[uid]',$u['uid'],0,$QS_cookiepath,$QS_cookiedomain);
			setcookie('QS[username]',$u['username'],0,$QS_cookiepath,$QS_cookiedomain);
			setcookie('QS[password]',$u['password'],0,$QS_cookiepath,$QS_cookiedomain);
			setcookie('QS[utype]',$u['utype'], 0,$QS_cookiepath,$QS_cookiedomain);
			unlink(QISHI_ROOT_PATH."data/weixin/".$event_key.".txt");
		}
		exit("1");
	}
}
//΢��ɨ���¼
function check_uid($uid,$event_key,$time){
	if($time>500){
		return false;
	}else{
		if($uid>0){
			return true;
		}else{
			++$time;
			usleep(100);
			$content = "";
			if(file_exists(QISHI_ROOT_PATH."data/weixin/".$event_key.".txt")){
				$content = file_get_contents(QISHI_ROOT_PATH."data/weixin/".$event_key.".txt");
			}
			$uid = intval($content);
			check_uid($uid,$event_key,$time);
		}
	}
	
}
function weixin_login($openid,$uid,$event_key){
	global $QS_cookiepath,$QS_cookiedomain,$_CFG;
	$u=get_user_by_weixinopenid($openid,$uid);
	if (!empty($u))
	{
		if(file_exists(QISHI_ROOT_PATH."data/weixin/".$event_key.".txt")){
			ini_set('session.save_handler', 'files');
			session_save_path(QISHI_ROOT_PATH.'data/sessions/');
			session_start();
			$fp = @fopen(QISHI_ROOT_PATH . 'data/weixin/'.$event_key.'.txt', 'wb+');
			@fwrite($fp, $uid);
			@fclose($fp);
			$find = array("http://","/wap");
			$replace = array("");
			$QS_cookiedomain = str_replace($find,$replace,$_CFG['wap_domain']);
			unset($_SESSION['uid']);
			unset($_SESSION['username']);
			unset($_SESSION['utype']);
			unset($_SESSION['uqqid']);
			setcookie("QS[uid]","",time() - 3600,$QS_cookiepath, $QS_cookiedomain);
			setcookie("QS[username]","",time() - 3600,$QS_cookiepath, $QS_cookiedomain);
			setcookie("QS[password]","",time() - 3600,$QS_cookiepath, $QS_cookiedomain);
			setcookie("QS[utype]","",time() - 3600,$QS_cookiepath, $QS_cookiedomain);
			unset($_SESSION['activate_username']);
			unset($_SESSION['activate_email']);
			
			$_SESSION['uid']=$u['uid'];
			$_SESSION['username']=$u['username'];
			$_SESSION['utype']=$u['utype'];
			$_SESSION['uqqid']="1";
			setcookie('QS[uid]',$u['uid'],0,$QS_cookiepath,$QS_cookiedomain);
			setcookie('QS[username]',$u['username'],0,$QS_cookiepath,$QS_cookiedomain);
			setcookie('QS[password]',$u['password'],0,$QS_cookiepath,$QS_cookiedomain);
			setcookie('QS[utype]',$u['utype'], 0,$QS_cookiepath,$QS_cookiedomain);
		}
	}
}
function get_user_by_weixinopenid($openid,$uid){
	global $db;
	$usinfo = $db->getone("select * from ".table('members')." where weixin_openid='".$openid."' and uid='".$uid."'");
	return $usinfo;
}
function get_user_by_uid($uid){
	global $db;
	$usinfo = $db->getone("select * from ".table('members')." where uid='".$uid."'");
	return $usinfo;
}
unset($smarty);
?>