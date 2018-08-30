<?php
/******************************
 *
 * 时间：2018年2月11日
 * 功能：提现功能
 * 作者：Mr Peng
 *
 *****************************/ 
namespace Api\Controller;
use Think\Controller;
header('Content-Type:text/json;charset=utf-8');
header("Access-Control-Allow-Origin: *");
class WithdrawController extends CommonController {

// +----------------------------------------------------------------------
// | 功能       | 提现2
// +----------------------------------------------------------------------
// | 请求类型   | post
// +----------------------------------------------------------------------
// | 参数       | token,money
// +----------------------------------------------------------------------    
	public function index_two(){
		$data=(object)null;
        if(IS_POST){
        	$token=I('post.token');
        	$money=I('post.money');
			$paypass=I('post.paypass');
        	if($token==''||$money==''||$paypass==''){echo json_encode($this->apiTemplate($data,'204','参数错误'));exit;}
        	if($money<100||$money>3000){echo json_encode($this->apiTemplate($data,'202','提现金额超过限制'));exit;}
        	$user=M('user');
        	$userrel=$user->where(array('token'=>$token))->find();
        	if(!$userrel){echo json_encode($this->apiTemplate($data,'202','token过期'));exit;}
			$userdata=M('userdata')->where(array('uid'=>$userrel['user_id']))->find();
			if($userdata['paypass']!=md5(md5($paypass))){
				$this->templateApi('','202','支付密码不正确');exit;
			}
        	$bank=M('pay');
        	$bankrel=$bank->where(array('uid'=>$userrel['user_id']))->find();
        	$result['bankstatus']="";
        	if(!$bankrel){echo json_encode($this->apiTemplate($result,'202','还没有绑定银行卡'));exit;}
        	$result['bankstatus']='1';
        	$class=M('class');
        	$classrel=$class->where(array('uid'=>$userrel['user_id']))->find();
        	if($money>$classrel['profit']){echo json_encode($this->apiTemplate($result,'202','提现金额有误'));exit;}
        	$withdraw=M('withdraw');
			$withdrawresult=$withdraw->where(array('uid'=>$userrel['user_id']))->order('time desc')->find();
			$tixiantime=$withdrawresult['time']+604800;
			if($tixiantime>time()){
				echo json_encode($this->apiTemplate($data,'202','一周只能提现一次'));exit;
			}
        	$date=array(
        		'uid'		=>	$userrel['user_id'],
        		'bankcard'	=>	$bankrel['bankcard'],
        		'time'		=>	time(),
        		'money'		=>	$money,
        		'status'	=>	'0'
        	);
        	$withdrawrel=$withdraw->add($date);
        	if($withdrawrel){
        		$classset=$class->where('class_id='.$classrel['class_id'])->setDec('profit',$money);
        		if($classset){
        			echo json_encode($this->apiTemplate($result,'200','ok'));
        		}else{
        			echo json_encode($this->apiTemplate($result,'202','失败'));
        		}
        	}else{
        		echo json_encode($this->apiTemplate($result,'202','失败'));
        	}

        }else{
        	echo json_encode($this->apiTemplate($data,'203','请求类型错误'));
        }
	}
// +----------------------------------------------------------------------
// | 功能       | 提现接口1
// +----------------------------------------------------------------------
// | 请求类型   | post
// +----------------------------------------------------------------------
// | 参数       | token
// +----------------------------------------------------------------------
	public function index_one(){
		$data=(object)null;
		if(IS_POST){
			$token=I('post.token');
			if($token==''){echo json_encode($this->apiTemplate($data,'204','参数错误'));exit;}
			$user=M('user');
			$userrel=$user->where(array('token'=>$token))->find();
			if(!$userrel){echo json_encode($this->apiTemplate($data,'202','token过期'));exit;}
			$bank=M('pay');
			$bankrel=$bank->where('uid='.$userrel['user_id'])->find();
			$result['bankstatus']='';
			if(!$bankrel){echo json_encode($this->apiTemplate($result,'202','还没有绑定银行卡'));exit;}
			$result['bankstatus']='1';
			$result['bank']=$bankrel['bank'];
			$result['card']=substr($bankrel['bankcard'],-4);
			echo json_encode($this->apiTemplate($result,'200','ok'));
		}else{
			echo json_encode($this->apiTemplate($data,'203','请求类型错误'));
		}
	}
// +----------------------------------------------------------------------
// | 功能       | 判断支付密码
// +----------------------------------------------------------------------
// | 请求类型   | post
// +----------------------------------------------------------------------
// | 参数       | token,paypass
// +----------------------------------------------------------------------
	public function pay_pass(){
		if(IS_POST){
			$token=I('post.token');
			$paypass=I('post.paypass');
			if($token==''||$paypass==''){echo json_encode($this->apiTemplate($data=(object)null,'204','参数错误'));exit;}
			$user=M('user');
			$userrel=$user->where(array('token'=>$token))->find();
			if(!$userrel){echo json_encode($this->apiTemplate($data=(object)null,'202','token过期'));exit;}
			$userdata=M('userdata');
			$userdatarel=$userdata->where(array('uid'=>$userrel['user_id']))->find();
			$data['paypassstatus']='';
			if(!$userdatarel['paypass']){echo json_encode($this->apiTemplate($data,'202','你还没有设置支付密码'));exit;}
			$newpaypass=md5(md5($paypass));
			if($userdatarel['paypass']!=$newpaypass){
				$data['paypassstatus']='err';
				echo json_encode($this->apiTemplate($data,'202','支付密码不正确'));
			}else{
				echo json_encode($this->apiTemplate($data=(object)null,'200','ok'));
			}

		}else{
			echo json_encode($this->apiTemplate($data=(object)null,'203','请求类型错误'));
		}
	}
// +----------------------------------------------------------------------
// | 功能       | 判断卡号开户行
// +----------------------------------------------------------------------
// | 请求类型   | post
// +----------------------------------------------------------------------
// | 参数       | bankcard
// +----------------------------------------------------------------------    
	public function bank_judge(){
        if(IS_POST){
        	$bankcard=I('post.bankcard');
        	if($bankcard==''){echo json_encode($this->apiTemplate($data=(object)null,'204','参数错误'));exit;}
        	$result=$this->bankCard_judge($bankcard);
        	$data['bank']="";
        	if(!$result){echo json_encode($this->apiTemplate($data,'202','无法识别'));exit;}
        	$newbank=explode('-',$result);
        	if($newbank['2']!='借记卡'){echo json_encode($this->apiTemplate($data,'202','无法识别'));exit;}
        	$data['bank']=$newbank['0'];
        	echo json_encode($this->apiTemplate($data,'200','ok'));
        }else{
			$data=(object)null;
        	echo json_encode($this->apiTemplate($data,'203','请求类型错误'));
        }
	}
// +----------------------------------------------------------------------
// | 功能       | 修改银行卡
// +----------------------------------------------------------------------
// | 请求类型   | post
// +----------------------------------------------------------------------
// | 参数       | token,bankcard,bank,name,idcard,phone,verify
// +---------------------------------------------------------------------- 
	public function bankadd(){
		$data=(object)null;
		if(IS_POST){
			$token=I('post.token');
			$bankcard=I('post.bankcard');
			$bank=I('post.bank');
			$name=I('post.name');
			$idcard=I('post.idcard');
			$phone=I('post.phone');
			$verify=I('post.verify');
			if($token==''||$bankcard==''||$bank==''||$name==''||$idcard==''||$phone==''||$verify==''){
				echo json_encode($this->apiTemplate($data,'204','参数错误'));exit;
			}
			if(strlen($bankcard)>19 || strlen($bankcard)<9){
				echo json_encode($this->apiTemplate($data,'202','银行卡号错误'));exit;
			}
			$user=M('user');
			$userrel=$user->where(array('token'=>$token))->find();
			if(!$userrel){echo json_encode($this->apiTemplate($data,'202','token过期'));exit;}
			$reg=S($phone);
			if(!$reg || $reg!=$verify) {
				$this->templateApi('','202','验证码错误');exit;
			}
			$pay=M('pay');
			$payrel=$pay->where('uid='.$userrel['user_id'])->find();
			if($payrel){
				$mvp=array(
					'idcard'		=>	$idcard,
					'bankcard'		=>	$bankcard,
					'bank'			=>	$bank,
					'phone'			=>	$phone,
					'name'			=>	$name
				);
				$result=$pay->where('pay_id='.$payrel['pay_id'])->save($mvp);
				if($result===false){
					echo json_encode($this->apiTemplate($data,'202','添加失败'));
				}else{
					echo json_encode($this->apiTemplate($data,'200','ok'));
				}
			}else{
				$mvp=array(
					'idcard'		=>	$idcard,
					'bankcard'		=>	$bankcard,
					'bank'			=>	$bank,
					'phone'			=>	$phone,
					'name'			=>	$name,
					'type'			=>	'1',
					'uid'			=>	$userrel['user_id']
				);
				$result=$pay->add($mvp);
				if($result===false){
					echo json_encode($this->apiTemplate($data,'202','添加失败'));
				}else{
					echo json_encode($this->apiTemplate($data,'200','ok'));
				}
			}
		}else{
			echo json_encode($this->apiTemplate($data,'203','请求类型错误'));
		}
	}
// +----------------------------------------------------------------------
// | 功能       | 解除银行卡
// +----------------------------------------------------------------------
// | 请求类型   | post
// +----------------------------------------------------------------------
// | 参数       | token
// +----------------------------------------------------------------------
	public function bankdel(){
		$data=(object)null;
		if(IS_POST){
			$token=I('post.token');
			if($token==''){echo json_encode($this->apiTemplate($data,'204','参数错误'));exit;}
			$user=M('user');
			$userrel=$user->where(array('token'=>$token))->find();
			if(!$userrel){echo json_encode($this->apiTemplate($data,'202','token过期'));exit;}
			$pay=M('pay');
			$payrel=$pay->where('uid='.$userrel['user_id'])->find();
			if(!$payrel){
				$date['bankstatus']='';
				echo json_encode($this->apiTemplate($date,'202','你还没有绑定银行卡'));
			}else{
				$result=$pay->where('pay_id='.$payrel['pay_id'])->delete();
				if($result){
					echo json_encode($this->apiTemplate($data,'200','ok'));
				}else{
					echo json_encode($this->apiTemplate($data,'202','解除失败'));
				}
			}
		}else{
			echo json_encode($this->apiTemplate($data,'203','请求类型错误'));
		}
	}
// +----------------------------------------------------------------------
// | 功能       | 获取银行卡信息
// +----------------------------------------------------------------------
// | 请求类型   | post
// +----------------------------------------------------------------------
// | 参数       | token
// +----------------------------------------------------------------------
	public function getbank(){
		$data=(object)null;
		if(IS_POST){
			$token=I('post.token');
			if($token==''){echo json_encode($this->apiTemplate($data,'204','参数错误'));exit;}
			$user=M('user');
			$userrel=$user->where(array('token'=>$token))->find();
			if(!$userrel){echo json_encode($this->apiTemplate($data,'202','token过期'));exit;}
			$pay=M('pay');
			$payrel=$pay->where('uid='.$userrel['user_id'])->find();
			if(!$payrel){
				echo json_encode($this->apiTemplate($data,'202','你还没有绑定银行卡'));
			}else{
				$result['bankcard']=$payrel['bankcard'];
				$result['bank']=$payrel['bank'];
				$result['name']=$payrel['name'];
				$result['phone']=$payrel['phone'];
				echo json_encode($this->apiTemplate($result,'200','ok'));
			}
		}else{
			echo json_encode($this->apiTemplate($data,'203','请求类型错误'));
		}
	}
}