<?php /* Smarty version 2.6.18, created on 2015-08-22 09:29:04
         compiled from index/czvip.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'index/czvip.tpl', 61, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<link href="<?php echo $this->_tpl_vars['public']; ?>
/css/common.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo $this->_tpl_vars['public']; ?>
/js/jquery.js"></script>
<link href="<?php echo $this->_tpl_vars['public']; ?>
/css/date_input.css" rel="stylesheet" type="text/css" />
<script type='text/javascript' src="<?php echo $this->_tpl_vars['public']; ?>
/js/jquery.date_input.js" language="javascript"></script>
<title>�޸�</title>
</head>
<script>
$(document).ready(function(){
	//����
	$(function() { 
		$(".date_input").date_input(); 
	});
});

function bout(){
	return $('#boutj').val();
}

</script>
<body style="background-color:#E0F0FE">
<div class="admin_main_nr_dbox">

 <div class="pagetit">
	<div class="ptit"> �޸� </div>
  <div class="clear"></div>
</div>

<div class="toptip">
<h2>��ӣ�</h2>
</div>
<br />
<form action="<?php echo $this->_tpl_vars['url']; ?>
/updata" method="post">
<input type="hidden" name="id" value="<?php echo $this->_tpl_vars['data']['id']; ?>
" />
<input type="hidden" name="bout1" value="<?php echo $this->_tpl_vars['data']['bout']; ?>
" />
<input type="hidden" name="bout1_6" value="<?php echo $this->_tpl_vars['data']['bout_6']; ?>
" />
<input type="hidden" name="subsite_id" value="<?php echo $this->_tpl_vars['data']['subsite_id']; ?>
" />
<input type="hidden" name="cs" value="1" />
��ǰʣ��չ�������<b><?php echo $this->_tpl_vars['data']['bout']; ?>
</b><br /><br />

����������&nbsp;&nbsp;<input type="radio" value="1"  checked="checked" name="cz"/>����&nbsp;<input type="radio" value="2" name="cz"/>����<br />
����������<input type="text" name="bout"/><br />
<?php if ($this->_tpl_vars['data']['subsite_id'] == 5): ?>
��ǰʣ������������<b><?php if ($this->_tpl_vars['data']['bout_6'] == ''): ?>0<?php else: ?><?php echo $this->_tpl_vars['data']['bout_6']; ?>
<?php endif; ?></b><br /><br />

����������&nbsp;&nbsp;<input type="radio" value="1"  checked="checked" name="cz_6"/>����&nbsp;<input type="radio" value="2" name="cz_6"/>����<br />
����������<input type="text" name="bout_6"/><br />
<?php endif; ?>
<input type="submit" value="ȷ��" class="admin_submit" />
</form>
<hr />
<br />

<h3>�޸���Чʱ��</h3>
<form action="<?php echo $this->_tpl_vars['url']; ?>
/updatasj" method="post">
<input type="hidden" name="id" value="<?php echo $this->_tpl_vars['data']['id']; ?>
" />
<!-------------------->
��ʼʱ�䣺<input type="text" name="cs_ks_time" class="date_input"  value="<?php echo ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, '%Y-%m-%d') : smarty_modifier_date_format($_tmp, '%Y-%m-%d')); ?>
" /><br />
����ʱ�䣺<input type="text" name="cs_end_time" class="date_input"  value="" /><br />
<!-------------------->
<input type="submit" value="ȷ��" class="admin_submit" />
</form>
</div>
<!--����-->
<div class="footer link_lan">
Powered by <a href="http://www.74cms.com" target="_blank"><span style="color:#009900">74</span><span style="color: #FF3300">CMS</span></a> 3.3.20130614
</div>
<div class="admin_frameset" >
  <div class="open_frame" title="ȫ��" id="open_frame"></div>
  <div class="close_frame" title="��ԭ����" id="close_frame"></div>
</div>
</body>
</html>