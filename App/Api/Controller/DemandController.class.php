<?php
/******************************
 *
 * 时间；
 * 功能：需求
 * 作者：Mr Peng
 *
 *****************************/
namespace Api\Controller;
use Think\Controller;
header('Content-Type:text/json;charset=utf-8');
header("Access-Control-Allow-Origin: *");
class DemandController extends CommonController {

    //发布需求
    public function index(){
        if(IS_POST){
            $cateid=I('post.cateid');       //分类id
            $starttime=I('post.starttime'); //开始时间
            $endtime=I('post.endtime');     //结束时间
            $token=I('post.token');         //用户token
            $content=I('post.content');     //文字描述
            $voice=I('post.voice');         //语音描述
            $voice_time=I('post.voice_time');   //语音描述时长
            $img=I('post.img');             //图片描述
            $money=I('post.money');         //价格
            if($cateid==''||$starttime==''||$endtime==''||$token==''||$money==''){
                $this->templateApi('','204','参数错误');exit;
            }
            $user=M('user')->where(array('token'=>$token))->find();
            $cate=M('category')->where(array('cate_id'=>$cateid))->find();
            if($user){
                $userdata=M('userdata')->where(array('uid'=>$user['user_id']))->find();
                $time=time();
                $demand=M('demand');
                $mvp=array(
                    'uid'       =>  $user['user_id'],
                    'cate_id'   =>  $cateid,
                    'starttime' =>  $starttime,
                    'endtime'   =>  $endtime,
                    'price'     =>  $money,
                    'time'      =>  $time
                );
                $rel=$demand->add($mvp);
                if($rel){
                    $describe=M('describe');
                    $mmp=array(
                        'demand_id' =>  $rel,
                        'time'      =>  $time,
                        'content'   =>  $content,
                        'voice'     =>  $voice,
                        'voice_time'=>  $voice_time,
                        'img'       =>  $img
                    );
                    $describe->add($mmp);
                    $data['demandid']=(string)$rel;
                    $data['ordernum']=(string)time().$this->getRandomString(5);
                    $data['name']=$cate['name'];
                    $data['money']=(string)$money;
                    $data['ykb']=(string)$userdata['money'];
                    $this->templateApi($data,'200','ok');
                }else{
                    $this->templateApi('','202','err');
                }
            }else{
                $this->templateApi('','300','未登录');
            }
        }else{
            $this->templateApi('','203','请求类型错误');
        }
    }

    //补充需求
    public function supdemand(){
        if(IS_POST){
            $token=I('post.token');
            $demandid=I('post.demandid');    //需求id
            $content=I('post.content');     //文字描述
            $voice=I('post.voice');     //语音描述
            $voice_time=I('post.voice_time');   //语音描述时长
            $img=I('post.img');         //图片描述
            if($token==''||$demandid==''){
                $this->templateApi('','204','参数错误');exit;
            }
            $user=M('user')->where(array('token'=>$token))->find();
            $demand=M('demand')->where(array('demand_id'=>$demandid))->find();
            if($user){
                if($demand['status']!=0){
                    $this->templateApi('','202','禁止修改');exit;
                }
                if($user['user_id']==$demand['uid']){
                    $mvp=array(
                        'demand_id' =>  $demandid,
                        'time'      =>  time(),
                        'content'   =>  $content,
                        'voice'     =>  $voice,
                        'voice_time'=>  $voice_time,
                        'img'       =>  $img
                    );
                    M('describe')->add($mvp);
                    $this->templateApi('','200','ok');
                }else{
                    $this->templateApi('','200','禁止修改');
                }
            }else{
                $this->templateApi('','300','未登录');
            }
        }else{
            $this->templateApi('','203','请求类型错误');
        }
    }

