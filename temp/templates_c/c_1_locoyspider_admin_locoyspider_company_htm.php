<?php require_once('D:\fengmf\wwwroot\74cms_1dagong\include\template_lite\plugins\function.qishi_get_classify.php'); $this->register_function("qishi_get_classify", "tpl_function_qishi_get_classify",false);  /* V2.10 Template Lite 4 January 2007  (c) 2005-2007 Mark Dickenson. All rights reserved. Released LGPL. 2018-07-09 15:14 �й���׼ʱ�� */  $_templatelite_tpl_vars = $this->_vars;
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

    <div class="toptit">��ҵ��Ϣ�ɼ�����</div>
    <table width="100%" border="0" cellpadding="1" cellspacing="10" style=" margin-bottom:3px; margin-top:10px;">
      <tr>
        <td width="180" align="right">Ĭ����ҵ��֤״̬��</td>
        <td >
		  <label><input name="company_audit"  type="radio" value="1" <?php if ($this->_vars['show']['company_audit'] == "1"): ?>checked="checked"<?php endif; ?> />��֤ͨ��</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		 <label><input name="company_audit"  type="radio" value="2" <?php if ($this->_vars['show']['company_audit'] == "2"): ?>checked="checked"<?php endif; ?> />�ȴ���֤</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		  <label><input name="company_audit"  type="radio" value="3" <?php if ($this->_vars['show']['company_audit'] == "3"): ?>checked="checked"<?php endif; ?> />��֤δͨ��</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		   <label><input name="company_audit"  type="radio" value="0" <?php if ($this->_vars['show']['company_audit'] == "0"): ?>checked="checked"<?php endif; ?> />δ��֤</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		</td>
      </tr>
	 
      <tr>
        <td align="right">��ҵ�����޷�ƥ����Ϊ��</td>
        <td>
	<div>
	<?php echo tpl_function_qishi_get_classify(array('set' => "����:QS_company_type,�б���:li"), $this);?>
		<input type="text" value="<?php if (count((array)$this->_vars['li'])): foreach ((array)$this->_vars['li'] as $this->_vars['list']):  if ($this->_vars['list']['id'] == $this->_vars['show']['company_nature']):  echo $this->_vars['list']['categoryname'];  endif;  endforeach; endif; ?>"  readonly="readonly" name="company_nature_cn" id="company_nature_cn" class="input_text_200 input_text_selsect"/>
		<input name="company_nature" id="company_nature" type="hidden" value="<?php echo $this->_vars['show']['company_nature']; ?>
" />
		<div id="menu1" class="menu">
			<ul>
			<?php if (count((array)$this->_vars['li'])): foreach ((array)$this->_vars['li'] as $this->_vars['list']): ?>
			<li id="<?php echo $this->_vars['list']['id']; ?>
" title="<?php echo $this->_vars['list']['categoryname']; ?>
"><?php echo $this->_vars['list']['categoryname']; ?>
</li>
			<?php endforeach; endif; ?>
			</ul>
		</div>
		  </div>
	</td>
      </tr>
<tr>
        <td align="right">��ҵ��ҵ�޷�ƥ����Ϊ��</td>
        <td>
		<div>
		<?php echo tpl_function_qishi_get_classify(array('set' => "�б���:li,����:QS_trade"), $this);?>
		<input type="text" value="<?php if (count((array)$this->_vars['li'])): foreach ((array)$this->_vars['li'] as $this->_vars['list']):  if ($this->_vars['list']['id'] == $this->_vars['show']['company_trade']):  echo $this->_vars['list']['categoryname'];  endif;  endforeach; endif; ?>"  readonly="readonly" name="company_trade_cn" id="company_trade_cn" class="input_text_200 input_text_selsect"/>
		<input name="company_trade" id="company_trade" type="hidden" value="<?php echo $this->_vars['show']['company_trade']; ?>
" />
		<div id="menu2" class="dmenu shadow">
			<ul>
			<?php if (count((array)$this->_vars['li'])): foreach ((array)$this->_vars['li'] as $this->_vars['list']): ?>
			<li id="<?php echo $this->_vars['list']['id']; ?>
