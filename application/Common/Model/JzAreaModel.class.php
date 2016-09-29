<?php
namespace Common\Model;
use Common\Model\CommonModel;
class JzAreaModel extends CommonModel
{
	
	//自动验证
	protected $_validate = array(
			//array(验证字段,验证规则,错误提示,验证条件,附加规则,验证时间)
			array('name', 'require', '名称不能为空！', 1, 'regex', 3),
            array('name', '', '名称不能重复！', 1, 'unique', 3),
			//array('desc', 'require', '描述不能为空！', 1, 'regex', 3),
            array('distid', 'require', '区域不能为空！', 1, 'regex', 3),
            //array('catid', 'require', '分类不能为空！', 1, 'regex', 3),
            array('catid', array('1','2'), '分类不在范围内！', 1, 'in', 3),
            array('pinyin', 'require', '名称的拼音不能为空！', 1, 'regex', 3),
            array('pinyin', '', '名称的拼音不能重复！', 1, 'unique', 3),
            array('firstchar', 'require', '拼音首字母不能为空！', 1, 'regex', 3),
	);
	
	protected function _before_write(&$data) {
		parent::_before_write($data);
	}
	public function getarea_byid($id){
	   return $this->cache(true)->find($id);
	}
    public function getarea_bypinyin($pinyin){
	   return $this->where(array('pinyin'=>$pinyin))->cache(true)->find();
	}
}




