<?php

namespace Admin\Controller;

use Think\Controller;	


class FeedbackController extends BaseController{
	 
	 
	
	public function showlist(){
		$feedback=D('Feedback');
       	$sql="select * from feedback ";
		if(IS_POST){//点击查询按钮   按照  状态和手机号查询
//          $status=$_POST["selstatus"]; //状态
//          $phone=$_POST["txtphone"];   //手机号码
//          if($status=='0'&&$phone!=null){
//              $sql=$sql."where status='0'  and phone like '%$phone%'  ";
//
//          }elseif($status=='1'&&$phone!=null){
//              $sql=$sql."where status='1'  and phone like '%$phone%'  ";
//          }elseif($status=='2'&&$phone!=null){
//              $sql=$sql."where status='2'  and phone like '%$phone%'  ";
//          }
//
			$name=$_POST["txtName"]; //状态
			$sql=$sql." where contact like '%$name%'  ";			
			$info= $feedback->query($sql);
            foreach($info as $k=>$v){
                $info[$k]['time']=date("Y-m-d H:i:s",$v['time']);
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
//          $info= $prove->query($sql);
//
//          $this->assign('info',$info);
//          $this->display();
        }else{//正常加载来的
            $info= $feedback->query($sql);
			
			foreach($info as $k=>$v){
				$info[$k]['time']=date("Y-m-d H:i:s",$v['time']);
			}
//            dump($info);
			$this->assign('info',$info);
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
	
	
	
	//查看
	public function showdetail(){
		$feedback=D("Feedback");
		$feedback_id=$_GET["fid"];
		$sql="select * from feedback where feedback_id = ".$feedback_id;
		
		$info=$feedback->query($sql);
		foreach($info as $k=>$v){
				$info[$k]['time']=date("Y-m-d H:i:s",$v['time']);
		}	
		$this->assign('info',$info);	
        $this->display("Feedback/view");
	}
	
	//删除
    public function del(){

        $feedback=D("Feedback");
		$feedback_id=$_GET["fid"];

        $res=$feedback->delete($feedback_id);
        if($res){
            echo "<script>alert('删除成功！');window.location.href='".__MODULE__."/feedback/showlist';</script>";
        }else{
            echo "<script>alert('删除失败！')</script>";
        }

    }
}
?>