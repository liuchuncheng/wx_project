<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport">
	<title>电子券</title>
	<script src = "/Public/Wap/js/rem.js"></script>
	<script src = "/Public/Wap/js/jquery.min.js"></script>
	<script src = "/Public/Wap/js/jquery.qrcode.min.js"></script>
	<script src = "/Public/Wap/js/JsBarcode.all.js"></script>
	<link rel="stylesheet" href="/Public/Wap/css/reset.css">
	<style>
		body{
			background-color: #13a3ff;
		}
		.container{
			width: 100%;
			height: 100%;
			
			padding: 10px 0px 30px;
		}
		.box{
			width: 90%;
			margin: 0 auto;
			height: 100%;
			border-radius: 0.1rem;
			background-color: #fff;
		}
		.title{
			padding-top: 60px;
			text-align: center;
		}
		.title h6{
			color: #666;
			font-size: 0.28rem;
			margin-bottom: 20px;
		}
		.title h3{
			color: #333;
			font-size: 0.46rem;
		}
		.line2{
			display: flex;
			justify-content: space-between;
			margin-top: 20px;
			margin-bottom: 30px;
		}
		.left-cil,.right-cil{
			width: 30px;
			height: 30px;
			border-radius: 50%;
			background-color: #13a3ff;
		}
		.left-cil{
			margin-left: -15px;
		}
		.right-cil{
			margin-right: -15px;
		}
		.dashed{
			width: 90%;
			height: 0px;
			border: 1px dashed #eee;
			margin-top: 15px;
		}
		.erweima,.tiaoxingma,.shuma{
			text-align: center;
			margin-bottom: 30px;
		}
		.erweima img{
			width: 4rem;
			height: 4rem;
		}
		.tiaoxingma img{
			width: 5rem;
			height: 1.5rem;
		}
		.shuma{
			font-size: 0.36rem;
			color: #333;
			margin-bottom: 50px;
		}
	</style>
</head>
<body>
	<div class="container">
		<div class="box">
			<div class="title">
				<h6>店铺名称</h6>
				<h3>200元电子券</h3>
			</div>
			<div class="line2">
				<div class="left-cil"></div>
				<div class="dashed"></div>
				<div class="right-cil"></div>
			</div>
			<div class="erweima">
			</div>
			<div class="tiaoxingma">
				<img id="bcode" src="images/" alt="">
			</div>
			<div class="shuma"><?php echo ($thridsqo); ?></div>
		</div>
	</div>
	<input type="hidden" id="third" value="<?php echo ($thridsqo); ?>">
	<script>
var thridsqo = $("#third").val();
jQuery(function(){
	jQuery('.erweima').qrcode(thridsqo);
})
$("#bcode").JsBarcode(thridsqo);
</script>
</body>
</html>