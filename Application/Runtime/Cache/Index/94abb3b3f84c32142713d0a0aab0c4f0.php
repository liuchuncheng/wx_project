<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
	<title>填写信息</title>
	<link rel="stylesheet" href="/Public/Wap/css/xx.css">
	<script src = '/Public/Wap/js/jquery-3.1.1.min.js'></script>
</head>
<body>
	<div class="container">  
	  <form id="contact" action="<?=U('index/index/checklogin')?>" method="post">
	    
	    <h4>员工信息确认</h4>
	    <fieldset>
	      <input placeholder="姓名" type="text" name="name" tabindex="1" required autofocus>
	    </fieldset>
	    <fieldset>
	      <input placeholder="手机号" type="text" name="phone" tabindex="2" required class="tel">
	    </fieldset>
	    <input type="hidden" name="openid" value="<?php echo ($openid); ?>">
	    <fieldset style="margin-top: 30px;">
	      <button name="submit" type="submit" id="contact-submit" data-submit="...Sending">提交</button>
	    </fieldset>
	  </form>

	</div>
</body>
<!-- 表单手机号验证 -->
	<script>
		$("#contact-submit").click(function() {
			var val =$(".tel").val();
			if (val!="") {
				var re=/^1[34578]\d{9}$/;   
				if(!re.test(val)){      
					alert('请输入正确的手机号码。');      
					return false;   
				}
			}
			
		});
	</script>
</html>