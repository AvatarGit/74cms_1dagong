<?php
define('IN_QISHI', true);
require_once(dirname(__FILE__).'/../../include/common.inc.php');
$act = isset($_REQUEST['act']) ? trim($_REQUEST['act']) : 'update';
require_once(dirname(__FILE__).'/../../include/mysql.class.php');
$db = new mysql($dbhost,$dbuser,$dbpass,$dbname);
$id=$_REQUEST['id'];
if ($_POST['name']=='' || $_POST['sex']=='' ||$_POST['identity_id']==''||$_POST['politics']==''||$_POST['join_time']==''||$_POST['address']==''||$_POST['profile_add']==''|| $_POST['education']=='' || $_POST['edu_sta']=='' || $_POST['graduate_school']=='' || $_POST['specialty']=='' || $_POST['phone1']==''|| $_POST['phone2']==''|| $_POST['baokao_job']==''||  $_POST['graduate_time']=='')
{
echo "<script language=\"JavaScript\">\r\n";   echo " alert(\"����д������Ϣ���ύ\");\r\n";   echo " location.replace(\"http://www.1dagong.com/zt/hefeizhaomu/index.html\");\r\n";   echo "</script>";   exit; 
        }

$uptypes1=array(
'application/msword',
'application/vnd.ms-powerpoint',
'application/vnd.ms-excel',
'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
'application/vnd.openxmlformats-officedocument.presentationml.presentation'
); 
$uptypes2=array(
'image/jpg', 
'image/jpeg',
'image/png',
'image/jpeg',
'image/gif',
'image/bmp',
'image/pjpeg',
'image/x-png'
);  
$max_file_size=20000000;   //�ϴ��ļ���С����, ��λBYTE
$path_parts=pathinfo($_SERVER['PHP_SELF']); //ȡ�õ�ǰ·��
$time=time();
$destination_folder=date("Y",$time).'/'; //�ϴ��ļ�·��
$destination_folder .=date("m",$time).'/'; //�ϴ��ļ�·��

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
if (!is_uploaded_file($_FILES["upfile"][tmp_name][0]))
//�Ƿ�����ļ�
{
	$identity_up=trim($_REQUEST['identity_up']);
}
if (!is_uploaded_file($_FILES["upfile"][tmp_name][1]))
//�Ƿ�����ļ�
{
	$identity_down=trim($_REQUEST['identity_down']);
}
if (!is_uploaded_file($_FILES["upfile"][tmp_name][2]))
//�Ƿ�����ļ�
{

	$photo=trim($_REQUEST['photo']);
}

 $file = $_FILES["upfile"];
 if($max_file_size < $file["size"][0])
 //����ļ���С
 {
 echo "<script language=\"JavaScript\">\r\n";   echo " alert(\"ͼƬ�ļ�̫��\");\r\n";   echo " history.back();\r\n";   echo "</script>";
					exit;  
  }
if($max_file_size < $file["size"][1])
 //����ļ���С
 {
 echo "<script language=\"JavaScript\">\r\n";   echo " alert(\"ͼƬ�ļ�̫��\");\r\n";   echo " history.back();\r\n";   echo "</script>";
					exit;  
  }
  if($max_file_size < $file["size"][2])
 //����ļ���С
 {
 echo "<script language=\"JavaScript\">\r\n";   echo " alert(\"ͼƬ�ļ�̫��\");\r\n";   echo " history.back();\r\n";   echo "</script>";
					exit;  
  }
if(!$identity_up)
{
	if(!in_array($file["type"][0], $uptypes2))  
    //����ļ�����  
    {  
        echo "<script language=\"JavaScript\">\r\n";   echo " alert(\"ͼƬ�ļ����Ͳ�����\");\r\n";   echo " history.back();\r\n";   echo "</script>";
					exit;  
    }  
}
if(!$identity_down)
{
	if(!in_array($file["type"][1], $uptypes2))  
    //����ļ�����  
    {  
           echo "<script language=\"JavaScript\">\r\n";   echo " alert(\"ͼƬ�ļ����Ͳ�����\");\r\n";   echo " history.back();\r\n";   echo "</script>";
					exit;   
    }  
}
 if(!$photo)
 {
	if(!in_array($file["type"][2], $uptypes2))  
    //����ļ�����  
    {  
           echo "<script language=\"JavaScript\">\r\n";   echo " alert(\"ͼƬ�ļ����Ͳ�����\");\r\n";   echo " history.back();\r\n";   echo "</script>";
					exit;   
    } 
 }
  
   

if(!file_exists($destination_folder))
if(!mkdir($destination_folder,0777,true)){
	echo "<font color='red'>������Ŀ¼ʧ��,���ֶ�������</a>";
}
$filename1=$file["tmp_name"][0];
$filename2=$file["tmp_name"][1];
$filename3=$file["tmp_name"][2];
$image_size = getimagesize($filename2);  
$pinfo1=pathinfo($file["name"][0]);
$pinfo2=pathinfo($file["name"][1]);
$pinfo3=pathinfo($file["name"][2]);
$ftype1=$pinfo1[extension];
$ftype2=$pinfo2[extension];
$ftype3=$pinfo3[extension];
$firstname=$_POST['phone1'];
//$destination1 = $destination_folder.$firstname."doc".time().".".$ftype1;
if($identity_up){$destination1=$identity_up;}else{$destination1 = $destination_folder.$firstname."pic_up".time().".".$ftype1;}
if($identity_down){$destination2 = $identity_down;}else{$destination2 = $destination_folder.$firstname."pic_down".time().".".$ftype2;}
if($photo){$destination3 = $photo;}else{$destination3 = $destination_folder.$firstname."photo".time().".".$ftype3;}

