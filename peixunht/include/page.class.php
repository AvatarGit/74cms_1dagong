<?php
/** ******************************************************************************
 * brophp.com ��ҳ�࣬�����Զ����ҳ��ʾ���ݡ�                                   *
 * *******************************************************************************
 * ���������רΪ��ϸ˵PHP�����߼�LAMP�ֵ���ѧԱ�ṩ�ġ�ѧϰ�͡���������php��ܡ�*
 * *******************************************************************************
 * ��Ȩ���� (C) 2011-2013 �����׵��Ž�����ѯ���޹�˾������������Ȩ����           *
 * ��վ��ַ: http://www.lampbrother.net (LAMP�ֵ���)                             *
 * *******************************************************************************
 * $Author: ����� (skygao@lampbrother.net) $                                    *
 * $Date: 2011-07-18 10:00:00 $                                                  * 
 * ����:2013-7-31�޸�,															 *
 * ******************************************************************************/
	class Page {
		private $total;    //���ݱ����ܼ�¼��
		private $listRows; //ÿҳ��ʾ����
		private $url; 	   //��ҳ��url
		private $limit;    //SQL���ʹ��limit����
		private $uri;      //url��ַ
		private $pageNum;  //ҳ��
		private $page;
		//�ڷ�ҳ��Ϣ����ʾ���ݣ������Լ�����
		private $config=array('head'=>"����¼", "prev"=>"��һҳ", "next"=>"��һҳ", "first"=>"��ҳ", "last"=>"ĩҳ");
		private $listNum=10; //Ĭ�Ϸ�ҳ�б���ʾ�ĸ���

		/**
		 * ���췽�����������÷�ҳ�������
		 * @param	int	$total		�����ҳ���ܼ�¼��
		 * @param	int	$listRows	��ѡ�ģ�Ĭ��ÿҳ��Ҫ��ʾ�ļ�¼��
		 * @param	string	$pa		��ѡ�ģ�Ϊ��Ŀ��ҳ�洫�ݲ���
		 * @param 	bool	$ord		��ѡ�ģ�Ĭ��ֵΪtrue, ���ΪtrueĬ��ҳΪ��һҳ��false��Ϊ���һҳ
		 */
		public function __construct($total, $listRows=25, $url , $pa="", $ord=true){
			$this->total=$total;
			$this->listRows=$listRows;
			$this->url=$url;
			$this->uri=$this->getUri($pa);
			$this->pageNum=ceil($this->total/$this->listRows);
			if(!empty($_GET["page"])) {
				$page=$_GET["page"];
			}else{
				if($ord)
					$page=1;
				else
					$page=$this->pageNum;
			}

			if($total > 0) {
				if(preg_match('/\D/', $page) ){
					$this->page=1;
				}else{
					$this->page=$page;
				}
			}else{
				$this->page=0;
			}
			
			
			$this->limit=$this->setLimit();
		}

		/**
		 * ����������ʾ��ҳ����Ϣ�������������
		 * @param	string	$param	������config���±�
		 * @param	string	$value	��������config�±��Ӧ��Ԫ��ֵ
		 * @return	object		���ر������Լ�$this
		 */
		function set($param, $value){
			if(array_key_exists($param, $this->config)){
				$this->config[$param]=$value;
			}
			return $this;
		}

		private function setLimit(){
			if($this->page > 0)
				return ($this->page-1)*$this->listRows.", {$this->listRows}";
			else
				return 0;
		}

		private function getUri($pa){
			if($pa=="")
				return $GLOBALS["url"].$_GET["a"].'/';
			else
				return $GLOBALS["url"].$_GET["a"].'/'.trim($pa, "/").'/';
		}

		private function __get($args){
			if($args=="limit" || $args=="page")
				return $this->$args;
			else
				return null;
		}

		private function start(){
			if($this->total==0)
				return 0;
			else
				return ($this->page-1)*$this->listRows+1;
		}

		private function end(){
			return min($this->page*$this->listRows,$this->total);
		}

		private function firstprev(){
			if($this->page > 1) {
				$str="&nbsp;<a href='{$this->url}page=1'>{$this->config["first"]}</a>";
				$str.="&nbsp;<a href='{$this->url}page=".($this->page-1)."'>{$this->config["prev"]}</a>&nbsp;";		
				return $str;
			}

		}
	

		private function pageList(){
			$linkPage="&nbsp;<b>";
			
			$inum=floor($this->listNum/2);
		
			for($i=$inum; $i>=1; $i--){
				$page=$this->page-$i;

				if($page>=1)
					$linkPage.="<a href='{$this->url}page={$page}'>{$page}</a>&nbsp;";

			}

			if($this->pageNum > 1)
				$linkPage.="<span style='padding:1px 2px;background:#BBB;color:white'>{$this->page}</span>&nbsp;";
			

			for($i=1; $i<=$inum; $i++){
				$page=$this->page+$i;
				if($page<=$this->pageNum)
					$linkPage.="<a href='{$this->url}page={$page}'>{$page}</a>&nbsp;";
				else
					break;
			}
			$linkPage.='</b>';
			return $linkPage;
		}

		private function nextlast(){
			if($this->page != $this->pageNum) {
				$str="&nbsp;<a href='{$this->url}page=".($this->page+1)."'>{$this->config["next"]}</a>&nbsp;";
				$str.="&nbsp;<a href='{$this->url}page=".($this->pageNum)."'>{$this->config["last"]}</a>&nbsp;";
				return $str;
			}

		}

		private function goPage(){
    			if($this->pageNum > 1) {
				return '&nbsp;<input style="width:20px;height:17px !important;height:18px;border:1px solid #CCCCCC;" type="text" onkeydown="javascript:if(event.keyCode==13){var page=(this.value>'.$this->pageNum.')?'.$this->pageNum.':this.value;location=\''.$this->url.'page=\'+page+\'\'}" value="'.$this->page.'"><input style="cursor:pointer;width:25px;height:18px;border:1px solid #CCCCCC;" type="button" value="GO" onclick="javascript:var page=(this.previousSibling.value>'.$this->pageNum.')?'.$this->pageNum.':this.previousSibling.value;location=\''.$this->url.'page=\'+page+\'\'">&nbsp;';
			}
		}

		private function disnum(){
			if($this->total > 0){
				return $this->end()-$this->start()+1;
			}else{
				return 0;
			}
		}
		/**
		 * ��ָ���ĸ�ʽ�����ҳ
		 * @param	int	Ϊ0-7�����֣�ÿ��������Ϊһ�������������Զ��������ҳ�ṹ�͵����ṹ��˳��
		 * @return	string	��ҳ��Ϣ����
		 */
		function fpage(){
			$arr=func_get_args();

			$html[0]="&nbsp;��<b> {$this->total} </b>{$this->config["head"]}&nbsp;";
			$html[1]="&nbsp;��ҳ <b>".$this->disnum()."</b> ��&nbsp;";
			$html[2]="&nbsp;��ҳ�� <b>{$this->start()}-{$this->end()}</b> ��&nbsp;";
			$html[3]="&nbsp;<b>{$this->page}/{$this->pageNum}</b>ҳ&nbsp;";
			$html[4]=$this->firstprev();
			$html[5]=$this->pageList();
			$html[6]=$this->nextlast();
			$html[7]=$this->goPage();

			$fpage='<div style="font:12px \'\5B8B\4F53\',san-serif;">';
			if(count($arr) < 1)
				$arr=array(0, 1,2,3,4,5,6,7);
				

			for($i=0; $i<count($arr); $i++)
				$fpage.=$html[$arr[$i]];
		
			$fpage.='</div>';
			return $fpage;
		}
	}
