<?php
/******************************
 *
 * 时间：2017年10月11日
 * 功能：用户登录接口
 * 作者：Mr Peng
 *
 *****************************/ 
namespace Api\Controller;
use Think\Controller;
header('Content-Type:text/json;charset=utf-8');
header("Access-Control-Allow-Origin: *");
class LoginController extends CommonController {

    //密码登录
    public function passlogin(){
        if(IS_POST){
            $phone=I('post.phone');  //获取手机号
            $pass=I('post.pass');    //获取密码
            if(empty($phone) || $pass==''){
                $data=(object)null;
                echo json_encode($this->apiTemplate($data,'204','参数错误'));exit;
            }
            $user=D('User');
            $rel=$user->where(array('phone'=>$phone))->find();
            // 判断手机号是否存在
            if(!$rel){
                $this->templateApi('','202','手机号不存在');
            }else{
                if($rel['status']==1){
                    $this->templateApi('','202','您的账号已封停，请联系管理员');exit;
                }
                // 判断密码是否正确
                $password=md5(md5($pass));
                if($password != $rel['pass']){
                    $this->templateApi('','202','密码不正确');
                }else{
                    $userdata=M('userdata');
                    $list=$userdata->where('uid='.$rel['user_id'])->find();
                    $data['uName']=$rel['name'];
                    if(empty($list['image'])){
                        $data['uImgURL']=URL.'/Uploads/touxiang/1.png';
                    }else{
                        $data['uImgURL']=URL.$list['image'];
                    }
                    if(empty($list['profile'])){
                        $data['uInfo']='';
                    }else{
                        $data['uInfo']=$list['profile'];
                    }
                    $sign=M('sign');
                    $signrel=$sign->where('uid='.$rel['user_id'])->find();
                    $start_time = strtotime(date('Y-m-d'));
                    if($signrel['time']>$start_time){
                        $data['isSignIn']='0';   //已签到
                    }else{
                        $data['isSignIn']='1';   //未签到
                    }
                    $mvp['login_time']=time();
                    $mvp['login_num']=$rel['login_num']+1;
//                    $mvp['token']=md5($phone.$this->getRandomString(16));
                    $user->where('user_id='.$rel['user_id'])->save($mvp);
                    $follow=M('follow')->where(array('uid'=>$rel['user_id']))->count();
                    $data['followNum']=(string)$follow;
                    $data['sex']=(string)$list['sex'];
                    $data['address']=(string)$list['address'];
                    $data['birthday']=(string)$list['birthday'];
                    $data['link']=(string)'http://www.baidu.com?intivi='.$rel['phone'];
                    $data['phone']=(string)$rel['phone'];
                    $data['is_vip']=(string)$rel['is_vip'];
                    $data['integral']=(string)$list['integral'];
                    $data['ykbBalance']=(string)$list['money'];
//                    $data['token']=$mvp['token'];
                    $data['token']=$rel['token'];
                    $data['code']='200';
                    $data['message']='登录成功';
                    $data['time']=time();
                    $this->templateApi($data,'200','ok');

                }
            }
        }else{
            $data=(object)null;
            echo json_encode($this->apiTemplate($data,'203','请求类型错误'));
        }
    	

	}

