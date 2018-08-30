<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/25 0025
 * Time: 16:37
 */


namespace Admin\Controller;

use Think\Controller;


class ProveController extends BaseController{
    //资质证明模块


	private $pid='';
    //审核机构
    public  function school(){

		$this -> assign('imgURL',  C('IMG_URL'));
        $prove=D('Prove');
        $sql="select * from prove ";
        if(IS_POST){//点击查询按钮   按照  状态和手机号查询

            $status=$_POST["selstatus"]; //状态
            $phone=$_POST["txtphone"];   //手机号码
            if($status=='0'&&$phone!=null){
                $sql=$sql."where identity='3' and status='0'  and phone like '%$phone%'  ";

            }elseif($status=='1'&&$phone!=null){
                $sql=$sql."where identity='3' and status='1'  and phone like '%$phone%'  ";
            }elseif($status=='2'&&$phone!=null){
                $sql=$sql."where identity='3' and status='2'  and phone like '%$phone%'  ";
            }elseif($status=='2' || $status=='0' ||$status=='1' && $phone==""){
                $sql=$sql."where identity='3' and status like '%$status%'";
            }elseif($status=="3" && $phone==""){
                $sql="select * from prove where identity='3'";
            }elseif($status=="3" && $phone!=""){
                $sql=$sql." where identity='3' and phone like '%$phone%'";
            }
            $info= $prove->query($sql);
             $auth=D('adminrauth');
            $uid=session('user.id');
            $list=$auth->where('admin_id='.$uid)->select();
            $a="";
            foreach($list as $k=>$v){
                $a.=$v['auth_id'].',';
            }
            //dump ($a);
            $this->assign('res',$a);
            $img="http://wyk-img-1255995999.cos.ap-beijing.myqcloud.com";
            $this->assign('img',$img);
            $this->assign('info',$info);
            $this->display();
        }else{//正常加载来的
            //服务器分页begin  前端的分页放弃
            $count      = $prove
                        ->where('identity=3')
                        ->order('time desc')
                        ->count();// 查询满足要求的总记录数
            $Page       = new \Think\Page($count,15);// 实例化分页类 传入总记录数和每页显示的记录数(25)
            $Page->lastSuffix=false;
            $Page->setConfig('header','<li class="rows">共<b>%TOTAL_ROW%</b>条记录&nbsp;&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');
            $Page->setConfig('prev','上一页');
            $Page->setConfig('next','下一页');
            $Page->setConfig('last','末页');
            $Page->setConfig('first','首页');
            $Page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
            $show       = $Page->show();// 分页显示输出
            //服务器分页end
            $info=$prove
                ->where('identity=3')
                ->order('time desc')
                ->limit($Page->firstRow.','.$Page->listRows)
                ->select();
			foreach($info as $k=>$v){
				$info[$k]['time']=date("Y-m-d H:i:s",$v['time']);
			}
//          dump($info);
            $auth=D('adminrauth');
            $uid=session('user.id');
            $list=$auth->where('admin_id='.$uid)->select();
            $a="";
            foreach($list as $k=>$v){
                $a.=$v['auth_id'].',';
            }
            //dump ($a);
            $img="http://wyk-img-1255995999.cos.ap-beijing.myqcloud.com";
            // 赋值分页输出
            $this->assign('page',$show);
            $this->assign('img',$img);
            $this->assign('res',$a);
            $this->assign('info',$info);
            $this->display();
        }
    }
    //审核学生
    public  function student(){

        $this -> assign('imgURL',  C('IMG_URL'));
        $prove=D('Prove');
        $sql="select * from prove ";
        if(IS_POST){//点击查询按钮   按照  状态和手机号查询


            $status=$_POST["selstatus"]; //状态
            $phone=$_POST["txtphone"];   //手机号码
            if($status=='0'&&$phone!=null){
                $sql=$sql."where identity='0' and status='0'  and phone like '%$phone%'  or identity='1' and status='0'  and phone like '%$phone%' or identity='2' and status='0'  and phone like '%$phone%'";

            }elseif($status=='1'&&$phone!=null){
                $sql=$sql."where identity='0' and status='1'  and phone like '%$phone%'  or identity='1' and status='1'  and phone like '%$phone%' or identity='2' and status='1'  and phone like '%$phone%'";
            }elseif($status=='2'&&$phone!=null){
                $sql=$sql."where identity='0' and status='2'  and phone like '%$phone%' or identity='1' and status='2'  and phone like '%$phone%' or identity='2' and status='2'  and phone like '%$phone%'";
            }elseif($status=='2' || $status=='0' ||$status=='1' && $phone==""){
                $sql=$sql."where identity='0' and status like '%$status%' or identity='1' and status like '%$status%' or identity='2' and status like '%$status%'";
            }elseif($status=="3" && $phone==""){
                $sql="select * from prove where identity='0' or identity='1' or identity='2'";
            }elseif($status=="3" && $phone!=""){
                $sql=$sql." where identity='0' and phone like '%$phone%' or identity='1' and phone like '%$phone%' or identity='2' and phone like '%$phone%'";
            }
            $info= $prove->query($sql);
             $auth=D('adminrauth');
            $uid=session('user.id');
            $list=$auth->where('admin_id='.$uid)->select();
            $a="";
            foreach($list as $k=>$v){
                $a.=$v['auth_id'].',';
            }
            //dump ($a);
            $this->assign('res',$a);
             $img="http://wyk-img-1255995999.cos.ap-beijing.myqcloud.com";
            $this->assign('img',$img);
            $this->assign('info',$info);
            $this->display();
        }else{//正常加载来的
            //服务器分页begin  前端的分页放弃
            $count      = $prove->where('identity=0 or identity=1 or identity=2')->count();// 查询满足要求的总记录数
            $Page       = new \Think\Page($count,15);// 实例化分页类 传入总记录数和每页显示的记录数(25)
            $Page->lastSuffix=false;
            $Page->setConfig('header','<li class="rows">共<b>%TOTAL_ROW%</b>条记录&nbsp;&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');
            $Page->setConfig('prev','上一页');
            $Page->setConfig('next','下一页');
            $Page->setConfig('last','末页');
            $Page->setConfig('first','首页');
            $Page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
            $show       = $Page->show();// 分页显示输出
            //服务器分页end
            $info=$prove
                ->where('identity=0 or identity=1 or identity=2')
                ->order('time desc')
                ->limit($Page->firstRow.','.$Page->listRows)
                ->select();
            foreach($info as $k=>$v){
                $info[$k]['time']=date("Y-m-d H:i:s",$v['time']);
                $info[$k]['gd_time']=date("Y-m-d H:i:s",$v['gd_time']);
            }
//          dump($info);
            $auth=D('adminrauth');
            $uid=session('user.id');
            $list=$auth->where('admin_id='.$uid)->select();
            $a="";
            foreach($list as $k=>$v){
                $a.=$v['auth_id'].',';
            }
            //dump ($a);
            // 赋值分页输出
            $this->assign('page',$show);
            $this->assign('res',$a);
            $img="http://wyk-img-1255995999.cos.ap-beijing.myqcloud.com";
            $this->assign('img',$img);
            $this->assign('info',$info);
            $this->display();
        }
    }
    //查看图片
    public function showtu(){
        $this -> assign('imgURL',  C('IMG_URL'));
        $prove=D("Prove");


        $prove_id=$_GET["pid"];
        $sql="select * from prove where prove_id = ".$prove_id;
        $res=$prove->query($sql);
        $img="http://wyk-img-1255995999.cos.ap-beijing.myqcloud.com";
            $this->assign('img',$img);
        $this->assign('refuse',$res);
        $this->display();

    }
     public function back(){
        $this -> assign('imgURL',  C('IMG_URL'));
        $prove=D("Prove");


        $prove_id=$_GET["pid"];
        $sql="select * from prove where prove_id = ".$prove_id;
        $res=$prove->query($sql);
        $img="http://wyk-img-1255995999.cos.ap-beijing.myqcloud.com";
            $this->assign('img',$img);
        $this->assign('refuse',$res);
        $this->display();

    }
     public function hold(){
        $this -> assign('imgURL',  C('IMG_URL'));
        $prove=D("Prove");


        $prove_id=$_GET["pid"];
        $sql="select * from prove where prove_id = ".$prove_id;
        $res=$prove->query($sql);
        $img="http://wyk-img-1255995999.cos.ap-beijing.myqcloud.com";
            $this->assign('img',$img);
        $this->assign('refuse',$res);
        $this->display();

    }
     public function certify(){
        $this -> assign('imgURL',  C('IMG_URL'));
        $prove=D("Prove");


        $prove_id=$_GET["pid"];
        $sql="select * from prove where prove_id = ".$prove_id;
        $res=$prove->query($sql);
        $img="http://wyk-img-1255995999.cos.ap-beijing.myqcloud.com";
            $this->assign('img',$img);
        $this->assign('refuse',$res);
        $this->display();

    }
     public function classimg(){
        $this -> assign('imgURL',  C('IMG_URL'));
        $prove=D("Prove");


        $prove_id=$_GET["pid"];
        $sql="select * from prove where prove_id = ".$prove_id;
        $res=$prove->query($sql);
        $img="http://wyk-img-1255995999.cos.ap-beijing.myqcloud.com";
            $this->assign('img',$img);
        $this->assign('refuse',$res);
        $this->display();

    }

