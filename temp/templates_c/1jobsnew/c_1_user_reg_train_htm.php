<?php require_once('D:\fengmf\wwwroot\74cms_1dagong\include\template_lite\plugins\modifier.default.php'); $this->register_modifier("default", "tpl_modifier_default",false);  /* V2.10 Template Lite 4 January 2007  (c) 2005-2007 Mark Dickenson. All rights reserved. Released LGPL. 2018-07-13 16:38 �й���׼ʱ�� */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>��Աע��</title>
<link rel="shortcut icon" href="favicon.ico" />
<meta name="author" content="��ʿCMS" />
<meta name="copyright" content="74cms.com" />
<!--<link href="/files/css/user_common.css" rel="stylesheet" type="text/css" />
-->
<link href="/files/css/font-awesome.min.css" rel="stylesheet" >
<link href="/files/css/common.css" rel="stylesheet" type="text/css" />
<link href="/files/css/reg.css" rel="stylesheet" type="text/css" />
<!---->
<link href="/files/css/header.css" rel="stylesheet" type="text/css" />
<link href="/files/css/jobs.css" rel="stylesheet" type="text/css" />
<!---->
<script src="/files/js/jquery.js" type='text/javascript' language="javascript"></script>
<script src="/files/js/jquery.validate.min.js" type='text/javascript' language="javascript"></script>


<script src="/data/cache_classify.js" type="text/javascript" charset="utf-8"></script>
<script src="/files/js/jquery.reg.selectlayer.js" type='text/javascript' language="javascript"></script>
<script src="/files/js/jquery.hoverDelay.js" type='text/javascript'></script>




