<?php
/** ******************************************************************************
 * brophp.com �Զ���֤�࣬ͨ������XML�ļ�ʵ�ֶԱ��ڷ������˵��Զ���֤��        *
 * *******************************************************************************
 * ���������רΪ��ϸ˵PHP�����߼�LAMP�ֵ���ѧԱ�ṩ�ġ�ѧϰ�͡���������php��ܡ�*
 * *******************************************************************************
 * ��Ȩ���� (C) 2011-2013 �����׵��Ž�����ѯ���޹�˾������������Ȩ����           *
 * ��վ��ַ: http://www.lampbrother.net (LAMP�ֵ���)                             *
 * *******************************************************************************
 * $Author: ����� (skygao@lampbrother.net) $                                    *
 * $Date: 2011-07-18 10:00:00 $                                                  * 
 * ******************************************************************************/
	class Validate {
		static $data;
		static $action;
		static $msg;
		static $flag=true;
		static $db=null;
		/**
		 * ��ȡXML�ڱ�ǵ����ԣ�������ص��ڲ�����
		 * @param	resource	$xml_parser	XML����Դ
		 * @param	string		$tagName	���ݱ������
		 * @param	array		$args		XML��ǵ�����		
		 */
		static function start($xml_parser, $tagName, $args){
			if(isset($args["NAME"]) && isset($args["MSG"])) {
				if(empty($args["ACTION"]) || $args["ACTION"]=="both" || $args["ACTION"]==self::$action) {
					if(is_array(self::$data)) {
						if (array_key_exists($args["NAME"],self::$data)) {
							if(empty($args["TYPE"])){
								$method="regex";
							}else{
								$method=strtolower($args["TYPE"]);
							}
						
							if(in_array($method, get_class_methods(__CLASS__))){
								self::$method(self::$data[$args["NAME"]],$args["MSG"],$args["VALUE"],$args["NAME"]);
							}else{
								self::$msg[]="��֤�Ĺ���{$args["TYPE"]} �����ڣ����飡<br>";
								self::$flag=false;
							}
					
				
						}else{
							self::$msg[]="��֤���ֶ� {$args["NAME"]} �ͱ��е���������Ʋ���Ӧ<br>";
							self::$flag=false;
						}
					}
				}
			}
		
		}

		static function end($xml_parser, $tagName){
			return true;
		}	

		/**
		 * ����XML�ļ�
		 * @param	string	$filename	XML���ļ���
		 * @param	mixed	$data		�������������
		 * @param	string	$action		�û�ִ�еĲ���add��mod,Ĭ��Ϊboth
		 * @param	object	$db		���ݱ�����Ӷ���
		 */
		static function check($filename, $data, $action, $db){
			$file=substr($filename, strlen(TABPREFIX));
		
			$xmlfile=$db->path."models/".$file.".xml";
			if(file_exists($xmlfile)) {
				self::$data=$data;
				self::$action=$action;
				self::$db=$db;
		
				if(is_array($data) && array_key_exists("code", $data)){
					self::vcode($data["code"], "��֤������<font color='red'>".$data["code"]."</font>����");
				}

				//����XML������
				$xml_parser = xml_parser_create("utf-8");

				//ʹ�ô�Сд�۵�����֤����Ԫ���������ҵ���ЩԪ������
				xml_parser_set_option($xml_parser, XML_OPTION_CASE_FOLDING, true);
				xml_set_element_handler ($xml_parser, array(__CLASS__,"start"),array(__CLASS__, "end"));
				//��ȡXML�ļ�
				if (!($fp = fopen($xmlfile, "r"))) {
	    				die("�޷���ȡXML�ļ�$xmlfile");
				}

				//����XML�ļ�
				$has_error = false;			//��־λ
				while ($data = fread($fp, 4096)) {
					//ѭ���ض���XML�ĵ���ֻ���ĵ���EOF��ͬʱֹͣ����
					if (!xml_parse($xml_parser, $data, feof($fp)))
					{
						$has_error = true;
						break;
					}
				}

				if($has_error) { 
					//��������У��м��������Ϣ
					$error_line   = xml_get_current_line_number($xml_parser);
					$error_row   = xml_get_current_column_number($xml_parser);
					$error_string = xml_error_string(xml_get_error_code($xml_parser));

					$message = sprintf("XML�ļ� {$xmlfile}�۵�%d�У�%d�У�����%s", 
						$error_line,
						$error_row,
						$error_string);
						self::$msg[]= $message;
						self::$flag=false;
				}
				//�ر�XML������ָ�룬�ͷ���Դ
				xml_parser_free($xml_parser);
				return self::$flag;
			}else{
				return true;
			}
				
		}
		/**
		 * ʹ���Զ����������ʽ������֤
		 * @param	string	$value	��Ҫ��֤��ֵ
		 * @param	string	$msg	��֤ʧ�ܵ���ʾ��Ϣ
		 * @param	string	$rules	������ʽ
		 */ 
		static function regex($value, $msg,$rules) {
			if(!preg_match($rules, $value)) {
				self::$msg[]=$msg;
				self::$flag=false;
			}
		}
		/**
		 * Ψһ����֤
		 * @param	string	$value	��Ҫ��֤��ֵ
		 * @param	string	$msg	��֤ʧ�ܵ���ʾ��Ϣ
		 * @param	string	$name	��Ҫ��֤���ֶ�����
		 */ 
		static function unique($value,  $msg, $rules, $name) {
			if(self::$db->where("$name='$value'")->total() > 0){
				self::$msg[]=$msg;
				self::$flag=false;
			} 
		}
		/**
		 *�ǿ���֤
		 * @param	string	$value	��Ҫ��֤��ֵ
		 * @param	string	$msg	��֤ʧ�ܵ���ʾ��Ϣ
		 */ 
		static function notnull($value,  $msg) {
			if(strlen(trim($value))==0) {
				self::$msg[]=$msg;
				self::$flag=false;
			}
		}
		/**
		 *Email��ʽ��֤
		 * @param	string	$value	��Ҫ��֤��ֵ
		 * @param	string	$msg	��֤ʧ�ܵ���ʾ��Ϣ
		 */ 
		static function email($value, $msg) {
			$rules= "/\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/";

			if(!preg_match($rules, $value)) {
				self::$msg[]=$msg;
				self::$flag=false;
			}
		}
		/**
		 *URL��ʽ��֤
		 * @param	string	$value	��Ҫ��֤��ֵ
		 * @param	string	$msg	��֤ʧ�ܵ���ʾ��Ϣ
		 */ 
		static function url($value, $msg) {

			$rules='/^http\:\/\/([\w-]+\.)+[\w-]+(\/[\w-.\/?%&=]*)?$/';
			if(!preg_match($rules, $value)) {
				self::$msg[]=$msg;
				self::$flag=false;
			}

		}
		/**
		 *���ָ�ʽ��֤
		 * @param	string	$value	��Ҫ��֤��ֵ
		 * @param	string	$msg	��֤ʧ�ܵ���ʾ��Ϣ
		 */ 
		static function number($value, $msg) {
		
			$rules='/^\d+$/';
			if(!preg_match($rules, $value)) {
				self::$msg[]=$msg;
				self::$flag=false;
			}
		}
		/**
		 * ���Ҹ�ʽ��֤
		 * @param	string	$value	��Ҫ��֤��ֵ
		 * @param	string	$msg	��֤ʧ�ܵ���ʾ��Ϣ
		 */ 
		static function currency($value, $msg) {
		
			$rules='/^\d+(\.\d+)?$/';
			if(!preg_match($rules, $value)) {
				self::$msg[]=$msg;
				self::$flag=false;
			}
		}
		/**
		 *��֤���Զ���֤
		 * @param	string	$value	��Ҫ��֤��ֵ
		 * @param	string	$msg	��֤ʧ�ܵ���ʾ��Ϣ
		 */ 
		static function vcode($value, $msg){		
			if(strtoupper($value)!=$_SESSION["code"]) {
				self::$msg[]=$msg;
				self::$flag=false;
			}
		}
		/**
		 *ʹ�ûص��ú���������֤
		 * @param	string	$value	��Ҫ��֤��ֵ
		 * @param	string	$msg	��֤ʧ�ܵ���ʾ��Ϣ
		 * @param	string	$rules	�ص��������ƣ��ص��ú���д��commons�µ�functions.inc.php
		 */ 
		static function callback($value, $msg, $rules) {
			if(!$rules($value)){
				self::$msg[]=$msg;
				self::$flag=false;
			}
		}
		/**
		 *��֤��������Ƿ�һ��
		 * @param	string	$value	��Ҫ��֤��ֵ
		 * @param	string	$msg	��֤ʧ�ܵ���ʾ��Ϣ
		 * @param	string	$rules	��Ӧ����һ��������
		 */ 
		static function confirm($value, $msg, $rules) {
			if($value!=self::$data[$rules]){
				self::$msg[]=$msg;
				self::$flag=false;
			}	
		}

		/**
		 * ��֤���ݵ�ֵ�Ƿ���һ���ķ�Χ��
		 * @param	string	$value	��Ҫ��֤��ֵ
		 * @param	string	$msg	��֤ʧ�ܵ���ʾ��Ϣ
		 * @param	string	$rules	һ��ֵ����ֵ����һ����Χ
		 */
		static function in($value,$msg, $rules) {
			if(strstr($rules, ",")){
				if(!in_array($value, explode(",", $rules))){
					self::$msg[]=$msg;
					self::$flag=false;
				}	
			}else if(strstr($rules, '-')){
				list($min, $max)=explode("-", $rules);

				if(!($value>=$min && $value <=$max) ){
					self::$msg[]=$msg;
					self::$flag=false;
				}
			}else{
				if($rules!=$value){
					self::$msg[]=$msg;
					self::$flag=false;
				}
			}
		}
		/**
		 * ��֤���ݵ�ֵ�ĳ����Ƿ���һ���ķ�Χ��
		 * @param	string	$value	��Ҫ��֤��ֵ
		 * @param	string	$msg	��֤ʧ�ܵ���ʾ��Ϣ
		 * @param	string	$rules	һ����Χ������ 3-20(3-20֮��)��3,20(3-20֮��)��3(������3��)��3,(3������)
		 */
		static function length($value,$msg, $rules) {
			$fg=strstr($rules, '-') ? "-" : ",";

			if(!strstr($rules, $fg)){
				if(strlen($value) != $rules){
					self::$msg[]=$msg;
					self::$flag=false;
				}
			}else{

				list($min, $max)=explode($fg, $rules);
				
				if(empty($max)){
					if(strlen($value) < $rules){
						self::$msg[]=$msg;
						self::$flag=false;
					}
				}else if(!(strlen($value)>=$min && strlen($value) <=$max) ){
					self::$msg[]=$msg;
					self::$flag=false;
				}
			}
		
		}
		/**
		 * ��֤ʧ�ܺ�ķ�����ʾ��Ϣ
		 */ 
		static function getMsg(){
			$msg=self::$msg;
			self::$msg='';
			self::$data=null;
			self::$action='';
			self::$flag=true;
			self::$db=null;
			return $msg;
		}

	}
