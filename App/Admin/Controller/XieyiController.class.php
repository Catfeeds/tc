<?php

namespace Admin\Controller;

use Think\Controller;


class XieyiController extends BaseController{
     public function showlist2(){
     	       $about=D("aboutus");



		$sql="select * from  aboutus";
        if(IS_POST){
            $name=$_POST['txtName'];
            $sql=$sql." where introduce like '%$name%'  ";
            $list=$about->query($sql);
            $this->assign('list',$list);
            $auth=D('adminrauth');
            $uid=session('user.id');
            $lists=$auth->where('admin_id='.$uid)->select();
            $a="";
            foreach($lists as $k=>$v){
                $a.=$v['auth_id'].',';
            }
            //dump ($a);
            $this->assign('res',$a);
            $this->display();
		}else{
             $list=$about->query($sql);
             $auth=D('adminrauth');
            $uid=session('user.id');
             $lists=$auth->where('admin_id='.$uid)->select();
            $a="";
            foreach($lists as $k=>$v){
                $a.=$v['auth_id'].',';
            }
            //dump ($a);
            $this->assign('res',$a);
        $this->assign('list',$list);  //数据列表
//      $this->assign('page',$p->show());


        $this->display();//在模版上显示
    }
     }
      public function add2(){
        if(IS_POST){
        $about=D("aboutus");
        $mvp['introduce']=$_POST['introduce'];
        $mvp['title']=$_POST['title'];
        $mvp['time']=time();
        $list=$about->add($mvp);
        $this->ajaxReturn(interfaceReturn(0,'成功',""));
        }
        
        $this->display();
     }
     public function edit2(){
     	if(IS_POST){
     		$id=$_POST['id'];
     		$about=D("aboutus");
     		$mvp['introduce']=$_POST['introduce'];
            $mvp['title']=$_POST['title'];
     		$list=$about->where('aboutus_id='.$id)->save($mvp);
     		$this->ajaxReturn(interfaceReturn(0,'成功',""));
     	}
     	$id=$_GET['id'];
     	$about=D("aboutus");
     	$list=$about->where('aboutus_id='.$id)->find();
     	$this->assign('list',$list);  //
     	$this->display();
     }
     public function del2(){
        $id=$_POST['id'];
        $about=D("aboutus");
        $list=$about->where('aboutus_id='.$id)->delete();
        $this->ajaxReturn(interfaceReturn(0,'成功',""));
     }
     public function showlist1(){
     	$about=D("wenti");



		$sql="select * from  wenti";
        if(IS_POST){
            $name=$_POST['txtName'];
            $sql=$sql." where wenti like '%$name%'  ";
            $list=$about->query($sql);
            $this->assign('list',$list);
            $auth=D('adminrauth');
            $uid=session('user.id');
            $lists=$auth->where('admin_id='.$uid)->select();
            $a="";
            foreach($lists as $k=>$v){
                $a.=$v['auth_id'].',';
            }
            //dump ($a);
            $this->assign('res',$a);
            $this->display();
		}else{
             $list=$about->query($sql);
             $auth=D('adminrauth');
            $uid=session('user.id');
            $lists=$auth->where('admin_id='.$uid)->select();
            $a="";
            foreach($lists as $k=>$v){
                $a.=$v['auth_id'].',';
            }
            //dump ($a);
            $this->assign('res',$a);
        $this->assign('list',$list);  //数据列表
//      $this->assign('page',$p->show());


        $this->display();//在模版上显示
    }
     }
     public function add1(){
     	if(IS_POST){
     		$mvp['wenti']=$_POST['wenti'];
     	$mvp['answer']=$_POST['answer'];
     	$about=D("wenti");
     	$list=$about->add($mvp);
     	$this->ajaxReturn(interfaceReturn(0,'成功',""));
     	}
     	
     	$this->display();
     }
     public function edit1(){
     	if(IS_POST){
     		$id=$_POST['id'];
     		$about=D("wenti");
     		$mvp['wenti']=$_POST['wenti'];
     	    $mvp['answer']=$_POST['answer'];
     		$list=$about->where('wenti_id='.$id)->save($mvp);
     		$this->ajaxReturn(interfaceReturn(0,'成功',""));
     	}
     	$id=$_GET['id'];
     	$about=D("wenti");
     	$list=$about->where('wenti_id='.$id)->find();
     	$this->assign('list',$list);  //
     	$this->display();
     }
     public function del1(){
     	$id=$_POST['id'];
     	$about=D("wenti");
     	$list=$about->where('wenti_id='.$id)->delete();
     	$this->ajaxReturn(interfaceReturn(0,'成功',""));
     }
     public function showlist3(){
     	$about=D("lianxi");



		$sql="select * from  lianxi";
        if(IS_POST){
            $name=$_POST['txtName'];
            $sql=$sql." where bumen like '%$name%'  ";
            $list=$about->query($sql);
            $this->assign('list',$list);
            $auth=D('adminrauth');
            $uid=session('user.id');
            $lists=$auth->where('admin_id='.$uid)->select();
            $a="";
            foreach($lists as $k=>$v){
                $a.=$v['auth_id'].',';
            }
            //dump ($a);
            $this->assign('res',$a);
            $this->display();
		}else{
             $list=$about->query($sql);
             $auth=D('adminrauth');
            $uid=session('user.id');
            $lists=$auth->where('admin_id='.$uid)->select();
            $a="";
            foreach($lists as $k=>$v){
                $a.=$v['auth_id'].',';
            }
            //dump ($a);
            $this->assign('res',$a);
        $this->assign('list',$list);  //数据列表
//      $this->assign('page',$p->show());


        $this->display();//在模版上显示
    }
     }
     public function add3(){
     	if(IS_POST){
     		$mvp['bumen']=$_POST['bumen'];
     	$mvp['fangshi']=$_POST['fangshi'];
     	$about=D("lianxi");
     	$list=$about->add($mvp);
     	$this->ajaxReturn(interfaceReturn(0,'成功',""));
     	}
     	
     	$this->display();
     }
     public function edit3(){
     	if(IS_POST){
     		$id=$_POST['id'];
     		$about=D("lianxi");
     		$mvp['bumen']=$_POST['bumen'];
     	    $mvp['fangshi']=$_POST['fangshi'];
     		$list=$about->where('lianxi_id='.$id)->save($mvp);
     		$this->ajaxReturn(interfaceReturn(0,'成功',""));
     	}
     	$id=$_GET['id'];
     	$about=D("lianxi");
     	$list=$about->where('lianxi_id='.$id)->find();
     	$this->assign('list',$list);  //
     	$this->display();
     }
     public function del3(){
     	$id=$_POST['id'];
     	$about=D("lianxi");
     	$list=$about->where('lianxi_id='.$id)->delete();
     	$this->ajaxReturn(interfaceReturn(0,'成功',""));
     }

}