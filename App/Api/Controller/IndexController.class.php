<?php
/***************************
 *
 * 时间：2017年10月16日
 * 功能：首页接口
 * 作者：Mr Peng
 *
 **************************/ 
namespace Api\Controller;
use Think\Controller;
header('Content-Type:text/json;charset=utf-8');
header("Access-Control-Allow-Origin: *");
class IndexController extends CommonController {

// +----------------------------------------------------------------------
// | 功能       | 首页栏目接口
// +----------------------------------------------------------------------
// | 请求类型   | 
// +----------------------------------------------------------------------
// | 参数       | 
// +----------------------------------------------------------------------
    public function column(){
        
        $cate=M('category');
        $list=$cate->order('cate_id asc')->field('cate_id,name')->where('pid=0')->select();
        $data['result']=$list;
        $data['code']='200';
        $data['message']='success';
        $data['time']=time();
        echo json_encode($data);
    }


    //添加消息及推送(成功)
    public function tuisong($userid){
        $news=D('news');
        $user=D('user');
        $tui=$user->field('device_tokens')->where('user_id='.$userid)->find();
        if($tui['device_tokens']==''){
            $date['title']='您的团购已成功';
            $date['content']='您的团购已成功';
            $date['time']=time();
            $date['uid']=$userid;
            $date['tuisong']=1;
            $date['type']='1';
            $news->data($date)->add();
        }else{
            $date['title']='您的团购已成功';
            $date['content']='您的团购已成功';
            $date['time']=time();
            $date['uid']=$userid;
            $date['tuisong']=1;
            $date['type']='1';
            $newslist=$news->data($date)->add();
            vendor('Umeng.Demo');
            if(strlen($tui['device_tokens'])==64){
                $demo = new \Demo("5afa49fdb27b0a365600013b", "qp22lyrj6twuswsxiuhejnerogyfsevn");
                $ios=$demo->sendIOSUnicast("您的团购已成功","您的团购已成功",$tui['device_tokens']);
            }else{
                $umeng=new \Demo("5afa46ef8f4a9d19f600008c", "kdockprelcj3qlth6vgthymejczsr2uu");
                $android=$umeng->sendAndroidUnicast("您的团购已成功","您的团购已成功",$tui['device_tokens']);
            }
        }

    }
    //推送 失败
    public function tuisongerr($userid){
        $news = D('news');
        $user = D('user');
        $tui = $user->field('device_tokens')->where('user_id='.$userid)->find();
        if($tui['device_tokens'] == ''){
            $date['title'] = '您的团购失败';
            $date['content'] = '您的团购失败';
            $date['time'] = time();
            $date['uid'] = $userid;
            $date['tuisong'] = 1;
            $date['type'] = '1';
            $newslist = $news->data($date)->add();
        }else{
            $date['title'] = '您的团购失败';
            $date['content'] = '您的团购失败';
            $date['time'] = time();
            $date['uid'] = $userid;
            $date['tuisong'] = 1;
            $date['type'] = '1';
            $newslist = $news->data($date)->add();
            vendor('Umeng.Demo');
            if(strlen($tui['device_tokens']) == 64){
                $demo = new \Demo("5afa49fdb27b0a365600013b", "qp22lyrj6twuswsxiuhejnerogyfsevn");
                $ios = $demo->sendIOSUnicast("您的团购失败", "您的团购失败", $tui['device_tokens']);
            }else{
                $umeng = new \Demo("5afa46ef8f4a9d19f600008c", "kdockprelcj3qlth6vgthymejczsr2uu");
                $android = $umeng->sendAndroidUnicast("您的团购失败", "您的团购失败", $tui['device_tokens']);
            }
        }
    }

// +----------------------------------------------------------------------
// | 功能       | 修改直播间状态，团购开团，团购失败
// +----------------------------------------------------------------------
// | 请求类型    | GET
// +----------------------------------------------------------------------
// | 参数       | cate_id
// +----------------------------------------------------------------------
    public function index(){
        //关闭到时间的直播间
        $good=M('goods');
        $goodwhere['type']=array('IN','1,5,6');
        $goodwhere['liveb_status']=1;
        $goodwhere['endtime']=array('elt',time());
        $goods=$good->where($goodwhere)->field('roomid')->select();
        foreach($goods as $k=>$v){
            $Ccliveb=new \Api\Controller\CclivebController();
            $Ccliveb->stop_room($v['roomid']);
        }
    	//团购开团
        $groupwhere['type']=2;
        $groupwhere['group_time']=array('elt',time());
        $groupwhere['group_status']=0;
        $goodlist=$good->where($groupwhere)->field('goods_id,group_num,class_id,name,type')->select();
        foreach($goodlist as $k=>$v){
            $groupbuy=M('groupbuy');
            $payrecord=D('payrecord');
            $groupnum=$groupbuy->where(array('pid'=>$v['goods_id'],'status'=>0,'paystatus'=>1))->count();
            $grouplist=$groupbuy->where(array('pid'=>$v['goods_id'],'status'=>0,'paystatus'=>1))->select();
            if($groupnum<$v['group_num']){
                //团购失败
                //修改商品团购状态为失败，价格类型为原价
                $mvp['group_status']=2;
                $mvp['price_status']=0;
                $good->where(array('goods_id'=>$v['goods_id']))->save($mvp);
                foreach($grouplist as $key=>$val){
                    //学生退款
                    $tuikuan=M('userdata')->where('uid='.$val['uid'])->setInc('money',$val['money']);
                    $this->tuisongerr($val['uid']);
                }
            }else{
                //团购成功
                //修改商品团购状态为成功，价格类型为原价
                $mvp['group_status']=1;
                $mvp['price_status']=0;
                $good->where(array('goods_id'=>$v['goods_id']))->save($mvp);
                //添加老师收益
                $money=$v['discount_money']*$groupnum;
                $profit=M('class')->where('class_id='.$v['class_id'])->setInc('profit',$money);
                foreach($grouplist as $key=>$val){
                    //添加学生交易记录
                    $pvp['uid']=$val['uid'];
                    $pvp['type']=2;
                    $pvp['time']=time();
                    $pvp['cid']=$val['pid'];
                    $pvp['pay']=$val['money'];
                    $pvp['source']=$v['name'];
                    $pvp['ptype']=2;
                    $pvp['source']=$v['name'];
                    $pvp['ctype']=$v['type'];
                    $addpay=$payrecord->add($pvp);
                    //修改团购表的开团状态
                    $mmp['status']='1';
                    $pass=M('groupbuy')->where('uid='.$val['uid'])->save($mmp);
                    $this->tuisong($val['uid']);
                }

            }
        }




        $this->templateApi('','200','ok');
	}

// +----------------------------------------------------------------------
// | 功能       | 首页消息接口
// +----------------------------------------------------------------------
// | 请求类型   | POST
// +----------------------------------------------------------------------
// | 参数       | token
// +----------------------------------------------------------------------
    public function news(){
        if(IS_POST){
            $token=I('post.token');
            $news=M('news');
            $user=M('user');
            $newsread=M('newsread');
            $userrel=$user->where(array('token'=>$token))->find();
            if($userrel){
                if($userrel['vip_endtime']<time()){
                    $dovip['is_vip']=0;
                    M('user')->where(array('user_id'=>$userrel['user_id']))->save($dovip);
                }
                $list=$news->where(array('uid'=>$userrel['user_id'],'status'=>'0'))->count();
//                dump($list);exit;
                if($list!=0){
                    $data='1';
                    echo json_encode($this->apiTemplate($data,'200','ok'));
                }else{
                    $where['uid']=array('exp','is null');
                    $rel=$news->where($where)->find();
                    if($rel){
                        $newsreadrel=$newsread->where(array('uid'=>$userrel['user_id']))->find();
                        if(!$newsreadrel){
                            $mvp['uid']=$userrel['user_id'];
                            $mvp['status']='0';
                            $newsread->add($mvp);
                            $data='1';
                            echo json_encode($this->apiTemplate($data,'200','ok'));
                        }else if($newsreadrel['status']=='0'){
                            $data='1';
                            echo json_encode($this->apiTemplate($data,'200','ok'));
                        }else{
                            $data='0';
                            echo json_encode($this->apiTemplate($data,'200','ok'));
                        }
                    }else{
                        $data='0';
                        echo json_encode($this->apiTemplate($data,'200','ok'));
                    }
                    
                }
            }else{
                $data='0';
                echo json_encode($this->apiTemplate($data,'200','ok'));
            }
        }else{
            $data=(object)null;
            echo json_encode($this->apiTemplate($data,'203','请求类型错误'));
        }
        
    }

// +----------------------------------------------------------------------
// | 功能       | 首页查看更多
// +----------------------------------------------------------------------
// | 请求类型   | GET
// +----------------------------------------------------------------------
// | 参数       | cate_id、type、page
// +----------------------------------------------------------------------

