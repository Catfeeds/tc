<?php
/******************************
 *
 * 时间；2017年11月28日
 * 功能：课堂
 * 作者：Mr Peng
 *
 *****************************/ 
namespace Api\Controller;
use Think\Controller;
header('Content-Type:text/json;charset=utf-8');
header("Access-Control-Allow-Origin: *");
class ClassController extends CommonController {

// +----------------------------------------------------------------------
// | 功能       | 课程首页
// +----------------------------------------------------------------------
// | 请求类型   |
// +----------------------------------------------------------------------
// | 参数       |
// +----------------------------------------------------------------------
    public function index(){
        //实例课程广告表，查询4条
        $cad=M('cad');
        $cadrel=$cad->field('img,play_id,type')->order('time desc')->limit(4)->select();
        foreach($cadrel as $k=>$v){
            $cadrel[$k]['img']=URL.$v['img'];
        }
        //这4条广告添加到轮播图接口返回
        $data['lunbo']=$cadrel;
        //学生的图标及名字
        $data['student']['name']='我是学生';
        $data['student']['img']=URL.'/Uploads/class/student.png';
        // 老师的图标及名字
        $data['teacher']['name']='我是老师';
        $data['teacher']['img']=URL.'/Uploads/class/teacher.png';
        // 查询购买次数最多的20条视频
        $video=M('video');
        $videorel=$video->field('video_id,img,name,money,time')->order('number desc')->limit(20)->select();
        foreach($videorel as $k=>$v){
            $videorel[$k]['play_id']=$v['video_id'];
            $videorel[$k]['type']='1';
            unset($videorel[$k]['video_id']);
            $videorel[$k]['time']=date('Y-m-d H:i',$v['time']);
        }
        $data['video']=$videorel;
        echo json_encode($this->apiTemplate($data,'200','ok'));
    }
// +----------------------------------------------------------------------
// | 功能       | 统计今天有没有直播课程
// +----------------------------------------------------------------------
// | 请求类型   | POST
// +----------------------------------------------------------------------
// | 参数       | token
// +----------------------------------------------------------------------
    public function student_count(){
        if(IS_POST){
            $token=I('post.token');
            if($token==''){
                $data=(object)null;
                echo json_encode($this->apiTemplate($data,'204','参数错误'));
            }else{
                $user=M('user');
                $userrel=$user->where(array('token'=>$token))->find();
                if($userrel){
                    $start_time = strtotime(date('Y-m-d'));     //今日0点时间戳
                    $nowtime=time();                            //当前时间戳
                    $time=$start_time+86400;                    //今日24点时间戳
                    $liveb=M('liveb');                                  
                    $where['uid']=$userrel['user_id'];
                    // $where['endtime']=array('gt',$nowtime);     //结束时间大于当前时间的
                    $where['endtime']=array('between',array($nowtime,$time));  //开始时间大于当前时间 ，小于今日24点时间的
                    $rel=$liveb->where($where)->count();        //统计条数（今日有几节直播课程）
                    echo json_encode($this->apiTemplate($rel,'200','ok'));
                }else{
                    $data=(object)null;
                    echo json_encode($this->apiTemplate($data,'202','token过期'));
                }
            }
        }else{
            $data=(object)null;
            echo json_encode($this->apiTemplate($data,'203','请求类型错误'));
        }
    }
// +----------------------------------------------------------------------
// | 功能       | 我是学生直播课表未学习
// +----------------------------------------------------------------------
// | 请求类型   | POST
// +----------------------------------------------------------------------
// | 参数       | token,page
// +----------------------------------------------------------------------    
	public function student_liveb(){
        if(IS_POST){
            $token=I('post.token');
            $page=I('post.page');
            if($token==''||$page==''){
                $data=(object)null;
                echo json_encode($this->apiTemplate($data,'204','参数错误'));
            }else{
                $user=M('user');
                $userrel=$user->where(array('token'=>$token))->find();
                if($userrel){
                    $where['uid']=$userrel['user_id'];
                    $where['endtime']=array('gt',time());
                    $config = array(
                        'tablename' => 'liveb',     // 表名
                        'where'     => $where,      // 查询条件
                        'relation'  => '',          // 关联条件
                        'order'     => 'time asc',  // 排序
                        'page'      => $page,       // 页码，默认为首页
                        'num'       => 20,           // 每页条数
                        'field'     => 'liveb_id,name,class_id,time,img,endtime'
                    );
                    $ppp = new \Org\Util\Page($config);
                    $data = $ppp->get();
                    $pie['now_page']=$data['now_page'];
                    $pie['total_page']=$data['total_page'];
                    unset($data['now_page']);
                    unset($data['total_page']); 
                   
                    foreach($data as $k=>$v){
                        $data[$k]['play_id']=$v['liveb_id'];
                        $data[$k]['type']='0';
                        $data[$k]['img']=URL.$v['img'];
                        $data[$k]['time']=date('Y-m-d H:i',$v['time']);
                        $data[$k]['endtime']=date('Y-m-d H:i',$v['endtime']);
                        unset($data[$k]['liveb_id']);
                        $class=M('class');
                        $classrel=$class->where('class_id='.$v['class_id'])->find();
                        $foruser=$user->where('user_id='.$classrel['uid'])->find();
                        $data[$k]['t_name']=$foruser['name'];
                        unset($data[$k]['class_id']);
                    }
                    if(empty($data)){
                        $acc['liveb']=(object)null;
                    }else{
                        $acc['liveb']=$data;
                    }
                    $acc['now_page']=$pie['now_page'];
                    $acc['total_page']=$pie['total_page'];
                    echo json_encode($this->apiTemplate($acc,'200','ok'));
                }else{
                    $data=(object)null;
                    echo json_encode($this->apiTemplate($data,'202','token过期'));
                }
            }
        }else{
            $data=(object)null;
            echo json_encode($this->apiTemplate($data,'203','请求类型错误'));
        }
	}
// +----------------------------------------------------------------------
// | 功能       | 我是学生直播课表已学习
// +----------------------------------------------------------------------
// | 请求类型   | POST
// +----------------------------------------------------------------------
// | 参数       | token,page
// +---------------------------------------------------------------------- 
    public function student_liveb_study(){
        if(IS_POST){
            $token=I('post.token');
            $page=I('post.page');
            if($token==''||$page==''){
                $data=(object)null;
                echo json_encode($this->apiTemplate($data,'204','参数错误'));
            }else{
                $user=M('user');
                $userrel=$user->where(array('token'=>$token))->find();
                if($userrel){
                    $where['uid']=$userrel['user_id'];
                    $where['endtime']=array('lt',time());
                    $config = array(
                        'tablename' => 'liveb',     // 表名
                        'where'     => $where,      // 查询条件
                        'relation'  => '',          // 关联条件
                        'order'     => 'time asc',  // 排序
                        'page'      => $page,       // 页码，默认为首页
                        'num'       => 20,           // 每页条数
                        'field'     => 'liveb_id,name,class_id,time,img,endtime'
                    );
                    $ppp = new \Org\Util\Page($config);
                    $data = $ppp->get();
                    $pie['now_page']=$data['now_page'];
                    $pie['total_page']=$data['total_page'];
                    unset($data['now_page']);
                    unset($data['total_page']); 
                   
                    foreach($data as $k=>$v){
                        $data[$k]['play_id']=$v['liveb_id'];
                        $data[$k]['type']='0';
                        $data[$k]['img']=URL.$v['img'];
                        $data[$k]['time']=date('Y-m-d H:i',$v['time']);
                        $data[$k]['endtime']=date('Y-m-d H:i',$v['endtime']);
                        unset($data[$k]['liveb_id']);
                        $class=M('class');
                        $classrel=$class->where('class_id='.$v['class_id'])->find();
                        $foruser=$user->where('user_id='.$classrel['uid'])->find();
                        $data[$k]['t_name']=$foruser['name'];
                        unset($data[$k]['class_id']);
                        $comment_liveb=M('comment_liveb');
                        $comment_livebrel=$comment_liveb->where(array('uid'=>$userrel['user_id'],'liveb_id'=>$v['liveb_id']))->find();
                        if($comment_livebrel){
                            $data[$k]['comment_status']='1';
                        }else{
                            $data[$k]['comment_status']='0';
                        }
                    }
                    if(empty($data)){
                        $acc['liveb']=(object)null;
                    }else{
                        $acc['liveb']=$data;
                    }
                    $acc['now_page']=$pie['now_page'];
                    $acc['total_page']=$pie['total_page'];
                    echo json_encode($this->apiTemplate($acc,'200','ok'));
                }else{
                    $data=(object)null;
                    echo json_encode($this->apiTemplate($data,'202','token过期'));
                }
            }
        }else{
            $data=(object)null;
            echo json_encode($this->apiTemplate($data,'203','请求类型错误'));
        }       
    }

// +----------------------------------------------------------------------
// | 功能       | 添加评论——直播
// +----------------------------------------------------------------------
// | 请求类型   | post
// +----------------------------------------------------------------------
// | 参数       | play_id、type、token、star
// +----------------------------------------------------------------------
    public function addcomment_liveb(){
        $data=(object)null;
        if(IS_POST){
            $play_id=I('post.play_id');
            $type=I('post.type');
            $token=I('post.token');
            $star=I('post.star');
            if($play_id==''||$type!='0'||$token==''||$star==''){
                echo json_encode($this->apiTemplate($data,'204','参数错误'));exit;
            }
            $user=M('user');
            $comment_liveb=M('comment_liveb');
            $liveb=M('liveb');
            $userrel=$user->where(array('token'=>$token))->find();
            if($userrel){
                $commentrel=$comment_liveb->where(array('uid'=>$userrel['user_id'],'liveb_id'=>$play_id))->find();
                if($commentrel){
                    echo json_encode($this->apiTemplate($data,'202','您已经评论过了'));
                }else{
                    $livebrel=$liveb->where('liveb_id='.$play_id)->find();
                    if(!$livebrel){echo json_encode($this->apiTemplate($data,'204','参数错误'));exit;}
                    if($livebrel['uid']==$userrel['user_id']){
                        $class=M('class');
                        $classrel=$class->where('class_id='.$livebrel['class_id'])->find();
                        $mvp['tid']=$classrel['uid'];
                        $mvp['uid']=$userrel['user_id'];
                        $mvp['star']=$star;
                        $mvp['liveb_id']=$play_id;
                        $mvp['time']=time();
                        $result=$comment_liveb->add($mvp);
                        if($result){
                            echo json_encode($this->apiTemplate($data,'200','ok'));
                        }else{
                            echo json_encode($this->apiTemplate($data,'202','err'));
                        }
                    }else{
                        echo json_encode($this->apiTemplate($data,'202','您还没有购买'));
                    }
                }
            }else{
                echo json_encode($this->apiTemplate($data,'202','token过期'));
            }
        }else{
            echo json_encode($this->apiTemplate($data,'203','请求类型错误'));
        }
    }
// +----------------------------------------------------------------------
// | 功能       | 我是学生回放课表
// +----------------------------------------------------------------------
// | 请求类型   | POST
// +----------------------------------------------------------------------
// | 参数       | token,page
// +----------------------------------------------------------------------
    public function student_video(){
        if(IS_POST){
            $token=I('post.token');
            $page=I('post.page');
            if($token==''||$page==''){
                $data=(object)null;
                echo json_encode($this->apiTemplate($data,'204','参数错误'));
            }else{
                $user=M('user');
                $userrel=$user->where(array('token'=>$token))->find();
                if($userrel){
                    $where['uid']=$userrel['user_id'];
                    $config = array(
                        'tablename' => 'payvideo',     // 表名
                        'where'     => $where,      // 查询条件
                        'relation'  => '',          // 关联条件
                        'order'     => 'time asc',  // 排序
                        'page'      => $page,       // 页码，默认为首页
                        'num'       => 20,           // 每页条数
                        'field'     => 'video_id,time,status'          
                    );
                    $ppp = new \Org\Util\Page($config);
                    $data = $ppp->get();
                    $pie['now_page']=$data['now_page'];
                    $pie['total_page']=$data['total_page'];
                    unset($data['now_page']);
                    unset($data['total_page']); 
                    foreach($data as $k=>$v){
                        $video=M('video');
                        $videorel=$video->where('video_id='.$v['video_id'])->find();
                        $data[$k]['img']=URL.$videorel['img'];
                        $data[$k]['name']=$videorel['name'];
                        $data[$k]['time']=date('Y-m-d H:i',$v['time']);
                        $data[$k]['play_id']=$v['video_id'];
                        $data[$k]['type']='1';
                        unset($data[$k]['video_id']);
                        $class=M('class');
                        $classrel=$class->where('class_id='.$videorel['class_id'])->find();
                        $foruser=$user->where('user_id='.$classrel['uid'])->find();
                        $data[$k]['t_name']=$foruser['name'];
                    }
                    if(empty($data)){
                        $acc['video']=array();
                    }else{
                        $acc['video']=$data;
                    }
                    $acc['now_page']=$pie['now_page'];
                    $acc['total_page']=$pie['total_page'];
                    echo json_encode($this->apiTemplate($acc,'200','ok'));
                }else{
                    $data=(object)null;
                    echo json_encode($this->apiTemplate($data,'202','token过期'));
                }
            }
        }else{
            $data=(object)null;
            echo json_encode($this->apiTemplate($data,'203','请求类型错误'));
        }
    }

// +----------------------------------------------------------------------
// | 功能       | 老师今日课程安排统计
// +----------------------------------------------------------------------
// | 请求类型   | POST
// +----------------------------------------------------------------------
// | 参数       | token
// +----------------------------------------------------------------------
    public function teacher_count(){
        if(IS_POST){
            $token=I('post.token');
            if($token==''){
                $data=(object)null;
                echo json_encode($this->apiTemplate($data,'204','参数错误'));
            }else{
                $user=M('user');
                $userrel=$user->where(array('token'=>$token))->find();
                if($userrel){
                    $prove=M('prove');
                    $proverel=$prove->where(array('uid'=>$userrel['user_id'],'status'=>'1'))->find();
                    if($proverel){
                        $class=M('class');
                        $classrel=$class->where(array('uid'=>$userrel['user_id']))->find();
                        if($classrel){
                            $start_time = strtotime(date('Y-m-d'));     //今日0点时间戳
                            $nowtime=time();                            //当前时间戳
                            $time=$start_time+86400;                    //今日24点时间戳
                            $liveb=M('goods');
                            $where['class_id']=$classrel['class_id'];
                            $where['type']=array('IN','1,6');
                            $where['del_status']=0;
                            // $where['endtime']=array('gt',$nowtime);     //结束时间大于当前时间的
                            $where['endtime']=array('between',array($nowtime,$time));  //开始时间大于当前时间 ，小于今日24点时间的
                            $rel=$liveb->where($where)->count();        //统计条数（今日有几节直播课程）
                            echo json_encode($this->apiTemplate($rel,'200','ok'));
                        }else{
                            $data=(object)null;
                            echo json_encode($this->apiTemplate($data,'202','您还没有课堂'));
                        }
                        
                    }else{
                        $data=(object)null;
                        echo json_encode($this->apiTemplate($data,'202','还没有实名认证'));
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

// +----------------------------------------------------------------------
// | 功能       | 老师直播课表
// +----------------------------------------------------------------------
// | 请求类型   | POST
// +----------------------------------------------------------------------
// | 参数       | token,page
// +----------------------------------------------------------------------
    public function teacher_liveb(){
        if(IS_POST){
            $token=I('post.token');
            $page=I('post.page');
            if($token==''|| $page==''){
                $data=(object)null;
                echo json_encode($this->apiTemplate($data,'204','参数错误'));
            }else{
                $user=M('user');
                $userrel=$user->where(array('token'=>$token))->find();
                if($userrel){
                    $class=M('class');
                    $classrel=$class->where(array('uid'=>$userrel['user_id']))->find();
                    $config = array(
                        'tablename' => 'liveb',     // 表名
                        'where'     => 'class_id='.$classrel['class_id'], // 查询条件
                        'relation'  => '',          // 关联条件
                        'order'     => 'time',          // 排序
                        'page'      => $page,       // 页码，默认为首页
                        'num'       => 20 ,           // 每页条数
                        'field'     => 'liveb_id,name,img,time,reg_status,endtime,cate_id,money,status'
                    );
                    $ppp = new \Org\Util\Page($config);
                    $data = $ppp->get();
                    $pie['now_page']=$data['now_page'];
                    $pie['total_page']=$data['total_page'];
                    unset($data['now_page']);
                    unset($data['total_page']);
                    foreach($data as $k=>$v){
                        $cate=M('category');
                        $forcate=$cate->where('cate_id='.$v['cate_id'])->find();
                        $data[$k]['cate']=$forcate['name'];
                        unset($data[$k]['cate_id']);
                        $data[$k]['img']=URL.$v['img'];
                        $data[$k]['time']=date('Y-m-d H:i',$v['time']);
                        $data[$k]['endtime']=date('Y-m-d H:i',$v['endtime']);
                        $data[$k]['play_id']=$v['liveb_id'];
                        $data[$k]['type']='0';
                    }
                    if(empty($data)){
                        $date['liveb']=(object)null;
                    }else{
                        $date['liveb']=$data;
                    }
                    $date['now_page']=$pie['now_page'];
                    $date['total_page']=$pie['total_page'];
                    echo json_encode($this->apiTemplate($date,'200','ok'));
                }else{
                    $data=(object)null;
                    echo json_encode($this->apiTemplate($data,'202','token过期'));
                }
            }
        }else{
            $data=(object)null;
            echo json_encode($this->apiTemplate($data,'203','请求类型错误'));
        }
    }

// +----------------------------------------------------------------------
// | 功能       | 老师回放课表
// +----------------------------------------------------------------------
// | 请求类型   | POST
// +----------------------------------------------------------------------
// | 参数       | token,page
// +----------------------------------------------------------------------
    public function teacher_video(){
        if(IS_POST){
            $token=I('post.token');
            $page=I('post.page');
            if($token==''||$page==''){
                $data=(object)null;
                echo json_encode($this->apiTemplate($data,'204','参数错误'));
            }else{
                $user=M('user');
                $userrel=$user->where(array('token'=>$token))->find();
                if($userrel){
                    $class=M('class');
                    $classrel=$class->where(array('uid'=>$userrel['user_id']))->find();
                    if($classrel){
                        $config = array(
                            'tablename' => 'video',     // 表名
                            'where'     => 'class_id='.$classrel['class_id'], // 查询条件
                            'relation'  => '',          // 关联条件
                            'order'     => 'time',          // 排序
                            'page'      => $page,       // 页码，默认为首页
                            'num'       => 20 ,           // 每页条数，此条最好别改，改之前告诉安卓
                            'field'     => 'video_id,img,name,money,time,status,astatus'
                        );
                        $ppp = new \Org\Util\Page($config);
                        $data = $ppp->get();
                        $pie['now_page']=$data['now_page'];
                        $pie['total_page']=$data['total_page'];
                        unset($data['now_page']);
                        unset($data['total_page']);
                        foreach($data as $k=>$v){
                            $data[$k]['time']=date('Y-m-d H:i',$v['time']);
                            $data[$k]['play_id']=$v['video_id'];
                            $data[$k]['type']='1';
                        }
                        if(empty($data)){
                            $date['video']=(object)null;
                        }else{
                            $date['video']=$data;
                        }
                        $date['now_page']=$pie['now_page'];
                        $date['total_page']=$pie['total_page'];
                        echo json_encode($this->apiTemplate($date,'200','ok'));
                    }else{
                        $data=(object)null;
                        echo json_encode($this->apiTemplate($data,'202','您还没有课堂'));
                    }
                }else{
                    $data=(object)null;
                    echo json_encode($this->apiTemplate($data,'202','token过期'));
                }
            }
        }else{
            $data=(object)null;
            echo json_encode($this->apiTemplate($data,'203','请求类型错误'));
        }
    }

// +----------------------------------------------------------------------
// | 功能       | 老师收益
// +----------------------------------------------------------------------
// | 请求类型   | POST
// +----------------------------------------------------------------------
// | 参数       | token
// +----------------------------------------------------------------------
    public function teacher_Profit(){
        if(IS_POST){
            $token=I('post.token');
            if($token==''){
                $data=(object)null;
                echo json_encode($this->apiTemplate($data,'204','参数错误'));
            }else{
                $user=M('user');
                $userrel=$user->where(array('token'=>$token))->find();
                if($userrel){
                    $class=M('class');
                    $classrel=$class->where(array('uid'=>$userrel['user_id']))->find();
                    $data=$classrel['profit'];
                    echo json_encode($this->apiTemplate($data,'200','ok'));
                }else{
                    $data=(object)null;
                    echo json_encode($this->apiTemplate($data,'202','token过期'));
                }
            }
        }else{
            $data=(object)null;
            echo json_encode($this->apiTemplate($data,'203','请求类型错误'));
        }
    }
// +----------------------------------------------------------------------
// | 功能       | 老师收益明细
// +----------------------------------------------------------------------
// | 请求类型    | POST
// +----------------------------------------------------------------------
// | 参数       | token，page
// +----------------------------------------------------------------------
    public function teacher_details(){
        if(IS_POST){
            $token=I('post.token');
            $page=I('post.page');
            if($token==''||$page==''){
                $data=(object)null;
                echo json_encode($this->apiTemplate($data,'204','参数错误'));
            }else{
                $user=M('user');
                $userrel=$user->where(array('token'=>$token))->find();
                if($userrel){
                    $where['uid']=$userrel['user_id'];
                    $where['type']='1';
                    $config = array(
                        'tablename' => 'payrecord',         // 表名
                        'where'     => $where,              // 查询条件
                        'relation'  => '',                  // 关联条件
                        'order'     => 'time desc',         // 排序
                        'page'      => $page,               // 页码，默认为首页
                        'num'       => 20 ,                  // 每页条数
                        'field'     => 'income,time,source'
                    );
                    $ppp = new \Org\Util\Page($config);
                    $data = $ppp->get();
                    $pie['now_page']=$data['now_page'];
                    $pie['total_page']=$data['total_page'];
                    unset($data['now_page']);
                    unset($data['total_page']);
                    foreach($data as $k=>$v){
                        $data[$k]['time']=date('Y-m-d H:i',$v['time']);
                    }
                    if(empty($data)){
                        $date['details']=(object)null;
                    }else{
                        $date['details']=$data;
                    }
                    $date['now_page']=$pie['now_page'];
                    $date['total_page']=$pie['total_page']; 
                    echo json_encode($this->apiTemplate($date,'200','ok'));
                }else{
                    $data=(object)null;
                    echo json_encode($this->apiTemplate($data,'202','token过期'));
                }
            }
        }else{
            $data=(object)null;
            echo json_encode($this->apiTemplate($data,'203','请求类型错误'));
        }
    }

    //选课中心——视频
    public function indextwo(){
        if(IS_POST){
            $cId=I('post.cId');                 //分类id
            $isHot=I('post.isHot');             // 是否人气优先     ，0：非  1：是
            $orderPrice=I('post.orderPrice');   // 价格排序  0：低到高     1：高到低
            $pageNum=I('post.pageNum');         //页数
            $isFree=I('post.isFree');           // 是否是免费专区的课程  0:不是   1:是
            $classhour=I('post.classhour');     //课时排序
            $token=I('post.token');             //用户token
            if($cId==''||$isHot==''||$pageNum==''||$isFree==''){
                $this->templateApi('','204','参数错误');exit;
            }

            // ******************  课程  *****************
            $order='';
            $cate=M('category');
            $caterel=$cate->where(array('cate_id'=>$cId))->find();
            $onecate=$cate->where(array('pid'=>$caterel['cate_id']))->select();
            foreach($onecate as $k=>$v){
                $cId.=','.$v['cate_id'];
                $twocate=$cate->where(array('pid'=>$v['cate_id']))->select();
                foreach($twocate as $kk=>$vv){
                    $cId.=','.$vv['cate_id'];
                }
            }
            if($isFree=='1'){
                $where['cate_id']=array('IN',$cId);
                $where['money']=0;
                $where['status']=0;
                $where['type']=array('IN','2,3');
                if($classhour=='0'){
                    $order.='classhour asc,';
                }else if($classhour=='1'){
                    $order.='classhour desc,';
                }else{

                }
            }else{
                $where['cate_id']=array('IN',$cId);
                $where['type']=array('IN','2,3');
                $where['status']=0;
            }

            if($isHot=='1'){
                $order.='number desc';
                if($orderPrice=='0'){
                    $order.=',money asc';
                }else if($orderPrice=='1'){
                    $order.=',money desc';
                }else{

                }
            }else{
                if($orderPrice=='0'){
                    $order.='money asc';
                }else if($orderPrice=='1'){
                    $order.='money desc';
                }else{

                }
            }
            $where['del_status']=0;
            $data=$this->havePage('goods',$where,$order,$pageNum,'20','');
            $pie['now_page']=$data['now_page'];
            $pie['total_page']=$data['total_page'];
            unset($data['now_page']);
            unset($data['total_page']);
            foreach($data as $k=>$v){
                $goodlist[$k]['pid']=(string)$v['goods_id'];    //课程id
                $goodlist[$k]['pName']=(string)$v['name'];      //视频名称
                $goodlist[$k]['sonClassAmount']=(string)$v['classhour'];    //如果是套课，套课节数
                $goodlist[$k]['openSaleTime']=(string)date('Y年m月d日 H:i:s',$v['grounding_time']);    // 视频上架时间
                $goodlist[$k]['endSetClassTime']=(string)date('Y年m月d日 H:i:s',$v['endtime']);    //套课结束上传时间
                $goodlist[$k]['pType']=(string)$v['type'];      //视屏类型
                $goodlist[$k]['pBuyType']=(string)$v['price_status'];   //价格类型
                $goodlist[$k]['pImgURL']=(string)URL.$v['img'];     //课程图片
                $isOrganization=M('class')->where(array('class_id'=>$v['class_id']))->field('uid,type,name')->find();
                $goodlist[$k]['teacherName']=(string)$isOrganization['name'];
                $udrel=M('userdata')->where(array('uid'=>$isOrganization['uid']))->find();
                $goodlist[$k]['teacherImg']=URL.$udrel['image'];
                if($isOrganization['type']==3){
                    $goodlist[$k]['isOrganization']='1';   //是否机构上传   是
                }else{
                    $goodlist[$k]['isOrganization']='0';   //是否机构上传   否
                }
                $goodlist[$k]['isRecommend']=(string)$v['recommend'];   //是否推荐
                $goodlist[$k]['signUpNum']=(string)$v['number'];    //报名人数
                $heard=strstr($_SERVER['HTTP_USER_AGENT'],'(',true);
                if($heard=='TCCM_WYK/4.0.1 ' || $heard=='TCCM_WYK/4.0.1'){
                    $goodlist[$k]['oldPrice']='0';
                    $goodlist[$k]['currentPrice']='0';
                }else{
                    $goodlist[$k]['oldPrice']=(string)$v['money'];      //原价
                    if($v['price_status']==0){
                        $goodlist[$k]['currentPrice']=(string)$v['money']; //折扣价
                    }else{
                        $goodlist[$k]['currentPrice']=(string)$v['discount_money']; //折扣价
                    }
                }
                $goodlist[$k]['groupBuyNum']=(string)$v['group_num'];   //开团人数
                $goodlist[$k]['groupBuyEndTime']=(string)date('Y年m月d日 H:i:s',$v['group_time']); //开团时间

                if($token){
                    $user=M('user')->where(array('token'=>$token))->find();
                    if($user){
                        if($v['type']==4){
                            $tpid=$v['topic_id'];
                        }else{
                            $tpid=$v['goods_id'];
                        }
                        $payrel=M('payrecord')->where(array('uid'=>$user['user_id'],'type'=>'2','cid'=>$tpid))->find();
                        if($payrel){
                            $goodlist[$k]['isBuy']='1';
                        }else{
                            $goodlist[$k]['isBuy']='0';
                        }
                    }else{
                        $goodlist[$k]['isBuy']='0';
                    }
                }else{
                    $goodlist[$k]['isBuy']='0';
                }
            }
            if(empty($goodlist)){
                $acc['data']=array();
            }else{
                $acc['data']=$goodlist;
            }
            $acc['now_page']=$pie['now_page'];
            $acc['total_page']=$pie['total_page'];

            $this->templateApi($acc,'200','ok');
        }else{
            $this->templateApi('','203','请求类型错误');
        }
    }

    //选课中心——预约课
    public function threeyue(){
        if(IS_POST){
            $cId=I('post.cId');                 //分类id
            $orderPrice=I('post.orderPrice');   //价格排序  0：低到高     1：高到低
            $time=I('post.time');               //时间排序   0：近期优先    1：远期优先
            $pageNum=I('post.pageNum');         //页数
            $isFree=I('post.isFree');           // 是否是免费专区的课程  0:不是   1:是
            if($cId==''||$pageNum==''||$isFree==''){
                $this->templateApi('','204','参数错误');exit;
            }
            $order='';
            $cate=M('category');
            $caterel=$cate->where(array('cate_id'=>$cId))->find();
            $onecate=$cate->where(array('pid'=>$caterel['cate_id']))->select();
            foreach($onecate as $k=>$v){
                $cId.=','.$v['cate_id'];
                $twocate=$cate->where(array('pid'=>$v['cate_id']))->select();
                foreach($twocate as $kk=>$vv){
                    $cId.=','.$vv['cate_id'];
                }
            }
            if($isFree=='1'){
                $where['cate_id']=array('IN',$cId);
                $where['money']=0;
                $where['status']=0;
                $where['endtime']=array('gt',time());
                $where['type']=array('IN','5');

            }else{
                $where['cate_id']=array('IN',$cId);
                $where['type']=array('IN','5');
                $where['endtime']=array('gt',time());
                $where['status']=0;
            }

            if($orderPrice=='0'){
                $order.='money asc';
                if($time=='0'){
                    $order.=',starttime desc';
                }else if($time=='1'){
                    $order.=',starttime asc';
                }else{

                }
            }else if($orderPrice=='1'){
                $order.='money desc';
                if($time=='0'){
                    $order.=',starttime desc';
                }else if($time=='1'){
                    $order.=',starttime asc';
                }else{

                }
            }else{
                if($time=='0'){
                    $order.=',starttime desc';
                }else if($time=='1'){
                    $order.=',starttime asc';
                }else{

                }
            }
            $where['del_status']=0;
            $count=M('goods')->where($where)->count();
            $data=$this->havePage('goods',$where,$order,$pageNum,'20','');
            $pie['now_page']=$data['now_page'];
            $pie['total_page']=$data['total_page'];
            unset($data['now_page']);
            unset($data['total_page']);
            foreach($data as $k=>$v){
                $date[$k]['pid']=(string)$v['goods_id'];
                $date[$k]['pType']=(string)$v['type'];
                $date[$k]['starttime']=date('Y.m.d H:i',$v['starttime']);
                $date[$k]['endtime']=date('H:i',$v['endtime']);
                $class=M('class')->where(array('class_id'=>$v['class_id']))->find();
                $date[$k]['teacherimg']=URL.$class['img'];
                $date[$k]['teachername']=$class['name'];
                if($class['type']==3){
                    $date[$k]['isOrganization']='1';
                }else{
                    $date[$k]['isOrganization']='0';
                }
                $date[$k]['price']=(string)$v['money'];
                $date[$k]['catename']=D('Category')->getFatherCate($v['cate_id']);
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
            $this->templateApi('','203','请求类型错误');
        }
    }

    //选课中心——直播
    public function threeliveb(){
        if(IS_POST){
            $cId=I('post.cId');                 // 分类id
            $isHot=I('post.isHot');             // 是否人气优先     ，0：非  1：是
            $orderPrice=I('post.orderPrice');   // 价格排序  0：低到高     1：高到低
            $pageNum=I('post.pageNum');         // 页数
            $isFree=I('post.isFree');           // 是否是免费专区的课程  0:不是   1:是
            $livebing=I('post.livebing');       // 是否直播中   0：否  1：是
            if($cId==''||$isHot==''||$pageNum==''||$isFree==''||$livebing==''){
                $this->templateApi('','204','参数错误');exit;
            }

            $order='';
            $cate=M('category');
            $caterel=$cate->where(array('cate_id'=>$cId))->find();
            $onecate=$cate->where(array('pid'=>$caterel['cate_id']))->select();
            foreach($onecate as $k=>$v){
                $cId.=','.$v['cate_id'];
                $twocate=$cate->where(array('pid'=>$v['cate_id']))->select();
                foreach($twocate as $kk=>$vv){
                    $cId.=','.$vv['cate_id'];
                }
            }
            if($isFree=='1'){
                $where['cate_id']=array('IN',$cId);
                $where['money']=0;
                $where['status']=0;
                $where['type']=array('IN','1,6');
                $where['endtime']=array('gt',time());
                if($livebing=='0'){
                    $where['liveb_status']=0;
                }else if($livebing=='1'){
                    $where['liveb_status']=1;
                }else{

                }
            }else{
                $where['cate_id']=array('IN',$cId);
                $where['type']=array('IN','1,6');
                $where['status']=0;
                $where['endtime']=array('gt',time());
                if($livebing=='0'){
                    $where['liveb_status']=0;
                }else if($livebing=='1'){
                    $where['liveb_status']=1;
                }else{

                }
            }
            if($isHot=='1'){
                $order.='number desc';
                if($orderPrice=='0'){
                    $order.=',money asc';
                }else if($orderPrice=='1'){
                    $order.=',money desc';
                }else{

                }
            }else{
                if($orderPrice=='0'){
                    $order.='money asc';
                }else if($orderPrice=='1'){
                    $order.='money desc';
                }else{

                }
            }
            $where['del_status']=0;
            $data=$this->havePage('goods',$where,$order,$pageNum,'20','');
            $pie['now_page']=$data['now_page'];
            $pie['total_page']=$data['total_page'];
            unset($data['now_page']);
            unset($data['total_page']);
            foreach($data as $k=>$v){
                $goodlist[$k]['pid']=(string)$v['goods_id'];    //课程id
                $goodlist[$k]['pName']=(string)$v['name'];      //视频名称
                $goodlist[$k]['pType']=(string)$v['type'];      //课程类型
                $goodlist[$k]['pBuyType']=(string)$v['price_status'];   //价格类型
                $goodlist[$k]['pImgURL']=(string)URL.$v['img'];     //课程图片
                $isOrganization=M('class')->where(array('class_id'=>$v['class_id']))->field('uid,type,name')->find();
                $goodlist[$k]['teacherName']=(string)$isOrganization['name'];
                $udrel=M('userdata')->where(array('uid'=>$isOrganization['uid']))->find();
                $goodlist[$k]['teacherImg']=URL.$udrel['image'];
                if($isOrganization['type']==3){
                    $goodlist[$k]['isOrganization']='1';   //是否机构上传   是
                }else{
                    $goodlist[$k]['isOrganization']='0';   //是否机构上传   否
                }
                $goodlist[$k]['signUpNum']=(string)$v['number'];    //报名人数
                $heard=strstr($_SERVER['HTTP_USER_AGENT'],'(',true);
                if($heard=='TCCM_WYK/4.0.1 ' || $heard=='TCCM_WYK/4.0.1'){
                    $goodlist[$k]['oldPrice']='0';
                    $goodlist[$k]['currentPrice']='0';
                }else{
                    $goodlist[$k]['oldPrice']=(string)$v['money'];      //原价
                    if($v['price_status']==0){
                        $goodlist[$k]['currentPrice']=(string)$v['money']; //折扣价
                    }else{
                        $goodlist[$k]['currentPrice']=(string)$v['discount_money']; //折扣价
                    }
                }
                $goodlist[$k]['livebstatus']=(string)$v['liveb_status'];    //直播状态  0：未开播  1：正在直播
                $goodlist[$k]['starttime']=date('Y.m.d H:i',$v['starttime']);
                $goodlist[$k]['liveblen']=(string)round(($v['endtime']-$v['starttime'])/60);
                $goodlist[$k]['sign_endtime']=date('Y.m.d H:i:s',$v['sign_endtime']);

            }

            if(empty($goodlist)){
                $acc['data']=array();
            }else{
                $acc['data']=$goodlist;
            }
            $acc['now_page']=$pie['now_page'];
            $acc['total_page']=$pie['total_page'];

            $this->templateApi($acc,'200','ok');
        }else{
            $this->templateApi('','203','请求类型错误');
        }
    }

    //选课中心课程列表直播 （二期）
    public function liveb()
    {
        if (IS_POST) {
            $cId = I('post.cId');                 //分类id
            $isHot = I('post.isHot');             // 是否人气优先     ，0：非  1：是
            $orderPrice = I('post.orderPrice');   // 价格排序  0：低到高     1：高到低
            $pageNum = I('post.pageNum');         //页数
            $isFree = I('post.isFree');           // 是否是免费专区的课程  0:不是   1:是
            if ($cId == '' || $isHot == '' || $pageNum == '' || $isFree == '') {
                $this->templateApi('', '204', '参数错误');
                exit;
            }
            // ***************  分类  ******************
//            $category = M('category');
//            $catelist = $category->where(array('pid' => $cId))->select();
//            foreach ($catelist as $k => $v) {
//                $cate[$k]['cId'] = $v['cate_id'];
//                $cate[$k]['cName'] = $v['name'];
//                $soncate = $category->where(array('pid' => $v['cate_id']))->find();
//                $cate[$k]['son'] = array(
//                    'sCId' => (string)$soncate['cate_id'],
//                    'SCName' => (string)$soncate['name']
//                );
//            }
            // ******************  课程  *****************
            $cate=M('category');
            $caterel=$cate->where(array('cate_id'=>$cId))->find();
            $onecate=$cate->where(array('pid'=>$caterel['cate_id']))->select();
            foreach($onecate as $k=>$v){
                $cId.=','.$v['cate_id'];
                $twocate=$cate->where(array('pid'=>$v['cate_id']))->select();
                foreach($twocate as $kk=>$vv){
                    $cId.=','.$vv['cate_id'];
                }
            }
            if ($isFree == '1') {
                $where['cate_id']=array('IN',$cId);
                $where['type']=array('IN','1,6');
                $where['money']=0;
                $where['status']=0;
                $where['endtime']=array('gt',time());
//                $where = '(cate_id=' . $cId . ' AND type=1 AND money=0 AND status=0 AND endtime>'.time().') OR (cate_id=' . $cId . ' AND type=6 AND money=0 AND status=0 AND endtime>'.time().')';
            } else {
                $where['cate_id']=array('IN',$cId);
                $where['type']=array('IN','1,6');
                $where['status']=0;
                $where['endtime']=array('gt',time());
//                $where = '(cate_id=' . $cId . ' AND type=1 AND status=0 AND endtime>'.time().') OR (cate_id=' . $cId . ' AND type=6 AND status=0 AND endtime>'.time().')';
            }
            $order = '';
            if($isHot=='1'){
                $order.='number desc';
                if($orderPrice=='0'){
                    $order.=',money asc';
                }else if($orderPrice=='1'){
                    $order.=',money desc';
                }else{

                }
            }else{
                if($orderPrice=='0'){
                    $order.='money asc';
                }else if($orderPrice=='1'){
                    $order.='money desc';
                }else{

                }
            }
            $where['del_status']=0;
            $data = $this->havePage('goods', $where, $order, $pageNum, '20', '');
            $pie['now_page'] = $data['now_page'];
            $pie['total_page'] = $data['total_page'];
            unset($data['now_page']);
            unset($data['total_page']);
            foreach ($data as $k => $v) {
                $goodlist[$k]['pid'] = (string)$v['goods_id'];    //课程id
                $goodlist[$k]['pName'] = (string)$v['name'];      //视频名称
                $goodlist[$k]['pType'] = (string)$v['type'];      //视屏类型
                $goodlist[$k]['pBuyType'] = (string)$v['price_status'];   //价格类型
                $goodlist[$k]['pImgURL'] = (string)URL.$v['img'];     //课程图片
                $isOrganization = M('class')->where(array('class_id' => $v['class_id']))->field('uid,name,type,class_id')->find();
                $goodlist[$k]['sid']=(string)$isOrganization['class_id'];
                $goodlist[$k]['teacherName']=(string)$isOrganization['name'];
                $udrel=M('userdata')->where(array('uid'=>$isOrganization['uid']))->find();
                $goodlist[$k]['teacherImg']=(string)$udrel['image'];
                if ($isOrganization['type'] == 3) {
                    $goodlist[$k]['isOrganization'] = '1';   //是否机构上传   是
                } else {
                    $goodlist[$k]['isOrganization'] = '0';   //是否机构上传   否
                }
                $goodlist[$k]['signUpNum'] = (string)$v['number'];    //报名人数
                $heard=strstr($_SERVER['HTTP_USER_AGENT'],'(',true);
                if($heard=='TCCM_WYK/4.0.1 ' || $heard=='TCCM_WYK/4.0.1'){
                    $goodlist[$k]['oldPrice']='0';
                    $goodlist[$k]['currentPrice']='0';
                }else{
                    $goodlist[$k]['oldPrice']=(string)$v['money'];      //原价
                    if($v['price_status']==0){
                        $goodlist[$k]['currentPrice']=(string)$v['money']; //折扣价
                    }else{
                        $goodlist[$k]['currentPrice']=(string)$v['discount_money']; //折扣价
                    }
                }

                $goodlist[$k]['liveStartTime']=(string)date('Y年m月d日 H:i:s',$v['starttime']); //直播开始时间
                $goodlist[$k]['liveTime']=(string)round(($v['endtime']-$v['starttime'])/60); //直播时长
                $goodlist[$k]['endSaleTime']=(string)date('Y年m月d日 H:i:s',$v['endtime']);  // 直播结束时间
            }
            if (empty($goodlist)) {
                $acc['data'] = array();
            } else {
                $acc['data'] = $goodlist;
            }
            $acc['now_page'] = $pie['now_page'];
            $acc['total_page'] = $pie['total_page'];

            $this->templateApi($acc, '200', 'ok');
        } else {
            $this->templateApi('', '203', '请求类型错误');
        }
    }

    //课程详情
    public function details(){
        if(IS_POST){
            $pid=I('post.pId');         //课程id
            $token=I('post.token');     //用户token    可为空
            if($pid==''){
                $this->templateApi('','204','参数错误');exit;
            }
            $goods=M('goods');
            $goodlist=$goods->where(array('goods_id'=>$pid))->find();
            $class=M('class');
            $classrel=$class->where(array('class_id'=>$goodlist['class_id']))->find();
            $userdata=M('userdata');
            $userdatarel=$userdata->where(array('uid'=>$classrel['uid']))->find();
            $data=array();
            if($token){
                $user=M('user');
                $userdo=$user->where(array('token'=>$token))->find();
                if($userdo['vip_endtime']<time()){
                    $dovip['is_vip']=0;
                    M('user')->where(array('user_id'=>$userdo['user_id']))->save($dovip);
                }
                $userrel=$user->where(array('token'=>$token))->find();

                if($userrel['user_id']==$classrel['uid']){
                    $data['isme']='1';
                }else{
                    $data['isme']='0';
                }
                $data['isVIP']=(string)$userrel['is_vip'];
                $subscribe=M('subscribe');
                $subrel=$subscribe->where(array('uid'=>$userrel['user_id'],'cid'=>$pid))->find();
                if($subrel){
                    $data['isCollection']='1';
                }else{
                    $data['isCollection']='0';
                }
                if($goodlist['type']==4){
                    $tpid=$goodlist['topic_id'];
                }else{
                    $tpid=$pid;
                }
                $payrel=M('payrecord')->where(array('uid'=>$userrel['user_id'],'type'=>'2','cid'=>$tpid))->find();
                if($payrel){
                    $data['isBuy']='1';
                    $data['buyMoney']=(string)$payrel['pay'];
                }else{
                    if($goodlist['type']==4 && $goodlist['topic_num']==1){
                        $data['isBuy']='1';
                        $data['buyMoney']='';
                    }else if($goodlist['type']==4){
                        $topid=M('goods')->where(array('goods_id'=>$goodlist['topic_id']))->find();
                        $payrell=M('payrecord')->where(array('uid'=>$userrel['user_id'],'type'=>'2','cid'=>$topid))->find();
                        if($payrell){
                            $data['isBuy']='1';
                            $data['buyMoney']=$payrell['pay'];
                        }else{
                            $data['isBuy']='0';
                            $data['buyMoney']='';
                        }
                        
                    }

                }
            }else{
                if($goodlist['type']==4 && $goodlist['topic_num']==1){
                    $data['isBuy']='1';
                    $data['buyMoney']='';
                }else{
                    $data['isBuy']='0';
                    $data['buyMoney']='';
                }
                $data['isVIP']='';
                $data['isCollection']='';
            }
            $data['astatus']=(string)$goodlist['astatus'];//审核状态
            if(($goodlist['starttime']-300)<time() && $goodlist['endtime']>time() && $goodlist['reg_status']==1 && $goodlist['number']!=0){
                $data['canliveb']='1';
            }else{
                $data['canliveb']='0';
            }
            $data['class_vip']=(string)$goodlist['vip'];
            $data['cid']=(string)$classrel['class_id']; //店铺id
            $data['pid']=(string)$goodlist['goods_id'];
            $data['classhour']=(string)$goodlist['classhour'];
            $cate=M('category');
            $onecate=$cate->where(array('cate_id'=>$goodlist['cate_id']))->find();
            $twocate=$cate->where(array('cate_id'=>$onecate['pid']))->find();
            $threecate=$cate->where(array('cate_id'=>$twocate['pid']))->find();
            $data['className']=$threecate['name'].'|'.$twocate['name'].'|'.$onecate['name'];
            $data['pName']=(string)$goodlist['name'];
            $data['pType']=(string)$goodlist['type'];
            $data['pBuyType']=(string)$goodlist['price_status'];
            $data['pImgURL']=(string)URL.$goodlist['img'];
            $data['signUpNum']=(string)$goodlist['number'];
            $data['teacherName']=(string)$classrel['name'];
            $data['teacherImg']=(string)URL.$userdatarel['image'];
            $data['teacherLV']=(string)$classrel['grade'];
            $data['teacherInfo']=(string)$userdatarel['profile'];
            $data['pInfo']=(string)$goodlist['introduce'];
            $data['videoLength']=(string)$goodlist['video_length'];
            if($goodlist['grounding_time']){
                $data['groundingTime']=(string)date('Y年m月d日 H:i:s',$goodlist['grounding_time']);
            }else{
                $data['groundingTime']='';
            }
            if($goodlist['sign_endtime']){
                $data['signEndtime']=(string)date('Y年m月d日 H:i:s',$goodlist['sign_endtime']);
            }else{
                $data['signEndtime']='';
            }
            if($goodlist['endtime']){
                $data['endTime']=(string)date('Y年m月d日 H:i:s',$goodlist['endtime']);
            }else{
                $data['endTime']='';
            }
            $data['fileid']=(string)$goodlist['video_file_id'];
            if($classrel['type']==3){
                $data['isOrganization']='1';
            }else{
                $data['isOrganization']='0';
            }
            $heard=strstr($_SERVER['HTTP_USER_AGENT'],'(',true);
            if($heard=='TCCM_WYK/4.0.1 ' || $heard=='TCCM_WYK/4.0.1'){
                $data['oldPrice']='0';
                $data['currentPrice']='0';
            }else{
                $data['oldPrice']=(string)$goodlist['money'];      //原价
                if($goodlist['price_status']==0){
                    $data['currentPrice']=(string)$goodlist['money']; //折扣价
                }else{
                    $data['currentPrice']=(string)$goodlist['discount_money']; //折扣价
                }
            }

            if($goodlist['type']==1 || $goodlist['type']==6){
                $data['liveP']=array(
                    'liveStartTime' =>  (string)date('Y年m月d日 H:i:s',$goodlist['starttime']),
                    'liveTime'      =>  (string)round(($goodlist['endtime']-$goodlist['starttime'])/60),
                    'endSaleTime'   =>  (string)$goodlist['sign_endtime']
                );
            }else{
                $data['liveP']=(object)null;
            }
            if($goodlist['price_status']==2){
                $data['groupP']=array(
                    'groupPrice'    =>  (string)$goodlist['discount_money'],
                    'groupNum'      =>  (string)$goodlist['group_num'],
                    'groupTime'     =>  (string)date('Y年m月d日 H:i:s',$goodlist['group_time'])
                );
            }else{
                $data['groupP']=(object)null;
            }
            $data['shareURL']=(string)$goodlist['shareurl'];
            $this->templateApi($data,'200','ok');

        }else{
            $this->templateApi('','203','请求类型错误');
        }
    }

    //课程大纲
    public function outline(){
        if(IS_POST){
            $pid=I('post.pId');         //课程id
//            $page=I('post.pageNum');    //页数
            if($pid==''){
                $this->templateApi('','204','参数错误');
            }
            $goodsrel=M('goods')->where(array('goods_id'=>$pid))->field('type,topic_id,classhour')->find();
            if($goodsrel['type']!=3){
                $pid=$goodsrel['topic_id'];
                $classhour=M('goods')->where(array('goods_id'=>$pid))->field('classhour')->find();
            }else{
                $classhour=M('goods')->where(array('goods_id'=>$pid))->field('classhour')->find();
            }
            $where['topic_id']=$pid;
//            $data = $this->havePage('goods', $where, 'time asc', $page  , '8', 'goods_id,name,video_file_id,img,introduce,video_length,topic_num');
            $data=M('goods')->where($where)->select();
//            $pie['now_page']=$data['now_page'];
//            $pie['total_page']=$data['total_page'];
//            unset($data['now_page']);
//            unset($data['total_page']);
            foreach($data as $k=>$v){
                $rel[$k]['pId']=$v['goods_id'];
                $rel[$k]['pName']=$v['name'];
                $rel[$k]['pImgURL']=URL.$v['img'];
                $rel[$k]['pInfo']=$v['introduce'];
                $rel[$k]['videoLength']=$v['video_length'];
                $rel[$k]['topicNum']=$v['topic_num'];
                $rel[$k]['video_file_id']=$v['video_file_id'];
                $rel[$k]['xxxxx']='这有个播放视频先关的数据,深入了解直播后再定';
            }
            if(empty($rel)){
                $acc['data']=array();
            }else{
                $acc['data']=$rel;
            }
            $arr = array(
                'pid' => '',
                'pName' => '',
                'pImgURL' => '',
                'pInfo' => '',
                'videoLength' => '',
                'topicNum' => 0,
                'video_file_id' => '',
                'xxxxx' => ''
            );
            $date = array();
            foreach ($acc['data'] as $v) {
                $date[$v['topicNum']-1] = $v;
            }
            for($i=0; $i < $classhour['classhour']; $i++) {
                if (!is_array($date[$i])) {
                    $arr['topicNum'] = ($i+1);
                    $date[$i] = $arr;
                }
            }
            $newarr=array();
            for($i=0;$i<count($date);$i++){
                array_push($newarr,$date[$i]);
            }
            $acc['data']=$newarr;

            $acc['classhour']=$classhour['classhour'];
            $this->templateApi($acc,'200','ok');
        }else{
            $this->templateApi('','203','请求类型错误');
        }
    }

    //相关课程
    public function relevant(){
        if(IS_POST){
            $pid=I('post.pId');
            $page=I('post.pageNum');
            if($pid==''||$page==''){
                $this->templateApi('','204','参数错误');exit;
            }
            $goodrel=M('goods')->where(array('goods_id'=>$pid))->find();
            if($goodrel){
                $where['type']=$goodrel['type'];
                $where['status']='0';
                $where['goods_id']=array('neq',$goodrel['goods_id']);
                $count=M('goods')->where($where)->count();
                $date = $this->havePage('goods', $where, 'time desc', $page  , '20', '');
                $pie['now_page']=$date['now_page'];
                $pie['total_page']=$date['total_page'];
                unset($date['now_page']);
                unset($date['total_page']);
                foreach($date as $k=>$v){
                    $rel[$k]['pid']=(string)$v['goods_id'];
                    $rel[$k]['pName']=(string)$v['name'];
                    $rel[$k]['pType']=(string)$v['type'];
                    $rel[$k]['pImgURL']=(string)URL.$v['img'];
                    $rel[$k]['signUpNum']=(string)$v['number'];
                    $rel[$k]['openSaleTime']=date('Y-m-d H:i:s',$v['grounding_time']);
                    $rel[$k]['sonClassAmount']=(string)$v['classhour'];
                    $classrel=M('class')->where(array('class_id'=>$v['class_id']))->find();
                    $rel[$k]['teacherName']=(string)$classrel['name'];
                    $userdata=M('userdata')->where(array('uid'=>$classrel['uid']))->find();
                    $rel[$k]['teacherImg']=(string)$userdata['image'];
                    $rel[$k]['teacherLV']=(string)$classrel['grade'];
                    if($classrel['type']==3){
                        $rel[$k]['isOrganization']='1';
                    }else{
                        $rel[$k]['isOrganization']='0';
                    }
                    $heard=strstr($_SERVER['HTTP_USER_AGENT'],'(',true);
                    if($heard=='TCCM_WYK/4.0.1 ' || $heard=='TCCM_WYK/4.0.1'){
                        $rel[$k]['oldPrice']='0';
                        $rel[$k]['currentPrice']='0';
                    }else{
                        $rel[$k]['oldPrice']=(string)$v['money'];      //原价
                        if($v['price_status']==0){
                            $rel[$k]['currentPrice']=(string)$v['money']; //折扣价
                        }else{
                            $rel[$k]['currentPrice']=(string)$v['discount_money']; //折扣价
                        }
                    }
                    if($v['type']==1 || $v['type']==6){
                        $rel[$k]['liveP']=array(
                            'liveStartTime' =>  (string)date('Y年m月d日 H:i:s',$v['starttime']),
                            'liveTime'      =>  (string)round(($v['endtime']-$v['starttime'])/60),
                            'endSaleTime'   =>  (string)date('Y年m月d日 H:i:s',$v['sign_endtime'])
                        );
                    }else{
                        $rel[$k]['liveP']=array();
                    }
                    if($v['price_status']==2){
                        $rel[$k]['groupP']=array(
                            'groupPrice'    =>  (string)$v['discount_money'],
                            'groupNum'      =>  (string)$v['group_num'],
                            'groupTime'     =>  (string)date('Y年m月d日 H:i:s',$v['group_time'])
                        );
                    }else{
                        $rel[$k]['groupP']=array();
                    }
                }
                if(empty($rel)){
                    $acc['data']=array();
                }else{
                    $acc['data']=$rel;
                }
                $acc['now_page']=$pie['now_page'];
                $acc['total_page']=$pie['total_page'];
                $acc['count']=$count;
                $this->templateApi($acc,'200','ok');
            }else{
                $this->templateApi('','202','课程id错误');
            }
        }else{
            $this->templateApi('','203','请求类型错误');
        }
    }

    //评论
    public function evaluate(){
        if(IS_POST){
            $pid=I('post.pId');         //课程id
            $page=I('post.pageNum');    //页数
            $token=I('post.token');
            if($pid==''||$page==''){
                $this->templateApi('','204','参数错误');exit;
            }
            $user=M('user');
            if($token){
                $userrel=$user->where(array('token'=>$token))->find();
                if($userrel){
                    if($userrel['vip_endtime']<time()){
                        $dovip['is_vip']=0;
                        M('user')->where(array('user_id'=>$userrel['user_id']))->save($dovip);
                    }
                    $comment=M('comment');
                    $commentrel=$comment->where(array('uid'=>$userrel['user_id'],'goods_id'=>$pid))->find();
                    if(!$commentrel){
                        $good=M('goods')->where(array('goods_id'=>$pid))->find();
                        if($good['type']==4){
                            $pid=$good['topic_id'];
                        }
                        $payrecord=M('payrecord');
                        $payrel=$payrecord->where(array('uid'=>$userrel['user_id'],'cid'=>$pid))->find();
                        if($payrel){
                            if($payrel['pay']==0){
                                $rel['canComment']='0';
                            }else{
                                $rel['canComment']='1';
                            }
                        }else{
                            $rel['canComment']='0';
                        }
                    }else{
                        $rel['canComment']='0';
                    }
                }else{
                    $this->templateApi('','300','token过期');
                }

            }else{
                $rel['canComment']='0';
            }
            $pl=M('comment_goods');
            $plrel=$pl->where(array('goods_id'=>$pid))->find();
            $rel['commentNum']=$plrel['num'];
            $rel['totalStarNum']=$plrel['star'];
            $where['goods_id']=$pid;
            $count=M('comment')->where($where)->count();
            $date = $this->havePage('comment',$where,'time desc',$page,'20','');
            $pie['now_page']=$date['now_page'];
            $pie['total_page']=$date['total_page'];
            unset($date['now_page']);
            unset($date['total_page']);
            if(empty($date)){
                $rel['data']=array();
            }else{
                foreach($date as $k=>$v){
                    $usrel=$user->where(array('user_id'=>$v['uid']))->find();
                    $udrel=M('userdata')->where(array('uid'=>$v['uid']))->find();
                    $rel['data'][$k]['uImgURL']=(string)URL.$udrel['image'];   //评论人头像
                    $rel['data'][$k]['uName']=(string)$usrel['name'];     //评论人名字
                    $rel['data'][$k]['starNum']=(string)$v['star'];   //星数
                    $rel['data'][$k]['commentTime']=(string)date('Y年m月d日 H:i:s',$v['time']);   //评论时间
                    $rel['data'][$k]['comminetInfo']=(string)$v['content'];  //评论内容
                }
            }
            $rel['now_page']=$pie['now_page'];
            $rel['total_page']=$pie['total_page'];
            $rel['count']=$count;
            $this->templateApi($rel,'200','ok');

        }else{
            $this->templateApi('','203','请求类型错误');
        }
    }

    //添加评论
    public function evaluate_add(){
        if(IS_POST){
            $pid=I('post.pId');     //课程id
            $token=I('post.token'); //用户token
            $star=I('post.starNum'); //星数
            $content=I('post.commentInfo'); //内容
            if($pid==''||$token==''||$star==''||$content==''){
                $this->templateApi('','204','参数错误');exit;
            }
            $userrel=M('user')->where(array('token'=>$token))->find();
            if($userrel){
                if($userrel['vip_endtime']<time()){
                    $dovip['is_vip']=0;
                    M('user')->where(array('user_id'=>$userrel['user_id']))->save($dovip);
                }
                $goods=M('goods')->where(array('goods_id'=>$pid))->find();
                if($goods['type']==4){
                    if($goods['topic_num']==1){
                        $this->templateApi('','202','免费课程不能评论');exit;
                    }else{
                        $pid=$goods['topic_id'];
                    }
                }
                $payrecord=M('payrecord')->where(array('uid'=>$userrel['user_id'],'cid'=>$pid,'type'=>2))->find();
                if($payrecord['pay']==0){
                    $this->templateApi('','202','免费课程不能评论');exit;
                }
                $comment=M('comment');
                $commentrel=$comment->where(array('uid'=>$userrel['user_id'],'goods_id'=>$pid))->find();
                if($commentrel){
                    $this->templateApi('','202','您已经评论过了');
                }else{
                    $mvp=array(
                        'uid'       =>  $userrel['user_id'],
                        'star'      =>  $star,
                        'content'   =>  $content,
                        'goods_id'  =>  $pid,
                        'class_id'  =>  $goods['class_id'],
                        'time'      =>  time()
                    );
                    $rel=$comment->add($mvp);
                    $commentg=M('comment_goods');
                    $cogr=$commentg->where(array('goods_id'=>$pid))->find();
                    if($cogr){
                        $vmp['star']=$cogr['star']+$star;
                        $vmp['num']=$cogr['num']+1;
                        $commentg->where(array('comment_goods_id'=>$cogr['comment_goods_id']))->save($vmp);
                    }else{
                        $vm['goods_id']=$pid;
                        $vm['star']=$star;
                        $vm['num']=1;
                        $commentg->add($vm);
                    }
                    if($rel){
                        $this->templateApi('','200','ok');
                    }else{
                        $this->templateApi('','202','err');
                    }
                }
            }else{
                $this->templateApi('','300','token过期');
            }
        }else{
            $this->templateApi('','203','请求类型错误');
        }
    }

    //套课
    public function classes(){
        if(IS_POST){
            $token=I('post.token');
            $type=I('post.type');  //类型  0-待上架;1-已上架;2-已下架;3-审核;
            $page=I('post.pageNum');
            if($token==''||$type==''||$page==''){
                $this->templateApi('','204','参数错误');exit;
            }
            $user=M('user')->where(array('token'=>$token))->find();
            if($user){
                if($user['vip_endtime']<time()){
                    $dovip['is_vip']=0;
                    M('user')->where(array('user_id'=>$user['user_id']))->save($dovip);
                }
                $class=M('class')->where(array('uid'=>$user['user_id']))->find();
                $where['class_id']=$class['class_id'];
                $where['type']=3;
                if($type==0){
                    $where['status']=2;
                    $where['astatus']=1;
                }else if($type==1){
                    $where['astatus']=1;
                    $where['status']=(int)0;
                }else if($type==2){
                    $where['astatus']=1;
                    $where['status']=1;
                }else{
                    $where['astatus']=array('IN','0,2');
                }
                $where['del_status']=0;
                $zcount=M('goods')->where($where)->count();
                $data=$this->havePage('goods',$where,'grounding_time desc',$page,'20','');
                $pie['now_page']=$data['now_page'];
                $pie['total_page']=$data['total_page'];
                unset($data['now_page']);
                unset($data['total_page']);
                foreach($data as $k=>$v){
                    $date[$k]['pid']=(string)$v['goods_id'];
                    $date[$k]['pName']=(string)$v['name'];
                    $date[$k]['classhour']=(string)$v['classhour'];//课时
                    $date[$k]['introduce']=(string)$v['introduce'];//介绍
                    $date[$k]['status']=(string)$v['status'];
//                    $count=M('goods')->where(array('topic_id'=>$v['goods_id']))->count();
                    $date[$k]['sonClassAmount']=(string)$v['classhour'];
                    $date[$k]['openSaleTime']=(string)date('Y年m月d日 H:i:s',$v['grounding_time']);
                    $date[$k]['closeSaleTime']=(string)date('Y年m月d日 H:i:s',$v['lower_time']);
                    $date[$k]['pType']=(string)$v['type'];
                    $date[$k]['pBuyType']=(string)$v['price_status'];
                    $date[$k]['isRecommend']=(string)$v['recommend'];
                    $date[$k]['pImgURL']=(string)URL.$v['img'];
                    $classrel=M('class')->where(array('class_id'=>$v['class_id']))->find();
                    $udrel=M('userdata')->where(array('uid'=>$classrel['uid']))->find();
                    $date[$k]['teacherName']=(string)$classrel['name'];
                    $date[$k]['teacherImg']=(string)URL.$udrel['image'];
                    if($classrel['type']!=3){
                        $date[$k]['isOrganization']='0';
                    }else{
                        $date[$k]['isOrganization']='1';
                    }
                    $date[$k]['signUpNum']=(string)$v['number'];
                    $heard=strstr($_SERVER['HTTP_USER_AGENT'],'(',true);
                    if($heard=='TCCM_WYK/4.0.1 ' || $heard=='TCCM_WYK/4.0.1'){
                        $date[$k]['oldPrice']='0';
                        $date[$k]['currentPrice']='0';
                    }else{
                        $date[$k]['oldPrice']=(string)$v['money'];      //原价
                        if($v['price_status']==0){
                            $date[$k]['currentPrice']=(string)$v['money']; //折扣价
                        }else{
                            $date[$k]['currentPrice']=(string)$v['discount_money']; //折扣价
                        }
                    }

                    $ca=M('category');
                    $cate=$ca->where(array('cate_id'=>$v['cate_id']))->find();
                    $date[$k]['threecate_id']=$cate['cate_id'];
                    $date[$k]['threecate_name']=$cate['name'];
                    $cate1=$ca->where(array('cate_id'=>$cate['pid']))->find();
                    $date[$k]['twocate_id']=$cate1['cate_id'];
                    $date[$k]['twocate_name']=$cate1['name'];
                    $cate2=$ca->where(array('cate_id'=>$cate1['pid']))->find();
                    $date[$k]['onecate_id']=$cate2['cate_id'];
                    $date[$k]['onecate_name']=$cate2['name'];
                    $date[$k]['astatus']=(string)$v['astatus'];
                }
                if(empty($date)){
                    $rel['data']=array();
                }else{
                    $rel['data']=$date;
                }
                $rel['now_page']=$pie['now_page'];
                $rel['total_page']=$pie['total_page'];
                $rel['count']=$zcount;
                $this->templateApi($rel,'200','ok');
            }else{
                $this->templateApi('','300','未登录');
            }
        }else{
            $this->templateApi('','203','请求类型错误');
        }
    }

    //pc全部课程视频
    public function allclass_video(){
        $page=I('post.pageNum');
        $isPopular=I('post.isPopular');
        $priceMin=I('post.priceMin');
        $priceMax=I('post.priceMax');
        $cid=(string)I('post.cId');
        if($page==''||$isPopular==''||$cid==''){
            $this->templateApi('','204','参数错误');exit;
        }
        $cate=M('category');
        $caterel=$cate->where(array('cate_id'=>$cid))->find();
        if($caterel['pid']=='0'){
            $twocate=$cate->where(array('pid'=>$caterel['cate_id']))->select();
            foreach($twocate as $v){
                $cid.=','.$v['cate_id'];
                $threecate=$cate->where(array('pid'=>$v['cate_id']))->select();
                foreach($threecate as $vv){
                    $cid.=','.$vv['cate_id'];
                }
            }
        }else{
            $twocate=$cate->where(array('pid'=>$caterel['cate_id']))->select();
            foreach($twocate as $v){
                $cid.=','.$v['cate_id'];
            }
        }
        $where['cate_id']=array('IN',$cid);
        $where['type']=array('IN','2,3');
        $where['status']=0;
        if($isPopular=='1'){
            $order='number desc';
        }else{
            $order='';
        }

        if(!empty($priceMin) && !empty($priceMax)){
            $where['money']=array('BETWEEN',array($priceMin,$priceMax));
        }else if(!empty($priceMin)){
            $where['money']=array('egt',$priceMin);
        }else if(!empty($priceMax)){
            $where['money']=array('elt',$priceMax);
        }else{

        }

        $where['del_status']=0;
        $count=M('goods')->where($where)->count();
        $data=$this->havePage('goods',$where,$order,$page,'20','');
        $pie['now_page']=$data['now_page'];
        $pie['total_page']=$data['total_page'];
        unset($data['now_page']);
        unset($data['total_page']);
        foreach($data as $k=>$v){
            $date[$k]['pid']=(string)$v['goods_id'];
            $date[$k]['pName']=(string)$v['name'];
            $date[$k]['sonClassAmount']=(string)$v['classhour'];
            $date[$k]['openSaleTime']=(string)date('Y年m月d日 H:i:s',$v['grounding_time']);
            $date[$k]['endSetClassTime']=(string)date('Y年m月d日 H:i:s',$v['endtime']);
            $date[$k]['pType']=(string)$v['type'];
            $date[$k]['pBuyType']=(string)$v['price_status'];
            $date[$k]['isRecommend']=(string)$v['recommend'];
            $date[$k]['introduce']=(string)$v['introduce'];
            $date[$k]['pImgURL']=(string)URL.$v['img'];
            $class=M('class')->where(array('class_id'=>$v['class_id']))->find();
            $date[$k]['teacherName']=(string)$class['name'];
            $udrel=M('userdata')->where(array('uid'=>$class['uid']))->find();
            $date[$k]['teacherImg']=(string)URL.$udrel['image'];
            if($class['type']==3){
                $date[$k]['isOrganization']='1';
            }else{
                $date[$k]['isOrganization']='0';
            }
            $date[$k]['signUpNum']=(string)$v['number'];
            $heard=strstr($_SERVER['HTTP_USER_AGENT'],'(',true);
            if($heard=='TCCM_WYK/4.0.1 ' || $heard=='TCCM_WYK/4.0.1'){
                $date[$k]['oldPrice']='0';
                $date[$k]['currentPrice']='0';
            }else{
                $date[$k]['oldPrice']=(string)$v['money'];      //原价
                if($v['price_status']==0){
                    $date[$k]['currentPrice']=(string)$v['money']; //折扣价
                }else{
                    $date[$k]['currentPrice']=(string)$v['discount_money']; //折扣价
                }
            }
            $date[$k]['groupBuyNum']=(string)$v['group_num'];
            $date[$k]['groupBuyEndTime']=(string)date('Y年m月d日 H:i:s',$v['group_time']);
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
    }

    //pc全部课程直播
    public function allclass_liveb(){
        $page=I('post.pageNum');
        $isPopular=I('post.isPopular');
        $priceMin=I('post.priceMin');
        $priceMax=I('post.priceMax');
        $cid=I('post.cId');
        if($page==''||$isPopular==''||$cid==''){
            $this->templateApi('','204','参数错误');exit;
        }
        $cate=M('category');
        $caterel=$cate->where(array('cate_id'=>$cid))->find();
        if($caterel['pid']=='0'){
            $twocate=$cate->where(array('pid'=>$caterel['cate_id']))->select();
            foreach($twocate as $v){
                $cid.=','.$v['cate_id'];
                $threecate=$cate->where(array('pid'=>$v['cate_id']))->select();
                foreach($threecate as $vv){
                    $cid.=','.$vv['cate_id'];
                }
            }
        }else{
            $twocate=$cate->where(array('pid'=>$caterel['cate_id']))->select();
            foreach($twocate as $v){
                $cid.=','.$v['cate_id'];
            }
        }
        $where['cate_id']=array('IN',$cid);
        $where['type']=array('IN','1,6');
        $where['status']=0;
        if($isPopular=='1'){
            $order='number desc';
        }else{
            $order='';
        }

        if(!empty($priceMin) && !empty($priceMax)){
            $where['money']=array('BETWEEN',array($priceMin,$priceMax));
        }else if(!empty($priceMin)){
            $where['money']=array('egt',$priceMin);
        }else if(!empty($priceMax)){
            $where['money']=array('elt',$priceMax);
        }else{

        }

        $where['del_status']=0;
        $count=M('goods')->where($where)->count();
        $data=$this->havePage('goods',$where,$order,$page,'20','');
        $pie['now_page']=$data['now_page'];
        $pie['total_page']=$data['total_page'];
        unset($data['now_page']);
        unset($data['total_page']);
        foreach($data as $k=>$v){
            $date[$k]['pid']=(string)$v['goods_id'];
            $date[$k]['pName']=(string)$v['name'];
            $date[$k]['pType']=(string)$v['type'];
            $date[$k]['pBuyType']=(string)$v['price_status'];
            $date[$k]['pImgURL']=(string)URL.$v['img'];
            $class=M('class')->where(array('class_id'=>$v['class_id']))->find();
            $date[$k]['teacherName']=(string)$class['name'];
            $udrel=M('userdata')->where(array('uid'=>$class['uid']))->find();
            $date[$k]['teacherImg']=(string)URL.$udrel['image'];
            if($class['type']==3){
                $date[$k]['isOrganization']='1';
            }else{
                $date[$k]['isOrganization']='0';
            }
            $date[$k]['signUpNum']=(string)$v['number'];
            $heard=strstr($_SERVER['HTTP_USER_AGENT'],'(',true);
            if($heard=='TCCM_WYK/4.0.1 ' || $heard=='TCCM_WYK/4.0.1'){
                $date[$k]['oldPrice']='0';
                $date[$k]['currentPrice']='0';
            }else{
                $date[$k]['oldPrice']=(string)$v['money'];      //原价
                if($v['price_status']==0){
                    $date[$k]['currentPrice']=(string)$v['money']; //折扣价
                }else{
                    $date[$k]['currentPrice']=(string)$v['discount_money']; //折扣价
                }
            }
            $date[$k]['liveStartTime']=(string)date('Y年m月d日 H:i:s',$v['starttime']);
            $date[$k]['liveTime']=(string)round(($v['endtime']-$v['starttime'])/60);
            $date[$k]['endSaleTime']=(string)date('Y年m月d日 H:i:s',$v['sign_endtime']);
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
    }

    //pc首页热门课堂
    public function hotclass(){
        $order='follow_num desc';
        $data=$this->havePage('class','',$order,'1','12','');
        $pie['now_page']=$data['now_page'];
        $pie['total_page']=$data['total_page'];
        unset($data['now_page']);
        unset($data['total_page']);
        foreach($data as $k=>$v){
            $date[$k]['sId']=$v['class_id'];
            $udrel=M('userdata')->where(array('uid'=>$v['uid']))->find();
            $date[$k]['sImgURL']=URL.$udrel['image'];
            $date[$k]['sName']=$v['name'];
            $date[$k]['sLV']=$v['grade'];   //0不能直播   1能直播
            if($v['type']==3){
                $date[$k]['isOrganization']='1';
            }else{
                $date[$k]['isOrganization']='0';
            }
            if($v['order_status']==1){
                $date[$k]['isAppointment']='1';
            }else{
                $date[$k]['isAppointment']='0';
            }
            $date[$k]['shopInfo']=(string)$v['introduce'];
            $date[$k]['followNum']=(string)$v['follow_num'];
            $goods=M('goods')
                ->where(array('class_id'=>$v['class_id'],'del_status'=>'0'))
                ->limit(2)
                ->order('number desc')
                ->field('goods_id,img,price_status,type')
                ->select();
            if($goods){
                foreach($goods as $kk=>$vv){
                    $date[$k]['hotProduct'][$kk]['pId']=$vv['goods_id'];
                    $date[$k]['hotProduct'][$kk]['imgURL']=URL.$vv['img'];
                    $date[$k]['hotProduct'][$kk]['pType']=(string)$vv['type'];
                }
            }else{
                $date[$k]['hotProduct']=array();
            }
        }
        if(empty($data)){
            $acc['data']=array();
        }else{
            $acc['data']=$date;
        }
        $this->templateApi($acc,'200','ok');
    }

    //创建套课
    public function addclasses(){
        if(IS_POST){
            $token=I('post.token');             //token
            $name=I('post.name');               //名
            $introduce=I('post.introduce');     //介绍
            $cateid=I('post.cate_id');          //分类id
            $classhour=I('post.classhour');     //课时
            $pBuyType=I('post.pBuyType');       //价格类型  0：原价  1：vip折扣   2：团购   3：普通优惠
            $money=I('post.money');             //原价
            $discount_money=I('post.discount_money');   //折扣价
            $groupnum=I('post.groupnum');       //开团人数
            $grouptime=I('post.grouptime');     //优惠截止时间
            $img=I('post.img');                 //封面
            $vip=I('post.vip');                 //vip专享
            if($token==''||$name==''||$introduce==''||$pBuyType==''||$cateid==''||$classhour==''||$money==''||$img==''){
                $this->templateApi('','204','参数错误');exit;
            }
            if($discount_money>$money){
                $this->templateApi('','202','折扣价不能大于原价');exit;
            }
            $user=M('user')->where(array('token'=>$token))->find();
            if($user){
                if($user['vip_endtime']<time()){
                    $dovip['is_vip']=0;
                    M('user')->where(array('user_id'=>$user['user_id']))->save($dovip);
                }
                $class=M('class')->where(array('uid'=>$user['user_id']))->find();
                if($class){
                    $mvp['img']=$img;
                    $mvp['name']=$name;
                    if($class['o_id']){
                        $mvp['class_id']=$class['o_id'];
                    }else{
                        $mvp['class_id']=$class['class_id'];
                    }
                    $mvp['teacher_id']=$class['class_id'];
                    $mvp['introduce']=$introduce;
                    $mvp['cate_id']=$cateid;
                    $mvp['classhour']=$classhour;
                    $mvp['money']=$money;
                    $mvp['price_status']=$pBuyType;
                    $mvp['group_num']=$groupnum;
                    $mvp['group_time']=$grouptime;
                    if($vip=='1'){
                        $mvp['vip']=1;
                    }else{

                    }
                    if($discount_money!=''){
                        $mvp['discount_money']=$discount_money;
                    }
                    $mvp['type']=3;
                    $mvp['time']=time();
                    $result=M('goods')->add($mvp);
                    $shareurl['shareurl']='http://www.wyueke.com/html/student_singleLessonDetail.html?pid='.$result;
                    M('goods')->where(array('goods_id'=>$result))->save($shareurl);
                    $this->templateApi('','200','ok');
                }else{
                    $this->templateApi('','202','你还没有课堂');
                }
            }else{
                $this->templateApi('','300','未登录');
            }
        }else{
            $this->templateApi('','203','请求类型错误');
        }
    }

    //套课编辑
    public function editclasses(){
        if(IS_POST){
            $token=I('post.token');             //token
            $name=I('post.name');               //名
            $introduce=I('post.introduce');     //介绍
            $cateid=I('post.cate_id');          //分类id
            $classhour=I('post.classhour');     //课时
            $pBuyType=I('post.pBuyType');       //价格类型
            $money=I('post.money');             //原价
            $discount_money=I('post.discount_money');   //折扣价
            $pid=I('post.pid');                 //套课id
            $groupnum=I('post.groupnum');       //开团人数
            $grouptime=I('post.grouptime');     //优惠截止时间
            $vip=I('post.vip');                 //vip专享  为1是vip专享
            if($pid==''||$token==''||$name==''||$introduce==''||$pBuyType==''||$cateid==''||$classhour==''||$money==''){
                $this->templateApi('','204','参数错误');exit;
            }
            if($discount_money>$money){
                $this->templateApi('','202','折扣价不能大于原价');exit;
            }
            $user=M('user')->where(array('token'=>$token))->find();
            if($user){
                if($user['vip_endtime']<time()){
                    $dovip['is_vip']=0;
                    M('user')->where(array('user_id'=>$user['user_id']))->save($dovip);
                }
                $class=M('class')->where(array('uid'=>$user['user_id']))->find();
                if($class){
                    $good=M('goods')->where(array('goods_id'=>$pid))->find();
                    if($good['reg_status']==1){
                        $this->templateApi('','202','课程已被购买，禁止修改');exit;
                    }
                    $mvp['name']=$name;
                    $mvp['class_id']=$class['class_id'];
                    $mvp['introduce']=$introduce;
                    $mvp['cate_id']=$cateid;
                    $mvp['classhour']=$classhour;
                    $mvp['money']=$money;
                    $mvp['price_status']=$pBuyType;
                    $mvp['group_num']=$groupnum;
                    $mvp['group_time']=$grouptime;
                    if($vip=='1'){
                        $mvp['vip']=1;
                    }else{

                    }
                    if($discount_money!=''){
                        $mvp['discount_money']=$discount_money;
                    }
                    $mvp['type']=3;
                    $mvp['time']=time();
                    M('goods')->where(array('goods_id'=>$pid))->save($mvp);
                    $this->templateApi('','200','ok');
                }else{
                    $this->templateApi('','202','你还没有课堂');
                }
            }else{
                $this->templateApi('','300','未登录');
            }
        }else{
            $this->templateApi('','203','请求类型错误');
        }
    }
}