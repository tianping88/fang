<?php
namespace Common\Model;
use Common\Model\CommonModel;
class JzEmployeeModel extends CommonModel {

	protected $_auto = array (
		array ('create_time', 'gettime', 1,'callback' ), 	// 增加的时候调用回调函数
		array ('update_time', 'gettime', 3 ,'callback'),
        //array ('uid','get_current_admin_id',1,'function'), 
	);
    //自动验证
    protected $_validate = array(
        //array(验证字段,验证规则,错误提示,验证条件,附加规则,验证时间)
        array('ename', 'require', '联系人不能为空！', 1, 'regex', CommonModel:: MODEL_BOTH ),
        array('ephone', 'require', '联系电话不能为空！', 1, 'regex', CommonModel:: MODEL_BOTH ),
        array('title', 'require', '房源标题不能为空！', 1, 'regex', CommonModel:: MODEL_BOTH ),
        array('xqname', 'require', '小区名称不能为空！', 1, 'regex', CommonModel:: MODEL_BOTH ),
        array('address', 'require', '地址不能为空！', 1, 'regex', CommonModel:: MODEL_BOTH ),
        
        //array('eskill', 'require', '配套设施不能为空！', 1, 'regex', CommonModel:: MODEL_BOTH ),
        
    );
	protected function gettime(){
	   return NOW_TIME;
	}
	protected function _before_write(&$data) {
		parent::_before_write($data);
	}
}