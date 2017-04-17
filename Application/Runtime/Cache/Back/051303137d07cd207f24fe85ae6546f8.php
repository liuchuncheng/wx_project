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
      <li ><a href="<?=U('back/index/img');?>"><i class="show"></i><em>设置图片</em></a></li>
    <ul>
      <li><a href="<?=U('back/index/shoplist');?>"><i class="productCat"></i><em>店铺列表</em></a></li>
      <li><a href="<?=U('back/index/goodslist');?>"><i class="product"></i><em>商品列表</em></a></li>
      <li><a href="<?=U('back/index/staff');?>"><i class="product"></i><em>员工信息</em></a></li>
      <li><a href="<?=U('back/index/order');?>"><i class="product"></i><em>订单管理</em></a></li>
    </ul>
  
  
</div></div>


 <div id="dcMain">
   <!-- 当前位置 -->
<div id="urHere">管理中心<b>></b><strong>添加店铺</strong> </div>   <div class="mainBox" style="height:auto!important;height:550px;min-height:550px;">
            <h3><a href="product_category.html" class="actionBtn">店铺列表</a>添加店铺</h3>
    <form action="<?php echo U('Back/Index/shopedit'); ?>" method="post" id="form">
     <table width="100%" border="0" cellpadding="8" cellspacing="0" class="tableBasic">
      <tr>
       <td width="80" align="right">店铺名称</td>
       <td>
        <input type="text" name="shopname" value="<?php echo $data['shopname']; ?>" size="40" class="inpMain" />
       </td>
      </tr>
      <tr>
       <td align="right">手机号/账号</td>
       <td>
        <input type="text" name="phone" id="phone" value="<?php echo $data['phone']; ?>" size="40" class="inpMain" />
       </td>
      </tr>
      
      <tr>
       <td align="right">密码</td>
       <td>
        <input type="password" name="pwd" id="passwords" value="<?php echo $data['pwd']; ?>" size="40" class="inpMain" />
       </td>
      </tr>
      
      <tr>
       <td align="right">管理员</td>
       <td>
        <input type="text" name="name" value="<?php echo $data['name']; ?>" size="40" class="inpMain" />
       </td>
      </tr>
      <tr>
       <td></td>
       <td>
        <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
        <input name="submit" class="btn" id="button" type="button" value="提交" />
       </td>
      </tr>
     </table>
    </form>
       </div>
 </div>
 <script type="text/javascript">
 $("#button").bind('click',function(){
      
    var phone = $('#phone').val();
    if(!(/^1[3|4|5|8][0-9]\d{4,8}$/.test(phone))){ 

        alert("手机号码有误，请重填");  
        return false; 
    } 
      //密码
      var password = $('#passwords').val();
      if (password.length<6) {
          alert('密码格式错误,请输入六位（包含）以上字符');
          return;
      };

      var data = $('form').serialize();
        $.ajax({
            url: "<?php echo U('back/index/shopedit');?>",
            data:data,
            type:'post',       
            dataType: "json",
            async: true,       
            success: function(date) {
                if(date.status){
                  location.href=date.url; 
                }else{
                    alert('失败')
                }
            }
        });
       
    })
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