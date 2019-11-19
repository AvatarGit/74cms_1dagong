<?php
/** ******************************************************************************
 * brophp.com ��Ŀ�ṹ�����࣬�����Զ���������Ҫ����ĿĿ¼���ļ��ṹ��           *
 * *******************************************************************************
 * ���������רΪ��ϸ˵PHP�����߼�LAMP�ֵ���ѧԱ�ṩ�ġ�ѧϰ�͡���������php��ܡ�*
 * *******************************************************************************
 * ��Ȩ���� (C) 2011-2013 �����׵��Ž�����ѯ���޹�˾������������Ȩ����           *
 * ��վ��ַ: http://www.lampbrother.net (LAMP�ֵ���)                             *
 * *******************************************************************************
 * $Author: ����� (skygao@lampbrother.net) $                                    *
 * $Date: 2011-07-18 10:00:00 $                                                  * 
 * ******************************************************************************/

	class Structure {
		static $mess=array();    //��ʾ��Ϣ

		/*
		 * �����ļ�
		 * @param	string	$fileName	��Ҫ�������ļ���
		 * @param	string	$str		��Ҫ���ļ���д�������ַ���
		 */
		static function touch($fileName, $str){
			if(!file_exists($fileName)){
				if(file_put_contents($fileName, $str)){
					self::$mess[]="�����ļ� {$fileName} �ɹ�.";
				}
			}
		}
		/*
		 * ����Ŀ¼
		 * @param	string	$dirs		��Ҫ������Ŀ¼����
		 */
		static function mkdir($dirs){
			foreach($dirs as $dir){
				if(!file_exists($dir)){
					if(mkdir($dir,"0755")){
						self::$mess[]="����Ŀ¼ {$dir} �ɹ�.";
					}
				}
			}
		}
		/**
		 * ����ϵͳ����ʱ���ļ�
		 */
		static function runtime(){
			$dirs=array(
					PROJECT_PATH."runtime/cache/",   //ϵͳ�Ļ���Ŀ¼
					PROJECT_PATH."runtime/cache/".TPLSTYLE,   //ϵͳ�Ļ���Ŀ¼
					PROJECT_PATH."runtime/comps/",   //ģ�������ļ�
					PROJECT_PATH."runtime/comps/".TPLSTYLE,   //ģ�������ļ�
					PROJECT_PATH."runtime/comps/".TPLSTYLE."/".TMPPATH,   //ģ�������ļ�
					PROJECT_PATH."runtime/data/",    //���ݱ�Ľṹ�ļ�
					PROJECT_PATH."runtime/controls/",
					PROJECT_PATH."runtime/controls/".TMPPATH,
					PROJECT_PATH."runtime/models/",
					PROJECT_PATH."runtime/models/".TMPPATH
				);
			self::mkdir($dirs);   //����Ŀ¼	
		}
		/**
		 *������Ŀ��Ŀ¼�ṹ
		 */
		static function create(){
			self::mkdir(array(PROJECT_PATH."runtime/"));
			//�ļ�����һ�����ɣ��Ͳ��ٴ���
			$structFile=PROJECT_PATH."runtime/".str_replace("/","_",$_SERVER["SCRIPT_NAME"]);  //������ļ���

			if(!file_exists($structFile)) {	
				$fileName=PROJECT_PATH."config.inc.php";
				$str=<<<st
<?php
	define("DEBUG", 1);				      //��������ģʽ 1 ���� 0 �ر�
	define("DRIVER","pdo");				      //���ݿ����������ϵͳ֧��pdo(Ĭ��)��mysqli����
	//define("DSN", "mysql:host=localhost;dbname=brophp"); //���ʹ��PDO����ʹ�ã���ʹ����Ĭ������MySQL
	define("HOST", "localhost");			      //���ݿ�����
	define("USER", "root");                               //���ݿ��û���
	define("PASS", "");                                   //���ݿ�����
	define("DBNAME","brophp");			      //���ݿ���
	define("TABPREFIX", "bro_");                           //���ݱ�ǰ׺
	define("CSTART", 0);                                  //���濪�� 1������0Ϊ�ر�
	define("CTIME", 60*60*24*7);                          //����ʱ��
	define("TPLPREFIX", "tpl");                           //ģ���ļ��ĺ�׺��
	define("TPLSTYLE", "default");                        //Ĭ��ģ���ŵ�Ŀ¼

	//\$memServers = array("localhost", 11211);	     //ʹ��memcache������
	/*
	����ж�̨memcache����������ʹ�ö�ά����
	\$memServers = array(
			array("www.lampbrother.net", '11211'),
			array("www.brophp.com", '11211'),
			...
		);
	*/
st;
				self::touch($fileName, $str);
				if(!defined("DEBUG"))
					include $fileName;
				$dirs=array(
					PROJECT_PATH."classes/",    //��Ŀ��ͨ����
					PROJECT_PATH."commons/",    //��Ŀ��ͨ�ú��� functions.inc.php
					PROJECT_PATH."public",      //ϵͳ����Ŀ¼
					PROJECT_PATH."public/uploads/",  //ϵͳ�����ϴ��ļ�Ŀ¼
					PROJECT_PATH."public/css/",      //ϵͳ��css��Ŀ¼
					PROJECT_PATH."public/js/",       //ϵͳ����javascriptĿ¼
					PROJECT_PATH."public/images/",   //ϵͳ����ͼƬĿ¼
					APP_PATH,                   //��ǰ��Ӧ��Ŀ¼
					APP_PATH."models/",         //��ǰӦ�õ�ģ��Ŀ¼
					APP_PATH."controls/",       //��ǰӦ�õĿ�����Ŀ¼
					APP_PATH."views/",          //��ǰӦ�õ���ͼĿ¼
					APP_PATH."views/".TPLSTYLE, //��ǰӦ�õ�ģ��Ŀ¼
					APP_PATH."views/".TPLSTYLE."/public/",           //����ģ��Ŀ¼
					APP_PATH."views/".TPLSTYLE."/resource/",        //��ǰӦ��ģ�幫����ԴĿ¼
					APP_PATH."views/".TPLSTYLE."/resource/css/",     //��ǰӦ��ģ��CSSĿ¼
					APP_PATH."views/".TPLSTYLE."/resource/js/",      //��ǰӦ��ģ��jsĿ¼
					APP_PATH."views/".TPLSTYLE."/resource/images/"  //��ǰӦ��ģ��ͼ��Ŀ¼
				);
			
				self::mkdir($dirs);
				self::touch(PROJECT_PATH."commons/functions.inc.php", "<?php\n\t//ȫ�ֿ���ʹ�õ�ͨ�ú�������������ļ���.");
				//����ͳһ�� ��Ϣ ģ��
				$success=APP_PATH."views/".TPLSTYLE."/public/success.".TPLPREFIX;
				if(!file_exists($success))
					copy(BROPHP_PATH."commons/success",$success);
			
				$str=<<<st
<?php
	class Common extends Action {
		function init(){

		}		
	}
st;

				self::touch(APP_PATH."controls/common.class.php", $str);
	
				$str=<<<st
<?php
	class Index {
		function index(){
			echo "<b>��ӭʹ�á�ϸ˵PHP���е�BroPHP���1.0, ��һ�η���ʱ���Զ�������Ŀ�ṹ��</b><br>";
			echo '<pre>';
			echo file_get_contents('{$structFile}');
			echo '</pre>';
		}		
	}
st;

				self::touch(APP_PATH."controls/index.class.php", $str);

				self::touch($structFile, implode("\n", self::$mess));
				
			}	
			self::runtime();
		}
		/**
		 * ���������������
		 * @param	string	$srccontrolerpath	ԭ�����������·��
		 * @param	string	$controlerpath		Ŀ������������·��
		 */ 
		static function commoncontroler($srccontrolerpath,$controlerpath){
			$srccommon=$srccontrolerpath."common.class.php";
			$common=$controlerpath."common.class.php";
			//����¿����������ڣ� ��ԭ���������޸ľ���������
			if(!file_exists($common) || filemtime($srccommon) > filemtime($common)){
				copy($srccommon, $common); 	
			}	
		}

		static function controler($srccontrolerfile,$controlerpath,$m){
			$controlerfile=$controlerpath.strtolower($m)."action.class.php";
			//����¿����������ڣ� ��ԭ���������޸ľ���������
			if(!file_exists($controlerfile) || filemtime($srccontrolerfile) > filemtime($controlerfile)){
				//�����������е����ݶ�����
				$classContent=file_get_contents($srccontrolerfile);	
				//��������û�м̳и���
				$super='/extends\s+(.+?)\s*{/i'; 
				//����Ѿ��и���
				if(preg_match($super,$classContent, $arr)) {
					$classContent=preg_replace('/class\s+(.+?)\s+extends\s+(.+?)\s*{/i','class \1Action extends \2 {',$classContent);
					//�����ɿ�������
					file_put_contents($controlerfile, $classContent);
				//û�и���ʱ
				}else{ 
					//�̳и���Common
					$classContent=preg_replace('/class\s+(.+?)\s*{/i','class \1Action extends Common {',$classContent);
					//���ɿ�������
					file_put_contents($controlerfile,$classContent);	
				}
			}
	
	
		}

		static function model($className, $app){
			$driver="D".DRIVER; //������
			$path=PROJECT_PATH."runtime/models/".TMPPATH;
			if($app==""){
				$src=APP_PATH."models/".strtolower($className).".class.php";
				$psrc=APP_PATH."models/___.class.php";
				$className=ucfirst($className).'Model';
				$parentClass='___model';
				$to=$path.strtolower($className).".class.php";
				$pto=$path.$parentClass.".class.php";
				
			}else{
				$src=PROJECT_PATH.$app."/models/".strtolower($className).".class.php";
				$psrc=PROJECT_PATH.$app."/models/___.class.php";
				$className=ucfirst($app).ucfirst($className).'Model';
				$parentClass=ucfirst($app).'___model';
				$to=$path.strtolower($className).".class.php";
				$pto=$path.$parentClass.".class.php";
			}

			
			//�����ԭmodel����
			if(file_exists($src)) {	
				$classContent=file_get_contents($src);											     $super='/extends\s+(.+?)\s*{/i'; 
				//����Ѿ��и���
				if(preg_match($super,$classContent, $arr)) {
					$psrc=str_replace("___", strtolower($arr[1]), $psrc);
					$pto=str_replace("___", strtolower($arr[1]), $pto);
					
					if(file_exists($psrc)){
						if(!file_exists($pto) || filemtime($psrc) > filemtime($pto)){
							$pclassContent=file_get_contents($psrc);
							$pclassContent=preg_replace('/class\s+(.+?)\s*{/i','class '.$arr[1].'Model extends '.$driver.' {',$pclassContent);
				
							file_put_contents($pto, $pclassContent);
				
						}
				
					}else{
						Debug::addmsg("<font color='red'>�ļ�{$psrc}������!</font>");
					} 
					$driver=$arr[1]."Model";
					include_once $pto;
				}
				if(!file_exists($to) || filemtime($src) > filemtime($to) ) {	
					$classContent=preg_replace('/class\s+(.+?)\s*{/i','class '.$className.' extends '.$driver.' {',$classContent);
					//����model
					file_put_contents($to,$classContent);
				}	
			}else{
				if(!file_exists($to)){
					$classContent="<?php\n\tclass {$className} extends {$driver}{\n\t}";
					//����model
					file_put_contents($to,$classContent);	
				}	
			}

			include_once $to;
			return $className;
		}

	}
