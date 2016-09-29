<?php 
namespace Jiazheng\Controller;
use Common\Controller\HomeBaseController;
class NavController extends HomeBaseController{
    /**
     *  用于后台生成分类菜单
     * 
     */   
    public function navigation(){
		$navcatname="家政分类";
		$datas=sp_get_terms("field:term_id,name;where:taxonomy='jiazheng'");
        if($datas){
            foreach($datas as $k=>$v){
                $datas[$k]['term_id']=$v['term_id'].'-0-0-0-0-0-0-0';
            }
        }
		$navrule=array(
				"action"=>"Jiazheng/Index/baomu",
				"param"=>array(
						"id"=>"term_id"
				),
				"label"=>"name");
		exit(sp_get_nav4admin($navcatname,$datas,$navrule));
		
	}
}