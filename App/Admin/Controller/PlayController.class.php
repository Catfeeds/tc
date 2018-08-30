<?php

namespace Admin\Controller;

use Think\Controller;

class PlayController extends BaseController{
	public $key='IJ5WhlPcYipk4RZZvJu3P0E9eacQCTFa';
    public $userid='B561FC9EF6720EA1';
	public function index(){
        $this->display();
    }
    //直播审核
   public function showlist(){
   	$this -> assign('imgURL',  C('IMG_URL'));
   	if(I("serchWord")!=null&&I("serchWord")!=""){
			$sql=" and c.name like '%".I("serchWord")."%' ";
		}else{
			$sql=" and 0=0 ";
		}
	$l=D('goods');
	$select="select g.img,g.name,g.introduce,g.class_id,g.recommend,g.type,g.astatus,g.status,g.time,g.money,g.liveb_status,g.goods_id,c.name as uname,g.starttime,g.endtime,c.roomcard,g.roomid from goods as g,class as c where g.class_id=c.class_id and g.type=1 ".$sql." or g.class_id=c.class_id and g.type=6".$sql;

	$live=$l->query($select);
	//dump($live);
	/*$video=S('video');
	$select=$video->where('video_id='.$v['video_id'])->find();*/
	$auth=D('adminrauth');
	$uid=session('user.id');
	$list=$auth->where('admin_id='.$uid)->select();
	$a="";
	foreach($list as $k=>$v){
		$a.=$v['auth_id'].',';
	}
	//dump ($a);
	 $img="http://wyk-img-1255995999.cos.ap-beijing.myqcloud.com";
            $this->assign('img',$img);
	$this->assign('res',$a);
	$this->assign('row',$live);
   	$this->display();
   } 
   // 
	//  ShopController.class.php
	//  数据删除