if(!$identity_up)
{
if (file_exists($destination1) && $overwrite != true)
{
     echo "<font color='red'>��ͬ�ļ��Ѿ������ˣ�</a>";
     exit;
  }
}
 if(!$identity_down)
{
  if (file_exists($destination2) && $overwrite != true)
{
     echo "<font color='red'>��ͬͼƬ�ļ��Ѿ������ˣ�</a>";
     exit;
  }
}
  if(!$photo)
{
   if (file_exists($destination3) && $overwrite != true)
{
     echo "<font color='red'>��ͬͼƬ�ļ��Ѿ������ˣ�</a>";
     exit;
  }
}
  
if(!$identity_up)
{
	if(!move_uploaded_file ($filename1, $destination1))
 {
   echo "<font color='red'>�ƶ�ͼƬ�ļ�����</a>";
     exit;
  }
}

  if(!$identity_down)
{
	if(!move_uploaded_file ($filename2, $destination2))
 {
   echo "<font color='red'>�ƶ�ͼƬ�ļ�����</a>";
     exit;
  }
}

   if(!$photo)
{
  if(!move_uploaded_file ($filename3, $destination3))
 {
   echo "<font color='red'>�ƶ�ͼƬ�ļ�����</a>";
     exit;
  }
}


}
//echo $destination1."<br>";echo $destination2;exit;
$name=trim($_POST['name']);
$sex=$_POST['sex'];
$identity_id=$_POST['identity_id'];//----���֤��
$politics=$_POST['politics'];//----������ò
$join_time=$_POST['join_time'];///----�뵳(��)ʱ��
$address=$_POST['address'];//-----�ֻ������ڵ�
$birthday=$_POST['birthday'];///----��������
if(!preg_match('/^\d{8}$/', $birthday))///-----8λ����
{
	echo "<script language=\"JavaScript\">\r\n";   echo " alert(\"����д�ĳ������ڸ�ʽ����\");\r\n";   echo " history.back();\r\n";   echo "</script>";
	exit;
}
if($birthday < 19801010)//---���������ж�
{
	echo "<script language=\"JavaScript\">\r\n";   echo " alert(\"����д�ĳ������ڲ����ϱ���������\");\r\n";   echo " history.back();\r\n";   echo "</script>";
	exit;
}
$profile_add=$_POST['profile_add'];///----�������ڵ�
$education=$_POST['education'];///---ѧ��
$edu_sta=$_POST['edu_sta'];///----ѧ������
$phone1=$_POST['phone1'];//----��ϵ�绰1
$phone2=$_POST['phone2'];///---��ϵ�绰2
$graduate_school=$_POST['graduate_school'];//---��ҵԺУ
$specialty=$_POST['specialty'];///-----��ѧרҵ
$graduate_time=$_POST['graduate_time'];///------��ҵʱ��
//---fff
/*$baokao_job=$_POST["baokao_job"]; 
for($i=0;$i<count($baokao_job);$i++){ 
$str= $baokao_job[$i].","; 
} 
$baokao_job = substr($str,0,strlen($str)-1); */
//---fff
$baokao_job=$_POST['baokao_job'];///----����ְλ
if(!preg_match('/^\d{4}$/', $baokao_job))//------4λ����
{
	echo "<script language=\"JavaScript\">\r\n";   echo " alert(\"���������������,ֻ�ܱ���һ����λ\");\r\n";   echo " history.back();\r\n";   echo "</script>";
	exit; 
}
if(substr($baokao_job,0,1) != 3)///---��һ��������3
{
	echo "<script language=\"JavaScript\">\r\n";   echo " alert(\"�����λ�����ѽ�ֹ,ֻ�ܱ�����ϰ��λ��\");\r\n";   echo " history.back();\r\n";   echo "</script>";
	exit; 
}
$baokao_specialty=$_POST['baokao_specialty'];///----����רҵ

$a='BKBM_'.rand(1000,9999);///----���������λ����
$exam_num=$a;///----�������

//echo $id;exit;
$db->query("UPDATE qs_baoming set name='{$name}',sex='{$sex}',identity_id='{$identity_id}',politics='{$politics}',identity_up='{$destination1}',identity_down='{$destination2}',join_time='{$join_time}',address='{$address}',birthday='{$birthday}',profile_add='{$profile_add}',education='{$education}',edu_sta='{$edu_sta}',phone1='{$phone1}',phone2='{$phone2}',graduate_school='{$graduate_school}',specialty='{$specialty}',graduate_time='{$graduate_time}',baokao_job='{$baokao_job}',photo ='{$destination3}',status=0 where id = '".$id."'");			

echo "<script language=\"JavaScript\">\r\n";   echo " alert(\"�޸ĳɹ�,�뱣���ֻ���ͨ���ȴ�������Ա��ϵ����\");\r\n";  echo " location.replace(\"/zt/hefeizhaomu/\");\r\n";   echo "</script>";   exit; 		
?>
