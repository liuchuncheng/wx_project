<?php
namespace Back\Controller;
use Back\Controller\BaseController;
class indexController extends BaseController 
{
	//财务管理
    public function index()
    {
        $shouru=M()->query("SELECT SUM(pay_money) as sr from pt_order where status=2 and sid='{$_SESSION['id']}'");
        $zhichu=M()->query("SELECT SUM(price) as zc from pt_hb where sid='{$_SESSION['id']}' ");
        $sr=$shouru[0]['sr']/100;
        $zc=$zhichu[0]['zc']/100;
        $this->assign('sr',$sr);
        $this->assign('zc',$zc);
        $this->display(); // 输出模板
    }
     
  	/**
  	 * 店铺账号列表
  	 */
  	public function shoplist(){
  			$model = D('shop');
  		 
        $p=isset($_GET['p']) ? $_GET['p'] : 0;
        // 实例化User对象// 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取
        $list = $model->where('status=1')->order(array('time'=>'desc'))->page($p.',2')->select();
		    $count      = $model->where('status=1')->count();// 查询满足要求的总记录数 $map表示查询条件
		    $page = new \Think\Page($count, 2);
		    $show       = $page->show();// 分页显示输出
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
		  $pwd = md5(md5($data['pwd'].$salt));

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

    $data['status'] = '2';
		if($id) $del = $model->where('id ='.$id)->save($data);
		if($del)  $this->success('删除成功');

  	}

  	/**
  	 * 商品列表
  	 */
  	public function goodslist(){
  		  $model = D('goods');
        $shopmodel = D('shop');
       
        $p=isset($_GET['p']) ? $_GET['p'] : 0;
        $where=['status'=>1];
        $list =$model->table('pt_goods a')->join('pt_shop b on a.sid=b.id')->field('a.*,b.shopname as shop_name')->where(array('a.status'=>1,'a.sid'=>$_SESSION['id']))->order(array('a.id'=>'desc'))->page($p.',2')->select();
        //echo M()->getlastsql();
        $count = $model->table('pt_goods a')->join('pt_shop b on a.sid=b.id')->field('a.*,b.shopname as shop_name')->where(array('a.status'=>1,'a.sid'=>$_SESSION['id']))->count();
        $page = new \Think\Page($count, 2);
        $show = $page->show();// 分页显示输出
	      $this->assign('list',$list);// 赋值数据集
	      $this->assign('page',$show);// 赋值分页输出


  		  $this->display();
  	}

  	/**
  	 * 添加商品
  	 */
  	public function goodsadd(){
  		$shopmodel = D('shop');

  		$id = I('get.id');
  		$model = D('goods');

  		if($id){
  			$data = $model->find($id);
  			$this->assign('data',$data);
  		}

  		$data = $shopmodel->where('status=1')->select();

  		$this->assign('shop',$data);
  		$this->display();
  	}

  	/**
  	 * 修改商品
  	 */
  	public function goodsedit(){
  		$model = D('goods');
  		$data = I('post.');
		  $id = $data['id'];

  		if(!empty($_FILES)){
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
  		}
  		

  		if($id){
  			$insert = $model->where('id ='.$id)->save($data);
  		}else{
  			$insert = $model->add($data);
  		}

      	if($insert){
  			$this->success('成功',U('back/index/goodslist'));
  		}else{
  			$this->error('失败');
  		}
  	}

  	/**
  	 * 删除商品
  	 */
  	public function goodsdel(){
  		$model = D('goods');
		  $id = I('get.id');

  		$data['status'] = '2';
      if($id) $del = $model->where('id ='.$id)->save($data);
  		if($del)  $this->success('删除成功',U('back/index/goodslist'));
  	}

  	/**
     * 上传首页图片
     */
  	public function  img(){
        $model = D('banner');

        $list = $model->order('id')->select();

        $this->assign('list',$list);
  	    $this->display('showimg');
    }

    /**
     * 执行上传
     */
    public function uploadimg(){
      $data = I('post.');
      $id = $data['id'];
      $model = D('banner');

      if(!empty($_FILES)){
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
      }

      $data['createtime'] = time();
      if($id){
        $insert = $model->where('id ='.$id)->save($data);
      }else{
        $insert = $model->add($data);
      }

      if($insert){
        $this->success('成功',U('back/index/img'));
      }else{
        $this->error('失败');
      }

    }

    /**
     * 图片编辑
     */
    public function editimg(){

      $model = D('banner');

      $id = I('get.id');

      $data = $model->find($id);
      $list = $model->order('id')->select();

      $this->assign('list',$list);
      $this->assign('data',$data);
      $this->display();
    }

    /**
     * 图片删除
     */
    public function delimg(){
      $model = D('banner');
      $id = I('get.id');

      if($id) $del = $model->delete($id);
      if($del)  $this->success('删除成功',U('back/index/img'));
    }

    /**
     * 员工管理
     */
    public function staff(){
      $model = D('user');
      $where=['level'=>1,'is_delete'=>1,'sid'=>$_SESSION['id']];
      
      $p=isset($_GET['p']) ? $_GET['p'] : 0;
        // 实例化User对象// 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取
      $list = $model->where($where)->order(array('id'=>'desc'))->page($p.',2')->select();
      $count      = $model->where($where)->count();// 查询满足要求的总记录数 $map表示查询条件
      $page = new \Think\Page($count, 2);
      $show       = $page->show();// 分页显示输出
      $this->assign('list',$list);// 赋值数据集
      $this->assign('page',$show);// 赋值分页输出
      $this->assign('list',$list);
      $this->display();
    }

