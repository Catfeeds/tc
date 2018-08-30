<?php
namespace Home\Controller;
use Think\Controller;
// header('Content-Type:text/json;charset=utf-8');
// header("Access-Control-Allow-Origin: *");
class BdphoneController extends Controller {
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
			$userrel=$user->where(array('open_id'=>$data['unionid']))->find();
			if($userrel){
				S('H_user_id',$userrel['user_id']);
			}else{
				$mvp['time']=time();
				$mvp['status']='0';
				$mvp['name']=$this->getRandomString(8);
				$mvp['token']=md5($data['unionid'].'wx'.$this->getRandomString(16));
				$mvp['login_time']=time();
				$mvp['login_num']=1;
				$mvp['login_type']='wx';
				$mvp['open_id']=$data['unionid'];
				$useradd=$user->add($mvp);
				$mmp['uid']=$useradd;
				$mmp['image']='/Uploads/touxiang/1.png';
				M('userdata')->add($mmp);
				S('H_user_id',$useradd);
			}

		}
    	$id=S('H_user_id');
    	$userrell=$user->where('user_id='.$id)->find();
    	if($userrell['phone']==''){
    		$this->display();
    	}else{
			session('H_user_id',$id);
    		$this->redirect('Index/index');
    	}
    	
    }
    public function verify(){
    	$config =    array(    
    		'fontSize'    =>    30,    // 验证码字体大小    
    		'length'      =>    4,     // 验证码位数    
    		'useNoise'    =>    false, // 关闭验证码杂点
    	);
    	$Verify =     new \Think\Verify($config);
    	$Verify->entry();
    }
    public function doverify(){
    	$code=I('post.code');
    	$verify = new \Think\Verify();    
    	$date=$verify->check($code);
    	$this->ajaxReturn($date);
    	// return $verify->check($code);
    }

    public function bdphone(){
    	$phone=I('post.phone');
    	$verify=I('post.verify');
    	$user=M('user');
    	$userrel=$user->where('phone='.$phone)->find();
    	if($userrel){
    		$this->ajaxReturn(array('code'=>'202','mes'=>'手机号已存在'));
    	}else{
    		// 判断验证码是否正确
            $yzm=M('verify');
            $reg=$yzm->where('phone='.$phone)->order('time desc')->find();
            if(!$reg || $reg['verify']!=$verify){
                $this->ajaxReturn(array('code'=>'203','mes'=>'验证码不正确'));
            }else{
                // 判断验证码是否过期
                $times=time()-$reg['time'];
                if($times>300){
                    $yzm->where('verify_id='.$reg['verify_id'])->delete();
                   	$this->ajaxReturn(array('code'=>'204','mes'=>'验证码超时，请重新获取'));
                    
                }else{
                    $yzm->where('verify_id='.$reg['verify_id'])->delete();
                   
                    $id=S('H_user_id');
                    $mvp['phone']=$phone;
                    $save=$user->where('user_id='.$id)->save($mvp);
                    if($save){
						session('H_user_id',$id);
                    	$this->ajaxReturn(array('code'=>'200','mes'=>'绑定成功'));
                    }else{
                    	$this->ajaxReturn(array('code'=>'201','mes'=>'网络异常'));
                    }
                }
            }
    	}
    }

   
}