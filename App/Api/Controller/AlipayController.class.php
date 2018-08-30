<?php
/******************************
 *
 * 时间：2018年4月2日
 * 功能：ali支付接口
 * 作者：Mr Peng
 *
 *****************************/ 
namespace Api\Controller;
use Think\Controller;
header('Content-Type:text/json;charset=utf-8');
header("Access-Control-Allow-Origin: *");
class AlipayController extends CommonController {

// +----------------------------------------------------------------------
// | 功能       | 生成订单
// +----------------------------------------------------------------------
// | 请求类型   | post
// +----------------------------------------------------------------------
// | 参数       | token，money
// +----------------------------------------------------------------------    
	public function index(){ 

        $data=(object)null;
        if(IS_POST){
        	$token=I('post.token');
			$orderid=I('post.orderid');
			$viporderid=I('post.viporderid');
			$money=I('post.money');
			$body=I('post.body');		// 1购买课程    2：开通会员  3：平台充值   4:缴纳保证金
        	if($token==''||$body==''){
        		echo json_encode($this->apiTemplate($data,'204','参数错误'));exit;
        	}else{
        		$user=M('user');
        		$userrel=$user->where(array('token'=>$token))->find();
        		if($userrel){
					if($userrel['vip_endtime']<time()){
						$dovip['is_vip']=0;
						M('user')->where(array('user_id'=>$userrel['user_id']))->save($dovip);
					}
        			vendor('Alipay_app.AopSdk');// 加载类库
					$aop = new \AopClient();
					$aop->gatewayUrl = "https://openapi.alipay.com/gateway.do";
					$aop->appId = "2017112700193759";
					$aop->rsaPrivateKey = 'MIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQC2Nx4CN6ideEW4vT3Eu7sA0jE2pBtosWC/nY0FUj0awHD7niQoGFIauB6bWXGDHvkXbfFVOY53PMgug8OtqrWwRhbtxPV3iCt5357GQ+OVSoN7vP80x48m97a9iJyPrsOdw6wpt+kUut+9mOo/nXz5jB43r2XaxbaN+I24AvA8GFpL15JZP4dY/WsYAAr47APdtPHO0LkA605C8tSzURUZgUSZjzNCnLD4FMNjVJSctZmE9efNxSf6XC70VgbRbRyXHWHjM6HtTMesMG1BrmS6RBZXigyDtmVo4szH2juDi0ykAETYYrtYn7dzNA4C94pF+GDHtgTa9i6fUIctUYMDAgMBAAECggEBALHC3YyuPdm5ntMWEy9dMZcgd5Bl0rN07/yfOBcr3p69hLuD0KQo7dhRLNLDFGElkz4PLLPG3bxnWKdANmKzOmLITdASKKI+/qL7zEqBqoFXWyQZAiO8V2RdnzISFyJ5DS9Y2Bku6L0nfeTaTBRZkLVmw4fxnf0qiui/xYnxm+oS9nZFFcMae4yk8cxREHwwq3fFUyvH6Lw8gPsI9y1LPtBLRX8ET2kgUIsBhDlzxrngA1achyYkVLyEo/JR3nXt9rbw9A7YNBHLe9b0GJNBeXuDmd1wNawqqhpbVLVxemXf1cEe/FG8tixkxNROyciIXYB+6NSuK1CzNZRSNHLdk5kCgYEA23hIXgaiw6QVQ1CcQGDnGAJFKyPY3DLNr/2unGOWcmclc4rM3fXchj/U7OVEmkfFS/yFTzaYaPJg7ERRWxiy7HGLL7z6gAJmszTthucleubDHLKTmv2UMX3jNeo3BM6gPjwrmvdzOpmlWQUBQzMNXZxLE+Rzv1aUZS+ofYEfd+0CgYEA1ItmYPim6oqmZA0Qq/g+jJlCHCJcdGHrvRya+7V3eIw5PQSlRynoiow6ebnxd1YNiB0s6IRblhYQ9/veNm1hjjPiCHGaSZoVG/KdZ9b6HQe9k0CSiZxlFe1rS2DFHeRgoREUY/sT9tyOaAUX20SBKuzznlL23fLN1NuOClEnqK8CgYB9KveS8JPpom4iCxpiOSHzdm/+b55hz3OxuKvaM439R0h7wiCfQnZ39nW4efWLS/2BHc7l44w+5mVSuo/vtYFuCj/IhS4UzcnG0RvawX+FvZBvkIVQcukO5O4ttJuWWUXY2LZB1njYZgKAZ7NVoQsxZU8IVFWTPYy6vNiKY5cP7QKBgHRubMYAUIe5Lk8urQxXsAQbTJDW7ei/X4E4M1ph3TGHNy/K5LNoLMAA82ONTc5+sGj4+onhP76nFeKS8fbE0qUwnMjdWpSpOJkXvcyNgnP2so4A2IVTzDhH1/fx6elnGtwA3Des6hHYXpZy+8+c5lladlYrwppxEPpiz5utO1l3AoGAEvJOIGXTar0bVowJg77rPaJa/OQn9lnasVpZRYynm8+LiTkYmLeR3mLnlB2E6j1PnZGoQoMhsJT9Pikl2vK7tB5JbybhMUAOPnqmT2x4JW6oSzSE7rS2UEig1iZBQ8OI3uS4lWxNpQjxjWMF23NNvxJmc3QMcejEsn4RD7naQNM=';
					$aop->format = "json";
					$aop->charset = "UTF-8";
					$aop->signType = "RSA2";
					$aop->alipayrsaPublicKey = 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA5Xv9aZ3Cp9gfYWSjUvA/TBa+Ti+5KcfnllwPpsPfCQK9ZtB+9XF23oVAZ8EBtc8tN0mxGLe9T8CvhlFEzKvOpAIK4B5Hj44djvo+YhdvEQx16CTvnMroZttWNJuQ2eRiu6zKYW6AJ4J5/jiC9F7aENfx5+4aj1YwIz+asMr6TIxEphPJ3x8Yhv8c2bll0raYKXiZcXJw0VSFKd1y+TZatNZ3NmaHzZPYM3g4ZjyvVPrEMhT/lP45ey7wuAYOguxsBh1ccFYBJdxQ16RYFJSUS8reU9VtrGO+ciqJ7vFdNdYQbYbVrswHYXxHSsNkPqN6pQqesDAVb2SCe8Bmf/ZyvwIDAQAB';
					//实例化具体API对应的request类,类名称和接口名称对应,当前调用接口名称：alipay.trade.app.pay
					$request = new \AlipayTradeAppPayRequest();
					//SDK已经封装掉了公共参数，这里只需要传入业务参数
					$content = array();
					if($body=='1'){
						$order=M('order')->where(array('order_id'=>$orderid))->find();
						$good=M('goods')->where(array('goods_id'=>$order['pid']))->field('name')->find();
						if($good['type']==1 || $good['type']==5){
							if($good['reg_status']==1){
								$this->templateApi('','202','您看中的课程已经被报名，换一个吧');exit;
							}
						}
						$content['body'] = '购买课程';
						$content['subject'] = $good['name'];//商品的标题/交易标题/订单标题/订单关键字等
						$content['total_amount'] = floatval($order['money']);//订单总金额(必须定义成浮点型)
					}else if($body=='2'){
						$vip=M('vip')->where(array('vip_id'=>$viporderid))->find();
						$content['body'] = '开通会员';
						if($vip['type']==0){
							$content['subject'] = '月度会员';//商品的标题/交易标题/订单标题/订单关键字等
						}else if($vip['type']==1){
							$content['subject'] = '季度会员';//商品的标题/交易标题/订单标题/订单关键字等
						}else{
							$content['subject'] = '年度会员';//商品的标题/交易标题/订单标题/订单关键字等
						}
						$content['total_amount'] = floatval($vip['money']);//订单总金额(必须定义成浮点型)
					}else if($body=='3'){
						$content['body'] = '平台充值';
						$content['subject'] = '平台充值';//商品的标题/交易标题/订单标题/订单关键字等
						$content['total_amount'] = floatval($money);//订单总金额(必须定义成浮点型)
					}else{
						$content['body'] = '缴纳保证金';
						$content['subject'] = '缴纳保证金';
						$content['total_amount'] = floatval(2000);
						$mmp['uid']=$userrel['user_id'];
						M('bond')->add($mmp);
					}


					$content['out_trade_no'] = $this->getRandomString(11);//商户网站唯一订单号
					$content['timeout_express'] = '1d';			//该笔订单允许的最晚付款时间
					$content['product_code'] = 'QUICK_MSECURITY_PAY';
					$bizcontent = json_encode($content);
					$request->setNotifyUrl("http://p.wyuek.com/index.php/Api/Alipay/paymentresult");
					$request->setBizContent($bizcontent);
		
					//这里和普通的接口调用不同，使用的是sdkExecute
					$response = $aop->sdkExecute($request);
					//htmlspecialchars是为了输出到页面时防止被浏览器将关键参数html转义，实际打印到日志以及http传输不会有这个问题
					$date['sign']=$response;//就是orderString 可以直接给客户端请求，无需再做处理。


					//添加alipay订单
			      	$mvp['uid']=$userrel['user_id'];
			      	$mvp['order_num']=$content['out_trade_no'];
			      	$mvp['money']=$content['total_amount'];
			      	$mvp['status']='0';
			      	$mvp['body']=$content['body'];
					if($body=='1'){
						$mvp['product_id']=$orderid;
					}else if($body=='2'){
						$mvp['product_id']=$viporderid;
					}else{
						$mvp['product_id']=$content['total_amount'];
					}

			      	$mvp['time']=time();
			      	M('alipay')->add($mvp);

			      	$date['order_num']=$content['out_trade_no'];
			        echo json_encode($this->apiTemplate($date,'200','ok'));  
        		}else{
        			echo json_encode($this->apiTemplate($data,'202','token过期'));
        		}
        	}
        }else{
        	echo json_encode($this->apiTemplate($data,'203','请求类型错误'));
        }
	}

// +----------------------------------------------------------------------
// | 功能       | app支付回调
// +----------------------------------------------------------------------
// | 请求类型   | 
// +----------------------------------------------------------------------
// | 参数       | 
// +---------------------------------------------------------------------- 

