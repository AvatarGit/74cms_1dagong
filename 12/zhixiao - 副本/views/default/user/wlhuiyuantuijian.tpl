<{include file="public/head.tpl"}>
<script type="text/javascript" src="<{$res}>/js/WdatePicker/WdatePicker.js"></script>

<script type="text/javascript">
	$(function(){
	
		//隔行换色
		$(".tab:even").css("background","#FFFFFF");
		$(".tab:odd").css("background","#F8F8F8");	
		
		//鼠标移上换色
		$(".tab").hover(
		  function(){
		    $(this).css("background","#CFDDEA");
		  },
		  function(){
		    $(".tab:even").css("background","#FFFFFF");
			$(".tab:odd").css("background","#F8F8F8");
		});
		
		//checkbox,全选/全不选
		$(".ckbox").bind("click", function(){ 
			if($(".ckbox:checkbox").attr("checked")){
				$("[name = selectid[]]:checkbox").attr("checked", true);
			}else{
				$("[name = selectid[]]:checkbox").attr("checked", false);
			}
        });
		
	});
	
	//入职----
	function status(a,b){
		if(b=='rz'){
			$(".mz").html("入职时间");
			$("input[id='shijian']").attr("name","ruzhi_time");
		}
		$(".statusxianshi"+a).css("display","");
		$("body").append("<div class='zhezhao' onclick='gb()'> </div>");
	}
	//关闭弹出框---
	function gb(){
		$(".status").css("display","none");
		$(".zhezhao").remove();
	}
	
</script>

<body class="bodycolor">

<br/>
<table align="center" class="addtab" width='100%' cellspacing='0' cellpadding='0' border="1">
<tr>
	<td colspan="21" class="biaoti" align="left">&nbsp;网络未入职推荐会员列表</td>
</tr>
<tr>
	<td colspan="21" align="left">
		&nbsp;查找：<form action="<{$url}>/wlhuiyuantuijian" method="get" style="display:inline;">
			<select name="search" class="SmallSelect">
				<option value="name">姓名</option>
				<option value="bianhao">编号</option>
				<option value="sphone">手机号</option>
				<option value="id_number">身份证号</option>
			</select>
			<input type="text" class="SmallInput" name="findvalue">
			<input type="submit" value=" 查找 " class="sub">
		</form>
	</td>
</tr>
<tr class="biaoti">
	<td noWrap width="100">编号</td>
	<td noWrap width="90">姓名</td>
	<td noWrap width="110">推荐人编号</td>
	<td noWrap width="70">推荐人姓名</td>
	<td noWrap width="100">推荐人关系</td>
	<td noWrap width="130">手机号码</td>
	<td noWrap width="100">QQ号码</td>
	<td noWrap width="80">会员类型</td>
    <td nowrap width="150">注册时间</td>
    <td nowrap width="180">操作</td>
</tr>
<{if $data}>
<{foreach from=$data item=item}>
<tr class="khbox tab" >
	<td noWrap  align='left'>&nbsp; <{$item.bianhao}> </td>
	<td noWrap  align='left'> <{$item.name}> </td>
	<td noWrap  align='left'> <{if $item.f_bianghao!='0'}> <{$item.f_bianghao}> <{/if}> </td>
	<td noWrap  align='center'> <{$item.f_name}> </td>
	<td noWrap  align='center'> <{$item.guanxi}> </td>
	<td noWrap  align='left'> <{$item.sphone}> </td>
	<td noWrap  align='left'> <{$item.qq}> </td>
	<td noWrap  align='left'> <{$item.jibie}> </td>
	<td noWrap  align='left'> <{$item.add_time|date_format:"%Y-%m-%d %H:%M:%S"}> </td>
    <td> 
	
	<a href="javascript:;" onclick="status(<{$item.id}>,'rz')"> 入职 </a> 
	
	<a href="<{$url}>/huiyuaninfo/id/<{$item.id}>/dqurl/weiruzhi">查资料</a> 
	<a onclick="return confirm('你确定要删除吗? ')" href="<{$url}>/delhuiyuan/id/<{$item.id}>"> 删除 </a> 
	
	    <div class="status statusxianshi<{$item.id}>" style='display:none;'>  
			<div class="content" style="height:60px;line-height:25px; padding-top:15px;"> 
				<form method="post" action="<{$url}>/ruzhihuiyuan" id="formshijian">
					<input type="hidden" name="id" value="<{$item.id}>" />
					<span>入职公司</span>：<input type="text" id="ruzhi_name" name="ruzhi_name" size="13" /> <br/>
					<span class="mz"></span>：<input type="text" id="shijian" size="8" onclick="WdatePicker({dateFmt:'yyyy-MM-dd',alwaysUseStartDate:true})" />
					<input type="submit" value="提交"/>
				</form> </div><s style="left: 82px"><i></i></s> 
		</div>
	
	</td>
</tr>
<{/foreach}>
<{else}>
	<tr>
    	<td colspan="14">
        	没有找到要激活的会员
        </td>
    </tr>
<{/if}>
<tr class="biaoti">
	<td align="left" colspan="20">
		<{$fpage_weihu}>
	</td>
</tr>
</table>

<{include file="public/foot.tpl"}>