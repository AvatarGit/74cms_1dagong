<?php
		// echo 'ok1111';exit; 
		//--ע��ɹ����Ͷ�Ϣ ��ʼ By Z
		require_once('/bb_duanxin.class.php');
		// echo '1111';exit;
		//------���Ͷ��ſ�ʼ
			// $duanxineirong="��ϲ����ΪҼ������Ա���˺�Ϊ���ֻ��ţ���ʼ�������ֻ�����λ,������Ƹ��Ϣ���www.1dagong.com��4001185188��Ҽ������";
			$duanxineirong="��Ҽ���������ã���л��������2015��Ϸ����������λ����Ƹ���ԣ����ź���֪ͨ�������п�����ˣ�������д�����ϻ�������������λ���������¼Ҽ������www.1dagong.com����ѯ�޸ģ���л���Ĺ�ע����ϵ�绰��0551-62980763,0551-62980767��";
			//ת��
            // $duanxineirong=mb_convert_encoding($duanxineirong,"GBK","UTF-8");
			$username=$phone;
            $dx=new duanxin($username,$duanxineirong);		//����������
			$id=$dx->fs();			
		//------���Ͷ��Ž���
		//--ע��ɹ����Ͷ�Ϣ ���� By Z


?>