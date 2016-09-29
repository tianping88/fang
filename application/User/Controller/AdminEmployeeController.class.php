<?php
namespace User\Controller;
use Common\Controller\AdminbaseController;
class AdminEmployeeController extends AdminbaseController{
	protected $posts_model;
	//protected $term_relationships_model;
	protected $terms_model;
	
	function _initialize() {
		parent::_initialize();
		$this->employee_model = D("Common/Jz_employee");
		$this->terms_model = D("Common/Terms");
		//$this->term_relationships_model = D("Common/TermRelationships");
        define('UID',get_current_admin_id());
        
        
	}
	function index(){
	   //如果存在用户信息，就更改，否由就新增
		$data=$this->employee_model->where('uid='.UID)->count();        
        $data>0?$this->edit():$this->add();
        
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
        
		$this->display(":employee_add");
	}
	
	 function add_post(){
		if (IS_POST) {
			if(empty($_POST['post']['termid'])){
				$this->error("请至少选择一个分类栏目！");
			}
			if(!empty($_POST['photos_alt']) && !empty($_POST['photos_url'])){
				foreach ($_POST['photos_url'] as $key=>$url){
					$photourl=sp_asset_relative_url($url);
					$_POST['smeta']['photo'][]=array("url"=>$photourl,"alt"=>$_POST['photos_alt'][$key]);
				}
			}
			$_POST['smeta']['thumb'] = sp_asset_relative_url($_POST['smeta']['thumb']);
			 
			$_POST['post']['post_date']=date("Y-m-d H:i:s",time());
			$_POST['post']['uid']=get_current_admin_id();
			$article=I("post.post");
			$article['smeta']=json_encode($_POST['smeta']);
			$article['post_content']=htmlspecialchars_decode($article['post_content']);
			$result=$this->employee_model->add($article);
			if ($result) {		
				
				$this->success("添加成功！");
			} else {
				$this->error("添加失败！");
			}
			 
		}
	}
	 function edit(){
		
		//$terms=$this->terms_model->select();
		$post=$this->employee_model->where("uid=".UID)->find();
		$this->assign("post",$post);
		$this->assign("smeta",json_decode($post['smeta'],true));
		//$this->assign("terms",$terms);
		//$this->assign("term",$term_relationship);
        
		$this->_getTermTree((array)$post['termid']);
		$this->display(":employee_edit");
	}
	
	 function edit_post(){
		if (IS_POST) {
			if(empty($_POST['post']['termid'])){
				$this->error("请至少选择一个分类栏目！");
			}
			$post_id=intval($_POST['post']['eid']);
			
			
			
			
			if(!empty($_POST['photos_alt']) && !empty($_POST['photos_url'])){
				foreach ($_POST['photos_url'] as $key=>$url){
					$photourl=sp_asset_relative_url($url);
					$_POST['smeta']['photo'][]=array("url"=>$photourl,"alt"=>$_POST['photos_alt'][$key]);
				}
			}
			$_POST['smeta']['thumb'] = sp_asset_relative_url($_POST['smeta']['thumb']);
			
			$article=I("post.post");
			$article['smeta']=json_encode($_POST['smeta']);
            //用UID和ID为作为条件，保证数据的安全性
            $map['uid']=UID;
            $map['id']=$article['eid'];
			//$article['post_content']=htmlspecialchars_decode($article['post_content']);
			$result=$this->employee_model->where($map)->save($article);
			if ($result!==false) {
				$this->success("保存成功！");
			} else {
				$this->error("保存失败！");
			}
		}
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
	
}