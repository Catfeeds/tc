<?php

/******************************
 *
 * 时间；2018.1.8
 * 功能：个人中心
 * 作者：Mr Peng
 *
 *****************************/ 
namespace Home\Controller;
use Think\Controller;

 header('Content-Type:text/html;charset=utf-8');
 //header("Access-Control-Allow-Origin: *");
class MeController extends CommonController {

/***************************** 个人中心首页 *************************************/
    public function shouhuo(){
     
        $id=$_GET['id'];
        $idrecord=D('ierecord');
        $mvp['status']=3;
        $res=$idrecord->where('idrecord_id='.$id)->save($mvp);
        if($res){
              echo  "<script>alert('收货成功');window.location.href='".__MODULE__."/Me/duihuai';</script>"; 
        }else{
             echo  "<script>alert('收货失败');window.location.href='".__MODULE__."/Me/duihuai';</script>"; 
        }
      
   }
    public function index(){
        $id=session('H_user_id');
    	$user=M('user');
    	$userdata=M('userdata');
        $sign=M('sign');
        $class=D('class');
        $history=D('history');
        $dianpu=$class->where('uid='.$id)->find();
         $lishi=$history->where('uid='.$id)->select();
        if($lishi){
            $a="";
            $b="";
            foreach ($lishi as $k=>$v){
                if( $v['type']==1){
                    $a.=$v['cid'].',';
                }else{
                    $b.=$v['cid'].',';
                }
               
            }
            $video=rtrim($a,',');
            $live=rtrim($b,',');
            $pin=D('video')->table('class as c,video as v,user as u,userdata as ud')->field('v.*,u.user_id,ud.image')->where('v.class_id=c.class_id and c.uid=u.user_id  and u.user_id=ud.uid and v.video_id in ('.$video.')')->select();
            
             $this->assign('pin',$pin);
             $this->assign('bo',$bo);
        }
        $signrel=$sign->where(array('uid'=>session('H_user_id')))->find();
        $start_time = strtotime(date('Y-m-d'));
        if($signrel['time']>$start_time){
            $sign_status='1';   //已签到
        }else{
            $sign_status='0';   //未签到
        }
        $time=URL.'/Home/Login/index?login='.base64_encode(session('H_user_id'));
        $this->assign('sign_status',$sign_status);
    	$userrel=$user->field('name')->where(array('user_id'=>session('H_user_id')))->find();
    	$userdatarel=$userdata->field('sex,image,address,profile,integral')->where(array('uid'=>session('H_user_id')))->find();
        $news=D('news');
       $lists=$news->where('uid='.$id.' and status=0 and tuisong=1')->select();
        if(!$lists){
            $n=D('newsread');
            $ns=$n->field('status')->where('uid='.$id)->find();
        }
        //dump($list);
        $this->assign('ns',$ns);
        $this->assign('lists',$lists);
		$this->assign('name',$userrel['name']);
		$this->assign('user',$userdatarel);
         $this->assign('dian',$dianpu);
         $this->assign('time',$time);
		$this->display();
    }
/***************************** 修改个人资料 *************************************/
    public function edit(){
        if(IS_POST){
            $user_id=session('H_user_id');
            $name['name']=Sensitivefilter(I('post.name'));
            $user=M('user');

            $userrel=$user->where('user_id='.$user_id)->find();
            if($userrel['name']!=$name['name']){
                $rel_name=$user->where(array('name'=>$name['name']))->find();
                if($rel_name){
                    $this->ajaxReturn('1');     //用户名已存在
                }else{
                    $user->where('user_id='.$user_id)->save($name);
                    $upload = new \Think\Upload();      
                    $upload->maxSize  = 3145728 ;      
                    $upload->exts     = array('jpg', 'gif', 'png', 'jpeg');
                    $upload->savePath = '/touxiang/'; 
                    $info   =   $upload->upload();
                    if(empty($info['image']['savepath']) && empty($info['image']['savename'])){

                    }else{
                        $mvp['image']='/Uploads'.$info['image']['savepath'].$info['image']['savename'];
                    }
                    $mvp['name']=Sensitivefilter(I('post.name'));
                    $mvp['sex']=I('post.sex');
                    $mvp['address']=I('post.province').'-'.I('post.city');
                    $mvp['profile']=Sensitivefilter(I('post.content'));
                    $userdata=M('userdata');
                    $rel=$userdata->where('uid='.$user_id)->save($mvp);
                    if($rel!==false){
                        $this->ajaxReturn('2');     //修改成功
                    }else{
                        $this->ajaxReturn('3');     //修改失败
                    }
                }                
            }else{
                $user->where('user_id='.$user_id)->save($name);
                $upload = new \Think\Upload();      
                $upload->maxSize  = 3145728 ;      
                $upload->exts     = array('jpg', 'gif', 'png', 'jpeg');
                $upload->savePath = '/touxiang/'; 
                $info   =   $upload->upload();
                if(empty($info['image']['savepath']) && empty($info['image']['savename'])){

                }else{
                    $mvp['image']='/Uploads'.$info['image']['savepath'].$info['image']['savename'];
                }
                $mvp['name']=Sensitivefilter(I('post.name'));
                $mvp['sex']=I('post.sex');
                $mvp['address']=I('post.province').'-'.I('post.city');
                $mvp['profile']=Sensitivefilter(I('post.content'));
                $userdata=M('userdata');
                $rel=$userdata->where('uid='.$user_id)->save($mvp);
                if($rel!==false){
                    $this->ajaxReturn('2');     //修改成功
                }else{
                    $this->ajaxReturn('3');     //修改失败
                }
            }        
        }else{
            $id=session('H_user_id');
            $user=M('user');
            $userdata=M('userdata');
            $sign=M('sign');
            $class=D('class');
            $history=D('history');
            $dianpu=$class->where('uid='.$id)->find();
             $lishi=$history->where('uid='.$id)->select();
            if($lishi){
                $a="";
                $b="";
                foreach ($lishi as $k=>$v){
                    if( $v['type']==1){
                        $a.=$v['cid'].',';
                    }else{
                        $b.=$v['cid'].',';
                    }
                   
                }
                $video=rtrim($a,',');
                $live=rtrim($b,',');
                $pin=D('video')->table('class as c,video as v,user as u,userdata as ud')->field('v.*,u.user_id,ud.image')->where('v.class_id=c.class_id and c.uid=u.user_id  and u.user_id=ud.uid and v.video_id in ('.$video.')')->select();
               
                 $this->assign('pin',$pin);
                 $this->assign('bo',$bo);
            }
             $news=D('news');
             $lists=$news->where('uid='.$id.' and status=0 and tuisong=1')->select();
        if(!$lists){
            $n=D('newsread');
            $ns=$n->field('status')->where('uid='.$id)->find();
        }
        //dump($list);
        $this->assign('ns',$ns);
        $this->assign('lists',$lists);
            $this->assign('dian',$dianpu);
            $signrel=$sign->where('uid='.$id)->find();
            $start_time = strtotime(date('Y-m-d'));
            if($signrel['time']>$start_time){
                $sign_status='1';   //已签到
            }else{
                $sign_status='0';   //未签到
            }
            $this->assign('sign_status',$sign_status);
            $userrel=$user->field('name')->where(array('user_id'=>session('H_user_id')))->find();
            $userdatarel=$userdata->field('sex,image,address,profile,integral')->where(array('uid'=>session('H_user_id')))->find();
            $this->assign('name',$userrel['name']);
            $this->assign('user',$userdatarel);
            $this->display();
        }
    }

/***************************** 我的收藏列表 ********************************/ 
    
    public function subscribe(){


        $id=session('H_user_id');
        $user=M('user');
        $userdata=M('userdata');
        $sign=M('sign');
        $class=D('class');
            $history=D('history');
            $dianpu=$class->where('uid='.$id)->find();
             $lishi=$history->where('uid='.$id)->select();
            if($lishi){
                $a="";
                $b="";
                foreach ($lishi as $k=>$v){
                    if( $v['type']==1){
                        $a.=$v['cid'].',';
                    }else{
                        $b.=$v['cid'].',';
                    }
                   
                }
                $video=rtrim($a,',');
                $live=rtrim($b,',');
                $pin=D('video')->table('class as c,video as v,user as u,userdata as ud')->field('v.*,u.user_id,ud.image')->where('v.class_id=c.class_id and c.uid=u.user_id  and u.user_id=ud.uid and v.video_id in ('.$video.')')->select();
               
                 $this->assign('pin',$pin);
                 $this->assign('bo',$bo);
            }
             $news=D('news');
         $lists=$news->where('uid='.$id.' and status=0 and tuisong=1')->select();
        if(!$lists){
            $n=D('newsread');
            $ns=$n->field('status')->where('uid='.$id)->find();
        }
        //dump($list);
        $this->assign('ns',$ns);
        $this->assign('lists',$lists);
            $this->assign('dian',$dianpu);
        $signrel=$sign->where('uid='.$id)->find();
        $start_time = strtotime(date('Y-m-d'));
        if($signrel['time']>$start_time){
            $sign_status='1';   //已签到
        }else{
            $sign_status='0';   //未签到
        }
        $this->assign('sign_status',$sign_status);
        $userrel=$user->where('user_id='.$id)->find();
        $userdatarel=$userdata->where('uid='.$id)->find();
        $this->assign('name',$userrel['name']);
        $this->assign('user',$userdatarel);
        $sub=M('subscribe');
        $count = $sub->where('uid='.$id)->count();
        $Page  = new \Think\Page($count,6);
        $show  = $Page->show();
        $result=$sub->where('uid='.$id)->limit($Page->firstRow.','.$Page->listRows)->select();
        foreach($result as $k=>$v){
            $liveb=M('liveb');
            $video=M('video');
            if($v['type']=='0'){
                $result[$k]['class']=$liveb->where('liveb_id='.$v['cid'])->find();
                $result[$k]['class']['time']=date('Y-m-d',$result[$k]['class']['time']);
            }else{
                $result[$k]['class']=$video->where('video_id='.$v['cid'])->find();
                $result[$k]['class']['time']=date('Y-m-d',$result[$k]['class']['time']);
            }
        }
        $this->assign('sub',$result);
        $this->assign('page',$show);
        $this->display();

    } 
/***************************** 删除收藏 *********************************/ 
    
    public function del_sub($id){

        $sub=M('subscribe');
        $result=$sub->where(array('subscribe_id'=>$id))->delete();

        if($result){
            $this->ajaxReturn('200');   //删除成功
        }else{
            $this->ajaxReturn('202');   //删除失败
        }

    } 

/***************************** 我的积分 *********************************/ 
    
