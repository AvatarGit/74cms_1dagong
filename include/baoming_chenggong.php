<?php
		// echo 'ok1111';exit; 
		//--ע��ɹ����Ͷ�Ϣ ��ʼ By Z
		require_once('/bb_duanxin.class.php');
		// echo '1111';exit;
		//------���Ͷ��ſ�ʼ
			// $duanxineirong="��ϲ����ΪҼ������Ա���˺�Ϊ���ֻ��ţ���ʼ�������ֻ�����λ,������Ƹ��Ϣ���www.1dagong.com��4001185188��Ҽ������";
			$duanxineirong="��Ҽ���������ã���ϲ����ͨ����2015��Ϸ����������λ������������ˣ�����10��30��֮ǰ��¼Ҽ������www.1dagong.com�����ش�ӡ׼��֤�����ϴ��������֤����ҵ֤�顢ѧλ֤��ɨ�����һ��������Ƭ����ϵ�绰��0551-62980763,0551-62980767��";
			//ת��
            // $duanxineirong=mb_convert_encoding($duanxineirong,"GBK","UTF-8");
			$username=$phone;
            $dx=new duanxin($username,$duanxineirong);		//����������
			$id=$dx->fs();			
		//------���Ͷ��Ž���
		//--ע��ɹ����Ͷ�Ϣ ���� By Z


?>