    /**
     * 添加员工
     */
    public function staffadd(){
      $id  = I('get.id');
      $model = D('user');

      if($id) $data = $model->where('id ='.$id)->find();  $this->assign('data',$data); 
      $this->display();
    }

    /**
     * 员工添加与修改
     */
    public function staffedit(){
      $data = I('post.');
      $model = D('user');

      //sid需要登录后获取，暂时给定一个值做测试
      $data['sid'] = 94;
      $data['level'] = 1;
      $data['time'] = time();

      if($data['id']){
          $result = $model->where('id ='.$data['id'])->save($data);
      }else{
         $result = $model->add($data);
      }
     

      if($result){
        $this->success('成功',U('back/index/staff'));
      }else{
        $this->error('失败');
      }
    }

    /**
     * 删除员工
     */
    
    public function staffdel(){
      $id = I('get.id');
      $model = D('user');

      $data['is_delete'] = 2;
      $del = '';

      if($id) $del = $model->where('id ='.$id)->save($data);

      if($del){
        $this->success('删除成功',U('back/index/staff'));
      }else{
        $this->error('删除失败');
      }
    }


    /**
     * 导入excel
     */
    public function reportexcel(){
             $file = $_FILES;
             //上传
             $path = $this->upload($file);
             //读取excel
             $arr = $this->excel($path, 0);

             foreach ($arr as $key => $value) {
                $list[$key] = array_filter($value);
                if(empty($list[$key])){
                  unset($list[$key]);
                }
             }
             //实例化模型
             $model = D('user');
             //添加的数据
             $data = [];
             for($i=3; $i<=count($list); $i++){
                 $data = ['name'=>$list[$i]['A'], 'phone'=>$list[$i]['B'],'sex'=>$list[$i]['C'],'sid'=>'94','level'=>'1'];
                 $insert =$model->add($data);
             }
              if($insert){
                $this->success('插入成功',U('back/index/staff'));
             }else{
                $this->error('插入失败');
             }
    }

    /**
     * 上传文件
     */
     public function upload(){
          $upload = new \Think\Upload();// 实例化上传类
         $upload->maxSize = 3145728 ;// 设置附件上传大小
         $upload->exts = array( 'xls');// 设置附件上传类型
         $upload->rootPath = 'Uploads/'; // 设置附件上传根目录
         $upload->savePath = 'xls/'; // 设置附件上传（子）目录
         // 上传文件
         $info = $upload->upload();
          if(!$info) {// 上传错误提示错误信息
            $this->error($upload->getError());
          }
          return 'Uploads/'.$info['report']['savepath'].$info['report']['savename'];
      }
    
    /**
     * 获取excel数据
     */
     public function excel($filePath='', $sheet=0){
         
         vendor("phpexcel.PHPExcel");
         vendor("phpexcel.PHPExcel.Reader.Excel5");
         vendor("phpexcel.PHPExcel.Reader.Excel2007");
 
         if(empty($filePath) or !file_exists($filePath)){die('file not exists');}
         $PHPReader = new \PHPExcel_Reader_Excel2007();        //建立reader对象
         if(!$PHPReader->canRead($filePath)){
             $PHPReader = new \PHPExcel_Reader_Excel5();
             if(!$PHPReader->canRead($filePath)){
                  echo 'no Excel';
                 return ;
             }
         }
         $PHPExcel = $PHPReader->load($filePath);        //建立excel对象
         $currentSheet = $PHPExcel->getSheet($sheet);        //**读取excel文件中的指定工作表*/
         $allColumn = $currentSheet->getHighestColumn();        //**取得最大的列号*/
         $allRow = $currentSheet->getHighestRow();        //**取得一共有多少行*/
         $data
          = array();
         for($rowIndex=1;$rowIndex<=$allRow;$rowIndex++){        //循环读取每个单元格的内容。注意行从1开始，列从A开始
             for($colIndex='A';$colIndex<=$allColumn;$colIndex++){
                 $addr = $colIndex.$rowIndex;
                 $cell = $currentSheet->getCell($addr)->getValue();
                 if($cell instanceof PHPExcel_RichText){ //富文本转换字符串
                     $cell = $cell->__toString();
                 }
                 $data[$rowIndex][$colIndex] = $cell;
             }
         }
         return $data;
     }

     /**
      * 店铺总订单管理
      */
     public function order(){
        $User = D('order'); 
        $p=isset($_GET['p']) ? $_GET['p'] : 0;
        $where=['status'=>2,'sid'=>$_SESSION['id']];
        $list = $User->where($where)->order(array('pay_time'=>'desc'))->page($p.',2')->select();
        $count = $User->where($where)->count();
        $Page = new \Think\Page($count,2); 
        $this->assign('list',$list);
        $show = $Page->show();
        $this->assign('page',$show);
        $this->display();
        
     } 
      /**
      * 分享订单管理
      */
     public function share_order(){
        $User = D('order'); 
        $p=isset($_GET['p']) ? $_GET['p'] : 0;
        $openid=$_GET['share_openid'];
        $where=['status'=>2,'sid'=>$_SESSION['id'],'share_openid'=>$openid];
        $list = $User->where($where)->order(array('pay_time'=>'desc'))->page($p.',2')->select();
        $count = $User->where($where)->count();
        $Page = new \Think\Page($count,2); 
        $this->assign('list',$list);
        $show = $Page->show();
        $this->assign('page',$show);
        $this->display();
        
     }
}