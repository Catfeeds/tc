<?php

namespace Admin\Controller;

use Think\Controller;


class CommentController extends BaseController{


 
    //视频评论显示
   public  function  showlistvideo(){
        $video=D('comment_video');
        $sql="select c.*,u.name,g.name as gname from comment_video as c,user as u ,goods as g where c.uid=u.user_id and c.video_id=g.goods_id";

        if(IS_POST){//查询后
            $name=$_POST["txtName"]; //状态
            $sql=$sql." and g.name like '%$name%'  ";           
            $info= $video->query($sql);         
            $this->assign('info',$info);
            $this->display();
            
        }else{//初始加载
            $info= $video->query($sql);
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
    //删除视频评论
    public function delvideo(){
        $id=$_GET['fid'];
        $video=D('comment_video');
        $list=$video->delete($id);
        if($list){
            echo "<script>alert('删除成功！');window.location.href='".__MODULE__."/comment/showlistvideo';</script>";
        }else{
            echo "<script>alert('删除失败！')</script>";
        }
    }

    //直播评论显示
   public  function  showlistlive(){
        $liveb=D('comment');
        $sql="select c.*,u.name,g.name as gname from comment as c,user as u ,goods as g where c.uid=u.user_id and c.goods_id=g.goods_id";

        if(IS_POST){//查询后
            $name=$_POST["txtName"]; //状态
            $sql=$sql." and g.name like '%$name%'  ";           
            $info= $liveb->query($sql); 
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
            
        }else{//初始加载
            $info= $liveb->query($sql);
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
    //删除直播评论
     public function dellive(){
        $id=$_GET['fid'];
        $video=D('comment');
        $list=$video->delete($id);
        if($list){
            echo "<script>alert('删除成功！');window.location.href='".__MODULE__."/comment/showlistlive';</script>";
        }else{
            echo "<script>alert('删除失败！')</script>";
        }
    }
    //添加视频评论界面
    public function addvideo(){
        $id=$_GET['id'];
        $this->assign('id',$id);
        $this->display();
    }
     //添加直播评论界面
    public function addliveb(){
        $id=$_GET['id'];
        $this->assign('id',$id);
        $this->display();
    }
     //添加直播评论
    public function passliveb(){
        $id=$_POST['id'];
        $t=D('comment_liveb');
        $row=$t->where('comment_id='.$id)->find();
        $mvp['uid']=$this->getRandomString(11);
        $mvp['tid']=$row['tid'];
        $mvp['liveb_id']=$row['liveb_id'];
        $mvp['star']=$_POST['star'];
        $res=$t->add($mvp);
        $this->ajaxReturn(interfaceReturn(0,'成功',""));
    }
    //添加视频评论
    public function passvideo(){
        $id=$_POST['id'];
        $t=D('comment_video');
        $row=$t->where('comment_id='.$id)->find();
        $mvp['uid']=$this->getRandomString(11);
        $mvp['tid']=$row['tid'];
        $mvp['video_id']=$row['video_id'];
        $mvp['content']=$_POST['content'];
        $mvp['star']=$_POST['star'];
        $res=$t->add($mvp);
        $this->ajaxReturn(interfaceReturn(0,'成功',""));
    }
    //评论审核拒绝
    public function refuse(){
        $dataId=I("id");
        $data=M("comment")->where(" comment_id = ".$dataId)->find();
        $data["status"]="2";
        M("comment")->where(" comment_id = ".$dataId)->delete();
        
        adminLog("拒绝",$dataId,"","成功","");
        
        $this->ajaxReturn(interfaceReturn(0,'成功',""));
    }
    //评论审核通过
    public function pass(){
        $dataId=I("id");
        $data=M("comment")->where(" comment_id = ".$dataId)->find();
        $data["status"]="1";
        M("comment")->data($data)->save();
        $star=D('comment_goods');
        $select=$star->where('goods_id='.$data['goods_id'])->find();
        if($select){
            $mvp['num']=$select['num']+1;
            $mvp['star']=$select['star']+$data['star'];
            $star->where('comment_goods_id='.$select['comment_goods_id'])->save($mvp);
        }else{
            $mvp['goods_id']=$data['goods_id'];
            $mvp['num']=1;
            $mvp['star']=$data['star'];
            $star->add($mvp);
        }
        adminLog("通过",$dataId,"","成功","");
        
        $this->ajaxReturn(interfaceReturn(0,'成功',""));
    }
    //视频评论审核拒绝
    public function refusevideo(){
        $dataId=I("id");
        $data=M("comment_video")->where(" comment_id = ".$dataId)->find();
        $data["status"]="2";
        M("comment_video")->data($data)->save();
        
        adminLog("拒绝",$dataId,"","成功","");
        
        $this->ajaxReturn(interfaceReturn(0,'成功',""));
    }
    //视频评论审核通过
    public function videopass(){
        $dataId=I("id");
        $data=M("comment_video")->where(" comment_id = ".$dataId)->find();
        $data["status"]="1";
        M("comment_video")->data($data)->save();
        
        adminLog("通过",$dataId,"","成功","");
        
        $this->ajaxReturn(interfaceReturn(0,'成功',""));
    }
}