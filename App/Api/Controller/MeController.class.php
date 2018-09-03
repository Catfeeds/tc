<?php
/********************************
 *
 * 时间：2017年10月23日
 * 功能：个人中心相关接口
 * 作者：Mr Peng
 *
 ******************************/ 
namespace Api\Controller;
use Think\Controller;
header('Content-Type:text/json;charset=utf-8');
header("Access-Control-Allow-Origin: *");
class MeController extends CommonController {

    //判断用户是否有支付密码
    public function paypassstatus(){
        $token=I('token');
        if($token==''){
            $this->templateApi('','204','参数错误');exit;
        }
        $user=M('user')->where(array('token'=>$token))->find();
        if($user){
            if($user['vip_endtime']<time()){
                $dovip['is_vip']=0;
                M('user')->where(array('user_id'=>$user['user_id']))->save($dovip);
            }
            $udrel=M('userdata')->where(array('uid'=>$user['user_id']))->find();
            if(!$udrel['paypass']){
                $data['status']='0';
            }else{
                $data['status']='1';
            }
            $this->templateApi($data,'200','ok');
        }else{
            $this->templateApi('','300','未登录');
        }
    }

    //获取地址
    public function address(){
        $adr=M('dede_area');
        $oneadr=$adr->where(array('reid'=>'0'))->select();
        foreach($oneadr as $k=>$v){
            $twoadr=$adr->where(array('reid'=>$v['id']))->field('name')->select();
            $data[$k]['onename']=$v['name'];
            foreach($twoadr as $kk=>$vv){
                $data[$k]['son'][$kk]['twoname']=$vv['name'];
            }
        }
        $this->templateApi($data,'200','ok');
    }

    //个人资料
    public function index(){
        if(IS_POST){
            $token=I('post.token');
            if($token==''){
                $data=(object)null;
                echo json_encode($this->apiTemplate($data,'204','参数错误'));
            }else{
                $user=M('user');
                $userrel=$user->where(array('token'=>$token))->find();
                if(!$userrel){
                    $data=(object)null;
                    echo json_encode($this->apiTemplate($data,'202','token过期'));
                }else{
                    if($userrel['vip_endtime']<time()){
                        $dovip['is_vip']=0;
                        M('user')->where(array('user_id'=>$userrel['user_id']))->save($dovip);
                    }
                    $sign=M('sign');
                    $signrel=$sign->where('uid='.$userrel['user_id'])->find();
                    $start_time = strtotime(date('Y-m-d'));
                    if($signrel['time']>$start_time){
                        $date['sign_status']='1';   //已签到
                    }else{
                        $date['sign_status']='0';   //未签到
                    }
                    $userdata=M('userdata');
                    $userdatarel=$userdata->where('uid='.$userrel['user_id'])->find();
                    if(empty($userdatarel['paypass'])){
                        $date['paypass_status']='0';
                    }else{
                        $date['paypass_status']='1';
                    }
                    $date['rlink']=URL.'/Home/Login/index?login='.base64_encode($userrel['user_id']);
                    $date['image']=URL.$userdatarel['image'];
                    $date['sex']=$userdatarel['sex'];
                    $date['address']=$userdatarel['address'];
                    $date['profile']=$userdatarel['profile'];
                    $date['name']=$userrel['name'];
                    echo json_encode($this->apiTemplate($date,'200','ok'));

                }
            }
        }else{
            $data=(object)null;
            echo json_encode($this->apiTemplate($data,'203','请求类型错误'));
        }
    }

    //资料修改（pc）
    public function saveme(){
        if(IS_POST){
            $token=I('post.token');
            $img=I('post.img');
            $name=I('post.name');
            $sex=I('post.sex');
            $address=I('post.address');
            $info=I('post.info');
            $birday=I('post.birday');
            if($token==''){
                $this->templateApi('','204','参数错误');exit;
            }
            $user=M('user');
            $ud=M('userdata');
            $userrel=$user->where(array('token'=>$token))->find();
            if($userrel){
                if($userrel['vip_endtime']<time()){
                    $dovip['is_vip']=0;
                    M('user')->where(array('user_id'=>$userrel['user_id']))->save($dovip);
                }
                if($name){
                    $mvp['name']=$name;
                }
                $user->where(array('user_id'=>$userrel['user_id']))->save($mvp);
                if($img){
                    $mmp['image']=$img;
                }
                if($sex){
                    $mmp['sex']=$sex;
                }
                if($address){
                    $mmp['address']=$address;
                }
                if($info){
                    $mmp['profile']=$info;
                }
                if($birday){
                    $mmp['birthday']=$birday;
                }
                $ud->where(array('uid'=>$userrel['user_id']))->save($mmp);
                $this->templateApi('','200','ok');
            }else{
                $this->templateApi('','300','未登录');
            }
        }else{
            $this->templateApi('','203','请求类型错误');
        }
    }

    //修改生日
    public function editbirthday(){
        if(IS_POST){
            $token=I('post.token');
            $bir=I('post.birthday');
            if($token==''||$bir==''){
                $this->templateApi('','204','参数错误');exit;
            }
            $user=M('user')->where(array('token'=>$token))->find();
            if($user){
                if($user['vip_endtime']<time()){
                    $dovip['is_vip']=0;
                    M('user')->where(array('user_id'=>$user['user_id']))->save($dovip);
                }
                $udrel=M('userdata')->where(array('uid'=>$user['user_id']))->find();
                $mvp['birthday']=$bir;
                M('userdata')->where(array('userdata_id'=>$udrel['userdata_id']))->save($mvp);
                $data['birthday']=$bir;
                $this->templateApi($data,'200','ok');
            }else{
                $this->templateApi('','300','未登录');
            }
        }else{
            $this->templateApi('','203','请求类型错误');
        }
    }

    //头像上传
    public function picupload(){
        if(IS_POST){
            $token=I('post.token');
            $img=I('post.img');
            if($token==''||$img==''){
                $this->templateApi('','204','参数错误');exit;
            }
            $user=M('user')->where(array('token'=>$token))->find();
            if($user){
                if($user['vip_endtime']<time()){
                    $dovip['is_vip']=0;
                    M('user')->where(array('user_id'=>$user['user_id']))->save($dovip);
                }
                $mvp['image']=$img;
                M('userdata')->where(array('uid'=>$user['user_id']))->save($mvp);
                $data['img']=URL.$img;
                $this->templateApi($data,'200','ok');
            }else{
                $this->templateApi('','300','未登录');
            }
        }else{
            $data=(object)null;
            echo json_encode($this->apiTemplate($data,'203','请求类型错误'));
        }
        
    }

    //昵称修改
    public function modifyname(){
        if(IS_POST){
            $name=Sensitivefilter(I('post.name'));
            $token=I('post.token');
            if(empty($name)||empty($token)){
                $data=(object)null;
                echo json_encode($this->apiTemplate($data,'204','参数错误'));exit;
            }
            $user=M('user');
            $rel=$user->where(array('token'=>$token))->find();
            if(!$rel){
                $data['result']=(object)null;
                $data['code']='202';
                $data['message']='token过期';
                $data['time']=time();
                echo json_encode($data);
            }else{
                $result=$user->where(array('name'=>$name))->find();
                if($result){
                    $data['result']=(object)null;
                    $data['code']='202';
                    $data['message']='用户名已存在';
                    $data['time']=time();
                    echo json_encode($data);
                }else{
                    $mvp['name']=$name;
                    $date=$user->where('user_id='.$rel['user_id'])->save($mvp);
                    if(!$date){
                        $data['result']=(object)null;
                        $data['code']='202';
                        $data['message']='修改失败';
                        $data['time']=time();
                        echo json_encode($data);
                    }else{
                        $data['result']['name']=$mvp['name'];
                        $data['code']='200';
                        $data['message']='修改成功';
                        $data['time']=time();
                        echo json_encode($data); 
                    }
                }
            }
        }else{
            $data=(object)null;
            echo json_encode($data,'203','请求类型错误');
        }
        

    }

    //性别修改
    public function modifysex(){
        if(IS_POST){
            $sex=I('post.sex');
            $token=I('post.token');
            if(empty($sex)||empty($token)){
                $data=(object)null;
                echo json_encode($this->apiTemplate($data,'204','参数错误'));exit;
            }
            $user=M('user');
            $userdata=M('userdata');
            $rel=$user->where(array('token'=>$token))->find();
            if(!$rel){
                $data['result']=(object)null;
                $data['code']='202';
                $data['message']='token过期';
                $data['time']=time();
                echo json_encode($data);
            }else{
                $mvp['sex']=$sex;
                $pie=$userdata->where(array('uid'=>$rel['user_id']))->find();
                if($sex==$pie['sex']){
                    $data['result']['sex']=$mvp['sex'];
                    $data['code']='200';
                    $data['message']='修改成功';
                    $data['time']=time();
                    echo json_encode($data);
                }else{
                    $result=$userdata->where(array('uid'=>$rel['user_id']))->save($mvp);
                    if($result){
                        $data['result']['sex']=$mvp['sex'];
                        $data['code']='200';
                        $data['message']='修改成功';
                        $data['time']=time();
                        echo json_encode($data);

                    }else{
                        $data['result']=(object)null;
                        $data['code']='202';
                        $data['message']='修改失败';
                        $data['time']=time();
                        echo json_encode($data);
                    }
                }
                
            }
        }else{
            $data=(object)null;
            echo json_encode($this->apiTemplate($data,'203','请求类型错误'));
        }
        
    }

    //地区修改
    public function modifyaddress(){
        if(IS_POST){
            $address=I('post.address');
            $token=I('post.token');
            if(empty($address)||empty($token)){
                $data=(object)null;
                echo json_encode($this->apiTemplate($data,'204','参数错误'));exit;
            }
            $user=M('user');
            $userdata=M('userdata');
            $rel=$user->where(array('token'=>$token))->find();
            if(!$rel){
                $data['result']=(object)null;
                $data['code']='202';
                $data['message']='token过期';
                $data['time']=time();
                echo json_encode($data);
            }else{
                $mvp['address']=$address;
                $pie=$userdata->where('uid='.$rel['user_id'])->find();
                if($address==$pie['address']){
                    $data['result']['address']=$mvp['address'];
                    $data['code']='200';
                    $data['message']='修改成功';
                    $data['time']=time();
                    echo json_encode($data);
                }else{
                    $result=$userdata->where('uid='.$rel['user_id'])->save($mvp);
                    if( false === $result){
                        $data['result']=(object)null;
                        $data['code']='202';
                        $data['message']='修改失败';
                        $data['time']=time();
                        echo json_encode($data);
                    }else{
                        $data['result']['address']=$mvp['address'];
                        $data['code']='200';
                        $data['message']='修改成功';
                        $data['time']=time();
                        echo json_encode($data);
                    }
                }
                
            }
        }else{
            $data=(object)null;
            echo json_encode($this->apiTemplate($data,'203','请求类型错误'));
        }
        
    }

    //个人简介
    public function profile(){
        if(IS_POST){
            $token=I('post.token');
            $profile=Sensitivefilter(I('post.profile'));
            if(empty($token)){
                $data=(object)null;
                echo json_encode($this->apiTemplate($data,'204','参数错误'));exit;
            }
            $user=M('user');
            $userdata=M('userdata');
            $rel=$user->where(array('token'=>$token))->find();
            if(!$rel){
                $data['result']=(object)null;
                $data['code']='202';
                $data['message']='token过期';
                $data['time']=time();
                echo json_encode($data);
            }else{
                $mvp['profile']=$profile;
                $pie=$userdata->where('uid='.$rel['user_id'])->find();
                if($profile==$pie['profile']){
                    $data['result']['profile']=$mvp['profile'];
                    $data['code']='200';
                    $data['message']='修改成功';
                    $data['time']=time();
                    echo json_encode($data);
                }else{
                    $result=$userdata->where('uid='.$rel['user_id'])->save($mvp);
                    if( false === $result){
                        $data['result']=(object)null;
                        $data['code']='202';
                        $data['message']='修改失败';
                        $data['time']=time();
                        echo json_encode($data);
                    }else{
                        $data['result']['profile']=$mvp['profile'];
                        $data['code']='200';
                        $data['message']='修改成功';
                        $data['time']=time();
                        echo json_encode($data);
                    }
                }
                
            }
        }else{
            $data=(object)null;
            echo json_encode($this->apiTemplate($data,'203','请求类型错误'));
        }
        
    }

