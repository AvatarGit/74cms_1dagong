<?php
	class ExcelAction extends Common {
		function index(){
			

		}
		//���б�����Ա��Ϣ����Excel
		function bmxx_all(){
		// echo '11';exit;
/* 		$cfg_dbhost = '192.168.3.246';
		$cfg_dbname_1 = 'demo';
		$cfg_dbuser = '1jobstest';
		$cfg_dbpwd = 'shenbo@123';
		$link1  =  mysql_connect ( $cfg_dbhost, $cfg_dbuser, $cfg_dbpwd );
		$db_selected1  =  mysql_select_db ( $cfg_dbname_1 ,  $link1 );
		$query="select * from qs_baoming where status=1";
		$result1=mysql_query($query,$link1);
		$data  =  mysql_fetch_array ( $result1 );
		var_dump($data);exit; */
			$bm=D("qs_baoming");
			$data=$bm->select();
			// var_dump($data);exit;
			$title = array("A"=>"����",
						   "B"=>"�Ա�",
						   "C"=>"���֤��",
						   "D"=>"����ְλ",
						   "E"=>"��ϵ�绰",
						   "F"=>"������ò",
						   "G"=>"�������ڵ�",
						   "H"=>"�������ڵ�",
						   "I"=>"ѧ��",
						   "J"=>"ѧ������",
						   "K"=>"��ҵԺУ",
						   "L"=>"רҵ",
						   "M"=>"��ҵʱ��",
						   "N"=>"��������",
						   "O"=>"���״̬",
						   "P"=>"���֤����",
						   "Q"=>"���֤����",
						   "R"=>"֤����",
							);
			$this->exl_bmxx_all($title,$data);
			
		}
		//���б�����Ա��Ϣ������Excel--------------------------------------------------------------
		function exl_bmxx_all($title,$data){
		// echo '====';
		// var_dump($data);exit;
			include 'PHPExcel.php';
			include 'PHPExcel/Writer/Excel5.php'; 		//�������.xls��
			//����һ��excel
			$objPHPExcel = new PHPExcel();			
			//����excel�����ԣ�
			$objPHPExcel->getProperties()->setCreator("1dagong.com");				//������
			$objPHPExcel->getProperties()->setLastModifiedBy("1dagong.com");		//����޸���
			$objPHPExcel->getProperties()->setTitle("Office 2003 XLSX Test Document");		//����			
			$objPHPExcel->getProperties()->setSubject("Office 2003 XLSX Test Document");	//��Ŀ			
			$objPHPExcel->getProperties()->setDescription("Test document for Office 2003 XLSX.");	//����			
			$objPHPExcel->getProperties()->setKeywords("office 2003 openxml php");		//�ؼ���			
			$objPHPExcel->getProperties()->setCategory("Test result file");				//����
			$objPHPExcel->setActiveSheetIndex(0);	
			//����excel���ļ���
			//$name=date('Y-m-d',$na[0]['holddates'])."-".$na[0]['title'];
			$name="000";
			//����sheet��name
			$objPHPExcel->getActiveSheet()->setTitle($this->convertUTF8($name));
			// $objPHPExcel->getActiveSheet()->setCellValueExplicit('C', '847475847857487584',PHPExcel_Cell_DataType::TYPE_STRING);
			//�����п�Ϊ�Զ�
			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(5);
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(45);
			$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(30);
			$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(30);
			$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(30);
			$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(30);
			$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(30);
			$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(30);
			$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(45);
			$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(45);
			$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(45);
			//����-------------------------------------------------------------------------------
			foreach ($title as $k=>$v) {
				$objPHPExcel->getActiveSheet()->setCellValue($k."1", $this->convertUTF8($v));
				$objPHPExcel->getActiveSheet()->getStyle($k."1")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
				$objPHPExcel->getActiveSheet()->getStyle($k."1")->getFill()->getStartColor()->setARGB('FFDFEDF7');
			}
			//����-------------------------------------------------------------------------------
			foreach ($data as $k=>$v) {
				if($v['status'] == 0){
					$v['status'] = 'δ���';
				}elseif($v['status'] == 1){
					$v['status'] = '���ͨ��';
				}elseif($v['status'] == 2){
					$v['status'] = '���δͨ��';
				}
				$k=$k+2;
				$objPHPExcel->getActiveSheet()->setCellValue("A".$k, $this->convertUTF8($v['name']));
				$objPHPExcel->getActiveSheet()->setCellValue("B".$k, $this->convertUTF8($v['sex']));
				$objPHPExcel->getActiveSheet()->setCellValue("C".$k, " ".$this->convertUTF8(strval($v['identity_id'])));
				$objPHPExcel->getActiveSheet()->setCellValue("D".$k, $this->convertUTF8($v['baokao_job']));
				$objPHPExcel->getActiveSheet()->setCellValue("E".$k, $this->convertUTF8($v['phone1']));
				$objPHPExcel->getActiveSheet()->setCellValue("F".$k, $this->convertUTF8($v['politics']));
				$objPHPExcel->getActiveSheet()->setCellValue("G".$k, $this->convertUTF8($v['address']));
				$objPHPExcel->getActiveSheet()->setCellValue("H".$k, $this->convertUTF8($v['profile_add']));
				$objPHPExcel->getActiveSheet()->setCellValue("I".$k, $this->convertUTF8($v['education']));
				$objPHPExcel->getActiveSheet()->setCellValue("J".$k, $this->convertUTF8($v['edu_sta']));
				$objPHPExcel->getActiveSheet()->setCellValue("K".$k, $this->convertUTF8($v['graduate_school']));
				$objPHPExcel->getActiveSheet()->setCellValue("L".$k, $this->convertUTF8($v['specialty']));
				$objPHPExcel->getActiveSheet()->setCellValue("M".$k, $this->convertUTF8($v['graduate_time']));
				$objPHPExcel->getActiveSheet()->setCellValue("N".$k, $this->convertUTF8($v['birthday']));
				$objPHPExcel->getActiveSheet()->setCellValue("O".$k, $this->convertUTF8($v['status']));
				
				$objPHPExcel->getActiveSheet()->setCellValue('P'.$k, $this->convertUTF8("����鿴����"));
				$objPHPExcel->getActiveSheet()->getCell('P'.$k)->getHyperlink()->setUrl("http://www.1dagong.com/zt/hefeizhaomu/".$v['identity_up']);
				//$objPHPExcel->getActiveSheet()->setCellValue("P".$k, "http://www.1dagong.com/zt/hefeizhaomu/".$this->convertUTF8($v['identity_up']));
				
				
				$objPHPExcel->getActiveSheet()->setCellValue('Q'.$k, $this->convertUTF8("����鿴����"));
				$objPHPExcel->getActiveSheet()->getCell('Q'.$k)->getHyperlink()->setUrl("http://www.1dagong.com/zt/hefeizhaomu/".$v['identity_down']);
				//$objPHPExcel->getActiveSheet()->setCellValue("Q".$k, "http://www.1dagong.com/zt/hefeizhaomu/".$this->convertUTF8($v['identity_down']));
				
				$objPHPExcel->getActiveSheet()->setCellValue('R'.$k, $this->convertUTF8("����鿴֤����"));
				$objPHPExcel->getActiveSheet()->getCell('R'.$k)->getHyperlink()->setUrl("http://www.1dagong.com/zt/hefeizhaomu/".$v['photo']);
				//$objPHPExcel->getActiveSheet()->setCellValue("R".$k, "http://www.1dagong.com/zt/hefeizhaomu/".$this->convertUTF8($v['photo']));
			}
			//ֱ������������
			$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
			header("Pragma: public");
			header("Expires: 0");
			header("Cache-Control:must-revalidate, post-check=0, pre-check=0");
			header("Content-Type:application/force-download");
			header("Content-Type:application/vnd.ms-execl");
			header("Content-Type:application/octet-stream");
			header("Content-Type:application/download");
			header('Content-Disposition:attachment;filename="'.$name.'.xls"');
			header("Content-Transfer-Encoding:binary");
			$objWriter->save('php://output');
		
		}		
		//���ͨ���ı�����Ϣ����Excel
		function bmxx(){
/* 		$cfg_dbhost = '192.168.3.246';
		$cfg_dbname_1 = 'demo';
		$cfg_dbuser = '1jobstest';
		$cfg_dbpwd = 'shenbo@123';
		$link1  =  mysql_connect ( $cfg_dbhost, $cfg_dbuser, $cfg_dbpwd );
		$db_selected1  =  mysql_select_db ( $cfg_dbname_1 ,  $link1 );
		$query="select * from qs_baoming where status=1";
		$result1=mysql_query($query,$link1);
		$data  =  mysql_fetch_array ( $result1 );
		var_dump($data);exit; */
			$bm=D("qs_baoming");
			$data=$bm->where(array("status"=>1))->order("id asc")->select();
			// var_dump($data);
			$title = array("A"=>"����",
						   "B"=>"�Ա�",
						   "C"=>"���֤��",
						   "D"=>"����ְλ",
						   "E"=>"��ϵ�绰",
						   "F"=>"������ò",
						   "G"=>"�������ڵ�",
						   "H"=>"�������ڵ�",
						   "I"=>"ѧ��",
						   "J"=>"ѧ������",
						   "K"=>"��ҵԺУ",
						   "L"=>"רҵ",
						   "M"=>"��ҵʱ��",
						   "N"=>"��������",
						   "O"=>"���֤����",
						   "P"=>"���֤����",
						   "Q"=>"֤����",
							);
			$this->exl_bmxx($title,$data);
			
		}
		//���ͨ���ı�����Ϣ������Excel--------------------------------------------------------------
		function exl_bmxx($title,$data){
		// echo '====';
		// var_dump($data);exit;
			include 'PHPExcel.php';
			include 'PHPExcel/Writer/Excel5.php'; 		//�������.xls��
			//����һ��excel
			$objPHPExcel = new PHPExcel();			
			//����excel�����ԣ�
			$objPHPExcel->getProperties()->setCreator("1dagong.com");				//������
			$objPHPExcel->getProperties()->setLastModifiedBy("1dagong.com");		//����޸���
			$objPHPExcel->getProperties()->setTitle("Office 2003 XLSX Test Document");		//����			
			$objPHPExcel->getProperties()->setSubject("Office 2003 XLSX Test Document");	//��Ŀ			
			$objPHPExcel->getProperties()->setDescription("Test document for Office 2003 XLSX.");	//����			
			$objPHPExcel->getProperties()->setKeywords("office 2003 openxml php");		//�ؼ���			
			$objPHPExcel->getProperties()->setCategory("Test result file");				//����
			$objPHPExcel->setActiveSheetIndex(0);	
			//����excel���ļ���
			//$name=date('Y-m-d',$na[0]['holddates'])."-".$na[0]['title'];
			$name="000";
			//����sheet��name
			$objPHPExcel->getActiveSheet()->setTitle($this->convertUTF8($name));
			// $objPHPExcel->getActiveSheet()->setCellValueExplicit('C', '847475847857487584',PHPExcel_Cell_DataType::TYPE_STRING);
			//�����п�Ϊ�Զ�
			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(5);
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(45);
			$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(30);
			$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(30);
			$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(30);
			$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(30);
			$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(30);
			$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(45);
			$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(45);
			$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(45);
			//����-------------------------------------------------------------------------------
			foreach ($title as $k=>$v) {
				$objPHPExcel->getActiveSheet()->setCellValue($k."1", $this->convertUTF8($v));
				$objPHPExcel->getActiveSheet()->getStyle($k."1")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
				$objPHPExcel->getActiveSheet()->getStyle($k."1")->getFill()->getStartColor()->setARGB('FFDFEDF7');
			}
			//����-------------------------------------------------------------------------------
			foreach ($data as $k=>$v) {
				$k=$k+2;
				$objPHPExcel->getActiveSheet()->setCellValue("A".$k, $this->convertUTF8($v['name']));
				$objPHPExcel->getActiveSheet()->setCellValue("B".$k, $this->convertUTF8($v['sex']));
				$objPHPExcel->getActiveSheet()->setCellValue("C".$k, " ".$this->convertUTF8(strval($v['identity_id'])));
				$objPHPExcel->getActiveSheet()->setCellValue("D".$k, $this->convertUTF8($v['baokao_job']));
				$objPHPExcel->getActiveSheet()->setCellValue("E".$k, $this->convertUTF8($v['phone1']));
				$objPHPExcel->getActiveSheet()->setCellValue("F".$k, $this->convertUTF8($v['politics']));
				$objPHPExcel->getActiveSheet()->setCellValue("G".$k, $this->convertUTF8($v['address']));
				$objPHPExcel->getActiveSheet()->setCellValue("H".$k, $this->convertUTF8($v['profile_add']));
				$objPHPExcel->getActiveSheet()->setCellValue("I".$k, $this->convertUTF8($v['education']));
				$objPHPExcel->getActiveSheet()->setCellValue("J".$k, $this->convertUTF8($v['edu_sta']));
				$objPHPExcel->getActiveSheet()->setCellValue("K".$k, $this->convertUTF8($v['graduate_school']));
				$objPHPExcel->getActiveSheet()->setCellValue("L".$k, $this->convertUTF8($v['specialty']));
				$objPHPExcel->getActiveSheet()->setCellValue("M".$k, $this->convertUTF8($v['graduate_time']));
				$objPHPExcel->getActiveSheet()->setCellValue("N".$k, $this->convertUTF8($v['birthday']));
				
				$objPHPExcel->getActiveSheet()->setCellValue('O'.$k, $this->convertUTF8("����鿴����"));
				$objPHPExcel->getActiveSheet()->getCell('O'.$k)->getHyperlink()->setUrl("http://www.1dagong.com/zt/hefeizhaomu/".$v['identity_up']);

				$objPHPExcel->getActiveSheet()->setCellValue('P'.$k, $this->convertUTF8("����鿴����"));
				$objPHPExcel->getActiveSheet()->getCell('P'.$k)->getHyperlink()->setUrl("http://www.1dagong.com/zt/hefeizhaomu/".$v['identity_down']);
				// $objPHPExcel->getActiveSheet()->getCell('P')->getHyperlink()->setTooltip('Navigate to website');
				// $objPHPExcel->getActiveSheet()->getStyle('P')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
				$objPHPExcel->getActiveSheet()->setCellValue('Q'.$k, $this->convertUTF8("����鿴֤����"));
				$objPHPExcel->getActiveSheet()->getCell('Q'.$k)->getHyperlink()->setUrl("http://www.1dagong.com/zt/hefeizhaomu/".$v['photo']);
				// $objPHPExcel->getActiveSheet()->getCell('Q')->getHyperlink()->setTooltip('Navigate to website');
				// $objPHPExcel->getActiveSheet()->getStyle('Q')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
			}
			//ֱ������������
			$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
			header("Pragma: public");
			header("Expires: 0");
			header("Cache-Control:must-revalidate, post-check=0, pre-check=0");
			header("Content-Type:application/force-download");
			header("Content-Type:application/vnd.ms-execl");
			header("Content-Type:application/octet-stream");
			header("Content-Type:application/download");
			header('Content-Disposition:attachment;filename="'.$name.'.xls"');
			header("Content-Transfer-Encoding:binary");
			$objWriter->save('php://output');
		
		}
		//�λ���ҵ��������Excel
		function zhqy(){
			if(!empty($_GET['zhid'])){
				$zhid=$_GET['zhid'];
				$Zhanhui=D("vip_zhanhui");
				$data=$Zhanhui->where(array("zid"=>$zhid))->order("number asc")->select();
				$site=D("qs_subsite")->field("s_id,s_districtname")->select();
				foreach($data as $i=>$v){
					$data[$i]['dq']="ȫվ";
					foreach ($site as $k=>$s){
						if($s['s_id']==$data[$i]['subsite_id']){
							$data[$i]['dq']=$s['s_districtname'];
						}
					}
					//-------------------------------------------
					if($v['yhtype']==1){
						$data[$i]['yhtype']="�ײ��û�";
					}
					if($v['yhtype']==2){
						$data[$i]['yhtype']="�����û�";
					}
					if($v['yhtype']==3){
						$data[$i]['yhtype']="��ʱ�û�";
					}
					//-------------------------------------------
					if($v['online_aoto']==1){
						$data[$i]['online_aoto']="�Զ�Ԥ��";
					}
					if($v['online_aoto']==2){
						$data[$i]['online_aoto']="����Ԥ��";
					}
					if($v['online_aoto']==3){
						$data[$i]['online_aoto']="�ֶ����";
					}
					//--------------------------------------------
				}

				$name=D("qs_jobfair")->field("id,title,holddates")->where(array("id"=>$zhid))->select();
							 
				$title=array("A"=>"չλ��",
							 "B"=>"��ҵ�û���",
							 "C"=>"��ҵ��˾��",
							 "D"=>"���۴���",
							 "E"=>"����",
							 "F"=>"��ҵqq",
							 "G"=>"��ҵ�绰",
							 "H"=>"��ҵ����",
							 "I"=>"�û�����",
							 "J"=>"Ԥ����ʽ",
							 "K"=>"Ԥ��ʱ��",
							 "L"=>"��ע",
							 );
				
				$this->exlzh($name,$title,$data);
			}		
		}
/*---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/
		//����ײ͵���Excel
		function nftcyh(){
			$a=D("vip_user");
			$b=D("vip_zt");
			//$sql='select vip_zt.id,vip_zt.uid,vip_user.qid,vip_zt.subsite_id,username,title,xs_user,qq,phone,email,activation,type,duration,bout,number,add_time,end_time from vip_user right join vip_zt on vip_zt.uid = vip_user.id where type="1" ';
			$sql='select vip_zt.id,vip_zt.uid,vip_user.qid,vip_zt.subsite_id,username,title,xs_user,phone,email,activation,type,duration,bout,number,add_time,end_time from vip_user right join vip_zt on vip_zt.uid = vip_user.id where type="1" ';
			$data=$a->query($sql,"select");
			$site=D("qs_subsite")->field("s_id,s_districtname")->select();
			foreach($data as $i=>$v){
				$data[$i]['dq']="ȫվ";
				foreach ($site as $k=>$s){
					if($s['s_id']==$data[$i]['subsite_id']){
						$data[$i]['dq']=$s['s_districtname'];
					}
				}
				if($v['type']==1){
					$data[$i]['type']="ʱ���ײ�";
				}
				if($v['xs_user'] =="" || empty($v['xs_user'])){
					$data[$i]['xs_user']="��";
				}
				if($v['duration']==1){
					$data[$i]['duration']="һ���ײ�(ʮ������)";
				}
				if($v['duration']==2){
					$data[$i]['duration']="�����ײ�(������)";
				}
				if($v['duration']==3){
					$data[$i]['duration']="һ���ײ�(������)";
				}
				if($v['activation']==0){
					$data[$i]['activation']="δ����";
				}
				if($v['activation']==1){
					$data[$i]['activation']="�Ѽ���";
				}
				if($v['activation']==3){
					$data[$i]['activation']="�ѹ���";
				}
			}
			//p($data);
			$name="ʱ���ײ� ".date('Y-m-d',time());

			$title=array("A"=>"��ҵ�û���",
						 "B"=>"��ҵ��˾��",
						 "C"=>"���۴���",
						 "D"=>"����",
						 "E"=>"�ײ�����",
						 "F"=>"չλ��",
						 "G"=>"�ײ�ʱ��",
						 "H"=>"����ʱ��",
						 "I"=>"�ײ��Ƿ񼤻�",
						 "J"=>"��ҵ�绰",
						 "K"=>"��ҵ����",
						 "L"=>"���ʱ��",
						);	
			$this->exlnf($name,$title,$data);
		}
		//��������ײ͵���ҵ������Excel---------------------------------------------------------
		function exlnf($name,$title,$data){
			include 'PHPExcel.php';
			include 'PHPExcel/Writer/Excel5.php'; 		//�������.xls��
			//����һ��excel
			$objPHPExcel = new PHPExcel();			
			//����excel�����ԣ�
			$objPHPExcel->getProperties()->setCreator("1jobs.com");				//������
			$objPHPExcel->getProperties()->setLastModifiedBy("1jobs.com");		//����޸���
			$objPHPExcel->getProperties()->setTitle("Office 2003 XLSX Test Document");		//����			
			$objPHPExcel->getProperties()->setSubject("Office 2003 XLSX Test Document");	//��Ŀ			
			$objPHPExcel->getProperties()->setDescription("Test document for Office 2003 XLSX.");	//����			
			$objPHPExcel->getProperties()->setKeywords("office 2003 openxml php");		//�ؼ���			
			$objPHPExcel->getProperties()->setCategory("Test result file");				//����
			$objPHPExcel->setActiveSheetIndex(0);	
			//����excel���ļ���
			//����sheet��name
			$objPHPExcel->getActiveSheet()->setTitle($this->convertUTF8($name));
			//�����п�Ϊ�Զ�
			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(40); 
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(10); 
			$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(8);
			$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(12);
			$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
			//����-------------------------------------------------------------------------------
			foreach ($title as $k=>$v) {
				$objPHPExcel->getActiveSheet()->setCellValue($k."1", $this->convertUTF8($v));
				$objPHPExcel->getActiveSheet()->getStyle($k."1")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
				$objPHPExcel->getActiveSheet()->getStyle($k."1")->getFill()->getStartColor()->setARGB('FFDFEDF7');
			}
			//����-------------------------------------------------------------------------------
			foreach ($data as $k=>$v) {
				$k=$k+2;
				$objPHPExcel->getActiveSheet()->setCellValue("A".$k, $this->convertUTF8(strval($v['username'])));
				$objPHPExcel->getActiveSheet()->setCellValue("B".$k, $this->convertUTF8($v['title']));
				$objPHPExcel->getActiveSheet()->setCellValue("C".$k, $this->convertUTF8($v['xs_user']));
				$objPHPExcel->getActiveSheet()->setCellValue("D".$k, $this->convertUTF8($v['dq']));
				$objPHPExcel->getActiveSheet()->setCellValue("E".$k, $this->convertUTF8($v['type']));
				$objPHPExcel->getActiveSheet()->setCellValue("F".$k, " ".$this->convertUTF8($v['number']));
				$objPHPExcel->getActiveSheet()->setCellValue("G".$k, $this->convertUTF8($v['duration']));
				$objPHPExcel->getActiveSheet()->setCellValue("H".$k, $this->convertUTF8(date('Y-m-d H:i:s',$v['end_time'])));
				$objPHPExcel->getActiveSheet()->setCellValue("I".$k, $this->convertUTF8($v['activation']));//--fff--qq�޸ĳ�--activation
				$objPHPExcel->getActiveSheet()->setCellValue("J".$k, $this->convertUTF8($v['phone']));
				$objPHPExcel->getActiveSheet()->setCellValue("K".$k, $this->convertUTF8($v['email']));
				$objPHPExcel->getActiveSheet()->setCellValue("L".$k, $this->convertUTF8(date('Y-m-d H:i:s',$v['add_time'])));
			
			}
			//ֱ������������
			$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
			header("Pragma: public");
			header("Expires: 0");
			header("Cache-Control:must-revalidate, post-check=0, pre-check=0");
			header("Content-Type:application/force-download");
			header("Content-Type:application/vnd.ms-execl");
			header("Content-Type:application/octet-stream");
			header("Content-Type:application/download");
			header('Content-Disposition:attachment;filename="'.$name.'.xls"');
			header("Content-Transfer-Encoding:binary");
			$objWriter->save('php://output');
		}
/*--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/		
		//�����ײ͵���Excel
		function cstcyh(){
			$a=D("vip_user");
			$b=D("vip_zt");
			//$sql='select vip_zt.id,vip_zt.uid,vip_user.qid,vip_zt.subsite_id,username,title,xs_user,qq,phone,email,activation,type,duration,bout,number,add_time,end_time from vip_user right join vip_zt on vip_zt.uid = vip_user.id where type="0" ';
			$sql='select vip_zt.id,vip_zt.uid,vip_user.qid,vip_zt.subsite_id,username,cs_ks_time,cs_end_time,title,xs_user,phone,email,activation,type,duration,bout,number,add_time,end_time from vip_user right join vip_zt on vip_zt.uid = vip_user.id where type="0" ';
			$data=$a->query($sql,"select");
			$site=D("qs_subsite")->field("s_id,s_districtname")->select();
			foreach($data as $i=>$v){
				$data[$i]['dq']="ȫվ";
				foreach ($site as $k=>$s){
					if($s['s_id']==$data[$i]['subsite_id']){
						$data[$i]['dq']=$s['s_districtname'];
					}
				}
				if($v['type']==0){
					$data[$i]['type']="�����ײ�";
				}
				if($v['xs_user'] =="" || empty($v['xs_user'])){
					$data[$i]['xs_user']="��";
				}
				if($v['activation'] =="0"){
					$data[$i]['activation']="δ����";
				}
				if($v['activation'] =="1"){
					$data[$i]['activation']="�Ѽ���";
				}
				if($v['activation'] =="3"){
					$data[$i]['activation']="�ѹ���";
				}
					
			}
			//p($data);

			$name="�����ײ� ".date('Y-m-d',time());

			$title=array("A"=>"��ҵ�û���",
						 "B"=>"��ҵ��˾��",
						 "C"=>"���۴���",
						 "D"=>"����",
						 "E"=>"�ײ�����",
						 "F"=>"ʣ�����",
						 "G"=>"��ʼʱ��",
						 "H"=>"����ʱ��",
						 "I"=>"�ײ��Ƿ񼤻�",//---��ҵ��qq---�޸ĳ�---�ײ��Ƿ񼤻�
						 "J"=>"��ҵ�绰",
						 "K"=>"��ҵ����",
						 "L"=>"���ʱ��",
						);

			$this->exlcs($name,$title,$data);
		}
		//�����ײ��û�������Excel----------------------------------------------------------------
		function exlcs($name,$title,$data){
			include 'PHPExcel.php';
			include 'PHPExcel/Writer/Excel5.php'; 		//�������.xls��
			//����һ��excel
			$objPHPExcel = new PHPExcel();			
			//����excel�����ԣ�
			$objPHPExcel->getProperties()->setCreator("1jobs.com");				//������
			$objPHPExcel->getProperties()->setLastModifiedBy("1jobs.com");		//����޸���
			$objPHPExcel->getProperties()->setTitle("Office 2003 XLSX Test Document");		//����			
			$objPHPExcel->getProperties()->setSubject("Office 2003 XLSX Test Document");	//��Ŀ			
			$objPHPExcel->getProperties()->setDescription("Test document for Office 2003 XLSX.");	//����			
			$objPHPExcel->getProperties()->setKeywords("office 2003 openxml php");		//�ؼ���			
			$objPHPExcel->getProperties()->setCategory("Test result file");				//����
			$objPHPExcel->setActiveSheetIndex(0);	
			//����excel���ļ���
			//����sheet��name
			$objPHPExcel->getActiveSheet()->setTitle($this->convertUTF8($name));
			//�����п�Ϊ�Զ�
			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(40); 
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(10); 
			$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(8);
			$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(12);
			$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
			//����-------------------------------------------------------------------------------
			foreach ($title as $k=>$v) {
				$objPHPExcel->getActiveSheet()->setCellValue($k."1", $this->convertUTF8($v));
				$objPHPExcel->getActiveSheet()->getStyle($k."1")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
				$objPHPExcel->getActiveSheet()->getStyle($k."1")->getFill()->getStartColor()->setARGB('FFDFEDF7');
			}
			//����-------------------------------------------------------------------------------
			foreach ($data as $k=>$v) {
				$k=$k+2;
				$objPHPExcel->getActiveSheet()->setCellValue("A".$k, $this->convertUTF8(strval($v['username'])));
				$objPHPExcel->getActiveSheet()->setCellValue("B".$k, $this->convertUTF8($v['title']));
				$objPHPExcel->getActiveSheet()->setCellValue("C".$k, $this->convertUTF8($v['xs_user']));
				$objPHPExcel->getActiveSheet()->setCellValue("D".$k, $this->convertUTF8($v['dq']));
				$objPHPExcel->getActiveSheet()->setCellValue("E".$k, $this->convertUTF8($v['type']));
				$objPHPExcel->getActiveSheet()->setCellValue("F".$k, $this->convertUTF8($v['bout']));
				$objPHPExcel->getActiveSheet()->setCellValue("G".$k, $this->convertUTF8(date('Y-m-d H:i:s',$v['cs_ks_time'])));
				$objPHPExcel->getActiveSheet()->setCellValue("H".$k, $this->convertUTF8(date('Y-m-d H:i:s',$v['cs_end_time'])));
				$objPHPExcel->getActiveSheet()->setCellValue("I".$k, $this->convertUTF8($v['activation']));//-----��ҵqq---�޸ĳ�---�Ƿ񼤻�
				$objPHPExcel->getActiveSheet()->setCellValue("J".$k, $this->convertUTF8($v['phone']));
				$objPHPExcel->getActiveSheet()->setCellValue("K".$k, $this->convertUTF8($v['email']));
				$objPHPExcel->getActiveSheet()->setCellValue("L".$k, $this->convertUTF8(date('Y-m-d H:i:s',$v['add_time'])));
			
			}
			//ֱ������������
			$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
			header("Pragma: public");
			header("Expires: 0");
			header("Cache-Control:must-revalidate, post-check=0, pre-check=0");
			header("Content-Type:application/force-download");
			header("Content-Type:application/vnd.ms-execl");
			header("Content-Type:application/octet-stream");
			header("Content-Type:application/download");
			header('Content-Disposition:attachment;filename="'.$name.'.xls"');
			header("Content-Transfer-Encoding:binary");
			$objWriter->save('php://output');
		}
		
		//�μ�չ�����ҵ������Excel--------------------------------------------------------------
		function exlzh($na,$title,$data){
			include 'PHPExcel.php';
			include 'PHPExcel/Writer/Excel5.php'; 		//�������.xls��
			//����һ��excel
			$objPHPExcel = new PHPExcel();			
			//����excel�����ԣ�
			$objPHPExcel->getProperties()->setCreator("1jobs.com");				//������
			$objPHPExcel->getProperties()->setLastModifiedBy("1jobs.com");		//����޸���
			$objPHPExcel->getProperties()->setTitle("Office 2003 XLSX Test Document");		//����			
			$objPHPExcel->getProperties()->setSubject("Office 2003 XLSX Test Document");	//��Ŀ			
			$objPHPExcel->getProperties()->setDescription("Test document for Office 2003 XLSX.");	//����			
			$objPHPExcel->getProperties()->setKeywords("office 2003 openxml php");		//�ؼ���			
			$objPHPExcel->getProperties()->setCategory("Test result file");				//����
			$objPHPExcel->setActiveSheetIndex(0);	
			//����excel���ļ���
			//$name=date('Y-m-d',$na[0]['holddates'])."-".$na[0]['title'];
			$name="000";
			//����sheet��name
			$objPHPExcel->getActiveSheet()->setTitle($this->convertUTF8($name));
			//�����п�Ϊ�Զ�
			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(45);
			$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(8);
			$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(22);
			$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(50);
			//����-------------------------------------------------------------------------------
			foreach ($title as $k=>$v) {
				$objPHPExcel->getActiveSheet()->setCellValue($k."1", $this->convertUTF8($v));
				$objPHPExcel->getActiveSheet()->getStyle($k."1")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
				$objPHPExcel->getActiveSheet()->getStyle($k."1")->getFill()->getStartColor()->setARGB('FFDFEDF7');
			}
			//����-------------------------------------------------------------------------------
			foreach ($data as $k=>$v) {
				$k=$k+2;
				$objPHPExcel->getActiveSheet()->setCellValue("A".$k, " ".$this->convertUTF8(strval($v['number'])));
				$objPHPExcel->getActiveSheet()->setCellValue("B".$k, $this->convertUTF8($v['username']));
				$objPHPExcel->getActiveSheet()->setCellValue("C".$k, $this->convertUTF8($v['title']));
				$objPHPExcel->getActiveSheet()->setCellValue("D".$k, $this->convertUTF8($v['xs_user']));
				$objPHPExcel->getActiveSheet()->setCellValue("E".$k, $this->convertUTF8($v['dq']));
				$objPHPExcel->getActiveSheet()->setCellValue("F".$k, $this->convertUTF8($v['qq']));
				$objPHPExcel->getActiveSheet()->setCellValue("G".$k, $this->convertUTF8($v['phone']));
				$objPHPExcel->getActiveSheet()->setCellValue("H".$k, $this->convertUTF8($v['email']));
				$objPHPExcel->getActiveSheet()->setCellValue("I".$k, $this->convertUTF8($v['yhtype']));
				$objPHPExcel->getActiveSheet()->setCellValue("J".$k, $this->convertUTF8($v['online_aoto']));
				$objPHPExcel->getActiveSheet()->setCellValue("K".$k, $this->convertUTF8(date('Y-m-d H:i:s',$v['add_time'])));
				$objPHPExcel->getActiveSheet()->setCellValue("L".$k, $this->convertUTF8($v['text']));
			}
			//ֱ������������
			$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
			header("Pragma: public");
			header("Expires: 0");
			header("Cache-Control:must-revalidate, post-check=0, pre-check=0");
			header("Content-Type:application/force-download");
			header("Content-Type:application/vnd.ms-execl");
			header("Content-Type:application/octet-stream");
			header("Content-Type:application/download");
			header('Content-Disposition:attachment;filename="'.$name.'.xls"');
			header("Content-Transfer-Encoding:binary");
			$objWriter->save('php://output');
		
		}
		//------------------------------------------------------------------------------
		function user(){
			$user=D("vip_user");
			$data=$user->select();
			$site=D("qs_subsite")->field("s_id,s_districtname")->select();
			foreach($data as $i=>$v){
				$data[$i]['dq']="ȫվ";
				foreach ($site as $k=>$s){
					if($s['s_id']==$data[$i]['subsite_id']){
						$data[$i]['dq']=$s['s_districtname'];
					}
				}
				if($v['bl']==0){
					$data[$i]['bl']="δ�����κ��ײ�";
				}
				if($v['bl']==1){
					$data[$i]['bl']="�԰����ײ�";
				}
			}
			//p($data);
			$name="��ҵ�û� ".date('Y-m-d',time());

			$title=array("A"=>"��ҵ�û���",
						 "B"=>"��ҵ��˾��",
						 "C"=>"���۴���",
						 "D"=>"����",
						 "E"=>"��ҵqq",
						 "F"=>"��ҵ�绰",
						 "G"=>"��ҵ����",
						 "H"=>"�Ƿ�����ײ�",
						 "I"=>"���ʱ��",
						);

			$this->exluser($name,$title,$data);
		}
		//user�û�������Excel------------------------------------------------------
		function exluser($name,$title,$data){
			include 'PHPExcel.php';
			include 'PHPExcel/Writer/Excel5.php'; 		//�������.xls��
			//����һ��excel
			$objPHPExcel = new PHPExcel();			
			//����excel�����ԣ�
			$objPHPExcel->getProperties()->setCreator("1jobs.com");				//������
			$objPHPExcel->getProperties()->setLastModifiedBy("1jobs.com");		//����޸���
			$objPHPExcel->getProperties()->setTitle("Office 2003 XLSX Test Document");		//����			
			$objPHPExcel->getProperties()->setSubject("Office 2003 XLSX Test Document");	//��Ŀ			
			$objPHPExcel->getProperties()->setDescription("Test document for Office 2003 XLSX.");	//����			
			$objPHPExcel->getProperties()->setKeywords("office 2003 openxml php");		//�ؼ���			
			$objPHPExcel->getProperties()->setCategory("Test result file");				//����
			$objPHPExcel->setActiveSheetIndex(0);	
			//����excel���ļ���
			//����sheet��name
			$objPHPExcel->getActiveSheet()->setTitle($this->convertUTF8($name));
			//�����п�Ϊ�Զ�
			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(45);
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(18);
			$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(18);
			$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(18);
			$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(22);
			//����-------------------------------------------------------------------------------
			foreach ($title as $k=>$v) {
				$objPHPExcel->getActiveSheet()->setCellValue($k."1", $this->convertUTF8($v));
				$objPHPExcel->getActiveSheet()->getStyle($k."1")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
				$objPHPExcel->getActiveSheet()->getStyle($k."1")->getFill()->getStartColor()->setARGB('FFDFEDF7');
			}
			//����-------------------------------------------------------------------------------
			foreach ($data as $k=>$v) {
				$k=$k+2;
				$objPHPExcel->getActiveSheet()->setCellValue("A".$k, $this->convertUTF8($v['username']));
				$objPHPExcel->getActiveSheet()->setCellValue("B".$k, $this->convertUTF8($v['title']));
				$objPHPExcel->getActiveSheet()->setCellValue("C".$k, $this->convertUTF8($v['xs_user']));
				$objPHPExcel->getActiveSheet()->setCellValue("D".$k, $this->convertUTF8($v['dq']));
				$objPHPExcel->getActiveSheet()->setCellValue("E".$k, $this->convertUTF8($v['qq']));
				$objPHPExcel->getActiveSheet()->setCellValue("F".$k, $this->convertUTF8($v['phone']));
				$objPHPExcel->getActiveSheet()->setCellValue("G".$k, $this->convertUTF8($v['email']));
				$objPHPExcel->getActiveSheet()->setCellValue("H".$k, $this->convertUTF8($v['bl']));
				$objPHPExcel->getActiveSheet()->setCellValue("I".$k, $this->convertUTF8(date('Y-m-d H:i:s',$v['addtime'])));
			}
			//ֱ������������
			$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
			header("Pragma: public");
			header("Expires: 0");
			header("Cache-Control:must-revalidate, post-check=0, pre-check=0");
			header("Content-Type:application/force-download");
			header("Content-Type:application/vnd.ms-execl");
			header("Content-Type:application/octet-stream");
			header("Content-Type:application/download");
			header('Content-Disposition:attachment;filename="'.$name.'.xls"');
			header("Content-Transfer-Encoding:binary");
			$objWriter->save('php://output');

		}
		/*-------------------------------------------------------------------------*/
		//��ҵ��˾�ѽ�Ԥ����չ����������
		function qyzhanghui(){
			if(!empty($_GET['id'])){
				$zid="select zid from vip_zhanhui where vip_zhanhui.qid=".$_GET['id'];
				$sql="select b.id,a.zid,a.qid,a.username,a.title,b.title as qytitle,a.xs_user,a.number,a.add_time,b.holddates,a.online_aoto,a.yhtype,a.subsite_id from vip_zhanhui as a left join qs_jobfair as b on a.zid=b.id where b.id in(".$zid.") and a.qid='".$_GET['id']."'";
				$data=D("qs_jobfair")->query($sql,"select");
				$site=D("qs_subsite")->field("s_id,s_districtname")->select();
					foreach($data as $i=>$v){
						$data[$i]['dq']="ȫվ";
						foreach ($site as $k=>$s){
							if($s['s_id']==$data[$i]['subsite_id']){
								$data[$i]['dq']=$s['s_districtname'];
							}
						}
						//-------------------------------------------
						if($v['yhtype']==1){
							$data[$i]['yhtype']="�ײ��û�";
						}
						if($v['yhtype']==2){
							$data[$i]['yhtype']="�����û�";
						}
						if($v['yhtype']==3){
							$data[$i]['yhtype']="��ʱ�û�";
						}
						//-------------------------------------------
						if($v['online_aoto']==1){
							$data[$i]['online_aoto']="�Զ�Ԥ��";
						}
						if($v['online_aoto']==2){
							$data[$i]['online_aoto']="����Ԥ��";
						}
						if($v['online_aoto']==3){
							$data[$i]['online_aoto']="�ֶ����";
						}
						//--------------------------------------------
					}
				//p($data);
				$name=$data[0]['title']."-".date('Y-m-d',time());
							 
				$title=array("A"=>"��Ƹ�����",
							 "B"=>"�ٰ�ʱ��",
							 "C"=>"��ҵ��˾��",
							 "D"=>"���۴���",
							 "E"=>"����",
							 "F"=>"չλ��",
							 "G"=>"�û�����",
							 "H"=>"Ԥ����ʽ",
							 "I"=>"Ԥ��ʱ��"
							 );
				
				$this->exzh($name,$title,$data);
				}
			}
			//��ҵ��˾�ѽ�Ԥ����չ�����������Excel
			function exzh($name,$title,$data){
					include 'PHPExcel.php';
					include 'PHPExcel/Writer/Excel5.php'; 		//�������.xls��
					//����һ��excel
					$objPHPExcel = new PHPExcel();			
					//����excel�����ԣ�
					$objPHPExcel->getProperties()->setCreator("1jobs.com");				//������
					$objPHPExcel->getProperties()->setLastModifiedBy("1jobs.com");		//����޸���
					$objPHPExcel->getProperties()->setTitle("Office 2003 XLSX Test Document");		//����			
					$objPHPExcel->getProperties()->setSubject("Office 2003 XLSX Test Document");	//��Ŀ			
					$objPHPExcel->getProperties()->setDescription("Test document for Office 2003 XLSX.");	//����			
					$objPHPExcel->getProperties()->setKeywords("office 2003 openxml php");		//�ؼ���			
					$objPHPExcel->getProperties()->setCategory("Test result file");				//����
					$objPHPExcel->setActiveSheetIndex(0);	
					//����excel���ļ���
					//����sheet��name
					$objPHPExcel->getActiveSheet()->setTitle($this->convertUTF8($name));
					//�����п�Ϊ�Զ�
					$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(45);
					$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
					$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(40);
					$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(10);
					$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(12);
					$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
					$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(16);
					$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(16);
					$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(22);
					//����-------------------------------------------------------------------------------
					foreach ($title as $k=>$v) {
						$objPHPExcel->getActiveSheet()->setCellValue($k."1", $this->convertUTF8($v));
						$objPHPExcel->getActiveSheet()->getStyle($k."1")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
						$objPHPExcel->getActiveSheet()->getStyle($k."1")->getFill()->getStartColor()->setARGB('FFDFEDF7');
					}
					//����-------------------------------------------------------------------------------
					foreach ($data as $k=>$v) {
						$k=$k+2;
						$objPHPExcel->getActiveSheet()->setCellValue("A".$k, $this->convertUTF8($v['qytitle']));
						$objPHPExcel->getActiveSheet()->setCellValue("B".$k, $this->convertUTF8(date('Y-m-d',$v['holddates'])));
						$objPHPExcel->getActiveSheet()->setCellValue("C".$k, $this->convertUTF8($v['title']));
						$objPHPExcel->getActiveSheet()->setCellValue("D".$k, $this->convertUTF8($v['xs_user']));
						$objPHPExcel->getActiveSheet()->setCellValue("E".$k, $this->convertUTF8($v['dq']));
						$objPHPExcel->getActiveSheet()->setCellValue("F".$k, " ".$this->convertUTF8($v['number']));
						$objPHPExcel->getActiveSheet()->setCellValue("G".$k, $this->convertUTF8($v['yhtype']));
						$objPHPExcel->getActiveSheet()->setCellValue("H".$k, $this->convertUTF8($v['online_aoto']));
						$objPHPExcel->getActiveSheet()->setCellValue("I".$k, $this->convertUTF8(date('Y-m-d H:i:s',$v['add_time'])));
					}
					//ֱ������������
					$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
					header("Pragma: public");
					header("Expires: 0");
					header("Cache-Control:must-revalidate, post-check=0, pre-check=0");
					header("Content-Type:application/force-download");
					header("Content-Type:application/vnd.ms-execl");
					header("Content-Type:application/octet-stream");
					header("Content-Type:application/download");
					header('Content-Disposition:attachment;filename="'.$name.'.xls"');
					header("Content-Transfer-Encoding:binary");
					$objWriter->save('php://output');
		}
		/*-------------------------------------------------------------------------*/
		//ת�뺯��------------------------------------------------------------------
 		function convertUTF8($str){
		   if(empty($str)) return '';
		   return  iconv('gb2312', 'utf-8', $str);
		}

}