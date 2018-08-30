<?php

namespace Admin\Controller;

use Think\Controller;


class AdminmanageController extends BaseController{

 

    //列表显示
   public  function  showlist(){
    	$admin=D("Admin");
		$sql="select * from admin ";
		if(IS_POST){//查询后
			$name=$_POST["txtName"]; //状态
			$sql=$sql." where name like '%$name%'  ";			
			$info= $admin->query($sql);			
            $this->assign('info',$info);
            $this->display();
			
		}else{//初始加载
			$info= $admin->query($sql);
			foreach($info as $k=>$v){
				$info[$k]['time']=date("Y-m-d H:i:s",$v['time']);
			}
//            dump($info);
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


    //添加管理员
    public function add_sub(){
        $admin=M("admin");

        //获取表单中的数据
        $name=I('post.name');
        $add=$admin->where("name='{$name}'")->find();
        if($add){
               echo "<script>alert('请重新添加！！用户名重复');window.location.href='".__MODULE__."/Adminmanage/add';</script>";
        }else{
        $name=I('post.name');
        $pass=I('post.pass');
        $status=I('post.status');
        $role=I('post.role');
        $permission=I('post.permission');
        $issuper=I('post.issuper');
		$arr['name']=$name;
		$arr['pass']=$pass;
		$arr['status']=$status;
		$arr['role']=$role;
		$arr['permission']=$permission;
		$arr['issuper']=$issuper;
		$arr['time']=time();
        

       //dump($arr);

        $res=$admin->data($arr)->add();

        if($res>0){      	
        	  echo "<script>alert('添加成功！');parent.location.href='".__MODULE__."/Adminmanage/showlist';</script>";
//          //在使用系统变量时   再加一层""
//          echo "<script>alert('添加成功！');window.location.href='".__MODULE__."/Adminmanage/showlist';</script>";
////        $this->success('新增成功', 'User/list');
////        header("location:__SELF__");
////        $this->redirect("adminmanage/showlist");
				
        }else{
          echo "<script>alert('添加失败！');parent.location.href='".__MODULE__."/Adminmanage/showlist';</script>";
        }
    }
    }
	
    public function add(){
    
        $this->display();
    }


    //修改管理员
    public function upd($id){

        //接收在列表页面中传过来的id

        if(!empty($_POST)){
            $admin=D("Admin");

            $name=I('post.name');
            $pass=I('post.pass');
            $status=I('post.status');
            $role=I('post.role');
            $permission=I('post.permission');
            $issuper=I('post.issuper');

            $arr=array(
                'name'=>$name,
                'pass'=>$pass,
                'status'=>$status,
                'role'=>$role,
                'permission'=>$permission,
                'issuper'=>$issuper,
                'time'=>time()
            );

            $res=$admin->where('admin_id='.$id)->data($arr)->save();

            if($res){
                echo "<script>alert('修改成功！');parent.location.href='".__MODULE__."/Adminmanage/showlist';</script>";
            }else{
                echo "<script>alert('修改失败！');</script>";
            }
        }else{
            $id=$_GET["id"];
            //dump($id);
            $admin=D("Admin");
            //使用select时,返回的是二维数组  如果只需要一条数据，类似删除或者修改，可用find  前台模版取值时  要使用[][]方式
            $info=$admin->select($id);
            //dump($info);
            $this->assign('info',$info);
            $this->display();//在模版上显示
        }

    }


    //完成修改管理员
    public function completeupd(){
        //获得隐藏域里的id
        $id=$_POST["id"];

        $admin=D("Admin");




        $name=I('post.name');
        $pass=I('post.pass');
        $status=I('post.status');
        $role=I('post.role');
        $permission=I('post.permission');
        $issuper=I('post.issuper');

        $arr=array(
            'name'=>$name,
            'pass'=>$pass,
            'status'=>$status,
            'role'=>$role,
            'permission'=>$permission,
            'issuper'=>$issuper,
            'time'=>time()
        );

        $res=$admin->where('admin_id='.$id)->data($arr)->save();

       // dump($id);

        //dump($res);
    }

    //删除管理员
    public function del(){
        $id=$_GET["id"];
        $admin=D("Admin");


//        $res=$admin->where('admin_id=$id')->delete();
        $res=$admin->delete($id);
        if($res){
            echo "<script>alert('删除成功！');window.location.href='".__MODULE__."/Adminmanage/showlist';</script>";
        }else{
            echo "<script>alert('删除失败！')</script>";
        }

    }



    //给管理员设置权限
    public function setauth(){
        if(!empty($_POST)){
            $m=D('adminrauth');
            $del=$m->where("admin_id={$_POST['hiddenadmin']}")->delete();
            foreach($_POST['ns'] as $k=>$v){
                $arr=['admin_id'=>$_POST['hiddenadmin'],'auth_id'=>$v];
                $row=$m->add($arr);
            }
            if($row){
                echo "<script>parent.location.href='".U('showlist')."'</script>";
            }
        }else{
        	//将所有权限名称都显示到页面上，此用户拥有的权限选中   	
            //获得列表页传来的用户id  并将权限名称显示到页面上
            $id=$_GET["id"];//获取列表页传过来的用户表的id

            //dump($id);
            $auth=D("Authorityname");						

            $authinfo=$auth->select();
			
			//使用select时,返回的是二维数组  如果只需要一条数据，类似删除或者修改，可用find  前台模版取值时  要使用[][]方式
          	$sql="select * from authorityname au left join adminrauth ara on au.auth_id=ara.auth_id where ara.admin_id=".$id;
          	$res= $auth->query($sql);
            $arr=array();
            foreach($res as $k=>$v){
                $arr[]=$v['name'];
            }
            //dump($authinfo);
         	$this->assign('arr',$arr);
            $this->assign('info',$authinfo);
            $this->assign('hiddenid',$id);   //将get获得的id传到html页面中的隐藏域
            $this->display();               
        }
    }
    
}