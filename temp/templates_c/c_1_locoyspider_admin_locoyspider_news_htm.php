<?php require_once('D:\fengmf\wwwroot\74cms_1dagong\include\template_lite\plugins\function.qishi_news_property.php'); $this->register_function("qishi_news_property", "tpl_function_qishi_news_property",false);  /* V2.10 Template Lite 4 January 2007  (c) 2005-2007 Mark Dickenson. All rights reserved. Released LGPL. 2018-07-09 15:14 �й���׼ʱ�� */  $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include("sys/admin_header.htm", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>
<div class="admin_main_nr_dbox">
 <div class="pagetit">
	<div class="ptit"> <?php echo $this->_vars['pageheader']; ?>
</div>
	<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include("locoyspider/admin_locoyspider_nav.htm", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>
  <div class="clear"></div>
</div>
    <div class="toptip">
	<h2>��ʾ��</h2>
	<p>��ͷ�ɼ������뵽��̳���أ�</p>
	</div>
	
   <form action="?act=set_save" method="post"  name="form1" id="form1">
   <?php echo $this->_vars['inputtoken']; ?>

  <div class="toptit">��Ѷ�ɼ�����</div>
    <table width="700" border="0" cellspacing="5" cellpadding="1" style=" margin-bottom:3px; margin-top:10px;">
      <tr>
        <td width="180" align="right">Ĭ����ʾ״̬��</td>
        <td ><label >
          <input name="article_display" type="radio" id="article_display" value="1"  <?php if ($this->_vars['show']['article_display'] == "1"): ?>checked="checked"<?php endif; ?>/>
          ��ʾ</label>
          &nbsp;&nbsp;&nbsp;&nbsp;
          <label  >
            <input type="radio" name="article_display" value="0" id="article_display"  <?php if ($this->_vars['show']['article_display'] == "0"): ?>checked="checked"<?php endif; ?>/>
            ����ʾ </label></td>
      </tr>
      <tr>
        <td align="right">Ĭ�����ԣ�</td>
        <td>
		<?php echo tpl_function_qishi_news_property(array('set' => "�б���:property"), $this);?>
		<?php if (count((array)$this->_vars['property'])): foreach ((array)$this->_vars['property'] as $this->_vars['list']): ?>
		 <label>
          <input name="article_focos" type="radio" value="<?php echo $this->_vars['list']['id']; ?>
" <?php if ($this->_vars['list']['id'] == $this->_vars['show']['article_focos']): ?> checked="checked"<?php endif; ?> />
<?php echo $this->_vars['list']['categoryname']; ?>

 </label>
<?php endforeach; endif; ?>
		</td>
      </tr>
      <tr>
        <td align="right">&nbsp;</td>
        <td height="50"><span style="font-size:14px;">
          <input name="submit222" type="submit" class="admin_submit"    value="�����޸�"/>
        </span></td>
      </tr>
    </table>
	</form>
</div>
<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include("sys/admin_footer.htm", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>
</body>
</html>