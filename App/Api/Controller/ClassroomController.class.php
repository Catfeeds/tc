<?php

namespace  Api\Controller;
use Think\Controller;
header('Content-Type:text/json;charset=utf-8');
header("Access-Control-Allow-Origin: *");
class ClassroomController extends CommonController {
    //名师堂，获取数据
    public function index(){
        if(IS_POST){
            $cid=I('post.cId');                         //分类id
            $isAppointment=I('post.isAppointment');     //是否按可预约排序
            $isPopular=I('post.isPopular');             //是否按人气排序
            $page=I('post.pageNum');                    //页数
            if($cid==''||$isAppointment==''||$isPopular==''){
                $this->templateApi('','204','参数错误');exit;
            }
            $cate=M('category');
            $caterel=$cate->where(array('cate_id'=>$cid))->find();
            if($caterel['pid']=='0'){
                $twocate=$cate->where(array('pid'=>$caterel['cate_id']))->select();
                foreach($twocate as $v){
                    $cid.=','.$v['cate_id'];
                    $threecate=$cate->where(array('pid'=>$v['cate_id']))->select();
                    foreach($threecate as $vv){
                        $cid.=','.$vv['cate_id'];
                    }
                }
            }else{
                $twocate=$cate->where(array('pid'=>$caterel['cate_id']))->select();
                foreach($twocate as $v){
                    $cid.=','.$v['cate_id'];
                }
            }
            $where['cate_id']=array('IN',$cid);
            if($isAppointment=='0'){

            }else{
                $where['order_status']='1';
            }
            if($isPopular=='0'){
                $order='';
            }else{
                $order='follow_num desc';
            }
            $count=M('class')->where($where)->count();
            $data=$this->havePage('class',$where,$order,$page,'20','');
            $pie['now_page']=$data['now_page'];
            $pie['total_page']=$data['total_page'];
            unset($data['now_page']);
            unset($data['total_page']);
            foreach($data as $k=>$v){
                $date[$k]['sId']=$v['class_id'];
                $udrel=M('userdata')->where(array('uid'=>$v['uid']))->find();
                $tuser=M('user')->where(array('user_id'=>$v['uid']))->find();
                $date[$k]['sImgURL']=URL.$v['img'];
                $date[$k]['sName']=$v['name'];
                $date[$k]['sLV']=$v['grade'];   //0不能直播   1能直播
                if($v['type']==3){
                    $date[$k]['isOrganization']='1';
                }else{
                    $date[$k]['isOrganization']='0';
                }
                $isappo=M('goods')->where(array('class_id'=>$v['class_id'],'status'=>'0','type'=>'5','del_status'=>'0','endtime'=>array('gt',time())))->find();
                if($isappo){
                    $date[$k]['isAppointment']='1';
                }else{
                    $date[$k]['isAppointment']='0';
                }
                $date[$k]['shopInfo']=(string)$v['introduce'];
                $date[$k]['followNum']=(string)$v['follow_num'];
                $goods=M('goods')
                    ->where(array('class_id'=>$v['class_id'],'del_status'=>'0','status'=>'0'))
                    ->limit(2)
                    ->order('number desc')
                    ->field('goods_id,img,price_status,type')
                    ->select();
                if($goods){
                    foreach($goods as $kk=>$vv){
                        $date[$k]['hotProduct'][$kk]['pId']=$vv['goods_id'];
                        $date[$k]['hotProduct'][$kk]['imgURL']=URL.$vv['img'];
                        $date[$k]['hotProduct'][$kk]['pType']=$vv['type'];
                    }
                    if(count($goods)==1){
                        $date[$k]['hotProduct'][]=array(
                            'pId'   =>  '',
                            'imgURL'=>  URL.'/user/public_zwkc.png',
                            'pType' =>  ''
                        );
                    }
                }else{
                    $date[$k]['hotProduct']=array(
                        array(
                            'pId'   =>  '',
                            'imgURL'=>  URL.'/user/public_zwkc.png',
                            'pType' =>  ''
                        ),
                        array(
                            'pId'   =>  '',
                            'imgURL'=>  URL.'/user/public_zwkc.png',
                            'pType' =>  ''
                        )
                    );
                }
            }
            if(empty($data)){
                $acc['data']=array();
            }else{
                $acc['data']=$date;
            }
            $acc['now_page']=$pie['now_page'];
            $acc['total_page']=$pie['total_page'];
            $acc['count']=$count;
            $this->templateApi($acc,'200','ok');
        }else{
            $this->templateApi('','203','请求类型错误');
        }
    }

