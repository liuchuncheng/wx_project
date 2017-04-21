<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport">
	<title>老板管理</title>
	<script src = "/Public/Wap/js/rem.js"></script>
	<link rel="stylesheet" href="/Public/Wap/css/reset.css">
	<script src = '/Public/Wap/js/jquery-3.1.1.min.js'></script>
	<style>
		
		.container .title{
			height: 1.2rem;
			border-bottom: 1px solid #eee;
			line-height: 1.2rem;
			display: flex;
			flex-direction: row;
			justify-content: space-between;
			border-bottom: 1px solid #eee;
		}
		.title li{
			width: 50%;
			text-align: center;
		}
		.my{
			width: 60%;
			margin: 0 auto;
			color: #666;
			font-size: 0.36rem;
		}
		.active{
			color: #13a3ff;
			border-bottom: 2px solid #13a3ff;
		}
		.content{
			padding: 0 15px;
			
		}
		.yuangong li{
			height: 1.2rem;
			border-bottom: 1px solid #eee;
			line-height: 1.2rem;
			display: flex;
			flex-direction: row;
			justify-content: space-between;
		}
		.yuangong .mz{
			color: #666;
			font-size: 0.36rem;
		}
		.yuangong .num{
			color: #13a3ff;
			font-size: 0.32rem;
		}
		.fenxiang{
			display: none;
		}
		.fenxiang li{
			height: 1.2rem;
			border-bottom: 1px solid #eee;
			line-height: 1.2rem;
			display: flex;
			flex-direction: row;
			justify-content: space-between;
		}
		.name{
			display: flex;
			justify-content: center;
		}
		.name img{
			width: 0.8rem;
			height: 0.8rem;
			border-radius: 50%;
			margin-right: 10px;
			margin-top: 0.2rem;
		}
		.name span{
			color: #666;
			font-size: 0.38rem;
		}
		.time{
			color: #666;
			font-size: 0.28rem;
		}
	</style>
</head>
<body>
	<div class="container">
		<ul class="title" id="title">
			<li>
				<div class="my active">我的员工</div>
				
			</li>
			<li>
				<div class="my">我的分享</div>
				
			</li>
		</ul>
		<div class="content">
			<ul class="yuangong">
			<?php foreach($list as $val){ ?>
				<li>
					<span class="mz"><?php echo ($val['name']); ?></span>
					<span class="num">通过TA分享已支付<span><?php echo ($val['num']); ?></span>人</span>
				</li>
			<?php } ?>
			</ul>
			<ul class="fenxiang">
			<?php foreach($meshare as $val){ ?>
				<li>
					<div class="name">
						<img src="<?php echo ($val['header']); ?>" alt="">
						<span><?php echo ($val['nickname']); ?></span>
					</div>
					<div class="time">
						<span><?php echo (date("y/m/d H:i:s",$val['pay_time'])); ?></span>
					</div>
				</li>
			<?php } ?>
			</ul>
		</div>
	</div>
</body>
<script>
	$("#title li").eq(0).click(function() {
		$(this).find('.my').addClass('active');
		$(this).siblings('li').find('.my').removeClass('active');
		$(".yuangong").css({"display":"block"});
		$(".fenxiang").css({"display":"none"});
	});
	$("#title li").eq(1).click(function() {
		$(this).find('.my').addClass('active');
		$(this).siblings('li').find('.my').removeClass('active');
		$(".yuangong").css({"display":"none"});
		$(".fenxiang").css({"display":"block"});
	});
</script>
</html>