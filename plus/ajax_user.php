<?php
 /*
 * 74cms ajax����
 * ============================================================================
 * ��Ȩ����: ��ʿ���磬����������Ȩ����
 * ��վ��ַ: http://www.74cms.com��
 * ----------------------------------------------------------------------------
 * �ⲻ��һ�������������ֻ���ڲ�������ҵĿ�ĵ�ǰ���¶Գ����������޸ĺ�
 * ʹ�ã�������Գ���������κ���ʽ�κ�Ŀ�ĵ��ٷ�����
 * ============================================================================
*/
define('IN_QISHI', true);
require_once(dirname(dirname(__FILE__)).'/include/plus.common.inc.php');
$act = !empty($_REQUEST['act']) ? trim($_REQUEST['act']) : '';
if($act =='do_login')
{
	$username=isset($_POST['username'])?trim($_POST['username']):"";
	$password=isset($_POST['password'])?trim($_POST['password']):"";
	$expire=isset($_POST['expire'])?intval($_POST['expire']):"";
	$account_type=1;
	if (preg_match("/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/",$username))
	{
	$account_type=2;
	}
	elseif (preg_match("/^(13|15|14|17|18)\d{9}$/",$username))
	{
	//$account_type=3;
	$account_type=1;
	}
	$url=isset($_POST['url'])?$_POST['url']:"";
	
	if (strcasecmp(QISHI_DBCHARSET,"utf8")!=0)
	{
	$username=utf8_to_gbk($username);
	$password=utf8_to_gbk($password);
	}
	$captcha=get_cache('captcha');
	if ($captcha['verify_userlogin']=="1")
	{
		$postcaptcha=$_POST['postcaptcha'];
		if ($captcha['captcha_lang']=="cn" && strcasecmp(QISHI_DBCHARSET,"utf8")!=0)
		{
		$postcaptcha=utf8_to_gbk($postcaptcha);
		}
		if (empty($postcaptcha) || empty($_SESSION['imageCaptcha_content']) || strcasecmp($_SESSION['imageCaptcha_content'],$postcaptcha)!=0)
		{
		unset($_SESSION['imageCaptcha_content']);
		exit("errcaptcha");
		}
	}
	
	require_once(QISHI_ROOT_PATH.'include/fun_user.php');
	if ($username && $password)
	{
		//echo $account_type;exit;
		$login=user_login($username,$password,$account_type,true,$expire);
		//echo "<pre>";print_r($login);echo $login['qs_login'];
		
		$url=$url?$url:$login['qs_login'];
		//echo $url;exit;
		
		if ($login['qs_login'])
		{
		exit($login['uc_login']."<script language=\"javascript\" type=\"text/javascript\">window.location.href=\"".$url."\";</script>");
		}
		else
		{
		exit("err");
		}
	}
	exit("err");
}
elseif ($act=='do_reg')
{
	$captcha=get_cache('captcha');
	if ($captcha['verify_userreg']=="1")
	{
		$postcaptcha=$_POST['postcaptcha'];
		if ($captcha['captcha_lang']=="cn" && strcasecmp(QISHI_DBCHARSET,"utf8")!=0)
		{
		$postcaptcha=utf8_to_gbk($postcaptcha);
		}
		if (empty($postcaptcha) || empty($_SESSION['imageCaptcha_content']) || strcasecmp($_SESSION['imageCaptcha_content'],$postcaptcha)!=0)
		{
		exit("err");
		}
	}
	
	require_once(QISHI_ROOT_PATH.'include/fun_user.php');
	$member_type = isset($_POST['member_type'])?intval($_POST['member_type']):exit("err");
	
	
	if($member_type == 1){//--��ҵ
	$username = isset($_POST['username'])?trim($_POST['username']):exit("err");
	$password = isset($_POST['password'])?trim($_POST['password']):exit("err");
	$email = isset($_POST['email'])?trim($_POST['email']):exit("err");
	//------���۾���
	$xs_user = $_POST['xs_user'];
	$xs_user= utf8_to_gbk($xs_user);
	$companyname=isset($_POST['companyname'])?trim($_POST['companyname']):exit("err");
	$companyname= utf8_to_gbk($companyname);
	//----���۾���
	//-----����
	
	$district=isset($_POST['district'])?intval($_POST['district']):exit("err");
	$sdistrict=isset($_POST['sdistrict'])?intval($_POST['sdistrict']):exit("err");
	$district_cn=isset($_POST['district_cn'])?trim($_POST['district_cn']):exit("err");
	$district_cn= utf8_to_gbk($district_cn);
	//-----��������
	}
	
	if($member_type == 2){//--------����ע���ֶ�
	$mobile_verifycode=trim($_POST['mobile_verifycode'])?trim($_POST['mobile_verifycode']):showmsg('����д��֤��',1);
	// var_dump($_POST);exit;
	// echo $mobile_verifycode.'zwl5';exit;
	// echo $_SESSION['mobile_rand'];exit;
	if($mobile_verifycode){
		if (empty($_SESSION['mobile_rand']) || $mobile_verifycode<>$_SESSION['mobile_rand'])
		{
			showmsg("�ֻ���֤�����",1);
		}
		else
		{
			// $verifysqlarr['mobile'] = $setsqlarr['phone'];
			// $verifysqlarr['mobile_audit'] = 1;
			// updatetable(table('members'),$verifysqlarr," uid='{$setsqlarr['uid']}'");
			// unset($verifysqlarr);
		}
	}
	$username = isset($_POST['username_1'])?trim($_POST['username_1']):exit("err");
	$password=trim(substr($username,-4));
	$sex=isset($_POST['sex'])?intval($_POST['sex']):exit("err");
	$sex_cn=isset($_POST['sex_cn'])?trim($_POST['sex_cn']):exit("err");
	$sex_cn= utf8_to_gbk($sex_cn);
	$realname=isset($_POST['realname'])?trim($_POST['realname']):exit("err");
	$realname= utf8_to_gbk($realname);
	$birthday=isset($_POST['birthday'])?intval($_POST['birthday']):exit("err");
	$residence=isset($_POST['residence'])?$_POST['residence']:exit("err");
	$residence_cn=isset($_POST['residence_cn'])?trim($_POST['residence_cn']):exit("err");
	$residence_cn= utf8_to_gbk($residence_cn);
	}
	///-----
	
	//--fffff��ѵ��Աע��---��ʼ
	if($member_type == 4){//--��ҵ
	$username = isset($_POST['username'])?trim($_POST['username']):exit("err");
	$password = isset($_POST['password'])?trim($_POST['password']):exit("err");
	$email = isset($_POST['email'])?trim($_POST['email']):exit("err");

	$trainname=isset($_POST['trainname'])?trim($_POST['trainname']):exit("err");
	$trainname= utf8_to_gbk($trainname);
	//-----����
	$district=isset($_POST['district'])?intval($_POST['district']):exit("err");
	$sdistrict=isset($_POST['sdistrict'])?intval($_POST['sdistrict']):exit("err");
	$district_cn=isset($_POST['district_cn'])?trim($_POST['district_cn']):exit("err");
	$district_cn= utf8_to_gbk($district_cn);
	
	//-----��������
	}
	//--fffff��ѵ��Աע��---����
	///-----
	$subsite_id = isset($_POST['subsite_id'])?intval($_POST['subsite_id']):'';
	if (strcasecmp(QISHI_DBCHARSET,"utf8")!=0)
	{
	$username=utf8_to_gbk($username);
	$password=utf8_to_gbk($password);
	}
		/*if(defined('UC_API'))
		{
			include_once(QISHI_ROOT_PATH.'uc_client/client.php');
			if (uc_user_checkname($username)<0)
			{
			exit("err");
			}
			if (uc_user_checkemail($email)<0)
			{
			exit("err");
			}
		}*/
	$register=user_register($username,$password,$member_type,$email,true,$xs_user,$district_cn,$district,$sdistrict,$sex,$sex_cn,$realname,$birthday,$residence,$residence_cn,$companyname,$trainname,$subsite_id);
	//�����û�ע��ɹ����Ͷ��ſ�ʼ By Z
	if ($register>0 && $member_type==2){
		require_once(QISHI_ROOT_PATH.'include/msg_reg.php');
	}
	//�����û�ע��ɹ����Ͷ��Ž��� By Z
	if ($register>0)
	{	
		$login_js=user_login($username,$password);
		$mailconfig=get_cache('mailconfig');
		if ($mailconfig['set_reg']=="1")
		{
		dfopen($_CFG['website_dir']."plus/asyn_mail.php?uid=".$_SESSION['uid']."&key=".asyn_userkey($_SESSION['uid'])."&sendemail=".$email."&sendusername=".$username."&sendpassword=".$password."&act=reg");
		}
		$ucjs=$login_js['uc_login'];
		$qsurl=$login_js['qs_login'];
		$qsjs="<script language=\"javascript\" type=\"text/javascript\">window.location.href=\"".$qsurl."\";</script>";
		 if ($ucjs || $qsurl)
			{
			exit($ucjs.$qsjs);
			}
			else
			{
			exit("err");
			}
	}
	else
	{
	exit("err");
	}
}
elseif($act =='check_usname')
{
	require_once(QISHI_ROOT_PATH.'include/fun_user.php');
	$usname=trim($_POST['usname']);
	if (strcasecmp(QISHI_DBCHARSET,"utf8")!=0)
	{
	$usname=utf8_to_gbk($usname);
	}
	$user=get_user_inusername($usname);
	if (defined('UC_API'))
	{
		include_once(QISHI_ROOT_PATH.'uc_client/client.php');
		if (uc_user_checkname($usname)===1 && empty($user))
		{
		exit("true");
		}
		else
		{
		exit("false");
		}
	}
	empty($user)?exit("true"):exit("false");
}
//---fff----��֤��˾����
elseif($act =='check_companyname')
{
	require_once(QISHI_ROOT_PATH.'include/fun_user.php');
	$companyname=trim($_POST['companyname']);
	if (strcasecmp(QISHI_DBCHARSET,"utf8")!=0)
	{
	$companyname=utf8_to_gbk($companyname);
	}
	$user=get_user_companyname($companyname);
	if (defined('UC_API'))
	{
		include_once(QISHI_ROOT_PATH.'uc_client/client.php');
		if (uc_user_checkcompanyname($companyname)===1 && empty($user))
		{
		exit("true");
		}
		else
		{
		exit("false");
		}
	}
	empty($user)?exit("true"):exit("false");
}
//------��ѵ��Ա
elseif($act =='check_trainname')
{
	require_once(QISHI_ROOT_PATH.'include/fun_user.php');
	$trainname=trim($_POST['trainname']);
	if (strcasecmp(QISHI_DBCHARSET,"utf8")!=0)
	{
	$trainname=utf8_to_gbk($trainname);
	}
	$user=get_user_trainname($trainname);
	if (defined('UC_API'))
	{
		include_once(QISHI_ROOT_PATH.'uc_client/client.php');
		if (uc_user_checkcompanyname($trainname)===1 && empty($user))
		{
		exit("true");
		}
		else
		{
		exit("false");
		}
	}
	empty($user)?exit("true"):exit("false");
}
//---fff
elseif($act == 'check_email')
{
	require_once(QISHI_ROOT_PATH.'include/fun_user.php');
	$email=trim($_POST['email']);
	if (strcasecmp(QISHI_DBCHARSET,"utf8")!=0)
	{
	$email=utf8_to_gbk($email);
	}
	$user=get_user_inemail($email);
	if (defined('UC_API'))
	{
		include_once(QISHI_ROOT_PATH.'uc_client/client.php');
		if (uc_user_checkemail($email)===1 && empty($user))
		{
		exit("true");
		}
		else
		{
		exit("false");
		}
	}
	empty($user)?exit("true"):exit("false");
}
//----����
/*elseif($act == 'realname'){require_once(QISHI_ROOT_PATH.'include/fun_user.php');
	$realname=trim($_POST['realname']);
	if (strcasecmp(QISHI_DBCHARSET,"utf8")!=0)
	{
	$realname=utf8_to_gbk($realname);
	}
	$user=get_user_inrealname($realname);
	if (defined('UC_API'))
	{
		include_once(QISHI_ROOT_PATH.'uc_client/client.php');
		if (uc_user_checkemail($email)===1 && empty($user))
		{
		exit("true");
		}
		else
		{
		exit("false");
		}
	}
	empty($user)?exit("true"):exit("false");}*/
