<?php
namespace Index\Controller;
use Think\Controller;
class CouponController extends Controller 
{
	//优惠券详情
	public function index($id)
	{
        $order=M()->query("SELECT * FROM pt_order where id=$id");
        $gid=$order[0]['gid'];
        $order_num=$order[0]['order_num'];
        $data=M()->query("SELECT a.*,b.name as shop_name FROM pt_goods a left join pt_shop b on a.sid=b.id where a.id = $gid");
		$num=M()->query("SELECT count(*) as num from pt_order where gid=$gid and status=2");
		$this->assign('data',$data);
		$this->assign('num',$num);
		$this->assign('order_num',$order_num);
		$this->display();
	}

}