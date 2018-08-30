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
header('Content-Type:text/html;charset=utf-8');
header("Access-Control-Allow-Origin: *");
class Alipayh5Controller extends CommonController {

// +----------------------------------------------------------------------
// | 功能       | 生成订单
// +----------------------------------------------------------------------
// | 请求类型   | post
// +----------------------------------------------------------------------
// | 参数       | token，money
// +----------------------------------------------------------------------

    public function pay() {
        if(IS_GET){
            $token=I('get.token');
            $orderid=I('get.orderid');
            $viporderid=I('get.viporderid');
            $money=I('get.money');
            $body=I('get.body');		// 1购买课程    2：开通会员  3：平台充值   4:缴纳保证金
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
                    $content['out_trade_no'] = $this->getRandomString(11);//商户网站唯一订单号
                    //调起h5支付
                    Vendor('Alipayh5.wappay.service.AlipayTradeService');
                    Vendor('Alipayh5.wappay.buildermodel.AlipayTradeWapPayContentBuilder');
                    $config = array(
                        //应用ID,您的APPID。
                        'app_id' => "2017112700193759",
                        //商户私钥，您的原始格式RSA私钥
                        'merchant_private_key' => "MIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQC2Nx4CN6ideEW4vT3Eu7sA0jE2pBtosWC/nY0FUj0awHD7niQoGFIauB6bWXGDHvkXbfFVOY53PMgug8OtqrWwRhbtxPV3iCt5357GQ+OVSoN7vP80x48m97a9iJyPrsOdw6wpt+kUut+9mOo/nXz5jB43r2XaxbaN+I24AvA8GFpL15JZP4dY/WsYAAr47APdtPHO0LkA605C8tSzURUZgUSZjzNCnLD4FMNjVJSctZmE9efNxSf6XC70VgbRbRyXHWHjM6HtTMesMG1BrmS6RBZXigyDtmVo4szH2juDi0ykAETYYrtYn7dzNA4C94pF+GDHtgTa9i6fUIctUYMDAgMBAAECggEBALHC3YyuPdm5ntMWEy9dMZcgd5Bl0rN07/yfOBcr3p69hLuD0KQo7dhRLNLDFGElkz4PLLPG3bxnWKdANmKzOmLITdASKKI+/qL7zEqBqoFXWyQZAiO8V2RdnzISFyJ5DS9Y2Bku6L0nfeTaTBRZkLVmw4fxnf0qiui/xYnxm+oS9nZFFcMae4yk8cxREHwwq3fFUyvH6Lw8gPsI9y1LPtBLRX8ET2kgUIsBhDlzxrngA1achyYkVLyEo/JR3nXt9rbw9A7YNBHLe9b0GJNBeXuDmd1wNawqqhpbVLVxemXf1cEe/FG8tixkxNROyciIXYB+6NSuK1CzNZRSNHLdk5kCgYEA23hIXgaiw6QVQ1CcQGDnGAJFKyPY3DLNr/2unGOWcmclc4rM3fXchj/U7OVEmkfFS/yFTzaYaPJg7ERRWxiy7HGLL7z6gAJmszTthucleubDHLKTmv2UMX3jNeo3BM6gPjwrmvdzOpmlWQUBQzMNXZxLE+Rzv1aUZS+ofYEfd+0CgYEA1ItmYPim6oqmZA0Qq/g+jJlCHCJcdGHrvRya+7V3eIw5PQSlRynoiow6ebnxd1YNiB0s6IRblhYQ9/veNm1hjjPiCHGaSZoVG/KdZ9b6HQe9k0CSiZxlFe1rS2DFHeRgoREUY/sT9tyOaAUX20SBKuzznlL23fLN1NuOClEnqK8CgYB9KveS8JPpom4iCxpiOSHzdm/+b55hz3OxuKvaM439R0h7wiCfQnZ39nW4efWLS/2BHc7l44w+5mVSuo/vtYFuCj/IhS4UzcnG0RvawX+FvZBvkIVQcukO5O4ttJuWWUXY2LZB1njYZgKAZ7NVoQsxZU8IVFWTPYy6vNiKY5cP7QKBgHRubMYAUIe5Lk8urQxXsAQbTJDW7ei/X4E4M1ph3TGHNy/K5LNoLMAA82ONTc5+sGj4+onhP76nFeKS8fbE0qUwnMjdWpSpOJkXvcyNgnP2so4A2IVTzDhH1/fx6elnGtwA3Des6hHYXpZy+8+c5lladlYrwppxEPpiz5utO1l3AoGAEvJOIGXTar0bVowJg77rPaJa/OQn9lnasVpZRYynm8+LiTkYmLeR3mLnlB2E6j1PnZGoQoMhsJT9Pikl2vK7tB5JbybhMUAOPnqmT2x4JW6oSzSE7rS2UEig1iZBQ8OI3uS4lWxNpQjxjWMF23NNvxJmc3QMcejEsn4RD7naQNM=",
                        //异步通知地址
                        'notify_url' => "http://p.wyuek.com/index.php/Api/Alipay/paymentresult",
                        //同步跳转
                        'return_url' => "com.mobile.tianCheng://paysuccess?body=".$body,
                        //编码格式
                        'charset' => "UTF-8",
                        //签名方式
                        'sign_type'=>"RSA2",
                        //支付宝网关
                        'gatewayUrl' => "https://openapi.alipay.com/gateway.do",
                        //支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
                        'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA5Xv9aZ3Cp9gfYWSjUvA/TBa+Ti+5KcfnllwPpsPfCQK9ZtB+9XF23oVAZ8EBtc8tN0mxGLe9T8CvhlFEzKvOpAIK4B5Hj44djvo+YhdvEQx16CTvnMroZttWNJuQ2eRiu6zKYW6AJ4J5/jiC9F7aENfx5+4aj1YwIz+asMr6TIxEphPJ3x8Yhv8c2bll0raYKXiZcXJw0VSFKd1y+TZatNZ3NmaHzZPYM3g4ZjyvVPrEMhT/lP45ey7wuAYOguxsBh1ccFYBJdxQ16RYFJSUS8reU9VtrGO+ciqJ7vFdNdYQbYbVrswHYXxHSsNkPqN6pQqesDAVb2SCe8Bmf/ZyvwIDAQAB",
                    );
                    $out_trade_no = $content['out_trade_no'];

                    //订单名称，必填
                    $subject = $content['body'];


                    //付款金额，必填
                    $total_amount = $content['total_amount'];


                    //商品描述，可空
                    $body = $content['subject'];

                    //超时时间
                    $timeout_express="1m";

                    $payRequestBuilder = new \AlipayTradeWapPayContentBuilder();
                    $payRequestBuilder->setBody($body);
                    $payRequestBuilder->setSubject($subject);
                    $payRequestBuilder->setOutTradeNo($out_trade_no);
                    $payRequestBuilder->setTotalAmount($total_amount);
                    $payRequestBuilder->setTimeExpress($timeout_express);
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
                    $payResponse = new \AlipayTradeService($config);
                    $result=$payResponse->wapPay($payRequestBuilder,$config['return_url'],$config['notify_url']);
//                    $date['order_num']=$content['out_trade_no'];
                    return $result;
                }else{
                    echo json_encode($this->apiTemplate($data,'202','token过期'));
                }
            }
        }else{
            echo json_encode($this->apiTemplate($data,'203','请求类型错误'));
        }



    }


}