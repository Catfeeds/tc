<?php

namespace  Api\Controller;
use Think\Controller;
header('Content-Type:text/json;charset=utf-8');
header("Access-Control-Allow-Origin: *");
class CclivebController extends CommonController {

    public $key='IJ5WhlPcYipk4RZZvJu3P0E9eacQCTFa';
    public $userid='B561FC9EF6720EA1';
    public $videokey='piu5lw8MREqWxWAaXIZqRkHMZmat3kQ6';
    /*  直播回放
     *  roomid
     *  userid
     *   http://api.csslcloud.net/api/v2/record/info
     * */
    public function playback(){
        $pid=I('post.pid');
        if($pid==''){
            $this->templateApi('','204','参数错误');exit;
        }
        $good=M('goods')->where(array('goods_id'=>$pid))->find();
        $rel['imgURL']=URL.$good['img'];
        $rel['name']=$good['name'];
        $thqs='userid='.$this->userid;
        $thqs.='&roomid='.$good['roomid'];
        $data=$this->thqs($thqs);
        $url="http://api.csslcloud.net/api/v2/record/info?$data";
        $result=$this->request($url);
        $videoid=$result['records'];
        foreach($videoid as $k=>$v){

            $date[$k]['replayUrl']=$v['replayUrl'];
        }
//        return $videoid;
        if(empty($date)){
            $rel['data']=array();
        }else{
            $rel['data']=$date;
        }

        $this->templateApi($rel,'200','ok');
    }



    //创建视频上传信息
    public function videosign(){
        if(IS_GET){
            $filesize=I('get.filesize');
            $title=I('get.title');
            $filename=I('get.filename');
            if($filesize==''||$title==''||$filename==''){
                $this->templateApi('','204','参数错误');exit;
            }
            $thqs="userid=".$this->userid;      //userid
            $thqs.="&title=".UrlEncode($title);
            $thqs.="&filesize=".$filesize;
            $thqs.='&filename='.UrlEncode($filename);
            $thqs.='&format=json';
            $data=$this->videothqs($thqs);
            $url="http://spark.bokecc.com/api/video/create?$data";
            echo json_encode($this->request($url));

        }else{
            $this->templateApi('','203','请求类型错误');
        }
    }

