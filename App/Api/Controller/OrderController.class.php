<?php
/******************************
 *
 * 时间；2017年11月15日
 * 功能：订单接口
 * 作者：Mr Peng
 *
 *****************************/ 
namespace Api\Controller;
use Think\Controller;
header('Content-Type:text/json;charset=utf-8');
header("Access-Control-Allow-Origin: *");
class OrderController extends CommonController {

    //约课币支付
    public function payment(){
        if(IS_POST){
            $token=I('post.token');
            $order_id=I('post.order_id');
            $paypass=I('post.paypass');
            if($token==''||$order_id==''||$paypass==''){
                $this->templateApi('','204','参数错误');exit;
            }else{
                $user=M('user')->where(array('token'=>$token))->find();
                if($user){
                    $order=M('order');
                    $orderrel=$order->where(array('order_id'=>$order_id))->find();
                    if($orderrel){

                    }else{
                        $this->templateApi('','202','订单信息错误');exit;
                    }
                    $udrel=M('userdata')->where(array('uid'=>$user['user_id']))->find();
                    if($udrel['paypass']==md5(md5($paypass))){
                        if($udrel['money']<$orderrel['money']){
                            $this->templateApi('','202','约课币不足请充值');exit;
                        }
                        $good=M('goods');
                        $goodrel=$good->where(array('goods_id'=>$orderrel['pid']))->find();
                        $class=M('class')->where(array('class_id'=>$goodrel['class_id']))->find();
                        //如果是团购，扣掉学生的钱，并修改团购记录表的支付状态
                        if($orderrel['buytype']==2){
                            $jian=M('userdata')->where(array('uid'=>$user['user_id']))->setDec('money',$orderrel['money']);
                            //修改订单支付状态
                            $mmp['status']=1;
                            $order->where(array('order_id'=>$orderrel['order_id']))->save($mmp);
                            //修改团购记录表支付状态
                            $mvp['paystatus']=1;
                            M('groupbuy')->where(array('uid'=>$user['user_id'],'pid'=>$orderrel['pid']))->save($mvp);
                            //修改课程报名人数
                            $mvpg['reg_status']=1;
                            $mvpg['number']=$goodrel['number']+1;
                            $good->where(array('goods_id'=>$goodrel['goods_id']))->save($mvpg);
                            $this->templateApi('','200','ok');exit;
                        }

                        //定制课支付流程
                        if($orderrel['classtype']==1){
                            $jian=M('userdata')->where(array('uid'=>$user['user_id']))->setDec('money',$orderrel['money']);
                            if($jian){
                                //修改订单支付状态
                                $mmp['status']=1;
                                $order->where(array('order_id'=>$orderrel['order_id']))->save($mmp);
                                //修改定制课的支付状态
                                $demand['pay_status']=1;
                                M('demand')->where(array('uid'=>$user['user_id']))->save($demand);
                                //添加用户交易记录
                                $vm['uid']=$user['user_id'];
                                $vm['type']=2;
                                $vm['time']=time();
                                $vm['cid']=$goodrel['goods_id'];
                                $vm['pay']=$orderrel['money'];
                                $vm['source']='定制课定金支付';
                                $vm['ptype']=2;
                                M('payrecord')->add($vm);
                                $this->templateApi('','200','ok');exit;
                            }else{
                                $this->templateApi('','202','支付失败');exit;
                            }
                        }
                        //开启事务
                        M('userdata')->startTrans();
                        M('class')->startTrans();
                        if($goodrel['type']==1||$goodrel['type']==5){
                            if($goodrel['reg_status']==1){
                                $this->templateApi('','202','您看中的课程已经被购买');exit;
                            }
                            $jia=M('class')->where(array('class_id'=>$class['class_id']))->setInc('profit',$orderrel['money']);
                            $jian=M('userdata')->where(array('uid'=>$user['user_id']))->setDec('money',$orderrel['money']);
                            if($jia && $jian){
                                M('userdata')->commit();
                                M('class')->commit();
                                //如果是一对一直播或者预约课，修改报名状态和报名人id并下架
                                $mvp['reg_status']=1;
                                $mvp['status']=1;
                                $mvp['buy_uid']=$user['user_id'];
                                $mvp['number']=$goodrel['number']+1;
                                $good->where(array('goods_id'=>$goodrel['goods_id']))->save($mvp);
                                //查询该老师是否还有预约课
                                $isAppointment['order_status']=0;
                                $tyue=$good->where(array('class_id'=>$goodrel['class_id'],'type'=>'5','status'=>0))->find();
                                if($tyue){

                                }else{
                                    M('class')->where(array('class_id'=>$goodrel['class_id']))->save($isAppointment);
                                }
                                //添加学生交易记录
                                $vm['uid']=$user['user_id'];
                                $vm['type']=2;
                                $vm['time']=time();
                                $vm['cid']=$goodrel['goods_id'];
                                $vm['pay']=$orderrel['money'];
                                if($goodrel['type']==5){
                                    $vm['source']=date('Y-m-d H:i:s',$goodrel['starttime']).'-'.date('H:i:s',$goodrel['endtime']).'预约课';
                                }else{
                                    $vm['source']=$goodrel['name'];
                                }

                                $vm['ptype']=2;
                                $vm['ctype']=$goodrel['type'];
                                M('payrecord')->add($vm);
                                //添加老师交易记录
                                $tvm['uid']=$class['uid'];
                                $tvm['type']=1;
                                $tvm['time']=time();
                                $tvm['cid']=$goodrel['goods_id'];
                                $tvm['income']=$orderrel['money'];
                                if($goodrel['type']==5){
                                    $tvm['source']=date('Y-m-d H:i:s',$goodrel['starttime']).'-'.date('H:i:s',$goodrel['endtime']).'预约课';
                                }else{
                                    $tvm['source']=$goodrel['name'];
                                }
                                $tvm['ptype']=2;
                                $tvm['ctype']=$goodrel['type'];
                                M('payrecord')->add($tvm);
                                //修改订单支付状态
                                $mmp['status']=1;
                                $order->where(array('order_id'=>$orderrel['order_id']))->save($mmp);
                                //删除其他待支付订单
                                $order->where(array('pid'=>$goodrel['goods_id'],'status'=>0))->delete();
                                $this->templateApi('','200','ok');
                            }else{
                                M('userdata')->rollback();
                                M('class')->rollback();
                                $this->templateApi('','202','err');
                            }

                        }else{
                            $jia=M('class')->where(array('class_id'=>$class['class_id']))->setInc('profit',$orderrel['money']);
                            $jian=M('userdata')->where(array('uid'=>$user['user_id']))->setDec('money',$orderrel['money']);
                            if($jia && $jian){
                                M('userdata')->commit();
                                M('class')->commit();
                                //修改课程报名人数，和报名状态
                                $mvp['reg_status']=1;
                                $mvp['number']=$goodrel['number']+1;
                                $good->where(array('goods_id'=>$goodrel['goods_id']))->save($mvp);
                                //添加学生交易记录
                                $vm['uid']=$user['user_id'];
                                $vm['type']=2;
                                $vm['time']=time();
                                $vm['cid']=$goodrel['goods_id'];
                                $vm['pay']=$orderrel['money'];
                                $vm['source']=$goodrel['name'];
                                $vm['ptype']=2;
                                $vm['ctype']=$goodrel['type'];
                                M('payrecord')->add($vm);
                                //添加老师交易记录
                                $tvm['uid']=$class['uid'];
                                $tvm['type']=1;
                                $tvm['time']=time();
                                $tvm['cid']=$goodrel['goods_id'];
                                $tvm['income']=$orderrel['money'];
                                $tvm['source']=$goodrel['name'];
                                $tvm['ptype']=2;
                                $tvm['ctype']=$goodrel['type'];
                                M('payrecord')->add($tvm);
                                //修改订单支付状态
                                $mmp['status']=1;
                                $order->where(array('order_id'=>$orderrel['order_id']))->save($mmp);
                                $this->templateApi('','200','ok');
                            }else{
                                M('userdata')->rollback();
                                M('class')->rollback();
                                $this->templateApi('','202','err');
                            }

                        }


                    }else{
                        $this->templateApi('','202','支付密码不正确');
                    }
                }else{
                    $this->templateApi('','300','未登录');
                }
            }
        }else{
            $this->templateApi('','203','请求类型错误');
        }
    }

