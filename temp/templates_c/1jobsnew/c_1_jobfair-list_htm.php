<?php require_once('D:\fengmf\wwwroot\74cms_1dagong\include\template_lite\plugins\modifier.qishi_url.php'); $this->register_modifier("qishi_url", "tpl_modifier_qishi_url",false);  require_once('D:\fengmf\wwwroot\74cms_1dagong\include\template_lite\plugins\modifier.date_format.php'); $this->register_modifier("date_format", "tpl_modifier_date_format",false);  require_once('D:\fengmf\wwwroot\74cms_1dagong\include\template_lite\plugins\function.qishi_jobfair_list.php'); $this->register_function("qishi_jobfair_list", "tpl_function_qishi_jobfair_list",false);  require_once('D:\fengmf\wwwroot\74cms_1dagong\include\template_lite\plugins\modifier.default.php'); $this->register_modifier("default", "tpl_modifier_default",false);  /* V2.10 Template Lite 4 January 2007  (c) 2005-2007 Mark Dickenson. All rights reserved. Released LGPL. 2018-09-28 14:59 �й���׼ʱ�� */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head >
    <meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
    <meta name="robots" content="noodp,noydir" />
    <meta http-equiv="Content-Language" content="zh-CN" />
    <title><?php echo $this->_run_modifier($this->_vars['QISHI']['subsite_districtname'], 'default', 'plugin', 1, ''); ?>
������Ƹ��|<?php echo $this->_run_modifier($this->_vars['QISHI']['subsite_districtname'], 'default', 'plugin', 1, ''); ?>
2015��Ƹ��|<?php echo $this->_run_modifier($this->_vars['QISHI']['subsite_districtname'], 'default', 'plugin', 1, ''); ?>
�˲��г���Ƹ����Ϣ - <?php echo $this->_vars['QISHI']['site_name']; ?>
</title>
	<meta name="keywords" content="<?php echo $this->_run_modifier($this->_vars['QISHI']['subsite_districtname'], 'default', 'plugin', 1, ''); ?>
��Ƹ��<?php echo $this->_run_modifier($this->_vars['QISHI']['subsite_districtname'], 'default', 'plugin', 1, ''); ?>
��Ƹ�ᣬ<?php echo $this->_run_modifier($this->_vars['QISHI']['subsite_districtname'], 'default', 'plugin', 1, ''); ?>
�ֳ���Ƹ�ᣬ2015<?php echo $this->_run_modifier($this->_vars['QISHI']['subsite_districtname'], 'default', 'plugin', 1, ''); ?>
��Ƹ��" />
	<meta name="description" content="<?php echo $this->_run_modifier($this->_vars['QISHI']['subsite_districtname'], 'default', 'plugin', 1, ''); ?>
�ֳ���Ƹ��Ϊ���ṩ����<?php echo $this->_run_modifier($this->_vars['QISHI']['subsite_districtname'], 'default', 'plugin', 1, ''); ?>
��Ƹ,�Լ��Ϻ�,����,����,�ȵ��˲��г���Ƹ����Ϣ��2015<?php echo $this->_run_modifier($this->_vars['QISHI']['subsite_districtname'], 'default', 'plugin', 1, ''); ?>
��Ƹ��ʱ�䡢�ص����Ϣ,Ϊ��ҵ��Ƹ����ְ���ҹ����ṩ�����Ƹ��Ϣ��" />
	<meta http-equiv="X-UA-Compatible" content="IE=7">
	<meta name="author" content="Ҽ����" />
	<link href="/files/css/all_02.css" rel="stylesheet" type="text/css" />
	<!-- //��Ա��¼ -->
	<link rel="stylesheet" type="text/css" href="/files/zhaopin/zp_index.css" />
<link href="../files/css/font-awesome.min.css" rel="stylesheet" >
<!--	<script language="javascript" type="text/javascript" src="/files/js/jquery-1.2.6.min.js"></script>-->

<!---->
<link href="/files/css/all.css" rel="stylesheet" type="text/css" />
<link href="/files/css/company.css" rel="stylesheet" type="text/css" />
<script src="/files/js/jquery.js" type="text/javascript" language="javascript"></script>
<link rel="stylesheet" type="text/css" href="/files/css/common.css" />
<!---->


<!--<script type="text/javascript"> //��ά�뵯����Ч
	$(function(){
		$('.yyue_button').click(function() {
		alert("1111zwl");
			$.get("../ewm.php", {"id":"1085"}, function(data) {
			alert(data+"zwl");
				$('#imgUrl').attr('src', data);
			});
		});
	});
	$(function(){
		$(".yyue_button").click(function(){
			$(this).parent(".yd").siblings(".QRcode").show();
		});
		$(".yyue_close").click(function(){
			$(this).parents(".QRcode").hide();
		});
	});