    public function viewmore(){
        if(IS_GET){
            $cate_id=I('get.cate_id');
            $type=I('get.source');
            $page=I('get.page');
            if($cate_id==''||$type=='' || $page==''){
                $data=(object)null;
                echo json_encode($this->apiTemplate($data,'204','参数错误'));exit;
            }
            $cate=M('category');
            if($type=='正在直播'){
                $where['status']='1';
                $caterel=$cate->where(array('cate_id'=>$cate_id))->find();
                if($caterel['pid']=='0'){
                    $rel=$cate->where(array('pid'=>$cate_id))->select();
                    foreach($rel as $v){
                        $cate_id.=','.$v['cate_id'];
                    }
                    $where['cate_id']=array(IN,$cate_id);
                }else{
                    $where['cate_id']=$cate_id;
                }
                $config = array(
                    'tablename' => 'liveb',     // 表名
                    'where'     => $where,      // 查询条件
                    'relation'  => '',          // 关联条件
                    'order'     => '',          // 排序
                    'page'      => $page,       // 页码，默认为首页
                    'num'       => 20,           // 每页条数
                    'field'     => 'liveb_id,name,img,money'
                );
                $ppp = new \Org\Util\Page($config);
                $data = $ppp->get();
                $pie['now_page']=$data['now_page'];
                $pie['total_page']=$data['total_page'];
                unset($data['now_page']);
                unset($data['total_page']);
                foreach($data as $key=>$val){
                    $data[$key]['img']=URL.$val['img'];
                    $data[$key]['paly_id']=$val['liveb_id'];
                    $data[$key]['type']='0';
                }
                $date['liveb']=$data;
                $date['now_page']=$pie['now_page'];
                $date['total_page']=$pie['total_page'];
                echo json_encode($this->apiTemplate($date,'200','ok'));

            }else if($type=='热门推荐'){
                $where['recommend']='1';
                // $where['time']=array(GT,time());
                $config = array(
                    'tablename' => 'video',     // 表名
                    'where'     => $where,      // 查询条件
                    'relation'  => '',          // 关联条件
                    'order'     => '',          // 排序
                    'page'      => $page,       // 页码，默认为首页
                    'num'       => 20,          // 每页条数
                    'field'     => 'video_id,name,img,money,number'
                );
                $ppp = new \Org\Util\Page($config);
                $data = $ppp->get();
                $pie['now_page']=$data['now_page'];
                $pie['total_page']=$data['total_page'];
                unset($data['now_page']);
                unset($data['total_page']);
                foreach($data as $key=>$val){
                    // $data[$key]['img']=URL.$val['img'];
                    $data[$key]['paly_id']=$val['video_id'];
                    $data[$key]['type']='1';
                }
                $date['liveb']=$data;
                $date['now_page']=$pie['now_page'];
                $date['total_page']=$pie['total_page'];
                echo json_encode($this->apiTemplate($date,'200','ok'));
            }else if($type=='热门视频'){
                $where['recommend']='1';
                $caterel=$cate->where(array('cate_id'=>$cate_id))->find();
                if($caterel['pid']=='0'){
                    $rel=$cate->where(array('pid'=>$cate_id))->select();
                    foreach($rel as $v){
                        $cate_id.=','.$v['cate_id'];
                    }
                    $where['cate_id']=array(IN,$cate_id);
                }else{
                    $where['cate_id']=$cate_id;
                }
                $config = array(
                    'tablename' => 'video',     // 表名
                    'where'     => $where,      // 查询条件
                    'relation'  => '',          // 关联条件
                    'order'     => '',          // 排序
                    'page'      => $page,       // 页码，默认为首页
                    'num'       => 20,           // 每页条数
                    'field'     => 'video_id,name,img,money,number'
                );
                $ppp = new \Org\Util\Page($config);
                $data = $ppp->get();
                $pie['now_page']=$data['now_page'];
                $pie['total_page']=$data['total_page'];
                unset($data['now_page']);
                unset($data['total_page']);
                foreach($data as $key=>$val){
                    $data[$key]['paly_id']=$val['video_id'];
                    $data[$key]['type']='1';
                }
                $date['liveb']=$data;
                $date['now_page']=$pie['now_page'];
                $date['total_page']=$pie['total_page'];
                echo json_encode($this->apiTemplate($date,'200','ok'));
            }else{
                $data=(object)null;
                echo json_encode($this->apiTemplate($data,'204','参数错误'));
            }

        }else{
            $data=(object)null;
            echo json_encode($this->apiTemplate($data,'203','请求类型错误'));
        }
    }

