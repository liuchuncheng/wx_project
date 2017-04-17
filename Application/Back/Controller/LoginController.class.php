<?php
namespace Back\Controller;

use Think\Controller;
class LoginController extends Controller 
{
	//登陆页面
    public function login()
    {
        //file_put_contents('./wxlog/wx.log',"\n".'执行日期：index'.date('Y-m-d H:i:s')."\n".'参数 :进来了 '."\n",8);
        // Vendor("Test.Aa");
        // $r=new \Aa();
        //echo $r->aa();
        
    	// $this->assign('user',session('name'));
     //    $this->assign('title','首页--九宫格');
    	$this->display();
    }

    public function index()
	{
		
        $sj='/^1[34578][0-9]{9}$/';
        $p=I();
        $mobile=$p['username'];
        if(!preg_match($sj,$mobile))
        {
			
			$this->error('手机号有误！', U('Back/login/login'));
			exit();
        }
        $ret = $this->check();
        if(is_array($ret))
        {
        	// echo "<pre>";
        	// print_r($ret);die;
        	if($ret[0]['status']==3)//超级管理员
        	{
                $this->success('登录成功！', U('Back/pt/index'));
                exit;
        	}
        	if($ret[0]['status']==1)//店铺账号
        	{
                $this->success('登录成功！', U('Back/index/shoplist'));
                exit;
        	}
            $this->error('该账号已被禁用！', U('Back/login/login'));
            exit;
        }
        else 
        {
        	
            if($ret == 2)
                $this->error('密码错误');
            if($ret == 3)
                $this->error('账号不存在！');
        }
           
            
        
		
    }

    public function check()
    {
    	$name=addslashes(trim($_GET['username']));
    	$password=addslashes(trim($_GET['password']));
        $user = M()->query("SELECT * from pt_shop where phone='$name'  limit 1");
        if($user)
        {
            if($user[0]['status']==0)
            {
                return 1;
            }
            if(md5(md5(trim($_GET['password']).$user[0]['salt'])) == $user[0]['pwd'])
            {
                // 登录成功之后把用户的信息存到session
                session('name', $user[0]['name']);
                session('id', $uid[0]['id']);
               
              
                return $user;
            }
            else 
                return 2;
        }
        else 
            return 3;  // 用户名不存在
    }

}