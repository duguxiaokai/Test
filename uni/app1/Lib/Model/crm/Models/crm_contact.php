<?php return array(
'id'=>"crm_contact",
'title'=>"客户联系人",
'tablename'=>"crm_contact",
'orderby'=>"custname",
'groupby'=>"y",
'actions'=>"tableedit,search,search2,page",
'fields'=>array(
 array('id'=>"id",'name'=>"ID",'fieldtype'=>"int",),
 array('id'=>"custname",'name'=>"客户名称",'fieldtype'=>"string",'length'=>"50",),
 array('id'=>"name",'name'=>"姓名",'fieldtype'=>"string",'length'=>"50",'forsearch'=>"true",),
 array('id'=>"gender",'name'=>"性别",'fieldtype'=>"string",'length'=>"1",'type'=>"dropdown",'data'=>",F:女,M:男",'forsearch'=>"true",),
 array('id'=>"email",'name'=>"邮箱",'fieldtype'=>"string",'length'=>"255",'forsearch'=>"true",),
 array('id'=>"mobile",'name'=>"主手机号",'fieldtype'=>"string",'length'=>"15",'forsearch'=>"true",),
 array('id'=>"othercontact",'name'=>"其它电话",'fieldtype'=>"string",'length'=>"100",'forsearch'=>"true",),
 array('id'=>"qq",'name'=>"QQ",'fieldtype'=>"int",'length'=>"15",'forsearch'=>"true",),
 array('id'=>"rank",'name'=>"亲密值",'fieldtype'=>"int",),
 array('id'=>"notes",'name'=>"备注",'fieldtype'=>"string",'length'=>"500",'forsearch'=>"true",),
 array('id'=>"custid",'name'=>"所属客户ID",'fieldtype'=>"int",'forsearch'=>"true",),
 array('id'=>"lastmaildate",'name'=>"上次联系日期",'fieldtype'=>"date",),
 array('id'=>"SYS_ADDUSER",'name'=>"创建者",'fieldtype'=>"string",'type'=>"SYS_ADDUSER",'isvisible'=>"false",'readonly'=>"true",),
 array('id'=>"SYS_ADDTIME",'name'=>"创建时间",'fieldtype'=>"datetime",'type'=>"SYS_ADDTIME",'isvisible'=>"false",'readonly'=>"true",),
 array('id'=>"SYS_EDITUSER",'name'=>"更新者",'fieldtype'=>"string",'type'=>"SYS_EDITUSER",'isvisible'=>"false",'readonly'=>"true",),
 array('id'=>"SYS_EDITIME",'name'=>"更新时间",'fieldtype'=>"datetime",'type'=>"datetime",'readonly'=>"true",),
 array('id'=>"SYS_ORGID",'name'=>"组织ID",'fieldtype'=>"int",'type'=>"SYS_ORGID",'isvisible'=>"false",'readonly'=>"true",),
),

) ?>