    public function indextwo(){

        //**************** 首页 banner 数据返回 *****************
        $data=array();
        $banner=M('lunbo');
        $bannerlist=$banner->where(array('pc'=>'2'))->limit(4)->order('num desc')->select();
        if(!empty($bannerlist)){
            foreach($bannerlist as $k=>$v){
                $data['banner'][$k]['title']=(string)$v['title'];
                $data['banner'][$k]['pushType']=$v['pushtype'];
                $data['banner'][$k]['pid']=$v['goods_id'];
                $data['banner'][$k]['imgURL']=URL.$v['img'];
                $data['banner'][$k]['pushURL']=$v['url'];
                if($v['goods_id']){
                    $good=M('goods')->where(array('goods_id'=>$v['goods_id']))->field('type')->find();
                }else{
                    $good['type']='';
                }
                $data['banner'][$k]['pType']=(string)$good['type'];
            }
        }else{
            $data['banner']=array();
        }
        //*************** 首页 1级分类 列表 ********************
        $category=M('category');
        $categorylist=$category->where(array('pid'=>'0','cate_id'=>array('neq','1')))->select();
        if(!empty($categorylist)){
            foreach($categorylist as $k=>$v){
                $data['classification'][$k]['cid']=$v['cate_id'];
                $data['classification'][$k]['name']=$v['name'];
                $data['classification'][$k]['imgURL']=URL.$v['img'];
            }
            if(sizeof($categorylist)>9){
                $data['classification']=array_slice($data['classification'],0,9);
                array_push($data['classification'],array('cid'=>'','name'=>'更多','imgURL'=>URL.'/Uploads/category/1.png'));
            }
        }else{
            $data['classification']=array();
        }
        //****************** 免费专区的4个按钮 *******************
        $data['btnInfo']=array(
            array(
                'titleBig'  =>  '免费专区',
                'titleSmall'=>  '免费好课随心看',
                'imgURL'    =>  URL.'/user/public_mfzq.png',
            ),
            array(
                'titleBig'  =>  '活动中心',
                'titleSmall'=>  '点开有惊喜哦',
                'imgURL'    =>  URL.'/user/public_hdzq.png',
            ),
            array(
                'titleBig'  =>  '积分商城',
                'titleSmall'=>  '精美礼品等你选',
                'imgURL'    =>  URL.'/user/public_jfsc.png',
            ),
            array(
                'titleBig'  =>  '教师直播',
                'titleSmall'=>  '来这里授课吧',
                'imgURL'    =>  URL.'/user/public_jszb.png',
            )
        );
        // ***********  课程专区  *************
        $goods=M('goods');
        $onecate=$category->where(array('pid'=>'0','cate_id'=>array('neq','1')))->select();
        $cates=array();
        foreach($onecate as $k=>$v){
            $data['productArea'][$k]['icon']='http://p.wyuek.com/Uploads/icon/3.png';
            $data['productArea'][$k]['title']=$v['name'];
            $data['productArea'][$k]['cId']=$v['cate_id'];
            $cateid=$v['cate_id'];
            // 子分类
            $cate=$category->where(array('pid'=>$cateid))->select();
            foreach($cate as $ka=>$va){
                $cates[$ka]['cId']=$va['cate_id'];
                $cates[$ka]['cName']=$va['name'];
            }
            $twocate=$category->where(array('pid'=>$v['cate_id']))->select();
            foreach($twocate as $kk=>$vv){
                $cateid.=','.$vv['cate_id'];
                $threecate=$category->where(array('pid'=>$vv['cate_id']))->select();
                foreach($threecate as $kkk=>$vvv){
                    $cateid.=','.$vvv['cate_id'];
                }

            }
//            // 子分类
//            $cates=array();
//            $cate=$category->where(array('cate_id'=>array('IN',$cateid)))->select();
//            foreach($cate as $ka=>$va){
//                $cates[$ka]['cId']=$va['cate_id'];
//                $cates[$ka]['cName']=$va['name'];
//            }
            //如果是直播，报名时间到了，课程下架
            $mvp['status']=1;
            $where['type']=array('IN','1,6');
            $where['sign_endtime']=array('lt',time());
            M('goods')->where($where)->save($mvp);
            $goodlist=$goods
                ->where(array('cate_id'=>array('IN',$cateid),'status'=>'0','del_status'=>'0'))
                ->field('goods_id,name,price_status,classhour,grounding_time,endtime,type,img,class_id,number,money,discount_money,group_num,group_time,starttime,sign_endtime')
                ->limit(2)
                ->order('time desc')
                ->select();
            $date=array();
            foreach($goodlist as $key=>$val){
                $date[$key]['pid']=(string)$val['goods_id'];                //课程id
                $date[$key]['pName']=(string)$val['name'];                  //课程名字
                $date[$key]['sonClassAmount']=(string)$val['classhour'];    //套课的课节数
                $date[$key]['openSaleTime']=(string)date('Y-m-d H:i:s',$val['grounding_time']); //普通课程上架时间
                $date[$key]['endSetClassTime']=(string)date('Y-m-d H:i:s',$val['endtime']);     //套课结束上传时间
                $date[$key]['pType']=(string)$val['type'];                  //课程类型，具体类型见QQ群公告
                $date[$key]['pBuyType']=(string)$val['price_status'];       // 价格状态
                $date[$key]['pImgURL']=(string)URL.$val['img'];                 //课程封面图片
                $isOrganization=M('class')->where(array('class_id'=>$val['class_id']))->field('type')->find();
                if($isOrganization['type']==3){
                    $date[$key]['isOrganization']='1';   //是否机构上传   是
                }else{
                    $date[$key]['isOrganization']='0';   //是否机构上传   否
                }
                $date[$key]['signUpNum']=(string)$val['number'];
                $heard=strstr($_SERVER['HTTP_USER_AGENT'],'(',true);
                if($heard=='TCCM_WYK/4.0.1 ' || $heard=='TCCM_WYK/4.0.1'){
                    $date[$key]['oldPrice']='0';
                    $date[$key]['currentPrice']='0';
                }else{
                    $date[$key]['oldPrice']=(string)$val['money'];      //原价
                    if($val['price_status']==0){
                        $date[$key]['currentPrice']=(string)$val['money']; //折扣价
                    }else{
                        $date[$key]['currentPrice']=(string)$val['discount_money']; //折扣价
                    }
                }
                $date[$key]['groupBuyNum']=(string)$val['group_num'];
                $date[$key]['groupBuyEndTime']=(string)date('Y-m-d H:i:s',$val['group_time']);
                $date[$key]['liveStartTime']=(string)date('Y-m-d H:i:s',$val['starttime']);
                $date[$key]['liveEndBuyTime']=(string)date('Y-m-d H:i:s',$val['sign_endtime']);
                $date[$key]['liveTime']=(string)round(($val['endtime']-$val['starttime'])/60);

            }

            $re_good=$goods
                ->where(array('recommend'=>'1','status'=>'0','del_status'=>'0'))
                ->field('goods_id,name,classhour,price_status,grounding_time,endtime,type,img,class_id,number,money,discount_money,group_num,group_time,starttime,sign_endtime')
                ->limit(2)
                ->order('time desc')
                ->select();
            foreach($re_good as $rek=>$rev){
                $redate[$rek]['pid']=(string)$rev['goods_id'];                //课程id
                $redate[$rek]['pName']=(string)$rev['name'];                  //课程名字
                $redate[$rek]['sonClassAmount']=(string)$rev['classhour'];    //套课的课节数
                $redate[$rek]['openSaleTime']=(string)date('Y-m-d H:i:s',$rev['grounding_time']); //普通课程上架时间
                $redate[$rek]['endSetClassTime']=(string)date('Y-m-d H:i:s',$rev['endtime']);     //套课结束上传时间
                $redate[$rek]['pType']=(string)$rev['type'];                  //课程类型，具体类型见QQ群公告
                $redate[$rek]['pBuyType']=(string)$rev['price_status'];       // 价格状态
                $redate[$rek]['pImgURL']=(string)URL.$rev['img'];                 //课程封面图片
                $isOrganization=M('class')->where(array('class_id'=>$rev['class_id']))->field('type')->find();
                if($isOrganization['type']==3){
                    $redate[$rek]['isOrganization']='1';   //是否机构上传   是
                }else{
                    $redate[$rek]['isOrganization']='0';   //是否机构上传   否
                }
                $redate[$rek]['signUpNum']=(string)$rev['number'];
                $heard=strstr($_SERVER['HTTP_USER_AGENT'],'(',true);
                if($heard=='TCCM_WYK/4.0.1 ' || $heard=='TCCM_WYK/4.0.1'){
                    $redate[$rek]['oldPrice']='0';
                    $redate[$rek]['currentPrice']='0';
                }else{
                    $redate[$rek]['oldPrice']=(string)$rev['money'];      //原价
                    if($rev['price_status']==0){
                        $redate[$rek]['currentPrice']=(string)$rev['money']; //折扣价
                    }else{
                        $redate[$rek]['currentPrice']=(string)$rev['discount_money']; //折扣价
                    }
                }
                $redate[$rek]['groupBuyNum']=(string)$rev['group_num'];
                $redate[$rek]['groupBuyEndTime']=(string)date('Y-m-d H:i:s',$rev['group_time']);
                $redate[$rek]['liveStartTime']=(string)date('Y-m-d H:i:s',$rev['starttime']);
                $redate[$rek]['liveEndBuyTime']=(string)date('Y-m-d H:i:s',$rev['sign_endtime']);
                $redate[$rek]['liveTime']=(string)round(($rev['endtime']-$rev['starttime'])/60);
            }
            foreach($categorylist as $catek=>$catev){
                $recommenddata[$catek]['cId']=$catev['cate_id'];
                $recommenddata[$catek]['cName']=$catev['name'];
            }
            $rearr=array(
                'icon'      =>  'http://p.wyuek.com/Uploads/icon/1.png',
                'title'     =>  '热门推荐',
                'cId'       =>  '1',
                'products'  =>  $redate,
                'sonClass'  =>  $recommenddata
            );

            array_shift($cates);
            $data['productArea'][$k]['products']=$date;
            $data['productArea'][$k]['sonClass']=$cates;
        }
        array_unshift($data['productArea'],$rearr);
        $this->templateApi($data,'200','ok');
    }

