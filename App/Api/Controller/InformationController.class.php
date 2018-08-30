<?php
/******************************
 *
 * 时间：201年8月3日
 * 功能：新闻资讯
 * 作者：Mr Peng
 *
 *****************************/
namespace Api\Controller;
use Think\Controller;
header('Content-Type:text/json;charset=utf-8');
header("Access-Control-Allow-Origin: *");
class InformationController extends CommonController {
    //资讯列表及轮播图
    public function index(){
        $page=I('page');
        if($page==''){
            $this->templateApi('','204','参数错误');exit;
        }
        $information=M('information');
        //轮播图
        $lunbo=$information->order('time desc')->limit(3)->field('information_id,title,img')->select();
        foreach($lunbo as $k=>$v){
            $lunbo[$k]['img']=URL.$v['img'];
        }
        //列表
        $count=M('information')->count();
        $data=$this->havePage('information','','time desc',$page,'20','');
        $pie['now_page']=$data['now_page'];
        $pie['total_page']=$data['total_page'];
        unset($data['now_page']);
        unset($data['total_page']);
        foreach($data as $k=>$v){
            $data[$k]['time']=date('Y-m-d H:i',$v['time']);
            $data[$k]['img']=URL.$v['img'];
        }
        $acc['lunbo']=$lunbo;
        $acc['data']=$data;
        $acc['now_page']=$pie['now_page'];
        $acc['total_page']=$pie['total_page'];
        $acc['count']=$count;
        $this->templateApi($acc,'200','ok');
    }
    //资讯详情
    public function details(){
        $id=I('information_id');
        if($id==''){
            $this->templateApi('','204','参数错误');exit;
        }
        $information=M('information');
        $rel=$information->where(array('information_id'=>$id))->find();
        $rel['img']=URL.$rel['img'];
        $rel['time']=date('Y-m-d H:i',$rel['time']);
        $this->templateApi($rel,'200','ok');
    }
}