<?php /* V2.10 Template Lite 4 January 2007  (c) 2005-2007 Mark Dickenson. All rights reserved. Released LGPL. 2018-07-13 16:37 �й���׼ʱ�� */ ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>����������Ƹ��Ϣ-������Ƹ��-�Ϸ��˲��� - �Ϸ�Ҽ����</title>
<meta name="description" content="����Ҽ�����ҹ���Ƶ����Ϊ��ְ���ҹ����ṩ2015���¸���ְλ��Ƹ��Ϣ����׼��ְ�������ù����������ҹ������Ҽ�ְ�����ϰ����˲�����">
<meta name="keywords" content="������Ƹ,������Ƹ��,�����ҹ���">
<meta name="author" content="Ҽ����" />
<meta http-equiv="X-UA-Compatible" content="IE=7">
<link rel="shortcut icon" href="favicon.ico" />
<link href="/files/css/common.css" rel="stylesheet" type="text/css" />
<link href="/files/css/jobs.css" rel="stylesheet" type="text/css" />
<link href="/files/css/all.css" rel="stylesheet" type="text/css" />
<link href="/files/css/font-awesome.min.css" rel="stylesheet" >
<script src="/files/js/jquery.js" type='text/javascript' ></script>
<script src="/files/js/jquery.dialog.js" type='text/javascript' ></script>
<script src="/files/js/jquery.jobs-search.js" type='text/javascript'></script>
<script src="../../data/cache_classify.js" type='text/javascript' charset="utf-8"></script>
<script src="/files/js/jquery.hoverDelay.js" type='text/javascript'></script>
<script src="/files/js/jquery.vtip-min.js" type='text/javascript'></script>
<script type="text/javascript">
	$(document).ready(function() {
		// ����������������
		var getstr = new Array();
		getstr[0] = '';
		getstr[1] = '';
		getstr[2] = '';
		getstr[3] = '';
		getstr[4] = '';
		getstr[5] = '';
		getstr[6] = '';
		getstr[7] = '';
		allaround('/',getstr);
		// ��ʾ��ҵ
		$("#jobsTrad").hoverDelay({
		    hoverEvent: function(){
		        $("#divTradCate").show();
		    },
		    outEvent: function(){
                $("#divTradCate").hide();
            }
		});
 		// ��ʾְλ
 		$("#jobsSort").hoverDelay({
		    hoverEvent: function(){
		        $("#divJobCate").show();
		        var dx = $("#divJobCate").offset().left; // ��ȡ�������x����
		        var dy = $("#divJobCate").offset().top; // ��ȡ�������y����
		        var dwidth = $("#divJobCate").outerWidth(true); // ��ȡ������Ŀ��
		        var dheight = $("#divJobCate").outerHeight(true); // ��ȡ������ĸ߶�
		        var lastx = dx + dwidth; // ���ϵ�����Ŀ�Ȼ�ȡ���������ұߵ�x����
		        var lasty = dy + dheight; // ���ϵ�����ĸ߶Ȼ�ȡ���������±ߵ�y����
	 			$("#divJobCate li").each(function(index, el) {
	 				var that = $(this);
	 				var sx = that.offset().left; // ��ȡ��ǰli��x����
	 				var sy = that.offset().top; // ��ȡ��ǰli��y����
	 				that.hoverDelay({
					    hoverEvent: function(){
					        if(that.find('.subcate').length > 0) {
			 					that.addClass('selected');
			 					var tharsub = that.find('.subcate');
			 					var thap = that.find('p');
			 					var swidth = tharsub.outerWidth(true); // ��ȡ����������Ŀ��
			 					var sheight = tharsub.outerHeight(true); // ��ȡ����������ĸ߶�
			 					if((lastx - sx) < swidth && (lasty - sy) > sheight) { 
			 						thap.css("border-bottom",0);
			 						tharsub.css("left",-265);
			 					}
			 					if((lastx - sx) > swidth && (lasty - sy) > sheight) { 
			 						thap.css("border-bottom",0);
			 						tharsub.css("left",0); 
			 					}
			 					if((lastx - sx) < swidth && (lasty - sy) < sheight) { 
				 					thap.css({
				 						"border-top": '0px',
				 						"border-bottom": ''
				 					});
			 						tharsub.css("left",-265); 
				 					tharsub.css("top",-(sheight - 2));
			 					}
			 					if((lastx - sx) > swidth && (lasty - sy) < sheight) { 
				 					thap.css({
				 						"border-top": '0px',
				 						"border-bottom": ''
				 					});
			 						tharsub.css("left",0); 
				 					tharsub.css("top",-(sheight - 2));
			 					}
			 					tharsub.show();
			 				} else {
			 					that.find('a').css("color","#f77d40");
			 				}
					    },
					    outEvent: function(){
			                if(that.find('.subcate').length > 0) {
				 				that.removeClass('selected');
				 				that.find('.subcate').hide();
			 				} else {
			 					that.find('a').css("color","#0180cf");
			 				}    
			            }
					});
	 			});
		    },
		    outEvent: function(){
                $("#divJobCate").hide(); 
            }
		});
 		// ��ʾ����
		/*
		$("#jobsCity").hover(function(){
			$("#divCityCate").show();
			$("#divCityCate li").hover(function(){
				$(this).addClass('selected').children('a').css("color","#f77d40");
				$(this).children(".subcate").show();
			},function(){
				$(this).removeClass('selected').children('a').css("color","#0180cf");;
				$(this).children(".subcate").hide();
			})
		})
		*/
		
 		$("#jobsCity").hoverDelay({
		    hoverEvent: function(){
		        $("#divCityCate").show();
		        var dx = $("#divCityCate").offset().left; // ��ȡ�������x����
		        var dwidth = $("#divCityCate").outerWidth(true); // ��ȡ������Ŀ��
		        var lastx = dx + dwidth; // ���ϵ�����Ŀ�Ȼ�ȡ���������ұߵ�x����
	 			$("#divCityCate li").each(function(index, el) {
	 				var that = $(this);
	 				var sx = that.offset().left; // ��ȡ��ǰli��x����
	 				that.hoverDelay({
					    hoverEvent: function(){
					        if(that.children('.subcate').length > 0) {
			 					that.addClass('selected');
			 					var tharsub = that.children('.subcate');
			 					var thap = that.children('p');
			 					thap.css("border-bottom","0px");
								that.children('a').css("color","#f77d40");
			 					var swidth = tharsub.outerWidth(true); // ��ȡ����������Ŀ��
			 					if((lastx - sx) < swidth) { // �ж�li�뵯�������ұߵľ����Ƿ��������������Ŀ��
			 						tharsub.css("left",-265); // ���С�ھ͸ı�����������x�����λ��
			 					}
			 					tharsub.show();
			 				} else {
			 					that.children('a').css("color","#f77d40");
			 				}
					    },
					    outEvent: function(){
			                if(that.children('.subcate').length > 0) {
								that.children('a').css("color","#0180cf");
				 				that.removeClass('selected');
				 				that.children('.subcate').hide();
			 				} else {
			 					that.children('a').css("color","#0180cf");
			 				}    
			            }
					});
	 			});
		    },
		    outEvent: function(){
                $("#divCityCate").hide(); 
            }
		});
		

 		$("#infolists .list:last").css("border-bottom","none");
		//apply_jobs("/");
		//favorites("/");
	});