    //pc创建、加入直播间
    //https://view.csslcloud.net/api/view/lecturer?roomid=xxx&userid=xxx&publishname=xxx&publishpassword=xxx
    public function pc_cate_room(){
        if(IS_POST){
            //roomid,userid,角色，昵称，密码
            $token=I('post.token');
            $pid=I('post.pid');
            $name=(string)I('post.name');       //房间名
            if($token==''||$name==''||$pid==''){
                $this->templateApi('','204','参数错误');exit;
            }
            $user=M('user')->where(array('token'=>$token))->find();
            if($user){
                $goods=M('goods')->where(array('goods_id'=>$pid))->find();
                $class=M('class')->where(array('uid'=>$user['user_id']))->find();
                if($goods['class_id']==$class['class_id']){
                    if($goods['roomid']!=null){
                        $rel['url']="https://class.csslcloud.net/index/presenter/?roomid=".$goods['roomid']."&userid=".$this->userid."&username=".$user['name']."&password=".$goods['roompass']."&autoLogin=true";
                        $this->templateApi($rel,'200','ok');exit;
                    }else{
                        $room_type=(int)2;                  //直播类型，固定2
                        $publisherpass=$this->getRandomString(6,'0123456789');  //房间密码
                        $thqs="userid=".$this->userid;      //userid
                        $thqs.="&name=".UrlEncode($name);
                        $thqs.="&room_type=".$room_type;
                        $thqs.="&audience_authtype=2";
                        $thqs.="&max_streams=2";
                        if($goods['type']==5){
                            $udrel=M('userdata')->where(array('uid'=>$user_id))->find();
                            $thqs.="&desc=".str_replace(' ','',UrlEncode($udrel['profile']));
                        }else{
                            $thqs.="&desc=".str_replace(' ','',UrlEncode($goods['introduce']));
                        }
                        $thqs.="&publisherpass=".$publisherpass;
                        $data=$this->thqs($thqs);
                        $url="https://ccapi.csslcloud.net/api/room/create?$data";
                        $result=$this->request($url);
                        $mvp['roomid']=$result['data']['roomid'];
                        $mvp['roompass']=$publisherpass;
                        $mvp['liveb_status']=1;
                        M('goods')->where(array('goods_id'=>$pid))->save($mvp);
                        $rel['url']="https://class.csslcloud.net/index/presenter/?roomid=".$goods['roomid']."&userid=".$this->userid."&username=".$user['name']."&password=".$goods['roompass']."&autoLogin=true";
                        $this->templateApi($rel,'200','ok');
                    }

                }else{
                    $payrecord=M('payrecord');
                    $payrel=$payrecord->where(array('uid'=>$user['user_id'],'cid'=>$pid))->find();
                    if($payrel){
                        if($goods['roomid']!=null){
                            $rel['url']="https://class.csslcloud.net/index/talker/?roomid=".$goods['roomid']."&userid=".$this->userid."&username=".$user['name']."&password=".$this->userid."&autoLogin=true";
                            $this->templateApi($rel,'200','ok');exit;
                        }
                        $room_type=(int)2;                  //直播类型，固定2
                        $publisherpass=$this->getRandomString(6,'0123456789');  //房间密码
                        $thqs="userid=".$this->userid;      //userid
                        $thqs.="&name=".UrlEncode($name);
                        $thqs.="&room_type=".$room_type;
                        $thqs.="&max_streams=2";
                        $thqs.="&audience_authtype=2";
                        if($goods['type']==5){
                            $udrel=M('userdata')->where(array('uid'=>$user_id))->find();
                            $thqs.="&desc=".str_replace(' ','',UrlEncode($udrel['profile']));
                        }else{
                            $thqs.="&desc=".str_replace(' ','',UrlEncode($goods['introduce']));
                        }
                        $thqs.="&publisherpass=".$publisherpass;
                        $data=$this->thqs($thqs);
                        $url="https://ccapi.csslcloud.net/api/room/create?$data";
                        $result=$this->request($url);
                        $mvp['roomid']=$result['data']['roomid'];
                        $mvp['roompass']=$publisherpass;
                        $mvp['liveb_status']=1;
                        M('goods')->where(array('goods_id'=>$pid))->save($mvp);
                        $rel['url']="https://class.csslcloud.net/index/talker/?roomid=".$goods['roomid']."&userid=".$this->userid."&username=".$user['name']."&password=".$this->userid."&autoLogin=true";
                        $this->templateApi($rel,'200','ok');
                    }else{
                        $this->templateApi('','202','您还没有购买');
                    }
                }



            }else{
                $this->templateApi('','300','未登录');
            }
        }else{
            $this->templateApi('','203','请求类型错误');
        }
    }
    /*  创建、加入直播间
     * */
    public function cate_room(){
        if(IS_POST){
            //roomid,userid,角色，昵称，密码
            $token=I('post.token');
            $pid=I('post.pid');
            $name=(string)I('post.name');       //房间名
            if($token==''||$name==''||$pid==''){
                $this->templateApi('','204','参数错误');exit;
            }
            $user=M('user')->where(array('token'=>$token))->find();
            if($user){
                if($user['vip_endtime']<time()){
                    $dovip['is_vip']=0;
                    M('user')->where(array('user_id'=>$user['user_id']))->save($dovip);
                }
                $goods=M('goods')->where(array('goods_id'=>$pid))->find();
                $class=M('class')->where(array('uid'=>$user['user_id']))->find();
                if($goods['class_id']==$class['class_id']){
                    if($goods['roomid']!=null){
                        $rel['roomid']=$goods['roomid'];
                        $rel['roompass']=$goods['roompass'];
                        $rel['role']='1';
                        $rel['userid']=$this->userid;
                        $rel['name']=$user['name'];
                        $this->templateApi($rel,'200','ok');exit;
                    }else{
                        $room_type=(int)2;                  //直播类型，固定2
                        $publisherpass=$this->getRandomString(6,'0123456789');  //房间密码
                        $thqs="userid=".$this->userid;      //userid
                        $thqs.="&name=".UrlEncode($name);
                        $thqs.="&room_type=".$room_type;
                        $thqs.="&max_streams=2";
                        $thqs.="&audience_authtype=2";
                        if($goods['type']==5){
                            $udrel=M('userdata')->where(array('uid'=>$user_id))->find();
                            $thqs.="&desc=".str_replace(' ','',UrlEncode($udrel['profile']));
                        }else{
                            $thqs.="&desc=".str_replace(' ','',UrlEncode($goods['introduce']));
                        }
                        $thqs.="&publisherpass=".$publisherpass;
                        $data=$this->thqs($thqs);
                        $url="https://ccapi.csslcloud.net/api/room/create?$data";
                        $result=$this->request($url);
                        $mvp['roomid']=$result['data']['roomid'];
                        $mvp['roompass']=$publisherpass;
                        $mvp['liveb_status']=1;
                        M('goods')->where(array('goods_id'=>$pid))->save($mvp);
                        $rel['roomid']=$mvp['roomid'];
                        $rel['roompass']=$mvp['roompass'];
                        $rel['role']='1';
                        $rel['userid']=$this->userid;
                        $rel['name']=$user['name'];
                        $this->templateApi($rel,'200','ok');exit;
                    }

                }else{
                    $payrecord=M('payrecord');
                    $payrel=$payrecord->where(array('uid'=>$user['user_id'],'cid'=>$pid))->find();
                    if($payrel){
                        if($goods['roomid']!=null){
                            $rel['roomid']=$goods['roomid'];
                            $rel['roompass']=$this->userid;
                            $rel['role']='0';
                            $rel['userid']=$this->userid;
                            $rel['name']=$user['name'];
                            $this->templateApi($rel,'200','ok');exit;
                        }
                        $room_type=(int)2;                  //直播类型，固定2
                        $publisherpass=$this->getRandomString(6,'0123456789');  //房间密码
                        $thqs="userid=".$this->userid;      //userid
                        $thqs.="&name=".UrlEncode($name);
                        $thqs.="&room_type=".$room_type;
                        $thqs.="&max_streams=2";
                        $thqs.="&audience_authtype=2";
                        if($goods['type']==5){
                            $udrel=M('userdata')->where(array('uid'=>$user_id))->find();
                            $thqs.="&desc=".str_replace(' ','',UrlEncode($udrel['profile']));
                        }else{
                            $thqs.="&desc=".str_replace(' ','',UrlEncode($goods['introduce']));
                        }
                        $thqs.="&publisherpass=".$publisherpass;
                        $data=$this->thqs($thqs);
                        $url="https://ccapi.csslcloud.net/api/room/create?$data";
                        $result=$this->request($url);
                        $mvp['roomid']=$result['data']['roomid'];
                        $mvp['roompass']=$publisherpass;
                        $mvp['liveb_status']=1;
                        M('goods')->where(array('goods_id'=>$pid))->save($mvp);
                        $rel['roomid']=$mvp['roomid'];
                        $rel['roompass']=$this->userid;
                        $rel['role']='0';
                        $rel['userid']=$this->userid;
                        $rel['name']=$user['name'];
                        $this->templateApi($rel,'200','ok');exit;
                    }else{
                        $this->templateApi('','202','您还没有购买');
                    }
                }



            }else{
                $this->templateApi('','300','未登录');
            }
        }else{
            $this->templateApi('','203','请求类型错误');
        }

    }

