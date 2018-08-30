<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018\8\23 0023
 * Time: 9:33
 */


namespace Admin\Controller;
use Think\Controller;


class ImgcheckController extends BaseController{
    //列表页
    public function check_list(){
        $M=M('class');
        $img=$img="http://wyk-img-1255995999.cos.ap-beijing.myqcloud.com";
        //服务器分页begin  前端的分页放弃
        $count      = $M-> where("new_bg_img != '' OR new_face != ''" )->count();// 查询满足要求的总记录数
        $Page       = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $Page->lastSuffix=false;
        $Page->setConfig('header','<li class="rows">共<b>%TOTAL_ROW%</b>条记录&nbsp;&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $Page->setConfig('last','末页');
        $Page->setConfig('first','首页');
        $Page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
        $show       = $Page->show();// 分页显示输出
        //服务器分页end
        if(IS_POST){
            //搜索
            if (I('post.selstatus')==0){
                //去掉一个审批过 一个为空的情况
                $where="(new_bg_img_allow = 0 OR new_face_allow = 0) AND (new_bg_img != '' OR new_face != '') AND !(new_bg_img = '' AND new_face_allow!='0' ) AND !(new_face='' AND new_bg_img_allow!='0' )" ;
            }else{
                //全部
                $where="new_bg_img != '' OR new_face != ''" ;
                // 赋值分页输出
                $this->assign('page',$show);
            }
        }else{
            //正常
            $where="new_bg_img != '' OR new_face != ''" ;
            // 赋值分页输出
            $this->assign('page',$show);
        }
        $info=$M
            ->field('class_id,name,img,new_face,new_face_allow,new_bg_img,new_bg_img_allow,bg_img')
            ->limit($Page->firstRow.','.$Page->listRows)
            ->where($where)
            ->order('new_face_allow ASC,new_bg_img_allow ASC')
            ->select();
        $this->assign('img',$img);
        $this->assign('info',$info);
        $this->display();
    }
    //弹出层页面 通过参数判断是头像还是背景
    public function do_check(){
        $img=$img="http://wyk-img-1255995999.cos.ap-beijing.myqcloud.com";
        $info=M('class')->field('class_id,'.$_GET['type'])->where('class_id = '.$_GET['id'])->find();
        $this->assign('info',$info);
        $this->assign('type',$_GET['type']);
        $this->assign('img',$img);
        $this->display();
    }
    //通过参数判断是头像还是背景 操作
    public function pass(){
        if (IS_POST){
            $data['class_id']=I('post.class_id');
            if(I('post.type')=='new_face'){
                $data['new_face_allow']=1;
            }else{
                $data['new_bg_img_allow']=1;
            }
            $res=M('class')->data($data)->save();
            if($res){
                //echo "<script>alert('修改成功');parent.location.href='".__MODULE__."/Imgcheck/check_list';</script>";
                $this->ajaxReturn(1,'JSON');
            }

        }
    }
    //拒绝备用
    public function refuse(){
        //哈哈哈哈哈哈
        if (IS_POST){
            $data['class_id']=I('post.class_id');
            if(I('post.type')=='new_face'){
                $data['new_face_allow']=2;
            }else{
                $data['new_bg_img_allow']=2;
            }
            $res=M('class')->data($data)->save();
            if($res){
                //echo "<script>alert('修改成功');parent.location.href='".__MODULE__."/Imgcheck/check_list';</script>";
                $this->ajaxReturn(1,'JSON');
            }

        }
    }
}