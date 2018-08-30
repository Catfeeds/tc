<?php
/******************************
 *
 * 时间：2018.2.7
 * 功能：微信支付
 * 作者：Mr Peng
 *
 *****************************/ 
namespace Api\Controller;
use Think\Controller;
header('Content-Type:text/html;charset=utf-8');
header("Access-Control-Allow-Origin: *");
class WxpayController extends CommonController {
	//微信回调（pc）
	public function yznotify(){
		$order_num=I('post.order_num');
		$wxpay=M('wxpay');
		$rel=$wxpay->where(array('order_num'=>$order_num))->find();
		if($rel['status']=='1'){
			$data['status']='1';
			$this->templateApi($data,'200','ok');
		}else{
			$data['status']='0';
			$this->templateApi($data,'200','ok');
		}
	}
	//生成订单(pc)
	public function wxorder(){
		Vendor('Weixinpay.Weixinpay');
		$data=(object)null;
		if(IS_POST){
			$token=I('post.token');
			$orderid=I('post.orderid');
			$viporderid=I('post.viporderid');
			$money=I('post.money');
			$body=I('post.body');		// 1购买课程    2：开通会员  3：平台充值   4:缴纳保证金
			if($token==''||$body==''){
				$this->templateApi('','204','参数错误');
			}else{
				$user=M('user');
				$userrel=$user->where(array('token'=>$token))->find();
				if($userrel){
					if($body=='1'){
						$order=M('order')->where(array('order_id'=>$orderid))->find();
						$good=M('goods')->where(array('goods_id'=>$order['pid']))->field('name')->find();
						if($good['type']==1 || $good['type']==5){
							if($good['reg_status']==1){
								$this->templateApi('','202','您看中的课程已经被报名，换一个吧');exit;
							}
						}
						$content['body']='购买课程';
						$content['money']=$order['money']*100;

					}else if($body=='2'){
						$vip=M('vip')->where(array('vip_id'=>$viporderid))->find();
						$content['body'] = '开通会员';
						$content['money'] = $vip['money']*100;
					}else if($body=='3'){
						$content['body'] = '平台充值';
						$content['money'] = $money*100;
					}else{
						$content['body'] ='缴纳保证金';
						$content['money']= 2000*100;
						$mmp['uid']=$userrel['user_id'];
					}
					$order_num=$this->getRandomString(11);
					$time=time();
					$wxpay=M('wxpay');
					$mvp['uid']=$userrel['user_id'];
					$mvp['order_num']=$order_num;
					$mvp['money']=($content['money']/100);
					$mvp['status']=0;
					$mvp['body']=$content['body'];
					if($body=='1'){
						$mvp['product_id']=$orderid;
					}else if($body=='2'){
						$mvp['product_id']=$viporderid;
					}else{
						$mvp['product_id']=$money;
					}
					$mvp['time']=$time;
					$wxpayrel=$wxpay->add($mvp);
					$order=array(
						'body'			=>	$content['body'],
						'total_fee'		=>	$content['money'],
						'out_trade_no'	=>	$order_num,
						'product_id'	=>	$money,
						'trade_type'	=>	'NATIVE'
					);
					$wxpayy= new \Weixinpay();
					$result=$wxpayy->unifiedOrder($order);
					$date['code_url']=$result['code_url'];
					$date['order_num']=$order_num;
					echo json_encode($this->apiTemplate($date,'200','ok'));
				}else{
					$this->templateApi('','300','未登录');
				}
			}
		}else{
			$this->templateApi('','203','请求类型错误');
		}
	}

