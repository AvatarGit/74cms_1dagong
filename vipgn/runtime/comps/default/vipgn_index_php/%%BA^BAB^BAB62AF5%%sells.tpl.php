<?php /* Smarty version 2.6.18, created on 2015-08-22 10:20:36
         compiled from dzshuju/sells.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'dzshuju/sells.tpl', 60, false),array('modifier', 'replace', 'dzshuju/sells.tpl', 65, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<link href="<?php echo $this->_tpl_vars['public']; ?>
/css/common.css" rel="stylesheet" type="text/css">
<link href="<?php echo $this->_tpl_vars['public']; ?>
/css/zhqy.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo $this->_tpl_vars['public']; ?>
/js/jquery.js"></script>
<title>�鿴�λ���ҵ�μӵ�չ��</title>
</head>
<script type="text/javascript">
  $(function(){
    //���л�ɫ
    $(".tab:even").css("background","#FFFFFF");
    $(".tab:odd").css("background","#F8F8F8");  
    //������ϻ�ɫ
    $(".tab").hover(
      function(){
        $(this).css("background","#CFDDEA");
      },
      function(){
        $(".tab:even").css("background","#FFFFFF");
      $(".tab:odd").css("background","#F8F8F8");
    });
  });
</script>
<body style="background-color:#E0F0FE;">
<div class="admin_main_nr_dbox">

<div class="pagetit">
  <div class="ptit"> �鿴��ҵԤ����Ϣ </div>
  <div class="clear"></div>
</div>

<div class="toptip">
<h2>�鿴: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h2>
</div>

<form action="<?php echo $this->_tpl_vars['url']; ?>
/sells" method="post" style="display:inline-block;">
������ʱ��ҵ: <input type="text" name="name" >
<input type="submit" value="����" >
</form>
<hr />
<br />

<table width="100%" border="0" cellpadding="0" cellspacing="0" id="list" class="link_bk" >
  <tr>
	<th scope="col" class="admin_list_tit" width="280" align="left" style="padding-left:10px;"><input type="checkbox" />��Ƹ�����</th>
	<th scope="col" class="admin_list_tit" width="120" align="center">�ٰ�ʱ��</th>
	<th scope="col" class="admin_list_tit" width="260" align="left">��ҵ��˾��</th>
	<th scope="col" class="admin_list_tit" width="80" align="center">���۴���</th>
	<th scope="col" class="admin_list_tit" width="80" align="center">����</th>
	<th scope="col" class="admin_list_tit" width="50" align="center">չλ��</th>
	<th scope="col" class="admin_list_tit" width="80" align="center">�û�����</th>
	<th scope="col" class="admin_list_tit" width="80" align="center">Ԥ����ʽ</th>
	<th scope="col" class="admin_list_tit" width="80" align="center">Ԥ��ʱ��</th>
  </tr>
<?php unset($this->_sections['ls']);
$this->_sections['ls']['loop'] = is_array($_loop=$this->_tpl_vars['data']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['ls']['name'] = 'ls';
$this->_sections['ls']['show'] = true;
$this->_sections['ls']['max'] = $this->_sections['ls']['loop'];
$this->_sections['ls']['step'] = 1;
$this->_sections['ls']['start'] = $this->_sections['ls']['step'] > 0 ? 0 : $this->_sections['ls']['loop']-1;
if ($this->_sections['ls']['show']) {
    $this->_sections['ls']['total'] = $this->_sections['ls']['loop'];
    if ($this->_sections['ls']['total'] == 0)
        $this->_sections['ls']['show'] = false;
} else
    $this->_sections['ls']['total'] = 0;
if ($this->_sections['ls']['show']):

            for ($this->_sections['ls']['index'] = $this->_sections['ls']['start'], $this->_sections['ls']['iteration'] = 1;
                 $this->_sections['ls']['iteration'] <= $this->_sections['ls']['total'];
                 $this->_sections['ls']['index'] += $this->_sections['ls']['step'], $this->_sections['ls']['iteration']++):
$this->_sections['ls']['rownum'] = $this->_sections['ls']['iteration'];
$this->_sections['ls']['index_prev'] = $this->_sections['ls']['index'] - $this->_sections['ls']['step'];
$this->_sections['ls']['index_next'] = $this->_sections['ls']['index'] + $this->_sections['ls']['step'];
$this->_sections['ls']['first']      = ($this->_sections['ls']['iteration'] == 1);
$this->_sections['ls']['last']       = ($this->_sections['ls']['iteration'] == $this->_sections['ls']['total']);
?>
  <tr class="tab">
  <td class="admin_list" align="left" style="padding-left:10px;"><input type="checkbox" name="id[]" value='<?php echo $this->_tpl_vars['data'][$this->_sections['ls']['index']]['id']; ?>
'><?php echo $this->_tpl_vars['data'][$this->_sections['ls']['index']]['qytitle']; ?>
</td>
  <td class="admin_list" align="center"><?php echo ((is_array($_tmp=$this->_tpl_vars['data'][$this->_sections['ls']['index']]['holddates'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d") : smarty_modifier_date_format($_tmp, "%Y-%m-%d")); ?>
</td>
  <td class="admin_list"><?php echo $this->_tpl_vars['data'][$this->_sections['ls']['index']]['title']; ?>
</td>
  <td class="admin_list" align="center"><?php echo $this->_tpl_vars['data'][$this->_sections['ls']['index']]['xs_user']; ?>
</td>
  <td class="admin_list" align="center"><?php echo $this->_tpl_vars['data'][$this->_sections['ls']['index']]['dq']; ?>
</td>
  <td class="admin_list" align="center"><?php echo $this->_tpl_vars['data'][$this->_sections['ls']['index']]['number']; ?>
</td>
  <td class="admin_list" align="center"><?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['data'][$this->_sections['ls']['index']]['yhtype'])) ? $this->_run_mod_handler('replace', true, $_tmp, '1', "�ײ��û�") : smarty_modifier_replace($_tmp, '1', "�ײ��û�")))) ? $this->_run_mod_handler('replace', true, $_tmp, '2', "�����û�") : smarty_modifier_replace($_tmp, '2', "�����û�")))) ? $this->_run_mod_handler('replace', true, $_tmp, '3', "��ʱ�û�") : smarty_modifier_replace($_tmp, '3', "��ʱ�û�")); ?>
</td>
  <td class="admin_list" align="center"><?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['data'][$this->_sections['ls']['index']]['online_aoto'])) ? $this->_run_mod_handler('replace', true, $_tmp, '1', "�Զ�Ԥ��") : smarty_modifier_replace($_tmp, '1', "�Զ�Ԥ��")))) ? $this->_run_mod_handler('replace', true, $_tmp, '2', "����Ԥ��") : smarty_modifier_replace($_tmp, '2', "����Ԥ��")))) ? $this->_run_mod_handler('replace', true, $_tmp, '3', "�ֶ����") : smarty_modifier_replace($_tmp, '3', "�ֶ����")); ?>
</td>
  <td class="admin_list" align="center"><?php echo ((is_array($_tmp=$this->_tpl_vars['data'][$this->_sections['ls']['index']]['add_time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d") : smarty_modifier_date_format($_tmp, "%Y-%m-%d")); ?>
</td>
  </tr>
<?php endfor; else: ?>
   <tr>
     <td colspan="9">û���ҵ�!</td>
   </tr>
<?php endif; ?>

<tr>
  <td colspan="9" class="admin_list"><?php echo $this->_tpl_vars['fpage']; ?>
</td>
<tr>
</table>

</div>
</body>
</html>