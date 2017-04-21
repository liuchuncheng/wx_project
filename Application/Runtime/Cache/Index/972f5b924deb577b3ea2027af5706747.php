<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport">
	<title>员工销售管理</title>
	<script src = "/Public/Wap/js/rem.js"></script>
	<link rel="stylesheet" href="/Public/Wap/css/reset.css">
	<style>
		.container{
			padding: 10px;
		}
		.container li{
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
		<ul>
		<?php foreach($list as $val){ ?>
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
</body>
</html>