<?php
namespace Back\Controller;
use Back\Controller\BaseController;
class PtController extends BaseController 
{
	

    //首页
    public function index()
    {
        
        $shouru=M()->query("SELECT SUM(pay_money) as sr from pt_order where status=2");
        $zhichu=M()->query("SELECT SUM(price) as zc from pt_hb ");
        $sr=$shouru[0]['sr']/100;
        $zc=$zhichu[0]['zc']/100;
        $this->assign('sr',$sr);
    	$this->assign('zc',$zc);
    	$this->display();
    }

     //退出登录
    public function out()
    {
        unset($_SESSION['name']);
        unset($_SESSION['id']);
        $this->success('退出成功！', U('Back/login/login'));
    }

    /**
     * 商品列表
     */
    public function goodslist(){
        $model = D('goods');
        $shopmodel = D('shop');
       
        $p=isset($_GET['p']) ? $_GET['p'] : 0;
        $where=['status'=>1];
        $list =$model->table('pt_goods a')->join('pt_shop b on a.sid=b.id')->field('a.*,b.shopname as shop_name')->where(array('a.status'=>1))->order(array('a.id'=>'desc'))->page($p.',2')->select();
        //echo M()->getlastsql();
        $count = $model->table('pt_goods a')->join('pt_shop b on a.sid=b.id')->field('a.*,b.shopname as shop_name')->where(array('a.status'=>1))->count();
        $page = new \Think\Page($count, 2);
        $show = $page->show();// 分页显示输出
       
        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->display();
    }

    //收入
    public function shouru()
    {
        $User = D('order'); 
        $p=isset($_GET['p']) ? $_GET['p'] : 0;
        // 实例化User对象// 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取
        // $list = $User->where('status=2')->order(array('pay_time'=>'desc'))->page($_GET['p'].',2')->select();
        //$list =$User->table('pt_order a')->join('pt_user b on a.share_openid=b.openid')->field('a.*,b.nickname as bname')->where('a.status=2')->order(array('a.pay_time'=>'desc'))->page($_GET['p'].',2')->select();
        $list =$User->table('pt_order a')->join('left join  pt_user b on a.share_openid=b.openid left join pt_shop c on a.sid=c.id')->field('a.*,b.nickname as bname,c.shopname')->where('a.status=2')->order(array('a.pay_time'=>'desc'))->page($p.',2')->select();
        //echo M()->getlastsql();die;
        $this->assign('list',$list);
        // 赋值数据集
        $count = $User->table('pt_order a')->join('left join  pt_user b on a.share_openid=b.openid left join pt_shop c on a.sid=c.id')
        ->field('a.*,b.nickname as bname,c.shopname')->where('a.status=2')->count();
        // 查询满足要求的总记录数
        $Page = new \Think\Page($count,2);
        // 实例化分页类 传入总记录数和每页显示的记录数
        $show = $Page->show();
        // 分页显示输出
        $this->assign('page',$show);// 赋值分页输出
        $this->display();
    }

    //支出
     public function zhichu()
    {
        $User = D('hb'); 
        $p=isset($_GET['p']) ? $_GET['p'] : 0;
        $list =$User->table('pt_hb a')->join('pt_user b on a.openid=b.openid')->field('a.*,b.name')->order(array('a.send_time'=>'desc'))->page($p.',2')->select();
        //echo M()->getlastsql();
        $count = $User->table('pt_hb a')->join('pt_user b on a.openid=b.openid')->field('a.*,b.name')->count();
        $Page = new \Think\Page($count,2); 
        $this->assign('list',$list);
        $show = $Page->show();
        $this->assign('page',$show);
        $this->display();
    }

    public function ce()
    {
        // echo time();
        echo md5(md5('666666'.'0e2817'));
    }



}