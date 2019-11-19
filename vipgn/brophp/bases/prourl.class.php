<?php
/** ******************************************************************************
 * brophp.com URL�����࣬���ڽ����������URLתΪPATHINFO�ĸ�ʽ��                 *
 * *******************************************************************************
 * ���������רΪ��ϸ˵PHP�����߼�LAMP�ֵ���ѧԱ�ṩ�ġ�ѧϰ�͡���������php��ܡ�*
 * *******************************************************************************
 * ��Ȩ���� (C) 2011-2013 �����׵��Ž�����ѯ���޹�˾������������Ȩ����           *
 * ��վ��ַ: http://www.lampbrother.net (LAMP�ֵ���)                             *
 * *******************************************************************************
 * $Author: ����� (skygao@lampbrother.net) $                                    *
 * $Date: 2011-07-18 10:00:00 $                                                  * 
 * ******************************************************************************/
	class Prourl {
		/**
		 * URL·��,תΪPATHINFO�ĸ�ʽ
		 */ 
		static function parseUrl(){
			if (isset($_SERVER['PATH_INFO'])){
      			 	//��ȡ pathinfo
				$pathinfo = explode('/', trim($_SERVER['PATH_INFO'], "/"));
			
       				// ��ȡ control
       				$_GET['m'] = (!empty($pathinfo[0]) ? $pathinfo[0] : 'index');

       				array_shift($pathinfo); //�����鿪ͷ�ĵ�Ԫ�Ƴ����� 
      				
			       	// ��ȡ action
       				$_GET['a'] = (!empty($pathinfo[0]) ? $pathinfo[0] : 'index');
				array_shift($pathinfo); //�ٽ������鿪ͷ�ĵ�Ԫ�Ƴ����� 

				for($i=0; $i<count($pathinfo); $i+=2){
					$_GET[$pathinfo[$i]]=$pathinfo[$i+1];
				}
			
			}else{	
				$_GET["m"]= (!empty($_GET['m']) ? $_GET['m']: 'index');    //Ĭ����indexģ��
				$_GET["a"]= (!empty($_GET['a']) ? $_GET['a'] : 'index');   //Ĭ����index����
	
				if($_SERVER["QUERY_STRING"]){
					$m=$_GET["m"];
					unset($_GET["m"]);  //ȥ�������е�m
					$a=$_GET["a"];
					unset($_GET["a"]);  //ȥ�������е�a
					$query=http_build_query($_GET);   //�γ�0=foo&1=bar&2=baz&3=boom&cow=milk��ʽ
					//����µ�URL
					$url=$_SERVER["SCRIPT_NAME"]."/{$m}/{$a}/".str_replace(array("&","="), "/", $query);
					header("Location:".$url);
				}	
			}
		}
	}
