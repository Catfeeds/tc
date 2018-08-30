<?php

namespace Admin\Controller;

use Think\Controller;


class ChangjianController extends BaseController{
	 public function showlist(){
     	       $about=D("xieyi");
  
 

		$sql="select * from  xieyi";
        if(IS_POST){
            $name=$_POST['txtName'];
            $sql=$sql." where title like '%$name%'  ";
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
    public function add(){
        if(IS_POST){
        $about=D("xieyi");
        $mvp['content']=$_POST['content'];
        $mvp['title']=$_POST['title'];
        $list=$about->add($mvp);
        $this->ajaxReturn(interfaceReturn(0,'成功',""));
        }
        
        $this->display();
     }
    public function edit(){
     	if(IS_POST){
     		$id=$_POST['id'];
     		$about=D("xieyi");
     		$mvp['content']=$_POST['content'];
            $mvp['title']=$_POST['title'];
     		$list=$about->where('xieyi_id='.$id)->save($mvp);
     		$this->ajaxReturn(interfaceReturn(0,'成功',""));
     	}
         	$id=$_GET['id'];
         	$about=D("xieyi");
         	$list=$about->where('xieyi_id='.$id)->find();
         	$this->assign('list',$list);  //
         	$this->display();
     }
     public function del(){
        $id=$_POST['id'];
        $about=D("xieyi");
        $list=$about->where('xieyi_id='.$id)->delete();
        $this->ajaxReturn(interfaceReturn(0,'成功',""));
     }
}