</script>
</head>
<body>

<SCRIPT> 
function baoming(){ 
document.getElementById("mianfei").style.display="none"; 
} 
</SCRIPT> 
<!--<div id="mianfei"> 
    <div class="fei01">
    <span>û���ҵ����ʵĹ�����</span>
    <a class="baoming" href="#">1����������Ϣ <i class="fa fa-arrow-circle-right"></i></a>
    <span>���ǻὫ���Ƽ���������ҵ�����Ⱥù��������㣡</span>
    <a class="guanbi" onClick=baoming() >X</a>
    </div>
    
</div>
-->	

	<!--ͷ����ʼ-->
	<script>
	$(function(){
		// ����¼�
		$(".local_station").live("click",function(){
			if($(".sub_station").attr('data') == "hide") {
				$(this).blur();
				$(this).parent().parent().before("<div class=\"menu_bg_layer\"></div>");
				$(".menu_bg_layer").height($(document).height());
				$(".menu_bg_layer").css({ width: $(document).width(), position: "absolute",left:"0", top:"0","z-index":"77","background-color":"#000000"});
				$(".menu_bg_layer").css("opacity",0);
				$(".sub_station").show();
				$(".sub_station").attr('data',"show");
				$(".menu_bg_layer, .station_close").click(function() {
					$(".sub_station").hide();
					$(".sub_station").attr('data',"hide");
					$(".menu_bg_layer").remove();
				});
			} else {
				$(".sub_station").hide();
				$(".sub_station").attr('data',"hide");
			}
		});
		//�����б�ɫ
		$(".local_station>p").hover(function(){
			$(this).addClass("hover");
		},function(){
			$(this).removeClass("hover");
		});
		$(".sub_st_content li:last").css({
			"border-bottom":"0"
		}).find("div").css({"padding-bottom":"0"});
	});
