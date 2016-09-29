<?php
namespace Admin\Controller;
use Common\Controller\AdminbaseController;
class AreaController extends AdminbaseController{
	
	protected $area_model;
	protected  $targets=array("_blank"=>"新标签页打开","_self"=>"本窗口打开");
	
	function _initialize() {
		parent::_initialize();
		$this->area_model = D("Common/JzArea");
	}
	
	function index(){
		$distid=intval(I("get.distid"));
        $where=array();
        if($distid){
            $where['distid']=$distid;
        }
        $count=$this->area_model->where($where)->count();
		$page = $this->page($count, 20);
        $join = "left join ".C('DB_PREFIX').'district as b on a.distid =b.id';
		$areas = $this->area_model
        ->alias('a')
        ->join($join)
        ->field("a.id,a.name,b.name as dname,a.distid,a.address,a.lat,a.lng,a.pinyin,a.catid,a.firstchar")
        ->where($where)
        ->order("a.distid,a.id desc")		
		->limit($page->firstRow . ',' . $page->listRows)
		->select();
        
		$this->assign("areas",$areas);
        $this->assign("page",$page->show('Admin'));
        
        //设置添加或编辑时的跳转页面
        $_SESSION['jumpUrl_area_list']=get_url();
		$this->display();
	}
	
	function add(){
		$this->citytree();
        
        //定位中心点位置
        $center=array();
        $center=I('session.editlbs',array('centerlng'=>105.933594,'centerlat'=>29.36194));        
        $this->assign($center);
        
        
		$this->display();
	}
	
	function add_post(){
		if(IS_POST){
		  //将名称转换为拼音
          if(isset($_POST['pinyin']) && $_POST['pinyin']==""){
            $_POST['pinyin']=pinyin($_POST['name']);
            $_POST['firstchar']=strtoupper(substr($_POST['pinyin'],0,1));
          }
		  $data= $this->area_model->create();
		    //保存坐标信息方便下一编辑定位中心点坐标
            if(I('post.savelbs',0)=="yes"){
                $_SESSION['editlbs']=array('centerlng'=>$data['lng'],'centerlat'=>$data['lat']);
            }
            
			if ($data) {
				if ($this->area_model->add()!==false) {
					$this->success("添加成功！",I('session.jumpUrl_area_list'));
				} else {
					$this->error("添加失败！");
				}
			} else {
				$this->error($this->area_model->getError());
			}
		
		}
	}
	
	function edit(){
		$id=I("get.id");
		$area=$this->area_model->find($id);
        
        //定位中心点位置
        $center=array();
        if(empty($area['lng']) || $area['lng']==0){
            $center=I('session.editlbs',array('centerlng'=>105.933594,'centerlat'=>29.36194));
        }else{
            $center['centerlng']=$area['lng'];
            $center['centerlat']=$area['lat'];
        }
        $this->assign($center);
        
        
        $this->citytree($area['distid']);
		$this->assign($area);		
		$this->display();
	}
	
	function edit_post(){
		if (IS_POST) {
		  //将名称转换为拼音
          if(isset($_POST['pinyin']) && $_POST['pinyin']==""){
            $_POST['pinyin']=pinyin($_POST['name']);
            $_POST['firstchar']=strtoupper(substr($_POST['pinyin'],0,1));
          }
		    $data= $this->area_model->create();
            //保存坐标信息方便下一编辑定位中心点坐标
            if(I('post.savelbs',0)=="yes"){
                $_SESSION['editlbs']=array('centerlng'=>$data['lng'],'centerlat'=>$data['lat']);
            }
            
			if ($data) {
				if ($this->area_model->save()!==false) {
					$this->success("保存成功！",I('session.jumpUrl_area_list'));
				} else {
					$this->error("保存失败！");
				}
			} else {
				$this->error($this->area_model->getError());
			}
		}
	}
	
	//排序
	public function listorders() {
		$status = parent::_listorders($this->area_model);
		if ($status) {
			$this->success("排序更新成功！");
		} else {
			$this->error("排序更新失败！");
		}
	}
	
	//删除
	function delete(){
		if(isset($_POST['ids'])){
			
		}else{
			$id = intval(I("get.id"));
			if ($this->area_model->delete($id)!==false) {
				$this->success("删除成功！");
			} else {
				$this->error("删除失败！");
			}
		}
	
	}
	
	/**
	 * 显示/隐藏
	 */
	function toggle(){
		if(isset($_POST['ids']) && $_GET["display"]){
			$ids = implode(",", $_POST['ids']);
			$data['link_status']=1;
			if ($this->area_model->where("link_id in ($ids)")->save($data)!==false) {
				$this->success("显示成功！");
			} else {
				$this->error("显示失败！");
			}
		}
		if(isset($_POST['ids']) && $_GET["hide"]){
			$ids = implode(",", $_POST['ids']);
			$data['link_status']=0;
			if ($this->area_model->where("link_id in ($ids)")->save($data)!==false) {
				$this->success("隐藏成功！");
			} else {
				$this->error("隐藏失败！");
			}
		}
	}
    private function citytree($distid=0){
        $tree = new \Tree();
	 	$tree->icon = array('&nbsp;&nbsp;&nbsp;│ ', '&nbsp;&nbsp;&nbsp;├─ ', '&nbsp;&nbsp;&nbsp;└─ ');
	 	$tree->nbsp = '&nbsp;&nbsp;&nbsp;';        
        
        //映射不同的字段，以满足tree的需要
        $fieldarray=array(
            "id",
            "name",
            "upid"=>"parentid",
            "if(id=".$distid.",'selected','')"=>"selected"
        );
	 	$terms = M("District")->field($fieldarray)->where('upid='.C('AREAID'))->order(array("sorts"=>"asc"))->select();
	 	$tree->init($terms);
	 	$tree_tpl="<option value='\$id' \$selected>\$spacer\$name</option>";
	 	$tree=$tree->get_tree(C('AREAID'),$tree_tpl);//从配置文件中获取areaid值	 	
	 	$this->assign("city_tree",$tree);
    }
	
	
}