<?php
/** ******************************************************************************
 * brophp.com ���ݿ�����PDO�����࣬ͨ������ʹ��PHP��pdo��չ���Ӵ������ݿ⡣    *
 * *******************************************************************************
 * ���������רΪ��ϸ˵PHP�����߼�LAMP�ֵ���ѧԱ�ṩ�ġ�ѧϰ�͡���������php��ܡ�*
 * *******************************************************************************
 * ��Ȩ���� (C) 2011-2013 �����׵��Ž�����ѯ���޹�˾������������Ȩ����           *
 * ��վ��ַ: http://www.lampbrother.net (LAMP�ֵ���)                             *
 * *******************************************************************************
 * $Author: ����� (skygao@lampbrother.net) $                                    *
 * $Date: 2011-07-18 10:00:00 $                                                  * 
 * ******************************************************************************/
	class Dpdo extends DB{
		static $pdo=null;
		/**
		 *��ȡ���ݿ����Ӷ���PDO
		 */
		static function connect(){
			if(is_null(self::$pdo)) {
				try{
					if(defined("DSN"))
						$dsn=DSN;
					else
						$dsn="mysql:host=".HOST.";dbname=".DBNAME;

					$pdo=new PDO($dsn, USER, PASS, array(PDO::ATTR_PERSISTENT=>true));
					$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$pdo->query("set names gbk");
					self::$pdo=$pdo;
					return $pdo;
				}catch(PDOException $e){
					echo "��������ʧ�ܣ�".$e->getMessage();
				}
			}else{
				return self::$pdo;
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
			 $this->setNull(); //��ʹ��sql
			
			 $value=$this->escape_string_array($data);
			 $marr=explode("::", $method);
			 $method=strtolower(array_pop($marr));
			 if(strtolower($method)==trim("total")){
			 	$sql=preg_replace('/select.*?from/i','SELECT count(*) as count FROM',$sql);
			 }
			 $addcache=false;
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
	 	
		
			 try{
				$return=null;
	 			$pdo=self::connect();
		 		$stmt=$pdo->prepare($sql);  //׼����һ�����
		        	$result=$stmt->execute($value);   //ִ��һ��׼���õ����
			
				//���ʹ��mem�����Ҳ��ǲ������
				if(isset($mem) && !$addcache){
					if($stmt->rowCount()>0){
						$mem->delCache($this->tabName);	 //�������
						Debug::addmsg("�����<b>{$this->tabName}</b>��Memcache�����л���!"); //debug
					}
				}
			         
				 switch($method){
					 case "select":  //����������������
						 $data=$stmt->fetchAll(PDO::FETCH_ASSOC);

						 if($addcache){
						 	$mem->addCache($this->tabName, $memkey, $data);
						 }
						 $return=$data;
						break;
					case "find":    //ֻҪһ����¼��
						$data=$stmt->fetch(PDO::FETCH_ASSOC);

						 if($addcache){
						 	$mem->addCache($this->tabName, $memkey, $data);
						 }
						 $return=$data;
						break;

					case "total":  //�����ܼ�¼��
						$row=$stmt->fetch(PDO::FETCH_NUM);

						 if($addcache){
						 	$mem->addCache($this->tabName, $memkey, $row[0]);
						 }
					
						$return=$row[0];
						break;
					case "insert":  //�������� �����������ID
						if($this->auto=="yes")
							$return=$pdo->lastInsertId();
						else
							$return=$result;
						break;
					case "delete":
					case "update":        //update 
						$return=$stmt->rowCount();
						break;
					default:
						$return=$result;
				 }
				$stopTime= microtime(true);
				$ys=round(($stopTime - $startTime) , 4);
				Debug::addmsg('[��ʱ<font color="red">'.$ys.'</font>��] - '.$memkey,2); //debug
				/*-----------��־--------------*/
				Debug::addm($memkey); 			//��־������
				/*-----------��־--------------*/
				return $return;
			}catch(PDOException $e){
				Debug::addmsg("<font color='red'>SQL error: ".$e->getMessage().'</font>');
				Debug::addmsg("��鿴��<font color='#005500'>".$memkey.'</font>'); //debug
			}	
		}

		/**
		 * �Զ���ȡ��ṹ
		 */ 
		function setTable($tabName){
			$cachefile=PROJECT_PATH."runtime/data/".$tabName.".php";
			$this->tabName=TABPREFIX.$tabName; //��ǰ׺�ı���
				
			if(!file_exists($cachefile)){
				try{
					$pdo=self::connect();
					$stmt=$pdo->prepare("desc {$this->tabName}");
					$stmt->execute();
					$auto="yno";
					$fields=array();
					while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
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
				}catch(PDOException $e){
					Debug::addmsg("<font color='red'>�쳣��".$e->getMessage().'</font>');
				}
			}else{
				$json=ltrim(file_get_contents($cachefile),"<?ph ");
				$this->auto=substr($json,-3);
				$json=substr($json, 0, -3);
				$this->fieldList=(array)json_decode($json, true);	
			}
			Debug::addmsg("��<b>{$this->tabName}</b>�ṹ��".implode(",", $this->fieldList),2); //debug
		}
    		/**
		* ����ʼ
    		*/
		public function beginTransaction() {
			$pdo=self::connect();
			$pdo->setAttribute(PDO::ATTR_AUTOCOMMIT, 0); 
			$pdo->beginTransaction();
		}
		
		/**
     		* �����ύ
     		*/
		public function commit() {
			$pdo=self::connect();
			$pdo->commit();
			$pdo->setAttribute(PDO::ATTR_AUTOCOMMIT, 1); 
		}
		
		/**
     		* ����ع�
     		*/
		public function rollBack() {
			$pdo=self::connect();
			$pdo->rollBack();
			$pdo->setAttribute(PDO::ATTR_AUTOCOMMIT, 1); 
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
			$pdo=self::connect();
			$stmt=$pdo->prepare($sql);  //׼����һ�����
		        $stmt->execute();   //ִ��һ��׼���õ����
			$size = 0;
			while($row=$stmt->fetch(PDO::FETCH_ASSOC))
				$size += $row["Data_length"] + $row["Index_length"];
			return tosize($size);
		}
		/*
		 * ���ݿ�İ汾
		 * @return	string		�������ݿ�ϵͳ�İ汾
		 */
		function dbVersion() {
			$pdo=self::connect();
			return $pdo->getAttribute(PDO::ATTR_SERVER_VERSION);
		}
	}
