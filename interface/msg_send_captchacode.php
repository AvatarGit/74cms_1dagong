<?php

		//--手机验证码发送短息 开始 By Z
		require_once(QISHI_ROOT_PATH.'include/bb_duanxin.class.php');
		//------发送短信开始
			$duanxineirong="【壹打工网】您好，您的壹打工网短信验证码为:".$rand."。更多招聘信息详见www.1dagong.com。4001185188";
			//转码
            // $duanxineirong=mb_convert_encoding($duanxineirong,"GBK","UTF-8");\
			// $username='15555136682';
            $dx=new duanxin($username,$duanxineirong);		//申明短信类
			$r=$dx->fs();			
		//------发送短信结束
		//--手机验证码发送短息 结束 By Z
		if ($r=="1")
		{
			$result['data']=$rand;
			$result['code']=1;
			$result['errormsg']='';
			$jsonencode = urldecode(json_encode($result));
			exit($jsonencode);
		}
	
	
	
?>