    //订单列表
    public function order(){

        if(IS_POST){
            $token=I('post.token');
            $screen=I('post.screen'); //筛选 0：待支付，1：已完成 ，2：已取消，3：团购中    4：托管中   *：不传参就是全部
            $page=I('post.page');
            if($token==''||$page==''){
                $this->templateApi('','204','参数错误');
            }else{
                $user=M('user')->where(array('token'=>$token))->find();
                if($user){
                    //删除超过6小时的订单
                    $delwhere['uid']=$user['user_id'];
                    $delwhere['time']=array('elt',time()-21600);
                    $delwhere['status']=0;
                    M('order')->where($delwhere)->delete();
                    //修改团购失败的订单为取消
                    $groupwhere['uid']=$user['user_id'];
                    $groupwhere['buytype']=2;
                    $groupwhere['status']=1;
                    $grouprel=M('order')->where($groupwhere)->select();
                    foreach($grouprel as $k=>$v){
                        $groupgood=M('goods')->where(array('goods_id'=>$v['pid']))->find();
                        if($groupgood['group_status']==2){
                            $gmp['status']=2;
                            $gmp['finish_status']=2;
                            M('order')->where(array('order_id'=>$v['order_id']))->save($gmp);
                        }
                    }
                    //修改团购成功的订单为完成
                    $groupwhere1['uid']=$user['user_id'];
                    $groupwhere1['buytype']=2;
                    $groupwhere1['status']=1;
                    $grouprel1=M('order')->where($groupwhere1)->select();
                    foreach($grouprel1 as $k=>$v){
                        $groupgood=M('goods')->where(array('goods_id'=>$v['pid']))->find();
                        if($groupgood['group_status']==1){
                            $gmp['finish_status']=1;
                            M('order')->where(array('order_id'=>$v['order_id']))->save($gmp);
                        }
                    }
                    //修改托管成功的订单为完成
                    $tgwhere=array(
                        'uid'       =>  $user['user_id'],
                        'status'    =>  1,
                        'classtype' =>  1
                    );
                    $tgrel=M('order')->where($tgwhere)->select();
                    foreach($grouprel as $k=>$v){
                        $demand=M('demand')->where(array('demand_id'=>$v['pid']))->find();
                        if($demand['status']==1){
                            $gmp['finish_status']=1;
                            M('order')->where(array('order_id'=>$v['order_id']))->save($gmp);
                        }
                    }
                    //修改托管失败的订单为取消
                    $tgwhere=array(
                        'uid'       =>  $user['user_id'],
                        'status'    =>  1,
                        'classtype' =>  1
                    );
                    $tgrel=M('order')->where($tgwhere)->select();
                    foreach($grouprel as $k=>$v){
                        $demand=M('demand')->where(array('demand_id'=>$v['pid']))->find();
                        if($demand['status']==2){
                            $gmp['status']=2;
                            $gmp['finish_status']=2;
                            M('order')->where(array('order_id'=>$v['order_id']))->save($gmp);
                        }
                    }


                    $where['uid']=$user['user_id'];
                    if($screen=='0'){
                        //待支付
                        $where['status']=0;
                    }else if($screen=='1'){
                        //已完成
                        $where['status']=1;
                        $where['finish_status']=1;
                    }else if($screen=='2'){
                        //已取消
                        $where['status']=2;
                        $where['finish_status']=2;
                    }else if($screen=='3'){
                        //团购中
                        $where['status']=1;
                        $where['buytype']=2;
                        $where['finish_status']=0;
                    }else if($screen=='4'){
                        //托管中
                        $where['status']=1;
                        $where['classtype']=1;
                        $where['finish_status']=0;
                    }

                    $count=M('order')->where($where)->count();
                    $data=$this->havePage('order',$where,'time desc',$page,'20','');
                    $pie['now_page']=$data['now_page'];
                    $pie['total_page']=$data['total_page'];
                    unset($data['now_page']);
                    unset($data['total_page']);
                    foreach($data as $k=>$v){
                        if($v['classtype']==0){
                            $good=M('goods')->where(array('goods_id'=>$v['pid']))->find();
                            if($screen=='3'){
                                if($good['group_status']==1 || $good['group_status']==2){
                                    unset($k);
                                    continue;
                                }
                            }

                            if($screen=='1'){
                                if($v['buytype']==2){
                                    if($good['group_status']!=1){
                                        unset($k);
                                        continue;
                                    }
                                }
                            }
                            if($screen=='2'){
                                if($v['buytype']==2){
                                    if($good['group_status']!=2){
                                        unset($k);
                                        continue;
                                    }
                                }
                            }
                            $date[$k]['oid']=(string)$v['order_id'];    //订单id
                            $date[$k]['orderNum']=(string)$v['num'];    //订单号
                            $date[$k]['time']=(string)date('Y-m-d',$v['time']); //下单时间
                            $date[$k]['status']=$v['status'];       //订单状态   0:待支付  1：OK  2：err

                            $class=M('class')->where(array('class_id'=>$good['class_id']))->find();
                            if($class['type']==3){
                                $date[$k]['isOrganization']='1';
                            }else{
                                $date[$k]['isOrganization']='l';
                            }
                            $tuser=M('user')->where(array('user_id'=>$class['uid']))->find();
                            $udrel=M('userdata')->where(array('uid'=>$class['uid']))->find();
                            $date[$k]['teacherName']=$tuser['name'];
                            $date[$k]['teacherImgURL']=URL.$udrel['image'];
                            $date[$k]['startTime']=date('Y-m-d H:i:s',$good['starttime']);
                            //分类start
                            $ca=M('category');
                            $cate=$ca->where(array('cate_id'=>$good['cate_id']))->find();
                            $cate1=$ca->where(array('cate_id'=>$cate['pid']))->find();
                            $cate2=$ca->where(array('cate_id'=>$cate1['pid']))->find();
                            $date[$k]['className']=(string)$cate2['name'].'|'.$cate1['name'];
                            //分类end
                            $date[$k]['endTime']=date('H:i:s',$good['endtime']);
                            $date[$k]['img']=(string)URL.$good['img'];
                            $date[$k]['name']=$good['name'];
                            $date[$k]['money']=(string)$v['money'];
                            $date[$k]['pid']=(string)$good['goods_id'];
                            $date[$k]['pType']=(string)$good['type'];
                            if($good['group_time']){
                                $date[$k]['group_time']=date('Y-m-d H:i:s',$good['group_time']);
                            }else{
                                $date[$k]['group_time']='';
                            }
                            if($v['buytype']==1){
                                $date[$k]['group_status']='0';      //是否团购   1：是
                            }else{
                                $date[$k]['group_status']='1';
                            }
                            if($v['buytype']==2){
                                $wh['pid']=$good['goods_id'];
                                $wh['paystatus']=1;
                                $grcount=M('groupbuy')->where($wh)->count();
                                if($grcount>$good['group_num']){
                                    $date[$k]['num']='0';
                                }else{
                                    $date[$k]['num']=(string)($good['group_num']-$grcount);
                                }
                            }else{
                                $date[$k]['num']='';
                            }
                            $report=M('report')->where(array('uid'=>$user['user_id'],'order_id'=>$good['goods_id']))->find();
                            if($report){
                                $date[$k]['report_status']='1';
                            }else{
                                $date[$k]['report_status']='0';
                            }
                            $date[$k]['catename']='';
                            $date[$k]['describe']='';
                            $date[$k]['bidnumber']='';
                            $date[$k]['bidpay_status']='';
                            $date[$k]['demandid']='';

                        }else{
                            $demandrel=M('demand')->where(array('demand_id'=>$v['pid']))->find();
                            if($screen=='4'){
                                if($demandrel['status']==1 || $demandrel['status']==2){
                                    unset($k);
                                    continue;
                                }
                            }
                            $date[$k]['oid']=(string)$v['order_id'];    //订单id
                            $date[$k]['orderNum']=(string)$v['num'];    //订单号
                            $date[$k]['time']=(string)date('Y-m-d',$v['time']); //下单时间
                            $date[$k]['status']=$v['status'];       //订单状态   0:待支付  1：OK  2：err
                            $date[$k]['isOrganization']='';
                            $date[$k]['teacherName']='';
                            $date[$k]['teacherImgURL']='';
                            $date[$k]['startTime']='';
                            $date[$k]['className']='';
                            $date[$k]['endTime']='';
                            $date[$k]['img']='';
                            $date[$k]['name']='';
                            $date[$k]['money']=(string)$v['money'];
                            $date[$k]['pid']='';
                            $date[$k]['pType']='';
                            $date[$k]['group_time']='';
                            $date[$k]['group_status']='';
                            $date[$k]['num']='';
                            $date[$k]['report_status']='';
                            $cate=M('category')->where(array('cate_id'=>$demandrel['cate_id']))->find();
                            $date[$k]['catename']=$cate['name'];
                            $describe=M('describe')->where(array('demand_id'=>$demandrel['demand_id']))->find();
                            if($describe['content']){
                                $date[$k]['describe']=$describe['content'];
                            }else{
                                $date[$k]['describe']='';
                            }
                            $date[$k]['bidnumber']=(string)$demandrel['number'];
                            $date[$k]['bidpay_status']=(string)$demandrel['status'];
                            $date[$k]['demandid']=(string)$demandrel['demand_id'];

                        }

                    }

                    if(empty($date)){
                        $arr=array();
                    }else{
                        $arr=array_values($date);
                        $newarr=array();
                        for($i=0;$i<count($arr);$i++){
                            array_push($newarr,$arr[$i]);
                        }
                        $rel['data']=$newarr;
                    }

                    $rel['now_page']=$pie['now_page'];
                    $rel['total_page']=$pie['total_page'];
                    $rel['count']=$count;
                    $this->templateApi($rel,'200','ok');
                }else{
                    $this->templateApi('','300','未登录');
                }
            }
        }else{
            $this->templateApi('','203','请求类型错误');
        }
    }