    //短信验证码登录
	public function verifylogin(){
        if(IS_POST){
            $phone=I('post.phone');         //获取手机号
            $verify=I('post.verify');       //获取验证码
            if(empty($phone)|| empty($verify)){
                $data=(object)null;
                echo json_encode($this->apiTemplate($data,'204','参数错误'));exit;
            }
            $user=M('user');
            $rel=$user->where(array('phone'=>$phone))->find();
            // 判断手机号是否存在
            if(!$rel){
                $this->templateApi('','202','用户不存在');
            }else{
                if($rel['status']==1){
                    $this->templateApi('','202','您的账号已封停，请联系管理员');exit;
                }
                // 判断验证码是否正确
                $reg=S($phone);
                if(!$reg || $reg!=$verify){
                    $data['result']=(object)null;
                    $data['code']='202';
                    $data['message']='验证码错误';
                    $data['time']=time();
                    echo json_encode($data);
                }else{
                    $userdata=M('userdata');
                    $list=$userdata->where('uid='.$rel['user_id'])->find();
                    $data['result']['uName']=$rel['name'];
                    if(empty($list['image'])){
                        $data['result']['uImgURL']=URL.'/Uploads/touxiang/1.png';
                    }else{
                        $data['result']['uImgURL']=URL.$list['image'];
                    }
                    if(empty($list['profile'])){
                        $data['result']['uInfo']='';
                    }else{
                        $data['result']['uInfo']=$list['profile'];
                    }
                    $sign=M('sign');
                    $signrel=$sign->where('uid='.$rel['user_id'])->find();
                    $start_time = strtotime(date('Y-m-d'));
                    if($signrel['time']>$start_time){
                        $data['result']['isSignIn']='0';   //已签到
                    }else{
                        $data['result']['isSignIn']='1';   //未签到
                    }
                    $mvp['login_time']=time();
                    $mvp['login_num']=$rel['login_num']+1;
//                    $mvp['token']=md5($phone.$this->getRandomString(16));
                    $user->where('user_id='.$rel['user_id'])->save($mvp);
                    $follow=M('follow')->where(array('uid'=>$rel['user_id']))->count();
                    $data['result']['followNum']=(string)$follow;
                    $data['result']['sex']=(string)$list['sex'];
                    $data['result']['address']=(string)$list['address'];
                    $data['result']['birthday']=(string)$list['birthday'];
                    $data['result']['link']=(string)'http://www.baidu.com?intivi='.$rel['phone'];
                    $data['result']['phone']=(string)$rel['phone'];
                    $data['result']['is_vip']=(string)$rel['is_vip'];
                    $data['result']['integral']=(string)$list['integral'];
                    $data['result']['ykbBalance']=(string)$list['money'];
//                    $data['result']['token']=$mvp['token'];
                    $data['result']['token']=$rel['token'];
                    $data['code']='200';
                    $data['message']='登录成功';
                    $data['time']=time();

                    echo json_encode($data);

                }
            }
        }else{
            $data=(object)null;
            echo json_encode($this->apiTemplate($data,'203','请求类型错误'));
        }
        

	}

    //第三方登录绑定本地数据
    public function threelogin(){
        $data=(object)null;
        if(IS_POST){
            $open_id=I('post.unioid');
            $login_type=I('post.login_type');
            if($open_id==''||$login_type==''){
                echo json_encode($this->apiTemplate($data,'204','参数错误'));
            }else{
                $user=M('user');
                if($login_type=='qq'){
                    $rel=$user->where(array('qq_unioid'=>$open_id))->find();
                }else if($login_type=='wx'){
                    $rel=$user->where(array('wx_unioid'=>$open_id))->find();
                }
                if($rel){
                    if($rel['status']==1){
                        $this->templateApi('','202','您的账号已封停，请联系管理员');exit;
                    }
                    $userdata=M('userdata');
                    $list=$userdata->where('uid='.$rel['user_id'])->find();
                    if(empty($list['image'])){
                        $date['uImgURL']=URL.'/Uploads/touxiang/1.png';
                    }else{
                        $date['uImgURL']=URL.$list['image'];
                    }
                    if(empty($list['profile'])){
                        $date['uInfo']='';
                    }else{
                        $date['uInfo']=$list['profile'];
                    }
                    $date['uName']=$rel['name'];
                    $sign=M('sign');
                    $signrel=$sign->where('uid='.$rel['user_id'])->find();
                    $start_time = strtotime(date('Y-m-d'));
                    if($signrel['time']>$start_time){
                        $date['isSignIn']='0';   //已签到
                    }else{
                        $date['isSignIn']='1';   //未签到
                    }
                    $mvp['login_time']=time();
                    $mvp['login_num']=$rel['login_num']+1;
//                    $mvp['token']=md5($open_id.$login_type.$this->getRandomString(16));
                    $user->where('user_id='.$rel['user_id'])->save($mvp);
                    $date['sex']=(string)$list['sex'];
                    $date['address']=(string)$list['address'];
                    $date['birthday']=(string)$list['birthday'];
                    $date['link']=(string)'http://www.baidu.com?intivi='.$rel['phone'];
                    $date['phone']=(string)$rel['phone'];
                    $date['is_vip']=(string)$rel['is_vip'];
                    $follow=M('follow')->where(array('uid'=>$rel['user_id']))->count();
                    $date['followNum']=(string)$follow;
                    $date['integral']=(string)$list['integral'];
                    $date['ykbBalance']=(string)$list['money'];
//                    $date['token']=$mvp['token'];
                    $date['token']=$rel['token'];
                    echo json_encode($this->apiTemplate($date,'200','ok'));
                }else{
                    $mvp['time']=time();
                    $mvp['name']=$this->getRandomString(8);
                    $mvp['token']=md5($open_id.$login_type.$this->getRandomString(16));
                    $mvp['login_time']=time();
                    $mvp['login_num']=1;
                    if($login_type=='qq'){
                        $mvp['qq_unioid']=$open_id;
                    }else if($login_type=='wx'){
                        $mvp['wx_unioid']=$open_id;
                    }
                    $userrel=$user->add($mvp);
                    if($userrel){
                        $userdata=M('userdata');
                        $msc['uid']=$userrel;
                        $msc['image']='/user/public_morentouxiang.png';
                        $msc['integral']=100;
                        $result=$userdata->add($msc);
                        if(!$result){
                            echo json_encode($this->apiTemplate($data,'202','登录失败'));
                        }else{
                            $date['uImgURL']=URL.'/user/public_morentouxiang.png';
                            $date['uName']=$mvp['name'];
                            $date['uInfo']='';
                            $date['isSignIn']='1';   //未签到
                            $date['sex']='';
                            $date['is_vip']='0';
                            $date['address']='';
                            $date['birthday']='';
                            $date['link']='';
                            $date['followNum']='0';
                            $date['integral']='100';
                            $date['ykbBalance']='0';
                            $date['phone']='';
                            $date['token']=$mvp['token'];
                            echo json_encode($this->apiTemplate($date,'200','登录成功'));
                        }
                    }else{
                        echo json_encode($this->apiTemplate($data,'202','登录失败'));
                    }
                }
            }
        }else{
            echo json_encode($this->apiTemplate($data,'203','请求类型错误'));
        }
    }

