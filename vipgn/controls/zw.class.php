<?php
	class Zw {
		//�鿴չλ��Ϣ������.
		function index(){
			$zw=D("vip_zw");
			for( $i=10; $i<61; $i++){
				$_POST['subsite_id']=1;
				$_POST['number']="0".$i;
				echo "<br />".$id=$zw->insert();
			}
		}

}
	