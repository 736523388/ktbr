<?php
namespace Common\Model;
use Common\Model\BaseModel;
/**
 * 菜单操作model
 */
class VideoModel extends BaseModel{
    /**
     * 获取数据
     * @param  string $nickname  模糊查询
     * @param  string $brand 品牌视频
     * @param  string $industry 行业视频   
     * @param  string $budget 视频时长   
     * @param  string $limit 每页显示条数 
     * @param  string $page 页码 
     * @return array         结构数据
     */
    public function getLists($map=null){
    	$count      = $this->where($map)->count();// 查询满足要求的总记录数
		$Page       = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数(25)
		$show       = $Page->show();// 分页显示输出
		// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $this->where($map)->order('create_time desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		$result=[
           'page'=>$show,
           'list'=>$list,
		];
		return $result;
    }
}
