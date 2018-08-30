<?php
namespace Api\Controller;
use Think\Controller;
header('Content-Type:text/html;charset=utf-8');
header("Access-Control-Allow-Origin: *");
class AlipaypcController extends CommonController {



    //在类初始化方法中，引入相关类库
    public function _initialize() {
        vendor('Alipay.Corefunction');
        vendor('Alipay.Md5function');
        vendor('Alipay.Notify');
        vendor('Alipay.Submit');

    }

    //doalipay方法

    public function doalipay(){
        if(IS_GET){
            $token=I('get.token');
            $orderid=I('get.orderid');
            $viporderid=I('get.viporderid');
            $money=I('get.money');
            $body=I('get.body');		// 1购买课程    2：开通会员  3：平台充值   4:缴纳保证金
            $url=I('get.url');         //回调地址
            if($token==''||$body==''){
                $this->templateApi('','204','参数错误');exit;
            }else{
                $user=M('user');
                $userrel=$user->where(array('token'=>$token))->find();
                if($userrel){
                    if($userrel['vip_endtime']<time()){
                        $dovip['is_vip']=0;
                        M('user')->where(array('user_id'=>$userrel['user_id']))->save($dovip);
                    }
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
                        $mvp['uid']=$userrel['user_id'];
                        M('bond')->add($mvp);
                    }

                    $alipay_config=C('alipay_config');

                    /**************************请求参数**************************/
                    $payment_type = "1"; //支付类型 //必填，不能修改
                    $notify_url = C('alipay.notify_url'); 		//服务器异步通知页面路径
                    $return_url = C('alipay.return_url'); 		//页面跳转同步通知页面路径
                    $seller_email = C('alipay.seller_email');	//卖家支付宝帐户必填
                    $out_trade_no = $this->getRandomString(11);	//商户订单号 通过支付页面的表单进行传递，注意要唯一！
                    $subject = $content['body'];  				//订单名称 //必填 通过支付页面的表单进行传递
                    $total_fee 	= $content['total_amount'];   //付款金额  //必填 通过支付页面的表单进行传递
                    $alibody = $content['subject'];  						//订单描述 通过支付页面的表单进行传递
                    $show_url = 'http://www.wyuek.com/Home/Me/chongzhi';  //商品展示地址 通过支付页面的表单进行传递
                    $anti_phishing_key = "";					//防钓鱼时间戳 //若要使用请调用类文件submit中的query_timestamp函数
                    $exter_invoke_ip = get_client_ip(); 		//客户端的IP地址
                    /************************************************************/
                    //添加alipay订单
                    $mvp['uid']=$userrel['user_id'];
                    $mvp['order_num']=$out_trade_no;
                    $mvp['money']=$total_fee;
                    $mvp['status']='0';
                    $mvp['body']=$subject;
                    if($body=='1'){
                        $mvp['product_id']=$orderid;
                    }else if($body=='2'){
                        $mvp['product_id']=$viporderid;
                    }else{
                        $mvp['product_id']=$content['total_amount'];
                    }
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
                        "body"            => $alibody,
                        "show_url"    => $show_url,
                        "anti_phishing_key"    => $anti_phishing_key,
                        "exter_invoke_ip"    => $exter_invoke_ip,
                        "_input_charset"    => trim(strtolower($alipay_config['input_charset']))
                    );
                    //建立请求
                    $alipaySubmit = new \AlipaySubmit($alipay_config);
                    $html_text = $alipaySubmit->buildRequestForm($parameter,"post", "确认");
                    echo $html_text;
                }else{
                    echo json_encode($this->apiTemplate($data,'202','token过期'));
                }
            }
        }else{
            echo json_encode($this->apiTemplate($data,'203','请求类型错误'));
        }
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
                    echo "<script>window.location.href='http://www.wyueke.com'</script>";
//                    redirect(C('alipay.successpage'));//跳转到配置项中配置的支付成功页面；
                }else{
                    // echo "trade_status=".$_GET['trade_status'];
                    echo "<script>alert(".$_GET['trade_status'].")</script>";
                    echo "<script>window.location.href='http://www.wyueke.com'</script>";
                }

            }else{
                // echo "trade_status=".$_GET['trade_status'];
                echo "<script>alert(".$_GET['trade_status'].")</script>";
                echo "<script>window.location.href='http://www.wyueke.com'</script>";
            }
        }else{
            //验证失败
            //如要调试，请看alipay_notify.php页面的verifyReturn函数
            echo "支付失败！";
        }
    }

}