    public function point(){
        $id=session('H_user_id');
        $user=M('user');
        $userdata=M('userdata');
        $sign=M('sign');
        $class=D('class');
            $history=D('history');
            $dianpu=$class->where('uid='.$id)->find();
             $lishi=$history->where('uid='.$id)->select();
            if($lishi){
                $a="";
                $b="";
                foreach ($lishi as $k=>$v){
                    if( $v['type']==1){
                        $a.=$v['cid'].',';
                    }else{
                        $b.=$v['cid'].',';
                    }
                   
                }
                $video=rtrim($a,',');
                $live=rtrim($b,',');
                $pin=D('video')->table('class as c,video as v,user as u,userdata as ud')->field('v.*,u.user_id,ud.image')->where('v.class_id=c.class_id and c.uid=u.user_id  and u.user_id=ud.uid and v.video_id in ('.$video.')')->select();
               
                 $this->assign('pin',$pin);
                 $this->assign('bo',$bo);
            }
             $news=D('news');
         $lists=$news->where('uid='.$id.' and status=0 and tuisong=1')->select();
        if(!$lists){
            $n=D('newsread');
            $ns=$n->field('status')->where('uid='.$id)->find();
        }
        //dump($list);
        $this->assign('ns',$ns);
        $this->assign('lists',$lists);
            $this->assign('dian',$dianpu);
        $signrel=$sign->where('uid='.$id)->find();
        $start_time = strtotime(date('Y-m-d'));
        if($signrel['time']>$start_time){
            $sign_status='1';   //已签到
        }else{
            $sign_status='0';   //未签到
        }
        $this->assign('sign_status',$sign_status);
        $userrel=$user->where('user_id='.$id)->find();
        $userdatarel=$userdata->where('uid='.$id)->find();
        $this->assign('name',$userrel['name']);
        $this->assign('user',$userdatarel);
        $jf=M('integral');
        $count=$jf->where(array('uid'=>$id))->count();
        $Page  = new \Think\Page($count,5);
        $show  = $Page->show();
        $jfrel=$jf->where(array('uid'=>$id))->limit($Page->firstRow.','.$Page->listRows)->order('time desc')->select();
        foreach($jfrel as $k=>$v){
            $jfrel[$k]['time']=date('Y-m-d',$v['time']);
        }
        $this->assign('jfrel',$jfrel);
        $this->assign('page',$show);
        $this->display();
    }

/***************************** 我的账户 *********************************/ 
    
    public function account(){
        $id=session('H_user_id');
        $user=M('user');
        $userdata=M('userdata');
        $userrel=$user->where('user_id='.$id)->find();
        $userdatarel=$userdata->where('uid='.$id)->find();
        $sign=M('sign');
        $class=D('class');
            $history=D('history');
            $dianpu=$class->where('uid='.$id)->find();
             $lishi=$history->where('uid='.$id)->select();
            if($lishi){
                $a="";
                $b="";
                foreach ($lishi as $k=>$v){
                    if( $v['type']==1){
                        $a.=$v['cid'].',';
                    }else{
                        $b.=$v['cid'].',';
                    }
                   
                }
                $video=rtrim($a,',');
                $live=rtrim($b,',');
                $pin=D('video')->table('class as c,video as v,user as u,userdata as ud')->field('v.*,u.user_id,ud.image')->where('v.class_id=c.class_id and c.uid=u.user_id  and u.user_id=ud.uid and v.video_id in ('.$video.')')->select();
               
                 $this->assign('pin',$pin);
                 $this->assign('bo',$bo);
            }
             $news=D('news');
        $lists=$news->where('uid='.$id.' and status=0 and tuisong=1')->select();
        if(!$lists){
            $n=D('newsread');
            $ns=$n->field('status')->where('uid='.$id)->find();
        }
        //dump($list);
        $this->assign('ns',$ns);
        $this->assign('lists',$lists);
            $pay=D('pay');
            $paylist=$pay->where('uid='.$id)->find();
            $classlist=$class->where('uid='.$id)->find();
            $t=D('withdraw');
            $time=time();
            $tixian=$t->where('uid='.$id)->order('time desc')->find();
            //dump($tixian);
            $ttime=$tixian['time']+(7*24*3600);
            $this->assign('dian',$dianpu);
            $this->assign('time',$time);
            //dump($time);
           // dump($ttime);
            $this->assign('tixian',$ttime);
            $this->assign('class',$classlist);
            $this->assign('pay',$paylist);
        $signrel=$sign->where('uid='.$id)->find();
        $start_time = strtotime(date('Y-m-d'));
        if($signrel['time']>$start_time){
            $sign_status='1';   //已签到
        }else{
            $sign_status='0';   //未签到
        }

        $this->assign('sign_status',$sign_status);
        $this->assign('name',$userrel['name']);
        $this->assign('user',$userdatarel);
        $pay=M('payrecord');
        $count=$pay->where('uid='.$id)->count();
        $Page  = new \Think\Page($count,10);
        $show  = $Page->show();
        $payrel=$pay->where('uid='.$id)->limit($Page->firstRow.','.$Page->listRows)->order('time desc')->select();
        foreach($payrel as $k=>$v){
            $payrel[$k]['time']=date('Y-m-d',$v['time']);
        }
        $this->assign('payrel',$payrel);
        $this->assign('page',$show);
        $this->display();
    }

/***************************** 签到 *********************************/ 

     public function sign(){ 
        $userrel['user_id']=session('H_user_id');
        $sign=M('sign');
        $userdata=M('userdata');
        $signrel=$sign->where('uid='.$userrel['user_id'])->find();
        if(!$signrel){
            $mvp['uid']=$userrel['user_id'];
            $mvp['time']=time();
            $mvp['signday']=1;
            $rel=$sign->add($mvp);
            if($rel){
                $userdatarel=$userdata->where('uid='.$userrel['user_id'])->setInc('integral',5);
                if($userdatarel){
                    $integral=M('integral');
                    $int['uid']=$userrel['user_id'];
                    $int['type']='1';
                    $int['source']='签到';
                    $int['num']=5;
                    $int['time']=time();
                    $integral->add($int);
                    $this->ajaxReturn('200'); //签到成功
                }else{
                    $this->ajaxReturn('202'); //签到失败
                }
            }else{
                $this->ajaxReturn('202'); //签到失败
            }
        }else{
            $start_time = strtotime(date('Y-m-d'));
            if($signrel['time']>$start_time){
                $this->ajaxReturn('203'); //今日已签到
            }else{
                if($start_time-86400<=$signrel['time'] && $signrel['time']<$start_time){
                    if(1<=$signrel['signday'] && $signrel['signday']<=5){
                        $mvp['time']=time();
                        $mvp['signday']=$signrel['signday']+1;
                        $rel=$sign->where('sign_id='.$signrel['sign_id'])->save($mvp);
                        if($rel){
                            $userdatarel=$userdata->where('uid='.$userrel['user_id'])->setInc('integral',10);
                            if($userdatarel){
                                $integral=M('integral');
                                $int['uid']=$userrel['user_id'];
                                $int['type']='1';
                                $int['source']='签到';
                                $int['num']=10;
                                $int['time']=time();
                                $integral->add($int);
                                $this->ajaxReturn('200'); //签到成功
                            }else{
                                $this->ajaxReturn('202'); //签到失败
                            }
                        }else{
                            $this->ajaxReturn('202'); //签到失败
                        }
                    }else if(6<=$signrel['signday'] && $signrel['signday']<=12){
                        $mvp['time']=time();
                        $mvp['signday']=$signrel['signday']+1;
                        $rel=$sign->where('sign_id='.$signrel['sign_id'])->save($mvp);
                        if($rel){
                            $userdatarel=$userdata->where('uid='.$userrel['user_id'])->setInc('integral',15);
                            if($userdatarel){
                                $integral=M('integral');
                                $int['uid']=$userrel['user_id'];
                                $int['type']='1';
                                $int['source']='签到';
                                $int['num']=15;
                                $int['time']=time();
                                $integral->add($int);
                                $this->ajaxReturn('200'); //签到成功
                            }else{
                                $this->ajaxReturn('202'); //签到失败
                            }
                        }else{
                            $this->ajaxReturn('202'); //签到失败
                        }
                    }else{
                        $mvp['time']=time();
                        $mvp['signday']=$signrel['signday']+1;
                        $rel=$sign->where('sign_id='.$signrel['sign_id'])->save($mvp);
                        if($rel){
                            $userdatarel=$userdata->where('uid='.$userrel['user_id'])->setInc('integral',20);
                            if($userdatarel){
                                $integral=M('integral');
                                $int['uid']=$userrel['user_id'];
                                $int['type']='1';
                                $int['source']='签到';
                                $int['num']=20;
                                $int['time']=time();
                                $integral->add($int);
                                $this->ajaxReturn('200'); //签到成功
                            }else{
                                $$this->ajaxReturn('202'); //签到失败
                            }
                        }else{
                            $this->ajaxReturn('202'); //签到失败
                        }
                    }
                }else{
                    $mvp['time']=time();
                    $mvp['signday']=1;
                    $rel=$sign->where('sign_id='.$signrel['sign_id'])->save($mvp);
                    if($rel){
                        $userdatarel=$userdata->where('uid='.$userrel['user_id'])->setInc('integral',5);
                        if($userdatarel){
                            $integral=M('integral');
                            $int['uid']=$userrel['user_id'];
                            $int['type']='1';
                            $int['source']='签到';
                            $int['num']=5;
                            $int['time']=time();
                            $integral->add($int);
                            $this->ajaxReturn('200'); //签到成功
                        }else{
                            $this->ajaxReturn('202'); //签到失败
                        }
                    }else{
                        $this->ajaxReturn('202'); //签到失败
                    }
                }
            }
        }
    }

/***************************** 设置支付密码 ***************************/ 
public function setpaypass(){
     if($_SESSION['H_user_id']){
        $uid=$_SESSION['H_user_id'];
        $user=D('user');
        $class=D('class');
        $history=D('history');
        $userlist=$user->table('user as u, userdata as ud')->field('u.*,ud.image,ud.integral')->where('u.user_id='.$uid.' and u.user_id=ud.uid')->find();
         $dianpu=$class->where('uid='.$uid)->find();
         $lishi=$history->where('uid='.$uid)->select();
        if($lishi){
            $a="";
            $b="";
            foreach ($lishi as $k=>$v){
                if( $v['type']==1){
                    $a.=$v['cid'].',';
                }else{
                    $b.=$v['cid'].',';
                }
               
            }
            $video=rtrim($a,',');
            $live=rtrim($b,',');
            $pin=D('video')->table('class as c,video as v,user as u,userdata as ud')->field('v.*,u.user_id,ud.image')->where('v.class_id=c.class_id and c.uid=u.user_id  and u.user_id=ud.uid and v.video_id in ('.$video.')')->select();
           
             $this->assign('pin',$pin);
             $this->assign('bo',$bo);
        }
         $news=D('news');
         $lists=$news->where('uid='.$uid.' and status=0 and tuisong=1')->select();
        if(!$lists){
            $n=D('newsread');
            $ns=$n->field('status')->where('uid='.$uid)->find();
        }
        //dump($list);
        $this->assign('ns',$ns);
        $this->assign('lists',$lists);
        $this->assign('dian',$dianpu);
        $this->assign('user',$userlist);
        }
    if(IS_POST){
        $pass=I('post.pass');
        $uid=session('H_user_id');
        $userdata=M('userdata');
        $userdatarel=$userdata->where(array('uid'=>$uid))->find();
        if(empty($userdatarel['paypass'])){
            $mvp['paypass']=md5(md5($pass));
            $result=$userdata->where(array('uid'=>$uid))->save($mvp);
            if($result){
                echo '1';
            }else{
                echo '2';
            }
        }else{
            echo '3';
        }
        
    }else{
        $this->display('Courses/setpaypass');
    }
    
}
/***************************** 立即支付 ***************************/ 

public function lijizhifu(){
    $order_id=I('post.orderid');
    $paypass=I('post.paypass');
    $uid=session('H_user_id');
    $user=M('user');
    $userrel=$user->where(array('user_id'=>$uid))->find();
    $order=M('order');
    $orderrel=$order->where(array('order_id'=>$order_id))->find();
    if($orderrel['type']=='0'){
        $liveb=M('liveb');
        $livebrel=$liveb->where('liveb_id='.$orderrel['play_id'])->find();
        if($livebrel['uid']==$userrel['user_id']){
            $this->ajaxReturn('1');//购买过了
        }else if(empty($livebrel['uid'])){
            $userdata=M('userdata');
            $userdatarel=$userdata->where('uid='.$userrel['user_id'])->find();
            if(empty($userdatarel['paypass'])){
                $this->ajaxReturn('2');//还没设置支付密码
            }else if(md5(md5($paypass))==$userdatarel['paypass']){
                $class=M('class');
                $classrel=$class->where('class_id='.$livebrel['class_id'])->find();
                $t_user=$userdata->where('uid='.$classrel['uid'])->find();
                $userdata->startTrans();
                $class->startTrans();
                if($userdatarel['money']<$livebrel['money']){
                    $this->ajaxReturn('3');//账户余额不足
                }else{
                    $jian=$userdata->where('uid='.$userrel['user_id'])->setDec('money',$livebrel['money']);
                    // $jia=$userdata->where('uid='.$t_user['uid'])->setInc('money',$livebrel['money']);
                    $profit=$class->where('class_id='.$livebrel['class_id'])->setInc('profit',$livebrel['money']);
                    if($jian!==false && $profit!==false){
                        $userdata->commit();
                        $class->commit();
                        $mvp['uid']=$userrel['user_id'];
                        $mvp['reg_status']='1';
                        $sb=$liveb->where('liveb_id='.$livebrel['liveb_id'])->save($mvp);
                        if(!$sb){
                            $this->ajaxReturn('4');exit;//购买失败
                        }
                        $mmp['status']='1';
                        $order->where(array('order_id'=>$order_id))->save($mmp);
                        $this->ajaxReturn('5');//支付成功
                        // 添加学生的交易记录
                        $payrecord=M('payrecord');
                        $add['uid']=$userrel['user_id'];
                        $add['type']='2';
                        $add['time']=time();
                        $add['pay']=$livebrel['money'];
                        $add['source']=$livebrel['name'];
                        $payrecord->add($add);
                        // 添加老师的交易记录
                        $add1['uid']=$t_user['uid'];
                        $add1['type']='1';
                        $add1['time']=time();
                        $add1['income']=$livebrel['money'];
                        $add1['source']=$livebrel['name'];
                        $payrecord->add($add1);
                    }else{
                        $userdata->rollback();
                        $class->rollback();
                        $this->ajaxReturn('6');//支付失败
                    }
                }
            }else{
                $this->ajaxReturn('7');//支付密码不正确
            }
        }else{
            $this->ajaxReturn('8');//课程被别人购买
        }
    }else if($orderrel['type']=='1'){
        $video=M('video');
        $videorel=$video->where('video_id='.$orderrel['play_id'])->find();
        $payvideo=M('payvideo');
        $payvideorel=$payvideo->where(array('uid'=>$userrel['user_id'],'video_id'=>$orderrel['play_id']))->find();
        if($payvideorel){
            $this->ajaxReturn('1');//购买过了
        }else{
            $userdata=M('userdata');
            $userdatarel=$userdata->where('uid='.$userrel['user_id'])->find();
            if(empty($userdatarel['paypass'])){
                $this->ajaxReturn('2');//还没设置支付密码
            }else if(md5(md5($paypass))==$userdatarel['paypass']){
                $class=M('class');
                $classrel=$class->where('class_id='.$videorel['class_id'])->find();
                $t_user=$userdata->where('uid='.$classrel['uid'])->find();
                $userdata->startTrans();
                $class->startTrans();
                if($userdatarel['money']<$videorel['money']){
                    $this->ajaxReturn('3');//账户余额不足
                }else{
                    $jian=$userdata->where('uid='.$userrel['user_id'])->setDec('money',$videorel['money']);
                    $jia=$userdata->where('uid='.$t_user['uid'])->setInc('money',$videorel['money']);
                    $profit=$class->where('class_id='.$videorel['class_id'])->setInc('profit',$videorel['money']);
                    if($jian!==false && $jia!==false && $profit!==false){
                        $userdata->commit();
                        $class->commit();
                        $aaa['number']=$videorel['number']+1;
                        $video->where(array('video_id'=>$orderrel['play_id']))->save($aaa);
                        $mvp['uid']=$userrel['user_id'];
                        $mvp['video_id']=$orderrel['play_id'];
                        $mvp['time']=time();
                        $rel=$payvideo->add($mvp);
                        $mmp['status']='1';
                        $order->where(array('order_id'=>$order_id))->save($mmp);
                        $this->ajaxReturn('5');//支付成功
                        // 添加学生的交易记录
                        $payrecord=M('payrecord');
                        $add['uid']=$userrel['user_id'];
                        $add['type']='2';
                        $add['time']=time();
                        $add['pay']=$videorel['money'];
                        $add['source']=$videorel['name'];
                        $payrecord->add($add);
                        // 添加老师的交易记录
                        $add1['uid']=$t_user['uid'];
                        $add1['type']='1';
                        $add1['time']=time();
                        $add1['income']=$videorel['money'];
                        $add1['source']=$videorel['name'];
                        $payrecord->add($add1);
                    }else{
                        $userdata->rollback();
                        $class->rollback();
                        $this->ajaxReturn('4');exit;//购买失败
                    }
                }
            }else{
                $this->ajaxReturn('7');//支付密码不正确
            }
        }
    }else{
        $this->ajaxReturn('9');//订单错误
    }

    
}

/***************************** 订单管理 *********************************/ 

