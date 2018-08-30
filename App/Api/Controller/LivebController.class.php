<?php
/********************************
 *
 * 时间：2017年11月6日
 * 功能：直播接口
 * 作者：Mr Peng
 *
 ******************************/ 

namespace Api\Controller;
use Think\Controller;
header('Content-Type:text/json;charset=utf-8');
header("Access-Control-Allow-Origin: *");
class LivebController extends CommonController {

    //直播列表
    public function liveblist(){
        if(IS_POST){
            $token=I('post.token');
            $type=I('post.type');
            $page=I('post.pageNum');
            if($token==''||$type==''||$page==''){
                $this->templateApi('','204','参数错误');exit;
            }
            $user=M('user')->where(array('token'=>$token))->find();
            if($user){
                if($user['vip_endtime']<time()){
                    $dovip['is_vip']=0;
                    M('user')->where(array('user_id'=>$user['user_id']))->save($dovip);
                }
                $class=M('class')->where(array('uid'=>$user['user_id']))->find();
                $udrel=M('userdata')->where(array('uid'=>$user['user_id']))->find();
                if($class){
                    $where['class_id']=$class['class_id'];
                    $where['type']=array('IN','1,6');
                    if($type=='0'){
                        $where['endtime']=array('gt',time());
                        $where['astatus']=1;
                    }else if($type=='1'){
                        $where['endtime']=array('elt',time());
                        $where['astatus']=1;
                    }else{
                        $where['astatus']=array('IN','0,2');
                    }
                    $where['del_status']=0;
                    $count=M('goods')->where($where)->count();
                    $data=$this->havePage('goods',$where,'time desc',$page,'20','');
                    $pie['now_page']=$data['now_page'];
                    $pie['total_page']=$data['total_page'];
                    unset($data['now_page']);
                    unset($data['total_page']);
                    foreach($data as $k=>$v){
                        $date[$k]['pid']=(string)$v['goods_id'];
                        $date[$k]['pImgURL']=(string)URL.$v['img'];
                        $date[$k]['pName']=(string)$v['name'];
                        $date[$k]['sid']=(string)$class['class_id'];
                        $date[$k]['introduce']=(string)$v['introduce'];
                        $date[$k]['signUpNum']=(string)$v['number'];
                        $date[$k]['liveStartTime']=(string)date('Y年m月d日 H:i:s',$v['starttime']);
                        $date[$k]['liveTime']=(string)round(($v['endtime']-$v['starttime'])/60);
                        $date[$k]['endSaleTime']=(string)date('Y年m月d日 H:i:s',$v['sign_endtime']);
                        $date[$k]['pType']=(string)$v['type'];
                        $date[$k]['pBuyType']=(string)$v['price_status'];
                        $heard=strstr($_SERVER['HTTP_USER_AGENT'],'(',true);
                        if($heard=='TCCM_WYK/4.0.1 ' || $heard=='TCCM_WYK/4.0.1'){
                            $date[$k]['oldPrice']='0';
                            $date[$k]['currentPrice']='0';
                        }else{
                            $date[$k]['oldPrice']=(string)$v['money'];      //原价
                            if($v['price_status']==0){
                                $date[$k]['currentPrice']=(string)$v['money']; //折扣价
                            }else{
                                $date[$k]['currentPrice']=(string)$v['discount_money']; //折扣价
                            }
                        }
                        $date[$k]['teacherName']=(string)$user['name'];
                        $date[$k]['teacherImg']=(string)URL.$udrel['image'];
                        $date[$k]['astatus']=(string)$v['astatus'];
                        $ca=M('category');
                        $cate=$ca->where(array('cate_id'=>$v['cate_id']))->find();
                        $date[$k]['threecate_id']=$cate['cate_id'];
                        $date[$k]['threecate_name']=$cate['name'];
                        $cate1=$ca->where(array('cate_id'=>$cate['pid']))->find();
                        $date[$k]['twocate_id']=$cate1['cate_id'];
                        $date[$k]['twocate_name']=$cate1['name'];
                        $cate2=$ca->where(array('cate_id'=>$cate1['pid']))->find();
                        $date[$k]['onecate_id']=$cate2['cate_id'];
                        $date[$k]['onecate_name']=$cate2['name'];
                        if(($v['starttime']-300)<time() && $v['endtime']>time() && $v['reg_status']==1 && $v['number']!=0){
                            $date[$k]['canliveb']='1';
                        }else{
                            $date[$k]['canliveb']='0';
                        }


                    }
                    if(empty($date)){
                        $rel['data']=array();
                    }else{
                        $rel['data']=$date;
                    }
                    $rel['now_page']=$pie['now_page'];
                    $rel['total_page']=$pie['total_page'];
                    $rel['count']=$count;
                    $this->templateApi($rel,'200','ok');
                }else{
                    $this->templateApi('','202','你还没有课堂');
                }
            }else{
                $this->templateApi('','300','未登录');
            }
        }else{
            $this->templateApi('','203','请求类型错误');
        }
    }

// +----------------------------------------------------------------------
// | 功能       | 创建直播
// +----------------------------------------------------------------------
// | 请求类型   | POST
// +----------------------------------------------------------------------
// | 参数       | title/introduce/cate_id/money/time/endtime/token/pic
// +----------------------------------------------------------------------
    public function livebadd(){
        if(IS_POST){
            $title=Sensitivefilter(I('post.title'));             //获取直播标题
            $introduce=Sensitivefilter(I('post.introduce'));     //获取直播介绍
            $type=I('post.type');
            $cate_id=I('post.cate_id');         //获取分类id
            $money=I('post.money');             //获取直播钱数
            $time=I('post.time');               //获取直播开始时间
//            $signendtime=I('post.signendtime');         //获取报名截止结束时间
            $lentime=I('post.lentime');         //直播时长
            $img=I('post.img');
            $token=I('post.token');             //获取用户token
            if($img==''||$token==''||$title==''||$introduce==''||$cate_id==''||$money==''||$time==''||$lentime==''){
                $this->templateApi('','204','参数错误');exit;
            }
            if($money<5){
                $this->templateApi('','202','价格不能小于5元');exit;
            }
            $user=M('user');
            $class=M('class');
            $userrel=$user->where(array('token'=>$token))->find();
            if(!$userrel){
                $this->templateApi('','300','未登录');exit;
            }
            if($userrel['vip_endtime']<time()){
                $dovip['is_vip']=0;
                M('user')->where(array('user_id'=>$userrel['user_id']))->save($dovip);
            }
            $prove=M('prove');
            $proverel=$prove->where(array('uid'=>$userrel['user_id'],'status'=>'1'))->find();
            if(!$proverel){
                $data=(object)null;
                echo json_encode($this->apiTemplate($data,'202','您还没有实名认证'));exit;
            }
            $classrel=$class->where(array('uid'=>$userrel['user_id']))->find();
            if($classrel['grade']!=1){
                $this->templateApi('','302','教师当前为v1，不具备v2功能');exit;
            }
            $good=M('goods');
            $between=array(array('egt',$time),array('elt',($time+$lentime)));
            $where['starttime']=$between;
            $where['teacher_id']=$classrel['class_id'];
            $where['type']=array('IN','1,5,6');
            $where['del_status']=0;
            $livebrel=$good->where($where)->find();
            if($livebrel){
                $this->templateApi('','202','这个时间段您已经有一场直播了');
            }else{
                $mvp['name']=$title;
                $mvp['introduce']=$introduce;
                $mvp['type']=$type;
                $mvp['cate_id']=$cate_id;
                $mvp['money']=$money;
                $mvp['starttime']=$time;
                $mvp['endtime']=$time+$lentime;
                $mvp['sign_endtime']=$time+$lentime;
                $mvp['img']=$img;
                if($classrel['o_id']){
                    $mvp['class_id']=$classrel['o_id'];
                }else{
                    $mvp['class_id']=$classrel['class_id'];
                }
                $mvp['teacher_id']=$classrel['class_id'];
                $mvp['time']=time();
                $result=$good->add($mvp);
                $shareurl['shareurl']='http://www.wyueke.com/html/student_singleLessonDetail.html?pid='.$result;
                $good->where(array('goods_id'=>$result))->save($shareurl);
                $this->templateApi('','200','ok');
            }


        }else{
            $data=(object)null;
            echo json_encode($this->apiTemplate($data,'203','请求类型错误'));
        }

    }