<script type="text/javascript">
//��֤
$(document).ready(function() {
	
	//-----������ʾ
	allaround('<?php echo $this->_vars['QISHI']['site_dir']; ?>
');
	$("#jobsCity").hoverDelay({
		    hoverEvent: function(){
		        $("#divCityCate").show();
		        var dx = $("#divCityCate").offset().left; // ��ȡ�������x����
		        var dwidth = $("#divCityCate").outerWidth(true); // ��ȡ������Ŀ��
		        var lastx = dx + dwidth; // ���ϵ�����Ŀ�Ȼ�ȡ���������ұߵ�x����
	 			$("#divCityCate li").each(function(index, el) {
	 				var that = $(this);
	 				var sx = that.offset().left; // ��ȡ��ǰli��x����
	 				that.hoverDelay({
					    hoverEvent: function(){
					        if(that.find('.subcate').length > 0) {
			 					that.addClass('selected');
			 					var tharsub = that.find('.subcate');
			 					var thap = that.find('p');
			 					thap.css("border-bottom","0px");
			 					var swidth = tharsub.outerWidth(true); // ��ȡ����������Ŀ��
			 					if((lastx - sx) < swidth) { // �ж�li�뵯�������ұߵľ����Ƿ��������������Ŀ��
			 						tharsub.css("left",-265); // ���С�ھ͸ı�����������x�����λ��
			 					}
			 					tharsub.show();
			 				} else {
			 					that.find('a').css("color","#f77d40");
			 				}
					    },
					    outEvent: function(){
			                if(that.find('.subcate').length > 0) {
				 				that.removeClass('selected');
				 				that.find('.subcate').hide();
			 				} else {
			 					that.find('a').css("color","#0180cf");
			 				}    
			            }
					});
	 			});
		    },
		    outEvent: function(){
                $("#divCityCate").hide(); 
            }
		});
	
	//-----������ʾ����
	
 $("#Form1").validate({
//debug: true,
// onsubmit:false,
//onfocusout :true,
submitHandler:function(form){
if($("#agreement").attr("checked")==false)
{
alert("������ͬ��[ע��Э��]���ܼ�����һ��");
return false;
}
		$("#reg").hide();
		$("#waiting").show();
		$("#sub").hide();
		var tsTimeStamp= new Date().getTime();
		$.post("/plus/ajax_user.php", { "username": $("#username").val(),"password": $("#password").val(),"member_type": $("#member_type").val(),"email":$("#email").val(),"postcaptcha": $("#postcaptcha").val(),"xs_user":$("#xs_user").val(),"district_cn":$("#district_cn").val(),"district":$("#district").val(),"sdistrict":$("#sdistrict").val(),"trainname":$("#trainname").val(),"time":tsTimeStamp,"act":"do_reg"},
	 	function (data,textStatus)
	 	 {
			if (data=="err")
			{
			$("#waiting").hide();
			$("#sub").show();
			$("#reg").show();
			//$("#username").attr("value","");
			//$("#email").attr("value","");
			alert("ע��ʧ��zwl");
			}
			else
			{
				$("body").append(data);
			}
	 	 })
//$(form).ajaxSubmit();
},
success: function(label) {
				label.text(" ").addClass("success");
			},
   rules:{
   username:{
    required: true,
	userName : true,
	nomobile : false,
	byteRangeLength : [3, 18],
	remote:{     
		url:"/plus/ajax_user.php",     
		type:"post",    
		data:{"usname":function (){return $("#username").val()},"act":"check_usname","time":function (){return new Date().getTime()}}     
		}
   },
   email:{
    required: true,
	email:true,
	remote:{     
		url:"/plus/ajax_user.php",     
		type:"post",    
		data:{"email":function (){return $("#email").val()},"act":"check_email","time": new Date().getTime()}     
		}
   },
   <?php if ($this->_vars['verify_userreg'] == "1"): ?>
    postcaptcha:{
	IScaptchastr:true,
    required: true,
	remote:{     
	url:"/include/imagecaptcha.php",     
	type:"post",    
	data:{"postcaptcha":function (){return $("#postcaptcha").val()},"act":"verify","time":function (){return new Date().getTime()}}     
	}
   },
   <?php endif; ?>
   password:{
    required: true,
	minlength:6,
    maxlength:18
   },
   password2:{
   required: true,
	 equalTo:"#password"
   },
   trainname:{
    required: true,
	remote:{     
		url:"/plus/ajax_user.php",     
		type:"post",    
		data:{"trainname":function (){return $("#trainname").val()},"act":"check_trainname","time":new Date().getTime()}     
		}
   }
	},
    messages: {
    username: {
    required: "����д�û���",
	remote: jQuery.format("�û����Ѿ����ڻ��߲��Ϸ�")	
   },
   trainname: {
    required: "����д��������",
	remote: jQuery.format("���������Ѿ�����!")	
   },
    email: {
    required: "����д��������",
	email: jQuery.format("���������ʽ����"),
	remote: jQuery.format("email�Ѿ�����")	
   },
    <?php if ($this->_vars['verify_userreg'] == "1"): ?>
    postcaptcha: {
    required: "����д��֤��",
	remote: jQuery.format("��֤�����")	
   },
    <?php endif; ?>
   password: {
    required: "����д����",
    minlength: jQuery.format("��д����С��{0}���ַ�"),
	maxlength: jQuery.format("��д���ܴ���{0}���ַ�")
   },
   password2: {
   required: "����д����",
    equalTo: "������������벻ͬ"
   }
  },
  errorPlacement: function(error, element) {
    if ( element.is(":radio") )
        error.appendTo( element.parent().next().next() );
    else if ( element.is(":checkbox") )
        error.appendTo ( element.next());
    else
        error.appendTo(element.parent().next());
	}
    });
	 //�����������ֽ�
	jQuery.validator.addMethod("byteRangeLength", function(value, element,	param) {
	var length = value.length;
	for (var i = 0; i < value.length; i++) {
			if (value.charCodeAt(i) > 127) {
			length++;
			}
		}
	return this.optional(element)	|| (length >= param[0] && length <= param[1]);
	}, "ȷ����ֵ��3-18���ֽ�֮��");
	 //�ַ���֤
	jQuery.validator.addMethod("userName", function(value, element) {
	return this.optional(element) || /^[\u0391-\uFFE5\w]+$/.test(value);
	}, "ֻ�ܰ�����Ӣ�ġ����ֺ��»���");
	jQuery.validator.addMethod("nomobile", function(value, element) { 
    var tel = /^(13|15|14|17|18)\d{9}$/;
	var $cstr= true;
	if (tel.test(value)) $cstr= false;
	return $cstr || this.optional(element); 
}, "�û����������ֻ���");
	jQuery.validator.addMethod("IScaptchastr", function(value, element) {
	var str="�����ȡ��֤��";
	var flag=true;
	if (str==value)
	{
	flag=false;
	}
	return  flag || this.optional(element) ;
	}, "����д��֤��");
/////��֤�벿��
<?php if ($this->_vars['verify_userreg'] == "1"): ?>
function imgcaptcha(inputID,imgdiv)
{
	$(inputID).focus(function(){
		if ($(inputID).val()=="�����ȡ��֤��")
		{
		$(inputID).val("");
		$(inputID).css("color","#333333");
		}
		$(inputID).parent("div").css("position","relative");
		//������֤��DIV
		//$(imgdiv).css({ position: "absolute",right: "-148px", "top": "0px" , "z-index": "10", "background-color": "#FFFFFF", "border": "1px #A3C8DC solid","display": "none","margin-left": "15px"});
		$(imgdiv).show();
		if ($(imgdiv).html()=='')
		{
		$(imgdiv).append("<img src=\"/include/imagecaptcha.php?t=<?php echo $this->_vars['random']; ?>
\" id=\"getcode\" align=\"absmiddle\"  style=\"cursor:pointer; margin:3px;\" title=\"��������֤�룿�������һ��\"  border=\"0\"/>");
		}
		$(imgdiv+" img").click(function()
		{
			$(imgdiv+" img").attr("src",$(imgdiv+" img").attr("src")+"1");
			$(inputID).val("");
			$("#Form1").validate().element("#postcaptcha");	
		});

	});
}
imgcaptcha("#postcaptcha","#imgdiv");
//��֤�����
<?php endif; ?>
//
$(".but-reg").hover(function(){$(this).addClass("but-reg-hover")},function(){$(this).removeClass("but-reg-hover")});
$(".but-reg-login").hover(function(){$(this).addClass("but-reg-login-hover")},function(){$(this).removeClass("but-reg-login-hover")});
//-------��ҵע���ύ����

//-------����ע���ύ

//
$(".but-reg").hover(function(){$(this).addClass("but-reg-hover")},function(){$(this).removeClass("but-reg-hover")});
$(".but-reg-login").hover(function(){$(this).addClass("but-reg-login-hover")},function(){$(this).removeClass("but-reg-login-hover")});
//

});

</script>

</head>
<body>
<!--ͷ����ʼ-->
	<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include("user/header.htm", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>
	<!--ͷ������-->
<div class="kua">
  <div class="panel-heading">��ӭ����Ҽ����</div>
        <div class="left_list">
            <div class="tab"> 
                <ul> 
                    <li id="one1" class="on" onmouseover='setTab("one",1,5)'>��ѵ��Աע��</li> 
                </ul> 
            </div> 
            <div class="tabList ergao"> 
                <div id="cont_one_1" class="the01 one block"> 
                    <form id="Form1" name="Form1" method="post" action="?sd" class="form-horizontal home-form">
                 <input name="member_type" type="hidden" id="member_type" value="4" />
						<div class="form-group">
								<h2>��ѵ��Աע��<span class=""><font color="#ff0000">*</font>&nbsp;Ϊ�����лл������</span></h2>
						</div>

						<div class="form-group">
							<label class=" fl control-label"><font color="#ff0000">*</font><!--�ֻ���-->�û�����</label>
							<div class="fl input_box">
								<input type="text" name="username" id="username" class="sign_up_input_name form-control error" placeholder="�������û���" maxlength="25" />
							</div>
                            <div class="item-tip"></div>
						</div>

						<div class="form-group">
							<label class="fl control-label"><font color="#ff0000">*</font>���룺</label>
							<div class="fl input_box">
								<input type="password" name="password" id="password" class="sign_up_input_pwd form-control" placeholder="�������¼����" maxlength="18" />
							</div>
                            <div class="item-tip"></div>
                            <div class="clear"></div>
						</div>

						<div class="form-group">
							<label class="fl control-label"><font color="#ff0000">*</font>ȷ�����룺</label>
							<div class="fl input_box">
								<input type="password" name="password2" id="password2" class="sign_up_input_pwd form-control" placeholder="��ȷ�ϵ�¼����" maxlength="18"/>
							</div>
                            <div class="item-tip"></div>
							<div class="clear"></div>
						</div>
						
                        <div class="form-group">
							<label class="fl control-label"><font color="#ff0000">*</font>�������ƣ�</label>
							<div class="fl input_box">
                            	<input type="text" name="trainname" id="trainname" class="form-control" placeholder="�������������" maxlength="60" />
							</div>
                            <div class="item-tip"></div>
							<div class="clear"></div>
						</div>
                        
						<div class="form-group">
							<label class="fl control-label"><font color="#ff0000">*</font>�������䣺</label>
							<div class="fl input_box">
                            	<input type="text" name="email" id="email" class="sign_up_input_mail form-control" placeholder="���������ĳ�������" maxlength="60" />
							</div>
                            <div class="item-tip"></div>
							<div class="clear"></div>
						</div>
                        
                        <div class="form-group jobmain idng">
							<label class="fl control-label"><font color="#ff0000">*</font>���ڵ�����</label>
							<div id="jobsCity" style="position:relative;">
                           <div class="input_text_wc0_bg" id="cityText"><?php echo $this->_run_modifier($this->_vars['company_profile']['district_cn'], 'default', 'plugin', 1, "��ѡ��"); ?>
</div>
							<div style="display:none;left:1px;top:46px;" id="divCityCate" class="divJobCate">
								<table class="jobcatebox citycatebox"><tbody></tbody></table>
							</div>
							<input id="district" type="hidden" value="" name="district">
							<input id="sdistrict" type="hidden" value="" name="sdistrict">
							<input id="districtID" type="hidden" value="">
							<input name="district_cn" id="district_cn" type="hidden" value="" />
                              </div>
						</div>
						
						
						<!---<div class="form-group">
							<label class="fl control-label">�ͻ�����</label>
							<div class="fl">
								<input type="text" class="form-control" name="xs_user" id="xs_user">
							</div>
						</div>-->
						
                        <?php if ($this->_vars['verify_userreg'] == "1"): ?>
                        <div class="form-group">
                            <label class="fl control-label">��֤�룺</label>
                            
                            <div class="fl" >
                                <input  class="sign_up_input_varcode form-control" name="postcaptcha" id="postcaptcha" type="text" value="�����ȡ��֤��" style="color:#999999;width:110px;"/>
                            </div><div id="imgdiv" class="fl item-tip"></div>
                        </div>
                        <?php endif; ?>
                        <div class="clear"></div>
						 <div class="form-group">
							<div class="col-sm-offset-3">
								<div class="checkbox">
									<label style="line-height:24px;">
										<input type="checkbox" class="heif" name="agreement" id="agreement" value="1" checked="checked"/> �����Ķ���ͬ����
                               			<a href="/agreement/">��<?php echo $this->_vars['QISHI']['site_name']; ?>
�û�����Э�顷</a>
									</label>
								</div>
							</div>
						</div>
                        <!--ע��֮����ʾ-->
                       <!-- <div class="form-group">
                            <div class="item-input-box waiting" id="waiting" style="display:none">
                              ����ע����,��ȴ�... 
                            </div>
                        </div>-->
                        <div class="form-group" id="waiting" style="display:none">
									<label class="fl"> &nbsp;</label>
							<div class="fl col-sm-offset-3">
								<button class="btn btn-lg btn-primary btn-block" name="signup" id="waiting" type="submit" style="color:#fff; background:#999;">����ע����...</button>
							</div>
						</div>

						<div class="form-group" id="sub">
									<label class="fl"> &nbsp;</label>
							<div class="fl col-sm-offset-3">
								<button class="btn btn-lg btn-primary btn-block" name="signup" id="waiting" type="submit">�ύע��</button>
							</div>
						</div>

						<!--  -->
                        
                    </form>
                </div> 
  
            </div> 
                        

        </div>





        <div class="right_list">
                
                <div class="h_anniu">
                <p>����ע�����/��ҵ��������¼��</p>
                <a href="/user/login.php" class="btn-warning">���� / ��ҵ��¼���</a>
                
                <p>����ע����ѵ,������¼��</p>
                <a href="/user/login.php?utype=4" class="btn-warning">��ѵ��¼���</a>
                </div>

               

                <div class="h_tishi">
                    <p>ȫ����ѷ������ߣ�</p>
                    <a href="tel:400-118-5188">400-118-5188</a>
                </div>

        </div>

</div>

<!--�ײ���ʼ-->
   <?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include("user/footer.htm", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>
	<!--�ײ�����-->
</body>
</html>