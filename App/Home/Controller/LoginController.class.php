<?php


/******************************
 *
 * 时间；2017年12月25日
 * 功能：短信验证码接口
 * 作者：Mr Peng
 *
 *****************************/ 

namespace Home\Controller;
use Think\Controller;
header('Content-Type:text/html;charset=utf-8');
// header("Access-Control-Allow-Origin: *");
class LoginController extends Controller {

    public function getRandomString($len, $chars=null){  
        if (is_null($chars)){  
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";  
        }  
        mt_srand(10000000*(double)microtime());  
        for ($i = 0, $str = '', $lc = strlen($chars)-1; $i < $len; $i++) {  
            $str .= $chars[mt_rand(0, $lc)];  
        }  
        return $str;  
    }

	public function index(){
        if(IS_GET){
            $id=$_GET['login'];
            /*$pid=substr($id, -12, 12);
            //dump($pid);
            $uid=str_replace($pid,"",$id); 
            //dump($uid);*/
            $uid=base64_decode($id);
            $this->assign('uid',$uid);
        }
        
		$this->display();
	}

// +----------------------------------------------------------------------
// | 功能       | 密码登录
// +----------------------------------------------------------------------
// | 请求类型   | POST
// +----------------------------------------------------------------------
// | 参数       | phone、pass
// +----------------------------------------------------------------------
     public function yanzheng(){
        $phone=$_GET['phone'];
        $m=D('user');
        $res=$m->where('phone='.$phone)->find();
        //dump($res);
        if($res){
            echo 1;
        }else{
            echo 2;
        }
     }
    public function yanmi(){
        $phone=$_POST['phone'];
        $pass=I('post.pass');
        $m=D('user');
        $res=$m->where('phone='.$phone)->find();

        if($res['pass']==md5(md5($pass))){
            echo 1;
        }else{
            echo 2;
        }
    }
    public function regist(){
        if(IS_POST){
            $phone=I('post.phone');  //获取手机号
            $pass=I('post.pass');    //获取密码
            //$repass=I('post.repass');//验证密码
            $verify=I('post.verify');//获取验证码
            $name   = $this->getRandomString(8);    //获取随机昵称（字母和数字结合）
            $user=M('user');
            $rel=$user->where('phone='.$phone)->find(); // 判断手机号是否存在
            if($rel){
                $this->ajaxReturn('手机号已存在');
            }else{
                // 判断验证码是否正确
                $yzm=M('verify');
                $reg=$yzm->where('phone='.$phone)->order('time desc')->find();
                if(!$reg || $reg['verify']!=$verify){
                    $this->ajaxReturn('验证码错误');
                }else{
                    // 判断验证码是否过期
                    $times=time()-$reg['time'];
                    if($times>300){
                        $yzm->where('verify_id='.$reg['verify_id'])->delete();
                        $this->ajaxReturn('验证码超时');
                    }else{ 
                        if($_POST['uid']){
                            $userli=$user->where('user_id='.$_POST['uid'])->find();
                            //dump($userli);
                            $data['cishu']=$userli['cishu']+1;
                            $userlist=$user->where('user_id='.$_POST['uid'])->save($data);
                            $mvp['time']=time();
                            $mvp['phone']=$phone;
                            $mvp['pass']=md5(md5($pass));
                            $mvp['name']=$name;
                            $mvp['token']=md5($phone.$this->getRandomString(16));
                            $xieyi=$_POST['xieyi'];
                            if($xieyi!='true'){
                                $this->ajaxReturn('请勾选用户注册协议');exit;
                            }
                            $add=$user->data($mvp)->add();
                            
                            $userdata=M('userdata');
                            $msc['uid']=$add;
                            $msc['image']='/Uploads/touxiang/1.png';
                            $result=$userdata->add($msc);
                            $yzm->where('verify_id='.$reg['verify_id'])->delete();

                            $this->ajaxReturn('注册成功');
                        }else{
                        $mvp['time']=time();
                        $mvp['phone']=$phone;
                        $mvp['pass']=md5(md5($pass));
                        $mvp['name']=$name;
                        $mvp['token']=md5($phone.$this->getRandomString(16));
                        $xieyi=$_POST['xieyi'];
                            if($xieyi!='true'){
                                $this->ajaxReturn('请勾选用户注册协议');exit;
                            }
                        $add=$user->data($mvp)->add();
                        
                        $userdata=M('userdata');
                        $msc['uid']=$add;
                        $msc['image']='/Uploads/touxiang/1.png';
                        $result=$userdata->add($msc);
                        $yzm->where('verify_id='.$reg['verify_id'])->delete();

                        $this->ajaxReturn('注册成功');}
                        
                       
                    }
                }
            }
        }
        $this->display();
        }
    public function passlogin(){
        if(IS_POST){
            $phone=I('post.phone');  //获取手机号
            $pass=I('post.pass');    //获取密码
            $user=D('user');
            $rel=$user->where('phone='.$phone)->find();
            // 判断手机号是否存在
            if(!$rel){
                 $this->ajaxReturn('手机号尚未注册');
            }else{
                // 判断密码是否正确
                $password=md5(md5($pass));
                //echo $password;
                if($password != $rel['pass']){
                     $this->ajaxReturn('密码错误');
                }else{
                    if($rel['status']==1){
                        $this->ajaxReturn('您已经被封号请联系客服');
                    }
                    session('H_user_id',$rel['user_id']);
                    $mvp['login_time']=time();
                    $mvp['login_num']=$rel['login_num']+1;
                    $user->where('user_id='.$rel['user_id'])->save($mvp);
                    $this->ajaxReturn('登录成功');
                } 
            }
        }
	}

// +----------------------------------------------------------------------
// | 功能       | 短信验证码登录
// +----------------------------------------------------------------------
// | 请求类型   | POST
// +----------------------------------------------------------------------
// | 参数       | phone、verify
// +----------------------------------------------------------------------
	public function verifylogin(){
        if(IS_POST){
            $phone=I('post.phone');         //获取手机号
            $verify=I('post.verify');       //获取验证码
            $user=M('user');
            $rel=$user->where('phone='.$phone)->find();
            // 判断手机号是否存在
            if(!$rel){
                $this->ajaxReturn('手机号不存在');
            }else{
                // 判断验证码是否正确
                $yzm=M('verify');
                $reg=$yzm->where('phone='.$phone)->order('time desc')->find();
                if(!$reg || $reg['verify']!=$verify){
                    $this->ajaxReturn('验证码错误');
                }else{
                    // 判断验证码是否过期
                    $times=time()-$reg['time'];
                    if($times>300){
                        $yzm->where('verify_id='.$reg['verify_id'])->delete();
                       $this->ajaxReturn('验证码超时');
                        
                    }else{
                        $yzm->where('verify_id='.$reg['verify_id'])->delete();
                       if($rel['status']==1){
                        $this->ajaxReturn('您已经被封号请联系客服');
                    }
                        session('H_user_id',$rel['user_id']);
                        $mvp['login_time']=time();
                        $mvp['login_num']=$rel['login_num']+1;
                        $user->where('user_id='.$rel['user_id'])->save($mvp);
                         $this->ajaxReturn('登录成功');
                    }
                }
            }
        }
	}
// +----------------------------------------------------------------------
// | 功能       | 退出登录
// +----------------------------------------------------------------------
// | 请求类型   | 
// +----------------------------------------------------------------------
// | 参数       | 
// +----------------------------------------------------------------------
	public function outlogin(){
	    unset($_SESSION['H_user_id']);
         $this->ajaxReturn('退出成功');
       }     
   public function mima(){
        if(IS_POST){
            $phone=I('post.phone');  //获取手机号
            $pass=I('post.pass');    //获取密码
            //$repass=I('post.repass');//验证密码
            $verify=I('post.verify');//获取验证码
            $user=M('user');
            $rel=$user->where('phone='.$phone)->find(); // 判断手机号是否存在
            if(!$rel){
                $this->ajaxReturn('手机号尚未注册');
            }else{
                // 判断验证码是否正确
                $yzm=M('verify');
                $reg=$yzm->where('phone='.$phone)->order('time desc')->find();
                if(!$reg || $reg['verify']!=$verify){
                    $this->ajaxReturn('验证码错误');
                }else{
                    // 判断验证码是否过期
                    $times=time()-$reg['time'];
                    if($times>300){
                        $yzm->where('verify_id='.$reg['verify_id'])->delete();
                        $this->ajaxReturn('验证码超时');
                    }else{ 
                        $mvp['pass']=md5(md5($pass));
                        $add=$user->where('user_id='.$rel['user_id'])->save($mvp);
                        $yzm->where('verify_id='.$reg['verify_id'])->delete();
                        $this->ajaxReturn('修改成功');
                        
                       
                    }
                }
            }
        }
   } 

   /***************微信登录******************/

   public function weixinlogin(){
        
   }

   /***************QQ登录******************/

   public function qqlogin(){

   }

    /***************微博登录******************/

    public function weibologin(){

    }
     public function xieyi1(){
        
        $id=$_GET['id'];
        if($id){
            $xieyi=D('xieyi');
            $list=$xieyi->where('xieyi_id='.$id)->find();
            $this->assign('list',$list);
            $this->display();
        }else{
           $xieyi=D('xieyi');
        $list=$xieyi->where('type=1')->find();
        //dump($list);
        $this->assign('list',$list);
        $this->display(); 
        }
        
    }
}