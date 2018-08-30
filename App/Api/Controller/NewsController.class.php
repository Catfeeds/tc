<?php
/***************************
 *
 * 时间：2017年11月1日
 * 功能：通知消息
 * 作者：Mr Peng
 *
 **************************/ 
namespace Api\Controller;
use Think\Controller;
header('Content-Type:text/json;charset=utf-8');
header("Access-Control-Allow-Origin: *");
class NewsController extends CommonController {
// +----------------------------------------------------------------------
// | 功能       | 消息类别
// +----------------------------------------------------------------------
// | 请求类型   | POST
// +----------------------------------------------------------------------
// | 参数       | token
// +----------------------------------------------------------------------
    public function cates(){
        $data=(object)null;
        if(IS_POST){
            $token=I('post.token');
            if($token==''){echo json_encode($this->apiTemplate($data,'204','参数错误'));exit;}
            $userrel=M('user')->where(array('token'=>$token))->find();
            if($userrel){
                $news=M('news');
                $newsread=M('newsread');
                $where['uid']=array('exp','is null');
                $where['tuisong']='1';
                $newsrel=$news->field('content,time')->where($where)->order('time desc')->find();
                if($newsrel){
                    $date[0]=array(
                        'icon'      =>  URL.'/user/public_xitong.png',
                        'name'      =>  '系统消息',
                        'content'   =>  $newsrel['content'],
                        'time'      =>  date('Y-m-d H:i',$newsrel['time']),
                        'type'      =>  'sys'
                    );
                    $newsreadrel=$newsread->where(array('uid'=>$userrel['user_id']))->find();
                    if($newsreadrel){
                        if($newsreadrel['status']=='0'){
                            $date[0]['status']='1';
                        }else{
                            $date[0]['status']='0';
                        }
                    }else{
                        $date[0]['status']='0';
                    }

                }else{
                    $date[0]=array(
                        'icon'      =>  URL.'/user/public_xitong.png',
                        'name'      =>  '系统消息',
                        'content'   =>  '',
                        'time'      =>  '',
                        'type'      =>  'sys',
                        'status'    =>  '0'
                    );
                }
                
                $where_me['uid']=$userrel['user_id'];
                $where_me['type']=1;
                $where_me['tuisong']='1';
                $news_me=$news->field('content,time')->where($where_me)->order('time desc')->find();
                if($news_me){
                    $date[1]=array(
                        'icon'      =>  URL.'/user/public_geren.png',
                        'name'      =>  '个人消息',
                        'content'   =>  $news_me['content'],
                        'time'      =>  date('Y-m-d H:i',$news_me['time']),
                        'type'      =>  'me',
                    );
                    $where_me['status']='0';
                    $news_merel=$news->where($where_me)->find();
                    if($news_merel){
                        $date[1]['status']='1';
                    }else{
                        $date[1]['status']='0';
                    }

                }else{
                    $date[1]=array(
                        'icon'      =>  URL.'/user/public_geren.png',
                        'name'      =>  '个人消息',
                        'content'   =>  '',
                        'time'      =>  '',
                        'type'      =>  'me',
                        'status'    =>  '0'
                    );
                }
                $where_jiaoyi['uid']=$userrel['user_id'];
                $where_jiaoyi['type']=2;
                $where_jiaoyi['tuisong']='1';
                $news_jiaoyi=$news->field('content,time')->where($where_jiaoyi)->order('time desc')->find();
                if($news_jiaoyi){
                    $date[2]=array(
                        'icon'      =>  URL.'/user/public_jiaoyi.png',
                        'name'      =>  '交易消息',
                        'content'   =>  $news_jiaoyi['content'],
                        'time'      =>  date('Y-m-d H:i',$news_jiaoyi['time']),
                        'type'      =>  'buy'
                    );
                    $where_jiaoyi['status']='0';
                    $news_jiaoyirel=$news->where($where_jiaoyi)->find();
                    if($news_jiaoyirel){
                        $date[2]['status']='1';
                    }else{
                        $date[2]['status']='0';
                    }

                }else{
                    $date[2]=array(
                        'icon'      =>  URL.'/user/public_jiaoyi.png',
                        'name'      =>  '交易消息',
                        'content'   =>  '',
                        'time'      =>  '',
                        'type'      =>  'buy',
                        'status'    =>  '0'
                    );
                }
                
                // $news_jiaoyi=$news->field;
                $arr['group']=$date;
                echo json_encode($this->apiTemplate($arr,'200','ok'));
            }else{
                echo json_encode($this->apiTemplate($data,'202','token过期'));
            }
        }else{
            echo json_encode($this->apiTemplate($data,'203','请求类型错误'));
        }
    }
// +----------------------------------------------------------------------
// | 功能       | 消息列表
// +----------------------------------------------------------------------
// | 请求类型   | POST
// +----------------------------------------------------------------------
// | 参数       | token、page、type
// +----------------------------------------------------------------------
    public function index(){
        if(IS_POST){
            $token=I('post.token');
            $page=I('post.page');
            $type=I('post.type');
            if(empty($page)||empty($token)||empty($type)){
                $data=(object)null;
                echo json_encode($this->apiTemplate($data,'204','参数错误'));exit;
            }
            $user=M('user');
            $userrel=$user->where(array('token'=>$token))->find();
            if($userrel){
                if($type=='sys'){
                    $where['uid']=array('exp','is null');
                    $newsread=M('newsread');
                    $mmp['status']='1';
                    $newsread->where(array('uid'=>$userrel['user_id']))->save($mmp);
                }else if($type=='me'){
                    $where['uid']=$userrel['user_id'];
                    $where['type']=1;
                }else{
                    $where['uid']=$userrel['user_id'];
                    $where['type']=2;
                }
                $where['tuisong']='1';
                $count=M('news')->where($where)->count();
                $config = array(
                    'tablename' => 'news', // 表名
                    'where'     => $where, // 查询条件
                    'relation'  => '',          // 关联条件
                    'order'     => 'time desc',          // 排序
                    'page'      => $page,       // 页码，默认为首页
                    'num'       => 10 ,        // 每页条数
                    'field'     => 'news_id,title,content,time'
                );
                $ppp = new \Org\Util\Page($config);
                $data = $ppp->get();
                $pie['now_page']=$data['now_page'];
                $pie['total_page']=$data['total_page'];
                unset($data['now_page']);
                unset($data['total_page']);
                $id='';
                foreach($data as $k=>$v){
                    $data[$k]['time']=date('Y年m月d日 H:i:s',$v['time']);
                    $id.=$v['news_id'].',';
                }
                if(!empty($id)){
                    $news=M('news');
                    $wh['uid']=$userrel['user_id'];
                    $mvp['status']='1';
                    if($type=='me'){
                        $wh['type']=1;
                        $news->where($wh)->save($mvp);
                    }else if($type=='buy'){
                        $wh['type']=2;
                        $news->where($wh)->save($mvp);
                    }else{

                    }


                }
                $date['list']=$data;
                $date['now_page']=$pie['now_page'];
                $date['total_page']=$pie['total_page'];
                $date['count']=$count;
                echo json_encode($this->apiTemplate($date,'200','ok'));
            }else{
                $data=(object)null;
                echo json_encode($this->apiTemplate($data,'202','token过期'));
            }
        }else{
            $data=(object)null;
            echo json_encode($this->apiTemplate($data,'203','请求类型错误'));
        }
	   
	}

// +----------------------------------------------------------------------
// | 功能       | 删除消息
// +----------------------------------------------------------------------
// | 请求类型   | POST
// +----------------------------------------------------------------------
// | 参数       | news_id
// +----------------------------------------------------------------------
    public function newdel(){
        if(IS_POST){
            $id=I('post.news_id');
            if($id==''){
                $data=(object)null;
                echo json_encode($this->apiTemplate($data,'204','参数错误'));exit;
            }
            $news=M('news');
            $rel=$news->where(array('news_id'=>$id))->delete();
            if($rel){
                $data=(object)null;
                echo json_encode($this->apiTemplate($data,'200','ok'));
            }else{
                $data=(object)null;
                echo json_encode($this->apiTemplate($data,'202','error'));
            }
        }else{
            $data=(object)null;
            echo json_encode($this->apiTemplate($data,'203','请求类型错误'));
        }
    }

    //消息详情

    public function details(){
        if(IS_POST){
            $id=I('post.news_id');
            if($id==''){
                $data=(object)null;
                echo json_encode($this->apiTemplate($data,'204','参数错误'));exit;
            }
            $news=M('news');
            $rel=$news->where(array('news_id'=>$id))->find();
            $data['title']=$rel['title'];
            $data['content']=$rel['content'];
            $this->templateApi($data,'200','ok');
        }else{
            $data=(object)null;
            echo json_encode($this->apiTemplate($data,'203','请求类型错误'));
        }
    }
   	
}




