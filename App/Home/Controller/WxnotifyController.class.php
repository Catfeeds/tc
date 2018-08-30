<?php
namespace Home\Controller;
use Think\Controller;
 header('Content-Type:text/json;charset=utf-8');
 header("Access-Control-Allow-Origin: *");
class WxnotifyController extends Controller {
    public function index(){
    	// 导入微信支付sdk
	    Vendor('Weixinpay.Weixinpay');
	    $wxpay=new \Weixinpay();
	    $result=$wxpay->notify();
	    if ($result) {
			//支付成功
	        $wxorder=M('wxpay');
	        $wxorderrel=$wxorder->where(array('order_num'=>$result['out_trade_no']))->find();
			//修改微信订单支付状态
	        $mvp['status']="1";
	        $wxorder->where(array('wxpay_id'=>$wxorderrel['wxpay_id']))->save($mvp);

			if($wxorderrel['body']=='平台充值'){
				//金额充值到用户账号
				$uid=$wxorderrel['uid'];
				$userdata=M('userdata');
				$userdata->where(array('uid'=>$uid))->setInc('money',$wxorderrel['money']);
				//添加用户交易记录
				$payrecord=M('payrecord');
				$mmp['uid']=$uid;
				$mmp['type']=1;
				$mmp['time']=time();
				$mmp['income']=$wxorderrel['money'];
				$mmp['source']='平台充值';
				$mmp['ptype']=0;
				$payrecord->add($mmp);
				//给用户加积分，1约课币等于10积分，日上限1000
				$today = strtotime(date("Y-m-d"),time());
				$today1=$today+86399;
				$paywhere['uid']=$uid;
				$paywhere['source']='平台充值';
				$paywhere['time']=array('BETWEEN',$today,$today1);
				$payrel=$payrecord->where($paywhere)->select();
				$jimoney=0;
				foreach($payrel as $k=>$v){
					$jimoney+=$v['income'];
				}
				if(($jimoney-$wxorderrel['money'])>100){

				}else{
					if($jimoney>100){
						$jimoney=100-($jimoney-$wxorderrel['money']);
						$userdata->where(array('uid'=>$uid))->setInc('integral',($jimoney*10));
					}else{
						$userdata->where(array('uid'=>$uid))->setInc('integral',($jimoney*10));
					}
				}
			}else if($wxorderrel['body']=='开通会员'){
				//修改vip订单状态
				$vip=M('vip');
				$mvp['status']=1;
				$vip->where(array('vip_id'=>$wxorderrel['product_id']))->save($mvp);
				$viprel=$vip->where(array('vip_id'=>$wxorderrel['product_id']))->find();
				//设置用户vip
				$user=M('user')->where(array('user_id'=>$wxorderrel['uid']))->find();
				$uvm['is_vip']=1;
				if($user['vip_time']){

				}else{
					$uvm['vip_time']=time();
				}
				if($user['vip_endtime']){
					if($user['vip_endtime']<time()){
						if($viprel['type']==0){
							$uvm['vip_endtime']=time()+(86400*30);	//月
						}else if($viprel['type']==1){
							$uvm['vip_endtime']=time()+(86400*30*3);	//季
						}else{
							$uvm['vip_endtime']=time()+(86400*30*12);	//年
						}
					}else{
						if($viprel['type']==0){
							$uvm['vip_endtime']=$user['vip_endtime']+(86400*30);	//月
						}else if($viprel['type']==1){
							$uvm['vip_endtime']=$user['vip_endtime']+(86400*30*3);	//季
						}else{
							$uvm['vip_endtime']=$user['vip_endtime']+(86400*30*12);	//年
						}
					}
				}else{
					if($viprel['type']==0){
						$uvm['vip_endtime']=time()+(86400*30);	//月
					}else if($viprel['type']==1){
						$uvm['vip_endtime']=time()+(86400*30*3);	//季
					}else{
						$uvm['vip_endtime']=time()+(86400*30*12);	//年
					}
				}
				M('user')->where(array('user_id'=>$wxorderrel['uid']))->save($uvm);
				//添加用户交易记录
//					$payrecord=M('payrecord');
//					$mmp['uid']=$uid;
//					$mmp['type']='1';
//					$mmp['time']=time();
//					$mmp['income']=$total_fee;
//					$mmp['source']='平台充值';
//					$payrecord->add($mmp);
			}else if($wxorderrel['body']=='缴纳保证金'){
				$bond=M('bond');
				$bondrel=$bond->where(array('uid'=>$wxorderrel['uid']))->find();
				if($bondrel){
					$mvp['status']=1;
					$bond->where(array('bond_id'=>$bondrel['bond_id']))->save($mvp);
				}else{
					$mvp['uid']=$wxorderrel['uid'];
					$mvp['status']=1;
					$bond->add($mvp);
				}
			}else{
				//修改order订单状态
				$order=M('order');
				$orderrel=$order->where(array('order_id'=>$wxorderrel['product_id']))->find();
				$mvp['status']=1;
				$mvp['paytype']=2;
				$order->where(array('order_id'=>$orderrel['order_id']))->save($mvp);
				//添加老师收益
				$good=M('goods')->where(array('goods_id'=>$orderrel['pid']))->find();
				$class=M('class')->where(array('class_id'=>$good['class_id']))->find();
				M('class')->where(array('class_id'=>$class['class_id']))->setInc('profit',$wxorderrel['money']);
				//添加学生交易记录
				$payrecord=M('payrecord');
				$mmp['uid']=$orderrel['uid'];
				$mmp['type']=2;
				$mmp['time']=time();
				$mmp['cid']=$orderrel['pid'];
				$mmp['pay']=$wxorderrel['money'];
				$mmp['source']=$good['name'];
				$mmp['ptype']=2;
				$mmp['ctype']=$good['type'];
				$payrecord->add($mmp);
				//添加老师交易记录
				$payrecord=M('payrecord');
				$mmp['uid']=$class['uid'];
				$mmp['type']=1;
				$mmp['time']=time();
				$mmp['cid']=$orderrel['pid'];
				$mmp['income']=$wxorderrel['money'];
				$mmp['source']=$good['name'];
				$mmp['ptype']=2;
				$mmp['ctype']=$good['type'];
				$payrecord->add($mmp);
				//修改商品状态
				if($good['type']==1||$good['type']==5){
					$gvm['reg_status']=1;
					$gvm['status']=1;
					$gvm['buy_uid']=$orderrel['uid'];
					$gvm['number']=$good['number']+1;
					M('goods')->where(array('goods_id'=>$good['goods_id']))->save($gvm);
					//删除其他待支付订单
					$order->where(array('pid'=>$good['goods_id'],'status'=>0))->delete();
				}else{
					$gvm['reg_status']=1;
					$gvm['number']=$good['number']+1;
					M('goods')->where(array('goods_id'=>$good['goods_id']))->save($gvm);
				}
			}
	    }else{
			//支付失败，修改微信订单状态为失败
			$wxorder=M('wxpay');
	        $orderrel=$wxorder->where(array('order_num'=>$result['out_trade_no']))->find();
	        $mvp['status']="2";
	        $wxorder->where(array('wxpay_id'=>$orderrel['wxpay_id']))->save($mvp);
		}
    }


