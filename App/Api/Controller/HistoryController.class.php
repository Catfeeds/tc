<?php

namespace  Api\Controller;
use Think\Controller;
header('Content-Type:text/json;charset=utf-8');
header("Access-Control-Allow-Origin: *");
class HistoryController extends CommonController {

    //添加观看记录
    public function addhis(){
        if(IS_POST){
            $token=I('post.token');
            $pid=I('post.pid');
            $did=I('post.did');
            if($token==''){
                $this->templateApi('','204','参数错误');exit;
            }
            $user=M('user')->where(array('token'=>$token))->find();
            if($user){
                if($user['vip_endtime']<time()){
                    $dovip['is_vip']=0;
                    M('user')->where(array('user_id'=>$user['user_id']))->save($dovip);
                }
                $his=M('history');
                if($pid){
                    $good=M('goods')->where(array('goods_id'=>$pid))->field('type')->find();
                    $mvp['cid']=$pid;
                    if($good['type']==1||$good['type']==6){
                        $mvp['type']=0;
                    }else if($good['type']==2||$good['type']==3||$good['type']==4){
                        $mvp['type']=1;
                    }else if($good['type']==5){
                        $mvp['type']=2;
                    }else{

                    }
                }else if($did){
                    $mvp['cid']=$did;
                    $mvp['type']=3;
                }else{
                    $this->templateApi('','204','参数错误');
                }
                $mvp['uid']=$user['user_id'];
                $mvp['time']=time();
                $his->add($mvp);
                $this->templateApi('','200','ok');
            }else{
                $this->templateApi('','300','未登录');
            }
        }else{
            $this->templateApi('','203','请求类型错误');
        }
    }
    //观看记录  视频
    public function video(){
        if(IS_POST){
            $token=I('post.token');     //用户token
            $page=I('post.pageNum');
            if($token==''||$page==''){
                $this->templateApi('','204','参数错误');exit;
            }
            $user=M('user');
            $userrel=$user->where(array('token'=>$token))->find();
            if($userrel){
                if($userrel['vip_endtime']<time()){
                    $dovip['is_vip']=0;
                    M('user')->where(array('user_id'=>$userrel['user_id']))->save($dovip);
                }
                $where['uid']=$userrel['user_id'];
                $where['type']=1;
                $count=M('history')->where($where)->count();
                $data=$this->havePage('history',$where,'time desc',$page,'20','');
                $pie['now_page']=$data['now_page'];
                $pie['total_page']=$data['total_page'];
                unset($data['now_page']);
                unset($data['total_page']);
                foreach($data as $k=>$v){
                    $date[$k]['history_id']=(string)$v['history_id'];
                    $goods=M('goods');
                    $goodsrel=$goods->where(array('goods_id'=>$v['cid']))->field('price_status,type,goods_id,img,name,money')->find();
                    $date[$k]['pid']=$goodsrel['goods_id'];
                    $date[$k]['imgURL']=URL.$goodsrel['img'];
                    $date[$k]['pType']=$goodsrel['type'];
                    $date[$k]['pBuyType']=$goodsrel['price_status'];
                    $date[$k]['name']=$goodsrel['name'];
                    $date[$k]['nearTime']=date('Y年m月d日 H:i:s',$v['time']);
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
                $this->templateApi('','300','token过期');
            }
        }else{
            $this->templateApi('','203','请求类型错误');
        }
    }

    //观看记录   直播
    public function liveb(){
        if(IS_POST){
            $token=I('post.token');     //用户token
            $page=I('post.pageNum');
            if($token==''||$page==''){
                $this->templateApi('','204','参数错误');exit;
            }
            $user=M('user');
            $userrel=$user->where(array('token'=>$token))->find();
            if($userrel){
                if($userrel['vip_endtime']<time()){
                    $dovip['is_vip']=0;
                    M('user')->where(array('user_id'=>$userrel['user_id']))->save($dovip);
                }
                $where['uid']=$userrel['user_id'];
                $where['type']=0;
                $count=M('history')->where($where)->count();
                $data=$this->havePage('history',$where,'time desc',$page,'20','');
                $pie['now_page']=$data['now_page'];
                $pie['total_page']=$data['total_page'];
                unset($data['now_page']);
                unset($data['total_page']);
                foreach($data as $k=>$v){
                    $date[$k]['history_id']=(string)$v['history_id'];
                    $goods=M('goods');
                    $goodsrel=$goods->where(array('goods_id'=>$v['cid']))->field('liveb_status,price_status,type,goods_id,img,name,money,liveb_status,starttime,number,class_id')->find();
                    $date[$k]['pid']=$goodsrel['goods_id'];
                    $date[$k]['status']=$goodsrel['liveb_status'];
                    $date[$k]['imgURL']=URL.$goodsrel['img'];
                    $date[$k]['pType']=$goodsrel['type'];
                    if($goodsrel['endtime']>time()){
                        $date[$k]['canliveb']='1';
                    }else{
                        $date[$k]['canliveb']='0';
                    }
                    $date[$k]['pBuyType']=$goodsrel['price_status'];
                    $date[$k]['name']=$goodsrel['name'];
                    $date[$k]['liveb_status']=$goodsrel['liveb_status'];
                    $date[$k]['starttime']=date('Y年m月d日 H:i:s',$goodsrel['starttime']);
                    $date[$k]['signUpNum']=$goodsrel['number'];
                    $classrel=M('class')->where(array('class_id'=>$goodsrel['class_id']))->find();
                    $udrel=M('userdata')->where(array('uid'=>$classrel['uid']))->field('image')->find();
                    $date[$k]['teacherImgURL']=URL.$udrel['image'];
                    $date[$k]['teacherName']=$classrel['name'];
                    $date[$k]['teacherLV']=$classrel['grade'];

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
                $this->templateApi('','202','token过期');
            }
        }else{
            $this->templateApi('','203','请求类型错误');
        }
    }

    //观看记录  预约课
    public function yue(){
        if(IS_POST){
            $token=I('post.token');     //用户token
            $page=I('post.pageNum');
            if($token==''||$page==''){
                $this->templateApi('','204','参数错误');exit;
            }
            $user=M('user');
            $userrel=$user->where(array('token'=>$token))->find();
            if($userrel){
                if($userrel['vip_endtime']<time()){
                    $dovip['is_vip']=0;
                    M('user')->where(array('user_id'=>$userrel['user_id']))->save($dovip);
                }
                $where['uid']=$userrel['user_id'];
                $where['type']=2;
                $count=M('history')->where($where)->count();
                $data=$this->havePage('history',$where,'time desc',$page,'20','');
                $pie['now_page']=$data['now_page'];
                $pie['total_page']=$data['total_page'];
                unset($data['now_page']);
                unset($data['total_page']);
                foreach($data as $k=>$v){
                    $date[$k]['history_id']=(string)$v['history_id'];
                    $goods=M('goods');
                    $goodsrel=$goods->where(array('goods_id'=>$v['cid']))->field('price_status,type,cate_id,goods_id,img,name,money,liveb_status,starttime,number,class_id')->find();
                    $date[$k]['pid']=$goodsrel['goods_id'];
                    $date[$k]['startTime']=date('Y年m月d日 H:i:s',$goodsrel['starttime']);
                    $date[$k]['endTime']=date('Y年m月d日 H:i:s',$goodsrel['endtime']);
                    $date[$k]['pType']=$goodsrel['type'];
                    if($goodsrel['endtime']>time()){
                        $date[$k]['canliveb']='1';
                    }else{
                        $date[$k]['canliveb']='0';
                    }
                    $date[$k]['pBuyType']=$goodsrel['price_status'];
                    $classrel=M('class')->where(array('class_id'=>$goodsrel['class_id']))->find();
                    $udrel=M('userdata')->where(array('uid'=>$classrel['uid']))->field('image')->find();
                    $date[$k]['teacherImgURL']=URL.$udrel['image'];
                    $date[$k]['teacherName']=$classrel['name'];
                    if($classrel['type']==3){
                        $date[$k]['isOrganization']='1';
                    }else{
                        $date[$k]['isOrganization']='0';
                    }
                    $cate=M('category');
                    $fcate=$cate->where(array('cate_id'=>$goodsrel['cate_id']))->find();
                    $ffcate=$cate->where(array('cate_id'=>$fcate['pid']))->find();
                    $date[$k]['className']=(string)$ffcate['name'].'|'.(string)$fcate['name'];

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
                $this->templateApi('','202','token过期');
            }
        }else{
            $this->templateApi('','203','请求类型错误');
        }
    }

    //观看记录  定制课
    public function make(){
        if(IS_POST){
            $token=I('post.token');     //用户token
            $page=I('post.pageNum');
            if($token==''||$page==''){
                $this->templateApi('','204','参数错误');exit;
            }
            $user=M('user');
            $userrel=$user->where(array('token'=>$token))->find();
            if($userrel){

                $where['uid']=$userrel['user_id'];
                $where['type']=3;
                $count=M('history')->where($where)->count();
                $data=$this->havePage('history',$where,'time desc',$page,'20','');
                $pie['now_page']=$data['now_page'];
                $pie['total_page']=$data['total_page'];
                unset($data['now_page']);
                unset($data['total_page']);
                foreach($data as $k=>$v){
                    $date[$k]['history_id']=(string)$v['history_id'];
                    $demand=M('demand')->where(array('demand_id'=>$v['cid']))->find();
                    $date[$k]['did']=(string)$demand['demand_id'];
                    $catename=M('category')->where(array('cate_id'=>$demand['cate_id']))->find();
                    $date[$k]['catename']=$catename['name'];
                    $date[$k]['starttime']=date('Y.m.d H:i',$demand['starttime']);
                    $date[$k]['endtime']=date('H:i',$demand['endtime']);
                    $class=M('class')->where(array('class_id'=>$demand['class_id']))->find();
                    $date[$k]['teacherimg']=URL.$class['img'];
                    $date[$k]['teachername']=$class['name'];
                    $date[$k]['teachergrade']=(string)$class['grade'];
                    if($class['type']==3){
                        $date[$k]['isOrganization']='1';
                    }else{
                        $date[$k]['isOrganization']='0';
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
                $this->templateApi('','202','token过期');
            }
        }else{
            $this->templateApi('','203','请求类型错误');
        }
    }

    //删除、清空观看记录
    public function hisdel(){
        if(IS_POST){
            $id=I('post.history_id');
            $type=(string)I('post.type');
            $token=I('post.token');
            if($token==''){
                $this->templateApi('','204','参数错误');exit;
            }
            $user=M('user')->where(array('token'=>$token))->find();
            if($user){
                $his=M('history');
                if($id){
                    $his->where(array('history_id'=>$id))->delete();
                    $this->templateApi('','200','ok');exit;
                }else if($type!=''){
                    $his->where(array('uid'=>$user['user_id'],'type'=>$type))->delete();
                    $this->templateApi('','200','ok');
                }else{
                    $this->templateApi('','204','参数错误');
                }
            }else{
                $this->templateApi('','300','未登录');
            }

        }else{
            $this->templateApi('','203','请求类型错误');
        }
    }


}