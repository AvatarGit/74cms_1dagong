<?php
    header ( "Content-Type: text/html; charset=gb2312" );
    $reply = "";
    if ( isset($_POST["email_address"]) )
    {
        $email_address = $_POST["email_address"];
        $pattern = "/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i";
        if ( preg_match( $pattern, $email_address ) )
        {
            $reply = "������ĵ����ʼ���ַ�Ϸ�<br /><br />\n";
            $user_name = preg_replace( $pattern ,"$1", $email_address );
            $domain_name = preg_replace( $pattern ,"$2", $email_address );
            $reply .= "�û�����".$user_name."<br />\n";
            $reply .= "������".$domain_name."<br />\n\n";
        }
        else
        {
            $reply = "������ĵ����ʼ���ַ���Ϸ�";
        }
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="zh" xml:lang="zh">
<head>
<title>�����ʼ���ַ��֤����</title>
</head>
<body style="text-align: center;">
<h1>�����ʼ���ַ��֤����</h1>
<form action="#" method="post">
����������ʼ���ַ��<input name="email_address" type="text" style="width: 300px;" /><br />
<input type="submit" value="��֤�����ʼ���ַ" />
</form>
<?php
    echo $reply;
///------------------------///
echo "�õ���λ��ʮλ����λ������<br>";
echo $a=123456;
echo "��λ�ǣ�".substr($a,5,1)."<br>";
echo "ʮλ�ǣ�".substr($a,4,1)."<br>";
echo "��λ�ǣ�".substr($a,3,1)."<br>";
//---------------------------//
//----------------
echo "��ñ�����λ����<br>";

	/*$num=56423;
	$t=strlen($num);
	for($i=0;$i<=$t;$i++){
		echo substr($num,($t-$i),1)."<br>";
	}*/
	$num=56423;
	$t=strlen($num);
	for($i=1;$i<=$t;$i++){
		if($i==1){
			$html=substr($num,($t-$i),1)."��";
		}else if($i==2){
			$html.=substr($num,($t-$i),1)."ʮ";
		}else if($i==3){
			$html.=substr($num,($t-$i),1)."��";
		}else if($i==4){
			$html.=substr($num,($t-$i),1)."ǧ";
		}else if($i==5){
			$html.=substr($num,($t-$i),1)."��";
		}
	}
	echo $html;
//--------------
?>
</body>
</html>