<?php
namespace Jiazheng\Controller;
use Common\Controller\AdminbaseController;
class AdminReserveController extends AdminbaseController{
	protected $reserve_model;	
	protected $terms_model;
	
	function _initialize() {
		parent::_initialize();
		$this->reserve_model = D("Jiazheng/Jz_reserve");
		$this->terms_model = D("Common/Terms");
		
	}
	function index(){
	   
		$this->_lists();
		$this->_getTree();        
		$this->display();
	}
	
	function add(){
		$terms = $this->terms_model->where(array("taxonomy"=>"jiazheng"))->order(array("listorder"=>"asc"))->select();
		$term_id = intval(I("get.term"));
		$this->_getTermTree();
        $map['term_id']=$term_id;
        $map['taxonomy']="jiazheng";
		$term=$this->terms_model->where($map)->find();
		$this->assign("author","1");
		$this->assign("term",$term);
		$this->assign("terms",$terms);
        
		$this->display();
	}
	
	function add_reserve(){
		if (IS_POST) {
			if(empty($_POST['item'])){
				$this->error("请至少选择一个分类栏目！");
			}				 
						
			
			
			//$reserve['remark']=htmlspecialchars_decode($reserve['remark']);
            $data=$this->reserve_model->create();
            
            if(empty($data)){
                $this->error("添加失败！");
            }
            $data['serve_time']=strtotime($data['serve_time']);
            $data['create_time']=NOW_TIME;
            $data['update_time']=NOW_TIME;
			$result=$this->reserve_model->add($data);
			if ($result) {
				
				$this->success("添加成功！");
			} else {
				$this->error("添加失败！");
			}
			 
		}
	}
	
	public function edit(){
		$id=  intval(I("get.reorder"));
		
		//$terms=$this->terms_model->select();
		$post=$this->reserve_model->where("reorder=$id")->find();
        $this->_getTermTree(array($post['item']));
		$this->assign("post",$post);
		//$this->assign("smeta",json_decode($post['smeta'],true));
		//$this->assign("terms",$terms);
		//$this->assign("term",$term_relationship);
		$this->display();
	}
	
	public function edit_reserve(){
	   
		if (IS_POST) {
			if(empty($_POST['item'])){
				$this->error("请至少选择一个分类栏目！");
			}
            $data=	$this->reserve_model->create();
            //$data['update_time']=NOW_TIME;
            if($data){
                $data['serve_time']=strtotime($data['serve_time']);                
                $data['update_time']=NOW_TIME;
                $result=$this->reserve_model->save($data);
    			if (false!==$result) {
    				$this->success("保存成功！");
    			} else {
    				$this->error("保存失败！");
                    
                   
    			}
            }
            else{
                $this->error("创建数据失败！");
            }
			
		}
	}
	
	//排序
	public function listorders() {
		$status = parent::_listorders($this->term_relationships_model);
		if ($status) {
			$this->success("排序更新成功！");
		} else {
			$this->error("排序更新失败！");
		}
	}
	