    public function order(){
        $id=session('H_user_id');
        $user=M('user');
        $userdata=M('userdata');
        $userrel=$user->where('user_id='.$id)->find();
        $userdatarel=$userdata->where('uid='.$id)->find();
        $sign=M('sign');
        $class=D('class');
            $history=D('history');
            $dianpu=$class->where('uid='.$id)->find();
             $lishi=$history->where('uid='.$id)->select();
            if($lishi){
                $a="";
                $b="";
                foreach ($lishi as $k=>$v){
                    if( $v['type']==1){
                        $a.=$v['cid'].',';
                    }else{
                        $b.=$v['cid'].',';
                    }
                   
                }
                $video=rtrim($a,',');
                $live=rtrim($b,',');
                $pin=D('video')->table('class as c,video as v,user as u,userdata as ud')->field('v.*,u.user_id,ud.image')->where('v.class_id=c.class_id and c.uid=u.user_id  and u.user_id=ud.uid and v.video_id in ('.$video.')')->select();
               
                 $this->assign('pin',$pin);
                 $this->assign('bo',$bo);
            }
             $news=D('news');
         $lists=$news->where('uid='.$id.' and status=0 and tuisong=1')->select();
        if(!$lists){
            $n=D('newsread');
            $ns=$n->field('status')->where('uid='.$id)->find();
        }
        //dump($list);
        $this->assign('ns',$ns);
        $this->assign('lists',$lists);
            $this->assign('dian',$dianpu);
        $signrel=$sign->where('uid='.$id)->find();
        $start_time = strtotime(date('Y-m-d'));
        if($signrel['time']>$start_time){
            $sign_status='1';   //已签到
        }else{
            $sign_status='0';   //未签到
        }
        $this->assign('sign_status',$sign_status);
        $this->assign('name',$userrel['name']);
        $this->assign('user',$userdatarel);
        $order=M('order');
        //全部订单
        //******* 待支付订单超过30分钟自动失效处理   start    **********
        $wwr['time']=array('lt',time()-1800);
        $wwr['status']='0';
        $wwr['uid']=$userrel['user_id'];
        $orderrel=$order->where($wwr)->select();
        foreach($orderrel as $k=>$v){
            $mvp['status']='3';
            $order->where('order_id='.$v['order_id'])->save($mvp);
        }
        //******* 待支付订单超过30分钟自动失效处理   end       *********
        //******* 待支付订单的该条直播被报名失效处理  start    *********
        $orderrell=$order->where(array('status'=>'0','uid'=>$userrel['user_id'],'type'=>'0'))->select();
        foreach($orderrell as $k=>$v){
            $liveb=M('liveb');
            $livebrel=$liveb->where('liveb_id='.$v['play_id'])->find();
            if($livebrel['reg_status']=='1'){
                $mvp['status']='3';
                $order->where('order_id='.$v['order_id'])->save($mvp);
            }
        }
        //******* 待支付订单的该条直播被报名失效处理  end     *********
        $qb_count=$order->where('uid='.$id)->count();
        $qb_page = new \Think\Page($qb_count,5);
        $qb_show = $qb_page->show();
        $qb_order=$order->where('uid='.$id)->limit($qb_page->firstRow.','.$qb_page->listRows)->order('time desc')->select();
        foreach($qb_order as $k=>$v){
            $class=M('class');
            $liveb=M('liveb');
            $video=M('video');
            if($v['type']=='0'){
                $forliveb=$liveb->where('liveb_id='.$v['play_id'])->find();
                $qb_order[$k]['name']=$forliveb['name'];
                $qb_order[$k]['strtime']=date('Y-m-d H:i',$forliveb['time']);
                $class_id=$forliveb['class_id'];
                $forclass=$class->where(array('class_id'=>$class_id))->find();
                $uid=$forclass['uid'];
                $foruser=$user->where(array('user_id'=>$uid))->find();
                $qb_order[$k]['teacher_name']=$foruser['name'];
            }else{
                $forvideo=$video->where('video_id='.$v['play_id'])->find();
                $qb_order[$k]['name']=$forvideo['name'];
                $qb_order[$k]['strtime']=date('Y-m-d H:i',$forvideo['time']);
                $class_id=$forvideo['class_id'];
                $forclass=$class->where('class_id='.$class_id)->find();
                $uid=$forclass['uid'];
                $foruser=$user->where('user_id='.$uid)->find();
                $qb_order[$k]['teacher_name']=$foruser['name'];
            }
        }
        $this->assign('qb_order',$qb_order);
        $this->assign('qb_page',$qb_show);

        $this->display();
    }

