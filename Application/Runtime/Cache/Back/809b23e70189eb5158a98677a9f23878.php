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


				
 <div id="dcMain">
   <!-- 当前位置 -->
<div id="urHere">管理中心<b>></b><strong>店铺列表</strong> </div>   <div class="mainBox" style="height:auto!important;">
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
          <a href="<?=U('back/index/shopadd',array('id'=>$value['id']));?>">编辑</a> | <a href="<?=U('back/index/shopdel',array('id'=>$value['id']));?>" onclick="javascript:if(!confirm('确定要删除么？')) { return false; }">删除</a></td>
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
</html>