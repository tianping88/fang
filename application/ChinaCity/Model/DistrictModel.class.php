<?php

namespace ChinaCity\Model;
use Think\Model;

/**
 * 全国城市乡镇信息模型
 */
class DistrictModel extends Model{
    //自动验证
	protected $_validate = array(
			//array(验证字段,验证规则,错误提示,验证条件,附加规则,验证时间)
			array('name', 'require', '名称不能为空！', 1, 'regex', 3),
            
			//array('desc', 'require', '描述不能为空！', 1, 'regex', 3),
            
            //array('catid', 'require', '分类不能为空！', 1, 'regex', 3),
           
            array('pinyin', 'require', '名称的拼音不能为空！', 1, 'regex', 3),
            array('pinyin', '', '名称的拼音不能重复！', 1, 'unique', 3),
            
	);
	public function _list($map){
		$order = 'sorts ASC';
		$data = $this->where($map)->cache(true)->order($order)->select();
		return $data;
	}
    public function getdistrict_byid($id){
        return $this->cache(true)->find($id);
    }
    public function getdistrict_bypinyin($pinyin){
        return $this->where(array('pinyin'=>$pinyin))->cache(true)->find();
    }
}