    //订单详情
    public function orderdetails(){
        if(IS_POST){
            $token=I('post.token');
            $orderid=I('post.order_id');
            if($token==''||$orderid==''){
                $this->templateApi('','204','参数错误');exit;
            }
            $user=M('user')->where(array('token'=>$token))->find();
            if($user){
                $order=M('order')->where(array('order_id'=>$orderid))->find();
                if($order['classtype']==0){
                    $pid=$order['pid'];
                    $good=M('goods')->where(array('goods_id'=>$order['pid']))->find();
                    $data['oid']=(string)$order['order_id'];
                    $data['img']=(string)URL.$good['img'];
                    $data['name']=(string)$good['name'];
                    $data['introduce']=$good['introduce'];
                    $data['money']=(string)$order['money'];
                    $data['pid']=(string)$good['goods_id'];
                    $data['pType']=(string)$good['type'];
                    $data['status']=(string)$order['status'];
                    $data['ordernum']=(string)$order['num'];
                    $data['time']=(string)date('Y-m-d H:i:s',$order['time']);
                    if($order['paytype']){
                        $data['paytype']=(string)$order['paytype']; //支付方式  0：约课币  1：支付宝  2：微信
                    }else{
                        $data['paytype']='';
                    }

                    $data['grouptime']=(string)date('Y-m-d H:i',$good['group_time']); //开团时间
                    if($order['buytype']==2){
                        $groupbuy=M('groupbuy')->where(array('pid'=>$good['goods_id'],'paystatus'=>1))->count();
                        if($groupbuy<$good['group_num']){
                            $data['num']=(string)($good['group_num']-$groupbuy);
                        }else{
                            $data['num']='0';
                        }
                    }else{
                        $data['num']='';
                    }
                    $report=M('report')->where(array('uid'=>$user['user_id'],'order_id'=>$pid))->find();
                    if($report){
                        $data['report_status']='1';
                    }else{
                        $data['report_status']='0';
                    }
                    $class=M('class')->where(array('class_id'=>$good['class_id']))->find();
                    if($class['type']==3){
                        $data['isOrganization']='1';
                    }else{
                        $data['isOrganization']='0';
                    }
                    $tuser=M('user')->where(array('user_id'=>$class['uid']))->find();
                    $udrel=M('userdata')->where(array('uid'=>$class['uid']))->find();
                    $data['teacherName']=$tuser['name'];
                    $data['teacherImgURL']=URL.$udrel['image'];
                    $data['startTime']=date('Y-m-d H:i:s',$good['starttime']);
                    $data['endTime']=date('H:i:s',$good['endtime']);
                    //分类start
                    $ca=M('category');
                    $cate=$ca->where(array('cate_id'=>$good['cate_id']))->find();
                    $cate1=$ca->where(array('cate_id'=>$cate['pid']))->find();
                    $cate2=$ca->where(array('cate_id'=>$cate1['pid']))->find();
                    $data['className']=(string)$cate2['name'].'|'.$cate1['name'];
                    //分类end
                    $data['demandid']='';     //需求id
                    $data['status']='';  //投标状态
//                    $data['budget_money']='';    //预算金额
                    $data['catename']='';        //三级分类名称
                    $data['describe']=''; //需求描述
                    //接单的老师列表
                    //查看该条订单是否有选中教师，有的话查出该条
                    $data['teacherarr']=array();
                    $likelist=M('goods')->where(array('cate_id'=>$cate['cate_id'],'type'=>array('IN','1,2,3,6'),'goods_id'=>array('neq',$pid)))->limit(4)->select();
                    if($likelist){
                        foreach($likelist as $kk=>$vv){
                            $dataa[$kk]['pid']=(string)$vv['goods_id'];
                            $dataa[$kk]['name']=$vv['name'];
                            $dataa[$kk]['pType']=(string)$vv['type'];
                            $dataa[$kk]['number']=(string)$vv['number'];
                            $dataa[$kk]['img']=URL.$vv['img'];
                            $dataa[$kk]['pBuyType']=(string)$vv['price_status'];
                            $dataa[$kk]['oldPrice']=(string)$vv['money'];
                            if($vv['price_status']==0){
                                $dataa[$kk]['price']=(string)$vv['money'];
                            }else{
                                $dataa[$kk]['price']=(string)$vv['discount_money'];
                            }
                            $likeclass=M('class')->where(array('class_id'=>$vv['class_id']))->find();
                            if($likeclass['type']==3){
                                $dataa[$kk]['isOrganization']='1';
                            }else{
                                $dataa[$kk]['isOrganization']='0';
                            }
                        }
                        $data['g_like']=$dataa;
                    }else{
                        $data['g_like']=array();
                    }
                }else{
                    $data['oid']=(string)$order['order_id'];        //订单id
                    $data['img']='';
                    $data['name']='';
                    $data['introduce']='';
                    $data['money']=(string)$order['money'];     //订单金额
                    $data['pid']='';
                    $data['pType']='';
                    $data['status']=(string)$order['status'];   //订单状态
                    $data['ordernum']=(string)$order['num'];    //订单号
                    $data['paytype']='';
                    $data['time']=(string)date('Y-m-d H:i:s',$order['time']);   //下单时间
                    $data['grouptime']='';
                    $data['num']='';
                    $data['report_status']='';
                    $data['isOrganization']='';
                    $data['teacherName']='';
                    $data['teacherImgURL']='';
                    $data['startTime']='';
                    $data['endTime']='';
                    $data['className']='';
                    $demand=M('demand')->where(array('demand_id'=>$order['pid']))->find();
                    $data['demandid']=(string)$demand['demand_id'];     //需求id
                    $data['status']=(string)$demand['status'];  //投标状态
//                    $data['budget_money']=(string)$demand['price'];    //预算金额
                    $cate=M('category')->where(array('cate_id'=>$demand['cate_id']))->find();
                    $data['catename']=$cate['name'];        //三级分类名称
                    $describe=M('describe')->where(array('demand_id'=>$demand['demand_id']))->find();
                    $data['describe']=$describe['content']; //需求描述
                    //接单的老师列表
                    //查看该条订单是否有选中教师，有的话查出该条
                    $bid=M('bid')->where(array('demand_id'=>$order['pid'],'bit_status'=>1))->find();
                    if($bid){
                        $class=M('class')->where(array('class_id'=>$bid['class_id']))->find();
                        $biduser=M('user')->where(array('user_id'=>$class['uid']))->find();
                        $data['teacherarr']=array(
                            array(
                                'teacherid'         =>  $class['class_id'],
                                'teacherimg'        =>  URL.$class['teacherimg'],
                                'teachername'       =>  $class['teachername'],
                                'teacherintroduce'  =>  $class['teacherintroduce'],
                                'teachergrade'      =>  $class['grade'],
                                'money'             =>  $bid['price'],
                                'choice'            =>  '1',
                                'phone'             =>  $biduser['phone'],
                            ),

                        );
                        if($class['type']==3){
                            $data['teacherarr'][0]['isOrganization']='1';
                        }else{
                            $data['teacherarr'][0]['isOrganization']='0';
                        }
                    }else{
                    //没有选中教师，查询出所有接单教师列表
                        $bidwhere['demand_id']=$order['pid'];
                        $bidwhere['bit_status']=0;
                        $bidlist=M('bid')->where($bidwhere)->select();
                        if($bidlist){
                            foreach($bidlist as $k=>$v){
                                $class=M('class')->where(array('class_id'=>$bid['class_id']))->find();
                                $biduser=M('user')->where(array('user_id'=>$class['uid']))->find();
                                $dataa[$k]['teacherid']=$class['class_id'];
                                $dataa[$k]['teacherimg']=URL.$class['teacherimg'];
                                $dataa[$k]['teachername']=$class['teachername'];
                                $dataa[$k]['teacherintroduce']=$class['teacherintroduce'];
                                $dataa[$k]['teachergrade']=$class['grade'];
                                $dataa[$k]['money']=$v['price'];
                                $dataa[$k]['choice']='0';
                                $dataa[$k]['phone']=$biduser['phone'];
                                if($class['type']==3){
                                    $dataa[$k]['isOrganization']='1';
                                }else{
                                    $dataa[$k]['isOrganization']='0';
                                }
                            }
                            $data['teacherarr']=$dataa;
                        }else{
                            $data['teacherarr']=array();
                        }

                    }

                    $data['g_like']=array();


                }

                $this->templateApi($data,'200','ok');
            }else{
                $this->templateApi('','300','未登录');
            }
        }else{
            $this->templateApi('','203','请求类型错误');
        }
    }

