<!DOCTYPE HTML>
<html>
	<head>
		<title>�ֻ��������˲���</title>
		<meta http-equiv="content-type" content="text/html; charset=gb2312" />
		<link rel="shortcut icon" href="<{$res}>/images/favicon.ico" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
		<meta name="keywords" content="�Ϸ��˲���,�Ϸ���Ƹ��,�������˲���,�����˲���,�Ϸ��˲��г�" />
		<meta name="description" content="�Ϸ��˲����ǰ��պϷ���Ƹ��ְ��ѡ���˲�����ͬʱҲ�ǰ���ʡ�������˲��г���������ְ��Ƹƽ̨��" />
		<link href="<{$res}>/css/wap.css" rel="stylesheet" type="text/css" />
		<script src="js/jquery.min.js"></script>
	</head>
	<body>
	<div class="top">
		<div class="top1">
		<a href="<{$url}>/index">
			<img src="/data/images/wap_logo.gif" alt="�������˲���" border="0" align="absmiddle" />
		</a>
		<{if $user==""}>
		<span><a href="<{$url}>/login">��Ա��¼</a>&nbsp;&nbsp;<a href="../../user/user_reg.php">ע��</a></span>
		<{else}>
		<span><a href="#"><{$user.username}></a>&nbsp;&nbsp;<a href="<{$url}>/tologin">�˳�</a></a></span>
		<{/if}>
		</div>
	</div>

	<div class="dl">
	<form action="<{$url}>/dl" method="post">
		<table border="0" align="cen">
			<tr>
				<td align="right">�û�����</td>
				<td><input type="text" name="user" class="input"></td>
			</tr>
			<tr>
				<td align="right">���룺</td>
				<td><input type="password" name="pass" class="input"></td>
			</tr>
			<tr>
				<td colspan="2"><input type="submit" value="��¼" class="sub" /></td>
			</tr>
		</table>
	</form>
	</div>
	<div class="footer">
		<div class="db"></div>
		<div class="djies bj">
			<p>�������˲�������רҵ����ְ��Ƹ��վ���������찲���˲�����һƷ�ƣ�</p>
			<p>��ϵ��ַ���Ϸ��о��ÿ���������㳡�Ϻ�����  ����ʡ�������˲��г�  ��ϵ�绰��0551-62589728</p>
			<p>Copyright 2012-2013 www.1jobs.cn  ��ICP��12006327��-1</p>
		</div>
	</div>
	</body>
</html>

