<?php
namespace Home\Controller;
use Common\Controller\HomeBaseController;
/**
 * 商城首页Controller
 */
class VideoController extends HomeBaseController{
	/**
	 * 首页
	 */
	public function index(){
        // echo I('get.keywords');
        $likename=I('get.keywords');//模糊查询条件
    	$brand_id=I('get.bid') ? I('get.bid') : 0;//品牌视频
    	$industry_id=I('get.iid') ? I('get.iid') : 0;//行业分类
    	$budget=I('get.yid') ? I('get.yid') : 0;//预算 1：5000内，2：:5000-10000，3:1-3万，4:3-5万，5:5-10万，6:10万以上
    	$times=I('get.tid') ? I('get.tid') : 0;//视频时长 1 1min内 2:1-3min 3:3-5分 4:5min以上
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
    	$pagesize=12;
		$Video = M('Video'); 
		$count      = $Video->where($map)->count();
		$Page       = new \Think\Page($count,$pagesize);
		
		$page_tpl = urlencode('[PAGE]'); 
        $Page->url   =   U("category/{$brand_id}-{$industry_id}-{$budget}-{$times}-{$page_tpl}");
        $show       = $Page->show();
        // echo U("Anli/index/{$oid}-{$mid}-{$page_tpl}");exit;
		$list = $Video->where($map)->order('playbacknum desc,create_time desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		//品牌分类
		$brand=M('VideoBrand')->order('sort')->select();
		$industry=M('VideoIndustry')->order('sort')->select();
		$assign=[
            'list'=>$list,
            'page'=>$show,
            'brand'=>$brand,
            'industry'=>$industry,
            'likename'=>$likename,
            'brand_id'=>$brand_id,
            'industry_id'=>$industry_id,
            'budget'=>$budget,
            'times'=>$times,
            '_title'=>'作品案例',
		];
		$this->assign($assign);
    	$this->display();
	}
	public function details(){
        $id=I('get.id');
        $info=M('Video')->find($id);
        if(empty($info)){
            exit;
        }
        M('Video')->where(['id'=>$id])->setInc('playbacknum',1);
        $r=math($info['title']);
        $str='';
        foreach ($r as $key=>$value) {
            $str.='%'.$value.$r[$key+1].'%,';
        }
        $str=trim($str,',');
        
        $map['title'] =array('like',array($str),'OR');
        $map['brand']=$info['brand'];
        $map['industry']=$info['industry'];
        $map['_logic'] = 'OR';
        $where["_complex"] = $map;

        $where['id'] = array('neq',$id);
        $recommend=M('Video')->where($where)->limit(3)->field('id,title,thumb,times')->select();
        $res=[
           'info'=>$info,
           '_title'=>$info['title'],
           'recommend'=>$recommend,
        ];
        $this->assign($res);
		$this->display();
	}
}

