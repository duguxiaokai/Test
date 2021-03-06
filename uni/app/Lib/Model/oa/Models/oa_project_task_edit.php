<?php return array(
'id'=>"oa_project_task_edit",
'title'=>"项目任务编辑",
'base'=>"oa_project_task",
'tablename'=>"oa_task",
'openurl'=>"Oa/Project/addTask/pagetype/view/modelid/oa_project_task_edit",
'editurl'=>"Oa/Project/addTask/pagetype/edit/modelid/oa_project_task_edit",
'addurl'=>"Oa/Project/addTask/pagetype/add/modelid/oa_project_task_edit",
'fields'=>array(
 array('id'=>"id",'name'=>"ID",'fieldtype'=>"int",'isvisible'=>"false",'visibleWhenAdd'=>"false",),
 array('id'=>"projectid",'name'=>"项目",'fieldtype'=>"string",'type'=>"dropdown",'data'=>"sql:select id,name from oa_project",'isvisible'=>"false",'visibleWhenAdd'=>"false",),
 array('id'=>"tasktype",'name'=>"工作类别",'fieldtype'=>"string",'type'=>"dropdown",'data'=>"sql:select id,name from sys_item where SYS_ORGID=orgid() and type = 'pm_tasktype'",'forsearch'=>"true",),
 array('id'=>"name",'name'=>"任务名称",'fieldtype'=>"string",'forsearch'=>"true",'nullable'=>"false",'style'=>"width:200px",'prop'=>"OPENRECORD",),
 array('id'=>"begindate",'name'=>"开始日期",'fieldtype'=>"date",'type'=>"date",'forsearch'=>"true",'style'=>"width:85px",),
 array('id'=>"enddate",'name'=>"结束日期",'fieldtype'=>"date",'type'=>"date",'style'=>"width:85px",),
 array('id'=>"executerid",'name'=>"执行人",'fieldtype'=>"string",'isvisible'=>"false",'visibleWhenAdd'=>"false",'style'=>"width:50px",),
 array('id'=>"finishper",'name'=>"完成率",'type'=>"dropdown",'data'=>"0:0%,0.1:10%,0.2:20%,0.3:30%,0.4:40%,0.5:50%,0.6:60%,0.7:70%,0.8:80%,0.85:85%,0.9:90%,0.95:95%,1:100%",),
 array('id'=>"status",'name'=>"状态",'type'=>"dropdown",'data'=>"plan:计划,doing:执行,done:完成,better:优化,checked:验收,cancel:取消",),
 array('id'=>"executer",'name'=>"执行人",'fieldtype'=>"string",'type'=>"popupselectone",'data'=>"model:oa_pm_staffcostsetting(staffid:executerid,staffname:executer,cost:price,unit:unitname)",'readonly'=>"true",'style'=>"width:50px",),
 array('id'=>"amount",'name'=>"任务量",'fieldtype'=>"real",),
 array('id'=>"unitname",'name'=>"任务量单位",'isvisible'=>"false",),
 array('id'=>"price",'name'=>"单位成本",'fieldtype'=>"float",'isvisible'=>"false",),
 array('id'=>"totalprice",'name'=>"费用",'fieldtype'=>"float",'isvisible'=>"false",),
 array('id'=>"worktime",'name'=>"工时",),
 array('id'=>"detail",'name'=>"任务描述",'fieldtype'=>"string",'type'=>"richeditor",'isvisible'=>"false",'visibleWhenAdd'=>"true",),
 array('id'=>"attach",'name'=>"附件",'type'=>"file",'isvisible'=>"false",'visibleWhenAdd'=>"false",),
 array('id'=>"cat",'name'=>"任务记录类别",'defaultdata'=>"项目",'isvisible'=>"false",'visibleWhenAdd'=>"false",),
 array('id'=>"SYS_EDITTIME",'name'=>"更新时间",'fieldtype'=>"datetime",'type'=>"SYS_EDITTIME",'isvisible'=>"false",'visibleWhenAdd'=>"false",'readonly'=>"true",),
 array('id'=>"SYS_ORGID",'name'=>"组织ID",'fieldtype'=>"int",'type'=>"SYS_ORGID",'isvisible'=>"false",'visibleWhenAdd'=>"false",'readonly'=>"true",),
 array('id'=>"SYS_ADDUSER",'name'=>"创建人",'type'=>"SYS_ADDUSER",'isvisible'=>"false",'visibleWhenAdd'=>"false",'readonly'=>"true",),
 array('id'=>"SYS_ADDTIME",'name'=>"创建时间",'fieldtype'=>"datetime",'type'=>"SYS_ADDTIME",'isvisible'=>"false",'visibleWhenAdd'=>"false",'readonly'=>"true",),
 array('id'=>"SYS_EDITUSER",'name'=>"更新人",'type'=>"SYS_EDITUSER",'isvisible'=>"false",'visibleWhenAdd'=>"false",'readonly'=>"true",),
),

) ?>