<?php return array(
'id'=>"oa_pm_inputprojectcost",
'title'=>"项目成本输入",
'tablename'=>"oa_pm_inputprojectcost",
'addurl'=>"oa/Project/inputProjectCost",
'filter'=>"SYS_ORGID = orgid()",
'orderby'=>"period",
'groupby'=>"y",
'pagerows'=>"10",
'actions'=>"add,del,edit,tableedit,search,search2,filter,page,groupby",
'cols'=>"2",
'fields'=>array(
 array('id'=>"sortindex",'name'=>"序号",'fieldtype'=>"int",'type'=>"recordindex",'visibleWhenAdd'=>"false",'virtualfield'=>"true",),
 array('id'=>"id",'name'=>"ID",'fieldtype'=>"int",'visibleWhenAdd'=>"false",'prop'=>"PRIMARYKEY;AUTO_INCREMENT",),
 array('id'=>"staffid",'name'=>"执行人",'fieldtype'=>"int",'type'=>"dropdown",'data'=>"sql:select id,name from sys_staff where SYS_ORGID=orgid() order by name",'defaultdata'=>"Me()",'nullable'=>"false",),
 array('id'=>"period",'name'=>"周期",'fieldtype'=>"string",'length'=>"50",'type'=>"dropdown",'data'=>"sql:select id,name from oa_pm_period where type='costinput'",),
 array('id'=>"startdate",'name'=>"开始日期",'fieldtype'=>"date",'readonly'=>"true",'nullable'=>"false",),
 array('id'=>"enddate",'name'=>"结束日期",'fieldtype'=>"date",'readonly'=>"true",'nullable'=>"false",),
 array('id'=>"projectid",'name'=>"项目",'fieldtype'=>"int",'type'=>"dropdown",'data'=>"sql:select id,name from oa_project where SYS_ORGID=orgid() order by SYS_EDITTIME desc",'nullable'=>"false",),
 array('id'=>"hour_notconfirmed",'name'=>"填报工时",'fieldtype'=>"float",'nullable'=>"false",'count'=>"true",),
 array('id'=>"hours",'name'=>"有效工时",'fieldtype'=>"float",),
 array('id'=>"status",'name'=>"状态",'fieldtype'=>"string",'length'=>"10",'type'=>"dropdown",'data'=>"saved:未确认,comfirmed:已确认",'readonly'=>"true",),
 array('id'=>"notes",'name'=>"备注",'fieldtype'=>"string",'length'=>"500",'type'=>"textarea",'readonly'=>"true",),
 array('id'=>"SYS_ADDUSER",'name'=>"创建者",'fieldtype'=>"string",'type'=>"SYS_ADDUSER",'isvisible'=>"false",'visibleWhenAdd'=>"false",'readonly'=>"true",),
 array('id'=>"SYS_ADDTIME",'name'=>"创建时间",'fieldtype'=>"datetime",'type'=>"SYS_ADDTIME",'isvisible'=>"false",'visibleWhenAdd'=>"false",'readonly'=>"true",),
 array('id'=>"SYS_EDITUSER",'name'=>"更新者",'fieldtype'=>"string",'type'=>"SYS_EDITUSER",'visibleWhenAdd'=>"false",'readonly'=>"true",),
 array('id'=>"SYS_EDITTIME",'name'=>"更新时间",'fieldtype'=>"datetime",'type'=>"SYS_EDITTIME",'visibleWhenAdd'=>"false",'readonly'=>"true",),
 array('id'=>"SYS_ORGID",'name'=>"组织ID",'fieldtype'=>"int",'type'=>"SYS_ORGID",'isvisible'=>"false",'visibleWhenAdd'=>"false",'readonly'=>"true",),
),

) ?>