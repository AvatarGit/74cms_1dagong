<?php /* V2.10 Template Lite 4 January 2007  (c) 2005-2007 Mark Dickenson. All rights reserved. Released LGPL. 2018-07-09 15:14 �й���׼ʱ�� */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<meta http-equiv="X-UA-Compatible" content="IE=7">
<link rel="shortcut icon" href="<?php echo $this->_vars['QISHI']['site_dir']; ?>
favicon.ico" />
<title>Powered by 74CMS</title>
<link href="css/common.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function()
{
$("li").first().addClass("hover");
$("li>a").click(function(){
	$("li").removeClass("hover");
	$(this).parent().addClass("hover");
	$(this).blur();
	})
})
</script>
<style type="text/css">
.admin_left_box p{
	width: 80px;
	height: 23px;
	line-height: 23px;
	margin-left: 38px;
	font-size: 12px;
	font-weight: 400;
}
</style>
</head>
<body>
<div class="admin_left_box">
<ul>
<!---->
<li><a href="admin_vip.php"  target="mainFrame">vip�ײͽ���</a></li>
</ul>
<!--����url-->
<p>|-��Ƹ��-|</p>
<ul>
<li><a href="/../vipgn/index.php/index/?id=<?php echo $this->_vars['QISHI']['subsite_id']; ?>
"  target="mainFrame">�鿴��Ƹ��</a></li>
<!--<li><a href="/../vipgn/index.php/index/ckchqy/?id=<?php echo $this->_vars['QISHI']['subsite_id']; ?>
"  target="mainFrame">�鿴�λ���ҵ</a></li>-->
<li><a href="/../vipgn/index.php/dzshuju/?id=<?php echo $this->_vars['QISHI']['subsite_id']; ?>
"  target="mainFrame">�鿴��ҵԤ�����</a></li>
<li><a href="/../vipgn/index.php/dzshuju/sells"  target="mainFrame">�鿴��ʱ��ҵԤ�����</a></li>
</ul>
<p>|-�ײ�-|</p>
<ul>
<li><a href="admin_vip.php?act=selecttcvip"  target="mainFrame" >�鿴�ײͻ�Ա</a></li>
<li><a href="admin_vip.php?act=selectcsvip"  target="mainFrame" >�鿴������Ա</a></li>
<li><a href="/../vipgn/index.php/index/ssbl"  target="mainFrame">����</a></li>
</ul>
<p>|-��Ա-|</p>
<ul>
<li><a href="admin_vip.php?act=ckvip"  target="mainFrame">�鿴��Ա</a></li>
<li><a href="/../vipgn/index.php/index/addvip/?id=<?php echo $this->_vars['QISHI']['subsite_id']; ?>
"  target="mainFrame">��ӻ�Ա</a></li>
</ul>
<?php if ($this->_vars['name'] == "spadmin"): ?>
<p>|-����Ա-|</p>
<ul>
<li><a href="/../vipgn/index.php/adminuser"  target="mainFrame">�鿴Ȩ�޹���</a></li>
<li><a href="/../vipgn/index.php/adminuser/adminuseradd"  target="mainFrame">���Ȩ��</a></li>
<li><a href="/../vipgn/index.php/adminuser/rz"  target="mainFrame">�鿴��־</a></li>
</ul>
<?php else: ?>
<p>|-������-|</p>
<ul>
<li><a href="/../vipgn/index.php/adminuser/modmima/name/<?php echo $this->_vars['name']; ?>
"  target="mainFrame">�޸�Ȩ������</a></li>
<li><a href="/../vipgn/index.php/adminuser/rz"  target="mainFrame">�鿴��־</a></li>
</ul>
<?php endif; ?>
</div>
</body>
</html>