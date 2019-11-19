<?php
/** ******************************************************************************
 * brophp.com �ڴ滺��Memcached�࣬���ڽ�SQL���Ĳ�ѯ���������ָ���������ڴ��� *
 * *******************************************************************************
 * ���������רΪ��ϸ˵PHP�����߼�LAMP�ֵ���ѧԱ�ṩ�ġ�ѧϰ�͡���������php��ܡ�*
 * *******************************************************************************
 * ��Ȩ���� (C) 2011-2013 �����׵��Ž�����ѯ���޹�˾������������Ȩ����           *
 * ��վ��ַ: http://www.lampbrother.net (LAMP�ֵ���)                             *
 * *******************************************************************************
 * $Author: ����� (skygao@lampbrother.net) $                                    *
 * $Date: 2011-07-18 10:00:00 $                                                  * 
 * ******************************************************************************/
	class MemcacheModel {
		private $mc = null;
		/**
		 * ���췽��,������ӷ�����������memcahced����
		 */
		function __construct(){
			$params = func_get_args();
			$mc = new Memcache;
			//����ж��memcache������
			if( count($params) > 1){
				foreach ($params as $v){
					call_user_func_array(array($mc, 'addServer'), $v);
				}
			//���ֻ��һ��memcache������
			} else {
				call_user_func_array(array($mc, 'addServer'), $params[0]);
			
			}
			$this->mc=$mc;
		}
		/**
		 * ��ȡmemcached����
		 * @return	object		memcached����
		 */
		function getMem(){
			return $this->mc;
		}
		/**
		 * ���mem�Ƿ����ӳɹ�
		 * @return	bool	���ӳɹ�����true,���򷵻�false
		 */
		function mem_connect_error(){
			$stats=$this->mc->getStats();
			if(empty($stats)){
				return false;
			}else{
				return true;
			}
		}

		private function addKey($tabName, $key){
			
			$keys=$this->mc->get($tabName);
			if(empty($keys)){
				$keys=array();
			}
			//���key������,�����һ��
			if(!in_array($key, $keys)) {
				$keys[]=$key;  //���µ�key��ӵ������keys��
				$this->mc->set($tabName, $keys, MEMCACHE_COMPRESSED, 0);
				return true;   //�����ڷ���true
			}else{
				return false;  //���ڷ���false
			}
		}
		/**
		 * ��memcache���������
		 * @param	string	$tabName	��Ҫ�������ݱ�ı���
		 * @param	string	$sql		ʹ��sql��Ϊmemcache��key
		 * @param	mixed	$data		��Ҫ���������
		 */
		function addCache($tabName, $sql, $data){
		
			$key=md5($sql);
			//���������
			if($this->addKey($tabName, $key)){
				$this->mc->set($key, $data, MEMCACHE_COMPRESSED, 0);
			}
		}
		/**
		 * ��ȡmemcahce�б��������
		 * @param	string	$sql	ʹ��SQL��key
		 * @return 	mixed		���ػ����е�����
		 */
		function getCache($sql){
			$key=md5($sql);
			return $this->mc->get($key);
		}


		/**
		 * ɾ����ͬһ������ص����л���
		 * @param	string	$tabName	���ݱ�ı���
		 */ 
		function delCache($tabName){
			$keys=$this->mc->get($tabName);
		
			//ɾ��ͬһ��������л���
			if(!empty($keys)){
				foreach($keys as $key){
					$this->mc->delete($key, 0); //0 ��ʾ����ɾ��
				}
			}
			//ɾ���������sql��key
			$this->mc->delete($tabName, 0); 
		}
		/**
		 * ɾ������һ�����Ļ���
		 * @param	string	$sql ִ�е�SQL���
		 */
		function delone($sql){
			$key=md5($sql);
			$this->mc->delete($key, 0); //0 ��ʾ����ɾ��
		}
	}
