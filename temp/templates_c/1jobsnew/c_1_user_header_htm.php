<?php require_once('D:\fengmf\wwwroot\74cms_1dagong\include\template_lite\plugins\function.qishi_nav.php'); $this->register_function("qishi_nav", "tpl_function_qishi_nav",false);  /* V2.10 Template Lite 4 January 2007  (c) 2005-2007 Mark Dickenson. All rights reserved. Released LGPL. 2018-07-13 16:38 �й���׼ʱ�� */ ?>
<link href="/files/css/header.css" rel="stylesheet" type="text/css" />
<link href="/files/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
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
	    	<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include("top-nav.htm", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>
	    </div>	
	    <div class="clear"></div>
    </div>
</div>-->

<!--ͷ����ʼ-->
	<div class="header">
    	<div class="kuang">
            <div class="logo fl" style="width:150px;"><a class="fl" href="/"><img src="/files/img/logo2.jpg" alt="" title="Ҽ����" ></a>
            </div>

            <div class="nav fl">
            	<ul>
                	<!--<li><a class="yes" href="/index.html">��ҳ</a></li>
                    <li><a href="/zhaopin/index.html">�ҹ���</a></li>
                    <li><a href="/jianli.html">���˲�</a></li>
                    <li><a href="/hymq/">��ҵ����</a></li>
                    <li><a href="/jobfair/jobfair-list.php">�˲��г�</a></li>
                    <li><a href="/xiaoyuan/">У԰��Ƹ</a></li>-->
                <?php echo tpl_function_qishi_nav(array('set' => "��������:QS_top,�б���:list"), $this);?>
				<?php if (count((array)$this->_vars['list'])): foreach ((array)$this->_vars['list'] as $this->_vars['list']): ?>
				<li><a href="<?php echo $this->_vars['list']['url']; ?>
" target="<?php echo $this->_vars['list']['target']; ?>
" <?php if ($this->_vars['list']['tag'] == $this->_vars['page_select'] && $this->_vars['list']['tag'] != ""): ?>class="yes"<?php endif; ?>><?php echo $this->_vars['list']['title']; ?>
</a></li>
				<?php endforeach; endif; ?>
                </ul>
            </div>
            
          <!--<div class="login fr">
              <ul>
                  <li class="mobile"><a href="#"><i class="fa fa-mobile"></i>�ֻ�Ҽ��</a>
                      <div class="app">
                          <i class="fa fa-sort-asc"></i>
                          <img src="/files/img/app.jpg" alt="" title="Ҽ�����ͻ���" />
                      </div>
                  </li>
              </ul>
          </div>
-->            
            
      

           
              	<div class="top_nav">
            	</div>
        </div>
    </div>
    <!--ͷ������-->
