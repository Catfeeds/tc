<?php
namespace Api\Controller;
use Think\Controller;
header('Content-Type:text/json;charset=utf-8');
header("Access-Control-Allow-Origin: *");
class ChangjianController extends CommonController {
	// +----------------------------------------------------------------------
// | 功能        | 常见问题
// +----------------------------------------------------------------------
// | 请求类型    | 
// +----------------------------------------------------------------------
// | 参数        | 
// +----------------------------------------------------------------------
    public function wenti(){
    	$wenti=D('wenti');
    	$list=$wenti->select();
    	$data['wenti']=$list;
    	echo json_encode($this->apiTemplate($data,'200','ok'));
    }
}
