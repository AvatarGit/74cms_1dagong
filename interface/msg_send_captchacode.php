<?php

		//--�ֻ���֤�뷢�Ͷ�Ϣ ��ʼ By Z
		require_once(QISHI_ROOT_PATH.'include/bb_duanxin.class.php');
		//------���Ͷ��ſ�ʼ
			$duanxineirong="��Ҽ���������ã�����Ҽ����������֤��Ϊ:".$rand."��������Ƹ��Ϣ���www.1dagong.com��4001185188";
			//ת��
            // $duanxineirong=mb_convert_encoding($duanxineirong,"GBK","UTF-8");\
			// $username='15555136682';
            $dx=new duanxin($username,$duanxineirong);		//����������
			$r=$dx->fs();			
		//------���Ͷ��Ž���
		//--�ֻ���֤�뷢�Ͷ�Ϣ ���� By Z
		if ($r=="1")
		{
			$result['data']=$rand;
			$result['code']=1;
			$result['errormsg']='';
			$jsonencode = urldecode(json_encode($result));
			exit($jsonencode);
		}
	
	
	
?>