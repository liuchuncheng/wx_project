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


      <script charset="utf-8" src="/Public/Back/js/editor/ueditor.config.js"></script>
      <script charset="utf-8" src="/Public/Back/js/editor/ueditor.all.js"></script>

<div id="dcMain">
   <!-- 当前位置 -->
<div id="urHere">管理中心<b>></b><strong>添加商品</strong> </div>   <div class="mainBox" style="height:auto!important;height:550px;min-height:550px;">
            <h3><a href="product.html" class="actionBtn">商品列表</a>添加商品</h3>
    <form action="<?=U('back/index/goodsedit');?>" method="post" enctype="multipart/form-data">
     <table width="100%" border="0" cellpadding="8" cellspacing="0" class="tableBasic">
      <tr>
       <td width="90" align="right">商品名称</td>
       <td>
        <input type="text" name="name" value="<?php echo ($data['name']); ?>" size="80" class="inpMain" />
       </td>
      </tr>
      <tr>
       <td align="right">选择店铺</td>
       <td>
        <select name="sid">
        <option value="0">请选择</option>

        <?php foreach ($shop as $key => $val) { ?>
            <option value="<?php echo ($val['id']); ?>" <?php if($val['id'] == $data['sid']){?> selected  <?php } ?> ><?php echo ($val['shopname']); ?></option>
        <?php } ?>                           
        </select>
       </td>
      </tr>
      <tr>
       <td align="right">商品价格</td>
       <td>
        <input type="text" name="price" value="<?php echo ($data['price']); ?>" size="40" class="inpMain" onkeyup="value=value.replace(/[^\d]/g,'') "/>
       </td>
      </tr>
      <tr>
       <td align="right" valign="top">商品数量</td>
       <td>
         <input type="text" name="num" value="<?php echo ($data['num']); ?>" size="40" class="inpMain" onkeyup="value=value.replace(/[^\d]/g,'') "/>
       </td>
       
      </tr>
            <tr>
       <td align="right" valign="top">店铺地址</td>
       <td>
          <input type="text" name="address" value="<?php echo ($data['address']); ?>" size="40" class="inpMain" />
       </td>
      
      </tr>
            <tr>
       <td align="right" valign="top">店铺电话</td>
       <td>
         <input type="text" name="phone" value="<?php echo ($data['phone']); ?>" size="11" class="inpMain" onkeyup="value=value.replace(/[^\d]/g,'') "/>
       </td>
       
      </tr>
      <tr>
       <td align="right" valign="top">商户分销提成</td>
       <td>
         <input type="text" name="merchart_reward" value="<?php echo ($data['merchart_reward']); ?>" size="40" class="inpMain" onkeyup="value=value.replace(/[^\d]/g,'') "/>
       </td>
      </tr>
      <tr>
       <td align="right" valign="top">员工分销提成</td>
       <td>
         <input type="text" name="staff_reward" value="<?php echo ($data['staff_reward']); ?>" size="40" class="inpMain" onkeyup="value=value.replace(/[^\d]/g,'') "/>
       </td>
      </tr>
      <tr>
       <td align="right">上传商品图片</td>
       <td>
        <input type="file" name="img" size="38" class="inpFlie" value="<?php echo ($data['img']); ?>" />
        
      </tr>
      <tr>
       <td align="right">上传门店图片</td>
       <td>
        <input type="file" name="shop_img" size="38" class="inpFlie" value="<?php echo ($data['shop_img']); ?>" />
        
      </tr>
      <tr>
       <td align="right">商品介绍</td>
       <td>

       <textarea id="description" name="description" style="width:780px;height:400px;" class="textArea"><?php echo ($data['description']); ?></textarea>
      <!--  <script id="description" name="description" type="text/plain">
       <?php echo ($data['description']); ?>
    </script> -->

       </td>
        </tr>

        <tr>
       <td align="right">商品须知</td>
       <td>
       <textarea id="goodnotice" name="goodnotice" style="width:780px;height:400px;" class="textArea"><?php echo ($data['goodnotice']); ?></textarea>
      <!--  <script id="goodnotice" name="goodnotice" type="text/plain">
          <?php echo ($data['goodnotice']); ?>
        </script> -->
       </td>
      </tr>
        
      <tr>
       <td></td>
       <td>
        <input type="hidden" name ="id" value="<?php echo ($data['id']); ?>">
        <input name="submit" class="btn" type="submit" value="提交" />
       </td>
      </tr>
     </table>
    </form>
           </div>
 </div>

<!--  <script type="text/javascript">
        var ue = UE.getEditor('description');
        var ue = UE.getEditor('goodnotice');
    </script> -->
 


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