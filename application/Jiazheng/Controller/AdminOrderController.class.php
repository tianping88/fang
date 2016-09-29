<?php
namespace Jiazheng\Controller;
use Common\Controller\AdminbaseController;
class AdminOrderController extends AdminbaseController{
	protected $order_model;
	protected $terms_model;
	
	function _initialize() {
		parent::_initialize();
		$this->order_model = D("Common/JzReorder");
		$this->terms_model = D("Common/Terms");
	}
	function index(){
		$this->_lists();
		$this->_getTree();
		$this->display();
	}
	
	function add(){
		$terms = $this->terms_model->order(array("listorder"=>"asc"))->select();
		$term_id = intval(I("get.term"));
		$this->_getTermTree();
		$term=$this->terms_model->where("term_id=$term_id")->find();
		$this->assign("author","1");
		$this->assign("term",$term);
		$this->assign("terms",$terms);
		$this->display();
	}
	
	function add_post(){
	   
        if(IS_POST){
            $_POST=$_POST['post'];
            $eid=I('post.eid',0);
            $emmodel= M("JzEmployee");
        	$employee=$emmodel->where(array('status'=>1))->find($eid);
            if($employee){            
            }
            else{
                $this->error("当前人员不能接受预订！");
            }
        	
            $order_model=D("Common/JzReorder");            
            $data=$order_model->create(); 
             
                if(empty($data)){
                    $this->error($order_model->getError());
                    
                }
                $data['startdate']=strtotime($data['startdate']);
                //var_dump($data);
                //exit;
    			$result=$order_model->add($data);
    			if ($result) {
    				
    				$this->success("预订成功！");
    			} else {
    				$this->error("预订失败!");
    			}
        }
	}
	
	public function edit(){
		$id=  intval(I("get.id"));
		
		$term_relationship = M('TermRelationships')->where(array("object_id"=>$id,"status"=>1))->getField("term_id",true);
		$this->_getTermTree($term_relationship);
		$terms=$this->terms_model->select();
		$post=$this->posts_model->where("id=$id")->find();
		$this->assign("post",$post);
		$this->assign("smeta",json_decode($post['smeta'],true));
		$this->assign("terms",$terms);
		$this->assign("term",$term_relationship);
		$this->display();
	}
	
	public function edit_post(){
		if (IS_POST) {
			if(empty($_POST['term'])){
				$this->error("请至少选择一个分类栏目！");
			}
			$post_id=intval($_POST['post']['id']);
			
			$this->order_model->where(array("object_id"=>$post_id,"term_id"=>array("not in",implode(",", $_POST['term']))))->delete();
			foreach ($_POST['term'] as $mterm_id){
				$find_term_relationship=$this->order_model->where(array("object_id"=>$post_id,"term_id"=>$mterm_id))->count();
				if(empty($find_term_relationship)){
					$this->order_model->add(array("term_id"=>intval($mterm_id),"object_id"=>$post_id));
				}else{
					$this->order_model->where(array("object_id"=>$post_id,"term_id"=>$mterm_id))->save(array("status"=>1));
				}
			}
			
			if(!empty($_POST['photos_alt']) && !empty($_POST['photos_url'])){
				foreach ($_POST['photos_url'] as $key=>$url){
					$photourl=sp_asset_relative_url($url);
					$_POST['smeta']['photo'][]=array("url"=>$photourl,"alt"=>$_POST['photos_alt'][$key]);
				}
			}
			$_POST['smeta']['thumb'] = sp_asset_relative_url($_POST['smeta']['thumb']);
			unset($_POST['post']['post_author']);
			$article=I("post.post");
			$article['smeta']=json_encode($_POST['smeta']);
			$article['post_content']=htmlspecialchars_decode($article['post_content']);
			$result=$this->posts_model->save($article);
			if ($result!==false) {
				$this->success("保存成功！");
			} else {
				$this->error("保存失败！");
			}
		}
	}
	
	//排序
	public function listorders() {
		$status = parent::_listorders($this->order_model);
		if ($status) {
			$this->success("排序更新成功！");
		} else {
			$this->error("排序更新失败！");
		}
	}
	