    //取消订单
    public function cancelorder(){
        if(IS_POST){
            $token=I('post.token');
            $order_id=I('post.order_id');
            if($token==''||$order_id==''){
                $data=(object)null;
                echo json_encode($this->apiTemplate($data,'204','参数错误'));
            }else{
                $userrel=M('user')->where(array('token'=>$token))->find();
                if($userrel){
                    $mvp['status']='2';
                    $mvp['finish_status']=2;
                    $rel=M('order')->where(array('order_id'=>$order_id))->save($mvp);
                    if($rel!==false){
                        $data=(object)null;
                        echo json_encode($this->apiTemplate($data,'200','ok'));
                    }else{
                        $data=(object)null;
                        echo json_encode($this->apiTemplate($data,'202','失败'));
                    }
                }else{  
                    $data=(object)null;
                    echo json_encode($this->apiTemplate($data,'300','未登录'));
                }
            }
        }else{
            $data=(object)null;
            echo json_encode($this->apiTemplate($data,'203','请求类型错误'));
        }
    }

    //删除订单
    public function delorder(){
        if(IS_POST){
            $token=I('post.token');
            $order_id=I('post.order_id');
            if($token==''||$order_id==''){
                $data=(object)null;
                echo json_encode($this->apiTemplate($data,'204','参数错误'));
            }else{
                $userrel=M('user')->where(array('token'=>$token))->find();
                if($userrel){
                    $rel=M('order')->where(array('order_id'=>$order_id))->delete();
                    if($rel){
                        $data=(object)null;
                        echo json_encode($this->apiTemplate($data,'200','ok'));
                    }else{
                        $data=(object)null;
                        echo json_encode($this->apiTemplate($data,'202','失败'));
                    }
                }else{  
                    $data=(object)null;
                    echo json_encode($this->apiTemplate($data,'300','未登录'));
                }
            }
        }else{
            $data=(object)null;
            echo json_encode($this->apiTemplate($data,'203','请求类型错误'));
        }
    }