//��������¼
$.get("/plus/ajax_user.php", {"act":"top_loginform"},
function (data,textStatus)
{			
$(".top_nav").html(data);
}
);
</script>
<!--����-->
<!--<div class="user_top_nav" >
	<div class="main">
	    <div class="ltit"><span id="top_loginform"></span></div>	
	    <div class="rlink link_lan">
	    	<a href="http://www.1dagong.com/mobile/" class="mphone">�ֻ�Ƶ��</a>
<a href="http://www.1dagong.com/salary">н��ͳ��</a>
<a href="/">��վ��ҳ</a>
<a href="/plus/shortcut.php">���浽����</a>
<script type="text/javascript">
//��������¼
$.get("/plus/ajax_user.php", {"act":"top_loginform"},
function (data,textStatus)
{			
$("#top_loginform").html(data);
}
);
</script>	    </div>	
	    <div class="clear"></div>
    </div>
</div>-->
<!--ͷ����ʼ-->
	<div class="header">
    	<div class="kuang">
            <div class="logo fl">
            <a class="fl" href="/"><img src="/files/img/logo.png" alt="" title="Ҽ����" ></a>
            
            <!--��ʿ�ϵĵ����л���ʼzzzzzz-->
		
								  <div class="sub_station_bbox">
            <div class="local_station didian">
                <h3>����</h3>
                <a>�л�վ��</a>
            </div>

	  	          
            <div class="sub_station" style="display:none;" data="hide">
                <div class="triangle"></div>
                <span href="" class="station_close"></span>
                <div class="sub_st_box">
                    <div class="sub_st_tit">
                        <h3>�Ϸ��˲��� - �Ϸ�Ҽ����վȺ</h3>
                    </div>
                    <div class="sub_st_content">
                        <ul>
                            
                                                            <li>
                                  <div class="city_list">
                                  			<a href="http://www.1dagong.com/index.html">��վ</a>
                                                                                        <a href="http://hefei.1dagong.com/index.html">����</a>
                                                                                        <a href="http://chongqing.1dagong.com/index.html">����</a>
                                                                                        <a href="http://zhengzhou.1dagong.com/index.html">����</a>
                                                                                        <a href="http://wuhan.1dagong.com/index.html">����</a>
                                                                                        <a href="http://shanghai.1dagong.com/index.html">�Ϻ�</a>
                                                                                        <a href="http://suzhou.1dagong.com/index.html">����</a>
                                                                                            <div class="clear"></div>
                                            <div>
                                </li>	
                                                    </ul>
                    </div>
                </div>
            </div>	
        </div>
					<!--��ʿ�ϵĵ����л�����-->
            
            </div>
            	<!--<div class="didian fl">
                	<p>�Ϸ�</p>
                	<a href="#">�л�����</a>
                </div>-->
                
				

            <div class="nav fl">
            	<ul>
				<!--�����˵��л�����ʽ��λ��ʼ By Z-->
				<!--
					<li><a class="yes" href="/">��ҳ</a></li>
                    <li><a href="/jobs/jobs-list2.php">�ҹ���</a></li>
                    <li><a href="/resume/resume-list.php">���˲�</a></li>
                    <li><a href="/hymq/">��ҵ����</a></li>
                    <li><a href="/jobfair/jobfair-list.php">��Ƹ��</a></li>
                    <li><a href="/xiaoyuan/">У԰��Ƹ</a></li>
				-->
													<li><a href="http://hefei.1dagong.com/index.html" target="_self" >��  ҳ</a></li>
									<li><a href="http://hefei.1dagong.com/zhaopin/index.html" target="_self" class="yes">�ҹ���</a></li>
									<li><a href="http://hefei.1dagong.com/jianli.html" target="_self" >���˲�</a></li>
									<li><a href="http://hefei.1dagong.com/hymq/index.php" target="_self" >��ҵ����</a></li>
									<li><a href="http://hefei.1dagong.com/jobfair/jobfair-list.php" target="_self" >�˲��г�</a></li>
									<li><a href="http://hefei.1dagong.com/xiaoyuan/" target="_self" >У԰��Ƹ</a></li>
									<li><a href="http://hefei.1dagong.com/train/" target="_self" >������ѵ</a></li>
								<!--�����˵��л�����ʽ��λ���� By Z-->
                </ul>
            </div>
            
            <div class="top_nav">
            </div>
            
        </div>
    </div>
    <!--ͷ������-->
<!--ͷ������-->


