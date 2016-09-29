<?php
namespace User\Controller;
use Common\Controller\AdminbaseController;
class AdminGongsiController extends AdminbaseController{
	protected $gongsi_model;	
	protected $terms_model;
	
	function _initialize() {
		parent::_initialize();
		$this->gongsi_model = D("Common/Jz_gongsi");
		$this->terms_model = D("Common/Terms");
        define('UID',get_current_admin_id());
		
	}
	function index(){
	   
		//如果存在公司信息，就更改，否由就新增
		$data=$this->gongsi_model->where('uid='.UID)->count();        
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
        
		$this->display(":gongsi_add");
	}
	
	function add_gongsi(){
		if (IS_POST) {
			if(empty($_POST['item'])){
				$this->error("请至少选择一个分类栏目！");
			}				 
						
			
			
			//$reserve['remark']=htmlspecialchars_decode($reserve['remark']);
            $data=$this->gongsi_model->create();
            
            if(empty($data)){
                $this->error("添加失败！");
            }
            $data['createdate']=strtotime($data['createdate']);
            $data['create_time']=NOW_TIME;
            $data['update_time']=NOW_TIME;
			$result=$this->gongsi_model->add($data);
			if ($result) {
				
				$this->success("添加成功！");
			} else {
				$this->error("添加失败！");
			}
			 
		}
	}
	
	public function edit(){
		
		
		//$terms=$this->terms_model->select();
		$post=$this->gongsi_model->where("uid=".UID)->find();
        $this->_getTermTree(array($post['item']));
		$this->assign("post",$post);
		//$this->assign("smeta",json_decode($post['smeta'],true));
		//$this->assign("terms",$terms);
		//$this->assign("term",$term_relationship);
		$this->display(":gongsi_edit");
	}
	
	public function edit_gongsi(){
	   
		if (IS_POST) {
			if(empty($_POST['item'])){
				$this->error("请至少选择一个分类栏目！");
			}
            $data=	$this->gongsi_model->create();
            //$data['update_time']=NOW_TIME;
            if($data){
                $data['createdate']=strtotime($data['createdate']);                
                $data['update_time']=NOW_TIME;
                $map['uid']=UID;
                $map['id']=$data['id'];
                $result=$this->gongsi_model->where($map)->save($data);//用uid和ID来作为条件，保证数据的安全性
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