<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<link href="<{$public}>/css/common.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<{$public}>/js/jquery.js"></script>
<title>�����ײ�</title>
</head>

<body style="background-color:#E0F0FE">
<div class="admin_main_nr_dbox">

 <div class="pagetit">
	<div class="ptit"> �����ײ� </div>
  <div class="clear"></div>
</div>

<div class="toptip">
<h2>����</h2>
</div>
<br />
<!------------->
<form action="<{$url}>/selectcsvip/dqid/<{$dqid}>" method="post">
����vip�û���<input type="text" name="username" id="name"/>
<input type="submit" value="��ѯ��ҵ�û�">		&nbsp;&nbsp;<a href="<{$url}>/selectcsvip/jh/1/dqid/<{$dqid}>">����</a>	&nbsp;&nbsp;<a href="<{$url}>/selectcsvip/jh/2/dqid/<{$dqid}>">δ����</a>
</form>
<hr />
<table width="100%" border="0" cellpadding="0" cellspacing="0" id="list" class="link_bk" >
  <tr>
  	<th scope="col" class="admin_list_tit" width="55"><input type="checkbox" />id</th>
    <th scope="col" class="admin_list_tit" width="100" align="left">��ҵ�û���</th>
    <th scope="col" class="admin_list_tit" width="250" align="left">��ҵ��˾��</th>
	<th scope="col" class="admin_list_tit" width="50" align="center">����</th>
	<th scope="col" class="admin_list_tit" width="80" align="center">�ײ�����</th>
	<th scope="col" class="admin_list_tit" width="40" align="center">�ײʹ���</th>
	<th scope="col" class="admin_list_tit" width="70" align="center">��ʼʱ��</th>
	<th scope="col" class="admin_list_tit" width="70" align="center">����ʱ��</th>
	<th scope="col" class="admin_list_tit" width="70" align="center">���ʱ��</th>
	<th scope="col" class="admin_list_tit" width="80" align="center">�ײ��Ƿ񼤻�</th>
	<th scope="col" class="admin_list_tit" width="100" align="center">����</th>
  </tr>
<{section loop=$data name="ls"}>
  <tr>
    <td class="admin_list" align="left" style="padding-left:20px;"><input type="checkbox" name="id[]" value='<{$data[ls].id}>'><{$data[ls].id}></td>
    <td class="admin_list"><{$data[ls].username}></td>
    <td class="admin_list"><{$data[ls].title}></td>
	<td class="admin_list" align="center"><{$data[ls].dq}></td>
    <td class="admin_list" align="center"><{$data[ls].type|replace:"1":"ʱ���ײ�"|replace:"0":"�����ײ�"}></td>
	<td class="admin_list" align="center"><{$data[ls].bout}></td>
	<td class="admin_list" align="center"><{$data[ls].cs_ks_time|date_format:"%Y-%m-%d"}></td>
	<td class="admin_list" align="center"><{$data[ls].cs_end_time|date_format:"%Y-%m-%d"}></td>
	<td class="admin_list" align="center"><{$data[ls].add_time|date_format:"%Y-%m-%d"}></td>
	<td class="admin_list" align="center"><{$data[ls].activation|replace:"1":"�Լ���"|replace:"0":"δ����"}></td>
	<td class="admin_list" align="center">&nbsp;<a href="<{$url}>/cjh/id/<{$data[ls].id}>">����</a>&nbsp;&nbsp;<a href="<{$url}>/operating/id/<{$data[ls].id}>">����</a>&nbsp;&nbsp;<a href="<{$url}>/tcdel/id/<{$data[ls].id}>/uid/<{$data[ls].uid}>" onclick="return confirm('��ȷ��Ҫɾ����')">ɾ��</a></td>
  </tr>
<{sectionelse}>
   <tr>
     <td colspan="11">��ʱû���ҵ��û�!</td>
   </tr>
<{/section}>
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