<?php /* V2.10 Template Lite 4 January 2007  (c) 2005-2007 Mark Dickenson. All rights reserved. Released LGPL. 2018-07-09 15:14 �й���׼ʱ�� */  $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include("sys/admin_header.htm", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>

<div class="admin_main_nr_dbox">
 <div class="pagetit">
	<div class="ptit"> <?php echo $this->_vars['pageheader']; ?>
</div>
  <div class="clear"></div>
</div>
  <div class="toptip">
	<h2>���ܣ�</h2>
	<h3>��������Ա</h3>
	<p>����û����Զ����1��Ԥ��չ�����.ʹ��������7��,��ʹ�þ͹���.</p>
	<h3>�������ͻ�Ա</h3>
	<p>����û�����ת�����Ԥ��չ�������,�������͵Ĵ�������,ʹ��������30��,��ʹ�þ͹���.</p>
	<h3>�ı��Ա�û�����</h3>
	<p>����������Ա���ͣ��������ͻ�Ա���û�������ɣ���ʽ��Ա��ֻҪ���鿴��Ա�����޸��û����;�����.</p>
  </div>
</div>
<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include("sys/admin_footer.htm", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>