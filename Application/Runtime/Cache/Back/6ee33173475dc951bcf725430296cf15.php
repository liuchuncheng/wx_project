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

  .box{
    display: none;
  }

  .mark{
    position: fixed;
    left: 0;
    top: 0;
    right: 0;
    bottom: 0;
    background-color: #000;
    opacity: 0.5;
    filter: alpha(opacity=50);
    z-index: 10;
  }
  .form{
    position: fixed;
    left: 50%;
    top: 50%;
    width: 500px;
    height: 150px;
    margin-left: -250px;
    margin-top: -100px;
    background-color: #fff;
    z-index: 11;
    padding-top: 50px;
    text-align: center;
    color: #333;
    font-size: 20px;
  }
  .ipt{
    margin-left: 20px;
    width: 200px;

  }
  .btn1,.btn2{
    width: 50px;
    height: 30px;
    border-radius: 2px;
    font-size: 18px;
    color: #fff;
  }
  .btn1{
    margin-right: 50px;
  }
  .btn2 {
    background-color: #13a3ff;
  }
</style>
  <div id="dcMain">
  <div class="box">
  <div class="mark"></div>
  <form action="<?=U('back/index/reportexcel');?>" class="form" method="post" enctype="multipart/form-data">
    <label for="">选择文件:</label><input type="file" class="ipt" name="report">
    <div style="margin-top: 30px;">
      <button class="btn1">取消</button>
      <button class="btn2" type="submit">确定</button>
    </div>
    
  </form>
</div>
   <!-- 当前位置 -->
<div id="urHere">管理中心<b>></b><strong>员工信息</strong> </div>   <div class="mainBox" style="height:auto!important;">
        <h3><a href="/导入员工.xls" class="actionBtn add" style="background: none; color: #13a3ff;">下载模板</a><a href="#" class="add1 actionBtn add" style="position: relative;">导入员工</a><a href="<?=U('back/index/staffadd');?>" class="actionBtn add" style="margin-right: 10px;">添加员工</a> 员工列表</h3>
    <table width="100%" border="0" cellpadding="8" cellspacing="0" class="tableBasic">
      <tr>
        <th width="120" align="left">姓名</th>
        <th align="left">手机号</th>
        <th align="left">性别</th>
        <th align="left">通过TA分享已支付人数</th>
       <th width="60" align="center">操作</th>
        
     </tr>
      <?php foreach($list as $val){ ?>
      <tr>
        <td align="left"><?php echo ($val['name']); ?></td>
        <td><?php echo ($val['phone']); ?></td>
        <td><?php echo ($val['sex']); ?></td>
        <td><span><?php echo ($val['num']); ?></span><a href="<?=U('back/index/share_order',array('share_openid'=>$val['openid']));?>" style="margin-left: 20px; color: #13a3ff;">查看详情</a> </td>
        <td align="center"><a href="<?=U('back/index/staffadd',array('id'=>$val['id']));?>">编辑</a> | <a href="<?=U('back/index/staffdel',array('id'=>$val['id']));?>" onclick="javascript:if(!confirm('确定要删除么？')) { return false; }">删除</a></td>
      </tr>
      <?php } ?>         
          </table>
            </div>
           </div>
            <div class="pagination" style="text-align:center;font-size:20px;">
            　　<ul>
                    <li><?php echo ($page); ?></li>
                </ul>
          </div>
 </div>
<script>
  $(".add1").click(function() {
    $(".box").css({"display":"block"})
  });
  $(".btn1").click(function() {
    $(".box").css({"display":"none"})
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