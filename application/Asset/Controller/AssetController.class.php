<?php

/**
 * 附件上传
 */
namespace Asset\Controller;
use Common\Controller\AdminbaseController;
class AssetController extends AdminbaseController {
             

    function _initialize() {
    	$adminid=sp_get_current_admin_id();
    	$userid=sp_get_current_userid();
    	if(empty($adminid) && empty($userid)){
    		exit("非法上传！");
    	}
        
    }

    /**
     * swfupload 上传 ,暂时未用
     */
    public function swfupload1() {
        if (IS_POST) {
			
            //上传处理类
            $config=array(
            		'rootPath' => './'.C("UPLOADPATH"),
            		'savePath' => '',
            		'maxSize' => 11048576,
            		'saveName'   =>    array('uniqid',''),
            		'exts'       =>    array('jpg', 'gif', 'png', 'jpeg',"txt",'zip'),
            		'autoSub'    =>    true,//自动生成子目录 @回到起点
            );
			$upload = new Upload($config);// 
            
			$info=$upload->upload();
            
            //开始上传
            if ($info) {
                //上传成功
                //写入附件数据库信息
                $first=array_shift($info);
                if(!empty($first['url'])){
                	$url=$first['url'];
                }else{
                	$url=C("TMPL_PARSE_STRING.__UPLOAD__").$first['savepath'].$first['savename'];
                }
                //生成缩略图 @回到起点
                $filepath='./'.C("UPLOADPATH").$first['savepath'].$first['savename'];                
                $thumb=new Image();
                $thumb->open($filepath);
                $thumb->thumb(150,150)->save('./'.C("UPLOADPATH").$first['savepath'].'s_'.$first['savename']);
				echo "1," . $url.",".'1,'.$first['name'];
				exit;
            } else {
                //上传失败，返回错误
                exit("0," . $upload->getError());
            }
        } else {
            $this->display(':swfupload');
        }
    }
    /**
     * 多图上传
     * 
     */
	public function swfupload(){
	   
	   if(IS_POST){
	      $upload_config = array(
                    'mimes'         =>  array(), //允许上传的文件MiMe类型
                    'maxSize'       =>  2000000, //上传的文件大小限制 (0-不做限制)
                    'exts'          =>  array('jpg','png','gif','bmp'), //允许上传的文件后缀
                    'autoSub'       =>  true, //自动子目录保存文件
                    'subName'       =>  array('date', 'Y-m-d'), //子目录创建方式，[0]-函数名，[1]-参数，多个参数使用数组
                    'rootPath'      =>  './'.C("UPLOADPATH"),//保存根路径
                    'savePath'      =>  '', //保存路径
                    'saveName'      =>  array('uniqid', ''), //上传文件命名规则，[0]-函数名，[1]-参数，多个参数使用数组
                    'saveExt'       =>  '', //文件保存后缀，空则使用原后缀
                    'replace'       =>  false, //存在同名是否覆盖
                    'hash'          =>  true, //是否生成hash编码
                    'callback'      =>  false, //检测文件是否存在回调，如果存在返回文件信息数组
                    
                );
            
		$upload = new \Think\Upload($upload_config);	// 实例化上传类
		//头像目录地址
		//var_dump($upload);exit;
        $info=$upload->upload();
       
        $file=array_shift($info);
        $filepath=C("UPLOADPATH").$file['savepath'].$file['savename'];
        session('uploadfile',$file);//用session来保存上传文件信息，以便在剪裁的时候使用
        $imgurl=C("TMPL_PARSE_STRING.__UPLOAD__").$file['savepath'].$file['savename'];
        //var_dump($file);exit;
		if($file) {
		  $temp_size = getimagesize($filepath);
            
			//if($temp_size[0] < 100 || $temp_size[1] < 100){//判断宽和高是否符合头像要求
				//$this->ajaxReturn(array('status'=>0,'info'=>'图片宽或高不得小于100px！'));
			//}
            
                echo uniqid().','.$imgurl.',1,'.$file['name'];//附件aid,附件地址,附件类型1为图片,附件名称
                exit;
            
			
		}else{											
			// 上传错误提示错误信息
			//$this->ajaxReturn(array('status'=>0,'info'=>$upload->getError()));
            echo '0,'.$upload->getError();
            exit;
		} 
	   }
       else
       {    
            
                $this->display(":swfupload");
            
       }
	   
	}
   
    
    