    //我的收藏
    public function subscribe(){
        if(IS_GET){
            $token=I('get.token');
            $page=I('get.page');
            if(empty($page)||empty($token)){
                $data=(object)null;
                echo json_encode($this->apiTemplate($data,'204','参数错误'));exit;
            }
            $user=M('user');
            $class=M('liveb');
            $video=M('video');
            $rel=$user->where(array('token'=>$token))->find();
            if(!$rel){
                $data=(object)null;
                echo json_encode($this->apiTemplate($data,'202','token过期'));
            }else{
                if($rel['vip_endtime']<time()){
                    $dovip['is_vip']=0;
                    M('user')->where(array('user_id'=>$rel['user_id']))->save($dovip);
                }
                $uid=$rel['user_id'];
                $config = array(
                    'tablename' => 'subscribe', // 表名
                    'where'     => 'uid='.$uid, // 查询条件
                    'relation'  => '',          // 关联条件
                    'order'     => '',          // 排序
                    'page'      => $page,       // 页码，默认为首页
                    'num'       => 20            // 每页条数
                );
                $ppp = new \Org\Util\Page($config);
                $data = $ppp->get();
                $pie['now_page']=$data['now_page'];
                $pie['total_page']=$data['total_page'];
                unset($data['now_page']);
                unset($data['total_page']);
                foreach ( $data as $key=>$val){
                    if($val['type']=='0'){
                        $date[$key]=$class->field('liveb_id,img,name,money,time')->where('liveb_id='.$val['cid'])->find();
                        $date[$key]['subscribe_id']=$val['subscribe_id'];
                        $date[$key]['play_id']=$val['cid'];
                        $date[$key]['type']=$val['type'];
                        unset($date[$key]['liveb_id']);
                        $date[$key]['img']=URL.$date[$key]['img'];
                    }else{
                        $date[$key]=$video->field('video_id,img,name,money,time')->where('video_id='.$val['cid'])->find();
                        $date[$key]['subscribe_id']=$val['subscribe_id'];
                        $date[$key]['play_id']=$val['cid'];
                        $date[$key]['type']=$val['type'];
                        unset($date[$key]['video_id']);
                    }
                }
                foreach ( $date as $k=>$v){
                    $date[$k]['time']=date('Y年m月d日 H:i:s',$v['time']);
                }
                if(empty($date)){
                    $acc['subscribe']=(object)null;
                }else{
                    $acc['subscribe']=$date;
                }
                $acc['now_page']=$pie['now_page'];
                $acc['total_page']=$pie['total_page'];
                echo json_encode($this->apiTemplate($acc,'200','ok'));

            }
        }else{
            $data=(object)null;
            echo json_encode($this->apiTemplate($data,'203','请求类型错误'));
        }
        
        

    }

    //取消收藏
    public function subscribedel(){
        if(IS_POST){
            $id=I('post.pid');
            $token=I('post.token');
            if($id==''||$token==''){
                $data=(object)null;
                echo json_encode($this->apiTemplate($data,'204','参数错误'));exit;
            }
            $user=M('user')->where(array('token'=>$token))->find();
            if($user){
                if($user['vip_endtime']<time()){
                    $dovip['is_vip']=0;
                    M('user')->where(array('user_id'=>$user['user_id']))->save($dovip);
                }
                $subscribe=M('subscribe');
                $rel=$subscribe->where(array('uid'=>$user['user_id'],'cid'=>$id))->delete();
                $this->templateApi('','200','ok');
            }else{
                $this->templateApi('','300','未登录');
            }
        }else{
            $data=(object)null;
            echo json_encode($this->apiTemplate($data,'203','请求类型错误'));
        }
        

    }

    //设置支付密码
    public function paypass(){
        if(IS_POST){
            $token=I('post.token');
            $paypass=I('post.paypass');
            if($token==''||$paypass==''){
                $data=(object)null;
                echo json_encode($this->apiTemplate($data,'204','参数错误'));
            }else{
                $user=M('user');
                $userrel=$user->where(array('token'=>$token))->find();
                if($userrel){
                    if($userrel['vip_endtime']<time()){
                        $dovip['is_vip']=0;
                        M('user')->where(array('user_id'=>$userrel['user_id']))->save($dovip);
                    }
                    $userdata=M('userdata');
                    $mvp['paypass']=md5(md5($paypass));
                    $rel=$userdata->where('uid='.$userrel['user_id'])->save($mvp);
                    if($rel!==false){
                        $data=(object)null;
                        echo json_encode($this->apiTemplate($data,'200','ok'));
                    }else{
                        $data=(object)null;
                        echo json_encode($this->apiTemplate($data,'202','修改失败'));
                    }
                }else{
                    $data=(object)null;
                    echo json_encode($this->apiTemplate($data,'202','token过期'));
                }
            }
        }else{
            $data=(object)null;
            echo json_encode($this->apiTemplate($data,'203','请求类型错误'));
        }
    }

    //修改登录密码
    public function savepass(){
        if(IS_POST){
            $token=I('post.token');
            $oldpass=I('post.oldpass');
            $newpass=I('post.newpass');
            if($token==''||$oldpass==''||$newpass==''){
                $data=(object)null;
                echo json_encode($this->apiTemplate($data,'204','参数错误'));
            }else{
                $user=M('user');
                $userrel=$user->where(array('token'=>$token))->find();
                if($userrel){
                    if($userrel['vip_endtime']<time()){
                        $dovip['is_vip']=0;
                        M('user')->where(array('user_id'=>$userrel['user_id']))->save($dovip);
                    }
                    if($userrel['pass']==md5(md5($oldpass))){
                        $mvp['pass']=md5(md5($newpass));
                        $mvp['token']=md5($userrel['phone'].$this->getRandomString(16));
                        $rel=$user->where('user_id='.$userrel['user_id'])->save($mvp);
                        if($rel){
                            $data=(object)null;
                            echo json_encode($this->apiTemplate($data,'200','修改成功'));
                        }else{
                            $data=(object)null;
                            echo json_encode($this->apiTemplate($data,'202','修改失败'));
                        }
                    }else{
                        $data=(object)null;
                        echo json_encode($this->apiTemplate($data,'202','原密码不正确'));
                    }
                }else{
                    $data=(object)null;
                    echo json_encode($this->apiTemplate($data,'202','token过期'));
                }
            }
        }else{
            $data=(object)null;
            echo json_encode($this->apiTemplate($data,'203','请求类型错误'));
        }
    }

    //修改支付密码
    public function savepaypass(){
        if(IS_POST){
            $token=I('post.token');
            $oldpaypass=I('post.oldpaypass');
            if($token==''||$oldpaypass==''){
                $data=(object)null;
                echo json_encode($this->apiTemplate($data,'204','参数错误'));
            }else{
                $user=M('user');
                $userrel=$user->where(array('token'=>$token))->find();
                if($userrel){
                    if($userrel['vip_endtime']<time()){
                        $dovip['is_vip']=0;
                        M('user')->where(array('user_id'=>$userrel['user_id']))->save($dovip);
                    }
                    $userdata=M('userdata');
                    $userdatarel=$userdata->where(array('uid'=>$userrel['user_id']))->find();
                    $oldpaypass=md5(md5($oldpaypass));
                    if($oldpaypass==$userdatarel['paypass']){
                        $data=(object)null;
                        echo json_encode($this->apiTemplate($data,'200','ok'));
                    }else{
                        $data=(object)null;
                        echo json_encode($this->apiTemplate($data,'202','原密码不正确'));
                    }
                }else{
                    $data=(object)null;
                    echo json_encode($this->apiTemplate($data,'202','token过期'));
                }
            }
        }else{
            $data=(object)null;
            echo json_encode($this->apiTemplate($data,'203','请求类型错误'));
        }
    }

    //签到
    public function sign(){
        if(IS_POST){
            $token=I('post.token');
            if($token==''){
                $data=(object)null;
                echo json_encode($this->apiTemplate($data,'204','参数错误'));
            }else{
                $userrel=M('user')->where(array('token'=>$token))->find();
                if($userrel){
                    if($userrel['vip_endtime']<time()){
                        $dovip['is_vip']=0;
                        M('user')->where(array('user_id'=>$userrel['user_id']))->save($dovip);
                    }
                    $sign=M('sign');
                    $userdata=M('userdata');
                    $signrel=$sign->where('uid='.$userrel['user_id'])->find();
                    if(!$signrel){
                        $mvp['uid']=$userrel['user_id'];
                        $mvp['time']=time();
                        $mvp['signday']=1;
                        $rel=$sign->add($mvp);
                        if($rel){
                            if($userrel['is_vip']==1){
                                $userdatarel=$userdata->where('uid='.$userrel['user_id'])->setInc('integral',5);
                                if($userdatarel){
                                    $integral=M('integral');
                                    $int['uid']=$userrel['user_id'];
                                    $int['type']='1';
                                    $int['source']='签到';
                                    $int['num']=5;
                                    $int['time']=time();
                                    $integral->add($int);
                                    $data['day']='1';
                                    $data['integral']='5';
                                    echo json_encode($this->apiTemplate($data,'200','签到成功'));
                                }else{
                                    $data=(object)null;
                                    echo json_encode($this->apiTemplate($data,'202','签到失败'));
                                }
                            }else{
                                $userdatarel=$userdata->where('uid='.$userrel['user_id'])->setInc('integral',5);
                                if($userdatarel){
                                    $integral=M('integral');
                                    $int['uid']=$userrel['user_id'];
                                    $int['type']='1';
                                    $int['source']='签到';
                                    $int['num']=5;
                                    $int['time']=time();
                                    $integral->add($int);
                                    $data['day']='1';
                                    $data['integral']='5';
                                    echo json_encode($this->apiTemplate($data,'200','签到成功'));
                                }else{
                                    $data=(object)null;
                                    echo json_encode($this->apiTemplate($data,'202','签到失败'));
                                }
                            }
                        }else{
                            $data=(object)null;
                            echo json_encode($this->apiTemplate($data,'202','签到失败'));
                        }
                    }else{
                        $start_time = strtotime(date('Y-m-d'));
                        if($signrel['time']>$start_time){
                            $data=(object)null;
                            echo json_encode($this->apiTemplate($data,'202','今日已签到'));
                        }else{
                            if($start_time-86400<=$signrel['time'] && $signrel['time']<$start_time){
                                if(1<=$signrel['signday'] && $signrel['signday']<=5){
                                    $mvp['time']=time();
                                    $mvp['signday']=$signrel['signday']+1;
                                    $rel=$sign->where('sign_id='.$signrel['sign_id'])->save($mvp);
                                    if($rel){
                                        if($userrel['is_vip']==1){
                                            $userdatarel=$userdata->where('uid='.$userrel['user_id'])->setInc('integral',5);
                                            if($userdatarel){
                                                $integral=M('integral');
                                                $int['uid']=$userrel['user_id'];
                                                $int['type']='1';
                                                $int['source']='签到';
                                                $int['num']=5;
                                                $int['time']=time();
                                                $integral->add($int);
                                                $data['day']=$signrel['signday']+1;
                                                $data['integral']='5';
                                                echo json_encode($this->apiTemplate($data,'200','签到成功'));
                                            }else{
                                                $data=(object)null;
                                                echo json_encode($this->apiTemplate($data,'202','签到失败'));
                                            }
                                        }else{
                                            $userdatarel=$userdata->where('uid='.$userrel['user_id'])->setInc('integral',5);
                                            if($userdatarel){
                                                $integral=M('integral');
                                                $int['uid']=$userrel['user_id'];
                                                $int['type']='1';
                                                $int['source']='签到';
                                                $int['num']=5;
                                                $int['time']=time();
                                                $integral->add($int);
                                                $data['day']=$signrel['signday']+1;
                                                $data['integral']='5';
                                                echo json_encode($this->apiTemplate($data,'200','签到成功'));
                                            }else{
                                                $data=(object)null;
                                                echo json_encode($this->apiTemplate($data,'202','签到失败'));
                                            }
                                        }

                                    }else{
                                        $data=(object)null;
                                        echo json_encode($this->apiTemplate($data,'202','签到失败'));
                                    }
                                }else if(6<=$signrel['signday'] && $signrel['signday']<=12){
                                    $mvp['time']=time();
                                    $mvp['signday']=$signrel['signday']+1;
                                    $rel=$sign->where('sign_id='.$signrel['sign_id'])->save($mvp);
                                    if($rel){
                                        if($userrel['is_vip']==1){
                                            $userdatarel=$userdata->where('uid='.$userrel['user_id'])->setInc('integral',5);
                                            if($userdatarel){
                                                $integral=M('integral');
                                                $int['uid']=$userrel['user_id'];
                                                $int['type']='1';
                                                $int['source']='签到';
                                                $int['num']=5;
                                                $int['time']=time();
                                                $integral->add($int);
                                                $data['day']=$signrel['signday']+1;
                                                $data['integral']='5';
                                                echo json_encode($this->apiTemplate($data,'200','签到成功'));
                                            }else{
                                                $data=(object)null;
                                                echo json_encode($this->apiTemplate($data,'202','签到失败'));
                                            }
                                        }else{
                                            $userdatarel=$userdata->where('uid='.$userrel['user_id'])->setInc('integral',5);
                                            if($userdatarel){
                                                $integral=M('integral');
                                                $int['uid']=$userrel['user_id'];
                                                $int['type']='1';
                                                $int['source']='签到';
                                                $int['num']=5;
                                                $int['time']=time();
                                                $integral->add($int);
                                                $data['day']=$signrel['signday']+1;
                                                $data['integral']='5';
                                                echo json_encode($this->apiTemplate($data,'200','签到成功'));
                                            }else{
                                                $data=(object)null;
                                                echo json_encode($this->apiTemplate($data,'202','签到失败'));
                                            }
                                        }

                                    }else{
                                        $data=(object)null;
                                        echo json_encode($this->apiTemplate($data,'202','签到失败'));
                                    }
                                }else{
                                    $mvp['time']=time();
                                    $mvp['signday']=$signrel['signday']+1;
                                    $rel=$sign->where('sign_id='.$signrel['sign_id'])->save($mvp);
                                    if($rel){
                                        if($userrel['is_vip']==1){
                                            $userdatarel=$userdata->where('uid='.$userrel['user_id'])->setInc('integral',5);
                                            if($userdatarel){
                                                $integral=M('integral');
                                                $int['uid']=$userrel['user_id'];
                                                $int['type']='1';
                                                $int['source']='签到';
                                                $int['num']=5;
                                                $int['time']=time();
                                                $integral->add($int);
                                                $data['day']=$signrel['signday']+1;
                                                $data['integral']='5';
                                                echo json_encode($this->apiTemplate($data,'200','签到成功'));
                                            }else{
                                                $data=(object)null;
                                                echo json_encode($this->apiTemplate($data,'202','签到失败'));
                                            }
                                        }else{
                                            $userdatarel=$userdata->where('uid='.$userrel['user_id'])->setInc('integral',5);
                                            if($userdatarel){
                                                $integral=M('integral');
                                                $int['uid']=$userrel['user_id'];
                                                $int['type']='1';
                                                $int['source']='签到';
                                                $int['num']=5;
                                                $int['time']=time();
                                                $integral->add($int);
                                                $data['day']=$signrel['signday']+1;
                                                $data['integral']='5';
                                                echo json_encode($this->apiTemplate($data,'200','签到成功'));
                                            }else{
                                                $data=(object)null;
                                                echo json_encode($this->apiTemplate($data,'202','签到失败'));
                                            }
                                        }

                                    }else{
                                        $data=(object)null;
                                        echo json_encode($this->apiTemplate($data,'202','签到失败'));
                                    }
                                }
                            }else{
                                $mvp['time']=time();
                                $mvp['signday']=1;
                                $rel=$sign->where('sign_id='.$signrel['sign_id'])->save($mvp);
                                if($rel){
                                    if($userrel['is_vip']==1){
                                        $userdatarel=$userdata->where('uid='.$userrel['user_id'])->setInc('integral',5);
                                        if($userdatarel){
                                            $integral=M('integral');
                                            $int['uid']=$userrel['user_id'];
                                            $int['type']='1';
                                            $int['source']='签到';
                                            $int['num']=5;
                                            $int['time']=time();
                                            $integral->add($int);
                                            $data['day']='1';
                                            $data['integral']='5';
                                            echo json_encode($this->apiTemplate($data,'200','签到成功'));
                                        }else{
                                            $data=(object)null;
                                            echo json_encode($this->apiTemplate($data,'202','签到失败'));
                                        }
                                    }else{
                                        $userdatarel=$userdata->where('uid='.$userrel['user_id'])->setInc('integral',5);
                                        if($userdatarel){
                                            $integral=M('integral');
                                            $int['uid']=$userrel['user_id'];
                                            $int['type']='1';
                                            $int['source']='签到';
                                            $int['num']=5;
                                            $int['time']=time();
                                            $integral->add($int);
                                            $data['day']='1';
                                            $data['integral']='5';
                                            echo json_encode($this->apiTemplate($data,'200','签到成功'));
                                        }else{
                                            $data=(object)null;
                                            echo json_encode($this->apiTemplate($data,'202','签到失败'));
                                        }
                                    }

                                }else{
                                    $data=(object)null;
                                    echo json_encode($this->apiTemplate($data,'202','签到失败'));
                                }
                            }
                        }
                    }
                }else{
                    $data=(object)null;
                    echo json_encode($this->apiTemplate($data,'202','token过期'));
                }
            }
        }else{
            $data=(object)null;
            echo json_encode($this->apiTemplate($data,'203','请求类型错误'));
        }
    }