<!--<div class="page_location link_bk">
��ǰλ�ã�<a href="/">��ҳ</a>&nbsp;>>&nbsp;<a href="http://hefei.1dagong.com/zhaopin/index.html">��Ƹ��Ϣ</a>
</div>
-->
<script type="text/javascript">
	var getstr=",,,,,,,,,,";
	var defaultkey="������ְλ���ơ���˾���ƹؼ���...";
	var getkey="";
	if (getkey=='')
	{
	getkey=defaultkey;
	}
	allaround('/files/','/','http://hefei.1dagong.com/jobs/jobs-list.php',getkey,getstr);
</script>     
<div class="jobsearch">
<!--	 <div class="jobnav">
	 	<a href="http://hefei.1dagong.com/jobs/jobs-list.php" class="select">ȫ������</a>
		<a href="http://hefei.1dagong.com/jobs/jobtag-search.php" >��ǩ����</a>
	 </div>
-->     
	 <div class="jobmain" id="searckeybox">
     	<div class="fl gjc" style="margin:0px;">��  ��  ��</div>
	 	<div class="keybox">
	 		<input type="text" id="searckey" name="key" data="" value="������ؼ���" />
	 		<input type="hidden" value="" name="wage">
	 		<input type="hidden" value="" name="education">
	 		<input type="hidden" value="" name="experience">
	 		<input type="hidden" value="" name="nature">
	 		<input type="hidden" value="" name="settr">
	 		<input type="hidden" value="" name="sort">
	 		<input type="hidden" value="1" name="page">
	 	</div>
     	<div class="over"></div>
            <div class="fl gjc">ְ&nbsp;&nbsp;&nbsp;&nbsp;λ</div>
	 	<div class="box jobsSort" id="jobsSort">
	 		<div class="itemT">
	 			<span id="jobText">&nbsp;</span><i class="fa fa-plus-square"></i>
	 		</div>
	 		<div style="display:none;" id="divJobCate" class="divJobCate">
	 			<table class="jobcatebox">
	 				<div class="acquired">
		 				<div class="l">��ѡ</div>
		 				<div class="c" id="jobAcq"></div>
		 				<div class="r">
		 					<div class="empty" id="jobEmpty"></div>
		 					<div class="sure" id="jobSure">ȷ��</div>
		 					<div class="container" id="jobdropcontent">
								<div class="content">����ѡ���Ѵ����ޣ�5�<br>������ȷ���������Ƴ�����ѡ��</div>
								<s><e></e></s>
							</div>
		 				</div>
		 			</div>
	 				<tbody></tbody>
	 			</table>
	 		</div>
	 		<input name="jobs_cn" id="jobs_cn" type="hidden" value="" />
			<input name="jobs_id" id="jobs_id" type="hidden" value="" />
	 	</div>
            <div class="fl gjc">��&nbsp;&nbsp;&nbsp;&nbsp;ҵ</div>
	 	<div class="box jobsSort" id="jobsTrad">
	 		<div class="itemT">
	 			<span id="tradText">&nbsp;</span><i class="fa fa-plus-square"></i>
	 		</div>
	 		<div id="divTradCate" class="infoList divIndCate" style="display:none">
	 			<div class="acquired">
	 				<div class="l">��ѡ</div>
	 				<div class="c" id="tradAcq"></div>
	 				<div class="r">
	 					<div class="empty" id="tradEmpty"></div>
	 					<div class="sure" id="tradSure">ȷ��</div>
	 					<div class="container" id="tradropcontent">
							<div class="content">����ѡ���Ѵ����ޣ�5�<br>������ȷ���������Ƴ�����ѡ��</div>
							<s><e></e></s>
						</div>
	 				</div>
	 			</div>
	 			<ul class="indcatelist" id="tradList"></ul>
	 		</div>
	 		<input name="trade_cn" id="trade_cn" type="hidden" value="" />
			<input name="trade_id" id="trade_id" type="hidden" value="" />
	 	</div>
        <div class="over"></div>
            <div class="fl gjc">��&nbsp;&nbsp;&nbsp;&nbsp;��</div>
	 	<div class="box" id="jobsCity">
	 		<div class="itemT">
	 			<span id="cityText">&nbsp;</span><i class="fa fa-plus-square"></i>
	 		</div>
	 		<div style="display:none;left:0px;" id="divCityCate" class="divJobCate">
	 			<table class="jobcatebox citycatebox">
	 				<div class="acquired">
		 				<div class="l">��ѡ</div>
		 				<div class="c" id="cityAcq"></div>
		 				<div class="r">
		 					<div class="empty" id="cityEmpty"></div>
		 					<div class="sure" id="citySure">ȷ��</div>
		 					<div class="container" id="citydropcontent">
								<div class="content">����ѡ���Ѵ����ޣ�5�<br>������ȷ���������Ƴ�����ѡ��</div>
								<s><e></e></s>
							</div>
		 				</div>
		 			</div>
	 				<tbody></tbody>
	 			</table>
	 		</div>
            <input id="district_id" type="hidden" value="" name="district_id">
            <input id="district_cn" type="hidden" value="" name="district_cn"/>
	 	</div>
        <div class="hdns"></div>
        <div class="sousuo">

            <div class="btnsearch" id="btnsearch" ty="QS_jobslist">�� ��</div>
            <a class="more" id="showmoreoption" href="javascript:;"><span>��������</span><i></i></a>
        </div>
        
	 </div>
