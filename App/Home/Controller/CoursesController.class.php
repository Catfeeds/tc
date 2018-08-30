<?php
namespace Home\Controller;
use Think\Controller;
header('Content-Type:text/html;charset=utf-8');
header("Access-Control-Allow-Origin: http://www.wyuek.com");
class CoursesController extends Controller {
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
            $time=time();
            $pin=D('video')->table('class as c,video as v,user as u,userdata as ud')->field('v.*,u.user_id,u.name as uname,ud.image')->where('v.class_id=c.class_id and c.uid=u.user_id and  u.user_id=ud.uid and v.video_id in ('.$video.')')->select();
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
		$cate=D('category');
		$class=D('class');
		$live=D('liveb');
		$video=D('video');
		$count1 = $live->count();
		$Page1 = new \Think\Page($count1,20);
		$res=$cate->where('pid=0 && cate_id!=1')->select();
		$row=$cate->where('pid=2')->select();
	
		$active=$cate->where('cate_id=2')->find();
		$this->assign('active',$active);
			$arr="";
			$count=count($row);
			for($i = 0; $i < $count; $i++){
				if(($i+1)==$count){
				$arr .= $row[$i]['cate_id'];
				}else{
				 $arr .= $row[$i]['cate_id'].',';
				}
			}
		$time=time();
		$count1 = $live->where( "cate_id in (".$arr.",2)".' and endtime >'.$time)->count();
		$Page1 = new \Think\Page($count1,20);
		$time=time();

				$livelist=$live->where( "cate_id in (".$arr.",2)".' and endtime >'.$time)->limit($Page1 -> firstRow.','.$Page1-> listRows)->order('money asc')->select();
		   
		
	    $show1 = $Page1 ->show();
	    
		$this->assign('live',$livelist);
		$this->assign('show1',$show1);
		
