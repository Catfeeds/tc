<?php
/******************************
 *
 * 时间：2017年12月8日
 * 功能：分享
 * 作者：Mr Peng
 *
 *****************************/ 
namespace Api\Controller;
use Think\Controller;
header('Content-Type:text/json;charset=utf-8');
header("Access-Control-Allow-Origin: *");
class ShareController extends CommonController {

// +----------------------------------------------------------------------
// | 功能       | 
// +----------------------------------------------------------------------
// | 请求类型   | post
// +----------------------------------------------------------------------
// | 参数       | play_id,type
// +----------------------------------------------------------------------    
	public function index(){
		$type=I('post.type');
		$play_id=I('post.play_id');
		if($type=="1"){
		  $data['url']=URL.'/Home/courses/course/id/'.$play_id.'.html';
          echo json_encode($this->apiTemplate($data,'200','ok'));
		}elseif($type=="0"){
		  $data['url']=URL.'/Home/courses/course/pid/'.$play_id.'.html';
          echo json_encode($this->apiTemplate($data,'200','ok'));
		}else{
		  $data=(object)null;
          echo json_encode($this->apiTemplate($data,'204','分享失败'));
		}
		
	}


}