</div>
		<script src="http://www.1dagong.com/templates/1jobsnew/js/jquery.autocomplete.js" type="text/javascript"></script>
					<script language="javascript" type="text/javascript">
					 $(document).ready(function()
					{
						  var a = $('#searckey').autocomplete({ 
							serviceUrl:'plus/ajax_common.php?act=hotword',
							minChars:1, 
							maxHeight:400,
							width:371,
							zIndex: 1,
							deferRequestBy: 0 
						  });
					
					});
					  </script>
<div class="searoptions" id="searoptions" style="display:block;">
	<div class="list"><div class="tit">�������ʣ�</div><div class="option" id="jobsnature"></div></div>
	<div class="list"><div class="tit">ְλ��н��</div><div class="option" id="jobswage"></div></div>
	<div class="list"><div class="tit">ѧ��Ҫ��</div><div class="option" id="jobseducation"></div></div>
	<div class="list"><div class="tit">�������飺</div><div class="option" id="jobsexperience"></div></div>
	<div class="list">
		<div class="tit">����ʱ�䣺</div>
		<div class="option" id="jobsuptime">
			<a href="javascript:;" class="opt" id="settr-3">3����</a>
			<a href="javascript:;" class="opt" id="settr-7">7����</a>
			<a href="javascript:;" class="opt" id="settr-15">15����</a>
			<a href="javascript:;" class="opt" id="settr-30">30����</a>
		</div>
	</div>
</div>
<div class="jobselected" id="jobselected">
	<div class="tit">��ѡ������</div>
	<div class="showselected" id="showselected"></div>
	<div class="clearjobs" id="clearallopt">�����ѡ��</div>
	<div class="clear"></div>
</div>
<!-- ְλ�б� -->


