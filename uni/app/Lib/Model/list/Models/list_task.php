<?php return array(
'id'=>"list_task",
'title'=>"任务列表",
'tablename'=>"oa_task",
'sql'=>"select a.*,b.email as email from oa_task a left join sys_user b on b.name=a.loginuser",
'openurl'=>"default",
'editurl'=>"default",
'addurl'=>"default",
'filter'=>"loginuser IN (MyDeptStaffs())",
'orderby'=>"id desc",
'open_window_style'=>"samewindow",
'pagerows'=>"10",
'fields'=>array(
 array('id'=>"id",'name'=>"ID",'visibleWhenAdd'=>"false",'readonly'=>"true",),
 array('id'=>"project",'name'=>"所属项目",'type'=>"dropdown",'data'=>",儿童瑜伽,铜道,建研,商城,MCSS,其它",'forsearch'=>"true",),
 array('id'=>"name",'name'=>"工作名称",'length'=>"50",'forsearch'=>"true",),
 array('id'=>"cat",'name'=>"标记",'type'=>"checkboxlist",'data'=>"1:程序,2:美工设计,嵌套,切图,其它,关键工作",'forsearch'=>"true",),
 array('id'=>"begindate",'name'=>"开始日期",'defaultdata'=>"today()",'forsearch'=>"true",),
 array('id'=>"enddate",'name'=>"结束日期",'defaultdata'=>"today()",'forsearch'=>"true",),
 array('id'=>"loginuser",'name'=>"创建人",'type'=>"SYS_ADDUSER",'defaultdata'=>"MyStaffID()",'forsearch'=>"true",),
 array('id'=>"executer",'name'=>"执行人",'type'=>"dropdown",'data'=>",陈亚齐,关松鹤,刘兆菊,谢国恩,钟毅夫,陈坤极,谢国恩&关松鹤",'forsearch'=>"true",),
 array('id'=>"status",'name'=>"状态",'type'=>"dropdown",'data'=>",执行中,完成,取消,",'forsearch'=>"true",),
 array('id'=>"email",'name'=>"Email",'forsearch'=>"true",),
 array('id'=>"notes",'name'=>"备注",'forsearch'=>"true",),
 array('id'=>"SYS_ADDTIME",'name'=>"SYS_ADDTIME",'fieldtype'=>"datetime",'type'=>"SYS_ADDTIME",),
 array('id'=>"SYS_ADDUSER",'name'=>"SYS_ADDUSER",'fieldtype'=>"string",'type'=>"SYS_ADDUSER",),
 array('id'=>"SYS_EDITTIME",'name'=>"SYS_EDITTIME",'fieldtype'=>"datetime",'type'=>"SYS_EDITTIME",),
 array('id'=>"SYS_EDITUSER",'name'=>"SYS_EDITUSER",'fieldtype'=>"string",'type'=>"SYS_EDITUSER",),
)
) ?>