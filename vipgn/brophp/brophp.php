<?php	
/*********************************************************************************
 * brophp.com �������ļ������нű����Ǵ�����ļ���ʼִ�У���Ҫ��һЩȫ�����á� *
 * *******************************************************************************
 * ���������רΪ��ϸ˵PHP�����߼�LAMP�ֵ���ѧԱ�ṩ�ġ�ѧϰ�͡���������php��ܡ�*
 * *******************************************************************************
 * ��Ȩ���� (C) 2011-2013 �����׵��Ž�����ѯ���޹�˾������������Ȩ����           *
 * ��վ��ַ: http://www.lampbrother.net (LAMP�ֵ���)                             *
 * *******************************************************************************
 * $Author: ����� (skygao@lampbrother.net) $                                    *
 * $Date: 2011-07-18 10:00:00 $                                                  * 
 * ******************************************************************************/
	
	header("Content-Type:text/html;charset=gb2312");  //����ϵͳ������ַ�Ϊutf-8
	date_default_timezone_set("PRC");    		 //����ʱ�����й���

	//PHP����������Ҫ��·������ʹ�����·��
	define("BROPHP_PATH", rtrim(BROPHP, '/').'/');     //BroPHP��ܵ�·��
	define("APP_PATH", rtrim(APP,'/').'/');            //�û���Ŀ��Ӧ��·��
	define("PROJECT_PATH", dirname(BROPHP_PATH).'/');  //��Ŀ�ĸ�·����Ҳ���ǿ�����ڵ�Ŀ¼
	define("TMPPATH", str_replace(array(".", "/"), "_", ltrim($_SERVER["SCRIPT_NAME"], '/'))."/");
	
	//����ϵͳ�����ļ�
	$config=PROJECT_PATH."config.inc.php";
	if(file_exists($config)){
		include $config;
	}
	//����Debugģʽ
	if(defined("DEBUG") && DEBUG==1){
		$GLOBALS["debug"]=1;                 //����������debug
		error_reporting(E_ALL ^ E_NOTICE);   //�������ע������д��󱨸�
		include BROPHP_PATH."bases/debug.class.php";  //����debug��
		Debug::start();                               //�����ű�����ʱ��
		set_error_handler(array("Debug", 'Catcher')); //���ò���ϵͳ�쳣
	}else{
		ini_set('display_errors', 'Off'); 		//���δ������
		ini_set('log_errors', 'On');             	//����������־�������󱨸�д�뵽��־��
		ini_set('error_log', PROJECT_PATH.'runtime/error_log'); //ָ��������־�ļ�

	}
	//��������еĺ������ļ�
	include BROPHP_PATH.'commons/functions.inc.php';
	

	//����ȫ�ֵĺ������ļ����û������Լ����庯��������ļ���
	$funfile=PROJECT_PATH."commons/functions.inc.php";
	if(file_exists($funfile))
		include $funfile;

	
	//���ð���Ŀ¼�������ڵ�ȫ��Ŀ¼��,  PATH_SEPARATOR �ָ����� Linux(:) Windows(;)
	$include_path=get_include_path();                         //ԭ��Ŀ¼
	$include_path.=PATH_SEPARATOR.BROPHP_PATH."bases/";       //����л������ڵ�Ŀ¼
	$include_path.=PATH_SEPARATOR.BROPHP_PATH."classes/" ;    //�������չ���Ŀ¼
	$include_path.=PATH_SEPARATOR.BROPHP_PATH."libs/" ;       //ģ��Smarty���ڵ�Ŀ¼
	$include_path.=PATH_SEPARATOR.PROJECT_PATH."classes/";    //��Ŀ���õĵ��Ĺ�����
	$controlerpath=PROJECT_PATH."runtime/controls/".TMPPATH;  //���ɿ��������ڵ�·��
	$include_path.=PATH_SEPARATOR.$controlerpath;             //��ǰӦ�õĿ��������ڵ�Ŀ¼ 

	//����include�����ļ����ڵ�����Ŀ¼	
	set_include_path($include_path);

	//�Զ������� 	
	function __autoload($className){
		if($className=="memcache"){        //�����ϵͳ��Memcache���򲻰���
			return;
		}else if($className=="Smarty"){    //���������Smarty�࣬��ֱ�Ӱ���
			include "Smarty.class.php";
		}else{                             //����������࣬������תΪСд
			include strtolower($className).".class.php";	
		}
		Debug::addmsg("<b> $className </b>��", 1);  //��debug����ʾ�Զ���������
	}

	//�ж��Ƿ�����ҳ�澲̬������
	if(CSTART==0){
		Debug::addmsg("<font color='red'>û�п���ҳ�滺��!</font>��������ʹ�ã�"); 
	}else{
		Debug::addmsg("����ҳ�滺�棬ʵ��ҳ�澲̬��!"); 
	}
	
	//����memcache����
	if(!empty($memServers)){
		//�ж�memcache�����Ƿ�װ
		if(extension_loaded("memcache")){
			$mem=new MemcacheModel($memServers);
			//�ж�Memcache�������Ƿ����쳣
			if(!$mem->mem_connect_error()){
				Debug::addmsg("<font color='red'>����memcache������ʧ��,����!</font>"); //debug
			}else{
				define("USEMEM",true);
				Debug::addmsg("������Memcache");
			}
		}else{
			Debug::addmsg("<font color='red'>PHPû�а�װmemcache��չģ��,���Ȱ�װ!</font>"); //debug
		}	
	}else{
		Debug::addmsg("<font color='red'>û��ʹ��Memcache</font>(Ϊ����������ٶȣ�����ʹ��Memcache)");  //debug
	}

	//���Memcach���������ý�Session��Ϣ������Memcache��������
	if(defined("USEMEM")){
		MemSession::start($mem->getMem());
		Debug::addmsg("�����ỰSession (ʹ��Memcache����Ự��Ϣ)"); //debug

	}else{
		session_start();
		Debug::addmsg("<font color='red'>�����ỰSession </font>(��û��ʹ��Memcache������Memcache���Զ�ʹ��)"); //debug
	}
	Debug::addmsg("�ỰID:".session_id());
	
	Structure::create();   //��ʹ��ʱ��������Ŀ��Ŀ¼�ṹ
	Prourl::parseUrl();    //��������URL 

	//ģ���ļ�������Ҫ��·����html\css\javascript\image\link�����õ���·������WEB���������ĵ�����ʼ
	$spath=dirname($_SERVER["SCRIPT_NAME"]);
	if($spath=="/" || $spath=="\\")
		$spath="";
	$GLOBALS["root"]=$spath.'/'; //Web������������Ŀ�ĸ�
	$GLOBALS["app"]=$_SERVER["SCRIPT_NAME"].'/';           	//��ǰӦ�ýű��ļ�
	$GLOBALS["url"]=$GLOBALS["app"].$_GET["m"].'/';       //���ʵ���ǰģ��
	$GLOBALS["public"]=$GLOBALS["root"].'public/';        //��Ŀ��ȫ����ԴĿ¼
	$GLOBALS["res"]=$GLOBALS["root"].ltrim(APP_PATH, './')."views/".TPLSTYLE."/resource/"; //��ǰӦ��ģ�����Դ

	//�����������ڵ�·��
	$srccontrolerfile=APP_PATH."controls/".strtolower($_GET["m"]).".class.php";

	Debug::addmsg("��ǰ���ʵĿ�����������ĿӦ��Ŀ¼�µ�: <b>$srccontrolerfile</b> �ļ���");
	//��������Ĵ���
	if(file_exists($srccontrolerfile)){
		Structure::commoncontroler(APP_PATH."controls/",$controlerpath);
		Structure::controler($srccontrolerfile, $controlerpath, $_GET["m"]); 

		$className=ucfirst($_GET["m"])."Action";
		
		$controler=new $className();
		$controler->run();

	}else{
		Debug::addmsg("<font color='red'>�Բ���!����ʵ�ģ�鲻����,Ӧ����".APP_PATH."controlsĿ¼�´����ļ���Ϊ".strtolower($_GET["m"]).".class.php���ļ�������һ������Ϊ".ucfirst($_GET["m"])."���࣡</font>");
		
	}
	//�������Debugģʽ����Ϣ
	if(defined("DEBUG") && DEBUG==1 && $GLOBALS["debug"]==1){
		Debug::stop();
		Debug::message();
	}else{
		Debug::me();
	}



