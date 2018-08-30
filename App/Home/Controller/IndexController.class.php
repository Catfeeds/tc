<?php

/******************************
 *
 * 时间；2018.1.8
 * 功能：pc首页
 * 作者：Mr Peng
 *
 *****************************/ 

namespace Home\Controller;
use Think\Controller;
header('Content-Type:text/html;charset=utf-8');
header("Access-Control-Allow-Origin: *");
class IndexController extends Controller {


    public function index(){
        $user=D('user');
        $class=D('class');
        if(session('H_user_id')){
        $uid=session('H_user_id');
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
           
            $shipin=D('video')->table('class as c,video as v,user as u,userdata as ud')->field('v.*,u.user_id,ud.image')->where('v.class_id=c.class_id and c.uid=u.user_id  and u.user_id=ud.uid and v.video_id in ('.$video.')')->select();
          
             $this->assign('pin',$shipin);
             $this->assign('bo',$zhibo);
        }
        $news=D('news');
       $lists=$news->where('uid='.$uid.' and status=0 and tuisong=1')->select();
        if(!$lists){
            $n=D('newsread');

            $ns=$n->field('status')->where('uid='.$uid)->find();
           
            if(!$ns){
                $mvp['uid']=$uid;
                $mvp['status']='1';
                $n->add($mvp);
            }
        }
        //dump($list);
        $this->assign('ns',$ns);
        $this->assign('lists',$lists);
        $this->assign('dian',$dianpu);
        $this->assign('user',$userlist);
        

        }
        //轮播
        $lunbo=M('lunbo');
        $lunbo_list=$lunbo->order('num desc')->where('status=0')->where('pc=1')->limit(4)->select();
        $this->assign('lunbo_list',$lunbo_list);
        // 分类
        $cate=M('category');
        $where['pid']='0';
        $where['name']=array('neq','推荐');
        $list=$cate->where($where)->limit(5)->select();
        foreach($list as $k=>$v){
            $list[$k]['cate_son']=$cate->where('pid='.$v['cate_id'])->limit(3)->select();
            $list[$k]['cate_sons']=$cate->where('pid='.$v['cate_id'])->select();
            $list[$k]['course']=M('liveb')->where('cate_id='.$v['cate_id'].' and recommend=1')->limit(4)->select();
        }
        $this->assign('list',$list);
        // 实战推荐
        $liveb=M('liveb');
        $time=time();
        $liveb_list=$liveb->where('recommend=1'.' and endtime >'.$time)->limit(5)->select();
        $this->assign('liveb_list',$liveb_list);
        // $advert=M('advert');
        // $advert_list=$advert->order('num desc')->limit(1)->select();
        // $advert_img=$advert_list[0]['img'];
        // dump($advert_img);
        // $this->assign('advert_img',$advert_img);
        // 语言学习
        $yuyan=$cate->where('pid=2')->limit(8)->select();
        foreach($yuyan as $v){
            $yuyan_id.=$v['cate_id'].',';
        }
        $live=rtrim($yuyan_id,',');
        //$where['cate_id']=array('IN',$yuyan_id);
        $time=time();
        $yuyan_liveb=$liveb->where('cate_id in ('.$live.',2'.')'.' and endtime >'.$time)->limit(8)->select();
        $this->assign('yuyan',$yuyan);
        $this->assign('yuyan_liveb',$yuyan_liveb);
        //亲子教育
        $qinzi=$cate->where('pid=4')->limit(8)->select();
        foreach($qinzi as $v){
            $qinzi_id.=$v['cate_id'].',';
        }
        $live=rtrim($qinzi_id,',');
        //$where['cate_id']=array('IN',$qinzi_id);
        $qinzi_liveb=$liveb->where('cate_id in ('.$live.',4'.')'.' and endtime >'.$time)->limit(8)->select();
        $this->assign('qinzi',$qinzi);
        $this->assign('qinzi_liveb',$qinzi_liveb);
        // 办公效率
        $bangong=$cate->where('pid=3')->limit(8)->select();
        foreach($bangong as $v){
            $bangong_id.=$v['cate_id'].',';
        }
         $live=rtrim($bangong_id,',');
        //$where['cate_id']=array('IN',$bangong_id);
        $bangong_liveb=$liveb->where('cate_id in ('.$live.',3'.')'.' and endtime >'.$time)->limit(8)->select();
        $this->assign('bangong',$bangong);
        $this->assign('bangong_liveb',$bangong_liveb);
        // 职业发展
        $zhiye=$cate->where('pid=5')->limit(8)->select();
        foreach($zhiye as $v){
            $zhiye_id.=$v['cate_id'].',';
        }
        $live=rtrim($zhiye_id,',');
        //$where['cate_id']=array('IN',$zhiye_id);
        $zhiye_liveb=$liveb->where('cate_id in ('.$live.',5'.')'.' and endtime >'.$time)->limit(8)->select();
        $this->assign('zhiye',$zhiye);
        $this->assign('zhiye_liveb',$zhiye_liveb);
        // 产品开发
        $chanpin=$cate->where('pid=14')->limit(8)->select();
        foreach($chanpin as $v){
            $chanpin_id.=$v['cate_id'].',';
        }
        $live=rtrim($chanpin_id,',');
        //$where['cate_id']=array('IN',$chanpin_id);
        $chanpin_liveb=$liveb->where('cate_id in ('.$live.',14'.')'.' and endtime >'.$time)->limit(8)->select();
        $this->assign('chanpin',$chanpin);
        $this->assign('chanpin_liveb',$chanpin_liveb);
        $this->display();
   
    }


  public function search(){
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
        $this->assign('list',$list);
        $this->assign('dian',$dianpu);
        $this->assign('user',$userlist);
      

        }
                $search=trim($_POST['sousuo']);

                $video=D('video');
                $class=D('class');
                $live=D('liveb');
                $class=D('class');
                $time=time();
                $count1 = $live->where("name like '%$search%'".' and endtime >'.$time)->count();
                
                $Page1 = new \Think\Page($count1,20);
               
                $livelist=$live->where("name like '%$search%'".' and endtime >'.$time)->limit($Page1 -> firstRow.','.$Page1 -> listRows)->select();
                $show1 = $Page1 ->show();
                
                $this->assign('live',$livelist);
                $this->assign('show1',$show1);
                $this->assign('search',$search);
                $this->assign('rew',$res);
                $this->assign('row',$row);
                $this->display();
           
         
    }
    public function live(){
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
        $this->assign('list',$list);
        $this->assign('dian',$dianpu);
        $this->assign('user',$userlist);
      

        }
                $search=$_GET['search'];

                $video=D('video');
                $class=D('class');
                $live=D('liveb');
                $class=D('class');
                $time=time();
                $count1 = $live->where("name like '%$search%'".' and endtime >'.$time)->count();
                $Page1 = new \Think\Page($count1,20);
                $livelist=$live->where("name like '%$search%'".' and endtime >'.$time)->limit($Page1 -> firstRow.','.$Page1 -> listRows)->select();
                $show1 = $Page1 ->show();
            
                $this->assign('live',$livelist);
                $this->assign('show1',$show1);
                $this->assign('rew',$res);
                $this->assign('search',$search);
                $this->assign('row',$row);
                $this->display('search');
           
         
    }
    public function video(){
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
        $this->assign('list',$list);
        $this->assign('dian',$dianpu);
        $this->assign('user',$userlist);
      

        }
                $search=$_GET['search'];

                $video=D('video');
                $class=D('class');
                $live=D('liveb');
                $class=D('class');
                //$count1 = $live->where("name like '%$search%'")->count();
                //echo $count;
                $count2 = $video->where("name like '%$search%'")->count();
                //dump($count2);
                //$count3 = $class->where("name like '%$search%'")->count();
                //$Page1 = new \Think\Page($count1,20);
                $Page2 = new \Think\Page($count2,20);
                //$Page3 = new \Think\Page($count3,20);
                //dump($row);class
                $videolist=$video->where("name like '%$search%'")->limit($Page2 -> firstRow.','.$Page2 -> listRows)->select();
               //$classlist=$class->table('class as c, user as u')->field('c.*,u.user_id')->where("c.name like '%$search%' and c.uid=u.user_id")->limit($Page3 -> firstRow.','.$Page3 -> listRows)->select();
                //$livelist=$live->where("name like '%$search%'")->limit($Page1 -> firstRow.','.$Page1 -> listRows)->select();
                //$show1 = $Page1 ->show();
                //dump($show1);
                $show2 = $Page2 ->show();
                //$show3 = $Page3 ->show();
                $this->assign('video',$videolist);
               //$this->assign('class',$classlist);
                //$this->assign('live',$livelist);
                //$this->assign('show1',$show1);
                $this->assign('show2',$show2);
                //$this->assign('show3',$show3);
                $this->assign('search',$search);
                $this->assign('rew',$res);
                $this->assign('row',$row);
                $this->display('search-video');
           
         
    }   
    public function ketang(){
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
        $this->assign('list',$list);
        $this->assign('dian',$dianpu);
        $this->assign('user',$userlist);
      

        }
                $search=$_GET['search'];

                $video=D('video');
                $class=D('class');
                $live=D('liveb');
                $class=D('class');
                //$count1 = $live->where("name like '%$search%'")->count();
                //echo $count;
                //$count2 = $video->where("name like '%$search%'")->count();
                $count3 = $class->where("name like '%$search%'")->count();
                //$Page1 = new \Think\Page($count1,20);
                //$Page2 = new \Think\Page($count2,20);
                $Page3 = new \Think\Page($count3,20);
                //dump($row);class
                //$videolist=$video->where("name like '%$search%'")->limit($Page2 -> firstRow.','.$Page2 -> listRows)->select();
               $classlist=$class->table('class as c, user as u')->field('c.*,u.user_id')->where("c.name like '%$search%' and c.uid=u.user_id")->limit($Page3 -> firstRow.','.$Page3 -> listRows)->select();
                //$livelist=$live->where("name like '%$search%'")->limit($Page1 -> firstRow.','.$Page1 -> listRows)->select();
                //$show1 = $Page1 ->show();
                //dump($show1);
                //$show2 = $Page2 ->show();
                $show3 = $Page3 ->show();
                //$this->assign('video',$videolist);
               $this->assign('class',$classlist);
                //$this->assign('live',$livelist);
                //$this->assign('show1',$show1);
                //$this->assign('show2',$show2);
                $this->assign('show3',$show3);
                $this->assign('search',$search);
                $this->assign('rew',$res);
                $this->assign('row',$row);
                $this->display('search-class');
           
         
    }  
    public function qrcode(){
        $this->display('QR-code');
    }    
}