    //编辑直播
    public function editliveb(){
        if(IS_POST){
            $cid=I('post.cid');         //直播id
            $title=Sensitivefilter(I('post.title'));             //获取直播标题
            $introduce=Sensitivefilter(I('post.introduce'));     //获取直播介绍
            $type=I('post.type');
            $cate_id=I('post.cate_id');         //获取分类id
            $money=I('post.money');             //获取直播钱数
            $time=I('post.time');               //获取直播开始时间
            $signendtime=I('post.signendtime');         //获取报名截止结束时间
            $lentime=I('post.lentime');         //直播时长
            $token=I('post.token');             //获取用户token
            if($cid==''||$token==''||$title==''||$introduce==''||$cate_id==''||$money==''||$time==''||$signendtime==''||$lentime==''){
                $this->templateApi('','204','参数错误');exit;
            }
            $user=M('user');
            $class=M('class');
            $userrel=$user->where(array('token'=>$token))->find();
            if(!$userrel){
                $this->templateApi('','300','未登录');exit;
            }
            if($userrel['vip_endtime']<time()){
                $dovip['is_vip']=0;
                M('user')->where(array('user_id'=>$userrel['user_id']))->save($dovip);
            }
            $prove=M('prove');
            $proverel=$prove->where(array('uid'=>$userrel['user_id'],'status'=>'1'))->find();
            if(!$proverel){
                $data=(object)null;
                echo json_encode($this->apiTemplate($data,'202','您还没有实名认证'));exit;
            }
            $classrel=$class->where(array('uid'=>$userrel['user_id']))->find();
            if($classrel['grade']!=1){
                $this->templateApi('','302','教师当前为v1，不具备v2功能');exit;
            }
            $good=M('goods');
            $goodrel=$good->where(array('goods_id'=>$cid))->find();
            if($classrel['class_id']!=$goodrel['class_id']){
                $this->templateApi('','202','这不是你的直播哦');
            }
            if($goodrel['reg_status']==1){
                $this->templateApi('','202','已有人购买禁止编辑');exit;
            }
            $mvp['name']=$title;
            $mvp['introduce']=$introduce;
            $mvp['type']=$type;
            $mvp['cate_id']=$cate_id;
            $mvp['money']=$money;
            $mvp['starttime']=$time;
            $mvp['endtime']=$time+$lentime;
            $mvp['sign_endtime']=$signendtime;
            $mvp['class_id']=$classrel['class_id'];
            $mvp['time']=time();
            $good->where(array('goods_id'=>$cid))->save($mvp);
            $this->templateApi('','200','ok');



        }else{
            $data=(object)null;
            echo json_encode($this->apiTemplate($data,'203','请求类型错误'));
        }
    }

