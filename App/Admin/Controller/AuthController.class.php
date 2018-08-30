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
        $info=$auth->select();
        $this->assign('auth_info',$info);
        $this->display();
       /* $auth=D("auth");
		$sql="select * from  Auth";
        if(IS_POST){
            $name=$_POST['txtName'];
            $sql=$sql." where name like '%$name%'  ";
            $list=$auth->query($sql);
            foreach($list as $key=>$val){
            $rel=$auth->field('name')->where('auth_id='.$val['pid'])->select();
            //dump($rel);
            if(count($rel[0]['name'])>0){
                $list[$key]['pid']=$rel[0]['name'];
            }else{
                $list[$key]['pid']='无';
            }
        }
            $this->assign('list',$list);
            $this->display();
		}else{
            $list=$auth->query($sql);
        foreach($list as $key=>$val){
            $rel=$auth->field('name')->where('auth_id='.$val['pid'])->select();
            //dump($rel);
            if(count($rel[0]['name'])>0){
                $list[$key]['pid']=$rel[0]['name'];
            }else{
                $list[$key]['pid']='无';
            }
        }
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
    }*/
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