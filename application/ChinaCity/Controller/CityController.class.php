<?php
namespace Chinacity\Controller;
use Think\Controller;
class CityController extends Controller
{
    public function getcity($pid=22,$cid=369,$did=0,$coid=0)
    {
        //echo "中国省市";
        //$this->fetch("chinacity");
        $param["province"]=$pid;
        $param["city"]=$cid;
        $param["district"]=$did;
        $param["community"]=$coid;
        $this->assign("param",$param);
        return $this->fetch(":chinacity");
         
    } 
    public function getjiguan($id){
        $map["id"]=array("in",$id);
        
        $data=M("District")->where($map)->getField('shortname',true);        
        if($data){
            return implode(" ",$data);
        }
        else{
            return "";
        }
        
        
    } 

function fetch($templateFile='',$content='',$prefix=''){
		return parent::fetch($this->parseTemplate($templateFile),$content,$prefix);
	}
	
	
	/**
	 * 自动定位模板文件
	 * @access protected
	 * @param string $template 模板文件规则
	 * @return string
	 */
	public function parseTemplate($template='') {
		// 获取当前主题名称
		$theme      =    C('SP_DEFAULT_THEME');
		if(C('TMPL_DETECT_THEME')) {// 自动侦测模板主题
			$t = C('VAR_TEMPLATE');
			if (isset($_GET[$t])){
				$theme = $_GET[$t];
			}elseif(cookie('think_template')){
				$theme = cookie('think_template');
			}
			if(!file_exists($tmpl_path."/".$theme)){
				$theme  =   C('SP_DEFAULT_THEME');
			}
			cookie('think_template',$theme,864000);
		}
	
	
		$depr       =   C('TMPL_FILE_DEPR');
		$template   =   str_replace(':', $depr, $template);
	
		// 获取当前模版分组
		$group      =   "ChinaCity";
		// 获取当前主题的模版路径
		if(1==C('APP_GROUP_MODE')){ // 独立分组模式
			define('THEME_PATH',   $tmpl_path.$theme."/");
			define('APP_TMPL_PATH',__ROOT__.'/'.basename($tmpl_path).'/'.$theme."/");
		}
		// 分析模板文件规则
		if('' == $template) {
			// 如果模板文件名为空 按照默认规则定位
			$template = MODULE_NAME . $depr . ACTION_NAME;
		}elseif(false === strpos($template, '/')){
			$template = MODULE_NAME . $depr . $template;
		}
		$templateFile=THEME_PATH.$group.$template.C('TMPL_TEMPLATE_SUFFIX');
		if(!is_file($templateFile))
			throw_exception(L('_TEMPLATE_NOT_EXIST_').'['.$templateFile.']');
		return $templateFile;
	}
	
}
