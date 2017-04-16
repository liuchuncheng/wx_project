<?php
namespace Back\Controller;

use Think\Controller;
class IndexController extends Controller 
{
	//测试自动载入命名空间auto
    public function index()
    {
         
    }
     
  	/**
  	 * 店铺账号列表
  	 */
  	public function shoplist(){
  			$model = D('shop');
  			$map = 'status =1';
		    $count      = $model->where($map)->count();// 查询满足要求的总记录数 $map表示查询条件
		    $page = new \Think\Page($count, 10);
		    $show       = $page->show();// 分页显示输出
		    // 进行分页数据查询
		    $list = $model->where($map)->order('time')->limit($page->firstRow.','.$page->listRows)->select();
		    $this->assign('list',$list);// 赋值数据集
		    $this->assign('page',$show);// 赋值分页输出
		    $this->display(); // 输出模板
  	}

  	/**
  	 * 添加店铺账号
  	 */
  	public function shopadd(){
  		$id = I('get.id');
  		$model = D('shop');

  		if($id){
  			$data = $model->find($id);
  			$this->assign('data',$data);
  		}
  		$this->display();
  	}

  	/**
  	 * 修改店铺账号
  	 */
  	public function shopedit(){
  		$model = D('shop');
  		$data = I('post.');

  		$salt = substr(uniqid(), -6);
		$pwd = md5(md5($data['pwd']).$salt);

  		$data['pwd'] = $pwd;
  		$data['salt'] = $salt;
  		$data['time'] = time();

  		$id = $data['id'];

  		if($id){
  			$insert = $model->where('id ='.$id)->save($data);
  		}else{
  			$insert = $model->add($data);
  		}


  		if($insert){
  			$this->success('成功',U('back/index/shoplist'));
  		}else{
  			$this->error('失败');
  		}

  	}

  	/**
  	 * 删除店铺账号
  	 */
  	public function shopdel(){
		$model = D('shop');
		$id = I('get.id');

		if($id) $del = $model->delete($id);
		if($del)  $this->success('删除成功');

  	}


  	public function goodslist(){

  		$this->display();
  	}

  	public function goodsadd(){
  		$model = D('shop');

  		$data = $model->where('status=1')->select();

  		$this->assign('shop',$data);
  		$this->display();
  	}

  	public function goodsedit(){
  		$data = I('post.');
  		$upload = new \Think\Upload();// 实例化上传类
	    $upload->maxSize   =     3145728 ;// 设置附件上传大小
	    $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
	    $upload->savePath  =     ''; // 设置附件上传根目录
	    $upload->rootPath  =     'Uploads/'; // 设置附件上传根目录
	    $info   =   $upload->upload();
      	if(!$info) {// 上传错误提示错误信息
      		$this->error($upload->getError());
      	}
      	$data['img'] = 'Uploads/'.$info['img']['savepath'].$info['img']['savename'];
      	$data['shop_img'] = 'Uploads/'.$info['shop_img']['savepath'].$info['shop_img']['savename'];
      	var_dump($data);die;
  	}
}