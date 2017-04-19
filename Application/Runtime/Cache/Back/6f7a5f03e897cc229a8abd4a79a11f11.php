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
      <li><a href="<?=U('back/index/order');?>"><i class="product"></i><em>分销详情</em></a></li>
      <li><a href="<?=U('back/index/orderlist');?>"><i class="product"></i><em>订单管理</em></a></li>
    </ul>
  
  
</div></div>


<style>
  .search{
    overflow: hidden;
    border-bottom: 1px solid #D7D7D7;
  }
  .search h3{
    float: left;
    margin-bottom: 0;
    border-bottom: none;
  }
  .search form{
    float: right;

  }
  .search input{
    border: 1px solid #999;
    width: 200px;
    height: 27px;
    padding-left: 5px;
  }
  .search button{
    width: 60px;
    height: 30px;
    text-align: center;
    background-color: #13a3ff;
    color: #fff;
  }
</style>
<div id="dcMain"> <!-- 当前位置 -->
<div id="urHere">管理中心<b>></b><strong>订单管理</strong> </div>  
<div id="index" class="mainBox" style="padding-top:18px;height:auto!important;height:550px;min-height:550px;">
  <div class="search">
    <h3>已出售商品列表</h3>
    <form action="<?=U('back/index/orderlist')?>" method="post">
      <input type="text" name ="search" value="<?php echo ($search); ?>">
        <button id="search">搜索</button>
    </form>
  </div>
     
    <table width="100%" border="0" cellpadding="8" cellspacing="0" class="tableBasic" style="margin-top: 30px;">
      <tr>
        <th width="120" align="left">商品名称</th>
        <th width="120" align="left">第三方流水号</th>
        <th align="left">价格</th>
        
        <th width="80" align="center">使用状态</th>
        <th width="200" align="center">操作</th>

     </tr>
     <?php  foreach($list as $val){ ?>
        <tr>
        <td align="left"><?php echo ($val['goodsname']); ?></td>
        <td align="left"><?php echo ($val['thridsqo']); ?></td>
        <td><?php echo ($val['pay_money']); ?></td>
       <td align="center"><?php  if($val['is_use']==1) echo '未使用';else{ echo '已使用'; } ?></td>
        <td align="center"><a href="<?=U('back/index/changestatus',array('id'=>$val['id']));?>">标记为已用</a> | <a href="#">删除</a></td>
     </tr>
     <?php } ?>
     
    </table>
    
   
    
  </div>
 </div>
 <script>
$("button").click(function(){
  $("form").submit();
});
 </script>



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