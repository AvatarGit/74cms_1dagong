<?php require_once('D:\fengmf\wwwroot\74cms_1dagong\include\template_lite\plugins\function.qishi_link.php'); $this->register_function("qishi_link", "tpl_function_qishi_link",false);  require_once('D:\fengmf\wwwroot\74cms_1dagong\include\template_lite\plugins\function.qishi_hymq_jobs_list.php'); $this->register_function("qishi_hymq_jobs_list", "tpl_function_qishi_hymq_jobs_list",false);  require_once('D:\fengmf\wwwroot\74cms_1dagong\include\template_lite\plugins\modifier.date_format.php'); $this->register_modifier("date_format", "tpl_modifier_date_format",false);  require_once('D:\fengmf\wwwroot\74cms_1dagong\include\template_lite\plugins\function.qishi_jobfair_list.php'); $this->register_function("qishi_jobfair_list", "tpl_function_qishi_jobfair_list",false);  require_once('D:\fengmf\wwwroot\74cms_1dagong\include\template_lite\plugins\function.qishi_companyjobs_list.php'); $this->register_function("qishi_companyjobs_list", "tpl_function_qishi_companyjobs_list",false);  require_once('D:\fengmf\wwwroot\74cms_1dagong\include\template_lite\plugins\function.qishi_jobs_list.php'); $this->register_function("qishi_jobs_list", "tpl_function_qishi_jobs_list",false);  require_once('D:\fengmf\wwwroot\74cms_1dagong\include\template_lite\plugins\function.qishi_ad.php'); $this->register_function("qishi_ad", "tpl_function_qishi_ad",false);  require_once('D:\fengmf\wwwroot\74cms_1dagong\include\template_lite\plugins\function.qishi_get_classify.php'); $this->register_function("qishi_get_classify", "tpl_function_qishi_get_classify",false);  require_once('D:\fengmf\wwwroot\74cms_1dagong\include\template_lite\plugins\modifier.qishi_url.php'); $this->register_modifier("qishi_url", "tpl_modifier_qishi_url",false);  require_once('D:\fengmf\wwwroot\74cms_1dagong\include\template_lite\plugins\modifier.cat.php'); $this->register_modifier("cat", "tpl_modifier_cat",false);  require_once('D:\fengmf\wwwroot\74cms_1dagong\include\template_lite\plugins\function.qishi_hotword.php'); $this->register_function("qishi_hotword", "tpl_function_qishi_hotword",false);  require_once('D:\fengmf\wwwroot\74cms_1dagong\include\template_lite\plugins\function.qishi_notice_list.php'); $this->register_function("qishi_notice_list", "tpl_function_qishi_notice_list",false);  require_once('D:\fengmf\wwwroot\74cms_1dagong\include\template_lite\plugins\modifier.default.php'); $this->register_modifier("default", "tpl_modifier_default",false);  require_once('D:\fengmf\wwwroot\74cms_1dagong\include\template_lite\plugins\function.qishi_pageinfo.php'); $this->register_function("qishi_pageinfo", "tpl_function_qishi_pageinfo",false);  /* V2.10 Template Lite 4 January 2007  (c) 2005-2007 Mark Dickenson. All rights reserved. Released LGPL. 2018-07-09 15:14 �й���׼ʱ�� */ ?>
<!DOCTYPE html>
<html>
<head>
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=gb2312" /><?php echo tpl_function_qishi_pageinfo(array('set' => "�б���:page,����:QS_index"), $this);?>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="Cache-Control" content="no-transform" />
	<meta http-equiv="Cache-Control" content="no-siteapp" />
	<title><?php echo $this->_run_modifier($this->_vars['QISHI']['subsite_districtname'], 'default', 'plugin', 1, ""); ?>
Ҽ���� - �ù���������</title>
	<meta name="keywords" content="<?php echo $this->_run_modifier($this->_vars['QISHI']['subsite_districtname'], 'default', 'plugin', 1, ''); ?>
������<?php echo $this->_run_modifier($this->_vars['QISHI']['subsite_districtname'], 'default', 'plugin', 1, ''); ?>
��ְ��Ϣ��<?php echo $this->_run_modifier($this->_vars['QISHI']['subsite_districtname'], 'default', 'plugin', 1, ''); ?>
��Ƹ����Ϣ��" />
	<meta name="description" content="Ҽ����<?php echo $this->_run_modifier($this->_vars['QISHI']['subsite_districtname'], 'default', 'plugin', 1, '��'); ?>
վ���㼯�����й�����ְ����Ƹ����Ϣ��Ҽ��2015��Ƹ�ᣬ�ṩ�й���Ϣ�ͼ�ְ��Ƹ�������Ϊ���ҹ�������ҵ��Ƹ�й��������ҹ����Ҽ�ְ������Ҽ������" />
    <link rel="shortcut icon" href="favicon.ico" />
	<!-- css -->
	<link href="/files/css/font-awesome.min.css" rel="stylesheet" >
    <link href="/files/css/common.css" rel="stylesheet" type="text/css" />
    <link href="/files/css/all.css" rel="stylesheet" type="text/css" />
    <link href="/files/css/header-footer.css" rel="stylesheet" type="text/css" />
    <script language="javascript" type="text/javascript" src="/files/js/jquery.min.js"></script>
    <script language="javascript" type="text/javascript" src="/files/js/jquery.SuperSlide.2.1.1.js"></script>
    <script language="javascript" type="text/javascript" src="/files/js/lrtk.js"></script>
    <script language="javascript" type="text/javascript" src="/files/js/divselect.js"></script>
    <!--#############################################zzzzzzzzz####################################-->
	<script src="/files/js/jquery.jobs-search-shouye.js" type='text/javascript'></script>
    
    <!--<script src="/files/js/jquery.js" type="text/javascript" language="javascript"></script>-->
    <script src="/files/js/jquery.lazyload.js" type="text/javascript"></script>
    <script src="/data/cache_classify.js" type='text/javascript' charset="utf-8"></script>
    <script src="/files/js/jquery.KinSlideshow.min.js" type="text/javascript"></script>
    <!--�в��˵���ʾ-->
    <script src="/files/js/jquery.comtip-min.js" type="text/javascript"></script>
    
    <script src="/files/js/jquery.index.js" type='text/javascript' ></script>
    <!--<script src="/files/js/floatAd.js" type='text/javascript' ></script>-->
    <link  href="/files/css/new.css" rel="stylesheet" type="text/css"/>
    
    
    
<!--------------����б�-------------->
   <script>
$(document).ready(function()
{
	index("/","/files/");
	get_right_menu(QS_jobs);
});
$(function(){
	$(".ad_box .ad_img:eq(3)").css("margin-right", 0);
	$(".leftMenu li,.leftmenu_box").hover(function(){
		$(this).addClass("hover");
		$(this).find(".category").stop().animate({
			"position":"relative",
			"left":10
		},200);
		$(".leftMenu li").siblings("li").css("border-right-color","#ffffff");
		
	},function(){
		$(this).removeClass("hover");
		$(this).find(".category").stop().animate({
			"position":"relative",
			"left":0
		},200);
		$(".leftMenu li").siblings("li").css("border-right-color","#CCC");
	});
	
}) 
</script>

<!---     ������ҵͼƬ����        --->
<script type="text/javascript">

			//ͼƬ���� ���÷��� imgscroll({speed: 30,amount: 1,dir: "up"});
			$.fn.imgscroll = function(o){
				var defaults = {
					speed: 40,
					amount: 0,
					width: 1,
					dir: "left"
				};
				o = $.extend(defaults, o);
				
				return this.each(function(){
					var _li = $("li", this);
					_li.parent().parent().css({overflow: "hidden", position: "relative"}); //div
					_li.parent().css({margin: "0", padding: "0", overflow: "hidden", position: "relative", "list-style": "none"}); //ul
					_li.css({position: "relative", overflow: "hidden"}); //li
					if(o.dir == "left") _li.css({float: "left"});
					
					//��ʼ��С
					var _li_size = 0;
					for(var i=0; i<_li.size(); i++)
						_li_size += o.dir == "left" ? _li.eq(i).outerWidth(true) : _li.eq(i).outerHeight(true);
					
					//ѭ������Ҫ��Ԫ��
					if(o.dir == "left") _li.parent().css({width: (_li_size*3)+"px"});
					_li.parent().empty().append(_li.clone()).append(_li.clone()).append(_li.clone());
					_li = $("li", this);
			
					//����
					var _li_scroll = 0;
					function goto(){
						_li_scroll += o.width;
						if(_li_scroll > _li_size)
						{
							_li_scroll = 0;
							_li.parent().css(o.dir == "left" ? { left : -_li_scroll } : { top : -_li_scroll });
							_li_scroll += o.width;
						}
							_li.parent().animate(o.dir == "left" ? { left : -_li_scroll } : { top : -_li_scroll }, o.amount);
					}s
					
					//��ʼ
					var move = setInterval(function(){ goto(); }, o.speed);
					_li.parent().hover(function(){
						clearInterval(move);
					},function(){
						clearInterval(move);
						move = setInterval(function(){ goto(); }, o.speed);
					});
				});
			};

			
			</script>
            
            <!-- Ư�����   -->          
            <!--<script type="text/javascript">
				$(function(){
					//����Ư�����
					$("body").floatAd({
						imgSrc : '/files/img/sanzhi.gif',
						url:'http://www.1dagong.com/zt/hefeizhaomu/'
					});
				})
			</script>-->
            <!-- Ư�����   -->
            <!--������ͼ-->
            <script type="text/javascript"> 