    //pc首页
    public function pc_index(){
        $banner=M('lunbo');
        $bannerrel=$banner->where(array('pc'=>'1'))->order('num desc')->limit(4)->select();
        if(!$bannerrel){
            $data['bannerData']=array();
        }else{
            foreach($bannerrel as $k=>$v){
                $data['bannerData'][$k]['pushType']=$v['pushtype'];
                $data['bannerData'][$k]['pid']=$v['goods_id'];
                $data['bannerData'][$k]['imgURL']=URL.$v['img'];
                $data['bannerData'][$k]['pushURL']=$v['url'];
            }
        }
        $cate=M('category');
        $onecate=$cate->where(array('pid'=>'0','cate_id'=>array('neq','1')))->limit(5)->select();
        foreach($onecate as $k=>$v){
            $data['classData'][$k]['classACid']=$v['cate_id'];
            $data['classData'][$k]['classAName']=$v['name'];
            $twocate=$cate->where(array('pid'=>$v['cate_id']))->select();
            if(!$twocate){
                $data['classData'][$k]['classB']=array();
            }else{
                foreach($twocate as $kk=>$vv){
                    $data['classData'][$k]['classB'][$kk]['classBCid']=$vv['cate_id'];
                    $data['classData'][$k]['classB'][$kk]['classBName']=$vv['name'];
                    $threecate=$cate->where(array('pid'=>$vv['cate_id']))->select();
                    if(!$threecate){
                        $data['classData'][$k]['classB'][$kk]['classC']=array();
                    }else{
                        foreach($threecate as $kkk=>$vvv){
                            $data['classData'][$k]['classB'][$kk]['classC'][$kkk]['classCCid']=$vvv['cate_id'];
                            $data['classData'][$k]['classB'][$kk]['classC'][$kkk]['classCName']=$vvv['name'];
                        }
                    }
                }
            }
        }

        $this->templateApi($data,'200','ok');
    }

