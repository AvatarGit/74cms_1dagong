<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<link href="<{$public}>/css/common.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<{$public}>/js/jquery.js"></script>

<title>�鿴չ��</title>
</head>

<body style="background-color:#E0F0FE">
<div class="admin_main_nr_dbox">

 <div class="pagetit">
	<div class="ptit"> �鿴չ�� </div>
  <div class="clear"></div>
</div>

<div class="toptip">
<h2>�鿴��&nbsp;&nbsp;&nbsp;&nbsp;<a href="<{$url}>/index/id/<{$dqid}>">�鿴δ����</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="<{$url}>/indexckqb/id/<{$dqid}>">�鿴����</a></h2>
</div>

<{if $dq!=""}>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��ַ��&nbsp;
<{foreach from=$dq item=l}>  
	<a href="<{$url}>/index/id/0/dqid/<{$l.s_id}>"><{$l.s_districtname}></a>&nbsp;&nbsp;
<{/foreach}>
<{/if}>

<br />
<div class="pagetit">
<table width="100%" border="0" cellpadding="0" cellspacing="0" id="list" class="link_bk">
    <tbody><tr>
      <td height="26" class="admin_list_tit admin_list_first" width="120">
      <label id="chkAll" style="color: rgb(102, 102, 102);"><input type="checkbox" name=" " title="ȫѡ/��ѡ" id="chk">�ٰ�ʱ��</label>
	  </td>
      <td class="admin_list_tit">��Ƹ�����</td>
	  <td width="80" align="center" class="admin_list_tit"> ���� </td>
      <td width="80" align="center" class="admin_list_tit"> Ԥ��״̬ </td>
      <td width="180" align="center" class="admin_list_tit">Ԥ������</td>
      <td width="120" align="center" class="admin_list_tit">�������</td>
      <td width="100" align="center" class="admin_list_tit">����</td>
    </tr>
	<{section loop=$data name="ls"}>
	<tr style="">
		<td class="admin_list admin_list_first">
			<input name="id[]" type="checkbox" id="id" value="<{$data[ls].id}>">    
			<span"><{$data[ls].holddates|date_format:"%Y-%m-%d"}></span>
		</td>
		<td class="admin_list">
			<a href="<{$url}>/selqy/id/<{$data[ls].id}>"><span style="color:#005b7e;font-weight:bold;">�鿴����-><{$data[ls].title}><-��ҵ����</span></a>
		</td>
		<td align="center" class="admin_list">
			<{$data[ls].dq}>
		</td>
        <td align="center" class="admin_list">
		����Ԥ��	
		</td>
		<td align="center" class="admin_list">
			<{$data[ls].predetermined_start|date_format:"%Y-%m-%d"}>
			��
			<{$data[ls].predetermined_end|date_format:"%Y-%m-%d"}>
		</td>
        <td align="center" class="admin_list">
			<{$data[ls].addtime|date_format:"%Y-%m-%d"}>
		</td>
		<td align="center" class="admin_list">
			<a href="<{$url}>/addzw/id/<{$data[ls].id}>/dqid/<{$dqid}>">��չλ</a> &nbsp;&nbsp;
		</tr>
	  <{sectionelse}>
   <tr>
     <td colspan="7" class="admin_list">��ʱû���ҵ�չ�ᣬ�����ˢ������!</td>
   </tr>
<{/section}>
<tr>
	<td colspan="7" class="admin_list"><{$fpage}></td>
</tr>
    </tbody>
</table>
</div>
</div>
<div class="admin_frameset">
	<div id="open_frame" class="open_frame" title="ȫ��"></div>
	<div id="close_frame" class="close_frame" title="��ԭ����" style="display: none;"></div>
</div>
</body>