var time = 300; 
var h = 0; 
function addCount() 
{ 
    if(time>0) 
    { 
        time--; 
        h = h+5; 
    } 
    else 
    { 
        return; 
    } 
    if(h>400)  //�߶� 
    { 
        return; 
    } 
    document.getElementById("ads").style.display = ""; 
    document.getElementById("ads").style.height = h+"px"; 
    setTimeout("addCount()",30); 
} 
window.onload = function showAds() 
{ 
    addCount(); 
    setTimeout("noneAds()",5000); //ͣ��ʱ���Լ����� 
} 
var T = 400; 
var N = 400; //�߶� 
function noneAds() 
{ 
    if(T>0) 
    { 
        T--; 
        N = N-5; 
    } 
    else 
    { 
        return; 
    } 
    if(N<0) 
    { 
        document.getElementById("ads").style.display = "none"; 
        return; 
    } 
    document.getElementById("ads").style.height = N+"px"; 
    setTimeout("noneAds()",30); 
} 
</script> 
<!--������ͼ-->
</head>
<!--<body style="background:#fff url(../files/img/guoqing.jpg) no-repeat top center;">-->
<body>
	<div id="ads" style="width:1920px;height:400px;background:url(/files/img/top.gif);margin:0 auto; position:absolute; left:50%; margin-left:-960px; z-index:1000000; border-bottom:5px solid #606;"></div> 
    <div id="top"></div>

<!--------------ͷ������ ���-------------->

<SCRIPT> 
function toueme(){ 
document.getElementById("toubiao").style.display="none"; 
} 
</SCRIPT> 

<div id="toubiao"> 
    <table width="100%" border="0" cellspacing="0" cellpadding="0"> 
        <tr> 
            <td>
                <a target="_blank" href="/zt/zonglishicha/">
                    <img class="topb" src="/files/img/topb.gif" alt="���ǿ�����Ӳ��격������Դ����" title="���ǿ�����Ӳ��격������Դ����" >
                </a>
            </td> 
            <td class="guangbi" align="right">
                <a class="guanbi" onClick=toueme() >X</a>
            </td> 
        </tr> 
    </table> 
</div>


<!--------------1����������Ϣ  ���-------------->
<SCRIPT> 
function baoming(){ 
document.getElementById("mianfei").style.display="none"; 
} 
</SCRIPT> 
<div id="mianfei"> 
    <div class="fei01">
    	<!--<div class="mainfei_word">
        	��һ��ļ�����ְ
            <a class="baoming" href="/zt/zhaogz/">1�����ҹ��� <i class="fa fa-hand-o-right"></i></a>
           ���Ϊ���Ƽ�����
        </div>-->
        <div class="click_btn"><a href="/zt/zhaogz/" title="" target="_blank"></a></div>
    <a class="guanbi" onClick=baoming() >X</a>
    </div>
