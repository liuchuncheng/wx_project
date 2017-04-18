<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>管理中心 - 店铺列表 </title>
<meta name="Copyright" content="" />
<link href="/Public/Back/css/public.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="/Public/Back/js/jquery.min.js"></script>
<script type="text/javascript" src="/Public/Back/js/global.js"></script>
</head>
<body>
<div id="dcWrap">
 <div id="dcHead">
 <div id="head">
  <div class="logo"><a href="index.html"><img src="images/" alt="logo"></a></div>
  <div class="nav">
   
   <ul class="navRight">
    <li class="M noLeft"><a href="JavaScript:void(0);">您好，<?php echo (session('name')); ?></a>
     
    </li>
    <li class="noRight"><a href="<?=U('back/pt/out');?>">退出</a></li>
   </ul>
  </div>
 </div>
</div>
<!-- dcHead 结束 -->
<div id="dcLeft">
<div id="menu">
    <ul>
      <li><a href="<?=U('back/index/index');?>"><i class="articleCat"></i><em>财务管理</em></a></li>
    </ul>
    <ul>
      <li ><a href="<?=U('back/index/img');?>"><i class="show"></i><em>设置图片</em></a></li>
    <ul>
      <!-- <li><a href="<?=U('back/index/shoplist');?>"><i class="productCat"></i><em>店铺列表</em></a></li> -->
      <li><a href="<?=U('back/index/goodslist');?>"><i class="product"></i><em>商品列表</em></a></li>
      <li><a href="<?=U('back/index/staff');?>"><i class="product"></i><em>员工信息</em></a></li>
      <li><a href="<?=U('back/index/order');?>"><i class="product"></i><em>订单管理</em></a></li>
    </ul>
  
  
</div></div>


<style>
  .shouru,.zhichu,.yue{
    display: block;
    width: 200px;
    height: 100px;
    margin:20px;
    background-color: #000;
    color: #fff;
    float: left;
    line-height: 100px;
    font-size: 20px;
    text-align: center;
    border-radius: 5px;
  }
  .shouru{
    background-color: #13a3ff;
  }
  .zhichu{
    background-color: #fd433d;
  }
  .yue{
    background-color: #28B779;
  }
</style>

<body>
<div id="dcWrap"> 
<!-- dcHead 结束 --> 

 <div id="dcMain"> <!-- 当前位置 -->
<div id="urHere">管理中心<b>></b><strong>财务管理</strong> </div>  
<div id="index" class="mainBox" style="padding-top:18px;height:auto!important;height:550px;min-height:550px;">
     <h3>
     <!-- <a href="" class="actionBtn add">立即提现</a> -->
     财务管理
     </h3>
    <table width="100%" border="0" cellpadding="8" cellspacing="0" class="tableBasic">
      <tr>
        <a class="shouru" href="shouru.html">总收入<span><?php echo ($sr); ?></span></a>
    <a class="zhichu" href="zhichu.html">支出<span><?php echo ($zc); ?></span></a>
   <!--  <a class="yue">余额<span>2674674</span></a> -->
      </tr>
     
          </table>
    
   
    
  </div>
 </div>
 <div class="clear"></div>
<div id="dcFooter">
 <div id="footer">
  <div class="line"></div>
  <ul>
   <!-- 版权所有 © 2017-2018 北京乐兔电子商务有限公司，并保留所有权利。 -->
  </ul>
 </div>
</div><!-- dcFooter 结束 -->
<div class="clear"></div> </div>


</body>



 <div class="clear"></div>
      <div id="dcFooter">
 <div id="footer">
  <div class="line"></div>
  <ul>
   <!-- 版权所有 © 2013-2015 漳州豆壳网络科技有限公司，并保留所有权利。 -->
  </ul>
 </div>
</div><!-- dcFooter 结束 -->
<div class="clear"></div> </div>
</body>
</html>