    //需求列表
    public function demandlist(){
        if(IS_POST){
            $cId=I('post.cId');                 //分类id
            $isHot=I('post.isHot');             // 是否人气优先     ，0：非  1：是
            $orderPrice=I('post.orderPrice');   // 价格排序  0：低到高     1：高到低
            $pageNum=I('post.pageNum');         //页数
            $token=I('post.token');             //用户token
            if($cId==''||$isHot==''||$pageNum==''){
                $this->templateApi('','204','参数错误');exit;
            }
            //获取登录的用户
            $user=M('user')->where(array('token'=>$token))->find();
            // ******************  需求列表  *****************
            $order='';
            $cate=M('category');
            $caterel=$cate->where(array('cate_id'=>$cId))->find();
            $onecate=$cate->where(array('pid'=>$caterel['cate_id']))->select();
            foreach($onecate as $k=>$v){
                $cId.=','.$v['cate_id'];
                $twocate=$cate->where(array('pid'=>$v['cate_id']))->select();
                foreach($twocate as $kk=>$vv){
                    $cId.=','.$vv['cate_id'];
                }
            }
            if($isHot=='1'){
                $order.='number desc';
                if($orderPrice=='0'){
                    $order.=',price asc';
                }else if($orderPrice=='1'){
                    $order.=',price desc';
                }else{

                }
            }else{
                if($orderPrice=='0'){
                    $order.='price asc';
                }else if($orderPrice=='1'){
                    $order.='price desc';
                }else{

                }
            }
            $where['cate_id']=array('IN',$cId);
            $where['status']=array('IN','0,1');
            $where['pay_status']=1;
            $data=$this->havePage('demand',$where,$order,$pageNum,'20','');
            $pie['now_page']=$data['now_page'];
            $pie['total_page']=$data['total_page'];
            unset($data['now_page']);
            unset($data['total_page']);
            foreach($data as $k=>$v){
                $date[$k]['demandid']=(string)$v['demand_id'];  //需求id
                //根据需求表用户id，获取用户昵称和头像
                $s_user=M('user')->where(array('user_id'=>$v['uid']))->find();
                $date[$k]['name']=$s_user['name'];      //发布需求者的昵称
                $s_userdata=M('userdata')->where(array('uid'=>$v['uid']))->field('image')->find();
                $date[$k]['image']=URL.$s_userdata['image'];    //发布需求和的头像
                $date[$k]['classtime']=date('Y-m-d H:i',$v['starttime']).'-'.date('H:i',$v['endtime']);  //上课时间
                //获取课程分类名称
                $decate=$cate->where(array('cate_id'=>$v['cate_id']))->find();
                $decates=$cate->where(array('cate_id'=>$decate['pid']))->find();
                $date[$k]['catename']=$decates['name'].'|'.$decate['name'];     //分类名称
                $date[$k]['money']=(string)$v['price'];     //价格
                //获取该条需求的需求内容
                $describe=M('describe')->where(array('demand_id'=>$v['demand_id']))->order('time asc')->find();
                if($describe['content']){
                    $date[$k]['content']=$describe['content'];      //文字描述
                }else{
                    $date[$k]['content']='';      //文字描述
                }
                if($describe['voice']){
                    $date[$k]['voice']=URL.$describe['voice'];      //语音描述
                }else{
                    $date[$k]['voice']='';      //语音描述
                }
                if($describe['voice_time']){
                    $date[$k]['voice_time']=$describe['voice_time'];    //语音描述时长单位 s
                }else{
                    $date[$k]['voice_time']='';    //语音描述时长单位 s
                }

                $date[$k]['img']=$this->Splicingimg($describe['img']);  //图片描述
                $date[$k]['time']=date('Y.m.d H:i',$v['time']);     //需求发布时间
                $date[$k]['number']=(string)$v['number'];       //投标人数
                //判断是不是自己发布的需求
                if($v['uid']==$user['user_id']){
                    $date[$k]['isme']='1';  //是
                }else{
                    $date[$k]['isme']='0';  //否
                }
                //判断是否投标 ，加价还是普通投标
                //bid_status 是否投标   1：是   0：否
                //bid_type   投标方式   0：普通投标   1：加价
                $class=M('class')->where(array('uid'=>$user['user_id']))->find();
                if($class){
                    $bid=M('bid')->where(array('class_id'=>$class['class_id'],'demand_id'=>$v['demand_id']))->find();
                    if($bid){
                        $date[$k]['bid_status']='1';
                        if($bid['status']==0){
                            $date[$k]['bid_type']='0';
                        }else{
                            $date[$k]['bid_type']='1';
                        }
                    }else{
                        $date[$k]['bid_status']='0';
                        $date[$k]['bid_type']='';
                    }
                }else{
                    $date[$k]['bid_status']='0';
                    $date[$k]['bid_type']='';
                }


            }
            if(empty($date)){
                $acc['data']=array();
            }else{
                $acc['data']=$date;
            }
            $acc['now_page']=$pie['now_page'];
            $acc['total_page']=$pie['total_page'];

            $this->templateApi($acc,'200','ok');
        }else{
            $this->templateApi('','203','请求类型错误');
        }
    }

