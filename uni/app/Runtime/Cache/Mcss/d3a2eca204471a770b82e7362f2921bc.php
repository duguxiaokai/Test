<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> <!--dtd协议-->
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>模型编辑器</title>
<link href='__PUBLIC__/jusaas/mctree/MCTree_left.css' rel='stylesheet' type='text/css'>
<link rel='stylesheet' type='text/css' href='__PUBLIC__/themes/<?php echo ($mcss_theme); ?>/css/common.css' />
<style>
.selectedrow{color:red}
</style>

<script src="__PUBLIC__/js/jquery.js"></script>
<script src="__PUBLIC__/jusaas/mctree/MCTree.js"></script>
<script src="__PUBLIC__/jusaas/js/common.js"></script>
<script src="__PUBLIC__/jusaas/js/dom.js"></script>
<script src='__PUBLIC__/js/popup.js'></script>
</head>

<body>
<input type='radio' name='modelview' id='view_list' value='list' onchange='changemodelview(this)' checked='true' /><label for='view_list'>列表</label>
<input type='radio' name='modelview' id='view_tree' value='tree' onchange='changemodelview(this)' /><label for='view_tree'>树形</label>
<input type='radio' name='modelview' id='view_hide' value='hide' onchange='changemodelview(this)' /><label for='view_hide' >隐藏</label>
<input type='button' name='modelview' id='btn_reloadmodels' onclick='fetchAllModelsFromServer()' value='刷新' title='重新从服务器加载模型列表' />
<input type='button' onclick='newmodel();' value='新建'>
<div id='mcss_pagebar' style='float:right;'></div>


<table border='1' style="height:600px" >
<tr>
<td style="vertical-align:top;height:400px;" id='td_modellist'>
	<input type='text' id='searchmodelid' placeholder='输入 回车搜索' x-webkit-speech onkeyup='searchmodel(event);' style="width:180px;" title="输入部份字符模糊搜索">
	<br />
	<select id='openhistory' style='width:180px' onchange='selcthistory(this)'></select><br />
	<div id='modellist' style='height:700px;width:180px;white-space:wrap;overflow:hidden;overflow-y: scroll; '></div>
</td> 
<td style="vertical-align:top;display:none;" id='td_modeltree'>
	输入后按回车搜索:<br /><input type='text' id="searchword" onkeyup='searchmodeltree(this);' style="width:100%;" />
	<div id='modeltree' class='ztree'></div>
</td>
<td style="vertical-align:top;">
	<div id='modelaction'>
		<input type='radio' id='radio_editor' name='viewtype' onclick='loadmodelfromstr();' checked='true'><label for="radio_editor">编辑器</label>
		<input type='radio' id='radio_modelstr'  name='viewtype' onclick='showTextView();' value='查看文本'><label for="radio_modelstr">文本</label>
		<input type='button' onclick='saveOneModel();' value='保存'>
		<input type='button' onclick='openmodel();' value='预览'>
		<input type='button' onclick='renameModel();' value='改id'>
		<input type='button' onclick='deletemodel();' value='删除'>
		<input type='button' onclick='openForm_saveModelAndcreateTable(this);' value='创建数据表' title='根据模型属性创建或更新数据库表结构' />

		<input type='button' onclick='openExpression(this);' value='帮助' title='帮助' />

		<div id='hintmsg' style='color:red;display:none'>保存成功</div>	
	</div>
	<table id='visualview'>
		<tr>
			<td style='vertical-align:top;'>
				<div id='div_modeldata' >
					<table border='0' id='modeldata' style="width:800px;"></table>
					<div border='0' id='fielddata' style="width:100%;"></div>
				</div>
				<div id='div_modelstr' style='display:none;'>
					<br />
					<textarea id='modelstr' rows='30' style='width:800px;overflow-x: scroll; overflow-y: scroll; white-space:nowrap;'></textarea>
				</div>
			</td>
		</tr>
	</table>
</td>
</tr>
</table>

</body>
</html>

<script type="text/javascript">
var g_files,fields;

//模型属性列表
var g_model_props="id,title,notes,type,base,tablename,sql,openurl,editurl,addurl,delurl,filter,orderby,groupby,open_window_style,pagerows,actions,keyfield,wayofcopyfields,cols,editcondition,sql_after_deleted,sql_after_inserted,view,calendar_title_field,calendar_date_field,more";
//模型重要属性列表，用于觉得是否默认显示
var g_model_props_display="id,title";
//所有模型属性定义,g_model_props中的属性id可以不出现在modelprops中，假如无需显示更多信息（如备注信息）的话
var modelprops=[
{id:'id1',name:'ID'},
{id:'title',name:'名称'},
{id:'notes',name:'备注'},
{id:'type',name:'类别'},
{id:'base',name:'父类'},
{id:'tablename',name:'表名',notes:'数据库表的表名'},
{id:'sql',name:'SQL'},
{id:'openurl',name:'打开网址',notes:'openurl：单击打开按钮时所执行个的url，即“index.php/”后面的url'},
{id:'editurl',name:'编辑网址',notes:'单击编辑按钮时所执行个的url，即“index.php/”后面的url'},
{id:'addurl',name:'新增网址',notes:'单击新增按钮时所执行个的url，即“index.php/”后面的url'},
{id:'delurl',name:'删除网址',notes:'单击删除按钮时所执行个的url，即“index.php/”后面的url'},
{id:'filter',name:'过滤条件',notes:"对表或sql语句的过滤条件，例如：type='1'"},
{id:'orderby',name:'排序'},
{id:'groupby',name:'是否分组'},
{id:'open_window_style',name:'新窗口打开方式'},
{id:'pagerows',name:'每页行数'},
{id:'actions',name:'按钮'},
{id:'keyfield',name:'关键字段'},
{id:'wayofcopyfields',name:'继承父类的方式'},
{id:'cols',name:'每行字段数'},
{id:'editcondition',name:'可编辑条件',notes:"例如：adduser=Me()"},
{id:'sql_after_deleted',name:'删除记录后执行SQL'},
{id:'sql_after_inserted',name:'保存新增记录后执行SQL'},
{id:'view',name:'查看方式'},
{id:'calendar_title_field',name:'日历标题字段',notes:'用日历方式显示时哪个字段用于显示标题'},
{id:'calendar_date_field',name:'日历日期字段',notes:'用日历方式显示时哪个字段是日期'},
{id:'more',name:'其它',notes:'其它自定义属性'}
];

//字段属性列表
var g_field_props="id,name,fieldtype,length,type,data,defaultdata,isvisible,visibleWhenAdd,readonly,unique,forsearch,virtualfield,nullable,style,width,height,formate,filter,count,prop";


var g_tablelist;//数据库表列表
g_remotehome="__APP__/Mcss/ModelMaker/";
var g_viewmode="hasvalue";//隐藏模型属性的模式，包括：hasvalue:根据是否有值觉得是否隐藏,somefield:指定字段隐藏
var modelid=getParamValue(document.location.href,"modelid");//看看是否有通过url传入的模型id
if (modelid.substr(modelid.length-1)=="#")
	modelid=modelid.substr(0,modelid.length-1);
if (modelid)
{
	$("#view_hide").attr("checked","true");
	changemodelview($("#view_hide").get(0));
}
$(document).ready(function(){
	reloadAllModel();
	var h=parseInt(screen.height)-100;
	$("#modellist").css("height",  h+"px");
	//把cookie里面的历史查询模型取出来并在下拉列表中显示
	var recent_modelids=getCookie('recent_modelids');
	var array = recent_modelids.split(",");
	$("#openhistory").append("<option></option>");
	for(i=array.length-1;i>-1;i--){
		$("#openhistory").append("<option value='"+array[i]+"'>"+array[i]+'.php'+"</option>");
	}
 })


