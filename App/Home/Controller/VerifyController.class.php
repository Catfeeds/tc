<?php
/******************************
 *
 * 时间；2017年12月26日
 * 功能：短信验证码接口
 * 作者：Mr Peng
 *
 *****************************/ 
namespace Home\Controller;
use Think\Controller;
class VerifyController extends Controller {

// +----------------------------------------------------------------------
// | 功能       | 获取短信验证码
// +----------------------------------------------------------------------
// | 请求类型   | POST
// +----------------------------------------------------------------------
// | 参数       | phone
// +----------------------------------------------------------------------    
	public function verify(){
        if(IS_POST){
            $g = "/^1[34578]\d{9}$/";               //手机号正则
            $code = rand (100000,999999);           //生成随机数
            $mobile=I('post.phone');                //手机号
            if(empty($mobile)){
                $this->ajaxReturn('手机号不能为空');
            }
            if(preg_match($g,$mobile)){
                $sms = new \Org\Util\Sms();         //实例阿里云短信接口
                $status = $sms->send_verify($mobile, $code);
                if($status=='短信发送成功'){
                    $verify=M('verify');
                    $mvp['phone']=$mobile;
                    $mvp['verify']=$code;
                    $mvp['time']=time();
                    $rel=$verify->add($mvp);
                    if($rel){
                        $this->ajaxReturn('发送成功');
                    }else{
                        $this->ajaxReturn('验证码存储失败，请从新获取');
                    }
                    
                }else{
                $this->ajaxReturn('短信发送失败');
                }
            }else{
               $this->ajaxReturn('请输入正确的手机号');
            }   
        }else{
           $this->ajaxReturn('请求类型错误');
        }     
	}

}