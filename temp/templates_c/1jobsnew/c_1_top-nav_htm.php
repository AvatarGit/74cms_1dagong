<?php /* V2.10 Template Lite 4 January 2007  (c) 2005-2007 Mark Dickenson. All rights reserved. Released LGPL. 2018-07-09 15:14 �й���׼ʱ�� */ ?>
<a href="<?php echo $this->_vars['QISHI']['main_domain']; ?>
mobile/" class="mphone">�ֻ�Ƶ��</a>
<a href="<?php echo $this->_vars['QISHI']['main_domain']; ?>
salary">н��ͳ��</a>
<a href="/">��վ��ҳ</a>
<a href="/plus/shortcut.php">���浽����</a>
<script type="text/javascript">
//��������¼
$.get("/plus/ajax_user.php", {"act":"top_loginform"},
function (data,textStatus)
{			
$("#top_loginform").html(data);
}
);
</script>