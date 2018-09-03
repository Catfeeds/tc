<?php
/**
 * Created by PhpStorm.
 * User: 肖丹
 * Date: 2017/10/23 0023
 * Time: 10:22
 */


namespace Admin\Controller;

use Think\Controller;
use Think\Crypt\Driver\Think;
 
class AuthController extends BaseController{

   
    public function showlist(){
        $auth=M('auth');
        //分页
        $count      = $auth->count();
        $data=pager($count);
        //分页 end
        $info=$auth ->limit($data['limit'])->select();
        $this->assign('auth_info',$info);
        // 赋值分页输出
        $this->assign('page',$data['show']);
        $this->display();
}
    public function add(){
        $auth=M("auth");
        if(IS_POST){
            $arr=array(
                'auth_name'=>I('post.auth_name'),
                'auth_pid'=>I('post.auth_id'),
                'auth_ac'=>I('post.auth_ac')
            );
            $res=$auth->add($arr);
            if($res){
                echo "<script>alert('添加成功！');parent.location.href='".__MODULE__."/Auth/showlist';</script>";
            }else{
                echo "<script>alert('添加失败！')</script>";
            }
        }else{
            $this->assign('parent',$this->bindpauth());
            $this->display();
        }
    }
    //绑定增加表单中的下拉框
    public function bindpauth(){
        $res=M("auth")->where('auth_pid=0')->select();
        return $res;
    }
    public function updata(){
        $M=M('auth');
        if (IS_POST){
            $data=[
                "auth_id"=>I('post.auth_id'),
                "auth_name"=>I('post.auth_name'),
                "auth_ac"=>I('post.auth_ac')
            ];
            $res=$M->data($data)->save();
            if($res){
                echo "<script>alert('修改成功！');parent.location.href='".__MODULE__."/Auth/showlist';</script>";
            }
        }else{
            $id=$_GET['id'];
            $info=$M->where('auth_id='.$id)->find();
            $this->assign('info',$info);
            $this->display();

        }
    }


    public function del(){

        $id=$_GET["id"];

        $auth=D("Auth");

        $resson=$auth->where('auth_pid='.$id)->select();

        if($resson){//父权限下有子权限
            echo "<script>alert('有子权限，不能删除！');location.href='".__MODULE__."/Auth/showlist';</script>";
        }else{//父权限下没有子权限

            $res=$auth->delete($id);
            if($res){
                echo "<script>alert('删除成功！');location.href='".__MODULE__."/Auth/showlist';</script>";
			}else{
                echo "<script>alert('删除失败！');location.href='".__MODULE__."/Auth/showlist';</script>";

            }
        }

    }
}