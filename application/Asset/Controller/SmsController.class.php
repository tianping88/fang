<?php
namespace Asset\Controller;
use Think\Controller;
class SmsController extends Controller {
	//短信验证码
    private $stateMap = array(
        '手机号不正确',
        '正确',
        '当天已超过5条了'
    );
    function index(){
    	header("Content-type:text/html;charset=utf-8");
        
    	
    }
    /**
     * 向手机号发送短信
     * $_POST['to'] 发送的手机号
     * 
     * 
     * 
     */
    public function send(){
        
        $to = I('to'); 
        //验证手机号是否符合规则，符合则发送短信
        $param=$this->randstr();//生成验证码
        $result=$this->checkMobile($to,$param);             
        if($result===1){
            $data['status']=1;
                    $data['content']='短信验证码已发送成功，请注意查收短信';
                $this->ajaxReturn($data);
                exit;
                        //初始化必填
                $sms=C('SMSOPTION');
                $options['accountsid']=$sms['accountsid']; //填写自己的
                $options['token']=$sms['token']; //填写自己的
                
                        //初始化 $options必填
                    $ucpass = new \Org\Com\Ucpaas($options);
                        //短信验证码（模板短信）,默认以65个汉字（同65个英文）为一条（可容纳字数受您应用名称占用字符影响），超过长度短信平台将会自动分割为多条发送。分割后的多条短信将按照具体占用条数计费。
                    $appId = $sms['appid']; 
                    $templateId = $sms['templateid'];
                    
                    $arr=$ucpass->templateSMS($appId,$to,$templateId,$param);
                    if (substr($arr,21,6) == 000000) {
                    //如果成功就，这里只是测试样式，可根据自己的需求进行调节
                    $data['status']=1;
                    $data['content']='短信验证码已发送成功，请注意查收短信';
                    
                    
                    }else{
                        //如果不成功
                        $data['status']=0;
                        $data['content']='短信验证码发送失败，请联系客服'.$arr;                  
                        
                    }
                
                
        } else{
            $data['status']=0;
            $data['content']=$this->stateMap[$result];
            
            
        }       
        $this->ajaxReturn($data);
        
        
    }
    private function randstr(){
        //随机生成6位验证码
        srand((double)microtime()*1000000);//create a random number feed.
        $ychar="0,1,2,3,4,5,6,7,8,9";
        $list=explode(",",$ychar);
        $authnum='';
        for($i=0;$i<6;$i++){
            $randnum=rand(0,9); // 10+26;
            $authnum.=$list[$randnum];
        }
        return $authnum;
        
    }    
    /**
     * 检测手机号
     * 检测手机号是否正确，同一号码一天最多发送5条信息
     * @param string $mobilephone手机号
     * @param string $code 验证码
     * @param $times 每天限制的条数
     * @return 0:失败;1成功;2:当天已发了5条了
     */
    private function checkMobile($mobilephone,$code,$times=5){
        if(preg_match("/^13[0-9]{1}[0-9]{8}$|15[0-9]{1}[0-9]{8}$|18[0-9]{1}[0-9]{8}$/",$mobilephone)){
            //最近一小时发送的条数
            //$time=date(now(),'-1h');
            if(sp_check_mobile($mobilephone,$code,$times,true,24*60*60)){
                return 1;
            }
            else{
                return 2;
            }            
            
          }else{
            return 0;
          } 
}

}
