<?php
namespace Home\Controller;
use Think\Controller;
// header('Content-Type:text/json;charset=utf-8');
// header("Access-Control-Allow-Origin: *");
class LivebController extends CommonController {
    public function teacher(){
    	$uid=session('H_user_id');
    	$user=M('user');
    	$userrel=$user->where(array('user_id'=>$uid))->find();
    	$token=$userrel['token'];					//用户token
    	$this->assign('token',$token);
    	$tls=new \Org\Util\TLSSig();
		$identifier=$token;
		$sig=$tls->genSig($identifier);				//用户sig
		$this->assign('sig',$sig);
		$this->assign('roomid',$_GET['livebid']);	//房间号
    	$this->display();	
    }

    public function start(){
    	$id=I('post.roomid');
    	$liveb=M('liveb');
    	$livebrel=$liveb->where(array('liveb_id'=>$id))->find();
    	if(!$livebrel){$this->ajaxReturn('1');}//直播间错误
    	$mvp['status']='1';
    	$result=$liveb->where('liveb_id='.$livebrel['liveb_id'])->save($mvp);
    	if($result===false){
    		$this->ajaxReturn('2');//开播失败
    	}else{
    		$this->ajaxReturn('3');//开播成功
    	}
    }

    public function stop(){
    	$id=I('post.id');
    	$liveb=M('liveb');
    	$livebrel=$liveb->where(array('liveb_id'=>$id))->find();
    	$mvp['status']='0';
    	$result=$liveb->where('liveb_id='.$livebrel['liveb_id'])->save($mvp);
    	
    }

    public function student(){
    	$uid=session('H_user_id');
    	$user=M('user');
    	$userrel=$user->where(array('user_id'=>$uid))->find();
    	$token=$userrel['token'];					//用户token
    	$this->assign('student_token',$token);
    	$tls=new \Org\Util\TLSSig();
		$identifier=$token;
		$sig=$tls->genSig($identifier);				//用户sig
		$this->assign('sig',$sig);
		$this->assign('roomid',$_GET['livebid']);	//房间号
		$liveb=M('liveb');
		$livebrel=$liveb->where('liveb_id='.$_GET['livebid'])->find();
		$class=M('class');
		$classrel=$class->where('class_id='.$livebrel['class_id'])->find();
		$t_user=$user->where('user_id='.$classrel['uid'])->find();
		$t_token=$t_user['token'];
		$this->assign('teacher_token',$t_token);
    	$this->display();
    }  
}