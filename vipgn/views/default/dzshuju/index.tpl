<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<link href="<{$public}>/css/common.css" rel="stylesheet" type="text/css">
<link href="<{$public}>/css/zhqy.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<{$public}>/js/jquery.js"></script>
<title>�鿴�λ���ҵ</title>
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
  <div class="ptit"> �鿴�Ĳλ���ҵ </div>
  <div class="clear"></div>
</div>

<div class="toptip">
<h2>�鿴: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<{if $dq!=""}>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��ַ��&nbsp;
<{foreach from=$dq item=l}>  
<a href="<{$url}>/index/id/0/dqid/<{$l.s_id}>"><{$l.s_districtname}></a>&nbsp;&nbsp;
<{/foreach}>
<{/if}>
</h2>
</div>

<form action="<{$url}>/index/id/<{$dqid}>" method="post" style="display:inline-block;">
������ҵ: <input type="text" name="name" >
<input type="hidden" name="dqid" value="<{$dqid}>" />
<input type="submit" value="����" >
</form>
<hr />
<br />

<table width="100%" border="0" cellpadding="0" cellspacing="0" id="list" class="link_bk" >
  <tr>
  <th scope="col" class="admin_list_tit" width="220" align="left" style="padding-left:10px;"><input type="checkbox" />��ҵ�û���</th>
  <th scope="col" class="admin_list_tit" width="320" align="left">��ҵ��˾��</th>
  <th scope="col" class="admin_list_tit" width="80" align="left">���۴���</th>
  <th scope="col" class="admin_list_tit" width="80" align="center">����</th>
  <th scope="col" class="admin_list_tit" width="80" align="center">��ҵqq</th>
  <th scope="col" class="admin_list_tit" width="120" align="center">��ҵ�绰</th>
  <th scope="col" class="admin_list_tit" width="180" align="center">��ҵ����</th>
  <th scope="col" class="admin_list_tit" width="100" align="center">����</th>
  </tr>
<{section loop=$data name="ls"}>
  <tr class="tab">
  <td class="admin_list" align="left" style="padding-left:10px;"><input type="checkbox" name="id[]" value='<{$data[ls].id}>'><{$data[ls].username}></td>
  <td class="admin_list"><a href="<{$url}>/ckdz/id/<{$data[ls].qid}>"><{$data[ls].title}></a></td>
  <td class="admin_list"><{$data[ls].xs_user}></td>
  <td class="admin_list" align="center"><{$data[ls].dq}></td>
  <td class="admin_list" align="center"><{$data[ls].qq}></td>
  <td class="admin_list" align="center"><{$data[ls].phone}></td>
  <td class="admin_list" align="center"><{$data[ls].email}></td>
  <td class="admin_list" align="center"><a href="<{$url}>/ckdz/id/<{$data[ls].qid}>">�鿴</a></td>
  </tr>
<{sectionelse}>
   <tr>
     <td colspan="9">��ʱû���ҵ��û�!</td>
   </tr>
<{/section}>

<tr>
  <td colspan="10" class="admin_list"><{$fpage}></td>
<tr>

</table>

</div>
</body>
</html>