<?php return array(
'id'=>"list_sell",
'title'=>"卖单列表",
'tablename'=>"td_sell",
'openurl'=>"default",
'filter'=>"loginuser=loginuser()",
'open_window_style'=>"popup:middle",
'pagerows'=>"10",
'editintable'=>"false",
'actions'=>"search,search,del",
'fields'=>array(
 array('id'=>"id",'name'=>"ID",'isvisible'=>"false",'visibleWhenAdd'=>"false",),
 array('id'=>"code",'name'=>"订单号",),
 array('id'=>"release_time",'name'=>"发布时间",'type'=>"date",'defaultdata'=>"today()",'readonly'=>"true",),
 array('id'=>"release_time",'name'=>"发布时间",'type'=>"date",'defaultdata'=>"today()",'readonly'=>"true",),
 array('id'=>"productid",'name'=>"产品名称",'type'=>"dropdown",'data'=>"sql:select id,name from td_product",'forsearch'=>"true",),
 array('id'=>"amount",'name'=>"持仓量",),
 array('id'=>"leastamount",'name'=>"起订量",'forsearch'=>"true",),
 array('id'=>"price",'name'=>"挂牌价",'fieldtype'=>"float",'forsearch'=>"true",),
 array('id'=>"address",'name'=>"原产地",'forsearch'=>"true",),
 array('id'=>"jiaohuoaddress",'name'=>"交货地",'defaultdata'=>" 广东",),
 array('id'=>"packing",'name'=>"包装说明",),
 array('id'=>"standard",'name'=>"执行标准",),
 array('id'=>"buymethod",'name'=>"购买方式",'type'=>"radio",'data'=>"0:全款,1:贷款",'defaultdata'=>"全款",),
 array('id'=>"status",'name'=>"状态",'type'=>"dropdown",'data'=>"0:新增,1:已发布,2:撮合中,3:自动撮合,4:已过期,5:已撤销,6:已成交",'readonly'=>"true",'forsearch'=>"true",),
)
) ?>