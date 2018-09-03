<?php

namespace Admin\Controller;

use Think\Controller;


header('Content-Type:text/html;charset=utf-8');

class ReportmanageController extends BaseController{
	public function showlist(){
		
		$report=D('report');
		$user=D('user');
         $sql="select r.*,u.name as uname from report as r,user as u where r.uid=u.user_id";
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
			$name=$_POST["txtName"]; //状态
			$brandclass=$_POST['brandclass'];
			if($name=="" && $brandclass=="0"){
				   $sql="select r.*,u.name as uname from report as r,user as u where r.uid=u.user_id";		
			}
			elseif($name=="" && $brandclass=="1"){
				$sql=$sql." and  r.status=1";	
			}elseif($name=="" && $brandclass=="2"){
				$sql=$sql." and  r.status=0";	
			}
			$info= $report->query($sql);
			foreach($info as $k=>$v){
				$info[$k]['time']=date("Y-m-d H:i:s",$v['time']);
				//$info[$k]['time']=date("Y-m-d H:i:s",$v['time']);
				/*$order=D('order');
				$aaa=$order->field('pid')->where('order_id='.$v['order_id'])->find();*/
				//dump($aaa);
				$b=D('goods')->field('class_id')->where('goods_id='.$v['order_id'])->find();
				//dump($b);
				$class=M('class')->field('name')->where('class_id='.$b['class_id'])->find();
				$info[$k]['cname']=$class['name'];
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
            // $sql="select r.*,u.name as uname from report as r,user as u where r.uid=u.user_id";
            $info= $report->query($sql);
			
			foreach($info as $k=>$v){
				$info[$k]['time']=date("Y-m-d H:i:s",$v['time']);
				/*$order=D('order');
				$aaa=$order->field('pid')->where('order_id='.$v['order_id'])->find();*/
				//dump($aaa);
				$b=D('goods')->field('class_id')->where('goods_id='.$v['order_id'])->find();
				//dump($b);
				$class=M('class')->field('name')->where('class_id='.$b['class_id'])->find();
				$info[$k]['cname']=$class['name'];
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
	
	
	public function showdetail(){
		$report=D("Report");


		$report_id=$_GET["rid"];
		/*dump($report_id);
		die();*/
		//$sql="select * from report where report_id = ".$report_id;
		
		$info=$report->where("report_id = ".$report_id)->find();
		
		//dump($info);
		$this->assign('info',$info);
		$img="http://wyk-img-1255995999.cos.ap-beijing.myqcloud.com";
        $this->assign('img',$img);
        $this->display("Reportmanage/view");
	}
	
	
	public function process(){
		 $report_id=$_GET["rid"];	
		/* dump($report_id);
		 die();	*/
		$this->assign('id',$report_id);
		$this->display("Reportmanage/process");
	}
		
	public function completeprocess(){
		
			$report=D("Report");
		    $report_id=$_POST["rid"];
			/*dump($report_id);
			die()*/;
			$processtype=I('post.chkProcesstype');
			$remark=I('post.txtRemark');
			if($processtype=="" || $remark==""){
				echo "<script>alert('处理结果不能为空！！！请重新添加');window.location.href='".__MODULE__."/Reportmanage/process';</script>";
			}
			$sql="update report set remark='".$remark."',processtype='".$processtype."',status=1 where report_id = ".$report_id;
			$data=$report->execute($sql);
			//die()
			$list=$report->where('report_id ='.$report_id)->find();
			if($list['processtype']='封号'){
				$user=D('user');
				$mvp['status']='1';
				/*$a=M('order')->field('pid')->where('order_id='.$list['order_id'])->find();*/
				$b=M('goods')->field('class_id')->where('goods_id='.$list['order_id'])->find();
				$c=M('class')->field('uid')->where('class_id='.$b['class_id'])->find();
				$user->where('user_id='.$c['uid'])->save($mvp);
			}
			if($data>0){
				echo "<script>alert('成功！');parent.location.href='".__MODULE__."/Reportmanage/showlist';</script>";
			}	
		}
	
}

?>