    //pc热门推荐  5条 视频
    public function pc_recommend_video(){
        $goods=M('goods');
        $where['type']=array('IN','2,3');
        $where['recommend']='1';
        $where['del_status']=0;
        $goodrel=$goods->where($where)->limit(5)->select();
        foreach($goodrel as $k=>$v){
            $data[$k]['pid']=(string)$v['goods_id'];
            $data[$k]['pName']=(string)$v['name'];
            $data[$k]['sonClassAmount']=(string)$v['classhour'];
            $data[$k]['openSaleTime']=(string)date('Y年m月d日 H:i:s',$v['grounding_time']);
            $data[$k]['endSetClassTime']=(string)date('Y年m月d日 H:i:s',$v['endtime']);
            $data[$k]['pType']=(string)$v['type'];
            $data[$k]['pBuyType']=(string)$v['price_status'];
            $data[$k]['pImgURL']=(string)URL.$v['img'];
            $class=M('class')->where(array('class_id'=>$v['class_id']))->find();
            if($class['type']!=3){
                $data[$k]['isOrganization']='0';
            }else{
                $data[$k]['isOrganization']='1';
            }
            $data[$k]['signUpNum']=(string)$v['number'];
            $heard=strstr($_SERVER['HTTP_USER_AGENT'],'(',true);
            if($heard=='TCCM_WYK/4.0.1 ' || $heard=='TCCM_WYK/4.0.1'){
                $data[$k]['oldPrice']='0';
                $data[$k]['currentPrice']='0';
            }else{
                $data[$k]['oldPrice']=(string)$v['money'];      //原价
                if($v['price_status']==0){
                    $data[$k]['currentPrice']=(string)$v['money']; //折扣价
                }else{
                    $data[$k]['currentPrice']=(string)$v['discount_money']; //折扣价
                }
            }
            $data[$k]['groupBuyNum']=(string)$v['group_num'];
            $data[$k]['groupBuyEndTime']=(string)date('Y年m月d日 H:i:s',$V['group_time']);

        }
        $this->templateApi($data,'200','ok');

    }

