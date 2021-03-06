<?php return array(
'id'=>"oa_task_add_moreday",
'title'=>"工作列表",
'tablename'=>"oa_task",
'filter'=>"tag=2 and SYS_ORGID=orgid()",
'pagerows'=>"6",
'actions'=>"add,edit",
'wayofcopyfields'=>"onlycopyprop",
'fields'=>array(
 array('id'=>"id",'name'=>"ID",'isvisible'=>"false",'visibleWhenAdd'=>"false",),
 array('id'=>"cat",'name'=>"工作类别",'length'=>"50",'defaultdata'=>"日报",'isvisible'=>"false",'visibleWhenAdd'=>"false",),
 array('id'=>"todo_index",'name'=>"顺序",'isvisible'=>"false",'visibleWhenAdd'=>"false",),
 array('id'=>"name",'name'=>"主题",'type'=>"textarea",'nullable'=>"false",),
 array('id'=>"priority",'name'=>"重要性",'type'=>"radio",'data'=>"1:高,2:中,3:低",'defaultdata'=>"2",),
 array('id'=>"begindate",'name'=>"开始日期",'type'=>"date",'isvisible'=>"false",),
 array('id'=>"enddate",'name'=>"结束日期",'type'=>"date",'isvisible'=>"false",),
 array('id'=>"finishper",'name'=>"完成状态",'type'=>"radio",'data'=>"0:进行中,1:已完成",'defaultdata'=>"0",),
 array('id'=>"executerid",'name'=>"执行人",'type'=>"dropdown",'data'=>"sql:select id,name from sys_staff where SYS_ORGID=orgid() ",'defaultdata'=>"Me()",'isvisible'=>"false",'visibleWhenAdd'=>"true",),
 array('id'=>"notes",'name'=>"备注",'fieldtype'=>"string",'type'=>"textarea",'isvisible'=>"false",'visibleWhenAdd'=>"false",),
 array('id'=>"tag",'name'=>"标签",'type'=>"dropdown",'data'=>"1:计划概述,2:工作条目,3:总结",'defaultdata'=>"2",'isvisible'=>"false",'visibleWhenAdd'=>"false",),
 array('id'=>"SYS_ADDUSER",'name'=>"创建者",'type'=>"SYS_ADDUSER",'isvisible'=>"false",'visibleWhenAdd'=>"false",),
 array('id'=>"SYS_ADDTIME",'name'=>"创建时间",'fieldtype'=>"datetime",'type'=>"SYS_ADDTIME",'isvisible'=>"false",'visibleWhenAdd'=>"false",'readonly'=>"true",'forsearch'=>"true",),
 array('id'=>"SYS_EDITUSER",'name'=>"更新人",'fieldtype'=>"string",'type'=>"SYS_EDITUSER",'isvisible'=>"false",'visibleWhenAdd'=>"false",'readonly'=>"true",),
 array('id'=>"SYS_EDITTIME",'name'=>"更新时间",'fieldtype'=>"datetime",'type'=>"SYS_EDITTIME",'isvisible'=>"false",'visibleWhenAdd'=>"false",'readonly'=>"true",),
 array('id'=>"SYS_ORGID",'name'=>"组织id",'defaultdata'=>"orgid()",'isvisible'=>"false",'visibleWhenAdd'=>"false",),
),

) ?>