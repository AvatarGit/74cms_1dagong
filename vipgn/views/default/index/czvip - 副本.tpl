<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<link href="<{$public}>/css/common.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<{$public}>/js/jquery.js"></script>
<link href="<{$public}>/css/date_input.css" rel="stylesheet" type="text/css" />
<script type='text/javascript' src="<{$public}>/js/jquery.date_input.js" language="javascript"></script>
<title>�޸�</title>
</head>
<script>
$(document).ready(function(){
	//����
	$(function() { 
		$(".date_input").date_input(); 
	});
});

function bout(){
	return $('#boutj').val();
}

</script>
<body style="background-color:#E0F0FE">
<div class="admin_main_nr_dbox">

 <div class="pagetit">
	<div class="ptit"> �޸� </div>
  <div class="clear"></div>
</div>

<div class="toptip">
<h2>��ӣ�</h2>
</div>
<br />
<form action="<{$url}>/updata" method="post">
<input type="hidden" name="id" value="<{$data.id}>" />
<input type="hidden" name="bout1" value="<{$data.bout}>" />
<input type="hidden" name="bout1_6" value="<{$data.bout_6}>" />
<input type="hidden" name="subsite_id" value="<{$data.subsite_id}>" />
<input type="hidden" name="cs" value="1" />
��ǰʣ��չ�������<b><{$data.bout}></b><br /><br />

����������&nbsp;&nbsp;<input type="radio" value="1"  checked="checked" name="cz"/>����&nbsp;<input type="radio" value="2" name="cz"/>����<br />
����������<input type="text" name="bout"/><br />
<{ if $data.subsite_id == 5}>
��ǰʣ������������<b><{$data.bout_6}></b><br /><br />

����������&nbsp;&nbsp;<input type="radio" value="1"  checked="checked" name="cz_6"/>����&nbsp;<input type="radio" value="2" name="cz_6"/>����<br />
����������<input type="text" name="bout_6"/><br />
<{/if}>
<input type="submit" value="ȷ��" class="admin_submit" />
</form>
<hr />
<br />

<h3>�޸���Чʱ��</h3>
<form action="<{$url}>/updatasj" method="post">
<input type="hidden" name="id" value="<{$data.id}>" />
<!-------------------->
��ʼʱ�䣺<input type="text" name="cs_ks_time" class="date_input"  value="<{$smarty.now|date_format:'%Y-%m-%d'}>" /><br />
����ʱ�䣺<input type="text" name="cs_end_time" class="date_input"  value="" /><br />
<!-------------------->
<input type="submit" value="ȷ��" class="admin_submit" />
</form>
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