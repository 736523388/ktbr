<?php
namespace Admin\Controller;
use Common\Controller\AdminBaseController;
/**
 * 文章
 */
class ClassicController extends AdminBaseController{
    /**
     * 文章列表
     */
    public function index(){
        $this->display();
    }
    public function category(){
    	$data=M('Category')->order('sort')->select();
		$assign=array(
			'data'=>$data
			);
		$this->assign($assign);
		$this->display();
    }
    /**
	 * 添加分类
	 */
	public function add_category(){
		$data=I('post.');
		unset($data['id']);
		$result=D('AdminCategory')->addData($data);
		if ($result) {
			$this->success('添加成功',U('Admin/Classic/category'));
		}else{
			$this->error('添加失败');
		}
	}
	/**
	 * 修改分类
	 */
	public function edit_category(){
		$data=I('post.');
		$map=array(
			'category_id'=>$data['category_id']
			);
		unset($data['category_id']);
		$result=D('AdminCategory')->editData($map,$data);
		if ($result!==false) {
			$this->success('修改成功',U('Admin/Classic/category'));
		}else{
			$this->error('修改失败');
		}
	}
    /**
	 * 删除菜单
	 */
	public function del_category(){
		$id=I('get.id');
		$map=array(
			'category_id'=>$id
			);
		$result=D('AdminCategory')->deleteData($map);
		if($result){
			$this->success('删除成功',U('Admin/Classic/category'));
		}else{
			$this->error('删除失败');
		}
	}
	/**
	 * 菜单排序
	 */
    public function category_order(){
    	$data=I('post.');
		$result=D('AdminCategory')->orderData($data,'category_id','sort');
		if ($result) {
			$this->success('排序成功',U('Admin/Classic/Category'));
		}else{
			$this->error('排序失败');
		}
    }
    /**
	 * 案例列表
	 */
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
    	$Case=M('Case');
    	$count      = $Case->where($map)->count();// 查询满足要求的总记录数
		$Page       = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数(25)
		$show       = $Page->show();// 分页显示输出
		// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $Case->where($map)->order('create_time')->limit($Page->firstRow.','.$Page->listRows)->select();
		$category=M('category')->where(['open'=>1])->order('sort')->select();
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
	 * 新增编辑案例
	 */
    public function edit_case(){
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
    		$Case=M('Case');
    		if(empty($data['case_id'])){
               $result=$Case->add($data);
    		}else{
    			$map=array('case_id'=>$data['case_id']);
    			unset($data['case_id']);
               $result=$Case->where($map)->save($data);
    		}
    		if($result!==false){
                $this->success('操作成功',U('Admin/Classic/lists'));
    		}else{
    			$this->error('操作失败');
    		}
    	}else{
    		$id=I('get.id');
	    	$info=false;
	    	if(!empty($id)){
	    		$info=M('Case')->find($id);
	    	}
	    	$category=M('category')->where(['open'=>1])->order('sort')->select();
	    	$this->assign(array('id'=>$id,'info'=>$info,'category'=>$category));
	    	$this->display();
    	}
    }
    /**
	 * 删除案例
	 */
	public function del_case(){
		$id=I('get.id');
		$map=array(
			'case_id'=>$id
			);
		$result=D('AdminCase')->deleteData($map);
		if($result){
			$this->success('删除成功',U('Admin/Classic/lists'));
		}else{
			$this->error('删除失败');
		}
	}
	/**
	 * 案例排序
	 */
    public function case_order(){
    	$data=I('post.');
		$result=D('AdminCase')->orderData($data,'case_id','sort');
		if ($result) {
			$this->success('排序成功',U('Admin/Classic/lists'));
		}else{
			$this->error('排序失败');
		}
    }
}