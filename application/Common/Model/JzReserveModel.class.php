<?php
namespace Common\Model;
use Think\Model;
class JzReserveModel extends Model {
	/**
     * 预约订单	 
	 */
	//post_type,post_status注意变量定义格式;
	
	protected $_auto = array (
	       array('create_time', NOW_TIME, self::MODEL_INSERT),
           array('update_time', NOW_TIME, self::MODEL_BOTH),
           array('serve_time', 'strtotime', self::MODEL_BOTH,'function'),
           array('remark', 'htmlspecialchars_decode', self::MODEL_BOTH,'callback'),
	);
	/**
     * 创建时间不写则取当前时间
     * @return int 时间戳
     * @author huajie <banhuajie@163.com>
     */
    protected function getCreateTime(){
        
        return NOW_TIME;
    }
	
	
}