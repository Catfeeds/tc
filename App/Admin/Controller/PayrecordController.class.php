<?php

namespace Admin\Controller;

use Think\Controller;	


class PayrecordController extends BaseController{
	public function showlist(){
		/*$payrecord=D('Payrecord');
       */
		$payrecord=D('wxpay');
		/*$select=$payrecord->table('wxpay as w,user as u,userdata as ud')->field('w.*,u.name,u.phone,ud.money as umoney')->where('w.uid=u.user_id')->select();*/
		//dump($select);
		//die();
		if(IS_POST){    
		    $status=$_POST["serchWord"];
		    $info=$payrecord->table('wxpay as w,user as u,userdata as ud')->field('w.*,u.name,u.phone,ud.money as umoney')->where("w.uid=u.user_id and ud.uid=w.uid and u.name like '%$status%'")->select();

 
            foreach($info as $k=>$v){
				$info[$k]['time']=date("Y-m-d H:i:s",$v['time']);
				$info[$k]['money']=$v['money']/100;
			}
            $this->assign('info',$info);
            $this->display();
        }else{//正常加载来的
            $count=$payrecord->table('wxpay as w,user as u,userdata as ud')->where('w.uid=u.user_id and ud.uid=w.uid')->count();
            //分页方法
            $data=pager($count,10);
            // 赋值分页输出
            $this->assign('page',$data['show']);
            $info=$payrecord
                ->table('wxpay as w,user as u,userdata as ud')
                ->field('w.*,u.name,u.phone,ud.money as umoney')
                ->where('w.uid=u.user_id and ud.uid=w.uid')
                ->limit($data['limit'])
                ->select();
			
			foreach($info as $k=>$v){
				$info[$k]['time']=date("Y-m-d H:i:s",$v['time']);
				$info[$k]['money']=$v['money']/100;
			}
           // dump($info);
            $this->assign('info',$info);
            $this->display();
        }
	}

	//支付宝支付
	public function alipay(){
		/*$payrecord=D('Payrecord');
       */
		$payrecord=D('alipay');
		/*$select=$payrecord->table('wxpay as w,user as u,userdata as ud')->field('w.*,u.name,u.phone,ud.money as umoney')->where('w.uid=u.user_id')->select();*/
		//dump($select);
		//die();
		if(IS_POST){    
		    $status=$_POST["serchWord"];
		    $info=$payrecord->table('alipay as w,user as u,userdata as ud')->field('w.*,u.name,u.phone,ud.money as umoney')->where("w.uid=u.user_id and ud.uid=w.uid and u.name like '%$status%'")->select();

            	foreach($info as $k=>$v){
				$info[$k]['time']=date("Y-m-d H:i:s",$v['time']);
			}
            $this->assign('info',$info);
            $this->display();
        }else{//正常加载来的
            $count=$payrecord->table('alipay as w,user as u,userdata as ud')->where('w.uid=u.user_id and ud.uid=w.uid')->count();
            $p_data=pager($count);
            $info=$payrecord
                ->table('alipay as w,user as u,userdata as ud')
                ->field('w.*,u.name,u.phone,ud.money as umoney')
                ->where('w.uid=u.user_id and ud.uid=w.uid')
                ->limit($p_data['limit'])
                ->select();
			
			foreach($info as $k=>$v){
				$info[$k]['time']=date("Y-m-d H:i:s",$v['time']);
			}
//            dump($info);
            $this->assign('info',$info);
            $this->assign('page',$p_data['show']);
            $this->display();
        }
	}
	public function pay(){
		$payrecord=D('Pay');
       	$sql="select p.*,u.name from pay as p,user as u where p.uid=u.user_id ";
		if(IS_POST){    
		    $status=$_POST["serchWord"];
		    if($status!=null){ //用户名
            $sql=$sql." and u.name like '%$status%'  ";
            }else{
        	$sql=$sql."  and 0=0 ";
            }

            $info= $payrecord->query($sql);
            $this->assign('info',$info);
            $this->display();
        }else{//正常加载来的
            $info= $payrecord->query($sql);
            //dump($info);
            $this->assign('info',$info);
            $this->display();
        }
	}
	public function tixian(){
		$payrecord=D('withdraw');
       	$sql="select w.*,u.name,p.bank,p.phone,p.type from withdraw as w,pay as p,user as u where w.uid=u.user_id and w.uid=p.uid";
		if(IS_POST){    
		    $status=$_POST["serchWord"];
		    if($status!=null){ //用户名
            $sql=$sql." and u.name like '%$status%'  ";
            }else{
        	$sql=$sql."  and 0=0 ";
            }

            $info= $payrecord->query($sql);
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
            $info=$payrecord->table('withdraw as w,pay as p,user as u')->field('w.*,u.name,p.bank,p.phone,p.type')->where('w.uid=u.user_id and w.uid=p.uid')->order('time desc')->select();
            //dump($info);
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
            $this->display();
        }
	}
	
