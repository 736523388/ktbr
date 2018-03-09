<?php
namespace Home\Controller;
use Common\Controller\HomeBaseController;
/**
 * 商城首页Controller
 */
class AnliController extends HomeBaseController{
	/**
	 * 首页
	 */
	public function index(){

		$oid=I('get.oid') ? I('get.oid') : 0;
		$mid=I('get.mid') ? I('get.mid') : 0;
		// echo $oid;exit;
		$map=['show'=>1];
		if(!empty($oid)){
			$map['category_id']=$oid;
		}
		$nowyears=date('Y',time());
		$str='-01-01';
		$str2='-12-31';
		if(!empty($mid)){
			switch ($mid) {
				case 1:
					$starttime=$nowyears.$str;
					break;
				case 2:
					$starttime=($nowyears-1).$str;
					$endtime=($nowyears-1).$str2;
					break;
				case 3:
					$starttime=($nowyears-2).$str;
					$endtime=($nowyears-2).$str2;
					break;
				case 4:
					$starttime=($nowyears-3).$str;
					$endtime=($nowyears-3).$str2;
					break;
				case 5:
					$starttime=($nowyears-4).$str;
					$endtime=($nowyears-4).$str2;
					break;
				case 6:
					$starttime=($nowyears-5).$str;
					$endtime=($nowyears-5).$str2;
					break;
				case 7:
					$starttime=($nowyears-6).$str;
					$endtime=($nowyears-6).$str2;
					break;
			}
		}
		if(!empty($starttime)){
			if(!empty($endtime)){
			    $map['service_time']=array(['lt',$endtime],['gt',$starttime]);
		    }else{
		    	$map['service_time']=array('gt',$starttime);
		    }
		}
		$pagesize=12;
		$Case = M('Case'); 
		$count      = $Case->where($map)->count();
		$Page       = new \Think\Page($count,$pagesize);
		
		$page_tpl = urlencode('[PAGE]'); 
        $Page->url   =   U("anli/{$oid}-{$mid}-{$page_tpl}");
        $show       = $Page->show();
        // echo U("Anli/index/{$oid}-{$mid}-{$page_tpl}");exit;
		$list = $Case->where($map)->order('sort,create_time desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		if(!empty($list)){
			foreach ($list as $key => &$value) {
				$value['label']=explode(",",$value['label']);
			}
		}
		$category=M('Category')->where(['open'=>1])->order('sort')->select();
		$res=[
           'category'=>$category,
           'list'=>$list,
           'page'=>$show,
           'oid'=>$oid,
           'mid'=>$mid,
           '_title'=>'经典案例',
		];
		$this->assign($res);
        $this->display();
	}
	public function details(){
		$id=I('get.id');
		if(empty($id)){
			redirect(U('Home/Anli/index'));
		}
		if($info=M('Case')->find($id) and $info['show']==1){
			M('Case')->where(['case_id'=>$id])->setInc('browse');
			$res=[
              'info'=>$info,
              '_title'=>$info['title'],
			];
			$this->assign($res);
            $this->display();
		}else{
			redirect(U('Home/Anli/index'));
		}

	}
}

