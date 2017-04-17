<?php
namespace Back\Controller;

use Think\Controller;
class BaseController extends Controller 
{
	Public function __construct()
	{
        parent::__construct(); 
      
       
        //如果木有name session 
        if(!$_SESSION['name'])
        {
            
            header("Location:/index.php/back/login/login");
            
        }
    }
}