    //删除直播
    public function delliveb(){
        if(IS_POST){
            $token=I('post.token');
            $cid=I('post.cid');
            if($token==''||$cid==''){
                $this->templateApi('','204','参数错误');exit;
            }
            $user=M('user')->where(array('token'=>$token))->find();
            if($user){
                if($user['vip_endtime']<time()){
                    $dovip['is_vip']=0;
                    M('user')->where(array('user_id'=>$user['user_id']))->save($dovip);
                }
                $class=M('class')->where(array('uid'=>$user['user_id']))->find();
                $good=M('goods')->where(array('goods_id'=>$cid))->find();
                if($good['class_id']!=$class['class_id']) {
                    $this->templateApi('', '202', '这不是你的课程哦');
                }else if($good['reg_status']==1 && $good['endtime']>time()){
                    $this->templateApi('','202','您的课程有人购买不能删除');
                }else{
                    $mvp['del_status']='1';
                    M('goods')->where(array('goods_id'=>$cid))->save($mvp);
                    if($good['type']==5){
                        $where['type']=5;
                        $where['astatus']=1;
                        $where['status']=0;
                        $where['del_status']=0;
                        $where['endtime']=array('gt',time());
                        $yuegood=M('goods')->where($where)->find();
                        if(!$yuegood){
                            $mmp['order_status']=0;
                            M('class')->where(array('class_id'=>$class['class_id']))->save($mmp);
                        }
                    }
                    $this->templateApi('','200','ok');
                }
            }else{
                $this->templateApi('','300','未登录');
            }
        }else{
            $this->templateApi('','203','请求类型错误');
        }
    }

    public function addsubscribe(){
        if(IS_POST){
            $token=I('post.token');
            $cid=I('post.cId');
            if($token==''||$cid==''){
                $this->templateApi('','204','参数错误');exit;
            }
            $user=M('user')->where(array('token'=>$token))->find();
            if($user){
                if($user['vip_endtime']<time()){
                    $dovip['is_vip']=0;
                    M('user')->where(array('user_id'=>$user['user_id']))->save($dovip);
                }
                $good=M('goods')->where(array('goods_id'=>$cid))->find();
                if(!$good){
                    $this->templateApi('','202','课程信息错误');exit;
                }
                $sub=M('subscribe');
                $rel=$sub->where(array('uid'=>$user['user_id'],'cid'=>$cid))->find();
                if($rel){
                    $this->templateApi('','200','ok');
                }else{
                    $mvp['uid']=$user['user_id'];
                    $mvp['cid']=$cid;
                    $mvp['time']=time();
                    $mvp['type']=$good['type'];
                    $sub->add($mvp);
                    $this->templateApi('','200','ok');
                }
            }else{
                $this->templateApi('','300','未登录');
            }
        }else{
            $this->templateApi('','203','请求类型错误');
        }
    }











	
}
