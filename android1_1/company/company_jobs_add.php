<?php 
define('IN_QISHI', true);
require_once(dirname(__FILE__).'/../include/common.inc.php');
require_once(QISHI_ROOT_PATH.'include/mysql.class.php');
$db = new mysql($dbhost,$dbuser,$dbpass,$dbname);
unset($dbhost,$dbuser,$dbpass,$dbname);
$aset=$_REQ;
$aset=array_map('addslashes',$aset);
require_once(ANDROID_ROOT_PATH.'include/common.user.inc.php');
if ($_SESSION['utype']<>'1')
{
	$result['result']=0;
	$result['list']=null;
	$result['errormsg']=android_iconv_utf8("���¼��ҵ��Ա���ģ�");
	$jsonencode = json_encode($result);
	$jsonencode = urldecode(json_encode($result));
	exit($jsonencode);
}
else
{
	$uid = intval($_SESSION['uid']);
	$user=get_user_info($_SESSION['uid']);
	$company=get_company_info($_SESSION['uid']);
	$operation = intval($_CFG['operation_mode']);
	//$company_profile = $db->fetch_array($db->query("select * from ".table('company_profile')." where uid=".$uid." limit 1"));
	if ($aset['act']=='add')
	{
		//$list['user'] = $user;
		foreach($company as $k=>$v){
			if($k=="map_x"||$k=="map_y"){
				continue;
			}
			$list[$k] = android_iconv_utf8($v);
		}
		if ($company['companyname'])
		{
			if ($_CFG['operation_mode']=="2")
			{ 
				$setmeal=get_user_setmeal($uid);
				if (($setmeal['endtime']>time() || $setmeal['endtime']=="0") &&  $setmeal['jobs_ordinary']>0)
				{
					//$list['setmeal'] = $setmeal;
					//$list['add_mode'] = 2;
				}
				elseif($_CFG['setmeal_to_points']=="1")
				{
					$list['points_total'] = get_user_points($uid);
					//$list['points'] = get_cache('points_rule');
					//$list['add_mode'] = 1;
				}
				else
				{
					//$list['setmeal'] = $setmeal;
					//$list['add_mode'] = 2;
				}
				
			}
			elseif ($_CFG['operation_mode']=="1")
			{
				$list['points_total'] = get_user_points($uid);
				//$list['points'] = get_cache('points_rule');
				//$list['add_mode'] = 1;
			}
			//$captcha=get_cache('captcha');
			//$list['verify_addjob'] = $captcha['verify_addjob'];
			$result['result']=1;
			$result['list']=$list;
			$result['errormsg']=android_iconv_utf8('���Դ���ְλ��');
			$jsonencode = urldecode(json_encode($result));
			exit($jsonencode);
		}else{
			$result['result']=0;
			$result['list']=null;
			$result['errormsg']=android_iconv_utf8('Ϊ�˴ﵽ���õ���ƸЧ������������������ҵ���ϣ�');
			$jsonencode = urldecode(json_encode($result));
			exit($jsonencode);
		}
	}
	else if ($aset['act']=='save')
	{
		$add_mode=trim($operation);
		$days=intval($aset['days']);
		if ($days<$_CFG['company_add_days_min'])
		{
			$result['result']=0;
			$result['list']=null;
			$result['errormsg']=android_iconv_utf8("��Чʱ������Ϊ ".$_CFG['company_add_days_min']." �죡");
			$jsonencode = urldecode(json_encode($result));
			exit($jsonencode);
		}
		if ($add_mode=="1")
		{
						$points_rule=get_cache('points_rule');
						$user_points=get_user_points($_SESSION['uid']);
						$total=0;
						if ($points_rule['jobs_add']['type']=="2" && $points_rule['jobs_add']['value']>0)
						{
						$total=$points_rule['jobs_add']['value'];
						}
						if ($points_rule['jobs_daily']['type']=="2" && $points_rule['jobs_daily']['value']>0)
						{
						$total=$total+($days*$points_rule['jobs_daily']['value']);
						}
						if ($total>$user_points)
						{
						$result['result']=0;
						$result['list']=null;
						$result['errormsg']=android_iconv_utf8("���".$_CFG['points_byname']."���㣬���ֵ���ٷ�����");
						$jsonencode = urldecode(json_encode($result));
						exit($jsonencode);
						}
						$setsqlarr['setmeal_deadline']=0;
		}
		elseif ($add_mode=="2")
		{
					$setmeal=get_user_setmeal($_SESSION['uid']);
					if ($setmeal['endtime']<time() && $setmeal['endtime']<>"0")
					{					
						$result['result']=0;
						$result['list']=null;
						$result['errormsg']=android_iconv_utf8('���ķ����Ѿ����ڣ������¿�ͨ��');
						$jsonencode = urldecode(json_encode($result));
						exit($jsonencode);
					}
					if ($setmeal['jobs_ordinary']<=0)
					{
						
					}
					$setsqlarr['setmeal_deadline']=$setmeal['endtime'];
					$setsqlarr['setmeal_id']=$setmeal['setmeal_id'];
					$setsqlarr['setmeal_name']=$setmeal['setmeal_name'];
		}
		$setsqlarr['add_mode']=intval($add_mode);
		$setsqlarr['uid']=intval($_SESSION['uid']);
		$setsqlarr['companyname']=$company['companyname'];
		$setsqlarr['company_id']=$company['id'];
		$setsqlarr['company_addtime']=$company['addtime'];
		$setsqlarr['company_audit']=$company['audit'];
		if(!empty($aset['jobs_name'])){
			$setsqlarr['jobs_name']=trim($aset['jobs_name']);
		}else{
			$result['result']=0;
			$result['list']=null;
			$result['errormsg']=android_iconv_utf8('��û����дְλ���ƣ�');
			$jsonencode = urldecode(json_encode($result));
			exit($jsonencode);
		}
		if(!empty($aset['contents'])){
			$setsqlarr['contents']=trim($aset['contents']);
		}else{
			$result['result']=0;
			$result['list']=null;
			$result['errormsg']=android_iconv_utf8('��û����дְλ������');
			$jsonencode = urldecode(json_encode($result));
			exit($jsonencode);
		}
		if(check_word($_CFG['filter'],trim($aset['contents']))){
			$result['result']=0;
			$result['list']=null;
			$result['errormsg']=android_iconv_utf8($_CFG['filter_tips']);
			$jsonencode = urldecode(json_encode($result));
			exit($jsonencode);
		}
		// check_word($_CFG['filter'],$aset['contents'])?showmsg($_CFG['filter_tips'],0):'';
		$setsqlarr['nature']=intval($aset['nature']);
		$setsqlarr['nature_cn']=trim($aset['nature_cn']);
		$setsqlarr['sex']=intval($aset['sex']);
		$setsqlarr['sex_cn']=trim($aset['sex_cn']);
		$setsqlarr['amount']=intval($aset['amount']);
		if(intval($aset['category'])>0){
			$setsqlarr['category']=intval($aset['category']);
		}else{
			$result['result']=0;
			$result['list']=null;
			$result['errormsg']=android_iconv_utf8('��ѡ��ְλ���');
			$jsonencode = urldecode(json_encode($result));
			exit($jsonencode);
		}
		$setsqlarr['subclass']=intval($aset['subclass']);
		$setsqlarr['category_cn']=trim($aset['category_cn']);
		$setsqlarr['trade']=$company['trade'];
		$setsqlarr['trade_cn']=$company['trade_cn'];
		$setsqlarr['scale']=$company['scale'];
		$setsqlarr['scale_cn']=$company['scale_cn'];
		if(intval($aset['district'])>0){
			$setsqlarr['district']=intval($aset['district']);
		}else{
			$result['result']=0;
			$result['list']=null;
			$result['errormsg']=android_iconv_utf8('��ѡ����������');
			$jsonencode = urldecode(json_encode($result));
			exit($jsonencode);
		}
		$setsqlarr['sdistrict']=intval($aset['sdistrict']);
		$setsqlarr['district_cn']=trim($aset['district_cn']);
		$setsqlarr['tag']=trim($aset['tag']);
		$setsqlarr['tag'] = str_replace("_","|",$setsqlarr['tag']);
		$setsqlarr['street']=$company['street'];
		$setsqlarr['street_cn']=$company['street_cn'];
		$setsqlarr['officebuilding']=$company['officebuilding'];
		$setsqlarr['officebuilding_cn']=$company['officebuilding_cn'];	
		$setsqlarr['education']=intval($aset['education']);		
		$setsqlarr['education_cn']=trim($aset['education_cn']);
		$setsqlarr['experience']=intval($aset['experience']);		
		$setsqlarr['experience_cn']=trim($aset['experience_cn']);
		$setsqlarr['wage']=intval($aset['wage']);		
		$setsqlarr['wage_cn']=trim($aset['wage_cn']);
		$setsqlarr['graduate']=intval($aset['graduate']);
		$setsqlarr['addtime']=$timestamp;
		$setsqlarr['deadline']=strtotime("".intval($aset['days'])." day");
		$setsqlarr['refreshtime']=$timestamp;
		$setsqlarr['key']=$setsqlarr['jobs_name'].$company['companyname'].$setsqlarr['category_cn'].$setsqlarr['district_cn'].$setsqlarr['contents'];
		require_once(QISHI_ROOT_PATH.'include/splitword.class.php');
		$sp = new SPWord();
		$setsqlarr['key']="{$setsqlarr['jobs_name']} {$company['companyname']} ".$sp->extracttag($setsqlarr['key']);
		$setsqlarr['key']=$sp->pad($setsqlarr['key']);
		$setsqlarr['tpl']=$company['tpl'];
		$setsqlarr['map_x']=$company['map_x'];
		$setsqlarr['map_y']=$company['map_y'];
		if ($company['audit']=="1")
		{
		$setsqlarr['audit']=intval($_CFG['audit_verifycom_addjob']);
		}
		else
		{
		$setsqlarr['audit']=intval($_CFG['audit_unexaminedcom_addjob']);
		}
		if(!empty($aset['contact'])){
			$setsqlarr_contact['contact']=trim($aset['contact']);
		}else{
			$result['result']=0;
			$result['list']=null;
			$result['errormsg']=android_iconv_utf8('��û����д��ϵ�ˣ�');
			$jsonencode = urldecode(json_encode($result));
			exit($jsonencode);
		}
		$setsqlarr_contact['qq']=trim($aset['qq']);
		if(!empty($aset['telephone'])){
			$setsqlarr_contact['telephone']=trim($aset['telephone']);
		}else{
			$result['result']=0;
			$result['list']=null;
			$result['errormsg']=android_iconv_utf8('��û����д��ϵ�绰��');
			$jsonencode = urldecode(json_encode($result));
			exit($jsonencode);
		}
		
		
		if(check_word($_CFG['filter'],trim($aset['telephone']))){
			$result['result']=0;
			$result['list']=null;
			$result['errormsg']=android_iconv_utf8($_CFG['filter_tips']);
			$jsonencode = urldecode(json_encode($result));
			exit($jsonencode);
		}
		//check_word($_CFG['filter'],$aset['telephone'])?showmsg($_CFG['filter_tips'],0):'';
		if(!empty($aset['address'])){
			$setsqlarr_contact['address']=trim($aset['address']);
		}else{
			$result['result']=0;
			$result['list']=null;
			$result['errormsg']=android_iconv_utf8('��û����д��ϵ��ַ��');
			$jsonencode = urldecode(json_encode($result));
			exit($jsonencode);
		}
		if(!empty($aset['email'])){
			$setsqlarr_contact['email']=trim($aset['email']);
		}else{
			$result['result']=0;
			$result['list']=null;
			$result['errormsg']=android_iconv_utf8('��û����д��ϵ���䣡');
			$jsonencode = urldecode(json_encode($result));
			exit($jsonencode);
		}
		$setsqlarr_contact['notify']=intval($aset['notify']);
		//���ְλ��Ϣ
		$pid=inserttable(table('jobs'),$setsqlarr,true);
		if(empty($pid)){
			$result['result']=0;
			$result['list']=null;
			$result['errormsg']=android_iconv_utf8('���ʧ�ܣ�');
			$jsonencode = urldecode(json_encode($result));
			exit($jsonencode);
		}
		// empty($pid)?showmsg("���ʧ�ܣ�",0):'';
		//�����ϵ��ʽ
		$setsqlarr_contact['pid']=$pid;
		if(!inserttable(table('jobs_contact'),$setsqlarr_contact)){
			$result['result']=0;
			$result['list']=null;
			$result['errormsg']=android_iconv_utf8('���ʧ�ܣ�');
			$jsonencode = urldecode(json_encode($result));
			exit($jsonencode);
		}
		// !inserttable(table('jobs_contact'),$setsqlarr_contact)?showmsg("���ʧ�ܣ�",0):'';
		if ($add_mode=="1")
		{
			if ($points_rule['jobs_add']['value']>0)
			{
			report_deal($_SESSION['uid'],$points_rule['jobs_add']['type'],$points_rule['jobs_add']['value']);
			$user_points=get_user_points($_SESSION['uid']);
			$operator=$points_rule['jobs_add']['type']=="1"?"+":"-";
			write_memberslog($_SESSION['uid'],1,9001,$_SESSION['username'],"ͨ���ֻ��ͻ��˷�����ְλ��<strong>{$setsqlarr['jobs_name']}</strong>��({$operator}{$points_rule['jobs_add']['value']})��(ʣ��:{$user_points})");
			}
			if (intval($aset['days'])>0 && $points_rule['jobs_daily']['value']>0)
			{
			$points_day=intval($aset['days'])*$points_rule['jobs_daily']['value'];
			report_deal($_SESSION['uid'],$points_rule['jobs_daily']['type'],$points_day);
			$user_points=get_user_points($_SESSION['uid']);
			$operator=$points_rule['jobs_daily']['type']=="1"?"+":"-";
			write_memberslog($_SESSION['uid'],1,9001,$_SESSION['username'],"ͨ���ֻ��ͻ��˷�����ְͨλ:<strong>{$aset['jobs_name']}</strong>����Ч��Ϊ{$aset['days']}�죬({$operator}{$points_day})��(ʣ��:{$user_points})");
			}
		}
		elseif ($add_mode=="2")
		{
			action_user_setmeal($_SESSION['uid'],"jobs_ordinary");
			$setmeal=get_user_setmeal($_SESSION['uid']);
			write_memberslog($_SESSION['uid'],1,9002,$_SESSION['username'],"ͨ���ֻ��ͻ��˷�����ְͨλ:<strong>{$aset['jobs_name']}</strong>�������Է�����ְͨλ:<strong>{$setmeal['jobs_ordinary']}</strong>��");
		}
		$searchtab['id']=$pid;
		$searchtab['uid']=$setsqlarr['uid'];
		$searchtab['recommend']=$setsqlarr['recommend'];
		$searchtab['emergency']=$setsqlarr['emergency'];
		$searchtab['nature']=$setsqlarr['nature'];
		$searchtab['sex']=$setsqlarr['sex'];
		$searchtab['category']=$setsqlarr['category'];
		$searchtab['subclass']=$setsqlarr['subclass'];
		$searchtab['trade']=$setsqlarr['trade'];
		$searchtab['district']=$setsqlarr['district'];
		$searchtab['sdistrict']=$setsqlarr['sdistrict'];	
		$searchtab['street']=$company['street'];
		$searchtab['officebuilding']=$company['officebuilding'];	
		$searchtab['education']=$setsqlarr['education'];
		$searchtab['experience']=$setsqlarr['experience'];
		$searchtab['wage']=$setsqlarr['wage'];
		$searchtab['refreshtime']=$setsqlarr['refreshtime'];
		$searchtab['scale']=$setsqlarr['scale'];	
		//
		inserttable(table('jobs_search_wage'),$searchtab);
		inserttable(table('jobs_search_scale'),$searchtab);
		//
		$searchtab['map_x']=$setsqlarr['map_x'];
		$searchtab['map_y']=$setsqlarr['map_y'];
		inserttable(table('jobs_search_rtime'),$searchtab);
		unset($searchtab['map_x'],$searchtab['map_y']);
		//
		$searchtab['stick']=$setsqlarr['stick'];
		inserttable(table('jobs_search_stickrtime'),$searchtab);
		unset($searchtab['stick']);
		//
		$searchtab['click']=$setsqlarr['click'];
		inserttable(table('jobs_search_hot'),$searchtab);
		unset($searchtab['click']);
		//
		$searchtab['key']=$setsqlarr['key'];
		$searchtab['likekey']=$setsqlarr['jobs_name'].','.$setsqlarr['companyname'];
		$searchtab['map_x']=$setsqlarr['map_x'];
		$searchtab['map_y']=$setsqlarr['map_y'];
		inserttable(table('jobs_search_key'),$searchtab);
		unset($searchtab);
		//
		
			$tag=explode('|',$setsqlarr['tag']);
			$tagindex=1;
			$tagsql['tag1']=$tagsql['tag2']=$tagsql['tag3']=$tagsql['tag4']=$tagsql['tag5']=0;
			if (!empty($tag) && is_array($tag))
			{
				foreach($tag as $v)
				{
				$vid=explode(',',$v);
				$tagsql['tag'.$tagindex]=intval($vid[0]);
				$tagindex++;
				}
			}
			$tagsql['id']=$pid;
			$tagsql['uid']=$setsqlarr['uid'];
			$tagsql['category']=$setsqlarr['category'];
			$tagsql['subclass']=$setsqlarr['subclass'];
			$tagsql['district']=$setsqlarr['district'];
			$tagsql['sdistrict']=$setsqlarr['sdistrict'];	
			inserttable(table('jobs_search_tag'),$tagsql);
		distribution_jobs($pid,$_SESSION['uid']);
		write_memberslog($_SESSION['uid'],1,2001,$_SESSION['username'],"ͨ���ֻ��ͻ��˷�����ְλ��{$setsqlarr['jobs_name']}");
		$result['result']=1;
		$result['list']=null;
		$result['errormsg']=android_iconv_utf8('�����ɹ���');
		$jsonencode = urldecode(json_encode($result));
		exit($jsonencode);
	}
	else if ($aset['act']=='editjobs')
	{
		$jobs=get_jobs_one(intval($aset['id']),$_SESSION['uid']);
		
		if (empty($jobs)) {
			$result['result']=0;
			$result['list']=null;
			$result['errormsg']=android_iconv_utf8('��������');
			$jsonencode = urldecode(json_encode($result));
			exit($jsonencode);
		}
		foreach($jobs as $k=>$v){
			if($k=="tag"){
				$jobs['tag'] = android_iconv_utf8(str_replace("|","_",$jobs['tag']));
			}else{
				$jobs[$k] = android_iconv_utf8($v);
			}
		}
		
		// $list['company'] = $company;
		// $list['user'] = $user;
		// $list['points_total'] = get_user_points($_SESSION['uid']);
		// $list['points'] = get_cache('points_rule');
		$list = $jobs;
		$result['result']=1;
		$result['list']=$list;
		$result['errormsg']=android_iconv_utf8('��ȡ���ݳɹ���');
		$jsonencode = urldecode(json_encode($result));
		exit($jsonencode);
	}
	else if ($aset['act']=='editjobs_save')
	{
		$id=intval($aset['id']);
		$add_mode=trim($operation);
		$days=intval($aset['days']);
		if ($add_mode=="1")
		{
						$points_rule=get_cache('points_rule');
						$user_points=get_user_points($_SESSION['uid']);
						$total=0;
						if($points_rule['jobs_edit']['type']=="2" && $points_rule['jobs_edit']['value']>0)
						{
						$total=$points_rule['jobs_edit']['value'];
						}
						if($points_rule['jobs_daily']['type']=="2" && $points_rule['jobs_daily']['value']>0)
						{
						$total=$total+($days*$points_rule['jobs_daily']['value']);
						}
						if ($total>$user_points)
						{
						$result['result']=0;
						$result['list']=null;
						$result['errormsg']=android_iconv_utf8("���".$_CFG['points_byname']."���㣬���ֵ���ٷ�����");
						$jsonencode = urldecode(json_encode($result));
						exit($jsonencode);
						}
		}
		elseif ($add_mode=="2")
		{
					$setmeal=get_user_setmeal($_SESSION['uid']);
					if ($setmeal['endtime']<time() && $setmeal['endtime']<>"0")
					{	
						$result['result']=0;
						$result['list']=null;
						$result['errormsg']=android_iconv_utf8("����Ϣͨ�������ײͷ����������ײ��Ѿ����ڣ������¿�ͨ");
						$jsonencode = urldecode(json_encode($result));
						exit($jsonencode);	
					}
		}
		if(!empty($aset['jobs_name'])){
			$setsqlarr['jobs_name']=trim($aset['jobs_name']);
		}else{
			$result['result']=0;
			$result['list']=null;
			$result['errormsg']=android_iconv_utf8('��û����дְλ���ƣ�');
			$jsonencode = urldecode(json_encode($result));
			exit($jsonencode);
		}
		if(!empty($aset['contents'])){
			$setsqlarr['contents']=trim($aset['contents']);
		}else{
			$result['result']=0;
			$result['list']=null;
			$result['errormsg']=android_iconv_utf8('��û����дְλ������');
			$jsonencode = urldecode(json_encode($result));
			exit($jsonencode);
		}
		if(check_word($_CFG['filter'],$aset['contents'])){
			$result['result']=0;
			$result['list']=null;
			$result['errormsg']=android_iconv_utf8($_CFG['filter_tips']);
			$jsonencode = urldecode(json_encode($result));
			exit($jsonencode);
		}
		$setsqlarr['nature']=intval($aset['nature']);
		$setsqlarr['nature_cn']=trim($aset['nature_cn']);
		$setsqlarr['sex']=intval($aset['sex']);
		$setsqlarr['sex_cn']=trim($aset['sex_cn']);
		$setsqlarr['amount']=intval($aset['amount']);
		if(intval($aset['category'])>0){
			$setsqlarr['category']=intval($aset['category']);
		}else{
			$result['result']=0;
			$result['list']=null;
			$result['errormsg']=android_iconv_utf8('��ѡ��ְλ���');
			$jsonencode = urldecode(json_encode($result));
			exit($jsonencode);
		}
		$setsqlarr['subclass']=trim($aset['subclass']);
		$setsqlarr['category_cn']=trim($aset['category_cn']);
		if(intval($aset['district'])>0){
			$setsqlarr['district']=intval($aset['district']);
		}else{
			$result['result']=0;
			$result['list']=null;
			$result['errormsg']=android_iconv_utf8('��ѡ����������');
			$jsonencode = urldecode(json_encode($result));
			exit($jsonencode);
		}
		$setsqlarr['sdistrict']=intval($aset['sdistrict']);
		$setsqlarr['district_cn']=trim($aset['district_cn']);
		$setsqlarr['tag']=trim($aset['tag']);
		$setsqlarr['tag'] = str_replace("_","|",$setsqlarr['tag']);
		$setsqlarr['education']=intval($aset['education']);		
		$setsqlarr['education_cn']=trim($aset['education_cn']);
		$setsqlarr['experience']=intval($aset['experience']);		
		$setsqlarr['experience_cn']=trim($aset['experience_cn']);
		$setsqlarr['wage']=intval($aset['wage']);		
		$setsqlarr['wage_cn']=trim($aset['wage_cn']);
		$setsqlarr['graduate']=intval($aset['graduate']);
		if ($days>0)
		{
			if ($aset['olddeadline']>=time())
			{
				 $setsqlarr['deadline']=$aset['olddeadline']+($days*(60*60*24));
			}
			else
			{
				 $setsqlarr['deadline']=strtotime("{$days} day");
			}
		}
		$setsqlarr['key']=$setsqlarr['jobs_name'].$company['companyname'].$setsqlarr['category_cn'].$setsqlarr['district_cn'].$setsqlarr['contents'];
		require_once(QISHI_ROOT_PATH.'include/splitword.class.php');
		$sp = new SPWord();
		$setsqlarr['key']="{$setsqlarr['jobs_name']} {$company['companyname']} ".$sp->extracttag($setsqlarr['key']);
		$setsqlarr['key']=$sp->pad($setsqlarr['key']);
		if ($company['audit']=="1")
		{
		$_CFG['audit_verifycom_editjob']<>"-1"?$setsqlarr['audit']=intval($_CFG['audit_verifycom_editjob']):'';
		}
		else
		{
		$_CFG['audit_unexaminedcom_editjob']<>"-1"?$setsqlarr['audit']=intval($_CFG['audit_unexaminedcom_editjob']):'';
		}
		if(!empty($aset['contact'])){
			$setsqlarr_contact['contact']=trim($aset['contact']);
		}else{
			$result['result']=0;
			$result['list']=null;
			$result['errormsg']=android_iconv_utf8('��û����д��ϵ�ˣ�');
			$jsonencode = urldecode(json_encode($result));
			exit($jsonencode);
		}
		$setsqlarr_contact['qq']=trim($aset['qq']);
		if(!empty($aset['telephone'])){
			$setsqlarr_contact['telephone']=trim($aset['telephone']);
		}else{
			$result['result']=0;
			$result['list']=null;
			$result['errormsg']=android_iconv_utf8('��û����д��ϵ�绰��');
			$jsonencode = urldecode(json_encode($result));
			exit($jsonencode);
		}
		if(check_word($_CFG['filter'],$aset['telephone'])){
			$result['result']=0;
			$result['list']=null;
			$result['errormsg']=android_iconv_utf8($_CFG['filter_tips']);
			$jsonencode = urldecode(json_encode($result));
			exit($jsonencode);
		}
		
		if(!empty($aset['address'])){
			$setsqlarr_contact['address']=trim($aset['address']);
		}else{
			$result['result']=0;
			$result['list']=null;
			$result['errormsg']=android_iconv_utf8('��û����д��ϵ��ַ��');
			$jsonencode = urldecode(json_encode($result));
			exit($jsonencode);
		}
		if(!empty($aset['email'])){
			$setsqlarr_contact['email']=trim($aset['email']);
		}else{
			$result['result']=0;
			$result['list']=null;
			$result['errormsg']=android_iconv_utf8('��û����д��ϵ���䣡');
			$jsonencode = urldecode(json_encode($result));
			exit($jsonencode);
		}
		$setsqlarr_contact['notify']=trim($aset['notify']);
		if (!updatetable(table('jobs'), $setsqlarr," id='{$id}' AND uid='{$_SESSION['uid']}' ")) 
		{
			$result['result']=0;
			$result['list']=null;
			$result['errormsg']=android_iconv_utf8('����ʧ�ܣ�');
			$jsonencode = urldecode(json_encode($result));
			exit($jsonencode);
		}
		if (!updatetable(table('jobs_tmp'), $setsqlarr," id='{$id}' AND uid='{$_SESSION['uid']}' ")){
			$result['result']=0;
			$result['list']=null;
			$result['errormsg']=android_iconv_utf8('����ʧ�ܣ�');
			$jsonencode = urldecode(json_encode($result));
			exit($jsonencode);
		} 
		if (!updatetable(table('jobs_contact'), $setsqlarr_contact," pid='{$id}' ")){
			$result['result']=0;
			$result['list']=null;
			$result['errormsg']=android_iconv_utf8('����ʧ�ܣ�');
			$jsonencode = urldecode(json_encode($result));
			exit($jsonencode);
		} 
		if ($add_mode=="1")
		{
			if ($points_rule['jobs_edit']['value']>0)
			{
			report_deal($_SESSION['uid'],$points_rule['jobs_edit']['type'],$points_rule['jobs_edit']['value']);
			$user_points=get_user_points($_SESSION['uid']);
			$operator=$points_rule['jobs_edit']['type']=="1"?"+":"-";
			write_memberslog($_SESSION['uid'],1,9001,$_SESSION['username'],"ͨ���ֻ��ͻ����޸�ְλ��<strong>{$setsqlarr['jobs_name']}</strong>��({$operator}{$points_rule['jobs_edit']['value']})��(ʣ��:{$user_points})");
			}
			if ($days>0 && $points_rule['jobs_daily']['value']>0)
			{
			$points_day=intval($aset['days'])*$points_rule['jobs_daily']['value'];
			report_deal($_SESSION['uid'],$points_rule['jobs_daily']['type'],$points_day);
			$user_points=get_user_points($_SESSION['uid']);
			$operator=$points_rule['jobs_daily']['type']=="1"?"+":"-";
			write_memberslog($_SESSION['uid'],1,9001,$_SESSION['username'],"ͨ���ֻ��ͻ����ӳ�ְλ({$aset['jobs_name']})��Ч��Ϊ{$aset['days']}�죬({$operator}{$points_day})��(ʣ��:{$user_points})");
			}
		}	 
		//
		$searchtab['nature']=$setsqlarr['nature'];
		$searchtab['sex']=$setsqlarr['sex'];
		$searchtab['category']=$setsqlarr['category'];
		$searchtab['subclass']=$setsqlarr['subclass'];
		$searchtab['trade']=$setsqlarr['trade'];
		$searchtab['district']=$setsqlarr['district'];
		$searchtab['sdistrict']=$setsqlarr['sdistrict'];
		$searchtab['education']=$setsqlarr['education'];
		$searchtab['experience']=$setsqlarr['experience'];
		$searchtab['wage']=$setsqlarr['wage'];
		//
		updatetable(table('jobs_search_wage'),$searchtab," id='{$id}' AND uid='{$_SESSION['uid']}' ");
		updatetable(table('jobs_search_rtime'),$searchtab," id='{$id}' AND uid='{$_SESSION['uid']}' ");
		updatetable(table('jobs_search_stickrtime'),$searchtab," id='{$id}' AND uid='{$_SESSION['uid']}' ");
		updatetable(table('jobs_search_hot'),$searchtab," id='{$id}' AND uid='{$_SESSION['uid']}' ");
		updatetable(table('jobs_search_scale'),$searchtab," id='{$id}' AND uid='{$_SESSION['uid']}'");
		$searchtab['key']=$setsqlarr['key'];
		$searchtab['likekey']=$setsqlarr['jobs_name'].','.$setsqlarr['companyname'];
		updatetable(table('jobs_search_key'),$searchtab," id='{$id}' AND uid='{$_SESSION['uid']}' ");
		unset($searchtab);
			$tag=explode('|',$setsqlarr['tag']);
			$tagindex=1;
			foreach($tag as $v)
			{
			$vid=explode(',',$v);
			$tagsql['tag'.$tagindex]=intval($vid[0]);
			$tagindex++;
			}
			$tagsql['id']=$id;
			$tagsql['uid']=$_SESSION['uid'];
			$tagsql['category']=$setsqlarr['category'];
			$tagsql['subclass']=$setsqlarr['subclass'];
			$tagsql['district']=$setsqlarr['district'];
			$tagsql['sdistrict']=$setsqlarr['sdistrict'];
		updatetable(table('jobs_search_tag'),$tagsql," id='{$id}' AND uid='{$_SESSION['uid']}' ");
		distribution_jobs($id,$_SESSION['uid']);
		write_memberslog($_SESSION['uid'],$_SESSION['utype'],2002,$_SESSION['username'],"ͨ���ֻ��ͻ����޸���ְλ��{$setsqlarr['jobs_name']}��ְλID��{$id}");
		$result['result']=1;
		$result['list']=null;
		$result['errormsg']=android_iconv_utf8('�޸ĳɹ���');
		$jsonencode = urldecode(json_encode($result));
		exit($jsonencode);
	}
}
?>