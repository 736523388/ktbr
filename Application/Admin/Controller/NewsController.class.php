<?php
namespace Admin\Controller;
use Common\Controller\AdminBaseController;
/**
 * 后台菜单管理
 */
class NewsController extends AdminBaseController{
	/**
	 * 菜单列表
	 */
	public function index(){
		$data=D('AdminNav')->getTreeData('tree','order_number,id');
		$assign=array(
			'data'=>$data
			);
		$this->assign($assign);
		$this->display();
	}
    public function lists(){
    	$likename=I('get.likename');
    	$category_id=I('get.category_id');
    	$map=[];
    	if(!empty($likename)){
    		$map['title']=array('like','%'.$likename.'%');
    	}
    	if(!empty($category_id)){
    		$map['category_id']=$category_id;
    	}
    	$Post=M('Post');
    	$count      = $Post->where($map)->count();// 查询满足要求的总记录数
		$Page       = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数(25)
		$show       = $Page->show();// 分页显示输出
		// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $Post->where($map)->order('create_time')->limit($Page->firstRow.','.$Page->listRows)->select();
		$category=M('PostCategory')->where(['status'=>1])->order('sort')->select();
		$assign=[
            'list'=>$list,
            'page'=>$show,
            'category'=>$category,
            'likename'=>$likename,
            'category_id'=>$category_id,
		];
		$this->assign($assign);
    	$this->display();
    }

	/**
	 * 添加菜单
	 */
	public function add(){
		$data=I('post.');
		unset($data['id']);
		$result=D('AdminNav')->addData($data);
		if ($result) {
			$this->success('添加成功',U('Admin/Nav/index'));
		}else{
			$this->error('添加失败');
		}
	}

	/**
	 * 修改菜单
	 */
	public function edit(){
		if(IS_POST){
    		$thumb=false;
    		if($_FILES['file']['name']){    //images 是你上传的名称
    			$thumb=$this->uploads();
    			if(empty($thumb)){
    				$this->error('上传图片出错');
    			}
            }
    		$data=I('post.');
    		if($thumb){
    			$data['thumb']=$thumb;
    		}
    		$Post=M('Post');
    		if(empty($data['id'])){
               $result=$Post->add($data);
    		}else{
    			$map=array('id'=>$data['id']);
    			unset($data['id']);
               $result=$Post->where($map)->save($data);
    		}
    		if($result!==false){
                $this->success('操作成功',U('Admin/News/lists'));
    		}else{
    			$this->error('操作失败');
    		}
    	}else{
    		$id=I('get.id');
	    	$info=false;
	    	if(!empty($id)){
	    		$info=M('Post')->find($id);
	    	}
	    	$category=M('PostCategory')->where(['status'=>1])->order('sort')->select();
	    	$this->assign(array('id'=>$id,'info'=>$info,'category'=>$category));
	    	$this->display();
    	}
	}

	/**
	 * 删除菜单
	 */
	public function delete(){
		$id=I('get.id');
		$result=M('Post')->delete($id);
		if($result){
			$this->success('删除成功',U('Admin/News/lists'));
		}else{
			$this->error('删除失败');
		}
	}

	/**
	 * 菜单排序
	 */
	public function order(){
		$data=I('post.');
		foreach ($data as $k => $v) {
            $v=empty($v) ? null : $v;
            M('Post')->where(array('id'=>$k))->save(array('sort'=>$v));
        }
			$this->success('排序成功',U('Admin/News/lists'));
	}
	public function category(){
		$data=M('PostCategory')->order('sort')->select();
		$res=[
           'data'=>$data,
		];
		$this->assign($res);
		$this->display();
	}
	public function add_category(){
		$data=I('post.');
		$result=M('PostCategory')->add($data);
		if ($result) {
			$this->success('添加成功',U('Admin/News/category'));
		}else{
			$this->error('添加失败');
		}
	}
	public function delete_category(){
		$id=I('get.id');
		$result=M('PostCategory')->delete($id);
		if($result){
			$this->success('删除成功',U('Admin/News/category'));
		}else{
			$this->error('删除失败');
		}
	}
	public function order_category(){
		$data=I('post.');
		foreach ($data as $k => $v) {
            $v=empty($v) ? null : $v;
            M('PostCategory')->where(array('id'=>$k))->save(array('sort'=>$v));
        }
		$this->success('排序成功',U('Admin/News/category'));
	}
    public function edit_category(){
    	$data=I('post.');
		$map=array(
			'id'=>$data['id']
			);
		$result=M('PostCategory')->where($map)->save($data);
		if ($result) {
			$this->success('修改成功',U('Admin/News/category'));
		}else{
			$this->error('修改失败');
		}
    }

}
