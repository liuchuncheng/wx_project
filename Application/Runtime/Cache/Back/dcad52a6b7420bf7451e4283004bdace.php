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
  <li><a href="product.html"><i class="product"></i><em>员工信息</em></a></li>
 </ul>
  
  
</div></div>


 <div id="dcMain">
   <!-- 当前位置 -->
<div id="urHere">管理中心<b>></b><strong>设置图片</strong> </div>   
<div class="mainBox imgModule">
    <h3>店铺图片</h3>
    <table width="100%" border="0" cellpadding="8" cellspacing="0" class="tableBasic">
    <tr>
       <th>添加图片</th>
       <th>图片列表</th>
     </tr>
     <tr>
      <td width="350" valign="top">
       <form action="<?php echo U('Back/Index/uploadimg'); ?>" method="post" enctype="multipart/form-data">
        <table width="100%" border="0" cellpadding="8" cellspacing="0" class="tableOnebor">
         <tr>
          <td><b>图片名称</b>
			<input type="text" name="name" value="" size="20" class="inpMain" />
          </td>
         </tr>
         <tr>
          	<td><b>选择图片</b>
           		<input type="file" name="img" id="img" class="inpFlie" />
           	</td>
         </tr>
         
         <!-- <tr>
          <td><b>序号</b>
<input type="text" name="sort" value="1" size="20" class="inpMain" />
          </td>
         </tr> -->
         <tr>
          <td>
           <input name="submit" class="btn" type="submit" value="提交" />
          </td>
         </tr>
        </table>
       </form>

      </td>
      <td valign="top">
       <table width="100%" border="0" cellpadding="8" cellspacing="0" class="tableOnebor">
        <tr>
         <td width="100">图片名称</td>
         <td></td>
         <td width="80" align="center">操作</td>
        </tr>
        <?php  foreach($list as $val){ ?>
         <tr>
         <td><a href="#" target="_blank"><img src="/<?php echo ($val['img']); ?>" width="100" /></a></td>
         <td><?php echo ($val['name']); ?></td>
         <td align="center"><a href="<?=U('back/index/editimg',array('id'=>$val['id']));?>">编辑</a> | <a href="<?=U('back/index/delimg',array('id'=>$val['id']));?>">删除</a></td>
        </tr>
        <?php  } ?>
       </table>
      </td>
     </tr>
    </table>
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