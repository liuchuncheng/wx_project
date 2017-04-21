<?php
namespace Index\Controller;

use Think\Controller;
define("APPID",'wx956afd00e7aa450d');
define('APPSECRET','aabd1de66c9f61caeb67d2fd2051e96f');
class IndexController extends Controller 
{
  
  //首页入口
    public function index()
    { 
      vendor("wx_sample");
      $wechatObj = new \wechatCallbackapiTest();
      $wechatObj->valid();
      $url = "http://wxzf.zcsmkj.com/index.php/index/index/index";

      $js = a('Index/share');
      $js = $js->getSignPackage();//微信分享

      $model = D('pt_goods');
      $banner = D('pt_banner');
      $shop = D('pt_shop');
      $user = D('pt_user');
      $openid  = $_COOKIE['openid'];
      if(I('get.code') || $openid){

        $openid  = $_COOKIE['openid'];
        if(!$openid){
          $userinfo = $this->getuserinfo(I('get.code'));  //获取用户信息

          $openid = setcookie('openid',$userinfo->openid,time()+3600*24*30);
          $this->code($url);
        }
        
        $goods = $model->where(array('status'=>1))->select();
        foreach ($goods as $key => $val) {
          $goods[$key]['shopname'] = $shop->where(array('id' => $val['sid'],'status=1'))->getFielD('shopname');
        }

        $where=['openid'=>$openid];
        $shop = $shop->where($where)->find(); 
        $user = $user->where($where)->find();

        $level =3;
        if($shop) $level = 1; //老板查看状态
        
        if($user) $level = 2; //员工查看状态
        $banner = $banner->find();
        $this->assign('openid',$openid);
        $this->assign('goods',$goods);
        $this->assign('banner',$banner);
        $this->assign('shop',$shop);
        $this->assign('user',$user);
        $this->assign('level',$level);
        $this->assign('js',$js);
        $this->display('index');

      }else{
        $this->code($url);
      }

    }

  //从而获取粉丝的openid，获取成功以后开始业务代码
  public function getuserinfo($code){
      
      $code = $_GET['code'];

      //获取openid和access_token
      $url_get='https://api.weixin.qq.com/sns/oauth2/access_token?appid=wx956afd00e7aa450d&secret=aabd1de66c9f61caeb67d2fd2051e96f&code='.$code.'&grant_type=authorization_code'; 

      $json=json_decode($this->curlGet($url_get));

      $openid= $json->openid;

      //获取用户信息
      $userinfo ="https://api.weixin.qq.com/sns/userinfo?access_token={$json->access_token}&openid={$openid}&lang=zh_CN";

      $json=json_decode($this->curlGet($userinfo));

      return $json;
    }

    public function code($url){
      $redirect_uri = urlencode($url);

        $url="https://open.weixin.qq.com/connect/oauth2/authorize?appid=".APPID."&redirect_uri=".$redirect_uri."&response_type=code&scope=snsapi_userinfo&state={$state}#wechat_redirect";   //获取code

        header("Location: $url"); 
    }

  //构造一个远程请求https的函数
  function curlGet($url,$type="GET"){
    $ch = curl_init();
    $header = "Accept-Charset: utf-8";
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $type);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $temp = curl_exec($ch);
    return $temp;
  }

  /**
   * 二维码 条形码显示页面
   */
  public function showgoods(){
    $id = 4;
    $order = D('pt_order');

    $thridsqo = $order->where('id ='.$id)->getFielD('pt_thridsqo');
    $this->assign('thridsqo',$thridsqo);
    $this->display();
  }

  /**
   * 员工登录
   */
  public function login(){
    $openid = I("get.openid");

    $openid  = $_COOKIE['openid'];
    if(I('get.code') || $openid){
        $userinfo= $this->getuserinfo(I('get.code'));  //获取用户信息

        $openid = setcookie('openid',$userinfo->openid,time()+3600*24*30);
      }else{

        $url = "http://wxzf.zcsmkj.com/index.php/index/index/login";  //回调地址
        $this->code($url);

      }

    $openid  = $_COOKIE['openid'];
    $this->assign('openid',$openid);
    $this->display();
  }

  /**
   * 登录
   */
  public function checklogin(){
    $data = I("post.");
    $user = D('pt_user');
    $shop = D('pt_shop');
    $where = ['name'=>$data['name'],'phone'=>$data['phone']];
    $isHave = $user->where($where)->select();

    if(!$isHave){
      $boss = $shop->where($where)->select();
      if($boss){
        $data=['openid'=>$data['openid']];
        $shop->where($where)->save($data);
        $this->success('成功',U('index/index/showboss',array('id'=>$boss[0]['id'])));
      }else{
        $this->error('账号不存在');
      }
    }else{
      $data=['openid'=>$data['openid']];
      $user->where($where)->save($data);
      $this->success('成功',U('index/index/showstaff',array('id' =>$isHave[0]['id'])));
    }
  }

  /**
   * 老板查看页面
   */
  public function showboss(){
    $id = I('get.id');
    $user = D('pt_user');
    $order = D('pt_order');
    $shop = D('pt_shop');

    $shop = $shop->where('id ='.$id)->find();

    $list = $user->where('sid ='.$id)->order(array('id'=>'desc'))->select();

    foreach ($list as $key => $val) {
      $list[$key]['num'] = count($order->where(array('share_openid'=>$val['openid'],'status'=>2))->select());
    }

    $meshare = $order->where(array('share_openid'=>$shop['openid'],'status'=>2))->select();
    $this->assign('list',$list);
    $this->assign('meshare',$meshare);
    $this->display();
  }

  /**
   * 员工查看页面
   */
  public function showstaff(){
    $id = I('get.id');
    $user = D('pt_user');
    $order = D('pt_order');

    $openid = $user->where('id ='.$id)->getFielD('openid');

    $list = $order->where(array('share_openid'=>$openid,'status'=>2))->select();

    $this->assign('list',$list);
    $this->display();
  }

  /**
   * 我的电子券
   */
  public  function mycoupons(){
    $openid = I("get.openid");
    // $openid = oixoqxEe4bsMlrrypS3mIUfjOieQ;
    $order = D('pt_order');

    $list =$order->table('pt_order a')->join('pt_goods b on a.gid=b.id')->join('pt_shop c on b.sid=c.id')->fielD('a.is_use,b.*,c.shopname')->where(array('a.status'=>2,'a.wx_openid'=>$openid))->order(array('a.id'=>'desc'))->select();
    $this->assign('list',$list);
    $this->assign('openid',$openid);
    $this->display();
  }

  /**
   * 获取jssdk
   */
  public function getjssdk(){
    vendor("Jssdk");
    $Jssdk = new \Jssdk(APPID,APPSECRET);
    $url = I('get.localurl');
    echo  json_encode($Jssdk->GetSignPackage($url));   
  }
}