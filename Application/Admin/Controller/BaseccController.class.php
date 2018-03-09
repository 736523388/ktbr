<?php
namespace Admin\Controller;
use Common\Controller\AdminBaseController;
/**
 * 后台菜单管理
 */
class BaseccController extends AdminBaseController{
	/**
	 * 菜单列表
	 */
	public function index(){
		if(IS_POST){
			$data=I('post.');
			$map=[
			'web_id'=>1,
			];
			$img=$this->uploads_ss();
			if(!empty($img)){
				$data=array_merge_recursive($data, $img);
			}
			
			$result=M('Base')->where($map)->save($data);
            if($result!==false){
                $this->success('修改成功');
            }else{
            	$this->error('修改失败');
            }
		}else{
            $basecc=M('Base')->find();
			$res=[
	           'info'=>$basecc,
			];
			$this->assign($res);
			$this->display();
		}
	}
}
