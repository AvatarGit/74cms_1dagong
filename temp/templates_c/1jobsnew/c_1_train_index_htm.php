<?php require_once('D:\fengmf\wwwroot\74cms_1dagong\include\template_lite\plugins\modifier.date_format.php'); $this->register_modifier("date_format", "tpl_modifier_date_format",false);  require_once('D:\fengmf\wwwroot\74cms_1dagong\include\template_lite\plugins\function.qishi_curriculum_list.php'); $this->register_function("qishi_curriculum_list", "tpl_function_qishi_curriculum_list",false);  require_once('D:\fengmf\wwwroot\74cms_1dagong\include\template_lite\plugins\function.qishi_ad.php'); $this->register_function("qishi_ad", "tpl_function_qishi_ad",false);  require_once('D:\fengmf\wwwroot\74cms_1dagong\include\template_lite\plugins\function.qishi_get_classify.php'); $this->register_function("qishi_get_classify", "tpl_function_qishi_get_classify",false);  require_once('D:\fengmf\wwwroot\74cms_1dagong\include\template_lite\plugins\function.qishi_pageinfo.php'); $this->register_function("qishi_pageinfo", "tpl_function_qishi_pageinfo",false);  /* V2.10 Template Lite 4 January 2007  (c) 2005-2007 Mark Dickenson. All rights reserved. Released LGPL. 2018-09-28 14:59 �й���׼ʱ�� */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<?php echo tpl_function_qishi_pageinfo(array('set' => "�б���:page,����:QS_train"), $this);?>
<title><?php echo $this->_vars['page']['title']; ?>
</title>
<link rel="shortcut icon" href="favicon.ico" />
<meta name="description" content="">
<meta name="keywords" content="">
<link href="/files/css/common.css" rel="stylesheet" type="text/css" />
<link href="/files/css/font-awesome.min.css" rel="stylesheet" >
<link href="/files/css/reg.css" rel="stylesheet" type="text/css" />
<link href="/files/css/peixun/peixun.css" type="text/css"  rel="stylesheet">

