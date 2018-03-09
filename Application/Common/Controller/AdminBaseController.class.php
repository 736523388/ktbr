<?php
namespace Common\Controller;
use Common\Controller\BaseController;
/**
 * admin 基类控制器
 */
class AdminBaseController extends BaseController{
	/**
	 * 初始化方法
	 */
	public function _initialize(){
		parent::_initialize();
    if(!check_login()){
       $this->error('请先登录',U('/admins'));
    }
		$auth=new \Think\Auth();
		$rule_name=MODULE_NAME.'/'.CONTROLLER_NAME.'/'.ACTION_NAME;
		$result=$auth->check($rule_name,$_SESSION['user']['id']);
		if(!$result){
			$this->error('您没有权限访问');
		}
		// 分配菜单数据
		$nav_data=D('AdminNav')->getTreeData('level','order_number,id');
		$assign=array(
			'nav_data'=>$nav_data
			);
		$this->assign($assign);
	}
    public function uploads(){
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     31457280 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath  =     './Upload/Picture/'; // 设置附件上传根目录
        $upload->savePath  =     ''; // 设置附件上传（子）目录
        $upload->subName   =     array('date', 'Y-m-d');//子目录创建方式，[0]-函数名，[1]-参数，多个参数使用数组
          // 上传文件 
          $info   =   $upload->upload();
          // $url=array();
        //print_r($info);
          if(!$info) {// 上传错误提示错误信息
              //$this->error($upload->getError());
              // echo json_encode(array('error' => 1,'message'=>$upload->getError()));
              return false;
          }else{// 上传成功
              //$this->success('上传成功！');
              $arr=array_keys($info);
              foreach ($info as $key => $value) {
                $url="/Upload/Picture/".$info[$key]['savepath'].$info[$key]['savename'];
              }
          // echo json_encode(array('error'=>0,'path'=>$last_id));
          return $url;
          }
    }
    public function uploads_video(){
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     0 ;// 设置附件上传大小
        $upload->exts      =     array('mp4', '3gp', 'avi', 'rmvb');// 设置附件上传类型
        $upload->rootPath  =     './Upload/Video/'; // 设置附件上传根目录
        $upload->savePath  =     ''; // 设置附件上传（子）目录
        $upload->subName   =     array('date', 'Y-m-d');//子目录创建方式，[0]-函数名，[1]-参数，多个参数使用数组
          // 上传文件 
          $info   =   $upload->upload();
          // $url=array();
        //print_r($info);
          if(!$info) {// 上传错误提示错误信息
              //$this->error($upload->getError());
              // echo json_encode(array('error' => 1,'message'=>$upload->getError()));
              return false;
          }else{// 上传成功
              //$this->success('上传成功！');
              $arr=array_keys($info);
              foreach ($info as $key => $value) {
                $url="/Upload/Video/".$info[$key]['savepath'].$info[$key]['savename'];
              }
          // echo json_encode(array('error'=>0,'path'=>$last_id));
          return $url;
          }
    }
    public function uploads_ss(){
      if(!empty($_FILES)){
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     31457280 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath  =     './Upload/Picture/'; // 设置附件上传根目录
        $upload->savePath  =     ''; // 设置附件上传（子）目录
        $upload->subName   =     array('date', 'Y-m-d');//子目录创建方式，[0]-函数名，[1]-参数，多个参数使用数组
          // 上传文件 
          $info   =   $upload->upload();
          // $url=array();
        //print_r($info);
          if(!$info) {// 上传错误提示错误信息
              //$this->error($upload->getError());
              return false;
          }else{// 上传成功
              $arr=array_keys($info);
              foreach ($info as $key => $value) {
                $data[$key]="/Upload/Picture/".$info[$key]['savepath'].$info[$key]['savename'];
              }
          return $data;
          }
      }
    }



}

