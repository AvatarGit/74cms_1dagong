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
<body style="background-color:#E0F0FE; width:120%;">
<div class="admin_main_nr_dbox">

 <div class="pagetit">
	<div class="ptit"> �鿴 <{$jobfair_text}> Ԥ������</div>
  <div class="clear"></div>
</div>

<div class="toptip">
<h2>�鿴: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<{$app}>/excel/zhqy/zhid/<{$zid}>">����Excel</a></h2>
</div>

<input type="button" value="���" class="tj admin_submit">&nbsp;&nbsp;
| &nbsp;&nbsp;
<form action="<{$url}>/selssqy" method="post" style="display:inline-block;">
<input type="hidden" name="id" value="<{$zid}>" />
<input type="text" name="name" >
<input type="submit" value="����" >
</form>
<hr />
<br />
<table width="100%" border="0" cellpadding="0" cellspacing="0" id="list" class="link_bk" >
  <tr>
  <th scope="col" class="admin_list_tit" width="130" align="left" style="padding-left:5px;"><input type="checkbox" />��ҵ�û���</th>
  <th scope="col" class="admin_list_tit" width="220" align="left">��ҵ��˾��</th>
    <th scope="col" class="admin_list_tit" width="60" align="center">���۴���</th>
	<th scope="col" class="admin_list_tit" width="60" align="center">����</th>
  <th scope="col" class="admin_list_tit" width="80" align="center">��ҵ�绰</th>
  <th scope="col" class="admin_list_tit" width="150" align="center">��ҵ����</th>
  <th scope="col" class="admin_list_tit" width="50" align="center">չλ��</th>
  <th scope="col" class="admin_list_tit" width="80" align="center">��Ա����</th>
	<th scope="col" class="admin_list_tit" width="65" align="center">�ײ�����</th>
	<th scope="col" class="admin_list_tit" width="65" align="center">Ԥ����ʽ</th>
	<th scope="col" class="admin_list_tit" width="120" align="center">Ԥ��ʱ��</th>
	<th scope="col" class="admin_list_tit" width="120" align="center">����</th>
  <th scope="col" class="admin_list_tit" align="center">��ע</th>
  </tr>
<{section loop=$data name="ls"}>
  <tr class="tab">
    <td class="admin_list" align="left" style="padding-left:5px;"><input type="checkbox" name="id[]" value='<{$data[ls].id}>'><{$data[ls].username}></td>
    <td class="admin_list"><{$data[ls].title}></td>
	<td class="admin_list" align="center"><{$data[ls].xs_user}></td>
	<td class="admin_list" align="center"><{$data[ls].dq}></td>
    <td class="admin_list" align="center"><{$data[ls].phone}></td>
    <td class="admin_list" align="center"><{$data[ls].email}></td>
    <td class="admin_list" align="center"><{$data[ls].number}></td>
	<td class="admin_list" align="center"><{$data[ls].huiyuan|replace:"0":"��ʽ��Ա"|replace:"2":"�������"|replace:"3":"��������"|replace:"4":"�����û�"}></td>
	<td class="admin_list" align="center"><{$data[ls].yhtype|replace:"1":"�ײ��û�"|replace:"2":"�����û�"|replace:"3":"��ʱ�û�"|replace:"4":"��"}></td>
	<td class="admin_list" align="center"><{$data[ls].online_aoto|replace:"1":"�Զ�Ԥ��"|replace:"2":"����Ԥ��"|replace:"3":"�ֶ����"|replace:"4":"��"}></td>
	<td class="admin_list" align="center"><{$data[ls].add_time|date_format:"%Y-%m-%d %H:%M:%S"}></td>
	<td class="admin_list" align="center"><a href="<{$url}>/gzw/id/<{$data[ls].id}>">����չλ</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="<{$url}>/gdel/id/<{$data[ls].id}>/zhid/<{$zid}>" onclick="return confirm('��ȷ��Ҫɾ����')">ɾ��</a></div>
  <td class="admin_list" align="left"><{$data[ls].text}></td>
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

