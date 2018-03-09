<?php
namespace Home\Controller;
use Common\Controller\HomeBaseController;
/**
 * 商城首页Controller
 */
class PostController extends HomeBaseController{
	/**
	 * 首页
	 */
	public function index(){

		$id=I('get.id');
		$list=M('Post')->order('sort,create_time desc')->field('id,title,thumb,create_time,abstract,category_id')->select();
		$count=M('Post')->count();
		$postcategory=M('PostCategory')->where(['status'=>1])->order('sort')->select();
		$res=[
           'list'=>$list,
           'postcategory'=>$postcategory,
           'count'=>$count,
           '_title'=>'行业新闻',
		];
		$this->assign($res);
        $this->display();
	}
	public function details(){
		$id=I('get.id');
		$info=M('Post')->find($id);
        if(!$info){
        	exit;
        }
        M('Post')->where(['id'=>$id])->setInc('browse',1);
        $this->assign('info',$info);
        $this->assign('_title',$info['title']);
        $this->display();
	}
}

