<?php
namespace Back\Controller;
use Back\Controller\BaseController;
class PtController extends BaseController 
{
	

    //首页
    public function index()
    {
        
        
    	$this->assign('user',session('name'));
    	$this->display();
    }

     //退出登录
    public function out()
    {
        unset($_SESSION['name']);
        unset($_SESSION['id']);
        $this->success('退出成功！', U('Back/login/login'));
    }
}