<?php
namespace Home\Controller;
use Think\Controller;
header('Content-Type:text/json;charset=utf-8');
header("Access-Control-Allow-Origin: *");
class QqController extends Controller {

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

    //发起请求
    public function qqsend(){
        //参数
        $url = "https://graph.qq.com/oauth2.0/authorize";
        $param['response_type'] = "code";
        $param['client_id']="101460870";
        $param['redirect_uri'] ="http://www.wyuek.com/Home/Qq/qqback";
        $param['scope'] ="get_user_info";
        //-------生成唯一随机串防CSRF攻击
        $param['state'] = md5(uniqid(rand(), TRUE));
        $_SESSION['state'] = $param['state'];
 
        //拼接url
        $param = http_build_query($param,"","&");
        $url = $url."?".$param;
        header("Location:".$url);
    }
    //回调
    public function qqback(){
        $code = I('get.code');
        $state = I('get.state');
        if($code && $state == $_SESSION['state']){
            //获取access_token
            $res = $this->getAccessToken($code,"101460870","73ca2272d61e9f706b85618bb252ff69");
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
            $user_app=M('user');
           	$userrel=$user_app->where(array('open_id'=>$open_id))->find();
            if($userrel){
                S('H_user_id',$userrel['user_id']);
            }else{
                $mvp['time']=time();
                $mvp['status']='0';
                $mvp['name']=$this->getRandomString(8);
                $mvp['token']=md5($open_id.'qq'.$this->getRandomString(16));
                $mvp['login_time']=time();
                $mvp['login_num']=1;
                $mvp['login_type']='qq';
                $mvp['open_id']=$open_id;
                $useradd=$user_app->add($mvp);
                $mmp['uid']=$useradd;
                $mmp['image']='/Uploads/touxiang/1.png';
                M('userdata')->add($mmp);
                S('H_user_id',$useradd);
            }
            // $url = "https://graph.qq.com/user/get_user_info?access_token=".$access_token."&oauth_consumer_key=101460870&openid=".$open_id;
            // $user_info = $this->httpsRequest($url);
            // //输出qq用户信息
            // dump($user_info);
        }
        $this->redirect('Bdphone/index');
        // $this->display();
    }
    //通过Authorization Code获取Access Token
    public function getAccessToken($code,$app_id,$app_key){
        $url="https://graph.qq.com/oauth2.0/token";
        $param['grant_type']="authorization_code";
        $param['client_id']=$app_id;
        $param['client_secret']=$app_key;
        $param['code']=$code;
        $param['redirect_uri']="http://www.wyuek.com/Home/Qq/qqback";
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
 

   
}