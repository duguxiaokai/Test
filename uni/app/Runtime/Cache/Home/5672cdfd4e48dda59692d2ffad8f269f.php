<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=8" />
<title>修改登录密码</title>
<link href="__PUBLIC__/themes/default/css/common.css" rel="stylesheet" type="text/css">
<link href="__PUBLIC__/themes/default/css/otherweb.css" rel="stylesheet" type="text/css">
<script src="__PUBLIC__/js/jquery.js" ></script>
<script src="__PUBLIC__/jusaas/js/common.js"></script>
<script src="__PUBLIC__/jusaas/js/autoform.js"></script>
</head>

<body>
<div class="gukeCon">
  <div class="formBox">
	<div id="formdata"></div>
	<div style=" padding:20px 0 10px 200px">
		<input type='button' class='btn btn-green mcssingbutton'  value='保存' onclick='submit()'>
	</div>
</div>

<div id='background' class='background'></div><div id='progressBar' class='progressBar'>数据加载中，请稍等...</div>
</body>
</html>

<script type="text/javascript">

var form1;
$(document).ready(function() {
	form1 = new Autoform('formdata',{"modelid":'sys_login_pwd_noemail','recordid':'url:id'});
	form1.run(dosome);
});

function dosome()
{
	var loginuser=getCookie("mcss_loginuser");
	$("#"+form1.getFieldID('name')).val(loginuser);
	

}

function saveRecord()
{
	form1.save(false);
}

function submit(if_release)
{
	var name    	 = form1.getFieldValue('name');	
	var login_pwd    = form1.getFieldValue('login_pwd');
	var newlogin_pwd = form1.getFieldValue('newlogin_pwd');
	var newlogin_pwd2= form1.getFieldValue('newlogin_pwd2');	
		
		if(login_pwd==''){
			alert('原密码不能为空！');return;
		}
		
		if(newlogin_pwd==''){
			alert('新密码不能为空！');return;
		}
		
		if(newlogin_pwd2==''){
			alert('重复密码不能为空！');return;
		}
		if(newlogin_pwd != newlogin_pwd2) 
		{
			alert('两次输入的密码不一致,请检查后重试!');return;
		}	
		$.post("__APP__/Home/Index/checklogin_pwd",{"name":name,"login_pwd":login_pwd,"newlogin_pwd":newlogin_pwd},function(data)
		{	
			if (data=='0')
			{		
				alert('原密码错误,请检查后重试!');return;
			}		
			if (data=='2')
			{		
				alert('新密码不能与原密码相同,请修改新密码！');return;
			}		
			$.post("__APP__/Home/Index/updatelogin_pwd",{"name":name,"newlogin_pwd":newlogin_pwd},function(data)
			{
				if (data==1){
					alert('修改密码成功!');
					form1.run(dosome);		
				}else
					alert('修改密码失败!');
					form1.run(dosome);
			});			
		}); 	 	
}
</script>