<?php
namespace Jiazheng\Controller;
use Common\Controller\HomeBaseController;
class IndexController extends HomeBaseController{
    public function index(){
        
		$lastnews=sp_sql_jz("cid:5;field:eid,ename,name;order:eid desc;limit:8;");        
         $this->assign('lastnews',$lastnews);
	
        $this->display(":index");
    }
    public function fangyuan(){      
        
        
        $catids=explode('-',I('get.id',0));//id为0-1-1-1-1-1-1-1.html样式
        
        if(count($catids)<>8){
            $this->error('参数不对！');
        }
        $catid=$catids[0];
                
		//$term=sp_get_term($catid);
		//$tplname=$term["list_tpl"];
    	//$tplname=sp_get_apphome_tpl($tplname, "list");
    	//$this->assign($term);
        
    	$this->assign('cat_id', $catid);
        $this->assign('path',genpath($catids[0],$catids[1]));//洋葱皮
        //var_dump($tplname);
    	$this->display(":fangyuan");
    }
    
    public function chuzu() {
    	$id=I('get.eid',0);
        $emmodel= M("JzEmployee");
        $join1=C('DB_PREFIX').'jz_area as b on b.id=a.xqid';
        $join2=C('DB_PREFIX').'district as c on c.id=a.areaid';
        $field='a.*,b.name as areaname,c.name as distname,b.pinyin as xqid,c.pinyin as areaid';
    	$employee=$emmodel->alias('a')->join($join1,"LEFT")->join($join2,"LEFT")->field($field)->where(array('status'=>1,'eid'=>$id))->find();
        if($employee){
            
        }
        else{
            $this->error("你访问的页面不存在，或已经删除！");
        }
        
    	$termid=$employee['termid'];
    	$term_obj= M("Terms");
    	$term=$term_obj->where("term_id='$termid'")->find();
    	
    	$eid=$employee['eid'];
    	
    	$should_change_post_hits=sp_check_user_action("jzemployee$eid",1,true);
    	if($should_change_post_hits){
    		
    		$emmodel->save(array("eid"=>$eid,"hits"=>array("exp","hits+1")));
    	}    	
    	
    	$next=$emmodel->where(array("eid"=>array("gt",$eid), "status"=>1,'termid'=>$termid,'serveritem'=>$employee['serveritem']))->order("eid asc")->find();
    	$prev=$emmodel->where(array("eid"=>array("lt",$eid), "status"=>1,'termid'=>$termid,'serveritem'=>$employee['serveritem']))->order("eid desc")->find();
    	
    	 
    	$this->assign("next",$next);
    	$this->assign("prev",$prev);
    	
    	$smeta=json_decode($employee['smeta'],true);   	
    	
    	$this->assign($employee);
    	$this->assign("smeta",$smeta);
    	$this->assign("term",$term);
    	$this->assign("eid",$eid);
        $this->assign('path',genpath($employee['serveritem'],$employee['areaid']));
    	//附近小区信息
        $this->fujin(($employee['xqid']));        
    	//$tplname=$term["one_tpl"];
    	//$tplname=sp_get_apphome_tpl($tplname, "article");
    	$this->display(":chuzu");
    }
    
    public function do_like(){
    	$this->check_login();
    	
    	$id=intval($_GET['id']);//posts表中id
    	
    	$posts_model=M("JzEmployee");
    	
    	$can_like=sp_check_user_action("jzemployee$id",1);
    	
    	if($can_like){
    		$posts_model->save(array("eid"=>$id,"likes"=>array("exp","likes+1")));
    		$this->success("赞好啦！");
    	}else{
    		$this->error("您已赞过啦！");
    	}
    	
    }
    /**
     * 发布租房信息
     * 
     */
    public function postzufang(){
        //echo 'good';
        $area=M('District')->where('upid='.C('AREAID'))->order(array("sorts"=>"asc"))->select();
        $this->assign('area',$area);
        $this->display(":postzufang");
    }
    public function add_post(){
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
			 
			
			//$_POST['post']['uid']=get_current_admin_id();
			$_POST=I("post.post");
            
            
            //检测验证码是否正确
            if(sp_check_sms($_POST['ephone'],$_POST['verify'])===false){
                $this->error("验证码失效或错误！");
            }
            //检查用户是否登录，未登录则直接查看手机号是否已注册，未注册则新注册用户，已注册用户直接返回用户信息（需要更改为提示用户登录）
            $user=A("User/Register");
            $rs=$user->frontregist($_POST['ephone']);
            if($rs){
                    $_POST['uid']=$rs['id'];
                    $_POST['smeta']=json_encode($_POST['smeta']);
        			//$article['post_content']=htmlspecialchars_decode($article['post_content']);
                    $_POST['peitao']=implode(",",array_filter($_POST['peitao']));
                    $_POST['shopfor']=implode(",",array_filter($_POST['shopfor']));
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
            else{
                $this->error("该手机号已经注册使用了，如果确认是你本人的，请登录后再来发布！");
            }
                        
			
			 
		}
	}
    /**
     * 获取附近的小区信息
     * 
     * 
     * 
     */
    private function fujin($areaid){
        $area=M('JzArea');
        $where1['id']=$areaid;
        $data1=$area->where($where1)->find();
        $data=array();
        if($data1){
            $latitude=$data1['lat'];
            $longitude=$data1['lng'];
            $i = 0.3; //差值可自定义，值越大，范围就越大
            $min_latitude = $latitude - $i; //纬度最小值
            $max_latitude = $latitude + $i; //纬度最大值
            $min_longitude = $longitude - $i; //经度最小值
            $max_longitude = $longitude + $i; //经度最大值
            
            $where['distid']=$data1['distid'];
            $where['lat']=array("between",array($min_latitude,$max_latitude));
            $where['lng']=array("between",array($min_longitude,$max_longitude));
            $where['d']=array('lgt',$i);
            $where['id']=array('neq',$areaid);
            $data=$area->field("id,name,address,SQRT(POWER($latitude - lat, 2) + POWER($longitude  - lng, 2)) AS d")->where($where)->order('d asc')->limit(20)->select();
            
        }
        $this->assign('fujin',$data);
    }

   
}