    //需求详情
    public function details(){
        if(IS_POST){
            $demandid=I('post.demandid');
            $token=I('post.token');
            if($demandid==''){
                $this->templateApi('','204','参数错误');exit;
            }
            $demand=M('demand')->where(array('demand_id'=>$demandid))->find();
            $describe=M('describe')->where(array('demand_id'=>$demandid))->order('time')->select();
            if($token){
                $user=M('user')->where(array('token'=>$token))->find();
                if($demand['uid']==$user['user_id']){
                    $data['isme']='1';
                }else{
                    $data['isme']='0';
                }
            }else{
                $data['isme']='0';
            }

            $cate=M('category')->where(array('cate_id'=>$demand['cate_id']))->find();
            $data['cate']=$cate['name'];
            foreach($describe as $k=>$v){
                $data['data'][$k]['time']=date('Y.m.d H:i',$v['time']);
                $data['data'][$k]['content']=$v['content'];
                $data['data'][$k]['voice']=URL.$v['voice'];
                $data['data'][$k]['voice_time']=$v['voice_time'];
                $data['data'][$k]['img']=$this->Splicingimg($v['img']);
            }
            $this->templateApi($data,'200','ok');
        }else{
            $this->templateApi('','203','请求类型错误');
        }

    }

    //投标记录
    public function bidrecord(){
        if(IS_POST){
            $token=I('post.token');     //用户token
            $page=I('post.page');       //页数
            $type=I('post.type');       //状态   0：已投   1：已中
            if($token==''||$page==''||$type==''){
                $this->templateApi('','204','参数错误');exit;
            }
            $user=M('user')->where(array('token'=>$token))->find();
            if($user){
                $class=M('class')->where(array('uid'=>$user['user_id']))->find();
                if($class){
                    $bidlist=D('Bid')->bidlist($class['class_id'],$type,$page);
                    $pie['now_page']=$bidlist['now_page'];
                    $pie['total_page']=$bidlist['total_page'];
                    $pie['count']=$bidlist['count'];
                    unset($bidlist['now_page']);
                    unset($bidlist['total_page']);
                    unset($bidlist['count']);
                    foreach($bidlist as $k=>$v){
                        $demand=M('demand')->where(array('demand_id'=>$v['demand_id']))->find();
                        $date[$k]['demandid']=$demand['demand_id']; //需求id
                        $date[$k]['classtime']=date('Y-m-d H:i',$demand['starttime']).'-'.date('H:i',$demand['endtime']); //上课时间
                        //获取课程分类名称
                        $cate=M('category');
                        $decate=$cate->where(array('cate_id'=>$demand['cate_id']))->find();
                        $decates=$cate->where(array('cate_id'=>$decate['pid']))->find();
                        $date[$k]['catename']=$decates['name'].'|'.$decate['name'];     //分类名称
                        //获取该条需求的需求内容
                        $describe=M('describe')->where(array('demand_id'=>$demand['demand_id']))->order('time asc')->find();
                        if($describe['content']){
                            $date[$k]['content']=$describe['content'];      //文字描述
                        }else{
                            $date[$k]['content']='';      //文字描述
                        }
                        if($describe['voice']){
                            $date[$k]['voice']=URL.$describe['voice'];      //语音描述
                        }else{
                            $date[$k]['voice']='';      //语音描述
                        }
                        if($describe['img']){
                            $date[$k]['img']=$this->Splicingimg($describe['img']);  //图片描述
                        }else{
                            $date[$k]['img']='';  //图片描述
                        }
                        $date[$k]['time']=date('Y.m.d H:i',$demand['time']);     //需求发布时间
                        $date[$k]['number']=(string)$demand['number'];       //投标人数
                        $date[$k]['price']=(string)$v['price'];     //投标的价格
                        $date[$k]['status']=(string)$v['bit_status'];   //投标状态  0：待确定  1：已中  2：失败
                        $suser=M('user')->where(array('user_id'=>$demand['uid']))->find();
                        $suserdata=M('userdata')->where(array('uid'=>$demand['uid']))->find();
                        $date[$k]['name']=$suser['name'];       //昵称
                        $date[$k]['userimg']=URL.$suserdata['image'];   //头像
                        $date[$k]['phone']=(string)$suser['phone']; //电话

                    }
                    if(empty($date)){
                        $arr['data']=array();
                    }else{
                        $arr['data']=$date;
                    }
                    $arr['now_page']=$pie['now_page'];
                    $arr['total_page']=$pie['total_page'];
                    $arr['count']=$pie['count'];
                    $this->templateApi($arr,'200','ok');

                }else{
                    $this->templateApi('','202','您还不是老师');
                }
            }else{
                $this->templateApi('','300','未登录');
            }
        }else{
            $this->templateApi('','203','请求类型错误');
        }
    }