    //查看拒绝原因页面
    public function showdetail(){
		$prove=D("Prove");


		$prove_id=$_GET["pid"];
		$sql="select * from prove where prove_id = ".$prove_id;
		$res=$prove->query($sql);
		
		$this->assign('refuse',$res);
		
        $this->display("Prove/view");
    }


	//添写拒绝原因
	public function showrefuse(){
            $pids=$_GET['id'];
            $pid=$_GET['pid'];
            //dump($pid);
            //dump($pids);
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
            $this->assign('id',$pids);
            $this->assign('pid',$pid);
			$this->display("Prove/reject");
		
	}
    //拒绝
 	public function addrefuse(){
		if(IS_POST){
            if($_POST['id']){
            $prove=D("livebapply");
            $news=D('news');
            $prove_refuse=I('post.txtRefuse');
            $pid=I('post.id');
    
           
                $sql="update livebapply set status=2 where livebapply_id=".$pid;
                $data=$prove->execute($sql);
                 $select=$prove->field('uid')->where('livebapply_id='.$pid)->find();
                 $user=D('user');
        $tui=$user->field('device_tokens')->where('user_id='.$select['uid'])->find();
        if($data>0){
            if($tui['device_tokens']==''){
            $mvp['title']='您的直播资质被拒绝';
            $mvp['content']='拒绝原因：'.$prove_refuse;
            $mvp['time']=time();
            $mvp['uid']=$select['uid'];
            $mvp['tuisong']=1;
            $mvp['type']='1';
            $newslist=$news->data($mvp)->add();
             echo 1;
           
        }else{
             if(strlen($tui['device_tokens'])==64){
                $mvp['title']='您的直播资质被拒绝';
            $mvp['content']='拒绝原因：'.$prove_refuse;
            $mvp['time']=time();
            $mvp['uid']=$select['uid'];
            $mvp['tuisong']=1;
            $mvp['type']='1';
            $newslist=$news->data($mvp)->add();  
            vendor('Umeng.Demo');
            $demo = new \Demo("5afa49fdb27b0a365600013b", "qp22lyrj6twuswsxiuhejnerogyfsevn");
            $ios=$demo->sendIOSUnicast("您的直播资质被拒绝",'拒绝原因:'.$prove_refuse,$tui['device_tokens']); 
            
        }else{
            $mvp['title']='您的直播资质被拒绝';
            $mvp['content']='拒绝原因：'.$prove_refuse;
            $mvp['time']=time();
            $mvp['uid']=$select['uid'];
            $mvp['tuisong']=1;
            $mvp['type']='1';
            $newslist=$news->data($mvp)->add();
            vendor('Umeng.Demo');
            $umeng=new \Demo("5afa46ef8f4a9d19f600008c", "kdockprelcj3qlth6vgthymejczsr2uu"); 
       
            $android=$umeng->sendAndroidUnicast("您的直播资质被拒绝",'拒绝原因:'.$prove_refuse,$tui['device_tokens']);
            
           
        }
        }
        }else{
           echo 2;
        }
        
          
            }else{
            $prove=D("Prove");
            $news=D('news');
            $prove_refuse=I('post.txtRefuse');      
            $pid=I('post.pid');
    
           
                $sql="update prove set opinion='".$prove_refuse."',status=2 where prove_id=".$pid;
                 $select=$prove->field('uid,identity')->where('prove_id='.$pid)->find();
        if($select['identity']=='3'){ 
            
            $data=$prove->execute($sql);
            $user=D('user');
            $tui=$user->field('device_tokens')->where('user_id='.$select['uid'])->find();
            if($data>0){
                if($tui['device_tokens']==''){
                    $mvp['title']='您的资质被拒绝';
                    $mvp['content']='拒绝原因：'.$prove_refuse;
                    $mvp['time']=time();
                    $mvp['uid']=$select['uid'];
                    $mvp['tuisong']=1;
                    $mvp['type']='1';
                    $newslist=$news->data($mvp)->add();
                 echo 1;
            }else{
                 if(strlen($tui['device_tokens'])==64){
                    $mvp['title']='您的资质被拒绝';
                    $mvp['content']='拒绝原因：'.$prove_refuse;
                    $mvp['time']=time();
                    $mvp['uid']=$select['uid'];
                    $mvp['tuisong']=1;
                    $mvp['type']='1';
                    $newslist=$news->data($mvp)->add();
                vendor('Umeng.Demo');
                $demo = new \Demo("5afa49fdb27b0a365600013b", "qp22lyrj6twuswsxiuhejnerogyfsevn");
                $ios=$demo->sendIOSUnicast("您的资质被拒绝",'拒绝原因:'.$prove_refuse,$tui['device_tokens']);   

            }else{
                $mvp['title']='您的资质被拒绝';
                    $mvp['content']='拒绝原因：'.$prove_refuse;
                    $mvp['time']=time();
                    $mvp['uid']=$select['uid'];
                    $mvp['tuisong']=1;
                    $mvp['type']='1';
                    $newslist=$news->data($mvp)->add();
                vendor('Umeng.Demo');
                $umeng=new \Demo("5afa46ef8f4a9d19f600008c", "kdockprelcj3qlth6vgthymejczsr2uu"); 
           
                $android=$umeng->sendAndroidUnicast("您的资质被拒绝",'拒绝原因:'.$prove_refuse,$tui['device_tokens']);
               
            }
            }
        }else{
            echo 2; 
        }
        }else{
            
            $data=$prove->execute($sql);
            $user=D('user');
            $tui=$user->field('device_tokens')->where('user_id='.$select['uid'])->find();
            if($data>0){
                if($tui['device_tokens']==''){
                    $mvp['title']='您的资质被拒绝';
                    $mvp['content']='拒绝原因：'.$prove_refuse;
                    $mvp['time']=time();
                    $mvp['uid']=$select['uid'];
                    $mvp['tuisong']=1;
                    $mvp['type']='1';
                    $newslist=$news->data($mvp)->add();
                 echo 1;
            }else{
                 if(strlen($tui['device_tokens'])==64){
                    $mvp['title']='您的资质被拒绝';
                    $mvp['content']='拒绝原因：'.$prove_refuse;
                    $mvp['time']=time();
                    $mvp['uid']=$select['uid'];
                    $mvp['tuisong']=1;
                    $mvp['type']='1';
                    $newslist=$news->data($mvp)->add();
                vendor('Umeng.Demo');
                $demo = new \Demo("5afa49fdb27b0a365600013b", "qp22lyrj6twuswsxiuhejnerogyfsevn");
                $ios=$demo->sendIOSUnicast("您的资质被拒绝",'拒绝原因:'.$prove_refuse,$tui['device_tokens']);   
            }else{
                $mvp['title']='您的资质被拒绝';
                    $mvp['content']='拒绝原因：'.$prove_refuse;
                    $mvp['time']=time();
                    $mvp['uid']=$select['uid'];
                    $mvp['tuisong']=1;
                    $mvp['type']='1';
                    $newslist=$news->data($mvp)->add();
                vendor('Umeng.Demo');
                $umeng=new \Demo("5afa46ef8f4a9d19f600008c", "kdockprelcj3qlth6vgthymejczsr2uu"); 
           
                $android=$umeng->sendAndroidUnicast("您的资质被拒绝",'拒绝原因:'.$prove_refuse,$tui['device_tokens']);
               
            }
            }
            }else{
                echo 2; 
            }
        }
           }

            }
			
			
		
    }

