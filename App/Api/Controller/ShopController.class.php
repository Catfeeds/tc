<?php
/******************************
 *
 * 时间；2018年8月23日
 * 功能：店铺
 * 作者：Mr Peng
 *
 *****************************/
namespace Api\Controller;
use Think\Controller;
header('Content-Type:text/json;charset=utf-8');
header("Access-Control-Allow-Origin: *");
class ShopController extends CommonController {

    //店铺详情页
    public function details(){
        if(IS_POST){
            $token=I('post.token');     //用户token
            $sid=I('post.sid');         //店铺id
            if(!$sid){
                if(!$token){
                    $this->templateApi('','204','参数错误');exit;
                }else{
                    $user=M('user')->where(array('token'=>$token))->find();
                    $class=M('class')->where(array('uid'=>$user['user_id']))->find();
                    if($class){
                        $data=array(
                            'sid'       =>  $class['class_id'],     //店铺id
                            'name'      =>  $class['name'],         //店铺id
                            'introduce' =>  $class['introduce'],    //店铺介绍
                            'popularity'=>  $class['follow_num'],   //人气
                            'grade'     =>  $class['grade'],        //店铺等级
                            'bg_img'    =>  URL.$class['bg_img'],   //店铺背景图片
                            'bg_img_status' =>  $class['new_bg_img_allow'], //背景图片审核状态  0：待审核   1：通过   2：拒绝
                            'link'      =>  $class['link'],         //分享链接
                            'address'   =>  $class['address'],      //地址
                        );
                        $data['follow_status']='';
                        if($class['type']==3){
                            $data['isOrganization']='1';            //是否机构  1：是 0：不是
                            $data['identity']='3';      //身份，1：普通老师  2：机构老师  3:机构负责人
                        }else{
                            $data['isOrganization']='0';
                            if($class['o_id']){
                                $data['identity']='2';
                            }else{
                                $data['identity']='1';
                            }

                        }
                        $data['img_status']=$class['new_face_allow'];   //头像审核状态
                        if($class['new_face_allow']==0){
                            $data['img']=URL.$class['new_face'];    //如何有待审核的头像，显示待审核的头像
                        }else{
                            $data['img']=URL.$class['img'];         //没有带审核的头像，显示原头像
                        }
                        $rel=$data;
                        $this->templateApi($rel,'200','ok');exit;
                    }else{
                        $this->templateApi('','202','您还没有店铺');
                    }
                }

            }
            if($token){
                $user=M('user')->where(array('token'=>$token))->find();
            }

            $class=M('class')->where(array('class_id'=>$sid))->find();
            //判断是不是本人的店铺，本人的展示老师端，非本人展示学生端
            if($user['user_id']==$class['uid']){
                //本人
                $data=array(
                    'sid'       =>  $class['class_id'],     //店铺id
                    'name'      =>  $class['name'],         //店铺id
                    'introduce' =>  $class['introduce'],    //店铺介绍
                    'popularity'=>  $class['follow_num'],   //人气
                    'grade'     =>  $class['grade'],        //店铺等级
                    'bg_img'    =>  URL.$class['bg_img'],   //店铺背景图片
                    'bg_img_status' =>  $class['new_bg_img_allow'], //背景图片审核状态  0：待审核   1：通过   2：拒绝
                    'link'      =>  $class['link'],         //分享链接
                    'address'   =>  $class['address'],      //地址
                );
                $data['follow_status']='';
                if($class['type']==3){
                    $data['isOrganization']='1';            //是否机构  1：是 0：不是
                    $data['identity']='3';      //身份，0:学生  1：普通老师  2：机构老师  3:机构负责人
                }else{
                    $data['isOrganization']='0';
                    if($class['o_id']){
                        $data['identity']='2';
                    }else{
                        $data['identity']='1';
                    }
                }
                $data['img_status']=$class['new_face_allow'];   //头像审核状态
                if($class['new_face_allow']==0){
                    $data['img']=URL.$class['new_face'];    //如何有待审核的头像，显示待审核的头像
                }else{
                    $data['img']=URL.$class['img'];         //没有带审核的头像，显示原头像
                }


            }else{
                //非本人
                $data=array(
                    'sid'       =>  $class['class_id'],     //店铺id
                    'name'      =>  $class['name'],         //店铺名
                    'introduce' =>  $class['introduce'],    //店铺简介
                    'popularity'=>  $class['follow_num'],   //店铺人气
                    'grade'     =>  $class['grade'],        //店铺等级   1：可以直播  0：不可以直播
                    'link'      =>  $class['link'],         //分享链接
                    'img'       =>  URL.$class['img'],      //店铺头像
                    'bg_img'    =>  URL.$class['bg_img'],   //店铺背景图片
                    'bg_img_status' =>  '',
                    'address'   =>  $class['address'],      //地址

                );
                if($class['type']==3){
                    $data['isOrganization']='1';            //是否机构  1：是  0：不是
                }else{
                    $data['isOrganization']='0';
                }
                $data['identity']='0';
                if($user){
                    $follow=M('follow')->where(array('uid'=>$user['user_id'],'class_id'=>$sid))->find();
                    if($follow){
                        $data['follow_status']='1';         //关注状态   1：已关注   0：未关注
                    }else{
                        $data['follow_status']='0';
                    }
                }else{
                    $data['follow_status']='';
                }
                $data['img_status']='';   //头像审核状态

            }
            $rel=$data;
            $this->templateApi($rel,'200','ok');
        }else{
            $this->templateApi('','203','请求类型错误');
        }
    }

