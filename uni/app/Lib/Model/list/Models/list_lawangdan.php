<?php return array(
'id'=>"list_lawangdan",
'title'=>"客户列表",
'tablename'=>"crm_customer",
'openurl'=>"CRM/Customer/showonecustomer",
'editurl'=>"CRM/Customer/editcustomer",
'addurl'=>"CRM/Customer/newcustomer",
'pagerows'=>"10",
'keyfield'=>"id",
'cols'=>"2",
'fields'=>array(
 array('id'=>"id",'name'=>"ID",'isvisible'=>"true",'visibleWhenAdd'=>"false",),
 array('id'=>"no",'name'=>"用户号",'forsearch'=>"true",'nullable'=>"false",'style'=>"text-align:center",),
 array('id'=>"name",'name'=>"单位名称",'forsearch'=>"true",),
 array('id'=>"contacts",'name'=>"联系人",'forsearch'=>"true",'style'=>"text-align:center",),
 array('id'=>"phone",'name'=>"手机",'forsearch'=>"true",'style'=>"text-align:center",),
 array('id'=>"email",'name'=>"邮箱",'forsearch'=>"true",'style'=>"text-align:center",),
 array('id'=>"lockuser",'name'=>"申请单位",'type'=>"popupselectone",'data'=>"model:crm_selectagent",'forsearch'=>"true",'nullable'=>"false",'style'=>"text-align:center",),
 array('id'=>"agent",'name'=>"销售机构",'forsearch'=>"true",'style'=>"text-align:center",),
 array('id'=>"district",'name'=>"所属区域",'forsearch'=>"true",'style'=>"text-align:center",),
 array('id'=>"address",'name'=>"地址",'forsearch'=>"true",),
 array('id'=>"post",'name'=>"邮编",'forsearch'=>"true",'style'=>"text-align:center",),
 array('id'=>"tel",'name'=>"电话",'forsearch'=>"true",),
 array('id'=>"lockdate",'name'=>"时间",'fieldtype'=>"date",'defaultdata'=>"today()",'isvisible'=>"false",),
),

) ?>