function reloadAllModel()
{
	reloadModels();
	$("#visualview").hide();
	$("#modelaction").hide();
}
function fillModels(models,modelid)
{
		//g_files=data;
		listmodel(models,modelid);
		document.getElementById("searchmodelid").value=modelid;
		loadModelFromServer(modelid);
		listmodeltree("");	
		$("#searchmodelid").focus();
}


//重新从服务器获取模型列表
function fetchAllModelsFromServer()
{
	localStorage.removeItem("model_list");
	reloadModels();
}

function reloadModels()
{
	if (window.localStorage && localStorage.model_list)
	{
		var data=localStorage.model_list;
		data=JSON.parse(data);
		g_files=data;
		fillModels(data,modelid);
	}
	else
	{
	$.getJSON(g_remotehome+"get_treedir",{},function(data){
		//alert(data.length);
		g_files=data;
		if (window.localStorage)
		localStorage.model_list=JSON.stringify(data);
		fillModels(data,modelid);});
 	}
	$.get(g_remotehome+"getTableNames",function(data){
		g_tablelist=data.split(",");
 	});	
}
function newmodel()
{
	wl.currentNodeId=null;
	$("span").removeClass("menunav");//这个方法不好，需要改进
	
	$("#radio_editor").click();
	loadmodel(); 
	$("#model_id").attr("readOnly",false);
		
	$("#modelaction").show();
	$("#visualview").show();

}

function highLightItem(obj)
{
	$(obj.parentNode).find('a').css('background-color','');
	$(obj).css('background-color','yellow');
}
function openfile(obj)
{
	$("#searchmodelid").val($(obj).html());
	highLightItem(obj);
	var filename=obj.innerHTML;//$("#"+obj.id).text();
	var i=filename.lastIndexOf(".");
	var modelid=filename.substr(0,i);
	var selectedComs = document.getElementById("openhistory");
	$(".file").css('color','');
	$("#"+obj.id).css('color','red');
	if (obj.className=='file')
	{
		loadModelFromServer(modelid);
		if(selectedComs.length>=10){
			selectedComs.options.remove(0);
		}
		$("#openhistory").find("option[value='"+modelid+"']").remove();	
		$("#openhistory").append("<option value='"+modelid+"'>"+filename+"</option>");
		$("#openhistory").val(filename);
		//点击一次模型不仅在要下拉列表中显示出来，而且要把他存进cookie
		 
		var recent_modelids=selectedComs.options[0].value;		
		for(var i=1;i<selectedComs.length;i++){  
			recent_modelids=recent_modelids+","+selectedComs.options[i].value ;
		}   
		setCookie('recent_modelids',recent_modelids);	
	}	
}

//根据模型id从服务器加载模型文件到编辑器
function loadModelFromServer(modelid)
{
	if (!modelid) return;	
		$.getJSON("__APP__/Mcss/ModelMaker/getModel",{modelid:modelid},function(data){
			loadmodel(data,modelid); 
			showEditor();
		});
	
}

function showEditor()
{
		$("#div_modelstr").hide();
		$("#div_modeldata").show();
		$("#visualview").show();
		$("#modelaction").show();		
		$("#radio_editor").attr("checked","true");	
}

function listmodeltree(filter,loadstyle)
{
	if (!loadstyle)
		loadstyle="loadallshowone";
	var url="__APP__/Mcss/ModelMaker/get_treedir";
	$.getJSON(url,{filter:filter},function(data){
		srcData=data;
		var orgdata=getTreeJSON(data,0,'id','parentid');
		wl=new MCTree("modeltree",orgdata,{click:openServerFile,loadstyle:loadstyle,srcData:data,field_id:"id",field_pid:"parentid"});
		wl.run();	
	});
}
 
//根据输入字符模糊过滤模型列表
function listmodel(g_files,filter)
{

	if (filter == 'undefined')
		filter='';
 	var str="";
	var name="";
	for(var i=0;i<g_files.length;i++)
	{
		name=g_files[i]['name'];
		if (!name)
			continue;
		if (name.indexOf(".php")>-1 &&  (name.indexOf(filter)>-1))
			str+="<a class='file' id='"+name+"'  href=\"#\" title='"+name+"'>"+name+"</a><br />";
	}

	$("#modellist").html(str);
	$(".file").attr('onClick','openfile(this)');
	
}
 
function searchmodel(event)
{
	var id=$("#searchmodelid").val();
	listmodel(g_files,id);
	if (event.keyCode==13)
	{		
		var a=$("#modellist").find('a:first').get(0);
		highLightItem(a);
		$("#modellist").find('a:first').focus();
		openfile(a);
	}
}
 
//在过滤模型并重新生成树
function searchmodeltree(obj)
{
	if (event.keyCode==13){
		var searchword=obj.value;
		listmodeltree(searchword,"loadallshowall");
	}
} 

function loadmodel(data,modelid)
{
	setModelValue(data,modelid);	
}

function loadmodelfromstr()
{
	$("#div_modelstr").hide();
	$("#div_modeldata").show();

}

 
function set_model_props(data)
{
	var html="";
	var arr=g_model_props.split(",");
	for(var i=0;i<arr.length;i++)
	{
		html+=get_model_tr(arr[i],data);
	}
	html+="<tr><td><input id='dis_button' value='显示更多属性' type='button' onclick='displayMoreProp(this)' /></td></tr>";
	return html;
}


function displayMoreProp(obj)
{
	if(obj.value=='显示更多属性' )
	{
		$.each($(".model_hid"),function(i,v){
			v.style.display='table-row';
		})
		$("#dis_button").val('隐藏更多属性');
	}
	else
	{
		$.each($(".model_hid"),function(i,v){
			v.style.display='none';
		})
		$("#dis_button").val('显示更多属性');
	}
	showhidemoreprop();
}

//创建模型编辑器各组件
function setModelValue(data,modelid)
{
	$("#modeldata").empty();
	$("#fielddata").empty();
	
	html=set_model_props(data);

	$("#modeldata").append(html);
 
	$("#model_id").val(modelid);
	createFields(data);
	showhidemoreprop();
	$("#model_id").attr("readOnly",true);
} 


