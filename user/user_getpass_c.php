<?php
//��ҵ�һ�����--ffff
define('IN_QISHI', true);
require_once(dirname(__FILE__).'/../include/common.inc.php');
// echo $dopost;exit;
// echo '111';exit; 
$dopost=$_GET['dopost'];	
if(!isset($dopost)) $dopost = 'step1';

if($dopost=='step1'){
	//ģ��---
	// echo 'okjinru';exit;
	$smarty->display("/user/getpass_c.htm");
	exit();
}if($dopost=='step2'){
	// echo 'step2ok';exit; 
	require_once(QISHI_ROOT_PATH.'include/mysql.class.php');
	$db = new mysql($dbhost,$dbuser,$dbpass,$dbname);
	// require_once(dirname(__FILE__)."/../config.php");
	//require_once(QISHI_ROOT_PATH."/include/bb_duanxin.class.php"); 	//������
		if(!empty($_POST['email'])){
			$email=trim($_POST['email']);
			//--ffff��֤�����ʽ
			$pattern = "/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i";
			if ( preg_match( $pattern, $email ) )
			{
			//---fff
			$user = $db->getone("SELECT * FROM `qs_members` WHERE email = '$email' and utype=1 ");
			//var_dump($user);exit;
			if(!empty($user)){
				//echo "<pre>";print_r($user);exit;
				//$mima=mt_rand(100000,999999);
				$mima=getRandomString(6);
				$pwd=MD5($mima);
				$query1 = "UPDATE `qs_members` SET password='$pwd' where email='".$email."' ";
				if($db->query($query1)){
				require_once(dirname(__FILE__).'/../include/common.inc.php');
					if ($_SESSION['sendemail_time'] && (time()-$_SESSION['sendemail_time'])<10)
					{
					exit("��60����ٽ����һأ�");
					}
			
					if (smtp_mail($email,"{$_CFG['site_name']}�ʼ��һ�����","{$QISHI['site_name']}��������<br>�����ڽ��������һ����룬���������Ϊ:<strong>".$mima."</strong>"))
					{//---���ͳɹ�
						showmsg("�����޸ĳɹ�������Ϊ���6λ�����Ժ������������ķ�ʽ���͸�����",2);
						//showmsg('�����޸ĳɹ�������Ϊ���6λ�����Ժ�������Զ��ŵķ�ʽ���͸����� ', '/home/', 0,5000);
						exit();
					}
					else
					{
					exit("�������ó�������ϵ��վ����Ա");
					}
					
				}else{
					showmsg('�����޸�ʧ�ܣ� ', '2');
					exit();
				}
				
			}else{
				showmsg('û���ҵ������˻��������ԣ� ', '2');
				exit();
			}
			
			}else{
				showmsg('�����ʽ����,��������ȷ�����䣡 ', '2');
				exit();
			}
		}else{
			showmsg('���䲻��Ϊ��,���������䣡 ', '2');
			exit();
		}
	
}