<?php

		//--��ҵ����鿴�������Ͷ�Ϣ ��ʼ By Z
		require_once(QISHI_ROOT_PATH.'include/bb_duanxin.class.php');
		//------���Ͷ��ſ�ʼ
			$duanxineirong="��Ҽ���������ã���һ����ҵ����鿴����Ҽ���������ļ������뼰ʱ��¼Ҽ����www.1dagong.com�鿴��4001185188";
			//ת��
            //$duanxineirong=mb_convert_encoding($duanxineirong,"GBK","UTF-8");
            $dx=new duanxin($username,$duanxineirong);		//����������
			$id_ck=$dx->fs();			
		//------���Ͷ��Ž���
		//--��ҵ����鿴�������Ͷ�Ϣ ���� By Z


?>