    //订单确认接口
    public function index(){
        $data=(object)null;
        if(IS_POST){
            $pid=I('post.pId');         //课程id
            $token=I('post.token');     //用户token
            $type=I('post.pBuyType');   //价格类型
            $buytype=I('post.buytype'); //什么方式购买  原价0   1：优惠
            if($pid==''||$token==''||$type==''||$buytype==''){
                $this->templateApi($data,'204','参数错误');exit;
            }
            $userrel=M('user')->where(array('token'=>$token))->find();
            if(!$userrel){
                $this->templateApi($data,'300','token过期');exit;
            }
            $goods=M('goods');
            $goodrel=$goods->where(array('goods_id'=>$pid))->find();
            if($buytype==1 && $goodrel['price_status']==2 && $goodrel['group_time']<time()){
                $this->templateApi('','202','团购时间已过');exit;
            }
            if($goodrel){
                $date['orderID']=(string)time().$this->getRandomString(5);
                if($goodrel['img']){
                    $date['imgURL']=(string)URL.$goodrel['img'];
                }else{
                    $date['imgURL']='';
                }
                $date['pType']=(string)$goodrel['type'];
                $date['pName']=(string)$goodrel['name'];
                $date['pInfo']=(string)$goodrel['introduce'];
                if($type=='0'){
                    $date['pPrice']=(string)$goodrel['money'];
                }else{
                    if($buytype=='0'){
                        $date['pPrice']=(string)$goodrel['money'];
                    }else{
                        $date['pPrice']=(string)$goodrel['discount_money'];
                    }
                }
                if($goodrel['price_status']==2){
                    if($buytype=='0'){
                        $date['payStyle']='1';  //1
                    }else{
                        $date['payStyle']='0';  //为了测试  都改成只能约课币支付   0:只能约课币   1：都可以
                    }
                }else{
                    $date['payStyle']='1';  //1
                }
                $class=M('class')->where(array('class_id'=>$goodrel['class_id']))->find();
                if($class['type']==3){
                    $date['isOrganization']='1';
                }else{
                    $date['isOrganization']='0';
                }
                $tudrel=M('userdata')->where(array('uid'=>$class['uid']))->find();
                $tuser=M('user')->where(array('user_id'=>$tudrel['uid']))->find();
                $date['teacherName']=$tuser['name'];        //老师名
                $date['teacherImgURL']=URL.$tudrel['image'];   //老师头像
                $cate=M('category');
                $fcate=$cate->where(array('cate_id'=>$goodrel['cate_id']))->find();
                $ffcate=$cate->where(array('cate_id'=>$fcate['pid']))->find();
                $date['className']=(string)$ffcate['name'].'|'.(string)$fcate['name'];  //分类名
                $date['startTime']=(string)date('Y年m月d日 H:i:s',$goodrel['starttime']);
                $date['endTime']=(string)date('H:i:s',$goodrel['endtime']);
                $udrel=M('userdata')->where(array('uid'=>$userrel['user_id']))->find();
                $date['ykenum']=$udrel['money'];
                if($udrel['money']>$date['pPrice'] || $udrel['money']==$date['pPrice']){
                    $date['ykbCanPay']='1';
                }else{
                    $date['ykbCanPay']='0';
                }
                $this->templateApi($date,'200','ok');
            }else{
                $this->templateApi($data,'202','商品id错误');
            }
        }else{
            $this->templateApi($data,'203','请求类型错误');
        }
    }

