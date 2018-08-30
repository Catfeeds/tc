<?php
namespace Home\Controller;
use Think\Controller;
header('Content-Type:text/html;charset=utf-8');
// header("Access-Control-Allow-Origin: *");
class FeedbackController extends CommonController {
    public function index(){
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
            /*$bo=D('liveb')->table('class as c,liveb as l,user as u,userdata as ud')->field('l.*,u.user_id,ud.image')->where('l.class_id=c.class_id and c.uid=u.user_id  and u.user_id=ud.uid and l.liveb_id in ('.$live.')')->select();*/
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
    	$text=Sensitivefilter(I('post.text'));
        $contact=('post.contact');
        if($text==''){
          
           $this->ajaxReturn('反馈内容不能为空');
        }else{
            $feedback=M('feedback');
            $mvp['text']=$text;
            $mvp['time']=time();
            $mvp['contact']=$contact;
            $rel=$feedback->add($mvp);
            if($rel){
                $this->ajaxReturn('反馈成功');
            }else{
               $this->ajaxReturn('反馈失败');
            }
        }
    }
        
        $this->display();
    
}
     public function wenti(){
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
        $wenti=D('wenti');
        $list=$wenti->select();
        $this->assign('list',$list);
        $this->display('Common-problems');
     }
     public function lianxi(){
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
        $wenti=D('lianxi');
        $list=$wenti->select();
        $this->assign('list',$list);
        $this->display('Contact-us');
     }
     public function about(){
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
        $wenti=D('aboutus');
        $list=$wenti->select();
        $this->assign('list',$list);
        $this->display('about-us');
     }
     public function xieyi(){
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
        $wenti=D('xieyi');
        $list=$wenti->where('type=0')->select();
        //dump($list);
        $this->assign('list',$list);
        $this->display('xieyi');
     }
     public function xieyi1(){
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
        $wenti=D('xieyi');
        $id=$_GET['id'];
        $list=$wenti->where('xieyi_id='.$id)->find();
        $this->assign('list',$list);
        $this->display('xieyi1'); 
     }
}