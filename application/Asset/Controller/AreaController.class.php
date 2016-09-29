<?php
namespace Asset\Controller;
use Think\Controller;
class AreaController extends Controller {
	   
    public function search(){
        
        $name = I('xqname'); 
        $where['name']=array('like','%'.$name.'%');
        $where['distid']=I('distid');
        $data=M("JzArea")->where($where)->limit(10)->field('id,name,address')->select();
        $this->ajaxReturn($data);       
        
        
    }
    
    

}