    //绑定手机号
    public function bdphone(){
        $data=(object)null;
        if(IS_POST){
            $phone=I('post.phone');
            $token=I('post.token');
            $verify=I('post.verify');
            if($phone==''||$verify==''||$token==''){
                echo json_encode($this->apiTemplate($data,'204','参数错误'));
            }else{
                $user=M('user');
                $userrel=$user->where(array('phone'=>$phone))->find();
                if($userrel){
                    if($userrel['vip_endtime']<time()){
                        $dovip['is_vip']=0;
                        M('user')->where(array('user_id'=>$userrel['user_id']))->save($dovip);
                    }
                    $reg=S($phone);
                    if($reg!=$verify || !$reg){
                        echo json_encode($this->apiTemplate($data,'202','验证码错误'));
                    }else{
                        $rel=$user->where(array('token'=>$token))->find();
                        if($rel){
                            $mvp['qq_unioid']=$rel['qq_unioid'];
                            $mvp['wx_unioid']=$rel['wx_unioid'];
                            $phonerel=$user->where(array('user_id'=>$userrel['user_id']))->save($mvp);
                            if($phonerel){
                                M('userdata')->where(array('uid'=>$rel['user_id']))->delete();
                                $user->where(array('user_id'=>$rel['user_id']))->delete();
                                $date['phone_status']='1';  //老用户
                                $udrel=M('userdata')->where(array('uid'=>$userrel['user_id']))->find();
                                $date['uImgURL']=URL.$udrel['image'];
                                $date['uName']=$userrel['name'];
                                $date['uInfo']=$udrel['profile'];
                                $sign=M('sign');
                                $signrel=$sign->where('uid='.$userrel['user_id'])->find();
                                $start_time = strtotime(date('Y-m-d'));
                                if($signrel['time']>$start_time){
                                    $date['isSignIn']='0';   //已签到
                                }else{
                                    $date['isSignIn']='1';   //未签到
                                }
                                $date['sex']=(string)$udrel['sex'];
                                $date['address']=(string)$udrel['address'];
                                $date['birthday']=(string)$udrel['birthday'];
                                $date['link']=(string)'http://www.baidu.com?intivi='.$userrel['phone'];
                                $date['phone']=$userrel['phone'];
                                $follow=M('follow')->where(array('uid'=>$userrel['user_id']))->count();
                                $date['followNum']=(string)$follow;
                                $date['integral']=(string)$udrel['integral'];
                                $date['ykbBalance']=(string)$udrel['money'];
                                $date['token']=(string)$userrel['token'];
                                echo json_encode($this->apiTemplate($date,'200','绑定成功'));
                            }else{
                                echo json_encode($this->apiTemplate($data,'202','绑定失败'));
                            }
                        }else{
                            echo json_encode($this->apiTemplate($data,'300','未登录'));
                        }

                    }
                }else{
                    $reg=S($phone);
                    if($reg!=$verify || !$reg){
                        echo json_encode($this->apiTemplate($data,'202','验证码错误'));
                    }else{
                        $saz['phone']=$phone;
                        $rel=$user->where(array('token'=>$token))->find();
                        if($rel){
                            $phonerel=$user->where('user_id='.$rel['user_id'])->save($saz);
                            if($phonerel){
                                $date['phone_status']='0';  //新用户
                                $udrel=M('userdata')->where(array('uid'=>$rel['user_id']))->find();
                                $date['uImgURL']=$udrel['image'];
                                $date['uName']=$rel['name'];
                                $date['uInfo']=$udrel['profile'];
                                $sign=M('sign');
                                $signrel=$sign->where('uid='.$rel['user_id'])->find();
                                $start_time = strtotime(date('Y-m-d'));
                                if($signrel['time']>$start_time){
                                    $date['isSignIn']='0';   //已签到
                                }else{
                                    $date['isSignIn']='1';   //未签到
                                }
                                $date['sex']=(string)$udrel['sex'];
                                $date['address']=(string)$udrel['address'];
                                $date['birthday']=(string)$udrel['birthday'];
                                $date['link']=(string)'http://www.baidu.com?intivi='.$phone;
                                $date['phone']=(string)$phone;
                                $follow=M('follow')->where(array('uid'=>$rel['user_id']))->count();
                                $date['followNum']=(string)$follow;
                                $date['integral']=(string)$udrel['integral'];
                                $date['ykbBalance']=(string)$udrel['money'];
                                $date['token']=(string)$rel['token'];
                                echo json_encode($this->apiTemplate($date,'200','绑定成功'));
                            }else{
                                echo json_encode($this->apiTemplate($data,'202','绑定失败'));
                            }
                        }else{
                            echo json_encode($this->apiTemplate($data,'300','未登录'));
                        }

                    }
                }
            }
        }else{
            echo json_encode($this->apiTemplate($data,'203','请求类型错误'));
        }
    }

    //我的首页
    public function indextwo(){
        if(IS_POST){
            $token=I('post.token');     //用户token
            if($token==''){
                $this->templateApi('','204','参数错误');exit;
            }
            $userrel=M('user')->where(array('token'=>$token))->find();
            if($userrel){
                if($userrel['vip_endtime']<time()){
                    $dovip['is_vip']=0;
                    M('user')->where(array('user_id'=>$userrel['user_id']))->save($dovip);
                }
                $udrel=M('userdata')->where(array('uid'=>$userrel['user_id']))->find();
                $data['uImgURL']=URL.$udrel['image'];
                $data['uName']=$userrel['name'];
                if($udrel['profile']==''){
                    $data['uInfo']='这个人很懒，什么也没有留下';
                }else{
                    $data['uInfo']=$udrel['profile'];
                }
                $data['is_vip']=(string)$userrel['is_vip'];
                $sign=M('sign');
                $signrel=$sign->where('uid='.$userrel['user_id'])->find();
                $start_time = strtotime(date('Y-m-d'));
                if($signrel['time']>$start_time){
                    $data['isSignIn']='0';   //已签到
                }else{
                    $data['isSignIn']='1';   //未签到
                }
                $follow=M('follow')->where(array('uid'=>$userrel['user_id']))->count();
                $data['followNum']=(string)$follow;
                $data['sex']=(string)$udrel['sex'];
                $data['address']=(string)$udrel['address'];
                $data['birthday']=(string)$udrel['birthday'];
                $data['link']=(string)'http://www.wyueke.com?intivi='.$userrel['phone'];
                $data['phone']=$userrel['phone'];
                $data['integral']=(string)$udrel['integral'];
                $data['ykbBalance']=(string)$udrel['money'];
                $data['token']=$token;
                $this->templateApi($data,'200','ok');
            }else{
                $this->templateApi('','300','token过期');
            }
        }else{
            $this->templateApi('','203','请求类型错误');
        }


    }

    //添加关注
    public function addfollow(){
        if(IS_POST){
            $token=I('post.token');
            $sid=I('post.sId');
            if($token==''||$sid==''){
                $this->templateApi('','204','参数错误');exit;
            }
            $user=M('user')->where(array('token'=>$token))->find();
            if($user){
                if($user['vip_endtime']<time()){
                    $dovip['is_vip']=0;
                    M('user')->where(array('user_id'=>$user['user_id']))->save($dovip);
                }
                $mvp['uid']=$user['user_id'];
                $mvp['class_id']=$sid;
                $mvp['time']=time();
                M('follow')->add($mvp);
                M('class')->where(array('class_id'=>$sid))->setInc('follow_num');
                $this->templateApi('','200','ok');
            }else{
                $this->templateApi('','300','未登录');
            }
        }else{
            $this->templateApi('','203','请求类型错误');
        }
    }