	private  function _lists($status="0,1"){
		$term_id=0;
		if(!empty($_REQUEST["term"])){
			$term_id=intval($_REQUEST["term"]);
			$term=$this->terms_model->where("term_id=$term_id")->find();
			$this->assign("term",$term);
			$_GET['term']=$term_id;
		}
		
		$where_ands=empty($term_id)?array():array("item = $term_id");
		array_push($where_ands,"orderstatus in ($status)");
		$fields=array(
				'start_time'=> array("field"=>"create_time","operator"=>">"),
				'end_time'  => array("field"=>"create_time","operator"=>"<"),
				'keyword'  => array("field"=>"address","operator"=>"like"),
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
		
		$where= join(" and ", $where_ands);
			
			
		$count=$this->order_model		
		->where($where)
		->count();			
		$page = $this->page($count, 20);
			
			
		$order=$this->order_model
		->where($where)
        ->order('reorder desc')
		->limit($page->firstRow . ',' . $page->listRows)
		->select();
        
        /**
		$users_obj = M("Users");
		$users_data=$users_obj->field("id,user_login")->where("user_status=1")->select();
		$users=array();
		foreach ($users_data as $u){
			$users[$u['id']]=$u;
		}
        */
    	$terms = $this->terms_model->order(array("term_id = $term_id"))->getField("term_id,name",true);
		$this->assign("users",$users);
    	$this->assign("terms",$terms);
		$this->assign("Page", $page->show('Admin'));
		$this->assign("current_page",$page->GetCurrentPage());
		unset($_GET[C('VAR_URL_PARAMS')]);
		$this->assign("formget",$_GET);
		$this->assign("order",$order);
	}
	
	private function _getTree(){
		$term_id=empty($_REQUEST['term'])?0:intval($_REQUEST['term']);
		$result = $this->terms_model->order(array("listorder"=>"asc"))->select();
		
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
		$result = $this->terms_model->order(array("listorder"=>"asc"))->select();
		
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
	   $where=array();       
       if(isset($_GET['id'])){
            $where['reorder']=intval(I("get.id"));
       }
       if(isset($_POST['ids'])){
            $where['reorder']=array('in',implode(",", $_POST['ids']));
       }
       if($where){
            $data['orderstatus']=-1;
            $result=$this->order_model->where($where)->save($data);
			if ($result!==false) {
				$this->success("删除成功！");
			} else {
				$this->error("删除失败！");
			}
       }else{
            $this->error("没有可删除的！");
       }
		
	}
	
	function check(){
	   
       if(isset($_POST['ids'])){
            $tids=join(",",$_POST['ids']);
            $msg='';
            if($_GET["check"]){
                $msg="审核";$data["orderstatus"]=1;                
            }
            if($_GET["uncheck"]){
                $msg="取消审核";$data["orderstatus"]=0;                
            }
            if ( $this->order_model->where("reorder in ($tids)")->save($data)!==false) {
				$this->success($msg."成功！");
			} else {
				$this->error($msg."失败！");
			}
            
       }else{
            $this->error("没有选择记录！");
       } 
		
	}
	
	
	
	function move(){
		if(IS_POST){
			if(isset($_GET['ids']) && isset($_POST['item'])){
				$tids=$_GET['ids'];
                $data['item']=$_POST['item'];
				if ( $this->order_model->where("reorder in ($tids)")->save($data) !== false) {
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
	
	function recyclebin(){
		$this->_lists("-1");
		$this->_getTree();
		$this->display();
	}
	
	function clean(){
		if(isset($_POST['ids'])){
			$ids = implode(",", $_POST['ids']);
			//$tids= implode(",", array_keys($_POST['ids']));
			//$data=array("orderstatus"=>"0");
			$status=$this->order_model->where("reorder in ($ids)")->delete();			
			
			if ($status!==false) {
				$this->success("删除成功！");
			} else {
				$this->error("删除失败！");
			}
		}else{
			
					$this->error("没有可删除的，亲！");
				
		}
	}
	
	function restore(){
		if(isset($_GET['id'])){
			$id = intval(I("get.id"));
			$data=array("orderstatus"=>"0");
            $result=$this->order_model->where('reorder='.$id)->save($data);
			if ($result) {
				$this->success("还原成功！");
			} else {
				$this->error("还原失败！");                
			}
		}
	}
	
}