    //课堂详情-视频
    public function video_details(){
        if(IS_POST){
            $sId=I('post.sId');         //课堂id
            $token=I('post.token');     //用户token
            $page=I('post.pageNum');    //页数
            if($sId=='' || $page==''){
                $this->templateApi('','204','参数错误');exit;
            }
            //判断用户是否关注了店铺
            if($token){
                $userrel=M('user')->where(array('token'=>$token))->find();
                if($userrel){
                    if($userrel['vip_endtime']<time()){
                        $dovip['is_vip']=0;
                        M('user')->where(array('user_id'=>$userrel['user_id']))->save($dovip);
                    }
                    $followrel=M('follow')->where(array('uid'=>$userrel['user_id'],'class_id'=>$sId))->find();
                    if($followrel){
                        $rel['isFollow']='1';
                    }else{
                        $rel['isFollow']='0';
                    }
                }else{
                    $rel['isFollow']='0';
                }
            }else{
                $rel['isFollow']='0';
            }

            $where['class_id']=$sId;
            $where['type']=array('IN','2,3');
            $where['status']=0;
            $where['del_status']=0;
            $count=M('goods')->where($where)->count();
            $data=$this->havePage('goods',$where,'time desc',$page,'20','');
            $pie['now_page']=$data['now_page'];
            $pie['total_page']=$data['total_page'];
            unset($data['now_page']);
            unset($data['total_page']);
            foreach($data as $k=>$v){
                $date[$k]['pid']=(string)$v['goods_id'];
                $date[$k]['pName']=(string)$v['name'];
                $date[$k]['introduce']=$v['introduce'];
                $date[$k]['classhour']=$v['classhour'];
                $date[$k]['sonClassAmount']=(string)$v['classhour'];
                $date[$k]['openSaleTime']=(string)date('Y年m月d日 H:i:s',$v['grounding_time']);
                $date[$k]['endSetClassTime']=(string)date('Y年m月d日 H:i:s',$v['endtime']);
                $date[$k]['pType']=(string)$v['type'];
                $date[$k]['pBuyType']=(string)$v['price_status'];
                $date[$k]['pImgURL']=(string)URL.$v['img'];
                $date[$k]['signUpNum']=(string)$v['number'];
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
                $date[$k]['groupBuyNum']=(string)$v['group_num'];
                $date[$k]['groupBuyEndTime']=(string)$v['group_time'];
                $date[$k]['recommend']=(string)$v['recommend'];
                $class=M('class')->where(array('class_id'=>$v['class_id']))->find();
                $udrel=M('user')->where(array('user_id'=>$class['uid']))->find();
                $date[$k]['teachername']=$udrel['name'];


            }
            if(empty($data)){
                $rel['data']=array();
            }else{
                $rel['data']=$date;
            }
            $rel['now_page']=$pie['now_page'];
            $rel['total_page']=$pie['total_page'];
            $rel['count']=$count;
            $this->templateApi($rel,'200','ok');
        }else{
            $this->templateApi('','203','请求类型错误');
        }
    }

