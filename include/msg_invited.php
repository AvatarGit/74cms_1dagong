<?php

		//--�������Է��Ͷ�Ϣ ��ʼ By Z
		require_once(QISHI_ROOT_PATH.'include/bb_duanxin.class.php');
		//------���Ͷ��ſ�ʼ
			$duanxineirong="��Ҽ���������ã�����Ҽ���������ļ�������ҵ�������ԣ��뼰ʱ��¼Ҽ����www.1dagong.com�鿴��4001185188";
			//ת��
            //$duanxineirong=mb_convert_encoding($duanxineirong,"GBK","UTF-8");
            $dx=new duanxin($username,$duanxineirong);		//����������
			$time=date('Y-m-d H:i:s',time());
			$sql="insert into qs_duanxinsend_log (phone,sendtime,content) values ('".$username."','".$time."','".$duanxineirong."')";
			$db->query($sql);
			$id_res=$dx->fs();			
		//------���Ͷ��Ž���
		//--�������Է��Ͷ�Ϣ ���� By Z


?>