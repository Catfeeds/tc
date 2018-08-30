<?php
/******************************
 *
 * 时间：2018年8月1日
 * 功能：三期首页
 * 作者：Mr Peng
 *
 *****************************/
namespace Api\Controller;
use Think\Controller;
header('Content-Type:text/json;charset=utf-8');
header("Access-Control-Allow-Origin: *");
class ThreeindexController extends CommonController {
    //首页轮播
    public function sowingmap(){
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
        $this->templateApi($data,'200','ok');
    }

    //首页除正在直播，轮播图，
    public function index(){
        $category=M('category');
        $categorylist=$category->where(array('pid'=>'0','cate_id'=>array('neq','1')))->select();

        //导航
        $data['btnInfo']=array(
            array(
                'titleBig'  =>  'K12教学',
                'imgURL'    =>  URL.'/user/public_mfzq.png',
            ),
            array(
                'titleBig'  =>  '高等教育',
                'imgURL'    =>  URL.'/user/public_hdzq.png',
            ),
            array(
                'titleBig'  =>  '考研教学',
                'imgURL'    =>  URL.'/user/public_jfsc.png',
            ),
            array(
                'titleBig'  =>  '全部课程',
                'imgURL'    =>  URL.'/user/public_jszb.png',
            ),
            array(
                'titleBig'  =>  '免费优课',
                'imgURL'    =>  URL.'/user/public_mfzq.png',
            ),
            array(
                'titleBig'  =>  '教育咨询',
                'imgURL'    =>  URL.'/user/public_hdzq.png',
            ),
            array(
                'titleBig'  =>  '活动中心',
                'imgURL'    =>  URL.'/user/public_jfsc.png',
            ),
            array(
                'titleBig'  =>  '我要讲课',
                'imgURL'    =>  URL.'/user/public_jszb.png',
            )
        );
        //教育机构
        $class=M('class');
        $classrel=$class->where(array('type'=>3))->limit(2)->select();
        $data['organization']['icon']='http://p.wyueke.com/Uploads/icon/3.png';
        $data['organization']['title']='教育机构';
        foreach($classrel as $k=>$v){
            $data['organization']['data'][$k]['sid']=(string)$v['class_id'];
            $data['organization']['data'][$k]['img']=URL.$v['img'];
            $data['organization']['data'][$k]['name']=$v['name'];
            //机构下老师姓名
            $data['organization']['data'][$k]['teachername']=D('Class')->teachername($v['class_id']);
            //机构下销量最高的两门课
            $data['organization']['data'][$k]['classname']=D('Class')->maxsaleclass($v['class_id']);
            //人气
            $data['organization']['data'][$k]['popularity']=(string)M('follow')->where(array('class_id'=>$v['class_id']))->count();
            //好评率
            $commentzong=M('comment')->where(array('class_id'=>$v['class_id']))->count();//评论总数
            $commenthao=M('comment')->where(array('class_id'=>$v['class_id'],'star'=>array('IN','4,5')))->count();//好评条数
            $data['organization']['data'][$k]['praise']=(string)intval($commenthao/$commentzong*100).'%';
            //销量
            $number=M('goods')->where(array('class_id'=>$v['class_id']))->field('number')->select();
            $sale=0;
            foreach($number as $kk=>$vv){
                $sale+=$vv['number'];
            }
            $data['organization']['data'][$k]['sale']=(string)$sale;
        }
        //课程专区
        $goods=M('goods');
        $category=M('category');
        $onecate=$category->where(array('pid'=>'0','cate_id'=>array('neq','1')))->select();
        $cates=array();
        foreach($onecate as $k=>$v){
            $data['productArea'][$k]['icon']='http://p.wyueke.com/Uploads/icon/3.png';
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
                $date[$key]['liveEndBuyTime']=(string)date('Y-m-d H:i:s',$val['starttime']);
                $date[$key]['liveTime']=(string)round(($val['endtime']-$val['starttime'])/60);

            }

            $re_good=$goods
                ->where(array('recommend'=>'1','status'=>'0','del_status'=>'0'))
                ->field('goods_id,name,classhour,price_status,grounding_time,endtime,type,img,class_id,number,money,discount_money,group_num,group_time,starttime,sign_endtime')
                ->limit(4)
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
                'icon'      =>  'http://p.wyueke.com/Uploads/icon/1.png',
                'title'     =>  '热门课程',
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
    //首页正在直播
    public function liveb(){
        $page=I('page');
        if($page==''){
            $this->templateApi('','204','参数错误');exit;
        }
        $where['type']=array('IN','1,6');
        $where['liveb_status']=1;
        $count=M('goods')->where($where)->count();
        $data=$this->havePage('goods',$where,'',$page,'2','');
        $pie['now_page']=$data['now_page'];
        $pie['total_page']=$data['total_page'];
        unset($data['now_page']);
        unset($data['total_page']);
        foreach($data as $k=>$v){
            $date[$k]['pid']=(string)$v['goods_id'];
            $date[$k]['img']=URL.$v['img'];
            $date[$k]['pType']=(string)$v['type'];
        }
        $acc['icon']='http://p.wyueke.com/Uploads/icon/3.png';
        $acc['title']='正在直播';
        if($date){
            $acc['liveb']=$date;
        }else{
            $acc['liveb']=array();
        }
        $acc['now_page']=$pie['now_page'];
        $acc['total_page']=$pie['total_page'];
        $acc['count']=$count;
        $this->templateApi($acc,'200','ok');
    }

    //名师讲堂
    public function teacher(){
        if(IS_POST){
            $cid=I('post.cId');                         //分类id
            $isAppointment=I('post.isAppointment');     //是否按可预约排序
            $isPopular=I('post.isPopular');             //是否按人气排序
            $page=I('post.pageNum');                    //页数
            if($cid==''||$isAppointment==''||$isPopular==''){
                $this->templateApi('','204','参数错误');exit;
            }
            $cate=M('category');
            $caterel=$cate->where(array('pid'=>$cid))->select();
            foreach($caterel as $k=>$v){
                $cid.=','.$v['cate_id'];
            }
            $where['cate_id']=array('IN',$cid);
            if($isAppointment=='0'){

            }else{
                $where['order_status']='1';
            }
            if($isPopular=='0'){
                $order='';
            }else{
                $order='follow_num desc';
            }
            $where['type']=array('IN','0,1,2');
            $count=M('class')->where($where)->count();
            $data=$this->havePage('class',$where,$order,$page,'20','');
            $pie['now_page']=$data['now_page'];
            $pie['total_page']=$data['total_page'];
            unset($data['now_page']);
            unset($data['total_page']);
            foreach($data as $k=>$v){
                $date[$k]['sId']=$v['class_id'];
                $udrel=M('userdata')->where(array('uid'=>$v['uid']))->find();
                $tuser=M('user')->where(array('user_id'=>$v['uid']))->find();
                $date[$k]['img']=URL.$v['img'];
                $date[$k]['name']=$v['name'];
                $date[$k]['lv']=$v['grade'];   //0不能直播   1能直播
//                if($v['type']==3){
//                    $date[$k]['isOrganization']='1';
//                }else{
//                    $date[$k]['isOrganization']='0';
//                }


                if($v['teachername']){
                    $date[$k]['teachername']=$v['teachername'];
                }else{
                    $date[$k]['teachername']='';
                }

                //好评率
                $cmmentzong=M('comment')->where(array('class_id'=>$v['class_id']))->count();//评论总数
                $commenthao=M('comment')->where(array('class_id'=>$v['class_id'],'star'=>array('IN','4,5')))->count();//好评条数
                $date[$k]['praise']=(string)intval($commenthao/$commentzong*100).'%';
                //销量
                $number=M('goods')->where(array('class_id'=>$v['class_id']))->field('number')->select();
                $sale=0;
                foreach($number as $kk=>$vv){
                    $sale+=$vv['number'];
                }
                $date[$k]['sale']=(string)$sale;
                $isappo=M('goods')->where(array('class_id'=>$v['class_id'],'status'=>'0','type'=>'5','del_status'=>'0','endtime'=>array('gt',time())))->find();
                if($isappo){
                    $date[$k]['isAppointment']='1';
                }else{
                    $date[$k]['isAppointment']='0';
                }
                $date[$k]['shopInfo']=(string)$v['introduce'];
                $date[$k]['followNum']=(string)$v['follow_num'];
                $goods=M('goods')
                    ->where(array('class_id'=>$v['class_id'],'del_status'=>'0','status'=>'0'))
                    ->limit(2)
                    ->order('number desc')
                    ->field('goods_id,img,price_status,type,name')
                    ->select();
                if($goods){
                    foreach($goods as $kk=>$vv){
                        $date[$k]['hotProduct'][$kk]['pid']=$vv['goods_id'];
                        $date[$k]['hotProduct'][$kk]['imgURL']=URL.$vv['img'];
                        $date[$k]['hotProduct'][$kk]['pType']=$vv['type'];
                        $date[$k]['hotProduct'][$kk]['pName']=$vv['name'];
                    }
                    if(count($goods)==1){
                        $date[$k]['hotProduct'][]=array(
                            'pId'   =>  '',
                            'imgURL'=>  URL.'/user/public_zwkc.png',
                            'pType' =>  '',
                            'pName' =>  ''
                        );
                    }
                }else{
                    $date[$k]['hotProduct']=array(
                        array(
                            'pId'   =>  '',
                            'imgURL'=>  URL.'/user/public_zwkc.png',
                            'pType' =>  '',
                            'pName' =>  ''
                        ),
                        array(
                            'pId'   =>  '',
                            'imgURL'=>  URL.'/user/public_zwkc.png',
                            'pType' =>  '',
                            'pName' =>  ''
                        )
                    );
                }
            }
            if(empty($data)){
                $acc['data']=array();
            }else{
                $acc['data']=$date;
            }
            $acc['now_page']=$pie['now_page'];
            $acc['total_page']=$pie['total_page'];
            $acc['count']=$count;
            $this->templateApi($acc,'200','ok');
        }else{
            $this->templateApi('','203','请求类型错误');
        }

    }

    //教育机构
    public function organization(){
        if(IS_POST){
            $cid=I('post.cId');                         //分类id
            $isAppointment=I('post.isAppointment');     //是否按可预约排序
            $isPopular=I('post.isPopular');             //是否按人气排序
            $page=I('post.pageNum');                    //页数
            if($cid==''||$isAppointment==''||$isPopular==''){
                $this->templateApi('','204','参数错误');exit;
            }
            $cate=M('category');
            $caterel=$cate->where(array('pid'=>$cid))->select();
            foreach($caterel as $k=>$v){
                $cid.=','.$v['cate_id'];
            }
            $where['cate_id']=array('IN',$cid);
            if($isAppointment=='0'){

            }else{
                $where['order_status']='1';
            }
            if($isPopular=='0'){
                $order='';
            }else{
                $order='follow_num desc';
            }
            $where['type']=3;
            $count=M('class')->where($where)->count();
            $data=$this->havePage('class',$where,$order,$page,'20','');
            $pie['now_page']=$data['now_page'];
            $pie['total_page']=$data['total_page'];
            unset($data['now_page']);
            unset($data['total_page']);
            foreach($data as $k=>$v){
                $date[$k]['sId']=$v['class_id'];
                $udrel=M('userdata')->where(array('uid'=>$v['uid']))->find();
                $tuser=M('user')->where(array('user_id'=>$v['uid']))->find();
                $date[$k]['img']=URL.$v['img'];
                $date[$k]['name']=$v['name'];
                $date[$k]['lv']=$v['grade'];   //0不能直播   1能直播
//                if($v['type']==3){
//                    $date[$k]['isOrganization']='1';
//                }else{
//                    $date[$k]['isOrganization']='0';
//                }


                $date[$k]['teachername']=D('Class')->teachername($v['class_id']);

                //好评率
                $cmmentzong=M('comment')->where(array('class_id'=>$v['class_id']))->count();//评论总数
                $commenthao=M('comment')->where(array('class_id'=>$v['class_id'],'star'=>array('IN','4,5')))->count();//好评条数
                $date[$k]['praise']=(string)intval($commenthao/$commentzong*100).'%';
                //销量
                $number=M('goods')->where(array('class_id'=>$v['class_id']))->field('number')->select();
                $sale=0;
                foreach($number as $kk=>$vv){
                    $sale+=$vv['number'];
                }
                $date[$k]['sale']=(string)$sale;
                $isappo=M('goods')->where(array('class_id'=>$v['class_id'],'status'=>'0','type'=>'5','del_status'=>'0','endtime'=>array('gt',time())))->find();
                if($isappo){
                    $date[$k]['isAppointment']='1';
                }else{
                    $date[$k]['isAppointment']='0';
                }
                $date[$k]['shopInfo']=(string)$v['introduce'];
                $date[$k]['followNum']=(string)$v['follow_num'];
                $goods=M('goods')
                    ->where(array('class_id'=>$v['class_id'],'del_status'=>'0','status'=>'0'))
                    ->limit(2)
                    ->order('number desc')
                    ->field('goods_id,img,price_status,type,name')
                    ->select();
                if($goods){
                    foreach($goods as $kk=>$vv){
                        $date[$k]['hotProduct'][$kk]['pid']=$vv['goods_id'];
                        $date[$k]['hotProduct'][$kk]['imgURL']=URL.$vv['img'];
                        $date[$k]['hotProduct'][$kk]['pType']=$vv['type'];
                        $date[$k]['hotProduct'][$kk]['pName']=$vv['name'];
                    }
                    if(count($goods)==1){
                        $date[$k]['hotProduct'][]=array(
                            'pId'   =>  '',
                            'imgURL'=>  URL.'/user/public_zwkc.png',
                            'pType' =>  '',
                            'pName' =>  ''
                        );
                    }
                }else{
                    $date[$k]['hotProduct']=array(
                        array(
                            'pId'   =>  '',
                            'imgURL'=>  URL.'/user/public_zwkc.png',
                            'pType' =>  '',
                            'pName' =>  ''
                        ),
                        array(
                            'pId'   =>  '',
                            'imgURL'=>  URL.'/user/public_zwkc.png',
                            'pType' =>  '',
                            'pName' =>  ''
                        )
                    );
                }
            }
            if(empty($data)){
                $acc['data']=array();
            }else{
                $acc['data']=$date;
            }
            $acc['now_page']=$pie['now_page'];
            $acc['total_page']=$pie['total_page'];
            $acc['count']=$count;
            $this->templateApi($acc,'200','ok');
        }else{
            $this->templateApi('','203','请求类型错误');
        }
    }

    //正在直播查看更多
    public function livebmore(){
        if (IS_POST) {
            $cId = I('post.cId');                 //分类id
            $isHot = I('post.isHot');             // 是否人气优先     ，0：非  1：是
            $orderPrice = I('post.orderPrice');   // 价格排序  0：低到高     1：高到低
            $pageNum = I('post.pageNum');         //页数
            if ($cId == '' || $isHot == '' || $pageNum == '') {
                $this->templateApi('', '204', '参数错误');
                exit;
            }

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

            $where['cate_id']=array('IN',$cId);
            $where['type']=array('IN','1,6');
            $where['status']=0;
            $where['liveb_status']=1;


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
//                $isOrganization = M('class')->where(array('class_id' => $v['class_id']))->field('uid,name,type,class_id')->find();
//                $goodlist[$k]['sid']=(string)$isOrganization['class_id'];
//                $goodlist[$k]['teacherName']=(string)$isOrganization['name'];
//                $udrel=M('userdata')->where(array('uid'=>$isOrganization['uid']))->find();
//                $goodlist[$k]['teacherImg']=(string)$udrel['image'];
//                if ($isOrganization['type'] == 3) {
//                    $goodlist[$k]['isOrganization'] = '1';   //是否机构上传   是
//                } else {
//                    $goodlist[$k]['isOrganization'] = '0';   //是否机构上传   否
//                }
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
}