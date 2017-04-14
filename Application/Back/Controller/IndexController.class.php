<?php
namespace Back\Controller;

use Think\Controller;
class IndexController extends Controller 
{
	//测试自动载入命名空间auto
    public function index()
    {
         header("Content-type: text/html; charset=utf-8");
         echo '载入成功a';
    }
     
  
}.