<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<link href="<{$public}>/css/common.css" rel="stylesheet" type="text/css">
<title>����û�</title>
</head>
<style>
table th{
	font-size: 12px;
	font-weight : 500;
}
</style>
<body style="background-color:#E0F0FE">
<div class="admin_main_nr_dbox">

 <div class="pagetit">
	<div class="ptit"> ����û� </div>
  <div class="clear"></div>
</div>

<div class="toptip">
<h2>��ӣ�</h2>
</div>
<br />
<!------->
<form action="<{$url}>/selsecqy" method="post">
��ѯ��ҵ�û�����<input id="qname" name="qname" type="text" />
<input type="hidden" name="dq_id" value="<{$dq_dq}>" />
<input id="select" type="submit" value="��ѯ��ҵ��Ϣ" />
</form>
<!-------->

<hr />
<br />
<form action="<{$url}>/addqy" method="post">
<table width="100%" border="0" cellpadding="3" cellspacing="3"  class="admin_table">
  <tr>
    <th scope="row" width="100" align="right">������&nbsp;</th>
    <td>
	  <select name="subsite_id" >
		<{section loop=$dq name="ls"}>
			<option value="<{$dq[ls].s_id}>" <{if $dq[ls].s_id==$dq_dq}> selected="selected" <{/if}>><{$dq[ls].s_districtname}></option>
		<{/section}>
	  </select>
	</td>
  </tr>
  <tr>
    <th scope="row" width="100" align="right">��ҵid��&nbsp;</th>
    <td>&nbsp;<input type="text" name="qid" size="40" value="<{$data.uid}>" /></td>
  </tr>
  <tr>
    <th scope="row" align="right">��ҵ�û�����&nbsp;</th>
    <td>&nbsp;<input type="text" name="username" size="40" value="<{$data.username}>" /></td>
  </tr>
  <tr>
    <th scope="row" align="right">��ҵ��˾����&nbsp;</th>
    <td>&nbsp;<input type="text" name="title" size="40" value="<{$data.companyname}>" /></td>
  </tr>
  <tr>
    <th scope="row" align="right">��ҵlogo��&nbsp;</th>
    <td>&nbsp;
    	<img src="/data/logo/<{$data.logo}>" class="xsgslogo"/>
    	<input type="hidden" name="pic" value="<{$data.logo}>" />
    </td>
  </tr>
  <tr>
    <th scope="row" align="right">��ҵ���ܣ�&nbsp;</th>
    <td>&nbsp;<textarea rows="10" cols="60" class="qyjs" name="contents"><{$data.contents}></textarea></td>
  </tr>
  <tr>
    <th scope="row" align="right">��ҵ���ͣ�&nbsp;</th>
    <td>
	  <select name="huiyuan" >
		<option value="1">��ʽ��Ա</option>
		<option value="2">��������Ա</option>
		<option value="3">�������ͻ�Ա</option>
	  </select>
	</td>
  </tr>
  <tr>
    <th scope="row" align="right">��ҵ�绰��&nbsp;</th>
    <td>&nbsp;<input type="text" name="phone" size="40" value="<{$data.telephone}>" /></td>
  </tr>
  <tr>
    <th scope="row" align="right">��ҵ���䣺&nbsp;</th>
    <td>&nbsp;<input type="text" name="email" size="40" value="<{$data.email}>" /></td>
  </tr>
  <tr>
    <th scope="row" align="right">���۴���: &nbsp;</th>
    <td>&nbsp;<input type="text" name="xs_user" size="40" value="<{$data.xs_user}>" /></td>
  </tr>
</table>
<input type="submit" value="�ύ" class="admin_submit" />
</form>
<!---->
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