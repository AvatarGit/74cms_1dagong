<?php
define('IN_QISHI', true);
require_once(dirname(__FILE__).'/../../include/common.inc.php');
$act = isset($_REQUEST['act']) ? trim($_REQUEST['act']) : 'update';
require_once(dirname(__FILE__).'/../../include/mysql.class.php');
$db = new mysql($dbhost,$dbuser,$dbpass,$dbname);
$id=$_REQUEST['id'];
if ($_POST['name']=='' || $_POST['sex']=='' ||$_POST['identity_id']==''||$_POST['politics']==''||$_POST['join_time']==''||$_POST['address']==''||$_POST['profile_add']==''|| $_POST['education']=='' || $_POST['edu_sta']=='' || $_POST['graduate_school']=='' || $_POST['specialty']=='' || $_POST['phone1']==''|| $_POST['phone2']==''|| $_POST['baokao_job']==''||  $_POST['graduate_time']=='')
{
echo "<script language=\"JavaScript\">\r\n";   echo " alert(\"请填写完整信息再提交\");\r\n";   echo " location.replace(\"http://www.1dagong.com/zt/hefeizhaomu/index.html\");\r\n";   echo "</script>";   exit; 
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
$max_file_size=20000000;   //上传文件大小限制, 单位BYTE
$path_parts=pathinfo($_SERVER['PHP_SELF']); //取得当前路径
$time=time();
$destination_folder=date("Y",$time).'/'; //上传文件路径
$destination_folder .=date("m",$time).'/'; //上传文件路径

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
if (!is_uploaded_file($_FILES["upfile"][tmp_name][0]))
//是否存在文件
{
	$identity_up=trim($_REQUEST['identity_up']);
}
if (!is_uploaded_file($_FILES["upfile"][tmp_name][1]))
//是否存在文件
{
	$identity_down=trim($_REQUEST['identity_down']);
}
if (!is_uploaded_file($_FILES["upfile"][tmp_name][2]))
//是否存在文件
{

	$photo=trim($_REQUEST['photo']);
}

 $file = $_FILES["upfile"];
 if($max_file_size < $file["size"][0])
 //检查文件大小
 {
 echo "<script language=\"JavaScript\">\r\n";   echo " alert(\"图片文件太大！\");\r\n";   echo " history.back();\r\n";   echo "</script>";
					exit;  
  }
if($max_file_size < $file["size"][1])
 //检查文件大小
 {
 echo "<script language=\"JavaScript\">\r\n";   echo " alert(\"图片文件太大！\");\r\n";   echo " history.back();\r\n";   echo "</script>";
					exit;  
  }
  if($max_file_size < $file["size"][2])
 //检查文件大小
 {
 echo "<script language=\"JavaScript\">\r\n";   echo " alert(\"图片文件太大！\");\r\n";   echo " history.back();\r\n";   echo "</script>";
					exit;  
  }
if(!$identity_up)
{
	if(!in_array($file["type"][0], $uptypes2))  
    //检查文件类型  
    {  
        echo "<script language=\"JavaScript\">\r\n";   echo " alert(\"图片文件类型不符！\");\r\n";   echo " history.back();\r\n";   echo "</script>";
					exit;  
    }  
}
if(!$identity_down)
{
	if(!in_array($file["type"][1], $uptypes2))  
    //检查文件类型  
    {  
           echo "<script language=\"JavaScript\">\r\n";   echo " alert(\"图片文件类型不符！\");\r\n";   echo " history.back();\r\n";   echo "</script>";
					exit;   
    }  
}
 if(!$photo)
 {
	if(!in_array($file["type"][2], $uptypes2))  
    //检查文件类型  
    {  
           echo "<script language=\"JavaScript\">\r\n";   echo " alert(\"图片文件类型不符！\");\r\n";   echo " history.back();\r\n";   echo "</script>";
					exit;   
    } 
 }
  
   

if(!file_exists($destination_folder))
if(!mkdir($destination_folder,0777,true)){
	echo "<font color='red'>您创建目录失败,请手动创建！</a>";
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
     echo "<font color='red'>相同文件已经存在了！</a>";
     exit;
  }
}
 if(!$identity_down)
{
  if (file_exists($destination2) && $overwrite != true)
{
     echo "<font color='red'>相同图片文件已经存在了！</a>";
     exit;
  }
}
  if(!$photo)
{
   if (file_exists($destination3) && $overwrite != true)
{
     echo "<font color='red'>相同图片文件已经存在了！</a>";
     exit;
  }
}
  