    public function dzf_order(){
        $id=session('H_user_id');
        $user=M('user');
        $userdata=M('userdata');
        $userrel=$user->where('user_id='.$id)->find();
        $userdatarel=$userdata->where('uid='.$id)->find();
        $sign=M('sign');
        $class=D('class');
            $history=D('history');
            $dianpu=$class->where('uid='.$id)->find();
             $lishi=$history->where('uid='.$id)->select();
            if($lishi){
                $a="";
                $b="";
                foreach ($lishi as $k=>$v){
                    if( $v['type']==1){
                        $a.=$v['cid'].',';
                    }else{
                        $b.=$v['cid'].',';
                    }
                   
                }
                $video=rtrim($a,',');
                $live=rtrim($b,',');
                $pin=D('video')->table('class as c,video as v,user as u,userdata as ud')->field('v.*,u.user_id,ud.image')->where('v.class_id=c.class_id and c.uid=u.user_id  and u.user_id=ud.uid and v.video_id in ('.$video.')')->select();
               
                 $this->assign('pin',$pin);
                 $this->assign('bo',$bo);
            }
             $news=D('news');
        $lists=$news->where('uid='.$id.' and status=0 and tuisong=1')->select();
        if(!$lists){
            $n=D('newsread');
            $ns=$n->field('status')->where('uid='.$id)->find();
        }
        //dump($list);
        $this->assign('ns',$ns);
        $this->assign('lists',$lists);
            $this->assign('dian',$dianpu);
        $signrel=$sign->where('uid='.$id)->find();
        $start_time = strtotime(date('Y-m-d'));
        if($signrel['time']>$start_time){
            $sign_status='1';   //已签到
        }else{
            $sign_status='0';   //未签到
        }
        $this->assign('sign_status',$sign_status);
        $this->assign('name',$userrel['name']);
        $this->assign('user',$userdatarel);
        $order=M('order');
        //待支付
        $dzf_count=$order->where(array('uid'=>$id,'status'=>'0'))->count();
        $dzf_page = new \Think\Page($dzf_count,5);
        $dzf_show = $dzf_page->show();
        $dzf_order=$order->where(array('uid'=>$id,'status'=>'0'))->limit($dzf_page->firstRow.','.$dzf_page->listRows)->order('time desc')->select();
        foreach($dzf_order as $k=>$v){
            $class=M('class');
            $liveb=M('liveb');
            $video=M('video');
            if($v['type']=='0'){
                $forliveb=$liveb->where('liveb_id='.$v['play_id'])->find();
                $dzf_order[$k]['name']=$forliveb['name'];
                $dzf_order[$k]['strtime']=date('Y-m-d H:i',$forliveb['time']);
                $class_id=$forliveb['class_id'];
                $forclass=$class->where('class_id='.$class_id)->find();
                $uid=$forclass['uid'];
                $foruser=$user->where('user_id='.$uid)->find();
                $dzf_order[$k]['teacher_name']=$foruser['name'];
            }else{
                $forvideo=$video->where('video_id='.$v['play_id'])->find();
                $dzf_order[$k]['name']=$forvideo['name'];
                $dzf_order[$k]['strtime']=date('Y-m-d H:i',$forvideo['time']);
                $class_id=$forvideo['class_id'];
                $forclass=$class->where('class_id='.$class_id)->find();
                $uid=$forclass['uid'];
                $foruser=$user->where('user_id='.$uid)->find();
                $dzf_order[$k]['teacher_name']=$foruser['name'];
            }
        }
        $this->assign('dzf_order',$dzf_order);
        $this->assign('dzf_page',$dzf_show);
        $this->display();
    }

    public function yzf_order(){
        $id=session('H_user_id');
        $user=M('user');
        $userdata=M('userdata');
        $userrel=$user->where('user_id='.$id)->find();
        $userdatarel=$userdata->where('uid='.$id)->find();
        $sign=M('sign');
        $class=D('class');
            $history=D('history');
            $dianpu=$class->where('uid='.$id)->find();
             $lishi=$history->where('uid='.$id)->select();
            if($lishi){
                $a="";
                $b="";
                foreach ($lishi as $k=>$v){
                    if( $v['type']==1){
                        $a.=$v['cid'].',';
                    }else{
                        $b.=$v['cid'].',';
                    }
                   
                }
                $video=rtrim($a,',');
                $live=rtrim($b,',');
                $pin=D('video')->table('class as c,video as v,user as u,userdata as ud')->field('v.*,u.user_id,ud.image')->where('v.class_id=c.class_id and c.uid=u.user_id  and u.user_id=ud.uid and v.video_id in ('.$video.')')->select();
               
                 $this->assign('pin',$pin);
                 $this->assign('bo',$bo);
            }
             $news=D('news');
        $lists=$news->where('uid='.$id.' and status=0 and tuisong=1')->select();
        if(!$lists){
            $n=D('newsread');
            $ns=$n->field('status')->where('uid='.$id)->find();
        }
        //dump($list);
        $this->assign('ns',$ns);
        $this->assign('lists',$lists);
            $this->assign('dian',$dianpu);
        $signrel=$sign->where('uid='.$id)->find();
        $start_time = strtotime(date('Y-m-d'));
        if($signrel['time']>$start_time){
            $sign_status='1';   //已签到
        }else{
            $sign_status='0';   //未签到
        }
        $this->assign('sign_status',$sign_status);
        $this->assign('name',$userrel['name']);
        $this->assign('user',$userdatarel);
        $order=M('order');
         //已支付
        $yzf_count=$order->where(array('uid'=>$id,'status'=>'1'))->count();
        $yzf_page = new \Think\Page($yzf_count,5);
        $yzf_show = $yzf_page->show();
        $yzf_order=$order->where(array('uid'=>$id,'status'=>'1'))->limit($yzf_page->firstRow.','.$yzf_page->listRows)->order('time desc')->select();
        foreach($yzf_order as $k=>$v){
            $class=M('class');
            $liveb=M('liveb');
            $video=M('video');
            if($v['type']=='0'){
                $forliveb=$liveb->where('liveb_id='.$v['play_id'])->find();
                $yzf_order[$k]['name']=$forliveb['name'];
                $yzf_order[$k]['strtime']=date('Y-m-d H:i',$forliveb['time']);
                $class_id=$forliveb['class_id'];
                $forclass=$class->where('class_id='.$class_id)->find();
                $uid=$forclass['uid'];
                $foruser=$user->where('user_id='.$uid)->find();
                $yzf_order[$k]['teacher_name']=$foruser['name'];
            }else{
                $forvideo=$video->where('video_id='.$v['play_id'])->find();
                $yzf_order[$k]['name']=$forvideo['name'];
                $yzf_order[$k]['strtime']=date('Y-m-d H:i',$forvideo['time']);
                $class_id=$forvideo['class_id'];
                $forclass=$class->where('class_id='.$class_id)->find();
                $uid=$forclass['uid'];
                $foruser=$user->where('user_id='.$uid)->find();
                $yzf_order[$k]['teacher_name']=$foruser['name'];
            }
        }
        $this->assign('yzf_order',$yzf_order);
        $this->assign('yzf_page',$yzf_show);
        $this->display();
    }

    public function yqx_order(){
        $id=session('H_user_id');
        $user=M('user');
        $userdata=M('userdata');
        $userrel=$user->where('user_id='.$id)->find();
        $userdatarel=$userdata->where('uid='.$id)->find();
        $sign=M('sign');
        $class=D('class');
            $history=D('history');
            $dianpu=$class->where('uid='.$id)->find();
             $lishi=$history->where('uid='.$id)->select();
            if($lishi){
                $a="";
                $b="";
                foreach ($lishi as $k=>$v){
                    if( $v['type']==1){
                        $a.=$v['cid'].',';
                    }else{
                        $b.=$v['cid'].',';
                    }
                   
                }
                $video=rtrim($a,',');
                $live=rtrim($b,',');
                $pin=D('video')->table('class as c,video as v,user as u,userdata as ud')->field('v.*,u.user_id,ud.image')->where('v.class_id=c.class_id and c.uid=u.user_id  and u.user_id=ud.uid and v.video_id in ('.$video.')')->select();
               
                 $this->assign('pin',$pin);
                 $this->assign('bo',$bo);
            }
             $news=D('news');
        $lists=$news->where('uid='.$id.' and status=0 and tuisong=1')->select();
        if(!$lists){
            $n=D('newsread');
            $ns=$n->field('status')->where('uid='.$id)->find();
        }
        //dump($list);
        $this->assign('ns',$ns);
        $this->assign('lists',$lists);
            $this->assign('dian',$dianpu);
        $signrel=$sign->where('uid='.$id)->find();
        $start_time = strtotime(date('Y-m-d'));
        if($signrel['time']>$start_time){
            $sign_status='1';   //已签到
        }else{
            $sign_status='0';   //未签到
        }
        $this->assign('sign_status',$sign_status);
        $this->assign('name',$userrel['name']);
        $this->assign('user',$userdatarel);
        $order=M('order');
        //已取消
        $yqx_count=$order->where(array('uid'=>$id,'status'=>'2'))->count();
        $yqx_page = new \Think\Page($yqx_count,5);
        $yqx_show = $yqx_page->show();
        $yqx_order=$order->where(array('uid'=>$id,'status'=>'2'))->limit($yqx_page->firstRow.','.$yqx_page->listRows)->order('time desc')->select();
        foreach($yqx_order as $k=>$v){
            $class=M('class');
            $liveb=M('liveb');
            $video=M('video');
            if($v['type']=='0'){
                $forliveb=$liveb->where('liveb_id='.$v['play_id'])->find();
                $yqx_order[$k]['name']=$forliveb['name'];
                $yqx_order[$k]['strtime']=date('Y-m-d H:i',$forliveb['time']);
                $class_id=$forliveb['class_id'];
                $forclass=$class->where('class_id='.$class_id)->find();
                $uid=$forclass['uid'];
                $foruser=$user->where('user_id='.$uid)->find();
                $yqx_order[$k]['teacher_name']=$foruser['name'];
            }else{
                $forvideo=$video->where('video_id='.$v['play_id'])->find();
                $yqx_order[$k]['name']=$forvideo['name'];
                $yqx_order[$k]['strtime']=date('Y-m-d H:i',$forvideo['time']);
                $class_id=$forvideo['class_id'];
                $forclass=$class->where('class_id='.$class_id)->find();
                $uid=$forclass['uid'];
                $foruser=$user->where('user_id='.$uid)->find();
                $yqx_order[$k]['teacher_name']=$foruser['name'];
            }
        }
        $this->assign('yqx_order',$yqx_order);
        $this->assign('yqx_page',$yqx_show);
        $this->display();
    }
   
    public function ysx_order(){
        $id=session('H_user_id');
        $user=M('user');
        $userdata=M('userdata');
        $userrel=$user->where('user_id='.$id)->find();
        $userdatarel=$userdata->where('uid='.$id)->find();
        $sign=M('sign');
        $class=D('class');
            $history=D('history');
            $dianpu=$class->where('uid='.$id)->find();
             $lishi=$history->where('uid='.$id)->select();
            if($lishi){
                $a="";
                $b="";
                foreach ($lishi as $k=>$v){
                    if( $v['type']==1){
                        $a.=$v['cid'].',';
                    }else{
                        $b.=$v['cid'].',';
                    }
                   
                }
                $video=rtrim($a,',');
                $live=rtrim($b,',');
                $pin=D('video')->table('class as c,video as v,user as u,userdata as ud')->field('v.*,u.user_id,ud.image')->where('v.class_id=c.class_id and c.uid=u.user_id  and u.user_id=ud.uid and v.video_id in ('.$video.')')->select();
               
                 $this->assign('pin',$pin);
                 $this->assign('bo',$bo);
            }
             $news=D('news');
        $lists=$news->where('uid='.$id.' and status=0 and tuisong=1')->select();
        if(!$lists){
            $n=D('newsread');
            $ns=$n->field('status')->where('uid='.$id)->find();
        }
        //dump($list);
        $this->assign('ns',$ns);
        $this->assign('lists',$lists);
            $this->assign('dian',$dianpu);
        $signrel=$sign->where('uid='.$id)->find();
        $start_time = strtotime(date('Y-m-d'));
        if($signrel['time']>$start_time){
            $sign_status='1';   //已签到
        }else{
            $sign_status='0';   //未签到
        }
        $this->assign('sign_status',$sign_status);
        $this->assign('name',$userrel['name']);
        $this->assign('user',$userdatarel);
        $order=M('order');
        //已失效
        $ysx_count=$order->where(array('uid'=>$id,'status'=>'3'))->count();
        $ysx_page = new \Think\Page($ysx_count,5);
        $ysx_show = $ysx_page->show();
        $ysx_order=$order->where(array('uid'=>$id,'status'=>'3'))->limit($ysx_page->firstRow.','.$ysx_page->listRows)->order('time desc')->select();
        foreach($ysx_order as $k=>$v){
            $class=M('class');
            $liveb=M('liveb');
            $video=M('video');
            if($v['type']=='0'){
                $forliveb=$liveb->where('liveb_id='.$v['play_id'])->find();
                $ysx_order[$k]['name']=$forliveb['name'];
                $ysx_order[$k]['strtime']=date('Y-m-d H:i',$forliveb['time']);
                $class_id=$forliveb['class_id'];
                $forclass=$class->where('class_id='.$class_id)->find();
                $uid=$forclass['uid'];
                $foruser=$user->where('user_id='.$uid)->find();
                $ysx_order[$k]['teacher_name']=$foruser['name'];
            }else{
                $forvideo=$video->where('video_id='.$v['play_id'])->find();
                $ysx_order[$k]['name']=$forvideo['name'];
                $ysx_order[$k]['strtime']=date('Y-m-d H:i',$forvideo['time']);
                $class_id=$forvideo['class_id'];
                $forclass=$class->where('class_id='.$class_id)->find();
                $uid=$forclass['uid'];
                $foruser=$user->where('user_id='.$uid)->find();
                $ysx_order[$k]['teacher_name']=$foruser['name'];
            }
        }
        $this->assign('ysx_order',$ysx_order);
        $this->assign('ysx_page',$ysx_show);
        $this->display();
    }

/***************************** 取消订单 *********************************/ 

