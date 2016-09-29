<?php


/**
 * 中国省市区三级联动插件
 * @author 永川家政网
 */

namespace ChinaCity\Controller;
use Common\Controller\HomeBaseController;

class ChinaCityController extends HomeBaseController
{


    //获取中国省份信息
    public function getProvince()
    {
        if (IS_AJAX) {
            $pid = I('pid'); //默认的省份id

            if (!empty($pid)) {
               // $map['id'] = $pid;这里应该注释掉
            }
            $map['level'] = 1;
            $map['upid'] = 0;
            $list = D('District')->_list($map);

            $data = <<<html
            <option value =''>-省份-</option>
html;
            foreach ($list as $k => $vo) {
                $data .= "<option ";
                if ($pid == $vo['id']) {
                    $data .= " selected ";
                }
                $data .= " value ='" . $vo['id'] . "'>" . $vo['name'] . "</option>";
            }

            $this->ajaxReturn($data);
        }
    }

    //获取城市信息
    public function getCity()
    {
        if (IS_AJAX) {
            $cid = I('cid'); //默认的城市id
            $pid = I('pid'); //传过来的省份id

            if (!empty($cid)) {
                //$map['id'] = $cid;这里应该注释掉
            }
            $map['level'] = 2;
            $map['upid'] = $pid;

            $list = D('District')->_list($map);

            $data = <<< html
            <option value ="">-城市-</option>
html;
            foreach ($list as $k => $vo) {
                $data .= "<option ";
                if ($cid == $vo['id']) {
                    $data .= " selected ";
                }
                $data .= " value ='" . $vo['id'] . "'>" . $vo['name'] . "</option>";
            }
            $this->ajaxReturn($data);
        }
    }

    //获取区县市信息
    public function getDistrict()
    {
        if (IS_AJAX) {
            $did = I('did'); //默认的城市id
            $cid = I('cid'); //传过来的城市id

            if (!empty($did)) {
                //$map['id'] = $did;这里应该注释掉
            }
            $map['level'] = 3;
            $map['upid'] = $cid;

            $list = D('District')->_list($map);

            $data = <<<html
            <option value ="">-州县-</option>
html;
            foreach ($list as $k => $vo) {
                $data .= "<option ";
                if ($did == $vo['id']) {
                    $data .= " selected ";
                }
                $data .= " value ='" . $vo['id'] . "'>" . $vo['name'] . "</option>";
            }
            $this->ajaxReturn($data);
        }
    }

    //获取乡镇信息
    public function getCommunity()
    {
        if (IS_AJAX) {
            $coid = I('coid'); //默认的乡镇id
            $did = I('did'); //传过来的区县市id

            $where['city_id'] = $cid;

            if (!empty($coid)) {
                $map['id'] = $coid;
            }
            $map['level'] = 4;
            $map['upid'] = $did;

            $list = D('District')->_list($map);

            $data = <<<html
            <option value ="">-乡镇-</option>
html;
            foreach ($list as $k => $vo) {
                $data .= "<option ";
                if ($did == $vo['id']) {
                    $data .= " selected ";
                }
                $data .= " value ='" . $vo['id'] . "'>" . $vo['name'] . "</option>";
            }
            $this->ajaxReturn($data);
        }
    }
}
