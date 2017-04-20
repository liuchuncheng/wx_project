<?php
namespace Index\Controller;
use Think\Controller;
define("APPID",'wx956afd00e7aa450d');
define('APPSECRET','aabd1de66c9f61caeb67d2fd2051e96f');
class PayController extends Controller 
{
	public function index()
	{
		
	}
	//detail 详情页面
	public function detail()
	{
		vendor("wx_sample");
    	$wechatObj = new \wechatCallbackapiTest();
		$wechatObj->valid();
		$m=A("Index/index");
    	if(I('get.code'))
    	{
    		$info= $m->getuserinfo(I('get.code'));  //获取用户信息
    	}
    	else
    	{
    		$url = "http://wxzf.zcsmkj.com/index.php/index/pay/detail";  //回调地址
	    	$m->code($url);
    	}
        logger("微信用户详细信息--".var_export($data,true)."\n");
		$share_openid=I('get.share_openid');
		$gid=I('get.gid');
	   
		//$share_openid=!empty($share_openid) ? I("get.share_openid") : 1;
		$share_openid=!empty($share_openid) ? I("get.share_openid") : 'o6g94w-yAgWkdYOvjM9-BaGm0m-Q';
		$gid=1;
		$data=M()->query("SELECT a.*,b.name as shop_name FROM pt_goods a left join pt_shop b on a.sid=b.id where a.id = $gid");
		$num=M()->query("SELECT count(*) as num from pt_order where gid=$gid and status=2");
		
		$info=json_encode($info);
		$info=json_decode($info,true);
		$this->assign('data',$data);
		$this->assign('info',$info);
		$this->assign('num',$num);
		$this->assign('share_openid',$share_openid);
        $this->display();
	}

    public function create_order()
	{
		$da=I();
		$order = D("pt_order"); // 实例化User对象
		$data['gid'] = $da['gid'];
		$data['sid'] = $da['sid'];
		$data['head'] = $da['head'];
		$data['wx_openid'] = $da['wx_openid'];
		$data['share_openid'] = $da['share_openid'];
		$data['nickname'] = $da['nickname'];
		$data['create_time'] = time();
		$data['pay_money'] = $da['pay_money']*100;
		$data['order_num'] = date("Ymdhis").mt_rand(10000,99999);
        if($order->add($data))
        {
        	return $data;
        }

	}

	public function pay()
	{

		$r=$this->create_order();
		
        if(is_array($r))
        {
            Vendor("Wx.Api");
	        Vendor("Wx.JsApiPay"); 
	        $tools = new \JsApiPay();
	        $openId = $r['wx_openid'];
	        //订单信息组装
	        $input = new \WxPayUnifiedOrder();
	        $name='智诚服务';
	        $input->SetBody($name);
	        
	        // 商户订单号
	        $order_num=trim($r['order_num']);
	        $money=trim($r['pay_money']); 
	        $input->SetAttach($order_num);
	        $input->SetOut_trade_no($order_num);
	        // 正式金额代码
	        $input->SetTotal_fee($money);
	       
	        $input->SetTime_start(date("YmdHis"));
	        $input->SetTime_expire(date("YmdHis", time() + 600));
	        $input->SetGoods_tag("tag");
	        $input->SetNotify_url("http://wxzf.zcsmkj.com/index.php/index/pay/wxnotify");
	        
	        // $input->SetTrade_type("WAP");
	        $input->SetTrade_type("JSAPI");
	        $input->SetOpenid($openId);
	        $order = \WxPayApi::unifiedOrder($input);
	        $jsApiParameters = $tools->GetJsApiParameters($order);
	        file_put_contents('./wxlog/wx.log',"\n".'执行日期：'.date('Y-m-d H:i:s')."\n".'微信id:'.$openId.'金额:'. $money.'订单号'.$order_num.'\n'.'支付参数:'.var_export($jsApiParameters,TRUE),8);
	        echo $jsApiParameters;
        }
	}

