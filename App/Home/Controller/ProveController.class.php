<?php
namespace Home\Controller;
use Think\Controller;
header('Content-Type:text/html;charset=utf-8');
// header("Access-Control-Allow-Origin: *");
class ProveController extends Controller {
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
	    }else{
	    	echo  "<script>alert('您尚未登录！请登录');window.location.href='".__MODULE__."/Login/index';</script>";
	    }
	    if(IS_POST){
	    	$upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     3145728 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
       
        $upload->rootPath  =      './Uploads/prove/'; // 设置附件上传目录
        $upload->savePath  =     ''; // 设置附件上传（子）目录
            // 上传文件
        $info   =   $upload->upload();
        if(!$info) {// 上传错误提示错误信息   
                 $list=$upload->getError();
             
         echo  "<script>alert('$list');</script>";  
        }else{// 上传成功 获取上传文件信息    
            $data['photofront']='/Uploads/prove/'.$info['pic1']['savepath'].$info['pic1']['savename'];
            $data['photoback']='/Uploads/prove/'.$info['pic2']['savepath'].$info['pic2']['savename'];
            $data['photohold']='/Uploads/prove/'.$info['pic3']['savepath'].$info['pic3']['savename'];
            $data['photocertify']='/Uploads/prove/'.$info['pic4']['savepath'].$info['pic4']['savename'];
            $data['classimg']='/Uploads/prove/'.$info['pic5']['savepath'].$info['pic5']['savename'];
            $data['name']=$_POST['name'];
            $data['cardnum']=$_POST['id'];
            $data['phone']=$_POST['tel'];
            
            $data['cate_id']=$_POST['ffid'];
        
         	$data['uid']=$uid;
         	$data['time']=time();
            $bao=$_POST['vehicle'];
            $xie=$_POST['vehicle1'];

            if($data['photocertify']=="/Uploads/prove/" && $bao==null){
                    echo  "<script>alert('您没有上传资质证明，请勾选《网约课保证金协议》');window.location.href='".__MODULE__."/prove/index';</script>"; exit;
            }
         	if($data['photofront']=="/Uploads/prove/" || $data['photoback']=="/Uploads/prove/" || 
                $data['photohold']=="/Uploads/prove/" || $data['classimg']=="/Uploads/prove/"){
                echo  "<script>alert('除纸质证明外其他图片必须上传');window.location.href='".__MODULE__."/prove/index';</script>"; exit;
            }
         	if($xie==null){
                echo  "<script>alert('请勾选《网约课平台课程制作使用协议》');window.location.href='".__MODULE__."/prove/index';</script>"; exit;
            }
         	$row=D('prove')->data($data)->add();
         	if($row){
         		echo  "<script>alert('资质提交成功！等待审核结果');window.location.href='".__MODULE__."/index/index';</script>"; 
         	}
         	
         	
    }
       
    }

	    else{  
            $prove=D('prove');
	    	$cate=D('category');
            $provelist=$prove->where('uid='.$uid)->find();

            if($provelist && $provelist['status']==0){
                echo  "<script>alert('您的资质正在审核中！请耐心等待');window.location.href='".__MODULE__."/index/index';</script>"; 
            }
            if($provelist['status']==2){
                $del=$prove->where('prove_id='.$provelist['prove_id'])->delete();

                 echo  "<script>alert('您的资质已被拒绝！原因是{$provelist['opinion']}!请重新提交资料');window.location.href='".__MODULE__."/prove/index';</script>"; 
                 
            }
			$catelist=$cate->where('pid=0 && cate_id!=1')->select();
			$this->assign('pid',$catelist);
			$this->display();
	    	
	    }
    	
    }
    public function yang(){
    	 $id=$_POST['id'];
    	 $cate=D('category');
         $zid=$cate->where('pid='.$id)->select();
         echo json_encode($zid);
         
    }
    public function xieyi(){
        $xieyi=D('xieyi');
        $list=$xieyi->where('type=4')->find();
        //dump($list);
        $this->assign('list',$list);
        $this->display();
    }
    public function baozheng(){
        $wenti=D('wenti');
        $list=$wenti->where('wenti like "%保证金%"')->select();
        $this->assign('list',$list);
        $this->display();
    }
     public function xieyi1(){
        $xieyi=D('xieyi');
        $list=$xieyi->where('type=2')->find();
        //dump($list);
        $this->assign('list',$list);
        $this->display();
    }
    public function about(){
        $about=D('aboutus');
        $list=$about->select();
        $this->assign('list',$list);
        $this->display();
    }
   
}