<div class="kuang over">
	<div class="left_list">
        <div class="fine">	
            <span class="fl">��Ϊ���ҵ� <strong>611</strong> ְλ </span>
            <div class="hehe fr">
            	<!--<a href="http://hefei.1dagong.com/jobs/jobs-list.php?sort=rtime&page=1&category=&subclass=&district=&sdistrict=&mdistrict=&settr=&trade=&wage=&nature=&scale=&inforow=" >����ʱ��<i class="fa fa-long-arrow-down"></i></a>-->
                <a href="http://hefei.1dagong.com/jobs/jobs-list.php?sort=wage&page=1&category=&subclass=&district=&sdistrict=&mdistrict=&settr=&trade=&wage=&nature=&scale=&inforow=" >н�ʴ���<i class="fa fa-long-arrow-down"></i></a>
                <a href="http://hefei.1dagong.com/jobs/jobs-list.php?sort=hot&page=1&category=&subclass=&district=&sdistrict=&mdistrict=&settr=&trade=&wage=&nature=&scale=&inforow=">�ȶ�<i class="fa fa-long-arrow-down"></i></a>
            </div> 
        </div> 
               
        <ul class="l_list">
		
			            <li>
                <a href="http://hefei.1dagong.com/zhaopin/zhiwei_7303.html" >
                    <h3>װ�乤</h3>
                    <dl>
                        <dt>�Ϸ�Ԫ�������ƶ�ϵͳ��...</dt>
                        <dd class="ls01">����ʡ/�Ϸ���</dd>
                        <dd class="ls02"><span style="color:#FF3300">1Сʱǰ</span></dd>
                        <dd class="ls03">��н<font>3000~5000Ԫ/��</font></dd>
                    </dl>        
                </a>
                <div class="fr hidns" id="infolists">
                    <a class="shouc add_favorites" href="javascript:void(0);" id="7303"><i class="fa fa-heart"></i>&nbsp;�ղ�</a>
                    <a class="touti app_jobs" href="javascript:void(0);" id="7303">Ͷ�ݼ���</a>
                </div>
            </li>
			            <li>
                <a href="http://hefei.1dagong.com/zhaopin/zhiwei_7298.html" >
                    <h3>��������רԱ</h3>
                    <dl>
                        <dt>�������Ͷ�ʹ������޹�...</dt>
                        <dd class="ls01">����ʡ/�Ϸ���</dd>
                        <dd class="ls02"><span style="color:#FF3300">6Сʱǰ</span></dd>
                        <dd class="ls03">��н<font>3000~5000Ԫ/��</font></dd>
                    </dl>        
                </a>
                <div class="fr hidns" id="infolists">
                    <a class="shouc add_favorites" href="javascript:void(0);" id="7298"><i class="fa fa-heart"></i>&nbsp;�ղ�</a>
                    <a class="touti app_jobs" href="javascript:void(0);" id="7298">Ͷ�ݼ���</a>
                </div>
            </li>
			            <li>
                <a href="http://hefei.1dagong.com/zhaopin/zhiwei_7297.html" >
                    <h3>������ѵ��</h3>
                    <dl>
                        <dt>�������Ͷ�ʹ������޹�...</dt>
                        <dd class="ls01">����ʡ/�Ϸ���</dd>
                        <dd class="ls02"><span style="color:#FF3300">6Сʱǰ</span></dd>
                        <dd class="ls03">��н<font>2000~3000Ԫ/��</font></dd>
                    </dl>        
                </a>
                <div class="fr hidns" id="infolists">
                    <a class="shouc add_favorites" href="javascript:void(0);" id="7297"><i class="fa fa-heart"></i>&nbsp;�ղ�</a>
                    <a class="touti app_jobs" href="javascript:void(0);" id="7297">Ͷ�ݼ���</a>
                </div>
            </li>
			            <li>
                <a href="http://hefei.1dagong.com/zhaopin/zhiwei_7291.html" >
                    <h3>����</h3>
                    <dl>
                        <dt>�����Դ�����������޹�...</dt>
                        <dd class="ls01">����ʡ/�Ϸ���</dd>
                        <dd class="ls02"><span style="color:#FF3300">2��ǰ</span></dd>
                        <dd class="ls03">��н<font>3000~5000Ԫ/��</font></dd>
                    </dl>        
                </a>
                <div class="fr hidns" id="infolists">
                    <a class="shouc add_favorites" href="javascript:void(0);" id="7291"><i class="fa fa-heart"></i>&nbsp;�ղ�</a>
                    <a class="touti app_jobs" href="javascript:void(0);" id="7291">Ͷ�ݼ���</a>
                </div>
            </li>
			            <li>
                <a href="http://hefei.1dagong.com/zhaopin/zhiwei_7285.html" >
                    <h3>������</h3>
                    <dl>
                        <dt>�Ϸ��źͻ�е�Ƽ����޹�...</dt>
                        <dd class="ls01">����ʡ/�Ϸ���</dd>
                        <dd class="ls02"><span style="color:#FF3300">3��ǰ</span></dd>
                        <dd class="ls03">��н<font>2000~3000Ԫ/��</font></dd>
                    </dl>        
                </a>
                <div class="fr hidns" id="infolists">
                    <a class="shouc add_favorites" href="javascript:void(0);" id="7285"><i class="fa fa-heart"></i>&nbsp;�ղ�</a>
                    <a class="touti app_jobs" href="javascript:void(0);" id="7285">Ͷ�ݼ���</a>
                </div>
            </li>
			            <li>
                <a href="http://hefei.1dagong.com/zhaopin/zhiwei_7286.html" >
                    <h3>�ͷ���Ա</h3>
                    <dl>
                        <dt>�����ο��Ƶ�������ɷ�...</dt>
                        <dd class="ls01">����ʡ</dd>
                        <dd class="ls02"><span style="color:#FF3300">3��ǰ</span></dd>
                        <dd class="ls03">��н<font>3000~5000Ԫ/��</font></dd>
                    </dl>        
                </a>
                <div class="fr hidns" id="infolists">
                    <a class="shouc add_favorites" href="javascript:void(0);" id="7286"><i class="fa fa-heart"></i>&nbsp;�ղ�</a>
                    <a class="touti app_jobs" href="javascript:void(0);" id="7286">Ͷ�ݼ���</a>
                </div>
            </li>
			            <li>
                <a href="http://hefei.1dagong.com/zhaopin/zhiwei_7280.html" >
                    <h3>Ͷ�ʹ���</h3>
                    <dl>
                        <dt>���ս�ʵ�ʲ��������޹�...</dt>
                        <dd class="ls01">����ʡ</dd>
                        <dd class="ls02"><span style="color:#FF3300">3��ǰ</span></dd>
                        <dd class="ls03">��н<font>3000~5000Ԫ/��</font></dd>
                    </dl>        
                </a>
                <div class="fr hidns" id="infolists">
                    <a class="shouc add_favorites" href="javascript:void(0);" id="7280"><i class="fa fa-heart"></i>&nbsp;�ղ�</a>
                    <a class="touti app_jobs" href="javascript:void(0);" id="7280">Ͷ�ݼ���</a>
                </div>
            </li>
			            <li>
                <a href="http://hefei.1dagong.com/zhaopin/zhiwei_7275.html" >
                    <h3>����</h3>
                    <dl>
                        <dt>�Ϸ��װƷ��ز���������...</dt>
                        <dd class="ls01">����ʡ/�Ϸ���</dd>
                        <dd class="ls02"><span style="color:#FF3300">3��ǰ</span></dd>
                        <dd class="ls03">��н<font>����</font></dd>
                    </dl>        
                </a>
                <div class="fr hidns" id="infolists">
                    <a class="shouc add_favorites" href="javascript:void(0);" id="7275"><i class="fa fa-heart"></i>&nbsp;�ղ�</a>
                    <a class="touti app_jobs" href="javascript:void(0);" id="7275">Ͷ�ݼ���</a>
                </div>
            </li>
			            <li>
                <a href="http://hefei.1dagong.com/zhaopin/zhiwei_7273.html" >
                    <h3>����</h3>
                    <dl>
                        <dt>�Ϸ��װƷ��ز���������...</dt>
                        <dd class="ls01">����ʡ/�Ϸ���</dd>
                        <dd class="ls02"><span style="color:#FF3300">3��ǰ</span></dd>
                        <dd class="ls03">��н<font>����</font></dd>
                    </dl>        
                </a>
                <div class="fr hidns" id="infolists">
                    <a class="shouc add_favorites" href="javascript:void(0);" id="7273"><i class="fa fa-heart"></i>&nbsp;�ղ�</a>
                    <a class="touti app_jobs" href="javascript:void(0);" id="7273">Ͷ�ݼ���</a>
                </div>
            </li>
			            <li>
                <a href="http://hefei.1dagong.com/zhaopin/zhiwei_7274.html" >
                    <h3>����</h3>
                    <dl>
                        <dt>���ȲƸ���������Ͷ�ʹ�...</dt>
                        <dd class="ls01">����ʡ/�Ϸ���</dd>
                        <dd class="ls02"><span style="color:#FF3300">3��ǰ</span></dd>
                        <dd class="ls03">��н<font>2000~3000Ԫ/��</font></dd>
                    </dl>        
                </a>
                <div class="fr hidns" id="infolists">
                    <a class="shouc add_favorites" href="javascript:void(0);" id="7274"><i class="fa fa-heart"></i>&nbsp;�ղ�</a>
                    <a class="touti app_jobs" href="javascript:void(0);" id="7274">Ͷ�ݼ���</a>
                </div>
            </li>
			        </ul>
        