    //老师店铺的视频列表
    public function videolist(){
        if(IS_POST){
            $sid=I('post.sid');                 //店铺id
            $cId=I('post.cId');                 //分类id
            $isHot=I('post.isHot');             // 是否人气优先     ，0：非  1：是
            $orderPrice=I('post.orderPrice');   // 价格排序  0：低到高     1：高到低
            $pageNum=I('post.pageNum');         //页数
            $token=I('post.token');             //用户token
            $type=I('post.type');               //类型   空：全部视频  0：单课  1：套课
            if($cId==''||$isHot==''||$pageNum==''||$sid==''){
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
            //分类筛选
            $where['cate_id']=array('IN',$cId);
            //课程类型筛选
            if($type=='0'){
                $where['type']=array('IN','2');
            }else if($type=='1'){
                $where['type']=array('IN','3');
            }else{
                $where['type']=array('IN','2,3');
            }
            //上架筛选
            $where['status']=0;
            //店铺id筛选
            $whrre['class_id']=$sid;

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

    //老师店铺的直播列表
    public function liveblist(){
        if(IS_POST){
            $sid=I('post.sid');                 // 店铺id
            $cId=I('post.cId');                 // 分类id
            $isHot=I('post.isHot');             // 是否人气优先     ，0：非  1：是
            $orderPrice=I('post.orderPrice');   // 价格排序  0：低到高     1：高到低
            $pageNum=I('post.pageNum');         // 页数
            $livebing=I('post.livebing');       // 是否直播中   0：否  1：是
            if($cId==''||$isHot==''||$pageNum==''||$livebing==''){
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

            $where['cate_id']=array('IN',$cId);
            $where['type']=array('IN','1,6');
            $where['status']=0;
            $where['endtime']=array('gt',time());
            $where['class_id']=$sid;
            if($livebing=='0'){
                $where['liveb_status']=0;
            }else if($livebing=='1'){
                $where['liveb_status']=1;
            }else{

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
                $goodlist[$k]['livebstatus']=(string)$v['liveb_status'];        //直播状态  0：未开播  1：正在直播
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

    //老师店铺的预约课列表
    public function yuelist(){
        if(IS_POST){
            $sid=I('post.sid');                 //店铺id
            $cId=I('post.cId');                 //分类id
            $orderPrice=I('post.orderPrice');   //价格排序  0：低到高     1：高到低
            $time=I('post.time');               //时间排序   0：近期优先    1：远期优先
            $pageNum=I('post.pageNum');         //页数
            if($cId==''||$pageNum==''){
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

            $where['cate_id']=array('IN',$cId);
            $where['type']=array('IN','5');
            $where['endtime']=array('gt',time());
            $where['class_id']=$sid;
            $where['status']=0;


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
//                $class=M('class')->where(array('class_id'=>$v['class_id']))->find();
//                $date[$k]['teacherimg']=URL.$class['img'];
//                $date[$k]['teachername']=$class['name'];
//                if($class['type']==3){
//                    $date[$k]['isOrganization']='1';
//                }else{
//                    $date[$k]['isOrganization']='0';
//                }
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

    //修改店铺资料
    public function shop_edit(){
        if(IS_POST){
            $token=I('post.token');
            $sid=I('post.sid');
            $img=I('post.img');
            $name=I('post.name');
            $introduce=I('post.introduce');
            $bg_img=I('post.bg_img');
            if($token==''||$sid==''){
                $this->templateApi('','204','参数错误');exit;
            }
            $user=M('user')->where(array('token'=>$token))->find();
            if($user){
                $class=M('class')->where(array('class_id'=>$sid))->find();
                if($user['user_id']==$class['uid']){
                    if($img){
                        $mvp['new_face']=$img;
                        $mvp['new_face_allow']=0;
                    }
                    if($name)$mvp['name']=$name;
                    if($introduce)$mvp['introduce']=$introduce;
                    if($bg_img){
                        $mvp['new_bg_img']=$bg_img;
                        $mvp['new_bg_img_allow']=0;
                    }
                    M('class')->where(array('class_id'=>$class['class_id']))->save($mvp);
                    $this->templateApi('','200','ok');
                }else{
                    $this->templateApi('','202','禁止修改');
                }
            }else{
                $this->templateApi('','300','未登录');
            }
        }else{
            $this->templateApi('','203','请求类型错误');
        }
    }

    //输入手机号查询该老师是否可以被关联
    public function relationstatus(){
        if(IS_POST){
            $phone=I('post.phone');
            if($phone==''){
                $this->templateApi('','204','参数错误');exit;
            }
            $user=M('user')->where(array('phone'=>$phone))->find();
            if($user){
                $this->templateApi('','202','err');
            }else{
                $this->templateApi('','200','ok');
            }
        }else{
            $this->templateApi('','203','请求类型错误');
        }
    }

    //关联老师
    public function relationteacher(){
        if(IS_POST){
            $token=I('post.token');
            $phone=I('post.phone');
            $verify=I('post.verify');
            $pass=md5(md5(I('post.pass')));
            if($token==''||$phone==''||$verify==''||$pass==''){
                $this->templateApi('','204','参数错误');exit;
            }
            $user=M('user');
            $class=M('class');
            $userrel=$user->where(array('token'=>$token))->find();
            $t_userrel=$user->where(array('phone'=>$phone))->find();
            $reg=S($phone);
            if(!$reg || $reg!=$verify){
                $this->templateApi('','202','验证码错误');exit;
            }
            if($userrel){
                if($t_userrel){
                    $this->templateApi('','202','禁止绑定');
                }else{
                    $classrel=$class->where(array('uid'=>$userrel['user_id']))->find();
                    //添加用户信息
                    $mvp=array(
                        'phone'     =>  $phone,
                        'pass'      =>  $pass,
                        'time'      =>  time(),
                        'name'      =>  $this->getRandomString(8),
                        'token'     =>  md5($phone.$this->getRandomString(16)),
                    );
                    $useradd=$user->add($mvp);
                    //添加用户附属信息
                    $userdata=M('userdata');
                    $msc['uid']=$useradd;
                    $msc['image']='/user/public_morentouxiang.png';
                    $msc['integral']=100;
                    $userdata->add($msc);
                    //添加class信息
                    $mmp=array(
                        'uid'       =>  $useradd,
                        'name'      =>  $mvp['name'],
                        'img'       =>  '/user/public_morentouxiang.png',
                        'o_id'      =>  $classrel['class_id'],
                        'teachername'   =>  $mvp['name'],
                        'teacherimg'    =>  '/user/public_morentouxiang.png',
                    );
                    $class->add($mmp);


                }
                $this->templateApi('','200','ok');
            }else{
                $this->templateApi('','300','未登录');
            }
        }else{
            $this->templateApi('','203','请求类型错误');
        }
    }

    //关联老师列表
    public function relationlist(){
        if(IS_POST){
            $token=I('post.token');
            if($token==''){
                $this->templateApi('','204','参数错误');exit;
            }
            $user=M('user')->where(array('token'=>$token))->find();
            if($user){
                $class=M('class')->where(array('uid'=>$user['user_id']))->find();
                $classlist=M('class')->where(array('o_id'=>$class['class_id']))->select();
                foreach($classlist as $k=>$v){
                    $data[$k]['teacherid']=$v['class_id'];
                    $data[$k]['teachername']=$this->emptyString($v['teachername']);
                    $data[$k]['teacherimg']=URL.$this->emptyString($v['teacherimg']);
                    $data[$k]['teacherintroduce']=$this->emptyString($v['teacherintroduce']);
                }
                $this->templateApi($data,'200','ok');
            }else{
                $this->templateApi('','300','未登录');
            }
        }else{
            $this->templateApi('','203','请求类型错误');
        }
    }

    //取消关联
    public function removegl(){
        if(IS_POST){
            $token=I('post.token');
            $teacherid=I('teacherid');
            if($token==''||$teacherid==''){
                $this->templateApi('','204','参数错误');exit;
            }
            $user=M('user')->where(array('token'=>$token))->find();
            if($user){
                $class=M('class')->where(array('uid'=>$user['user_id']))->find();
                $tclass=M('class')->where(array('class_id'=>$teacherid))->find();
                if($tclass){
                    $mvp['o_id']='';
                    M('class')->where(array('class_id'=>$teacherid))->save($mvp);
                    $this->templateApi($data,'200','ok');
                }else{
                    $this->emptyString('','204','参数错误');
                }

            }else{
                $this->templateApi('','300','未登录');
            }
        }else{
            $this->templateApi('','203','请求类型错误');
        }
    }
}