<?php

namespace  Api\Controller;
use Think\Controller;
header('Content-Type:text/json;charset=utf-8');
header("Access-Control-Allow-Origin: *");
class ProfitController extends CommonController {

    //收益明细
        public function profit(){
        if(IS_POST){
            $token=I('post.token');
            $type=I('post.type');
            $page=I('post.pageNum');
            if($token==''||$type==''||$page==''){
                $this->templateApi('','204','参数错误');exit;
            }
            $user=M('user')->where(array('token'=>$token))->find();
            if($user){
//                $pay=M('payrecord');
                $where['uid']=$user['user_id'];
                if($type=='0'){//收入
                    $where['type']=1;
                    $where['ptype']=2;
                }else if($type=='1'){//支出
                    $count=M('withdraw')->where($where)->count();
                    $data=$this->havePage('withdraw',$where,'time desc',$page,'8','');
                    $pie['now_page']=$data['now_page'];
                    $pie['total_page']=$data['total_page'];
                    unset($data['now_page']);
                    unset($data['total_page']);
                    foreach($data as $k=>$v){
                        if($v['status']==0){
                            $date[$k]['title']='提现中';
                        }else if($v['status']==1){
                            $date[$k]['title']='提现成功';
                        }else{
                            $date[$k]['title']='提现失败';
                        }
                        $date[$k]['time']=(string)date('Y年m月d日 H:i:s',$v['time']);
                        $date[$k]['money']=(string)$v['money'];
                        $date[$k]['status']=(string)$v['status'];   //提现状态  0：提现中 1：ok  2：err
                        $date[$k]['type']='2';
                    }
                    if(empty($date)){
                        $rel['data']=array();
                    }else{
                        $rel['data']=$date;
                    }
                    $rel['now_page']=$pie['now_page'];
                    $rel['total_page']=$pie['total_page'];
                    $rel['count']=$count;
                    $this->templateApi($rel,'200','ok');exit;
                }else if($type=='2'){//收入
                    $where['type']=1;
                    $where['ptype']=0;
                }else if($type=='3'){//收入
                    $where['ptype']=1;
                }else if($type=='4'){//支出
                    $where['type']=2;
                    $where['ptype']=2;
                }
                $count=M('payrecord')->where($where)->count();
                $data=$this->havePage('payrecord',$where,'time desc',$page,'20','');
                $pie['now_page']=$data['now_page'];
                $pie['total_page']=$data['total_page'];
                unset($data['now_page']);
                unset($data['total_page']);
                foreach($data as $k=>$v){
                    $date[$k]['title']=(string)$v['source'];
                    $date[$k]['time']=(string)date('Y年m月d日 H:i:s',$v['time']);
                    if($type=='0'||$type=='2'||$type=='3'){
                        $date[$k]['money']=(string)$v['income'];
                    }else{
                        $date[$k]['money']=(string)$v['pay'];
                    }
                    $date[$k]['type']=(string)$v['type'];   //收入还是支出类型   1：收入  2：支出
                    $date[$k]['status']='';
                }
                if(empty($date)){
                    $rel['data']=array();
                }else{
                    $rel['data']=$date;
                }
                $rel['now_page']=$pie['now_page'];
                $rel['total_page']=$pie['total_page'];
                $rel['count']=$count;
                $this->templateApi($rel,'200','ok');
            }else{
                $this->templateApi('','300','未登录');
            }
        }else{
            $this->templateApi('','203','请求类型错误');
        }
    }
}