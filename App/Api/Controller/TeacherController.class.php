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

    public function teacherreport(){
        if(IS_POST){
            $token=I('post.token');
            $cate=I('post.cate');
            $text=I('post.text');
            $contact=I('post.contact');
            $img=I('post.img');
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

    //举报
	public function report(){
		if(IS_POST){
			$token=I('post.token');
			$cate=I('post.cate');
			$text=I('post.text');
			$contact=I('post.contact');
			$img=I('post.img');
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
						$this->templateApi('','202','同一类别禁止多次举报');
					}else{
						$mvp = array(
							'uid' 		=> $userrel['user_id'],
							'cate'		=> $cate,
							'text'		=> $text,
							'img'		=> $img,
							'contact'	=> $contact,
							'order_id'	=> $pid,
							'time'		=> time(),
                            'order_id'    =>  $order['order_id']
						);
						$a=$report->add($mvp);
						$this->templateApi('','200','ok');
					}
				}else{
					$this->templateApi('','300','未登录');
				}
			}
		}else{
			$this->templateApi('','203','请求类型错误');
		}
	}

	//查看老师上传的课程——视频
    public function teacher_video(){
	    if(IS_POST){
            $teacherid=I('post.teacherid');
            $pageNum=I('post.page');
            if($teacherid==''){
                $this->templateApi('','204','参数错误');exit;
            }
            $class=M('class')->where(array('class_id'=>$teacherid))->find();
            $where['teacher_id']=$teacherid;
            $where['type']=array('IN','2,3');
            $where['status']=0;
            $where['del_status']=0;
            $count=M('goods')->where($where)->count();
            $data=$this->havePage('goods',$where,'time desc',$pageNum,'20','');
            $pie['now_page']=$data['now_page'];
            $pie['total_page']=$data['total_page'];
            unset($data['now_page']);
            unset($data['total_page']);
            foreach($data as $k=>$v){
                $date[$k]=array(
                    'pid'       =>  $v['goods_id'],
                    'name'      =>  $v['name'],
                    'teachername'   =>  $this->emptyString($class['teachername']),
                    'number'    =>  $v['number'],
                    'classhour' =>  $v['classhour'],
                    'pTpye'     =>  $v['type'],
                    'pBuyType'  =>  $v['price_status'],
                    'img'       =>  URL.$v['img'],
                    'fileid'    =>  $this->emptyString($v['video_file_id']),
                    'recommend' =>  $v['recommend'],
                    'oldprice'  =>  $v['money'],
                );
                if($v['price_status']==0){
                    $date[$k]['price']=$v['money'];
                }else{
                    $date[$k]['price']=$v['discount_money'];
                }

            }
            $rel['data']=$this->emptyarray($date);
            $rel['now_page']=$pie['now_page'];
            $rel['total_page']=$pie['total_page'];
            $rel['count']=$count;
            $this->templateApi($rel,'200','ok');
        }else{
	        $this->templateApi('','203','请求类型错误');
        }
    }

    //查看老师上传的课程——直播
    public function teacher_liveb(){
        if(IS_POST){
            $teacherid=I('post.teacherid');
            $pageNum=I('post.page');
            if($teacherid==''){
                $this->templateApi('','204','参数错误');exit;
            }
            $class=M('class')->where(array('class_id'=>$teacherid))->find();
            $where['teacher_id']=$teacherid;
            $where['type']=array('IN','1,6');
            $where['status']=0;
            $where['del_status']=0;
            $count=M('goods')->where($where)->count();
            $data=$this->havePage('goods',$where,'time desc',$pageNum,'20','');
            $pie['now_page']=$data['now_page'];
            $pie['total_page']=$data['total_page'];
            unset($data['now_page']);
            unset($data['total_page']);
            foreach($data as $k=>$v){
                $date[$k]=array(
                    'pid'       =>  $v['goods_id'],
                    'name'      =>  $v['name'],
                    'teachername'   =>  $this->emptyString($class['teachername']),
                    'teacherimg'    =>  URL.$this->emptyString($class['teacherimg']),
                    'number'    =>  $v['number'],
                    'pTpye'     =>  $v['type'],
                    'pBuyType'  =>  $v['price_status'],
                    'img'       =>  URL.$v['img'],
                    'oldprice'  =>  $v['money'],
                    'starttime' =>  date('Y.m.d H:i',$v['starttime']),
                    'liveblen'  =>  round(($v['endtime']-$v['starttime'])/60),
                    'status'    =>  $v['status'],
                );
                if($v['price_status']==0){
                    $date[$k]['price']=$v['money'];
                }else{
                    $date[$k]['price']=$v['discount_money'];
                }

            }
            $rel['data']=$this->emptyarray($date);
            $rel['now_page']=$pie['now_page'];
            $rel['total_page']=$pie['total_page'];
            $rel['count']=$count;
            $this->templateApi($rel,'200','ok');
        }else{
            $this->templateApi('','203','请求类型错误');
        }
    }

    //查看老师上传的课程——预约课
    public function teacher_yue(){
        if(IS_POST){
            $teacherid=I('post.teacherid');
            $pageNum=I('post.page');
            if($teacherid==''){
                $this->templateApi('','204','参数错误');exit;
            }
            $class=M('class')->where(array('class_id'=>$teacherid))->find();
            $where['teacher_id']=$teacherid;
            $where['type']=5;
            $where['status']=0;
            $where['del_status']=0;
            $count=M('goods')->where($where)->count();
            $data=$this->havePage('goods',$where,'time desc',$pageNum,'20','');
            $pie['now_page']=$data['now_page'];
            $pie['total_page']=$data['total_page'];
            unset($data['now_page']);
            unset($data['total_page']);
            foreach($data as $k=>$v){
                $date[$k]['pId']=(string)$v['goods_id'];
                $date[$k]['teacherName']= $this->emptyString($class['teachername']);
                $date[$k]['teacherImgURL']=URL.$this->emptyString($class['teacherimg']);
                $ca=M('category');
                $cate=$ca->where(array('cate_id'=>$v['cate_id']))->find();
                $cate1=$ca->where(array('cate_id'=>$cate['pid']))->find();
                $cate2=$ca->where(array('cate_id'=>$cate1['pid']))->find();
                $date[$k]['className']=(string)$cate2['name'].'|'.$cate1['name'].'|'.$cate['name'];
                $date[$k]['startTime']=(string)date('Y年m月d日 H:i:s',$v['starttime']);
                $date[$k]['endTime']=(string)date('H:i:s',$v['endtime']);
                $date[$k]['oldprice']=(string)$v['money'];
                if($v['reg_status']==1){
                    $date[$k]['isSaled']='1';
                }else{
                    $date[$k]['isSaled']='0';
                }

            }
            $rel['data']=$this->emptyarray($date);
            $rel['now_page']=$pie['now_page'];
            $rel['total_page']=$pie['total_page'];
            $rel['count']=$count;
            $this->templateApi($rel,'200','ok');
        }else{
            $this->templateApi('','203','请求类型错误');
        }
    }

    //查看老师投标的——定制课
    public function teacher_demand(){
        if(IS_POST){
            $teacherid=I('post.teacherid');
            $pageNum=I('post.page');
            if($teacherid==''){
                $this->templateApi('','204','参数错误');exit;
            }
            $class=M('class')->where(array('class_id'=>$teacherid))->find();
            $where['class_id']=$teacherid;
            $count=M('demand')->where($where)->count();
            $data=$this->havePage('demand',$where,'time desc',$pageNum,'20','');
            $pie['now_page']=$data['now_page'];
            $pie['total_page']=$data['total_page'];
            unset($data['now_page']);
            unset($data['total_page']);
            foreach($data as $k=>$v){
                $date[$k]['demandid']=$v['demand_id'];
                $cate=M('category')->where(array('cate_id'=>$v['cate_id']))->find();
                $date[$k]['catename']=$cate['name'];
                $date[$k]['time']=date('Y.m.d H:i',$v['starttime']).'-'.date('H:i',$v['endtime']);
                $user=M('user')->where(array('user_id'=>$v['uid']))->find();
                $userdata=M('userdata')->where(array('uid'=>$v['uid']))->find();
                $date[$k]['name']=$user['name'];
                $date[$k]['img']=URL.$userdata['image'];
                $date[$k]['isvip']=$user['is_vip'];
                $bid=M('bid')->where(array('class_id'=>$teacherid,'demand_id'=>$v['demand_id'],'bit_status'=>1))->find();
                $date[$k]['price']=$bid['price'];

            }
            $rel['data']=$this->emptyarray($date);
            $rel['now_page']=$pie['now_page'];
            $rel['total_page']=$pie['total_page'];
            $rel['count']=$count;
            $this->templateApi($rel,'200','ok');
        }else{
            $this->templateApi('','203','请求类型错误');
        }
    }
}