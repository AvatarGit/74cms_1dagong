<?php
/** ******************************************************************************
 * brophp.com �������Ļ��࣬����ģ��Ͳ������Լ��ṩһЩ�ڲ�����ʹ�õĹ��÷����� *
 * *******************************************************************************
 * ���������רΪ��ϸ˵PHP�����߼�LAMP�ֵ���ѧԱ�ṩ�ġ�ѧϰ�͡���������php��ܡ�*
 * *******************************************************************************
 * ��Ȩ���� (C) 2011-2013 �����׵��Ž�����ѯ���޹�˾������������Ȩ����           *
 * ��վ��ַ: http://www.lampbrother.net (LAMP�ֵ���)                             *
 * *******************************************************************************
 * $Author: ����� (skygao@lampbrother.net) $                                    *
 * $Date: 2011-07-18 10:00:00 $                                                  * 
 * ******************************************************************************/
	class Action extends MyTpl{
		/**
		 * �÷����������п���еĲ���������brophp.php����ļ��е���
		 */
		function run(){
			if($this->left_delimiter!="<{")
				parent::__construct();	

			
			//���������Common������������init()���� ��Ȩ�޿���
			if(method_exists($this, "init")){
				$this->init();
			}

			//���ݶ���ȥ�Ҷ�Ӧ�ķ���
			$method=$_GET["a"];
			if(method_exists($this, $method)){
				$this->$method();
			}else{
				Debug::addmsg("<font color='red'>û��{$_GET["a"]}���������</font>");
			}	
		}

		/** 
		 * �����ڿ������н���λ���ض���
		 * @param	string	$path	���������ض����λ��
		 * @param	string	$args 	�����ض�����λ�ú󴫵ݲ���
		 * 
		 * $this->redirect("index")  /��ǰģ��/index
		 * $this->redirect("user/index") /user/index
		 * $this->redirect("user/index", 'page/5') /user/index/page/5
		 */
		function redirect($path, $args=""){
			$path=trim($path, "/");
			if($args!="")
				$args="/".trim($args, "/");
			if(strstr($path, "/")){
				$url=$path.$args;
			}else{
				$url=$_GET["m"]."/".$path.$args;
			}

			$uri=$GLOBALS["app"].$url;
			//ʹ��js��תǰ����������
			echo '<script>';
			echo 'location="'.$uri.'"';
			echo '</script>';
		}

		/**
		 * �ɹ�����Ϣ��ʾ��
		 * @param	string	$mess		��ʾ�����ʾ��Ϣ
		 * @param	int	$timeout	������ת��ʱ�䣬��λ����
		 * @param	string	$location	������ת����λ��
		 */
		function success($mess="�����ɹ�", $timeout=1, $location=""){
			$this->pub($mess, $timeout, $location);
			$this->assign("mark", true);  //����ɹ� $mark=true
			Debug::me();		//ִ��д����־
			$this->display("public/success");
			exit;
		}
		/**
		 * ʧ�ܵ���Ϣ��ʾ��
		 * @param	string	$mess		��ʾ�����ʾ��Ϣ
		 * @param	int	$timeout	������ת��ʱ�䣬��λ����
		 * @param	string	$location	������ת����λ��
		 */
		function error($mess="����ʧ��", $timeout=3, $location=""){
			$this->pub($mess, $timeout, $location);
			$this->assign("mark", false); //���ʧ�� $mark=false
			Debug::me();		//ִ��д����־
			$this->display("public/success");
			exit;
		}

		private function pub($mess, $timeout, $location){	
			$this->caching=0;     //���û���ر�
			if($location==""){
				$location="window.history.back();";
			}else{
				$path=trim($location, "/");
			
				if(strstr($path, "/")){
					$url=$path;
				}else{
					$url=$_GET["m"]."/".$path;
				}
				$location=$GLOBALS["app"].$url;
				$location="window.location='{$location}'";
			}
			$this->assign("mess", $mess);
			$this->assign("timeout", $timeout);
			$this->assign("location", $location);
			$GLOBALS["debug"]=0;
		}
		
		//-------------------------------------------------------------------------------------------
		function ok($mess="�����ɹ�", $timeout=1, $location=""){
			$this->qqpub($mess, $timeout, $location);
			$this->assign("mark", true);  //����ɹ� $mark=true
			Debug::me();		//ִ��д����־
			$this->display("public/success");
			exit;
		}
		function xw($mess="�����ɹ�", $timeout=1, $location=""){
			$this->qqpub($mess, $timeout, $location);
			$this->assign("mark", false);  //����ɹ� $mark=true
			Debug::me();		//ִ��д����־
			$this->display("public/success");
			exit;
		}
		//-------------------------------------------------------
		private function qqpub($mess, $timeout, $location){	
			$this->caching=0;     //���û���ر�
			$location="window.location='{$location}'";
			$this->assign("mess", $mess);
			$this->assign("timeout", $timeout);
			$this->assign("location", $location);
			$GLOBALS["debug"]=0;
		}
	}