    //结束直播
    public function stop_room($roomid){
        $thqs='userid='.$this->userid;
        $thqs.='&roomid='.$roomid;
        $data=$this->thqs($thqs);
        $url=" https://ccapi.csslcloud.net/api/room/live/stop?$data";
        $result=$this->request($url);
        $this->close_room($roomid);
    }


    /*  关闭直播间
     *  userid  用户账号ID
     *  roomid  房间ID
     *  url：https://ccapi.csslcloud.net/api/room/close
     * */
    public function close_room($roomid){
        $thqs='userid='.$this->userid;
        $thqs.='&roomid='.$roomid;
        $data=$this->thqs($thqs);
        $url="https://ccapi.csslcloud.net/api/room/close?$data";
        $result=$this->request($url);
        $goods=M('goods')->where(array('roomid'=>$roomid))->find();
//        dump($goods);exit;
        if($result['result']=='OK'){
            $mvp['liveb_status']=0;
            M('goods')->where(array('goods_id'=>$goods['goods_id']))->save($mvp);
        }
    }

    /*  获取房间登录链接
     *  userid
     *  roomid
     *  https://ccapi.csslcloud.net/api/room/link
     * */
    public function room_link($roomid){
        $thqs='userid='.$this->userid;
        $thqs.='&roomid='.$roomid;
        $data=$this->thqs($thqs);
        $url="https://ccapi.csslcloud.net/api/room/link?$data";
        return $this->request($url);
    }
    //加密请求
    public function thqs($thqs){
        $Map = explode('&',$thqs);
        $b=array();
        foreach($Map as $k=>$v){
            $Map=explode('=',$v);
            $b[$Map[0]]=$Map[1];
        }
        ksort($b);
        $c=array();
        foreach ($b as $k=>$v) $c[]="$k=$v";
        $s=implode($c,'&');
        $time=time();
        $str=$s.'&time='.$time;
        $s.='&time='.$time;
        $s.='&salt='.$this->key;
        $hash=strtoupper(md5($s));
        $newstr=$str.'&hash='.$hash;
        return $newstr;

    }

    //视频加密
    public function videothqs($thqs){
        $Map = explode('&',$thqs);
        $b=array();
        foreach($Map as $k=>$v){
            $Map=explode('=',$v);
            $b[$Map[0]]=$Map[1];
        }
        ksort($b);
        $c=array();
        foreach ($b as $k=>$v) $c[]="$k=$v";
        $s=implode($c,'&');
        $time=time();
        $str=$s.'&time='.$time;
        $s.='&time='.$time;
        $s.='&salt='.$this->videokey;
        $hash=strtoupper(md5($s));
        $newstr=$str.'&hash='.$hash;
        return $newstr;

    }

    /*
     * 发送请求
     * 入参 ：url
     * */
    public function request($url){
        $ch = curl_init ();
        curl_setopt ( $ch, CURLOPT_URL, $url );
        curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, FALSE );
        curl_setopt ( $ch, CURLOPT_SSL_VERIFYHOST, FALSE );
        curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt ( $ch, CURLOPT_TIMEOUT, 10 );
        $data = curl_exec ( $ch );
        curl_close ( $ch );
        $result = json_decode ( $data, true );
        return  $result;
    }
}