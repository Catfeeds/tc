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


class CateController extends BaseController{


    public function cate(){
        $auth=D("category");



		$sql="select * from  category";
        if(IS_POST){
            $name=$_POST['txtName'];
            $sql=$sql." where name like '%$name%'  ";
            $list=$auth->query($sql);
            foreach($list as $key=>$val){
            $rel=$auth->field('name')->where('cate_id='.$val['pid'])->select();
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

            $this->assign('list',$list);
            $this->display();
		}else{
            $list=$auth->query($sql);


        foreach($list as $key=>$val){
            $rel=$auth->field('name,cate_id')->where('cate_id='.$val['pid'])->select();
            //dump($rel);
            if(count($rel[0]['name'])>0){
                $list[$key]['pid']=$rel[0]['name'];
                $list[$key]['fid']=$rel[0]['cate_id'];
            }else{
                $list[$key]['pid']='无';
                $list[$key]['fid']='无';
            }
        }
        //dump($list);
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






    //封装分页函数  $count:总记录条数    $pagesize:每页显示记录数

   /*public function getpage($count,$pagesize){
        $p=new \Think\Page($count,$pagesize);
        $p->setConfig('header','<li class="rows">共<b>%TOTAL_ROW%</b>条记录&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');
        $p->setConfig('prev','上一页');
        $p->setConfig('next','下一页');
        $p->setConfig('last','末页');
        $p->setConfig('first','首页');
        $p->setConfig('theme','%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');
        $p->lastSuffix=false;
        return $p;

    }
*/
//添加父类
    public function add(){
        $auth=D("category");

        if(IS_POST){
            $pid='0';
            $name=I('post.name');//名称
            //$path='0,'.$pid.',';//路径
            //$status=I('post.status');//状态
            $arr=array(
                'pid'=>$pid,
                'name'=>$name,
            );
            if($arr['name']==''){
                echo "<script>alert('类别名称不能为空！！！请重新添加');window.location.href='".__MODULE__."/Cate/cate';</script>";
            }else{
            $res=$auth->add($arr);
            if($res){
                echo "<script>alert('添加成功！');parent.location.href='".__MODULE__."/Cate/cate';</script>";
            }else{
                echo "<script>alert('添加失败！')</script>";
            }
        }
        }else{
           /* $this->assign('parent',$this->bindpauth());*/
            $this->display();
        }

    }
//添加子类
         public function addz(){
                $auth=D("category");
                $id=$_GET['id'];
                //dump($id);
                if(IS_POST){
                    //$pid='0';
                    $id=I('post.id');
                    $name=I('post.name');//名称
                    //$path='0,'.$pid.',';//路径
                    //$status=I('post.status');//状态
                    $arr=array(
                        'pid'=>$id,
                        'name'=>$name,
                    );
                    if($arr['name']==''){
                        echo "<script>alert('类别名称不能为空！！！请重新添加');window.location.href='".__MODULE__."/Cate/cate';</script>";
                    }else{
                    $res=$auth->add($arr);
                    if($res){
                        echo "<script>alert('添加成功！');parent.location.href='".__MODULE__."/Cate/cate';</script>";
                    }else{
                        echo "<script>alert('添加失败！')</script>";
                    }
                }
                }else{
                   /* $this->assign('parent',$this->bindpauth());*/
                   $this->assign('id',$id);
                    $this->display();
                }

            }



    //绑定增加表单中的下拉框
    public function bindpauth(){
        $auth=D("category");

        $sql='select cate_id,name from category where pid =0';

        $res=$auth->query($sql);
        return $res;
    }





    //修改子权限
    public function edit(){
        $auth=D("category");
        if(!empty($_POST)){  //点击提交按钮   完成修改部分
            $id=$_POST['id'];
            $name=I('post.name');//权限名称
            
            $arr=array(
                'name'=>$name,
            );
            //dump($arr);
            //die();
            $res=$auth->where('cate_id='.$id)->data($arr)->save();

            //dump($auth->_sql());
            //dump($res);
            if($res){
                echo "<script>alert('修改成功！');parent.location.href='".__MODULE__."/Cate/cate';</script>";
            }else{

                echo "<script>alert('修改失败！');parent.location.href='".__MODULE__."/Cate/cate';</script>";
            }
        }else{ 
             $id=$_GET["id"];            //显示修改面板
            $info=$auth->find($id);

        //dump($info);
            $this->assign('info',$info);
            $this->assign('id',$id);
             $this->assign('parent',$this->bindpauth());
        
            $this->display();
        }
    }

    //修改父权限
  /*  public function updparent(){
        $auth=D("Authorityname");
        if(!empty($_POST)){  //点击提交按钮   完成修改部分
            $id=$_POST['id'];
            //$pid=$_POST['pid'];
            //dump($pid);
            //die();
            $name=I('post.name');//权限名称
            $path='0,0,';//权限路径
            $status=I('post.status');//权限状态

            $arr=array(
                'pid'=>'0',
                'name'=>$name,
                'path'=>$path,
                'status'=>$status
            );
           
            $res=$auth->where('auth_id='.$id)->data($arr)->save();

//            dump($auth->_sql());
//            dump($res);
            if($res){
                echo "<script>alert('修改成功！');parent.location.href='".__MODULE__."/Authorityname/showlist';</script>";
            }else{

                echo "<script>alert('修改失败！');parent.location.href='".__MODULE__."/Authorityname/showlist';</script>";
            }
        }else{   
         $id=$_GET["id"];           
                   //显示修改面板
            $info=$auth->find($id);
            $this->assign('id',$id);
//            dump($info);
            $this->assign('info',$info);
               $this->assign('parent',$this->bindpauth());
            $this->display();
        }
    }*/


    public function del(){

        $id=$_POST["id"];

        $auth=D("category");

        $resson=$auth->where('pid='.$id)->select();

        if($resson){//父权限下有子权限
        
//      	$ajaxmsg['res']=$data;
//      	$ajaxmsg['code']=1;
//      	$ajaxmsg['statu']='ok';
//      	$ajaxmsg['msg']='该权限下有子权限，不允许删除！';

			$this->ajaxReturn(2);
//          echo "<script>alert('该权限下有子权限，不允许删除！');window.location.href='".__MODULE__."/Authorityname/showlist';</script>";
//          exit;
        }else{//父权限下没有子权限

            $res=$auth->delete($id);
            if($res){
////          	$ajaxmsg['res']=$data;
//      		$ajaxmsg['code']=1;
//      		$ajaxmsg['statu']='ok';
//      		$ajaxmsg['msg']='删除成功';
//              echo "<script>alert('删除成功！');window.location.href='".__MODULE__."/Authorityname/showlist';</script>";
            	$this->ajaxReturn(1);
			}else{
				$this->ajaxReturn(3);
////          	$ajaxmsg['res']=$data;
//      		$ajaxmsg['code']=1;
//      		$ajaxmsg['statu']='ok';
//      		$ajaxmsg['msg']='设置成功';
//              echo "<script>alert('删除失败！')</script>";
            }
        }

    }
}