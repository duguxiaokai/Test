<?php return array(
'id'=>"oa_project_invoice_my",
'title'=>"我的项目发票记录",
'base'=>"oa_project_invoice",
'tablename'=>"oa_project_invoice",
'addurl'=>"Oa/Project/addcustomer/type/add/sign/apply",
'filter'=>"SYS_EDITUSER=loginuser()",
'orderby'=>"SYS_EDITTIME desc",
'actions'=>"add,open,search,search2,page",
'wayofcopyfields'=>"parent_and_child",
'fields'=>array(
 array('id'=>"id",'name'=>"ID",'fieldtype'=>"int",'isvisible'=>"false",'visibleWhenAdd'=>"false",'prop'=>"PRIMARYKEY;AUTO_INCREMENT",),
 array('id'=>"custid",'name'=>"客户ID",'fieldtype'=>"string",'isvisible'=>"false",'visibleWhenAdd'=>"false",'nullable'=>"false",),
 array('id'=>"cusname",'name'=>"客户名称",'fieldtype'=>"string",'type'=>"popupselectone",'data'=>"model:biz_selectcusomer(no:custid,name:title,name:cusname)",'forsearch'=>"true",),
 array('id'=>"title",'name'=>"发票台头",'fieldtype'=>"string",'type'=>"text",'forsearch'=>"true",'nullable'=>"false",),
 array('id'=>"contact_code",'name'=>"合同号",'fieldtype'=>"string",'type'=>"smartselect",'data'=>"sql:SELECT id,code FROM `biz_contract` where SYS_ORGID=orgid()",'forsearch'=>"true",),
 array('id'=>"order_code",'name'=>"订单号",'fieldtype'=>"string",'type'=>"popupselectone",'data'=>"model:biz_order_list",'forsearch'=>"true",),
 array('id'=>"project_code",'name'=>"项目号",'fieldtype'=>"string",'type'=>"popupselectone",'data'=>"model:oa_project_copy",'forsearch'=>"true",),
 array('id'=>"applier",'name'=>"发票申请人",'fieldtype'=>"string",'type'=>"text",'defaultdata'=>"loginusername()",'readonly'=>"true",'forsearch'=>"true",),
 array('id'=>"code",'name'=>"发票代码",'fieldtype'=>"string",'type'=>"text",),
 array('id'=>"order_momey",'name'=>"订单总额",'fieldtype'=>"real",'count'=>"true",),
 array('id'=>"invoice_money",'name'=>"开票金额",'fieldtype'=>"float",'type'=>"text",'forsearch'=>"true",'count'=>"true",),
 array('id'=>"got_money",'name'=>"到帐金额",'fieldtype'=>"float",'type'=>"text",'count'=>"true",),
 array('id'=>"gotmoney_date",'name'=>"到帐日期",'fieldtype'=>"datetime",'type'=>"datetime",'defaultdata'=>"today()",),
 array('id'=>"currency",'name'=>"币种",'fieldtype'=>"string",'type'=>"radio",'data'=>"RMB,USD",'defaultdata'=>"RMB",),
 array('id'=>"creator",'name'=>"开票人",'fieldtype'=>"string",'type'=>"text",'defaultdata'=>"loginusername()",'isvisible'=>"false",'visibleWhenAdd'=>"false",'readonly'=>"true",'forsearch'=>"true",),
 array('id'=>"cost_item",'name'=>"开票项目",'fieldtype'=>"string",'type'=>"dropdown",'data'=>"option:biz_invoice_makeinvo",'defaultdata'=>"0",),
 array('id'=>"status",'name'=>"状态",'fieldtype'=>"string",'type'=>"dropdown",'data'=>"apply:申请,done:已开票,return:退回",),
 array('id'=>"create_date",'name'=>"开票日期",'fieldtype'=>"datetime",'type'=>"datetime",'defaultdata'=>"now()",),
 array('id'=>"SYS_EDITUSER",'name'=>"更新者",'fieldtype'=>"string",'type'=>"SYS_EDITUSER",'isvisible'=>"false",'visibleWhenAdd'=>"false",'readonly'=>"true",),
 array('id'=>"SYS_EDITTIME",'name'=>"更新时间",'fieldtype'=>"datetime",'type'=>"SYS_EDITTIME",'isvisible'=>"false",'visibleWhenAdd'=>"false",'readonly'=>"true",),
 array('id'=>"SYS_ADDUSER",'name'=>"创建者",'fieldtype'=>"string",'type'=>"SYS_ADDUSER",'isvisible'=>"false",'visibleWhenAdd'=>"false",'readonly'=>"true",),
 array('id'=>"SYS_ADDTIME",'name'=>"创建时间",'fieldtype'=>"datetime",'type'=>"SYS_ADDTIME",'defaultdata'=>"now()",'isvisible'=>"false",'visibleWhenAdd'=>"false",'readonly'=>"true",),
 array('id'=>"SYS_ORGID",'name'=>"组织ID",'fieldtype'=>"int",'type'=>"SYS_ORGID",'isvisible'=>"false",'visibleWhenAdd'=>"false",'readonly'=>"true",),
),

) ?>