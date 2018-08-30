<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018\8\13 0013
 * Time: 11:34
 */

namespace Admin\Controller;

use Think\Controller;


class RoleController extends BaseController
{
    public function rolelist(){
        $info=M('role')->select();
        $count=M('role')->count();
        $this->assign('role_info',$info);
        $this->assign('role_num',$count);
        $this->display();
    }
    public function roleadd(){
        if(IS_POST){
            $auth=json_encode(I('post.auth'));
            $data=[
                'role_name'=>I('post.auth_name'),
                'role_des'=>I('post.auth_des'),
                'role_auth'=>$auth,
                'set_time'=>time()
            ];
            $res=M('role')->add($data);
            if($res){
                echo "<script>alert('添加角色成功！');parent.location.href='".__MODULE__."/Role/rolelist';</script>";
            }else{
                echo "<script>alert('添加角色失败！');parent.location.href='".__MODULE__."/Role/rolelist';</script>";
            }
        }else{
            $info=M('auth')->select();
            $this->assign('info',$info);
            $this->display();
        }

    }
    public function role_action(){
        if(IS_POST){
            //dump($_POST);
            $data['role_name']=I('post.auth_name');
            $data['role_des']=I('post.auth_des');
            $data['role_auth']=json_encode(I('post.auth'));
            $data['role_id']=I('post.role_id');
            $res=M('role')->data($data)->save();
            if($res>0){
                echo "<script>alert('修改权限成功！');parent.location.href='".__MODULE__."/Role/rolelist';</script>";
            }else{
                echo "<script>alert('修改权限失败！');parent.location.href='".__MODULE__."/Role/rolelist';</script>";
            }
        }
    }
    public function roledel(){
        $id=$_GET["id"];
        //删除前判断是否有角色拥有该权限 有的话不让删除
        $is_have=M('admin')->where('role_id='.$id)->find();
        if ($is_have){
            $this->ajaxReturn(0,'JSON');
        }else{
            $role=M("role");
            $res=$role->delete($id);
            if($res){
                $this->ajaxReturn(1,'JSON');
            }else{
                $this->ajaxReturn(-1,'JSON');
            }
        }
    }
    public function roleedit(){
        $role_id=$_GET['id'];
        $auth_arr=M('role')
            ->where('role_id = '.$role_id)
            ->find();
        if($auth_arr['role_auth']=='all'){
            echo "<script>alert('此超管神圣不可侵犯！');parent.location.href='".__MODULE__."/Role/rolelist';</script>";
        }else{
            $auth=json_decode($auth_arr['role_auth'],true);
            //dump($auth);
            $info=M('auth')->select();
            $this->assign('info',$info);
            $this->assign('auth_arr',$auth_arr);
            $this->assign('auth',$auth);
            $this->assign('role_id',$role_id);
            //查角色 拥有的权限
            $this->display();
        }
    }
}