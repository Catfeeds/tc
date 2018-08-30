<?php
/**********************************
 *
 * 时间：2017年10月27日
 * 功能：搜索
 * 作者：Mr Peng
 *
 **********************************/ 
namespace Api\Controller;
use Think\Controller;
header('Content-Type:text/json;charset=utf-8');
header("Access-Control-Allow-Origin: *");
class SearchController extends CommonController {

// +----------------------------------------------------------------------
// | 功能       | 热门搜索
// +----------------------------------------------------------------------
// | 请求类型   | 
// +----------------------------------------------------------------------
// | 参数       | 
// +----------------------------------------------------------------------
    public function hotsearch(){
        $search=M('search');
        $data=$search->order('number desc')->field('name')->limit(10)->select();
        echo json_encode($this->apiTemplate($data,'200','ok'));
    }

// +----------------------------------------------------------------------
// | 功能       | 内容搜索
// +----------------------------------------------------------------------
// | 请求类型   | GET
// +----------------------------------------------------------------------
// | 参数       | content
// +----------------------------------------------------------------------
    public function index(){
        if(IS_GET){
            $content=I('get.content');
            if($content==''){
                $data=(object)null;
                echo json_encode($this->apiTemplate($data,'204','参数错误'));exit;
            }
            // 根据搜索内容添加到搜索表
            $search=M('search');
            $rel=$search->where(array('name'=>$content))->find();
            // 判断搜索表有没有数据，有则搜索次数+1 ，没有则创建
            if($rel){
                $mvp['number']=$rel['number']+1;
                $search->where('search_id='.$rel['search_id'])->save($mvp);
            }else{
                $mvp['name']=$content;
                $mvp['number']=1;
                $search->add($mvp);
            }

            $good=M('goods');
            $where['name']=array('like','%'.$content.'%');
            $where['endtime']=array('gt',time());
            $where['type']=array('IN','1,6');
            $where['status']=0;
            $where['del_status']=0;
            $list=$good->where($where)->limit(4)->select();
            foreach($list as $key=>$val){
                $date[$key]['pImgURL']=URL.$val['img'];
                $date[$key]['pid']=(string)$val['goods_id'];
                $date[$key]['pName']=$val['name'];
                $date[$key]['pType']=(string)$val['type'];
                $class=M('class')->where(array('class_id'=>$val['class_id']))->find();
                if($class['type']==3){
                    $date[$key]['isOrganization']='1';
                }else{
                    $date[$key]['isOrganization']='0';
                }
                $date[$key]['recommend']=(string)$val['recommend'];
                $date[$key]['signUpNum']=(string)$val['number'];
                $date[$key]['pBuyType']=(string)$val['price_status'];
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
                $date[$key]['starttime']=date('Y-m-d H:i:s',$val['starttime']);


            }
            $data[0]['name']='直播';
            $data[0]['img']='';
            if(empty($date)){
                $data[0]['arr']=array();
            }else{
                $data[0]['arr']=$date;
            }
            $where1['name']=array('like','%'.$content.'%');
            $where1['type']=array('IN','2,3,4');
            $where1['status']=0;
            $where1['del_status']=0;
            $list2=$good->where($where1)->limit(4)->select();
            foreach($list2 as $key=>$val){
                $date2[$key]['pImgURL']=URL.$val['img'];
                $date2[$key]['pid']=(string)$val['goods_id'];
                $date2[$key]['pName']=$val['name'];
                $date2[$key]['pType']=(string)$val['type'];
                $class=M('class')->where(array('class_id'=>$val['class_id']))->find();
                if($class['type']==3){
                    $date2[$key]['isOrganization']='1';
                }else{
                    $date2[$key]['isOrganization']='0';
                }
                $date2[$key]['recommend']=(string)$val['recommend'];
                $date2[$key]['signUpNum']=(string)$val['number'];
                $date2[$key]['pBuyType']=(string)$val['price_status'];
                $heard=strstr($_SERVER['HTTP_USER_AGENT'],'(',true);
                if($heard=='TCCM_WYK/4.0.1 ' || $heard=='TCCM_WYK/4.0.1'){
                    $date2[$key]['oldPrice']='0';
                    $date2[$key]['currentPrice']='0';
                }else{
                    $date2[$key]['oldPrice']=(string)$val['money'];      //原价
                    if($val['price_status']==0){
                        $date2[$key]['currentPrice']=(string)$val['money']; //折扣价
                    }else{
                        $date2[$key]['currentPrice']=(string)$val['discount_money']; //折扣价
                    }
                }
            }
            $data[1]['name']='视频';
            $data[1]['img']='';
            if(empty($date2)){
                $data[1]['arr']=array();
            }else{
                $data[1]['arr']=$date2;
            }
            echo json_encode($this->apiTemplate($data,'200','ok'));
        }else{
            $data=(object)null;
            echo json_encode($this->apiTemplate($data,'203','请求类型错误'));
        }
        
    }



// +----------------------------------------------------------------------
// | 功能       | 查看更多
// +----------------------------------------------------------------------
// | 请求类型   | GET
// +----------------------------------------------------------------------
// | 参数       | type、content、page、sort
// +----------------------------------------------------------------------
    public function details(){
        if(IS_GET){
            $type=I('get.type');                        //获取类型  0：直播   1：视频
            $content=I('get.content');                  //获取搜索的内容
            $page=I('get.page');                        //获取页数
            $sort=I('get.sort');                        //获取排序条件
            if($page==''||$content==''||$page==''||$sort==''){
                $data=(object)null;
                echo json_encode($this->apiTemplate($data,'204','参数错误'));exit;
            }
//            $data=$this->havePage('goods',$where,'',$page,'8','');
            // 设置配置文件
            $config['page']=$page;                      //设置页数
            $config['num']=20;                         //设置每页显示条数  别改
            $config['tablename']='goods';
            // 判断查询的类型
            $where['status']=0;
            $where['del_status']=0;
            if($type=='0'){
                $config['field']='';
                $time=time();
                $where['name']=array('like','%'.$content.'%');
                $where['endtime']=array('gt',$time);
                $where['type']=array('IN','1,6');
                $config['where']=$where;
                $a='0';
            }else if($type=='1'){
                $config['field']='';
                $where['name']=array('like','%'.$content.'%');
                $where['type']=array('IN','2,3');
                $config['where']=$where;
                $a='1';
            }else{
                $data=(object)null;
                echo json_encode($this->apiTemplate($data,'204','参数错误'));exit;
            }

            $count=M('goods')->where($where)->count();
            // 判断排序

            if($sort=='1'){
                $config['order']='number desc';
            }else if($sort=='2'){
                $config['order']='money asc';
            }else if($sort=='3'){
                $config['order']='money desc';
            }else{
                $config['order']='';
            }
            // 实例化分页类
            $ppp = new \Org\Util\Page($config);
            // 执行查询操作
            $data= $ppp->get();
            // 当前页数和总页数复制给$pie，并清空$data里面的
            $pie['now_page']=$data['now_page'];
            $pie['total_page']=$data['total_page'];
            unset($data['now_page']);
            unset($data['total_page']);
            // 遍历$data img拼接上域名
            foreach($data as $key=>$val){
                $date[$key]['pImgURL']=URL.$val['img'];
                $date[$key]['pid']=$val['goods_id'];
                $date[$key]['pName']=$val['name'];
                $date[$key]['signUpNum']=(string)$val['number'];
                $date[$key]['classhour']=(string)$val['classhour'];
                $date[$key]['time']=date('Y年m月d日 H:i:s',$val['grounding_time']);
                $date[$key]['starttime']=date('Y年m月d日 H:i:s',$val['starttime']);
                $date[$key]['sonClassAmount']=(string)$val['classhour'];
                $date[$key]['openSaleTime']=date('Y-m-d H:i:s',$val['grounding_time']);
                $date[$key]['pType']=(string)$val['type'];
                $date[$key]['pBuyType']=(string)$val['price_status'];
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
                $date[$key]['recommend']=(string)$val['recommend'];
                $date[$key]['openSaleTime']=date('Y-m-d H:i:s',$val['grounding_time']);
                $date[$key]['sonClassAmount']=(string)$val['classhour'];
                $class=M('class')->where(array('class_id'=>$val['class_id']))->find();
                $udrel=M('userdata')->where(array('uid'=>$class['uid']))->find();
                if($class['type']!=3){
                    $date[$key]['isOrganization']='0';
                }else{
                    $date[$key]['isOrganization']='1';
                }
                $date[$key]['teacherName']=$class['name'];
                $date[$key]['teacherImg']=URL.$udrel['image'];
                $date[$key]['endSaleTime']=(string)date('Y年m月d日 H:i:s',$val['sign_endtime']);
                $date[$key]['liveTime']=(string)round(($val['endtime']-$val['starttime'])/60);

            }
            if(empty($date)){
                $rel['list']=array();
            }else{
                $rel['list']=$date;
            }
            $rel['now_page']=$pie['now_page'];
            $rel['total_page']=$pie['total_page'];
            $rel['count']=$count;
            echo json_encode($this->apiTemplate($rel,'200','ok'));

        }else{
            $data=(object)null;
            echo json_encode($this->apiTemplate($data,'203','请求类型错误'));
        }
    }