    public function cancelorder(){
        $id=session('H_user_id');
        $order_id=I('post.order_id');
        $userrel=M('user')->where(array('user_id'=>$id))->find();
        if($userrel){
            $mvp['status']='2';
            $rel=M('order')->where(array('order_id'=>$order_id))->save($mvp);
            if($rel){
                $this->ajaxReturn('200');
            }else{
                $this->ajaxReturn('202');
            }
        }else{  
            $this->ajaxReturn('203');
        }

    }


    public function del_order(){
        $id=session('H_user_id');
        $order_id=I('post.order_id');
        $userrel=M('user')->where(array('user_id'=>$id))->find();
        if($userrel){
            $rel=M('order')->where(array('order_id'=>$order_id))->delete();
            if($rel){
                $this->ajaxReturn('200');
            }else{
                $this->ajaxReturn('202');
            }
        }else{  
            $this->ajaxReturn('203');
        }
    }

/***************************** 我的课程 *********************************/ 

    public function course(){
        $id=session('H_user_id');
        $user=M('user');
        $userdata=M('userdata');
        $class=D('class');
        $dianpu=$class->where('uid='.$id)->find();
        $userrel=$user->where('user_id='.$id)->find();
        $userdatarel=$userdata->where('uid='.$id)->find();
        $sign=M('sign');
        $class=D('class');
            $history=D('history');
            $dianpu=$class->where('uid='.$id)->find();
             $lishi=$history->where('uid='.$id)->select();
            if($lishi){
                $a="";
                $b="";
                foreach ($lishi as $k=>$v){
                    if( $v['type']==1){
                        $a.=$v['cid'].',';
                    }else{
                        $b.=$v['cid'].',';
                    }
                   
                }
                $video=rtrim($a,',');
                $live=rtrim($b,',');
                $pin=D('video')->table('class as c,video as v,user as u,userdata as ud')->field('v.*,u.user_id,ud.image')->where('v.class_id=c.class_id and c.uid=u.user_id  and u.user_id=ud.uid and v.video_id in ('.$video.')')->select();
               
                 $this->assign('pin',$pin);
                 $this->assign('bo',$bo);
            }
             $news=D('news');
         $lists=$news->where('uid='.$id.' and status=0 and tuisong=1')->select();
        if(!$lists){
            $n=D('newsread');
            $ns=$n->field('status')->where('uid='.$id)->find();
        }
        //dump($list);
        $this->assign('ns',$ns);
        $this->assign('lists',$lists);
            $this->assign('dian',$dianpu);
        $signrel=$sign->where('uid='.$id)->find();
        $start_time = strtotime(date('Y-m-d'));
        if($signrel['time']>$start_time){
            $sign_status='1';   //已签到
        }else{
            $sign_status='0';   //未签到
        }
        $this->assign('sign_status',$sign_status);
        $this->assign('name',$userrel['name']);
        $this->assign('user',$userdatarel);
        $this->assign('dian',$dianpu);
        $liveb=M('liveb');
        $count=$liveb->where('uid='.$id)->count();
        $count_start=$liveb->where(array('uid'=>$id,'status'=>'1'))->count();
        $this->assign('count_start',$count_start);
        $page=new \Think\Page($count,5);
        $show=$page->show();
        $time=time();
        $livelist=$liveb->where('uid='.$id)->limit($page->firstRow.','.$page->listRows)->order('time desc')->select();
        foreach($livelist as $k=>$v){
            $comment_liveb=M('comment_liveb');
            $comment_livebrel=$comment_liveb->where(array('uid'=>$id,'liveb_id'=>$v['liveb_id']))->find();
            if($comment_livebrel){
                $livelist[$k]['comment_status']='1';
            }else{
                $livelist[$k]['comment_status']='0';
            }
        }
        // dump($livelist);
        //$time=time();
       
        $this->assign('live',$livelist);
        $this->assign('page',$show);
        $this->assign('time',$time);
        $this->display();
    }

    public function courseajax(){
        $id=session('H_user_id');
        $count=I('post.num');
        $liveb=M('liveb');
        $list=$liveb->where(array('uid'=>$id,'status'=>'1'))->count();
        if($count==$list){
            $this->ajaxReturn('1');
        }else{
            $this->ajaxReturn('2');
        }
    }