if(!$identity_up)
{
	if(!move_uploaded_file ($filename1, $destination1))
 {
   echo "<font color='red'>移动图片文件出错！</a>";
     exit;
  }
}

  if(!$identity_down)
{
	if(!move_uploaded_file ($filename2, $destination2))
 {
   echo "<font color='red'>移动图片文件出错！</a>";
     exit;
  }
}

   if(!$photo)
{
  if(!move_uploaded_file ($filename3, $destination3))
 {
   echo "<font color='red'>移动图片文件出错！</a>";
     exit;
  }
}


}
//echo $destination1."<br>";echo $destination2;exit;
$name=trim($_POST['name']);
$sex=$_POST['sex'];
$identity_id=$_POST['identity_id'];//----身份证号
$politics=$_POST['politics'];//----政治面貌
$join_time=$_POST['join_time'];///----入党(团)时间
$address=$_POST['address'];//-----现户籍所在地
$birthday=$_POST['birthday'];///----出生日期
if(!preg_match('/^\d{8}$/', $birthday))///-----8位数字
{
	echo "<script language=\"JavaScript\">\r\n";   echo " alert(\"您填写的出生日期格式错误！\");\r\n";   echo " history.back();\r\n";   echo "</script>";
	exit;
}
if($birthday < 19801010)//---年龄限制判断
{
	echo "<script language=\"JavaScript\">\r\n";   echo " alert(\"您填写的出生日期不符合报考条件。\");\r\n";   echo " history.back();\r\n";   echo "</script>";
	exit;
}
$profile_add=$_POST['profile_add'];///----档案所在地
$education=$_POST['education'];///---学历
$edu_sta=$_POST['edu_sta'];///----学历性质
$phone1=$_POST['phone1'];//----联系电话1
$phone2=$_POST['phone2'];///---联系电话2
$graduate_school=$_POST['graduate_school'];//---毕业院校
$specialty=$_POST['specialty'];///-----所学专业
$graduate_time=$_POST['graduate_time'];///------毕业时间
//---fff
/*$baokao_job=$_POST["baokao_job"]; 
for($i=0;$i<count($baokao_job);$i++){ 
$str= $baokao_job[$i].","; 
} 
$baokao_job = substr($str,0,strlen($str)-1); */
//---fff
$baokao_job=$_POST['baokao_job'];///----报考职位
if(!preg_match('/^\d{4}$/', $baokao_job))//------4位数字
{
	echo "<script language=\"JavaScript\">\r\n";   echo " alert(\"报考编码输入错误,只能报考一个岗位\");\r\n";   echo " history.back();\r\n";   echo "</script>";
	exit; 
}
if(substr($baokao_job,0,1) != 3)///---第一个数字是3
{
	echo "<script language=\"JavaScript\">\r\n";   echo " alert(\"基层岗位报名已截止,只能报考见习岗位！\");\r\n";   echo " history.back();\r\n";   echo "</script>";
	exit; 
}
$baokao_specialty=$_POST['baokao_specialty'];///----报考专业

$a='BKBM_'.rand(1000,9999);///----随机生成四位数字
$exam_num=$a;///----报考编号

//echo $id;exit;
$db->query("UPDATE qs_baoming set name='{$name}',sex='{$sex}',identity_id='{$identity_id}',politics='{$politics}',identity_up='{$destination1}',identity_down='{$destination2}',join_time='{$join_time}',address='{$address}',birthday='{$birthday}',profile_add='{$profile_add}',education='{$education}',edu_sta='{$edu_sta}',phone1='{$phone1}',phone2='{$phone2}',graduate_school='{$graduate_school}',specialty='{$specialty}',graduate_time='{$graduate_time}',baokao_job='{$baokao_job}',photo ='{$destination3}',status=0 where id = '".$id."'");			

echo "<script language=\"JavaScript\">\r\n";   echo " alert(\"修改成功,请保持手机畅通，等待工作人员联系您！\");\r\n";  echo " location.replace(\"/zt/hefeizhaomu/\");\r\n";   echo "</script>";   exit; 		
?>