//创建模型中的字段列表
function createFields(data)
{	
	var html='';
		html+="<table id='fields' style='width:100px;'></table>"
		
 	$("#fielddata").append(html);
	var fieldhead="<caption style='text-align:left;white-space:nowrap;'>字段列表<input type='button' value='增' onclick='addrow()'>"
	+"<input type='button' value='添加常用字段' onclick='addAlsoUseField()'>"
	+"<input type='button' value='加载数据库表字段' onclick='loadfromtable()'>"
	+"<input type='button' value='从父类选择字段' onclick='selectFieldFromParent(this)'>"
	+"<input type='button' style='text-align:right;' value='显示/隐藏更多属性' onclick='showhidemoreprop()'>";
	+"</caption>";
	$("#fields").append(fieldhead);	
		var html='';
		html+="<tr>"
		html+="<th style='white-space:nowrap;'>操作</th>";
		html+="<th>ID</th>";
		html+="<th title='字段名称'>名称</th>";
		html+="<th title='字段类型'>类型</th>";
		html+="<th title='字段长度'>长度</th>";
		html+="<th title='编辑器'>编辑</th>";
		html+="<th title='数据项列表，或通过sql获得'>数据</th>";
		html+="<th title='显示在列表'>列表</th>";
		html+="<th title='显示在表单'>表单</th>";
		html+="<th style='white-space:nowrap;'>默认值</th>";
		html+="<th>只读</th>";
		html+="<th title='字段值在整个表中不能重复'>唯一</th>";
		html+="<th title='模糊搜索需要搜索该字段'>搜索</th>";
		html+="<th title='虚拟字段'>虚拟</th>";
		html+="<th>必填</th>";
		html+="<th>样式</th>";
		html+="<th>宽度</th>";
		html+="<th>高度</th>";
		html+="<th title='输入验证代码，例如email、mobile、tel,int,float'>格式</th>";
		html+="<th title=''>过滤器</th>";
		html+="<th title='在分组栏显示字段合计值，前提是把‘是否分组’设为分组'>合计</th>";
		html+="<th title='其它属性'>其它</th>";
		html+="</tr>";
 	$("#fields").append(html);
	if (data && data.fields && data.fields.length>0)
	{
		fields = data.fields;
		$.each(data.fields,function(i,v){
			addfield(v);		
		});
	}
	
	var html="<br><br><table id='fields_child' style='width:100px;'></table>";
	$("#fields").after(html);
	fieldhead="<caption style='text-align:left'>子数据列表<input type='button' value='增' onclick='addrowchild()'></caption>";
	$("#fields_child").append(fieldhead);
	var html='';
		html+="<tr>"
		html+="<th style='white-space:nowrap;'>操作</th>";
		html+="<th style='white-space:nowrap;'>子表模型ID</th>";
		html+="<th style='white-space:nowrap;'>模型名称</th>";
		html+="<th style='white-space:nowrap;'>关联字段</th>";
		html+="<th style='white-space:nowrap;'>父表关联字段</th>";
		html+="<th style='white-space:nowrap;'>备注</th>";
		html+="</tr>";
	$("#fields_child").append(html);
	if (data && data.children)
	{
		fields_child=data.children;		
		$.each(data.children,function(i,v){
			addChildField(v);		
		});
	}
}
//显示、隐藏更多的字段属性
function showhidemoreprop()
{
	var t=$("#fields")[0];
	var hidemore=$("#fields").data("hidemorefield");
	if (hidemore){
		$("#fields").data("hidemorefield",false);
		hidemore=false;
	}
	else{
		$("#fields").data("hidemorefield",true);
		hidemore=true;
	}
	
	showhideprop(hidemore);
	
}


//显示或隐藏更多属性
function showhideprop(hidemore)
{	
	var t=$("#fields")[0];
	var cell_count=t.rows[0].cells.length;
	for(var i=0;i<t.rows.length;i++)
	{
		for(var j=15;j<cell_count;j++)
		{
			if (hidemore)
				t.rows[i].cells[j].style.display="none";
			else
				t.rows[i].cells[j].style.display="";
		}
	}
}
function addAlsoUseField(){
	var fields = [{id:"id",name:"ID",fieldtype:"int",isvisible:"false",visibleWhenAdd:"false",prop:"PRIMARYKEY;AUTO_INCREMENT"},{id:"SYS_ADDTIME",name:"创建时间",fieldtype:"datetime",type:"SYS_ADDTIME",isvisible:"false",visibleWhenAdd:"false",readonly:"true"},{id:"SYS_ADDUSER",name:"创建者",fieldtype:"string",type:"SYS_ADDUSER",isvisible:"false",visibleWhenAdd:"false",readonly:"true"},{id:"SYS_EDITUSER",name:"更新者",fieldtype:"string",type:"SYS_EDITUSER",isvisible:"false",visibleWhenAdd:"false",readonly:"true"},{id:"SYS_EDITTIME",name:"更新时间",fieldtype:"datetime",type:"SYS_EDITTIME",isvisible:"false",visibleWhenAdd:"false",readonly:"true"},{id:"SYS_ORGID",name:"组织ID",fieldtype:"int",type:"SYS_ORGID",isvisible:"false",visibleWhenAdd:"false"}];
	var currentfields = $(".field_id");
	for(var i = 0;i < fields.length;i++){
		var condition = true;
		for(var k = 0;k < currentfields.length;k++){
			var fieldid = $(currentfields[k]).attr("value");
			if(fieldid == fields[i].id){
				condition = false;
				break;
			}
		}
		if(condition)
			addfield(fields[i]);
		else
			continue;
	}
}

function loadfromtable()
{
	//alert("根据数据表字段生成");
	var table=$("#model_tablename").val();
	var url="__APP__/Mcss/ModelMaker/getTableFields";
	$.getJSON(url,{table:table},function(fields){
		if (!fields){
			alert("没有发现指定表！");
			return;
		}
		for(i in fields){
			
			if ($("#field_id_"+fields[i].id).length==0){
				//alert(fields[i].id);
				addfield(fields[i]);
			}
		}
		//alert(fields);
	}
	)
} 

//重置父字段的行ID
function resetRowID()
{
	var rows=$("#fields")[0].rows;
	for(i in rows)
	{
	rows[i].id="row_"+i;
	}
}
//重置子字段的行ID
function resetRowID2()
{
	var rows=$("#fields_child")[0].rows;
	for(i in rows)
	{
		rows[i].id="row_child_"+i;
	}
}
//添加子字段
function addChildField(v,rowindex)
{
	var html="<tr>";
	html +="<td style='white-space:nowrap;'><input type='button' value='增' onclick='addrowchild(this.parentNode.parentNode.rowIndex)'><input type='button' value='删' onclick='deleterow2(this)'><input type='button' value='上' onclick='moveup2(this)'><input type='button' value='下' onclick='movedown2(this)'></td>";
	html += get_field_td2('modelid',v);
	html += get_field_td2('name',v);
	html += get_field_td2('child_field',v);
	html += get_field_td2('parent_field',v);
	html += get_field_td2('childnotes',v);
	html +="</tr>";
	if (rowindex>0)
		$("#row_child_"+rowindex).before(html);
	else
		$("#fields_child").append(html);
	if(v['modelid']){
		var fid="f"+($("#fields_child")[0].rows.length-1);
		var object = {value:v['modelid'],def:v['child_field']};
		get_select_child(object,fid,'child_field');
	}
	resetRowID2();
}

function entertr(e)
{
$(e).children().css("left-border-color","red");
}

//添加父子段
function addfield(v,rowindex,fewprop)
{
	var html="<tr onmouseover='entertr(this)'>";
	html +="<td style='white-space:nowrap;'><input type='button' value='增' onclick='addrow(this.parentNode.parentNode.rowIndex)'><input type='button' value='删' onclick='deleterow(this)'><input type='button' value='上' onclick='moveup(this)'><input type='button' value='下' onclick='movedown(this)'></td>";
	html += get_field_td('id',v);		
	html += get_field_td('name',v);		
	
	if (fewprop)
	{
		var defaultfieldvalue="";
	}
	html += get_field_td('fieldtype',v,defaultfieldvalue);		
	html += get_field_td('length',v,defaultfieldvalue);		
	html += get_field_td('type',v,defaultfieldvalue);		
	html += get_field_td('data',v,defaultfieldvalue);		
	html += get_field_td('isvisible',v,defaultfieldvalue);		
	html += get_field_td('visibleWhenAdd',v,defaultfieldvalue);		
	html += get_field_td('defaultdata',v,defaultfieldvalue);	
	html += get_field_td_checkbox('readonly',v,defaultfieldvalue);		
	html += get_field_td_checkbox('unique',v,defaultfieldvalue);		
	html += get_field_td_checkbox('forsearch',v,defaultfieldvalue);
	html += get_field_td_checkbox('virtualfield',v,defaultfieldvalue);
	html += get_field_td('nullable',v,defaultfieldvalue);	
	html += get_field_td('style',v,defaultfieldvalue);		
	html += get_field_td('width',v,defaultfieldvalue);
	html += get_field_td('height',v,defaultfieldvalue);		
	html += get_field_td('formate',v,defaultfieldvalue);		
	html += get_field_td('filter',v,defaultfieldvalue);
	html += get_field_td_checkbox('count',v,defaultfieldvalue);									
	html += get_field_td('prop',v,defaultfieldvalue);
	//}
	html+="</tr>";
	if (rowindex>0)
		$("#row_"+rowindex).before(html);
	else
		$("#fields").append(html);

	var hidemore=$("#fields").data("hidemorefield");
	showhideprop(hidemore);
	
	resetRowID();

}