    //待支付订单跳转订单确认接口
    public function indextwo(){
        if(IS_POST){
            $orderid=I('post.orderid');
            if($orderid==''){
                $this->templateApi($data,'204','参数错误');exit;
            }
            $order=M('order')->where(array('order_id'=>$orderid))->find();
            if($order){
                $goodrel=M('goods')->where(array('goods_id'=>$order['pid']))->find();
                if($order['buytype']==2 && $goodrel['price_status']==2 && $goodrel['group_time']<time()){
                    $this->templateApi('','202','团购时间已过');exit;
                }
                if($goodrel['img']){
                    $date['imgURL']=(string)URL.$goodrel['img'];
                }else{
                    $date['imgURL']='';
                }
                $date['pType']=(string)$goodrel['type'];
                $date['pName']=(string)$goodrel['name'];
                $date['pInfo']=(string)$goodrel['introduce'];
                $date['pPrice']=(string)$order['money'];
                if($goodrel['price_status']==2){
                    if($buytype=='0'){
                        $date['payStyle']='1';  //1
                    }else{
                        $date['payStyle']='0';  //为了测试  都改成只能约课币支付
                    }
                }else{
                    $date['payStyle']='1';  //1
                }
                $class=M('class')->where(array('class_id'=>$goodrel['class_id']))->find();
                if($class['type']==3){
                    $date['isOrganization']='1';
                }else{
                    $date['isOrganization']='0';
                }
                $tudrel=M('userdata')->where(array('uid'=>$class['uid']))->find();
                $tuser=M('user')->where(array('user_id'=>$tudrel['uid']))->find();
                $date['teacherName']=$tuser['name'];        //老师名
                $date['teacherImgURL']=URL.$tudrel['image'];   //老师头像
                $cate=M('category');
                $fcate=$cate->where(array('cate_id'=>$goodrel['cate_id']))->find();
                $ffcate=$cate->where(array('cate_id'=>$fcate['pid']))->find();
                $date['className']=(string)$ffcate['name'].'|'.(string)$fcate['name'];  //分类名
                $date['startTime']=(string)date('Y年m月d日 H:i:s',$goodrel['starttime']);
                $date['endTime']=(string)date('H:i:s',$goodrel['endtime']);
                $udrel=M('userdata')->where(array('uid'=>$order['uid']))->find();
                $date['ykenum']=$udrel['money'];
                if($udrel['money']>$date['pPrice'] || $udrel['money']==$date['pPrice']){
                    $date['ykbCanPay']='1';
                }else{
                    $date['ykbCanPay']='0';
                }
                $this->templateApi($date,'200','ok');
            }else{
                $this->templateApi($data,'202','订单错误');
            }
        }else{
            $this->templateApi($data,'203','请求类型错误');
        }
    }

