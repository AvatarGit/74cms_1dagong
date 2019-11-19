<?php
/** ******************************************************************************
 * brophp.com �ļ����ϴ��࣬�����ϴ�һ����ͬʱ�ϴ�����ļ���                     *
 * *******************************************************************************
 * ���������רΪ��ϸ˵PHP�����߼�LAMP�ֵ���ѧԱ�ṩ�ġ�ѧϰ�͡���������php��ܡ�*
 * *******************************************************************************
 * ��Ȩ���� (C) 2011-2013 �����׵��Ž�����ѯ���޹�˾������������Ȩ����           *
 * ��վ��ַ: http://www.lampbrother.net (LAMP�ֵ���)                             *
 * *******************************************************************************
 * $Author: ����� (skygao@lampbrother.net) $                                    *
 * $Date: 2011-07-18 10:00:00 $                                                  * 
 * ******************************************************************************/

	class FileUpload extends Image{	
		private $allowtype = array('jpg','gif','png'); //�����ϴ��ļ�������,����ʹ��set()���ã�ʹ��С��ĸ
		private $maxsize = 1000000;  //�����ļ��ϴ���С����λ���ֽ�,����ʹ��set()����
		private $israndname = true;   //�����Ƿ���������� falseΪ�����,����ʹ��set()����
		private $thumb=array();      //��������ͼƬ,����ʹ��set()����
		private $watermark=array();  //����ΪͼƬ��ˮӡ,����ʹ��set()����
		private $originName;   	     //Դ�ļ���
		private $tmpFileName;        //��ʱ�ļ���
		private $fileType; 	     //�ļ�����(�ļ���׺)
		private $fileSize;            //�ļ���С
		private $newFileName; 	      //���ļ���
		private $errorNum = 0;        //�����
		private $errorMess="";       //���󱨸���Ϣ
		
		/**
		 * �������ó�Ա���ԣ�$path, $allowtype,$maxsize, $israndname, $thumb,$watermark��
		 * ����ͨ���������һ�����ö������ֵ
		 *@param	string	$key	��Ա������(�����ִ�Сд)
		 *@param	mixed	$val	Ϊ��Ա�������õ�ֵ
		 *@return	object		�����Լ�����$this
		 */
		function set($key, $val){
			$key=strtolower($key); 
			if(array_key_exists($key,get_class_vars(get_class($this)))){
				$this->setOption($key, $val);
			}

			return $this;
		}

		/**
		 * ���ø÷����ϴ��ļ�
		 * @param	string	$fileFile	�ϴ��ļ��ı����� ���磺<input type="file" name="myfile"> ������Ϊmyfile
		 * @return	bool			 ����ϴ��ɹ�������true 
		 */
		
		function upload($fileField) {
			$return=true;
			if(!$this->checkFilePath()) {//����ļ�·��
				$this->errorMess=$this->getError();
				return false;
			}
			$name=$_FILES[$fileField]['name'];
			$tmp_name=$_FILES[$fileField]['tmp_name'];
			$size=$_FILES[$fileField]['size'];
			$error=$_FILES[$fileField]['error'];

		
		
			if(is_Array($name)){  //����Ƕ���ļ��ϴ���$file["name"]����һ������
				$errors=array();
				for($i = 0; $i < count($name); $i++){ 
					if($this->setFiles($name[$i],$tmp_name[$i],$size[$i],$error[$i] )) {//�����ļ���Ϣ
						if(!$this->checkFileSize() || !$this->checkFileType()){
							$errors[]=$this->getError();
							$return=false;	
						}
					}else{
						$errors[]=$this->getError();
						$return=false;
					}

					if(!$return)  // ��������⣬�����³�ʹ������
						$this->setFiles();
				}
			
				if($return){
					$fileNames=array();   //��������ϴ����ļ����ı�������
		
					for($i = 0; $i < count($name);  $i++){ 
						if($this->setFiles($name[$i],$tmp_name[$i],$size[$i],$error[$i] )) {//�����ļ���Ϣ
							$this->setNewFileName(); //�������ļ���
							if(!$this->copyFile()){
								$errors[]=$this->getError();
								$return=false;
							}
							$fileNames[]=$this->newFileName;
							//��������
							if(!empty($this->thumb)){
								if(empty($this->thumb["prefix"]))
									$this->thumb["prefix"]="";
							
								$this->newFileName=$this->thumb($this->newFileName, $this->thumb["width"], $this->thumb["height"], $this->thumb["prefix"]);						
							}
							//����ˮӡ
							if(!empty($this->watermark)){
								if(empty($this->watermark["prefix"]))
									$this->watermark["prefix"]="";
								$this->newFileName=$this->watermark($this->newFileName, $this->watermark["water"], $this->watermark["position"],$this->watermark["prefix"]);
							}
						}
											
					}
					$this->newFileName=$fileNames;
					
				}
				$this->errorMess=$errors;
				return $return;
				
			} else {
				if($this->setFiles($name,$tmp_name,$size,$error)) {//�����ļ���Ϣ
					if($this->checkFileSize() && $this->checkFileType()){	
						$this->setNewFileName(); //�������ļ���
						if($this->copyFile()){ //�ϴ��ļ�   ����0Ϊ�ɹ��� С��0��Ϊ����
							if(!empty($this->thumb)){
								if(empty($this->thumb["prefix"]))
									$this->thumb["prefix"]="";
								$this->newFileName=$this->thumb($this->newFileName, $this->thumb["width"], $this->thumb["height"], $this->thumb["prefix"]);						
							}
							if(!empty($this->watermark)){
								if(empty($this->watermark["prefix"]))
									$this->watermark["prefix"]="";
								$this->newFileName=$this->watermark($this->newFileName, $this->watermark["water"], $this->watermark["position"],$this->watermark["prefix"]);
							}

							return true;
						}else{
							$return=false;
						}
					}else{
						$return=false;
					}
				} else {
					$return=false;	
				}

				if(!$return)
					$this->errorMess=$this->getError();

				return $return;
			}
		
		}

		/** 
		 * ��ȡ�ϴ�����ļ�����
		 * @param	void	 û�в���
		 * @return	string 	�ϴ������ļ�������
		 */
		public function getFileName(){
			return $this->newFileName;
		}

		/**
		 * �ϴ�ʧ�ܺ󣬵��ø÷����򷵻أ��ϴ�������Ϣ
		 * @param	void	 û�в���
		 * @return	string 	 �����ϴ��ļ��������Ϣ��ʾ
		 */
		public function getErrorMsg(){
			return $this->errorMess;
		}
		
		//�����ϴ�������Ϣ
		private function getError() {
			$str = "�ϴ��ļ�<font color='red'>{$this->originName}</font>ʱ���� : ";
			switch ($this->errorNum) {
				case 4: $str .= "û���ļ����ϴ�"; break;
				case 3: $str .= "�ļ�ֻ�в��ֱ��ϴ�"; break;
				case 2: $str .= "�ϴ��ļ��Ĵ�С������ HTML ���� MAX_FILE_SIZE ѡ��ָ����ֵ"; break;
				case 1: $str .= "�ϴ����ļ������� php.ini �� upload_max_filesize ѡ�����Ƶ�ֵ"; break;
				case -1: $str .= "δ��������"; break;
				case -2: $str .= "�ļ�����,�ϴ����ļ����ܳ���{$this->maxsize}���ֽ�"; break;
				case -3: $str .= "�ϴ�ʧ��"; break;
				case -4: $str .= "��������ϴ��ļ�Ŀ¼ʧ�ܣ�������ָ���ϴ�Ŀ¼"; break;
				case -5: $str .= "����ָ���ϴ��ļ���·��"; break;
				default: $str .= "δ֪����";
			}
			return $str.'<br>';
		}

		
		//���ú�$_FILES�йص�����
		private function setFiles($name="", $tmp_name="", $size=0, $error=0) {
			$this->setOption('errorNum', $error);
			if($error)
				return false;
			$this->setOption('originName', $name);
			$this->setOption('tmpFileName',$tmp_name);
			$aryStr = explode(".", $name);
			$this->setOption('fileType', strtolower($aryStr[count($aryStr)-1]));
			$this->setOption('fileSize', $size);
			return true;
		}
    
		//Ϊ������Ա��������ֵ
		private function setOption($key, $val) {
			$this->$key = $val;
		}

		//�����ϴ�����ļ�����
		private function setNewFileName() {
			if ($this->israndname) {
				$this->setOption('newFileName', $this->proRandName());	
			} else{ 
				$this->setOption('newFileName', $this->originName);
			} 
		}
 		
		//����ϴ����ļ��Ƿ��ǺϷ�������
		private function checkFileType() {
			if (in_array(strtolower($this->fileType), $this->allowtype)) {
				return true;
			}else {
				$this->setOption('errorNum', -1);
				return false;
			}
		}
    		//����ϴ����ļ��Ƿ�������Ĵ�С
		private function checkFileSize() {
			if ($this->fileSize > $this->maxsize) {
				$this->setOption('errorNum', -2);
				return false;
			}else{
				return true;
			}
		}

		//����Ƿ��д���ϴ��ļ���Ŀ¼
		private function checkFilePath() {
			if(empty($this->path)){
				$this->setOption('errorNum', -5);
				return false;
			}
			if (!file_exists($this->path) || !is_writable($this->path)) {
				if (!@mkdir($this->path, 0755)) {
					$this->setOption('errorNum', -4);
					return false;
				}
			}

			return true;
		}
		//��������ļ���
		private function proRandName() {		
			$fileName=date('YmdHis')."_".rand(100,999);   //��ȡ����ļ���	
			return $fileName.'.'.$this->fileType;    //�����ļ�����ԭ��չ��
		}
		

		//�����ϴ��ļ���ָ����λ��
		private function copyFile() {
			if(!$this->errorNum) {
				$path = rtrim($this->path, '/').'/';
				$path .= $this->newFileName;
				if (@move_uploaded_file($this->tmpFileName, $path)) {
					return true;
				}else{
					$this->setOption('errorNum', -3);
					return false;
				}
			} else {
				return false;
			}
		
		}
		
	}