	public function wxnotify()
    {
    	$da=file_get_contents("php://input");
    	$file = './wxlog/wx.log';
        file_put_contents($file, "\n".'执行日期：'.date('Y-m-d H:i:s')."\n".$da."\n",FILE_APPEND);
    	import('Vendor.Wx.WxPayPubHelper'); 
        $notify = new \Notify_pub();
        $xml = $da;  
        //file_put_contents($file, "\n".'执行日期：'.date('Y-m-d H:i:s')."\n".'格式化xml:'.var_export($xml,TRUE)."\n",FILE_APPEND);
        $notify->saveData($xml);
        if($notify->checkSign() == FALSE)
        {
	        $notify->setReturnParameter("return_code","FAIL");//返回状态码
            $notify->setReturnParameter("return_msg","签名失败");//返回信息
            $returnXml = $notify->returnXml();
            #记录失败日志
            file_put_contents($file, "\n".'执行日期：'.date('Y-m-d H:i:s')."\n签名失败1111111111111111\n",FILE_APPEND);
            echo $returnXml;
            exit();

        }
        else
        {
           
	        //$postobj = simplexml_load_string($xml);
            $postobj = simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA); 
	        // 商家订单ID
	        $orderId = $postobj->attach;
	        //交易时间
	        $ti= $postobj->time_end;
	        //付款人客户的微信id
	        $wx_id=$postobj->openid;
	        // 微信支付方式
	        $pay_type = $postobj->trade_type;
	        // 支付金额
	        $money = $postobj->cash_fee;
	        // 第三方交易流水号
	        $thridSqo = $postobj->transaction_id;
	        // 支付时间
	        $payTime = (string)$postobj->time_end;

	        if($orderId==null || $money==null || $thridSqo == null || $payTime == null)
	        {
	        	$notify->setReturnParameter("return_code","FAIL");//返回状态码
	            $notify->setReturnParameter("return_msg","签名失败");//返回信息
	            $returnXml = $notify->returnXml();
	            #记录失败日志
                file_put_contents($file, "\n".'执行日期：'.date('Y-m-d H:i:s')."\n非法攻击\n",FILE_APPEND);
	            echo $returnXml;
	            die();
	        }
	        $data['order_num']=$orderId;//我们的订单号
	        $data['thridsqo']=$thridSqo ;//第三方流水号
	        $data['pay_money']=$money ;
	        $data['wx_openid']=$wx_id;
	        $data['pay_time']=$payTime;
            $result = $this->agree_order($data);
            if ($result) 
            {
                #更新订单状态
                $r=$this->update_order($data);
                if($r)
                {
                	
                	#记录成功日志
                    file_put_contents($file,"\n".'支付成功：微信id: '.$wx_id."\n".'金额: '. $money."\n".'订单id: '.$orderId."\n".'交易时间: '.$payTime."\n".'第三方交易流水号: '.$thridSqo."\n".'微信支付方式: '.$pay_type."\n",8);
                    echo "<xml><return_code><![CDATA[SUCCESS]]></return_code><return_msg><![CDATA[OK]]></return_msg></xml>";
                    $re=$this->find_hb($result); 
                    if($re)
                    {
                    	//给业务员发红包
		                $this->staff_hb($result);
		                //给店铺老板发红包
		                $this->shop_hb($result);
                    }
                    
                   
                }
                else
                {
		            #记录失败日志
	                file_put_contents($file,"\n".'数据库执行失败: '."\n".'微信id: '.$wx_id."\n".'金额: '. $money."\n".'订单id: '.$orderId."\n".'交易时间: '.$payTime."\n".'第三方交易流水号: '.$thridSqo."\n".'微信支付方式: '.$pay_type."\n",8);
                }
              
            }
            else
            {
                $notify->setReturnParameter("return_code","FAIL");//返回状态码
	            $notify->setReturnParameter("return_msg","签名失败");//返回信息
	            $returnXml = $notify->returnXml();
	            #记录失败日志
                file_put_contents($file,"\n".'数据库执行失败: '."\n".'微信id: '.$wx_id."\n".'金额: '. $money."\n".'订单id: '.$orderId."\n".'交易时间: '.$payTime."\n".'第三方交易流水号: '.$thridSqo."\n".'微信支付方式: '.$pay_type."\n",8);
	            echo $returnXml;
	           
            }
            
        }
       
    }

     //确认订单
    public function agree_order($data)
    {
    	$r=M()->query("SELECT * FROM pt_order where order_num='{$data['order_num']}' limit 1");
    	if($r)
		{
            return $r;
		}
    }

    //修改订单
    public function update_order($data)
    {
    	$t=time();
    	$r=M()->execute("UPDATE pt_order set `status` = 2 , pay_time=$t,wx_openid='{$data['wx_openid']}',thridsqo='{$data['thridsqo']}' where order_num ='{$data['order_num']}'");
    	if($r)
		{
            return true;
		}
    }

    //给业务员发红包
    public function staff_hb($r)
    {
    	$file = './wxlog/hb.log';
    	file_put_contents($file, "\n".'执行日期：'.date('Y-m-d H:i:s')."\n".'微信支付成功之后传过来的数据给业务员发的：'.var_export($r,true)."\n",FILE_APPEND);
    	$gid=$r[0]['gid'];
    	$sid=$r[0]['sid'];
    	if($r[0]['share_openid'] != 1)
    	{
            //查询商品表里的员工奖励
            $data=M()->query("SELECT * from pt_goods where id=$gid limit 1");
            $money=$data[0]['staff_reward']*100;
            $openid=$r[0]['share_openid'];
            $order_num=$r[0]['order_num'];
           
            $code=$this->hb($openid,$money,$order_num);
            
            if($code['result_code'] != 'SUCCESS')
            {
               $this->cache_hb($code);
               file_put_contents($file, "\n".'执行日期：'.date('Y-m-d H:i:s')."\n".'微信发放失败业务员（查询错误原因）：'.var_export($code,true)."\n",FILE_APPEND);
            }
             //成功就入库
            $this->hb_add($code,$sid);
    	}
    }
    
    //给店铺老板发红包
    public function shop_hb($r)
    {
    	$file = './wxlog/hb.log';
    	file_put_contents($file, "\n".'执行日期：'.date('Y-m-d H:i:s')."\n".'微信支付老板红包：'.var_export($r,true)."\n",FILE_APPEND);
    	$sid=$r[0]['sid'];
    	$gid=$r[0]['gid'];
    	$data=M()->query("SELECT * from pt_goods where id=$gid limit 1");
    	$money=$data[0]['merchart_reward']*100;
    	$user=M()->query("SELECT * from pt_user where sid=$sid and level=3 limit 1");
    	$openid=$user[0]['openid'];
    	$order_num=date("Ymdhis").mt_rand(10000,99999);
      
        $code=$this->hb($openid,$money,$order_num);
        if($code['result_code'] != 'SUCCESS')
        {
           $this->cache_hb($code);
           file_put_contents($file, "\n".'执行日期：'.date('Y-m-d H:i:s')."\n".'微信发放失败老板（查询错误原因）：'.var_export($code,true)."\n",FILE_APPEND);
        }
        //成功就入库
        $this->hb_add($code,$sid);
    }

    public function ce()
    {
    	$result=array (
			  0 => 
			  array (
			    'id' => '43',
			    'wx_openid' => 'o6g94w1AMPsuU_5mFoZUgbKSosYA',
			    'order_num' => '20170420105666666',
			    'thridsqo' => '4005332001201704207660882883',
			    'pay_money' => '1.00',
			    'nickname' => '卡布奇诺',
			    'status' => '2',
			    'create_time' => '1492657013',
			    'pay_time' => '1492657049',
			    'sid' => '2',
			    'is_use' => '1',
			    'share_openid' => 'o6g94w1AMPsuU_5mFoZUgbKSosYA',
			    'gid' => '1',
			  ),
            );
    	//$this->shop_hb($result);
    	$this->staff_hb($result);
    	                    file_put_contents('./wxlog/hb.log', "\n".'执行日期：'.date('Y-m-d H:i:s')."\n".'发红包：'.'进来了'."\n",FILE_APPEND);

    	//echo 56666666666666666;
    	// $re=$this->find_hb($result);
    	// var_dump($re);
    }

    //红包发放记录
    public function hb_add($code,$sid)
    {
       
	   $m=D('pt_hb');
	   $data['mch_billno']=$code['mch_billno'];
	   $data['openid']=$code['re_openid'];
	   $data['price']=$code['total_amount'];
	   $data['send_listid']=$code['send_listid'];
	   $data['sid']=$sid;
	   $data['send_time']=time();
	   $r=$m->add($data);
	   if(!$r)
	   { 
	   	   //如果数据库执行失败记录日志
	   	   $file = './wxlog/hb.log';
           file_put_contents($file, "\n".'执行日期：'.date('Y-m-d H:i:s')."\n".'红包发放失败记录：'.var_export($data,true)."\n",FILE_APPEND);
           
	   }

	}

	//红包发放失败实录
	public function cache_hb($code)
	{
	   $m=D('pt_hbcache');
	   
	   $data['openid']=$code['re_openid'];
	   $data['price']=$code['total_amount'];
	   $data['time']=date('Y-m-d H:i:s',time());
	   $data['msg']=$code['return_msg'];
	   $data['order_num']=$code['mch_billno'];
	   $r=$m->add($data);
	   if(!$r)
	   { 
	   	   //如果数据库执行失败记录日志
	   	   $file = './wxlog/hb.log';
           file_put_contents($file, "\n".'执行日期：'.date('Y-m-d H:i:s')."\n".'红包发放失败缓存记录：'.var_export($data,true)."\n",FILE_APPEND);
          
	   }

	}

	//查看红包的发放情况如果发过就不在重复发送
	public function find_hb($r)
	{
		$order_num=$r[0]['order_num'];
        $data=M()->query("SELECT * FROM pt_hb where mch_billno='$order_num' limit 1");
        $file = './wxlog/hb.log';
        //file_put_contents($file, "\n".'执行日期：'.date('Y-m-d H:i:s')."\n".'查询红包发放记录：'.var_export($data,true)."\n",FILE_APPEND);
        //插入缓存数据库
        //echo M()->getlastsql();
        if(empty($data))
        {
            return true;
        }
        else
        {
        	return false;
        }
        
	}

    public function pe_post($strXml) 
    {

        $url='https://api.mch.weixin.qq.com/mmpaymkttransfers/sendredpack';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);

        //因为微信红包在使用过程中需要验证服务器和域名，故需要设置下面两行
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true); // 只信任CA颁布的证书
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2); // 检查证书中是否设置域名，并且是否与提供的主机名匹配


        curl_setopt($ch, CURLOPT_SSLCERT,getcwd().'/zs/apiclient_cert.pem');
        curl_setopt($ch, CURLOPT_SSLKEY,getcwd().'/zs/apiclient_key.pem');
        curl_setopt($ch, CURLOPT_CAINFO, getcwd().'/zs/rootca.pem'); // CA根证书（用来验证的网站证书是否是CA颁布）


        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $strXml);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $res = curl_exec($ch);
        curl_close($ch);
        return $res;
    }

    public function hb($re_openid,$money,$order)
    {
        Vendor("Hb.commonUtil");
        Vendor("Hb.WxHongBaoHelper"); 
        
        $commonUtil = new \commonUtil();
        $wxHongBaoHelper = new \WxHongBaoHelper();
        $wxHongBaoHelper->setParameter("nonce_str", $this->great_rand());//随机字符串，丌长于 32 位
        $wxHongBaoHelper->setParameter("mch_billno",$order);//订单号
        $wxHongBaoHelper->setParameter("mch_id", '1383702202');//商户号
        $wxHongBaoHelper->setParameter("wxappid", 'wx956afd00e7aa450d');
        $wxHongBaoHelper->setParameter("nick_name", '智诚');//提供方名称
        $wxHongBaoHelper->setParameter("send_name", '智诚');//红包发送者名称
        $wxHongBaoHelper->setParameter("re_openid", $re_openid);//相对于医脉互通的openid
        $wxHongBaoHelper->setParameter("total_amount", $money);//付款金额，单位分
        $wxHongBaoHelper->setParameter("min_value", $money);//最小红包金额，单位分
        $wxHongBaoHelper->setParameter("max_value", $money);//最大红包金额，单位分
        $wxHongBaoHelper->setParameter("total_num", 1);//红包収放总人数
        $wxHongBaoHelper->setParameter("wishing", '恭喜发财');//红包祝福诧
        $wxHongBaoHelper->setParameter("client_ip", '127.0.0.1');//调用接口的机器 Ip 地址
        $wxHongBaoHelper->setParameter("act_name", '红包活动');//活劢名称
        $wxHongBaoHelper->setParameter("remark", '快来抢！');//备注信息
        $postXml = $wxHongBaoHelper->create_hongbao_xml();
        $url = 'https://api.mch.weixin.qq.com/mmpaymkttransfers/sendredpack';
        $responseXml = $this->pe_post($postXml);
        
        echo "<pre>";
        echo htmlentities($responseXml,ENT_COMPAT,'UTF-8');
        $responseObj = simplexml_load_string($responseXml, 'SimpleXMLElement', LIBXML_NOCDATA);
        file_put_contents('./wxlog/hb.log',"\n".'执行日期：'.date('Y-m-d H:i:s')."\n".'微信反回原始数据 : '.var_export($responseObj,true)."\n",8);
        $data=json_encode($responseObj);
        $data=json_decode($data,true);
        return $data;

        
    }

    /**
     * 生成随机数
     */     
    public function great_rand()
    {
        $str = '1234567890abcdefghijklmnopqrstuvwxyz';
        for($i=0;$i<30;$i++)
        {
            $j=rand(0,35);
            $t1 .= $str[$j];
        }
        return $t1;    
    }
    //测试发红包
    public function test()
    {
        
        // Vendor("Wx.Api");
        // Vendor("Wx.JsApiPay");  
        // //获取用户openid
        // $tools = new \JsApiPay();
        // $id = $tools->GetOpenid($_GET);
        $money=100;
        $order=date('YmdHis').rand(1000, 9999);
        $id='o6g94w1AMPsuU_5mFoZUgbKSosYA';
        //echo $id;
        //file_put_contents('./wxlog/wx.log',"\n".'执行日期：'.date('Y-m-d H:i:s')."\n".'微信openid : '.$openId."\n",8);
        $r=$this->hb($id,$money,$order);
        file_put_contents('./wxlog/hb.log',"\n".'执行日期：'.date('Y-m-d H:i:s')."\n".'微信反回对象 : '.var_export($r,true)."\n",8);
    }
    
}