<table border="0" align="center" cellpadding="0" cellspacing="0" class="link_bk">
          <tr>
                        <td><div class="page link_bk"><li><a class="">��ҳ</a></li><li><a class="">��һҳ</a></li><li><a class="select">1</a></li>
<li><a  href="http://hefei.1dagong.com/jobs/jobs-list.php?district_cn=����&page=2">2</a></li>
<li><a  href="http://hefei.1dagong.com/jobs/jobs-list.php?district_cn=����&page=3">3</a></li>
<li><a  href="http://hefei.1dagong.com/jobs/jobs-list.php?district_cn=����&page=4">4</a></li>
<li><a  href="http://hefei.1dagong.com/jobs/jobs-list.php?district_cn=����&page=5">5</a></li>
<li><a  href="http://hefei.1dagong.com/jobs/jobs-list.php?district_cn=����&page=6">6</a></li>
<li><a  href="http://hefei.1dagong.com/jobs/jobs-list.php?district_cn=����&page=2">��һҳ</a></li><li><a  href="http://hefei.1dagong.com/jobs/jobs-list.php?district_cn=����&page=62">βҳ</a></li><li class="page_all">1/62ҳ</li><div class="clear"></div></div></td>
                    </tr>
      </table>    </div>
    
    <div class="right_list">
    	<div class="ewma">
        	<img src="/files/img/app.jpg" title="Ҽ�����ͻ���"  />
            ɨ���ά�룬�ֻ������ҹ���
        </div>
        
        <div class="rzhao">
        	<h2>������Ƹְλ</h2>
            
            <ul class="rzlist">
						            	<li>
                	<h3><a href="http://hefei.1dagong.com/zhaopin/zhiwei_7303.html">װ�乤</a></h3>
                    <p>�Ϸ�Ԫ�������ƶ�ϵͳ���޹�˾</p>
                    <font>��н��Χ��3000~5000Ԫ/��</font>
                </li>
			            	<li>
                	<h3><a href="http://hefei.1dagong.com/zhaopin/zhiwei_7298.html">��������רԱ</a></h3>
                    <p>�������Ͷ�ʹ������޹�˾</p>
                    <font>��н��Χ��3000~5000Ԫ/��</font>
                </li>
			            	<li>
                	<h3><a href="http://hefei.1dagong.com/zhaopin/zhiwei_7297.html">������ѵ��</a></h3>
                    <p>�������Ͷ�ʹ������޹�˾</p>
                    <font>��н��Χ��2000~3000Ԫ/��</font>
                </li>
			            	<li>
                	<h3><a href="http://hefei.1dagong.com/zhaopin/zhiwei_7291.html">����</a></h3>
                    <p>�����Դ�����������޹�˾</p>
                    <font>��н��Χ��3000~5000Ԫ/��</font>
                </li>
			            	<li>
                	<h3><a href="http://hefei.1dagong.com/zhaopin/zhiwei_7286.html">�ͷ���Ա</a></h3>
                    <p>�����ο��Ƶ�������ɷ����޹�˾</p>
                    <font>��н��Χ��3000~5000Ԫ/��</font>
                </li>
			            	<li>
                	<h3><a href="http://hefei.1dagong.com/zhaopin/zhiwei_7285.html">������</a></h3>
                    <p>�Ϸ��źͻ�е�Ƽ����޹�˾</p>
                    <font>��н��Χ��2000~3000Ԫ/��</font>
                </li>
			            </ul>
        </div>
    </div>
