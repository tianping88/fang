<?php
namespace ChinaCity\Controller;
use Common\Controller\AdminbaseController;
class AdminCityController extends AdminbaseController{
    protected $city_model;
	
	
	function _initialize() {
		parent::_initialize();
		$this->city_model = D("District");		
	}
    public function index(){
        //如果有parentid则显示parent下了子项，没有则显示与level同级内容
        
        $parentid=I("get.parentid",0);
        $where['upid']=$parentid;
        //$level = intval(I("get.level",1));
        $result = $this->city_model->where($where)->order(array("level"=>"asc","sorts"=>"asc"))->select();
		
		$tree = new \Tree();
		$tree->icon = array('&nbsp;&nbsp;&nbsp;│ ', '&nbsp;&nbsp;&nbsp;├─ ', '&nbsp;&nbsp;&nbsp;└─ ');
		$tree->nbsp = '&nbsp;&nbsp;&nbsp;';
		foreach ($result as $r) {
			$r['str_manage'] = '<a href="' . U("AdminCity/add", array("parentid" => $r['id'])) . '">添加子类</a> | <a href="' . U("AdminCity/edit", array("id" => $r['id'])) . '">修改</a> | <a class="J_ajax_del" href="' . U("AdminCity/delete", array("id" => $r['id'])) . '">删除</a> ';
			$url=U('AdminCity/index',array('parentid'=>$r['id']));
			$r['url'] = $url;			
			$r['id']=$r['id'];
			$r['parentid']=$r['upid'];
			$array[] = $r;
		}
		
		$tree->init($array);
        
		$str = "<tr>
					<td><input name='listorders[\$id]' type='text' size='3' value='\$sorts' class='input input-order'></td>
					<td>\$id</td>
					<td>\$spacer \$name</td>
	    			<td>\$spacer \$pinyin</td>
					<td align='center'><a href='\$url'>查看下级</a></td>
					<td>\$str_manage</td>
				</tr>";
		
        $list = $tree->get_tree($parentid, $str);
        $this->assign("parentid",$where['upid']);
		$this->assign("list", $list);
        
        //这里只能使用getField来获取数据，才能正常使用get_pos，因为这样才能以id为数组的键值
	 	$terms = $this->city_model->order(array("id"=>"asc"))->getField("id,upid as parentid,name");   
        $tree->init($terms);        
        $pos=$tree->get_pos($parentid);
        if(is_array($pos)){
            $path="";
            foreach($pos as $p){
               $path.= '<a href="'.U("AdminCity/index", array("parentid" => $p['parentid'])) . '">'.$p['name'].'</a>->';
            }
            $this->assign("path",$path);
        }
  
        
        
		$this->display();
    }
    function add(){
	 	$parentid = intval(I("get.parentid"));
	 	$tree = new \Tree();
	 	$tree->icon = array('&nbsp;&nbsp;&nbsp;│ ', '&nbsp;&nbsp;&nbsp;├─ ', '&nbsp;&nbsp;&nbsp;└─ ');
	 	$tree->nbsp = '&nbsp;&nbsp;&nbsp;';
        //只显示同一级别的内容可以选择
        $data=$this->city_model->where(array("id" => $parentid))->find();
        
        //映射不同的字段，以满足tree的需要
        $fieldarray=array(
            "id",
            "name",
            "upid"=>"parentid",
            "if(id=".$parentid.",'selected','')"=>"selected"
        );
	 	$terms = $this->city_model->field($fieldarray)->where(array("upid"=>$data['upid']))->order(array("sorts"=>"asc"))->select();
	 	$tree->init($terms);
	 	$tree_tpl="<option value='\$id' \$selected>\$spacer\$name</option>";
	 	$tree=$tree->get_tree($data['upid'],$tree_tpl);
	 	
	 	$this->assign("city_tree",$tree);
	 	$this->assign("parent",$parentid);
	 	$this->display();
	}
	
	function add_post(){
		if (IS_POST) {
		  //将名称转换为拼音
          if(isset($_POST['pinyin']) && $_POST['pinyin']==""){
            $_POST['pinyin']=pinyin($_POST['shortname']);
            
          }
		  $data=$this->city_model->create();
			if ($data) {
			    if($data['upid']!==0){
			     $level=$this->city_model->find($data['upid']);
                 $data['level']=$level['level']+1;
			    }
                else{
                    $data['level']=1;
                } 
				if ($this->city_model->add($data)!==false) {
					$this->success("添加成功！");
				} else {
					$this->error("添加失败！");
				}
			} else {
				$this->error($this->city_model->getError());
			}
		}
	}
	
	function edit(){
		$id = intval(I("get.id"));
		$data=$this->city_model->where(array("id" => $id))->find();
        
        //上一级的数据;
        $fatherdata=$this->city_model->where(array("id" => $data['upid']))->find();
        
		$tree = new \Tree();
		$tree->icon = array('&nbsp;&nbsp;&nbsp;│ ', '&nbsp;&nbsp;&nbsp;├─ ', '&nbsp;&nbsp;&nbsp;└─ ');
		$tree->nbsp = '&nbsp;&nbsp;&nbsp;';
        
        //映射不同的字段，以满足tree的需要
        $fieldarray=array(
            "id",
            "name",
            "upid"=>"parentid",
            "if(id=".$data['upid'].",'selected','')"=>"selected"
        );
        $where['upid']=$fatherdata['upid'];
		$terms = $this->city_model->where($where)->field($fieldarray)->select();
		
		$tree->init($terms);
        //$parent=$tree->get_parent($data['upid']);
       
		$tree_tpl="<option value='\$id' \$selected>\$spacer\$name</option>";
		$tree=$tree->get_tree($fatherdata['upid'],$tree_tpl);
		
		$this->assign("city_tree",$tree);
		$this->assign("data",$data);
		$this->display();
	}
	
	function edit_post(){
		if (IS_POST) {
		  //将名称转换为拼音
          if(isset($_POST['pinyin']) && $_POST['pinyin']==""){
            $_POST['pinyin']=pinyin($_POST['shortname']);
            
          }
		  $data=$this->city_model->create();
			if ($data) {
			 if($data['upid']!==0){
			     $level=$this->city_model->find($data['upid']);
                 $data['level']=$level['level']+1;
			    }
                else{
                    $data['level']=1;
                } 
				if ($this->city_model->save($data)!==false) {
					$this->success("修改成功！");
				} else {
					$this->error("修改失败！");
				}
			} else {
				$this->error($this->city_model->getError());
			}
		}
	}
	
	//排序
	public function listorders() {
	   
       
        $ids = $_POST['listorders'];
        asort($ids);
        $i=1;
        foreach ($ids as $key => $r) {
            $data['sorts'] = $i;
            $status=$this->city_model->where(array('id' => $key))->save($data);
            $i++;
        }		
		if ($status!==false) {
			$this->success("排序更新成功！");
		} else {
			$this->error("排序更新失败！");
		}
	}
	
	/**
	 *  删除
	 */
	public function delete() {
		$id = intval(I("get.id"));
		$count = $this->city_model->where(array("upid" => $id))->count();
		
		if ($count > 0) {
			$this->error("该菜单下还有子类，无法删除！");
		}
		
		if ($this->city_model->delete($id)!==false) {
			$this->success("删除成功！");
		} else {
			$this->error("删除失败！");
		}
	}
    
}