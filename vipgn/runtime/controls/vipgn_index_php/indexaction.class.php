<?php
	class IndexAction extends Common {
		//�鿴չλ��Ϣ������.
		function index(){			
			header("Content-type: text/html; charset=gb2312");
			$jobfair=D("qs_jobfair");
			if(!empty($_GET['id'])){$id=$_GET['id'];}
			if($id==0){
				//ȫվ����
				if(empty($_GET['dqid'])){$dqid=1;}else{$dqid=$_GET['dqid'];}
				
				$page=new Page($jobfair->where(array("subsite_id"=>$dqid,"holddates >"=>strtotime(date('Y-m-d',strtotime('-1 days')))))->total(), 10, "/id/0/dqid/".$dqid);
				$data=$jobfair->field("id,subsite_id,title,holddates,predetermined_start,predetermined_end,addtime")->where(array("subsite_id"=>$dqid,"holddates >"=>strtotime(date('Y-m-d',strtotime('-1 days')))))->order("id asc")->limit($page->limit)->select();
				$site=D("qs_subsite")->field("s_id,s_districtname")->select();
				foreach ($data as $i=>$v){
					$data[$i]['dq']="ȫվ";
					foreach ($site as $k=>$s){
						if($s['s_id']==$data[$i]['subsite_id']){
							$data[$i]['dq']=$s['s_districtname'];
						}
					}
				}
				$this->assign("dqid","0");
				$this->assign("data",$data);
				$this->assign("dq",$site);
			}else{
			
				$page=new Page($jobfair->where(array("subsite_id"=>$id,"holddates >"=>strtotime(date('Y-m-d',strtotime('-1 days')))))->total(), 10, "/id/".$_GET['id']);
				$data=$jobfair->field("id,subsite_id,title,holddates,predetermined_start,predetermined_end,addtime")->where(array("subsite_id"=>$id,"holddates >"=>strtotime(date('Y-m-d',strtotime('-1 days')))))->order("id asc")->limit($page->limit)->select();
				$site=D("qs_subsite")->field("s_id,s_districtname")->select();
				foreach ($data as $i=>$v){
					$data[$i]['dq']="ȫվ";
					foreach ($site as $k=>$s){
						if($s['s_id']==$data[$i]['subsite_id']){
							$data[$i]['dq']=$s['s_districtname'];
						}
					}
				}
				$this->assign("dqid",$id);
				$this->assign("data",$data);
			}
			$this->assign("fpage", $page->fpage());
			$this->display();	
		}
		/*----------------------------------------------------------------*/
		//�鿴ȫ��
		function indexckqb(){
			header("Content-type: text/html; charset=gb2312");
			$jobfair=D("qs_jobfair");
			if(!empty($_GET['id'])){$id=$_GET['id'];}
			if($id==0){
				if(empty($_GET['dqid'])){$dqid=1;}else{$dqid=$_GET['dqid'];}
				$page=new Page($jobfair->where(array("subsite_id"=>$dqid,"holddates <="=>strtotime(date('Y-m-d',strtotime('-1 days')))))->total(), 10, "/id/0/dqid/".$dqid);
				$data=$jobfair->field("id,subsite_id,title,holddates,predetermined_start,predetermined_end,addtime")->where(array("subsite_id"=>$dqid,"holddates <="=>strtotime(date('Y-m-d',strtotime('-1 days')))))->order("holddates desc")->limit($page->limit)->select();
				$site=D("qs_subsite")->field("s_id,s_districtname")->select();
				foreach ($data as $i=>$v){
					$data[$i]['dq']="ȫվ";
					foreach ($site as $k=>$s){
						if($s['s_id']==$data[$i]['subsite_id']){
							$data[$i]['dq']=$s['s_districtname'];
						}
					}
				}
				$this->assign("dqid","0");
				$this->assign("data",$data);
				$this->assign("dq",$site);
			}else{
				$page=new Page($jobfair->where(array("subsite_id"=>$id,"holddates <="=>strtotime(date('Y-m-d',strtotime('-1 days')))))->total(), 10);
				$data=$jobfair->field("id,subsite_id,title,holddates,predetermined_start,predetermined_end,addtime")->where(array("subsite_id"=>$id,"holddates <="=>strtotime(date('Y-m-d',strtotime('-1 days')))))->order("holddates desc")->limit($page->limit)->select();
				$site=D("qs_subsite")->field("s_id,s_districtname")->select();
				foreach ($data as $i=>$v){
					$data[$i]['dq']="ȫվ";
					foreach ($site as $k=>$s){
						if($s['s_id']==$data[$i]['subsite_id']){
							$data[$i]['dq']=$s['s_districtname'];
						}
					}
				}
				$this->assign("dqid",$id);
				$this->assign("data",$data);
			}
			$this->assign("fpage", $page->fpage());
			$this->display(indexckqb);	
		}
		/*----------------------------------------------------------------*/
		//�Զ���vip�ײ���Ļ�Ա���浽����չ�������
		function addzw(){
			header("Content-type: text/html; charset=gb2312"); 
			if(!empty($_GET['id'])){
				$id=$_GET['id'];
					//�Զ���չλ
					$user=D("vip_user");
					$zt=D("vip_zt");
					$Zhanhui=D("vip_zhanhui");
					$sql='select vip_user.id,vip_zt.uid,vip_user.qid,username,vip_zt.subsite_id,title,Pic,contents,huiyuan,phone,email,type,bout,number,add_time,end_time from vip_user left join vip_zt on vip_zt.uid = vip_user.id where activation=1 and type=1 ';
					$data=$user->query($sql,"select");															//��ѯ�û�ʱ���ײ͵�����
					//------------------------------------------------------------
					$jobfair=D("qs_jobfair")->field("id,subsite_id,holddates")->where(array("id"=>$id))->select();		//��ѯչ�����ڵ���
					if(!empty($data)){
						$arrayLen = sizeof($data);
						for($i=0; $i<$arrayLen; $i++){
							if($data[$i]['subsite_id']==$jobfair[0]['subsite_id']){			//�û��͵�����һ����û�ʱ���ײ͵�������ȡ����
								if(date('Y-m-d',$jobfair[0]['holddates']) <= date('Y-m-d',$data[$i]['end_time'])){
									$hh=$Zhanhui->where(array("zid"=>$id,"qid"=>$data[$i]['qid'],"subsite_id"=>$data[$i]['subsite_id']))->select();  //�����Բμӵ��û�
									if(empty($hh)){
										$_POST['subsite_id']=$data[$i]['subsite_id'];
										$_POST['zid']=$id;
										$_POST['qid']=$data[$i]['qid'];
										$_POST['username']=$data[$i]['username'];
										$_POST['title']=$data[$i]['title'];
										$_POST['huiyuan']=$data[$i]['huiyuan'];
										$_POST['phone']=$data[$i]['phone'];
										$_POST['email']=$data[$i]['email'];
										$_POST['number']=$data[$i]['number'];
										$_POST['yhtype']="1";
										$_POST['online_aoto']="1";
										$_POST['add_time']=time();
										$Zhanhui->insert();					//���浽���ݿ�
										echo $data[$i]['title']."�Ѿ������μ��� !<br />";
									}else{
										echo $data[$i]['title']."�Ѿ��μ���,����Ҫ�ظ��μ� !<br />";
									}
								}else{
									    echo $data[$i]['title']."�ײ��ѹ���,�����Բμ� !<br />";
								}
							}
						}
						$this->success("�ײ��û��μ�չ��ɹ�!", 15, "index/selqy/id/".$id);
				  }else{

				  		$this->error("û�ҵ���ҵ�û�,������ҵ�û�δ����",3,"index/index");
				  }
			}
		}
		//������ҵ����
		function selssqy(){
			if(!empty($_POST['id'])){
				$this->assign("zid",$_POST['id']);		//չ��id
				$Zhanhui=D("vip_zhanhui");
				$page=new Page($Zhanhui->where(array("zid"=>$_POST['id'],"title"=>"%".$_POST['name']."%"))->total(), 20 ,"id/".$_POST['id']);
				$data=$Zhanhui->where(array("zid"=>$_POST['id'],"title"=>"%".$_POST['name']."%"))->limit($page->limit)->select();
			}
			if(!empty($_GET['id'])){
				$this->assign("zid",$_GET['id']);		//չ��id
				$Zhanhui=D("vip_zhanhui");
				$page=new Page($Zhanhui->where(array("zid"=>$_GET['id'],"title"=>"%".$_POST['name']."%"))->total(), 20 ,"id/".$_GET['id']);
				$data=$Zhanhui->where(array("zid"=>$_GET['id'],"title"=>"%".$_POST['name']."%"))->limit($page->limit)->select();
			}
			
				$site=D("qs_subsite")->field("s_id,s_districtname")->select();
				foreach($data as $i=>$v){
					$data[$i]['dq']="ȫվ";
					foreach ($site as $k=>$s){
						if($s['s_id']==$data[$i]['subsite_id']){
							$data[$i]['dq']=$s['s_districtname'];
						}
					}
				}
				$this->assign("data",$data);	//Ԥ����ҵ��Ϣ
				$this->assign("fpage", $page->fpage());

			$this->display(zhqy);			//ģ��
		}
		//�鿴���ڵ���ҵ����
		function selqy(){
			header("Content-type: text/html; charset=gb2312"); 
			if(!empty($_GET['id'])){
				$id=$_GET['id'];	
			}else{
				$id=$_POST['id'];
			}
			//--------------------------------------------------
			$this->assign("zid",$id);		//չ��id
			//------------------------------------------
			$Zhanhui=D("vip_zhanhui");
			$page=new Page($Zhanhui->where(array("zid"=>$id))->total(), 20 ,"id/".$id);
			$data=$Zhanhui->where(array("zid"=>$id))->limit($page->limit)->select();
			$site=D("qs_subsite")->field("s_id,s_districtname")->select();
			/*foreach($data as $i=>$v){
				$data[$i]['dq']="ȫվ";
				foreach ($site as $k=>$s){
					if($s['s_id']==$data[$i]['subsite_id']){
						$data[$i]['dq']=$s['s_districtname'];
					}
				}
			}*/
			$this->assign("data",$data);	//Ԥ����ҵ��Ϣ
			$this->assign("fpage", $page->fpage());
			/*--------------------------------------------------------------------------------*/
			//���ݵ���------------------------------------------------
			$dqid=D("qs_jobfair")->field('subsite_id,title')->where(array(id=>$id))->select();
			// var_dump($dqid);exit;
			foreach ($site as $i=>$s){
				if($s['s_id']==$dqid[0]['subsite_id']){
					$qid=$s['s_id'];
					$dq=$s['s_districtname'];
				}
			}
			// echo $qid;exit;
			$this->assign("dqid",$qid);		//����id
			$this->assign("dq",$dq);		//��������
			$this->assign("jobfair_text",$dqid[0]['title']);		//��������
			
			//չλ��ʾ-----------------------------------------
			$zhanhui=D("vip_zhanhui");
			$ok=$zhanhui->where(array("zid"=>$id))->select();
			$this->assign("ok",$ok);		//��Ԥ����չλ
			$zw=D("vip_zw");
			$un_ding=D("vip_zhanhui")->where(array('zid'=>$id))->field("number")->select();
			// var_dump($un_ding);exit;
			foreach($un_ding as $i=>$v){
				if($i==0){
					$str="'".$v['number']."'";
				}else{
					$str.=",'".$v['number']."'";
				}
			}
			// var_dump($str);exit;
			// $sql="select number from vip_zw where subsite_id='".$qid."' and number not in(select number from vip_zhanhui where zid=".$id.")";
			$sql="select number from vip_zw where subsite_id='".$qid."' and number not in(".$str.")";
			// echo $sql;exit;
			// $sql="select number from vip_zw where number not in(select number from vip_zhanhui where zid=".$id.")";
			// echo mysql_error();exit;
			$all=$zw->query($sql,"select");
			// var_dump($all);exit;
			$this->assign("all",$all);		//δԤ����չλ
			//-----------------------------------------------------------------
			$this->display(zhqy);			//ģ��
		}
		//���Ԥ������չλ
		function jinji(){
			header('Content-Type:text/html;charset=GB2312');
			if(!empty($_POST)){
				$_POST['subsite_id']= iconv("utf-8","gbk",trim($_POST['subsite_id'])); 
				$_POST['zid']= iconv("utf-8","gbk",trim($_POST['zid'])); 
				$_POST['username']= "��";
				$_POST['title']= iconv("utf-8","gbk",trim($_POST['title']));
				$_POST['huiyuan']= iconv("utf-8","gbk",trim($_POST['huiyuan']));
				$_POST['phone']= iconv("utf-8","gbk",trim($_POST['phone']));
				$_POST['email']= iconv("utf-8","gbk",trim($_POST['email']));
				$_POST['xs_user']= iconv("utf-8","gbk",trim($_POST['xs_user']));
				$_POST['text']= iconv("utf-8","gbk",trim($_POST['text']));
				$_POST['number']= iconv("utf-8","gbk",trim($_POST['number']));
				$_POST['yhtype']= iconv("utf-8","gbk",trim($_POST['yhtype']));
				$_POST['online_aoto']= iconv("utf-8","gbk",trim($_POST['online_aoto']));
				$_POST['add_time']=time();
				$Zhanhui=D("vip_zhanhui");
				$id=$Zhanhui->insert();		
				if(!empty($id)){
					echo "Ԥ��չ��ɹ���";
				}else{
					echo "Ԥ��չ��ʧ�ܣ�";
				}
			}
			$GLOBALS["debug"]=0;
		}
		//�鿴�λ���ҵ
		function ckchqy(){
			header("Content-type: text/html; charset=gb2312");
			$jobfair=D("qs_jobfair");
			if(!empty($_GET['id'])){$id=$_GET['id'];}
			if($id==0){
				$data=$jobfair->field("id,subsite_id,title,holddates,addtime")->where(array())->order("holddates asc")->select();
				$this->assign("data",$data);
			}else{
				$data=$jobfair->field("id,subsite_id,title,holddates,addtime")->where(array("subsite_id"=>$id))->order("holddates asc")->select();
				$this->assign("data",$data);
			}
			$this->display(sszhqy);
		}
		//Ԥ����չ�����չλ�Ž���
		function gzw(){
			if(!empty($_GET['id'])){$id=$_GET['id'];}
			$zh=D("vip_zhanhui")->where(array("id"=>$id))->select();
			$this->assign("data",$zh[0]);
			$this->display(zhggzw);
		}
		//Ԥ����չ�����չλ��
		function gmod(){
			if(!empty($_POST)){
				$a=D("vip_zhanhui")->where(array("number"=>$_POST['number'],"zid"=>$_POST['zid']))->select();
				if(empty($a)){
					$id=D("vip_zhanhui")->where($_POST['id'])->update("number='".strval($_POST['number'])."'");
					if(!empty($id)){
						$this->success("����չλ�ɹ�!", 1, "index/selqy/id/".$_POST['zid']);
					}else{
						$this->error("����չλʧ��!",1,"index/selqy/id/".$_POST['zid']);
					}
				}else{
					$this->error("���չλ�ѱ�����û�Ԥ�����ˣ������!",2,"index");
				}
			}
		}
		//ɾ��Ԥ��������ҵ
		function gdel(){
			if(!empty($_GET['id'])){
				$id=$_GET['id'];
				$user=D("vip_zhanhui");
				$id=$user->delete($id);
				if(!empty($id)){
					$this->success("ɾ���ɹ�!", 1, "index/selqy/id/".$_GET['zhid']);
				}else{
					$this->error("ɾ��ʧ��!", 1, "index/selqy/id/".$_GET['zhid']);
				}
			}
		}
		//-----------------------------------------------------------------------------------------------------
		
		//��ѯ���ݿ����ҵ
		function selsecqy(){
			header("Content-type: text/html; charset=gb2312"); 
			if(!empty($_POST['qname'])){
				$name=$_POST['qname'];
				$a=D("qs_company_profile");
				$b=D("qs_members");
				$sql='select * from qs_company_profile join qs_members on qs_company_profile.uid = qs_members.uid where username = "'.$name.'"';
				$data=$b->query($sql,"select");
				if(empty($data)){
					$this->error("û���ҵ������ҵ!", 1);
				}
				$this->assign("data",$data[0]);
				$dq=D("qs_subsite")->field("s_id,s_districtname")->select();
				$this->assign("dq",$dq);
				if(!empty($_POST['dq_id'])){
					$this->assign("dq_dq",$_POST['dq_id']);
				}
				$this->display(addvip);
			}
			$GLOBALS["debug"]=0;
		}
		/*------------------------------------------------------����------------------------------------------------------*/
		//����
		function Operating(){
			header("Content-type: text/html; charset=gb2312"); 
			$zt=D("vip_zt");
			if(!empty($_GET['id'])){
				$id=$_GET['id'];
				$data=$zt->where(array("id"=>$id))->select();
				if(!empty($data)){
					if($data[0]['type']==1){
						//echo "��������ײ��û������Ը���չλ��";
						$this->assign("data",$data[0]);
						$this->assign("dqid",$_GET['dqid']);
						$this->display(cztaocan);
					}else{
						//echo "������Ǵ����û����������Ӵ���";
						//p($data[0]);exit;
						$this->assign("data",$data[0]);
						$this->display(czvip);
					}
				}else{
					$this->error("�����Ȱ��ײͣ�лл!",1,"index/bl/id/".$id);
				}
			}
		}
		//�޸Ĵ���ʱ��
		function updatasj(){
				header("Content-type: text/html; charset=gb2312"); 
				$zt=D("vip_zt");
				$sql="UPDATE {$zt->tabName} set cs_ks_time=".strtotime($_POST['cs_ks_time']).",cs_end_time=".strtotime($_POST['cs_end_time'])."  WHERE id=".$_POST['id'];
				$id=$zt->query($sql,"update");
				if(!empty($id)){
					//$this->success("���Ӵ����ɹ�!", 1, "index");
					$this->ok("�����ɹ�!",1,"/../kunkunhaobang/admin_vip.php?act=selectcsvip");
				}else{
					//$this->error("���Ӵ���ʧ��!",1,"index");
					$this->xw("����ʧ��!",1,"/../kunkunhaobang/admin_vip.php?act=selectcsvip");
				}
		}
		//�޸�չλ�����
		function updata(){
			header("Content-type: text/html; charset=gb2312"); 
			$zt=D("vip_zt");
			/*-------------------------------------------------------------------------------------*/
			if($_POST['cs']=='1'){
					if($_POST['subsite_id'] == 5)///----�Ϻ���
					{
						if($_POST['cz']==1){$bout=intval($_POST['bout1'])+intval($_POST['bout']);}		//����
						if($_POST['cz']==2){$bout=intval($_POST['bout1'])-intval($_POST['bout']);}	//����
						if($bout<-1){
							$this->ok("����С��0��!",1,"/../kunkunhaobang/admin_vip.php?act=selectcsvip");
						}
						if($_POST['cz_6']==1){$bout_6=intval($_POST['bout1_6'])+intval($_POST['bout_6']);}	//����
						if($_POST['cz_6']==2){$bout_6=intval($_POST['bout1_6'])-intval($_POST['bout_6']);}		//����
						if($bout_6<-1){
						$this->ok("��������С��0��!",1,"/../kunkunhaobang/admin_vip.php?act=selectcsvip");
						}
						$sql="UPDATE {$zt->tabName} set bout=".$bout.",bout_6=".$bout_6." WHERE id=".$_POST['id'];
						//echo $sql;exit;
					}else{//-----��������
						if($_POST['cz']==1)
						{
							$bout=intval($_POST['bout1'])+intval($_POST['bout']);		//����
						}
						if($_POST['cz']==2)
						{
							$bout=intval($_POST['bout1'])-intval($_POST['bout']);		//����
						}
						if($bout<-1)
						{
							$this->ok("����С��0��!",1,"/../kunkunhaobang/admin_vip.php?act=selectcsvip");
						}
						$sql="UPDATE {$zt->tabName} set bout=".$bout." WHERE id=".$_POST['id'];
					}
					
					$id=$zt->query($sql,"update");
					if(!empty($id)){
						//$this->success("���Ӵ����ɹ�!", 1, "index");
						$this->ok("���������ɹ�!",1,"/../kunkunhaobang/admin_vip.php?act=selectcsvip");
					}else{
						//$this->error("���Ӵ���ʧ��!",1,"index");
						$this->xw("��������ʧ��!",1,"/../kunkunhaobang/admin_vip.php?act=selectcsvip");
					}
			}
			/*-------------------------------------------------------------------------------------*/
			if($_POST['nf']=='1'){
				//��չλ
				$a=$zt->where(array("number"=>$_POST['number'],"subsite_id"=>$_POST['subsite_id']))->select();
				if(empty($a)){
					$id=$zt->where($_POST['id'])->update("number='".strval($_POST['number'])."'");
					if(!empty($id)){
						//$this->success("����չλ�ɹ�!", 1, "index");
						$this->ok("����չλ�ɹ�!",1,"/../kunkunhaobang/admin_vip.php?act=selecttcvip");
					}else{
						$this->xw("����չλʧ��!",1,"/../kunkunhaobang/admin_vip.php?act=selecttcvip");
					}
				}else{
					//$this->error("���չλ�ѱ�����û�Ԥ�����ˣ������!",1,"index");
					$this->xw("���չλ�ѱ�����û�Ԥ�����ˣ������!!",1,"/../kunkunhaobang/admin_vip.php?act=selecttcvip");
				}
			}
			/*-------------------------------------------------------------------------------------*/
		}
		//���Ӽ����ײ��û�����
		function zjshijian(){
			if(!empty($_POST)){
				if($_POST['sj']==1){
					$date=date('Y-m-d',$_POST['end_time']);
					$sj=date('Y-m-d',strtotime($date . '+'.$_POST['tianshu'].' day'));
				}
				if($_POST['sj']==2){
					$date=date('Y-m-d',$_POST['end_time']);
					$sj=date('Y-m-d',strtotime($date . '-'.$_POST['tianshu'].' day'));
				}
				//echo strtotime($sj)."<br>";echo time();exit;
				$zt=D("vip_zt");
				$id=$zt->where($_POST['id'])->update("end_time='".strtotime($sj)."'");
				if(!empty($id)){
					//$this->success("����չλ�ɹ�!", 1, "index");
					$this->ok("����ʱ��ɹ�!",1,"/../kunkunhaobang/admin_vip.php?act=selecttcvip");
				}else{
					$this->xw("����ʱ��ʧ��!",1,"/../kunkunhaobang/admin_vip.php?act=selecttcvip");
				}
			}
		}
		/*-----------------------------------------------�ײͲ���-------------------------------------------------*/
		//ʱ���ײ͵ļ���
		function tjh(){
			header("Content-type: text/html; charset=gb2312"); 
			if(!empty($_GET['id'])){
				$id=D("vip_zt")->where(array("id"=>$_GET['id']))->update("activation=1");  
				if(!empty($id)){
					//$this->success("����ɹ�!", 1, "index");
					$this->ok("����ɹ�!",1,"/../kunkunhaobang/admin_vip.php?act=selecttcvip");
				}else{
					//$this->error("�Ѽ���,�򼤻�ʧ��!",1,"index");
					$this->xw("����ʧ��, �����Ѽ���!",1,"/../kunkunhaobang/admin_vip.php?act=selecttcvip");
				}
			}
		}
		//�����ײ͵ļ���
		function cjh(){
			header("Content-type: text/html; charset=gb2312"); 
			if(!empty($_GET['id'])){
				$id=D("vip_zt")->where(array("id"=>$_GET['id']))->update("activation=1");  
				if(!empty($id)){
					//$this->success("����ɹ�!", 1, "index");
					$this->ok("����ɹ�!",1,"/../kunkunhaobang/admin_vip.php?act=selectcsvip");
				}else{
					//$this->error("�Ѽ���,�򼤻�ʧ��!",1,"index");
					$this->xw("����ʧ��, �����Ѽ���!",1,"/../kunkunhaobang/admin_vip.php?act=selectcsvip");
				}
			}
		}
		//�鿴�ײͻ�Ա
		/*
			����Դ�������
		*/
		//����vip����
		function blvip(){
			header("Content-type: text/html; charset=gb2312"); 
			$user=D("vip_user");
			if(!empty($_GET['id'])){
				$id=$_GET['id'];
				$data=$user->where(array("id"=>$id))->select();
				$site=D("qs_subsite")->field("s_id,s_districtname")->select();
				foreach ($data as $i=>$v){
					$data[$i]['dq']="ȫվ";
					foreach ($site as $k=>$s){
						if($s['s_id']==$data[$i]['subsite_id']){
							$data[$i]['dq']=$s['s_districtname'];
						}
					}
				}
			$this->assign("data",$data[0]);
			$this->display(blvip);
			}
		}
		//���������û������ײ�
		function ssbl(){
			header("Content-type: text/html; charset=gb2312");
			$user=D("vip_user");
			if(!empty($_POST['name'])){
				$name=$_POST['name'];
				$data=$user->where(array("username"=>$name))->select();
				if(empty($data)){
					$this->error("û���ҵ����û�,����������!", 1, "index/ssbl");
				}
			}
			$site=D("qs_subsite")->field("s_id,s_districtname")->select();
			foreach ($data as $i=>$v){
				$data[$i]['dq']="ȫվ";
				foreach ($site as $k=>$s){
					if($s['s_id']==$data[$i]['subsite_id']){
						$data[$i]['dq']=$s['s_districtname'];
					}
				}
			}
			$this->assign("data",$data[0]);
			$this->display(ssblvip);
		}
		//ɾ����ҵ�Ѱ�����ײ�
		function tcdel(){
			header("Content-type: text/html; charset=gb2312"); 
			if(!empty($_GET['id'])){
				$id=D("vip_zt")->delete($_GET['id']);
				if(!empty($id)){
					$user=D("vip_user")->where(array("id"=>$_GET['uid']))->update("bl=0"); 
					//$this->success("ɾ�������û��ײͳɹ�!", 1, "index");
					$this->ok("ɾ�������û��ײͳɹ�!!",1,"/../kunkunhaobang/admin_vip.php?act=selecttcvip");
				}else{
					//$this->error("ɾ�������û��ײ�ʧ��!", 1, "index");
					$this->xw("ɾ�������û��ײ�ʧ��!",1,"/../kunkunhaobang/admin_vip.php?act=selecttcvip");
				}
			}
		}
		//ɾ����ҵ�԰�����ײ�
		function csdel(){
			header("Content-type: text/html; charset=gb2312"); 
			if(!empty($_GET['id'])){
				$id=D("vip_zt")->delete($_GET['id']);
				if(!empty($id)){
					$user=D("vip_user")->where(array("id"=>$_GET['uid']))->update("bl=0"); 
					//$this->success("ɾ�������û��ײͳɹ�!", 1, "index");
					$this->ok("ɾ�������û��ײͳɹ�!!",1,"/../kunkunhaobang/admin_vip.php?act=selectcsvip");
				}else{
					//$this->error("ɾ�������û��ײ�ʧ��!", 1, "index");
					$this->xw("ɾ�������û��ײ�ʧ��!",1,"/../kunkunhaobang/admin_vip.php?act=selectcsvip");
				}
			}
		}
		//������ҵ�ײ�
		function addtc(){
			//echo "�����ײ�";exit;
			header("Content-type: text/html; charset=gb2312"); 
			$zt=D("vip_zt");
			if(!empty($_POST)){
				/*-----���˲������û�ֱ������ײ�---------------*/
				if($_POST['uid']=="" and $_POST['qid']==""){
					$this->error("���Ȳ����û��ſ��԰����ײ�!", 2, "index/ssbl");
				}
				/*-----���˲������û�ֱ������ײ�-------------*/
				if($_POST['type']==0){
					$_POST['duration']="";
					$_POST['add_time']=time();
					$_POST['activation']=0;
					if($_POST['bout']!="" and $_POST['cs_ks_time']!="" and $_POST['cs_end_time']!=""){
						$_POST['cs_ks_time']=strtotime($_POST['cs_ks_time']);
						$_POST['cs_end_time']=strtotime($_POST['cs_end_time']);
						$_POST['bout_6']=isset($_POST['bout_6'])?intval($_POST['bout_6']):0;
						$id=$zt->insert();
					}else{
						$this->error("�������������ύ��лл!", 1, "index/ssbl");
					}
					if(!empty($id)){
						$user=D("vip_user")->where(array("id"=>$_POST['uid']))->update("bl=1"); 
						//$this->success("��������ײͳɹ�!", 1, "index");
						$this->ok("��������ײͳɹ�!!",1,"/../kunkunhaobang/admin_vip.php?act=selectcsvip");
					}else{
						//$this->error("��������ײ�ʧ��!", 1, "index/");
						$this->xw("��������ײ�ʧ��!",1,"/../kunkunhaobang/admin_vip.php?act=ckvip");
					}
				}else{
					/*����û������չλ��*/
					if($_POST['number']==""){
							$this->error("������չλ�ţ�лл!", 2, "index/ssbl");
					}
					/*����û������չλ��*/
					$a=$zt->where(array("number"=>$_POST['number'],"subsite_id"=>$_POST['subsite_id']))->select();
					if(empty($a)){
						
						$_POST['activation']=0;
						if($_POST['add_time']==""){
							$t=time();
							$_POST['add_time']=time();
						}else{
							$t=strtotime($_POST['add_time']);
							$_POST['add_time']=strtotime($_POST['add_time']);
						}
						if($_POST['duration']=="1"){
							$_POST['end_time']=strtotime(date("Y-m-d H:i:s",strtotime("+1 year",$t)));				//1���ײ�
						}
						if($_POST['duration']=="2"){
							$_POST['end_time']=strtotime(date("Y-m-d H:i:s",strtotime("+6 months",$t)));			//�����ײ�
						}
						if($_POST['duration']=="3"){
							$_POST['end_time']=strtotime(date("Y-m-d H:i:s",strtotime("+3 months",$t)));			//1���ײ�
						}
						//p($_POST);echo date('Y-m-d',1475856000);
						$id=$zt->insert();
						//echo $id;exit;
						if(!empty($id)){
							$user=D("vip_user")->where(array("id"=>$_POST['uid']))->update("bl=1"); 
							//$this->success("����ʱ���ײͳɹ�!", 1, "index");
							$this->ok("����ʱ���ײͳɹ�!!",1,"/../kunkunhaobang/admin_vip.php?act=selecttcvip");
						}else{
							//$this->error("����ʱ���ײ�ʧ��!", 1, "index");
							$this->xw("����ʱ���ײ�ʧ��!",1,"/../kunkunhaobang/admin_vip.php?act=ckvip");
						}
						
					}else{
						$this->error("���չλ�ѱ�����û�Ԥ������, �����չλ�����°���!",5,"index/blvip/id/".$_POST['uid']);
					}
				}
			}
		}
/*-----------------------------------------------�û�����-------------------------------------------------*/
		//�����ҵ�û�����
		function addvip(){
			header("Content-type: text/html; charset=gb2312"); 
			$dq=D("qs_subsite")->field("s_id,s_districtname")->select();
			$this->assign("dq",$dq);
			if(!empty($_GET['id'])){
				$this->assign("dq_dq",$_GET['id']);
			}
			$this->display(addvip);
		}
		//�����ҵ�û�����
		function addqy(){
			header("Content-type: text/html; charset=gb2312"); 
			$user=D("vip_user");
			if(!empty($_POST)){
				if($_POST['qid']!="" && $_POST['username']!=""){
				/*-----------------------------------------------------------------------------*/
						//��������Ա
						if($_POST['huiyuan']=='2'){		//��������Ա
							$_POST['huiyuan']='2';
							$_POST['addtime']=time();
							$_POST['bl']=1;
							$id=$user->insert($_POST);
							if(!empty($id)){
								$_POST['uid']=$id;
								$_POST['qid']=$_POST['qid'];
								$_POST['subsite_id']=$_POST['subsite_id'];
								$_POST['type']='0';
								$_POST['bout']='1';
								$_POST['cs_ks_time']=time();
								$_POST['cs_end_time']=strtotime(date('Y-m-d',strtotime('7 days')));
								$_POST['duration']="";
								$_POST['add_time']=time();
								$_POST['activation']='1';
								$a=D('vip_zt')->insert($_POST);
								if(!empty($a)){
									$this->ok("��������û��ɹ��������һ�β�չ����!",1,"/../kunkunhaobang/admin_vip.php?act=ckvip");
								}
							}else{
								$this->xw("����ӵ��û��Ѵ���!",1,"/../kunkunhaobang/admin_vip.php?act=ckvip");
							}
						}
						/*-----------------------------------------------------------------------------*/
						//�������ͻ�Ա
						if($_POST['huiyuan']=='3'){		//�������ͻ�Ա
							$_POST['huiyuan']='3';
							$_POST['addtime']=time();
							$_POST['bl']=1;
							$id=$user->insert($_POST);
							if(!empty($id)){
								header("Location: chuchuangzs/id/".$id);		//��Ӵ���
							}
						}
						/*-----------------------------------------------------------------------------*/
						//��ʽ��Ա
						if($_POST['huiyuan']=='1'){		//��ʽ��Ա
							$_POST['huiyuan']='0';
							$_POST['addtime']=time();
							$_POST['bl']=0;
							$id=$user->insert($_POST);
							if(!empty($id)){
								//$this->success("����û��ɹ�!", 1, "index/ckvip");
								$this->ok("����û��ɹ�!",1,"/../kunkunhaobang/admin_vip.php?act=ckvip");
							}else{
								//$this->error("����ӵ��û��Ѵ�!!,����Ҫ�������!", 1, "index/addvip");
								$this->xw("����ӵ��û��Ѵ���!",1,"/../kunkunhaobang/admin_vip.php?act=ckvip");
							}
						}
				/*-----------------------------------------------------------------------------*/
				}else{
					$this->xw("������վ��Ա�û���ע�������!",3,"/vipgn/index.php/index/addvip");
				}
			}
		}
		//����Ԥ�����ʹ�������
		function chuchuangzs(){
			header("Content-type: text/html; charset=gb2312"); 
			$user=D("vip_user");
			if(!empty($_GET['id'])){
				$id=$_GET['id'];
				$data=$user->where(array("id"=>$id))->select();
				$site=D("qs_subsite")->field("s_id,s_districtname")->select();
				foreach ($data as $i=>$v){
					$data[$i]['dq']="ȫվ";
					foreach ($site as $k=>$s){
						if($s['s_id']==$data[$i]['subsite_id']){
							$data[$i]['dq']=$s['s_districtname'];
						}
					}
				}
			$this->assign("data",$data[0]);
			$this->display(chuchuangblvip);
			}
		}
		//����Ԥ�����ʹ�������
		function chuchuangaddtc(){
				$_POST['duration']="";
				$_POST['add_time']=time();
				$_POST['activation']=1;
				$_POST['cs_ks_time']=time();
				$_POST['cs_end_time']=strtotime(date('Y-m-d',strtotime('30 days')));
				$id=D('vip_zt')->insert($_POST);
				if(!empty($id)){
					$this->ok("����û������Ԥ��չ������ɹ�!",3,"/../kunkunhaobang/admin_vip.php?act=ckvip");
				}else{
					$this->xw("����û������Ԥ��չ�����ʧ��!",3,"/../kunkunhaobang/admin_vip.php?act=ckvip");
				}
		
		}
		//�鿴��ҵ�û�
		/*
			����Դ�������
		*/
		//�޸���ҵ�û�����
		function upvip(){
			header("Content-type: text/html; charset=gb2312"); 
			$user=D("vip_user");
			if(!empty($_GET['id'])){
				$id=$_GET['id'];
				$data=$user->where(array("id"=>$id))->select();
				$this->assign("data",$data[0]);
			}
			$dq=D("qs_subsite")->select();
			$this->assign("dq",$dq);
			$this->display(upvip);
		}
		//�޸���ҵ�û���Ϣ
		function upmod(){
			header("Content-type: text/html; charset=gb2312"); 
			$user=D("vip_user");
			if(!empty($_POST)){
				if($_POST['huiyuan']=='1'){$_POST['huiyuan']='0';}
				$id=$user->update();
				if(!empty($id)){
					//$this->success("�޸��û��ɹ�!", 1, "index/ckvip");
					$this->ok("�޸��û��ɹ�!",1,"/../kunkunhaobang/admin_vip.php?act=ckvip");
				}else{
					//$this->error("�޸��û�ʧ��!", 1, "index/ckvip");
					$this->xw("�޸��û�ʧ��!",1,"/../kunkunhaobang/admin_vip.php?act=ckvip");
				}
			}
		}
		//ɾ���û�
		function udel(){
			header("Content-type: text/html; charset=gb2312"); 
			if(!empty($_GET['id'])){
				$id=$_GET['id'];
				$user=D("vip_user");
				$id=$user->delete($id);
				if(!empty($id)){
					//$this->success("ɾ�������û��ɹ�!", 1, "index/ckvip");
					$this->ok("ɾ�������û��ɹ�!",1,"/../kunkunhaobang/admin_vip.php?act=ckvip");
				}else{
					//$this->error("ɾ�������û�ʧ��!", 1, "index/ckvip");
					$this->xw("ɾ�������û�ʧ��!",1,"/../kunkunhaobang/admin_vip.php?act=ckvip");
				}
			}
		}
		
		//ɾ����֤--------
		function scyz(){
			unset($_SESSION['qx']);
			$this->success("ɾ����֤�ɹ�!", 1, "index/index");
		}
	}