<?php

namespace  Api\Controller;
use Think\Controller;
header('Content-Type:text/json;charset=utf-8');
header("Access-Control-Allow-Origin: *");
class CateController extends CommonController {

    //获取一级和二级分类
    public function index(){
        if(IS_POST){
            $cate=M('category');
            $where['pid']=0;
            $where['cate_id']=array('neq',1);
            $onecate=$cate->where($where)->select();
            $data=array();
            foreach($onecate as $k=>$v){
                $data[$k]['cid']=$v['cate_id'];
                $data[$k]['cName']=$v['name'];
                $twocate=$cate->where(array('pid'=>$v['cate_id']))->select();
                if(!$twocate){
                    $data[$k]['sonClass']=array();
                }else{
                    foreach($twocate as $kk=>$vv){
                        $data[$k]['sonClass'][$kk]['cid']=$vv['cate_id'];
                        $data[$k]['sonClass'][$kk]['cName']=$vv['name'];
                    }
                }


            }
            $rel['data']=$data;
            $this->templateApi($rel,'200','ok');
        }else{
            $this->templateApi('','203','请求类型错误');
        }
    }
    //根据一级分类获取二级和三级分类
    public function ttcate(){
        if(IS_POST){
            $cId=I('post.cId');   //一级分类id或者二级分类id
            $cate=M('category');
            $onecate=$cate->where(array('cate_id'=>$cId))->find();
            if($onecate){
                if($onecate['pid']==0){
                    $data['cid']=$onecate['cate_id'];
                    $data['cName']=$onecate['name'];
                }else{
                    $fcate=$cate->where(array('cate_id'=>$onecate['pid']))->find();
                    if($fcate['pid']==0){
                        $cId=$fcate['cate_id'];
                        $data['cid']=$fcate['cate_id'];
                        $data['cName']=$fcate['name'];
                    }else{
                        $ffcate=$cate->where(array('cate_id'=>$fcate['pid']))->find();
                        $cId=$ffcate['cate_id'];
                        $data['cid']=$ffcate['cate_id'];
                        $data['cName']=$ffcate['name'];
                    }
                }
                $caterel=$cate->where(array('pid'=>$cId))->select();
                if(!$caterel){
                    $data['sonClass']=array();
                }else{
                    foreach($caterel as $k=>$v){
                        $data['sonClass'][$k]['cid']=$v['cate_id'];
                        $data['sonClass'][$k]['cName']=$v['name'];
                        $threecate=$cate->where(array('pid'=>$v['cate_id']))->select();
                        if(!$threecate){
                            $data['sonClass'][$k]['sonClass']=array();
                        }else{
                            foreach($threecate as $kk=>$vv){
                                $data['sonClass'][$k]['sonClass'][$kk]['cid']=$vv['cate_id'];
                                $data['sonClass'][$k]['sonClass'][$kk]['cName']=$vv['name'];
                            }
                        }
                    }
                }

            }else{
                $this->templateApi('','202','分类信息错误');
            }

            $this->templateApi($data,'200','ok');
        }else{
            $this->templateApi('','203','请求类型错误');
        }
    }

    //获取一级.二级.三级分类
    public function allcate(){
        if(IS_POST){
            $cate=M('category');
            $where['pid']=0;
            $where['cate_id']=array('neq',1);
            $onecate=$cate->where($where)->select();
            $data=array();
            foreach($onecate as $k=>$v){
                $data[$k]['cid']=$v['cate_id'];
                $data[$k]['cName']=$v['name'];
                $twocate=$cate->where(array('pid'=>$v['cate_id']))->select();
                if(!$twocate){
                    $data[$k]['sonClass']=array();
                }else{
                    foreach($twocate as $kk=>$vv){
                        $data[$k]['sonClass'][$kk]['cid']=$vv['cate_id'];
                        $data[$k]['sonClass'][$kk]['cName']=$vv['name'];
                        $threecate=$cate->where(array('pid'=>$vv['cate_id']))->select();
                        if(!$threecate){
                            $data[$k]['sonClass'][$kk]['sonClass']=array();
                        }else{
                            foreach($threecate as $kkk=>$vvv){
                                $data[$k]['sonClass'][$kk]['sonClass'][$kkk]['cid']=$vvv['cate_id'];
                                $data[$k]['sonClass'][$kk]['sonClass'][$kkk]['cName']=$vvv['name'];
                            }
                        }
                    }
                }
            }
            $rel['data']=$data;
            $this->templateApi($rel,'200','ok');
        }else{
            $this->templateApi('','203','请求类型错误');
        }
    }
    //一级分类更多
    public function more(){
        if(IS_POST){
            $cate=M('category');
            $where['pid']=0;
            $where['cate_id']=array('neq',1);
            $caterel=$cate->where($where)->select();
            $data=array();
            foreach($caterel as $k=>$v){
                $data[$k]['cid']=(string)$v['cate_id'];
                $data[$k]['cName']=(string)$v['name'];
                $data[$k]['cImgURL']=(string)URL.$v['img'];
            }
            $rel['data']=$data;
            $this->templateApi($rel,'200','ok');
        }else{
            $this->templateApi('','203','请求类型错误');
        }
    }

    //获取子集分类
        public function chilren(){
        $cid=I('post.cId'); //分类id
        $cate=M('category');
        $onecate=$cate->where(array('cate_id'=>$cid))->find();
        $twocate=$cate->where(array('pid'=>$onecate['cate_id']))->select();
        foreach($twocate as $k=>$v){
            $data[$k]['cid']=$v['cate_id'];
            $data[$k]['cName']=$v['name'];
        }
        $this->templateApi($data,'200','ok');
    }
}