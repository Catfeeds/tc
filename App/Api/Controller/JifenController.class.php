<?php
namespace Api\Controller;
use Think\Controller;
header('Content-Type:text/json;charset=utf-8');
header("Access-Control-Allow-Origin: *");
class JifenController extends CommonController {


    //pc积分商城
    public function pcindex(){
        $good=M('good')->where(array('pc'=>1))->order('num')->select();
        foreach($good as $k=>$v){
            $data[$k]['img']=URL.$v['img'];
            $data[$k]['name']=$v['name'];
            $data[$k]['details']=$v['details'];
            $data[$k]['price']=$v['price'];
            $data[$k]['gid']=$v['good_id'];
        }
        $this->templateApi($data,'200','ok');
    }

// +----------------------------------------------------------------------
// | 功能       | 轮播表
// +----------------------------------------------------------------------
// | 请求类型   | 
// +----------------------------------------------------------------------
// | 参数       | 
// +----------------------------------------------------------------------  
  public function lunbo(){
      $lunbo=D('good');
      $lunbolist=$lunbo->limit(4)->field('good_id,img,type')->select();
       if($lunbolist){
            foreach($lunbolist as $k=>$v){
                $lunbolist[$k]['img']=URL.$v['img'];
            }
            $data['list'] = $lunbolist;
            echo json_encode($this->apiTemplate($data,'200','ok'));
        }else{
            $data=(object)null;
            echo json_encode($this->apiTemplate($data,'203','no'));
        }
  }


// +----------------------------------------------------------------------
// | 功能       | 积分商城热门兑奖专区
// +----------------------------------------------------------------------
// | 请求类型   | 
// +----------------------------------------------------------------------
// | 参数       | 
// +----------------------------------------------------------------------    
	public function index(){
        $token=I('post.token');
        if($token==''){
            $this->templateApi('','204','参数错误');exit;
        }


        $lunbo=D('good');
        $lunbolist=$lunbo->limit(4)->field('good_id,img')->select();
        if($lunbolist){
            foreach($lunbolist as $k=>$v){
                $lunbolist[$k]['img']=URL.$v['img'];
            }
            $data['lunbo'] = $lunbolist;

        }else{
            $data['lunbo']=array();
        }
        $user=M('user');
        $userrel=$user->where(array('token'=>$token))->find();
        if($userrel){
            if($userrel['vip_endtime']<time()){
                $dovip['is_vip']=0;
                M('user')->where(array('user_id'=>$userrel['user_id']))->save($dovip);
            }
            $userdata=D('userdata');
            $jifen=$userdata->field('integral')->where('uid='.$userrel['user_id'])->find();
            $data['jifen']=$jifen;
        }else{
            $this->templateApi('','300','未登录');exit;
        }
        $good=D('good');
        $goodlist1=$good->where('type=1')->order('num')->limit(3)->select();
        $goodlist2=$good->where('type=2')->order('num')->limit(3)->select();
        $data['remen']['imgURL']=URL.'/user/remenzhuanqu.png';
        foreach($goodlist1 as $k=>$v){
            $data['remen']['data'][$k]['img']=URL.$v['img'];
            $data['remen']['data'][$k]['good_id']=(string)$v['good_id'];
        }
        $data['changeykb']['img']=URL.'/user/jifenduihuanyuekebin.jpg';
        $data['duijiang']['imgURL']=URL.'/user/duijiangzhuanqu.png';
        foreach($goodlist2 as $k=>$v){
            $data['duijiang']['data'][$k]['img']=URL.$v['img'];
            $data['duijiang']['data'][$k]['good_id']=(string)$v['good_id'];
        }
        echo json_encode($this->apiTemplate($data,'200','ok'));
    }
// +----------------------------------------------------------------------
// | 功能       | 我的积分
// +----------------------------------------------------------------------
// | 请求类型   | post
// +----------------------------------------------------------------------
// | 参数       |token
// +----------------------------------------------------------------------   
    public function jifen(){
      if(IS_POST){
            $token=I('post.token');
            if($token==''){
                $data=(object)null;
                echo json_encode($this->apiTemplate($data,'204','参数错误'));
            }else{
                $user=M('user');
                $userrel=$user->where(array('token'=>$token))->find();
                if($userrel){
                    if($userrel['vip_endtime']<time()){
                        $dovip['is_vip']=0;
                        M('user')->where(array('user_id'=>$userrel['user_id']))->save($dovip);
                    }
                    $userdata=D('userdata');
                    $jifen=$userdata->field('integral')->where('uid='.$userrel['user_id'])->find();
                    $integral=D('integral');
                    $jilu=$integral->where('uid='.$userrel['user_id'])->order('time desc')->select();
                    foreach ($jilu as $k=>$v){
                        $jilu[$k]['time']=date('Y-m-d H:i',$v['time']);
                    }
                    $yuekebi=1000;
                    $rel['jilu']=$jilu;
                    $rel['jifen']=$jifen;
                    $rel['bili']=$yuekebi;
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
// | 功能       | 兑换记录
// +----------------------------------------------------------------------
// | 请求类型   | post
// +----------------------------------------------------------------------
// | 参数       | token
// +----------------------------------------------------------------------   
    public function duihuanjilu(){
      if(IS_POST){
            $token=I('post.token');
            if($token==''){
                $data=(object)null;
                echo json_encode($this->apiTemplate($data,'204','参数错误'));
            }else{
                $user=M('user');
                $userrel=$user->where(array('token'=>$token))->find();
                if($userrel){
                    if($userrel['vip_endtime']<time()){
                        $dovip['is_vip']=0;
                        M('user')->where(array('user_id'=>$userrel['user_id']))->save($dovip);
                    }
                    $iere=D('ierecord');
                    $rel=$iere->table('good as g,ierecord as i')->field('i.*,g.name,g.img,g.details')->where('i.uid='.$userrel['user_id'].' and i.gid=g.good_id')->order('time desc')->select();
                     foreach($rel as $k=>$v){
                         $date[$k]['record_id']=(string)$v['idrecord_id'];    //兑换记录id
                         $date[$k]['name']=$v['name'];                //标题
                         $date[$k]['money']=(string)$v['money'];    //扣除多少积分
                         $date[$k]['introduce']=$v['details'];      //商品介绍
                         $date[$k]['num']=$v['num'];                //交易号
                         $date[$k]['img']=URL.$v['img'];
                         $date[$k]['time']=date('Y-m-d H:i:s',$v['time']);
                         $date[$k]['status']=$v['status'];
                    }
                    if($date){
                        $data['list']=$date;
                        echo json_encode($this->apiTemplate($data,'200','ok'));
                    }else{
                        $data['list']=array();
                        $this->templateApi($data,'200','ok');
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
// | 功能       | 商品详情
// +----------------------------------------------------------------------
// | 请求类型   | post
// +----------------------------------------------------------------------
// | 参数       | gid
// +----------------------------------------------------------------------  
   public function good(){
        $gid=I('post.gid');
        $good=D('good');
        $goodlist=$good->where('good_id='.$gid)->find();
        if($goodlist){
            $goodlist['img']=URL.$goodlist['img'];
           /* if($goodlist['price']>1000){
                $goodlist['price']=($goodlist['price']/1000).'k';
            }*/
            if($goodlist['type_id']==5){
                $goodlist['dummy']='1';
            }else{
                $goodlist['dummy']='0';
            }
            echo json_encode($this->apiTemplate($goodlist,'200','ok'));
        }else{
            $data=(object)null;
            echo json_encode($this->apiTemplate($data,'203','no'));
        }
   }

// +----------------------------------------------------------------------
// | 功能       | 商品分类
// +----------------------------------------------------------------------
// | 请求类型   | 
// +----------------------------------------------------------------------
// | 参数       | 
// +----------------------------------------------------------------------   
    public function fenlei(){
      $type=D('type');
      $typelist=$type->limit(5)->select();
      if($typelist){
            $data['list']=$typelist;
            echo json_encode($this->apiTemplate($data,'200','ok'));
        }else{
            $data=(object)null;
            echo json_encode($this->apiTemplate($data,'203','no'));
        }
    }

// +----------------------------------------------------------------------
// | 功能       | 分类下商品
// +----------------------------------------------------------------------
// | 请求类型   | POST
// +----------------------------------------------------------------------
// | 参数       | type_id
// +----------------------------------------------------------------------   
    public function leipin(){
     if(IS_POST){
            $type_id=I('post.type_id');
            if($type_id==''){
                $data=(object)null;
                echo json_encode($this->apiTemplate($data,'204','参数错误'));
            }else{
                $good=M('good');
                $goodrel=$good->where(array('type_id'=>$type_id))->select();

                if($goodrel){
                    foreach($goodrel as $k=>$v){
                        $goodrel[$k]['img']=URL.$v['img'];
                        /*if($goodrel[$k]['price']>1000){
                           $goodrel[$k]['price']=($v['price']/1000).'k';
                        }*/
                    }
                    $data['list']=$goodrel;
                    echo json_encode($this->apiTemplate($data,'200','ok'));
                }else{
                    $data['list']=array();
                    $this->templateApi($data,'200','ok');
                }
            }
        }else{
            $data=(object)null;
            echo json_encode($this->apiTemplate($data,'203','请求类型错误'));
        }
    }

    //查询用户是否有默认地址
    public function seladdress(){
        if(IS_POST){
            $token=I('post.token');
            if($token==''){
                $this->templateApi('','204','参数错误');exit;
            }
            $user=M('user')->where(array('token'=>$token))->find();
            if($user){
                if($user['vip_endtime']<time()){
                    $dovip['is_vip']=0;
                    M('user')->where(array('user_id'=>$user['user_id']))->save($dovip);
                }
                $address=M('address')->where(array('uid'=>$user['user_id'],'status'=>'1'))->find();
                if($address){
                    $data['status']='1';
                    $data['address_id']=$address['address_id'];
                }else{
                    $data['status']='0';
                }
                $this->templateApi($data,'200','ok');
            }else{
                $this->templateApi('','300','未登录');
            }
        }else{
            $this->templateApi('','203','请求类型错误');
        }
    }

// +----------------------------------------------------------------------
// | 功能       | 兑换地址
// +----------------------------------------------------------------------
// | 请求类型   | POST
// +----------------------------------------------------------------------
// | 参数       | token
// +----------------------------------------------------------------------   
     public function address(){
      if(IS_POST){
            $token=I('post.token');
            if($token==''){
                $data=(object)null;
                echo json_encode($this->apiTemplate($data,'204','参数错误'));
            }else{
                $user=M('user');
                $userrel=$user->where(array('token'=>$token))->find();
                if($userrel){
                    if($userrel['vip_endtime']<time()){
                        $dovip['is_vip']=0;
                        M('user')->where(array('user_id'=>$userrel['user_id']))->save($dovip);
                    }
                    $address=D('address');
                    $rel=$address->where('uid='.$userrel['user_id'])->order('status desc')->select();
                    if($rel){
                        foreach($rel as $k=>$v){
                            $date[$k]['address_id']=(string)$v['address_id'];
                            $date[$k]['address']=(string)$v['address'];
                            $date[$k]['phone']=(string)$v['phone'];
                            $date[$k]['name']=(string)$v['name'];
                            $date[$k]['province']=$v['province'];
                            $date[$k]['city']=$v['city'];
                            $date[$k]['area']=$v['area'];
                            $date[$k]['status']=(string)$v['status'];
                        }
                        $this->templateApi($date,'200','ok');
                    }else{
                         $data=(object)null;
                        echo json_encode($this->apiTemplate($data,'200','ok'));
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

    //地址列表（安卓
    public function address_Android(){
        if(IS_POST){
            $token=I('post.token');
            if($token==''){
                $data=(object)null;
                echo json_encode($this->apiTemplate($data,'204','参数错误'));
            }else{
                $user=M('user');
                $userrel=$user->where(array('token'=>$token))->find();
                if($userrel){
                    if($userrel['vip_endtime']<time()){
                        $dovip['is_vip']=0;
                        M('user')->where(array('user_id'=>$userrel['user_id']))->save($dovip);
                    }
                    $address=D('address');
                    $rel=$address->where('uid='.$userrel['user_id'])->order('status desc')->select();
                    if($rel){
                        foreach($rel as $k=>$v){
                            $date[$k]['address_id']=(string)$v['address_id'];
                            $date[$k]['address']=(string)$v['address'];
                            $date[$k]['phone']=(string)$v['phone'];
                            $date[$k]['name']=(string)$v['name'];
                            $date[$k]['province']=$v['province'];
                            $date[$k]['city']=$v['city'];
                            $date[$k]['area']=$v['area'];
                            $date[$k]['status']=(string)$v['status'];
                        }
                        $pac['data']=$date;
                        $this->templateApi($pac,'200','ok');
                    }else{
                        $data=(object)null;
                        echo json_encode($this->apiTemplate($data,'200','ok'));
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
// | 功能       | 添加兑换地址
// +----------------------------------------------------------------------
// | 请求类型   | POST
// +----------------------------------------------------------------------
// | 参数       | token uname phone name
// +----------------------------------------------------------------------  
    public function addaddress(){
      if(IS_POST){
            $token=I('post.token');
            $name=I('post.name');
            $phone=I('post.phone');
            $address=I('post.address');
            $province=I('post.province');       //省
            $city=I('post.city');               //市
            $area=I('post.area');               //区
            if($token==''||$name==''||$phone==''||$address==''||$city==''){
                $this->templateApi('','204','参数错误');
            }else{
                $user=M('user');
                $userrel=$user->where(array('token'=>$token))->find();
                if($userrel){
                    if($userrel['vip_endtime']<time()){
                        $dovip['is_vip']=0;
                        M('user')->where(array('user_id'=>$userrel['user_id']))->save($dovip);
                    }
                    $mvp['name']=$name;
                    $mvp['phone']=$phone;
                    $mvp['province']=$province;
                    $mvp['city']=$city;
                    $mvp['area']=$area;
                    $mvp['uid']=$userrel['user_id'];
                    $mvp['address']=$address;
                    $rel=M('address')->add($mvp);
                    $this->templateApi('','200','ok');
                }else{
                    $this->templateApi('','300','未登录');
                }
            }
        }else{
            $data=(object)null;
            echo json_encode($this->apiTemplate($data,'203','请求类型错误'));
        }
    }
// +----------------------------------------------------------------------
// | 功能       | 修改兑换地址
// +----------------------------------------------------------------------
// | 请求类型   | POST
// +----------------------------------------------------------------------
// | 参数       | token uname phone name
// +----------------------------------------------------------------------   
     public function xiuaddress(){
      if(IS_POST){
            $token=I('post.token');
            $name=I('post.name');
            $phone=I('post.phone');
          $province=I('post.province');       //省
          $city=I('post.city');               //市
          $area=I('post.area');               //区
            $address=I('post.address');
            $id=I('post.address_id');
            if($token==''||$id==''){
                $this->templateApi('','204','参数错误');
            }else{
                $user=M('user');
                $userrel=$user->where(array('token'=>$token))->find();
                if($userrel){
                    if($userrel['vip_endtime']<time()){
                        $dovip['is_vip']=0;
                        M('user')->where(array('user_id'=>$userrel['user_id']))->save($dovip);
                    }
                    if($name){
                        $mvp['name']=$name;
                    }
                    if($phone){
                        $mvp['phone']=$phone;
                    }
                    if($province){
                        $mvp['province']=$province;
                    }
                    if($area){
                        $mvp['area']=$area;
                    }
                    if($city){
                        $mvp['city']=$city;
                    }
                    if($address){
                        $mvp['address']=$address;
                    }
                    M('address')->where('address_id='.$id)->save($mvp);
                    $this->templateApi('','200','ok');
                }else{
                    $this->templateApi('','300','未登录');
                }
            }
        }else{
            $data=(object)null;
            echo json_encode($this->apiTemplate($data,'203','请求类型错误'));
        }
    }

    //设置默认地址
    public function defaultaddress(){
        if(IS_POST){
            $token=I('post.token');
            $id=I('post.address_id');
            if($token==''){
                $this->templateApi('','204','参数错误');exit;
            }
            $user=M('user')->where(array('token'=>$token))->find();
            if($user){
                if($user['vip_endtime']<time()){
                    $dovip['is_vip']=0;
                    M('user')->where(array('user_id'=>$user['user_id']))->save($dovip);
                }
                $address=M('address');
                $result=$address->where(array('address_id'=>$id))->find();
                $rel=$address->where(array('uid'=>$user['user_id']))->select();
                foreach($rel as $v){
                    $mvp['status']=0;
                    $address->where(array('address_id'=>$v['address_id']))->save($mvp);
                }
                if($id){
                    $mmp['status']=1;
                    $address->where(array('address_id'=>$id))->save($mmp);
                }

                $this->templateApi('','200','ok');
            }else{
                $this->templateApi('','300','未登录');
            }
        }else{
            $this->templateApi('','203','请求类型错误');
        }
    }
    //删除地址
    public function deladdress(){
        if(IS_POST){
            $token=I('post.token');
            $id=I('post.address_id');
            if($token==''||$id==''){
                $this->templateApi('','204','参数错误');exit;
            }
            $user=M('user')->where(array('token'=>$token))->find();
            if($user){
                if($user['vip_endtime']<time()){
                    $dovip['is_vip']=0;
                    M('user')->where(array('user_id'=>$user['user_id']))->save($dovip);
                }
                M('address')->where(array('address_id'=>$id))->delete();
                $this->templateApi('','200','ok');
            }else{
                $this->templateApi('','300','未登录');
            }
        }else{
            $this->templateApi('','203','请求类型错误');
        }
    }
// +----------------------------------------------------------------------
// | 功能       | 添加兑换记录
// +----------------------------------------------------------------------
// | 请求类型   | POST
// +----------------------------------------------------------------------
// | 参数       | token good_id money name
// +----------------------------------------------------------------------  
     public function addiere(){
      if(IS_POST){
            $token=I('post.token');
            $gid=I('post.good_id');
            $money=I('post.money');
            if($token==''||$gid==''){
                $data=(object)null;
                echo json_encode($this->apiTemplate($data,'204','参数错误'));
            }else{
                $iere=D('ierecord');
                $integral=D('integral');
                $user=M('user');
                $userrel=$user->where(array('token'=>$token))->find();
                if($userrel){
                    if($userrel['vip_endtime']<time()){
                        $dovip['is_vip']=0;
                        M('user')->where(array('user_id'=>$userrel['user_id']))->save($dovip);
                    }
                    $userdata=D('userdata');
                    $userlist=$userdata->field('integral')->where('uid='.$userrel['user_id'])->find();
                    if($userlist['integral']>=$money){
                        if($gid==1){    //兑换3天vip
                            if($userrel['is_vip']==0){
                                $vip['is_vip']=1;
                            }
                            if($userrel['vip_time']==null){
                                $vip['vip_time']=time();
                            }
                            if($userrel['vip_endtime']==null){
                                $vip['vip_endtime']=(time()+259200);
                            }else if($userrel['vip_endtime']<time()){
                                $vip['vip_endtime']=(time()+259200);
                            }else if($userrel['vip_endtime']>time()){
                                $vip['vip_endtime']=($userrel['vip_endtime']+259200);
                            }
                            $user->where(array('user_id'=>$userrel['user_id']))->save($vip);
                            $userdata->where('uid='.$userrel['user_id'])->setDec('integral',$money);
                            //添加兑换记录
                            $mvp['uid']=$userrel['user_id'];
                            $mvp['gid']=$gid;
                            $address=M('address')->where(array('uid'=>$userrel['user_id'],'status'=>'1'))->find();
                            $mvp['address_id']=$address['address_id'];
                            $mvp['time']=time();
                            $mvp['money']=$money;
                            $mvp['num']=$this->getRandomString(10);
                            $mvp['status']=1;
                            $iere->add($mvp);
                            //添加积分记录
                            $data['uid']=$userrel['user_id'];
                            $data['type']=2;
                            $data['source']='兑换商品';
                            $data['time']=time();
                            $data['num']=$money;
                            $integral->add($data);
                            $this->templateApi($data,'200','ok');exit;
                        }
                        if($gid==2){    //兑换30天vip
                            if($userrel['is_vip']==0){
                                $vip['is_vip']=1;
                            }
                            if($userrel['vip_time']==null){
                                $vip['vip_time']=time();
                            }
                            if($userrel['vip_endtime']==null){
                                $vip['vip_endtime']=(time()+2592000);
                            }else if($userrel['vip_endtime']<time()){
                                $vip['vip_endtime']=(time()+2592000);
                            }else if($userrel['vip_endtime']>time()){
                                $vip['vip_endtime']=($userrel['vip_endtime']+2592000);
                            }
                            $user->where(array('user_id'=>$userrel['user_id']))->save($vip);
                            $userdata->where('uid='.$userrel['user_id'])->setDec('integral',$money);
                            $address=M('address')->where(array('uid'=>$userrel['user_id'],'status'=>'1'))->find();
                            //添加兑换记录
                            $mvp['uid']=$userrel['user_id'];
                            $mvp['gid']=$gid;
                            $mvp['address_id']=$address['address_id'];
                            $mvp['time']=time();
                            $mvp['money']=$money;
                            $mvp['num']=$this->getRandomString(10);
                            $mvp['status']=1;
                            $iere->add($mvp);
                            //添加积分记录
                            $data['uid']=$userrel['user_id'];
                            $data['type']=2;
                            $data['source']='兑换商品';
                            $data['time']=time();
                            $data['num']=$money;
                            $integral->add($data);
                            $this->templateApi($data,'200','ok');exit;
                        }
                    $goodlist=D('good')->where('good_id='.$gid)->find();
                  if($goodlist['stock']!=0){  
                    $jian=$userdata->where('uid='.$userrel['user_id'])->setDec('integral',$money);
                      $jiann=D('good')->where('good_id='.$gid)->setDec('stock');
                      $address=M('address')->where(array('uid'=>$userrel['user_id'],'status'=>'1'))->find();
                    $mvp['uid']=$userrel['user_id'];
                    $mvp['gid']=$gid;
                    $mvp['address_id']=$address['address_id'];
                    $mvp['time']=time();
                    $mvp['money']=$money;
                    $mvp['num']=$this->getRandomString(10);
                    $mvp['status']=1;
                    if($mvp['gid']==0 || $mvp['gid']==null){
                         $data=(object)null;
                    echo json_encode($this->apiTemplate($data,'200','兑换失败'));exit;
                    }
                    $rel=$iere->add($mvp);
                    if($rel){

                    $data['uid']=$userrel['user_id'];
                    $data['type']=2;
                    $data['source']='兑换商品';
                    $data['time']=time();
                    $data['num']=$money;
                    $integral->add($data);
                     $data=(object)null;
                      echo json_encode($this->apiTemplate($data,'200','ok'));
                    }else{
                        $data=(object)null;
                        echo json_encode($this->apiTemplate($data,'202','添加失败')); 
                    }
                 }else{
                      $data=(object)null;
                        echo json_encode($this->apiTemplate($data,'202','库存为0')); 
                 } 
                    }else{
                        $data=(object)null;
                        echo json_encode($this->apiTemplate($data,'202','积分不足'));
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
// | 功能       | 确认收货
// +----------------------------------------------------------------------
// | 请求类型   | post
// +----------------------------------------------------------------------
// | 参数       | idrecord_id
// +---------------------------------------------------------------------- 
  public function queren(){
        $id=$_POST['idrecord_id'];
        //$token=$_POST['token'];
        if($id){
        $iere=D('ierecord');
        $mvp['status']=3;
        $que=$iere->where('idrecord_id='.$id)->save($mvp);
        $data=(object)null;
        echo json_encode($this->apiTemplate($data,'200','ok'));
        }else{
                    $data=(object)null;
                    echo json_encode($this->apiTemplate($data,'202','失败'));
                }
            }
  // +----------------------------------------------------------------------
// | 功能       | 兑换约课币
// +----------------------------------------------------------------------
// | 请求类型   | post
// +----------------------------------------------------------------------
// | 参数       | token money
// +---------------------------------------------------------------------
        public function yuekebi(){
             $token=I('post.token');
             $money=I('post.money');
             if($token==''){
                $data=(object)null;
                echo json_encode($this->apiTemplate($data,'204','参数错误'));
            }else{
                $user=M('user');
                $userrel=$user->where(array('token'=>$token))->find();
                if($userrel){
                    if($userrel['vip_endtime']<time()){
                        $dovip['is_vip']=0;
                        M('user')->where(array('user_id'=>$userrel['user_id']))->save($dovip);
                    }
                    $userdata=D('userdata');
                    $userlist=$userdata->where('uid='.$userrel['user_id'])->find();
                    if($userlist['integral']>=$money && $money>=1000){
                        $jia=$userdata->where('uid='.$userrel['user_id'])->setInc('money',$_POST['money']/1000);
                        $jian=$userdata->where('uid='.$userrel['user_id'])->setDec('integral',$_POST['money']);
                    if($jia!==false && $jian!==false){
                        $integral=D('integral');
                        $payrecord=D('payrecord');
                        $data['uid']=$userrel['user_id'];
                        $data['type']=2;
                        $data['source']='兑换约课币';
                        $data['time']=time();
                        $data['num']=$_POST['money'];
                        $rel=$integral->add($data);
                         $mvp['uid']=$userrel['user_id'];
                        $mvp['type']=1;
                        $mvp['time']=time();
                        $mvp['income']=$_POST['money']/1000;
                        $mvp['source']='兑换约课币';
                        $payrecord->add($mvp);
                        $data=(object)null;
                        echo json_encode($this->apiTemplate($data,'200','ok'));
                }else{
                      $data=(object)null;
                        echo json_encode($this->apiTemplate($data,'202','兑换失败'));
                }
                }else{
                     $data=(object)null;
                        echo json_encode($this->apiTemplate($data,'202','积分不足'));
                }
                   /* if($userlist['integral']>=$money){
                    $jian=$userdata->where('uid='.$userrel['user_id'])->setDec('integral',$money);
                    $iere=D('ierecord');
                    $mvp['uid']=$userrel['user_id'];
                    $mvp['gid']=$gid;
                    $mvp['address']=$name;
                    $mvp['time']=time();
                    $mvp['money']=$money;
                    $mvp['num']=$this->getRandomString(10);
                    $mvp['status']=1;
                    $rel=$iere->add($mvp);
                    echo json_encode($this->apiTemplate($rel,'200','ok'));
                    }else{
                        $data=(object)null;
                        echo json_encode($this->apiTemplate($data,'202','积分不足'));
                    }
                }else{
                    $data=(object)null;
                    echo json_encode($this->apiTemplate($data,'202','token过期'));
                }*/
        }else{
            $data=(object)null;
            echo json_encode($this->apiTemplate($data,'203','请求类型错误'));
        }
}
}

}