	//payrecord增加一条记录，userdata也增加一条记录 
	public function add(){
		$payrecord=M("Payrecord");	

		if(IS_POST){
			//获取表单中的数据
			
	        $type=I('rdoPayType');
	        $money=I('txtMoney');

			$arr['uid']=1;//此发布时改为当前登录用户
			$arr['type']=$type;
			$arr['income']=$money;
			$arr['time']=time();
        
        	dump($arr);

        	$res=$payrecord->data($arr)->add();

	        if($res>0){
	        	
//	        	$ajaxmsg['code']=1;//前台页面中使用的字段
//	    		$ajaxmsg['statu']='ok';
//	    		$ajaxmsg['msg']='成功';
//	     		$this->ajaxReturn($ajaxmsg);
				echo "<script>alert('成功！');</script>";
//              $this->success('新增成功', 'User/list');
//              header("location:__SELF__");
                $this->redirect("payrecord/showlist");
												
	        }else{
	        	$ajaxmsg['code']=2;//前台页面中使用的字段
	    		$ajaxmsg['statu']='err';
	    		$ajaxmsg['msg']='失败';
	     		$this->ajaxReturn($ajaxmsg);
	        }
		}else{
			$this->display();
		}	     
	}	
	//添加交易单号
	public function adddi(){
		$id=$_GET['id'];
		$this->assign('id',$id);
		$this->display('order');
	}
	//打款
	public function pass(){
		$id=$_POST['id'];
		$t=D('withdraw');
		$mvp['status']=1;
		$mvp['order']=$_POST['order'];
		$res=$t->where('withdraw_id='.$id)->save($mvp);
		$row=$t->where('withdraw_id='.$id)->find();
		$user=D('user');
        $tui=$user->field('device_tokens')->where('user_id='.$row['uid'])->find();
		if($res!=''){
            if($tui['device_tokens']==''){
            $n=D('news');
			$mmp['title']='提现状态';
			$mmp['content']='您已经提现成功，交易单号'.$row['order'];
			$mmp['time']=time();
			$mmp['uid']=$row['uid'];
			$mmp['type']='2';
			$mmp['tuisong']=1;
			$new=$n->add($mmp);
            echo 1; 
        }else{
             if(strlen($tui['device_tokens'])==64){
             	 $n=D('news');
			$mmp['title']='提现状态';
			$mmp['content']='您已经提现成功，交易单号'.$row['order'];
			$mmp['time']=time();
			$mmp['uid']=$row['uid'];
			$mmp['type']='2';
			$mmp['tuisong']=1;
			$new=$n->add($mmp);
            vendor('Umeng.Demo');
            $demo = new \Demo("5afa49fdb27b0a365600013b", "qp22lyrj6twuswsxiuhejnerogyfsevn");
            $ios=$demo->sendIOSUnicast("您的提现已完成",'您已经提现成功，交易单号'.$row['order'],$tui['device_tokens']);   
            
        }else{
        	$n=D('news');
			$mmp['title']='提现状态';
			$mmp['content']='您已经提现成功，交易单号'.$row['order'];
			$mmp['time']=time();
			$mmp['uid']=$row['uid'];
			$mmp['type']='2';
			$mmp['tuisong']=1;
			$new=$n->add($mmp);
            vendor('Umeng.Demo');
            $umeng=new \Demo("5afa46ef8f4a9d19f600008c", "kdockprelcj3qlth6vgthymejczsr2uu"); 
       
            $android=$umeng->sendAndroidUnicast("您的提现已完成",'您已经提现成功，交易单号'.$row['order'],$tui['device_tokens']);
          
           
        }
        }
       
        }else{
          echo 2;  
        }

		/*$n=D('news');
		$mmp['title']='提现状态';
		$mmp['content']='您已经提现成功，交易单号'.$row['order'];
		$mmp['time']=time();
		$mmp['uid']=$row['uid'];
		$mmp['type']='2';
		$mmp['tuisong']=1;
		$new=$n->add($mmp);*/
		//$this->ajaxReturn(interfaceReturn(0,'成功',""));
	}
}
?>