</script>-->
	
<body>

<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include("header.htm", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>


<div class="centertop">
		
	</div>

<div class="centercon">

	<?php if ($this->_vars['subsite_id'] == 0): ?>


		<div id="zparea">
		  <div id="side">��Ԥ���������˲��г���Ƹ��ĵ�����</div>
		  <div id="side1">
			<a class="tooltips" href="#">2015��Ƹ����֪

					<span>
						<P>����<strong>2015��Ƹ����֪</strong></P>
						<P>����<strong>��ְ����֪��</strong></P>
						<P>����1����ְ�߾�����ѽ�����Ƹ���ֳ��ҹ�����</P>
						<P>����2����ְ�߱����ʵ���ţ�����ʱӦ�ṩ��ʵ�ĸ��˼�����׼�����֤��ѧ��֤�顢�ʸ�֤�顢����֤���֤�����ϣ�</P>
						<P>����3���˲��г����Ű���Ƹ���ֳ���Ƹ�ĵ�λ�������˲��г��ϸ���ˣ�ӦƸ�߿ɵ绰��ϵ���ֳ�ֱ��Ǣ̸���κ�δ���ʸ���˵ĵ�λ�������˲��г�����Ƹ������ӦƸ���ϵ���ƭ��</P>
						<P>����<strong>��Ƹ��ҵ��֪��</strong></P>
						<P>����1�������˲��г����ֳ���Ƹ�ĵ�λ���밴Ҫ���ṩ������ϣ����ʸ���˰����������󷽿ɽ�����Ƹ��</P>
						<P>����2��Ϊ���س���ԭ����Ƹ��λ���÷��������Ƹ��Ϣ�����þ������ѷ�����Ƹ��Ϣ��Ӧ��ӦƸ��Ա����ְ���ϣ�</P>
						<P>����3����ҵ��Ƹ�˲ţ��������κ���ʽ����ְ����ȡ�����ѡ���Ƹ�ѡ���ѵ�ѡ���֤����κη��ã����ÿ�Ѻ��ְ�ߵ����֤��ѧ��֤����֤����</P>
						<P>����4��Ϊά����ְ�ߵĸ���Ȩ�漰��Ϣ��ȫ����ҵ�������Ʊ�����ʹ����ְ�ߵ�������ϣ��������⽫��ְ����ϵ�绰��סַ��ת�����ˣ�</P>
						<P>����5����Ƹ��λ����ָ����չλ��չ������������չλ�ⷢ���κ���Ƹ�������ϡ�</P>
					</span>

				</a>
			</div>
			<div id="main">
				<ul>
					<li><a href="?dqid=1" >���պϷ�</a></li>
					<li><a href="?dqid=5" >�Ϻ�</a></li>
					<li><a href="?dqid=8" >����</a></li>
				</ul>

			</div>
		</div>

	<?php endif; ?>


	
	
	
	
	<div class="contents">
		<div class="titleh"><h3>������Ƹ��</h3></div>
		<?php echo tpl_function_qishi_jobfair_list(array('set' => "�б���:jobfair,��ʾ��Ŀ:10,���ⳤ��:35,��ҳ��ʾ:1,���ⳤ��:35,��ַ�:..."), $this);?>
		<?php if (count((array)$this->_vars['jobfair'])): foreach ((array)$this->_vars['jobfair'] as $this->_vars['list']): ?> 				  
		<div class="jobfair">
			<div class="barleft">
				<p class="week"><?php echo $this->_run_modifier($this->_vars['list']['holddates'], 'date_format', 'plugin', 1, "%Y��%m��"); ?>
</p>
				<p class="date"><?php echo $this->_run_modifier($this->_vars['list']['holddates'], 'date_format', 'plugin', 1, "%d"); ?>
<span>��</span></p>
				<p class="wbottom"><?php echo $this->_vars['list']['holddates_week']; ?>
</p>
			</div>

			<div class="barright">
				<p <?php if ($this->_vars['list']['predetermined_ok'] == "1" && $this->_vars['list']['predetermined_web'] == "1"): ?> 
	class="yd"
	<?php else: ?>
	class="ydover"
<?php endif; ?>><?php if ($this->_vars['list']['predetermined_ok'] == "1" && $this->_vars['list']['predetermined_web'] == "1"): ?>
<a  title="��ְԤԼ" class="right yyue_button" id="<?php echo $this->_vars['list']['id']; ?>
"></a>
	<?php endif; ?>
<a <?php if ($this->_vars['list']['predetermined_ok'] == "1" && $this->_vars['list']['predetermined_web'] == "1"): ?> href="<?php echo $this->_run_modifier("QS_user,1", 'qishi_url', 'plugin', 1); ?>
company_jobfair.php?act=jobfair" title="�������ҵ��Ա����Ԥ��չλ"<?php else: ?>title="��ֹͣ����Ԥ��չλ" href="javascript:void(null);" <?php endif; ?>></a>
<!--<a  title="����ԤԼ" class="right yyue_button"></a>-->
</p>
			<div class="QRcode" style="display:none;" id="changeBox001"><!--�����ǵ�����ʼ     href="../ewm.php?id=<?php echo $this->_vars['list']['id']; ?>
"-->
					<div class="QRcode_main"> 
						<h3><span class="weixin">΢��</span>ɨ�뼴�����ԤԼ����</h3>   
						<img src="" class="changeImg" alt="" id="img001" />
					</div>
					<a class="yyue_close" title="�ر�"></a>
					<div class="QRcode_zhe"></div>
				</div><!--�����ǵ�������-->                
				<p class="xq"><a href="<?php echo $this->_vars['list']['url']; ?>
&dqid=<?php echo $this->_vars['dqid']; ?>
" target="_blank"></a></p>

			</div>

			<div class="jobfairlist">
				<dl>
					<dt><h2><a href="<?php echo $this->_vars['list']['url']; ?>
&dqid=<?php echo $this->_vars['dqid']; ?>
" target="_blank"><span style="color:#00f;font-weight:bold;"><?php echo $this->_vars['list']['title']; ?>
</span></a></h2></dt>
					<dd><span>��ҵ���⣺</span><?php echo $this->_vars['list']['industry']; ?>
</dd>
					<dd><span>�᳡��ַ��</span><?php echo $this->_vars['list']['address']; ?>
</dd>
					<dd><span>�˳���·��</span><?php echo $this->_vars['list']['bus']; ?>
</dd>
					<dd><span>�ٰ����ڣ�</span><?php echo $this->_run_modifier($this->_vars['list']['holddates'], 'date_format', 'plugin', 1, "%Y��%m��%d��"); ?>
</dd>
					<dd><span>�����绰��</span><?php echo $this->_vars['list']['phone']; ?>
</dd>
					<?php if ($this->_vars['list']['subsite_id'] != 8): ?>
					<dd><span>��&nbsp;Ԥ&nbsp;����</span><?php echo $this->_vars['list']['yiyuding']; ?>
��չλ<span style="margin-left:30px;">δԤ����</span><?php echo $this->_vars['list']['weiyuding']; ?>
��չλ</dd>
					<?php else: ?>
					<dd style="font-size:18px;"><span>��Ԥ����ҵ��</span><?php echo $this->_vars['list']['yiyuding']; ?>
��<span></dd>
					<?php endif; ?>
									</dl>

			</div>
		</div>
		<?php endforeach; endif; ?>		  
				  
				  
 
	
		  
		
		
		
		  


	</div>
	<table border="0" align="center" cellpadding="0" cellspacing="0" class="link_bk">
          <tr>
                        <td><?php if ($this->_vars['page']): ?><div class="page link_bk"><?php echo $this->_vars['page']; ?>
</div><?php endif; ?></td>
                    </tr>
      </table> 		
<script type="text/javascript">
					$(function(){
						$(".yyue_button").unbind().click(function() {
							$.get('../ewm.php', {"id":$(this).attr("id")}, function(data) {
								$("#img001").attr('src', data);//�ѷ��صĵ�ַ����ӵ�#changeImgͼƬsrc��ַ��
								$("#changeBox001").show();//��ʾ��ά��
							});	
						});
						$(".yyue_close").click(function(){
							$(this).parents(".QRcode").hide();
						});
					})
                	

</script>	
				
	
	
				
	
	
	
	
	
	
	
	
	
	
<script language="javascript">

function nTabs(thisObj,Num){
	if(thisObj.className == "active")return;
	var tabObj = thisObj.parentNode.id;
	var tabList = document.getElementById(tabObj).getElementsByTagName("li");
	for(i=0;i <tabList.length;i++){
		if (i == Num){
			thisObj.className = "t";
			document.getElementById(tabObj+"_Content"+i).style.display = "block";
		}
		else{
			tabList[i].className = "f";
			document.getElementById(tabObj+"_Content"+i).style.display = "none";
		}
	}
}
</script>

<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include("footer.htm", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>




</body>
</html>