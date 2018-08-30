<?php

namespace Admin\Controller;

use Think\Controller;


class AdminController extends BaseController{
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
			//$info= $admin->query($sql);
            $info=M('admin')
                ->alias('ad')
                ->join('role as ro on ad.role_id=ro.role_id')
                ->field('ad.*,ro.role_name')
                ->select();
			foreach($info as $k=>$v){
				$info[$k]['time']=date("Y-m-d H:i:s",$v['time']);
			}
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
            $arr['name']=I('post.name');
            $arr['pass']=I('post.pass');
            $arr['status']=I('post.status');
            $arr['role_id']=I('post.role');
            $arr['time']=time();
            $res=$admin->data($arr)->add();
        if($res>0){
        	  echo "<script>alert('添加成功！');parent.location.href='".__MODULE__."/Admin/showlist';</script>";
        }else{
          echo "<script>alert('添加失败！');parent.location.href='".__MODULE__."/Admin/showlist';</script>";
        }
    }
    }
	
    public function add(){
        //角色
        $info=M('role')->field('role_id,role_name')->select();
        $this->assign('info',$info);
        $this->display();
    }


    //修改管理员
    public function upd($id){
        //修改
        if(!empty($_POST)){
            $admin=M("Admin");
            $arr=array(
                'name'=>I('post.name'),
                'pass'=>I('post.pass'),
                'status'=>I('post.status'),
                'role_id'=>I('post.role_id'),
                'time'=>time()
            );
            $res=$admin->where('admin_id='.$id)->data($arr)->save();
            if($res){
                echo "<script>alert('修改成功！');parent.location.href='".__MODULE__."/Admin/showlist';</script>";
            }else{
                echo "<script>alert('修改失败！');</script>";
            }
        }else{
            //展示
            $id=$_GET["id"];
            $admin=M("Admin");
            //使用select时,返回的是二维数组  如果只需要一条数据，类似删除或者修改，可用find  前台模版取值时  要使用[][]方式
            $info=$admin
                ->alias('ad')
                ->join('role as ro on ad.role_id=ro.role_id')
                ->field('ad.*,ro.role_name')
                ->where('ad.admin_id='.$id)
                ->find();
            //角色
            $role_info=M('role')
                ->field('role_id,role_name')
                ->select();
            $this->assign('info',$info);
            $this->assign('role_info',$role_info);
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
        $admin=M("Admin");
        $res=$admin->delete($id);
        if($res){
            echo "<script>alert('删除成功！');window.location.href='".__MODULE__."/Admin/showlist';</script>";
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
            $auth=D("Auth");						

            $authinfo=$auth->select();
			
			//使用select时,返回的是二维数组  如果只需要一条数据，类似删除或者修改，可用find  前台模版取值时  要使用[][]方式
          	$sql="select * from Auth au left join adminrauth ara on au.auth_id=ara.auth_id where ara.admin_id=".$id;
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