	private  function _lists($status="all"){
		$term_id=0;
		if(!empty($_REQUEST["term"])){
			$term_id=intval($_REQUEST["term"]);
            
			$term=$this->terms_model->where("term_id=$term_id")->find();
			$this->assign("term",$term);
			$_GET['term']=$term_id;
		}
		
		$where_ands=empty($term_id)?"":array("item = $term_id");
		if("all"!==$status){
		  array_push($where_ands, "status = '$status'");
		}
        
		$fields=array(
				//'start_time'=> array("field"=>"post_date","operator"=>">"),
				//'end_time'  => array("field"=>"sex","operator"=>"="),
				'keyword'  => array("field"=>"cname","operator"=>"like"),
		);
		if(IS_POST){
			
			foreach ($fields as $param =>$val){
				if (isset($_POST[$param]) && !empty($_POST[$param])) {
					$operator=$val['operator'];
					$field   =$val['field'];
					$get=$_POST[$param];
					$_GET[$param]=$get;
					if($operator=="like"){
						$get="%$get%";
					}
					array_push($where_ands, "$field $operator '$get'");
				}
			}
		}else{
			foreach ($fields as $param =>$val){
				if (isset($_GET[$param]) && !empty($_GET[$param])) {
					$operator=$val['operator'];
					$field   =$val['field'];
					$get=$_GET[$param];
					if($operator=="like"){
						$get="%$get%";
					}
					array_push($where_ands, "$field $operator '$get'");
				}
			}
		}
        $where="";
		if(is_array($where_ands)){
		  $where= join(" and ", $where_ands);
		}
		
        
			
		//分页	
		$count=$this->reserve_model		
		->where($where)
		->count();
			
		$page = $this->page($count, 10);
			
		//分页文章列表	
		$reservelist=$this->reserve_model		
		->where($where)
		->limit($page->firstRow . ',' . $page->listRows)
		->order("reorder DESC")->select();
        
        //分类,只提取家政类信息
    	$terms = $this->terms_model->where(array("taxonomy"=>"jiazheng"))->order("term_id")->getField("term_id,name",true);		
    	$this->assign("terms",$terms);
		$this->assign("Page", $page->show('Admin'));
		$this->assign("current_page",$page->GetCurrentPage());
		unset($_GET[C('VAR_URL_PARAMS')]);
		$this->assign("formget",$_GET);
		$this->assign("posts",$reservelist);
	}
	
	private function _getTree(){
		$term_id=empty($_REQUEST['term'])?0:intval($_REQUEST['term']);
		$result = $this->terms_model->where(array("taxonomy"=>"jiazheng"))->order(array("listorder"=>"asc"))->select();
		
		$tree = new \Tree();
		$tree->icon = array('&nbsp;&nbsp;&nbsp;│ ', '&nbsp;&nbsp;&nbsp;├─ ', '&nbsp;&nbsp;&nbsp;└─ ');
		$tree->nbsp = '&nbsp;&nbsp;&nbsp;';
		foreach ($result as $r) {
			$r['str_manage'] = '<a href="' . U("AdminTerm/add", array("parent" => $r['term_id'])) . '">添加子类</a> | <a href="' . U("AdminTerm/edit", array("id" => $r['term_id'])) . '">修改</a> | <a class="J_ajax_del" href="' . U("AdminTerm/delete", array("id" => $r['term_id'])) . '">删除</a> ';
			$r['visit'] = "<a href='#'>访问</a>";
			$r['taxonomys'] = $this->taxonomys[$r['taxonomy']];
			$r['id']=$r['term_id'];
			$r['parentid']=$r['parent'];
			$r['selected']=$term_id==$r['term_id']?"selected":"";
			$array[] = $r;
		}
		
		$tree->init($array);
		$str="<option value='\$id' \$selected>\$spacer\$name</option>";
		$taxonomys = $tree->get_tree(0, $str);
		$this->assign("taxonomys", $taxonomys);
	}
	
	private function _getTermTree($term=array()){
		$result = $this->terms_model->where(array("taxonomy"=>"jiazheng"))->order(array("listorder"=>"asc"))->select();
		
		$tree = new \Tree();
		$tree->icon = array('&nbsp;&nbsp;&nbsp;│ ', '&nbsp;&nbsp;&nbsp;├─ ', '&nbsp;&nbsp;&nbsp;└─ ');
		$tree->nbsp = '&nbsp;&nbsp;&nbsp;';
		foreach ($result as $r) {
			$r['str_manage'] = '<a href="' . U("AdminTerm/add", array("parent" => $r['term_id'])) . '">添加子类</a> | <a href="' . U("AdminTerm/edit", array("id" => $r['term_id'])) . '">修改</a> | <a class="J_ajax_del" href="' . U("AdminTerm/delete", array("id" => $r['term_id'])) . '">删除</a> ';
			$r['visit'] = "<a href='#'>访问</a>";
			$r['taxonomys'] = $this->taxonomys[$r['taxonomy']];
			$r['id']=$r['term_id'];
			$r['parentid']=$r['parent'];
			$r['selected']=in_array($r['term_id'], $term)?"selected":"";
			$r['checked'] =in_array($r['term_id'], $term)?"checked":"";
			$array[] = $r;
		}
		
		$tree->init($array);
		$str="<option value='\$id' \$selected>\$spacer\$name</option>";
		$taxonomys = $tree->get_tree(0, $str);
		$this->assign("taxonomys", $taxonomys);
	}
	