	//生成订单(h5)
	public function wxorder_h5(){
		Vendor('Weixinpay.Weixinpay');
		$data=(object)null;
		if(IS_GET){
			$token=I('get.token');
			$orderid=I('get.orderid');
			$viporderid=I('get.viporderid');
			$money=I('get.money');
			$body=I('get.body');		// 1购买课程    2：开通会员  3：平台充值   4:缴纳保证金
			if($token==''||$body==''){
				$this->templateApi('','204','参数错误');
			}else{
				$user=M('user');
				$userrel=$user->where(array('token'=>$token))->find();
				if($userrel){
					if($body=='1'){
						$order=M('order')->where(array('order_id'=>$orderid))->find();
						$good=M('goods')->where(array('goods_id'=>$order['pid']))->field('name')->find();
						if($good['type']==1 || $good['type']==5){
							if($good['reg_status']==1){
								$this->templateApi('','202','您看中的课程已经被报名，换一个吧');exit;
							}
						}
						$content['body']='购买课程';
						$content['money']=$order['money']*100;

					}else if($body=='2'){
						$vip=M('vip')->where(array('vip_id'=>$viporderid))->find();
						$content['body'] = '开通会员';
						$content['money'] = $vip['money']*100;
					}else if($body=='3'){
						$content['body'] = '平台充值';
						$content['money'] = $money*100;
					}else{
						$content['body'] ='缴纳保证金';
						$content['money']= 2000*100;
						$mmp['uid']=$userrel['user_id'];
					}
					$order_num=$this->getRandomString(11);
					$time=time();
					$wxpay=M('wxpay');
					$mvp['uid']=$userrel['user_id'];
					$mvp['order_num']=$order_num;
					$mvp['money']=($content['money']/100);
					$mvp['status']=0;
					$mvp['body']=$content['body'];
					if($body=='1'){
						$mvp['product_id']=$orderid;
					}else if($body=='2'){
						$mvp['product_id']=$viporderid;
					}else{
						$mvp['product_id']=$money;
					}
					$mvp['time']=$time;
					$wxpayrel=$wxpay->add($mvp);
					$order=array(
						'body'			=>	$content['body'],
						'total_fee'		=>	$content['money'],
						'out_trade_no'	=>	$order_num,
						'product_id'	=>	$money,
						'trade_type'	=>	'MWEB',
					);
					$wxpayy= new \Weixinpay();
					$result=$wxpayy->unifiedOrder_h5($order);
//					dump($result['mweb_url']);
					$redirect_url=urlencode('http://app.wyuek.com'.$body);
					$a=$result['mweb_url'];
					$a.='&redirect_url='.$redirect_url;
					echo "<script>window.location.href='".$a."'</script>";
//					$date['code_url']=$result['mweb_url'];
//					$date['order_num']=$order_num;
//					echo json_encode($this->apiTemplate($date,'200','ok'));
				}else{
					$this->templateApi('','300','未登录');
				}
			}
		}else{
			$this->templateApi('','203','请求类型错误');
		}
	}
// +----------------------------------------------------------------------
// | 功能       | 生成订单(app)
// +----------------------------------------------------------------------
// | 请求类型   | POST
// +----------------------------------------------------------------------
// | 参数       | token，money
// +---------------------------------------------------------------------- 
	public function gen_order(){
		Vendor('Weixinpay.Weixinpay');
		$data=(object)null;
		if(IS_POST){
			$token=I('post.token');
			$orderid=I('post.orderid');
			$viporderid=I('post.viporderid');
			$money=I('post.money');
			$body=I('post.body');		// 1购买课程    2：开通会员  3：平台充值   4:缴纳保证金
			if($token==''||$body==''){
				$this->templateApi('','204','参数错误');
			}else{
				$user=M('user');
				$userrel=$user->where(array('token'=>$token))->find();
				if($userrel){
					if($body=='1'){
						$order=M('order')->where(array('order_id'=>$orderid))->find();
						$good=M('goods')->where(array('goods_id'=>$order['pid']))->field('name')->find();
						if($good['type']==1 || $good['type']==5){
							if($good['reg_status']==1){
								$this->templateApi('','202','您看中的课程已经被报名，换一个吧');exit;
							}
						}
						$content['body']='购买课程';
						$content['money']=$order['money']*100;

					}else if($body=='2'){
						$vip=M('vip')->where(array('vip_id'=>$viporderid))->find();
						$content['body'] = '开通会员';
						$content['money'] = $vip['money']*100;
					}else if($body=='3'){
						$content['body'] = '平台充值';
						$content['money'] = $money*100;
					}else{
						$content['body'] ='缴纳保证金';
						$content['money']= 2000*100;
						$mmp['uid']=$userrel['user_id'];
					}
					$order_num=$this->getRandomString(11);
					$time=time();
					$wxpay=M('wxpay');
					$mvp['uid']=$userrel['user_id'];
					$mvp['order_num']=$order_num;
					$mvp['money']=($content['money']/100);
					$mvp['status']=0;
					$mvp['body']=$content['body'];
					if($body=='1'){
						$mvp['product_id']=$orderid;
					}else if($body=='2'){
						$mvp['product_id']=$viporderid;
					}else{
						$mvp['product_id']=$money;
					}
					$mvp['time']=$time;
					$wxpayrel=$wxpay->add($mvp);
					$order=array(
						'body'			=>	$content['body'],
		                'total_fee'		=>	$content['money'],
		                'out_trade_no'	=>	$order_num,
		                'product_id'	=>	$money,
		                'trade_type'	=>	'APP'
					);
					$weixin=new \Weixinpay();
					$result=$weixin->unifiedOrder_app($order);
					$date=array(
						'prepay_id'	=> 	$result['prepay_id'],
						'appid'		=>	'wx880a8faafec054bd',
						'partnerid'	=>	'1498267762',
						'noncestr'	=>	'apppay',
						'timestamp'	=>	$time,
						'out_trade_no'	=>	$order_num
					);
					$sign='appid='.$date['appid'].'&noncestr=apppay&package=Sign=WXPay&partnerid='.$date['partnerid'].'&prepayid='.$date['prepay_id'].'&timestamp='.$date['timestamp'].'&key=mO1IJTcrXourVguxPpb07W3n40OkWgQX';
					$signrel=md5($sign);
					$date['sign']=$signrel;
					echo json_encode($this->apiTemplate($date,'200','ok'));
				}else{
					$this->templateApi('','300','未登录');
				}
			}
		}else{
			$this->templateApi('','203','请求类型错误');
		}
	}
}