elseif ($act=="top_loginform")
{
	$contents='';
	if ($_COOKIE['QS']['username'] && $_COOKIE['QS']['password'])
	{
		//$contents='��ӭ&nbsp;&nbsp;<a href="{#$user_url#}" style="color:#339900">{#$username#}</a> ��¼��&nbsp;&nbsp;{#$pmscount_a#}&nbsp;&nbsp;&nbsp;&nbsp;<a href="{#$user_url#}" style="color:#0066cc">[��Ա����]</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="{#$logout_url#}" style="color:#0066cc">[�˳�]</a>';
		if ($_COOKIE['QS']['utype']=='2')//--����
			{
			$contents='<div class="fr htnav"><ul id="hyzxnav">	
						<li><a href="/user/personal/personal_index.php"><span>{#$username#}</span><i class="fa fa-sort-desc"></i></a>
                        <ul>
							<li><a href="/user/personal/personal_index.php" _fcksavedurl="{#$user_url#}">��Ա����</a></li>
                            <li><a href="/user/personal/personal_resume.php?act=resume_list" _fcksavedurl="personal_resume.php?act=resume_list">�ҵļ���</a></li> 
                            <li><a href="/user/personal/personal_apply.php?act=favorites" _fcksavedurl="personal_apply.php?act=favorites">�ղؼ�</a></li> 
                            <li><a href="/user/personal/personal_apply.php?act=apply_jobs" _fcksavedurl="personal_apply.php?act=apply_jobs">�������ְλ</a></li>
                            <li><a href="/user/personal/personal_apply.php?act=my_attention" _fcksavedurl="personal_apply.php?act=my_attention">�������ְλ</a></li>
                            <li><a href="/user/personal/personal_user.php?act=userprofile" _fcksavedurl="personal_user.php?act=userprofile">��������</a></li> 
                            <li><a href="{#$logout_url#}" _fcksavedurl="{#$logout_url#}">�˳�</a></li> 
                        </ul> 
                    </li></ul></div>';
		}
	if ($_COOKIE['QS']['utype']=='1')//--��ҵ
		{
			$contents='<div class="fr htnav"><ul id="hyzxnav">
						<li><a href="/user/company/company_index.php" _fcksavedurl="#"><span>{#$username#}</span><i class="fa fa-sort-desc"></i></a>
                        <ul>
							<li><a href="/user/company/company_index.php" _fcksavedurl="{#$user_url#}">��Ա����</a></li>
                            <li><a href="/user/company/company_jobs.php?act=addjobs" _fcksavedurl="company_jobs.php?act=addjobs">����ְλ</a></li> 
                            <li><a href="/user/company/company_info.php?act=company_profile" _fcksavedurl="company_info.php?act=company_profile">������Ϣ</a></li> 
                            <li><a href="/user/company/company_jobfair.php?act=jobfair" _fcksavedurl="company_jobfair.php?act=jobfair">չλԤ��</a></li> 
                            <li><a href="/user/company/company_jobfair.php?act=mybooth" _fcksavedurl="company_jobfair.php?act=mybooth">�ҵ�Ԥ��</a></li>
                            <li><a href="{#$logout_url#}" _fcksavedurl="{#$logout_url#}">�˳�</a></li> 
                        </ul> 
                    </li></ul></div>';
		}
		//----ffffff---��ѵ��Ա
		if ($_COOKIE['QS']['utype']=='4')//--��ѵ��Ա
		{
			$contents='<div class="fr htnav"><ul id="hyzxnav">
						<li><a href="{#$user_url#}" _fcksavedurl="#"><span>{#$username#}</span><i class="fa fa-sort-desc"></i></a>
                        <ul>
							<li><a href="{#$user_url#}" _fcksavedurl="{#$user_url#}">��Ա����</a></li>
                            <li><a href="/user/train/train_course.php?act=addcourse" _fcksavedurl="/user/train/train_course.php?act=addcourse">�����γ�</a></li> 
                            <li><a href="/user/train/train_teacher.php?act=add_teachers" _fcksavedurl="/user/train/train_teacher.php?act=add_teachers">��ӽ�ʦ</a></li> 
                            <li><a href="/user/train/train_info.php?act=train_profile" _fcksavedurl="/user/train/train_info.php?act=train_profile">��������</a></li> 
                            <li><a href="/user/train/train_user.php?act=password_edit" _fcksavedurl="/user/train/train_user.php?act=password_edit">�޸�����</a></li>
                            <li><a href="{#$logout_url#}" _fcksavedurl="{#$logout_url#}">�˳�</a></li> 
                        </ul> 
                    </li></ul></div>';
		}
		//--ffffff
		if ($_COOKIE['QS']['utype']=='5')//--���Ա
		{
			$contents='<div class="fr htnav"><ul id="hyzxnav">
						<li><a href="{#$user_url#}" _fcksavedurl="#"><span>{#$username#}</span><i class="fa fa-sort-desc"></i></a>
                        <ul>
							<li><a href="{#$user_url#}" _fcksavedurl="{#$user_url#}">��Ա����</a></li>
                            <li><a href="/user/shenhe/shenhe_jobs.php?act=addjobs" _fcksavedurl="/user/shenhe/shenhe_jobs.php?act=addjobs">������ҵ����</a></li> 
                            <li><a href="/user/shenhe/shenhe_jobs.php?act=jobs" _fcksavedurl="user/shenhe/shenhe_jobs.php?act=jobs">��ҵ�������</a></li> 
                            <li><a href="/user/shenhe/shenhe_company.php?act=shenhe_company_list&audit=" _fcksavedurl="/user/shenhe/shenhe_company.php?act=shenhe_company_list&audit=">��ҵ��Ա���</a></li> 
                            <li><a href="/user/shenhe/shenhe_company_jobs.php?act=sheneh_company_jobs" _fcksavedurl="user/shenhe/shenhe_company_jobs.php?act=sheneh_company_jobs">ְλ���</a></li>
                            <li><a href="{#$logout_url#}" _fcksavedurl="{#$logout_url#}">�˳�</a></li> 
                        </ul> 
                    </li></ul></div>';
		}
	}
	elseif ($_SESSION['activate_username'] && defined('UC_API'))
	{
		$contents=' &nbsp;&nbsp;�����ʺ� {#$activate_username#} �輤���ſ���ʹ�ã� <a href="{#$activate_url#}" style="color:#339900">��������</a>';
	}
	else
	{	
		//$contents='��ӭ����{#$site_name#}��&nbsp;&nbsp;&nbsp;&nbsp;<a href="{#$login_url#}" style="color:#0066cc" >[��¼]</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="{#$reg_url#}" style="color:#0066cc">[���ע��]</a>';
		$contents='<div class="login fr">
            <ul>
                <li><a href="/user/login.php">��¼</a></li>
                    <li><a href="/user/user_reg.php">ע��</a></li>
                    <li class="mobile"><a href="#"><i class="fa fa-mobile"></i>�ֻ�Ҽ��</a>
                    	<div class="app">
                        	<i class="fa fa-sort-asc"></i>
                        	<img src="/files/img/app.jpg" alt="" title="Ҽ�����ͻ���" />
                        </div>
                    </li></ul></div>';
	}
		$contents=str_replace('{#$activate_username#}',$_SESSION['activate_username'],$contents);
		$contents=str_replace('{#$site_name#}',$_CFG['site_name'],$contents);
		$contents=str_replace('{#$username#}',$_COOKIE['QS']['username'],$contents);
		$contents=str_replace('{#$pmscount#}',$_COOKIE['QS']['pmscount'],$contents);
		$contents=str_replace('{#$site_template#}',$_CFG['site_template'],$contents);
		if ($_COOKIE['QS']['utype']=='1')//--��ҵ
		{
		$user_url=$_CFG['main_domain']."user/company/company_index.php";
			if($_COOKIE['QS']['pmscount']>0)
			 {
			 $pmscount_a='<a href="'.$_CFG['main_domain'].'user/company/company_user.php?act=pm&new=1" style="padding:1px 4px; background-color:#FF6600; color:#FFFFFF;text-decoration:none" title="����Ϣ">��Ϣ '.$_COOKIE['QS']['pmscount'].'</a>';
			 }
		}
		if ($_COOKIE['QS']['utype']=='2')//--����
		{
			$user_url=$_CFG['main_domain']."user/personal/personal_index.php";
			if($_COOKIE['QS']['pmscount']>0)
			 {
			 $pmscount_a='<a href="'.$_CFG['main_domain'].'user/personal/personal_user.php?act=pm&new=1" style="padding:1px 4px; background-color:#FF6600; color:#FFFFFF;text-decoration:none" title="����Ϣ">��Ϣ '.$_COOKIE['QS']['pmscount'].'</a>';
			 }
		}
		if ($_COOKIE['QS']['utype']=='4')
		{
			//$user_url=$_CFG['main_domain']."user/train/train_index.php";
			$user_url="/user/train/train_index.php";
			if($_COOKIE['QS']['pmscount']>0)
			 {
			 $pmscount_a='<a href="'.$_CFG['main_domain'].'user/train/train_user.php?act=pm&new=1" style="padding:1px 4px; background-color:#FF6600; color:#FFFFFF;text-decoration:none" title="����Ϣ">��Ϣ '.$_COOKIE['QS']['pmscount'].'</a>';
			 }
		}
		if ($_COOKIE['QS']['utype']=='3')
		{
			$user_url=$_CFG['main_domain']."user/hunter/hunter_index.php";
			if($_COOKIE['QS']['pmscount']>0)
			 {
			 $pmscount_a='<a href="'.$_CFG['main_domain'].'user/hunter/hunter_user.php?act=pm&new=1" style="padding:1px 4px; background-color:#FF6600; color:#FFFFFF;text-decoration:none" title="����Ϣ">��Ϣ '.$_COOKIE['QS']['pmscount'].'</a>';
			 }
		}
		if ($_COOKIE['QS']['utype']=='5')//--���Ա
		{
		$user_url=$_CFG['main_domain']."user/shenhe/shenhe_index.php";
			if($_COOKIE['QS']['pmscount']>0)
			 {
			 $pmscount_a='<a href="'.$_CFG['main_domain'].'user/company/company_user.php?act=pm&new=1" style="padding:1px 4px; background-color:#FF6600; color:#FFFFFF;text-decoration:none" title="����Ϣ">��Ϣ '.$_COOKIE['QS']['pmscount'].'</a>';
			 }
		}
		$contents=str_replace('{#$pmscount_a#}',$pmscount_a,$contents);
		$contents=str_replace('{#$user_url#}',$user_url,$contents);
		$contents=str_replace('{#$login_url#}',url_rewrite('QS_login',NULL,false),$contents);
		$contents=str_replace('{#$logout_url#}',url_rewrite('QS_login',NULL,false)."?act=logout",$contents);
		$contents=str_replace('{#$reg_url#}',$_CFG['main_domain']."user/user_reg.php",$contents);
		$contents=str_replace('{#$activate_url#}',$_CFG['main_domain']."user/user_reg.php?act=activate",$contents);
		exit($contents);
}
elseif ($act=="loginform")
{
	$contents='';
	if ($_COOKIE['QS']['username'] && $_COOKIE['QS']['password'])
	{
		$tpl='../templates/'.$_CFG['template_dir']."plus/login_success.htm";
	}
	elseif ($_SESSION['activate_username'] && defined('UC_API'))
	{
		$tpl='../templates/'.$_CFG['template_dir']."plus/login_activate.htm";
	}
	else
	{
		$tpl='../templates/'.$_CFG['template_dir']."plus/login_form.htm";
	}
		$contents=file_get_contents($tpl);
		$contents=str_replace('{#$activate_username#}',$_SESSION['activate_username'],$contents);
		$contents=str_replace('{#$site_name#}',$_CFG['site_name'],$contents);
		$contents=str_replace('{#$username#}',$_COOKIE['QS']['username'],$contents);
		$contents=str_replace('{#$pmscount#}',$_COOKIE['QS']['pmscount'],$contents);
		$contents=str_replace('{#$site_template#}',$_CFG['site_template'],$contents);
		$contents=str_replace('{#$website_dir#}',$_CFG['website_dir'],$contents);
		if ($_COOKIE['QS']['utype']=='1')
		{
			$user_url=$_CFG['main_domain']."user/company/company_index.php";
			 if($_COOKIE['QS']['pmscount']>0)
			 {
			 $pmscount_a='<a href="'.$_CFG['main_domain'].'user/company/company_user.php?act=pm&new=1" style="padding:1px 4px; background-color:#FF6600; color:#FFFFFF;text-decoration:none" title="����Ϣ">��Ϣ '.$_COOKIE['QS']['pmscount'].'</a>';
			 }
		}
		if ($_COOKIE['QS']['utype']=='2')
		{
			$user_url=$_CFG['main_domain']."user/personal/personal_index.php";
			 if($_COOKIE['QS']['pmscount']>0)
			 {
			 $pmscount_a='<a href="'.$_CFG['main_domain'].'user/personal/personal_user.php?act=pm&new=1" style="padding:1px 4px; background-color:#FF6600; color:#FFFFFF;text-decoration:none" title="����Ϣ">��Ϣ '.$_COOKIE['QS']['pmscount'].'</a>';
			 }
		}
		if ($_COOKIE['QS']['utype']=='4')
		{
			$user_url=$_CFG['main_domain']."user/train/train_index.php";
			 if($_COOKIE['QS']['pmscount']>0)
			 {
			 $pmscount_a='<a href="'.$_CFG['main_domain'].'user/train/train_user.php?act=pm&new=1" style="padding:1px 4px; background-color:#FF6600; color:#FFFFFF;text-decoration:none" title="����Ϣ">��Ϣ '.$_COOKIE['QS']['pmscount'].'</a>';
			 }
		}
		if ($_COOKIE['QS']['utype']=='3')
		{
			$user_url=$_CFG['main_domain']."user/hunter/hunter_index.php";
			 if($_COOKIE['QS']['pmscount']>0)
			 {
			 $pmscount_a='<a href="'.$_CFG['main_domain'].'user/hunter/hunter_user.php?act=pm&new=1" style="padding:1px 4px; background-color:#FF6600; color:#FFFFFF;text-decoration:none" title="����Ϣ">��Ϣ '.$_COOKIE['QS']['pmscount'].'</a>';
			 }
		}
		$contents=str_replace('{#$pmscount_a#}',$pmscount_a,$contents);
		$contents=str_replace('{#$user_url#}',$user_url,$contents);
		$contents=str_replace('{#$login_url#}',url_rewrite('QS_login',NULL,false),$contents);
		$contents=str_replace('{#$logout_url#}',url_rewrite('QS_login',NULL,false)."?act=logout",$contents);
		$contents=str_replace('{#$reg_url#}',$_CFG['main_domain']."user/user_reg.php",$contents);
		$contents=str_replace('{#$activate_url#}',$_CFG['main_domain']."user/user_reg.php?act=activate",$contents);
		exit($contents);
}elseif($act =="bottom_date_up"){
	$time=time();
	$date_up=date('Y-m-d H:i:s',$time);
	exit($date_up);
}
?>