    //pc热门推荐   直播
    public function pc_recommend_liveb(){
        $goods=M('goods');
        $where['type']=array('IN','1,6');
        $where['recommend']='1';
        $where['del_status']=0;
        $goodrel=$goods->where($where)->limit(5)->select();
        foreach($goodrel as $k=>$v){
            $data[$k]['pid']=(string)$v['goods_id'];
            $data[$k]['pName']=(string)$v['name'];
            $data[$k]['pType']=(string)$v['type'];
            $data[$k]['pBuyType']=(string)$v['price_status'];
            $data[$k]['pImgURL']=(string)URL.$v['img'];
            $class=M('class')->where(array('class_id'=>$v['class_id']))->find();
            if($class['type']!=3){
                $data[$k]['isOrganization']='0';
            }else{
                $data[$k]['isOrganization']='1';
            }
            $data[$k]['signUpNum']=(string)$v['number'];
            $heard=strstr($_SERVER['HTTP_USER_AGENT'],'(',true);
            if($heard=='TCCM_WYK/4.0.1 ' || $heard=='TCCM_WYK/4.0.1'){
                $data[$k]['oldPrice']='0';
                $data[$k]['currentPrice']='0';
            }else{
                $data[$k]['oldPrice']=(string)$v['money'];      //原价
                if($v['price_status']==0){
                    $data[$k]['currentPrice']=(string)$v['money']; //折扣价
                }else{
                    $data[$k]['currentPrice']=(string)$v['discount_money']; //折扣价
                }
            }
            $data[$k]['liveStartTime']=(string)date('Y年m月d日 H:i:s',$v['starttime']);
            $data[$k]['liveTime']=(string)round(($v['endtime']-$v['starttime'])/60);
            $data[$k]['endSaleTime']=(string)date('Y年m月d日 H:i:s',$vp['sign_endtime']);

        }
        $this->templateApi($data,'200','ok');
    }

