<?php require_once('D:\fengmf\wwwroot\74cms_1dagong\include\template_lite\plugins\modifier.date_format.php'); $this->register_modifier("date_format", "tpl_modifier_date_format",false);  require_once('D:\fengmf\wwwroot\74cms_1dagong\include\template_lite\plugins\modifier.replace.php'); $this->register_modifier("replace", "tpl_modifier_replace",false);  /* V2.10 Template Lite 4 January 2007  (c) 2005-2007 Mark Dickenson. All rights reserved. Released LGPL. 2018-07-09 15:26 �й���׼ʱ�� */  $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include("sys/admin_header.htm", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>
"><?php echo $this->_vars['l']['s_districtname']; ?>
</a>&nbsp;&nbsp;
'><?php echo $this->_vars['list']['id']; ?>
</td>
</td>
</td>
</td>
</td>
</td>
</td>
</td>
</td>
</td>
</td>
">����</a>&nbsp;&nbsp;<a href="/../vipgn/index.php/index/operating/id/<?php echo $this->_vars['list']['id']; ?>
/dqid/<?php echo $this->_vars['list']['subsite_id']; ?>
">����</a>&nbsp;&nbsp;<a href="/../vipgn/index.php/index/tcdel/id/<?php echo $this->_vars['list']['id']; ?>
/uid/<?php echo $this->_vars['list']['uid']; ?>
" onclick="return confirm('��ȷ��Ҫɾ����')">ɾ��</a></td>
		<td colspan="11" class="admin_list"><?php echo $this->_vars['fpage']; ?>
</td>
	<tr>
