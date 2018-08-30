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
class ClassCateController extends BaseController{


    public function cate(){
        $cate_m=M("category");
        //服务器分页begin  前端的分页放弃
        //$news = M('category'); // 实例化User对象
        $count      = $cate_m->count();// 查询满足要求的总记录数
        $p_data=pager($count);
        /*$Page       = new \Think\Page($count,12);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $Page->lastSuffix=false;
        $Page->setConfig('header','<li class="rows">共<b>%TOTAL_ROW%</b>条记录&nbsp;&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $Page->setConfig('last','末页');
        $Page->setConfig('first','首页');
        $Page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
        $show       = $Page->show();// 分页显示输出*/
        //服务器分页end

        if(IS_POST){
            $name=$_POST['txtName'];
            $sql=" name like '%$name%'  ";
            $list=$cate_m->where($sql)->limit($p_data['limit'])->order('cate_id desc')->select();
            foreach($list as $key=>$val){
            $rel=$cate_m->field('name')->where('cate_id='.$val['pid'])->select();
            if(count($rel[0]['name'])>0){
                $list[$key]['pid']=$rel[0]['name'];
            }else{
                $list[$key]['pid']='无';
            }
        }
            $this->assign('list',$list);
            $this->display();
		}else{
            $list=$cate_m ->limit($p_data['limit'])->order('cate_id desc')->select();
             foreach($list as $key=>$val){
                $rel=$cate_m->field('name,cate_id')->where('cate_id='.$val['pid'])->select();
                    if(count($rel[0]['name'])>0){
                        $list[$key]['pid']=$rel[0]['name'];
                        $list[$key]['fid']=$rel[0]['cate_id'];
                    }else{
                        $list[$key]['pid']='无';
                        $list[$key]['fid']='无';
                    }
            }
            // 赋值分页输出
        $this->assign('page',$p_data['show']);
        $this->assign('list',$list);  //数据列表
        $this->display();//在模版上显示
    }
}
//
    public function add(){
        $auth=M("category");
        if(IS_POST){
            //ajax 二级联动添加课程
            $cate_1=I('post.cate_1');
            $cate_2=I('post.cate_2');
            $name=I('post.name');
            //如果1/2级分类都为0 则pid=0  如果1级不为0 二级为0 则pid为cate_1 1/2都不为0则 pid为cate_2
            if($cate_1==0 && $cate_2==0){
                $pid=0;
            }elseif ($cate_1!=0 && $cate_2==0){
                $pid=$cate_1;
            }else{
                $pid=$cate_2;
            }
            $arr=array(
                'pid'=>$pid,
                'name'=>$name,
            );
            if($arr['name']==''){
                echo "<script>alert('类别名称不能为空！！！请重新添加');window.location.href='".__MODULE__."/ClassCate/cate';</script>";
            }else{
            $res=$auth->add($arr);
            if($res){
                echo "<script>alert('添加成功！');parent.location.href='".__MODULE__."/ClassCate/cate';</script>";
            }else{
                echo "<script>alert('添加失败！')</script>";
            }
        }
        }else{
            $cat=M('category')->where('pid = 0')->select();
            $this->assign('cate_1',$cat);
            $this->display();
        }

    }
    public function get_cate2(){
        $id=I('post.id');
        $cate_2=M('category')->field('name,pid,cate_id')->where(['pid'=>$id])->select();
        $html='';
        if ($cate_2){
            $html="<option value='0'>无</option>";
            foreach ($cate_2 as $k=>$v){
                $html.='<option value="'.$v['cate_id'].'">'.$v['name'].'</option>';
            }
        }
        echo $html;
    }
    //绑定增加表单中的下拉框
    public function bindpauth(){
        $auth=D("category");

        $sql='select cate_id,name from category where pid =0';

        $res=$auth->query($sql);
        return $res;
    }
    //修改
    public function edit(){
        $auth=D("category");
        if(!empty($_POST)){  //点击提交按钮   完成修改部分
            $id=$_POST['id'];
            $name=I('post.name');//权限名称
            $arr=array(
                'name'=>$name,
            );
            $res=$auth->where('cate_id='.$id)->data($arr)->save();
            if($res){
                echo "<script>alert('修改成功！');parent.location.href='".__MODULE__."/ClassCate/cate';</script>";
            }else{

                echo "<script>alert('修改失败！');parent.location.href='".__MODULE__."/ClassCate/cate';</script>";
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

        $auth=M("category");

        $resson=$auth->where('pid='.$id)->select();

        if($resson){//父权限下有子权限
			$this->ajaxReturn(2);
        }else{//父权限下没有子权限

            $res=$auth->delete($id);
            if($res){
            	$this->ajaxReturn(1);
			}else{
				$this->ajaxReturn(3);;
            }
        }

    }
}