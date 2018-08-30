<?php
/*****************************
 *
 * 时间：2017年10月19日
 * 功能：忘记密码
 * 作者：Mr Peng
 *
 ****************************/ 
namespace Api\Controller;
use Think\Controller;
header('Content-Type:text/json;charset=utf-8');
header("Access-Control-Allow-Origin: *");
class ForgotController extends CommonController {

// +----------------------------------------------------------------------
// | 功能        | 忘记密码
// +----------------------------------------------------------------------
// | 请求类型    | POST
// +----------------------------------------------------------------------
// | 参数        | phone、verify、pass
// +----------------------------------------------------------------------

	public function index(){
	   if(IS_POST){
            $phone=I('post.phone');                 //获取手机号
            $verify=I('post.verify');               //获取验证码
            $pass=I('post.pass');                   //获取密码
            if(empty($phone)||$verify==''||$pass==''){
                $data=(object)null;
                echo json_encode($this->apiTemplate($data,'204','参数错误'));exit;
            }
            $user=M('user');
            $rel=$user->where(array('phone'=>$phone))->find();
            // 验证手机号是否注册
            if(!$rel){
                $data['result']=(object)null;
                $data['code']='202';
                $data['message']='手机号未注册';
                $data['time']=time();
                echo json_encode($data);
            }else{
                // 验证短信验证码是否正确
                $reg=S($phone);
                if(empty($reg) || $reg!=$verify){
                    $data['result']=(object)null;
                    $data['code']='202';
                    $data['message']='验证码不正确';
                    $data['time']=time();
                    echo json_encode($data);
                }else{

                    $mvp['pass']=md5(md5($pass));
                    $mvp['token']=md5($phone.$this->getRandomString(16));
                    $result=$user->where('user_id='.$rel['user_id'])->save($mvp);
                    // 验证密码是否更改成功
                    if($result !== false){
                            $data['result']['token']=$mvp['token'];
                            $data['code']='200';
                            $data['message']='成功';
                            $data['time']=time();
                            echo json_encode($data);
                    }else{
                            $data['result']=(object)null;
                            $data['code']='202';
                            $data['message']='失败';
                            $data['time']=time();
                            echo json_encode($data);
                    }

                }
            }
        }else{
            $data=(object)null;
            echo json_encode($this->apiTemplate($data,'203','请求类型错误'));
        }       
        
	}

// +----------------------------------------------------------------------
// | 功能       | 获取绑定手机号
// +----------------------------------------------------------------------
// | 请求类型   | POST
// +----------------------------------------------------------------------
// | 参数       | token
// +----------------------------------------------------------------------
    public function phone(){
        if(IS_POST){
            $token=I('post.token');
            if($token==''){
                $data=(object)null;
                echo json_encode($this->apiTemplate($data,'204','参数错误'));
            }else{
                $user=M('user');
                $userrel=$user->where(array('token'=>$token))->find();
                if($userrel){
                    if($userrel['vip_endtime']<time()){
                        $dovip['is_vip']=0;
                        M('user')->where(array('user_id'=>$userrel['user_id']))->save($dovip);
                    }
                    $data['phone']=$userrel['phone'];
                    echo json_encode($this->apiTemplate($data,'200','ok'));
                }else{
                    $data=(object)null;
                    echo json_encode($this->apiTemplate($data,'202','token过期'));
                }
            }
        }else{
            $data=(object)null;
            echo json_encode($this->apiTemplate($data,'203','请求类型错误'));
        }
    }
// +----------------------------------------------------------------------
// | 功能       | 忘记支付密码
// +----------------------------------------------------------------------
// | 请求类型   | POST
// +----------------------------------------------------------------------
// | 参数       | phone,verify
// +----------------------------------------------------------------------
    public function paypass(){
        if(IS_POST){
            $phone=I('post.phone');
            $verify=I('post.verify');
            if($phone==''||$verify==''){
                $data=(object)null;
                echo json_encode($this->apiTemplate($data,'204','参数错误'));
            }else{
                $reg=S($phone);
                if(empty($reg) || $reg!=$verify){
                    $data=(object)null;
                    echo json_encode($this->apiTemplate($data,'202','验证码不正确'));
                }else{
                    $data=(object)null;
                    echo json_encode($this->apiTemplate($data,'200','ok'));
                }
            }
        }else{
            $data=(object)null;
            echo json_encode($this->apiTemplate($data,'203','请求类型错误'));
        }
    }

}