	function delete(){
		if(isset($_GET['reorder'])){
			$tid = intval(I("get.reorder"));
			$data['status']=-1;
			if ($this->reserve_model->where("reorder=$tid")->save($data)!==false) {
				$this->success("删除成功！");
			} else {
				$this->error("删除失败！");
			}
		}
		if(isset($_POST['ids'])){
			$tids=join(",",$_POST['ids']);
			$data['status']=-1;
			if ($this->reserve_model->where("reorder in ($tids)")->save($data)!==false) {
				$this->success("删除成功！");
			} else {
				$this->error("删除失败！");
			}
		}
	}
	
	function check(){
		if(isset($_POST['ids']) && $_GET["check"]){
			$data["status"]=1;
			
			$ids=join(",",$_POST['ids']);
			
			if ( $this->reserve_model->where("reorder in ($ids)")->save($data)!==false) {
				$this->success("审核成功！");
			} else {
				$this->error("审核失败！");
			}
		}
		if(isset($_POST['ids']) && $_GET["uncheck"]){
			
			$data["status"]=0;
			
			$ids=join(",",$_POST['ids']);
			
			if ( $this->reserve_model->where("reorder in ($ids)")->save($data)!==false) {
				$this->success("取消审核成功！");
			} else {
				$this->error("取消审核失败！");
			}
		}
	}
	
	
	
	function move(){
		if(IS_POST){
			if(isset($_GET['ids']) && isset($_POST['term_id'])){
				$tids=$_GET['ids'];
                $data['item']=I('post.term_id');
				if ( $this->reserve_model->where("reorder in ($tids)")->save($data) !== false) {
					$this->success("移动成功！");
				} else {
					$this->error("移动失败！");
				}
			}
		}else{
			$parentid = intval(I("get.parent"));
			
			$tree = new \Tree();
			$tree->icon = array('&nbsp;&nbsp;&nbsp;│ ', '&nbsp;&nbsp;&nbsp;├─ ', '&nbsp;&nbsp;&nbsp;└─ ');
			$tree->nbsp = '&nbsp;&nbsp;&nbsp;';
			$terms = $this->terms_model->order(array("path"=>"asc"))->select();
			$new_terms=array();
			foreach ($terms as $r) {
				$r['id']=$r['term_id'];
				$r['parentid']=$r['parent'];
				$new_terms[] = $r;
			}
			$tree->init($new_terms);
			$tree_tpl="<option value='\$id'>\$spacer\$name</option>";
			$tree=$tree->get_tree(0,$tree_tpl);
			 
			$this->assign("terms_tree",$tree);
			$this->display();
		}
	}
	/**
     * 
     * 以下为回收站功能，暂未修改完成2015.5.4
     * 
     * */
	function recyclebin(){
		$this->_lists(-1);
		$this->_getTree();
		$this->display();
	}
	
	function clean(){
		if(isset($_POST['ids'])){
			$ids = implode(",", $_POST['ids']);
			$tids= implode(",", array_keys($_POST['ids']));
			
			$status=$this->reserve_model->where("reorder in ($tids)")->delete();			
			
			if ($status!==false) {
				$this->success("删除成功！");
			} else {
				$this->error("删除失败！");
			}
		}else{
			if(isset($_GET['reorder'])){
				$id = intval(I("get.reorder"));
				
				$status=$this->reserve_model->where("reorder = $id")->delete();				
				if ($status!==false) {
					$this->success("删除成功！");
				} else {
					$this->error("删除失败！");
				}
			}
		}
	}
	
	function restore(){
		if(isset($_GET['reorder'])){
			$id = intval(I("get.reorder"));
			$data=array("reorder"=>$id,"status"=>"1");
			if ($this->reserve_model->save($data)) {
				$this->success("还原成功！");
			} else {
				$this->error("还原失败！");
			}
		}
	}
	
}