<?php
/** ******************************************************************************
 * brophp.com ģ������Smarty�����չ�����ڳ�ʹ����Ա���Ժ�����Smarty���еķ����� * 
 * *******************************************************************************
 * ���������רΪ��ϸ˵PHP�����߼�LAMP�ֵ���ѧԱ�ṩ�ġ�ѧϰ�͡���������php��ܡ�*
 * *******************************************************************************
 * ��Ȩ���� (C) 2011-2013 �����׵��Ž�����ѯ���޹�˾������������Ȩ����           *
 * ��վ��ַ: http://www.lampbrother.net (LAMP�ֵ���)                             *
 * *******************************************************************************
 * $Author: ����� (skygao@lampbrother.net) $                                    *
 * $Date: 2011-07-18 10:00:00 $                                                  * 
 * ******************************************************************************/
	class Mytpl extends Smarty {
		/**
		 * ���췽�������ڳ�ʹ��Smarty�����еĳ�Ա����
		 *
		 */
		function __construct(){
			$this->template_dir=APP_PATH."views/".TPLSTYLE;  //ģ��Ŀ¼
			$this->compile_dir=PROJECT_PATH."runtime/comps/".TPLSTYLE."/".TMPPATH;    //����ļ����Զ����ɵģ��ϳɵ��ļ�
			$this->caching=CSTART;     //���û��濪��
			$this->cache_dir=PROJECT_PATH."runtime/cache/".TPLSTYLE;  //���û����Ŀ¼
			$this->cache_lifetime=CTIME;  //���û����ʱ�� 
			$this->left_delimiter="<{";   //ģ���ļ���ʹ�õġ��󡱷ָ�����
			$this->right_delimiter="}>";   //ģ���ļ���ʹ�õġ��ҡ��ָ�����
			parent::__construct();         //���ø��౻���ǵĹ��췽��
		}

		/*
		 * ���ظ���Smarty���еķ���
		 * @param	string	$resource_name	ģ���λ��
		 * @param	mixed	$cache_id	�����ID
		 */
		function display($resource_name=null, $cache_id = null, $compile_id = null) {

			//������ȫ�ֱ���ֱ�ӷ��䵽ģ����ʹ��	
			$this->assign("root", rtrim($GLOBALS["root"], "/"));
			$this->assign("app", rtrim($GLOBALS["app"], "/"));
			$this->assign("url", rtrim($GLOBALS["url"], "/"));
			$this->assign("public", rtrim($GLOBALS["public"], "/"));
			$this->assign("res", rtrim($GLOBALS["res"], "/"));
		
			if(is_null($resource_name)){
				$resource_name="{$_GET["m"]}/{$_GET["a"]}.".TPLPREFIX;
			}else if(strstr($resource_name,"/")){
				$resource_name=$resource_name.".".TPLPREFIX;
			}else{
				$resource_name=$_GET["m"]."/".$resource_name.".".TPLPREFIX;
			}
			Debug::addmsg("ʹ��ģ�� <b> $resource_name </b>");
			parent::display($resource_name, $cache_id, $compile_id);	
		}
		/* 
		 * ���ظ����Smarty���еķ���
		 * @param	string	$tpl_file	ģ���ļ�
		 * @param	mixed	$cache_id	�����ID
		 */
		function is_cached($tpl_file=null, $cache_id = null, $compile_id = null) {
			if(is_null($tpl_file)){
				$tpl_file="{$_GET["m"]}/{$_GET["a"]}.".TPLPREFIX;
			}else if(strstr($tpl_file,"/")){
				$tpl_file=$tpl_file.".".TPLPREFIX;
			}else{
				$tpl_file=$_GET["m"]."/".$tpl_file.".".TPLPREFIX;
			}
			return parent::is_cached($tpl_file, $cache_id, $compile_id);
		}

		/* 
		 * ���ظ����Smarty���еķ���
		 *  @param	string	$tpl_file	ģ���ļ�
		 * @param	mixed	$cache_id	�����ID
		 */

		function clear_cache($tpl_file = null, $cache_id = null, $compile_id = null, $exp_time = null){
			if(is_null($tpl_file)){
				$tpl_file="{$_GET["m"]}/{$_GET["a"]}.".TPLPREFIX;
			}else if(strstr($tpl_file,"/")){
				$tpl_file=$tpl_file.".".TPLPREFIX;
			}else{
				$tpl_file=$_GET["m"]."/".$tpl_file.".".TPLPREFIX;
			}
			return parent::clear_cache($tpl_file = null, $cache_id = null, $compile_id = null, $exp_time = null);
		}
	}
