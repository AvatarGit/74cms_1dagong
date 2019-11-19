<?php
/** ******************************************************************************
 * brophp.com ������õĺ������ļ�������������ļ��еĺ��������κ�λ��ֱ�ӵ��á� *
 * *******************************************************************************
 * ���������רΪ��ϸ˵PHP�����߼�LAMP�ֵ���ѧԱ�ṩ�ġ�ѧϰ�͡���������php��ܡ�*
 * *******************************************************************************
 * ��Ȩ���� (C) 2011-2013 �����׵��Ž�����ѯ���޹�˾������������Ȩ����           *
 * ��վ��ַ: http://www.lampbrother.net (LAMP�ֵ���)                             *
 * *******************************************************************************
 * $Author: ����� (skygao@lampbrother.net) $                                    *
 * $Date: 2011-07-18 10:00:00 $                                                  * 
 * ******************************************************************************/

	/*
	 * ����������͵����ݣ����Գ���ʱ��ӡ����ʹ�á�
	 * ������������һ���������������ֵ
	 */
	function p(){
		$args=func_get_args();  //��ȡ�������
		if(count($args)<1){
			Debug::addmsg("<font color='red'>����Ϊp()�����ṩ����!");
			return;
		}	

		echo '<div style="width:100%;text-align:left"><pre>';
		//�������ѭ�����
		foreach($args as $arg){
			if(is_array($arg)){  
				print_r($arg);
				echo '<br>';
			}else if(is_string($arg)){
				echo $arg.'<br>';
			}else{
				var_dump($arg);
				echo '<br>';
			}
		}
		echo '</pre></div>';	
	}
	/*
	 * ����Models�е����ݿ��������
	 * $className ����
	 * $app Ӧ���� ��������Ӧ�õ�Model
	 */
	function D($className=null,$app=""){
		$db=null;	
		//���û�д���������������ֱ�Ӵ���DB���󣬵����ܶԱ���в���
		if(is_null($className)){
			$class="D".DRIVER;

			$db=new $class;
		}else{
			$className=strtolower($className);
			$model=Structure::model($className, $app);	
			$model=new $model();

			//�����ṹ�����ڣ����ȡ��ṹ
			$model->setTable($className);		
		

			$db=$model;
		}
		if($app=="")
			$db->path=APP_PATH;
		else
			$db->path=PROJECT_PATH.strtolower($app).'/';
		return $db;
	}
	/*
	 * �ļ��ߴ�ת��������С���ֽ�תΪ���ֵ�λ��С
	 * ����$bytes���ֽڴ�С
	 */
	function tosize($bytes) {       	 	     //�Զ���һ���ļ���С��λת������
		if ($bytes >= pow(2,40)) {      		     //����ṩ���ֽ������ڵ���2��40�η�������������
			$return = round($bytes / pow(1024,4), 2);    //���ֽڴ�Сת��Ϊͬ�ȵ�T��С
			$suffix = "TB";                        	     //��λΪTB
		} elseif ($bytes >= pow(2,30)) {  		     //����ṩ���ֽ������ڵ���2��30�η�������������
			$return = round($bytes / pow(1024,3), 2);    //���ֽڴ�Сת��Ϊͬ�ȵ�G��С
			$suffix = "GB";                              //��λΪGB
		} elseif ($bytes >= pow(2,20)) {  		     //����ṩ���ֽ������ڵ���2��20�η�������������
			$return = round($bytes / pow(1024,2), 2);    //���ֽڴ�Сת��Ϊͬ�ȵ�M��С
			$suffix = "MB";                              //��λΪMB
		} elseif ($bytes >= pow(2,10)) {  		     //����ṩ���ֽ������ڵ���2��10�η�������������
			$return = round($bytes / pow(1024,1), 2);    //���ֽڴ�Сת��Ϊͬ�ȵ�K��С
			$suffix = "KB";                              //��λΪKB
		} else {                     			     //�����ṩ���ֽ���С��2��10�η�������������
			$return = $bytes;                            //�ֽڴ�С��λ����
			$suffix = "Byte";                            //��λΪByte
		}
		return $return ." " . $suffix;                       //���غ��ʵ��ļ���С�͵�λ
	}

