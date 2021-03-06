<?php return array(
'id'=>"oa_task_to_project",
'title'=>"任务列表(按项目)",
'tablename'=>"oa_task",
'openurl'=>"default",
'filter'=>"SYS_ORGID=orgid()",
'actions'=>"add,del,open,edit,search,search2,page",
'fields'=>array(
 array('id'=>"id",'name'=>"ID",'fieldtype'=>"int",'isvisible'=>"false",'visibleWhenAdd'=>"false",),
 array('id'=>"projectid",'name'=>"项目",'fieldtype'=>"string",'type'=>"dropdown",'data'=>"sql:select id,name from oa_project",),
 array('id'=>"name",'name'=>"任务名称",'fieldtype'=>"string",'forsearch'=>"true",),
 array('id'=>"tasktype",'name'=>"工作类别",'fieldtype'=>"string",'type'=>"dropdown",'forsearch'=>"true",),
 array('id'=>"begindate",'name'=>"开始日期",'fieldtype'=>"date",'type'=>"date",'forsearch'=>"true",),
 array('id'=>"enddate",'name'=>"结束日期",'fieldtype'=>"date",'type'=>"date",),
 array('id'=>"detail",'name'=>"任务描述",'fieldtype'=>"string",'type'=>"textarea",),
 array('id'=>"executerid",'name'=>"执行人",'fieldtype'=>"string",'type'=>"dropdown",'data'=>"sql:select id,name from sys_staff",'defaultdata'=>"Me()",),
 array('id'=>"status",'name'=>"状态",'fieldtype'=>"string",'type'=>"dropdown",'data'=>"plan:计划,doing:执行,done:完成,better:优化,checked:验收,cancel:取消",),
 array('id'=>"percent",'name'=>"完成状态",'fieldtype'=>"string",'type'=>"radio",'data'=>"0:进行中,1:已完成",'defaultdata'=>"0",),
 array('id'=>"notes",'name'=>"备注",'fieldtype'=>"string",),
 array('id'=>"custid",'name'=>"相关客户ID",'fieldtype'=>"int",'isvisible'=>"false",'visibleWhenAdd'=>"false",),
 array('id'=>"SYS_ORGID",'name'=>"组织ID",'fieldtype'=>"int",'type'=>"SYS_ORGID",'isvisible'=>"false",'visibleWhenAdd'=>"false",'readonly'=>"true",),
),

) ?>