    //pc 最新上架
    public function newclass(){
        $goods=M('goods');
        $goodrel=$goods->where(array('del_status'=>'0'))->order('time desc')->limit(5)->select();
        foreach($goodrel as $k=>$v){
            $data[$k]['pid']=(string)$v['goods_id'];
            $data[$k]['pName']=(string)$v['name'];
            $data[$k]['sonClassAmount']=(string)$v['classhour'];
            $data[$k]['openSaleTime']=(string)date('Y年m月d日 H:i:s',$v['grounding_time']);
            $data[$k]['endSetClassTime']=(string)date('Y年m月d日 H:i:s',$v['endtime']);
            $data[$k]['pType']=(string)$v['type'];
            $data[$k]['pBuyType']=(string)$v['price_status'];
            if($v['img']){
                $data[$k]['pImgURL']=(string)URL.$v['img'];
            }else{
                $data[$k]['pImgURL']='';
            }

            $class=M('class')->where(array('class_id'=>$v['class_id']))->find();
            if($class['type']!=3){
                $data[$k]['isOrganization']='0';
            }else{
                $data[$k]['isOrganization']='1';
            }
            $data[$k]['signUpNum']=(string)$v['number'];
            $data[$k]['oldPrice']=(string)$v['money'];
            if($v['price_status']==0){
                $data[$k]['currentPrice']=(string)$v['money'];
            }else{
                $data[$k]['currentPrice']=(string)$v['discount_money'];
            }

            $data[$k]['groupBuyNum']=(string)$v['group_num'];
            $data[$k]['groupBuyEndTime']=(string)date('Y年m月d日 H:i:s',$V['group_time']);
            $data[$k]['liveStartTime']=(string)date('Y年m月d日 H:i:s',$v['starttime']);
            $data[$k]['liveEndBuyTime']=(string)date('Y年m月d日 H:i:s',$vp['sign_endtime']);
            $data[$k]['liveTime']=(string)round(($v['endtime']-$v['starttime'])/60);

        }
        $this->templateApi($data,'200','ok');
    }

    //pc首页接口  1.0.4
    public function cateclass(){
        $cate=M('category');
        $onewhere['pid']=0;
        $onewhere['cate_id']=array('neq',1);
        $onecate=$cate->where($onewhere)->select();
        $data=array();
        foreach($onecate as $k=>$v){
            $data[$k]['classACId'] = $v['cate_id'];
            $data[$k]['classAName'] = $v['name'];
            $data[$k]['classB']=array();
            $cateid=(string)$v['cate_id'];
            $twocate=$cate->where(array('pid'=>$v['cate_id']))->select();
            foreach($twocate as $kk=>$vv){
                $data[$k]['classB'][$kk]['classBId']=$vv['cate_id'];
                $data[$k]['classB'][$kk]['classBName']=$vv['name'];
                $cateid.=','.$vv['cate_id'];
                $threecate=$cate->where(array('pid'=>$vv['cate_id']))->select();
                foreach($threecate as $key=>$val){
                    $cateid.=','.$val['cate_id'];
                }
            }
            $where['cate_id']=array('IN',$cateid);
            $where['type']=array('IN','2,3');
            $where['status']=0;
            $where['del_status']=0;
            $good=M('goods')->where($where)->limit(8)->select();
            $date=array();
            foreach($good as $kk=>$vv){
                $date[$kk]['pid']=$vv['goods_id'];
                $date[$kk]['pName']=$vv['name'];
                $date[$kk]['sonClassAmount']=$vv['classhour'];
                $date[$kk]['openSaleTime']=date('Y年m月d日 H:i:s',$vv['grounding_time']);
                $date[$kk]['endSetClassTime']=date('Y年m月d日 H:i:s',$vv['endtime']);
                $date[$kk]['pType']=$vv['type'];
                $date[$kk]['pBuyType']=$vv['price_status'];
                $date[$kk]['pImgURL']=URL.$vv['img'];
                $class=M('class')->where(array('class_id'=>$vv['class_id']))->find();
                if($class['type']!=3){
                    $date[$kk]['isOrganization']='0';
                }else{
                    $date[$kk]['isOrganization']='1';
                }
                $date[$kk]['signUpNum']=$vv['number'];
                $date[$kk]['oldPrice']=$vv['money'];
                if($vv['price_status']==0){
                    $date[$kk]['currentPrice']=$vv['money'];
                }else{
                    $date[$kk]['currentPrice']=$vv['discount_money'];
                }
                $date[$kk]['groupBuyNum']=$vv['group_num'];
                $date[$kk]['groupBuyEndTime']=date('Y年m月d日 H:i:s',$vv['group_time']);
            }
            $data[$k]['data']=$date;
        }

        $this->templateApi($data,'200','ok');
    }