    //加入课程接口
    public function joinclass(){
        if(IS_POST){
            $token=I('post.token');
            $cid=I('post.cId');
            if($token==''||$cid==''){
                $this->templateApi('','204','参数错误');exit;
            }
            $user=M('user')->where(array('token'=>$token))->find();
            if($user){
                $good=M('goods');
                $goodrel=$good->where(array('goods_id'=>$cid))->find();
                $payrecord=M('payrecord');
                $pay=$payrecord->where(array('uid'=>$user['user_id'],'cid'=>$cid))->find();
                if($pay){
                    $this->templateApi('','200','ok');
                }else{
                    $mvp=array(
                        'uid'   =>  $user['user_id'],
                        'type'  =>  2,
                        'time'  =>  time(),
                        'cid'   =>  $cid,
                        'pay'   =>  0,
                        'source'=>  $goodrel['name'],
                        'ptype' =>  2,
                        'ctype' =>  $goodrel['type'],
                    );
                    $payrecord->add($mvp);
                    $mmp['number']=$goodrel['number']+1;
                    $mmp['reg_status']=1;
                    $good->where(array('goods_id'=>$goodrel['goods_id']))->save($mmp);
                    $this->templateApi('','200','ok');
                }
            }else{
                $this->templateApi('','300','未登录');
            }
        }else{
            $this->templateApi('','203','请求类型错误');
        }
    }

    //提交订单
    public function suborder(){
        if(IS_POST){
            $token=I('post.token');
            $ordernum=I('post.ordernum');
            $money=I('post.money');
            $pid=I('post.pId');
            $type=I('post.pBuyType');       //价格类型
            $buytype=I('post.buytype');     //什么方式购买    0原价， 1优惠
            $bid=I('post.type');        //类型  0：买课   1：定制课
            if($token==''||$ordernum==''||$money==''||$pid==''||$buytype==''||$type==''||$bid==''){
                $this->templateApi('','204','参数错误');exit;
            }
            $user=M('user')->where(array('token'=>$token))->find();
            if($user){
                if($bid==0){
                    $good=M('goods')->where(array('goods_id'=>$pid))->find();
                    if($good){
                        $payrecord=M('payrecord')->where(array('uid'=>$user['user_id'],'cid'=>$pid))->find();
                        if($payrecord){
                            $this->templateApi('','202','您已经购买过了');exit;
                        }
                        if($good['type']!=2){
                            if($money=='0'){
                                $this->templateApi('','202','价格错误');exit;
                            }
                        }
                        $order=M('order');
                        $orderrel=$order->where(array('uid'=>$user['user_id'],'pid'=>$pid,'status'=>'0'))->find();
                        if($orderrel){
                            $order->where(array('order_id'=>$orderrel['order_id']))->delete();
                        }
                        if($type=='0'){
                            $mvp['money']=$good['money'];
                        }else{
                            if($buytype=='0'){
                                $mvp['money']=$good['money'];
                            }else{
                                $mvp['money']=$good['discount_money'];
                            }
                        }
                        if($buytype=='1'){
                            $groupbuy=M('groupbuy');
                            $grel=$groupbuy->where(array('uid'=>$user['user_id'],'pid'=>$pid,'status'=>'0','paystatus'=>1))->find();
                            if($grel){
                                $this->templateApi('','202','您已经购买成功');exit;
                            }else{
                                $vm['uid']=$user['user_id'];
                                $vm['pid']=$pid;
                                $vm['money']=$money;
                                $vm['time']=time();
                                $groupbuy->add($vm);
                            }
                        }
                        $mvp['uid']=$user['user_id'];
                        $mvp['pid']=$pid;
                        $mvp['num']=$ordernum;
                        $mvp['time']=time();
                        $mvp['type']=$good['type'];
                        if($good['price_status']==2){
                            if($buytype=='1'){
                                $mvp['buytype']=2;
                            }else{
                                $mvp['buytype']=1;
                            }
                        }else{
                            $mvp['buytype']=1;
                        }
                        $data['orderid']=$order->add($mvp);

                        $this->templateApi($data,'200','ok');
                    }else{
                        $this->templateApi('','202','课程信息错误');
                    }
                }else{
                    $demand=M('demand')->where(array('demand_id'=>$pid))->find();
                    if($demand){
                        $order=M('order');
                        $orderrel=$order->where(array('uid'=>$user['user_id'],'pid'=>$pid,'status'=>'0'))->find();
                        if($orderrel){
                            $order->where(array('order_id'=>$orderrel['order_id']))->delete();
                        }
                        $mvp=array(
                            'uid'       =>  $user['user_id'],
                            'pid'       =>  $pid,
                            'num'       =>  $ordernum,
                            'time'      =>  time(),
                            'money'     =>  $money,
                            'buytype'   =>  1,
                            'classtype' =>  1

                        );
                        $data['orderid']=$order->add($mvp);
                        $this->templateApi($data,'200','ok');
                    }else{
                        $this->templateApi('','202','课程信息错误');
                    }
                }

            }else{
                $this->templateApi('','300','未登录');
            }
        }else{
            $this->templateApi('','203','请求类型错误');
        }
    }

    //提交会员充值订单
    public function viporder(){
        if(IS_POST){
            $token=I('post.token');
            $type=I('post.type');   //类型  0：月   1：季  2：年
            $money=I('post.money');
            if($token==''||$type==''||$money==''){
                $this->templateApi('','204','参数错误');exit;
            }
            $user=M('user')->where(array('token'=>$token))->find();
            if($user){
                $mvp['uid']=$user['user_id'];
                $mvp['type']=$type;
                $mvp['money']=$money;
                $mvp['time']=time();
                $data['viporderid']=M('vip')->add($mvp);
                $this->templateApi($data,'200','ok');
            }else{
                $this->templateApi('','300','未登录');
            }
        }else{
            $this->templateApi('','203','请求类型错误');
        }
    }