" title="<?php echo $this->_vars['list']['categoryname']; ?>
"><?php echo $this->_vars['list']['categoryname']; ?>
</li>
			<?php endforeach; endif; ?>
			</ul>
		</div>
		  </div>
	</td>
      </tr>
	  <tr>
        <td align="right">��ҵ���ڵ����޷�ƥ����Ϊ��</td>
        <td>
		<div>
		<?php echo tpl_function_qishi_get_classify(array('set' => "�б���:li,����:QS_district"), $this);?>
		<input type="text" value="<?php if (count((array)$this->_vars['li'])): foreach ((array)$this->_vars['li'] as $this->_vars['list']):  if ($this->_vars['list']['id'] == $this->_vars['show']['company_district']):  echo $this->_vars['list']['categoryname'];  endif;  endforeach; endif; ?>"  readonly="readonly" name="company_district_cn" id="company_district_cn" class="input_text_200 input_text_selsect"/>
		<input name="district" id="district" type="hidden" value="" />
		<input name="company_district" id="company_district" type="hidden" value="<?php echo $this->_vars['show']['company_district']; ?>
" />
		<div id="menu3" class="dmenu shadow">
			<ul>
			<?php echo tpl_function_qishi_get_classify(array('set' => "�б���:c_province,����:QS_district,id:0"), $this);?>
			<?php if (count((array)$this->_vars['c_province'])): foreach ((array)$this->_vars['c_province'] as $this->_vars['list']): ?>
			<li id="<?php echo $this->_vars['list']['id']; ?>
" title="<?php echo $this->_vars['list']['categoryname']; ?>
"><?php echo $this->_vars['list']['categoryname']; ?>
</li>
			<?php endforeach; endif; ?>
			</ul>
		</div>
		<div id="menu3_s" class="dmenu shadow" style="display:none"></div>
		  </div>
	 </td>
      </tr>
	    <tr>
        <td align="right">��ҵ��ģ�޷�ƥ����Ϊ��</td>
        <td>
	<div>
	<?php echo tpl_function_qishi_get_classify(array('set' => "����:QS_scale,�б���:li"), $this);?>
		<input type="text" value="<?php if (count((array)$this->_vars['li'])): foreach ((array)$this->_vars['li'] as $this->_vars['list']):  if ($this->_vars['list']['id'] == $this->_vars['show']['company_scale']):  echo $this->_vars['list']['categoryname'];  endif;  endforeach; endif; ?>"  readonly="readonly" name="company_scale_cn" id="company_scale_cn" class="input_text_200 input_text_selsect"/>
		<input name="company_scale" id="company_scale" type="hidden" value="<?php echo $this->_vars['show']['company_scale']; ?>
" />
		<div id="menu4" class="menu">
			<ul>
			<?php if (count((array)$this->_vars['li'])): foreach ((array)$this->_vars['li'] as $this->_vars['list']): ?>
			<li id="<?php echo $this->_vars['list']['id']; ?>
" title="<?php echo $this->_vars['list']['categoryname']; ?>
"><?php echo $this->_vars['list']['categoryname']; ?>
</li>
			<?php endforeach; endif; ?>
			</ul>
		</div>
		  </div>
	
	</td>
      </tr>
	  <tr>
        <td align="right">ע���ʽ��޷�ƥ����Ϊ��</td>
        <td >
		<input name="company_registered" type="text"  class="input_text_200" id="company_registered"   value="<?php echo $this->_vars['show']['company_registered']; ?>
" style="width:80px;"/>&nbsp;��
		<label><input name="company_currency"  type="radio" value="�����" <?php if ($this->_vars['show']['company_currency'] == "�����"): ?>checked="checked"<?php endif; ?> />�����</label>&nbsp;&nbsp;
		 <label><input name="company_currency"  type="radio" value="��Ԫ" <?php if ($this->_vars['show']['company_currency'] == "��Ԫ"): ?>checked="checked"<?php endif; ?> />��Ԫ</label>&nbsp;&nbsp;</td>
      </tr>
	  <tr>
        <td align="right">&nbsp;</td>
        <td height="50"><span style="font-size:14px;">
          <input name="submit2222" type="submit" class="admin_submit"    value="�����޸�"/>
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