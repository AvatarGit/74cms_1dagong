<?php
/** ******************************************************************************
 * brophp.com �Ự����Session�࣬���ڽ�Session���ݱ�����Memcached�������С�      *
 * *******************************************************************************
 * ���������רΪ��ϸ˵PHP�����߼�LAMP�ֵ���ѧԱ�ṩ�ġ�ѧϰ�͡���������php��ܡ�*
 * *******************************************************************************
 * ��Ȩ���� (C) 2011-2013 �����׵��Ž�����ѯ���޹�˾������������Ȩ����           *
 * ��վ��ַ: http://www.lampbrother.net (LAMP�ֵ���)                             *
 * *******************************************************************************
 * $Author: ����� (skygao@lampbrother.net) $                                    *
 * $Date: 2011-07-18 10:00:00 $                                                  * 
 * ******************************************************************************/
	class MemSession {
		private static $handler=null;
		private static $lifetime=null;
		private static $time = null;
		/**
		 * ��ʹ���Ϳ���session
		 * @param	Memcache	$memcache	memcache����
		 */
		public static function start(Memcache $memcache){
 			//�� session.save_handler ����Ϊ user��������Ĭ�ϵ� files
			ini_set('session.save_handler', 'user');
			
			//��ʹ�� GET/POST ������ʽ
			//ini_set('session.use_trans_sid',    0);

        		//�������������������ʱ��
        		//ini_set('session.gc_maxlifetime',  3600);

       			 //ʹ�� COOKIE ���� SESSION ID �ķ�ʽ
       			//ini_set('session.use_cookies',      1);
        		//ini_set('session.cookie_path',      '/');

       			 //������������ SESSION ID �� COOKIE
        		//ini_set('session.cookie_domain','.lampbrother.net');


			self::$handler=$memcache;
			self::$lifetime=ini_get('session.gc_maxlifetime');
			self::$time=time();
			session_set_save_handler(
					array(__CLASS__, 'open'),
					array(__CLASS__, 'close'),
					array(__CLASS__, 'read'),
					array(__CLASS__, 'write'),
					array(__CLASS__, 'destroy'),
					array(__CLASS__, 'gc')
				);
			session_start();
			return true;
		}

	
		public static function open($path, $name){
			return true;
		}

		public static function close(){
			return true;
		}
		/**
		 * ��SESSION�ж�ȡ����
		 * @param	string	$PHPSESSID	session��ID
		 * @return 	mixed			����session�ж�Ӧ������
		 */
		public static function read($PHPSESSID){
			$out=self::$handler->get(self::session_key($PHPSESSID));

			if($out===false || $out == null)
				return '';

			return $out;
		}
		/**
		 *��session���������
		 */
		public static function write($PHPSESSID, $data){
			
			$method=$data ? 'set' : 'replace';
		
			return self::$handler->$method(self::session_key($PHPSESSID), $data, MEMCACHE_COMPRESSED, self::$lifetime);
		}

		public static function destroy($PHPSESSID){
			return self::$handler->delete(self::session_key($PHPSESSID));
		}

		public static function gc($lifetime){
			//����������,memcache���Լ��Ĺ��ڻ��ջ���
			return true;
		}

		private static function session_key($PHPSESSID){
			$session_key=TABPREFIX.$PHPSESSID;

			return $session_key;
		}	
	}