    public function app(){
	    // 导入微信支付sdk
	    Vendor('Weixinpay.Weixinpay');
	    $wxpay=new \Weixinpay();
	    $result=$wxpay->notify_app();
	    if ($result) {
	        //支付成功
			$wxorder=M('wxpay');
			$wxorderrel=$wxorder->where(array('order_num'=>$result['out_trade_no']))->find();
			//修改微信订单支付状态
			$mvp['status']="1";
			$wxorder->where(array('wxpay_id'=>$wxorderrel['wxpay_id']))->save($mvp);

			if($wxorderrel['body']=='平台充值'){
				//金额充值到用户账号
				$uid=$wxorderrel['uid'];
				$userdata=M('userdata');
				$userdata->where(array('uid'=>$uid))->setInc('money',$wxorderrel['money']);
				//添加用户交易记录
				$payrecord=M('payrecord');
				$mmp['uid']=$uid;
				$mmp['type']=1;
				$mmp['time']=time();
				$mmp['income']=$wxorderrel['money'];
				$mmp['source']='平台充值';
				$mmp['ptype']=0;
				$payrecord->add($mmp);
				//给用户加积分，1约课币等于10积分，日上限1000
				$today = strtotime(date("Y-m-d"),time());
				$today1=$today+86399;
				$paywhere['uid']=$uid;
				$paywhere['source']='平台充值';
				$paywhere['time']=array('BETWEEN',$today,$today1);
				$payrel=$payrecord->where($paywhere)->select();
				$jimoney=0;
				foreach($payrel as $k=>$v){
					$jimoney+=$v['income'];
				}
				if(($jimoney-$wxorderrel['money'])>100){

				}else{
					if($jimoney>100){
						$jimoney=100-($jimoney-$wxorderrel['money']);
						$userdata->where(array('uid'=>$uid))->setInc('integral',($jimoney*10));
					}else{
						$userdata->where(array('uid'=>$uid))->setInc('integral',($jimoney*10));
					}
				}
			}else if($wxorderrel['body']=='开通会员'){
				//修改vip订单状态
				$vip=M('vip');
				$mvp['status']=1;
				$vip->where(array('vip_id'=>$wxorderrel['product_id']))->save($mvp);
				$viprel=$vip->where(array('vip_id'=>$wxorderrel['product_id']))->find();
				//设置用户vip
				$user=M('user')->where(array('user_id'=>$wxorderrel['uid']))->find();
				$uvm['is_vip']=1;
				if($user['vip_time']){

				}else{
					$uvm['vip_time']=time();
				}
				if($user['vip_endtime']){
					if($user['vip_endtime']<time()){
						if($viprel['type']==0){
							$uvm['vip_endtime']=time()+(86400*30);	//月
						}else if($viprel['type']==1){
							$uvm['vip_endtime']=time()+(86400*30*3);	//季
						}else{
							$uvm['vip_endtime']=time()+(86400*30*12);	//年
						}
					}else{
						if($viprel['type']==0){
							$uvm['vip_endtime']=$user['vip_endtime']+(86400*30);	//月
						}else if($viprel['type']==1){
							$uvm['vip_endtime']=$user['vip_endtime']+(86400*30*3);	//季
						}else{
							$uvm['vip_endtime']=$user['vip_endtime']+(86400*30*12);	//年
						}
					}
				}else{
					if($viprel['type']==0){
						$uvm['vip_endtime']=time()+(86400*30);	//月
					}else if($viprel['type']==1){
						$uvm['vip_endtime']=time()+(86400*30*3);	//季
					}else{
						$uvm['vip_endtime']=time()+(86400*30*12);	//年
					}
				}
				M('user')->where(array('user_id'=>$wxorderrel['uid']))->save($uvm);
				//添加用户交易记录
//					$payrecord=M('payrecord');
//					$mmp['uid']=$uid;
//					$mmp['type']='1';
//					$mmp['time']=time();
//					$mmp['income']=$total_fee;
//					$mmp['source']='平台充值';
//					$payrecord->add($mmp);
			}else if($wxorderrel['body']=='缴纳保证金'){
				$bond=M('bond');
				$bondrel=$bond->where(array('uid'=>$wxorderrel['uid']))->find();
				if($bondrel){
					$mvp['status']=1;
					$bond->where(array('bond_id'=>$bondrel['bond_id']))->save($mvp);
				}else{
					$mvp['uid']=$wxorderrel['uid'];
					$mvp['status']=1;
					$bond->add($mvp);
				}
			}else{
				//修改order订单状态
				$order=M('order');
				$orderrel=$order->where(array('order_id'=>$wxorderrel['product_id']))->find();
				$mvp['status']=1;
				$mvp['paytype']=2;
				$order->where(array('order_id'=>$orderrel['order_id']))->save($mvp);
				//添加老师收益
				$good=M('goods')->where(array('goods_id'=>$orderrel['pid']))->find();
				$class=M('class')->where(array('class_id'=>$good['class_id']))->find();
				M('class')->where(array('class_id'=>$class['class_id']))->setInc('profit',$wxorderrel['money']);
				//添加学生交易记录
				$payrecord=M('payrecord');
				$mmp['uid']=$orderrel['uid'];
				$mmp['type']=2;
				$mmp['time']=time();
				$mmp['cid']=$orderrel['pid'];
				$mmp['pay']=$wxorderrel['money'];
				$mmp['source']=$good['name'];
				$mmp['ptype']=2;
				$mmp['ctype']=$good['type'];
				$payrecord->add($mmp);
				//添加老师交易记录
				$payrecord=M('payrecord');
				$mmp['uid']=$class['uid'];
				$mmp['type']=1;
				$mmp['time']=time();
				$mmp['cid']=$orderrel['pid'];
				$mmp['income']=$wxorderrel['money'];
				$mmp['source']=$good['name'];
				$mmp['ptype']=2;
				$mmp['ctype']=$good['type'];
				$payrecord->add($mmp);
				//修改商品状态
				if($good['type']==1||$good['type']==5){
					$gvm['reg_status']=1;
					$gvm['status']=1;
					$gvm['buy_uid']=$orderrel['uid'];
					$gvm['number']=$good['number']+1;
					M('goods')->where(array('goods_id'=>$good['goods_id']))->save($gvm);
					//删除其他待支付订单
					$order->where(array('pid'=>$good['goods_id'],'status'=>0))->delete();
				}else{
					$gvm['reg_status']=1;
					$gvm['number']=$good['number']+1;
					M('goods')->where(array('goods_id'=>$good['goods_id']))->save($gvm);
				}
			}
	    }else{
	        $order=M('wxpay');
	        $orderrel=$order->where(array('order_num'=>$result['out_trade_no']))->find();
	        $mvp['status']="2";
	        $order->where(array('wxpay_id'=>$orderrel['wxpay_id']))->save($mvp);
	    }
	}

   
}