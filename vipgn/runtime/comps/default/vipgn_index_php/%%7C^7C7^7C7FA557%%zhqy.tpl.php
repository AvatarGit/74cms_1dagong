<?php /* Smarty version 2.6.18, created on 2015-08-22 10:18:27
         compiled from index/zhqy.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'replace', 'index/zhqy.tpl', 72, false),array('modifier', 'date_format', 'index/zhqy.tpl', 75, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<link href="<?php echo $this->_tpl_vars['public']; ?>
/css/common.css" rel="stylesheet" type="text/css">
<link href="<?php echo $this->_tpl_vars['public']; ?>
/css/zhqy.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo $this->_tpl_vars['public']; ?>
/js/jquery.js"></script>
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
	<div class="ptit"> �鿴 <?php echo $this->_tpl_vars['jobfair_text']; ?>
 Ԥ������</div>
  <div class="clear"></div>
</div>

<div class="toptip">
<h2>�鿴: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo $this->_tpl_vars['app']; ?>
/excel/zhqy/zhid/<?php echo $this->_tpl_vars['zid']; ?>
">����Excel</a></h2>
</div>

<input type="button" value="���" class="tj admin_submit">&nbsp;&nbsp;
| &nbsp;&nbsp;
<form action="<?php echo $this->_tpl_vars['url']; ?>
/selssqy" method="post" style="display:inline-block;">
<input type="hidden" name="id" value="<?php echo $this->_tpl_vars['zid']; ?>
" />
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
<?php unset($this->_sections['ls']);
$this->_sections['ls']['loop'] = is_array($_loop=$this->_tpl_vars['data']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['ls']['name'] = 'ls';
$this->_sections['ls']['show'] = true;
$this->_sections['ls']['max'] = $this->_sections['ls']['loop'];
$this->_sections['ls']['step'] = 1;
$this->_sections['ls']['start'] = $this->_sections['ls']['step'] > 0 ? 0 : $this->_sections['ls']['loop']-1;
if ($this->_sections['ls']['show']) {
    $this->_sections['ls']['total'] = $this->_sections['ls']['loop'];
    if ($this->_sections['ls']['total'] == 0)
        $this->_sections['ls']['show'] = false;
} else
    $this->_sections['ls']['total'] = 0;
if ($this->_sections['ls']['show']):

            for ($this->_sections['ls']['index'] = $this->_sections['ls']['start'], $this->_sections['ls']['iteration'] = 1;
                 $this->_sections['ls']['iteration'] <= $this->_sections['ls']['total'];
                 $this->_sections['ls']['index'] += $this->_sections['ls']['step'], $this->_sections['ls']['iteration']++):
$this->_sections['ls']['rownum'] = $this->_sections['ls']['iteration'];
$this->_sections['ls']['index_prev'] = $this->_sections['ls']['index'] - $this->_sections['ls']['step'];
$this->_sections['ls']['index_next'] = $this->_sections['ls']['index'] + $this->_sections['ls']['step'];
$this->_sections['ls']['first']      = ($this->_sections['ls']['iteration'] == 1);
$this->_sections['ls']['last']       = ($this->_sections['ls']['iteration'] == $this->_sections['ls']['total']);
?>
  <tr class="tab">
    <td class="admin_list" align="left" style="padding-left:5px;"><input type="checkbox" name="id[]" value='<?php echo $this->_tpl_vars['data'][$this->_sections['ls']['index']]['id']; ?>
'><?php echo $this->_tpl_vars['data'][$this->_sections['ls']['index']]['username']; ?>
</td>
    <td class="admin_list"><?php echo $this->_tpl_vars['data'][$this->_sections['ls']['index']]['title']; ?>
</td>
	<td class="admin_list" align="center"><?php echo $this->_tpl_vars['data'][$this->_sections['ls']['index']]['xs_user']; ?>
</td>
	<td class="admin_list" align="center"><?php echo $this->_tpl_vars['data'][$this->_sections['ls']['index']]['dq']; ?>
</td>
    <td class="admin_list" align="center"><?php echo $this->_tpl_vars['data'][$this->_sections['ls']['index']]['phone']; ?>
</td>
    <td class="admin_list" align="center"><?php echo $this->_tpl_vars['data'][$this->_sections['ls']['index']]['email']; ?>
</td>
    <td class="admin_list" align="center"><?php echo $this->_tpl_vars['data'][$this->_sections['ls']['index']]['number']; ?>
</td>
	<td class="admin_list" align="center"><?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['data'][$this->_sections['ls']['index']]['huiyuan'])) ? $this->_run_mod_handler('replace', true, $_tmp, '0', "��ʽ��Ա") : smarty_modifier_replace($_tmp, '0', "��ʽ��Ա")))) ? $this->_run_mod_handler('replace', true, $_tmp, '2', "�������") : smarty_modifier_replace($_tmp, '2', "�������")))) ? $this->_run_mod_handler('replace', true, $_tmp, '3', "��������") : smarty_modifier_replace($_tmp, '3', "��������")))) ? $this->_run_mod_handler('replace', true, $_tmp, '4', "�����û�") : smarty_modifier_replace($_tmp, '4', "�����û�")); ?>
</td>
	<td class="admin_list" align="center"><?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['data'][$this->_sections['ls']['index']]['yhtype'])) ? $this->_run_mod_handler('replace', true, $_tmp, '1', "�ײ��û�") : smarty_modifier_replace($_tmp, '1', "�ײ��û�")))) ? $this->_run_mod_handler('replace', true, $_tmp, '2', "�����û�") : smarty_modifier_replace($_tmp, '2', "�����û�")))) ? $this->_run_mod_handler('replace', true, $_tmp, '3', "��ʱ�û�") : smarty_modifier_replace($_tmp, '3', "��ʱ�û�")))) ? $this->_run_mod_handler('replace', true, $_tmp, '4', "��") : smarty_modifier_replace($_tmp, '4', "��")); ?>
</td>
	<td class="admin_list" align="center"><?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['data'][$this->_sections['ls']['index']]['online_aoto'])) ? $this->_run_mod_handler('replace', true, $_tmp, '1', "�Զ�Ԥ��") : smarty_modifier_replace($_tmp, '1', "�Զ�Ԥ��")))) ? $this->_run_mod_handler('replace', true, $_tmp, '2', "����Ԥ��") : smarty_modifier_replace($_tmp, '2', "����Ԥ��")))) ? $this->_run_mod_handler('replace', true, $_tmp, '3', "�ֶ����") : smarty_modifier_replace($_tmp, '3', "�ֶ����")))) ? $this->_run_mod_handler('replace', true, $_tmp, '4', "��") : smarty_modifier_replace($_tmp, '4', "��")); ?>
</td>
	<td class="admin_list" align="center"><?php echo ((is_array($_tmp=$this->_tpl_vars['data'][$this->_sections['ls']['index']]['add_time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d %H:%M:%S") : smarty_modifier_date_format($_tmp, "%Y-%m-%d %H:%M:%S")); ?>
</td>
	<td class="admin_list" align="center"><a href="<?php echo $this->_tpl_vars['url']; ?>
/gzw/id/<?php echo $this->_tpl_vars['data'][$this->_sections['ls']['index']]['id']; ?>
">����չλ</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo $this->_tpl_vars['url']; ?>
/gdel/id/<?php echo $this->_tpl_vars['data'][$this->_sections['ls']['index']]['id']; ?>
/zhid/<?php echo $this->_tpl_vars['zid']; ?>
" onclick="return confirm('��ȷ��Ҫɾ����')">ɾ��</a></div>
  <td class="admin_list" align="left"><?php echo $this->_tpl_vars['data'][$this->_sections['ls']['index']]['text']; ?>
</td>
  </tr>
<?php endfor; else: ?>
   <tr>
     <td colspan="9">��ʱû���ҵ��û�!</td>
   </tr>
<?php endif; ?>

<tr>
  <td colspan="10" class="admin_list"><?php echo $this->_tpl_vars['fpage']; ?>
</td>
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
        <?php unset($this->_sections['ls']);
$this->_sections['ls']['loop'] = is_array($_loop=$this->_tpl_vars['all']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['ls']['name'] = 'ls';
$this->_sections['ls']['show'] = true;
$this->_sections['ls']['max'] = $this->_sections['ls']['loop'];
$this->_sections['ls']['step'] = 1;
$this->_sections['ls']['start'] = $this->_sections['ls']['step'] > 0 ? 0 : $this->_sections['ls']['loop']-1;
if ($this->_sections['ls']['show']) {
    $this->_sections['ls']['total'] = $this->_sections['ls']['loop'];
    if ($this->_sections['ls']['total'] == 0)
        $this->_sections['ls']['show'] = false;
} else
    $this->_sections['ls']['total'] = 0;
if ($this->_sections['ls']['show']):

            for ($this->_sections['ls']['index'] = $this->_sections['ls']['start'], $this->_sections['ls']['iteration'] = 1;
                 $this->_sections['ls']['iteration'] <= $this->_sections['ls']['total'];
                 $this->_sections['ls']['index'] += $this->_sections['ls']['step'], $this->_sections['ls']['iteration']++):
$this->_sections['ls']['rownum'] = $this->_sections['ls']['iteration'];
$this->_sections['ls']['index_prev'] = $this->_sections['ls']['index'] - $this->_sections['ls']['step'];
$this->_sections['ls']['index_next'] = $this->_sections['ls']['index'] + $this->_sections['ls']['step'];
$this->_sections['ls']['first']      = ($this->_sections['ls']['iteration'] == 1);
$this->_sections['ls']['last']       = ($this->_sections['ls']['iteration'] == $this->_sections['ls']['total']);
?>
        <div class="z yd" title="���չλ��û��Ԥ����"><span class="yc"> <?php echo $this->_tpl_vars['all'][$this->_sections['ls']['index']]['number']; ?>
 </span></div>
        <?php endfor; endif; ?>
      </div>
      <div class="yyd">
        <p style="text-align: center; padding-bottom: 10px;">�Ѿ���Ԥ����չλ (�s�ިt) </p>
        <!--Ԥ������չλ-->
        <?php unset($this->_sections['ls']);
$this->_sections['ls']['loop'] = is_array($_loop=$this->_tpl_vars['ok']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['ls']['name'] = 'ls';
$this->_sections['ls']['show'] = true;
$this->_sections['ls']['max'] = $this->_sections['ls']['loop'];
$this->_sections['ls']['step'] = 1;
$this->_sections['ls']['start'] = $this->_sections['ls']['step'] > 0 ? 0 : $this->_sections['ls']['loop']-1;
if ($this->_sections['ls']['show']) {
    $this->_sections['ls']['total'] = $this->_sections['ls']['loop'];
    if ($this->_sections['ls']['total'] == 0)
        $this->_sections['ls']['show'] = false;
} else
    $this->_sections['ls']['total'] = 0;
if ($this->_sections['ls']['show']):

            for ($this->_sections['ls']['index'] = $this->_sections['ls']['start'], $this->_sections['ls']['iteration'] = 1;
                 $this->_sections['ls']['iteration'] <= $this->_sections['ls']['total'];
                 $this->_sections['ls']['index'] += $this->_sections['ls']['step'], $this->_sections['ls']['iteration']++):
$this->_sections['ls']['rownum'] = $this->_sections['ls']['iteration'];
$this->_sections['ls']['index_prev'] = $this->_sections['ls']['index'] - $this->_sections['ls']['step'];
$this->_sections['ls']['index_next'] = $this->_sections['ls']['index'] + $this->_sections['ls']['step'];
$this->_sections['ls']['first']      = ($this->_sections['ls']['iteration'] == 1);
$this->_sections['ls']['last']       = ($this->_sections['ls']['iteration'] == $this->_sections['ls']['total']);
?>
        <div class="z ydl" title="���չλ��<?php echo $this->_tpl_vars['ok'][$this->_sections['ls']['index']]['title']; ?>
Ԥ���ˣ����´�������!"><span class="yc"><?php echo $this->_tpl_vars['ok'][$this->_sections['ls']['index']]['number']; ?>
</span></div>
        <?php endfor; endif; ?>
      </div>
    <!--**********************-->
  <input type="hidden" name="number" id="number" value="" />
  <input type="hidden" name="zid" value="<?php echo $this->_tpl_vars['zid']; ?>
" />
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
    <td><?php echo $this->_tpl_vars['dq']; ?>
</td>
  <input type="hidden" name="subsite_id" value="<?php echo $this->_tpl_vars['dqid']; ?>
" />
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
<input type="button" value="���" class="admin_submit sub" url="<?php echo $this->_tpl_vars['url']; ?>
/jinji">
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