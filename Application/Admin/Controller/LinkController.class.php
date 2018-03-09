<?php
namespace Admin\Controller;
use Common\Controller\AdminBaseController;
/**
 * 后台菜单管理
 */
class LinkController extends AdminBaseController{
	/**
	 * 菜单列表
	 */
	public function index(){
		$Link=M('Link');
    	$count      = $Link->count();// 查询满足要求的总记录数
		$Page       = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数(25)
		$show       = $Page->show();// 分页显示输出
		// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $Link->order('sort')->limit($Page->firstRow.','.$Page->listRows)->select();
		$assign=[
            'list'=>$list,
            'page'=>$show,
		];
		$this->assign($assign);
    	$this->display();
	}

	/**
	 * 添加菜单
	 */
	public function add(){
		$data=I('post.');
		if($_FILES['file']['name']){    //images 是你上传的名称
    			$thumb=$this->uploads();
    			if(empty($thumb)){
    				$this->error('上传图片出错');
    			}else{
    				$data['thumb']=$thumb;
    			}
            }
		$result=D('AdminLink')->addData($data);
		if ($result) {
			$this->success('添加成功',U('Admin/Link/index'));
		}else{
			$this->error('添加失败');
		}
	}

	/**
	 * 修改菜单
	 */
	public function edit(){
		$data=I('post.');
		$map=array(
			'id'=>$data['id']
			);
	    if($_FILES['file']['name']){    //images 是你上传的名称
    			$thumb=$this->uploads();
    			if(empty($thumb)){
    				$this->error('上传图片出错');
    			}else{
    				$data['thumb']=$thumb;
    			}
        }
		$result=D('AdminLink')->editData($map,$data);
		if ($result) {
			$this->success('修改成功',U('Admin/Link/index'));
		}else{
			$this->error('修改失败');
		}
	}

	/**
	 * 删除菜单
	 */
	public function delete(){
		$id=I('get.id');
		$map=array(
			'id'=>$id
			);
		$result=D('AdminLink')->deleteData($map);
		if($result){
			$this->success('删除成功',U('Admin/Link/index'));
		}else{
			$this->error('删除失败');
		}
	}

	/**
	 * 菜单排序
	 */
	public function order(){
		$data=I('post.');
		$result=D('AdminLink')->orderData($data,'id','sort');
		if ($result) {
			$this->success('排序成功',U('Admin/Link/index'));
		}else{
			$this->error('排序失败');
		}
	}


}
