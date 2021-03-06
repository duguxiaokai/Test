<?php return array(
'id'=>"ext_newproject",
'title'=>"项目列表",
'tablename'=>"oa_project",
'openurl'=>"default",
'editurl'=>"default",
'addurl'=>"default",
'pagerows'=>"50",
'actions'=>"add,del,open,edit,search,page",
'fields'=>array(
 array('id'=>"id",'name'=>"ID",'fieldtype'=>"int",'defaultdata'=>"newid()",'isvisible'=>"false",'visibleWhenAdd'=>"false",),
 array('id'=>"code",'name'=>"项目编码",'fieldtype'=>"string",'forsearch'=>"true",),
 array('id'=>"name",'name'=>"项目名称",'fieldtype'=>"string",'forsearch'=>"true",'nullable'=>"false",),
 array('id'=>"content",'name'=>"项目内容",'fieldtype'=>"string",'type'=>"textarea",),
 array('id'=>"sort",'name'=>"分类",'fieldtype'=>"string",),
 array('id'=>"begindate",'name'=>"开始日期",'fieldtype'=>"date",'type'=>"date",'forsearch'=>"true",),
 array('id'=>"enddate",'name'=>"结束日期",'fieldtype'=>"date",'type'=>"date",'forsearch'=>"true",),
 array('id'=>"executer",'name'=>"执行人",'fieldtype'=>"int",'forsearch'=>"true",),
 array('id'=>"status",'name'=>"状态",'fieldtype'=>"string",'length'=>"10",'type'=>"dropdown",'data'=>",plan:计划中,doing:执行中,done:完成,cancel:取消",'forsearch'=>"true",),
 array('id'=>"finishper",'name'=>"完成率",'fieldtype'=>"float",),
 array('id'=>"notes",'name'=>"备注",'fieldtype'=>"string",'type'=>"textarea",'forsearch'=>"true",),
 array('id'=>"remainingdays",'name'=>"剩余天数",'fieldtype'=>"float",'isvisible'=>"false",'visibleWhenAdd'=>"false",),
),
) ?>