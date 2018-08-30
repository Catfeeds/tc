<?php
namespace Home\Controller;
use Think\Controller;
header('Content-Type:text/html;charset=utf-8');
// header("Access-Control-Allow-Origin: *");
class NewsController extends CommonController {
	public function index(){
		$uid=$_SESSION['H_user_id'];
		if($_SESSION['H_user_id']){
		
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

		$news=D('news');
		$notice=D('notice');
		//$count1 = $news->where('uid is null and tuisong=1')->count();
		//$count2 = $news->where('tuisong=1 and uid='.$uid." and title like '%提现%'")->count(); 
		$count3 = $news->where('tuisong=1 and uid='.$uid." and title like '%资质%'")->count(); 
		//$Page1 = new \Think\Page($count1,10);
		//$Page2 = new \Think\Page($count2,10);
		$Page3 = new \Think\Page($count3,10);
		//$newslist1=$news->where('uid is null and tuisong=1')->limit($Page1 -> firstRow.','.$Page1 -> listRows)->order('time desc')->select();
		//$newslist2=$news->where('tuisong=1 and uid='.$uid." and title like '%提现%'")->limit($Page2 -> firstRow.','.$Page2 -> listRows)->order('time desc')->select();
		$newslist3=$news->where('tuisong=1 and uid='.$uid." and title like '%资质%'")->limit($Page3 -> firstRow.','.$Page3 -> listRows)->order('time desc')->select();
		//$show1 = $Page1 ->show();
		//$show2 = $Page2 ->show();
		$show3 = $Page3 ->show();
		//dump($newslist);
		//$count4 = $notice->where('status=2')->count();
		//$Page4 = new \Think\Page($count4,10);
		//$noticelist=$notice->where('status=2')->limit($Page4 -> firstRow.','.$Page4 -> listRows)->order('time desc')->select();
		//$show4 = $Page4 ->show();
		//dump($noticelist);
		$mvp['status']=1;
		/*$newslists1=$news->where('uid is null and tuisong=1')->save($mvp);*/
		$n=D('newsread');
		$nnn=$n->where('uid='.$uid)->save($mvp);
		$newslists2=$news->where('tuisong=1 and uid='.$uid." and title like '%提现%'")->save($mvp);
		$newslists3=$news->where('tuisong=1 and uid='.$uid." and title like '%资质%'")->save($mvp);
		//$this->assign('row1',$newslist1);
		//$this->assign('row2',$newslist2);
		$this->assign('row3',$newslist3);
		//$this->assign('res',$noticelist);
		//$this->assign('show1',$show1);
		//$this->assign('show2',$show2);
		$this->assign('show3',$show3);
		//$this->assign('show4',$show4);
		$this->display('news');
	}
	public function news1(){
		$uid=$_SESSION['H_user_id'];
		if($_SESSION['H_user_id']){
		
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
		$news=D('news');
		$notice=D('notice');
		$count1 = $news->where('uid is null and tuisong=1')->count();
		//$count2 = $news->where('tuisong=1 and uid='.$uid." and title like '%提现%'")->count(); 
		//$count3 = $news->where('tuisong=1 and uid='.$uid." and title like '%资质%'")->count(); 
		$Page1 = new \Think\Page($count1,10);
		//$Page2 = new \Think\Page($count2,10);
		//$Page3 = new \Think\Page($count3,10);
		$newslist1=$news->where('uid is null and tuisong=1')->limit($Page1 -> firstRow.','.$Page1 -> listRows)->order('time desc')->select();
		//$newslist2=$news->where('tuisong=1 and uid='.$uid." and title like '%提现%'")->limit($Page2 -> firstRow.','.$Page2 -> listRows)->order('time desc')->select();
		//$newslist3=$news->where('tuisong=1 and uid='.$uid." and title like '%资质%'")->limit($Page3 -> firstRow.','.$Page3 -> listRows)->order('time desc')->select();
		$show1 = $Page1 ->show();
		//$show2 = $Page2 ->show();
		//$show3 = $Page3 ->show();
		//dump($newslist);
		//$count4 = $notice->where('status=2')->count();
		//$Page4 = new \Think\Page($count4,10);
		//$noticelist=$notice->where('status=2')->limit($Page4 -> firstRow.','.$Page4 -> listRows)->order('time desc')->select();
		//$show4 = $Page4 ->show();
		//dump($noticelist);
		$mvp['status']=1;
		$n=D('newsread');
		$nnn=$n->where('uid='.$uid)->save($mvp);
		$newslists2=$news->where('tuisong=1 and uid='.$uid." and title like '%提现%'")->save($mvp);
		$newslists3=$news->where('tuisong=1 and uid='.$uid." and title like '%资质%'")->save($mvp);
		$this->assign('row1',$newslist1);
		//$this->assign('row2',$newslist2);
		//$this->assign('row3',$newslist3);
		//$this->assign('res',$noticelist);
		$this->assign('show1',$show1);
		//$this->assign('show2',$show2);
		//$this->assign('show3',$show3);
		//$this->assign('show4',$show4);
		$this->display('news1');
	}
	public function news2(){
		$uid=$_SESSION['H_user_id'];
		if($_SESSION['H_user_id']){
		
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
		$news=D('news');
		$notice=D('notice');
		//$count1 = $news->where('uid is null and tuisong=1')->count();
		$count2 = $news->where('tuisong=1 and uid='.$uid." and title like '%提现%'")->count(); 
		//$count3 = $news->where('tuisong=1 and uid='.$uid." and title like '%资质%'")->count(); 
		//$Page1 = new \Think\Page($count1,10);
		$Page2 = new \Think\Page($count2,10);
		//$Page3 = new \Think\Page($count3,10);
		//$newslist1=$news->where('uid is null and tuisong=1')->limit($Page1 -> firstRow.','.$Page1 -> listRows)->order('time desc')->select();
		$newslist2=$news->where('tuisong=1 and uid='.$uid." and title like '%提现%'")->limit($Page2 -> firstRow.','.$Page2 -> listRows)->order('time desc')->select();
		//$newslist3=$news->where('tuisong=1 and uid='.$uid." and title like '%资质%'")->limit($Page3 -> firstRow.','.$Page3 -> listRows)->order('time desc')->select();
		//$show1 = $Page1 ->show();
		$show2 = $Page2 ->show();
		//$show3 = $Page3 ->show();
		//dump($newslist);
		//$count4 = $notice->where('status=2')->count();
		//$Page4 = new \Think\Page($count4,10);
		//$noticelist=$notice->where('status=2')->limit($Page4 -> firstRow.','.$Page4 -> listRows)->order('time desc')->select();
		//$show4 = $Page4 ->show();
		//dump($noticelist);
		$mvp['status']=1;
		$n=D('newsread');
		$nnn=$n->where('uid='.$uid)->save($mvp);
		$newslists2=$news->where('tuisong=1 and uid='.$uid." and title like '%提现%'")->save($mvp);
		$newslists3=$news->where('tuisong=1 and uid='.$uid." and title like '%资质%'")->save($mvp);
		//$this->assign('row1',$newslist1);
		$this->assign('row2',$newslist2);
		//$this->assign('row3',$newslist3);
		//$this->assign('res',$noticelist);
		//$this->assign('show1',$show1);
		$this->assign('show2',$show2);
		//$this->assign('show3',$show3);
		//$this->assign('show4',$show4);
		$this->display('news2');
	}
	public function news3(){
		$uid=$_SESSION['H_user_id'];
		if($_SESSION['H_user_id']){
		
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
		$news=D('news');
		$notice=D('notice');
		//$count1 = $news->where('uid is null and tuisong=1')->count();
		//$count2 = $news->where('tuisong=1 and uid='.$uid." and title like '%提现%'")->count(); 
		//$count3 = $news->where('tuisong=1 and uid='.$uid." and title like '%资质%'")->count(); 
		//$Page1 = new \Think\Page($count1,10);
		//$Page2 = new \Think\Page($count2,10);
		//$Page3 = new \Think\Page($count3,10);
		//$newslist1=$news->where('uid is null and tuisong=1')->limit($Page1 -> firstRow.','.$Page1 -> listRows)->order('time desc')->select();
		//$newslist2=$news->where('tuisong=1 and uid='.$uid." and title like '%提现%'")->limit($Page2 -> firstRow.','.$Page2 -> listRows)->order('time desc')->select();
		//$newslist3=$news->where('tuisong=1 and uid='.$uid." and title like '%资质%'")->limit($Page3 -> firstRow.','.$Page3 -> listRows)->order('time desc')->select();
		//$show1 = $Page1 ->show();
		//$show2 = $Page2 ->show();
		//$show3 = $Page3 ->show();
		//dump($newslist);
		$count4 = $notice->where('status=2')->count();
		$Page4 = new \Think\Page($count4,10);
		$noticelist=$notice->where('status=2')->limit($Page4 -> firstRow.','.$Page4 -> listRows)->order('time desc')->select();
		$show4 = $Page4 ->show();
		//dump($noticelist);
		$mvp['status']=1;
		$n=D('newsread');
		$nnn=$n->where('uid='.$uid)->save($mvp);
		$newslists2=$news->where('tuisong=1 and uid='.$uid." and title like '%提现%'")->save($mvp);
		$newslists3=$news->where('tuisong=1 and uid='.$uid." and title like '%资质%'")->save($mvp);
		//$this->assign('row1',$newslist1);
		//$this->assign('row2',$newslist2);
		//$this->assign('row3',$newslist3);
		$this->assign('res',$noticelist);
		//$this->assign('show1',$show1);
		//$this->assign('show2',$show2);
		//$this->assign('show3',$show3);
		$this->assign('show4',$show4);
		$this->display('news3');
	}
}