	public function paymentresult(){
		vendor('Alipay_app.AopSdk');// 加载类库
		$aop = new \AopClient();
		$aop->alipayrsaPublicKey = 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA5Xv9aZ3Cp9gfYWSjUvA/TBa+Ti+5KcfnllwPpsPfCQK9ZtB+9XF23oVAZ8EBtc8tN0mxGLe9T8CvhlFEzKvOpAIK4B5Hj44djvo+YhdvEQx16CTvnMroZttWNJuQ2eRiu6zKYW6AJ4J5/jiC9F7aENfx5+4aj1YwIz+asMr6TIxEphPJ3x8Yhv8c2bll0raYKXiZcXJw0VSFKd1y+TZatNZ3NmaHzZPYM3g4ZjyvVPrEMhT/lP45ey7wuAYOguxsBh1ccFYBJdxQ16RYFJSUS8reU9VtrGO+ciqJ7vFdNdYQbYbVrswHYXxHSsNkPqN6pQqesDAVb2SCe8Bmf/ZyvwIDAQAB';
		$flag = $aop->rsaCheckV1($_POST, NULL, "RSA2");
		if($flag){ 
			//验证成功  
			//获取支付宝的通知返回参数，可参考技术文档中服务器异步通知参数列表  
			$out_trade_no   = $_POST['out_trade_no'];      //商户订单号  
			$trade_no       = $_POST['trade_no'];          //支付宝交易号  
			$trade_status   = $_POST['trade_status'];      //交易状态  
			$total_fee      = $_POST['total_amount'];      //交易金额  
			$notify_id      = $_POST['notify_id'];         //通知校验ID。  
			$notify_time    = $_POST['notify_time'];       //通知的发送时间。格式为yyyy-MM-dd HH:mm:ss。  
			$buyer_email    = $_POST['buyer_email'];       //买家支付宝帐号；  
			$parameter = array(  
				"out_trade_no"     => $out_trade_no, //商户订单编号；  
				"trade_no"     => $trade_no,     //支付宝交易号；  
				"total_fee"     => $total_fee,    //交易金额；  
				"trade_status"     => $trade_status, //交易状态  
				"notify_id"     => $notify_id,    //通知校验ID。  
				"notify_time"   => $notify_time,  //通知的发送时间。  
				"buyer_email"   => $buyer_email,  //买家支付宝帐号；  
			);  
			if($_POST['trade_status'] == 'TRADE_FINISHED'){  
			 	$alipay=M('alipay');
				$alipayrel=$alipay->where(array('order_num'=>$out_trade_no))->find();
				$mvp['status']='1';
				$alipay->where(array('alipay_id'=>$alipayrel['alipay_id']))->save($mvp);
				if($alipayrel['body']=='平台充值'){
					//金额充值到用户账号
					$uid=$alipayrel['uid'];
					$userdata=M('userdata');
					$userdata->where(array('uid'=>$uid))->setInc('money',$total_fee);
					//添加用户交易记录
					$payrecord=M('payrecord');
					$mmp['uid']=$uid;
					$mmp['type']=1;
					$mmp['time']=time();
					$mmp['income']=$total_fee;
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
					if(($jimoney-$total_fee)>100){

					}else{
						if($jimoney>100){
							$jimoney=100-($jimoney-$total_fee);
							$userdata->where(array('uid'=>$uid))->setInc('integral',($jimoney*10));
						}else{
							$userdata->where(array('uid'=>$uid))->setInc('integral',($jimoney*10));
						}
					}

				}else if($alipayrel['body']=='开通会员'){
					//修改vip订单状态
					$vip=M('vip');
					$mvp['status']=1;
					$vip->where(array('vip_id'=>$alipayrel['product_id']))->save($mvp);
					$viprel=$vip->where(array('vip_id'=>$alipayrel['product_id']))->find();
					//设置用户vip
					$user=M('user')->where(array('user_id'=>$alipayrel['uid']))->find();
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
					M('user')->where(array('user_id'=>$alipayrel['uid']))->save($uvm);
					//添加用户交易记录
//					$payrecord=M('payrecord');
//					$mmp['uid']=$uid;
//					$mmp['type']='1';
//					$mmp['time']=time();
//					$mmp['income']=$total_fee;
//					$mmp['source']='平台充值';
//					$payrecord->add($mmp);
				}else if($alipayrel['body']=='缴纳保证金'){
					$bond=M('bond');
					$bondrel=$bond->where(array('uid'=>$alipayrel['uid']))->find();
					if($bondrel){
						$mvp['status']=1;
						$bond->where(array('bond_id'=>$bondrel['bond_id']))->save($mvp);
					}else{
						$mvp['uid']=$alipayrel['uid'];
						$mvp['status']=1;
						$bond->add($mvp);
					}
				}else{
					//修改order订单状态
					$order=M('order');
					$orderrel=$order->where(array('order_id'=>$alipayrel['product_id']))->find();
					$mvp['status']=1;
					$mvp['paytype']=1;
					$order->where(array('order_id'=>$orderrel['order_id']))->save($mvp);
					//添加老师收益
					$good=M('goods')->where(array('goods_id'=>$orderrel['pid']))->find();
					$class=M('class')->where(array('class_id'=>$good['class_id']))->find();
					M('class')->where(array('class_id'=>$class['class_id']))->setInc('profit',$total_fee);
					//添加学生交易记录
					$payrecord=M('payrecord');
					$mmp['uid']=$orderrel['uid'];
					$mmp['type']=2;
					$mmp['time']=time();
					$mmp['cid']=$orderrel['pid'];
					$mmp['pay']=$total_fee;
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
					$mmp['income']=$total_fee;
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

			}else if ($_POST['trade_status'] == 'TRADE_SUCCESS'){
				$alipay=M('alipay');
				$alipayrel=$alipay->where(array('order_num'=>$out_trade_no))->find();
				$mvp['status']='1';
				$alipay->where(array('alipay_id'=>$alipayrel['alipay_id']))->save($mvp);
				if($alipayrel['body']=='平台充值'){
					//金额充值到用户账号
					$uid=$alipayrel['uid'];
					$userdata=M('userdata');
					$userdata->where(array('uid'=>$uid))->setInc('money',$total_fee);
					//添加用户交易记录
					$payrecord=M('payrecord');
					$mmp['uid']=$uid;
					$mmp['type']=1;
					$mmp['time']=time();
					$mmp['income']=$total_fee;
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
					if(($jimoney-$total_fee)>100){

					}else{
						if($jimoney>100){
							$jimoney=100-($jimoney-$total_fee);
							$userdata->where(array('uid'=>$uid))->setInc('integral',($jimoney*10));
						}else{
							$userdata->where(array('uid'=>$uid))->setInc('integral',($jimoney*10));
						}
					}
				}else if($alipayrel['body']=='开通会员'){
					//修改vip订单状态
					$vip=M('vip');
					$mvp['status']=1;
					$vip->where(array('vip_id'=>$alipayrel['product_id']))->save($mvp);
					$viprel=$vip->where(array('vip_id'=>$alipayrel['product_id']))->find();
					//设置用户vip
					$user=M('user')->where(array('user_id'=>$alipayrel['uid']))->find();
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
					M('user')->where(array('user_id'=>$alipayrel['uid']))->save($uvm);
					//添加用户交易记录
//					$payrecord=M('payrecord');
//					$mmp['uid']=$uid;
//					$mmp['type']='1';
//					$mmp['time']=time();
//					$mmp['income']=$total_fee;
//					$mmp['source']='平台充值';
//					$payrecord->add($mmp);
				}else if($alipayrel['body']=='缴纳保证金'){
					$bond=M('bond');
					$bondrel=$bond->where(array('uid'=>$alipayrel['uid']))->find();
					if($bondrel){
						$mvp['status']=1;
						$bond->where(array('bond_id'=>$bondrel['bond_id']))->save($mvp);
					}else{
						$mvp['uid']=$alipayrel['uid'];
						$mvp['status']=1;
						$bond->add($mvp);
					}
				}else{
					//修改order订单状态
					$order=M('order');
					$orderrel=$order->where(array('order_id'=>$alipayrel['product_id']))->find();
					$mvp['status']=1;
					$mvp['paytype']=1;
					$order->where(array('order_id'=>$orderrel['order_id']))->save($mvp);
					//添加老师收益
					$good=M('goods')->where(array('goods_id'=>$orderrel['pid']))->find();
					$class=M('class')->where(array('class_id'=>$good['class_id']))->find();
					M('class')->where(array('class_id'=>$class['class_id']))->setInc('profit',$total_fee);
					//添加学生交易记录
					$payrecord=M('payrecord');
					$mmp['uid']=$orderrel['uid'];
					$mmp['type']=2;
					$mmp['time']=time();
					$mmp['cid']=$orderrel['pid'];
					$mmp['pay']=$total_fee;
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
					$mmp['income']=$total_fee;
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
				$alipay=M('alipay');
				$alipayrel=$alipay->where(array('order_num'=>$out_trade_no))->find();
				$mvp['status']='2';
				$alipay->where(array('alipay_id'=>$alipayrel['alipay_id']))->save($mvp);
			}
			echo "success";        //请不要修改或删除  
		}else{  
			//验证失败  
			echo "fail";  
		}     
	}
}