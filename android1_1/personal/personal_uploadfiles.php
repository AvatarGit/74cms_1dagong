<?php 
define('IN_QISHI', true);
require_once(dirname(__FILE__).'/../include/common.inc.php');
require_once(QISHI_ROOT_PATH.'include/mysql.class.php');
$db = new mysql($dbhost,$dbuser,$dbpass,$dbname);
unset($dbhost,$dbuser,$dbpass,$dbname);
$aset=$_REQ;
$aset=array_map('addslashes',$aset);
require_once(ANDROID_ROOT_PATH.'include/common.user.inc.php');
$title = $aset['title'];
if ($_SESSION['utype']<>'2')
{
	$result['result']=0;
	$result['list']=null;
	$result['errormsg']=android_iconv_utf8("���¼���˻�Ա���ģ�");
	$jsonencode = json_encode($result);
	$jsonencode = urldecode(json_encode($result));
	exit($jsonencode);
}
else
{

		
		$filename = $_FILES['uploadedfile']['name'];
		$date = date('YmdHis',time());
		$date1 = date('Y-m-d');
		$date_arr = explode('-',$date1);
		$name=explode('.',$filename);//���ļ�����'.'�ָ�õ���׺��,�õ�һ������
		
		$url = "data/photo/".$date_arr[0]."/".$date_arr[1]."/".$date_arr[2]."/";
		$target_path  = QISHI_ROOT_PATH.$url;//�����ļ�Ŀ¼  
		create_folders($target_path);
		$target_path = $target_path . $date .".". $name[1];  
		
		
		
		
		if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {  
			$url_thumb = "data/photo/thumb/".$date_arr[0]."/".$date_arr[1]."/".$date_arr[2]."/";
			$target_thumb_path  = QISHI_ROOT_PATH.$url_thumb;//���������ļ�Ŀ¼  
			create_folders($target_thumb_path);
			$target_thumb_path = $target_thumb_path . $date .".". $name[1];  
			$picpath=$target_thumb_path;##ͼƬ·��
			copy($target_path, $picpath);
			$sql = "UPDATE ".table('resume')." SET photo_img = '".$date_arr[0]."/".$date_arr[1]."/".$date_arr[2]."/".$date .".". $name[1]."' WHERE id=".intval($aset['pid']);
			$sql1 = "UPDATE ".table('resume_tmp')." SET photo_img = '".$date_arr[0]."/".$date_arr[1]."/".$date_arr[2]."/".$date .".". $name[1]."' WHERE id=".intval($aset['pid']);
			$db->query($sql);
			$db->query($sql1);
			//resize($target_path,$target_thumb_path);
		    $result['result']="1";
			$result['list']=array('pic_url'=>$url."/".$date .".". $name[1],'thumb_url'=>$date_arr[0]."/".$date_arr[1]."/".$date_arr[2]."/".$date .".". $name[1]);
			$result['errormsg']=android_iconv_utf8('ͼƬ�ϴ��ɹ���');
			$jsonencode = urldecode(json_encode($result));
			exit($jsonencode);
		    
		}  else{  
		    $result['result']="0";
			$result['list']=null;
			$result['errormsg']=android_iconv_utf8('ͼƬ�ϴ�ʧ�ܣ�');
			$jsonencode = urldecode(json_encode($result));
			exit($jsonencode);
		}  
}
?>