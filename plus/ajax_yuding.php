<?php
	$phone = !empty($_POST['phone']) ? trim($_POST['phone']) : '';
	$infoid = !empty($_POST['infoid']) ? trim($_POST['infoid']) : '';
	//echo "����Ԥ���ɹ���Ϣ<br />"."�ֻ��ţ�".$phone."<br />��¼id:".$infoid;
	echo "{statu:'success',phone:".$phone."}";
?>