    //课堂详情-直播
    public function liveb_details(){
        if(IS_POST){
            $sId=I('post.sId');         //课堂id
            $token=I('post.token');     //用户token
            $page=I('post.pageNum');    //页数
            if($sId=='' || $page==''){
                $this->templateApi('','204','参数错误');exit;
            }
            //判断用户是否关注了店铺
            if($token){
                $userrel=M('user')->where(array('token'=>$token))->find();
                if($userrel){
                    if($userrel['vip_endtime']<time()){
                        $dovip['is_vip']=0;
                        M('user')->where(array('user_id'=>$userrel['user_id']))->save($dovip);
                    }
                    $followrel=M('follow')->where(array('uid'=>$userrel['user_id'],'class_id'=>$sId))->find();
                    if($followrel){
                        $rel['isFollow']='1';
                    }else{
                        $rel['isFollow']='0';
                    }
                }else{
                    $rel['isFollow']='0';
                }
            }else{
                $rel['isFollow']='0';
            }

            $where['class_id']=$sId;
            $where['type']=array('IN','1,6');
            $where['status']=0;
            $where['del_status']=0;
            $count=M('goods')->where($where)->count();
            $data=$this->havePage('goods',$where,'time desc',$page,'20','');
            $pie['now_page']=$data['now_page'];
            $pie['total_page']=$data['total_page'];
            unset($data['now_page']);
            unset($data['total_page']);
            foreach($data as $k=>$v){
                $date[$k]['pid']=(string)$v['goods_id'];
                $date[$k]['pName']=(string)$v['name'];
                $date[$k]['pType']=(string)$v['type'];
                $date[$k]['pBuyType']=(string)$v['price_status'];
                $date[$k]['pImgURL']=(string)URL.$v['img'];
                $date[$k]['signUpNum']=(string)$v['number'];
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

                $date[$k]['liveStartTime']=(string)date('Y年m月d日 H:i:s',$v['starttime']);
                $date[$k]['endSaleTime']=(string)date('Y年m月d日 H:i:s',$v['sign_endtime']);
                $date[$k]['liveTime']=(string)round(($v['endtime']-$v['starttime'])/60);
                $class=M('class')->where(array('class_id'=>$v['class_id']))->find();
                $udrel=M('userdata')->where(array('uid'=>$class['uid']))->find();
                $tuser=M('user')->where(array('user_id'=>$udrel['uid']))->find();
                $date[$k]['sid']=(string)$class['class_id'];
                $date[$k]['teachername']=$tuser['name'];
                $date[$k]['teacherimg']=URL.$udrel['image'];

            }
            if(empty($data)){
                $rel['data']=array();
            }else{
                $rel['data']=$date;
            }
            $rel['now_page']=$pie['now_page'];
            $rel['total_page']=$pie['total_page'];
            $rel['count']=$count;
            $this->templateApi($rel,'200','ok');
        }else{
            $this->templateApi('','203','请求类型错误');
        }
    }

    //课堂详情-预约
    public function order_details(){
        if(IS_POST){
            $sId=I('post.sId');         //课堂id
            $token=I('post.token');     //用户token
            $queryTime=I('post.queryTime');     //查询时间
            $page=I('post.pageNum');    //页数
            if($sId=='' || $page=='' || $queryTime==''){
                $this->templateApi('','204','参数错误');exit;
            }
            //判断用户是否关注了店铺
            if($token){
                $userrel=M('user')->where(array('token'=>$token))->find();
                if($userrel){
                    if($userrel['vip_endtime']<time()){
                        $dovip['is_vip']=0;
                        M('user')->where(array('user_id'=>$userrel['user_id']))->save($dovip);
                    }
                    $followrel=M('follow')->where(array('uid'=>$userrel['user_id'],'class_id'=>$sId))->find();
                    if($followrel){
                        $rel['isFollow']='1';
                    }else{
                        $rel['isFollow']='0';
                    }
                }else{
                    $rel['isFollow']='0';
                }
            }else{
                $rel['isFollow']='0';
            }
            $mvp['status']=1;
            $savew['endtime']=array('lt',time());
            $savew['type']=5;
            M('goods')->where($savew)->save($mvp);
            $where['starttime']=array('egt',$queryTime);
            $where['endtime']=array('lt',$queryTime+86400);
            $where['status']=0;
            $where['class_id']=$sId;
            $where['type']=array('IN','5');
            $where['del_status']=0;
            $count=M('goods')->where($where)->count();
            $data=$this->havePage('goods',$where,'time desc',$page,'20','');
            $pie['now_page']=$data['now_page'];
            $pie['total_page']=$data['total_page'];
            unset($data['now_page']);
            unset($data['total_page']);
            foreach($data as $k=>$v){
                $date[$k]['pid']=(string)$v['goods_id'];
                $date[$k]['currentPrice']=(string)$v['money'];
                $date[$k]['startTime']=(string)date('Y年m月d日 H:i:s',$v['starttime']);
                $date[$k]['endTime']=(string)date('H:i:s',$v['endtime']);
                $classrel=M('class')->where(array('class_id'=>$v['class_id']))->find();
                $tuser=M('user')->where(array('user_id'=>$classrel['uid']))->find();
                $date[$k]['teacherName']=(string)$tuser['name'];
                $udrel=M('userdata')->where(array('uid'=>$classrel['uid']))->find();
                $date[$k]['teacherImg']=(string)URL.$udrel['image'];
                $date[$k]['regStatus']=(string)$v['reg_status'];
                $cate=M('category');
                $fcate=$cate->where(array('cate_id'=>$v['cate_id']))->find();
                $ffcate=$cate->where(array('cate_id'=>$fcate['pid']))->find();
                $date[$k]['className']=(string)$ffcate['name'].'|'.(string)$fcate['name'];

            }
            if(empty($data)){
                $rel['data']=array();
            }else{
                $rel['data']=$date;
            }
            $rel['now_page']=$pie['now_page'];
            $rel['total_page']=$pie['total_page'];
            $rel['count']=$count;
            $this->templateApi($rel,'200','ok');
        }else{
            $this->templateApi('','203','请求类型错误');
        }
    }

