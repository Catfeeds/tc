<?php
namespace Home\Controller;
use Think\Controller;
// header('Content-Type:text/json;charset=utf-8');
// header("Access-Control-Allow-Origin: *");
class ThreeloginController extends Controller {
    public function index(){
    	$qqobj=new \Org\Util\Qqconnect();
		$qqobj->getAuthCode();
    }

   
}