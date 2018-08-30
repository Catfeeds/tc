<?php

namespace  Api\Controller;
use Think\Controller;
header('Content-Type:text/json;charset=utf-8');
header("Access-Control-Allow-Origin: *");
class ProveController extends CommonController {

    //教师认证
    public function index(){
        if(IS_POST){
            $token=I('post.token');         //用户token
            $name=I('post.name');           //用户姓名
            $idCardNo=I('post.idCardNo');   //身份证号
            $phoneNo=I('post.phoneNo');     //手机号
            $email=I('post.email');         //邮箱
            $userType=I('post.userType');   //身份
            $smallClass=I('post.smallClass');   //二级分类id
            $schoolName=I('post.schoolName');   //学校名称
            $schoolNum=I('post.schoolNum');     //学号
            $gdTime=I('post.gdTime');           //毕业时间
            $outfitNname=I('post.outfitNname'); //机构名称
            $outfitintroduce=I('post.outfitintroduce');     //机构介绍
            $outfitAddress=I('post.outfitAddress');         //机构地址
            $outfitphone=I('post.outfitphone');             //机构电话
            $photofront=I('post.photofront');               //身份证正面照片url
            $photoback=I('post.photoback');         //身份证反面照片url
            $photohold=I('post.photohold');         //手持身份证照片url
            $photocertify=I('post.photocertify');   //证明照片url

            if($token==''||$name==''||$idCardNo==''||$phoneNo==''||$email==''||$userType==''||$photofront==''||$photoback==''||$photohold==''||$photocertify==''){
                $this->templateApi('','204','缺少参数');exit;
            }
            if($userType=='0'){
                if($schoolName==''||$schoolNum==''||$gdTime==''){
                    $this->templateApi('','204','缺少参数');exit;
                }
            }else if($userType=='3'){
                if($outfitNname==''||$outfitintroduce==''||$outfitAddress==''||$outfitphone==''){
                    $this->templateApi('','204','缺少参数');exit;
                }
            }
            $userrel=M('user')->where(array('token'=>$token))->find();
            if($userrel){
                $prove=M('prove');
                $mvp=array(
                    'uid'   =>  $userrel['user_id'],
                    'name'  =>  $name,
                    'cardnum'   =>  $idCardNo,
                    'photofront'=>  $photofront,
                    'photoback' =>  $photoback,
                    'photohold' =>  $photohold,
                    'photocertify'  =>  $photocertify,
                    'status'    =>  '0',
                    'time'      =>  time(),
                    'phone'     =>  $phoneNo,
                    'cate_id'   =>  $smallClass,
                    'email'     =>  $email,
                    'identity'  =>  $userType
                );
                if($userType=='0'){
                    $mvp['school_name']=$schoolName;
                    $mvp['school_num']=$schoolNum;
                    $mvp['gd_time']=$gdTime;
                }else if($userType=='3'){
                    $mvp['outfit_name']=$outfitNname;
                    $mvp['outfit_introduce']=$outfitintroduce;
                    $mvp['outfit_address']=$outfitAddress;
                    $mvp['outfit_phone']=$outfitphone;
                }
                $rel=$prove->add($mvp);
                if($rel){
                    $this->templateApi('','200','ok');
                }else{
                    $this->templateApi('','202','err');
                }
            }else{
                $this->templateApi('','300','token过期');
            }

        }else{
            $this->templateApi('','203','请求类型错误');
        }
    }

    //查询资质证明
    public function selprove(){
        if(IS_POST){
            $token=I('post.token');
            if($token==''){
                $data=(object)null;
                echo json_encode($this->apiTemplate($data,'204','参数错误'));
            }else{
                $userrel=M('user')->where(array('token'=>$token))->find();
                if($userrel){
                    $prove=M('prove');
                    $proverel=$prove->where('uid='.$userrel['user_id'])->order('time desc')->find();
                    if($proverel){
                        if($proverel['status']=='0'){
                            $data['status']='1';
//                            $data['opinion']='';
                            echo json_encode($this->apiTemplate($data,'200','ok'));
                        }else if($proverel['status']=='1'){
                            $data['status']='2';
//                            $data['opinion']='';
                            echo json_encode($this->apiTemplate($data,'200','ok'));
                        }else{
                            $data['status']='3';
//                            $data['opinion']=$proverel['opinion'];
                            echo json_encode($this->apiTemplate($data,'200','ok'));
                        }
                    }else{
                        $data['status']='0';
//                        $data['opinion']='';
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
}