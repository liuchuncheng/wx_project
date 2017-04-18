<?php
namespace Index\Controller;

use Think\Controller;
define("APPID",'wx956afd00e7aa450d');
define('APPSECRET','aabd1de66c9f61caeb67d2fd2051e96f');
class IndexController extends Controller 
{
	
	//测试自动载入命名空间auto
    public function index()
    {	
  //   	vendor("wx_sample");
  //   	$wechatObj = new \wechatCallbackapiTest();
		// $wechatObj->valid();
    	
  //   	if(I('get.code')){

    		$this->getuserinfo(I('get.code'));  //获取用户信息

    	// }else{
    	// 	$url = "http://wxzf.zcsmkj.com/index.php/index/index/index";  //回调地址

	    // 	$redirect_uri = urlencode($url);

	    // 	$url="https://open.weixin.qq.com/connect/oauth2/authorize?appid=".APPID."&redirect_uri=".$redirect_uri."&response_type=code&scope=snsapi_userinfo&state={$state}#wechat_redirect";   //获取code

	    // 	header("Location: $url"); 
    	// }
        // $this->display();
    }

	//从而获取粉丝的openid，获取成功以后开始业务代码
	public function getuserinfo($code){
			$model = D('goods');
			$banner = D('banner');
			$shop = D('shop');
			// $code = $_GET['code'];

			// //获取openid和access_token
			// $url_get='https://api.weixin.qq.com/sns/oauth2/access_token?appid=wx956afd00e7aa450d&secret=aabd1de66c9f61caeb67d2fd2051e96f&code='.$code.'&grant_type=authorization_code';	

			// $json=json_decode($this->curlGet($url_get));

			// $openid= $json->openid;

			// //获取用户信息
			// $userinfo ="https://api.weixin.qq.com/sns/userinfo?access_token={$json->access_token}&openid={$openid}&lang=zh_CN";

			// $json=json_decode($this->curlGet($userinfo));
			// var_dump($json);die;

			$data =[
				'openid' => 'o6g94w_2cSYHmxp3GFC2JUr7E8ww',
				'sex' => '1',
				'nickname' => '但行好事，莫问前程'
			];

			$goods = $model->where(array('status'=>1))->select();
			foreach ($goods as $key => $val) {
				$goods[$key]['shopname'] = $shop->where(array('id' => $val['sid'],'status=1'))->getField('shopname');
			}
			$banner = $banner->find();
			$this->assign('goods',$goods);
			$this->assign('banner',$banner);
			$this->display('index');
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
}