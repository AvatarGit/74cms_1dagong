<?php require_once('D:\fengmf\wwwroot\74cms_1dagong\include\template_lite\plugins\modifier.date_format.php'); $this->register_modifier("date_format", "tpl_modifier_date_format",false);  require_once('D:\fengmf\wwwroot\74cms_1dagong\include\template_lite\plugins\modifier.replace.php'); $this->register_modifier("replace", "tpl_modifier_replace",false);  /* V2.10 Template Lite 4 January 2007  (c) 2005-2007 Mark Dickenson. All rights reserved. Released LGPL. 2018-07-09 15:26 �й���׼ʱ�� */  $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include("sys/admin_header.htm", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>

<div class="admin_main_nr_dbox">

 <div class="pagetit">
	<div class="ptit"> �鿴�û� </div>
  <div class="clear"></div>
</div>

<div class="toptip">
<h2>�鿴��&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="/../vipgn/index.php/excel/user">����Excel</a>
<?php if ($this->_vars['dq'] != ""): ?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��ַ��&nbsp;
<?php if (count((array)$this->_vars['dq'])): foreach ((array)$this->_vars['dq'] as $this->_vars['l']): ?> 
<a href="admin_vip.php?act=ckvip&qdid=<?php echo $this->_vars['l']['s_id']; ?>
"><?php echo $this->_vars['l']['s_districtname']; ?>
</a>&nbsp;&nbsp;
<?php endforeach; endif; ?>
<?php endif; ?>
</h2>
</div>
<br />
<form action="admin_vip.php" method="get">
<input type="hidden" name="act" value="ckvip" />
��ҵ��˾��:<input type="text" name="name" />
<input type="submit" value="������ҵ">	&nbsp;&nbsp;<a href="admin_vip.php?act=ckvip">�鿴ȫ��</a>	&nbsp;&nbsp;<a href="admin_vip.php?act=ckvip&bl=1">�Ѱ���</a>	&nbsp;&nbsp;<a href="admin_vip.php?act=ckvip&bl=2">δ����</a>
</form>
<hr />
<br />

<table width="100%" border="0" cellpadding="0" cellspacing="0" id="list" class="link_bk" >
  <tr>
  	 <th scope="col" class="admin_list_tit" width="55" align="left" style="padding-left:5px;"><input type="checkbox" />id</th>
    <th scope="col" class="admin_list_tit" width="90" align="left">��ҵ�û���</th>
    <th scope="col" class="admin_list_tit" width="220" align="left">��ҵ��˾��</th>
	<th scope="col" class="admin_list_tit" width="50" align="left">���۴���</th>
	<th scope="col" class="admin_list_tit" width="40" align="center">����</th>
    <th scope="col" class="admin_list_tit" width="80" align="center">��ҵ�绰</th>
    <th scope="col" class="admin_list_tit" width="120" align="center">��ҵ����</th>
	<th scope="col" class="admin_list_tit" width="80" align="center">��Ա����</th>
	<th scope="col" class="admin_list_tit" width="100" align="center">���ʱ��</th>
	<th scope="col" class="admin_list_tit" width="65" align="center">�Ƿ����ҵ��</th>
	<th scope="col" class="admin_list_tit" width="120" align="center">����</th>
  </tr>
<?php if (count((array)$this->_vars['data'])): foreach ((array)$this->_vars['data'] as $this->_vars['list']): ?>  
  <tr>
    <td class="admin_list" align="left" style="padding-left:5px;"><input type="checkbox" name="id[]" value='<?php echo $this->_vars['list']['id']; ?>
'><?php echo $this->_vars['list']['id']; ?>
</td>
    <td class="admin_list"><?php echo $this->_vars['list']['username']; ?>
</td>
    <td class="admin_list"><?php echo $this->_vars['list']['title']; ?>
</td>
	<td class="admin_list"><?php echo $this->_vars['list']['xs_user']; ?>
</td>
	<td class="admin_list" align="center"><?php echo $this->_vars['list']['dq']; ?>
</td>
    <td class="admin_list" align="center"><?php echo $this->_vars['list']['phone']; ?>
</td>
    <td class="admin_list" align="center"><?php echo $this->_vars['list']['email']; ?>
</td>
	<td class="admin_list" align="center"><?php echo $this->_run_modifier($this->_run_modifier($this->_run_modifier($this->_vars['list']['huiyuan'], 'replace', 'plugin', 1, "0", "��ʽ��Ա"), 'replace', 'plugin', 1, "2", "�������"), 'replace', 'plugin', 1, "3", "��������"); ?>
</td>
    <td class="admin_list" align="center"><?php echo $this->_run_modifier($this->_vars['list']['addtime'], 'date_format', 'plugin', 1, "%Y-%m-%d %H:%M:%S"); ?>
</td>
	<td class="admin_list" align="center"><?php echo $this->_run_modifier($this->_run_modifier($this->_vars['list']['bl'], 'replace', 'plugin', 1, "1", "�Ѱ���"), 'replace', 'plugin', 1, "0", "δ����"); ?>
</td>
	<td class="admin_list" align="center">&nbsp;<a href="/../vipgn/index.php/index/upvip/id/<?php echo $this->_vars['list']['id']; ?>
">�޸�</a>&nbsp;&nbsp;<a href="/../vipgn/index.php/index/udel/id/<?php echo $this->_vars['list']['id']; ?>
" onclick="return confirm('��ȷ��Ҫɾ����')">ɾ��</a>&nbsp;&nbsp;<a href="/../vipgn/index.php/index/blvip/id/<?php echo $this->_vars['list']['id']; ?>
">����</a></td>
  </tr>
<?php endforeach; endif; ?>
<tr>
		<td colspan="10" class="admin_list"><?php echo $this->_vars['fpage']; ?>
</td>
	<tr>

</table>
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