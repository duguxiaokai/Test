<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> <!--dtd协议-->
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>内容查看器</title>

<script src="__PUBLIC__/js/jquery.js" ></script>
<script src="__PUBLIC__/jusaas/js/common.js"></script>
<script src="__PUBLIC__/jusaas/js/autoform.js"></script>
<script >
var form1;
$(document).ready(function() {
	var modelid=common_getParam("modelid");
	var id=common_getParam("id");
 	form1=new Autoform('formdata',{recordid:'url:KEYFIELD',"modelid":modelid}); 
    form1.run(dosome);
});

function dosome()
{
//	moreWidth();
	setTimeout("moreWidth()",500);
}

function moreWidth()
{
	var fieldid=common_getParam("fieldid");	
	var div_id=form1.getRichEditorDivId(fieldid);
	var s=form1.getFieldValue(fieldid);
	$("#"+div_id).find('div').css('width','100%');	
	$("#"+div_id).find('div').eq(0).find('div').eq(0).find("span[data-name='fullscreen']").click();
	$("#formdata").find('table').find('tr').find('td[cellIndex=0]').html('');
	
	$("#loading").hide();
	$("#formdata").show();
}

</script>
</head>
<body>
<span id='loading'>load...</span>
<div id='main'>
	<div id="formdata" style='display:none;'></div>
	
</div>	
</body>
</html>