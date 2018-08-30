<?php
/******************************
 *
 * 时间；2017年10月11日
 * 功能：短信验证码接口
 * 作者：Mr Peng
 *
 *****************************/ 
namespace Api\Controller;
use Think\Controller;
header('Content-Type:text/json;charset=utf-8');
header("Access-Control-Allow-Origin: *");
class VerifyController extends CommonController {

    

// +----------------------------------------------------------------------
// | 功能       | 获取短信验证码
// +----------------------------------------------------------------------
// | 请求类型   | POST
// +----------------------------------------------------------------------
// | 参数       | phone,type
// +----------------------------------------------------------------------    
	public function verify(){
        if(IS_POST){
            $g = "/^1[34578]\d{9}$/";               //手机号正则
            $code = rand (100000,999999);           //生成随机数
            $mobile=I('post.phone');                //手机号
            $type=I('post.type');
            if(empty($mobile)){
                $data=(object)null;
                echo json_encode($this->apiTemplate($data,'204','参数错误'));exit;
            }
            if($type=='1'){
                $user=M('user');
                $userrel=$user->field('phone')->where(array('phone'=>$mobile))->find();
                if($userrel){
                    $data=(object)null;
                    echo json_encode($this->apiTemplate($data,'202','手机号已存在'));exit;
                }
            }
            if(preg_match($g,$mobile)){
                $sms = new \Org\Util\Sms();         //实例阿里云短信接口
                $status = $sms->send_verify($mobile, $code);
//                 dump($status);
                if($status=='短信发送成功'){
                    S($mobile,$code,300);
                    $this->templateApi('','200','ok');
                }else{
                    $this->templateApi('','202','err');
                }
            }else{
                $this->templateApi('','202','手机号不正确');
            }   
        }else{
            $data=(object)null;
            echo json_encode($this->apiTemplate($data,'203','请求类型错误'));
        }

        
	}

//    public function aaaa(){
//        S('ga','hahaha',10);
//    }
//    public function aaaaa(){
//        echo S('ga');
//    }



}