<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>管理中心 - 店铺列表 </title>
<meta name="Copyright" content="" />
<link href="/Public/Admin/css/public.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="/Public/Admin/js/jquery.min.js"></script>
<script type="text/javascript" src="/Public/Admin/js/global.js"></script>
</head>
<body>
<div id="dcWrap">
 <div id="dcHead">
 <div id="head">
  <div class="logo"><a href="index.html"><img src="images/" alt="logo"></a></div>
  <div class="nav">
   
   <ul class="navRight">
    <li class="M noLeft"><a href="JavaScript:void(0);">您好，admin</a>
     
    </li>
    <li class="noRight"><a href="login.html">退出</a></li>
   </ul>
  </div>
 </div>
</div>
<!-- dcHead 结束 -->
<div id="dcLeft">
<div id="menu">
 <ul>
  <li><a href="index.html"><i class="articleCat"></i><em>财务管理</em></a></li>
  
 </ul>
 <ul>
 
 
  <li ><a href="show.html"><i class="show"></i><em>设置图片</em></a></li>
  
   <ul>
  <li class="cur"><a href="product_category.html"><i class="productCat"></i><em>店铺列表</em></a></li>
  <li><a href="product.html"><i class="product"></i><em>商品列表</em></a></li>
 </ul>
  
  
</div></div>


				
 <div id="dcMain">
   <!-- 当前位置 -->
<div id="urHere">管理中心<b>></b><strong>店铺列表</strong> </div>   <div class="mainBox" style="height:auto!important;height:550px;min-height:550px;">
        <h3><a href="<?=U('back/index/shopadd');?>" class="actionBtn add">添加店铺</a>店铺列表</h3>
    <table width="100%" border="0" cellpadding="8" cellspacing="0" class="tableBasic">
    <tr>
        <th width="120" align="left">店铺名称</th>
        <th align="left">手机号/账号</th>
        <th align="left">密码</th>
       <th width="60" align="center">管理员</th>
        <th width="80" align="center">操作</th>
     </tr>
    <?php  if(!empty($list)){ foreach ($list as $key => $value) { ?>
    <tr>
        <td align="left"><?php echo ($value['shopname']); ?></td>
        <td><?php echo ($value['phone']); ?></td>
        <td><?php echo ($value['pwd']); ?></td>
        <td align="center"><?php echo ($value['name']); ?></td>
        <td align="center">
          <a href="<?=U('back/index/shopadd',array('id'=>$value['id']));?>">编辑</a> | <a href="<?=U('back/index/shopdel',array('id'=>$value['id']));?>">删除</a></td>
     </tr>

     <?php  }} ?>
           
          </table>
           </div>
           <?php echo ($page); ?>
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