    //关闭需求
    public function closedemand(){
        if(IS_POST){
            $token=I('post.token');
            $demandid=I('post.demandid');
            if($token==''||$demandid==''){
                $this->templateApi('','204','参数错误');exit;
            }
            $user=M('user')->where(array('token'=>$token))->find();
            if($user){
                $demand=M('demand')->where(array('demand_id'=>$demandid))->find();
                if($user['user_id']!=$demand['uid']){
                    $this->templateApi('','202','禁止删除');
                }
                if(empty($demand['class_id'])){
                    M('demand')->where(array('demand_id'=>$demandid))->delete();
                    $this->templateApi('','200','ok');
                }else{
                    $this->templateApi('','202','禁止删除');
                }
            }else{
                $this->templateApi('','300','未登录');
            }
        }else{
            $this->templateApi('','203','请求类型错误');
        }
    }

    //查看投标教师
    public function teacherlist(){
        if(IS_POST){
            $demandid=I('post.demandid');
            if($demandid==''){
                $this->templateApi('','204','参数错误');exit;
            }
            $bid=M('bid')
                ->where(array('demand_id'=>$demandid))
                ->field('class_id,time')
                ->order('time desc')
                ->select();
            foreach($bid as $k=>$v){
                $class=M('class')->where(array('class_id'=>$v['class_id']))->find();
                $data[$k]['teacherimg']=URL.$class['img'];
                $data[$k]['teachername']=$class['name'];
                $data[$k]['class_id']=$class['class_id'];
                $data[$k]['time']=date('m-d H:i',$v['time']);
            }
            if($data){
                $rel['data']=$data;
            }else{
                $rel['data']=array();
            }
            $this->templateApi($rel,'200','ok');
        }else{
            $this->templateApi('','203','请求类型错误');
        }
    }
}