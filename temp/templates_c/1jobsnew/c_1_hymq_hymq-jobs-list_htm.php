<?php require_once('D:\fengmf\wwwroot\74cms_1dagong\include\template_lite\plugins\modifier.cat.php'); $this->register_modifier("cat", "tpl_modifier_cat",false);  require_once('D:\fengmf\wwwroot\74cms_1dagong\include\template_lite\plugins\function.qishi_hymq_jobs_list.php'); $this->register_function("qishi_hymq_jobs_list", "tpl_function_qishi_hymq_jobs_list",false);  /* V2.10 Template Lite 4 January 2007  (c) 2005-2007 Mark Dickenson. All rights reserved. Released LGPL. 2018-09-28 15:00 �й���׼ʱ�� */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>��ҵ������Ƹ  - <?php echo $this->_vars['QISHI']['site_name']; ?>
</title>
<meta name="description" content="Ҽ������ҵ����Ƶ�����ṩȫ��������ҵ��ͨ��Ƹ��������Ƹ��ͬʱ�ṩ�Ϸ�������Ƹ����ɽ�ʱ���Ƹ���Ϻ������Ե��й���Ϣ��">
<meta name="keywords" content="������Ƹ��������Ƹ���չ���Ƹ">
<meta name="author" content="Ҽ����" />
<meta name="copyright" content="1dagong.com" />
<meta http-equiv="X-UA-Compatible" content="IE=7">
<link rel="shortcut icon" href="favicon.ico" />
<link href="/files/css/jobs.css" rel="stylesheet" type="text/css" />
<link href="/files/css/common.css" rel="stylesheet" type="text/css" />

<link href="../files/css/all.css" rel="stylesheet" type="text/css" />
<link href="../files/css/font-awesome.min.css" rel="stylesheet" >

<link href="/files/css/company.css" rel="stylesheet" type="text/css" />
<script src="/files/js/jquery.js" type="text/javascript" language="javascript"></script>
<script src="/files/js/jquery.hoverDelay.js" type='text/javascript'></script>

