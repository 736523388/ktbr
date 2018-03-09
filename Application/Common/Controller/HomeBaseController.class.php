<?php
namespace Common\Controller;
use Common\Controller\BaseController;
/**
 * Home基类控制器
 */
class HomeBaseController extends BaseController{
	/**
	 * 初始化方法
	 */
	public function _initialize(){
		parent::_initialize();
        //品牌分类
        $brand=M('VideoBrand')->order('sort')->select();
        $industry=M('VideoIndustry')->order('sort')->select();
        $basecc=M('Base')->find(1);
        $link=M('Link')->order('sort')->select();
        $res=[
           'brand'=>$brand,
           'industry'=>$industry,
           'basecc'=>$basecc,
           'link'=>$link,
        ];
        $this->assign($res);
	}




}

