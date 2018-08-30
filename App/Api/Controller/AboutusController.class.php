<?php
/******************************
 *
 * 时间；2017年12月5日
 * 功能：关于我们
 * 作者：Mr Peng
 *
 *****************************/ 
namespace Api\Controller;
use Think\Controller;
header('Content-Type:text/json;charset=utf-8');
header("Access-Control-Allow-Origin: *");
class AboutusController extends CommonController {

    //关于我们
	public function index(){
        $about=M('aboutus');
        $rel=$about->where('aboutus_id=6')->order('time desc')->find();
        $rel['time']=date('Y-m-d H:i',$rel['time']);
        if($rel){

            $data['introduce']=$rel;
            $data['url']='@wyueke.com';
            echo json_encode($this->apiTemplate($data,'200','ok'));
        }else{
            $data=(object)null;
            echo json_encode($this->apiTemplate($data,'202','失败'));
        }
       
	}

    //安卓——更新迭代
    public function apk_update(){
        $apk=M('apk');
        $result=$apk->order('time desc')->find();
        if($result){
            $date['version']=$result['version'];
            $date['download']=$result['download'];
            $date['status']=$result['status'];
            $date['versioncode']=(integer)$result['versioncode'];
            $date['versionsize']=$result['versionsize'];
        }else{
            $date=(object)null;
        }
        echo json_encode($this->apiTemplate($date,'200','ok'));


    }
}