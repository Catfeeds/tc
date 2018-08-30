<?php

namespace  Api\Controller;
use Think\Controller;
header('Content-Type:text/json;charset=utf-8');
header("Access-Control-Allow-Origin: *");
class VideoController extends CommonController {
    //上传视频
    public function index(){
        if(IS_POST){
            $token=I('post.token');
            $img=I('post.img');
            $fileid=I('post.fileid');
            $name=I('post.name');
            $length=I('post.length');
            if($token==''||$img==''||$fileid==''||$name==''||$length==''){
                $this->templateApi('','204','参数错误');exit;
            }
            $user=M('user')->where(array('token'=>$token))->find();
            if($user){
                $video=M('video');
                $mvp['uid']=$user['user_id'];
                $mvp['img']=$img;
                $mvp['fileid']=$fileid;
                $mvp['name']=$name;
                $mvp['length']=$length;
                $mvp['time']=time();
                $video->add($mvp);
                $this->templateApi('','200','ok');
            }else{
                $this->templateApi('','300','未登录');
            }
        }else{
            $this->templateApi('','203','请求类型错误');
        }
    }
    public function fileid(){
        if(IS_POST){
            $pid=I('post.pid');
            if($pid==''){
                $this->templateApi('','204','参数错误');exit;
            }
            $good=M('goods')->where(array('goods_id'=>$pid))->find();
            if($good['type']==2){
                $data['fileid']=$good['video_file_id'];
            }else if($good['type']==3){
                $rel=M('goods')->where(array('topic_id'=>$pid))->select();
                $class=M('class')->where(array('class_id'=>$good['class_id']))->find();
                $user=M('user')->where(array('user_id'=>$class['uid']))->find();
                $udrel=M('userdata')->where(array('uid'=>$user['user_id']))->find();
                $data['title']=$good['name'];
                $data['teacherimg']=URL.$udrel['image'];
                $data['teachername']=$user['name'];
                $data['grounding_time']=date('Y-m-d H:i:s',$good['grounding_time']);
                foreach($rel as $k=>$v){
                    $data['sonclass'][$k]['goods_id']=$v['goods_id'];
                    $data['sonclass'][$k]['name']=$v['name'];
                    $data['sonclass'][$k]['num']=$v['topic_num'];
                    $data['sonclass'][$k]['img']=URL.$v['img'];
                    $data['sonclass'][$k]['fileid']=$v['video_file_id'];
                    $data['sonclass'][$k]['video_length']=$v['video_length'];
                }
            }
            $this->templateApi($data,'200','ok');
        }else{
            $this->templateApi('','203','请求类型错误');
        }
    }
}