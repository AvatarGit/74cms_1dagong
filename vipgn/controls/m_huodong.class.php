<?php
class M_huodong{
	//----------------------
	function index(){
		if(!empty($_SESSION['username'])){
			$this->assign("user",$_SESSION);
		}
		$this->display();
	}

	//��ȡҳ--------
	function lq(){
		if($_SESSION['uid'] && $_SESSION['username'] && $_SESSION['utype']){
			if($_SESSION['utype']==1){
				$data=D("qs_gifts")->where(array("be"=>"0"))->find();
				$_POST["lp_id"]=$data["id"];
				$_POST["username"]=$_SESSION['username'];
				$_POST["uid"]=$_SESSION['uid'];
				$_POST["addtime"]=time();
				$datalp=D("vip_lpk")->where(array("uid"=>$_SESSION['uid']))->select();
				if(empty($datalp)){
					$id=D("vip_lpk")->insert();
				}else{
					$this->assign("dat","���Ѿ���ȡ���ˣ����������Ʒ����");
					$this->dayin();
				}
				if(!empty($id)){
					$_POST["be"]=1;
					$id=D("qs_gifts")->where($data["id"])->update();
					if(!empty($id)){
						$this->assign("dat","��ȡ�ɹ������������Ʒ����");
						$this->dayin();
					}
				}
			}
                              else{
				$this->error("�㲻����ҵ�û���",3,"login");
			}


		}else{
			$this->login();
		}
	}
	//��¼ҳ��--------------------------------
	function login(){
		if(!empty($_SESSION['username'])){
			$this->assign("user",$_SESSION);
		}
		$this->display(dl);
	}
	
	//��¼����------------
	function dl(){
	  if(!empty($_POST)){
		$pwdhash = "3GbKpqoWDiBSK6Wg";
		$user=$_POST['user'];
		$pass=$_POST['pass'];
		$data=D("qs_members")->field("uid,utype,username,email,password,pwd_hash")->where(array("username"=>$user))->select();
		$pwd_hash=$data[0]['pwd_hash'];
		$usname=$data[0]['username'];
		$pwd=md5(md5($pass).$pwd_hash.$pwdhash);
		if($data[0]['password']==$pwd){
			$_SESSION['utype']=$data[0]['utype'];
			$_SESSION['uid']=$data[0]['uid'];
			$_SESSION['username']=$data[0]['username'];
			$this->lq();
		}else{
			$this->error("��¼ʧ��! �����n����",3,"login");
		}
	  }else{
			$this->error("�������û��������룡",3,"login");
		}
	}

	//�˳�ҳ��
	function tologin(){
		$username=$_SESSION["username"];
		$_SESSION=array();
		if(isset($_COOKIE[session_name()])){
			setCookie(session_name(),'',time()-3600,'/');
		}
		session_destroy();
		$this->success("�ټ� $username . ���µ�¼!",3,"index");

	}

	//��ӡҳ��
	function dayin(){
		$sql="select * from qs_gifts where id in(select lp_id from vip_lpk where uid='".$_SESSION['uid']."')";
		$data=D("qs_gifts")->query($sql,"select");
		if(!empty($data)){
			$this->assign("data",$data[0]);
		}
		if(!empty($_SESSION['username'])){
			$this->assign("user",$_SESSION);
		}
		$this->display(dayin);
	}
}