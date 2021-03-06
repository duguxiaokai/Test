<?php return array(
'id'=>"oa_project_public",
'title'=>"公开项目",
'base'=>"oa_project_my",
'openurl'=>"Project/projectdetail/showcopy/true",
'filter'=>"tag like '%public%' and SYS_ADDUSER<>''",
'actions'=>"search,page,",
'wayofcopyfields'=>"onlycopyprop",
'more'=>"[PUBLIC]",
'fields'=>array(
 array('id'=>"id",'name'=>"ID",),
 array('id'=>"name",'name'=>"项目名称",),
 array('id'=>"content",'name'=>"项目概述",),
 array('id'=>"begindate",'name'=>"开始日期",),
 array('id'=>"enddate",'name'=>"结束日期",),
 array('id'=>"executer",'name'=>"负责人",),
 array('id'=>"status",'name'=>"状态",),
 array('id'=>"SYS_ADDUSER",'name'=>"创建者",),
 array('id'=>"SYS_ADDTIME",'name'=>"创建日期",),
 array('id'=>"SYS_ORGID",'name'=>"组织ID",),
),

) ?>