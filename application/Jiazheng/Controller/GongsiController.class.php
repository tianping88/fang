<?php
namespace Jiazheng\Controller;
use Common\Controller\HomeBaseController;
class GongsiController extends HomeBaseController{
    public function index(){
        
        $catid=I('get.id',0);
        
		$term=sp_get_term($catid);
		$tplname=$term["list_tpl"];
    	$tplname=sp_get_apphome_tpl($tplname, "list");        
    	$this->assign($term);
    	$this->assign('cat_id', $catid);
        //var_dump($tplname);
    	$this->display(":list_gongsi");
    }
    public function info(){
        $id=I('get.id',0);
        
        //根据参数生成查询条件
	     $where['status'] = array('eq',1);
         $GongsiModel=M("JzGongsi");
        $info=$GongsiModel->where($where)->find($id);
        //记录用户的操作动作，如 浏览一次 增加一增浏览次数
        $gid="";
        if($info){
           $gid=$info['id']; 
        }
        else{
            $this->error('你所访问的页面不存在或已删除！');
            exit();//这里应该显示未找到相关信息的页面，或错误页面
        }
        
        $expire=strtotime(date("Y-m-d",strtotime("+1 day")))-time();//到凌晨0：0：0的时间间隔，也就是在0点过期              
        $should_change_post_hits=sp_check_user_action("jiazhenggongsi$gid",99999,true,$expire);//同一IP，一天只能增加一次，在0点后过期
        
    	if($should_change_post_hits){    		
    		$GongsiModel->save(array("id"=>$gid,"hits"=>array("exp","hits+1")));
            $info['hits']=$info['hits']+1;
    	}
        
        //上下文章链接
        $next=$GongsiModel->where(array("id"=>array("gt",$gid), "status"=>1,'item'=>$info['item']))->order("id asc")->find();
    	$prev=$GongsiModel->where(array("id"=>array("lt",$gid), "status"=>1,'item'=>$info['item']))->order("id desc")->find();
    	
    	 
    	$this->assign("next",$next);
    	$this->assign("prev",$prev);
        
        $this->assign($info);
        $this->display(":gongsi_info");
    }
   
}