    public function course_video(){
        $id=session('H_user_id');
        $user=M('user');
        $userdata=M('userdata');
        $userrel=$user->where('user_id='.$id)->find();
        $userdatarel=$userdata->where('uid='.$id)->find();
        $sign=M('sign');
        $class=D('class');
            $history=D('history');
            $dianpu=$class->where('uid='.$id)->find();
             $lishi=$history->where('uid='.$id)->select();
            if($lishi){
                $a="";
                $b="";
                foreach ($lishi as $k=>$v){
                    if( $v['type']==1){
                        $a.=$v['cid'].',';
                    }else{
                        $b.=$v['cid'].',';
                    }
                   
                }
                $video=rtrim($a,',');
                $live=rtrim($b,',');
                $pin=D('video')->table('class as c,video as v,user as u,userdata as ud')->field('v.*,u.user_id,ud.image')->where('v.class_id=c.class_id and c.uid=u.user_id  and u.user_id=ud.uid and v.video_id in ('.$video.')')->select();
               
                 $this->assign('pin',$pin);
                 $this->assign('bo',$bo);
            }
             $news=D('news');
        $lists=$news->where('uid='.$id.' and status=0 and tuisong=1')->select();
        if(!$lists){
            $n=D('newsread');
            $ns=$n->field('status')->where('uid='.$id)->find();
        }
        //dump($list);
        $this->assign('ns',$ns);
        $this->assign('lists',$lists);
            $this->assign('dian',$dianpu);
        $signrel=$sign->where('uid='.$id)->find();
        $start_time = strtotime(date('Y-m-d'));
        if($signrel['time']>$start_time){
            $sign_status='1';   //已签到
        }else{
            $sign_status='0';   //未签到
        }
        $this->assign('sign_status',$sign_status);
        $this->assign('name',$userrel['name']);
        $this->assign('user',$userdatarel);
        $payvideo=M('payvideo');
        $count=$payvideo->where('uid='.$id)->count();
        $page=new \Think\Page($count,5);
        $show=$page->show();
        $payvideorel=$payvideo->where('uid='.$id)->limit($page->firstRow.','.$page->listRows)->order('time desc')->select();
        foreach($payvideorel as $k=>$v){
            $video=M('video');
            $forvideo=$video->where('video_id='.$v['video_id'])->find();
            $payvideorel[$k]['video_list']=$forvideo;
            $payvideorel[$k]['video_list']['time']=date('Y-m-d',$forvideo['time']);
        }
       
        $this->assign('video',$payvideorel);
        $this->assign('page',$show);
        $this->display();
    }
    //验证支付密码
    public function yangzhi(){
        $pass=md5(md5($_POST['ypass']));
        $user=D('userdata');
        $uid=$_SESSION['H_user_id'];
        $res=$user->where('uid='.$uid)->find();
        
            if($res['paypass']==$pass){
                $this->ajaxReturn('密码正确');
            }else{
                $this->ajaxReturn('密码不正确');
            }
        
    }   
    //修改支付密码
    public function xiuzhi(){
        
        $user=D('userdata');
        $uid=$_SESSION['H_user_id'];
        $mvp['paypass']=md5(md5($_POST['xpass']));
        $res=$user->where('uid='.$uid)->save($mvp);
        if($res){
            $this->ajaxReturn('修改成功');
        }else{
            $this->ajaxReturn('修改失败');
        }

    }
    //验证登录密码
    public function yanglu(){
        $pass=md5(md5($_POST['ypass']));
        $user=D('user');
        $uid=$_SESSION['H_user_id'];
        $res=$user->where('user_id='.$uid)->find();
        if($res['pass']==$pass){
            $this->ajaxReturn('密码正确');
        }else{
            $this->ajaxReturn('密码不正确');
        }
    }
    //修改登录密码
    public function xiulu(){
        
        $user=D('user');
        $uid=$_SESSION['H_user_id'];
        $row=$user->where('user_id='.$uid)->find();
        $mvp['pass']=md5(md5($_POST['xpass']));
        $mvp['token']=md5($row['phone'].$this->getRandomString(16));
        $res=$user->where('user_id='.$uid)->save($mvp);
        if($res){
            $this->ajaxReturn('修改成功');
        }else{
            $this->ajaxReturn('修改失败');
        }

    }
    //验证手机号是否存在
    public function yanzheng(){
        $uid=$_SESSION['H_user_id'];
        $phone=$_POST['phone'];
        $user=D('user');
        $res=$user->where('user_id='.$uid)->find();
        if($res['phone']==$phone){
            $this->ajaxReturn('1');
        }else{
            $this->ajaxReturn('2');
        }
    }
    //找回支付密码
    public function mima(){
        if($_SESSION['H_user_id']){
        $uid=$_SESSION['H_user_id'];
        $user=D('user');
        $class=D('class');
        $history=D('history');
        $userlist=$user->table('user as u, userdata as ud')->field('u.*,ud.image')->where('u.user_id='.$uid.' and u.user_id=ud.uid')->find();
         $dianpu=$class->where('uid='.$uid)->find();
         $lishi=$history->where('uid='.$uid)->select();
        if($lishi){
            $a="";
            $b="";
            foreach ($lishi as $k=>$v){
                if( $v['type']==1){
                    $a.=$v['cid'].',';
                }else{
                    $b.=$v['cid'].',';
                }
               
            }
            $video=rtrim($a,',');
            $live=rtrim($b,',');
            $pin=D('video')->table('class as c,video as v,user as u,userdata as ud')->field('v.*,u.user_id,ud.image')->where('v.class_id=c.class_id and c.uid=u.user_id  and u.user_id=ud.uid and v.video_id in ('.$video.')')->select();
           
             $this->assign('pin',$pin);
             $this->assign('bo',$bo);
        }
         $news=D('news');
        $lists=$news->where('uid='.$uid.' and status=0 and tuisong=1')->select();
        if(!$lists){
            $n=D('newsread');
            $ns=$n->field('status')->where('uid='.$uid)->find();
        }
        //dump($list);
        $this->assign('ns',$ns);
        $this->assign('lists',$lists);
        $this->assign('dian',$dianpu);
        $this->assign('user',$userlist);
        }
        if(IS_POST){
            $phone=I('post.phone');  //获取手机号
            $pass=I('post.pass');    //获取密码
            //$repass=I('post.repass');//验证密码
            $verify=I('post.verify');//获取验证码
            $user=M('user');
            $uid=$_SESSION['H_user_id'];
            $rel=$user->where('user_id='.$uid)->find(); // 判断手机号是否存在
            if($rel['phone']!=$phone){
                $this->ajaxReturn('该账户未绑定此手机号');
            }else{
                // 判断验证码是否正确
                $yzm=M('verify');
                $reg=$yzm->where('phone='.$phone)->order('time desc')->find();
                if(!$reg || $reg['verify']!=$verify){
                    $this->ajaxReturn('验证码错误');
                }else{
                    // 判断验证码是否过期
                    $times=time()-$reg['time'];
                    if($times>300){
                        $yzm->where('verify_id='.$reg['verify_id'])->delete();
                        $this->ajaxReturn('验证码超时');
                    }else{ 
                        $mvp['paypass']=md5(md5($pass));
                        $userdata=D('userdata');
                        $add=$userdata->where('uid='.$uid)->save($mvp);
                        $yzm->where('verify_id='.$reg['verify_id'])->delete();
                        $this->ajaxReturn('修改成功');
                        
                       
                    }
                }
            }
        }else{
            $this->display('forget-password');
        }
   } 
   public function jifen(){
    if($_SESSION['H_user_id']){
        $uid=$_SESSION['H_user_id'];
        $user=D('user');
        $class=D('class');
        $history=D('history');
        $userlist=$user->table('user as u, userdata as ud')->field('u.*,ud.image')->where('u.user_id='.$uid.' and u.user_id=ud.uid')->find();
         $dianpu=$class->where('uid='.$uid)->find();
         $lishi=$history->where('uid='.$uid)->select();
        if($lishi){
            $a="";
            $b="";
            foreach ($lishi as $k=>$v){
                if( $v['type']==1){
                    $a.=$v['cid'].',';
                }else{
                    $b.=$v['cid'].',';
                }
               
            }
            $video=rtrim($a,',');
            $live=rtrim($b,',');
            $pin=D('video')->table('class as c,video as v,user as u,userdata as ud')->field('v.*,u.user_id,ud.image')->where('v.class_id=c.class_id and c.uid=u.user_id  and u.user_id=ud.uid and v.video_id in ('.$video.')')->select();
           
             $this->assign('pin',$pin);
             $this->assign('bo',$bo);
        }
         $news=D('news');
         $lists=$news->where('uid='.$uid.' and status=0 and tuisong=1')->select();
        if(!$lists){
            $n=D('newsread');
            $ns=$n->field('status')->where('uid='.$uid)->find();
        }
        //dump($list);
        $this->assign('ns',$ns);
        $this->assign('lists',$lists);
        $this->assign('dian',$dianpu);
        $this->assign('user',$userlist);
        }
        if(IS_POST){
            $money=$_POST['money'];
            $user=D('userdata');
            $uid=$_SESSION['H_user_id'];
            $userdata=$user->where('uid='.$uid)->find();
            if($userdata['integral']>=$money && $money>=1000){
                $jia=$user->where('uid='.$uid)->setInc('money',$_POST['money']/1000);
                $jian=$user->where('uid='.$uid)->setDec('integral',$_POST['money']);
                if($jia!==false && $jian!==false){
                    $integral=D('integral');
                    $payrecord=D('payrecord');
                    $data['uid']=$uid;
                    $data['type']=2;
                    $data['source']='兑换约课币';
                    $data['time']=time();
                    $data['num']=$_POST['money'];
                    $integral->add($data);
                    $mvp['uid']=$uid;
                    $mvp['type']=1;
                    $mvp['time']=time();
                    $mvp['income']=$_POST['money']/1000;
                    $mvp['source']='兑换约课币';
                    $payrecord->add($mvp);
                    $this->ajaxReturn('兑换成功');
                }else{
                     $this->ajaxReturn('兑换失败');
                }
            }else{
                $this->ajaxReturn('积分余额不足');
            }

        }
        $uid=$_SESSION['H_user_id'];
        $good=D('good');
        $userdata=D('userdata');
        $user=D('user');
        $type=D('type');
        $typelist=$type->select();
        $userli=$user->where('user_id='.$uid)->find();
        $userlis=$userdata->where('uid='.$uid)->find();
        $money=floor($userlis['integral']/1000);
        $goodlist=$good->where('type=1')->limit(4)->select();
        $goodlist1=$good->where('type_id=1')->select();
        $goodlist2=$good->where('type_id=2')->select();
        $goodlist3=$good->where('type_id=3')->select();
        $goodlist4=$good->where('type_id=4')->select();
        $this->assign('res',$userli);
        $this->assign('row',$userlis);
        $this->assign('money',$money);
        $this->assign('good',$goodlist);
        $this->assign('good1',$goodlist1);
        $this->assign('good2',$goodlist2);
        $this->assign('good3',$goodlist3);
        $this->assign('good4',$goodlist4);
        $this->assign('type',$typelist);
        $this->display('integral-mall');
   }
   public function duihuai(){
        if($_SESSION['H_user_id']){
        $uid=$_SESSION['H_user_id'];
        $user=D('user');
        $class=D('class');
        $history=D('history');
        $userlist=$user->table('user as u, userdata as ud')->field('u.*,ud.image')->where('u.user_id='.$uid.' and u.user_id=ud.uid')->find();
         $dianpu=$class->where('uid='.$uid)->find();
         $lishi=$history->where('uid='.$uid)->select();
        if($lishi){
            $a="";
            $b="";
            foreach ($lishi as $k=>$v){
                if( $v['type']==1){
                    $a.=$v['cid'].',';
                }else{
                    $b.=$v['cid'].',';
                }
               
            }
            $video=rtrim($a,',');
            $live=rtrim($b,',');
            $pin=D('video')->table('class as c,video as v,user as u,userdata as ud')->field('v.*,u.user_id,ud.image')->where('v.class_id=c.class_id and c.uid=u.user_id  and u.user_id=ud.uid and v.video_id in ('.$video.')')->select();
           
             $this->assign('pin',$pin);
             $this->assign('bo',$bo);
        }
         $news=D('news');
        $lists=$news->where('uid='.$uid.' and status=0 and tuisong=1')->select();
        if(!$lists){
            $n=D('newsread');
            $ns=$n->field('status')->where('uid='.$uid)->find();
        }
        //dump($list);
        $this->assign('ns',$ns);
        $this->assign('lists',$lists);
        $this->assign('dian',$dianpu);
        $this->assign('user',$userlist);
        }
       $uid=$_SESSION['H_user_id'];
       
       $idrecord=D('ierecord');
       $count = $idrecord->where('uid='.$uid)->count();
       $Page = new \Think\Page($count,10);
       $duihuai=$idrecord->table('ierecord as i,good as g')->field('i.*,g.img,g.name,g.price')->where('i.uid='.$uid.' and i.gid=g.good_id')->limit($Page -> firstRow.','.$Page -> listRows)->order('time desc')->select();
       //dump($duihuai);
       $show1 = $Page ->show();
       $this->assign('show',$show1);
       $this->assign('dui',$duihuai);
       $this->display('for-record');
   }

    public function yznotify(){
        $order_num=I('post.order_num');
        $wxpay=M('wxpay');
        $rel=$wxpay->where(array('order_num'=>$order_num))->find();
        if($rel['status']=='1'){
            $this->ajaxReturn('200');
        }else{
            $this->ajaxReturn('202');
        }
    }

