<?php return array(
'id'=>"oa_project_report",
'title'=>"项目周报",
'tablename'=>"oa_project_report",
'openurl'=>"Oa/Project/viewProjectReport",
'editurl'=>"Oa/Project/addProjectReport",
'addurl'=>"Oa/Project/addProjectReport",
'open_window_style'=>"popup:large",
'actions'=>"add,del,open,edit,refresh,search,page",
'cols'=>"2",
'fields'=>array(
 array('id'=>"id",'name'=>"ID",'fieldtype'=>"int",'isvisible'=>"false",'visibleWhenAdd'=>"false",'prop'=>"PRIMARYKEY;AUTO_INCREMENT",),
 array('id'=>"projectid",'name'=>"项目",'fieldtype'=>"int",'type'=>"smartselect",'data'=>"sql:select id,name from oa_project",'isvisible'=>"false",'visibleWhenAdd'=>"true",'forsearch'=>"true",'nullable'=>"false",),
 array('id'=>"periodid",'name'=>"周次",'fieldtype'=>"int",'type'=>"dropdown",'data'=>"sql:select id,name from oa_pm_period where type='costinput' order by id desc ",'isvisible'=>"false",'nullable'=>"false",),
 array('id'=>"periodname",'name'=>"周次",'visibleWhenAdd'=>"false",),
 array('id'=>"manager",'name'=>"项目经理",'fieldtype'=>"string",'type'=>"smartselect",'data'=>"sql:select id,name from sys_staff where  (statue=1 or statue='') and  SYS_ORGID=orgid()",'forsearch'=>"true",),
 array('id'=>"begindate",'name'=>"开始日期",'fieldtype'=>"date",'type'=>"date",'isvisible'=>"false",),
 array('id'=>"enddate",'name'=>"结束日期",'fieldtype'=>"date",'type'=>"date",'isvisible'=>"false",),
 array('id'=>"finishper",'name'=>"完成进度",'fieldtype'=>"string",),
 array('id'=>"projectenddate",'name'=>"预计结束日期",'fieldtype'=>"date",'type'=>"date",),
 array('id'=>"summary",'name'=>"本周概述",'fieldtype'=>"string",'type'=>"textarea",'isvisible'=>"false",),
 array('id'=>"SYS_ORGID",'name'=>"组织ID",'fieldtype'=>"int",'type'=>"SYS_ORGID",'isvisible'=>"false",'visibleWhenAdd'=>"false",'readonly'=>"true",),
 array('id'=>"SYS_ADDUSER",'name'=>"创建者",'fieldtype'=>"string",'type'=>"SYS_ADDUSER",'isvisible'=>"false",'visibleWhenAdd'=>"false",'readonly'=>"true",),
 array('id'=>"SYS_ADDTIME",'name'=>"创建时间",'fieldtype'=>"datetime",'type'=>"SYS_ADDTIME",'isvisible'=>"false",'visibleWhenAdd'=>"false",'readonly'=>"true",),
 array('id'=>"SYS_EDITUSER",'name'=>"更新者",'fieldtype'=>"string",'type'=>"SYS_EDITUSER",'isvisible'=>"false",'visibleWhenAdd'=>"false",'readonly'=>"true",),
 array('id'=>"SYS_EDITTIME",'name'=>"更新时间",'fieldtype'=>"datetime",'type'=>"SYS_EDITTIME",'isvisible'=>"false",'visibleWhenAdd'=>"false",'readonly'=>"true",),
),

) ?>