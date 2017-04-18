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


				
 <div id="dcMain">
   <!-- 当前位置 -->
<div id="urHere">管理中心<b>></b><strong>商品列表</strong> </div>   <div class="mainBox" style="height:auto!important;">
        <h3><a href="<?=U('back/index/goodsadd');?>" class="actionBtn add">添加商品</a>商品列表</h3>
    <table width="100%" border="0" cellpadding="8" cellspacing="0" class="tableBasic">
      <tr>
        <th width="120" align="left">商品名称</th>
        <th align="left">价格</th>
        <th align="left">数量</th>
       <th width="60" align="center">所属店铺</th>
        <th width="80" align="center">操作</th>
     </tr>
     <?php foreach ($list as $key => $val) { ?>
        <tr>
          <td align="left"><?php echo ($val['name']); ?></td>
          <td><?php echo ($val['price']); ?></td>
          <td><?php echo ($val['num']); ?></td>
          <td align="center"><?php echo ($val['shop_name']); ?></td>
          <td align="center"><a href="<?=U('back/index/goodsadd',array('id'=>$val['id']));?>">编辑</a> | <a href="<?=U('back/index/goodsdel',array('id'=>$val['id']));?>" onclick="javascript:if(!confirm('确定要删除么？')) { return false; }">删除</a></td>
       </tr>
    <?php } ?>
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
</html>