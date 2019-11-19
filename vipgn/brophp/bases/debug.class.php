<?php
/** ******************************************************************************
 * brophp.com ����ģʽ�࣬�����ڿ����׶ε��Գ���ʹ�á�                           *
 * *******************************************************************************
 * ���������רΪ��ϸ˵PHP�����߼�LAMP�ֵ���ѧԱ�ṩ�ġ�ѧϰ�͡���������php��ܡ�*
 * *******************************************************************************
 * ��Ȩ���� (C) 2011-2013 �����׵��Ž�����ѯ���޹�˾������������Ȩ����           *
 * ��վ��ַ: http://www.lampbrother.net (LAMP�ֵ���)                             *
 * *******************************************************************************
 * $Author: ����� (skygao@lampbrother.net) $                                    *
 * $Date: 2011-07-18 10:00:00 $                                                  * 
 * ******************************************************************************/
	class Debug {
		static $includefile=array();
		static $info=array();
		static $sqls=array();
		static $sqlx=array();			  //����sql�����־����
		static $startTime;                //����ű���ʼִ��ʱ��ʱ�䣨��΢�����ʽ���棩
		static $stopTime;                //����ű�����ִ��ʱ��ʱ�䣨��΢�����ʽ���棩
		
		static $msg = array(
       			 E_WARNING=>'����ʱ����',
       			 E_NOTICE=>'����ʱ����',
        		 E_STRICT=>'�����׼������',
        		 E_USER_ERROR=>'�Զ������',
        		 E_USER_WARNING=>'�Զ��徯��',
        		 E_USER_NOTICE=>'�Զ�������',
        		 'Unkown '=>'δ֪����'
		 );

		/**
		 * �ڽű���ʼ�����û�ȡ�ű���ʼʱ���΢��ֵ
		 */
		static function start(){                       
			self::$startTime = microtime(true);   //����ȡ��ʱ�丳����Ա����$startTime
		}
		/**
		 *�ڽű����������û�ȡ�ű�����ʱ���΢��ֵ
		 */
		static function stop(){
			self::$stopTime= microtime(true);   //����ȡ��ʱ�丳����Ա����$stopTime
		}

		/**
		 *����ͬһ�ű������λ�ȡʱ��Ĳ�ֵ
		 */
		static function spent(){
			return round((self::$stopTime - self::$startTime) , 4);  //�������4��5�뱣��4λ����
		}

    		/*���� handler*/
   		static function Catcher($errno, $errstr, $errfile, $errline){
	   		if(!isset(self::$msg[$errno])) 
				$errno='Unkown';

			if($errno==E_NOTICE || $errno==E_USER_NOTICE)
				$color="#000088";
			else
				$color="red";

	   		$mess='<font color='.$color.'>';
	   		$mess.='<b>'.self::$msg[$errno]."</b>[���ļ� {$errfile} ��,�� $errline ��]:";
	   		$mess.=$errstr;
	   		$mess.='</font>'; 		
	  		self::addMsg($mess);
		}
		/**
		 * ��ӵ�����Ϣ
		 * @param	string	$msg	������Ϣ�ַ���
		 * @param	int	$type	��Ϣ������
		 */
		static function addmsg($msg,$type=0) {
			if(defined("DEBUG") && DEBUG==1){
				switch($type){
					case 0:
						self::$info[]=$msg;
						break;
					case 1:
						self::$includefile[]=$msg;
						break;
					case 2:
						self::$sqls[]=$msg;
						break;
				}
			}
		}
		/**
		 * ���������Ϣ
		 */
		static function message(){
			echo '<div style="float:left;clear:both;text-align:left;font-size:11px;color:#888;width:95%;margin:10px;padding:10px;background:#F5F5F5;border:1px dotted #778855;z-index:100">';
			echo '<div style="float:left;width:100%;"><span style="float:left;width:200px;"><b>������Ϣ</b>( <font color="red">'.self::spent().' </font>��):</span><span onclick="this.parentNode.parentNode.style.display=\'none\'" style="cursor:pointer;float:right;width:35px;background:#500;border:1px solid #555;color:white">�ر�X</span></div><br>';
			echo '<ul style="margin:0px;padding:0 10px 0 10px;list-style:none">';
			if(count(self::$includefile) > 0){
				echo '���Զ�������';
				foreach(self::$includefile as $file){
					echo '<li>&nbsp;&nbsp;&nbsp;&nbsp;'.$file.'</li>';
				}		
			}
			if(count(self::$info) > 0 ){
				echo '<br>��ϵͳ��Ϣ��';
				foreach(self::$info as $info){
					echo '<li>&nbsp;&nbsp;&nbsp;&nbsp;'.$info.'</li>';
				}
			}

			if(count(self::$sqls) > 0) {
				echo '<br>��SQL����';
				foreach(self::$sqls as $sql){
					echo '<li>&nbsp;&nbsp;&nbsp;&nbsp;'.$sql.'</li>';
				}
			}
			echo '</ul>';
			echo '</div>';	
		}
		
		//------------------------------------------------------------------------------
		/**
		 * 
		 * @param	string	$msg	������Ϣ�ַ���
		 */
		static function addm($msg) {
				self::$sqlx[]=$msg;
		}
		//-------------------------------
		static function me(){
			$data="";
			//p(self::$sqlx);
			foreach(self::$sqlx as $sql){
				if(!strstr($sql,"SELECT") && !strstr($sql,"select")){
						$data.=$sql."<br />";
				}
			}
			
			if($data!=''){
				$_POST['name']=$_COOKIE["name"];
				$_POST['ip']=GetIP();
				$_POST['time']=time();
				$_POST['sqlx']=$data;
				D('rizhi')->insert($_POST,0);
			}
		}
		
	}