</div>



<script src="/files/js/jquery.jobs-list.js" type='text/javascript' ></script>

    
<!--�ײ���ʼ-->
	
<div class="footer over">
    	<div class="footer-con kuang">
        	<div class="fl">
            	<a href="http://www.1dagong.com"><img src="/files/img/footer_logo.jpg" title="Ҽ����" /></a>
            </div>
            <div class="fr appewm"><img src="/files/img/app.jpg" height="100" width="100" alt="" title="Ҽ�����ͻ���" /></div> 
            <div class="fr copy">
            	<div class="footer-nav">
                    <a href="#">��������</a>
                	<a href="#">�û�����</a>
                    <a href="http://www.1dagong.com/zt/app/">�ֻ��ͻ���</a>
                    <a href="#">��������</a>
                </div>
                <div class="over"></div>
                <div class="icp">
                	 &copy;2013-2015 Www.1dagong.Com &nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp; ���ҹ�ҵ����Ϣ���������ţ���ICP��13015030��-4
                </div>
                <div class="over"></div>
                <div class="zuic">
                	רҵ����ְ��Ƹ��վ�����������˲�����һƷ�ƣ�
                </div>
            </div>
            
        </div>    
    </div>
<!-- �ص�������� -->
<!--<div class="back_to_top" id="back_to_top">
	<div class="back" style="display:none;">
		<div>�ص�����</div>
	</div>
	<div class="steer">
		<div onclick="javascript:location.href='http://www.1dagong.com/suggest'">��Ҫ����</div>
	</div>
	<div class="sub">
		<div onclick="javascript:location.href='http://www.1dagong.com/subscribe'">��Ҫ����</div>
	</div>
</div>-->
<script>
	$(function(){
		//�ص����������������
		$(window).scroll(function(){
			if($(window).scrollTop()>200){
				$(".back").fadeIn(400);
			}else{
				$(".back").fadeOut(400);
			}
		})

		//�ص�����hoverЧ��
		$(".back_to_top .back, .steer, .sub").hover(function(){
			$(this).find("div").css("display","block");
		},function(){
			$(this).find("div").css("display","none");
		})

		//���ù��ض�������
		$(".back").click(function(){
			$("body,html").animate({scrollTop:0}, 500);
			return false;
		})
	});
	$(function(){
		$(".foot_list ul:odd li").css("width", 62);
		$(".weixin_img:last").css("margin-right", 0);
	})
	
//β����ʾʱ��
/*$.get("/plus/ajax_user.php", {"act":"bottom_date_up"},
function (data,textStatus)
{
	//alert(data);			
$(".date_up").html(data);
}
);*/
</script>

<!--�ײ�����-->

</body>
</html>