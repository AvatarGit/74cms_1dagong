<?php require_once('D:\fengmf\wwwroot\74cms_1dagong\include\template_lite\plugins\modifier.date_format.php'); $this->register_modifier("date_format", "tpl_modifier_date_format",false);  require_once('D:\fengmf\wwwroot\74cms_1dagong\include\template_lite\plugins\modifier.replace.php'); $this->register_modifier("replace", "tpl_modifier_replace",false);  /* V2.10 Template Lite 4 January 2007  (c) 2005-2007 Mark Dickenson. All rights reserved. Released LGPL. 2018-07-09 15:26 �й���׼ʱ�� */  $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include("sys/admin_header.htm", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>

<div class="admin_main_nr_dbox">

 <div class="pagetit">
	<div class="ptit"> �����ײ� </div>
  <div class="clear"></div>
</div>
<div class="toptip">
<h2>����&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="/../vipgn/index.php/excel/cstcyh">����Excel</a>
<?php if ($this->_vars['dq'] != ""): ?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��ַ��&nbsp;
<?php if (count((array)$this->_vars['dq'])): foreach ((array)$this->_vars['dq'] as $this->_vars['l']): ?> 
<a href="admin_vip.php?act=selectcsvip&qdid=<?php echo $this->_vars['l']['s_id']; ?>
"><?php echo $this->_vars['l']['s_districtname']; ?>
</a>&nbsp;&nbsp;
<?php endforeach; endif; ?>
<?php endif; ?>
</h2></div>
<br />
<!------------->
<form action="admin_vip.php" method="get">
<input type="hidden" name="act" value="selectcsvip" />
��ҵ��˾����<input type="text" name="username" id="name"/>
<input type="submit" value="��ѯ��ҵ">  &nbsp;&nbsp;<a href="admin_vip.php?act=selectcsvip&jh=1">����</a>	&nbsp;&nbsp;<a href="admin_vip.php?act=selectcsvip&jh=2">δ����</a>
</form>
<hr />
<table width="100%" border="0" cellpadding="0" cellspacing="0" id="list" class="link_bk" >
  <tr> 
  	<th scope="col" class="admin_list_tit" width="110" align="left" style="padding-left:5px;"><input type="checkbox" />��ҵ�û���</th>
    <th scope="col" class="admin_list_tit" width="230" align="left">��ҵ��˾��</th>
	<th scope="col" class="admin_list_tit" width="60" align="left">���۴���</th>
	<th scope="col" class="admin_list_tit" width="50" align="center">����</th>
	<th scope="col" class="admin_list_tit" width="65" align="center">�ײ�����</th>
	<th scope="col" class="admin_list_tit" width="65" align="center">�û�����</th>
	<th scope="col" class="admin_list_tit" width="50" align="center">�ײʹ���</th>
    <?php if ($this->_vars['dqid'] == 5): ?>
    <th scope="col" class="admin_list_tit" width="50" align="center">��������</th>
    <?php endif; ?>
	<th scope="col" class="admin_list_tit" width="70" align="center">��ʼʱ��</th>
	<th scope="col" class="admin_list_tit" width="70" align="center">����ʱ��</th>
	<th scope="col" class="admin_list_tit" width="70" align="center">���ʱ��</th>
	<th scope="col" class="admin_list_tit" width="80" align="center">�ײ��Ƿ񼤻�</th>
	<th scope="col" class="admin_list_tit" width="100" align="center">����</th>
  </tr>
<?php if (count((array)$this->_vars['data'])): foreach ((array)$this->_vars['data'] as $this->_vars['list']): ?>  
  <tr>
	<td class="admin_list" align="left" style="padding-left:5px;"><input type="checkbox" name="id[]" value='<?php echo $this->_vars['list']['id']; ?>
'><?php echo $this->_vars['list']['username']; ?>
</td>
    <td class="admin_list"><?php echo $this->_vars['list']['title']; ?>
</td>
	<td class="admin_list"><?php echo $this->_vars['list']['xs_user']; ?>
</td>
	<td class="admin_list" align="center"><?php echo $this->_vars['list']['dq']; ?>
</td>
    <td class="admin_list" align="center"><?php echo $this->_run_modifier($this->_run_modifier($this->_vars['list']['type'], 'replace', 'plugin', 1, "1", "ʱ���ײ�"), 'replace', 'plugin', 1, "0", "�����ײ�"); ?>
</td>
	<td class="admin_list" align="center"><?php echo $this->_run_modifier($this->_run_modifier($this->_run_modifier($this->_vars['list']['huiyuan'], 'replace', 'plugin', 1, "0", "��ʽ��Ա"), 'replace', 'plugin', 1, "2", "�������"), 'replace', 'plugin', 1, "3", "��������"); ?>
</td>
	<td class="admin_list" align="center"><?php echo $this->_vars['list']['bout']; ?>
</td>
    <?php if ($this->_vars['dqid'] == 5): ?>
    <td class="admin_list" align="center"><?php echo $this->_vars['list']['bout_6']; ?>
</td>
    <?php endif; ?>
    <td class="admin_list" align="center"><?php echo $this->_run_modifier($this->_vars['list']['cs_ks_time'], 'date_format', 'plugin', 1, "%Y-%m-%d"); ?>
</td>
	<td class="admin_list" align="center"><?php echo $this->_run_modifier($this->_vars['list']['cs_end_time'], 'date_format', 'plugin', 1, "%Y-%m-%d"); ?>
</td>
	<td class="admin_list" align="center"><?php echo $this->_run_modifier($this->_vars['list']['add_time'], 'date_format', 'plugin', 1, "%Y-%m-%d"); ?>
</td>
	<td class="admin_list" align="center"><?php echo $this->_run_modifier($this->_run_modifier($this->_vars['list']['activation'], 'replace', 'plugin', 1, "1", "�Ѽ���"), 'replace', 'plugin', 1, "0", "δ����"); ?>
</td>
	<td class="admin_list" align="center">&nbsp;<a href="/../vipgn/index.php/index/cjh/id/<?php echo $this->_vars['list']['id']; ?>
">����</a>&nbsp;&nbsp;<a href="/../vipgn/index.php/index/operating/id/<?php echo $this->_vars['list']['id']; ?>
">����</a>&nbsp;&nbsp;<a href="/../vipgn/index.php/index/tcdel/id/<?php echo $this->_vars['list']['id']; ?>
/uid/<?php echo $this->_vars['list']['uid']; ?>
" onclick="return confirm('��ȷ��Ҫɾ����')">ɾ��</a></td>
  </tr>
<?php endforeach; endif; ?>
<tr>
		<td colspan="11" class="admin_list"><?php echo $this->_vars['fpage']; ?>
</td>
	<tr>
</table>
<!------------->
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