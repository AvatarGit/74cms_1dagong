<?php
/** ******************************************************************************
 * brophp.com ͼ�����࣬������ɶ�ͼ��������źͼ�ͼƬˮӡ�Ĳ�����             *
 * *******************************************************************************
 * ���������רΪ��ϸ˵PHP�����߼�LAMP�ֵ���ѧԱ�ṩ�ġ�ѧϰ�͡���������php��ܡ�*
 * *******************************************************************************
 * ��Ȩ���� (C) 2011-2013 �����׵��Ž�����ѯ���޹�˾������������Ȩ����           *
 * ��վ��ַ: http://www.lampbrother.net (LAMP�ֵ���)                             *
 * *******************************************************************************
 * $Author: ����� (skygao@lampbrother.net) $                                    *
 * $Date: 2011-07-18 10:00:00 $                                                  * 
 * ******************************************************************************/
	class Image {
		protected $path;   //ͼƬ���ڵ�·��

		
		/**
		 * ����ͼ�����ʱ����ͼ���һ��·����Ĭ��ֵ�ǿ�ܵ��ļ��ϴ�Ŀ¼
		 * @param	string	$path	����ָ������ͼƬ��·��
		 */
		function __construct($path=""){
			if($path=="")
				$path=PROJECT_PATH."public/uploads";
			$this->path=$path;
		}
		/**
		 * ��ָ����ͼ���������
		 * @param	string	$name	����Ҫ�����ͼƬ����
		 * @param	int	$width	���ź�Ŀ��
		 * @param	int	$height	���ź�ĸ߶�
		 * @param	string	$qz	����ͼƬ��ǰ׺
		 * @return	mixed		�����ź��ͼƬ����,ʧ�ܷ���false;
		 */
		function thumb($name, $width, $height,$qz="th_"){
			$imgInfo=$this->getInfo($name);                                 //��ȡͼƬ��Ϣ
			$srcImg=$this->getImg($name, $imgInfo);                          //��ȡͼƬ��Դ         
			$size=$this->getNewSize($name,$width, $height,$imgInfo);       //��ȡ��ͼƬ�ߴ�
			$newImg=$this->kidOfImage($srcImg, $size,$imgInfo);   //��ȡ�µ�ͼƬ��Դ
			return $this->createNewImage($newImg, $qz.$name,$imgInfo);    //���������ɵ�����ͼ�����ƣ���"th_"Ϊǰ׺
		}
		/** 
		* ΪͼƬ���ˮӡ
		* @param	string	$groundName	����ͼƬ������Ҫ��ˮӡ��ͼƬ����ֻ֧��GIF,JPG,PNG��ʽ�� 
		* @param	string	$waterName	ͼƬˮӡ������Ϊˮӡ��ͼƬ����ֻ֧��GIF,JPG,PNG��ʽ; 
		* @param	int	$waterPos	ˮӡλ�ã���10��״̬��0Ϊ���λ�ã� 
		* 					1Ϊ���˾���2Ϊ���˾��У�3Ϊ���˾��ң� 
		* 					4Ϊ�в�����5Ϊ�в����У�6Ϊ�в����ң� 
		*					7Ϊ�׶˾���8Ϊ�׶˾��У�9Ϊ�׶˾��ң� 
		* @param	string	$qz		��ˮӡ���ͼƬ���ļ�����ԭ�ļ���ǰ��������ǰ׺����
		* @return	mixed			������ˮӡ���ͼƬ����,ʧ�ܷ���false;
		*/ 
		function waterMark($groundName, $waterName, $waterPos=0, $qz="wa_"){
			$this->path=rtrim($this->path,"/")."/";
			if(file_exists($this->path.$groundName) && file_exists($this->path.$waterName)){
				$groundInfo=$this->getInfo($groundName);               //��ȡ������Ϣ
				$waterInfo=$this->getInfo($waterName);                 //��ȡˮӡͼƬ��Ϣ

				if(!$pos=$this->position($groundInfo, $waterInfo, $waterPos)){
					Debug::addmsg("<font color='red'>ˮӡ��Ӧ�ñȱ���ͼƬС��</font>");
					return false;
				}

				$groundImg=$this->getImg($groundName, $groundInfo);    //��ȡ����ͼ����Դ
				$waterImg=$this->getImg($waterName, $waterInfo);       //��ȡˮӡͼƬ��Դ	

				$groundImg=$this->copyImage($groundImg, $waterImg, $pos, $waterInfo);  //����ͼ��

				return $this->createNewImage($groundImg, $qz.$groundName, $groundInfo);
				
			}else{
				Debug::addmsg("<font color='red'>ͼƬ��ˮӡͼƬ�����ڣ�</font>");
				return false;
			}
		}

		private function position($groundInfo, $waterInfo, $waterPos){
			//��Ҫ��ˮӡ��ͼƬ�ĳ��Ȼ��ȱ�ˮӡ��С���޷�����ˮӡ��
			if( ($groundInfo["width"]<$waterInfo["width"]) || ($groundInfo["height"]<$waterInfo["height"]) ) { 
				return false; 
			} 
			switch($waterPos) { 
				case 1://1Ϊ���˾��� 
					$posX = 0; 
					$posY = 0; 
					break; 
				case 2://2Ϊ���˾��� 
					$posX = ($groundInfo["width"] - $waterInfo["width"]) / 2; 
					$posY = 0; 
					break; 
				case 3://3Ϊ���˾��� 
					$posX = $groundInfo["width"] - $waterInfo["width"]; 
					$posY = 0; 
					break; 
				case 4://4Ϊ�в����� 
					$posX = 0; 
					$posY = ($groundInfo["height"] - $waterInfo["height"]) / 2; 
					break; 
				case 5://5Ϊ�в����� 
					$posX = ($groundInfo["width"] - $waterInfo["width"]) / 2; 
					$posY = ($groundInfo["height"] - $waterInfo["height"]) / 2; 
					break; 
				case 6://6Ϊ�в����� 
					$posX = $groundInfo["width"] - $waterInfo["width"]; 
					$posY = ($groundInfo["height"] - $waterInfo["height"]) / 2; 
					break; 
				case 7://7Ϊ�׶˾��� 
					$posX = 0; 
					$posY = $groundInfo["height"] - $waterInfo["height"]; 
					break; 
				case 8://8Ϊ�׶˾��� 
					$posX = ($groundInfo["width"] - $waterInfo["width"]) / 2; 
					$posY = $groundInfo["height"] - $waterInfo["height"]; 
					break; 
				case 9://9Ϊ�׶˾��� 
					$posX = $groundInfo["width"] - $waterInfo["width"]; 
					$posY = $groundInfo["height"] - $waterInfo["height"]; 
					break; 
				case 0:
				default://��� 
					$posX = rand(0,($groundInfo["width"] - $waterInfo["width"])); 
					$posY = rand(0,($groundInfo["height"] - $waterInfo["height"])); 
					break; 
			} 

			return array("posX"=>$posX, "posY"=>$posY);
		}

		
		// ��ȡͼƬ����Ϣ
		private function getInfo($name) {
			$this->path=rtrim($this->path,"/")."/";
			$data	= getimagesize($this->path.$name);
			$imgInfo["width"]	= $data[0];
			$imgInfo["height"]    = $data[1];
			$imgInfo["type"]	= $data[2];

			return $imgInfo;		
		}

		// ����ͼ����Դ 
		private function getImg($name, $imgInfo){
			$this->path=rtrim($this->path,"/")."/";
			$srcPic=$this->path.$name;
			
			switch ($imgInfo["type"]) {
				case 1:	//gif
					$img = imagecreatefromgif($srcPic);
					break;
				case 2:	//jpg
					$img = imagecreatefromjpeg($srcPic);
					break;
				case 3:	//png
					$img = imagecreatefrompng($srcPic);
					break;
				default:
					return false;
					break;
			}
			return $img;
		}
		
		//���صȱ������ŵ�ͼƬ��Ⱥ͸߶ȣ����ԭͼ�����ź�Ļ�С���ֲ���
		private function getNewSize($name, $width, $height,$imgInfo){	
			$size["width"]=$imgInfo["width"];          //��ԭͼƬ�Ŀ�ȸ������е�$size["width"]
			$size["height"]=$imgInfo["height"];        //��ԭͼƬ�ĸ߶ȸ������е�$size["height"]
			
			if($width < $imgInfo["width"]){
				$size["width"]=$width;             //���ŵĿ�������ԭͼС���������ÿ��
			}

			if($height < $imgInfo["height"]){
				$size["height"]=$height;            //���ŵĸ߶������ԭͼС���������ø߶�
			}

			if($imgInfo["width"]*$size["width"] > $imgInfo["height"] * $size["height"]){
				$size["height"]=round($imgInfo["height"]*$size["width"]/$imgInfo["width"]);
			}else{
				$size["width"]=round($imgInfo["width"]*$size["height"]/$imgInfo["height"]);
			}

			return $size;
		}	



		private function createNewImage($newImg, $newName, $imgInfo){
			$this->path=rtrim($this->path,"/")."/";
			switch ($imgInfo["type"]) {
		   		case 1:	//gif
					$result=imageGIF($newImg, $this->path.$newName);
					break;
				case 2:	//jpg
					$result=imageJPEG($newImg,$this->path.$newName);  
					break;
				case 3:	//png
					$result=imagePng($newImg, $this->path.$newName);  
					break;
			}
			imagedestroy($newImg);
			return $newName;
		}

		private function copyImage($groundImg, $waterImg, $pos, $waterInfo){
			imagecopy($groundImg, $waterImg, $pos["posX"], $pos["posY"], 0, 0, $waterInfo["width"],$waterInfo["height"]);
			imagedestroy($waterImg);
			return $groundImg;
		}

		private function kidOfImage($srcImg,$size, $imgInfo){
			$newImg = imagecreatetruecolor($size["width"], $size["height"]);		
			$otsc = imagecolortransparent($srcImg); //��ĳ����ɫ����Ϊ͸��ɫ
			if( $otsc >= 0 && $otsc < imagecolorstotal($srcImg)) {  //ȡ��һ��ͼ��ĵ�ɫ������ɫ����Ŀ
		  		 $transparentcolor = imagecolorsforindex( $srcImg, $otsc ); //ȡ��ĳ��������ɫ
		 		 $newtransparentcolor = imagecolorallocate(
			   		 $newImg,
			  		 $transparentcolor['red'],
			   	         $transparentcolor['green'],
			   		 $transparentcolor['blue']
		  		 );

		  		 imagefill( $newImg, 0, 0, $newtransparentcolor );
		  		 imagecolortransparent( $newImg, $newtransparentcolor );
			}
			imagecopyresized( $newImg, $srcImg, 0, 0, 0, 0, $size["width"], $size["height"], $imgInfo["width"], $imgInfo["height"] );
			imagedestroy($srcImg);
			return $newImg;
		}

	}
