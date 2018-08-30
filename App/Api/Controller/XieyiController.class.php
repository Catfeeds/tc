<?php
/******************************
 *
 * 时间：2017年12月8日
 * 功能：各种协议
 * 作者：Mr Peng
 *
 *****************************/ 
namespace Api\Controller;
use Think\Controller;
header('Content-Type:text/json;charset=utf-8');
header("Access-Control-Allow-Origin: *");
class XieyiController extends CommonController {

// +----------------------------------------------------------------------
// | 功能       | 产品协议
// +----------------------------------------------------------------------
// | 请求类型   | post
// +----------------------------------------------------------------------
// | 参数       | xieyi_id
// +----------------------------------------------------------------------    
	public function xieyi(){
        $xieyi=D('xieyi');
        $list=$xieyi->select();
        $data['content']=$list;
        echo json_encode($this->apiTemplate($data,'200','ok'));
	}
// +----------------------------------------------------------------------
// | 功能       | 服务协议
// +----------------------------------------------------------------------
// | 请求类型   | 
// +----------------------------------------------------------------------
// | 参数       | 
// +----------------------------------------------------------------------    
	
	public function index(){
		$id=I('id');
		if($id==''){
			$xieyi=M('xieyi')->field('xieyi_id,title')->select();
			$this->templateApi($xieyi,'200','ok');exit;
		}else{
			$xieyi=M('xieyi')->field('xieyi_id,title,content')->where(array('xieyi_id'=>$id))->find();
			$this->templateApi($xieyi,'200','ok');exit;
		}
	}
}