<?php
/******************************
 *
 * 时间：2017年12月15日
 * 功能：查看老师详情和举报老师
 * 作者：Mr Peng
 *
 *****************************/ 
namespace Api\Controller;
use Think\Controller;
header('Content-Type:text/json;charset=utf-8');
header("Access-Control-Allow-Origin: *");
class TeacherController extends CommonController {



    //老师主页
	public function index(){
		if(IS_POST){
            $token=I('post.token');
            $cid=I('post.cid');
            if($token==''||$cid==''){
                $this->templateApi('','204','参数错误');exit;
            }
            $user=M('user')->where(array('token'=>$token))->find();
            $class=M('class')->where(array('class_id'=>$cid))->find();
            if($user['user_id']==$class['uid']){
                $data['isme']='1';
            }else{
                $data['isme']='0';
            }
            $data['cid']=(string)$class['class_id'];
            $data['teachername']=$class['teachername'];
            $data['teacherimg']=URL.$class['teacherimg'];
            $data['teacheraddress']=$class['address'];
            $data['teacherintroduce']=$class['teacherintroduce'];
            $arr=explode(",",$class['honorimg']);
            foreach($arr as $k=>$v){
                $newarr[$k]=URL.$v;
            }
            if(empty($newarr)){
                $data['honorimg']=array();
            }else{
                $data['honorimg']=$newarr;
            }
            $data['grade']=(string)$class['grade'];
            if(empty($class['o_id'])){
                $data['isOrganization']='0';
            }else{
                $data['isOrganization']='1';
            }
            $data['link']=$class['link'];
            $this->templateApi($data,'200','ok');
		}else{
			$this->templateApi('','203','请求类型错误');
		}
	}

	//老师资料编辑
    public function teacheredit(){
	    if(IS_POST){
            $token=I('post.token');     //token
            $type=I('post.type');       //编辑内容
            $cid=I('post.cid');         //店铺id
            $img=I('post.img');         //头像
            $name=I('post.name');       //昵称
            $introduce=I('post.introduce');     //简介
            $address=I('post.address');         //地址
            $honorimg=I('post.honorimg');       //荣誉照片
            if($token==''||$type==''||$cid==''){
                $this->templateApi('','204','参数错误');exit;
            }
            $user=M('user')->where(array('token'=>$token))->find();
            $class=M('class')->where(array('class_id'=>$cid))->find();
            if($user['user_id']!=$class['uid']){
                $this->templateApi('','202','禁止修改');exit;
            }
            if($type=='0'){
                $mvp['teacherimg']=$img;
            }else if($type=='1'){
                $mvp['teachername']=$name;
            }else if($type=='2'){
                $mvp['teacherintroduce']=$introduce;
            }else if($type=='3'){
                $mvp['address']=$address;
            }else if($type=='4'){
                $mvp['honorimg']=$honorimg;
            }else{
                $this->templateApi('','204','参数错误');
            }
            M('class')->where(array('class_id'=>$cid))->save($mvp);
            $this->templateApi('','200','ok');
        }else{
	        $this->templateApi('','203','请求类型错误');
        }
    }

    //举报
	public function report(){
		if(IS_POST){
			$token=I('post.token');
			$cate=I('post.cate');
			$text=I('text');
			$contact=I('contact');
			$img=I('img');
			$order_id=I('post.order_id');
			if($token==''||$cate==''||$text==''||$order_id==''||$img==''){
				$this->templateApi('','204','参数错误');exit;
			}else{
				$user=M('user');
				$userrel=$user->where(array('token'=>$token))->find();
				if($userrel){
					$order=M('order')->where(array('order_id'=>$order_id))->find();
					if($order){
						$pid=$order['pid'];
					}else{
						$this->templateApi('','202','订单不存在');exit;
					}
					$report=M('report');
					$where=array(
						'uid'	=>$userrel['user_id'],
						'cate'	=>$cate,
						'order_id'	=>$pid
					);
					$reportrel=$report->where($where)->find();
					if($reportrel){
						$data=(object)null;
						echo json_encode($this->apiTemplate($data,'202','同一类别禁止多次举报'));
					}else{
						$mvp = array(
							'uid' 		=> $userrel['user_id'],
							'cate'		=> $cate,
							'text'		=> $text,
							'img'		=> $img,
							'contact'	=> $contact,
							'order_id'	=> $pid,
							'time'		=> time(),
						);
						$a=$report->add($mvp);
						$data=(object)null;
						echo json_encode($this->apiTemplate($data,'200','ok'));
					}
				}else{
					$data=(object)null;
					echo json_encode($this->apiTemplate($data,'300','未登录'));
				}
			}
		}else{
			$data=(object)null;
			echo json_encode($this->apiTemplate($data,'203','请求类型错误'));
		}
	}	

}