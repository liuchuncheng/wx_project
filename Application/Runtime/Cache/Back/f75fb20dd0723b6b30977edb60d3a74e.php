<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>管理中心 - 店铺列表 </title>
<meta name="Copyright" content="" />
<link href="/Public/Back/css/public.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="/Public/Back/js/jquery.min.js"></script>
<script type="text/javascript" src="/Public/Back/js/global.js"></script>
<style type="text/css">
  .pagination .num{
    margin-right: 10px;
  }
</style>
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
      <li><a href="<?=U('back/pt/index');?>"><i class="articleCat"></i><em>财务总览</em></a></li>
    </ul> 
    <ul>
      <li><a href="<?=U('back/pt/shouru');?>"><i class="articleCat"></i><em>财务收入</em></a></li>
    </ul>
    <ul>
      <li><a href="<?=U('back/pt/zhichu');?>"><i class="articleCat"></i><em>财务支出</em></a></li>
    </ul>
    <ul>
      <li><a href="<?=U('back/index/shoplist');?>"><i class="productCat"></i><em>店铺列表</em></a></li></ul>
      <ul>
      <li><a href="<?=U('back/pt/goodslist');?>"><i class="product"></i>
      <em>商品列表</em></a></li></ul>
     
    
    </ul>
  
  
</div></div>


<body>
<div id="dcWrap">


 <div id="dcMain" style="min-height:750px;">
   <!-- 当前位置 -->
<div id="urHere">管理中心<b>></b><strong>财务管理</strong><b>></b><strong>收入</strong> </div>   <div class="mainBox" style="height:auto!important;">
        <h3>收入</h3>
    <table width="100%" border="0" cellpadding="8" cellspacing="0" class="tableBasic">
      <tr>
        <th width="120" align="left">名字</th>
        <th align="left">金额</th>
        <th align="left">购买的商品(店铺)</th>
        <th align="center">一级分销人</th>
       
       <th width="60" align="center">支付时间</th>
       
     </tr>
            <!-- <tr>
        <td align="left">fdsf</td>
        <td>200</td>
        <td>12</td>
        <td align="center">dwd</td>
        <td align="center">dwd</td>
        <td align="center">2017/04/05 20:30:33</td>
        
     </tr> -->
     <?php  if(!empty($list)){ foreach ($list as $key => $value) { ?>
     <tr>
        <td align="left"><?php echo ($value['nickname']); ?></td>
        <td><?php echo ($value['pay_money']/100); ?></td>
        <td><?php echo ($value['shopname']); ?></td>
        <td align="center"><?php echo ($value['bname']); ?></td>
        <td align="center"><?php echo date("Y-m-d H:i:s",$value['pay_time']);?></td>
        
     </tr>

     <?php  }} ?>
           
          </table>
           </div>
           <div class="pagination" style="text-align:center;font-size:20px;">
            　　<ul>
                    <li><?php echo ($page); ?></li>
                </ul>
          </div>
           
 </div>
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