    //我的关注
    public function follow(){
        if(IS_POST){
            $token=I('post.token');
            $page=I('post.pageNum');
            if($token==''||$page==''){
                $this->templateApi('','204','参数错误');exit;
            }
            $userrel=M('user')->where(array('token'=>$token))->find();
            if($userrel){
                if($userrel['vip_endtime']<time()){
                    $dovip['is_vip']=0;
                    M('user')->where(array('user_id'=>$userrel['user_id']))->save($dovip);
                }
                $count=M('follow')->where('uid='.$userrel['user_id'])->count();
                $data=$this->havePage('follow','uid='.$userrel['user_id'],'time desc',$page,'20','');
                $pie['now_page']=$data['now_page'];
                $pie['total_page']=$data['total_page'];
                unset($data['now_page']);
                unset($data['total_page']);
                foreach($data as $k=>$v){
                    $class=M('class')->where(array('class_id'=>$v['class_id']))->find();
                    $udrel=M('userdata')->where(array('uid'=>$class['uid']))->find();
                    $date[$k]['sId']=$class['class_id'];
                    $date[$k]['sImgURL']=URL.$class['img'];
                    $date[$k]['sName']=$class['name'];
                    $date[$k]['sLV']=$class['grade'];
                    if($class['type']==3){
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
                    $date[$k]['shopInfo']=$class['introduce'];
//                    $follow=M('follow')->where(array('class_id'=>$class['class_id']))->count();
                    $date[$k]['followNum']=(string)$class['follow_num'];
                    $goods=M('goods')->where(array('class_id'=>$class['class_id'],'del_status'=>'0'))->field('goods_id,img,type,price_status')->limit(2)->select();
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

    //取消关注
    public function delfollow(){
        if(IS_POST){
            $token=I('post.token');
            $sid=I('post.sId');
            if($token==''||$sid==''){
                $this->templateApi('','204','参数错误');exit;
            }
            $user=M('user')->where(array('token'=>$token))->find();
            if($user){
                if($user['vip_endtime']<time()){
                    $dovip['is_vip']=0;
                    M('user')->where(array('user_id'=>$user['user_id']))->save($dovip);
                }
                M('class')->where(array('class_id'=>$sid))->setDec('follow_num');
                M('follow')->where(array('uid'=>$user['user_id'],'class_id'=>$sid))->delete();
                $this->templateApi('','200','ok');
            }else{
                $this->templateApi('','300','未登录');
            }
        }else{
            $this->templateApi('','203','请求类型错误');
        }
    }

    //我的收藏-视频
    public function videoCollection(){
        if(IS_POST){
            $token=I('post.token');     //用户token
            $page=I('post.pageNum');    //页数
            if($token==''||$page==''){
                $this->templateApi('','204','参数错误');exit;
            }
            $userrel=M('user')->where(array('token'=>$token))->find();
            if($userrel){
                if($userrel['vip_endtime']<time()){
                    $dovip['is_vip']=0;
                    M('user')->where(array('user_id'=>$userrel['user_id']))->save($dovip);
                }
                $where['uid']=$userrel['user_id'];
                $where['type']=array('IN','2,3,4');
                $count=M('subscribe')->where($where)->count();
                $data=$this->havePage('subscribe',$where,'time desc',$page,'20','');
                $pie['now_page']=$data['now_page'];
                $pie['total_page']=$data['total_page'];
                unset($data['now_page']);
                unset($data['total_page']);
                foreach($data as $k=>$v){
                    $goods=M('goods')->where(array('goods_id'=>$v['cid']))->find();
                    $date[$k]['pid']=(string)$goods['goods_id'];
                    $date[$k]['pName']=(string)$goods['name'];
                    $date[$k]['sonClassAmount']=(string)$goods['classhour'];
                    $date[$k]['openSaleTime']=(string)date('Y年m月d日 H:i:s',$goods['grounding_time']);
                    $date[$k]['endSetClassTime']=(string)date('Y年m月d日 H:i:s',$goods['endtime']);
                    $date[$k]['pType']=(string)$goods['type'];
                    $date[$k]['recommend']=(string)$goods['recommend'];
                    $date[$k]['pBuyType']=(string)$goods['price_status'];
                    $date[$k]['info']=(string)$goods['introduce'];
                    $date[$k]['pImgURL']=(string)URL.$goods['img'];
                    $class=M('class')->where(array('class_id'=>$goods['class_id']))->field('type,name')->find();
                    if($class['type']==3){
                        $date[$k]['isOrganization']='1';
                    }else{
                        $date[$k]['isOrganization']='0';
                    }
                    $date[$k]['teachername']=(string)$class['name'];
                    $date[$k]['signUpNum']=(string)$goods['number'];
                    $heard=strstr($_SERVER['HTTP_USER_AGENT'],'(',true);
                    if($heard=='TCCM_WYK/4.0.1 ' || $heard=='TCCM_WYK/4.0.1'){
                        $date[$k]['oldPrice']='0';
                        $date[$k]['currentPrice']='0';
                    }else{
                        $date[$k]['oldPrice']=(string)$goods['money'];      //原价
                        if($goods['price_status']==0){
                            $date[$k]['currentPrice']=(string)$goods['money']; //折扣价
                        }else{
                            $date[$k]['currentPrice']=(string)$goods['discount_money']; //折扣价
                        }
                    }
                    $date[$k]['groupBuyNum']=(string)$goods['group_num'];
                    $date[$k]['groupBuyEndTime']=(string)date('Y年m月d日 H:i:s',$goods['group_time']);



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

    //我的收藏-直播
    public function livebCollection(){
        if(IS_POST){
            $token=I('post.token');     //用户token
            $page=I('post.pageNum');    //页数
            if($token==''||$page==''){
                $this->templateApi('','204','参数错误');exit;
            }
            $userrel=M('user')->where(array('token'=>$token))->find();
            if($userrel){
                if($userrel['vip_endtime']<time()){
                    $dovip['is_vip']=0;
                    M('user')->where(array('user_id'=>$userrel['user_id']))->save($dovip);
                }
                $where['uid']=$userrel['user_id'];
                $where['type']=array('IN','1,6');
                $count=M('subscribe')->where($where)->count();
                $data=$this->havePage('subscribe',$where,'time desc',$page,'20','');
                $pie['now_page']=$data['now_page'];
                $pie['total_page']=$data['total_page'];
                unset($data['now_page']);
                unset($data['total_page']);
                foreach($data as $k=>$v){
                    $goods=M('goods')->where(array('goods_id'=>$v['cid']))->find();
                    $date[$k]['pid']=(string)$goods['goods_id'];
                    $date[$k]['pName']=(string)$goods['name'];
                    $date[$k]['openSaleTime']=(string)date('Y年m月d日 H:i:s',$goods['grounding_time']);
                    $date[$k]['pType']=(string)$goods['type'];
                    $date[$k]['pBuyType']=(string)$goods['price_status'];
                    $date[$k]['pImgURL']=(string)URL.$goods['img'];
                    $class=M('class')->where(array('class_id'=>$goods['class_id']))->field('type,uid,name')->find();
                    if($class['type']==3){
                        $date[$k]['isOrganization']='1';
                    }else{
                        $date[$k]['isOrganization']='0';
                    }
                    $date[$k]['teacherName']=(string)$class['name'];
                    $udrel=M('userdata')->where(array('uid'=>$class['uid']))->find();
                    $date[$k]['teacherImg']=(string)URL.$udrel['image'];
                    $date[$k]['signUpNum']=(string)$goods['number'];
                    $heard=strstr($_SERVER['HTTP_USER_AGENT'],'(',true);
                    if($heard=='TCCM_WYK/4.0.1 ' || $heard=='TCCM_WYK/4.0.1'){
                        $date[$k]['oldPrice']='0';
                        $date[$k]['currentPrice']='0';
                    }else{
                        $date[$k]['oldPrice']=(string)$goods['money'];      //原价
                        if($goods['price_status']==0){
                            $date[$k]['currentPrice']=(string)$goods['money']; //折扣价
                        }else{
                            $date[$k]['currentPrice']=(string)$goods['discount_money']; //折扣价
                        }
                    }
                    $date[$k]['liveStartTime']=(string)date('Y年m月d日 H:i:s',$goods['starttime']);
                    $date[$k]['liveTime']=(string)round(($goods['endtime']-$goods['starttime'])/60);
                    $date[$k]['endSaleTime']=(string)date('Y年m月d日 H:i:s',$goods['sign_endtime']);



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

    //我的店铺
    public function meshop(){
        if(IS_POST){
            $token=I('post.token');
            if($token==''){
                $this->templateApi('','204','参数错误');exit;
            }
            $userrel=M('user')->where(array('token'=>$token))->find();
            if($userrel){
                if($userrel['vip_endtime']<time()){
                    $dovip['is_vip']=0;
                    M('user')->where(array('user_id'=>$userrel['user_id']))->save($dovip);
                }
                $udrel=M('userdata')->where(array('uid'=>$userrel['user_id']))->find();
                $class=M('class')->where(array('uid'=>$userrel['user_id']))->find();
                if($class){
                    $data['sImgURL']=(string)URL.$class['img'];     //店铺头像
                    $data['sName']=(string)$class['name'];
                    $data['sLV']=(string)$class['grade'];
                    $data['phone']=$userrel['phone'];
                    $data['popularNum']=(string)$class['follow_num'];
                    $data['sInfo']=(string)$class['introduce'];
                    if($class['type']==3){
                        $data['isOrganization']='1';
                    }else{
                        $data['isOrganization']='0';
                    }
                    $this->templateApi($data,'200','ok');
                }else{
                    $this->templateApi('','202','你还没有店铺');
                }
            }else{
                $this->templateApi('','300','token过期');
            }
        }else{
            $this->templateApi('','203','请求类型错误');
        }
    }

    //累计上传视频数量
    public function videonum(){
        $token=I('post.token');
        if($token==''){
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
                $where['uid']=$user['user_id'];
                $where['status']=1;
                $goods=M('video')->where($where)->count();
                $data['now_num']=(string)$goods;
                $data['set_num']='30';
                $livebpower=M('livebpower')->where(array('uid'=>$user['user_id']))->find();
                if($livebpower['status']==1){
                    $data['power']='1';
                }else{
                    $data['power']='0';
                }
                $this->templateApi($data,'200','ok');
            }else{
                $this->templateApi('0','200','ok');
            }
        }else{
            $this->templateApi('','300','token过期');
        }
    }

    //自用上传视频数量
    public function videonum_s($token){
        $user=M('user')->where(array('token'=>$token))->find();
        $class=M('class')->where(array('uid'=>$user['user_id']))->find();
        $where['type']=array('IN','2,4');
        $wehre['class_id']=$class['class_id'];
        $where['astatus']=1;
        $where['del_status']=0;
        $goods=M('goods')->where($where)->count();
        return $goods;
    }

    //直播申请
    public function livebapply(){
        if(IS_POST){
            $token=I('post.token');
            if($token==''){
                $this->templateApi('','204','参数错误');exit;
            }
            $user=M('user')->where(array('token'=>$token))->find();
            if($user){
                if($user['vip_endtime']<time()){
                    $dovip['is_vip']=0;
                    M('user')->where(array('user_id'=>$user['user_id']))->save($dovip);
                }
                $livebapply=M('livebapply');
                $lprel=$livebapply->where(array('uid'=>$user['user_id']))->find();
                if($lprel){
                    if($lprel['status']==0){
                        $this->templateApi('','200','正在审核');exit;
                    }else if($lprel['status']==1){
                        $this->templateApi('','200','审核已通过');exit;
                    }else{

                    }
                }

                $videonum=$this->videonum_s($token);
                if($videonum>=30){
                    $bond=M('bond')->where(array('uid'=>$user['user_id'],'status'=>'1'))->find();
                    if($bond){
                        $mvp['uid']=$user['user_id'];
                        $rel=$livebapply->add($mvp);
                        if($rel){
                            $this->templateApi('','200','申请已提交');
                        }else{
                            $this->templateApi('','202','申请失败');
                        }
                    }else{
                        $this->templateApi('','202','请缴纳保证金');
                    }
                }else{
                    $this->templateApi('','202','您上传的视频数量还不够30');
                }
            }else{
                $this->templateApi('','300','token过期');
            }
        }else{
            $this->templateApi('','203','请求类型错误');
        }
    }

    //获取直播列表
    public function liveblist(){
        if(IS_POST){
            $token=I('post.token');     //用户token
            $type=I('post.type');       //类型   0：带直播    1：已播完   2：审核
            $page=I('post.pageNum');    //页数
            if($token==''||$type==''||$page==''){
                $this->templateApi('','204','参数错误');exit;
            }
            $user=M('user')->where(array('token'=>$token))->find();
            if($user){
                if($user['vip_endtime']<time()){
                    $dovip['is_vip']=0;
                    M('user')->where(array('user_id'=>$user['user_id']))->save($dovip);
                }
                $udrel=M('userdata')->where(array('uid'=>$user['user_id']))->find();
                $class=M('class')->where(array('uid'=>$user['user_id']))->find();
                if($class){
                    $where['class_id']=$class['class_id'];
                    if($type=='0'){
                        $where['starttime']=array('egt',time());
                    }else if($type=='1'){
                        $where['endtime']=array('elt',time());
                    }else if($type=='2'){
                        $where['astatus']=0;
                    }
                    $where['type']=array('IN','1,6');
                    $where['del_status']=0;
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
                        $date[$k]['teacherName']=(string)$class['name'];
                        $date[$k]['teacherImg']=(string)URL.$udrel['image'];
                        if($class['type']==3){
                            $date[$k]['isOrganization']='1';
                        }else{
                            $date[$k]['isOrganization']='0';
                        }
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
                        $date[$k]['liveTime']=(string)round(($v['endtime']-$v['starttime'])/60);
                        $date[$k]['endSaleTime']=(string)date('Y年m月d日 H:i:s',$v['sign_endtime']);
                    }
                    if(empty($date)){
                        $rel['data']=array();
                    }else{
                        $rel['data']=$date;
                    }
                    $rel['now_page']=$pie['now_page'];
                    $rel['total_page']=$pie['total_page'];
                    $this->templateApi($rel,'200','ok');
                }else{
                    $this->templateApi('','202','还没有成为老师');
                }
            }else{
                $this->templateApi('','300','token过期');
            }
        }else{
            $this->templateApi('','203','请求类型错误');
        }
    }

    //视频列表
    public function videolist(){
        if(IS_POST){
            $token=I('post.token');     //用户token
            $type=I('post.pType');      //类型   0审核通过   1：审核中
            $page=I('post.pageNum');    //页数
            if($token==''||$type==''||$page==''){
                $this->templateApi('','204','参数错误');exit;
            }
            $user=M('user')->where(array('token'=>$token))->find();
            if($user){
                $where['uid']=$user['user_id'];
                if($type=='0'){
                    $where['status']=1;
                }else{
                    $where['status']=array('IN','0,2');
                }
                $count=M('video')->where($where)->count();
                $data=$this->havePage('video',$where,'time desc',$page,'20','');
                $pie['now_page']=$data['now_page'];
                $pie['total_page']=$data['total_page'];
                unset($data['now_page']);
                unset($data['total_page']);
                foreach($data as $k=>$v){
                    $date[$k]['pId']=(string)$v['video_id'];
                    $date[$k]['pImgURL']=(string)URL.$v['img'];
                    $date[$k]['pName']=(string)$v['name'];
                    $date[$k]['viewType']=(string)$v['status'];
                    $date[$k]['videoId']=$v['fileid'];
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

    //可用视频列表
    public function usevideo(){
        if(IS_POST){
            $token=I('post.token');     //用户token
            $page=I('post.pageNum');    //页数
            if($token==''||$page==''){
                $this->templateApi('','204','参数错误');exit;
            }
            $user=M('user')->where(array('token'=>$token))->find();
            if($user){
                $where['uid']=$user['user_id'];
                $where['upstatus']=0;
                $data=$this->havePage('video',$where,'time desc',$page,'20','');
                $pie['now_page']=$data['now_page'];
                $pie['total_page']=$data['total_page'];
                unset($data['now_page']);
                unset($data['total_page']);
                foreach($data as $k=>$v){
                    $date[$k]['pId']=(string)$v['video_id'];
                    $date[$k]['pImgURL']=(string)URL.$v['img'];
                    $date[$k]['pName']=(string)$v['name'];
                    $date[$k]['fileid']=$v['fileid'];
                    $date[$k]['viewType']=(string)$v['status'];
                }
                if(empty($date)){
                    $rel['data']=array();
                }else{
                    $rel['data']=$date;
                }
                $rel['now_page']=$pie['now_page'];
                $rel['total_page']=$pie['total_page'];
                $this->templateApi($rel,'200','ok');


            }else{
                $this->templateApi('','300','token过期');
            }
        }else{
            $this->templateApi('','203','请求类型错误');
        }
    }

    //删除视频
    public function delvideo(){
        if(IS_POST){
            $token=I('post.token');     //用户token
            $pid=I('post.pid');
            if($token==''||$pid==''){
                $this->templateApi('','204','参数错误');exit;
            }
            $user=M('user')->where(array('token'=>$token))->find();
            if($user){
                M('video')->where(array('video_id'=>$pid))->delete();
                $this->templateApi($rel,'200','ok');

            }else{
                $this->templateApi('','300','token过期');
            }
        }else{
            $this->templateApi('','203','请求类型错误');
        }
    }

    //我的账户
    public function account(){
        if(IS_POST){
            $token=I('post.token');
            if($token==''){
                $this->templateApi('','204','参数错误');exit;
            }
            $user=M('user')->where(array('token'=>$token))->find();
            if($user){
                $userdata=M('userdata')->where(array('uid'=>$user['user_id']))->find();
                $data['ykbBalance']=(string)$userdata['money'];
                if(empty($userdata['paypass'])){
                    $data['payPasswordStatus']='0';
                }else{
                    $data['payPasswordStatus']='1';
                }
                $class=M('class')->where(array('uid'=>$user['user_id']))->find();
                if($class){
                    $data['profit']=(string)$class['profit'];
                }else{
                    $data['profit']='0';
                }
                $this->templateApi($data,'200','ok');
            }else{
                $this->templateApi('','300','token过期');
            }
        }else{
            $this->templateApi('','203','请求类型错误');
        }
    }

    //个人中心收益明细
    public function profit(){
        if(IS_POST){
            $token=I('post.token');
            $type=I('post.type');      //类型   0：充值记录   1：系统收入   2：消费记录
            $page=I('post.pageNum');    //页数
            if($token==''||$type==''){
                $this->templateApi('','204','参数错误');exit;
            }
            $user=M('user')->where(array('token'=>$token))->find();
            if($user){
                $where['uid']=$user['user_id'];
                if($type=='0'){
                    $where['ptype']=0;
                }else if($type=='1'){
                    $where['ptype']=1;
                }else if($type=='2'){
                    $where['ptype']=2;
                    $where['type']=2;
                }else{
                    $where['ptype']=0;
                }
                $count=M('payrecord')->where($where)->count();
                $data=$this->havePage('payrecord',$where,'time desc',$page,'20','');
                $pie['now_page']=$data['now_page'];
                $pie['total_page']=$data['total_page'];
                unset($data['now_page']);
                unset($data['total_page']);
                foreach($data as $k=>$v){
                    $date[$k]['title']=(string)$v['source'];
                    $date[$k]['time']=(string)date('Y年m月d日 H:i:s',$v['time']);
                    if($type=='0'){
                        $date[$k]['amount']=(string)$v['income'];
                    }else if($type=='1'){
                        $date[$k]['amount']=(string)$v['income'];
                    }else if($type=='2'){
                        $date[$k]['amount']=(string)$v['pay'];
                    }else{
                        $date[$k]['amount']=(string)$v['income'];
                    }
                    $date[$k]['type']=$v['type'];

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

    //修改所有个人资料
    public function editall(){
        if(IS_POST){
            $sex=I('post.sex');
            $bir=I('post.birthday');
            $image=I('post.image');
            $token=I('post.token');
            if($sex==''||$bir==''||$image==''||$token==''){
                $this->templateApi('','204','参数错误');exit;
            }
            $user=M('user')->where(array('token'=>$token))->find();
            if($user){
                $mvp['sex']=$sex;
                $mvp['birthday']=$bir;
                $mvp['image']=$image;
                $edrel=M('userdata')->where(array('uid'=>$user['user_id']))->save($mvp);
                $udrel=M('userdata')->where(array('uid'=>$user['user_id']))->find();
                if($edrel!==false){
                    $date['uImgURL']=(string)URL.$image;
                    $date['uName']=(string)$user['name'];
                    $date['uInfo']=(string)$udrel['profile'];
                    $sign=M('sign');
                    $signrel=$sign->where('uid='.$user['user_id'])->find();
                    $start_time = strtotime(date('Y-m-d'));
                    if($signrel['time']>$start_time){
                        $date['isSignIn']='0';   //已签到
                    }else{
                        $date['isSignIn']='1';   //未签到
                    }
                    $date['sex']=(string)$sex;
                    $date['address']=(string)$udrel['address'];
                    $date['birthday']=(string)$bir;
                    $date['link']=(string)'http://www.baidu.com?intivi='.$user['phone'];
                    $follow=M('follow')->where(array('uid'=>$user['user_id']))->count();
                    $date['followNum']=(string)$follow;
                    $date['integral']=(string)$udrel['integral'];
                    $date['ykbBalance']=(string)$udrel['money'];
                    $date['phone']=(string)$user['phone'];
                    $date['token']=(string)$token;
                    $this->templateApi($date,'200','ok');
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

    //我的课程——视频
    public function myclass_video(){
        if(IS_POST){
            $token=I('post.token');
            $page=I('post.pageNum');
            if($token==''||$page==''){
                $this->templateApi('','204','参数错误');exit;
            }
            $user=M('user')->where(array('token'=>$token))->find();
            if($user){
                $where['uid']=$user['user_id'];
                $where['type']=2;
                $where['ptype']=2;
                $where['ctype']=array('IN','2,3');
                $count=M('payrecord')->where($where)->count();
                $data=$this->havePage('payrecord',$where,'time desc',$page,'20','');
                $pie['now_page']=$data['now_page'];
                $pie['total_page']=$data['total_page'];
                unset($data['now_page']);
                unset($data['total_page']);
                foreach($data as $k=>$v){
                    $good=M('goods')->where(array('goods_id'=>$v['cid']))->find();
                    $date[$k]['pImgURL']=(string)URL.$good['img'];  //封面
                    $date[$k]['pName']=(string)$good['name'];    //名
                    $date[$k]['pid']=(string)$good['goods_id']; //课程id
                    $date[$k]['pType']=(string)$good['type'];    //课程类型
                    $date[$k]['introduce']=(string)$good['introduce'];
                    $date[$k]['recommend']=(string)$good['recommend'];      //是否推荐
                    $date[$k]['money']=(string)$v['pay'];     //价格
                    $date[$k]['groundingTime']=(string)date('Y年m月d日 H:i:s',$good['grounding_time']);//上架时间
                    $date[$k]['classhour']=(string)$good['classhour'];  //课时
                    $class=M('class')->where(array('class_id'=>$good['class_id']))->find();
                    $date[$k]['teacherName']=(string)$class['name'];    //讲师姓名
                    $date[$k]['signUpNum']=(string)$good['number'];
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
                $this->templateApi('','300','未登录');
            }
        }else{
            $this->templateApi('','203','请求类型错误');
        }
    }

    //我的课程——直播
    public function myclass_liveb(){
        if(IS_POST){
            $token=I('post.token');
            $page=I('post.pageNum');
            if($token==''||$page==''){
                $this->templateApi('','204','参数错误');exit;
            }
            $user=M('user')->where(array('token'=>$token))->find();
            if($user){
                $where['uid']=$user['user_id'];
                $where['type']=2;
                $where['ptype']=2;
                $where['ctype']=array('IN','1,6');
                $count=M('payrecord')->where($where)->count();
                $data=$this->havePage('payrecord',$where,'time desc',$page,'20','');
                $pie['now_page']=$data['now_page'];
                $pie['total_page']=$data['total_page'];
                unset($data['now_page']);
                unset($data['total_page']);
                foreach($data as $k=>$v){
                    $good=M('goods')->where(array('goods_id'=>$v['cid']))->find();
                    $date[$k]['pImgURL']=(string)URL.$good['img'];  //封面
                    $date[$k]['pName']=(string)$good['name'];    //名
                    $date[$k]['pid']=(string)$good['goods_id']; //课程id
                    $date[$k]['pType']=(string)$good['type'];    //课程类型
                    if($good['starttime']>(time()+300) && $good['endtime']>time()){
                        $date[$k]['canliveb']='1';
                    }else{
                        $date[$k]['canliveb']='0';
                    }
                    $date[$k]['money']=(string)$v['pay'];     //价格
                    $date[$k]['livebStatus']=(string)$good['liveb_status']; //直播状态
                    $class=M('class')->where(array('class_id'=>$good['class_id']))->field('name,uid,class_id')->find();
                    $date[$k]['sid']=(string)$class['class_id'];    // 店铺id
                    $date[$k]['teacherName']=(string)$class['name'];    //讲师姓名
                    $udrel=M('userdata')->where(array('uid'=>$class['uid']))->field('image')->find();
                    $date[$k]['teacherImg']=(string)URL.$udrel['image'];
                    $date[$k]['liveStartTime']=(string)date('Y年m月d日 H:i:s',$good['starttime']);
                    $date[$k]['liveTime']=(string)round(($good['endtime']-$good['starttime'])/60);
                    $date[$k]['endSaleTime']=(string)date('Y年m月d日 H:i:s',$good['sign_endtime']);
                    $date[$k]['signUpNum']=(string)$good['number'];
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
                $this->templateApi('','300','未登录');
            }
        }else{
            $this->templateApi('','203','请求类型错误');
        }
    }

    //我的课程——预约课
    public function myclass_yue(){
        if(IS_POST){
            $token=I('post.token');
            $page=I('post.pageNum');
            if($token==''||$page==''){
                $this->templateApi('','204','参数错误');exit;
            }
            $user=M('user')->where(array('token'=>$token))->find();
            if($user){
                $where['uid']=$user['user_id'];
                $where['type']=2;
                $where['ptype']=2;
                $where['ctype']=5;
                $count=M('payrecord')->where($where)->count();
                $data=$this->havePage('payrecord',$where,'time desc',$page,'20','');
                $pie['now_page']=$data['now_page'];
                $pie['total_page']=$data['total_page'];
                unset($data['now_page']);
                unset($data['total_page']);
                foreach($data as $k=>$v){
                    $good=M('goods')->where(array('goods_id'=>$v['cid']))->find();
                    if(($good['starttime']-300)<time() && $good['endtime']>time() && $good['reg_status']==1 && $good['number']!=0){
                        $date[$k]['canliveb']='1';
                    }else{
                        $date[$k]['canliveb']='0';
                    }

                    $date[$k]['pid']=(string)$good['goods_id']; //课程id
                    $date[$k]['pType']=(string)$good['type'];    //课程类型
                    $date[$k]['money']=(string)$v['pay'];     //价格
                    $class=M('class')->where(array('class_id'=>$good['class_id']))->field('name,uid')->find();
                    if($class['type']==3){
                        $date[$k]['isOrganization']='1';
                    }else{
                        $date[$k]['isOrganization']='0';
                    }
                    $tuser=M('user')->where(array('user_id'=>$class['uid']))->find();
                    $date[$k]['teacherName']=(string)$tuser['name'];    //讲师姓名
                    $udrel=M('userdata')->where(array('uid'=>$class['uid']))->field('image')->find();
                    $date[$k]['teacherImgURL']=(string)URL.$udrel['image'];
                    $date[$k]['startTime']=(string)date('Y年m月d日 H:i:s',$good['starttime']);
                    $date[$k]['endTime']=(string)date('H:i:s',$good['endtime']);
                    $cate=M('category');
                    $fcate=$cate->where(array('cate_id'=>$good['cate_id']))->find();
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
                $this->templateApi('','300','未登录');
            }
        }else{
            $this->templateApi('','203','请求类型错误');
        }
    }

    //查询直播权限
    public function selliveb(){
        if(IS_POST){
            $token=I('post.token');
            if($token==''){
                $this->templateApi('','204','参数错误');exit;
            }
            $user=M('user')->where(array('token'=>$token))->find();
            if($user){
                $livebapply=M('livebapply')->where(array('uid'=>$user['user_id']))->find();
                if(!$livebapply){
                    $data['status']='0';  //未提交
                }else if($livebapply['status']===0){
                    $data['status']='1';   //待审核
                }else if($livebapply['status']==1){
                    $data['status']='2';    //通过
                }else{
                    $data['status']='3';    //拒绝
                }
                $this->templateApi($data,'200','ok');
            }else{
                $this->templateApi('','300','未登录');
            }
        }else{
            $this->templateApi('','203','请求类型错误');
        }
    }

    //课程上架
    public function goodsup(){
        if(IS_POST){
            $token=I('post.token');
            $pid=I('post.pid');
            if($token==''||$pid==''){
                $this->templateApi('','204','参数错误');exit;
            }
            $user=M('user')->where(array('token'=>$token))->find();
            if($user){
                $good=M('goods')->where(array('goods_id'=>$pid))->find();
                if($good['astatus']!=1){
                    $this->templateApi('','202','该课程还没有审核通过');
                }else{
                    if($good['type']==3){
                        $count=M('goods')->where(array('topic_id'=>$good['goods_id']))->count();
                        if($count<$good['classhour']){
                            $this->templateApi('','202','套课未完结，禁止上架');exit;
                        }
                    }
                    $video=M('video');
                    if($good['type']==2) {
                        $vm['upstatus'] = 1;
                        $video->where(array('video_id' => $good['video_id']))->save($vm);
                    }
                    $mvp['status']=0;
                    $mvp['grounding_time']=time();
                    M('goods')->where(array('goods_id'=>$pid))->save($mvp);
                    $this->templateApi('','200','ok');
                }
            }else{
                $this->templateApi('','300','未登录');
            }
        }else{
            $this->templateApi('','203','请求类型错误');
        }
    }

    //课程下架
    public function goodsdown(){
        if(IS_POST){
            $token=I('post.token');
            $pid=I('post.pid');
            if($token==''||$pid==''){
                $this->templateApi('','204','参数错误');exit;
            }
            $user=M('user')->where(array('token'=>$token))->find();
            if($user){
                $good=M('goods')->where(array('goods_id'=>$pid))->find();
                $video=M('video');
                if($good['type']==2) {
                    $vm['upstatus'] = 0;
                    $video->where(array('video_id' => $good['video_id']))->save($vm);
                }else if($good['type']==3){
                    $vm['upstatus'] = 0;
                    $id='';
                    $goodrel=M('goods')->where(array('topic_id'=>$good['goods_id']))->field('video_id')->select();
                    foreach($goodrel as $k=>$v){
                        $id.=$v['video_id'].',';
                    }
                    $newid=substr($id,0,strlen($id)-1);
                    $where['video_id']=array('IN',$newid);
                    $video->where($where)->save($vm);

                }

                $mvp['status']=1;
                $mvp['lower_time']=time();
                M('goods')->where(array('goods_id'=>$pid))->save($mvp);
                $this->templateApi('','200','ok');

            }else{
                $this->templateApi('','300','未登录');
            }
        }else{
            $this->templateApi('','203','请求类型错误');
        }
    }

    //店铺编辑
    public function editmeshop(){
        if(IS_POST){
            $token=I('post.token');
            $img=I('post.img');
            $name=I('post.name');
            $introduce=I('post.introduce');
            if($token==''){
                $this->templateApi('','204','参数错误');exit;
            }
            $user=M('user')->where(array('token'=>$token))->find();
            if($user){
                $class=M('class');
                $classrel=$class->where(array('uid'=>$user['user_id']))->find();
                if($classrel){
                    if($img){
                        $mvp['img']=$img;
                    }
                    if($name){
                        $mvp['name']=$name;
                    }
                    if($introduce){
                        $mvp['introduce']=$introduce;
                    }
                    $class->where(array('class_id'=>$classrel['class_id']))->save($mvp);
                    $this->templateApi('','200','ok');
                }else{
                    $this->templateApi('','202','您还没有店铺');
                }
            }else{
                $this->templateApi('','300','未登录');
            }
        }else{
            $this->templateApi('','203','请求类型错误');
        }
    }

    //预约直播列表
    public function yuelist(){
        if(IS_POST){
            $token=I('post.token');
            $queryTime=I('post.queryTime'); //查询时间
            if($token==''||$queryTime==''){
                $this->templateApi('','204','参数错误');exit;
            }
            $user=M('user')->where(array('token'=>$token))->find();
            if($user){
                $class=M('class')->where(array('uid'=>$user['user_id']))->find();
                if($class){
                    $where['class_id']=$class['class_id'];
                    $where['starttime']=array('egt',$queryTime);
                    $where['type']=5;
                    $where['endtime']=array('lt',$queryTime+86400);
                    $where['del_status']=0;
                    $data=M('goods')->where($where)->select();
                    foreach($data as $k=>$v){
                        $date[$k]['pId']=(string)$v['goods_id'];
                        $date[$k]['teacherName']=(string)$user['name'];
                        $udrel=M('userdata')->where(array('uid'=>$class['uid']))->find();
                        $date[$k]['teacherImgURL']=URL.$udrel['image'];
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
                        $date[$k]['className']=(string)$cate2['name'].'|'.$cate1['name'].'|'.$cate['name'];
                        $udrel=M('userdata')->where(array('uid'=>$user['user_id']))->find();
                        $date[$k]['imgURL']=(string)URL.$udrel['image'];
                        $date[$k]['startTime']=(string)date('Y年m月d日 H:i:s',$v['starttime']);
                        $date[$k]['classvi']=date('H',$v['starttime'])+1;
                        $date[$k]['endTime']=(string)date('H:i:s',$v['endtime']);
                        $date[$k]['pPrice']=(string)$v['money'];
                        if($v['reg_status']==1){
                            $date[$k]['isSaled']='1';
                        }else{
                            $date[$k]['isSaled']='0';
                        }
                        if(($v['starttime']-300)<time() && $v['endtime']>time() && $v['reg_status']==1){
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

    //创建预约
    public function addyueliveb(){
        if(IS_POST){
            $token=I('post.token');
            $cateid=I('post.cateid');
            $time=I('post.time');       //当天0点时间戳
            $classvi=I('post.classvi'); //课节
            $money=I('post.money');
            if($token==''||$cateid==''||$time==''||$classvi==''||$money==''){
                $this->templateApi('','204','参数错误');exit;
            }
            if($money<5){
                $this->templateApi('','202','价格不能小于5元');exit;
            }
            $user=M('user')->where(array('token'=>$token))->find();
            if($user){
                $class=M('class')->where(array('uid'=>$user['user_id']))->find();
                if($class){
                    if($class['grade']!=1){
                        $this->templateApi('','302','您还没有直播权限');exit;
                    }
                    $starttime=$time+(($classvi-1)*3600);
                    $endtime=$starttime+2700;
                    $good=M('goods');
                    $between=array(array('egt',$starttime),array('elt',$endtime));
                    $where['starttime']=$between;
                    $where['type']=array('IN','1,5,6');
                    $where['del_status']=0;
                    $where['teacher_id']=$class['class_id'];
                    $goodrel=$good->where($where)->find();
                    if($goodrel){
                        $this->templateApi('','202','您在这个时间还有一场直播');exit;
                    }
                    if($class['o_id']){
                        $mvp['class_id']=$class['o_id'];
                    }else{
                        $mvp['class_id']=$class['class_id'];
                    }
                    $mvp['teacher_id']=$class['class_id'];
                    $mvp['cate_id']=$cateid;
                    $mvp['money']=$money;
                    $mvp['type']=5;
                    $mvp['astatus']=1;
                    $mvp['status']=0;
                    $mvp['time']=time();
                    $mvp['starttime']=$starttime;
                    $mvp['endtime']=$endtime;
                    $result=$good->add($mvp);
                    $shareurl['shareurl']='http://www.wyueke.com/html/student_singleLessonDetail.html?pid='.$result;
                    $good->where(array('goods_id'=>$result))->save($shareurl);
                    $mmp['order_status']=1;
                    M('class')->where(array('class_id'=>$class['class_id']))->save($mmp);
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

    //编辑预约
    public function edityueliveb(){
        if(IS_POST){
            $token=I('post.token');
            $cateid=I('post.cateid');
            $classvi=I('post.classvi'); //课节
            $money=I('post.money');
            $pid=I('post.pid');
            if($token==''||$cateid==''||$classvi==''||$money==''||$pid==''){
                $this->templateApi('','204','参数错误');exit;
            }
            $user=M('user')->where(array('token'=>$token))->find();
            if($user){
                $class=M('class')->where(array('uid'=>$user['user_id']))->find();
                if($class){
                    $good=M('goods');
                    $goodsrel=$good->where(array('goods_id'=>$pid))->find();
                    if($goodrel['reg_status']==1){
                        $this->templateApi('','202','课程已被购买，禁止修改');exit;
                    }
                    $today = date('Y-m-d',$goodsrel['starttime']);
                    $time=strtotime($today);
                    $starttime=$time+(($classvi-1)*3600);
                    $endtime=$starttime+2700;
                    if($goodsrel['starttime']==$starttime){

                    }else{
                        $between=array(array('egt',$starttime),array('elt',$endtime));
                        $where['starttime']=$between;
                        $where['type']=array('IN','1,5,6');
                        $where['del_status']=0;
                        $goodrel=$good->where($where)->find();
                        if($goodrel){
                            $this->templateApi('','202','您在这个时间还有一场直播');exit;
                        }
                    }

                    $mvp['cate_id']=$cateid;
                    $mvp['money']=$money;
                    $mvp['starttime']=$starttime;
                    $mvp['endtime']=$endtime;
                    $good->where(array('goods_id'=>$pid))->save($mvp);
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

    //单课列表
    public function oneclass(){
        if(IS_POST){
            $token=I('post.token');
            $type=I('post.type');
            $page=I('post.pageNum');
            if($token==''||$type==''||$page==''){
                $this->templateApi('','204','参数错误');exit;
            }
            $user=M('user')->where(array('token'=>$token))->find();
            if($user){
                $class=M('class')->where(array('uid'=>$user['user_id']))->find();
                if($class){
                    $where['class_id']=$class['class_id'];
                    $where['type']=2;
                    if($type==0){
                        $where['status']=2;
                    }else if($type==1){
                        $where['status']=0;
                    }else{
                        $where['status']=1;
                    }
                    $where['del_status']=0;
                    $count=M('goods')->where($where)->count();
                    $data=$this->havePage('goods',$where,'grounding_time desc',$page,'20','');
                    $pie['now_page']=$data['now_page'];
                    $pie['total_page']=$data['total_page'];
                    unset($data['now_page']);
                    unset($data['total_page']);
                    foreach($data as $k=>$v){
                        $date[$k]['pid']=(string)$v['goods_id'];
                        $date[$k]['pName']=$v['name'];
                        $date[$k]['pImgURL']=(string)URL.$v['img'];
                        $date[$k]['pType']=(string)$v['type'];
                        $date[$k]['introduce']=$v['introduce'];
                        $date[$k]['status']=(string)$v['status'];
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
                        $date[$k]['isRecommend']=(string)$v['recommend'];
//                        $udrel=M('userdata')->where(array('uid'=>$user['user_id']))->find();
                        $date[$k]['teacherName']=$user['name'];
                        $date[$k]['openSaleTime']=(string)date('Y年m月d日 H:i:s',$v['grounding_time']);
                        $date[$k]['closeSaleTime']=(string)date('Y年m月d日 H:i:s',$v['lower_time']);
                        $date[$k]['signUpNum']=(string)$v['number'];
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
                    $this->templateApi('','202','您还没有课堂');
                }

            }else{
                $this->templateApi('','300','未登录');
            }
        }else{
            $this->templateApi('','203','请求类型错误');
        }
    }

    //创建单课
    public function addoneclass(){
        if(IS_POST){
            $token=I('post.token');
            $title=I('post.title'); //标题
            $introduce=I('post.introduce'); //介绍
            $cateid=I('post.cateid');   //分类id
            $money=I('post.money');
            $pBuyType=I('post.pBuyType');
            $discount_money=I('post.discount_money');
            $groupnum=I('post.groupnum');   //团购人数
            $grouptime=I('post.grouptime'); //开团时间
            $videoid=I('post.videoid'); //视频id
            $vip=I('post.vip');     //vip专享
            if($token==''||$title==''||$introduce==''||$cateid==''||$money==''||$pBuyType==''||$videoid==''){
                $this->templateApi('','204','参数错误');exit;
            }
            $user=M('user')->where(array('token'=>$token))->find();
            if($user){
                $class=M('class')->where(array('uid'=>$user['user_id']))->find();
                if($class){
                    $video=M('video')->where(array('video_id'=>$videoid))->find();
                    if($video['status']!=1){
                        $this->templateApi('','202','视频审核没通过');exit;
                    }
                    if($video['upstatus']==1){
                        $this->templateApi('','202','视频已经上架');exit;
                    }
                    $mvp['img']=$video['img'];
                    $mvp['name']=$title;
                    $mvp['introduce']=$introduce;
                    if($class['o_id']){
                        $mvp['class_id']=$class['o_id'];
                    }else{
                        $mvp['class_id']=$class['class_id'];
                    }
                    $mvp['teacher_id']=$class['class_id'];
                    $mvp['cate_id']=$cateid;
                    $mvp['money']=$money;
                    $mvp['price_status']=$pBuyType;
                    if($vip=='1'){
                        $mvp['vip']=1;
                    }else{

                    }
                    if(!$discount_money){

                    }else{
                        $mvp['discount_money']=$discount_money;
                    }
                    $mvp['group_num']=$groupnum;
                    $mvp['group_time']=$grouptime;
                    $mvp['type']=2;
                    $mvp['time']=time();
                    $mvp['astatus']=1;
                    $mvp['status']=2;
                    $mvp['video_file_id']=$video['fileid'];
                    $mvp['video_length']=$video['length'];
                    $mvp['video_id']=$video['video_id'];
                    $result=M('goods')->add($mvp);
                    $shareurl['shareurl']='http://www.wyueke.com/html/student_singleLessonDetail.html?pid='.$result;
                    M('goods')->where(array('goods_id'=>$result))->save($shareurl);
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

    //编辑单课
    public function editoneclass(){
        if(IS_POST){
            $token=I('post.token');
            $pid=I('post.pid');
            $title=I('post.title'); //标题
            $introduce=I('post.introduce'); //介绍
            $cateid=I('post.cateid');   //分类id
            $money=I('post.money');
            $pBuyType=I('post.pBuyType');
            $discount_money=I('post.discount_money');
            $groupnum=I('post.groupnum');   //团购人数
            $grouptime=I('post.grouptime'); //开团时间
            if($token==''||$title==''||$introduce==''||$cateid==''||$money==''||$pBuyType==''||$pid==''){
                $this->templateApi('','204','参数错误');exit;
            }
            $user=M('user')->where(array('token'=>$token))->find();
            if($user){
                $class=M('class')->where(array('uid'=>$user['user_id']))->find();
                if($class){
                    $good=M('goods')->where(array('goods_id'=>$pid))->find();
                    if($good['status']==0 && $good['number']!=0){
                        $this->templateApi('','202','课程已被购买，禁止修改');exit;
                    }
                    $video=M('video')->where(array('video_id'=>$videoid))->find();
                    $mvp['name']=$title;
                    $mvp['introduce']=$introduce;
                    $mvp['cate_id']=$cateid;
                    $mvp['money']=$money;
                    $mvp['status']=$good['status'];
                    $mvp['price_status']=$pBuyType;
                    $mvp['discount_money']=$discount_money;
                    $mvp['group_num']=$groupnum;
                    $mvp['group_time']=$grouptime;
                    M('goods')->where(array('goods_id'=>$pid))->save($mvp);
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

    //今天起未来8天的预约课--学生
    public function nextyuelists(){
        if(IS_POST){
//            $token=I('post.token');
            $sid=I('post.sid');
            if($sid==''){
                $this->templateApi('','204','参数错误');exit;
            }

//            $user=M('user')->where(array('token'=>$token))->find();
            $class=M('class')->where(array('class_id'=>$sid))->find();
            if($class){
                $today = date('Y-m-d',time());
                $time1=strtotime($today);   //今天0点的时间戳
                $endtime1=$time1+86399;     //今天23:59点的时间戳
                $time2=$time1+86400;        //第二天0点时间戳
                $endtime2=$time2+86399;     //第二天23:59点的时间戳
                $time3=$time2+86400;        //第三天0点
                $endtime3=$time3+86399;     //第三天23:59
                $time4=$time3+86400;        //第四天0点
                $endtime4=$time4+86399;     //第四天23:59
                $time5=$time4+86400;        //第五天0点
                $endtime5=$time5+86399;     //第五天23:59
                $time6=$time5+86400;        //第六天0点
                $endtime6=$time6+86399;     //第六天23:59
                $time7=$time6+86400;        //第七天0点
                $endtime7=$time7+86399;     //第七天23:59
                $time8=$time7+86400;        //第八天0点
                $endtime8=$time8+86399;     //第八天23:59
                $good=M('goods');
                $data=array();
                $where1['class_id']=$class['class_id'];
                $where1['del_status']=0;
                $where1['status']=0;
                $where1['type']=5;
                $where1['starttime']=array('egt',$time1);
                $where1['endtime']=array('lt',$endtime1);
                $one=$good->where($where1)->find();
                if($one){
                    $data[0]='1';
                }else{
                    $data[0]='0';
                }
                $where2['class_id']=$class['class_id'];
                $where2['del_status']=0;
                $where2['status']=0;
                $where2['type']=5;
                $where2['starttime']=array('egt',$time2);
                $where2['endtime']=array('lt',$endtime2);
                $two=$good->where($where2)->find();
                if($two){
                    $data[1]='1';
                }else{
                    $data[1]='0';
                }
                $where3['class_id']=$class['class_id'];
                $where3['del_status']=0;
                $where3['status']=0;
                $where3['type']=5;
                $where3['starttime']=array('egt',$time3);
                $where3['endtime']=array('lt',$endtime3);
                $three=$good->where($where3)->find();
                if($three){
                    $data[2]='1';
                }else{
                    $data[2]='0';
                }
                $where4['class_id']=$class['class_id'];
                $where4['del_status']=0;
                $where4['status']=0;
                $where4['type']=5;
                $where4['starttime']=array('egt',$time4);
                $where4['endtime']=array('lt',$endtime4);
                $four=$good->where($where4)->find();
                if($four){
                    $data[3]='1';
                }else{
                    $data[3]='0';
                }
                $where5['class_id']=$class['class_id'];
                $where5['del_status']=0;
                $where5['status']=0;
                $where5['type']=5;
                $where5['starttime']=array('egt',$time5);
                $where5['endtime']=array('lt',$endtime5);
                $five=$good->where($where5)->find();
                if($five){
                    $data[4]='1';
                }else{
                    $data[4]='0';
                }
                $where6['class_id']=$class['class_id'];
                $where6['del_status']=0;
                $where6['status']=0;
                $where6['type']=5;
                $where6['starttime']=array('egt',$time6);
                $where6['endtime']=array('lt',$endtime6);
                $six=$good->where($where6)->find();
                if($six){
                    $data[5]='1';
                }else{
                    $data[5]='0';
                }
                $where7['class_id']=$class['class_id'];
                $where7['del_status']=0;
                $where7['status']=0;
                $where7['type']=5;
                $where7['starttime']=array('egt',$time7);
                $where7['endtime']=array('lt',$endtime7);
                $seven=$good->where($where7)->find();
                if($seven){
                    $data[6]='1';
                }else{
                    $data[6]='0';
                }
                $where8['class_id']=$class['class_id'];
                $where8['del_status']=0;
                $where8['status']=0;
                $where8['type']=5;
                $where8['starttime']=array('egt',$time8);
                $where8['endtime']=array('lt',$endtime8);
                $eight=$good->where($where8)->find();
                if($eight){
                    $data[7]='1';
                }else{
                    $data[7]='0';
                }
                $this->templateApi($data,'200','ok');
            }else{
                $this->templateApi('','202','店铺信息错误');
            }

        }else{
            $this->templateApi('','203','请求类型错误');
        }
    }

    //今天起未来8天的预约课--老师
    public function nextyuelist(){
        if(IS_POST){
            $token=I('post.token');
            if($token==''){
                $this->templateApi('','204','参数错误');exit;
            }

            $user=M('user')->where(array('token'=>$token))->find();
            $class=M('class')->where(array('uid'=>$user['user_id']))->find();
            if($class){
                $today = date('Y-m-d',time());
                $time1=strtotime($today);   //今天0点的时间戳
                $endtime1=$time1+86399;     //今天23:59点的时间戳
                $time2=$time1+86400;        //第二天0点时间戳
                $endtime2=$time2+86399;     //第二天23:59点的时间戳
                $time3=$time2+86400;        //第三天0点
                $endtime3=$time3+86399;     //第三天23:59
                $time4=$time3+86400;        //第四天0点
                $endtime4=$time4+86399;     //第四天23:59
                $time5=$time4+86400;        //第五天0点
                $endtime5=$time5+86399;     //第五天23:59
                $time6=$time5+86400;        //第六天0点
                $endtime6=$time6+86399;     //第六天23:59
                $time7=$time6+86400;        //第七天0点
                $endtime7=$time7+86399;     //第七天23:59
                $time8=$time7+86400;        //第八天0点
                $endtime8=$time8+86399;     //第八天23:59
                $good=M('goods');
                $data=array();
                $where1['class_id']=$class['class_id'];
                $where1['del_status']=0;
                $where1['type']=5;
                $where1['starttime']=array('egt',$time1);
                $where1['endtime']=array('lt',$endtime1);
                $one=$good->where($where1)->find();
                if($one){
                    $data[0]='1';
                }else{
                    $data[0]='0';
                }
                $where2['class_id']=$class['class_id'];
                $where2['del_status']=0;
                $where2['type']=5;
                $where2['starttime']=array('egt',$time2);
                $where2['endtime']=array('lt',$endtime2);
                $two=$good->where($where2)->find();
                if($two){
                    $data[1]='1';
                }else{
                    $data[1]='0';
                }
                $where3['class_id']=$class['class_id'];
                $where3['del_status']=0;
                $where3['type']=5;
                $where3['starttime']=array('egt',$time3);
                $where3['endtime']=array('lt',$endtime3);
                $three=$good->where($where3)->find();
                if($three){
                    $data[2]='1';
                }else{
                    $data[2]='0';
                }
                $where4['class_id']=$class['class_id'];
                $where4['del_status']=0;
                $where4['type']=5;
                $where4['starttime']=array('egt',$time4);
                $where4['endtime']=array('lt',$endtime4);
                $four=$good->where($where4)->find();
                if($four){
                    $data[3]='1';
                }else{
                    $data[3]='0';
                }
                $where5['class_id']=$class['class_id'];
                $where5['del_status']=0;
                $where5['type']=5;
                $where5['starttime']=array('egt',$time5);
                $where5['endtime']=array('lt',$endtime5);
                $five=$good->where($where5)->find();
                if($five){
                    $data[4]='1';
                }else{
                    $data[4]='0';
                }
                $where6['class_id']=$class['class_id'];
                $where6['del_status']=0;
                $where6['type']=5;
                $where6['starttime']=array('egt',$time6);
                $where6['endtime']=array('lt',$endtime6);
                $six=$good->where($where6)->find();
                if($six){
                    $data[5]='1';
                }else{
                    $data[5]='0';
                }
                $where7['class_id']=$class['class_id'];
                $where7['del_status']=0;
                $where7['type']=5;
                $where7['starttime']=array('egt',$time7);
                $where7['endtime']=array('lt',$endtime7);
                $seven=$good->where($where7)->find();
                if($seven){
                    $data[6]='1';
                }else{
                    $data[6]='0';
                }
                $where8['class_id']=$class['class_id'];
                $where8['del_status']=0;
                $where8['type']=5;
                $where8['starttime']=array('egt',$time8);
                $where8['endtime']=array('lt',$endtime8);
                $eight=$good->where($where8)->find();
                if($eight){
                    $data[7]='1';
                }else{
                    $data[7]='0';
                }
                $this->templateApi($data,'200','ok');
            }else{
                $this->templateApi('','202','您还没有店铺');
            }

        }else{
            $this->templateApi('','203','请求类型错误');
        }
    }

    //获取预约的时间列表
    public function timelist(){
        $time=time();
        $data=array(
            array(
                'week'  =>  date('w',$time),
                'day'   =>  '今天',
                'time'  =>  strtotime(date('Y-m-d',$time))
            ),
            array(
                'week'  =>  date('w',$time+86400),
                'day'   =>  '明天',
                'time'  =>  strtotime(date('Y-m-d',$time+86400))
            ),
            array(
                'week'  =>  date('w',$time+(86400*2)),
                'day'   =>  date('d',$time+(86400*2)),
                'time'  =>  strtotime(date('Y-m-d',$time+(86400*2)))
            ),
            array(
                'week'  =>  date('w',$time+(86400*3)),
                'day'   =>  date('d',$time+(86400*3)),
                'time'  =>  strtotime(date('Y-m-d',$time+(86400*3)))
            ),
            array(
                'week'  =>  date('w',$time+(86400*4)),
                'day'   =>  date('d',$time+(86400*4)),
                'time'  =>  strtotime(date('Y-m-d',$time+(86400*4)))
            ),
            array(
                'week'  =>  date('w',$time+(86400*5)),
                'day'   =>  date('d',$time+(86400*5)),
                'time'  =>  strtotime(date('Y-m-d',$time+(86400*5)))
            ),
            array(
                'week'  =>  date('w',$time+(86400*6)),
                'day'   =>  date('d',$time+(86400*6)),
                'time'  =>  strtotime(date('Y-m-d',$time+(86400*6)))
            ),
            array(
                'week'  =>  date('w',$time+(86400*7)),
                'day'   =>  date('d',$time+(86400*7)),
                'time'  =>  strtotime(date('Y-m-d',$time+(86400*7)))
            ),
        );
//        $arr=array('星期日','星期一','星期二','星期三','星期四','星期五','星期六');
        foreach($data as $k=>$v){
            if($v['week']=='0'){
                $data[$k]['week']='星期日';
            }else if($v['week']=='1'){
                $data[$k]['week']='星期一';
            }else if($v['week']=='2'){
                $data[$k]['week']='星期二';
            }else if($v['week']=='3'){
                $data[$k]['week']='星期三';
            }else if($v['week']=='4'){
                $data[$k]['week']='星期四';
            }else if($v['week']=='5'){
                $data[$k]['week']='星期五';
            }else if($v['week']=='6'){
                $data[$k]['week']='星期六';
            }
        }
        $rel['data']=$data;

        $this->templateApi($rel,'200','ok');
    }

    //获取套课课节总数
    public function topic_num(){
        $pid=I('post.pid');
        $good=M('goods')->where(array('goods_id'=>$pid))->find();
        $data['classhour']=$good['classhour'];
        $this->templateApi($data,'200','ok');
    }

    public function vip(){
        if(IS_POST){
            $token=I('post.token');
            if($token==''){
                $this->templateApi('','204','参数错误');exit;
            }
            $user=M('user')->where(array('token'=>$token))->find();
            if($user){
                if($user['vip_endtime']<time()){
                    $dovip['is_vip']=0;
                    M('user')->where(array('user_id'=>$user['user_id']))->save($dovip);
                }
                $data['vipendtime']=date('Y-m-d',$user['vip_endtime']);
                $this->templateApi($data,'200','ok');
            }else{
                $this->templateApi('','300','未登录');
            }
        }else{
            $this->templateApi('','203','请求类型错误');
        }
    }

    //pc获取老师直播次数，累计收益，交易次数
    public function teachernews(){
        if(IS_POST){
            $token=I('post.token');
            if($token==''){
                $this->templateApi('','204','参数错误');exit;
            }
            $user=M('user')->where(array('token'=>$token))->find();
            if($user){
                $class=M('class')->where(array('uid'=>$user['user_id']))->find();
                if($class){
                    $where['class_id']=$class['class_id'];
                    $where['type']=array('IN','1,5,6');
                    $where['status']=0;
                    $livebcount=M('goods')->where($where)->count();
                    $data['livebnum']=(string)$livebcount;
                    $pwhere['uid']=$user['user_id'];
                    $pwhere['type']=1;
                    $pwhere['ptype']=2;
                    $pcount=M('payrecord')->where($pwhere)->count();
                    $data['paynum']=(string)$pcount;

                    $data['profit']=(string)$class['profit'];
                    $this->templateApi($data,'200','ok');
                }else{
                    $this->templateApi('','202','您还不是老师');exit;
                }
            }else{
                $this->templateApi('','300','未登录');exit;
            }
        }else{
            $this->templateApi('','203','请求类型错误');
        }
    }

    //pc他们也在网约课
    public function they(){
        if(IS_POST){
            $class=M('class')->limit(4)->select();
            foreach($class as $k=>$v){
                $user=M('user')->where(array('user_id'=>$v['uid']))->find();
                $ud=M('userdata')->where(array('uid'=>$v['uid']))->find();
                $data[$k]['sid']=(string)$v['class_id'];
                $data[$k]['name']=$user['name'];
                $data[$k]['img']=URL.$ud['image'];
                $data[$k]['profile']=$ud['profile'];
            }
            $this->templateApi($data,'200','ok');
        }else{
            $this->templateApi('','203','请求类型错误');
        }
    }

    //学习任务列表
    public function learntask(){
        if(IS_POST){
            $token=I('post.token');
            if($token==''){
                $this->templateApi('','204','参数错误');exit;
            }
            $user=M('user')->where(array('token'=>$token))->find();
            if($user){
                $data[0]=array(
                    'taskid'        =>  '1',
                    'taskname'      =>  '每日在线观看视频30分钟',
                    'taskreward'    =>  '20',
                );
                $tasksee=M('task')->where(array('uid'=>$user['user_id'],'time'=>array(array('egt',$today),array('elt',$etodya)),'type'=>1))->find();
                if($tasksee){
                    $data[0]['taskstatus']='3';
                }else{
                    $data[0]['taskstatus']='2';
                }
                $today = strtotime(date("Y-m-d"),time());
                $etoday= $today+86399;
                $where['time']=array(array('egt',$today),array('elt',$etodya));
                $where['uid']=$user['user_id'];
                $where['type']=2;
                $where['ctype']=array('IN','1,5,6');
                $buyliveb=M('payrecord')->where($where)->find();
                $data[1]=array(
                    'taskid'        =>  '2',
                    'taskname'      =>  '每日购买直播课一次',
                    'taskreward'    =>  '20',
                );

                if($buyliveb){
                    $taskliveb=M('task')->where(array('uid'=>$user['user_id'],'time'=>array(array('egt',$today),array('elt',$etodya)),'type'=>2))->find();
                    if($taskliveb){
                        $data[1]['taskstatus']='3';
                    }else{
                        $data[1]['taskstatus']='1';
                    }

                }else{
                    $data[1]['taskstatus']='0';
                }
                $where['ctype']=array('IN','2,3');
                $buyvideo=M('payrecord')->where($where)->find();
                $data[2]=array(
                    'taskid'        =>  '3',
                    'taskname'      =>  '每日购买视频课一次',
                    'taskreward'    =>  '20',
                );
                if($buyvideo){
                    $taskvideo=M('task')->where(array('uid'=>$user['user_id'],'time'=>array(array('egt',$today),array('elt',$etodya)),'type'=>3))->find();
                    if($taskvideo){
                        $data[2]['taskstatus']='3';
                    }else{
                        $data[2]['taskstatus']='1';
                    }
                }else{
                    $data[2]['taskstatus']='0';
                }
                $this->templateApi($data,'200','ok');
            }else{
                $this->templateApi('','300','未登录');
            }
        }else{
            $this->templateApi('','203','请求类型错误');
        }
    }

    //任务奖励领取
    public function taskreward(){
        if(IS_POST){
            $token=I('post.token');
            $taskid=I('post.taskid');
            if($token==''){
                $this->templateApi('','204','参数错误');exit;
            }
            $user=M('user')->where(array('token'=>$token))->find();
            if($user){
                $ud=M('userdata');
                $today = strtotime(date("Y-m-d"),time());
                $etoday= $today+86399;
                $where['time']=array(array('egt',$today),array('elt',$etodya));
                $where['uid']=$user['user_id'];
                $where['type']=2;
                if($taskid=='1'){

                }else if($taskid=='2'){
                    $where['ctype']=array('IN','1,5,6');
                    $buyliveb=M('payrecord')->where($where)->find();
                    if(!$buyliveb){
                        $this->templateApi('','202','条件不足');exit;
                    }
                    $taskrel=M('task')->where(array('uid'=>$user['user_id'],'time'=>array(array('egt',$today),array('elt',$etodya)),'type'=>2))->find();
                    if($taskrel){
                        $this->templateApi('','202','已领取');exit;
                    }
                }else if($taskid=='3'){
                    $where['ctype']=array('IN','2,3');
                    $buyvideo=M('payrecord')->where($where)->find();
                    if(!$buyvideo){
                        $this->templateApi('','202','条件不足');exit;
                    }
                    $taskrel=M('task')->where(array('uid'=>$user['user_id'],'time'=>array(array('egt',$today),array('elt',$etodya)),'type'=>3))->find();
                    if($taskrel){
                        $this->templateApi('','202','已领取');exit;
                    }
                }
                $ud->where(array('uid'=>$user['user_id']))->setInc('integral','20');
                $mvp['uid']=$user['uid'];
                $mvp['time']=time();
                $task=M('task')->where(array('uid'=>$user['user_id'],'type'=>$taskid))->find();
                if($task){
                    M('task')->where(array('uid'=>$user['user_id']))->save($mvp);
                }else{
                    M('task')->add($mvp);
                }
                $this->templateApi($data,'200','ok');
            }else{
                $this->templateApi('','300','未登录');
            }
        }else{
            $this->templateApi('','203','请求类型错误');
        }
    }

    //我的课程 ——定制课
    public function myclass_demand(){
        if(IS_POST){
            $token=I('post.token');
            $page=I('post.page');
            if($token==''||$page==''){
                $this->templateApi('','204','参数错误');exit;
            }
            $user=M('user')->where(array('token'=>$token))->find();
            if($user){
                $userdata=M('userdata')->where(array('uid'=>$user['user_id']))->find();
                $where=array(
                    'uid'      =>  $user['user_id'],
                    'status'   =>  1,
                );
                $count=M('demand')->where($where)->count();
                $data=$this->havePage('demand',$where,'',$page,'20','');
                $pie['now_page']=$data['now_page'];
                $pie['total_page']=$data['total_page'];
                unset($data['now_page']);
                unset($data['total_page']);
                foreach($data as $k=>$v){
                    $date[$k]['demandid']=$v['demand_id'];
                    $date[$k]['time']=date('Y.m.d H:i',$v['starttime']).'-'.date('H:i',$v['endtime']);
                    $cate=M('category')->where(array('cate_id'=>$v['cate_id']))->find();
                    $date[$k]['catename']=$cate['name'];
                    $date[$k]['img']=URL.$userdata['image'];
                    $date[$k]['name']=$user['name'];
                    $date[$k]['isvip']=$user['is_vip'];
                }
                $acc['data']=$this->emptyarray($date);
                $acc['now_page']=$pie['now_page'];
                $acc['total_page']=$pie['total_page'];
                $acc['count']=$count;
                $this->templateApi($acc,'200','ok');
            }else{
                $this->templateApi('','300','未登录');
            }
        }else{
            $this->templateApi('','203','请求类型错误');
        }
    }
}
