<?php
/******************************
 *
 * 时间；2017年11月21日
 * 功能：我的账户
 * 作者：Mr Peng
 *
 *****************************/ 
namespace Api\Controller;
use Think\Controller;
header('Content-Type:text/json;charset=utf-8');
header("Access-Control-Allow-Origin: *");
class AccountController extends CommonController {

    //账户余额
	public function index(){
        if(IS_POST){
            $token=I('post.token');     //获取用户token
            if($token==''){
                $this->templateApi('','204','参数错误');
            }else{
                $user=M('user');  
                // 查询用户表，查看该用户是否存在      
                $userrel=$user->where(array('token'=>$token))->find();
                if($userrel){
                    if($userrel['vip_endtime']<time()){
                        $dovip['is_vip']=0;
                        M('user')->where(array('user_id'=>$userrel['user_id']))->save($dovip);
                    }
                    //查询用户附属表，查询用户账户余额
                    $userdata=M('userdata');
                    $rel=$userdata->where('uid='.$userrel['user_id'])->find();
                    $data['money']=$rel['money'];
                    //查询课堂表，如果该用户为老师，查询该用户的累计收益
                    if($rel['paypass']==''){
                        $data['payPasswordStatus']='0';
                    }else{
                        $data['payPasswordStatus']='1';
                    }
                    $this->templateApi($data,'200','ok');
                }else{
                    $this->templateApi('','300','未登录');
                }
            }
        }else{
            $this->templateApi('','203','请求类型错误');
        }
	}

	//交易记录
    public function transactions(){
        if(IS_POST){
            $page=I('post.page');   //获取页数
            $token=I('token');      //获取用户token
            if($token==''||$page==''){
                $this->templateApi('','204','参数错误');
            }else{
                //查询该用户是否存在
                $userrel=M('user')->where(array('token'=>$token))->find();
                if($userrel){
                    if($userrel['vip_endtime']<time()){
                        $dovip['is_vip']=0;
                        M('user')->where(array('user_id'=>$userrel['user_id']))->save($dovip);
                    }
                    $config = array(
                        'tablename' => 'payrecord', // 表名
                        'where'     => 'uid='.$userrel['user_id'], // 查询条件
                        'relation'  => '',          // 关联条件
                        'order'     => 'time desc',          // 排序
                        'page'      => $page,       // 页码，默认为首页
                        'num'       => 20 ,        // 每页条数
                        'field'     =>'payrecord_id,type,time,income,pay,source'
                    );
                    $ppp = new \Org\Util\Page($config);
                    $data = $ppp->get();
                    $pie['now_page']=$data['now_page'];
                    $pie['total_page']=$data['total_page'];
                    unset($data['now_page']);
                    unset($data['total_page']);
                    foreach ($data as $k=>$v){
                        if($v['type']=='1'){
                            $data[$k]['money']=$v['income'];
                        }else{
                            $data[$k]['money']=$v['pay'];
                        }
                        unset($data[$k]['income']);
                        unset($data[$k]['pay']);
                        $data[$k]['time']=date('Y-m-d H:i',$v['time']);
                    }
                    if(empty($data)){
                        $date['record']=(object)null;
                    }else{
                        $date['record']=$data;
                    }
                    $date['now_page']=$pie['now_page'];
                    $date['total_page']=$pie['total_page'];
                    $this->templateApi($date,'200','ok');
                }else{
                    $this->templateApi('','300','未登录');
                }
            }
        }else{
            $this->templateApi('','203','请求类型错误');
        }
    }

    //删除交易记录
    public function delrecord(){
        if(IS_POST){
            $id=I('post.payrecord_id');     //获取交易记录的ID
            if($id==''){
                $this->templateApi('','204','参数错误');
            }else{
                //操作交易记录表，删除该条交易记录
                $pay=M('payrecord');
                $rel=$pay->where(array('payrecord_id'=>$id))->delete();
                if($rel){
                    //成功
                    $this->templateApi('','200','ok');
                }else{
                    //失败
                    $this->templateApi('','202','失败');
                }
            }
        }else{
            $this->templateApi('','203','请求类型错误');
        }
    }

}