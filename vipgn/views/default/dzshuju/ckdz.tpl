<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<link href="<{$public}>/css/common.css" rel="stylesheet" type="text/css">
<link href="<{$public}>/css/zhqy.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<{$public}>/js/jquery.js"></script>
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
  <div class="ptit"> �鿴�λ���ҵ </div>
  <div class="clear"></div>
</div>

<div class="toptip">
<h2>�鿴: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<{$app}>/excel/qyzhanghui/id/<{$qid}>">����Excel</a></h2>
</div>
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
<{section loop=$data name="ls"}>
  <tr class="tab">
  <td class="admin_list" align="left" style="padding-left:10px;"><input type="checkbox" name="id[]" value='<{$data[ls].id}>'><{$data[ls].qytitle}></td>
  <td class="admin_list" align="center"><{$data[ls].holddates|date_format:"%Y-%m-%d"}></td>
  <td class="admin_list"><{$data[ls].title}></td>
  <td class="admin_list" align="center"><{$data[ls].xs_user}></td>
  <td class="admin_list" align="center"><{$data[ls].dq}></td>
  <td class="admin_list" align="center"><{$data[ls].number}></td>
  <td class="admin_list" align="center"><{$data[ls].yhtype|replace:"1":"�ײ��û�"|replace:"2":"�����û�"|replace:"3":"��ʱ�û�"}></td>
  <td class="admin_list" align="center"><{$data[ls].online_aoto|replace:"1":"�Զ�Ԥ��"|replace:"2":"����Ԥ��"|replace:"3":"�ֶ����"}></td>
  <td class="admin_list" align="center"><{$data[ls].add_time|date_format:"%Y-%m-%d"}></td>
  </tr>
<{sectionelse}>
   <tr>
     <td colspan="9">û���ҵ�!</td>
   </tr>
<{/section}>


<tr>
  <td colspan="9" class="admin_list"><{$fpage}></td>
<tr>

</table>

</div>
</body>
</html>