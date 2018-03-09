<?php
namespace Admin\Controller;
use Common\Controller\AdminBaseController;
/**
 * 后台菜单管理
 */
class VideoController extends AdminBaseController{
	public function brand(){
		$data=M('VideoBrand')->order('sort')->select();
		$this->assign('data',$data);
		$this->display();
	}
	public function add_brand(){
		$data=I('post.');
		unset($data['id']);
		$result=D('VideoBrand')->addData($data);
		if ($result) {
			$this->success('添加成功',U('Admin/Video/brand'));
		}else{
			$this->error('添加失败');
		}
	}
	public function edit_brand(){
		$data=I('post.');
		$map=array(
			'id'=>$data['id']
			);
		$result=D('VideoBrand')->editData($map,$data);
		if ($result) {
			$this->success('修改成功',U('Admin/Video/brand'));
		}else{
			$this->error('修改失败');
		}
	}
	public function delete_brand(){
		$id=I('get.id');
		$map=array(
			'id'=>$id
			);
		$result=D('VideoBrand')->deleteData($map);
		if($result){
			$this->success('删除成功',U('Admin/Video/brand'));
		}else{
			$this->error('删除失败');
		}
	}
	public function order_brand(){
		$data=I('post.');
		$result=D('VideoBrand')->orderData($data,'id','sort');
		if ($result) {
			$this->success('排序成功',U('Admin/Video/brand'));
		}else{
			$this->error('排序失败');
		}
	}
	public function industry(){
		$data=M('VideoIndustry')->order('sort')->select();
		$this->assign('data',$data);
		$this->display();
	}
	public function add_industry(){
		$data=I('post.');
		unset($data['id']);
		$result=D('VideoIndustry')->addData($data);
		if ($result) {
			$this->success('添加成功',U('Admin/Video/industry'));
		}else{
			$this->error('添加失败');
		}
	}
	public function edit_industry(){
		$data=I('post.');
		$map=array(
			'id'=>$data['id']
			);
		$result=D('VideoIndustry')->editData($map,$data);
		if ($result) {
			$this->success('修改成功',U('Admin/Video/industry'));
		}else{
			$this->error('修改失败');
		}
	}
	public function delete_industry(){
		$id=I('get.id');
		$map=array(
			'id'=>$id
			);
		$result=D('VideoIndustry')->deleteData($map);
		if($result){
			$this->success('删除成功',U('Admin/Video/industry'));
		}else{
			$this->error('删除失败');
		}
	}
	public function order_industry(){
		$data=I('post.');
		$result=D('VideoIndustry')->orderData($data,'id','sort');
		if ($result) {
			$this->success('排序成功',U('Admin/Video/industry'));
		}else{
			$this->error('排序失败');
		}
	}

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
    	$likename=I('get.likename');//模糊查询条件
    	$brand_id=I('get.brand_id');//品牌视频
    	$industry_id=I('get.industry_id');//行业分类
    	$budget=I('get.budget');//预算 1：5000内，2：:5000-10000，3:1-3万，4:3-5万，5:5-10万，6:10万以上
    	$times=I('get.times');//视频时长 1 1min内 2:1-3min 3:3-5分 4:5min以上
    	$map=[];
    	if(!empty($likename)){
    		$map['title']=array('like','%'.$likename.'%');
    	}
    	if(!empty($brand_id)){
    		$map['brand']=$brand_id;
    	}
    	if(!empty($industry_id)){
    		$map['industry']=$industry_id;
    	}
    	if(!empty($budget)){
    		$map['budget']=$budget;
    	}
    	if(!empty($times)){
    		switch ($times) {
    			case 1:
    				$map['times']=array('lt','00:01:00');
    				break;
    			case 2:
    				$map['times']=array(['gt','00:00:59'],['lt','00:03:00']);
    				break;
    			case 3:
    				$map['times']=array(['gt','00:02:59'],['lt','00:05:00']);
    				break;
    			case 4:
    				$map['times']=array('gt','00:04:59');
    				break;
    			default:
    				# code...
    				break;
    		}
    	}
    	$data=D('Video')->getLists($map);
		//品牌分类
		$brand=M('VideoBrand')->order('sort')->select();
		$industry=M('VideoIndustry')->order('sort')->select();
		$assign=[
            'list'=>$data['list'],
            'page'=>$data['page'],
            'brand'=>$brand,
            'industry'=>$industry,
            'likename'=>$likename,
            'brand_id'=>$brand_id,
            'industry_id'=>$industry_id,
            'budget'=>$budget,
            'times'=>$times,
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
    		if($_FILES['thumb']['name']){    //images 是你上传的名称
    			$thumb=$this->uploads();
    			if(empty($thumb)){
    				$this->error('上传图片出错');
    			}
            }
            $path=false;
            $times=false;
            if($_FILES['file']['tmp_name']){    //images 是你上传的名称
            	Vendor('FFmpeg.FFmpeg');
			    $FFmpeg=new \FFmpeg();
    			$times=$FFmpeg->video_length($_FILES["file"]["tmp_name"]);
    			$path=$this->uploads_video();
    			if(empty($path)){
    				$this->error('上传视频出错');
    			}
    			
            }
    		$data=I('post.');
    		if($thumb){
    			$data['thumb']=$thumb;
    		}
    		if($path){
    			$data['path']=$path;
    		}
    		if($times){
    			$data['times']=$times;
    		}
    		// p($data);exit;
    		$Video=M('Video');
    		if(empty($data['id'])){
               $result=$Video->add($data);
    		}else{
    			$map=array('id'=>$data['id']);
    			unset($data['id']);
               $result=$Video->where($map)->save($data);
    		}
    		if($result!==false){
                $this->success('操作成功',U('Admin/Video/lists'));
    		}else{
    			$this->error('操作失败');
    		}
    	}else{
    		$id=I('get.id');
	    	$info=false;
	    	if(!empty($id)){
	    		$info=M('Video')->find($id);
	    	}
	    	$brand=M('VideoBrand')->order('sort')->select();
	    	$industry=M('VideoIndustry')->order('sort')->select();
	    	$res=[
               'id'=>$id,
               'info'=>$info,
               'brand'=>$brand,
               'industry'=>$industry,
	    	];
	    	$this->assign($res);
	    	$this->display();
    	}
	}

	/**
	 * 删除菜单
	 */
	public function delete(){
		$id=I('get.id');
		$result=M('Video')->delete($id);
		if($result){
			$this->success('删除成功',U('Admin/Video/lists'));
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