<script src="/data/cache_classify.js" type='text/javascript' charset="utf-8"></script>
<!--����js-->
<script src="/files/js/jquery.hymq-jobs-search.js" type='text/javascript' ></script>
<!--����js-->
</head>
<body>
<!--ͷ����ʼ-->
	<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include("header.htm", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>
	<!--ͷ������-->
<!-- ��ǰλ�� -->
<!--<div class="page_location link_bk">
	��ǰλ�ã�<a href="/">��ҳ</a>>��ҳ
</div>
-->	<!-- �������� -->
    
    
    
<div class="kuang over">
	<div class="left_list"> 
    	
        <div class="com_sousuo">
            <dl class="reset">
                    <dt>��ҵ����</dt>
                    <dd id="hangye">
                     <a class="ye" href="/hymq/jobs-list.php" id="41">����</a>   
                     <a href="/hymq/jobs-list.php?jobcategory=30.0&citycategory=&settr=" id="53">����/�г�</a>
                     <a href="/hymq/jobs-list.php?jobcategory=42.0&citycategory=&settr=" id="50">��Ӫ����</a>
                     <a href="/hymq/jobs-list.php?jobcategory=56.0&citycategory=&settr=" id="46">IT����/����֧��</a>
                     <a href="/hymq/jobs-list.php?jobcategory=211.0&citycategory=&settr=" id="49">����/�ִ�/�ɹ�</a>
                     <a href="/hymq/jobs-list.php?jobcategory=157.0&citycategory=&settr=" id="52">����/װ��</a>
                     <a href="/hymq/jobs-list.php?jobcategory=369.0&citycategory=&settr=" id="151">����/����</a>
                     <a href="/hymq/jobs-list.php?jobcategory=413.0&citycategory=&settr=" id="47">�Ƶ�/����/����/����</a>
                     <a href="/hymq/jobs-list.php?jobcategory=424.0&citycategory=&settr=" id="51">����/Ħ�г�����</a>
                    </dd>
                </dl>
                 <dl class="reset">
                    <dt>����������</dt>
                    <dd  class="option" id="jobsuptime">
                    <a class="ye" title="" href="/hymq/jobs-list.php" id="-1">����</a>
                    <a href="/hymq/jobs-list.php?jobcategory=&citycategory=13.224&settr=" id="settr-3">�Ϸ�</a>
                    <a href="/hymq/jobs-list.php?jobcategory=&citycategory=2.0&settr=" id="settr-7">�Ϻ�</a>
                    <a href="/hymq/jobs-list.php?jobcategory=&citycategory=13.225&settr=" id="settr-30">�ߺ�</a>
                    <a href="/hymq/jobs-list.php?jobcategory=&citycategory=13.226&settr=" id="settr-30">����</a>
                    <a href="/hymq/jobs-list.php?jobcategory=&citycategory=4.0&settr=" id="settr-30">����</a>
                    <a href="/hymq/jobs-list.php?jobcategory=&citycategory=18.0&settr=" id="settr-30">����</a>
                    <a href="/hymq/jobs-list.php?jobcategory=&citycategory=11.204&settr=" id="settr-30">����</a>
                    <a href="/hymq/jobs-list.php?jobcategory=&citycategory=11.201&settr=" id="settr-30">����</a>
                    </dd>
                </dl>
                <dl class="reset">
                    <dt>����ʱ�䣺</dt>
                    <dd>
                    <a class="ye" title="" href="/hymq/jobs-list.php" id="-1">����</a>
                    <a href="/hymq/jobs-list.php?jobcategory=&settr=1" id="settr-1">1����</a>
                    <a href="/hymq/jobs-list.php?jobcategory=&settr=3" id="settr-3">3����</a>
                    <a href="/hymq/jobs-list.php?jobcategory=&settr=7" id="settr-7">7����</a>
                    <a href="/hymq/jobs-list.php?jobcategory=&settr=15" id="settr-15">15����</a>
                    <a href="/hymq/jobs-list.php?jobcategory=&settr=30" id="settr-30">30����</a>
                    </dd>
                </dl>
        </div>
    <!--<div class="jobselected" id="jobselected">
	<div class="tit">��ѡ������</div>
	<div class="showselected" id="showselected"></div>
	<div class="clearjobs" id="clearallopt">�����ѡ��</div>
	<div class="clear"></div>
	</div>-->
<?php echo tpl_function_qishi_hymq_jobs_list(array('set' => "��ҳ��ʾ:12,�б���:jobslist,��ʾ��Ŀ:6,��ַ�:...,ְλ������:13,��ҵ������:19,��������:65,�ؼ���:GET[key],ְλ����:GET[jobcategory],ְλ����:GET[category],ְλС��:GET[subclass],��������:GET[citycategory],��������:GET[district],����С��:GET[sdistrict],��ҵ:GET[trade],���ڷ�Χ:GET[settr],����:GET[wage],����:GET[age],��˾��ģ:GET[scale],����:id>desc"), $this);?>
        <div class="in-list">
        	<?php if (count((array)$this->_vars['jobslist'])): foreach ((array)$this->_vars['jobslist'] as $this->_vars['list']): ?>
        	 <div class="in-list-con awidth <?php if ($this->_vars['list']['y'] % 3 == 0): ?>mrnone<?php endif; ?>" title="<?php echo $this->_vars['list']['companyname']; ?>
">
            	<h3><a href="<?php echo $this->_vars['list']['jobs_url']; ?>
"><?php echo $this->_vars['list']['companyname']; ?>
</a></h3>
                <P>�� �� �ʣ�<span><?php echo $this->_vars['list']['wage_cn']; ?>
</span></P>
                <P>�� �� վ��<?php echo $this->_vars['list']['jiezhan']; ?>
</P>
                <P class="infdk"><?php echo $this->_vars['list']['shortitle']; ?>
</P>
                <a href="<?php echo $this->_vars['list']['jobs_url']; ?>
"><img src="/data/hymq_img/<?php echo $this->_vars['list']['logo']; ?>
" width="220px" height="101px" /></a>
                <div class="over wdids">
                	<p class="fl"><strong><?php echo $this->_vars['list']['bmrenshu'];  echo $this->_vars['trade']; ?>
��</strong>����</p>
                    <a href="<?php echo $this->_vars['list']['jobs_url']; ?>
">ȥ����</a>
                </div>
               <div class="<?php if ($this->_vars['list']['zp_cn'] == '��Ƹ'): ?>hot<?php endif; ?> <?php if ($this->_vars['list']['zp_cn'] == '��Ƹ'): ?>urgent<?php endif; ?>"></div>
           </div>
			<?php endforeach; endif; ?>
          
        </div>   
        <?php if (! $this->_vars['jobslist']): ?>
		<div class="emptytip">��Ǹ��û�з��ϴ���������Ϣ��</div>
		<?php endif; ?>
         <div class="over"></div>  
<table border="0" align="center" cellpadding="0" cellspacing="0" class="link_bk">
          <tr>
            <td height="50" align="center"><?php if ($this->_vars['page']): ?><div class="page link_bk"><?php echo $this->_vars['page']; ?>
</div><?php endif; ?></td>
          </tr>
      </table>    </div>
    
    <div class="right_list">
    	<div class="ewma">
        	<img src="/files/img/app.jpg" title="Ҽ�����ͻ���"  />
            ɨ���ά�룬�ֻ������ҹ���
        </div>
        
        <div class="rzhao">
        	<h2>�����Ƹ��ҵ</h2>
            
            <ul class="rzlist">
            	<?php echo tpl_function_qishi_hymq_jobs_list(array('set' => $this->_run_modifier("�б���:jobs,��ʾ��Ŀ:5,��ַ�:...,ְλ������:13,��ҵ������:19,����:id > asc,��ҵ:", 'cat', 'plugin', 1, $this->_vars['trade'])), $this);?>
				<?php if (count((array)$this->_vars['jobs'])): foreach ((array)$this->_vars['jobs'] as $this->_vars['list']): ?>
            	<li>
                	<h3><a href="<?php echo $this->_vars['list']['jobs_url']; ?>
"><?php echo $this->_vars['list']['companyname']; ?>
</a></h3>
                    <p><?php echo $this->_vars['list']['shortitle']; ?>
</p>
                    <font>��н��Χ��<?php echo $this->_vars['list']['wage_cn']; ?>
</font>
                </li>
                <?php endforeach; endif; ?>
                
            </ul>
        </div>
    </div>
</div>



	<!-- �������� ���� -->
<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include("footer.htm", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>
</body>
</html>