	 public function close_room(){
        $roomid=I('post.roomid');
        $thqs='userid='.$this->userid;
        $thqs.='&roomid='.$roomid;
        $data=$this->thqs($thqs);
        $url="https://ccapi.csslcloud.net/api/room/close?$data";
        $url1="https://ccapi.csslcloud.net/api/room/live/stop?$data";
        $result1=$this->request($url1);
        $result=$this->request($url);

        $goods=M('goods')->where(array('roomid'=>$roomid))->find();
//        dump($goods);exit;
        if($result['result']=='OK'){

            /*$mvp['roomid']=null;
            $mvp['roompass']=null;*/
            $mvp['liveb_status']='0';
            $mvp['del_status']='1';
            M('goods')->where(array('goods_id'=>$goods['goods_id']))->save($mvp);
            echo 'OK';
        }else{
        	echo 'NO';
        }
       
        
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
	//推荐直播
	public function xianshi(){
		$dataId=I("id");
		$data=M("goods")->where(" goods_id = ".$dataId)->find();
		$data["recommend"]="1";
		M("goods")->where('goods_id='.$dataId)->data($data)->save();
		adminLog("推荐直播",$dataId,"","成功","");
		
		$this->ajaxReturn(interfaceReturn(0,'成功',""));
	}
	
	//取消推荐直播
	public function yincang(){
		$dataId=I("id");
		$data=M("goods")->where(" goods_id = ".$dataId)->find();
		$data["recommend"]="0";
		M("goods")->data($data)->save();
		
		adminLog("取消推荐直播",$dataId,"","成功","");
		
		$this->ajaxReturn(interfaceReturn(0,'成功',""));
	}
	
	//上线直播
	public function shangxian(){
		$dataId=I("id");
		$data=M("goods")->where(" goods_id = ".$dataId)->find();
		$data["status"]="0";
		M("goods")->data($data)->save();
		adminLog("上线直播",$dataId,"","成功","");
		
		$this->ajaxReturn(interfaceReturn(0,'成功',""));
	}
	
	//下线直播
	public function xiaxian(){
		$dataId=I("id");
		$data=M("goods")->where(" goods_id = ".$dataId)->find();
		$data["status"]="1";
		M("goods")->data($data)->save();
		
		adminLog("下线直播",$dataId,"","成功","");
		
		$this->ajaxReturn(interfaceReturn(0,'成功',""));
	} 
	//添加拒绝原因界面
	public function showrefuse(){
           	//$pids=$_GET['id'];
            $pid=$_GET['pid'];
            
           /* if($pids!=""){
            $select=D('Prove')->where('prove_id in ('.$pids.')')->select();
           // dump($select);
            foreach($select as $k=>$v){
            if($select[$k]['status']==1){
                echo "<script>alert('该用户已通过审核');parent.location.href='".__MODULE__."/Prove/school';</script>";
                return;
            }
        }
    }*/
            //$this->assign('id',$pids);
            $this->assign('pid',$pid);
			$this->display("Play/refuse");
		
	}
	public function lshowrefuse(){
           	//$pids=$_GET['id'];
            $pid=$_GET['pid'];
            
           /* if($pids!=""){
            $select=D('Prove')->where('prove_id in ('.$pids.')')->select();
           // dump($select);
            foreach($select as $k=>$v){
            if($select[$k]['status']==1){
                echo "<script>alert('该用户已通过审核');parent.location.href='".__MODULE__."/Prove/school';</script>";
                return;
            }
        }
    }*/
            //$this->assign('id',$pids);
            $this->assign('pid',$pid);
			$this->display("Play/refusel");
		
	}
	//审核拒绝
	public function refuse(){
		$dataId=I("pid");
		$option=I('txtRefuse');
		$data=M("goods")->where(" goods_id = ".$dataId)->find();
		$data["astatus"]="2";
		$res=M("goods")->data($data)->save();
		$select=M('goods')->where(" goods_id = ".$dataId)->find();
		$class=M('class')->where('class_id='.$select['class_id'])->find();
		$news=D('news');
		$user=D('user');
        $tui=$user->field('device_tokens')->where('user_id='.$class['uid'])->find();
         
        if($res!=''){
            if($tui['device_tokens']==''){
            	if($select['type']==1 || $select['type']==6){
            		$date['title']='您的直播审核拒绝';
		            $date['content']='您的直播审核拒绝，拒绝原因:'.$option;
		            $date['time']=time();
		            $date['uid']=$class['uid'];
		            $date['tuisong']=1;
		            $date['type']='1';
		            $newslist=$news->data($date)->add();
		            echo 1;
            	}else{
            		$date['title']='您的套课审核拒绝';
		            $date['content']='您的套课审核拒绝:拒绝原因'.$option;
		            $date['time']=time();
		            $date['uid']=$class['uid'];
		            $date['tuisong']=1;
		            $date['type']='1';
		            $newslist=$news->data($date)->add();
		            echo 1;
            	}
            
        }else{
            if(strlen($tui['device_tokens'])==64){
            	if($select['type']==1 || $select['type']==6){
            		$date['title']='您的直播审核拒绝';
		            $date['content']='您的直播审核拒绝，拒绝原因:'.$option;
		            $date['time']=time();
		            $date['uid']=$class['uid'];
		            $date['tuisong']=1;
		            $date['type']='1';
		            $newslist=$news->data($date)->add();
		            vendor('Umeng.Demo');
		            $demo = new \Demo("5afa49fdb27b0a365600013b", "qp22lyrj6twuswsxiuhejnerogyfsevn");
		            $ios=$demo->sendIOSUnicast("您的直播审核拒绝","您的直播审核拒绝:拒绝原因".$option,$tui['device_tokens']);   
            	}else{
            		$date['title']='您的套课审核拒绝';
		            $date['content']='您的套课审核拒绝:拒绝原因'.$option;
		            $date['time']=time();
		            $date['uid']=$class['uid'];
		            $date['tuisong']=1;
		            $date['type']='1';
		            $newslist=$news->data($date)->add();
		            vendor('Umeng.Demo');
		            $demo = new \Demo("5afa49fdb27b0a365600013b", "qp22lyrj6twuswsxiuhejnerogyfsevn");
		            $ios=$demo->sendIOSUnicast("您的套课审核拒绝","您的套课审核拒绝:拒绝原因".$option,$tui['device_tokens']);   
            	}
	            
            
        }else{
        	if($select['type']==1 || $select['type']==6){
        		$date['title']='您的直播审核拒绝';
	            $date['content']='您的直播审核拒绝，拒绝原因:'.$option;
	            $date['time']=time();
	            $date['uid']=$class['uid'];
	            $date['tuisong']=1;
	            $date['type']='1';
	            $newslist=$news->data($date)->add();
	            vendor('Umeng.Demo');
	            $umeng=new \Demo("5afa46ef8f4a9d19f600008c", "kdockprelcj3qlth6vgthymejczsr2uu"); 
	       
	            $android=$umeng->sendAndroidUnicast("您的直播审核拒绝","您的直播审核拒绝:拒绝原因".$option,$tui['device_tokens']);
        	}else{
        		$date['title']='您的套课审核拒绝';
	            $date['content']='您的套课审核拒绝:拒绝原因'.$option;
	            $date['time']=time();
	            $date['uid']=$class['uid'];
	            $date['tuisong']=1;
	            $date['type']='1';
	            $newslist=$news->data($date)->add();
	            vendor('Umeng.Demo');
	            $umeng=new \Demo("5afa46ef8f4a9d19f600008c", "kdockprelcj3qlth6vgthymejczsr2uu"); 
	       
	            $android=$umeng->sendAndroidUnicast("您的套课审核拒绝","您的套课审核拒绝:拒绝原因".$option,$tui['device_tokens']);
        	}
            
          
           
        }
        }
       
        }else{
          echo 2;  
        }
		
	}
	//审核视频拒绝
	public function videorefuse(){
		if(IS_POST){
			$dataId=I("pid");
			$option=I('post.txtRefuse');
			$data=M("video")->where(" video_id = ".$dataId)->find();
			$data["status"]="2";
			$res=M("video")->data($data)->save();
			$select=M("video")->where(" video_id = ".$dataId)->find();
			$user=D('user');
			$news=D('news');
	        $tui=$user->field('device_tokens')->where('user_id='.$select['uid'])->find();
        if($res!=''){
            if($tui['device_tokens']==''){
            $date['title']='您的视频审核被拒绝';
            $date['content']='您的视频审核被拒绝：拒绝原因'.$option;
            $date['time']=time();
            $date['uid']=$select['uid'];
            $date['tuisong']=1;
            $date['type']='1';
            $newslist=$news->data($date)->add();
            echo 1;
        }else{
             if(strlen($tui['device_tokens'])==64){
            $date['title']='您的视频审核被拒绝';
            $date['content']='您的视频审核被拒绝：拒绝原因'.$option;
            $date['time']=time();
            $date['uid']=$select['uid'];
            $date['tuisong']=1;
            $date['type']='1';
            $newslist=$news->data($date)->add();
            vendor('Umeng.Demo');
            $demo = new \Demo("5afa49fdb27b0a365600013b", "qp22lyrj6twuswsxiuhejnerogyfsevn");
            $ios=$demo->sendIOSUnicast("您的视频审核被拒绝","您的视频审核被拒绝:拒绝原因".$option,$tui['device_tokens']);   
            
        }else{
            $date['title']='您的视频审核被拒绝';
            $date['content']='您的视频审核被拒绝：拒绝原因'.$option;
            $date['time']=time();
            $date['uid']=$select['uid'];
            $date['tuisong']=1;
            $date['type']='1';
            $newslist=$news->data($date)->add();
            vendor('Umeng.Demo');
            $umeng=new \Demo("5afa46ef8f4a9d19f600008c", "kdockprelcj3qlth6vgthymejczsr2uu"); 
       
            $android=$umeng->sendAndroidUnicast("您的视频审核被拒绝","您的视频审核被拒绝:拒绝原因".$option,$tui['device_tokens']);
          
           
        }
        }
       
        }else{
          echo 2;  
        }
		}
		
	}
	//审核通过
	public function pass(){
		$dataId=I("id");
		$data=M("goods")->where(" goods_id = ".$dataId)->find();
		$mvp["astatus"]="1";
		if($data['type']=='1' || $data['type']=='6'){
			$mvp['status']='0';
		    $res=M("goods")->where(" goods_id = ".$dataId)->data($mvp)->save();
		}else{
			$res=M("goods")->where(" goods_id = ".$dataId)->data($mvp)->save();
		}
		
		$select=M('goods')->where(" goods_id = ".$dataId)->find();
		$class=M('class')->where('class_id='.$select['class_id'])->find();
		$news=D('news');
		$user=D('user');
        $tui=$user->field('device_tokens')->where('user_id='.$class['uid'])->find();
        if($res!=''){
            if($tui['device_tokens']==''){
            	if($select['type']=='1' || $select['type']=='6'){
            		$date['title']='您的直播审核通过';
		            $date['content']='您的直播审核通过';
		            $date['time']=time();
		            $date['uid']=$class['uid'];
		            $date['tuisong']=1;
		            $date['type']='1';
		            $newslist=$news->data($date)->add();
		            echo 1;
            	}else{
            		$date['title']='您的套课审核通过';
		            $date['content']='您的套课审核通过';
		            $date['time']=time();
		            $date['uid']=$class['uid'];
		            $date['tuisong']=1;
		            $date['type']='1';
		            $newslist=$news->data($date)->add();
		            echo 1;
            	}
            
        }else{
            if(strlen($tui['device_tokens'])==64){
            	if($select['type']=='1' || $select['type']=='6'){
            		$date['title']='您的直播审核通过';
		            $date['content']='您的直播审核通过';
		            $date['time']=time();
		            $date['uid']=$class['uid'];
		            $date['tuisong']=1;
		            $date['type']='1';
		            $newslist=$news->data($date)->add();
		            vendor('Umeng.Demo');
		            $demo = new \Demo("5afa49fdb27b0a365600013b", "qp22lyrj6twuswsxiuhejnerogyfsevn");
		            $ios=$demo->sendIOSUnicast("您的直播审核通过","您的直播审核通过",$tui['device_tokens']);   
            	}else{
            		$date['title']='您的套课审核通过';
		            $date['content']='您的套课审核通过';
		            $date['time']=time();
		            $date['uid']=$class['uid'];
		            $date['tuisong']=1;
		            $date['type']='1';
		            $newslist=$news->data($date)->add();
		            vendor('Umeng.Demo');
		            $demo = new \Demo("5afa49fdb27b0a365600013b", "qp22lyrj6twuswsxiuhejnerogyfsevn");
		            $ios=$demo->sendIOSUnicast("您的套课审核通过","您的套课审核通过",$tui['device_tokens']);   
            	}
	            
            
        }else{
        	if($select['type']=='1' || $select['type']=='6'){
        		$date['title']='您的直播审核通过';
	            $date['content']='您的直播审核通过';
	            $date['time']=time();
	            $date['uid']=$class['uid'];
	            $date['tuisong']=1;
	            $date['type']='1';
	            $newslist=$news->data($date)->add();
	            vendor('Umeng.Demo');
	            $umeng=new \Demo("5afa46ef8f4a9d19f600008c", "kdockprelcj3qlth6vgthymejczsr2uu"); 
	       
	            $android=$umeng->sendAndroidUnicast("您的直播审核通过","您的直播审核通过",$tui['device_tokens']);
        	}else{
        		$date['title']='您的套课审核通过';
	            $date['content']='您的套课审核通过';
	            $date['time']=time();
	            $date['uid']=$class['uid'];
	            $date['tuisong']=1;
	            $date['type']='1';
	            $newslist=$news->data($date)->add();
	            vendor('Umeng.Demo');
	            $umeng=new \Demo("5afa46ef8f4a9d19f600008c", "kdockprelcj3qlth6vgthymejczsr2uu"); 
	       
	            $android=$umeng->sendAndroidUnicast("您的套课审核通过","您的套课审核通过",$tui['device_tokens']);
        	}
            
          
           
        }
        }
       
        }else{
          echo 2;  
        }
		
	}
	//审核视频通过
	public function videopass(){
		$dataId=I("id");
		$data=M("video")->where(" video_id = ".$dataId)->find();
		$data["status"]="1";
		$res=M("video")->data($data)->save();
		$select=M("video")->where(" video_id = ".$dataId)->find();
		$news=D('news');
		$user=D('user');
        $tui=$user->field('device_tokens')->where('user_id='.$select['uid'])->find();
        if($res!=''){
            if($tui['device_tokens']==''){
            $date['title']='您的视频审核通过';
            $date['content']='您的视频审核通过';
            $date['time']=time();
            $date['uid']=$select['uid'];
            $date['tuisong']=1;
            $date['type']='1';
            $newslist=$news->data($date)->add();
            echo 1;
        }else{
             if(strlen($tui['device_tokens'])==64){
                $date['title']='您的视频审核通过';
            $date['content']='您的视频审核通过';
            $date['time']=time();
            $date['uid']=$select['uid'];
            $date['tuisong']=1;
            $date['type']='1';
            $newslist=$news->data($date)->add();
            vendor('Umeng.Demo');
            $demo = new \Demo("5afa49fdb27b0a365600013b", "qp22lyrj6twuswsxiuhejnerogyfsevn");
            $ios=$demo->sendIOSUnicast("您的视频审核通过","您的视频审核通过",$tui['device_tokens']);   
            
        }else{
            $date['title']='您的视频审核通过';
            $date['content']='您的视频审核通过';
            $date['time']=time();
            $date['uid']=$select['uid'];
            $date['tuisong']=1;
            $date['type']='1';
            $newslist=$news->data($date)->add();
            vendor('Umeng.Demo');
            $umeng=new \Demo("5afa46ef8f4a9d19f600008c", "kdockprelcj3qlth6vgthymejczsr2uu"); 
       
            $android=$umeng->sendAndroidUnicast("您的视频审核通过","您的视频审核通过",$tui['device_tokens']);
          
           
        }
        }
       
        }else{
          echo 2;  
        }
	}
	//视频审核
	public function showlistYue(){
   	$this -> assign('imgURL',  C('IMG_URL'));
   	if(I("serchWord")!=null&&I("serchWord")!=""){
			$sql=" and c.name like '%".I("serchWord")."%' ";
		}else{
			$sql=" and 0=0 ";
		}
	$l=D('video');
	$select="select v.*,c.name as uname from video as v,class as c where v.uid=c.uid  ".$sql."or v.uid=c.uid".$sql;
	$live=$l->query($select);
	//dump($live);
	$auth=D('adminrauth');
	$uid=session('user.id');
	$list=$auth->where('admin_id='.$uid)->select();
	$a="";
	foreach($list as $k=>$v){
		$a.=$v['auth_id'].',';
	}
	 $img="http://wyk-img-1255995999.cos.ap-beijing.myqcloud.com";
            $this->assign('img',$img);
	//dump ($a);
	$this->assign('res',$a);
	$this->assign('row',$live);
   	$this->display('Play/showlistyuyue');
   }
//   public function dataDelyue(){
//		$dataId=I("id");
//		M("liveb")->delete($dataId);
//		adminLog("删除直播","","","成功","");
//		$this->ajaxReturn(interfaceReturn(0,'成功',""));
//	}
	
	//推荐视频
	public function xianshiyue(){
		$dataId=I("id");
		$data=M("goods")->where(" goods_id = ".$dataId)->find();
		$data["recommend"]="1";
		M("goods")->data($data)->save();
		adminLog("推荐视频",$dataId,"","成功","");
		
		$this->ajaxReturn(interfaceReturn(0,'成功',""));
	}
	
	//取消推荐视频
	public function yincangyue(){
		$dataId=I("id");
		$data=M("goods")->where(" goods_id = ".$dataId)->find();
		$data["recommend"]="0";
		M("goods")->data($data)->save();
		
		adminLog("取消推荐视频",$dataId,"","成功","");
		
		$this->ajaxReturn(interfaceReturn(0,'成功',""));
	}
	
	//上线视频
	public function shangxianyue(){
		$dataId=I("id");
		$data=M("goods")->where(" goods_id = ".$dataId)->find();
		$data["status"]="0";
		M("goods")->data($data)->save();
		adminLog("上线视频",$dataId,"","成功","");
		
		$this->ajaxReturn(interfaceReturn(0,'成功',""));
	}
	
	//下线视频
	public function xiaxianyue(){
		$dataId=I("id");
		$data=M("goods")->where(" goods_id = ".$dataId)->find();
		$data["status"]="1";
		M("goods")->data($data)->save();
		
		adminLog("下线视频",$dataId,"","成功","");
		
		$this->ajaxReturn(interfaceReturn(0,'成功',""));
	} 
//	public function dataedit(){
//		 $this -> assign('imgURL',  C('IMG_URL'));
//		$dataId=I("id");
//		$data=M("liveb")->where(" liveb_id = ".$dataId)->find();
//		$m=D('user');
//		$select=$m->table('user as u,class as c,liveb as l')->field('u.name as uname')->where('u.user_id=c.uid and l.class_id=c.class_id and l.liveb_id='.$dataId)->find();
//		dump($select);
//	    $this->assign('name',$data["name"]);
//	    $this->assign('uname',$select["uname"]);
//	    $this->assign('img',$data["img"]);
//	    $this->assign('time',$data["time"]);
//	    $this->assign('endtime',$data["endtime"]);
//	    $this->assign('introduce',$data["introduce"]);
//	    $this->assign('liveb_id',$data["liveb_id"]);
//	      $this->display('edit');
//	}
//	public function dataEdit_Sub(){
//    	if($_FILES['photo']['error']!=4){
//		 	$upload = new \Think\Upload();// 实例化上传类
//            $upload->maxSize   =     3145728 ;// 设置附件上传大小
//            $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg','pdf');// 设置附件上传类型
//            $upload->rootPath  =     './Uploads/liveb/'; // 设置附件上传根目录
//            $upload->savePath  =     ''; // 设置附件上传（子）目录
//            // 上传文件
//            $info   =   $upload->upload();
//            if(!$info) {// 上传错误提示错误信息
//                $this->error($upload->getError());
//            }else{// 上传成功
//            	@unlink('.'.$_POST['oldpicname']);
//            	//dump($_POST['oldpicname']);
//            	//die();
//            	$n=D('liveb');
//            	$data['name']=I('post.name');
//            	$data['img']='/Uploads/liveb/'.$info['photo']['savepath'].$info['photo']['savename'];
//            	$data['time']=I('post.time');
//            	$data['endtime']=I('post.endtime');
//            	$data['introduce']=I('post.introduce');
//		$data["time"]=strtotime($data["time"]);
//		$data["endtime"]=strtotime($data["endtime"]);
//		$dataRetID=$n ->where('liveb_id='.$_POST['liveb_id'])->save($data);
//		$select=$n->table('user as u,class as c,liveb as l')->field('u.user_id')->where('u.user_id=c.uid and l.class_id=c.class_id and l.liveb_id='.$_POST['liveb_id'])->find();
//		$m=D('user');
//		$uname=I('post.uname');
//		$row="update user set name='{$uname}' where user_id=".$select['user_id'];
//		$res=$m->execute($row);
//		adminLog("编辑直播",$_POST["liveb_id"],"","成功","");
//		/*if($dataRetID){
//				echo "<script>alert('修改成功');parent.location.href='".__MODULE__."/Notice/showList';</script>";
//		}else{
//				echo "<script>alert('添加失败');parent.location.href='".__MODULE__."/Notice/showList';</script>";
//		}*/
//		$this->ajaxReturn(interfaceReturn(0,'成功',""));
//		}
//
//
//
//    }else{
//    	$n=D('liveb');
//            	$data['name']=I('post.name');
//            	$data['img']=I('post.oldpicname');
//            	$data['time']=I('post.time');
//            	$data['endtime']=I('post.endtime');
//            	$data['introduce']=I('post.introduce');
//		$data["time"]=strtotime($data["time"]);
//		$data["endtime"]=strtotime($data["endtime"]);
//		$dataRetID=$n ->where('liveb_id='.$_POST['liveb_id'])->save($data);
//		$select=$n->table('user as u,class as c,liveb as l')->field('u.user_id')->where('u.user_id=c.uid and l.class_id=c.class_id and l.liveb_id='.$_POST['liveb_id'])->find();
//		$m=D('user');
//		$uname=I('post.uname');
//		$row="update user set name='{$uname}' where user_id=".$select['user_id'];
//		$res=$m->execute($row);
//		adminLog("编辑直播",$_POST["liveb_id"],"","成功","");
//		/*if($dataRetID){
//				echo "<script>alert('修改成功');parent.location.href='".__MODULE__."/Notice/showList';</script>";
//		}else{
//				echo "<script>alert('添加失败');parent.location.href='".__MODULE__."/Notice/showList';</script>";
//		}*/
//	    $this->ajaxReturn(interfaceReturn(0,'成功',""));
//    }
//}
//	public function dataedityue(){
//		 $this -> assign('imgURL',  C('IMG_URL'));
//		$dataId=I("id");
//		$data=M("liveb")->where(" liveb_id = ".$dataId)->find();
//		$m=D('user');
//		$select=$m->table('user as u,class as c,liveb as l')->field('u.name as uname')->where('u.user_id=c.uid and l.class_id=c.class_id and l.liveb_id='.$dataId)->find();
//		dump($select);
//	    $this->assign('name',$data["name"]);
//	    $this->assign('uname',$select["uname"]);
//	    $this->assign('img',$data["img"]);
//	    $this->assign('time',$data["time"]);
//	    $this->assign('endtime',$data["endtime"]);
//	    $this->assign('introduce',$data["introduce"]);
//	    $this->assign('liveb_id',$data["liveb_id"]);
//	      $this->display('yue-edit');
//	}
//	public function dataEdityue_Sub(){
//    	if($_FILES['photo']['error']!=4){
//		 	$upload = new \Think\Upload();// 实例化上传类
//            $upload->maxSize   =     3145728 ;// 设置附件上传大小
//            $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg','pdf');// 设置附件上传类型
//            $upload->rootPath  =     './Uploads/liveb/'; // 设置附件上传根目录
//            $upload->savePath  =     ''; // 设置附件上传（子）目录
//            // 上传文件
//            $info   =   $upload->upload();
//            if(!$info) {// 上传错误提示错误信息
//                $this->error($upload->getError());
//            }else{// 上传成功
//            	@unlink('.'.$_POST['oldpicname']);
//            	//dump($_POST['oldpicname']);
//            	//die();
//            	$n=D('liveb');
//            	$data['name']=I('post.name');
//            	$data['img']='/Uploads/liveb/'.$info['photo']['savepath'].$info['photo']['savename'];
//            	$data['time']=I('post.time');
//            	$data['endtime']=I('post.endtime');
//            	$data['introduce']=I('post.introduce');
//		$data["time"]=strtotime($data["time"]);
//		$data["endtime"]=strtotime($data["endtime"]);
//		$dataRetID=$n ->where('liveb_id='.$_POST['liveb_id'])->save($data);
//		$select=$n->table('user as u,class as c,liveb as l')->field('u.user_id')->where('u.user_id=c.uid and l.class_id=c.class_id and l.liveb_id='.$_POST['liveb_id'])->find();
//		$m=D('user');
//		$uname=I('post.uname');
//		$row="update user set name='{$uname}' where user_id=".$select['user_id'];
//		$res=$m->execute($row);
//		adminLog("编辑直播",$_POST["liveb_id"],"","成功","");
//		/*if($dataRetID){
//				echo "<script>alert('修改成功');parent.location.href='".__MODULE__."/Notice/showList';</script>";
//		}else{
//				echo "<script>alert('添加失败');parent.location.href='".__MODULE__."/Notice/showList';</script>";
//		}*/
//		$this->ajaxReturn(interfaceReturn(0,'成功',""));
//		}
//
//
//
//    }else{
//    	$n=D('liveb');
//        $data['name']=I('post.name');
//        $data['img']=I('post.oldpicname');
//        $data['time']=I('post.time');
//        $data['endtime']=I('post.endtime');
//        $data['introduce']=I('post.introduce');
//		$data["time"]=strtotime($data["time"]);
//		$data["endtime"]=strtotime($data["endtime"]);
//		$dataRetID=$n ->where('liveb_id='.$_POST['liveb_id'])->save($data);
//		$select=$n->table('user as u,class as c,liveb as l')->field('u.user_id')->where('u.user_id=c.uid and l.class_id=c.class_id and l.liveb_id='.$_POST['liveb_id'])->find();
//		$m=D('user');
//		$uname=I('post.uname');
//		$row="update user set name='{$uname}' where user_id=".$select['user_id'];
//		$res=$m->execute($row);
//		adminLog("编辑直播",$_POST["liveb_id"],"","成功","");
//		/*if($dataRetID){
//				echo "<script>alert('修改成功');parent.location.href='".__MODULE__."/Notice/showList';</script>";
//		}else{
//				echo "<script>alert('添加失败');parent.location.href='".__MODULE__."/Notice/showList';</script>";
//		}*/
//	    $this->ajaxReturn(interfaceReturn(0,'成功',""));
//    }
//}
//观看视频是否违规界面
 public function view(){
 	$pid=$_GET['pid'];
 	$select=D('video')->field('name,fileid')->where('video_id='.$pid)->find();

 	$this->assign('list',$select);
 	$this->display();
 }
//套课审核
public function leason(){
	$this -> assign('imgURL',  C('IMG_URL'));
   	if(I("serchWord")!=null&&I("serchWord")!=""){
			$sql=" and c.name like '%".I("serchWord")."%' ";
		}else{
			$sql=" and 0=0 ";
		}
	$l=D('goods');
	$select="select g.img,g.name,g.introduce,g.class_id,g.recommend,g.type,g.astatus,g.status,g.time,g.money,g.goods_id,c.name as uname from goods as g,class as c where g.class_id=c.class_id and g.type=3".$sql;
	$live=$l->query($select);
	//dump($live);
	$auth=D('adminrauth');
	$uid=session('user.id');
	$list=$auth->where('admin_id='.$uid)->select();
	$a="";
	foreach($list as $k=>$v){
		$a.=$v['auth_id'].',';
	}
	//dump ($a);
	 $img="http://wyk-img-1255995999.cos.ap-beijing.myqcloud.com";
            $this->assign('img',$img);
	$this->assign('res',$a);
	$this->assign('row',$live);
   	$this->display();
}
	//团购
	public function group(){
		
		
		//$this -> assign('imgURL',  C('IMG_URL'));
	   	if(I("serchWord")!=null&&I("serchWord")!=""){
				$sql=" and c.name like '%".I("serchWord")."%' ";
			}else{
				$sql=" and 0=0 ";
			}
		$l=D('goods');
		$select="select g.img,g.name,g.introduce,g.class_id,g.recommend,g.type,g.astatus,g.status,g.time,g.discount_money,g.goods_id,c.name as uname,g.group_time,g.sign_endtime,g.group_num,g.group_status,g.money from goods as g,class as c where  g.class_id=c.class_id and g.type=2 and g.astatus=1 and g.status=0 and g.price_status=2".$sql;
		$live=$l->query($select);
		//dump($live);
		foreach($live as $k=>$v){
			$group=D('groupbuy');
			$select=$group->where('pid='.$v['goods_id'])->count();
			$live[$k]['num']=$select;
		}
		$auth=D('adminrauth');
		$uid=session('user.id');
		$list=$auth->where('admin_id='.$uid)->select();
		$a="";
		foreach($list as $k=>$v){
			$a.=$v['auth_id'].',';
		}
		//dump ($a);
		 $img="http://wyk-img-1255995999.cos.ap-beijing.myqcloud.com";
	            $this->assign('img',$img);
		$this->assign('res',$a);
		$this->assign('row',$live);
	   	$this->display();
	}
	//团购开团
	public function grouppass(){
		$dataId=I("id");
		$data=M("goods")->where("goods_id = ".$dataId)->find();
		$group=D('groupbuy')->where(array('pid'=>$dataId,'paystatus'=>1))->select();
		$groupnum=D('groupbuy')->where(array('pid'=>$dataId,'paystatus'=>1))->count();
		$aaa['group_status']='1';
		$aaa['price_status']=0;
		M("goods")->where("goods_id = ".$dataId)->save($aaa);
		$money=$data['discount_money']*$groupnum;
		$class=D('class');
	    $profit=$class->where('class_id='.$data['class_id'])->setInc('profit',$money);
		foreach($group as $k=>$v){
			
			$payrecord=D('payrecord');
			$mvp['uid']=$v['uid'];
			$mvp['type']=2;
			$mvp['time']=time();
			$mvp['cid']=$v['pid'];
			$mvp['pay']=$v['money'];
			$mvp['source']=$data['name'];
			$mvp['ptype']=2;
			$mvp['ctype']=$data['type'];
			$addpay=$payrecord->add($mvp);
			if($addpay){
				
				$mmp['status']='1';

			    $pass=M('groupbuy')->where('uid='.$v['uid'])->save($mmp);

			    if($pass){
			         	
			        $news=D('news');
					$user=D('user');
			        $tui=$user->field('device_tokens')->where('user_id='.$v['uid'])->find();
			        
			            if($tui['device_tokens']==''){
			            $date['title']='您的团购已成功';
			            $date['content']='您的团购已成功';
			            $date['time']=time();
			            $date['uid']=$v['uid'];
			            $date['tuisong']=1;
			            $date['type']='1';
			            $newslist=$news->data($date)->add();
			            echo 1;
			        }else{
			             if(strlen($tui['device_tokens'])==64){
			                $date['title']='您的团购已成功';
			            $date['content']='您的团购已成功';
			            $date['time']=time();
			            $date['uid']=$v['uid'];
			            $date['tuisong']=1;
			            $date['type']='1';
			            $newslist=$news->data($date)->add();
			            vendor('Umeng.Demo');
			            $demo = new \Demo("5afa49fdb27b0a365600013b", "qp22lyrj6twuswsxiuhejnerogyfsevn");
			            $ios=$demo->sendIOSUnicast("您的团购已成功","您的团购已成功",$tui['device_tokens']);   
			            
			        }else{
			            $date['title']='您的团购已成功';
			            $date['content']='您的团购已成功';
			            $date['time']=time();
			            $date['uid']=$v['uid'];
			            $date['tuisong']=1;
			            $date['type']='1';
			            $newslist=$news->data($date)->add();
			            vendor('Umeng.Demo');
			            $umeng=new \Demo("5afa46ef8f4a9d19f600008c", "kdockprelcj3qlth6vgthymejczsr2uu"); 
			       
			            $android=$umeng->sendAndroidUnicast("您的团购已成功","您的团购已成功",$tui['device_tokens']);
			          
			           
			        }
			        }
			       
			        
			    }else{
			          echo 2;  
			        }
			}
		}
		

		/*$data["status"]="1";
		$res=M("video")->data($data)->save();
		$select=M("video")->where(" video_id = ".$dataId)->find();*/
		
	}
	//团购退款
	public function grouprefuse(){
		
		$dataId=I("id");
		$data=M("goods")->where("goods_id = ".$dataId)->find();
		//dump($data);
		$group=D('groupbuy')->where(array('pid'=>$dataId,'paystatus'=>1))->select();
		$aaa['group_status']='2';
		$aaa['price_status']=0;
		$profit=M("goods")->where("goods_id = ".$dataId)->save($aaa);
//		dump($group);
		foreach($group as $k=>$v){
//			dump($v);
			$userdata=D('userdata');
			$jian=$userdata->where('uid='.$v['uid'])->setInc('money',$v['money']);
			if($jian){
				$mmp['status']='2';
				$mmp['refund_status']='1';
			    $refuse=M('groupbuy')->where('uid='.$v['uid'])->save($mmp);
			    if($refuse){
			        $news=D('news');
					$user=D('user');
			        $tui=$user->field('device_tokens')->where('user_id='.$v['uid'])->find();
			        if($tui['device_tokens']==''){
			            $date['title']='您的团购失败';
			            $date['content']='您的团购失败';
			            $date['time']=time();
			            $date['uid']=$v['uid'];
			            $date['tuisong']=1;
			            $date['type']='1';
			            $newslist=$news->data($date)->add();
			            echo 1;
			        }else{
			             if(strlen($tui['device_tokens'])==64){
			                $date['title']='您的团购失败';
			            $date['content']='您的团购失败';
			            $date['time']=time();
			            $date['uid']=$v['uid'];
			            $date['tuisong']=1; 
			            $date['type']='1';
			            $newslist=$news->data($date)->add();
			            vendor('Umeng.Demo');
			            $demo = new \Demo("5afa49fdb27b0a365600013b", "qp22lyrj6twuswsxiuhejnerogyfsevn");
			            $ios=$demo->sendIOSUnicast("您的团购失败","您的团购失败",$tui['device_tokens']);   
			            
			        }else{
			            $date['title']='您的团购失败';
			            $date['content']='您的团购失败';
			            $date['time']=time();
			            $date['uid']=$v['uid'];
			            $date['tuisong']=1;
			            $date['type']='1';
			            $newslist=$news->data($date)->add();
			            vendor('Umeng.Demo');
			            $umeng=new \Demo("5afa46ef8f4a9d19f600008c", "kdockprelcj3qlth6vgthymejczsr2uu");
			            $android=$umeng->sendAndroidUnicast("您的团购失败","您的团购失败",$tui['device_tokens']);
			          
			           
			        }
			        }
			       
			        
			    }else{
			          echo 2;  
			        }
			}
		}
	}
	public function yue(){
		$this -> assign('imgURL',  C('IMG_URL'));
	   	if(I("serchWord")!=null&&I("serchWord")!=""){
				$sql=" and c.name like '%".I("serchWord")."%' ";
			}else{
				$sql=" and 0=0 ";
			}
		$l=D('goods');
		$select="select g.img,g.name,g.introduce,g.class_id,g.recommend,g.type,g.astatus,g.status,g.time,g.money,g.liveb_status,g.goods_id,c.name as uname,g.starttime,g.endtime,c.roomcard,g.roomid from goods as g,class as c where g.class_id=c.class_id and g.type=5 ".$sql;

		$live=$l->query($select);
		//dump($live);
		/*$video=S('video');
		$select=$video->where('video_id='.$v['video_id'])->find();*/
		$auth=D('adminrauth');
		$uid=session('user.id');
		$list=$auth->where('admin_id='.$uid)->select();
		$a="";
		foreach($list as $k=>$v){
			$a.=$v['auth_id'].',';
		}
		//dump ($a);
		 $img="http://wyk-img-1255995999.cos.ap-beijing.myqcloud.com";
	            $this->assign('img',$img);
		$this->assign('res',$a);
		$this->assign('row',$live);
	   	$this->display();
	}
}
?>	