   public function chongzhi(){
    
        $id=session('H_user_id');
        $user=M('user');
        $userdata=M('userdata');
        $userrel=$user->where('user_id='.$id)->find();
        $userdatarel=$userdata->where('uid='.$id)->find();
        $sign=M('sign');
        $class=D('class');
            $history=D('history');
            $dianpu=$class->where('uid='.$id)->find();
             $lishi=$history->where('uid='.$id)->select();
            if($lishi){
                $a="";
                $b="";
                foreach ($lishi as $k=>$v){
                    if( $v['type']==1){
                        $a.=$v['cid'].',';
                    }else{
                        $b.=$v['cid'].',';
                    }
                   
                }
                $video=rtrim($a,',');
                $live=rtrim($b,',');
                $pin=D('video')->table('class as c,video as v,user as u,userdata as ud')->field('v.*,u.user_id,ud.image')->where('v.class_id=c.class_id and c.uid=u.user_id  and u.user_id=ud.uid and v.video_id in ('.$video.')')->select();
               
                 $this->assign('pin',$pin);
                 $this->assign('bo',$bo);
            }
             $news=D('news');
        $lists=$news->where('uid='.$id.' and status=0 and tuisong=1')->select();
        if(!$lists){
            $n=D('newsread');
            $ns=$n->field('status')->where('uid='.$id)->find();
        }
        //dump($list);
        $this->assign('ns',$ns);
        $this->assign('lists',$lists);
            $this->assign('dian',$dianpu);
        $signrel=$sign->where('uid='.$id)->find();
        $start_time = strtotime(date('Y-m-d'));
        if($signrel['time']>$start_time){
            $sign_status='1';   //已签到
        }else{
            $sign_status='0';   //未签到
        }
        
        $this->assign('sign_status',$sign_status);
        $this->assign('name',$userrel['name']);
        $this->assign('user',$userdatarel);
        
        
        $this->display();

    
   }
   public function chong(){
            $test=I('get.id');
            $str = str_replace(array("￥"),"",$test);

            $id=substr($str,0,-3)*100;   

            $order_num=$this->getRandomString(11);
            $order=array(
                'body'=>'平台充值',
                'total_fee'=>$id,
                'out_trade_no'=>$order_num,
                'product_id'=>$id,
                'trade_type'=>'NATIVE'
            );
            $mvp=array(
                'uid'       =>  session('H_user_id'),
                'order_num' =>  $order_num,
                'money'     =>  $id,
                'status'    =>  '0',
                'body'      =>  '平台充值',
                'product_id'=>  $id,
                'time'      =>  time()
            );
            M('wxpay')->add($mvp);
            Vendor('Weixinpay.Weixinpay');
            $wxpay= new \Weixinpay();
            $result=$wxpay->unifiedOrder($order);
            $code_url=$result['code_url'];
            if($result){
                $this->ajaxReturn(array('code'=>'200','msg'=>$code_url,'out_trade_no'=>$order_num));
            }else{
                $this->ajaxReturn(array('code'=>'202','msg'=>'err'));
            }
                                   
        }
   //积分商城详情页
   public function xiangqing(){
        if($_SESSION['H_user_id']){
        $uid=$_SESSION['H_user_id'];
        $user=D('user');
        $class=D('class');
        $history=D('history');
        $userlist=$user->table('user as u, userdata as ud')->field('u.*,ud.image,ud.integral')->where('u.user_id='.$uid.' and u.user_id=ud.uid')->find();
         $dianpu=$class->where('uid='.$uid)->find();
         $lishi=$history->where('uid='.$uid)->select();
        if($lishi){
            $a="";
            $b="";
            foreach ($lishi as $k=>$v){
                if( $v['type']==1){
                    $a.=$v['cid'].',';
                }else{
                    $b.=$v['cid'].',';
                }
               
            }
            $video=rtrim($a,',');
            $live=rtrim($b,',');
            $pin=D('video')->table('class as c,video as v,user as u,userdata as ud')->field('v.*,u.user_id,ud.image')->where('v.class_id=c.class_id and c.uid=u.user_id  and u.user_id=ud.uid and v.video_id in ('.$video.')')->select();
           
             $this->assign('pin',$pin);
             $this->assign('bo',$bo);
        }
         $news=D('news');
         $lists=$news->where('uid='.$uid.' and status=0 and tuisong=1')->select();
        if(!$lists){
            $n=D('newsread');
            $ns=$n->field('status')->where('uid='.$uid)->find();
        }
        //dump($list);
        $this->assign('ns',$ns);
        $this->assign('lists',$lists);
        $this->assign('dian',$dianpu);
        $this->assign('user',$userlist);
        }
        $uid=$_SESSION['H_user_id'];
        $id=$_GET['id'];
        $good=D('good');
        $goodlist=$good->where('good_id='.$id)->find();
        $ierecord=D('ierecord');
        $list=$ierecord->table('ierecord as i,good as g')->field('i.*,g.img,g.name')->where('i.gid=g.good_id')->limit(4)->select();
        $address=D('address');
        $addlist=$address->where('uid='.$uid)->find();
        $this->assign('good',$goodlist);
        $this->assign('address',$addlist);
        $this->assign('row',$list);
        $this->display('integral-gift');
   }
   public function add(){
                $uid=$_SESSION['H_user_id'];
                $address=D('address');
                $mvp['uname']=Sensitivefilter($_POST['uname']);
                $mvp['phone']=$_POST['phone'];
                $mvp['name']=Sensitivefilter($_POST['name']);
                $mvp['uid']=$uid;
                $res=$address->add($mvp);
                $m=D('ierecord');
                $userdata=D('userdata');
                $user=$userdata->where('uid='.$uid)->find();
                if($user['integral']>=$_POST['money']){
                
                $goodlist=D('good')->where('good_id='.$_POST['good'])->find();
                if($goodlist['stock']!=0){
                $jian=$userdata->where('uid='.$uid)->setDec('integral',$_POST['money']);
                $jiann=D('good')->where('good_id='.$_POST['good'])->setDec('stock');
                $mvp['gid']=$_POST['good'];
                $mvp['num']=$this->getRandomString(10);
                $mvp['money']=$_POST['money'];
                $mvp['address']=$_POST['name'];
                $mvp['uid']=$uid;
                $mvp['time']=time();
                $mvp['status']=1;
                $res=$m->add($mvp);

                if($res){
                    $integral=D('integral');
                    $data['uid']=$uid;
                    $data['type']=2;
                    $data['source']='兑换商品';
                    $data['time']=time();
                    $data['num']=$_POST['money'];
                    $integral->add($data);
                    $this->ajaxReturn('购买成功');
                }else{
                    $this->ajaxReturn('购买失败');
                }
              }else{
                $this->ajaxReturn('该商品库存为0，无法购买');
              }
            }else{
                $this->ajaxReturn('积分余额不足');
            }
   }
   public function xiu(){
                $uid=$_SESSION['H_user_id'];
                $address=D('address');
                $mvp['uname']=Sensitivefilter($_POST['uname']);
                $mvp['phone']=$_POST['phone'];
                $mvp['name']=Sensitivefilter($_POST['name']);
               
                $res=$address->where('uid='.$uid)->save($mvp);
                $m=D('ierecord');
                $userdata=D('userdata');
                $user=$userdata->where('uid='.$uid)->find();
                if($user['integral']>=$_POST['money']){
                $goodlist=D('good')->where('good_id='.$_POST['good'])->find();
                if($goodlist['stock']!=0){
                $jian=$userdata->where('uid='.$uid)->setDec('integral',$_POST['money']);

                 $jiann=D('good')->where('good_id='.$_POST['good'])->setDec('stock');
                $mvp['gid']=$_POST['good'];
                $mvp['num']=$this->getRandomString(10);
                $mvp['money']=$_POST['money'];
                $mvp['address']=$_POST['name'];
                $mvp['uid']=$uid;
                $mvp['time']=time();
                $mvp['status']=1;
                $res=$m->add($mvp);

                if($res){
                    $integral=D('integral');
                    $data['uid']=$uid;
                    $data['type']=2;
                    $data['source']='兑换商品';
                    $data['time']=time();
                    $data['num']=$_POST['money'];
                    $integral->add($data);
                    $this->ajaxReturn('购买成功');
                }else{
                    $this->ajaxReturn('购买失败');
                }
            }else{
                $this->ajaxReturn('该商品库存为0，无法购买');
              }

            }else{
                $this->ajaxReturn('积分余额不足');
            }
   }
   public function mai(){
                $uid=$_SESSION['H_user_id'];
                $m=D('ierecord');
                $userdata=D('userdata');
                $user=$userdata->where('uid='.$uid)->find();
                if($user['integral']>=$_POST['money']){
                $goodlist=D('good')->where('good_id='.$_POST['good'])->find();
                if($goodlist['stock']!=0){
                $jian=$userdata->where('uid='.$uid)->setDec('integral',$_POST['money']);
                 $jiann=D('good')->where('good_id='.$_POST['good'])->setDec('stock');
                $mvp['gid']=$_POST['good'];
                $mvp['num']=$this->getRandomString(10);
                $mvp['money']=$_POST['money'];
                $mvp['address']=$_POST['name'];
                $mvp['uid']=$uid;
                $mvp['time']=time();
                $mvp['status']=1;
                $res=$m->add($mvp);

                if($res){
                    $integral=D('integral');
                    $data['uid']=$uid;
                    $data['type']=2;
                    $data['source']='兑换商品';
                    $data['time']=time();
                    $data['num']=$_POST['money'];
                    $integral->add($data);
                    $this->ajaxReturn('购买成功');
                }else{
                    $this->ajaxReturn('购买失败');
                }
            }else{
                $this->ajaxReturn('该商品库存为0，无法购买');
              }
            }else{
                $this->ajaxReturn('积分余额不足');
            }
   }
   //收货地址
   public function address(){
    $id=session('H_user_id');
        $user=M('user');
        $userdata=M('userdata');
        $userrel=$user->where('user_id='.$id)->find();
        $userdatarel=$userdata->where('uid='.$id)->find();
        $sign=M('sign');
        $class=D('class');
            $history=D('history');
            $dianpu=$class->where('uid='.$id)->find();
             $lishi=$history->where('uid='.$id)->select();
            if($lishi){
                $a="";
                $b="";
                foreach ($lishi as $k=>$v){
                    if( $v['type']==1){
                        $a.=$v['cid'].',';
                    }else{
                        $b.=$v['cid'].',';
                    }
                   
                }
                $video=rtrim($a,',');
                $live=rtrim($b,',');
                $pin=D('video')->table('class as c,video as v,user as u,userdata as ud')->field('v.*,u.user_id,ud.image')->where('v.class_id=c.class_id and c.uid=u.user_id  and u.user_id=ud.uid and v.video_id in ('.$video.')')->select();
               
                 $this->assign('pin',$pin);
                 $this->assign('bo',$bo);
            }
             $news=D('news');
         $lists=$news->where('uid='.$id.' and status=0 and tuisong=1')->select();
        if(!$lists){
            $n=D('newsread');
            $ns=$n->field('status')->where('uid='.$id)->find();
        }
        //dump($list);
        $this->assign('ns',$ns);
        $this->assign('lists',$lists);
            $this->assign('dian',$dianpu);
        $signrel=$sign->where('uid='.$id)->find();
        $start_time = strtotime(date('Y-m-d'));
        if($signrel['time']>$start_time){
            $sign_status='1';   //已签到
        }else{
            $sign_status='0';   //未签到
        }
        $this->assign('sign_status',$sign_status);
        $this->assign('name',$userrel['name']);
        $this->assign('user',$userdatarel);
        $address=D('address');
        $res=$address->where('uid='.$id)->find();
        $this->assign('res',$res);
        $this->display('shipping-address');
   }
    public function xiugai(){
                $uid=$_SESSION['H_user_id'];
                $address=D('address');
                $mvp['uname']=Sensitivefilter($_POST['uname']);
                $mvp['phone']=$_POST['phone'];
                $mvp['name']=Sensitivefilter($_POST['name']);
                $res=$address->where('uid='.$uid)->save($mvp);

               if($res!==false){
                   $this->ajaxReturn('修改成功');
                }else{
                    $this->ajaxReturn('修改失败');
                }
   }
   public function addaddress(){
                $uid=$_SESSION['H_user_id'];
                $address=D('address');
                $mvp['uname']=Sensitivefilter($_POST['uname']);
                $mvp['phone']=$_POST['phone'];
                $mvp['name']=Sensitivefilter($_POST['name']);
                $mvp['uid']=$uid;
                $res=$address->add($mvp);
                if($res){
                $this->ajaxReturn('添加成功');
                }else{
                    $this->ajaxReturn('添加失败');
                }
   }
   //绑定页面
   public function bangding(){
    $id=session('H_user_id');
        $user=M('user');
        $userdata=M('userdata');
        $userrel=$user->where('user_id='.$id)->find();
        $userdatarel=$userdata->where('uid='.$id)->find();
        $sign=M('sign');
        $class=D('class');
            $history=D('history');
            $dianpu=$class->where('uid='.$id)->find();
             $lishi=$history->where('uid='.$id)->select();
            if($lishi){
                $a="";
                $b="";
                foreach ($lishi as $k=>$v){
                    if( $v['type']==1){
                        $a.=$v['cid'].',';
                    }else{
                        $b.=$v['cid'].',';
                    }
                   
                }
                $video=rtrim($a,',');
                $live=rtrim($b,',');
                $pin=D('video')->table('class as c,video as v,user as u,userdata as ud')->field('v.*,u.user_id,ud.image')->where('v.class_id=c.class_id and c.uid=u.user_id  and u.user_id=ud.uid and v.video_id in ('.$video.')')->select();
               
                 $this->assign('pin',$pin);
                 $this->assign('bo',$bo);
            }
             $news=D('news');
         $lists=$news->where('uid='.$id.' and status=0 and tuisong=1')->select();
        if(!$lists){
            $n=D('newsread');
            $ns=$n->field('status')->where('uid='.$id)->find();
        }
        //dump($list);
        $this->assign('ns',$ns);
        $this->assign('lists',$lists);
            $this->assign('dian',$dianpu);
        $signrel=$sign->where('uid='.$id)->find();
        $start_time = strtotime(date('Y-m-d'));
        if($signrel['time']>$start_time){
            $sign_status='1';   //已签到
        }else{
            $sign_status='0';   //未签到
        }
        $this->assign('sign_status',$sign_status);
        $this->assign('name',$userrel['name']);
        $this->assign('user',$userdatarel);
        
        $this->display('check-card');
   }   
   //绑定银行卡
   public function addbank(){
            $phone=I('post.phone');  //获取手机号  
            //$repass=I('post.repass');//验证密码
            $verify=I('post.verify');//获取验证码
            $uid=$_SESSION['H_user_id'];
             // 判断手机号是否存在
           
                // 判断验证码是否正确
                $yzm=M('verify');
                $reg=$yzm->where('phone='.$phone)->order('time desc')->find();
                if(!$reg || $reg['verify']!=$verify){
                    $this->ajaxReturn('验证码错误');
                }else{
                    // 判断验证码是否过期
                    $times=time()-$reg['time'];
                    if($times>300){
                        $yzm->where('verify_id='.$reg['verify_id'])->delete();
                        $this->ajaxReturn('验证码超时');
                    }else{ 
                        $mvp['name']=$_POST['name'];
                        $mvp['idcard']=$_POST['idcard'];
                        $mvp['phone']=$_POST['phone'];
                        $mvp['bankcard']=$_POST['bankcard'];
                        $mvp['bank']=$_POST['bank'];
                        $mvp['uid']=$uid;
                        $mvp['city']=$_POST['province'].$_POST['city'];
                        $mvp['type']=1;
                        $pay=D('pay');
                        $add=$pay->add($mvp);
                        $yzm->where('verify_id='.$reg['verify_id'])->delete();
                        $this->ajaxReturn('添加成功');
                        
                       
                    }
                }

        }
        //提现
        public function tixian(){
            $id=session('H_user_id');
        $user=M('user');
        $userdata=M('userdata');
        $userrel=$user->where('user_id='.$id)->find();
        $userdatarel=$userdata->where('uid='.$id)->find();
        $sign=M('sign');
        $class=D('class');
            $history=D('history');
            $dianpu=$class->where('uid='.$id)->find();
             $lishi=$history->where('uid='.$id)->select();
            if($lishi){
                $a="";
                $b="";
                foreach ($lishi as $k=>$v){
                    if( $v['type']==1){
                        $a.=$v['cid'].',';
                    }else{
                        $b.=$v['cid'].',';
                    }
                   
                }
                $video=rtrim($a,',');
                $live=rtrim($b,',');
                $pin=D('video')->table('class as c,video as v,user as u,userdata as ud')->field('v.*,u.user_id,ud.image')->where('v.class_id=c.class_id and c.uid=u.user_id  and u.user_id=ud.uid and v.video_id in ('.$video.')')->select();
               
                 $this->assign('pin',$pin);
                 $this->assign('bo',$bo);
            }
             $news=D('news');
         $lists=$news->where('uid='.$id.' and status=0 and tuisong=1')->select();
        if(!$lists){
            $n=D('newsread');
            $ns=$n->field('status')->where('uid='.$id)->find();
        }
        //dump($list);
        $this->assign('ns',$ns);
        $this->assign('lists',$lists);
            $this->assign('dian',$dianpu);
        $signrel=$sign->where('uid='.$id)->find();
        $start_time = strtotime(date('Y-m-d'));
        if($signrel['time']>$start_time){
            $sign_status='1';   //已签到
        }else{
            $sign_status='0';   //未签到
        }
        $classlist=$class->where('uid='.$id)->find();
        $pay=D('pay');
        $paylist=$pay->where('uid='.$id)->find();
        $ka=substr($paylist['bankcard'],-4);
        $this->assign('class',$classlist);
        $this->assign('ka',$ka);
        $this->assign('sign_status',$sign_status);
        $this->assign('name',$userrel['name']);
        $this->assign('user',$userdatarel);
        $this->display('with-drawal');
   } 
   public function addti(){
        $money=$_POST['yue'];
        $pass=$_POST['pass'];
        $class=D('class');
        $user=D('userdata');
        $uid=session('H_user_id');
        $res=$class->where('uid='.$uid)->find();
        if($res['profit']<$money){
            echo  "<script>alert('提现超额');window.location.href='".__MODULE__."/Me/index';</script>"; 
        }else{
            $u=$user->where('uid='.$uid)->find();
            if(empty($u['paypass'])){
                 echo  "<script>alert('请设置支付密码');window.location.href='".__MODULE__."/Me/index';</script>"; 
            }
            if($u['paypass']!=md5(md5($pass))){
                 echo  "<script>alert('密码不正确');window.location.href='".__MODULE__."/Me/index';</script>"; 
            }else{
                $jian=$class->where('uid='.$uid)->setDec('profit',$money);
                $tixian=D('withdraw');
                $pay=D('pay');
                $p=$pay->where('uid='.$uid)->find();
                $mvp['uid']=$uid;
                $mvp['money']=$money;
                $mvp['time']=time();
                $mvp['bankcard']=$p['bankcard'];
                $mvp['status']=0;
                $row=$tixian->add($mvp);
                 echo  "<script>alert('提现申请提交，请等待');window.location.href='".__MODULE__."/Me/index';</script>"; 
            }
        }
   }
   public function idcard(){
    $id=session('H_user_id');
        $user=M('user');
        $userdata=M('userdata');
        $userrel=$user->where('user_id='.$id)->find();
        $userdatarel=$userdata->where('uid='.$id)->find();
        $sign=M('sign');
        $class=D('class');
            $history=D('history');
            $dianpu=$class->where('uid='.$id)->find();
             $lishi=$history->where('uid='.$id)->select();
            if($lishi){
                $a="";
                $b="";
                foreach ($lishi as $k=>$v){
                    if( $v['type']==1){
                        $a.=$v['cid'].',';
                    }else{
                        $b.=$v['cid'].',';
                    }
                   
                }
                $video=rtrim($a,',');
                $live=rtrim($b,',');
                $pin=D('video')->table('class as c,video as v,user as u,userdata as ud')->field('v.*,u.user_id,ud.image')->where('v.class_id=c.class_id and c.uid=u.user_id  and u.user_id=ud.uid and v.video_id in ('.$video.')')->select();
               
                 $this->assign('pin',$pin);
                 $this->assign('bo',$bo);
            }
             $news=D('news');
         $lists=$news->where('uid='.$id.' and status=0 and tuisong=1')->select();
        if(!$lists){
            $n=D('newsread');
            $ns=$n->field('status')->where('uid='.$id)->find();
        }
        //dump($list);
        $this->assign('ns',$ns);
        $this->assign('lists',$lists);
            $this->assign('dian',$dianpu);
        $signrel=$sign->where('uid='.$id)->find();
        $start_time = strtotime(date('Y-m-d'));
        if($signrel['time']>$start_time){
            $sign_status='1';   //已签到
        }else{
            $sign_status='0';   //未签到
        }
        $classlist=$class->where('uid='.$id)->find();
        $pay=D('pay');
        $paylist=$pay->where('uid='.$id)->find();
        $wei=substr($paylist['bankcard'],-4);
        $tou=substr($paylist['bankcard'],0,4);
        $this->assign('class',$classlist);
        $this->assign('wei',$wei);
        $this->assign('tou',$tou);
        $this->assign('pay',$paylist);

        $this->assign('sign_status',$sign_status);
        $this->assign('name',$userrel['name']);
        $this->assign('user',$userdatarel);
        $this->display('id-card');
   }
   public function delka(){
        $pay=$_POST['payid'];
        $p=D('pay');
        $res=$p->where('pay_id='.$pay)->delete();
        if($res){
            echo 1;
        }else{
            echo 2;
        }
   }
    public function bcard(){
        $bankcard=I('post.card');
        $result=$this->bankCard_judge($bankcard);
        if(!$result){
            $this->ajaxReturn('没有查到该卡号');
        }
        $newbank=explode('-',$result);
        if($newbank['2']!='借记卡'){
            $this->ajaxReturn('该卡号不是借记卡');
        }else{
            $this->ajaxReturn($newbank['0']);
        }
            
   }
   public function player(){
    $id=$_GET['id'];
    $uid=session('H_user_id');
    $video=D('video');
    $class=D('class');
       $payvideo=M('payvideo');
       $mmp['status']='1';
       $payvideo->where(array('uid'=>$uid))->save($mmp);
    $videolist=$video->where('video_id='.$id)->find();
    $classrel=$class->where('class_id='.$videolist['class_id'])->find();
    $histroy=D('history');
    $histroylist=$histroy->where('uid='.$uid.' and type=1 and cid='.$id)->find();
    if(!$histroylist){
        $mvp['uid']=$uid;
        $mvp['type']='1';
        $mvp['cid']=$id;
        $mvp['time']=time();
        $add=$histroy->add($mvp);
    }
    if($classrel['uid']==$uid){
        $this->assign('comment_status','2');
    }else{
        $comment_video=M('comment_video');
        $where['video_id']=$id;
        $where['uid']=$uid;
        $rel=$comment_video->where($where)->find();
        if($rel){
            $this->assign('comment_status','1');
        }else{
            $this->assign('comment_status','0');
        }
    }
    
    
    // $videolists=$video->where('class_id='.$videolist['class_id'])->select();
    $this->assign('list',$videolist);
    // $this->assign('lists',$videolists);
    $this->display('play-interface');
   }


// ****************** 评论 ****************************
   public function comment(){
        $star=I('post.num');
        $content=Sensitivefilter(I('post.neirong'));
        $video_id=I('post.videoid');
        $comment_video=M('comment_video');
        $uid=session('H_user_id');
        $commentrel=$comment_video->where(array('uid'=>$uid,'video_id'=>$video_id))->find();
        if($commentrel){
            $this->ajaxReturn('3');exit;
        }
        $mvp['star']=$star;
        $mvp['content']=$content;
        $mvp['video_id']=$video_id;
        $mvp['uid']=session('H_user_id');
        $mvp['time']=time();
        $result=$comment_video->add($mvp);
        $comment_video_star=M('comment_video_star');
        $comment_video_starrel=$comment_video_star->where(array('video_id'=>$video_id))->find();
        if($comment_video_starrel){
            $mmp['star']=$comment_video_starrel['star']+$star;
            $mmp['num']=$comment_video_starrel['num']+1;
            $comment_video_starresult=$comment_video_star->where(array('comment_video_star_id'=>$comment_video_starrel['comment_video_star_id']))->save($mmp);
        }else{
            $mmp['video_id']=$video_id;
            $mmp['star']=$star;
            $mmp['num']=1;
            $comment_video_starresult=$comment_video_star->add($mmp);
        }
        if($result && $comment_video_starresult){
            $this->ajaxReturn('1');
        }else{
            $this->ajaxReturn('2');
        }
   }
// ****************** 直播评论 ****************************
   public function comment_liveb(){
        $star=I('post.num');
        $liveb_id=I('post.livebid');
        $liveb_content=Sensitivefilter(I('post.livebcontent'));
        $uid=session('H_user_id');
        $comment_liveb=M('comment_liveb');
        $comment_livebrel=$comment_liveb->where(array('uid'=>$uid,'liveb_id'=>$liveb_id))->find();
        if($comment_livebrel){
            $this->ajaxReturn('3');exit;
        }
        $class=M('class');
        $liveb=M('liveb');
        $livebrel=$liveb->where('liveb_id='.$liveb_id)->find();
        $classrel=$class->where('class_id='.$livebrel['class_id'])->find();
        $mvp['uid']=$uid;
        $mvp['star']=$star;
        $mvp['tid']=$classrel['uid'];
        $mvp['liveb_id']=$liveb_id;
        $mvp['content']=$liveb_content;
        $mvp['time']=time();
        $result=$comment_liveb->add($mvp);
        $comment_liveb_star=M('comment_liveb_star');
        $comment_liveb_starrel=$comment_liveb_star->where(array('tid'=>$classrel['uid']))->find();
        if($comment_liveb_starrel){
            $mmp['star']=$comment_liveb_starrel['star']+$star;
            $mmp['num']=$comment_liveb_starrel['num']+1;
            $comment_liveb_starresult=$comment_liveb_star->where(array('comment_liveb_star_id'=>$comment_liveb_starrel['comment_liveb_star_id']))->save($mmp);
        }else{
            $mmp['tid']=$classrel['uid'];
            $mmp['star']=$star;
            $mmp['num']=1;
            $comment_liveb_starresult=$comment_liveb_star->add($mmp);
        }
        if($result && $comment_liveb_starresult){
            $this->ajaxReturn('1');
        }else{
            $this->ajaxReturn('2');
        }

   }
}
