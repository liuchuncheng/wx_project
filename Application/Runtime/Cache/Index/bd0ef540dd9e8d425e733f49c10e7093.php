<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport">
	<title>我的电子券</title>
	<script src = "/Public/Wap/js/rem.js"></script>
	<link rel="stylesheet" href="/Public/Wap/css/reset.css">
	<script src = "/Public/Wap/js/jquery-3.1.1.min.js"></script>
	<style>
		.container1{
			padding: 10px;
		}
		.container1 li{
			border-bottom: 1px solid #eee;
			padding: 10px 0;
		}
		.container1 li .big{
			display: flex;
			flex-direction: row;
			justify-content: space-between;
		}
		.info1{
			height: 1.5rem;
			display: flex;
			justify-content: flex-start;
		}
		.info1 img{
			width: 2rem;
		}
		.info1 .text{
			margin-left: 0.2rem;
			display: flex;
			flex-direction: column;
			justify-content: center;
		}
		.info1 h3{
			font-size: 0.36rem;
			color: #333;
			margin-bottom: 0.2rem;
		}
		.info1 span{
			font-size: 0.28rem;
			color: #666;
		}
		.btn{
			width: 2rem;
			height: 0.8rem;
			border-radius: 0.1rem;
			line-height: 0.8rem;
			text-align: center;
			color: #fff;
			font-size: 0.36rem;
		}
		.btn-used{
			background-color: #888;
		}
		.btn-unuse{
			background-color: #13a3ff;
		}

		.footer{
			width: 100%;
			height: 0.8rem;
			padding-top: 5px;
			padding-bottom: 5px;
			position: fixed;
			bottom: 0;
			left: 0;
			border-top: 1px solid #dedede;
			background-color: #fff;
		}
		.footer ul{
			width: 100%;
			height: 100%;
			display: flex;
			align-content: space-between;
		}
		.footer li{
			width: 50%;
			display: flex;
			justify-content: center;
			
		}
		.footer li.line1{
			padding-top: 5px;
			width: 1px;
			height: 0.68rem;
			background-color: #dedede;

		}
		.footer a{
			text-align: center;
			display: block;
			font-size: 0.28rem;
			color: #666;
		}
		.footer .active a{
			color: #fd433d;
		}
		.footer i{
			display: inline-block;
			width: 0.44rem;
			height: 0.44rem;
			background-size: 100% 100%;
		}
		.footer .sc i{
			background-image: url(images/shop1.png);
		}
		
		
		.footer .user.active i{
			background-image: url(images/juan2.png);
		}
	</style>
</head>
<body>
	<div class="container1">
		<ul>
		<?php foreach($list as $val){ ?>
			<li>
				<a href="" class="big">
					<div class="info1">
						<img src="/<?php echo ($val['img']); ?>" alt="">
						<div class="text">
							<h3><?php echo ($val['name']); ?></h3>
							
							<span><?php echo ($val['shopname']); ?></span>
						</div>
						
					</div>
					<div style="display: flex;flex-direction: column;justify-content: center;">
						<?php if($val['is_use'] ==1){ ?> <div class="btn btn-unuse">立即使用</div><?php }else{ ?><div class="btn btn-used">已使用</div><?php } ?>
					</div>
					
				</a>
			</li>
		<?php } ?>
		</ul>
	</div>
	<div class="footer">
		<ul>
			<li class="sc">
				<a href="index.html">
					<i></i>
					<br>
					<span>电子卷商城</span>
				</a>
			</li>
			<li class="line1"></li>
			<li class="user active">
				<a href="">
					<i></i>
					<br>
					<span>我的电子券</span>
				</a>
			</li>
		</ul>
	</div>
</body>
<script>
	$(".btn").click(function() {
		window.location.href='dianzijuan.html';
	});
</script>
</html>