    //上传头像
	public function uploadImg(){
	   
	   if(IS_POST){
	      $upload_config = array(
                    'mimes'         =>  array(), //允许上传的文件MiMe类型
                    'maxSize'       =>  2000000, //上传的文件大小限制 (0-不做限制)
                    'exts'          =>  array('jpg','png','gif','bmp'), //允许上传的文件后缀
                    'autoSub'       =>  true, //自动子目录保存文件
                    'subName'       =>  array('date', 'Y-m-d'), //子目录创建方式，[0]-函数名，[1]-参数，多个参数使用数组
                    'rootPath'      =>  './'.C("UPLOADPATH"),//保存根路径
                    'savePath'      =>  '', //保存路径
                    'saveName'      =>  array('uniqid', ''), //上传文件命名规则，[0]-函数名，[1]-参数，多个参数使用数组
                    'saveExt'       =>  '', //文件保存后缀，空则使用原后缀
                    'replace'       =>  false, //存在同名是否覆盖
                    'hash'          =>  true, //是否生成hash编码
                    'callback'      =>  false, //检测文件是否存在回调，如果存在返回文件信息数组
                    
                );
            
		$upload = new \Think\Upload($upload_config);	// 实例化上传类
		//头像目录地址
		//var_dump($upload);exit;
        $info=$upload->upload();
       
        $file=array_shift($info);
        $filepath=C("UPLOADPATH").$file['savepath'].$file['savename'];
        session('uploadfile',$file);//用session来保存上传文件信息，以便在剪裁的时候使用
        $imgurl=C("TMPL_PARSE_STRING.__UPLOAD__").$file['savepath'].$file['savename'];
        //var_dump($file);exit;
		if($file) {
		  $temp_size = getimagesize($filepath);
            
			if($temp_size[0] < 100 || $temp_size[1] < 100){//判断宽和高是否符合头像要求
				$this->ajaxReturn(array('status'=>0,'info'=>'图片宽或高不得小于100px！'));
			}
            
                $this->ajaxReturn(array('status'=>1,'path'=>$imgurl,'info'=>"上传成功"));// 上传成功 获取上传文件信息
            
			
		}else{											
			// 上传错误提示错误信息
			$this->ajaxReturn(array('status'=>0,'info'=>$upload->getError()));
		} 
	   }
       else
       {    
            
                $this->display(':uploadimg');
            
       }
	   
	}

	//裁剪并保存用户头像
	public function cropImg(){
	   if(IS_POST){
	       
	   
		//图片裁剪数据
		$params = I('post.');						//裁剪参数
		if(!isset($params) && empty($params)){
			$this->ajaxReturn(array('status'=>0,'info'=>'参数出错了'));
		}

		//头像目录地址
        
		//$path = $params['src'];
        $file=session('uploadfile');//在上传的时候保存的文件信息   
        
        //var_dump($filepath);exit;
		//要保存的图片
		//$cut_path =  C("UPLOADPATH").$file['savepath'].$file['savename'];;
		//临时图片地址
		$pic_path = C("UPLOADPATH").$file['savepath'].$file['savename'];;
        $pic_url=C("TMPL_PARSE_STRING.__UPLOAD__").$file['savepath'].$file['savename'];
        
		//实例化裁剪类,THINKIMAGE_IMAGICK,THINKIMAGE_GD
		$Think_img = new \Vendor\ThinkImage\ThinkImage(THINKIMAGE_GD,$pic_path);//这里如果报错，一定是文件路径错误，检查文件路径相对于网站根目录，特别是在子目录中的情况。
		//裁剪原图得到选中区域
        
        
            $Think_img->crop($params['w'],$params['h'],$params['x'],$params['y']);
    		//生成缩略图
    		$Think_img->thumb(200,200, 1)->save($pic_path);
    		//$Think_img->thumb(60,60, 1)->save('./'.implode('/',$filepath).'/60'.$filename);
    		//$Think_img->thumb(30,30, 1)->save('./'.implode('/',$filepath).'/30'.$filename);
            //unlink($pic_path);//删除上传的原图    		
            $this->ajaxReturn(array('status'=>1,'info'=>'剪裁成功！','path'=>'|'.$pic_url));//在回调的时候会判断是不是多文件上传，多文件使用|来分隔，回调函数在截取字符串的时候从第2个开始截取
        
            

        }
	}
    public function delete(){
        $data=array();
        $data['status']=0;
        if(IS_POST){
            $url=I('post.id');
            $url=str_replace(__ROOT__,'./',$url);
            if(file_exists($url)){
                unlink($url);
                $data['status']=1;
                $data['info']='操作成功';
            }else{
                $data['info']='文件不存在';
                
            }
        }else{
            $data['info']='操作不对';
            
        }
        $this->ajaxReturn($data);
    }

}
