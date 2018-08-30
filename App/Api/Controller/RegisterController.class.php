<?php
/****************************
 *
 * 时间：2017年10月12日
 * 功能：用户注册接口
 * 作者：Mr Peng
 *
 ****************************/ 
namespace Api\Controller;
use Think\Controller;
header('Content-Type:text/json;charset=utf-8');
header("Access-Control-Allow-Origin: *");
class RegisterController extends CommonController {

// +----------------------------------------------------------------------
// | 功能 		| 注册
// +----------------------------------------------------------------------
// | 请求类型 	| POST
// +----------------------------------------------------------------------
// | 参数 		| phone、verify、pass
// +----------------------------------------------------------------------
    public function index(){
    	if(IS_POST){
			$phone  = I('post.phone');   			//获取手机号
			$verify = I('post.verify');				//获取短信验证码
			$pass   = I('post.pass');				//获取密码
			$invitecode=I('post.invitecode');		//推荐码
			if($phone==''||$verify==''||$pass==''){
                $data=(object)null;
                echo json_encode($this->apiTemplate($data,'204','参数错误'));exit;
            }
			$user=D('User');
			if($invitecode){
				$invirel=$user->where(array('phone'=>$invitecode))->find();
				if($invirel){

				}else{
					$this->templateApi('','202','邀请码不正确');exit;
				}
			}
			$name   = $this->getRandomString(8);	//获取随机昵称（字母和数字结合）
			$rel=$user->where(array('phone'=>$phone))->find();
			if(!$invitecode){

			}else{
				$pid=$user->where(array('invitecode'=>$invitecode))->find();
				if($pid){
					$mvp['referee_id']=$pid['user_id'];
				}else{

				}
			}
			// 验证手机号存不存在
			if($rel){
				$data['result']=(object)null;
				$data['code']="202";
				$data['message']="手机号已注册";
				$data['time']=time();
				echo json_encode($data);
			}else{
				// 验证验证码正确不正确
				$reg=S($phone);
				if(empty($reg) || $reg!=$verify){

					$data['result']=(object)null;
					$data['code']='202';
					$data['message']='验证码错误';
					$data['time']=time();
					echo json_encode($data);
				}else{
					$mvp['phone']=$phone;
					$mvp['pass']=md5(md5($pass));
					$mvp['name']=$name;
					$mvp['time']=time();
					$mvp['invitecode']=$this->getRandomString(6,'0123456789');
					$mvp['token']=md5($phone.$this->getRandomString(16));
					$add=$user->add($mvp);
					// 判断数据是否添加成功
					if($add){
						$userdata=M('userdata');
						$msc['uid']=$add;
						$msc['image']='/user/public_morentouxiang.png';
						$msc['integral']=100;
						$result=$userdata->add($msc);
						if(!$result){
							$data['result']=(object)null;
							$data['code']='202';
							$data['message']='注册失败';
							$data['time']=time();
							echo json_encode($data);
						}else{
							$data['result']['uImgURL']=URL.'/user/public_morentouxiang.png';
							$data['result']['uName']=$mvp['name'];
							$data['result']['uInfo']='';
							$data['result']['is_vip']='0';
							$data['result']['isSignIn']='1';
							$data['result']['followNum']='0';
							$data['result']['sex']='';
							$data['result']['address']='';
							$data['result']['birthday']='';
							$data['result']['phone']=$phone;
							$data['result']['link']=(string)'http://www.baidu.com?intivi='.$phone;
							$data['result']['integral']='100';
							$data['result']['ykbBalance']='0';
							$data['result']['token']=$mvp['token'];
//								$data['result']['invitecode']=$mvp['invitecode'];
							$data['code']='200';
							$data['message']='注册成功';
							$data['time']=time();
							echo json_encode($data);
						}

					}else{
						$data['result']=(object)null;
						$data['code']='202';
						$data['message']="注册失败";
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


}