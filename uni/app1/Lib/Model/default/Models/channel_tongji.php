<?php return array (
  'title' => '渠道统计',
   'samewindow' => 'true',
   'fields' => 
  array (
    0 => 
    array (
      'id' => 'category',
      'name' => '统计类别',
      'forsearch' => 'true',
    ),
    1 => 
    array (
      'id' => 'year',
      'name' => '时间段',
      'forsearch' => 'true',
    ),
    2 => 
    array (
      'id' => 'addtime',
      'name' => '统计时间点',
      'forsearch' => 'true',
    ),
    3 => 
    array (
      'id' => 'owner',
      'name' => '统计者',
      'forsearch' => 'true',
    ),
  ),
  'tablename' => 'crm_historydata',
  'openurl' => 'CRM/Tongji/openchannel_tongji',
  'addurl' => 'CRM/Tongji/newchannel_tongji',
  'editurl' => '',
  'filter' => ' category=\'全国销售额的统计-渠道\' or category=\'全国销售额的统计-渠道-直销\' or category=\'代理商业绩统计\'',
  'pagerows' => '10',
  'search' => 'true',
  "actions"=>"add,search,search2,del,open",
) ?>