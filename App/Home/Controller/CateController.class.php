<?php
namespace Home\Controller;
use Think\Controller;
header('Content-Type:text/json;charset=utf-8');
header("Access-Control-Allow-Origin: *");
class CateController extends Controller {

	public function apiTemplate($data,$code,$message){
        $result['result']=$data;
        $result['code']=$code;
        $result['message']=$message;
        $result['time']=time();
        return $result;
    } 

	/******* 分类 *******/
    public function index(){
    	$cate_name=I('post.cate_name');
    	if($cate_name==''){
    		$data=(object)null;
    		echo json_encode($this->apiTemplate($data,'204','参数错误'));exit;
    	}

    	$category=M('category');
    	$categoryrel=$category->where(array('name'=>$cate_name,'pid'=>'0'))->find();
    	$date=$category->field('cate_id,name,img')->where(array('pid'=>$categoryrel['cate_id']))->select();
    	echo json_encode($this->apiTemplate($date,'200','ok'));
    }

   
}