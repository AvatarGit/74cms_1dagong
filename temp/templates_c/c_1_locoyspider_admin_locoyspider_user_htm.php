<?php /* V2.10 Template Lite 4 January 2007  (c) 2005-2007 Mark Dickenson. All rights reserved. Released LGPL. 2018-07-09 15:14 �й���׼ʱ�� */  $_templatelite_tpl_vars = $this->_vars;
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
	 <div class="toptit">���ɻ�Ա����</div>
	    <form action="?act=set_save" method="post"  name="form1" id="form1">
		<?php echo $this->_vars['inputtoken']; ?>

	<table width="700" border="0" cellspacing="5" cellpadding="1" style=" margin-bottom:3px; margin-top:10px;">
    <tr>
      <td width="180" align="right">�����û�����</td>
      <td > 
      <input name="reg_usname" type="text"  class="input_text_200" id="reg_usname"   value="<?php echo $this->_vars['show']['reg_usname']; ?>
" maxlength="10"/>
      ������ַ�
       </td>
    </tr>
	<tr>
      <td width="180" align="right">�������룺</td>
      <td  id="reg_password_tpye">
	  <label><input name="reg_password_tpye"  type="radio" value="1" <?php if ($this->_vars['show']['reg_password_tpye'] == "1"): ?>checked="checked"<?php endif; ?> />���û�����ͬ</label>&nbsp;&nbsp;&nbsp;
		 <label><input name="reg_password_tpye"  type="radio" value="2" <?php if ($this->_vars['show']['reg_password_tpye'] == "2"): ?>checked="checked"<?php endif; ?> />�������</label>&nbsp;&nbsp;&nbsp;
		 <label><input name="reg_password_tpye"  type="radio" value="3" <?php if ($this->_vars['show']['reg_password_tpye'] == "3"): ?>checked="checked"<?php endif; ?> />ָ������</label>&nbsp;&nbsp;&nbsp;   
      </td>
    </tr>
	<tr  id="show_reg_password" style="display:none">
      <td width="180" align="right">����ָ�����룺</td>
      <td >
	  <input name="reg_password" type="text"  class="input_text_200" id="reg_password"   value="<?php echo $this->_vars['show']['reg_password']; ?>
" maxlength="16"/> 
      </td>
    </tr>
	<tr>
      <td width="180" align="right">�޷�ƥ��Email��Ϊ����ַ��ӣ�</td>
      <td ><input name="reg_email" type="text"  class="input_text_200" id="reg_email"   value="<?php echo $this->_vars['show']['reg_email']; ?>
" maxlength="10"/>
      
       </td>
    </tr>
    <tr>
      <td align="right">&nbsp;</td>
      <td height="50"><span style="font-size:14px;">
        <input name="submit2" type="submit" class="admin_submit"    value="�����޸�"/>
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