		$this->assign('rew',$res);
		$this->assign('row',$row);
		$this->display();
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
            $time=time();
            $pin=D('video')->table('class as c,video as v,user as u,userdata as ud')->field('v.*,u.user_id,u.name as uname,ud.image')->where('v.class_id=c.class_id and c.uid=u.user_id and  u.user_id=ud.uid and v.video_id in ('.$video.')')->select();
             $this->assign('pin',$pin);
             $this->assign('bo',$bo);
        }
        $news=D('news');
        $lists=$news->where('uid='.$uid.' and status=0 and tuisong=1')->select();
        if(!$lists){
        	$n=D('newsread');
        	$ns=$n->field('status')->where('uid='.$uid)->find();
        }
        
        $this->assign('ns',$ns);
        $this->assign('lists',$lists);
        $this->assign('dian',$dianpu);
		$this->assign('user',$userlist);
	    }
		$cate=D('category');
		$class=D('class');
		
		$live=D('liveb');
		$video=D('video');
		$count1 = $live->count();
		
		$Page1 = new \Think\Page($count1,20);
		
		$res=$cate->where('pid=0 && cate_id!=1')->select();
		//dump($res);   
		$row=$cate->where('pid=2')->select();
	
		$active=$cate->where('cate_id=2')->find();
		$this->assign('active',$active);
			$arr="";
			$count=count($row);
			//echo $count3;
			for($i = 0; $i < $count; $i++){
				if(($i+1)==$count){
				$arr .= $row[$i]['cate_id'];
				}else{
				 $arr .= $row[$i]['cate_id'].',';
				}
			}
		$time=time();
		
		$count2 = $video->where( "cate_id in (".$arr.",2)")->count();
		
		$Page2 = new \Think\Page($count2,20);
		//$Page3 = new \Think\Page($count3,20);*/
		$time=time();
		       $videolist=$video->where( "cate_id in (".$arr.",2)")->order('number desc')->limit($Page2 -> firstRow.','.$Page2-> listRows)->select();
		     
	    $show2 = $Page2 ->show();
	    
		$this->assign('video',$videolist);
		
		$this->assign('show1',$show2);
	
		$this->assign('rew',$res);
		$this->assign('row',$row);
		$this->display();
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
            $time=time();
            $pin=D('video')->table('class as c,video as v,user as u,userdata as ud')->field('v.*,u.user_id,u.name as uname,ud.image')->where('v.class_id=c.class_id and c.uid=u.user_id and  u.user_id=ud.uid and v.video_id in ('.$video.')')->select();
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
		$cate=D('category');
		$class=D('class');
		//session('H_user_id',12);
		$live=D('liveb');
		$video=D('video');
		
		$count3 = $class->count();
		
		$Page3 = new \Think\Page($count3,20);
		$res=$cate->where('pid=0 && cate_id!=1')->select();
		//dump($res);   
		$row=$cate->where('pid=2')->select();
	
		$active=$cate->where('cate_id=2')->find();
		$this->assign('active',$active);
			$arr="";
			$count=count($row);
			//echo $count3;
			for($i = 0; $i < $count; $i++){
				if(($i+1)==$count){
				$arr .= $row[$i]['cate_id'];
				}else{
				 $arr .= $row[$i]['cate_id'].',';
				}
			}
		$time=time();
		
		$count3 = $class->where( "cate_id in (".$arr.",2)")->count();
		$Page3 = new \Think\Page($count3,20);
		
		$time=time();
		    
		        $classlist=$class->table('class as c, user as u')->field('c.*,u.user_id')->where("cate_id in (".$arr.",2)".' and c.uid=u.user_id')->limit($Page3 -> firstRow.','.$Page3-> listRows)->select();

				
	    $show1 = $Page3 ->show();
	    
		$this->assign('class',$classlist);
		//$this->assign('live',$livelist);
		$this->assign('show1',$show1);
		
		$this->assign('rew',$res);
		$this->assign('row',$row);
		$this->display();
	}
	public function fenxiang(){

		$url=$_GET['url'];
		$id=$_GET['id'];
		$pid=$_GET['pid'];
		vendor('Wxshare.jssdk');
	    $jssdk = new \JSSDK("wx76b04f25405b5dbe", "984e9aadee073da747faec2576a0bf24",$url);
	    $signPackage = $jssdk->getSignPackage();
	    $signPackage['jsApiList'] = array('onMenuShareTimeline','onMenuShareAppMessage');
        $signPackage['debug'] = true;
        $video=D('video');
		//session('H_user_id',12);
		$live=D('liveb');
		$class=D('class');
		if($id){
			$videolist=$video->table('class as c,video as v,user as u,userdata as ud')->field('v.*,u.user_id,ud.image')->where('v.class_id=c.class_id and c.uid=u.user_id and  u.user_id=ud.uid and v.video_id='.$id)->find();
			// dump($videolist);
			// dump($zhibo);
			$videolist['img']=$videolist['img'];
			$signPackage['kecheng'] = $videolist;
		}else{
			$livelist=$live->table('class as c,liveb as l,user as u,userdata as ud')->field('l.*,u.user_id,ud.image')->where('l.class_id=c.class_id and c.uid=u.user_id  and u.user_id=ud.uid and l.liveb_id='.$pid)->find();
			$livelist['img']=URL.$livelist['img'];
			$signPackage['kecheng'] = $livelist;
		}
      echo json_encode($signPackage);
	}

	public function show(){
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
            $time=time();
            $pin=D('video')->table('class as c,video as v,user as u,userdata as ud')->field('v.*,u.user_id,u.name as uname,ud.image')->where('v.class_id=c.class_id and c.uid=u.user_id  and u.user_id=ud.uid and v.video_id in ('.$video.')')->select();
           
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
		$id=$_GET['id'];
		$cate=D('category');
		$class=D('class');
		$live=D('liveb');
		$video=D('video');

		$active=$cate->where('cate_id='.$id)->find();
		$this->assign('active',$active);

		$res=$cate->where('pid=0 && cate_id!=1')->select();
		$lei=$cate->where('pid='.$id)->select();
		$time=time();
			$arr="";
			$count=count($lei);
			//echo $count3;
			for($i = 0; $i < $count; $i++){
				if(($i+1)==$count){
				$arr .= $lei[$i]['cate_id'];
				}else{
				 $arr .= $lei[$i]['cate_id'].',';
				}
			}
		if($arr){
				$count1 = $live->where( "cate_id in (".$arr.",".$id.")".' and endtime >'.$time)->count();
		
		$Page1 = new \Think\Page($count1,20);
		
		$time=time();
		      
				$livelist=$live->where( "cate_id in (".$arr.",".$id.")".' and endtime >'.$time)->limit($Page1 -> firstRow.','.$Page1-> listRows)->order('money asc')->select();
		    }else{
		    	$time=time();
		    	$count1 = $live->where( "cate_id=".$id.' and endtime >'.$time)->count();
		
		$Page1 = new \Think\Page($count1,20);
		
		$time=time();
		      

				$livelist=$live->where( "cate_id=".$id.' and endtime >'.$time)->limit($Page1 -> firstRow.','.$Page1-> listRows)->order('money asc')->select();
		    }
	    $show1 = $Page1 ->show();
	    
		$this->assign('rew',$res);
		$this->assign('arr',$arr);
		$this->assign('row',$lei);
		
		$this->assign('live',$livelist);
		$this->assign('show1',$show1);
		
		$this->display('index');

	}
	public function videoshow(){
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
            $time=time();
            $pin=D('video')->table('class as c,video as v,user as u,userdata as ud')->field('v.*,u.user_id,u.name as uname,ud.image')->where('v.class_id=c.class_id and c.uid=u.user_id  and u.user_id=ud.uid and v.video_id in ('.$video.')')->select();
           
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
		$id=$_GET['id'];
		$cate=D('category');
		$class=D('class');
		$live=D('liveb');
		$video=D('video');

		$active=$cate->where('cate_id='.$id)->find();
		$this->assign('active',$active);

		$res=$cate->where('pid=0 && cate_id!=1')->select();
		$lei=$cate->where('pid='.$id)->select();
		$time=time();
			$arr="";
			$count=count($lei);
			//echo $count3;
			for($i = 0; $i < $count; $i++){
				if(($i+1)==$count){
				$arr .= $lei[$i]['cate_id'];
				}else{
				 $arr .= $lei[$i]['cate_id'].',';
				}
			}
		if($arr){
				
		$count2 = $video->where( "cate_id in (".$arr.",".$id.")")->count();
		
		$Page2 = new \Think\Page($count2,20);
		
		$time=time();
		        $videolist=$video->where( "cate_id in (".$arr.",".$id.")")->limit($Page2 -> firstRow.','.$Page2 -> listRows)->order('number desc')->select();
		       
		    }else{
		    	$time=time();
		    	//$count1 = $live->where( "cate_id=".$id.' and endtime >'.$time)->count();
		//echo $count;
		$count2 = $video->where( "cate_id=".$id)->count();
		//$count3 = $class->where( "cate_id=".$id)->count();
		//$Page1 = new \Think\Page($count1,20);
		$Page2 = new \Think\Page($count2,20);
		//$Page3 = new \Think\Page($count3,20);
		$time=time();
		        $videolist=$video->where( "cate_id=".$id)->limit($Page2 -> firstRow.','.$Page2 -> listRows)->order('number desc')->select();
		      
		    }
	    
	    $show2 = $Page2 ->show();
	    //$show3 = $Page3 ->show();
		$this->assign('rew',$res);
		$this->assign('arr',$arr);
		$this->assign('row',$lei);
		$this->assign('video',$videolist);
		
		$this->assign('show1',$show2);
		
		$this->display('video');

	}
	public function ketangshow(){
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
            $time=time();
            $pin=D('video')->table('class as c,video as v,user as u,userdata as ud')->field('v.*,u.user_id,u.name as uname,ud.image')->where('v.class_id=c.class_id and c.uid=u.user_id  and u.user_id=ud.uid and v.video_id in ('.$video.')')->select();
           
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
		$id=$_GET['id'];
		$cate=D('category');
		$class=D('class');
		$live=D('liveb');
		$video=D('video');

		$active=$cate->where('cate_id='.$id)->find();
		$this->assign('active',$active);

		$res=$cate->where('pid=0 && cate_id!=1')->select();
		$lei=$cate->where('pid='.$id)->select();
		$time=time();
			$arr="";
			$count=count($lei);
			//echo $count3;
			for($i = 0; $i < $count; $i++){
				if(($i+1)==$count){
				$arr .= $lei[$i]['cate_id'];
				}else{
				 $arr .= $lei[$i]['cate_id'].',';
				}
			}
		if($arr){
				
		$count3 = $class->where( "cate_id in (".$arr.",".$id.")")->count();
		//$Page1 = new \Think\Page($count1,20);
		//$Page2 = new \Think\Page($count2,20);
		$Page3 = new \Think\Page($count3,20);
		$time=time();
		       
		        $classlist=$class->table('class as c, user as u')->field('c.*,u.user_id')->where( "c.cate_id in (".$arr.",".$id.")".' and c.uid=u.user_id')->limit($Page3 -> firstRow.','.$Page3 -> listRows)->select();

				
		    }else{
		    	$time=time();
		    	
		$count3 = $class->where( "cate_id=".$id)->count();
		//$Page1 = new \Think\Page($count1,20);
		//$Page2 = new \Think\Page($count2,20);
		$Page3 = new \Think\Page($count3,20);
		$time=time();
		       
		        $classlist=$class->table('class as c, user as u')->field('c.*,u.user_id')->where( "cate_id=".$id.' and c.uid=u.user_id')->limit($Page3 -> firstRow.','.$Page3 -> listRows)->select();

				
		    }
	   
	    $show3 = $Page3 ->show();
		$this->assign('rew',$res);
		$this->assign('arr',$arr);
		$this->assign('row',$lei);
		//$this->assign('video',$videolist);
		$this->assign('class',$classlist);
		
		$this->assign('show1',$show3);
		$this->display('ketang');

	}
	public function lei(){
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
            $time=time();
            $pin=D('video')->table('class as c,video as v,user as u,userdata as ud')->field('v.*,u.user_id,u.name as uname,ud.image')->where('v.class_id=c.class_id and c.uid=u.user_id  and u.user_id=ud.uid and v.video_id in ('.$video.')')->select();
            
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
		$id=$_GET['id'];
		$cate=D('category');
		$class=D('class');
		$live=D('liveb');
		$video=D('video');
		$active=$cate->where('cate_id='.$id)->find();
		$this->assign('active',$active);
		$time=time();
		$count1 = $live->where( "cate_id=".$id.' and endtime >'.$time)->count();
		//echo $count;
		//$count2 = $video->where( "cate_id=".$id)->count();
		//$count3 = $class->where( "cate_id=".$id)->count();
		$Page1 = new \Think\Page($count1,20);
		//$Page2 = new \Think\Page($count2,20);
		//$Page3 = new \Think\Page($count3,20);
		$res=$cate->where('pid=0 && cate_id!=1')->select();
		$pid=$cate->where('cate_id='.$id)->find();
		$lei=$cate->where('pid='.$pid['pid'])->select();
		//$videolist=$video->where( "cate_id=".$id)->limit($Page2 -> firstRow.','.$Page2 -> listRows)->order('number desc')->select();
		//$classlist=$class->table('class as c, user as u')->field('c.*,u.user_id')->where( "cate_id=".$id.' and c.uid=u.user_id')->limit($Page3 -> firstRow.','.$Page3 -> listRows)->select();
		$livelist=$live->where( "cate_id=".$id.' and endtime >'.$time)->limit($Page1 -> firstRow.','.$Page1 -> listRows)->order('money asc')->select();
		$show1 = $Page1 ->show();
	    //dump($show1);
	    //$show2 = $Page2 ->show();
	   // $show3 = $Page3 ->show();
		$this->assign('rew',$res);
		$this->assign('arr',$arr);
		$this->assign('row',$lei);
		//$this->assign('video',$videolist);
		//$this->assign('class',$classlist);
		$this->assign('live',$livelist);
		$this->assign('show1',$show1);
		//$this->assign('show2',$show2);
		//$this->assign('show3',$show3);
		$this->display('index');

	} 
	public function videolei(){
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
            $time=time();
            $pin=D('video')->table('class as c,video as v,user as u,userdata as ud')->field('v.*,u.user_id,u.name as uname,ud.image')->where('v.class_id=c.class_id and c.uid=u.user_id  and u.user_id=ud.uid and v.video_id in ('.$video.')')->select();
            
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
		$id=$_GET['id'];
		$cate=D('category');
		$class=D('class');
		$live=D('liveb');
		$video=D('video');
		$active=$cate->where('cate_id='.$id)->find();
		$this->assign('active',$active);
		$time=time();
		//$count1 = $live->where( "cate_id=".$id.' and endtime >'.$time)->count();
		//echo $count;
		$count2 = $video->where( "cate_id=".$id)->count();
		//$count3 = $class->where( "cate_id=".$id)->count();
		//$Page1 = new \Think\Page($count1,20);
		$Page2 = new \Think\Page($count2,20);
		//$Page3 = new \Think\Page($count3,20);
		$res=$cate->where('pid=0 && cate_id!=1')->select();
		$pid=$cate->where('cate_id='.$id)->find();
		$lei=$cate->where('pid='.$pid['pid'])->select();
		$videolist=$video->where( "cate_id=".$id)->limit($Page2 -> firstRow.','.$Page2 -> listRows)->order('number desc')->select();
		//$classlist=$class->table('class as c, user as u')->field('c.*,u.user_id')->where( "cate_id=".$id.' and c.uid=u.user_id')->limit($Page3 -> firstRow.','.$Page3 -> listRows)->select();
		//$livelist=$live->where( "cate_id=".$id.' and endtime >'.$time)->limit($Page1 -> firstRow.','.$Page1 -> listRows)->order('money asc')->select();
		//$show1 = $Page1 ->show();
	    //dump($show1);
	    $show2 = $Page2 ->show();
	   // $show3 = $Page3 ->show();
		$this->assign('rew',$res);
		$this->assign('arr',$arr);
		$this->assign('row',$lei);
		$this->assign('video',$videolist);
		//$this->assign('class',$classlist);
		//$this->assign('live',$livelist);
		$this->assign('show1',$show2);
		//$this->assign('show2',$show2);
		//$this->assign('show3',$show3);
		$this->display('video');

	}
	public function ketanglei(){
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
            $time=time();
            $pin=D('video')->table('class as c,video as v,user as u,userdata as ud')->field('v.*,u.user_id,u.name as uname,ud.image')->where('v.class_id=c.class_id and c.uid=u.user_id  and u.user_id=ud.uid and v.video_id in ('.$video.')')->select();
            
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
		$id=$_GET['id'];
		$cate=D('category');
		$class=D('class');
		$live=D('liveb');
		$video=D('video');
		$active=$cate->where('cate_id='.$id)->find();
		$this->assign('active',$active);
		$time=time();
		//$count1 = $live->where( "cate_id=".$id.' and endtime >'.$time)->count();
		//echo $count;
		//$count2 = $video->where( "cate_id=".$id)->count();
		$count3 = $class->where( "cate_id=".$id)->count();
		//$Page1 = new \Think\Page($count1,20);
		//$Page2 = new \Think\Page($count2,20);
		$Page3 = new \Think\Page($count3,20);
		$res=$cate->where('pid=0 && cate_id!=1')->select();
		$pid=$cate->where('cate_id='.$id)->find();
		$lei=$cate->where('pid='.$pid['pid'])->select();
		//$videolist=$video->where( "cate_id=".$id)->limit($Page2 -> firstRow.','.$Page2 -> listRows)->order('number desc')->select();
		$classlist=$class->table('class as c, user as u')->field('c.*,u.user_id')->where( "cate_id=".$id.' and c.uid=u.user_id')->limit($Page3 -> firstRow.','.$Page3 -> listRows)->select();
		//$livelist=$live->where( "cate_id=".$id.' and endtime >'.$time)->limit($Page1 -> firstRow.','.$Page1 -> listRows)->order('money asc')->select();
		//$show1 = $Page1 ->show();
	    //dump($show1);
	    //$show2 = $Page2 ->show();
	    $show3 = $Page3 ->show();
		$this->assign('rew',$res);
		$this->assign('arr',$arr);
		$this->assign('row',$lei);
		//$this->assign('video',$videolist);
		$this->assign('class',$classlist);
		//$this->assign('live',$livelist);
		$this->assign('show1',$show3);
		//$this->assign('show2',$show2);
		//$this->assign('show3',$show3);
		$this->display('ketang');

	}  
	//课程详情
	public function course(){
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
            $time=time();
            $pin=D('video')->table('class as c,video as v,user as u,userdata as ud')->field('v.*,u.user_id,ud.image,ud.profile')->where('v.class_id=c.class_id and c.uid=u.user_id  and u.user_id=ud.uid and v.video_id in ('.$video.')')->select();
          
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
		$id=$_GET['id'];
		$pid=$_GET['pid'];
		$video=D('video');
		
		
		//session('H_user_id',12);
		$live=D('liveb');
		$class=D('class');
		$comment_video=D('comment_video');
		

		if($id){
			$videolist=$video->table('class as c,video as v,user as u,userdata as ud')->field('v.*,u.user_id,u.name as uname,ud.image,ud.profile')->where('v.class_id=c.class_id and c.uid=u.user_id  and u.user_id=ud.uid and v.video_id='.$id)->find();
			if($_SESSION['H_user_id']){
			$cang=D('subscribe');
			$shoucang=$cang->where('uid='.$_SESSION['H_user_id'].' and cid='.$id.' and type=1')->find();
			$this->assign('cang',$shoucang);
		}
            $c=D('comment_video_star');
            $comment=$c->where('video_id='.$id)->find();
			$star=round($comment['star']/$comment['num']);
			
			$this->assign('star',$star);
			
			$this->assign('row',$videolist);
			$this->assign('id',$id);
			
		}else{
			$livelist=$live->table('class as c,liveb as l,user as u,userdata as ud')->field('l.*,u.user_id,u.name as uname,ud.image,ud.profile')->where('l.class_id=c.class_id and c.uid=u.user_id and u.user_id=ud.uid and l.liveb_id='.$pid)->find();
			
			$this->assign('row',$livelist);
			$this->assign('pid',$pid);
			
		}
		/*if(IS_POST){
			vendor('Wxshare.jssdk');
	     $jssdk = new \JSSDK("wx76b04f25405b5dbe", "3c59beff232d75f504e7a5532e8deff6");
	    $signPackage = $jssdk->getSignPackage();
        echo json_encode($signPackage); 
		}*/
		 
		$this->display();
	}
	public function videocourses(){
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
            $time=time();
            $pin=D('video')->table('class as c,video as v,user as u,userdata as ud')->field('v.*,u.user_id,ud.image,ud.profile')->where('v.class_id=c.class_id and c.uid=u.user_id  and u.user_id=ud.uid and v.video_id in ('.$video.')')->select();
          
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
		$id=$_GET['id'];
		$pid=$_GET['pid'];
		$video=D('video');
		//session('H_user_id',12);
		$live=D('liveb');
		$class=D('class');
		$comment_video=D('comment_video');
		if($id){
			$videolist=$video->table('class as c,video as v,user as u,userdata as ud')->field('v.*,u.user_id,u.name as uname,ud.image,ud.profile')->where('v.class_id=c.class_id and c.uid=u.user_id  and u.user_id=ud.uid and v.video_id='.$id)->find();
			if($_SESSION['H_user_id']){
			$cang=D('subscribe');
			$shoucang=$cang->where('uid='.$_SESSION['H_user_id'].' and cid='.$id.' and type=1')->find();
			$this->assign('cang',$shoucang);
		}
			$count=$video->where('class_id='.$videolist['class_id'])->count();
			$Page = new \Think\Page($count,10);
			$shipin=$video->where('class_id='.$videolist['class_id'])->limit($Page -> firstRow.','.$Page -> listRows)->order('time desc')->select();
			$show1 = $Page ->show();
            $this->assign('show',$show1);
            $c=D('comment_video_star');
            $comment=$c->where('video_id='.$id)->find();
			$star=round($comment['star']/$comment['num']);
			//dump($star);
			$this->assign('star',$star);
			//$this->assign('comment',$commentlist);
			$this->assign('row',$videolist);
			$this->assign('id',$id);
			$this->assign('shipin',$shipin);
			//$this->assign('zhibo',$zhibo);
		}else{
			$livelist=$live->table('class as c,liveb as l,user as u,userdata as ud')->field('l.*,u.user_id,u.name as uname,ud.image,ud.profile')->where('l.class_id=c.class_id and c.uid=u.user_id and u.user_id=ud.uid and l.liveb_id='.$pid)->find();
			//dump($livelist);
			$count=$video->where('class_id='.$livelist['class_id'])->count();
			$Page = new \Think\Page($count,10);
			$shipin=$video->where('class_id='.$livelist['class_id'])->limit($Page -> firstRow.','.$Page -> listRows)->order('time desc')->select();
			$show1 = $Page ->show();
			$this->assign('show',$show1);
			$this->assign('row',$livelist);
			$this->assign('pid',$pid);
			$this->assign('shipin',$shipin);
			//$this->assign('zhibo',$zhibo);
		}
		/*if(IS_POST){
			vendor('Wxshare.jssdk');
	     $jssdk = new \JSSDK("wx76b04f25405b5dbe", "3c59beff232d75f504e7a5532e8deff6");
	    $signPackage = $jssdk->getSignPackage();
        echo json_encode($signPackage); 
		}
		 */
		$this->display('courses-video');
	}
	public function classcourses(){
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
            $time=time();
            $pin=D('video')->table('class as c,video as v,user as u,userdata as ud')->field('v.*,u.user_id,ud.image,ud.profile')->where('v.class_id=c.class_id and c.uid=u.user_id  and u.user_id=ud.uid and v.video_id in ('.$video.')')->select();
          
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
		$id=$_GET['id'];
		$pid=$_GET['pid'];
		$video=D('video');
		//session('H_user_id',12);
		$live=D('liveb');
		$class=D('class');
		$comment_video=D('comment_video');
		if($id){
			$videolist=$video->table('class as c,video as v,user as u,userdata as ud')->field('v.*,u.user_id,u.name as uname,ud.image,ud.profile')->where('v.class_id=c.class_id and c.uid=u.user_id  and u.user_id=ud.uid and v.video_id='.$id)->find();
			//$shipin=$video->where('class_id='.$videolist['class_id'])->select();
			if($_SESSION['H_user_id']){
			$cang=D('subscribe');
			$shoucang=$cang->where('uid='.$_SESSION['H_user_id'].' and cid='.$id.' and type=1')->find();
			$this->assign('cang',$shoucang);
		}
			$name=$videolist['name'];
			$count=$live->where("name like '%$name%' ")->count();
			$Page = new \Think\Page($count,10);
			$zhibo=$live->where("name like '%$name%' ")->limit($Page -> firstRow.','.$Page -> listRows)->order('time desc')->select();
			$show1 = $Page ->show();
            $this->assign('show',$show1);
            $c=D('comment_video_star');
            $comment=$c->where('video_id='.$id)->find();
			$star=round($comment['star']/$comment['num']);
			//dump($star);
			$this->assign('star',$star);
			//$this->assign('comment',$commentlist);
			$this->assign('row',$videolist);
			$this->assign('id',$id);
			//$this->assign('shipin',$shipin);
			$this->assign('zhibo',$zhibo);
		}else{
			$livelist=$live->table('class as c,liveb as l,user as u,userdata as ud')->field('l.*,u.user_id,u.name as uname,ud.image,ud.profile')->where('l.class_id=c.class_id and c.uid=u.user_id and u.user_id=ud.uid and l.liveb_id='.$pid)->find();
			
			//$shipin=$video->where('class_id='.$livelist['class_id'])->select();
			$name=$livelist['name'];
			$count=$live->where("name like '%$name%' ")->count();
			$Page = new \Think\Page($count,10);
			$zhibo=$live->where("name like '%$name%' ")->limit($Page -> firstRow.','.$Page -> listRows)->order('time desc')->select();
			 //dump($livelist);
			// dump($zhibo);
			$show1 = $Page ->show();
            $this->assign('show',$show1);
			$this->assign('row',$livelist);
			$this->assign('pid',$pid);
			//$this->assign('shipin',$shipin);
			$this->assign('zhibo',$zhibo);
		}
		/*if(IS_POST){
			vendor('Wxshare.jssdk');
	     $jssdk = new \JSSDK("wx76b04f25405b5dbe", "3c59beff232d75f504e7a5532e8deff6");
	    $signPackage = $jssdk->getSignPackage();
        echo json_encode($signPackage); 
		}
		 */
		$this->display('courses-class');
	}
	public function commentcourses(){
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
            $time=time();
            $pin=D('video')->table('class as c,video as v,user as u,userdata as ud')->field('v.*,u.user_id,ud.image,ud.profile')->where('v.class_id=c.class_id and c.uid=u.user_id  and u.user_id=ud.uid and v.video_id in ('.$video.')')->select();
          
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
		$id=$_GET['id'];
		$pid=$_GET['pid'];
		$video=D('video');
		//session('H_user_id',12);
		$live=D('liveb');
		$class=D('class');
		$comment_video=D('comment_video');
		if($id){
			$videolist=$video->table('class as c,video as v,user as u,userdata as ud')->field('v.*,u.user_id,u.name as uname,ud.image,ud.profile')->where('v.class_id=c.class_id and c.uid=u.user_id  and u.user_id=ud.uid and v.video_id='.$id)->find();
			//$shipin=$video->where('class_id='.$videolist['class_id'])->select();
			//$name=$videolist['name'];
			//$zhibo=$live->where("name like '%$name%' ")->select();
			if($_SESSION['H_user_id']){
			$cang=D('subscribe');
			$shoucang=$cang->where('uid='.$_SESSION['H_user_id'].' and cid='.$id.' and type=1')->find();
			$this->assign('cang',$shoucang);
		}
			$count=$comment_video->where('video_id='.$id)->count();
			$Page = new \Think\Page($count,10);
			$commentlist=$comment_video->table('comment_video as c,user as u,userdata as ud')->field('c.*,u.user_id,ud.image,u.name')->where(' c.uid=u.user_id and u.user_id=ud.uid and c.video_id='.$id)->limit($Page -> firstRow.','.$Page -> listRows)->order('time desc')->select();
			//dump($commentlist);
			foreach ($commentlist as $k=>$v){
				$name=$v['name'];
				$b=mb_substr($name,mb_strlen($name,'utf-8')-1,1,'utf-8');
				$c=mb_substr($name,0,1,'utf-8');
		
				$commentlist[$k]['name']=$c.'**'.$b;
		
			}
			//dump($commentlist);
			$show1 = $Page ->show();
            $this->assign('show',$show1);
            $c=D('comment_video_star');
            $comment=$c->where('video_id='.$id)->find();
			$star=round($comment['star']/$comment['num']);
			//dump($star);
			$this->assign('star',$star);
			$this->assign('comment',$commentlist);
			$this->assign('row',$videolist);
			$this->assign('id',$id);
			//$this->assign('shipin',$shipin);
			//$this->assign('zhibo',$zhibo);
		}else{
			$livelist=$live->table('class as c,liveb as l,user as u,userdata as ud')->field('l.*,u.user_id,u.name as uname,ud.image,ud.profile')->where('l.class_id=c.class_id and c.uid=u.user_id and u.user_id=ud.uid and l.liveb_id='.$pid)->find();
			$this->assign('row',$livelist);
			$this->assign('pid',$pid);
			//$this->assign('shipin',$shipin);
			//$this->assign('zhibo',$zhibo);
		}
		/*if(IS_POST){
			vendor('Wxshare.jssdk');
	     $jssdk = new \JSSDK("wx76b04f25405b5dbe", "3c59beff232d75f504e7a5532e8deff6");
	    $signPackage = $jssdk->getSignPackage();
        echo json_encode($signPackage); 
		}
		 */
		$this->display('courses-comment');
	}
	//报名
	public function baoming(){
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
            $pin=D('video')->table('class as c,video as v,user as u,userdata as ud')->field('v.*,u.user_id,u.name as uname,ud.image')->where('v.class_id=c.class_id and c.uid=u.user_id  and u.user_id=ud.uid and v.video_id in ('.$video.')')->select();
            
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
		$pid=$_GET['pid'];
		$id=$_GET['id'];
		
		$uid=$_SESSION['H_user_id'];
		$live=D('liveb');
		$video=D('video');
		$order=D('order');
		$payvideo=D('payvideo');
		$userdata=D('userdata');
		if(!$_SESSION['H_user_id']){
			echo  "<script>alert('您尚未登录！请登录');window.location.href='".__MODULE__."/login/index';</script>"; 
			
		}else{ 
		$userlist=$userdata->where('uid='.$uid)->find();
		
		if($pid){
			
			$livelist=$live->table('class as c,liveb as l,user as u,userdata as ud')->field('l.*,u.user_id,u.name as uname,ud.image')->where('l.class_id=c.class_id and c.uid=u.user_id  and u.user_id=ud.uid and l.liveb_id='.$pid)->find();
			//dump($livelist);
			$goumai=$order->where(array('play_id'=>$pid,'type'=>'0','uid'=>$uid))->order('time desc')->find();
			if($goumai){
				if($goumai['status']=='0'){
					$oop['status']='3';
					$order->where(array('order_id'=>$goumai['order_id']))->save($oop);
				}
			}
			$class=D('class')->where('uid='.$uid)->find();
			if($class){
			if($livelist['class_id']==$class['class_id']){
				echo  "<script>alert('该课程是您的课程无需购买');window.location.href='".__MODULE__."/index/index';</script>";   exit; 
			}}
			if($livelist['uid'] && $livelist['uid']!=$uid){
					echo  "<script>alert('该课程已被其他人购买！请选择其他课程');window.location.href='".__MODULE__."/index/index';</script>";exit;  
				
			}
			if($livelist['uid']==$uid){
					echo  "<script>alert('该课程已被您购买！请选择其他课程');window.location.href='".__MODULE__."/index/index';</script>"; exit; 
				
			}
			if(empty($livelist['uid']) && $livelist['money']==0){
					$mvp['reg_status']='1';
					$mvp['uid']=$uid;
					$sb=$live->where('liveb_id='.$pid)->save($mvp);
					echo  "<script>alert('报名成功');window.location.href='".__MODULE__."/index/index';</script>";exit;  
				
			}
			else{
				$this->assign('userlist',$userlist);
				$this->assign('order',$livelist);
				$this->assign('pid',$pid);
			 	$this->display('submit-order');
			}

			
		}
	
		if($id){
			$videoli=$video->table('class as c,video as v,user as u,userdata as ud')->field('v.*,u.user_id,u.name as uname,ud.image')->where('v.class_id=c.class_id and c.uid=u.user_id and u.user_id=ud.uid and v.video_id='.$id)->find();
			//dump($videoli);
			$class=D('class')->where('uid='.$uid)->find();
			$goumai=$order->where(array('play_id'=>$id,'type'=>'1','uid'=>$uid))->order('time desc')->find();
			if($goumai){
				if($goumai['status']=='0'){
					$oop['status']='3';
					$order->where(array('order_id'=>$goumai['order_id']))->save($oop);
				}
			}
			if($class){
			//dump($class);
			if($videoli['class_id']==$class['class_id']){
				echo  "<script>alert('该课程是您的课程无需购买');window.location.href='".__MODULE__."/index/index';</script>";    exit;
			}}
			$videolist=$payvideo->where('uid='.$uid.' and  video_id='.$id)->find();
			if($videolist){
				/*$arr=explode(',',$videolist['uid']);
				$a=$_SESSION['H_user_id'];
				if(in_array("$a",$arr)){
					  $this->ajaxReturn('您已经报名!请选择其他课程');
				}            */                              
				 echo  "<script>alert('您已经购买该视频');window.location.href='".__MODULE__."/index/index';</script>";exit;                                                 
				                                                
				// $mvp=$videolist['uid'].','.session('H_user_id');
				
			}

			if(empty($videolist) && $videoli['money']==0){
					$data['uid']=$uid;
					$data['time']=time();
					$data['video_id']=$id;
					$pay=$payvideo->add($data);
					$mvp['number']=$videoli['number']+1;
					
					$sb=$video->where('video_id='.$id)->save($mvp);
					echo  "<script>alert('报名成功');window.location.href='".__MODULE__."/index/index';</script>";exit;  
				
			}
			else{
			 	
			    $this->assign('userlist',$userlist);
			    $this->assign('order',$videoli);
				$this->assign('id',$id);
			 	$this->display('submit-order');
			  
			}

			
		}
	}

}
function getRandomString($len, $chars=null){  
    	if (is_null($chars)){  
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";  
    	}  
    	mt_srand(10000000*(double)microtime());  
    	for ($i = 0, $str = '', $lc = strlen($chars)-1; $i < $len; $i++) {  
        	$str .= $chars[mt_rand(0, $lc)];  
    	}  
    	return $str;  
}
	//提交订单
	public function pay(){
		if($_SESSION['H_user_id']){
		$uid=$_SESSION['H_user_id'];
		$user=D('user');
		$class=D('class');
		$history=D('history');
		$userlist=$user->table('user as u, userdata as ud')->field('u.*,ud.image,ud.money')->where('u.user_id='.$uid.' and u.user_id=ud.uid')->find();
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
            $pin=D('video')->table('class as c,video as v,user as u,userdata as ud')->field('v.*,u.user_id,u.name as uname,ud.image')->where('v.class_id=c.class_id and c.uid=u.user_id  and u.user_id=ud.uid and v.video_id in ('.$video.')')->select();
           
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
		$pid=$_GET['pid'];
		$id=$_GET['id'];
		
		$uid=$_SESSION['H_user_id'];
		$live=D('liveb');
		$video=D('video');
		$order=D('order');
		$payvideo=D('payvideo');
		$userdata=D('userdata');
		
		if($pid){

			$livelist=$live->table('class as c,liveb as l,user as u,userdata as ud')->field('l.*,u.user_id,ud.image')->where('l.class_id=c.class_id and c.uid=u.user_id and  u.user_id=ud.uid and l.liveb_id='.$pid)->find();
			
			$mvp['uid']=$uid;
			$mvp['play_id']=$pid;
			$mvp['num']= time().$this->getRandomString(5);
			$mvp['time']=time();
			$mvp['money']=$livelist['money'];
			$mvp['status']=0;
			$mvp['type']=0;
			$orderlist=$order->add($mvp);

			$this->assign('order',$livelist);
			$this->assign('order_id',$orderlist);
			$this->assign('pid',$pid);
		
		}
		if($id){
			$videoli=$video->table('class as c,video as v,user as u,userdata as ud')->field('v.*,u.user_id,ud.image')->where('v.class_id=c.class_id and c.uid=u.user_id  and u.user_id=ud.uid and v.video_id='.$id)->find();
			
			$mvp['uid']=$uid;
			$mvp['play_id']=$id;
			$mvp['num']= time(). $this->getRandomString(5);
			$mvp['time']=time();
			$mvp['money']=$videoli['money'];
			$mvp['status']=0;
			$mvp['type']=1;
			$orderlist=$order->add($mvp);
			$this->assign('order_id',$orderlist);
			$this->assign('order',$videoli);
			$this->assign('id',$id);
		

		}
		$this->display('pay-order');
	

	}
	//设置支付密码
	public function set(){
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
            $pin=D('video')->table('class as c,video as v,user as u,userdata as ud')->field('v.*,u.user_id,u.name as uname,ud.image')->where('v.class_id=c.class_id and c.uid=u.user_id  and u.user_id=ud.uid and v.video_id in ('.$video.')')->select();
           
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
	    	$userdata=D('userdata');
	    	$mvp['paypass']=md5(md5($_POST['pass']));
	    	
	    	$set=$userdata->where('uid='.$_SESSION['H_user_id'])->save($mvp);
	    	if($set){
  				$this->ajaxReturn('设置成功');
			}
	    	
	    }else{
	    $pid=$_GET['pid'];
	    $id=$_GET['id'];
	    $this->assign('pid',$pid);
	    $this->assign('id',$id);
		$this->display('set-password');
	    }
	}
	//立即支付
	public function yan(){
		$uid=$_SESSION['H_user_id'];
		$user=D('userdata');
		$live=D('liveb');
		$video=D('video');
		$order=D('order');
		$payvideo=D('payvideo');
		$class=D('class');
		$pid=$_POST['pid'];
		$id=$_POST['id'];
		$userlist=$user->where('uid='.$uid)->find();
		if($userlist['paypass']==md5(md5($_POST['pass']))){
			
			if($_POST['money']<$_POST['vmoney']){
				$this->ajaxReturn('余额不足');
			}else{
			if($pid){
				
				$livelist=$live->table('class as c,liveb as l,user as u,userdata as ud')->field('l.*,u.user_id,ud.image')->where('l.class_id=c.class_id and c.uid=u.user_id and  u.user_id=ud.uid and l.liveb_id='.$pid)->find();

				$classrel=$class->where('class_id='.$livelist['class_id'])->find();
		    $t_user=$user->where('uid='.$classrel['uid'])->find();

			$user->startTrans();
            $class->startTrans();
				
				$jian=$user->where('uid='.$uid)->setDec('money',$_POST['vmoney']);
				 $profit=$class->where('class_id='.$livelist['class_id'])->setInc('profit',$_POST['vmoney']);
				if($jian!==false && $profit!==false){
					 $user->commit();
                     $class->commit();
                     $mvp['uid']=$uid;
				     $mvp['reg_status']='1';
				     $sb=$live->where('liveb_id='.$pid)->save($mvp);
				     if(!$sb){
				     	$this->ajaxReturn('购买失败');
				     }
				     $data['status']=1;
				     $order->where('order_id='.$_POST['order_id'])->save($data);
				
				
				 
				  // 添加学生的交易记录
                 $payrecord=M('payrecord');
                 $add['uid']=$uid;
                 $add['type']='2';
                 $add['time']=time();
                 $add['pay']=$livelist['money'];
                 $add['source']=$livelist['name'];
                 $payrecord->add($add);
                // 添加老师的交易记录
                $add1['uid']=$t_user['uid'];
                $add1['type']='1';
                $add1['time']=time();
                $add1['income']=$livelist['money'];
                $add1['source']=$livelist['name'];
                $payrecord->add($add1);
                $this->ajaxReturn('支付成功');
                }else{
                	 $user->rollback();
                     $class->rollback();
                     $this->ajaxReturn('支付失败');
                }
			}
			if($id){

				$videoli=$video->table('class as c,video as v,user as u,userdata as ud')->field('v.*,u.user_id,ud.image')->where('v.class_id=c.class_id and c.uid=u.user_id and  u.user_id=ud.uid and v.video_id='.$id)->find();
				 $classrel=$class->where('class_id='.$videoli['class_id'])->find();
				  $t_user=$user->where('uid='.$classrel['uid'])->find();
				  $user->startTrans();
                  $class->startTrans();
				
				
				$jian=$user->where('uid='.$uid)->setDec('money',$_POST['vmoney']);
				 $profit=$class->where('class_id='.$videoli['class_id'])->setInc('profit',$_POST['vmoney']);
				 $jia=$user->where('uid='.$t_user['uid'])->setInc('money',$videoli['money']);
				  // 添加学生的交易记录
				  if($jian!==false && $jia!==false && $profit!==false){
				  		$user->commit();
                     $class->commit();
                     $mvp['number']=$videoli['number']+1;
					
				 	 $sb=$video->where('video_id='.$id)->save($mvp);
					 $mop['uid']=$uid;
					 $mop['video_id']=$videoli['video_id'];
					 $mop['time']=time();
					 $payvideo->add($mop);
					 $data['status']=1;
					 $order->where('order_id='.$_POST['order_id'])->save($data);
				 
                 $payrecord=M('payrecord');
                 $add['uid']=$uid;
                 $add['type']='2';
                 $add['time']=time();
                 $add['pay']=$videoli['money'];
                 $add['source']=$videoli['name'];
                 $payrecord->add($add);
                 
                // 添加老师的交易记录
                $add1['uid']=$t_user['uid'];
                $add1['type']='1';
                $add1['time']=time();
                $add1['income']=$videoli['money'];
                $add1['source']=$videoli['name'];
                $payrecord->add($add1);
                $this->ajaxReturn('支付成功'); 
              }else{
              	 $user->rollback();
                 $class->rollback();
                 $this->ajaxReturn('支付失败');
              }
			}
		}
	}else{
			$this->ajaxReturn('密码不正确');
	}
}
	
	//收藏
    public function shoucang(){
    	$id=$_POST['live'];
    	$cang=D('subscribe');
    	$pid=$_POST['video'];
    	$user=$_SESSION['H_user_id'];
    	if($id){
    	if($user){
    	$res=$cang->where('cid='.$id.' and uid='.$user.' and type=0')->find();
    	if($res){
    		 $this->ajaxReturn('您已经收藏该直播');
    	}else{
    		$mvp['cid']=$id;
    		$mvp['uid']=$user;
    		$mvp['time']=time();
    		$mvp['type']=0;
    		$row=$cang->data($mvp)->add();
    		if($row){
    			 $this->ajaxReturn('收藏成功');
    		}else{
    			 $this->ajaxReturn('收藏失败');
    		}
    	}
    }else{
    	$this->ajaxReturn('您尚未登录！请登录');
    }
	}
	if($pid){
		if($user){
    	$res=$cang->where('cid='.$pid.' and uid='.$user.' and type=1')->find();
    	if($res){
    		 $this->ajaxReturn('您已经收藏该视频');
    	}else{
    		$mvp['cid']=$pid;
    		$mvp['uid']=$user;
    		$mvp['time']=time();
    		$mvp['type']=1;
    		$row=$cang->data($mvp)->add();
    		if($row){
    			 $this->ajaxReturn('收藏成功');
    		}else{
    			 $this->ajaxReturn('收藏失败');
    		}
    	}
    }else{
    	$this->ajaxReturn('您尚未登录！请登录');
    }
	}
    }  
    //学生进入店铺
    public function student(){
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
            $pin=D('video')->table('class as c,video as v,user as u,userdata as ud')->field('v.*,u.user_id,u.name as uname,ud.image')->where('v.class_id=c.class_id and c.uid=u.user_id  and u.user_id=ud.uid and v.video_id in ('.$video.')')->select();
           
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
    	$id=$_GET['id'];
    	$class=D('class');
    	$live=D('liveb');
    	$video=D('video');
    	$pay=D('payrecord');
    	$comment=D('comment_liveb');
    	$time=time();
    	$classlist=$class->table('user as us,class as c,userdata as u')->field('c.*,u.image,u.profile,us.name as uname')->where('c.uid='.$id.' and u.uid=c.uid and us.user_id='.$id)->find();
    	$l=D('comment_liveb_star');
    	$star=$l->where('tid='.$id)->find();
    	$stars=round($star['star']/$star['num']);
    	/*dump($stars);
    	die();*/
    	$cid=$classlist['class_id'];
    	$count1 = $live->where( "class_id=".$cid.' and endtime >'.$time)->count();
		//echo $count1;
		//$count2 = $video->where( "class_id=".$cid)->count();
		//echo $count2;
		$Page1 = new \Think\Page($count1,10);
		//$Page2 = new \Think\Page($count2,50);
    	
		$livelist=$live->where("class_id=".$cid.' and endtime >'.$time)->limit($Page1 -> firstRow.','.$Page1 -> listRows)->order('time desc')->select();
		$livelists=$live->where('class_id='.$cid)->order('time desc')->select();
		//$videolist=$video->where('class_id='.$cid)->order('time desc')->limit($Page2 -> firstRow.','.$Page2 -> listRows)->order('time desc')->select();
		//dump($videolist);
    	$livelistss=$live->where("class_id=".$cid.' and endtime <'.$time)->count();
    	//dump($livelist);
    	/*dump($videolist);
    	dump($livelist);*/
    	foreach($livelists as $k=>$v){
    		$livelists[$k]['ztime']=($livelists[$k]['endtime']-$livelists[$k]['time']);
    	}
    	$arr="";
			$count=count($livelists);
			//echo $count3;
			for($i = 0; $i < $count; $i++){
				if(($i+1)==$count){
				$arr += $livelists[$i]['ztime'];
				}else{
				 $arr+= $livelists[$i]['ztime'].',';
				}
			}
		$show1 = $Page1 ->show();
		//$show = $Page ->show();
	    //dump($show1);
	    //$show2 = $Page2 ->show();
    	$hours=floor($arr/3600);
    	$m=($arr%3600);
    	$minute=floor($m/60);
    	$payrecord=$pay->where('uid='.$id)->count();
    	$this->assign('minute',$minute);
    	$this->assign('pay',$payrecord);
    	$this->assign('hours',$hours);
    	$this->assign('class',$classlist);
    	$this->assign('lists',$livelistss);
    	$this->assign('id',$id);
    	$this->assign('row',$livelist);
    	//$this->assign('res',$videolist);
    	$this->assign('star',$stars);
    	$this->assign('show1',$show1);
    	//$this->assign('show2',$show2);
    	//$this->assign('show',$show);
    	$this->display('student');
    }
    public function studentvideo(){
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
            $pin=D('video')->table('class as c,video as v,user as u,userdata as ud')->field('v.*,u.user_id,u.name as uname,ud.image')->where('v.class_id=c.class_id and c.uid=u.user_id  and u.user_id=ud.uid and v.video_id in ('.$video.')')->select();
           
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
    	$id=$_GET['id'];
    	$class=D('class');
    	$live=D('liveb');
    	$video=D('video');
    	$pay=D('payrecord');
    	$comment=D('comment_liveb');
    	$time=time();
    	$classlist=$class->table('user as us,class as c,userdata as u')->field('c.*,u.image,u.profile,us.name as uname')->where('c.uid='.$id.' and u.uid=c.uid and us.user_id='.$id)->find();

    	$l=D('comment_liveb_star');
    	$star=$l->where('tid='.$id)->find();
    	$stars=round($star['star']/$star['num']);
    	/*dump($stars);
    	die();*/
    	$cid=$classlist['class_id'];
    	//$count1 = $live->where( "class_id=".$cid.' and endtime >'.$time)->count();
		//echo $count1;
		$count2 = $video->where( "class_id=".$cid)->count();
		//echo $count2;
		//$Page1 = new \Think\Page($count1,50);
		$Page2 = new \Think\Page($count2,10);
    	
		//$livelist=$live->where("class_id=".$cid.' and endtime >'.$time)->limit($Page1 -> firstRow.','.$Page1 -> listRows)->order('time desc')->select();
		$livelists=$live->where('class_id='.$cid)->order('time desc')->select();
		$videolist=$video->where('class_id='.$cid)->order('time desc')->limit($Page2 -> firstRow.','.$Page2 -> listRows)->order('time desc')->select();
		//dump($videolist);
    	$livelistss=$live->where("class_id=".$cid.' and endtime <'.$time)->count();
    	//dump($livelist);
    	/*dump($videolist);
    	dump($livelist);*/
    	foreach($livelists as $k=>$v){
    		$livelists[$k]['ztime']=($livelists[$k]['endtime']-$livelists[$k]['time']);
    	}
    	$arr="";
			$count=count($livelists);
			//echo $count3;
			for($i = 0; $i < $count; $i++){
				if(($i+1)==$count){
				$arr += $livelists[$i]['ztime'];
				}else{
				 $arr+= $livelists[$i]['ztime'].',';
				}
			}
		//$show1 = $Page1 ->show();
		//$show = $Page ->show();
	    //dump($show1);
	    $show2 = $Page2 ->show();
    	$hours=floor($arr/3600);
    	$m=($arr%3600);
    	$minute=floor($m/60);
    	$payrecord=$pay->where('uid='.$id)->count();
    	$this->assign('minute',$minute);
    	$this->assign('pay',$payrecord);
    	$this->assign('hours',$hours);
    	$this->assign('class',$classlist);
    	$this->assign('lists',$livelistss);
    	//$this->assign('stars',$starlist);
    	//$this->assign('row',$livelist);
    	$this->assign('res',$videolist);
    	$this->assign('star',$stars);
    	$this->assign('id',$id);
    	$this->assign('show2',$show2);
    	//$this->assign('show',$show);
    	$this->display('student-video');
    }
    public function studentcomment(){
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
            $pin=D('video')->table('class as c,video as v,user as u,userdata as ud')->field('v.*,u.user_id,u.name as uname,ud.image')->where('v.class_id=c.class_id and c.uid=u.user_id  and u.user_id=ud.uid and v.video_id in ('.$video.')')->select();
           
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
    	$id=$_GET['id'];
    	$class=D('class');
    	$live=D('liveb');
    	$video=D('video');
    	$pay=D('payrecord');
    	$comment=D('comment_liveb');
    	$time=time();
    	$classlist=$class->table('user as us,class as c,userdata as u')->field('c.*,u.image,u.profile,us.name as uname')->where('c.uid='.$id.' and u.uid=c.uid and us.user_id='.$id)->find();
    	
    	//$tid=$classlist['teacher_id'];
    	//dump($tid);
    	$count=$comment->where('tid='.$id)->count();
    	//dump($star);
    	$Page = new \Think\Page($count,10);
    	$starlist=$comment->table('comment_liveb as c,user as u,userdata as ud')->field('c.*,u.name,ud.image')->where('c.tid='.$id.' and c.uid=u.user_id and ud.uid=c.uid')->limit($Page -> firstRow.','.$Page -> listRows)->order('time desc')->select();
    	//dump($starlist);
    	foreach($starlist as $k=>$v){
    		$name=$v['name'];
				$b=mb_substr($name,mb_strlen($name,'utf-8')-1,1,'utf-8');
				$c=mb_substr($name,0,1,'utf-8');
		
				$starlist[$k]['name']=$c.'**'.$b;
    	}
    	$l=D('comment_liveb_star');
    	$star=$l->where('tid='.$id)->find();
    	$stars=round($star['star']/$star['num']);
    	/*dump($stars);
    	die();*/
    	$cid=$classlist['class_id'];
    	
		$livelists=$live->where('class_id='.$cid)->order('time desc')->select();
		
    	$livelistss=$live->where("class_id=".$cid.' and endtime <'.$time)->count();
    	
    	foreach($livelists as $k=>$v){
    		$livelists[$k]['ztime']=($livelists[$k]['endtime']-$livelists[$k]['time']);
    	}
    	$arr="";
			$count=count($livelists);
			//echo $count3;
			for($i = 0; $i < $count; $i++){
				if(($i+1)==$count){
				$arr += $livelists[$i]['ztime'];
				}else{
				 $arr+= $livelists[$i]['ztime'].',';
				}
			}
		//$show1 = $Page1 ->show();
		$show = $Page ->show();
	    //dump($show1);
	    //$show2 = $Page2 ->show();
    	$hours=floor($arr/3600);
    	$m=($arr%3600);
    	$minute=floor($m/60);
    	$payrecord=$pay->where('uid='.$id)->count();
    	$this->assign('minute',$minute);
    	$this->assign('pay',$payrecord);
    	$this->assign('hours',$hours);
    	$this->assign('class',$classlist);
    	$this->assign('lists',$livelistss);
    	$this->assign('stars',$starlist);
    	//$this->assign('row',$livelist);
    	//$this->assign('res',$videolist);
    	$this->assign('star',$stars);
    	$this->assign('id',$id);
    	//$this->assign('show2',$show2);
    	$this->assign('show',$show);
    	$this->display('student-comment');
    }

    //老师进入自己店铺
    public function teacher(){
    	$id=$_SESSION['H_user_id'];

    	if($id){

		
		$user=D('user');
		$class=D('class');
		$history=D('history');
		$userlist=$user->table('user as u, userdata as ud')->field('u.*,ud.image')->where('u.user_id='.$id.' and u.user_id=ud.uid')->find();
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
           $pin=D('video')->table('class as c,video as v,user as u,userdata as ud')->field('v.*,u.user_id,u.name as uname,ud.image')->where('v.class_id=c.class_id and c.uid=u.user_id  and u.user_id=ud.uid and v.video_id in ('.$video.')')->select();
            
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
		$this->assign('user',$userlist);
	}
	if(!$_SESSION['H_user_id']){
			echo  "<script>alert('您尚未登录！请登录');window.location.href='".__MODULE__."/login/index';</script>"; 
			
		}
    	$class=D('class');
    	$live=D('liveb');
    	$video=D('video');
    	$pay=D('payrecord');
    	$comment=D('comment_liveb');
    	$teacher=$class->where('uid='.$id)->find();
    	if(!$teacher){
    		echo  "<script>alert('您尚未添加课堂！');parent.location.href='".__MODULE__."/index/index';</script>"; 
    	}else{
    	$time=time();
    	$classlist=$class->table('user as us,class as c,userdata as u')->field('c.*,u.image,u.profile,us.name as uname')->where('c.uid='.$id.'  and u.uid='.$id.' and us.user_id='.$id)->find();
    	$l=D('comment_liveb_star');
    	$star=$l->where('tid='.$id)->find();
    	$stars=round($star['star']/$star['num']);
    	$cid=$classlist['class_id'];
		$count1 = $live->where( "class_id=".$cid.' and endtime >'.$time)->count();
		//echo $count1;
		//$count2 = $video->where( "class_id=".$cid)->count();
		//echo $count2;
		$Page1 = new \Think\Page($count1,10);
		//$Page2 = new \Think\Page($count2,50);
    	
		$livelist=$live->where("class_id=".$cid.' and endtime >'.$time)->order('time desc')->limit($Page1 -> firstRow.','.$Page1 -> listRows)->select();
		//$videolist=$video->where('class_id='.$cid)->order('time desc')->limit($Page2 -> firstRow.','.$Page2 -> listRows)->order('time desc')->select();
		$livelistss=$live->where("class_id=".$cid.' and endtime <'.$time)->count();
		
    	$livelists=$live->where("class_id=".$cid)->select();
    	foreach($livelists as $k=>$v){
    		$livelists[$k]['ztime']=($livelists[$k]['endtime']-$livelists[$k]['time']);
    	}
    	$arr="";
			$count=count($livelists);
			//echo $count3;
			for($i = 0; $i < $count; $i++){
				if(($i+1)==$count){
				$arr += $livelists[$i]['ztime'];
				}else{
				 $arr+= $livelists[$i]['ztime'].',';
				}
			}
    	$hours=floor($arr/3600);
    	$m=($arr%3600);
    	$minute=floor($m/60);
    	$payrecord=$pay->where('uid='.$id)->count();
    	// dump($livelist);
    	//dump($payrecord);
    	$show1 = $Page1 ->show();
	    //dump($show1);
	    //$show2 = $Page2 ->show();
	   // $show = $Page ->show();
    	$this->assign('minute',$minute);
    	$this->assign('pay',$payrecord);
    	$this->assign('hours',$hours);
    	$this->assign('class',$classlist);
    	$this->assign('row',$livelist);
    	$this->assign('lists',$livelistss);
    	//$this->assign('res',$videolist);
    	$this->assign('thistime',time());
    	$this->assign('thattime',time()+600);
    	$where['time']=array('elt',time()+600);
    	$there['endtime']=array('gt',time());
    	$where['class_id']=$cid;
    	$list=$live->where($where)->count();
    	$this->assign('listcount',$list);
    	$this->assign('star',$stars);
    	//$this->assign('stars',$starlist);
    	$this->assign('show1',$show1);
    	//$this->assign('show2',$show2);
    	//$this->assign('show',$show);
    	$this->display();
    	}
    }
       public function teachervideo(){
    	$id=$_SESSION['H_user_id'];

    	if($id){

		
		$user=D('user');
		$class=D('class');
		$history=D('history');
		$userlist=$user->table('user as u, userdata as ud')->field('u.*,ud.image')->where('u.user_id='.$id.' and u.user_id=ud.uid')->find();
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
           $pin=D('video')->table('class as c,video as v,user as u,userdata as ud')->field('v.*,u.user_id,u.name as uname,ud.image')->where('v.class_id=c.class_id and c.uid=u.user_id  and u.user_id=ud.uid and v.video_id in ('.$video.')')->select();
            
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
		$this->assign('user',$userlist);
	}
	if(!$_SESSION['H_user_id']){
			echo  "<script>alert('您尚未登录！请登录');window.location.href='".__MODULE__."/login/index';</script>"; 
			
		}
    	$class=D('class');
    	$live=D('liveb');
    	$video=D('video');
    	$pay=D('payrecord');
    	$comment=D('comment_liveb');
    	$teacher=$class->where('uid='.$id)->find();
    	if(!$teacher){
    		echo  "<script>alert('您尚未添加课堂！');parent.location.href='".__MODULE__."/index/index';</script>"; 
    	}else{
    	$time=time();
    	$classlist=$class->table('user as us,class as c,userdata as u')->field('c.*,u.image,u.profile,us.name as uname')->where('c.uid='.$id.'  and u.uid='.$id.' and us.user_id='.$id)->find();
    	//$tid=$classlist['teacher_id'];
    	//$count=$comment->where('tid='.$id)->count();
    	//dump($star);
    	//$Page = new \Think\Page($count,50);
    	//$starlist=$comment->table('comment_liveb as c,user as u,userdata as ud')->field('c.*,u.name,ud.image')->where('c.tid='.$id.' and c.uid=u.user_id and ud.uid=c.uid')->limit($Page -> firstRow.','.$Page -> listRows)->order('time desc')->select();
    	//dump($starlist);
    	/*foreach($starlist as $k=>$v){
    		
    		$name=$v['name'];
				$b=mb_substr($name,mb_strlen($name,'utf-8')-1,1,'utf-8');
				$c=mb_substr($name,0,1,'utf-8');
		
				$starlist[$k]['name']=$c.'**'.$b;
    	}*/
    	$l=D('comment_liveb_star');
    	$star=$l->where('tid='.$id)->find();
    	$stars=round($star['star']/$star['num']);
    	$cid=$classlist['class_id'];
		//$count1 = $live->where( "class_id=".$cid.' and endtime >'.$time)->count();
		//echo $count1;
		$count2 = $video->where( "class_id=".$cid)->count();
		//echo $count2;
		//$Page1 = new \Think\Page($count1,50);
		$Page2 = new \Think\Page($count2,10);
    	
		//$livelist=$live->where("class_id=".$cid.' and endtime >'.$time)->order('time desc')->limit($Page1 -> firstRow.','.$Page1 -> listRows)->select();
		$videolist=$video->where('class_id='.$cid)->order('time desc')->limit($Page2 -> firstRow.','.$Page2 -> listRows)->order('time desc')->select();
		$livelistss=$live->where("class_id=".$cid.' and endtime <'.$time)->count();
		
    	$livelists=$live->where("class_id=".$cid)->select();
    	foreach($livelists as $k=>$v){
    		$livelists[$k]['ztime']=($livelists[$k]['endtime']-$livelists[$k]['time']);
    	}
    	$arr="";
			$count=count($livelists);
			//echo $count3;
			for($i = 0; $i < $count; $i++){
				if(($i+1)==$count){
				$arr += $livelists[$i]['ztime'];
				}else{
				 $arr+= $livelists[$i]['ztime'].',';
				}
			}
    	$hours=floor($arr/3600);
    	$m=($arr%3600);
    	$minute=floor($m/60);
    	$payrecord=$pay->where('uid='.$id)->count();
    	// dump($livelist);
    	//dump($payrecord);
    	//$show1 = $Page1 ->show();
	    //dump($show1);
	    $show2 = $Page2 ->show();
	    //$show = $Page ->show();
    	$this->assign('minute',$minute);
    	$this->assign('pay',$payrecord);
    	$this->assign('hours',$hours);
    	$this->assign('class',$classlist);
    	//$this->assign('row',$livelist);
    	$this->assign('lists',$livelistss);
    	$this->assign('res',$videolist);
    	$this->assign('thistime',time());
    	$this->assign('thattime',time()+600);
    	$where['time']=array('elt',time()+600);
    	$there['endtime']=array('gt',time());
    	$where['class_id']=$cid;
    	$list=$live->where($where)->count();
    	$this->assign('listcount',$list);
    	$this->assign('star',$stars);
    	//$this->assign('stars',$starlist);
    	//$this->assign('show1',$show1);
    	$this->assign('show2',$show2);
    	//$this->assign('show',$show);
    	$this->display('teacher-video');
    	}
    }
        public function teachercomment(){
    	$id=$_SESSION['H_user_id'];

    	if($id){

		
		$user=D('user');
		$class=D('class');
		$history=D('history');
		$userlist=$user->table('user as u, userdata as ud')->field('u.*,ud.image')->where('u.user_id='.$id.' and u.user_id=ud.uid')->find();
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
           $pin=D('video')->table('class as c,video as v,user as u,userdata as ud')->field('v.*,u.user_id,u.name as uname,ud.image')->where('v.class_id=c.class_id and c.uid=u.user_id  and u.user_id=ud.uid and v.video_id in ('.$video.')')->select();
            
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
		$this->assign('user',$userlist);
	}
	if(!$_SESSION['H_user_id']){
			echo  "<script>alert('您尚未登录！请登录');window.location.href='".__MODULE__."/login/index';</script>"; 
			
		}
    	$class=D('class');
    	$live=D('liveb');
    	$video=D('video');
    	$pay=D('payrecord');
    	$comment=D('comment_liveb');
    	$teacher=$class->where('uid='.$id)->find();
    	if(!$teacher){
    		echo  "<script>alert('您尚未添加课堂！');parent.location.href='".__MODULE__."/index/index';</script>"; 
    	}else{
    	$time=time();
    	$classlist=$class->table('user as us,class as c,userdata as u')->field('c.*,u.image,u.profile,us.name as uname')->where('c.uid='.$id.'  and u.uid='.$id.' and us.user_id='.$id)->find();
    	//$tid=$classlist['teacher_id'];
    	$count=$comment->where('tid='.$id)->count();
    	//dump($star);
    	$Page = new \Think\Page($count,10);
    	$starlist=$comment->table('comment_liveb as c,user as u,userdata as ud')->field('c.*,u.name,ud.image')->where('c.tid='.$id.' and c.uid=u.user_id and ud.uid=c.uid')->limit($Page -> firstRow.','.$Page -> listRows)->order('time desc')->select();
    	//dump($starlist);
    	foreach($starlist as $k=>$v){
    		
    		$name=$v['name'];
				$b=mb_substr($name,mb_strlen($name,'utf-8')-1,1,'utf-8');
				$c=mb_substr($name,0,1,'utf-8');
		
				$starlist[$k]['name']=$c.'**'.$b;
    	}
    	$l=D('comment_liveb_star');
    	$star=$l->where('tid='.$id)->find();
    	$stars=round($star['star']/$star['num']);
    	$cid=$classlist['class_id'];
		//$count1 = $live->where( "class_id=".$cid.' and endtime >'.$time)->count();
		//echo $count1;
		//$count2 = $video->where( "class_id=".$cid)->count();
		//echo $count2;
		//$Page1 = new \Think\Page($count1,50);
		//$Page2 = new \Think\Page($count2,50);
    	
		//$livelist=$live->where("class_id=".$cid.' and endtime >'.$time)->order('time desc')->limit($Page1 -> firstRow.','.$Page1 -> listRows)->select();
		$videolist=$video->where('class_id='.$cid)->order('time desc')->limit($Page2 -> firstRow.','.$Page2 -> listRows)->order('time desc')->select();
		$livelistss=$live->where("class_id=".$cid.' and endtime <'.$time)->count();
		
    	$livelists=$live->where("class_id=".$cid)->select();
    	foreach($livelists as $k=>$v){
    		$livelists[$k]['ztime']=($livelists[$k]['endtime']-$livelists[$k]['time']);
    	}
    	$arr="";
			$count=count($livelists);
			//echo $count3;
			for($i = 0; $i < $count; $i++){
				if(($i+1)==$count){
				$arr += $livelists[$i]['ztime'];
				}else{
				 $arr+= $livelists[$i]['ztime'].',';
				}
			}
    	$hours=floor($arr/3600);
    	$m=($arr%3600);
    	$minute=floor($m/60);
    	$payrecord=$pay->where('uid='.$id)->count();
    	// dump($livelist);
    	//dump($payrecord);
    	//$show1 = $Page1 ->show();
	    //dump($show1);
	    //$show2 = $Page2 ->show();
	    $show = $Page ->show();
    	$this->assign('minute',$minute);
    	$this->assign('pay',$payrecord);
    	$this->assign('hours',$hours);
    	$this->assign('class',$classlist);
    	//$this->assign('row',$livelist);
    	$this->assign('lists',$livelistss);
    	//$this->assign('res',$videolist);
    	$this->assign('thistime',time());
    	$this->assign('thattime',time()+600);
    	$where['time']=array('elt',time()+600);
    	$there['endtime']=array('gt',time());
    	$where['class_id']=$cid;
    	$list=$live->where($where)->count();
    	$this->assign('listcount',$list);
    	$this->assign('star',$stars);
    	$this->assign('stars',$starlist);
    	//$this->assign('show1',$show1);
    	//$this->assign('show2',$show2);
    	$this->assign('show',$show);
    	$this->display('teacher-comment');
    	}
    }
	public function teacherajax(){
    	$id=session('H_user_id');
    	$class=M('class');
    	$classrel=$class->where('uid='.$id)->find();
    	$liveb=M('liveb');
    	$num=I('post.num');
    	$where['time']=array('elt',time()+600);
    	$there['endtime']=array('gt',time());
    	$where['class_id']=$classrel['class_id'];
    	$count=$liveb->where($where)->count();
    	if($num==$count){
    		$this->ajaxReturn('1');
    	}else{
    		$this->ajaxReturn('2');
    	}
    }	
	//验证
    public function yang(){
    	 $id=$_POST['id'];
    	 $cate=D('category');
         $zid=$cate->where('pid='.$id)->select();
         echo json_encode($zid);
         
    }
    //预约直播
	public function add(){
		$id=$_SESSION['H_user_id'];
    	if($id){
        
        $user=D('user');
        $class=D('class');
        $history=D('history');
        $userlist=$user->table('user as u, userdata as ud')->field('u.*,ud.image')->where('u.user_id='.$id.' and u.user_id=ud.uid')->find();
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
           $pin=D('video')->table('class as c,video as v,user as u,userdata as ud')->field('v.*,u.user_id,u.name as uname,ud.image')->where('v.class_id=c.class_id and c.uid=u.user_id  and u.user_id=ud.uid and v.video_id in ('.$video.')')->select();
           
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
        $this->assign('user',$userlist);
      

        }
		$cate=D('category');
		$class=D('class');
		$live=D('liveb');
		if(IS_POST){
		$upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     3145728 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
       
        $upload->rootPath  =      './Uploads/liveb/'; // 设置附件上传目录
        $upload->savePath  =     ''; // 设置附件上传（子）目录
            // 上传文件
        $info   =   $upload->upload();
        if(!$info) {// 上传错误提示错误信息  
        	 $list=$upload->getError();
        	 
             $this->ajaxReturn($list);
        	
          
           

        }else{// 上传成功 获取上传文件信息    
            $data['img']='/Uploads/liveb/'.$info['photo']['savepath'].$info['photo']['savename'];
            $data['name']=Sensitivefilter($_POST['user']);
           	$data['cate_id']=$_POST['erji'];
           	
         	$data['class_id']=$_POST['classid'];
         	$res=$_POST['time'];
         	$arr=explode('~',$res);
         	//dump($arr);
         	$data['time']=strtotime($arr[0]);
         	$data['endtime']=strtotime($arr[1]);
         	$yutime=$data['endtime']-$data['time'];
         	if($data['time']>$data['endtime']){
         		$this->ajaxReturn('开始时间不能大于结束时间！');
         	}
         	if($data['time']<time()){
         		$this->ajaxReturn('开始时间不能小于当前时间！');
         	}
         	if($yutime>7200){
         			$this->ajaxReturn('直播时间不能超过两个小时！');
         	}
         	$data['money']=Sensitivefilter($_POST['money']);
         	$data['introduce']=Sensitivefilter($_POST['wenben']);
         	$row=$live->data($data)->add();
         	if($row){
         		$this->ajaxReturn('预约成功！');
         	}
         	
         	
    }
       
    }

		else{
		    $id=$_SESSION['H_user_id'];
    	    $classlist=$class->where('uid='.$id)->find();
    	   	$class_id=$classlist['class_id'];
    	   	$livelist=$live->where('class_id='.$class_id)->select();
    	   	foreach($livelist as $k=>$v){
    	   		 if($v['time'] <time() && $v['endtime']>time()){
    	   		   echo  "<script>alert('在这个时间段你还有一场直播');window.location.href='".__MODULE__."/courses/teacher';</script>"; 
    	   		 }
    	   	}
    	  	$feilei=$classlist['cate_id'];
    	  	$list=$cate->where('pid=0 && cate_id!=1')->select();
    	  	//dump($list);
    	  	if($list['pid']==0){
    	  		$catelist=$cate->where('pid='.$feilei)->select();

    	  	}else{
    	  		$catelist=$cate->where('pid='.$list['pid'])->select();
    	  	}
			
    	  	//dump($catelist);
			$this->assign('pid',$list);
			$this->assign('class_id',$class_id);
			$this->display('addlive');
	}
		}
		//上传视频
	public function addvideo(){
		$id=$_SESSION['H_user_id'];
    	if($id){
        
        $user=D('user');
        $class=D('class');
         $history=D('history');
        $userlist=$user->table('user as u, userdata as ud')->field('u.*,ud.image')->where('u.user_id='.$id.' and u.user_id=ud.uid')->find();
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
           $pin=D('video')->table('class as c,video as v,user as u,userdata as ud')->field('v.*,u.user_id,u.name as uname,ud.image')->where('v.class_id=c.class_id and c.uid=u.user_id  and u.user_id=ud.uid and v.video_id in ('.$video.')')->select();
           
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
        $this->assign('user',$userlist);
      

        }
		$cate=D('category');
		$class=D('class');
		$live=D('liveb');
		if(IS_POST){
			$mvp['url']=$_POST['url'];
			$mvp['img']=$_POST['img'];
			$mvp['name']=Sensitivefilter($_POST['name']);
			$mvp['class_id']=$_POST['class_id'];
			$mvp['cate_id']=$_POST['cate_id'];
			$mvp['introduce']=Sensitivefilter($_POST['jieshao']);
			$mvp['money']=Sensitivefilter($_POST['money']);
			$mvp['time']=time();
			$mvp['file_id']=$_POST['fileid'];
			$video=D('video');
			$res=$video->add($mvp);
			if($res){
				$this->ajaxReturn('上传成功');
			}else{
				$this->ajaxReturn('上传失败');
			}
    }

		else{
		    $id=$_SESSION['H_user_id'];
    	    $classlist=$class->where('uid='.$id)->find();
    	   	$class_id=$classlist['class_id'];    	
    	  	$feilei=$classlist['cate_id'];
			$catelist=$cate->where('cate_id='.$feilei)->find();
			if($catelist['pid']==0){
    	  		$catelists=$cate->where('pid='.$feilei)->select();

    	  	}else{
    	  		$catelists=$cate->where('pid='.$catelist['pid'])->select();
    	  	}
			
			$this->assign('pid',$catelists);
			$this->assign('class_id',$class_id);
			$this->display('addvideo');
	}
	}
	//修改课堂信息
	public function xiuclass(){
		$id=$_SESSION['H_user_id'];
    	if($id){
        
        $user=D('user');
        $class=D('class');
         $history=D('history');
        $userlist=$user->table('user as u, userdata as ud')->field('u.*,ud.image')->where('u.user_id='.$id.' and u.user_id=ud.uid')->find();
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
           $pin=D('video')->table('class as c,video as v,user as u,userdata as ud')->field('v.*,u.user_id,u.name as uname,ud.image')->where('v.class_id=c.class_id and c.uid=u.user_id  and u.user_id=ud.uid and v.video_id in ('.$video.')')->select();
            
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
        $this->assign('user',$userlist);
      

        }
		if(IS_POST){
			$upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     3145728 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
       
        $upload->rootPath  =      './Uploads/class/'; // 设置附件上传目录
        $upload->savePath  =     ''; // 设置附件上传（子）目录
            // 上传文件
        $info   =   $upload->upload();
        if(!$info) {// 上传错误提示错误信息   
            $list=$upload->getError();
        	 
         echo  "<script>alert('$list');window.location.href='".__MODULE__."/courses/teacher';</script>"; exit;
        }else{// 上传成功 获取上传文件信息   
        	
            $data['tiaofu']='/Uploads/class/'.$info['pic1']['savepath'].$info['pic1']['savename'];
            $data['img']='/Uploads/class/'.$info['pic2']['savepath'].$info['pic2']['savename'];
            $data['name']=Sensitivefilter($_POST['user']);
            if($data['tiaofu']=="/Uploads/class/" || $data['img']=="/Uploads/class/"){
                echo  "<script>alert('图片必须上传');window.location.href='".__MODULE__."/courses/teacher';</script>"; exit;
            }else{
            	@unlink('.'.$_POST['oldpicname']); 
        	@unlink('.'.$_POST['oldtiaofu']); 
            	$class=D('class');
            //dump($data);
         	$row=$class->where('class_id='.$_POST['id'])->save($data);
         	if($row){
         		echo  "<script>alert('修改成功！');window.location.href='".__MODULE__."/courses/teacher';</script>"; 
         	}
            }
            
         	
         	
    }
       
    }
		$cid=$_GET['id'];
		$class=D('class');
		$classlist=$class->where('class_id='.$cid)->find();
		$this->assign('list',$classlist);
		$this->assign('id',$cid);
		$this->display('course-inform');
	}
	public function jubao(){
		$id=$_SESSION['H_user_id'];

		/*if($_POST['phone']=="" || $_POST['content']==''){
         		echo  "<script>alert('举报内容不能为空！');window.location.href='".__MODULE__."/courses/index';</script>"; exit;
         	}*/
			$upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     3145728 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
       
        $upload->rootPath  =      './Uploads/teacher_report/'; // 设置附件上传目录
        $upload->savePath  =     ''; // 设置附件上传（子）目录
            // 上传文件
        $info   =   $upload->upload();
        if(!$info) {// 上传错误提示错误信息   
            $list=$upload->getError();
        	 
         echo  "<script>alert('$list');window.location.href='".__MODULE__."/courses/index';</script>"; 
        }else{// 上传成功 获取上传文件信息    
            $data['img']='/Uploads/teacher_report/'.$info['pic1']['savepath'].$info['pic1']['savename'];
         	//dump($arr);
         	 if($data['img']=="/Uploads/teacher_report/"){
                echo  "<script>alert('图片必须上传');window.location.href='".__MODULE__."/courses/index';</script>"; exit;
            }
          	/* dump($_POST['content']);
          	 die();*/
         	if($_POST['content']==null){
         		echo  "<script>alert('举报内容不能为空');window.location.href='".__MODULE__."/courses/index';</script>"; exit;
         	}
         	if($_POST['phone']==null){
         		echo  "<script>alert('手机号不能为空');window.location.href='".__MODULE__."/courses/index';</script>"; exit;   
         	}
         	else{
         	$cate=$_POST['cate'];
         	$data['contact']=$_POST['phone'];
         	$data['text']=Sensitivefilter($_POST['content']);
         	$data['uid']=$id;
         	$data['teacher_id']=$_POST['teacher'];
         	$data['time']=time();
         	foreach($cate as $v){
         		$data['cate'].=$v.',';
         	}
         	/*dump($data);
         	die();*/
         	
         	$report=D('report');
         	$row=$report->data($data)->add();
         	if($row){
         		echo  "<script>alert('举报成功！');window.location.href='".__MODULE__."/courses/index';</script>"; 
         	}
         }	
         	
    }
	}
}