function allaround(dir){
	if($("#divCityCate").length > 0) {
		fillCity("#divCityCate"); // �������
		// �ָ�����ѡ������
		if($("#sdistrict").val()) {
			var scityid = $("#sdistrict").val();
			if(scityid == 0) {
				var dcityid = $("#district").val();
				$("#divCityCate .citycatebox p a").each(function() {
					if(dcityid == $(this).attr("rcoid")) {
						$(this).addClass('selectedcolor');
					}
				});
			} else {
				$("#divCityCate .citycatebox .subcate a").each(function() {
					if(scityid == $(this).attr("rcoid")) {
						$(this).parent().prev().find('font a').addClass('selectedcolor');
						$(this).addClass('selectedcolor');
					}
				});
			}
		}
		/* ���������ʾ����ѡ */
		$("#divCityCate li p a").unbind().live('click', function(){
			$("#divCityCate li p a").each(function() {
				$(this).removeClass('selectedcolor');
			});
			$(this).addClass('selectedcolor');
			var checkID = $(this).attr('pid').split(".");
			var checkText = $(this).attr('title');
			$("#cityText").html(checkText);
			$("#district_cn").val(checkText);
			$("#district").val(checkID[0]);
			$("#sdistrict").val(checkID[1]);
			$("#divCityCate").hide();
		});
		$("#divCityCate .subcate a").unbind().live('click', function() {		
			$("#divCityCate .subcate a").each(function() {
				$(this).parent().prev().find('font a').removeClass('selectedcolor');
				$(this).removeClass('selectedcolor');
			});
			$(this).parent().prev().find('font a').addClass('selectedcolor');
			$(this).addClass('selectedcolor');
			var checkID = $(this).attr('pid').split(".");
			var checkText = $(this).attr('title');
			$("#cityText").html(checkText);
			$("#district_cn").val(checkText);
			$("#district").val(checkID[0]);
			$("#sdistrict").val(checkID[1]);
			$("#divCityCate").hide();
		});
	}
	//---fff�ظ���˾����ѡ��
	if($("#gsdivCityCate").length > 0) {
		fillCity("#gsdivCityCate"); // �������
		// �ָ�����ѡ������
		if($("#gs_sdistrict").val()) {
			var scityid = $("#gs_sdistrict").val();
			if(scityid == 0) {
				var dcityid = $("#gs_district").val();
				$("#gsdivCityCate .citycatebox p a").each(function() {
					if(dcityid == $(this).attr("rcoid")) {
						$(this).addClass('selectedcolor');
					}
				});
			} else {
				$("#gsdivCityCate .citycatebox .subcate a").each(function() {
					if(scityid == $(this).attr("rcoid")) {
						$(this).parent().prev().find('font a').addClass('selectedcolor');
						$(this).addClass('selectedcolor');
					}
				});
			}
		}
		/* ���������ʾ����ѡ */
		$("#gsdivCityCate li p a").unbind().live('click', function(){
			$("#gsdivCityCate li p a").each(function() {
				$(this).removeClass('selectedcolor');
			});
			$(this).addClass('selectedcolor');
			var checkID = $(this).attr('pid').split(".");
			var checkText = $(this).attr('title');
			$("#gscityText").html(checkText);
			$("#gs_district_cn").val(checkText);
			$("#gs_district").val(checkID[0]);
			$("#gs_sdistrict").val(checkID[1]);
			$("#gsdivCityCate").hide();
		});
		$("#gsdivCityCate .subcate a").unbind().live('click', function() {		
			$("#gsdivCityCate .subcate a").each(function() {
				$(this).parent().prev().find('font a').removeClass('selectedcolor');
				$(this).removeClass('selectedcolor');
			});
			$(this).parent().prev().find('font a').addClass('selectedcolor');
			$(this).addClass('selectedcolor');
			var checkID = $(this).attr('pid').split(".");
			var checkText = $(this).attr('title');
			$("#gscityText").html(checkText);
			$("#gs_district_cn").val(checkText);
			$("#gs_district").val(checkID[0]);
			$("#gs_sdistrict").val(checkID[1]);
			$("#gsdivCityCate").hide();
		});
	}
	//----
	if($("#divCityCateJob").length > 0) {
		fillCityJob("#divCityCateJob"); // �ó�ְ�����
		// �ָ��ó�ְ��ѡ������
		if($("#intention_jobs_id").val()) {
				var recoverCityArray = $("#intention_jobs_id").val().split(",");
				$.each(recoverCityArray, function(index, val) {
					 var democityArray = val.split(".");
					 if(democityArray[1] == 0) { // ����ڶ�������Ϊ 0 ˵��ѡ�����һ��
					 	$(".citycatebox p a").each(function() {
					 		if(democityArray[0] == $(this).attr("rcoid")) {
					 			$(this).addClass('selectedcolor');
					 		}
					 	});
					 } else { // ѡ����Ƕ���
					 	$(".citycatebox .subcate a").each(function() {
					 		if(democityArray[1] == $(this).attr("rcoid")) {
					 			$(this).addClass('selectedcolor');
					 		}
					 	});
					 }
				});
				copyCityJobItem();
		}
		/* �ó�ְ�ܵ����ʾ����ѡ */
		$("#divCityCateJob p a").unbind().live('click', function() {
			// �ж�ѡ��������Ƿ񳬳�
			if($("#divCityCateJob .selectedcolor").length >= 5) {
				$("#citydropcontent").show(0).delay(3000).fadeOut("slow");
			} else {
				$(this).addClass('selectedcolor');
				copyCityJobItem(); // ���ó�ְ����ѡ�Ŀ���
			}
		});
		$("#divCityCateJob .subcate a").unbind().live('click', function() {
			// �ж�ѡ��������Ƿ񳬳�
			if($("#divCityCateJob .selectedcolor").length >= 5) {
				$("#citydropcontent").show(0).delay(3000).fadeOut("slow");
			} else {
				if($(this).attr("p") == "qb") {
					$(this).parent().prev().find('font a').addClass('selectedcolor');
					$(this).parent().find('a').removeClass('selectedcolor');
				} else {
					$(this).parent().prev().find('font a').removeClass('selectedcolor');
					$(this).addClass('selectedcolor');
				}
				copyCityJobItem(); // ���ó�ְ����ѡ�Ŀ���
			}
		});
		// �ó�ְ��ȷ��ѡ��
		$("#citySure").unbind().click(function() {
			var a_cn=new Array();
			var a_id=new Array();
			$("#cityAcq a").each(function(index) {
				// ���ѡ�����һ�����ڶ��������� 0
				var chid = new Array();
				if($(this).attr('pid')) {
					chid = $(this).attr('pid').split(".");
					if(chid.length < 2) {
						chid.push(0);
					}
				}
				var checkID = chid.join(".");
				var checkText = $(this).attr('title');
				a_id[index]=checkID;
				a_cn[index]=checkText;
			});
			if (a_cn.length > 0) {
				$("#cityTextJob").html(a_cn.join(","));
				$("#intention_jobs").val(a_cn.join(","));
				$("#intention_jobs_id").val(a_id.join(","));
			} else {
				$("#cityTextJob").html("��ѡ���������");
				$("#intention_jobs").val("");
				$("#intention_jobs_id").val("");
			}
			$("#divCityCateJob").hide();
		});
	}
	if($("#divTradCate").length > 0) {
		fillTrad("#divTradCate"); // ��ҵ�������
		// �ָ���ҵѡ������
		if($("#trade").val()) {
			var recoverTradArray = $("#trade").val().split(",");
			$.each(recoverTradArray, function(index, val) {
				 $("#tradList a").each(function() {
					if(val == $(this).attr('cln')) {
						$(this).addClass('selectedcolor');
					}
				});
			});
			copyTradItem();
			var a_cn = new Array();
			$("#tradAcq a").each(function(index) {
				var checkText = $(this).attr('title');
				a_cn[index]=checkText;
			});
			$("#tradText").html(a_cn.join(","));
		}
		/* ��ҵ�б�����ʾ����ѡ */
		$("#tradList li a").unbind().live('click', function() {
			// �ж�ѡ��������Ƿ񳬳�
			if($("#tradList .selectedcolor").length >= 5) {
				$("#tradropcontent").show(0).delay(3000).fadeOut("slow");
			} else {
				$(this).addClass('selectedcolor');
				copyTradItem(); // ����ҵ��ѡ�Ŀ���
			}
		});
		// ��ҵȷ��ѡ��
		$("#tradSure").unbind().click(function() {
			var a_cn=new Array();
			var a_id=new Array();
			$("#tradAcq a").each(function(index) {
				var checkID = $(this).attr('rel');
				var checkText = $(this).attr('title');
				a_id[index]=checkID;
				a_cn[index]=checkText;
			});
			if (a_cn.length > 0) {
				$("#tradText").html(a_cn.join(","));
				$("#trade_cn").val(a_cn.join(","));
				$("#trade").val(a_id.join(","));
			} else {
				$("#tradText").html("��ѡ����ҵ���");
				$("#trade_cn").val("");
				$("#trade").val("");
			}
			$("#divTradCate").hide();
		});
	}
	if($("#divTradCateD").length > 0) {
		fillTrad("#divTradCateD"); // ������ҵ���
		// �ָ���˾������ҵ
		if($("#tradeD").val()) {
			var tradid = $("#tradeD").val();
			 $("#tradListD a").each(function() {
				if(tradid == $(this).attr('cln')) {
					$(this).addClass('selectedcolor');
				}
			});
		}
		/* ������ҵ�б�����ʾ����ѡ */
		$("#divTradCateD li a").unbind().live('click', function() {
			$("#tradListD a").each(function() {
				$(this).removeClass('selectedcolor');
			});
			$(this).addClass('selectedcolor');
			var checkID = $(this).attr('cln');
			var checkText = $(this).attr('title');
			$("#tradTextD").html(checkText);
			$("#tradeD_cn").val(checkText);
			$("#tradeD").val(checkID);
			$("#divTradCateD").hide();
		});
	}
	if($("#divCityCateAD").length > 0) {
		fillCityJob("#divCityCateAD"); // ְλ������
		// �ָ�ְλ���ѡ������
		if($("#subclass").val()) {
			var scityid = $("#subclass").val();
			if(scityid == 0) {
				var ccityid = $("#category").val();
				$("#divCityCateAD .citycatebox p a").each(function() {
					if(ccityid == $(this).attr("rcoid")) {
						$(this).addClass('selectedcolor');
					}
				});
			} else {
				$("#divCityCateAD .citycatebox .subcate a").each(function() {
					if(scityid == $(this).attr("rcoid")) {
						$(this).parent().prev().find('font a').addClass('selectedcolor');
						$(this).addClass('selectedcolor');
					}
				});
			}
		}
		/* ְλ�������ʾ����ѡ */
		$("#divCityCateAD p a").unbind().live('click', function() {		
			$("#divCityCateAD p a").each(function() {
				$(this).removeClass('selectedcolor');
			});
			$(this).addClass('selectedcolor');
			var checkID = $(this).attr('pid').split(".");
			var checkText = $(this).attr('title');
			$("#cityTextAD").html(checkText);
			$("#category_cn").val(checkText);
			$("#category").val(checkID[0]);
			$("#subclass").val(checkID[1]);
			$("#divCityCateAD").hide();
		});
		$("#divCityCateAD .subcate a").unbind().live('click', function() {		
			$("#divCityCateAD .subcate a").each(function() {
				$(this).parent().prev().find('font a').removeClass('selectedcolor');
				$(this).removeClass('selectedcolor');
			});
			$(this).parent().prev().find('font a').addClass('selectedcolor');
			$(this).addClass('selectedcolor');
			var checkID = $(this).attr('pid').split(".");
			var checkText = $(this).attr('title');
			$("#cityTextAD").html(checkText);
			$("#category_cn").val(checkText);
			$("#category").val(checkID[0]);
			$("#subclass").val(checkID[1]);
			$("#divCityCateAD").hide();
		});
	}
}
function copyCityJobItem() {
	var cityacqhtm = '';
	$("#divCityCateJob .selectedcolor").each(function() {
		cityacqhtm += '<a pid="'+$(this).attr('pid')+'" href="javascript:;" title="'+$(this).attr('title')+'"><div class="text">'+$(this).attr('title')+'</div><div class="close"></div></a>';
	});
	$("#cityAcq").html(cityacqhtm);
	// ��ѡ��Ŀ�󶨵���¼�
	$("#cityAcq a").unbind().click(function() {
		var selval = $(this).attr('title');
		$("#divCityCateJob .selectedcolor").each(function() {
			if ($(this).attr('title') == selval) {
				$(this).removeClass('selectedcolor');
				copyCityJobItem();
			}
		});
	});
	// ���
	$("#cityEmpty").unbind().click(function() {
		$("#cityAcq").html("");
		$("#divCityCateJob .selectedcolor").each(function() {
			$(this).removeClass('selectedcolor');
		});
	});
}
function copyTradItem() {
	var tradacqhtm = '';
	$("#tradList .selectedcolor").each(function() {
		tradacqhtm += '<a href="javascript:;" rel="'+$(this).attr('cln')+'" title="'+$(this).attr('title')+'"><div class="text">'+$(this).attr('title')+'</div><div class="close" id="c-'+$(this).attr('cln')+'"></div></a>';
	});
	$("#tradAcq").html(tradacqhtm);
	// ��ѡ��Ŀ�󶨵���¼�
	$("#tradAcq a").unbind().click(function() {
		var selval = $(this).attr('title');
		$("#tradList .selectedcolor").each(function() {
			if ($(this).attr('title') == selval) {
				$(this).removeClass('selectedcolor');
				copyTradItem();
			}
		});
	});
	// ���
	$("#tradEmpty").unbind().click(function() {
		$("#tradAcq").html("");
		$("#tradList .selectedcolor").each(function() {
			$(this).removeClass('selectedcolor');
		});
	});
}
function fillTrad(fillID){
	var tradli = '';
	$.each(QS_trade, function(index, val) {
		if(val) {
			var trads = val.split(",");
		 	tradli += '<li><a title="'+trads[1]+'" cln="'+trads[0]+'" href="javascript:;">'+trads[1]+'</a></li>';
		}
	});
	$(fillID+" ul").html(tradli);
}
function fillCityJob(fillID){
	var citystr = '';
	citystr += '<tr>';
	citystr += '<td><ul class="jobcatelist">';
	$.each(QS_hunter_jobs_parent, function(pindex, pval) {
		if(pval) {
			var citys = pval.split(",");
	 		citystr += '<li>';
	 		citystr += '<p><font><a rcoid="'+citys[0]+'" pid="'+citys[0]+'.0" title="'+citys[1]+'" href="javascript:;">'+citys[1]+'</a></font></p>';
	 		if(QS_hunter_jobs[citys[0]]) {
	 			citystr += '<div class="subcate" style="display:none;">';
	 			var ccitysArray = QS_hunter_jobs[citys[0]].split("|");
		 		$.each(ccitysArray, function(cindex, cval) {
		 			if(cval) {
			 			var ccitys = cval.split(",");
			 			citystr += '<a rcoid="'+ccitys[0]+'" title="'+citys[1]+'/'+ccitys[1]+'" pid="'+citys[0]+'.'+ccitys[0]+'" href="javascript:;">'+ccitys[1]+'</a>';
		 			}
		 		});
	 			citystr += '</div>';
	 		}
	 		citystr += '</li>';
		}
	});
	citystr += '</ul></td>';
	citystr += '</tr>';
	$(fillID+" tbody").html(citystr);
	$(".jobcatelist li").each(function() {
		if($(this).find('.subcate').length <= 0) {
			$(this).find('font').css("background","none");
		}
	});
}
function fillCity(fillID){
	var citystr = '';
	citystr += '<tr>';
	citystr += '<td><ul class="jobcatelist">';
	$.each(QS_city_parent, function(pindex, pval) {
		if(pval) {
			var citys = pval.split(",");
	 		citystr += '<li>';
	 		citystr += '<p><font><a rcoid="'+citys[0]+'" pid="'+citys[0]+'.0" title="'+citys[1]+'" href="javascript:;">'+citys[1]+'</a></font></p>';
	 		if(QS_city[citys[0]]) {
	 			citystr += '<div class="subcate" style="display:none;">';
	 			var ccitysArray = QS_city[citys[0]].split("|");
		 		$.each(ccitysArray, function(cindex, cval) {
		 			if(cval) {
			 			var ccitys = cval.split(",");
			 			citystr += '<a rcoid="'+ccitys[0]+'" title="'+citys[1]+'/'+ccitys[1]+'" pid="'+citys[0]+'.'+ccitys[0]+'" href="javascript:;">'+ccitys[1]+'</a>';
		 			}
		 		});
	 			citystr += '</div>';
	 		}
	 		citystr += '</li>';
		}
	});
	citystr += '</ul></td>';
	citystr += '</tr>';
	$(fillID+" tbody").html(citystr);
	$(".jobcatelist li").each(function() {
		if($(this).find('.subcate').length <= 0) {
			$(this).find('font').css("background","none");
		}
	});
}
//---------------------------------------fff-----add