//添加父子段的行
function addrow(rowIndex)
{
	var fieldvalue={id:"f"+$("#fields")[0].rows.length,name:"新字段"};

 	if (rowIndex)
		addfield(fieldvalue,rowIndex);
	else
		addfield(fieldvalue);
	//showhidemoreprop();	
}
//添加子字段的行
function addrowchild(rowIndex)
{
	if(rowIndex)
		addChildField('',rowIndex);
	else
		addChildField('');
}

//父子段向上移动节点
function moveup(obj)
{
	var tr=obj.parentNode.parentNode;
	var rowindex=tr.rowIndex;
	var table=tr.parentNode;
	if (rowindex>1)
	{
		var thisrow=table.rows[rowindex];
		var nextrow=table.rows[rowindex-1];
		swapNode(thisrow,nextrow);	
		//table.rows[rowindex].innerHTML=nextrow;
		//table.rows[rowindex-1].innerHTML=thisrow;
		resetRowID();
	}
}
//子字段向上移动节点
function moveup2(obj)
{
	var tr=obj.parentNode.parentNode;
	var rowindex=tr.rowIndex;
	var table=tr.parentNode;
	if (rowindex>1)
	{
		var thisrow=table.rows[rowindex];
		var nextrow=table.rows[rowindex-1];
		swapNode(thisrow,nextrow);	
		resetRowID2();
	}
}
//父子段向下移动节点
function movedown(obj)
{
	var tr=obj.parentNode.parentNode;
	var rowindex=tr.rowIndex;
	var table=tr.parentNode;
	if (rowindex<table.rows.length)
	{
		var thisrow=table.rows[rowindex];
		var nextrow=table.rows[rowindex+1];
		swapNode(thisrow,nextrow);
		resetRowID();
	}
}
//子字段向下移动节点
function movedown2(obj)
{
	var tr=obj.parentNode.parentNode;
	var rowindex=tr.rowIndex;
	var table=tr.parentNode;
	if (rowindex<table.rows.length)
	{
		var thisrow=table.rows[rowindex];
		var nextrow=table.rows[rowindex+1];
		swapNode(thisrow,nextrow);
		resetRowID2();
	}
}

//定义通用的函数交换两个结点的位置 
function swapNode(node1,node2){ 
	//获取父结点 
	var _parent=node1.parentNode; 
	//获取两个结点的相对位置 
	var _t1=node1.nextSibling; 
	var _t2=node2.nextSibling; 
	//将node2插入到原来node1的位置 
	if(_t1)_parent.insertBefore(node2,_t1); 
	else _parent.appendChild(node2); 
	//将node1插入到原来node2的位置 
	if(_t2)_parent.insertBefore(node1,_t2); 
	else _parent.appendChild(node1); 
} 
//删除父子段的行
function deleterow(obj)
{
 	var tr=obj.parentNode.parentNode;
	var table=tr.parentNode;
	table.removeChild(tr);
	resetRowID();
}
//删除子字段的行
function deleterow2(obj)
{
 	var tr=obj.parentNode.parentNode;
	var table=tr.parentNode;
	table.removeChild(tr);
	resetRowID2();
}


