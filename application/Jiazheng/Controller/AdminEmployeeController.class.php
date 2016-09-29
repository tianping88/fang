<?php
namespace Jiazheng\Controller;
use Common\Controller\AdminbaseController;
class AdminEmployeeController extends AdminbaseController{
	protected $employee_model;
	protected $terms_model;
	protected $user_model;
	function _initialize() {
		parent::_initialize();
		$this->employee_model = D("Common/JzEmployee");
		$this->terms_model = D("Common/Terms");
		$this->user_model=M('Users');
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
        
        $area=M('District')->where('upid='.C('AREAID'))->order(array("sorts"=>"asc"))->select();
        $this->assign('area',$area);
        
		$this->display();
	}
	
	function add_post(){
		if (IS_POST) {
            
            
			if(empty($_POST['post']['termid'])){
				$this->error("请至少选择一个分类栏目！");
			}
            $photos=array();
			if(!empty($_POST['photos_alt']) && !empty($_POST['photos_url'])){
				foreach ($_POST['photos_url'] as $key=>$url){
					$photourl=sp_asset_relative_url($url);
					$photos[]=array("url"=>$photourl,"alt"=>$_POST['photos_alt'][$key]);
				}
			}
			//$_POST['smeta']['thumb'] = sp_asset_relative_url($_POST['smeta']['thumb']);
			 
			
			//$_POST['post']['uid']=get_current_admin_id();
			$_POST=I("post.post");
            
            
            //检测验证码是否正确
            
            
            
                    $_POST['uid']=sp_get_current_admin_id();
                    $_POST['smeta']=json_encode($photos);
        			//$article['post_content']=htmlspecialchars_decode($article['post_content']);
                    $_POST['peitao']=implode(",",array_filter($_POST['peitao']));
                    $_POST['shopfor']=implode(",",array_filter($_POST['shopfor']));
                    
                    $_POST['resume']=htmlspecialchars_decode($_POST['resume']);
                    //$_POST['jiguan']=implode(",",array_filter($_POST['jiguan']));
                    $employee_model = D("Common/JzEmployee");
                    $data=$employee_model->create();
                    
                    if(!$data){
                        $this->error($employee_model->getError());
                    } 
                    try{
                        $result=$employee_model->add($data);
                    }
        			catch(\Exception $ex){
        			 $this->error("添加数据出现错误！");
        			}
        			if ($result!==false) {			
        				
        				$this->success("发布成功！");
        			} else {
        				$this->error("发布失败！");
        			}
            
                        
			
			 
		}
	}
	
	public function edit(){
		$id=  intval(I("get.eid",0));       
		$post=$this->employee_model->where("eid=$id")->find();
                
		$this->assign("post",$post);
		$this->assign("smeta",json_decode($post['smeta'],true));
        $this->_getTermTree((array)$post['termid']);
		//$this->assign("terms",$terms);
		//$this->assign("term",$term_relationship);
        $area=M('District')->where('upid='.C('AREAID'))->order(array("sorts"=>"asc"))->select();
        $this->assign('area',$area);        
		$this->display();
	}
    /**
     * 个人修改求职信息
     * 先检查是否存在个人的求职信息，如果存在，则修改，不存在则新增
     * 
     * 
     * 
     * 
     */
    public function memberedit(){
        $uid=sp_get_current_admin_id();        
        $employee=$this->employee_model->where("uid=$uid")->find();        
        if($employee){  
            
            $this->redirect('edit',array('eid'=>$employee['eid']));                      
        }
        else{
            /**
             * 以下方法同add方法
            */
            $terms = $this->terms_model->where(array("taxonomy"=>"jiazheng"))->order(array("listorder"=>"asc"))->select();
    		$term_id = intval(I("get.term"));
    		$this->_getTermTree();
            $map['term_id']=$term_id;
            $map['taxonomy']="jiazheng";
    		$term=$this->terms_model->where($map)->find();
    		$this->assign("author","1");
    		$this->assign("term",$term);
    		$this->assign("terms",$terms);
            
    		$this->display("add");
            }
        
    }
	