    //上传套课视频
    public function upclasses(){
        if(IS_POST){
            $token=I('post.token');
            $pid=I('post.pid');     //套课id
            $videoid=I('post.videoid');     //视频id
            $classhour=I('post.classhour'); //课时
            $title=I('post.title');
            $introduce=I('post.introduce');
            if($token==""||$pid==''||$videoid==''||$classhour==''||$title==''||$introduce==''){
                $this->templateApi('','204','参数错误');exit;
            }
            $user=M('user')->where(array('token'=>$token))->find();
            if($user){
                if($user['vip_endtime']<time()){
                    $dovip['is_vip']=0;
                    M('user')->where(array('user_id'=>$user['user_id']))->save($dovip);
                }
                $class=M('class')->where(array('uid'=>$user['user_id']))->find();
                if($class){
                    $goodrel=M('goods')->where(array('goods_id'=>$pid))->find();
                    if($goodrel['reg_status']==1){
                        $this->templateApi('','202','课程已被购买，禁止修改');exit;
                    }
                    $video=M('video')->where(array('video_id'=>$videoid))->find();
                    $good=M('goods')->where(array('topic_id'=>$pid,'topic_num'=>$classhour))->find();
                    if($good){
                        $vm['upstatus']=0;
                        M('video')->where(array('video_id'=>$good['video_id']))->save($vm);
                        $mvp['img']=$video['img'];
                        $mvp['class_id']=$class['class_id'];
                        $mvp['name']=$title;
                        $mvp['introduce']=$introduce;
                        $mvp['type']=4;
                        $mvp['time']=time();
                        $mvp['video_file_id']=$video['fileid'];
                        $mvp['video_length']=$video['length'];
                        $mvp['topic_id']=$pid;
                        $mvp['topic_num']=$classhour;
                        $mvp['video_id']=$video['video_id'];
                        M('goods')->where(array('goods_id'=>$good['goods_id']))->save($mvp);
                        $vim['upstatus']=1;
                        M('video')->where(array('video_id'=>$videoid))->save($vim);
                    }else{
                        $mvp['img']=$video['img'];
                        $mvp['class_id']=$class['class_id'];
                        $mvp['name']=$title;
                        $mvp['introduce']=$introduce;
                        $mvp['type']=4;
                        $mvp['time']=time();
                        $mvp['video_file_id']=$video['fileid'];
                        $mvp['video_length']=$video['length'];
                        $mvp['topic_id']=$pid;
                        $mvp['topic_num']=$classhour;
                        $mvp['video_id']=$video['video_id'];
                        M('goods')->add($mvp);
                        $vm['upstatus']=1;
                        M('video')->where(array('video_id'=>$videoid))->save($vm);
                    }
                    $this->templateApi('','200','ok');
                }else{
                    $this->templateApi('','202','您还没有课堂');
                }
            }else{
                $this->templateApi('','300','未登录');
            }
        }else{
            $this->templateApi('','203','请求类型错误');
        }
    }

    //店铺详情（学生端）
    public function details(){
        if(IS_POST){
            $token=I('post.token');
            $cid=I('post.cid');
            if($cid==''){
                $this->templateApi('','204','参数错误');exit;
            }
            $class=M('class')->where(array('class_id'=>$cid))->find();
            $data['cid']=(string)$class['class_id'];
            $data['name']=$class['name'];
            $data['introduce']=$class['introduce'];
            $data['follow_num']=(string)$class['follow_num'];
            $udrel=M('userdata')->where(array('uid'=>$class['uid']))->find();
            if($class['type']==3){
                $data['isOrganization']='1';
            }else{
                $data['isOrganization']='0';
            }
            if(empty($class['img'])){
                $data['teacherimg']='';
            }else{
                $data['teacherimg']=URL.$class['img'];      //店铺头像
            }

            if($token){
                $user=M('user')->where(array('token'=>$token))->find();
                $follow=M('follow')->where(array('uid'=>$user['user_id'],'class_id'=>$cid))->find();
                if($follow){
                    $data['follow_status']='1';
                }else{
                    $data['follow_status']='0';
                }
            }else{
                $data['follow_status']='';  //关注状态
            }
            $data['link']=$class['link'];
            $this->templateApi($data,'200','ok');
        }else{
            $this->templateApi('','203','请求类型错误');
        }
    }
}