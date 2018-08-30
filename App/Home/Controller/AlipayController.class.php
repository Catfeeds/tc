<?php
namespace Home\Controller;
use Think\Controller;
header('Content-Type:text/html;charset=utf-8');
 header("Access-Control-Allow-Origin: *");
class AlipayController extends Controller {

    function getRandomString($len, $chars=null){  
    	if (is_null($chars)){  
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";  
    	}  
    	mt_srand(10000000*(double)microtime());  
    	for ($i = 0, $str = '', $lc = strlen($chars)-1; $i < $len; $i++) {  
        	$str .= $chars[mt_rand(0, $lc)];  
    	}  
    	return $str;  
	}

    //在类初始化方法中，引入相关类库      
    public function _initialize() {  
        vendor('Alipay.Corefunction');  
        vendor('Alipay.Md5function');  
        vendor('Alipay.Notify');  
        vendor('Alipay.Submit');  
       
    }  
      
    //doalipay方法  
    
    public function doalipay(){

       	$alipay_config=C('alipay_config');

        /**************************请求参数**************************/  
        $payment_type = "1"; //支付类型 //必填，不能修改  
        $notify_url = C('alipay.notify_url'); 		//服务器异步通知页面路径  
        $return_url = C('alipay.return_url'); 		//页面跳转同步通知页面路径  
        $seller_email = C('alipay.seller_email');	//卖家支付宝帐户必填  
        $out_trade_no = $this->getRandomString(11);	//商户订单号 通过支付页面的表单进行传递，注意要唯一！  
        $subject = '平台充值';  					//订单名称 //必填 通过支付页面的表单进行传递  
        $total_fee 	= str_replace(array("￥"),"",$_GET['money']);   //付款金额  //必填 通过支付页面的表单进行传递  
        $body = '平台充值';  						//订单描述 通过支付页面的表单进行传递  
        $show_url = 'http://www.wyuek.com/Home/Me/chongzhi';  //商品展示地址 通过支付页面的表单进行传递  
        $anti_phishing_key = "";					//防钓鱼时间戳 //若要使用请调用类文件submit中的query_timestamp函数  
        $exter_invoke_ip = get_client_ip(); 		//客户端的IP地址   
        /************************************************************/  
      	//添加alipay订单
      	$mvp['uid']=session('H_user_id');
      	$mvp['order_num']=$out_trade_no;
      	$mvp['money']=$total_fee;
      	$mvp['status']='0';
      	$mvp['body']='平台充值';
      	$mvp['product_id']=$total_fee;
      	$mvp['time']=time();
      	M('alipay')->add($mvp);
        //构造要请求的参数数组，无需改动  
	    $parameter = array(  
	        "service" => "create_direct_pay_by_user",  
	        "partner" => trim($alipay_config['partner']),  
	        "payment_type"    => $payment_type,  
	        "notify_url"    => $notify_url,  
	        "return_url"    => $return_url,  
	        "seller_email"    => $seller_email,  
	        "out_trade_no"    => $out_trade_no,  
	        "subject"    => $subject,  
	        "total_fee"    => $total_fee,  
	        "body"            => $body,  
	        "show_url"    => $show_url,  
	        "anti_phishing_key"    => $anti_phishing_key,  
	        "exter_invoke_ip"    => $exter_invoke_ip,  
	        "_input_charset"    => trim(strtolower($alipay_config['input_charset']))  
        );  
        //建立请求  
        $alipaySubmit = new \AlipaySubmit($alipay_config);  
        $html_text = $alipaySubmit->buildRequestForm($parameter,"post", "确认");  
        echo $html_text;  
    }  
      