    //订单列表的红点
    public function reddot(){
        if(IS_POST){
            $token=I('post.token');
            if($token==''){
                $this->templateApi('','204','参数错误');exit;
            }
            $user=M('user')->where(array('token'=>$token))->find();
            if($user){
                $order=M('order');
                //待支付
                $where_d=array(
                    'status'    =>  0,
                    'see_status'=>  0
                );
                $dzf=$order->where($where_d)->find();
                $data[0]['name']='待支付';
                if($dzf){
                    $data[0]['status']='1';
                }else{
                    $data[0]['status']='0';
                }
                //托管中
                $where_t=array(
                    'status'    =>  1,
                    'see_status'=>  0,
                    'classtype' =>  1,
                    'finish_status' =>  0
                );
                $tgz=$order->where($where_t)->find();
                $data[1]['name']='托管中';
                if($tgz){
                    $data[1]['status']='1';
                }else{
                    $data[1]['status']='0';
                }
                //团购中
                $where_g=array(
                    'status'    =>  1,
                    'see_status'=>  0,
                    'buytype'   =>  2,
                    'finish_status' =>  0
                );
                $tgzz=$order->where($where_g)->find();
                $data[2]['name']='团购中';
                if($tgzz){
                    $data[2]['status']='1';
                }else{
                    $data[2]['status']='0';
                }
                //已完成
                $where_w=array(
                    'status'    =>  1,
                    'see_status'=>  0,
                    'finish_status' =>  1
                );
                $ywc=$order->where($where_w)->find();
                $data[3]['name']='已完成';
                if($ywc){
                    $data[3]['status']='1';
                }else{
                    $data[3]['status']='0';
                }
                //已取消
                $where_q=array(
                    'status'    =>  2,
                    'see_status'=>  0,
                    'finish_status' =>  2
                );
                $yqx=$order->where($where_q)->find();
                $data[4]['name']='已取消';
                if($yqx){
                    $data[4]['status']='1';
                }else{
                    $data[4]['status']='0';
                }
                $this->templateApi($data,'200','ok');
            }else{
                $this->templateApi('','300','未登录');
            }
        }else{
            $this->templateApi('','203','请求类型错误');
        }
    }

    //查看淘汰教师列表
    public function eliminateteacher(){
        if(IS_POST){
            $oid=I('post.oid');
            if($oid==''){
                $this->templateApi('','204','参数错误');exit;
            }
            $order=M('order')->where(array('order_id'=>$oid))->find();
            $bidwhere['demand_id']=$order['pid'];
            $bidwhere['bit_status']=2;
            $bid=M('bid')->where($bidwhere)->select();
            foreach($bid as $k=>$v){
                $class=M('class')->where(array('class_id'=>$v['class_id']))->find();
                $data[$k]['teacherimg']=URL.$class['teacherimg'];
                $data[$k]['teachername']=$class['teachername'];
                $data[$k]['teacherintroduce']=$class['teacherintroduce'];
                $data[$k]['teachergrade']=(string)$class['grade'];
                if($class['type']==3){
                    $data[$k]['isOrganization']='1';
                }else{
                    $data[$k]['isOrganization']='0';
                }
            }
            if(empty($data)){
                $acc['data']=array();
            }else{
                $acc['data']=$data;
            }
            $this->templateApi($acc,'200','ok');
        }else{
            $this->templateApi('','203','请求类型错误');
        }
    }

    //拒绝老师
    public function refuseteacher(){
        if(IS_POST){
            $id=I('post.teacherid');
            $demandid=I('post.demandid');
            if($id==''||$demandid==''){
                $this->templateApi('','204','参数错误');exit;
            }
            $mvp['bit_status']=2;
            M('bid')->where(array('class_id'=>$id,'demand_id'=>$demandid))->save($mvp);
            $this->templateApi('','200','ok');
        }else{
            $this->templateApi('','203','请求类型错误');
        }
    }

    //选中老师
    public function selectteacher(){
        if(IS_POST){
            $id=I('post.teacherid');
            $demandid=I('post.demandid');
            $pass=md5(md5(I('post.pass')));
            $token=I('post.token');
            if($id==''||$demandid==''){
                $this->templateApi('','204','参数错误');exit;
            }
            $user=M('user')->where(array('token'=>$token))->find();
            $userdata=M('userdata')->where(array('uid'=>$user['user_id']))->find();
            $bid=M('bid')->where(array('class_id'=>$id,'demand_id'=>$demandid))->find();
            $demand=M('demand')->where(array('demand_id'=>$demandid))->find();
            //判断选中老师的价格是否高于订单价格
            if($bid['price']>$demand['price']){
                //高于，支付剩余定金
                if($pass==$userdata['paypass']){
                    $money=$bid['price']-$demand['price'];
                    if($userdata['money']<$money){
                        $this->templateApi('','202','约课币不足');exit;
                    }else{
                        M('userdata')->where(array('uid'=>$user['user_id']))->setDec('money',$money);
                        $mvp['bit_status']=1;
                        M('bid')->where(array('class_id'=>$id,'demand_id'=>$demandid))->save($mvp);
                        $mmp['class_id']=$id;
                        M('demand')->where(array('uid'=>$user['user_id']))->save($mmp);
                        //修改其他老师为淘汰状态
                        $save['bit_status']=2;
                        M('bid')->where(array('demand_id'=>$demandid,'class_id'=>array('neq',$id)))->save($save);
                        $this->templateApi('','200','ok');exit;
                    }
                }else{
                    $this->templateApi('','202','支付密码不正确');exit;
                }
            }else{
                $mvp['bit_status']=1;
                M('bid')->where(array('class_id'=>$id,'demand_id'=>$demandid))->save($mvp);
                //修改其他老师为淘汰状态
                $save['bit_status']=2;
                M('bid')->where(array('demand_id'=>$demandid,'class_id'=>array('neq',$id)))->save($save);
                $this->templateApi('','200','ok');
            }


        }else{
            $this->templateApi('','203','请求类型错误');
        }
    }
}