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
if ($act=='qx_baoming')
{
	require_once(QISHI_ROOT_PATH.'include/fun_qx.php');
	//$name = !empty($_POST['name'])?trim($_POST['name']):exit('<h2><i class="fa fa-smile-o"></i>��û����д����<a onclick="history.back()">����</a></h2>');
	
	$name= utf8_to_gbk(trim($_POST['name']));
	$sex=trim($_POST['sex']);
	$sex= utf8_to_gbk($sex);
	$height= utf8_to_gbk(trim($_POST['height']));
	$weight= intval($_POST['weight']);
	$phone= intval($_POST['phone']);
	$brithday=utf8_to_gbk($_POST['brithday']);
	$depratment= utf8_to_gbk(trim($_POST['depratment']));
	$home= utf8_to_gbk(trim($_POST['home']));
	$hobby= utf8_to_gbk(trim($_POST['hobby']));
	$selected= utf8_to_gbk(trim($_POST['selected']));

	$register=user_register($name,$sex,$height,true,$weight,$phone,$brithday,$depratment,$home,$hobby,$selected);
	//�����û�ע��ɹ����Ͷ��ſ�ʼ By Z
	/*if ($register>0 && $member_type==2){
		require_once(QISHI_ROOT_PATH.'include/msg_reg.php');
	}*/
	//�����û�ע��ɹ����Ͷ��Ž��� By Z
	
	//----�ж��Ƿ�����
	/*$sql = "select * from zt_qx_baoming where name = '{$name}' LIMIT 1";
	$res=$db->getone($sql);
	if($res){$html='<h2><i class="fa fa-smile-o"></i>'.$name.'����ʧ�ܣ����Ѿ�������</h2>';}*/
	//----
	/*if(empty($name) || empty($sex) || empty($height) || empty($weight) || empty($phone) || empty($brithday) || empty($depratment) || empty($hobby) || empty($selected))
	{
		$html='<h2><i class="fa fa-smile-o"></i>'.$name.'����ʧ�ܣ���Ϣ��д��������</h2>';
		exit($html);
	}*/
	if ($register>0)
	{
		$html='<h2><i class="fa fa-smile-o"></i>����,<span style="color:#333;">'.$name.'</span>�����ɹ�����л���Ĳ��룡����</h2>';
		exit($html);
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
		$html='<h2><i class="fa fa-smile-o"></i>'.$name.'����ʧ�ܣ��п������Ѿ�������</h2>';
		exit($html);
	}
}
//---------��Ϧ����
elseif($act=='qx_msg')
{
	require_once(QISHI_ROOT_PATH.'include/fun_qx.php');
	$to= utf8_to_gbk(trim($_POST['to']));
	$contents= utf8_to_gbk(trim($_POST['contents']));
	$from= utf8_to_gbk(trim($_POST['from']));
	$addtime=time();
	$bg= utf8_to_gbk(trim($_POST['bg']));
	//exit($bg);
	$register=qx_register($to,$contents,$from,true,$addtime,$bg);
	//exit($register);
	if ($register>0)
	{
		//$url='http://www.1dagong.com/zt/qixi/index.php?act=chakan&id='.$register;
		//$html='<div>����·��������Ӹ����İ�����(��)</div><h2 style="text-align:center;"><i class="fa fa-smile-o"></i><a href="'.$url.'">����鿴</a><br><input onclick="oCopy(this)"  value="'.$url.'" /> ';
		$html='<img src="/plus/url_qrcode_qx.php?url=http://www.1dagong.com/zt/qixi/index.php?id='.$register.'&act=chakan" alt="��ά��" style=" position: relative;left: 50%;margin-left: -135px;" ></img><br><p style="text-align:center;">�����Ϸ���ά�뱣��ͼƬ<br>ת�����Ŷ�ά������ǵ�TA��</p>';
		exit($html);
	}
}
elseif ($act=='qx_xuanyan')
{
	
	require_once(QISHI_ROOT_PATH.'include/fun_qx.php');
	//$name = !empty($_POST['name'])?trim($_POST['name']):exit('<h2><i class="fa fa-smile-o"></i>��û����д����<a onclick="history.back()">����</a></h2>');
	
	$name= utf8_to_gbk(trim($_POST['name']));
	$gonghao=trim($_POST['gonghao']);
	$gonghao= utf8_to_gbk($gonghao);
	$contents= utf8_to_gbk(trim($_POST['contents']));
	$phone= intval($_POST['phone']);
	
	$register_1=set_xuanyan($name,$gonghao,$contents,true,$phone);
	//�����û�ע��ɹ����Ͷ��ſ�ʼ By Z
	/*if ($register>0 && $member_type==2){
		require_once(QISHI_ROOT_PATH.'include/msg_reg.php');
	}*/
	//�����û�ע��ɹ����Ͷ��Ž��� By Z
	
	//----�ж��Ƿ�����
	/*$sql = "select * from zt_qx_baoming where name = '{$name}' LIMIT 1";
	$res=$db->getone($sql);
	if($res){$html='<h2><i class="fa fa-smile-o"></i>'.$name.'����ʧ�ܣ����Ѿ�������</h2>';}*/
	//----
	/*if(empty($name) || empty($sex) || empty($height) || empty($weight) || empty($phone) || empty($brithday) || empty($depratment) || empty($hobby) || empty($selected))
	{
		$html='<h2><i class="fa fa-smile-o"></i>'.$name.'����ʧ�ܣ���Ϣ��д��������</h2>';
		exit($html);
	}*/
	if ($register_1>0)
	{
		$html='<h2>�ܰ��İ������ԣ���Ϊ��������Ե���ϣ�</h2>
            <p>��л���Ĳ��룬���ѻ����Ե�����˳齱��齱����</p>
            <p>����������8��19��12:00  ��������Ե��ҳ�档</p>';
		exit($html);
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
		$html='<h2><i class="fa fa-smile-o"></i>'.$name.'����ʧ�ܣ�</h2>';
		exit($html);
	}
}
//---fff----����Ա
elseif ($act=='bm_tiyan')
{
	
	require_once(QISHI_ROOT_PATH.'include/fun_qx.php');
	//$name = !empty($_POST['name'])?trim($_POST['name']):exit('<h2><i class="fa fa-smile-o"></i>��û����д����<a onclick="history.back()">����</a></h2>');
	$name= utf8_to_gbk(trim($_POST['name']));
	$age=utf8_to_gbk($_POST['age']);
	$typeid= intval($_POST['typeid']);
	$uid= intval($_POST['uid']);
	$work= utf8_to_gbk(trim($_POST['work']));
	$phone= $_POST['phone'];
	//echo $uid;echo $phone;exit;
	$register_1=bm_tiyanyuan($name,$age,$work,true,$phone,$typeid,$uid);
	//�����û�ע��ɹ����Ͷ��ſ�ʼ By Z
	/*if ($register>0 && $member_type==2){
		require_once(QISHI_ROOT_PATH.'include/msg_reg.php');
	}*/
	//�����û�ע��ɹ����Ͷ��Ž��� By Z
	
	//----�ж��Ƿ�����
	/*$sql = "select * from zt_qx_baoming where name = '{$name}' LIMIT 1";
	$res=$db->getone($sql);
	if($res){$html='<h2><i class="fa fa-smile-o"></i>'.$name.'����ʧ�ܣ����Ѿ�������</h2>';}*/
	//----
	/*if(empty($name) || empty($sex) || empty($height) || empty($weight) || empty($phone) || empty($brithday) || empty($depratment) || empty($hobby) || empty($selected))
	{
		$html='<h2><i class="fa fa-smile-o"></i>'.$name.'����ʧ�ܣ���Ϣ��д��������</h2>';
		exit($html);
	}*/
	//exit($register_1);
	if ($register_1 > 0)
	{
		$html='<p>������<span><b>&ldquo;Ҽר��&rdquo;��վ����Ա �����ɹ���</b></span></p>
					<p>��л����Ҽ������֧�֣����ǻ������Ķ������걨���ϡ�</p>
					<p>���ͨ����֪ͨ���Żᷢ���������ֻ����ͷ���ԱҲ��������ϵ��</p>';
		exit($html);
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
	elseif($register_1 = 0)
	{
		//$html='<h2><i class="fa fa-smile-o"></i>'.$name.'����ʧ�ܣ�</h2>';
		$html='<p><font style="color:#f00;">����ʧ�ܣ���������</font></p>';
		exit($html);
	}
	else
	{
		
		$html='<p><font style="color:#f00;">����ʧ�ܣ����Ѿ��������ˣ�</font></p>';
		exit($html);
	}
}
//---fffff
//---fff----����Ա----���ҷֱ�ʣ������
elseif ($act=='tiyan_num')
{
	$typeid= intval($_POST['typeid']);
	$sql = "select num from zt_tiyan_type where id='{$typeid}'  LIMIT 1";
	$val=$db->getone($sql);
	//exit($val['num']);
	exit($typeid);
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