</div>
	
	<!--ͷ����ʼ-->
	<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include("header.htm", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>
	<!--ͷ������-->
    <div class="kuang">
        <div class="gonggao fr">
            <p class="fl"><i class="fa fa-bullhorn"></i>���棺</p>
            <div class="fr" id="spds" >                
                 <marquee direction="left" align="bottom" height="25" width="100%" onmouseout="this.start()" onmouseover="this.stop()" scrollamount="2" scrolldelay="1"><?php echo tpl_function_qishi_notice_list(array('set' => "�б���:notice,��ʾ��Ŀ:6,���ⳤ��:24,����:1,��ַ�:...,����:id>desc"), $this);?>
				<?php if (count((array)$this->_vars['notice'])): foreach ((array)$this->_vars['notice'] as $this->_vars['list']): ?>
                    <a  href="<?php echo $this->_vars['list']['url']; ?>
" target="_blank"><?php echo $this->_vars['list']['title']; ?>
</a>&nbsp;&nbsp;
                <?php endforeach; endif; ?></marquee>
                </div>
            </div> 
        </div>
    </div>
    
    
<!--------------��ҳ����------------->
<!--<script> 
var speed=150 
spds2.innerHTML=spds1.innerHTML 
function Marquee(){ 
if(spds2.offsetTop-spds.scrollTop<=100) 
spds.scrollTop-=spds1.offsetHeight 
else{ 
spds.scrollTop++ 
} 
} 
var MyMar=setInterval(Marquee,speed) 
spds.onmouseover=function() {clearInterval(MyMar)} 
spds.onmouseout=function() {MyMar=setInterval(Marquee,speed)} 
</script> -->

    
       <div class="main over">
         <div class="search">
         
<!--------------��ҳ���� ������ְλ����------------->
<script type="text/javascript">
/*����������js������дzzzzzz*/
	$(function(){
	$.divselect("#divselect","#inputselect");
	$.divselect("#divselect001","#inputselect001");
});
	$(document).ready(function(){
	/*����˾����ְλ��������*/
	/*$('#divselect li a').click(function(){
	$('#divselect .change_area input[name=areacode]').val($(this).attr('rel'));
	$('#divselect cite').text($(this).text());
	$('#divselect ul').hide();
	});*/
	//---ffffff
	$('#divselect li a').click(function(){
	$('#searckeybox input[name=types]').val($(this).attr('selectid'));
	});
	//---fffffflert($(this).text());
	/*����������*/
	$('#divselect001 li a').click(function(){
	$('#divselect001 input[name=citycategory]').val($(this).attr('selectid'));
	$('#divselect001 cite').text($(this).text());
	$('#divselect001 ul').hide();
	});
	
	});
</script>
            <form name="form1" action="/index_search.php" method="post">
              <div id="divselect">
                  <cite>ְλ</cite>
                  <ul>
                     <li><a href="javascript:;" selectid="1">ְλ</a></li>
                     <li><a href="javascript:;" selectid="2">��˾</a></li>
                  </ul>
              </div>           
                         
                <div class="text" id="searckeybox">
                	<input type="hidden" name="types" id="types" value="" />
                    <input type="text" name="key" id="searchkey" data="<?php echo $_GET['key']; ?>
"  onfocus="this.value=''"   />
					<!--�����ֶ�-->
					<!--<input name="trade_id" id="trade_id" type="hidden" value="<?php echo $_GET['trade']; ?>
" />
					<input name="jobs_id" id="jobs_id" type="hidden" value="<?php echo $_GET['jobcategory']; ?>
" />
					<input type="hidden" value="<?php echo $_GET['wage']; ?>
" name="wage">
					<input type="hidden" value="<?php echo $_GET['education']; ?>
" name="education">
					<input type="hidden" value="<?php echo $_GET['experience']; ?>
" name="experience">
					<input type="hidden" value="<?php echo $_GET['nature']; ?>
" name="nature">
					<input type="hidden" value="<?php echo $_GET['settr']; ?>
" name="settr">
					<input type="hidden" value="" name="sort">
					<input type="hidden" value="1" name="page">-->
					<!--�����ֶν���-->
                </div>
                
              <div id="divselect001">
                  <cite>����</cite>
				  <input type="hidden" name="citycategory" value="">
                  <ul>
                     <li><a href="javascript:;" selectid="">����</a></li>
                     <li><a href="javascript:;" selectid="13.224">�Ϸ�</a></li>
                     <li><a href="javascript:;" selectid="13.225">�ߺ�</a></li>
                     <li><a href="javascript:;" selectid="2.0">�Ϻ�</a></li>
                     <li><a href="javascript:;" selectid="4.0">����</a></li>
                     <li><a href="javascript:;" selectid="18.0">����</a></li>
                     <li><a href="javascript:;" selectid="18.295">�人</a></li>
                     <li><a href="javascript:;" selectid="11.0">����</a></li>
                     <li><a href="javascript:;" selectid="17.278">֣��</a></li>
                  </ul>
              </div>
                 
                 <div><input class="button" id="btnsearch" ty="QS_jobslist" type="submit" value="����" /></div>
                 
            </form>
        </div>
		
		<script src="<?php echo $this->_vars['QISHI']['site_template']; ?>
js/jquery.autocomplete.js" type="text/javascript"></script>
					<script language="javascript" type="text/javascript">
					 $(document).ready(function()
					{
						  var a = $('#searchkey').autocomplete({ 
							serviceUrl:'<?php echo $this->_vars['QISHI']['website_dir']; ?>
plus/ajax_common.php?act=hotword',
							minChars:1, 
							maxHeight:400,
							width:360,
							zIndex: 1,
							deferRequestBy: 0 
						  });
					
					});
					  </script>
        <div class="hotse">  ����������
        	<!--���Źؼ���-->
        	<?php echo tpl_function_qishi_hotword(array('set' => "��ʾ��Ŀ:9,�б���:list"), $this);?>
            <?php if (count((array)$this->_vars['list'])): foreach ((array)$this->_vars['list'] as $this->_vars['li']): ?>
            <a href="<?php echo $this->_run_modifier($this->_run_modifier("QS_jobslist,key:", 'cat', 'plugin', 1, $this->_vars['li']['w_word_code']), 'qishi_url', 'plugin', 1); ?>
" target="_blank"><?php echo $this->_vars['li']['w_word']; ?>
</a>
            <?php endforeach; endif; ?> 
            <!--<a href="#">����</a>-->
            
        </div>
		
    </div>
<!--------------banner���� ѡ�-------------->  
<script type="text/javascript"> 
function setTab(name,m,n){ 
for( var i=1;i<=n;i++){ 
var menu = document.getElementById(name+i); 
var showDiv = document.getElementById("cont_"+name+"_"+i); 
menu.className = i==m ?"on":""; 
showDiv.style.display = i==m?"block":"none"; 
} 
} 
</script> 

<div class="jieri">
	<div class="jr_l"></div>
	<div class="jr_r"></div>
</div>
<!--�������λ��ļ��� ��ʼ -->
<div class="shehui_zhaomu"><a href="http://www.1dagong.com/zt/hefeizhaomu/" target="_blank" title="�Ϸ����������λ��ļ"><img src="/files/img/hengfu_banner.gif" alt="�Ϸ����������λ��ļ" /></a></div>
<!--�������λ��ļ��� ���� -->
<div class="kuang over">
    <div class="container fl wid220">
    <!-- ��ҵְλ -->
	<div class="left">
			
			<div class="category_wrap leftMenu" id="topWrap">
				<div class="h3"><i class="fa fa-bars"></i>ȫ��ְλ����</div>
				<ul>
					<?php echo tpl_function_qishi_get_classify(array('set' => "�б���:category,����:QS_jobs,��ʾ��Ŀ:10"), $this);?>
					<?php if (count((array)$this->_vars['category'])): foreach ((array)$this->_vars['category'] as $this->_vars['list']): ?>	
					<li class="clearfix" id="<?php echo $this->_vars['list']['id']; ?>
">
						<div class="category">
                        
							<p><a href="javascript:void(0);"><?php echo $this->_vars['list']['categoryname']; ?>
</a></p>
							<div class="icon_right">
								<span class="angle_right"><i class="submenu-icon fa fa-plus"></i></span>
							</div>
						</div>
						<div class="sub_category"></div>
					</li>
					<?php endforeach; endif; ?>
				</ul>
			</div>
			<div class="leftmenu_box">
					<div class="show">
                    
					</div>
                    
	  </div>
	  </div>      
        
	<!-- ��ҵְλ ���� -->
   </div>
    
    <div class="wid515 mr25 fl">
<!--------------bannerͼ-------------->  
<script type="text/javascript">
jQuery(function($){
	var index = 0;
	var maximg = 5;
	//$('<div id="flow"></div>').appendTo("#myjQuery");

	//���������ı�����	
	$("#myjQueryNav li").hover(function(){
		if(MyTime){
			clearInterval(MyTime);
		}
		index  =  $("#myjQueryNav li").index(this);
		MyTime = setTimeout(function(){
		ShowjQueryFlash(index);
		$('#myjQueryContent').stop();
		} , 400);

	}, function(){
		clearInterval(MyTime);
		MyTime = setInterval(function(){
		ShowjQueryFlash(index);
		index++;
		if(index==maximg){index=0;}
		} , 3000);
	});
	//���� ֹͣ������������ʼ����.
	 $('#myjQueryContent').hover(function(){
			  if(MyTime){
				 clearInterval(MyTime);
			  }
	 },function(){
				MyTime = setInterval(function(){
				ShowjQueryFlash(index);
				index++;
				if(index==maximg){index=0;}
			  } , 3000);
	 });
	//�Զ�����
	var MyTime = setInterval(function(){
		ShowjQueryFlash(index);
		index++;
		if(index==maximg){index=0;}
	} , 3000);
});
function ShowjQueryFlash(i) {
$("#myjQueryContent div").eq(i).animate({opacity: 1},1000).css({"z-index": "1"}).siblings().animate({opacity: 0},1000).css({"z-index": "0"});
//$("#flow").animate({ left: 652+(i*76) +"px"}, 300 ); //���黬��
$("#myjQueryNav li").eq(i).addClass("current").siblings().removeClass("current");
}
</script>
        <div class="topvebanner fr">
          <div id="myjQuery">
            <div id="myjQueryContent">
            <?php echo tpl_function_qishi_ad(array('set' => "��ʾ��Ŀ:5,��������:QS_indexfocus,�б���:ad,����:show_order>desc"), $this); if (count((array)$this->_vars['ad'])): foreach ((array)$this->_vars['ad'] as $this->_vars['list']): ?>
              <div><a href="<?php echo $this->_vars['list']['img_url']; ?>
" target="_blank"><img src="<?php echo $this->_vars['list']['img_path']; ?>
" title="<?php echo $this->_vars['list']['img_explain']; ?>
"></a></div>
            <?php endforeach; endif; ?>
            </div>
            <ul id="myjQueryNav">
             <!--<li class="current"></li>-->
            <?php echo tpl_function_qishi_ad(array('set' => "��ʾ��Ŀ:5,��������:QS_indexfocus,�б���:ad,����:show_order>desc"), $this); if (count((array)$this->_vars['ad'])): foreach ((array)$this->_vars['ad'] as $this->_vars['list']): ?>
               <li></li>
            <?php endforeach; endif; ?>
            </ul>
          </div>
        </div>
        
        <div class="tab"> 
            <div class="yesc"> 
                <ul> 
                    <li id="one1" class="on" onmouseover='setTab("one",1,5)'>������Ƹ</li> 
                    <li id="one2" onmouseover='setTab("one",2,5)'>������Ƹ</li>
                    <li id="one3" onmouseover='setTab("one",3,5)'>��нְλ</li> 
                	<li id="one4" onmouseover='setTab("one",4,5)'>��ְ</li> 
                   <!-- <li class="none" id="one5" onmouseover='setTab("one",5,5)'>��нְλ</li>-->
                </ul> 
            </div> 
            <div class="tabList"> 
                <div id="cont_one_1" class="the01 jinji_zhaoP"> 
                	<ul>
                    <?php echo tpl_function_qishi_jobs_list(array('set' => "�б���:jobs,��ʾ��Ŀ:8,��ַ�:...,ְλ������:11,����:rtime>desc"), $this);?>
					<?php if (count((array)$this->_vars['jobs'])): foreach ((array)$this->_vars['jobs'] as $this->_vars['jobslist']): ?>											
                    	<li><a href="<?php echo $this->_vars['jobslist']['jobs_url']; ?>
"><span class="zhaoP_title"><?php echo $this->_vars['jobslist']['jobs_name']; ?>
</span><b class="gongZ"><?php echo $this->_vars['jobslist']['wage_cn']; ?>
</b><!--<span class="memberN"><?php echo $this->_vars['jobslist']['amount']; ?>
��</span>--><span class="date"><?php echo $this->_vars['jobslist']['refreshtime_cn']; ?>
</span></a></li>
					<?php endforeach; endif; ?>
                  </ul>
                </div>

                <div id="cont_one_2" class="the01 one"> 
                	<ul>
                    	<!--������Ƹ(�Ƽ���ҵ�ƹ�)-->
                        <?php echo tpl_function_qishi_companyjobs_list(array('set' => "�б���:company,��ʾ��Ŀ:8,��ʾְλ:4,ְλ������:4,��ҵ������:12,����:hot>desc"), $this);?><!--�Ƽ�:1-->
                        <?php if (count((array)$this->_vars['company'])): foreach ((array)$this->_vars['company'] as $this->_vars['list']): ?>
                   	  <li>
                            <!---������ɫ-class="wids"--><P><?php if (count((array)$this->_vars['list']['jobs'])): foreach ((array)$this->_vars['list']['jobs'] as $this->_vars['jobslist']): ?><a href="<?php echo $this->_vars['jobslist']['jobs_url']; ?>
" ><?php echo $this->_vars['jobslist']['jobs_name']; ?>
</a><?php endforeach; endif; ?></P>
                            <span><?php echo $this->_vars['list']['refreshtime_cn']; ?>
</span>
                            <!--<span><strong><?php echo $this->_vars['list']['amount']; ?>
</strong>��</span>-->
                        </li>
                        <?php endforeach; endif; ?>
                    </ul>
                </div> 
                <div id="cont_one_3" class="the03 one"> 
                	<ul>
                    	<!--�Ƽ���Ƹ-->
                    	<!--<li>
                        	<a href="#">����/�г�sdfsdg����</a>
                            <p>10000-14999<font color="#999" size="2">Ԫ/��</font></p>
                            <span>���պϷ�
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </span>
                        </li>
                        <li class="width40">&nbsp;</li>-->
                        
                        <!--�Ƽ���Ƹ-->
                        
                    	 <!--��нְλ-->
                       <?php echo tpl_function_qishi_jobs_list(array('set' => "�б���:list,��ʾ��Ŀ:8,����:wage>desc"), $this);?>
                       <?php if (count((array)$this->_vars['list'])): foreach ((array)$this->_vars['list'] as $this->_vars['li']): ?>
                    	<li>
                        	<a href="<?php echo $this->_vars['li']['jobs_url']; ?>
"><?php echo $this->_vars['li']['jobs_name']; ?>
</a>
                            <p><?php echo $this->_vars['li']['wage_cn']; ?>
<!--<font color="#999" size="2">Ԫ/��</font>--></p>
                            <span><?php echo $this->_vars['li']['district_cn']; ?>

                                <!--<i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>-->
                            </span>
                        </li>
                         <li style="width:20px;">&nbsp;</li>
                        <?php endforeach; endif; ?>
                    </ul>
                </div> 
                <div id="cont_one_4" class="the01 the04 one">
                	
                	<ul>
                    	<!--��ְ/ʵϰ-->
                        <?php echo tpl_function_qishi_jobs_list(array('set' => "�б���:list,��ʾ��Ŀ:8,ְλ����:63,����:rtime>desc"), $this);?>
                           <?php if (count((array)$this->_vars['list'])): foreach ((array)$this->_vars['list'] as $this->_vars['li']): ?>
                            <li>
                                <P><a href="<?php echo $this->_vars['li']['jobs_url']; ?>
"><?php echo $this->_vars['li']['jobs_name']; ?>
</a></P><span><?php echo $this->_vars['li']['refreshtime_cn']; ?>
</span>
                                <span class="qian"><?php echo $this->_vars['li']['wage_cn']; ?>
</span>
                                <!--<span><?php echo $this->_vars['li']['refreshtime_cn']; ?>
</span>-->
                                <span><?php echo $this->_vars['li']['amount']; ?>
��</span>
                        	</li>
                            <?php endforeach; endif; ?> 
                    </ul>
                </div> 
                
                <div id="cont_one_5" class="the03 one"> 
                	<ul>
                    	<!--��нְλ-->
                    	<!--<li>
                        	<a href="#">����/�г�sdfsdg����</a>
                            <p>10000-14999<font color="#999" size="2">Ԫ/��</font></p>
                            <span>���պϷ�
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </span>
                        </li>
                        <li class="width40">&nbsp;</li>-->
                        <!--��нְλ-->
                       <?php echo tpl_function_qishi_jobs_list(array('set' => "�б���:list,��ʾ��Ŀ:6,����:wage>desc,���ڷ�Χ:356"), $this);?>
                       <?php if (count((array)$this->_vars['list'])): foreach ((array)$this->_vars['list'] as $this->_vars['li']): ?>
                    	<li>
                        	<a href="<?php echo $this->_vars['li']['jobs_url']; ?>
"><?php echo $this->_vars['li']['jobs_name']; ?>
</a>
                            <p><?php echo $this->_vars['li']['wage_cn']; ?>
<!--<font color="#999" size="2">Ԫ/��</font>--></p>
                            <span><?php echo $this->_vars['li']['district_cn']; ?>

                                <!--<i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>-->
                            </span>
                        </li>
                         <li style="width:20px;">&nbsp;</li>
                        <?php endforeach; endif; ?>
                        
                        
                    </ul>
                </div> 
            </div>
        </div> 
        
	</div>
    
    <div class="wid270 fr">
    	<div class="zhiwei">
        	<div class="fabu over">
            <p><font>Ҽ����������ְλ��������ѡ</font>����ֻ��һ�����ù��������㡣</p>
        	<a href="/user/personal/personal_resume.php?act=make1" class="geren fl"><i class="fa fa-file-text"></i>��д����</a>
            <a href="/user/company/company_jobs.php?act=addjobs" class="qiye fr"><i class="fa fa-align-center"></i>����ְλ</a>
        </div>
        <!--<div class="newzw">
        	��������ְλ&nbsp;<span><?php echo $this->_vars['time_display']; ?>
</span>&nbsp;��
        </div>-->
        </div>
        <div class="zhiping_btn"><a href="/zt/">Ҽ����ְҵ���ʲ���</a> </div>
       <!--��ȡ����վ��������Ƹ�� ��ʼ-->
        <div class="scene">
			<a title="�ҹ���"  class="scene_a"><img src="files/img/beijin.jpg" alt="" /></a>
            <div class="hnsd">
            	<dl>
                	<dt><h3 class="fl">�ֳ���Ƹ��</h3></dt>
					<?php echo tpl_function_qishi_jobfair_list(array('set' => "�б���:jobfair,��ʾ��Ŀ:1,���ⳤ��:35,��ҳ��ʾ:1,���ⳤ��:35,��ַ�:..."), $this);?>
					<?php if (count((array)$this->_vars['jobfair'])): foreach ((array)$this->_vars['jobfair'] as $this->_vars['list']): ?> 
                    <dd><a href="<?php echo $this->_vars['list']['url']; ?>
&dqid=<?php echo $this->_vars['dqid']; ?>
"><strong>Ҽ����</strong>ȫ��Ѳ����Ƹ�� <br /><font color="#606"></font></a></dd>
                    <dd><i class="fa fa-clock-o"></i><?php echo $this->_run_modifier($this->_vars['list']['holddates'], 'date_format', 'plugin', 1, "%Y��%m��%d��"); ?>
</dd>
                    <dd><i class="fa fa-map-marker"></i><?php echo $this->_vars['list']['address']; ?>
</dd>
                    <dd><i class="fa fa-phone"></i><?php echo $this->_vars['list']['phone']; ?>
</dd>
					<?php endforeach; endif; ?>
                </dl>
                
            </div>
        </div>
    	<!--��ȡ����վ��������Ƹ�� ����-->
    	
    </div> 
</div>   
      
    <!--Ҽ�������˲��г� -->
<?php echo tpl_function_qishi_jobfair_list(array('set' => "�б���:jobfair,��ʾ��Ŀ:7,���ⳤ��:35,��ҳ��ʾ:1,���ⳤ��:35,��ַ�:..."), $this);?>
<?php if ($this->_vars['jobfair']): ?>
<div class="kuang company">
	<h2>
            <i class="fa fa-users"></i>Ҽ���˲��г�<span>����ԤԼ���ֳ���Ƹ��</span> <a href="/jobfair/jobfair-list.php" target="_blank" class="more" title="����ϸѡ����ҵ������ҵ">�鿴����>></a>
    </h2>
    <div class="company_jobs" id="tab_rencai">
        <div class="hd zhaop_date" id="zhaop_date">
        	<ul class="tab-nav">
            	<?php if (count((array)$this->_vars['jobfair'])): foreach ((array)$this->_vars['jobfair'] as $this->_vars['list']): ?> 
                <li <?php if ($this->_vars['list']['y'] == 1): ?>class="on"<?php endif; ?>><?php echo $this->_run_modifier($this->_vars['list']['holddates'], 'date_format', 'plugin', 1, "%m��%d��"); ?>
</li>
                <?php endforeach; endif; ?>
                <!--<li style="margin-right:0;">9��10��</li>-->
            </ul>
        </div>
        
    	<div class="bd tab-warp company_jobsLeft" >
        	<?php if (count((array)$this->_vars['jobfair'])): foreach ((array)$this->_vars['jobfair'] as $this->_vars['list']): ?> 
        	<div class="box"  <?php if ($this->_vars['list']['y'] == 1): ?>style="display:block;"<?php endif; ?>>
            	<ul>
                <!--�Ϸ�-->

            	<li><div class="company_count">
                    	<dl>
                        	<dt><?php echo $this->_vars['list']['title_']; ?>
<span><?php if ($this->_vars['list']['subsite_id'] == 1 || $this->_vars['list']['subsite_id'] == 0): ?>������վ��<?php endif;  if ($this->_vars['list']['subsite_id'] == 5): ?>���Ϻ�վ��<?php endif;  if ($this->_vars['list']['subsite_id'] == 8): ?>������վ��<?php endif; ?></span><!--<?php echo $this->_vars['list']['industry']; ?>
��Ƹ��--></dt>
                             <?php if ($this->_vars['list']['predetermined_ok'] == "1" && $this->_vars['list']['predetermined_web'] == "1"): ?>
                            <dd><a href="<?php echo $this->_run_modifier("QS_user,1", 'qishi_url', 'plugin', 1); ?>
company_jobfair.php?act=jobfair" title="" target="_blank" class="yuding"><i class="fa fa-building"></i>��ҵԤ��</a></dd>
                            <dd><a href="javascript:void();" title=""  class="yuding yyue_button" id="<?php echo $this->_vars['list']['id']; ?>
"><i class="fa fa-user"></i>��ְԤԼ</a></dd>
                            <?php else: ?>
                            <dd><a href="javascript:void();" class="huodong_end">��ҵԤ���ѽ���</a></dd>
                            <?php endif; ?>
                           	<dd style="color:#F00;">��Ԥ����ҵ(<?php echo $this->_vars['list']['yiyuding']; ?>
)��</dd>
                            <dd class="rencai_more"><a href="<?php echo $this->_vars['list']['url']; ?>
&dqid=<?php echo $this->_vars['dqid']; ?>
#pic" target="_blank">�鿴����>></a></dd>
                            <!--<dd><a href="javascript:void();" class="huodong_end">��ҵԤ���ѽ���</a></dd>-->
                        </dl>
                    </div></li>
                	<li><div class="picScroll">
                            	<ul>
                                    <li>
                                    <?php if (count((array)$this->_vars['list']['ydqy'])): foreach ((array)$this->_vars['list']['ydqy'] as $this->_vars['li']): ?>
                                    <p><a href="/company_<?php echo $this->_vars['li']['cid']; ?>
.html" target="_blank" title="" class="w1"><?php echo $this->_vars['li']['title']; ?>
</a><span>��Ԥ��</span></p>
                                    <?php if ($this->_vars['li']['kehu'] % 2 == 0): ?>
                                    </li>
                                    <li>
                                    <?php endif; ?>
                                    <?php endforeach; endif; ?>
                                    </li>
                                   <!--<li><p><a href="/company_<?php echo $this->_vars['li']['cid']; ?>
.html" target="_blank" title="" class="w1">���ף��������Ƽ���չ���޹�˾��չ���޹�</a><span>��Ԥ��</span></p><p><a href="/company_<?php echo $this->_vars['li']['cid']; ?>
.html" target="_blank" title="" class="w1">���ף��������Ƽ���չ���޹�˾��չ���޹�</a><span>��Ԥ��</span></p></li>-->
                                </ul>
                                <!--����--><!--<script type="text/javascript">jQuery(".picScroll").slide({ mainCell:"ul",autoPlay:true,effect:"leftMarquee",interTime:50,vis:3  });</script>-->
                     </li>
                  </ul>
               </div>
                 <?php endforeach; endif; ?>   
   
                    
        </div>
        <!--����--><!--<script type="text/javascript">jQuery(".picScroll").slide({ mainCell:"ul",autoPlay:true,effect:"leftMarquee",interTime:50,vis:3  });</script>-->
        <!--�˲��г�ѡ��л�Ч��-->
		<script type="text/javascript">jQuery(".company_jobs").slide();</script>        
        <!--�˲��г�ѡ��л�Ч��-->
        
        
            <!--<div class="zhaop_btn_show">
            <ul>
                <li>�鿴����������Ƹ�᣺</li>
                <li><a href="" class="zhaop_btn_show01">����</a></li>
                <li><a href="" class="zhaop_btn_show01">�Ϻ�</a></li>
            </ul>
        </div>-->
   </div>
  </div>
  <div class="QRcode" style="display:none;" id="changeBox001"><!--�����ǵ�����ʼ     href="../ewm.php?id=1161"-->
					<div class="QRcode_main"> 
						<h3><span class="weixin">΢��</span>ɨ�뼴�����ԤԼ����</h3>   
						<img src="" class="changeImg" alt="" id="img001" />
					</div>
					<a class="yyue_close" title="�ر�"></a>
					<div class="QRcode_zhe"></div>
				</div><!--�����ǵ�������-->
        </div>

       
        
        <!--�����������ԤԼЧ��-->
        <script type="text/javascript">
						$(".yyue_button").click(function(){
							//$(this).siblings(".QRcode").show();
							$.get('../ewm.php', {"id":$(this).attr("id")}, function(data) {
								//alert(data);
								$("#img001").attr('src', data);//�ѷ��صĵ�ַ����ӵ�#changeImgͼƬsrc��ַ��
								$("#changeBox001").show();//��ʾ��ά��
								
							});	
							//$(this).siblings(".QRcode").show();
						})

						$(".yyue_close").click(function(){
							$(this).parent().hide();
						})
		</script>
    </div>
</div>
 
<!--o2o�����˲��г�banner-->
<div class="kuang company xianxia_banner slideBox">
	<div class="bd">
    	<ul>
        <?php echo tpl_function_qishi_ad(array('set' => "��ʾ��Ŀ:5,��������:jobfair_picture,�б���:ad,����:show_order>desc"), $this); if (count((array)$this->_vars['ad'])): foreach ((array)$this->_vars['ad'] as $this->_vars['list']): ?>
        	<li><a href="<?php echo $this->_vars['list']['img_url']; ?>
" title="<?php echo $this->_vars['list']['img_explain']; ?>
" target="_blank"><img src="<?php echo $this->_vars['list']['img_path']; ?>
" width="1040" height="70"  alt=""/></a></li>
        <?php endforeach; endif; ?>
        </ul>
        <a href="javascript:void();" class="prev"></a>
        <a href="javascript:void();" class="next"></a>
    </div>
</div>
<?php endif; ?>
<!--�˲��г��ֲ� -->
    <script type="text/javascript">
    jQuery(".slideBox").slide({mainCell:".bd ul",autoPlay:true});
    </script>       
  <!--�˲��г�����-->
  <!--��ҵ����-->
    <div class="kuang company">
    	<h2>
            <i class="fa fa-institution"></i>��ҵ����<span>����ϸѡ����ҵ������ҵ��</span> <a href="/hymq/" class="more" title="����ϸѡ����ҵ������ҵ">�鿴����>></a>
        </h2>
         <div class="in-list">
			<?php echo tpl_function_qishi_hymq_jobs_list(array('set' => "��ҳ��ʾ:1,�б���:jobslist,��ʾ��Ŀ:4,��ַ�:...,ְλ������:13,��ҵ������:19,��������:65,�ؼ���:GET[key],ְλ����:GET[jobcategory],ְλ����:GET[category],ְλС��:GET[subclass],��������:GET[citycategory],��������:GET[district],����С��:GET[sdistrict],��ҵ:GET[trade],���ڷ�Χ:GET[settr],����:GET[wage],����:GET[age],��˾��ģ:GET[scale],����:id>desc"), $this);?>
        	<?php if (count((array)$this->_vars['jobslist'])): foreach ((array)$this->_vars['jobslist'] as $this->_vars['list']): ?>
         	<div class="in-list-con <?php if ($this->_vars['list']['y'] % 4 == 0): ?>noma<?php endif; ?>" title="<?php echo $this->_vars['list']['companyname']; ?>
">
            	<h3><a href="<?php echo $this->_vars['list']['jobs_url']; ?>
"><?php echo $this->_vars['list']['companyname']; ?>
</a></h3>
                <P>�� �� �ʣ�<span><?php echo $this->_vars['list']['wage_cn']; ?>
</span></P>
                <P>�� �� վ��<b class="infdk"><?php echo $this->_vars['list']['jiezhan']; ?>
</b></P>
                <P class="infdk infdk_t"><?php echo $this->_vars['list']['shortitle']; ?>
</P>
                <a href="<?php echo $this->_vars['list']['jobs_url']; ?>
"><img src="/data/hymq_img/<?php echo $this->_vars['list']['logo']; ?>
" width="220px" height="101px" /></a>
                <div class="over wdids">
                	<p class="fl"><strong><?php echo $this->_vars['list']['bmrenshu']; ?>
��</strong>����</p>
                    <a href="<?php echo $this->_vars['list']['jobs_url']; ?>
">ȥ����</a>
                </div>
                <div class="<?php if ($this->_vars['list']['zp_cn'] == '��Ƹ'): ?>hot<?php endif; ?> <?php if ($this->_vars['list']['zp_cn'] == '��Ƹ'): ?>urgent<?php endif; ?>"></div>
            </div>
            <?php endforeach; endif; ?>
       	  
         </div>
	</div> 
    <div style="clear:both;"></div>
    
    
  <!--------------�в���ҵ����ѡ�-------------->  
<script type="text/javascript">

    $(function(){
            var timeid;
          $("#tab").find("li").each(function(index){
              var sLi=$(this);
              sLi.mouseenter(function(){
                  timeid= setTimeout(function(){
                      sLi.addClass("current").siblings().removeClass("current");
                      sLi.parent().next().find("ul:eq(" + index +")").show().siblings().hide() ;
                 },300);
              }).mouseleave(function(){
                     clearTimeout(timeid);
                      })

          })
        })
	
</script>
		<!--�в�������Ŀ����-->
		<div class="kuang company">
        	<h2 class="mb10"><i class="fa fa-tasks"></i>������Ƹ<span>���µ�������Ƹ��ҵ��</span> <a href="zhaopin/index.html" class="more" title="������Ƹ��ҵ">�鿴����>></a></h2>
            <div class="remen_list">
            	<div class="remen_listTitle"><span>��е/���� ����/�ʹ�</span><a href="zhaopin/index.html" class="more">�鿴����>></a></div>
                <div class="remen_job">
                	<div class="remen_jobLeft">
                    	<ul class="job_left">
                        	<li><a href="/jobs/jobs-list.php?key=&jobcategory=1065.1067.1121">�չ�/������</a></li>
                            <li><a href="/jobs/jobs-list.php?key=&jobcategory=1065.1067.1122">ά�޹�</a></li>
                            <li><a href="/jobs/jobs-list.php?key=&jobcategory=1065.1067.1124" class="display_color">�繤</a></li>
                            <li><a href="/jobs/jobs-list.php?key=&jobcategory=1065.1067.1125">ľ��</a></li>
                            <li><a href="/jobs/jobs-list.php?key=&jobcategory=1065.1067.1126">ǯ��</a></li>
                            <li><a href="/jobs/jobs-list.php?key=&jobcategory=1065.1067.1127" class="display_color">�и�/����</a></li>
                            <li><a href="/jobs/jobs-list.php?key=&jobcategory=1065.1067.1128">����</a></li>
                            <li><a href="/jobs/jobs-list.php?key=&jobcategory=1065.1067.1129" class="display_color">���Ṥ</a></li>
                            <li><a href="/jobs/jobs-list.php?key=&jobcategory=1065.1067.1130">���ҹ�</a></li>
                        </ul>
                        <ul class="job_right">
                        	<li><a href="/jobs/jobs-list.php?key=&jobcategory=1065.1067.1131">��¯��</a></li>
                            <li><a href="/jobs/jobs-list.php?key=&jobcategory=1065.1067.1132" class="display_color">����/ϳ��</a></li>
                            <li><a href="/jobs/jobs-list.php?key=&jobcategory=1065.1067.1142">��װ��</a></li>
                            <li><a href="/jobs/jobs-list.php?key=&jobcategory=1065.1067.1136" class="display_color">��װ��</a></li>
                            <li><a href="/jobs/jobs-list.php?key=&jobcategory=1065.1068.1164">�ʼ�Ա</a></li>
                            <li><a href="/jobs/jobs-list.php?key=&jobcategory=1065.1068.1163" class="display_color">Ʒ��Ա </a></li>
                            <li><a href="/jobs/jobs-list.php?key=&jobcategory=1065.1067.1135">���ݹ�</a></li>
                            <li><a href="/jobs/jobs-list.php?key=&jobcategory=1065.1067.1137" class="display_color">�ֻ�ά�� </a></li>
                            <li><a href="/jobs/jobs-list.php?key=&jobcategory=1065.1067.1133">����/�泵��</a></li>
                        </ul>
                        <div class="clear"></div>
                    </div>
                    <div class="remen_jobRight">
                        <?php echo tpl_function_qishi_companyjobs_list(array('set' => "�б���:company,��ʾ��Ŀ:10,��ʾְλ:4,ְλ������:4,��ҵ������:32,ְλ����:1065,����:rtime>desc"), $this);?><!--�Ƽ�:1-->
                        <?php if (count((array)$this->_vars['company'])): foreach ((array)$this->_vars['company'] as $this->_vars['list']): ?>
                    	<dl>
                        	<dt><a href="<?php echo $this->_vars['list']['company_url']; ?>
" class="company_N"><?php echo $this->_vars['list']['companyname']; ?>
</a></dt>
                            <dd class="job_name"><?php if (count((array)$this->_vars['list']['jobs'])): foreach ((array)$this->_vars['list']['jobs'] as $this->_vars['jobslist']): ?><a href="<?php echo $this->_vars['jobslist']['jobs_url']; ?>
" class="company_J"><?php echo $this->_vars['jobslist']['jobs_name']; ?>
</a><?php endforeach; endif; ?></dd>
                            <dd class="job_a"><span><?php echo $this->_vars['list']['district_cn']; ?>
</span></dd>
                        </dl>
                        <?php endforeach; endif; ?>
						<?php if ($this->_vars['buqi_sta'] == '1'): ?>
                        <?php if (count((array)$this->_vars['company_buqi'])): foreach ((array)$this->_vars['company_buqi'] as $this->_vars['list_buqi']): ?>
                    	<dl>
                        	<dt><a href="<?php echo $this->_vars['list_buqi']['company_url']; ?>
" class="company_N"><?php echo $this->_vars['list_buqi']['companyname']; ?>
</a></dt>
                            <dd class="job_name"><?php if (count((array)$this->_vars['list_buqi']['jobs'])): foreach ((array)$this->_vars['list_buqi']['jobs'] as $this->_vars['jobslist']): ?><a href="<?php echo $this->_vars['jobslist']['jobs_url']; ?>
" class="company_J"><?php echo $this->_vars['jobslist']['jobs_name']; ?>
</a><?php endforeach; endif; ?></dd>
                            <dd class="job_a"><span><?php echo $this->_vars['list_buqi']['district_cn']; ?>
</span></dd>
                        </dl>
                        <?php endforeach; endif; ?>
						<?php endif; ?>						
                    </div>
                </div>
            </div>
            
            <div class="remen_list">
            	<div class="remen_listTitle remen_listTitle02"><span>����/����  ����/ó��</span><a href="zhaopin/index.html" class="more">�鿴����>></a></div>
                <div class="remen_job">
                	<div class="remen_jobLeft">
                    	<ul class="job_left">
                        	<li><a href="/jobs/jobs-list.php?key=&jobcategory=1077.1078.1317">���۴���</a></li>
                            <li><a href="/jobs/jobs-list.php?key=&jobcategory=1077.1078.1318">��������</a></li>
                            <li><a href="/jobs/jobs-list.php?key=&jobcategory=1077.1078.1325" class="display_color">ҽҩ����</a></li>
                            <li><a href="/jobs/jobs-list.php?key=&jobcategory=1077.1078.1326">ҽ�ƻ�������</a></li>
                            <li><a href="/jobs/jobs-list.php?key=&jobcategory=1077.1078.1327">��������</a></li>
                            <li><a href="/jobs/jobs-list.php?key=&jobcategory=1077.1080.1389" class="display_color">�Ա�����</a></li>
                            <li><a href="/jobs/jobs-list.php?key=&jobcategory=1077.1079.1360">�ͷ�����</a></li>
                            <li><a href="/jobs/jobs-list.php?key=&jobcategory=1077.1080.1388" class="display_color">�Ա��ͷ�</a></li>
                            <li><a href="/jobs/jobs-list.php?key=&jobcategory=1077.1078.1324">��������</a></li>
                        </ul>
                        <ul class="job_right">
                        	<li><a href="/jobs/jobs-list.php?key=&jobcategory=1081.1082.1420">���Ա</a></li>
                            <li><a href="/jobs/jobs-list.php?key=&jobcategory=1081.1082.1421" class="display_color">�ֿ����Ա</a></li>
                            <li><a href="/jobs/jobs-list.php?key=&jobcategory=1081.1085.1449">�ɹ�Ա</a></li>
                            <li><a href="/jobs/jobs-list.php?key=&jobcategory=1081.1084.1436" class="display_color">ӪҵԱ/��Ա</a></li>
                            <li><a href="/jobs/jobs-list.php?key=&jobcategory=1081.1083.1431">����˾��</a></li>
                            <li><a href="/jobs/jobs-list.php?key=&jobcategory=1077.1078.1332" class="display_color">��ͻ����� </a></li>
                            <li><a href="/jobs/jobs-list.php?key=&jobcategory=1077.1078.1329">����רԱ</a></li>
                            <li><a href="/jobs/jobs-list.php?key=&jobcategory=1077.1079.1361" class="display_color">������Ա</a></li>
                            <li><a href="/jobs/jobs-list.php?key=&jobcategory=1077.1078.1333" class="max_width">�Ź�ҵ��Ա/����</a></li>
                        </ul>
                        <div class="clear"></div>
                    </div>
                    <div class="remen_jobRight">
                    	<?php echo tpl_function_qishi_companyjobs_list(array('set' => "�б���:company,��ʾ��Ŀ:10,��ʾְλ:4,ְλ������:4,��ҵ������:32,ְλ����:1077,����:rtime>desc"), $this);?><!--�Ƽ�:1-->
                        <?php if (count((array)$this->_vars['company'])): foreach ((array)$this->_vars['company'] as $this->_vars['list']): ?>
                    	<dl>
                        	<dt><a href="<?php echo $this->_vars['list']['company_url']; ?>
" class="company_N"><?php echo $this->_vars['list']['companyname']; ?>
</a></dt>
                            <dd class="job_name"><?php if (count((array)$this->_vars['list']['jobs'])): foreach ((array)$this->_vars['list']['jobs'] as $this->_vars['jobslist']): ?><a href="<?php echo $this->_vars['jobslist']['jobs_url']; ?>
" class="company_J"><?php echo $this->_vars['jobslist']['jobs_name']; ?>
</a><?php endforeach; endif; ?></dd>
                            <dd class="job_a"><span><?php echo $this->_vars['list']['district_cn']; ?>
</span></dd>
                        </dl>
                        <?php endforeach; endif; ?>
						<?php if ($this->_vars['buqi_sta'] == '1'): ?>
                        <?php if (count((array)$this->_vars['company_buqi'])): foreach ((array)$this->_vars['company_buqi'] as $this->_vars['list_buqi']): ?>
                    	<dl>
                        	<dt><a href="<?php echo $this->_vars['list_buqi']['company_url']; ?>
" class="company_N"><?php echo $this->_vars['list_buqi']['companyname']; ?>
</a></dt>
                            <dd class="job_name"><?php if (count((array)$this->_vars['list_buqi']['jobs'])): foreach ((array)$this->_vars['list_buqi']['jobs'] as $this->_vars['jobslist']): ?><a href="<?php echo $this->_vars['jobslist']['jobs_url']; ?>
" class="company_J"><?php echo $this->_vars['jobslist']['jobs_name']; ?>
</a><?php endforeach; endif; ?></dd>
                            <dd class="job_a"><span><?php echo $this->_vars['list_buqi']['district_cn']; ?>
</span></dd>
                        </dl>
                        <?php endforeach; endif; ?>
						<?php endif; ?>						
                    </div>
                </div>
            </div>
            
            <div class="remen_list">
            	<div class="remen_listTitle remen_listTitle03"><span>����/����/����</span><a href="zhaopin/index.html" class="more">�鿴����>></a></div>
                <div class="remen_job">
                	<div class="remen_jobLeft">
                    	<ul class="job_left">
                        	<li><a href="/jobs/jobs-list.php?key=&jobcategory=1086.1087.1455">����Ա</a></li>
                            <li><a href="/jobs/jobs-list.php?key=&jobcategory=1086.1087.1456">�Ͳ�Ա</a></li>
                            <li><a href="/jobs/jobs-list.php?key=&jobcategory=1086.1087.1459" class="display_color">��ʦ</a></li>
                            <li><a href="/jobs/jobs-list.php?key=&jobcategory=1086.1087.1457">����Ա</a></li>
                            <li><a href="/jobs/jobs-list.php?key=&jobcategory=1086.1087.1461">���/���</a></li>
                            <li><a href="/jobs/jobs-list.php?key=&jobcategory=1086.1087.1462" class="display_color">ϴ�빤</a></li>
                            <li><a href="/jobs/jobs-list.php?key=&jobcategory=1086.1088.1474">��๤/����</a></li>
                            <li><a href="/jobs/jobs-list.php?key=&jobcategory=1086.1087.1470" class="display_color">ѧͽ</a></li>
                            <li><a href="/jobs/jobs-list.php?key=&jobcategory=1086.1087.1465">ӭ��/�Ӵ�</a></li>
                        </ul>
                        <ul class="job_right">
                        	<li><a href="/jobs/jobs-list.php?key=&jobcategory=1086.1088.1479">�ӵ㹤</a></li>
                            <li><a href="/jobs/jobs-list.php?key=&jobcategory=1086.1088.1482" class="display_color">��ˮ��</a></li>
                            <li><a href="/jobs/jobs-list.php?key=&jobcategory=1086.1089.1491">����ʦ</a></li>
                            <li><a href="/jobs/jobs-list.php?key=&jobcategory=1086.1089.1484" class="display_color">����ʦ</a></li>
                            <li><a href="/jobs/jobs-list.php?key=&jobcategory=1086.1090.1498">�Ƶ�ǰ̨</a></li>
                            <li><a href="/jobs/jobs-list.php?key=&jobcategory=1086.1089.1492" class="display_color">�������� </a></li>
                            <li><a href="/jobs/jobs-list.php?key=&jobcategory=1086.1090.1506">����</a></li>
                            <li><a href="/jobs/jobs-list.php?key=&jobcategory=1086.1090.1503" class="display_color">����Ա </a></li>
                            <li><a href="/jobs/jobs-list.php?key=&jobcategory=1081.1084.1439" class="max_width">���Ա/����Ա</a></li>
                        </ul>
                        <div class="clear"></div>
                    </div>
                    <div class="remen_jobRight">
                        <?php echo tpl_function_qishi_companyjobs_list(array('set' => "�б���:company,��ʾ��Ŀ:10,��ʾְλ:4,ְλ������:4,��ҵ������:32,ְλ����:1086,����:rtime>desc"), $this);?><!--�Ƽ�:1-->
                        <?php if (count((array)$this->_vars['company'])): foreach ((array)$this->_vars['company'] as $this->_vars['list']): ?>
                    	<dl>
                        	<dt><a href="<?php echo $this->_vars['list']['company_url']; ?>
" class="company_N"><?php echo $this->_vars['list']['companyname']; ?>
</a></dt>
                            <dd class="job_name"><?php if (count((array)$this->_vars['list']['jobs'])): foreach ((array)$this->_vars['list']['jobs'] as $this->_vars['jobslist']): ?><a href="<?php echo $this->_vars['jobslist']['jobs_url']; ?>
" class="company_J"><?php echo $this->_vars['jobslist']['jobs_name']; ?>
</a><?php endforeach; endif; ?></dd>
                            <dd class="job_a"><span><?php echo $this->_vars['list']['district_cn']; ?>
</span></dd>
                        </dl>
                        <?php endforeach; endif; ?>
						<?php if ($this->_vars['buqi_sta'] == '1'): ?>
						
                        <?php if (count((array)$this->_vars['company_buqi'])): foreach ((array)$this->_vars['company_buqi'] as $this->_vars['list_buqi']): ?>
                    	<dl>
                        	<dt><a href="<?php echo $this->_vars['list_buqi']['company_url']; ?>
" class="company_N"><?php echo $this->_vars['list_buqi']['companyname']; ?>
</a></dt>
                            <dd class="job_name"><?php if (count((array)$this->_vars['list_buqi']['jobs'])): foreach ((array)$this->_vars['list_buqi']['jobs'] as $this->_vars['jobslist']): ?><a href="<?php echo $this->_vars['jobslist']['jobs_url']; ?>
" class="company_J"><?php echo $this->_vars['jobslist']['jobs_name']; ?>
</a><?php endforeach; endif; ?></dd>
                            <dd class="job_a"><span><?php echo $this->_vars['list_buqi']['district_cn']; ?>
</span></dd>
                        </dl>
                        <?php endforeach; endif; ?>
						<?php endif; ?>						
                    <!--    <dl>
                        	<dt><a href="<?php echo $this->_vars['list']['company_url']; ?>
" class="company_N">����ʡ�������˲��г��������޹�˾</a></dt>
                            <dd class="job_name"><a href="<?php echo $this->_vars['jobslist']['jobs_url']; ?>
" class="company_J">��ҳ����</a><a href="<?php echo $this->_vars['jobslist']['jobs_url']; ?>
" class="company_J">��ҳ����</a><a href="<?php echo $this->_vars['jobslist']['jobs_url']; ?>
" class="company_J">��ҳ����</a><a href="<?php echo $this->_vars['jobslist']['jobs_url']; ?>
" class="company_J">��ҳ����</a><a href="<?php echo $this->_vars['jobslist']['jobs_url']; ?>
" class="company_J">��ҳ����</a></dd>
                            <dd class="job_a"><span>�Ϸ���</span></dd>
                        </dl>-->
                    </div>
                </div>
            </div>
            
            <div class="remen_list">
            	<div class="remen_listTitle remen_listTitle04"><span>����/����/��ҵ</span><a href="zhaopin/index.html" class="more">�鿴����>></a></div>
                <div class="remen_job">
                	<div class="remen_jobLeft">
                    	<ul class="job_left">
                        	<li><a href="/jobs/jobs-list.php?key=&jobcategory=1280.1282.1301">����������</a></li>
                            <li><a href="/jobs/jobs-list.php?key=&jobcategory=1280.1282.1302">ְҵ����</a></li>
                            <li><a href="/jobs/jobs-list.php?key=&jobcategory=1280.1282.1305" class="display_color">�����ͷ�</a></li>
                            <li><a href="/jobs/jobs-list.php?key=&jobcategory=1280.1282.1306">��������</a></li>
                            <li><a href="/jobs/jobs-list.php?key=&jobcategory=1280.1281.1291">��������ʦ</a></li>
                            <li><a href="/jobs/jobs-list.php?key=&jobcategory=1280.1282.1307" class="display_color">��������ʦ</a></li>
                            <li><a href="/jobs/jobs-list.php?key=&jobcategory=1280.1281.1299">�ۺϲ���</a></li>
                            <li><a href="/jobs/jobs-list.php?key=&jobcategory=1280.1281.1289" class="display_color">����ʦ</a></li>
                            <li><a href="/jobs/jobs-list.php?key=&jobcategory=1280.1281.1287">��ľ/����</a></li>
                        </ul>
                        <ul class="job_right">
                        	<li><a href="/jobs/jobs-list.php?key=&jobcategory=1280.1281.1292">��ȫԱ</a></li>
                            <li><a href="/jobs/jobs-list.php?key=&jobcategory=1280.1281.1295" class="display_color">���/����</a></li>
                            <li><a href="/jobs/jobs-list.php?key=&jobcategory=1280.1281.1285">���̼���</a></li>
                            <li><a href="/jobs/jobs-list.php?key=&jobcategory=1280.1281.1284" class="display_color">������Ŀ����</a></li>
                            <li><a href="/jobs/jobs-list.php?key=&jobcategory=1280.1283.1314">���̾���</a></li>
                            <li><a href="/jobs/jobs-list.php?key=&jobcategory=1280.1281.1297" class="display_color">����Ա </a></li>
                            <li><a href="/jobs/jobs-list.php?key=&jobcategory=1280.1283.1311">��ҵά��</a></li>
                            <li><a href="/jobs/jobs-list.php?key=&jobcategory=1280.1281.1286" class="display_color">��������ʦ </a></li>
                            <li><a href="/jobs/jobs-list.php?key=&jobcategory=1280.1283.1310">��ҵ����Ա</a></li>
                        </ul>
                        <div class="clear"></div>
                    </div>
                    <div class="remen_jobRight">
                    	
                    	<?php echo tpl_function_qishi_companyjobs_list(array('set' => "�б���:company,��ʾ��Ŀ:10,��ʾְλ:4,ְλ������:4,��ҵ������:32,ְλ����:1280,����:rtime>desc"), $this);?><!--�Ƽ�:1-->
                        <?php if (count((array)$this->_vars['company'])): foreach ((array)$this->_vars['company'] as $this->_vars['list']): ?>
                    	<dl>
                        	<dt><a href="<?php echo $this->_vars['list']['company_url']; ?>
" class="company_N"><?php echo $this->_vars['list']['companyname']; ?>
</a></dt>
                            <dd class="job_name"><?php if (count((array)$this->_vars['list']['jobs'])): foreach ((array)$this->_vars['list']['jobs'] as $this->_vars['jobslist']): ?><a href="<?php echo $this->_vars['jobslist']['jobs_url']; ?>
" class="company_J"><?php echo $this->_vars['jobslist']['jobs_name']; ?>
</a><?php endforeach; endif; ?></dd>
                            <dd class="job_a"><span><?php echo $this->_vars['list']['district_cn']; ?>
</span></dd>
                        </dl>
                        <?php endforeach; endif; ?>
						<?php if ($this->_vars['buqi_sta'] == '1'): ?>
                        <?php if (count((array)$this->_vars['company_buqi'])): foreach ((array)$this->_vars['company_buqi'] as $this->_vars['list_buqi']): ?>
                    	<dl>
                        	<dt><a href="<?php echo $this->_vars['list_buqi']['company_url']; ?>
" class="company_N"><?php echo $this->_vars['list_buqi']['companyname']; ?>
</a></dt>
                            <dd class="job_name"><?php if (count((array)$this->_vars['list_buqi']['jobs'])): foreach ((array)$this->_vars['list_buqi']['jobs'] as $this->_vars['jobslist']): ?><a href="<?php echo $this->_vars['jobslist']['jobs_url']; ?>
" class="company_J"><?php echo $this->_vars['jobslist']['jobs_name']; ?>
</a><?php endforeach; endif; ?></dd>
                            <dd class="job_a"><span><?php echo $this->_vars['list_buqi']['district_cn']; ?>
</span></dd>
                        </dl>
                        <?php endforeach; endif; ?>
						<?php endif; ?>
                    </div>
                </div>
            </div>
            <!-- ������Ƹtab --��ʼ-->
            <script type="text/javascript">jQuery(".slideTxtBox").slide(); </script>
            <!-- ������Ƹtab --����-->
        </div>
	  	<!--�в�������Ŀ����--����-->   
       
        
        <!--����ģ�鿪ʼ-->
       <?php 
       	include("/zhichang/diaoyong/shouye/zongzhan.html");
       ?>
        <!--����ģ�����-->		
        
        <div class="kuang company hezuo">
            <h2 class="mb10"><i class="fa fa-suitcase"></i>������ҵ<!--<span>���Ա��⣬���Ƿ񽡿��Ļ�����</span>--> <!--<a href="" class="more">�鿴����>></a>--></h2>
            <!--����-->
            	<div class="picMarquee-left">
                        <div class="bd">
                            <ul>
                                    
                                        <?php echo tpl_function_qishi_ad(array('set' => "��ʾ��Ŀ:30,��������:QS_indexcentreimg,�б���:ad"), $this);?>
                                        <?php if ($this->_vars['ad']): ?>
                                        <?php if (count((array)$this->_vars['ad'])): foreach ((array)$this->_vars['ad'] as $this->_vars['list']): ?>
                                        <li> 
                                            <img src="<?php echo $this->_vars['list']['img_path']; ?>
" border="0"  title="<?php echo $this->_vars['list']['img_explain']; ?>
" /> 
                                             <!-- ad end -->
                                        </li>
                                       
                                 <?php endforeach; endif; ?>
                                 <?php endif; ?>
                                 </ul>
                        </div>
                    </div>
            
 <!--------------������ҵ����-------------->             
<script type="text/javascript">jQuery(".picMarquee-left").slide({mainCell:".bd ul",autoPlay:true,effect:"leftMarquee",vis:6,interTime:50});</script>
         





    </div>
    <!--�������� ��ʼ-->
    	<div class="kuang friendlink">
        	<div class="friendlink">
            	<div class="hd">
                	<ul>
                    	<li>��������</li>
                        <li>������վ</li>
                    </ul>
                </div>
                <div class="bd">
                
                	<ul>
                    	<li>
                        	<?php echo tpl_function_qishi_link(array('set' => "�б���:link,��ʾ��Ŀ:100,��������:QS_index,����:1"), $this);?>
							<?php if (count((array)$this->_vars['link'])): foreach ((array)$this->_vars['link'] as $this->_vars['list']): ?>
            				<a href="<?php echo $this->_vars['list']['link_url']; ?>
" title="" target="_blank"><?php echo $this->_vars['list']['title']; ?>
</a>|
                            <?php endforeach; endif; ?>
                        </li>
                    </ul>
                    
                    <ul>
                    	<li>
                        	<?php echo tpl_function_qishi_link(array('set' => "�б���:link,��ʾ��Ŀ:100,��������:qs_hezuo,����:1"), $this);?>
							<?php if (count((array)$this->_vars['link'])): foreach ((array)$this->_vars['link'] as $this->_vars['list']): ?>
            				<a href="<?php echo $this->_vars['list']['link_url']; ?>
" title="" target="_blank"><?php echo $this->_vars['list']['title']; ?>
</a>|
                            <?php endforeach; endif; ?>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <script type="text/javascript">jQuery(".friendlink").slide(); </script>
    <!--�������� ����-->
    
    <!--�ײ���ʼ-->
   <?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include("footer.htm", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>
	<!--�ײ�����-->
</body>
    
</html>

                                                  