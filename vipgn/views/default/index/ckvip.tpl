<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<link href="<{$public}>/css/common.css" rel="stylesheet" type="text/css">
<title>�鿴�û�</title>
</head>

<body style="background-color:#E0F0FE">
<div class="admin_main_nr_dbox">

 <div class="pagetit">
	<div class="ptit"> �鿴�û� </div>
  <div class="clear"></div>
</div>

<div class="toptip">
<h2>�鿴��</h2>
</div>
<br />
<form action="<{$url}>/ckvip" method="post">
<input type="text" name="name" />
<input type="submit" value="�����û�">	&nbsp;&nbsp;<a href="<{$url}>/ckvip">�鿴ȫ��</a>	&nbsp;&nbsp;<a href="<{$url}>/ckvip/bl/1">�Ѱ���</a>	&nbsp;&nbsp;<a href="<{$url}>/ckvip/bl/2">δ����</a>
</form>
<hr />
<br />
<table width="100%" border="0" cellpadding="0" cellspacing="0" id="list" class="link_bk" >
  <tr>
  	 <th scope="col" class="admin_list_tit" width="55" ><input type="checkbox" />id</th>
    <th scope="col" class="admin_list_tit" width="90" align="left">��ҵ�û���</th>
    <th scope="col" class="admin_list_tit" width="220" align="left">��ҵ��˾��</th>
	<th scope="col" class="admin_list_tit" width="50" align="left">����</th>
    <th scope="col" class="admin_list_tit" width="80" align="center">��ҵQQ</th>
    <th scope="col" class="admin_list_tit" width="80" align="center">��ҵ�绰</th>
    <th scope="col" class="admin_list_tit" width="120" align="center">��ҵ����</th>
	<th scope="col" class="admin_list_tit" width="100" align="center">���ʱ��</th>
	<th scope="col" class="admin_list_tit" width="65" align="center">�Ƿ����ҵ��</th>
	<th scope="col" class="admin_list_tit" width="120" align="center">����</th>
  </tr>
<{section loop=$data name="ls"}>
  <tr>
    <td class="admin_list" align="left" style="padding-left:20px;"><input type="checkbox" name="id[]" value='<{$data[ls].id}>'><{$data[ls].id}></td>
    <td class="admin_list"><{$data[ls].username}></td>
    <td class="admin_list"><{$data[ls].title}></td>
	<td class="admin_list"><{$data[ls].dq}></td>
    <td class="admin_list" align="center"><{$data[ls].qq}></td>
    <td class="admin_list" align="center"><{$data[ls].phone}></td>
    <td class="admin_list" align="center"><{$data[ls].email}></td>
    <td class="admin_list" align="center"><{$data[ls].addtime|date_format:"%Y-%m-%d %H:%M:%S"}></td>
	<td class="admin_list" align="center"><{$data[ls].bl|replace:"1":"�Ѱ���"|replace:"0":"δ����"}></td>
	<td class="admin_list" align="center">&nbsp;<a href="<{$url}>/upvip/id/<{$data[ls].id}>">�޸�</a>&nbsp;&nbsp;<a href="<{$url}>/del/id/<{$data[ls].id}>" onclick="return confirm('��ȷ��Ҫɾ����')">ɾ��</a>&nbsp;&nbsp;<a href="<{$url}>/blvip/id/<{$data[ls].id}>">����</a></td>
  </tr>
<{sectionelse}>
   <tr>
     <td colspan="10">��ʱ�ҵ��û�!</td>
   </tr>
<{/section}>

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