<?php
namespace Common\Model;
use Common\Model\CommonModel;
class JzReorderModel extends CommonModel {

	protected $_auto = array (
		array ('create_time', 'time', 1,'function' ), 	// 增加的时候调用回调函数
		array ('update_time', 'time', 3 ,'function'),
        
        
	);
	//自动验证
	protected $_validate = array(
			//array(验证字段,验证规则,错误提示,验证条件,附加规则,验证时间)	
			
            array('cname', 'require', '联系人不能为空！', 1, 'regex', CommonModel:: MODEL_BOTH ),
        array('address', 'require', '地址不能为空！', 1, 'regex', CommonModel:: MODEL_BOTH ),
        array('phone', 'require', '电话不能为空！', 1, 'regex', CommonModel:: MODEL_BOTH ),
	);
	protected function _before_write(&$data) {
		parent::_before_write($data);
	}
}