	public function edit_post(){
		if (IS_POST) {
			if(empty($_POST['post']['termid'])){
				$this->error("请至少选择一个分类栏目！");
			}
			$post_id=intval($_POST['post']['eid']);
			
			$photos=array();
			if(!empty($_POST['photos_alt']) && !empty($_POST['photos_url'])){
				foreach ($_POST['photos_url'] as $key=>$url){
					$photourl=sp_asset_relative_url($url);
					$photos[]=array("url"=>$photourl,"alt"=>$_POST['photos_alt'][$key]);
				}
			}
            //var_dump($_POST['smeta']['photo']);
			//$_POST['smeta']['thumb'] = sp_asset_relative_url($_POST['smeta']['thumb']);
			//unset($_POST['post']['post_author']);
			$article=I("post.post");
			$article['smeta']=json_encode($photos);
            $article['resume']=htmlspecialchars_decode($article['resume']);
            
			//$article['post_content']=htmlspecialchars_decode($article['post_content']);
            $article['eskill']=implode(",",array_filter($article['eskill']));
            $article['techang']=implode(",",array_filter($article['techang']));
            $article['jiguan']=implode(",",array_filter($article['jiguan']));
            $data=$this->employee_model->create($article);
            
            if(!$data){
                $this->error($this->employee_model->getError());
            }
                      
            
			$result=$this->employee_model->save($data);
			if ($result!==false) {
				$this->success("保存成功！",I('session.jumpUrl_employee_edit'));
			} else {
				$this->error("保存失败！");
			}
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
		$where_ands=array();
        if(!empty($term_id)){
            $where_ands=array(" b.termid = $term_id ");
        }
		
		if("all"!==$status){
		  array_push($where_ands, " b.status = '$status' ");
		}else{
		  array_push($where_ands, " b.status >= 0 ");
		}
		$fields=array(
				//'start_time'=> array("field"=>"post_date","operator"=>">"),
				//'end_time'  => array("field"=>"sex","operator"=>"="),
				'keyword'  => array("field"=>"ename","operator"=>"like"),
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
		
		//分页	
		$count=$this->user_model
		->alias("a")
		->join(C ( 'DB_PREFIX' )."jz_employee b ON a.id = b.uid")
		->where($where)
		->count();
			
		$page = $this->page($count, 20);
			
		//分页文章列表	
		$posts=$this->user_model
		->alias("a")
		->join(C ( 'DB_PREFIX' )."jz_employee b ON a.id = b.uid")
		->where($where)
		->limit($page->firstRow . ',' . $page->listRows)
		->order("b.eid DESC")->select();
        //用户信息,不知道有用没有啊
		//$users_obj = M("Users");
		//$users_data=$users_obj->field("id,user_login")->where("user_status=1")->select();
		//$users=array();
		//foreach ($users_data as $u){
		//	$users[$u['id']]=$u;
		//}
        //分类,只提取家政类信息
    	$terms = $this->terms_model->where(array("taxonomy"=>"jiazheng"))->order("term_id")->getField("term_id,name",true);
		//$this->assign("users",$users);
    	$this->assign("terms",$terms);
		$this->assign("Page", $page->show('Admin'));
		$this->assign("current_page",$page->GetCurrentPage());
		unset($_GET[C('VAR_URL_PARAMS')]);
		$this->assign("formget",$_GET);
		$this->assign("posts",$posts);
        $_SESSION['jumpUrl_employe_edit']=get_url();
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
    /**
     * 统一更改状态
     * 
     * 
     * 
     * */
     private	function changestatus($ids,$data=array(),$msg=array("success"=>"操作成功","error"=>"操作失败")){
	   $ids=is_array($ids)?join(',',$ids):$ids;
       //$data['status']=$status;
       if ($this->employee_model->where("eid in ($ids)")->save($data)!==false) {
				$this->success($msg['success']);
			} else {
				$this->error($msg['error']);
			}
	}
	function delete(){
	   $ids=0;
		if(isset($_GET['eid'])){
			$ids = intval(I("get.eid"));			
		}
		if(isset($_POST['ids'])){
			$ids=join(",",$_POST['ids']);			
		}
        $msg['success']='删除成功';
        $msg['error']='删除失败';
        $data['status']=-1;
        $this->changestatus($ids,array('status'=>-1),$msg);
	}
	
	function check(){
		if(isset($_POST['ids'])){
		      $ids=join(",",$_POST['ids']);
		      if($_GET["check"]){
		          $data['status']=1;
                  $msg['success']='审核成功';
                  $msg['error']='审核失败';	
                  $this->changestatus($ids,$data,$msg);	
		      }
              if($_GET["uncheck"]){
                $data['status']=0;
                $msg['success']='取消审核成功';
                $msg['error']='取消审核失败';
                $this->changestatus($ids,$data,$msg);		
              }					
			
            		
			
		}
        else{
            $this->error('未选择数据');
        }
		
	}
	
	function top(){
		if(isset($_POST['ids'])){
		  $ids=join(",",$_POST['ids']);
		  if($_GET['top']){
		      $data["istop"]=1;
              $msg['success']='置顶成功！';
              $msg['error']='置顶失败！';
              $this->changestatus($ids,$data,$msg);	
		  }
          if($_GET['untop']){
		      $data["istop"]=0;
              $msg['success']='取消置顶成功！';
              $msg['error']='取消置顶失败！';
              $this->changestatus($ids,$data,$msg);	
		  }

		}
        else{
            $this->error('未选择数据！');
        }
		
	}
	
	function recommend(){
	   if(isset($_POST['ids'])){
		  $ids=join(",",$_POST['ids']);
		  if($_GET['recommend']){
		      $data["recommended"]=1;
              $msg['success']='推荐成功！';
              $msg['error']='推荐失败！';
              $this->changestatus($ids,$data,$msg);	
		  }
          if($_GET['unrecommend']){
		      $data["recommended"]=0;
              $msg['success']='取消推荐成功！';
              $msg['error']='取消推荐失败！';
              $this->changestatus($ids,$data,$msg);	
		  }

		}
        else{
            $this->error('未选择数据！');
        }
        
        
        
		
	}
	
	function move(){
		if(IS_POST){
			if(isset($_GET['ids']) && isset($_POST['term_id'])){
				$tids=$_GET['ids'];
                $data['termid']=I('post.term_id');
				if ( $this->employee_model->where("eid in ($tids)")->save($data) !== false) {
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
			$terms = $this->terms_model->where(array("taxonomy"=>"jiazheng"))->order(array("path"=>"asc"))->select();
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
		$this->_lists(-1);
		$this->_getTree();
		$this->display();
	}
	
	function clean(){
		if(isset($_POST['ids'])){
			$ids = implode(",", $_POST['ids']);					
			$status=$this->employee_model->where("eid in ($ids)")->delete();			
			
			if ($status!==false) {
				$this->success("删除成功！");
			} else {
				$this->error("删除失败！");
			}
		}else{
			if(isset($_GET['eid'])){
				$id = intval(I("get.eid"));
				
				$status=$this->employee_model->where("eid=$id")->delete();				
				if ($status!==false) {
					$this->success("删除成功！");
				} else {
					$this->error("删除失败！");
				}
			}
		}
	}
	
	function restore(){
		if(isset($_GET['eid'])){
			$id = intval(I("get.eid"));
			$data=array("eid"=>$id,"status"=>"0");
			if ($this->employee_model->save($data)) {
				$this->success("还原成功！");
			} else {
				$this->error("还原失败！");
			}
		}
	}

 


	
}