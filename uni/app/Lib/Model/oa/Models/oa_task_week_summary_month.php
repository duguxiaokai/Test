<?php return array(
'id'=>"oa_task_week_summary_month",
'title'=>"本月周报",
'tablename'=>"oa_task",
'fields'=>array(
 array('id'=>"id",'name'=>"ID",'isvisible'=>"false",'visibleWhenAdd'=>"false",'width'=>"300px",),
 array('id'=>"cat",'name'=>"工作类别",'length'=>"50",'defaultdata'=>"周报",'isvisible'=>"false",'visibleWhenAdd'=>"false",),
 array('id'=>"begindate",'name'=>"开始时间",'isvisible'=>"false",'visibleWhenAdd'=>"true",),
 array('id'=>"enddate",'name'=>"结束时间",'isvisible'=>"false",'visibleWhenAdd'=>"true",),
 array('id'=>"executerid",'name'=>"执行人",'type'=>"dropdown",'data'=>"sql:select id,name from sys_staff where SYS_ORGID=orgid()",'defaultdata'=>"Me()",'isvisible'=>"false",'visibleWhenAdd'=>"false",'width'=>"300px",),
 array('id'=>"name",'name'=>"总结",'width'=>"350px",'height'=>"100px",),
 array('id'=>"notes",'name'=>"主管评价",'type'=>"textarea",'isvisible'=>"false",'visibleWhenAdd'=>"false",'width'=>"350px",'height'=>"100px",),
 array('id'=>"tag",'name'=>"标签",'type'=>"dropdown",'data'=>"1:计划概述,2:工作条目,3:总结",'defaultdata'=>"3",'isvisible'=>"false",'visibleWhenAdd'=>"false",'width'=>"300px",),
 array('id'=>"SYS_ADDUSER",'name'=>"创建者",'type'=>"SYS_ADDUSER",'isvisible'=>"false",'visibleWhenAdd'=>"false",'width'=>"300px",),
 array('id'=>"SYS_ADDTIME",'name'=>"创建时间",'fieldtype'=>"datetime",'type'=>"SYS_ADDTIME",'isvisible'=>"false",'visibleWhenAdd'=>"false",'readonly'=>"true",'forsearch'=>"true",'width'=>"300px",),
 array('id'=>"SYS_EDITUSER",'name'=>"更新人",'fieldtype'=>"string",'type'=>"SYS_EDITUSER",'isvisible'=>"false",'visibleWhenAdd'=>"false",'readonly'=>"true",'width'=>"300px",),
 array('id'=>"SYS_EDITTIME",'name'=>"更新时间",'fieldtype'=>"datetime",'type'=>"SYS_EDITTIME",'isvisible'=>"false",'visibleWhenAdd'=>"false",'readonly'=>"true",'width'=>"300px",),
 array('id'=>"SYS_ORGID",'name'=>"组织id",'defaultdata'=>"orgid()",'isvisible'=>"false",'visibleWhenAdd'=>"false",),
),

) ?>