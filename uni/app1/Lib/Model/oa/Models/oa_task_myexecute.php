<?php return array(
'id'=>"oa_task_myexecute",
'title'=>"我的任务",
'base'=>"oa_project_task",
'filter'=>"status!='plan' and executerid = Me()",
'groupby'=>"n",
'pagerows'=>"10",
'actions'=>"open,search,page",
'wayofcopyfields'=>"parent_and_child",
'fields'=>array(
 array('id'=>"id",'name'=>"ID",'readonly'=>"true",),
 array('id'=>"projectid",'name'=>"项目",'isvisible'=>"true",'visibleWhenAdd'=>"true",'readonly'=>"true",),
 array('id'=>"tasktype",'name'=>"工作类别",'readonly'=>"true",),
 array('id'=>"name",'name'=>"任务名称",'readonly'=>"true",),
 array('id'=>"worktime",'name'=>"工时",'readonly'=>"true",),
 array('id'=>"begindate",'name'=>"开始日期",'readonly'=>"true",),
 array('id'=>"enddate",'name'=>"结束日期",'readonly'=>"true",),
 array('id'=>"executerid",'name'=>"执行人",'readonly'=>"true",),
 array('id'=>"finishper",'name'=>"完成率",),
 array('id'=>"status",'name'=>"状态",'data'=>"plan:计划,doing:执行,done:完成,better:优化,checked:验收,cancel:取消",),
 array('id'=>"executer",'name'=>"执行人",'readonly'=>"true",),
 array('id'=>"price",'name'=>"单价",'readonly'=>"true",),
 array('id'=>"totalprice",'name'=>"总价",'readonly'=>"true",),
 array('id'=>"detail",'name'=>"任务描述",'readonly'=>"true",),
 array('id'=>"attach",'name'=>"附件",'readonly'=>"true",),
),

) ?>