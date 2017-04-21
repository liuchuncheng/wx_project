<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport">
	<title>首页</title>
	<script src = "/Public/Wap/js/rem.js"></script>
	<link rel="stylesheet" href="/Public/Wap/css/reset.css">
	<link rel="stylesheet" href="/Public/Wap/css/index.css">
</head>
<body>
	<div class="container">
		<div class="banner">
			<img src="/<?php echo ($banner['img']); ?>" alt="">
		</div>
		<div class="title">
			<div class="line"></div>
			<h3>热门推荐</h3>
		</div>
		<div class="content">
			<ul>
			<?php  foreach($goods as $val){ ?>
				<li>
					<a href="<?=U('index/index/changestatus',array('id'=>$val['id']));?>">
						<img src="/<?php echo ($val['img']); ?>" alt="">
						<h4><?php echo ($val['name']); ?></h4>
						<p><?php echo ($val['shopname']); ?></p>
						<div class="price"><span><?php echo ($val['price']); ?></span>元</div>
						<div class="pay">立即购买</div>
					</a>
				</li>
			<?php } ?>
			</ul>
		</div>
	</div>

	<div class="footer">
		<ul>
			<li class="sc active">
				<a href="index.html">
					<i></i>
					<br>
					<span>电子卷商城</span>
				</a>
			</li>
			<li class="line1"></li>
			<li class="user">
				<a href="<?php echo U('index/index/mycoupons');?>">
					<i></i>
					<br>
					<span>我的电子券</span>
				</a>
			</li>
		</ul>
	</div>
	<!-- 员工和老板进来显示 -->
	<!-- 员工点击跳到yuangongxiaoshou.html -->
	<!-- 老板点击跳到bossguanli.html -->
	<?php if($level == 1 || $level ==2){ ?>

	<?php if($level ==1){ ?>
	<a href="<?=U('index/index/showboss',array('id'=>$shop['id']));?>">
	<?php } ?>
	<?php if($level ==2){ ?>
	<a href="<?=U('index/index/showstaff',array('id'=>$user['id']));?>">
	<?php } ?>
		<div class="guanli">
			<div class="bgc"></div>
			<div class="box">
				<div class="big"><div class="ic" id="icon"></div></div>
			</div>
		</div>
	</a>
	<?php } ?>
	
</body>
<script>
	var icon = document.getElementById("icon");
	setInterval(function(){
		if(icon.style.display=="none"){icon.style.display="";}else{icon.style.display="none";}
	},500)
</script>
</html>