    //搜索店铺
    public function searchclass(){
        if(IS_POST){
            $content=I('post.content');                 //搜索内容
            $page=I('post.pageNum');                    //页数
            if($content==''||$page==''){
                $this->templateApi('','204','参数错误');exit;
            }
            $where['name']=array('like','%'.$content.'%');
            $count=M('class')->where($where)->count;
            $data=$this->havePage('class',$where,'',$page,'20','');
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
                $isappo=M('goods')->where(array('class_id'=>$v['class_id'],'status'=>'0','type'=>'5'))->find();
                if($isappo){
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
                        $date[$k]['hotProduct'][$kk]['pType']=$vv['type'];
                    }
                    if(count($goods)==1){
                        $date[$k]['hotProduct'][]=array(
                            'pId'   =>  '',
                            'imgURL'=>  URL.'/user/public_zwkc.png',
                            'pType' =>  ''
                        );
                    }
                }else{
                    $date[$k]['hotProduct']=array(
                        array(
                            'pId'   =>  '',
                            'imgURL'=>  URL.'/user/public_zwkc.png',
                            'pType' =>  ''
                        ),
                        array(
                            'pId'   =>  '',
                            'imgURL'=>  URL.'/user/public_zwkc.png',
                            'pType' =>  ''
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

    //pc搜索  直播
    public function pcliveb(){
        if(IS_POST){
            $content=I('post.content');                 //搜索内容
            $page=I('post.pageNum');                    //页数
            if($content==''||$page==''){
                $this->templateApi('','204','参数错误');exit;
            }
            // 根据搜索内容添加到搜索表
            $search=M('search');
            $rel=$search->where(array('name'=>$content))->find();
            // 判断搜索表有没有数据，有则搜索次数+1 ，没有则创建
            if($rel){
                $mvp['number']=$rel['number']+1;
                $search->where('search_id='.$rel['search_id'])->save($mvp);
            }else{
                $mvp['name']=$content;
                $mvp['number']=1;
                $search->add($mvp);
            }

            $good=M('goods');
            $where['name']=array('like','%'.$content.'%');
            $where['endtime']=array('gt',time());
            $where['type']=array('IN','1,6');
            $where['status']=0;
            $where['del_status']=0;
            $count=M('goods')->where($where)->count();
            $data=$this->havePage('goods',$where,'',$page,'20','');
            $pie['now_page']=$data['now_page'];
            $pie['total_page']=$data['total_page'];
            unset($data['now_page']);
            unset($data['total_page']);
            foreach($data as $key=>$val){
                $date[$key]['pImgURL']=URL.$val['img'];
                $date[$key]['pid']=(string)$val['goods_id'];
                $date[$key]['pName']=$val['name'];
                $date[$key]['pType']=(string)$val['type'];
                $date[$key]['introduce']=$val['introduce'];
                $date[$key]['pBuyType']=(string)$val['price_status'];
                $date[$key]['oldPrice']=(string)$val['money'];
                $date[$key]['currentPrice']=(string)$val['discount_money'];
                $date[$key]['starttime']=date('Y-m-d H:i:s',$val['starttime']);

            }
            if(empty($date)){
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

    //pc搜索  视频
    public function pcvideo(){
        if(IS_POST){
            $content=I('post.content');                 //搜索内容
            $page=I('post.pageNum');                    //页数
            if($content==''||$page==''){
                $this->templateApi('','204','参数错误');exit;
            }
            // 根据搜索内容添加到搜索表
            $search=M('search');
            $rel=$search->where(array('name'=>$content))->find();
            // 判断搜索表有没有数据，有则搜索次数+1 ，没有则创建
            if($rel){
                $mvp['number']=$rel['number']+1;
                $search->where('search_id='.$rel['search_id'])->save($mvp);
            }else{
                $mvp['name']=$content;
                $mvp['number']=1;
                $search->add($mvp);
            }

            $good=M('goods');
            $where['name']=array('like','%'.$content.'%');
            $where['type']=array('IN','2,3,4');
            $where['status']=0;
            $where['del_status']=0;
            $count=M('goods')->where($where)->count();
            $data=$this->havePage('goods',$where,'',$page,'20','');
            $pie['now_page']=$data['now_page'];
            $pie['total_page']=$data['total_page'];
            unset($data['now_page']);
            unset($data['total_page']);
            foreach($data as $key=>$val){
                $date[$key]['pImgURL']=URL.$val['img'];
                $date[$key]['pid']=(string)$val['goods_id'];
                $date[$key]['pName']=$val['name'];
                $date[$key]['pType']=(string)$val['type'];
                $date[$key]['introduce']=$val['introduce'];
                $date[$key]['pBuyType']=(string)$val['price_status'];
                $date[$key]['oldPrice']=(string)$val['money'];
                $date[$key]['currentPrice']=(string)$val['discount_money'];
                $date[$key]['grounding_time']=date('Y-m-d H:i:s',$val['grounding_time']);

            }
            if(empty($date)){
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
    
}