    /****************************** 
    服务器异步通知页面方法      
    *******************************/  
    function notifyurl(){   
        $alipay_config=C('alipay_config');  
        //计算得出通知验证结果  
        $alipayNotify = new \AlipayNotify($alipay_config);  
        $verify_result = $alipayNotify->verifyNotify();  
        if($verify_result){ 
			//验证成功  
			//获取支付宝的通知返回参数，可参考技术文档中服务器异步通知参数列表  
			$out_trade_no   = $_POST['out_trade_no'];      //商户订单号  
			$trade_no       = $_POST['trade_no'];          //支付宝交易号  
			$trade_status   = $_POST['trade_status'];      //交易状态  
			$total_fee      = $_POST['total_fee'];         //交易金额  
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
			}else if ($_POST['trade_status'] == 'TRADE_SUCCESS'){                           
				$alipay=M('alipay');
				$alipayrel=$alipay->where(array('order_num'=>$out_trade_no))->find();
				$mvp['status']='1';
				$alipay->where(array('alipay_id'=>$alipayrel['alipay_id']))->save($mvp);
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
      
    /* 
    页面跳转处理方法； 
    */  
    function returnurl(){  
        $alipay_config=C('alipay_config');  
        $alipayNotify = new \AlipayNotify($alipay_config);//计算得出通知验证结果  
        $verify_result = $alipayNotify->verifyReturn();  
        if($verify_result){  
            //验证成功  
            //获取支付宝的通知返回参数，可参考技术文档中页面跳转同步通知参数列表  
	        $out_trade_no   = $_GET['out_trade_no'];      //商户订单号  
	        $trade_no       = $_GET['trade_no'];          //支付宝交易号  
	        $trade_status   = $_GET['trade_status'];      //交易状态  
	        $total_fee      = $_GET['total_fee'];         //交易金额  
	        $notify_id      = $_GET['notify_id'];         //通知校验ID。  
	        $notify_time    = $_GET['notify_time'];       //通知的发送时间。  
	        $buyer_email    = $_GET['buyer_email'];       //买家支付宝帐号；  
	              
	        $parameter = array(  
	            "out_trade_no"     => $out_trade_no,      //商户订单编号；  
	            "trade_no"     => $trade_no,          //支付宝交易号；  
	            "total_fee"      => $total_fee,         //交易金额；  
	            "trade_status"     => $trade_status,      //交易状态  
	            "notify_id"      => $notify_id,         //通知校验ID。  
	            "notify_time"    => $notify_time,       //通知的发送时间。  
	            "buyer_email"    => $buyer_email,       //买家支付宝帐号  
	        );  
          
	 		if($_GET['trade_status'] == 'TRADE_FINISHED' || $_GET['trade_status'] == 'TRADE_SUCCESS'){  
	 			$alipay=M('alipay');
	 			$alipayrel=$alipay->where(array('order_num'=>$out_trade_no))->find();
	 			if($alipayrel['status']=='1'){
	 				//支付成功修改用户账户余额
			        $uid=session('H_user_id');
			        $userdata=M('userdata');
			        $userdata->where(array('uid'=>$uid))->setInc('money',$total_fee);
			        //添加用户交易记录
			        $payrecord=M('payrecord');
			        $mmp['uid']=$uid;
			        $mmp['type']='1';
			        $mmp['time']=time();
			        $mmp['income']=$total_fee;
			        $mmp['source']='平台充值';
			        $payrecord->add($mmp);
			        $this->redirect(C('alipay.successpage'));//跳转到配置项中配置的支付成功页面； 
	 			}else{
	 				// echo "trade_status=".$_GET['trade_status']; 
	 				echo "<script>alert(".$_GET['trade_status'].")</script>";
		        	$this->redirect(C('alipay.errorpage'));//跳转到配置项中配置的支付失败页面
	 			}
		         
	    	}else{  
		        // echo "trade_status=".$_GET['trade_status'];
		        echo "<script>alert(".$_GET['trade_status'].")</script>";  
		        $this->redirect(C('alipay.errorpage'));//跳转到配置项中配置的支付失败页面；  
		    }  	
 		}else{  
		    //验证失败  
		    //如要调试，请看alipay_notify.php页面的verifyReturn函数  
		    echo "支付失败！";  
	    }  
 	}  
   
}