function get_model_tr(prop,data,text)
{
	var name=prop;
	var notes="";
	for(var i=0;i<modelprops.length;i++)
	{
		if (modelprops[i]['id']==prop)
		{
			name=modelprops[i].name;
			if (modelprops[i].notes)
			{
				notes=modelprops[i].id+":"+modelprops[i].notes;
			}
			else
				notes=modelprops[i].id;
			break;
		}
	}
	var fvalue='';
	var s="";
	if (data && data[prop])
		fvalue=data[prop];

	if(fvalue=="" && prop!="id" && prop!="title")
		s="<tr class='model_hid' style='display:none'><td width='20%' style='vertical-align:top;' title='"+notes+"'>"+name+"</td><td>";
	else
		s="<tr><td width='20%' style='vertical-align:top;' title='"+notes+"'>"+name+"</td><td>";
	if (prop=="actions")
	{
		s+=createActionHTML(prop,fvalue);
	}
	else 
	if(prop=="groupby")
	{
		s+=get_select_groupby(fvalue,prop);
	}
	else 
	if (prop=="open_window_style")
	{
		s+=get_select_open_window_style(fvalue,prop);
	}
	else 
	if (prop=="cols")
	{
		s+=get_select_cols(fvalue,prop);
	}	
	else 
	if (prop=="view")
	{
		s+=get_select_view(fvalue,prop);
	}else 
	if (prop=="wayofcopyfields")
	{
		s+=get_select_base_fields(fvalue,prop);
	}	
	else 
	//if (prop=="tablename") //把数据库表列表加载出来
	if (prop=="tablename123不用了") //把数据库表列表加载出来
	{
 		s+="<select id='model_"+prop+"' value='"+fvalue+"' style='width:85%'>";
		var tt="";
 		for(i in g_tablelist)
		{
			tt+="<option";
			if (g_tablelist[i]==fvalue)
			{
				tt+=" selected='true' ";
			}
			tt+=">"+g_tablelist[i]+"</option>";
		}
 		s+=tt+"</select></td></tr>";
	}	
	else
	if (prop=="tablename")
	{	
		s+="<input type='text' id='model_"+prop+"' value='"+fvalue+"' style='width:85%' />";
		s+="<input type='button' value='加载' title='显示所有数据库表的表名' onclick='loadTables(this,\""+prop+"\",\""+fvalue+"\")'></td></tr>";
	}
	else 
	if (prop=="sql")
	{
		s+="<textarea id='model_"+prop+"'  style='width:85%' >"+fvalue+"</textarea>";
	}
	else 
	if (prop=="base")
	{	
		s+="<input type='text' id='model_"+prop+"' value='"+fvalue+"' style='width:85%' />";
		s+="<input type='button' value='打开' onclick='openbase(this)'></td></tr>";
	}
	else 
	if (prop=="pagerows")
	{	
		s+="<input type='text' id='model_"+prop+"' value='"+fvalue+"' style='width:50px;' />";
		s+=get_select_pagerows(fvalue,prop);
	}
	else
	{
		fvalue=fvalue.replace(/'/gi,"\"");
		//alert(fvalue);
		s+="<input type='text' id='model_"+prop+"' value='"+fvalue+"' style='width:85%' />";
 	}
	return s;
}

//从数据库加载所有表
function loadTables(e,prop,fvalue)
{
	if (e.value=="加载")
	{
	 	var s="";
 		s+="<select id='model_"+prop+"' value='"+fvalue+"' style='width:85%'>";
		var tt="";
 		for(i in g_tablelist)
		{
			tt+="<option";
			if (g_tablelist[i]==fvalue)
			{
				tt+=" selected='true' ";
			}
			tt+=">"+g_tablelist[i]+"</option>";
		}
 		s+=tt+"</select>";
 		$("#model_"+prop).remove();
 		$(e).before(s);
 		$(e).remove();
 	}

}
//创建按钮组
function createActionHTML(prop,fvalue)
{
	var s="";
		s+="<input type='text' id='model_"+prop+"' value='"+fvalue+"' style='width:85%' /><br />";	
		s+=createActions(fvalue,"add","新增");
		s+=createActions(fvalue,"del","删除");
		s+=createActions(fvalue,"open","打开");
		s+=createActions(fvalue,"edit","编辑");
		s+=createActions(fvalue,"tableedit","表内编辑");
		//s+=createActions(fvalue,"save","保存");
		s+=createActions(fvalue,"search","模糊搜索");
		s+=createActions(fvalue,"search2","高级搜索");
		s+=createActions(fvalue,"filter","简单过滤器");
		s+=createActions(fvalue,"filter2","高级过滤器");
		s+=createActions(fvalue,"groupby","分组");
		s+=createActions(fvalue,"import","导入");
		s+=createActions(fvalue,"export","导出");
		s+=createActions(fvalue,"print","打印");
		//s+=createActions(fvalue,"confirm","确定所选");		
		s+=createActions(fvalue,"refresh","刷新");
		s+=createActions(fvalue,"autowidth","调整宽度");
		s+=createActions(fvalue,"view","查看方式");
		s+=createActions(fvalue,"page","翻页");
		s+=createActions(fvalue,"all","所有");
	return s;
}
function createActions(fvalue,actionid,actionname)
{
	var s="";
	s+="<input type='checkbox' class='model_action' id='"+actionid+"' onchange='getactions()'";
	if ((","+fvalue+",").indexOf(","+actionid+",")>-1)
		s+=" checked='true' ";
	s+="<span for='"+actionid+"'>"+actionname+"</span>";	
	return s;
}

function getactions()
{
	var s="";
	var diyactions="";
	var nowactions=$("#model_actions").val().split(',');
	for(var i=0;i<nowactions.length;i++)
	{
		var found=false;
		$(".model_action").each(function(j,v){
			if (nowactions[i]==v.id)
			{
				found=true;
			}
		})
		if (found==false)
			diyactions+=","+nowactions[i];
	}
	
	$(".model_action").each(function(i,v){
		if (v.checked)
		{
		if (s=="")
			s=v.id;
		else
			s+=","+v.id;
		}
	})
	//alert(s);
	if ((s+",").indexOf("all,")>-1)
		s="all";
	$("#model_actions").val(s+diyactions);
}

function enlargetext(objid)
{
	var h='80px';
	if ($("#"+objid).css("height")=="80px")
		h='15px';
	$("#"+objid).css("height",h);
}
function openbase(obj)
{
	modelid=$(obj).prev("input").val()
	ShowIframe("__APP__/Mcss/ModelMaker/modelmanager/modelid/"+modelid,800,600,"编辑模型");
}
var popp;
function ShowIframe(url, w, h, t) //显示有滚动条的iframe
{
    var pop = new Popup({
        contentType: 1,
        scrollType: 'yes',
        isReloadOnClose: false,
        width: w,
        height: h
    });
    pop.setContent("contentUrl", url);
    pop.setContent("title", t);
    pop.build();
    pop.show();
    popp = pop;
}
function get_field_tr_checkbox1(name,prop,v)
{
	var fvalue='false';
	if (v[prop])
		fvalue=v[prop];
	var html="<tr><td>"+name+"</td><td><input type='checkbox' id='field_"+prop+"_"+v.id+"' checked='"+fvalue+"' /></td></tr>";
 	return html;
}

function get_field_td_checkbox(prop,v,defaultfieldvalue)
{
	var fvalue=false;
	if (v[prop])
		fvalue=v[prop];
	var html="<td><input type='checkbox' id='field_"+prop+"_"+v.id+"' ";
	if (defaultfieldvalue!=undefined)
		fvalue=defaultfieldvalue;
	if (fvalue) 
		html+=" checked ";
	html+="	/></td>";
 	return html;
}


//获取父字段列
function get_field_td(prop,v,defaultfieldvalue)
{
	var html=""; 
	html="<td style='width:80px;'>";
	fieldvalue='';
	if (v[prop])
	{
		fieldvalue=v[prop];
	}
	if (defaultfieldvalue!=undefined)
		fieldvalue=defaultfieldvalue;

	var editor="";
 	
	if (prop=="type")
	{
	editor=get_select_type(fieldvalue,v["id"]);
	}
	else
	if (prop=="isvisible")
	{
	editor=get_select_isvisible(fieldvalue,v["id"],prop);
	}	
	else
	if (prop=="visibleWhenAdd")
	{
	editor=get_select_isvisible(fieldvalue,v["id"],prop);
	}
	else
	if (prop=="nullable")
	{
	editor=get_select_nullable(fieldvalue,v["id"],prop);
	}
	else
	if (prop=="fieldtype")
	{
	editor=get_select_fieldtype(fieldvalue,v["id"]);
	}
	else
	{
		var	fid=v.id;
			
		if (prop=="id")
		{
			if (!fieldvalue)
				fieldvalue="f"+$("#fields")[0].rows.length;
			if (!fid)
				fid=fieldvalue;
		}
		if (prop=="name")
		{
			if (!fieldvalue)
				fieldvalue="字段"+$("#fields")[0].rows.length;
		}
		editor="<input type='text' class='field_"+prop+"' id='field_"+prop+"_"+fid+"' value=\""+fieldvalue+"\" style='width:80px;' onchange='valuechange(this)' ondblclick='dblclickField(this);'/>";
	}
	html+=editor;
 	html+="</td>";
 	return html;
}

//获取子字段列
function get_field_td2(prop,v)
{
	var html=""; 
	html="<td style='width:80px;'>";
	var fieldvalue='';
	var fid="f"+$("#fields_child")[0].rows.length;
	if (v[prop])	
	{
		fieldvalue=v[prop];
	}
	var editor="";
	if (prop=="child_field")
	{
		var object = {value:fieldvalue};
		editor=get_select_child(object,fid,prop);
	}
	else 	
	if (prop=="parent_field")
	{
		editor=get_select_parent(fieldvalue,fid,prop);
	}	
	else
	{
		if (prop=="modelid")
		{
			if (!fieldvalue)
				fieldvalue="f"+$("#fields_child")[0].rows.length;
				editor="<input type='text' class='field_"+prop+"' id='field_"+prop+"_"+fid+"' value=\""+fieldvalue+"\" style='width:80px;' onchange='get_select_child(this,\""+fid+"\",\"child_field\")'/>";
		}
		else if (prop=="name")
		{	
			if (!fieldvalue)
				fieldvalue="字段"+$("#fields_child")[0].rows.length;
				editor="<input type='text' class='field_"+prop+"' id='field_"+prop+"_"+fid+"' value=\""+fieldvalue+"\" style='width:80px;' />";
		}
		else{
			editor="<input type='text' class='field_"+prop+"' id='field_"+prop+"_"+fid+"' value=\""+fieldvalue+"\" style='width:80px;' />";
		}
		
	}
	html+=editor;

 	html+="</td>";
 	return html;
}

//双击字段时
function dblclickField(obj)
{
	if (obj.id.indexOf("field_prop")>-1) //如果是其它属性字段
	{
		var fieldtext=$(obj).val();
		var h="";
		if(fieldtext.indexOf("PRIMARYKEY")>-1)		
			h+="<input type='checkbox' id='PRIMARYKEY' checked='checked'/>PRAMARY KEY ";
		else
			h+="<input type='checkbox' id='PRIMARYKEY' />PRAMARY KEY ";
			
		if(fieldtext.indexOf("AUTO_INCREMENT")>-1)
			h+="<input type='checkbox' id='AUTO_INCREMENT' checked='checked'/>递增数字";	
		else
			h+="<input type='checkbox' id='AUTO_INCREMENT' />递增数字";
			
		if(fieldtext.indexOf("OPENRECORD")>-1)
			h+="<input type='checkbox' id='OPENRECORD' checked='checked' />打开记录";
		else
			h+="<input type='checkbox' id='OPENRECORD' />打开记录";
			
		if(fieldtext.indexOf("NOTORDER")>-1)
			h+="<input type='checkbox' id='NOTORDER' checked='checked' />不排序";
		else
			h+="<input type='checkbox' id='NOTORDER' />不排序";
		
		h+="<br /><input type='button' id='confirm_prop'  value='确定' />";
		//var popup=mcdom.showPopup(obj,h,null,null,null,200,400,"其它属性");			
		var popup=mcdom.popup(h,{obj:obj,height:200,width:400,title:"其它属性"});			
		
		$("#AUTO_INCREMENT").click(function(){
			if ($("#AUTO_INCREMENT").attr("checked"))
				$("#PRIMARYKEY").attr("checked","true");
		})
		
		$("#confirm_prop").click(function(){
				

			var prop="";
			if ($("#PRIMARYKEY").attr("checked"))
			{
				if (prop) prop+=";";
				prop+="PRIMARYKEY";
			}
			if ($("#AUTO_INCREMENT").attr("checked"))
			{
				if (prop) prop+=";";
				prop+="AUTO_INCREMENT";
			}	
			if ($("#OPENRECORD").attr("checked"))
			{
				if (prop) prop+=";";
				prop+="OPENRECORD";
			}
			if ($("#NOTORDER").attr("checked"))
			{
				if (prop) prop+=";";
				prop+="NOTORDER";
			}
			obj.value=prop;
			$(popup).remove();
		})
 	}
}

function valuechange(obj)
{
	if (obj.id.indexOf("field_id")>-1) //如果是id字段
	{
 		var rowindex=obj.parentNode.parentNode.rowIndex;
		var props=g_field_props.split(',');
		for(i in props)
		{
			change_inputobj_id(props[i],rowindex,obj.value);
		}
	
 	}
}

function change_inputobj_id(prop,rowIndex,newid)
{
		$(".field_"+prop).each(function(i,v){
			if (v.parentNode.parentNode.rowIndex==rowIndex)
			{
				v.id="field_"+prop+"_"+newid;
				//alert(v.outerHTML);
 			}
		})
}
//根据字段的id该字段各属性编辑框对象的id
function change_fieldobj_id(id)
{

}
function get_field_tr1(name,prop,v)
{
	var html=""; 
	fieldvalue='';
	if (v[prop])
	{
		fieldvalue=v[prop];
	}
	html="<tr><td>"+name+"</td><td><input type='text' class='field_"+prop+"' id='field_"+prop+"_"+v.id+"' value='"+fieldvalue+"' /></td></tr>";
	return html;
}

function get_option(v,text,fieldtype)
{
	var s="<option value='"+v+"'";
	if (v==fieldtype)
		s+=" selected='true'";
	s+=">"+text+"</option>";
	return s;
}

function get_select_isvisible(fieldvalue,fieldid,prop)
{
	var s="<select id='field_"+prop+"_"+fieldid+"' class='field_"+prop+"'>";
	s+=get_option("","",fieldvalue);
	s+=get_option("true","显示",fieldvalue);
	s+=get_option("false","不显示",fieldvalue);
	 
	s+="</select>";
	return s;
}

function get_select_child(obj,fieldid,prop)
{
	var s='';
	var arr = obj.value.split('_');
	var path= arr[0]+'/'+'Models'+'/'+obj.value+'.php';
	var sep="[xiegan]";
	path=path.replace(/[\\ \/=]/g,sep);//把反斜杠替换为字符，到后台后再换回来 
	$.getJSON("__APP__/Mcss/ModelMaker/getModelByPath",{"path":path,"separator":sep},function(data){
		if(data)
		{
			$("#field_"+prop+"_"+fieldid).html('');
			s+=get_option('','子类字段',obj.value);
			$.each(data.fields,function(i,v){
				s+=get_option(v['id'],v['id'],obj.def);
			});
			$("#field_"+prop+"_"+fieldid).append(s);	
		}
	});
	s+="<select id='field_"+prop+"_"+fieldid+"' >";
		//s+=get_option('','子类字段',obj.value);
		s+="</select>";
	return s;
}

function get_select_parent(fieldvalue,fieldid,prop)
{
	var s="<select id='field_"+prop+"_"+fieldid+"' >";
	//s+=get_option("","主表字段",fieldvalue);
	$.each(fields,function(i,v){
		s+=get_option(v['id'],v['id'],fieldvalue);	
	});
	s+="</select>";
	return s;
}

function get_select_nullable(fieldvalue,fieldid,prop)
{
	var s="<select id='field_"+prop+"_"+fieldid+"' class='field_"+prop+"'>";
	s+=get_option("","",fieldvalue);
	s+=get_option("false","必填",fieldvalue);
	s+=get_option("true","可空",fieldvalue); 
	s+="</select>";
	return s;
}
function get_select_type(fieldtype,fieldid)
{
	var s="<select id='field_type_"+fieldid+"' class='field_type' >";
	s+=get_option("","",fieldtype);
	s+=get_option("text","单行文本",fieldtype);
	s+=get_option("radio","单选框",fieldtype);
 	s+=get_option("checkbox","复选框",fieldtype);
 	s+=get_option("checkboxlist","复选框列表",fieldtype);
	s+=get_option("date","日期",fieldtype);
	s+=get_option("datetime","日期时间",fieldtype);
	s+=get_option("dropdown","下拉列表",fieldtype);
	s+=get_option("smartselect","智能选择",fieldtype);
	s+=get_option("textarea","多行文本框",fieldtype);
	s+=get_option("richeditor","富文本编辑框",fieldtype);
	s+=get_option("file","文件上传",fieldtype);
	s+=get_option("image","图片上传",fieldtype);
	s+=get_option("password","密码",fieldtype);
	s+=get_option("hidden","*号显示",fieldtype);
	s+=get_option("popupselectone","弹出单选",fieldtype);
	s+=get_option("recordindex","记录序号",fieldtype);
	s+=get_option("calculated","计算表达式",fieldtype);
	s+=get_option("SYS_ADDTIME","记录创建时间",fieldtype);
	s+=get_option("SYS_ADDUSER","记录创建者",fieldtype);
	s+=get_option("SYS_EDITTIME","记录更新时间",fieldtype);
	s+=get_option("SYS_EDITUSER","记录更新者",fieldtype);
	s+=get_option("SYS_ORGID","组织ID",fieldtype);
	s+="</select>";
	return s;
}

function get_select_groupby(fieldvalue,prop)
{
	var s="<select id='model_"+prop+"' value='"+fieldvalue+"' >";
	s+=get_option("","",fieldvalue);
	s+=get_option("y","分组（按orderby字段分组）",fieldvalue);
	s+=get_option("n","不分组",fieldvalue);
	s+="</select>";
	return s;
}

function get_select_open_window_style(fieldvalue,prop)
{
	var s="<select id='model_"+prop+"' value='"+fieldvalue+"' >";
	s+=get_option("","",fieldvalue);
	s+=get_option("samewindow","当前窗口",fieldvalue);
	s+=get_option("newwindow","新窗口",fieldvalue);
	s+=get_option("popup:small","弹出窗口(小窗口)",fieldvalue);
	s+=get_option("popup:middle","弹出窗口(中窗口)",fieldvalue);
	s+=get_option("popup:large","弹出窗口(大窗口)",fieldvalue);
	s+="</select>";
	return s;
}

function get_select_cols(fieldvalue,prop)
{
	var s="<select id='model_"+prop+"' value='"+fieldvalue+"' >";
	s+=get_option("","",fieldvalue);
	s+=get_option("1","一排",fieldvalue);
	s+=get_option("2","二排",fieldvalue);
	s+=get_option("3","三排",fieldvalue);
	s+="</select>";
	return s;
}

function get_select_view(fieldvalue,prop)
{
	var s="<select id='model_"+prop+"' value='"+fieldvalue+"' >";
	s+=get_option("","",fieldvalue);
	s+=get_option("table","表格",fieldvalue);
	s+=get_option("calendar","日历",fieldvalue);
	s+="</select>";
	return s;
}

function get_select_base_fields(fieldvalue,prop)
{
	var s="<select id='model_"+prop+"' value='"+fieldvalue+"' >";
	s+=get_option("","默认（如果子类设置任何字段则不继承父类字段，否则采用父类字段）",fieldvalue);
	s+=get_option("parent_and_child","先复制父类字段，再加上子类字段，字段ID相同的以子类字段为准",fieldvalue);
	s+=get_option("onlycopyprop","字段数量以子类为准，ID相同的字段的属性全部以父类，子类属性无效",fieldvalue);
	s+="</select>";
	return s;
}

function get_select_pagerows()
{
	var s="<select onchange='selectpagerows(this,\"pagerows\")'>";
	s+="<option value=''></opton>";
	s+="<option value='5'>5</opton>";
	s+="<option value='10'>10</opton>";
	s+="<option value='20'>20</opton>";
	s+="<option value='50'>50</opton>";
	s+="<option value='100'>100</opton>";
	s+="<option value='200'>200</opton>";
	s+="<option value='500'>500</opton>";
	s+="<option value='10000'>10000</opton>";
	s+="</select>";
	return s;
}

function selectpagerows(obj,prop)
{
	$("#model_"+prop).val(obj.value);
}

function get_select_fieldtype(fieldtype,fieldid)
{
	var s="<select id='field_fieldtype_"+fieldid+"' class='field_fieldtype' >";
	s+=get_option("","",fieldtype);
	s+=get_option("string","字符",fieldtype);
	s+=get_option("float","小数(float)",fieldtype);
	s+=get_option("real","小数(real)",fieldtype);
	s+=get_option("date","日期",fieldtype);
	s+=get_option("datetime","日期时间",fieldtype);
	s+=get_option("int","整数",fieldtype);
	s+="</select>";
	return s;
}
 
function getModelStr()
{
	var modelstr="";
	modelstr += get_modelPropertyStr_All();
	modelstr += get_fielddata();
	modelstr += get_fielddata_child();
	return modelstr;
}

function get_fielddata()
{
	var f="";
	$.each($(".field_id"),function(i,v)
	{
		var fieldid=v.value;
		if (fieldid!="")
		{
			var propvalue='';
			var props=g_field_props.split(',');
			for(i in props)
			{
				propvalue+=get_fieldpropvalue(props[i],fieldid);
			}
			
			if (propvalue!='')
			{
				f += "\r\n array("+propvalue+"),";
			}
		}
	});
	if (f!="")
	{
		var s="'fields'=>array("+f+"\r\n),\n";
		return s;
	}
	return "";
}

function get_fielddata_child()
{
	var k="";
	$.each($(".field_modelid"),function(i,v)
	{
		var fieldid='f'+(i+1);
		if (fieldid!="")
		{
			var propvalue='';
			propvalue+=get_fieldpropvalue2('modelid',fieldid);
			propvalue+=get_fieldpropvalue2('name',fieldid);
			propvalue+=get_fieldpropvalue2('child_field',fieldid);
			propvalue+=get_fieldpropvalue2('parent_field',fieldid);
			propvalue+=get_fieldpropvalue2('childnotes',fieldid);
			if (propvalue!='')
			{
				k += "\r\n array("+propvalue+"),";
			}
		}
	});
	if(k!="")
	{
		var s="'children'=>array("+k+"\r\n)"
		return s;
	}
	return "";
	
}


function get_fieldpropvalue(propname,fieldid)
{
	var s='';
	if ($("#field_"+propname+"_"+fieldid).length>0)
	{
		var v1=$("#field_"+propname+"_"+fieldid).val();

		if ('readonly,unique,forsearch,virtualfield,count'.indexOf(propname)>-1)
		{
			v1=$("#field_"+propname+"_"+fieldid).attr('checked');
		}
		var v='';
		if (v1!='' && v1!=undefined)
		{
			v=v1;
			//v=v.replace(/"/gi,"\'");
			s="'"+propname+"'=>\""+ v + "\",";
		}
	}
	return s;
}

function get_fieldpropvalue2(propname,fieldid)
{
	var s='';
	if ($("#field_"+propname+"_"+fieldid).length>0)
	{
		var v1=$("#field_"+propname+"_"+fieldid).val();

		if ('readonly,unique,forsearch,virtualfield,count'.indexOf(propname)>-1)
		{
			v1=$("#field_"+propname+"_"+fieldid).attr('checked');
		}
		var v='';
		if (v1!='' && v1!=undefined)
		{
			v=v1;
			//v=v.replace(/"/gi,"\'");
			s="'"+propname+"'=>\""+ v + "\",";
		}
	}
	return s;
}


function get_modelPropertyStr_All()
{
	var html='';
	var arr=g_model_props.split(",");
	for(var i=0;i<arr.length;i++)
	{
		var v=document.getElementById("model_"+arr[i]).value;
		if (v){
			v=v.replace(/"/gi,"\'");
			html+="'"+arr[i]+"'=>\""+v+"\",\r\n";
		}
	}
	return html;
}



function convertostr()
{
	var modelid=$("#model_id").val();
	if ($("#model_id").val()=="")
		$("#model_id").val("noid");
	if ($("#model_title").val()=="")
		$("#model_title").val("无名");
	var v=getModelStr();
	v="array(\r\n"+v+"\r\n)";
	$("#modelstr").val(v);
//	$("#div_modelstr").show();
//	$("#div_modeldata").hide();
//	$("#radio_modelstr").attr("checked","true");

}


function showTextView()
{
	convertostr();
	$("#div_modelstr").show();
	$("#div_modeldata").hide();
	//$("#radio_modelstr").attr("checked","true");

}

function verifyModel()
{
var err='';
 
if ($("#model_id").length==0 || $("#model_id").val()=="")
{
	err='模型的ID不能为空!';
	 
}
if ($("#model_title").val()=="")
{
	err='模型的title不能为空!';
}
if (err=='')
	return true;
else
{
alert(err+",不能保存。");
return false;
}
 
}

function savemodel()
{
	if (!verifyModel()) return;
	
	var modelid=$("#model_id").val();
	v="";
	v=$("#modelstr").val();
	$.post(g_remotehome+"saveModel",
		{modelid:modelid,modelstr:v},
		function(data){
			//alert("保存成功！");
			$("#hintmsg").toggle(1000,null,true);			
			$("#hintmsg").toggle(1000,null,true);			

			var fileid=$("#model_id").val();
			var filename=fileid+'.php';
			$.getJSON("__APP__/Mcss/ModelMaker/getModelByPath",{"filename":filename},function(data){
				loadmodel(data,fileid); 
			});			
		}
	);
}



//新的保存模型的方法
function saveModelTreeAndcreateTable()
{
	saveOneModel(true);
}

function modelExists(modelid)
{
	for(var i=0;i<g_files.length;i++)
	{
		if (g_files[i]['name']==modelid+".php")
		{
			return true;
		}
	}
	return false;

}
//保存模型
function saveOneModel(createTable,delete_before_create)
{
	var ifExisted=modelExists($("#model_id").val());
	if ($("#model_id").attr("readOnly")==false && ifExisted)
	{
		alert("模型id已存在，请修改模型id！");
		return;
	}
	if ($("#radio_editor").attr("checked"))
	{
		convertostr();
	}

	if (!verifyModel()) return;

	var path=wl.getFullPath(wl.currentNodeId);
	var sep="[xiegan]";
	path=path.replace(/[\\ \/=]/g,sep);//把反斜杠替换为字符，到后天后再换回来 
		
	var modelid=$("#model_id").val();
	v="";
	v=$("#modelstr").val();
	$.post(g_remotehome+"saveModelByPath",{modelid:modelid,path:path,modelstr:v,separator:sep,createTable:createTable,delete_before_create:delete_before_create},	function(err){
		if (err)
			alert(err);
		else
		{	
			mcdom.alert("","<span style='color:red;'>保存成功！</span>",'','fadeout');
			$.getJSON("__APP__/Mcss/ModelMaker/getModel",{path:path,modelid:modelid},function(data){
				loadmodel(data,modelid); 
			});
			if (!path)
			{
				listmodeltree("","loadallshowall");
			}
			$("#model_id").attr("readOnly",true);
			if (ifExisted==false)
				fetchAllModelsFromServer();
		}		
	});
}

function deletemodel()
{	
	var modelid=$("#model_id").val();
	if (!modelid){
		alert('请先选择某个模型！');
		return;
	}
	if (!confirm("确认删除吗？")) return;
	$.post(g_remotehome+"deleteModel",
		{modelid:modelid},
		function(err){
			if (err=='')
			{
				$("#visualview").hide();
				$("#modelaction").hide();
				reloadAllModel();
				mcdom.minialert("删除成功！");

				//document.location.reload();
			}
			else
				alert(err);
		}
	);
}
function openmodel()
{
var v=$("#model_id").val();
var url=getrooturl()+"/index.php/System/Model/list2?param:table="+v;
window.open(url);

}

//获得网站跟路径url
function getrooturl()
{
	var strFullPath=window.document.location.href;
	var strPath=window.document.location.pathname;
	var pos=strFullPath.indexOf(strPath);
	var prePath=strFullPath.substring(0,pos);
	var postPath=strPath.substring(0,strPath.substr(1).indexOf('/')+1);
	var r=prePath+postPath;
	if (r.indexOf('index.php')>-1)
	{
		r=r.substr(0,r.length-9);
	}
 	return r;	
}
function changestyle(style)
{
	if (!wl.showStyle)
	{
		wl.changeShowStyle("waterpool");
		wl.showStyle="waterpool";
	}
	else{
		wl.changeShowStyle("");
		wl.showStyle="";
	}
	
}




//删除节点
function deleteNode(id)
{
	$("#"+id).remove();
}

//移动节点
function moveNode(obj,from_id)
{
var nodetype=obj.parentNode.parentNode.className;
if (nodetype=='dept' || nodetype=='position')
	nodetype='dept';
else
	nodetype='dept,position';

var d=getDeptList(orgdata,nodetype);
var nodeid=obj.parentNode.parentNode.id;
var option=createSelect(d);
if ($("#"+nodeid+"_move").length>0)
	$("#"+nodeid+"_move").html(option);
else{

	$(obj).after("<select id='"+nodeid+"_move"+"'>"+option+"</select>");
}

}

//打开模型文件
function openServerFile(obj){
	$("span").removeClass("menunav");
	$(obj).addClass("menunav");
	if (obj.innerHTML.indexOf(".php")>1)
	{
		var filename=obj.innerHTML;
		var i=filename.lastIndexOf(".");
		var modelid=filename.substr(0,i);
		loadModelFromServer(modelid);
	}
		
}
//获取模型文件的路径
function getFullPath(id,pid,nodename)
{
	var path=nodename;
	
	for(var i=0;i<srcData.length;i++)
	{
		if(pid<0)
		{
			break;
		}else{
			var conditon=pid+'_'+id;
			if ((srcData[i].id==conditon || srcData[i].id==id) && srcData[i].parentid==pid)
			{
				path+='@'+srcData[i].name;
				for(var k=0;k<srcData.length;k++)
				{
					if(srcData[k].id==srcData[i].parentid)
					{
						path=getFullPath(srcData[k].id,srcData[k].parentid,path);
					}
				}
			}
		}
	}
	return path;
}

function opennode(obj){
	alert(123);
}

function moveDept(deptId,toDeptId)
{
var h="<>";

}
function getDeptList(org,classname)
{
	var r="";
	for(i in org)
	{
		if(r!=""){
			r+=",";
		}
		if(!classname || classname.indexOf(org[i].className)>-1){
			r+=org[i].id+":--"+org[i].name;
			if (org[i].children){
				var r1=getDeptList(org[i].children,classname);
				if (r1)
					r+=","+r1;
			}
		}
	}
	return r;
	//alert(r);
}

function openForm_saveModelAndcreateTable(obj)
{
	var h="创建数据库表规则：表不存在则先创建；表中没有的字段会被创建；表中有而模型没有的字段不会被删除，除非先删除整个表<br /><input type='checkbox' id='delete_before_create' />如果表已存在则先删除(<span style='color:red'>慎重!!!</span>)";
	h+="<br /><br /><input type='button' id='confirm_createtable'  value='开始创建或更新' />";
	var popup=mcdom.showPopup(obj,h,null,null,200,300,300,'创建表');
	$("#confirm_createtable").click(function(){
		if ($("#model_tablename").val()=="")
		{
			mcdom.alert("表名不能为空！",'创建表','info',"fadeout");
			return;
		}
		var delete_before_create=$("#delete_before_create").attr("checked");	
		convertostr();
		saveOneModel(true,delete_before_create);	
		$(popup).remove();
	})	
}

function changemodelview(e)
{
	if (e.value=="list")
	{
		$("#td_modellist").show();
		$("#td_modeltree").hide();
	}
	else if (e.value=="tree")
	{
		$("#td_modellist").hide();
		$("#td_modeltree").show();
	}
	else if (e.value=="hide")
	{
		$("#td_modellist").hide();
		$("#td_modeltree").hide();
	}
	
}


//从父类选择字段,可以选择只复制部份字段属性
function selectFieldFromParent(obj)
{
	$.getJSON("__APP__/Mcss/ModelMaker/getModel",{modelid:$("#model_base").val()},function(data){
		var h="";
		var fields=data.fields;
		var linecount=0;
		for(var i=0;i<fields.length;i++)
		{
			h+="<input type='checkbox' id='copyfrombase_"+fields[i].id+"' class='base_fields_list' />"+fields[i].name;	
			linecount++;
			if (linecount==1)
			{
				h+="<br />";
				linecount=0;
			}
		}
		h+="<br /><input type='checkbox' id='selectallbasefield'/>全选";	
		h+="<br />复制内容：<input type='radio' name='fieldprop' id='onlycopy_few_field' checked='true' />只复制字段id和name<input type='radio' name='fieldprop' />复制所有字段属性"
		+"<br /><input type='button' id='confirm_importfield' class='formbutton' value='确定' />";
		var popup=mcdom.showPopup(obj,h,null,null,null,500,500);
		$("#selectallbasefield").click(function(){
			$(".base_fields_list").attr("checked",this.checked);
		})
		$("#confirm_importfield").click(function(){
			var fewfield=$("#onlycopy_few_field").attr("checked");
			for(var i=0;i<fields.length;i++)
			{			
				if (!fields[i].id) continue;
				if ($("#copyfrombase_"+fields[i].id).attr("checked")==true){
					if ($("#field_id_"+fields[i].id).length==0){
						addfield(fields[i],null,fewfield);
					}
				}
			}
			$(popup).remove();
		})

	})
}

function selcthistory(e)
{
	var modelid=$(e).val();
	$("#searchmodelid").val($(e).find(":selected").text());
	loadModelFromServer(modelid);

}
function openExpression(obj)
{
	window.open("__APP__/Mcss/ModelMaker/help");	
}

function renameModel()
{
	mcdom.input(rename,$("#model_id").val());
}
function rename(name)
{
	if (!name){
		alert("请输入！");return;
	}
	var modelid=$("#model_id").val();
	if (modelid==name){
		mcdom.minialert("请输入不一样的模型id！");
		return;
	}
	$.post(g_remotehome+"renameModel",
		{modelid:modelid,newid:name},
		function(result){
			if (result=='ok')
			{
				mcdom.minialert("修改成功！");
				$("#model_id").val(name);
				saveOneModel();
				reloadModels();
				
			}
			else
				alert(result);
		}
	);
	return true;

}
</script>