// �رյ���
function closeDialog(showID) {
	$(showID).hide();
	$(".menu_bg_layer").remove();
}
// �ж�ѡ��������Ƿ񳬳�
function getCheckNum(checkbox) {
	var chenkNum = $(checkbox+" a");
	if (chenkNum.length >= 5) {
		alert("����ѡ5��");
		return false;
	} else {
		return true;
	}
}
// �ָ�ѡ��
function recoverChecked(citySun,checkBox,cityPro,QSarr,QSarrParent) {
	if($(checkBox+" a").length > 0) {
		$(checkBox+" a").each(function() {
			var pid = $(this).attr('gid').split(".");
			var pname = $(this).attr('gname').split("/");
			$(cityPro+" ul li").eq(pid[0]-1).addClass('current');
			$(citySun).html(getSunCity(QSarr,pid[0],pname[0]));
			var checkRel = $(this).find('span').attr("rel");
			$(citySun+" li.parent_node").each(function() {
				var sunRel = $(this).find('.cls_value').attr('rel');
				if(sunRel == checkRel) {
					$(this).addClass('current');
					return false;
				}
			});
			makeGrandCity(citySun,QSarr);
			$(citySun+" :input").each(function() {
				var grdVal = $(this).val();
				var grdRel = $(this).attr('rel');
				if(grdVal == checkRel) {
					$(this).attr("checked","checked");
					$(citySun+" li.parent_node").each(function() {
						var sunRel = $(this).find('.cls_value').attr('rel');
						if(sunRel == grdRel) {
							$(this).addClass('current');
						}
					});
					return false;
				}
			});
		});
	} else {
		$(cityPro+" ul li").eq(0).addClass('current');
		var rcity = QSarrParent[0].split(",");
		$(citySun).html(getSunCity(QSarr,rcity[0],rcity[1]));
		makeGrandCity(citySun,QSarr);
	}
}
// �س���ǩ
function showTagBox(clickObjID,showID,htmTrad,checkBoxTag,btnSaveTag,tagID,showTagCheck,QSarr) {
	$(clickObjID).click(function() {
		$(this).blur();
		$(this).before('<div class="menu_bg_layer" style="position:absolute;left:0px;top:0px;z-index:9;background-color:#000000;"></div>');
		$(".menu_bg_layer").css({"width":$(document).width(),"height":$(document).height(),"opacity":0.3});
		$(htmTrad).html(getParentTag(QSarr));
		recoverTag(checkBoxTag,htmTrad);
		$(showID).show();
		$(htmTrad+" :checkbox").unbind().click(function(){
			if($(this).attr("checked")) {
				if(getCheckNum(checkBoxTag)){
					var tid = $(this).val();
					var tname = $(this).attr('title');
					$(checkBoxTag).append(getCheckTag(tid,tname));
					$(checkBoxTag+" i").unbind().click(function(){
						var ival =  $(this).attr('rel');
						$(this).parent().remove();
						$(htmTrad+" :checkbox[checked]").each(function() {
							if($(this).val() == ival){
								$(this).attr('checked',false);
							}
						});
					});
				} else {
					$(this).attr('checked',false);
				}
			} else {
				var selval = $(this).val();
				$(checkBoxTag+" a").each(function() {
					var chval = $(this).find('span').attr('rel');
					if(chval == selval) {
						$(this).remove();
					}
				});
			}
		});
		$(btnSaveTag).click(function(){
			$a_checkbox = $(checkBoxTag+" a");
			var checkhtm = '';
			var a_cn=new Array();
			var a_id=new Array();
			$a_checkbox.each(function(index) {
				var checkVal = $(this).find('span').html();
				var checkRel = $(this).find('span').attr('rel');
				checkhtm+='<div class="input_checkbox"><span rel="'+checkRel+'">'+checkVal+'</span></div>';
				a_cn[index]=checkVal;
				a_id[index]=checkRel + "," +checkVal;
			});
			$(showTagCheck+" .showchecktag").html(checkhtm);
			$(tagID).val(a_id.join("|"));
			closeDialog(showID);
		});
		$(".menu_bg_layer").click(function() {
			closeDialog(showID);
		});
		$(".cm_closeMsg").click(function() {
			closeDialog(showID);
		});
	});
}
// �ָ���ѡ���س���ǩ
function recoverTag(checkBoxTag,showTradArea) {
	if($(checkBoxTag+" a").length > 0) {
		$(checkBoxTag+" a").each(function() {
			var ival = $(this).find('span').attr('rel');
			$(showTradArea+" :checkbox").each(function() {
				if($(this).val() == ival) {
					$(this).attr('checked',true);
				}
			});
		});
	} else {
		return false;
	}
}
// ���ѡ���س���ǩ
function getCheckTag(id,name){
	return '<a id="checked_value_'+id+'" class="sx-yx-cnt" href="javascript:;"><span rel="'+id+'">'+name+'</span><i id="checked_value_del_'+id+'" rel="'+id+'" class="del cls_checked_del"></i></a>';
}
// ���ɱ�ǩ����
function getParentTag(praStr) {
	var htmstr = '<div class="sx-cnt sx-cnt2"><div style="padding-bottom: 0px;" class="sx-nomal"><ul style="width: 760px;" class="cf">';
	$.each(praStr, function(index, val) {
		var v = val.split(",");
		htmstr+="<li style=\"border-top-width: 0px; padding: 0px 0px 3px 20px; width: 230px; text-align: left;\"><label><input type=\"checkbox\" id=\"child_value_"+v[0]+"\" title=\""+v[1]+"\" value=\""+v[0]+"\" class=\"cls_child\">"+v[1]+"</label></li>";
	});
	htmstr+='</ul></div></div>';
	return htmstr;
}
function chechkcli(chid,htmid){
		$(chid+" i").unbind().click(function(){
			var ival =  $(this).attr('rel');
			$(this).parent().remove();
			$(htmid+" :checkbox[checked]").each(function() {
				if($(this).val() == ival){
					$(this).attr('checked',false);
				}
			});
		});
	}
	// �ָ�ְλ����
	if($("#tag").val()){
		var tagarray = $("#tag").val().split("|");
		var tagotphtm = '';
		var ctagopt = '';
		$.each(tagarray, function(index, val) {
		 	var tagstr = val.split(",");
		 	tagotphtm += '<div class="input_checkbox"><span rel="'+tagstr[0]+'">'+tagstr[1]+'</span></div>';
		 	ctagopt += '<a id="checked_value_'+tagstr[0]+'" class="sx-yx-cnt" href="javascript:;"><span rel="'+tagstr[0]+'">'+tagstr[1]+'</span><i id="checked_value_del_'+tagstr[0]+'" rel="'+tagstr[0]+'" class="del cls_checked_del"></i></a>'
		});
		$("#tag_checkbox .showchecktag").html(tagotphtm);
		$("#box_checkedTag").html(ctagopt);
		chechkcli("#box_checkedTag","#showTag");
	}
	// ְλ������ɾ��
	$("#tag_checkbox .input_checkbox span").live('click', function() {
		$(this).parent().remove();
		var rel = $(this).attr('rel');
		var relarray = new Array();
		relarray[0] = rel;
		relarray[1] = $(this).html();
		var arr = $("#tag").val().split("|");
		arr.splice($.inArray(relarray,arr),1);
		$("#tag").val(arr.join("|"));
		$tag_a = $("#box_checkedTag a");
		$tag_a.each(function(index, el) {
			var ctagrel = $(this).find('span').attr("rel");
			if(rel == ctagrel) {
				$(this).remove();
			}
		});
	});