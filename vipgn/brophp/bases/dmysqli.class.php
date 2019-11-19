<?php
/** ******************************************************************************
 * brophp.com ���ݿ�mysqli�����࣬ͨ������ʹ��PHP��mysqli��չ���Ӵ������ݿ⡣    *
 * *******************************************************************************
 * ���������רΪ��ϸ˵PHP�����߼�LAMP�ֵ���ѧԱ�ṩ�ġ�ѧϰ�͡���������php��ܡ�*
 * *******************************************************************************
 * ��Ȩ���� (C) 2011-2013 �����׵��Ž�����ѯ���޹�˾������������Ȩ����           *
 * ��վ��ַ: http://www.lampbrother.net (LAMP�ֵ���)                             *
 * *******************************************************************************
 * $Author: ����� (skygao@lampbrother.net) $                                    *
 * $Date: 2011-07-18 10:00:00 $                                                  * 
 * ******************************************************************************/
	class Dmysqli extends DB{
		static $mysqli=null;
		/**
		 * ���ڻ�ȡ���ݿ�����mysqli����,����Ѿ�����mysqli����Ͳ��ڵ���connect()ȥ����
		 */
		static function connect(){
			if(is_null(self::$mysqli)) {
				$mysqli=new mysqli(HOST, USER, PASS, DBNAME);
				if (mysqli_connect_errno()) {
					Debug::addmsg("<font color='red'>����ʧ��: ".mysqli_connect_error().",��鿴config.inc.php�ļ������Ƿ�����</font>");
					return false;
				}else{
					self::$mysqli=$mysqli;
					return $mysqli;
				}
			}else{
				return self::$mysqli;
			}
		}
		/**
		 * ִ��SQL���ķ���
		 * @param	string	$sql		�û���ѯ��SQL���
		 * @param	string	$method		SQL�������ͣ�select,find,total,insert,update,other��
		 * @param	array	$data		Ϊprepare�����е�?������ֵ
		 * @return	mixed			���ݲ�ͬ��SQL��䷵��ֵ
		 */
		function query($sql, $method,$data=array()){
			$startTime = microtime(true); 
			$this->setNull();  //��ʹ��SQL

			$value=$this->escape_string_array($data);
			 $marr=explode("::", $method);
		 	 $method=strtolower(array_pop($marr));
			 if(strtolower($method)==trim("total")){
			 	$sql=preg_replace('/select.*?from/i','SELECT count(*) as count FROM',$sql);
			 }
			 $addcache=false;   //�����ж��Ƿ���mem�м�����
 			 $memkey=$this->sql($sql, $value);
			 if(defined("USEMEM")){
				 global $mem;	
				 if($method == "select" || $method == "find" || $method=="total"){
					$data=$mem->getCache($memkey);
					if($data){
						return $data;  //ֱ�Ӵ�memserver��ȡ����������ִ��
					}else{
						
						$addcache=true;	
					}
				 }

			 }

		

			 $mysqli=self::connect();
			 if($mysqli)
				 $stmt=$mysqli->prepare($sql);  //׼����һ�����
			 else
				 return;
			 //�󶨲���
			 if(count($value) > 0) {
			 	$s = str_repeat('s', count($value));
			 	array_unshift($value, $s);
				call_user_func_array(array($stmt, 'bind_param'), $value);
			 }
			 if($stmt){
			 	$result=$stmt->execute();   //ִ��һ��׼���õ����
			  }
			
			 //���SQL�����������ֱ�ӷ����˳�
			 if(!$result){
				 Debug::addmsg("<font color='red'>SQL ERROR: [{$mysqli->errno}] {$stmt->error}</font>");
				 Debug::addmsg("��鿴��<font color='#005500'>".$memkey.'</font>'); //debug
				 return;
			 }

		

			//���ʹ��mem�����Ҳ��ǲ������
			if(isset($mem) && !$addcache){
				if($stmt->affected_rows > 0){ //��Ӱ������
					$mem->delCache($this->tabName);	 //�������
					Debug::addmsg("�����<b>{$this->tabName}</b>��Memcache�����л���!"); //debug
				}
			}

			

			$returnv=null;
			switch($method){
				case "select":  //����������������
					$stmt->store_result(); 
					$data = $this->getAll($stmt);

					if($addcache){
					 	$mem->addCache($this->tabName, $memkey, $data);
					 }
					 $returnv=$data;
					break;
				 case "find":    //ֻҪһ����¼��
					$stmt->store_result(); 
					if($stmt->num_rows > 0) {
						$data = $this->getOne($stmt);

						if($addcache){
					 		$mem->addCache($this->tabName, $memkey, $data);
						}
						$returnv=$data;
					}else{
						$returnv=false;
					}
					break;

				case "total":  //�����ܼ�¼��
					$stmt->store_result(); 
					$row=$this->getOne($stmt);

					if($addcache){
					 	$mem->addCache($this->tabName, $memkey, $row["count"]);
					 }
					$returnv=$row["count"];
					break;
				case "insert":  //�������� �����������ID
					if($this->auto=="yes")
						$returnv=$mysqli->insert_id;
					else
						$returnv=$result;
					break;
				case "delete":
				case "update":        //update 
					$returnv=$stmt->affected_rows;
				default:
					$returnv=$result;
			}
			$stopTime= microtime(true);
			$ys=round(($stopTime - $startTime) , 4);
			Debug::addmsg('[��ʱ<font color="red">'.$ys.'</font>��] - '.$memkey,2); //debug
			return $returnv;
		}
		/**
		 * ��ȡ�����м�¼
		 */
		private function getAll($stmt) {
			$result = array();
			$field = $stmt->result_metadata()->fetch_fields();
			$out = array();
			//��ȡ���н�����е��ֶ���
			$fields = array();
			foreach ($field as $val) {
				$fields[] = &$out[$val->name];
			}
			//�������ֶ����󶨵�bind_result����
			call_user_func_array(array($stmt,'bind_result'), $fields);
		       	while ($stmt->fetch()) {
				$t = array();  //һ����¼��������
				foreach ($out as $key => $val) {
					$t[$key] = $val;
				}
				$result[] = $t;
			}
			return $result;  //��ά����
		}

		/**
		 * ��ȡһ����¼
		 */
		private function getOne($stmt) {
			$result = array();
			$field = $stmt->result_metadata()->fetch_fields();
			$out = array();
			//��ȡ���н�����е��ֶ���
			$fields = array();
			foreach ($field as $val) {
				$fields[] = &$out[$val->name];
			}
			//�������ֶ����󶨵�bind_result����
			call_user_func_array(array($stmt,'bind_result'), $fields);
		        $stmt->fetch();
			
			foreach ($out as $key => $val) {
				$result[$key] = $val;
			}
			return $result;  //һά��������
	       	}

		/**
		 * �Զ���ȡ��ṹ
		 * @param	string	$tabName	����
		 */
		function setTable($tabName){
			$cachefile=PROJECT_PATH."runtime/data/".$tabName.".php";
			$this->tabName=TABPREFIX.$tabName; //��ǰ׺�ı���
		
			if(file_exists($cachefile)){
				$json=ltrim(file_get_contents($cachefile),"<?ph ");
				$this->auto=substr($json,-3);
				$json=substr($json, 0, -3);
				$this->fieldList=(array)json_decode($json, true);	
			
			}else{
				$mysqli=self::connect();
				if($mysqli)
					$result=$mysqli->query("desc {$this->tabName}");
				else
					return;
			
				$fields=array();
				$auto="yno";
				while($row=$result->fetch_assoc()){
					if($row["Key"]=="PRI"){
						$fields["pri"]=strtolower($row["Field"]);
					}else{
						$fields[]=strtolower($row["Field"]);
					}
					if($row["Extra"]=="auto_increment")
						$auto="yes";
				}
				//�������û���������򽫵�һ�е�������
				if(!array_key_exists("pri", $fields)){
					$fields["pri"]=array_shift($fields);		
				}
				if(!DEBUG)
					file_put_contents($cachefile, "<?php ".json_encode($fields).$auto);
				$this->fieldList=$fields;
				$this->auto=$auto;
				
			}
			Debug::addmsg("��<b>{$this->tabName}</b>�ṹ��".implode(",", $this->fieldList),2); //debug
		}
    		/**
		* ����ʼ
    		*/
		public function beginTransaction() {
			self::connect()->autocommit(false);
			
		}
		
		/**
     		* �����ύ
     		*/
		public function commit() {
			$mysqli=self::connect();
 			$mysqli->commit();
        		$mysqli->autocommit(true);

		}
		
		/**
     		* ����ع�
     		*/
		public function rollBack() {
			$mysqli=self::connect();
  			$mysqli->rollback();
        		$mysqli->autocommit(true);

		}
		/*
		 * ��ȡ���ݿ�ʹ�ô�С
		 * @return	string		����ת����λ�ĳߴ�
		 */
		public function dbSize() {
			$sql = "SHOW TABLE STATUS FROM " . DBNAME;
			if(defined("TABPREFIX")) {
				$sql .= " LIKE '".TABPREFIX."%'";
			}
			$mysqli=self::connect();
			$result=$mysqli->query($sql);
			$size = 0;
			while($row=$result->fetch_assoc())
				$size += $row["Data_length"] + $row["Index_length"];
			return tosize($size);
		}
		/*
		 * ���ݿ�İ汾
		 * @return	string		�������ݿ�ϵͳ�İ汾
		 */
		function dbVersion() {
			$mysqli=self::connect();
			return $mysqli->server_info;
		}
	}