    //通过


    public function pass(){
        if($_POST['id']){
        $prove=D('Prove');
        $m=D('class');
        $id=I('id');
        $news=D('news');
        $teacher=D('teacher');
        $sql="update prove set status='1' where prove_id=".$id;
        $res=$prove->execute($sql); 
        //dump($res);
        $select=$prove->where('prove_id='.$id)->find();
       // dump($select);
        /*$date['title']='您的资质审核通过';
            $date['content']='您的资质审核通过';
            $date['time']=time();
            $date['uid']=$select['uid'];
            $date['tuisong']=1;
            $date['type']='1';
        $newslist=$news->data($date)->add();*/
        $mvp['uid']=$select['uid'];
        $mvp['name']=$select['name'];
        if($select['classimg']==""){
            $mvp['img']='/user/public_morentouxiang.png';
        }else{
            $mvp['img']=$select['classimg'];
        }
       
        $mvp['cate_id']=$select['cate_id'];
        $mvp['type']=$select['identity'];
       
        $add=$m->data($mvp)->add();
            $save['link']='http://www.wyueke.com/html/student_shop.html?sId='.$add;
            $m->where(array('class_id'=>$add))->save($save);
        $user=D('user');
        $tui=$user->field('device_tokens')->where('user_id='.$select['uid'])->find();
        if($res!=''){
            if($tui['device_tokens']==''){
            $date['title']='您的资质审核通过';
            $date['content']='您的资质审核通过';
            $date['time']=time();
            $date['uid']=$select['uid'];
            $date['tuisong']=1;
            $date['type']='1';
            $newslist=$news->data($date)->add();
            echo 1;
        }else{
             if(strlen($tui['device_tokens'])==64){
                $date['title']='您的资质审核通过';
            $date['content']='您的资质审核通过';
            $date['time']=time();
            $date['uid']=$select['uid'];
            $date['tuisong']=1;
            $date['type']='1';
            $newslist=$news->data($date)->add();
            vendor('Umeng.Demo');
            $demo = new \Demo("5afa49fdb27b0a365600013b", "qp22lyrj6twuswsxiuhejnerogyfsevn");
            $ios=$demo->sendIOSUnicast("您的资质审核通过","您的资质审核通过",$tui['device_tokens']);   
            
        }else{
            $date['title']='您的资质审核通过';
            $date['content']='您的资质审核通过';
            $date['time']=time();
            $date['uid']=$select['uid'];
            $date['tuisong']=1;
            $date['type']='1';
            $newslist=$news->data($date)->add();
            vendor('Umeng.Demo');
            $umeng=new \Demo("5afa46ef8f4a9d19f600008c", "kdockprelcj3qlth6vgthymejczsr2uu"); 
       
            $android=$umeng->sendAndroidUnicast("您的资质审核通过","您的资质审核通过",$tui['device_tokens']);
          
           
        }
        }
       
        }else{
          echo 2;  
        }
        
        
        }else{
            $prove=D('livebapply');
            $pid=I('pid');
            $class=D('class');
            $news=D('news');
            $sql="update livebapply set status='1' where livebapply_id=".$pid;
            $res=$prove->execute($sql); 
            //dump($res);
            $select=$prove->where('livebapply_id='.$pid)->find();
           // dump($select);
            $sql1="update class set grade='1' where uid=".$select['uid'];
            $row=$class->execute($sql1); 
          $user=D('user');
        $tui=$user->field('device_tokens')->where('user_id='.$select['uid'])->find();
        if($res!=''){
            if($tui['device_tokens']==''){
                $date['title']='您的直播资质审核通过';
            $date['content']='您的直播资质审核通过';
            $date['time']=time();
            $date['uid']=$select['uid'];
            $date['tuisong']=1;
            $date['type']='1';
            $newslist=$news->data($date)->add();
            echo 1;
        }else{
            if(strlen($tui['device_tokens'])==64){
                $date['title']='您的直播资质审核通过';
            $date['content']='您的直播资质审核通过';
            $date['time']=time();
            $date['uid']=$select['uid'];
            $date['tuisong']=1;
            $date['type']='1';
            $newslist=$news->data($date)->add();
                    vendor('Umeng.Demo');
                    $demo = new \Demo("5afa49fdb27b0a365600013b", "qp22lyrj6twuswsxiuhejnerogyfsevn");
                    $ios=$demo->sendIOSUnicast("您的直播资质审核通过","您的直播资质审核通过",$tui['device_tokens']);   
            }else{
                $date['title']='您的直播资质审核通过';
            $date['content']='您的直播资质审核通过';
            $date['time']=time();
            $date['uid']=$select['uid'];
            $date['tuisong']=1;
            $date['type']='1';
            $newslist=$news->data($date)->add();
                    vendor('Umeng.Demo');
                    $umeng=new \Demo("5afa46ef8f4a9d19f600008c", "kdockprelcj3qlth6vgthymejczsr2uu"); 
               
                    $android=$umeng->sendAndroidUnicast("您的直播资质审核通过","您的直播资质审核通过",$tui['device_tokens']);
            }
        }
        }else{
            echo 2;
        }
        
        
        }

    }
    //直播审核
   public  function live(){

        $this -> assign('imgURL',  C('IMG_URL'));
        $prove=D('livebpower');
        $liveb=D('livebapply');
        $bond=D('bond');
       
        if(IS_POST){//点击查询按钮   按照  状态和手机号查询


            $status=$_POST["selstatus"]; //状态
            $phone=$_POST["txtphone"];   //手机号码
            if($status=='0'&&$phone!=null){
                 $info=$prove->table('user as u,class as c,livebapply as l')->field('u.name as uname,c.*,l.status as lstatus,l.livebapply_id')->where("c.uid=u.user_id and l.uid=c.uid and l.status=0 and u.name like '%$phone%'")->order('time desc')->select();
                /*$info=$prove->table('user as u,livebapply as l,livebpower as p')->field('l.*,u.name,p.video_num,p.status')->where("l.uid=u.user_id and l.status=0 and u.name like '%$phone%'")->select();*/
            }elseif($status=='1'&&$phone!=null){
                $info=$prove->table('user as u,class as c,livebapply as l')->field('u.name as uname,c.*,l.status as lstatus,l.livebapply_id')->where("c.uid=u.user_id and l.uid=c.uid and l.status=1 and u.name like '%$phone%'")->order('time desc')->select();
               /* $info=$prove->table('user as u,livebapply as l,livebpower as p')->field('l.*,u.name')->where("l.uid=u.user_id and l.status=1 and u.name like '%$phone%'")->select();*/
                
            }elseif($status=='2'&&$phone!=null){
                $info=$prove->table('user as u,class as c,livebapply as l')->field('u.name as uname,c.*,l.status as lstatus,l.livebapply_id')->where("c.uid=u.user_id and l.uid=c.uid and l.status=2 and u.name like '%$phone%'")->order('time desc')->select();
                /*$info=$prove->table('user as u,livebapply as l,livebpower as p')->field('l.*,u.name')->where("l.uid=u.user_id and l.status=2 and u.name like '%$phone%'")->select();*/
            }elseif($status=='2' || $status=='0' ||$status=='1' && $phone==""){
                $info=$prove->table('user as u,class as c,livebapply as l')->field('u.name as uname,c.*,l.status as lstatus,l.livebapply_id')->where("c.uid=u.user_id and l.uid=c.uid and l.status like '%$status%'")->order('time desc')->select();
                /*$info=$prove->table('user as u,livebapply as l,livebpower as p')->field('l.*,u.name')->where("l.uid=u.user_id  and l.status like '%$status%'")->select();*/
            }elseif($status=="3" && $phone==""){
                 $info=$prove->table('user as u,class as c,livebapply as l')->field('u.name as uname,c.*,l.status as lstatus,l.livebapply_id')->where("c.uid=u.user_id and l.uid=c.uid ")->order('time desc')->select();
               /* $info=$prove->table('user as u,livebapply as l,livebpower as p')->field('l.*,u.name')->where("l.uid=u.user_id")->select();*/
            }elseif($status=="3" && $phone!=""){
                 $info=$prove->table('user as u,class as c,livebapply as l')->field('u.name as uname,c.*,l.status as lstatus,l.livebapply_id')->where("c.uid=u.user_id and l.uid=c.uid and u.name like '%$phone%'")->order('time desc')->select();
                /*$info=$prove->table('user as u,livebapply as l,livebpower as p')->field('l.*,u.name')->where("l.uid=u.user_id and u.name like '%$phone%'")->select();*/
            }
            foreach($info as $k=>$v){
                $goods=M('goods')->where('class_id='.$v['class_id']. ' and type=2 and astatus=1 or type=4 and astatus=1 and class_id='.$v['class_id'])->count();
                $bond=D('bond')->field('status')->where('uid='.$v['uid'])->find();
                $info[$k]['time']=date("Y-m-d H:i:s",$v['time']);
                $info[$k]['video_num']=$goods;
                if($bond){
                   $info[$k]['bstatus']=$bond['status']; 
               }else{
                   $info[$k]['bstatus']=2;
               }
                
            }
            $auth=D('adminrauth');
            $uid=session('user.id');
            $list=$auth->where('admin_id='.$uid)->select();
            $a="";
            foreach($list as $k=>$v){
                $a.=$v['auth_id'].',';
            }
            //dump ($a);
            $this->assign('res',$a);
            $this->assign('info',$info);
            $this->display();
        }else{//正常加载来的
             $info=$prove->table('user as u,class as c,livebapply as l')->field('u.name as uname,c.*,l.status as lstatus,l.livebapply_id')->where("c.uid=u.user_id and l.uid=c.uid")->order('time desc')->select();
            foreach($info as $k=>$v){
                $goods=M('goods')->where('class_id='.$v['class_id']. ' and type=2 and astatus=1 or type=4 and astatus=1 and class_id='.$v['class_id'])->count();
                $bond=D('bond')->field('status')->where('uid='.$v['uid'])->find();
                $info[$k]['time']=date("Y-m-d H:i:s",$v['time']);
                $info[$k]['video_num']=$goods;
                if($bond){
                   $info[$k]['bstatus']=$bond['status']; 
               }else{
                   $info[$k]['bstatus']=2;
               }
                
            }
          //dump($info);
            $auth=D('adminrauth');
            $uid=session('user.id');
            $list=$auth->where('admin_id='.$uid)->select();
            $a="";
            foreach($list as $k=>$v){
                $a.=$v['auth_id'].',';
            }
            //dump ($a);
            $this->assign('res',$a);
            $this->assign('info',$info);
            $this->display();
        }
    }
    
       
	
	
}