<script type="text/javascript">
  $(function(){
      $(".tj").click(function(){
          $(".box").show();
      })
      //--------------------------------------------
      $(".yd").click(function(){
          var a=$(this).text();
          $("#number").val(a);
          $(".yd").css("color","#000");
          $(this).css("color","red");
      });
      //--------------------------------------------
      $(".ydl").click(function(){
          alert("���չλ��Ԥ���� �����n����");
      })
      //--------------------------------------------
      $(".sub").click(function(){
          var url=$(this).attr("url");
          var number=$("#number").val(),
              zid=$("input[name=zid]").val(),
              yhtype=$("input[name=yhtype]").val(),
              online_aoto=$("input[name=online_aoto]").val(),
              title=$("input[name=title]").val(),
              subsite_id=$("input[name=subsite_id]").val(),
              qq=$("input[name=qq]").val(),
              phone=$("input[name=phone]").val(),
              email=$("input[name=email]").val(),
			  xs_user=$("input[name=xs_user]").val(),
              text=$("textarea[name=text]").val();
			  //��֤�Ƿ��Ƿ�����-------------------------
			  if(number==""){
					alert("չλ�ű���ѡ�񣡲ſ���Ԥ����");
			  }else if(title==""){
					alert("��ҵ��˾������ѡ�񣡲ſ���Ԥ����");
			  }else{
			  //--------------------------
				  $.post(url, { number:number,zid:zid,yhtype:yhtype,online_aoto:online_aoto,title:title,subsite_id:subsite_id,qq:qq,phone:phone,email:email,text:text,xs_user:xs_user },
				  function(data){
					  alert(data);
					  window.location.reload(); 
				  });
			  }
      })
  });
  //--------------------
  function gb(){
     $(".box").hide();
  };

</script>
<!--***************************************-->
<div class="box">
    <div class="ock" onclick="gb();"> </div>
    <div class="nr">

      <div class="myd">
        <p style="text-align: center; padding-bottom: 10px;">û�б�Ԥ����չλ o(��_��)o </p>
        <!--û��Ԥ����չλ-->
        <{section loop=$all name="ls"}>
        <div class="z yd" title="���չλ��û��Ԥ����"><span class="yc"> <{$all[ls].number}> </span></div>
        <{/section}>
      </div>
      <div class="yyd">
        <p style="text-align: center; padding-bottom: 10px;">�Ѿ���Ԥ����չλ (�s�ިt) </p>
        <!--Ԥ������չλ-->
        <{section loop=$ok name="ls"}>
        <div class="z ydl" title="���չλ��<{$ok[ls].title}>Ԥ���ˣ����´�������!"><span class="yc"><{$ok[ls].number}></span></div>
        <{/section}>
      </div>
    <!--**********************-->
  <input type="hidden" name="number" id="number" value="" />
  <input type="hidden" name="zid" value="<{$zid}>" />
  <input type="hidden" name="yhtype" value="3" />
  <input type="hidden" name="online_aoto" value="3" />
  <div style="float:none;"></div>
  <table width="100%" border="0" cellpadding="3" cellspacing="3"  class="admin_table" style="float:left; margin-top: 10px; ">
  <tr>
    <th scope="row" align="right" width="100">��ҵ��˾����&nbsp;</th>
    <td width="240">&nbsp;<input type="text" name="title" size="40" value="" /></td>
    <td rowspan="5">
      <span style="font-size: 12px; font-weight: bolder;">��ע��</span><br/>
      <textarea rows="8" cols="33" name="text"></textarea>
    </td>
  </tr>
  <tr>
    <th scope="row" align="right">������</th>
    <td><{$dq}></td>
  <input type="hidden" name="subsite_id" value="<{$dqid}>" />
  </tr>
  <tr>
    <th scope="row" align="right">��ҵqq��&nbsp;</th>
    <td>&nbsp;<input type="text" name="qq" size="40" value="" /></td>
  </tr>
  <tr>
    <th scope="row" align="right">��ҵ�绰��&nbsp;</th>
    <td>&nbsp;<input type="text" name="phone" size="40" value="" /></td>
  </tr>
  <tr>
    <th scope="row" align="right">��ҵ���䣺&nbsp;</th>
    <td>&nbsp;<input type="text" name="email" size="40" value="" /></td>
  </tr>
  <tr>
    <th scope="row" align="right">���۴���&nbsp;</th>
    <td>&nbsp;<input type="text" name="xs_user" size="40" value="" /></td>
  </tr>
</table>
<input type="button" value="���" class="admin_submit sub" url="<{$url}>/jinji">
    </div>
</div>
<!--***************************************-->
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