    //绑定device_tokens
    public function devicetoken(){
        $token=I('post.token');
        $devicetoken=I('post.devicetoken');
        $mvp['device_tokens']=$devicetoken;
        M('user')->where(array('token'=>$token))->save($mvp);
        $this->templateApi('','200','ok');
    }

    //解绑device_tokens
    public function del_devicetoken(){
        $token=I('post.token');
        $mvp['device_tokens']=null;
        M('user')->where(array('token'=>$token))->save($mvp);
        $this->templateApi('','200','ok');
    }

    //微信登录获取unioid （pc）
    public function wxunioid(){
        if(IS_GET){
            $code=I('code');
            if($code==''){
                $this->templateApi('','204','参数错误');exit;
            }
            $appid = 'wxe7092125741d3076';
            $secret = 'c82ef66b1f2f166ff5ba7ea2f8936f0f';
            $url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=".$appid."&secret=".$secret."&code=".$code."&grant_type=authorization_code";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $result = curl_exec($ch);
            curl_close($ch);
            $data=json_decode($result,true);
            $this->templateApi($data,'200','ok');
        }else{
            $this->templateApi('','203','请求类型错误');
        }
    }

    //qq登录发起请求(pc)
    public function qqsend(){
        //参数
        $url = "https://graph.qq.com/oauth2.0/authorize";
        $param['response_type'] = "code";
        $param['client_id']="101473475";
        $param['redirect_uri'] ="http://47.104.5.229/index.php/Api/Login/qqback";
        $param['scope'] ="get_user_info";
        //-------生成唯一随机串防CSRF攻击
        $param['state'] = md5(uniqid(rand(), TRUE));
        $_SESSION['state'] = $param['state'];

        //拼接url
        $param = http_build_query($param,"","&");
        $url = $url."?".$param;
        header("Location:".$url);
    }
    //qq登录回调(pc)
    public function qqback(){
        header('Content-Type:text/html;charset=utf-8');
        $code = I('get.code');
        $state = I('get.state');
        if($code && $state == $_SESSION['state']){
            //获取access_token
            $res = $this->getAccessToken($code,"101473475","182828ccf7f887fb745e4861d621a716");
            parse_str($res,$data);
            $access_token = $data['access_token'];
            $url  = "https://graph.qq.com/oauth2.0/me?access_token=".$access_token."&amp;unionid=1";
            $open_res = $this->httpsRequest($url);
            print_r($open_res);
            if(strpos($open_res,"callback") !== false){
                $lpos = strpos($open_res,"(");
                $rpos = strrpos($open_res,")");
                $open_res = substr($open_res,$lpos + 1 ,$rpos - $lpos - 1);
            }
            $user = json_decode($open_res);
            // dump($user);exit;
            $open_id = $user->openid;
//            $url = "https://graph.qq.com/user/get_user_info?access_token=".$access_token."&oauth_consumer_key=101473475&openid=".$open_id;
//            $user_info = $this->httpsRequest($url);
//            //输出qq用户信息
//            dump($user_info);exit;
            $user_app=M('user');
            $userrel=$user_app->where(array('qq_unioid'=>$open_id))->find();
            if($userrel['phone']){
                $img=M('userdata')->where(array('uid'=>$userrel['user_id']))->find();
                $rel['url']='http://www.wyuek.com?token='.$userrel['token'].'&img='.URL.$img['image'];
            }else{
                $mvp['time']=time();
                $mvp['status']='0';
                $mvp['name']=$this->getRandomString(8);
                $mvp['token']=md5($open_id.'qq'.$this->getRandomString(16));
                $mvp['login_time']=time();
                $mvp['login_num']=1;
                $mvp['login_type']='qq';
                $mvp['qq_unioid']=$open_id;
                $useradd=$user_app->add($mvp);
                $mmp['uid']=$useradd;
                $mmp['image']='/user/public_morentouxiang.png';
                M('userdata')->add($mmp);
                $us=M('user')->where(array('user_id'=>$useradd))->find();
                $rel['url']='http://www.wyuek.com/html/bindPhone.html?token='.$us['token'].'&img='.URL.$mmp['image'];
            }

        }
//        $tiao="<script>window.location.href=".$rel['url']."</script>";
//        echo $tiao;
        header("Location:".$rel['url']);
}

