<?php
namespace Home\Controller;
use Think\Controller;
header('Content-Type:text/html;charset=utf-8');
//header("Access-Control-Allow-Origin: *");
class PublicController extends CommonController {
	public function index(){
		
		$this->display('header');
	}
}