    //首页分类下面的直播数据
    public function cateclass_liveb(){
        $cateId=I('post.cId');
        $cate=M('category');
        $onecate=$cate->where(array('cate_id'=>$cateId))->find();
        $cateid='';
        $cateid.=$onecate['cate_id'];
        $twocate=$cate->where(array('pid'=>$onecate['cate_id']))->select();
        foreach($twocate as $kk=>$vv){
            $cateid.=','.$vv['cate_id'];
            $threecate=$cate->where(array('pid'=>$vv['cate_id']))->select();
            foreach($threecate as $key=>$val){
                $cateid.=','.$val['cate_id'];
            }
        }
        $where['cate_id']=array('IN',$cateid);
        $where['type']=array('IN','1,6');
        $where['del_status']=0;
        $good=M('goods')->where($where)->limit(8)->select();
        foreach($good as $kk=>$vv){
            $data[$kk]['pid']=(string)$vv['goods_id'];
            $data[$kk]['pName']=(string)$vv['name'];
            $data[$kk]['pType']=(string)$vv['type'];
            $data[$kk]['pBuyType']=(string)$vv['price_status'];
            $data[$kk]['pImgURL']=(string)URL.$vv['img'];
            $class=M('class')->where(array('class_id'=>$vv['class_id']))->find();
            if($class['type']!=3){
                $data[$kk]['isOrganization']='0';
            }else{
                $data[$kk]['isOrganization']='1';
            }
            $data[$kk]['signUpNum']=(string)$vv['number'];
            $data[$kk]['oldPrice']=(string)$vv['money'];
            if($vv['price_status']==0){
                $data[$kk]['currentPrice']=(string)$vv['money'];
            }else{
                $data[$kk]['currentPrice']=(string)$vv['discount_money'];
            }

            $data[$kk]['liveStartTime']=(string)date('Y年m月d日 H:i:s',$vv['starttime']);
            $data[$kk]['liveTime']=(string)round(($vv['endtime']-$vv['starttime'])/60);
            $data[$kk]['endSaleTime']=(string)date('Y年m月d日 H:i:s',$vv['sign_endtime']);
        }
        $this->templateApi($data,'200','ok');
    }

    //首页分类下面的视频数据
    public function cateclass_video(){
        $cateId=I('post.cId');
        $cate=M('category');
        $onecate=$cate->where(array('cate_id'=>$cateId))->find();
        $cateid='';
        $cateid.=$onecate['cate_id'];
        $twocate=$cate->where(array('pid'=>$onecate['cate_id']))->select();
        foreach($twocate as $kk=>$vv){
            $cateid.=','.$vv['cate_id'];
            $threecate=$cate->where(array('pid'=>$vv['cate_id']))->select();
            foreach($threecate as $key=>$val){
                $cateid.=','.$val['cate_id'];
            }
        }
        $where['cate_id']=array('IN',$cateid);
        $where['type']=array('IN','3,4');
        $where['del_status']=0;
        $good=M('goods')->where($where)->limit(8)->select();
        foreach($good as $kk=>$vv){
            $data[$kk]['pid']=(string)$vv['goods_id'];
            $data[$kk]['pName']=(string)$vv['name'];
            $data[$kk]['sonClassAmount']=(string)$vv['classhour'];
            $data[$kk]['openSaleTime']=(string)date('Y年m月d日 H:i:s',$vv['grounding_time']);
            $data[$kk]['endSetClassTime']=(string)date('Y年m月d日 H:i:s',$vv['endtime']);
            $data[$kk]['pType']=(string)$vv['type'];
            $data[$kk]['pBuyType']=(string)$vv['price_status'];
            $data[$kk]['pImgURL']=(string)URL.$vv['img'];
            $class=M('class')->where(array('class_id'=>$vv['class_id']))->find();
            if($class['type']!=3){
                $data[$kk]['isOrganization']='0';
            }else{
                $data[$kk]['isOrganization']='1';
            }
            $data[$kk]['signUpNum']=(string)$vv['number'];
            $data[$kk]['oldPrice']=(string)$vv['money'];
            if($vv['price_status']==0){
                $data[$kk]['currentPrice']=(string)$vv['money'];

            }else{
                $data[$kk]['currentPrice']=(string)$vv['discount_money'];

            }
            $data[$kk]['groupBuyNum']=(string)$vv['group_num'];
            $data[$kk]['groupBuyEndTime']=(string)date('Y年m月d日 H:i:s',$vv['group_time']);
        }
        $this->templateApi($data,'200','ok');
    }

    //pc猜你喜欢

    public function youlike(){
        $type=I('post.type');
        $good=M('goods');
        if($type=='0'){
            $where['type']=array('IN','3,4');
        }else{
            $where['type']=array('IN','1,6');
        }
        $where['del_status']=0;
        $where['status']=0;
        $goodrel=$good->where($where)->limit(3)->field('goods_id,name,price_status,money,discount_money,img')->select();
        foreach($goodrel as $k=>$v){
            $data['data'][$k]['pid']=$v['goods_id'];
            $data['data'][$k]['pName']=$v['name'];
            if($v['price_status']==0){
                $data['data'][$k]['price']=$v['money'];
            }else{
                $data['data'][$k]['price']=$v['discount_money'];
            }
            $data['data'][$k]['imgURL']=URL.$v['img'];
        }
        $this->templateApi($data,'200','ok');
    }
	
}
