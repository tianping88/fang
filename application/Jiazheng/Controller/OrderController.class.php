<?php
/**
 * 前台添加订单页
 */
namespace Jiazheng\Controller;
use Common\Controller\HomeBaseController;
class OrderController extends HomeBaseController {
    //人员详细页
    public function addorder() {
        if(IS_POST){
            $eid=I('post.eid',0);
            $emmodel= M("JzEmployee");
        	$employee=$emmodel->where(array('status'=>1))->find($eid);
            if($employee){            
            }
            else{
                $this->ajaxReturn(sp_ajax_return(array(),"当前人员不能接受预订！",0));
            }
        	
            $order_model=D("Common/JzReorder");
            $data=$order_model->create(); 
             
                if(empty($data)){
                    $this->ajaxReturn(sp_ajax_return(array(),$order_model->getError(),0));
                    
                }
                $data['startdate']=strtotime($data['startdate']);
                //var_dump($data);
                //exit;
    			$result=$order_model->add($data);
    			if ($result) {
    				
    				$this->ajaxReturn(sp_ajax_return(array(),"预订成功！",1));
    			} else {
    				$this->ajaxReturn(sp_ajax_return(array(),"预订失败!",0));
    			}
        }
    	
       
    }  
  
}