    //通过Authorization Code获取Access Token
    public function getAccessToken($code,$app_id,$app_key){
        $url="https://graph.qq.com/oauth2.0/token";
        $param['grant_type']="authorization_code";
        $param['client_id']=$app_id;
        $param['client_secret']=$app_key;
        $param['code']=$code;
        $param['redirect_uri']="http://47.104.5.229/index.php/Api/Login/qqback";
        $param =http_build_query($param,"","&");
        $url=$url."?".$param;
        return $this->httpsRequest($url);
    }

    //httpsRequest
    public function httpsRequest($post_url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$post_url);//要访问的地址
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//执行结果是否被返回，0是返回，1是不返回
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);//设置超时
        $result = curl_exec($ch);//执行并获取数据
        return $result;
        curl_close($ch);
    }

    //微信登录回调
    public function pc_wx(){
        $user=D('user');
        if(isset($_GET['code']) && $_GET['state']=='3072355978'){
            $appid = 'wxe7092125741d3076';
            $secret = 'c82ef66b1f2f166ff5ba7ea2f8936f0f';
            $code=$_GET['code'];

            $url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=".$appid."&secret=".$secret."&code=".$code."&grant_type=authorization_code";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $result = curl_exec($ch);
            curl_close($ch);
            $data=json_decode($result,true);
            $userrel=$user->where(array('wx_unioid'=>$data['unionid']))->find();
            if($userrel['phone']){
                $img=M('userdata')->where(array('uid'=>$userrel['user_id']))->find();
                $rel['url']='http://www.wyuek.com?token='.$userrel['token'].'&img='.URL.$img['image'];
            }else{
                $mvp['time']=time();
                $mvp['status']='0';
                $mvp['name']=$this->getRandomString(8);
                $mvp['token']=md5($data['unionid'].'wx'.$this->getRandomString(16));
                $mvp['login_time']=time();
                $mvp['login_num']=1;
                $mvp['login_type']='wx';
                $mvp['wx_unioid']=$data['unionid'];
                $useradd=$user->add($mvp);
                $mmp['uid']=$useradd;
                $mmp['image']='/Uploads/touxiang/1.png';
                M('userdata')->add($mmp);
                $us=M('user')->where(array('user_id'=>$useradd))->find();
                $rel['url']='http://www.wyuek.com/html/bindPhone.html?token='.$us['token'].'&img='.URL.$mmp['image'];
            }

        }
        header("Location:".$rel['url']);
    }
}