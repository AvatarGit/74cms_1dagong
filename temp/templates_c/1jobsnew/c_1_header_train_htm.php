<?php require_once('D:\fengmf\wwwroot\74cms_1dagong\include\template_lite\plugins\function.qishi_nav.php'); $this->register_function("qishi_nav", "tpl_function_qishi_nav",false);  require_once('D:\fengmf\wwwroot\74cms_1dagong\include\template_lite\plugins\function.qishi_allsite.php'); $this->register_function("qishi_allsite", "tpl_function_qishi_allsite",false);  require_once('D:\fengmf\wwwroot\74cms_1dagong\include\template_lite\plugins\modifier.default.php'); $this->register_modifier("default", "tpl_modifier_default",false);  /* V2.10 Template Lite 4 January 2007  (c) 2005-2007 Mark Dickenson. All rights reserved. Released LGPL. 2018-09-28 14:59 �й���׼ʱ�� */ ?>
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
        	<div class="add_course">
            	<a href="/user/login.php?utype=4" title="��ѵ������¼"><i class="fa fa-pencil-square-o"></i>��ѵ������¼</a>
                <a href="/user/user_reg.php?member_type=4" title="��ѵ����ע��"><i class="fa fa-user-plus"></i>��ѵ����ע��</a>
            </div>
            <div class="logo fl">
            <a class="fl" href="/"><img src="/files/img/logo.png" alt="" title="Ҽ����" ></a>
            
            <!--��ʿ�ϵĵ����л���ʼzzzzzz-->
		
				<?php if ($this->_vars['QISHI']['subsite'] == "1"): ?>
				  <div class="sub_station_bbox">
            <div class="local_station didian">
                <h3><?php echo $this->_run_modifier($this->_vars['QISHI']['subsite_districtname'], 'default', 'plugin', 1, "��վ"); ?>
</h3>
                <a>�л�վ��</a>
            </div>

	  <?php echo tpl_function_qishi_allsite(array('set' => "�б���:list"), $this);?>
	  <?php if ($this->_vars['list']): ?>
        
            <div class="sub_station" style="display:none;" data="hide">
                <div class="triangle"></div>
                <span href="" class="station_close"></span>
                <div class="sub_st_box">
                    <div class="sub_st_tit">
                        <h3><?php echo $this->_vars['QISHI']['site_name']; ?>
վȺ �� <a href="http://www.1dagong.com/index.html">��վ</a></h3>
                    </div>
                    <div class="sub_st_content">
                        <ul>
                            
                            <?php if (count((array)$this->_vars['list'])): foreach ((array)$this->_vars['list'] as $this->_vars['ln']): ?>
                                <li>
                                        <span><?php echo $this->_run_modifier($this->_vars['ln']['key'], 'rtrim', 'PHP', 1, ' - '); ?>
</span>
                                            <div class="city_list">
                                            <?php if (count((array)$this->_vars['ln']['city'])): foreach ((array)$this->_vars['ln']['city'] as $this->_vars['ci']): ?>
                                            <a href="<?php echo $this->_vars['ci']['url']; ?>
"><?php echo $this->_vars['ci']['name']; ?>
</a>
                                            <?php endforeach; endif; ?>
                                                <div class="clear"></div>
                                            <div>
                                </li>	
                            <?php endforeach; endif; ?>
                        </ul>
                    </div>
                </div>
            </div>	
        </div>
<?php endif; ?>
	<?php endif; ?>
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
				<?php echo tpl_function_qishi_nav(array('set' => "��������:QS_top,�б���:list"), $this);?>
				<?php if (count((array)$this->_vars['list'])): foreach ((array)$this->_vars['list'] as $this->_vars['list']): ?>
					<li><a href="<?php echo $this->_vars['list']['url']; ?>
" target="<?php echo $this->_vars['list']['target']; ?>
" <?php if ($this->_vars['list']['tag'] == $this->_vars['page_select'] && $this->_vars['list']['tag'] != ""): ?>class="yes"<?php endif; ?>><?php echo $this->_vars['list']['title']; ?>
</a></li>
				<?php endforeach; endif; ?>
				<!--�����˵��л�����ʽ��λ���� By Z-->
                </ul>
            </div>
            
            <div class="top_nav">
            </div>
            
        </div>
    </div>
    <!--ͷ������-->