<!---->
<link href="/files/css/header.css" rel="stylesheet" type="text/css" />
<!---->
<script type="text/javascript" src="/files/js/jquery.min.js"></script>
<script type="text/javascript" src="/files/js/jquery.SuperSlide.2.1.1.js"></script>
</head>
<body>
<!--ͷ����ʼ-->
<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include("header_train.htm", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>
<!--ͷ������-->

<!-- ��ѵ��ҳ��ʼ -->
<div class="peixun_index">
    <div id="menu"class="peixun_indexLeft">
    	<?php echo tpl_function_qishi_get_classify(array('set' => "�б���:category,����:QS_train,��ʾ��Ŀ:4"), $this);?>
		<?php if (count((array)$this->_vars['category'])): foreach ((array)$this->_vars['category'] as $this->_vars['list']): ?>
        <dl class="kecheng_name">
            <dt><?php echo $this->_vars['list']['categoryname']; ?>
</dt>
            <?php echo tpl_function_qishi_get_classify(array('set' => "�б���:sublist,����:QS_train,id:" . $this->_vars['list']['id'] . ",��ʾ��Ŀ:12"), $this);?>
			<?php if (count((array)$this->_vars['sublist'])): foreach ((array)$this->_vars['sublist'] as $this->_vars['listtrain']): ?>
            <dd><a href="/train/train-curriculum-list.php?category=<?php echo $this->_vars['listtrain']['id']; ?>
" target="_blank" title=""><?php echo $this->_vars['listtrain']['categoryname']; ?>
</a></dd>
            <?php endforeach; endif; ?>
        </dl>
        <?php endforeach; endif; ?>
		<!--<div class="fabu">
        	<a href="/user/train/train_course.php?act=addcourse" target="_blank" class="fabu-01">�����̳�</a>
            <a href="/user/user_reg.php?member_type=4" target="_blank" class="fabu-01">ѧУע��</a>
        </div>-->
    </div>
    
    <!--ҳ��̶�-->
	<script>
            $(function(){
                $("#menu").data({offset:$("#menu").offset()});
                $(window).bind("scroll",function(){
                    var menu=$("#menu");
                    var dtop=$(document).scrollTop();
                    var offset=menu.data("offset");
                    if(dtop>offset.top){
                        if($.browser.msie&&parseInt($.browser.version)<7){//IE6
                            menu.css({position:"absolute",top:dtop});
                        }else{
                            menu.css({position:"fixed",top:0,});
                        }
                    }else{
                        menu.css({left:"",top:"",position:""});
                    }
                });
            });
        </script>
       <!--ҳ��̶�-->
    <div class="peixun_indexRight">
    	<div class="slideBox banner">
            <div class="bd">
                <ul>
                	<?php echo tpl_function_qishi_ad(array('set' => "��ʾ��Ŀ:5,��������:QS_trainfocus,�б���:ad"), $this); if (count((array)$this->_vars['ad'])): foreach ((array)$this->_vars['ad'] as $this->_vars['list']): ?>
                    <li><a href="<?php echo $this->_vars['list']['img_url']; ?>
" target="_blank"><img src="<?php echo $this->_vars['list']['img_path']; ?>
" title="<?php echo $this->_vars['list']['img_explain']; ?>
" width="750" height="280" ></a></li>
                    <?php endforeach; endif; ?>
                    <!--<li><a href="" target="_blank"><img src="../files/img/banner01.jpg" width="750" height="280" ></a></li>-->
                </ul>
            </div>
            <a href="javascript:void(0)" title="" class="pre"></a>
            <a href="javascript:void(0)" title="" class="next"></a>
        </div>
        <!-- �ֲ�  -->
        <script type="text/javascript">
            jQuery(".slideBox").slide({mainCell:".bd ul",effect:"fold",autoPlay:true,easing:"easeOutCirc"});
        </script>
   	
        <div class="search">
            <div class="form_search">
                    <input type="text" id="keyinput" name="key" class="text01" ><input type="button" id="search_btn" class="btn-search" value="����">
            </div>
            <div class="search_title">
                <ul>
                    <li>����������</li>
                    <li><a href="/train/train-curriculum-list.php?category=11" target="_blank" title="IT��ѵ">IT��ѵ</a> </li>
                    <li><a href="/train/train-curriculum-list.php?category=14" target="_blank" title="������ѵ" class="search-red">������ѵ</a> </li>
                    <li><a href="/train/train-curriculum-list.php?category=3" target="_blank" title="����">����</a> </li>
                    <li><a href="/train/train-curriculum-list.php?category=10" target="_blank" title="����" class="search-red">����</a> </li>
                    <li><a href="/train/train-curriculum-list.php?category=23" target="_blank" title="����ʸ�֤">����ʸ�֤</a> </li>
                    <li><a href="/train/train-curriculum-list.php?category=7" target="_blank" title="ҽҩ����" class="search-red">ҽҩ����</a> </li>
                    <li><a href="/train/train-curriculum-list.php?category=21" target="_blank" title="��ľ����">��ľ����</a> </li>
                    <!--<li><a href="/train/train-curriculum-list.php?category=29" target="_blank" title="����" class="search-red">����</a> </li>-->
                </ul>
            </div>
        </div>        
        <div class="find-kec">
            <div class="peixun-course-title"><span>��Уչʾ</span>�����ȫ����У������רҵ���ܡ�<!--<a href="" title="" target="_blank" class="more">�鿴����</a>--></div>
            <div class="slideTxtBox">
               <!-- <div class="hd find-kec-title">
                    <ul>
                        <li>���¿γ�</li>
                        <li>������Դ</li>
                        <li>�������</li>
                        <li>��������</li>
                        <li>�ܲÿ���</li>
                        <li>ְҵ����</li>
                        <li>�г�Ӫ��</li>
                        <li>�ͻ�����</li>
                        <li>�ɹ�����</li>
                    </ul>
                </div>-->
                <div class="bd find-kec-box">
                    <dl>
                    	<?php echo tpl_function_qishi_ad(array('set' => "��ʾ��Ŀ:7,��������:QS_traincentreimg,�б���:ad,����:show_order>desc"), $this); if (count((array)$this->_vars['ad'])): foreach ((array)$this->_vars['ad'] as $this->_vars['list']): ?>
                        <?php if ($this->_vars['list']['i'] == 1): ?>
                        <dt><a href="<?php echo $this->_vars['list']['img_url']; ?>
" target="_blank" title="<?php echo $this->_vars['list']['img_explain']; ?>
"><img src="<?php echo $this->_vars['list']['img_path']; ?>
" title="<?php echo $this->_vars['list']['img_explain']; ?>
" width="280" height="267" alt=""/><br><?php echo $this->_vars['list']['img_explain']; ?>
</a> </dt>
                        <?php else: ?>
                        <dd class="overflow"><a href="<?php echo $this->_vars['list']['img_url']; ?>
" target="_blank" title="<?php echo $this->_vars['list']['img_explain']; ?>
" class="overflow"><img src="<?php echo $this->_vars['list']['img_path']; ?>
" title="<?php echo $this->_vars['list']['img_explain']; ?>
" width="140" height="111" alt=""/><br><?php echo $this->_vars['list']['img_explain']; ?>
</a></dd>
                        <?php endif; ?>
                        <?php endforeach; endif; ?>
                    </dl>
                   <!-- <dl>
                        <dt><a href="" target="_blank" title=""><img src="../files/img/1bc62bdd582244bcb27b626c17083e57_224.jpg" width="280" height="267" alt=""/><br>��ģʽռ���г���������ֵ����ҵ��4����</a> </dt>
                        <dd><a href="" target="_blank" title=""><img src="../files/img/1289_353_279.jpg" width="140" height="111" alt=""/><br>���Źܿ���ս�Բ�...</a></dd>
                        <dd><a href="" target="_blank" title=""><img src="../files/img/1289_353_279.jpg" width="140" height="111" alt=""/><br>���Źܿ���ս�Բ�...</a></dd>
                        <dd><a href="" target="_blank" title=""><img src="../files/img/1289_353_279.jpg" width="140" height="111" alt=""/><br>���Źܿ���ս�Բ�...</a></dd>
                        <dd><a href="" target="_blank" title=""><img src="../files/img/1289_353_279.jpg" width="140" height="111" alt=""/><br>���Źܿ���ս�Բ�...</a></dd>
                        <dd><a href="" target="_blank" title=""><img src="../files/img/1289_353_279.jpg" width="140" height="111" alt=""/><br>���Źܿ���ս�Բ�...</a></dd>
                        <dd><a href="" target="_blank" title=""><img src="../files/img/1289_353_279.jpg" width="140" height="111" alt=""/><br>���Źܿ���ս�Բ�...</a></dd>
                    </dl>-->
                </div>
            </div>
            <!-- �л�Ч�� -->
            <script type="text/javascript">
                jQuery(".slideTxtBox").slide({});
            </script>
        </div>
       <!-- <div class="peixun-xt">
            <div class="peixun-course-title"><span>��λϵͳ��</span>������ɸѡ������Ҫ�Ŀγ̣�ȫ���������ְ��������</div>
            <div class="peixun-xt-box">
                <div class="fl peixun-xt-list">
                   <a href="" target="_blank" title="">
                       <strong>�İ�</strong>ϵͳ��<br>
                       ���ٰ�˼���ý�-���������Ȫӿ
                   </a>
                </div>
                <div class="fl peixun-xt-list peixun-xt-list-color02">
                    <a href="" target="_blank" title="">
                        <strong>EXCEL</strong>ϵͳ��<br>
                        һ�ݱ�����Ϯ֮��
                    </a>
                </div>
                <div class="fl peixun-xt-list peixun-xt-list-color03">
                    <a href="" target="_blank" title="">
                        <strong>PPT</strong>ϵͳ��<br>
                        ����һ�ݷ����쵼��ˮ��PPT
                    </a>
                </div>
                <div class="fl peixun-xt-list peixun-xt-list-color03">
                    <a href="" target="_blank" title="">
                        <strong>�쵼��</strong>ϵͳ��<br>
                        �쵼��������-��˵һ����
                    </a>
                </div>
                <div class="fl peixun-xt-list">
                    <a href="" target="_blank" title="">
                        <strong>΢Ӫ������</strong>ϵͳ��<br>
                        ΢Ӫ��ʵ�ִ�����
                    </a>
                </div>
                <div class="fl peixun-xt-list peixun-xt-list-color02">
                    <a href="" target="_blank" title="">
                        <strong>ְҵ�滮</strong>ϵͳ��<br>
                        ı������-�����滮���ְ������
                    </a>
                </div>
                <div class="over"></div>
            </div>
        </div>-->
        <!--<div class="peixun-xt">
            <div class="peixun-course-title"><span>����ϵͳ��</span>������ɸѡ������Ҫ�Ŀγ̣�ȫ���������ְ��������</div>
            <div class="peixun-xt-box">
                <div class="fl peixun-xt-list">
                    <a href="" target="_blank" title="">
                        <strong>�İ�</strong>ϵͳ��<br>
                        ���ٰ�˼���ý�-���������Ȫӿ
                    </a>
                </div>
                <div class="fl peixun-xt-list peixun-xt-list-color02">
                    <a href="" target="_blank" title="">
                        <strong>�İ�</strong>ϵͳ��<br>
                        ���ٰ�˼���ý�-���������Ȫӿ
                    </a>
                </div>
                <div class="fl peixun-xt-list peixun-xt-list-color03">
                    <a href="" target="_blank" title="">
                        <strong>�İ�</strong>ϵͳ��<br>
                        ���ٰ�˼���ý�-���������Ȫӿ
                    </a>
                </div>
                <div class="fl peixun-xt-list peixun-xt-list-color03">
                    <a href="" target="_blank" title="">
                        <strong>�İ�</strong>ϵͳ��<br>
                        ���ٰ�˼���ý�-���������Ȫӿ
                    </a>
                </div>
                <div class="fl peixun-xt-list">
                    <a href="" target="_blank" title="">
                        <strong>�İ�</strong>ϵͳ��<br>
                        ���ٰ�˼���ý�-���������Ȫӿ
                    </a>
                </div>
                <div class="fl peixun-xt-list peixun-xt-list-color02">
                    <a href="" target="_blank" title="">
                        <strong>�İ�</strong>ϵͳ��<br>
                        ���ٰ�˼���ý�-���������Ȫӿ
                    </a>
                </div>
                <div class="over"></div>
            </div>
        </div>-->
        <div class="peixun-course">
            <div class="peixun-course-title"><span>��ѵ�γ�</span>�������γ̣�����һ���ʺ��㡿<a href="/train/train-curriculum-list.php?key=&page=1" title="" target="_blank" class="more">�鿴����</a></div>
            <div class="peixun-course-box">
                <ul>
                <?php echo tpl_function_qishi_curriculum_list(array('set' => "�б���:course,��ַ�:...,�γ�������:18,��ҳ��ʾ:0,��ʾ��Ŀ:50,�б�ҳ:QS_train_agency_curriculum,����������:7,����:rtime>desc"), $this);?>
			  	<?php if (count((array)$this->_vars['course'])): foreach ((array)$this->_vars['course'] as $this->_vars['list']): ?>
                    <li>
                        <dl>
                            <dt class="overflow"><a href="<?php echo $this->_vars['list']['course_url']; ?>
" target="_blank" title="<?php echo $this->_vars['list']['course_name']; ?>
"><?php echo $this->_vars['list']['course_name']; ?>
</a>(<?php echo $this->_vars['list']['trainname']; ?>
) </dt>
                            <dd>
                                ����ʱ�䣺<span><?php echo $this->_run_modifier($this->_vars['list']['addtime'], 'date_format', 'plugin', 1, "%Y-%m-%d"); ?>
</span>
                            </dd>
                            <dd class="overflow">
                                �γ�ѧʱ��<span><?php echo $this->_vars['list']['classhour']; ?>
 ��ʱ</span>
                            </dd>
                            <dd class="overflow">
                                ����ʱ�䣺<span class="course-color"><?php if ($this->_vars['list']['starttime'] == 0): ?>���꿪��<?php else:  echo $this->_run_modifier($this->_vars['list']['starttime'], 'date_format', 'plugin', 1, "%Y-%m-%d");  endif; ?></span>
                            </dd>
                            <dd class="overflow">
                                ��ֹ���ڣ�<span class="course-color"><?php echo $this->_run_modifier($this->_vars['list']['deadline'], 'date_format', 'plugin', 1, "%Y-%m-%d"); ?>
</span>
                            </dd>
                            <dd class="overflow">
                                ���ڵ�����<span><?php echo $this->_vars['list']['district_cn']; ?>
</span>
                            </dd>
                            <dd  class="overflow">
                                ��ѵ����<span><?php echo $this->_vars['list']['train_object']; ?>
</span>
                            </dd>
                        </dl>
                    </li>
                   	<?php endforeach; endif; ?> 
                   
                </ul>
            </div>
        </div>
    </div>
    <div class="over"></div>
</div>
<!-- ��ѵ��ҳ���� -->

<!--footer��ʼ-->

<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include("footer.htm", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>

<!--footer����-->
<script type="text/javascript">
				showmenu('#typeid_cn','#trainshowdiv',"#typeid");
				$("#search_btn").click(function() {
					 var patrn1=/^(������ؼ���)/i;	 
					 var key1=$("#keyinput").val();
					if (patrn1.exec(key1))
					{
						 $(this).css('color','#000000').val('');
						 $("#keyinput").val('');
						 key1='';
					}
				$.get("/plus/ajax_search_location.php", {"act":"QS_train_curriculum","key":key1,"category":$("#typeid").val(),"page":1},
						function (data,textStatus)
						 {
							 window.location.href=data;
						 }
					);
				});
				//ģ��select
				function showmenu(menuID,showID,inputname)
				{
					$(menuID).click(function(){
						$(menuID).blur();
						$(menuID).parent("div").css("position","relative");
						$(showID).slideToggle("fast");
						//���ɱ���
						$(menuID).parent("div").before("<div class=\"menu_bg_layer\"></div>");
						$(".menu_bg_layer").height($(document).height());
						$(".menu_bg_layer").css({ width: $(document).width(), position: "absolute", left: "0", top: "0" , "z-index": "0", "background-color": "#ffffff"});
						$(".menu_bg_layer").css("opacity","0");
						//���ɱ�������
						$(showID+" li").live("click",function(){
							$(menuID).val($(this).attr("title"));
							$(inputname).val($(this).attr("id"));
							$(".menu_bg_layer").hide();
							$(showID).hide();
							$(menuID).parent("div").css("position","");	
							$(this).css("background-color","");
						});

								$(".menu_bg_layer").click(function(){
									$(".menu_bg_layer").hide();
									$(showID).hide();
									$(menuID).parent("div").css("position","");
								});
						$(showID+" li").unbind("hover").hover(
						function()
						{
						$(this).css("background-color","#F5F5F5");
						},
						function()
						{
						$(this).css("background-color","");

						}
						);
					});
				}
			</script>
</body>
</html>