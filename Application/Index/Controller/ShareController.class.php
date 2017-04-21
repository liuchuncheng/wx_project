<?php
// 本类由系统自动生成，仅供测试用途
namespace Index\Controller;
use Think\Controller;
define("APPID",'wx956afd00e7aa450d');
define('APPSECRET','aabd1de66c9f61caeb67d2fd2051e96f');
class ShareController extends Controller 
{
    public function share()
    {
        // $_hmt = new \Auto\Baidu_count('286481df7ee966597848f556625fff9b');
        // $_hmtPixel = $_hmt->trackPageView();
       // $this->error('支付失败！', U('ceshi'));exit();
    	
    	//$js1=new Jssdk('wx347008b96f9d0b66','','tkosvv1415598757');
        $js=$this->getSignPackage();
        // var_dump($js);die;
        $this->assign('js',$js);
        $this->assign('a',$a);
        $this->display();
        // $data['e']=1212;
        // p($data);
        // echo '6666';  
    }

    //access_token获取
	function js_token()
	{
	    $cache_name = './Wx/js_token';
	    if(file_exists($cache_name) && time() - filemtime($cache_name) < 5000)
	    {
	        $_token = file_get_contents($cache_name);
	    }
	    else 
	    {
	    	$access_token=$this->access_token();
	    	$url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token=$access_token";
		    $res = json_decode($this->curlGet($url));
			 // var_dump($res);
			 //  exit;
		    $_token = $res->ticket;
		    file_put_contents($cache_name, $_token);
	       
	    }
	    return $_token;
	}

	private function createNonceStr($length = 16) 
	{
	    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
	    $str = "";
	    for ($i = 0; $i < $length; $i++) {
	      $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
	    }
	    return $str;
    }

   public function getSignPackage() 
   {
	    $jsapiTicket = $this->js_token();
		//var_dump($jsapiTicket);
		//exit;

	    // 注意 URL 一定要动态获取，不能 hardcode.
	    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
	    $url = "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

	    $timestamp = time();
	    $nonceStr = $this->createNonceStr();

	    // 这里参数的顺序要按照 key 值 ASCII 码升序排序
	    $string = "jsapi_ticket=$jsapiTicket&noncestr=$nonceStr&timestamp=$timestamp&url=$url";

	    $signature = sha1($string);

	    $signPackage = array(
	      "appId"     => APPID,
	      "nonceStr"  => $nonceStr,
	      "timestamp" => $timestamp,
	      "url"       => $url,
	      "signature" => $signature,
	      "rawString" => $string
	    );
	    return $signPackage; 
   }

	   //经过微信测试，此方法完全可以，，，，
	function curlGet($url)
	{
	    $ch = curl_init();
	            //$header = "Content-type: text/xml Accept-Charset: utf-8";
	    curl_setopt($ch, CURLOPT_URL, $url);
	            //curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
	    curl_setopt($ch, CURLOPT_SSLVERSION,1);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	            //curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    $temp = curl_exec($ch);
	    curl_close($ch);
	    return $temp;
	}

	//access_token获取
	function access_token()
	{
	    $cache_name = './Wx/access_token';
	    if(file_exists($cache_name) && time() - filemtime($cache_name) < 3200)
	    {
	        $_token = file_get_contents($cache_name);
	    }
	    else 
	    {
	        $_token =$this-> curlGet('https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.APPID.'&secret='.APPSECRET, TRUE);
	        if($_token !== FALSE)
	        {
	            $_token = json_decode($_token);
	            if(isset($_token->access_token))
	            {
	                $_token = $_token->access_token;
	                file_put_contents($cache_name, $_token);    
	            }
	            else
	                return FALSE;
	        }
	    }
	    return $_token;
	}


}    